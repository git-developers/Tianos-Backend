<?php

declare(strict_types=1);

namespace Bundle\ProductBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Bundle\GridBundle\Controller\GridController;

class BackendProductController extends GridController
{

//    public function __construct(RequestConfigurationFactoryInterface $requestConfigurationFactory) {
//        parent::__construct($requestConfigurationFactory);
//    }


    public function indexAction(Request $request): Response
    {
        parent::indexAction($request);
    }

}
