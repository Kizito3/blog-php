<?php

require 'config/database.php';
require 'config/fns.php';

if (isset($_GET['id'])) {
    $id = base64_decode($_GET['id']);

    // UPDATE CATEGORY_ID OF POSTS THAT BELONGS TO THIS CATEGORY TO THE ID OF UNCATEGORIZED CATEGORY
    $update_query = "UPDATE posts SET category_id = 15 WHERE category_id =$id";
    $update_result = mysqli_query($conn, $update_query);

    if (!mysqli_errno($conn)) {


        $query = "delete from categories where id = '$id'";
        $result = mysqli_query($conn, $query);


        $_SESSION['delete-category-success'] = "Category deleted successfully";
    }
}
header('location: ' . ROOT_URL . 'admin/manage-category.php');
