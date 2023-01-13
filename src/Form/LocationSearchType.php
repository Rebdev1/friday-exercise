<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class LocationSearchType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            //add the fields, make the names match the variable names from the web service
            //field type could make this a drop-down to select a valid option
            ->add('I_STOFCY', null, [
                'label' => 'Stock Site',
                'required' => false         //make this field not mandotory
            ])   //I_STOFCY
            ->add('I_LOC', null, [
                'label' => 'Location',
                'required' => false         //make this field not mandotory
            ])   //I_LOC
            ->add('search', SubmitType::class, [
                'attr' => [
                    'class' => 'btn btn-danger'
                ]
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            // Configure your form options here
        ]);
    }
}
