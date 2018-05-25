<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

class NewsType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title',TextType::class, array('label' => 'Titre'))
            ->add('content', TextareaType::class, array('label' => 'Description'))
            ->add('inserted_at',DateTimeType::class, array('label' => 'Date d\'ajout'))
            ->add('image', FileType::class, array(
                'label' => 'Image',
                'required' => false
            ))
            ->add('published_at',DateTimeType::class, array('label' => 'Date de publication'));

            //->add('image', FileType::class, array('label' => 'Image (.jpeg)'))
            //->add('video', FileType::class, array('label' => 'Video (.mp4)'));
    }
}