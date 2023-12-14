<?php 

    require 'config/database.php';
    if (isset($_GET['id'])) {
        $id = base64_decode($_GET['id']);
        // fetch user from database

        $query = "select * from users where id = '$id'";
        $result = mysqli_query($conn,$query);
        $row = mysqli_fetch_assoc($result);

        if(mysqli_num_rows($result) == 1){
            $avatar_name = $row['avatar'];
            $avatar_path = '../images/' . $avatar_name;

            // delete image if available
            if($avatar_path) {
                unlink($avatar_path);
                // the unlink function deletes a file
            }
        }

        // fetch all thumbnails of user's post and delete them


        // delete user from database

         $query_delete = "delete from users where id  = '$id'";
         $result_delete = mysqli_query($conn,$query_delete);
         if(mysqli_errno($conn)){
            $_SESSION['delete-user'] = "Problem occurred while deleting user";
         }else{
            $_SESSION['delete-user-success'] = " User '{$row['firstname']}' '{$row['lastname']}' deleted successfully";
         }

    }
    header('location: ' . ROOT_URL . 'admin/manage-user.php');