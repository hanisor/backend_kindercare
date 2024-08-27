<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Caregiver Record</title>
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
                        <a class="navbar-brand brand-logo" href="/caregiver-homepage"><img src="images/4.png" alt="logo"/></a>
                        <a class="navbar-brand brand-logo-mini" href="/caregiver-homepage"><img src="images/4.png" alt="logo"/></a>
                    </div>
                    <ul class="navbar-nav navbar-nav-right">
                        <li class="nav-item dropdown d-lg-flex d-none">
                            <button type="button" class="btn btn-inverse-primary btn-sm">Settings</button>
                        </li>
                        <li class="nav-item nav-profile dropdown">
                            <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown" id="profileDropdown" data-caregiver-id="1">
                                <span class="nav-profile-name">hanis sorhana</span>
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
                                <li class="nav-item"><a class="nav-link" href="/parent-table">Parents Record</a></li>
                                <li class="nav-item"><a class="nav-link" href="/children-table">Children Record</a></li>
                                <li class="nav-item"><a class="nav-link" href="/caregiver-table">Caregiver Record</a></li>
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
                <div id="message" class="alert" role="alert" style="display: none;"></div> <!-- Message container -->
                <div class="row justify-content-center"> <!-- Modified -->
                    <div class="col-lg-10 grid-margin stretch-card">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">List Of Caregivers</h4>
                                <div class="col-md-6">
                                    <div class="form-group row align-items-center">
                                        <label class="col-sm-3 col-form-label">Session</label>
                                        <div class="col-sm-9">
                                            <select class="js-example-basic-single w-100" id="time-slot-dropdown" name="time-slot-dropdown">
                                                <option value="08:00 AM - 03:00 PM">08:00 AM - 03:00 PM</option>
                                                <option value="02:00 PM - 06:00 PM">02:00 PM - 06:00 PM</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="table-responsive">
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th><b>Full Name</b></th>
                                                <th><b>Identification Number</b></th>
                                                <th><b>Phone Number</b></th>
                                                <th><b>Age Assigned</b></th>
                                                <th><b>Action</b></th>
                                            </tr>
                                        </thead>
                                        <tbody id="caregiver-table-body">
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
                                Happy Town, HT 12345<br
                                <div style="color: #343a40; font-size: 14px;">
                            Phone: (123) 456-7890<br>
                            Email: <a href="mailto:info@kindercare.com" style="color: #343a40; text-decoration: none;">info@kindercare.com</a>
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
            <div class="modal-body" style="color: black;">
                Are you sure you want to delete this caregiver?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-danger" id="confirmDeleteButton">Delete</button>
            </div>
        </div>
    </div>
</div>

<!-- base:js -->
<script src="vendors/base/vendor.bundle.base.js"></script>
<!-- endinject -->
<!-- Plugin js for this page-->
<script src="vendors/select2/select2.min.js"></script>
<!-- End plugin js for this page-->
<!-- inject:js -->
<script src="js/template.js"></script>
<!-- endinject -->
<!-- Custom js for this page-->
<script>
    const token = sessionStorage.getItem('token');

    function confirmDelete(caregiverId) {
    $('#deleteModal').modal('show');
    $('#confirmDeleteButton').off('click').on('click', function() {
        deleteCaregiver(caregiverId);
        $('#deleteModal').modal('hide');
    });
    $('#deleteModal').find('.btn-secondary').off('click').on('click', function() {
        $('#deleteModal').modal('hide');
        $('#message').hide(); // Hide message if any
    });
}

function deleteCaregiver(caregiverId) {
    $.ajax({
        url: '/api/caregiver/update-status/' + caregiverId,
        method: 'PUT',
        headers: {
            'Authorization': 'Bearer ' + token,
            'Content-Type': 'application/json'
        },
        data: JSON.stringify({ status: 'INACTIVE' }),
        success: function(response) {
            $('#caregiver-table-body').find(`tr:has(button[onclick="confirmDelete(${caregiverId})"])`).remove();
            showMessage('You successfully deleted the record.', 'success');
        },
        error: function(xhr, status, error) {
            console.log('Error deleting caregiver:', error);
            showMessage('You unsuccessfully deleted the record.', 'danger');
            $('#error-message').text('Error deleting caregiver. Please try again later.');
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
        fetch('/api/logout', {
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
            window.location.replace('/caregiver-login');
        })
        .catch(error => {
            console.error('Error during fetch:', error);
        });
    }

    $(document).ready(function() {
    // Function to fetch caregivers based on timeslot
    function fetchCaregivers(timeSlot) {
        $.ajax({
            url: '/api/caregiver-time',
            method: 'GET',
            data: { time: timeSlot },
            dataType: 'json',
            headers: {
                'Authorization': 'Bearer ' + token
            },
            success: function(data) {
                var tableBody = $('#caregiver-table-body');
                tableBody.empty();

                if (data.caregivers && data.caregivers.length > 0) {
                    // Sort caregivers by age from 2 years old to 6 years old
                    data.caregivers.sort(function(a, b) {
                        return a.age - b.age;
                    });

                    data.caregivers.forEach(function(caregiver) {
                        var row = `<tr>
                            <td>${caregiver.name}</td>
                            <td>${caregiver.ic_number}</td>
                            <td>${caregiver.phone_number}</td>
                            <td>${caregiver.age} years old</td>
                            <td><button type="button" class="btn btn-danger btn-rounded btn-fw" onclick="confirmDelete(${caregiver.id})">Delete</button></td>
                        </tr>`;
                        tableBody.append(row);
                    });
                } else {
                    var row = `<tr><td colspan="5" class="text-center">No caregivers found for the selected timeslot</td></tr>`;
                    tableBody.append(row);
                }
            },
            error: function(xhr, status, error) {
                console.log('Error fetching caregivers:', error);
                $('#error-message').text('Error fetching caregivers. Please try again later.');
            }
        });
    }

    // Fetch caregivers when timeslot is changed
    $('#time-slot-dropdown').change(function() {
        var selectedTimeSlot = $(this).val();
        fetchCaregivers(selectedTimeSlot);
    });

    // Trigger fetchCaregivers function for the default timeslot on page load
    var defaultTimeSlot = $('#time-slot-dropdown').val();
    fetchCaregivers(defaultTimeSlot);
});

</script>
<!-- End custom js for this page-->

<!-- Bootstrap JS -->
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</body>
</html>
