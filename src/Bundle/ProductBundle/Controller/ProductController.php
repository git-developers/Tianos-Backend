<?php

//declare(strict_types=1);

namespace Bundle\ProductBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class ProductController extends Controller
{
    /**
     * @param Request $request
     *
     * @return Response
     */
    public function indexAction(Request $request): Response
    {



        echo '<pre> POLLO --- 555:: ';
        print_r($request);
        exit;




//        $entity = $this->em()->getRepository($crud['class_path'])->findAll();
//        $entity = $this->getSerialize($entity, $crud['group_name']);
//        $dataTable->setData($entity);

        return $this->render(
            'CoreBundle:Crud:index.html.twig',
            [
//                'crud' => $crud,
//                'dataTable' => $dataTable,
            ]
        );



//        $name = $request->query->get('name');
//
//        return new JsonResponse([
//            'slug' => $this->get('sylius.generator.slug')->generate($name),
//        ]);
    }
}
