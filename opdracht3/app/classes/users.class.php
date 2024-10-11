<?php

class Users extends Dbh
{
    protected function registerUser($name, $password, $email)
    {
        // Kijken of emailadres al in gebruik is
        if($this->checkEmailExists($email)) {
            $_SESSION['registration'] = 'emailInUse';
            return false;
        }
        // Wachtwoord hashen
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
        // SQL-statement maken en uitvoeren
        $sql = "INSERT INTO users (name, password, email) VALUES (?, ?, ?)";
        $stmt = $this->connect()->prepare($sql);
        if (!$stmt->execute([$name, $hashedPassword, $email])) {
            $_SESSION['registration'] = 'fail';
            return false; // Registratie is gefaald
        }
        $_SESSION['registration'] = 'success';
        return true; // Registratie is gelukt
    }

    protected function checkEmailExists($email)
    {
        $sql = "SELECT * FROM users WHERE email = ?";
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute([$email]);
        $emailExists = $stmt->fetch();
        return $emailExists;
    }

    protected function loginUser($email, $password)
    {
        // SQL-statement maken en uitvoeren
        $sql = "SELECT * FROM users WHERE email = ?";
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute([$email]);

        // User fetchen
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        // Wachtwoord checken
        if ($user && password_verify($password, $user['password'])) {
            // Alles klopt, dus sessie starten
            session_start();
            $_SESSION['userid'] = $user['id'];
            $_SESSION['name'] = $user['name'];
            $_SESSION['email'] = $user['email'];
            $_SESSION['register_date'] = $user['register_date'];
            $_SESSION['login'] = 'success';
            return true;
        } else {
            $_SESSION['login'] = 'error';
            return false; // Ongeldig wachtwoord of niet bestaande gebruiker
        }
    }

    protected function isUserLoggedIn()
    {
        return isset($_SESSION['userid']);
    }

    protected function logoutUser()
    {
        session_unset();
        $_SESSION['logout'] = 'success';
    }

    protected function deleteUser()
    {
          if(!isset($_SESSION['userid'])) {
              return false;
          }
          $sql = "DELETE FROM users WHERE id = ?";
          $stmt = $this->connect()->prepare($sql);
          if (!$stmt->execute([$_SESSION['userid']])) {
              return false;
          }
          session_unset();
          return true;
    }

}

