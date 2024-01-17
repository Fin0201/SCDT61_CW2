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
        $email = InputProcessor::processEmail($_POST['email']);
        $phoneNumber =  InputProcessor::processPhoneNumber($_POST['phoneNumber']);
        
        // Validate all inputs
        $valid = $name['valid'] && $email['valid'] && $phoneNumber['valid'];

        // Set an error message if any input is invalid
        $message = !$valid ? "Please fix the above errors:" : '';

        // If all inputs are valid, proceed with registration
        if ($valid)
        {
            // Prepare the data for registration
            $args = ['name' => $name['value'],
                     'email' => $email['value'],
                     'phoneNumber' => $phoneNumber['value']];
        
            // Add the supplier to the database
            $supplier = $controllers->suppliers()->add_supplier($args);
            if ($supplier) {
                redirect("suppliers", ["message" => "supplier successfully added!"]);
            } else {
                echo "Sorry, there was an error adding the supplier.";
            }
        }
    }
?>


<!-- HTML form for adding suppliers -->
<form method="post" action=" <?= htmlspecialchars($_SERVER['PHP_SELF']) ?>" enctype="multipart/form-data">
  <section class="vh-100">
    <div class="container py-5 h-75">
      <div class="row d-flex justify-content-center align-items-center h-100">
        <div class="col-12 col-md-8 col-lg-6 col-xl-5">
          <div class="card shadow-2-strong" style="border-radius: 1rem;">
            <div class="card-body p-5 text-center">

              <h3 class="mb-2">Add supplier</h3>

              <div class="form-outline mb-4">
                <input required type="text" id="name" name="name" class="form-control form-control-lg" placeholder="Supplier name" value="<?= htmlspecialchars($name['value'] ?? '') ?>"/>
                <small class="text-danger"><?= htmlspecialchars($name['error'] ?? '') ?></small>
              </div>

              <div class="form-outline mb-4">
                <input required type="email" id="email" name="email" class="form-control form-control-lg" placeholder="Supplier email" value="<?= htmlspecialchars($email['value'] ?? '') ?>"/>
                <small class="text-danger"><?= htmlspecialchars($email['error'] ?? '') ?></small>
              </div>

              <div class="form-outline mb-4">
                <input required type="tel" id="phoneNumber" name="phoneNumber" class="form-control form-control-lg" placeholder="Supplier phone number" value="<?= htmlspecialchars($phoneNumber['value'] ?? '') ?>"/>
                <small class="text-danger"><?= htmlspecialchars($phoneNumber['error'] ?? '') ?></small>
              </div>

              <button class="btn btn-primary btn-lg w-100 mb-4" type="submit">Add supplier</button>

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