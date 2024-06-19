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
                                    <input type="text" class="form-control" placeholder="search" aria-label="search"
                                        aria-describedby="search">
                                </div>
                            </li>
                        </ul>
                        <div class="text-center navbar-brand-wrapper d-flex align-items-center justify-content-center">
                            <a class="navbar-brand brand-logo" href="/caregiver-homepage"><img src="images/4.png"
                                    alt="logo" /></a>
                            <a class="navbar-brand brand-logo-mini" href="/caregiver-homepage"><img src="images/4.png"
                                    alt="logo" /></a>
                        </div>
                        <ul class="navbar-nav navbar-nav-right">
                            <li class="nav-item dropdown d-lg-flex d-none">
                                <button type="button" class="btn btn-inverse-primary btn-sm">Settings</button>
                            </li>
                            <li class="nav-item nav-profile dropdown">
                                <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown"
                                    id="profileDropdown" data-caregiver-id="1">
                                    <span class="nav-profile-name">hanis sorhana</span>
                                    <span class="online-status"></span>
                                    <img src="images/faces/face28.png" alt="profile" />
                                </a>
                                <div class="dropdown-menu dropdown-menu-right navbar-dropdown"
                                    aria-labelledby="profileDropdown">
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
                        <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button"
                            data-toggle="horizontal-menu-toggle">
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
                            <a href="/attendance" class="nav-link">
                                <i class="mdi mdi-finance menu-icon"></i>
                                <span class="menu-title">Attendance</span>
                                <i class="menu-arrow"></i>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="mdi mdi-grid menu-icon"></i>
                                <span class="menu-title">Tables</span>
                                <i class="menu-arrow"></i>
                            </a>
                            <div class="submenu">
                                <ul>
                                    <li class="nav-item"><a class="nav-link" href="/parent-table">Parents Record</a>
                                    </li>
                                    <li class="nav-item"><a class="nav-link" href="/children-table">Children
                                            Record</a></li>
                                    <li class="nav-item"><a class="nav-link" href="/caregiver-table">Caregiver
                                            Record</a></li>

                                </ul>
                            </div>
                        </li>
                    </ul>
                </div>
            </nav>
        </div>
        <!-- partial -->
        <div class="container-fluid page-body-wrapper">
            <div class="main-panel">
                <div class="content-wrapper">
                    <div id="message" class="alert" role="alert" style="display: none;"></div>
                    <!-- Message container -->

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
                                                        <select class="js-example-basic-single w-100"
                                                            id="time-slot-dropdown" name="time-slot-dropdown">
                                                            <option value="08:00 AM - 03:00 PM">08:00 AM - 03:00 PM
                                                            </option>
                                                            <option value="02:00 PM - 06:00 PM">02:00 PM - 06:00 PM
                                                            </option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="form-group row align-items-center">
                                                    <label class="col-sm-3 col-form-label">Caregiver</label>
                                                    <div class="col-sm-9">
                                                        <select class="js-example-basic-single w-100"
                                                            id="caregiver-dropdown" name="caregiver-dropdown">
                                                            <!-- Caregiver options will be populated here -->
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>

                                            <thead>
                                                <tr class="header-row">
                                                    <th><b>Number</b></th>
                                                    <th><b>Full Name</b></th>
                                                    <th><b>MyKid Number</b></th>
                                                    <th><b>Date Of Birth</b></th>
                                                    <th><b>Age</b></th>
                                                    <th><b>Gender</b></th>
                                                    <th><b>Allergy</b></th>
                                                    <th><b>Parent Name</b></th>
                                                    <th><b>Action</b></th>
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
                            <!-- Contact Info -->
                            <div style="flex: 1; min-width: 200px; margin: 10px;">
                                <h4 style="color: #343a40; font-size: 18px; margin-bottom: 10px;">Contact Us</h4>
                                <p style="color: #343a40; font-size: 14px;">
                                    123 KinderCare Street<br>
                                    Happy Town, HT 12345<br>
                                    Phone: (123) 456-7890<br>
                                    Email: <a href="mailto:info@kindercare.com"
                                        style="color: #343a40; text-decoration: none;">info@kindercare.com</a>
                                </p>
                            </div>
                        </div>

                        <!-- Copyright -->
                        <div style="margin-top: 20px; color: #343a40; font-size: 14px;">
                            &copy; 2024 KinderCare. All rights reserved.
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

    <!-- Custom script to fetch and display caregivers -->
    <!-- Custom script to fetch and display children and their caregivers -->

    <!-- Bootstrap JS -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function () {
            function fetchCaregivers(timeSlot) {
                const token = sessionStorage.getItem('token');
                $.ajax({
                    url: '/api/caregiver-time',
                    method: 'GET',
                    data: { time: timeSlot },
                    headers: { 'Authorization': 'Bearer ' + token },
                    success: function (response) {
                        if (response.caregivers && response.caregivers.length > 0) {
                            populateCaregiversDropdown(response.caregivers);
                        } else {
                            $('#caregiver-dropdown').empty().append('<option>No caregivers found</option>');
                        }
                    },
                    error: function () {
                        $('#caregiver-dropdown').empty().append('<option>Error fetching caregivers</option>');
                    }
                });
            }

            function fetchGroupIdbyTimeAndCaregiver(timeslot, caregiverId) {
                const token = sessionStorage.getItem('token');
                $.ajax({
                    url: '/api/groupid-time-caregiver',
                    method: 'GET',
                    data: { 
                        time: timeslot,
                        caregiver_id: caregiverId 
                    },
                    headers: { 'Authorization': 'Bearer ' + token },
                    success: function(data) {
                        let groupIds = data.group_ids;

                        // Automatically fetch children for the first group
                        if (groupIds.length > 0) {
                            fetchChildrenByGroupId(groupIds[0]);
                        }
                    },
                    error: function(error) {
                        console.error('Error fetching group IDs:', error);
                        alert('Error fetching group IDs: ' + error.responseText);
                    }
                });
            }

            function fetchChildrenByGroupId(groupId) {
                const token = sessionStorage.getItem('token');
                $.ajax({
                    url: '/api/child-by-group',
                    method: 'GET',
                    data: { group_id: groupId },
                    headers: { 'Authorization': 'Bearer ' + token },
                    success: function (response) {
                        if (response.children && response.children.length > 0) {
                            populateChildrenTable(response.children);
                        } else {
                            $('#childrenTableBody').empty().append('<tr><td colspan="9">No children found for the selected group</td></tr>');
                        }
                    },
                    error: function () {
                        $('#childrenTableBody').empty().append('<tr><td colspan="9">No children found for the selected group</td></tr>');
                    }
                });
            }

            function fetchChildrenByTimeSlot(timeSlot) {
                const token = sessionStorage.getItem('token');
                $.ajax({
                    url: '/api/get-child-group-time',
                    method: 'GET',
                    data: { time: timeSlot },
                    headers: { 'Authorization': 'Bearer ' + token },
                    success: function (response) {
                        if (response.child_group && response.child_group.length > 0) {
                            populateChildrenTable(response.child_group);
                        } else {
                            $('#childrenTableBody').empty().append('<tr><td colspan="9">No children found for the selected time slot</td></tr>');
                        }
                    },
                    error: function () {
                        $('#childrenTableBody').empty().append('<tr><td colspan="9">No children found for the selected time slot</td></tr>');
                    }
                });
            }

            function populateCaregiversDropdown(caregivers) {
                var dropdown = $('#caregiver-dropdown');
                dropdown.empty();
                dropdown.append('<option value="all">All</option>'); // Add this line
                caregivers.forEach(function (caregiver) {
                    dropdown.append('<option value="' + caregiver.id + '">' + caregiver.name + '</option>');
                });
            }

            function populateChildrenTable(children) {
                var tableBody = $('#childrenTableBody');
                tableBody.empty();
                children.forEach(function (child, index) {
                    var dob = new Date(child.date_of_birth);
                    var age = new Date().getFullYear() - dob.getFullYear();
                    var row = `<tr>
                        <td>${index + 1}</td>
                        <td>${child.name}</td>
                        <td>${child.my_kid_number}</td>
                        <td>${child.date_of_birth}</td>
                        <td>${age}</td>
                        <td>${child.gender}</td>
                        <td>${child.allergy}</td>
                        <td>${child.guardian_name || 'N/A'}</td>
                        <td><button type="button" class="btn btn-danger btn-rounded btn-fw" onclick="confirmDelete(${child.id})">Delete</button></td>
                    </tr>`;
                    tableBody.append(row);
                });
            }

            $('#time-slot-dropdown').change(function () {
                const selectedTimeSlot = $(this).val();
                fetchCaregivers(selectedTimeSlot);
                fetchChildrenByTimeSlot(selectedTimeSlot);
            });

            $('#caregiver-dropdown').change(function () {
                const selectedCaregiverId = $(this).val();
                const selectedTimeSlot = $('#time-slot-dropdown').val();
                if (selectedCaregiverId === 'all') {
                    fetchChildrenByTimeSlot(selectedTimeSlot);
                } else {
                    fetchGroupIdbyTimeAndCaregiver(selectedTimeSlot, selectedCaregiverId);
                }
            });

            // Function to confirm delete action
            window.confirmDelete = function (childId) {
                $('#deleteModal').modal('show');
                $('#confirmDeleteButton').off('click').on('click', function () {
                    deleteChild(childId);
                    $('#deleteModal').modal('hide');
                });
            };

            // Function to delete a child record
            function deleteChild(childId) {
                const token = sessionStorage.getItem('token');
                $.ajax({
                    url: '/api/child/update-status/' + childId,
                    method: 'PUT',
                    headers: {
                        'Authorization': 'Bearer ' + token,
                        'Content-Type': 'application/json'
                    },
                    data: JSON.stringify({ status: 'INACTIVE' }),
                    success: function (response) {
                        // Remove the child row from the table
                        $('#childrenTableBody').find(`tr:has(button[onclick="confirmDelete(${childId})"])`).remove();
                        showMessage('You successfully deleted the record.', 'success');
                    },
                    error: function (xhr, status, error) {
                        console.log('Error deleting child:', error);
                        showMessage('You unsuccessfully deleted the record.', 'danger');
                        $('#error-message').text('Error deleting child. Please try again later.');
                    }
                });
            }

            // Function to show a message
            function showMessage(message, type) {
                const messageDiv = $('#message');
                messageDiv.removeClass('alert-success alert-danger').addClass('alert-' + type).text(message).show();
                setTimeout(function () {
                    messageDiv.fadeOut();
                }, 5000);
            }

            // Initial fetch
            const initialTimeSlot = $('#time-slot-dropdown').val();
            fetchCaregivers(initialTimeSlot);
            fetchChildrenByTimeSlot(initialTimeSlot);
        });

        function signOut() {
            // Clear the session storage and redirect to login page
            sessionStorage.clear();
            window.location.href = '/login';
        }
    </script>
</body>

</html>
