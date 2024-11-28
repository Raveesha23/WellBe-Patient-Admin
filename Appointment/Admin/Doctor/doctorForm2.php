<?php
session_start(); // Start the session

// Debugging: Print $_POST data
// echo "<h3>POST Data:</h3><pre>";
// print_r($_POST);
// echo "</pre>";


// Collect and store form1 data in session
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Collect and store form1 data in session
    $_SESSION['nic'] = $_POST['nic'] ?? '';
    $_SESSION['first_name'] = $_POST['first_name'] ?? '';
    $_SESSION['last_name'] = $_POST['last_name'] ?? '';
    $_SESSION['dob'] = $_POST['dob'] ?? '';
    $_SESSION['gender'] = $_POST['gender'] ?? '';
    $_SESSION['address'] = $_POST['address'] ?? '';
    $_SESSION['email'] = $_POST['email'] ?? '';
    $_SESSION['contact'] = $_POST['contact'] ?? '';
    $_SESSION['emergency_contact'] = $_POST['emergency_contact'] ?? '';
    $_SESSION['emergency_contact_relationship'] = $_POST['emergency_contact_relationship'] ?? '';
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Administrative Staff Dashboard</title>
    <link rel="stylesheet" href="doctorStyles.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
</head>
<body>
    <div class="dashboard-container">
        <!-- Sidebar -->
        <div class="sidebar">
            <div class="sidebar-logo">
                <img src = "../images/logo.png">
                <h2>WELLBE</h2>
            </div>
            <ul class="sidebar-menu">
                <li>
                    <a href="../Dashboard/index.html">
                        <i class="fas fa-tachometer-alt"></i>
                        <span class="menu-text">Dashboard</span>
                    </a> 
                </li>
                <li>
                    <a href="../Appointments/index.html">
                        <i class="fas fa-calendar-alt"></i>
                        <span class="menu-text">Appointments</span>
                    </a>
                </li>
                <li>
                    <a href="../Patient/index.html">
                        <i class="fas fa-user"></i>
                        <span class="menu-text">Patients</span>
                    </a>
                </li>
                <li class="active">
                    <i class="fas fa-user-md"></i><span class="menu-text">Doctors</span>
                </li>
                <li>
                    <a href="../Pharmacists/index.html">
                        <i class="fas fa-pills"></i>
                        <span class="menu-text">Pharmacists</span>
                    </a>
                </li>
                <li>
                    <a href="../LabTechs/index.html">
                        <i class="fas fa-vials"></i>
                        <span class="menu-text">Lab Technicians</span>
                    </a>
                </li>
                <li>
                    <a href="#">
                        <i class="fas fa-comment-dots"></i>
                        <span class="menu-text">Chat</span>
                    </a>
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
                <div class="header-left">
                    <h1>Create Doctor Profile</h1>
                </div>
                <div class="header-right">
                    <div class="notification">
                        <img src="../images/notification.png">
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
            <!--Content Container-->
            <div class="content-container">
                <div class="form-tabs">
                    <span class="tab active">Doctor Profile Details</span>
                </div>
                <div class="form-container">
                    
                    <form class="patient-form" action="connect.php" method="POST">
                        <span class="form-title">Professional Information</span>
                        <div class="form-row">
                            <label for="medical history">Medical License Number:</label>
                            <input type="text" id="medical_license" name="medical_license" required>
                        </div>
                        
                        <div class="form-row">
                            <label for="specializtion">Specialization/ Field of Expertise:</label>
                            <input type="text" id="specialization" name="specialization" required>
                        </div>
                        
                        <div class="form-row">
                            <label for="experience">Years of Experience:</label>
                            <input type="text" id="experience" name="experience" required>
                        </div>
                        
                        <div class="form-row">
                            <label for="qualifications">Qualifications and Certifications:</label>
                            <input type="text" id="qualifications" name="qualifications" required>
                        </div>

                        <div class="form-row">
                            <label for="university">Medical School/ University Attended:</label>
                            <input type="text" id="medical_school" name="medical_school" required>
                        </div>
                        
                        <div class="buttons-bar">
                            <!-- <button type="submit" class="prev-button">
                                <a href="doctorForm1.html">Previous</a>
                            </button> -->
                            <button type="submit" class="submit-button">Submit</button>
                        </div>
                    </form>
                </div>    
            </div>        
        </div>
    </div>

    <script>
        function validateForm(form) {

            //validate years of experience to be an integer
            const experience = form.experience.value;
            if (!/^\d+$/.test(experience)) {
                alert("Invalid years of experience.");
                return false;
            }

            return true;  // Form is valid
        }
    </script>

</body>
</html>
