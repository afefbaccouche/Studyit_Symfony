<?php

namespace EleveBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class EleveControllerTest extends WebTestCase
{
    public function testFindeleves()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/findEleves');
    }

}
