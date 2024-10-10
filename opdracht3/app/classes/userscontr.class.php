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
}
