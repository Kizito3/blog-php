<?php require 'config/constants.php'; 

// GET BACK FROM THE DATA IF THERE WAS AN ERROR
$firstname = $_SESSION['signup-data']['firstname'] ?? null;
$lastname = $_SESSION['signup-data']['lastname'] ?? null;
$username = $_SESSION['signup-data']['username'] ?? null;
$email = $_SESSION['signup-data']['email'] ?? null;
$password = $_SESSION['signup-data']['password'] ?? null;
$confirmpassword = $_SESSION['signup-data']['confirmpassword'] ?? null;
unset($_SESSION['signup-data']);
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
    <section class="form__section">
      <div class="container form__section-container">
        <h2>Sign Up</h2>
        <?php
          if(isset($_SESSION['signup'])): ?> 
            <div class="alert__message error"><p><?= $_SESSION['signup'];
            unset($_SESSION['signup']);?></p>
          </div>
          <?php endif ?> 
            
        <form action="<?= ROOT_URL?>proc_signup.php" method="post" enctype="multipart/form-data">
          <input type="text" name="firstname" value="<?= $firstname?>" placeholder="First Name" />
          <input type="text" name="lastname" value="<?= $lastname?>"placeholder="Last Name" />
          <input type="text" name="username" value="<?= $username?>"  placeholder="Username" />
          <input type="email" name="email" value="<?= $email?>"  placeholder="Email" />
          <input type="password" name="password" value="<?= $password?>"  placeholder="Create Password" />
          <input type="password" name="confirmpassword" value="<?= $confirmpassword?>"  placeholder="Confirm Password" />
          <div class="form__control">
            <label for="avatar">User Avatar</label>
            <input type="file" name="avatar" id="avatar" />
          </div>
          <button class="btn" name="submit" type="submit">Sign Up</button>
          <small
            >Already have an account? <a href="sign-in.php">sign In</a></small
          >
        </form>
      </div>
    </section>
  </body>
</html>
