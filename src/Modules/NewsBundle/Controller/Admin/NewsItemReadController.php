<?php

namespace App\Modules\NewsBundle\Controller\Admin;

use App\Modules\NewsBundle\Repository\NewsRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class NewsItemReadController extends AbstractController
{


    private $newsRepository;

    public function __construct(NewsRepository  $newsRepository)
    {
        $this->newsRepository = $newsRepository;
    }

    /**
     *
     * @Route("/api/news/item/{id}", methods={"GET"}, name="admin_item_read")
     */
    public function __invoke($id) :Response
    {
        $item = $this->newsRepository->getByID($id);

        return $this->render(
            '@News/admin/item.html.twig',
            [
                'item' => $item,
                'tags' => Tag::getTagsList(),
            ]
        );

    }

}