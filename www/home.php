<?php

    include 'includes/db.php';

    include 'includes/functions.php';

    include 'includes/header2.php';


         

?>
  
  <!-- main content starts here -->

  <div class="main">
    <div class="book-display">
      <?php   $show = viewtopselling($conn); echo $show; ?>
  
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
        <?php $bring = viewtrending($conn); echo $bring;?>
      </ul>
    </div>
    <div class="recently-viewed-books horizontal-book-list">
      <h3 class="header">Recently Viewed</h3>
      <ul class="book-list">
        <div class="scroll-back"></div>
        <div class="scroll-front"></div>
        <?php $receive = recentlyviewed($conn); echo $receive; ?>
      </ul>
    </div>
    
  </div>
  <!-- footer starts here-->
 <?php
  include 'includes/footer2.php';
 ?>
