<?php

namespace Controller;

use Controller\BaseController;
use Entity\Comment;
use Repository\CommentRepository;

final class CommentController extends BaseController
{

    private CommentRepository $commentRepository;


    public function __construct()
    {

        $this->commentRepository = new CommentRepository();

    } //end __construct().
    

    /**
     * Create comment.
     * 
     * @void
     */
    public function create(): void
    {

        $postId = $_GET['id'];

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            try {
                $comment = new Comment();
                $comment->setComment($_POST['comment']);
                $comment->setDateCreation(new \DateTime());
                $comment->setIsValid(false);
                $comment->setArticleId($postId);
                $this->commentRepository->create($comment, $_SESSION['userId']);
            } catch (\PDOException $exception) {
                header(sprintf('location: http://monblog/article?id=%s&error=1', $postId));
            }

        } //end if().

        header(sprintf('location: http://monblog/article?id=%s', $postId));

    } //end create().

}