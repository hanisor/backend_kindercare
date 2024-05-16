    <!DOCTYPE html>
    <html lang="en">

    <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Parent Record</title>
    <!-- base:css -->
    <link rel="stylesheet" href="vendors/mdi/css/materialdesignicons.min.css">
    <link rel="stylesheet" href="vendors/base/vendor.bundle.base.css">
    <!-- endinject -->
    <!-- plugin css for this page -->
    <link rel="stylesheet" href="public/vendors/select2/select2.min.css">
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
            <div class="row justify-content-center"> <!-- Modified -->
                <div class="col-lg-10 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                    <h4 class="card-title">List Of Parents</h4>
                    <div class="table-responsive">
                        <table class="table">
                        <thead>
                            <tr>
                            <th>Full Name</th>
                            <th>Identification Number</th>
                            <th>Phone Number</th>
                            <th>Rfid Number</th>
                            </tr>
                        </thead>
                        <tbody>
                            <!-- Dynamic rows will be appended here by JavaScript -->
                        </tbody>
                        </table>
                        <div id="error-message" class="text-danger"></div>

                    </div>
                    </div>
                </div>
                </div>
            </div>
            </div>
            <!-- content-wrapper ends -->
            <footer class="footer">
            <div class="footer-wrap">
                <div class="d-sm-flex justify-content-center justify-content-sm-between">
                <span class="text-muted text-center text-sm-left d-block d-sm-inline-block">Copyright © <a href="https://www.bootstrapdash.com/" target="_blank">bootstrapdash.com </a>2021</span>
                <span class="float-none float-sm-right d-block mt-1 mt-sm-0 text-center">Only the best <a href="https://www.bootstrapdash.com/" target="_blank"> Bootstrap dashboard </a> templates</span>
                </div>
            </div>
            </footer>
        </div>
        <!-- main-panel ends -->
        </div>
        <!-- page-body-wrapper ends -->
    </div>
    <!-- container-scroller -->
    <!-- base:js -->
    <script src="../../vendors/base/vendor.bundle.base.js"></script>
    <!-- endinject -->
    <!-- Plugin js for this page-->
    <!-- End plugin js for this page-->
    <!-- inject:js -->
    <script src="../../js/template.js"></script>
    <!-- endinject -->
    <!-- plugin js for this page -->
    <!-- End plugin js for this page -->
    <!-- Custom js for this page-->
    <!-- End custom js for this page -->

    <!-- Custom script to fetch and display guardians -->
    <script>
    $(document).ready(function() {
        // Function to fetch and display guardian data
        function fetchGuardians() {
            // Retrieve the token from sessionStorage
            const token = sessionStorage.getItem('token');

            $.ajax({
                url: 'http://127.0.0.1:8000/api/guardian-data', // Adjust the URL to your actual endpoint
                method: 'GET',
                dataType: 'json',
                headers: {
                    'Authorization': 'Bearer ' + token // Include the token in the request headers
                },
                success: function(data) {
                    var tableBody = $('table tbody');
                    tableBody.empty(); // Clear the existing table body

                    data.forEach(function(guardian) {
                        // Fetch RFID name for each guardian
                        $.ajax({
                            url: 'http://127.0.0.1:8000/api/guardian/get-rfid/' + guardian.rfid_id, // Adjust the URL to your actual endpoint
                            method: 'GET',
                            dataType: 'json',
                            headers: {
                                'Authorization': 'Bearer ' + token // Include the token in the request headers
                            },
                            success: function(rfidData) {
                                // Append fetched data to the table row
                                var row = `<tr>
                                    <td>${guardian.name}</td>
                                    <td>${guardian.ic_number}</td>
                                    <td>${guardian.phone_number}</td>
                                    <td>${rfidData.number || 'N/A'}</td> <!-- Assuming 'name' is the field containing RFID name -->
                                </tr>`;
                                tableBody.append(row);
                            },
                            error: function(xhr, status, error) {
                                console.log('Error fetching RFID data:', error);
                                // Display error message to the user
                                $('#error-message').text('Error fetching RFID data. Please try again later.');
                            }
                        });
                    });
                },
                error: function(xhr, status, error) {
                    console.log('Error fetching guardians:', error);
                    // Display error message to the user
                    $('#error-message').text('Error fetching guardians. Please try again later.');
                }
            });
        }

        // Fetch guardians when the document is ready
        fetchGuardians();
    });
</script>

    </body>

    </html>
 <!-- Custom script to fetch and display guardians -->
 <script>
        $(document).ready(function() {
            // Function to fetch and display guardian data
            function fetchGuardians() {
                // Retrieve the token from sessionStorage
                const token = sessionStorage.getItem('token');

                $.ajax({
                    url: 'http://127.0.0.1:8000/api/guardian-data', // Adjust the URL to your actual endpoint
                    method: 'GET',
                    dataType: 'json',
                    headers: {
                        'Authorization': 'Bearer ' + token // Include the token in the request headers
                    },
                    success: function(data) {
                        var tableBody = $('#guardian-table-body');
                        tableBody.empty(); // Clear the existing table body

                        // Collect promises for RFID data fetching
                        var rfidPromises = data.map(function(guardian) {
                            return $.ajax({
                                url: 'http://127.0.0.1:8000/api/guardian/get-rfid/' + guardian.rfid_id, // Adjust the URL to your actual endpoint
                                method: 'GET',
                                dataType: 'json',
                                headers: {
                                    'Authorization': 'Bearer ' + token // Include the token in the request headers
                                }
                            }).then(function(rfidData) {
                                return {
                                    guardian: guardian,
                                    rfidNumber: rfidData.number || 'N/A'
                                };
                            });
                        });

                        // Process all promises
                        Promise.all(rfidPromises).then(function(results) {
                            results.forEach(function(result) {
                                var row = `<tr>
                                    <td>${result.guardian.name}</td>
                                    <td>${result.guardian.ic_number}</td>
                                    <td>${result.guardian.phone_number}</td>
                                    <td>${result.rfidNumber}</td>
                                </tr>`;
                                tableBody.append(row);
                            });
                        }).catch(function(error) {
                            console.log('Error fetching RFID data:', error);
                            // Display error message to the user
                            $('#error-message').text('Error fetching RFID data. Please try again later.');
                        });
                    },
                    error: function(xhr, status, error) {
                        console.log('Error fetching guardians:', error);
                        // Display error message to the user
                        $('#error-message').text('Error fetching guardians. Please try again later.');
                    }
                });
            }

            // Fetch guardians when the document is ready
            fetchGuardians();
        });
    </script>
</body>
</html>