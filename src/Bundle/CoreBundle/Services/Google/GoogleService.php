<?php

namespace CoreBundle\Services\Google;

use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\DependencyInjection\Container;
use Doctrine\ORM\NonUniqueResultException;
use CoreBundle\Services\Google\BaseGoogle;

class GoogleService extends BaseGoogle implements IGoogle
{
    const STATUS_SUCCESS = true;
    const STATUS_ERROR = false;

    /** @var ObjectManager  */
    private $manager;
    private $container;
    private $twig;

    public function __construct(ObjectManager $manager, Container $container, \Twig_Environment $twig)
    {
        $this->manager = $manager;
        $this->container = $container;
        $this->twig = $twig;

        parent::__construct($container);

    }

    public function getAuthUrl()
    {
        $authUrl = $this->createAuthUrl();

        if(!empty($authUrl)){
            $status = [
                'status' => self::STATUS_ERROR,
            ];
            return array_merge($status, ['auth_url' => $authUrl]);
        }

        $status = [
            'status' => self::STATUS_SUCCESS,
        ];
        return $status;
    }

    public function createAuthUrl()
    {
        $client = $this->getClient();
        $credentialsPath = $this->expandHomeDirectory($this->getCredentialsJson());

//        if (!is_null($client)) {
//            return null;
//        }

        if (!file_exists($credentialsPath)) {
            // Request authorization from the user.
            return $client->createAuthUrl();
        }

        return;
    }

    /**
     * Returns an authorized API client.
     * @return Google_Client the authorized client object
     */
    public function getClient()
    {
        $scopes = implode(' ', [
                \Google_Service_Drive::DRIVE,
                \Google_Service_Drive::DRIVE_FILE,
                \Google_Service_Drive::DRIVE_PHOTOS_READONLY,
            ]
        );

        $authConfig = $this->container->get('kernel')->getRootDir().'/../data/google/client_secret.json.twig';

//        $authConfig = $this->clientSecret();
//        $json = file_get_contents($authConfig);
//        echo '<pre> POLLO 333:: ';
//        print_r($json);
//        exit;



        $client = new \Google_Client();
        $client->setApplicationName('Tianos Web');
        $client->setScopes($scopes);
        $client->setAuthConfig($authConfig);
        $client->setAccessType('offline');
        $client->setApprovalPrompt('force');

        $credentialsPath = $this->expandHomeDirectory($this->getCredentialsJson());

        if(file_exists($credentialsPath)) {
            $accessToken = file_get_contents($credentialsPath);
            $client->setAccessToken($accessToken);

            // Refresh the token if it's expired.
            if ($client->isAccessTokenExpired()) {

//                echo '<pre> POLLO:: ';
//                print_r('getRefreshToken:: ' . $client->getRefreshToken());
//                exit;

//                return null;
                $client->fetchAccessTokenWithRefreshToken($client->getRefreshToken());




                file_put_contents($credentialsPath, json_encode($client->getAccessToken()));

            }
        }

        return $client;
    }

    public function storeCredentials($authCode)
    {
        $client = $this->getClient();
        $accessToken = $client->fetchAccessTokenWithAuthCode($authCode);
        $credentialsPath = $this->expandHomeDirectory($this->getCredentialsJson());

        $status = isset($accessToken['error']) ? $accessToken['error'] : '';
        if($status == 'invalid_grant'){
            return self::STATUS_ERROR;
        }

        // Store the credentials to disk.
        if(!file_exists(dirname($credentialsPath))) {
            mkdir(dirname($credentialsPath), 0700, true);
        }

        file_put_contents($credentialsPath, json_encode($accessToken));

        return self::STATUS_SUCCESS;

    }

    public function revokeToken()
    {
        $credentialsPath = $this->expandHomeDirectory($this->getCredentialsJson());
        if(file_exists($credentialsPath)) {
            unlink($credentialsPath);
        }
    }

    public function clientSecret()
    {
        return $this->twig->render(
            'BackendBundle:Twig/Googledrive:client_secret.json.twig',
            [
                'test' => '',
            ]
        );
    }

    public function getGoogleFiles($id, $search, $pageToken)
    {

        $q = $this->createQ($id);
        $orderBy = ['orderBy' => 'folder'];

        if(!empty($search)){
            $q = "fullText contains '".$search."' AND trashed = false";
            $orderBy = [];
        }

        // Get the API client and construct the service object.
        $client = $this->getClient();
        $service = new \Google_Service_Drive($client);

        // Print the names and IDs for up to 10 files.
        $optParams = [
            'pageSize' => 100,
            'corpus' => 'user',
            'pageToken' => $pageToken,
            'fields' => 'nextPageToken, files(id, name, mimeType, size, iconLink, parents)',
            'q' => $q,
        ];

        $optParams = array_merge($optParams, $orderBy);
        $results = $service->files->listFiles($optParams);
        return $results;
    }


}