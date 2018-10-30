<?php

namespace App\Controller;

use App\Entity\Games;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Routing\Annotation\Route;

class DetayController extends Controller
{
    /**
     * @Route("/detay/{id}", name="detay")
     */
    public function index($id)
    {   
        $game = $this->getDoctrine()
        ->getRepository(Games::class)
        ->find($id);

        return $this->render('game-detay.html.twig', [
            'game' => $game,
        ]);
    }
}
