<?PHP 
header("Content-type: text/html; charset=utf-8");
$host = "192.168.1.208";
$dbusername = "trantienhoa";
$dbpassword = "abc@123";
$dbname = "asgbn_wh";
$FirstID_Stock=$_GET['FirstIdStock'];
$LastID_Stock=$_GET['LastIdStock'];
$FirstLocation=$_GET['FirstLocation'];
$FirstPcs=$_GET['FirstPcs'];
$LasttLocation=$_GET['LastLocation'];
$USERID=$_GET['User'];

$conn = mysqli_connect($host, $dbusername, $dbpassword, $dbname);
mysqli_set_charset($conn, 'UTF8');
$SqlUpdatePcs ="UPDATE tbl_stock ts SET ts.PCS =ts.PCS+'$FirstPcs', ts.UpdateUser='$USERID', ts.UpdateDate=CURRENT_TIMESTAMP() WHERE ts.ID_Stock='$LastID_Stock'";
$SqlInsertHistory ="INSERT INTO tbl_history (PalletID, ID_Location, Code, PCS, PalletStatus, CreateUser, CreateDate, UpdateUser, UpdateDate, ID_Stock) SELECT ts.Note_PalletId, ts.ID_Location, ts.Code, ts.PCS,'TRANSFER_CODE',ts.CreateUser, ts.CreateDate, ts.UpdateUser, ts.UpdateDate, ts.ID_Stock FROM tbl_stock ts WHERE ts.ID_Stock ='$LastID_Stock'";
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