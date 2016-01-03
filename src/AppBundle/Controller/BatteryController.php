<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;

class BatteryController extends Controller
{
    /**
     * @Route("/batterypack/new")
     * @Method({"GET"})
     */
    public function newBattery()
    {   
        return $this->render('battery.html.twig', [
            'base_dir' => realpath($this->container->getParameter('kernel.root_dir').'/..'),
        ]);
    }
    
    /**
     * @Route("/batterypack/new")
     * @Method({"POST"})
     */
    public function addBattery(Request $request)
    {
        $type = $request->get('type');
        $count = (int)$request->get('count');
        $name = $request->get('name');
        
        $name = $this->SanitiseString($name);
        $count = $this->SanitiseString($count);
        $type = $this->SanitiseString($type);

        $name = empty($name)? '' : $name;
        
        $type = preg_replace('/\s+/', '', $type);
        
        $dbconn = pg_connect("host=localhost port=5432 dbname=battery_count user=battery_user password=password");

        if (strcasecmp($type,'aa') == 0)
        {
            pg_query($dbconn,'insert into battery_count(type,battery_count,name) values(\'aa\','.$count.',\''.$name.'\');');
        }
        elseif (strcasecmp($type,'aaa') == 0)
        {
            pg_query($dbconn,'insert into battery_count(type,battery_count,name) values(\'aaa\','.$count.',\''.$name.'\');');
        }
        else
        {
            pg_query($dbconn,'insert into battery_count(type,battery_count,name) values(\'other\','.$count.',\''.$name.'\');');    
        }
        
        return $this->render('battery.html.twig', [
            'base_dir' => realpath($this->container->getParameter('kernel.root_dir').'/..'),
        ]);
        
    }
    
    private static function SanitiseString($value)
    {
        return str_replace(';','',$value);
    }
}
