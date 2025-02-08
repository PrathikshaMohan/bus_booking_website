<?php
include 'db.php';
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $user_id = $_SESSION['user_id']; 
    $seats = $_POST['seats'];
    $total_fare = $_POST['total_fare'];
    $bus_id = $_POST['bus_id'];

    
    $seatArray = explode(',', $seats);
    $seatCount = count($seatArray);

    foreach ($seatArray as $seat) {
        $sql = "INSERT INTO bookings (user_id, bus_id, seat_number, total_fare) 
                VALUES ('$user_id', '$bus_id', '$seat', '$total_fare')";
        mysqli_query($con, $sql);

        
        $updateSeat = "UPDATE seats SET status='booked' WHERE bus_id='$bus_id' AND seat_number='$seat'";
        mysqli_query($con, $updateSeat);
    }

    
    $updateBusSeats = "UPDATE buses SET seats_available = seats_available - $seatCount WHERE id='$bus_id'";
    mysqli_query($con, $updateBusSeats);

    mysqli_close($con);
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Confirm Booking</title>
</head>
<body class="body">

    <header class="header">
        <div class="logo">
            <img src="Images\dt logo.png" width="150" height="100">
        </div>

        <nav>
            <ul>
                <li><a href="home.html">Home</a></li>
                <li><a href="about.html">About</a></li>

                <li><a href="contact.php">Contact</a></li>
                <li><a href="admin.php">Admin</a></li>

            </ul>
        </nav>

    </header>

    <div class="container">
    <h2>Booking Confirmation</h2>
    <p><strong>Selected Seats:</strong> <?php echo htmlspecialchars($seats); ?></p>
    <p><strong>Total Fare:</strong> Rs.<?php echo htmlspecialchars($total_fare); ?></p>
    <button id="confirmButton" onclick="returnHome()">Confirm</button>
    <p id="loading" style="display: none;">Loading... Please wait.</p>
    </div>
    
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










        /*footer*/

        * {
            margin: 0;
            padding-right: 10px;
            padding-bottom: 10px;
            padding-left: 10px;
            box-sizing: border-box;
            font-family: "Poppins", sans-serif;
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
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f2f2f2;
        }

        .container {
            max-width: 600px;
            margin: 20px auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        .container h2{
            margin-left:10px;
        }
        #confirmButton {
            height: 50px;
            width: 190px;
            outline: none;
            color: #fff;
            border: none;
            font-size: 18px;
            font-weight: 500;
            border-radius: 5px;
            letter-spacing: 1px;
            background: linear-gradient(135deg, #71b7e6, #9b59b6);
            margin-bottom: 30px;
            margin-left: 15px;
            margin-top: 20px;
        }

        #confirmButton input:hover {
                background: linear-gradient(-135deg, #71b7e6, #9b59b6);
            } 
    </style>
</body>
</html>
