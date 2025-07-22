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
          <img src="images/Book 15.jpg" alt="The Help" width="68%" />
        </div>
        <div class="col-2">
          <p>Home / Ebook</p>
          <h1>The Help by Kathryn Stockett</h1>
          <h4>Rs.580</h4>
          <div class="rating">
            <i class="fa fa-star"></i>
            <i class="fa fa-star"></i>
            <i class="fa fa-star"></i>
            <i class="fa fa-star"></i>
            <i class="fa fa-star-o"></i>
          </div>
          <input type="number" value="1" min="1" id="quantity" />
          <a href="#" class="btn add-to-cart" data-id="12" data-title="The Help" data-price="580" data-image="images/Book 15.jpg" style="padding: 10px 20px; background: #ff523b; color: #fff; border: none; border-radius: 30px; font-size: 14px; cursor: pointer; transition: background 0.3s, transform 0.3s; text-decoration: none;">Add To Cart</a>
          <a href="payment.html" class="button">Purchase</a>
          <h3>Book Details <i class="fa fa-indent"></i></h3>
          <br />
          <p>
            The Help is a 2009 novel by Kathryn Stockett, set in 1960s Jackson, Mississippi, during the Civil Rights Movement. The story follows Eugenia "Skeeter" Phelan, a young white woman and aspiring journalist, who decides to write a book from the perspective of black maids, Aibileen Clark and Minny Jackson. The novel explores their relationships and the racism they face working for white families. Titled after the term "the help" used for black domestic workers, the book exposes the challenges and discrimination African Americans faced in 1960s America, blending emotional depth with social commentary.
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
        <div class="col-4" data-title="The Help" data-price="580" data-rating="4">
          <a href="book-detail12.php">
            <img src="images/Book 15.jpg" alt="The Help" />
          </a>
          <h4>The Help</h4>
          <div class="rating">
            <i class="fa fa-star"></i>
            <i class="fa fa-star"></i>
            <i class="fa fa-star"></i>
            <i class="fa fa-star"></i>
            <i class="fa fa-star-o"></i>
          </div>
          <p>Rs.580</p>
        </div>
        <div class="col-4" data-title="Nerve" data-price="550" data-rating="4">
          <a href="book-detail9.php">
            <img src="images/Book 12.jpg" alt="Nerve" />
          </a>
          <h4>Nerve</h4>
          <div class="rating">
            <i class="fa fa-star"></i>
            <i class="fa fa-star"></i>
            <i class="fa fa-star"></i>
            <i class="fa fa-star"></i>
            <i class="fa fa-star-o"></i>
          </div>
          <p>Rs.550</p>
        </div>
        <div class="col-4" data-title="Want" data-price="560" data-rating="3.5">
          <a href="book-detail10.php">
            <img src="images/Book 13.jpg" alt="Want" />
          </a>
          <h4>Want</h4>
          <div class="rating">
            <i class="fa fa-star"></i>
            <i class="fa fa-star"></i>
            <i class="fa fa-star"></i>
            <i class="fa fa-star-half-o"></i>
            <i class="fa fa-star-o"></i>
          </div>
          <p>Rs.560</p>
        </div>
        <div class="col-4" data-title="Just Us" data-price="570" data-rating="4.5">
          <a href="book-detail11.php">
            <img src="images/Book 14.jpg" alt="Just Us" />
          </a>
          <h4>Just Us</h4>
          <div class="rating">
            <i class="fa fa-star"></i>
            <i class="fa fa-star"></i>
            <i class="fa fa-star"></i>
            <i class="fa fa-star"></i>
            <i class="fa fa-star-half-o"></i>
          </div>
          <p>Rs.570</p>
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