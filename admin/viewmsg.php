<?php include 'inc/Aheader.php';?>
<?php include 'inc/Asidebar.php';?>
<?php 
	if(!isset($_GET['msgid']) || $_GET['msgid']==NULL){
        header("Location:index.php");
    }else{
    	$id =$_GET['msgid'];
    }
?>
        <div class="grid_10">
	
            <div class="box round first grid">
                <h2>View Message</h2>

                <?php
                if($_SERVER['REQUEST_METHOD']=='POST'){
                	echo "<script>window.location='inbox.php'</script>";
                        
                }
                ?>
                <div class="block">               
                 <form action="" method="post" enctype="multipart/form-data">
                    <table class="form">
                       <?php 
						$query = "SELECT * FROM contacts where id='$id' ";
						$result = $db->select($query);
						$i=0;
						if($result){
							while($msg = $result->fetch_assoc()){
							$i++;
					?>
                        <tr>
                            <td>
                                <label>Name</label>
                            </td>
                            <td>
                                <input type="text" name="name" value="<?php echo $msg['firstname'].' '.$msg['lastname'];?>" class="medium" />
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label>Email</label>
                            </td>
                            <td>
                                <input type="text" name="name" value="<?php echo $msg['email'];?>" class="medium" />
                            </td>
                        </tr>
                     	<tr>
                            <td>
                                <label>Date</label>
                            </td>
                            <td>
                                <input type="text" name="name" value="<?php echo $fm->dateformat($msg['date']);?>" class="medium" />
                            </td>
                        </tr>
                  
                        <tr>
                            <td style="vertical-align: top; padding-top: 9px;">
                                <label>Message</label>
                            </td>
                            <td>
                                <textarea class="tinymce" name="content"><?php echo $msg['body'];?></textarea>
                            </td>
                        </tr>
                        
						<tr>
                            <td></td>
                            <td>
                                <input type="submit" name="submit" Value="Ok" />
                            </td>
                        </tr>
                        <?php } }?>
                    </table>
                    </form>
                </div>
            </div>
        </div>
        <div class="clear">
        </div>
    </div>
    <div class="clear">
    </div>
    <script src="js/tiny-mce/jquery.tinymce.js" type="text/javascript"></script>
    <script type="text/javascript">
        $(document).ready(function () {
            setupTinyMCE();
            setDatePicker('date-picker');
            $('input[type="checkbox"]').fancybutton();
            $('input[type="radio"]').fancybutton();
        });
    </script>
    <?php include 'inc/Afooter.php';?>