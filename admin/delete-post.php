<?php 

    require 'config/database.php';
    if(isset($_GET['id'])){
        $id = base64_decode($_GET['id']);

        $query = "select * from posts where id = '$id'";
        $result = mysqli_query($conn,$query);
       

        if(mysqli_num_rows($result) == 1){
            $row = mysqli_fetch_assoc($result);
            $thumbnail_name = $row['thumbnail'];
            $thumbnail_path = '../images/' . $thumbnail_name;

            // delete image if available
            if($thumbnail_path) {
                unlink($thumbnail_path); // the unlink function deletes a file
                
                $query_delete = "DELETE FROM posts WHERE id =$id LIMIT 1";
                $result_delete = mysqli_query($conn,$query_delete);

                if(!mysqli_errno($conn)){
                    $_SESSION['delete-post-success'] = "Post '{$row['title']}' deleted successfully";;
                }
            }
        }
    }
    header('location: ' .ROOT_URL. 'admin/');
    die();