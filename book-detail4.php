<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Book-detailpage | Ebookstore</title>
    <link rel="icon" type="image/png" href="images/favicon.png">
    <link rel="stylesheet" href="style.css" />
    <link rel="preconnect" href="https://fonts.gstatic.com" />
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,200;0,300;0,400;0,500;0,600;1,100;1,200;1,300;1,400;1,500;1,600&display=swap" rel="stylesheet"/>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css"/>
  </head>
<style>
    body {
            background: radial-gradient(#fff, #ffd6d6);
            overflow-x: hidden;
        }

    .add-to-cart{
      background: #ff523b;
      color: White;
      Padding: 10px 20px;
      Border: None;
      Border-radius: 30px;
      font-size: 14px;
      cursor: Pointer;
   }

   .cart-link {
    position: relative;
    display: inline-block;
}

.cart-count {
    position: absolute;
    top: 40px;
    right: 145px;
    background: #ff523b;
    color: #fff;
    border-radius: 50%;
    padding: 2px 8px;
    font-size: 12px;
    font-weight: 600;
}
  
  </style>
  <body>
    <div class="container">
      <div class="navbar">
        <div class="logo">
          <a href="index.html">
            <img src="images/EbookStore-Logo.png" alt="EbookStore-Logo" />
          </a>
        </div>
        <nav>
          <ul id="MenuItems">
            <li><a class="nav_link" href="index.html">Home</a></li>
            <li><a class="nav_link" href="ebooks.php">Ebooks</a></li>
            <li><a class="nav_link" href="about.html">About</a></li>
            <li><a class="nav_link" href="contact.php">Contact</a></li>
          </ul>
        </nav>
        <a href="cart.html">
          <img src="images/cart.png" alt="Shopping Cart" width="28px" height="28px" style="margin-left: 10px; margin-top: 15px" />
          <span id="cartCount" class="cart-count">0</span>
        </a>
        <img src="images/menu.png" class="menu-icon" onclick="menutoggle()" />
      </div>
    </div>

    <div class="small-container single-product">
      <div class="row">
        <div class="col-2">
          <img src="images/Book 7.jpg" alt="The Hobbit" width="68%" />
        </div>
        <div class="col-2">
          <p>Home / Ebook</p>
          <h1>The Hobbit by J. R. R. Tolkien</h1>
          <h4>Rs.449</h4>
          <div class="rating">
            <i class="fa fa-star"></i>
            <i class="fa fa-star"></i>
            <i class="fa fa-star"></i>
            <i class="fa fa-star"></i>
            <i class="fa fa-star-o"></i>
          </div>
          <input type="number" value="1" min="1" id="quantity" />
          <a href="#" class="btn add-to-cart" data-id="4" data-title="The Hobbit" data-price="449" data-image="images/Book 7.jpg" style="padding: 10px 20px; background: #ff523b; color: #fff; border: none; border-radius: 30px; font-size: 14px; cursor: pointer; transition: background 0.3s, transform 0.3s; text-decoration: none;">Add To Cart</a>
          <h3>Book Details <i class="fa fa-indent"></i></h3>
          <br />
          <p>
            The Hobbit, or There and Back Again is a children's fantasy novel by English author J. R. R. Tolkien. It was published in 1937 to wide critical acclaim, being nominated for the Carnegie Medal and awarded a prize from the New York Herald Tribune for best juvenile fiction. The book is recognized as a classic in children's literature, and is one of the best-selling books of all time with over 100 million copies sold.

            The Hobbit is set in Middle-earth and follows home-loving Bilbo Baggins, the hobbit of the title, who joins the wizard Gandalf and thirteen dwarves that make up Thorin Oakenshield's Company, on a quest to reclaim the dwarves' home and treasure from the dragon Smaug. Bilbo's journey takes him from his peaceful rural surroundings into more sinister territory.
          </p>
        </div>
      </div>
    </div>

    <div class="small-container">
      <div class="row row-2">
        <h2>Related Books</h2>
        <p><a href="ebooks.php">View More</a></p>
      </div>
    </div>
    
    <div class="small-container">
      <div class="row">
        <div class="col-4" data-title="The Hobbit" data-price="449" data-rating="4">
          <a href="book-detail4.php">
            <img src="images/Book 7.jpg" alt="The Hobbit" />
          </a>
          <h4>The Hobbit</h4>
          <div class="rating">
            <i class="fa fa-star"></i>
            <i class="fa fa-star"></i>
            <i class="fa fa-star"></i>
            <i class="fa fa-star"></i>
            <i class="fa fa-star-o"></i>
          </div>
          <p>Rs.449</p>
        </div>
        <div class="col-4" data-title="Anna Karenina" data-price="499" data-rating="4">
          <a href="book-detail1.php">
            <img src="images/Book 4.jpg" alt="Anna Karenina" />
          </a>
          <h4>Anna Karenina</h4>
          <div class="rating">
            <i class="fa fa-star"></i>
            <i class="fa fa-star"></i>
            <i class="fa fa-star"></i>
            <i class="fa fa-star"></i>
            <i class="fa fa-star-o"></i>
          </div>
          <p>Rs.499</p>
        </div>
        <div class="col-4" data-title="Watership Down" data-price="399" data-rating="3.5">
          <a href="book-detail2.php">
            <img src="images/Book 5.jpg" alt="Watership Down" />
          </a>
          <h4>Watership Down</h4>
          <div class="rating">
            <i class="fa fa-star"></i>
            <i class="fa fa-star"></i>
            <i class="fa fa-star"></i>
            <i class="fa fa-star-half-o"></i>
            <i class="fa fa-star-o"></i>
          </div>
          <p>Rs.399</p>
        </div>
        <div class="col-4" data-title="All The Light We Cannot See" data-price="599" data-rating="4.5">
          <a href="book-detail3.php">
            <img src="images/Book 6.jpg" alt="All The Light We Cannot See" />
          </a>
          <h4>All The Light We Cannot See</h4>
          <div class="rating">
            <i class="fa fa-star"></i>
            <i class="fa fa-star"></i>
            <i class="fa fa-star"></i>
            <i class="fa fa-star"></i>
            <i class="fa fa-star-half-o"></i>
          </div>
          <p>Rs.599</p>
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
              <img src="images/Playstore.png" alt="Play Store" />
              <img src="images/Applestore.png" alt="App Store" />
            </div>
          </div>
          <div class="footer-col-2">
            <img src="images/EbookStore-Logo-footer.png" alt="EbookStore Footer Logo" />
            <p>
              Lorem ipsum, dolor sit amet consectetur adipisicing elit.
              Reiciendis, Lorem ipsum dolor sit amet.
            </p>
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
        <hr />
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

      // Cart functionality
      const cart = JSON.parse(localStorage.getItem('cart')) || [];

      function saveCart() {
        localStorage.setItem('cart', JSON.stringify(cart));
      }

      function updateCartCount() {
        const cartCount = cart.reduce((total, item) => total + item.quantity, 0);
        document.getElementById('cartCount').textContent = cartCount;
      }

      document.querySelectorAll('.add-to-cart').forEach(button => {
        button.addEventListener('click', (e) => {
          e.preventDefault();
          const quantityInput = document.getElementById('quantity');
          const quantity = parseInt(quantityInput.value) || 1;
          const book = {
            id: button.dataset.id,
            title: button.dataset.title,
            price: parseFloat(button.dataset.price),
            image: button.dataset.image,
            quantity: quantity
          };

          const existingBook = cart.find(item => item.id === book.id);
          if (existingBook) {
            existingBook.quantity += quantity;
          } else {
            cart.push(book);
          }

          saveCart();
          updateCartCount();
          alert(`${book.title} added to cart!`);
        });
      });

      // Initialize cart count on page load
      updateCartCount();
    </script>
  </body>
</html>