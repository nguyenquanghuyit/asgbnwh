<?PHP 
header("Content-type: text/html; charset=utf-8");
$host = "192.168.1.208";
$dbusername = "trantienhoa";
$dbpassword = "abc@123";
$dbname = "asgbn_wh";
$NotePallet=$_GET['Note'];
$LocationId=$_GET['Location'];
$ImpID=$_GET['impid'];
$UserId=$_GET['User'];
// echo $UserId;
$conn = mysqli_connect($host, $dbusername, $dbpassword, $dbname);
mysqli_set_charset($conn, 'UTF8');
$sql="CALL InsertTblStock('$NotePallet','$LocationId','$ImpID','$UserId')";

if ($conn->query($sql)){
	echo $sql;
	}
	else{
		echo "error: ". $sql ."
		". $conn->error;
	}
// $sql= "insert into tbl_stocktmp (id_location,Code,PCS, datein,imp_id, CreateUser,UpdateUser,UpdateDate,Note_PalletId) values ('$LocationId','$cCode','$PCS',CURRENT_TIMESTAMP(),'$ImpID','$UserId','$UserId',CURRENT_TIMESTAMP(),'$NotePallet')";
// //$sqlHistory= "insert into tbl_History (PalletID,id_location,Code,PCS, datein, CreateUser,UpdateUser,UpdateDate, PalletStatus) values ('$NotePallet','$LocationId','$cCode','$PCS',CURRENT_TIMESTAMP(),'$UserId','$UserId',CURRENT_TIMESTAMP(),'UPDATE')";
// $SqlSumpcs ="SELECT SUM(ts.PCS) AS sPcs, COUNT(*) AS  cC FROM tbl_stocktmp ts WHERE ts.Note_PalletId='$NotePallet'  AND ts.Code='$cCode' AND ts.PalletID IS NULL";
// if ($conn->query($sql)){
		// // header('Location: fullcalendar.php');
		// //echo $BarcodeId; 
	// }
	// else{
		// echo "Error: ". $sql ."
		// ". $conn->error;
	// }


	// $result = mysqli_query($conn,$SqlSumpcs);	
	 // if (!$conn) {
		// // die("Connection failed: " . mysqli_connect_error());
	 // }
	 // $data = array();
	 // while($row = mysqli_fetch_assoc($result)) {
		 // $data[] =$row;
	 // }
	 // echo json_encode($data);
	// $conn->close();
?>