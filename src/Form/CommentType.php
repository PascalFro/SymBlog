<?php

namespace App\Form;

use App\Entity\Comment;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CommentType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add(
                'author',
                TextType::Class, [
                    'label' => "Auteur",
                    'attr' => ['placeholder' => "Auteur du commentaire"]
                ])
            ->add(
                'content',
                TextType::Class, [
                    'label' => "Commentaire",
                    'attr' => ['placeholder' => "Laisser nous votre commentaire..."]
                ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Comment::class,
        ]);
    }
}
