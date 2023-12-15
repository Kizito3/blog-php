<?php

    require 'config/database.php';

    if(isset($_POST['submit'])){
        $author_id = $_SESSION['user-id'];
        $title = mysqli_real_escape_string($conn,$_POST['title']);
        $body = mysqli_real_escape_string($conn,$_POST['body']);
        $category = mysqli_real_escape_string($conn,$_POST['category']);
        $is_featured = mysqli_real_escape_string($conn,$_POST['is_featured']);
        $thumbnail = $_FILES['thumbnail'];

        // set is_featured to 0 if unchecked
        $is_featured = $is_featured == 1 ?: 0;

        // validate form data 

        if (!$title) {
            $_SESSION['add-post'] = "Enter Post Title";
        }elseif (!$category) {
            $_SESSION['add-post'] = "Select Post Category";
        }elseif (!$body) {
            $_SESSION['add-post'] = "Enter Post Body";
        }elseif (!$thumbnail['name']) {
            $_SESSION['add-post'] = "Choose post thumbnail";
        }else{
            // work on thumbnail

            $time = time();
            $thumbnail_name = $time . $thumbnail['name'];
            $thumbnail_tmp_name = $thumbnail['tmp_name'];
            $thumbnail_destination_path = '../images/' . $thumbnail_name;

            // MAKE SURE THE FILE UPLOADED IS AN IMAGE

            $allowed_ext = ['png', 'jpg', 'jpeg'];
            $ext = explode('.', $thumbnail_name);
            $ext = end($ext);  //the end function checks for the extention of the file which is an array uploaded eg .png, .jpg .jpeg

            if (in_array($ext, $allowed_ext)) {
                // MAKE SURE THE FILES IS NOT TOO LARGE(1mb)
                if ($thumbnail['size'] < 2000000) {
                    // upload avatar
                    move_uploaded_file($thumbnail_tmp_name, $thumbnail_destination_path);
                } else {
                    $_SESSION['add-post'] = "File too large, 2mb required";
                }
            } else {
                $_SESSION['add-post'] = "File should be png, jpg, jpeg";
            }
        }


        // redirect back with form data

        if(isset($_SESSION['add-post'])){
            $_SESSION['add-post-data'] = $_POST;
            header('location: ' .ROOT_URL. 'admin/add-post.php');
            die();
        }else{
            // SET IS_FEATURED OF ALL POSTS TO 0 IF IS_FEATURED FOR THIS POST IS SET TO 1
            if ($is_featured == 1) {
                $is_featured_query = "update posts set is_featured = '0'";
                $is_featured_query_result = mysqli_query($conn,$is_featured_query);

            }

            $query = "insert into posts set title = '$title', body = '$body', author_id = '$author_id', category_id = '$category', is_featured = '$is_featured', thumbnail = '$thumbnail_name'";
            $result = mysqli_query($conn,$query);
            if(!mysqli_errno($conn)){
                $_SESSION['add-post-success'] = "New post added successfully";
                header('location:' .ROOT_URL. 'admin/');
                die(); 
            }
        }
    }

    header('location:' .ROOT_URL. 'admin/add-post.php');
    die();