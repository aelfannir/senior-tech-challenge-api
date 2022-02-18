<?php

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

abstract class GithubTestCase extends WebTestCase
{
    protected function createAuthenticatedClient(): \Symfony\Bundle\FrameworkBundle\KernelBrowser
    {
        $accessToken = $this->getContainer()->getParameter('github_access_token');

        $client = static::createClient();
        $client->setServerParameter('HTTP_auth_bearer', $accessToken);

        return $client;
    }
}
