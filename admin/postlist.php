<?php include 'inc/Aheader.php';?>
<?php include 'inc/Asidebar.php';?>
        <div class="grid_10">
            <div class="box round first grid">
                <h2>Post List</h2>
                <?php 
					$query = "SELECT * FROM posts";
					$result = $db->select($query);
				?>

				<?php
					if(isset($_GET['deletepostid'])){
						$delpostid = $_GET['deletepostid'];
						$squery = "SELECT * FROM posts where id = '$delpostid'";
						$sresult = $db->select($squery);
						if($sresult){
							while($deleteimage = $sresult->fetch_assoc()){
								uplink($deleteimage['image']);
							}
						}
						$query = "DELETE FROM posts where id = '$delpostid'";
						$dresult=$db->delete($query);
						if($dresult){
				            echo "<span class='success'>Post deleted successfully</span>";
				        }
				        else{
				            echo "<span class='error'>Category is not deleted successfully</span>";
				        }
					}

				?>
                <div class="block">  
                    <table class="data display datatable" id="example">
					<thead>
						<tr>
							<th>Post Title</th>
							<th>Description</th>
							<th>Category</th>
							<th>Image</th>
							<th>Action</th>
						</tr>
					</thead>
					<tbody>
					<?php 
						$i=0;
						if($result){
							while($post = $result->fetch_assoc()){
							$i++;
					?>
						<tr class="odd gradeX">
							<td><?php echo $post['title'];?></td>
							<td><?php echo $fm->shorten($post['body'],60);?></td>
							<td><?php echo $post['category_id'];?></td>
							<td ><img src="<?php echo $post['image'];?>" height="40px" width="60px" ></td>
							<td>
							<?php 
								if(Session::get('userId') == $post['user_id'] || Session::get('userRole') == '0'){ ?>
									<a href="editpost.php?postid=<?php echo $post['id'];?>">Edit</a> ||
							 <a onclick="return confirm('Are you sure to delete')" href="?deletepostid=<?php echo $post['id'];?>">Delete</a> || 
								<?php

								}
							?>
							
							 <a href="viewpost.php?postid=<?php echo $post['id'];?>">View</a></td>
						</tr>
					<?php } // end while
						}//end if?>	
					</tbody>
				</table>
	
               </div>
            </div>
        </div>
        <div class="clear">
        </div>
    </div>
    <div class="clear">
    </div>
	<script type="text/javascript">
        $(document).ready(function () {
            setupLeftMenu();
            $('.datatable').dataTable();
			setSidebarHeight();
        });
    </script>
    <?php include 'inc/Afooter.php';?>
