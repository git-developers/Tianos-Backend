<?php

/*
 * This file is part of the Sylius package.
 *
 * (c) Paweł Jędrzejewski
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types=1);

namespace Component\Grid\View;

use Component\Grid\Definition\Grid;
use Component\Grid\Parameters;

interface GridViewInterface
{
    /**
     * @return mixed
     */
    public function getData();

    /**
     * @return Grid
     */
    public function getDefinition(): Grid;

    /**
     * @return Parameters
     */
    public function getParameters(): Parameters;

    /**
     * @param string $fieldName
     *
     * @return string|null
     */
    public function getSortingOrder(string $fieldName): ?string;

    /**
     * @param string $fieldName
     *
     * @return bool
     */
    public function isSortedBy(string $fieldName): bool;
}
