<?php
namespace AppBundle\Form;

use AppBundle\Entity\User;
use AppBundle\Entity\Order;
use Doctrine\ORM\EntityRepository;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;

class SelectType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('user', EntityType::class, array(
                'class' => 'AppBundle:User',
                'query_builder' => function (EntityRepository $er) {
                    return $er->createQueryBuilder('c')
                        ->where('c.role = :role')
                        ->setParameter('role', "ROLE_USER")
                        ->orderBy('c.username', 'ASC');
                },
                'choice_label' => 'username',
                'attr' => array('class' => 'form-control', 'style' => 'margin-bottom:10px'),
                'label' => 'Select user'
            ))
            ->add('dateToDeliver', DateType::class, array(
                'label'=> 'Select month',
                'attr' => array('class' => 'form-control', 'style' => 'margin-bottom:10px')))
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => Order::class,
        ));
    }
}