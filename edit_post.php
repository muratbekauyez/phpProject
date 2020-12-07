<?php 

	require 'database/link.php';
	require 'post.php';
	$blog = getBlog($link, $_GET['id']);
?>
<h2>Edit Feed</h2>
<?php 
	require 'includes/post_form.php';
	if($_SERVER["REQUEST_METHOD"] == "POST"){
		$id = $_GET['id'];
		$title = $_POST['title'];
		$content = $_POST['content'];
		$sql = "UPDATE blog SET title = '$title', content = '$content' WHERE id = '$id'";
		$res = mysqli_query($link,$sql);
		if($res){
			header("Location: post.php?id=$id");
		}else {
			echo mysqli_error($link);
		}
	}
?>