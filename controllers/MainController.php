<?php

namespace Controllers;

class MainController{

    public function home($twig)
    {
        $success = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST'){
   $lastname = $_POST['lastname'];
   $firstname = $_POST['firstname'];
   $email = $_POST['email'];
   $message = $_POST['message'];
   $success = 'Formulaire soumis avec succès';
   echo $twig->render('home.html.twig', 
   ['success' => $success]);
}
        echo $twig->render('home.html.twig', array());
    }

    public function articles($twig){
        echo $twig->render('home.html.twig', array());
    }
}