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

        $googleDriveFiles = $this->get('tianos.repository.google.drive')->findAllNotHasThumbnail(15);

        foreach ($googleDriveFiles as $key => $gdFile) {

            try {

                $url = 'https://drive.google.com/thumbnail?authuser=0&sz=w400&id=' . $gdFile->getFileId();

                $content = file_get_contents($url);
                $savePath = getcwd() . '/google-drive-images/' . $gdFile->getFileId() . '-w400.jpg';
                file_put_contents($savePath, $content);

                $gdFile->setHasThumbnail(true);
                $this->persist($gdFile);

                echo 'Se guardo: ' . $gdFile->getFileId() . '<br>';

            } catch (\Exception $e) {

                echo 'NO se guardo: ' . $gdFile->getFileId() . '<br>';

            }
        }

        return new Response('1');
    }
}
