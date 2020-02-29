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

$ngayHienTai=date("d/m/Y");
$yyyy=date("Y");
$mm=date("m");
$dd=date("d");

if(mysqli_num_rows($rs)>0)
{
	$row=mysqli_fetch_assoc($rs);
	$DateOut=$row["DateOut"];
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
<link rel=File-List href="BBBGFOXCONN_files/filelist.xml">
<!--[if !mso]>
<style>
v\:* {behavior:url(#default#VML);}
o\:* {behavior:url(#default#VML);}
x\:* {behavior:url(#default#VML);}
.shape {behavior:url(#default#VML);}
</style>
<![endif]-->
<style id="BBBGFOXCONN_16942_Styles">
<!--table
	{mso-displayed-decimal-separator:"\.";
	mso-displayed-thousand-separator:"\,";}
.xl6516942
	{padding:0px;
	mso-ignore:padding;
	color:black;
	font-size:14.0pt;
	font-weight:400;
	font-style:normal;
	text-decoration:none;
	font-family:"Times New Roman", serif;
	mso-font-charset:163;
	mso-number-format:General;
	text-align:general;
	vertical-align:bottom;
	mso-background-source:auto;
	mso-pattern:auto;
	white-space:nowrap;}
.xl6616942
	{padding:0px;
	mso-ignore:padding;
	color:black;
	font-size:14.0pt;
	font-weight:400;
	font-style:normal;
	text-decoration:none;
	font-family:"Times New Roman", serif;
	mso-font-charset:163;
	mso-number-format:General;
	text-align:center;
	vertical-align:bottom;
	mso-background-source:auto;
	mso-pattern:auto;
	white-space:nowrap;}
.xl6716942
	{padding:0px;
	mso-ignore:padding;
	color:black;
	font-size:11.0pt;
	font-weight:400;
	font-style:normal;
	text-decoration:none;
	font-family:"Times New Roman", serif;
	mso-font-charset:163;
	mso-number-format:General;
	text-align:left;
	vertical-align:bottom;
	mso-background-source:auto;
	mso-pattern:auto;
	white-space:nowrap;}
.xl6816942
	{padding:0px;
	mso-ignore:padding;
	color:black;
	font-size:11.0pt;
	font-weight:400;
	font-style:normal;
	text-decoration:none;
	font-family:"Times New Roman", serif;
	mso-font-charset:163;
	mso-number-format:General;
	text-align:general;
	vertical-align:bottom;
	mso-background-source:auto;
	mso-pattern:auto;
	white-space:nowrap;}
.xl6916942
	{padding:0px;
	mso-ignore:padding;
	color:black;
	font-size:14.0pt;
	font-weight:700;
	font-style:normal;
	text-decoration:none;
	font-family:"Times New Roman", serif;
	mso-font-charset:163;
	mso-number-format:General;
	text-align:general;
	vertical-align:middle;
	mso-background-source:auto;
	mso-pattern:auto;
	white-space:normal;}
.xl7016942
	{padding:0px;
	mso-ignore:padding;
	color:black;
	font-size:12.0pt;
	font-weight:400;
	font-style:normal;
	text-decoration:none;
	font-family:"Times New Roman", serif;
	mso-font-charset:163;
	mso-number-format:General;
	text-align:general;
	vertical-align:middle;
	mso-background-source:auto;
	mso-pattern:auto;
	white-space:nowrap;}
.xl7116942
	{padding:0px;
	mso-ignore:padding;
	color:black;
	font-size:11.0pt;
	font-weight:700;
	font-style:normal;
	text-decoration:none;
	font-family:"Times New Roman", serif;
	mso-font-charset:163;
	mso-number-format:General;
	text-align:left;
	vertical-align:middle;
	mso-background-source:auto;
	mso-pattern:auto;
	white-space:nowrap;}
.xl7216942
	{padding:0px;
	mso-ignore:padding;
	color:windowtext;
	font-size:11.0pt;
	font-weight:700;
	font-style:normal;
	text-decoration:none;
	font-family:"Times New Roman", serif;
	mso-font-charset:163;
	mso-number-format:General;
	text-align:right;
	vertical-align:middle;
	mso-background-source:auto;
	mso-pattern:auto;
	white-space:nowrap;}
.xl7316942
	{padding:0px;
	mso-ignore:padding;
	color:windowtext;
	font-size:11.0pt;
	font-weight:700;
	font-style:normal;
	text-decoration:none;
	font-family:"Times New Roman", serif;
	mso-font-charset:163;
	mso-number-format:"00\0022\:\002200";
	text-align:left;
	vertical-align:middle;
	mso-background-source:auto;
	mso-pattern:auto;
	white-space:nowrap;}
.xl7416942
	{padding:0px;
	mso-ignore:padding;
	color:black;
	font-size:12.0pt;
	font-weight:700;
	font-style:normal;
	text-decoration:none;
	font-family:"Times New Roman", serif;
	mso-font-charset:163;
	mso-number-format:"00\0022\:\002200";
	text-align:left;
	vertical-align:middle;
	mso-background-source:auto;
	mso-pattern:auto;
	white-space:nowrap;}
.xl7516942
	{padding:0px;
	mso-ignore:padding;
	color:black;
	font-size:11.0pt;
	font-weight:700;
	font-style:normal;
	text-decoration:none;
	font-family:"Times New Roman", serif;
	mso-font-charset:163;
	mso-number-format:General;
	text-align:right;
	vertical-align:middle;
	mso-background-source:auto;
	mso-pattern:auto;
	white-space:nowrap;}
.xl7616942
	{padding:0px;
	mso-ignore:padding;
	color:windowtext;
	font-size:11.0pt;
	font-weight:700;
	font-style:normal;
	text-decoration:none;
	font-family:"Times New Roman", serif;
	mso-font-charset:163;
	mso-number-format:General;
	text-align:left;
	vertical-align:middle;
	mso-background-source:auto;
	mso-pattern:auto;
	white-space:nowrap;}
.xl7716942
	{padding:0px;
	mso-ignore:padding;
	color:black;
	font-size:12.0pt;
	font-weight:700;
	font-style:normal;
	text-decoration:none;
	font-family:"Times New Roman", serif;
	mso-font-charset:163;
	mso-number-format:General;
	text-align:left;
	vertical-align:middle;
	mso-background-source:auto;
	mso-pattern:auto;
	white-space:nowrap;}
.xl7816942
	{padding:0px;
	mso-ignore:padding;
	color:black;
	font-size:11.0pt;
	font-weight:700;
	font-style:normal;
	text-decoration:none;
	font-family:"Times New Roman", serif;
	mso-font-charset:163;
	mso-number-format:General;
	text-align:left;
	vertical-align:bottom;
	mso-background-source:auto;
	mso-pattern:auto;
	white-space:nowrap;}
.xl7916942
	{padding:0px;
	mso-ignore:padding;
	color:black;
	font-size:10.5pt;
	font-weight:700;
	font-style:normal;
	text-decoration:none;
	font-family:"Times New Roman", serif;
	mso-font-charset:163;
	mso-number-format:General;
	text-align:general;
	vertical-align:middle;
	mso-background-source:auto;
	mso-pattern:auto;
	white-space:nowrap;}
.xl8016942
	{padding:0px;
	mso-ignore:padding;
	color:black;
	font-size:12.0pt;
	font-weight:400;
	font-style:normal;
	text-decoration:none;
	font-family:"Times New Roman", serif;
	mso-font-charset:163;
	mso-number-format:General;
	text-align:right;
	vertical-align:middle;
	mso-background-source:auto;
	mso-pattern:auto;
	white-space:nowrap;}
.xl8116942
	{padding:0px;
	mso-ignore:padding;
	color:black;
	font-size:12.0pt;
	font-weight:700;
	font-style:normal;
	text-decoration:none;
	font-family:"Times New Roman", serif;
	mso-font-charset:163;
	mso-number-format:General;
	text-align:center;
	vertical-align:middle;
	border-top:.5pt solid windowtext;
	border-right:.5pt solid windowtext;
	border-bottom:none;
	border-left:.5pt solid windowtext;
	mso-background-source:auto;
	mso-pattern:auto;
	white-space:normal;}
.xl8216942
	{padding:0px;
	mso-ignore:padding;
	color:black;
	font-size:12.0pt;
	font-weight:400;
	font-style:normal;
	text-decoration:none;
	font-family:"Times New Roman", serif;
	mso-font-charset:163;
	mso-number-format:General;
	text-align:center;
	vertical-align:middle;
	border:.5pt solid windowtext;
	mso-background-source:auto;
	mso-pattern:auto;
	white-space:nowrap;}
.xl8316942
	{padding:0px;
	mso-ignore:padding;
	color:windowtext;
	font-size:12.0pt;
	font-weight:400;
	font-style:normal;
	text-decoration:none;
	font-family:"Times New Roman", serif;
	mso-font-charset:0;
	mso-number-format:"000\0022-\002200000\0022-\002200";
	text-align:center;
	vertical-align:middle;
	border:.5pt solid windowtext;
	mso-background-source:auto;
	mso-pattern:auto;
	white-space:nowrap;}
.xl8416942
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
.xl8516942
	{padding:0px;
	mso-ignore:padding;
	color:windowtext;
	font-size:12.0pt;
	font-weight:400;
	font-style:normal;
	text-decoration:none;
	font-family:"Times New Roman", serif;
	mso-font-charset:0;
	mso-number-format:0;
	text-align:center;
	vertical-align:middle;
	border:.5pt solid windowtext;
	mso-background-source:auto;
	mso-pattern:auto;
	white-space:nowrap;}
.xl8616942
	{padding:0px;
	mso-ignore:padding;
	color:windowtext;
	font-size:12.0pt;
	font-weight:400;
	font-style:normal;
	text-decoration:none;
	font-family:"Times New Roman", serif;
	mso-font-charset:163;
	mso-number-format:General;
	text-align:center;
	vertical-align:middle;
	border:.5pt solid windowtext;
	background:white;
	mso-pattern:black none;
	white-space:nowrap;}
.xl8716942
	{padding:0px;
	mso-ignore:padding;
	color:black;
	font-size:12.0pt;
	font-weight:700;
	font-style:normal;
	text-decoration:none;
	font-family:"Times New Roman", serif;
	mso-font-charset:163;
	mso-number-format:General;
	text-align:center;
	vertical-align:middle;
	border:.5pt solid windowtext;
	mso-background-source:auto;
	mso-pattern:auto;
	white-space:nowrap;}
.xl8816942
	{padding:0px;
	mso-ignore:padding;
	color:black;
	font-size:12.0pt;
	font-weight:700;
	font-style:normal;
	text-decoration:none;
	font-family:"Times New Roman", serif;
	mso-font-charset:163;
	mso-number-format:"\#\,\#\#0";
	text-align:center;
	vertical-align:middle;
	border:.5pt solid windowtext;
	mso-background-source:auto;
	mso-pattern:auto;
	white-space:nowrap;}
.xl8916942
	{padding:0px;
	mso-ignore:padding;
	color:black;
	font-size:12.0pt;
	font-weight:400;
	font-style:normal;
	text-decoration:none;
	font-family:"Times New Roman", serif;
	mso-font-charset:163;
	mso-number-format:General;
	text-align:general;
	vertical-align:bottom;
	mso-background-source:auto;
	mso-pattern:auto;
	white-space:nowrap;}
.xl9016942
	{padding:0px;
	mso-ignore:padding;
	color:black;
	font-size:12.0pt;
	font-weight:400;
	font-style:normal;
	text-decoration:none;
	font-family:"Times New Roman", serif;
	mso-font-charset:163;
	mso-number-format:General;
	text-align:center;
	vertical-align:bottom;
	mso-background-source:auto;
	mso-pattern:auto;
	white-space:nowrap;}
.xl9116942
	{padding:0px;
	mso-ignore:padding;
	color:black;
	font-size:12.0pt;
	font-weight:400;
	font-style:normal;
	text-decoration:none;
	font-family:"Times New Roman", serif;
	mso-font-charset:163;
	mso-number-format:General;
	text-align:right;
	vertical-align:bottom;
	mso-background-source:auto;
	mso-pattern:auto;
	white-space:nowrap;}
.xl9216942
	{padding:0px;
	mso-ignore:padding;
	color:black;
	font-size:12.0pt;
	font-weight:400;
	font-style:italic;
	text-decoration:none;
	font-family:"Times New Roman", serif;
	mso-font-charset:163;
	mso-number-format:General;
	text-align:center;
	vertical-align:bottom;
	mso-background-source:auto;
	mso-pattern:auto;
	white-space:nowrap;}
.xl9316942
	{padding:0px;
	mso-ignore:padding;
	color:black;
	font-size:10.0pt;
	font-weight:700;
	font-style:normal;
	text-decoration:none;
	font-family:"Times New Roman", serif;
	mso-font-charset:163;
	mso-number-format:General;
	text-align:general;
	vertical-align:bottom;
	mso-background-source:auto;
	mso-pattern:auto;
	white-space:nowrap;}
.xl9416942
	{padding:0px;
	mso-ignore:padding;
	color:black;
	font-size:12.0pt;
	font-weight:400;
	font-style:italic;
	text-decoration:none;
	font-family:"Times New Roman", serif;
	mso-font-charset:163;
	mso-number-format:General;
	text-align:general;
	vertical-align:bottom;
	mso-background-source:auto;
	mso-pattern:auto;
	white-space:nowrap;}
.xl9516942
	{padding:0px;
	mso-ignore:padding;
	color:black;
	font-size:20.0pt;
	font-weight:700;
	font-style:normal;
	text-decoration:none;
	font-family:"Times New Roman", serif;
	mso-font-charset:163;
	mso-number-format:General;
	text-align:center;
	vertical-align:middle;
	mso-background-source:auto;
	mso-pattern:auto;
	white-space:normal;}
.xl9616942
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
	text-align:left;
	vertical-align:middle;
	mso-background-source:auto;
	mso-pattern:auto;
	white-space:nowrap;}
.xl9716942
	{padding:0px;
	mso-ignore:padding;
	color:black;
	font-size:11.0pt;
	font-weight:700;
	font-style:normal;
	text-decoration:none;
	font-family:"Times New Roman", serif;
	mso-font-charset:163;
	mso-number-format:"Short Date";
	text-align:left;
	vertical-align:middle;
	mso-background-source:auto;
	mso-pattern:auto;
	white-space:nowrap;}
.xl9816942
	{padding:0px;
	mso-ignore:padding;
	color:black;
	font-size:10.0pt;
	font-weight:700;
	font-style:normal;
	text-decoration:none;
	font-family:"Times New Roman", serif;
	mso-font-charset:163;
	mso-number-format:General;
	text-align:center;
	vertical-align:bottom;
	mso-background-source:auto;
	mso-pattern:auto;
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

<div id="BBBGFOXCONN_16942" align=center x:publishsource="Excel">

<table border=0 cellpadding=0 cellspacing=0 width=796 class=xl6816942
 style='border-collapse:collapse;table-layout:fixed;width:598pt'>
 <col class=xl6816942 width=57 style='mso-width-source:userset;mso-width-alt:
 2084;width:43pt'>
 <col class=xl6816942 width=140 style='mso-width-source:userset;mso-width-alt:
 5120;width:105pt'>
 <col class=xl6816942 width=93 style='mso-width-source:userset;mso-width-alt:
 3401;width:70pt'>
 <col class=xl6816942 width=88 style='mso-width-source:userset;mso-width-alt:
 3218;width:66pt'>
 <col class=xl6816942 width=111 style='mso-width-source:userset;mso-width-alt:
 4059;width:83pt'>
 <col class=xl6816942 width=106 style='mso-width-source:userset;mso-width-alt:
 3876;width:80pt'>
 <col class=xl6816942 width=201 style='mso-width-source:userset;mso-width-alt:
 7350;width:151pt'>
 <tr height=25 style='mso-height-source:userset;height:18.75pt'>
  <td height=25 width=57 style='height:18.75pt;width:43pt' align=left
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
  </v:shapetype><v:shape id="Picture_x0020_1" o:spid="_x0000_s1025" type="#_x0000_t75"
   style='position:absolute;margin-left:4.5pt;margin-top:3pt;width:89.25pt;
   height:62.25pt;z-index:1;visibility:visible' o:gfxdata="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
AAAA
">
   <v:imagedata src="BBBGFOXCONN_files/BBBGFOXCONN_16942_image001.png" o:title=""/>
   <x:ClientData ObjectType="Pict">
    <x:SizeWithCells/>
    <x:CF>Bitmap</x:CF>
    <x:AutoPict/>
   </x:ClientData>
  </v:shape><![endif]--><![if !vml]><span style='mso-ignore:vglayout;
  position:absolute;z-index:1;margin-left:6px;margin-top:4px;width:119px;
  height:83px'><img width=119 height=83
  src="images/asgbn.png" v:shapes="Picture_x0020_1"></span><![endif]><span
  style='mso-ignore:vglayout2'>
  <table cellpadding=0 cellspacing=0>
   <tr>
    <td height=25 class=xl6516942 width=57 style='height:18.75pt;width:43pt'><a
    name="RANGE!A1:G17"></a></td>
   </tr>
  </table>
  </span></td>
  <td class=xl6616942 width=140 style='width:105pt'></td>
  <td colspan=4 rowspan=3 class=xl9516942 width=398 style='width:299pt'>BIÊN
  B&#7842;N BÀN GIAO <br>
    HÀNG XU&#7844;T</td>
  <td class=xl6716942 width=201 style='width:151pt'>BM.06.QT.PVHF</td>
 </tr>
 <tr height=25 style='height:18.75pt'>
  <td height=25 class=xl6516942 style='height:18.75pt'></td>
  <td class=xl6616942></td>
  <td class=xl6716942>Ngày ban hành: 01/06/2018</td>
 </tr>
 <tr height=25 style='height:18.75pt'>
  <td height=25 class=xl6516942 style='height:18.75pt'></td>
  <td class=xl6616942></td>
  <td class=xl6716942>L&#7847;n ban hành: 01</td>
 </tr>
 <tr height=25 style='height:18.75pt'>
  <td height=25 class=xl6516942 style='height:18.75pt'></td>
  <td class=xl6616942></td>
  <td class=xl6916942 width=93 style='width:70pt'></td>
  <td class=xl6916942 width=88 style='width:66pt'></td>
  <td class=xl6916942 width=111 style='width:83pt'></td>
  <td class=xl6916942 width=106 style='width:80pt'></td>
  <td class=xl6816942></td>
 </tr>
 <tr height=21 style='height:15.75pt'>
  <td colspan=2 height=21 class=xl9616942 style='height:15.75pt'>Ngày tháng:</td>
  <td colspan=2 class=xl9716942><?php echo $ngayHienTai; ?></td>
  <td class=xl7016942></td>
  <td class=xl7116942>Mã biên b&#7843;n:</td>
  <td class=xl7216942><?php 
  $maBienBan=$yyyy.$mm.$dd.$id;
  echo $maBienBan;
  ?></td>
 </tr>
 <tr height=21 style='height:15.75pt'>
  <td colspan=2 height=21 class=xl9616942 style='height:15.75pt'>Th&#7901;i
  gian xe ch&#7841;y:<span style='mso-spacerun:yes'> </span></td>
  <td class=xl7316942><input type="text" size="3" value="" placeholder="mm:ss" style="border: 0px"></td>
  <td class=xl7416942></td>
  <td class=xl7016942></td>
  <td class=xl7116942>Bi&#7875;n s&#7889; xe :</td>
  <td class=xl7516942><?php echo $TruckNo?></td>
 </tr>
 <tr height=21 style='height:15.75pt'>
  <td colspan=2 height=21 class=xl9616942 style='height:15.75pt'>S&#7889;
  pallet phát sinh:</td>
  <td class=xl7616942><input type="text" size="3" value="0" style="border: 0px"></td>
  <td class=xl7716942></td>
  <td class=xl7016942></td>
  <td class=xl7816942>S&#7889; t&#7901;:</td>
  <td class=xl7516942><input type="text" size="3" value="1" style="border: 0px"></td>
 </tr>
 <tr height=16 style='mso-height-source:userset;height:12.0pt'>
  <td height=16 class=xl7916942 style='height:12.0pt'></td>
  <td class=xl7916942></td>
  <td class=xl7716942></td>
  <td class=xl7116942></td>
  <td class=xl8016942></td>
  <td class=xl8016942></td>
  <td class=xl7516942></td>
 </tr>
 <tr height=42 style='mso-height-source:userset;height:31.5pt'>
  <td height=42 class=xl8116942 width=57 style='height:31.5pt;width:43pt'>Stt</td>
  <td class=xl8116942 width=140 style='border-left:none;width:105pt'>Code</td>
  <td class=xl8116942 width=93 style='border-left:none;width:70pt'>Pallet</td>
  <td class=xl8116942 width=88 style='border-left:none;width:66pt'>Box</td>
  <td class=xl8116942 width=111 style='border-left:none;width:83pt'>Qty/box</td>
  <td class=xl8116942 width=106 style='border-left:none;width:80pt'>Total qty</td>
  <td class=xl8116942 width=201 style='border-left:none;width:151pt'>Ghi chú</td>
 </tr>
 <?php
	$strCode="SELECT v2.Code,v2.PCS,v2.ID_Order,IfNULL(tpd.PackingQty,1) AS qty,(v2.PCS/IfNULL(tpd.PackingQty,1)) AS box";
	$strCode=$strCode." FROM vworderout v2 INNER JOIN tbl_product tp ON tp.Code=v2.Code LEFT JOIN tbl_product_detail tpd ON tp.Code=tpd.CODE WHERE v2.ID_Route=".$id;
	$oldId="";
				
	$dtCode=mysqli_query($cnn,$strCode);
	$stt=0;
	$totalPCS=0;
	$totalBox=0;
	$totalqty=0;
	$totalPl=0;
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
		$qty=$rowCode["qty"];
		$box=$rowCode["box"];
		
		$stPack="SELECT COUNT(v.ID_packingDetail) AS 'PackNo' FROM vwPacking_Report V ";
		$stPack.=" WHERE V.CusomterOrderNo='".$rowCode["ID_Order"]."' AND v.Code='".$Code."' GROUP BY v.Code";
		$dtPack=mysqli_query($cnn,$stPack);
		$rowPack=mysqli_fetch_assoc($dtPack);
		$myPackNo=$rowPack["PackNo"];
		
	 	$stt+=1;
	 	$totalPCS+=$rowCode["PCS"];
		$totalBox+=$box;
		$totalqty+=$qty;
		//$totalPl+=$myPackNo;
?>		
 <tr height=26 style='mso-height-source:userset;height:19.5pt'>
  <td height=26 class=xl8216942 style='height:19.5pt'><?php echo $stt?></td>
  <td class=xl8316942 style='border-left:none'><?php echo $Code?></td>
  <td class=xl8416942 style='border-left:none'><?php 
  		$myPackNo=$rowPack["PackNo"];	
		if($rowCode["ID_Order"]==$oldId)
		{		
			$myPackNo="";			
		}
		else
		{
			$totalPl+=$rowPack["PackNo"];
		}
		echo $myPackNo;
		?></td>
  <td class=xl8516942 style='border-left:none'><?php echo number_format($box)?></td>
  <td class=xl8516942 style='border-left:none'><?php echo $qty?></td>
  <td class=xl8516942 style='border-left:none'><?php echo $PCS?></td>
  <td class=xl8616942 style='border-left:none'>&nbsp;</td>
 </tr>
 <?php 
 $oldId=$rowCode["ID_Order"];
 }?>
 <tr height=21 style='height:15.75pt'>
  <td height=21 class=xl8716942 style='height:15.75pt;border-top:none'>Total</td>
  <td class=xl8716942 style='border-top:none;border-left:none'>&nbsp;</td>
  <td class=xl8816942 style='border-top:none;border-left:none'><?php echo $totalPl?></td>
  <td class=xl8816942 style='border-top:none;border-left:none'><?php echo $totalBox?></td>
  <td class=xl8816942 style='border-top:none;border-left:none'><?php echo $totalqty?></td>
  <td class=xl8816942 style='border-top:none;border-left:none'><?php echo $totalPCS?></td>
  <td class=xl8816942 style='border-top:none;border-left:none'>&nbsp;</td>
 </tr>
 <tr height=21 style='height:15.75pt'>
  <td height=21 class=xl8916942 style='height:15.75pt'></td>
  <td class=xl9016942></td>
  <td class=xl9016942></td>
  <td class=xl9016942></td>
  <td class=xl9116942></td>
  <td class=xl8916942></td>
  <td class=xl9016942></td>
 </tr>
 <tr height=20 style='height:15.0pt'>
  <td colspan=2 height=20 class=xl9816942 style='height:15.0pt'>Nhân viên giao
  hàng ASGBN</td>
  <td class=xl9316942></td>
  <td class=xl9316942></td>
  <td class=xl9316942></td>
  <td colspan=2 class=xl9816942><span style='mso-spacerun:yes'>   </span>Nhân
  viên nh&#7853;n hàng Foxconn/Jusda</td>
 </tr>
 <tr height=21 style='height:15.75pt'>
  <td colspan=2 height=21 class=xl9216942 style='height:15.75pt'>(Ký và ghi rõ
  h&#7885; tên)</td>
  <td class=xl9416942></td>
  <td class=xl9416942></td>
  <td class=xl9416942></td>
  <td colspan=2 class=xl9216942>(Ký và ghi rõ h&#7885; tên)</td>
 </tr>
 <tr height=21 style='height:15.75pt'>
  <td height=21 class=xl9216942 style='height:15.75pt'></td>
  <td class=xl9216942></td>
  <td class=xl9216942></td>
  <td class=xl9216942></td>
  <td class=xl9216942></td>
  <td class=xl9216942></td>
  <td class=xl9216942></td>
 </tr>
 <tr height=21 style='height:15.75pt'>
  <td height=21 class=xl9216942 style='height:15.75pt'></td>
  <td class=xl9216942></td>
  <td class=xl9216942></td>
  <td class=xl9216942></td>
  <td class=xl9216942></td>
  <td class=xl9216942></td>
  <td class=xl9216942></td>
 </tr>
 <tr height=21 style='height:15.75pt'>
  <td height=21 class=xl9216942 style='height:15.75pt'></td>
  <td class=xl9216942></td>
  <td class=xl9216942></td>
  <td class=xl9216942></td>
  <td class=xl9216942></td>
  <td class=xl9216942></td>
  <td class=xl9216942></td>
 </tr>
 <![if supportMisalignedColumns]>
 <tr height=0 style='display:none'>
  <td width=57 style='width:43pt'></td>
  <td width=140 style='width:105pt'></td>
  <td width=93 style='width:70pt'></td>
  <td width=88 style='width:66pt'></td>
  <td width=111 style='width:83pt'></td>
  <td width=106 style='width:80pt'></td>
  <td width=201 style='width:151pt'></td>
 </tr>
 <![endif]>
</table>

</div>


<!----------------------------->
<!--END OF OUTPUT FROM EXCEL PUBLISH AS WEB PAGE WIZARD-->
<!----------------------------->
</body>

</html>
