<?php
  class UsersContr extends Users {
    public function createUser($name, $password, $email) {
      $this->registerUser($name, $password, $email);
    }
  }
