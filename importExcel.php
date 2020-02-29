<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
</head>

<body>
<?php 
include_once "mycnn.php";
require_once 'Classes/PHPExcel.php';

$file_name=$_REQUEST["file_name"];
$myfile="uploads/".$file_name;
$file = $myfile;
$objFile = PHPExcel_IOFactory::identify($file);
$objData = PHPExcel_IOFactory::createReader($objFile);
$objData->setReadDataOnly(true);
$objPHPExcel = $objData->load($file);
$sheet  = $objPHPExcel->setActiveSheetIndex(0);
$Totalrow = $sheet->getHighestRow();
$LastColumn = $sheet->getHighestColumn();
$TotalCol = PHPExcel_Cell::columnIndexFromString($LastColumn);
$data = array();

for ($i = 2; $i <= $Totalrow; $i++)
{
	for ($j = 0; $j < $TotalCol; $j++)
	{
		if($j==4){
			$data[$i-2][$j]= date('Y-m-d',PHPExcel_Shared_Date::ExcelToPHP($sheet->getCellByColumnAndRow($j, $i)->getValue()));
		}
		else
		{
			$data[$i-2][$j]= $sheet->getCellByColumnAndRow($j, $i)->getValue();;
		}
	}
}
//--------------------------------------------
//	$sqlDel="delete from tbl_unload where ID_Route=".$ID_Route;
//	mysqli_query($cnn,$sqlDel);
//--------------------------------------------
function checkExistCode($tscode,$tsPackingQty,$tsCnn)
{
	$kq=-1;
	$strCheck="SELECT p.CODE FROM tbl_product_detail p WHERE p.CODE='".$tscode."' AND p.PackingQty>=".$tsPackingQty;
	$tbl=mysqli_query($tsCnn,$strCheck);
	$num_rows=mysqli_num_rows($tbl);
	if($num_rows>0)
	{
		$kq=1;
	}
	return $kq;
}
//--------------------------------------------
function insertNewItemCode($tsCode,$tsProductName,$tsPackingQty,$tsCnn)
{
	$strInsert="call proc_InsertNewCode('".$tsCode."','".$tsProductName."',".$tsPackingQty.")";
	mysqli_query($tsCnn,$strInsert);	
}
//--------------------------------------------
function getIdCode($tsCode,$tsCnn)
{
	$idCode=-1;
	$strIdCode="SELECT IdCode FROM tbl_product_detail WHERE CODE='".$tsCode."' AND DefaultCode=1";
	$tblId=mysqli_query($tsCnn,$strIdCode);
	$rows=mysqli_fetch_assoc($tblId);
	$idCode=$rows["IdCode"];
	return $idCode; 
}
//--------------------------------------------
foreach($data as $r)
{
	$code=$r[0];
	$ProductName=$r[1];
	$PackingQty=(int)str_replace("qty/box","",strtolower($r[2]));	
	if(checkExistCode($code,$PackingQty,$cnn)!=1) // new Qty>= oldQty
	{		
		insertNewItemCode($code,$ProductName,$PackingQty,$cnn);
	}
}
//--------------------------------------------
foreach($data as $r)
{
	$code=$r[0];
	$IdCode=getIdCode($code,$cnn);
	$pcs=0;
	if($r[2]!="")
	{
		$pcs=(int)$r[2];
	}
	$MFG=$r[4];
	$sqlInsert="INSERT INTO tbl_unload(ID_Route,Code,PCS,IdCode,MFG) VALUE(".$ID_Route.",'".$code."',".$pcs.",".$IdCode.",'".$MFG."')";
	mysqli_query($cnn,$sqlInsert);
}
header("location: tbl_unloadlist.php?showmaster=tbl_route&fk_ID_Route=".$ID_Route);	
?>
</body>
</html>