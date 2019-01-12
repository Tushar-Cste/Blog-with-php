<?php include 'inc/Aheader.php';?>
<?php include 'inc/Asidebar.php';?>
<?php
    if(!isset($_GET['postid']) || $_GET['postid']==NULL){
        header("Location:postlist.php");
    }
    else{
        $postid = $_GET['postid'];
        $query = "SELECT * FROM posts where id = '$postid'";
        $result = $db->select($query);
    }
?>
        <div class="grid_10">
		
            <div class="box round first grid">
                <h2>Add New Post</h2>

                <?php
                if($_SERVER['REQUEST_METHOD']=='POST'){

                        $title = mysqli_real_escape_string($db->link,$_POST['title']);
                        $categoryid = mysqli_real_escape_string($db->link,$_POST['categoryid']);
                        $body = mysqli_real_escape_string($db->link,$_POST['body']);
                        $tags = mysqli_real_escape_string($db->link,$_POST['tags']);
                        $author = mysqli_real_escape_string($db->link,$_POST['author']);
                        //$title = mysqli_real_escape_string($db->link,$_POST['title']);
                        /*echo $title.''.$categoryid;
                        exit();*/
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
                            $uploaded_image = "upload/".$unique_image;
                        }
                        
                        if($title==""||$categoryid==""||$body==""||$tags==""||$author==""){
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
                            
                            /*$query = "INSERT INTO posts(categoryid,title,body,image,author,tags,)   VALUES('$categoryid','$title','$body','$uploaded_image','$author','$tags')";
                            $inserted_rows = $db->insert($query);
                            if ($inserted_rows) {
                                 echo "<span class='success'>Post is successfully inserted
                                 </span>";
                            }
                            else {
                                echo "<span class='error'>Post is  not inserted successfully !</span>";
                            }*/
                            $editpostid=$_POST['postid'];
                            $query="UPDATE  posts set category_id='$categoryid',title='$title',body='$body',image='$uploaded_image',author='$author',tags='$tags' where id = '$editpostid'";
                            $result = $db->insert($query);
                            if($result){
                                echo "<span class='success'>Post updated successfully</span>";
                            }
                            else{
                                echo "<span class='error'>Post is not updated successfully</span>";
                            }
                            $query = "SELECT * FROM posts where id = '$editpostid'";
                            $result = $db->select($query);
                        }
                }
                ?>
                <?php 
                    if($result){
                        while($post = $result->fetch_assoc()){
                ?>
                <div class="block">               
                 <form action="" method="post" enctype="multipart/form-data">
                    <table class="form">
                       
                        <tr>
                            <td>
                                <label>Title</label>
                            </td>
                            <td>
                                <input type="text" name="title" value="<?php echo $post['title']?>" class="medium" />
                            </td>
                        </tr>
                     
                        <tr>
                            <td>
                                <label>Category</label>
                            </td>
                            <td>
                                <select id="select" name="categoryid">
                                    <option value="<?php echo $post['category_id']?>">
                                    <?php
                                        $pcategory=$post['category_id'];
                                        $query="SELECT * FROM categories where id ='$pcategory'";
                                        $pcresult=$db->select($query);
                                        if($pcresult){
                                            while($pcpost = $pcresult->fetch_assoc()){
                                                echo $pcpost['name'];
                                                 }
                                        }

                                    ?></option>
                                    <?php
                                        $query = "Select * from categories";
                                        $categories = $db->select($query);
                                        if($categories){
                                            while($category = $categories->fetch_assoc()){
                                    ?>
                                    <option value="<?php echo $category['id'];?>"><?php echo $category['name'];?></option>
                                    <?php }
                                        }?>
                                </select>
                            </td>
                        </tr>
                   
                        <tr>
                            <td>
                                <label>Upload Image</label>
                            </td>
                            <td>
                                <input type="hidden" name="hiddenimage" value="<?php echo $post['image']?>">
                                <input type="hidden" name="postid" value="<?php echo $_GET['postid'];?>">
                                <img src="<?php echo $post['image']?>" height="100px" width="200px">
                                <input type="file" name="image"  />
                            </td>
                        </tr>
                        <tr>
                            <td style="vertical-align: top; padding-top: 9px;">
                                <label>Content</label>
                            </td>
                            <td>
                                <textarea class="tinymce" name="body"><?php echo $post['body'];?></textarea>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label>Tags</label>
                            </td>
                            <td>
                                <input type="text" name="tags" value="<?php echo $post['tags'];?>" class="medium" />
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label>Author</label>
                            </td>
                            <td>
                                <input type="text" readonly name="author" value="<?php echo $post['author'];?>" class="medium" />
                            </td>
                        </tr>
                        <?php }//end while
                                }//end if?>
						<tr>
                            <td></td>
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