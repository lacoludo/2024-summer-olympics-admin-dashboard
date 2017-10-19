<?php

namespace LudovicBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;

class AthleteType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('lastname', TextType::class, array(
                'label' => 'form.label.lastname'
            ))
            ->add('firstname', TextType::class, array(
                'label' => 'form.label.firstname'
            ))
            ->add('birthdate', DateType::class, array(
                'label' => 'form.label.birthdate',
                'years' => range(1983,2006)
            ))
            ->add('photo', FileType::class, array(
                'label' => 'form.label.photo',
                'data_class' => null
            ))
            ->add('country', EntityType::class, array(
                'label' => 'form.label.country',
                'class' => 'LudovicBundle:Country',
                'choice_label' => 'name'
            ))
            ->add('sport', EntityType::class, array(
                'label' => 'form.label.sport',
                'class' => 'LudovicBundle:Sport',
                'choice_label' => 'name'
            ));
    }
    
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'LudovicBundle\Entity\Athlete'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'ludovicbundle_athlete';
    }


}
