<?php if (isset($_SESSION['shareStatus'])) {
    switch($_SESSION['shareStatus']) {
        case 'created': ?>
            <div class="container mt-5">
                <div class="alert alert-success" role="alert">
                    The share has successfully been created!
                </div>
            </div>
            <?php break;
        case 'updated': ?>
            <div class="container mt-5">
                <div class="alert alert-info" role="alert">
                    Your share has successfully been updated.
                </div>
            </div>
            <?php break;
        case 'deleted': ?>
            <div class="container mt-5">
                <div class="alert alert-success" role="alert">
                    The share has successfully been deleted.
                </div>
            </div>
            <?php break;
        default:
            break;
    }
    unset($_SESSION['shareStatus']);
}
?>