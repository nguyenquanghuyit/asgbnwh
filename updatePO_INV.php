<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
</head>

<body>
<?php
// po=12&inv=22&IdOrder=159
include_once "mycnn.php";

$po=$_REQUEST["po"];
$inv=$_REQUEST["inv"];
$idOrder=$_REQUEST["idOrder"];
$dschon=$_REQUEST["chon"];
if(strlen($dschon)>0)
{
	$dschon=str_replace("on,","",$dschon);
}
// Step 1: update 

$mang=explode(",",substr($dschon,0,strlen($dschon)-1));
$id="";
for($i=0;$i<count($mang);$i++)
{
	$id.="'".$mang[$i]."',";
}
$id= substr($id,0,strlen($id)-1);

$strUpdate="UPDATE tbl_order_po_inv set PO_No='".$po."',INV_No='".$inv."' WHERE ID_PoInv in(".$id.")";
echo $strUpdate;
mysqli_query($cnn,$strUpdate);
header("location: tbl_order_po_invlist.php?showmaster=tbl_order&fk_ID_Order=".$idOrder);
?>
</body>
</html>