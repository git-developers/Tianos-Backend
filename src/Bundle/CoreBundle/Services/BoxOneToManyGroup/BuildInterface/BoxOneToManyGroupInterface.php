<?php

namespace CoreBundle\Services\BoxOneToManyGroup\BuildInterface;

interface BoxOneToManyGroupInterface
{
    public function findAll($limit = null, $offset = null);
    public function search($q, $maxResults = null, $firstResult = null);
    public function findAllByBoxLeftId($boxLeftId);
}
