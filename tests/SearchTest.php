<?php

namespace App\Tests;


class SearchTest extends \GithubTestCase
{
    public function testSearchPullRequests(): void
    {
        $client = $this->createAuthenticatedClient();

        $path = '/search/issues';
        $query = 'is:pr+repo:mui/material-ui+author:oliviertassinari+created:%3E2021-02-12+state:closed';
        $client->request('GET', $path.'?q='.$query);

        $this->assertResponseIsSuccessful();
    }
}
