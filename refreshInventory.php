
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
</head>
<?php set_time_limit(300); ?>
<body>
<?PHP 
$nam=(int)$_REQUEST["nam"];
$thang=(int)$_REQUEST["thang"];
if($thang==1)
{
	$thangTruoc=12;
	$namTruoc=$nam-1;
	}
else
{
	$thangTruoc=$thang-1;
	$namTruoc=$nam;
}

$cnn=mysqli_connect("192.168.1.208","trantienhoa","abc@123","asgbn_wh",3306);
if (!$cnn) 
{
    die("Kết nối thất bại: " . mysqli_connect_error());
}
// -----------------------------------------------------------------------
function soLgNhap($tsNamNhap,$tsThangNhap,$tsCode,$db)	
{	
	$stNhap="SELECT SUM(PCS_really) AS 'PCS',ProductName FROM vwinboudsumary WHERE Nam=".$tsNamNhap." AND Thang=".$tsThangNhap." AND Code='".$tsCode."' GROUP BY Code,ProductName";
	$dt=mysqli_query($db,$stNhap);			
	$kqNhap=0;			
	if (mysqli_num_rows($dt)>0)
	{
		$rowNhap=mysqli_fetch_assoc($dt);
		$kqNhap=$rowNhap["PCS"];
	}				
	return $kqNhap;
}
// ------------------------------------- end function
function soLgXuat($namXuat,$thangXuat,$tsCodeOut,$db)
{
	$stXuat="SELECT SUM(pcs) as 'PCS' FROM vwoutboudsumary WHERE Nam=".$namXuat." AND Thang=".$thangXuat." AND Code='".$tsCodeOut."' GROUP BY Code";		
	$dt=mysqli_query($db,$stXuat);			
	$kqXuat=0;		
	if (mysqli_num_rows($dt)>0)
	{
		$rowXuat=mysqli_fetch_assoc($dt);
		$kqXuat=$rowXuat["PCS"];
	}				
	return $kqXuat;
}	
// -------------------------------------- end function
function tinhTonDauKy($para_namTon,$para_thangTon,$para_maVtTon,$db)	
{	
	$stTon="select sum(ti.ClosingStock) as 'Tong' from tbl_inventory ti ";
	$stTon=$stTon." where In_Year=".$para_namTon." and ti.In_Month=".$para_thangTon." AND ti.Code='".$para_maVtTon."'";
	$stTon=$stTon." group by ti.Code HAVING sum(ti.ClosingStock)>=0";	
	
	$dt=mysqli_query($db,$stTon);			
	$kqTon=0;		
	if (mysqli_num_rows($dt)>0)
	{
		$rowTon=mysqli_fetch_assoc($dt);
		$kqTon=$rowTon["Tong"];
	}				
	return $kqTon;	
}
// ---------------------------------------- end function
$strClear="DELETE FROM tbl_inventory WHERE In_Year=".$nam." AND In_Month=" .$thang. " AND LockStock=0";
mysqli_query($cnn,$strClear);

$strProc="call procInsertInventory(".$nam.",".$thang.",".$namTruoc.",".$thangTruoc.")";
mysqli_query($cnn,$strProc);
// ----------- insert code moi phat sinh trong thang
$str="SELECT Code,ProductName,TypeName FROM vwinboudsumary WHERE thang=" .$thang. " AND Nam=".$nam." GROUP BY Code,ProductName,TypeName";

$rs=mysqli_query($cnn,$str);
if(mysqli_num_rows($rs)>0)
{
	while($row=mysqli_fetch_assoc($rs))
	{
		$code=$row["Code"];		
		$PCS_IN=soLgNhap($nam,$thang,$code,$cnn);	
		$PCS_OUT=soLgXuat($nam,$thang,$code,$cnn);	
		$productName=str_replace("'","",$row["ProductName"]);
		$TypeName=$row["TypeName"];
		
		$codeInStock="SELECT Code FROM tbl_inventory WHERE Code='".$code."' AND In_year=".$nam." AND In_month=".$thang;						
		$rsCodeInstock=mysqli_query($cnn,$codeInStock);
		
		if(mysqli_num_rows($rsCodeInstock)>0) // nếu tồn tại mã trong tháng, năm chỉ định => Update
		{	
			$strUpdate="UPDATE tbl_inventory ti SET ti.TypeName='".$TypeName."', ti.PCS_IN=".$PCS_IN.",ti.PCS_OUT=".$PCS_OUT.",ProductName='".$productName."'";
			//echo $strUpdate."<br>";
			$strUpdate=$strUpdate." WHERE ti.In_Year=".$nam." AND ti.In_Month=".$thang." AND ti.Code='".$code."' AND ti.LockStock=0";
			mysqli_query($cnn,$strUpdate);
		}
		else
		{	
			$strInsert="INSERT INTO tbl_inventory(In_Year,In_Month,Code,TypeName,ProductName,OpeningStock,PCS_IN,PCS_OUT,LockStock)";
			$strInsert=$strInsert."	values(".$nam.",".$thang.",'".$code."','".$TypeName."','".$productName."',0,".$PCS_IN.",".$PCS_OUT.",0)";
			mysqli_query($cnn,$strInsert);
			//echo $strInsert;
		}	
	}
}
$str="SELECT Code,ProductName,TypeName FROM vwinboudsumary WHERE thang=" .$thangTruoc. " AND Nam=".$namTruoc." AND code NOT IN (SELECT code FROM tbl_inventory";
$str= $str." WHERE thang=" .$thang. " AND Nam=".$nam.") GROUP BY Code,ProductName,TypeName";

$rs=mysqli_query($cnn,$str);
if(mysqli_num_rows($rs)>0)
{
	while($row=mysqli_fetch_assoc($rs))
	{
		$code=$row["Code"];		
		$PCS_IN=soLgNhap($nam,$thang,$code,$cnn);	
		$PCS_OUT=soLgXuat($nam,$thang,$code,$cnn);	
		$productName=str_replace("'","",$row["ProductName"]);
		$TypeName=$row["TypeName"];
		$strUpdate="UPDATE tbl_inventory ti SET ti.TypeName='".$TypeName."', ti.PCS_IN=".$PCS_IN.",ti.PCS_OUT=".$PCS_OUT.",ProductName='".$productName."'";
		$strUpdate=$strUpdate." WHERE ti.In_Year=".$nam." AND ti.In_Month=".$thang." AND ti.Code='".$code."' AND ti.LockStock=0";
		$cmd=mysqli_query($cnn,$strUpdate);		
		//echo $strUpdate."<br>";
	}
}

header("location: tbl_inventorylist.php");

?>
</body>
</html>