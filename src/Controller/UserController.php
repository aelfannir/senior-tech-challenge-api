<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/user', name: 'user.')]
class UserController extends GithubAbstractController
{
    const USER_REPOS = '/user/repos';

    #[Route('/repos', name: 'repos')]
    public function repo(Request $request): Response
    {
        if (! $this->hasAccessToken($request)) {
            return new Response(status: Response::HTTP_UNAUTHORIZED);
        }

        $options = $this->getOptions($request);
        $response = $this->get(self::USER_REPOS, $options);
        $statusCode = $response->getStatusCode();
        $content = $response->toArray();

        return $this->json($content, $statusCode);
    }
}
