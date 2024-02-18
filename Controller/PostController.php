<?php

namespace Controller;

use PDOException;
use Entity\Article;
use Entity\Comment;
use Controller\BaseController;
use Repository\PostRepository;
use Services\UserRouteValidator;
use Repository\CommentRepository;
use Exception\RouteNotAuthorizedException;

final class PostController extends BaseController
{
    private PostRepository $postRepository;
    private UserRouteValidator $userRouteValidator;

    public function __construct()
    {
        $this->postRepository = new PostRepository();
        $this->userRouteValidator = new UserRouteValidator();
    }

    public function create(): string
    {
        if (!$this->userRouteValidator->isUserAdmin()) {
            throw new RouteNotAuthorizedException();
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $article = new Article;
            $article->setTitle($_POST['title']);
            $article->setChapo($_POST['chapo']);
            $article->setContent($_POST['content']);

            try {
                $error = false;
                $this->postRepository->create($article, $_SESSION['userId']);

                header('location: http://monblog/listArticles');
            } catch( PDOException $Exception ) {
                $error = true;
            }    
        }

        return $this->render('post/create.html.twig', [
            "error" => $error ?? false,
        ]);
    }

    public function list(): string
    {
        $articles =[];

        try {
            foreach($this->postRepository->list() as $article) {
                $articleObject = new Article();
                $articleObject->setId($article['id']);
                $articleObject->setTitle($article['title']);
                $articleObject->setChapo($article['chapo']);
    
                if(!empty($article['date_update'])){
                    $articleObject->setDateUpdate(new \DateTime($article['date_update']));
                }
    
                $articles[] = $articleObject;
            }
        } catch (\PDOException $exception) {
            // todo : ajouter la logique d'erreur
        }

        return $this->render('post/list.html.twig', [
            "articles" =>  $articles,
        ]);
    }

    public function read(): string
    {
        $postId = $_GET['id'];

        if (isset($_GET['error'])) {
            $error = $_GET['error'];
        }

        // Récupérer dans l'URL la variable error si elle existe 

        if ($postId === null) {
            //afficher une erreur dans la vue
        }
        $articleObject = new Article();

        $article = $this->postRepository->read($postId);

        $articleObject->setId($article['id']);
        $articleObject->setTitle($article['title']);
        $articleObject->setChapo($article['chapo']);
        $articleObject->setContent($article['content']);

        if(!empty($article['date_update'])){
            $articleObject->setDateUpdate(new \DateTime($article['date_update']));
        }

        $commentRepository = new CommentRepository();
        $comments = [];

        foreach($commentRepository->list($postId) as $comment) {
            $commentObject = new Comment();
            $commentObject->setId($comment['id']);
            $commentObject->setComment($comment['comment']);
            $commentObject->setDateCreation(new \DateTime($comment['date_creation']));

            $comments[] = $commentObject;
        }

        return $this->render('post/read.html.twig', [
            "article" => $article,
            "comments" => $comments,
            "error" => $error ?? false,
        ]);
    }

    public function delete(): void
    {
        if (!$this->userRouteValidator->isUserAdmin()) {
            throw new RouteNotAuthorizedException();
        }

        $postId = $_GET['id'];

        if (!$postId) {
            // todo : afficher une erreur dans la vue
        }

        try {
            $this->postRepository->delete($postId);
        } catch(\PDOException $exception) {
            header('location: http://monblog/article?error=1');

        }

        header('location: http://monblog/listArticles');
    }

    public function update(): string
    {
        if (!$this->userRouteValidator->isUserAdmin()) {
            throw new RouteNotAuthorizedException();
        }
        
        $postId = $_GET['id'];

        if ($postId === null) {
            //afficher une erreur dans la vue
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $article = new Article;
            $article->setTitle($_POST['title']);
            $article->setChapo($_POST['chapo']);
            $article->setContent($_POST['content']);
            $article->setDateUpdate(new \DateTime());
            $article->setId($postId);

            try {
                $error = false;
                $this->postRepository->update($article, $_SESSION['userId']);
            } catch( PDOException $Exception ) {
                $error = true;
            }

            header('location: http://monblog/listArticles');
        }

        return $this->render('post/update.html.twig', [
            'article' => $this->postRepository->read($postId),
            'error' => $error,
        ]);
    }
}