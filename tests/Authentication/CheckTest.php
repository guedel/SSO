<?php

namespace App\Tests\Authentication;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

/**
 * @TODO
 */
class CheckTest extends WebTestCase
{
    public function testSomething(): void
    {
        $client = static::createClient();
        $crawler = $client->request('GET', '/');

        $this->assertResponseIsSuccessful();
        $this->assertSelectorTextContains('h1', 'Hello World');
    }
}
