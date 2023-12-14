<?php include("config/partials/header.php"); 

$firstname = $_SESSION['add-user-data']['firstname'] ?? null;
$lastname = $_SESSION['add-user-data']['lastname'] ?? null;
$username = $_SESSION['add-user-data']['username'] ?? null;
$email = $_SESSION['add-user-data']['email'] ?? null;
$password = $_SESSION['add-user-data']['password'] ?? null;
$confirmpassword = $_SESSION['add-user-data']['confirmpassword'] ?? null;
unset($_SESSION['add-user-data']);
?>

<section class="form__section">
  <div class="container form__section-container">
    <h2>Add User</h2>
    <?php if(isset($_SESSION['add-user'])) : ?>
      <div class="alert__message error">
      <p><?= $_SESSION['add-user']; unset($_SESSION['add-user']);?></p>
    </div>
    <?php endif ?>
    <form action="add-user-logic.php" method="post" enctype="multipart/form-data">
      <input type="text" placeholder="First Name" value="<?= $firstname?>" name="firstname" />
      <input type="text" placeholder="Last Name" value="<?= $lastname?>" name="lastname" />
      <input type="text" placeholder="Username" value="<?= $username?>" name="username" />
      <input type="email" placeholder="Email" value="<?= $email?>" name="email" />
      <input type="password" placeholder="Create Password" value="<?= $password?>" name="password" />
      <input type="password" placeholder="Confirm Password" value="<?= $confirmpassword?>" name="confirmpassword" />
      <select name="userrole" id="">
        <option value="0">Author</option>
        <option value="1">Admin</option>
      </select>
      <div class="form__control">
        <label for="avatar">User Avatar</label>
        <input type="file" id="avatar" name="avatar" />
      </div>
      <button class="btn" name="submit" type="submit">Add User</button>
    </form>
  </div>
</section>

<!-- ==================== FOOTER SECTION ======================= -->

<?php include("../partials/footer.php"); ?>
<script src="../js/main.js"></script>
</body>

</html>