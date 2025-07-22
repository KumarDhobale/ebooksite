
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Edit User | Ebookstore</title>
    <link rel="icon" type="image/png" href="images/favicon.png">
    <link rel="preconnect" href="https://fonts.gstatic.com" />
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,200;0,300;0,400;0,500;0,600;1,100;1,200;1,300;1,400;1,500;1,600&display=swap" rel="stylesheet"/>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <style>
        .hidden { display: none; }
    </style>
</head>
<body style="font-family: 'Poppins', sans-serif; margin: 0; padding: 20px; background: #f4f4f4;">
    <?php
    session_start();
    

    error_reporting(E_ALL);
    include('connection.php');

    $user = null;
    $message = '';
    $message_type = '';

    if (isset($_GET['id']) && is_numeric($_GET['id'])) {
        $id = (int)$_GET['id'];
        $stmt = mysqli_prepare($conn, "SELECT * FROM signup WHERE id = ?");
        mysqli_stmt_bind_param($stmt, 'i', $id);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        $user = mysqli_fetch_assoc($result);
        mysqli_stmt_close($stmt);

        if (!$user) {
            $message = 'User not found.';
            $message_type = 'error';
        }
    } else {
        $message = 'Invalid user ID.';
        $message_type = 'error';
    }

    if (isset($_POST['update'])) {
        $id = (int)$_POST['id'];
        $name = trim($_POST['name']);
        $email = trim($_POST['email']);
        $contact = trim($_POST['contact']);
        $address = trim($_POST['address']);

        if ($name != '' && filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $stmt = mysqli_prepare($conn, "UPDATE signup SET name = ?, email = ?, contact = ?, address = ? WHERE id = ?");
            mysqli_stmt_bind_param($stmt, 'ssssi', $name, $email, $contact, $address, $id);
            if (mysqli_stmt_execute($stmt)) {
                $message = 'User updated successfully.';
                $message_type = 'success';
            } else {
                $message = 'Error updating user.';
                $message_type = 'error';
            }
            mysqli_stmt_close($stmt);
        } else {
            $message = 'Please provide a valid name and email.';
            $message_type = 'error';
        }
    }
    ?>

    <div style="max-width: 600px; margin: 0 auto; padding: 20px; background: #fff; border-radius: 10px;">
        <h2 style="font-family: 'Poppins', sans-serif; font-size: 24px; color: #333; margin-bottom: 20px;">Edit User</h2>
        
        <?php if ($message): ?>
            <div id="message" style="padding: 10px; margin-bottom: 20px; border-radius: 5px; color: #fff; background: <?php echo $message_type === 'success' ? '#28a745' : '#dc3545'; ?>; font-family: 'Poppins', sans-serif; font-size: 14px;">
                <?php echo htmlspecialchars($message); ?>
            </div>
        <?php endif; ?>

        <?php if ($user): ?>
            <form method="POST" style="display: flex; flex-direction: column; gap: 15px;">
                <input type="hidden" name="id" value="<?php echo htmlspecialchars($user['id']); ?>">
                <div>
                    <label style="font-family: 'Poppins', sans-serif; font-size: 14px; color: #333;">Name</label>
                    <input type="text" name="name" value="<?php echo htmlspecialchars($user['name']); ?>" style="width: 100%; padding: 8px; border: 1px solid #ddd; border-radius: 5px; font-family: 'Poppins', sans-serif; font-size: 14px;" required>
                </div>
                <div>
                    <label style="font-family: 'Poppins', sans-serif; font-size: 14px; color: #333;">Email</label>
                    <input type="email" name="email" value="<?php echo htmlspecialchars($user['email']); ?>" style="width: 100%; padding: 8px; border: 1px solid #ddd; border-radius: 5px; font-family: 'Poppins', sans-serif; font-size: 14px;" required>
                </div>
                <div>
                    <label style="font-family: 'Poppins', sans-serif; font-size: 14px; color: #333;">Contact</label>
                    <input type="text" name="contact" value="<?php echo htmlspecialchars($user['contact']); ?>" style="width: 100%; padding: 8px; border: 1px solid #ddd; border-radius: 5px; font-family: 'Poppins', sans-serif; font-size: 14px;">
                </div>
                <div>
                    <label style="font-family: 'Poppins', sans-serif; font-size: 14px; color: #333;">Address</label>
                    <input type="text" name="address" value="<?php echo htmlspecialchars($user['address']); ?>" style="width: 100%; padding: 8px; border: 1px solid #ddd; border-radius: 5px; font-family: 'Poppins', sans-serif; font-size: 14px;">
                </div>
                <div style="display: flex; gap: 10px;">
                    <input type="submit" name="update" value="Update User" style="padding: 10px 20px; background: #ff523b; color: #fff; border: none; border-radius: 30px; font-family: 'Poppins', sans-serif; font-size: 14px; cursor: pointer;">
                    <a href="admin_dashboard.php" style="padding: 10px 20px; background: #6c757d; color: #fff; border: none; border-radius: 30px; font-family: 'Poppins', sans-serif; font-size: 14px; text-decoration: none; text-align: center;">Cancel</a>
                </div>
            </form>
        <?php else: ?>
            <p style="font-family: 'Poppins', sans-serif; font-size: 14px; color: #dc3545;">No user data available.</p>
            <a href="admin_dashboard.php" style="padding: 10px 20px; background: #6c757d; color: #fff; border: none; border-radius: 30px; font-family: 'Poppins', sans-serif; font-size: 14px; text-decoration: none;">Back to Dashboard</a>
        <?php endif; ?>
    </div>

    <script>
        $(document).ready(function() {
            $('input[type="submit"], a').on('mouseenter', function() {
                $(this).css({
                    'background': $(this).css('background-color') === 'rgb(108, 117, 125)' ? '#5a6268' : '#ff7a68',
                    'transform': 'scale(1.05)'
                });
            }).on('mouseleave', function() {
                $(this).css({
                    'background': $(this).css('background-color') === 'rgb(90, 98, 104)' ? '#6c757d' : '#ff523b',
                    'transform': 'scale(1)'
                });
            });

            <?php if ($message_type === 'success'): ?>
                setTimeout(function() {
                    window.location.href = 'admin_dashboard.php';
                }, 2000);
            <?php endif; ?>
        });
    </script>
</body>
</html>
