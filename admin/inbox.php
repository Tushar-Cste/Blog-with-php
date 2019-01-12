<?php include 'inc/Aheader.php';?>
<?php include 'inc/Asidebar.php';?>

        <div class="grid_10">
            <div class="box round first grid">
                <h2>Inbox</h2>
                <?php
				if(isset($_GET['seenid']) && $_GET['seenid'] != NULL){
					$id = $_GET['seenid'];
					$query = "UPDATE contacts set status = '1' where id = '$id'";
					$result = $db->update($query);
					if($result){
						echo "<span class='success'>Message sent to seen box.</span>";
					}
					else{
						echo "<span class='error'>Something went wrong</span>";
					}
				}
				?>
                <div class="block">        
                    <table class="data display datatable" id="example">
					<thead>
						<tr>
							<th>Serial No.</th>
							<th>Name</th>
							<th>Email</th>
							<th>Message</th>
							<th>Date</th>
							<th>Action</th>
						</tr>
					</thead>
					<tbody>
					<?php 
						$query = "SELECT * FROM contacts where status = '0' order by date desc";
						$result = $db->select($query);
						$i=0;
						if($result){
							while($msg = $result->fetch_assoc()){
							$i++;
					?>
						<tr class="odd gradeX">
							<td><?php echo $i;?></td>
							<td><?php echo $msg['firstname'].' '.$msg['lastname'];?></td>
							<td><?php echo $msg['email'];?></td>
							<td><?php echo $fm->shorten($msg['body'],30);?></td>
							<td><?php echo $fm->dateformat($msg['date']);?></td>
							<td><a href="viewmsg.php?msgid=<?php echo $msg['id'];?>">Edit</a> || 
								<a href="replaymsg.php?msgid=<?php echo $msg['id'];?>">Replay</a> || 
								<a href="?seenid=<?php echo $msg['id'];?>">Seen</a></td>
						</tr>
					<?php }
					}?>
					</tbody>
				</table>
               </div>
            </div>

            <div class="box round first grid">
                <h2>Seen Message</h2>
                <?php
                	if(isset($_GET['delid'])){
						$delid = $_GET['delid'];
						$query = "DELETE FROM contacts where id = '$delid'";
						$dresult=$db->delete($query);
						if($dresult){
				            echo "<span class='success'>Contact deleted successfully</span>";
				        }
				        else{
				            echo "<span class='error'>Contact is not deleted successfully</span>";
				        }
					}
                ?>
                <div class="block">        
                    <table class="data display datatable" id="example">
					<thead>
						<tr>
							<th>Serial No.</th>
							<th>Name</th>
							<th>Email</th>
							<th>Message</th>
							<th>Date</th>
							<th>Action</th>
						</tr>
					</thead>
					<tbody>
					
						<?php 
						$query = "SELECT * FROM contacts where status = '1' order by date desc";
						$result = $db->select($query);
						$i=0;
						if($result){
							while($msg = $result->fetch_assoc()){
							$i++;
					?>
						<tr class="odd gradeX">
							<td><?php echo $i;?></td>
							<td><?php echo $msg['firstname'].' '.$msg['lastname'];?></td>
							<td><?php echo $msg['email'];?></td>
							<td><?php echo $fm->shorten($msg['body'],30);?></td>
							<td><?php echo $fm->dateformat($msg['date']);?></td>
							<td><a href="viewmsg.php?msgid=<?php echo $msg['id'];?>">Edit</a> || 
							<a onclick="return confirm('Are you sure to delete')" href="?delid=<?php echo $msg['id'];?>">Delete</a> 
								
						</tr>
					<?php }
					}?>
					
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
