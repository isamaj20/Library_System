<?php
ob_start();
//include ('databaseConnect.php');
?>
<?php
session_start();
if($_SESSION['user']!="")
{
    $usern=$_SESSION['user'];
 ?> 
<html>
    <head>
        <link href="layout.css" type="text/css" rel="stylesheet">
        <title>Home | Library Management System</title>
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
        <div class="mid" style="background-image: url(Lib_img/kk.jpg); background-repeat: no-repeat; background-size: 100% 100%;">
            <br>
            <ul>
                <li>
                    <a href="index.php">Home</a>
                </li>
                <li>
                    <a href="user_registration.php">Register</a>
                </li>
                <li>
                    <a href="student_search.php">Search</a>
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
<!--                <li>
                    <a href="<?php unset($_SESSION['user']) ?>">Logout</a>
                </li>-->
            </ul>
            <br>
            <?php
//            echo "               Welcome ".$STDusern;
            ?>
            <div class="studentHomeLeft">
                
            </div>
            <div class="studentHomeMiddle">
                <br>
                  Welcome to the 21st Century Library System.<br><br>
                  <font color="darkgrey"> You Are Logged In  as (check username above)</font>
                
            </div>
            <div class="studentHomeRight">
                
            </div>
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
   header("location: error_page.php");;
}
?>