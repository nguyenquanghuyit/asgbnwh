<?PHP 
header("Content-type: text/html; charset=utf-8");
$host = "192.168.1.208";
$dbusername = "trantienhoa";
$dbpassword = "abc@123";
$dbname = "asgbn_wh";
$BarcodeId=$_GET['Barcode'];
$LocationId=$_GET['Location'];
$cCode=$_GET['Code'];
$PCS=$_GET['Pcs'];
$ImpID=$_GET['impid'];
$UserId=$_GET['User'];
// echo $UserId;
$conn = mysqli_connect($host, $dbusername, $dbpassword, $dbname);
mysqli_set_charset($conn, 'UTF8');
$sql="CALL InsertTblStock('$BarcodeId','$LocationId','$ImpID','$UserId')";

if ($conn->query($sql)){
	echo $sql;
	}
	else{
		echo "error: ". $sql ."
		". $conn->error;
	}
// $sql= "insert into tbl_stock (palletid,id_location,Code,PCS, datein,imp_id, CreateUser, Note_PalletId) values ('$BarcodeId','$LocationId','$cCode','$PCS',CURRENT_TIMESTAMP(),'$ImpID','$UserId','$BarcodeId')";
// $sqlHistory= "insert into tbl_History (palletid,id_location,Code,PCS, datein, CreateUser,PalletStatus) values ('$BarcodeId','$LocationId','$cCode','$PCS',CURRENT_TIMESTAMP(),'$UserId','NOMAL')";
// $sqlUpdatePallet ="UPDATE tbl_pallet tp SET tp.ExistStatus =0 WHERE tp.PalletID ='$BarcodeId'";
// if ($conn->query($sql)){
		// // header('Location: fullcalendar.php');
		// echo $BarcodeId; 
	// }
	// else{
		// echo "Error: ". $sql ."
		// ". $conn->error;
	// }
	// if ($conn->query($sqlHistory)){
		// // echo $BarcodeId; 
	// }
	// else{
		// echo "Error: ". $sqlHistory ."
		// ". $conn->error;
	// }
	// if ($conn->query($sqlUpdatePallet)){
		// // echo $BarcodeId; 
	// }
	// else{
		// echo "Error: ". $sqlUpdatePallet ."
		// ". $conn->error;
	// }
	$conn->close();
?>