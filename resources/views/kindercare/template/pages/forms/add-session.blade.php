<!DOCTYPE html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Session</title>
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
        <div class="container-fluid page-body-wrapper d-flex justify-content-center align-items-center" style="min-height: 100vh;">
      <div class="main-panel">
        <div class="content-wrapper">
          <div class="container">
            <div class="row justify-content-center">
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
                          <button type="submit" class="btn btn-primary" >Add Session</button>
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
                    <form id="add-group-form">
                      <div class="form-group row">
                        <label class="col-sm-4 col-form-label">Year</label>
                        <div class="col-sm-8">
                          <div id="the-basics">
                            <input id="year-input" class="typeahead form-control" type="text" placeholder="Year" readonly>
                          </div>
                        </div>
                      </div>
                      <div class="form-group row">
                        <label class="col-sm-4 col-form-label">Time Slot</label>
                        <div class="col-sm-8">
                          <select id="time-slot-dropdown" class="js-example-basic-single w-100">
                            <option value="08:00 AM - 03:00 PM">08:00 AM - 03:00 PM</option>
                            <option value="02:00 PM - 06:00 PM">02:00 PM - 06:00 PM</option>
                            <option value="08:00 AM - 06:00 PM">08:00 AM - 06:00 PM</option>
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
                      <div class="form-group row">
                        <div class="col-sm-12">
                          <button type="submit" class="btn btn-primary">Add Group</button>
                        </div>
                      </div>
                    </form>
                  </div>
                </div>
              </div>

            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- partial:../../partials/_footer.html -->
    <footer class="footer">
      <!-- Footer content -->
    </footer>
    <!-- partial -->
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


  <input id="caregiver-id-input" type="hidden">

<script>
document.addEventListener('DOMContentLoaded', function() {
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

  // Bind event listener to the form's submit event
  document.getElementById('add-session-form').addEventListener('submit', function(event) {
    event.preventDefault(); // Prevent default form submission

    // Get the selected session year from the dropdown
    var selectedYear = document.getElementById('year-dropdown').value;

    // Call the addSession function to add the session asynchronously
    addSession(selectedYear);
  });

  // Bind event listener to the form's submit event
  document.getElementById('add-group-form').addEventListener('submit', function(event) {
    event.preventDefault(); // Prevent default form submission

   // Get the session ID
    var sessionId = document.getElementById('year-input').dataset.sessionId;
    var timeSlot = document.getElementById('time-slot-dropdown').value;
    var caregiverId = document.getElementById('caregiver-select').value;

    // Call the addGroup function to add the group asynchronously
    addGroup(sessionId, timeSlot, caregiverId);
  });

  // Fetch active caregivers and populate the select element
  const token = sessionStorage.getItem('token');

  $.ajax({
    url: '/api/caregiver-data', // Update with your actual endpoint
    method: 'GET',
    dataType: 'json',
    headers: {
      'Authorization': 'Bearer ' + token // Include the token in the request headers
    },
    success: function(data) {
      let caregiverSelect = document.getElementById('caregiver-select');
      data.forEach(caregiver => {
        const option = document.createElement('option');
        option.value = caregiver.id;
        option.textContent = caregiver.name;
        caregiverSelect.appendChild(option);
      });
    },
    error: function(error) {
      console.error('Error fetching caregivers:', error);
      alert('Error fetching caregivers: ' + error.responseText);
    }
  });

  // Function to add session asynchronously
  function addSession(year) {
    const token = sessionStorage.getItem('token');
    var data = {
      status: "Current",
      year: year
    };

    fetch('/api/add-session', {
      method: 'POST',
      headers: {
        'Content-Type': 'application/json',
        'Authorization': 'Bearer ' + token
      },
      body: JSON.stringify(data)
    })
    .then(response => response.json())
    .then(data => {
      console.log(data);
      // Extract the sessionId from the response
      var sessionId = data.sessionId;
      // Call fetchYearsForSession after successfully adding the session
      fetchYearsForCurrentSessions();
    })
    .catch(error => {
      console.error('Error:', error);
    });
  }

  // Function to fetch years for current sessions
  function fetchYearsForCurrentSessions() {
    const token = sessionStorage.getItem('token');
    fetch('/api/session-year', {
      method: 'GET',
      headers: {
        'Authorization': 'Bearer ' + token
      }
    })
    .then(response => response.json())
    .then(data => {
      console.log(data);
      if (data.sessionId && data.year) {
        // If a session ID and year are received, update the input field with the year
        var yearInput = document.getElementById('year-input');
        yearInput.value = data.year;
        yearInput.dataset.sessionId = data.sessionId; // Store session ID in a data attribute
        // Call the addGroup function with the session ID
        // addGroup(data.sessionId); // No need to call here, will be called on form submit
      } else {
        console.error('No current session found:', data);
      }
    })  
    .catch(error => {
      console.error('Error:', error);
    });
  }
  fetchYearsForCurrentSessions();

  // Function to add group asynchronously
  function addGroup(sessionId, timeSlot, caregiverId) {
    const token = sessionStorage.getItem('token');

    // Prepare the data object to send to the server
    var data = {
      session_id: sessionId,
      caregiver_id: caregiverId,
      time: timeSlot
    };

    fetch('/api/add-group', {
      method: 'POST',
      headers: {
        'Content-Type': 'application/json',
        'Authorization': 'Bearer ' + token
      },
      body: JSON.stringify(data)
    })
    .then(response => response.json())
    .then(data => {
      console.log(data);
    })
    .catch(error => {
      console.error('Error:', error);
    });
  }
});
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