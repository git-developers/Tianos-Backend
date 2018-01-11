<?php

declare(strict_types=1);

namespace Bundle\SecurityBundle\Controller;

use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Bundle\CoreBundle\Controller\BaseController;

class DefaultController extends BaseController
{

    public function indexAction(Request $request): Response
    {
//        return parent::indexAction($request);
    }

}
