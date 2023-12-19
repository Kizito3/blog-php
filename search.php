<?php include("partials/header.php"); ?>

<?php
require 'config/database.php';

// check if search bar is empty or not

if (isset($_GET['search']) && isset($_GET['submit'])) {
    $search = $_GET['search'];

    $query = "SELECT * FROM posts WHERE title LIKE '%$search%' OR body LIKE '%$search%' ORDER BY date_time DESC";
    $result = mysqli_query($conn, $query);
} else {
    header('location: ' . ROOT_URL . 'blog.php');
    die();
} ?>
<?php if (mysqli_num_rows($result) > 0) : ?>
    <section class="posts <?= $featured ? '' : 'section__extra-margin' ?>">
        <div class="container posts__container">
            <?php while ($row_post = mysqli_fetch_assoc($result)) : ?>
                <article class="post">
                    <div class="post__thumbnail">
                        <img src="images/<?= $row_post['thumbnail'] ?>" alt="" />
                    </div>

                    <div class="post__info">
                        <?php
                        $category_id = $row_post['category_id'];
                        $query_cat = "SELECT * FROM categories WHERE id = $category_id";
                        $result_cat = mysqli_query($conn, $query_cat);
                        $row = mysqli_fetch_assoc($result_cat);
                        ?>
                        <a href="<?= ROOT_URL ?>category-post.php?id=<?= base64_encode($row_post['category_id']) ?>" class="category__button"><?= $row['title'] ?></a>
                        <h3 class="post__title">
                            <a href="<?= ROOT_URL ?>post.php?id=<?= base64_encode($row_post['id']) ?>"><?= $row_post['title'] ?></a>
                        </h3>
                        <p class="post__body">
                            <?= substr($row_post['body'], 0, 120) ?>.....
                        </p>

                        <div class="post__author">
                            <?php
                            $author_id = $row_post['author_id'];

                            $query_author = "SELECT * FROM users WHERE id = $author_id";
                            $result_author = mysqli_query($conn, $query_author);
                            $row_author = mysqli_fetch_assoc($result_author);
                            ?>
                            <div class="post__author-avatar">
                                <img src="images/<?= $row_author['avatar'] ?>" alt="" />
                            </div>
                            <div class="post__author-info">
                                <h5>By: <?= "{$row_author['firstname']} {$row_author['lastname']}" ?></h5>
                                <small><?= date("M d, Y - H:i", strtotime($row_post['date_time'])) ?></small>
                            </div>
                        </div>
                    </div>
                </article>
            <?php endwhile ?>
        </div>
    </section>
<?php else : ?>
    <div class="alert__message error center section__extra-margin">
        <p><?= "No Post Found"?></p>
    </div>
<?php endif ?>


<?php include("partials/footer.php"); ?>


<script src="js/main.js"></script>

</body>

</html>