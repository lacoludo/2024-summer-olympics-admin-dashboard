<?php

namespace LudovicBundle\Form\EventListener;

use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class AddNameFieldSubscriber implements EventSubscriberInterface
{
    public static function getSubscribedEvents()
    {
    // Tells the dispatcher that you want to listen on the form.pre_set_data
    // event and that the preSetData method should be called.
    return array(FormEvents::PRE_SET_DATA => 'preSetData');
    }

    public function preSetData(FormEvent $event)
    {
        $city = $event->getData();
        $form = $event->getForm();

        if (!$city || null === $city->getId())
        {
            $form->add('name', TextType::class);
        }
    }
}