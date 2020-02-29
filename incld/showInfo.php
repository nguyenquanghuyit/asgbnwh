<?php

//update.php

$connect = new PDO('mysql:host=192.168.1.208;dbname=elearning', 'trantienhoa', 'abc@123');

$id=$_GET['id'];
{
    $data = array();

    $query = "SELECT * FROM tblcalendarfull where IdCalendar='$id'";
    
    $statement = $connect->prepare($query);
    
    $statement->execute();
    
    $result = $statement->fetchAll();
    
    foreach($result as $row)
    {
     $data[] = array(
      'id'   => $row["IdCalendar"],
      'title'   => $row["title"],
      'start'   => $row["start"],
      'end'   => $row["end"]
     );
    }
    
    echo json_encode($data);
}

?>