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
        $dbconn = pg_connect("host=localhost port=5432 dbname=battery_count user=battery_user password=password");
        
        $aa_count = pg_fetch_assoc(pg_query($dbconn,'select sum(battery_count) as total from battery_count where type = \'aa\';'));
        $aaa_count = pg_fetch_assoc(pg_query($dbconn,'select sum(battery_count) as total from battery_count where type = \'aaa\';'));
        $other_count = pg_fetch_assoc(pg_query($dbconn,'select sum(battery_count) as total from battery_count where type = \'other\';'));
        
        return $this->render('default/index.html.twig', 
        array(
              'aa_count' => isset($aa_count['total'])? $aa_count['total'] : 0,
              'aaa_count' => isset($aaa_count['total'])? $aaa_count['total'] : 0,
              'other_count' => isset($other_count['total'])? $other_count['total'] : 0
            )
        );
    }
}
