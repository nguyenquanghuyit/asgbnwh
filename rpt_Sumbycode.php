<html xmlns:o="urn:schemas-microsoft-com:office:office"
xmlns:x="urn:schemas-microsoft-com:office:excel"
xmlns="http://www.w3.org/TR/REC-html40">
<?php
header("Content-Type:   application/vnd.ms-excel; charset=utf-8");
header("Content-Disposition: attachment; filename=SumByCode_".date('d/m/Y').".xls");	
?>
<head>
<meta http-equiv=Content-Type content="text/html; charset=utf-8">
<meta name=ProgId content=Excel.Sheet>
<meta name=Generator content="Microsoft Excel 15">
<link rel=File-List href="rpt_Sumbycode_files/filelist.xml">
<style id="vwsumpcs_code_4864_Styles">
<!--
@keyframes spin{to{-ms-transform:rotate(1turn);transform:rotate(1turn)}}
@-webkit-keyframes spin{to{-ms-transform:rotate(1turn);transform:rotate(1turn)}}
@media(min-width:576px){.w-col-1{width:8.33333% !important}.w-col-2{width:16.66667% !important}.w-col-3{width:25% !important}.w-col-4{width:33.33333% !important}.w-col-5{width:41.66667% !important}.w-col-6{width:50% !important}.w-col-7{width:58.33333% !important}.w-col-8{width:66.66667% !important}.w-col-9{width:75% !important}.w-col-10{width:83.33333% !important}.w-col-11{width:91.66667% !important}.w-col-12{width:100% !important}.ew-grid{min-width:550px}.form-control{display:inline;max-width:none}.form-control:not(textarea){width:auto}.input-group>.form-control{width:auto;flex-grow:0}.input-group>.form-control.ew-lookup-text{width:20em}.ew-search-operator .form-control-plaintext{width:auto}input[type=text]:not([size]):not([name=pageno]):not(.cke_dialog_ui_input_text):not(.form-control-plaintext),input[type=password]:not([size]){min-width:250px}.ew-custom-select,.ew-custom-file{max-width:20em}ul.nav li.dropdown:hover>ul.dropdown-menu{display:block}.ew-auto-suggest{display:inline-block}.ew-upload-table{width:auto}.ew-editor,.mce-tinymce{width:auto !important}.modal-body .ew-editor,.modal-body .mce-tinymce{width:auto !important}.ew-form:not(.ew-list-form):not(.ew-pager-form),table.ew-master-table.ew-vertical{width:500px;margin-left:0}}
@media(min-width:576px) and (min-width:768px){.ew-form:not(.ew-list-form):not(.ew-pager-form),table.ew-master-table.ew-vertical{width:800px}}
@media(min-width:576px){.ew-detail-pages{display:table}.modal-dialog .ew-form{width:100% !important}.ew-login-box,.ew-forgot-pwd-box,.ew-change-pwd-box{width:360px}}
@media(max-width:575px){.ew-grid{display:block}.ew-grid .ew-grid-middle-panel{overflow-x:auto;overflow-y:visible}.ew-multicolumn-form>.ew-multi-column-row>div[class^=col-]:not(:last-child){margin-bottom:15px}.ew-add-opt-btn{margin-top:.375rem}.ew-auto-suggest{display:block}#ew-google-map{width:100% !important}.ew-desktop{display:block}.ew-desktop .ew-desktop-table{border:0}.ew-desktop .ew-desktop-table>tbody>tr>td{border:0;display:inline-block}.ew-desktop .ew-desktop-table>tbody>tr>td:first-of-type{text-align:inherit;padding-right:.75rem}.ew-desktop .ew-desktop-table>tbody>tr>td:last-of-type{display:block}.table-striped>tbody>tr:nth-child(odd),.table-striped>tbody>tr:nth-child(even),.table-striped>tbody>tr:nth-child(odd)>td,.table-striped>tbody>tr:nth-child(even)>td{background-color:transparent}}
@media(min-width:768px){#cookie-consent{transition:margin-left .3s ease-in-out;margin-left:250px}}
@media screen and (min-width:768px) and (prefers-reduced-motion:reduce){#cookie-consent{transition:none}}
@media(min-width:768px){.sidebar-collapse #cookie-consent{margin-left:0}}
@media(max-width:991.98px){#cookie-consent,#cookie-consent:before{margin-left:0}}
@font-face
	{src:url("fonts/ew.eot?#iefixt39no9") format("embedded-opentype"),url("fonts/ew.woff?t39no9") format("woff"),url("fonts/ew.ttf?t39no9") format("truetype"),url("fonts/ew.svg?t39no9#ew") format("svg");}
[class^="icon-"],[class*=" icon-"]{display:inline-block;font:normal normal normal 14px/1 'ew';font-size:inherit;text-rendering:auto;-webkit-font-smoothing:antialiased;-moz-osx-font-smoothing:grayscale}
:before{content:"\e608"}
:before{content:"\e60f"}
:before{content:"\e61c"}
:before{content:"\e609"}
:before{content:"\e61b"}
:before{content:"\e600"}
:before{content:"\e60c"}
:before{content:"\e614"}
:before{content:"\e619"}
:before{content:"\e606"}
:before{content:"\e61a"}
:before{content:"\e605"}
:before{content:"\e60d"}
:before{content:"\e612"}
:before{content:"\e60b"}
:before{content:"\e60a"}
:before{content:"\e610"}
:before{content:"\e60e"}
:before{content:"\f003"}
:before{content:"\f007"}
:before{content:"\f02f"}
:before{content:"\f040"}
:before{content:"\f045"}
:before{content:"\f046"}
:before{content:"\f0b0"}
:before{content:"\f0c5"}
:before{content:"\f0c9"}
:before{content:"\f0ce"}
:before{content:"\f100"}
:before{content:"\f101"}
:before{content:"\f104"}
:before{content:"\f105"}
:before{content:"\f147"}
:before{content:"\f196"}
:before{content:"\e611"}
:before{content:"\e613"}
:before{content:"\e601"}
:before{content:"\e602"}
:before{content:"\e603"}
:before{content:"\e604"}
:before{content:"\e607"}
:before{content:"\e615"}
:before{content:"\e616"}
:before{content:"\e617"}
:before{content:"\e618"}
body
	{font-size:.75rem;}
a:not(.btn) .icon-view,a:not(.btn) .icon-edit,a:not(.btn) .icon-inline-edit,a:not(.btn) .icon-copy,a:not(.btn) .icon-inline-copy,a:not(.btn) .fa-trash{display:inline-block}
a:not(.btn).ew-edit+a:not(.btn).ew-inline-edit,a:not(.btn).ew-copy+a:not(.btn).ew-inline-copy{padding-left:4px}
.INPUT-GROUP-PREPEND .EW-ICON
	{font-size:.75rem;
	width:.75rem;}
.INPUT-GROUP-APPEND .EW-ICON
	{font-size:.75rem;
	width:.75rem;}
.EW-DROPDOWN-CLEAR .EW-ICON
	{font-size:.75rem;
	width:.75rem;}
.dropdown-menu>li>a>.fa{margin-right:0}
.EW-TOOLBAR .EW-EXPORT-OPTION
	{margin-bottom:1rem;}
.EW-TOOLBAR .EW-IMPORT-OPTION
	{margin-bottom:1rem;}
.EW-TOOLBAR .EW-SEARCH-OPTION
	{margin-bottom:1rem;}
.EW-TOOLBAR .EW-ACTION-OPTION
	{margin-bottom:1rem;}
.EW-TOOLBAR .EW-DETAIL-OPTION
	{margin-bottom:1rem;}
.EW-TOOLBAR .EW-FILTER-OPTION
	{margin-bottom:1rem;}
.EW-DESKTOP .EW-DESKTOP-BUTTON
	{margin-bottom:1rem;}
.EW-DESKTOP .EW-DESKTOP-TABLE
	{min-width:300px;}
.ew-desktop .ew-desktop-table>thead>tr>th:first-of-type .checkbox,.ew-desktop .ew-desktop-table>tbody>tr>th:first-of-type .checkbox{margin-top:0;margin-bottom:0}
.ew-desktop .ew-desktop-table>thead>tr>td:first-of-type,.ew-desktop .ew-desktop-table>tbody>tr>td:first-of-type{text-align:right}
.ew-desktop .ew-desktop-table>thead>tr>td:first-of-type>span[id^=elh_],.ew-desktop .ew-desktop-table>tbody>tr>td:first-of-type>span[id^=elh_]{font-weight:bold;display:inline-block;margin-top:.75rem}
.ew-desktop .ew-desktop-table>thead>tr>td:first-of-type .checkbox,.ew-desktop .ew-desktop-table>tbody>tr>td:first-of-type .checkbox{margin-top:0;margin-bottom:0}
.ew-desktop .ew-desktop-table>thead>tr>td:first-of-type .checkbox label,.ew-desktop .ew-desktop-table>tbody>tr>td:first-of-type .checkbox label{font-weight:bold}
.ew-desktop .ew-desktop-table>thead>tr>td:nth-of-type(2):not(:last-of-type),.ew-desktop .ew-desktop-table>tbody>tr>td:nth-of-type(2):not(:last-of-type){text-align:right}
.ew-desktop .ew-desktop-table>thead>tr>td:nth-of-type(2):not(:last-of-type) .ew-search-operator,.ew-desktop .ew-desktop-table>tbody>tr>td:nth-of-type(2):not(:last-of-type) .ew-search-operator{margin-top:.75rem}
.ew-desktop .ew-desktop-table>thead>tr>th:last-of-type,.ew-desktop .ew-desktop-table>thead>tr>td:last-of-type,.ew-desktop .ew-desktop-table>tbody>tr>th:last-of-type,.ew-desktop .ew-desktop-table>tbody>tr>td:last-of-type{min-width:150px}
.EW-GRID .EW-TABLE
	{overflow-x:visible;}
.EW-GRID .EW-GRID-MIDDLE-PANEL
	{overflow-x:visible;}
.ew-form.ew-horizontal .ew-table .form-group{margin-left:0;margin-right:0}
.ew-search-panel>.card{display:table}
.ew-pager .input-group>input.form-control[name=pageno]{width:6em}
.ew-pager .ew-numeric-page>ul.pagination{margin-bottom:0}
.ew-grid-upper-panel.card-header,.ew-grid-lower-panel.card-footer{padding:.3rem;border-left:0;border-right:0;background-image:none;color:inherit}
.ew-grid-upper-panel.card-header .ew-pager-form,.ew-grid-lower-panel.card-footer .ew-pager-form{float:left}
.ew-grid-upper-panel.card-header .ew-pager,.ew-grid-lower-panel.card-footer .ew-pager{margin-bottom:0}
.ew-grid-upper-panel.card-header{background-color:#e7e7ff}
.ew-grid-lower-panel.card-footer{background-color:#e7e7ff}
button.EW-BTN
	{min-width:75px;}
a.EW-BTN
	{min-width:49px;}
:hover,.ew-dropdown-list .ew-dropdown-toggle:active,.ew-dropdown-list .ew-dropdown-toggle.hover{background-color:#fff}
:after{content:": "}
.EW-GRID .EW-TABLE
	{border-spacing:0;
	empty-cells:show;}
.EW-GRID .EW-TABLE\>TBODY\>TR\>TD
	{padding:.3rem;}
.EW-GRID .EW-TABLE\>TFOOT\>TR\>TD
	{padding:.3rem;}
.ew-grid .ew-table>thead>tr>td:last-child,.ew-grid .ew-table>thead>tr>th:last-child,.ew-grid .ew-table>tbody>tr>td:last-child,.ew-grid .ew-table>tfoot>tr>td:last-child,.ew-grid .ew-table td.ew-table-last-col,.ew-grid .ew-table th.ew-table-last-col{border-right:0}
.ew-grid .ew-table>tbody:last-child>tr:last-child>td,.ew-grid .ew-table>tfoot>tr:last-child>td,.ew-grid .ew-table td.ew-table-last-row{border-bottom:0}
.ew-grid .ew-table>tbody:last-child>tr:last-child>td.ew-table-border-bottom,.ew-grid .ew-table>tfoot>tr:last-child>td.ew-table-border-bottom,.ew-grid .ew-table td.ew-table-last-row.ew-table-border-bottom,.ew-grid .ew-table .ew-table-border-bottom{border-bottom:1px solid;border-color:silver}
.EW-GRID .EW-TABLE\>THEAD\>TR\>TH
	{padding:.3rem;}
.EW-GRID .EW-TABLE\>THEAD\>TR\>TD
	{padding:.3rem;}
.EW-GRID .EW-TABLE .EW-TABLE-ROW
	{color:inherit;}
.EW-GRID .EW-TABLE .EW-TABLE-ALT-ROW
	{color:inherit;}
.EW-GRID .EW-TABLE .EW-TABLE-EDIT-ROW\>TD
	{color:inherit;}
.EW-GRID .EW-TABLE .EW-TABLE-HIGHLIGHT-ROW\>TD
	{color:inherit;}
.EW-GRID .EW-TABLE .EW-TABLE-FOOTER
	{color:inherit;}
.ew-multi-column-form>.ew-multi-column-row{margin-bottom:1rem}
.ew-multi-column-form>.ew-multi-column-row>div[class^=col-]>.table{margin-bottom:0}
.ew-multi-column-form>.ew-multi-column-row>div[class^=col-]>.table .ew-table-header{width:33%}
.ew-list-option-body .btn-group>.btn{float:none}
.ew-list-option-body .ew-row-link:hover,.ew-list-option-body .ew-row-link:focus{text-decoration:none}
.ew-view-table>tbody>tr>td:first-child{font-weight:bold;text-align:right}
.EW-PREVIEW-LOWER-PANEL .EW-DETAIL-COUNT
	{margin-bottom:1rem;}
.EW-EXPORT-TABLE td
	{padding:.3rem;}
.ew-row:last-of-type{margin-bottom:0}
.EW-ROW .EW-CELL
	{margin-right:1rem;}
.MODAL .EW-SEARCH-COND
	{height:calc(1.875rem + 2px);}
.EW-SEARCH-COND label
	{display:inline-block;}
.EW-LINK-SEPARATOR .EW-ICON
	{display:inline-block;}
#EW-EMAIL-FORM #MESSAGE
	{max-width:100%;}
.EW-REPORT-TABLE td
	{padding:.2rem;}
.EW-ITEMS .EW-ITEM-TABLE
	{margin:0 .75rem .5rem .75rem;}
.EW-ITEMS .LIST-GROUP
	{margin-bottom:.25rem;
	box-shadow:none;}
.ew-items .list-group input[type=radio]{display:none}
.EW-ITEMS .LIST-GROUP .FORM-CHECK-LABEL
	{padding-top:.125rem;
	padding-bottom:.125rem;
	justify-content:left;}
.EW-ITEMS .LIST-GROUP .LIST-GROUP-ITEM
	{border-radius:0;}
.EW-ITEM-TABLE .D-TABLE-CELL
	{padding:.125rem .25rem;}
.EW-ITEM-TABLE .D-TABLE-CELL .FORM-CHECK
	{justify-content:left;}
.EW-UPLOAD-TABLE .PROGRESS
	{min-width:75px;}
.ew-label-row [id^=elh_],.ew-label-row .ew-search-caption{font-weight:bold}
:after{content:" "}
.table.ew-upload-table tbody:first-child tr:first-child td{border-top:0}
input.CKE\_DIALOG\_UI\_INPUT\_TEXT
	{min-height:1.5rem;}
.input-group .twitter-typeahead input[name^=sv_]{border-top-right-radius:0 !important;border-bottom-right-radius:0 !important}
.twitter-typeahead input[name^=sv_]{vertical-align:baseline !important}
.TT-SUGGESTION:hover
	{cursor:pointer;}
:before,.ew-spinner::after,.ew-spinner>div::before,.ew-spinner>div::after{content:"";position:absolute;top:0;left:2.25em;width:.5em;height:1.5em;border-radius:.2em;background:#eee;box-shadow:0 3.5em #eee;-webkit-transform-origin:50% 2.5em;-moz-transform-origin:50% 2.5em;-ms-transform-origin:50% 2.5em;transform-origin:50% 2.5em}
:before{background:#555}
:after{-ms-transform:rotate(-45deg);transform:rotate(-45deg);background:#777}
:before{-ms-transform:rotate(-90deg);transform:rotate(-90deg);background:#999}
:after{-ms-transform:rotate(-135deg);transform:rotate(-135deg);background:#bbb}
.EW-SCROLL-TABLE .EW-LIST-OPTION-BODY .EW-BTN-GROUP .EW-ICON
	{min-width:1rem;}
.dropdown-submenu:not(.active):hover>a,.dropdown-submenu:not(.active):focus>a{color:#16181b}
.dropdown-submenu>.dropdown-menu{top:0;left:100%;margin-top:-6px;margin-left:-1px;border-radius:0 .25rem .25rem .25rem}
.dropdown-submenu:hover>.dropdown-menu{display:block}
:after{display:block;content:" ";float:right;width:0;height:0;border-color:transparent;border-style:solid;border-width:5px 0 5px 5px;border-left-color:#ccc;margin-top:calc((0.75rem * 1.5 - 10px) / 2);margin-right:-10px}
.dropdown-submenu:hover>a::after{border-left-color:#16181b}
.dropdown-submenu.active:hover>a::after,.dropdown-submenu.active:focus>a::after{border-left-color:#fff}
.dropdown-submenu.float-left{float:none}
.dropdown-submenu.float-left>.dropdown-menu{left:-100%;margin-left:10px;border-radius:.25rem 0 .25rem .25rem}
.ew-change-pwd-box .ew-control.ew-password-strength{width:calc(100% - 1rem - 0.75rem * 2 - 1px * 2)}
.main-header .dropdown-item:hover,.main-header .dropdown-item:focus{color:#16181b !important}
.main-header .dropdown-item.active,.main-header .dropdown-item:active{color:#fff !important}
.main-header .dropdown-item.disabled,.main-header .dropdown-item:disabled{color:#6c757d !important}
.ew-option:not(:last-of-type)::after{content:", "}
div.EWJTABLE-BUSY-PANEL-BACKGROUND
	{opacity:.1;}
div.ewjtable-busy-panel-background.ewjtable-busy-panel-background-invisible{background-color:transparent}
div.ewjtable-main-container>div.ewjtable-bottom-panel span.ewjtable-goto-page{margin-left:5px}
div.ewjtable-main-container>div.ewjtable-bottom-panel span.ewjtable-goto-page input[type=text]{width:22px}
div.ewjtable-main-container>div.ewjtable-bottom-panel span.ewjtable-goto-page select{width:auto;display:inline-block}
div.EWJTABLE-MAIN-CONTAINER table.EWJTABLE thead th.EWJTABLE-COLUMN-HEADER-SORTABLE
	{cursor:pointer;}
#COOKIE-CONSENT
	{border-radius:0;}
#cookie-consent>.alert.alert-dismissible{border-radius:0;margin-bottom:0}
.navbar.bg-primary .nav-item.dropdown .btn-default{color:#444 !important}
.navbar.bg-secondary .nav-item.dropdown .btn-default{color:#444 !important}
.navbar.bg-success .nav-item.dropdown .btn-default{color:#444 !important}
.navbar.bg-info .nav-item.dropdown .btn-default{color:#444 !important}
.navbar.bg-warning .nav-item.dropdown .btn-default{color:#444 !important}
.navbar.bg-danger .nav-item.dropdown .btn-default{color:#444 !important}
.navbar.bg-light .nav-item.dropdown .btn-default{color:#444 !important}
.navbar.bg-dark .nav-item.dropdown .btn-default{color:#444 !important}
.sidebar-dark-primary .nav-sidebar .nav-item.menu-open:not(.active)>.nav-link{color:#fff;background-color:rgba(255,255,255,0.1)}
.sidebar-light-primary .nav-sidebar .nav-item.menu-open:not(.active)>.nav-link{color:#212529;background-color:#f4f4f5}
.sidebar-dark-secondary .nav-sidebar .nav-item.menu-open:not(.active)>.nav-link{color:#fff;background-color:rgba(255,255,255,0.1)}
.sidebar-light-secondary .nav-sidebar .nav-item.menu-open:not(.active)>.nav-link{color:#212529;background-color:#f4f4f5}
.sidebar-dark-success .nav-sidebar .nav-item.menu-open:not(.active)>.nav-link{color:#fff;background-color:rgba(255,255,255,0.1)}
.sidebar-light-success .nav-sidebar .nav-item.menu-open:not(.active)>.nav-link{color:#212529;background-color:#f4f4f5}
.sidebar-dark-info .nav-sidebar .nav-item.menu-open:not(.active)>.nav-link{color:#fff;background-color:rgba(255,255,255,0.1)}
.sidebar-light-info .nav-sidebar .nav-item.menu-open:not(.active)>.nav-link{color:#212529;background-color:#f4f4f5}
.sidebar-dark-warning .nav-sidebar .nav-item.menu-open:not(.active)>.nav-link{color:#fff;background-color:rgba(255,255,255,0.1)}
.sidebar-light-warning .nav-sidebar .nav-item.menu-open:not(.active)>.nav-link{color:#212529;background-color:#f4f4f5}
.sidebar-dark-danger .nav-sidebar .nav-item.menu-open:not(.active)>.nav-link{color:#fff;background-color:rgba(255,255,255,0.1)}
.sidebar-light-danger .nav-sidebar .nav-item.menu-open:not(.active)>.nav-link{color:#212529;background-color:#f4f4f5}
.sidebar-dark-light .nav-sidebar .nav-item.menu-open:not(.active)>.nav-link{color:#fff;background-color:rgba(255,255,255,0.1)}
.sidebar-light-light .nav-sidebar .nav-item.menu-open:not(.active)>.nav-link{color:#212529;background-color:#f4f4f5}
.sidebar-dark-dark .nav-sidebar .nav-item.menu-open:not(.active)>.nav-link{color:#fff;background-color:rgba(255,255,255,0.1)}
.sidebar-light-dark .nav-sidebar .nav-item.menu-open:not(.active)>.nav-link{color:#212529;background-color:#f4f4f5}
body[dir=rtl] .custom-select{background-position:left .75rem center}
body[dir=rtl] .popover{left:0;right:auto}
body[dir=rtl] .bs-popover-left{margin-right:.5rem;margin-left:0}
body[dir=rtl] .bs-popover-left .arrow{left:auto;right:calc((0.5rem + 1px) * -1)}
body[dir=rtl] .bs-popover-left .arrow::before,body[dir=rtl] .bs-popover-left .arrow::after{border-width:.5rem 0 .5rem .5rem}
body[dir=rtl] .bs-popover-left .arrow::before{right:0;border-left-color:rgba(17,17,17,0.25);left:auto;border-right-color:transparent}
body[dir=rtl] .bs-popover-left .arrow::after{right:1px;border-left-color:#fff;left:auto;border-right-color:transparent}
body[dir=rtl] .bs-popover-right{margin-left:.5rem;margin-right:0}
body[dir=rtl] .bs-popover-right .arrow{left:calc((0.5rem + 1px) * -1);right:auto}
body[dir=rtl] .bs-popover-right .arrow::before,body[dir=rtl] .bs-popover-right .arrow::after{border-width:.5rem .5rem .5rem 0}
body[dir=rtl] .bs-popover-right .arrow::before{left:0;border-right-color:rgba(17,17,17,0.25);right:auto;border-left-color:transparent}
body[dir=rtl] .bs-popover-right .arrow::after{left:1px;border-right-color:#fff;right:auto;border-left-color:transparent}
table
	{mso-displayed-decimal-separator:"\.";
	mso-displayed-thousand-separator:"\,";}
.xl634864
	{padding-top:1px;
	padding-right:1px;
	padding-left:1px;
	mso-ignore:padding;
	color:black;
	font-size:13.0pt;
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
.xl644864
	{padding-top:1px;
	padding-right:1px;
	padding-left:1px;
	mso-ignore:padding;
	color:black;
	font-size:13.0pt;
	font-weight:400;
	font-style:normal;
	text-decoration:none;
	font-family:"Times New Roman", serif;
	mso-font-charset:0;
	mso-number-format:General;
	text-align:general;
	vertical-align:bottom;
	border:1.0pt solid silver;
	background:#B4C6E7;
	mso-pattern:black none;
	white-space:normal;}
.xl654864
	{padding-top:1px;
	padding-right:1px;
	padding-left:1px;
	mso-ignore:padding;
	color:black;
	font-size:13.0pt;
	font-weight:400;
	font-style:normal;
	text-decoration:none;
	font-family:"Times New Roman", serif;
	mso-font-charset:0;
	mso-number-format:General;
	text-align:right;
	vertical-align:bottom;
	border:1.0pt solid silver;
	background:#B4C6E7;
	mso-pattern:black none;
	white-space:normal;}
.xl664864
	{padding-top:1px;
	padding-right:1px;
	padding-left:1px;
	mso-ignore:padding;
	color:white;
	font-size:13.0pt;
	font-weight:400;
	font-style:normal;
	text-decoration:none;
	font-family:"Times New Roman", serif;
	mso-font-charset:0;
	mso-number-format:General;
	text-align:center;
	vertical-align:middle;
	border:1.0pt solid silver;
	background:#3A8EBD;
	mso-pattern:black none;
	white-space:normal;}
.xl674864
	{padding-top:1px;
	padding-right:1px;
	padding-left:1px;
	mso-ignore:padding;
	color:black;
	font-size:13.0pt;
	font-weight:400;
	font-style:normal;
	text-decoration:none;
	font-family:"Times New Roman", serif;
	mso-font-charset:0;
	mso-number-format:General;
	text-align:center;
	vertical-align:middle;
	border:1.0pt solid silver;
	mso-background-source:auto;
	mso-pattern:auto;
	white-space:nowrap;}
.xl684864
	{padding-top:1px;
	padding-right:1px;
	padding-left:1px;
	mso-ignore:padding;
	color:black;
	font-size:13.0pt;
	font-weight:400;
	font-style:normal;
	text-decoration:none;
	font-family:"Times New Roman", serif;
	mso-font-charset:0;
	mso-number-format:General;
	text-align:general;
	vertical-align:middle;
	border:1.0pt solid silver;
	mso-background-source:auto;
	mso-pattern:auto;
	white-space:nowrap;}
.xl694864
	{padding-top:1px;
	padding-right:1px;
	padding-left:1px;
	mso-ignore:padding;
	color:black;
	font-size:13.0pt;
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

<div id="vwsumpcs_code_4864" align=center x:publishsource="Excel">

<table border=0 cellpadding=0 cellspacing=0 width=722 class=xl634864
 style='border-collapse:collapse;table-layout:fixed;width:542pt'>
 <col class=xl634864 width=45 style='mso-width-source:userset;mso-width-alt:
 1280;width:34pt'>
 <col class=xl634864 width=92 style='mso-width-source:userset;mso-width-alt:
 2616;width:69pt'>
 <col class=xl634864 width=298 style='mso-width-source:userset;mso-width-alt:
 8476;width:224pt'>
 <col class=xl634864 width=119 style='mso-width-source:userset;mso-width-alt:
 3384;width:89pt'>
 <col class=xl634864 width=71 style='mso-width-source:userset;mso-width-alt:
 2019;width:53pt'>
 <col class=xl634864 width=97 style='mso-width-source:userset;mso-width-alt:
 2759;width:73pt'>
 <tr height=34 style='mso-height-source:userset;height:25.5pt'>
  <td height=34 class=xl664864 width=45 style='height:25.5pt;width:34pt'>&nbsp;</td>
  <td class=xl664864 width=92 style='border-left:none;width:69pt'>Code</td>
  <td class=xl664864 width=298 style='border-left:none;width:224pt'>ProductName</td>
  <td class=xl664864 width=119 style='border-left:none;width:89pt'>Model</td>
  <td class=xl664864 width=71 style='border-left:none;width:53pt'>PCS</td>
  <td class=xl664864 width=97 style='border-left:none;width:73pt'>Pallet</td>
 </tr>
 <?php
include_once "mycnn.php";
$id=$_REQUEST["id"]; //id=2019,8,29C-95313,3885A001
$id=str_replace("on/","",$id);
$mang=explode("/",$id);

$stt=0;
$tongPCS=0;

for($x=0;$x<count($mang);$x++)
 {	
 	list($coce,$Pallet)=explode(",",$mang[$x]);
	$strTim="SELECT code,ProductName,Model,`SUM(ts.PCS)` AS pcs,Pallet FROM vwsumpcs_code v WHERE Code='".$coce."' and Pallet=".$Pallet;	
	//echo $strTim;
	$kq=mysqli_query($cnn,$strTim);
	$row=mysqli_fetch_assoc($kq);
	$stt+=1;

	$tongPCS+=$row["pcs"];
 ?>
 <tr class=xl694864 height=23 style='height:17.25pt'>
  <td height=23 class=xl674864 style='height:17.25pt;border-top:none'><?php echo $stt?></td>
  <td class=xl674864 style='border-top:none;border-left:none'><?php echo $row["code"]?></td>
  <td class=xl684864 style='border-top:none;border-left:none'><?php echo $row["ProductName"]?></td>
  <td class=xl684864 style='border-top:none;border-left:none'><?php echo $row["Model"]?></td>
  <td class=xl674864 style='border-top:none;border-left:none'><?php echo $row["pcs"]?></td>
  <td class=xl674864 style='border-top:none;border-left:none'><?php echo $row["Pallet"]?></td>
 </tr><?php }?>
 <tr class=xl634864 height=23 style='height:17.25pt'>
  <td height=23 class=xl644864 width=45 style='height:17.25pt;border-top:none;
  width:34pt'>&nbsp;</td>
  <td class=xl644864 width=92 style='border-top:none;border-left:none;
  width:69pt'>&nbsp;</td>
  <td class=xl644864 width=298 style='border-top:none;border-left:none;
  width:224pt'>&nbsp;</td>
  <td class=xl644864 width=119 style='border-top:none;border-left:none;
  width:89pt'>&nbsp;</td>
  <td class=xl654864 width=71 style='border-top:none;border-left:none;
  width:53pt'>Total: <?php echo $tongPCS?></td>
  <td class=xl644864 width=97 style='border-top:none;border-left:none;
  width:73pt'>&nbsp;</td>
 </tr>
 <![if supportMisalignedColumns]>
 <tr height=0 style='display:none'>
  <td width=45 style='width:34pt'></td>
  <td width=92 style='width:69pt'></td>
  <td width=298 style='width:224pt'></td>
  <td width=119 style='width:89pt'></td>
  <td width=71 style='width:53pt'></td>
  <td width=97 style='width:73pt'></td>
 </tr>
 <![endif]>
</table>

</div>


<!----------------------------->
<!--END OF OUTPUT FROM EXCEL PUBLISH AS WEB PAGE WIZARD-->
<!----------------------------->
</body>

</html>
