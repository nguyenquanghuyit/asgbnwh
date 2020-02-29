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
$PalletId=$_GET['Pallet'];
$IMPID =$_GET['impid'];
$conn = mysqli_connect($host, $dbusername, $dbpassword, $dbname);
mysqli_set_charset($conn, 'UTF8');
$sql= "UPDATE tbl_pallet tp SET tp.ExistStatus =0 WHERE tp.PalletID ='$PalletId'";
$sqlInsertStock ="INSERT INTO tbl_stock (id_location,Code,PCS, datein,imp_id, CreateUser,UpdateUser,UpdateDate,Note_PalletId) SELECT ts.ID_Location, ts.Code, ts.PCS, ts.DateIn, ts.Imp_id, ts.CreateUser, ts.UpdateUser, ts.UpdateDate, ts.Note_PalletId FROM tbl_stocktmp ts WHERE ts.Note_PalletId ='$PalletId' AND ts.Imp_id ='$IMPID'";
$SqlInsertHistory="INSERT INTO tbl_history (PalletID, ID_Location, Code, PCS, DateIn, PalletStatus, CreateUser, CreateDate, UpdateUser, UpdateDate, Imp_Id) SELECT ts.Note_PalletId, ts.ID_Location, ts.Code, ts.PCS, ts.DateIn,'UNPACK',ts.CreateUser, ts.CreateDate, ts.UpdateUser, ts.UpdateDate, ts.Imp_id FROM tbl_stocktmp ts WHERE ts.Note_PalletId ='$PalletId' AND ts.Imp_id ='$IMPID'";
$sql1= "SELECT count(*) as cC FROM tbl_stock where Note_PalletId ='$PalletId'";
 if (!$conn) {
     die("Connection failed: " . mysqli_connect_error());
 }
if ($conn->query($sql)){
		// echo $palletid; 
}
 if ($conn->query($sqlInsertStock)){
		// echo $palletid; 
 }
  if ($conn->query($SqlInsertHistory)){
		// echo $palletid; 
 }

 $result = mysqli_query($conn,$sql1);	
 $data = array();
 while($row = mysqli_fetch_assoc($result)) {
     $data[] =$row;
 }
 echo json_encode($data);
	$conn->close();
?>