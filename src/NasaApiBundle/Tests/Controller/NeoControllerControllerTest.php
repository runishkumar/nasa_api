<?php

namespace NasaApiBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class NeoControllerControllerTest extends WebTestCase
{
    public function testGethazardous()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/hazardous');
    }

}
