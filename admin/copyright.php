<?php include 'inc/Aheader.php';?>
<?php include 'inc/Asidebar.php';?>
        <div class="grid_10">
		
            <div class="box round first grid">
                <h2>Update Copyright Text</h2>
                <div class="block copyblock"> 
                 <?php
                if($_SERVER['REQUEST_METHOD']=='POST'){

                        $copyright = mysqli_real_escape_string($db->link,$_POST['copyright']);
                       
                        if(empty($copyright)){
                            echo "<span class='error'>Field must not be empty</span>";
                        }
                        else{
                            
                            $query = "UPDATE copyright SET note='$copyright' where id=1";
                            $result = $db->update($query);
                            if($result){
                                echo "<span class='success'>Copyright is updated successfully</span>";
                            }
                            else{
                                echo "<span class='error'>Copyright is not updated successfully</span>";
                            }
                        }
                }
                ?>
                <?php 
                    $query = "SELECT * FROM copyright where id = 1";
                    $result = $db->select($query);
                    if($result){
                        while($copyright = $result->fetch_assoc()){


                 ?>
                 <form action="" method="post">
                    <table class="form">					
                        <tr>
                            <td>
                                <input type="text" value="<?php echo $copyright['note'];?>" name="copyright" class="large" />
                            </td>
                        </tr>
						
						 <tr> 
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