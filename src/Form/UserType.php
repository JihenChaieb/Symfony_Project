<?php

namespace App\Form;


use App\Entity\User1;
use Doctrine\DBAL\Types\TextType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\NotBlank;

class UserType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('firstname')
            ->add('lastname')

            ->add('email' , EmailType::class , [
                'constraints' => [ new NotBlank([
                    'message'=> 'mercide saisir une adresse email'
                ])
                ],
                'required' => true ,
                'attr' => [
                    'class' => 'form-control'
                    ]
                ])
            ->add('roles' , ChoiceType::class, [
                'choices' => [
                    'Utilisateur' => 'ROLE_USER',
                    'Administrateur'=>'ROLE_ADMIN' ,
                    'Formateur'=>'ROLE_FORMATEUR'

                ],
                'expanded'=>true,
                'multiple'=>true,
                'label'=> 'Roles'
                ])
            ->add('valider' , SubmitType::class  )

        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User1::class,
        ]);
    }
}
