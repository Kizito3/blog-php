<?php
require 'config/database.php';
// GET SIGNUP FORM DATA IF SIGNUP BUTTON IS CLICKED
if (isset($_POST['submit'])) {
    $firstname = mysqli_real_escape_string($conn, $_POST['firstname']);
    $lastname = mysqli_real_escape_string($conn, $_POST['lastname']);
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $email = filter_var($_POST['email'], FILTER_VALIDATE_EMAIL);
    $password = mysqli_real_escape_string($conn, $_POST['password']);
    $confirmpassword = mysqli_real_escape_string($conn, $_POST['confirmpassword']);
    $userrole = mysqli_real_escape_string($conn, $_POST['userrole']);
    $avatar = $_FILES['avatar'];
    // VALIDATE INPUT VALUES
    if (!$firstname) {
        $_SESSION['add-user'] = "Please enter your First Name";
    } elseif (!$lastname) {
        $_SESSION['add-user'] = "Please enter your Last Name";
    } elseif (!$email) {
        $_SESSION['add-user'] = "Please enter a valid email";
    } elseif (strlen($password) < 8 || strlen($confirmpassword) < 8) {
        $_SESSION['add-user'] = "Password should be 8+ characters";
    } elseif (!$avatar['name']) {
        $_SESSION['add-user'] = "Please add avatar";
    }else {
        // check if password match
        if ($password !== $confirmpassword) {
            $_SESSION['add-user'] = "Password doesn't match";
        } else {
            // harsh the password
            $hashed_password = password_hash($password, PASSWORD_DEFAULT);

            // check for existing emails and username

            $user_email_query = "select * from users where username = '$username' or email = '$email'";
            $result = mysqli_query($conn, $user_email_query);
            if (mysqli_num_rows($result) > 0) {
                $_SESSION['add-user'] = "Username and Email or user already exists";
            } else {
                // WORK ON THE IMAGE
                // RENAME THE IMAGES
                $time = time();
                $avatar_name = $time . $avatar['name'];  //append the time function and the avatar together
                $avatar_tmp_name = $avatar['tmp_name'];
                $avatar_destination_path = '../images/' . $avatar_name;

                // MAKE SURE THE FILE UPLOADED IS AN IMAGE

                $allowed_ext = ['png', 'jpg', 'jpeg'];
                $ext = explode('.', $avatar_name);
                $ext = end($ext);  //the end function checks for the extention of the file which is an array uploaded eg .png, .jpg .jpeg

                if (in_array($ext, $allowed_ext)) {
                    // MAKE SURE THE FILES IS NOT TOO LARGE(1mb)
                    if ($avatar['size'] < 1000000) {
                        // upload avatar
                        move_uploaded_file($avatar_tmp_name, $avatar_destination_path);
                    } else {
                        $_SESSION['add-user'] = "File too large";
                    }
                } else {
                    $_SESSION['add-user'] = "File should be png, jpg, jpeg";
                }
            }
        }
    }

    // redirect back to sign up page if there was any problem
    if (isset($_SESSION['add-user'])) {
        $_SESSION['add-user-data'] = $_POST;
        # pass form data back to the sign up page
        header('location:' . ROOT_URL . 'admin/add-user.php');
        die();
    } else {
        // insert into the database
        $insert_query = "insert into users set firstname = '$firstname', lastname = '$lastname', username= '$username', email = '$email', pass_word = '$hashed_password', avatar = '$avatar_name', is_admin = '$userrole'";
        $insert_query_users = mysqli_query($conn, $insert_query);
        if (!mysqli_errno($conn)) {
            $_SESSION['add-user-success'] = "New User $firstname $lastname Added Successfully";
            header('location: ' . ROOT_URL . 'admin/manage-user.php');
            die();
        }
    }
} else {
    // if button wasn't clicked  bounce back to sign up page
    header('location: ' . ROOT_URL . 'admin/add-user.php');
    die();
}
