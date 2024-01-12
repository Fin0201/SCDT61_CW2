<?php
// Include the functions file for necessary functions and classes

// Retrieve all equipment data using the equipment controller
$equipment = $controllers->equipment()->get_all_equipments();


?>

<!-- HTML for displaying the equipment inventory -->
<div class="container mt-4">
    <button type = "button" class = "btn btn-primary" data-bs-toggle = "modal" data-bs-target = "#additemmodal">Add Equipment</button>
    <h2>Equipment Inventory</h2> 
    <table class="table table-striped"> 
            <tr>
                <th>Image</th> 
                <th>Name</th> 
                <th>Description</th>
                <th>Stock</th>
                <th>Buy Price</th>
                <th>Sell Price</th>
                <?php if($_SESSION){ //Checks if the user is logged in to remove any error messages from the inventory page
                      if($_SESSION['user']['role'] == 'admin'){?>
                      <th>Manage</th> <?php
                    }} ?>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($equipment as $equip): ?> <!-- Loop through each equipment item -->
                <tr>
                    <td>
                        <img src="<?= htmlspecialchars($equip['image']) ?>"
                             alt="Image of <?= htmlspecialchars($equip['description']) ?>" 
                             style="width: 100px; height: auto;"> 
                    </td>
                    <td><?= htmlspecialchars($equip['name']) ?></td> 
                    <td><?= htmlspecialchars($equip['description']) ?></td>
                    <td><?= htmlspecialchars($equip['stock']) ?></td>
                    <td><?= htmlspecialchars($equip['buy_price']) ?></td>
                    <td><?= htmlspecialchars($equip['sell_price']) ?></td>
                    <?php if($_SESSION){ //Checks if the user is logged in to remove any error messages from the inventory page
                      if($_SESSION['user']['role'] == 'admin'){?>
                        <td><form action = "./Inventory.php" method = 'post'>
                          <input type = 'hidden' name = 'id' value = '<?= $equip['id'] ?>'>
                          <input type = 'hidden' name = 'action' value = 'edit'>
                          <button type = 'submit' class = 'btn btn-warning' style = "float: left; margin-right: 15px;">Edit</button></form>
                        
                          <form action = "./delete.php" method = "post">
                            <input type = "hidden" name = "id" value = "<?= $equip['id'] ?>">
                            <input type = "hidden" name = "action" value = "equipment">
                            <button type = 'submit' class = 'btn btn-danger' style = "float: right;">Delete</button>
                          </form>
                        </td> <?php
                    }} ?>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>


<div class="modal" tabindex="-1" role="dialog" id = "additemmodal">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Add Item</h5>
        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action = "./create.php" method = "post" enctype = "multipart/form-data">
          <div class = "form-group">
            <label class="form-label">Item Name</label>
            <input type="text" name="name" class="form-control" required>
          </div>
          <div class = "form-group">
            <label class="form-label">Item Description</label>
            <input type="text" name="description" class="form-control" required>
          </div>
          <div class = "form-group" style="width: 150px;">
            <label class="form-label">Item Stock</label>
            <input type="number" value=0 min=0 name="stock" class="form-control" required>
          </div>
          <div class = "form-group" style="width: 150px;">
            <label class="form-label">Item Buy Price</label>
            <input type="number" value=0 min=0 step=0.01 name="buy_price" class="form-control" required>
          </div>
          <div class = "form-group" style="width: 150px;">
            <label class="form-label">Item Sell Price</label>
            <input type="number" value=0 min=0 step=0.01 name="sell_price" class="form-control" required>
          </div>
          <div class = "form-group" style="width: 150px;">
            <label class="form-label">Item Image</label>
            <input type="file" name="image" class="form-control-md" required>
          </div>
          <div class="modal-footer">
          <input type = "hidden" name = "action" value = "equipment">
          <button type="submit" class="btn btn-primary">Create</button>
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        </form>
      </div>
      </div>
    </div>
  </div>
</div>

<div class="modal" tabindex="-1" role="dialog" id = "edititemmodal">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Edit Item</h5>
        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action = "./edit.php" method = "post" enctype = "multipart/form-data">
          <div class = "form-group">
            <label class="form-label">Item Name</label>
            <input type="text" name="name" class="form-control" value = '<?= $currentItem['name']; ?>' required>
          </div>
          <div class = "form-group">
            <label class="form-label">Item Description</label>
            <input type="text" name="description" class="form-control" value = '<?= $currentItem['description'] ?>' required>
          </div>
          <div class = "form-group" style="width: 150px;">
            <label class="form-label">Item Stock</label>
            <input type="number" min=0 name="stock" class="form-control" value = <?= $currentItem['stock'] ?> required>
          </div>
          <div class = "form-group" style="width: 150px;">
            <label class="form-label">Item Buy Price</label>
            <input type="number" min=0 step=0.01 name="buy_price" class="form-control" value = <?= $currentItem['buy_price'] ?> required>
          </div>
          <div class = "form-group" style="width: 150px;">
            <label class="form-label">Item Sell Price</label>
            <input type="number" value=<?= $currentItem['sell_price'] ?> min=0 step=0.01 name="sell_price" class="form-control" required>
          </div>
          <div class = "form-group" style="width: 150px;">
            <label class="form-label">Item Image</label>
            <img src="<?= htmlspecialchars($currentItem['image']) ?>"
                             alt="Image of <?= htmlspecialchars($equip['description']) ?>" 
                             style="width: 100px; height: auto;"> 
            <input type="file" name="image" class="form-control-md" >
          </div>
          <div class="modal-footer">
          <input type = "hidden" name = "action" value = "equipment">
          <input type = "hidden" name = "id" value = "<?= $currentItem['id']?>">
          <button type="submit" class="btn btn-primary">Confirm</button>
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        </form>
      </div>
      </div>
    </div>
  </div>
</div>