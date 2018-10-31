<?php

namespace App\Controller;

use App\Entity\Games;
use App\Form\GamesType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class GameController extends Controller
{
    /**
     * @Route("/admin/oyunlar", name="oyunlar")
     */
    public function index()
    {   
        $games = $this -> getDoctrine()->getRepository(Games::class)->findAll();  
        return $this->render('admin/game/games.html.twig', [
            'games' => $games,
        ]);
    }

    /**
     * @Route("/admin/oyunlar/add", name="add-game", methods="GET|POST")
     */
    public function addGame(Request $request): Response
    {   
       $game = new Games();
       $form = $this->createForm(GamesType::class, $game);
       $form->handleRequest($request);

        //Save to DATABASE
        if($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($game);
            $em->flush();
            return $this->redirectToRoute('oyunlar');
        }

        return $this->render('admin/game/oyun-ekle.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
