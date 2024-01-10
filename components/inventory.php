<?php
$message = isset($_GET['message']) ? htmlspecialchars($_GET['message']) : '';
// Include the functions file for necessary functions and classes
require_once './inc/functions.php';

// Retrieve all equipment data using the equipment controller
$equipment = $controllers->equipment()->get_all_equipments();
?>


<!-- HTML for displaying the equipment inventory -->
<div class="container mt-4">
<a type="button" class="btn btn-primary" href="./add-inventory.php">Add Inventory</a>
<?php echo "<p>" . $message . "</p>"; ?>
    <h2>Equipment Inventory</h2> 
    <table class="table table-striped"> 
            <tr>
                <th>Image</th> 
                <th>Name</th> 
                <th>Description</th>
                <th>manage</th> <!-- TODO Edit and delete if admin Use modals to map the button to the id or something idk  -->
            </tr>
        </thead>
        <tbody>
            <?php foreach ($equipment as $equip): ?> <!-- Loop through each equipment item -->
                <tr>
                    <td>
                        <!-- Display equipment image with escaping for security -->
                        <img src="<?= htmlspecialchars($equip['image']) ?>" 
                             alt="Image of <?= htmlspecialchars($equip['description']) ?>" 
                             style="width: 100px; height: auto;"> 
                    </td>
                    <td><?= htmlspecialchars($equip['name']) ?></td> 
                    <td><?= htmlspecialchars($equip['description']) ?></td> 



                    <!-- <td><?= htmlspecialchars($equip['buy_price']) ?></td>  
                    <td><?= htmlspecialchars($equip['stock']) ?></td> 
                    <td><?= htmlspecialchars($equip['sell_price']) ?></td>  -->



                    <?php if ($_SESSION) {
                        
                        if($_SESSION['user']['role'] == 2) { ?>
                        <td style="max-width: 50px;">
                            <form action = "./delete.php" method="post">
                                <input type="hidden" name="id" value="<?= $equip['id'] ?>">
                                <input type="hidden" name="action" value="equipment">
                                <button class="btn btn-danger btn-lg w-40" type="submit" style="float: left; margin-right: 5px;">Delete</button>
                            </form>
                            <form action = "./delete.php" method="post">
                                <input type="hidden" name="id" value="<?= $equip['id'] ?>">
                                <button class="btn btn-warning btn-lg w-40" type="submit" style="float: right;">Edit</button>
                            </form>
                        </td>
                    <?php }
                    } ?>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>