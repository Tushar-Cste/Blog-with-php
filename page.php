<?php include "inc/header.php";?>
<?php
	$pageid = mysqli_real_escape_string($db->link,$_GET['pageid']);
    if(!isset($pageid) || $pageid==NULL){
        header("Location:404.php");
    }
    else{
        $pageid = $pageid;
        $query = "SELECT * FROM pages where id = '$pageid'";
        $result = $db->select($query);
    }
?>	 <?php 
   	if($result){
   		while ($page = $result->fetch_assoc()) {
   ?>
	<div class="contentsection contemplete clear">
		<div class="maincontent clear">
			<div class="about">
				<h2><?php echo $page['name'];?></h2>
	
				<?php echo $page['content'];?>
	</div>

		</div>
		<?php }
		} else{header("Location:404.php");}?>
		<?php include 'inc/sidebar.php';?>
	<?php include 'inc/footer.php';?>