<?php
include_once('db.php');

    if(isset($_POST['commentDelete'])){
        $postId = $_POST['post_id'];
        $sql = "DELETE FROM comments WHERE id=" . $_POST['comment_id'];
        $statement = $connection->prepare($sql);

   
        $statement->execute();
    }

header("Location: single-post.php?post_id=" . $postId);
?>