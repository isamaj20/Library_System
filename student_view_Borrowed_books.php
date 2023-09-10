<?php
include ('databaseConnect.php');
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
        </div>
        <div class="mid">
            <br>
            <ul>
                <li>
                    <a href="studentHome.php">Home</a>
                </li>
<!--                <li>
                    <a href="user_registration.php">Register</a>
                </li>-->
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
            </ul>
<center><font size="30px">BORROWED BOOK(S)</font></center>
                <table class="tblBorrow" border="1">
        <tr style="background-color: darkslategray">
<!--            <th align="left">
        Serial No.:
            </th>-->
            <th align="left">
        Request ID:
            </th>
            <th align="left">
        Book ID:
            </th>
            <th align="left">
        Student ID:
            </th>
            <th align="left">
        Book Title:
            </th>
            <th align="left">
        Date:
            </th>
            <th align="left">
        Issued By:
            </th>
            <th align="left">
        Expected Return Date:
            </th>
            <th align="left">
        Return Status:
            </th>
        </tr>
        <?php
        $k=0;
     $query="select * from borrow_books";
    $qry =  mysql_query($query);
    while ($result=  mysql_fetch_array($qry))
    { 
        $bk_id=$result['Book_id'];
         $book="select * from books where Book_id=$bk_id";
         $bookqry =  mysql_query($book);
         $bkresult= mysql_fetch_array($bookqry);
        $k++;
   ?>
        <tr>
<!--            <td>
             <?php // echo"               ".$k ?>
            </td>-->
            <td>
             <?php echo"               ". $result['Request_id'] ?>
            </td>
            <td>
            <?php echo"              ".$result['Book_id'] ?>
            </td>
             <td>
            <?php echo"               ". $result['Student_id'] ?>
            </td>
            <td>
            <?php echo"           ". $bkresult['Title']?>
            </td>
             <td>
            <?php echo"               ". $result['Date'] ?>
            </td>
             <td>
            <?php echo"               ". $result['Issued_by'] ?>
            </td>
             <td>
            <?php echo"           ". $result['Expected_Return_date'] ?>
            </td>
             <td>
            <?php echo"           ". $result['Return_status'] ?>
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
