<?php
session_start();
  require 'database/link.php';
  if($_SERVER["REQUEST_METHOD"]=="POST"){
    $sql = "INSERT INTO blog(title,content,user_id) VALUES ('".$_POST['title']."','".$_POST['content']."','".$_SESSION['user']['id']."')";
    
    $res = mysqli_query($link,$sql);
    
    if($res===false){
      echo mysqli_error($link);
    }else{
      $id = mysqli_insert_id($link);
      echo "Data inserted with id:$id";
    }
  }
 ?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
<meta charset="utf-8">
<title><?php echo $_SESSION['user']['login'];?> new post</title>
<link rel="stylesheet" href="style/post.css">
</head>
<body>
    <header>
        <h1>New Feed</h1>
    </header>
    <main>
      <?=require 'includes/post_form.php';?><br>
      <a href="index.php">Main</a>
   </main>

</body>
</html>
