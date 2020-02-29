<?php
//delete.php
if(isset($_POST["id"]))
{
 $connect = new PDO('mysql:host=192.168.1.250;dbname=elearning', 'trantienhoa', 'abc@123');
 $query = "
 DELETE fullcalendarclass event WHERE id=:id
 ";
 $statement = $connect->prepare($query);
 $statement->execute(
  array(
   ':id' => $_POST['id']
  )
 );
}
?>