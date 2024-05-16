<!DOCTYPE html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Register Children</title>
  <!-- base:css -->
  <link rel="stylesheet" href="vendors/mdi/css/materialdesignicons.min.css">
  <link rel="stylesheet" href="vendors/base/vendor.bundle.base.css">
  <!-- endinject -->
  <!-- plugin css for this page -->
  <link rel="stylesheet" href="vendors/select2/select2.min.css">
  <link rel="stylesheet" href="vendors/select2-bootstrap-theme/select2-bootstrap.min.css">
  <!-- End plugin css for this page -->
  <!-- inject:css -->
  <link rel="stylesheet" href="css/style.css">
  <!-- endinject -->
  <link rel="shortcut icon" href="images/favicon.png" />
</head>

<body>
  <div class="container-scroller">
    <!-- partial:partials/_horizontal-navbar.html -->
        
        <div class="horizontal-menu">
      <nav class="navbar top-navbar col-lg-12 col-12 p-0">
        <div class="container-fluid">
          <div class="navbar-menu-wrapper d-flex align-items-center justify-content-between">
            <ul class="navbar-nav navbar-nav-left">
              <li class="nav-item nav-search d-none d-lg-block ms-3">
                <div class="input-group">
                    <div class="input-group-prepend">
                      <span class="input-group-text" id="search">
                        <i class="mdi mdi-magnify"></i>
                      </span>
                    </div>
                    <input type="text" class="form-control" placeholder="search" aria-label="search" aria-describedby="search">
                </div>
              </li>	
            </ul>
            <div class="text-center navbar-brand-wrapper d-flex align-items-center justify-content-center">
                <a class="navbar-brand brand-logo" href="/caregiver-homepage"><img src="images/logo.svg" alt="logo"/></a>
                <a class="navbar-brand brand-logo-mini" href="/caregiver-homepage"><img src="images/logo-mini.svg" alt="logo"/></a>
            </div>
            <ul class="navbar-nav navbar-nav-right">
                <li class="nav-item dropdown d-lg-flex d-none">
                  <button type="button" class="btn btn-inverse-primary btn-sm">Settings</button>
                </li>
                <li class="nav-item nav-profile dropdown">
                  <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown" id="profileDropdown">
                    <span class="nav-profile-name">Johnson</span>
                    <span class="online-status"></span>
                    <img src="images/faces/face28.png" alt="profile"/>
                  </a>
                  <div class="dropdown-menu dropdown-menu-right navbar-dropdown" aria-labelledby="profileDropdown">
                      <a class="dropdown-item">
                        <i class="mdi mdi-settings text-primary"></i>
                        Settings
                      </a>
                      <a class="dropdown-item">
                        <i class="mdi mdi-logout text-primary"></i>
                        Logout
                      </a>
                  </div>
                </li>
            </ul>
            <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button" data-toggle="horizontal-menu-toggle">
              <span class="mdi mdi-menu"></span>
            </button>
          </div>
        </div>
      </nav>
      <nav class="bottom-navbar">
        <div class="container">
            <ul class="nav page-navigation">
              <li class="nav-item">
                <a class="nav-link" href="/caregiver-homepage">
                  <i class="mdi mdi-file-document-box menu-icon"></i>
                  <span class="menu-title">Dashboard</span>
                </a>
              </li>
              <li class="nav-item">
                  <a href="#" class="nav-link">
                    <i class="mdi mdi-cube-outline menu-icon"></i>
                    <span class="menu-title">Registration</span>
                    <i class="menu-arrow"></i>
                  </a>
                  <div class="submenu">
                      <ul>
                          <li class="nav-item"><a class="nav-link" href="/add-parent">Parents</a></li>
                          <li class="nav-item"><a class="nav-link" href="/add-children">Children</a></li>
                      </ul>
                  </div>
              </li>
              <li class="nav-item">
                  <a href="/add-session" class="nav-link">
                    <i class="mdi mdi-chart-areaspline menu-icon"></i>
                    <span class="menu-title">Add Session</span>
                    <i class="menu-arrow"></i>
                  </a>
              </li>
              <li class="nav-item">
                  <a href="pages/charts/chartjs.html" class="nav-link">
                    <i class="mdi mdi-finance menu-icon"></i>
                    <span class="menu-title">Charts</span>
                    <i class="menu-arrow"></i>
                  </a>
              </li>
              <li class="nav-item">
              <a href="../../pages/tables/basic-table.html" class="nav-link">
                    <i class="mdi mdi-grid menu-icon"></i>
                    <span class="menu-title">Tables</span>
                    <i class="menu-arrow"></i>
                </a>
                <div class="submenu">
                    <ul>
                    <li class="nav-item"><a class="nav-link" href="/parent-table">Parents Record</a></li>
                    <li class="nav-item"><a class="nav-link" href="/children-table">Children Record</a></li>
                    </ul>
                </div>
                </li>
                <li class="nav-item">
                <a href="../../pages/icons/mdi.html" class="nav-link">
                    <i class="mdi mdi-emoticon menu-icon"></i>
                    <span class="menu-title">Icons</span>
                    <i class="menu-arrow"></i>
                  </a>
              </li>
              <li class="nav-item">
                  <a href="#" class="nav-link">
                    <i class="mdi mdi-codepen menu-icon"></i>
                    <span class="menu-title">Sample Pages</span>
                    <i class="menu-arrow"></i>
                  </a>
                  <div class="submenu">
                      <ul class="submenu-item">
                          <li class="nav-item"><a class="nav-link" href="/caregiver-login">Login</a></li>
                          <li class="nav-item"><a class="nav-link" href="/caregiver-register">Register</a></li>
                      </ul>
                  </div>
              </li>
              <li class="nav-item">
                  <a href="../../docs/documentation.html" class="nav-link">
                    <i class="mdi mdi-file-document-box-outline menu-icon"></i>
                    <span class="menu-title">Documentation</span></a>
              </li>
            </ul>
        </div>
      </nav >
    </div>
        
        <!-- partial -->
        <div class="container-fluid page-body-wrapper">
        <div class="main-panel">
            <div class="content-wrapper">
                <div class="container">
                    <div class="col justify-content-center">
                        <div class="col-md-6 mb-4">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="card-title">Add Session</h4>
                                    <p class="card-description">Select the academic year for which you want to add a session. Only the academic years available for registration will be listed in the dropdown.</p>
                                    <form id="add-session-form">
                                        <div class="form-group row align-items-center">
                                            <label class="col-sm-4 col-form-label">Session</label>
                                            <div class="col-sm-8">
                                                <select id="year-dropdown" class="form-control">
                                                    <!-- Options will be dynamically generated here -->
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <div class="col-sm-12">
                                                <button type="submit" class="btn btn-primary" onclick="addSession(document.getElementById('year-dropdown').value)">Add Session</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6 grid-margin grid-margin-md-0 stretch-card">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="card-title">Group</h4>
                                    <p class="card-description">Please select the available time slots for the session. You can choose from predefined time ranges such as 7am - 12pm, 12pm - 6pm, or 7am - 6pm. After selecting the time slots, assign caregivers who will be responsible for each session.</p>
                                    <div class="form-group row">
                                        <label class="col-sm-4 col-form-label">Year</label>
                                        <div class="col-sm-8">
                                            <div id="the-basics">
                                                <input class="typeahead form-control" type="text" placeholder="States of USA">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-sm-4 col-form-label">Time Slot</label>
                                        <div class="col-sm-8">
                                          <select class="js-exaple-basic-single w-100">
                                            <option value="AM">08:00 AM - 03:00 PM</option>
                                            <option value="PM">02:00 PM - 06:00 PM</option>
                                            <option value="FULL">08:00 PM - 06:00 PM</option>
                                          </select>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-sm-4 col-form-label">Assigned Caregiver</label>
                                        <div class="col-sm-8">
                                            <select id="caregiver-select" class="js-example-basic-multiple w-100" multiple="multiple">
                                                <!-- Options will be dynamically generated here -->
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>

        <!-- content-wrapper ends -->
        <!-- partial:../../partials/_footer.html -->
        <footer class="footer">
            <!-- Footer content -->
        </footer>
        <!-- partial -->
    </div>
    <!-- main-panel ends -->
    </div>
    <!-- page-body-wrapper ends -->
    </div>
    <!-- container-scroller -->
    <!-- base:js -->
    <script src="vendors/base/vendor.bundle.base.js"></script>
    <!-- endinject -->
    <!-- Plugin js for this page-->
    <!-- End plugin js for this page-->
    <!-- inject:js -->
    <script src="js/template.js"></script>
    <!-- endinject -->
    <!-- plugin js for this page -->
    <script src="vendors/typeahead.js/typeahead.bundle.min.js"></script>
    <script src="vendors/select2/select2.min.js"></script>
    <!-- End plugin js for this page -->
    <!-- Custom js for this page-->
    <script src="js/file-upload.js"></script>
    <script src="js/typeahead.js"></script>
    <script src="js/select2.js"></script>
    <!-- End custom js for this page-->

    <script>
      $(document).ready(function() {
            // Initialize Select2 on the select element
            $('.js-example-basic-multiple').select2();
            const token = sessionStorage.getItem('token');


            // Fetch active caregivers and populate the select element
            $.ajax({
                url: 'http://127.0.0.1:8000/api/caregiver-data', // Update with your actual endpoint
                method: 'GET',
                dataType: 'json',
                headers: {
                    'Authorization': 'Bearer ' + token // Include the token in the request headers
                },
                success: function(data) {
                    let caregiverSelect = $('#caregiver-select');
                    caregiverSelect.empty(); // Clear any existing options
                    data.forEach(function(caregiver) {
                        caregiverSelect.append(new Option(caregiver.name, caregiver.id));
                    });
                },
                error: function(error) {
                    console.error('Error fetching caregivers:', error);
                }
            });
        });
      </script>

    <script>
    // JavaScript code to dynamically generate options for the dropdown
    var currentYear = new Date().getFullYear();
    var select = document.getElementById('year-dropdown');

    // Add the current year as the first option
    var currentYearOption = document.createElement('option');
    currentYearOption.text = currentYear;
    select.add(currentYearOption);

    // Add the other years in descending order
    for (var i = currentYear - 1; i >= currentYear - 3; i--) {
        var option = document.createElement('option');
        option.text = i;
        select.add(option);
    }

    function addSession(year) {
        // Prepare the data to be sent in the request body
        var data = {
            year: year
        };

        // Retrieve the token from sessionStorage
        var token = sessionStorage.getItem('token');

        // Send an AJAX request to the controller
        fetch('http://127.0.0.1:8000/api/add-session', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'Authorization': 'Bearer ' + token
                },
                body: JSON.stringify(data) // Send the data object as JSON in the request body
            })
            .then(response => response.json())
            .then(data => {
                console.log(data); // Log the response from the controller
                // Handle the response as needed (e.g., display a success message)
            })
            .catch(error => {
                console.error('Error:', error); // Log any errors
                // Handle errors as needed (e.g., display an error message)
            });
    }
</script>


</body>

</html>