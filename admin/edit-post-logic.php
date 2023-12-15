<?php

require 'config/database.php';
if (isset($_POST['submit'])) {
    $id = mysqli_real_escape_string($conn, $_POST['id']);
    $title = mysqli_real_escape_string($conn, $_POST['title']);
    $previous_thumbnail_name = mysqli_real_escape_string($conn, $_POST['previous_thumbnail']);
    $body = mysqli_real_escape_string($conn, $_POST['body']);
    $category = mysqli_real_escape_string($conn, $_POST['category']);
    $is_featured = mysqli_real_escape_string($conn, $_POST['is_featured']);
    $thumbnail = $_FILES['thumbnail'];


    // set is_featured to 0  if it was unchecked

    $is_featured = $is_featured == 1 ?: 0;

    if (!$title) {
        $_SESSION['edit-post'] = "Couldn't Update post. Invalid form data on edit post page";
    } elseif (!$body) {
        $_SESSION['edit-post'] = "Couldn't Update post. Invalid form data on edit post page";
    } elseif (!$category) {
        $_SESSION['edit-post'] = "Couldn't Update povalid form data on edit post page";
    } elseif (!$thumbnail) {
        $_SESSION['edit-post'] = "Couldn't Update post. Choose a thumbnail";
    } else {
        if ($thumbnail['name']) {
            $previous_thumbnail_path = '../images/' . $previous_thumbnail_name;
            if ($previous_thumbnail_path) {
                unlink($previous_thumbnail_path);
            }

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
    }

    if($_SESSION['edit-post']){
        // redirect to manage form page if form was invalid 
        header('location: ' .ROOT_URL. 'admin/');
        die();
    }else{
         // SET IS_FEATURED OF ALL POSTS TO 0 IF IS_FEATURED FOR THIS POST IS SET TO 1
         if ($is_featured == 1) {
            $is_featured_query = "update posts set is_featured = '0'";
            $is_featured_query_result = mysqli_query($conn,$is_featured_query);

        }

        $thumbnail_to_insert = $thumbnail_name ?? $previous_thumbnail_name;

        $query = "UPDATE posts SET title = '$title', body= '$body', thumbnail = '$thumbnail_to_insert', category_id = '$category', is_featured = $is_featured WHERE id = $id LIMIT 1";
        $result = mysqli_query($conn,$query);
    }

    if (!mysqli_errno($conn)) {
        $_SESSION['edit-post-success'] = "Post updated successfully";
    }
}

header('location: ' .ROOT_URL. 'admin/');
die();
