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
$sqlHistory= "INSERT INTO tbl_history (PalletID, ID_Location, Code, PCS, PalletStatus, CreateUser, CreateDate, UpdateUser, UpdateDate, ID_Stock, Imp_Id, ID_Order, DateIn) SELECT ts.PalletID, ts.ID_Location, ts.Code, ts.PCS,'PICKING',ts.CreateUser,CURRENT_TIMESTAMP(),'$UserId', CURRENT_TIMESTAMP(),'$IDSTOCK','$ImpId','$OrderID', ts.Datein FROM tbl_stock ts WHERE ts.ID_Stock='$IDSTOCK'";
$sql= "UPDATE tbl_stock ts SET ts.PCS =0, ts.UpdateUser='$UserId', ts.UpdateDate=CURRENT_TIMESTAMP() WHERE ts.ID_Stock ='$IDSTOCK';";
$SqlSumpcs ="SELECT SUM(th.PCS) AS sPcs FROM tbl_history th WHERE th.ID_Stock ='$IDSTOCK' AND Imp_Id='$ImpId'";

	if ($conn->query($sqlHistory)){
	}
	else{
		echo "error: ". $sqlhistory ."
		". $conn->error;
	}
	if ($conn->query($sql)){
	}
	else{
		echo "error: ". $sql ."
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