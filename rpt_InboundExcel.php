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
header("Content-Type:   application/vnd.ms-excel; charset=utf-8");
header("Content-Disposition: attachment; filename=INBOUND_".date('d/m/Y').".xls");
?>
<head>
<meta http-equiv=Content-Type content="text/html; charset=utf-8">
<meta name=ProgId content=Excel.Sheet>
<meta name=Generator content="Microsoft Excel 15">
<link rel=File-List href="rpt_Inbound_files/filelist.xml">
<!--[if !mso]>
<style>
v\:* {behavior:url(#default#VML);}
o\:* {behavior:url(#default#VML);}
x\:* {behavior:url(#default#VML);}
.shape {behavior:url(#default#VML);}
</style>
<![endif]-->
<style id="rpt_Inbound_23919_Styles">
<!--table
	{mso-displayed-decimal-separator:"\.";
	mso-displayed-thousand-separator:"\,";}
.font523919
	{color:windowtext;
	font-size:11.0pt;
	font-weight:700;
	font-style:normal;
	text-decoration:none;
	font-family:"Times New Roman", serif;
	mso-font-charset:0;}
.font623919
	{color:windowtext;
	font-size:12.0pt;
	font-weight:400;
	font-style:normal;
	text-decoration:none;
	font-family:"Times New Roman", serif;
	mso-font-charset:0;}
.font723919
	{color:windowtext;
	font-size:10.0pt;
	font-weight:400;
	font-style:normal;
	text-decoration:none;
	font-family:"Times New Roman", serif;
	mso-font-charset:0;}
.font823919
	{color:windowtext;
	font-size:18.0pt;
	font-weight:700;
	font-style:normal;
	text-decoration:none;
	font-family:"Times New Roman", serif;
	mso-font-charset:0;}
.font923919
	{color:windowtext;
	font-size:12.0pt;
	font-weight:400;
	font-style:italic;
	text-decoration:none;
	font-family:"Times New Roman", serif;
	mso-font-charset:0;}
.font1023919
	{color:windowtext;
	font-size:10.0pt;
	font-weight:400;
	font-style:italic;
	text-decoration:none;
	font-family:"Times New Roman", serif;
	mso-font-charset:0;}
.font1123919
	{color:#002060;
	font-size:11.0pt;
	font-weight:700;
	font-style:italic;
	text-decoration:none;
	font-family:"Times New Roman", serif;
	mso-font-charset:0;}
.font1223919
	{color:windowtext;
	font-size:12.0pt;
	font-weight:700;
	font-style:italic;
	text-decoration:none;
	font-family:"Times New Roman", serif;
	mso-font-charset:0;}
.xl318223919
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
.xl318323919
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
.xl318423919
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
.xl318523919
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
.xl318623919
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
.xl318723919
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
.xl318823919
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
.xl318923919
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
.xl319023919
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
.xl319123919
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
.xl319223919
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
.xl319323919
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
.xl319423919
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
.xl319523919
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
.xl319623919
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
.xl319723919
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
.xl319823919
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
.xl319923919
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
.xl320023919
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
.xl320123919
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
.xl320223919
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
	white-space:nowrap;}
.xl320323919
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
	border:.5pt solid windowtext;
	background:white;
	mso-pattern:black none;
	white-space:nowrap;}
.xl320423919
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
.xl320523919
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
	vertical-align:bottom;
	border:.5pt solid windowtext;
	mso-background-source:auto;
	mso-pattern:auto;
	white-space:nowrap;}
.xl320623919
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
	border:.5pt solid windowtext;
	mso-background-source:auto;
	mso-pattern:auto;
	white-space:nowrap;}
.xl320723919
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
.xl320823919
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
.xl320923919
	{padding:0px;
	mso-ignore:padding;
	color:windowtext;
	font-size:12.0pt;
	font-weight:400;
	font-style:normal;
	text-decoration:none;
	font-family:"Times New Roman", serif;
	mso-font-charset:0;
	mso-number-format:"\#\#\#\\-\#\#\#\#\#\#\#0_\)\;\\\(\#\,\#\#0\\\)";
	text-align:center;
	vertical-align:middle;
	border:.5pt solid windowtext;
	mso-background-source:auto;
	mso-pattern:auto;
	white-space:normal;}
.xl321023919
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
	white-space:normal;}
.xl321123919
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
.xl321223919
	{padding:0px;
	mso-ignore:padding;
	color:windowtext;
	font-size:12.0pt;
	font-weight:700;
	font-style:normal;
	text-decoration:none;
	font-family:"Times New Roman", serif;
	mso-font-charset:0;
	mso-number-format:General;
	text-align:center;
	vertical-align:bottom;
	border:.5pt solid windowtext;
	mso-background-source:auto;
	mso-pattern:auto;
	white-space:nowrap;}
.xl321323919
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
.xl321423919
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
	border:.5pt solid windowtext;
	mso-background-source:auto;
	mso-pattern:auto;
	white-space:nowrap;}
.xl321523919
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
.xl321623919
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
.xl321723919
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
.xl321823919
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
.xl321923919
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
.xl322023919
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
.xl322123919
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
.xl322223919
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
.xl322323919
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
.xl322423919
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
	white-space:normal;}
.xl322523919
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
	text-align:left;
	vertical-align:bottom;
	mso-background-source:auto;
	mso-pattern:auto;
	white-space:normal;}
.xl322623919
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
	white-space:nowrap;}
.xl322723919
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
.xl322823919
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
.xl322923919
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
.xl323023919
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
.xl323123919
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
.xl323223919
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
	border-bottom:none;
	border-left:.5pt solid windowtext;
	background:white;
	mso-pattern:black none;
	white-space:normal;}
.xl323323919
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
	border-bottom:none;
	border-left:none;
	background:white;
	mso-pattern:black none;
	white-space:normal;}
.xl323423919
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
	border-left:none;
	background:white;
	mso-pattern:black none;
	white-space:normal;}
.xl323523919
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
.xl323623919
	{padding:0px;
	mso-ignore:padding;
	color:windowtext;
	font-size:12.0pt;
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
.xl323723919
	{padding:0px;
	mso-ignore:padding;
	color:black;
	font-size:12.0pt;
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
.xl323823919
	{padding:0px;
	mso-ignore:padding;
	color:windowtext;
	font-size:12.0pt;
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
.xl323923919
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
.xl324023919
	{padding:0px;
	mso-ignore:padding;
	color:windowtext;
	font-size:12.0pt;
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
.xl324123919
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
	text-align:left;
	vertical-align:bottom;
	mso-background-source:auto;
	mso-pattern:auto;
	white-space:normal;}
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

<div id="rpt_Inbound_23919" align=center x:publishsource="Excel">

<table border=0 cellpadding=0 cellspacing=0 width=682 class=xl318323919
 style='border-collapse:collapse;table-layout:fixed;width:510pt'>
 <col class=xl318323919 width=48 style='mso-width-source:userset;mso-width-alt:
 1755;width:36pt'>
 <col class=xl318323919 width=95 style='mso-width-source:userset;mso-width-alt:
 3474;width:71pt'>
 <col class=xl318323919 width=231 style='mso-width-source:userset;mso-width-alt:
 8448;width:173pt'>
 <col class=xl319923919 width=55 style='mso-width-source:userset;mso-width-alt:
 2011;width:41pt'>
 <col class=xl319323919 width=55 style='mso-width-source:userset;mso-width-alt:
 2011;width:41pt'>
 <col class=xl322023919 width=55 style='mso-width-source:userset;mso-width-alt:
 2011;width:41pt'>
 <col class=xl318323919 width=143 style='mso-width-source:userset;mso-width-alt:
 5229;width:107pt'>
 <tr class=xl318423919 height=93 style='mso-height-source:userset;height:70.15pt'>
  <td height=93 width=682 style='height:70.15pt;width:36pt' align=left
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
  </v:shapetype><v:shape id="Picture_x0020_2" o:spid="_x0000_s2049" type="#_x0000_t75"
   style='position:absolute;margin-left:3pt;margin-top:3.75pt;width:81.75pt;
   height:58.5pt;z-index:1;visibility:visible' o:gfxdata="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
AABQNAAAAAA=
">
   <v:imagedata src="http://125.212.128.54/asgbn_wh/images/icon.png" o:title=""/>
   <x:ClientData ObjectType="Pict">
    <x:SizeWithCells/>
    <x:CF>Bitmap</x:CF>
    <x:AutoPict/>
   </x:ClientData>
  </v:shape><![endif]--><![if !vml]><span style='mso-ignore:vglayout;
  position:absolute;z-index:1;margin-left:4px;margin-top:5px;width:109px;
  height:78px'><img width=109 height=77
    src="images/icon.png" v:shapes="Picture_x0020_2"></span><![endif]><span
  style='mso-ignore:vglayout2'>
  <table cellpadding=0 cellspacing=0>
   <tr>
    <td height=93 class=xl318223919 width=48 style='height:70.15pt;width:36pt'><a
    name="RANGE!A1:G32"></a></td>
   </tr>
  </table>
  </span></td>
  <td colspan=6 class=xl322123919 width=682 style='width:474pt'><font
  class="font823919">YAMATO LOGISTICS VIETNAM CO., LTD.</font><font
  class="font523919"><br>
    </font><font class="font723919">14th Floor, Handico Tower, Pham Hung
  Street, Me Tri Ward,<span style='mso-spacerun:yes'>  </span>Nam Tu Liem
  District,<br>
    <span style='mso-spacerun:yes'> </span>Ha Noi City, Vietnam. <br>
    Tel No. 84-24-3772 7015 / Fax No. : 84-24-3772 7016</font></td>
 </tr>
 <tr height=22 style='mso-height-source:userset;height:16.5pt'>
  <td height=22 style='height:16.5pt' align=left valign=top><!--[if gte vml 1]><v:group
   id="Group_x0020_3" o:spid="_x0000_s2050" style='position:absolute;
   margin-left:.75pt;margin-top:2.25pt;width:513pt;height:8.25pt;z-index:2'
   coordorigin=",6207" coordsize="69472,984">
   <o:lock v:ext="edit" text="t"/>
   <v:shape id="Rectangle_x0020_4" o:spid="_x0000_s2051" type="#_x0000_t75"
    style='position:absolute;left:4705;top:6077;width:64901;height:1237;
    visibility:visible;mso-wrap-style:square;v-text-anchor:top' o:gfxdata="UEsDBBQABgAIAAAAIQDw94q7/QAAAOIBAAATAAAAW0NvbnRlbnRfVHlwZXNdLnhtbJSRzUrEMBDH
74LvEOYqbaoHEWm6B6tHFV0fYEimbdg2CZlYd9/edD8u4goeZ+b/8SOpV9tpFDNFtt4puC4rEOS0
N9b1Cj7WT8UdCE7oDI7ekYIdMayay4t6vQvEIrsdKxhSCvdSsh5oQi59IJcvnY8TpjzGXgbUG+xJ
3lTVrdTeJXKpSEsGNHVLHX6OSTxu8/pAEmlkEA8H4dKlAEMYrcaUSeXszI+W4thQZudew4MNfJUx
QP7asFzOFxx9L/lpojUkXjGmZ5wyhjSRJQ8YKGvKv1MWzIkL33VWU9lGfl98J6hz4cZ/uUjzf7Pb
bHuj+ZQu9z/UfAMAAP//AwBQSwMEFAAGAAgAAAAhADHdX2HSAAAAjwEAAAsAAABfcmVscy8ucmVs
c6SQwWrDMAyG74O9g9G9cdpDGaNOb4VeSwe7CltJTGPLWCZt376mMFhGbzvqF/o+8e/2tzCpmbJ4
jgbWTQuKomXn42Dg63xYfYCSgtHhxJEM3Elg372/7U40YalHMvokqlKiGBhLSZ9aix0poDScKNZN
zzlgqWMedEJ7wYH0pm23Ov9mQLdgqqMzkI9uA+p8T9X8hx28zSzcl8Zy0Nz33r6iasfXeKK5UjAP
VAy4LM8w09zU50C/9q7/6ZURE31X/kL8TKv1x6wXNXYPAAAA//8DAFBLAwQUAAYACAAAACEAg8WL
frICAAChBwAAEAAAAGRycy9zaGFwZXhtbC54bWysld9u2jAUxu8n7R0s36f5QxJS1FARINOkaava
9QGM40A2x45sj4KqvnuPnYRN6rRJBS7AxIm/3/nO5/jm9tBytGdKN1LkOLwKMGKCyqoR2xw/fi+9
DCNtiKgIl4Ll+Mg0vp1//HBzqNRMbn4wahAsIfQMLuR4Z0w3831Nd6wl+kp2TMBsLVVLDPxVW79S
5AkWb7kfBUHq604xUukdY2bVz+C5W1t3qCVUyRxjZNjB8Eb8hHE/KfYP3Z3qx/Tr/k6hpspxgpEg
LUDeAxURW85QDA+QGTz+RY+c5B2ULWnEuBL6pZocP5dlVCTrMvZKGHlxUMResY6vvTKaZOtoWi6j
SfpinwnTGYUaDRj8uRq8gotvKNoGqtWyNldUtr6s64ay0S3wKox9R+EqfY6SYr1Yh1MvCpdLL14s
Vt6imCZekixX0SReZeEye8H+/MZ31Y+/4AIMbeucaycDrZv2Zjvzp7fauUxmh1q1I/ob8P83+WQf
VIUOOY6zNM1SjI45TqNgOplaUgeKKEyncRokaYgRhRuusziZDJVYDHtjp7T5xOTZSMgulGMFcXHd
JXswqDdtlLByWvKmKhvOL2GBVtvNkiu0JzzHQVAESTBUd5KxmlxcRGwkd2XYTclO2ptt+FYY4sLF
EIS++TYS2hw566nuGXTQ7fd37yNIMDQ5co67F8VvJkIpEybsp3akYr1NSQCfEXaswmWaCwCyZDW0
52JsA8Co1EOMbH0+Bj0rzeoaAnQx8eBfxvTiJ0VXuRSXE28bIdXfADh0Zai81xtD0kfDpsQcClkd
LdIGfuGdfG5O4Fgy3+Cr5vIpx5Q3HUbK8KW0OwcjIuhOwplDjbJokFxtHizOucJuse7cVVw0RHVH
FLkHMzgcSDlmwnt8GIzsBgtH39zbV49X+7N1/goAAP//AwBQSwMEFAAGAAgAAAAhAJviafkhAQAA
mQEAAA8AAABkcnMvZG93bnJldi54bWx0kE9PwkAQxe8mfofNmHgxsFtKG4osxBiJJiRE/njwtnSn
tNpum90Vyrd3ACPx4HHmN+/NvBlN2qpkO7SuqI2EoCuAoUlrXZithPVq2hkAc14ZrcraoIQDOpiM
r69GaqjrvVngbum3jEyMGyoJuffNkHOX5lgp160bNMSy2lbKU2m3XFu1J/Oq5D0hYl6pwtCGXDX4
mGP6ufyqJMzb1w8tVnfvs9lhan22fivRTqW8vWkf7oF5bP1l+Ef9oiVEwLLnw8YWeqGcRyuB4lA4
CgZjurixmBYOn7IMUz/PMofeHfslo+ydIBZJDxj5xP1YRHEA/Aj9GYYiSE4wGfSj8IzsEQVhmJzJ
H9nmxHqhoAeS5a+K/3cGgctHx98AAAD//wMAUEsBAi0AFAAGAAgAAAAhAPD3irv9AAAA4gEAABMA
AAAAAAAAAAAAAAAAAAAAAFtDb250ZW50X1R5cGVzXS54bWxQSwECLQAUAAYACAAAACEAMd1fYdIA
AACPAQAACwAAAAAAAAAAAAAAAAAuAQAAX3JlbHMvLnJlbHNQSwECLQAUAAYACAAAACEAg8WLfrIC
AAChBwAAEAAAAAAAAAAAAAAAAAApAgAAZHJzL3NoYXBleG1sLnhtbFBLAQItABQABgAIAAAAIQCb
4mn5IQEAAJkBAAAPAAAAAAAAAAAAAAAAAAkFAABkcnMvZG93bnJldi54bWxQSwUGAAAAAAQABAD1
AAAAVwYAAAAA
" o:insetmode="auto">
    <v:imagedata src="http://125.212.128.54/asgbn_wh/images/hor_bar.png"
     o:title=""/>
    <o:lock v:ext="edit" aspectratio="f"/>
    <x:ClientData ObjectType="Pict">
     <x:CF>Bitmap</x:CF>
     <x:AutoPict/>
    </x:ClientData>
   </v:shape><v:shape id="Rectangle_x0020_5" o:spid="_x0000_s2052" type="#_x0000_t75"
    style='position:absolute;left:-101;top:6077;width:8185;height:1125;
    visibility:visible;mso-wrap-style:square;v-text-anchor:top' o:gfxdata="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
AAA=
" o:insetmode="auto">
    <v:imagedata src="images/icon.png"
     o:title=""/>
    <o:lock v:ext="edit" aspectratio="f"/>
    <x:ClientData ObjectType="Pict">
     <x:CF>Bitmap</x:CF>
     <x:AutoPict/>
    </x:ClientData>
   </v:shape></v:group><![endif]--><![if !vml]><span style='mso-ignore:vglayout;
  position:absolute;z-index:2;margin-left:0px;margin-top:2px;width:686px;
  height:13px'><img width=686 height=13
  src="images/hor_bar.png" v:shapes="Group_x0020_3 Rectangle_x0020_4 Rectangle_x0020_5"></span><![endif]><span
  style='mso-ignore:vglayout2'>
  <table cellpadding=0 cellspacing=0>
   <tr>
    <td height=22 class=xl318223919 width=48 style='height:16.5pt;width:36pt'></td>
   </tr>
  </table>
  </span></td>
  <td class=xl318223919></td>
  <td class=xl318523919 width=682 style='width:173pt'></td>
  <td class=xl318523919 width=682 style='width:41pt'></td>
  <td class=xl318523919 width=682 style='width:41pt'></td>
  <td class=xl318623919></td>
  <td class=xl318723919></td>
 </tr>
 <tr height=22 style='mso-height-source:userset;height:16.5pt'>
  <td height=22 class=xl323823919 colspan=3 style='height:16.5pt'>B&#7897;
  ph&#7853;n: Kho th&#432;&#7901;ng</td>
  <td class=xl318523919 width=682 style='width:41pt'></td>
  <td class=xl318523919 width=682 style='width:41pt'></td>
  <td class=xl318623919></td>
  <td class=xl318723919></td>
 </tr>
 <tr height=22 style='mso-height-source:userset;height:16.5pt'>
  <td height=22 class=xl323523919 colspan=3 style='height:16.5pt'>Section:
  Normal warehouse</td>
  <td class=xl318523919 width=682 style='width:41pt'></td>
  <td class=xl318523919 width=682 style='width:41pt'></td>
  <td class=xl318823919></td>
  <td class=xl318923919></td>
 </tr>
 <tr height=56 style='mso-height-source:userset;height:42.6pt'>
  <td colspan=7 height=56 class=xl322223919 width=682 style='height:42.6pt;
  width:510pt'>PHI&#7870;U NH&#7852;P KHO<br>
    INBOUND W/H TALLY SHEET</td>
 </tr>
 <tr class=xl319323919 height=20 style='mso-height-source:userset;height:15.0pt'>
  <td height=20 class=xl319023919 style='height:15.0pt'></td>
  <td class=xl319023919></td>
  <td class=xl319123919 width=682 style='width:173pt'></td>
  <td class=xl318223919></td>
  <td class=xl318223919></td>
  <td class=xl318223919></td>
  <td class=xl319223919></td>
 </tr>
 <tr class=xl319323919 height=25 style='height:18.75pt'>
  <td height=25 class=xl319423919 colspan=2 style='height:18.75pt'>Ngày/ Dated:</td>
  <td class=xl319423919 width=682 style='width:173pt'><?php echo $DateIn?></td>
  <td class=xl319423919 colspan=4>Bi&#7875;n ki&#7875;m soát/ Truck No: <?php echo $TruckNo?></td>
 </tr>
 <tr class=xl319323919 height=21 style='height:15.75pt'>
  <td colspan=3 height=21 class=xl322423919 width=682 style='height:15.75pt;
  width:280pt'>Theo l&#7879;nh nh&#7853;p kho c&#7911;a MMV s&#7889;:<br>
    <font class="font923919">As per MMV order's No.:<span
  style='mso-spacerun:yes'> </span></font></td>
  <td colspan=4 class=xl323723919>…...............................................................</td>
 </tr>
 <tr class=xl319323919 height=24 style='mso-height-source:userset;height:18.0pt'>
  <td height=24 class=xl323523919 colspan=5 style='height:18.0pt'>Nh&#7853;p
  t&#7841;i kho<font class="font923919">/Warehouse address:</font><font
  class="font623919"><span style='mso-spacerun:yes'>  </span>ASG YÊN PHONG,
  B&#7854;C NINH</font></td>
  <td class=xl318923919></td>
  <td class=xl319723919></td>
 </tr>
 <tr class=xl319323919 height=21 style='height:15.75pt'>
  <td colspan=2 height=21 class=xl322523919 width=682 style='height:15.75pt;
  width:107pt'><font class="font623919">Ng&#432;&#7901;i giao hàng:</font><font
  class="font923919"><br>
    Delivery cargo party</font></td>
  <td colspan=5 class=xl323623919 width=682 style='width:403pt'><?PHP echo $DriverName?></td>
 </tr>
 <tr class=xl319323919 height=19 style='mso-height-source:userset;height:14.25pt'>
  <td height=19 class=xl319623919 style='height:14.25pt'></td>
  <td class=xl319623919></td>
  <td class=xl319823919></td>
  <td class=xl319923919></td>
  <td class=xl319323919></td>
  <td class=xl320023919></td>
  <td class=xl319323919></td>
 </tr>
 <tr class=xl320123919 height=29 style='mso-height-source:userset;height:21.75pt'>
  <td rowspan=2 height=58 class=xl322623919 style='border-bottom:.5pt solid black;
  height:43.5pt'>S&#7889;/No.</td>
  <td rowspan=2 class=xl322823919 width=682 style='border-bottom:.5pt solid black;
  width:71pt'>Mã ph&#7909; tùng<font class="font1123919">/ Code</font></td>
  <td rowspan=2 class=xl323023919 width=682 style='border-bottom:.5pt solid black;
  width:173pt'>Tên Ph&#7909; Tùng<font class="font1123919">/<br>
    Item description</font></td>
  <td colspan=3 class=xl323223919 width=682 style='border-right:.5pt solid black;
  border-left:none;width:123pt'>S&#7889; l&#432;&#7907;ng<font
  class="font1123919">/ Quantity</font></td>
  <td rowspan=2 class=xl322823919 width=682 style='border-bottom:.5pt solid black;
  width:107pt'>Ghi chú/ Remark</td>
 </tr>
 <tr class=xl320123919 height=29 style='mso-height-source:userset;height:21.75pt'>
  <td height=29 class=xl320223919 style='height:21.75pt;border-left:none'>Pieces</td>
  <td class=xl320323919 style='border-left:none'>Carton</td>
  <td class=xl320223919 style='border-left:none'>Pallet</td>
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
 <tr class=xl318323919 height=26 style='mso-height-source:userset;height:20.1pt'>
   <td height=26 class=xl320423919 width=682 style='height:20.1pt;border-top:
  none;width:36pt'><?php echo $stt;?></td>
   <td class=xl320423919 width=682 style='border-top:none;border-left:none;
  width:71pt'><?php echo $code;?></td>
   <td class=xl320423919 width=682 style='border-top:none;border-left:none;
  width:173pt; padding-left:3px; padding-right:3px'><div align="left"><?php echo $ProductName?></div></td>
   <td class=xl320523919 style='border-top:none;border-left:none'>&nbsp;</td>
   <td class=xl320623919 style='border-top:none;border-left:none'>&nbsp;</td>
   <td class=xl320723919 width=682 style='border-top:none;border-left:none;
  width:41pt'>&nbsp;</td>
   <td class=xl320823919 style='border-top:none;border-left:none'>&nbsp;</td>
 </tr>
 <?Php 
  }
  ?>
 <tr height=38 style='mso-height-source:userset;height:28.5pt'>
   <td height=38 class=xl321323919 width=682 style='height:28.5pt;border-top:
  none;width:36pt'>T&#7893;ng/ Total</td>
   <td class=xl320423919 width=682 style='border-top:none;border-left:none;
  width:71pt'>&nbsp;</td>
   <td class=xl320423919 width=682 style='border-top:none;border-left:none;
  width:173pt'>&nbsp;</td>
   <td class=xl321423919 style='border-top:none;border-left:none'>&nbsp;</td>
   <td class=xl321423919 style='border-top:none;border-left:none'>&nbsp;</td>
   <td class=xl321423919 style='border-top:none;border-left:none'>&nbsp;</td>
   <td class=xl320823919 style='border-top:none;border-left:none'>&nbsp;</td>
 </tr>
 <tr class=xl318323919 height=40 style='mso-height-source:userset;height:30.0pt'>
  <td colspan=3 height=40 class=xl324123919 width=682 style='height:30.0pt;
  width:280pt'>S&#7889; ch&#7913;ng t&#7915; g&#7889;c kèm theo<font
  class="font1023919">/ Original document att'd:</font></td>
  <td class=xl321523919></td>
  <td class=xl321623919></td>
  <td class=xl318223919></td>
  <td class=xl318323919></td>
 </tr>
 <tr class=xl321823919 height=36 style='mso-height-source:userset;height:27.6pt'>
  <td colspan=3 height=36 class=xl324023919 style='height:27.6pt'>Bên Giao
  hàng/<font class="font1223919"> Delivery Party</font></td>
  <td class=xl321723919 width=682 style='width:41pt'></td>
  <td class=xl321823919></td>
  <td colspan=2 class=xl324023919>Bên nh&#7853;n hàng/<font class="font1223919">
  Receiver</font></td>
 </tr>
 <tr class=xl321923919 height=20 style='mso-height-source:userset;height:15.0pt'>
  <td colspan=3 height=20 class=xl323923919 style='height:15.0pt'>(Ký, h&#7885;
  tên)</td>
  <td class=xl321923919></td>
  <td class=xl321923919></td>
  <td colspan=2 class=xl323923919>(Ký, h&#7885; tên)</td>
 </tr>
 <![if supportMisalignedColumns]>
 <tr height=0 style='display:none'>
  <td width=682 style='width:36pt'></td>
  <td width=682 style='width:71pt'></td>
  <td width=682 style='width:173pt'></td>
  <td width=682 style='width:41pt'></td>
  <td width=682 style='width:41pt'></td>
  <td width=682 style='width:41pt'></td>
  <td width=682 style='width:107pt'></td>
 </tr>
 <![endif]>
</table>

</div>


<!----------------------------->
<!--END OF OUTPUT FROM EXCEL PUBLISH AS WEB PAGE WIZARD-->
<!----------------------------->
</body>

</html>
