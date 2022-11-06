<?php

namespace App\Form;

use App\Entity\JasonCrew;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class CrewFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
        ->add('name', TextType::class, [
            'label' => "Nom de l'Argonaute",
            'constraints' => [
                new NotBlank([
                    'message' => 'Ce champ ne doit pas être vide'
                ])
            ]
        ])
        ->add('submit', SubmitType::class, [
            'label' => "Ajouter ce membre d'équipage",
            'validate' => false,
            'attr' => [
                'class' => 'btn btn-lg no-border-radius',
                'style' => 'padding-left: 2.5rem; padding-right: 2.5rem ;color: white; background-color: rgb(247, 108, 108)'
            ]
        ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => JasonCrew::class,
        ]);
    }
}
