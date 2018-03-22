<?php
/**
 * Created by PhpStorm.
 * User: DrWalid
 * Date: 4/2/2017
 * Time: 11:36 AM
 */

namespace SocialPro\NetworkBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;


class ResultatsExamenType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('type')->add('local')->add('place')->add('datefrom')->add('dateto')->add('checked')->add('description')->add('file')->add('link')->add('post')->add('result')->add('field')->add('diploma')->add('activity')->add('cause')->add('title')->add('number')->add('function')->add('iduser');
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