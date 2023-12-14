<?php include("config/partials/header.php"); ?>


    <section class="dashboard">
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
              <a href="dashboard.php" class="active"
                ><i class="uil uil-postcard"></i>
                <h5>Manage Posts</h5></a
              >
            </li>
            <?php if(isset($_SESSION['user_is_admin'])) : ?> 
            <li>
              <a href="add-user.php"
                ><i class="uil uil-user-plus"></i>
                <h5>Add User</h5></a
              >
            </li>

            <li>
              <a href="manage-user.php"
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
          <table>
            <thead>
              <th>Title</th>
              <th>Category</th>
              <th>Edit</th>
              <th>Delete</th>
            </thead>
            <tbody>
              <tr>
                <td>
                  Lorem ipsum dolor sit, amet consectetur adipisicing elit.
                </td>
                <td>Travel</td>
                <td><a href="edit-user.php" class="btn sm warning">Edit</a></td>
                <td>
                  <a href="delete-category.php" class="btn sm danger">Delete</a>
                </td>
              </tr>
              <tr>
                <td>
                  Lorem ipsum dolor sit, amet consectetur adipisicing elit.
                </td>
                <td>Travel</td>
                <td><a href="edit-user.php" class="btn sm warning">Edit</a></td>
                <td>
                  <a href="delete-category.php" class="btn sm danger">Delete</a>
                </td>
              </tr>
            </tbody>
          </table>
        </main>
      </div>
    </section>
    <footer>
      <div class="footer__socials">
        <a href="https://youtube.com/egatortutorials" target="_blank"
          ><i class="uil uil-youtube"></i
        ></a>
        <a href="https://facebook.com/okwarachigozirim" target="_blank"
          ><i class="uil uil-facebook"></i
        ></a>
        <a href="https://twiter.com/only__1kizzy" target="_blank"
          ><i class="uil uil-twitter"></i
        ></a>
        <a href="https://linkedin.com/okwarachigozirim" target="_blank"
          ><i class="uil uil-linkedin"></i
        ></a>
      </div>
      <div class="container footer__container">
        <article>
          <h4>Categories</h4>
          <ul>
            <li><a href="">Travel</a></li>
            <li><a href="">Wild Life</a></li>
            <li><a href="">Logistics</a></li>
            <li><a href="">Rentals</a></li>
            <li><a href="">Investments</a></li>
            <li><a href="">Forex & Trading</a></li>
          </ul>
        </article>
        <article>
          <h4>Online</h4>
          <ul>
            <li><a href="">Online Support</a></li>
            <li><a href="">Call Numbers</a></li>
            <li><a href="">Emails</a></li>
            <li><a href="">Social Support</a></li>
            <li><a href="">Location</a></li>
          </ul>
        </article>
        <article>
          <h4>Blog</h4>
          <ul>
            <li><a href="">Safety</a></li>
            <li><a href="">Repair</a></li>
            <li><a href="">Recent</a></li>
            <li><a href="">Popular</a></li>
            <li><a href="">Categories</a></li>
          </ul>
        </article>
        <article>
          <h4>Permalinks</h4>
          <ul>
            <li><a href="">Home</a></li>
            <li><a href="">Blog</a></li>
            <li><a href="">About</a></li>
            <li><a href="">Services</a></li>
            <li><a href="">Contact</a></li>
          </ul>
        </article>
      </div>

      <div class="footer__copyright">
        <small>Copyright &copy; Okwara Kizito 2023</small>
      </div>
    </footer>

    <script src="../js/main.js"></script>
  </body>
</html>
