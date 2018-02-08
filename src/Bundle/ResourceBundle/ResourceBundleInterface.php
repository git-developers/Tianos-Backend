<?php

declare(strict_types=1);

namespace Bundle\ResourceBundle;

interface ResourceBundleInterface
{
    public const MAPPING_XML = 'xml';
    public const MAPPING_YAML = 'yaml';
    public const MAPPING_ANNOTATION = 'annotation';

    /**
     * Returns a vector of supported drivers.
     *
     * @see ResourceBundle::DRIVER_DOCTRINE_ORM
     * @see ResourceBundle::DRIVER_DOCTRINE_MONGODB_ODM
     * @see ResourceBundle::DRIVER_DOCTRINE_PHPCR_ODM
     *
     * @return array
     */
    public function getSupportedDrivers(): array;
}
