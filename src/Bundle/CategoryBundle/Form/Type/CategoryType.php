<?php

namespace Bundle\CategoryBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityRepository;
use Bundle\CategoryBundle\Entity\Category;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;


class CategoryType extends AbstractType
{
    protected $em;
    protected $parentId;

    public function __construct(EntityManager $em) {
        $this->em = $em;
    }

    public function getParentItem($id) {
        return $this->em->getRepository(Category::class)->find($id);
    }

    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
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
        ;

        $em = $this->em;
        $builder->addEventListener(FormEvents::PRE_SET_DATA, function (FormEvent $event) use ($em) {
            $data = $event->getData();
            $form = $event->getForm();

            $options = [
                'class' => Category::class,
                'query_builder' => function(EntityRepository $er) {
                    return $er->findAllObjects();
                },
                'placeholder' => '[ Escoge una opción ]',
                'empty_data' => null,
                'required' => false,
                'label' => 'category',
                'label_attr' => [
                    'class' => ''
                ],
                'attr' => [
                    'class' => 'form-control',
                    'placeholder' => '',
                ],
            ];

            if($this->parentId != null){
                $data = ['data' => $this->getParentItem($this->parentId)];
                $options = array_merge($options, $data);
            }

            $form->add('category', EntityType::class, $options);

        });
    }
    
    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
//            'data_class' => Category::class,
        ]);

        $resolver->setRequired(['form_data']);
    }

}
