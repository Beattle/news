<?php

namespace App\Modules\NewsBundle\Controller\Api;

use App\Modules\NewsBundle\Repository\NewsRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;

class NewsItemReadController extends AbstractController
{


    private $newsRepository;

    public function __construct(NewsRepository  $newsRepository)
    {
        $this->newsRepository = $newsRepository;
    }

    /**
     *
     * @Route("/api/news/item/{id}", methods={"GET"}, name="api_item")
     */
    public function __invoke($id) :JsonResponse
    {
        $item = $this->newsRepository->getByID($id);

        return $this->json($item);

    }

}