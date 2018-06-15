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

    public function pedidoVsDevolucionAction(Request $request): Response
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

    public function roturaStockAreaChartAction(Request $request): Response
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

        $jsonArray = $this->getJsonArray($configuration, $dateStart, $dateEnd);

        return $this->render(
            $template,
            [
                'jsonArray' => $this->jsonArrayAreaChart($jsonArray),
                'vars' => $vars,
                'modal' => $modal,
                'action' => $action,
                'dateStart' => $dateStart,
                'dateEnd' => $dateEnd,
                'form' => $form->createView(),
            ]
        );
    }

    public function jsonArrayAreaChart(array $jsonArray = [])
    {

        if(empty($jsonArray)) {
            return;
        }

        // HEADER
        $header = " ['Semana', ";
        foreach ($jsonArray as $key1 => $array1) {
            $header = $header . " '" . $key1 . "', ";
        }
        $header = $header . " ], ";
        // HEADER


        // ARRAY KEYS
        foreach ($jsonArray as $key2 => $array2) {
            $arrayKeys = array_keys($array2);
        }
        // ARRAY KEYS


        // ROW
        $row = "";
        foreach ($arrayKeys as $key3 => $weekKey) {

            $row .= " ['" . $weekKey . "',";

            foreach ($jsonArray as $key4 => $array4) {

                $rowArray = isset($array4[$weekKey]) ? $array4[$weekKey] : [];
                $roturaStock = $rowArray['rotura_stock'];

                $row = $row . $roturaStock . ",";
            }

            $row = $row . "], ";

        }
        // ROW

        return $header . $row;

        /*
        ['Semana', 'Sales', 'Expenses', 'Expenses'],
        ['2013',  1000,      400,      300],
        ['2014',  1170,      460,      260],
        ['2015',  660,       1120,      720],
        ['2016',  1030,      540,      540]
        */
    }

    public function roturaStockLineChartAction(Request $request): Response
    {
//        EXAMPLE:: https://jsfiddle.net/api/post/library/pure

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

        $pointsOfSale = $this->get('tianos.repository.pointofsale')->findAll();

        $jsonArray = $this->getJsonArray($configuration, $dateStart, $dateEnd);

        return $this->render(
            $template,
            [
                'jsonArray' => $this->jsonArrayLineChart($jsonArray),
                'vars' => $vars,
                'modal' => $modal,
                'action' => $action,
                'dateStart' => $dateStart,
                'dateEnd' => $dateEnd,
                'pointsOfSale' => $pointsOfSale,
                'form' => $form->createView(),
            ]
        );
    }

    public function jsonArrayLineChart(array $jsonArray = [])
    {

        if(empty($jsonArray)) {
            return;
        }

        /*
        [0, 0, 0],    [1, 10, 5],   [2, 23, 15],  [3, 17, 9],   [4, 18, 10],  [5, 9, 5],
        */


        // ARRAY KEYS
        foreach ($jsonArray as $key2 => $array2) {
            $arrayKeys = array_keys($array2);
        }
        // ARRAY KEYS


        // ROW
        $i = 0;
        $row = "";
        foreach ($arrayKeys as $key3 => $weekKey) {

            $row .= "[" . $i . ",";

            foreach ($jsonArray as $key4 => $array4) {

                $rowArray = isset($array4[$weekKey]) ? $array4[$weekKey] : [];

                $row = $row . $rowArray['rotura_stock'] . ",";
            }

            $row = $row . "], ";

            $i++;
        }
        // ROW

        return $row;
    }

    public function getJsonArray($configuration, $dateStart, $dateEnd)
    {

        //POINT OF SALE
        $pointsOfSale = $this->get('tianos.repository.pointofsale')->findAll();

        //REPOSITORY
        $repository = $configuration->getRepositoryService();
        $method = $configuration->getRepositoryMethod();

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

                $roturaStock = 0;
                if( (int)$quantityIN > 0  && (int)$quantityOUT > 0 ) {
                    $roturaStock = ($quantityIN / $quantityOUT) * 100;
                }

                $jsonArray[$pointOfSale->getName()][$order->getOrderDate()->format("W")] = [
                    'quantity_IN' => $quantityIN,
                    'quantity_OUT' => $quantityOUT,
                    'rotura_stock' => round($roturaStock, 2),
                ];
            }
        }

        return $jsonArray;
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
