<?php
    $title = 'Categories Page';
    require __DIR__ . "/inc/header.php";

    require 'inc/functions.php';

    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        $action = $_POST['action'];
        $id = $_POST['id'];
        if ($action == "edit"){
            $currentItem = $controllers->categories()->get_category_by_id($id);
            ?>
            <script>
                $(document).ready(function(){
                    $("#edititemmodal").modal("show");
                });
            </script>
            <?php
        }
    }

    require __DIR__ . "/components/categories.php";

    require __DIR__ . "/inc/footer.php";
?>