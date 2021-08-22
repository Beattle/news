<?php

namespace App\Modules\NewsBundle\Controller\Web;

use App\Modules\NewsBundle\Repository\NewsRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;

class NewsItemReadController extends AbstractController
{

    private $newsRepository;

    public function __construct(NewsRepository  $newsRepository)
    {
        $this->newsRepository = $newsRepository;
    }

    /**
     * @Route ("/news/{item-id}", methods={"GET"}, name="get_web_item")
     * @param $catSlug
     * @param $item_id
     * @return Response
     * @throws \Doctrine\DBAL\Driver\Exception
     * @throws \Psr\Cache\InvalidArgumentException
     */
    public function __invoke($catSlug, $item_id) :Response
    {
        $newsCollection = $this->newsRepository->getByID($item_id);

        return $this->render(
            '@News/news/item.html.twig',
            [
                'news' => $newsCollection,
                'tags' => Tag::getTagsList(),
            ]
        );
    }

}