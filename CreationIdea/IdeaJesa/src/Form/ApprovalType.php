<?php

namespace App\Form;

use App\Entity\Approval;
use App\Entity\User;
use App\Enum\ApprovalStatus;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ApprovalType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('approvalStatus', ChoiceType::class, [
                'label' => 'Approval Status',
                'choices' => array_combine(array_column(ApprovalStatus::cases(), 'value'), ApprovalStatus::cases()),
            ])
            ->add('DateApprouval', DateType::class, [
                'label' => 'Date Approval',
                'widget' => 'single_text',
            ])
            ->add('createdAt', DateType::class, [
                'label' => 'Created At',
                'widget' => 'single_text',
                'required' => false,
            ])
            ->add('users', EntityType::class, [
                'label' => 'Users',
                'class' => User::class,
                'multiple' => true,
                'expanded' => false,
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Approval::class,
        ]);
    }
}
