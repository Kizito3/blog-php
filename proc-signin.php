<?php 

    require 'config/database.php';
    
    if (isset($_POST['submit'])) {
        // get the form data
        $username_email = $_POST['username_email'];
        $password = $_POST['password'];

        if (!$username_email) {
            $_SESSION['signin'] = "Username or Email required";
        }elseif(!$password){
            $_SESSION['signin'] = "Password required";
        }else{
            // fetch user from the database
            $fetch_query = "select * from users where username ='$username_email' or email = '$username_email'";
            $fetch_result = mysqli_query($conn,$fetch_query);

            if(mysqli_num_rows($fetch_result) == 1){
                // convert the record into an array
                $user_record = mysqli_fetch_assoc($fetch_result);
                $db_password = $user_record['pass_word'];
                // compare form password with database password
                if (password_verify($password, $db_password)) {
                    // set session for user for access control
                    $_SESSION['user-id'] = $user_record['id'];
                    // set session if user is an admin
                    if ($user_record['is_admin'] == 1) {
                        $_SESSION['user_is_admin'] = true;
                    }

                    // log user in

                    header('location: ' . ROOT_URL . 'admin/');
                } else{
                    $_SESSION['signin'] = "Password is incorrect";
                }
            }else{
                $_SESSION['signin'] = "User not found";
            }
        } 

        // redirect if there was any problem with the form data

        if(isset($_SESSION['signin'])){
            $_SESSION['signin-data'] = $_POST;

            header('location: ' . ROOT_URL . 'sign-in.php');
            die();
        }

    } else {
        header('location : ' . ROOT_URL . 'sign-in.php');
    }

