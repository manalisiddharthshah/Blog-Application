<?php

// app/src/Form/RegistrationFormType.php
namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\Length;

class RegistrationFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
        ->add('username',TextType::class,[
            'attr' => [
                'placeholder' => 'Enter UserName',
                'class' => 'form-control'
            ],
            'required' => true,
            'constraints' => [
                new NotBlank([
                    'message' => 'Please enter a UserName',
                ]),
                new Length([
                    'min' => 3,
                    'minMessage' => 'Your UserName should be at least {{ limit }} characters',
                    // max length allowed by Symfony for security reasons
                    'max' => 50,
                ]),
            ],
        ])
        ->add('email',TextType::class,[
            'attr' => [
                'placeholder' => 'Enter Email',
                'class' => 'form-control'
            ],
            'required' => true,
            'constraints' => [
                new NotBlank([
                    'message' => 'Please enter a Email',
                ]),
                new Length([
                    'min' => 3,
                    'minMessage' => 'Your Email should be at least {{ limit }} characters',
                    // max length allowed by Symfony for security reasons
                    'max' => 50,
                ]),
            ],
        ])
        ->add('phone',NumberType::class,[
            'attr' => [
                'placeholder' => 'Enter Phone No',
                'class' => 'form-control'
            ],
            'required' => true,
            'constraints' => [
                new NotBlank([
                    'message' => 'Please enter a Phone No',
                ]),
                new Length([
                    'min' => 10,
                    'minMessage' => 'Your Phone should be at least {{ limit }} Number',
                    // max length allowed by Symfony for security reasons
                    'max' => 10,
                ]),
            ],
        ])
        ->add('address',TextareaType::class,[
            'attr' => [
                'placeholder' => 'Enter Address',
                'class' => 'form-control'
            ],
        ])
        ->add('password', RepeatedType::class, [
                'type' => PasswordType::class,
                'invalid_message' => 'The password fields must match.',
                'required' => true,
                'first_options'  => ['label' => 'Password',
                'attr' => [
                    'placeholder' => 'Enter Password',
                    'class' => 'form-control'
                ],
            ],
                'second_options' => ['label' => 'Confirm Password',
                'attr' => [
                    'placeholder' => 'Enter Password',
                    'class' => 'form-control'
                ],],
                // instead of being set onto the object directly,
                // this is read and encoded in the controller
                'mapped' => false,
                'constraints' => [
                    new NotBlank([
                        'message' => 'Please enter a password',
                    ]),
                    new Length([
                        'min' => 6,
                        'minMessage' => 'Your password should be at least {{ limit }} characters',
                        // max length allowed by Symfony for security reasons
                        'max' => 18,
                    ]),
                ],
            ])
            
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
