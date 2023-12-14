<?php include("config/partials/header.php");
require 'config/database.php'; 

  if(isset($_GET['id'])){
    $id = base64_decode($_GET['id']);
    $query = "select * from users where id = '$id'";
    $result = mysqli_query($conn,$query);
    $row = mysqli_fetch_assoc($result);
  }else{
    header('location: ' .ROOT_URL. 'admin/manage-user.php');
    die();
  }
?>

    <section class="form__section">
      <div class="container form__section-container">
        <h2>Edit Post</h2>

        <form action="<?= ROOT_URL?>admin/edit-user-logic.php" method="post">
          <input type="text" placeholder="First Name" name="firstname" value="<?= $row['firstname']?>" />
          <input type="text" placeholder="Last Name" name="lastname" value="<?= $row['lastname']?>" />
          <input type="hidden" placeholder="Last Name" name="id" value="<?= $row['id']?>" />
          <select name="userrole" id="" >
            <option value="0">Author</option>
            <option value="1">Admin</option>
          </select>

          <button class="btn" type="submit" name="submit">Update User</button>
        </form>
      </div>
    </section>

    <!-- ==================== FOOTER SECTION ======================= -->

    <?php include("../partials/footer.php");?>
    <script src="../js/main.js"></script>
  </body>
</html>
