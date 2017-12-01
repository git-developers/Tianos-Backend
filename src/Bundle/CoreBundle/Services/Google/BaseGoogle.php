<?php

namespace CoreBundle\Services\Google;

use CoreBundle\Entity\User;
use Symfony\Component\DependencyInjection\Container;
use Symfony\Component\Cache\CacheItem;
use Symfony\Component\Cache\Adapter\RedisAdapter;
use Symfony\Component\Cache\Adapter\FilesystemAdapter;

class BaseGoogle extends \Twig_Extension
{

    private $user;
    private $container;

    public function __construct(Container $container)
    {
        $this->container = $container;
        $this->user = $this->container->get('security.token_storage')->getToken()->getUser();
    }

    /**
     * Expands the home directory alias '~' to the full path.
     * @param string $path the path to expand.
     * @return string the expanded path.
     */
    protected function expandHomeDirectory($path) {
        $homeDirectory = getenv('HOME');
        if (empty($homeDirectory)) {
            $homeDirectory = getenv('HOMEDRIVE') . getenv('HOMEPATH');
        }
        return str_replace('~', realpath($homeDirectory), $path);
    }

    protected function getCredentialsJson() {
        $credentials = $this->container->get('kernel')->getRootDir().'/../data/google/credentials/access-token-'.$this->user->getUsername().'.json';
        return $credentials;
    }

    public function createQ($id)
    {
        switch($id){
            case 'my-drive':
                $q = "'root' in parents AND trashed = false";
                break;
            case 'shared-with-me':
                $q = "sharedWithMe AND trashed = false";
                break;
            default:
                $q = "'root' in parents AND trashed = false";
                if(!empty($id)){
                    $q = "'".$id."' in parents AND trashed = false";
                }
                break;
        }

        return $q;

    }

    public function createSmallText($id)
    {
        switch($id){
            case 'my-drive':
                $smallText = "my drive";
                break;
            case 'shared-with-me':
                $smallText = 'shared with me';
                break;
            default:
                $smallText = "my drive";
                break;
        }

        return $smallText;
    }

    //Redis
    public function redisGet($key)
    {
//        $redis = $this->container->get('snc_redis.default');
//        $redis->get($key);

        $cache = new FilesystemAdapter();

        // retrieve the cache item
        $numProducts = $cache->getItem($key);
        if (!$numProducts->isHit()) {
            // ... item does not exists in the cache
            return '';
        }

        // retrieve the value stored by the item
        $total = $numProducts->get();

//        echo '<pre> POLLO::';
//        print_r($total);
//        exit;


        return unserialize($total);

    }

    public function redisSet($key, $value)
    {
//        $redis = $this->container->get('snc_redis.default');
//        $redis->set($key, $value);
//        $redis->expire($key, 3600);

        // available adapters: filesystem, apcu, redis, array, doctrine cache, etc.
        $cache = new FilesystemAdapter();

        // create a new item getting it from the cache
        $numProducts = $cache->getItem($key);

        // assign a value to the item and save it
        $numProducts->set(serialize($value));
        $cache->save($numProducts);

    }

    public function redisDelete($key)
    {
        $cache = new FilesystemAdapter();
        // remove the cache item
        $cache->deleteItem($key);
    }

//    protected function redisFlushall()
//    {
//        $redis = new RedisAdapter($this->container->get('snc_redis.blogs'), 'blogs:');
//        $redis->getRedis()->flushall();
//    }

    protected function getRepository($repository, $bundleName = "BatBundle" )
    {
//        return $this->getRepository('BatOrderMerchandise');

//        $repository = $this->getOrderStatusRepository();
//        return $repository->findOneByNombre(BatOrderStatus::EJECUTADO);

//        return $this->manager->getRepository($bundleName .":" . $repository);
    }

    protected function save($entity, $flush = false)
    {
//        $this->manager->persist($entity);
//
//        if ($flush) {
//            $this->manager->flush();
//        }
    }
}