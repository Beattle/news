<?php

namespace App\Modules\NewsBundle\Controller\Admin;

use App\Modules\NewsBundle\Repository\NewsRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;

class NewsItemUpdateController extends AbstractController
{


    private $newsRepository;

    public function __construct(NewsRepository  $newsRepository)
    {
        $this->newsRepository = $newsRepository;
    }

    /**
     *
     * @Route("/api/news/item/{id}", methods={"POST"}, name="admin_item_update")
     */
    public function __invoke($id , Request $request) :Response
    {
        // Валидация данных и обновление
        $data = json_decode( $request->getContent());
        // validate
        $item = $this->newsRepository->update($id, $data);
        if ($item){
            $this->redirectToRoute('admin_item_read',['id' => $id]);
        }

    }

}