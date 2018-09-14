<?php 
include_once("header.php");
include_once("db.php"); 
include_once('create-comment.php');

$postId = $_GET['post_id'];
$_POST['post_id'] = $postId;
?>
        <main role="main" class="container">

<div class="row">

    <div class="col-sm-8 blog-main">

      <?php
  
      // pripremamo upit
      $sql = "SELECT posts.id AS posts_id,
      posts.title, posts.body,
      posts.author AS post_author,
      posts.created_at,
      comments.author AS comments_author,
      comments.text,
      comments.id AS comments_id
      FROM posts
      LEFT JOIN comments ON comments.post_id=posts.id
      WHERE posts.id =" . $postId;
        //$postId
      $statement = $connection->prepare($sql);

      // izvrsavamo upit
      $statement->execute();

      // zelimo da se rezultat vrati kao asocijativni niz.
      // ukoliko izostavimo ovu liniju, vratice nam se obican, numerisan niz
      $statement->setFetchMode(PDO::FETCH_ASSOC);

      // punimo promenjivu sa rezultatom upita
      $commentsInPosts = $statement->fetchAll();

      $comments = [];
      foreach($commentsInPosts as $value) {
          array_push($comments, ['author' => $value['comments_author'],
          'text' => $value['text'], 'comment_id' => $value['comments_id'] ]);
      
     
      ?>
      
      <div class="blog-post">          
          <h2 class="blog-post-title"> <?php echo ($commentsInPosts[0]["title"])?></h2>
          <p class="blog-post-meta"><?php echo ($commentsInPosts[0]["created_at"])?> <a href="#"><?php echo ($commentsInPosts[0]["post_author"])?></a></p>
          <p><?php echo ($commentsInPosts[0]["body"])?></p>
          <!--brisanje posta-->
          <form name ='delete-post' method='post' action="delete_post.php">
        <input name = 'postDelete' type = 'submit' value = 'Delete this post' class = 'btn-default'/>
        <input type = 'hidden' name = 'post_id' value="<?php echo  $postId?>"> 
        </form> 
      </div>
      <?php }?>

      <div> <!-- postavljanje komentara -->
      <form name="addCommentForm"  method="POST" action = "<?php setComments($connection); ?> "onsubmit = 'return validateForm()' >
        Your name:<br>
        <input type="text"  name="author" />
        <p>Comment:<br></p>
        <textarea name="text" cols='60' rows = '3' ></textarea>
        <input type="submit" name = 'commentSubmit' value="Post a comment" />
        <input type="hidden" name="comment" value="<?php echo  $postId?>"/>    
    </form>
    </div>
    
    <script>
    function validateForm(){
        var formName = document.forms['addCommentForm']['author'].value;
        var formComment = document.forms['addCommentForm']['comment'].value;
        if(formName ===''|| formComment === ''){
                alert('Sva polja moraju biti popunjena.');                             
                return false;
            }    
            return true;    
        }
    </script>
    
     
      <button onclick="myFunction()" id = 'btn' class="btn">Hide Comments</button>      
      <script>         
            function myFunction(){
                var x = document.getElementById("postComments");
                var bt = document.getElementById('btn');
            if (x.style.display === "none") {
                x.style.display = "block"; 
                bt.innerText = 'Hide comments';  
                                                      
           } else {
                x.style.display = "none";  
                bt.innerText = 'Show comments';       
            }
            }           
      </script>
            
      </button>

      <div id="postComments">
          <?php
          if (!empty($comments[0]['comment_id'])) {
              foreach ($comments as $comment) {
          ?>
              <ul>
                  <li><?php echo($comment['author']) ?>
                      <ul>
                          <li><?php echo ($comment['text'])?></li>
                      </ul>
                  </li>
              </ul>  <!-- brisanje komentara-->
                <form name ='delete-comment' method='post' action="delete-comment.php">
                <input name = 'commentDelete' type = 'submit' value = 'Delete comment' class = 'btn-default'/>
                <input type = 'hidden' name = 'post_id' value="<?php echo  $postId?>"> 
                <input type = 'hidden' name = 'comment_id' value="<?php echo $comment['comment_id'] ?>"> 


                </form>

              <hr>
          <?php
          }}
          ?>

      </div> <!-- post comments -->

    </div><!-- /.blog-main -->

  <?php include_once("sidebar.php"); 
  include_once("footer.php");
  ?>

</div><!-- /.row -->
    
    

  
       
