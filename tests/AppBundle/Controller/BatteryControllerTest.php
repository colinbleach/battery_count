<?php
namespace Tests\AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class BatteryControllerTest extends WebTestCase
{
    public function testBattery()
    {
        $client = static::createClient();

        $crawler = $client->request('POST', '/batterypack/new');

        $data1 = array('form[type]' => 'aa', 'form[count]' => 4, 'form[name]' => 'test');
        $data2 = array('form[type]' => 'aaa', 'form[count]' => 3, 'form[name]' => 'test');
        $data3 = array('form[type]' => 'aa', 'form[count]' => 1, 'form[name]' => 'test');

        $sendButton = $crawler->selectButton('form_save');
        $form = $sendButton->form($data1);
        $client->submit($form);

        $form = $sendButton->form($data2);
        $client->submit($form);

        $form = $sendButton->form($data3);
        $client->submit($form);

        $crawler = $client->request('GET', '/');
        $aa = $crawler->filter('#aa')->text();
        $aaa = $crawler->filter('#aaa')->text();
        
        $this->assertEquals("5",$aa);
        $this->assertCount("3",$aaa);

    }
    
}