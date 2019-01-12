

<?php include "inc/header.php";?>
<?php include 'inc/slider.php';?>

<!-- pagination -->
		<?php
			$per_page = 3;
			if(isset($_GET['page'])){
				$page = $_GET['page'];
			}else{
				$page = 1;
			}
			$start_from = ($page-1)*$per_page;

		?>
		<!-- end pagination -->

<?php
	$getcategory = mysqli_real_escape_string($db->link,$_GET['category']);
	if(!isset($getcategory)||$getcategory==NULL){
		header("Location:404.php");
	}
	else{
	$db = new Database;
	$query = "select * from posts where category_id = ".$getcategory." limit $start_from, $per_page";
	$result=$db->select($query);
	$fm = new Format;
?>
	<div class="contentsection contemplete clear">
		<div class="maincontent clear">
		
			<?php 
				if($result){
					while($post = $result->fetch_assoc()){
						
			?>
			<div class="samepost clear">
				<h2><a href="post.php?id=<?php echo $post['id']?>"><?php echo $post['title'];?></a></h2>
				<h4><?php echo $fm->dateformat($post['date']);?> by <a href="#"><?php echo $post['author']; ?></a></h4>
				 <a href="post.php?id=<?php echo $post['id']?>"><img src="admin/<?php echo $post['image']?>" alt="post image"/></a>
				<p>
					<?php echo $fm->shorten($post['body'],300);?>...
				</p>
				<div class="readmore clear">
					<a href="post.php?id=<?php echo $post['id']?>">Read More</a>
				</div>
			</div>
			<?php }
				$query = "select * from posts where category_id =". $getcategory;
				$result = $db->select($query);
				$total_rows = mysqli_num_rows($result);
				$total_pages = ceil($total_rows/$per_page);
				echo "<span class='pagination'><a href='posts.php?page=1&category=".$getcategory."'>First Page </a>";
				 for($i = 1; $i<=$total_pages;$i++){
				 	echo "<a href='posts.php?page=".$i."&category=".$getcategory."'> ".$i." </a>";
				 }
				 
				  echo "<a href='posts.php?page=$total_pages&category=".$getcategory."'> Last Page</a></span>";
			?><!-- end while -->
			<?php }
			else{echo "There is no post of this category!!!";}?>
		<?php }?>
		<!-- pagination -->	
		<!-- <?php
		$query = "select * from posts where category_id =". $getcategory;
		$result = $db->select($query);
		$total_rows = mysqli_num_rows($result);
		$total_pages = ceil($total_rows/$per_page);
		echo "<span class='pagination'><a href='posts.php?page=1&category=".$getcategory."'>First Page </a>";
		 for($i = 1; $i<=$total_pages;$i++){
		 	echo "<a href='posts.php?page=".$i."&category=".$getcategory."'> ".$i." </a>";
		 }
		 
		  echo "<a href='posts.php?page=$total_pages&category=".$getcategory."'> Last Page</a></span>";?> -->

		<!-- end pagination -->
		</div>
		<?php include 'inc/sidebar.php';?>
	<?php include 'inc/footer.php';?>