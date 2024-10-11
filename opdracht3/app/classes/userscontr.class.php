<?php

class UsersContr extends Users
{
    public function createUser($name, $password, $email)
    {
        return $this->registerUser($name, $password, $email);
    }

    public function signInUser($email, $password)
    {
        return $this->loginUser($email, $password);
    }

    public function signOutUser()
    {
        $this->logoutUser();
    }

    public function checkUserLoggedIn()
    {
        return $this->isUserLoggedIn();
    }

    public function removeUser() {
        return $this->deleteUser();
    }
}
