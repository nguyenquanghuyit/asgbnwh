<?PHP 
header("Content-type: text/html; charset=utf-8");
$host = "192.168.1.208";
$dbusername = "trantienhoa";
$dbpassword = "abc@123";
$dbname = "asgbn_wh";
$LOCATIONID=$_GET['Location'];
$CodeId=$_GET['Code'];
$conn = mysqli_connect($host, $dbusername, $dbpassword, $dbname);
mysqli_set_charset($conn, 'UTF8');
$sql= "SELECT COUNT(PalletId) AS cC, SUM(ts.PCS) AS sPcs, ts.ID_Stock, PalletId FROM tbl_stock ts WHERE ts.ID_Location ='$LOCATIONID' AND ts.Code ='$CodeId' AND ts.PCS>0 GROUP BY ts.Code";
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