<title> 2020 قهوة العمدة</title>

</style>
<link rel="stylesheet" id="compiled.css-css" href="https://z9t4u9f6.stackpathcdn.com/wp-content/themes/mdbootstrap4/css/compiled-4.13.0.min.css?ver=4.13.0" type="text/css" media="all">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>

<!--Navbar -->
<nav class="mb-1 navbar navbar-expand-lg navbar-dark indigo">
    <!-- <a class="navbar-brand" href="#">cafe</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent-555" aria-controls="navbarSupportedContent-555" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button> -->
    <div class="collapse navbar-collapse" id="navbarSupportedContent-555">
        <ul class="navbar-nav mr-auto">
            <!-- <li class="nav-item active">
        <a class="nav-link waves-effect waves-light" href="#">Home
          <span class="sr-only">(current)</span>
        </a>
      </li> -->
            <li class="nav-item">
                <a class="nav-link waves-effect waves-light" href="../userHomePage/userHomePage.php">Home</a>
            </li>
            <li class="nav-item">
                <a class="nav-link waves-effect waves-light" href="../userOrders/userOrders.php">Orders</a>
            </li>
        </ul>
        <ul class="navbar-nav ml-auto nav-flex-icons">
            <li class="nav-item avatar dropdown">
                <a class="nav-link dropdown-toggle waves-effect waves-light" id="navbarDropdownMenuLink-55" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <img src="../../Images/<?= $userImg ?>" class="rounded-circle z-depth-0" alt="<?= $userName ?>">
                </a>
                <div class="dropdown-menu dropdown-menu-lg-right dropdown-secondary" aria-labelledby="navbarDropdownMenuLink-55">
                    <a class="dropdown-item waves-effect waves-light" href="../../login/logOut.php">Log Out</a>
                </div>
            </li>
            <li class="nav-item">
                <a class="nav-link waves-effect waves-light" href="#"><?= $userName ?></a>
            </li>
        </ul>
    </div>
</nav>
<!--/.Navbar -->


<!--/.Navbar -->
<!-- <div class="topnav">
    <a class="active" href="../showOrders/ordersforuser.php">Home</a>
    <a href="../product/allProducts.php">Products</a>
    <a href="../addusers/alluserspage.php">Users</a>
    <a href="../adminOrder/adminOrderPage.php">Manual Order</a>
    <a href="../checks/checks.php">Checks</a>
    
    <div class="topnav-right">
        <?php echo "<img src='../../Images/{$userImg}' height='40' width='40'>$userName"; ?>
        <a href="../../login/logOut.php">Log Out</a>
</div>
</div> -->