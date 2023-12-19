<?php include("partials/header.php"); 
//  fetch featured post from database

$query_featured = "SELECT * FROM posts WHERE is_featured = 1";
$result_featured = mysqli_query($conn,$query_featured);
$featured = mysqli_fetch_assoc($result_featured);


// fetch 9 posts from the post table

$query_post = "SELECT * FROM posts ORDER BY date_time DESC LIMIT 9";
$result_post = mysqli_query($conn,$query_post);


?>
    <!-- ==================== FEATURED SECTION ======================= -->

    <?php if(mysqli_num_rows($result_featured) == 1) : ?>
    <section class="featured">
      <div class="container featured__container">
        <div class="post__thumbnail">
          <img src="images/<?= $featured['thumbnail']?>" alt="" />
        </div>
        <div class="post__info">

        <?php  
        $category_id = $featured['category_id'];
        $query_cat = "SELECT * FROM categories WHERE id = $category_id";
        $result_cat = mysqli_query($conn,$query_cat);
        $row = mysqli_fetch_assoc($result_cat);
        ?>
          <a href="<?= ROOT_URL ?>category-post.php?id=<?= base64_encode($featured['category_id'])?>" class="category__button"><?= $row['title']?></a>
          <h2 class="post__title">
            <a href="<?= ROOT_URL?>post.php?id=<?= base64_encode($featured['id'])?>"
              ><?= $featured['title']?>
            </a>
          </h2>
          <p class="post__body">
           <?= substr($featured['body'], 0, 200)?>.........
          </p>
          <div class="post__author">
            <?php 
              $author_id = $featured['author_id'];

              $query_author = "SELECT * FROM users WHERE id = $author_id";
              $result_author = mysqli_query($conn,$query_author);
              $row_author = mysqli_fetch_assoc($result_author);
            ?>
            <div class="post__author-avatar">
              <img src="images/<?= $row_author['avatar']?>" alt="" />
            </div>
            <div class="post__author-info">
              <h5>By: <?= "{$row_author['firstname']} {$row_author['lastname']}"?></h5>
              <small><?= date("M d, Y - H:i", strtotime($featured['date_time']))?></small>
            </div>
          </div>
        </div>
      </div>
    </section>
    <?php endif ?>

    <!-- ==================== END OF FEATURED SECTION ======================= -->

    <!-- ==================== POST SECTION ======================= -->

    <section class="posts <?= $featured ? '' : 'section__extra-margin'?>">
      <div class="container posts__container">
        <?php while($row_post = mysqli_fetch_assoc($result_post)) : ?>
        <article class="post">
          <div class="post__thumbnail">
            <img src="images/<?= $row_post['thumbnail'] ?>" alt="" />
          </div>

          <div class="post__info">
          <?php  
        $category_id = $row_post['category_id'];
        $query_cat = "SELECT * FROM categories WHERE id = $category_id";
        $result_cat = mysqli_query($conn,$query_cat);
        $row = mysqli_fetch_assoc($result_cat);
        ?>
            <a href="<?= ROOT_URL?>category-post.php?id=<?= base64_encode($row_post['category_id'])?>" class="category__button"><?= $row['title']?></a>
            <h3 class="post__title">
              <a href="<?= ROOT_URL?>post.php?id=<?= base64_encode($row_post['id'])?>"
                ><?= $row_post['title']?></a
              >
            </h3>
            <p class="post__body">
              <?= substr($row_post['body'], 0 ,120)?>.....
            </p>

            <div class="post__author">
            <?php 
              $author_id = $row_post['author_id'];

              $query_author = "SELECT * FROM users WHERE id = $author_id";
              $result_author = mysqli_query($conn,$query_author);
              $row_author = mysqli_fetch_assoc($result_author);
            ?>
              <div class="post__author-avatar">
                <img src="images/<?= $row_author['avatar']?>" alt="" />
              </div>
              <div class="post__author-info">
                <h5>By: <?= "{$row_author['firstname']} {$row_author['lastname']}"?></h5>
                <small><?= date("M d, Y - H:i", strtotime($row_post['date_time']))?></small>
              </div>
            </div>
          </div>
        </article>
      <?php endwhile ?>
      </div>
    </section>

    <!-- ==================== END OF POSTS SECTION ======================= -->

    <!-- ==================== CATEGORY BUTTONS SECTION ======================= -->

    <section class="category__buttons">
      <div class="container category__buttons-container">
        <?php 
          $all_categories = "SELECT * FROM categories";
          $result_categories = mysqli_query($conn,$all_categories);
        ?>

        <?php while( $category_row = mysqli_fetch_assoc($result_categories)) : ?>
        <a href="<?= ROOT_URL?>category-post.php?id=<?= base64_encode($category_row['id'])?>" class="category__button"><?= $category_row['title']?></a>
        <?php endwhile ?>
          
      </div>
    </section>

    <!-- ==================== END OF CATEGORY BUTTONS SECTION ======================= -->
<?php include("partials/footer.php"); ?>


    <script src="js/main.js"></script>
  </body>
</html>
