<?php 

    require 'config/database.php';
    require 'config/fns.php';

    if(isset($_GET['token'])) {
        $token = $_GET['token'];

        $query = "delete from categories where token = '$token'";
        $result = mysqli_query($conn,$query);

        if (mysqli_errno($conn)) {
            $_SESSION['delete-category'] = "Error occured while deleting category";
        }else{
            $_SESSION['delete-category-success'] = "Category deleted successfully";
        }
    }
    header('location: ' .ROOT_URL. 'admin/manage-category.php');