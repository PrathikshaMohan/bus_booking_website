 <?php
session_start();
include("db.php");

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $username = $_POST['unm'];
    $gmail = $_POST['mail'];
    $message = $_POST['msg'];

    if (!empty($gmail) && !empty($username) && filter_var($gmail, FILTER_VALIDATE_EMAIL)) {
       
        $stmt = $con->prepare("INSERT INTO form (unm, mail, msg) VALUES (?, ?, ?)");
        $stmt->bind_param("sss", $username, $gmail, $message);

        if ($stmt->execute()) {
            
            echo "
<script type='text/javascript'>
    alert('Successfully submitted');
    window.location.href = 'home.html';
</script>";
        } else {
            
            echo "
<script type='text/javascript'>alert('Database error: Unable to submit');</script>";
        }
        $stmt->close();
    } else {
        echo "
<script type='text/javascript'>alert('Please enter valid details');</script>";
    }
}
?>

<!DOCTYPE html>

<html lang="en" xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8" />
    <title>Contact</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css /">
</head>
<body class="body">
    <header class="header">
        <div class="logo">
            <img src="Images\dt logo.png" logo.png" width="150" height="100">
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
    <div class="cntct">
        <div class="container">
            <div class="content">
                <div class="left-side">
                    <div class="address details">
                        <i class="fa fa-map" aria-hidden="true"></i>
                        <div class="topic">Address</div>
                        <div class="text-one">No.1/6 Kanangamuwa,Matale</div>
                        <div class="text-two">Sri Lanka</div>
                    </div>
                    <div class="phone details">
                        <i class="fa fa-phone" aria-hidden="true"></i>
                        <div class="topic">Phone</div>
                        <div class="text-one">+94 77 704 3458</div>

                    </div>
                    <div class="email details">
                        <i class="fa fa-envelope" aria-hidden="true"></i>
                        <div class="topic">Email</div>
                        <div class="text-one">ekanayakeanurab@gmail.com</div>

                    </div>
                </div>
                <div class="right-side">
                    <div class="topic-text">Send us a message</div>
                    <p>If you have any work from me or any types of quries related to my tutorial, you can send me message from here. It's my pleasure to help you.</p>
                    <form method="POST">
                        <div class="input-box">
                            <input type="text" name="unm" placeholder="Enter your name">
                        </div>
                        <div class="input-box">
                            <input type="text" name="mail" placeholder="Enter your email">
                        </div>
                        <div class="input-box message-box">
                            <input type="text" name="msg" placeholder="Your message">


                        </div>
                        <div class="submit-btn">
                            <input type="button" value="Send Now">
                        </div>
                    </form>
                </div>
            </div>
        </div>
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
        /*header*/
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

        .cntct {
            width: 100%;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .container {
            width: 80%;
            background-color: #fff;
            border-radius: 6px;
            padding: 40px 60px 30px 40px;
            box-shadow: 0 5px 10px rgba(0, 0, 0, 0.2);
            margin-bottom: 50px;
        }

            .container .content {
                display: flex;
                align-items: center;
                justify-content: space-between;
            }

                .container .content .left-side {
                    width: 25%;
                    height: 100%;
                    display: flex;
                    flex-direction: column;
                    align-items: center;
                    justify-content: center;
                    margin-top: 15px;
                    position: relative;
                }

        .content .left-side::before {
            content: '';
            position: absolute;
            height: 70%;
            width: 2px;
            right: -15px;
            top: 50%;
            transform: translateY(-50%);
            background: #202020;
        }

        .content .left-side .details {
            margin: 14px;
            text-align: center;
        }

            .content .left-side .details i {
                font-size: 30px;
                color: #3e2093;
                margin-bottom: 10px;
            }

            .content .left-side .details .topic {
                font-size: 18px;
                font-weight: 500;
            }

            .content .left-side .details .text-one,
            .content .left-side .details .text-two {
                font-size: 14px;
                color: #606060;
            }

        .container .content .right-side {
            width: 75%;
            margin-left: 75px;
        }

        .content .right-side .topic-text {
            font-size: 23px;
            font-weight: 600;
            color: #3e2093;
        }

        .right-side .input-box {
            height: 50px;
            width: 100%;
            margin: 12px 0;
        }

            .right-side .input-box input,
            .right-side .input-box textarea {
                height: 100%;
                width: 100%;
                border: none;
                outline: none;
                font-size: 16px;
                background: lightgray;
                border-radius: 6px;
                padding: 0 15px;
                resize: none;
            }

        .right-side .message-box {
            min-height: 110px;
        }

        .right-side .input-box textarea {
            padding-top: 6px;
        }

        .right-side .submit-btn {
            display: inline-block;
            margin-top: 12px;
        }

            .right-side .submit-btn input[type="button"] {
                color: #fff;
                font-size: 18px;
                outline: none;
                border: none;
                padding: 8px 16px;
                cursor: pointer;
                transition: all 0.3s ease;
                font-size: 18px;
                font-weight: 500;
                border-radius: 5px;
                letter-spacing: 1px;
                background: linear-gradient(135deg, #71b7e6, #9b59b6);
            }

        .submit-btn input[type="button"]:hover {
            background: linear-gradient(-135deg, #71b7e6, #9b59b6);
        }

        @media (max-width: 950px) {
            .container {
                width: 90%;
                padding: 30px 40px 40px 35px;
            }

                .container .content .right-side {
                    width: 75%;
                    margin-left: 55px;
                }
        }

        @media (max-width: 820px) {
            .container {
                margin: 40px 0;
                height: 100%;
            }

                .container .content {
                    flex-direction: column-reverse;
                }

                    .container .content .left-side {
                        width: 100%;
                        flex-direction: row;
                        margin-top: 40px;
                        justify-content: center;
                        flex-wrap: wrap;
                    }

                        .container .content .left-side::before {
                            display: none;
                        }

                    .container .content .right-side {
                        width: 100%;
                        margin-left: 0;
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
            background-color: transparent;
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

