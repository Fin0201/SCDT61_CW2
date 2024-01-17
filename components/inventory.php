<?php
    $message = isset($_GET['message']) ? htmlspecialchars($_GET['message']) : '';
    // Include the functions file for necessary functions and classes
    require_once './inc/functions.php';

    // Retrieve all equipment data using the equipment controller
    $equipment = $controllers->equipment()->get_all_equipments();
    $categories = $controllers->categories()->get_all_categories();
    $suppliers = $controllers->suppliers()->get_all_suppliers();

    // Sets $admin to true if the user role is stored as "Admin" in the session
    $admin = false;
    if ($_SESSION) {
      if ($_SESSION['user']['role'] == "Admin") {
        $admin = true;
      }
    }
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
                <th>Buy Price</th>
                <th>Sell Price</th>
                <th>Stock</th>
                <th>Category</th>
                <th>Supplier</th>
                <!-- Checks if th user is an admin -->
                <?php if ($admin): ?>
                  <th>Manage</th>
                <?php endif; ?>
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
                <td><?= htmlspecialchars($equip['buy_price']) ?></td>
                <td><?= htmlspecialchars($equip['sell_price']) ?></td>
                <td><?= htmlspecialchars($equip['stock']) ?></td>
                <td><?php
                  // Displays the category
                  $category = $controllers->categories()->get_category_by_id($equip['categoryId']);
                  echo htmlspecialchars($category['name']);
                ?></td>
                <td><?php
                  // Displays the supplier
                  $supplier = $controllers->suppliers()->get_supplier_by_id($equip['supplierId']);
                  echo htmlspecialchars($supplier['name']);
                ?></td>
                
                <!-- Checks if the user is an admin -->
                <?php if ($admin) { ?>
                    <td style="max-width: 50px;">
                      <form action = "./inventory.php" method="post">
                        <input type="hidden" name="id" value="<?= $equip['id'] ?>">
                        <input type="hidden" name="action" value="edit">
                        <button class="btn btn-warning btn-lg w-40" type="submit" style="float: left; margin-right: 5px;">Edit</button>
                      </form>
                      <form action = "./delete.php" method="post">
                        <input type="hidden" name="id" value="<?= $equip['id'] ?>">
                        <input type="hidden" name="action" value="equipment">
                        <button class="btn btn-danger btn-lg w-40" type="submit" style="float: left; margin-right: 5px;">Delete</button>
                      </form>
                    </td>
                <?php } ?>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

<!-- Modal used to edit item -->
<?php if ($admin): ?>
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
          <div class = "form-group" style="width: 150px;">
              <label class="form-label">Item Image</label>
              <img src="<?= htmlspecialchars($currentItem['image']) ?>"
                              alt="Image of <?= htmlspecialchars($equip['description']) ?>" 
                              style="width: 100px; height: auto;"> 
              <input type="file" name="fileToUpload" if="fileToUpload" class="form-control-md" >
            </div>
            
            <div class = "form-group">
              <label class="form-label">Item Name</label>
              <input type="text" name="name" class="form-control" value='<?= $currentItem['name']; ?>' required>
            </div>
            <div class = "form-group">
              <label class="form-label">Item Description</label>
              <input type="text" name="description" class="form-control" value='<?= $currentItem['description'] ?>' required>
            </div>
            
            <div class = "form-group" style="width: 150px;">
              <label class="form-label">Item Buy Price</label>
              <input type="number" min="0.00" step="0.01" name="buy_price" class="form-control" value=<?= $currentItem['buy_price'] ?> required>
            </div>
            <div class = "form-group" style="width: 150px;">
              <label class="form-label">Item Sell Price</label>
              <input type="number" value=<?= $currentItem['sell_price'] ?> min="0.00" step="0.01" name="sell_price" class="form-control" required>
            </div>
            <div class = "form-group" style="width: 150px;">
              <label class="form-label">Item Stock</label>
              <input type="number" min=0 name="stock" class="form-control" value=<?= $currentItem['stock'] ?> required>
            </div>
            <div class="form-outline mb-4">
              <select required type="select" id="categoryId" name="categoryId" class="form-control form-control-lg" placeholder="Equipment category">
                <option value="" disabled>Select a category</option>
                <!-- Loops through each category and adds it as an option -->
                <?php foreach ($categories as $category):
                  $selected = ($currentItem['categoryId'] == $category['id']) ? 'selected' : ''; ?>
                  <option selected="<?= $selected ?>" value="<?= $category['id'] ?>"><?= $category['name'] ?></option>
                <?php endforeach; ?>
              </select>
              <small class="text-danger"><?= htmlspecialchars($categoryId['error'] ?? '') ?></small>
            </div>

            <div class="form-outline mb-4">
              <select required type="select" id="supplierId" name="supplierId" class="form-control form-control-lg" placeholder="Equipment supplier">
                <option value="" disabled selected>Select a supplier</option>
                <!-- Loops through each supplier and adds it as an option -->
                <?php foreach ($suppliers as $supplier):
                  $selected = ($currentItem['supplierId'] == $supplier['id']) ? 'selected' : ''; ?>
                  <option <?= $selected ?> value="<?= $supplier['id'] ?>"><?= $supplier['name'] ?></option>
                <?php endforeach; ?>
              </select>
              <small class="text-danger"><?= htmlspecialchars($categoryId['error'] ?? '') ?></small>
            </div>
            <div class="modal-footer">
            <input type = "hidden" name = "action" value="equipment">
            <input type = "hidden" name = "id" value="<?= $currentItem['id']?>">
            <button type="submit" class="btn btn-primary">Confirm</button>
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          </form>
        </div>
        </div>
      </div>
    </div>
  </div>
<?php endif; ?>