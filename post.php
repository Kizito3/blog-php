<?php include("partials/header.php"); 

if(isset($_GET['id'])){
  $id = base64_decode($_GET['id']);

  $query = "SELECT * FROM posts WHERE id = $id ";
  $result = mysqli_query($conn,$query);
  $post = mysqli_fetch_assoc($result);
}else{
  header('location: ' .ROOT_URL . 'blog.php');
}

?>

    <section class="singlepost">
      <div class="container singlepost__container">
        <h2><?= $post['title']?></h2>
        <div class="post__author">
        <?php 
              $author_id = $post['author_id'];

              $query_author = "SELECT * FROM users WHERE id = $author_id";
              $result_author = mysqli_query($conn,$query_author);
              $row_author = mysqli_fetch_assoc($result_author);
            ?>
          <div class="post__author-avatar">
            <img src="images/<?= $row_author['avatar']?>" alt="" />
          </div>
          <div class="post__author-info">
            <h5>By: <?= "{$row_author['firstname']} {$row_author['lastname']}"?></h5>
            <small><?= date("M d, Y, H:i", strtotime($post['date_time']))?> </small>
          </div>
        </div>

        <div class="singlepost__thumbnail">
          <img src="images/<?= $post['thumbnail']?>" alt="" />
        </div>
        <p>
          <?=$post['body']?>
        </p>
      </div>
    </section>

    <!-- ==================== FOOTER SECTION ======================= -->
    <?php include("partials/footer.php"); ?>

    <script src="js/main.js"></script>
  </body>
</html>
