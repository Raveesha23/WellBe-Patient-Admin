<?php
// Start the session
session_start();

if (!isset($_GET['nic']) || empty($_GET['nic'])) {
    die("Access denied: NIC is missing in the URL");
}

$nic = htmlspecialchars($_GET['nic']); // Retrieve and sanitize NIC


?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Patient Lab Reports</title>
    <link rel="stylesheet" href="./labreports.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <style>
        .status-dropdown {
            border: 1px solid #ccc;
            border-radius: 5px;
            padding: 5px;
            background-color: #fff;
            font-size: 14px;
            color: #444;
            width: 100%;
        }
        .view-button {
            background-color: #118015;
            color: white;
            border: none;
            padding: 5px 10px;
            border-radius: 5px;
            cursor: pointer;
        }
        .view-button:hover {
            background-color: #1b6d15;
        }
    </style>
</head>
<body>
    <div class="dashboard-container">

    <!-- Sidebar -->
    <div class="sidebar">
      <div class="sidebar-logo">
        <img src=" logo.png">
        <h2>WELLBE</h2>
      </div>
      <ul class="sidebar-menu">
        <li class="active">
          <a href="patient_dashboard.php?nic=<?= urlencode($nic) ?>">
            <i class="fas fa-tachometer-alt"></i>
            <span class="menu-text">Dashboard</span>
          </a>
        </li>
        <li>
        <a href="medicalreports.php?nic=<?= urlencode($nic) ?>">
            <i class="fas fa-tachometer-alt"></i>
            <span class="menu-text">View Medical Reports</span>
          </a>
        </li>
        <li>
        <a href="labreports.php?nic=<?= urlencode($nic) ?>">
            <i class="fas fa-tachometer-alt"></i>
            <span class="menu-text">View Lab Reports</span>
          </a>
        </li>
        <li>
          <a href="doc_appointment.php?nic=<?= urlencode($nic) ?>">
            <i class="fas fa-user-md"></i>
            <span class="menu-text">Search for a Doctor</span>
          </a>

        </li>
        <li>
        <a href="appointments.php?nic=<?= urlencode($nic) ?>">
            <i class="fas fa-user-md"></i>
            <span class="menu-text">Appointments</span>
          </a>

        </li>
        <li>
        <a href="chat.php?nic=<?= urlencode($nic) ?>">
            <i class="fas fa-user-md"></i>
            <span class="menu-text">Chat with Doctor</span>
          </a>
        </li>
        <li>
          <i class="fas fa-cogs"></i><span class="menu-text">Settings</span>
        </li>
        <li>
          <i class="fas fa-sign-out-alt"></i><span class="menu-text">Logout</span>
        </li>
      </ul>
    </div>

    <!-- Main Content -->
    <div class="main-content">
      <!-- Top Header -->
      <header class="main-header">
        <div class="header-left"></div>
        <div class="header-right">
          <div class="notification">
            <img src="..\assests\notification.png">
          </div>
          <div class="user-details">
            <div class="user-avatar">
              <!-- User Avatar Icon -->
            </div>
            <div class="user-info">
              <p class="name">K.S.Perera</p>
              <p class="role">Administrative Staff</p>
            </div>
          </div>
        </div>
      </header>

            <!-- Dashboard Content -->
            <div class="dashboard-content">
                <div class="welcome-message">
                    <p>Welcome Mr. K.S.Perera</p>
                </div >
                <div class="container">
                   
                    <div class="search-date">
                        <input type="text" placeholder="Search by Date">
                        <p>10 August, 2024</p> 
                    </div>
                    <div class="table-container">
                        <table>
                            <thead>
                                <tr>
                                    <th>Report_Id</th>
                                    <th>Date</th>
                                    <th>Time</th>
                                    <th>Doctor's Name</th>
                                    <th>Test Name</th>
                                    <th>Status of Action</th>
                                    <th>Report</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td onclick="window.location.href='Lab_download'">Lab_Rep_001</td>
                                    <td>12/08/2024</td>
                                    <td>7:00 - 10:00</td>
                                    <td>Dr. K. G. Gunawardana</td>
                                    <td>FBC</td>
                                    <td><select class="status-dropdown">
                                        <option value="pending" selected>Pending</option>
                                        <option value="in-progress">In-Progress</option>
                                        <option value="completed">Completed</option>
                                    </select></td>
                                    <td class="report-cell"></td>
                                </tr>
                                <tr>
                                    <td>Lab_Rep_001</td>
                                    <td>12/08/2024</td>
                                    <td>7:00 - 10:00</td>
                                    <td>Dr. K. G. Gunawardana</td>
                                    <td>FBC</td>
                                    <td><select class="status-dropdown">
                                        <option value="pending" selected>Pending</option>
                                        <option value="in-progress">In-Progress</option>
                                        <option value="completed">Completed</option>
                                    </select></td>
                                    <td class="report-cell"></td>
                                </tr>
                                <tr>
                                    <td>Lab_Rep_001</td>
                                    <td>12/08/2024</td>
                                    <td>7:00 - 10:00</td>
                                    <td>Dr. K. G. Gunawardana</td>
                                    <td>ESR</td>
                                    <td><select class="status-dropdown">
                                        <option value="pending" selected>Pending</option>
                                        <option value="in-progress">In-Progress</option>
                                        <option value="completed">Completed</option>
                                    </select></td>
                                    <td class="report-cell"></td>
                                </tr>
                                <!-- More rows here -->
                            </tbody>
                        </table>
                    </div>
                    <div class="pagination">
                        <span>Previous</span>
                        <div class="pages">
                            <a href="#">1</a>
                            <a href="#">2</a>
                            <a href="#">3</a>
                            <a href="#">4</a>
                        </div>
                        <span>Next</span>
                    </div>
                    
                </div>     
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            function updateReportCells() {
                const rows = document.querySelectorAll('tbody tr');

                rows.forEach(row => {
                    const statusSelect = row.querySelector('.status-dropdown');
                    const reportCell = row.querySelector('.report-cell');

                    statusSelect.addEventListener('change', function() {
                        const status = this.value;
                        if (status === 'completed') {
                            reportCell.innerHTML = '<button class="view-button">View</button>';
                        } else {
                            reportCell.innerHTML = '';
                        }
                    });

                    statusSelect.dispatchEvent(new Event('change'));
                });
            }

            updateReportCells();
        });
    </script>
</body>
</html>
