<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class RegistrationType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add(
                'email',
                TextType::Class, [
                    'label' => "Email",
                    'attr' => ['placeholder' => "Votre adresse Email"]
                ])
            ->add(
                'username',
                TextType::Class, [
                    'label' => "Identifiant",
                    'attr' => ['placeholder' => "Votre Nom d'utilisateur"]
                ])
            ->add(
                'password',
                PasswordType::Class, [
                    'label' => "Mot de passe",
                    'attr' => ['placeholder' => "Votre mot de passe"]
                ])
            ->add(
                'confirm_password',
                PasswordType::Class, [
                    'label' => "Confirmation du mot de passe",
                    'attr' => ['placeholder' => "Confirmez votre mot de passe"]
                ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
