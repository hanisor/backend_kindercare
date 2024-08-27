<!DOCTYPE html>
<html lang="en">
<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>KinderCare</title>
  <!-- base:css -->
  <link rel="stylesheet" href="vendors/mdi/css/materialdesignicons.min.css">
  <link rel="stylesheet" href="vendors/base/vendor.bundle.base.css">
  <!-- endinject -->
  <!-- plugin css for this page -->
  <!-- End plugin css for this page -->
  <!-- inject:css -->
  <link rel="stylesheet" href="css/style.css">
  <!-- endinject -->
  <link rel="shortcut icon" href="images/favicon.png" />
  <!-- Bootstrap CSS (if not included in base CSS) -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>

<body>
<div class="container-scroller">
    <div class="container-fluid page-body-wrapper full-page-wrapper">
        <div class="main-panel">
            <div class="content-wrapper d-flex align-items-center auth px-0">
                <div class="row w-100 mx-0">
                    <div class="col-lg-6 mx-auto">
                        <div class="auth-form-light text-left py-5 px-4 px-sm-5 text-black">
                            <div class="brand-logo">
                                <img src="images/3.png" alt="logo">
                            </div>
                            <h4>New here?</h4>
                            <h6 class="font-weight-light">Signing up is easy. It only takes a few steps</h6>
                            <form action="{{route('register.post')}}" method="POST" class="ms-auto me-auto mt-auto" style="width: 500px" enctype="multipart/form-data" id="registerForm">
                              @csrf

                              <input type="hidden" name="status" value="ACTIVE">
                              <input type="hidden" name="role" value="CAREGIVER">
                              <div class="mb-3">
                                  <label class="form-label">Username</label>
                                  <input type="text" class="form-control" name="username" value="{{ old('username') }}">
                              </div>
                              <div class="mb-3">
                                  <label class="form-label">Email address</label>
                                  <input type="email" class="form-control" name="email" value="{{ old('email') }}">
                              </div>
                              <div class="mb-3">
                                  <label class="form-label">Password</label>
                                  <input type="password" class="form-control" name="password" id="password">
                                  <small id="passwordHelp" class="form-text text-muted">Password must be at least 7 characters long and contain both letters and numbers.</small>
                              </div>
                              <div class="mb-4">
                                <div class="form-check">
                                  <label class="form-check-label text-black">
                                    <input type="checkbox" class="form-check-input">
                                    I agree to all Terms & Conditions
                                  </label>
                                </div>
                              </div>
                              <div class="mt-3">
                                  <button type="submit" class="btn btn-primary">Submit</button>
                              </div>
                              <div class="text-center mt-4 font-weight-light text-black">
                                Already have an account? <a href="caregiver-login" class="text-primary">Login</a>
                              </div>
                            </form>
                          </div>
                        </div>
                      </div>
                    </div>
                </div>
            <!-- content-wrapper ends -->
        </div>
    <!-- page-body-wrapper ends -->
    </div>
  
  <!-- Modal for Empty Fields -->
  <div class="modal fade" id="emptyFieldsModal" tabindex="-1" role="dialog" aria-labelledby="emptyFieldsModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="emptyFieldsModalLabel">Incomplete Form</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          Please fill in all required fields before submitting the form.
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>

  <!-- Modal for Invalid Password -->
  <div class="modal fade" id="passwordModal" tabindex="-1" role="dialog" aria-labelledby="passwordModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="passwordModalLabel">Invalid Password</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          Your password must be at least 7 characters long and contain both letters and numbers.
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>

  <!-- Modal for Success Message -->
  <div class="modal fade" id="successModal" tabindex="-1" role="dialog" aria-labelledby="successModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="successModalLabel">Registration Successful</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          You have successfully registered. Redirecting to the login page...
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-primary" id="redirectButton">Go to Login</button>
        </div>
      </div>
    </div>
  </div>
  
  <!-- container-scroller -->
  <!-- base:js -->
  <script src="vendors/base/vendor.bundle.base.js"></script>
  <!-- endinject -->
  <!-- inject:js -->
  <script src="js/template.js"></script>
  <!-- endinject -->
  <!-- jQuery, Popper.js, and Bootstrap JS -->
  <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

  <script>
    document.getElementById('registerForm').addEventListener('submit', function(event) {
      event.preventDefault(); // Prevent form submission temporarily

      const usernameInput = document.querySelector('input[name="username"]');
      const emailInput = document.querySelector('input[name="email"]');
      const passwordInput = document.getElementById('password');

      if (!usernameInput.value.trim() || !emailInput.value.trim() || !passwordInput.value.trim()) {
        // Show modal alert if any field is empty
        $('#emptyFieldsModal').modal('show');
        return;
      }

      const password = passwordInput.value;
      const isValid = password.length >= 7 && /\d/.test(password) && /[a-zA-Z]/.test(password);

      if (!isValid) {
        $('#passwordModal').modal('show'); // Show modal for invalid password
        return;
      }

      // Show the success modal
      $('#successModal').modal('show');

      // Redirect to the login page when the user clicks the button or after 3 seconds
      document.getElementById('redirectButton').addEventListener('click', function() {
        document.getElementById('registerForm').submit(); // Submit form after showing success message
      });

      setTimeout(function() {
        document.getElementById('registerForm').submit(); // Automatically submit form after delay
      }, 3000); // 3-second delay before redirecting
    });
  </script>

</body>
</html>
