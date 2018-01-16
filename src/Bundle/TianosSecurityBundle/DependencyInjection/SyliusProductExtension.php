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

namespace Bundle\CRUD_DUMMYBundle\DependencyInjection;

use Bundle\CRUD_DUMMYBundle\Controller\CRUD_DUMMYAttributeController;
use Bundle\CRUD_DUMMYBundle\Doctrine\ORM\CRUD_DUMMYAttributeValueRepository;
use Bundle\CRUD_DUMMYBundle\Form\Type\CRUD_DUMMYAttributeTranslationType;
use Bundle\CRUD_DUMMYBundle\Form\Type\CRUD_DUMMYAttributeType;
use Bundle\CRUD_DUMMYBundle\Form\Type\CRUD_DUMMYAttributeValueType;
use Bundle\ResourceBundle\DependencyInjection\Extension\AbstractResourceExtension;
use Component\CRUD_DUMMY\Model\CRUD_DUMMYAttribute;
use Component\CRUD_DUMMY\Model\CRUD_DUMMYAttributeInterface;
use Component\CRUD_DUMMY\Model\CRUD_DUMMYAttributeTranslation;
use Component\CRUD_DUMMY\Model\CRUD_DUMMYAttributeTranslationInterface;
use Component\CRUD_DUMMY\Model\CRUD_DUMMYAttributeValue;
use Component\CRUD_DUMMY\Model\CRUD_DUMMYAttributeValueInterface;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Extension\PrependExtensionInterface;
use Symfony\Component\DependencyInjection\Loader\XmlFileLoader;

final class SyliusCRUD_DUMMYExtension extends AbstractResourceExtension implements PrependExtensionInterface
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
                            'model' => CRUD_DUMMYAttribute::class,
                            'interface' => CRUD_DUMMYAttributeInterface::class,
                            'controller' => CRUD_DUMMYAttributeController::class,
                            'form' => CRUD_DUMMYAttributeType::class,
                        ],
                        'translation' => [
                            'classes' => [
                                'model' => CRUD_DUMMYAttributeTranslation::class,
                                'interface' => CRUD_DUMMYAttributeTranslationInterface::class,
                                'form' => CRUD_DUMMYAttributeTranslationType::class,
                            ],
                        ],
                    ],
                    'attribute_value' => [
                        'classes' => [
                            'model' => CRUD_DUMMYAttributeValue::class,
                            'interface' => CRUD_DUMMYAttributeValueInterface::class,
                            'repository' => CRUD_DUMMYAttributeValueRepository::class,
                            'form' => CRUD_DUMMYAttributeValueType::class,
                        ],
                    ],
                ],
            ],
        ]);
    }
}
