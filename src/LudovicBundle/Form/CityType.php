<?php

namespace LudovicBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
/*use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;*/
use LudovicBundle\Form\EventListener\AddNameFieldSubscriber;

class CityType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', TextType::class, array(
                'label' => 'form.label.name'
            ));

        /*$builder->addEventListener(FormEvents::PRE_SET_DATA, function (FormEvent $event) {
            $city = $event->getData();
            $form = $event->getForm();

            // check if the City object is "new"
            // If no data is passed to the form, the data is "null".
            // This should be considered a new "City"
            if (!$city || null === $city->getId()) {
                $form->add('name', TextType::class);
            }
        });*/

        $builder->addEventSubscriber(new AddNameFieldSubscriber());
    }
    
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'LudovicBundle\Entity\City'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'ludovicbundle_city';
    }


}
