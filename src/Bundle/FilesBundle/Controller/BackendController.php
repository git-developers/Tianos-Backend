<?php

declare(strict_types=1);

namespace Bundle\FilesBundle\Controller;

use Bundle\CoreBundle\Controller\BaseController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Component\Resource\Metadata\Metadata;
use Bundle\ResourceBundle\ResourceBundle;
use JMS\Serializer\SerializationContext;
use Bundle\GridBundle\Controller\GridController;

class BackendController extends GridController
{
	
	public function uploadAction(Request $request): Response
	{
		

		if(!empty($_FILES)) {
			
			
//			echo "POLLO:: <pre>";
//			print_r($_FILES);
//			exit;
			
			
			
			if(is_uploaded_file($_FILES['userImage']['tmp_name'])) {
				
				$sourcePath = $_FILES['userImage']['tmp_name'];
				$targetPath = getcwd() . "/images/" . $_FILES['userImage']['name'];

				
//				echo "POLLO:: <pre>";
//				print_r($sourcePath);
//				print_r(" ************ ");
//				print_r($targetPath);
//				exit;
//
				
				if(move_uploaded_file($sourcePath, $targetPath)) {
					
					
					
					echo "POLLO:: <pre>";
					print_r(4444444);
					exit;
					
					
				}
			}
		}
		
		return new Response('33333333');
	}
}
