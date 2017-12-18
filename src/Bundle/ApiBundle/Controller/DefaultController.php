<?php

namespace Bundle\ApiBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class DefaultController extends Controller
{
    public function indexAction(Request $request)
    {
        return $this->json([
            'status' => true,
            'msg' => 'mensaje ddd',
        ]);
    }
}
