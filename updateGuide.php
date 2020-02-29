<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
</head>

<body>
<?php 
$OrderNo=$_REQUEST["OrderNo"];
$cnn=mysqli_connect("18.139.16.74","trantienhoa","abc@123","asgbn",3306);	
$str="SELECT OrderNo,Code,ID_Location,NotePickup,PalletID,PCS_In,PCS,tg.ProductName,tg.CreateDate,tg.Note_PalletId FROM tbl_guider tg WHERE tg.PCS>0 and OrderNo=".$OrderNo;
$rs=mysqli_query($cnn,$str);

$strDel="delete from tbl_orderguide where ID_Order=".$OrderNo;
mysqli_query($cnn,$strDel);

while($row=mysqli_fetch_assoc($rs)){
	$strIn="INSERT INTO tbl_orderguide(ID_Order,Code,ID_Location,Note_PickUp,PalletID,PCS_In,PCS,ProductName,DateIn,Note_PalletId)";
	$strIn=$strIn. " values(".$row["OrderNo"].",'".$row["Code"]."',".$row["ID_Location"].",'".$row["NotePickup"]."','".$row["PalletID"]."',".$row["PCS_In"].",".$row["PCS"].",'".$row["ProductName"]."','".$row["CreateDate"]."','".$row["Note_PalletId"]."')";
	//$OrderNo=$row["OrderNo"];	
	mysqli_query($cnn,$strIn);
		
}

mysqli_close($cnn);

header("location: tbl_orderview.php?showdetail=tbl_orderguide&ID_Order=".$OrderNo);
?>

</body>
</html>