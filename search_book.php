<?php
ob_start();
session_start();
include ('databaseConnect.php');
?>
<?php
if(($_SESSION['user']!="") && ($_SESSION['user']=='admin'))
{
     $usern=$_SESSION['user'];
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
    {    $bk_category=$_POST['book_category'];

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
                    <a href="index.php">Home</a>
                </li>
<!--                <li>
                    <a href="#">Register</a>
                </li>-->
                <li>
                    <a href="search_book.php">Search</a>
                </li>
                 <li>
                    <a href="browse_book.php">Browse Book</a>
                </li>
                <li>
                    <a href="borrow_book.php">Borrow</a>
                </li>
               <li>
                    <a href="profile.php">View Users</a>
                </li>
            </ul>
            <br>
        <div class="content">
                 <form method="POST">
                <table class="tblBrowse" >
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
                            <input type="text" name="book_publisher">
                        </td>
                    </tr>
                    <tr>
                        <td>
            Category:
                        </td>
                        <td>
                            <select name="book_category">
                                <option>....select...</option>
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
            <center><input  class="button" type="submit" name="submit" value="Search"></center>
                </th>
                </tr>
                </table>
        </form>
            </div>
            <div class="search">
              
            </div>
                        <table class="tblBrowse" border="0">
         <tr>
            <th colspan="7" style="background-color: lightcoral; color: white; font-size: 30px;">SEARCH RESULT</th>
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
   $query="select * from books WHERE Book_id='1'";
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
