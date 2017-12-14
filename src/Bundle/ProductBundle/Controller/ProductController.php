<?php

//declare(strict_types=1);

namespace Bundle\ProductBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Bundle\GridBundle\Controller\GridController;
use Bundle\ProductBundle\Entity\Product;

class ProductController extends GridController
{

//    public function __construct(RequestConfigurationFactoryInterface $requestConfigurationFactory) {
//        parent::__construct($requestConfigurationFactory);
//    }

    /**
     * @param Request $request
     *
     * @return Response
     */
    public function indexAction(Request $request): Response
    {
        parent::indexAction($request);
    }

}
