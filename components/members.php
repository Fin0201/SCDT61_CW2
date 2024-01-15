<?php
  $message = isset($_GET['message']) ? htmlspecialchars($_GET['message']) : '';
  // Include the functions file for necessary functions and classes
  require_once './inc/functions.php';

  // Retrieve all member and role data using their controllers
  $members = $controllers->members()->get_all_members();
  $roles = $controllers->roles()->get_all_roles();

  $admin = false;
  if ($_SESSION) {
    if ($_SESSION['user']['role'] == "Admin") {
      $admin = true;
    }
  }
?>

<!-- HTML for displaying the members -->
<div class="container mt-4">
<a type="button" class="btn btn-primary" href="./register.php">Register Member</a>
<?php echo "<p>" . $message . "</p>"; ?>
    <h2>Members</h2> 
    <table class="table table-striped"> 
            <tr>
                <th>First Name</th>
                <th>last Name</th>
                <th>Email</th>
                <th>Created On</th>
                <th>Last Modified On</th>
                <th>Roles</th>
                <?php if ($admin): ?>
                  <th>Manage</th>
                <?php endif; ?>
            </tr>
        </thead>
        <tbody>
            <!-- Loop through each member item -->
            <?php foreach ($members as $member): ?>
                <tr>
                    <td><?= htmlspecialchars($member['firstname']) ?></td>
                    <td><?= htmlspecialchars($member['lastname']) ?></td>
                    <td><?= htmlspecialchars($member['email']) ?></td>
                    <td><?= htmlspecialchars($member['createdOn']) ?></td>
                    <td><?= htmlspecialchars($member['modifiedOn']) ?></td>
                    <td><?php
                    $userRoles = (array) null; 
                    foreach ($roles as $role){
                      $args = array(
                        'user_id' => $member['ID'],
                        'role_id' => $role['id']
                      );

                      // Checks if the selected user has the role
                      $hasRole = $controllers->userRoles()->check_user_has_role($args);
                      if ($hasRole) {
                        array_push($userRoles, $role['name']);
                      }
                    }
                    echo implode(", ", $userRoles); ?></td>
                    
                    <?php if ($admin) {
                        if($_SESSION['user']['role'] == "Admin") { ?>
                        <td style="max-width: 50px;">
                            <form action = "./members.php" method="post">
                                <input type="hidden" name="id" value="<?= $member['ID'] ?>">
                                <input type="hidden" name="action" value="edit">
                                <button class="btn btn-warning btn-lg w-40" type="submit" style="float: left; margin-right: 5px;">Edit</button>
                            </form>
                            <form action = "./delete.php" method="post">
                                <input type="hidden" name="id" value="<?= $member['ID'] ?>">
                                <input type="hidden" name="action" value="members">
                                <button class="btn btn-danger btn-lg w-40" type="submit" style="float: left; margin-right: 5px;">Delete</button>
                            </form>
                        </td>
                    <?php }
                    }
                    endforeach; ?>
        </tbody>
    </table>
</div>

<div class="modal" tabindex="-1" role="dialog" id = "edititemmodal">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Edit Member</h5>
        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="./edit.php" method="post">
          <div class ="form-group">
            <label class="form-label">First Name</label>
            <input type="text" name="firstname" class="form-control" value='<?= $currentItem['firstname']; ?>' required>
          </div>
          <div class="form-group">
            <label class="form-label">Last Name</label>
            <input type="text" name="lastname" class="form-control" value='<?= $currentItem['lastname'] ?>' required>
          </div>
          <div class="form-group">
            <label class="form-label">Email</label>
            <input type="email" name="email" class="form-control" value='<?= $currentItem['email'] ?>' required>
          </div>
          <!-- Loop through each role in the roles table -->
          <?php
          $i = 0;
          foreach ($roles as $role):
            $args = array(
              'user_id' => $currentItem['ID'],
              'role_id' => $role['id']
            );

            // Checks if the selected user has the role
            $hasRole = $controllers->userRoles()->check_user_has_role($args);

            // If the user has the role, this variable will tick the checkbox, otherwise it will leave it unchecked
            $checkedAttribute = $hasRole ? 'checked' : '';
          ?>
          <div class="form-group">
            <label class="form-label"><?= htmlspecialchars($role['name']) ?></label>
            <input type="checkbox" name="role<?= $role['id'] ?>" class="form-control" value="<?= $role['id'] ?>" <?= $checkedAttribute ?>>
          </div>
        <?php
          $i++;
          endforeach;
        ?>
            <div class="modal-footer">
            <input type="hidden" name="action" value="members">
            <input type="hidden" name="id" value="<?= $currentItem['ID'] ?>">
            <button type="submit" class="btn btn-primary">Confirm</button>
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>