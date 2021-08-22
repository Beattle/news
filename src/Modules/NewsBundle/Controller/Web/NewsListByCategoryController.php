<?php

namespace App\Modules\NewsBundle\Controller\Web;

use App\Modules\NewsBundle\Repository\NewsRepository;
use http\Client\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;

class NewsListByCategoryController extends AbstractController
{

    private $newsRepository;

    public function __construct(NewsRepository  $newsRepository)
    {
        $this->newsRepository = $newsRepository;
    }

    /**
     * @Route ("/news/{category-id}", methods={"GET"}, name="get_collection_category")
     * @return Response
     */
    public function __invoke($category_id, Request $request) :Response
    {
        $newsCollection = $this->newsRepository->getCollection(
            ['sections' => $category_id],
            ['publish_date' => 'desc']
        );

        return $this->render(
            '@News/news/list.html.twig',
            [
                'news' => $newsCollection,
                'tags' => Tag::getTagsList(),
            ]
        );
    }

}