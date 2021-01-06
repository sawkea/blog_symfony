<?php

namespace App\Controller;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\HttpFoundation\Request;
use App\Entity\Article;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class BlogController extends AbstractController
{
    /**
     * @Route("/blog", name="blog")
     */
    public function index()
    {
        $repo = $this->getDoctrine()->getRepository(Article::class);

        $articles = $repo->findAll();

        return $this->render('blog/index.html.twig', [
            'controller_name' => 'BlogController',
            'articles' => $articles
        ]);
    }

    /**
     * @route("/", name="home")
     */
    // page d'accueil du site
    public function home() {
        // appeler le fichier twig
        return $this->render('blog/home.html.twig');
    }
    // lier cette fonction à une adresse en lui indiquant une route en commentaire au dessus @route


     /**
     * @Route("/blog/new", name="blog_create")
     */
    public function create(Request $request){
        
        $article = new Article();

        $form = $this->createFormBuilder($article)
                    ->add('title')
                    ->add('content')
                    ->add('image')
                    ->getForm();

        return $this->render('blog/create.html.twig', [
            'formArticle' => $form->createView()
        ]);
        
      
    }

    /**
     * @route("/blog/{id}", name="blog_show")
     */
    public function show($id){
        $repo = $this->getDoctrine()->getRepository(Article::class);
        $article = $repo->find($id);
        return $this->render('blog/show.html.twig', [
            'article' => $article
        ]);

    }

}
