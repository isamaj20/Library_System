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
        <title>Home | Admin.</title>
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
        <div class="midHome" style="background-image: url(Lib_img/kk.jpg); background-repeat: no-repeat; background-size: 100% 100%;">
            <br>
            <ul>
                <li>
                    <a href="index.php">Home</a>
                </li>
<!--                <li>
                    <a href="adminReg.php">Register</a>
                </li>-->
                 <li>
                     <a href="add_book.php">Add Book</a>
                </li>
                <li>
                    <a href="search_book.php">Search</a>
                </li>
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
            <?php
           
            ?>
        </div>
        <div class="foot">
           &copy2015
        </div>
    </body>
</html>
<?php
$_SESSION['user']=$usern;
}
else {
header("location: error_page.php");
   
}
?>

