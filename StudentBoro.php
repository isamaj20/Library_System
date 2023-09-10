<?php
ob_start();
include ('databaseConnect.php');
?>
<?php
session_start();
if($_SESSION['user']!="")
{
   $usern=$_SESSION['user'];
   
$id=$_GET["Book_id"];
//
$stdQry=  mysql_query("select * from student WHERE User_id='$usern'");
$stdQryrs=  mysql_fetch_array($stdQry);
$Sid=$stdQryrs['Student_id'];
//
$getBook=mysql_query("select Student_id from borrowbook where Student_id='$Sid'");
$reslt=  mysql_fetch_array($getBook);
$boroCnt=  mysql_num_rows($getBook);
if($boroCnt<2)
{
$getBook=mysql_query("select * from books where Book_id='$id'");
$reslt=  mysql_fetch_array($getBook);
$bk_title=$reslt['Title'];
$bk_issbn=$reslt['ISSBN'];
//
$getBook2=mysql_query("select * from request where Book_id='$id'");
$reslt2=  mysql_fetch_array($getBook2);
$boroID2=  mysql_num_rows($getBook2);
$bro_id2=$boroID2+1;
//
$getCat=  mysql_query("select * from category where Book_id='$id'");
$catrst=  mysql_fetch_array($getCat);
$category_id=$catrst['Category_id'];
//Getting the Author ID
$getAuthor=  mysql_query("select * from author where Book_id='$id'");
$authorrst= mysql_fetch_array($getAuthor);
$author_id=$authorrst['Author_id'];
//Getting the Publisher ID
$getPublisher=  mysql_query("select * from publisher where Book_id='$id'");
$publisherrst=  mysql_fetch_array($getPublisher);
$publisher_id=$publisherrst['Publisher_id'];
//Sending Book to Borrow
$Req_date=  date('d:m:Y');
$ReqQry="insert into request values ('$bro_id2','$id','$Sid','$Req_date','$bk_title','$bk_issbn','$author_id','$publisher_id','$category_id')";
$result=  mysql_query($ReqQry);
if($result)
{
     header("location:studentHome.php");
}
 else {
    header("location:student_browse_book.php");
}
}
 else {
    echo "<script>alert('Sorry, You cant borrow more than two books. To borrow more please return the previous two books you borrowed')</script>";
   // header("location:student_browse_book.php");
}
}
else {
  header("location: error_page.php");
}
?>
