<?php

namespace App\Form;
use App\Entity\Idea;
use App\Enum\IdeaSource;
use App\Enum\IdeaStatus;
use App\Enum\ProjectPhase;
use App\Enum\SectorsAndPrograms;
use App\Enum\TypesOfValueCreation;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
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
           ->add('confidentiality', ChoiceType::class, [
    'label' => 'Confidentiality',
    'choices' => [
        'Yes' => true,
        'No' => false,
    ],
    'expanded' => false, // si vous voulez un menu déroulant
    'multiple' => false, // pour s'assurer qu'un seul choix est sélectionné
])
            ->add('projectPhase', ChoiceType::class, [
                'label' => 'Project Phase',
                'choices' => $this->getChoices(ProjectPhase::cases()),
            ])
            ->add('description', TextareaType::class, [
                'label' => 'Description',
            ])
            ->add('ideaSource', ChoiceType::class, [
                'label' => 'Idea Source',
                'choices' => $this->getChoices(IdeaSource::cases()),
            ])
            ->add('ideaStatus', ChoiceType::class, [
                'label' => 'Idea Status',
                'choices' => $this->getChoices(IdeaStatus::cases()),
            ])
            ->add('sectorsAndPrograms', ChoiceType::class, [
                'label' => 'Sectors and Programs',
                'choices' => $this->getChoices(SectorsAndPrograms::cases()),
            ])
            ->add('typeOfVC', ChoiceType::class, [
                'label' => 'Type of Value Creation',
                'choices' => $this->getChoices(TypesOfValueCreation::cases()),
                'multiple' => true,  // Permet la sélection multiple
                'expanded' => true,  // Affiche les options comme des cases à cocher (facultatif)
            ])
            ->add('titleOfVC', TextType::class, [
                'label' => 'Title of Value Creation',
            ])
            ->add('department', TextType::class, [
                'label' => 'Department',
                'required' => false,
            ])
            ->add('createdAt', DateType::class, [  // Utiliser DateType pour le champ de date
                'label' => 'Created At',
                'required' => false,
                'widget' => 'single_text', // Utiliser un seul champ pour le calendrier
                'attr' => ['class' => 'form-control'], // Ajoutez une classe CSS si nécessaire
            ])
            ->add('customerName', TextType::class, [
                'label' => 'Customer Name',
                'required' => false,
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Idea::class,
        ]);
    }

    private function getChoices(array $enumCases): array
    {
        $choices = [];
        foreach ($enumCases as $enum) {
            $choices[$enum->value] = $enum;
        }
        return $choices;
    }
}
