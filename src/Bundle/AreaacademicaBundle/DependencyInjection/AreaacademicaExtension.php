<?php

declare(strict_types=1);

namespace Bundle\AreaacademicaBundle\DependencyInjection;

use Bundle\AreaacademicaBundle\Controller\ProductAttributeController;
use Bundle\AreaacademicaBundle\Doctrine\ORM\ProductAttributeValueRepository;
use Bundle\AreaacademicaBundle\Form\Type\ProductAttributeTranslationType;
use Bundle\AreaacademicaBundle\Form\Type\ProductAttributeType;
use Bundle\AreaacademicaBundle\Form\Type\ProductAttributeValueType;
use Bundle\ResourceBundle\DependencyInjection\Extension\AbstractResourceExtension;
use Component\Product\Model\ProductAttribute;
use Component\Product\Model\ProductAttributeInterface;
use Component\Product\Model\ProductAttributeTranslation;
use Component\Product\Model\ProductAttributeTranslationInterface;
use Component\Product\Model\ProductAttributeValue;
use Component\Product\Model\ProductAttributeValueInterface;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Extension\PrependExtensionInterface;
use Symfony\Component\DependencyInjection\Loader\XmlFileLoader;

final class AreaacademicaExtension extends AbstractResourceExtension implements PrependExtensionInterface
{
    /**
     * {@inheritdoc}
     */
    public function load(array $config, ContainerBuilder $container): void
    {
        $config = $this->processConfiguration($this->getConfiguration([], $container), $config);
        $loader = new XmlFileLoader($container, new FileLocator(__DIR__ . '/../Resources/config'));

        $loader->load(sprintf('services/integrations/%s.xml', $config['driver']));

        $this->registerResources('sylius', $config['driver'], $config['resources'], $container);

        $loader->load('services.xml');
    }

    /**
     * {@inheritdoc}
     */
    public function prepend(ContainerBuilder $container): void
    {
        $config = $this->processConfiguration(new Configuration(), $container->getExtensionConfig($this->getAlias()));

        $this->prependAttribute($container, $config);
    }

    /**
     * @param ContainerBuilder $container
     * @param array $config
     */
    private function prependAttribute(ContainerBuilder $container, array $config): void
    {
        if (!$container->hasExtension('sylius_attribute')) {
            return;
        }

        $container->prependExtensionConfig('sylius_attribute', [
            'resources' => [
                'product' => [
                    'subject' => $config['resources']['product']['classes']['model'],
                    'attribute' => [
                        'classes' => [
                            'model' => ProductAttribute::class,
                            'interface' => ProductAttributeInterface::class,
                            'controller' => ProductAttributeController::class,
                            'form' => ProductAttributeType::class,
                        ],
                        'translation' => [
                            'classes' => [
                                'model' => ProductAttributeTranslation::class,
                                'interface' => ProductAttributeTranslationInterface::class,
                                'form' => ProductAttributeTranslationType::class,
                            ],
                        ],
                    ],
                    'attribute_value' => [
                        'classes' => [
                            'model' => ProductAttributeValue::class,
                            'interface' => ProductAttributeValueInterface::class,
                            'repository' => ProductAttributeValueRepository::class,
                            'form' => ProductAttributeValueType::class,
                        ],
                    ],
                ],
            ],
        ]);
    }
}
