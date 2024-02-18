<?php

namespace Controller;

use PDOException;
use Entity\Comment;
use Controller\BaseController;
use Repository\AdminRepository;
use Services\UserRouteValidator;
use Exception\RouteNotAuthorizedException;

final class AdminController extends BaseController
{
    private AdminRepository $adminRepository;
    private UserRouteValidator $userRouteValidator;

    public function __construct()
    {
        $this->adminRepository = new adminRepository();
        $this->userRouteValidator = new UserRouteValidator();
    }

    public function commentToValidate(): string
    {
        $userRouteValidator = new UserRouteValidator();

        if (!$userRouteValidator->isUserAdmin()) {
            throw new RouteNotAuthorizedException();
        }
        
        // Display number to comment to validate
        
        $commentToValidate = $this->adminRepository->commentToValidate();

        // Display comments to validate
        $comments = [];

        foreach($this->adminRepository->list() as $comment) {
            $commentObject = new Comment();
            $commentObject->setId($comment['id']);
            $commentObject->setComment($comment['comment']);
            $commentObject->setDateCreation(new \DateTime($comment['date_creation']));

            $comments[] = $commentObject;
        }

        return $this->render('admin/administration.html.twig', [
            "commentToValidate" => $commentToValidate,
            "comments" => $comments,
        ]);
    }


    public function update(): void
    {
        /*if (!$this->userRouteValidator->isUserAdmin()) {
            throw new RouteNotAuthorizedException();
        }*/

        //comment validate
        $postId = $_GET['id'];

        if (!$postId) {
            // todo : afficher une erreur dans la vue
        }

        try {
            $this->adminRepository->update($postId);
        } catch(\PDOException $exception) {
            header('location: http://monblog/administration?error=1');

        }

        header('location: http://monblog/administration');
    }
}
