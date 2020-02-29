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
$tbl_checkstockdetail_list = new tbl_checkstockdetail_list();

// Run the page
$tbl_checkstockdetail_list->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$tbl_checkstockdetail_list->Page_Render();
?>
<?php include_once "header.php" ?>
<?php if (!$tbl_checkstockdetail->isExport()) { ?>
<script>

// Form object
currentPageID = ew.PAGE_ID = "list";
var ftbl_checkstockdetaillist = currentForm = new ew.Form("ftbl_checkstockdetaillist", "list");
ftbl_checkstockdetaillist.formKeyCountName = '<?php echo $tbl_checkstockdetail_list->FormKeyCountName ?>';

// Form_CustomValidate event
ftbl_checkstockdetaillist.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

	// Your custom validation code here, return false if invalid.
	return true;
}

// Use JavaScript validation or not
ftbl_checkstockdetaillist.validateRequired = <?php echo json_encode(CLIENT_VALIDATE) ?>;

// Dynamic selection lists
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
<?php if (!$tbl_checkstockdetail->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($tbl_checkstockdetail_list->TotalRecs > 0 && $tbl_checkstockdetail_list->ExportOptions->visible()) { ?>
<?php $tbl_checkstockdetail_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($tbl_checkstockdetail_list->ImportOptions->visible()) { ?>
<?php $tbl_checkstockdetail_list->ImportOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php if (!$tbl_checkstockdetail->isExport() || EXPORT_MASTER_RECORD && $tbl_checkstockdetail->isExport("print")) { ?>
<?php
if ($tbl_checkstockdetail_list->DbMasterFilter <> "" && $tbl_checkstockdetail->getCurrentMasterTable() == "tbl_checkstock") {
	if ($tbl_checkstockdetail_list->MasterRecordExists) {
		include_once "tbl_checkstockmaster.php";
	}
}
?>
<?php } ?>
<?php
$tbl_checkstockdetail_list->renderOtherOptions();
?>
<?php $tbl_checkstockdetail_list->showPageHeader(); ?>
<?php
$tbl_checkstockdetail_list->showMessage();
?>
<?php if ($tbl_checkstockdetail_list->TotalRecs > 0 || $tbl_checkstockdetail->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($tbl_checkstockdetail_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> tbl_checkstockdetail">
<?php if (!$tbl_checkstockdetail->isExport()) { ?>
<div class="card-header ew-grid-upper-panel">
<?php if (!$tbl_checkstockdetail->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php if (!isset($tbl_checkstockdetail_list->Pager)) $tbl_checkstockdetail_list->Pager = new PrevNextPager($tbl_checkstockdetail_list->StartRec, $tbl_checkstockdetail_list->DisplayRecs, $tbl_checkstockdetail_list->TotalRecs, $tbl_checkstockdetail_list->AutoHidePager) ?>
<?php if ($tbl_checkstockdetail_list->Pager->RecordCount > 0 && $tbl_checkstockdetail_list->Pager->Visible) { ?>
<div class="ew-pager">
<span><?php echo $Language->Phrase("Page") ?>&nbsp;</span>
<div class="ew-prev-next"><div class="input-group input-group-sm">
<div class="input-group-prepend">
<!-- first page button -->
	<?php if ($tbl_checkstockdetail_list->Pager->FirstButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerFirst") ?>" href="<?php echo $tbl_checkstockdetail_list->pageUrl() ?>start=<?php echo $tbl_checkstockdetail_list->Pager->FirstButton->Start ?>"><i class="icon-first ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerFirst") ?>"><i class="icon-first ew-icon"></i></a>
	<?php } ?>
<!-- previous page button -->
	<?php if ($tbl_checkstockdetail_list->Pager->PrevButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerPrevious") ?>" href="<?php echo $tbl_checkstockdetail_list->pageUrl() ?>start=<?php echo $tbl_checkstockdetail_list->Pager->PrevButton->Start ?>"><i class="icon-prev ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerPrevious") ?>"><i class="icon-prev ew-icon"></i></a>
	<?php } ?>
</div>
<!-- current page number -->
	<input class="form-control" type="text" name="<?php echo TABLE_PAGE_NO ?>" value="<?php echo $tbl_checkstockdetail_list->Pager->CurrentPage ?>">
<div class="input-group-append">
<!-- next page button -->
	<?php if ($tbl_checkstockdetail_list->Pager->NextButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerNext") ?>" href="<?php echo $tbl_checkstockdetail_list->pageUrl() ?>start=<?php echo $tbl_checkstockdetail_list->Pager->NextButton->Start ?>"><i class="icon-next ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerNext") ?>"><i class="icon-next ew-icon"></i></a>
	<?php } ?>
<!-- last page button -->
	<?php if ($tbl_checkstockdetail_list->Pager->LastButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerLast") ?>" href="<?php echo $tbl_checkstockdetail_list->pageUrl() ?>start=<?php echo $tbl_checkstockdetail_list->Pager->LastButton->Start ?>"><i class="icon-last ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerLast") ?>"><i class="icon-last ew-icon"></i></a>
	<?php } ?>
</div>
</div>
</div>
<span>&nbsp;<?php echo $Language->Phrase("of") ?>&nbsp;<?php echo $tbl_checkstockdetail_list->Pager->PageCount ?></span>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php if ($tbl_checkstockdetail_list->Pager->RecordCount > 0) { ?>
<div class="ew-pager ew-rec">
	<span><?php echo $Language->Phrase("Record") ?>&nbsp;<?php echo $tbl_checkstockdetail_list->Pager->FromIndex ?>&nbsp;<?php echo $Language->Phrase("To") ?>&nbsp;<?php echo $tbl_checkstockdetail_list->Pager->ToIndex ?>&nbsp;<?php echo $Language->Phrase("Of") ?>&nbsp;<?php echo $tbl_checkstockdetail_list->Pager->RecordCount ?></span>
</div>
<?php } ?>
<?php if ($tbl_checkstockdetail_list->TotalRecs > 0 && (!$tbl_checkstockdetail_list->AutoHidePageSizeSelector || $tbl_checkstockdetail_list->Pager->Visible)) { ?>
<div class="ew-pager">
<input type="hidden" name="t" value="tbl_checkstockdetail">
<select name="<?php echo TABLE_REC_PER_PAGE ?>" class="form-control form-control-sm ew-tooltip" title="<?php echo $Language->phrase("RecordsPerPage") ?>" onchange="this.form.submit();">
<option value="20"<?php if ($tbl_checkstockdetail_list->DisplayRecs == 20) { ?> selected<?php } ?>>20</option>
<option value="50"<?php if ($tbl_checkstockdetail_list->DisplayRecs == 50) { ?> selected<?php } ?>>50</option>
<option value="100"<?php if ($tbl_checkstockdetail_list->DisplayRecs == 100) { ?> selected<?php } ?>>100</option>
<option value="200"<?php if ($tbl_checkstockdetail_list->DisplayRecs == 200) { ?> selected<?php } ?>>200</option>
<option value="500"<?php if ($tbl_checkstockdetail_list->DisplayRecs == 500) { ?> selected<?php } ?>>500</option>
<option value="ALL"<?php if ($tbl_checkstockdetail->getRecordsPerPage() == -1) { ?> selected<?php } ?>><?php echo $Language->Phrase("AllRecords") ?></option>
</select>
</div>
<?php } ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $tbl_checkstockdetail_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
<form name="ftbl_checkstockdetaillist" id="ftbl_checkstockdetaillist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($tbl_checkstockdetail_list->CheckToken) { ?>
<input type="hidden" name="<?php echo TOKEN_NAME ?>" value="<?php echo $tbl_checkstockdetail_list->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="tbl_checkstockdetail">
<input type="hidden" name="exporttype" id="exporttype" value="">
<?php if ($tbl_checkstockdetail->getCurrentMasterTable() == "tbl_checkstock" && $tbl_checkstockdetail->CurrentAction) { ?>
<input type="hidden" name="<?php echo TABLE_SHOW_MASTER ?>" value="tbl_checkstock">
<input type="hidden" name="fk_ID" value="<?php echo $tbl_checkstockdetail->ID_checkStock->getSessionValue() ?>">
<?php } ?>
<div id="gmp_tbl_checkstockdetail" class="<?php if (IsResponsiveLayout()) { ?>table-responsive <?php } ?>card-body ew-grid-middle-panel">
<?php if ($tbl_checkstockdetail_list->TotalRecs > 0 || $tbl_checkstockdetail->isGridEdit()) { ?>
<table id="tbl_tbl_checkstockdetaillist" class="table ew-table"><!-- .ew-table ##-->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$tbl_checkstockdetail_list->RowType = ROWTYPE_HEADER;

// Render list options
$tbl_checkstockdetail_list->renderListOptions();

// Render list options (header, left)
$tbl_checkstockdetail_list->ListOptions->render("header", "left");
?>
<?php if ($tbl_checkstockdetail->Location->Visible) { // Location ?>
	<?php if ($tbl_checkstockdetail->sortUrl($tbl_checkstockdetail->Location) == "") { ?>
		<th data-name="Location" class="<?php echo $tbl_checkstockdetail->Location->headerCellClass() ?>" style="white-space: nowrap;"><div id="elh_tbl_checkstockdetail_Location" class="tbl_checkstockdetail_Location"><div class="ew-table-header-caption"><?php echo $tbl_checkstockdetail->Location->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Location" class="<?php echo $tbl_checkstockdetail->Location->headerCellClass() ?>" style="white-space: nowrap;"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $tbl_checkstockdetail->SortUrl($tbl_checkstockdetail->Location) ?>',2);"><div id="elh_tbl_checkstockdetail_Location" class="tbl_checkstockdetail_Location">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $tbl_checkstockdetail->Location->caption() ?></span><span class="ew-table-header-sort"><?php if ($tbl_checkstockdetail->Location->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($tbl_checkstockdetail->Location->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($tbl_checkstockdetail->PalletID->Visible) { // PalletID ?>
	<?php if ($tbl_checkstockdetail->sortUrl($tbl_checkstockdetail->PalletID) == "") { ?>
		<th data-name="PalletID" class="<?php echo $tbl_checkstockdetail->PalletID->headerCellClass() ?>" style="white-space: nowrap;"><div id="elh_tbl_checkstockdetail_PalletID" class="tbl_checkstockdetail_PalletID"><div class="ew-table-header-caption"><?php echo $tbl_checkstockdetail->PalletID->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="PalletID" class="<?php echo $tbl_checkstockdetail->PalletID->headerCellClass() ?>" style="white-space: nowrap;"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $tbl_checkstockdetail->SortUrl($tbl_checkstockdetail->PalletID) ?>',2);"><div id="elh_tbl_checkstockdetail_PalletID" class="tbl_checkstockdetail_PalletID">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $tbl_checkstockdetail->PalletID->caption() ?></span><span class="ew-table-header-sort"><?php if ($tbl_checkstockdetail->PalletID->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($tbl_checkstockdetail->PalletID->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($tbl_checkstockdetail->Code->Visible) { // Code ?>
	<?php if ($tbl_checkstockdetail->sortUrl($tbl_checkstockdetail->Code) == "") { ?>
		<th data-name="Code" class="<?php echo $tbl_checkstockdetail->Code->headerCellClass() ?>" style="white-space: nowrap;"><div id="elh_tbl_checkstockdetail_Code" class="tbl_checkstockdetail_Code"><div class="ew-table-header-caption"><?php echo $tbl_checkstockdetail->Code->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Code" class="<?php echo $tbl_checkstockdetail->Code->headerCellClass() ?>" style="white-space: nowrap;"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $tbl_checkstockdetail->SortUrl($tbl_checkstockdetail->Code) ?>',2);"><div id="elh_tbl_checkstockdetail_Code" class="tbl_checkstockdetail_Code">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $tbl_checkstockdetail->Code->caption() ?></span><span class="ew-table-header-sort"><?php if ($tbl_checkstockdetail->Code->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($tbl_checkstockdetail->Code->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($tbl_checkstockdetail->PCS->Visible) { // PCS ?>
	<?php if ($tbl_checkstockdetail->sortUrl($tbl_checkstockdetail->PCS) == "") { ?>
		<th data-name="PCS" class="<?php echo $tbl_checkstockdetail->PCS->headerCellClass() ?>" style="white-space: nowrap;"><div id="elh_tbl_checkstockdetail_PCS" class="tbl_checkstockdetail_PCS"><div class="ew-table-header-caption"><?php echo $tbl_checkstockdetail->PCS->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="PCS" class="<?php echo $tbl_checkstockdetail->PCS->headerCellClass() ?>" style="white-space: nowrap;"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $tbl_checkstockdetail->SortUrl($tbl_checkstockdetail->PCS) ?>',2);"><div id="elh_tbl_checkstockdetail_PCS" class="tbl_checkstockdetail_PCS">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $tbl_checkstockdetail->PCS->caption() ?></span><span class="ew-table-header-sort"><?php if ($tbl_checkstockdetail->PCS->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($tbl_checkstockdetail->PCS->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($tbl_checkstockdetail->DateTimeCheck->Visible) { // DateTimeCheck ?>
	<?php if ($tbl_checkstockdetail->sortUrl($tbl_checkstockdetail->DateTimeCheck) == "") { ?>
		<th data-name="DateTimeCheck" class="<?php echo $tbl_checkstockdetail->DateTimeCheck->headerCellClass() ?>" style="white-space: nowrap;"><div id="elh_tbl_checkstockdetail_DateTimeCheck" class="tbl_checkstockdetail_DateTimeCheck"><div class="ew-table-header-caption"><?php echo $tbl_checkstockdetail->DateTimeCheck->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="DateTimeCheck" class="<?php echo $tbl_checkstockdetail->DateTimeCheck->headerCellClass() ?>" style="white-space: nowrap;"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $tbl_checkstockdetail->SortUrl($tbl_checkstockdetail->DateTimeCheck) ?>',2);"><div id="elh_tbl_checkstockdetail_DateTimeCheck" class="tbl_checkstockdetail_DateTimeCheck">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $tbl_checkstockdetail->DateTimeCheck->caption() ?></span><span class="ew-table-header-sort"><?php if ($tbl_checkstockdetail->DateTimeCheck->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($tbl_checkstockdetail->DateTimeCheck->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($tbl_checkstockdetail->UserCheck->Visible) { // UserCheck ?>
	<?php if ($tbl_checkstockdetail->sortUrl($tbl_checkstockdetail->UserCheck) == "") { ?>
		<th data-name="UserCheck" class="<?php echo $tbl_checkstockdetail->UserCheck->headerCellClass() ?>" style="white-space: nowrap;"><div id="elh_tbl_checkstockdetail_UserCheck" class="tbl_checkstockdetail_UserCheck"><div class="ew-table-header-caption"><?php echo $tbl_checkstockdetail->UserCheck->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="UserCheck" class="<?php echo $tbl_checkstockdetail->UserCheck->headerCellClass() ?>" style="white-space: nowrap;"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $tbl_checkstockdetail->SortUrl($tbl_checkstockdetail->UserCheck) ?>',2);"><div id="elh_tbl_checkstockdetail_UserCheck" class="tbl_checkstockdetail_UserCheck">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $tbl_checkstockdetail->UserCheck->caption() ?></span><span class="ew-table-header-sort"><?php if ($tbl_checkstockdetail->UserCheck->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($tbl_checkstockdetail->UserCheck->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($tbl_checkstockdetail->Usercreate->Visible) { // Usercreate ?>
	<?php if ($tbl_checkstockdetail->sortUrl($tbl_checkstockdetail->Usercreate) == "") { ?>
		<th data-name="Usercreate" class="<?php echo $tbl_checkstockdetail->Usercreate->headerCellClass() ?>" style="white-space: nowrap;"><div id="elh_tbl_checkstockdetail_Usercreate" class="tbl_checkstockdetail_Usercreate"><div class="ew-table-header-caption"><?php echo $tbl_checkstockdetail->Usercreate->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Usercreate" class="<?php echo $tbl_checkstockdetail->Usercreate->headerCellClass() ?>" style="white-space: nowrap;"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $tbl_checkstockdetail->SortUrl($tbl_checkstockdetail->Usercreate) ?>',2);"><div id="elh_tbl_checkstockdetail_Usercreate" class="tbl_checkstockdetail_Usercreate">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $tbl_checkstockdetail->Usercreate->caption() ?></span><span class="ew-table-header-sort"><?php if ($tbl_checkstockdetail->Usercreate->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($tbl_checkstockdetail->Usercreate->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($tbl_checkstockdetail->DatetimeCreate->Visible) { // DatetimeCreate ?>
	<?php if ($tbl_checkstockdetail->sortUrl($tbl_checkstockdetail->DatetimeCreate) == "") { ?>
		<th data-name="DatetimeCreate" class="<?php echo $tbl_checkstockdetail->DatetimeCreate->headerCellClass() ?>" style="white-space: nowrap;"><div id="elh_tbl_checkstockdetail_DatetimeCreate" class="tbl_checkstockdetail_DatetimeCreate"><div class="ew-table-header-caption"><?php echo $tbl_checkstockdetail->DatetimeCreate->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="DatetimeCreate" class="<?php echo $tbl_checkstockdetail->DatetimeCreate->headerCellClass() ?>" style="white-space: nowrap;"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $tbl_checkstockdetail->SortUrl($tbl_checkstockdetail->DatetimeCreate) ?>',2);"><div id="elh_tbl_checkstockdetail_DatetimeCreate" class="tbl_checkstockdetail_DatetimeCreate">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $tbl_checkstockdetail->DatetimeCreate->caption() ?></span><span class="ew-table-header-sort"><?php if ($tbl_checkstockdetail->DatetimeCreate->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($tbl_checkstockdetail->DatetimeCreate->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$tbl_checkstockdetail_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
if ($tbl_checkstockdetail->ExportAll && $tbl_checkstockdetail->isExport()) {
	$tbl_checkstockdetail_list->StopRec = $tbl_checkstockdetail_list->TotalRecs;
} else {

	// Set the last record to display
	if ($tbl_checkstockdetail_list->TotalRecs > $tbl_checkstockdetail_list->StartRec + $tbl_checkstockdetail_list->DisplayRecs - 1)
		$tbl_checkstockdetail_list->StopRec = $tbl_checkstockdetail_list->StartRec + $tbl_checkstockdetail_list->DisplayRecs - 1;
	else
		$tbl_checkstockdetail_list->StopRec = $tbl_checkstockdetail_list->TotalRecs;
}
$tbl_checkstockdetail_list->RecCnt = $tbl_checkstockdetail_list->StartRec - 1;
if ($tbl_checkstockdetail_list->Recordset && !$tbl_checkstockdetail_list->Recordset->EOF) {
	$tbl_checkstockdetail_list->Recordset->moveFirst();
	$selectLimit = $tbl_checkstockdetail_list->UseSelectLimit;
	if (!$selectLimit && $tbl_checkstockdetail_list->StartRec > 1)
		$tbl_checkstockdetail_list->Recordset->move($tbl_checkstockdetail_list->StartRec - 1);
} elseif (!$tbl_checkstockdetail->AllowAddDeleteRow && $tbl_checkstockdetail_list->StopRec == 0) {
	$tbl_checkstockdetail_list->StopRec = $tbl_checkstockdetail->GridAddRowCount;
}

// Initialize aggregate
$tbl_checkstockdetail->RowType = ROWTYPE_AGGREGATEINIT;
$tbl_checkstockdetail->resetAttributes();
$tbl_checkstockdetail_list->renderRow();
while ($tbl_checkstockdetail_list->RecCnt < $tbl_checkstockdetail_list->StopRec) {
	$tbl_checkstockdetail_list->RecCnt++;
	if ($tbl_checkstockdetail_list->RecCnt >= $tbl_checkstockdetail_list->StartRec) {
		$tbl_checkstockdetail_list->RowCnt++;

		// Set up key count
		$tbl_checkstockdetail_list->KeyCount = $tbl_checkstockdetail_list->RowIndex;

		// Init row class and style
		$tbl_checkstockdetail->resetAttributes();
		$tbl_checkstockdetail->CssClass = "";
		if ($tbl_checkstockdetail->isGridAdd()) {
		} else {
			$tbl_checkstockdetail_list->loadRowValues($tbl_checkstockdetail_list->Recordset); // Load row values
		}
		$tbl_checkstockdetail->RowType = ROWTYPE_VIEW; // Render view

		// Set up row id / data-rowindex
		$tbl_checkstockdetail->RowAttrs = array_merge($tbl_checkstockdetail->RowAttrs, array('data-rowindex'=>$tbl_checkstockdetail_list->RowCnt, 'id'=>'r' . $tbl_checkstockdetail_list->RowCnt . '_tbl_checkstockdetail', 'data-rowtype'=>$tbl_checkstockdetail->RowType));

		// Render row
		$tbl_checkstockdetail_list->renderRow();

		// Render list options
		$tbl_checkstockdetail_list->renderListOptions();
?>
	<tr<?php echo $tbl_checkstockdetail->rowAttributes() ?>>
<?php

// Render list options (body, left)
$tbl_checkstockdetail_list->ListOptions->render("body", "left", $tbl_checkstockdetail_list->RowCnt);
?>
	<?php if ($tbl_checkstockdetail->Location->Visible) { // Location ?>
		<td data-name="Location"<?php echo $tbl_checkstockdetail->Location->cellAttributes() ?>>
<span id="el<?php echo $tbl_checkstockdetail_list->RowCnt ?>_tbl_checkstockdetail_Location" class="tbl_checkstockdetail_Location">
<span<?php echo $tbl_checkstockdetail->Location->viewAttributes() ?>>
<?php echo $tbl_checkstockdetail->Location->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($tbl_checkstockdetail->PalletID->Visible) { // PalletID ?>
		<td data-name="PalletID"<?php echo $tbl_checkstockdetail->PalletID->cellAttributes() ?>>
<span id="el<?php echo $tbl_checkstockdetail_list->RowCnt ?>_tbl_checkstockdetail_PalletID" class="tbl_checkstockdetail_PalletID">
<span<?php echo $tbl_checkstockdetail->PalletID->viewAttributes() ?>>
<?php echo $tbl_checkstockdetail->PalletID->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($tbl_checkstockdetail->Code->Visible) { // Code ?>
		<td data-name="Code"<?php echo $tbl_checkstockdetail->Code->cellAttributes() ?>>
<span id="el<?php echo $tbl_checkstockdetail_list->RowCnt ?>_tbl_checkstockdetail_Code" class="tbl_checkstockdetail_Code">
<span<?php echo $tbl_checkstockdetail->Code->viewAttributes() ?>>
<?php echo $tbl_checkstockdetail->Code->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($tbl_checkstockdetail->PCS->Visible) { // PCS ?>
		<td data-name="PCS"<?php echo $tbl_checkstockdetail->PCS->cellAttributes() ?>>
<span id="el<?php echo $tbl_checkstockdetail_list->RowCnt ?>_tbl_checkstockdetail_PCS" class="tbl_checkstockdetail_PCS">
<span<?php echo $tbl_checkstockdetail->PCS->viewAttributes() ?>>
<?php echo $tbl_checkstockdetail->PCS->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($tbl_checkstockdetail->DateTimeCheck->Visible) { // DateTimeCheck ?>
		<td data-name="DateTimeCheck"<?php echo $tbl_checkstockdetail->DateTimeCheck->cellAttributes() ?>>
<span id="el<?php echo $tbl_checkstockdetail_list->RowCnt ?>_tbl_checkstockdetail_DateTimeCheck" class="tbl_checkstockdetail_DateTimeCheck">
<span<?php echo $tbl_checkstockdetail->DateTimeCheck->viewAttributes() ?>>
<?php echo $tbl_checkstockdetail->DateTimeCheck->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($tbl_checkstockdetail->UserCheck->Visible) { // UserCheck ?>
		<td data-name="UserCheck"<?php echo $tbl_checkstockdetail->UserCheck->cellAttributes() ?>>
<span id="el<?php echo $tbl_checkstockdetail_list->RowCnt ?>_tbl_checkstockdetail_UserCheck" class="tbl_checkstockdetail_UserCheck">
<span<?php echo $tbl_checkstockdetail->UserCheck->viewAttributes() ?>>
<?php echo $tbl_checkstockdetail->UserCheck->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($tbl_checkstockdetail->Usercreate->Visible) { // Usercreate ?>
		<td data-name="Usercreate"<?php echo $tbl_checkstockdetail->Usercreate->cellAttributes() ?>>
<span id="el<?php echo $tbl_checkstockdetail_list->RowCnt ?>_tbl_checkstockdetail_Usercreate" class="tbl_checkstockdetail_Usercreate">
<span<?php echo $tbl_checkstockdetail->Usercreate->viewAttributes() ?>>
<?php echo $tbl_checkstockdetail->Usercreate->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($tbl_checkstockdetail->DatetimeCreate->Visible) { // DatetimeCreate ?>
		<td data-name="DatetimeCreate"<?php echo $tbl_checkstockdetail->DatetimeCreate->cellAttributes() ?>>
<span id="el<?php echo $tbl_checkstockdetail_list->RowCnt ?>_tbl_checkstockdetail_DatetimeCreate" class="tbl_checkstockdetail_DatetimeCreate">
<span<?php echo $tbl_checkstockdetail->DatetimeCreate->viewAttributes() ?>>
<?php echo $tbl_checkstockdetail->DatetimeCreate->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$tbl_checkstockdetail_list->ListOptions->render("body", "right", $tbl_checkstockdetail_list->RowCnt);
?>
	</tr>
<?php
	}
	if (!$tbl_checkstockdetail->isGridAdd())
		$tbl_checkstockdetail_list->Recordset->moveNext();
}
?>
</tbody>
<?php

// Render aggregate row
$tbl_checkstockdetail->RowType = ROWTYPE_AGGREGATE;
$tbl_checkstockdetail->resetAttributes();
$tbl_checkstockdetail_list->renderRow();
?>
<?php if ($tbl_checkstockdetail_list->TotalRecs > 0 && !$tbl_checkstockdetail->isGridAdd() && !$tbl_checkstockdetail->isGridEdit()) { ?>
<tfoot><!-- Table footer -->
	<tr class="ew-table-footer">
<?php

// Render list options
$tbl_checkstockdetail_list->renderListOptions();

// Render list options (footer, left)
$tbl_checkstockdetail_list->ListOptions->render("footer", "left");
?>
	<?php if ($tbl_checkstockdetail->Location->Visible) { // Location ?>
		<td data-name="Location" class="<?php echo $tbl_checkstockdetail->Location->footerCellClass() ?>"><span id="elf_tbl_checkstockdetail_Location" class="tbl_checkstockdetail_Location">
		&nbsp;
		</span></td>
	<?php } ?>
	<?php if ($tbl_checkstockdetail->PalletID->Visible) { // PalletID ?>
		<td data-name="PalletID" class="<?php echo $tbl_checkstockdetail->PalletID->footerCellClass() ?>"><span id="elf_tbl_checkstockdetail_PalletID" class="tbl_checkstockdetail_PalletID">
		&nbsp;
		</span></td>
	<?php } ?>
	<?php if ($tbl_checkstockdetail->Code->Visible) { // Code ?>
		<td data-name="Code" class="<?php echo $tbl_checkstockdetail->Code->footerCellClass() ?>"><span id="elf_tbl_checkstockdetail_Code" class="tbl_checkstockdetail_Code">
		&nbsp;
		</span></td>
	<?php } ?>
	<?php if ($tbl_checkstockdetail->PCS->Visible) { // PCS ?>
		<td data-name="PCS" class="<?php echo $tbl_checkstockdetail->PCS->footerCellClass() ?>"><span id="elf_tbl_checkstockdetail_PCS" class="tbl_checkstockdetail_PCS">
		<span class="ew-aggregate"><?php echo $Language->phrase("TOTAL") ?></span><span class="ew-aggregate-value">
		<?php echo $tbl_checkstockdetail->PCS->ViewValue ?></span>
		</span></td>
	<?php } ?>
	<?php if ($tbl_checkstockdetail->DateTimeCheck->Visible) { // DateTimeCheck ?>
		<td data-name="DateTimeCheck" class="<?php echo $tbl_checkstockdetail->DateTimeCheck->footerCellClass() ?>"><span id="elf_tbl_checkstockdetail_DateTimeCheck" class="tbl_checkstockdetail_DateTimeCheck">
		&nbsp;
		</span></td>
	<?php } ?>
	<?php if ($tbl_checkstockdetail->UserCheck->Visible) { // UserCheck ?>
		<td data-name="UserCheck" class="<?php echo $tbl_checkstockdetail->UserCheck->footerCellClass() ?>"><span id="elf_tbl_checkstockdetail_UserCheck" class="tbl_checkstockdetail_UserCheck">
		&nbsp;
		</span></td>
	<?php } ?>
	<?php if ($tbl_checkstockdetail->Usercreate->Visible) { // Usercreate ?>
		<td data-name="Usercreate" class="<?php echo $tbl_checkstockdetail->Usercreate->footerCellClass() ?>"><span id="elf_tbl_checkstockdetail_Usercreate" class="tbl_checkstockdetail_Usercreate">
		&nbsp;
		</span></td>
	<?php } ?>
	<?php if ($tbl_checkstockdetail->DatetimeCreate->Visible) { // DatetimeCreate ?>
		<td data-name="DatetimeCreate" class="<?php echo $tbl_checkstockdetail->DatetimeCreate->footerCellClass() ?>"><span id="elf_tbl_checkstockdetail_DatetimeCreate" class="tbl_checkstockdetail_DatetimeCreate">
		&nbsp;
		</span></td>
	<?php } ?>
<?php

// Render list options (footer, right)
$tbl_checkstockdetail_list->ListOptions->render("footer", "right");
?>
	</tr>
</tfoot>
<?php } ?>
</table><!-- /.ew-table -->
<?php } ?>
<?php if (!$tbl_checkstockdetail->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</div><!-- /.ew-grid-middle-panel -->
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($tbl_checkstockdetail_list->Recordset)
	$tbl_checkstockdetail_list->Recordset->Close();
?>
<?php if (!$tbl_checkstockdetail->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$tbl_checkstockdetail->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php if (!isset($tbl_checkstockdetail_list->Pager)) $tbl_checkstockdetail_list->Pager = new PrevNextPager($tbl_checkstockdetail_list->StartRec, $tbl_checkstockdetail_list->DisplayRecs, $tbl_checkstockdetail_list->TotalRecs, $tbl_checkstockdetail_list->AutoHidePager) ?>
<?php if ($tbl_checkstockdetail_list->Pager->RecordCount > 0 && $tbl_checkstockdetail_list->Pager->Visible) { ?>
<div class="ew-pager">
<span><?php echo $Language->Phrase("Page") ?>&nbsp;</span>
<div class="ew-prev-next"><div class="input-group input-group-sm">
<div class="input-group-prepend">
<!-- first page button -->
	<?php if ($tbl_checkstockdetail_list->Pager->FirstButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerFirst") ?>" href="<?php echo $tbl_checkstockdetail_list->pageUrl() ?>start=<?php echo $tbl_checkstockdetail_list->Pager->FirstButton->Start ?>"><i class="icon-first ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerFirst") ?>"><i class="icon-first ew-icon"></i></a>
	<?php } ?>
<!-- previous page button -->
	<?php if ($tbl_checkstockdetail_list->Pager->PrevButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerPrevious") ?>" href="<?php echo $tbl_checkstockdetail_list->pageUrl() ?>start=<?php echo $tbl_checkstockdetail_list->Pager->PrevButton->Start ?>"><i class="icon-prev ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerPrevious") ?>"><i class="icon-prev ew-icon"></i></a>
	<?php } ?>
</div>
<!-- current page number -->
	<input class="form-control" type="text" name="<?php echo TABLE_PAGE_NO ?>" value="<?php echo $tbl_checkstockdetail_list->Pager->CurrentPage ?>">
<div class="input-group-append">
<!-- next page button -->
	<?php if ($tbl_checkstockdetail_list->Pager->NextButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerNext") ?>" href="<?php echo $tbl_checkstockdetail_list->pageUrl() ?>start=<?php echo $tbl_checkstockdetail_list->Pager->NextButton->Start ?>"><i class="icon-next ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerNext") ?>"><i class="icon-next ew-icon"></i></a>
	<?php } ?>
<!-- last page button -->
	<?php if ($tbl_checkstockdetail_list->Pager->LastButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerLast") ?>" href="<?php echo $tbl_checkstockdetail_list->pageUrl() ?>start=<?php echo $tbl_checkstockdetail_list->Pager->LastButton->Start ?>"><i class="icon-last ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerLast") ?>"><i class="icon-last ew-icon"></i></a>
	<?php } ?>
</div>
</div>
</div>
<span>&nbsp;<?php echo $Language->Phrase("of") ?>&nbsp;<?php echo $tbl_checkstockdetail_list->Pager->PageCount ?></span>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php if ($tbl_checkstockdetail_list->Pager->RecordCount > 0) { ?>
<div class="ew-pager ew-rec">
	<span><?php echo $Language->Phrase("Record") ?>&nbsp;<?php echo $tbl_checkstockdetail_list->Pager->FromIndex ?>&nbsp;<?php echo $Language->Phrase("To") ?>&nbsp;<?php echo $tbl_checkstockdetail_list->Pager->ToIndex ?>&nbsp;<?php echo $Language->Phrase("Of") ?>&nbsp;<?php echo $tbl_checkstockdetail_list->Pager->RecordCount ?></span>
</div>
<?php } ?>
<?php if ($tbl_checkstockdetail_list->TotalRecs > 0 && (!$tbl_checkstockdetail_list->AutoHidePageSizeSelector || $tbl_checkstockdetail_list->Pager->Visible)) { ?>
<div class="ew-pager">
<input type="hidden" name="t" value="tbl_checkstockdetail">
<select name="<?php echo TABLE_REC_PER_PAGE ?>" class="form-control form-control-sm ew-tooltip" title="<?php echo $Language->phrase("RecordsPerPage") ?>" onchange="this.form.submit();">
<option value="20"<?php if ($tbl_checkstockdetail_list->DisplayRecs == 20) { ?> selected<?php } ?>>20</option>
<option value="50"<?php if ($tbl_checkstockdetail_list->DisplayRecs == 50) { ?> selected<?php } ?>>50</option>
<option value="100"<?php if ($tbl_checkstockdetail_list->DisplayRecs == 100) { ?> selected<?php } ?>>100</option>
<option value="200"<?php if ($tbl_checkstockdetail_list->DisplayRecs == 200) { ?> selected<?php } ?>>200</option>
<option value="500"<?php if ($tbl_checkstockdetail_list->DisplayRecs == 500) { ?> selected<?php } ?>>500</option>
<option value="ALL"<?php if ($tbl_checkstockdetail->getRecordsPerPage() == -1) { ?> selected<?php } ?>><?php echo $Language->Phrase("AllRecords") ?></option>
</select>
</div>
<?php } ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $tbl_checkstockdetail_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($tbl_checkstockdetail_list->TotalRecs == 0 && !$tbl_checkstockdetail->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $tbl_checkstockdetail_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$tbl_checkstockdetail_list->showPageFooter();
if (DEBUG_ENABLED)
	echo GetDebugMessage();
?>
<?php if (!$tbl_checkstockdetail->isExport()) { ?>
<script>

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php } ?>
<?php include_once "footer.php" ?>
<?php
$tbl_checkstockdetail_list->terminate();
?>