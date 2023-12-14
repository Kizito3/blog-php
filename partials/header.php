<?php require 'config/database.php'; 

if(isset($_SESSION['user-id'])) {
  $id = $_SESSION['user-id'];
  $query_user = "select avatar from users where id = '$id' ";
  $result_user = mysqli_query($conn,$query_user);
  $row = mysqli_fetch_assoc($result_user);
}
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Blog website</title>
    <!-- CSS LINK -->
    <link rel="stylesheet" href="css/style.css" />

    <!-- ===========================ICONSCOUT CDN ================= -->
    <link
      rel="stylesheet"
      href="https://unicons.iconscout.com/release/v4.0.8/css/line.css"
    />

    <!-- ====================== GOOGLE FONTS ============================ -->
    <link
      href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;500;600;700;800;900&display=swap"
      rel="stylesheet"
    />
  </head>
  <body>
    <!-- ==================== NAV SECTION ======================= -->
    <nav>
      <div class="container nav__container">
        <a href="<?= ROOT_URL?>" class="nav__logo">Blogamania</a>
        <ul class="nav__items">
          <li><a href="<?= ROOT_URL?>blog.php">Blog</a></li>
          <li><a href="<?= ROOT_URL?>about.php">About</a></li>
          <li><a href="<?= ROOT_URL?>services.php">Services</a></li>
          <li><a href="<?= ROOT_URL?>contact.php">Contact</a></li>
          <?php if(isset($_SESSION['user-id'])) : ?>

<li class="nav__profile">
<div class="avatar">
  <img src="<?= ROOT_URL . 'images/' . $row['avatar'] ?>" alt="" />
</div>
<ul>
  <li><a href="<?= ROOT_URL?>/admin/index.php">Dashboard</a></li>
  <li><a href="<?= ROOT_URL?>logout.php">LogOut</a></li>
</ul>
</li>
<?php else : ?>
<li><a href="<?= ROOT_URL?>sign-in.php">Sign In</a></li>
<?php endif ?>
        </ul>

        <i id="open__nav-btn"><i class="uil uil-bars"></i></i>
        <i id="close__nav-btn"><i class="uil uil-times"></i></i>
      </div>
    </nav>

    <!-- ==================== END OF NAV SECTION ======================= -->
