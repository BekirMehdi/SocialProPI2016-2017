<?php
/**
 * Created by PhpStorm.
 * User: DrWalid
 * Date: 3/30/2017
 * Time: 8:42 PM
 */

namespace SocialPro\NetworkBundle\Form;


use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ExperienceType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('local')->add('place')->add('datefrom')->add('dateto')->add('description')->add('file')->add('post');
    }

    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'SocialPro\NetworkBundle\Entity\CurriculaVitae'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'socialpro_networkbundle_curriculavitae';
    }


}
