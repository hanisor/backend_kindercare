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
          <div class="col-12 grid-margin">
          <div class="card">
                <div class="card-body">
                  <h4 class="card-title">Children Registration</h4>
                  
                <!-- Add a search input field for guardian name -->
                    <div class="input-group mb-3">
                    <input type="text" class="form-control" id="guardian-search" placeholder="Search guardian name">
                    <div class="input-group-append">
                        <button class="btn btn-primary" type="button" onclick="searchGuardian()" style="height: 38px;">Search</button>
                    </div>
                    </div>
                    <!-- Display parent names only -->
                    <div id="guardian-results" class="mb-3"></div>
                    <form id="childForm" class="row g-3 needs-validation" novalidate>
                    <input type="hidden" id="selected-guardian-id">
                    <div class="mb-3"></div>


                    <!-- Start form -->

                    <div class="row">
                      <div class="col-md-6">
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label" for="name">Full Name</label>
                          <div class="col-sm-9">
                          <input type="text" class="form-control" id="name" name="name" placeholder="Name">
                          </div>
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label" for="my_kid_number">My Kid Number</label>
                          <div class="col-sm-9">
                          <input type="text" class="form-control" id="my_kid_number" name="my_kid_number" placeholder="My Kid Number">
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-md-6">
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label" for="gender">Gender</label>
                          <div class="col-sm-9">
                          <select class="form-control" id="gender" name="gender">
                              <option>Male</option>
                              <option>Female</option>
                            </select>
                          </div>
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label" for="date_of_birth">Date of Birth</label>
                          <div class="col-sm-9">
                          <input type="text" class="form-control" id="date_of_birth" name="date_of_birth" placeholder="dd/mm/yyyy"/>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-md-6">
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label" for="allergy">Allergy</label>
                          <div class="col-sm-9">
                          <input type="text" class="form-control" id="allergy" name="allergy" placeholder="Allergy">
                          </div>
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label">Session</label>
                          <div class="col-sm-8">
                          <select class="js-example-basic-single w-100" id="time-slot-dropdown" name= "time-slot-dropdown">
                            <option value="08:00 AM - 03:00 PM">08:00 AM - 03:00 PM</option>
                            <option value="02:00 PM - 06:00 PM">02:00 PM - 06:00 PM</option>
                            <option value="08:00 AM - 06:00 PM">08:00 AM - 06:00 PM</option>
                          </select>
                        </div>
                      </div>
                      <div  class="col-sm-3 col-form-label" >
                        <button type="button" class="btn btn-primary mr-2" onclick="addChild()">Save</button>
                        <button type="button" class="btn btn-secondary" onclick="returnToIndex()">Cancel</button>
                    </div>
                    
                    </div>
                  </form>
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
    <script src="vendors/base/vendor.bundle.base.js"></script>
    <!-- endinject -->
    <!-- Plugin js for this page-->
    <!-- End plugin js for this page-->
    <!-- inject:js -->
    <script src="js/template.js"></script>
    <!-- endinject -->
    <!-- plugin js for this page -->
    <!-- End plugin js for this page -->
    <!-- Custom js for this page-->
    <!-- End custom js for this page -->


    <script>
    let childId; // Declare the childId variable globally

    function searchGuardian() {
      const query = document.getElementById('guardian-search').value;
      const token = sessionStorage.getItem('token');
      
      fetch(`http://127.0.0.1:8000/api/guardian-byKeyword?keyword=${query}`, {
        method: 'GET',
        dataType: 'json',
        headers: {
        'Authorization': 'Bearer ' + token // Include the token in the request headers
         }
       })
      .then(response => response.json())
      .then(data => {
        const guardianResults = document.getElementById('guardian-results');
        guardianResults.innerHTML = ''; // Clear previous results
        if (data.length > 0) {
          data.forEach(guardian => {
            const guardianDiv = document.createElement('div');
            guardianDiv.innerHTML = `
            <p>${guardian.name} - <button onclick="selectGuardian(${guardian.id}, '${guardian.name}')">Select</button></p>
            `;
            guardianResults.appendChild(guardianDiv);
          });
        } else {
          guardianResults.innerHTML = '<p>No guardians found.</p>';
        }
      })
      .catch(error => console.error('Error searching guardians:', error));
    }

    function selectGuardian(guardianId, guardianName) {
      document.getElementById('selected-guardian-id').value = guardianId;
      document.getElementById('guardian-results').innerHTML = `<p>Guardian Name: ${guardianName}</p>`;
    }

    function addChild() {
      const guardianId = document.getElementById('selected-guardian-id').value;
      const name = document.getElementById('name').value;
      const my_kid_number = document.getElementById('my_kid_number').value;
      const date_of_birth = document.getElementById('date_of_birth').value;
      const gender = document.getElementById('gender').value;
      const allergy = document.getElementById('allergy').value;
      const timeSlot = document.getElementById('time-slot-dropdown').value; // Get the selected time slot
      const token = sessionStorage.getItem('token');

      const data = {
        guardian_id: guardianId,
        name: name,
        my_kid_number: my_kid_number,
        date_of_birth: date_of_birth,
        gender: gender,
        allergy: allergy
      };
      fetch('http://127.0.0.1:8000/api/add-child', {
      method: 'POST',
      headers: {
        'Content-Type': 'application/json',
        'Authorization': 'Bearer ' + token
      },
      body: JSON.stringify(data)
    })
    .then(response => {
      // Additional code to execute before parsing the response
      return response.json();
    })
    .then(data => {
  console.log("Response from adding child:", data); // Log the entire response data
  console.log("Child ID:", data.message.id); // Log the child ID specifically
  if (data.message.id) {
    // After adding the child, retrieve the group ID based on the selected time slot
    const childId = data.message.id; // Store the child_id
    console.log("childId:", childId);
    getGroupIdByTimeSlot(childId, timeSlot); // Pass child_id and timeSlot to the function
  } else {
    console.error('Error adding childdd:', data.message);
  }
})


    .catch(error => console.error('Error adding childddddd:', error));


  function getGroupIdByTimeSlot(childId, timeSlot) {
    const token = sessionStorage.getItem('token');

    fetch('http://127.0.0.1:8000/api/child-group/time?time=' + timeSlot,  {
      method: 'GET',
      headers: {
        'Authorization': 'Bearer ' + token
      }
    })
    .then(response => response.json())
    .then(data => {
      console.log("Response from retrieving group ID:", data);
      if (data.group_id) {
        // After retrieving the group ID, add the child to the group
        addChildToGroup(childId, data.group_id);
      } else {
        console.error('Error retrieving group ID:', data.message);
      }
    })
    .catch(error => console.error('Error retrieving group ID:', error));
  }

function addChildToGroup(childId, groupId) {
  const token = sessionStorage.getItem('token');

  const data = {
    child_id: childId, // Access the global childId variable
    group_id: groupId
  };
  console.log("Data to add child to group:", data);

  fetch('http://127.0.0.1:8000/api/child-group', {
    method: 'POST',
    headers: {
      'Content-Type': 'application/json',
      'Authorization': 'Bearer ' + token  
    },
    body: JSON.stringify(data)
  })
  .then(response => response.json())
  .then(data => {
    console.log("Response from adding child to group:", data);
    if (data && data.message === 'Child and group added successfully') {
      window.location.href = 'http://127.0.0.1:8000/children-table';
    } else {
      console.error('Error adding child to group:', data && data.message ? data.message : 'Unknown error');
    }
  })
  .catch(error => console.error('Error adding child to group:', error));
}
    }

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