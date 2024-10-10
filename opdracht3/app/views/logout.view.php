<?php
session_unset();
session_destroy();

// Naar homepage sturen
header("Location: ?page=home");
exit();
?>