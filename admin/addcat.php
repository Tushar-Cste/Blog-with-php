<?php include 'inc/Aheader.php';?>
<?php include 'inc/Asidebar.php';?>
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
                            $query="INSERT INTO categories(name) values('$name')";
                            $result = $db->insert($query);
                            if($result){
                                echo "<span class='success'>Category inserted successfully</span>";
                            }
                            else{
                                echo "<span class='error'>Category is not inserted successfully</span>";
                            }
                        }
                }
                ?>
   
                 <form action="" method="post">
                    <table class="form">					
                        <tr>
                            <td>
                                <input type="text" name='catname' placeholder="Enter Category Name..." class="medium" />
                            </td>
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