<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Contracts\HttpClient\HttpClientInterface;

#[Route('/search', name: 'search.')]
class SearchController extends AbstractController
{
    public function __construct(protected HttpClientInterface $client)
    { }

    #[Route('/issues', name: 'issues')]
    public function issues(Request $request): Response
    {
        $pathInfo = '/search/issues';
        $url = $this->getParameter('github_api_url').$pathInfo;
        $options = [];
        $options['auth_bearer'] = $request->headers->get(UserController::AUTH_BEARER_KEY);
        $options['query']       = $request->query->all();

        $response = $this->client->request('GET', $url, $options);
        $statusCode = $response->getStatusCode();
        $content = $response->toArray();

        return $this->json($content, $statusCode);
    }
}
