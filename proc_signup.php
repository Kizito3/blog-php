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
    $avatar = $_FILES['avatar'];
    // VALIDATE INPUT VALUES
    if (!$firstname) {
        $_SESSION['signup'] = "Please enter your First Name";
    } elseif (!$lastname) {
        $_SESSION['signup'] = "Please enter your Last Name";
    } elseif (!$email) {
        $_SESSION['signup'] = "Please enter a valid email";
    } elseif (strlen($password) < 8 || strlen($confirmpassword) < 8) {
        $_SESSION['signup'] = "Password should be 8+ characters";
    } elseif (!$avatar['name']) {
        $_SESSION['signup'] = "Please add avatar";
    } else {
        // check if password match
        if ($password !== $confirmpassword) {
            $_SESSION['signup'] = "Password doesn't match";
        } else {
            // harsh the password
            $hashed_password = password_hash($password, PASSWORD_DEFAULT);

            // check for existing emails and username

            $user_email_query = "select * from users where username = '$username' or email = '$email'";
            $result = mysqli_query($conn, $user_email_query);
            if (mysqli_num_rows($result) > 0) {
                $_SESSION['signup'] = "Username and Email already exists";
            } else {
                // WORK ON THE IMAGE
                // RENAME THE IMAGES
                $time = time();
                $avatar_name = $time . $avatar['name'];  //append the time function and the avatar together
                $avatar_tmp_name = $avatar['tmp_name'];
                $avatar_destination_path = 'images/' . $avatar_name;

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
                        $_SESSION['signup'] = "File too large";
                    }
                } else {
                    $_SESSION['signup'] = "File should be png, jpg, jpeg";
                }
            }
        }
    }

    // redirect back to sign up page if there was any problem
    if (isset($_SESSION['signup'])) {
        $_SESSION['signup-data'] = $_POST;
        # pass form data back to the sign up page
        header('location:' . ROOT_URL . 'sign-up.php');
        die();
    } else {
        // insert into the database
        $insert_query = "insert into users set firstname = '$firstname', lastname = '$lastname', username= '$username', email = '$email', pass_word = '$hashed_password', avatar = '$avatar_name', is_admin = '0'";
        $insert_query_users = mysqli_query($conn, $insert_query);
        if (!mysqli_errno($conn)) {
            $_SESSION['signup-success'] = "Registration Successful Please Login";
            header('location: ' . ROOT_URL . 'sign-in.php');
            die();
        }
    }
} else {
    // if button wasn't clicked  bounce back to sign up page
    header('location: ' . ROOT_URL . 'sign-up.php');
    die();
}
