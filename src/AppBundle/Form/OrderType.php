<?php
namespace AppBundle\Form;

use AppBundle\Entity\Driver;
use AppBundle\Entity\Order;
use Doctrine\ORM\EntityRepository;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;

class OrderType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('address', TextType::class, array('attr' => array('class' => 'form-control', 'style' => 'margin-bottom:10px')))
            ->add('dateToDeliver', DateType::class, array('attr' => array('class' => 'date', 'style' => 'margin-bottom:10px')))
            ->add('car', EntityType::class, array(
                'class' => 'AppBundle:Car',
                'query_builder' => function (EntityRepository $er) {
                    return $er->createQueryBuilder('c')
                        ->orderBy('c.brand', 'ASC');
                },
                'choice_label' => 'Parameters',
                'attr' => array('class' => 'form-control', 'style' => 'margin-bottom:10px'),
                'label' => 'Choose Car (Length/Width/Height in meters)'
            ))
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => Order::class,
        ));
    }
}