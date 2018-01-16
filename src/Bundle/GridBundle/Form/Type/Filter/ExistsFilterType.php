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

namespace Bundle\GridBundle\Form\Type\Filter;

use Component\Grid\Filter\ExistsFilter;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\OptionsResolver\OptionsResolver;

final class ExistsFilterType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver
            ->setDefaults([
                'choices' => [
                    'sylius.ui.no_label' => ExistsFilter::FALSE,
                    'sylius.ui.yes_label' => ExistsFilter::TRUE,
                ],
                'choice_values' => [
                    ExistsFilter::FALSE,
                    ExistsFilter::TRUE,
                ],
                'data_class' => null,
                'required' => false,
                'placeholder' => false,
            ])
        ;
    }

    /**
     * {@inheritdoc}
     */
    public function getParent(): string
    {
        return ChoiceType::class;
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix(): string
    {
        return 'sylius_grid_filter_exists';
    }
}
