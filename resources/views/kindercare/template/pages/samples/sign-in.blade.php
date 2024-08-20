<!DOCTYPE html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Sign in to KinderCare</title>
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
  <style>
    .error-message {
      color: red;
      font-size: 14px;
      margin-top: 5px;
    }

    .password-container {
      position: relative;
    }

    .toggle-password {
      position: absolute;
      top: 50%;
      right: 10px;
      transform: translateY(-50%);
      cursor: pointer;
    }

    .modal {
      display: none;
      position: fixed;
      z-index: 1;
      left: 0;
      top: 0;
      width: 100%;
      height: 100%;
      overflow: auto;
      background-color: rgb(0, 0, 0);
      background-color: rgba(0, 0, 0, 0.4);
    }

    .modal-content {
      background-color: #fefefe;
      margin: 15% auto;
      padding: 20px;
      border: 1px solid #888;
      width: 80%;
      max-width: 400px;
      text-align: center;
    }

    .close {
      color: #aaa;
      float: right;
      font-size: 28px;
      font-weight: bold;
    }

    .close:hover,
    .close:focus {
      color: black;
      text-decoration: none;
      cursor: pointer;
    }

    #popupMessage {
      color: red; /* Change this to your desired color */
      font-size: 14px;
    }

    #successMessage {
      color: green; /* Example for success messages */
      font-size: 14px;
    }
  </style>
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
                <h4>Hello! let's get started</h4>
                <h6 class="font-weight-light">Sign in to continue.</h6>
                <form action="{{route('login.post')}}" method="POST" class="ms-auto me-auto mt-auto" style="width: 500px" id="loginForm">
                  @csrf
                  <div class="form-group">
                    <input type="email" class="form-control form-control-lg" id="exampleInputEmail1" placeholder="Username">
                  </div>
                  <div class="form-group password-container">
                    <input type="password" class="form-control form-control-lg" id="exampleInputPassword1" placeholder="Password">
                    <i class="mdi mdi-eye toggle-password" id="togglePassword"></i>
                  </div>
                  <div class="mt-3">
                    <button type="submit" class="btn btn-primary">Sign in</button>
                  </div>
                  <div class="my-2 d-flex justify-content-between align-items-center">
                    <div class="form-check">
                      <label class="form-check-label text-black">
                        <input type="checkbox" class="form-check-input">
                        Keep me signed in
                      </label>
                    </div>
                    <a href="#" class="auth-link text-black">Forgot password?</a>
                  </div>
                  <div class="text-center mt-4 font-weight-light">
                    <span class="error-message" id="errorMessage"></span>
                    Don't have an account? <a href="caregiver-register" class="text-primary">Create</a>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Popup Modal -->
  <div id="popupModal" class="modal">
    <div class="modal-content">
      <span class="close">&times;</span>
      <p id="popupMessage"></p>
    </div>
  </div>

  <!-- Success Modal -->
  <div id="successModal" class="modal">
    <div class="modal-content">
      <span class="close">&times;</span>
      <p id="successMessage"></p>
    </div>
  </div>

  <!-- content-wrapper ends -->
  </div>
  <!-- page-body-wrapper ends -->
  </div>
  <!-- container-scroller -->
  <!-- base:js -->
  <script src="vendors/base/vendor.bundle.base.js"></script>
  <!-- endinject -->
  <!-- inject:js -->
  <script src="js/template.js"></script>
  <!-- endinject -->

  <script>
    document.addEventListener("DOMContentLoaded", function() {
      const form = document.getElementById('loginForm');
      form.addEventListener('submit', function(event) {
        event.preventDefault();

        const email = document.getElementById('exampleInputEmail1').value;
        const password = document.getElementById('exampleInputPassword1').value;

        fetchUser(email, password);
      });

      const togglePassword = document.getElementById('togglePassword');
      const passwordField = document.getElementById('exampleInputPassword1');

      togglePassword.addEventListener('click', function() {
        const type = passwordField.getAttribute('type') === 'password' ? 'text' : 'password';
        passwordField.setAttribute('type', type);
        this.classList.toggle('mdi-eye');
        this.classList.toggle('mdi-eye-off');
      });

      // Get the modal elements
      const popupModal = document.getElementById('popupModal');
      const successModal = document.getElementById('successModal');
      const popupMessage = document.getElementById('popupMessage');
      const successMessage = document.getElementById('successMessage');
      const closeButtons = document.querySelectorAll('.close');

      closeButtons.forEach(button => {
        button.addEventListener('click', function() {
          popupModal.style.display = "none";
          successModal.style.display = "none";
        });
      });

      window.addEventListener('click', function(event) {
        if (event.target === popupModal || event.target === successModal) {
          popupModal.style.display = "none";
          successModal.style.display = "none";
        }
      });

      function fetchUser(email, password) {
        const data = {
          email: email,
          password: password
        };

        fetch('/login', {
          method: 'POST',
          headers: {
            'Content-Type': 'application/json'
          },
          body: JSON.stringify(data)
        })
        .then(response => response.json())
        .then(data => {
          if (data.token) {
            successMessage.innerText = 'Login successful! Redirecting to homepage...';
            successModal.style.display = 'block';
            setTimeout(() => {
              sessionStorage.setItem('token', data.token);
              window.location.href = '/caregiver-homepage';
            }, 2000); 
          } else {
            popupMessage.innerText = 'Invalid credentials. Please try again.';
            popupModal.style.display = 'block';
          }
        })
        .catch(error => {
          console.error('Error during fetch:', error);
          popupMessage.innerText = 'Incorrect email or password. Please try again later.';
          popupModal.style.display = 'block';
        });
      }
    });
  </script>

</body>

</html>
