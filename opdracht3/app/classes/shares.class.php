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
        $_SESSION['shareStatus'] = 'created';
        return true; // Share is aangemaakt
    }

    protected function getAllShares()
    {
        // SQL-statement maken en uitvoeren
        $sql = "SELECT * FROM shares ORDER BY create_date DESC";
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
        $_SESSION['shareStatus'] = 'updated';
        return true; // Share geüpdatet
    }

    protected function deleteShare($id)
    {
        $share = $this->getShare($id);
        if(!$share || $_SESSION['userid'] != $share['user_id'])
        {
            return false;
        }
        // SQL-statement maken en uitvoeren
        $sql = "DELETE FROM shares WHERE id = ?";
        $stmt = $this->connect()->prepare($sql);
        if (!$stmt->execute([$id])) {
            return false; // Share niet verwijderd
        }
        $_SESSION['shareStatus'] = 'deleted';
        return true; // Share verwijderd
    }

    protected function processShareUpdate($shareId, $data = null) {
        $userController = new UsersContr();

        // Is de gebruiker wel ingelogd?
        if (!$userController->checkUserLoggedIn()) {
            header("Location: /login");
            exit();
        }

        // Opvragen van de share
        $share = $this->fetchShareById($shareId);
        if (!$share || $share['user_id'] != $_SESSION['userid']) {
            // Als de share er niet is of niet van de ingelogd gebruiker is, gaan we de user niets laten/kunnen updaten
            header("Location: /shares");
            exit();
        }

        // Als de request method POST is, willen we een share updaten
        if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($data['title'], $data['body'], $data['link'])) {
            $title = $data['title'];
            $body = $data['body'];
            $link = $data['link'];

            // Share daadwerkelijk bijwerken
            $this->updateShare($shareId, $title, $body, $link);

            // ... En naar de shares-pagina om de bijgewerkte share te zien
            header("Location: /shares");
            exit();
        }

        // Return the share object so it can be displayed in the form for GET requests
        return $share;
    }
}