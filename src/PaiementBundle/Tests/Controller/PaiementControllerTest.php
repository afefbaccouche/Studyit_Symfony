<?php

namespace PaiementBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class PaiementControllerTest extends WebTestCase
{
    public function testAddpaiement()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/addPaiement');
    }

}
