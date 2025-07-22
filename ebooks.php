<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
include('connection.php');

$books_per_page = 4;
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$offset = ($page - 1) * $books_per_page;

$total_books_query = mysqli_query($conn, "SELECT COUNT(*) as total FROM books");
$total_books = mysqli_fetch_assoc($total_books_query)['total'];
$total_pages = ceil($total_books / $books_per_page);

$books = [];
$result = mysqli_query($conn, "SELECT * FROM books LIMIT $books_per_page OFFSET $offset");
if ($result) {
    while ($row = mysqli_fetch_assoc($result)) {
        $books[] = $row;
    }
} else {
    error_log("Error fetching books: " . mysqli_error($conn), 3, "C:/wamp/logs/php_query.log");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>All Books | Ebookstore</title>
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
        .small-container {
            max-width: 1080px;
            margin: auto;
            padding: 0 25px;
        }
        .row {
            display: flex;
            flex-wrap: wrap;
            justify-content: space-between;
        }
        .row-2 {
            justify-content: space-between;
            margin: 50px 0 20px;
        }
        .row-2 h2 {
            color: #ff523b;
            font-size: 28px;
        }
        .search-sort {
            display: flex;
            align-items: center;
        }
        #searchInput {
            padding: 8px;
            border: 1px solid #ff523b;
            border-radius: 5px;
            margin-right: 10px;
            font-size: 14px;
        }
        #sortSelect {
            padding: 8px;
            border: 1px solid #ff523b;
            border-radius: 5px;
            font-size: 14px;
        }
        .col-4 {
            flex: 1;
            min-width: 200px;
            margin: 10px;
            text-align: center;
            background: #fff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            border-radius: 10px;
            padding: 15px;
        }
        .col-4 img {
            max-width: 100%;
            border-radius: 10px;
        }
        .col-4 h4 {
            color: #555;
            font-size: 16px;
            margin: 10px 0;
        }
        .col-4 p {
            color: #ff523b;
            font-size: 14px;
            font-weight: 600;
        }
        .col-4 .rating {
            color: #ff523b;
            margin: 10px 0;
        }
        .add-to-cart {
            padding: 10px 20px;
            background: #ff523b;
            color: #fff;
            border: none;
            border-radius: 30px;
            font-size: 14px;
            cursor: pointer;
            transition: background 0.3s, transform 0.3s;
        }
        .add-to-cart:hover {
            background: #ff7a68;
            transform: scale(1.05);
        }
        .youtube-container {
            margin: 50px 0;
        }
        .youtube-row {
            display: flex;
            align-items: center;
            flex-wrap: wrap;
        }
        .col-2 {
            flex: 1;
            min-width: 300px;
            padding: 20px;
        }
        .col-2 h2 {
            color: #ff523b;
            font-size: 24px;
        }
        .col-2 iframe {
            width: 100%;
            max-width: 560px;
            height: 315px;
        }
        .page-btn {
            text-align: center;
            margin: 20px 0;
        }
        .page-btn a {
            display: inline-block;
            border: 1px solid #ff523b;
            margin: 0 5px;
            width: 40px;
            height: 40px;
            line-height: 40px;
            cursor: pointer;
            border-radius: 5px;
            text-decoration: none;
            color: #555;
        }
        .page-btn a:hover, .page-btn a.active {
            background: #ff523b;
            color: #fff;
        }
        .footer {
            background: #000;
            color: #8a8a8a;
            font-size: 14px;
            padding: 60px 0 20px;
        }
        .footer .container {
            max-width: 1080px;
        }
        .footer .row {
            display: flex;
            flex-wrap: wrap;
            justify-content: space-between;
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
        .footer h3 {
            color: #fff;
            margin-bottom: 20px;
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
            .col-4 {
                min-width: 45%;
            }
        }
        @media only screen and (max-width: 600px) {
            .container {
                width: 90%;
            }
            .col-4 {
                min-width: 100%;
            }
            .youtube-row {
                flex-direction: column;
            }
            .col-2 {
                min-width: 100%;
            }
        }
    </style>
</head>
<body>
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

    <div class="small-container">
        <div class="row row-2">
            <h2>All Ebooks</h2>
            <div class="search-sort">
                <input type="text" id="searchInput" placeholder="Search books...">
                <select id="sortSelect">
                    <option value="default">Default sorting</option>
                    <option value="price-asc">Sort by price: low to high</option>
                    <option value="price-desc">Sort by price: high to low</option>
                    <option value="rating">Sort by rating</option>
                    <option value="title">Sort by title</option>
                </select>
            </div>
        </div>

        <div class="row" id="bookList">
            <?php foreach ($books as $book): ?>
                <div class="col-4" data-title="<?php echo htmlspecialchars($book['title']); ?>" data-price="<?php echo $book['price']; ?>" data-rating="<?php echo $book['rating']; ?>">
                    <a href="<?php echo htmlspecialchars($book['detail_page']); ?>">
                        <img src="<?php echo htmlspecialchars($book['image']); ?>" alt="<?php echo htmlspecialchars($book['title']); ?>">
                    </a>
                    <a href="<?php echo htmlspecialchars($book['detail_page']); ?>"><h4><?php echo htmlspecialchars($book['title']); ?></h4></a>
                    <div class="rating">
                        <?php
                        $rating = $book['rating'];
                        for ($i = 1; $i <= 5; $i++) {
                            if ($rating >= $i) {
                                echo '<i class="fa fa-star"></i>';
                            } elseif ($rating >= $i - 0.5) {
                                echo '<i class="fa fa-star-half-o"></i>';
                            } else {
                                echo '<i class="fa fa-star-o"></i>';
                            }
                        }
                        ?>
                    </div>
                    <p>Rs.<?php echo number_format($book['price'], 2); ?></p>
                    <button class="add-to-cart" data-id="<?php echo $book['id']; ?>" data-title="<?php echo htmlspecialchars($book['title']); ?>" data-price="<?php echo $book['price']; ?>" data-image="<?php echo htmlspecialchars($book['image']); ?>">Add to Cart</button>
                </div>
            <?php endforeach; ?>
        </div>

        <div class="page-btn">
            <?php for ($i = 1; $i <= $total_pages; $i++): ?>
                <a href="ebooks.php?page=<?php echo $i; ?>" class="<?php echo $i === $page ? 'active' : ''; ?>"><?php echo $i; ?></a>
            <?php endfor; ?>
            <?php if ($page < $total_pages): ?>
                <a href="ebooks.php?page=<?php echo $page + 1; ?>">→</a>
            <?php endif; ?>
            <?php if ($page > 1): ?>
                <a href="ebooks.php?page=<?php echo $page - 1; ?>">←</a>
            <?php endif; ?>
        </div>
    </div>

    <div class="youtube-container">
        <div class="youtube-row">
            <div class="col-2">
                <h2>5 Books You Must Read If You're Serious About Success</h2>
            </div>
            <div class="col-2">
                <iframe
                    id="youtubevideo"
                    width="560"
                    height="315"
                    src="https://www.youtube.com/embed/LqJBXtG9xxk"
                    frameborder="0"
                    allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                    allowfullscreen
                ></iframe>
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
                        <img src="images/Playstore.png">
                        <img src="images/Applestore.png">
                    </div>
                </div>
                <div class="footer-col-2">
                    <img src="images/EbookStore-Logo-footer.png">
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

        const cart = JSON.parse(localStorage.getItem('cart')) || [];
        function updateCartCount() {
            const cartCount = cart.reduce((total, item) => total + item.quantity, 0);
            document.getElementById('cartCount').textContent = cartCount;
        }
        updateCartCount();

        document.querySelectorAll('.add-to-cart').forEach(button => {
            button.addEventListener('click', () => {
                const book = {
                    id: button.dataset.id,
                    title: button.dataset.title,
                    price: parseFloat(button.dataset.price),
                    image: button.dataset.image,
                    quantity: 1
                };
                const existingBook = cart.find(item => item.id === book.id);
                if (existingBook) {
                    existingBook.quantity++;
                } else {
                    cart.push(book);
                }
                localStorage.setItem('cart', JSON.stringify(cart));
                updateCartCount();
                alert(`${book.title} added to cart!`);
            });
        });

        document.getElementById('searchInput').addEventListener('input', function(e) {
            const searchTerm = e.target.value.toLowerCase();
            const books = document.querySelectorAll('.col-4');
            books.forEach(book => {
                const title = book.dataset.title.toLowerCase();
                book.style.display = title.includes(searchTerm) ? 'block' : 'none';
            });
        });

        document.getElementById('sortSelect').addEventListener('change', function(e) {
            const sortBy = e.target.value;
            const bookList = document.getElementById('bookList');
            const books = Array.from(bookList.querySelectorAll('.col-4'));
            books.sort((a, b) => {
                if (sortBy === 'price-asc') return parseFloat(a.dataset.price) - parseFloat(b.dataset.price);
                if (sortBy === 'price-desc') return parseFloat(b.dataset.price) - parseFloat(a.dataset.price);
                if (sortBy === 'rating') return parseFloat(b.dataset.rating) - parseFloat(a.dataset.rating);
                if (sortBy === 'title') return a.dataset.title.localeCompare(b.dataset.title);
                return 0;
            });
            bookList.innerHTML = '';
            books.forEach(book => bookList.appendChild(book));
        });
    </script>
</body>
</html>