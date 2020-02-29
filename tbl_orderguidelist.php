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
$tbl_orderguide_list = new tbl_orderguide_list();

// Run the page
$tbl_orderguide_list->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$tbl_orderguide_list->Page_Render();
?>
<?php include_once "header.php" ?>
<?php if (!$tbl_orderguide->isExport()) { ?>
<script>

// Form object
currentPageID = ew.PAGE_ID = "list";
var ftbl_orderguidelist = currentForm = new ew.Form("ftbl_orderguidelist", "list");
ftbl_orderguidelist.formKeyCountName = '<?php echo $tbl_orderguide_list->FormKeyCountName ?>';

// Form_CustomValidate event
ftbl_orderguidelist.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

	// Your custom validation code here, return false if invalid.
	return true;
}

// Use JavaScript validation or not
ftbl_orderguidelist.validateRequired = <?php echo json_encode(CLIENT_VALIDATE) ?>;

// Dynamic selection lists
ftbl_orderguidelist.lists["x_ID_Location"] = <?php echo $tbl_orderguide_list->ID_Location->Lookup->toClientList() ?>;
ftbl_orderguidelist.lists["x_ID_Location"].options = <?php echo JsonEncode($tbl_orderguide_list->ID_Location->lookupOptions()) ?>;
ftbl_orderguidelist.autoSuggests["x_ID_Location"] = <?php echo json_encode(["data" => "ajax=autosuggest"]) ?>;

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
<?php if (!$tbl_orderguide->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($tbl_orderguide_list->TotalRecs > 0 && $tbl_orderguide_list->ExportOptions->visible()) { ?>
<?php $tbl_orderguide_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($tbl_orderguide_list->ImportOptions->visible()) { ?>
<?php $tbl_orderguide_list->ImportOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php if (!$tbl_orderguide->isExport() || EXPORT_MASTER_RECORD && $tbl_orderguide->isExport("print")) { ?>
<?php
if ($tbl_orderguide_list->DbMasterFilter <> "" && $tbl_orderguide->getCurrentMasterTable() == "tbl_order") {
	if ($tbl_orderguide_list->MasterRecordExists) {
		include_once "tbl_ordermaster.php";
	}
}
?>
<?php } ?>
<?php
$tbl_orderguide_list->renderOtherOptions();
?>
<?php $tbl_orderguide_list->showPageHeader(); ?>
<?php
$tbl_orderguide_list->showMessage();
?>
<?php if ($tbl_orderguide_list->TotalRecs > 0 || $tbl_orderguide->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($tbl_orderguide_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> tbl_orderguide">
<?php if (!$tbl_orderguide->isExport()) { ?>
<div class="card-header ew-grid-upper-panel">
<?php if (!$tbl_orderguide->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php if (!isset($tbl_orderguide_list->Pager)) $tbl_orderguide_list->Pager = new PrevNextPager($tbl_orderguide_list->StartRec, $tbl_orderguide_list->DisplayRecs, $tbl_orderguide_list->TotalRecs, $tbl_orderguide_list->AutoHidePager) ?>
<?php if ($tbl_orderguide_list->Pager->RecordCount > 0 && $tbl_orderguide_list->Pager->Visible) { ?>
<div class="ew-pager">
<span><?php echo $Language->Phrase("Page") ?>&nbsp;</span>
<div class="ew-prev-next"><div class="input-group input-group-sm">
<div class="input-group-prepend">
<!-- first page button -->
	<?php if ($tbl_orderguide_list->Pager->FirstButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerFirst") ?>" href="<?php echo $tbl_orderguide_list->pageUrl() ?>start=<?php echo $tbl_orderguide_list->Pager->FirstButton->Start ?>"><i class="icon-first ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerFirst") ?>"><i class="icon-first ew-icon"></i></a>
	<?php } ?>
<!-- previous page button -->
	<?php if ($tbl_orderguide_list->Pager->PrevButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerPrevious") ?>" href="<?php echo $tbl_orderguide_list->pageUrl() ?>start=<?php echo $tbl_orderguide_list->Pager->PrevButton->Start ?>"><i class="icon-prev ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerPrevious") ?>"><i class="icon-prev ew-icon"></i></a>
	<?php } ?>
</div>
<!-- current page number -->
	<input class="form-control" type="text" name="<?php echo TABLE_PAGE_NO ?>" value="<?php echo $tbl_orderguide_list->Pager->CurrentPage ?>">
<div class="input-group-append">
<!-- next page button -->
	<?php if ($tbl_orderguide_list->Pager->NextButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerNext") ?>" href="<?php echo $tbl_orderguide_list->pageUrl() ?>start=<?php echo $tbl_orderguide_list->Pager->NextButton->Start ?>"><i class="icon-next ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerNext") ?>"><i class="icon-next ew-icon"></i></a>
	<?php } ?>
<!-- last page button -->
	<?php if ($tbl_orderguide_list->Pager->LastButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerLast") ?>" href="<?php echo $tbl_orderguide_list->pageUrl() ?>start=<?php echo $tbl_orderguide_list->Pager->LastButton->Start ?>"><i class="icon-last ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerLast") ?>"><i class="icon-last ew-icon"></i></a>
	<?php } ?>
</div>
</div>
</div>
<span>&nbsp;<?php echo $Language->Phrase("of") ?>&nbsp;<?php echo $tbl_orderguide_list->Pager->PageCount ?></span>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php if ($tbl_orderguide_list->Pager->RecordCount > 0) { ?>
<div class="ew-pager ew-rec">
	<span><?php echo $Language->Phrase("Record") ?>&nbsp;<?php echo $tbl_orderguide_list->Pager->FromIndex ?>&nbsp;<?php echo $Language->Phrase("To") ?>&nbsp;<?php echo $tbl_orderguide_list->Pager->ToIndex ?>&nbsp;<?php echo $Language->Phrase("Of") ?>&nbsp;<?php echo $tbl_orderguide_list->Pager->RecordCount ?></span>
</div>
<?php } ?>
<?php if ($tbl_orderguide_list->TotalRecs > 0 && (!$tbl_orderguide_list->AutoHidePageSizeSelector || $tbl_orderguide_list->Pager->Visible)) { ?>
<div class="ew-pager">
<input type="hidden" name="t" value="tbl_orderguide">
<select name="<?php echo TABLE_REC_PER_PAGE ?>" class="form-control form-control-sm ew-tooltip" title="<?php echo $Language->phrase("RecordsPerPage") ?>" onchange="this.form.submit();">
<option value="20"<?php if ($tbl_orderguide_list->DisplayRecs == 20) { ?> selected<?php } ?>>20</option>
<option value="50"<?php if ($tbl_orderguide_list->DisplayRecs == 50) { ?> selected<?php } ?>>50</option>
<option value="100"<?php if ($tbl_orderguide_list->DisplayRecs == 100) { ?> selected<?php } ?>>100</option>
<option value="200"<?php if ($tbl_orderguide_list->DisplayRecs == 200) { ?> selected<?php } ?>>200</option>
<option value="500"<?php if ($tbl_orderguide_list->DisplayRecs == 500) { ?> selected<?php } ?>>500</option>
<option value="ALL"<?php if ($tbl_orderguide->getRecordsPerPage() == -1) { ?> selected<?php } ?>><?php echo $Language->Phrase("AllRecords") ?></option>
</select>
</div>
<?php } ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $tbl_orderguide_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
<form name="ftbl_orderguidelist" id="ftbl_orderguidelist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($tbl_orderguide_list->CheckToken) { ?>
<input type="hidden" name="<?php echo TOKEN_NAME ?>" value="<?php echo $tbl_orderguide_list->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="tbl_orderguide">
<input type="hidden" name="exporttype" id="exporttype" value="">
<?php if ($tbl_orderguide->getCurrentMasterTable() == "tbl_order" && $tbl_orderguide->CurrentAction) { ?>
<input type="hidden" name="<?php echo TABLE_SHOW_MASTER ?>" value="tbl_order">
<input type="hidden" name="fk_ID_Order" value="<?php echo $tbl_orderguide->ID_Order->getSessionValue() ?>">
<?php } ?>
<div id="gmp_tbl_orderguide" class="<?php if (IsResponsiveLayout()) { ?>table-responsive <?php } ?>card-body ew-grid-middle-panel">
<?php if ($tbl_orderguide_list->TotalRecs > 0 || $tbl_orderguide->isGridEdit()) { ?>
<table id="tbl_tbl_orderguidelist" class="table ew-table"><!-- .ew-table ##-->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$tbl_orderguide_list->RowType = ROWTYPE_HEADER;

// Render list options
$tbl_orderguide_list->renderListOptions();

// Render list options (header, left)
$tbl_orderguide_list->ListOptions->render("header", "left");
?>
<?php if ($tbl_orderguide->Code->Visible) { // Code ?>
	<?php if ($tbl_orderguide->sortUrl($tbl_orderguide->Code) == "") { ?>
		<th data-name="Code" class="<?php echo $tbl_orderguide->Code->headerCellClass() ?>" style="width: 50px; white-space: nowrap;"><div id="elh_tbl_orderguide_Code" class="tbl_orderguide_Code"><div class="ew-table-header-caption"><?php echo $tbl_orderguide->Code->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Code" class="<?php echo $tbl_orderguide->Code->headerCellClass() ?>" style="width: 50px; white-space: nowrap;"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $tbl_orderguide->SortUrl($tbl_orderguide->Code) ?>',2);"><div id="elh_tbl_orderguide_Code" class="tbl_orderguide_Code">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $tbl_orderguide->Code->caption() ?></span><span class="ew-table-header-sort"><?php if ($tbl_orderguide->Code->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($tbl_orderguide->Code->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($tbl_orderguide->ProductName->Visible) { // ProductName ?>
	<?php if ($tbl_orderguide->sortUrl($tbl_orderguide->ProductName) == "") { ?>
		<th data-name="ProductName" class="<?php echo $tbl_orderguide->ProductName->headerCellClass() ?>" style="width: 150px; white-space: nowrap;"><div id="elh_tbl_orderguide_ProductName" class="tbl_orderguide_ProductName"><div class="ew-table-header-caption"><?php echo $tbl_orderguide->ProductName->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="ProductName" class="<?php echo $tbl_orderguide->ProductName->headerCellClass() ?>" style="width: 150px; white-space: nowrap;"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $tbl_orderguide->SortUrl($tbl_orderguide->ProductName) ?>',2);"><div id="elh_tbl_orderguide_ProductName" class="tbl_orderguide_ProductName">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $tbl_orderguide->ProductName->caption() ?></span><span class="ew-table-header-sort"><?php if ($tbl_orderguide->ProductName->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($tbl_orderguide->ProductName->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($tbl_orderguide->PCS_In->Visible) { // PCS_In ?>
	<?php if ($tbl_orderguide->sortUrl($tbl_orderguide->PCS_In) == "") { ?>
		<th data-name="PCS_In" class="<?php echo $tbl_orderguide->PCS_In->headerCellClass() ?>" style="width: 5px; white-space: nowrap;"><div id="elh_tbl_orderguide_PCS_In" class="tbl_orderguide_PCS_In"><div class="ew-table-header-caption"><?php echo $tbl_orderguide->PCS_In->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="PCS_In" class="<?php echo $tbl_orderguide->PCS_In->headerCellClass() ?>" style="width: 5px; white-space: nowrap;"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $tbl_orderguide->SortUrl($tbl_orderguide->PCS_In) ?>',2);"><div id="elh_tbl_orderguide_PCS_In" class="tbl_orderguide_PCS_In">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $tbl_orderguide->PCS_In->caption() ?></span><span class="ew-table-header-sort"><?php if ($tbl_orderguide->PCS_In->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($tbl_orderguide->PCS_In->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($tbl_orderguide->PCS->Visible) { // PCS ?>
	<?php if ($tbl_orderguide->sortUrl($tbl_orderguide->PCS) == "") { ?>
		<th data-name="PCS" class="<?php echo $tbl_orderguide->PCS->headerCellClass() ?>" style="width: 5px; white-space: nowrap;"><div id="elh_tbl_orderguide_PCS" class="tbl_orderguide_PCS"><div class="ew-table-header-caption"><?php echo $tbl_orderguide->PCS->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="PCS" class="<?php echo $tbl_orderguide->PCS->headerCellClass() ?>" style="width: 5px; white-space: nowrap;"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $tbl_orderguide->SortUrl($tbl_orderguide->PCS) ?>',2);"><div id="elh_tbl_orderguide_PCS" class="tbl_orderguide_PCS">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $tbl_orderguide->PCS->caption() ?></span><span class="ew-table-header-sort"><?php if ($tbl_orderguide->PCS->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($tbl_orderguide->PCS->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($tbl_orderguide->Qty->Visible) { // Qty ?>
	<?php if ($tbl_orderguide->sortUrl($tbl_orderguide->Qty) == "") { ?>
		<th data-name="Qty" class="<?php echo $tbl_orderguide->Qty->headerCellClass() ?>" style="white-space: nowrap;"><div id="elh_tbl_orderguide_Qty" class="tbl_orderguide_Qty"><div class="ew-table-header-caption"><?php echo $tbl_orderguide->Qty->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Qty" class="<?php echo $tbl_orderguide->Qty->headerCellClass() ?>" style="white-space: nowrap;"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $tbl_orderguide->SortUrl($tbl_orderguide->Qty) ?>',2);"><div id="elh_tbl_orderguide_Qty" class="tbl_orderguide_Qty">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $tbl_orderguide->Qty->caption() ?></span><span class="ew-table-header-sort"><?php if ($tbl_orderguide->Qty->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($tbl_orderguide->Qty->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($tbl_orderguide->Box->Visible) { // Box ?>
	<?php if ($tbl_orderguide->sortUrl($tbl_orderguide->Box) == "") { ?>
		<th data-name="Box" class="<?php echo $tbl_orderguide->Box->headerCellClass() ?>" style="white-space: nowrap;"><div id="elh_tbl_orderguide_Box" class="tbl_orderguide_Box"><div class="ew-table-header-caption"><?php echo $tbl_orderguide->Box->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Box" class="<?php echo $tbl_orderguide->Box->headerCellClass() ?>" style="white-space: nowrap;"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $tbl_orderguide->SortUrl($tbl_orderguide->Box) ?>',2);"><div id="elh_tbl_orderguide_Box" class="tbl_orderguide_Box">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $tbl_orderguide->Box->caption() ?></span><span class="ew-table-header-sort"><?php if ($tbl_orderguide->Box->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($tbl_orderguide->Box->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($tbl_orderguide->ID_Location->Visible) { // ID_Location ?>
	<?php if ($tbl_orderguide->sortUrl($tbl_orderguide->ID_Location) == "") { ?>
		<th data-name="ID_Location" class="<?php echo $tbl_orderguide->ID_Location->headerCellClass() ?>" style="white-space: nowrap;"><div id="elh_tbl_orderguide_ID_Location" class="tbl_orderguide_ID_Location"><div class="ew-table-header-caption"><?php echo $tbl_orderguide->ID_Location->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="ID_Location" class="<?php echo $tbl_orderguide->ID_Location->headerCellClass() ?>" style="white-space: nowrap;"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $tbl_orderguide->SortUrl($tbl_orderguide->ID_Location) ?>',2);"><div id="elh_tbl_orderguide_ID_Location" class="tbl_orderguide_ID_Location">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $tbl_orderguide->ID_Location->caption() ?></span><span class="ew-table-header-sort"><?php if ($tbl_orderguide->ID_Location->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($tbl_orderguide->ID_Location->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($tbl_orderguide->PalletID->Visible) { // PalletID ?>
	<?php if ($tbl_orderguide->sortUrl($tbl_orderguide->PalletID) == "") { ?>
		<th data-name="PalletID" class="<?php echo $tbl_orderguide->PalletID->headerCellClass() ?>" style="width: 50px; white-space: nowrap;"><div id="elh_tbl_orderguide_PalletID" class="tbl_orderguide_PalletID"><div class="ew-table-header-caption"><?php echo $tbl_orderguide->PalletID->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="PalletID" class="<?php echo $tbl_orderguide->PalletID->headerCellClass() ?>" style="width: 50px; white-space: nowrap;"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $tbl_orderguide->SortUrl($tbl_orderguide->PalletID) ?>',2);"><div id="elh_tbl_orderguide_PalletID" class="tbl_orderguide_PalletID">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $tbl_orderguide->PalletID->caption() ?></span><span class="ew-table-header-sort"><?php if ($tbl_orderguide->PalletID->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($tbl_orderguide->PalletID->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($tbl_orderguide->MFG->Visible) { // MFG ?>
	<?php if ($tbl_orderguide->sortUrl($tbl_orderguide->MFG) == "") { ?>
		<th data-name="MFG" class="<?php echo $tbl_orderguide->MFG->headerCellClass() ?>" style="white-space: nowrap;"><div id="elh_tbl_orderguide_MFG" class="tbl_orderguide_MFG"><div class="ew-table-header-caption"><?php echo $tbl_orderguide->MFG->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="MFG" class="<?php echo $tbl_orderguide->MFG->headerCellClass() ?>" style="white-space: nowrap;"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $tbl_orderguide->SortUrl($tbl_orderguide->MFG) ?>',2);"><div id="elh_tbl_orderguide_MFG" class="tbl_orderguide_MFG">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $tbl_orderguide->MFG->caption() ?></span><span class="ew-table-header-sort"><?php if ($tbl_orderguide->MFG->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($tbl_orderguide->MFG->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($tbl_orderguide->DateIn->Visible) { // DateIn ?>
	<?php if ($tbl_orderguide->sortUrl($tbl_orderguide->DateIn) == "") { ?>
		<th data-name="DateIn" class="<?php echo $tbl_orderguide->DateIn->headerCellClass() ?>" style="white-space: nowrap;"><div id="elh_tbl_orderguide_DateIn" class="tbl_orderguide_DateIn"><div class="ew-table-header-caption"><?php echo $tbl_orderguide->DateIn->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="DateIn" class="<?php echo $tbl_orderguide->DateIn->headerCellClass() ?>" style="white-space: nowrap;"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $tbl_orderguide->SortUrl($tbl_orderguide->DateIn) ?>',2);"><div id="elh_tbl_orderguide_DateIn" class="tbl_orderguide_DateIn">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $tbl_orderguide->DateIn->caption() ?></span><span class="ew-table-header-sort"><?php if ($tbl_orderguide->DateIn->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($tbl_orderguide->DateIn->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($tbl_orderguide->CreateDate->Visible) { // CreateDate ?>
	<?php if ($tbl_orderguide->sortUrl($tbl_orderguide->CreateDate) == "") { ?>
		<th data-name="CreateDate" class="<?php echo $tbl_orderguide->CreateDate->headerCellClass() ?>" style="white-space: nowrap;"><div id="elh_tbl_orderguide_CreateDate" class="tbl_orderguide_CreateDate"><div class="ew-table-header-caption"><?php echo $tbl_orderguide->CreateDate->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="CreateDate" class="<?php echo $tbl_orderguide->CreateDate->headerCellClass() ?>" style="white-space: nowrap;"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $tbl_orderguide->SortUrl($tbl_orderguide->CreateDate) ?>',2);"><div id="elh_tbl_orderguide_CreateDate" class="tbl_orderguide_CreateDate">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $tbl_orderguide->CreateDate->caption() ?></span><span class="ew-table-header-sort"><?php if ($tbl_orderguide->CreateDate->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($tbl_orderguide->CreateDate->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$tbl_orderguide_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
if ($tbl_orderguide->ExportAll && $tbl_orderguide->isExport()) {
	$tbl_orderguide_list->StopRec = $tbl_orderguide_list->TotalRecs;
} else {

	// Set the last record to display
	if ($tbl_orderguide_list->TotalRecs > $tbl_orderguide_list->StartRec + $tbl_orderguide_list->DisplayRecs - 1)
		$tbl_orderguide_list->StopRec = $tbl_orderguide_list->StartRec + $tbl_orderguide_list->DisplayRecs - 1;
	else
		$tbl_orderguide_list->StopRec = $tbl_orderguide_list->TotalRecs;
}
$tbl_orderguide_list->RecCnt = $tbl_orderguide_list->StartRec - 1;
if ($tbl_orderguide_list->Recordset && !$tbl_orderguide_list->Recordset->EOF) {
	$tbl_orderguide_list->Recordset->moveFirst();
	$selectLimit = $tbl_orderguide_list->UseSelectLimit;
	if (!$selectLimit && $tbl_orderguide_list->StartRec > 1)
		$tbl_orderguide_list->Recordset->move($tbl_orderguide_list->StartRec - 1);
} elseif (!$tbl_orderguide->AllowAddDeleteRow && $tbl_orderguide_list->StopRec == 0) {
	$tbl_orderguide_list->StopRec = $tbl_orderguide->GridAddRowCount;
}

// Initialize aggregate
$tbl_orderguide->RowType = ROWTYPE_AGGREGATEINIT;
$tbl_orderguide->resetAttributes();
$tbl_orderguide_list->renderRow();
while ($tbl_orderguide_list->RecCnt < $tbl_orderguide_list->StopRec) {
	$tbl_orderguide_list->RecCnt++;
	if ($tbl_orderguide_list->RecCnt >= $tbl_orderguide_list->StartRec) {
		$tbl_orderguide_list->RowCnt++;

		// Set up key count
		$tbl_orderguide_list->KeyCount = $tbl_orderguide_list->RowIndex;

		// Init row class and style
		$tbl_orderguide->resetAttributes();
		$tbl_orderguide->CssClass = "";
		if ($tbl_orderguide->isGridAdd()) {
		} else {
			$tbl_orderguide_list->loadRowValues($tbl_orderguide_list->Recordset); // Load row values
		}
		$tbl_orderguide->RowType = ROWTYPE_VIEW; // Render view

		// Set up row id / data-rowindex
		$tbl_orderguide->RowAttrs = array_merge($tbl_orderguide->RowAttrs, array('data-rowindex'=>$tbl_orderguide_list->RowCnt, 'id'=>'r' . $tbl_orderguide_list->RowCnt . '_tbl_orderguide', 'data-rowtype'=>$tbl_orderguide->RowType));

		// Render row
		$tbl_orderguide_list->renderRow();

		// Render list options
		$tbl_orderguide_list->renderListOptions();
?>
	<tr<?php echo $tbl_orderguide->rowAttributes() ?>>
<?php

// Render list options (body, left)
$tbl_orderguide_list->ListOptions->render("body", "left", $tbl_orderguide_list->RowCnt);
?>
	<?php if ($tbl_orderguide->Code->Visible) { // Code ?>
		<td data-name="Code"<?php echo $tbl_orderguide->Code->cellAttributes() ?>>
<span id="el<?php echo $tbl_orderguide_list->RowCnt ?>_tbl_orderguide_Code" class="tbl_orderguide_Code">
<span<?php echo $tbl_orderguide->Code->viewAttributes() ?>>
<?php echo $tbl_orderguide->Code->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($tbl_orderguide->ProductName->Visible) { // ProductName ?>
		<td data-name="ProductName"<?php echo $tbl_orderguide->ProductName->cellAttributes() ?>>
<span id="el<?php echo $tbl_orderguide_list->RowCnt ?>_tbl_orderguide_ProductName" class="tbl_orderguide_ProductName">
<span<?php echo $tbl_orderguide->ProductName->viewAttributes() ?>>
<?php echo $tbl_orderguide->ProductName->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($tbl_orderguide->PCS_In->Visible) { // PCS_In ?>
		<td data-name="PCS_In"<?php echo $tbl_orderguide->PCS_In->cellAttributes() ?>>
<span id="el<?php echo $tbl_orderguide_list->RowCnt ?>_tbl_orderguide_PCS_In" class="tbl_orderguide_PCS_In">
<span<?php echo $tbl_orderguide->PCS_In->viewAttributes() ?>>
<?php echo $tbl_orderguide->PCS_In->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($tbl_orderguide->PCS->Visible) { // PCS ?>
		<td data-name="PCS"<?php echo $tbl_orderguide->PCS->cellAttributes() ?>>
<span id="el<?php echo $tbl_orderguide_list->RowCnt ?>_tbl_orderguide_PCS" class="tbl_orderguide_PCS">
<span<?php echo $tbl_orderguide->PCS->viewAttributes() ?>>
<?php echo $tbl_orderguide->PCS->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($tbl_orderguide->Qty->Visible) { // Qty ?>
		<td data-name="Qty"<?php echo $tbl_orderguide->Qty->cellAttributes() ?>>
<span id="el<?php echo $tbl_orderguide_list->RowCnt ?>_tbl_orderguide_Qty" class="tbl_orderguide_Qty">
<span<?php echo $tbl_orderguide->Qty->viewAttributes() ?>>
<?php echo $tbl_orderguide->Qty->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($tbl_orderguide->Box->Visible) { // Box ?>
		<td data-name="Box"<?php echo $tbl_orderguide->Box->cellAttributes() ?>>
<span id="el<?php echo $tbl_orderguide_list->RowCnt ?>_tbl_orderguide_Box" class="tbl_orderguide_Box">
<span<?php echo $tbl_orderguide->Box->viewAttributes() ?>>
<?php echo $tbl_orderguide->Box->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($tbl_orderguide->ID_Location->Visible) { // ID_Location ?>
		<td data-name="ID_Location"<?php echo $tbl_orderguide->ID_Location->cellAttributes() ?>>
<span id="el<?php echo $tbl_orderguide_list->RowCnt ?>_tbl_orderguide_ID_Location" class="tbl_orderguide_ID_Location">
<span<?php echo $tbl_orderguide->ID_Location->viewAttributes() ?>>
<?php echo $tbl_orderguide->ID_Location->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($tbl_orderguide->PalletID->Visible) { // PalletID ?>
		<td data-name="PalletID"<?php echo $tbl_orderguide->PalletID->cellAttributes() ?>>
<span id="el<?php echo $tbl_orderguide_list->RowCnt ?>_tbl_orderguide_PalletID" class="tbl_orderguide_PalletID">
<span<?php echo $tbl_orderguide->PalletID->viewAttributes() ?>>
<?php echo $tbl_orderguide->PalletID->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($tbl_orderguide->MFG->Visible) { // MFG ?>
		<td data-name="MFG"<?php echo $tbl_orderguide->MFG->cellAttributes() ?>>
<span id="el<?php echo $tbl_orderguide_list->RowCnt ?>_tbl_orderguide_MFG" class="tbl_orderguide_MFG">
<span<?php echo $tbl_orderguide->MFG->viewAttributes() ?>>
<?php echo $tbl_orderguide->MFG->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($tbl_orderguide->DateIn->Visible) { // DateIn ?>
		<td data-name="DateIn"<?php echo $tbl_orderguide->DateIn->cellAttributes() ?>>
<span id="el<?php echo $tbl_orderguide_list->RowCnt ?>_tbl_orderguide_DateIn" class="tbl_orderguide_DateIn">
<span<?php echo $tbl_orderguide->DateIn->viewAttributes() ?>>
<?php echo $tbl_orderguide->DateIn->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($tbl_orderguide->CreateDate->Visible) { // CreateDate ?>
		<td data-name="CreateDate"<?php echo $tbl_orderguide->CreateDate->cellAttributes() ?>>
<span id="el<?php echo $tbl_orderguide_list->RowCnt ?>_tbl_orderguide_CreateDate" class="tbl_orderguide_CreateDate">
<span<?php echo $tbl_orderguide->CreateDate->viewAttributes() ?>>
<?php echo $tbl_orderguide->CreateDate->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$tbl_orderguide_list->ListOptions->render("body", "right", $tbl_orderguide_list->RowCnt);
?>
	</tr>
<?php
	}
	if (!$tbl_orderguide->isGridAdd())
		$tbl_orderguide_list->Recordset->moveNext();
}
?>
</tbody>
</table><!-- /.ew-table -->
<?php } ?>
<?php if (!$tbl_orderguide->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</div><!-- /.ew-grid-middle-panel -->
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($tbl_orderguide_list->Recordset)
	$tbl_orderguide_list->Recordset->Close();
?>
<?php if (!$tbl_orderguide->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$tbl_orderguide->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php if (!isset($tbl_orderguide_list->Pager)) $tbl_orderguide_list->Pager = new PrevNextPager($tbl_orderguide_list->StartRec, $tbl_orderguide_list->DisplayRecs, $tbl_orderguide_list->TotalRecs, $tbl_orderguide_list->AutoHidePager) ?>
<?php if ($tbl_orderguide_list->Pager->RecordCount > 0 && $tbl_orderguide_list->Pager->Visible) { ?>
<div class="ew-pager">
<span><?php echo $Language->Phrase("Page") ?>&nbsp;</span>
<div class="ew-prev-next"><div class="input-group input-group-sm">
<div class="input-group-prepend">
<!-- first page button -->
	<?php if ($tbl_orderguide_list->Pager->FirstButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerFirst") ?>" href="<?php echo $tbl_orderguide_list->pageUrl() ?>start=<?php echo $tbl_orderguide_list->Pager->FirstButton->Start ?>"><i class="icon-first ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerFirst") ?>"><i class="icon-first ew-icon"></i></a>
	<?php } ?>
<!-- previous page button -->
	<?php if ($tbl_orderguide_list->Pager->PrevButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerPrevious") ?>" href="<?php echo $tbl_orderguide_list->pageUrl() ?>start=<?php echo $tbl_orderguide_list->Pager->PrevButton->Start ?>"><i class="icon-prev ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerPrevious") ?>"><i class="icon-prev ew-icon"></i></a>
	<?php } ?>
</div>
<!-- current page number -->
	<input class="form-control" type="text" name="<?php echo TABLE_PAGE_NO ?>" value="<?php echo $tbl_orderguide_list->Pager->CurrentPage ?>">
<div class="input-group-append">
<!-- next page button -->
	<?php if ($tbl_orderguide_list->Pager->NextButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerNext") ?>" href="<?php echo $tbl_orderguide_list->pageUrl() ?>start=<?php echo $tbl_orderguide_list->Pager->NextButton->Start ?>"><i class="icon-next ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerNext") ?>"><i class="icon-next ew-icon"></i></a>
	<?php } ?>
<!-- last page button -->
	<?php if ($tbl_orderguide_list->Pager->LastButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerLast") ?>" href="<?php echo $tbl_orderguide_list->pageUrl() ?>start=<?php echo $tbl_orderguide_list->Pager->LastButton->Start ?>"><i class="icon-last ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerLast") ?>"><i class="icon-last ew-icon"></i></a>
	<?php } ?>
</div>
</div>
</div>
<span>&nbsp;<?php echo $Language->Phrase("of") ?>&nbsp;<?php echo $tbl_orderguide_list->Pager->PageCount ?></span>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php if ($tbl_orderguide_list->Pager->RecordCount > 0) { ?>
<div class="ew-pager ew-rec">
	<span><?php echo $Language->Phrase("Record") ?>&nbsp;<?php echo $tbl_orderguide_list->Pager->FromIndex ?>&nbsp;<?php echo $Language->Phrase("To") ?>&nbsp;<?php echo $tbl_orderguide_list->Pager->ToIndex ?>&nbsp;<?php echo $Language->Phrase("Of") ?>&nbsp;<?php echo $tbl_orderguide_list->Pager->RecordCount ?></span>
</div>
<?php } ?>
<?php if ($tbl_orderguide_list->TotalRecs > 0 && (!$tbl_orderguide_list->AutoHidePageSizeSelector || $tbl_orderguide_list->Pager->Visible)) { ?>
<div class="ew-pager">
<input type="hidden" name="t" value="tbl_orderguide">
<select name="<?php echo TABLE_REC_PER_PAGE ?>" class="form-control form-control-sm ew-tooltip" title="<?php echo $Language->phrase("RecordsPerPage") ?>" onchange="this.form.submit();">
<option value="20"<?php if ($tbl_orderguide_list->DisplayRecs == 20) { ?> selected<?php } ?>>20</option>
<option value="50"<?php if ($tbl_orderguide_list->DisplayRecs == 50) { ?> selected<?php } ?>>50</option>
<option value="100"<?php if ($tbl_orderguide_list->DisplayRecs == 100) { ?> selected<?php } ?>>100</option>
<option value="200"<?php if ($tbl_orderguide_list->DisplayRecs == 200) { ?> selected<?php } ?>>200</option>
<option value="500"<?php if ($tbl_orderguide_list->DisplayRecs == 500) { ?> selected<?php } ?>>500</option>
<option value="ALL"<?php if ($tbl_orderguide->getRecordsPerPage() == -1) { ?> selected<?php } ?>><?php echo $Language->Phrase("AllRecords") ?></option>
</select>
</div>
<?php } ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $tbl_orderguide_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($tbl_orderguide_list->TotalRecs == 0 && !$tbl_orderguide->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $tbl_orderguide_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$tbl_orderguide_list->showPageFooter();
if (DEBUG_ENABLED)
	echo GetDebugMessage();
?>
<?php if (!$tbl_orderguide->isExport()) { ?>
<script>

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php } ?>
<?php include_once "footer.php" ?>
<?php
$tbl_orderguide_list->terminate();
?>