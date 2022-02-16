<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/repos', name: 'repos.')]
class RepositoryController extends GithubAbstractController
{
    #[Route('/{owner}/{repo}', name: 'repo')]
    public function repo(string $owner, string $repo, Request $request): Response
    {
        $options = $this->getOptions($request);

        $response = $this->get("/repos/{$owner}/{$repo}", $options);
        $statusCode = $response->getStatusCode();
        $content = $response->toArray();

        return $this->json($content, $statusCode);
    }
}
