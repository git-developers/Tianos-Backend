<?php

namespace CoreBundle\Services\TreeToAssign\BuildInterface;

interface TreeToAssignInterface
{
    public function findBoxleftHasBoxright($boxLeftId);
    public function findBoxRightIdsByBoxLeftValue($boxLeftId);
    public function findAssociatedEntity($boxLeftId, $boxRightId);
}
