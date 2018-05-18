<?php

namespace AppBundle\Form;

use AppBundle\Entity\Player;
use AppBundle\Entity\Pool;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\UrlType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * Class TeamType
 * @package AppBundle\Form
 */
class TeamType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', TextType::class, [
                'attr' => [
                    'placeholder' => 'Nom de l\'équipe'
                ],
                'label' => 'Nom de l\'équipe',
                'required' => true
            ])
            ->add('flag', UrlType::class, [
                'attr' => [
                    'placeholder' => 'Lien vers le drapeau du pays'
                ],
                'label' => 'Drapeau du pays',
                'required' => true
            ])
            ->add('pool', EntityType::class, [
                'class' => Pool::class,
                'choice_label' => 'name',
                'required' => true
            ])
        ;
    }

    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\Team'
        ));
    }
}
