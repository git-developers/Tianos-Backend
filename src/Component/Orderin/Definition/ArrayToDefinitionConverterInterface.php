<?php

declare(strict_types=1);

namespace Component\Orderin\Definition;

interface ArrayToDefinitionConverterInterface
{
    /**
     * @param string $code
     * @param array $configuration
     *
     * @return Orderin
     */
    public function convert(string $code, array $configuration): Orderin;
}
