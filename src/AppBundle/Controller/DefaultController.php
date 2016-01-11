<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="homepage")
     */
    public function indexAction(Request $request)
    {
        $repository = $this->getDoctrine()->getRepository('AppBundle:BatteryCount');

        $battery_count_output = $repository->getBatteries();

        return $this->render('AppBundle::default/index.html.twig',
            array(
                'items' => $battery_count_output
            )
        );
    }
}
