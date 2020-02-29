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

$conn = mysqli_connect($host, $dbusername, $dbpassword, $dbname);
mysqli_set_charset($conn, 'UTF8');
$sql= "INSERT INTO tbl_history (PalletID, ID_Location, Code, PCS, DateIn, User_ID,PalletStatus,UpdateUser,UpdateDate) SELECT ts.PalletID, ts.ID_Location, ts.Code, ts.PCS,CURRENT_TIMESTAMP(),ts.User_ID,'S_Unpack',ts.CreateUser, CURRENT_TIMESTAMP() FROM tbl_stock ts WHERE ts.PalletID='$PalletId'";
$sql1 ="Select count(*) as cC from tbl_history where PalletID ='$PalletId' and PalletStatus ='S_Unpack'"; //PalletStatus =S_Unpack la Start Unpack , =UNPACK Unpack Success
$data = array();
if ($conn->query($sql)){
}
 else{
	 echo "error: ". $sql ."
	 ". $conn->error;
 }
$result = mysqli_query($conn,$sql1);
	
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