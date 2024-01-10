<?php
$message = isset($_GET['error']) ? htmlspecialchars($_GET['error']) : '';
// Include the functions file for necessary functions and classes
require_once './inc/functions.php';

// Retrieve all equipment data using the equipment controller
$equipment = $controllers->equipment()->get_all_equipments();
?>


<a class="btn btn-secondary btn-lg w-100" href="./login.php" >Add Inventory</a>

<!-- HTML for displaying the equipment inventory -->
<div class="container mt-4">
<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#examplemodal">Launch demo modal</button>
    <h2>Equipment Inventory</h2> 
    <table class="table table-striped"> 
            <tr>
                <th>Image</th> 
                <th>Name</th> 
                <th>Descriptionnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnn</th> 
                <!-- <th>manage<th> Edit and delete if admin Use modals to map the button to the id or something idk  -->
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
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>


<div class="modal" tabindex="-1" role="dialog" id="examplemodal">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Add Equipment</h5>
        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <form method="post" action="../inc/image-upload.php">
        <section class="vh-100">
          <div class="container py-5 h-75">
            <div class="row d-flex justify-content-center align-items-center h-100">
              <div class="col-12 col-md-8 col-lg-6 col-xl-5">
                <div class="card shadow-2-strong" style="border-radius: 1rem;">
                  <div class="card-body p-5 text-center">

                    <h3 class="mb-2">Register</h3>
                    <p>test</p>
                    <div class="form-outline mb-4">
                      <input required type="file" name="fileToUpload" id="fileToUpload">
                    </div>

                    <div class="form-outline mb-4">
                      <input required type="text" id="name" name="name" class="form-control form-control-lg" placeholder="Equipment name" value="<?= htmlspecialchars($name['value'] ?? '') ?>"/>
                      <small class="text-danger"><?= htmlspecialchars($name['error'] ?? '') ?></small>
                    </div>

                    <div class="form-outline mb-4">
                      <input required type="text" id="description" name="description" class="form-control form-control-lg" placeholder="Equipment description" value="<?= htmlspecialchars($description['value'] ?? '') ?>"/>
                      <small class="text-danger"><?= htmlspecialchars($description['error'] ?? '') ?></small>
                    </div>

                    <button class="btn btn-primary btn-lg w-100 mb-4" type="submit">Add Equipment</button>

                    <?php if ($message): ?>
                      <div class="alert alert-danger mt-4">
                        <?= $message ?? '' ?>
                      </div>
                    <?php endif ?>

                  </div>
                </div>
              </div>
            </div>
          </div>
        </section>
      </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary">Save changes</button>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>