<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Pipi and see you. Love you :)</title>
</head>

<body>
<?php
include_once "mycnn.php";
require_once 'Classes/PHPExcel.php';

$target_dir  = "uploads/";
$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
$uploadOk    = 1;
if($target_file=="")
{
	echo "Not found file";
	return;
}
if (isset($_POST["submit"])) 
{
    if (file_exists($target_file)) 
	{
        //echo "Sorry, file already exists.";
        $uploadOk = 2;
        //return;
    }
	
    if ($uploadOk == 0) 
	{
        echo "Sorry, your file was not uploaded.";
		return;
    } 
	else 
	{		
		if($uploadOk != 2)
		{			
			if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) 
			{
				echo "The file " . basename($_FILES["fileToUpload"]["name"]) . " has been uploaded.";
				$uploadOk == 1;
			} 
			else 
			{
				echo "Sorry, there was an error uploading your file.";
				$uploadOk == 0;
				return;
			}
		}
    }
// --------------------------------------------------------------------------------------------------------	
if($uploadOk !=0 )
{	
	$file = $target_file;
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
			$data[$i-2][$j]= $sheet->getCellByColumnAndRow($j, $i)->getValue();
		}
	}
	//--------------------------------------------
	function checkExistCode($tscode,$tsPackingQty,$tsCnn)
	{
		$kq=-1;
		$strCheck="SELECT p.IdCode,p.CODE FROM tbl_product_detail p WHERE p.CODE='".$tscode."' AND p.PackingQty>=".$tsPackingQty;
		$tbl=mysqli_query($tsCnn,$strCheck);
		$num_rows=mysqli_num_rows($tbl);
		if($num_rows>0)
		{
			$kq=1;
		}
		return $kq;
	}
	//--------------------------------------------
	function checkExistCode_NoQty($tscode,$tsCnn)
	{
		$kq=-1;
		$strCheck="SELECT p.CODE FROM tbl_product p WHERE p.CODE='".$tscode."'";
		$tbl=mysqli_query($tsCnn,$strCheck);
		$num_rows=mysqli_num_rows($tbl);
		if($num_rows>0)
		{
			$kq=1;
		}
		return $kq;
	}
	//--------------------------------------------
//(tsIdType varchar(5),tsCode varchar(50),tsModal varchar(50),tsProductName varchar(255),tsVnName varchar(255),tsPackingQty int)	
	function insertNewItemCode($tsIdType,$tsCode,$tsModal,$tsProductName,$tsVnName,$tsPackingQty,$tsCnn)
	{
$strInsert="call proc_InsertNewCode('".$tsIdType."','".$tsCode."','".$tsModal."','".$tsProductName."','".$tsVnName."',".$tsPackingQty.")";
echo $strInsert."<br>"; 
		mysqli_query($tsCnn,$strInsert);	
		return;
	}
	//--------------------------------------------
	function getIdCode($tsCode,$tsCnn)
	{
		$idCode=-1;
		$strIdCode="SELECT p.IdCode FROM tbl_product_detail p WHERE p.CODE='".$tsCode."' AND p.DefaultCode=1";
		$tblId=mysqli_query($tsCnn,$strIdCode);
		$rows=mysqli_fetch_assoc($tblId);
		$idCode=$rows["IdCode"];
		return $idCode; 
	}
//--------------------------------------------
	function createNewRoute($tsLoadingID,$tsUser,$tsFile,$tsCnn)
	{
		$idRoute=-1;
		$strNewRoute="INSERT INTO tbl_route(LoadingID,CreateUser,AttachFile) VALUES('".$tsLoadingID."','".$tsUser."','".$tsFile."')";
		$strNew=mysqli_query($tsCnn,$strNewRoute);
		//mysqli_query($tsCnn,$strNew);	
		$tbl_GetId=mysqli_query($tsCnn,"SELECT MAX(ID_Route) AS 'Id_Route' FROM tbl_route");
		$rowsId=mysqli_fetch_assoc($tbl_GetId);
		$idRoute=$rowsId["Id_Route"];	
		return $idRoute;
	}
//----------------------------------------------	
	function getTypex($tsCnn,$tstype)
	{
		$IdType="";
		$strGetType="SELECT tp.IdType FROM tbl_producttype tp WHERE UCASE(SUBSTRING(tp.TypeName,1,3))='".strtoupper(substr($tstype,0,3))."'";
		//echo $strGetType."<br>";
		$tbl=mysqli_query($tsCnn,$strGetType);		
		if(mysqli_num_rows($tbl)>0)
		{
			$r=mysqli_fetch_assoc($tbl);
			$IdType =$r["IdType"];				
		}	
		return $IdType;
	}
	//--------------------------------------------
	foreach($data as $r)
	{
		$IdType=0;		
		// Return code of type
		if($r[0]!="")
		{
			$IdType=getTypex($cnn,$r[0]);
			//echo $IdType."<br>";
		}
		$code=$r[1];
		$modal=$r[2];
		$ProductName=$r[3];
		$VnName=$r[4];		
		
		if($r[5]!="")
		{			
			$PackingQty=(int)ltrim(rtrim(str_replace("qty/box","",strtolower($r[5]))));
			if(checkExistCode($code,$PackingQty,$cnn)!=1) // new Qty>= oldQty
			{	
				insertNewItemCode($IdType,$code,$modal,$ProductName,$VnName,$PackingQty,$cnn);
			}
		}
		else
		{
			$PackingQty=-1;
			if(checkExistCode_NoQty($code,$cnn)!=1)
			{	
				insertNewItemCode($IdType,$code,$modal,$ProductName,$VnName,$PackingQty,$cnn);
			}	
		}		
	}		
} // end if
} // end submit
header("location: tbl_productlist.php?cmd=reset");	
?>
</body>
</html>