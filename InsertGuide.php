<?php 
		
	$cnn=mysqli_connect("18.139.16.74","trantienhoa","abc@123","asgbn",3306);	
	$idOrder=$_REQUEST["orderNo"];
	// ---------------------------------	
	$strCode="SELECT `to`.ID_Detail,`to`.Code,`to`.PCS,`to`.ID_Order FROM tbl_orderdetail `to` WHERE `to`.ID_Order=".$idOrder;	
	//echo $strCode."<hr>";
	$rsCode=mysqli_query($cnn,$strCode);	
	$mysqli = new mysqli("18.139.16.74","trantienhoa","abc@123","asgbn");	
	$str="CALL SP_GetOrderGuide('".$idOrder."')";
	$mySQL=mysqli_query($cnn,$str);
	
	
header("location: tbl_guiderlist.php?action=gridedit&showmaster=vwmasterguide&fk_ID_Order=".$idOrder);
 ?>