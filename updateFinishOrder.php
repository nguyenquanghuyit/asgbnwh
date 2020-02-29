<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title></title>
</head>

<body>
<?php 
$id=$_REQUEST["id_route"];

$cnn=mysqli_connect("192.168.1.208","trantienhoa","abc@123","asgbn_wh",3306);
$str="UPDATE tbl_order `to` SET `to`.StatusFinishOrder=1,statusLoad=1 WHERE `to`.StatusFinishOrder=0 AND `to`.ID_Order  IN (SELECT ld.ID_Order FROM tbl_loading ld WHERE ld.ID_Route=".$id.")";
echo $str;
if(mysqli_query($cnn,$str))
{
	echo "Update success";	
}
else
{
	echo "Update fail". mysqli_error($cnn);
}
mysqli_close($cnn);
header("location: vwrouteoutlist.php?cmd=reset");
?>
</body>
</html>