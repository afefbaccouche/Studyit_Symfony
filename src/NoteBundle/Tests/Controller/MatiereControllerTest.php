<?php

namespace NoteBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class MatiereControllerTest extends WebTestCase
{
    public function testAddmatiere()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/addMatiere');
    }

}
