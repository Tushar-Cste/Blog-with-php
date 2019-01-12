<?php include 'inc/Aheader.php';?>
<?php include 'inc/Asidebar.php';?>
        <div class="grid_10">
		
            <div class="box round first grid">
                <h2>Add New Page</h2>

                <?php
                if($_SERVER['REQUEST_METHOD']=='POST'){

                        $name = mysqli_real_escape_string($db->link,$_POST['name']);
                        $content = mysqli_real_escape_string($db->link,$_POST['content']);
                        
                       
                        if($name==""||$content==""){
                            echo "<span class='error'>Field must not be empty</span>";
                        }
                        
                        else{
                            
                            $query="INSERT INTO pages(name, content) values('$name','$content')";
                            $result = $db->insert($query);
                            if($result){
                                echo "<span class='success'>Page created successfully</span>";
                            }
                            else{
                                echo "<span class='error'>Page is not created successfully</span>";
                            }
                        }
                }
                ?>
                <div class="block">               
                 <form action="" method="post" enctype="multipart/form-data">
                    <table class="form">
                       
                        <tr>
                            <td>
                                <label>Name</label>
                            </td>
                            <td>
                                <input type="text" name="name" placeholder="Enter Post Title..." class="medium" />
                            </td>
                        </tr>
                     
                        
                   
                       
                        <tr>
                            <td style="vertical-align: top; padding-top: 9px;">
                                <label>Content</label>
                            </td>
                            <td>
                                <textarea class="tinymce" name="content"></textarea>
                            </td>
                        </tr>
                        
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