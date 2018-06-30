<?php

declare(strict_types=1);

namespace Bundle\GoogleBundle\Controller;

use Bundle\CoreBundle\Controller\BaseController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Component\Resource\Metadata\Metadata;
use Bundle\ResourceBundle\ResourceBundle;
use Bundle\OrderBundle\Entity\Order;

class GoogleDriveController extends BaseController
{


    public function indexAction(Request $request): Response
    {
        $parameters = [
            'driver' => ResourceBundle::DRIVER_DOCTRINE_ORM,
        ];
        $applicationName = $this->container->getParameter('application_name');
        $this->metadata = new Metadata('tianos', $applicationName, $parameters);

        //CONFIGURATION
        $configuration = $this->get('tianos.resource.configuration.factory')->create($this->metadata, $request);

        $repository = $configuration->getRepositoryService();
        $method = $configuration->getRepositoryMethod();
        $template = $configuration->getTemplate('');
        $vars = $configuration->getVars();


        /**
         * OLD
         */
        $id = $request->get('id');
        $search = $request->get('search');
        $pageToken = $request->get('page', null);

        $google = $this->get('tianos.service.google.drive.service');
        $authUrl = $google->getAuthUrl();



//        echo "POLLO:::111::: <pre>";
//        print_r($authUrl);
//        exit;






        if(!$authUrl['status']){
            return $this->redirect($this->generateUrl('backend_google_drive_account_permissions'));
        }

        $results = $google->getGoogleFiles($id, $search, $pageToken);
        $files = $results->getFiles();
        $smallText = $google->createSmallText($id);
        /**
         * OLD
         */

        /*
        //**************************
        $google->redisDelete('pollo');
        $files = $google->redisGet('pollo');

        if(empty($files)){
            $files = $google->redisSet('pollo', $results->getFiles());
        }
        //**************************
        */

        return $this->render(
            $template,
            [
                'vars' => $vars,
                'id' => $id,
                'files' => $files,
                'search' => $search,
                'small_text' => $smallText,
                'next_page_token' => $results->nextPageToken,
            ]
        );
    }

    public function accountPermissionsAction(Request $request)
    {
        $parameters = [
            'driver' => ResourceBundle::DRIVER_DOCTRINE_ORM,
        ];
        $applicationName = $this->container->getParameter('application_name');
        $this->metadata = new Metadata('tianos', $applicationName, $parameters);

        //CONFIGURATION
        $configuration = $this->get('tianos.resource.configuration.factory')->create($this->metadata, $request);

        $repository = $configuration->getRepositoryService();
        $method = $configuration->getRepositoryMethod();
        $template = $configuration->getTemplate('');
        $vars = $configuration->getVars();



        /**
         * OLD
         */
        $authCode = $request->get('code');

        $google = $this->get('tianos.service.google.drive.service');
        $authUrl = $google->getAuthUrl();




//        echo "POLLO::accountPermissions::: getAuthUrl::: <pre>";
//        print_r($authUrl);
//        exit;



        if ($authUrl['status']) {
            return $this->redirect($this->generateUrl('backend_google_drive_index', ['id' => 'my-drive']));
        }

        if (isset($authCode)) {

            $result = $google->storeCredentials($authCode);

            if(!$result){
                $this->flashWarning('Oops! parece que no se termino el proceso, reintente.');
                return $this->redirect($this->generateUrl('backend_google_drive_account_permissions'));
            }

//            return $this->redirect($this->generateUrl('backend_google_drive_index', ['id' => 'my-drive']));
        }
        /**
         * OLD
         */

        return $this->render(
            $template,
            [
                'vars' => $vars,
                'auth_url' => $authUrl['auth_url'],
            ]
        );
    }

    public function revokeTokenAction(Request $request)
    {
        $google = $this->get('core.service.google_service_drive');
        $google->revokeToken();
        return $this->redirect($this->generateUrl('backend_googledrive_index', ['id' => 'my-drive']));
    }

    public function mimetypeAction(Request $request)
    {

        return $this->render(
            'BackendBundle:Googledrivesettings:index.html.twig',
            [
                'auth_url' => '',
            ]
        );
    }

    public function breadcrumbAction($files) {

        $file = array_shift($files);
        $name = isset($file['name']) ? $file['name'] : '(no disponible)';
        $parents = isset($file['parents']) ? $file['parents'] : [];
        $parents = array_shift($parents);

        /*
        $bread = explode('/', $path);
        $crumbtrail = '';
        foreach ($bread as $crumb) {
            list($id, $name) = $this->explode_node_path($crumb);
            $name = empty($name) ? $id : $name;
            $breadcrumb[] = array(
                'name' => $name,
                'path' => $this->build_node_path($id, $name, $crumbtrail)
            );
            $tmp = end($breadcrumb);
            $crumbtrail = $tmp['path'];
        }
        return $breadcrumb;
        */

        return $this->render(
            'BackendBundle:Googledrive:breadcrumb.html.twig',
            [
                'parents' => $parents,
                'name' => $name,
            ]
        );
    }


    public function watchAction(Request $request, $slug)
    {
//        if (!$this->get('security.authorization_checker')->isGranted('ROLE_EDIT_USER')) {
//            return $this->redirectToRoute('frontend_default_access_denied');
//        }

        $em = $this->getDoctrine()->getManager();
        $entity = $em->getRepository('CoreBundle:Files')->findOneBySlug($slug);

        if(!$entity){
            throw $this->createNotFoundException('el archivo que busca no existe');
        }

        return $this->render(
            'BackendBundle:Files/Watch:index.html.twig',
            [
                'small_text' => '',
                'entity' => $entity,
            ]
        );
    }

    public function saveAction(Request $request)
    {

        $user = $this->getUser();
        $em = $this->getDoctrine()->getManager();
        $response = new \stdClass();
        $pusher = $this->container->get('gos_web_socket.zmq.pusher');
        $files = $request->get('files', []);

        if(empty($files)){
            return new Response(0);
        }

        foreach ($files as $key => $file){

            $file = isset($file['file']) ? $file['file'] : '';
            $file = json_decode(base64_decode($file));

            $idFile = isset($file[0]) ? $file[0] : '';
            $name = isset($file[1]) ? $file[1] : '';
            $iconLink = isset($file[2]) ? $file[2] : '';
            $mimeType = isset($file[3]) ? $file[3] : '';
            $size = isset($file[4]) ? $file[4] : '';

            $response->id = $idFile;
            $response->status = self::STATUS_LOADING;
            $response->message = 'loading';
            $pusher->push(['msg' => json_encode($response)], 'googledrive_topic');

            // sleep for 2 seconds
            sleep(2);

            try {

                //files mime type
                $mimeTypeEntity = $em->getRepository('CoreBundle:FileMimeType')->findOneByName($mimeType);

                if(!$mimeTypeEntity){
                    $mimeTypeEntity = new FileMimeType();
                    $mimeTypeEntity->setName($mimeType);
                    $this->save($mimeTypeEntity);

                    // sleep for 2 seconds
                    sleep(2);
                }

                //file
                $fileEntity = $em->getRepository('CoreBundle:Files')->findOneByIdFile($idFile);

                if(is_null($fileEntity)){
                    $fileEntity = new Files;
                    $response->message = 'Se agrego el archivo';
                }else{
                    $fileEntity->setIsActive(true);
                    $response->message = 'Se actualizo el archivo';
                }


                $fileEntity->setUniqueId(uniqid());
                $fileEntity->setIdFile($idFile);
                $fileEntity->setName($name);
                $fileEntity->setIconLink($iconLink);
                $fileEntity->setSize($size);
//                $fileEntity->setSize($size);
//                $fileEntity->setIdMimeType($mimeTypeEntity);
                $this->save($fileEntity);

                sleep(1);

                //user
                $user->removeFile($fileEntity);
                $user->addFile($fileEntity);
                $this->save($user);

                $response->id = $idFile;
                $response->status = self::STATUS_SUCCESS;

            } catch(UniqueConstraintViolationException $e) {
                $response->id = $idFile;
                $response->status = self::STATUS_DUPLICATE_ENTRY;
                $response->message = 'El archivo ya fue incluido anteriormente.';
            }

            $pusher->push(['msg' => json_encode($response)], 'googledrive_topic');

        }

        return new Response(1);

    }

    public function deleteOneAction(Request $request)
    {

        $response = new \stdClass();
        $response->status = "fail";

//        if (!$this->get('security.authorization_checker')->isGranted('ROLE_DELETE_PROFILE')) {
//            $response->status = "access-denied";
//            $responseJson = json_encode($response);
//            return new Response($responseJson);
//        }

        $uniqueId = $request->get('id', null);
        $em = $this->getDoctrine()->getManager();
        $entity = $em->getRepository('CoreBundle:Files')->findOneByUniqueId($uniqueId);

        if($entity){
            try {
                $entity->setIsActive(0);
                $this->save($entity);
                $response->status = "ok";
            }catch (\Exception $e){

            }
        }

        return $this->json($response);
    }

    public function deleteManyAction(Request $request)
    {

        $user = $this->getUser();
        $em = $this->getDoctrine()->getManager();
        $response = new \stdClass();
        $pusher = $this->container->get('gos_web_socket.zmq.pusher');
        $files = $request->get('files', []);

        if(empty($files)){
            return new Response(0);
        }


        foreach ($files as $key => $file){

            $file = isset($file['file']) ? $file['file'] : '';
            $file = json_decode(base64_decode($file));

            $idFile = isset($file[0]) ? $file[0] : '';

            $response->id = $idFile;
            $response->status = self::STATUS_LOADING;
            $response->message = 'loading';
            $pusher->push(['msg' => json_encode($response)], 'googledrive_topic');

            // sleep for 2 seconds
            sleep(2);

            try {
                $fileEntity = $em->getRepository('CoreBundle:Files')->findOneByIdFile($idFile);

                if($fileEntity){
                    $fileEntity->setIsActive(0);
                    $this->save($fileEntity);
                }

                $response->id = $idFile;
                $response->status = self::STATUS_DELETE;
                $response->message = 'Se elimino el archivo';

            } catch(\Exception $e) {
                $response->id = $idFile;
                $response->status = self::STATUS_ERROR;
                $response->message = 'Ocurrio una excepcion, reintentar.';
            }

            $pusher->push(['msg' => json_encode($response)], 'googledrive_topic');

        }

        return new Response(1);

    }

}
