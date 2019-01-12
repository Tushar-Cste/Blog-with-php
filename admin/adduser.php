<?php include 'inc/Aheader.php';?>
<?php include 'inc/Asidebar.php';?>
<?php
    if(Session::get('userRole') != 0)
        echo "<script>window.location = 'userlist.php';</script>"
?>
     <div class="grid_10">
		
            <div class="box round first grid">
                <h2>Add New User</h2>
               <div class="block copyblock"> 
               <?php
                if($_SERVER['REQUEST_METHOD']=='POST'){
                        $username = $fm->validation($_POST['username']);
                        $userpassword = md5($fm->validation($_POST['userpassword']));
                        $userrole=$fm->validation($_POST['userrole']);
                        $useremail = $fm->validation($_POST['useremail']);
                        $username = mysqli_real_escape_string($db->link,$username);
                        $userpassword = mysqli_real_escape_string($db->link,$userpassword);
                        $userrole = mysqli_real_escape_string($db->link,$userrole);
                        $useremail = mysqli_real_escape_string($db->link,$useremail);
                        if(empty($username) || empty($userpassword) || empty($userrole) || empty($useremail)){
                            echo "<span class='error'>Field must not be empty</span>";
                        }
                        else{
                            $checkemail = "Select * from users where email = '$useremail' limit 1";
                            $emailexist = $db->select($checkemail);
                            if($emailexist){
                                echo "<span class='error'>Email already exist.</span>";
                            }
                            else{
                                $query="INSERT INTO users(name,password,role,email) values('$username','$userpassword','$userrole','$useremail')";
                                $result = $db->insert($query);
                                if($result){
                                    echo "<span class='success'>User inserted successfully</span>";
                                }
                                else{
                                    echo "<span class='error'>User is not inserted successfully</span>";
                                }
                            }
                        }
                }
                ?>
   
                 <form action="" method="post">
                    <table class="form">					
                        <tr>
                            
                            <td>
                                <label>Username</label>
                            </td>
                            <td>
                                <input type="text" name='username' placeholder="Enter User Name..." class="medium" />
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label>Password</label>
                            </td>
                            <td>
                                <input type="text" name='userpassword' placeholder="Enter User Password..." class="medium" />
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label>Email</label>
                            </td>
                            <td>
                                <input type="text" name='useremail' placeholder="Enter User Password..." class="medium" />
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label>User Role</label>
                            </td>
                            <td>
                                <select id="select" name="userrole" class="medium">
                                    <option>Add User Role</option>    
                                    <option value="0">Admin</option>
                                    <option value="1">Author</option>
                                    <option value="2">Editor</option>
                                </select>
                            </td>
                        </tr>
						<tr> 
                            <td></td>
                            <td>
                                <input type="submit" name="submit" Value="Create" />
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