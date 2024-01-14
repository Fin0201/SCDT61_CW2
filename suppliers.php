<?php
    $title = 'Suppliers Page';
    require __DIR__ . "/inc/header.php";

    require 'inc/functions.php';

    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        $action = $_POST['action'];
        $id = $_POST['id'];
        if ($action == "edit"){
            $currentItem = $controllers->suppliers()->get_supplier_by_id($id);
            ?>
            <script>
                $(document).ready(function(){
                    $("#edititemmodal").modal("show");
                });
            </script>
            <?php
        }
    }

    require __DIR__ . "/components/suppliers.php";

    require __DIR__ . "/inc/footer.php";
?>