<?php

namespace App\Modules\NewsBundle\Controller\Admin;

use App\Modules\NewsBundle\Repository\NewsRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;

class NewsItemCreateController extends AbstractController
{


    private $newsRepository;

    public function __construct(NewsRepository  $newsRepository)
    {
        $this->newsRepository = $newsRepository;
    }

    /**
     *
     * @Route("/api/news/item/{id}", methods={"POST"}, name="admin_item_create")
     */
    public function __invoke(Request $request) :Response
    {
       $id = $this->newsRepository->create(json_decode($request->getContent()));

       return $this->redirectToRoute('admin_item_read', ['id' => $id]);

    }

}