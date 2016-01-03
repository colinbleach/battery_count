<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Entity\BatteryCount;
use AppBundle\Entity\BatteryCountOutput;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="homepage")
     */
    public function indexAction(Request $request)
    {   
        $em = $this->getDoctrine()->getManager('default');
        
        $battery = new BatteryCount();
        //$dbconn = pg_connect("host=localhost port=5432 dbname=battery_count user=battery_user password=password");
        
        $em = $this->getDoctrine()->getManager();
        
        $battery_count_output = new BatteryCountOutput();
        
        $query = $em->createQuery(
            'SELECT p.type,SUM(p.count) as count
            AppBundle:BatteryCount p
            GROUP BY p.type'
        );
        
        $battery_count_output = $query->getResult();

        $em->flush();
        
        //return $this->render('default/index.html.twig',
        return $this->render('AppBundle::default/index.html.twig',
            array(
                'items' => $battery_count_output
            )
        );
    }
}
