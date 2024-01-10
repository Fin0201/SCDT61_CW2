<?php
    require_once 'inc/functions.php';
    session_start();
    
    if (!isset($_SESSION['user']))
    {
        redirect('login', ["error" => "You need to be logged in to view this page"]);
    }

    $title = 'Member Page';
    require __DIR__ . "/inc/header.php";
?>

<h1>Welcome <?= $_SESSION['user']['firstname'] ?? 'Member' ?>!</h1>

<?php require __DIR__ . "/inc/footer.php"; ?>