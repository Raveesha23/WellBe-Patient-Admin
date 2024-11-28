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

// Fetch doctor data
try {
    $stmt = $pdo->query("SELECT id, CONCAT(first_name, ' ', last_name) AS name, TIMESTAMPDIFF(YEAR, dob, CURDATE()) AS age, specialization, contact FROM doctor");
    $doctors = $stmt->fetchAll(PDO::FETCH_ASSOC);
    echo json_encode($doctors);
} catch (Exception $e) {
    echo json_encode(["error" => "Failed to fetch data: " . $e->getMessage()]);
}
?>
