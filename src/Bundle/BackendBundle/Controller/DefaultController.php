<?php

declare(strict_types=1);

namespace Bundle\BackendBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Webmozart\Assert\Assert;

class DefaultController extends Controller
{

//    public function indexAction(Request $request): Response
//    {
//        $options = $request->attributes->get('_tianos');
//
//        $template = $options['template'] ?? null;
//        Assert::notNull($template, 'Template is not configured.');
//
//        return $this->render($template, [
//            'form' => null
//        ]);
//    }

    public function dashboardAction(Request $request): Response
    {
        $options = $request->attributes->get('_tianos');

        $template = $options['template'] ?? null;
        Assert::notNull($template, 'Template is not configured.');

        return $this->render($template, [
            'form' => null
        ]);
    }


}
