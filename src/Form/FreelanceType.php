<?php

namespace App\Form;

use App\Entity\Freelance;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\File;

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
                    'Développeur web back-end' => 'Dev web BE',
                    'Développeur web front-end' => 'Dev web FE',
                    'Développeur CMS' => 'Dev CMS',
                    'Intégrateur web' => 'Intégrateur',
                    'Web designer' => 'Web design',
                    'Photographe' => 'Photographe',
                    'Monteur vidéo' => 'Monteur V',
                    'Réalisateur' => 'Réal',
                    'Caméraman' => 'Cam',
                    'Preneur de son' => 'Preneur son',
                ],
            ])
            ->add('experience', ChoiceType::class, [
                'required' => true,
                'multiple' => false,
                'expanded' => true,
                'choices'  => [
                    '0 à 2 ans' => '0/2',
                    '2 à 7 ans' => '2/7',
                    '7 ans et +' => '7+',
                ],
            ])
            ->add('skills', ChoiceType::class, [
                'required' => true,
                'multiple' => true,
                'expanded' => true,
                'choices'  => [
                    'HTML' => 'HTML',
                    'CSS' => 'CSS',
                    'JavaScript' => 'JS',
                    'React' => 'React',
                    'Symfony' => 'Symfony',
                    'Angular' => 'Angular',
                ],
            ])
            ->add('localisation')
            ->add('choiceLocalisation', ChoiceType::class, [
                'required' => true,
                'multiple' => false,
                'expanded' => false,
                'choices'  => [
                    'Chez les clients et à distance' => 'Clients/distance',
                    'À distance' => 'Distance',
                ],
            ])
            ->add('freePhone')
            ->add('presentation')
            ->add('description')
            ->add('photo', FileType::class, [
                'label' => 'Photo (JPG/PNG file)',
                'mapped' => false,
                'required' => false,

                'constraints' => [
                    new File([
                        'maxSize' => '1024k',
                        'mimeTypes' => [
                            'image/jpeg',
                            'image/png',
                        ],
                        'mimeTypesMessage' => 'Veuillez télécharger un fichier JPG ou PNG valide',
                    ])
                ],
            ])
            ->add('portfolio', FileType::class, [
                'label' => 'Photo (JPG file)',
                'mapped' => false,
                'required' => false,

                'constraints' => [
                    new File([
                        'maxSize' => '1024k',
                        'mimeTypes' => [
                            'image/jpeg',
                        ],
                        'mimeTypesMessage' => 'Veuillez télécharger un fichier JPG valide',
                    ])
                ],
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Freelance::class,
        ]);
    }
}
