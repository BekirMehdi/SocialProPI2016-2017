<?php

namespace SocialPro\NetworkBundle\Form;


use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ProjetsType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('name',null,array('attr'=>array('class'=>'form-control')))->add('datelimite')
            ->add('datestart')->add('description',null,array('attr'=>array('class'=>'form-control')))
            ->add('access',null,array('attr'=>array('class'=>'form-control ckeditor')))
            ->add('progression',null,array('attr'=>array('class'=>'form-control')))->add('image',MediaType::class)
            ->add('identreprise')->add('idteam');
    }
    
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'SocialPro\NetworkBundle\Entity\Projets'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'socialpro_networkbundle_projets';
    }


}
