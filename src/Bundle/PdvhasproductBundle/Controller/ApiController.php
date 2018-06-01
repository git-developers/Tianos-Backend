<?php

declare(strict_types=1);

namespace Bundle\PdvhasproductBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Component\Resource\Metadata\Metadata;
use Bundle\ResourceBundle\ResourceBundle;
use Bundle\CoreBundle\Controller\BaseController;
use Bundle\UserBundle\Entity\User;
use Bundle\PointofsaleBundle\Entity\Pointofsale;
use Bundle\ProductBundle\Entity\Product;

class ApiController extends BaseController
{

    public function createAction(Request $request): Response
    {

        $parameters = [
            'driver' => ResourceBundle::DRIVER_DOCTRINE_ORM,
        ];
        $applicationName = $this->container->getParameter('application_name');
        $this->metadata = new Metadata('tianos', $applicationName, $parameters);

        //CONFIGURATION
        $configuration = $this->get('tianos.resource.configuration.factory')->create($this->metadata, $request);
//        $template = $configuration->getTemplate('');
        $action = $configuration->getAction();
        $formType = $configuration->getFormType();
        $vars = $configuration->getVars();
        $entity = $configuration->getEntity();

//            $form = $this->createForm($formType, $entity, ['form_data' => []]);
//            $form->handleRequest($request);
//        if ($form->isSubmitted()) {

        $saveEntity = [];
        $pdvHasProducts = $request->get('pdvHasProduct');

        foreach ($pdvHasProducts as $key => $pdvHasProduct){

            $pdvhasproductObject = $this->get('tianos.repository.pdvhasproduct')->findOneByUuid($pdvHasProduct['uuid']);

            if(empty($pdvhasproductObject)){
                $pdvhasproductObject = new $entity();
            }

            if(isset($pdvHasProduct['uuid'])){
                $pdvhasproductObject->setUuid($pdvHasProduct['uuid']);
            }

            if(isset($pdvHasProduct['username'])){
                $user = $this->em()->getRepository(User::class)->findOneByUsername($pdvHasProduct['username']);
                $pdvhasproductObject->setUser($user);
            }

            if(isset($pdvHasProduct['point_of_sale_id'])){
                $pdv = $this->em()->getRepository(Pointofsale::class)->find($pdvHasProduct['point_of_sale_id']);
                $pdvhasproductObject->setPointOfSale($pdv);
            }

            if(isset($pdvHasProduct['product_id'])){
                $product = $this->em()->getRepository(Product::class)->find($pdvHasProduct['product_id']);
                $pdvhasproductObject->setProduct($product);
            }

            if(isset($pdvHasProduct['quantity'])){
                $pdvhasproductObject->setQuantity((int) $pdvHasProduct['quantity']);
            }

            $this->persist($pdvhasproductObject);
//            $saveEntity[] = $this->getSerializeDecode($pdvhasproductObject, $vars['serialize_group_name']);
            $saveEntity[]['id_backend'] = $pdvhasproductObject->getId();
        }

        $status = self::STATUS_SUCCESS;

        return $this->json([
            'status' => $status,
            'errors' => [],
            'entity' => $saveEntity,
        ]);
    }

}
