<?php include 'inc/Aheader.php';?>
<?php include 'inc/Asidebar.php';?>

<?php 
	$query = "SELECT * FROM categories";
	$result = $db->select($query);
?>

<?php
	if(isset($_GET['deletecatid'])){
		$delcatid = $_GET['deletecatid'];
		$query = "DELETE FROM categories where id = '$delcatid'";
		$dresult=$db->delete($query);
		if($dresult){
            echo "<span class='success'>Category inserted successfully</span>";
        }
        else{
            echo "<span class='error'>Category is not inserted successfully</span>";
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
							<th>Category Name</th>
							<th>Action</th>
						</tr>
					</thead>
					<tbody>
					<?php 
						$i=0;
						if($result){
							while($category = $result->fetch_assoc()){
							$i++;
					?>
						<tr class="odd gradeX">
							<td><?php echo $i;?></td>
							<td><?php echo $category['name'];?></td>
							<td><a href="editcategory.php?catid=<?php echo $category['id'];?>">Edit</a> || <a onclick="return confirm('Are you sure to delete')" href="?deletecatid=<?php echo $category['id'];?>">Delete</a></td>
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