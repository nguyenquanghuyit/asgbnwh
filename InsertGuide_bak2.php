<?php 
		
	$cnn=mysqli_connect("18.139.16.74","trantienhoa","abc@123","asgbn",3306);	
	$idOrder=$_REQUEST["orderNo"];
	// ---------------------------------	
	$strCode="SELECT `to`.ID_Detail,`to`.Code,`to`.PCS,`to`.ID_Order FROM tbl_orderdetail `to` WHERE `to`.ID_Order=".$idOrder;	
	//echo $strCode."<hr>";
	$rsCode=mysqli_query($cnn,$strCode);	
	
	// clear old data
	$strClear="DELETE FROM tbl_guider WHERE OrderNo=".$idOrder;
	//echo "<hr>".$strClear;
	if (mysqli_query($cnn, $strClear)) {
    	//echo "update thành công";
		} 
	//------------	
	while($rowCode=mysqli_fetch_assoc($rsCode))
	{
		$codeId=$rowCode["Code"]; // code mã hàng
		$PCS=$rowCode["PCS"];   // pcs yêu cầu =5
		
		$str1="SELECT vn.ID_Order,vn.code,vn.ID_Location,vn.PalletID,SUM(vn.PCS_out) AS 'PCS_out',SUM(vn.PCS_IN) AS 'PCS_IN',vn.CreateDate AS 'DateIn',vn.ProductName, vn.HasPallet,vn.Note_PalletId FROM vwCodeUnion vn ";
		$str1=$str1." where code='". $codeId. "' and ID_Order=".$idOrder ;
		$str1=$str1." GROUP BY vn.ID_Order,vn.code,vn.ID_Location,vn.PalletID,vn.CreateDate,vn.ProductName,vn.Note_PalletId";
		$str1=$str1." ORDER BY vn.code,vn.HasPallet,vn.CreateDate";	
		$rs1=mysqli_query($cnn,$str1);
		// echo "<br>".$str1;
		if(mysqli_num_rows($rs1)>0)
		{		
			$tmp=0;
			while($row1=mysqli_fetch_assoc($rs1)){
				
				$ID_Location=$row1["ID_Location"];			
				$ProductName=$row1["ProductName"];	
				$DateIn=$row1["DateIn"];
				$PCS_IN1=$row1["PCS_IN"];
				$PalletID=$row1["PalletID"];
				$Note_PalletId = $row1["Note_PalletId"];
				
				$tong=($PCS_IN1+$tmp);				
				if($PCS>$tong){
					$PCS_out1=$row1["PCS_IN"];
					$tmp+=$PCS_out1;				
				}
				else
				{				
					$PCS_out1=$tong-$PCS;	
					$PCS_out1=$row1["PCS_IN"]-$PCS_out1;
					$tmp+=$PCS_out1;					
				}				
		if($tmp<=$PCS){
			// --------------------------
			 $sqlG="SELECT (v.PCS_In-v1.pcs) AS 'pcsG' FROM vwPcsGuide v1";
			 $sqlG= $sqlG. " INNER JOIN vwguidepicking v ON v.Code=v1.code AND v.PalletID=v1.Note_PalletID AND v.ID_Location=v1.ID_Location";
			 $sqlG= $sqlG. " WHERE v1.code='".$codeId."' AND v1.Note_PalletID='".$Note_PalletId."' AND v1.ID_Location=".$ID_Location;
			 $sqlG= $sqlG. " ORDER BY v.ID_Order LIMIT 1";
			 
			 $rsG=mysqli_query($cnn,$sqlG);
			 $rowG=mysqli_fetch_assoc($rsG);
			 		
			 if(isset($rowG["pcsG"]))
				 $pcsG=$rowG["pcsG"];
			else
				$pcsG=$PCS_IN1;
			
			// --------------------------
			$strInsert="INSERT INTO tbl_guider(PalletID,OrderNo,Code,ID_Location,ProductName,PCS_In,PCS,PCS_Request,DateIn,Note_PalletId,PCS_Guide)";
			$strInsert=  $strInsert . " values('".$PalletID."',".$idOrder.",'".$codeId."',".$ID_Location.",'".$ProductName."',".$PCS_IN1.",".$pcsG.",".$PCS.",'".$DateIn."','" . $Note_PalletId . "',".$pcsG.")";					
			echo $strInsert."<br>"; // $PCS_out1
			$mySQL=mysqli_query($cnn,$strInsert);}			
			}		
		}

	}
  header("location: tbl_guiderlist.php?action=gridedit&showmaster=vwmasterguide&fk_ID_Order=".$idOrder);
 ?>