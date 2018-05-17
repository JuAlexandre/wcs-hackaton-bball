<?php

namespace AppBundle\Form;

use AppBundle\Entity\Club;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\UrlType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ClubType extends AbstractType
{
    /** {@inheritdoc} */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', TextType::class, [
                'attr' => [
                    'placeholder' => 'Nom du club'
                ],
                'label' => 'Nom',
                'required' => true
            ])
            ->add('image', UrlType::class, [
                'attr' => [
                    'placeholder' => 'Lien vers l\'image'
                ],
                'label' => 'Image',
                'required' => true
            ])
        ;
    }

    /** {@inheritdoc} */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Club::class
        ]);
    }
}
