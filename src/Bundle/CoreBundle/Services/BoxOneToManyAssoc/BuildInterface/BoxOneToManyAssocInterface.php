<?php

namespace CoreBundle\Services\BoxOneToManyAssoc\BuildInterface;

interface BoxOneToManyAssocInterface
{
    public function findAll($limit = null, $offset = null);
    public function search($q, $maxResults = null, $firstResult = null);
    public function findOneById($id);
    public function findBoxleftHasBoxright($boxLeftId);
    public function findBoxRightIdsByBoxLeftValue($boxLeftId);
    public function findAssociatedEntity($boxLeftId, $boxRightId);
}
