<?php
    $message = isset($_GET['message']) ? htmlspecialchars($_GET['message']) : '';
    // Include the functions file for necessary functions and classes
    require_once './inc/functions.php';

    // Retrieve all suppliers data using the suppliers controller
    $suppliers = $controllers->suppliers()->get_all_suppliers();

    $admin = false;
    if ($_SESSION) {
      if ($_SESSION['user']['role'] == "Admin") {
        $admin = true;
      }
    }
?>

<!-- HTML for displaying the suppliers inventory -->
<div class="container mt-4">
<a type="button" class="btn btn-primary" href="./add-supplier.php">Add supplier</a>
<?php echo "<p>" . $message . "</p>"; ?>
    <h2>suppliers</h2> 
    <table class="table table-striped"> 
            <tr>
                <th>Name</th>
                <th>Email</th> 
                <th>Phone Number</th> 
                <th>Created On</th>
                <th>Last Modified On</th>
                <?php if ($admin): ?>
                    <th>Manage</th>
                <?php endif; ?>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($suppliers as $supplier): ?> <!-- Loop through each suppliers item -->
                <tr>
                    <td><?= htmlspecialchars($supplier['name']) ?></td>
                    <td><?= htmlspecialchars($supplier['email']) ?></td>
                    <td><?= htmlspecialchars($supplier['phoneNumber']) ?></td>
                    <td><?= htmlspecialchars($supplier['createdOn']) ?></td>
                    <td><?= htmlspecialchars($supplier['modifiedOn']) ?></td>
                    <?php if ($admin) { ?>
                        <td style="max-width: 50px;">
                            <form action = "./suppliers.php" method="post">
                                <input type="hidden" name="id" value="<?= $supplier['id'] ?>">
                                <input type="hidden" name="action" value="edit">
                                <button class="btn btn-warning btn-lg w-40" type="submit" style="float: left; margin-right: 5px;">Edit</button>
                            </form>
                            <form action = "./delete.php" method="post">
                                <input type="hidden" name="id" value="<?= $supplier['id'] ?>">
                                <input type="hidden" name="action" value="suppliers">
                                <button class="btn btn-danger btn-lg w-40" type="submit" style="float: left; margin-right: 5px;">Delete</button>
                            </form>
                        </td>
                    <?php } ?>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

<div class="modal" tabindex="-1" supplier="dialog" id="edititemmodal">
  <div class="modal-dialog" supplier="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Edit Item</h5>
        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="./edit.php" method="post">
          <div class="form-group">
            <label class="form-label">Supplier Name</label>
            <input type="text" name="name" class="form-control" value='<?= $currentItem['name']; ?>' required>
          </div>
          <div class="form-group">
            <label class="form-label">Supplier Email</label>
            <input type="email" name="email" class="form-control" value='<?= $currentItem['email']; ?>' required>
          </div>
          <div class="form-group">
            <label class="form-label">Supplier Phone Number</label>
            <input type="tel" name="phoneNumber" class="form-control" value='<?= $currentItem['phoneNumber']; ?>' required>
          </div>
          <div class="modal-footer">
          <input type="hidden" name="action" value="suppliers">
          <input type="hidden" name="id" value="<?= $currentItem['id']?>">
          <button type="submit" class="btn btn-primary">Confirm</button>
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        </form>
      </div>
      </div>
    </div>
  </div>
</div>