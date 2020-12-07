<?php 
session_start();
require 'database/link.php';
$blog = getBlog($link,$_GET['id']);

if((!(isset($_SESSION['user'])))){
    header('location: index.php');
    exit();
}

if($blog['user_id'] != $_SESSION['user']['id']){
    header('location: profile.php');
    exit();
} 


?>    
<!DOCTYPE html>
<html>
<head>
<title><?=$blog['title'];?></title>
<link rel="stylesheet" href="style/post.css">
</head>
<body>
    <div class="post-container">
        <article>
            <h2><?=$blog['title'];?></h2>
            <p><?=$blog['content'];?></p>
        </article>
    </div>
        <a href="edit_post.php?id=<?=$blog['id'];?>"> Edit </a> 
        <a href="delete_post.php?id=<?=$blog['id'];?>"> Delete </a> 
        <a href="index.php">Main</a>
</body>
</html>

<?php 
function getBlog ($link,$id){
    $sql = "SELECT * FROM blog WHERE id = ?";
    $stmt = mysqli_prepare($link,$sql);
    if ($stmt === false){
        echo mysql_error($link);
    }else{
        mysqli_stmt_bind_param($stmt,"i",$id);
        if(mysqli_stmt_execute($stmt)){
            $result = mysqli_stmt_get_result($stmt);
            return mysqli_fetch_array($result, MYSQLI_ASSOC);
        }
    } 
}
?>

