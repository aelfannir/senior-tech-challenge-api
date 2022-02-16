<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Contracts\HttpClient\HttpClientInterface;
use Symfony\Contracts\HttpClient\ResponseInterface;

abstract class GithubAbstractController extends AbstractController
{
    const AUTH_BEARER_KEY   = 'auth_bearer';

    public function __construct(protected HttpClientInterface $client)
    { }

    protected function getOptions(Request $request): array
    {
        $options = [];
        $options['auth_bearer'] = $request->headers->get(self::AUTH_BEARER_KEY);
        $options['query']       = $request->query->all();

        return $options;
    }

    protected function hasAccessToken(Request $request): bool
    {
        return $request->headers->has(self::AUTH_BEARER_KEY);
    }

    protected function toAbsoluteUrl(string $path): string
    {
        return $this->getParameter('github_api_url').$path;
    }

    protected function get(string $path, array $options = []): ResponseInterface
    {
        $url = $this->toAbsoluteUrl($path);

        return $this->client->request('GET', $url, $options);
    }
}
