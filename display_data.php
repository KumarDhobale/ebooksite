
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>User Management | Ebookstore</title>
    <link rel="icon" type="image/png" href="images/favicon.png">
    <link rel="preconnect" href="https://fonts.gstatic.com" />
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,200;0,300;0,400;0,500;0,600;1,100;1,200;1,300;1,400;1,500;1,600&display=swap" rel="stylesheet"/>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css"/>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <style>
        .hidden { display: none; }
        @media print {
            #print-title { display: block; font-family: 'Poppins', sans-serif; font-size: 20px; text-align: center; margin-bottom: 20px; }
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
</head>
<body style="font-family: 'Poppins', sans-serif; margin: 0; padding: 20px; background: #f4f4f4;">
    <button class="back-btn" onclick="window.location.href='admin_dashboard.php'">Back to Dashboard</button>
    <?php
    session_start();

    error_reporting(E_ALL);
    include('connection.php');
    $whr = '';
    $name = '';
    if (isset($_POST['search'])) {
        $name = trim($_POST['name']);
        if ($name != '') {
            $whr = " WHERE name LIKE ?";
        }
    }
    $sql = "SELECT * FROM signup" . $whr;
    $stmt = mysqli_prepare($conn, $sql);
    if ($whr != '') {
        $name_param = "%$name%";
        mysqli_stmt_bind_param($stmt, 's', $name_param);
    }
    mysqli_stmt_execute($stmt);
    $rs = mysqli_stmt_get_result($stmt);

    if (isset($_POST['delete_id'])) {
        $delete_id = $_POST['delete_id'];
        $delete_stmt = mysqli_prepare($conn, "DELETE FROM signup WHERE id = ?");
        mysqli_stmt_bind_param($delete_stmt, 'i', $delete_id);
        mysqli_stmt_execute($delete_stmt);
        mysqli_stmt_close($delete_stmt);
        header("Location: display_data.php");
        exit;
    }
    ?>

    <div style="max-width: 1200px; margin: 0 auto; padding: 20px;">
        <h2 style="font-family: 'Poppins', sans-serif; font-size: 24px; color: #333; margin-bottom: 20px;">User Management</h2>
        <form method="POST" style="margin: 20px 0; display: flex; gap: 10px;">
            <input type="text" id="name" name="name" value="<?php echo isset($name) ? htmlspecialchars($name) : ''; ?>" placeholder="Search Name" style="padding: 8px; border: 1px solid #ddd; border-radius: 5px; font-family: 'Poppins', sans-serif; font-size: 14px; width: 200px;">
            <input type="submit" id="search" name="search" value="Search" style="padding: 10px 20px; background: #ff523b; color: #fff; border: none; border-radius: 30px; font-family: 'Poppins', sans-serif; font-size: 14px; cursor: pointer;">
        </form>
        <button id="print" name="print" style="padding: 10px 20px; background: #ff523b; color: #fff; border: none; border-radius: 30px; font-family: 'Poppins', sans-serif; font-size: 14px; cursor: pointer;" onclick="openprint();"><i class="fa fa-print"></i> Print</button>
        <div id="print-title" class="hidden">Ebookstore User List</div>
        <table style="width: 100%; border-collapse: collapse; background: #fff; margin-top: 20px; font-family: 'Poppins', sans-serif;">
            <tr style="background: #ff523b; color: #fff;">
                <th style="border: 1px solid #ddd; padding: 10px; text-align: left;">Id</th>
                <th style="border: 1px solid #ddd; padding: 10px; text-align: left;">Name</th>
                <th style="border: 1px solid #ddd; padding: 10px; text-align: left;">Email</th>
                <th style="border: 1px solid #ddd; padding: 10px; text-align: left;">Contact</th>
                <th style="border: 1px solid #ddd; padding: 10px; text-align: left;">Address</th>
                <th class="hidecol" style="border: 1px solid #ddd; padding: 10px; text-align: left;">Delete</th>
                <th class="hidecol" style="border: 1px solid #ddd; padding: 10px; text-align: left;">Edit</th>
            </tr>
            <?php
            if (mysqli_num_rows($rs) > 0) {
                $k = 1;
                while ($rw = mysqli_fetch_assoc($rs)) {
            ?>
                <tr style="background: <?php echo $k % 2 == 0 ? '#f9f9f9' : '#fff'; ?>;">
                    <td style="border: 1px solid #ddd; padding: 10px;"><?php echo $k++; ?></td>
                    <td style="border: 1px solid #ddd; padding: 10px;"><?php echo htmlspecialchars($rw['name']); ?></td>
                    <td style="border: 1px solid #ddd; padding: 10px;"><?php echo htmlspecialchars($rw['email']); ?></td>
                    <td style="border: 1px solid #ddd; padding: 10px;"><?php echo htmlspecialchars($rw['contact']); ?></td>
                    <td style="border: 1px solid #ddd; padding: 10px;"><?php echo htmlspecialchars($rw['address']); ?></td>
                    <td class="hidecol" style="border: 1px solid #ddd; padding: 10px;">
                        <form method="POST" onsubmit="return confirm('Are you sure you want to delete <?php echo htmlspecialchars($rw['name']); ?>?');">
                            <input type="hidden" name="delete_id" value="<?php echo $rw['id']; ?>">
                            <input type="submit" value="Delete" style="padding: 5px 10px; background: #ff523b; color: #fff; border: none; border-radius: 20px; font-family: 'Poppins', sans-serif; font-size: 12px; cursor: pointer;">
                        </form>
                    </td>
                    <td class="hidecol" style="border: 1px solid #ddd; padding: 10px;">
                        <a href="update_form.php?id=<?php echo $rw['id']; ?>" style="color: #ff523b; text-decoration: none;"><i class="fa fa-pencil"></i></a>
                    </td>
                </tr>
            <?php
                }
            } else {
                echo '<tr><td colspan="7" style="border: 1px solid #ddd; padding: 10px; text-align: center;">No users found.</td></tr>';
            }
            mysqli_stmt_close($stmt);
            ?>
        </table>
    </div>

    <script>
        function openprint() {
            $('.hidecol').addClass('hidden');
            $('#print-title').removeClass('hidden');
            window.print();
            $('.hidecol').removeClass('hidden');
            $('#print-title').addClass('hidden');
        }

        $(document).ready(function() {
            $('input[type="submit"], #print').on('mouseenter', function() {
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
