
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Admin Login | Ebookstore</title>
    <link rel="icon" type="image/png" href="images/favicon.png">
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@200;300;400;500;600&display=swap" rel="stylesheet"/>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
</head>
<style>

    body{
        font-family: 'Poppins', sans-serif;
         margin: 0; padding: 20px; 
         background: #f4f4f4;
    }

    .back-btn{
            padding: 10px 20px;
            background: #ff523b;
            color: #fff;
            border:none;
            border-radius: 30px;
            font-family: 'poppins', sans-serif;
            font-size: 14px; 
            cursor: pointer;
        }
</style>
<body>
    <button class="back-btn" onclick="window.location.href='index.html'">Back to Home</button>
    <?php
    ob_start();
    session_start();
    error_reporting(E_ALL);
    ini_set('display_errors', 1);
    include('connection.php');

    $error_message = '';

    if (isset($_SESSION['admin'])) {
        error_log("Session active: admin=" . $_SESSION['admin']);
        header("Location: admin_dashboard.php");
        exit;
    }

    if (isset($_POST['login'])) {
        $username = trim($_POST['username']);
        $password = $_POST['password'];

        error_log("Login attempt: username=$username");

        if ($username != '') {
            $stmt = mysqli_prepare($conn, "SELECT password FROM admins WHERE username = ?");
            if ($stmt === false) {
                error_log("SQL Prepare failed: " . mysqli_error($conn));
                $error_message = 'Database error.';
            } else {
                mysqli_stmt_bind_param($stmt, "s", $username);
                if (!mysqli_stmt_execute($stmt)) {
                    error_log("SQL Execute failed: " . mysqli_stmt_error($stmt));
                    $error_message = 'Database error.';
                } else {
                    $result = mysqli_stmt_get_result($stmt);
                    if ($row = mysqli_fetch_assoc($result)) {
                        error_log("User found: $username, stored hash: " . $row['password']);
                        if (password_verify($password, $row['password'])) {
                            error_log("Password verified for $username");
                            $_SESSION['admin'] = $username;
                            error_log("Session set: admin=$username");
                            ob_end_flush();
                            header("Location: admin_dashboard.php");
                            exit;
                        } else {
                            error_log("Password verification failed for $username");
                            $error_message = 'Invalid username or password.';
                        }
                    } else {
                        error_log("User not found: $username");
                        $error_message = 'Invalid username or password.';
                    }
                    mysqli_stmt_close($stmt);
                }
            }
        } else {
            error_log("Empty username provided");
            $error_message = 'Please provide a valid username.';
        }
    }
    mysqli_close($conn);
    ob_end_flush();
    ?>

    <div style="max-width: 400px; margin: 50px auto; padding: 40px; background: #fff; border-radius: 10px; box-shadow: 0 0 20px rgba(0, 0, 0, 0.1); text-align: center;">
        <h2 style="font-family: 'Poppins', sans-serif; font-size: 28px; color: #ff523b; margin-bottom: 20px;">Admin Login</h2>
        
        <?php if ($error_message): ?>
            <p style="font-family: 'Poppins', sans-serif; font-size: 14px; color: #dc3545; margin-bottom: 15px;"><?php echo htmlspecialchars($error_message); ?></p>
        <?php endif; ?>

        <form method="POST" style="display: flex; flex-direction: column; gap: 15px;">
            <input type="text" name="username" placeholder="Username" value="<?php echo isset($username) ? htmlspecialchars($username) : ''; ?>" style="width: 100%; padding: 10px; border: 1px solid #ff523b; border-radius: 5px; font-family: 'Poppins', sans-serif; font-size: 14px;" required>
            <input type="password" name="password" placeholder="Password" style="width: 100%; padding: 10px; border: 1px solid #ff523b; border-radius: 5px; font-family: 'Poppins', sans-serif; font-size: 14px;" required>
            <input type="submit" name="login" value="Login" style="width: 100%; padding: 10px; background: #ff523b; color: #fff; border: none; border-radius: 30px; font-family: 'Poppins', sans-serif; font-size: 16px; cursor: pointer;">
        </form>
    </div>

    <script>
        $(document).ready(function() {
            $('input[type="submit"]').on('mouseenter', function() {
                $(this).css({
                    'background': '#ff7a68',
                    'transform': 'scale(1.05)'
                });
            }).on('mouseleave', function() {
                $(this).css({
                    'background': '#ff523b',
                    'transform': 'scale(1)'
                });
            });
        });
    </script>
</body>
</html>
