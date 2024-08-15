<?php
namespace App\Form;

use App\Entity\Approval;
use App\Enum\ApprovalStatus;
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
                'choices' => [
                    'Approved' => ApprovalStatus::APPROVED,
                    'Rejected' => ApprovalStatus::REJECTED,
                ],
            ])
            ->add('DateApprouval', DateType::class, [
                'widget' => 'single_text',
            ])
            ->add('users'); // Assuming you have a select list for users
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Approval::class,
        ]);
    }
}
