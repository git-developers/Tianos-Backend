<?php

declare(strict_types=1);

namespace Bundle\ProfileBundle\Controller;

use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Bundle\OneToManyBundle\Controller\OneToManyController;

class ProfileHasRoleController extends OneToManyController
{

    public function indexAction(Request $request): Response
    {
        return parent::indexAction($request);
    }

    public function boxLeftSearchAction(Request $request): Response
    {
        return parent::boxLeftSearchAction($request);
    }

//    public function createAction(Request $request): Response
//    {
//        return parent::createAction($request);
//    }
//
//    public function editAction(Request $request): Response
//    {
//        return parent::editAction($request);
//    }
//
//    public function deleteAction(Request $request): Response
//    {
//        return parent::deleteAction($request);
//    }
//
//    public function viewAction(Request $request): Response
//    {
//        return parent::viewAction($request);
//    }

}
