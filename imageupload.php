<?php
include 'databaseConnect.php';
?>
<?php
if(isset($_POST["submit"]))
    {
$image=trim($_FILES["file"]["name"]);
$size=trim($_FILES["file"]["size"]);
$temp=trim($_FILES["file"]["tmp_name"]);
$extension=strtolower(substr($image,strpos($image,".")+1));//converting file extension image name into lower case//strrt()=help to removed image b4 dout//
$ima=time().substr(str_replace(" ","_",$image),5);// to generate  five roundown number first 5 alphabelt name of image//
$locate="images/pics/";
$imgpath=$locate.$ima;
if(isset($image)){
IF($extension!="jpg"&& $extension!="jpeg"&& $extension!="png"){
echo "<script>alert('invalid image');</script>";
}else{
//mysql_query("UPDATE student set imageurl='$imgpath' WHERE studentid='$sid'");
//move_uploaded_file($temp,$location);


mysql_query("insert into images values(null,'$imgpath')")or die(mysql_error());
//mysql_query("insert into evaluation.staff values('A001','Aboh','Paul','staff','makurdi','08068785261','abohpaul@gmail.com','')");

move_uploaded_file($temp,$imgpath);
echo "<script>alert('NEW STAFF ADDED SUCCESSFULLY');</script>";

}}
ob_start();
//header("location:viewallstudentbyclass.php");
ob_start();
    }
?>
<html>
    <head>
        <title></title>
    </head>
    <body>
        <form method="POST" enctype="multipart/form-data">
            <img src="<?php echo $imgpath ?>" height="300" width="300" alt="image"><br>
            <input type="file" name="file">
            <input type="submit" name="submit" value="submit">
        </form>
    </body>
</html>