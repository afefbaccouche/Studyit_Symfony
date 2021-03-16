<?php

namespace NoteBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class NoteControllerTest extends WebTestCase
{
    public function testFindallnotes()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/findAllNotes');
    }

}
