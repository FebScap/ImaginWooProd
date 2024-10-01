<?php

namespace App\Form;

use Doctrine\ORM\Query\Expr\Select;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ContactType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('first_name', TextType::class, ['label' => 'Prénom'])
            ->add('last_name', TextType::class , ['label' => 'Nom'])
            ->add('email', EmailType::class , ['label' => 'Email'])
            ->add('subject', ChoiceType::class, [
                'label' => 'Sujet',
                'choices' => ['Je souhaite devenir membre' => 'new_member', 'Autres' => 'other']
            ])
            ->add('message', TextareaType::class, ['label' => 'Contenu de votre message'])
            ->add('send', SubmitType::class, ['label' => 'Envoyer']);
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            // Configure your form options here
        ]);
    }
}
