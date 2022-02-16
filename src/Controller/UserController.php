<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Contracts\HttpClient\HttpClientInterface;

#[Route('/user', name: 'user.')]
class UserController extends AbstractController
{
    const USER_REPOS        = '/user/repos';
    const AUTH_BEARER_KEY   = 'auth_bearer';

    public function __construct(protected HttpClientInterface $client)
    { }

    #[Route('/repos', name: 'repos')]
    public function repo(Request $request): Response
    {
        if (!$request->headers->has(self::AUTH_BEARER_KEY)) {
            return new Response(status: Response::HTTP_UNAUTHORIZED);
        }

        $url = $this->getParameter('github_api_url').self::USER_REPOS;

        $options = [];
        $options['auth_bearer'] = $request->headers->get(self::AUTH_BEARER_KEY);
        $options['query']       = $request->query->all();

        $response = $this->client->request('GET', $url, $options);
        $statusCode = $response->getStatusCode();
        $content = $response->toArray();

        return $this->json($content, $statusCode);
    }
}
