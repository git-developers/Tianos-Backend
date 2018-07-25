<?php

declare(strict_types=1);

namespace Bundle\CoreBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\RedirectResponse;
use JMS\Serializer\Serializer;
use JMS\Serializer\SerializerBuilder;
use JMS\Serializer\SerializationContext;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;

abstract class BaseController extends Controller
{


//    /**
//     * @Route("/", name="homepage")
//     */
//    public function indexAction(Request $request)
//    {
//        // replace this example code with whatever you need
//        return $this->render('default/index.html.twig', [
//            'base_dir' => realpath($this->getParameter('kernel.root_dir').'/..').DIRECTORY_SEPARATOR,
//        ]);
//    }





//    const TEMPLATE_ERROR = 'CoreBundle:Default:template_error.html.twig';
//
    const ACCESS_DENIED_MSG = 'Tianos: Access Denied';
//    const ACCESS_DENIED_ROLE_MSG = 'Tianos: no tiene permisos, contacte a su administrador.';
//    const NOT_FOUND_MSG = 'Tianos Base controller: no se encontro el entity';

    const STATUS_SUCCESS = true;
    const STATUS_ERROR = false;

    const STATUS_SUCCESS_API = 1;
    const STATUS_WARNING_API = 2;
    const STATUS_ERROR_API = 3;

    const MAX_AGE_HOUR = 3600; #cache for 300 seconds
    const MAX_AGE_WEEK = 604800; #cache for 604800 seconds
    const MAX_AGE_YEAR = 31622400; #cache for 31622400 seconds
    const CONTENT_TYPE_APPLICATION_JSON = 'application/json';

    protected function em()
    {
        return $this->getDoctrine()->getManager();
    }

    protected function persist($entity)
    {
        // "The EntityManager is closed." issue.
        if (!$this->em()->isOpen()) {
            $this->getDoctrine()->resetManager();
        }

        $this->em()->persist($entity);
        $this->em()->flush();
    }

    protected function remove($entity)
    {
        // "The EntityManager is closed." issue.
        if (!$this->em()->isOpen()) {
            $this->getDoctrine()->resetManager();
        }

        $this->em()->remove($entity);
        $this->em()->flush();
    }

    protected function getSerializeDecode($object, $groupName)
    {
        $objects = $this->getSerialize($object, $groupName);
        return json_decode($objects, true);
    }

    protected function getSerialize($object, $groupName)
    {
        $serializer = $this->container->get('jms_serializer');

        return $serializer->serialize(
            $object,
            'json',
            SerializationContext::create()->setSerializeNull(true)->setGroups([$groupName])
        );
    }

    protected function redirectUrl($url, $day = 1)
    {
        $url = $this->generateUrl($url);
        $redirect = new RedirectResponse($url);
        $redirect->setExpires(new \DateTime('+'.$day.' day'));
        return $redirect;
    }

    protected function flashSuccess($message)
    {
        $this->addFlash('success', $message);
    }

    protected function flashWarning($message)
    {
        $this->addFlash('warning', $message);
    }

    protected function flashError($message)
    {
        $this->addFlash('error', $message);
    }

    protected function notFound($message = 'Not Found', \Exception $previous = null)
    {
        throw $this->createNotFoundException($message, $previous);
    }

    protected function isXmlHttpRequest()
    {
        $request = $this->container->get('request_stack')->getCurrentRequest();
        return $request->isXmlHttpRequest() || $request->get('_xml_http_request');
//        return 'XMLHttpRequest' == $this->headers->get('X-Requested-With');
    }

    protected function contentTypeValidation(Request $request)
    {
        $content = $request->headers->get('Content-Type');

        if(strpos($content, self::CONTENT_TYPE_APPLICATION_JSON) !== 0){
            throw new BadRequestHttpException('Tianos: content-type not allowed');
        }
    }

    protected function generateRandomString($length = 10) {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';

        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }

        return $randomString;
    }

//    protected function getBundleName()
//    {
//        $request = $this->container->get('request_stack')->getCurrentRequest();
//        $controller = $request->attributes->get('_controller');
//        list($bundle) = explode('\\', $controller);
//
//        return $bundle;
//    }
//
//    public function getControllerName()
//    {
//        $request = $this->container->get('request_stack')->getCurrentRequest();
//        $controller = $request->attributes->get('_controller');
//
//        $pattern = "/Controller\\\\([a-zA-Z]*)Controller/";
//        $matches = [];
//        preg_match($pattern, $controller, $matches);
//        return end($matches);
//    }

//    protected function templateExists($name)
//    {
//        if($this->get('templating')->exists($name)){
//            return $name;
//        }
//
////        return self::TEMPLATE_ERROR;
//    }

}