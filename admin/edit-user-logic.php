<?php 

    require 'config/database.php';

    if (isset($_POST['submit'])) {
       $id = mysqli_real_escape_string($conn,$_POST['id']);
       $firstname = mysqli_real_escape_string($conn,$_POST['firstname']);
       $lastname = mysqli_real_escape_string($conn,$_POST['lastname']);
       $userrole = mysqli_real_escape_string($conn,$_POST['userrole']);

    //    check for valid input
        if (!$firstname || !$lastname) {
            $_SESSION['edit-user-error'] = "Invalid form input on edit page";
        }else{
            // update user
            $query = "update users set firstname = '$firstname', lastname = '$lastname', is_admin = '$userrole' where id = '$id' limit 1";
            $result = mysqli_query($conn, $query);

            if(mysqli_errno($conn)){
                $_SESSION['edit-user-error'] = "Failed to update user";
            }else{
                $_SESSION['edit-user'] = "User $firstname $lastname updated successfully";
            }
        }
    }

    header('location: ' .ROOT_URL. 'admin/manage-user.php');