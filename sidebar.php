<?php 
include('db.php');


$sql = "SELECT title, id FROM posts 
ORDER BY created_at DESC LIMIT 5";

$statement = $connection->prepare($sql);

$statement->execute();

$statement->setFetchMode(PDO::FETCH_ASSOC);

$postsTitles = $statement->fetchAll();


    echo '<pre>';
    //var_dump($postsTitles);
    echo '</pre>';?>
<aside class="col-sm-3 ml-sm-auto blog-sidebar">
            <div class="sidebar-module sidebar-module-inset">
                <h4>Latest posts</h4>    
                <?php 
                foreach($postsTitles as $title){
                   ?> 
                   <div>
                        <p><a href = "single-post.php?post_id=<?php echo($title['id'])?>"><?php echo ($title['title'])?></a><p>
                   </div>
                   <?php 
                }
                ?>      
            </div>                       
            
        </aside><!-- /.blog-sidebar -->
       