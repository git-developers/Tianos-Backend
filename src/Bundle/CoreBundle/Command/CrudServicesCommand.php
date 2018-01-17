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
        $model = '@' . ucfirst(strtolower($component)) . 'Bundle/Resources/config/services.yml';
        $yamls = Yaml::parseFile($ymlPath);
        $yamls = array_shift($yamls);

        $out = [];
        $out['imports'] = $yamls;

        foreach ($yamls as $key => $yaml){
            if($yaml['resource'] != $model){
                $out['imports'][]['resource'] = $model;
                break;
            }
        }

        file_put_contents($ymlPath, Yaml::dump($out));

        $output->writeln('--');
        $output->writeln('<info>* Services YML</info>');
        $output->writeln('--');

    }

}




