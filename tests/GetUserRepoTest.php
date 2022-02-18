<?php

namespace App\Tests;


class GetUserRepoTest extends \GithubTestCase
{
    public function testGetPrivateRepo(): void
    {
        $client = $this->createAuthenticatedClient();
        $client->request('GET', '/user/aelfannir/AE-Admin');

        $this->assertResponseIsSuccessful();
    }
}
