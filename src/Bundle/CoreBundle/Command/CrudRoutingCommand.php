<?php

declare(strict_types=1);

namespace Bundle\CoreBundle\Command;

use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Yaml\Yaml;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Output\OutputInterface;
use BackendBundle\Controller\AclProfileController;
use BackendBundle\Controller\AclRoleController;
use BackendBundle\Controller\ClientController;
use BackendBundle\Controller\GroupOfUsersController;
use BackendBundle\Controller\PointOfSaleController;
use BackendBundle\Controller\CRUD_DUMMYController;
use BackendBundle\Controller\TemplateController;
use BackendBundle\Controller\TemplateModuleController;

//https://symfony.com/doc/current/components/yaml.html
//https://symfony.com/doc/current/doctrine/reverse_engineering.html
//doctrine:mapping:import

class CrudRoutingCommand extends ContainerAwareCommand
{

    //bin/console tianos:crud:routing BackendBundle

    protected function configure()
    {
        $this
            ->setName('tianos:crud:routing')
            ->setDescription('Crud routing')
            ->addOption('baz', 'tn', InputOption::VALUE_NONE, 'Test option')
//            ->addArgument('status', InputArgument::OPTIONAL, 'El status: e.g. TRUE - FALSE', false)
            ->addArgument('bundle', InputArgument::OPTIONAL, 'El bundle: CoreBundle, BackendBundle', false)
        ;
    }

    /**
     * Execute the command
     * The environment option is automatically handled.
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $bundle = $input->getArgument('bundle');

        $output->writeln([
            '<comment>=========== <question>Crud Routing:</question> proceso ... ===========</comment>',
            '--',
        ]);

        $bundleName = $this->validateBundle($bundle);
        $bundleObj = $this->getApplication()->getKernel()->getBundle($bundleName);
        $destPath = $bundleObj->getPath();
        $routePath = $destPath . '/Resources/config/route/';
        $routingPath = $destPath . '/Resources/config/routing.yml';

        $controllers = $this->listControllers();
        $this->createRoute($bundleName, $controllers, $routePath, $output);
        $output->writeln('--');
        $this->createMainRoute($bundleName, $controllers, $routingPath, $output);

        $output->writeln('--');
        $output->writeln('<info>* Se termino de crear los routings</info>');
        $output->writeln('--');

    }

    private function validateBundle($bundleName)
    {
        $kernel = $this->getContainer()->get('kernel');
        $bundles = $kernel->getBundles();

        foreach($bundles as $key => $bundle){
            if($bundle->getName() == $bundleName){
                return $bundleName;
            }
        }

        return false;
    }

    private function getControllerName($controllerClass)
    {
        $parts = explode('\\', $controllerClass);
        $parts = end($parts);
        return str_replace('Controller', '', $parts);
    }

    private function getRouteArray($bundleName, $controllerName)
    {
        $routes = [
            'BUNDLE_NAME_CONTROLLER_NAME_LOWER_index' => [
                'path' => '/',
                'defaults' => [
                    '_controller' => 'BackendBundle:CONTROLLER_NAME:index'
                ],
                'methods' => ['GET'],
            ],
            'BUNDLE_NAME_CONTROLLER_NAME_LOWER_create' => [
                'path' => '/create',
                'defaults' => [
                    '_controller' => 'BackendBundle:CONTROLLER_NAME:create'
                ],
                'methods' => ['POST'],
            ],
            'BUNDLE_NAME_CONTROLLER_NAME_LOWER_edit' => [
                'path' => '/edit',
                'defaults' => [
                    '_controller' => 'BackendBundle:CONTROLLER_NAME:edit'
                ],
                'methods' => ['POST', 'PUT'],
            ],
            'BUNDLE_NAME_CONTROLLER_NAME_LOWER_delete' => [
                'path' => '/delete',
                'defaults' => [
                    '_controller' => 'BackendBundle:CONTROLLER_NAME:delete'
                ],
                'methods' => ['POST', 'DELETE'],
            ],
            'BUNDLE_NAME_CONTROLLER_NAME_LOWER_view' => [
                'path' => '/view',
                'defaults' => [
                    '_controller' => 'BackendBundle:CONTROLLER_NAME:view'
                ],
                'methods' => ['POST'],
            ],
            'BUNDLE_NAME_CONTROLLER_NAME_LOWER_info' => [
                'path' => '/info',
                'defaults' => [
                    '_controller' => 'BackendBundle:CONTROLLER_NAME:info'
                ],
                'methods' => ['POST'],
            ],
        ];

        $routeArray = [];
        $bundleName = str_replace('Bundle', '', $bundleName);
        foreach ($routes as $key => $route){
            $key = str_replace('CONTROLLER_NAME_LOWER', $controllerName, $key);
            $key = str_replace('BUNDLE_NAME', $bundleName, $key);
            $key = strtolower($key);

            $route['defaults'] = str_replace('CONTROLLER_NAME', $controllerName, $route['defaults']);

            $routeArray[$key] = $route;
        }

        return $routeArray;
    }

    private function getMainRouteArray($bundleName, $controllerName)
    {
        $controllerName = strtolower($controllerName);

        return [
            'resource' => '@' . $bundleName . '/Resources/config/route/' . $controllerName . '.yml',
            'prefix' => '/' . $controllerName
        ];
    }

    private function createRoute($bundleName, $controllers, $routePath, OutputInterface $output)
    {
        foreach ($controllers as $key => $controller){

            $controllerName = $this->getControllerName($controller);
            $filename = $routePath . strtolower($controllerName) . '.yml';

            if (file_exists($filename)) {
                unlink($filename);
            }

            $routeArray = $this->getRouteArray($bundleName, $controllerName);

            $yaml = Yaml::dump($routeArray);
            file_put_contents($filename, $yaml);

            $output->writeln('<comment>* Controller Route: ' . $key . ' -- ' . $controller . '</comment>');
        }
    }

    private function createMainRoute($bundleName, $controllers, $routingPath, OutputInterface $output)
    {
        foreach ($controllers as $key => $controller){

            $controllerName = $this->getControllerName($controller);
            $controllerName = strtolower($controllerName);

            if (file_exists($routingPath)) {
                $yaml = Yaml::parse(file_get_contents($routingPath));

                $bundleNameOnly = str_replace('Bundle', '', $bundleName);
                $bundleNameOnly = strtolower($bundleNameOnly);
                $keyYaml = $bundleNameOnly . '_' . $controllerName;

                //delete - create
                unset($yaml[$keyYaml]);
                $routeArray = $this->getMainRouteArray($bundleName, $controllerName);
                $yaml[$keyYaml] = $routeArray;
                //delete - create

                $yaml = Yaml::dump($yaml);
                file_put_contents($routingPath, $yaml);

                $output->writeln('<comment>* Controller Main Route: ' . $key . ' -- ' . $controller . '</comment>');
            }
        }
    }

    private function listControllers()
    {
        $controllers = [];
        $controllers[] = AclProfileController::class;
        $controllers[] = AclRoleController::class;
        $controllers[] = ClientController::class;
        $controllers[] = GroupOfUsersController::class;
        $controllers[] = PointOfSaleController::class;
        $controllers[] = CRUD_DUMMYController::class;
        $controllers[] = TemplateController::class;
        $controllers[] = TemplateModuleController::class;

        return $controllers;
    }

}




