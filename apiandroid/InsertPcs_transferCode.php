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
$FirstID_Stock=$_GET['FirstIdStock'];
// $LastID_Stock=$_GET['LastIdStock'];
$FirstLocation=$_GET['FirstLocation'];
$FirstPcs=$_GET['FirstPcs'];
$LastLocation=$_GET['LastLocation'];
$USERID=$_GET['User'];

$conn = mysqli_connect($host, $dbusername, $dbpassword, $dbname);
mysqli_set_charset($conn, 'UTF8');
$SqlUpdatePcs ="INSERT INTO tbl_stock (PalletID, Code, ID_Location, PCS, DateIn, Imp_id,Note_PalletId, CreateUser, CreateDate, UpdateUser, UpdateDate) SELECT ts.PalletID, ts.Code, '$LastLocation','$FirstPcs',ts.DateIn, ts.Imp_id, ts.Note_PalletId, ts.CreateUser, ts.CreateDate, '$USERID', ts.UpdateDate FROM tbl_stock ts WHERE ts.ID_Stock ='$FirstID_Stock'";
$SqlInsertHistory ="INSERT INTO tbl_history (PalletID, Code, ID_Location, PCS, DateIn,PalletStatus, Imp_id, CreateUser, CreateDate, UpdateUser, UpdateDate) SELECT ts.Note_PalletId,ts.Code, '$LastLocation','$FirstPcs',ts.DateIn,'TRANSFER_CODE', ts.Imp_id,  ts.CreateUser, ts.CreateDate, '$USERID', ts.UpdateDate FROM tbl_stock ts WHERE ts.ID_Stock ='$FirstID_Stock'";
$sqlUpdatePcsFirst="UPDATE tbl_stock ts SET ts.PCS = ts.PCS-'$FirstPcs' WHERE ts.ID_Stock='$FirstID_Stock'";
$SqlInsertHistoryFirstInstock ="INSERT INTO tbl_history (PalletID, ID_Location, Code, PCS, PalletStatus, CreateUser, CreateDate, UpdateUser, UpdateDate, ID_Stock) SELECT ts.Note_PalletId, ts.ID_Location, ts.Code, ts.PCS,'TRANSFER_CODE',ts.CreateUser, ts.CreateDate, ts.UpdateUser, ts.UpdateDate, ts.ID_Stock FROM tbl_stock ts WHERE ts.ID_Stock ='$FirstID_Stock'";
$sqlDel="Delete from tbl_stock where PCS =0 Or PCS <0";
if ($conn->query($SqlUpdatePcs)){
}
else{
	echo "Error: ". $SqlUpdatePcs ."
	". $conn->error;
}
if ($conn->query($SqlInsertHistory)){
}
else{
	echo "Error: ". $SqlInsertHistory ."
	". $conn->error;
}
if ($conn->query($sqlUpdatePcsFirst)){
}
else{
	echo "Error: ". $sqlUpdatePcsFirst ."
	". $conn->error;
}
if ($conn->query($SqlInsertHistoryFirstInstock)){
}
else{
	echo "Error: ". $SqlInsertHistoryFirstInstock ."
	". $conn->error;
}
if ($conn->query($sqlDel)){
	$data =1;
	echo json_encode($data);
}
else{
	echo "Error: ". $sqlDel ."
	". $conn->error;
}
// $result = mysqli_query($conn,$SqlSumpcs);
// if (!$conn) {
    // die("Connection failed: " . mysqli_connect_error());
// }
// $data = array();
// while($row = mysqli_fetch_assoc($result)) {
    // $data[] =$row;
// }
// echo json_encode($data);  

?>