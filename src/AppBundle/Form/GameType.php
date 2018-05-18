<?php
/**
 * Created by PhpStorm.
 * User: wilder16
 * Date: 17/05/18
 * Time: 19:31
 */

namespace AppBundle\Form;

use AppBundle\Entity\Game;
use AppBundle\Entity\Stadium;
use AppBundle\Entity\Team;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class GameType extends AbstractType
{
    /** {@inheritdoc} */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('localTeam', EntityType::class, [
                'class' => Team::class,
                'choice_label' => 'name',
                'label' => 'Equipe locale',
                'required' => true
            ])
            ->add('visitorTeam', EntityType::class, [
                'class' => Team::class,
                'choice_label' => 'name',
                'label' => 'Equipe invitée',
                'required' => true
            ])
            ->add('stadium', EntityType::class, [
                'class' => Stadium::class,
                'choice_label' => "city",
                'label' => 'Stade',
                'required' => true
            ])
            ->add('isPoolGame', CheckboxType::class, [
                'required' => false
            ])
            ->add('beginAt', DateTimeType::class, [
                'date_widget' => 'single_text',
                'required' => true,
            ])
            ->add('isFinished', CheckboxType::class, [
                'required' => false
            ])
        ;
    }

    /** {@inheritdoc} */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Game::class
        ]);
    }
}