<?php

namespace App\Controller;

use App\Entity\Sliders;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Routing\Annotation\Route;

class SliderController extends Controller
{
    /**
     * @Route("/admin/slider", name="slider")
     */
    public function index()
    {   
        $sliders = $this -> getDoctrine()->getRepository(Sliders::class)->findAll();  
        return $this->render('admin/slider.html.twig', [
            'sliders' => $sliders,
        ]);
    }
}
