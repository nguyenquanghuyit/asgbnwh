<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
        "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>Untitled Document</title>
</head>

<body>
<?php
include_once "mycnn.php";
require_once 'Classes/PHPExcel.php';

$target_dir = "uploads/";
$getFile = $_FILES["fileToUpload"]["name"];
$fileName = explode(".xl", $getFile);
$newFileName = $fileName[0] . "_" . date("Y-m-d-H-i", time()) . ".xl" . $fileName[1];

$target_file = $target_dir . basename($newFileName);
$uploadOk = 1;
if ($target_file == "") {
    echo "Not found file";
    return;
}
if (isset($_POST["submit"])) {
    if (file_exists($target_file)) {
        //echo "Sorry, file already exists.";
        $uploadOk = 2;
        //return;
    }

    if ($uploadOk == 0) {
        echo "Sorry, your file was not uploaded.";
        return;
    } else {
        if ($uploadOk != 2) {
            if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {                
                $uploadOk == 1;
            } else {
                echo "Sorry, there was an error uploading your file.";
                $uploadOk == 0;
                return;
            }
        }
    }

    if ($uploadOk != 0) {
        $file = $target_file;
        $objFile = PHPExcel_IOFactory::identify($file);
        $objData = PHPExcel_IOFactory::createReader($objFile);
        $objData->setReadDataOnly(true);
        $objPHPExcel = $objData->load($file);
        $sheet = $objPHPExcel->setActiveSheetIndex(0);
        $Totalrow = $sheet->getHighestRow();
        $LastColumn = $sheet->getHighestColumn();
        $TotalCol = PHPExcel_Cell::columnIndexFromString($LastColumn);
       // echo $TotalCol;
        $data = array();
        for ($i = 2; $i <= $Totalrow; $i++) {
            for ($j = 0; $j < $TotalCol; $j++) {
                if ($j == 2) {
                    $data[$i - 2][$j] = date('Y-m-d', PHPExcel_Shared_Date::ExcelToPHP($sheet->getCellByColumnAndRow($j, $i)->getValue()));
                } else {
                    $data[$i - 2][$j] = $sheet->getCellByColumnAndRow($j, $i)->getValue();                   
                }
            }
        }        
        /* function checkExistCode($tscode, $tsPackingQty, $tsCnn)
        {
            $kq = -1;
            $strCheck = "SELECT p.IdCode,p.CODE FROM tbl_product_detail p WHERE p.CODE='" . $tscode . "' AND p.PackingQty>=" . $tsPackingQty;
            $tbl = mysqli_query($tsCnn, $strCheck);
            $num_rows = mysqli_num_rows($tbl);
            if ($num_rows > 0) {
                $kq = 1;
            }
            return $kq;
        } */
        function createNewRoute($tsLoadingID, $tsUser, $tsFile, $tsCnn)
        {
            $idRoute = -1;
            $strNewRoute = "INSERT INTO tbl_route(LoadingID,CreateUser,AttachFile) VALUES('" . $tsLoadingID . "','" . $tsUser . "','" . $tsFile . "')";
			echo $strNewRoute;
            $strNew = mysqli_query($tsCnn, $strNewRoute);

            $tbl_GetId = mysqli_query($tsCnn, "SELECT MAX(ID_Route) AS 'Id_Route' FROM tbl_route");
            $rowsId = mysqli_fetch_assoc($tbl_GetId);
            $idRoute = $rowsId["Id_Route"];
			//echo $idRoute;
            return $idRoute;
        }

        $oldTruckNo = "";
        $id_Route = -1;
        foreach ($data as $r) {
            $code = $r[0];
            $pcs = 0;
            if ($r[1] != "") {
                $pcs = (int)$r[1];
            }
            $MFG = $r[2];
            if (trim($r[3]) == "") {
                $truckNo = " ";
                $uploadOk = 9;
                break;
            } else {
                $truckNo = $r[3];
            }
            // create new route
            if ($truckNo != $oldTruckNo) {
                $tsUser = $_POST["userName"];
                $id_Route = createNewRoute($truckNo, $tsUser, basename($newFileName), $cnn);
				echo "$id_Route: ".$id_Route;
                $oldTruckNo = $truckNo;
			//	echo $oldTruckNo;
            }
            if ($id_Route != -1) {
				//echo $id_Route;
                $sqlInsert = "INSERT INTO tbl_unload(ID_Route,Code,PCS,MFG) VALUE(" . $id_Route . ",'" . $code . "'," . $pcs . ",'" . $MFG . "')";
				//echo $sqlInsert;
                mysqli_query($cnn, $sqlInsert);
            }
        }
    }
}
if ($uploadOk == 9) {
    echo "<a class='btn btn-danger' href='tbl_routelist.php?cmd=reset'>Missing Loading ID</a>";
} else {
header("location: tbl_routelist.php");	
}
?>
</body>
</html>