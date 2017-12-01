<?php

namespace BackendBundle\Services;

use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\DependencyInjection\Container;
use Symfony\Component\OptionsResolver\OptionsResolver;

class FileUploader
{
    private $targetDir;
    private $container;

    public function __construct($targetDir, Container $container)
    {
        $this->targetDir = $targetDir;
        $this->container = $container;
    }

    public function uploadAvatar($directory, $username, UploadedFile $file)
    {

        $fileName =  $username.'_'.md5(uniqid()).'.jpg'; // $file->guessExtension();
        $file->move($this->targetDir.$directory, $fileName);

        return $fileName;
    }

    public function removeAvatar($fileName)
    {

        //borrar del directory web/uploads
        $path = $this->container->getParameter('uploads_directory').'/user/'.$fileName;
        if (file_exists($path)) {
            @unlink($path);
        }

        //borrar del directory media/cache
        $path = 'uploads/user/'.$fileName;
        $cacheManager = $this->container->get('liip_imagine.cache.manager');
        $cacheManager->resolve($path, 'filter_160');
        $cacheManager->remove($path, 'filter_160');
        $cacheManager->resolve($path, 'filter_500');
        $cacheManager->remove($path, 'filter_500');

        return;
    }

}