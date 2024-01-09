<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\File;
use Symfony\Component\Validator\Constraints\IsTrue;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;

class RegistrationFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('email',EmailType::class,[
                'label' => 'Email',
                'attr' => [
                    //'placeholder' => 'Email'
                ],
                'constraints' => [
                    new NotBlank([
                        'message' => 'Please enter a email',
                    ]),
                    new Length([
                        'min' => 4,
                        'minMessage' => 'Your email should be at least {{ limit }} characters',
                        // max length allowed by Symfony for security reasons
                        'max' => 256,
                    ]),
                ],
                
            ])
            /*->add('agreeTerms', CheckboxType::class, [
                                'mapped' => false,
                'constraints' => [
                    new IsTrue([
                        'message' => 'You should agree to our terms.',
                    ]),
                ],
            ])*/
            ->add('plainPassword', PasswordType::class, [
                                // instead of being set onto the object directly,
                // this is read and encoded in the controller
                'mapped' => false,
                'attr' => ['autocomplete' => 'new-password'],
                'constraints' => [
                    new NotBlank([
                        'message' => 'Please enter a password',
                    ]),
                    new Length([
                        'min' => 6,
                        'minMessage' => 'Your password should be at least {{ limit }} characters',
                        // max length allowed by Symfony for security reasons
                        'max' => 256,
                    ]),
                ],
            ])
            ->add('plainPassword',RepeatedType::class,[
                'type' => PasswordType::class,
                'mapped' => false,
                'first_options'  => ['label' => 'Password'],
                'second_options' => ['label' => 'Confirm Password'],
                'invalid_message' => 'The password fields must match.',
                ])
            ->add('artist_name',TextType::class,[
                'constraints' => [
                    new NotBlank([
                        'message' => 'Please enter a Artist name',
                    ]),
                    new Length([
                        'min' => 1,
                        'minMessage' => 'Your password should be at least {{ limit }} characters',
                        // max length allowed by Symfony for security reasons
                        'max' => 256,
                    ]),
                ],
            ]
                )
            ->add('real_name')
            ->add('description')
            ->add('image', FileType::class, [
                'label' => 'Image (JPG, PNG, JPEG)',
                'mapped' => true,
                'required' => false,
                'constraints' => [
                    new File([
                        'maxSize' => '1024k',
                        'mimeTypes' => [
                            'image/jpeg',
                            'image/png',
                            'image/gif',
                        ],
                        'mimeTypesMessage' => 'Please upload a valid image file',
                    ])   
                ],
            ])
                
            ->add('interrested_in_styles',ChoiceType::class,[
                'choices' => [
                    'Rock' => 'Rock',
                    'Pop' => 'Pop',
                    'Rap' => 'Rap',
                    'Hip-Hop' => 'Hip-Hop',
                    'RnB' => 'RnB',
                    'Jazz' => 'Jazz',
                    'Blues' => 'Blues',
                    'Country' => 'Country',
                    'Folk' => 'Folk',
                    'Classique' => 'Classique',
                    'Reggae' => 'Reggae',
                    'Metal' => 'Metal',
                    'Punk' => 'Punk',
                    'Electro' => 'Electro',
                    'Techno' => 'Techno',
                    'House' => 'House',
                    'Disco' => 'Disco',
                    'Funk' => 'Funk',
                    'Soul' => 'Soul',
                    'Gospel' => 'Gospel',
                    'Latino' => 'Latino',
                    'World' => 'World',
                    'Autre' => 'Autre',
                ],
                'multiple' => true,
                'expanded' => true,
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
