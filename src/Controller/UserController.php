<?php

namespace App\Controller;

use App\Entity\Users;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Routing\Annotation\Route;

class UserController extends Controller
{
    /**
     * @Route("/admin/uyeler", name="uyeler")
     */
    public function index()
    {
        $users = $this -> getDoctrine()->getRepository(Users::class)->findAll();  
        return $this->render('admin/user_list.html.twig', [
            'users' => $users,
        ]);
    }
}
