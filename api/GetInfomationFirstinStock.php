<?PHP 
header("Content-type: text/html; charset=utf-8");
$host = "192.168.1.208";
$dbusername = "trantienhoa";
$dbpassword = "abc@123";
$dbname = "asgbn_wh";
$ID_Location=$_GET['Location'];
$cCode=$_GET['Code'];
$conn = mysqli_connect($host, $dbusername, $dbpassword, $dbname);
mysqli_set_charset($conn, 'UTF8');
$SqlSumpcs ="SELECT ts.ID_Stock,ts.Code, ts.ID_Location, ts.PCS FROM tbl_stock ts WHERE ts.ID_Location ='$ID_Location' AND ts.Code='$cCode'";
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