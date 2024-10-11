<?php if (isset($_SESSION['registration'])) {
    switch($_SESSION['registration']) {
        case 'success':
            unset($_SESSION['registration']); ?>
            <div class="container mt-5">
                <div class="alert alert-success" role="alert">
                    Your account was successfully created. You can now log in.
                </div>
            </div>
            <?php break;
        case 'fail':
            unset($_SESSION['registration']); ?>
            <div class="container mt-5">
                <div class="alert alert-danger" role="alert">
                    Something went wrong wile creating your account, please try again.
                </div>
            </div>
            <?php break;
        case 'emailInUse':
            unset($_SESSION['registration']); ?>
            <div class="container mt-5">
                <div class="alert alert-danger" role="alert">
                    The provided email address is already in use, please log in or use a different email address.
                </div>
            </div>
            <?php break;
        default:
            break;
    }
}
?>