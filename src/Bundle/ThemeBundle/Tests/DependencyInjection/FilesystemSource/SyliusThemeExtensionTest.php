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

namespace Bundle\ThemeBundle\Tests\DependencyInjection\FilesystemSource;

use Matthias\SymfonyDependencyInjectionTest\PhpUnit\AbstractExtensionTestCase;
use Bundle\ThemeBundle\Configuration\Filesystem\FilesystemConfigurationSourceFactory;
use Bundle\ThemeBundle\DependencyInjection\SyliusThemeExtension;

final class SyliusThemeExtensionTest extends AbstractExtensionTestCase
{
    /**
     * @test
     */
    public function it_does_not_register_a_provider_while_it_is_disabled(): void
    {
        $this->load(['sources' => ['filesystem' => false]]);

        $this->assertContainerBuilderHasServiceDefinitionWithArgument(
            'sylius.theme.configuration.provider',
            0,
            []
        );
    }

    /**
     * {@inheritdoc}
     */
    protected function getContainerExtensions(): array
    {
        $themeExtension = new SyliusThemeExtension();
        $themeExtension->addConfigurationSourceFactory(new FilesystemConfigurationSourceFactory());

        return [$themeExtension];
    }
}
