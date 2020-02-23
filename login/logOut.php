<?php
    session_start();
    session_unset();
    header('Location: /php_project/login/index.php');
?>