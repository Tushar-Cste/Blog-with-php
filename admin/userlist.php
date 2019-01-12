<?php include 'inc/Aheader.php';?>
<?php include 'inc/Asidebar.php';?>

<?php 
	$query = "SELECT * FROM users";
	$result = $db->select($query);
?>

<?php
	if(isset($_GET['deluserid'])){
		$deluserid = $_GET['deluserid'];
		$query = "DELETE FROM users where id = '$deluserid'";
		$dresult=$db->delete($query);
		if($dresult){
            echo "<span class='success'>User deleted successfully</span>";
        }
        else{
            echo "<span class='error'>User is not deleted successfully</span>";
        }
	}

?>
        <div class="grid_10">
            <div class="box round first grid">
                <h2>Category List</h2>
                <div class="block">        
                    <table class="data display datatable" id="example">
					<thead>
						<tr>
							<th>Serial No.</th>
							<th> Name</th>
							<th>Email</th>
							<th>Detail</th>
							<th>Role</th>
							<th>Action</th>
						</tr>
					</thead>
					<tbody>
					<?php 
						$i=0;
						if($result){
							while($user = $result->fetch_assoc()){
							$i++;
					?>
						<tr class="odd gradeX">
							<td><?php echo $i;?></td>
							<td><?php echo $user['name'];?></td>
							<td><?php echo $user['email'];?></td>
							<td><?php echo $fm->shorten($user['detail']);?></td>
							<td><?php if($user['role'] == 0){
								$role = "admin";
							}elseif($user['role'] == 1){
								$role = "author";
							}else{
								$role = "editor";
							}
							echo $role;

							?></td>
							<td><a href="viewuser.php?userid=<?php echo $user['id'];?>">View User</a> 
							<?php 
			                    $id = Session::get('userId');
			                    $query = "Select * from users where id ='$id'";
			                    $dresult = $db->select($query);
			                    if($dresult){
			                        while($user = $dresult->fetch_assoc()){
			                            if($user['role'] == 0){
			                            ?>|| <a onclick="return confirm('Are you sure to delete')" href="?deluserid=<?php echo $user['id'];?>">Delete</a><?php
			                            }
			                        }
			                    }
			                ?>
			                </td> 
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