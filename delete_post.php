<?php
include_once('db.php');

if(isset($_POST['postDelete'])){
    $postId = $_POST['post_id'];
    $sql2 = "DELETE FROM comments WHERE post_id="  . $postId;
    $statement = $connection->prepare($sql2);
    $statement->execute();

    $sql = "DELETE FROM posts WHERE id=" .  $postId;
    
    $statement2 = $connection->prepare($sql);
   
    $statement2->execute();
}



header("Location: single-post.php?post_id=" . $postId);
?>