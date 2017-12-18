<?php

declare(strict_types=1);

namespace Bundle\ProductBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use CoreBundle\Controller\BaseController;

class ApiProductController extends BaseController
{

    public function indexAction(Request $request): Response
    {
        parent::indexAction($request);
    }

}
