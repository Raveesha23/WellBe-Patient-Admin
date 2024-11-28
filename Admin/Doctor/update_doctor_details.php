<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    header('Content-Type: application/json');

    $conn = new mysqli('localhost', 'root', '', 'wellbe_db');

    if ($conn->connect_error) {
        echo json_encode(['success' => false, 'error' => 'Database connection failed: ' . $conn->connect_error]);
        exit;
    }

    $doctor_id = $_GET['id'] ?? null;
    $rawInput = file_get_contents('php://input');
    $input = json_decode($rawInput, true);

    if (empty($input)) {
        parse_str($rawInput, $input); // Fallback
    }

    $age = 0;
    if (!empty($input['dob'])) {
        $dobDate = new DateTime($input['dob']);
        $currentDate = new DateTime();
        $age = $dobDate->diff($currentDate)->y;
    }

    if ($doctor_id && $input) {
        $query = "UPDATE doctor SET 
                    id = ?,
                    nic = ?, 
                    first_name = ?, 
                    last_name = ?, 
                    dob = ?,
                    age = ?, 
                    gender = ?, 
                    address = ?, 
                    email = ?, 
                    contact = ?, 
                    emergency_contact = ?, 
                    emergency_contact_relationship = ?, 
                    medical_license_no = ?, 
                    specialization = ?, 
                    experience = ?, 
                    qualifications = ?, 
                    medical_school = ? 
                  WHERE id = ?";

        $stmt = $conn->prepare($query);
        if (!$stmt) {
            echo json_encode(['success' => false, 'error' => 'Query preparation failed: ' . $conn->error]);
            exit;
        }

        $stmt->bind_param(
            'sssssisssssssssssi',
            $input['nic'],
            $input['nic'],
            $input['first_name'],
            $input['last_name'],
            $input['dob'],
            $age,
            $input['gender'],
            $input['address'],
            $input['email'],
            $input['contact'],
            $input['emergency_contact'],
            $input['emergency_contact_relationship'],
            $input['medical_license_no'],
            $input['specialization'],
            $input['experience'],
            $input['qualifications'],
            $input['medical_school'],
            $doctor_id
        );

    
        if ($stmt->execute()) {
            echo json_encode(['success' => true]);
        } else {
            echo json_encode(['success' => false, 'error' => 'Execution failed: ' . $stmt->error]);
        }
    } else {
        error_log("Doctor ID: " . $doctor_id);
        error_log("Input Data: " . json_encode($input));
        echo json_encode(['success' => false, 'error' => 'Invalid request data.']);
    }
}
?>
