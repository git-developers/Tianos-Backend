<?php

namespace CoreBundle\Services\ListHasTree\BuildInterface;

interface ListHasTreeInterface
{
    public function findAll($limit = null, $offset = null);
    public function search($q, $maxResults = null, $firstResult = null);
    public function findAllByParent($parent);
    public function findBoxleftHasBoxright($boxLeftId);
    public function findBoxleftHasBoxrightParent($boxLeftId);
}
