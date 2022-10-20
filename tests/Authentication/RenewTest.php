<?php

namespace App\Tests\Authentication;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

/**
 * @TODO
 */
class RenewTest extends WebTestCase
{
    public function testGoodRenew(): void
    {
        $client = static::createClient();
        $crawler = $client->request('GET', '/token');

        $this->assertResponseIsSuccessful();
        // $this->assertSelectorTextContains('h1', 'Hello World');
    }
}
