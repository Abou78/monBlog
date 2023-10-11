<?php

namespace Controllers;

use Symfony\Component\Mailer\Mailer;
use Symfony\Component\Mailer\Transport;
use Symfony\Component\Mime\Email;

require_once __DIR__ . '/../vendor/autoload.php';

class MainController{

    public function home($twig)
    {
        $success = '';
        if ($_SERVER['REQUEST_METHOD'] === 'POST'){
            //Retrieve form data 
            $lastname = $_POST['lastname'];
            $firstname = $_POST['firstname'];
            $email = $_POST['email'];
            $message = $_POST['message'];

            //Configure transportation
            $transport = Transport::fromDsn('smtp://localhost:1025');

            $mailer = new Mailer($transport);

            $email = (new Email())
                ->from($email)
                ->to('abou.diallo78@gmail.com')
                ->subject('Nouveau message de ' . $lastname . $firstname)
                ->text($message);

            $mailer->send($email);

            $success = 'Formulaire soumis avec succès';
            echo $twig->render('home.html.twig', 
            ['success' => $success]);
            }else{
                echo $twig->render('home.html.twig', array());
            }
        }

    public function articles($twig){
        echo $twig->render('home.html.twig', array());
    }
}