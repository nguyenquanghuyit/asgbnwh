<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
</head>

<body>
<?php
$car=array("toy","honda","vinfast");
var_dump($car);
echo "<br>";
echo $car[1];
echo "<br>Mảng số nguyên";
$mangSoNguyen=array(1,2,3,4,5);
foreach($mangSoNguyen as $phantu)
{
	echo "Giá trị phần tử mảng là $phantu <br>";	
}

/* Phương thức thứ nhất để tạo mảng liên hợp. */
     $dong_xe = array("volvo" => 33, "bmw" => 2, "toyota" => 1);
 
     echo "\n Mức độ phổ biến của Volvo là ". $dong_xe['volvo']. "";
     echo "\n Mức độ phổ biến của BMW là ".  $dong_xe['bmw']. "";
     echo "\n Mức độ phổ biến của Toyota là ".  $dong_xe['toyota']. "";
 
     /* Phương thức thứ hai để tạo mảng liên hợp. */
     $dong_xe['volvo'] = "low";
     $dong_xe['bmw'] = "medium";
     $dong_xe['toyota'] = "high";
 
     echo "\n Mức độ phổ biến của Volvo là ". $dong_xe['volvo'] . "";
     echo "\n Mức độ phổ biến của BMW là ".  $dong_xe['bmw']. "";
     echo "\n Mức độ phổ biến của Toyota là ".  $dong_xe['toyota']. "";
	 
?>
</body>
</html>