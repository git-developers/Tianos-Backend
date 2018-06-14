<?php

declare(strict_types=1);

namespace Bundle\CoreBundle\Command;

use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Yaml\Yaml;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Process\Process;
use Symfony\Component\Process\Exception\ProcessFailedException;
use Bundle\PdvhasproductBundle\Entity\Pdvhasproduct;

//https://symfony.com/doc/current/components/yaml.html
//https://symfony.com/doc/current/doctrine/reverse_engineering.html

class PointofsaleAndProductCommand extends ContainerAwareCommand
{

    const DUMMY_UPPER = 'DUMMY_UPPER';

    protected function configure()
    {
        $this
            ->setName('tianos:pointofsale:and:product')
            ->setDescription('Productos distribuidos por Transportistas a los Puntos de venta')
            ->addOption('baz', 'tn', InputOption::VALUE_NONE, 'Test option')
//            ->addArgument('status', InputArgument::OPTIONAL, 'El status: e.g. TRUE - FALSE', false)
            ->addArgument('date-start', InputArgument::OPTIONAL, 'Fecha inicio', false)
            ->addArgument('date-end', InputArgument::OPTIONAL, 'Fecha fin', false)
        ;
    }

    /**
     * Execute the command
     * The environment option is automatically handled.
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $dateStartStr = $input->getArgument('date-start');
        $dateStart = new \DateTime($dateStartStr);

        $dateEndStr = $input->getArgument('date-end');
        $dateEnd   = new \DateTime($dateEndStr);

        $output->writeln([
            '<comment>===========<question>Productos distribuidos por Transportistas a los Puntos de venta</question>===========</comment>',
            '--',
        ]);

        $em = $this->getContainer()->get('doctrine')->getManager();


        //DELETE OBJECTS
        $sql = "DELETE FROM point_of_sale_has_product;";
        $stmt = $em->getConnection()->prepare($sql);
        $stmt->execute();



        // GET OBJECTS
        $transportistas = $this->getContainer()->get('tianos.repository.user')->findAllOffsetLimitTransportista();
        $productos = $this->getContainer()->get('tianos.repository.product')->findAll();

        for ($i = $dateStart; $i <= $dateEnd; $i->modify('+1 day')) {


//            echo "POLLO:: <pre>";
//            print_r($i);
//            exit;


            $output->writeln('<comment>===<question>Fecha:</question> ' . $i->format("Y-m-d") . ' ===</comment>');

            foreach ($transportistas as $key => $transportista) {

                foreach ($transportista->getRoute() as $key => $route) {

                    foreach ($route->getPointOfSale() as $key => $pointOfSale) {

                        foreach ($productos as $key => $product) {

                            $min = 10;
                            $max = 100;
                            $entity = new Pdvhasproduct();
                            $entity->setUser($transportista);
                            $entity->setPointOfSale($pointOfSale);
                            $entity->setProduct($product);
                            $entity->setQuantity(rand($min, $max));
                            $entity->setUuid(uniqid("", true));
                            $entity->setCreatedAt($i);
                            $em->persist($entity);
                            $em->flush();
                        }
                    }
                }
            }

            usleep(500);

        }


        //=============================================
        $output->writeln('--');
        $output->writeln('<question>=== Se termino el proceso ===</question>');
        $output->writeln('<comment>Fecha inicio: ' . $dateStartStr . ' -- Fecha fin: ' . $dateEndStr . '</comment>');
        $output->writeln('--');
    }


}


