<?php
session_start();
include 'db.php'; 

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['uname'];
    $password = md5($_POST['pw']); 

    $sql = "SELECT * FROM admins WHERE username='$username' AND password='$password'";
    $result = mysqli_query($con, $sql);

    if (mysqli_num_rows($result) == 1) {
        $_SESSION['admin'] = $username;
        header("Location: panel.php"); 
        exit();
    } else {
        $error = "Invalid username or password!";
    }
}
?>

<!DOCTYPE html>

<html lang="en" xmlns="http://www.w3.org/1999/xhtml">

<head>
    <meta charset="utf-8" />
    <title>Admin</title>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css /">
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

    <div class="admin">
        <div class="title1"> ADMIN LOGIN </div>
        <form method="POST" action="">
            <div class="user-details">
                <div class="input-box">
                    <span class="details">Username </span>
                    <input type="text" name="uname" placeholder="Enter your username" required>
                </div>
                <div class="input-box">
                    <span class="details"> Password </span>
                    <input type="password" name="pw" placeholder="Enter your password" required>
                </div>
            </div>
            <div class="button">
                <input type="submit" value="Login">
            </div>
            <div class="forgot">
                <input type="checkbox" checked="checked"> Remember me
                <button type="button" class="cancelbtn"> Cancel</button>
            </div>
        </form>
        <?php if (isset($error)) echo "<p style='color:red;'>$error</p>"; ?>
    </div>






    <!--footer-->
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
                <a href="https://www.facebook.com/share/xQKGjTeKrxaehRS4/?mibextid=kFxxJD">
                    <i class="fa fa-facebook"
                       aria-hidden="true"></i>
                </a>
                <a href="#"><i class="fa fa-instagram" aria-hidden="true"></i></a>

            </div>

        </div>




    </footer>
    <div class="footer-para-end">
        <p class="footer-para-middle">

            <center>
                -Experience the wonders of the travel with Dolphin Tours. Discover seamless travel solutions for your
                next adventure.
                Book your bus journey today and embark on unforgettable experiences. Dive into comfort, reliability, and
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

        body {
            justify-content: center;
            align-items: center;
            height: 100vh;
            width: 100%;
            background: rgb(211, 245, 207);
            background: linear-gradient(90deg, rgba(211, 245, 207, 1) 0%, rgba(168, 219, 250, 1) 50%, rgba(99, 94, 226, 1) 100%);
        }

        .admin {
            max-width: 700px;
            width: 100%;
            background-color: #fff;
            padding: 25px 30px;
            border-radius: 5px;
            display: flex;
            flex-wrap: wrap;
            margin-left: 270px;
            margin-bottom: 30px;
        }

            .admin .title1 {
                font-size: 25px;
                font-weight: 500;
                position: relative;
                margin-left: 75px;
            }

                .admin .title1::before {
                    content: '';
                    position: absolute;
                    left: 0;
                    bottom: 0;
                    height: 3px;
                    width: 30px;
                    background: linear-gradient(135deg, #71b7e6, #9b59b6);
                }

            .admin form .user-details {
                display: flex;
                flex-wrap: nowrap;
                margin-top:30px;
                margin-left: 80px;
            }

                .admin form .user-details .input-box {
                    margin-bottom: 15px;
                    width: calc(100% / 2 - 20px);
                }

        .user-details .input-box .details {
            display: block;
            font-weight: 500;
            margin-bottom: 5px;
        }

        .admin form .user-details .input-box input {
            height: 45px;
            width: 100%;
            outline: none;
            border-radius: 5px;
            border: 1px solid #ccc;
            padding-left: 15px;
            font-size: 16px;
            border-bottom-width: 2px;
            transition: all 0.3s ease;
        }

        .user-details .input-box input:focus,
        .user-details .input-box input:valid {
            border-color: #9b59b6;
        }

        form input[type="radio"] {
            display: none;
        }

        form .button input {
            height: 50px;
            width: 100%;
            outline: none;
            color: #fff;
            border: none;
            font-size: 18px;
            font-weight: 500;
            border-radius: 5px;
            letter-spacing: 1px;
            background: linear-gradient(135deg, #71b7e6, #9b59b6);
        }

            form .button input:hover {
                background: linear-gradient(-135deg, #71b7e6, #9b59b6);
            }

        .forgot {
            padding-right: 25px;
        }

        .cancelbtn {
            width: auto;
        }


        @media (max-width:584px) {
            .admin {
                max-width: 100%;
            }

                .admin form .user-details .input-box {
                    margin-bottom: 15px;
                    width: 100%;
                }

                .admin form .user-details {
                    max-height: 300px;
                    overflow-y: scroll;
                }

            .user-details::-webkit-scrollbar {
                width: 0;
            }
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

