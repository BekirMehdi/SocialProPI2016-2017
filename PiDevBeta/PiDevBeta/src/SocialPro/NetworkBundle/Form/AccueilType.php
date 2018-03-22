<?php
/**
 * Created by PhpStorm.
 * User: DrWalid
 * Date: 4/7/2017
 * Time: 12:28 PM
 */

namespace SocialPro\NetworkBundle\Form;


use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;


class AccueilType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('comment', 'collection', array('type' => new CommentsWebType()));
    }

    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'SocialPro\NetworkBundle\Entity\CommentsWeb'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'socialpro_networkbundle_commentsweb';
    }
}