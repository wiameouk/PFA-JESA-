<?php

namespace App\Form;

use App\Entity\Idea;
use App\Enum\IdeaSource;
use App\Enum\IdeaStatus;
use App\Enum\ProjectPhase;
use App\Enum\SectorsAndPrograms;
use App\Enum\TypesOfValueCreation;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeImmutableType;
use Symfony\Component\Form\Extension\Core\Type\EnumType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class IdeaType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('projectNumber', TextType::class, [
                'label' => 'Project Number',
            ])
            ->add('confidentiality', CheckboxType::class, [
                'label' => 'Confidentiality',
                'required' => false,
            ])
            ->add('projectPhase', EnumType::class, [
                'class' => ProjectPhase::class,
                'choice_label' => 'name',
                'label' => 'Project Phase',
            ])
            ->add('description', TextType::class, [
                'label' => 'Description',
            ])
            ->add('ideaSource', EnumType::class, [
                'class' => IdeaSource::class,
                'choice_label' => 'name',
                'label' => 'Idea Source',
            ])
            ->add('ideaStatus', EnumType::class, [
                'class' => IdeaStatus::class,
                'choice_label' => 'name',
                'label' => 'Idea Status',
            ])
            ->add('sectorsAndPrograms', EnumType::class, [
                'class' => SectorsAndPrograms::class,
                'choice_label' => 'name',
                'label' => 'Sectors and Programs',
            ])
            ->add('typeOfVC', ChoiceType::class, [
                'choices' => array_flip(TypesOfValueCreation::toArray()), // Assuming `toArray` method returns associative array
                'multiple' => true,
                'expanded' => true,
                'label' => 'Type of Value Creation',
            ])
            ->add('createdAt', DateTimeImmutableType::class, [
                'widget' => 'single_text',
                'label' => 'Created At',
                'required' => false,
            ])
            ->add('titleOfVC', TextType::class, [
                'label' => 'Title of Value Creation',
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Idea::class,
        ]);
    }
}
