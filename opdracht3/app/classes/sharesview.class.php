<?php
class SharesView
{
    // Functie om alle shares weer te geven
    public function showAllShares($shares)
    {
        $userController = new UsersContr();
        $loggedIn = $userController->checkUserLoggedIn();
        foreach ($shares as $share) {
            echo "<div>";
            echo "<h2>" . htmlspecialchars($share['title']) . "</h2>";
            echo "<p>" . htmlspecialchars($share['body']) . "</p>";
            echo "<a href='" . htmlspecialchars($share['link']) . "'>Read more</a><br>";
            echo "<p><i>Posted on " . htmlspecialchars($share['create_date']) . "</i></p>";

            if ($loggedIn && $share['user_id'] == $_SESSION['userid']) {
                echo "<form action='/delete_share' method='post' style='display:inline;'>";
                echo "<input type='hidden' name='share_id' value='" . htmlspecialchars($share['id']) . "'>";
                echo "<button type='submit' onclick='return confirm(\"Are you sure you want to delete this share?\");'>Delete</button>";
                echo "</form>";
            }

            echo "</div>";
        }
    }
}