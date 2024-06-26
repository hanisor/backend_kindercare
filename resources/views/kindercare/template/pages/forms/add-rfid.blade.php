<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>RFID</title>
  <link rel="stylesheet" href="vendors/mdi/css/materialdesignicons.min.css">
  <link rel="stylesheet" href="vendors/base/vendor.bundle.base.css">
  <link rel="stylesheet" href="vendors/select2/select2.min.css">
  <link rel="stylesheet" href="vendors/select2-bootstrap-theme/select2-bootstrap.min.css">
  <link rel="stylesheet" href="css/style.css">
  <link rel="shortcut icon" href="images/favicon.png" />
</head>

<body>
  <div class="container-scroller">
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
              <a class="navbar-brand brand-logo" href="/caregiver-homepage">
                <img src="images/4.png" alt="logo" width="300" height="300"/>
              </a>
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
    <div class="container-fluid page-body-wrapper">
      <div class="main-panel">
        <div class="content-wrapper">
          <div class="row justify-content-center">
            <div class="row justify-content-center">
              <div class="col-md-5">
                <div id="successMessage" class="alert alert-success d-none" role="alert">
                  RFID number successfully registered!
                </div>
              </div>
            </div>  
            <div class="col-md-5 grid-margin grid-margin-md-0 stretch-card">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">Add Rfid</h4>
                  <div class="form-group row">
                    <label class="col-sm-4 col-form-label">Add RFID Number</label>
                    <div class="col-sm-6">
                      <div id="the-basics">
                        <input id="rfidNumber" class="rfid form-control" type="text" placeholder="RFID number" readonly>
                      </div>
                    </div>
                    <div class="mb-4"></div>
                    <div class="form-group row">
                      <div class="col-sm-16">
                        <button type="submit" class="btn btn-primary" onclick="addRfid()">Add RFID</button>
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
  </div>
</div>

<footer class="footer">
  <div class="footer-wrap">
    <div class="d-sm-flex justify-content-center justify-content-sm-between">
      <div style="flex: 1; min-width: 200px; margin: 10px;">
        <h4 style="color: #343a40; font-size: 18px; margin-bottom: 10px;">Contact Us</h4>
        <p style="color: #6c757d; font-size: 14px;">
          123 KinderCare Street<br>
          Happy Town, HT 12345<br>
          Phone: (123) 456-7890<br>
          Email: <a href="mailto:info@kindercare.com" style="color: #6c757d; text-decoration: none;">info@kindercare.com</a>
        </p>
      </div>
    </div>
    <div style="margin-top: 20px; color: #6c757d; font-size: 14px;">
      &copy; 2024 KinderCare. All rights reserved.
    </div>
  </div>
</footer>

<script>
  const rfidInput = document.getElementById('rfidNumber');
  const successMessage = document.getElementById('successMessage');
  const errorMessage = document.getElementById('errorMessage');

  async function fetchRFID() {
    try {
      const response = await fetch('/rfid/latest');
      const data = await response.json();
      if (data.rfid) {
        rfidInput.value = data.rfid;
        errorMessage.classList.add('d-none');
      } else {
        throw new Error('RFID data is empty');
      }
    } catch (error) {
      console.error('Error fetching RFID:', error);
      errorMessage.classList.remove('d-none');
    }
  }

  async function addRfid() {
    const rfidNumber = rfidInput.value;
    if (rfidNumber) {
      try {
        const response = await fetch('/api/add-rfid', {
          method: 'POST',
          headers: {
            'Content-Type': 'application/json',
            'Authorization': 'Bearer ' + sessionStorage.getItem('token')
          },
          body: JSON.stringify({ number: rfidNumber })
        });
        const data = await response.json();
        if (data.rfid) {
          successMessage.classList.remove('d-none');
          setTimeout(() => {
            successMessage.classList.add('d-none');
          }, 3000);
        }
      } catch (error) {
        console.error('Error adding RFID:', error);
      }
    }
  }

  setInterval(fetchRFID, 2000); // Poll every 2 seconds
</script>
</body>
</html>
