<?php

namespace App\Controller;

use App\Entity\Games;
use App\Entity\Sliders;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Routing\Annotation\Route;

class FrontController extends Controller
{
    /**
     * @Route("/", name="home")
     */
    public function index()
    {   
        $games = $this -> getDoctrine()->getRepository(Games::class)->findAll();  
        $sliders = $this -> getDoctrine()->getRepository(Sliders::class)->findAll();  

        return $this->render('default/index.html.twig', [
            'games' => $games,
            'sliders' => $sliders,
        ]);
    }

}
