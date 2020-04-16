<?php

namespace App\Controller;

use App\Entity\Article;
use App\Entity\Comment;
use App\Entity\User;
use App\Form\ArticleType;
use App\Form\CommentType;
use App\Repository\ArticleRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class BlogController extends AbstractController {

    /**
    * @Route("/", name="home")
    */
    public function home(ArticleRepository $repo) {

      return $this->render('blog/home.html.twig', [
      'articles' => $repo->lastArticles(4)
  ]);

    }
    /**
     * @Route("/blog", name="blog")
     */
    public function index(ArticleRepository $repo) {

        return $this->render('blog/index.html.twig', [
            'articles' => $repo->findAll()
        ]);
    }

    /**
     * @Route("/about", name="about")
     *
     */
    public function about() {

        return $this->render('blog/about.html.twig');
    }

    /**
     * Créer un nouvel article
     *
     * @Route("/blog/new", name = "blog_create")
     * @Route("/blog/{id}/edit", name="blog_edit")
     *
     * @return Response
     */
    public function form(Request $request, EntityManagerInterface $manager, Article $article = null) {

        if(!$article) {
            $article = new Article;
        }

        $form = $this->createForm(ArticleType::Class, $article);

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {
            if(!$article->getId()) {
            $article->setCreatedAt(new \DateTime());
            }

            $manager->persist($article);
            $manager->flush();

            return $this->redirectToRoute('blog_show', [
                'id' => $article->getId()
            ]);
        }

        return $this->render('blog/create.html.twig', [
            'form' => $form->createView(),
            'editMode' => $article->getId() !== null
        ]);
    }


    /**
    * @Route("/blog/{id}", name="blog_show")
    */
    public function show(Article $article, Request $request, EntityManagerInterface $manager) {

        $comment = new Comment;
        $form = $this->createForm(CommentType::Class, $comment);

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {
            $comment->setCreatedAt(new \DateTime())
                    ->setArticle($article);


            $manager->persist($comment);
            $manager->flush();

            return $this->redirectToRoute('blog_show', ['id' => $article->getId()] );
        }

        return $this->render('blog/show.html.twig', [
            'article' => $article,
            'commentForm' => $form->createView()
        ]);
    }


}
