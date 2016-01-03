<?php

namespace AppBundle\Controller;

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
        $addBattery = new AddBattery();
        
        $form = $this->createFormBuilder($addBattery)
            ->add('type',TextType::class)
            ->add('count',IntegerType::class,array('attr' => array('min' => 1)))
            ->add('name',TextType::class,array('required' => false))
            ->add('save', SubmitType::class, array('label' => 'Add Battery'))
            ->getForm();
       
       $form->handleRequest($request);
       
       if ($form->isSubmitted() && !empty($addBattery->getType() && $addBattery->getCount())) {
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
    
    /**
     * @Route("/battery/add")
     * @Method({"POST"})
     */
    public function addBattery(Request $request)
    {
        $em = $this->getDoctrine()->getManager('default');
        
        $type = $request->get('type');
        $count = (int)$request->get('count');
        $name = $request->get('name');
        
        $name = $this->SanitiseString($name);
        $count = $this->SanitiseString($count);
        $type = $this->SanitiseString($type);

        $name = empty($name)? '' : $name;
        
        $type = preg_replace('/\s+/', '', $type);
        
        $battery_count = new BatteryCount();
        
        $battery_count->setType($type);
        $battery_count->setCount($count);
        $battery_count->setName($name);

        $em->persist($battery_count);
        $em->flush();

        return $this->render('AppBundle::battery.html.twig');
        
    }
    
    private static function SanitiseString($value)
    {
        return str_replace(';','',$value);
    }
}
