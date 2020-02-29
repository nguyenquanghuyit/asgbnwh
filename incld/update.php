<?php

//update.php

$connect = new PDO('mysql:host=192.168.1.208;dbname=elearning', 'trantienhoa', 'abc@123');

if(isset($_POST["id"]))
{
 $query = "
 UPDATE events 
 SET title=:title, start=:start_event, end_event=:end_event 
 WHERE id=:id
 ";
 $statement = $connect->prepare($query);
 $statement->execute(
  array(
   ':title'  => $_POST['title'],
   ':start' => $_POST['start'],
   ':end' => $_POST['end'],
   ':id'   => $_POST['IdCalendar']
  )
 );
}

?>