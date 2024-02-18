<?php

namespace Services;

use Enum\UserTypeEnum;

final class UserRouteValidator
{
    public function isUserAuthenticated(): bool
    {
        return isset($_SESSION['user']);
    }

    public function isUserAdmin(): bool
    {
        return $this->isUserAuthenticated() && UserTypeEnum::ADMIN_TYPE === $_SESSION['userType'];
    }
}
