<?php

namespace App\Tests\Authentication;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Bundle\FrameworkBundle\KernelBrowser;

class LoginTest extends WebTestCase
{
    public function testRedirectHomePage(): void
    {
        $client = static::createClient();
        $crawler = $client->request('GET', '/');
        $client->followRedirect();
        $this->assertSelectorTextContains('h1', 'Please sign in');
    }

    public function testLoginPage(): void
    {
        $client = static::createClient();
        $crawler = $client->request('GET', '/login');

        $this->assertResponseIsSuccessful();
        $this->assertSelectorTextContains('h1', 'Please sign in');
    }

    public function testLogin(): void 
    {
        $client = static::createClient();
        $crawler = $client->request('GET', '/login');
        $crawler = $client->submitForm('Sign in', [
            'username' => 'user',
            'password' => 'user',
        ]);
        $client->followRedirect();
        $this->assertResponseIsSuccessful();
        $this->assertSelectorTextContains('p', 'You are logged as user');
    }

}
