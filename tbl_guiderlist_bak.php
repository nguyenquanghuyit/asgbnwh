<?php
namespace PHPMaker2019\asgbn_wh;

// Session
if (session_status() !== PHP_SESSION_ACTIVE)
	session_start(); // Init session data

// Output buffering
ob_start(); 

// Autoload
include_once "autoload.php";
?>
<?php

// Write header
WriteHeader(FALSE);

// Create page object
$tbl_guider_list = new tbl_guider_list();

// Run the page
$tbl_guider_list->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$tbl_guider_list->Page_Render();
?>
<?php include_once "header.php" ?>
<?php if (!$tbl_guider->isExport()) { ?>
<script>

// Form object
currentPageID = ew.PAGE_ID = "list";
var ftbl_guiderlist = currentForm = new ew.Form("ftbl_guiderlist", "list");
ftbl_guiderlist.formKeyCountName = '<?php echo $tbl_guider_list->FormKeyCountName ?>';

// Validate form
ftbl_guiderlist.validate = function() {
	if (!this.validateRequired)
		return true; // Ignore validation
	var $ = jQuery, fobj = this.getForm(), $fobj = $(fobj);
	if ($fobj.find("#confirm").val() == "F")
		return true;
	var elm, felm, uelm, addcnt = 0;
	var $k = $fobj.find("#" + this.formKeyCountName); // Get key_count
	var rowcnt = ($k[0]) ? parseInt($k.val(), 10) : 1;
	var startcnt = (rowcnt == 0) ? 0 : 1; // Check rowcnt == 0 => Inline-Add
	var gridinsert = ["insert", "gridinsert"].includes($fobj.find("#action").val()) && $k[0];
	for (var i = startcnt; i <= rowcnt; i++) {
		var infix = ($k[0]) ? String(i) : "";
		$fobj.data("rowindex", infix);
		<?php if ($tbl_guider_list->Code->Required) { ?>
			elm = this.getElements("x" + infix + "_Code");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $tbl_guider->Code->caption(), $tbl_guider->Code->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($tbl_guider_list->ProductName->Required) { ?>
			elm = this.getElements("x" + infix + "_ProductName");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $tbl_guider->ProductName->caption(), $tbl_guider->ProductName->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($tbl_guider_list->PCS_Request->Required) { ?>
			elm = this.getElements("x" + infix + "_PCS_Request");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $tbl_guider->PCS_Request->caption(), $tbl_guider->PCS_Request->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($tbl_guider_list->ID_Location->Required) { ?>
			elm = this.getElements("x" + infix + "_ID_Location");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $tbl_guider->ID_Location->caption(), $tbl_guider->ID_Location->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($tbl_guider_list->PCS_In->Required) { ?>
			elm = this.getElements("x" + infix + "_PCS_In");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $tbl_guider->PCS_In->caption(), $tbl_guider->PCS_In->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($tbl_guider_list->PCS->Required) { ?>
			elm = this.getElements("x" + infix + "_PCS");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $tbl_guider->PCS->caption(), $tbl_guider->PCS->RequiredErrorMessage)) ?>");
		<?php } ?>
			elm = this.getElements("x" + infix + "_PCS");
			if (elm && !ew.checkInteger(elm.value))
				return this.onError(elm, "<?php echo JsEncode($tbl_guider->PCS->errorMessage()) ?>");
		<?php if ($tbl_guider_list->PalletID->Required) { ?>
			elm = this.getElements("x" + infix + "_PalletID");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $tbl_guider->PalletID->caption(), $tbl_guider->PalletID->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($tbl_guider_list->DateIn->Required) { ?>
			elm = this.getElements("x" + infix + "_DateIn");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $tbl_guider->DateIn->caption(), $tbl_guider->DateIn->RequiredErrorMessage)) ?>");
		<?php } ?>

			// Fire Form_CustomValidate event
			if (!this.Form_CustomValidate(fobj))
				return false;
	}
	return true;
}

// Form_CustomValidate event
ftbl_guiderlist.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

	// Your custom validation code here, return false if invalid.
	return true;
}

// Use JavaScript validation or not
ftbl_guiderlist.validateRequired = <?php echo json_encode(CLIENT_VALIDATE) ?>;

// Dynamic selection lists
ftbl_guiderlist.lists["x_ID_Location"] = <?php echo $tbl_guider_list->ID_Location->Lookup->toClientList() ?>;
ftbl_guiderlist.lists["x_ID_Location"].options = <?php echo JsonEncode($tbl_guider_list->ID_Location->lookupOptions()) ?>;
ftbl_guiderlist.autoSuggests["x_ID_Location"] = <?php echo json_encode(["data" => "ajax=autosuggest"]) ?>;

// Form object for search
</script>
<style type="text/css">
.ew-table-preview-row { /* main table preview row color */
	background-color: #FFFFFF; /* preview row color */
}
.ew-table-preview-row .ew-grid {
	display: table;
}
</style>
<div id="ew-preview" class="d-none"><!-- preview -->
	<div class="ew-nav-tabs"><!-- .ew-nav-tabs -->
		<ul class="nav nav-tabs"></ul>
		<div class="tab-content"><!-- .tab-content -->
			<div class="tab-pane fade active show"></div>
		</div><!-- /.tab-content -->
	</div><!-- /.ew-nav-tabs -->
</div><!-- /preview -->
<script src="phpjs/ewpreview.js"></script>
<script>
ew.PREVIEW_PLACEMENT = ew.CSS_FLIP ? "left" : "right";
ew.PREVIEW_SINGLE_ROW = false;
ew.PREVIEW_OVERLAY = false;
</script>
<script>

// Write your client script here, no need to add script tags.
</script>
<?php } ?>
<?php if (!$tbl_guider->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">

<div class="alert alert-warning" style="display: none;">
    Warning!
</div>

<?php if ($tbl_guider_list->TotalRecs > 0 && $tbl_guider_list->ExportOptions->visible()) { ?>
<?php $tbl_guider_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($tbl_guider_list->ImportOptions->visible()) { ?>
<?php $tbl_guider_list->ImportOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php if (!$tbl_guider->isExport() || EXPORT_MASTER_RECORD && $tbl_guider->isExport("print")) { ?>
<?php
if ($tbl_guider_list->DbMasterFilter <> "" && $tbl_guider->getCurrentMasterTable() == "vwmasterguide") {
	if ($tbl_guider_list->MasterRecordExists) {
		include_once "vwmasterguidemaster.php";
	}
}
?>
<?php } ?>
<?php
$tbl_guider_list->renderOtherOptions();
?>
<?php $tbl_guider_list->showPageHeader(); ?>
<?php
$tbl_guider_list->showMessage();
?>
<?php if ($tbl_guider_list->TotalRecs > 0 || $tbl_guider->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($tbl_guider_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> tbl_guider">
<?php if (!$tbl_guider->isExport()) { ?>
<div class="card-header ew-grid-upper-panel">
<?php if (!$tbl_guider->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php if (!isset($tbl_guider_list->Pager)) $tbl_guider_list->Pager = new PrevNextPager($tbl_guider_list->StartRec, $tbl_guider_list->DisplayRecs, $tbl_guider_list->TotalRecs, $tbl_guider_list->AutoHidePager) ?>
<?php if ($tbl_guider_list->Pager->RecordCount > 0 && $tbl_guider_list->Pager->Visible) { ?>
<div class="ew-pager">
<span><?php echo $Language->Phrase("Page") ?>&nbsp;</span>
<div class="ew-prev-next"><div class="input-group input-group-sm">
<div class="input-group-prepend">
<!-- first page button -->
	<?php if ($tbl_guider_list->Pager->FirstButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerFirst") ?>" href="<?php echo $tbl_guider_list->pageUrl() ?>start=<?php echo $tbl_guider_list->Pager->FirstButton->Start ?>"><i class="icon-first ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerFirst") ?>"><i class="icon-first ew-icon"></i></a>
	<?php } ?>
<!-- previous page button -->
	<?php if ($tbl_guider_list->Pager->PrevButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerPrevious") ?>" href="<?php echo $tbl_guider_list->pageUrl() ?>start=<?php echo $tbl_guider_list->Pager->PrevButton->Start ?>"><i class="icon-prev ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerPrevious") ?>"><i class="icon-prev ew-icon"></i></a>
	<?php } ?>
</div>
<!-- current page number -->
	<input class="form-control" type="text" name="<?php echo TABLE_PAGE_NO ?>" value="<?php echo $tbl_guider_list->Pager->CurrentPage ?>">
<div class="input-group-append">
<!-- next page button -->
	<?php if ($tbl_guider_list->Pager->NextButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerNext") ?>" href="<?php echo $tbl_guider_list->pageUrl() ?>start=<?php echo $tbl_guider_list->Pager->NextButton->Start ?>"><i class="icon-next ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerNext") ?>"><i class="icon-next ew-icon"></i></a>
	<?php } ?>
<!-- last page button -->
	<?php if ($tbl_guider_list->Pager->LastButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerLast") ?>" href="<?php echo $tbl_guider_list->pageUrl() ?>start=<?php echo $tbl_guider_list->Pager->LastButton->Start ?>"><i class="icon-last ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerLast") ?>"><i class="icon-last ew-icon"></i></a>
	<?php } ?>
</div>
</div>
</div>
<span>&nbsp;<?php echo $Language->Phrase("of") ?>&nbsp;<?php echo $tbl_guider_list->Pager->PageCount ?></span>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php if ($tbl_guider_list->Pager->RecordCount > 0) { ?>
<div class="ew-pager ew-rec">
	<span><?php echo $Language->Phrase("Record") ?>&nbsp;<?php echo $tbl_guider_list->Pager->FromIndex ?>&nbsp;<?php echo $Language->Phrase("To") ?>&nbsp;<?php echo $tbl_guider_list->Pager->ToIndex ?>&nbsp;<?php echo $Language->Phrase("Of") ?>&nbsp;<?php echo $tbl_guider_list->Pager->RecordCount ?></span>
</div>
<?php } ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $tbl_guider_list->OtherOptions->render("body") ?>
</div>
<?php 
	$id_Order=$_REQUEST["fk_ID_Order"];	
	$cnn=mysqli_connect("192.168.1.208","trantienhoa","abc@123","asgbn_wh",3306);
	$strCnn="SELECT SUM(`to`.PCS) pcs FROM tbl_orderdetail `to` WHERE `to`.ID_Order=".$id_Order;
	$rsYc=mysqli_query($cnn,$strCnn);
	$rowYc=mysqli_fetch_assoc($rsYc);	
?>
<input type="hidden" id="pcsYc" value="<?php echo $rowYc["pcs"]?>">
<a href="tbl_orderlist.php" class="float-xl-right btn btn-outline-danger">Back</a>
<div class="clearfix"></div>
</div>
<?php } ?>
<form name="ftbl_guiderlist" id="ftbl_guiderlist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($tbl_guider_list->CheckToken) { ?>
<input type="hidden" name="<?php echo TOKEN_NAME ?>" value="<?php echo $tbl_guider_list->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="tbl_guider">
<input type="hidden" name="exporttype" id="exporttype" value="">
<?php if ($tbl_guider->getCurrentMasterTable() == "vwmasterguide" && $tbl_guider->CurrentAction) { ?>
<input type="hidden" name="<?php echo TABLE_SHOW_MASTER ?>" value="vwmasterguide">
<input type="hidden" name="fk_ID_Order" value="<?php echo $tbl_guider->OrderNo->getSessionValue() ?>">
<?php } ?>
<div id="gmp_tbl_guider" class="<?php if (IsResponsiveLayout()) { ?>table-responsive <?php } ?>card-body ew-grid-middle-panel">
<?php if ($tbl_guider_list->TotalRecs > 0 || $tbl_guider->isGridEdit()) { ?>
<table id="tbl_tbl_guiderlist" class="table ew-table"><!-- .ew-table ##-->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$tbl_guider_list->RowType = ROWTYPE_HEADER;

// Render list options
$tbl_guider_list->renderListOptions();

// Render list options (header, left)
$tbl_guider_list->ListOptions->render("header", "left");
?>
<?php if ($tbl_guider->Code->Visible) { // Code ?>
	<?php if ($tbl_guider->sortUrl($tbl_guider->Code) == "") { ?>
		<th data-name="Code" class="<?php echo $tbl_guider->Code->headerCellClass() ?>" style="width: 100px; white-space: nowrap;"><div id="elh_tbl_guider_Code" class="tbl_guider_Code"><div class="ew-table-header-caption"><?php echo $tbl_guider->Code->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Code" class="<?php echo $tbl_guider->Code->headerCellClass() ?>" style="width: 100px; white-space: nowrap;"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $tbl_guider->SortUrl($tbl_guider->Code) ?>',2);"><div id="elh_tbl_guider_Code" class="tbl_guider_Code">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $tbl_guider->Code->caption() ?></span><span class="ew-table-header-sort"><?php if ($tbl_guider->Code->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($tbl_guider->Code->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($tbl_guider->ProductName->Visible) { // ProductName ?>
	<?php if ($tbl_guider->sortUrl($tbl_guider->ProductName) == "") { ?>
		<th data-name="ProductName" class="<?php echo $tbl_guider->ProductName->headerCellClass() ?>" style="width: 200px; white-space: nowrap;"><div id="elh_tbl_guider_ProductName" class="tbl_guider_ProductName"><div class="ew-table-header-caption"><?php echo $tbl_guider->ProductName->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="ProductName" class="<?php echo $tbl_guider->ProductName->headerCellClass() ?>" style="width: 200px; white-space: nowrap;"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $tbl_guider->SortUrl($tbl_guider->ProductName) ?>',2);"><div id="elh_tbl_guider_ProductName" class="tbl_guider_ProductName">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $tbl_guider->ProductName->caption() ?></span><span class="ew-table-header-sort"><?php if ($tbl_guider->ProductName->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($tbl_guider->ProductName->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($tbl_guider->PCS_Request->Visible) { // PCS_Request ?>
	<?php if ($tbl_guider->sortUrl($tbl_guider->PCS_Request) == "") { ?>
		<th data-name="PCS_Request" class="<?php echo $tbl_guider->PCS_Request->headerCellClass() ?>" style="width: 3px; white-space: nowrap;"><div id="elh_tbl_guider_PCS_Request" class="tbl_guider_PCS_Request"><div class="ew-table-header-caption"><?php echo $tbl_guider->PCS_Request->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="PCS_Request" class="<?php echo $tbl_guider->PCS_Request->headerCellClass() ?>" style="width: 3px; white-space: nowrap;"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $tbl_guider->SortUrl($tbl_guider->PCS_Request) ?>',2);"><div id="elh_tbl_guider_PCS_Request" class="tbl_guider_PCS_Request">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $tbl_guider->PCS_Request->caption() ?></span><span class="ew-table-header-sort"><?php if ($tbl_guider->PCS_Request->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($tbl_guider->PCS_Request->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($tbl_guider->ID_Location->Visible) { // ID_Location ?>
	<?php if ($tbl_guider->sortUrl($tbl_guider->ID_Location) == "") { ?>
		<th data-name="ID_Location" class="<?php echo $tbl_guider->ID_Location->headerCellClass() ?>" style="white-space: nowrap;"><div id="elh_tbl_guider_ID_Location" class="tbl_guider_ID_Location"><div class="ew-table-header-caption"><?php echo $tbl_guider->ID_Location->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="ID_Location" class="<?php echo $tbl_guider->ID_Location->headerCellClass() ?>" style="white-space: nowrap;"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $tbl_guider->SortUrl($tbl_guider->ID_Location) ?>',2);"><div id="elh_tbl_guider_ID_Location" class="tbl_guider_ID_Location">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $tbl_guider->ID_Location->caption() ?></span><span class="ew-table-header-sort"><?php if ($tbl_guider->ID_Location->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($tbl_guider->ID_Location->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($tbl_guider->PCS_In->Visible) { // PCS_In ?>
	<?php if ($tbl_guider->sortUrl($tbl_guider->PCS_In) == "") { ?>
		<th data-name="PCS_In" class="<?php echo $tbl_guider->PCS_In->headerCellClass() ?>" style="width: 3px; white-space: nowrap;"><div id="elh_tbl_guider_PCS_In" class="tbl_guider_PCS_In"><div class="ew-table-header-caption"><?php echo $tbl_guider->PCS_In->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="PCS_In" class="<?php echo $tbl_guider->PCS_In->headerCellClass() ?>" style="width: 3px; white-space: nowrap;"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $tbl_guider->SortUrl($tbl_guider->PCS_In) ?>',2);"><div id="elh_tbl_guider_PCS_In" class="tbl_guider_PCS_In">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $tbl_guider->PCS_In->caption() ?></span><span class="ew-table-header-sort"><?php if ($tbl_guider->PCS_In->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($tbl_guider->PCS_In->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($tbl_guider->PCS->Visible) { // PCS ?>
	<?php if ($tbl_guider->sortUrl($tbl_guider->PCS) == "") { ?>
		<th data-name="PCS" class="<?php echo $tbl_guider->PCS->headerCellClass() ?>" style="width: 3px; white-space: nowrap;"><div id="elh_tbl_guider_PCS" class="tbl_guider_PCS"><div class="ew-table-header-caption"><?php echo $tbl_guider->PCS->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="PCS" class="<?php echo $tbl_guider->PCS->headerCellClass() ?>" style="width: 3px; white-space: nowrap;"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $tbl_guider->SortUrl($tbl_guider->PCS) ?>',2);"><div id="elh_tbl_guider_PCS" class="tbl_guider_PCS">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $tbl_guider->PCS->caption() ?></span><span class="ew-table-header-sort"><?php if ($tbl_guider->PCS->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($tbl_guider->PCS->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($tbl_guider->PalletID->Visible) { // PalletID ?>
	<?php if ($tbl_guider->sortUrl($tbl_guider->PalletID) == "") { ?>
		<th data-name="PalletID" class="<?php echo $tbl_guider->PalletID->headerCellClass() ?>" style="white-space: nowrap;"><div id="elh_tbl_guider_PalletID" class="tbl_guider_PalletID"><div class="ew-table-header-caption"><?php echo $tbl_guider->PalletID->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="PalletID" class="<?php echo $tbl_guider->PalletID->headerCellClass() ?>" style="white-space: nowrap;"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $tbl_guider->SortUrl($tbl_guider->PalletID) ?>',2);"><div id="elh_tbl_guider_PalletID" class="tbl_guider_PalletID">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $tbl_guider->PalletID->caption() ?></span><span class="ew-table-header-sort"><?php if ($tbl_guider->PalletID->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($tbl_guider->PalletID->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($tbl_guider->DateIn->Visible) { // DateIn ?>
	<?php if ($tbl_guider->sortUrl($tbl_guider->DateIn) == "") { ?>
		<th data-name="DateIn" class="<?php echo $tbl_guider->DateIn->headerCellClass() ?>" style="white-space: nowrap;"><div id="elh_tbl_guider_DateIn" class="tbl_guider_DateIn"><div class="ew-table-header-caption"><?php echo $tbl_guider->DateIn->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="DateIn" class="<?php echo $tbl_guider->DateIn->headerCellClass() ?>" style="white-space: nowrap;"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $tbl_guider->SortUrl($tbl_guider->DateIn) ?>',2);"><div id="elh_tbl_guider_DateIn" class="tbl_guider_DateIn">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $tbl_guider->DateIn->caption() ?></span><span class="ew-table-header-sort"><?php if ($tbl_guider->DateIn->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($tbl_guider->DateIn->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$tbl_guider_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
if ($tbl_guider->ExportAll && $tbl_guider->isExport()) {
	$tbl_guider_list->StopRec = $tbl_guider_list->TotalRecs;
} else {

	// Set the last record to display
	if ($tbl_guider_list->TotalRecs > $tbl_guider_list->StartRec + $tbl_guider_list->DisplayRecs - 1)
		$tbl_guider_list->StopRec = $tbl_guider_list->StartRec + $tbl_guider_list->DisplayRecs - 1;
	else
		$tbl_guider_list->StopRec = $tbl_guider_list->TotalRecs;
}

// Restore number of post back records
if ($CurrentForm && $tbl_guider_list->EventCancelled) {
	$CurrentForm->Index = -1;
	if ($CurrentForm->hasValue($tbl_guider_list->FormKeyCountName) && ($tbl_guider->isGridAdd() || $tbl_guider->isGridEdit() || $tbl_guider->isConfirm())) {
		$tbl_guider_list->KeyCount = $CurrentForm->getValue($tbl_guider_list->FormKeyCountName);
		$tbl_guider_list->StopRec = $tbl_guider_list->StartRec + $tbl_guider_list->KeyCount - 1;
	}
}
$tbl_guider_list->RecCnt = $tbl_guider_list->StartRec - 1;
if ($tbl_guider_list->Recordset && !$tbl_guider_list->Recordset->EOF) {
	$tbl_guider_list->Recordset->moveFirst();
	$selectLimit = $tbl_guider_list->UseSelectLimit;
	if (!$selectLimit && $tbl_guider_list->StartRec > 1)
		$tbl_guider_list->Recordset->move($tbl_guider_list->StartRec - 1);
} elseif (!$tbl_guider->AllowAddDeleteRow && $tbl_guider_list->StopRec == 0) {
	$tbl_guider_list->StopRec = $tbl_guider->GridAddRowCount;
}

// Initialize aggregate
$tbl_guider->RowType = ROWTYPE_AGGREGATEINIT;
$tbl_guider->resetAttributes();
$tbl_guider_list->renderRow();
if ($tbl_guider->isGridEdit())
	$tbl_guider_list->RowIndex = 0;
while ($tbl_guider_list->RecCnt < $tbl_guider_list->StopRec) {
	$tbl_guider_list->RecCnt++;
	if ($tbl_guider_list->RecCnt >= $tbl_guider_list->StartRec) {
		$tbl_guider_list->RowCnt++;
		if ($tbl_guider->isGridAdd() || $tbl_guider->isGridEdit() || $tbl_guider->isConfirm()) {
			$tbl_guider_list->RowIndex++;
			$CurrentForm->Index = $tbl_guider_list->RowIndex;
			if ($CurrentForm->hasValue($tbl_guider_list->FormActionName) && $tbl_guider_list->EventCancelled)
				$tbl_guider_list->RowAction = strval($CurrentForm->getValue($tbl_guider_list->FormActionName));
			elseif ($tbl_guider->isGridAdd())
				$tbl_guider_list->RowAction = "insert";
			else
				$tbl_guider_list->RowAction = "";
		}

		// Set up key count
		$tbl_guider_list->KeyCount = $tbl_guider_list->RowIndex;

		// Init row class and style
		$tbl_guider->resetAttributes();
		$tbl_guider->CssClass = "";
		if ($tbl_guider->isGridAdd()) {
			$tbl_guider_list->loadRowValues(); // Load default values
		} else {
			$tbl_guider_list->loadRowValues($tbl_guider_list->Recordset); // Load row values
		}
		$tbl_guider->RowType = ROWTYPE_VIEW; // Render view
		if ($tbl_guider->isGridEdit()) { // Grid edit
			if ($tbl_guider->EventCancelled)
				$tbl_guider_list->restoreCurrentRowFormValues($tbl_guider_list->RowIndex); // Restore form values
			if ($tbl_guider_list->RowAction == "insert")
				$tbl_guider->RowType = ROWTYPE_ADD; // Render add
			else
				$tbl_guider->RowType = ROWTYPE_EDIT; // Render edit
		}
		if ($tbl_guider->isGridEdit() && ($tbl_guider->RowType == ROWTYPE_EDIT || $tbl_guider->RowType == ROWTYPE_ADD) && $tbl_guider->EventCancelled) // Update failed
			$tbl_guider_list->restoreCurrentRowFormValues($tbl_guider_list->RowIndex); // Restore form values
		if ($tbl_guider->RowType == ROWTYPE_EDIT) // Edit row
			$tbl_guider_list->EditRowCnt++;

		// Set up row id / data-rowindex
		$tbl_guider->RowAttrs = array_merge($tbl_guider->RowAttrs, array('data-rowindex'=>$tbl_guider_list->RowCnt, 'id'=>'r' . $tbl_guider_list->RowCnt . '_tbl_guider', 'data-rowtype'=>$tbl_guider->RowType));

		// Render row
		$tbl_guider_list->renderRow();

		// Render list options
		$tbl_guider_list->renderListOptions();

		// Skip delete row / empty row for confirm page
		if ($tbl_guider_list->RowAction <> "delete" && $tbl_guider_list->RowAction <> "insertdelete" && !($tbl_guider_list->RowAction == "insert" && $tbl_guider->isConfirm() && $tbl_guider_list->emptyRow())) {
?>
	<tr<?php echo $tbl_guider->rowAttributes() ?>>
<?php

// Render list options (body, left)
$tbl_guider_list->ListOptions->render("body", "left", $tbl_guider_list->RowCnt);
?>
	<?php if ($tbl_guider->Code->Visible) { // Code ?>
		<td data-name="Code"<?php echo $tbl_guider->Code->cellAttributes() ?>>
<?php if ($tbl_guider->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $tbl_guider_list->RowCnt ?>_tbl_guider_Code" class="form-group tbl_guider_Code">
<input type="text" data-table="tbl_guider" data-field="x_Code" name="x<?php echo $tbl_guider_list->RowIndex ?>_Code" id="x<?php echo $tbl_guider_list->RowIndex ?>_Code" size="30" maxlength="50" placeholder="<?php echo HtmlEncode($tbl_guider->Code->getPlaceHolder()) ?>" value="<?php echo $tbl_guider->Code->EditValue ?>"<?php echo $tbl_guider->Code->editAttributes() ?>>
</span>
<input type="hidden" data-table="tbl_guider" data-field="x_Code" name="o<?php echo $tbl_guider_list->RowIndex ?>_Code" id="o<?php echo $tbl_guider_list->RowIndex ?>_Code" value="<?php echo HtmlEncode($tbl_guider->Code->OldValue) ?>">
<?php } ?>
<?php if ($tbl_guider->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $tbl_guider_list->RowCnt ?>_tbl_guider_Code" class="form-group tbl_guider_Code">
<span<?php echo $tbl_guider->Code->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext myCode" value="<?php echo RemoveHtml($tbl_guider->Code->EditValue) ?>"></span>
</span>
<input type="hidden" data-table="tbl_guider" data-field="x_Code" name="x<?php echo $tbl_guider_list->RowIndex ?>_Code" id="x<?php echo $tbl_guider_list->RowIndex ?>_Code" value="<?php echo HtmlEncode($tbl_guider->Code->CurrentValue) ?>">
<?php } ?>
<?php if ($tbl_guider->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $tbl_guider_list->RowCnt ?>_tbl_guider_Code" class="tbl_guider_Code">
<span<?php echo $tbl_guider->Code->viewAttributes() ?>>
<?php echo $tbl_guider->Code->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
<?php if ($tbl_guider->RowType == ROWTYPE_ADD) { // Add record ?>
<input type="hidden" data-table="tbl_guider" data-field="x_ID" name="x<?php echo $tbl_guider_list->RowIndex ?>_ID" id="x<?php echo $tbl_guider_list->RowIndex ?>_ID" value="<?php echo HtmlEncode($tbl_guider->ID->CurrentValue) ?>">
<input type="hidden" data-table="tbl_guider" data-field="x_ID" name="o<?php echo $tbl_guider_list->RowIndex ?>_ID" id="o<?php echo $tbl_guider_list->RowIndex ?>_ID" value="<?php echo HtmlEncode($tbl_guider->ID->OldValue) ?>">
<?php } ?>
<?php if ($tbl_guider->RowType == ROWTYPE_EDIT || $tbl_guider->CurrentMode == "edit") { ?>
<input type="hidden" data-table="tbl_guider" data-field="x_ID" name="x<?php echo $tbl_guider_list->RowIndex ?>_ID" id="x<?php echo $tbl_guider_list->RowIndex ?>_ID" value="<?php echo HtmlEncode($tbl_guider->ID->CurrentValue) ?>">
<?php } ?>
	<?php if ($tbl_guider->ProductName->Visible) { // ProductName ?>
		<td data-name="ProductName"<?php echo $tbl_guider->ProductName->cellAttributes() ?>>
<?php if ($tbl_guider->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $tbl_guider_list->RowCnt ?>_tbl_guider_ProductName" class="form-group tbl_guider_ProductName">
<input type="text" data-table="tbl_guider" data-field="x_ProductName" name="x<?php echo $tbl_guider_list->RowIndex ?>_ProductName" id="x<?php echo $tbl_guider_list->RowIndex ?>_ProductName" size="100" maxlength="255" placeholder="<?php echo HtmlEncode($tbl_guider->ProductName->getPlaceHolder()) ?>" value="<?php echo $tbl_guider->ProductName->EditValue ?>"<?php echo $tbl_guider->ProductName->editAttributes() ?>>
</span>
<input type="hidden" data-table="tbl_guider" data-field="x_ProductName" name="o<?php echo $tbl_guider_list->RowIndex ?>_ProductName" id="o<?php echo $tbl_guider_list->RowIndex ?>_ProductName" value="<?php echo HtmlEncode($tbl_guider->ProductName->OldValue) ?>">
<?php } ?>
<?php if ($tbl_guider->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $tbl_guider_list->RowCnt ?>_tbl_guider_ProductName" class="form-group tbl_guider_ProductName">
<span<?php echo $tbl_guider->ProductName->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext codeName" value="<?php echo RemoveHtml($tbl_guider->ProductName->EditValue) ?>"></span>
</span>
<input type="hidden" data-table="tbl_guider" data-field="x_ProductName" name="x<?php echo $tbl_guider_list->RowIndex ?>_ProductName" id="x<?php echo $tbl_guider_list->RowIndex ?>_ProductName" value="<?php echo HtmlEncode($tbl_guider->ProductName->CurrentValue) ?>">
<?php } ?>
<?php if ($tbl_guider->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $tbl_guider_list->RowCnt ?>_tbl_guider_ProductName" class="tbl_guider_ProductName">
<span<?php echo $tbl_guider->ProductName->viewAttributes() ?>>
<?php echo $tbl_guider->ProductName->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($tbl_guider->PCS_Request->Visible) { // PCS_Request ?>
		<td data-name="PCS_Request"<?php echo $tbl_guider->PCS_Request->cellAttributes() ?>>
<?php if ($tbl_guider->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $tbl_guider_list->RowCnt ?>_tbl_guider_PCS_Request" class="form-group tbl_guider_PCS_Request">
<input type="text" data-table="tbl_guider" data-field="x_PCS_Request" name="x<?php echo $tbl_guider_list->RowIndex ?>_PCS_Request" id="x<?php echo $tbl_guider_list->RowIndex ?>_PCS_Request" size="3" placeholder="<?php echo HtmlEncode($tbl_guider->PCS_Request->getPlaceHolder()) ?>" value="<?php echo $tbl_guider->PCS_Request->EditValue ?>"<?php echo $tbl_guider->PCS_Request->editAttributes() ?>>
</span>
<input type="hidden" data-table="tbl_guider" data-field="x_PCS_Request" name="o<?php echo $tbl_guider_list->RowIndex ?>_PCS_Request" id="o<?php echo $tbl_guider_list->RowIndex ?>_PCS_Request" value="<?php echo HtmlEncode($tbl_guider->PCS_Request->OldValue) ?>">
<?php } ?>
<?php if ($tbl_guider->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $tbl_guider_list->RowCnt ?>_tbl_guider_PCS_Request" class="form-group tbl_guider_PCS_Request">
<span<?php echo $tbl_guider->PCS_Request->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext myPcsReq" value="<?php echo RemoveHtml($tbl_guider->PCS_Request->EditValue) ?>"></span>
</span>
<input type="hidden" data-table="tbl_guider" data-field="x_PCS_Request" name="x<?php echo $tbl_guider_list->RowIndex ?>_PCS_Request" id="x<?php echo $tbl_guider_list->RowIndex ?>_PCS_Request" value="<?php echo HtmlEncode($tbl_guider->PCS_Request->CurrentValue) ?>">
<?php } ?>
<?php if ($tbl_guider->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $tbl_guider_list->RowCnt ?>_tbl_guider_PCS_Request" class="tbl_guider_PCS_Request">
<span<?php echo $tbl_guider->PCS_Request->viewAttributes() ?>>
<?php echo $tbl_guider->PCS_Request->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($tbl_guider->ID_Location->Visible) { // ID_Location ?>
		<td data-name="ID_Location"<?php echo $tbl_guider->ID_Location->cellAttributes() ?>>
<?php if ($tbl_guider->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $tbl_guider_list->RowCnt ?>_tbl_guider_ID_Location" class="form-group tbl_guider_ID_Location">
<?php
$wrkonchange = "" . trim(@$tbl_guider->ID_Location->EditAttrs["onchange"]);
if (trim($wrkonchange) <> "") $wrkonchange = " onchange=\"" . JsEncode($wrkonchange) . "\"";
$tbl_guider->ID_Location->EditAttrs["onchange"] = "";
?>
<span id="as_x<?php echo $tbl_guider_list->RowIndex ?>_ID_Location" class="text-nowrap" style="z-index: <?php echo (9000 - $tbl_guider_list->RowCnt * 10) ?>">
	<input type="text" class="form-control" name="sv_x<?php echo $tbl_guider_list->RowIndex ?>_ID_Location" id="sv_x<?php echo $tbl_guider_list->RowIndex ?>_ID_Location" value="<?php echo RemoveHtml($tbl_guider->ID_Location->EditValue) ?>" size="15" placeholder="<?php echo HtmlEncode($tbl_guider->ID_Location->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($tbl_guider->ID_Location->getPlaceHolder()) ?>"<?php echo $tbl_guider->ID_Location->editAttributes() ?>>
</span>
<input type="hidden" data-table="tbl_guider" data-field="x_ID_Location" data-value-separator="<?php echo $tbl_guider->ID_Location->displayValueSeparatorAttribute() ?>" name="x<?php echo $tbl_guider_list->RowIndex ?>_ID_Location" id="x<?php echo $tbl_guider_list->RowIndex ?>_ID_Location" value="<?php echo HtmlEncode($tbl_guider->ID_Location->CurrentValue) ?>"<?php echo $wrkonchange ?>>
<script>
ftbl_guiderlist.createAutoSuggest({"id":"x<?php echo $tbl_guider_list->RowIndex ?>_ID_Location","forceSelect":true});
</script>
<?php echo $tbl_guider->ID_Location->Lookup->getParamTag("p_x" . $tbl_guider_list->RowIndex . "_ID_Location") ?>
</span>
<input type="hidden" data-table="tbl_guider" data-field="x_ID_Location" name="o<?php echo $tbl_guider_list->RowIndex ?>_ID_Location" id="o<?php echo $tbl_guider_list->RowIndex ?>_ID_Location" value="<?php echo HtmlEncode($tbl_guider->ID_Location->OldValue) ?>">
<?php } ?>
<?php if ($tbl_guider->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $tbl_guider_list->RowCnt ?>_tbl_guider_ID_Location" class="form-group tbl_guider_ID_Location">
<span<?php echo $tbl_guider->ID_Location->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?php echo RemoveHtml($tbl_guider->ID_Location->EditValue) ?>"></span>
</span>
<input type="hidden" data-table="tbl_guider" data-field="x_ID_Location" name="x<?php echo $tbl_guider_list->RowIndex ?>_ID_Location" id="x<?php echo $tbl_guider_list->RowIndex ?>_ID_Location" value="<?php echo HtmlEncode($tbl_guider->ID_Location->CurrentValue) ?>">
<?php } ?>
<?php if ($tbl_guider->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $tbl_guider_list->RowCnt ?>_tbl_guider_ID_Location" class="tbl_guider_ID_Location">
<span<?php echo $tbl_guider->ID_Location->viewAttributes() ?>>
<?php echo $tbl_guider->ID_Location->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($tbl_guider->PCS_In->Visible) { // PCS_In ?>
		<td data-name="PCS_In"<?php echo $tbl_guider->PCS_In->cellAttributes() ?>>
<?php if ($tbl_guider->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $tbl_guider_list->RowCnt ?>_tbl_guider_PCS_In" class="form-group tbl_guider_PCS_In">
<input type="text" data-table="tbl_guider" data-field="x_PCS_In" name="x<?php echo $tbl_guider_list->RowIndex ?>_PCS_In" id="x<?php echo $tbl_guider_list->RowIndex ?>_PCS_In" size="3" placeholder="<?php echo HtmlEncode($tbl_guider->PCS_In->getPlaceHolder()) ?>" value="<?php echo $tbl_guider->PCS_In->EditValue ?>"<?php echo $tbl_guider->PCS_In->editAttributes() ?>>
</span>
<input type="hidden" data-table="tbl_guider" data-field="x_PCS_In" name="o<?php echo $tbl_guider_list->RowIndex ?>_PCS_In" id="o<?php echo $tbl_guider_list->RowIndex ?>_PCS_In" value="<?php echo HtmlEncode($tbl_guider->PCS_In->OldValue) ?>">
<?php } ?>
<?php if ($tbl_guider->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $tbl_guider_list->RowCnt ?>_tbl_guider_PCS_In" class="form-group tbl_guider_PCS_In">
<span<?php echo $tbl_guider->PCS_In->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext pcsIn" value="<?php echo RemoveHtml($tbl_guider->PCS_In->EditValue) ?>"></span>
</span>
<input type="hidden" data-table="tbl_guider" data-field="x_PCS_In" name="x<?php echo $tbl_guider_list->RowIndex ?>_PCS_In" id="x<?php echo $tbl_guider_list->RowIndex ?>_PCS_In" value="<?php echo HtmlEncode($tbl_guider->PCS_In->CurrentValue) ?>">
<?php } ?>
<?php if ($tbl_guider->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $tbl_guider_list->RowCnt ?>_tbl_guider_PCS_In" class="tbl_guider_PCS_In">
<span<?php echo $tbl_guider->PCS_In->viewAttributes() ?>>
<?php echo $tbl_guider->PCS_In->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($tbl_guider->PCS->Visible) { // PCS ?>
		<td data-name="PCS"<?php echo $tbl_guider->PCS->cellAttributes() ?>>
<?php if ($tbl_guider->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $tbl_guider_list->RowCnt ?>_tbl_guider_PCS" class="form-group tbl_guider_PCS">
<input type="text" data-table="tbl_guider" data-field="x_PCS" name="x<?php echo $tbl_guider_list->RowIndex ?>_PCS" id="x<?php echo $tbl_guider_list->RowIndex ?>_PCS" size="3" placeholder="<?php echo HtmlEncode($tbl_guider->PCS->getPlaceHolder()) ?>" value="<?php echo $tbl_guider->PCS->EditValue ?>"<?php echo $tbl_guider->PCS->editAttributes() ?>>
</span>
<input type="hidden" data-table="tbl_guider" data-field="x_PCS" name="o<?php echo $tbl_guider_list->RowIndex ?>_PCS" id="o<?php echo $tbl_guider_list->RowIndex ?>_PCS" value="<?php echo HtmlEncode($tbl_guider->PCS->OldValue) ?>">
<?php } ?>
<?php if ($tbl_guider->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $tbl_guider_list->RowCnt ?>_tbl_guider_PCS" class="form-group tbl_guider_PCS">
<input class="pcsOut" onChange="tinhTong('<?php echo $tbl_guider->Code->EditValue ?>')" type="text" data-table="tbl_guider" data-field="x_PCS" name="x<?php echo $tbl_guider_list->RowIndex ?>_PCS" id="x<?php echo $tbl_guider_list->RowIndex ?>_PCS" size="3" placeholder="<?php echo HtmlEncode($tbl_guider->PCS->getPlaceHolder()) ?>" value="<?php echo $tbl_guider->PCS->EditValue ?>"<?php echo $tbl_guider->PCS->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($tbl_guider->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $tbl_guider_list->RowCnt ?>_tbl_guider_PCS" class="tbl_guider_PCS">
<span<?php echo $tbl_guider->PCS->viewAttributes() ?>>
<?php echo $tbl_guider->PCS->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($tbl_guider->PalletID->Visible) { // PalletID ?>
		<td data-name="PalletID"<?php echo $tbl_guider->PalletID->cellAttributes() ?>>
<?php if ($tbl_guider->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $tbl_guider_list->RowCnt ?>_tbl_guider_PalletID" class="form-group tbl_guider_PalletID">
<input type="text" data-table="tbl_guider" data-field="x_PalletID" name="x<?php echo $tbl_guider_list->RowIndex ?>_PalletID" id="x<?php echo $tbl_guider_list->RowIndex ?>_PalletID" size="15" placeholder="<?php echo HtmlEncode($tbl_guider->PalletID->getPlaceHolder()) ?>" value="<?php echo $tbl_guider->PalletID->EditValue ?>"<?php echo $tbl_guider->PalletID->editAttributes() ?>>
</span>
<input type="hidden" data-table="tbl_guider" data-field="x_PalletID" name="o<?php echo $tbl_guider_list->RowIndex ?>_PalletID" id="o<?php echo $tbl_guider_list->RowIndex ?>_PalletID" value="<?php echo HtmlEncode($tbl_guider->PalletID->OldValue) ?>">
<?php } ?>
<?php if ($tbl_guider->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $tbl_guider_list->RowCnt ?>_tbl_guider_PalletID" class="form-group tbl_guider_PalletID">
<span<?php echo $tbl_guider->PalletID->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?php echo RemoveHtml($tbl_guider->PalletID->EditValue) ?>"></span>
</span>
<input type="hidden" data-table="tbl_guider" data-field="x_PalletID" name="x<?php echo $tbl_guider_list->RowIndex ?>_PalletID" id="x<?php echo $tbl_guider_list->RowIndex ?>_PalletID" value="<?php echo HtmlEncode($tbl_guider->PalletID->CurrentValue) ?>">
<?php } ?>
<?php if ($tbl_guider->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $tbl_guider_list->RowCnt ?>_tbl_guider_PalletID" class="tbl_guider_PalletID">
<span<?php echo $tbl_guider->PalletID->viewAttributes() ?>>
<?php echo $tbl_guider->PalletID->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($tbl_guider->DateIn->Visible) { // DateIn ?>
		<td data-name="DateIn"<?php echo $tbl_guider->DateIn->cellAttributes() ?>>
<?php if ($tbl_guider->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $tbl_guider_list->RowCnt ?>_tbl_guider_DateIn" class="form-group tbl_guider_DateIn">
<input type="text" data-table="tbl_guider" data-field="x_DateIn" data-format="11" name="x<?php echo $tbl_guider_list->RowIndex ?>_DateIn" id="x<?php echo $tbl_guider_list->RowIndex ?>_DateIn" placeholder="<?php echo HtmlEncode($tbl_guider->DateIn->getPlaceHolder()) ?>" value="<?php echo $tbl_guider->DateIn->EditValue ?>"<?php echo $tbl_guider->DateIn->editAttributes() ?>>
</span>
<input type="hidden" data-table="tbl_guider" data-field="x_DateIn" name="o<?php echo $tbl_guider_list->RowIndex ?>_DateIn" id="o<?php echo $tbl_guider_list->RowIndex ?>_DateIn" value="<?php echo HtmlEncode($tbl_guider->DateIn->OldValue) ?>">
<?php } ?>
<?php if ($tbl_guider->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $tbl_guider_list->RowCnt ?>_tbl_guider_DateIn" class="form-group tbl_guider_DateIn">
<span<?php echo $tbl_guider->DateIn->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?php echo RemoveHtml($tbl_guider->DateIn->EditValue) ?>"></span>
</span>
<input type="hidden" data-table="tbl_guider" data-field="x_DateIn" name="x<?php echo $tbl_guider_list->RowIndex ?>_DateIn" id="x<?php echo $tbl_guider_list->RowIndex ?>_DateIn" value="<?php echo HtmlEncode($tbl_guider->DateIn->CurrentValue) ?>">
<?php } ?>
<?php if ($tbl_guider->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $tbl_guider_list->RowCnt ?>_tbl_guider_DateIn" class="tbl_guider_DateIn">
<span<?php echo $tbl_guider->DateIn->viewAttributes() ?>>
<?php echo $tbl_guider->DateIn->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$tbl_guider_list->ListOptions->render("body", "right", $tbl_guider_list->RowCnt);
?>
	</tr>
<?php if ($tbl_guider->RowType == ROWTYPE_ADD || $tbl_guider->RowType == ROWTYPE_EDIT) { ?>
<script>
ftbl_guiderlist.updateLists(<?php echo $tbl_guider_list->RowIndex ?>);
</script>
<?php } ?>
<?php
	}
	} // End delete row checking
	if (!$tbl_guider->isGridAdd())
		if (!$tbl_guider_list->Recordset->EOF)
			$tbl_guider_list->Recordset->moveNext();
}
?>
<?php
	if ($tbl_guider->isGridAdd() || $tbl_guider->isGridEdit()) {
		$tbl_guider_list->RowIndex = '$rowindex$';
		$tbl_guider_list->loadRowValues();

		// Set row properties
		$tbl_guider->resetAttributes();
		$tbl_guider->RowAttrs = array_merge($tbl_guider->RowAttrs, array('data-rowindex'=>$tbl_guider_list->RowIndex, 'id'=>'r0_tbl_guider', 'data-rowtype'=>ROWTYPE_ADD));
		AppendClass($tbl_guider->RowAttrs["class"], "ew-template");
		$tbl_guider->RowType = ROWTYPE_ADD;

		// Render row
		$tbl_guider_list->renderRow();

		// Render list options
		$tbl_guider_list->renderListOptions();
		$tbl_guider_list->StartRowCnt = 0;
?>
	<tr<?php echo $tbl_guider->rowAttributes() ?>>
<?php

// Render list options (body, left)
$tbl_guider_list->ListOptions->render("body", "left", $tbl_guider_list->RowIndex);
?>
	<?php if ($tbl_guider->Code->Visible) { // Code ?>
		<td data-name="Code">
<span id="el$rowindex$_tbl_guider_Code" class="form-group tbl_guider_Code">
<input type="text" data-table="tbl_guider" data-field="x_Code" name="x<?php echo $tbl_guider_list->RowIndex ?>_Code" id="x<?php echo $tbl_guider_list->RowIndex ?>_Code" size="30" maxlength="50" placeholder="<?php echo HtmlEncode($tbl_guider->Code->getPlaceHolder()) ?>" value="<?php echo $tbl_guider->Code->EditValue ?>"<?php echo $tbl_guider->Code->editAttributes() ?>>
</span>
<input type="hidden" data-table="tbl_guider" data-field="x_Code" name="o<?php echo $tbl_guider_list->RowIndex ?>_Code" id="o<?php echo $tbl_guider_list->RowIndex ?>_Code" value="<?php echo HtmlEncode($tbl_guider->Code->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($tbl_guider->ProductName->Visible) { // ProductName ?>
		<td data-name="ProductName">
<span id="el$rowindex$_tbl_guider_ProductName" class="form-group tbl_guider_ProductName">
<input type="text" data-table="tbl_guider" data-field="x_ProductName" name="x<?php echo $tbl_guider_list->RowIndex ?>_ProductName" id="x<?php echo $tbl_guider_list->RowIndex ?>_ProductName" size="100" maxlength="255" placeholder="<?php echo HtmlEncode($tbl_guider->ProductName->getPlaceHolder()) ?>" value="<?php echo $tbl_guider->ProductName->EditValue ?>"<?php echo $tbl_guider->ProductName->editAttributes() ?>>
</span>
<input type="hidden" data-table="tbl_guider" data-field="x_ProductName" name="o<?php echo $tbl_guider_list->RowIndex ?>_ProductName" id="o<?php echo $tbl_guider_list->RowIndex ?>_ProductName" value="<?php echo HtmlEncode($tbl_guider->ProductName->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($tbl_guider->PCS_Request->Visible) { // PCS_Request ?>
		<td data-name="PCS_Request">
<span id="el$rowindex$_tbl_guider_PCS_Request" class="form-group tbl_guider_PCS_Request">
<input type="text" data-table="tbl_guider" data-field="x_PCS_Request" name="x<?php echo $tbl_guider_list->RowIndex ?>_PCS_Request" id="x<?php echo $tbl_guider_list->RowIndex ?>_PCS_Request" size="3" placeholder="<?php echo HtmlEncode($tbl_guider->PCS_Request->getPlaceHolder()) ?>" value="<?php echo $tbl_guider->PCS_Request->EditValue ?>"<?php echo $tbl_guider->PCS_Request->editAttributes() ?>>
</span>
<input type="hidden" data-table="tbl_guider" data-field="x_PCS_Request" name="o<?php echo $tbl_guider_list->RowIndex ?>_PCS_Request" id="o<?php echo $tbl_guider_list->RowIndex ?>_PCS_Request" value="<?php echo HtmlEncode($tbl_guider->PCS_Request->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($tbl_guider->ID_Location->Visible) { // ID_Location ?>
		<td data-name="ID_Location">
<span id="el$rowindex$_tbl_guider_ID_Location" class="form-group tbl_guider_ID_Location">
<?php
$wrkonchange = "" . trim(@$tbl_guider->ID_Location->EditAttrs["onchange"]);
if (trim($wrkonchange) <> "") $wrkonchange = " onchange=\"" . JsEncode($wrkonchange) . "\"";
$tbl_guider->ID_Location->EditAttrs["onchange"] = "";
?>
<span id="as_x<?php echo $tbl_guider_list->RowIndex ?>_ID_Location" class="text-nowrap" style="z-index: <?php echo (9000 - $tbl_guider_list->RowCnt * 10) ?>">
	<input type="text" class="form-control" name="sv_x<?php echo $tbl_guider_list->RowIndex ?>_ID_Location" id="sv_x<?php echo $tbl_guider_list->RowIndex ?>_ID_Location" value="<?php echo RemoveHtml($tbl_guider->ID_Location->EditValue) ?>" size="15" placeholder="<?php echo HtmlEncode($tbl_guider->ID_Location->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($tbl_guider->ID_Location->getPlaceHolder()) ?>"<?php echo $tbl_guider->ID_Location->editAttributes() ?>>
</span>
<input type="hidden" data-table="tbl_guider" data-field="x_ID_Location" data-value-separator="<?php echo $tbl_guider->ID_Location->displayValueSeparatorAttribute() ?>" name="x<?php echo $tbl_guider_list->RowIndex ?>_ID_Location" id="x<?php echo $tbl_guider_list->RowIndex ?>_ID_Location" value="<?php echo HtmlEncode($tbl_guider->ID_Location->CurrentValue) ?>"<?php echo $wrkonchange ?>>
<script>
ftbl_guiderlist.createAutoSuggest({"id":"x<?php echo $tbl_guider_list->RowIndex ?>_ID_Location","forceSelect":true});
</script>
<?php echo $tbl_guider->ID_Location->Lookup->getParamTag("p_x" . $tbl_guider_list->RowIndex . "_ID_Location") ?>
</span>
<input type="hidden" data-table="tbl_guider" data-field="x_ID_Location" name="o<?php echo $tbl_guider_list->RowIndex ?>_ID_Location" id="o<?php echo $tbl_guider_list->RowIndex ?>_ID_Location" value="<?php echo HtmlEncode($tbl_guider->ID_Location->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($tbl_guider->PCS_In->Visible) { // PCS_In ?>
		<td data-name="PCS_In">
<span id="el$rowindex$_tbl_guider_PCS_In" class="form-group tbl_guider_PCS_In">
<input type="text" data-table="tbl_guider" data-field="x_PCS_In" name="x<?php echo $tbl_guider_list->RowIndex ?>_PCS_In" id="x<?php echo $tbl_guider_list->RowIndex ?>_PCS_In" size="3" placeholder="<?php echo HtmlEncode($tbl_guider->PCS_In->getPlaceHolder()) ?>" value="<?php echo $tbl_guider->PCS_In->EditValue ?>"<?php echo $tbl_guider->PCS_In->editAttributes() ?>>
</span>
<input type="hidden" data-table="tbl_guider" data-field="x_PCS_In" name="o<?php echo $tbl_guider_list->RowIndex ?>_PCS_In" id="o<?php echo $tbl_guider_list->RowIndex ?>_PCS_In" value="<?php echo HtmlEncode($tbl_guider->PCS_In->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($tbl_guider->PCS->Visible) { // PCS ?>
		<td data-name="PCS">
<span id="el$rowindex$_tbl_guider_PCS" class="form-group tbl_guider_PCS">
<input type="text" data-table="tbl_guider" data-field="x_PCS" name="x<?php echo $tbl_guider_list->RowIndex ?>_PCS" id="x<?php echo $tbl_guider_list->RowIndex ?>_PCS" size="3" placeholder="<?php echo HtmlEncode($tbl_guider->PCS->getPlaceHolder()) ?>" value="<?php echo $tbl_guider->PCS->EditValue ?>"<?php echo $tbl_guider->PCS->editAttributes() ?>>
</span>
<input type="hidden" data-table="tbl_guider" data-field="x_PCS" name="o<?php echo $tbl_guider_list->RowIndex ?>_PCS" id="o<?php echo $tbl_guider_list->RowIndex ?>_PCS" value="<?php echo HtmlEncode($tbl_guider->PCS->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($tbl_guider->PalletID->Visible) { // PalletID ?>
		<td data-name="PalletID">
<span id="el$rowindex$_tbl_guider_PalletID" class="form-group tbl_guider_PalletID">
<input type="text" data-table="tbl_guider" data-field="x_PalletID" name="x<?php echo $tbl_guider_list->RowIndex ?>_PalletID" id="x<?php echo $tbl_guider_list->RowIndex ?>_PalletID" size="15" placeholder="<?php echo HtmlEncode($tbl_guider->PalletID->getPlaceHolder()) ?>" value="<?php echo $tbl_guider->PalletID->EditValue ?>"<?php echo $tbl_guider->PalletID->editAttributes() ?>>
</span>
<input type="hidden" data-table="tbl_guider" data-field="x_PalletID" name="o<?php echo $tbl_guider_list->RowIndex ?>_PalletID" id="o<?php echo $tbl_guider_list->RowIndex ?>_PalletID" value="<?php echo HtmlEncode($tbl_guider->PalletID->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($tbl_guider->DateIn->Visible) { // DateIn ?>
		<td data-name="DateIn">
<span id="el$rowindex$_tbl_guider_DateIn" class="form-group tbl_guider_DateIn">
<input type="text" data-table="tbl_guider" data-field="x_DateIn" data-format="11" name="x<?php echo $tbl_guider_list->RowIndex ?>_DateIn" id="x<?php echo $tbl_guider_list->RowIndex ?>_DateIn" placeholder="<?php echo HtmlEncode($tbl_guider->DateIn->getPlaceHolder()) ?>" value="<?php echo $tbl_guider->DateIn->EditValue ?>"<?php echo $tbl_guider->DateIn->editAttributes() ?>>
</span>
<input type="hidden" data-table="tbl_guider" data-field="x_DateIn" name="o<?php echo $tbl_guider_list->RowIndex ?>_DateIn" id="o<?php echo $tbl_guider_list->RowIndex ?>_DateIn" value="<?php echo HtmlEncode($tbl_guider->DateIn->OldValue) ?>">
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$tbl_guider_list->ListOptions->render("body", "right", $tbl_guider_list->RowIndex);
?>
<script>
ftbl_guiderlist.updateLists(<?php echo $tbl_guider_list->RowIndex ?>);
</script>
	</tr>
<?php
}
?>
</tbody>
</table><!-- /.ew-table -->
<?php } ?>
<?php if ($tbl_guider->isGridEdit()) { ?>
<input type="hidden" name="action" id="action" value="gridupdate">
<input type="hidden" name="<?php echo $tbl_guider_list->FormKeyCountName ?>" id="<?php echo $tbl_guider_list->FormKeyCountName ?>" value="<?php echo $tbl_guider_list->KeyCount ?>">
<?php echo $tbl_guider_list->MultiSelectKey ?>
<?php } ?>
<?php if (!$tbl_guider->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</div><!-- /.ew-grid-middle-panel -->
</form><!-- /.ew-list-form -->
<script type="text/javascript">
	function tinhTong(crrCode)
	{
		var tong=0; //tong out
		var tongTon=0; // tong instock
		var tongPcs=$("#pcsYc").value();
		
		var mangTongPCS=[];
		$(".pcsOut").each(function(i, el){
			var elem = $(el);
			mangTongPCS.push(elem.value());
			tong+=parseInt(elem.value());
		});		
				
		// compare pcs in with pcs out
		$(".pcsIn").each(function(i, el){
			var elem = $(el);				
			var i_ii=$(".pcsIn:eq("+i+")");
				i_ii.css("text-align","center");
				i_ii.css("font-weight","bold");
				
			tongTon+=parseInt(elem.value());
		});	
		

		var allVals = [];
		$(".orderNo").each(function(i, el){	
			var elem = $(el);			
		  	allVals.push(elem.value());														   
	   	});
		for(var i=0;i<allVals.length-1;i++)
		  {
			  for(var j=i+1;j<allVals.length;j++){
			  	if(allVals[i]==allVals[j])
					{
						var i_i=$(".orderNo:eq("+j+")"); //td:eq( 2 )"
						i_i.css("display","none");
					}
				}
		  }		
			  
		//myCode
		var allCode = [];
		$(".myCode").each(function(i, el){	
			var elem = $(el);			
		  	allCode.push(elem.value());														   
	   	});
		for(var i=0;i<allCode.length-1;i++)
		  {
			  for(var j=i+1;j<allCode.length;j++){
			  	if(allCode[i]==allCode[j])
					{
						var i_i=$(".myCode:eq("+j+")"); //td:eq( 2 )"
						i_i.css("display","none");
					}
				}
			  }	
		
		//Product name
		var allProduct = [];
		$(".codeName").each(function(i, el){	
			var elem = $(el);			
		  	allProduct.push(elem.value());														   
	   	});
		for(var i=0;i<allProduct.length-1;i++)
		  {
			  for(var j=i+1;j<allProduct.length;j++){
			  	if((allProduct[i]==allProduct[j]) && (allCode[i]==allCode[j]))
					{
						var i_i=$(".codeName:eq("+j+")"); //td:eq( 2 )"
						i_i.css("display","none");
					}
				}
		}	
			  
		// myPcsReq
		var allPcs = [];
		$(".myPcsReq").each(function(i, el){	
			var elem = $(el);			
		  	allPcs.push(elem.value());														   
	   	});
					  
		for(var i=0;i<allCode.length;i++)
		  {
				var j=i+1;
				var i_ii=$(".myPcsReq:eq("+i+")");
				i_ii.css("text-align","center");
				i_ii.css("font-weight","bold");
						
			  	if((allPcs[i]==allPcs[j]) && (allCode[i]==allCode[j]))
					{
						var i_j=$(".myPcsReq:eq("+j+")"); //td:eq( 2 )"
						i_j.css("display","none");							
						
					}	
				
			  }			  
			  
			  
		// ------------- ADD more
		var tongOutCode=0;
		var tongOutReq=0;
		var kqPcsReq=0;
		var stt=0;
		for(var k=0;k<allCode.length;k++)
		{			
			if(allCode[k]==crrCode)
			{	stt++;
				tongOutCode+=parseInt(mangTongPCS[k]);	
				tongOutReq+=parseInt(allPcs[k]);
			}
		}
		kqPcsReq=parseInt(tongOutReq/stt);
		
		if(tongTon<tong){
			$(".pcsOut").first().focus();
			$(".alert-warning").css('display','');
			$(".alert-warning").html('PCS Out ('+tong+') > PCS Instock ('+tongTon+')');
		}		
		else if(tongOutCode>kqPcsReq)
		{
			$(".alert-warning").css('display','');
			$(".alert-warning").html('PCS Out ('+tongOutCode+') > PCS Request ('+kqPcsReq+')');
			$(".pcsOut").first().focus();;
		}
		else if(tongOutCode<kqPcsReq)
		{
			$(".alert-warning").css('display','');
			$(".alert-warning").html('PCS Out ('+tongOutCode+') < PCS Request ('+kqPcsReq+')');
			$(".pcsOut").first().focus();
		}
		else
		{
			$(".alert-warning").css('display','none');
		}
	}
	
	$(document).ready(function(){
		tinhTong();
	});
</script>
<?php

// Close recordset
if ($tbl_guider_list->Recordset)
	$tbl_guider_list->Recordset->Close();
?>
<?php if (!$tbl_guider->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$tbl_guider->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php if (!isset($tbl_guider_list->Pager)) $tbl_guider_list->Pager = new PrevNextPager($tbl_guider_list->StartRec, $tbl_guider_list->DisplayRecs, $tbl_guider_list->TotalRecs, $tbl_guider_list->AutoHidePager) ?>
<?php if ($tbl_guider_list->Pager->RecordCount > 0 && $tbl_guider_list->Pager->Visible) { ?>
<div class="ew-pager">
<span><?php echo $Language->Phrase("Page") ?>&nbsp;</span>
<div class="ew-prev-next"><div class="input-group input-group-sm">
<div class="input-group-prepend">
<!-- first page button -->
	<?php if ($tbl_guider_list->Pager->FirstButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerFirst") ?>" href="<?php echo $tbl_guider_list->pageUrl() ?>start=<?php echo $tbl_guider_list->Pager->FirstButton->Start ?>"><i class="icon-first ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerFirst") ?>"><i class="icon-first ew-icon"></i></a>
	<?php } ?>
<!-- previous page button -->
	<?php if ($tbl_guider_list->Pager->PrevButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerPrevious") ?>" href="<?php echo $tbl_guider_list->pageUrl() ?>start=<?php echo $tbl_guider_list->Pager->PrevButton->Start ?>"><i class="icon-prev ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerPrevious") ?>"><i class="icon-prev ew-icon"></i></a>
	<?php } ?>
</div>
<!-- current page number -->
	<input class="form-control" type="text" name="<?php echo TABLE_PAGE_NO ?>" value="<?php echo $tbl_guider_list->Pager->CurrentPage ?>">
<div class="input-group-append">
<!-- next page button -->
	<?php if ($tbl_guider_list->Pager->NextButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerNext") ?>" href="<?php echo $tbl_guider_list->pageUrl() ?>start=<?php echo $tbl_guider_list->Pager->NextButton->Start ?>"><i class="icon-next ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerNext") ?>"><i class="icon-next ew-icon"></i></a>
	<?php } ?>
<!-- last page button -->
	<?php if ($tbl_guider_list->Pager->LastButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerLast") ?>" href="<?php echo $tbl_guider_list->pageUrl() ?>start=<?php echo $tbl_guider_list->Pager->LastButton->Start ?>"><i class="icon-last ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerLast") ?>"><i class="icon-last ew-icon"></i></a>
	<?php } ?>
</div>
</div>
</div>
<span>&nbsp;<?php echo $Language->Phrase("of") ?>&nbsp;<?php echo $tbl_guider_list->Pager->PageCount ?></span>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php if ($tbl_guider_list->Pager->RecordCount > 0) { ?>
<div class="ew-pager ew-rec">
	<span><?php echo $Language->Phrase("Record") ?>&nbsp;<?php echo $tbl_guider_list->Pager->FromIndex ?>&nbsp;<?php echo $Language->Phrase("To") ?>&nbsp;<?php echo $tbl_guider_list->Pager->ToIndex ?>&nbsp;<?php echo $Language->Phrase("Of") ?>&nbsp;<?php echo $tbl_guider_list->Pager->RecordCount ?></span>
</div>
<?php } ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $tbl_guider_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($tbl_guider_list->TotalRecs == 0 && !$tbl_guider->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $tbl_guider_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$tbl_guider_list->showPageFooter();
if (DEBUG_ENABLED)
	echo GetDebugMessage();
?>
<?php if (!$tbl_guider->isExport()) { ?>
<script>

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php } ?>
<?php include_once "footer.php" ?>
<?php
$tbl_guider_list->terminate();
?>