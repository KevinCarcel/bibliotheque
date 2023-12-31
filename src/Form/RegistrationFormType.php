<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Validator\Constraints\File;
use Symfony\Component\Validator\Constraints\Image;
use Symfony\Component\Validator\Constraints\IsTrue;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;

class RegistrationFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('email',EmailType::class,[
                'attr'=>[
                    'class'=>'form-control',
                    'minLenght'=>'2',
                    'maxLenght'=>'50'
                    ],
                    'label'=> 'Adresse email',
                    'label_attr'=> [
                        'class'=> 'form-label',
                    ],
                    'constraints'=>[
                        new Assert\NotBlank(),
                        new Assert\Email(),
                        new Assert\Length(['min'=> 2,'max'=> 50])
                        ]
            ])
            ->add('nom',TextType::class,[
                'attr'=> [
                    'class'=> 'form-control',
                    'minLenght'=> '2',
                    'maxLenght'=> '50'
                    ],
                    'label'=> 'Nom',
                    'label_attr'=> [
                        'class'=> 'form-label',
                        ],
                        'constraints'=> [
                            new Assert\Length(['min'=>2,'max'=>50])
                            ]
            ])
            ->add('prenom',TextType::class,[
                'attr'=> [
                    'class'=> 'form-control',
                    'minLenght'=> '2',
                    'maxLenght'=> '50'
                    ],
                    'label'=> 'Prenom',
                    'label_attr'=> [
                        'class'=> 'form-label',
                        ],
                        'constraints'=> [
                            new Assert\Length(['min'=>2,'max'=>50])
                            ]
            ])
            ->add('pseudo',TextType::class,[
                'attr'=> [
                    'class'=> 'form-control',
                    'minLenght'=> '2',
                    'maxLenght'=> '50'
                    ],
                    'label'=> 'Pseudo',
                    'label_attr'=> [
                        'class'=> 'form-label',
                        ],
                        'constraints'=> [
                            new Assert\Length(['min'=>2,'max'=>50])
                            ]
            ])
            ->add('agreeTerms', CheckboxType::class, [
                'label'=>'RGPD',
                'label_attr'=> [
                    'class'=> 'decale',
                    ],
                'mapped' => false,
                'constraints' => [
                    new IsTrue([
                        'message' => 'You should agree to our terms.',
                    ]),
                ],
            ])
            ->add('plainPassword', PasswordType::class, [
                // instead of being set onto the object directly,
                // this is read and encoded in the controller
                
                    
                'label'=> 'Mot de passe',
                'label_attr'=> [
                'class'=> 'form-label'
                ],
                'mapped' => false,
                'attr' => ['autocomplete' => 'new-password','class'=> 'form-control',],
                'constraints' => [
                    new NotBlank([
                        'message' => 'Please enter a password',
                    ]),
                    new Length([
                        'min' => 6,
                        'minMessage' => 'Your password should be at least {{ limit }} characters',
                        // max length allowed by Symfony for security reasons
                        'max' => 4096,
                    ]),
                ],
            ])
            ->add('photoProfil', FileType::class, [
                'attr'=>[
                    'class'=> 'form-control'],
                                'required' => false,
                                'mapped' => false,
                                'constraints' => [
                                new Image(['maxSize' => '1024k'])
                                ],
                                'label'=>'Photo Profil',
                    'label_attr'=> [
                        'class'=> 'form-label mt-4']
                    ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}