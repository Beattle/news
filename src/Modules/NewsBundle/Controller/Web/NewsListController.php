<?php

namespace App\Modules\NewsBundle\Controller\Web;

use App\Modules\NewsBundle\Repository\NewsRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;

class NewsListController extends AbstractController
{

    private $newsRepository;

    public function __construct(NewsRepository  $newsRepository)
    {
        $this->newsRepository = $newsRepository;
    }

    /**
     * @Route ("/news", methods={"GET"}, name="get_collection")
     * @return Response
     */
    public function __invoke() :Response
    {
        $newsCollection = $this->newsRepository->getCollection([]);

        return $this->render(
            '@News/news/list.html.twig',
            [
                'news' => $newsCollection,
                'tags' => Tag::getTagsList(),
            ]
        );
    }

}