<?php

class shares extends Dbh
{
    protected function createShare($title, $body, $link, $user_id)
    {
        // SQL-statement maken en uitvoeren
        $sql = "INSERT INTO shares (title, body, link, user_id) VALUES (?, ?, ?, ?)";
        $stmt = $this->connect()->prepare($sql);
        if (!$stmt->execute([$title, $body, $link, $user_id])) {
            return false; // Share niet succesvol aangemaakt
        }
        return true; // Share is aangemaakt
    }

    protected function getAllShares()
    {
        // SQL-statement maken en uitvoeren
        $sql = "SELECT * FROM shares";
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    protected function getShare($id)
    {
        // SQL-statement maken en uitvoeren
        $sql = "SELECT * FROM shares WHERE id = ?";
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    protected function updateShare($id, $title, $body, $link)
    {
        // SQL-statement maken en uitvoeren
        $sql = "UPDATE shares SET title = ?, body = ?, link = ? WHERE id = ?";
        $stmt = $this->connect()->prepare($sql);
        if (!$stmt->execute([$title, $body, $link, $id])) {
            return false; // Share niet geüpdatet
        }
        return true; // Share geüpdatet
    }

    protected function deleteShare($id)
    {
        $share = $this->getShare($id);
        $userController = new UsersContr();
        $loggedIn = $userController->checkUserLoggedIn();
        if(!$share || !$loggedIn || $_SESSION['userid'] != $share['user_id'])
        {
            return false;
        }
        // SQL-statement maken en uitvoeren
        $sql = "DELETE FROM shares WHERE id = ?";
        $stmt = $this->connect()->prepare($sql);
        if (!$stmt->execute([$id])) {
            return false; // Share niet verwijderd
        }
        return true; // Share verwijderd
    }
}