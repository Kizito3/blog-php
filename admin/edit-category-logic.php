<?php

require 'config/database.php';
// require_once("config/fns.php");

if(isset($_POST['submit'])){

    $title = mysqli_real_escape_string($conn,$_POST['title']);
    $description = mysqli_real_escape_string($conn,$_POST['description']);

    $token = mysqli_real_escape_string($conn,$_POST['token']);

    if(!$title || !$description){
        $_SESSION['edit-category'] = "Invalid form input on edit page";
    }else{
        $query = "update categories set title = '$title', description = '$description' where token = '$token'";
        $result = mysqli_query($conn,$query);

        if(mysqli_errno($conn)){
            $_SESSION['edit-category'] = "Failed to update category";
        }else{
            $_SESSION['edit-category-success'] = "Category updated successfully";
            header('location :' .ROOT_URL. 'admin/manage-category.php');
        }
    }
    
}