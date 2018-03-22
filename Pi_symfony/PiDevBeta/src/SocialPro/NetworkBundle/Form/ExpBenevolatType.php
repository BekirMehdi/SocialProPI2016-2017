<?php
/**
 * Created by PhpStorm.
 * User: DrWalid
 * Date: 4/2/2017
 * Time: 11:26 AM
 */

namespace SocialPro\NetworkBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;


class ExpBenevolatType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('local')->add('function')
            ->add('cause',  ChoiceType::class, array(
                'choices' => array(
                    'ANIMAL_RIGHTS' => 'Bien-être des animaux',
                    'ARTS_AND_CULTURE' => 'Arts et culture',
                    'ANIMAL_RIGHTS'=>'Bien-être des animaux',
                    'ARTS_AND_CULTURE'=>'Arts et culture',
                    'CHILDREN'=>'Enfance',
                    'CIVIL_RIGHTS'=>'Droits civiques et action sociale',
                    'HUMANITARIAN_RELIEF'=>'Aide humanitaire et secours en cas de catastrophes',
                    'ECONOMIC_EMPOWERMENT'=>'Autonomisation économique',
                    'EDUCATION'=>'Éducation',
                    'ENVIRONMENT'=>'Environnement',
                    'HEALTH'=>'Santé',
                    'HUMAN_RIGHTS'=>'Droits de l’homme',
                    'POLITICS'=>'Politique',
                    'POVERTY_ALLEVIATION'=>'Lutte contre la pauvreté',
                    'SCIENCE_AND_TECHNOLOGY'=>'Science et technologie',
                    'SOCIAL_SERVICES'=>'Services sociaux'

                ),
                'required'    => true,
                'placeholder' => '-',
                'empty_data'  => null
            ))->add('datefrom')->add('dateto')->add('description')->add('file');
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