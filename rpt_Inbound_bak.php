<html xmlns:v="urn:schemas-microsoft-com:vml"
xmlns:o="urn:schemas-microsoft-com:office:office"
xmlns:x="urn:schemas-microsoft-com:office:excel"
xmlns="http://www.w3.org/TR/REC-html40">
<?php
include_once "mycnn.php";

$id=$_REQUEST["id"];
$str="SELECT DATE_FORMAT(t.CreateDate,'%d/%m/%Y') AS DateIn,t.TruckNo,t.DriverName FROM tbl_route t WHERE t.ID_Route=".$id;
$rs=mysqli_query($cnn,$str);

$DateIn="";
$TruckNo="";
$DriverName="";

if(mysqli_num_rows($rs)>0)
{
	$row=mysqli_fetch_assoc($rs);
	$DateIn=$row["DateIn"];
	$TruckNo=$row["TruckNo"];
	$DriverName=$row["DriverName"];
}
//header("Content-Type:   application/vnd.ms-excel; charset=utf-8");
//header("Content-Disposition: attachment; filename=INBOUND_".date('d/m/Y').".xls");
?>
<head>
<meta http-equiv=Content-Type content="text/html; charset=utf-8">
<meta name=ProgId content=Excel.Sheet>
<meta name=Generator content="Microsoft Excel 15">
<link rel=File-List href="INBOUND_files/filelist.xml">
<!--[if !mso]>
<style>
v\:* {behavior:url(#default#VML);}
o\:* {behavior:url(#default#VML);}
x\:* {behavior:url(#default#VML);}
.shape {behavior:url(#default#VML);}
</style>
<![endif]-->
<style id="INBOUND_3772_Styles">
<!--table
	{mso-displayed-decimal-separator:"\.";
	mso-displayed-thousand-separator:"\,";}
.font53772
	{color:windowtext;
	font-size:11.0pt;
	font-weight:700;
	font-style:normal;
	text-decoration:none;
	font-family:"Times New Roman", serif;
	mso-font-charset:0;}
.font63772
	{color:windowtext;
	font-size:11.0pt;
	font-weight:400;
	font-style:italic;
	text-decoration:none;
	font-family:"Times New Roman", serif;
	mso-font-charset:0;}
.font73772
	{color:windowtext;
	font-size:12.0pt;
	font-weight:400;
	font-style:normal;
	text-decoration:none;
	font-family:"Times New Roman", serif;
	mso-font-charset:0;}
.font83772
	{color:windowtext;
	font-size:11.0pt;
	font-weight:400;
	font-style:normal;
	text-decoration:none;
	font-family:"Times New Roman", serif;
	mso-font-charset:0;}
.font93772
	{color:windowtext;
	font-size:10.0pt;
	font-weight:400;
	font-style:normal;
	text-decoration:none;
	font-family:"Times New Roman", serif;
	mso-font-charset:0;}
.font103772
	{color:windowtext;
	font-size:18.0pt;
	font-weight:700;
	font-style:normal;
	text-decoration:none;
	font-family:"Times New Roman", serif;
	mso-font-charset:0;}
.font113772
	{color:black;
	font-size:11.0pt;
	font-weight:400;
	font-style:normal;
	text-decoration:none;
	font-family:"Times New Roman", serif;
	mso-font-charset:0;}
.font123772
	{color:windowtext;
	font-size:12.0pt;
	font-weight:400;
	font-style:italic;
	text-decoration:none;
	font-family:"Times New Roman", serif;
	mso-font-charset:0;}
.font133772
	{color:black;
	font-size:11.0pt;
	font-weight:400;
	font-style:italic;
	text-decoration:none;
	font-family:"Times New Roman", serif;
	mso-font-charset:0;}
.font143772
	{color:#002060;
	font-size:11.0pt;
	font-weight:700;
	font-style:italic;
	text-decoration:none;
	font-family:"Times New Roman", serif;
	mso-font-charset:0;}
.font153772
	{color:windowtext;
	font-size:10.0pt;
	font-weight:700;
	font-style:italic;
	text-decoration:none;
	font-family:"Times New Roman", serif;
	mso-font-charset:0;}
.xl31693772
	{padding:0px;
	mso-ignore:padding;
	color:black;
	font-size:11.0pt;
	font-weight:700;
	font-style:normal;
	text-decoration:none;
	font-family:"Times New Roman", serif;
	mso-font-charset:0;
	mso-number-format:General;
	text-align:general;
	vertical-align:top;
	mso-background-source:auto;
	mso-pattern:auto;
	white-space:nowrap;}
.xl31703772
	{padding:0px;
	mso-ignore:padding;
	color:black;
	font-size:11.0pt;
	font-weight:400;
	font-style:normal;
	text-decoration:none;
	font-family:"Times New Roman", serif;
	mso-font-charset:0;
	mso-number-format:General;
	text-align:general;
	vertical-align:bottom;
	mso-background-source:auto;
	mso-pattern:auto;
	white-space:nowrap;}
.xl31713772
	{padding:0px;
	mso-ignore:padding;
	color:windowtext;
	font-size:11.0pt;
	font-weight:400;
	font-style:normal;
	text-decoration:none;
	font-family:"Times New Roman", serif;
	mso-font-charset:0;
	mso-number-format:General;
	text-align:center;
	vertical-align:middle;
	border:.5pt solid windowtext;
	mso-background-source:auto;
	mso-pattern:auto;
	white-space:normal;}
.xl31723772
	{padding:0px;
	mso-ignore:padding;
	color:windowtext;
	font-size:11.0pt;
	font-weight:700;
	font-style:normal;
	text-decoration:none;
	font-family:"Times New Roman", serif;
	mso-font-charset:0;
	mso-number-format:General;
	text-align:center;
	vertical-align:middle;
	border:.5pt solid windowtext;
	background:white;
	mso-pattern:black none;
	white-space:normal;}
.xl31733772
	{padding:0px;
	mso-ignore:padding;
	color:black;
	font-size:11.0pt;
	font-weight:400;
	font-style:normal;
	text-decoration:none;
	font-family:"Times New Roman", serif;
	mso-font-charset:0;
	mso-number-format:"00\0022\:\002200";
	text-align:right;
	vertical-align:bottom;
	mso-background-source:auto;
	mso-pattern:auto;
	white-space:nowrap;}
.xl31743772
	{padding:0px;
	mso-ignore:padding;
	color:windowtext;
	font-size:11.0pt;
	font-weight:700;
	font-style:normal;
	text-decoration:none;
	font-family:"Times New Roman", serif;
	mso-font-charset:0;
	mso-number-format:"Short Time";
	text-align:center;
	vertical-align:middle;
	border:.5pt solid windowtext;
	background:white;
	mso-pattern:black none;
	white-space:normal;}
.xl31753772
	{padding:0px;
	mso-ignore:padding;
	color:windowtext;
	font-size:11.0pt;
	font-weight:400;
	font-style:normal;
	text-decoration:none;
	font-family:"Times New Roman", serif;
	mso-font-charset:0;
	mso-number-format:General;
	text-align:left;
	vertical-align:bottom;
	mso-background-source:auto;
	mso-pattern:auto;
	white-space:nowrap;}
.xl31763772
	{padding:0px;
	mso-ignore:padding;
	color:windowtext;
	font-size:9.0pt;
	font-weight:400;
	font-style:normal;
	text-decoration:none;
	font-family:"Times New Roman", serif;
	mso-font-charset:0;
	mso-number-format:General;
	text-align:left;
	vertical-align:bottom;
	mso-background-source:auto;
	mso-pattern:auto;
	white-space:nowrap;}
.xl31773772
	{padding:0px;
	mso-ignore:padding;
	color:windowtext;
	font-size:12.0pt;
	font-weight:400;
	font-style:normal;
	text-decoration:none;
	font-family:"Times New Roman", serif;
	mso-font-charset:0;
	mso-number-format:General;
	text-align:general;
	vertical-align:bottom;
	mso-background-source:auto;
	mso-pattern:auto;
	white-space:nowrap;}
.xl31783772
	{padding:0px;
	mso-ignore:padding;
	color:windowtext;
	font-size:12.0pt;
	font-weight:400;
	font-style:italic;
	text-decoration:none;
	font-family:"Times New Roman", serif;
	mso-font-charset:0;
	mso-number-format:General;
	text-align:general;
	vertical-align:bottom;
	mso-background-source:auto;
	mso-pattern:auto;
	white-space:nowrap;}
.xl31793772
	{padding:0px;
	mso-ignore:padding;
	color:windowtext;
	font-size:12.0pt;
	font-weight:400;
	font-style:normal;
	text-decoration:none;
	font-family:"Times New Roman", serif;
	mso-font-charset:0;
	mso-number-format:General;
	text-align:left;
	vertical-align:bottom;
	mso-background-source:auto;
	mso-pattern:auto;
	white-space:nowrap;}
.xl31803772
	{padding:0px;
	mso-ignore:padding;
	color:windowtext;
	font-size:10.0pt;
	font-weight:700;
	font-style:normal;
	text-decoration:none;
	font-family:"Times New Roman", serif;
	mso-font-charset:0;
	mso-number-format:General;
	text-align:center;
	vertical-align:middle;
	border:.5pt solid windowtext;
	mso-background-source:auto;
	mso-pattern:auto;
	white-space:normal;}
.xl31813772
	{padding:0px;
	mso-ignore:padding;
	color:black;
	font-size:11.0pt;
	font-weight:400;
	font-style:italic;
	text-decoration:none;
	font-family:"Times New Roman", serif;
	mso-font-charset:0;
	mso-number-format:General;
	text-align:general;
	vertical-align:bottom;
	mso-background-source:auto;
	mso-pattern:auto;
	white-space:nowrap;}
.xl31823772
	{padding:0px;
	mso-ignore:padding;
	color:windowtext;
	font-size:10.0pt;
	font-weight:700;
	font-style:normal;
	text-decoration:none;
	font-family:"Times New Roman", serif;
	mso-font-charset:0;
	mso-number-format:General;
	text-align:center;
	vertical-align:middle;
	mso-background-source:auto;
	mso-pattern:auto;
	white-space:normal;}
.xl31833772
	{padding:0px;
	mso-ignore:padding;
	color:windowtext;
	font-size:11.0pt;
	font-weight:400;
	font-style:normal;
	text-decoration:none;
	font-family:"Times New Roman", serif;
	mso-font-charset:0;
	mso-number-format:General;
	text-align:center;
	vertical-align:middle;
	mso-background-source:auto;
	mso-pattern:auto;
	white-space:normal;}
.xl31843772
	{padding:0px;
	mso-ignore:padding;
	color:windowtext;
	font-size:11.0pt;
	font-weight:700;
	font-style:normal;
	text-decoration:none;
	font-family:"Times New Roman", serif;
	mso-font-charset:0;
	mso-number-format:General;
	text-align:general;
	vertical-align:bottom;
	mso-background-source:auto;
	mso-pattern:auto;
	white-space:nowrap;}
.xl31853772
	{padding:0px;
	mso-ignore:padding;
	color:windowtext;
	font-size:11.0pt;
	font-weight:400;
	font-style:normal;
	text-decoration:none;
	font-family:"Times New Roman", serif;
	mso-font-charset:0;
	mso-number-format:General;
	text-align:general;
	vertical-align:bottom;
	mso-background-source:auto;
	mso-pattern:auto;
	white-space:nowrap;}
.xl31863772
	{padding:0px;
	mso-ignore:padding;
	color:black;
	font-size:11.0pt;
	font-weight:400;
	font-style:normal;
	text-decoration:none;
	font-family:"Times New Roman", serif;
	mso-font-charset:0;
	mso-number-format:General;
	text-align:center;
	vertical-align:bottom;
	mso-background-source:auto;
	mso-pattern:auto;
	white-space:nowrap;}
.xl31873772
	{padding:0px;
	mso-ignore:padding;
	color:black;
	font-size:11.0pt;
	font-weight:400;
	font-style:normal;
	text-decoration:none;
	font-family:"Times New Roman", serif;
	mso-font-charset:0;
	mso-number-format:General;
	text-align:general;
	vertical-align:middle;
	mso-background-source:auto;
	mso-pattern:auto;
	white-space:nowrap;}
.xl31883772
	{padding:0px;
	mso-ignore:padding;
	color:windowtext;
	font-size:11.0pt;
	font-weight:700;
	font-style:normal;
	text-decoration:none;
	font-family:"Times New Roman", serif;
	mso-font-charset:0;
	mso-number-format:General;
	text-align:center;
	vertical-align:bottom;
	mso-background-source:auto;
	mso-pattern:auto;
	white-space:nowrap;}
.xl31893772
	{padding:0px;
	mso-ignore:padding;
	color:black;
	font-size:11.0pt;
	font-weight:400;
	font-style:normal;
	text-decoration:none;
	font-family:"Times New Roman", serif;
	mso-font-charset:0;
	mso-number-format:General;
	text-align:left;
	vertical-align:bottom;
	mso-background-source:auto;
	mso-pattern:auto;
	white-space:nowrap;}
.xl31903772
	{padding:0px;
	mso-ignore:padding;
	color:windowtext;
	font-size:10.0pt;
	font-weight:400;
	font-style:normal;
	text-decoration:none;
	font-family:"Times New Roman", serif;
	mso-font-charset:0;
	mso-number-format:General;
	text-align:general;
	vertical-align:bottom;
	mso-background-source:auto;
	mso-pattern:auto;
	white-space:nowrap;}
.xl31913772
	{padding:0px;
	mso-ignore:padding;
	color:windowtext;
	font-size:10.0pt;
	font-weight:700;
	font-style:normal;
	text-decoration:none;
	font-family:"Times New Roman", serif;
	mso-font-charset:0;
	mso-number-format:General;
	text-align:general;
	vertical-align:bottom;
	mso-background-source:auto;
	mso-pattern:auto;
	white-space:nowrap;}
.xl31923772
	{padding:0px;
	mso-ignore:padding;
	color:windowtext;
	font-size:15.0pt;
	font-weight:700;
	font-style:normal;
	text-decoration:none;
	font-family:"Times New Roman", serif;
	mso-font-charset:0;
	mso-number-format:General;
	text-align:general;
	vertical-align:middle;
	mso-background-source:auto;
	mso-pattern:auto;
	white-space:normal;}
.xl31933772
	{padding:0px;
	mso-ignore:padding;
	color:windowtext;
	font-size:12.0pt;
	font-weight:400;
	font-style:normal;
	text-decoration:none;
	font-family:"Times New Roman", serif;
	mso-font-charset:0;
	mso-number-format:ddmmyyhmm;
	text-align:general;
	vertical-align:middle;
	mso-background-source:auto;
	mso-pattern:auto;
	white-space:nowrap;}
.xl31943772
	{padding:0px;
	mso-ignore:padding;
	color:windowtext;
	font-size:12.0pt;
	font-weight:400;
	font-style:normal;
	text-decoration:none;
	font-family:"Times New Roman", serif;
	mso-font-charset:0;
	mso-number-format:000000;
	text-align:general;
	vertical-align:middle;
	mso-background-source:auto;
	mso-pattern:auto;
	white-space:nowrap;}
.xl31953772
	{padding:0px;
	mso-ignore:padding;
	color:windowtext;
	font-size:14.0pt;
	font-weight:700;
	font-style:normal;
	text-decoration:none;
	font-family:"Times New Roman", serif;
	mso-font-charset:0;
	mso-number-format:"Short Date";
	text-align:general;
	vertical-align:middle;
	mso-background-source:auto;
	mso-pattern:auto;
	white-space:normal;}
.xl31963772
	{padding:0px;
	mso-ignore:padding;
	color:windowtext;
	font-size:12.0pt;
	font-weight:400;
	font-style:normal;
	text-decoration:none;
	font-family:"Times New Roman", serif;
	mso-font-charset:0;
	mso-number-format:General;
	text-align:general;
	vertical-align:bottom;
	mso-background-source:auto;
	mso-pattern:auto;
	white-space:nowrap;}
.xl31973772
	{padding:0px;
	mso-ignore:padding;
	color:windowtext;
	font-size:14.0pt;
	font-weight:400;
	font-style:normal;
	text-decoration:none;
	font-family:"Times New Roman", serif;
	mso-font-charset:0;
	mso-number-format:"Short Date";
	text-align:general;
	vertical-align:middle;
	mso-background-source:auto;
	mso-pattern:auto;
	white-space:normal;}
.xl31983772
	{padding:0px;
	mso-ignore:padding;
	color:windowtext;
	font-size:10.0pt;
	font-weight:400;
	font-style:italic;
	text-decoration:none;
	font-family:"Times New Roman", serif;
	mso-font-charset:0;
	mso-number-format:General;
	text-align:center;
	vertical-align:bottom;
	mso-background-source:auto;
	mso-pattern:auto;
	white-space:nowrap;}
.xl31993772
	{padding:0px;
	mso-ignore:padding;
	color:windowtext;
	font-size:10.0pt;
	font-weight:700;
	font-style:normal;
	text-decoration:none;
	font-family:"Times New Roman", serif;
	mso-font-charset:0;
	mso-number-format:General;
	text-align:center;
	vertical-align:bottom;
	mso-background-source:auto;
	mso-pattern:auto;
	white-space:nowrap;}
.xl32003772
	{padding:0px;
	mso-ignore:padding;
	color:#002060;
	font-size:11.0pt;
	font-weight:700;
	font-style:normal;
	text-decoration:none;
	font-family:"Times New Roman", serif;
	mso-font-charset:0;
	mso-number-format:0;
	text-align:center;
	vertical-align:middle;
	border:.5pt solid windowtext;
	background:white;
	mso-pattern:black none;
	white-space:normal;}
.xl32013772
	{padding:0px;
	mso-ignore:padding;
	color:windowtext;
	font-size:13.0pt;
	font-weight:400;
	font-style:normal;
	text-decoration:none;
	font-family:"Times New Roman", serif;
	mso-font-charset:0;
	mso-number-format:General;
	text-align:left;
	vertical-align:bottom;
	mso-background-source:auto;
	mso-pattern:auto;
	white-space:nowrap;}
.xl32023772
	{padding:0px;
	mso-ignore:padding;
	color:windowtext;
	font-size:13.0pt;
	font-weight:400;
	font-style:normal;
	text-decoration:none;
	font-family:"Times New Roman", serif;
	mso-font-charset:0;
	mso-number-format:General;
	text-align:left;
	vertical-align:middle;
	mso-background-source:auto;
	mso-pattern:auto;
	white-space:nowrap;}
.xl32033772
	{padding:0px;
	mso-ignore:padding;
	color:windowtext;
	font-size:11.0pt;
	font-weight:400;
	font-style:normal;
	text-decoration:none;
	font-family:"Times New Roman", serif;
	mso-font-charset:0;
	mso-number-format:General;
	text-align:left;
	vertical-align:middle;
	mso-background-source:auto;
	mso-pattern:auto;
	white-space:nowrap;}
.xl32043772
	{padding:0px;
	mso-ignore:padding;
	color:windowtext;
	font-size:11.0pt;
	font-weight:400;
	font-style:normal;
	text-decoration:none;
	font-family:"Times New Roman", serif;
	mso-font-charset:0;
	mso-number-format:General;
	text-align:general;
	vertical-align:middle;
	mso-background-source:auto;
	mso-pattern:auto;
	white-space:normal;}
.xl32053772
	{padding:0px;
	mso-ignore:padding;
	color:windowtext;
	font-size:11.0pt;
	font-weight:400;
	font-style:normal;
	text-decoration:none;
	font-family:"Times New Roman", serif;
	mso-font-charset:0;
	mso-number-format:General;
	text-align:left;
	vertical-align:middle;
	border:.5pt solid windowtext;
	mso-background-source:auto;
	mso-pattern:auto;
	white-space:normal;}
.xl32063772
	{padding:0px;
	mso-ignore:padding;
	color:windowtext;
	font-size:12.0pt;
	font-weight:400;
	font-style:normal;
	text-decoration:none;
	font-family:"Times New Roman", serif;
	mso-font-charset:0;
	mso-number-format:General;
	text-align:center;
	vertical-align:middle;
	border:.5pt solid windowtext;
	mso-background-source:auto;
	mso-pattern:auto;
	white-space:normal;}
.xl32073772
	{padding:0px;
	mso-ignore:padding;
	color:windowtext;
	font-size:12.0pt;
	font-weight:400;
	font-style:normal;
	text-decoration:none;
	font-family:"Times New Roman", serif;
	mso-font-charset:0;
	mso-number-format:General;
	text-align:center;
	vertical-align:middle;
	border:.5pt solid windowtext;
	mso-background-source:auto;
	mso-pattern:auto;
	white-space:nowrap;}
.xl32083772
	{padding:0px;
	mso-ignore:padding;
	color:black;
	font-size:11.0pt;
	font-weight:400;
	font-style:normal;
	text-decoration:none;
	font-family:"Times New Roman", serif;
	mso-font-charset:0;
	mso-number-format:General;
	text-align:general;
	vertical-align:middle;
	border:.5pt solid windowtext;
	mso-background-source:auto;
	mso-pattern:auto;
	white-space:nowrap;}
.xl32093772
	{padding:0px;
	mso-ignore:padding;
	color:windowtext;
	font-size:11.0pt;
	font-weight:700;
	font-style:normal;
	text-decoration:none;
	font-family:"Times New Roman", serif;
	mso-font-charset:0;
	mso-number-format:General;
	text-align:center;
	vertical-align:middle;
	border:.5pt solid windowtext;
	mso-background-source:auto;
	mso-pattern:auto;
	white-space:nowrap;}
.xl32103772
	{padding:0px;
	mso-ignore:padding;
	color:black;
	font-size:11.0pt;
	font-weight:400;
	font-style:normal;
	text-decoration:none;
	font-family:"Times New Roman", serif;
	mso-font-charset:0;
	mso-number-format:General;
	text-align:center;
	vertical-align:middle;
	border:.5pt solid windowtext;
	mso-background-source:auto;
	mso-pattern:auto;
	white-space:nowrap;}
.xl32113772
	{padding:0px;
	mso-ignore:padding;
	color:windowtext;
	font-size:11.0pt;
	font-weight:400;
	font-style:normal;
	text-decoration:none;
	font-family:"Times New Roman", serif;
	mso-font-charset:0;
	mso-number-format:General;
	text-align:center;
	vertical-align:middle;
	border:.5pt solid windowtext;
	mso-background-source:auto;
	mso-pattern:auto;
	white-space:nowrap;}
.xl32123772
	{padding:0px;
	mso-ignore:padding;
	color:windowtext;
	font-size:12.0pt;
	font-weight:400;
	font-style:normal;
	text-decoration:none;
	font-family:"Times New Roman", serif;
	mso-font-charset:0;
	mso-number-format:General;
	text-align:general;
	vertical-align:middle;
	border:.5pt solid windowtext;
	mso-background-source:auto;
	mso-pattern:auto;
	white-space:nowrap;}
.xl32133772
	{padding:0px;
	mso-ignore:padding;
	color:windowtext;
	font-size:10.0pt;
	font-weight:700;
	font-style:normal;
	text-decoration:none;
	font-family:"Times New Roman", serif;
	mso-font-charset:0;
	mso-number-format:General;
	text-align:center;
	vertical-align:middle;
	mso-background-source:auto;
	mso-pattern:auto;
	white-space:normal;}
.xl32143772
	{padding:0px;
	mso-ignore:padding;
	color:windowtext;
	font-size:10.0pt;
	font-weight:700;
	font-style:normal;
	text-decoration:none;
	font-family:"Times New Roman", serif;
	mso-font-charset:0;
	mso-number-format:General;
	text-align:center;
	vertical-align:middle;
	mso-background-source:auto;
	mso-pattern:auto;
	white-space:nowrap;}
.xl32153772
	{padding:0px;
	mso-ignore:padding;
	color:windowtext;
	font-size:10.0pt;
	font-weight:400;
	font-style:italic;
	text-decoration:none;
	font-family:"Times New Roman", serif;
	mso-font-charset:0;
	mso-number-format:General;
	text-align:center;
	vertical-align:middle;
	mso-background-source:auto;
	mso-pattern:auto;
	white-space:nowrap;}
.xl32163772
	{padding:0px;
	mso-ignore:padding;
	color:#002060;
	font-size:11.0pt;
	font-weight:700;
	font-style:normal;
	text-decoration:none;
	font-family:"Times New Roman", serif;
	mso-font-charset:0;
	mso-number-format:General;
	text-align:center;
	vertical-align:middle;
	border-top:.5pt solid windowtext;
	border-right:.5pt solid windowtext;
	border-bottom:none;
	border-left:.5pt solid windowtext;
	background:white;
	mso-pattern:black none;
	white-space:normal;}
.xl32173772
	{padding:0px;
	mso-ignore:padding;
	color:#002060;
	font-size:11.0pt;
	font-weight:700;
	font-style:normal;
	text-decoration:none;
	font-family:"Times New Roman", serif;
	mso-font-charset:0;
	mso-number-format:General;
	text-align:center;
	vertical-align:middle;
	border-top:none;
	border-right:.5pt solid windowtext;
	border-bottom:.5pt solid windowtext;
	border-left:.5pt solid windowtext;
	background:white;
	mso-pattern:black none;
	white-space:normal;}
.xl32183772
	{padding:0px;
	mso-ignore:padding;
	color:#002060;
	font-size:11.0pt;
	font-weight:700;
	font-style:normal;
	text-decoration:none;
	font-family:"Times New Roman", serif;
	mso-font-charset:0;
	mso-number-format:0;
	text-align:center;
	vertical-align:middle;
	border-top:.5pt solid windowtext;
	border-right:.5pt solid windowtext;
	border-bottom:none;
	border-left:.5pt solid windowtext;
	background:white;
	mso-pattern:black none;
	white-space:normal;}
.xl32193772
	{padding:0px;
	mso-ignore:padding;
	color:#002060;
	font-size:11.0pt;
	font-weight:700;
	font-style:normal;
	text-decoration:none;
	font-family:"Times New Roman", serif;
	mso-font-charset:0;
	mso-number-format:0;
	text-align:center;
	vertical-align:middle;
	border-top:none;
	border-right:.5pt solid windowtext;
	border-bottom:.5pt solid windowtext;
	border-left:.5pt solid windowtext;
	background:white;
	mso-pattern:black none;
	white-space:normal;}
.xl32203772
	{padding:0px;
	mso-ignore:padding;
	color:windowtext;
	font-size:11.0pt;
	font-weight:700;
	font-style:normal;
	text-decoration:none;
	font-family:"Times New Roman", serif;
	mso-font-charset:0;
	mso-number-format:General;
	text-align:center;
	vertical-align:bottom;
	mso-background-source:auto;
	mso-pattern:auto;
	white-space:normal;}
.xl32213772
	{padding:0px;
	mso-ignore:padding;
	color:windowtext;
	font-size:16.0pt;
	font-weight:700;
	font-style:normal;
	text-decoration:none;
	font-family:"Times New Roman", serif;
	mso-font-charset:0;
	mso-number-format:General;
	text-align:center;
	vertical-align:bottom;
	mso-background-source:auto;
	mso-pattern:auto;
	white-space:normal;}
.xl32223772
	{padding:0px;
	mso-ignore:padding;
	color:windowtext;
	font-size:16.0pt;
	font-weight:700;
	font-style:normal;
	text-decoration:none;
	font-family:"Times New Roman", serif;
	mso-font-charset:0;
	mso-number-format:General;
	text-align:center;
	vertical-align:bottom;
	mso-background-source:auto;
	mso-pattern:auto;
	white-space:nowrap;}
.xl32233772
	{padding:0px;
	mso-ignore:padding;
	color:#002060;
	font-size:11.0pt;
	font-weight:700;
	font-style:normal;
	text-decoration:none;
	font-family:"Times New Roman", serif;
	mso-font-charset:0;
	mso-number-format:General;
	text-align:center;
	vertical-align:middle;
	border-top:none;
	border-right:.5pt solid windowtext;
	border-bottom:.5pt solid windowtext;
	border-left:.5pt solid windowtext;
	background:white;
	mso-pattern:black none;
	white-space:nowrap;}
-->
</style>
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

<div id="INBOUND_3772" align=center x:publishsource="Excel">

<table border=0 cellpadding=0 cellspacing=0 width=1044 class=xl31703772
 style='border-collapse:collapse;table-layout:fixed;width:783pt'>
 <col class=xl31703772 width=44 style='mso-width-source:userset;mso-width-alt:
 1609;width:33pt'>
 <col class=xl31703772 width=89 style='mso-width-source:userset;mso-width-alt:
 3254;width:67pt'>
 <col class=xl31703772 width=243 style='mso-width-source:userset;mso-width-alt:
 8886;width:182pt'>
 <col class=xl31863772 width=63 style='mso-width-source:userset;mso-width-alt:
 2304;width:47pt'>
 <col class=xl31893772 width=58 style='mso-width-source:userset;mso-width-alt:
 2121;width:44pt'>
 <col class=xl31733772 width=51 style='mso-width-source:userset;mso-width-alt:
 1865;width:38pt'>
 <col class=xl31703772 width=51 span=3 style='mso-width-source:userset;
 mso-width-alt:1865;width:38pt'>
 <col class=xl31703772 width=122 style='mso-width-source:userset;mso-width-alt:
 4461;width:92pt'>
 <col class=xl31703772 width=221 style='mso-width-source:userset;mso-width-alt:
 8082;width:166pt'>
 <tr class=xl31903772 height=93 style='mso-height-source:userset;height:70.15pt'>
  <td height=93 width=44 style='height:70.15pt;width:33pt' align=left
  valign=top><!--[if gte vml 1]><v:shapetype id="_x0000_t75" coordsize="21600,21600"
   o:spt="75" o:preferrelative="t" path="m@4@5l@4@11@9@11@9@5xe" filled="f"
   stroked="f">
   <v:stroke joinstyle="miter"/>
   <v:formulas>
    <v:f eqn="if lineDrawn pixelLineWidth 0"/>
    <v:f eqn="sum @0 1 0"/>
    <v:f eqn="sum 0 0 @1"/>
    <v:f eqn="prod @2 1 2"/>
    <v:f eqn="prod @3 21600 pixelWidth"/>
    <v:f eqn="prod @3 21600 pixelHeight"/>
    <v:f eqn="sum @0 0 1"/>
    <v:f eqn="prod @6 1 2"/>
    <v:f eqn="prod @7 21600 pixelWidth"/>
    <v:f eqn="sum @8 21600 0"/>
    <v:f eqn="prod @7 21600 pixelHeight"/>
    <v:f eqn="sum @10 21600 0"/>
   </v:formulas>
   <v:path o:extrusionok="f" gradientshapeok="t" o:connecttype="rect"/>
   <o:lock v:ext="edit" aspectratio="t"/>
  </v:shapetype><v:shape id="Picture_x0020_2" o:spid="_x0000_s2050" type="#_x0000_t75"
   style='position:absolute;margin-left:0;margin-top:9pt;width:81.75pt;
   height:57.75pt;z-index:2;visibility:visible' o:gfxdata="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
AA==
">
   <v:imagedata src="INBOUND_files/INBOUND_3772_image001.png" o:title=""/>
   <x:ClientData ObjectType="Pict">
    <x:SizeWithCells/>
    <x:CF>Bitmap</x:CF>
    <x:AutoPict/>
   </x:ClientData>
  </v:shape><v:shape id="Rectangle_x0020_1" o:spid="_x0000_s2049" type="#_x0000_t75"
   style='position:absolute;margin-left:0;margin-top:69pt;width:63.75pt;
   height:2.25pt;z-index:1;visibility:visible;mso-wrap-style:square;
   v-text-anchor:top' o:gfxdata="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
ZXYueG1sUEsFBgAAAAAEAAQA9QAAAKMGAAAAAA==
" o:insetmode="auto">
   <v:imagedata src="icon.png" o:title=""/>
   <o:lock v:ext="edit" aspectratio="f"/>
   <x:ClientData ObjectType="Pict">
    <x:SizeWithCells/>
    <x:CF>Bitmap</x:CF>
    <x:AutoPict/>
   </x:ClientData>
  </v:shape><v:group id="Group_x0020_3" o:spid="_x0000_s2051" style='position:absolute;
   margin-left:0;margin-top:71.25pt;width:784.5pt;height:9pt;z-index:3'
   coordorigin=",6207" coordsize="69472,984">
   <o:lock v:ext="edit" text="t"/>
   <v:shape id="Rectangle_x0020_4" o:spid="_x0000_s2052" type="#_x0000_t75"
    style='position:absolute;left:4801;top:6091;width:64756;height:1238;
    visibility:visible;mso-wrap-style:square;v-text-anchor:top' o:gfxdata="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
AABWBgAAAAA=
" o:insetmode="auto">
    <v:imagedata src="images/hor_bar.png" o:title=""/>
    <o:lock v:ext="edit" aspectratio="f"/>
    <x:ClientData ObjectType="Pict">
     <x:CF>Bitmap</x:CF>
     <x:AutoPict/>
    </x:ClientData>
   </v:shape><v:shape id="Rectangle_x0020_5" o:spid="_x0000_s2053" type="#_x0000_t75"
    style='position:absolute;left:-84;top:6091;width:8072;height:1125;
    visibility:visible;mso-wrap-style:square;v-text-anchor:top' o:gfxdata="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
" o:insetmode="auto">
    <v:imagedata src="images/hor_bar.png" o:title=""/>
    <o:lock v:ext="edit" aspectratio="f"/>
    <x:ClientData ObjectType="Pict">
     <x:CF>Bitmap</x:CF>
     <x:AutoPict/>
    </x:ClientData>
   </v:shape></v:group><![endif]--><![if !vml]><span style='mso-ignore:vglayout;
  position:absolute;z-index:2;margin-left:-1px;margin-top:12px;width:1048px;
  height:97px'>
  <table cellpadding=0 cellspacing=0>
   <tr>
    <td width=0 height=0></td>
    <td width=1></td>
    <td width=109></td>
    <td width=938></td>
   </tr>
   <tr>
    <td height=77></td>
    <td></td>
    <td align=left valign=top><img width=109 height=77
    src="images/icon.png" v:shapes="Picture_x0020_2"></td>
   </tr>
   <tr>
    <td height=3></td>
   </tr>
   <tr>
    <td height=17></td>
    <td colspan=3 align=left valign=top><img width=1048 height=17
    src="images/hor_bar.png" v:shapes="Rectangle_x0020_1 Group_x0020_3 Rectangle_x0020_4 Rectangle_x0020_5"></td>
   </tr>
  </table>
  </span><![endif]><span style='mso-ignore:vglayout2'>
  <table cellpadding=0 cellspacing=0>
   <tr>
    <td height=93 class=xl31853772 width=44 style='height:70.15pt;width:33pt'><a
    name="RANGE!A1:K34"></a></td>
   </tr>
  </table>
  </span></td>
  <td colspan=10 class=xl32203772 width=1000 style='width:750pt'><font
  class="font103772">YAMATO LOGISTICS VIETNAM CO., LTD.</font><font
  class="font53772"><br>
    </font><font class="font93772">14th Floor, Handico Tower, Pham Hung Street,
  Me Tri Ward,<span style='mso-spacerun:yes'>  </span>Nam Tu Liem
  District,<br>
    <span style='mso-spacerun:yes'> </span>Ha Noi City, Vietnam. <br>
    Tel No. 84-24-3772 7015 / Fax No. : 84-24-3772 7016</font></td>
 </tr>
 <tr height=22 style='mso-height-source:userset;height:16.5pt'>
  <td height=22 class=xl31853772 style='height:16.5pt'></td>
  <td class=xl31853772></td>
  <td class=xl31923772 width=243 style='width:182pt'></td>
  <td class=xl31923772 width=63 style='width:47pt'></td>
  <td class=xl31923772 width=58 style='width:44pt'></td>
  <td class=xl32023772></td>
  <td class=xl31813772></td>
  <td class=xl31813772></td>
  <td class=xl31813772></td>
  <td class=xl31813772></td>
  <td class=xl31813772></td>
 </tr>
 <tr height=22 style='mso-height-source:userset;height:16.5pt'>
  <td height=22 class=xl31913772 colspan=2 style='height:16.5pt'>B&#7897;
  ph&#7853;n: Kho th&#432;&#7901;ng</td>
  <td class=xl31923772 width=243 style='width:182pt'></td>
  <td class=xl31923772 width=63 style='width:47pt'></td>
  <td class=xl31923772 width=58 style='width:44pt'></td>
  <td class=xl32023772></td>
  <td class=xl31813772></td>
  <td class=xl31813772></td>
  <td class=xl31813772></td>
  <td class=xl31813772></td>
  <td class=xl31813772></td>
 </tr>
 <tr height=22 style='mso-height-source:userset;height:16.5pt'>
  <td height=22 class=xl31903772 colspan=3 style='height:16.5pt'>Section:
  Normal warehouse</td>
  <td class=xl31923772 width=63 style='width:47pt'></td>
  <td class=xl31923772 width=58 style='width:44pt'></td>
  <td class=xl32013772></td>
  <td class=xl31873772></td>
  <td class=xl31873772></td>
  <td class=xl31873772></td>
  <td class=xl31873772></td>
  <td class=xl31873772></td>
 </tr>
 <tr height=56 style='mso-height-source:userset;height:42.6pt'>
  <td colspan=11 height=56 class=xl32213772 width=1044 style='height:42.6pt;
  width:783pt'>PHI&#7870;U NH&#7852;P KHO<br>
    INBOUND W/H TALLY SHEET</td>
 </tr>
 <tr class=xl31893772 height=9 style='mso-height-source:userset;height:6.75pt'>
  <td height=9 class=xl31773772 style='height:6.75pt'></td>
  <td class=xl31773772></td>
  <td class=xl31953772 width=243 style='width:182pt'></td>
  <td class=xl31853772></td>
  <td class=xl31853772></td>
  <td class=xl31853772></td>
  <td class=xl31933772></td>
  <td class=xl31933772></td>
  <td class=xl31933772></td>
  <td class=xl31933772></td>
  <td class=xl31933772></td>
 </tr>
 <tr class=xl31893772 height=20 style='mso-height-source:userset;height:15.0pt'>
  <td height=20 class=xl31783772 colspan=3 style='height:15.0pt'><font
  class="font73772">Ngày</font><font class="font123772">/ Date: <?php echo $DateIn?></font><font
  class="font93772">….....................................................................</font><span
  style='display:none'><font class="font93772">......................</font></span></td>
  <td class=xl31893772 colspan=8>S&#7889; phi&#7871;u/ <font class="font133772">Order
  No: </font><font class="font113772"><?php echo $id;?></font></td>
 </tr>
 <tr class=xl31893772 height=24 style='mso-height-source:userset;height:18.0pt'>
  <td height=24 class=xl31773772 colspan=11 style='height:18.0pt'>Theo
  l&#7879;nh nh&#7853;p kho c&#7911;a MMV s&#7889;/ <font class="font123772">As
  per MMV order's No.:</font><font class="font73772">
  …..................................................................................................................................</font></td>
 </tr>
 <tr class=xl31893772 height=24 style='mso-height-source:userset;height:18.0pt'>
  <td height=24 class=xl31963772 colspan=9 style='height:18.0pt'>Nh&#7853;p
  t&#7841;i kho<font class="font123772">/ Warehouse add: </font><font
  class="font73772"><span style='mso-spacerun:yes'> </span>Lot CN1-2, Yen Phong
  Industrial Zone, Dong Phong, Yen Phong, Bac Ninh</font></td>
  <td class=xl31943772></td>
  <td class=xl31943772></td>
 </tr>
 <tr class=xl31893772 height=24 style='mso-height-source:userset;height:18.0pt'>
  <td height=24 class=xl31773772 colspan=5 style='height:18.0pt'>Ng&#432;&#7901;i
  giao hàng/ <font class="font123772">Delivery cargo party</font><font
  class="font73772">: </font><font class="font123772"><?PHP echo $DriverName?></font><font
  class="font63772">............................................................</font><span
  style='display:none'><font class="font63772">...............................................</font></span></td>
  <td class=xl31893772 colspan=6>S&#7889; xe / <font class="font133772">Truck
  No</font><font class="font113772">.:
  <?php echo $TruckNo?></font></td>
 </tr>
 <tr class=xl31893772 height=24 style='mso-height-source:userset;height:18.0pt'>
  <td height=24 class=xl31783772 colspan=3 style='height:18.0pt'><font
  class="font73772">Th&#7901;i gian b&#7855;t &#273;&#7847;u</font><font
  class="font123772">/ Start time: ….........................................</font><span
  style='display:none'><font class="font123772">......</font></span></td>
  <td class=xl31873772 colspan=7>Th&#7901;i gian k&#7871;t thúc/ <font
  class="font133772">End time</font><font class="font113772">:
  …................................................................</font><span
  style='display:none'><font class="font113772">...........</font></span></td>
  <td class=xl31893772>Ngoài gi&#7901;/ <font class="font133772">Overtime</font><font
  class="font113772">: …...................</font><span style='display:none'><font
  class="font113772">.......</font></span></td>
 </tr>
 <tr class=xl31893772 height=10 style='mso-height-source:userset;height:7.9pt'>
  <td height=10 class=xl31793772 style='height:7.9pt'></td>
  <td class=xl31793772></td>
  <td class=xl31763772></td>
  <td class=xl31863772></td>
  <td class=xl31893772></td>
  <td class=xl31753772></td>
  <td class=xl31893772></td>
  <td class=xl31893772></td>
  <td class=xl31893772></td>
  <td class=xl31893772></td>
  <td class=xl31893772></td>
 </tr>
 <tr class=xl31693772 height=39 style='mso-height-source:userset;height:29.25pt'>
  <td rowspan=2 height=77 class=xl32163772 width=44 style='border-bottom:.5pt solid black;
  height:57.75pt;width:33pt'>S&#7889;/ <br>
    No.</td>
  <td rowspan=2 class=xl32163772 width=89 style='border-bottom:.5pt solid black;
  width:67pt'>Mã ph&#7909; tùng<font class="font143772">/ <br>
    Code</font></td>
  <td rowspan=2 class=xl32183772 width=243 style='border-bottom:.5pt solid black;
  width:182pt'>Tên Ph&#7909; Tùng<font class="font143772">/<br>
    Item description</font></td>
  <td rowspan=2 class=xl32003772 width=63 style='width:47pt'>S&#7889;
  l&#432;&#7907;ng<font class="font143772">/ <br>
    Quantity</font></td>
  <td rowspan=2 class=xl32003772 width=58 style='width:44pt'>Màng co/ Stretch
  film</td>
  <td colspan=2 class=xl32003772 width=102 style='border-left:none;width:76pt'>B&#7889;c
  x&#7871;p/ Unloading</td>
  <td colspan=2 class=xl32003772 width=102 style='border-left:none;width:76pt'>Qu&#7845;n
  PE/ <br>
    Vinyl packing</td>
  <td rowspan=2 class=xl32183772 width=122 style='border-bottom:.5pt solid black;
  width:92pt'>Reference</td>
  <td rowspan=2 class=xl32163772 width=221 style='border-bottom:.5pt solid black;
  width:166pt'>Ghi chú/ Remark<br>
    ( DIM of pallet, use pallet... G/NG)</td>
 </tr>
 <tr class=xl31693772 height=38 style='mso-height-source:userset;height:28.5pt'>
  <td height=38 class=xl32003772 width=51 style='height:28.5pt;border-top:none;
  border-left:none;width:38pt'>Carton</td>
  <td class=xl32003772 width=51 style='border-top:none;border-left:none;
  width:38pt'>Pallet</td>
  <td class=xl32003772 width=51 style='border-top:none;border-left:none;
  width:38pt'>Carton</td>
  <td class=xl32003772 width=51 style='border-top:none;border-left:none;
  width:38pt'>Pallet</td>
 </tr>
 <?PHP 
 	$str2="SELECT tu.code,tu.RealPCS,tp.ProductName FROM tbl_unload tu INNER JOIN tbl_product tp ON tu.Code=tp.Code WHERE tu.ID_Route=".$id;
	$rs2=mysqli_query($cnn,$str2);
	$stt=0;
	while($row2=mysqli_fetch_assoc($rs2)){
		$stt+=1;
		$code=$row2["code"];
		$RealPCS=$row2["RealPCS"];
		$ProductName=$row2["ProductName"];		
 ?>
 <tr class=xl31703772 height=26 style='mso-height-source:userset;height:20.1pt'>
  <td height=26 class=xl31713772 width=44 style='height:20.1pt;border-top:none;
  width:33pt'><?php echo $stt;?></td>
  <td class=xl32053772 width=89 style='border-top:none;border-left:none;
  width:67pt; padding-left:2px; padding-right:2px;'><?php echo $code;?></td>
  <td class=xl32053772 width=243 style='border-top:none;border-left:none; padding-left:5px;
  width:182pt'><?php echo $ProductName?></td>
  <td class=xl32073772 style='border-top:none;border-left:none'>1</td>
  <td class=xl32073772 style='border-top:none;border-left:none'>&nbsp;</td>
  <td class=xl31743772 width=51 style='border-top:none;border-left:none;
  width:38pt'>&nbsp;</td>
  <td class=xl32083772 style='border-top:none;border-left:none'>&nbsp;</td>
  <td class=xl32083772 style='border-top:none;border-left:none'>&nbsp;</td>
  <td class=xl32083772 style='border-top:none;border-left:none'>&nbsp;</td>
  <td class=xl32103772 style='border-top:none;border-left:none'>&nbsp;</td>
  <td class=xl32083772 style='border-top:none;border-left:none'>&nbsp;</td>
 </tr>
 <?Php 
  }
  ?>
 
 <tr height=32 style='mso-height-source:userset;height:24.6pt'>
  <td height=32 class=xl31803772 width=44 style='height:24.6pt;border-top:none;
  width:33pt'>T&#7893;ng/ Total</td>
  <td class=xl32053772 width=89 style='border-top:none;border-left:none;
  width:67pt'>&nbsp;</td>
  <td class=xl32053772 width=243 style='border-top:none;border-left:none;
  width:182pt'>&nbsp;</td>
  <td class=xl32093772 style='border-top:none;border-left:none'>&nbsp;</td>
  <td class=xl32093772 style='border-top:none;border-left:none'>&nbsp;</td>
  <td class=xl32113772 style='border-top:none;border-left:none'>&nbsp;</td>
  <td class=xl32103772 style='border-top:none;border-left:none'>&nbsp;</td>
  <td class=xl32103772 style='border-top:none;border-left:none'>&nbsp;</td>
  <td class=xl32103772 style='border-top:none;border-left:none'>&nbsp;</td>
  <td class=xl32103772 style='border-top:none;border-left:none'>&nbsp;</td>
  <td class=xl32103772 style='border-top:none;border-left:none'>&nbsp;</td>
 </tr>
 <tr height=16 style='mso-height-source:userset;height:12.0pt'>
  <td height=16 class=xl31823772 width=44 style='height:12.0pt;width:33pt'></td>
  <td class=xl31833772 width=89 style='width:67pt'></td>
  <td class=xl31833772 width=243 style='width:182pt'></td>
  <td class=xl31883772></td>
  <td class=xl31883772></td>
  <td class=xl31853772></td>
  <td class=xl31703772></td>
  <td class=xl31703772></td>
  <td class=xl31703772></td>
  <td class=xl31703772></td>
  <td class=xl31703772></td>
 </tr>
 <tr height=25 style='mso-height-source:userset;height:18.75pt'>
  <td height=25 class=xl32033772 colspan=11 style='height:18.75pt'>S&#7889;
  ch&#7913;ng t&#7915; g&#7889;c kèm theo<font class="font63772">/ Original
  document att'd:</font><font class="font83772">…...............................................................................................................................................</font></td>
 </tr>
 <tr class=xl31993772 height=26 style='mso-height-source:userset;height:19.5pt'>
  <td colspan=3 height=26 class=xl32143772 style='height:19.5pt'>Bên Giao hàng/<font
  class="font153772"> Delivery Party</font></td>
  <td class=xl32133772 width=63 style='width:47pt'></td>
  <td class=xl32143772></td>
  <td class=xl32133772 width=51 style='width:38pt'></td>
  <td class=xl32143772></td>
  <td class=xl32143772></td>
  <td class=xl32143772></td>
  <td colspan=2 class=xl32143772>Bên nh&#7853;n hàng/<font class="font153772">
  Receiver</font></td>
 </tr>
 <tr class=xl31983772 height=20 style='mso-height-source:userset;height:15.0pt'>
  <td colspan=3 height=20 class=xl32153772 style='height:15.0pt'>(Ký, h&#7885;
  tên)</td>
  <td class=xl32153772></td>
  <td class=xl32153772></td>
  <td class=xl32153772></td>
  <td class=xl32153772></td>
  <td class=xl32153772></td>
  <td class=xl32153772></td>
  <td colspan=2 class=xl32153772>(Ký, h&#7885; tên)</td>
 </tr>
 <![if supportMisalignedColumns]>
 <tr height=0 style='display:none'>
  <td width=44 style='width:33pt'></td>
  <td width=89 style='width:67pt'></td>
  <td width=243 style='width:182pt'></td>
  <td width=63 style='width:47pt'></td>
  <td width=58 style='width:44pt'></td>
  <td width=51 style='width:38pt'></td>
  <td width=51 style='width:38pt'></td>
  <td width=51 style='width:38pt'></td>
  <td width=51 style='width:38pt'></td>
  <td width=122 style='width:92pt'></td>
  <td width=221 style='width:166pt'></td>
 </tr>
 <![endif]>
</table>

</div>


<!----------------------------->
<!--END OF OUTPUT FROM EXCEL PUBLISH AS WEB PAGE WIZARD-->
<!----------------------------->
</body>

</html>
