<?PHP 
header("Content-type: text/html; charset=utf-8");
    if (isset($_SERVER['HTTP_ORIGIN'])) {
        header("Access-Control-Allow-Origin: {$_SERVER['HTTP_ORIGIN']}");
        header('Access-Control-Allow-Credentials: true');
        header('Access-Control-Max-Age: 86400');    // cache for 1 day
    }
    // Access-Control headers are received during OPTIONS requests
    if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {
 
        if (isset($_SERVER['HTTP_ACCESS_CONTROL_REQUEST_METHOD']))
            header("Access-Control-Allow-Methods: GET, POST, OPTIONS");         
 
        if (isset($_SERVER['HTTP_ACCESS_CONTROL_REQUEST_HEADERS']))
            header("Access-Control-Allow-Headers:        {$_SERVER['HTTP_ACCESS_CONTROL_REQUEST_HEADERS']}");
 
        exit(0);
    }
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
$sql= "UPDATE tbl_stock ts SET ts.ID_Location ='$LocationId', ts.UpdateUser ='$UserId', ts.UpdateDate =CURRENT_TIMESTAMP() WHERE  ts.PalletID='$PalletID'";
$sqlHistory= "insert into tbl_History (PalletID,id_location,Code,PCS,UpdateUser,UpdateDate, PalletStatus) SELECT ts.PalletID, ts.ID_Location, ts.Code, ts.PCS, ts.UpdateUser, ts.UpdateDate,'TRANSFER' FROM tbl_stock ts WHERE ts.PalletID ='$PalletID'";
$SqlSelect ="SELECT COUNT(*) AS cC FROM tbl_stock ts WHERE ts.PalletID ='$PalletID' AND ts.ID_Location='$LocationId'";
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