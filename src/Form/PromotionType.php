<?php

namespace App\Form;

use App\Entity\Category;
use App\Entity\Promotion;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class PromotionType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('discount', IntegerType::class, [
            'label' => 'Discount of Product',
                'required'=> true,
                'attr' => [
                    'min' => 1,
                    'max' => 99
                ]
            ])
            ->add('startDate', DateType::class)
            ->add('endDate', DateType::class)
            ->add('category', EntityType::class,[
                'class' =>Category::class,
                'choice_label' => 'name'
            ])
            ->add('Save', SubmitType::class);
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Promotion::class,
        ]);
    }
}
