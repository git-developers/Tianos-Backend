<?php

declare(strict_types=1);

namespace Bundle\ReportBundle\Controller;

use Bundle\CoreBundle\Controller\BaseController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Component\Resource\Metadata\Metadata;
use Bundle\ResourceBundle\ResourceBundle;
use Bundle\OrderBundle\Entity\Order;

class BackendController extends BaseController
{

    public function pedidoDevolucionAction(Request $request): Response
    {
        $parameters = [
            'driver' => ResourceBundle::DRIVER_DOCTRINE_ORM,
        ];
        $applicationName = $this->container->getParameter('application_name');
        $this->metadata = new Metadata('tianos', $applicationName, $parameters);

        //CONFIGURATION
        $configuration = $this->get('tianos.resource.configuration.factory')->create($this->metadata, $request);
        $template = $configuration->getTemplate('');
        $action = $configuration->getAction();
        $vars = $configuration->getVars();
        $modal = $configuration->getModal();
        $formType = $configuration->getFormType();
        $entity = $configuration->getEntity();

        //MODAL
        $gridService = $this->get('tianos.grid');
        $modal = $gridService->getModalMapper()->getDefaults($modal);

        //FORM
        $entity = new $entity();
        $form = $this->createForm($formType, $entity, ['form_data' => []]);
        $form->handleRequest($request);

        //DATETIME
        $datetime = new \DateTime("now");
        $dateStart = $datetime->format('Y-m-d');
        $dateEnd = $datetime->format('Y-m-d');


        if ($form->isSubmitted() && $form->isValid()) {
            $dateStart = $entity->getDateStart();
            $dateStart = $dateStart->format('Y-m-d');

            $dateEnd = $entity->getDateEnd();
            $dateEnd = $dateEnd->format('Y-m-d');
        }


        //REPOSITORY
        $id = $request->get('id');
        $repository = $configuration->getRepositoryService();
        $method = $configuration->getRepositoryMethod();

        //POINT OF SALE
        $pointsOfSale = $this->get('tianos.repository.pointofsale')->findAll();


        //ORDER-IN
        $jsonArrayIn = [];
        foreach ($pointsOfSale as $key => $pointOfSale) {

            $quantity = 0;
            $orders = $this->get($repository)->$method($pointOfSale->getId(), $dateStart, $dateEnd, Order::IN);

            foreach ($orders as $key => $order) {
                $quantity = $quantity + $order->getQuantity();

            }

            $jsonArrayIn[$pointOfSale->getName()] = $quantity;

        }
        //ORDER-IN


        //ORDER-OUT
        $jsonArrayOut = [];
        foreach ($pointsOfSale as $key => $pointOfSale) {

            $quantity = 0;
            $orders = $this->get($repository)->$method($pointOfSale->getId(), $dateStart, $dateEnd, Order::OUT);

            foreach ($orders as $key => $order) {
                $quantity = $quantity + $order->getQuantity();

            }

            $jsonArrayOut[$pointOfSale->getName()] = $quantity;

        }
        //ORDER-OUT

        return $this->render(
            $template,
            [
                'jsonArrayIn' => $jsonArrayIn,
                'jsonArrayOut' => $jsonArrayOut,
                'vars' => $vars,
                'modal' => $modal,
                'action' => $action,
                'dateStart' => $dateStart,
                'dateEnd' => $dateEnd,
                'form' => $form->createView(),
            ]
        );
    }

    public function roturastockAction(Request $request): Response
    {
        $parameters = [
            'driver' => ResourceBundle::DRIVER_DOCTRINE_ORM,
        ];
        $applicationName = $this->container->getParameter('application_name');
        $this->metadata = new Metadata('tianos', $applicationName, $parameters);

        //CONFIGURATION
        $configuration = $this->get('tianos.resource.configuration.factory')->create($this->metadata, $request);
        $template = $configuration->getTemplate('');
        $action = $configuration->getAction();
        $vars = $configuration->getVars();
        $modal = $configuration->getModal();
        $formType = $configuration->getFormType();
        $entity = $configuration->getEntity();

        //MODAL
        $gridService = $this->get('tianos.grid');
        $modal = $gridService->getModalMapper()->getDefaults($modal);

        //FORM
        $entity = new $entity();
        $form = $this->createForm($formType, $entity, ['form_data' => []]);
        $form->handleRequest($request);

        //DATETIME
        $datetime = new \DateTime("now");
        $dateStart = $datetime->format('Y-m-d');
        $dateEnd = $datetime->format('Y-m-d');


        if ($form->isSubmitted() && $form->isValid()) {
            $dateStart = $entity->getDateStart();
            $dateStart = $dateStart->format('Y-m-d');

            $dateEnd = $entity->getDateEnd();
            $dateEnd = $dateEnd->format('Y-m-d');
        }


        //REPOSITORY
        $id = $request->get('id');
        $repository = $configuration->getRepositoryService();
        $method = $configuration->getRepositoryMethod();

        //POINT OF SALE
        $pointsOfSale = $this->get('tianos.repository.pointofsale')->findAll();


        //JSON ARRAY
        $week = [];
        $jsonArray = [];
        foreach ($pointsOfSale as $key => $pointOfSale) {

            $quantityIN = 0;
            $quantityOUT = 0;
            $orders = $this->get($repository)->$method($pointOfSale->getId(), $dateStart, $dateEnd);

            foreach ($orders as $key => $order) {

                if ($order->getType() == Order::IN) {
                    $quantityIN = $quantityIN + $order->getQuantity();
                } elseif ($order->getType() == Order::OUT){
                    $quantityOUT = $quantityOUT + $order->getQuantity();
                }

                $orderDate = $order->getOrderDate();
                $week[$pointOfSale->getName()][] = $orderDate->format("W");

            }

            $roturaStock = 0;
            if( (int)$quantityIN > 0  && (int)$quantityOUT > 0 ) {
                $roturaStock = ($quantityIN / $quantityOUT) * 100;
            }

            $jsonArray[$pointOfSale->getName()] = $roturaStock;
        }
        //JSON ARRAY


//        echo "POLLO:: <pre>";
//        print_r($week);
//        exit;



        return $this->render(
            $template,
            [
                'jsonArray' => $jsonArray,
                'vars' => $vars,
                'modal' => $modal,
                'action' => $action,
                'dateStart' => $dateStart,
                'dateEnd' => $dateEnd,
                'form' => $form->createView(),
            ]
        );
    }

    public function productosEntregadosPdvAction(Request $request): Response
    {
        $parameters = [
            'driver' => ResourceBundle::DRIVER_DOCTRINE_ORM,
        ];
        $applicationName = $this->container->getParameter('application_name');
        $this->metadata = new Metadata('tianos', $applicationName, $parameters);

        //CONFIGURATION
        $configuration = $this->get('tianos.resource.configuration.factory')->create($this->metadata, $request);
        $template = $configuration->getTemplate('');
        $action = $configuration->getAction();
        $vars = $configuration->getVars();
        $modal = $configuration->getModal();
        $formType = $configuration->getFormType();
        $entity = $configuration->getEntity();

        //MODAL
        $gridService = $this->get('tianos.grid');
        $modal = $gridService->getModalMapper()->getDefaults($modal);

        //FORM
        $entity = new $entity();
        $form = $this->createForm($formType, $entity, ['form_data' => []]);
        $form->handleRequest($request);

        //DATETIME
        $datetime = new \DateTime("now");
        $dateStart = $datetime->format('Y-m-d');
        $dateEnd = $datetime->format('Y-m-d');


        if ($form->isSubmitted() && $form->isValid()) {
            $dateStart = $entity->getDateStart();
            $dateStart = $dateStart->format('Y-m-d');

            $dateEnd = $entity->getDateEnd();
            $dateEnd = $dateEnd->format('Y-m-d');
        }


        //REPOSITORY
        $id = $request->get('id');
        $repository = $configuration->getRepositoryService();
        $method = $configuration->getRepositoryMethod();

        //POINT OF SALE
        $pointsOfSale = $this->get('tianos.repository.pointofsale')->findAll();


        //JSON ARRAY
        $jsonArray = [];
        foreach ($pointsOfSale as $key => $pointOfSale) {

            $quantity = 0;
            $pdvHasProducts = $this->get($repository)->$method($pointOfSale->getId(), $dateStart, $dateEnd);

            foreach ($pdvHasProducts as $key => $pdvHasProduct) {
                $quantity = $quantity + $pdvHasProduct->getQuantity();
            }

            $jsonArray[$pointOfSale->getName()] = $quantity;
        }
        //JSON ARRAY


//        echo "POLLO:: <pre>";
//        print_r($jsonArray);
//        exit;



        return $this->render(
            $template,
            [
                'jsonArray' => $jsonArray,
                'vars' => $vars,
                'modal' => $modal,
                'action' => $action,
                'dateStart' => $dateStart,
                'dateEnd' => $dateEnd,
                'form' => $form->createView(),
            ]
        );
    }



}
