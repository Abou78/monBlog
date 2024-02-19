<?php

namespace Services;

use Enum\UserTypeEnum;

final class UserRouteValidator
{

    /**
     * 
     * Check if the authenticated user connected
     */
    public function isUserAuthenticated(): bool
    {
        return isset($_SESSION);
    }


    /**
     * 
     * Check if the authenticated user is admin or not
     */
    public function isUserAdmin(): bool
    {
        return $this->isUserAuthenticated() && UserTypeEnum::ADMIN_TYPE === $_SESSION['userType'];
    }
    
}
