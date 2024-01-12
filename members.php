<?php
    $title = 'Users Page';
    require __DIR__ . "/inc/header.php";

    require 'inc/functions.php';

    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        $action = $_POST['action'];
        $id = $_POST['id'];
        if ($action == "edit"){
            $currentItem = $controllers->members()->get_member_by_id($id);
            ?>
            <script>
                $(document).ready(function(){
                    $("#edititemmodal").modal("show");
                });
            </script>
            <?php
        }
    }
    require __DIR__ . "/components/members.php";

    require __DIR__ . "/inc/footer.php";
?>