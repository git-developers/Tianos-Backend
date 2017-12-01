<?php

namespace CoreBundle\Services\BoxOneToMany\BuildInterface;

interface BoxOneToManyInterface
{
    public function findAll($limit = null, $offset = null);
    public function search($q, $maxResults = null, $firstResult = null);
    public function findOneById($id);
    public function findBoxleftHasBoxright($boxLeftId);
}
