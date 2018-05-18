<?php

namespace AppBundle\Form;

use AppBundle\Entity\Event;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\TimezoneType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class EventType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name')
            ->add('start',DateTimeType::class,
                [
                    'input' => 'string',
                    'data' => date('Y-m-d h:i:s')
                ]
            )
            ->add('end', DateTimeType::class,
                [
                    'input' => 'string',
                    'data' => date('Y-m-d h:i:s', strtotime("+1 hours"))
                ]
            )
            ->add('timezone', TimezoneType::class );
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(
            [
                'data_class' => Event::class,
            ]
        );
    }
}
