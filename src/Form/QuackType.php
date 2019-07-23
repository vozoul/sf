<?php

namespace App\Form;

use App\Entity\Quack;
use App\Entity\Tags;
use http\Client\Curl\User;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class QuackType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title')
            ->add('imageFile', FileType::class, [
                'required' => false,
            ])
            ->add('content')
            ->add('author', HiddenType::class)
            ->add('myTags', EntityType::class, [
                'required' => false,
                'label' => 'Tags',
                'class' => Tags::class,
                'choice_label' => 'name',
                'multiple' => true
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Quack::class,
            'translation_domain' => 'forms'
        ]);
    }
}
