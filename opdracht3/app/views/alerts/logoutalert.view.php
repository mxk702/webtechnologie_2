<?php if (isset($_SESSION['logout'])) {
    switch($_SESSION['logout']) {
        case 'success':?>
            <div class="container mt-5">
                <div class="alert alert-success" role="alert">
                    You have successfully logged out.
                </div>
            </div>
            <?php break;
        default:
            break;
    }
    unset($_SESSION['logout']);
}
?>