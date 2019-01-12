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
                    echo "<script>window.location = 'postlist.php';</script>";
                        
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
                                <input type="text" readonly name="title" value="<?php echo $post['title']?>" class="medium" />
                            </td>
                        </tr>
                     
                        <tr>
                            <td>
                                <label>Category</label>
                            </td>
                            <td>
                                <select id="select" readonly name="categoryid">
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
                                <img readonly src="<?php echo $post['image']?>" height="100px" width="200px">
                                
                            </td>
                        </tr>
                        <tr>
                            <td style="vertical-align: top; padding-top: 9px;">
                                <label>Content</label>
                            </td>
                            <td>
                                <textarea readonly class="tinymce" name="body"><?php echo $post['body'];?></textarea>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label>Tags</label>
                            </td>
                            <td>
                                <input type="text" readonly name="tags" value="<?php echo $post['tags'];?>" class="medium" />
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