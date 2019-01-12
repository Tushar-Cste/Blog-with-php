</div>

	<div class="footersection templete clear">
	  <div class="footermenu clear">
		<ul>
			<li><a href="#">Home</a></li>
			<li><a href="#">About</a></li>
			<li><a href="#">Contact</a></li>
			<li><a href="#">Privacy</a></li>
		</ul>
	  </div>
	  <?php 
			$query = "SELECT * FROM copyright where id = 1";
			$cresult = $db->select($query);
			if($cresult){
				while($copyright = $cresult->fetch_assoc()){


		?>
	  <p>&copy; <?php echo $copyright['note'];?></p>
	  <?php }
	  }?>
	</div>
	<?php 
			$query = "SELECT * FROM socials where id = 1";
			$sresult = $db->select($query);
			if($sresult){
				while($social = $sresult->fetch_assoc()){


		?>
	<div class="fixedicon clear">
		<a href="<?php echo $social['facebook']?>" target="_blank"><img src="images/fb.png" alt="Facebook"/></a>
		<a href="<?php echo $social['twitter']?>" target="_blank"><img src="images/tw.png" alt="Twitter"/></a>
		<a href="<?php echo $social['linkedin']?>" target="_blank"><img src="images/in.png" alt="LinkedIn"/></a>
		<a href="<?php echo $social['google']?>" target="_blank"><img src="images/gl.png" alt="GooglePlus"/></a>
	</div>
	<?php }
		}
	?>
<script type="text/javascript" src="js/scrolltop.js"></script>
</body>
</html>