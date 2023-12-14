<?php include("config/partials/header.php");

  $title = $_SESSION['add-category-data']['title'] ?? null;
  $description = $_SESSION['add-category-data']['description'] ?? null;
?>

    <section class="form__section">
      <div class="container form__section-container">
        <h2>Add Category</h2>
        <?php if (isset($_SESSION['add-category'])) :?>
          <div class="alert__message error">
          <p><?= $_SESSION['add-category'];
            unset($_SESSION['add-category']);
          ?></p>
        </div>
        <?php elseif(isset($_SESSION['add-category-data'])) : ?>
          <div class="alert__message error">
          <p><?= $_SESSION['add-category-data'];
            unset($_SESSION['add-category-data']);
          ?></p>
        </div>
        <?php endif ?>
        <form action="<?= ROOT_URL?>/admin/add-category-logic.php" method="post">
          <input type="text" name="title" value="<?= $title?>" placeholder="Category Title" />
          <textarea
            name="description"
            id=""
            cols="30"
            rows="4"
            placeholder="Description"
          ></textarea>
          <button class="btn" name="submit" type="submit">Add Category</button>
        </form>
      </div>
    </section>

    <!-- ==================== FOOTER SECTION ======================= -->

    <?php include("../partials/footer.php");?>
    <script src="../js/main.js"></script>
  </body>
</html>
