<?php

namespace Bundle\BookingBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TimeType;
use Symfony\Component\Form\Extension\Core\Type\SearchType;
use Doctrine\ORM\EntityManager;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Doctrine\ORM\EntityRepository;
use Bundle\UserBundle\Entity\User;

class BookingType extends AbstractType
{

    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
	
	    $dateBook = [];
	    if (isset($options['form_data']['dateBook'])) {
		    $dateBook = [
			    'data' => new \DateTime($options['form_data']['dateBook']),
		    ];
	    }
    	
        $builder
	        ->add('client', EntityType::class, [
		        'class' => User::class,
		        'query_builder' => function(EntityRepository $er) {
			        return $er->findAllObjects();
		        },
		        'placeholder' => '[ Escoja una opción ]',
		        'empty_data' => null,
		        'required' => false,
		        'label' => 'Cliente',
		        'label_attr' => [
			        'class' => ''
		        ],
		        'attr' => [
			        'class' => 'form-control',
			        'placeholder' => '',
		        ],
	        ])
            ->add('dateBook', DateType::class, array_merge(
	            [
		            'label' =>' Fecha',
		            'required' => true,
		            'html5' => true,
		            'widget' => 'single_text',
		            'label_attr' => [
			            'class' => ''
		            ],
		            'attr' => [
			            'class' => 'form-control',
			            'placeholder' => 'code',
		            ],
	            ],
	            $dateBook
            ))
            ->add('timeInBook', TimeType::class, [
                'label' =>' Hora inicio',
	            'required' => true,
                'label_attr' => [
                    'class' => ''
                ],
                'attr' => [
                    'class' => 'form-control',
                    'placeholder' => 'code',
                ],
            ])
            ->add('timeOutBook', TimeType::class, [
                'label' =>' Hora fin',
	            'required' => true,
                'label_attr' => [
                    'class' => ''
                ],
                'attr' => [
                    'class' => 'form-control',
                    'placeholder' => 'code',
                ],
            ])
//            ->add('code', TextType::class, [
//                'label' =>' code',
//                'label_attr' => [
//                    'class' => ''
//                ],
//                'attr' => [
//                    'class' => 'form-control',
//                    'placeholder' => 'code',
//                ],
//            ])
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
        ;
    }
    
    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
//            'data_class' => Booking::class,
        ]);

        $resolver->setRequired(['form_data']);
    }

}
