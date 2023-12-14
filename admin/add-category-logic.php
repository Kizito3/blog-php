<?php 

    require 'config/database.php';
    require_once("config/fns.php");
    if (isset($_POST['submit'])) {
        // get form data
        $title = mysqli_real_escape_string($conn,$_POST['title']);
        $description = mysqli_real_escape_string($conn, $_POST['description']);

        $token = createToken($title,$description,$title,$description);
        

        if(!$title){
            $_SESSION['add-category'] = "Enter title";
        }elseif (!$description) {
            $_SESSION['add-category'] = "Enter description";
        }

        // redirect to the add category page if there is an error with form data
        if (isset($_SESSION['add-category'])) {
            $_SESSION['add-category-data'] = $_POST;
            header('location: ' .ROOT_URL. 'admin/add-category.php');
            die();
        }else{
            // insert data into the database
            $query = "insert into categories set title = '$title', description = '$description', token = '$token'";
            $result = mysqli_query($conn,$query);

            if(mysqli_errno($conn)){
                $_SESSION['add-category'] = "Could not add category";
                header('location :' .ROOT_URL. 'admin/add-category.php');
                die();
            }else{
                $_SESSION['add-category-success'] = "Category added successfully";
                header('location: ' .ROOT_URL. 'admin/manage-category.php');
                die();
            }
        }
    }