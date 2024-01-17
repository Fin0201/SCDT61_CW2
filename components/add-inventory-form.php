<?php
  // Include the functions file for utility functions
  require_once './inc/functions.php';

  // Initialize a variable to store any error message from the query string
  $message = isset($_GET['error']) ? htmlspecialchars($_GET['error']) : '';
  $categories = $controllers->categories()->get_all_categories();
  $suppliers = $controllers->suppliers()->get_all_suppliers();

  // Check if the form is submitted via POST
  if ($_SERVER['REQUEST_METHOD'] == 'POST')
  {
    echo "<br>".var_dump($_POST)."<br>";
    // Process the submitted form data
    $imageName = guidv4();
    $imageExt = strtolower(pathinfo($_FILES["fileToUpload"]["name"], PATHINFO_EXTENSION));
    $image = "./images/inventory/" . $imageName . "." . $imageExt;
    $name = InputProcessor::processString($_POST['name']);
    $description = InputProcessor::processString($_POST['description']);
    
    // Validate all inputs
    $valid = $name['valid'] && $description['valid'];

    // Set an error message if any input is invalid
    $message = !$valid ? "Please fix the above errors:" : '';

    // If all inputs are valid, proceed with registration
    if ($valid)
    {
      // Prepare the data for registration
      $args = ['image' => $image,
              'name' => $name['value'],
              'description' => $description['value'],
              'buy_price' => $_POST['buy_price'],
              'sell_price' => $_POST['sell_price'],
              'stock' => $_POST['stock'],
              'categoryId' => $_POST['categoryId'],
              'supplierId' => $_POST['supplierId']];


      // Allowed image formats
      $suitableFormats = array("jpg", "jpeg", "png", "gif", "webp", "jfif",);

      // Check if the image is a suitable format
      if (!in_array($imageExt, $suitableFormats)) {
        echo "Sorry, Invalid file format.";
      // if everything is ok, try to upload file
      } else {
        // Uploads the file
        $imageSuccess = move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $image);

        //Checks if image upload was successful
        if ($imageSuccess) {
          // Add the equipment to the database
          $equipment = $controllers->equipment()->create_equipment($args);
          redirect("inventory", ["message" => "Equipment successfully added!"]);
        } else {
          echo "Sorry, there was an error uploading the file.";
        }
      }
    }
  }
?>


<!-- HTML form for registration -->
<form method="post" action=" <?= htmlspecialchars($_SERVER['PHP_SELF']) ?>" enctype="multipart/form-data">
  <section class="vh-100">
    <div class="container py-5 h-75">
      <div class="row d-flex justify-content-center align-items-center h-100">
        <div class="col-12 col-md-8 col-lg-6 col-xl-5">
          <div class="card shadow-2-strong" style="border-radius: 1rem;">
            <div class="card-body p-5 text-center">

              <h3 class="mb-2">Add Equipment</h3>
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

              <div class="form-outline mb-4">
                <input required type="number" min="0.00" step="0.01" id="sell_price" name="sell_price" class="form-control form-control-lg" placeholder="Equipment sell price" value="<?= htmlspecialchars($sell_price['value'] ?? '') ?>"/>
                <small class="text-danger"><?= htmlspecialchars($sell_price['error'] ?? '') ?></small>
              </div>

              <div class="form-outline mb-4">
                <input required type="number" min="0.00" step="0.01" id="buy_price" name="buy_price" class="form-control form-control-lg" placeholder="Equipment buy price" value="<?= htmlspecialchars($buy_price['value'] ?? '') ?>"/>
                <small class="text-danger"><?= htmlspecialchars($buy_price['error'] ?? '') ?></small>
              </div>

              <div class="form-outline mb-4">
                <input required type="number" id="stock" name="stock" class="form-control form-control-lg" placeholder="Equipment stock" value="<?= htmlspecialchars($stock['value'] ?? '') ?>"/>
                <small class="text-danger"><?= htmlspecialchars($stock['error'] ?? '') ?></small>
              </div>

              <div class="form-outline mb-4">
                <select required type="select" id="categoryId" name="categoryId" class="form-control form-control-lg" placeholder="Equipment category">
                  <option value="" disabled selected>Select a category</option>
                  <!-- Loops through each category and adds it as an option -->
                  <?php foreach ($categories as $category): ?>
                    <option value="<?= $category['id'] ?>"><?= $category['name'] ?></option>
                  <?php endforeach; ?>
                </select>
                <small class="text-danger"><?= htmlspecialchars($categoryId['error'] ?? '') ?></small>
              </div>

              <div class="form-outline mb-4">
                <select required type="select" id="supplierId" name="supplierId" class="form-control form-control-lg" placeholder="Equipment supplier">
                  <option value="" disabled selected>Select a supplier</option>
                  <!-- Loops through each supplier and adds it as an option -->
                  <?php foreach ($suppliers as $supplier): ?>
                    <option value="<?= $supplier['id'] ?>"><?= $supplier['name'] ?></option>
                  <?php endforeach; ?>
                </select>
                <small class="text-danger"><?= htmlspecialchars($categoryId['error'] ?? '') ?></small>
              </div>

              <button class="btn btn-primary btn-lg w-100 mb-4" type="submit">Add Equipment</button>
              
              <!-- Displays a message if $message is not empty -->
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