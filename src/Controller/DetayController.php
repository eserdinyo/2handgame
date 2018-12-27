<?php

namespace App\Controller;

use App\Entity\Games;
use App\Entity\Sales;
use App\Entity\Image;
use App\Entity\Sliders;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Routing\Annotation\Route;

class DetayController extends Controller
{
    /**
     * @Route("/oyun-detay/{id}", name="game-detay")
     */
    public function index($id)
    {   
        $images = $this->getDoctrine()->getRepository(Image::class)->findBy(["product_id" => $id]);
        $game = $this->getDoctrine()->getRepository(Games::class)->find($id);
        $sales = $this -> getDoctrine()->getRepository(Sales::class)->findBy(["oyunId"=> $id]);

         
        return $this->render('game-detay.html.twig', [
            'game' => $game,
            'sales' => $sales,
            'images' => $images,
        ]);
    }
}
