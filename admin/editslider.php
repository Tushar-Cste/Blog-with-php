<?php include 'inc/Aheader.php';?>
<?php include 'inc/Asidebar.php';?>
<?php
    if(!isset($_GET['sliderid']) || $_GET['sliderid']==NULL){
        header("Location:sliderlist.php");
    }
    else{
        $sliderid = $_GET['sliderid'];
        $query = "SELECT * FROM sliders where id = '$sliderid'";
        $result = $db->select($query);
    }
?>
        <div class="grid_10">
		
            <div class="box round first grid">
                <h2>Add New Post</h2>

                <?php
                if($_SERVER['REQUEST_METHOD']=='POST'){

                        $title = mysqli_real_escape_string($db->link,$_POST['title']);
                        
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
                            $unique_image = substr(md5(time()), 0, 10).'.'.$file_ext;
                            $uploaded_image = "upload/slider/".$unique_image;
                        }
                        
                        if($title==""){
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
                            
                          
                            $editsliderid=$_POST['sliderid'];
                            $query="UPDATE  sliders set title='$title',image='$uploaded_image' where id = '$editsliderid'";
                            $result = $db->update($query);
                            if($result){
                                echo "<span class='success'>Slider updated successfully</span>";
                            }
                            else{
                                echo "<span class='error'>Slider is not updated successfully</span>";
                            }
                            $query = "SELECT * FROM sliders where id = '$editsliderid'";
                            $result = $db->select($query);
                        }
                }
                ?>
                <?php 
                    if($result){
                        while($slider = $result->fetch_assoc()){
                ?>
                <div class="block">               
                 <form action="" method="post" enctype="multipart/form-data">
                    <table class="form">
                       
                        <tr>
                            <td>
                                <label>Title</label>
                            </td>
                            <td>
                                <input type="text" name="title" value="<?php echo $slider['title']?>" class="medium" />
                            </td>
                        </tr>
                   
                        <tr>
                            <td>
                                <label>Upload Image</label>
                            </td>
                            <td>
                                <input type="hidden" name="hiddenimage" value="<?php echo $slider['image']?>">
                                <input type="hidden" name="sliderid" value="<?php echo $_GET['sliderid'];?>">
                                <img src="<?php echo $slider['image']?>" height="100px" width="200px">
                                <input type="file" name="image"  />
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