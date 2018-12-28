<?php

namespace App\Controller;

use App\Entity\Games;
use App\Entity\Sliders;
use App\Entity\User;

use App\Form\UserType;


use App\Entity\Admin\Category;
use App\Repository\CategoryRepository;
use App\Repository\SettingRepository;
use App\Repository\UserRepository;


use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Routing\Annotation\Route;

class FrontController extends Controller
{
    /**
     * @Route("/", name="home")
     */
    public function index(SettingRepository $settingRepository)
    {   
        $games = $this -> getDoctrine()->getRepository(Games::class)->findAll();  
        $sliders = $this -> getDoctrine()->getRepository(Sliders::class)->findAll(); 
        $data = $settingRepository->findAll();

        $cats = $this->categoryList();
        $cats[0] = '<ul id="menu-v">';

        return $this->render('default/index.html.twig', [
            'games' => $games,
            'sliders' => $sliders,
            'cats' => $cats,
            'data' => $data[0],
        ]);
    }

    public function categoryList($parent = 0, $user_tree_array = " ") {
        if(!is_array($user_tree_array))
            $user_tree_array = array();
        
        $em = $this->getDoctrine()->getManager();
        $sql = "SELECT * FROM category WHERE status='true' AND parent_id =".$parent;
        $statement = $em->getConnection()->prepare($sql);
        // $statement->bindValue('pid', $parent);
        $statement->execute();
        $result = $statement->fetchAll();

        if(count($result) > 0) {
            $user_tree_array[] = "<ul>";
            foreach ($result as $row) {
                if($row['parent_id'] == 0) {
                    $user_tree_array[] = "<li> <a href='javascript:;'>".$row['name']."</a>";
                }
                else {
                    $user_tree_array[] = "<li> <a href='/category/".$row['id']."'>".$row['name']."</a>";
                }
                $user_tree_array = $this->categoryList($row['id'], $user_tree_array);
            }

            $user_tree_array[] = "</li></ul>";
        }
        return $user_tree_array;
    }

    /**
     * @Route("/category/{catid}", name="category_products", methods="GET")
     */
    public function CategoryProducts($catid, CategoryRepository $catRepo)
    {   
        $data = $catRepo->findBy(
            ["id" => $catid]
        );
        $cats = $this->categoryList();
        $cats[0] = '<ul id="menu-v">';

        $em = $this->getDoctrine()->getManager();
        $sql = "SELECT * FROM games WHERE status ='true' AND category = :catid";
        $statement = $em->getConnection()->prepare($sql);
        $statement->bindValue('catid', $catid);
        $statement->execute();
        $games = $statement->fetchAll();
        
        return $this->render('list-games.html.twig', [
            'games' => $games,
            'data' => $data,
            'cats' => $cats,
        ]);

    }

    /**
     * @Route("/register", name="register", methods="GET|POST")
     */
    public function register(Request $request, UserRepository $userRepo): Response
    {
        $user = new User();
        $form = $this->createForm(UserType::class, $user);
        $form->handleRequest($request); 
        $submittedToken = $request->request->get('token');


        if ($this->isCsrfTokenValid('user-form', $submittedToken)) {
            $emailData = $userRepo->findBy(['email' => $user->getEmail()]);

            if(!$emailData) {
                if($form->isSubmitted()) {

                    $em = $this->getDoctrine()->getManager();
                    $em->persist($user);
                    $em->flush();
                    return $this->redirectToRoute('user_index');
                }
            }else {
                return $this->render('register.html.twig', [
              
                ]);
            }

          
        }

        return $this->render('register.html.twig', [
            'user' => $user,
            'form' => $form->createView(),
        ]);
    }


}
