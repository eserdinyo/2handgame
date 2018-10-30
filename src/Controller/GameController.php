<?php

namespace App\Controller;

use App\Entity\Games;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Routing\Annotation\Route;

class GameController extends Controller
{
    /**
     * @Route("/admin/oyunlar", name="oyunlar")
     */
    public function index()
    {   
        $games = $this -> getDoctrine()->getRepository(Games::class)->findAll();  
        return $this->render('admin/games.html.twig', [
            'games' => $games,
        ]);
    }
}
