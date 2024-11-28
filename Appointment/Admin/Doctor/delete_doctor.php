<?php

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // Check if the ID is provided
        if (isset($_GET['id'])) {
            $doctorId = $_GET['id'];

            // Connect to the database
            $conn = new mysqli('localhost', 'root', '', 'wellbe_db');

            if ($conn->connect_error) {
                echo json_encode(['success' => false, 'error' => 'Database connection failed: ' . $conn->connect_error]);
                exit;
            }

            $query = "DELETE FROM doctor WHERE id = ?";
            $stmt = $conn->prepare($query);
            $stmt->bind_param("i", $doctorId);

            if ($stmt->execute()) {
                echo json_encode(['success' => true]);
            } else {
                echo json_encode(['success' => false, 'error' => $conn->error]);
            }

            $stmt->close();
        } 
        else {
            echo json_encode(['success' => false, 'error' => 'Doctor ID missing']);
        }

    } 
    else {
        echo json_encode(['success' => false, 'error' => 'Invalid request method']);
    }
    
?>
