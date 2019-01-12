<meta name="language" content="English">
	<meta name="description" content="It is a website about education">
	<?php
		if(isset($_GET['id'])){
			$postid = $_GET['id'];
			$query = "SELECT * FROM posts where id = '$postid'";
	        $presult = $db->select($query);
	        if($presult){
	        	while ($tag = $presult->fetch_assoc()) {
				?>
	        		<meta name="keywords" content="<?php echo $tag['tags'];?>">
	        	<?php  } } } else{ ?>
	        		<meta name="keywords" content="<?php echo TAG;?>">
	        	<?php  }  ?>
	
	<meta name="author" content="Delowar">