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
        <a href="index.php" class="nav__logo">GOZIRIM</a>
        <ul class="nav__items">
          <li><a href="blog.php">Blog</a></li>
          <li><a href="about.php">About</a></li>
          <li><a href="services.php">Services</a></li>
          <li><a href="contact.php">Contact</a></li>
          <!-- <li><a href="sign-in.php">Sign In</a></li> -->
          <li class="nav__profile">
            <div class="avatar">
              <img src="images/avatar1.jpg" alt="" />
            </div>
            <ul>
              <li><a href="dashboard.php">Dashboard</a></li>
              <li><a href="logout.php">LogOut</a></li>
            </ul>
          </li>
        </ul>

        <button id="open__nav-btn"><i class="uil uil-bars"></i></button>
        <button id="close__nav-btn"><i class="uil uil-times"></i></button>
      </div>
    </nav>

    <!-- ==================== END OF NAV SECTION ======================= -->

    <section class="singlepost">
      <div class="container singlepost__container">
        <h2>Lorem ipsum dolor sit amet consectetur.</h2>
        <div class="post__author">
          <div class="post__author-avatar">
            <img src="images/avatar2.jpg" alt="" />
          </div>
          <div class="post__author-info">
            <h5>By: mary onubuogu</h5>
            <small>Dec 6 2023 - 07:23 </small>
          </div>
        </div>

        <div class="singlepost__thumbnail">
          <img src="images/blog33.jpg" alt="" />
        </div>
        <p>
          Lorem ipsum, dolor sit amet consectetur adipisicing elit. Similique
          quasi est eligendi exercitationem itaque, harum earum natus eveniet
          fugit recusandae? Vero temporibus quidem repellat asperiores. Dolorum
          et aliquid ipsum tenetur. Minima nobis tempore reprehenderit dolorem
          error praesentium corrupti qui cum.
        </p>
        <p>
          Lorem ipsum, dolor sit amet consectetur adipisicing elit. Similique
          quasi est eligendi exercitationem itaque, harum earum natus eveniet
          fugit recusandae? Vero temporibus quidem repellat asperiores. Dolorum
          et aliquid ipsum tenetur. Minima nobis tempore reprehenderit dolorem
          error praesentium corrupti qui cum.
        </p>
        <p>
          Lorem ipsum, dolor sit amet consectetur adipisicing elit. Similique
          quasi est eligendi exercitationem itaque, harum earum natus eveniet
          fugit recusandae? Vero temporibus quidem repellat asperiores. Dolorum
          et aliquid ipsum tenetur. Minima nobis tempore reprehenderit dolorem
          error praesentium corrupti qui cum.
        </p>
      </div>
    </section>

    <!-- ==================== FOOTER SECTION ======================= -->
    <?php include("partials/footer.php"); ?>

    <script src="js/main.js"></script>
  </body>
</html>
