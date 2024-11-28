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
    <title>Patient Medical Records</title>
    <link rel="stylesheet" href="./medicalreports.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
</head>
<body>

    <div class="dashboard-container">
    <!-- Sidebar -->
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
                                    <th>Medi_Rep_Id</th>
                                    <th>Date</th>
                                    <th>Time</th>
                                    <th>Doctor's Name</th>
                                    <th>Specialization</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td onclick="window.location.href='Medication_Details'">Medi_Rec_001 </td>
                                    <td>12/08/2024</td>
                                    <td>7:00 - 10:00</td>
                                    <td>Dr. K. G. Gunawardana</td>
                                    <td>Cardiologist</td>
                                </tr>
                                <tr>
                                    <td>Medi_Rec_001</td>
                                    <td>12/08/2024</td>
                                    <td>7:00 - 10:00</td>
                                    <td>Dr. K. G. Gunawardana</td>
                                    <td>Eye Surgeon</td>
                                </tr>
                                <tr>
                                    <td>Medi_Rec_001</td>
                                    <td>12/08/2024</td>
                                    <td>7:00 - 10:00</td>
                                    <td>Dr. K. G. Gunawardana</td>
                                    <td>Dermetologist</td>
                                </tr>
                                <tr>
                                    <td>Medi_Rec_001</td>
                                    <td>12/08/2024</td>
                                    <td>7:00 - 10:00</td>
                                    <td>Dr. K. G. Gunawardana</td>
                                    <td>General</td>
                                </tr>
                                <tr>
                                    <td>Medi_Rec_001</td>
                                    <td>12/08/2024</td>
                                    <td>7:00 - 10:00</td>
                                    <td>Dr. K. G. Gunawardana</td>
                                    <td>General</td>
                                </tr>
                                <tr>
                                    <td>Medi_Rec_001</td>
                                    <td>12/08/2024</td>
                                    <td>7:00 - 10:00</td>
                                    <td>Dr. K. G. Gunawardana</td>
                                    <td>Gneral</td>
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
</body>
</html>
