<?php
 include ('databaseConnect.php');
 ?>
<?php
 $msg="";
 if(isset($_POST['submit'])!="")
{
     session_start();
  $username=$_POST['username'];
  $password=$_POST['password'];
  if($username!="" && $password!="")
  {    
  $qry= "SELECT * from users WHERE User_id='$username'";
  $query=mysqli_query($con,$qry);
$result= mysqli_fetch_array($query);
 $_SESSION['user']=$username;
if($username==$result{0} && $password==$result{0})
{
           
    header("Location:adminHome.php");
}else
if($username==$result['User_id'] && $password==$result['Password'])
{    
//            $_SESSION['user']=$username;
 header("Location:studentHome.php");
}
 else 
     {
       $msg="Wrong Username/Password";
     }
  }  else {
      $msg=" Please fill all fields";
  }
}
?>
<html>
    <head>
        <link href="layout.css" type="text/css" rel="stylesheet">
        <title>Home | Library Management System</title>
    </head>
    <body>
        <div class="header">
            <br>
             LIBRARY MANAGEMENT SYSTEM
        </div>
        <div class="midHome" style="background-image: url(Lib_img/livres.jpg); background-repeat: no-repeat; background-size: 100% 100%;">
            <br>
            <ul>
                <li>
                    <a href="index.php">Home</a>
                </li>
                <li>
                    <a href="user_registration.php">Register</a>
                </li>
                <li>
                    <a href="#">Search</a>
                </li>
                <li>
                    <a href="#">Browse Book</a>
                </li>
                <li>
                    <a href="#">Borrow</a>
                </li>
<!--                <li>
                    <a href="#">Return</a>
                </li>-->
            </ul>
         <br> 
            <div class="login">
            <form method="POST">
                <br>
                <table class="tbl">
                    <tr>
                        <th colspan="2"><font color="red" size="2px"><?php echo "<i>$msg</i>" ?></font></th>
                    </tr>
                    <tr>
                        <td>
                         Username:
                        </td>
                        <td>
                            <input type="text"  placeholder="<?php echo "Username"; ?>" name="username"><br>
                        </td>
                    </tr>
                    <tr>
                        <td>
                        Password:
                        </td>
                        <td>
                            <input type="password"  placeholder="Password" name="password"><br>
                        </td>
                    <tr>
                        <th colspan="2">
                <center><input class="button" type="submit" name="submit" value="Login"></center> 
                </th>
                </tr>
                </table>
            </form>
                <br>
            </div>
           <div class="imgAdsRight">
               <br>
<!--               <marquee behavior="alternate"> NOTE: New Librarian who has no user Account Should Contact Other Librarians For Username and Password</marquee>-->
            </div>
            <br><br><br><br><br><br><br><br>
            <div class="imgAds">
                <br>
                User Must <strong>LOGIN</strong> with their Username and Password before any Operation can be performed.
                <br>Click the <strong>REGISTER</strong> button above to create an Account (Non-Librarians Only).
            </div>
        </div>
        <div class="foot">
            &copy Ultimate Library 2015
        </div>
            
    </body>
</html>