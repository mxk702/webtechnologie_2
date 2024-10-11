<?php if (isset($_SESSION['login'])) {
    switch($_SESSION['login']) {
        case 'success':
            unset($_SESSION['login']); ?>
            <div class="container mt-5">
                <div class="alert alert-success" role="alert">
                    You have successfully logged in.
                </div>
            </div>
            <?php break;
        case 'error':
            unset($_SESSION['login']); ?>
            <div class="container mt-5">
                <div class="alert alert-danger" role="alert">
                    You entered a wrong e-mail address and/or password, please try logging in again.
                </div>
            </div>
            <?php break;
        default:
            break;
    }
}
?>