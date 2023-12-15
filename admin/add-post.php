<?php include("config/partials/header.php"); 

$title = $_SESSION['add-post-data']['title'] ?? null;
$body = $_SESSION['add-post-data']['body'] ?? null;
unset($_SESSION['add-post-data']);
 
//  fetch all categories from the database

$query = "select * from categories";
$result = mysqli_query($conn,$query);
$num = mysqli_num_rows($result);

?>

    <section class="form__section">
      <div class="container form__section-container">
        <h2>Add Post</h2>
       <?php if(isset($_SESSION['add-post'])) :?>
        <div class="alert__message error">
          <p><?= $_SESSION['add-post'];
            unset($_SESSION['add-post']);
          ?></p>
        </div>
        <?php endif ?>
        <form action="<?= ROOT_URL?>admin/add-post-logic.php" method="post" enctype="multipart/form-data">
          <input type="text" placeholder="Post Title" value="<?= $title?>" name="title" />
          <select name="category"  id="">
            <?php while($row = mysqli_fetch_assoc($result)) :?>
            <option value="<?= $row['id']?>"><?= $row['title']?></option>
            <?php endwhile ?>
          </select>

          <textarea
            name="body"
            id=""
            cols="30"
            rows="10"
            placeholder="Body"
          ><?= $body?></textarea>

          <?php if(isset($_SESSION['user_is_admin'])) :?>
          <div class="form__control inline">
            <input type="checkbox" name="is_featured" value="1" id="is_featured" checked />
            <label for="is_featured">Featured</label>
          </div>

          <?php endif ?>

          <div class="form__control">
            <label for="thumbnail">Add Thumbnail</label>
            <input type="file" name="thumbnail" id="thumbnail" />
          </div>
          <button class="btn" type="submit" name="submit">Add Post</button>
        </form>
      </div>
    </section>

    <!-- ==================== FOOTER SECTION ======================= -->

    <?php include("../partials/footer.php");?>
    <script src="../js/main.js"></script>
  </body>
</html>
