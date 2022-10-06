<?php

namespace App\Form;

use App\Entity\GRStand;
use App\Entity\GRTypeStand;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;

class GRStandType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('uuid', HiddenType::class)
            ->add('NomStand')
            ->add('PositionX')
            ->add('PositionY')
            // ->add('qr_code')
            ->add(
                'Type',
                EntityType::class,
                [
                    'class' => GRTypeStand::class,
                    // 'label' => false,
                    // 'expanded' => true,
                    'required' => true,
                    'multiple' => false,
                    'mapped' => false,
                    // 'label_html' => true,
                    'choice_label' => function (GRTypeStand $type) {
                        $type = $type->getNomType();
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
            'data_class' => GRStand::class,
        ]);
    }
}
