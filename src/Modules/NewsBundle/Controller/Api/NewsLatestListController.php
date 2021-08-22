<?php

namespace App\Modules\NewsBundle\Controller\Api;

use App\Modules\NewsBundle\Repository\NewsRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;

class NewsLatestListController extends AbstractController
{

    private $newsRepository;

    public function __construct(NewsRepository  $newsRepository)
    {
        $this->newsRepository = $newsRepository;
    }

    /**
     *
     * @Route("/api/news/latest/", methods={"GET"}, name="api_latest")
     */
    public function __invoke() :JsonResponse
    {
        $latest = $this->newsRepository->getCollection(
            [],
            ['publishDate' => 'desc']
        );

        return $this->json($latest);

    }

}