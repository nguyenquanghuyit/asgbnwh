<?PHP 
header("Content-type: text/html; charset=utf-8");
$host = "192.168.1.208";
$dbusername = "trantienhoa";
$dbpassword = "abc@123";
$dbname = "asgbn_wh";
$Palletid=$_GET['Palletid'];
$conn = mysqli_connect($host, $dbusername, $dbpassword, $dbname);
mysqli_set_charset($conn, 'UTF8');
$sql= "SELECT COUNT(*) AS cC, PalletID,Code, PCS, ExistStatus,DateTimeCreate FROM tbl_pallet where PalletID = '$Palletid' and ExistStatus =1 and PenddingStatus =0";
$result = mysqli_query($conn,$sql);
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
$data = array();
while($row = mysqli_fetch_assoc($result)) {
    $data[] =$row;
}
echo json_encode($data);  

?>