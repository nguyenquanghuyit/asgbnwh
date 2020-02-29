<?PHP 
header("Content-type: text/html; charset=utf-8");
$host = "192.168.1.208";
$dbusername = "trantienhoa";
$dbpassword = "abc@123";
$dbname = "asgbn_wh";
$IDORDER=$_GET['ID_order'];
$UserId=$_GET['User'];

$conn = mysqli_connect($host, $dbusername, $dbpassword, $dbname);
mysqli_set_charset($conn, 'UTF8');
$sql= "UPDATE tbl_orderdetail SET StatusPickUp =1, UpdateUser ='$UserId', UpdateDate=CURRENT_TIMESTAMP() WHERE ID_Order ='$IDORDER'";
$sql1= "UPDATE tbl_order  SET StatusLoad =1, UpdateUser ='$UserId', UpdateDate=CURRENT_TIMESTAMP() WHERE ID_Order ='$IDORDER'";
$sqlDelete ="DELETE FROM tbl_stock WHERE PCS =0";
if ($conn->query($sql)){
}
else{
	echo "Error: ". $sql ."
	". $conn->error;
}
if ($conn->query($sql1)){
}
else{
	echo "Error: ". $sql1 ."
	". $conn->error;
}
if ($conn->query($sqlDelete)){
}
else{
	echo "Error: ". $sqlDelete ."
	". $conn->error;
}	
	// $result = mysqli_query($conn,$SqlSumpcs);	
	 // if (!$conn) {
		// // die("Connection failed: " . mysqli_connect_error());
	 // }
	 // $data = array();
	 // while($row = mysqli_fetch_assoc($result)) {
		 // $data[] =$row;
	 // }
	 // echo json_encode($data);
	$conn->close();
?>