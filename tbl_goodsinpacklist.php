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
$tbl_goodsinpack_list = new tbl_goodsinpack_list();

// Run the page
$tbl_goodsinpack_list->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$tbl_goodsinpack_list->Page_Render();
?>
<?php include_once "header.php" ?>
<?php if (!$tbl_goodsinpack->isExport()) { ?>
<script>

// Form object
currentPageID = ew.PAGE_ID = "list";
var ftbl_goodsinpacklist = currentForm = new ew.Form("ftbl_goodsinpacklist", "list");
ftbl_goodsinpacklist.formKeyCountName = '<?php echo $tbl_goodsinpack_list->FormKeyCountName ?>';

// Form_CustomValidate event
ftbl_goodsinpacklist.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

	// Your custom validation code here, return false if invalid.
	return true;
}

// Use JavaScript validation or not
ftbl_goodsinpacklist.validateRequired = <?php echo json_encode(CLIENT_VALIDATE) ?>;

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
<?php if (!$tbl_goodsinpack->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($tbl_goodsinpack_list->TotalRecs > 0 && $tbl_goodsinpack_list->ExportOptions->visible()) { ?>
<?php $tbl_goodsinpack_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($tbl_goodsinpack_list->ImportOptions->visible()) { ?>
<?php $tbl_goodsinpack_list->ImportOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php if (!$tbl_goodsinpack->isExport() || EXPORT_MASTER_RECORD && $tbl_goodsinpack->isExport("print")) { ?>
<?php
if ($tbl_goodsinpack_list->DbMasterFilter <> "" && $tbl_goodsinpack->getCurrentMasterTable() == "tbl_packingdetail") {
	if ($tbl_goodsinpack_list->MasterRecordExists) {
		include_once "tbl_packingdetailmaster.php";
	}
}
?>
<?php } ?>
<?php
$tbl_goodsinpack_list->renderOtherOptions();
?>
<?php $tbl_goodsinpack_list->showPageHeader(); ?>
<?php
$tbl_goodsinpack_list->showMessage();
?>
<?php if ($tbl_goodsinpack_list->TotalRecs > 0 || $tbl_goodsinpack->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($tbl_goodsinpack_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> tbl_goodsinpack">
<?php if (!$tbl_goodsinpack->isExport()) { ?>
<div class="card-header ew-grid-upper-panel">
<?php if (!$tbl_goodsinpack->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php if (!isset($tbl_goodsinpack_list->Pager)) $tbl_goodsinpack_list->Pager = new PrevNextPager($tbl_goodsinpack_list->StartRec, $tbl_goodsinpack_list->DisplayRecs, $tbl_goodsinpack_list->TotalRecs, $tbl_goodsinpack_list->AutoHidePager) ?>
<?php if ($tbl_goodsinpack_list->Pager->RecordCount > 0 && $tbl_goodsinpack_list->Pager->Visible) { ?>
<div class="ew-pager">
<span><?php echo $Language->Phrase("Page") ?>&nbsp;</span>
<div class="ew-prev-next"><div class="input-group input-group-sm">
<div class="input-group-prepend">
<!-- first page button -->
	<?php if ($tbl_goodsinpack_list->Pager->FirstButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerFirst") ?>" href="<?php echo $tbl_goodsinpack_list->pageUrl() ?>start=<?php echo $tbl_goodsinpack_list->Pager->FirstButton->Start ?>"><i class="icon-first ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerFirst") ?>"><i class="icon-first ew-icon"></i></a>
	<?php } ?>
<!-- previous page button -->
	<?php if ($tbl_goodsinpack_list->Pager->PrevButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerPrevious") ?>" href="<?php echo $tbl_goodsinpack_list->pageUrl() ?>start=<?php echo $tbl_goodsinpack_list->Pager->PrevButton->Start ?>"><i class="icon-prev ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerPrevious") ?>"><i class="icon-prev ew-icon"></i></a>
	<?php } ?>
</div>
<!-- current page number -->
	<input class="form-control" type="text" name="<?php echo TABLE_PAGE_NO ?>" value="<?php echo $tbl_goodsinpack_list->Pager->CurrentPage ?>">
<div class="input-group-append">
<!-- next page button -->
	<?php if ($tbl_goodsinpack_list->Pager->NextButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerNext") ?>" href="<?php echo $tbl_goodsinpack_list->pageUrl() ?>start=<?php echo $tbl_goodsinpack_list->Pager->NextButton->Start ?>"><i class="icon-next ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerNext") ?>"><i class="icon-next ew-icon"></i></a>
	<?php } ?>
<!-- last page button -->
	<?php if ($tbl_goodsinpack_list->Pager->LastButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerLast") ?>" href="<?php echo $tbl_goodsinpack_list->pageUrl() ?>start=<?php echo $tbl_goodsinpack_list->Pager->LastButton->Start ?>"><i class="icon-last ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerLast") ?>"><i class="icon-last ew-icon"></i></a>
	<?php } ?>
</div>
</div>
</div>
<span>&nbsp;<?php echo $Language->Phrase("of") ?>&nbsp;<?php echo $tbl_goodsinpack_list->Pager->PageCount ?></span>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php if ($tbl_goodsinpack_list->Pager->RecordCount > 0) { ?>
<div class="ew-pager ew-rec">
	<span><?php echo $Language->Phrase("Record") ?>&nbsp;<?php echo $tbl_goodsinpack_list->Pager->FromIndex ?>&nbsp;<?php echo $Language->Phrase("To") ?>&nbsp;<?php echo $tbl_goodsinpack_list->Pager->ToIndex ?>&nbsp;<?php echo $Language->Phrase("Of") ?>&nbsp;<?php echo $tbl_goodsinpack_list->Pager->RecordCount ?></span>
</div>
<?php } ?>
<?php if ($tbl_goodsinpack_list->TotalRecs > 0 && (!$tbl_goodsinpack_list->AutoHidePageSizeSelector || $tbl_goodsinpack_list->Pager->Visible)) { ?>
<div class="ew-pager">
<input type="hidden" name="t" value="tbl_goodsinpack">
<select name="<?php echo TABLE_REC_PER_PAGE ?>" class="form-control form-control-sm ew-tooltip" title="<?php echo $Language->phrase("RecordsPerPage") ?>" onchange="this.form.submit();">
<option value="20"<?php if ($tbl_goodsinpack_list->DisplayRecs == 20) { ?> selected<?php } ?>>20</option>
<option value="50"<?php if ($tbl_goodsinpack_list->DisplayRecs == 50) { ?> selected<?php } ?>>50</option>
<option value="100"<?php if ($tbl_goodsinpack_list->DisplayRecs == 100) { ?> selected<?php } ?>>100</option>
<option value="200"<?php if ($tbl_goodsinpack_list->DisplayRecs == 200) { ?> selected<?php } ?>>200</option>
<option value="500"<?php if ($tbl_goodsinpack_list->DisplayRecs == 500) { ?> selected<?php } ?>>500</option>
<option value="ALL"<?php if ($tbl_goodsinpack->getRecordsPerPage() == -1) { ?> selected<?php } ?>><?php echo $Language->Phrase("AllRecords") ?></option>
</select>
</div>
<?php } ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $tbl_goodsinpack_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
<form name="ftbl_goodsinpacklist" id="ftbl_goodsinpacklist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($tbl_goodsinpack_list->CheckToken) { ?>
<input type="hidden" name="<?php echo TOKEN_NAME ?>" value="<?php echo $tbl_goodsinpack_list->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="tbl_goodsinpack">
<input type="hidden" name="exporttype" id="exporttype" value="">
<?php if ($tbl_goodsinpack->getCurrentMasterTable() == "tbl_packingdetail" && $tbl_goodsinpack->CurrentAction) { ?>
<input type="hidden" name="<?php echo TABLE_SHOW_MASTER ?>" value="tbl_packingdetail">
<input type="hidden" name="fk_ID_packingDetail" value="<?php echo $tbl_goodsinpack->ID_packingDetail->getSessionValue() ?>">
<?php } ?>
<div id="gmp_tbl_goodsinpack" class="<?php if (IsResponsiveLayout()) { ?>table-responsive <?php } ?>card-body ew-grid-middle-panel">
<?php if ($tbl_goodsinpack_list->TotalRecs > 0 || $tbl_goodsinpack->isGridEdit()) { ?>
<table id="tbl_tbl_goodsinpacklist" class="table ew-table"><!-- .ew-table ##-->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$tbl_goodsinpack_list->RowType = ROWTYPE_HEADER;

// Render list options
$tbl_goodsinpack_list->renderListOptions();

// Render list options (header, left)
$tbl_goodsinpack_list->ListOptions->render("header", "left");
?>
<?php if ($tbl_goodsinpack->Code->Visible) { // Code ?>
	<?php if ($tbl_goodsinpack->sortUrl($tbl_goodsinpack->Code) == "") { ?>
		<th data-name="Code" class="<?php echo $tbl_goodsinpack->Code->headerCellClass() ?>" style="white-space: nowrap;"><div id="elh_tbl_goodsinpack_Code" class="tbl_goodsinpack_Code"><div class="ew-table-header-caption"><?php echo $tbl_goodsinpack->Code->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Code" class="<?php echo $tbl_goodsinpack->Code->headerCellClass() ?>" style="white-space: nowrap;"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $tbl_goodsinpack->SortUrl($tbl_goodsinpack->Code) ?>',2);"><div id="elh_tbl_goodsinpack_Code" class="tbl_goodsinpack_Code">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $tbl_goodsinpack->Code->caption() ?></span><span class="ew-table-header-sort"><?php if ($tbl_goodsinpack->Code->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($tbl_goodsinpack->Code->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($tbl_goodsinpack->PCS->Visible) { // PCS ?>
	<?php if ($tbl_goodsinpack->sortUrl($tbl_goodsinpack->PCS) == "") { ?>
		<th data-name="PCS" class="<?php echo $tbl_goodsinpack->PCS->headerCellClass() ?>" style="white-space: nowrap;"><div id="elh_tbl_goodsinpack_PCS" class="tbl_goodsinpack_PCS"><div class="ew-table-header-caption"><?php echo $tbl_goodsinpack->PCS->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="PCS" class="<?php echo $tbl_goodsinpack->PCS->headerCellClass() ?>" style="white-space: nowrap;"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $tbl_goodsinpack->SortUrl($tbl_goodsinpack->PCS) ?>',2);"><div id="elh_tbl_goodsinpack_PCS" class="tbl_goodsinpack_PCS">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $tbl_goodsinpack->PCS->caption() ?></span><span class="ew-table-header-sort"><?php if ($tbl_goodsinpack->PCS->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($tbl_goodsinpack->PCS->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($tbl_goodsinpack->CreateUser->Visible) { // CreateUser ?>
	<?php if ($tbl_goodsinpack->sortUrl($tbl_goodsinpack->CreateUser) == "") { ?>
		<th data-name="CreateUser" class="<?php echo $tbl_goodsinpack->CreateUser->headerCellClass() ?>" style="white-space: nowrap;"><div id="elh_tbl_goodsinpack_CreateUser" class="tbl_goodsinpack_CreateUser"><div class="ew-table-header-caption"><?php echo $tbl_goodsinpack->CreateUser->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="CreateUser" class="<?php echo $tbl_goodsinpack->CreateUser->headerCellClass() ?>" style="white-space: nowrap;"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $tbl_goodsinpack->SortUrl($tbl_goodsinpack->CreateUser) ?>',2);"><div id="elh_tbl_goodsinpack_CreateUser" class="tbl_goodsinpack_CreateUser">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $tbl_goodsinpack->CreateUser->caption() ?></span><span class="ew-table-header-sort"><?php if ($tbl_goodsinpack->CreateUser->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($tbl_goodsinpack->CreateUser->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($tbl_goodsinpack->CreateDate->Visible) { // CreateDate ?>
	<?php if ($tbl_goodsinpack->sortUrl($tbl_goodsinpack->CreateDate) == "") { ?>
		<th data-name="CreateDate" class="<?php echo $tbl_goodsinpack->CreateDate->headerCellClass() ?>" style="white-space: nowrap;"><div id="elh_tbl_goodsinpack_CreateDate" class="tbl_goodsinpack_CreateDate"><div class="ew-table-header-caption"><?php echo $tbl_goodsinpack->CreateDate->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="CreateDate" class="<?php echo $tbl_goodsinpack->CreateDate->headerCellClass() ?>" style="white-space: nowrap;"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $tbl_goodsinpack->SortUrl($tbl_goodsinpack->CreateDate) ?>',2);"><div id="elh_tbl_goodsinpack_CreateDate" class="tbl_goodsinpack_CreateDate">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $tbl_goodsinpack->CreateDate->caption() ?></span><span class="ew-table-header-sort"><?php if ($tbl_goodsinpack->CreateDate->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($tbl_goodsinpack->CreateDate->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($tbl_goodsinpack->UpdateUser->Visible) { // UpdateUser ?>
	<?php if ($tbl_goodsinpack->sortUrl($tbl_goodsinpack->UpdateUser) == "") { ?>
		<th data-name="UpdateUser" class="<?php echo $tbl_goodsinpack->UpdateUser->headerCellClass() ?>" style="white-space: nowrap;"><div id="elh_tbl_goodsinpack_UpdateUser" class="tbl_goodsinpack_UpdateUser"><div class="ew-table-header-caption"><?php echo $tbl_goodsinpack->UpdateUser->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="UpdateUser" class="<?php echo $tbl_goodsinpack->UpdateUser->headerCellClass() ?>" style="white-space: nowrap;"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $tbl_goodsinpack->SortUrl($tbl_goodsinpack->UpdateUser) ?>',2);"><div id="elh_tbl_goodsinpack_UpdateUser" class="tbl_goodsinpack_UpdateUser">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $tbl_goodsinpack->UpdateUser->caption() ?></span><span class="ew-table-header-sort"><?php if ($tbl_goodsinpack->UpdateUser->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($tbl_goodsinpack->UpdateUser->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($tbl_goodsinpack->UpdateDatetime->Visible) { // UpdateDatetime ?>
	<?php if ($tbl_goodsinpack->sortUrl($tbl_goodsinpack->UpdateDatetime) == "") { ?>
		<th data-name="UpdateDatetime" class="<?php echo $tbl_goodsinpack->UpdateDatetime->headerCellClass() ?>" style="white-space: nowrap;"><div id="elh_tbl_goodsinpack_UpdateDatetime" class="tbl_goodsinpack_UpdateDatetime"><div class="ew-table-header-caption"><?php echo $tbl_goodsinpack->UpdateDatetime->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="UpdateDatetime" class="<?php echo $tbl_goodsinpack->UpdateDatetime->headerCellClass() ?>" style="white-space: nowrap;"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $tbl_goodsinpack->SortUrl($tbl_goodsinpack->UpdateDatetime) ?>',2);"><div id="elh_tbl_goodsinpack_UpdateDatetime" class="tbl_goodsinpack_UpdateDatetime">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $tbl_goodsinpack->UpdateDatetime->caption() ?></span><span class="ew-table-header-sort"><?php if ($tbl_goodsinpack->UpdateDatetime->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($tbl_goodsinpack->UpdateDatetime->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$tbl_goodsinpack_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
if ($tbl_goodsinpack->ExportAll && $tbl_goodsinpack->isExport()) {
	$tbl_goodsinpack_list->StopRec = $tbl_goodsinpack_list->TotalRecs;
} else {

	// Set the last record to display
	if ($tbl_goodsinpack_list->TotalRecs > $tbl_goodsinpack_list->StartRec + $tbl_goodsinpack_list->DisplayRecs - 1)
		$tbl_goodsinpack_list->StopRec = $tbl_goodsinpack_list->StartRec + $tbl_goodsinpack_list->DisplayRecs - 1;
	else
		$tbl_goodsinpack_list->StopRec = $tbl_goodsinpack_list->TotalRecs;
}
$tbl_goodsinpack_list->RecCnt = $tbl_goodsinpack_list->StartRec - 1;
if ($tbl_goodsinpack_list->Recordset && !$tbl_goodsinpack_list->Recordset->EOF) {
	$tbl_goodsinpack_list->Recordset->moveFirst();
	$selectLimit = $tbl_goodsinpack_list->UseSelectLimit;
	if (!$selectLimit && $tbl_goodsinpack_list->StartRec > 1)
		$tbl_goodsinpack_list->Recordset->move($tbl_goodsinpack_list->StartRec - 1);
} elseif (!$tbl_goodsinpack->AllowAddDeleteRow && $tbl_goodsinpack_list->StopRec == 0) {
	$tbl_goodsinpack_list->StopRec = $tbl_goodsinpack->GridAddRowCount;
}

// Initialize aggregate
$tbl_goodsinpack->RowType = ROWTYPE_AGGREGATEINIT;
$tbl_goodsinpack->resetAttributes();
$tbl_goodsinpack_list->renderRow();
while ($tbl_goodsinpack_list->RecCnt < $tbl_goodsinpack_list->StopRec) {
	$tbl_goodsinpack_list->RecCnt++;
	if ($tbl_goodsinpack_list->RecCnt >= $tbl_goodsinpack_list->StartRec) {
		$tbl_goodsinpack_list->RowCnt++;

		// Set up key count
		$tbl_goodsinpack_list->KeyCount = $tbl_goodsinpack_list->RowIndex;

		// Init row class and style
		$tbl_goodsinpack->resetAttributes();
		$tbl_goodsinpack->CssClass = "";
		if ($tbl_goodsinpack->isGridAdd()) {
		} else {
			$tbl_goodsinpack_list->loadRowValues($tbl_goodsinpack_list->Recordset); // Load row values
		}
		$tbl_goodsinpack->RowType = ROWTYPE_VIEW; // Render view

		// Set up row id / data-rowindex
		$tbl_goodsinpack->RowAttrs = array_merge($tbl_goodsinpack->RowAttrs, array('data-rowindex'=>$tbl_goodsinpack_list->RowCnt, 'id'=>'r' . $tbl_goodsinpack_list->RowCnt . '_tbl_goodsinpack', 'data-rowtype'=>$tbl_goodsinpack->RowType));

		// Render row
		$tbl_goodsinpack_list->renderRow();

		// Render list options
		$tbl_goodsinpack_list->renderListOptions();
?>
	<tr<?php echo $tbl_goodsinpack->rowAttributes() ?>>
<?php

// Render list options (body, left)
$tbl_goodsinpack_list->ListOptions->render("body", "left", $tbl_goodsinpack_list->RowCnt);
?>
	<?php if ($tbl_goodsinpack->Code->Visible) { // Code ?>
		<td data-name="Code"<?php echo $tbl_goodsinpack->Code->cellAttributes() ?>>
<span id="el<?php echo $tbl_goodsinpack_list->RowCnt ?>_tbl_goodsinpack_Code" class="tbl_goodsinpack_Code">
<span<?php echo $tbl_goodsinpack->Code->viewAttributes() ?>>
<?php echo $tbl_goodsinpack->Code->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($tbl_goodsinpack->PCS->Visible) { // PCS ?>
		<td data-name="PCS"<?php echo $tbl_goodsinpack->PCS->cellAttributes() ?>>
<span id="el<?php echo $tbl_goodsinpack_list->RowCnt ?>_tbl_goodsinpack_PCS" class="tbl_goodsinpack_PCS">
<span<?php echo $tbl_goodsinpack->PCS->viewAttributes() ?>>
<?php echo $tbl_goodsinpack->PCS->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($tbl_goodsinpack->CreateUser->Visible) { // CreateUser ?>
		<td data-name="CreateUser"<?php echo $tbl_goodsinpack->CreateUser->cellAttributes() ?>>
<span id="el<?php echo $tbl_goodsinpack_list->RowCnt ?>_tbl_goodsinpack_CreateUser" class="tbl_goodsinpack_CreateUser">
<span<?php echo $tbl_goodsinpack->CreateUser->viewAttributes() ?>>
<?php echo $tbl_goodsinpack->CreateUser->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($tbl_goodsinpack->CreateDate->Visible) { // CreateDate ?>
		<td data-name="CreateDate"<?php echo $tbl_goodsinpack->CreateDate->cellAttributes() ?>>
<span id="el<?php echo $tbl_goodsinpack_list->RowCnt ?>_tbl_goodsinpack_CreateDate" class="tbl_goodsinpack_CreateDate">
<span<?php echo $tbl_goodsinpack->CreateDate->viewAttributes() ?>>
<?php echo $tbl_goodsinpack->CreateDate->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($tbl_goodsinpack->UpdateUser->Visible) { // UpdateUser ?>
		<td data-name="UpdateUser"<?php echo $tbl_goodsinpack->UpdateUser->cellAttributes() ?>>
<span id="el<?php echo $tbl_goodsinpack_list->RowCnt ?>_tbl_goodsinpack_UpdateUser" class="tbl_goodsinpack_UpdateUser">
<span<?php echo $tbl_goodsinpack->UpdateUser->viewAttributes() ?>>
<?php echo $tbl_goodsinpack->UpdateUser->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($tbl_goodsinpack->UpdateDatetime->Visible) { // UpdateDatetime ?>
		<td data-name="UpdateDatetime"<?php echo $tbl_goodsinpack->UpdateDatetime->cellAttributes() ?>>
<span id="el<?php echo $tbl_goodsinpack_list->RowCnt ?>_tbl_goodsinpack_UpdateDatetime" class="tbl_goodsinpack_UpdateDatetime">
<span<?php echo $tbl_goodsinpack->UpdateDatetime->viewAttributes() ?>>
<?php echo $tbl_goodsinpack->UpdateDatetime->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$tbl_goodsinpack_list->ListOptions->render("body", "right", $tbl_goodsinpack_list->RowCnt);
?>
	</tr>
<?php
	}
	if (!$tbl_goodsinpack->isGridAdd())
		$tbl_goodsinpack_list->Recordset->moveNext();
}
?>
</tbody>
<?php

// Render aggregate row
$tbl_goodsinpack->RowType = ROWTYPE_AGGREGATE;
$tbl_goodsinpack->resetAttributes();
$tbl_goodsinpack_list->renderRow();
?>
<?php if ($tbl_goodsinpack_list->TotalRecs > 0 && !$tbl_goodsinpack->isGridAdd() && !$tbl_goodsinpack->isGridEdit()) { ?>
<tfoot><!-- Table footer -->
	<tr class="ew-table-footer">
<?php

// Render list options
$tbl_goodsinpack_list->renderListOptions();

// Render list options (footer, left)
$tbl_goodsinpack_list->ListOptions->render("footer", "left");
?>
	<?php if ($tbl_goodsinpack->Code->Visible) { // Code ?>
		<td data-name="Code" class="<?php echo $tbl_goodsinpack->Code->footerCellClass() ?>"><span id="elf_tbl_goodsinpack_Code" class="tbl_goodsinpack_Code">
		&nbsp;
		</span></td>
	<?php } ?>
	<?php if ($tbl_goodsinpack->PCS->Visible) { // PCS ?>
		<td data-name="PCS" class="<?php echo $tbl_goodsinpack->PCS->footerCellClass() ?>"><span id="elf_tbl_goodsinpack_PCS" class="tbl_goodsinpack_PCS">
		<span class="ew-aggregate"><?php echo $Language->phrase("TOTAL") ?></span><span class="ew-aggregate-value">
		<?php echo $tbl_goodsinpack->PCS->ViewValue ?></span>
		</span></td>
	<?php } ?>
	<?php if ($tbl_goodsinpack->CreateUser->Visible) { // CreateUser ?>
		<td data-name="CreateUser" class="<?php echo $tbl_goodsinpack->CreateUser->footerCellClass() ?>"><span id="elf_tbl_goodsinpack_CreateUser" class="tbl_goodsinpack_CreateUser">
		&nbsp;
		</span></td>
	<?php } ?>
	<?php if ($tbl_goodsinpack->CreateDate->Visible) { // CreateDate ?>
		<td data-name="CreateDate" class="<?php echo $tbl_goodsinpack->CreateDate->footerCellClass() ?>"><span id="elf_tbl_goodsinpack_CreateDate" class="tbl_goodsinpack_CreateDate">
		&nbsp;
		</span></td>
	<?php } ?>
	<?php if ($tbl_goodsinpack->UpdateUser->Visible) { // UpdateUser ?>
		<td data-name="UpdateUser" class="<?php echo $tbl_goodsinpack->UpdateUser->footerCellClass() ?>"><span id="elf_tbl_goodsinpack_UpdateUser" class="tbl_goodsinpack_UpdateUser">
		&nbsp;
		</span></td>
	<?php } ?>
	<?php if ($tbl_goodsinpack->UpdateDatetime->Visible) { // UpdateDatetime ?>
		<td data-name="UpdateDatetime" class="<?php echo $tbl_goodsinpack->UpdateDatetime->footerCellClass() ?>"><span id="elf_tbl_goodsinpack_UpdateDatetime" class="tbl_goodsinpack_UpdateDatetime">
		&nbsp;
		</span></td>
	<?php } ?>
<?php

// Render list options (footer, right)
$tbl_goodsinpack_list->ListOptions->render("footer", "right");
?>
	</tr>
</tfoot>
<?php } ?>
</table><!-- /.ew-table -->
<?php } ?>
<?php if (!$tbl_goodsinpack->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</div><!-- /.ew-grid-middle-panel -->
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($tbl_goodsinpack_list->Recordset)
	$tbl_goodsinpack_list->Recordset->Close();
?>
<?php if (!$tbl_goodsinpack->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$tbl_goodsinpack->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php if (!isset($tbl_goodsinpack_list->Pager)) $tbl_goodsinpack_list->Pager = new PrevNextPager($tbl_goodsinpack_list->StartRec, $tbl_goodsinpack_list->DisplayRecs, $tbl_goodsinpack_list->TotalRecs, $tbl_goodsinpack_list->AutoHidePager) ?>
<?php if ($tbl_goodsinpack_list->Pager->RecordCount > 0 && $tbl_goodsinpack_list->Pager->Visible) { ?>
<div class="ew-pager">
<span><?php echo $Language->Phrase("Page") ?>&nbsp;</span>
<div class="ew-prev-next"><div class="input-group input-group-sm">
<div class="input-group-prepend">
<!-- first page button -->
	<?php if ($tbl_goodsinpack_list->Pager->FirstButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerFirst") ?>" href="<?php echo $tbl_goodsinpack_list->pageUrl() ?>start=<?php echo $tbl_goodsinpack_list->Pager->FirstButton->Start ?>"><i class="icon-first ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerFirst") ?>"><i class="icon-first ew-icon"></i></a>
	<?php } ?>
<!-- previous page button -->
	<?php if ($tbl_goodsinpack_list->Pager->PrevButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerPrevious") ?>" href="<?php echo $tbl_goodsinpack_list->pageUrl() ?>start=<?php echo $tbl_goodsinpack_list->Pager->PrevButton->Start ?>"><i class="icon-prev ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerPrevious") ?>"><i class="icon-prev ew-icon"></i></a>
	<?php } ?>
</div>
<!-- current page number -->
	<input class="form-control" type="text" name="<?php echo TABLE_PAGE_NO ?>" value="<?php echo $tbl_goodsinpack_list->Pager->CurrentPage ?>">
<div class="input-group-append">
<!-- next page button -->
	<?php if ($tbl_goodsinpack_list->Pager->NextButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerNext") ?>" href="<?php echo $tbl_goodsinpack_list->pageUrl() ?>start=<?php echo $tbl_goodsinpack_list->Pager->NextButton->Start ?>"><i class="icon-next ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerNext") ?>"><i class="icon-next ew-icon"></i></a>
	<?php } ?>
<!-- last page button -->
	<?php if ($tbl_goodsinpack_list->Pager->LastButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerLast") ?>" href="<?php echo $tbl_goodsinpack_list->pageUrl() ?>start=<?php echo $tbl_goodsinpack_list->Pager->LastButton->Start ?>"><i class="icon-last ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerLast") ?>"><i class="icon-last ew-icon"></i></a>
	<?php } ?>
</div>
</div>
</div>
<span>&nbsp;<?php echo $Language->Phrase("of") ?>&nbsp;<?php echo $tbl_goodsinpack_list->Pager->PageCount ?></span>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php if ($tbl_goodsinpack_list->Pager->RecordCount > 0) { ?>
<div class="ew-pager ew-rec">
	<span><?php echo $Language->Phrase("Record") ?>&nbsp;<?php echo $tbl_goodsinpack_list->Pager->FromIndex ?>&nbsp;<?php echo $Language->Phrase("To") ?>&nbsp;<?php echo $tbl_goodsinpack_list->Pager->ToIndex ?>&nbsp;<?php echo $Language->Phrase("Of") ?>&nbsp;<?php echo $tbl_goodsinpack_list->Pager->RecordCount ?></span>
</div>
<?php } ?>
<?php if ($tbl_goodsinpack_list->TotalRecs > 0 && (!$tbl_goodsinpack_list->AutoHidePageSizeSelector || $tbl_goodsinpack_list->Pager->Visible)) { ?>
<div class="ew-pager">
<input type="hidden" name="t" value="tbl_goodsinpack">
<select name="<?php echo TABLE_REC_PER_PAGE ?>" class="form-control form-control-sm ew-tooltip" title="<?php echo $Language->phrase("RecordsPerPage") ?>" onchange="this.form.submit();">
<option value="20"<?php if ($tbl_goodsinpack_list->DisplayRecs == 20) { ?> selected<?php } ?>>20</option>
<option value="50"<?php if ($tbl_goodsinpack_list->DisplayRecs == 50) { ?> selected<?php } ?>>50</option>
<option value="100"<?php if ($tbl_goodsinpack_list->DisplayRecs == 100) { ?> selected<?php } ?>>100</option>
<option value="200"<?php if ($tbl_goodsinpack_list->DisplayRecs == 200) { ?> selected<?php } ?>>200</option>
<option value="500"<?php if ($tbl_goodsinpack_list->DisplayRecs == 500) { ?> selected<?php } ?>>500</option>
<option value="ALL"<?php if ($tbl_goodsinpack->getRecordsPerPage() == -1) { ?> selected<?php } ?>><?php echo $Language->Phrase("AllRecords") ?></option>
</select>
</div>
<?php } ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $tbl_goodsinpack_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($tbl_goodsinpack_list->TotalRecs == 0 && !$tbl_goodsinpack->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $tbl_goodsinpack_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$tbl_goodsinpack_list->showPageFooter();
if (DEBUG_ENABLED)
	echo GetDebugMessage();
?>
<?php if (!$tbl_goodsinpack->isExport()) { ?>
<script>

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php } ?>
<?php include_once "footer.php" ?>
<?php
$tbl_goodsinpack_list->terminate();
?>