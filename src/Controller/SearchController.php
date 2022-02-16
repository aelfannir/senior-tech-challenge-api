<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/search', name: 'search.')]
class SearchController extends GithubAbstractController
{
    #[Route('/issues', name: 'issues')]
    public function issues(Request $request): Response
    {
        $options = $this->getOptions($request);

        $response = $this->get('/search/issues', $options);
        $statusCode = $response->getStatusCode();
        $content = $response->toArray();

        return $this->json($content, $statusCode);
    }
}
