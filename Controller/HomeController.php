<?php

namespace Controller;

use Symfony\Component\Mime\Email;
use Symfony\Component\Mailer\Mailer;
use Symfony\Component\Mailer\Transport;

class HomeController extends BaseController
{


    public function home()
    {

        $success = '';

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Retrieve form data 
            $lastname = $_POST['lastname'];
            $firstname = $_POST['firstname'];
            $email = $_POST['email'];
            $message = $_POST['message'];

            // Configure transportation
            $transport = Transport::fromDsn('smtp://localhost:1025');

            $mailer = new Mailer($transport);

            $email = (new Email())
                ->from($email)
                ->to('abou.diallo78@gmail.com')
                ->subject('Nouveau message de '.$lastname.$firstname)
                ->text($message);

            $mailer->send($email);

            $success = 'Formulaire soumis avec succès';
            echo $this->render('home.html.twig', ['success' => $success]);
        } else {
            echo $this->render('home.html.twig');
        } //end if().

    } //end home().

}