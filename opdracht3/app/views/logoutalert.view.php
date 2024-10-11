<?php if (isset($_SESSION['logout'])) {
    switch($_SESSION['logout']) {
        case 'success':
            unset($_SESSION['logout']); ?>
            <div class="container mt-5">
                <div class="alert alert-success" role="alert">
                    You have successfully logged out.
                </div>
            </div>
            <?php break;
        default:
            break;
    }
}
?>