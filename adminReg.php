<?php
ob_start();
include ('databaseConnect.php');
?>
<?php
session_start();
if(($_SESSION['user']!="") && ($_SESSION['user']=='admin'))
{
     $usern=$_SESSION['user'];
if($_POST['submit']!="")
{
$surname=$_POST['Sname'];
$firstname=$_POST['Fname'];
$middlename=$_POST['Mname'];
$staff_id=$_POST['ID'];
$username=$_POST['Username'];
$password1=$_POST['password1'];
$password2=$_POST['password2'];
$role="Admin";
$status="Active";
 $msg="";
 
    if($surname!="" && $firstname!="" && $middlename!="" && $staff_id!="" && $username!="" && $password!="")
   {
        $stnd= mysql_query("select * from librarian where Librarian_id='$staff_id'");
       $stndRst=  mysql_fetch_array($stnd);
       if($staff_id!==$stndRst['Librarian_id'])
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
   $query="insert into librarian values('$staff_id','$firstname','$surname','$middlename')";
    $insrtquery=mysql_query($query);
    $query2="insert into users values('$username','$password','$role','$status')";
   $insrtquery2=mysql_query($query2);
  if($insrtquery2 && $insrtquery)
   {
      $msg="Record added Correctly";
      header("Location:adminHome.php");
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
      $msg="Staff ID Already Exist";    
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
        <title>Registration | Librarian</title>
    </head>
    <body>
        <div class="header">
            <br>
            LIBRARY MANAGEMENT SYSTEM
            <br>
             <div class="user">
                <font color="darkslategrey"> Current User:</font> <?php
            echo "$usern ";
            $_SESSION['user']=$usern;
            ?>
                <?php 
                if($_POST['logout']!="")
                {
                    unset($_SESSION['user']);
                    session_destroy();
                    header("Location:index.php");
                }
                ?>
                <form method="POST">
                   <input type="submit" class="Logout_button" name="logout" value="LOGOUT">
               </form>
            </div>
        </div>
        <div class="midHome" style="background-image: url(Lib_img/Book20Groups.jpg); background-repeat: no-repeat; background-size: 100% 100%;">
            <br>
            <ul>
               <li>
                    <a href="index.php">Home</a>
                </li>
                <li>
                    <a href="adminReg.php">Register</a>
                </li>
                 <li>
                     <a href="add_book.php">Add Book</a>
                </li>
                <li>
                    <a href="search_book.php">Search</a>
                </li>
                <li>
                    <a href="browse_book.php">Browse Book</a>
                </li>
                <li class="midLi">Borrow
                    <ul>
                        <li>
                            <a href="view_borrowed_books.php">View Borrowed Books</a>
                        </li>
                        <li>
                            <a href="borrow_book.php" style="padding-right:40px; padding-left: 25px; padding-bottom: 5px; padding-top: 5px;">Borrow Book</a>
                        </li>
                    </ul>
                </li>
<!--                <li>
                    <a href="#">Return</a>
                </li>-->
            </ul>
            <br>
         <div class="content">
             <form method="POST">
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
            Staff ID:
    </td>
    <td> 
        <input type="text" name="ID">
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
    <td colspan="2">
            <center> <input class="button" type="submit" name="submit" value="Register"></center>
    </td>
</tr>    
            </table>
                 <br>
                 </form>
        </div>
        </div>
        <div class="foot">
           &copy2015
        </div>
    </body>
</html>
<?php

            $_SESSION['user']=$usern;
}  else {
   header("location: error_page.php");
}
