<?php
    require 'inc/functions.php'; 

    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        $action = $_POST['action'];
        echo $action;
        switch ($action) {
            case "equipment":
                // Gets the id of the equipment
                $id = $_POST['id'];
                $name = $_POST['name'];
                $description = $_POST['description'];
                $image = $_FILES['image'];
                $sellprice = $_POST['sell_price'];
                $buyprice = $_POST['buy_price'];
                $stock = $_POST['stock'];
                
                if ($image['name'] != "") {
                    $imagename = $image['name'];
                    // Temporary image name
                    $imagetempname = $image['tmp_name'];
                    // Removes the file extension from the uploaded image
                    $fileExt = explode('.', $imagename);
                    // Changes the string to lowercase
                    $extension = strtolower(end($fileExt));
                    // Createsa uniqueid for the file
                    $newfile = guidv4().'.'.$extension;
                    // Sets the destination of the file
                    $filedestination = 'images/inventory/'.$newfile;
                    // Moves the file to the given location
                    move_uploaded_file($imagetempname, $filedestination);
                    // Deletes the original file
                    $originalImage = $controllers->equipment()->get_equipment_by_id($id)['image'];
                    unlink($originalImage);
                } else {
                    $filedestination = $controllers->equipment()->get_equipment_by_id($id)['image'];
                }
                
                $args = array(
                    'id'=>$id,
                    'name'=>$name,
                    'description'=>$description,
                    'image'=>$filedestination,
                    'sell_price'=>$sellprice,
                    'buy_price'=>$buyprice,
                    'stock'=>$stock,
                );

                // Creates the equipment
                $controllers->equipment()->update_equipment($args);
                // Returns the user back to the inventory page
                header('Location: inventory.php');
                break;
            case "members":
                $id = $_POST['id'];
                $firstname = $_POST['firstname'];
                $lastname = $_POST['lastname'];
                $email = $_POST['email'];
                $args = array(
                    'id'=>$id,
                    'firstname'=>$firstname,
                    'lastname'=>$lastname,
                    'email'=>$email,
                );
                // Updates the user with the given information
                $controllers->members()->update_member($args);
                // Returns the user back to the users page
                header('Location: members.php');
                break;
        }
    }
?>