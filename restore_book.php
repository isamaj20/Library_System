<?php
ob_start();
include ('databaseConnect.php');
$id=$_GET["Book_id"];
    $boro=0;
    $ret=0;
    $msg="";
   
       $updateCopy=  mysql_query("select * from books");
    $updateReslt=  mysql_fetch_array($updateCopy);
    $sn1=mysql_num_rows($updateCopy);
    $sn=$sn1+1;
    //
    $sel=  mysql_query("select * from archive");
    $selRst=  mysql_fetch_array($sel);
    $bk_id=$selRst['Book_id'];
    $bk_title=$selRst['Title'];
    $bk_issbn=$selRst['ISSBN'];
    $bk_author=$selRst['Author'];
    $bk_copy=$selRst['Copy'];
    $bk_publisher=$selRst['Publisher'];
    $bk_category=$selRst['Category'];
      // Inserting into book table
    $query="insert into books values ('$bk_id','$bk_title','$bk_issbn')";
    $result=  mysql_query($query);
    //inserting into copy table

//    if($bk_id==$updateReslt['Book_id'] && $bk_title==$updateReslt['Title'])
//    {
//        $bk_copy=$bk_copy+1;
//        $updt=  mysql_query("update copies set Available='$bk_copy',Total='$bk_copy'");
//    }
// else 
//     {
       //$bk_copy=$bk_copy; 
       $copyqry="insert into copies values('$sn','$bk_id','$boro','$ret','$bk_copy',$bk_copy)";
    $copyreslt=  mysql_query($copyqry);
    //}
    //inserting into publisher table
    $publqry="insert into publisher values('$sn','$bk_publisher','$bk_id')";
    $publreslt=  mysql_query($publqry);
    //inserting into auyhor table
    $authqry="insert into author values('$sn','$bk_author','$bk_id')";
    $authreslt=  mysql_query($authqry);
     //inserting into category
      $catqry="insert into category values('$sn','$bk_category','$bk_id')";
    $catreslt=  mysql_query($catqry);
    //
    if($result && $copyreslt && $publreslt && $authreslt && $catreslt)
    {
        $deleteQrybk=mysql_query("DELETE from archive WHERE Book_id='$id'");
        if($deleteQrybk)
        {
             header("location:archive.php"); 
        }
 else {
            echo 'cannot delete'.  mysql_error();
      }
       
    }
    else 
        {
        
        echo" Error :".mysql_error();
        } 
?>
