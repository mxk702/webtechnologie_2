<?php

class Users extends Dbh
{
    /*protected function getUser($naam) {
      $sql = "SELECT * FROM users WHERE users_voor = ?";
      $stmt = $this->connect()->prepare($sql);
      $stmt->execute([$naam]);
      // Use fetch() for 1 row, and fetchAll() for all rows
      $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
      return $results;
    }*/

    /*protected function setUser($voornaam, $achternaam, $gebdat) {
      $sql = "INSERT INTO users(users_voor, users_achter, users_gebdat) VALUES (?, ?, ?)";
      $stmt = $this->connect()->prepare($sql);
      $stmt->execute([$voornaam, $achternaam, $gebdat]);
    }*/

    protected function registerUser($name, $password, $email)
    {
        // Wachtwoord hashen
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
        // SQL-statement maken en uitvoeren
        $sql = "INSERT INTO users (name, password, email) VALUES (?, ?, ?)";
        $stmt = $this->connect()->prepare($sql);
        if (!$stmt->execute([$name, $hashedPassword, $email])) {
            return false; // Registratie is gefaald
        }
        return true; // Registratie is gelukt!
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
            return true;
        } else {
            return false; // Ongeldig wachtwoord of niet bestaande gebruiker
        }
    }

    protected function isUserLoggedIn()
    {
        return isset($_SESSION['userid']);
    }

    protected function logoutUser()
    {
        session_start();
        session_unset();
        session_destroy();
    }
}

