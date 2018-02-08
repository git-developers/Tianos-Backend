<?php

namespace CoreBundle\Services\Template\BuildInterface;

interface TemplateInterface
{
    public function findAll($limit = null, $offset = null);
    public function findActiveTemplate($id);
}
