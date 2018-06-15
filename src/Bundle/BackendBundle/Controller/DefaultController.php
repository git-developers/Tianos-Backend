<?php

declare(strict_types=1);

namespace Bundle\BackendBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Bundle\CoreBundle\Controller\BaseController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Webmozart\Assert\Assert;

class DefaultController extends BaseController
{

    /**
     * @param Request $request
     * @return Response
     */
    public function indexAction(Request $request): Response
    {
        return $this->redirectUrl('backend_default_dashboard');
    }

    /**
     * @param Request $request
     * @return Response
     */
    public function dashboardAction(Request $request): Response
    {


//        foreach ($this->getUser()->getPointOfSale() as $key => $xxx) {
//            echo "POLLO:: <pre>";
//            print_r($xxx->getName());
//        }
//
//
//        exit;




        $options = $request->attributes->get('_tianos');

        $template = $options['template'] ?? null;
        Assert::notNull($template, 'Template is not configured.');

        return $this->render($template, [
            'form' => null
        ]);
    }

}
