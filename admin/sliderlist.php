<?php include 'inc/Aheader.php';?>
<?php include 'inc/Asidebar.php';?>
        <div class="grid_10">
            <div class="box round first grid">
                <h2>Slider List</h2>
                
				<?php
					if(isset($_GET['delsliderid'])){
						$delsliderid = $_GET['delsliderid'];
						$squery = "SELECT * FROM sliders where id = '$delsliderid'";
						$sresult = $db->select($squery);
						if($sresult){
							while($deleteimage = $sresult->fetch_assoc()){
								unlink($deleteimage['image']);
							}
						}
						$query = "DELETE FROM sliders where id = '$delsliderid'";
						$dresult=$db->delete($query);
						if($dresult){
				            echo "<span class='success'>Slider deleted successfully</span>";
				        }
				        else{
				            echo "<span class='error'>Slider is not deleted successfully</span>";
				        }
					}

				?>
				<?php 
					$query = "SELECT * FROM sliders";
					$result = $db->select($query);
				?>

                <div class="block">  
                    <table class="data display datatable" id="example">
					<thead>
						<tr>
							<th>No.</th>>
							<th>Slider Title</th>
							<th>Image</th>
							<th>Action</th>
						</tr>
					</thead>
					<tbody>
					<?php 
						$i=0;
						if($result){
							while($slider = $result->fetch_assoc()){
							$i++;
					?>
						<tr class="odd gradeX">
							<td><?php echo $i;?></td>
							<td><?php echo $slider['title'];?></td>
							<td ><img src="<?php echo $slider['image'];?>" height="40px" width="60px" ></td>
							<td>
							<?php 
								if( Session::get('userRole') == '0'){ ?>
									<a href="editslider.php?sliderid=<?php echo $slider['id'];?>">Edit</a> ||
							 <a onclick="return confirm('Are you sure to delete')" href="?delsliderid=<?php echo $slider['id'];?>">Delete</a> || 
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
