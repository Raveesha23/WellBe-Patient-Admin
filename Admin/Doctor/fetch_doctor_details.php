<?php
// Database connection
$host = 'localhost';
$dbname = 'wellbe_db';
$username = 'root';
$password = '';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Database connection failed: " . $e->getMessage());
}

// Fetch doctor details by ID
if (isset($_GET['id'])) {
    $doctorId = $_GET['id'];
    try {
        $stmt = $pdo->prepare("SELECT * FROM doctor WHERE id = :id");
        $stmt->bindParam(':id', $doctorId, PDO::PARAM_INT);
        $stmt->execute();
        $doctor = $stmt->fetch(PDO::FETCH_ASSOC);
        echo json_encode($doctor);
    } catch (Exception $e) {
        echo json_encode(["error" => "Failed to fetch doctor details: " . $e->getMessage()]);
    }
} else {
    echo json_encode(["error" => "Doctor ID is missing"]);
}
?>
