<!DOCTYPE html>
    <html lang="en">

    <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Children Attendance</title>
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
                <div id="message" class="alert" role="alert" style="display: none;"></div>
                <div class="row justify-content-center">
                    <div class="col-lg-10 grid-margin stretch-card">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">Children Attendance</h4>
                                <div class="table-responsive">
                                <div class="col-md-6">
                                            <div class="form-group row align-items-center">
                                                <label class="col-sm-3 col-form-label">Date</label>
                                                <div class="col-sm-9">
                                                    <input type="date" class="form-control" id="date-input">
                                                </div>
                                            </div>
                                        </div>
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
                                    <table class="table">
                                        <thead>
                                            <tr class="header-row">
                                                <th>Date</th>
                                                <th>Child Name</th>
                                                <th>Arrive Time</th>
                                                <th>Leave Time</th>
                                                <th>Status</th>
                                            </tr>
                                        </thead>
                                        <tbody id="attendanceTableBody">
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
                Are you sure you want to delete this child?
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

    <!-- Custom script to fetch and display guardians -->
   <!-- Custom script to fetch and display children and their guardians -->
<!-- Custom script to fetch and display children and their guardians -->

<!-- Bootstrap JS -->
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>


<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
<script>
        document.addEventListener('DOMContentLoaded', function() {
          const dateInput = document.getElementById('date-input');
                const timeSlotDropdown = document.getElementById('time-slot-dropdown');
                const attendanceTableBody = document.getElementById('attendanceTableBody');
                const errorMessage = document.getElementById('error-message');

                function fetchAttendance() {
                  const selectedDate = dateInput.value;
                    const selectedTimeSlot = timeSlotDropdown.value;

            

                    // Clear existing table body
                    attendanceTableBody.innerHTML = '';

                    // Display a loading message
                    const loadingRow = document.createElement('tr');
                    const loadingCell = document.createElement('td');
                    loadingCell.colSpan = 5;
                    loadingCell.textContent = 'Loading...';
                    loadingRow.appendChild(loadingCell);
                    attendanceTableBody.appendChild(loadingRow);

                    getGroupIdByTimeSlot(selectedTimeSlot).then(group_id => {
                        const token = sessionStorage.getItem('token');
                        if (!token) {
                            errorMessage.textContent = 'Unauthorized. Please log in again.';
                            return;
                        }
                        console.log({
                            child_group_id: group_id,
                            date_time_arrive: selectedDate
                        });

                        axios.post('http://127.0.0.1:8000/api/attendance/child', {
                            child_group_id: group_id,
                            date_time_arrive: selectedDate
                        }, {
                            headers: {
                                'Authorization': `Bearer ${token}`
                            }
                        }).then(response => {
                          console.log('Response from backend:', response.data);

                            attendanceTableBody.innerHTML = '';
                            const attendanceData = response.data.attendance_by_day;

                            if (attendanceData && Object.keys(attendanceData).length > 0) {
                              // Update the table body accordingly
                                for (const [date, records] of Object.entries(attendanceData)) {
                                    records.forEach(record => {
                                        const row = document.createElement('tr');
                                        const status = record.date_time_arrive ? 'Present' : 'Absent'; // Check if date_time_arrive is defined
                                        const statusClass = status === 'Present' ? 'badge-success' : 'badge-danger'; // Determine status class
                                        row.innerHTML = `
                                            <td>${date}</td>
                                            <td>${record.child_name}</td>
                                            <td>${record.date_time_arrive || 'No Record'}</td> <!-- Display 'No Record' if date_time_arrive is undefined -->
                                            <td>${record.date_time_leave || 'No Record'}</td> <!-- Display 'No Record' if date_time_leave is undefined -->
                                            <td><label class="badge ${statusClass}">${status}</label></td> <!-- Add label with appropriate class -->
                                        `;
                                        attendanceTableBody.appendChild(row);
                                    });
                                }
                            } else {
                                const noDataRow = document.createElement('tr');
                                const noDataCell = document.createElement('td');
                                noDataCell.colSpan = 5;
                                noDataCell.textContent = 'No data available for the selected date and session.';
                                noDataRow.appendChild(noDataCell);
                                attendanceTableBody.appendChild(noDataRow);
                            }
                        }).catch(error => {
                            errorMessage.textContent = 'An error occurred while fetching attendance data. Please try again.';
                        });
                    });
                }

                function getGroupIdByTimeSlot(timeSlot) {
                    const token = sessionStorage.getItem('token');
                    return fetch('http://127.0.0.1:8000/api/child-group/time?time=' + timeSlot, {
                        method: 'GET',
                        headers: {
                            'Authorization': 'Bearer ' + token
                        }
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.group_id) {
                            return data.group_id;
                        } else {
                            throw new Error('Error retrieving group ID: ' + data.message);
                        }
                    })
                    .catch(error => {
                        console.error('Error retrieving group ID:', error);
                        errorMessage.textContent = 'Error retrieving group ID. Please try again later.';
                    });
                }

                function getChildGroup(group_id) {
                    const token = sessionStorage.getItem('token');
                    return fetch('http://127.0.0.1:8000/api/child-group/' + group_id, {
                        method: 'GET',
                        headers: {
                            'Authorization': 'Bearer ' + token
                        }
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.child_group) {
                            const childIDs = data.child_group.map(child => child.id);
                            const childGroupPromises = childIDs.map(child_id => fetchChildGroupId(child_id, group_id));
                            return Promise.all(childGroupPromises).then(child_group_ids => child_group_ids[0]); // Assuming we need only one child_group_id
                        } else {
                            throw new Error('Invalid data format: Missing child_group key');
                        }
                    })
                    .catch(error => {
                        console.error('Error fetching children:', error);
                        errorMessage.textContent = 'Error fetching children. Please try again later.';
                    });
                }
                timeSlotDropdown.addEventListener('change', fetchAttendance);

                // Event listener for date input change
            dateInput.addEventListener('change', fetchAttendance);

              // Initialize attendance display with current date
              const currentDate = new Date().toISOString().split('T')[0];
              dateInput.value = currentDate;
              fetchAttendance();
         
                function confirmDelete(childId) {
                    $('#deleteModal').modal('show');
                    $('#confirmDeleteButton').off('click').on('click', function() {
                        deleteChild(childId);
                        $('#deleteModal').modal('hide');
                    });
                }

                function deleteChild(childId) {
                    const token = sessionStorage.getItem('token');

                    $.ajax({
                        url: 'http://127.0.0.1:8000/api/child/update-status/' + childId,
                        method: 'PUT',
                        headers: {
                            'Authorization': 'Bearer ' + token,
                            'Content-Type': 'application/json'
                        },
                        data: JSON.stringify({ status: 'INACTIVE' }),
                        success: function(response) {
                            $('#childrenTableBody').find(`tr:has(button[onclick="confirmDelete(${childId})"])`).remove();
                            showMessage('You successfully deleted the record.', 'success');
                        },
                        error: function(xhr, status, error) {
                            console.log('Error deleting child:', error);
                            showMessage('You unsuccessfully deleted the record.', 'danger');
                            $('#error-message').text('Error deleting child. Please try again later.');
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

                function signOut() {
                    const token = sessionStorage.getItem('token');

                    fetch('http://127.0.0.1:8000/api/logout', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'Authorization': 'Bearer ' + token
                        }
                    })
                    .then(response => {
                        if (response.ok) {
                            return response.json();
                        } else {
                            throw new Error('Network response was not ok.');
                        }
                    })
                    .then(data => {
                        window.location.replace('http://127.0.0.1:8000/caregiver-login');
                    })
                    .catch(error => console.error('Error during fetch:', error));
                }
            });
        </script>
    </body>

</html>
