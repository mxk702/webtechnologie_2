<?php

class SharesView
{
    // Functie om één share weer te gevem
    public function showShare($share)
    {
        echo "<h2>" . htmlspecialchars($share['title']) . "</h2>";
        echo "<p>" . htmlspecialchars($share['body']) . "</p>";
        echo "<a href='" . htmlspecialchars($share['link']) . "'>Read more</a><br>";
    }

    // Functie om alle shares weer te geven
    public function showAllShares($shares)
    {
        foreach ($shares as $share) {
            echo "<div>";
            echo "<h2>" . htmlspecialchars($share['title']) . "</h2>";
            echo "<p>" . htmlspecialchars($share['body']) . "</p>";
            echo "<a href='" . htmlspecialchars($share['link']) . "'>Read more</a><br>";
            echo "</div>";
        }
    }
}