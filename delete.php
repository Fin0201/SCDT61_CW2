<?php
    require_once './inc/functions.php';

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $action = $_POST['action'];
        switch ($action) {
            case "equipment":
                $id = $_POST['id'];
                $controllers->equipment()->delete_equipment($id);
                echo 'HERE';
                header("Location: inventory.php");
                break;
        }
    }
?>