<?php
    require_once './inc/functions.php';

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $action = $_POST['action'];
        $id = $_POST['id'];
        echo "Action: ".$action;

        switch ($action) {
            case "equipment":
                $controllers->equipment()->delete_equipment($id);
                header("Location: inventory.php");
                break;
            case "members":
                $controllers->members()->delete_member($id);
                header("Location: members.php");
                break;
            case "roles":
                $controllers->roles()->delete_role($id);
                header("Location: roles.php");
                break;
            case "suppliers":
                $controllers->suppliers()->delete_supplier($id);
                header("Location: suppliers.php");
                break;
            case "categories":
                $controllers->categories()->delete_category($id);
                header("Location: categories.php");
                break;
        }
    }
?>