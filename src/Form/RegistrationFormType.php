<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\IsTrue;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\CallbackTransformer;
use Symfony\Component\Validator\Constraints\Regex;

class RegistrationFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('firstname')
            ->add('lastname')
            ->add('email')
            ->add('roles', ChoiceType::class, [
                'attr' => ['class' => 'roles'],
                'required' => true,
                'multiple' => false,
                'expanded' => true,
                'choices'  => [
                    'Clients' => 'CLIENTS',
                    'Freelance' => 'FREELANCE',
                ],
            ])
            ->add('works', ChoiceType::class, [
                'attr' => ['class' => 'works'],
                'required' => true,
                'multiple' => true,
                'expanded' => true,
                'choices'  => [
                    'Graphisme' => 'GRAPHISTE',
                    'Développement web' => 'DEV_WEB',
                    'Photographie' => 'PHOTO',
                    'Vidéo' => 'VIDEO',
                ],
            ])
            ->add('agreeTerms', CheckboxType::class, [
                'mapped' => false,
                'constraints' => [
                    new IsTrue([
                        'message' => 'Veuillez accepter les conditions d\'utilisations.',
                    ]),
                ],
            ])
            ->add('plainPassword', RepeatedType::class, [
                'label' => 'Password',
                'type' => PasswordType::class,
                'invalid_message' => 'Les mots de passe ne correspondent pas',
                'required' => true,

                'first_options'  => [
                    'label' => 'Mot de passe',
//                    'hash_property_path' => 'password',
                    'attr' => [
                        'placeholder' => 'Entrez votre mot de passe'
                    ],
                    'constraints' => [
                        new NotBlank([
                            'message' => 'Entrez votre mot de passe',
                        ]),
                        new Length([
                            'min' => 6,
                            'minMessage' => 'Votre mot de passe doit contenir min {{ limit }} caractères',
                            'max' => 50,
                        ]),
//                        new Regex([
//                            'message' => 'Le mot de passe doit comprendre au moins 6 caractères, des lettres en majuscules et en minuscules, des chiffres et des caractères spéciaux',
//                            'pattern' => '/^(?=.[0-9])(?=.[a-z])(?=.[A-Z])(?=.\W)(?!.* ).{6,}$/',
//                        ])
                    ],
                ],

                'second_options' => [
                    'label' => 'Confirmation mot de passe',
                    'attr' => ['placeholder' => 'Confirmez votre mot de passe'],
                ],

                'mapped' => false,
            ]);

  // Data transformer
        $builder->get('roles')
            ->addModelTransformer(new CallbackTransformer(
                function ($rolesArray) {
                    // transform the array to a string
                    return count($rolesArray)? $rolesArray[0]: null;
                },
                function ($rolesString) {
                     // transform the string back to an array
                    return [$rolesString];
                }
            ));
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
