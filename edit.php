<?php
    require 'inc/functions.php'; 

    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        $action = $_POST['action'];
        echo "Action: ".$action;

        switch ($action) {
            case "equipment":
                // Gets the id of the equipment
                $id = $_POST['id'];
                $name = $_POST['name'];
                $description = $_POST['description'];
                $image = $_FILES['fileToUpload'];
                $sellprice = $_POST['sell_price'];
                $buyprice = $_POST['buy_price'];
                $stock = $_POST['stock'];
                $categoryId = $_POST['categoryId'];
                $supplierId = $_POST['supplierId'];
            
                // If the image field has a file
                if ($image['name'] != "") {
                    // Gets image name, path, and file type info
                    $imageName = guidv4();
                    $imageExt = strtolower(pathinfo($_FILES["fileToUpload"]["name"], PATHINFO_EXTENSION));
                    $newImagePath = "./images/inventory/".$imageName.".".$imageExt;

                    // Allowed image extensions
                    $suitableFormats = array("jpg", "jpeg", "png", "gif", "webp", "jfif",);
                    
                    // Allow certain file formats
                    if(in_array($imageExt, $suitableFormats)) {
                        // Moves the file to the given location
                        move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $newImagePath);

                        // Deletes the original file
                        $originalImage = $controllers->equipment()->get_equipment_by_id($id)['image'];
                        unlink($originalImage);
                    } else {
                        // Sets the new image path to the existing path
                        $newImagePath = $controllers->equipment()->get_equipment_by_id($id)['image'];
                    }
                } else {
                    // Sets the new image path as the existing path
                    $newImagePath = $controllers->equipment()->get_equipment_by_id($id)['image'];
                }
                
                $args = array(
                    'id'=>$id,
                    'name'=>$name,
                    'description'=>$description,
                    'image'=>$newImagePath,
                    'sell_price'=>$sellprice,
                    'buy_price'=>$buyprice,
                    'stock'=>$stock,
                    'categoryId'=>$categoryId,
                    'supplierId'=>$supplierId,
                );

                // Creates the equipment
                $controllers->equipment()->update_equipment($args);
                // Returns the user back to the inventory page
                header('Location: inventory.php');
                break;
                 
            case "members":
                // Gets the updated information submitted in the form
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

                // Retrieves all of the different roles in the 'roles' table
                $roles = $controllers->roles()->get_all_roles();
                
                // Iterates through each role in the database
                foreach ($roles as $role) {
                    $roleName = htmlspecialchars($role['name']);

                    $args = array(
                        'user_id' => $_POST['id'],
                        'role_id' => $role['id'],
                    );
                    
                    // Checks if the corresponding role's checkbox was ticked on the form
                    if (isset($_POST["role".$role['id']])) {
                        // Adds the user role if it is checked on the form
                        $controllers->userRoles()->give_member_role($args);
                    } else {
                        // Removes the user role if it is not checked on the form
                        $controllers->userRoles()->remove_member_role($args);
                    }
                }
                
                // Returns the user back to the users page
                header('Location: members.php');
                break;
            
            case "roles":
                // Gets the id of the role
                $id = $_POST['id'];
                $name = $_POST['name'];
                
                $args = array(
                    'id'=>$id,
                    'name'=>$name,
                );

                // Creates the role
                $controllers->roles()->update_role($args);

                // Returns the user back to the role page
                header('Location: roles.php');
                break;
            
            case "suppliers":
                // Gets the id of the supplier
                $id = $_POST['id'];
                $name = $_POST['name'];
                $email = $_POST['email'];
                $phoneNumber = $_POST['phoneNumber'];
                
                $args = array(
                    'id'=>$id,
                    'name'=>$name,
                    'email'=>$email,
                    'phoneNumber'=>$phoneNumber,
                );

                // Creates the supplier
                $controllers->suppliers()->update_supplier($args);

                // Returns the user back to the supplier page
                header('Location: suppliers.php');
                break;

            case "categories":
                // Gets the id of the category
                $id = $_POST['id'];
                $name = $_POST['name'];
                
                $args = array(
                    'id'=>$id,
                    'name'=>$name,
                );

                // Creates the category
                $controllers->categories()->update_category($args);

                // Returns the user back to the supplier page
                header('Location: categories.php');
                break;
        }
    }
?>