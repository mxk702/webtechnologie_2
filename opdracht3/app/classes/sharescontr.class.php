<?php

class SharesContr extends Shares
{
    // Functie om een nieuwe share aan te maken
    public function createNewShare($title, $body, $link, $userId)
    {
        return $this->createShare($title, $body, $link, $userId);
    }

    // Functie om alle shares te fetchen
    public function fetchAllShares()
    {
        return $this->getAllShares();
    }

    // Functie om één share op te vragen
    public function fetchShareById($id)
    {
        return $this->getShare($id);
    }

    // Functie om een share te verwijderen
    public function removeShare($id)
    {
        return $this->deleteShare($id);
    }

    // Verwerken van verzoeken om shares te wijzigen
    public function handleShareUpdate($shareId, $data = null)
    {
        return $this->processShareUpdate($shareId, $data);
    }
}