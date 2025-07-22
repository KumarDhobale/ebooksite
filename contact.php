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
    $subject = mysqli_real_escape_string($conn, $_POST['subject']);
    $message = mysqli_real_escape_string($conn, $_POST['message']);

    if ($id !== '') {
        // Update query
        $sq = "UPDATE contact SET name='$name', email='$email', contact='$contact', subject='$subject', message='$message' WHERE id='$id'";
    } else {
        // Insert query
        $sq = "INSERT INTO contact (name, email, contact, subject, message) VALUES ('$name', '$email', '$contact', '$subject', '$message')";
    }

    // Log the query for debugging
    error_log("Query: $sq", 3, "C:/wamp/logs/php_query.log");

    if (mysqli_query($conn, $sq)) {
        $lastid = mysqli_insert_id($conn);
        if ($id !== '') {
            $success_message = "Contact data updated successfully (ID: $id)";
        } else {
            $success_message = "Message sent successfully (ID: $lastid)";
        }
    } else {
        $error_message = "Error saving data: " . mysqli_error($conn);
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Us | Ebookstore</title>
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

        /* Header and Navbar */
        .header {
            background: radial-gradient(#fff, #ffd6d6);
        }

        .container {
            width: 80%;
            margin: 0 auto;
            padding: 20px;
        }

        .navbar {
            display: flex;
            align-items: center;
            padding: 20px 0;
            position: sticky;
            top: 0;
            z-index: 1000;
        }

        .logo img {
            width: 125px;
        }

        nav {
            flex: 1;
            text-align: right;
        }

        nav ul {
            display: inline-block;
            list-style-type: none;
        }

        nav ul li {
            display: inline-block;
            margin-right: 20px;
        }

        nav ul li a.nav_link {
            text-decoration: none;
            color: #555;
            font-size: 16px;
            transition: color 0.3s;
        }

        nav ul li a.nav_link:hover {
            color: #ff523b;
        }

        nav ul li a.signup-login {
            color: #ff523b;
        }

        .cart-link {
            position: relative;
            display: inline-block;
        }

        .cart-count {
            position: absolute;
            top: 10px;
            right: -10px;
            background: #ff523b;
            color: #fff;
            border-radius: 50%;
            padding: 2px 8px;
            font-size: 12px;
            font-weight: 600;
        }

        .menu-icon {
            width: 28px;
            margin-left: 20px;
            display: none;
            cursor: pointer;
        }

        /* Contact Page */
        .contact-page {
            background: radial-gradient(#fff, #ffd6d6);
            padding: 50px 0;
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

        .contact-box {
            display: flex;
            justify-content: space-between;
            flex-wrap: wrap;
            background: #fff;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
            border-radius: 10px;
            padding: 40px;
        }

        .contact-left {
            flex: 1;
            min-width: 300px;
            padding-right: 20px;
        }

        .contact-right {
            flex: 1;
            min-width: 300px;
            padding-left: 20px;
        }

        .contact-left h3, .contact-right h3 {
            color: #ff523b;
            font-size: 20px;
            margin-bottom: 20px;
        }

        .input-row {
            display: flex;
            justify-content: space-between;
            margin-bottom: 20px;
        }

        .input-group {
            flex: 1;
            margin: 0 10px;
        }

        .input-group label {
            display: block;
            color: #555;
            font-size: 14px;
            margin-bottom: 5px;
        }

        .input-group input, textarea {
            width: 100%;
            padding: 10px;
            border: none;
            border-bottom: 1px solid #ff523b;
            font-size: 14px;
            outline: none;
        }

        textarea {
            resize: vertical;
            min-height: 100px;
        }

        .input-group input:focus, textarea:focus {
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

        .contact-right table {
            width: 100%;
            font-size: 14px;
            color: #555;
        }

        .contact-right table tr {
            margin-bottom: 10px;
        }

        .contact-right table td {
            padding: 10px 0;
        }

        .contact-right table td:first-child {
            font-weight: 600;
            width: 100px;
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

        /* Footer */
        .footer {
            background: #000;
            color: #8a8a8a;
            font-size: 14px;
            padding: 60px 0 20px;
        }

        .footer p {
            color: #8a8a8a;
        }

        .footer h3 {
            color: #fff;
            margin-bottom: 20px;
        }

        .footer-col-1, .footer-col-2, .footer-col-3, .footer-col-4 {
            min-width: 250px;
            margin-bottom: 20px;
        }

        .footer-col-1 {
            flex: 1;
        }

        .footer-col-2 {
            flex: 1;
            text-align: center;
        }

        .footer-col-2 img {
            width: 180px;
            margin-bottom: 20px;
        }

        .footer-col-3, .footer-col-4 {
            flex: 1;
            text-align: center;
        }

        .footer ul {
            list-style-type: none;
        }

        .footer hr {
            border: none;
            background: #b5b5b5;
            height: 1px;
            margin: 20px 0;
        }

        .copyright {
            text-align: center;
        }

        .app-logo img {
            width: 140px;
            margin: 10px 0;
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
            .contact-box {
                flex-direction: column;
                padding: 20px;
            }
            .contact-left, .contact-right {
                padding: 0;
            }
        }

        @media only screen and (max-width: 600px) {
            .container {
                width: 90%;
            }
            .input-row {
                flex-direction: column;
            }
            .input-group {
                margin: 10px 0;
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
            <div class="navbar">
                <div class="logo">
                    <a href="index.html">
                        <img src="images/EbookStore-Logo.png" alt="EbookStore-Logo">
                    </a>
                </div>
                <nav>
                    <ul id="MenuItems">
                        <li><a class="nav_link" href="index.html">Home</a></li>
                        <li><a class="nav_link" href="ebooks.php">Ebooks</a></li>
                        <li><a class="nav_link" href="about.html">About</a></li>
                        <li><a class="nav_link" href="contact.php">Contact</a></li>
                        <li><a class="nav_link signup-login" href="signupform.php">Signup/Login</a></li>
                    </ul>
                </nav>
                <a href="cart.html" class="cart-link">
                    <img src="images/cart.png" alt="Shopping Cart" width="28px" height="28px">
                    <span id="cartCount" class="cart-count">0</span>
                </a>
                <img src="images/menu.png" class="menu-icon" onclick="menutoggle()">
            </div>
        </div>
    </div>

    <div class="contact-page">
        <div class="container">
            <a href="index.html" class="back-btn"><i class="fa fa-arrow-left"></i> Back</a>
            <h2 class="title">Connect with Us</h2>
            <p class="subtitle">We would love to respond to your queries and help you succeed. Feel free to get in touch!</p>
            <?php if ($success_message): ?>
                <p class="success-message"><?php echo htmlspecialchars($success_message); ?></p>
            <?php endif; ?>
            <?php if ($error_message): ?>
                <p class="error-message"><?php echo htmlspecialchars($error_message); ?></p>
            <?php endif; ?>
            <div class="contact-box">
                <div class="contact-left">
                    <h3>Send Your Request</h3>
                    <?php
                    $id = isset($_GET['id']) ? mysqli_real_escape_string($conn, $_GET['id']) : '';
                    $sqd = "SELECT * FROM contact WHERE id='$id'";
                    error_log("Select Query: $sqd", 3, "C:/wamp/logs/php_query.log");
                    $rsd = mysqli_query($conn, $sqd);
                    if (!$rsd) {
                        echo "<p class='error-message'>Error fetching contact data: " . mysqli_error($conn) . "</p>";
                    }
                    $rw = mysqli_fetch_array($rsd);
                    ?>
                    <form method="POST" onsubmit="return sendmsg()">
                        <div class="input-row">
                            <div class="input-group">
                                <label>Name</label>
                                <input type="text" name="name" placeholder="Enter name" value="<?php echo isset($rw['name']) ? htmlspecialchars($rw['name']) : ''; ?>" required>
                            </div>
                            <div class="input-group">
                                <label>Email</label>
                                <input type="email" name="email" placeholder="Enter E-Mail" value="<?php echo isset($rw['email']) ? htmlspecialchars($rw['email']) : ''; ?>" required>
                            </div>
                        </div>
                        <div class="input-row">
                            <div class="input-group">
                                <label>Contact</label>
                                <input type="text" name="contact" pattern="[7-9]\d{9}" title="Mobile Number Should be 10 Digits Starting with 7, 8, or 9" maxlength="10" placeholder="Enter contact number" value="<?php echo isset($rw['contact']) ? htmlspecialchars($rw['contact']) : ''; ?>" required>
                            </div>
                            <div class="input-group">
                                <label>Subject</label>
                                <input type="text" name="subject" placeholder="Enter subject" value="<?php echo isset($rw['subject']) ? htmlspecialchars($rw['subject']) : ''; ?>" required>
                            </div>
                        </div>
                        <label>Message</label>
                        <textarea rows="5" name="message" placeholder="Your Message" required><?php echo isset($rw['message']) ? htmlspecialchars($rw['message']) : ''; ?></textarea>
                        <button type="submit" name="submit" class="btn">Send</button>
                    </form>
                </div>
                <div class="contact-right">
                    <h3>Reach Us</h3>
                    <table>
                        <tr>
                            <td>Email:</td>
                            <td>tohitshaikh391@gmail.com</td>
                        </tr>
                        <tr>
                            <td>Phone:</td>
                            <td>+91 8600-580-388</td>
                        </tr>
                        <tr>
                            <td>State:</td>
                            <td>Maharashtra</td>
                        </tr>
                        <tr>
                            <td>City:</td>
                            <td>Pune</td>
                        </tr>
                        <tr>
                            <td>Address:</td>
                            <td>#212 Pune-Nashik Road<br>Narayangoan Kureshi Apartment 410504</td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div class="footer">
        <div class="container">
            <div class="row">
                <div class="footer-col-1">
                    <h3>Download Our App</h3>
                    <p>Download App for Android and iOS mobile phone.</p>
                    <div class="app-logo">
                        <img src="images/Playstore.png" alt="Play Store">
                        <img src="images/Applestore.png" alt="App Store">
                    </div>
                </div>
                <div class="footer-col-2">
                    <img src="images/EbookStore-Logo-footer.png" alt="EbookStore Footer Logo">
                    <p>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Reiciendis, Lorem ipsum dolor sit amet.</p>
                </div>
                <div class="footer-col-3">
                    <h3>Useful Links</h3>
                    <ul>
                        <li>Coupons</li>
                        <li>Blog Post</li>
                        <li>Return Policy</li>
                        <li>Join Affiliate</li>
                    </ul>
                </div>
                <div class="footer-col-4">
                    <h3>Follow us</h3>
                    <ul>
                        <li>Facebook</li>
                        <li>Youtube</li>
                        <li>Instagram</li>
                        <li>Twitter</li>
                    </ul>
                </div>
            </div>
            <hr>
            <p class="copyright">Copyright 2020 - EbookStore</p>
        </div>
    </div>

    <script>
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

        function sendmsg() {
            <?php if ($success_message): ?>
                alert("Your message has been sent successfully!");
                return true;
            <?php else: ?>
                <?php if ($error_message): ?>
                    alert("Error: <?php echo htmlspecialchars($error_message); ?>");
                    return false;
                <?php endif; ?>
                return true;
            <?php endif; ?>
        }
    </script>
</body>
</html>