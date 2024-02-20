<header id="header">
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <a href="index.php" class="navbar-brand">
      <h3 class="px-5">
        <i class="fas fa-building"></i>  Gamal Restaurant
      </h3>
    </a>
    <button class="navbar-toggler"
      type="button"
      data-toggle="collapse"
      data-target="#navbarNavAltMarkup"
      aria-controls="navbarNavAltMarkup"
      aria-label="Toggle navigation"
      aria-expanded="false">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="navbar-nav ml-auto">
      <a href="cart.php" class="nav-item nav-link active">
        <h5 class="mr-2 px-5">
          <i class="fas fa-solid fa-bell"></i>  cart
          <?php
          if (isset($_SESSION['cart'])) {
            $count = count($_SESSION['cart']);
           
            echo "<span id=\"cart_count\" class=\"text-warning bg-light\">$count</span>";
          } else {
            echo "<span id=\"cart_count\" class=\"text-warning bg-light\">0</span>";
          }
          ?>
        </h5>
      </a>
      <a class="btn btn-primary" href="login.html" role="button">login</a>
    </div>
  </nav>
</header>
