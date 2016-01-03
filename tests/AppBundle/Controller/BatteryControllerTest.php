<?php
namespace Tests\AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class BatteryControllerTest extends WebTestCase
{
    public function testBattery()
    {
        $client1 = static::createClient();
        $client2 = static::createClient();
        $client3 = static::createClient();
        $client4 = static::createClient();

        $crawler1 = $client1->request('POST', '/batterypack/new');
        $crawler2 = $client2->request('POST', '/batterypack/new');
        $crawler3 = $client3->request('POST', '/batterypack/new');
        
        $data1 = array('type' => 'aa', 'count' => 4, 'name' => 'test');
        $data1 = array('type' => 'aaa', 'count' => 3, 'name' => 'test');
        $data1 = array('type' => 'aa', 'count' => 1, 'name' => 'test');
        
        $crawler4 = $client4->request('GET', '/');
        $this->assertEquals(200, $client4->getResponse()->getStatusCode());
        
        $this->assertEquals(200, $client4->getResponse()->getStatusCode());
        $this->assertContains(5, $crawler4->filter('#aa td')->text());
        
        $this->assertEquals(200, $client4->getResponse()->getStatusCode());
        $this->assertContains(3, $crawler4->filter('#aaa td')->text());

    }
}