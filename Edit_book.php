<?php
ob_start();
session_start();
include ('databaseConnect.php');
?>
<?php
if(($_SESSION['user']!="") && ($_SESSION['user']=='admin'))
{
     $usern=$_SESSION['user'];
$id=$_GET["Book_id"];
$qry=  mysql_query("SELECT * from books WHERE Book_id='$id'");
$result=  mysql_fetch_array($qry);
?>
<?php
if($_POST["submit"]!="")
{
    $bk_id=$_POST['book_id'];
    $bk_title=$_POST['book_title'];
    $bk_issbn=$_POST['book_ISSBN'];
    $bk_author=$_POST['book_author'];
    $bk_copy=$_POST['book_copy'];
    $bk_publisher=$_POST['book_publisher'];
    $bk_category=$_POST['book_category'];
$updateQry=  mysql_query("UPDATE books SET Title='$bk_title', ISSBN='$bk_issbn', Author='$bk_author', Copies='$bk_copy', Publisher='$bk_publisher', Category='$bk_category' where Book_id='$bk_id'");
}
if($updateQry)
{
    header("location:browse_book.php");//return to the view page if update is successful.
}
?>
<html>
    <head>
        <link href="layout.css" type="text/css" rel="stylesheet">
        <title>Edit Book Details</title>
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
                <li>
                    <a href="user_registration.php">Register</a>
                </li>
                 <li>
                     <a href="add_book.php">Add Book</a>
                </li>
                <li>
                    <a href="search_book.php">Search</a>
                </li>
<!--                <li>
                    <a href="<?php // unset($_SESSION['user']) ?>">Logout</a>
                </li>-->
                <li>
                    <a href="browse_book.php">Browse Book</a>
                </li>
                <li>
                    <a href="profile.php">View Users</a>
                </li>
                <li class="midLi">Borrow
                    <ul>
                        <li>
                            <a href="#">View Borrowed Books</a>
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
                        <th colspan="2"><font color="red" size="2px"> <?php echo "<i>$msg</i>"?> </font></th>
                    </tr>
                    <tr>
                        <td>
                               Book_ID:
                        </td>
                        <td>
                            <input type="text" name="book_id" value="<?php echo $result['Book_id'];?>"><br>
                        </td>
                    </tr>
                    <tr>
                        <td>
                        Title:
                        </td>
                        <td>
                    <input type="text" name="book_title"  value="<?php echo $result['Title'];?>"><br> 
                        </td>
                    </tr>
                    <tr>
                        <td>
                        ISSBN:
                        </td>
                        <td>
                            <input type="text" name="book_ISSBN" value="<?php echo $result['ISSBN'];?>"><br>
                        </td>
                    </tr>
                    <tr>
                        <td>
                        Author:
                        </td>
                        <td>
                            <input type="text" name="book_author"  value="<?php echo $result['Author'];?>"><br>
                        </td>
                    </tr>
                    <tr>
                        <td>
                          Copies:
                        </td>
                        <td>
                            <input type="text" name="book_copy" value="<?php echo $result['Copies'];?>"><br>
                        </td>
                    </tr>
                    <tr>
                        <td>
                         Publisher:
                        </td>
                        <td>
                          <input type="text" name="book_publisher" value="<?php echo $result['Publisher'];?>"><br>  
                        </td>
                    </tr>
                    <tr>
                        <td>
            Category:
                        </td>
                        <td>
                            <select name="book_category" >
                                <option>Programming</option>
                                <option>Religion</option>
                                 <option>Accounting</option>
                                  <option>Mathematics</option>
                                   <option>Biology</option>
                                    <option>Chemistry</option>
                                     <option>History</option>
                                      <option>Motivational</option>
                                       <option>Relationship</option>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <th colspan="2">
            <center>  <input  class="button" type="submit" name="submit" value="Update"></center>
                </th>
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

