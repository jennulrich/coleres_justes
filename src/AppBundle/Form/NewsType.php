<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

class NewsType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title',TextType::class, array('label' => 'Titre de la news'))
            ->add('content', TextareaType::class, array('label' => 'Description'))
            ->add('inserted_at',DateTimeType::class, array('label' => 'Date d\'ajout'))
            ->add('published_at',DateTimeType::class, array('label' => 'Date de publication'));

            //->add('image', FileType::class, array('label' => 'Image (.jpeg)'))
            //->add('video', FileType::class, array('label' => 'Video (.mp4)'));
    }
}