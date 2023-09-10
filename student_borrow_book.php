<?php
ob_start();
include ('databaseConnect.php');
?>
<?php
session_start();
if($_SESSION['user']!="")
{
    $usern=$_SESSION['user'];
if($_POST['submit']!="")
{
//    $Request_id=$_POST['request_id'];
    $bk_id=$_POST['book_id'];
    $student_id=$_POST['student_id'];
    $date=$_POST['date'];
    $issuedby=$_POST['issuedBy'];
    $expctdRetDate=$_POST['expectdReturnDate'];
    $returnstatus=$_POST['returnStatus'];
//    $bk_category=$_POST['book_category'];
    $msg="";
   if($bk_id!="" && $student_id!="" && $date!="" && $issuedby!="" && $expctdRetDate!="" && $returnstatus!="")
   {
    $query="insert into borrow_books values (null,'$bk_id','$student_id','$date','$issuedby','$expctdRetDate','$returnstatus','null','null','null')";
    $result=  mysql_query($query);
    
    if($result)
    {
      $msg="Borrow Record Added Successfully";  
    }
    else 
        {
        $msg="Borrow Record Not Added to database";
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
        <title>Borrow Book</title>
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
                    <a href="studentHome.php">Home</a>
                </li>
<!--                <li>
                    <a href="user_registration.php">Register</a>
                </li>-->
                <li>
                    <a href="student_search_book.php">Search</a>
                </li>
                <li>
                    <a href="student_browse_book.php">Browse Book</a>
                </li>
                <li>
                    <a href="student_borrow_book.php">Borrow</a>
                </li>
                <li>
                    <a href="student_return_book.php">Return</a>
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
                        Book ID:
                        </td>
                        <td>
                    <input type="text" name="book_id"><br> 
                        </td>
                    </tr>
                    <tr>
                        <td>
                        Student ID:
                        </td>
                        <td>
                            <input type="text" name="student_id" value="BSU/"><br>
                        </td>
                    </tr>
                    <tr>
                        <td>
                        Date:
                        </td>
                        <td>
                            <input type="text" name="date"><br>
                        </td>
                    </tr>
                    <tr>
                        <td>
                          Issued By:
                        </td>
                        <td>
                            <input type="text" name="issuedBy"><br>
                        </td>
                    </tr>
                    <tr>
                        <td>
                         Expected Return Date:
                        </td>
                        <td>
                            <input type="text" name="expectdReturnDate"><br>  
                        </td>
                    </tr>
                    <tr>
                        <td>
            Return Status:
                        </td>
                        <td>
                            <select name="returnStatus">
                                <option>select</option>
                               <option>Returned</option>
                                <option>Not Yet Returned</option>
                                 <option>Not Returned</option>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <th colspan="2">
            <center>  <input  class="button" type="submit" name="submit" value="Submit"></center>
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

