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
$tbl_packingdetail_list = new tbl_packingdetail_list();

// Run the page
$tbl_packingdetail_list->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$tbl_packingdetail_list->Page_Render();
?>
<?php include_once "header.php" ?>
<?php if (!$tbl_packingdetail->isExport()) { ?>
<script>

// Form object
currentPageID = ew.PAGE_ID = "list";
var ftbl_packingdetaillist = currentForm = new ew.Form("ftbl_packingdetaillist", "list");
ftbl_packingdetaillist.formKeyCountName = '<?php echo $tbl_packingdetail_list->FormKeyCountName ?>';

// Form_CustomValidate event
ftbl_packingdetaillist.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

	// Your custom validation code here, return false if invalid.
	return true;
}

// Use JavaScript validation or not
ftbl_packingdetaillist.validateRequired = <?php echo json_encode(CLIENT_VALIDATE) ?>;

// Dynamic selection lists
ftbl_packingdetaillist.lists["x_PackingOrNoPacking"] = <?php echo $tbl_packingdetail_list->PackingOrNoPacking->Lookup->toClientList() ?>;
ftbl_packingdetaillist.lists["x_PackingOrNoPacking"].options = <?php echo JsonEncode($tbl_packingdetail_list->PackingOrNoPacking->options(FALSE, TRUE)) ?>;
ftbl_packingdetaillist.lists["x_PE_film_Cover"] = <?php echo $tbl_packingdetail_list->PE_film_Cover->Lookup->toClientList() ?>;
ftbl_packingdetaillist.lists["x_PE_film_Cover"].options = <?php echo JsonEncode($tbl_packingdetail_list->PE_film_Cover->options(FALSE, TRUE)) ?>;
ftbl_packingdetaillist.lists["x_finishpacking"] = <?php echo $tbl_packingdetail_list->finishpacking->Lookup->toClientList() ?>;
ftbl_packingdetaillist.lists["x_finishpacking"].options = <?php echo JsonEncode($tbl_packingdetail_list->finishpacking->options(FALSE, TRUE)) ?>;

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
<?php if (!$tbl_packingdetail->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($tbl_packingdetail_list->TotalRecs > 0 && $tbl_packingdetail_list->ExportOptions->visible()) { ?>
<?php $tbl_packingdetail_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($tbl_packingdetail_list->ImportOptions->visible()) { ?>
<?php $tbl_packingdetail_list->ImportOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php if (!$tbl_packingdetail->isExport() || EXPORT_MASTER_RECORD && $tbl_packingdetail->isExport("print")) { ?>
<?php
if ($tbl_packingdetail_list->DbMasterFilter <> "" && $tbl_packingdetail->getCurrentMasterTable() == "packing") {
	if ($tbl_packingdetail_list->MasterRecordExists) {
		include_once "packingmaster.php";
	}
}
?>
<?php } ?>
<?php
$tbl_packingdetail_list->renderOtherOptions();
?>
<?php $tbl_packingdetail_list->showPageHeader(); ?>
<?php
$tbl_packingdetail_list->showMessage();
?>
<?php if ($tbl_packingdetail_list->TotalRecs > 0 || $tbl_packingdetail->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($tbl_packingdetail_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> tbl_packingdetail">
<?php if (!$tbl_packingdetail->isExport()) { ?>
<div class="card-header ew-grid-upper-panel">
<?php if (!$tbl_packingdetail->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php if (!isset($tbl_packingdetail_list->Pager)) $tbl_packingdetail_list->Pager = new PrevNextPager($tbl_packingdetail_list->StartRec, $tbl_packingdetail_list->DisplayRecs, $tbl_packingdetail_list->TotalRecs, $tbl_packingdetail_list->AutoHidePager) ?>
<?php if ($tbl_packingdetail_list->Pager->RecordCount > 0 && $tbl_packingdetail_list->Pager->Visible) { ?>
<div class="ew-pager">
<span><?php echo $Language->Phrase("Page") ?>&nbsp;</span>
<div class="ew-prev-next"><div class="input-group input-group-sm">
<div class="input-group-prepend">
<!-- first page button -->
	<?php if ($tbl_packingdetail_list->Pager->FirstButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerFirst") ?>" href="<?php echo $tbl_packingdetail_list->pageUrl() ?>start=<?php echo $tbl_packingdetail_list->Pager->FirstButton->Start ?>"><i class="icon-first ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerFirst") ?>"><i class="icon-first ew-icon"></i></a>
	<?php } ?>
<!-- previous page button -->
	<?php if ($tbl_packingdetail_list->Pager->PrevButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerPrevious") ?>" href="<?php echo $tbl_packingdetail_list->pageUrl() ?>start=<?php echo $tbl_packingdetail_list->Pager->PrevButton->Start ?>"><i class="icon-prev ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerPrevious") ?>"><i class="icon-prev ew-icon"></i></a>
	<?php } ?>
</div>
<!-- current page number -->
	<input class="form-control" type="text" name="<?php echo TABLE_PAGE_NO ?>" value="<?php echo $tbl_packingdetail_list->Pager->CurrentPage ?>">
<div class="input-group-append">
<!-- next page button -->
	<?php if ($tbl_packingdetail_list->Pager->NextButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerNext") ?>" href="<?php echo $tbl_packingdetail_list->pageUrl() ?>start=<?php echo $tbl_packingdetail_list->Pager->NextButton->Start ?>"><i class="icon-next ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerNext") ?>"><i class="icon-next ew-icon"></i></a>
	<?php } ?>
<!-- last page button -->
	<?php if ($tbl_packingdetail_list->Pager->LastButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerLast") ?>" href="<?php echo $tbl_packingdetail_list->pageUrl() ?>start=<?php echo $tbl_packingdetail_list->Pager->LastButton->Start ?>"><i class="icon-last ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerLast") ?>"><i class="icon-last ew-icon"></i></a>
	<?php } ?>
</div>
</div>
</div>
<span>&nbsp;<?php echo $Language->Phrase("of") ?>&nbsp;<?php echo $tbl_packingdetail_list->Pager->PageCount ?></span>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php if ($tbl_packingdetail_list->Pager->RecordCount > 0) { ?>
<div class="ew-pager ew-rec">
	<span><?php echo $Language->Phrase("Record") ?>&nbsp;<?php echo $tbl_packingdetail_list->Pager->FromIndex ?>&nbsp;<?php echo $Language->Phrase("To") ?>&nbsp;<?php echo $tbl_packingdetail_list->Pager->ToIndex ?>&nbsp;<?php echo $Language->Phrase("Of") ?>&nbsp;<?php echo $tbl_packingdetail_list->Pager->RecordCount ?></span>
</div>
<?php } ?>
<?php if ($tbl_packingdetail_list->TotalRecs > 0 && (!$tbl_packingdetail_list->AutoHidePageSizeSelector || $tbl_packingdetail_list->Pager->Visible)) { ?>
<div class="ew-pager">
<input type="hidden" name="t" value="tbl_packingdetail">
<select name="<?php echo TABLE_REC_PER_PAGE ?>" class="form-control form-control-sm ew-tooltip" title="<?php echo $Language->phrase("RecordsPerPage") ?>" onchange="this.form.submit();">
<option value="20"<?php if ($tbl_packingdetail_list->DisplayRecs == 20) { ?> selected<?php } ?>>20</option>
<option value="50"<?php if ($tbl_packingdetail_list->DisplayRecs == 50) { ?> selected<?php } ?>>50</option>
<option value="100"<?php if ($tbl_packingdetail_list->DisplayRecs == 100) { ?> selected<?php } ?>>100</option>
<option value="200"<?php if ($tbl_packingdetail_list->DisplayRecs == 200) { ?> selected<?php } ?>>200</option>
<option value="500"<?php if ($tbl_packingdetail_list->DisplayRecs == 500) { ?> selected<?php } ?>>500</option>
<option value="ALL"<?php if ($tbl_packingdetail->getRecordsPerPage() == -1) { ?> selected<?php } ?>><?php echo $Language->Phrase("AllRecords") ?></option>
</select>
</div>
<?php } ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $tbl_packingdetail_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
<form name="ftbl_packingdetaillist" id="ftbl_packingdetaillist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($tbl_packingdetail_list->CheckToken) { ?>
<input type="hidden" name="<?php echo TOKEN_NAME ?>" value="<?php echo $tbl_packingdetail_list->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="tbl_packingdetail">
<input type="hidden" name="exporttype" id="exporttype" value="">
<?php if ($tbl_packingdetail->getCurrentMasterTable() == "packing" && $tbl_packingdetail->CurrentAction) { ?>
<input type="hidden" name="<?php echo TABLE_SHOW_MASTER ?>" value="packing">
<input type="hidden" name="fk_Id_packing" value="<?php echo $tbl_packingdetail->ID_packing->getSessionValue() ?>">
<?php } ?>
<div id="gmp_tbl_packingdetail" class="<?php if (IsResponsiveLayout()) { ?>table-responsive <?php } ?>card-body ew-grid-middle-panel">
<?php if ($tbl_packingdetail_list->TotalRecs > 0 || $tbl_packingdetail->isGridEdit()) { ?>
<table id="tbl_tbl_packingdetaillist" class="table ew-table"><!-- .ew-table ##-->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$tbl_packingdetail_list->RowType = ROWTYPE_HEADER;

// Render list options
$tbl_packingdetail_list->renderListOptions();

// Render list options (header, left)
$tbl_packingdetail_list->ListOptions->render("header", "left");
?>
<?php if ($tbl_packingdetail->ID_packingDetail->Visible) { // ID_packingDetail ?>
	<?php if ($tbl_packingdetail->sortUrl($tbl_packingdetail->ID_packingDetail) == "") { ?>
		<th data-name="ID_packingDetail" class="<?php echo $tbl_packingdetail->ID_packingDetail->headerCellClass() ?>" style="white-space: nowrap;"><div id="elh_tbl_packingdetail_ID_packingDetail" class="tbl_packingdetail_ID_packingDetail"><div class="ew-table-header-caption"><?php echo $tbl_packingdetail->ID_packingDetail->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="ID_packingDetail" class="<?php echo $tbl_packingdetail->ID_packingDetail->headerCellClass() ?>" style="white-space: nowrap;"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $tbl_packingdetail->SortUrl($tbl_packingdetail->ID_packingDetail) ?>',2);"><div id="elh_tbl_packingdetail_ID_packingDetail" class="tbl_packingdetail_ID_packingDetail">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $tbl_packingdetail->ID_packingDetail->caption() ?></span><span class="ew-table-header-sort"><?php if ($tbl_packingdetail->ID_packingDetail->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($tbl_packingdetail->ID_packingDetail->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($tbl_packingdetail->PackingOrNoPacking->Visible) { // PackingOrNoPacking ?>
	<?php if ($tbl_packingdetail->sortUrl($tbl_packingdetail->PackingOrNoPacking) == "") { ?>
		<th data-name="PackingOrNoPacking" class="<?php echo $tbl_packingdetail->PackingOrNoPacking->headerCellClass() ?>" style="white-space: nowrap;"><div id="elh_tbl_packingdetail_PackingOrNoPacking" class="tbl_packingdetail_PackingOrNoPacking"><div class="ew-table-header-caption"><?php echo $tbl_packingdetail->PackingOrNoPacking->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="PackingOrNoPacking" class="<?php echo $tbl_packingdetail->PackingOrNoPacking->headerCellClass() ?>" style="white-space: nowrap;"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $tbl_packingdetail->SortUrl($tbl_packingdetail->PackingOrNoPacking) ?>',2);"><div id="elh_tbl_packingdetail_PackingOrNoPacking" class="tbl_packingdetail_PackingOrNoPacking">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $tbl_packingdetail->PackingOrNoPacking->caption() ?></span><span class="ew-table-header-sort"><?php if ($tbl_packingdetail->PackingOrNoPacking->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($tbl_packingdetail->PackingOrNoPacking->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($tbl_packingdetail->PackingType->Visible) { // PackingType ?>
	<?php if ($tbl_packingdetail->sortUrl($tbl_packingdetail->PackingType) == "") { ?>
		<th data-name="PackingType" class="<?php echo $tbl_packingdetail->PackingType->headerCellClass() ?>" style="white-space: nowrap;"><div id="elh_tbl_packingdetail_PackingType" class="tbl_packingdetail_PackingType"><div class="ew-table-header-caption"><?php echo $tbl_packingdetail->PackingType->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="PackingType" class="<?php echo $tbl_packingdetail->PackingType->headerCellClass() ?>" style="white-space: nowrap;"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $tbl_packingdetail->SortUrl($tbl_packingdetail->PackingType) ?>',2);"><div id="elh_tbl_packingdetail_PackingType" class="tbl_packingdetail_PackingType">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $tbl_packingdetail->PackingType->caption() ?></span><span class="ew-table-header-sort"><?php if ($tbl_packingdetail->PackingType->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($tbl_packingdetail->PackingType->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($tbl_packingdetail->Length->Visible) { // Length ?>
	<?php if ($tbl_packingdetail->sortUrl($tbl_packingdetail->Length) == "") { ?>
		<th data-name="Length" class="<?php echo $tbl_packingdetail->Length->headerCellClass() ?>" style="white-space: nowrap;"><div id="elh_tbl_packingdetail_Length" class="tbl_packingdetail_Length"><div class="ew-table-header-caption"><?php echo $tbl_packingdetail->Length->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Length" class="<?php echo $tbl_packingdetail->Length->headerCellClass() ?>" style="white-space: nowrap;"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $tbl_packingdetail->SortUrl($tbl_packingdetail->Length) ?>',2);"><div id="elh_tbl_packingdetail_Length" class="tbl_packingdetail_Length">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $tbl_packingdetail->Length->caption() ?></span><span class="ew-table-header-sort"><?php if ($tbl_packingdetail->Length->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($tbl_packingdetail->Length->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($tbl_packingdetail->Width->Visible) { // Width ?>
	<?php if ($tbl_packingdetail->sortUrl($tbl_packingdetail->Width) == "") { ?>
		<th data-name="Width" class="<?php echo $tbl_packingdetail->Width->headerCellClass() ?>" style="white-space: nowrap;"><div id="elh_tbl_packingdetail_Width" class="tbl_packingdetail_Width"><div class="ew-table-header-caption"><?php echo $tbl_packingdetail->Width->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Width" class="<?php echo $tbl_packingdetail->Width->headerCellClass() ?>" style="white-space: nowrap;"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $tbl_packingdetail->SortUrl($tbl_packingdetail->Width) ?>',2);"><div id="elh_tbl_packingdetail_Width" class="tbl_packingdetail_Width">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $tbl_packingdetail->Width->caption() ?></span><span class="ew-table-header-sort"><?php if ($tbl_packingdetail->Width->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($tbl_packingdetail->Width->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($tbl_packingdetail->Heigth->Visible) { // Heigth ?>
	<?php if ($tbl_packingdetail->sortUrl($tbl_packingdetail->Heigth) == "") { ?>
		<th data-name="Heigth" class="<?php echo $tbl_packingdetail->Heigth->headerCellClass() ?>" style="white-space: nowrap;"><div id="elh_tbl_packingdetail_Heigth" class="tbl_packingdetail_Heigth"><div class="ew-table-header-caption"><?php echo $tbl_packingdetail->Heigth->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Heigth" class="<?php echo $tbl_packingdetail->Heigth->headerCellClass() ?>" style="white-space: nowrap;"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $tbl_packingdetail->SortUrl($tbl_packingdetail->Heigth) ?>',2);"><div id="elh_tbl_packingdetail_Heigth" class="tbl_packingdetail_Heigth">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $tbl_packingdetail->Heigth->caption() ?></span><span class="ew-table-header-sort"><?php if ($tbl_packingdetail->Heigth->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($tbl_packingdetail->Heigth->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($tbl_packingdetail->PE_film_Cover->Visible) { // PE_film_Cover ?>
	<?php if ($tbl_packingdetail->sortUrl($tbl_packingdetail->PE_film_Cover) == "") { ?>
		<th data-name="PE_film_Cover" class="<?php echo $tbl_packingdetail->PE_film_Cover->headerCellClass() ?>" style="white-space: nowrap;"><div id="elh_tbl_packingdetail_PE_film_Cover" class="tbl_packingdetail_PE_film_Cover"><div class="ew-table-header-caption"><?php echo $tbl_packingdetail->PE_film_Cover->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="PE_film_Cover" class="<?php echo $tbl_packingdetail->PE_film_Cover->headerCellClass() ?>" style="white-space: nowrap;"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $tbl_packingdetail->SortUrl($tbl_packingdetail->PE_film_Cover) ?>',2);"><div id="elh_tbl_packingdetail_PE_film_Cover" class="tbl_packingdetail_PE_film_Cover">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $tbl_packingdetail->PE_film_Cover->caption() ?></span><span class="ew-table-header-sort"><?php if ($tbl_packingdetail->PE_film_Cover->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($tbl_packingdetail->PE_film_Cover->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($tbl_packingdetail->finishpacking->Visible) { // finishpacking ?>
	<?php if ($tbl_packingdetail->sortUrl($tbl_packingdetail->finishpacking) == "") { ?>
		<th data-name="finishpacking" class="<?php echo $tbl_packingdetail->finishpacking->headerCellClass() ?>" style="white-space: nowrap;"><div id="elh_tbl_packingdetail_finishpacking" class="tbl_packingdetail_finishpacking"><div class="ew-table-header-caption"><?php echo $tbl_packingdetail->finishpacking->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="finishpacking" class="<?php echo $tbl_packingdetail->finishpacking->headerCellClass() ?>" style="white-space: nowrap;"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $tbl_packingdetail->SortUrl($tbl_packingdetail->finishpacking) ?>',2);"><div id="elh_tbl_packingdetail_finishpacking" class="tbl_packingdetail_finishpacking">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $tbl_packingdetail->finishpacking->caption() ?></span><span class="ew-table-header-sort"><?php if ($tbl_packingdetail->finishpacking->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($tbl_packingdetail->finishpacking->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$tbl_packingdetail_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
if ($tbl_packingdetail->ExportAll && $tbl_packingdetail->isExport()) {
	$tbl_packingdetail_list->StopRec = $tbl_packingdetail_list->TotalRecs;
} else {

	// Set the last record to display
	if ($tbl_packingdetail_list->TotalRecs > $tbl_packingdetail_list->StartRec + $tbl_packingdetail_list->DisplayRecs - 1)
		$tbl_packingdetail_list->StopRec = $tbl_packingdetail_list->StartRec + $tbl_packingdetail_list->DisplayRecs - 1;
	else
		$tbl_packingdetail_list->StopRec = $tbl_packingdetail_list->TotalRecs;
}
$tbl_packingdetail_list->RecCnt = $tbl_packingdetail_list->StartRec - 1;
if ($tbl_packingdetail_list->Recordset && !$tbl_packingdetail_list->Recordset->EOF) {
	$tbl_packingdetail_list->Recordset->moveFirst();
	$selectLimit = $tbl_packingdetail_list->UseSelectLimit;
	if (!$selectLimit && $tbl_packingdetail_list->StartRec > 1)
		$tbl_packingdetail_list->Recordset->move($tbl_packingdetail_list->StartRec - 1);
} elseif (!$tbl_packingdetail->AllowAddDeleteRow && $tbl_packingdetail_list->StopRec == 0) {
	$tbl_packingdetail_list->StopRec = $tbl_packingdetail->GridAddRowCount;
}

// Initialize aggregate
$tbl_packingdetail->RowType = ROWTYPE_AGGREGATEINIT;
$tbl_packingdetail->resetAttributes();
$tbl_packingdetail_list->renderRow();
while ($tbl_packingdetail_list->RecCnt < $tbl_packingdetail_list->StopRec) {
	$tbl_packingdetail_list->RecCnt++;
	if ($tbl_packingdetail_list->RecCnt >= $tbl_packingdetail_list->StartRec) {
		$tbl_packingdetail_list->RowCnt++;

		// Set up key count
		$tbl_packingdetail_list->KeyCount = $tbl_packingdetail_list->RowIndex;

		// Init row class and style
		$tbl_packingdetail->resetAttributes();
		$tbl_packingdetail->CssClass = "";
		if ($tbl_packingdetail->isGridAdd()) {
		} else {
			$tbl_packingdetail_list->loadRowValues($tbl_packingdetail_list->Recordset); // Load row values
		}
		$tbl_packingdetail->RowType = ROWTYPE_VIEW; // Render view

		// Set up row id / data-rowindex
		$tbl_packingdetail->RowAttrs = array_merge($tbl_packingdetail->RowAttrs, array('data-rowindex'=>$tbl_packingdetail_list->RowCnt, 'id'=>'r' . $tbl_packingdetail_list->RowCnt . '_tbl_packingdetail', 'data-rowtype'=>$tbl_packingdetail->RowType));

		// Render row
		$tbl_packingdetail_list->renderRow();

		// Render list options
		$tbl_packingdetail_list->renderListOptions();
?>
	<tr<?php echo $tbl_packingdetail->rowAttributes() ?>>
<?php

// Render list options (body, left)
$tbl_packingdetail_list->ListOptions->render("body", "left", $tbl_packingdetail_list->RowCnt);
?>
	<?php if ($tbl_packingdetail->ID_packingDetail->Visible) { // ID_packingDetail ?>
		<td data-name="ID_packingDetail"<?php echo $tbl_packingdetail->ID_packingDetail->cellAttributes() ?>>
<span id="el<?php echo $tbl_packingdetail_list->RowCnt ?>_tbl_packingdetail_ID_packingDetail" class="tbl_packingdetail_ID_packingDetail">
<span<?php echo $tbl_packingdetail->ID_packingDetail->viewAttributes() ?>>
<?php echo $tbl_packingdetail->ID_packingDetail->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($tbl_packingdetail->PackingOrNoPacking->Visible) { // PackingOrNoPacking ?>
		<td data-name="PackingOrNoPacking"<?php echo $tbl_packingdetail->PackingOrNoPacking->cellAttributes() ?>>
<span id="el<?php echo $tbl_packingdetail_list->RowCnt ?>_tbl_packingdetail_PackingOrNoPacking" class="tbl_packingdetail_PackingOrNoPacking">
<span<?php echo $tbl_packingdetail->PackingOrNoPacking->viewAttributes() ?>>
<?php echo $tbl_packingdetail->PackingOrNoPacking->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($tbl_packingdetail->PackingType->Visible) { // PackingType ?>
		<td data-name="PackingType"<?php echo $tbl_packingdetail->PackingType->cellAttributes() ?>>
<span id="el<?php echo $tbl_packingdetail_list->RowCnt ?>_tbl_packingdetail_PackingType" class="tbl_packingdetail_PackingType">
<span<?php echo $tbl_packingdetail->PackingType->viewAttributes() ?>>
<?php echo $tbl_packingdetail->PackingType->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($tbl_packingdetail->Length->Visible) { // Length ?>
		<td data-name="Length"<?php echo $tbl_packingdetail->Length->cellAttributes() ?>>
<span id="el<?php echo $tbl_packingdetail_list->RowCnt ?>_tbl_packingdetail_Length" class="tbl_packingdetail_Length">
<span<?php echo $tbl_packingdetail->Length->viewAttributes() ?>>
<?php echo $tbl_packingdetail->Length->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($tbl_packingdetail->Width->Visible) { // Width ?>
		<td data-name="Width"<?php echo $tbl_packingdetail->Width->cellAttributes() ?>>
<span id="el<?php echo $tbl_packingdetail_list->RowCnt ?>_tbl_packingdetail_Width" class="tbl_packingdetail_Width">
<span<?php echo $tbl_packingdetail->Width->viewAttributes() ?>>
<?php echo $tbl_packingdetail->Width->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($tbl_packingdetail->Heigth->Visible) { // Heigth ?>
		<td data-name="Heigth"<?php echo $tbl_packingdetail->Heigth->cellAttributes() ?>>
<span id="el<?php echo $tbl_packingdetail_list->RowCnt ?>_tbl_packingdetail_Heigth" class="tbl_packingdetail_Heigth">
<span<?php echo $tbl_packingdetail->Heigth->viewAttributes() ?>>
<?php echo $tbl_packingdetail->Heigth->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($tbl_packingdetail->PE_film_Cover->Visible) { // PE_film_Cover ?>
		<td data-name="PE_film_Cover"<?php echo $tbl_packingdetail->PE_film_Cover->cellAttributes() ?>>
<span id="el<?php echo $tbl_packingdetail_list->RowCnt ?>_tbl_packingdetail_PE_film_Cover" class="tbl_packingdetail_PE_film_Cover">
<span<?php echo $tbl_packingdetail->PE_film_Cover->viewAttributes() ?>>
<?php echo $tbl_packingdetail->PE_film_Cover->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($tbl_packingdetail->finishpacking->Visible) { // finishpacking ?>
		<td data-name="finishpacking"<?php echo $tbl_packingdetail->finishpacking->cellAttributes() ?>>
<span id="el<?php echo $tbl_packingdetail_list->RowCnt ?>_tbl_packingdetail_finishpacking" class="tbl_packingdetail_finishpacking">
<span<?php echo $tbl_packingdetail->finishpacking->viewAttributes() ?>>
<?php echo $tbl_packingdetail->finishpacking->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$tbl_packingdetail_list->ListOptions->render("body", "right", $tbl_packingdetail_list->RowCnt);
?>
	</tr>
<?php
	}
	if (!$tbl_packingdetail->isGridAdd())
		$tbl_packingdetail_list->Recordset->moveNext();
}
?>
</tbody>
</table><!-- /.ew-table -->
<?php } ?>
<?php if (!$tbl_packingdetail->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</div><!-- /.ew-grid-middle-panel -->
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($tbl_packingdetail_list->Recordset)
	$tbl_packingdetail_list->Recordset->Close();
?>
<?php if (!$tbl_packingdetail->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$tbl_packingdetail->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php if (!isset($tbl_packingdetail_list->Pager)) $tbl_packingdetail_list->Pager = new PrevNextPager($tbl_packingdetail_list->StartRec, $tbl_packingdetail_list->DisplayRecs, $tbl_packingdetail_list->TotalRecs, $tbl_packingdetail_list->AutoHidePager) ?>
<?php if ($tbl_packingdetail_list->Pager->RecordCount > 0 && $tbl_packingdetail_list->Pager->Visible) { ?>
<div class="ew-pager">
<span><?php echo $Language->Phrase("Page") ?>&nbsp;</span>
<div class="ew-prev-next"><div class="input-group input-group-sm">
<div class="input-group-prepend">
<!-- first page button -->
	<?php if ($tbl_packingdetail_list->Pager->FirstButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerFirst") ?>" href="<?php echo $tbl_packingdetail_list->pageUrl() ?>start=<?php echo $tbl_packingdetail_list->Pager->FirstButton->Start ?>"><i class="icon-first ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerFirst") ?>"><i class="icon-first ew-icon"></i></a>
	<?php } ?>
<!-- previous page button -->
	<?php if ($tbl_packingdetail_list->Pager->PrevButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerPrevious") ?>" href="<?php echo $tbl_packingdetail_list->pageUrl() ?>start=<?php echo $tbl_packingdetail_list->Pager->PrevButton->Start ?>"><i class="icon-prev ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerPrevious") ?>"><i class="icon-prev ew-icon"></i></a>
	<?php } ?>
</div>
<!-- current page number -->
	<input class="form-control" type="text" name="<?php echo TABLE_PAGE_NO ?>" value="<?php echo $tbl_packingdetail_list->Pager->CurrentPage ?>">
<div class="input-group-append">
<!-- next page button -->
	<?php if ($tbl_packingdetail_list->Pager->NextButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerNext") ?>" href="<?php echo $tbl_packingdetail_list->pageUrl() ?>start=<?php echo $tbl_packingdetail_list->Pager->NextButton->Start ?>"><i class="icon-next ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerNext") ?>"><i class="icon-next ew-icon"></i></a>
	<?php } ?>
<!-- last page button -->
	<?php if ($tbl_packingdetail_list->Pager->LastButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerLast") ?>" href="<?php echo $tbl_packingdetail_list->pageUrl() ?>start=<?php echo $tbl_packingdetail_list->Pager->LastButton->Start ?>"><i class="icon-last ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerLast") ?>"><i class="icon-last ew-icon"></i></a>
	<?php } ?>
</div>
</div>
</div>
<span>&nbsp;<?php echo $Language->Phrase("of") ?>&nbsp;<?php echo $tbl_packingdetail_list->Pager->PageCount ?></span>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php if ($tbl_packingdetail_list->Pager->RecordCount > 0) { ?>
<div class="ew-pager ew-rec">
	<span><?php echo $Language->Phrase("Record") ?>&nbsp;<?php echo $tbl_packingdetail_list->Pager->FromIndex ?>&nbsp;<?php echo $Language->Phrase("To") ?>&nbsp;<?php echo $tbl_packingdetail_list->Pager->ToIndex ?>&nbsp;<?php echo $Language->Phrase("Of") ?>&nbsp;<?php echo $tbl_packingdetail_list->Pager->RecordCount ?></span>
</div>
<?php } ?>
<?php if ($tbl_packingdetail_list->TotalRecs > 0 && (!$tbl_packingdetail_list->AutoHidePageSizeSelector || $tbl_packingdetail_list->Pager->Visible)) { ?>
<div class="ew-pager">
<input type="hidden" name="t" value="tbl_packingdetail">
<select name="<?php echo TABLE_REC_PER_PAGE ?>" class="form-control form-control-sm ew-tooltip" title="<?php echo $Language->phrase("RecordsPerPage") ?>" onchange="this.form.submit();">
<option value="20"<?php if ($tbl_packingdetail_list->DisplayRecs == 20) { ?> selected<?php } ?>>20</option>
<option value="50"<?php if ($tbl_packingdetail_list->DisplayRecs == 50) { ?> selected<?php } ?>>50</option>
<option value="100"<?php if ($tbl_packingdetail_list->DisplayRecs == 100) { ?> selected<?php } ?>>100</option>
<option value="200"<?php if ($tbl_packingdetail_list->DisplayRecs == 200) { ?> selected<?php } ?>>200</option>
<option value="500"<?php if ($tbl_packingdetail_list->DisplayRecs == 500) { ?> selected<?php } ?>>500</option>
<option value="ALL"<?php if ($tbl_packingdetail->getRecordsPerPage() == -1) { ?> selected<?php } ?>><?php echo $Language->Phrase("AllRecords") ?></option>
</select>
</div>
<?php } ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $tbl_packingdetail_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($tbl_packingdetail_list->TotalRecs == 0 && !$tbl_packingdetail->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $tbl_packingdetail_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$tbl_packingdetail_list->showPageFooter();
if (DEBUG_ENABLED)
	echo GetDebugMessage();
?>
<?php if (!$tbl_packingdetail->isExport()) { ?>
<script>

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php } ?>
<?php include_once "footer.php" ?>
<?php
$tbl_packingdetail_list->terminate();
?>