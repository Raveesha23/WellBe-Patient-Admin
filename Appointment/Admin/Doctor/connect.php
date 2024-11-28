<?php
session_start(); // Start the session

// // Debugging: Print $_SESSION data
// echo "<h3>Session Data:</h3><pre>";
// print_r($_SESSION);
// echo "</pre>";

// Retrieve data from session with validation
$nic = $_SESSION['nic'] ?? '';
$first_name = $_SESSION['first_name'] ?? '';
$last_name = $_SESSION['last_name'] ?? '';
$dob = $_SESSION['dob'] ?? '';
$gender = $_SESSION['gender'] ?? '';
$address = $_SESSION['address'] ?? '';
$email = $_SESSION['email'] ?? '';
$contact = $_SESSION['contact'] ?? '';
$emergency_contact = $_SESSION['emergency_contact'] ?? '';
$emergency_contact_relationship = $_SESSION['emergency_contact_relationship'] ?? '';

// // Debugging: Print $_POST data
// echo "<h3>POST Data:</h3><pre>";
// print_r($_POST);
// echo "</pre>";

// Retrieve data from form
$medical_license = $_POST['medical_license'] ?? '';
$specialization = $_POST['specialization'] ?? '';
$experience = $_POST['experience'] ?? '';
$qualifications = $_POST['qualifications'] ?? '';
$medical_school = $_POST['medical_school'] ?? '';

// Calculate age
$age = 0;
if (!empty($dob)) {
    $dobDate = new DateTime($dob);
    $currentDate = new DateTime();
    $age = $dobDate->diff($currentDate)->y;
}

// Enable error reporting for debugging
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Database connection
$conn = new mysqli('localhost', 'root', '', 'wellbe_db');

// Check connection
if ($conn->connect_error) {
	echo json_encode(['success' => false, 'error' => 'Database connection failed: ' . $conn->connect_error]);
	exit;
}

// Prepare SQL statement
$stmt = $conn->prepare("
    INSERT INTO `doctor`
    (`id`, `nic`, `first_name`, `last_name`, `dob`, `age`, `gender`, `address`, `email`, `contact`, `emergency_contact`, `emergency_contact_relationship`, `medical_license_no`, `specialization`, `experience`, `qualifications`, `medical_school`)
    VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)
");

// Check if statement preparation was successful
if ($stmt === false) {
    die("Error preparing statement: " . $conn->error);
}

// Bind parameters (both `id` and `nic` use `$nic`)
$stmt->bind_param(
    "sssssisssssssssss",
    $nic,             // id
    $nic,             // nic
    $first_name,      // first_name
    $last_name,       // last_name
    $dob,             // dob
    $age,             // age
    $gender,          // gender
    $address,         // address
    $email,           // email
    $contact,         // contact
    $emergency_contact, // emergency_contact
    $emergency_contact_relationship, // emergency_contact_relationship
    $medical_license, // medical_license_no
    $specialization,  // specialization
    $experience,      // experience
    $qualifications,  // qualifications
    $medical_school   // medical_school
);

// Execute statement
if ($stmt->execute()) {
    echo "<script>
        alert('Doctor Profile Created Successfully!');
        window.location.href = 'index.html'; 
    </script>";
} else {
    echo "<script>
        alert('Error: " . $stmt->error . "');
        window.location.href = 'doctorForm1.html'; 
    </script>";
}


// Close resources
$stmt->close();
$conn->close();
?>
