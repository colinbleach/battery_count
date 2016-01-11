<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Battery;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use AppBundle\Entity\BatteryCount;
use AppBundle\Entity\AddBattery;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class BatteryController extends Controller
{
    /**
     * @Route("/batterypack/new")
     *
     */
    public function newBattery(Request $request)
    {   
        $addBattery = new BatteryCount();
        
        $form = $this->createFormBuilder($addBattery)
            ->add('type',TextType::class)
            ->add('count',IntegerType::class,array('attr' => array('min' => 1)))
            ->add('name',TextType::class,array('required' => false))
            ->add('save', SubmitType::class, array('label' => 'Add Battery'))
            ->getForm();
       
       $form->handleRequest($request);
       
       if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager('default');

            $addBattery->setName(
                $this->SanitiseString(
                    $addBattery->getName()
                    )
                );
            $addBattery->setCount(
                $this->SanitiseString(
                    $addBattery->getCount()
                    )
                );
            $addBattery->setType(
                $this->SanitiseString(
                    $addBattery->getType()
                    )
                );

            $addBattery->setName(
                empty($addBattery->getName())? '' : $addBattery->getName()
            );
            
            $addBattery->setType(
                preg_replace('/\s+/', '', $addBattery->getType())
                );
                    
            $battery_count = new BatteryCount();
        
            $battery_count->setType($addBattery->getType());
            $battery_count->setCount($addBattery->getCount());
            $battery_count->setName($addBattery->getName());
            
            $em->persist($battery_count);
            $em->flush();
        }
        
        return $this->render('AppBundle::battery.html.twig', 
            array(
                'form' => $form->createView(),
            )
        );
    }

    
    private static function SanitiseString($value)
    {
        return str_replace(';','',$value);
    }
}
