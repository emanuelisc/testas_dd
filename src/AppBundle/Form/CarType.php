<?php
namespace AppBundle\Form;

use AppBundle\Entity\Car;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class CarType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('brand', TextType::class, array('attr' => array('class' => 'form-control', 'style' => 'margin-bottom:10px')))
            ->add('model', TextType::class, array('attr' => array('class' => 'form-control', 'style' => 'margin-bottom:10px')))
            ->add('millage', TextType::class, array('attr' => array('class' => 'form-control', 'style' => 'margin-bottom:10px')))
            ->add('standing', TextType::class, array('attr' => array('class' => 'form-control', 'style' => 'margin-bottom:10px')))
            ->add('discharging', TextType::class, array('attr' => array('class' => 'form-control', 'style' => 'margin-bottom:10px')))
            ->add('driving', TextType::class, array('attr' => array('class' => 'form-control', 'style' => 'margin-bottom:10px')))
            ->add('height', TextType::class, array('attr' => array('class' => 'form-control', 'style' => 'margin-bottom:10px')))
            ->add('length', TextType::class, array('attr' => array('class' => 'form-control', 'style' => 'margin-bottom:10px')))
            ->add('width', TextType::class, array('attr' => array('class' => 'form-control', 'style' => 'margin-bottom:10px')))
            ->add('maxWeight', TextType::class, array('attr' => array('class' => 'form-control', 'style' => 'margin-bottom:10px')))
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => Car::class,
        ));
    }
}