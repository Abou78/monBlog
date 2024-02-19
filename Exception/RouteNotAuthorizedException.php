<?php

namespace Exception;

class RouteNotAuthorizedException extends \Exception
{

    protected $message = 'Vous n\'avez pas accès à cette URL !';
    
}