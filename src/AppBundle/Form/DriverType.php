<?php
namespace AppBundle\Form;

use AppBundle\Entity\Driver;
use Doctrine\ORM\EntityRepository;
use Symfony\Component\Asset\Context\NullContext;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TimeType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;

class DriverType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('order', EntityType::class, array(
                'class' => 'AppBundle:Order',
                'query_builder' => function (EntityRepository $er) {
                    return $er->createQueryBuilder('o')
                        ->innerJoin('o.driver', 'd', 'WITH', 'd.id = o.driver')
                        ->where("d.whenLeaveTerminal is null")
                        ->orderBy('o.address', 'ASC');
                },
                'choice_label' => 'address',
                'attr' => array('class' => 'form-control', 'style' => 'margin-bottom:10px'),
                'label' => 'Choose Order'
            ))
            ->add('whenLeaveTerminal', TimeType::class, array('attr' => array('class' => 'form-control', 'style' => 'margin-bottom:10px')))
            ->add('whenCameToCustomer', TimeType::class, array('attr' => array('class' => 'form-control', 'style' => 'margin-bottom:10px')))
            ->add('whenLoadOut', TextType::class, array('attr' => array('class' => 'form-control', 'style' => 'margin-bottom:10px')))
            ->add('whenLeaveCustomer', TimeType::class, array('attr' => array('class' => 'form-control', 'style' => 'margin-bottom:10px')))
            ->add('whenCameToTerminal', TimeType::class, array('attr' => array('class' => 'form-control', 'style' => 'margin-bottom:10px')))
            ->add('distance', TextType::class, array('attr' => array('class' => 'form-control', 'style' => 'margin-bottom:10px')))
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => Driver::class,
        ));
    }
}