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
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Patient Dashboard</title>
  <link rel="stylesheet" href="./patient_dashboard.css?v=<?= time() ?>" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" />
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
        <li class="<?= basename($_SERVER['PHP_SELF']) == 'patient_dashboard.php' ? 'active' : '' ?>">
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
          <i class="fas fa-sign-out-alt"></i><span class="menu-text"
            onclick="window.location.href='logout.php'">Logout</span>
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
      <div class="container">
        <div class="dashboard">
          <div class="profile-card">
            <div class="image">
              <?php if ($patient['gender'] == 'M'): ?>
                <img src="./male_pro.png" alt="Profile Picture" class="profile-img" />
              <?php else: ?>
                <img src="./female_pro.png" alt="Profile Picture" class="profile-img1" />
              <?php endif; ?>

            </div>
            <div class="text-data">
              <span class="name"><?= htmlspecialchars($patient['first_name']) ?>
                <?= htmlspecialchars($patient['last_name']) ?></span>

              <span class="job"><strong>Patient_id:</strong> <?= htmlspecialchars($patient['nic']) ?></span>
            </div>
            <br>
            <div class="profile-details">
              <p><strong>Gender:</strong> <?= htmlspecialchars($patient['gender']) ?></p>
              <p><strong>Contact:</strong> <?= htmlspecialchars($patient['contact']) ?></p>
              <p><strong>Emergency Contact:</strong> <?= htmlspecialchars($patient['emergency_contact_no']) ?></p>
              <p><strong>Email:</strong> <?= htmlspecialchars($patient['email']) ?></p>
              <p><strong>Address:</strong> <?= htmlspecialchars($patient['address']) ?></p>
              <br>
              <div class="medical-info">
                <p><strong>Medical History:</strong> <?= htmlspecialchars($patient['medical_history']) ?></p>
                <p><strong>Allergies:</strong> <?= htmlspecialchars($patient['allergies']) ?></p>
              </div>
            </div>
            <div class="buttons">
              <button class="button"
                onclick="window.location.href='chat.php?nic=<?= urlencode($nic) ?>'">Message</button>
              <button class="button" onclick="window.location.href='edit_profile.php?nic=<?= urlencode($nic) ?>'">Edit
                Profile</button>

            </div>

          </div>

          <div class="right">

            <div class="cards-container">
              <div class="card med-rep">
                <div class="circle-background">
                  <i class="fas fa-user icon"></i>
                </div>

                <div class="label" onclick="window.location.href='medicalreports.php?nic=<?= urlencode($nic) ?>'">View
                  Medical Reports</div>

              </div>

              <div class="card lab-rep">
                <div class="circle-background">
                  <i class="fas fa-user icon"></i>
                </div>

                <div class="label" onclick="window.location.href='labreports.php?nic=<?= urlencode($nic) ?>'">View Lab
                  Reports</div>

              </div>

              <div class="card app">
                <div class="circle-background">
                  <i class="fas fa-flask icon"></i>
                </div>
                <div class="label" onclick="window.location.href='doc_appointment.php?nic=<?= urlencode($nic) ?>'">Book
                  an Appointment</div>

              </div>
            </div>


            <div class="calendar-wrapper">
              <div class="calendar-container">
                <h3>BMI Calculator</h3>
                <form id="bmiForm" class="bmi-form">
                  <label for="height">Height (cm):</label>
                  <input type="number" id="height" placeholder="Enter height in cm" required />

                  <label for="weight">Weight (kg):</label>
                  <input type="number" id="weight" placeholder="Enter weight in kg" required />

                  <button type="submit" class="submit-btn">Calculate BMI</button>
                  <button type="button" id="refreshBtn" class="refresh-btn">Refresh</button>
                </form>
                <div id="bmiResult" class="bmi-result hidden">
                  <p><strong>BMI:</strong> <span id="bmiValue"></span></p>
                  <p id="bmiCategory"></p>
                </div>
              </div>

              <div class="additional-container">
                <h3>Upcoming Appointments</h3>
                <div class="mini-wrapper">
                  <div class="mini">
                    <div class="mini-part part1">
                      <h4>Dr. Upul Priyarathne</h4>
                    </div>
                    <div class="mini-part part2">
                      <span>Date: <span>24/11/2024</span></span>
                    </div>
                    <div class="mini-part part3">
                      <span>Appointment No: <span>25</span></span>
                    </div>
                  </div>

                  <div class="mini">
                    <div class="mini-part part1">
                      <h4>Dr. Saman Rathnayake</h4>
                    </div>
                    <div class="mini-part part2">
                      <span>Date: <span>24/11/2024</span></span>
                    </div>
                    <div class="mini-part part3">
                      <span>Appointment No: <span>25</span></span>
                    </div>
                  </div>
                  <div class="mini">
                    <div class="mini-part part1">
                      <h4>Dr. Jaya Swaminadan</h4>
                    </div>
                    <div class="mini-part part2">
                      <span>Date: <span>24/11/2024</span></span>
                    </div>
                    <div class="mini-part part3">
                      <span>Appointment No: <span>25</span></span>
                    </div>
                  </div>
                </div>
              </div>

            </div>

          </div>



        </div>
      </div>

      <div id="popupModal2" class="modal hidden">
        <div class="modal-content">
          <div class="modal-header">
            <h2>Thank You!</h2>
          </div>
          <div class="modal-body">
            <p>Your Payment has been made successfully. Thanks!</p>
          </div>
          <div class="modal-footer">
            <button id="closeModal2" class="submit-btn">OK</button>
          </div>
        </div>
      </div>


      <script src="./script.js"></script>
      <script>
        // Function to parse query parameters
        function getQueryParam(param) {
          const urlParams = new URLSearchParams(window.location.search);
          const value = urlParams.get(param);
          console.log(`Query Parameter "${param}" Value:`, value); // Debugging output
          return value;
        }
        // Check if "payment" parameter is "success"
        document.addEventListener("DOMContentLoaded", () => {
          const paymentStatus = getQueryParam("payment"); // Get payment status
          console.log("Payment Status:", paymentStatus); // Debugging

          if (paymentStatus === "success") {
            const modal = document.getElementById("popupModal2");
            console.log("Displaying Modal"); // Debugging
            modal.classList.remove("hidden"); // Show the modal

            document.getElementById("closeModal2").addEventListener("click", () => {
              modal.classList.add("hidden"); // Hide the modal on button click
            });
          }
        });

      </script>

      <script>
        document.addEventListener("DOMContentLoaded", () => {
          const bmiForm = document.getElementById("bmiForm");
          const bmiResult = document.getElementById("bmiResult");
          const bmiValue = document.getElementById("bmiValue");
          const bmiCategory = document.getElementById("bmiCategory");

          bmiForm.addEventListener("submit", (e) => {
            e.preventDefault();

            const height = parseFloat(document.getElementById("height").value);
            const weight = parseFloat(document.getElementById("weight").value);

            if (height > 0 && weight > 0) {
              const bmi = (weight / ((height / 100) ** 2)).toFixed(2);
              bmiValue.textContent = bmi;

              // Determine BMI category
              let category = "";
              if (bmi < 18.5) {
                category = "Underweight";
              } else if (bmi >= 18.5 && bmi < 24.9) {
                category = "Normal weight";
              } else if (bmi >= 25 && bmi < 29.9) {
                category = "Overweight";
              } else {
                category = "Obese";
              }

              bmiCategory.textContent = `Category: ${category}`;
              bmiResult.classList.remove("hidden");
            } else {
              alert("Please enter valid height and weight values.");
            }
          });

          refreshBtn.addEventListener("click", () => {
            document.getElementById("height").value = "";
            document.getElementById("weight").value = "";
            bmiResult.classList.add("hidden"); // Hide the results
          });

        });

      </script>

</body>

</html>