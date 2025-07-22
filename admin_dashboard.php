
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Admin Dashboard | Ebookstore</title>
     <link rel="icon" type="image/png" href="images/favicon.png">
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@200;300;400;500;600&display=swap" rel="stylesheet"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css"/>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            margin: 0;
            padding: 40px;
            background: linear-gradient(135deg, #f5f7fa, #c3cfe2);
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
        }
        
        .dashboard-container {
            max-width: 700px;
            width: 100%;
            background: rgba(255, 255, 255, 0.95);
            border-radius: 15px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            padding: 30px;
            text-align: center;
        }
        h2 {
            font-size: 32px;
            color: #333;
            margin-bottom: 30px;
            font-weight: 600;
        }
        .button-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 20px;
        }
        .dashboard-button {
            padding: 15px;
            background: linear-gradient(45deg, #ff523b, #ff7a68);
            color: #fff;
            border: none;
            border-radius: 25px;
            font-size: 16px;
            font-weight: 500;
            text-decoration: none;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
            transition: transform 0.3s, box-shadow 0.3s;
        }
        .dashboard-button:hover {
            transform: translateY(-3px);
            box-shadow: 0 5px 15px rgba(255, 82, 59, 0.4);
        }
        .logout-button {
            background: linear-gradient(45deg, #6c757d, #5a6268);
        }
        .logout-button:hover {
            box-shadow: 0 5px 15px rgba(108, 117, 125, 0.4);
        }
        @media (max-width: 600px) {
            body {
                padding: 20px;
            }
            .dashboard-container {
                padding: 20px;
            }
            h2 {
                font-size: 24px;
            }
            .dashboard-button {
                font-size: 14px;
                padding: 12px;
            }
        }
    </style>
</head>
<body>
    <?php
    session_start();
    if (!isset($_SESSION['admin'])) {
        header("Location: admin_login.php");
        exit;
    }
    ?>
    <div class="dashboard-container">
        <h2>Admin Dashboard</h2>
        <?php if (isset($_SESSION['message'])): ?>
            <div style="padding: 10px; margin-bottom: 20px; border-radius: 5px; color: #fff; background: <?php echo $_SESSION['message_type'] === 'success' ? '#28a745' : '#dc3545'; ?>; font-family: 'Poppins', sans-serif; font-size: 14px;">
                <?php echo htmlspecialchars($_SESSION['message']); ?>
            </div>
            <?php unset($_SESSION['message']); unset($_SESSION['message_type']); ?>
        <?php endif; ?>
        <div class="button-grid">
            <a href="display_data.php" class="dashboard-button"><i class="fas fa-users"></i> Manage Users</a>
            <a href="display_contactdata.php" class="dashboard-button"><i class="fas fa-address-book"></i> Manage Contact Data</a>
            <a href="update_prices.php" class="dashboard-button"><i class="fas fa-dollar-sign"></i> Update Prices</a>
            <a href="logout.php" class="dashboard-button logout-button"><i class="fas fa-sign-out-alt"></i> Logout</a>
        </div>
    </div>
    <script>
        $(document).ready(function() {
            $('.dashboard-button').on('mouseenter', function() {
                $(this).css({
                    'transform': 'translateY(-3px)',
                    'box-shadow': '0 5px 15px rgba(0, 0, 0, 0.4)'
                });
            }).on('mouseleave', function() {
                $(this).css({
                    'transform': 'translateY(0)',
                    'box-shadow': 'none'
                });
            });
        });
    </script>
</body>
</html>
