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

    } //end __construct().


    public function administration(): string
    {

        $userRouteValidator = new UserRouteValidator();

        if (!$userRouteValidator->isUserAdmin()) {
            throw new RouteNotAuthorizedException();
        } //end if().
        
        // Display number to comment to validate.
        $commentToValidate = $this->adminRepository->commentToValidate();

        // Display comments to validate.
        $comments = [];

        foreach ($this->adminRepository->list() as $comment) {
            $commentObject = new Comment();
            $commentObject->setId($comment['id']);
            $commentObject->setComment($comment['comment']);
            $commentObject->setDateCreation(new \DateTime($comment['date_creation']));

            $comments[] = $commentObject;
        } //end foreach().

        return $this->render('admin/administration.html.twig', [
            "commentToValidate" => $commentToValidate,
            "comments" => $comments,
            ]);

    } //end commentToValidate().
    

    /**
     * Comment to validate.
     * 
     * @void
     */
    public function validateComment(): void
    {

        if (!$this->userRouteValidator->isUserAdmin()) {
            throw new RouteNotAuthorizedException();
        }

        $postId = $_GET['id'];

        if (!$postId) {
            header('location: http://monblog/administration?error=1');
        } //end if().

        try {
            $this->adminRepository->validateComment($postId);
        } catch (\PDOException $exception) {
            header('location: http://monblog/administration?error=1');
        }
        header('location: http://monblog/administration');

    } //end update().

}
