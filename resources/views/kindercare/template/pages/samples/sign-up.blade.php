<!DOCTYPE html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Kapella Bootstrap Admin Dashboard Template</title>
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
                <form action="{{route('register.post')}}" method="POST" class="ms-auto me-auto mt-auto" style="width: 500px" enctype="multipart/form-data">
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
                      <input type="password" class="form-control" name="password">
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
                  </div>
                      <button type="submit" class="btn btn-primary">Submit</button>
                  </div>
                  <div class="text-center mt-4 font-weight-light text-black">
                    <!-- href="caregiver-login" (caregiver-login is the url) -->
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
  <!-- container-scroller -->
  <!-- base:js -->
  <script src="vendors/base/vendor.bundle.base.js"></script>
  <!-- endinject -->
  <!-- inject:js -->
  <script src="js/template.js"></script>
  <!-- endinject -->
</body>

</html>
