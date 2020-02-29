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

$SqlDeleteStock ="DELETE FROM tbl_stock WHERE PalletID ='$PalletId'";
$SqlDeleteStockTmp ="DELETE FROM tbl_stocktmp WHERE Note_PalletId ='$PalletId' AND Imp_Id ='$IMPID'";
$sql1= "SELECT count(*) as cC FROM asgbn_wh.vvcheckexistpalletid where PalletID ='$PalletId'";
 if (!$conn) {
     die("Connection failed: " . mysqli_connect_error());
 }

  if ($conn->query($SqlDeleteStock)){
		// echo $palletid; 
 }
  if ($conn->query($SqlDeleteStockTmp)){
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