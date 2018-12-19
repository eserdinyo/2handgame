<?php

namespace App\Controller;

use App\Entity\Games;
use App\Entity\Sliders;
use App\Entity\Admin\Category;
use App\Repository\CategoryRepository;
use App\Repository\SettingRepository;




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
                $user_tree_array[] = "<li> <a href='category/".$row['id']."'>".$row['name']."</a>";
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


}
