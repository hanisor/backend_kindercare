<!DOCTYPE html>
    <html lang="en">

    <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Children Record</title>
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
          <div class="row justify-content-center">
            <div class="col-lg-10 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">List Of Children</h4>
                  <div class="table-responsive">
                    <table class="table">
                    <div class="col-md-6">
                      <div class="form-group row align-items-center">
                          <label class="col-sm-3 col-form-label">Session</label>
                          <div class="col-sm-9">
                              <select class="js-example-basic-single w-100" id="time-slot-dropdown" name="time-slot-dropdown">
                                  <option value="08:00 AM - 03:00 PM">08:00 AM - 03:00 PM</option>
                                  <option value="02:00 PM - 06:00 PM">02:00 PM - 06:00 PM</option>
                                  <option value="08:00 AM - 06:00 PM">08:00 AM - 06:00 PM</option>
                              </select>
                          </div>
                      </div>
                  </div>

                      <thead>
                        <tr class="header-row">
                          <th>Number</th>
                          <th>Full Name</th>
                          <th>MyKid Number</th>
                          <th>Date Of Birth</th>
                          <th>Age</th>
                          <th>Gender</th>
                          <th>Allergy</th>
                          <th>Parent Name</th>
                        </tr>
                      </thead>
                      <tbody id="childrenTableBody">
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
   <!-- Custom script to fetch and display children and their guardians -->
<!-- Custom script to fetch and display children and their guardians -->

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>

   // Custom function to parse date string in format "DD/MM/YYYY" to JavaScript Date object
   function parseDate(dateString) {
        var parts = dateString.split('/');
        // Note: months are 0-based in JavaScript Date object, so subtract 1 from the month
        return new Date(parts[2], parts[1] - 1, parts[0]);
    }
$(document).ready(function() {
    // Function to fetch and display children and their guardian data
    function getChildGroup(group_id) {
        console.log('Group ID:', group_id); // Debug: Log the group ID

        // Retrieve the token from sessionStorage
        const token = sessionStorage.getItem('token');

        $.ajax({
            url: 'http://127.0.0.1:8000/api/child-group/' + group_id, // Adjust the URL to your actual endpoint
            method: 'GET',
            dataType: 'json',
            headers: {
                'Authorization': 'Bearer ' + token // Include the token in the request headers
            },
            // Success callback function
            success: function(response) {
    console.log('Response:', response); // Debug: Log the fetched response

    // Check if response contains the expected key
    if (response.hasOwnProperty('child_group')) {
        var data = response.child_group; // Access the array of children data

        var tableBody = $('#childrenTableBody');
        tableBody.empty(); // Clear the existing table body

        data.forEach(function(child, index) {
          // Calculate age based on parsed date of birth
          var dob = parseDate(child.date_of_birth);
          var ageDate = new Date(Date.now() - dob.getTime());
          var age = Math.abs(ageDate.getUTCFullYear() - 1970);

          // Append fetched data to the table row including age
          var row = `<tr>
              <td>${index + 1}</td>
              <td>${child.name}</td>
              <td>${child.my_kid_number}</td>
              <td>${child.date_of_birth}</td>
              <td>${age}</td> <!-- Display calculated age -->
              <td>${child.gender}</td>
              <td>${child.allergy}</td>
              <td>${child.guardian_name || 'N/A'}</td>
          </tr>`;
          tableBody.append(row);
      });
    } else {
        // If the expected key is not found in the response
        console.error('Invalid data format: Missing child_group key');
        $('#error-message').text('Invalid data format. Please try again later.');
    }
},


            error: function(xhr, status, error) {
                console.log('Error fetching children:', error);
                // Display error message to the user
                $('#error-message').text('Error fetching children. Please try again later.');
            }
        });
    }
  // Function to fetch the group ID by time slot
  function getGroupIdByTimeSlot(timeSlot) {
    const token = sessionStorage.getItem('token');

    fetch('http://127.0.0.1:8000/api/child-group/time?time=' + timeSlot, {
        method: 'GET',
        headers: {
          'Authorization': 'Bearer ' + token
        }
      })
      .then(response => response.json())
      .then(data => {
        console.log("Response from retrieving group ID:", data);
        console.log("Response from retrieving group ID:", data.group_id);
        if (data.group_id) {
          // After retrieving the group ID, add the child to the group
          getChildGroup(data.group_id);
        } else {
          console.error('Error retrieving group ID:', data.message);
        }
      })
      .catch(error => console.error('Error retrieving group ID:', error));
  }

  // Fetch children when the document is ready
  getGroupIdByTimeSlot($('#time-slot-dropdown').val());

  // Event listener for time slot dropdown change
  $('#time-slot-dropdown').change(function() {
    var selectedTimeSlot = $(this).val();
    // Call the function to fetch group ID by time slot
    getGroupIdByTimeSlot(selectedTimeSlot);
  });
});

  </script>

<script>

function signOut() {
  const token = sessionStorage.getItem('token');

  const data = {};

  fetch('http://127.0.0.1:8000/api/logout', {
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
    window.location.replace('http://127.0.0.1:8000/caregiver-login');
  })
  .catch(error => {
    console.error('Error during fetch:', error);
  });
}

</script>
</body>

</html>