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
    <title>Schedule Appointment</title>
    <link rel="stylesheet" href="./doc_appointment.css">
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
                    <i class="fas fa-sign-out-alt"></i><span class="menu-text" onclick="window.location.href='logout.php'">Logout</span>
                </li>
            </ul>
        </div>

        <!-- Main Content -->
        <div class="main-content">
            <!-- Top Header -->
            <header class="main-header">
                <div class="header-left">
                    <h1>Book an Appointment</h1>
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

            <?php
            include("dbconnection.php");

            // Fetch all doctors and specializations
            $doctorQuery = "SELECT first_name FROM doctor";
            $specializationQuery = "SELECT DISTINCT specialization FROM doctor";
            $doctors = $con->query($doctorQuery);
            $specializations = $con->query($specializationQuery);

            ?>

            <!-- Dashboard Content -->
            <div class="dashboard-content">
                <div class="welcome-message">
                    
                </div>

                <div class="flex-container">
                    <div class="form-section">
                        <div class="header">
                            <p class="header-title">Search Your Doctor</p>
                        </div>
                        <form action="save_app.php?nic=<?= urlencode($nic); ?>" method="POST">
                            <div class="input-box">
                                <label for="doctor">Select Doctor</label>
                                <input list="doctors" id="doctor" name="doctor" placeholder="Type doctor name">
                                <datalist id="doctors">
                                    <?php while ($row = $doctors->fetch_assoc()) {
                                        echo "<option value='{$row['first_name']}'>";
                                    } ?>
                                </datalist>
                                <?php if (!empty($errors['doctor'])): ?>
                                    <p class="error"><?= $errors['doctor'] ?></p>
                                <?php endif; ?>
                            </div>
                            <div class="input-box">
                                <label for="specialization">Specialization</label>
                                <input list="specializations" id="specialization" name="specialization"
                                    placeholder="Type specialization">
                                <datalist id="specializations">
                                    <?php while ($row = $specializations->fetch_assoc()) {
                                        echo "<option value='{$row['specialization']}'>";
                                    } ?>
                                </datalist>
                                <?php if (!empty($errors['specialization'])): ?>
                                    <p class="error"><?= $errors['specialization'] ?></p>
                                <?php endif; ?>
                            </div>


                            <!-- Date Selection -->
                            <div class="input-box">
                                <label for="date">Select Date</label>
                                <input list="dates" id="date" name="date-input" placeholder="Select date" />
                                <datalist id="dates">
                                    <!-- The available dates and times will be populated dynamically -->
                                </datalist>
                                <?php if (!empty($errors['date'])): ?>
                                    <p class="error"><?= htmlspecialchars($errors['date']) ?></p>
                                <?php endif; ?>

                            </div>

                            <a href="#" class="services-link">What are the medical services we offer?</a>
                            <button class="find-doctor-btn"
                                onclick="window.location.href='hello.php?nic=<?= isset($nic) ? urlencode($nic) : ''; ?>'">
                                Book Appointment
                            </button>


                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- JavaScript for Dynamic Updates -->
    <script>
        const doctorInput = document.getElementById("doctor");
        const specializationInput = document.getElementById("specialization");
        const doctorList = document.getElementById("doctors");
        const specializationList = document.getElementById("specializations");

        document.getElementById("doctor").addEventListener("input", function () {
            const doctorName = this.value;

            if (doctorName) {
                fetch("get_data.php", {
                    method: "POST",
                    headers: {
                        "Content-Type": "application/x-www-form-urlencoded",
                    },
                    body: "doctor=" + encodeURIComponent(doctorName),
                })
                    .then((response) => response.json())
                    .then((timeSlots) => {
                        const dateList = document.getElementById("dates");
                        dateList.innerHTML = ""; // Clear existing options

                        timeSlots.forEach((slot) => {
                            dateList.innerHTML += `<option value="${slot.date}    ${slot.time}"></option>`;
                        });
                    })
                    .catch((error) => console.error("Error fetching time slots:", error));
            }
        });


        // Fetch and update specializations based on doctor
        doctorInput.addEventListener("input", () => {
            const doctor = doctorInput.value;
            if (doctor) {
                fetch("filter_data.php", {
                    method: "POST",
                    headers: {
                        "Content-Type": "application/x-www-form-urlencoded"
                    },
                    body: "doctor=" + encodeURIComponent(doctor),
                })
                    .then((response) => response.json())
                    .then((data) => {
                        specializationList.innerHTML = "";
                        data.forEach((spec) => {
                            specializationList.innerHTML += `<option value="${spec}">`;
                        });
                    });
            } else {
                location.reload(); // Refresh the page when cleared
            }
        });

        // Fetch and update doctors based on specialization
        specializationInput.addEventListener("input", () => {
            const specialization = specializationInput.value;
            if (specialization) {
                fetch("filter_data.php", {
                    method: "POST",
                    headers: {
                        "Content-Type": "application/x-www-form-urlencoded"
                    },
                    body: "specialization=" + encodeURIComponent(specialization),
                })
                    .then((response) => response.json())
                    .then((data) => {
                        doctorList.innerHTML = "";
                        data.forEach((doc) => {
                            doctorList.innerHTML += `<option value="${doc}">`;
                        });
                    });
            } else {
                location.reload(); // Refresh the page when cleared
            }
        });
    </script>
</body>

</html>