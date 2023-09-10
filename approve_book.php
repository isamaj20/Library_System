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
$getBook=mysql_query("select * from borrowbook where Book_id='$id'");
$reslt=  mysql_fetch_array($getBook);
$boroID=  mysql_num_rows($getBook);
$bro_id=$boroID+1;
//
$req=mysql_query("select * from request");
    $reqReslt= mysql_fetch_array($req);
//$bk_title=$reqReslt['Title'];
//$bk_issbn=$reqReslt['ISSBN'];
$reqst_id=$reqReslt['Request_id'];
$Sid=$reqReslt['Student_id'];
//
$bk_author=$reslt['Author_id'];
$aut=  mysql_query("select * from author Where Author_id='$bk_author'");
$autRs=mysql_fetch_array($aut);
$autName=$autRs['Name'];
//
$bk_cat=$reslt['Category_id'];
$cate=  mysql_query("select * from category WHERE Category_id='$bk_cat'");
$cateRs=mysql_fetch_array($cate);
$CatName=$cateRs['Name'];
//
$bk_publisher=$reslt['Publisher_id'];
$pub=  mysql_query("select * from publisher WHERE Publisher_id='$bk_publisher'");
$pubRs=mysql_fetch_array($pub);
$pubName=$pubRs['Name'];
/*
 *
$getCat=  mysql_query("select * from category where Book_id='$id'");
$catrst=  mysql_fetch_array($getCat);
$category_id=$catrst['Category_id'];
//Getting the Author ID
$getAuthor=  mysql_query("select * from author where Book_id='$id'");
$authorrst= mysql_fetch_array($getAuthor);
$author_id=$authorrst['Author_id'];
//Getting the Copy ID
//$getCopy=  mysql_query("select * from copies where Book_id='$id'");
//$copyrst=  mysql_fetch_array($getCopy);
//$copy_id=$copyrst['Copy_id'];
//Getting the Publisher ID
$getPublisher=  mysql_query("select * from publisher where Book_id='$id'");
$publisherrst=  mysql_fetch_array($getPublisher);
$publisher_id=$publisherrst['Publisher_id'];
 * 
*/
//
//$useQry=  mysql_query("select * from users WHERE User_id='$usern'");
//$useQryrs=  mysql_fetch_array($useQry);
//$userID=$useQryrs['User_id'];
//$stdQry=  mysql_query("select * from student WHERE User_id='$usern'");
//$stdQryrs=  mysql_fetch_array($stdQry);
//$Sid=$stdQryrs['Student_id'];
//
//Sending Book to Borrow
$Boro_date=  date('d:m:Y');
$xpctdRetrnDate=date('d:m:Y', strtotime('+1 week'));
$returnstatus="PENDING";
$dateRetrn="00:00:0000";
$recveBy="Nil";
$ReqQry="insert into borrowbook values ('$bro_id','$reqst_id','$id','$Sid','$Boro_date','$usern','$xpctdRetrnDate','$returnstatus','$dateRetrn','$recveBy')";
$result=  mysql_query($ReqQry);
if($result)
{ 
    $kk=  mysql_query("select * from copies");
    $kk1=  mysql_fetch_array($kk);
      $bk_avail=$kk1['Available']-1;
    // $bk_avail=-1;
     $boro=$kk1['Borrowed']+1;
   //  $boro=+1;
     $updt=  mysql_query("update copies set Borrowed='$boro', Available='$bk_avail'");
 echo" <script>alert('Request Sent');</script>";
 
 //header("location: add_book.php");
}
else {
   echo 'erro :'. mysql_error();
    echo" <script>alert('Request Not Sent');</script>";
    
    echo 'hmmm';
}
}
else {
  header("location: error_page.php");
}
?>
