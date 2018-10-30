<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Routing\Annotation\Route;

class OyunEkleController extends Controller
{
    /**
     * @Route("admin/oyun-ekle", name="oyun_ekle")
     */
    public function index()
    {
        return $this->render('admin/oyun-ekle.html.twig', [
            'controller_name' => 'OyunEkleController',
        ]);
    }
}
