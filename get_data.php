<?php
// Include database connection
include("dbconnection.php");

$doctor = isset($_POST['doctor']) ? $_POST['doctor'] : null;

// Fetch available time slots for the selected doctor for the next 2 weeks
if ($doctor) {
   $query = "
        SELECT ts.date
        FROM slot ts
        INNER JOIN doctor d ON ts.doctor_id = d.doctor_id
        WHERE d.first_name = ? AND ts.date BETWEEN NOW() AND DATE_ADD(NOW(), INTERVAL 14 DAY)
        ORDER BY ts.date
    ";
   $stmt = $con->prepare($query);
   $stmt->bind_param("s", $doctor);
   $stmt->execute();
   $result = $stmt->get_result();

   $timeSlots = [];
   while ($row = $result->fetch_assoc()) {
      // Format the datetime value for better readability
      $dateTime = new DateTime($row['date']);
      $formattedDate = $dateTime->format('Y-m-d');
      $formattedTime = $dateTime->format('h:i A'); // 12-hour format with AM/PM
      $timeSlots[] = [
         'date' => $formattedDate,
         'time' => $formattedTime
      ];
   }

   // Return time slots as JSON
   echo json_encode($timeSlots);
   exit;
}
