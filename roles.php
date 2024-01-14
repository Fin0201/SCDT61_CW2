<?php
    $title = 'Roles Page';
    require __DIR__ . "/inc/header.php";

    require 'inc/functions.php';

    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        $action = $_POST['action'];
        $id = $_POST['id'];
        if ($action == "edit"){
            $currentItem = $controllers->roles()->get_role_by_id($id);
            ?>
            <script>
                $(document).ready(function(){
                    $("#edititemmodal").modal("show");
                });
            </script>
            <?php
        }
    }

    require __DIR__ . "/components/roles.php";

    require __DIR__ . "/inc/footer.php";
?>