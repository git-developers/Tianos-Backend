<?php

//declare(strict_types=1);

namespace Bundle\ProductBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

use Bundle\ProductBundle\Entity\Product;

class ProductController extends Controller
{
    /**
     * @param Request $request
     *
     * @return Response
     */
    public function indexAction(Request $request): Response
    {
        $productRepository = $this->container->get('tianos.repository.product');
        $product = $productRepository->gatazo();



//        $product = $this->getDoctrine()
//            ->getRepository(Product::class)
//            ->findAll();




        echo '<pre> POLLO - 5555 -- $product:: ';
        print_r($product);
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
