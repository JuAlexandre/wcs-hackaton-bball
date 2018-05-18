<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\UrlType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * Class StadiumType
 * @package AppBundle\Form
 */
class StadiumType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('city', TextType::class, [
                'attr' => [
                    'placeholder' => 'Ville du stade'
                ],
                'label' => 'Ville du stade',
                'required' => true
            ])
            ->add('capacity', IntegerType::class, [
                'attr' => [
                    'placeholder' => 'Capacité du stade'
                ],
                'label' => 'Capacité du stade',
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
            'data_class' => 'AppBundle\Entity\Stadium'
        ));
    }
}
