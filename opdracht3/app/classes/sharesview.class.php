<?php
class SharesView
{
    // Functie om alle shares weer te geven
    public function showAllShares($shares)
    {
        $userController = new UsersContr();
        $loggedIn = $userController->checkUserLoggedIn();
        foreach ($shares as $share) {
            echo "<div class='card mb-3 bg-light border'>";
            echo '  <div class="card-body">';
            echo "<h2 class='card-title'>" . htmlspecialchars($share['title']) . "</h2>";

            $date = new DateTime($share['create_date']);
            $user = $userController->checkUsername($share['user_id']);
            echo "<p class='card-text'><small class='text-muted'>Posted on " . $date->format('d-m-Y')  . " by " . $user . "</small></p>";

            echo "<p class='card-text'>" . htmlspecialchars($share['body']) . "</p>";
            echo "<a href='" . htmlspecialchars($share['link']) . "' class='btn btn-primary btn-sm' target='_blank'>Go to website</a>";

            if ($loggedIn && $share['user_id'] == $_SESSION['userid']) {
                echo '    <hr class="my-3">'; // Add spacing with margin
                echo '<div class="mt-2">';
                echo "<form action='/delete_share' method='post' style='display:inline;'>";
                echo "<input type='hidden' name='share_id' value='" . htmlspecialchars($share['id']) . "'>";
                echo "<button class='btn btn-danger btn-sm' type='submit' onclick='return confirm(\"Are you sure you want to delete this share?\");'>Delete</button>";
                echo "</form>";
                echo "&nbsp;";
                echo "<form action='/update_share' method='get' style='display:inline;'>";
                echo "<input type='hidden' name='share_id' value='" . htmlspecialchars($share['id']) . "'>";
                echo "<button class='btn btn-secondary btn-sm' type='submit'>Edit</button>";
                echo "</form>";
                echo '</div>';
            }
            echo '  </div>';
            echo "</div>";
        }
    }
}