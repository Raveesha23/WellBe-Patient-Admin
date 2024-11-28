<?php
session_start();

require 'dbconnection.php';

if (!isset($_GET['nic']) || empty($_GET['nic'])) {
    die("Invalid access");
}

$nic = htmlspecialchars($_GET['nic']);

if (!isset($_GET['nic']) || empty($_GET['nic'])) {
    die("Invalid NIC provided");
}

$nic = htmlspecialchars($_GET['nic']); // Sanitize input

// Prepare and execute the query
$stmt = $con->prepare("SELECT * FROM patient WHERE nic = ?");
$stmt->bind_param("s", $nic); // Bind NIC as a string
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $patient = $result->fetch_assoc(); // Fetch patient data
} else {
    die("No patient found with NIC: " . htmlspecialchars($nic));
}

// Close resources
$stmt->close();
$con->close();

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Patient Medication Details</title>
    <link rel="stylesheet" href="./medical_rec.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
</head>

<body>
    <div class="dashboard-container">
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
            <i class="fas fa-notes-medical"></i>
            <span class="menu-text">View Medical Reports</span>
          </a>
        </li>
        <li>
        <a href="labreports.php?nic=<?= urlencode($nic) ?>">
            <i class="fas fa-flask"></i>
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
            <i class="fas fa-calendar-alt"></i>
            <span class="menu-text">Appointments</span>
          </a>

        </li>
        <li>
        <a href="chat.php?nic=<?= urlencode($nic) ?>">
            <i class="fas fa-comments"></i>
            <span class="menu-text">Chat with Doctor</span>
          </a>
        </li>
        
        <li>
          <i class="fas fa-sign-out-alt"></i><span class="menu-text" onclick="window.location.href='logout.php'">Logout</span>
        </li>
      </ul>
    </div>

        <!-- Main Content -->
        <div class="main-content">
            <!-- Top Header -->
            <header class="main-header">
                <div class="header-left">
                    <h1>Dashboard</h1>
                </div>
                <div class="header-right">
                    <div class="notification-icon">
                        <i class="fas fa-bell"></i>
                        <span class="notification-badge"></span>
                    </div>
                    <div class="user-details">
                        <div class="user-info">
                            <p class="name"><?= htmlspecialchars($patient['first_name']) ?>
                                <?= htmlspecialchars($patient['last_name']) ?>
                            </p>
                            <p class="role">Patient</p>
                        </div>
                    </div>
                </div>
            </header>

            <!-- Dashboard Content -->
            <div class="dashboard-content">
                <label for="dr-name">Doctor's Name:</label>
                <p>Dr. John</p>
                <label for="date">Date:</label>
                <p>24/5/2024</p>
                <label for="diagnosis">Diagnosis:</label>
                <p>Gastritis</p>
                <h2>MEDICINES NEED TO BE GIVEN:</h2>
                <!-- Medication Table -->
                <table class="medication-table">
                    <thead>
                        <tr>
                            <th>Name of the Medication</th>
                            <th>Dosage of the Medication</th>
                            <th colspan="4">Number taken at a time</th>
                            <th>Do not substitute</th>
                        </tr>
                        <tr>
                            <th></th>
                            <th></th>
                            <th>Morning</th>
                            <th>Noon</th>
                            <th>Night</th>
                            <th>If Needed</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>Medicine 1</td>
                            <td>2 mg</td>
                            <td>1</td>
                            <td>2</td>
                            <td>2</td>
                            <td>2</td>
                            <td><input type="checkbox" disabled checked></td>
                        </tr>
                        <tr>
                            <td>Medicine 1</td>
                            <td>2 mg</td>
                            <td>1</td>
                            <td>2</td>
                            <td>2</td>
                            <td>2</td>
                            <td><input type="checkbox" disabled checked></td>
                        </tr>
                        <tr>
                            <td>Medicine 1</td>
                            <td>2 mg</td>
                            <td>1</td>
                            <td>2</td>
                            <td>2</td>
                            <td>2</td>
                            <td><input type="checkbox" disabled></td>
                        </tr>
                        <tr>
                            <td>Medicine 1</td>
                            <td>2 mg</td>
                            <td>1</td>
                            <td>2</td>
                            <td>2</td>
                            <td>2</td>
                            <td><input type="checkbox" disabled checked></td>
                        </tr>
                    </tbody>
                </table>

                <!-- Lab Tests Table -->
                <table>
                    <thead>
                        <tr>
                            <th>Name of the Test</th>
                            <th>Priority Level</th>
                            <th>Report</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>FBC</td>
                            <td>High</td>
                            <td><button class="view" onclick="window.location.href='Lab_download.php?nic=<?= urlencode($nic) ?>'"
                                    >View</button></td>
                        </tr>
                        <tr>
                            <td>FBC</td>
                            <td>Medium</td>
                            <td><button class="view" onclick="window.location.href='Lab_download.php?nic=<?= urlencode($nic) ?>'"
                                    >View</button></td>
                        </tr>
                        <tr>
                            <td>FBC</td>
                            <td>Low</td>
                            <td><button class="pending" >Pending</button></td>
                        </tr>
                    </tbody>
                </table>

                <!-- Remarks Section -->
                <div class="remarks-section">
                    <h3>Remarks</h3>
                    <textarea id="additionalRemarks" readonly>
    Please continue the medicine for 7 days, if you do not see a change please consult again
  </textarea>
                </div>



            </div>
        </div>

    </div>


    </div>
</body>

</html>