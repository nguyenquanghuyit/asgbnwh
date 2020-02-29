<html xmlns:v="urn:schemas-microsoft-com:vml"
xmlns:o="urn:schemas-microsoft-com:office:office"
xmlns:x="urn:schemas-microsoft-com:office:excel"
xmlns="http://www.w3.org/TR/REC-html40">
<?php
include_once "mycnn.php";

$id=$_REQUEST["id"];
$str="SELECT a.TruckNo,a.DriverName,DATE_FORMAT(a.CreateDate,'%d/%m/%Y') as DateOut FROM vwrouteout a WHERE a.ID_Route=".$id;
$rs=mysqli_query($cnn,$str);

$DateIn="";
$TruckNo="";
$DriverName="";

if(mysqli_num_rows($rs)>0)
{
	$row=mysqli_fetch_assoc($rs);
	$DateOut=$row["DateOut"];
	$TruckNo=$row["TruckNo"];
	$DriverName=$row["DriverName"];
}
header("Content-Type:   application/vnd.ms-excel; charset=utf-8");
header("Content-Disposition: attachment; filename=INBOUND_".date('d/m/Y').".xls");
?>
<head>
<meta http-equiv=Content-Type content="text/html; charset=utf-8">
<meta name=ProgId content=Excel.Sheet>
<meta name=Generator content="Microsoft Excel 15">
<link rel=File-List href="rpt_Outbound_files/filelist.xml">
<!--[if !mso]>
<style>
v\:* {behavior:url(#default#VML);}
o\:* {behavior:url(#default#VML);}
x\:* {behavior:url(#default#VML);}
.shape {behavior:url(#default#VML);}
</style>
<![endif]-->
<style id="OUTBOUND_14562_Styles">
<!--table
	{mso-displayed-decimal-separator:"\.";
	mso-displayed-thousand-separator:"\,";}
.font514562
	{color:windowtext;
	font-size:11.0pt;
	font-weight:700;
	font-style:normal;
	text-decoration:none;
	font-family:"Times New Roman", serif;
	mso-font-charset:0;}
.font614562
	{color:windowtext;
	font-size:11.0pt;
	font-weight:400;
	font-style:italic;
	text-decoration:none;
	font-family:"Times New Roman", serif;
	mso-font-charset:0;}
.font714562
	{color:windowtext;
	font-size:12.0pt;
	font-weight:400;
	font-style:normal;
	text-decoration:none;
	font-family:"Times New Roman", serif;
	mso-font-charset:0;}
.font814562
	{color:windowtext;
	font-size:11.0pt;
	font-weight:400;
	font-style:normal;
	text-decoration:none;
	font-family:"Times New Roman", serif;
	mso-font-charset:0;}
.font914562
	{color:windowtext;
	font-size:10.0pt;
	font-weight:400;
	font-style:normal;
	text-decoration:none;
	font-family:"Times New Roman", serif;
	mso-font-charset:0;}
.font1014562
	{color:windowtext;
	font-size:18.0pt;
	font-weight:700;
	font-style:normal;
	text-decoration:none;
	font-family:"Times New Roman", serif;
	mso-font-charset:0;}
.font1114562
	{color:windowtext;
	font-size:12.0pt;
	font-weight:700;
	font-style:normal;
	text-decoration:none;
	font-family:"Times New Roman", serif;
	mso-font-charset:0;}
.font1214562
	{color:black;
	font-size:11.0pt;
	font-weight:400;
	font-style:normal;
	text-decoration:none;
	font-family:"Times New Roman", serif;
	mso-font-charset:0;}
.font1314562
	{color:windowtext;
	font-size:12.0pt;
	font-weight:400;
	font-style:italic;
	text-decoration:none;
	font-family:"Times New Roman", serif;
	mso-font-charset:0;}
.font1414562
	{color:black;
	font-size:11.0pt;
	font-weight:400;
	font-style:italic;
	text-decoration:none;
	font-family:"Times New Roman", serif;
	mso-font-charset:0;}
.font1514562
	{color:#002060;
	font-size:11.0pt;
	font-weight:700;
	font-style:italic;
	text-decoration:none;
	font-family:"Times New Roman", serif;
	mso-font-charset:0;}
.font1614562
	{color:windowtext;
	font-size:11.0pt;
	font-weight:700;
	font-style:italic;
	text-decoration:none;
	font-family:"Times New Roman", serif;
	mso-font-charset:0;}
.font1714562
	{color:windowtext;
	font-size:10.0pt;
	font-weight:700;
	font-style:italic;
	text-decoration:none;
	font-family:"Times New Roman", serif;
	mso-font-charset:0;}
.xl316914562
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
.xl317014562
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
.xl317114562
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
.xl317214562
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
.xl317314562
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
.xl317414562
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
.xl317514562
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
.xl317614562
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
.xl317714562
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
.xl317814562
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
.xl317914562
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
.xl318014562
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
.xl318114562
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
.xl318214562
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
.xl318314562
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
.xl318414562
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
.xl318514562
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
	white-space:normal;}
.xl318614562
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
.xl318714562
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
	border:.5pt solid windowtext;
	mso-background-source:auto;
	mso-pattern:auto;
	white-space:nowrap;}
.xl318814562
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
.xl318914562
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
.xl319014562
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
.xl319114562
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
.xl319214562
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
.xl319314562
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
.xl319414562
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
.xl319514562
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
.xl319614562
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
.xl319714562
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
.xl319814562
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
.xl319914562
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
.xl320014562
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
	white-space:normal;}
.xl320114562
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
.xl320214562
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
.xl320314562
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
.xl320414562
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
.xl320514562
	{padding:0px;
	mso-ignore:padding;
	color:windowtext;
	font-size:11.0pt;
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
	white-space:nowrap;}
.xl320614562
	{padding:0px;
	mso-ignore:padding;
	color:windowtext;
	font-size:11.0pt;
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
.xl320714562
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
.xl320814562
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
	vertical-align:middle;
	mso-background-source:auto;
	mso-pattern:auto;
	white-space:nowrap;}
.xl320914562
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
.xl321014562
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
.xl321114562
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
.xl321214562
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
.xl321314562
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
.xl321414562
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
.xl321514562
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
.xl321614562
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
	white-space:normal;}
.xl321714562
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
	vertical-align:middle;
	mso-background-source:auto;
	mso-pattern:auto;
	white-space:normal;}
.xl321814562
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
	white-space:normal;}
.xl321914562
	{padding:0px;
	mso-ignore:padding;
	color:windowtext;
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
.xl322014562
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
	white-space:nowrap;}
.xl322114562
	{padding:0px;
	mso-ignore:padding;
	color:windowtext;
	font-size:11.0pt;
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
.xl322214562
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
	border-top:none;
	border-right:.5pt solid windowtext;
	border-bottom:.5pt solid windowtext;
	border-left:.5pt solid windowtext;
	mso-background-source:auto;
	mso-pattern:auto;
	white-space:normal;}
.xl322314562
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
	border-top:none;
	border-right:.5pt solid windowtext;
	border-bottom:.5pt solid windowtext;
	border-left:.5pt solid windowtext;
	mso-background-source:auto;
	mso-pattern:auto;
	white-space:nowrap;}
.xl322414562
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
	border-top:none;
	border-right:.5pt solid windowtext;
	border-bottom:.5pt solid windowtext;
	border-left:.5pt solid windowtext;
	mso-background-source:auto;
	mso-pattern:auto;
	white-space:nowrap;}
.xl322514562
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
	border-right:none;
	border-bottom:.5pt solid windowtext;
	border-left:.5pt solid windowtext;
	mso-background-source:auto;
	mso-pattern:auto;
	white-space:normal;}
.xl322614562
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
	border-bottom:.5pt solid windowtext;
	border-left:none;
	mso-background-source:auto;
	mso-pattern:auto;
	white-space:normal;}
.xl322714562
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
.xl322814562
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
.xl322914562
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
.xl323014562
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
.xl323114562
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
.xl323214562
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
.xl323314562
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

<div id="OUTBOUND_14562" align=center x:publishsource="Excel">

<table border=0 cellpadding=0 cellspacing=0 width=891 class=xl317014562
 style='border-collapse:collapse;table-layout:fixed;width:669pt'>
 <col class=xl317014562 width=44 style='mso-width-source:userset;mso-width-alt:
 1609;width:33pt'>
 <col class=xl317014562 width=90 style='mso-width-source:userset;mso-width-alt:
 3291;width:68pt'>
 <col class=xl317014562 width=89 style='mso-width-source:userset;mso-width-alt:
 3254;width:67pt'>
 <col class=xl317014562 width=184 style='mso-width-source:userset;mso-width-alt:
 6729;width:138pt'>
 <col class=xl318614562 width=63 style='mso-width-source:userset;mso-width-alt:
 2304;width:47pt'>
 <col class=xl317114562 width=50 style='mso-width-source:userset;mso-width-alt:
 1828;width:38pt'>
 <col class=xl317214562 width=51 style='mso-width-source:userset;mso-width-alt:
 1865;width:38pt'>
 <col class=xl317014562 width=51 span=2 style='mso-width-source:userset;
 mso-width-alt:1865;width:38pt'>
 <col class=xl317014562 width=61 style='mso-width-source:userset;mso-width-alt:
 2230;width:46pt'>
 <col class=xl317014562 width=157 style='mso-width-source:userset;mso-width-alt:
 5741;width:118pt'>
 <tr class=xl319214562 height=93 style='mso-height-source:userset;height:70.15pt'>
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
  </v:shapetype><v:shape id="Picture_x0020_5" o:spid="_x0000_s2050" type="#_x0000_t75"
   style='position:absolute;margin-left:0;margin-top:9pt;width:81.75pt;
   height:57.75pt;z-index:2;visibility:visible' o:gfxdata="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
">
   <v:imagedata src="http://125.212.128.54/asgbn_wh/images/icon.png" o:title=""/>
   <x:ClientData ObjectType="Pict">
    <x:SizeWithCells/>
    <x:CF>Bitmap</x:CF>
    <x:AutoPict/>
   </x:ClientData>
  </v:shape><v:shape id="Rectangle_x0020_4" o:spid="_x0000_s2049" type="#_x0000_t75"
   style='position:absolute;margin-left:0;margin-top:69pt;width:132pt;height:2.25pt;
   z-index:1;visibility:visible;mso-wrap-style:square;v-text-anchor:top'
   o:gfxdata="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
" o:insetmode="auto">
   <v:imagedata src="" o:title=""/>
   <o:lock v:ext="edit" aspectratio="f"/>
   <x:ClientData ObjectType="Pict">
    <x:SizeWithCells/>
    <x:CF>Bitmap</x:CF>
    <x:AutoPict/>
   </x:ClientData>
  </v:shape><v:group id="Group_x0020_6" o:spid="_x0000_s2051" style='position:absolute;
   margin-left:0;margin-top:71.25pt;width:669.75pt;height:9pt;z-index:3'
   coordorigin=",6207" coordsize="69472,984">
   <o:lock v:ext="edit" text="t"/>
   <v:shape id="Rectangle_x0020_7" o:spid="_x0000_s2052" type="#_x0000_t75"
    style='position:absolute;left:4777;top:6091;width:64798;height:1238;
    visibility:visible;mso-wrap-style:square;v-text-anchor:top' o:gfxdata="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
" o:insetmode="auto">
    <v:imagedata src="http://125.212.128.54/asgbn_wh/images/hor_bar.png" o:title=""/>
    <o:lock v:ext="edit" aspectratio="f"/>
    <x:ClientData ObjectType="Pict">
     <x:CF>Bitmap</x:CF>
     <x:AutoPict/>
    </x:ClientData>
   </v:shape><v:shape id="Rectangle_x0020_8" o:spid="_x0000_s2053" type="#_x0000_t75"
    style='position:absolute;left:-99;top:6091;width:8111;height:1125;
    visibility:visible;mso-wrap-style:square;v-text-anchor:top' o:gfxdata="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
" o:insetmode="auto">
    <v:imagedata src="http://125.212.128.54/asgbn_wh/images/hor_bar.png" o:title=""/>
    <o:lock v:ext="edit" aspectratio="f"/>
    <x:ClientData ObjectType="Pict">
     <x:CF>Bitmap</x:CF>
     <x:AutoPict/>
    </x:ClientData>
   </v:shape></v:group><![endif]--><![if !vml]><span style='mso-ignore:vglayout;
  position:absolute;z-index:2;margin-left:-1px;margin-top:12px;width:895px;
  height:97px'>
  <table cellpadding=0 cellspacing=0>
   <tr>
    <td width=0 height=0></td>
    <td width=1></td>
    <td width=109></td>
    <td width=785></td>
   </tr>
   <tr>
    <td height=77></td>
    <td></td>
    <td align=left valign=top></td>
   </tr>
   <tr>
    <td height=3></td>
   </tr>
   <tr>
    <td height=17></td>
    <td colspan=3 align=left valign=top></td>
   </tr>
  </table>
  </span><![endif]><span style='mso-ignore:vglayout2'>
  <table cellpadding=0 cellspacing=0>
   <tr>
    <td height=93 class=xl318414562 width=44 style='height:70.15pt;width:33pt'></td>
   </tr>
  </table>
  </span></td>
  <td class=xl318414562 width=90 style='width:68pt'></td>
  <td colspan=9 class=xl322814562 width=757 style='width:568pt'><font
  class="font1014562">YAMATO LOGISTICS VIETNAM CO., LTD.</font><font
  class="font514562"><br>
    </font><font class="font914562">14th Floor, Handico Tower, Pham Hung
  Street, Me Tri Ward,<span style='mso-spacerun:yes'>  </span>Nam Tu Liem
  District,<br>
    <span style='mso-spacerun:yes'> </span>Ha Noi City, Vietnam. <br>
    Tel No. 84-24-3772 7015 / Fax No. : 84-24-3772 7016</font></td>
 </tr>
 <tr height=22 style='mso-height-source:userset;height:16.5pt'>
  <td height=22 class=xl318414562 style='height:16.5pt'></td>
  <td class=xl318014562></td>
  <td class=xl318414562></td>
  <td class=xl319614562 width=184 style='width:138pt'></td>
  <td class=xl319614562 width=63 style='width:47pt'></td>
  <td class=xl319614562 width=50 style='width:38pt'></td>
  <td class=xl319014562></td>
  <td class=xl318014562></td>
  <td class=xl318014562></td>
  <td class=xl318014562></td>
  <td class=xl318014562></td>
 </tr>
 <tr height=22 style='mso-height-source:userset;height:16.5pt'>
  <td height=22 class=xl319314562 colspan=2 style='height:16.5pt'>B&#7897;
  ph&#7853;n: Kho th&#432;&#7901;ng</td>
  <td class=xl318414562></td>
  <td class=xl319614562 width=184 style='width:138pt'></td>
  <td class=xl319614562 width=63 style='width:47pt'></td>
  <td class=xl319614562 width=50 style='width:38pt'></td>
  <td class=xl319014562></td>
  <td class=xl318014562></td>
  <td class=xl318014562></td>
  <td class=xl318014562></td>
  <td class=xl318014562></td>
 </tr>
 <tr height=22 style='mso-height-source:userset;height:16.5pt'>
  <td height=22 class=xl319214562 colspan=3 style='height:16.5pt'>Section:
  Normal warehouse</td>
  <td class=xl319614562 width=184 style='width:138pt'></td>
  <td class=xl319614562 width=63 style='width:47pt'></td>
  <td class=xl319614562 width=50 style='width:38pt'></td>
  <td class=xl319114562></td>
  <td class=xl318814562></td>
  <td class=xl318814562></td>
  <td class=xl318814562></td>
  <td class=xl318814562></td>
 </tr>
 <tr height=56 style='mso-height-source:userset;height:42.6pt'>
  <td colspan=11 height=56 class=xl322714562 width=891 style='height:42.6pt;
  width:669pt'>PHI&#7870;U XU&#7844;T KHO VÀ GIAO HÀNG<br>
    OUTBOUND W/H TALLY SHEET &amp; PROOF OF DELIVERY</td>
 </tr>
 <tr class=xl317114562 height=9 style='mso-height-source:userset;height:6.75pt'>
  <td height=9 class=xl317614562 style='height:6.75pt'></td>
  <td class=xl319714562></td>
  <td class=xl317614562></td>
  <td class=xl319914562 width=184 style='width:138pt'></td>
  <td class=xl318414562></td>
  <td class=xl318414562></td>
  <td class=xl318414562></td>
  <td class=xl319714562></td>
  <td class=xl319714562></td>
  <td class=xl319714562></td>
  <td class=xl319714562></td>
 </tr>
 <tr class=xl317114562 height=20 style='mso-height-source:userset;height:15.0pt'>
  <td height=20 class=xl317714562 colspan=3 style='height:15.0pt'><font
  class="font714562">Ngày/</font><font class="font1314562"> Dated: <?php echo $DateOut;?></font><span
  style='display:none'><font class="font914562">..............................................................</font></span></td>
  <td class=xl317114562 colspan=8>S&#7889; phi&#7871;u/ <font
  class="font1414562">Order No: <?php echo $id?>......................................................................................................</font></td>
 </tr>
 <tr class=xl317114562 height=24 style='mso-height-source:userset;height:18.0pt'>
  <td height=24 class=xl320114562 colspan=9 style='height:18.0pt'>Xu&#7845;t
  t&#7841;i kho<font class="font1314562">/ Warehouse add: </font><font
  class="font714562"><span style='mso-spacerun:yes'> </span>Lot CN1-2, Yen
  Phong Industrial Zone, Dong Phong, Yen Phong, Bac Ninh</font></td>
  <td class=xl319814562></td>
  <td class=xl319814562></td>
 </tr>
 <tr class=xl317114562 height=24 style='mso-height-source:userset;height:18.0pt'>
  <td height=24 class=xl317714562 colspan=4 style='height:18.0pt'><font
  class="font714562">Ng&#432;&#7901;i nh&#7853;n hàng/ </font><font
  class="font1314562">Received cargo party: </font><font class="font1114562">Saigon
  Post</font></td>
  <td class=xl318814562></td>
  <td class=xl318814562></td>
  <td class=xl318814562></td>
  <td class=xl319814562></td>
  <td class=xl319814562></td>
  <td class=xl317714562></td>
  <td class=xl319814562></td>
 </tr>
 <tr class=xl317114562 height=24 style='mso-height-source:userset;height:18.0pt'>
  <td height=24 class=xl317614562 colspan=4 style='height:18.0pt'>Tên b&#432;u
  tá: / <font class="font1314562">PIC Name</font><font class="font714562">: </font><font
  class="font1314562">…</font><font class="font614562">...........................................................</font><span
  style='display:none'><font class="font614562">............................</font><font
  class="font1314562"><span style='mso-spacerun:yes'> </span></font></span></td>
  <td class=xl317114562 colspan=7>S&#7889; xe / <font class="font1414562">Truck
  No.:<?php echo $TruckNo?></font></td>
 </tr>
 <tr class=xl317114562 height=24 style='mso-height-source:userset;height:18.0pt'>
  <td height=24 class=xl317714562 colspan=3 style='height:18.0pt'><font
  class="font714562">Th&#7901;i gian b&#7855;t &#273;&#7847;u/ </font><font
  class="font1314562">Start time: …...</font><span style='display:none'><font
  class="font1314562">.................................</font></span></td>
  <td class=xl318814562 colspan=3>Th&#7901;i gian k&#7871;t thúc/ <font
  class="font1414562">End time: …</font><font class="font1214562">...........................</font><span
  style='display:none'><font class="font1214562">.</font></span></td>
  <td class=xl317114562 colspan=5>Ngoài gi&#7901;/ <font class="font1414562">Overtime</font><font
  class="font1214562">: …............................</font></td>
 </tr>
 <tr class=xl317114562 height=24 style='mso-height-source:userset;height:18.0pt'>
  <td height=24 class=xl317614562 style='height:18.0pt'></td>
  <td class=xl317714562></td>
  <td class=xl317714562></td>
  <td class=xl318414562></td>
  <td class=xl317114562></td>
  <td class=xl318814562></td>
  <td class=xl318814562></td>
  <td class=xl319814562></td>
  <td class=xl319814562></td>
  <td class=xl317714562></td>
  <td class=xl319814562></td>
 </tr>
 <tr class=xl317114562 height=10 style='mso-height-source:userset;height:7.9pt'>
  <td height=10 class=xl317814562 style='height:7.9pt'></td>
  <td class=xl317114562></td>
  <td class=xl317814562></td>
  <td class=xl317514562></td>
  <td class=xl318614562></td>
  <td class=xl317114562></td>
  <td class=xl317414562></td>
  <td class=xl317114562></td>
  <td class=xl317114562></td>
  <td class=xl317114562></td>
  <td class=xl317114562></td>
 </tr>
 <tr class=xl316914562 height=47 style='mso-height-source:userset;height:35.25pt'>
  <td rowspan=2 height=85 class=xl323114562 width=44 style='border-bottom:.5pt solid black;
  height:63.75pt;width:33pt'>S&#7889;/ <br>
    No.</td>
  <td rowspan=2 class=xl320314562 width=90 style='width:68pt'>&#272;&#417;n
  hàng S&#7889;./<br>
    Order No.</td>
  <td rowspan=2 class=xl323114562 width=89 style='border-bottom:.5pt solid black;
  width:67pt'>Mã ph&#7909; tùng<font class="font1514562">/ <br>
    Code</font></td>
  <td rowspan=2 class=xl322914562 width=184 style='border-bottom:.5pt solid black;
  width:138pt'>Tên Ph&#7909; Tùng<font class="font1514562">/<br>
    Item description</font></td>
  <td rowspan=2 class=xl320314562 width=63 style='width:47pt'>S&#7889;
  l&#432;&#7907;ng<font class="font1514562">/ <br>
    Quantity</font></td>
  <td rowspan=2 class=xl320314562 width=50 style='width:38pt'>&#272;óng
  gói/<br>
    Pack</td>
  <td colspan=2 class=xl320314562 width=102 style='border-left:none;width:76pt'>B&#7889;c
  x&#7871;p/ Loading</td>
  <td colspan=2 class=xl322514562 width=112 style='border-right:.5pt solid black;
  border-left:none;width:84pt'>Qu&#7845;n màng PE/<br>
    Vinyl packing</td>
  <td rowspan=2 class=xl323114562 width=157 style='border-bottom:.5pt solid black;
  width:118pt'>Ghi chú/ Remark<br>
    ( DIM of pallet, use pallet..)</td>
 </tr>
 <tr class=xl316914562 height=38 style='height:28.5pt'>
  <td class=xl320314562 width=51 style='border-top:none;border-left:none;
  width:38pt'>Carton</td>
  <td class=xl320314562 width=51 style='border-top:none;border-left:none;
  width:38pt'>Pallet</td>
  <td class=xl320314562 width=51 style='border-top:none;border-left:none;
  width:38pt'>Carton</td>
  <td class=xl320314562 width=61 style='border-top:none;border-left:none;
  width:46pt'>Pallet</td>
 </tr>
 <?php
	$strCode="SELECT v2.Code,v2.PCS,tp.ProductName,v2.ID_Order FROM vworderout v2 ";
	$strCode=$strCode." INNER JOIN tbl_product tp ON tp.Code=v2.Code WHERE v2.ID_Route=".$id;

	$dtCode=mysqli_query($cnn,$strCode);
	$stt=0;
	$totalPCS=0;
	$oldId="";
	while($rowCode=mysqli_fetch_assoc($dtCode))
	{		
		if($rowCode["ID_Order"]==$oldId)
		{
			$ID_Order="";
		}
		else
		{
			$ID_Order=$rowCode["ID_Order"];
		}
		$Code=$rowCode["Code"];
		$PCS=$rowCode["PCS"];
		$ProductName=$rowCode["ProductName"];
		
	 	$stt+=1;
	 	$totalPCS+=$rowCode["PCS"];
		$oldId=$rowCode["ID_Order"];
 ?>
 <tr class=xl317014562 height=26 style='mso-height-source:userset;height:20.1pt'>
  <td height=26 class=xl322214562 width=44 style='height:20.1pt;width:33pt'><?php echo $stt;?></td>
  <td class=xl321114562 style='border-top:none;border-left:none'><div align="center"><?php echo $ID_Order;?></div></td>
  <td class=xl320914562 width=89 style='border-top:none;border-left:none;
  width:67pt;padding-left:3px'><?php echo $Code;?></td>
  <td class=xl320914562 width=184 style='border-top:none;border-left:none;
  width:138pt;padding-left:3px'><?php echo $ProductName;?></td>
  <td class=xl321014562 style='border-top:none;border-left:none'><?php echo $PCS ?></td>
  <td class=xl322314562 style='border-left:none'>&nbsp;</td>
  <td class=xl317314562 width=51 style='border-top:none;border-left:none;
  width:38pt'>&nbsp;</td>
  <td class=xl321314562 style='border-top:none;border-left:none'>&nbsp;</td>
  <td class=xl321314562 style='border-top:none;border-left:none'>&nbsp;</td>
  <td class=xl321114562 style='border-top:none;border-left:none'>&nbsp;</td>
  <td class=xl322414562 style='border-left:none'>&nbsp;</td>
 </tr>
  <?php
	}
 ?>
 <tr height=32 style='mso-height-source:userset;height:24.6pt'>
  <td height=32 class=xl317914562 width=44 style='height:24.6pt;border-top:
  none;width:33pt'>T&#7893;ng/ Total</td>
  <td class=xl318714562 style='border-top:none;border-left:none'>&nbsp;</td>
  <td class=xl320914562 width=89 style='border-top:none;border-left:none;
  width:67pt'>&nbsp;</td>
  <td class=xl320914562 width=184 style='border-top:none;border-left:none;
  width:138pt'>&nbsp;</td>
  <td class=xl321214562 style='border-top:none;border-left:none'><?php echo $totalPCS;?></td>
  <td class=xl321214562 style='border-top:none;border-left:none'>&nbsp;</td>
  <td class=xl321414562 style='border-top:none;border-left:none'>&nbsp;</td>
  <td class=xl321314562 style='border-top:none;border-left:none'>&nbsp;</td>
  <td class=xl321314562 style='border-top:none;border-left:none'>&nbsp;</td>
  <td class=xl321114562 style='border-top:none;border-left:none'>&nbsp;</td>
  <td class=xl321314562 style='border-top:none;border-left:none'>&nbsp;</td>
 </tr>

 <tr height=16 style='mso-height-source:userset;height:12.0pt'>
  <td height=16 class=xl318114562 width=44 style='height:12.0pt;width:33pt'></td>
  <td class=xl317014562></td>
  <td class=xl318214562 width=89 style='width:67pt'></td>
  <td class=xl318214562 width=184 style='width:138pt'></td>
  <td class=xl318914562></td>
  <td class=xl318914562></td>
  <td class=xl318414562></td>
  <td class=xl317014562></td>
  <td class=xl317014562></td>
  <td class=xl317014562></td>
  <td class=xl317014562></td>
 </tr>
 <tr height=25 style='mso-height-source:userset;height:18.75pt'>
  <td height=25 class=xl320414562 colspan=4 style='height:18.75pt'>Tình
  tr&#7841;ng hàng hóa<font class="font614562">/ Cargo status: </font><font
  class="font814562">T&#7889;t/</font><font class="font614562"> in good
  condition</font></td>
  <td class=xl318914562></td>
  <td class=xl318914562></td>
  <td class=xl318414562></td>
  <td class=xl317014562></td>
  <td class=xl317014562></td>
  <td class=xl318814562></td>
  <td class=xl317014562></td>
 </tr>
 <tr height=25 style='mso-height-source:userset;height:18.75pt'>
  <td height=25 class=xl320414562 colspan=11 style='height:18.75pt'>S&#7889;
  ch&#7913;ng t&#7915; g&#7889;c kèm theo<font class="font614562">/ Original
  document att'd: <?php
  $strInv="SELECT IFNULL(x1.InvoiceNo,'') AS 'InvoiceNo' FROM tbl_order x1 INNER JOIN tbl_loading x2 ON x1.ID_Order=x2.ID_Order WHERE x2.ID_Route=".$id;
  $rs=mysqli_query($cnn,$strInv);
  $kqIn="";
  while ($rowInv=mysqli_fetch_assoc($rs))
  {
	  if($rowInv["InvoiceNo"]!=""){   
	  	$kqIn.=$rowInv["InvoiceNo"]."; "; 
	  }
  }
  if($kqIn!=""){
  	echo "<b>Hóa đơn đỏ số ".$kqIn."</b>";
  }
  ?></td>
 </tr>
 <tr height=25 style='mso-height-source:userset;height:18.75pt'>
  <td height=25 class=xl320814562 colspan=3 style='height:18.75pt'>&#272;i&#7875;m
  xu&#7845;t phát/ <font class="font1614562">Point of departur</font><span
  style='display:none'><font class="font1614562">e</font></span></td>
  <td class=xl318514562 width=184 style='width:138pt'>…………………</td>
  <td class=xl320814562 colspan=3>&#272;i&#7875;m &#273;&#7871;n<font
  class="font1614562">/ Destination</font></td>
  <td class=xl317014562></td>
  <td class=xl317014562></td>
  <td class=xl321714562 width=61 style='width:46pt'></td>
  <td class=xl318514562 width=157 style='width:118pt'>…………………</td>
 </tr>
 <tr class=xl317114562 height=25 style='mso-height-source:userset;height:18.75pt'>
  <td height=25 class=xl322014562 colspan=3 style='height:18.75pt'>Gi&#7901;
  xu&#7845;t phát/<font class="font614562"> Departure time</font></td>
  <td class=xl318514562 width=184 style='width:138pt'>…………………</td>
  <td class=xl318414562 colspan=3>Gi&#7901; &#273;&#7871;n/<font
  class="font614562"> Arrival time</font></td>
  <td class=xl317014562></td>
  <td class=xl317014562></td>
  <td class=xl320714562 width=61 style='width:46pt'></td>
  <td class=xl318514562 width=157 style='width:118pt'>…………………</td>
 </tr>
 <tr class=xl317114562 height=25 style='mso-height-source:userset;height:18.75pt'>
  <td height=25 class=xl317014562 colspan=3 style='height:18.75pt'>Gi&#7901;
  b&#7855;t &#273;&#7847;u d&#7905; hàng/<font class="font1414562"> Time begin
  unlo</font><span style='display:none'><font class="font1414562">ading</font></span></td>
  <td class=xl318514562 width=184 style='width:138pt'>…………………</td>
  <td class=xl317014562 colspan=6>Gi&#7901; k&#7871;t thúc d&#7905; hàng/<font
  class="font1414562">Time finish unloading</font></td>
  <td class=xl318514562 width=157 style='width:118pt'>…………………</td>
 </tr>
 <tr height=12 style='mso-height-source:userset;height:9.0pt'>
  <td height=12 class=xl317014562 style='height:9.0pt'></td>
  <td class=xl317014562></td>
  <td class=xl317014562></td>
  <td class=xl317014562></td>
  <td class=xl318614562></td>
  <td class=xl317114562></td>
  <td class=xl317214562></td>
  <td class=xl317014562></td>
  <td class=xl317014562></td>
  <td class=xl317014562></td>
  <td class=xl317014562></td>
 </tr>
 <tr class=xl319514562 height=36 style='mso-height-source:userset;height:27.6pt'>
  <td colspan=2 height=36 class=xl320014562 width=134 style='height:27.6pt;
  width:101pt'>Th&#7911; kho<font class="font1714562">/ <br>
    WH keeper</font></td>
  <td class=xl319514562></td>
  <td class=xl321514562 width=184 style='width:138pt'>Ng&#432;&#7901;i
  xu&#7845;t hàng<font class="font1714562">/ <br>
    Release cargo PIC</font></td>
  <td class=xl321814562 width=63 style='width:47pt'></td>
  <td class=xl320014562 width=50 style='width:38pt'>B&#7843;o v&#7879;/<font
  class="font1714562"> <br>
    Security</font></td>
  <td class=xl321814562 width=51 style='width:38pt'></td>
  <td colspan=3 class=xl320014562 width=163 style='width:122pt'>Lái xe<font
  class="font1714562">/ <br>
    Driver</font></td>
  <td class=xl320014562 width=157 style='width:118pt'>Bên nh&#7853;n hàng/<font
  class="font1714562"> <br>
    Receiver</font></td>
 </tr>
 <tr class=xl319414562 height=20 style='height:15.0pt'>
  <td colspan=2 height=20 class=xl320614562 style='height:15.0pt'>(Ký, h&#7885;
  tên)</td>
  <td class=xl319414562></td>
  <td class=xl322114562>(Ký, h&#7885; tên)</td>
  <td class=xl321914562></td>
  <td class=xl320614562>(Ký, h&#7885; tên)</td>
  <td class=xl319414562></td>
  <td class=xl320614562></td>
  <td class=xl320614562>(Ký, h&#7885; tên)</td>
  <td class=xl319414562></td>
  <td class=xl320614562>(Ký, h&#7885; tên)</td>
 </tr>
 <![if supportMisalignedColumns]>
 <tr height=0 style='display:none'>
  <td width=44 style='width:33pt'></td>
  <td width=90 style='width:68pt'></td>
  <td width=89 style='width:67pt'></td>
  <td width=184 style='width:138pt'></td>
  <td width=63 style='width:47pt'></td>
  <td width=50 style='width:38pt'></td>
  <td width=51 style='width:38pt'></td>
  <td width=51 style='width:38pt'></td>
  <td width=51 style='width:38pt'></td>
  <td width=61 style='width:46pt'></td>
  <td width=157 style='width:118pt'></td>
 </tr>
 <![endif]>
</table>

</div>


<!----------------------------->
<!--END OF OUTPUT FROM EXCEL PUBLISH AS WEB PAGE WIZARD-->
<!----------------------------->
</body>

</html>
