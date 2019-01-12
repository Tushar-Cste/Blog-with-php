<?php include 'inc/Aheader.php';?>
<?php include 'inc/Asidebar.php';?>
<?php
    if(isset($_GET['deletepageid'])){
         $deletepageid = $_GET['deletepageid'];
        $query = "DELETE FROM pages where id = '$deletepageid'";
        $result = $db->delete($query);
        if($result){
        	echo "<script>alert('Page deleted successfully')</script>";
        	echo "<script>window.location = 'index.php';</script>";
        }
    }
?>
<?php
    if(!isset($_GET['pageid']) || $_GET['pageid']==NULL){
        header("Location:index.php");
    }
    else{
        $pageid = $_GET['pageid'];
        $query = "SELECT * FROM pages where id = '$pageid'";
        $result = $db->select($query);
    }
?>
<style type="text/css">
	.deletepage a{
	border: 1px solid #ddd;
    color: #444;
    cursor: pointer;
    font-size: 20px;
    padding: 2px 10px;
    font-weight: 300;
    background: #DDDDDD;
}
</style>
        <div class="grid_10">

		
            <div class="box round first grid">
                <h2>Page</h2>

                <?php
                if($_SERVER['REQUEST_METHOD']=='POST'){

                        $name = mysqli_real_escape_string($db->link,$_POST['name']);
                        $content = mysqli_real_escape_string($db->link,$_POST['content']);
                        $pageid=$_POST['pageid'];
                       
                        if($name==""||$content==""){
                            echo "<span class='error'>Field must not be empty</span>";
                        }
                        
                        else{
                            
                            $query="UPDATE pages set name = '$name', content='$content' where id = '$pageid'";
                            $result = $db->insert($query);
                            if($result){
                                echo "<span class='success'>Page is updated successfully</span>";
                            }
                            else{
                                echo "<span class='error'>Page is not updated successfully</span>";
                            }
                        }
                        $query = "SELECT * FROM pages where id = '$pageid'";
        				$result = $db->select($query);
                }
                ?>
                <div class="block">               
                 <form action="" method="post" enctype="multipart/form-data">
                 <?php 
                       	if($result){
                       		while ($page = $result->fetch_assoc()) {
                       		
                       		
                       ?>
                    <table class="form">
                       
                        <tr>
                            <td>
                                <label>Name</label>
                            </td>
                            <td>
                                <input type="text" name="name" value="<?php echo $page['name'];?>" class="medium" />
                                <input type="hidden" name="pageid" value="<?php echo $page['id'];?>">
                            </td>
                        </tr>
                     
                        
                   
                       
                        <tr>
                            <td style="vertical-align: top; padding-top: 9px;">
                                <label>Content</label>
                            </td>
                            <td>
                                <textarea class="tinymce" name="content"><?php echo $page['content'];?></textarea>
                            </td>
                        </tr>
                        
						<tr>
                            <td></td>
                            <td>
                                <input type="submit" name="submit" Value="update" />
                                <span class="deletepage"><a onclick="return confirm('Are you sure to delete')" href="?deletepageid=<?php echo $page['id'];?>">Delete</a></span>
                            </td>
                        </tr>
                    </table>
                    <?php }
                       	}?>
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