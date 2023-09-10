<?php
ob_start();
include ('databaseConnect.php');
$id=$_GET["Book_id"];
$getBook=mysql_query("select * from books where Book_id='$id'");
$reslt=  mysql_fetch_array($getBook);
$bk_title=$reslt['Title'];
$bk_issbn=$reslt['ISSBN'];
//$bk_author=$reslt['Author'];
//$bk_copy=$reslt['Copy'];
//$bk_publisher=$reslt['Publisher'];
$getCat=  mysql_query("select * from category where Book_id='$id'");
$catrst=  mysql_fetch_array($getCat);
$category_id=$catrst['Name'];
//Getting the Author ID
$getAuthor=  mysql_query("select * from author where Book_id='$id'");
$authorrst= mysql_fetch_array($getAuthor);
$author_id=$authorrst['Name'];
//Getting the Copy ID
$getCopy=  mysql_query("select * from copies where Book_id='$id'");
$copyrst=  mysql_fetch_array($getCopy);
$copy_id=$copyrst['Total'];
//Getting the Publisher ID
$getPublisher=  mysql_query("select * from publisher where Book_id='$id'");
$publisherrst=  mysql_fetch_array($getPublisher);
$publisher_id=$publisherrst['Name'];
//Sending Book to Archive
$archiveQry="insert into archive values ('$id','$bk_title','$bk_issbn','$author_id','$copy_id','$publisher_id','$category_id')";
$result=  mysql_query($archiveQry);
if($result)
{
//Deleting Book Records
$deleteQrybk=mysql_query("DELETE from books WHERE Book_id='$id'");
$deleteQrypbl=mysql_query("DELETE from publisher WHERE Book_id='$id'");
$deleteQrycpy=mysql_query("DELETE from copies WHERE Book_id='$id'");
$deleteQrycat=mysql_query("DELETE from category WHERE Book_id='$id'");
$deleteQryaut=mysql_query("DELETE from author WHERE Book_id='$id'");
  echo" <script>alert('Book Sent to Archive');</script>";
  header("location:browse_book.php");//return to the view page if update is successful.
   
}
else
{
    echo "<script>alert('Could not Delete Book');</script>";
   echo 'erro :'. mysql_error();
}
?>
