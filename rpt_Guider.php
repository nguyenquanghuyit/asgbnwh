<html xmlns:o="urn:schemas-microsoft-com:office:office"
xmlns:x="urn:schemas-microsoft-com:office:excel"
xmlns="http://www.w3.org/TR/REC-html40">
<?php 
include_once "mycnn.php";
?>
<head>
<meta http-equiv=Content-Type content="text/html; charset=windows-1252">
<meta name=ProgId content=Excel.Sheet>
<meta name=Generator content="Microsoft Excel 15">
<link rel=File-List href="rpt_guider_files/filelist.xml">
<style id="rpt_guider_30141_Styles"><!--table
	{mso-displayed-decimal-separator:"\.";
	mso-displayed-thousand-separator:"\,";}
.font530141
	{color:#212529;
	font-size:12.0pt;
	font-weight:400;
	font-style:normal;
	text-decoration:none;
	font-family:Arial, sans-serif;
	mso-font-charset:0;}
.font630141
	{color:#212529;
	font-size:12.0pt;
	font-weight:700;
	font-style:normal;
	text-decoration:none;
	font-family:Arial, sans-serif;
	mso-font-charset:0;}
.font730141
	{color:black;
	font-size:10.0pt;
	font-weight:700;
	font-style:normal;
	text-decoration:none;
	font-family:Arial, sans-serif;
	mso-font-charset:0;}
.xl6330141
	{padding-top:1px;
	padding-right:1px;
	padding-left:1px;
	mso-ignore:padding;
	color:black;
	font-size:13.0pt;
	font-weight:400;
	font-style:normal;
	text-decoration:none;
	font-family:Arial, sans-serif;
	mso-font-charset:0;
	mso-number-format:General;
	text-align:general;
	vertical-align:bottom;
	mso-background-source:auto;
	mso-pattern:auto;
	white-space:nowrap;}
.xl6430141
	{padding-top:1px;
	padding-right:1px;
	padding-left:1px;
	mso-ignore:padding;
	color:black;
	font-size:13.0pt;
	font-weight:700;
	font-style:normal;
	text-decoration:none;
	font-family:Arial, sans-serif;
	mso-font-charset:0;
	mso-number-format:General;
	text-align:general;
	vertical-align:bottom;
	mso-background-source:auto;
	mso-pattern:auto;
	white-space:nowrap;}
.xl6530141
	{padding-top:1px;
	padding-right:1px;
	padding-left:1px;
	mso-ignore:padding;
	color:black;
	font-size:13.0pt;
	font-weight:400;
	font-style:normal;
	text-decoration:none;
	font-family:Arial, sans-serif;
	mso-font-charset:0;
	mso-number-format:General;
	text-align:general;
	vertical-align:middle;
	mso-background-source:auto;
	mso-pattern:auto;
	white-space:nowrap;}
.xl6630141
	{padding-top:1px;
	padding-right:1px;
	padding-left:1px;
	mso-ignore:padding;
	color:black;
	font-size:13.0pt;
	font-weight:400;
	font-style:normal;
	text-decoration:none;
	font-family:Arial, sans-serif;
	mso-font-charset:0;
	mso-number-format:General;
	text-align:center;
	vertical-align:middle;
	border:.5pt solid windowtext;
	mso-background-source:auto;
	mso-pattern:auto;
	white-space:nowrap;}
.xl6730141
	{padding-top:1px;
	padding-right:1px;
	padding-left:1px;
	mso-ignore:padding;
	color:#212529;
	font-size:13.0pt;
	font-weight:400;
	font-style:normal;
	text-decoration:none;
	font-family:Arial, sans-serif;
	mso-font-charset:0;
	mso-number-format:General;
	text-align:center;
	vertical-align:middle;
	border:.5pt solid windowtext;
	mso-background-source:auto;
	mso-pattern:auto;
	white-space:nowrap;}
.xl6830141
	{padding-top:1px;
	padding-right:1px;
	padding-left:1px;
	mso-ignore:padding;
	color:black;
	font-size:13.0pt;
	font-weight:400;
	font-style:normal;
	text-decoration:none;
	font-family:Arial, sans-serif;
	mso-font-charset:0;
	mso-number-format:General;
	text-align:center;
	vertical-align:bottom;
	border:.5pt solid windowtext;
	mso-background-source:auto;
	mso-pattern:auto;
	white-space:nowrap;}
.xl6930141
	{padding-top:1px;
	padding-right:1px;
	padding-left:1px;
	mso-ignore:padding;
	color:black;
	font-size:16.0pt;
	font-weight:700;
	font-style:normal;
	text-decoration:none;
	font-family:Arial, sans-serif;
	mso-font-charset:0;
	mso-number-format:General;
	text-align:center;
	vertical-align:middle;
	mso-background-source:auto;
	mso-pattern:auto;
	white-space:nowrap;}
.xl7030141
	{padding-top:1px;
	padding-right:1px;
	padding-left:1px;
	mso-ignore:padding;
	color:black;
	font-size:13.0pt;
	font-weight:400;
	font-style:normal;
	text-decoration:none;
	font-family:Arial, sans-serif;
	mso-font-charset:0;
	mso-number-format:General;
	text-align:center;
	vertical-align:middle;
	mso-background-source:auto;
	mso-pattern:auto;
	white-space:nowrap;}
.xl7130141
	{padding-top:1px;
	padding-right:1px;
	padding-left:1px;
	mso-ignore:padding;
	color:black;
	font-size:13.0pt;
	font-weight:700;
	font-style:normal;
	text-decoration:none;
	font-family:Arial, sans-serif;
	mso-font-charset:0;
	mso-number-format:General;
	text-align:right;
	vertical-align:middle;
	border-top:.5pt solid windowtext;
	border-right:none;
	border-bottom:.5pt solid windowtext;
	border-left:.5pt solid windowtext;
	mso-background-source:auto;
	mso-pattern:auto;
	white-space:nowrap;}
.xl7230141
	{padding-top:1px;
	padding-right:1px;
	padding-left:1px;
	mso-ignore:padding;
	color:black;
	font-size:13.0pt;
	font-weight:700;
	font-style:normal;
	text-decoration:none;
	font-family:Arial, sans-serif;
	mso-font-charset:0;
	mso-number-format:General;
	text-align:right;
	vertical-align:middle;
	border-top:.5pt solid windowtext;
	border-right:none;
	border-bottom:.5pt solid windowtext;
	border-left:none;
	mso-background-source:auto;
	mso-pattern:auto;
	white-space:nowrap;}
.xl7330141
	{padding-top:1px;
	padding-right:1px;
	padding-left:1px;
	mso-ignore:padding;
	color:black;
	font-size:13.0pt;
	font-weight:700;
	font-style:normal;
	text-decoration:none;
	font-family:Arial, sans-serif;
	mso-font-charset:0;
	mso-number-format:General;
	text-align:right;
	vertical-align:middle;
	border-top:.5pt solid windowtext;
	border-right:.5pt solid windowtext;
	border-bottom:.5pt solid windowtext;
	border-left:none;
	mso-background-source:auto;
	mso-pattern:auto;
	white-space:nowrap;}
.xl7430141
	{padding-top:1px;
	padding-right:1px;
	padding-left:1px;
	mso-ignore:padding;
	color:black;
	font-size:12.0pt;
	font-weight:700;
	font-style:normal;
	text-decoration:none;
	font-family:Arial, sans-serif;
	mso-font-charset:0;
	mso-number-format:General;
	text-align:center;
	vertical-align:middle;
	border:.5pt solid windowtext;
	mso-background-source:auto;
	mso-pattern:auto;
	white-space:nowrap;}
.xl7530141
	{padding-top:1px;
	padding-right:1px;
	padding-left:1px;
	mso-ignore:padding;
	color:black;
	font-size:12.0pt;
	font-weight:700;
	font-style:normal;
	text-decoration:none;
	font-family:Arial, sans-serif;
	mso-font-charset:0;
	mso-number-format:General;
	text-align:center;
	vertical-align:middle;
	border:.5pt solid windowtext;
	mso-background-source:auto;
	mso-pattern:auto;
	white-space:normal;}
.xl7630141
	{padding-top:1px;
	padding-right:1px;
	padding-left:1px;
	mso-ignore:padding;
	color:black;
	font-size:12.0pt;
	font-weight:400;
	font-style:normal;
	text-decoration:none;
	font-family:Arial, sans-serif;
	mso-font-charset:0;
	mso-number-format:General;
	text-align:center;
	vertical-align:middle;
	border:.5pt solid windowtext;
	mso-background-source:auto;
	mso-pattern:auto;
	white-space:nowrap;}
.xl7730141
	{padding-top:1px;
	padding-right:1px;
	padding-left:1px;
	mso-ignore:padding;
	color:#212529;
	font-size:12.0pt;
	font-weight:400;
	font-style:normal;
	text-decoration:none;
	font-family:Arial, sans-serif;
	mso-font-charset:0;
	mso-number-format:General;
	text-align:center;
	vertical-align:top;
	border:.5pt solid windowtext;
	mso-background-source:auto;
	mso-pattern:auto;
	white-space:normal;}
.xl7830141
	{padding-top:1px;
	padding-right:1px;
	padding-left:1px;
	mso-ignore:padding;
	color:#212529;
	font-size:11.0pt;
	font-weight:400;
	font-style:normal;
	text-decoration:none;
	font-family:Arial, sans-serif;
	mso-font-charset:0;
	mso-number-format:General;
	text-align:general;
	vertical-align:middle;
	border:.5pt solid windowtext;
	mso-background-source:auto;
	mso-pattern:auto;
	white-space:normal;}
--></style>
</head>

<body>
<!--[if !excel]>&nbsp;&nbsp;<![endif]-->
<!--The following information was generated by Microsoft Excel's Publish as Web
Page wizard.-->
<!--If the same item is republished from Excel, all information between the DIV
tags will be replaced.-->
<!----------------------------->
<!--START OF OUTPUT FROM EXCEL PUBLISH AS WEB PAGE WIZARD -->
<!----------------------------->
<?php 
if(isset($_REQUEST["id"]))
{
	$id=$_REQUEST["id"];
	$trRoute="SELECT tg.code,pcs,pcs_in,tl.Location,tp.ProductName,t1.CusomterOrderNo,tg.Qty,tg.Box FROM tbl_orderguide tg INNER JOIN tbl_location tl ON tg.ID_Location=tl.ID_Location INNER JOIN tbl_order t1 ON t1.ID_Order=tg.ID_Order INNER JOIN tbl_product tp ON tp.Code=tg.Code WHERE tg.ID_Order=".$id;
// echo $trRoute;
	$tbl=mysqli_query($cnn,$trRoute);
	$tbl2=mysqli_query($cnn,$trRoute);
	$a_row=mysqli_fetch_assoc($tbl2);
	$cId=$a_row["CusomterOrderNo"];	
?>
<div id="rpt_guider_30141" align=center x:publishsource="Excel">

<table border=0 cellpadding=0 cellspacing=0 width=1317 class=xl6330141
 style='border-collapse:collapse;width:522pt'>
 <col class=xl6330141 width=32 style='mso-width-source:userset;mso-width-alt:
 910;width:24pt'>
 <col class=xl6330141 width=156 style='mso-width-source:userset;mso-width-alt:
 4437;width:117pt'>
 <col class=xl6330141 width=266 style='mso-width-source:userset;mso-width-alt:
 7566;width:200pt'>
 <col class=xl6330141 width=72 style='mso-width-source:userset;mso-width-alt:
 2048;width:54pt'>
 <col class=xl6330141 width=56 style='mso-width-source:userset;mso-width-alt:
 1592;width:42pt'>
 <col class=xl6330141 width=113 style='mso-width-source:userset;mso-width-alt:
 3214;width:85pt'>
 <tr height=27 style='mso-height-source:userset;height:20.25pt'>
  <td colspan=3 rowspan=2 height=95 class=xl6930141 width=454 style='height:
  71.25pt;width:341pt'>GUIDE BY ORDER<h5 style="border:1px solid red; padding:3px 0px"><?php echo "Customer's Order: ".$cId?></h5></td>
  <td class=xl6430141 colspan=5 width=128 style='width:96pt; text-align:center'>Order No. <?php echo $id?></td>
 </tr>
 <tr height=68 style='mso-height-source:userset;height:51.0pt'>
  <td colspan=5 height=68 class=xl7030141 style='height:51.0pt'><?php echo "<img style='width: 200px;height: 60px;' src='barcode.php?codetype=code128&size=40&text=".$id."&print=true'/>";?></td>
 </tr>
 <tr height=61 style='mso-height-source:userset;height:45.75pt'>
  <td height=61 class=xl7430141 style='height:45.75pt'>&nbsp;</td>
  <td class=xl7430141 style='border-left:none'>CODE</td>
  <td class=xl7430141 style='border-left:none'>PRODUCT NAME</td>
  <td class=xl7530141 width=72 style='border-left:none;width:54pt'>Qty/Box</td>
  <td class=xl7530141 width=72 style='border-left:none;width:54pt'>Box</td>
  <td class=xl7530141 width=72 style='border-left:none;width:54pt'>PCS<br>
    <font class="font730141">Instock</font></td>
  <td class=xl7530141 width=56 style='border-left:none;width:42pt'>PCS<br>
    Out</td>
  <td class=xl7430141 style='border-left:none'>LOCATION</td>
 </tr>
 <?php 
 $total_PcsIn=0;
 $total_Pcs=0;
 $total_qty=0;
 $total_box=0;
 $stt=0;
for($i=0;$i< mysqli_num_rows($tbl);$i++)
{
 	$row=mysqli_fetch_assoc($tbl);
	$code=$row["code"];
	$pcs=$row["pcs"];
	$pcs_in=$row["pcs_in"];
	$Location=$row["Location"];
	$ProductName=$row["ProductName"];
	$qty=$row["Qty"];
	$box=$row["Box"];
	$stt++;
	$total_PcsIn+=$row["pcs_in"];
	$total_Pcs+=$row["pcs"];
	$total_box+=$box;
	$total_qty+=$qty;
 ?>
 <tr class=xl6530141 height=76 style='mso-height-source:userset;height:57.0pt'>
  <td height=76 class=xl7630141 style='height:57.0pt;border-top:none'><?php echo $stt;?></td>
  <td class=xl7730141 width=156 style='border-top:none;border-left:none;
  width:117pt'><font class="font630141"><?php echo $code;?></font><font class="font530141"><br>
<?php echo "<img style='width: 153px;height: 50px' src='barcode.php?codetype=code128&size=40&text=".$code."&print=true'/>";?></font></td>
  <td class=xl7830141 width=266 style='border-top:none;border-left:none;
  width:200pt'><?php echo $ProductName;?></td>
  <td class=xl6630141 style='border-top:none;border-left:none'><?php echo $qty;?></td>
  <td class=xl6630141 style='border-top:none;border-left:none'><?php echo $box;?></td>
  <td class=xl6630141 style='border-top:none;border-left:none'><?php echo $pcs_in;?></td>
  <td class=xl6630141 style='border-top:none;border-left:none'><?php echo $pcs;?></td>
  <td class=xl6730141 style='border-top:none;border-left:none;width:100px'><?php echo $Location;?></td>
 </tr>
 <?php
	}
 ?>
 <tr height=33 style='mso-height-source:userset;height:24.75pt'>
  <td colspan=3 height=33 class=xl7130141 style='border-right:.5pt solid black;
  height:24.75pt'>SUMARY</td>
  <td class=xl6630141 style='border-top:none;border-left:none'><?php echo $total_qty;?></td>
  <td class=xl6630141 style='border-top:none;border-left:none'><?php echo $total_box;?></td>
  <td class=xl6630141 style='border-top:none;border-left:none'><?php echo $total_PcsIn;?></td>
  <td class=xl6630141 style='border-top:none;border-left:none'><?php echo $total_Pcs;?></td>
  <td class=xl6830141 style='border-top:none;border-left:none'>&nbsp;</td>
 </tr>
 <?php 
 }?>
 <![if supportMisalignedColumns]>
 <tr height=0 style='display:none'>
  <td width=32 style='width:24pt'></td>
  <td width=156 style='width:117pt'></td>
  <td width=266 style='width:200pt'></td>
  <td width=72 style='width:54pt'></td>
  <td width=72 style='width:54pt'></td>
  <td width=72 style='width:54pt'></td>
  <td width=56 style='width:42pt'></td>
  <td width=113 style='width:85pt'></td>
 </tr>
 <![endif]>
</table>

</div>


<!----------------------------->
<!--END OF OUTPUT FROM EXCEL PUBLISH AS WEB PAGE WIZARD-->
<!----------------------------->
</body>

</html>

