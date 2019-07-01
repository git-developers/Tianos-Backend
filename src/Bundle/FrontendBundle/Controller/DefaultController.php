<?php

declare(strict_types=1);

namespace Bundle\FrontendBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Webmozart\Assert\Assert;
use Cocur\Slugify\Slugify;

class DefaultController extends Controller
{

    /**
     * @param Request $request
     * @return Response
     */
    public function indexAction(Request $request): Response
    {
	
	
    	/*
    	 *
	protected function slugify($string, $separator = '-')
	{
		$slugify = new Slugify(['lowercase' => true, 'separator' => $separator, 'ruleset' => 'default']);
		return $slugify->slugify($string);
	}
    	 *
    	 *
    	 *
    	 *
	    $em = $this->getDoctrine()->getManager();
	    $objects = $this->get("tianos.repository.google.drive")->findAll(1000, 16000);
	    
	    echo "COUNT ::: " . count($objects) . "<br><br><br>";
	    //exit;
    	
	    $i = 0;
    	foreach ($objects as $key => $object) {
		
    		$name = $object->getFileName();
    		$name = $this->slugify($name);
    		$slug = $object->getUniqueId() .'-'. $name;
    		
		
		    echo "ID:: " . $object->getId() . " - SLUG:: " . $slug . "<br>";
		    
		    $object->setSlug($slug);

		    $em->persist($object);
		    $em->flush();
		
		    //sleep(1);
		    
	    }
    	
    	exit;
    	*/
    	
    	
    	
        $options = $request->attributes->get('_tianos');

        $template = $options['template'] ?? null;
        $vars = $options['vars'] ?? null;
        Assert::notNull($template, 'Template is not configured.');

        $googleDriveFiles = $this->get('tianos.repository.google.drive')->findAllHasThumbnail();

        return $this->render($template, [
            'googleDriveFiles' => $googleDriveFiles,
            'vars' => $vars,
        ]);

//        return $this->render('default/index.html.twig', [
//            'base_dir' => realpath($this->getParameter('kernel.project_dir')).DIRECTORY_SEPARATOR,
//        ]);
    }

    /**
     * @param Request $request
     * @return Response
     */
    public function contactUsFacebookAction(Request $request): Response
    {
        header('Location: https://www.facebook.com/Apptianos');
        die();
    }

    /**
     * @param Request $request
     * @return Response
     */
    public function contactUsTwitterAction(Request $request): Response
    {
        header('Location: https://twitter.com/tianosApp');
        die();
    }
}
