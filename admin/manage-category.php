<?php include("config/partials/header.php"); ?>

<section class="dashboard">
  <?php if (isset($_SESSION['add-category-success'])) : ?>
    <div class="alert__message success container">
      <p><?= $_SESSION['add-category-success'];
          unset($_SESSION['add-category-success']);
          ?></p>
    </div>
  <?php endif ?>

  <?php if (isset($_SESSION['edit-category-success'])) : ?>
    <div class="alert__message success container">
      <p><?= $_SESSION['edit-category-success'];
          unset($_SESSION['edit-category-success']);
          ?></p>
    </div>
  <?php endif ?>
  <div class="container dashboard__container">
    <!-- MOBILE ICONS FOR TOGGLE -->
    <button class="sidebar__toggle" id="show__sidebar-btn">
      <i class="uil uil-angle-right-b"></i>
    </button>
    <button class="sidebar__toggle" id="hide__sidebar-btn">
      <i class="uil uil-angle-left-b"></i>
    </button>
    <!-- FOR THE SIDEBAR -->
    <aside id="aside">
      <ul>
        <li>
          <a href="add-post.php"><i class="uil uil-pen"></i>
            <h5>Add Post</h5>
          </a>
        </li>

        <li>
          <a href="dashboard.php"><i class="uil uil-postcard"></i>
            <h5>Manage Posts</h5>
          </a>
        </li>
        <?php if (isset($_SESSION['user_is_admin'])) : ?>
          <li>
            <a href="add-user.php"><i class="uil uil-user-plus"></i>
              <h5>Add User</h5>
            </a>
          </li>

          <li>
            <a href="manage-user.php"><i class="uil uil-users-alt"></i>
              <h5>Manage User</h5>
            </a>
          </li>

          <li>
            <a href="add-category.php"><i class="uil uil-edit"></i>
              <h5>Add Category</h5>
            </a>
          </li>

          <li>
            <a href="manage-category.php" class="active"><i class="uil uil-list-ul"></i>
              <h5>Manage Categories</h5>
            </a>
          </li>
        <?php endif ?>
      </ul>
    </aside>
    <main>
      <h2>Manage Categories</h2>
      <table>
        <thead>
          <th>Title</th>
          <th>Edit</th>
          <th>Delete</th>
        </thead>
        <tbody>
          <?php
          $query_cat = "select * from categories";
          $result_cat = mysqli_query($conn, $query_cat);
          $num_cat = mysqli_num_rows($result_cat);
          ?>
          <?php
          while ($row_cat = mysqli_fetch_assoc($result_cat)) : ?>
            <tr>
              <td><?= $row_cat['title'] ?></td>
              <td>
                <a href="<?= ROOT_URL ?>admin/edit-category.php?token=<?= $row_cat['token'] ?>" class="btn sm warning">Edit</a>
              </td>
              <td>
                <a href="<?= ROOT_URL ?>admin/delete-category.php?token=<?= $row_cat['token'] ?>" class="btn sm danger">Delete</a>
              </td>
            </tr>
          <?php endwhile ?>
        </tbody>
      </table>
    </main>
  </div>
</section>
<?php include("../partials/footer.php"); ?>
<script src="../js/main.js"></script>
</body>

</html>