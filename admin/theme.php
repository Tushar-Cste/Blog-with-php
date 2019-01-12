<?php include 'inc/Aheader.php';?>
<?php include 'inc/Asidebar.php';?>
     <div class="grid_10">
		
            <div class="box round first grid">
                <h2>Change Theme</h2>
               <div class="block copyblock"> 
               <?php
                if($_SERVER['REQUEST_METHOD']=='POST'){

                        $theme = mysqli_real_escape_string($db->link,$_POST['theme']);
                        
                            $query="UPDATE themes set theme='$theme' where id='1'";
                            $result = $db->update($query);
                            if($result){
                                echo "<span class='success'>Theme updated successfully</span>";
                            }
                            else{
                                echo "<span class='error'>Theme is not updated successfully</span>";
                            }
                        
                }
                ?>
                <?php 
                    $query = "SELECT * FROM themes where id = '1'";
                    $result = $db->select($query);
                    if($result){
                        while($theme = $result->fetch_assoc()){
                            ?>
                       
                 <form action="" method="post">
                    <table class="form">					
                        <tr>
                            <td>

                                <input type="radio" name='theme' value="default" <?php if($theme['theme'] == "default") echo "checked";?> />Default
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <input type="radio" name='theme' value="green" <?php if($theme['theme'] == "green") echo "checked";?> />Green
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <input type="radio" name='theme' value="red" <?php if($theme['theme'] == "red") echo "checked";?> />Red
                            </td>
                        </tr>
						<tr> 
                            <td>
                                <input type="submit" name="submit" Value="Change" />
                            </td>
                        </tr>
                    </table>
                    </form>
                    <?php  }
                    }
                ?>
                </div>
            </div>
        </div>
        <div class="clear">
        </div>
    </div>
    <div class="clear">
    </div>
    <?php include 'inc/Afooter.php';?>