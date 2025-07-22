<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
include('connection.php');

$success_message = '';
$error_message = '';

if (isset($_POST['submit'])) {
    $id = mysqli_real_escape_string($conn, $_POST['id']);
    $price = mysqli_real_escape_string($conn, $_POST['price']);
    $sq = "UPDATE books SET price='$price' WHERE id='$id'";
    error_log("Query: $sq", 3, "C:/wamp/logs/php_query.log");
    if (mysqli_query($conn, $sq)) {
        $success_message = "Price updated successfully for ID: $id";
    } else {
        $error_message = "Error updating price: " . mysqli_error($conn);
    }
}

$books = [];
$result = mysqli_query($conn, "SELECT id, title, price FROM books");
if ($result) {
    while ($row = mysqli_fetch_assoc($result)) {
        $books[] = $row;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Book Prices | Ebookstore</title>
    <link rel="icon" type="image/png" href="images/favicon.png">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@200;300;400;500;600&display=swap" rel="stylesheet">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Poppins', sans-serif;
        }
        body {
            background: radial-gradient(#fff, #ffd6d6);
            padding: 50px 0;
        }
        .container {
            width: 80%;
            margin: 0 auto;
            padding: 20px;
        }
        .price-box {
            background: #fff;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
            border-radius: 10px;
            padding: 40px;
        }
        h2 {
            color: #ff523b;
            font-size: 28px;
            text-align: center;
            margin-bottom: 20px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        th, td {
            padding: 10px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }
        th {
            background: #ff523b;
            color: #fff;
        }
        input[type="number"] {
            width: 100px;
            padding: 5px;
            border: 1px solid #ff523b;
            border-radius: 5px;
        }
        button {
            padding: 8px 20px;
            background: #ff523b;
            color: #fff;
            border: none;
            border-radius: 30px;
            cursor: pointer;
            transition: background 0.3s;
        }
        button:hover {
            background: #ff7a68;
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
        @media only screen and (max-width: 600px) {
            .container {
                width: 90%;
            }
            table, th, td {
                font-size: 14px;
            }
            input[type="number"] {
                width: 80px;
            }
        }
    </style>
</head>
<body>
    <button class="back-btn" onclick="window.location.href='admin_dashboard.php'">Back to Dashboard</button>
    <div class="container">
        <h2>Update Book Prices</h2>
        <?php if ($success_message): ?>
            <p class="success-message"><?php echo htmlspecialchars($success_message); ?></p>
        <?php endif; ?>
        <?php if ($error_message): ?>
            <p class="error-message"><?php echo htmlspecialchars($error_message); ?></p>
        <?php endif; ?>
        <div class="price-box">
            <table>
                <tr>
                    <th>ID</th>
                    <th>Title</th>
                    <th>Current Price</th>
                    <th>New Price</th>
                    <th>Action</th>
                </tr>
                <?php foreach ($books as $book): ?>
                    <tr>
                        <form method="POST">
                            <td><?php echo htmlspecialchars($book['id']); ?></td>
                            <td><?php echo htmlspecialchars($book['title']); ?></td>
                            <td>Rs.<?php echo number_format($book['price'], 2); ?></td>
                            <td>
                                <input type="number" name="price" step="0.01" min="0" value="<?php echo htmlspecialchars($book['price']); ?>" required>
                                <input type="hidden" name="id" value="<?php echo htmlspecialchars($book['id']); ?>">
                            </td>
                            <td><button type="submit" name="submit">Update</button></td>
                        </form>
                    </tr>
                <?php endforeach; ?>
            </table>
        </div>
    </div>
</body>
</html>