<?php

namespace App\Form;

use App\Entity\GRQuizz;
use App\Entity\GRStand;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\FileType;

class GRQuizzType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('Question')
            ->add('Reponse1')
            ->add('Reponse2')
            ->add('Reponse3')
            ->add('Reponse4')
            ->add('BonneReponse')
            ->add('points')
            ->add('GRImage', FileType::class, [
                'label' => 'image',
                'multiple' => false,
                'mapped' => false,
                'required' => false
            ])
            ->add(
                'GRStand',
                EntityType::class,
                [
                    'class' => GRStand::class,
                    // 'label' => false,
                    // 'expanded' => true,
                    'required' => true,
                    'multiple' => false,
                    'mapped' => false,
                    // 'label_html' => true,
                    'choice_label' => function (GRStand $type) {
                        $type = $type->getNomStand();
                        // if ($etat_reservation == false) {
                        return $type;
                        // }
                    }
                ]
            );
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => GRQuizz::class,
        ]);
    }
}
