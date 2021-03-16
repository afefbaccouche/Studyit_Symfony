<?php

namespace ServiceBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class ServiceControllerTest extends WebTestCase
{
    public function testAddservice()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/addService');
    }

}
