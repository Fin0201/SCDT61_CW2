<?php
    $message = isset($_GET['message']) ? htmlspecialchars($_GET['message']) : '';
    // Include the functions file for necessary functions and classes
    require_once './inc/functions.php';

    // Retrieve all categories data using the categories controller
    $categories = $controllers->categories()->get_all_categories();

    // Sets $admin to true if the user role is stored as "Admin" in the session
    $admin = false;
    if ($_SESSION) {
      if ($_SESSION['user']['role'] == "Admin") {
        $admin = true;
      }
    }
?>

<!-- HTML for displaying the categories inventory -->
<div class="container mt-4">
<a type="button" class="btn btn-primary" href="./add-category.php">Add category</a>
<?php echo "<p>" . $message . "</p>"; ?>
    <h2>categories</h2> 
    <table class="table table-striped"> 
            <tr>
                <th>Name</th>
                <th>Created On</th>
                <th>Last Modified On</th>
                <?php if ($admin): ?>
                    <th>Manage</th>
                <?php endif; ?>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($categories as $category): ?> <!-- Loop through each category item -->
                <tr>
                    <td><?= htmlspecialchars($category['name']) ?></td> 
                    <td><?= htmlspecialchars($category['createdOn']) ?></td>
                    <td><?= htmlspecialchars($category['modifiedOn']) ?></td>

                    <!-- Checks if the user is an admin -->
                    <?php if ($admin) { ?>
                        <td style="max-width: 50px;">
                            <form action = "./categories.php" method="post">
                                <input type="hidden" name="id" value="<?= $category['id'] ?>">
                                <input type="hidden" name="action" value="edit">
                                <button class="btn btn-warning btn-lg w-40" type="submit" style="float: left; margin-right: 5px;">Edit</button>
                            </form>
                            <form action = "./delete.php" method="post">
                                <input type="hidden" name="id" value="<?= $category['id'] ?>">
                                <input type="hidden" name="action" value="categories">
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
  <div class="modal" tabindex="-1" category="dialog" id="edititemmodal">
    <div class="modal-dialog" category="document">
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
              <label class="form-label">category Name</label>
              <input type="text" name="name" class="form-control" value='<?= $currentItem['name']; ?>' required>
            </div>
            <div class="modal-footer">
            <input type="hidden" name="action" value="categories">
            <input type="hidden" name="id" value="<?= $currentItem['id']?>">
            <button type="submit" class="btn btn-primary">Confirm</button>
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          </form>
        </div>
        </div>
      </div>
    </div>
  </div>
<?php endif; ?>