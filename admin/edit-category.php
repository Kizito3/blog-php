<?php include("config/partials/header.php"); 

if(isset($_GET['token'])){
  $token = $_GET['token'];

  $query = "select * from categories where token = '$token'";
  $result = mysqli_query($conn,$query);
  $row = mysqli_fetch_assoc($result);
}else{
  header('location: ' .ROOT_URL. 'admin/manage-category.php');
  die();
}
?>


    <section class="form__section">
      <div class="container form__section-container">
        <h2>Edit Category</h2>
        <?php if (isset($_SESSION['edit-category'])) :?>
          <div class="alert__message error">
          <p><?= $_SESSION['edit-category'];
            unset($_SESSION['edit-category']);
          ?></p>
        </div>
        <?php endif ?>
        <form action="<?= ROOT_URL?>admin/edit-category-logic.php" method="post">
          <input type="text" placeholder="Category Title" name="title" value="<?= $row['title']?>" />
          <input type="hidden" placeholder="Category Title" name="token" value="<?= $row['token']?>" />
          <textarea
            name="description"
            id=""
            cols="30"
            rows="4"
            placeholder="Description"
          ><?= $row['description']?></textarea>
          <button class="btn" type="submit" name="submit">Update Category</button>
        </form>
      </div>
    </section>

    <!-- ==================== FOOTER SECTION ======================= -->

    <?php include("../partials/footer.php");?>
    <script src="../js/main.js"></script>
  </body>
</html>
