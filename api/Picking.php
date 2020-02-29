<?PHP 
header("Content-type: text/html; charset=utf-8");
$host = "192.168.1.208";
$dbusername = "trantienhoa";
$dbpassword = "abc@123";
$dbname = "asgbn_wh";
$IDSTOCK=$_GET['ID_Stock'];
$UserId=$_GET['User'];
$ImpId = $_GET['Imp_Id'];
$OrderID = $_GET['Orderid']; 
$conn = mysqli_connect($host, $dbusername, $dbpassword, $dbname);
mysqli_set_charset($conn, 'UTF8');
$sql= "UPDATE tbl_stock ts SET ts.PCS = ts.PCS-1, ts.UpdateUser = '$UserId', ts.UpdateDate=CURRENT_TIMESTAMP() WHERE ts.ID_Stock ='$IDSTOCK'";
$sqlHistory= "INSERT INTO tbl_history (PalletID, ID_Location, Code, PCS, DateIn, PalletStatus, CreateUser, CreateDate, UpdateUser, UpdateDate, ID_Stock, Imp_Id,ID_Order) SELECT ts.Note_PalletId, ts.ID_Location, ts.Code, 1, ts.DateIn,'PICKING', ts.CreateUser, ts.CreateDate, ts.UpdateUser, ts.UpdateDate,ts.ID_Stock,'$ImpId','$OrderID' FROM tbl_stock ts WHERE ts.ID_Stock ='$IDSTOCK'";
$SqlSumpcs ="SELECT SUM(th.PCS) AS sPcs FROM tbl_history th WHERE th.ID_Stock ='$IDSTOCK' AND Imp_Id='$ImpId'";
if ($conn->query($sql)){
	}
	else{
		echo "error: ". $sql ."
		". $conn->error;
	}
	if ($conn->query($sqlHistory)){
	}
	else{
		echo "error: ". $sqlhistory ."
		". $conn->error;
	}
	//SELECT sum pcs
	$result = mysqli_query($conn,$SqlSumpcs);	
	 if (!$conn) {
		// die("Connection failed: " . mysqli_connect_error());
	 }
	 $data = array();
	 while($row = mysqli_fetch_assoc($result)) {
		 $data[] =$row;
	 }
	 echo json_encode($data);
	$conn->close();
?>