<?PHP 
header("Content-type: text/html; charset=utf-8");
$host = "192.168.1.208";
$dbusername = "trantienhoa";
$dbpassword = "abc@123";
$dbname = "asgbn_wh";
$PalletID=$_GET['Palletid'];
$LocationId=$_GET['Location'];
$UserId=$_GET['User'];
// echo $UserId;
$conn = mysqli_connect($host, $dbusername, $dbpassword, $dbname);
mysqli_set_charset($conn, 'UTF8');
$sql= "UPDATE tbl_stock ts SET ts.ID_Location ='$LocationId', ts.UpdateUser ='$UserId', ts.UpdateDate =CURRENT_TIMESTAMP() WHERE  ts.Note_PalletId='$PalletID'";
$sqlHistory= "insert into tbl_History (PalletID,id_location,Code,PCS,UpdateUser,UpdateDate, PalletStatus) SELECT ts.PalletID, ts.ID_Location, ts.Code, ts.PCS, ts.UpdateUser, ts.UpdateDate,'TRANSFER' FROM tbl_stock ts WHERE ts.PalletID ='$PalletID'";
$SqlSelect ="SELECT COUNT(*) AS cC FROM tbl_stock ts WHERE ts.Note_PalletId ='$PalletID' AND ts.ID_Location='$LocationId'";
if ($conn->query($sql)){
	}
	else{
		echo "Error: ". $sql ."
		". $conn->error;
	}
	if ($conn->query($sqlHistory)){
	}
	else{
		echo "Error: ". $sqlHistory ."
		". $conn->error;
	}
	
$result = mysqli_query($conn,$SqlSelect);
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
$data = array();
while($row = mysqli_fetch_assoc($result)) {
    $data[] =$row;
}
echo json_encode($data);  
	$conn->close();
?>