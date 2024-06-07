<!DOCTYPE html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>KinderCare</title>
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
                  <a href="/attendance" class="nav-link">
                    <i class="mdi mdi-finance menu-icon"></i>
                    <span class="menu-title">Attendance</span>
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
          <div class="col-lg-2 grid-margin stretch-card">
              <div class="card">
                  <div class="card-body pb-0">
                      <div class="d-flex align-items-center justify-content-between">
                          <h2 id="caregiverCount" class="text-success font-weight-bold">Loading...</h2>
                          <i class="mdi mdi-account-outline mdi-18px text-dark"></i>
                      </div>
                  </div>
                  <canvas id="newClient"></canvas>
                  <div class="line-chart-row-title">MY CAREGIVER</div>
              </div>
          </div>
          <div class="col-lg-2 grid-margin stretch-card">
            <div class="card">
                <div class="card-body pb-0">
                    <div class="d-flex align-items-center justify-content-between">
                        <h2 id="morningSessionCount" class="text-danger font-weight-bold">Loading...</h2>
                        <i class="mdi mdi-refresh mdi-18px text-dark"></i>
                    </div>
                </div>
                <canvas id="allProducts"></canvas>
                <div class="line-chart-row-title">Morning Session</div>
            </div>
        </div>
        <div class="col-lg-2 grid-margin stretch-card">
            <div class="card">
                <div class="card-body pb-0">
                    <div class="d-flex align-items-center justify-content-between">
                        <h2 id="afternoonSessionCount" class="text-info font-weight-bold">Loading...</h2>
                        <i class="mdi mdi-file-document-outline mdi-18px text-dark"></i>
                    </div>
                </div>
                <canvas id="invoices"></canvas>
                <div class="line-chart-row-title">Afternoon Session</div>
            </div>
        </div>
        <div class="col-lg-2 grid-margin stretch-card">
            <div class="card">
                <div class="card-body pb-0">
                    <div class="d-flex align-items-center justify-content-between">
                        <h2 id="fullDaySessionCount" class="text-warning font-weight-bold">Loading...</h2>
                        <i class="mdi mdi-folder-outline mdi-18px text-dark"></i>
                    </div>
                </div>
                <canvas id="projects"></canvas>
                <div class="line-chart-row-title">Full Day Session</div>
            </div>
        </div>
					<div class="row">
						<div class="col-sm-6 grid-margin grid-margin-md-0 stretch-card">
							<div class="card">
								<div class="card-body">
									<div class="d-flex align-items-center justify-content-between">
										<h4 class="card-title">Support Tracker</h4>
										<h4 class="text-success font-weight-bold">Tickets<span class="text-dark ms-3">163</span></h4>
									</div>
									<div id="support-tracker-legend" class="support-tracker-legend"></div>
									<canvas id="supportTracker"></canvas>
								</div>
							</div>
						</div>
						<div class="col-sm-6 grid-margin grid-margin-md-0 stretch-card">
							<div class="card">
								<div class="card-body">
									<div class="d-lg-flex align-items-center justify-content-between mb-4">
										<h4 class="card-title">Product Orders</h4>
										<p class="text-dark">+5.2% vs last 7 days</p>
									</div>
									<div class="product-order-wrap padding-reduced">
										<div id="productorder-gage" class="gauge productorder-gage"></div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<!-- content-wrapper ends -->
				<!-- partial:partials/_footer.html -->
				<footer class="footer">
          <div class="footer-wrap">
            <div class="d-sm-flex justify-content-center justify-content-sm-between">
              <span class="text-muted text-center text-sm-left d-block d-sm-inline-block">Copyright © <a href="https://www.bootstrapdash.com/" target="_blank">bootstrapdash.com </a>2021</span>
              <span class="float-none float-sm-right d-block mt-1 mt-sm-0 text-center">Only the best <a href="https://www.bootstrapdash.com/" target="_blank"> Bootstrap dashboard </a> templates</span>
            </div>
          </div>
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
    <!-- End plugin js for this page -->
    <script src="vendors/chart.js/Chart.min.js"></script>
    <script src="vendors/progressbar.js/progressbar.min.js"></script>
		<script src="vendors/chartjs-plugin-datalabels/chartjs-plugin-datalabels.js"></script>
		<script src="vendors/justgage/raphael-2.1.4.min.js"></script>
		<script src="vendors/justgage/justgage.js"></script>
    <script src="js/jquery.cookie.js" type="text/javascript"></script>
    <!-- Custom js for this page-->
    <script src="js/dashboard.js"></script>
    <!-- End custom js for this page-->

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const token = sessionStorage.getItem('token');

            function fetchCaregiverCount() {
                fetch('/api/caregiver-count', {
                    method: 'GET',
                    headers: {
                        'Authorization': 'Bearer ' + token
                    }
                })
                .then(response => response.json())
                .then(data => {
                    document.getElementById('caregiverCount').textContent = data.totalCaregivers;
                })
                .catch(error => {
                    console.error('Error fetching caregiver count:', error);
                    document.getElementById('caregiverCount').textContent = 'Error';
                });
            }

            fetchCaregiverCount();
        });
    </script>

    <script>
        $(document).ready(function(){
          const token = sessionStorage.getItem('token');

            // Retrieve the caregiver ID from the data attribute
            var caregiverId = $('#profileDropdown').data('caregiver-id');
            
            // Log the caregiver ID to console for debugging
            console.log("Caregiver ID:", caregiverId);

            $.ajax({
                url: '/api/get-caregiverUsername/' + caregiverId,
                method: 'GET',
                dataType: 'json', // Specify the expected data type of the response
                headers: {
                    'Authorization': 'Bearer ' + token // Include the token in the request headers
                },
                success: function(data) {
                    if(data.caregiverUsername) {
                      console.log("Caregiver data.caregiverUsername:", data.caregiverUsername);

                        $('.nav-profile-name').text(data.caregiverUsername);
                    }
                },
                error: function(error) {
                    console.log('Error:', error);
                }
            });

        });
    </script>
    <script>
    document.addEventListener('DOMContentLoaded', function() {
        const token = sessionStorage.getItem('token');

        function fetchChildCounts() {
            fetch('/api/childgroup-count', {
                method: 'GET',
                headers: {
                    'Authorization': 'Bearer ' + token
                }
            })
            .then(response => response.json())
            .then(data => {
                document.getElementById('morningSessionCount').textContent = data.morningSessionCounts;
                document.getElementById('afternoonSessionCount').textContent = data.afternoonSessionCounts;
                document.getElementById('fullDaySessionCount').textContent = data.fullDaySessionCounts;
            })
            .catch(error => {
                console.error('Error fetching group counts:', error);
                document.getElementById('morningSessionCount').textContent = 'Error';
                document.getElementById('afternoonSessionCount').textContent = 'Error';
                document.getElementById('fullDaySessionCount').textContent = 'Error';
            }); 
        }

        fetchChildCounts();
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