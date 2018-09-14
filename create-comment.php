<?php

function setComments($connection){
if(isset($_POST['commentSubmit'])){
    $nameCom = $_POST['author'];
    $comment = $_POST['text'];
    $postId = $_POST['post_id'];
           
        $sql1 = "INSERT INTO comments (author, text, post_id) VALUES ('$nameCom','$comment','$postId');";

        $statement = $connection->prepare($sql1);
    
        // izvrsavamo upit
        $statement->execute();
    
        // zelimo da se rezultat vrati kao asocijativni niz.
        // ukoliko izostavimo ovu liniju, vratice nam se obican, numerisan niz
        // $statement->setFetchMode(PDO::FETCH_ASSOC);
    
        // punimo promenjivu sa rezultatom upita
        // $rezultatiSvihComentaraPosleInserta = $statement->fetchAll();
        header('Location:single-post.php?post_id=' .  $postId);
    
        //var_dump($rezultatiSvihComentaraPosleInserta);  
       }      
    


}

?>