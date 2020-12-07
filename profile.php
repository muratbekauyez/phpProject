<?php 
/*PROFILE LOGGED IN CODE PART*/
session_start();
//if not logged in then redirect to main page
if(!(isset($_SESSION['user']))){
	header('location: index.php');
	exit();
}
require_once "database/link.php";

$stmt = $link->prepare("SELECT * FROM users WHERE login = ? AND password = ?");
$stmt->bind_param("ss", $_SESSION['user']['login'], $_SESSION['user']['password']);
/* execute query */
$stmt->execute();

/* Get the result */
$result = $stmt->get_result();

$row = $result->fetch_assoc();
?>

<?php
/*BLOG FEED CODE PART*/
  require 'database/link.php';
  $sql = "SELECT * FROM blog WHERE user_id =".$_SESSION['user']['id'];

  $res = mysqli_query($link,$sql);
  if($res===false){
    echo mysqli_error($link);
  }else{
    $blogs = mysqli_fetch_all($res,MYSQLI_ASSOC);
  }
?>

<!DOCTYPE html>
<html>
<head>	
<title style="text-transform: capitalize;"><?=$row['firstName']. ' ' . $row['secondName'];?></title>
<link rel="stylesheet" href="style/profile.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
	$(document).ready(function(){
    	$('#logout').click(function(){
	    	window.location.href = 'logout.php';
		});
	});
</script>
</head>
<body>
	<div class="profile-container">
		<div class="ava-container">
			<div class="login-box">
				<b>@<?php echo $row['login'];?></b>
			</div>	
			<?php if(($row['avatar'])): ?>
				<img style="width: 200px; height: 200px" src="<?php echo $row['avatar'];?>"> <br>
			<?php else:?>
				<a>Image is not set</a>
			<?php endif ?>
			<div class="logout-box">	
				<input type="button" name="logout" id="logout" value="log out">	
			</div>
		</div>
		<div class="info-container">
			<table>
				<tr>
					<td>User ID:</td>
					<td><?=$_SESSION['user']['id'];?></td>
				</tr>
				<tr>
					<td>First Name:</td>
					<td><?php echo $row['firstName']?></td>
				</tr>
				<tr>
					<td>Second Name:</td>
					<td>
						<?php if(($row['secondName'])): ?>
							<?php echo ' ' . $row['secondName'];?>
						<?php else:?>
							Second Name is not set
						<?php endif ?>		
					</td>
				</tr>
				<tr>
					<td>Birthday:</td>
					<td>
						<?php if(($row['birthday'])): ?>
							<?php echo $row['birthday'];?>
						<?php else:?>
							Birthday is not set
						<?php endif ?>
					</td>
				</tr>
			</table>
		</div>
	</div>

	<div class="feed-container">
		<div class="feed-caption">
			<h1>Feed</h1>
			<a href="add_post.php">What's New?</a>
		</div>
		<div class="posts">
	     	<ul>
        		<?php foreach ($blogs as $blog):?>
	         	<li class = "item">
              		<a class="item-title" href="post.php?id=<?=$blog['id'];?>"><?=$blog['title'];?></a>
              		<p><?=$blog['content'];?></p>
              		<a>Publish Date: <?=$blog['date'];?></a>
              		<br><br><br>
	          	</li>
	        	<?php endforeach; ?>
	      	</ul>
     		
	  	</div>
	    
	</div>
</body>
</html>