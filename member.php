<?php
    $title = 'Member Page';
    require __DIR__ . "/inc/header.php";
    require_once 'inc/functions.php';
    
    if (!isset($_SESSION['user']))
    {
        redirect('login', ["error" => "You need to be logged in to view this page"]);
    }
?>

<h1>Welcome <?= $_SESSION['user']['firstname'] ?? 'Member' ?>!</h1>

<a type="button" class="btn btn-primary" href="./login.php">Logout</a>

<?php require __DIR__ . "/inc/footer.php"; ?>