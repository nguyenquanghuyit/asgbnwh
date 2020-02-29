<?PHP 
header("Content-type: text/html; charset=utf-8");
$host = "192.168.1.208";
$dbusername = "trantienhoa";
$dbpassword = "abc@123";
$dbname = "asgbn_wh";
$NotePallet=$_GET['palletid'];
$cCode=$_GET['Code'];
$conn = mysqli_connect($host, $dbusername, $dbpassword, $dbname);
mysqli_set_charset($conn, 'UTF8');
$SqlSumpcs ="SELECT SUM(ts.PCS) AS sPcs, COUNT(*) AS  cC FROM tbl_stocktmp ts WHERE ts.Note_PalletId='$NotePallet' AND ts.Code='$cCode' AND ts.PalletID IS NULL";
$result = mysqli_query($conn,$SqlSumpcs);
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
$data = array();
while($row = mysqli_fetch_assoc($result)) {
    $data[] =$row;
}
echo json_encode($data);  

?>