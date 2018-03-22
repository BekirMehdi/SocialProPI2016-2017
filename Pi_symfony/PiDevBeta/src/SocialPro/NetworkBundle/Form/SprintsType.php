<?php

namespace  SocialPro\NetworkBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class SprintsType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        //html5 => false
        $builder->add('name')->add('datestart',DateType::class,array('widget'=>'single_text','attr'=>array('class'=>'datepicker form-control')))->add('deadline',DateType::class,array('widget'=>'single_text'))->add('number')->add('description')->add('idprojet');
    }
    
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => ' SocialPro\NetworkBundle\Entity\Sprints'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'socialpro_networkbundle_sprints';
    }


}
