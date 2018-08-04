<?php

declare(strict_types=1);

namespace Bundle\ThemeBundle;

use Bundle\ThemeBundle\Configuration\Filesystem\FilesystemConfigurationSourceFactory;
use Bundle\ThemeBundle\Configuration\Test\TestConfigurationSourceFactory;
use Bundle\ThemeBundle\DependencyInjection\SyliusThemeExtension;
use Bundle\ThemeBundle\Translation\DependencyInjection\Compiler\TranslatorFallbackLocalesPass;
use Bundle\ThemeBundle\Translation\DependencyInjection\Compiler\TranslatorLoaderProviderPass;
use Bundle\ThemeBundle\Translation\DependencyInjection\Compiler\TranslatorResourceProviderPass;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\HttpKernel\Bundle\Bundle;

final class ThemeBundle extends Bundle
{
    
    /**
     * {@inheritdoc}
     */
    public function build(ContainerBuilder $container): void
    {
        /** @var SyliusThemeExtension $themeExtension */
//        $themeExtension = $container->getExtension('sylius_theme');
//        $themeExtension->addConfigurationSourceFactory(new FilesystemConfigurationSourceFactory());
//        $themeExtension->addConfigurationSourceFactory(new TestConfigurationSourceFactory());

        $container->addCompilerPass(new TranslatorFallbackLocalesPass());
        $container->addCompilerPass(new TranslatorLoaderProviderPass());
        $container->addCompilerPass(new TranslatorResourceProviderPass());
    }
}
