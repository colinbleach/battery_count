<?php

namespace AppBundle\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Entity\BatteryCount;

use AppBundle\Form\Type\BatteryCountType;

class BatteryController extends Controller
{
    /**
     * @Route("/batterypack/new")
     *
     */
    public function newBattery(Request $request)
    {
        $form = $this->createForm(BatteryCountType::class);

        $form->handleRequest($request);

       if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager('default');
            $battery = new BatteryCount();
            $battery->setCount($form->getData()['count']);
            $battery->setName($form->getData()['name']);
            $battery->setType($form->getData()['type']);

            $em->persist($battery);
            $em->flush();
        }
        
        return $this->render('AppBundle::battery.html.twig', 
            array(
                'form' => $form->createView(),
            )
        );
    }
}
