<?php
include 'db.php';
session_start(); 


$bus_id = isset($_GET['bus_id']) ? $_GET['bus_id'] : 1;


$sql_bus = "SELECT fare FROM buses WHERE id = $bus_id";
$result_bus = mysqli_query($con, $sql_bus);
$row_bus = mysqli_fetch_assoc($result_bus);
$fare = $row_bus['fare']; 


$sql = "SELECT * FROM seats WHERE bus_id = $bus_id";
$result = mysqli_query($con, $sql);

$seats = [];
while ($row = mysqli_fetch_assoc($result)) {
    $seats[$row['seat_number']] = $row['status'];
}

mysqli_close($con);
?>
<!DOCTYPE html>

<html lang="en" xmlns="http://www.w3.org/1999/xhtml">

<head>
    <meta charset="utf-8" />
    <title>Seat Booking </title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css" />
    
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const seats = document.querySelectorAll('.seat');
            const nextButton = document.getElementById('nextButton');
            let fare = <?php echo $fare; ?>; // Fetch fare from PHP

            seats.forEach(seat => {
                seat.addEventListener('click', () => {
                    if (seat.classList.contains('available')) {
                        seat.classList.remove('available');
                        seat.classList.add('selected');
                    } else if (seat.classList.contains('selected')) {
                        seat.classList.remove('selected');
                        seat.classList.add('available');
                    }
                });
            });

            nextButton.addEventListener('click', () => {
                const selectedSeats = document.querySelectorAll('.seat.selected');
                const seatNumbers = Array.from(selectedSeats).map(seat => seat.getAttribute('data-seat'));

                if (seatNumbers.length === 0) {
                    alert("Please select at least one seat!");
                    return;
                }

                const totalFare = seatNumbers.length * fare;

                // Send data to confirm_booking.php via POST
                const form = document.createElement('form');
                form.method = 'POST';
                form.action = 'confirm_booking.php';

                const seatInput = document.createElement('input');
                seatInput.type = 'hidden';
                seatInput.name = 'seats';
                seatInput.value = seatNumbers.join(',');

                const fareInput = document.createElement('input');
                fareInput.type = 'hidden';
                fareInput.name = 'total_fare';
                fareInput.value = totalFare;

                const busInput = document.createElement('input');
                busInput.type = 'hidden';
                busInput.name = 'bus_id';
                busInput.value = <?php echo $bus_id; ?>;

                form.appendChild(seatInput);
                form.appendChild(fareInput);
                form.appendChild(busInput);
                document.body.appendChild(form);
                form.submit();
            });
        });
    </script>
     
</head>

<body class="body">

   
<header class="header">
        <div class="logo">
            <img src="Images/dt logo.png" width="150" height="100">
        </div>
        <nav>
            <ul>
                <li><a href="form.php">New Booking</a></li>
                
                <li><a href="index.html">Logout</a></li>
            </ul>
        </nav>
    </header>
    <div class="tickets">
        <div class="ticket-selector">
            <div class="head">
                <div class="title">CHOOSE YOUR SEAT</div>
            </div>
            <div class="seats">
                <div class="status">
                    <div class="item available">Available</div>
                    <div class="item booked">Booked</div>
                    <div class="item selected">Selected</div>
                </div>
                <div class="all-seat">
                    <table>
                        <?php
                        $rows = ['A', 'B', 'C', 'D', 'E', 'F', 'G', 'H'];
                        for ($i = 1; $i <= 4; $i++) {
                            echo "<tr>";
                            foreach ($rows as $row) {
                                $seatNumber = $row . $i;
                                $status = isset($seats[$seatNumber]) ? $seats[$seatNumber] : 'available';
                                echo "<td>
                                        <div class='seat $status' data-seat='$seatNumber'>$seatNumber</div>
                                      </td>";
                            }
                            echo "</tr>";
                        }
                        ?>
                    </table>
                </div>
            </div>
        </div>

        <button id="next"> Next </button>
    </div>




    <footer>
        <div class="footer-col">
            <h4>Quick Links </h4>
            <ul>
                <li><a href="index.html"> Home </a></li>
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
                <a href="https://www.facebook.com/share/xQKGjTeKrxaehRS4/?mibextid=kFxxJD">
                    <i class="fa fa-facebook" aria-hidden="true"></i>
                </a>
                <a href="#"><i class="fa fa-instagram" aria-hidden="true"></i></a>

            </div>

        </div>

    </footer>



    <div class="footer-para-end">
        <p class="footer-para-middle">

            <center>
                -Experience the wonders of the travel with Dolphin Tours. Discover seamless travel solutions for
                your
                next adventure.
                Book your bus journey today and embark on unforgettable experiences. Dive into comfort, reliability,
                and
                convenience with Dolphin Tours-
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
            background: rgb(211, 245, 207);
            background: linear-gradient(90deg, rgba(211, 245, 207, 1) 0%, rgba(168, 219, 250, 1) 50%, rgba(99, 94, 226, 1) 100%);
        }

        .header {
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

        #bookSeats {
            height: 50px;
            width: 200px;
            outline: none;
            color: #fff;
            border: none;
            font-size: 18px;
            font-weight: 500;
            border-radius: 5px;
            letter-spacing: 1px;
            background: linear-gradient(135deg, #71b7e6, #9b59b6);
            margin-bottom: 30px;
            margin-left: 135px;
            margin-top: 40px;
        }

        .tickets {
            width: 540px;
            /* Adjust the width to match .ticket-selector */
            height: fit-content;
            background-color: #fff;
            padding: 10px;
            border-radius: 5px;
            display: flex;
            flex-wrap: wrap;
            margin-bottom: 30px;
            box-shadow: 0px 25px 50px -12px rgb(37, 37, 37);
            color: white;
            margin-left: 360px;
            /* Align to the left */
        }

        .ticket-selector {
            background: rgb(20, 20, 20);
            border-radius: 5px;
            overflow: hidden;
            box-shadow: 0px 25px 50px -12px rgb(37, 37, 37);
            color: white;
            width: 100%;
            /* Make it take the full width of its container */
            text-align: center;
        }

        .head {
            background: rgb(37, 37, 37);
            padding: 10px;
            text-align: center;
            margin-top: 10px;
        }

        .title {
            text-align: center;
            font-size: 20px;
            padding: 10px;
        }

        .seats {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-top: 10px;
        }

        .status {
            width: 250px;
            margin-right: 20px;
        }

        .item {
            display: flex;
            align-items: center;
            justify-content: center;
            width: 100px;
            height: 30px;
            padding: 10px;
            margin-top: 5px;
            border-radius: 15px;
        }

        .item.available {
            background: #FDDA0D;
            color: black;
        }

        .item.booked {
            margin-top: 20px;
            background: red;
            color: white;
        }

        .item.selected {
            margin-top: 20px;
            background: green;
            color: white;
        }

        .all-seat {
            width: 100%;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-direction: column;
        }

        .row {
            width: 100%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-left: 700px;
        }

        .seat {
            width: 30px;
            height: 30px;
            padding: 10px;
            font-size: 12px;
            border-radius: 4px;
            margin: 5px;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
        }

        .seat.available {
            background: #FDDA0D;
            color: #000000;
        }

        .seat.booked {
            background: red;
        }

        .seat.selected {
            background: green;
        }

        #next {
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
            display: block;
            margin: auto;
           
            margin-top: 20px;
        }

        #next:hover {
            background: linear-gradient(-135deg, #71b7e6, #9b59b6);
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
            background: linear-gradient(135deg, #71b7e6, #9b59b6);
            border: none;
            cursor: pointer;
            transition: 0.3s ease;
        }

        button:hover {
            background: linear-gradient(-135deg, #71b7e6, #9b59b6);
        }
    </style>

</body>

</html>
