<?php

namespace Bundle\PointofsaleBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Doctrine\ORM\EntityRepository;
use Bundle\PointofsaleBundle\Entity\Pointofsale;

class PointofsaleType extends AbstractType
{

    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {

        $builder
            ->add('pointOfSale', EntityType::class, [
                'class' => PointOfSale::class,
                'query_builder' => function(EntityRepository $er) {
                    return $er->findAllObjects();
                },
                'placeholder' => '[ Escoge una opción ]',
                'empty_data' => null,
                'required' => false,
                'label' => 'Punto de venta padre',
                'label_attr' => [
                    'class' => ''
                ],
                'attr' => [
                    'class' => 'form-control',
                    'placeholder' => '',
                ],
            ])
            ->add('code', TextType::class, [
                'label' => 'code',
                'label_attr' => [
                    'class' => ''
                ],
                'attr' => [
                    'class' => 'form-control',
                    'placeholder' => 'code',
                ],
            ])
            ->add('name', TextType::class, [
                'label' => 'Nombre',
                'label_attr' => [
                    'class' => ''
                ],
                'attr' => [
                    'class' => 'form-control',
                    'placeholder' => 'nombre',
                ],
            ])
            ->add('latitude', NumberType::class, [
                'label' => 'latitude',
                'label_attr' => [
                    'class' => ''
                ],
                'attr' => [
                    'class' => 'form-control',
                    'placeholder' => 'nombre',
                ],
            ])
            ->add('longitude', NumberType::class, [
                'label' => 'longitude',
                'label_attr' => [
                    'class' => ''
                ],
                'attr' => [
                    'class' => 'form-control',
                    'placeholder' => 'nombre',
                ],
            ])
        ;
    }
    
    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
//            'data_class' => Pointofsale::class,
        ]);

        $resolver->setRequired(['form_data']);
    }

}
