<?php
	if (isset($_POST['start']) &&  isset($_POST['end']) && isset($_POST['title'])) {
		// echo $_POST['title'];
		// echo $_POST['start'];
		// echo $_POST['end'];
		$Title = $_POST['title'];
		$start = $_POST['start'];
        $end = $_POST['end'];
        if (!empty($Title)){
			if (!empty($start)){
				$host = "192.168.1.208";
				$dbusername = "trantienhoa";
				$dbpassword = "abc@123";
				$dbname = "elearning";
				$conn = new mysqli ($host, $dbusername, $dbpassword, $dbname);
				if (mysqli_connect_error()){
					die('Connect Error ('. mysqli_connect_errno() .') '
					. mysqli_connect_error());
				}
				else{
					$sql = "INSERT INTO fullcalendarclass (IdClass, IdCourse, IdGdade, Title,Begindate, EndDate)
					VALUE ('1','1','1',N'$Title','$start','$end')";
					if ($conn->query($sql)){
                        header('Location: fullcalendar.php');
                        exit();
					}
					else{
						echo "Error: ". $sql ."
						". $conn->error;
					}
					$conn->close();
				}
			}
			else{
			echo "title should not be empty";
			die();
			}
        }
        else{
        echo "startdate should not be empty";
        die();
        }
	}
?>