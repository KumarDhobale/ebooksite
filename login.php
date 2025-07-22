<?php
error_reporting(E_ALL);
include('connection.php');

if (isset($_POST['Login'])) {
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);

    $sql = "SELECT * FROM signup WHERE email='$email' AND password='$password'";
    $rs = mysqli_query($conn, $sql);
    $cnt = mysqli_num_rows($rs);

    if ($cnt > 0) {
        echo "<script>alert('Login successfully'); window.location.assign('index.html');</script>";
    } else {
        echo "<script>alert('Email and password do not match');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login | Ebookstore</title>
    <link rel="icon" type="image/png" href="images/favicon.png">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@200;300;400;500;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Poppins', sans-serif;
        }

        body {
            overflow-x: hidden;
            background: radial-gradient(#fff, #ffd6d6);
        }

        /* Login Form */
        .login-page {
            padding: 50px 0;
        }

        .login-box {
            max-width: 600px;
            margin: auto;
            padding: 40px;
            background: #fff;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
            border-radius: 10px;
        }

        .title {
            text-align: center;
            color: #ff523b;
            font-size: 28px;
            font-weight: 600;
            margin-bottom: 20px;
        }

        .subtitle {
            text-align: center;
            color: #555;
            font-size: 16px;
            margin-bottom: 30px;
        }

        .form-group {
            margin-bottom: 20px;
            position: relative;
        }

        .form-group i {
            position: absolute;
            left: 10px;
            top: 50%;
            transform: translateY(-50%);
            color: #ff523b;
            font-size: 18px;
        }

        .input-field {
            width: 100%;
            padding: 10px 10px 10px 40px;
            border: none;
            border-bottom: 1px solid #ff523b;
            font-size: 14px;
            outline: none;
        }

        .input-field:focus {
            border-bottom-color: #563434;
        }

        .btn {
            display: block;
            width: 100%;
            padding: 12px;
            background: #ff523b;
            color: #fff;
            border: none;
            border-radius: 30px;
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
            transition: background 0.3s, transform 0.3s;
        }

        .btn:hover {
            background: #ff7a68;
            transform: scale(1.05);
        }

        .back-btn {
            display: inline-block;
            background: #ff523b;
            color: #fff;
            padding: 8px 20px;
            border-radius: 30px;
            position: absolute;
            top: 20px;
            left: 20px;
            text-decoration: none;
            transition: background 0.3s;
        }

        .back-btn:hover {
            background: #ff7a68;
        }

        .signup-link {
            text-align: center;
            margin-top: 20px;
        }

        .signup-link a {
            color: #ff523b;
            text-decoration: none;
            font-size: 14px;
        }

        .signup-link a:hover {
            color: #ff7a68;
        }

        /* Responsive Styles */
        @media only screen and (max-width: 800px) {
            nav ul {
                position: absolute;
                top: 70px;
                left: 0;
                background: #333;
                width: 100%;
                overflow: hidden;
                transition: max-height 0.5s;
            }
            nav ul li {
                display: block;
                margin: 10px 20px;
            }
            nav ul li a {
                color: #fff;
            }
            nav ul li a.signup-login {
                color: #ff523b;
            }
            .menu-icon {
                display: block;
            }
            .login-box {
                padding: 20px;
            }
        }

        @media only screen and (max-width: 600px) {
            .container {
                width: 90%;
            }
            .login-box {
                padding: 15px;
            }
            .title {
                font-size: 24px;
            }
            .subtitle {
                font-size: 14px;
            }
            .back-btn {
                position: static;
                margin: 0 auto 20px;
                display: block;
                text-align: center;
            }
        }
    </style>
</head>
<body>
    <div class="header">
        <div class="container">
        </div>
    </div>

    <div class="login-page">
        <div class="container">
            <a href="index.html" class="back-btn"><i class="fa fa-arrow-left"></i> Back</a>
            <div class="login-box">
                <h2 class="title">Login</h2>
                <p class="subtitle">Please sign in to continue</p>
                <form id="loginForm" name="loginForm" action="#" method="POST">
                    <div class="form-group">
                        <i class="fa fa-envelope"></i>
                        <input class="input-field" type="email" id="email" name="email" value="" placeholder="Enter E-Mail" required>
                    </div>
                    <div class="form-group">
                        <i class="fa fa-lock"></i>
                        <input class="input-field" type="password" id="password" name="password" value="" placeholder="Enter Password" required>
                    </div>
                    <button class="btn" type="submit" id="Login" name="Login">Submit</button>
                    <div class="signup-link">
                        <p>Do not have an account? <a href="signupform.php">Sign Up</a></p>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        // Navbar functionality
        var MenuItems = document.getElementById("MenuItems");
        MenuItems.style.maxHeight = "0px";
        function menutoggle() {
            if (MenuItems.style.maxHeight == "0px") {
                MenuItems.style.maxHeight = "200px";
            } else {
                MenuItems.style.maxHeight = "0px";
            }
        }

        // Cart count functionality
        const cart = JSON.parse(localStorage.getItem('cart')) || [];
        function updateCartCount() {
            const cartCount = cart.reduce((total, item) => total + item.quantity, 0);
            document.getElementById('cartCount').textContent = cartCount;
        }
        updateCartCount();
    </script>
</body>
</html>