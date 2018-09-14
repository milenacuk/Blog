<?php 
include("header.php");
include_once("db.php"); 
//$postId = $_GET['post_id'];
//$_POST['post_id'] = $postId;

 ?>
<main role="main" class="container">

<div class="row">

    <div class="col-sm-8 blog-main">
   

    <div> <!-- postavljanje posta -->
      <form name="addPostForm" method="POST" action='<?php setPost($connection);?>' onsubmit='return validateForm()' >
      <p>Write a title:<br></p>
      <input type="text" name="title" /> 

        <p>Write a post:<br></p>
        <textarea name="text" cols='70' rows = '8' ></textarea>
         
        <p>Your name:</p>
        <input type="text"  name="author" />        
        <input type="submit" name = 'postSubmit' value="Post" />
        <input type="hidden" name="post" />    
    </form>
    </div>
    <script>
    function validateForm(){
        var formName = document.forms['addPostForm']['title'].value;
        var formComment = document.forms['addPostForm']['text'].value;
        var formAuthor = document.forms['addPostForm']['author'].value;
        console.log('formName', formName, 'formComment',  formComment,'formAuthor', formAuthor)
        if(formName ===''|| formComment === '' || formAuthor === ''){
                alert('Sva polja moraju biti popunjena.');                             
                return false;
            }        
            return true;
        }
    </script>
    <?php
    function setPost($connection){
        if(isset($_POST['title'])){
            $titlePost = $_POST['title'];
            $bodyPost = $_POST['text'];
            $nameCom = $_POST['author'];            
            $created_at = '2018-09-14';
           
        $sql = "INSERT INTO posts (title, body ,author) VALUES ('$titlePost','$bodyPost','$nameCom');";
        
        
        $statement = $connection->prepare($sql);

      // izvrsavamo upit
        $statement->execute();
        
        header("Location:posts.php");         
       }   
    }
       ?>   
    </div>
    <?php
    include("sidebar.php");
    ?>
    </div>
    <?php

include("footer.php");
?>
