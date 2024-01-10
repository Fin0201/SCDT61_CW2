<?php
    $title = 'Register Page';
    session_start();
    session_unset();
    require __DIR__ . "/inc/header.php";
    

    require __DIR__ . "/components/reg-form.php";

    require __DIR__ . "/inc/footer.php";
?>