<?php

namespace App\Policies;

use App\User;

class UserPolicy
{
    /**
     * [ALLOWS]
     * Determines if a user can create another user
     *  Super Admin (Usertype = 1) can create all types of user
     *  Admin (Usertype = 2) can ONLY create client (Usertype = 3)
     *  Client (Usertype = 3) cannot create another user
     * 
     * @param user - User Logged-in
     * @param created_user - User to be created
     * 
     * @return boolean - true: authorized, false: unauthorized
     */
    public function store(User $user, User $created_user)
    {
        // Client cannot create a user
        if ($user->isClient()) return false;

        // Admin can only create clients and not other usertypes
        if ($user->isAdmin() && !$created_user->isClient()) return false;

        return true;
    }
}
