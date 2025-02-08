<?php
include 'db.php';


$from = mysqli_real_escape_string($con, $_POST['from']);
$to = mysqli_real_escape_string($con, $_POST['to']);
$date = mysqli_real_escape_string($con, $_POST['date']);

$query = "SELECT * FROM buses WHERE departure='$from' AND arrival='$to' AND DATE(date)='$date'";

$stmt = mysqli_prepare($con, $query);

mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);


?>




<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bookings</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css">
</head>
<body class="body">

    <header class="header">
        <div class="logo">
            <img src="Images\dt logo.png" width="150" height="100">
        </div>
        <nav>
            <ul>
                <li><a href="form.html">New Booking</a></li>
                
                <li><a href="home.html">Logout</a></li>
            </ul>
        </nav>
    </header>

    <main> 
    <div class="booking-table">
        <div class="title"> ARRIVAL & DEPARTURE TIME </div>
        <form action="seats.php" method="POST">
            <table border="1">
                <thead>
                    <tr>
                        <th>Date</th>
                        <th>Departure</th>
                        <th>Dep. Time</th>
                        <th>Arrival</th>
                        <th>Arrival Time</th>
                        <th>Seats</th>
                        <th>Fare</th>
                        <th>Select</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        echo "<tr>
                <td>{$row['date']}</td>
                <td>{$row['departure']}</td>
                <td>{$row['departure_time']}</td>
                <td>{$row['arrival']}</td>
                <td>{$row['arrival_time']}</td>
                <td>{$row['seats_available']}</td>
                <td>Rs. {$row['fare']}</td>
                <td class='radio-cell'>
                <input type='radio' name='bus_id' value='{$row['id']}' required>
                </td>   
            </tr>";
    }
} else {
    echo "<tr><td colspan='8' style='color:red; text-align:center;'>No buses available for the selected route and date.</td></tr>";
}

?>
                </tbody>
            </table>
            <button type="submit">Book now</button>
        </form>
    </div>
</main>

    


    <footer>
        <div class="footer-col">
            <h4>Quick Links </h4>
            <ul>
                <li><a href="home.html"> Home </a></li>
                <li><a href="about.html"> About us </a></li>

                <li><a href="contact.php"> Contact </a></li>
                <li><a href="admin.php"> Admin </a></li>
            </ul>
        </div>
        <div class="footer-col">
            <h4>Contact us</h4>
            <ul>
                <li>ekanayakeanurab@gmail.com</li>
                <li>+94 77 704 3458</li>
                <li>No.1/6 Kanangamuwa,Matale,<br />Sri Lanka</li>
            </ul>
        </div>



        <div class="footer-col">
            <h4> Book your seat now </h4>
            <a href="main.php">

                <button> Click here</button>

            </a>



        </div>


        <div class="footer-col">
            <h4> Follow us </h4>
            <div class="links">
                <a href="#"><i class="fa fa-whatsapp" aria-hidden="true"></i></a>
                <a href="https://www.facebook.com/share/xQKGjTeKrxaehRS4/?mibextid=kFxxJD"><i class="fa fa-facebook" aria-hidden="true"></i></a>
                <a href="#"><i class="fa fa-instagram" aria-hidden="true"></i></a>

            </div>

        </div>



        </footer>
   
    <div class="footer-para-end">
        <p class="footer-para-middle">

            <center>
                -Experience the wonders of the travel with Dolphin Tours. Discover seamless travel solutions for your next adventure.
                Book your bus journey today and embark on unforgettable experiences. Dive into comfort, reliability, and convenience with Dolphin Tours-
            </center>
        </p>
    </div>
        
    <style>

        * {
            margin: 0;
            padding-right: 10px;
            padding-bottom: 10px;
            padding-left: 10px;
            box-sizing: border-box;
            font-family: "Poppins", sans-serif;
        }
        .body {
            height: 100vh;
            width: 100%;
            background: rgb(211,245,207);
            background: linear-gradient(90deg, rgba(211,245,207,1) 0%, rgba(168,219,250,1) 50%, rgba(99,94,226,1) 100%);
        }

        header {
            display: flex;
            justify-content: flex-end;
            align-items: center;
            padding: 30px 10px;
        }


        a {
            text-decoration: none;
        }

        nav {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 30px 100px;
        }

        .logo {
            width: 100px;
            height: 50px;
            position: absolute;
            top: 20px;
            left: 20px;
        }

        nav ul li {
            list-style: none;
            display: inline-block;
            padding: 10px 20px;
        }

            nav ul li a {
                color: #000000;
                position: relative;
                padding: 5px 0;
            }

                nav ul li a:hover {
                    color: darkblue;
                }

                nav ul li a:after {
                    content: "";
                    position: absolute;
                    left: 0;
                    width: 0;
                    height: 3px;
                    background: darkblue;
                    transition: 0.3s;
                    bottom: 0;
                }

                nav ul li a:hover:after {
                    width: 100%;
                }




        main {
            padding: 20px;
        }

        form {
            display: flex;
            flex-wrap: wrap;
        }
        .booking-table {
            max-width: 900px;
            width: 100%;
            background-color: #fff;
            padding: 25px 30px;
            border-radius: 5px;
            display: flex;
            flex-wrap: wrap;
            margin-left: 150px;
            margin-bottom: 30px;
        }
            .booking-table .title {
                font-size: 25px;
                font-weight: 500;
                position: relative;
                margin-left: 230px;
                margin-top: 20px;
                margin-bottom: 35px;
            }

        label,
        input,
        button {
            margin: 5px;
        }

        button {
            cursor: pointer;
        }

        #results {
            margin-top: 20px;
        }

        table {
            border-collapse: collapse;
            width: 100%;
        }

        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: center;
        }

        th {
            background-color: #92a1cf;
        }

        .navy-button {
            background-color: #001f3f; /* Navy blue color */
            color: #fff;
            border: none;
            border-radius: 4px;
            font-size: 16px;
            cursor: pointer;
            transition: background-color 0.3s ease;
            margin-left: 20px;
            margin-top:35px;
            margin-right:5px;
width:auto;
        }

            .navy-button:hover {
                background-color: #003366; /* Darker shade of navy blue on hover */
            }

        h2 {
            text-align: center;
        }

        .form-group {
            margin-right: 120px;
            margin-bottom: 15px;
        }

        label {
            display: block;
            margin-bottom: 5px;
        }
        .radio-cell {
    text-align: center;
    vertical-align: middle;
    width: 80px; /* Adjust width if needed */
}

.radio-cell input {
    transform: scale(1.3); /* Makes the radio button slightly bigger */
    cursor: pointer;
}
        input[type="text"],
        input[type="email"],
        input[type="tel"],
        button {
            width: 100%;
            padding: 10px;
            font-size: 16px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
        }

        button {
            background-color: #001f3f;
            color: #fff;
            border: none;
            cursor: pointer;
        }

            button:hover {
                background-color: #0056b3;
            }

        .center-form {
            display: block;
            width: 50%; /* Adjust the width as needed */
            margin: auto;
        }

            .center-form .form-group {
                margin-bottom: 10px; /* Adjust spacing between form elements */
            }







        /*footer*/


        body {
            width: 100%;
            background-image: url(Web-Page-Background-Color.jpg);
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            color: rgb(10, 9, 9);
        }

        footer {
            display: inline-flex;
            margin-top: auto;
            background-color: rgb(18, 10, 100);
            padding-top: 60px;
            padding-bottom: 20px;
            width: 100%;
        }

        .footer-col ul {
            list-style: none;
            color: #bdb6b6;
        }

        .footer-col {
            width: 25%;
            margin-right: 30px;
            margin-left: 30px;
            padding-left: 30px;
        }

            .footer-col h4 {
                position: relative;
                margin-bottom: 30px;
                font-weight: 400;
                font-size: 22px;
                color: #f1bc0d;
                text-transform: capitalize;
            }

                .footer-col h4::before {
                    content: '';
                    position: absolute;
                    left: 0;
                    bottom: -6px;
                    background-color: #27c0ac;
                    height: 2px;
                    width: 40px;
                }

            .footer-col ul li:not(:last-child) {
                margin-bottom: 8px;
            }

            .footer-col ul li a {
                display: block;
                font-size: 19px;
                text-transform: capitalize;
                color: #bdb6b6;
                text-decoration: none;
                transition: 0.4s;
            }

                .footer-col ul li a:hover {
                    color: white;
                    padding-left: 2px;
                }

        .links a {
            display: inline-block;
            height: 44px;
            width: 44px;
            color: white;
            background-color: rgba(99, 10, 182, 0.8);
            margin: 0 8px 8px 0;
            text-align: center;
            line-height: 44px;
            border-radius: 50%;
            transition: 0.4s;
            padding: 0;
        }

            .links a:hover {
                color: #4d4f55;
                background-color: white;
            }

        .footer-para-end {
            background: transparent;
            padding: 40px 10%;
            width: 100%;
        }

        .footer-para-middle {
            color: rgb(187, 195, 251);
        }

        center {
            color: #000000;
        }

        button {
            display: inline-block;
            padding: 12px 24px;
            color: #fff;
            background: linear-gradient(135deg,#71b7e6,#9b59b6);
            border: none;
            cursor: pointer;
            transition: 0.3s ease;
        }

            button:hover {
                background: linear-gradient(-135deg,#71b7e6,#9b59b6);
            }
    </style>
    
   
    </body>
</html>
