<?php

namespace App\Controller;

use App\Entity\Sliders;
use App\Form\SlidersType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class SliderController extends Controller
{
    /**
     * @Route("/admin/slider", name="slider")
     */
    public function index()
    {   
        $sliders = $this -> getDoctrine()->getRepository(Sliders::class)->findAll();  
        return $this->render('admin/slider/slider.html.twig', [
            'sliders' => $sliders,
        ]);
    }

    /**
     * @Route("/admin/slider/ekle", name="add-slider", methods="GET|POST")
     */
    public function addSlider(Request $request): Response
    {   
        $slider = new Sliders();
        $form = $this->createForm(SlidersType::class, $slider);
        $form->handleRequest($request);

        //Save to DATABASE
        if($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($slider);
            $em->flush();
            return $this->redirectToRoute('slider');
        }

        return $this->render('admin/slider/slider-ekle.html.twig');
    }
}
