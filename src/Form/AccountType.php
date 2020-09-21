<?php

namespace App\Form;

use App\Entity\Account;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AccountType extends AbstractType
{
    private function getConfiguration($label, $placeholder) {
        return [
            'label' => $label,
            'attr' => [
                'placeholder' => $placeholder
            ]
        ];
    }
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('firstName', TextType::class,
                $this->getConfiguration('First Name', 'Entrez votre prenom'), [
                    'required' => true
                ])
            ->add('lastName', TextType::class,
                $this->getConfiguration('First Name', 'Entrez votre nom'), [
                    'required' => true
                ])
            ->add('countryCode', ChoiceType::class, [
                'choices'  => [
                    'Fr' => 'fr',
                    'En' => 'en',
                    'Us' => 'us',
                    'Es' => 'es'
                ],
            ])
            ->add('phoneNumber', TextType::class,
                $this->getConfiguration('First Name', 'Entrez votre numero de telephone'), [
                    'required' => true
                ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Account::class,
        ]);
    }
}
