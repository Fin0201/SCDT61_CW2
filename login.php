<?php
    session_start();
    session_unset();
    $title = 'Login Page';
    require __DIR__ . "/inc/header.php";
    
    require __DIR__ . "/components/login-form.php";
    require __DIR__ . "/inc/footer.php";
?>