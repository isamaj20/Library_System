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
        <title>Browse Book</title>
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
                    <a href="adminHome.php">Home</a>
                </li>
<!--                <li>
                    <a href="adminReg.php">Register</a>
                </li>-->
                <li>
                    <a href="search_book.php">Search</a>
                </li>
                <li>
                     <a href="add_book.php">Add Book</a>
                </li>
                <li>
                    <a href="browse_book.php">Browse Book</a>
                </li>
                <li>
                    <a href="borrow_book.php">Borrow Book</a>
                </li>
                 <li>
                    <a href="profile.php">View Users</a>
                </li>
            </ul>
<center><font size="30px">AVAILABLE BOOK(S)</font></center>
                <table class="tblBrowse" border="1">
        <tr style="background-color: darkslategray">
            <th align="left">
        Serial No.:
            </th>
            <th align="left">
        Title:
            </th>
            <th align="left">
        Author:
            </th>
            <th align="left">
        ISSBN:
            </th>
            <th align="left">
        Publisher:
            </th>
            <th align="left">
        Category:
            </th>
            <th align="left">
        Available Copy(s):
            </th>
        </tr>
        <?php
        $k=0;
      
     $query="select * from books";
    $qry =  mysql_query($query);
    while ($result=mysql_fetch_array($qry))
    {  
        $id=$result['Book_id'];
        $copy=  mysql_query("select * from copies WHERE Book_id='$id'");
        $copyrs=  mysql_fetch_array($copy);
        $author=  mysql_query("select * from author WHERE Book_id='$id'");
        $authrs=  mysql_fetch_array($author);
        $publ=  mysql_query("select * from publisher WHERE Book_id='$id'");
        $publrs=  mysql_fetch_array($publ);
        $cat=  mysql_query("select * from category WHERE Book_id='$id'");
        $catrs=  mysql_fetch_array($cat);
        
        $k++;
   ?>
        <tr>
            <td>
             <?php echo"               ".$k ?>
            </td>
            <td>
             <?php echo"               ". $result['Title'] ?>
            </td>
            <td>
            <?php echo"              ".$authrs['Name'] ?>
            </td>
             <td>
            <?php echo"               ". $result['ISSBN'] ?>
            </td>
             <td>
            <?php echo"               ". $publrs['Name'] ?>
            </td>
             <td>
            <?php echo"               ". $catrs['Name'] ?>
            </td>
             <td>
            <?php echo"           ".$copyrs['Available'] ?>
            </td>
            <td>
                <a href="Edit_book.php?Book_id=<?php echo $id ?>">Edit</a>
            </td>
            <td>
                <a href="delete_book.php?Book_id=<?php echo $id ?>">Delete</a>
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