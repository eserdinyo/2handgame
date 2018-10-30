<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Routing\Annotation\Route;

class SellGameController extends Controller
{
    /**
     * @Route("/sell-game", name="sell_game")
     */
    public function index()
    {
        return $this->render('sell-game.html.twig', [
            'controller_name' => 'SellGameController',
        ]);
    }
}
