<?php

    include 'includes/db.php';

    include 'includes/functions.php';

    include 'includes/header2.php';


          $show = viewtopselling($conn);

          $reveal = viewtrending($conn);
          
        //  $open = viewtrending($conn);

  

?>
   <div class="top-bar">
    <div class="top-nav">
      <a href="index.html"><h3 class="brand"><span>B</span>rain<span>F</span>ood</h3></a>
      <ul class="top-nav-list">
        <li class="top-nav-listItem Home"><a href="index.html">Home</a></li>
        <li class="top-nav-listItem catalogue"><a href="catalogue.html">Catalogue</a></li>
        <li class="top-nav-listItem login"><a href="login.html">Login</a></li>
        <li class="top-nav-listItem register"><a href="registration.html">Register</a></li>
        <li class="top-nav-listItem cart">
          <div class="cart-item-indicator">
            <p></p>
          </div>
          <a href="cart.html">Cart</a>
        </li>
      </ul>
      <form class="search-brainfood">
        <input type="text" class="text-field" placeholder="Search all books">
      </form>
    </div>
  </div>
  <!-- main content starts here -->

  <div class="main">
    <div class="book-display">
      <div class="display-book" style="background: url('<?php echo $show['book_image'];?>');"></div>
      <div class="info">
        <h2 class="book-title"><?php echo $show['title'];?></h2>
        <h3 class="book-author"><?php echo $show['author']; ?></h3>
        <h3 class="book-price"><?php echo $show['price'];?></h3> 

        <form>
          <label for="book-amout">Amount</label>
          <input type="number" class="book-amount text-field">
          <input class="def-button add-to-cart" type="submit" name="" value="Add to cart">
        </form>
      </div>
    </div>
    <div class="trending-books horizontal-book-list">
      <h3 class="header">Trending</h3>
      <ul class="book-list">
        <li class="book">
          <a href="#"><div class="book-cover" style="background: url('<?php echo $reveal['book_image'];?>');"></div></a>
          <div class="book-price"><p><?php echo $reveal['price'];?></p></div>
        </li>
        <li class="book">
          <a href="#"><div class="book-cover" style="background: url('<?php echo $reveal['book_image'];?>');"></div></a>
          <div class="book-price"><p><?php echo $reveal['price'];?></p></div>
        </li>
        <li class="book">
          <a href="#"><div class="book-cover"></div></a>
          <div class="book-price"><p>$250</p></div>
        </li>
        <li class="book">
          <a href="#"><div class="book-cover"></div></a>
          <div class="book-price"><p>$50</p></div>
        </li>
      </ul>
    </div>
    <div class="recently-viewed-books horizontal-book-list">
      <h3 class="header">Recently Viewed</h3>
      <ul class="book-list">
        <div class="scroll-back"></div>
        <div class="scroll-front"></div>
        <li class="book">
          <a href="#"><div class="book-cover"></div></a>
          <div class="book-price"><p>$250</p></div>
        </li>
        <li class="book">
          <a href="#"><div class="book-cover"></div></a>
          <div class="book-price"><p>$50</p></div>
        </li>
        <li class="book">
          <a href="#"><div class="book-cover"></div></a>
          <div class="book-price"><p>$125</p></div>
        </li>
        <li class="book">
          <a href="#"><div class="book-cover"></div></a>
          <div class="book-price"><p>$90</p></div>
        </li>
      </ul>
    </div>
    
  </div>
  <!-- footer starts here-->
 <?php
  include 'includes/footer2.php';
 ?>
