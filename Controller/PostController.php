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

    } //end __construct().


    /**
     * Create a post.
     * 
     * @string
     */
    public function create(): string
    {

        if (!$this->userRouteValidator->isUserAdmin()) {
            throw new RouteNotAuthorizedException();
        } //end if().

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $article = new Article;
            $article->setTitle($_POST['title']);
            $article->setChapo($_POST['chapo']);
            $article->setContent($_POST['content']);

            try {
                $error = false;
                $this->postRepository->create($article, $_SESSION['userId']);

                header('location: http://monblog/listArticles');
            } catch ( PDOException $Exception ) {
                $error = true;
            }    
        } //end if().

        return $this->render('post/create.html.twig', [
            "error" => $error ?? false,
        ]);

    } //end create().


    /**
     * List all posts.
     * 
     * @string
     */
    public function list(): string
    {

        $articles = [];

        try {
            foreach($this->postRepository->list() as $article) {
                $articleObject = new Article();
                $articleObject->setId($article['id']);
                $articleObject->setTitle($article['title']);
                $articleObject->setChapo($article['chapo']);
    
                if(!empty($article['date_update'])){
                    $articleObject->setDateUpdate(new \DateTime($article['date_update']));
                } //end if().
    
                $articles[] = $articleObject;
            } //end foreach().
        } catch (\PDOException $exception) {
            $errorMessage = 'Les articles n\'ont pas été ajoutés.';
        }

        return $this->render('post/list.html.twig', [
            "articles" => $articles,
            'errorMessage' => $errorMessage ?? '',
        ]);

    } //end list().


    /**
     * List a post.
     * 
     * @string
     */
    public function read(): string
    {
        $postId = $_GET['id'];

        if (isset($_GET['error'])) {
            $error = $_GET['error'];
        } //end if().

        if ($postId === null) {
            $error = $_GET['error'];
        } //end if().

        $articleObject = new Article();

        $article = $this->postRepository->read($postId);

        $articleObject->setId($article['id']);
        $articleObject->setTitle($article['title']);
        $articleObject->setChapo($article['chapo']);
        $articleObject->setContent($article['content']);

        if (!empty($article['date_update'])) {
            $articleObject->setDateUpdate(new \DateTime($article['date_update']));
        } //end if().

        $commentRepository = new CommentRepository();
        $comments = [];

        foreach ($commentRepository->list($postId) as $comment) {
            $commentObject = new Comment();
            $commentObject->setId($comment['id']);
            $commentObject->setComment($comment['comment']);
            $commentObject->setDateCreation(new \DateTime($comment['date_creation']));

            $comments[] = $commentObject;
        } // end foreach().

        return $this->render('post/read.html.twig', [
            "article" => $article,
            "comments" => $comments,
            "error" => $error ?? false,
        ]);

    } //end read().


    /**
     * Delete a post.
     * 
     * @void
     */
    public function delete(): void
    {
        if (!$this->userRouteValidator->isUserAdmin()) {
            throw new RouteNotAuthorizedException();
        } //end if().

        $postId = $_GET['id'];

        try {
            $this->postRepository->delete($postId);
        } catch (\PDOException $exception) {
            header('location: http://monblog/article?error=1');

        }

        header('location: http://monblog/listArticles');

    } //end delete().


    /**
     * Update a post.
     * 
     * @string
     */
    public function update(): string
    {

        if (!$this->userRouteValidator->isUserAdmin()) {
            throw new RouteNotAuthorizedException();
        } //end if()
        
        $postId = $_GET['id'];

        if ($postId === null) {
            $errorMessage = 'Erreur ! l\'identifiant est introuvable.';
        } //end if()

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
            } catch ( PDOException $Exception ) {
                $error = true;
            }

            header('location: http://monblog/listArticles');
        } //end if()

        return $this->render('post/update.html.twig', [
            'article' => $this->postRepository->read($postId),
            "error" => $error ?? false,
            'errorMessage' => $errorMessage ?? '',
        ]);

    } //end update().

}