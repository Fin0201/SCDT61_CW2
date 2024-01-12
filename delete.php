<?php
    require_once './inc/functions.php';

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $action = $_POST['action'];
        echo $action;
        switch ($action) {
            case "equipment":
                $id = $_POST['id'];
                $controllers->equipment()->delete_equipment($id);
                header("Location: inventory.php");
                break;
            case "members":
                $id = $_POST['id'];
                echo $id;
                $controllers->members()->delete_member($id);
                header("Location: members.php");
                break;
        }
    }
?>