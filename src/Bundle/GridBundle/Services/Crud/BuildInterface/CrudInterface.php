<?php

namespace Bundle\GridBundle\Services\Crud\BuildInterface;


interface CrudInterface
{
    public function findAll($limit = null, $offset = null);
}
