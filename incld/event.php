<?php
//load.php
$connect = new PDO('mysql:host=192.168.1.208;dbname=elearning', 'trantienhoa', 'abc@123');
$data = array();
$query = "SELECT * FROM fullcalendarclass";
$statement = $connect->prepare($query);
$statement->execute();
$result = $statement->fetchAll();
foreach($result as $row)
{
 $data[] = array(
  'title'   => $row["Title"],
 );
}
echo json_encode($data);
?>