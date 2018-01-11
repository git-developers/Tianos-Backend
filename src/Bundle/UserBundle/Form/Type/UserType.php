<?php

declare(strict_types=1);

namespace Bundle\UserBundle\Form\Type;

use Bundle\ResourceBundle\Form\Type\AbstractResourceType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

abstract class UserType extends AbstractResourceType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('username', TextType::class, [
                'label' => 'sylius.form.user.username',
            ])
            ->add('email', EmailType::class, [
                'label' => 'sylius.form.user.email',
            ])
            ->add('plainPassword', PasswordType::class, [
                'label' => 'sylius.form.user.password.label',
            ])
            ->add('enabled', CheckboxType::class, [
                'label' => 'sylius.form.user.enabled',
            ])
        ;
    }

    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver
            ->setDefaults([
                'data_class' => $this->dataClass,
                'validation_groups' => function (FormInterface $form): array {
                    $data = $form->getData();
                    if ($data && !$data->getId()) {
                        $this->validationGroups[] = 'sylius_user_create';
                    }

                    return $this->validationGroups;
                },
            ])
        ;
    }
}
