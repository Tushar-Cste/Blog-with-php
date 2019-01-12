<div class="sidebar clear">
			<div class="samesidebar clear">
				<h2>Categories</h2>
					<ul>
					<?php 
					$query = "select * from categories ";
					$result=$db->select($query);
						if($result){
							while($category = $result->fetch_assoc()){
						
			
					?>
						<li><a href="posts.php?category=<?php echo $category['id'];?>"><?php echo $category['name']?></a></li>
						<?php }?><!-- end while -->
						<?php } else{?>
							<li><a href="#">No Category Found</a></li>
						<?php }?><!-- end else -->
					</ul>
			</div>
			
			<div class="samesidebar clear">
				<h2>Latest articles</h2>
				<?php 
					$query = "select * from posts limit 5 ";
					$result=$db->select($query);
						if($result){
							while($post = $result->fetch_assoc()){
						
			
					?>
					<div class="popular clear">
						<h3><a href="post.php?id=<?php echo $post['id'];?>"><?php echo $post['title']?></a></h3>
						<a href="post.php?id=<?php echo $post['id'];?>"><img src="admin/<?php echo $post['image']?>" alt="post image"/></a>
						<?php echo $fm->shorten($post['body'],100);?>	
					</div>
					<?php }?><!-- end while -->
						<?php } else{?>
							<p>There is no latest news</p>
						<?php }?><!-- end else -->
					
			</div>
			
		</div>