<?php

declare(strict_types=1);

namespace Bundle\FrontendBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Webmozart\Assert\Assert;

class DefaultController extends Controller
{

    /**
     * @param Request $request
     * @return Response
     */
    public function indexAction(Request $request): Response
    {


//        $user = $this->getUser();
//        echo 'GATO:::<pre>';
//        print_r($user->getRoles());
//        exit;




        $options = $request->attributes->get('_tianos');

        $template = $options['template'] ?? null;
        Assert::notNull($template, 'Template is not configured.');

        return $this->render($template, [
            'form' => null
        ]);

//        return $this->render('default/index.html.twig', [
//            'base_dir' => realpath($this->getParameter('kernel.project_dir')).DIRECTORY_SEPARATOR,
//        ]);
    }
}
