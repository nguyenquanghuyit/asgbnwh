<?PHP 
header("Content-type: text/html; charset=utf-8");
$host = "192.168.1.208";
$dbusername = "trantienhoa";
$dbpassword = "abc@123";
$dbname = "asgbn_wh";
$IMP_ID=$_GET['impid'];
$CODE=$_GET['Code'];
$ORDERID=$_GET['OrderId'];
$conn = mysqli_connect($host, $dbusername, $dbpassword, $dbname);
mysqli_set_charset($conn, 'UTF8');
$sql= "SELECT SUM(PCS) AS sPcs,th.Code FROM tbl_history th WHERE th.Imp_Id='$IMP_ID' AND th.Code='$CODE' AND th.ID_Order='$ORDERID'";
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