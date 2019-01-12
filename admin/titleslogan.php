<?php include 'inc/Aheader.php';?>
<?php include 'inc/Asidebar.php';?>
<style type="text/css">
    .titleleftside{float: left; width: 70%;}
    .titlerightside{float: right; width: 20%;}
    .titlerightside img{height: 160px; width: 200px;}

</style>

        <div class="grid_10">
		
            <div class="box round first grid">
                <h2>Update Site Title and Description</h2>
                <div class="block sloginblock">   
                <div class="titleleftside">          
                 <form action="" method="POST" enctype="multipart/form-data">
                 <?php
                if($_SERVER['REQUEST_METHOD']=='POST'){

                        $title = mysqli_real_escape_string($db->link,$_POST['title']);
                        $slogan = mysqli_real_escape_string($db->link,$_POST['slogan']);
                        $file_name = $_FILES['image']['name'];
                        if($file_name==""){
                            $uploaded_image=$_POST['hiddenimage'];
                        }
                        else{
                            $permited  = array('jpg', 'jpeg', 'png', 'gif');
                            
                            $file_size = $_FILES['image']['size'];
                            $file_temp = $_FILES['image']['tmp_name'];

                            $div = explode('.', $file_name);
                            $file_ext = strtolower(end($div));
                            $unique_image = 'logo'.'.'.$file_ext;
                            $uploaded_image = "upload/".$unique_image;
                        }
                        
                        if($title==""||$slogan==""){
                            echo "<span class='error'>Field must not be empty</span>";
                        }
                        elseif ($file_name!="" && $file_size >1048567) {
                             echo "<span class='error'>Image Size should be less then 1MB!
                             </span>";
                        } 
                        elseif ($file_name !="" && in_array($file_ext, $permited) === false) {
                             echo "<span class='error'>You can upload only:-"
                             .implode(', ', $permited)."</span>";
                        } 
                        else{
                            if($file_name!=""){
                                unlink($_POST['hiddenimage']);
                                move_uploaded_file($file_temp, $uploaded_image);
                            }
                            
                            
                            $query="UPDATE  ttile_slogan set title = '$title', slogan = '$slogan', logo = '$uploaded_image' where id = 1";
                            $result = $db->insert($query);
                            if($result){
                                echo "<span class='success'>Title & Slogan is updated successfully</span>";
                            }
                            else{
                                echo "<span class='error'>Title & Slogan is not updated successfully</span>";
                            }
                        }
                }
                ?>
                 <?php 
                    $query = "SELECT * FROM ttile_slogan where id = 1";
                    $result = $db->select($query);
                    if($result){
                        while($title_slogan = $result->fetch_assoc()){


                 ?>
                    <table class="form">					
                        <tr>
                            <td>
                                <label>Website Title</label>
                            </td>
                            <td>
                                <input type="text" value="<?php echo $title_slogan['title'];?>"  name="title" class="medium" />
                            </td>
                        </tr>
						 <tr>
                            <td>
                                <label>Website Slogan</label>
                            </td>
                            <td>
                                <input type="text" value="<?php echo $title_slogan['slogan'];?>" name="slogan" class="medium" />
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label>Upload Logo</label>
                            </td>
                            <td>
                                <input type="hidden" name="hiddenimage" value="<?php echo $title_slogan['logo']?>">
                                <input type="file" name="image" class="medium" />
                            </td>
                        </tr>
						 
						
						 <tr>
                            <td>
                            </td>
                            <td>
                                <input type="submit" name="submit" Value="Update" />
                            </td>
                        </tr>
                    </table>
                    </form>
                    </div>  
                    <div class="titlerightside">
                        <img src="<?php echo $title_slogan['logo'];?>" alt="logo">
                    </div>
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
