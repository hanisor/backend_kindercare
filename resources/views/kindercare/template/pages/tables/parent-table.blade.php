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
                <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown" id="profileDropdown" data-caregiver-id="1">
                    <span class="nav-profile-name">Loading...</span>
                    <span class="online-status"></span>
                    <img src="images/faces/face28.png" alt="profile"/>
                </a>
                  <div class="dropdown-menu dropdown-menu-right navbar-dropdown" aria-labelledby="profileDropdown">
                      <a class="dropdown-item">
                        <i class="mdi mdi-settings text-primary"></i>
                        Settings
                      </a>
                      <a class="dropdown-item d-flex align-items-center" href="#" onClick="signOut()">
                      <i class="mdi mdi-logout text-primary"></i>
                        <span>Sign Out</span>
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
                    <span class="menu-title">Session</span>
                    <i class="menu-arrow"></i>
                  </a>
                  <div class="submenu">
                      <ul>
                          <li class="nav-item"><a class="nav-link" href="/add-rfid">RFID</a></li>
                          <li class="nav-item"><a class="nav-link" href="/add-session">Session</a></li>
                      </ul>
                  </div>
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
                          <li class="nav-item"><a class="nav-link" href="/add-caregiver">Caregiver</a></li>

                      </ul>
                  </div>
              </li>
             
              
              <li class="nav-item">
                  <a href="pages/charts/chartjs.html" class="nav-link">
                    <i class="mdi mdi-finance menu-icon"></i>
                    <span class="menu-title">Charts</span>
                    <i class="menu-arrow"></i>
                  </a>
              </li>
              <li class="nav-item">
              <a  href="#" class="nav-link">
                    <i class="mdi mdi-grid menu-icon"></i>
                    <span class="menu-title">Tables</span>
                    <i class="menu-arrow"></i>
                </a>
                <div class="submenu">
                    <ul>
                    <li class="nav-item"><a class="nav-link" href="/parent-table">Parents Record</a></li>
                    <li class="nav-item"><a class="nav-link" href="/children-table">Children Record</a></li>
                    <li class="nav-item"><a class="nav-link" href="/caregiver-table">Caregiver Record</a></li>

                    </ul>
                </div>
                </li>
            </ul>
        </div>
      </nav >
    </div>
    <!-- partial -->
    <div class="container-fluid page-body-wrapper">
        <div class="main-panel">
            <div class="content-wrapper">
            <div id="message" class="alert" role="alert" style="display: none;"></div> <!-- Message container -->
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
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody id="guardian-table-body">
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

<!-- Modal for delete confirmation -->
<div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteModalLabel">Confirm Delete</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                Are you sure you want to delete this guardian?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-danger" id="confirmDeleteButton">Delete</button>
            </div>
        </div>
    </div>
</div>

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

<!-- Bootstrap JS -->
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

<!-- Custom script to fetch and display guardians -->
<script>
    $(document).ready(function() {
        // Function to fetch and display guardian data
        function fetchGuardians() {
            // Retrieve the token from sessionStorage
            const token = sessionStorage.getItem('token');

            $.ajax({
                url: '/api/guardian-data', // Adjust the URL to your actual endpoint
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
                            url: '/api/get-rfid/' + guardian.rfid_id, // Adjust the URL to your actual endpoint
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
                                <td>
                                    <button type="button" class="btn btn-danger btn-rounded btn-fw" onclick="confirmDelete(${result.guardian.id})">Delete</button>
                                </td>
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

    function confirmDelete(guardianId) {
        $('#deleteModal').modal('show');
        $('#confirmDeleteButton').off('click').on('click', function() {
            deleteGuardian(guardianId);
            $('#deleteModal').modal('hide');
        });
    }

    function deleteGuardian(guardianId) {
        const token = sessionStorage.getItem('token');
        
        $.ajax({
            url: '/api/guardian/update-status/' + guardianId,
            method: 'PUT',
            headers: {
                'Authorization': 'Bearer ' + token,
                'Content-Type': 'application/json'
            },
            data: JSON.stringify({ status: 'INACTIVE' }),
            success: function(response) {
                // Remove the guardian row from the table
                $('#guardian-table-body').find(`tr:has(button[onclick="confirmDelete(${guardianId})"])`).remove();
                showMessage('You successfully deleted the record.', 'success');
            },
            error: function(xhr, status, error) {
                console.log('Error deleting guardian:', error);
                showMessage('You unsuccessfully deleted the record.', 'danger');
                $('#error-message').text('Error deleting guardian. Please try again later.');
            }
        });
    }

    function showMessage(message, type) {
        const messageDiv = $('#message');
        messageDiv.removeClass('alert-success alert-danger').addClass('alert-' + type).text(message).show();
        setTimeout(function() {
            messageDiv.fadeOut();
        }, 5000);
    }
</script>

<script>

function signOut() {
  const token = sessionStorage.getItem('token');

  const data = {};

  fetch('/api/logout', {
    method: 'POST',
    headers: {
      'Content-Type': 'application/json',
      'Authorization': 'Bearer ' + token // Ensure token is stored and retrieved correctly
    },
    body: JSON.stringify(data)
  })
  .then(response => {
    if (response.ok) {
      return response.json();
    } else {
      throw new Error('Network response was not ok.');
    }
  })
  .then(data => {
    console.log('Response:', data);
    // Redirect to the login page
    window.location.replace('/caregiver-login');
  })
  .catch(error => {
    console.error('Error during fetch:', error);
  });
}

</script>

</body>
</html>
