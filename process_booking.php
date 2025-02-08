<?php
include 'db.php'; 

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = mysqli_real_escape_string($con, $_POST['name']);
    $phone = mysqli_real_escape_string($con, $_POST['phone']);
    $email = mysqli_real_escape_string($con, $_POST['email']);
    $gender = mysqli_real_escape_string($con, $_POST['gender']);

    
    $sql = "INSERT INTO passengers (name, phone, email, gender) VALUES ('$name', '$phone', '$email', '$gender')";

    if (mysqli_query($con, $sql)) {
        
        $passenger_id = mysqli_insert_id($con);

     
        header("Location: seats.php?passenger_id=" . $passenger_id);
        exit();
    } else {
        header("Location: passform.php?message=Error: " . mysqli_error($con));
        exit();
    }
}

mysqli_close($con);
?>
