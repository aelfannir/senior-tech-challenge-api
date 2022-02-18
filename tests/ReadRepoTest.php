<?php

namespace App\Tests;


class ReadRepoTest extends \GithubTestCase
{
    public function testGetRepository(): void
    {
        $client = $this->createAuthenticatedClient();
        $client->request('GET', '/repos/aelfannir/AE-Admin');

        $this->assertResponseIsSuccessful();
    }
}
