<?php

declare(strict_types=1);

namespace Bundle\CoreBundle\Command;

use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Yaml\Yaml;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Output\OutputInterface;

//https://symfony.com/doc/current/components/yaml.html
//https://symfony.com/doc/current/doctrine/reverse_engineering.html
//doctrine:mapping:import

class CrudServicesCommand extends ContainerAwareCommand
{

    //bin/console tianos:crud:routing BackendBundle

    protected function configure()
    {
        $this
            ->setName('tianos:crud:services')
            ->setDescription('Crud services')
            ->addOption('baz', 'tn', InputOption::VALUE_NONE, 'Test option')
//            ->addArgument('status', InputArgument::OPTIONAL, 'El status: e.g. TRUE - FALSE', false)
            ->addArgument('component', InputArgument::OPTIONAL, 'The component: product, client', false)
        ;
    }

    /**
     * Execute the command
     * The environment option is automatically handled.
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $component = $input->getArgument('component');

        $output->writeln([
            '<comment>=========== <question>Crud services:</question> proceso ... ===========</comment>',
            '--',
        ]);

        # https://symfony.com/doc/current/service_container.html
        $ymlPath = __DIR__ . '/../../../../app/config/services.yml';

        $out = [];
        $bundles = $this->defaultBundles($component);

        foreach ($bundles as $key => $bundle){
            $out['imports'][]['resource'] = '@' . ucfirst(strtolower($bundle)) . 'Bundle/Resources/config/services.yml';;
        }


        //COPIAR YML
        file_put_contents($ymlPath, Yaml::dump($out));

        $output->writeln('--');
        $output->writeln('<info>* Services YML</info>');
        $output->writeln('--');

    }

    protected function defaultBundles($component)
    {
        $out = [];
        $out[] = 'api';
        $out[] = 'core';
        $out[] = 'grid';
        $out[] = 'backend';
        $out[] = 'frontend';
        $out[] = 'resource';
        $out[] = $component;

        return $out;
    }

}




