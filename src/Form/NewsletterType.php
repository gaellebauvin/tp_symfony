<?php


namespace App\Form;

use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\AbstractType;


class NewsletterType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add(
                'email', EmailType::class, [
                'required' => true,
                'attr' => [

                    'placeholder' => 'Votre email'
                ],
            ])
            ->add(
                'name', TextType::class, [
                'required' => true,
                'attr' => [
                    'placeholder' => 'Votre nom'
                ],
            ]);
    }
}