<?php

namespace Controllers;

class MainController{

    public function home($twig)
    {
        echo $twig->render('home/index.html.twig', array());
    }

    public function articles(){
        return 'Page d\'articles';
    }
}