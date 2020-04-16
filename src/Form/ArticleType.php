<?php

namespace App\Form;

use App\Entity\Article;
use App\Entity\Category;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ArticleType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add(
                'title',
                TextType::Class, [
                    'label' => "Titre",
                    'attr' => ['placeholder' => "Titre de l'article"]
                ])
            ->add(
                'category',
                EntityType::Class, [
                    'class' => Category::Class,
                    'choice_label' => 'title'
                ])
            ->add(
                'content',
                TextareaType::Class, [
                    'label' => "Contenu",
                    'attr' => ['placeholder' => "Contenu de l'article"]
                ])
            ->add(
                'image',
                TextType::Class, [
                    'label' => "Image",
                    'attr' => ['placeholder' => "Image de l'article"]
                ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Article::class,
        ]);
    }
}
