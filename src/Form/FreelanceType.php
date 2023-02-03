<?php

namespace App\Form;

use App\Entity\Freelance;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class FreelanceType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('categories', ChoiceType::class, [
                'required' => true,
                'multiple' => true,
                'expanded' => true,
                'choices'  => [
                    'Développeur web back-end' => 'CATEGORIES',
                    'Développeur web front-end' => 'CATEGORIES',
                    'Développeur CMS' => 'CATEGORIES',
                    'Intégrateur web' => 'CATEGORIES',
                    'Web designer' => 'CATEGORIES',
                    'Photographe' => 'CATEGORIES',
                    'Monteur vidéo' => 'CATEGORIES',
                    'Réalisateur' => 'CATEGORIES',
                    'Caméraman' => 'CATEGORIES',
                    'Preneur de son' => 'CATEGORIES',
                ],
            ])
            ->add('experience', ChoiceType::class, [
                'required' => true,
                'multiple' => false,
                'expanded' => true,
                'choices'  => [
                    '0 à 2 ans' => 'EXPERIENCE',
                    '2 à 7 ans' => 'EXPERIENCE',
                    '7 ans et +' => 'EXPERIENCE',
                ],
            ])
            ->add('skills', ChoiceType::class, [
                'required' => true,
                'multiple' => true,
                'expanded' => true,
                'choices'  => [
                    'HTML' => 'SKILLS',
                    'CSS' => 'SKILLS',
                    'JavaScript' => 'SKILLS',
                    'React' => 'SKILLS',
                    'Symfony' => 'SKILLS',
                    'Angular' => 'SKILLS',
                ],
            ])
            ->add('localisation')
            ->add('choiceLocalisation', ChoiceType::class, [
                'required' => true,
                'multiple' => false,
                'expanded' => false,
                'choices'  => [
                    'Chez les clients et à distance' => 'CHOICE_LOCALISATION',
                    'À distance' => 'CHOICE_LOCALISATION',
                ],
            ])
            ->add('freePhone')
            ->add('presentation')
            ->add('description')
            ->add('photo')
            ->add('portfolio')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Freelance::class,
        ]);
    }
}
