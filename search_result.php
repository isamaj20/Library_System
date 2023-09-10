<?php
include ('databaseConnect.php');
$msg="";
if($_POST['submit']!="")
{
    $bk_title=$_POST['book_title'];
    $bk_issbn=$_POST['book_ISSBN'];
    $bk_author=$_POST['book_author'];
    $bk_publisher=$_POST['book_publisher'];
    $bk_category=$_POST['book_category'];
    if($bk_title!="" || $bk_issbn!="" || $bk_author!="" || $bk_publisher!="" || $bk_category!="")
    {
    $query="select * from books where Title='$bk_title' || ISSBN='$bk_issbn' || Author='$bk_author' || Publisher='$bk_publisher' || Category='$bk_category'";
    $qry =  mysql_query($query);
    $result=  mysql_fetch_array($qry);
   
    if($result['Title']!="" || $result['Author']!="" || $result['ISSBN']!="" || $result['Publisher']!="" || $result['Category']!="")
    {
        $msg="Book(s) Found";
//        header("location:browse_book.php");
    }
 else {
       $msg="No Book Found"; 
    }
     }  
    else 
        {
        $msg="Fill Atleast One Field";
        }
 }
?>
<html>
    <head>
        <link href="layout.css" type="text/css" rel="stylesheet">
        <title>Search Result</title>
    </head>
    <body>
        <div class="header">
            <br>
            LIBRARY MANAGEMENT SYSTEM
        </div>
<!--        <div class="left">
            left
        </div>-->
        <div class="mid">
            <br>
            <ul>
                <li>
                    <a href="index.php">Home</a>
                </li>
                <li>
                    <a href="user_registration.php">Register</a>
                </li>
                <li>
                    <a href="search_book.php">Search</a>
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
                 <form method="POST">
                <table class="tbl" border="0">
                    <tr style="background-color:darkslategray; color: white;">
                        <th colspan="2" >ENTER BOOK DETAILS BELOW</th>
                    </tr>
                    <tr>
                        <th colspan="2">
                
                               <font color="red" size="2px">
        <?php
   echo "<i>$msg</i>";
        ?>
                </font>
                        </th>
                    </tr>
                    <tr>
                        <td>
            Title:
                        </td>
                        <td>
                            <input type="text" name="book_title">
                        </td>
                    </tr>
                    <tr>
                        <td>
            ISSBN:
                        </td>
                        <td>
                            <input type="text" name="book_ISSBN">
                        </td>
                    </tr>
                    <tr>
                        <td>
            Author:
                        </td>
                        <td>
                            <input type="text" name="book_author">
                        </td>
                    </tr>
                    <tr>
                        <td>
            Publisher:
                        </td>
                        <td>
                            <input type="text" name="book_category">
                        </td>
                    </tr>
                    <tr>
                        <td>
            Category:
                        </td>
                        <td>
                            <input type="text" name="book_category">
                        </td>
                    </tr>
                    <tr>
                        <th colspan="2">
            <center><input  class="button" type="submit" name="submit" value="Search"></center>
                </th>
                </tr>
                </table>
        </form>
            </div>
                        <table class="tblBrowse" border="0">
         <tr>
            <th colspan="7" style="background-color: darkslategray; color: white">AVAILABLE BOOK </th>
         </tr>
        <tr style="background-color: darkslategray; color: white">
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
   $query="select * from books where Title='$bk_title' || ISSBN='$bk_issbn' || Author='$bk_author' || Publisher='$bk_publisher' || Category='$bk_category'";
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
             <?php echo"               ". $result['Title'] ?>
            </td>
            <td>
            <?php echo"              ".$result['Author'] ?>
            </td>
             <td>
            <?php echo"               ". $result['ISSBN'] ?>
            </td>
             <td>
            <?php echo"               ". $result['Publisher'] ?>
            </td>
             <td>
            <?php echo"               ". $result['Category'] ?>
            </td>
             <td>
            <?php echo"           ". $result['Copies'] ?>
            </td>
        </tr>
    <?php } ?>
                </table>
                <br>
<!--            <div class="leftmid">
                
            </div>-->
   </div>
        <div class="foot">
             &copy2015
        </div>
    </body>
</html>
