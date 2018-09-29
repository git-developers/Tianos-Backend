<?php

namespace Bundle\ProductBundle\Form\Type;

use Bundle\CategoryBundle\Entity\Category;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Doctrine\ORM\EntityManager;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Doctrine\ORM\EntityRepository;

class ProductType extends AbstractType
{

    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {

        $category_choices = array(
            array('Category 1' => array(
                '1' => 'Option 1...',
                '2' => 'Option 2...',
                '3' => 'Option 3...'
            )),
            array('Category 2' => array(
                '4' => 'Option 4...',
                '5' => 'Option 5...'
            ))
        );

        $builder
//            ->add('category', ChoiceType::class, array(
//                'label' => 'Category',
//                'choices' => $category_choices,
//                'placeholder' => '[ Escoge una opción ]',
//                'empty_data' => null,
//                'required' => false,
//                'label' => 'Categoría',
//                'label_attr' => [
//                    'class' => ''
//                ],
//                'attr' => [
//                    'class' => 'form-control',
//                    'placeholder' => '',
//                ],
//            ))
            ->add('category', EntityType::class, [
                'class' => Category::class,
                'query_builder' => function(EntityRepository $er) {
                    return $er->findAllObjects();
                },
                'placeholder' => '[ Escoge una opción ]',
                'empty_data' => null,
                'required' => false,
                'label' => 'Categoría',
                'label_attr' => [
                    'class' => ''
                ],
                'attr' => [
                    'class' => 'form-control',
                    'placeholder' => '',
                ],
            ])
            ->add('code', TextType::class, [
                'label' =>' code',
                'label_attr' => [
                    'class' => ''
                ],
                'attr' => [
                    'class' => 'form-control',
                    'placeholder' => 'code',
                ],
            ])
            ->add('name', TextType::class, [
                'label' =>' Nombre',
                'label_attr' => [
                    'class' => ''
                ],
                'attr' => [
                    'class' => 'form-control',
                    'placeholder' => 'nombre',
                ],
            ])
            ->add('stock', IntegerType::class, [
                'label' =>' Stock',
                'label_attr' => [
                    'class' => ''
                ],
                'attr' => [
                    'class' => 'form-control',
                    'placeholder' => '##',
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
//            'data_class' => Product::class,
        ]);

        $resolver->setRequired(['form_data']);
    }

}
