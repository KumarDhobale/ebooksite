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
          <img src="images/Book 8.jpg" alt="A Children's Bible" width="68%" />
        </div>
        <div class="col-2">
          <p>Home / Ebook</p>
          <h1>A Children's Bible by Lydia Millet</h1>
          <h4>Rs.550</h4>
          <div class="rating">
            <i class="fa fa-star"></i>
            <i class="fa fa-star"></i>
            <i class="fa fa-star"></i>
            <i class="fa fa-star"></i>
            <i class="fa fa-star-o"></i>
          </div>
          <input type="number" value="1" min="1" id="quantity" />
          <a href="#" class="btn add-to-cart" data-id="5" data-title="A Children's Bible" data-price="550" data-image="images/Book 8.jpg" style="padding: 10px 20px; background: #ff523b; color: #fff; border: none; border-radius: 30px; font-size: 14px; cursor: pointer; transition: background 0.3s, transform 0.3s; text-decoration: none;">Add To Cart</a>
          <h3>Book Details <i class="fa fa-indent"></i></h3>
          <br />
          <p>
            A Children's Bible is a climate fiction novel by Lydia Millet that documents the experience of a group of children in the face of climate change as their parents fail to respond to a climate-charged hurricane. It was her 13th novel.
            Eve, the novel's narrator, belongs to a group of children staying at a large, rented estate with their parents for the summer. The children, mostly disgusted by their parents' hedonistic behavior, spend most of their time on the property of the estate, until a hurricane interrupts their activities. The parents are never named, and the book filters their activities through the perception of Eve and the other children.
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
        <div class="col-4" data-title="A Children's Bible" data-price="550" data-rating="4">
          <a href="book-detail5.php">
            <img src="images/Book 8.jpg" alt="A Children's Bible" />
          </a>
          <h4>A Children's Bible</h4>
          <div class="rating">
            <i class="fa fa-star"></i>
            <i class="fa fa-star"></i>
            <i class="fa fa-star"></i>
            <i class="fa fa-star"></i>
            <i class="fa fa-star-o"></i>
          </div>
          <p>Rs.550</p>
        </div>
        <div class="col-4" data-title="The Sword and the Shield" data-price="600" data-rating="3.5">
          <a href="book-detail6.php">
            <img src="images/Book 9.jpg" alt="The Sword and the Shield" />
          </a>
          <h4>The Sword and the Shield</h4>
          <div class="rating">
            <i class="fa fa-star"></i>
            <i class="fa fa-star"></i>
            <i class="fa fa-star"></i>
            <i class="fa fa-star-half-o"></i>
            <i class="fa fa-star-o"></i>
          </div>
          <p>Rs.600</p>
        </div>
        <div class="col-4" data-title="Begin Again" data-price="525" data-rating="4.5">
          <a href="book-detail7.php">
            <img src="images/Book 10.jpg" alt="Begin Again" />
          </a>
          <h4>Begin Again</h4>
          <div class="rating">
            <i class="fa fa-star"></i>
            <i class="fa fa-star"></i>
            <i class="fa fa-star"></i>
            <i class="fa fa-star"></i>
            <i class="fa fa-star-half-o"></i>
          </div>
          <p>Rs.525</p>
        </div>
        <div class="col-4" data-title="The Address Book" data-price="575" data-rating="4">
          <a href="book-detail8.php">
            <img src="images/Book 11.jpg" alt="The Address Book" />
          </a>
          <h4>The Address Book</h4>
          <div class="rating">
            <i class="fa fa-star"></i>
            <i class="fa fa-star"></i>
            <i class="fa fa-star"></i>
            <i class="fa fa-star"></i>
            <i class="fa fa-star-o"></i>
          </div>
          <p>Rs.575</p>
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