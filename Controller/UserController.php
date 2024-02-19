<?php

namespace Controller;

use Entity\User;
use Controller\BaseController;
use Exception;
use Repository\UserRepository;
use PDOException;
use Enum\UserTypeEnum;

final class UserController extends BaseController
{

    private UserRepository $userRepository;


    public function __construct()
    {

        $this->userRepository = new UserRepository();

    } //end__construct().


    public function login(): string
    {

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            try {
            $user = new User();
            $user->setEmail($_POST['email']);
            $user->setPassword($_POST['password']);
     
            $connectedUser = $this->userRepository->read($user);

            if (!password_verify($user->getPassword(), $connectedUser['password'])) {
                throw new Exception('Erreur ! les identifiants sont incorrects.');
            } //end if().

            $_SESSION['userId'] = $connectedUser['id'];
            $_SESSION['userType'] = $connectedUser['type'];
            $_SESSION['userFirstName'] = $connectedUser['first_name'];
            $_SESSION['userLastName'] = $connectedUser['last_name'];
            } catch (PDOException $exception ) {
                $errorMessage = '';
            } catch (\Exception $exception) {
                $errorMessage = 'Erreur ! l\'email ou le mot de passe est incorrect.';
            }
         } //end if().

        return $this->render('user/login.html.twig', [
            'errorMessage' => $errorMessage ?? '',
        ]);
    }


    public function registration(): string
    {

            if ($_SERVER['REQUEST_METHOD'] === 'POST') { 

                try {
                    if ($_POST['password'] !== $_POST['validPassword']) {
                        throw new Exception('Erreur ! Les deux mots de passe ne correspondent pas.');
                    } //end if().

                    if ($this->userRepository->isAlreadyEmailExist($_POST['email']) > 0) {
                        throw new Exception('Désolé ! l\'email existe déjà. Veuillez en choisir un autre.');
                    } //end if().

                    $user = new User();
                    $user->setFirstName($_POST['firstName']);
                    $user->setLastName($_POST['lastName']);
                    $user->setDescription($_POST['description']);
                    $user->setEmail($_POST['email']);
                    $user->setPassword(password_hash($_POST['password'], PASSWORD_DEFAULT));
                    $user->setDateCreation(new \DateTime());
                    $user->setType(UserTypeEnum::USER_TYPE);

                    $this->userRepository->create($user);

                    header('location: http://monblog/listArticles');

                } catch (PDOException $exception ) {
                    $errorMessage = '';
                    
                } catch (\Exception $exception) {
                    $errorMessage = 'Erreur ! l\'utilisateur n\'a pas été ajouté.';
                }   
            }

            return $this->render('user/registration.html.twig', [
                'errorMessage' => $errorMessage ?? '',
            ]); 
    } //end registration().


    public function logout(): void
    {
        session_destroy();

        header('location: http://monblog/');
    } //end logout().

}
