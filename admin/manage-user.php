<?php 
include("config/partials/header.php"); 

require 'config/database.php';

$current_user = $_SESSION['user-id'];
$query_users = "select * from users where not id = '$current_user'";
$result_users = mysqli_query($conn,$query_users);
$num_users = mysqli_num_rows($result_users);
?>


    <section class="dashboard">
    <?php if(isset($_SESSION['add-user-success'])) : ?>
          <div class="alert__message success container">
          <p><?= $_SESSION['add-user-success'];
          unset($_SESSION['add-user-success']);?></p>
        </div>
        <?php endif ?>

        <?php if(isset($_SESSION['edit-user'])) : ?>
          <div class="alert__message success container">
          <p><?= $_SESSION['edit-user'];
          unset($_SESSION['edit-user']);?></p>
        </div>

        <?php elseif(isset($_SESSION['edit-user-error'])) : ?>
          <div class="alert__message error container">
          <p><?= $_SESSION['edit-user-error'];
          unset($_SESSION['edit-user-error']);?></p>
        </div>
        <?php elseif(isset($_SESSION['delete-user'])) : ?>
          <div class="alert__message success container">
          <p><?= $_SESSION['delete-user'];
          unset($_SESSION['delete-user']);?></p>
        </div>
        <?php elseif(isset($_SESSION['delete-user-success'])) : ?>
          <div class="alert__message success container">
          <p><?= $_SESSION['delete-user-success'];
          unset($_SESSION['delete-user-success']);?></p>
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
              <a href="add-post.php"
                ><i class="uil uil-pen"></i>
                <h5>Add Post</h5></a
              >
            </li>

            <li>
              <a href="dashboard.php"
                ><i class="uil uil-postcard"></i>
                <h5>Manage Posts</h5></a
              >
            </li>
            <?php if(isset($_SESSION['user_is_admin'])) :?>
            <li>
              <a href="add-user.php"
                ><i class="uil uil-user-plus"></i>
                <h5>Add User</h5></a
              >
            </li>

            <li>
              <a href="manage-user.php" class="active"
                ><i class="uil uil-users-alt"></i>
                <h5>Manage User</h5></a
              >
            </li>

            <li>
              <a href="add-category.php"
                ><i class="uil uil-edit"></i>
                <h5>Add Category</h5></a
              >
            </li>

            <li>
              <a href="manage-category.php"
                ><i class="uil uil-list-ul"></i>
                <h5>Manage Categories</h5></a
              >
            </li>
            <?php endif ?>
          </ul>
        </aside>
        <main>
          <h2>Manage Users</h2>
          <?php if($num_users > 0) : ?>
          <table>
            <thead>
              <th>Name</th>
              <th>Username</th>
              <th>Edit</th>
              <th>Delete</th>
              <th>Admin</th>
            </thead>
            <tbody>
            
              <?php while ($row_users = mysqli_fetch_assoc($result_users)): 
                
               ?>
              <tr>
                <td><?= "{$row_users['firstname']} {$row_users['lastname']}" ?></td>
                <td><?= $row_users['username']?></td>
                <td><a href="<?= ROOT_URL?>admin/edit-user.php?id=<?= base64_encode($row_users['id'])?>" class="btn sm warning">Edit</a></td>
                <td>
                  <a href="<?= ROOT_URL?>admin/delete-user.php?id=<?= base64_encode($row_users['id'])?>" class="btn sm danger">Delete</a>
                </td>
                <td><?= $row_users['is_admin'] ? 'Yes' : 'No'?></td>
              </tr>
              <?php endwhile ?>
            </tbody>
          </table>
          <?php else : ?>
            <div class="alert__message error">
              <p><?= "No Users Found"?></p>
            </div>
            <?php endif ?>
        </main>
      </div>
    </section>
    <?php include("../partials/footer.php");?>

    <script src="../js/main.js"></script>
  </body>
</html>
