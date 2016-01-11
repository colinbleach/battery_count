<?php
namespace AppBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;

class BatteryCountType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('type',TextType::class)
            ->add('count',IntegerType::class,array('attr' => array('min' => 1)))
            ->add('name',TextType::class,array('required' => false))
            ->add('save', SubmitType::class, array('label' => 'Add Battery'));
    }
}