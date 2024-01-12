<?php
    $title = 'Login Page';
    session_start();
    session_unset();
    require __DIR__ . "/inc/header.php";
    
    require __DIR__ . "/components/login-form.php";
    require __DIR__ . "/inc/footer.php";
?>