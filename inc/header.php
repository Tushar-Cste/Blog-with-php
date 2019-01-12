<!-- for database connection include following file -->
<?php include 'config/config.php';?>
<?php include 'lib/Database.php';?>
<?php include 'helpers/Format.php';?>

<!DOCTYPE html>
<html>
<head>
	<?php
		$db = new Database;
		$fm = new Format;
		if(isset($_GET['pageid'])){
			$pageid = $_GET['pageid'];
	        $query = "SELECT * FROM pages where id = '$pageid'";
	        $presult = $db->select($query);
	        if($presult){
	        	while ($title = $presult->fetch_assoc()) {      		     	
	?>
		<title><?php echo $title['name']?>-<?php echo TITLE;?></title>
	<?php }}} elseif(isset($_GET['id'])){
			$postid = $_GET['id'];
	        $query = "SELECT * FROM posts where id = '$postid'";
	        $presult = $db->select($query);
	        if($presult){
	        	while ($title = $presult->fetch_assoc()) {      		     	
	?>
		<title><?php echo $title['title']?>-<?php echo TITLE;?></title>
	<?php }}}
	else{
		?>
		<title><?php echo $fm->title();?>-<?php echo TITLE;?></title>
	<?php
	}
	?>
	
	<?php include 'script/meta.php';?>
	<?php include 'script/css.php';?>
	<?php include 'script/js.php';?>
</head>

<body>
	<div class="headersection templete clear">
		<a href="index.php">
			<div class="logo">
			<?php 
				$db = new Database;
				$query = "SELECT * FROM ttile_slogan where id = 1";
				$result = $db->select($query);
				if($result){
					while($ttile_slogan = $result->fetch_assoc()){


			?>
				<img src="admin/<?php echo $ttile_slogan['logo'];?>" alt="Logo"/>
				<h2><?php echo $ttile_slogan['title'];?></h2>
				<p><?php echo $ttile_slogan['slogan'];?></p>
				<?php }
				}?>
			</div>
		</a>
		<?php 
			$query = "SELECT * FROM socials where id = 1";
			$sresult = $db->select($query);
			if($sresult){
				while($social = $sresult->fetch_assoc()){


		?>
		<div class="social clear">
			<div class="icon clear">
				<a href="<?php echo $social['facebook'];?>" target="_blank"><i class="fa fa-facebook"></i></a>
				<a href="<?php echo $social['twitter'];?>" target="_blank"><i class="fa fa-twitter"></i></a>
				<a href="<?php echo $social['linkedin'];?>" target="_blank"><i class="fa fa-linkedin"></i></a>
				<a href="<?php echo $social['google'];?>" target="_blank"><i class="fa fa-google-plus"></i></a>
			</div>
			<?php }
			}?>
			<div class="searchbtn clear">
			<form action="search.php" method="get">
				<input type="text" name="search" placeholder="Search keyword..."/>
				<input type="submit" name="submit" value="Search"/>
			</form>
			</div>
		</div>
	</div>
<div class="navsection templete">
	<ul>
		<?php
			$path = $_SERVER['SCRIPT_FILENAME'];
			$title = basename($path,'.php');
		?>
		<li><a <?php if($title=='index') echo 'id ="active"';?> href="index.php">Home</a></li>
		<?php 
	        $query = "SELECT * FROM pages";
	        $pages = $db->select($query);
	        if($pages){
	            while($page = $pages->fetch_assoc()){


	    ?>
	    <li><a <?php
	    	if(isset($_GET['pageid']) && $_GET['pageid'] == $page['id']){
				echo 'id ="active"';

			}
	    ?> 

	    href="page.php?pageid=<?php echo $page['id'];?>"><?php echo $page['name'];?></a></li>
	    <?php }
	        }?>
		<li><a <?php if($title=='contact') echo 'id ="active"';?> href="contact.php">Contact</a></li>
	</ul>
</div>