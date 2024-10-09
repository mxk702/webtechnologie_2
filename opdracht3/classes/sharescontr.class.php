<?php
class SharesContr extends Shares
{
    // Functie om een nieuwe share aan te maken
    public function createNewShare($title, $body, $link, $userId) {
        return $this->createShare($title, $body, $link, $userId);
    }

    // Functie om alle shares te fetchen
    public function fetchAllShares() {
        return $this->getAllShares();
    }

    // Functie om één share op te vragen
    public function fetchShareById($id) {
        return $this->getShare($id);
    }

    // Functie om een share te updaten
    public function modifyShare($id, $title, $body, $link) {
        return $this->updateShare($id, $title, $body, $link);
    }

    // Functie om een share te verwijderen
    public function removeShare($id) {
        return $this->deleteShare($id);
    }
}