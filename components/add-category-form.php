<?php
    // Include the functions file for utility functions
    require_once './inc/functions.php';

    // Initialize a variable to store any error message from the query string
    $message = isset($_GET['error']) ? htmlspecialchars($_GET['error']) : '';

    // Check if the form is submitted via POST
    if ($_SERVER['REQUEST_METHOD'] == 'POST')
    {
        // Process the submitted form data
        $name = InputProcessor::processString($_POST['name']);
        
        // Validate all inputs
        $valid = $name['valid'];

        // Set an error message if any input is invalid
        $message = !$valid ? "Please fix the above errors:" : '';

        // If all inputs are valid, proceed with registration
        if ($valid)
        {
            // Prepare the data for registration
            $args = ['name' => $name['value']];
        
            // Add the category to the database
            $category = $controllers->categories()->add_category($args);
            if ($category) {
                redirect("categories", ["message" => "category successfully added!"]);
            } else {
                echo "Sorry, there was an error adding the category.";
            }
        }
    }
?>


<!-- HTML form for adding categories -->
<form method="post" action=" <?= htmlspecialchars($_SERVER['PHP_SELF']) ?>" enctype="multipart/form-data">
  <section class="vh-100">
    <div class="container py-5 h-75">
      <div class="row d-flex justify-content-center align-items-center h-100">
        <div class="col-12 col-md-8 col-lg-6 col-xl-5">
          <div class="card shadow-2-strong" style="border-radius: 1rem;">
            <div class="card-body p-5 text-center">

              <h3 class="mb-2">Add category</h3>

              <div class="form-outline mb-4">
                <input required type="text" id="name" name="name" class="form-control form-control-lg" placeholder="Category name" value="<?= htmlspecialchars($name['value'] ?? '') ?>"/>
                <small class="text-danger"><?= htmlspecialchars($name['error'] ?? '') ?></small>
              </div>

              <button class="btn btn-primary btn-lg w-100 mb-4" type="submit">Add category</button>

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