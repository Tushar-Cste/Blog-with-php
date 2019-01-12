<?php include 'inc/Aheader.php';?>
<?php include 'inc/Asidebar.php';?>
<?php
    if(!isset($_GET['catid']) || $_GET['catid']==NULL){
        header("Location:catlist.php");
    }
    else{
        $catid = $_GET['catid'];
        $query = "SELECT * FROM categories where id = '$catid'";
        $result = $db->select($query);
    }
?>
     <div class="grid_10">
		
            <div class="box round first grid">
                <h2>Add New Category</h2>
               <div class="block copyblock"> 
               <?php
                if($_SERVER['REQUEST_METHOD']=='POST'){

                        $name = mysqli_real_escape_string($db->link,$_POST['catname']);
                        if(empty($name)){
                            echo "<span class='error'>Field must not be empty</span>";
                        }
                        else{
                            $catid = $_POST['catid'];
                            $query = "UPDATE categories SET name='$name' where id='$catid'";
                            $result = $db->update($query);
                            if($result){
                                echo "<span class='success'>Category updated successfully</span>";
                            }
                            else{
                                echo "<span class='error'>Category is not updated successfully</span>";
                            }
                            $query = "SELECT * FROM categories where id = '$catid'";
                            $result = $db->select($query);
                        }
                }
                ?>
    
                 <form action="" method="post">
                    <table class="form">					
                        <tr>
                            <td>
                            <?php 
                                if($result){
                                    while($category = $result->fetch_assoc()){


                            ?>
                                <input type="text" name='catname' value="<?php echo $category['name'];?>" class="medium" />
                                <input type="hidden" name='catid' value="<?php echo $category['id'];?>" class="medium" />
                            </td>
                            <?php }//end while
                                }//end if?>
                        
                        </tr>
						<tr> 
                            <td>
                                <input type="submit" name="submit" Value="Save" />
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
    <?php include 'inc/Afooter.php';?>