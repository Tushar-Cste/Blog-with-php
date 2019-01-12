<?php include 'inc/Aheader.php';?>
<?php include 'inc/Asidebar.php';?>
        <div class="grid_10">
		
            <div class="box round first grid">
                <h2>Update Social Media</h2>
                <div class="block">   
                <?php
                if($_SERVER['REQUEST_METHOD']=='POST'){

                        $facebook = mysqli_real_escape_string($db->link,$_POST['facebook']);
                        $twitter = mysqli_real_escape_string($db->link,$_POST['twitter']);
                        $google = mysqli_real_escape_string($db->link,$_POST['google']);
                        $linkedin = mysqli_real_escape_string($db->link,$_POST['linkedin']);
                        if(empty($facebook) || empty($twitter) || empty($google) || empty($linkedin)){
                            echo "<span class='error'>Field must not be empty</span>";
                        }
                        else{
                            
                            $query = "UPDATE socials SET facebook='$facebook', twitter='$twitter', google='$google', linkedin = '$linkedin' where id=1";
                            $result = $db->update($query);
                            if($result){
                                echo "<span class='success'>Socails updated successfully</span>";
                            }
                            else{
                                echo "<span class='error'>Socials is not updated successfully</span>";
                            }
                        }
                }
                ?>
                <?php 
                    $query = "SELECT * FROM socials where id = 1";
                    $result = $db->select($query);
                    if($result){
                        while($social = $result->fetch_assoc()){


                 ?>            
                 <form action="" method="post">
                    <table class="form">					
                        <tr>
                            <td>
                                <label>Facebook</label>
                            </td>
                            <td>
                                <input type="text" name="facebook" value="<?php echo $social['facebook'];?>" class="medium" />
                            </td>
                        </tr>
						 <tr>
                            <td>
                                <label>Twitter</label>
                            </td>
                            <td>
                                <input type="text" name="twitter" value="<?php echo $social['twitter'];?>" class="medium" />
                            </td>
                        </tr>
						
						 <tr>
                            <td>
                                <label>LinkedIn</label>
                            </td>
                            <td>
                                <input type="text" name="linkedin" value="<?php echo $social['linkedin'];?>" class="medium" />
                            </td>
                        </tr>
						
						 <tr>
                            <td>
                                <label>Google Plus</label>
                            </td>
                            <td>
                                <input type="text" name="google" value="<?php echo $social['google'];?>" class="medium" />
                            </td>
                        </tr>
						
						 <tr>
                            <td></td>
                            <td>
                                <input type="submit" name="submit" Value="Update" />
                            </td>
                        </tr>
                    </table>
                    </form>
                    <?php }
                    }?>
                </div>
            </div>
        </div>
        <div class="clear">
        </div>
    </div>
    <div class="clear">
    </div>
    <?php include 'inc/Afooter.php';?>