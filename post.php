<?php include "inc/header.php";?>

<?php 
	$postid = mysqli_real_escape_string($db->link,$_GET['id']);
	if(!isset($postid)||$postid==NULL){
		header("Location:404.php");
	}
	else{
		$db = new Database;
		$fm = new Format;
		$id = $postid;
		$query="select * from posts where id = $id";
		$result = $db->select($query);
		if($result){
			$post = $result->fetch_assoc();
	?>

	<div class="contentsection contemplete clear">
		<div class="maincontent clear">
			<div class="about">
				<h2><?php echo $post['title'];?></h2>
				<h4><?php echo $fm->dateformat($post['date']);?></h4>
				<img src="admin/<?php echo $post['image'];?>" alt="MyImage"/>
				<p><?php echo $post['body'];?></p>
		<?php }//end if
			else
				header("Location:404.php"); 
			
			} // end else
			$cat = $post['category_id'];
			$postid = $post['id'];
			$query = "select id, image from posts where category_id = $cat AND id != $postid";
			$result = $db->select($query);
		?>

				<div class="relatedpost clear">
					<h2>Related articles</h2>
					<?php 
					if($result){
						while($post=$result->fetch_assoc()){
						?>
					<a href="post.php?id=<?php echo $post['id'];?>"><img src="admin/<?php echo $post['image'];?>" alt="MyImage"/></a>
					<?php } // end while
						} // end if
						else{
							echo "There isn't any related post";
						}
					?>
				</div>
	</div>


		</div>
		<?php include 'inc/sidebar.php';?>
	<?php include 'inc/footer.php';?>