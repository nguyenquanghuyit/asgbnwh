<html xmlns:v="urn:schemas-microsoft-com:vml"
xmlns:o="urn:schemas-microsoft-com:office:office"
xmlns:x="urn:schemas-microsoft-com:office:excel"
xmlns="http://www.w3.org/TR/REC-html40">
<?php
$id=$_REQUEST["id"];
$strRoute="SELECT v.TruckNo,v.InvoiceNo,v.CreateDate,v.SealNo FROM vwrouteout v WHERE v.ID_Route=".$id;

$cnn=mysqli_connect("192.168.1.208","trantienhoa","abc@123","asgbn_wh",3306);
$dtRoute=mysqli_query($cnn,$strRoute);
$rowRoute=mysqli_fetch_assoc($dtRoute);

?>
<head>
<meta http-equiv=Content-Type content="text/html; charset=utf-8">
<meta name=ProgId content=Excel.Sheet>
<meta name=Generator content="Microsoft Excel 15">
<link rel=File-List href="BM01.QT.PVHMMV_files/filelist.xml">
<!--[if !mso]>
<style>
v\:* {behavior:url(#default#VML);}
o\:* {behavior:url(#default#VML);}
x\:* {behavior:url(#default#VML);}
.shape {behavior:url(#default#VML);}
</style>
<![endif]-->
<style id="1. Proof of Delivery Export (BM01.QT.PVHMMV)_26003_Styles">
<!--table
	{mso-displayed-decimal-separator:"\.";
	mso-displayed-thousand-separator:"\,";}
.xl316526003
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
.xl316626003
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
.xl316726003
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
.xl316826003
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
.xl316926003
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
	border:.5pt solid windowtext;
	mso-background-source:auto;
	mso-pattern:auto;
	white-space:nowrap;}
.xl317026003
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
.xl317126003
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
.xl317226003
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
.xl317326003
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
.xl317426003
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
.xl317526003
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
.xl317626003
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
.xl317726003
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
.xl317826003
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
	white-space:nowrap;}
.xl317926003
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
.xl318026003
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
.xl318126003
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
.xl318226003
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
.xl318326003
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
.xl318426003
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
.xl318526003
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
.xl318626003
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
.xl318726003
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
.xl318826003
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
.xl318926003
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
.xl319026003
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
.xl319126003
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
.xl319226003
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
.xl319326003
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
.xl319426003
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
	vertical-align:middle;
	mso-background-source:auto;
	mso-pattern:auto;
	white-space:nowrap;}
.xl319526003
	{padding:0px;
	mso-ignore:padding;
	color:black;
	font-size:11.0pt;
	font-weight:700;
	font-style:normal;
	text-decoration:none;
	font-family:"Times New Roman", serif;
	mso-font-charset:0;
	mso-number-format:"00\0022\:\002200";
	text-align:general;
	vertical-align:middle;
	mso-background-source:auto;
	mso-pattern:auto;
	white-space:nowrap;}
.xl319626003
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
	mso-background-source:auto;
	mso-pattern:auto;
	white-space:normal;}
.xl319726003
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
.xl319826003
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
.xl319926003
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
	white-space:normal;}
.xl320026003
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
	vertical-align:bottom;
	mso-background-source:auto;
	mso-pattern:auto;
	white-space:nowrap;}
.xl320126003
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
.xl320226003
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
	text-align:center;
	vertical-align:middle;
	mso-background-source:auto;
	mso-pattern:auto;
	white-space:nowrap;}
.xl320326003
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
	mso-background-source:auto;
	mso-pattern:auto;
	white-space:nowrap;}
.xl320426003
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
	text-align:center;
	vertical-align:middle;
	mso-background-source:auto;
	mso-pattern:auto;
	white-space:nowrap;}
.xl320526003
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
	text-align:center;
	vertical-align:middle;
	mso-background-source:auto;
	mso-pattern:auto;
	white-space:normal;}
.xl320626003
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
	text-align:left;
	vertical-align:middle;
	mso-background-source:auto;
	mso-pattern:auto;
	white-space:normal;}
.xl320726003
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
	text-align:center;
	vertical-align:bottom;
	mso-background-source:auto;
	mso-pattern:auto;
	white-space:nowrap;}
.xl320826003
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
	text-align:center;
	vertical-align:bottom;
	mso-background-source:auto;
	mso-pattern:auto;
	white-space:nowrap;}
.xl320926003
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
	text-align:center;
	vertical-align:middle;
	mso-background-source:auto;
	mso-pattern:auto;
	white-space:normal;}
.xl321026003
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

<div id="1. Proof of Delivery Export (BM01.QT.PVHMMV)_26003" align=center
x:publishsource="Excel">

<table border=0 cellpadding=0 cellspacing=0 width=663 class=xl316626003
 style='border-collapse:collapse;table-layout:fixed;width:498pt'>
 <col class=xl316626003 width=48 style='mso-width-source:userset;mso-width-alt:
 1755;width:36pt'>
 <col class=xl316626003 width=117 style='mso-width-source:userset;mso-width-alt:
 4278;width:88pt'>
 <col class=xl316626003 width=150 style='mso-width-source:userset;mso-width-alt:
 5485;width:113pt'>
 <col class=xl318626003 width=55 style='mso-width-source:userset;mso-width-alt:
 2011;width:41pt'>
 <col class=xl316726003 width=34 style='mso-width-source:userset;mso-width-alt:
 1243;width:26pt'>
 <col class=xl317026003 width=55 style='mso-width-source:userset;mso-width-alt:
 2011;width:41pt'>
 <col class=xl316626003 width=47 style='mso-width-source:userset;mso-width-alt:
 1718;width:35pt'>
 <col class=xl316626003 width=157 style='mso-width-source:userset;mso-width-alt:
 5741;width:118pt'>
 <tr height=22 style='mso-height-source:userset;height:16.5pt'>
  <td colspan=2 rowspan=5 height=110 width=165 style='height:82.5pt;width:124pt'
  align=left valign=top><!--[if gte vml 1]><v:shapetype id="_x0000_t75"
   coordsize="21600,21600" o:spt="75" o:preferrelative="t" path="m@4@5l@4@11@9@11@9@5xe"
   filled="f" stroked="f">
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
  </v:shapetype><v:shape id="Picture_x0020_1" o:spid="_x0000_s2049" type="#_x0000_t75"
   style='position:absolute;margin-left:15pt;margin-top:12pt;width:101.25pt;
   height:56.25pt;z-index:1;visibility:visible' o:gfxdata="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
hAEAADItAAAAAA==
">
   <v:imagedata src=""
    o:title=""/>
   <x:ClientData ObjectType="Pict">
    <x:SizeWithCells/>
    <x:CF>Bitmap</x:CF>
    <x:AutoPict/>
   </x:ClientData>
  </v:shape><![endif]--><![if !vml]><![endif]><span style='mso-ignore:vglayout2'>
  <table cellpadding=0 cellspacing=0>
   <tr>
    <td colspan=2 rowspan=5 height=110 class=xl320026003 width=165
    style='height:82.5pt;width:124pt'><img src="images/asgbn.png"</td>
   </tr>
  </table>
  </span></td>
  <td colspan=3 rowspan=5 class=xl320526003 width=239 style='width:180pt'>PROOF
  OF DELIVERY<br>
    EXPORT</td>
  <td class=xl317026003 width=55 style='width:41pt'></td>
  <td class=xl319426003 width=47 style='width:35pt'></td>
  <td class=xl318026003 width=157 style='width:118pt'></td>
 </tr>
 <tr height=22 style='mso-height-source:userset;height:16.5pt'>
  <td height=22 class=xl319726003 colspan=3 style='height:16.5pt'>Code:
  BM01.QT.PVHMMV</td>
 </tr>
 <tr height=22 style='mso-height-source:userset;height:16.5pt'>
  <td height=22 class=xl319726003 colspan=3 style='height:16.5pt'>Issue date:
  01/09/2019</td>
 </tr>
 <tr height=22 style='mso-height-source:userset;height:16.5pt'>
  <td height=22 class=xl319826003 colspan=2 style='height:16.5pt'>Issue No: 01</td>
  <td class=xl319026003></td>
 </tr>
 <tr height=22 style='mso-height-source:userset;height:16.5pt'>
  <td height=22 class=xl319526003 style='height:16.5pt'></td>
  <td class=xl319026003></td>
  <td class=xl319026003></td>
 </tr>
 <tr class=xl316726003 height=20 style='mso-height-source:userset;height:15.0pt'>
  <td height=20 class=xl317526003 style='height:15.0pt'></td>
  <td class=xl317526003></td>
  <td rowspan=2 class=xl320926003 width=150 style='width:113pt'></td>
  <td colspan=3 class=xl320026003></td>
  <td colspan=2 rowspan=2 class=xl320226003></td>
 </tr>
 <tr class=xl316726003 height=20 style='mso-height-source:userset;height:15.0pt'>
  <td height=20 class=xl317626003 colspan=2 style='height:15.0pt'>Mm/dd/yy:<?php 
 $date=date_create($rowRoute["CreateDate"]);
 echo date_format($date,"m/d/y");
  ?></td>
  <td colspan=3 class=xl320126003><div align="left">Seal No.: <?php echo $rowRoute["SealNo"];?></div></td>
 </tr>
 <tr class=xl316726003 height=20 style='mso-height-source:userset;height:15.0pt'>
  <td height=20 class=xl317726003 style='height:15.0pt'></td>
  <td class=xl317726003></td>
  <td rowspan=2 class=xl320026003></td>
  <td colspan=3 rowspan=2 class=xl320326003><div align="left">POD No. <?php echo $id?></div></td>
  <td colspan=2 rowspan=2 class=xl320426003></td>
 </tr>
 <tr class=xl316726003 height=20 style='mso-height-source:userset;height:15.0pt'>
  <td height=20 class=xl317826003 colspan=2 style='height:15.0pt'>Truck No.:<?php echo $rowRoute["TruckNo"];?></td>
 </tr>
 <tr class=xl316726003 height=10 style='mso-height-source:userset;height:7.5pt'>
  <td height=10 class=xl317726003 style='height:7.5pt'></td>
  <td class=xl317726003></td>
  <td class=xl317426003></td>
  <td class=xl318626003></td>
  <td class=xl316726003></td>
  <td class=xl317326003></td>
  <td class=xl316726003></td>
  <td class=xl316726003></td>
 </tr>
 <tr class=xl316526003 height=57 style='height:42.75pt'>
  <td height=57 class=xl318726003 style='height:42.75pt'>No.</td>
  <td class=xl318726003 style='border-left:none'>Code</td>
  <td class=xl318826003 style='border-left:none'>Item description</td>
  <td class=xl318826003 style='border-left:none'>Q'ty</td>
  <td class=xl318826003 style='border-left:none'>Box</td>
  <td class=xl318826003 style='border-left:none'>Pallet</td>
  <td class=xl318726003 style='border-left:none'>Vinyl</td>
  <td class=xl319926003 width=157 style='border-left:none;width:118pt'>Remark<br>
    ( DIM of pallet, use pallet..)</td>
 </tr>
 <?php 
 $strCode="SELECT v2.Code,v2.PCS,tp.ProductName,v2.ID_Route,v2.ID_Order FROM vworderout v2 ";
 $strCode=$strCode." INNER JOIN tbl_product tp ON tp.Code=v2.Code WHERE v2.ID_Route=".$id;

 $dtCode=mysqli_query($cnn,$strCode);
 $stt=0;
 $totalPCS=0;
 while($rowCode=mysqli_fetch_assoc($dtCode))
 {
	 $stt+=1;
	 $totalPCS+=$rowCode["PCS"];
 ?>
 <tr class=xl316626003 height=26 style='mso-height-source:userset;height:20.1pt'>
  <td height=26 class=xl316826003 width=48 style='height:20.1pt;border-top:
  none;width:36pt'><?php echo $stt;?></td>
  <td class=xl316826003 width=117 style='border-top:none;border-left:none;
  width:88pt'><?php echo $rowCode["Code"]?></td>
  <td class=xl316826003 width=150 style='border-top:none;border-left:none;
  width:113pt'><?php echo $rowCode["ProductName"]?></td>
  <td valign="middle" class=xl319226003 style='border-top:none;border-left:none'><?php echo $rowCode["PCS"]?></td>
  <td class=xl317226003 style='border-top:none;border-left:none'>&nbsp;</td>
  <td class=xl317126003 width=55 style='border-top:none;border-left:none;
  width:41pt'>&nbsp;</td>
  <td class=xl318926003 style='border-top:none;border-left:none'>&nbsp;</td>
  <td class=xl318926003 style='border-top:none;border-left:none'>&nbsp;</td>
 </tr>
 <?php }?>
 <tr height=26 style='mso-height-source:userset;height:20.1pt'>
  <td height=26 class=xl317926003 width=48 style='height:20.1pt;border-top:
  none;width:36pt'>Total</td>
  <td class=xl316826003 width=117 style='border-top:none;border-left:none;
  width:88pt'>&nbsp;</td>
  <td class=xl316826003 width=150 style='border-top:none;border-left:none;
  width:113pt'>&nbsp;</td>
  <td class=xl319326003 style='border-top:none;border-left:none'><?php echo $totalPCS;?></td>
  <td class=xl319326003 style='border-top:none;border-left:none'>&nbsp;</td>
  <td class=xl316926003 style='border-top:none;border-left:none'>&nbsp;</td>
  <td class=xl318926003 style='border-top:none;border-left:none'>&nbsp;</td>
  <td class=xl318926003 style='border-top:none;border-left:none'>&nbsp;</td>
 </tr>
 <tr height=26 style='mso-height-source:userset;height:20.1pt'>
  <td height=26 class=xl318126003 width=48 style='height:20.1pt;width:36pt'></td>
  <td class=xl318226003 width=117 style='width:88pt'></td>
  <td class=xl318226003 width=150 style='width:113pt'></td>
  <td class=xl319126003></td>
  <td class=xl318326003></td>
  <td class=xl318426003></td>
  <td class=xl316626003></td>
  <td class=xl316626003></td>
 </tr>
 <tr height=29 style='mso-height-source:userset;height:21.75pt'>
  <td colspan=2 height=29 class=xl320626003 width=165 style='height:21.75pt;
  width:124pt'>Point of departure</td>
  <td class=xl319626003 width=150 style='width:113pt'></td>
  <td colspan=3 class=xl320626003 width=144 style='width:108pt'>Destination</td>
  <td colspan=2 class=xl318626003>…………………………</td>
 </tr>
 <tr class=xl316726003 height=30 style='mso-height-source:userset;height:22.5pt'>
  <td colspan=2 height=30 class=xl321026003 width=165 style='height:22.5pt;
  width:124pt'>Departure time</td>
  <td class=xl318526003 width=150 style='width:113pt'>…………………</td>
  <td colspan=3 class=xl317326003>Arrival time</td>
  <td colspan=2 class=xl318626003>…………………………</td>
 </tr>
 <tr class=xl316726003 height=31 style='mso-height-source:userset;height:23.25pt'>
  <td colspan=2 height=31 class=xl316726003 style='height:23.25pt'>Time begin
  unloading</td>
  <td class=xl318526003 width=150 style='width:113pt'>…………………</td>
  <td colspan=3 class=xl316726003>Time finish unloading</td>
  <td colspan=2 class=xl318626003>…………………………</td>
 </tr>
 <tr height=20 style='height:15.0pt'>
  <td height=20 class=xl316626003 style='height:15.0pt'></td>
  <td class=xl316626003></td>
  <td class=xl316626003></td>
  <td class=xl318626003></td>
  <td class=xl316726003></td>
  <td class=xl317026003></td>
  <td class=xl316626003></td>
  <td class=xl316626003></td>
 </tr>
 <tr height=20 style='height:15.0pt'>
  <td height=20 class=xl316626003 style='height:15.0pt'></td>
  <td class=xl316626003></td>
  <td class=xl316626003></td>
  <td class=xl318626003></td>
  <td class=xl316726003></td>
  <td class=xl317026003></td>
  <td class=xl316626003></td>
  <td class=xl316626003></td>
 </tr>
 <tr height=20 style='height:15.0pt'>
  <td colspan=2 height=20 class=xl320726003 style='height:15.0pt'>Delivery
  party</td>
  <td colspan=3 class=xl320726003>Driver</td>
  <td colspan=3 class=xl320726003>Receive party</td>
 </tr>
 <tr class=xl318026003 height=20 style='height:15.0pt'>
  <td colspan=2 height=20 class=xl320826003 style='height:15.0pt'>(Sign and
  write full name)</td>
  <td colspan=3 class=xl320826003>(Sign and write full name)</td>
  <td colspan=3 class=xl320826003>(Sign and write full name)</td>
 </tr>
 <tr height=20 style='height:15.0pt'>
  <td height=20 class=xl316626003 style='height:15.0pt'></td>
  <td class=xl316626003></td>
  <td class=xl316626003></td>
  <td class=xl318626003></td>
  <td class=xl316726003></td>
  <td class=xl317026003></td>
  <td class=xl316626003></td>
  <td class=xl316626003></td>
 </tr>
 <tr height=20 style='height:15.0pt'>
  <td height=20 class=xl316626003 style='height:15.0pt'></td>
  <td class=xl316626003></td>
  <td class=xl316626003></td>
  <td class=xl318626003></td>
  <td class=xl316726003></td>
  <td class=xl317026003></td>
  <td class=xl316626003></td>
  <td class=xl316626003></td>
 </tr>
 <tr height=20 style='height:15.0pt'>
  <td height=20 class=xl316626003 style='height:15.0pt'></td>
  <td class=xl316626003></td>
  <td class=xl316626003></td>
  <td class=xl318626003></td>
  <td class=xl316726003></td>
  <td class=xl317026003></td>
  <td class=xl316626003></td>
  <td class=xl316626003></td>
 </tr>
 <tr height=20 style='height:15.0pt'>
  <td height=20 class=xl316626003 style='height:15.0pt'></td>
  <td class=xl316626003></td>
  <td class=xl316626003></td>
  <td class=xl318626003></td>
  <td class=xl316726003></td>
  <td class=xl317026003></td>
  <td class=xl316626003></td>
  <td class=xl316626003></td>
 </tr>
 <tr height=20 style='height:15.0pt'>
  <td height=20 class=xl316626003 style='height:15.0pt'></td>
  <td class=xl316626003></td>
  <td class=xl316626003></td>
  <td class=xl318626003></td>
  <td class=xl316726003></td>
  <td class=xl317026003></td>
  <td class=xl316626003></td>
  <td class=xl316626003></td>
 </tr>
 <tr height=20 style='height:15.0pt'>
  <td height=20 class=xl316626003 style='height:15.0pt'></td>
  <td class=xl316626003></td>
  <td class=xl316626003></td>
  <td class=xl318626003></td>
  <td class=xl316726003></td>
  <td class=xl317026003></td>
  <td class=xl316626003></td>
  <td class=xl316626003></td>
 </tr>
 <![if supportMisalignedColumns]>
 <tr height=0 style='display:none'>
  <td width=48 style='width:36pt'></td>
  <td width=117 style='width:88pt'></td>
  <td width=150 style='width:113pt'></td>
  <td width=55 style='width:41pt'></td>
  <td width=34 style='width:26pt'></td>
  <td width=55 style='width:41pt'></td>
  <td width=47 style='width:35pt'></td>
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
