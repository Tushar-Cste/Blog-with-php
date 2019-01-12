<?php include 'inc/Aheader.php';?>
<?php include 'inc/Asidebar.php';?>
<?php
    if(!isset($_GET['userid']) || $_GET['userid']==NULL){
        echo "<script>window.location='userlist.php'</script>";
    }
    else{
        $userid = $_GET['userid'];
        $query = "SELECT * FROM users where id = '$userid'";
        $result = $db->select($query);
    }
?>
        <div class="grid_10">
		
            <div class="box round first grid">
                <h2>User Details</h2>

                <?php
                if($_SERVER['REQUEST_METHOD']=='POST'){
                	echo "<script>window.location='userlist.php'</script>";
                        
                }
                ?>
                <?php 
                    if($result){
                        while($user = $result->fetch_assoc()){
                ?>
                <div class="block">               
                 <form action="" method="post" enctype="multipart/form-data">
                    <table class="form">
                       
                        <tr>
                            <td>
                                <label>Name</label>
                            </td>
                            <td>
                                <input type="text" readonly name="name" value="<?php echo $user['name']?>" class="medium" />
                            </td>
                        </tr>
                     
                        <tr>
                            <td>
                                <label>Email</label>
                            </td>
                            <td>
                                <input type="text" readonly name="email" value="<?php echo $user['email']?>" class="medium" />
                            </td>
                        </tr>
                  
                        <tr>
                            <td style="vertical-align: top; padding-top: 9px;">
                                <label>Detail</label>
                            </td>
                            <td>
                                <textarea class="tinymce" readonly name="detail"><?php echo $user['detail'];?></textarea>
                            </td>
                        </tr>
                        
                        <?php }//end while
                                }//end if?>
						<tr>
                            <td></td>
                            <td>
                                <input type="submit" name="submit" Value="Ok" />
                            </td>
                        </tr>
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