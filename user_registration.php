<?php
include ('databaseConnect.php');
?>
<?php
session_start();
if($_POST['submit']!="")
{
$surname=$_POST['Sname'];
$firstname=$_POST['Fname'];
$middlename=$_POST['Mname'];
$student_id=$_POST['ID'];
$username=$_POST['Username'];
$password1=$_POST['password1'];
$password2=$_POST['password2'];
$role="Student";
$status="Active";
 $msg="";
 //image Upload
 $image=trim($_FILES["file"]["name"]);
$size=trim($_FILES["file"]["size"]);
$temp=trim($_FILES["file"]["tmp_name"]);
$extension=strtolower(substr($image,strpos($image,".")+1));//converting file extension image name into lower case//strrt()=help to removed image b4 dout//
$ima=time().substr(str_replace(" ","_",$image),5);// to generate  five roundown number first 5 alphabelt name of image//
$locate="images/pics/";
$imgpath=$locate.$ima;

    if($surname!="" && $firstname!="" && $middlename!="" && $student_id!="" && $username!="" && $password!="" && $image!="")
   {
        $stnd= mysql_query("select * from student where Student_id='$student_id'");
       $stndRst=  mysql_fetch_array($stnd);
       if($student_id!==$stndRst['Student_id'])
       {

    if(isset($image))
     {
if($extension=="jpg" || $extension=="jpeg" || $extension=="png")
    {
    $qry=  mysql_query("SELECT * from users WHERE User_id='$username'");
   $result=  mysql_fetch_array($qry);
        if($username!==$result['User_id'])
            {
            if($password1!==$password2)
{
  $msg="Password Mismatch";
}  
else
    {
       $password=$password1;
   $query="insert into student values('$student_id','$firstname','$surname','$middlename','$username','$imgpath')";
    $insrtquery=mysql_query($query);
    move_uploaded_file($temp,$imgpath);
    $query2="insert into users values('$username','$password','$role','$status')";
   $insrtquery2=mysql_query($query2);
  if($insrtquery2 && $insrtquery)
   {
       $_SESSION['user']=$username;
      $msg="Record added Correctly";
      header("Location:studentHome.php");
   }
 else
     {
       $msg="Failed.";
   }
  
       }
    } 
else
    {
    $msg="Username Already Exist";
    }    
     }
 else {
       $msg="invalid image Format";  
     }
    }
     else
         {
$msg="Please select an Image pile";
}
         }
 else {
      $msg="Student ID Already Exist";    
     }
}
else 
     {
       $msg='All Fields are Required'; 
   }
}
?>
<html>
            <head>
        <link href="layout.css" type="text/css" rel="stylesheet">
        <title>User Registration</title>
    </head>
    <body>
        <div class="header">
            <br>
            LIBRARY MANAGEMENT SYSTEM
        </div>
<!--        <div class="left">
            left
        </div>-->
        <div class="midHome"  style="background-image: url(Lib_img/books.jpg); background-repeat: no-repeat; background-size: 100% 100%;">
            <br>
            <ul>
                <li>
                    <a href="index.php">Home</a>
                </li>
<!--                <li>
                    <a href="user_registration.php">Register</a>
                </li>-->
                <li>
                    <a href="#">Search</a>
                </li>
                <li>
                     <a href="#">Browse Book</a>
                </li>
                <li>
                    <a href="#">Borrow</a>
                </li>
                <li>
                    <a href="#">Return</a>
                </li>
            </ul>
            <br>
         <div class="content">
           <form method="POST" enctype="multipart/form-data">
                 <br>
                 <table class="tbl">
<tr>
    <th colspan="2" ><font color="red" size="2px"> <?php echo "<i>$msg</i>" ?></font></th>
</tr>
<tr>
    <th colspan="2" align="left">Personal Details</th>
</tr>
<tr>
    <td>       
            Surname:
    </td>
    <td>
        <input type="text" name="Sname">
    </td>
</tr>
<tr>
    <td>
            First Name: 
    </td>
    <td>
        <input type="text" name="Fname"><br>
    </td>
</tr>
<tr>
    <td>
            Middle Name:
    </td>
    <td> 
        <input type="text" name="Mname">
    </td>
</tr>
<tr>
    <td>
            Student ID:
    </td>
    <td> 
        <input type="text" name="ID">
     </td>
</tr>
<tr>
    <td>
            Upload Image:
    </td>
    <td> 
        <input type="file" name="file">
     </td>
</tr>
<th colspan="2" align="left">Login Details</th>
<tr>
    <td>
            Username:
    </td>
    <td>
        <input type="text" name="Username">
    </td>
</tr>
<tr>
    <td>
            Password:
    </td>
    <td>
         <input type="password" name="password1">
    </td>
</tr>
<tr>
    <td>
            Confirm Password:
    </td>
    <td> 
        <input type="password" name="password2">
    </td>
</tr>
<tr>
    <th colspan="2" align="">
            <input class="button" type="submit" name="submit" value="Register">
    </th>
</tr>    
            </table>
                 <br>
                 </form>
        </div>
            <br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
            NOTE: This Page Is Meant For Every User Except Adminitrators/Librarians 
        </div>
        <div class="foot">
           &copy2015
        </div>
    </body>
</html>
