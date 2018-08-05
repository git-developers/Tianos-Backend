<?php

declare(strict_types=1);

namespace Bundle\FrontendBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Bundle\CoreBundle\Controller\BaseController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Webmozart\Assert\Assert;

class CountGoogleFilesController extends BaseController
{

    /**
     * @param Request $request
     * @return Response
     */
    public function indexAction(Request $request): Response
    {
        $googleDriveFilesCount = $this->get('tianos.repository.google.drive.count')->getFilesCount();

        foreach ($googleDriveFilesCount as $key => $gdFile) {

            $count = $gdFile['count_'];
            $fileId = $gdFile['file_id'];

            $googleDriveObject = $this->get('tianos.repository.google.drive')->find($fileId);
            $countView = $googleDriveObject->getCountView();
            $googleDriveObject->setCountView($countView + $count);
            $this->persist($googleDriveObject);
        }

        return new Response();
    }
}
