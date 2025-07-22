<?php
error_reporting(E_ALL);
ini_set('display_errors', 1); // Enable error display for debugging
include('connection.php');

// Check database connection
if (mysqli_connect_errno()) {
    die("Database connection failed: " . mysqli_connect_error());
}

$success_message = '';
$error_message = '';

if (isset($_POST['submit'])) {
    $id = isset($_GET['id']) ? mysqli_real_escape_string($conn, $_GET['id']) : '';
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $contact = mysqli_real_escape_string($conn, $_POST['contact']);
    $address = mysqli_real_escape_string($conn, $_POST['address']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);
    $repassword = mysqli_real_escape_string($conn, $_POST['repassword']);

    if (trim($password) === trim($repassword)) {
        if ($id !== '') {
            // Update query
            $sq = "UPDATE signup SET name='$name', email='$email', contact='$contact', address='$address', password='$password', repassword='$repassword' WHERE id='$id'";
        } else {
            // Insert query
            $sq = "INSERT INTO signup (name, email, contact, address, password, repassword) VALUES ('$name', '$email', '$contact', '$address', '$password', '$repassword')";
        }

        // Log the query for debugging
        error_log("Query: $sq", 3, "C:/wamp/logs/php_query.log");

        if (mysqli_query($conn, $sq)) {
            $lastid = mysqli_insert_id($conn);
            if ($id !== '') {
                $success_message = "User data updated successfully (ID: $id)";
            } else {
                $success_message = "User registered successfully (ID: $lastid)";
                echo "<script>window.location.assign('login.php');</script>";
            }
        } else {
            $error_message = "Error saving data: " . mysqli_error($conn);
        }
    } else {
        $error_message = "Password does not match";
        echo "<script>document.getElementById('confmsg').innerHTML = 'Password does not match'.fontcolor('red');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up | Ebookstore</title>
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
        }

        /* Signup Form */
        .signup-page {
            background: radial-gradient(#fff, #ffd6d6);
            padding: 50px 0;
        }

        .signup-box {
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

        .error-label, .confmsg {
            display: block;
            color: red;
            font-size: 12px;
            margin-top: 5px;
        }

        .confmsg.success {
            color: green;
        }

        .success-message {
            color: green;
            font-size: 14px;
            text-align: center;
            margin-bottom: 20px;
        }

        .error-message {
            color: red;
            font-size: 14px;
            text-align: center;
            margin-bottom: 20px;
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

        .login-link {
            text-align: center;
            margin-top: 20px;
        }

        .login-link a {
            color: #ff523b;
            text-decoration: none;
            font-size: 14px;
        }

        .login-link a:hover {
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
            .signup-box {
                padding: 20px;
            }
        }

        @media only screen and (max-width: 600px) {
            .container {
                width: 90%;
            }
            .signup-box {
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

    <div class="signup-page">
        <div class="container">
            <a href="index.html" class="back-btn"><i class="fa fa-arrow-left"></i> Back</a>
            <div class="signup-box">
                <h2 class="title">Sign Up</h2>
                <p class="subtitle">Please sign up to continue</p>
                <?php if ($success_message): ?>
                    <p class="success-message"><?php echo htmlspecialchars($success_message); ?></p>
                <?php endif; ?>
                <?php if ($error_message): ?>
                    <p class="error-message"><?php echo htmlspecialchars($error_message); ?></p>
                <?php endif; ?>
                <?php
                $id = isset($_GET['id']) ? mysqli_real_escape_string($conn, $_GET['id']) : '';
                $sqd = "SELECT * FROM signup WHERE id='$id'";
                error_log("Select Query: $sqd", 3, "C:/wamp/logs/php_query.log");
                $rsd = mysqli_query($conn, $sqd);
                if (!$rsd) {
                    echo "<p class='error-message'>Error fetching user data: " . mysqli_error($conn) . "</p>";
                }
                $rw = mysqli_fetch_array($rsd);
                ?>
                <form id="signupForm" name="signupForm" action="#" method="POST">
                    <div class="form-group">
                        <i class="fa fa-user"></i>
                        <input class="input-field" type="text" id="name" name="name" value="<?php echo isset($rw['name']) ? htmlspecialchars($rw['name']) : ''; ?>" placeholder="Enter User Name" onchange="chkvalidation();" required>
                        <label id="nameerror" class="error-label"></label>
                    </div>
                    <div class="form-group">
                        <i class="fa fa-envelope"></i>
                        <input class="input-field" type="email" id="email" name="email" value="<?php echo isset($rw['email']) ? htmlspecialchars($rw['email']) : ''; ?>" placeholder="Enter E-Mail" onchange="chkvalidation();" required>
                        <label id="emailerror" class="error-label"></label>
                    </div>
                    <div class="form-group">
                        <i class="fa fa-phone"></i>
                        <input class="input-field" type="text" id="contact" name="contact" pattern="[7-9]\d{9}" title="Mobile Number Should be 10 Digit Starts with 7,8,9" maxlength="10" value="<?php echo isset($rw['contact']) ? htmlspecialchars($rw['contact']) : ''; ?>" placeholder="Enter Contact Number" onchange="chkvalidation();" onkeypress="ValidateNumberOnly(event);" required>
                        <label id="contacterror" class="error-label"></label>
                    </div>
                    <div class="form-group">
                        <i class="fa fa-map-marker"></i>
                        <input class="input-field" type="text" id="address" name="address" value="<?php echo isset($rw['address']) ? htmlspecialchars($rw['address']) : ''; ?>" placeholder="Enter Address" onchange="chkvalidation();" required>
                        <label id="addresserror" class="error-label"></label>
                    </div>
                    <div class="form-group">
                        <i class="fa fa-lock"></i>
                        <input class="input-field" type="password" id="password" name="password" value="<?php echo isset($rw['password']) ? htmlspecialchars($rw['password']) : ''; ?>" placeholder="Enter Password" onchange="chkpwd();" required>
                        <label id="passworderror" class="error-label"></label>
                    </div>
                    <div class="form-group">
                        <i class="fa fa-lock"></i>
                        <input class="input-field" type="password" id="repassword" name="repassword" value="<?php echo isset($rw['repassword']) ? htmlspecialchars($rw['repassword']) : ''; ?>" placeholder="Enter Re-Password" onchange="chkpwd();" required>
                        <label id="repassworderror" class="error-label"></label>
                    </div>
                    <div><label id="confmsg" class="confmsg"></label></div>
                    <button class="btn" type="submit" id="submit" name="submit" onclick="return CommonValidation();">Submit</button>
                    <div class="login-link">
                        <p>Have an account? <a href="login.php">Login</a></p>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        function chkpwd() {
            var pwd = document.getElementById('password').value;
            var confpwd = document.getElementById('repassword').value;
            var confmsg = document.getElementById('confmsg');
            if (pwd && confpwd) {
                if (pwd === confpwd) {
                    confmsg.textContent = 'Password match';
                    confmsg.classList.add('success');
                    confmsg.classList.remove('error');
                } else {
                    confmsg.textContent = 'Password does not match';
                    confmsg.classList.add('error');
                    confmsg.classList.remove('success');
                }
            } else {
                confmsg.textContent = '';
                confmsg.classList.remove('success', 'error');
            }
        }

        function CommonValidation() {
            var name = document.getElementById('name').value;
            var email = document.getElementById('email').value;
            var contact = document.getElementById('contact').value;
            var address = document.getElementById('address').value;
            var password = document.getElementById('password').value;
            var repassword = document.getElementById('repassword').value;

            if (!name || !email || !contact || !address || !password || !repassword) {
                if (!name) {
                    document.getElementById('name').focus();
                    document.getElementById('nameerror').textContent = 'Please Enter Name';
                    return false;
                }
                if (!email) {
                    document.getElementById('email').focus();
                    document.getElementById('emailerror').textContent = 'Please Enter Email';
                    return false;
                }
                if (!contact) {
                    document.getElementById('contact').focus();
                    document.getElementById('contacterror').textContent = 'Please Enter Phone';
                    return false;
                }
                if (!address) {
                    document.getElementById('address').focus();
                    document.getElementById('addresserror').textContent = 'Please Enter Address';
                    return false;
                }
                if (!password) {
                    document.getElementById('password').focus();
                    document.getElementById('passworderror').textContent = 'Please Enter Password';
                    return false;
                }
                if (!repassword) {
                    document.getElementById('repassword').focus();
                    document.getElementById('repassworderror').textContent = 'Please Enter Confirm Password';
                    return false;
                }
            }
            return true;
        }

        function chkvalidation() {
            var fields = ['name', 'email', 'contact', 'address', 'password', 'repassword'];
            fields.forEach(function(field) {
                var value = document.getElementById(field).value;
                var error = document.getElementById(field + 'error');
                error.textContent = value ? '' : '';
            });
        }

        function ValidateNumberOnly(event) {
            if (event.keyCode < 48 || event.keyCode > 57) {
                event.preventDefault();
            }
        }

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