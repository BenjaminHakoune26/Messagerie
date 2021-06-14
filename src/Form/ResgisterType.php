<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Length;

class ResgisterType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('firstname',TextType::class,[
                'constraints'=> new Length(2,2,30),
                'label'=>'Prénom',
                'attr'=>[
                    'placeholder'=> 'Votre prénom . . .'
                ]
            ])
            ->add('lastname', TextType::class,[
                'constraints'=> new Length(2,2,30),
                'label'=>'Nom',
                'attr'=>[
                    'placeholder'=> 'Votre Nom . . .'
                ]
            ])
            ->add('email', EmailType::class,[
                'constraints'=> new Length(2,2,50),
                'label'=>'Email',
                'attr'=>[
                    'placeholder'=> 'Votre adresse email . . .'
                ]
            ])
            ->add('password', RepeatedType::class,[
                'type'=>PasswordType::class,
                'constraints' => new Length(null, 10),
                'invalid_message'=>'Le mot de passe doit etre identique.',
                'required'=>true,
                'first_options'=>[
                    'label'=>'Mot de passe',
                    'attr'=>[
                        'placeholder'=>'Votre mot de passe . . .']],
                'second_options'=>[
                    'label'=>'Confirmation du mot de passe',
                    'attr'=>[
                        'placeholder'=>'Confirmez votre mot de passe . . .']],
            ])
            ->add('submit', SubmitType::class,[
                'label' => "S'inscire"
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
