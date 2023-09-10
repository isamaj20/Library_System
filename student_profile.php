<?php
ob_start();
include ('databaseConnect.php');
?>
<?php
session_start();
if(($_SESSION['user']!="") && ($_SESSION['user']=='admin'))
{
     $usern=$_SESSION['user'];
?>
<html>
    <head>
        <link href="layout.css" type="text/css" rel="stylesheet">
        <title>User Profile</title>
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
        <div class="mid">
            <br>
            <ul>
                <li>
                    <a href="studentHome.php">Home</a>
                </li>
<!--                <li>
                    <a href="adminReg.php">Register</a>
                </li>-->
                <li>
                    <a href="student_search.php">Search</a>
                </li>
                <li>
                    <a href="student_browse_book.php">Browse Book</a>
                </li>
                <li>
                    <a href="student_borrow_book.php">Borrow Book</a>
                </li>
                <li>
                    <a href="student_profile.php">View Users</a>
                </li>
            </ul>
<center><font size="30px">LIBRARY USERS</font></center>
                <table class="tblBrowse" border="1">
        <tr style="background-color: darkslategray">
            <th align="left">
        Serial No.:
            </th>
            <th align="left">
        Matric No.:
            </th>
            <th align="left">
        Surname:
            </th>
            <th align="left">
        First Name:
            </th>
            <th align="left">
        Middle Name:
            </th>
            <th align="left">
        Login Username:
            </th>
            <th align="left">
        Option:
            </th>
        </tr>
        <?php
        $k=0;
     $query="select * from student";
    $qry =  mysql_query($query);
    while ($result=  mysql_fetch_array($qry))
    { 
        $k++;
   ?>
        <tr>
            <td>
             <?php echo"               ".$k ?>
            </td>
            <td>
             <?php echo"               ". $result['Student_id'] ?>
            </td>
            <td>
            <?php echo"              ".$result['Sname'] ?>
            </td>
             <td>
            <?php echo"               ". $result['Fname'] ?>
            </td>
             <td>
            <?php echo"               ". $result['Mname'] ?>
            </td>
             <td>
            <?php echo"               ". $result['User_id'] ?>
            </td>
            <td>
                <a href="student_viewProfile.php?User_id=<?php echo $result["User_id"] ?>">View Full Profile</a>
            </td>
        </tr>
    <?php } ?>
                </table>
                <br>
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