<?php
include 'db.php'; 

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    $date = $_POST["date"];
    $departure = $_POST["departure"];
    $departure_time = $_POST["departure_time"];
    
    $arrival = $_POST["arrival"];
    $arrival_time = $_POST["arrival_time"];
    $seats_available = $_POST["seats_available"];
    $fare = $_POST["fare"];
    $total_seats = $_POST["total_seats"];
    
    if (empty($date) || empty($departure) || empty($departure_time) || empty($arrival) || empty($arrival_time) || empty($seats_available) || empty($fare) || empty($total_seats) ) {
        echo "<script>alert('All fields are required!'); window.location.href='panel.php';</script>";
        exit();
    }

    
    $sql = "INSERT INTO buses (date, departure, departure_time, arrival, arrival_time, seats_available, fare, total_seats) 
            VALUES (?, ?, ?, ?, ?, ?, ?, ?)";

    $stmt = $con->prepare($sql);
    $stmt->bind_param("sssssiid", $date, $departure, $departure_time, $arrival, $arrival_time, $seats_available, $fare, $total_seats) ;

    if ($stmt->execute()) {
        echo "<script>alert('Route Assigned Successfully'); window.location.href='panel.php';</script>";
    } else {
        echo "Error: " . $stmt->error;
    }

   
    $stmt->close();
    $con->close();
}
?>


