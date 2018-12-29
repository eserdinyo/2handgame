<?php

namespace App\Controller;

use App\Entity\Comments;
use App\Form\CommentsType;
use App\Repository\CommentsRepository;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("admin/comments")
 */
class CommentsController extends Controller
{
    /**
     * @Route("/", name="comments_index", methods="GET")
     */
    public function index(CommentsRepository $commentsRepository): Response
    {
        return $this->render('comments/index.html.twig', ['comments' => $commentsRepository->findAll()]);
    }

    /**
     * @Route("/new", name="comments_new", methods="GET|POST")
     */
    public function new(Request $request): Response
    {
        $comment = new Comments();
        $form = $this->createForm(CommentsType::class, $comment);
        $form->handleRequest($request);
        $gameID = $request->get('gameID');

        $submittedToken = $request->request->get('token');
   

        if($request->isMethod('POST')) {

            $em = $this->getDoctrine()->getManager();
            $em->persist($comment);
            $em->flush();

            return $this->redirectToRoute('game-detay', array('id' => $gameID));
        }
    

        return $this->render('comments/new.html.twig', [
            'comment' => $comment,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="comments_show", methods="GET")
     */
    public function show(Comments $comment): Response
    {
        return $this->render('comments/show.html.twig', ['comment' => $comment]);
    }

    /**
     * @Route("/{id}/{status}/edit", name="comments_edit", methods="GET|POST")
     */
    public function edit($id,$status,Request $request, Comments $comment): Response
    {   
        $em = $this->getDoctrine()->getManager();
        $comment = $em->getRepository(Comments::class)->find($id);
        
        if($status == "true") {
            $comment->setStatus('true');
            $em->flush();
        }else {
            $comment->setStatus('false');
            $em->flush();
        }

        return $this->redirectToRoute('comments_index');
    }

    /**
     * @Route("/delete/{id}", name="comments_delete", methods="GET|POST")
     */
    public function delete(Request $request, Comments $comment): Response
    {
            $em = $this->getDoctrine()->getManager();
            $em->remove($comment);
            $em->flush();
        

        return $this->redirectToRoute('comments_index');
    }

}
