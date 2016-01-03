<?php
namespace Tests\AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class BatteryControllerTest extends WebTestCase
{
    public function testBattery()
    {
        $client = static::createClient();

        $crawler = $client->request('POST', '/batterypack/new');

        $data1 = array('type' => 'aa', 'count' => 4, 'name' => 'test');
        $data2 = array('type' => 'aaa', 'count' => 3, 'name' => 'test');
        $data3 = array('type' => 'aa', 'count' => 1, 'name' => 'test');
        
        $form = $crawler->selectButton('submit')->form();
        
        $form['type'] = 'aa';
        $form['count'] = 4;
        $form['name'] = 'test';
        
        $crawler = $client->submit($form);
        
        $form['type'] = 'aaa';
        $form['count'] = 3;
        $form['name'] = 'test';
        
        $crawler = $client->submit($form);
        
        $form['type'] = 'aa';
        $form['count'] = 1;
        $form['name'] = 'test';
        
        $crawler = $client->submit($form);
    }
    
}