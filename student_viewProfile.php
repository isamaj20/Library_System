<?php
ob_start();
session_start();
include ('databaseConnect.php');
?>
<?php
if(($_SESSION['user']!="") && ($_SESSION['user']=='admin'))
{
     $usern=$_SESSION['user'];
$id=$_GET["User_id"];
$qry=  mysql_query("SELECT * from student WHERE User_id='$id'");
$result=  mysql_fetch_array($qry);
$qry2=  mysql_query("SELECT * from users WHERE User_id='$id'");
$result2=  mysql_fetch_array($qry2);
?>
<html>
    <head>
        <link href="layout.css" type="text/css" rel="stylesheet">
        <title>View User Profile</title>
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
<!--        <div class="left">
            left
        </div>-->
        <div class="midHome"  style="background-image: url(Lib_img/livres.jpg); background-repeat: no-repeat; background-size: 100% 100%;">
            <br>
            <ul>
                <li>
                    <a href="index.php">Home</a>
                </li>
<!--                <li>
                    <a href="user_registration.php">Register</a>
                </li>-->
                <li>
                    <a href="student_search.php">Search</a>
                </li>
<!--                <li>
                    <a href="<?php // unset($_SESSION['user']) ?>">Logout</a>
                </li>-->
                <li>
                    <a href="student_browse_book.php">Browse Book</a>
                </li>
                <li>
                    <a href="student_profile.php">View Users</a>
                </li>
                <li class="midLi">Borrow
                    <ul>
                        <li>
                            <a href="student_view_Borrowed_books.php">View Borrowed Books</a>
                        </li>
                        <li>
                            <a href="student_borrow_book.php" style="padding-right:40px; padding-left: 25px; padding-bottom: 5px; padding-top: 5px;">Borrow Book</a>
                        </li>
                    </ul>
                </li>
            </ul>
            <br>
            <div class="content">
                 <form method="POST">
                <br>
                <table class="tbl">
                    <tr>
                        <th colspan="2"><img src="<?php echo $result['imageURL'];?>" height="100" width="120" alt="image"></th>
                    </tr>
                        <td>
                        Matric No.:
                        </td>
                        <td>
                    <?php echo $result['Student_id'];?> 
                        </td>
                    </tr>
                    <tr>
                        <td>
                        Surname:
                        </td>
                        <td>
                    <?php echo $result['Sname'];?>
                        </td>
                    </tr>
                    <tr>
                        <td>
                        First Name:
                        </td>
                        <td>
                    <?php echo $result['Fname'];?>
                        </td>
                    </tr>
                    <tr>
                        <td>
                          Middle Name:
                        </td>
                        <td>
                    <?php echo $result['Mname'];?>
                        </td>
                    </tr>
                    <tr>
                        <td>
                       Role :
                        </td>
                        <td>
                    <?php echo $result2['Role'];?>  
                        </td>
                    </tr>
                    <tr>
                        <td>
                       Status:
                        </td>
                        <td>
                    <?php echo $result2['Status'];?>  
                        </td>
                    </tr>
                    <tr>
                        <td>
                        Login ID:
                        </td>
                        <td>
                    <?php echo $result['User_id'];?>
                        </td>
                    </tr>
                    <tr>
                        <td>
                        Login Password:
                        </td>
                        <td>
                    <?php echo $result2['Password'];?>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            
                        </td>
                        <td align="center">
                            <a href="">EDIT</a>
                        </td>
                    </tr>
            </table>
                <br>
        </form>
      
                <br><br>
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
?>

