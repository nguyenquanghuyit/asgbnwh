<?PHP 
header("Content-type: text/html; charset=utf-8");
$host = "192.168.1.208";
$dbusername = "trantienhoa";
$dbpassword = "abc@123";
$dbname = "asgbn_wh";
// $BarcodeId=$_GET['Barcode'];
$LocationId=$_GET['Location'];
$cCode=$_GET['Code'];
$PCS=$_GET['Pcs'];
$ImpID=$_GET['impid'];
$UserId=$_GET['User'];
// echo $UserId;
$conn = mysqli_connect($host, $dbusername, $dbpassword, $dbname);
mysqli_set_charset($conn, 'UTF8');
$sql= "insert into tbl_stock (id_location,Code,PCS, datein,imp_id, User_Id) values ('$LocationId','$cCode','$PCS',CURRENT_TIMESTAMP(),'$ImpID','$UserId')";
$sqlHistory= "insert into tbl_History (id_location,Code,PCS, datein, User_Id) values ('$LocationId','$cCode','$PCS',CURRENT_TIMESTAMP(),'$UserId')";
if ($conn->query($sql)){
		// header('Location: fullcalendar.php');
		echo $BarcodeId; 
	}
	else{
		echo "Error: ". $sql ."
		". $conn->error;
	}
	if ($conn->query($sqlHistory)){
		// echo $BarcodeId; 
	}
	else{
		echo "Error: ". $sqlHistory ."
		". $conn->error;
	}
	$conn->close();
?>