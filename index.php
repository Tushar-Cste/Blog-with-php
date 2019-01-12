

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
	$db = new Database;
	$query = "SELECT * from posts order by date desc limit $start_from, $per_page ";
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
			<?php }?><!-- end while -->
			<?php }
			else{header("Location:404.php");}?>
		<!-- pagination -->	
		<?php
		$query = "select * from posts";
		$result = $db->select($query);
		$total_rows = mysqli_num_rows($result);
		$total_pages = ceil($total_rows/$per_page);
		echo "<span class='pagination'><a href='index.php?page=1'>First Page </a>";
		 for($i = 1; $i<=$total_pages;$i++){
		 	echo "<a href='index.php?page=".$i."'> ".$i." </a>";
		 }
		 
		  echo "<a href='index.php?page=$total_pages'> Last Page</a></span>";?>

		<!-- end pagination -->
		</div>
		<?php include 'inc/sidebar.php';?>
	<?php include 'inc/footer.php';?>