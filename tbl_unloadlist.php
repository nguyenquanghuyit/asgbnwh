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
$tbl_unload_list = new tbl_unload_list();

// Run the page
$tbl_unload_list->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$tbl_unload_list->Page_Render();
?>
<?php include_once "header.php" ?>
<?php if (!$tbl_unload->isExport()) { ?>
<script>

// Form object
currentPageID = ew.PAGE_ID = "list";
var ftbl_unloadlist = currentForm = new ew.Form("ftbl_unloadlist", "list");
ftbl_unloadlist.formKeyCountName = '<?php echo $tbl_unload_list->FormKeyCountName ?>';

// Form_CustomValidate event
ftbl_unloadlist.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

	// Your custom validation code here, return false if invalid.
	return true;
}

// Use JavaScript validation or not
ftbl_unloadlist.validateRequired = <?php echo json_encode(CLIENT_VALIDATE) ?>;

// Dynamic selection lists
ftbl_unloadlist.lists["x_Code"] = <?php echo $tbl_unload_list->Code->Lookup->toClientList() ?>;
ftbl_unloadlist.lists["x_Code"].options = <?php echo JsonEncode($tbl_unload_list->Code->lookupOptions()) ?>;
ftbl_unloadlist.autoSuggests["x_Code"] = <?php echo json_encode(["data" => "ajax=autosuggest"]) ?>;
ftbl_unloadlist.lists["x_IdCode"] = <?php echo $tbl_unload_list->IdCode->Lookup->toClientList() ?>;
ftbl_unloadlist.lists["x_IdCode"].options = <?php echo JsonEncode($tbl_unload_list->IdCode->lookupOptions()) ?>;
ftbl_unloadlist.autoSuggests["x_IdCode"] = <?php echo json_encode(["data" => "ajax=autosuggest"]) ?>;

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
<?php if (!$tbl_unload->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($tbl_unload_list->TotalRecs > 0 && $tbl_unload_list->ExportOptions->visible()) { ?>
<?php $tbl_unload_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($tbl_unload_list->ImportOptions->visible()) { ?>
<?php $tbl_unload_list->ImportOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php if (!$tbl_unload->isExport() || EXPORT_MASTER_RECORD && $tbl_unload->isExport("print")) { ?>
<?php
if ($tbl_unload_list->DbMasterFilter <> "" && $tbl_unload->getCurrentMasterTable() == "tbl_route") {
	if ($tbl_unload_list->MasterRecordExists) {
		include_once "tbl_routemaster.php";
	}
}
?>
<?php } ?>
<?php
$tbl_unload_list->renderOtherOptions();
?>
<?php $tbl_unload_list->showPageHeader(); ?>
<?php
$tbl_unload_list->showMessage();
?>
<?php if ($tbl_unload_list->TotalRecs > 0 || $tbl_unload->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($tbl_unload_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> tbl_unload">
<?php if (!$tbl_unload->isExport()) { ?>
<div class="card-header ew-grid-upper-panel">
<?php if (!$tbl_unload->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php if (!isset($tbl_unload_list->Pager)) $tbl_unload_list->Pager = new PrevNextPager($tbl_unload_list->StartRec, $tbl_unload_list->DisplayRecs, $tbl_unload_list->TotalRecs, $tbl_unload_list->AutoHidePager) ?>
<?php if ($tbl_unload_list->Pager->RecordCount > 0 && $tbl_unload_list->Pager->Visible) { ?>
<div class="ew-pager">
<span><?php echo $Language->Phrase("Page") ?>&nbsp;</span>
<div class="ew-prev-next"><div class="input-group input-group-sm">
<div class="input-group-prepend">
<!-- first page button -->
	<?php if ($tbl_unload_list->Pager->FirstButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerFirst") ?>" href="<?php echo $tbl_unload_list->pageUrl() ?>start=<?php echo $tbl_unload_list->Pager->FirstButton->Start ?>"><i class="icon-first ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerFirst") ?>"><i class="icon-first ew-icon"></i></a>
	<?php } ?>
<!-- previous page button -->
	<?php if ($tbl_unload_list->Pager->PrevButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerPrevious") ?>" href="<?php echo $tbl_unload_list->pageUrl() ?>start=<?php echo $tbl_unload_list->Pager->PrevButton->Start ?>"><i class="icon-prev ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerPrevious") ?>"><i class="icon-prev ew-icon"></i></a>
	<?php } ?>
</div>
<!-- current page number -->
	<input class="form-control" type="text" name="<?php echo TABLE_PAGE_NO ?>" value="<?php echo $tbl_unload_list->Pager->CurrentPage ?>">
<div class="input-group-append">
<!-- next page button -->
	<?php if ($tbl_unload_list->Pager->NextButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerNext") ?>" href="<?php echo $tbl_unload_list->pageUrl() ?>start=<?php echo $tbl_unload_list->Pager->NextButton->Start ?>"><i class="icon-next ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerNext") ?>"><i class="icon-next ew-icon"></i></a>
	<?php } ?>
<!-- last page button -->
	<?php if ($tbl_unload_list->Pager->LastButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerLast") ?>" href="<?php echo $tbl_unload_list->pageUrl() ?>start=<?php echo $tbl_unload_list->Pager->LastButton->Start ?>"><i class="icon-last ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerLast") ?>"><i class="icon-last ew-icon"></i></a>
	<?php } ?>
</div>
</div>
</div>
<span>&nbsp;<?php echo $Language->Phrase("of") ?>&nbsp;<?php echo $tbl_unload_list->Pager->PageCount ?></span>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php if ($tbl_unload_list->Pager->RecordCount > 0) { ?>
<div class="ew-pager ew-rec">
	<span><?php echo $Language->Phrase("Record") ?>&nbsp;<?php echo $tbl_unload_list->Pager->FromIndex ?>&nbsp;<?php echo $Language->Phrase("To") ?>&nbsp;<?php echo $tbl_unload_list->Pager->ToIndex ?>&nbsp;<?php echo $Language->Phrase("Of") ?>&nbsp;<?php echo $tbl_unload_list->Pager->RecordCount ?></span>
</div>
<?php } ?>
<?php if ($tbl_unload_list->TotalRecs > 0 && (!$tbl_unload_list->AutoHidePageSizeSelector || $tbl_unload_list->Pager->Visible)) { ?>
<div class="ew-pager">
<input type="hidden" name="t" value="tbl_unload">
<select name="<?php echo TABLE_REC_PER_PAGE ?>" class="form-control form-control-sm ew-tooltip" title="<?php echo $Language->phrase("RecordsPerPage") ?>" onchange="this.form.submit();">
<option value="20"<?php if ($tbl_unload_list->DisplayRecs == 20) { ?> selected<?php } ?>>20</option>
<option value="50"<?php if ($tbl_unload_list->DisplayRecs == 50) { ?> selected<?php } ?>>50</option>
<option value="100"<?php if ($tbl_unload_list->DisplayRecs == 100) { ?> selected<?php } ?>>100</option>
<option value="200"<?php if ($tbl_unload_list->DisplayRecs == 200) { ?> selected<?php } ?>>200</option>
<option value="500"<?php if ($tbl_unload_list->DisplayRecs == 500) { ?> selected<?php } ?>>500</option>
<option value="ALL"<?php if ($tbl_unload->getRecordsPerPage() == -1) { ?> selected<?php } ?>><?php echo $Language->Phrase("AllRecords") ?></option>
</select>
</div>
<?php } ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $tbl_unload_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
<form name="ftbl_unloadlist" id="ftbl_unloadlist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($tbl_unload_list->CheckToken) { ?>
<input type="hidden" name="<?php echo TOKEN_NAME ?>" value="<?php echo $tbl_unload_list->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="tbl_unload">
<input type="hidden" name="exporttype" id="exporttype" value="">
<?php if ($tbl_unload->getCurrentMasterTable() == "tbl_route" && $tbl_unload->CurrentAction) { ?>
<input type="hidden" name="<?php echo TABLE_SHOW_MASTER ?>" value="tbl_route">
<input type="hidden" name="fk_ID_Route" value="<?php echo $tbl_unload->ID_Route->getSessionValue() ?>">
<?php } ?>
<div id="gmp_tbl_unload" class="<?php if (IsResponsiveLayout()) { ?>table-responsive <?php } ?>card-body ew-grid-middle-panel">
<?php if ($tbl_unload_list->TotalRecs > 0 || $tbl_unload->isGridEdit()) { ?>
<table id="tbl_tbl_unloadlist" class="table ew-table"><!-- .ew-table ##-->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$tbl_unload_list->RowType = ROWTYPE_HEADER;

// Render list options
$tbl_unload_list->renderListOptions();

// Render list options (header, left)
$tbl_unload_list->ListOptions->render("header", "left");
?>
<?php if ($tbl_unload->Code->Visible) { // Code ?>
	<?php if ($tbl_unload->sortUrl($tbl_unload->Code) == "") { ?>
		<th data-name="Code" class="<?php echo $tbl_unload->Code->headerCellClass() ?>" style="white-space: nowrap;"><div id="elh_tbl_unload_Code" class="tbl_unload_Code"><div class="ew-table-header-caption"><?php echo $tbl_unload->Code->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Code" class="<?php echo $tbl_unload->Code->headerCellClass() ?>" style="white-space: nowrap;"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $tbl_unload->SortUrl($tbl_unload->Code) ?>',2);"><div id="elh_tbl_unload_Code" class="tbl_unload_Code">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $tbl_unload->Code->caption() ?></span><span class="ew-table-header-sort"><?php if ($tbl_unload->Code->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($tbl_unload->Code->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($tbl_unload->IdCode->Visible) { // IdCode ?>
	<?php if ($tbl_unload->sortUrl($tbl_unload->IdCode) == "") { ?>
		<th data-name="IdCode" class="<?php echo $tbl_unload->IdCode->headerCellClass() ?>" style="white-space: nowrap;"><div id="elh_tbl_unload_IdCode" class="tbl_unload_IdCode"><div class="ew-table-header-caption"><?php echo $tbl_unload->IdCode->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="IdCode" class="<?php echo $tbl_unload->IdCode->headerCellClass() ?>" style="white-space: nowrap;"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $tbl_unload->SortUrl($tbl_unload->IdCode) ?>',2);"><div id="elh_tbl_unload_IdCode" class="tbl_unload_IdCode">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $tbl_unload->IdCode->caption() ?></span><span class="ew-table-header-sort"><?php if ($tbl_unload->IdCode->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($tbl_unload->IdCode->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($tbl_unload->PCS->Visible) { // PCS ?>
	<?php if ($tbl_unload->sortUrl($tbl_unload->PCS) == "") { ?>
		<th data-name="PCS" class="<?php echo $tbl_unload->PCS->headerCellClass() ?>" style="white-space: nowrap;"><div id="elh_tbl_unload_PCS" class="tbl_unload_PCS"><div class="ew-table-header-caption"><?php echo $tbl_unload->PCS->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="PCS" class="<?php echo $tbl_unload->PCS->headerCellClass() ?>" style="white-space: nowrap;"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $tbl_unload->SortUrl($tbl_unload->PCS) ?>',2);"><div id="elh_tbl_unload_PCS" class="tbl_unload_PCS">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $tbl_unload->PCS->caption() ?></span><span class="ew-table-header-sort"><?php if ($tbl_unload->PCS->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($tbl_unload->PCS->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($tbl_unload->RealPCS->Visible) { // RealPCS ?>
	<?php if ($tbl_unload->sortUrl($tbl_unload->RealPCS) == "") { ?>
		<th data-name="RealPCS" class="<?php echo $tbl_unload->RealPCS->headerCellClass() ?>" style="white-space: nowrap;"><div id="elh_tbl_unload_RealPCS" class="tbl_unload_RealPCS"><div class="ew-table-header-caption"><?php echo $tbl_unload->RealPCS->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="RealPCS" class="<?php echo $tbl_unload->RealPCS->headerCellClass() ?>" style="white-space: nowrap;"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $tbl_unload->SortUrl($tbl_unload->RealPCS) ?>',2);"><div id="elh_tbl_unload_RealPCS" class="tbl_unload_RealPCS">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $tbl_unload->RealPCS->caption() ?></span><span class="ew-table-header-sort"><?php if ($tbl_unload->RealPCS->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($tbl_unload->RealPCS->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($tbl_unload->Description->Visible) { // Description ?>
	<?php if ($tbl_unload->sortUrl($tbl_unload->Description) == "") { ?>
		<th data-name="Description" class="<?php echo $tbl_unload->Description->headerCellClass() ?>" style="white-space: nowrap;"><div id="elh_tbl_unload_Description" class="tbl_unload_Description"><div class="ew-table-header-caption"><?php echo $tbl_unload->Description->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Description" class="<?php echo $tbl_unload->Description->headerCellClass() ?>" style="white-space: nowrap;"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $tbl_unload->SortUrl($tbl_unload->Description) ?>',2);"><div id="elh_tbl_unload_Description" class="tbl_unload_Description">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $tbl_unload->Description->caption() ?></span><span class="ew-table-header-sort"><?php if ($tbl_unload->Description->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($tbl_unload->Description->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($tbl_unload->CreateUser->Visible) { // CreateUser ?>
	<?php if ($tbl_unload->sortUrl($tbl_unload->CreateUser) == "") { ?>
		<th data-name="CreateUser" class="<?php echo $tbl_unload->CreateUser->headerCellClass() ?>" style="white-space: nowrap;"><div id="elh_tbl_unload_CreateUser" class="tbl_unload_CreateUser"><div class="ew-table-header-caption"><?php echo $tbl_unload->CreateUser->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="CreateUser" class="<?php echo $tbl_unload->CreateUser->headerCellClass() ?>" style="white-space: nowrap;"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $tbl_unload->SortUrl($tbl_unload->CreateUser) ?>',2);"><div id="elh_tbl_unload_CreateUser" class="tbl_unload_CreateUser">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $tbl_unload->CreateUser->caption() ?></span><span class="ew-table-header-sort"><?php if ($tbl_unload->CreateUser->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($tbl_unload->CreateUser->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($tbl_unload->CreateDate->Visible) { // CreateDate ?>
	<?php if ($tbl_unload->sortUrl($tbl_unload->CreateDate) == "") { ?>
		<th data-name="CreateDate" class="<?php echo $tbl_unload->CreateDate->headerCellClass() ?>" style="white-space: nowrap;"><div id="elh_tbl_unload_CreateDate" class="tbl_unload_CreateDate"><div class="ew-table-header-caption"><?php echo $tbl_unload->CreateDate->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="CreateDate" class="<?php echo $tbl_unload->CreateDate->headerCellClass() ?>" style="white-space: nowrap;"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $tbl_unload->SortUrl($tbl_unload->CreateDate) ?>',2);"><div id="elh_tbl_unload_CreateDate" class="tbl_unload_CreateDate">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $tbl_unload->CreateDate->caption() ?></span><span class="ew-table-header-sort"><?php if ($tbl_unload->CreateDate->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($tbl_unload->CreateDate->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($tbl_unload->MFG->Visible) { // MFG ?>
	<?php if ($tbl_unload->sortUrl($tbl_unload->MFG) == "") { ?>
		<th data-name="MFG" class="<?php echo $tbl_unload->MFG->headerCellClass() ?>" style="white-space: nowrap;"><div id="elh_tbl_unload_MFG" class="tbl_unload_MFG"><div class="ew-table-header-caption"><?php echo $tbl_unload->MFG->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="MFG" class="<?php echo $tbl_unload->MFG->headerCellClass() ?>" style="white-space: nowrap;"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $tbl_unload->SortUrl($tbl_unload->MFG) ?>',2);"><div id="elh_tbl_unload_MFG" class="tbl_unload_MFG">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $tbl_unload->MFG->caption() ?></span><span class="ew-table-header-sort"><?php if ($tbl_unload->MFG->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($tbl_unload->MFG->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$tbl_unload_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
if ($tbl_unload->ExportAll && $tbl_unload->isExport()) {
	$tbl_unload_list->StopRec = $tbl_unload_list->TotalRecs;
} else {

	// Set the last record to display
	if ($tbl_unload_list->TotalRecs > $tbl_unload_list->StartRec + $tbl_unload_list->DisplayRecs - 1)
		$tbl_unload_list->StopRec = $tbl_unload_list->StartRec + $tbl_unload_list->DisplayRecs - 1;
	else
		$tbl_unload_list->StopRec = $tbl_unload_list->TotalRecs;
}
$tbl_unload_list->RecCnt = $tbl_unload_list->StartRec - 1;
if ($tbl_unload_list->Recordset && !$tbl_unload_list->Recordset->EOF) {
	$tbl_unload_list->Recordset->moveFirst();
	$selectLimit = $tbl_unload_list->UseSelectLimit;
	if (!$selectLimit && $tbl_unload_list->StartRec > 1)
		$tbl_unload_list->Recordset->move($tbl_unload_list->StartRec - 1);
} elseif (!$tbl_unload->AllowAddDeleteRow && $tbl_unload_list->StopRec == 0) {
	$tbl_unload_list->StopRec = $tbl_unload->GridAddRowCount;
}

// Initialize aggregate
$tbl_unload->RowType = ROWTYPE_AGGREGATEINIT;
$tbl_unload->resetAttributes();
$tbl_unload_list->renderRow();
while ($tbl_unload_list->RecCnt < $tbl_unload_list->StopRec) {
	$tbl_unload_list->RecCnt++;
	if ($tbl_unload_list->RecCnt >= $tbl_unload_list->StartRec) {
		$tbl_unload_list->RowCnt++;

		// Set up key count
		$tbl_unload_list->KeyCount = $tbl_unload_list->RowIndex;

		// Init row class and style
		$tbl_unload->resetAttributes();
		$tbl_unload->CssClass = "";
		if ($tbl_unload->isGridAdd()) {
		} else {
			$tbl_unload_list->loadRowValues($tbl_unload_list->Recordset); // Load row values
		}
		$tbl_unload->RowType = ROWTYPE_VIEW; // Render view

		// Set up row id / data-rowindex
		$tbl_unload->RowAttrs = array_merge($tbl_unload->RowAttrs, array('data-rowindex'=>$tbl_unload_list->RowCnt, 'id'=>'r' . $tbl_unload_list->RowCnt . '_tbl_unload', 'data-rowtype'=>$tbl_unload->RowType));

		// Render row
		$tbl_unload_list->renderRow();

		// Render list options
		$tbl_unload_list->renderListOptions();
?>
	<tr<?php echo $tbl_unload->rowAttributes() ?>>
<?php

// Render list options (body, left)
$tbl_unload_list->ListOptions->render("body", "left", $tbl_unload_list->RowCnt);
?>
	<?php if ($tbl_unload->Code->Visible) { // Code ?>
		<td data-name="Code"<?php echo $tbl_unload->Code->cellAttributes() ?>>
<span id="el<?php echo $tbl_unload_list->RowCnt ?>_tbl_unload_Code" class="tbl_unload_Code">
<span<?php echo $tbl_unload->Code->viewAttributes() ?>>
<?php echo $tbl_unload->Code->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($tbl_unload->IdCode->Visible) { // IdCode ?>
		<td data-name="IdCode"<?php echo $tbl_unload->IdCode->cellAttributes() ?>>
<span id="el<?php echo $tbl_unload_list->RowCnt ?>_tbl_unload_IdCode" class="tbl_unload_IdCode">
<span<?php echo $tbl_unload->IdCode->viewAttributes() ?>>
<?php echo $tbl_unload->IdCode->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($tbl_unload->PCS->Visible) { // PCS ?>
		<td data-name="PCS"<?php echo $tbl_unload->PCS->cellAttributes() ?>>
<span id="el<?php echo $tbl_unload_list->RowCnt ?>_tbl_unload_PCS" class="tbl_unload_PCS">
<span<?php echo $tbl_unload->PCS->viewAttributes() ?>>
<?php echo $tbl_unload->PCS->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($tbl_unload->RealPCS->Visible) { // RealPCS ?>
		<td data-name="RealPCS"<?php echo $tbl_unload->RealPCS->cellAttributes() ?>>
<span id="el<?php echo $tbl_unload_list->RowCnt ?>_tbl_unload_RealPCS" class="tbl_unload_RealPCS">
<span<?php echo $tbl_unload->RealPCS->viewAttributes() ?>>
<?php echo $tbl_unload->RealPCS->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($tbl_unload->Description->Visible) { // Description ?>
		<td data-name="Description"<?php echo $tbl_unload->Description->cellAttributes() ?>>
<span id="el<?php echo $tbl_unload_list->RowCnt ?>_tbl_unload_Description" class="tbl_unload_Description">
<span<?php echo $tbl_unload->Description->viewAttributes() ?>>
<?php echo $tbl_unload->Description->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($tbl_unload->CreateUser->Visible) { // CreateUser ?>
		<td data-name="CreateUser"<?php echo $tbl_unload->CreateUser->cellAttributes() ?>>
<span id="el<?php echo $tbl_unload_list->RowCnt ?>_tbl_unload_CreateUser" class="tbl_unload_CreateUser">
<span<?php echo $tbl_unload->CreateUser->viewAttributes() ?>>
<?php echo $tbl_unload->CreateUser->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($tbl_unload->CreateDate->Visible) { // CreateDate ?>
		<td data-name="CreateDate"<?php echo $tbl_unload->CreateDate->cellAttributes() ?>>
<span id="el<?php echo $tbl_unload_list->RowCnt ?>_tbl_unload_CreateDate" class="tbl_unload_CreateDate">
<span<?php echo $tbl_unload->CreateDate->viewAttributes() ?>>
<?php echo $tbl_unload->CreateDate->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($tbl_unload->MFG->Visible) { // MFG ?>
		<td data-name="MFG"<?php echo $tbl_unload->MFG->cellAttributes() ?>>
<span id="el<?php echo $tbl_unload_list->RowCnt ?>_tbl_unload_MFG" class="tbl_unload_MFG">
<span<?php echo $tbl_unload->MFG->viewAttributes() ?>>
<?php echo $tbl_unload->MFG->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$tbl_unload_list->ListOptions->render("body", "right", $tbl_unload_list->RowCnt);
?>
	</tr>
<?php
	}
	if (!$tbl_unload->isGridAdd())
		$tbl_unload_list->Recordset->moveNext();
}
?>
</tbody>
<?php

// Render aggregate row
$tbl_unload->RowType = ROWTYPE_AGGREGATE;
$tbl_unload->resetAttributes();
$tbl_unload_list->renderRow();
?>
<?php if ($tbl_unload_list->TotalRecs > 0 && !$tbl_unload->isGridAdd() && !$tbl_unload->isGridEdit()) { ?>
<tfoot><!-- Table footer -->
	<tr class="ew-table-footer">
<?php

// Render list options
$tbl_unload_list->renderListOptions();

// Render list options (footer, left)
$tbl_unload_list->ListOptions->render("footer", "left");
?>
	<?php if ($tbl_unload->Code->Visible) { // Code ?>
		<td data-name="Code" class="<?php echo $tbl_unload->Code->footerCellClass() ?>"><span id="elf_tbl_unload_Code" class="tbl_unload_Code">
		&nbsp;
		</span></td>
	<?php } ?>
	<?php if ($tbl_unload->IdCode->Visible) { // IdCode ?>
		<td data-name="IdCode" class="<?php echo $tbl_unload->IdCode->footerCellClass() ?>"><span id="elf_tbl_unload_IdCode" class="tbl_unload_IdCode">
		&nbsp;
		</span></td>
	<?php } ?>
	<?php if ($tbl_unload->PCS->Visible) { // PCS ?>
		<td data-name="PCS" class="<?php echo $tbl_unload->PCS->footerCellClass() ?>"><span id="elf_tbl_unload_PCS" class="tbl_unload_PCS">
		<span class="ew-aggregate"><?php echo $Language->phrase("TOTAL") ?></span><span class="ew-aggregate-value">
		<?php echo $tbl_unload->PCS->ViewValue ?></span>
		</span></td>
	<?php } ?>
	<?php if ($tbl_unload->RealPCS->Visible) { // RealPCS ?>
		<td data-name="RealPCS" class="<?php echo $tbl_unload->RealPCS->footerCellClass() ?>"><span id="elf_tbl_unload_RealPCS" class="tbl_unload_RealPCS">
		<span class="ew-aggregate"><?php echo $Language->phrase("TOTAL") ?></span><span class="ew-aggregate-value">
		<?php echo $tbl_unload->RealPCS->ViewValue ?></span>
		</span></td>
	<?php } ?>
	<?php if ($tbl_unload->Description->Visible) { // Description ?>
		<td data-name="Description" class="<?php echo $tbl_unload->Description->footerCellClass() ?>"><span id="elf_tbl_unload_Description" class="tbl_unload_Description">
		&nbsp;
		</span></td>
	<?php } ?>
	<?php if ($tbl_unload->CreateUser->Visible) { // CreateUser ?>
		<td data-name="CreateUser" class="<?php echo $tbl_unload->CreateUser->footerCellClass() ?>"><span id="elf_tbl_unload_CreateUser" class="tbl_unload_CreateUser">
		&nbsp;
		</span></td>
	<?php } ?>
	<?php if ($tbl_unload->CreateDate->Visible) { // CreateDate ?>
		<td data-name="CreateDate" class="<?php echo $tbl_unload->CreateDate->footerCellClass() ?>"><span id="elf_tbl_unload_CreateDate" class="tbl_unload_CreateDate">
		&nbsp;
		</span></td>
	<?php } ?>
	<?php if ($tbl_unload->MFG->Visible) { // MFG ?>
		<td data-name="MFG" class="<?php echo $tbl_unload->MFG->footerCellClass() ?>"><span id="elf_tbl_unload_MFG" class="tbl_unload_MFG">
		&nbsp;
		</span></td>
	<?php } ?>
<?php

// Render list options (footer, right)
$tbl_unload_list->ListOptions->render("footer", "right");
?>
	</tr>
</tfoot>
<?php } ?>
</table><!-- /.ew-table -->
<?php } ?>
<?php if (!$tbl_unload->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</div><!-- /.ew-grid-middle-panel -->
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($tbl_unload_list->Recordset)
	$tbl_unload_list->Recordset->Close();
?>
<?php if (!$tbl_unload->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$tbl_unload->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php if (!isset($tbl_unload_list->Pager)) $tbl_unload_list->Pager = new PrevNextPager($tbl_unload_list->StartRec, $tbl_unload_list->DisplayRecs, $tbl_unload_list->TotalRecs, $tbl_unload_list->AutoHidePager) ?>
<?php if ($tbl_unload_list->Pager->RecordCount > 0 && $tbl_unload_list->Pager->Visible) { ?>
<div class="ew-pager">
<span><?php echo $Language->Phrase("Page") ?>&nbsp;</span>
<div class="ew-prev-next"><div class="input-group input-group-sm">
<div class="input-group-prepend">
<!-- first page button -->
	<?php if ($tbl_unload_list->Pager->FirstButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerFirst") ?>" href="<?php echo $tbl_unload_list->pageUrl() ?>start=<?php echo $tbl_unload_list->Pager->FirstButton->Start ?>"><i class="icon-first ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerFirst") ?>"><i class="icon-first ew-icon"></i></a>
	<?php } ?>
<!-- previous page button -->
	<?php if ($tbl_unload_list->Pager->PrevButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerPrevious") ?>" href="<?php echo $tbl_unload_list->pageUrl() ?>start=<?php echo $tbl_unload_list->Pager->PrevButton->Start ?>"><i class="icon-prev ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerPrevious") ?>"><i class="icon-prev ew-icon"></i></a>
	<?php } ?>
</div>
<!-- current page number -->
	<input class="form-control" type="text" name="<?php echo TABLE_PAGE_NO ?>" value="<?php echo $tbl_unload_list->Pager->CurrentPage ?>">
<div class="input-group-append">
<!-- next page button -->
	<?php if ($tbl_unload_list->Pager->NextButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerNext") ?>" href="<?php echo $tbl_unload_list->pageUrl() ?>start=<?php echo $tbl_unload_list->Pager->NextButton->Start ?>"><i class="icon-next ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerNext") ?>"><i class="icon-next ew-icon"></i></a>
	<?php } ?>
<!-- last page button -->
	<?php if ($tbl_unload_list->Pager->LastButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerLast") ?>" href="<?php echo $tbl_unload_list->pageUrl() ?>start=<?php echo $tbl_unload_list->Pager->LastButton->Start ?>"><i class="icon-last ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerLast") ?>"><i class="icon-last ew-icon"></i></a>
	<?php } ?>
</div>
</div>
</div>
<span>&nbsp;<?php echo $Language->Phrase("of") ?>&nbsp;<?php echo $tbl_unload_list->Pager->PageCount ?></span>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php if ($tbl_unload_list->Pager->RecordCount > 0) { ?>
<div class="ew-pager ew-rec">
	<span><?php echo $Language->Phrase("Record") ?>&nbsp;<?php echo $tbl_unload_list->Pager->FromIndex ?>&nbsp;<?php echo $Language->Phrase("To") ?>&nbsp;<?php echo $tbl_unload_list->Pager->ToIndex ?>&nbsp;<?php echo $Language->Phrase("Of") ?>&nbsp;<?php echo $tbl_unload_list->Pager->RecordCount ?></span>
</div>
<?php } ?>
<?php if ($tbl_unload_list->TotalRecs > 0 && (!$tbl_unload_list->AutoHidePageSizeSelector || $tbl_unload_list->Pager->Visible)) { ?>
<div class="ew-pager">
<input type="hidden" name="t" value="tbl_unload">
<select name="<?php echo TABLE_REC_PER_PAGE ?>" class="form-control form-control-sm ew-tooltip" title="<?php echo $Language->phrase("RecordsPerPage") ?>" onchange="this.form.submit();">
<option value="20"<?php if ($tbl_unload_list->DisplayRecs == 20) { ?> selected<?php } ?>>20</option>
<option value="50"<?php if ($tbl_unload_list->DisplayRecs == 50) { ?> selected<?php } ?>>50</option>
<option value="100"<?php if ($tbl_unload_list->DisplayRecs == 100) { ?> selected<?php } ?>>100</option>
<option value="200"<?php if ($tbl_unload_list->DisplayRecs == 200) { ?> selected<?php } ?>>200</option>
<option value="500"<?php if ($tbl_unload_list->DisplayRecs == 500) { ?> selected<?php } ?>>500</option>
<option value="ALL"<?php if ($tbl_unload->getRecordsPerPage() == -1) { ?> selected<?php } ?>><?php echo $Language->Phrase("AllRecords") ?></option>
</select>
</div>
<?php } ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $tbl_unload_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($tbl_unload_list->TotalRecs == 0 && !$tbl_unload->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $tbl_unload_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$tbl_unload_list->showPageFooter();
if (DEBUG_ENABLED)
	echo GetDebugMessage();
?>
<?php if (!$tbl_unload->isExport()) { ?>
<script>

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php } ?>
<?php include_once "footer.php" ?>
<?php
$tbl_unload_list->terminate();
?>