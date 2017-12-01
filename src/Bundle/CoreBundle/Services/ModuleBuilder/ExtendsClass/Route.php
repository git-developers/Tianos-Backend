<?php

/*
 * This file is part of the Symfony package.
 *
 * (c) Fabien Potencier <fabien@symfony.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace CoreBundle\Services\ModuleBuilder\ExtendsClass;

use Symfony\Component\Routing\Annotation\Route as BaseRoute;


class Route
{
    protected $path;
    protected $slug;
    protected $data;

    const BLOG_POST_SLUG = '{slug}';

    public function __construct($data)
    {
        $this->data = $data;
    }

    /**
     * @return mixed
     */
    public function getPath()
    {
        $data = explode('/', $this->data);
        $this->path = array_shift($data);

        return $this->path;
    }

    /**
     * @param mixed $path
     */
    public function setPath($path)
    {
        $this->path = $path;
    }

    /**
     * @return mixed
     */
    public function getSlug()
    {
        $data = explode('/', $this->data);
        $this->slug = end($data);

        return $this->slug;
    }

    /**
     * @param mixed $slug
     */
    public function setSlug($slug)
    {
        $this->slug = $slug;
    }

}


/*
    if (isset($data['value'])) {
        $data['path'] = $data['value'];
        unset($data['value']);
    }

    foreach ($data as $key => $value) {
        $method = 'set'.str_replace('_', '', $key);
        if (!method_exists($this, $method)) {
            throw new \BadMethodCallException(sprintf('Unknown property "%s" on annotation "%s".', $key, get_class($this)));
        }
        $this->$method($value);
    }
 */