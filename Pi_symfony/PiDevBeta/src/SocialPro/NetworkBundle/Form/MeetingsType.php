<?php

namespace SocialPro\NetworkBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

class MeetingsType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('type',ChoiceType::class,array(
                'choices'=>array(
                    'Sprint planning meeting'=>'Sprint planning meeting',
                    'Daily Scrum'=>'Daily Scrum',
                    'Post-sprint meeting'=>'Post-sprint meeting',
                    'Rétrospective-meeting'=>'Rétrospective-meeting'),
            ))
            ->add('date',DateType::class,array('widget'=>'single_text', 'years'   => range(2017 , 2019),
                'months' => range(04, 12),
                'days'    => range(10, 31), ))->add('heure')->add('description')->add('lieu')

            ->add('lieu',ChoiceType::class,array(
                'choices'=>array(
                    'Bloc A'=>'Bloc A',
                    'Bloc C'=>'Bloc C',
                    'Bloc D'=>'Bloc D',
                    'Bloc E'=>'Bloc E',
                    'Bloc H'=>'Bloc H'),
            ))

            ->add('idprojet');
    }

    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'SocialPro\NetworkBundle\Entity\Meetings'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'socialpro_networkbundle_meetings';
    }


}
