<?php
ob_start();
session_start();
if (!isset($_SESSION['admin'])) {
    header("Location: admin_login.php");
    exit;
}

include('connection.php');

$error_message = '';
$success_message = '';

// Handle delete
if (isset($_POST['delete_id'])) {
    $id = $_POST['delete_id'];
    $stmt = mysqli_prepare($conn, "DELETE FROM contact WHERE id = ?");
    mysqli_stmt_bind_param($stmt, "i", $id);
    if (mysqli_stmt_execute($stmt)) {
        $_SESSION['message'] = 'Record deleted successfully.';
        $_SESSION['message_type'] = 'success';
        header("Location: display_contactdata.php");
        exit;
    } else {
        $error_message = 'Error deleting record: ' . mysqli_error($conn);
    }
    mysqli_stmt_close($stmt);
}

// Handle search
$sql = "SELECT * FROM contact";
$where = "";
$name = '';
if (isset($_POST['search']) && !empty(trim($_POST['name']))) {
    $name = trim($_POST['name']);
    $where = " WHERE name LIKE ?";
    $sql .= $where;
}

$stmt = mysqli_prepare($conn, $sql);
if ($where) {
    $like_name = "%$name%";
    mysqli_stmt_bind_param($stmt, "s", $like_name);
}
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Manage Contact Data | Ebookstore</title>
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
        .container {
            max-width: 1000px;
            width: 100%;
            background: rgba(255, 255, 255, 0.95);
            border-radius: 15px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            padding: 30px;
        }
        h2 {
            font-size: 32px;
            color: #333;
            margin-bottom: 20px;
            text-align: center;
            font-weight: 600;
        }
        .search-div {
            display: flex;
            justify-content: center;
            margin-bottom: 20px;
            gap: 10px;
            flex-wrap: wrap;
        }
        .searchbar {
            padding: 10px;
            border: 1px solid #ff523b;
            border-radius: 10px;
            font-family: 'Poppins', sans-serif;
            font-size: 14px;
            width: 300px;
        }
        .btn {
            padding: 10px 20px;
            background: linear-gradient(45deg, #ff523b, #ff7a68);
            color: #fff;
            border: none;
            border-radius: 25px;
            font-family: 'Poppins', sans-serif;
            font-size: 14px;
            cursor: pointer;
            transition: transform 0.3s, box-shadow 0.3s;
        }
        .btn:hover {
            transform: translateY(-3px);
            box-shadow: 0 5px 15px rgba(255, 82, 59, 0.4);
        }
        .btn-print {
            background: linear-gradient(45deg, #6c757d, #5a6268);
        }
        .btn-print:hover {
            box-shadow: 0 5px 15px rgba(108, 117, 125, 0.4);
        }
        .btn-back {
            display: inline-flex;
            align-items: center;
            gap: 10px;
            margin-top: 20px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            background: #fff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            border-radius: 10px;
            overflow: hidden;
        }
        th {
            background: linear-gradient(45deg, #ff523b, #ff7a68);
            color: #fff;
            padding: 15px;
            font-weight: 500;
            text-align: center;
        }
        td {
            padding: 15px;
            border-bottom: 1px solid #ddd;
            text-align: center;
            font-size: 14px;
            color: #333;
        }
        .action-btn {
            color: #ff523b;
            text-decoration: none;
            font-size: 16px;
        }
        .action-btn.delete {
            background: none;
            border: none;
            cursor: pointer;
        }
        .action-btn:hover {
            color: #ff7a68;
        }
        .hidden {
            display: none;
        }
        #showlabl {
            text-align: center;
            color: #ff523b;
            font-size: 24px;
            margin-bottom: 20px;
        }
        @media print {
            .search-div, .btn-back, .action-col {
                display: none;
            }
            #showlabl {
                display: block !important;
            }
        }
        @media (max-width: 600px) {
            body {
                padding: 20px;
            }
            .container {
                padding: 20px;
            }
            h2 {
                font-size: 24px;
            }
            .searchbar {
                width: 100%;
            }
            .btn {
                padding: 8px 15px;
                font-size: 12px;
            }
            table {
                font-size: 12px;
            }
            td, th {
                padding: 10px;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Manage Contact Data</h2>
        <?php if ($error_message): ?>
            <div style="padding: 10px; margin-bottom: 20px; border-radius: 5px; color: #fff; background: #dc3545; font-size: 14px;">
                <?php echo htmlspecialchars($error_message); ?>
            </div>
        <?php endif; ?>
        <?php if (isset($_SESSION['message'])): ?>
            <div style="padding: 10px; margin-bottom: 20px; border-radius: 5px; color: #fff; background: <?php echo $_SESSION['message_type'] === 'success' ? '#28a745' : '#dc3545'; ?>; font-size: 14px;">
                <?php echo htmlspecialchars($_SESSION['message']); ?>
            </div>
            <?php unset($_SESSION['message']); unset($_SESSION['message_type']); ?>
        <?php endif; ?>
        <form method="POST" class="search-div">
            <input type="text" id="name" name="name" class="searchbar" placeholder="Search by name" value="<?php echo isset($name) ? htmlspecialchars($name) : ''; ?>">
            <button type="submit" name="search" class="btn"><i class="fas fa-search"></i> Search</button>
            <button type="button" class="btn btn-print" onclick="openprint();"><i class="fas fa-print"></i> Print</button>
        </form>
        <div id="showlabl" class="hidden">Sign Up Data</div>
        <table>
            <tr>
                <th>Id</th>
                <th>Name</th>
                <th>Email</th>
                <th>Contact</th>
                <th>Subject</th>
                <th>Message</th>
                <th class="action-col">Delete</th>
            </tr>
            <?php $k = 1; while ($row = mysqli_fetch_assoc($result)): ?>
                <tr>
                    <td><?php echo $k++; ?></td>
                    <td><?php echo htmlspecialchars($row['name']); ?></td>
                    <td><?php echo htmlspecialchars($row['email']); ?></td>
                    <td><?php echo htmlspecialchars($row['contact']); ?></td>
                    <td><?php echo htmlspecialchars($row['subject']); ?></td>
                    <td><?php echo htmlspecialchars($row['message']); ?></td>
                    <td class="action-col">
                        <form method="POST" style="display:inline;">
                            <input type="hidden" name="delete_id" value="<?php echo $row['id']; ?>">
                            <button type="submit" class="action-btn delete" onclick="return confirm('Do you want to delete?')"><i class="fas fa-trash"></i></button>
                        </form>
                    </td>
                </tr>
            <?php endwhile; ?>
        </table>
        <a href="admin_dashboard.php" class="btn btn-back"><i class="fas fa-arrow-left"></i> Back to Dashboard</a>
    </div>

    <script>
        function openprint() {
            $('.search-div, .btn-back, .action-col').addClass('hidden');
            $('#showlabl').removeClass('hidden');
            window.print();
            $('.search-div, .btn-back, .action-col').removeClass('hidden');
            $('#showlabl').addClass('hidden');
        }
    </script>
</body>
</html>
<?php
mysqli_stmt_close($stmt);
mysqli_close($conn);
ob_end_flush();
?>
