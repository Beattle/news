<?php

namespace App\Modules\NewsBundle\Controller\Admin;

use App\Modules\NewsBundle\Repository\NewsRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class NewsItemDeleteController extends AbstractController
{


    private $newsRepository;

    public function __construct(NewsRepository  $newsRepository)
    {
        $this->newsRepository = $newsRepository;
    }

    /**
     *
     * @Route("/api/news/item/{id}", methods={"POST"}, name="admin_item_delete")
     */
    public function __invoke($id) :Response
    {
        $item = $this->newsRepository->delete($id);

        $this->redirectToRoute('news_list');


    }

}