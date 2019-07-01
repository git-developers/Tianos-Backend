<?php

declare(strict_types=1);

namespace Bundle\FrontendBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Bundle\CoreBundle\Controller\BaseController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Webmozart\Assert\Assert;

class GenerateThumbnailController extends BaseController
{

    /**
     * @param Request $request
     * @return Response
     */
    public function indexAction(Request $request): Response
    {
        $objects = $this->get('tianos.repository.google.drive')->findAllNotHasThumbnail(5);

        //echo "COUNT :: " . count($objects) . "<br><br>";
        
        
        foreach ($objects as $key => $object) {
	
	        echo "ID:: " . $object->getId() . " - SLUG:: " . $object->getSlug() . "<br>";
        	
	        
            try {

                $url = 'https://drive.google.com/thumbnail?authuser=0&sz=w400&id=' . $object->getFileId();

                $content = file_get_contents($url);
                $savePath = getcwd() . '/google-drive-images/' . $object->getFileId() . '-w400.jpg';
                $isSaved = file_put_contents($savePath, $content);

                if ($isSaved) {
	                $object->setHasThumbnail(true);

                    echo 'Se guardo: ' . $object->getFileId() . '<br>';
                } else {
                    echo 'NO se guardo:: file_put_contents:: ' . $object->getFileId() . '<br>';
                }

            } catch (\Exception $e) {

                echo 'NO se guardo: ' . $object->getFileId() . '<br>';

            }
	
	        $object->setUpdatedAt(new \Datetime());
            
            $this->persist($object);
            
            sleep(1);
        	
        }

        return new Response('1');
    }
}
