<?php

require 'config/database.php';
require_once("config/fns.php");

if (isset($_POST['submit'])) {

    $title = mysqli_real_escape_string($conn, $_POST['title']);
    $description = mysqli_real_escape_string($conn, $_POST['description']);

    $token = mysqli_real_escape_string($conn, $_POST['token']);

    if (!$title || !$description) {
        $error = "Invalid form input on edit page";
        include("edit-category.php");
        exit;
    }
    $query = "update categories set title = '$title', description = '$description' where token = '$token'";
    $result = mysqli_query($conn, $query);

    if ($result) {
        $success = "Category $title updated successfully";
        include("manage-category.php");
    } else {
        $error = "Failed to update category";
        include("edit-category.php");
        die();
    }
}
