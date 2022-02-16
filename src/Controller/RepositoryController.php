<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Contracts\HttpClient\HttpClientInterface;

#[Route('/repos', name: 'repos.')]
class RepositoryController extends AbstractController
{
    public function __construct(protected HttpClientInterface $client)
    { }

    #[Route('/{owner}/{repo}', name: 'get')]
    public function get(string $owner, string $repo, Request $request): Response
    {
        $pathInfo = "/repos/{$owner}/{$repo}";
        $url = $this->getParameter('github_api_url').$pathInfo;

        $options = [];
        $options['auth_bearer'] = $request->headers->get(UserController::AUTH_BEARER_KEY);

        $response = $this->client->request('GET', $url, $options);
        $statusCode = $response->getStatusCode();
        $content = $response->toArray();

        return $this->json($content, $statusCode);
    }
}
