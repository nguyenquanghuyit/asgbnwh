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
$NotePallet=$_GET['Note'];
$LocationId=$_GET['Location'];
$cCode=$_GET['Code'];
$PCS=$_GET['Pcs'];
$ImpID=$_GET['impid'];
$UserId=$_GET['User'];
// $OutputStatus=0;
// echo $UserId;
$conn = mysqli_connect($host, $dbusername, $dbpassword, $dbname);
mysqli_set_charset($conn, 'UTF8');
$sql="CALL InsertImportStockUnpack('$NotePallet','$LocationId','$cCode','$PCS','$ImpID','$UserId')";
$result = mysqli_query($conn,$sql);	
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