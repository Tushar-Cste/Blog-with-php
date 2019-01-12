<?php include 'inc/Aheader.php';?>
<?php include 'inc/Asidebar.php';?>
<?php
    $userid = Session::get('userId');
    $userrole = Session::get('userRole');
    $query = "Select * from users where id='$userid' AND role='$userrole'";
    $result = $db->select($query);
?>
        <div class="grid_10">
		
            <div class="box round first grid">
                <h2>User Profile</h2>

                <?php
                if($_SERVER['REQUEST_METHOD']=='POST'){

                        $name = mysqli_real_escape_string($db->link,$_POST['name']);
                        $email = mysqli_real_escape_string($db->link,$_POST['email']);
                        $detail = mysqli_real_escape_string($db->link,$_POST['detail']);   
                        
                        if($email=="" || $name==""){
                            echo "<span class='error'>Field must not be empty</span>";
                        }
                        
                        else{
                            
                           
                            $userid=Session::get('userId');
                            $query="UPDATE  users set email='$email', name='$name', detail='$detail'  where id = '$userid'";
                            $result = $db->update($query);
                            if($result){
                            	 
                                echo "<span class='success'>User profile is updated successfully</span>";
                            }
                            else{
                                echo "<span class='error'>User profile is not updated successfully</span>";
                            }
                            $query = "SELECT * FROM users where id = '$userid'";
                            $result = $db->select($query);
                        }
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
                                <input type="text" name="name" value="<?php echo $user['name']?>" class="medium" />
                            </td>
                        </tr>
                     
                        <tr>
                            <td>
                                <label>Email</label>
                            </td>
                            <td>
                                <input type="text" name="email" value="<?php echo $user['email']?>" class="medium" />
                            </td>
                        </tr>
                  
                        <tr>
                            <td style="vertical-align: top; padding-top: 9px;">
                                <label>Detail</label>
                            </td>
                            <td>
                                <textarea class="tinymce" name="detail"><?php echo $user['detail'];?></textarea>
                            </td>
                        </tr>
                        
                        <?php }//end while
                                }//end if?>
						<tr>
                            <td></td>
                            <td>
                                <input type="submit" name="submit" Value="Update" />
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