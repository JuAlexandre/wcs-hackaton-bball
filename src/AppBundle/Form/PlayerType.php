<?php
/**
 * Created by PhpStorm.
 * User: wilder12
 * Date: 17/05/18
 * Time: 15:20
 */

namespace AppBundle\Form;


use AppBundle\Entity\Club;
use AppBundle\Entity\Player;
use AppBundle\Entity\Team;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\UrlType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * Class PlayerType
 * @package AppBundle\Form
 */
class PlayerType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('firstName', TextType::class, [
                'attr' => [
                    'placeholder' => 'Prénom du joueur'
                ],
                'label' => 'Prénom',
                'required' => true
            ])
            ->add('lastName', TextType::class, [
                'attr' => [
                    'placeholder' => 'Nom du joueur'
                ],
                'label' => 'Nom',
                'required' => true
            ])
            ->add('age', IntegerType::class, [
                'attr' => [
                    'placeholder' => 'Age du joueur'
                ],
                'label' => 'Age',
                'required' => true
            ])
            ->add('shirtNumber', IntegerType::class, [
                'attr' => [
                    'placeholder' => 'Numéro de maillot du joueur'
                ],
                'label' => 'Numéro de maillot',
                'required' => true
            ])
            ->add('picture', UrlType::class, [
                'attr' => [
                    'placeholder' => 'Photo du joueur'
                ],
                'label' => 'Photo',
                'required' => true
            ])
            ->add('club', EntityType::class, [
                'label' => 'Nom du club',
                'class' => Club::class,
                'choice_label' => 'name',
                'required' => true
            ])
            ->add('team', EntityType::class, [
                'label' => 'Nom de l\'équipe pour le championnat',
                'class' => Team::class,
                'choice_label' => 'name',
                'required' => true
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Player::class,
        ]);
    }
}