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

namespace Component\OneToMany\Data;

use Component\OneToMany\Definition\OneToMany;
use Component\OneToMany\Parameters;

interface DataSourceProviderInterface
{
    /**
     * @param OneToMany $grid
     * @param Parameters $parameters
     *
     * @return DataSourceInterface
     */
    public function getDataSource(OneToMany $grid, Parameters $parameters): DataSourceInterface;
}
