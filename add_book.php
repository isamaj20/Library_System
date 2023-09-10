<?php
ob_start();
session_start();
include ('databaseConnect.php');
?>
<?php
 $msg="";
if(($_SESSION['user']!="") && ($_SESSION['user']=='admin'))
{
     $usern=$_SESSION['user'];
if(isset($_POST['submit'])!="")
{
    $bk_id=$_POST['book_id'];
    $bk_title=$_POST['book_title'];
    $bk_issbn=$_POST['book_ISSBN'];
    $bk_author=$_POST['book_author'];
    $bk_copy=$_POST['book_copy'];
    $bk_publisher=$_POST['book_publisher'];
    $bk_category=$_POST['book_category'];
    $boro=0;
    $ret=0;
    $msg="";
   if($bk_title!="" && $bk_issbn!="" && $bk_author!="" && $bk_copy!="" && $bk_publisher!="" && $bk_category!="")
   {
       $updateCopy=mysqli_query("select * from books");
    $updateReslt=  mysqli_fetch_array($updateCopy);
    $sn1=mysqli_num_rows($updateReslt);
    $sn=$sn1+1;
       //Inserting into book table
    $query="insert into books values ('$sn','$bk_title','$bk_issbn')";
    $result=  mysqli_query($query);
    //inserting into copy table

//    if($bk_id==$updateReslt['Book_id'] && $bk_title==$updateReslt['Title'])
//    {
//        $bk_copy=$bk_copy+1;
//        $updt=  mysqll_query("update copies set Available='$bk_copy',Total='$bk_copy'");
//    }
// else 
//     {
       $bk_copy=$bk_copy; 
       $copyqry="insert into copies values('$sn','$bk_id','$boro','$ret','$bk_copy',$bk_copy)";
    $copyreslt=  mysqli_query($copyqry);
    //}
    //inserting into publisher table
    $publqry="insert into publisher values('$sn','$bk_publisher','$bk_id')";
    $publreslt=  mysqli_query($publqry);
    //inserting into auyhor table
    $authqry="insert into author values('$sn','$bk_author','$bk_id')";
    $authreslt=  mysqli_query($authqry);
     //inserting into category
      $catqry="insert into category values('$sn','$bk_category','$bk_id')";
    $catreslt=  mysqli_query($catqry);
    //
    if($result && ($copyreslt || $updt) && $publreslt && $authreslt && $catreslt)
    {
      $msg="Book Added Successfully";  
    }
    else 
        {
        
        $msg=" Error :".mysqli_error();
        }
   }  
   else 
       {
       $msg="Fill All Fields";
   }
}
?>
<html>
    <head>
        <link href="layout.css" type="text/css" rel="stylesheet">
        <title>Add Book</title>
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
                if(isset($_POST['logout'])!="")
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
        <div class="midHome" style="background-image: url(Lib_img/livres.jpg); background-repeat: no-repeat; background-size: 100% 100%;">
            <br>
            <ul>
                <li>
                    <a href="index.php">Home</a>
                </li>
<!--                <li>
                    <a href="user_registration.php">Register</a>
                </li>-->
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
                            <a href="view_borrowed_books.php">View Borrowed Books</a>
                        </li>
                        <li>
                            <a href="borrow_book.php" style="padding-right:40px; padding-left: 25px; padding-bottom: 5px; padding-top: 5px;">Borrow Book</a>
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
                        <th colspan="2"><font color="red" size="2px"> <?php echo "<i>$msg</i>"?> </font></th>
                    </tr>
                    <tr>
                        <td>
                               Book_ID:
                        </td>
                        <td>
                            <input type="text" name="book_id"><br>
                        </td>
                    </tr>
                    <tr>
                        <td>
                        Title:
                        </td>
                        <td>
                    <input type="text" name="book_title"><br> 
                        </td>
                    </tr>
                    <tr>
                        <td>
                        ISSBN:
                        </td>
                        <td>
                            <input type="text" name="book_ISSBN"><br>
                        </td>
                    </tr>
                    <tr>
                        <td>
                        Author:
                        </td>
                        <td>
                            <input type="text" name="book_author"><br>
                        </td>
                    </tr>
                    <tr>
                        <td>
                          Copies:
                        </td>
                        <td>
                            <input type="text" name="book_copy"><br>
                        </td>
                    </tr>
                    <tr>
                        <td>
                         Publisher:
                        </td>
                        <td>
                          <input type="text" name="book_publisher"><br>  
                        </td>
                    </tr>
                    <tr>
                        <td>
            Category:
                        </td>
                        <td>
                            <select name="book_category">
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
            <center>  <input  class="button" type="submit" name="submit" value="Add"></center>
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

