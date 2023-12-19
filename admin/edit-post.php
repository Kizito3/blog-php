<?php include("config/partials/header.php"); 

if(isset($_GET['id'])){
  $id = base64_decode($_GET['id']);

  $query = "SELECT * FROM posts WHERE id = $id";
  $result_id = mysqli_query($conn,$query);
  $row = mysqli_fetch_assoc($result_id);

}else{
  header('location: ' .ROOT_URL. 'admin/');
  die();
}
// fetch categories frpom database


$category_query = "SELECT * FROM categories ";
$result = mysqli_query($conn,$category_query);
$num_category = mysqli_num_rows($result);
?>


    <section class="form__section">
      <div class="container form__section-container">
        <h2>Edit Post</h2>
       
        <form action="<?= ROOT_URL?>admin/edit-post-logic.php" method="post" enctype="multipart/form-data">
          <input type="text" placeholder="Post Title" name="title" value="<?= $row['title']?>" />
          <input type="hidden" placeholder="Post Title" name="id" value="<?= $row['id']?>" />
          <input type="hidden" placeholder="Post Title" name="previous_thumbnail" value="<?= $row['thumbnail']?>" />
          <select name="category" id="">
            <?php while($row_category = mysqli_fetch_assoc($result)) :?>
            <option value="<?= $row_category['id']?>"><?= $row_category['title']?></option>
            <?php endwhile ?>
          </select>

          <textarea
            name="body"
            id=""
            cols="30"
            rows="10"
            placeholder="Body"
          ><?= $row['body']?></textarea>

          <?php if(isset($_SESSION['user_is_admin'])) :?>
          <div class="form__control inline">
            <input type="checkbox" name="is_featured" value="1" id="is_featured" checked />
            <label for="is_featured">Featured</label>
          </div>

          <?php endif ?>

          <div class="form__control">
            <label for="thumbnail">Change Thumbnail</label>
            <input type="file" name="thumbnail" id="thumbnail" />
          </div>
          <button class="btn" type="submit" name="submit">Update Post</button>
        </form>
      </div>
    </section>

    <!-- ==================== FOOTER SECTION ======================= -->
    <?php include("../partials/footer.php");?>
    <script src="../js/main.js"></script>
  </body>
</html>
