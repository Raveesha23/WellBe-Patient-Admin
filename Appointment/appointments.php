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
    <title>Appointment Details</title>
    <link rel="stylesheet" href="./appointments.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

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
                <div class="header">
                    <p>Appointments
                        <button class="btn" onclick="window.location.href='search_for_doctor'">Schedule an Appointment</button>
                        <span>
                            <button class="btn1">Reschedule/ Cancellation Policy</button>
                        </span>
                    </p>
                </div>
                <hr>  
                <div class="container">
                    <div class="card">
                        <p>Hi K.S.Perera,</p>
                        <p>you have an appointment<br>with</p>
                        <p class="doc_name">Dr. Narayanan (Cardiologist)<br><p>on</p></p>
                        <h1>25</h1>
                        <h2>Monday<br>September 2024</h2>
                        <div class="buttons">
                            <button class="accept">Details</button>
                            <button class="reschedule">Reschedule</button>
                            <button class="cancel" onclick="showModal()">Cancel</button>
                        </div>
                    </div>
                    <div class="card">
                        <p>Hi K.S.Perera,</p>
                        <p>you have an appointment<br>with</p>
                        <p class="doc_name">Dr. Narayanan (Cardiologist)<br><p>on</p></p>
                        <h1>25</h1>
                        <h2>Monday<br>September 2024</h2>
                        <div class="buttons">
                            <button class="accept">Details</button>
                            <button class="reschedule">Reschedule</button>
                            <button class="cancel" onclick="showModal()">Cancel</button>
                        </div>
                    </div>
                    <div class="card">
                        <p>Hi K.S.Perera,</p>
                        <p>you have an appointment<br>with</p>
                        <p class="doc_name">Dr. Narayanan (Cardiologist)<br><p>on</p></p>
                        <h1>25</h1>
                        <h2>Monday<br>September 2024</h2>
                        <div class="buttons">
                            <button class="accept">Details</button>
                            <button class="reschedule">Reschedule</button>
                            <button class="cancel" onclick="showModal()">Cancel</button>
                        </div>
                    </div>
                    <div class="card">
                        <p>Hi K.S.Perera,</p>
                        <p>you have an appointment<br>with</p>
                        <p class="doc_name">Dr. Narayanan (Cardiologist)<br><p>on</p></p>
                        <h1>25</h1>
                        <h2>Monday<br>September 2024</h2>
                        <div class="buttons">
                            <button class="accept">Details</button>
                            <button class="reschedule">Reschedule</button>
                            <button class="cancel" onclick="showModal()">Cancel</button>
                        </div>
                    </div>
                    

                    <!-- Additional appointment cards here -->

                </div>
            </div>
        </div>
    </div>

    <!-- Modal HTML -->
    <div id="cancelModal" class="modal">
        <div class="modal-content">
            <span class="close" onclick="closeModal()">&times;</span>
            <p>Are you sure you want to cancel this appointment?</p>
            <div class="modal-buttons">
                <button class="yes-btn" onclick="cancelAppointment()">Yes</button>
                <button class="no-btn" onclick="closeModal()">No</button>
            </div>
        </div>
    </div>

    <!-- JavaScript for Modal -->
    <script>
        // Function to show the modal
        function showModal() {
            document.getElementById("cancelModal").style.display = "block";
        }

        // Function to close the modal
        function closeModal() {
            document.getElementById("cancelModal").style.display = "none";
        }

        // Function to handle cancellation
        function cancelAppointment() {
            alert("Appointment Cancelled."); // Replace this with actual cancellation logic
            closeModal(); // Close the modal after the action is confirmed
        }

        // Close the modal if clicked outside of it
        window.onclick = function(event) {
            var modal = document.getElementById("cancelModal");
            if (event.target == modal) {
                closeModal();
            }
        }
    </script>
</body>
</html>
