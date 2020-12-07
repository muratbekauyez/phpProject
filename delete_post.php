<?php 

	require 'database/link.php';
	require 'post.php';
	$blog = getBlog($link, $_GET['id']);
?>
<h2>Are you sure?</h2>
<?php 
	require 'includes/delete_form.php';
	if($_SERVER["REQUEST_METHOD"] == "POST"){
		$id = $_GET['id'];
		$sql = "DELETE FROM blog WHERE id = '$id'";
		$res = mysqli_query($link,$sql);
		if($res){
			header("Location: index.php");
		}else {
			echo mysqli_error($link);
		}
	}
?>