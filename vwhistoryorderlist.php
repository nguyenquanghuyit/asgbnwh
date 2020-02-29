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
$vwhistoryorder_list = new vwhistoryorder_list();

// Run the page
$vwhistoryorder_list->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$vwhistoryorder_list->Page_Render();
?>
<?php include_once "header.php" ?>
<?php if (!$vwhistoryorder->isExport()) { ?>
<script>

// Form object
currentPageID = ew.PAGE_ID = "list";
var fvwhistoryorderlist = currentForm = new ew.Form("fvwhistoryorderlist", "list");
fvwhistoryorderlist.formKeyCountName = '<?php echo $vwhistoryorder_list->FormKeyCountName ?>';

// Form_CustomValidate event
fvwhistoryorderlist.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

	// Your custom validation code here, return false if invalid.
	return true;
}

// Use JavaScript validation or not
fvwhistoryorderlist.validateRequired = <?php echo json_encode(CLIENT_VALIDATE) ?>;

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
<?php if (!$vwhistoryorder->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($vwhistoryorder_list->TotalRecs > 0 && $vwhistoryorder_list->ExportOptions->visible()) { ?>
<?php $vwhistoryorder_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($vwhistoryorder_list->ImportOptions->visible()) { ?>
<?php $vwhistoryorder_list->ImportOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php if (!$vwhistoryorder->isExport() || EXPORT_MASTER_RECORD && $vwhistoryorder->isExport("print")) { ?>
<?php
if ($vwhistoryorder_list->DbMasterFilter <> "" && $vwhistoryorder->getCurrentMasterTable() == "vwpickingbyorder") {
	if ($vwhistoryorder_list->MasterRecordExists) {
		include_once "vwpickingbyordermaster.php";
	}
}
?>
<?php } ?>
<?php
$vwhistoryorder_list->renderOtherOptions();
?>
<?php $vwhistoryorder_list->showPageHeader(); ?>
<?php
$vwhistoryorder_list->showMessage();
?>
<?php if ($vwhistoryorder_list->TotalRecs > 0 || $vwhistoryorder->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($vwhistoryorder_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> vwhistoryorder">
<?php if (!$vwhistoryorder->isExport()) { ?>
<div class="card-header ew-grid-upper-panel">
<?php if (!$vwhistoryorder->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php if (!isset($vwhistoryorder_list->Pager)) $vwhistoryorder_list->Pager = new PrevNextPager($vwhistoryorder_list->StartRec, $vwhistoryorder_list->DisplayRecs, $vwhistoryorder_list->TotalRecs, $vwhistoryorder_list->AutoHidePager) ?>
<?php if ($vwhistoryorder_list->Pager->RecordCount > 0 && $vwhistoryorder_list->Pager->Visible) { ?>
<div class="ew-pager">
<span><?php echo $Language->Phrase("Page") ?>&nbsp;</span>
<div class="ew-prev-next"><div class="input-group input-group-sm">
<div class="input-group-prepend">
<!-- first page button -->
	<?php if ($vwhistoryorder_list->Pager->FirstButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerFirst") ?>" href="<?php echo $vwhistoryorder_list->pageUrl() ?>start=<?php echo $vwhistoryorder_list->Pager->FirstButton->Start ?>"><i class="icon-first ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerFirst") ?>"><i class="icon-first ew-icon"></i></a>
	<?php } ?>
<!-- previous page button -->
	<?php if ($vwhistoryorder_list->Pager->PrevButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerPrevious") ?>" href="<?php echo $vwhistoryorder_list->pageUrl() ?>start=<?php echo $vwhistoryorder_list->Pager->PrevButton->Start ?>"><i class="icon-prev ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerPrevious") ?>"><i class="icon-prev ew-icon"></i></a>
	<?php } ?>
</div>
<!-- current page number -->
	<input class="form-control" type="text" name="<?php echo TABLE_PAGE_NO ?>" value="<?php echo $vwhistoryorder_list->Pager->CurrentPage ?>">
<div class="input-group-append">
<!-- next page button -->
	<?php if ($vwhistoryorder_list->Pager->NextButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerNext") ?>" href="<?php echo $vwhistoryorder_list->pageUrl() ?>start=<?php echo $vwhistoryorder_list->Pager->NextButton->Start ?>"><i class="icon-next ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerNext") ?>"><i class="icon-next ew-icon"></i></a>
	<?php } ?>
<!-- last page button -->
	<?php if ($vwhistoryorder_list->Pager->LastButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerLast") ?>" href="<?php echo $vwhistoryorder_list->pageUrl() ?>start=<?php echo $vwhistoryorder_list->Pager->LastButton->Start ?>"><i class="icon-last ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerLast") ?>"><i class="icon-last ew-icon"></i></a>
	<?php } ?>
</div>
</div>
</div>
<span>&nbsp;<?php echo $Language->Phrase("of") ?>&nbsp;<?php echo $vwhistoryorder_list->Pager->PageCount ?></span>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php if ($vwhistoryorder_list->Pager->RecordCount > 0) { ?>
<div class="ew-pager ew-rec">
	<span><?php echo $Language->Phrase("Record") ?>&nbsp;<?php echo $vwhistoryorder_list->Pager->FromIndex ?>&nbsp;<?php echo $Language->Phrase("To") ?>&nbsp;<?php echo $vwhistoryorder_list->Pager->ToIndex ?>&nbsp;<?php echo $Language->Phrase("Of") ?>&nbsp;<?php echo $vwhistoryorder_list->Pager->RecordCount ?></span>
</div>
<?php } ?>
<?php if ($vwhistoryorder_list->TotalRecs > 0 && (!$vwhistoryorder_list->AutoHidePageSizeSelector || $vwhistoryorder_list->Pager->Visible)) { ?>
<div class="ew-pager">
<input type="hidden" name="t" value="vwhistoryorder">
<select name="<?php echo TABLE_REC_PER_PAGE ?>" class="form-control form-control-sm ew-tooltip" title="<?php echo $Language->phrase("RecordsPerPage") ?>" onchange="this.form.submit();">
<option value="20"<?php if ($vwhistoryorder_list->DisplayRecs == 20) { ?> selected<?php } ?>>20</option>
<option value="50"<?php if ($vwhistoryorder_list->DisplayRecs == 50) { ?> selected<?php } ?>>50</option>
<option value="100"<?php if ($vwhistoryorder_list->DisplayRecs == 100) { ?> selected<?php } ?>>100</option>
<option value="200"<?php if ($vwhistoryorder_list->DisplayRecs == 200) { ?> selected<?php } ?>>200</option>
<option value="500"<?php if ($vwhistoryorder_list->DisplayRecs == 500) { ?> selected<?php } ?>>500</option>
<option value="ALL"<?php if ($vwhistoryorder->getRecordsPerPage() == -1) { ?> selected<?php } ?>><?php echo $Language->Phrase("AllRecords") ?></option>
</select>
</div>
<?php } ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $vwhistoryorder_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
<form name="fvwhistoryorderlist" id="fvwhistoryorderlist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($vwhistoryorder_list->CheckToken) { ?>
<input type="hidden" name="<?php echo TOKEN_NAME ?>" value="<?php echo $vwhistoryorder_list->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="vwhistoryorder">
<input type="hidden" name="exporttype" id="exporttype" value="">
<?php if ($vwhistoryorder->getCurrentMasterTable() == "vwpickingbyorder" && $vwhistoryorder->CurrentAction) { ?>
<input type="hidden" name="<?php echo TABLE_SHOW_MASTER ?>" value="vwpickingbyorder">
<input type="hidden" name="fk_ID_Order" value="<?php echo $vwhistoryorder->ID_Order->getSessionValue() ?>">
<?php } ?>
<div id="gmp_vwhistoryorder" class="<?php if (IsResponsiveLayout()) { ?>table-responsive <?php } ?>card-body ew-grid-middle-panel">
<?php if ($vwhistoryorder_list->TotalRecs > 0 || $vwhistoryorder->isGridEdit()) { ?>
<table id="tbl_vwhistoryorderlist" class="table ew-table"><!-- .ew-table ##-->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$vwhistoryorder_list->RowType = ROWTYPE_HEADER;

// Render list options
$vwhistoryorder_list->renderListOptions();

// Render list options (header, left)
$vwhistoryorder_list->ListOptions->render("header", "left");
?>
<?php if ($vwhistoryorder->PalletID->Visible) { // PalletID ?>
	<?php if ($vwhistoryorder->sortUrl($vwhistoryorder->PalletID) == "") { ?>
		<th data-name="PalletID" class="<?php echo $vwhistoryorder->PalletID->headerCellClass() ?>" style="white-space: nowrap;"><div id="elh_vwhistoryorder_PalletID" class="vwhistoryorder_PalletID"><div class="ew-table-header-caption"><?php echo $vwhistoryorder->PalletID->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="PalletID" class="<?php echo $vwhistoryorder->PalletID->headerCellClass() ?>" style="white-space: nowrap;"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $vwhistoryorder->SortUrl($vwhistoryorder->PalletID) ?>',2);"><div id="elh_vwhistoryorder_PalletID" class="vwhistoryorder_PalletID">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $vwhistoryorder->PalletID->caption() ?></span><span class="ew-table-header-sort"><?php if ($vwhistoryorder->PalletID->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($vwhistoryorder->PalletID->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($vwhistoryorder->Code->Visible) { // Code ?>
	<?php if ($vwhistoryorder->sortUrl($vwhistoryorder->Code) == "") { ?>
		<th data-name="Code" class="<?php echo $vwhistoryorder->Code->headerCellClass() ?>" style="white-space: nowrap;"><div id="elh_vwhistoryorder_Code" class="vwhistoryorder_Code"><div class="ew-table-header-caption"><?php echo $vwhistoryorder->Code->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Code" class="<?php echo $vwhistoryorder->Code->headerCellClass() ?>" style="white-space: nowrap;"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $vwhistoryorder->SortUrl($vwhistoryorder->Code) ?>',2);"><div id="elh_vwhistoryorder_Code" class="vwhistoryorder_Code">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $vwhistoryorder->Code->caption() ?></span><span class="ew-table-header-sort"><?php if ($vwhistoryorder->Code->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($vwhistoryorder->Code->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($vwhistoryorder->ProductName->Visible) { // ProductName ?>
	<?php if ($vwhistoryorder->sortUrl($vwhistoryorder->ProductName) == "") { ?>
		<th data-name="ProductName" class="<?php echo $vwhistoryorder->ProductName->headerCellClass() ?>" style="white-space: nowrap;"><div id="elh_vwhistoryorder_ProductName" class="vwhistoryorder_ProductName"><div class="ew-table-header-caption"><?php echo $vwhistoryorder->ProductName->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="ProductName" class="<?php echo $vwhistoryorder->ProductName->headerCellClass() ?>" style="white-space: nowrap;"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $vwhistoryorder->SortUrl($vwhistoryorder->ProductName) ?>',2);"><div id="elh_vwhistoryorder_ProductName" class="vwhistoryorder_ProductName">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $vwhistoryorder->ProductName->caption() ?></span><span class="ew-table-header-sort"><?php if ($vwhistoryorder->ProductName->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($vwhistoryorder->ProductName->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($vwhistoryorder->PCS_Out->Visible) { // PCS_Out ?>
	<?php if ($vwhistoryorder->sortUrl($vwhistoryorder->PCS_Out) == "") { ?>
		<th data-name="PCS_Out" class="<?php echo $vwhistoryorder->PCS_Out->headerCellClass() ?>" style="white-space: nowrap;"><div id="elh_vwhistoryorder_PCS_Out" class="vwhistoryorder_PCS_Out"><div class="ew-table-header-caption"><?php echo $vwhistoryorder->PCS_Out->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="PCS_Out" class="<?php echo $vwhistoryorder->PCS_Out->headerCellClass() ?>" style="white-space: nowrap;"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $vwhistoryorder->SortUrl($vwhistoryorder->PCS_Out) ?>',2);"><div id="elh_vwhistoryorder_PCS_Out" class="vwhistoryorder_PCS_Out">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $vwhistoryorder->PCS_Out->caption() ?></span><span class="ew-table-header-sort"><?php if ($vwhistoryorder->PCS_Out->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($vwhistoryorder->PCS_Out->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($vwhistoryorder->DateIn->Visible) { // DateIn ?>
	<?php if ($vwhistoryorder->sortUrl($vwhistoryorder->DateIn) == "") { ?>
		<th data-name="DateIn" class="<?php echo $vwhistoryorder->DateIn->headerCellClass() ?>" style="white-space: nowrap;"><div id="elh_vwhistoryorder_DateIn" class="vwhistoryorder_DateIn"><div class="ew-table-header-caption"><?php echo $vwhistoryorder->DateIn->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="DateIn" class="<?php echo $vwhistoryorder->DateIn->headerCellClass() ?>" style="white-space: nowrap;"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $vwhistoryorder->SortUrl($vwhistoryorder->DateIn) ?>',2);"><div id="elh_vwhistoryorder_DateIn" class="vwhistoryorder_DateIn">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $vwhistoryorder->DateIn->caption() ?></span><span class="ew-table-header-sort"><?php if ($vwhistoryorder->DateIn->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($vwhistoryorder->DateIn->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($vwhistoryorder->DateOut->Visible) { // DateOut ?>
	<?php if ($vwhistoryorder->sortUrl($vwhistoryorder->DateOut) == "") { ?>
		<th data-name="DateOut" class="<?php echo $vwhistoryorder->DateOut->headerCellClass() ?>" style="white-space: nowrap;"><div id="elh_vwhistoryorder_DateOut" class="vwhistoryorder_DateOut"><div class="ew-table-header-caption"><?php echo $vwhistoryorder->DateOut->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="DateOut" class="<?php echo $vwhistoryorder->DateOut->headerCellClass() ?>" style="white-space: nowrap;"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $vwhistoryorder->SortUrl($vwhistoryorder->DateOut) ?>',2);"><div id="elh_vwhistoryorder_DateOut" class="vwhistoryorder_DateOut">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $vwhistoryorder->DateOut->caption() ?></span><span class="ew-table-header-sort"><?php if ($vwhistoryorder->DateOut->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($vwhistoryorder->DateOut->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($vwhistoryorder->PalletStatus->Visible) { // PalletStatus ?>
	<?php if ($vwhistoryorder->sortUrl($vwhistoryorder->PalletStatus) == "") { ?>
		<th data-name="PalletStatus" class="<?php echo $vwhistoryorder->PalletStatus->headerCellClass() ?>" style="white-space: nowrap;"><div id="elh_vwhistoryorder_PalletStatus" class="vwhistoryorder_PalletStatus"><div class="ew-table-header-caption"><?php echo $vwhistoryorder->PalletStatus->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="PalletStatus" class="<?php echo $vwhistoryorder->PalletStatus->headerCellClass() ?>" style="white-space: nowrap;"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $vwhistoryorder->SortUrl($vwhistoryorder->PalletStatus) ?>',2);"><div id="elh_vwhistoryorder_PalletStatus" class="vwhistoryorder_PalletStatus">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $vwhistoryorder->PalletStatus->caption() ?></span><span class="ew-table-header-sort"><?php if ($vwhistoryorder->PalletStatus->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($vwhistoryorder->PalletStatus->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($vwhistoryorder->CreateUser->Visible) { // CreateUser ?>
	<?php if ($vwhistoryorder->sortUrl($vwhistoryorder->CreateUser) == "") { ?>
		<th data-name="CreateUser" class="<?php echo $vwhistoryorder->CreateUser->headerCellClass() ?>" style="white-space: nowrap;"><div id="elh_vwhistoryorder_CreateUser" class="vwhistoryorder_CreateUser"><div class="ew-table-header-caption"><?php echo $vwhistoryorder->CreateUser->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="CreateUser" class="<?php echo $vwhistoryorder->CreateUser->headerCellClass() ?>" style="white-space: nowrap;"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $vwhistoryorder->SortUrl($vwhistoryorder->CreateUser) ?>',2);"><div id="elh_vwhistoryorder_CreateUser" class="vwhistoryorder_CreateUser">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $vwhistoryorder->CreateUser->caption() ?></span><span class="ew-table-header-sort"><?php if ($vwhistoryorder->CreateUser->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($vwhistoryorder->CreateUser->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$vwhistoryorder_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
if ($vwhistoryorder->ExportAll && $vwhistoryorder->isExport()) {
	$vwhistoryorder_list->StopRec = $vwhistoryorder_list->TotalRecs;
} else {

	// Set the last record to display
	if ($vwhistoryorder_list->TotalRecs > $vwhistoryorder_list->StartRec + $vwhistoryorder_list->DisplayRecs - 1)
		$vwhistoryorder_list->StopRec = $vwhistoryorder_list->StartRec + $vwhistoryorder_list->DisplayRecs - 1;
	else
		$vwhistoryorder_list->StopRec = $vwhistoryorder_list->TotalRecs;
}
$vwhistoryorder_list->RecCnt = $vwhistoryorder_list->StartRec - 1;
if ($vwhistoryorder_list->Recordset && !$vwhistoryorder_list->Recordset->EOF) {
	$vwhistoryorder_list->Recordset->moveFirst();
	$selectLimit = $vwhistoryorder_list->UseSelectLimit;
	if (!$selectLimit && $vwhistoryorder_list->StartRec > 1)
		$vwhistoryorder_list->Recordset->move($vwhistoryorder_list->StartRec - 1);
} elseif (!$vwhistoryorder->AllowAddDeleteRow && $vwhistoryorder_list->StopRec == 0) {
	$vwhistoryorder_list->StopRec = $vwhistoryorder->GridAddRowCount;
}

// Initialize aggregate
$vwhistoryorder->RowType = ROWTYPE_AGGREGATEINIT;
$vwhistoryorder->resetAttributes();
$vwhistoryorder_list->renderRow();
while ($vwhistoryorder_list->RecCnt < $vwhistoryorder_list->StopRec) {
	$vwhistoryorder_list->RecCnt++;
	if ($vwhistoryorder_list->RecCnt >= $vwhistoryorder_list->StartRec) {
		$vwhistoryorder_list->RowCnt++;

		// Set up key count
		$vwhistoryorder_list->KeyCount = $vwhistoryorder_list->RowIndex;

		// Init row class and style
		$vwhistoryorder->resetAttributes();
		$vwhistoryorder->CssClass = "";
		if ($vwhistoryorder->isGridAdd()) {
		} else {
			$vwhistoryorder_list->loadRowValues($vwhistoryorder_list->Recordset); // Load row values
		}
		$vwhistoryorder->RowType = ROWTYPE_VIEW; // Render view

		// Set up row id / data-rowindex
		$vwhistoryorder->RowAttrs = array_merge($vwhistoryorder->RowAttrs, array('data-rowindex'=>$vwhistoryorder_list->RowCnt, 'id'=>'r' . $vwhistoryorder_list->RowCnt . '_vwhistoryorder', 'data-rowtype'=>$vwhistoryorder->RowType));

		// Render row
		$vwhistoryorder_list->renderRow();

		// Render list options
		$vwhistoryorder_list->renderListOptions();
?>
	<tr<?php echo $vwhistoryorder->rowAttributes() ?>>
<?php

// Render list options (body, left)
$vwhistoryorder_list->ListOptions->render("body", "left", $vwhistoryorder_list->RowCnt);
?>
	<?php if ($vwhistoryorder->PalletID->Visible) { // PalletID ?>
		<td data-name="PalletID"<?php echo $vwhistoryorder->PalletID->cellAttributes() ?>>
<span id="el<?php echo $vwhistoryorder_list->RowCnt ?>_vwhistoryorder_PalletID" class="vwhistoryorder_PalletID">
<span<?php echo $vwhistoryorder->PalletID->viewAttributes() ?>>
<?php echo $vwhistoryorder->PalletID->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($vwhistoryorder->Code->Visible) { // Code ?>
		<td data-name="Code"<?php echo $vwhistoryorder->Code->cellAttributes() ?>>
<span id="el<?php echo $vwhistoryorder_list->RowCnt ?>_vwhistoryorder_Code" class="vwhistoryorder_Code">
<span<?php echo $vwhistoryorder->Code->viewAttributes() ?>>
<?php echo $vwhistoryorder->Code->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($vwhistoryorder->ProductName->Visible) { // ProductName ?>
		<td data-name="ProductName"<?php echo $vwhistoryorder->ProductName->cellAttributes() ?>>
<span id="el<?php echo $vwhistoryorder_list->RowCnt ?>_vwhistoryorder_ProductName" class="vwhistoryorder_ProductName">
<span<?php echo $vwhistoryorder->ProductName->viewAttributes() ?>>
<?php echo $vwhistoryorder->ProductName->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($vwhistoryorder->PCS_Out->Visible) { // PCS_Out ?>
		<td data-name="PCS_Out"<?php echo $vwhistoryorder->PCS_Out->cellAttributes() ?>>
<span id="el<?php echo $vwhistoryorder_list->RowCnt ?>_vwhistoryorder_PCS_Out" class="vwhistoryorder_PCS_Out">
<span<?php echo $vwhistoryorder->PCS_Out->viewAttributes() ?>>
<?php echo $vwhistoryorder->PCS_Out->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($vwhistoryorder->DateIn->Visible) { // DateIn ?>
		<td data-name="DateIn"<?php echo $vwhistoryorder->DateIn->cellAttributes() ?>>
<span id="el<?php echo $vwhistoryorder_list->RowCnt ?>_vwhistoryorder_DateIn" class="vwhistoryorder_DateIn">
<span<?php echo $vwhistoryorder->DateIn->viewAttributes() ?>>
<?php echo $vwhistoryorder->DateIn->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($vwhistoryorder->DateOut->Visible) { // DateOut ?>
		<td data-name="DateOut"<?php echo $vwhistoryorder->DateOut->cellAttributes() ?>>
<span id="el<?php echo $vwhistoryorder_list->RowCnt ?>_vwhistoryorder_DateOut" class="vwhistoryorder_DateOut">
<span<?php echo $vwhistoryorder->DateOut->viewAttributes() ?>>
<?php echo $vwhistoryorder->DateOut->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($vwhistoryorder->PalletStatus->Visible) { // PalletStatus ?>
		<td data-name="PalletStatus"<?php echo $vwhistoryorder->PalletStatus->cellAttributes() ?>>
<span id="el<?php echo $vwhistoryorder_list->RowCnt ?>_vwhistoryorder_PalletStatus" class="vwhistoryorder_PalletStatus">
<span<?php echo $vwhistoryorder->PalletStatus->viewAttributes() ?>>
<?php echo $vwhistoryorder->PalletStatus->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($vwhistoryorder->CreateUser->Visible) { // CreateUser ?>
		<td data-name="CreateUser"<?php echo $vwhistoryorder->CreateUser->cellAttributes() ?>>
<span id="el<?php echo $vwhistoryorder_list->RowCnt ?>_vwhistoryorder_CreateUser" class="vwhistoryorder_CreateUser">
<span<?php echo $vwhistoryorder->CreateUser->viewAttributes() ?>>
<?php echo $vwhistoryorder->CreateUser->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$vwhistoryorder_list->ListOptions->render("body", "right", $vwhistoryorder_list->RowCnt);
?>
	</tr>
<?php
	}
	if (!$vwhistoryorder->isGridAdd())
		$vwhistoryorder_list->Recordset->moveNext();
}
?>
</tbody>
<?php

// Render aggregate row
$vwhistoryorder->RowType = ROWTYPE_AGGREGATE;
$vwhistoryorder->resetAttributes();
$vwhistoryorder_list->renderRow();
?>
<?php if ($vwhistoryorder_list->TotalRecs > 0 && !$vwhistoryorder->isGridAdd() && !$vwhistoryorder->isGridEdit()) { ?>
<tfoot><!-- Table footer -->
	<tr class="ew-table-footer">
<?php

// Render list options
$vwhistoryorder_list->renderListOptions();

// Render list options (footer, left)
$vwhistoryorder_list->ListOptions->render("footer", "left");
?>
	<?php if ($vwhistoryorder->PalletID->Visible) { // PalletID ?>
		<td data-name="PalletID" class="<?php echo $vwhistoryorder->PalletID->footerCellClass() ?>"><span id="elf_vwhistoryorder_PalletID" class="vwhistoryorder_PalletID">
		&nbsp;
		</span></td>
	<?php } ?>
	<?php if ($vwhistoryorder->Code->Visible) { // Code ?>
		<td data-name="Code" class="<?php echo $vwhistoryorder->Code->footerCellClass() ?>"><span id="elf_vwhistoryorder_Code" class="vwhistoryorder_Code">
		&nbsp;
		</span></td>
	<?php } ?>
	<?php if ($vwhistoryorder->ProductName->Visible) { // ProductName ?>
		<td data-name="ProductName" class="<?php echo $vwhistoryorder->ProductName->footerCellClass() ?>"><span id="elf_vwhistoryorder_ProductName" class="vwhistoryorder_ProductName">
		&nbsp;
		</span></td>
	<?php } ?>
	<?php if ($vwhistoryorder->PCS_Out->Visible) { // PCS_Out ?>
		<td data-name="PCS_Out" class="<?php echo $vwhistoryorder->PCS_Out->footerCellClass() ?>"><span id="elf_vwhistoryorder_PCS_Out" class="vwhistoryorder_PCS_Out">
		<span class="ew-aggregate"><?php echo $Language->phrase("TOTAL") ?></span><span class="ew-aggregate-value">
		<?php echo $vwhistoryorder->PCS_Out->ViewValue ?></span>
		</span></td>
	<?php } ?>
	<?php if ($vwhistoryorder->DateIn->Visible) { // DateIn ?>
		<td data-name="DateIn" class="<?php echo $vwhistoryorder->DateIn->footerCellClass() ?>"><span id="elf_vwhistoryorder_DateIn" class="vwhistoryorder_DateIn">
		&nbsp;
		</span></td>
	<?php } ?>
	<?php if ($vwhistoryorder->DateOut->Visible) { // DateOut ?>
		<td data-name="DateOut" class="<?php echo $vwhistoryorder->DateOut->footerCellClass() ?>"><span id="elf_vwhistoryorder_DateOut" class="vwhistoryorder_DateOut">
		&nbsp;
		</span></td>
	<?php } ?>
	<?php if ($vwhistoryorder->PalletStatus->Visible) { // PalletStatus ?>
		<td data-name="PalletStatus" class="<?php echo $vwhistoryorder->PalletStatus->footerCellClass() ?>"><span id="elf_vwhistoryorder_PalletStatus" class="vwhistoryorder_PalletStatus">
		&nbsp;
		</span></td>
	<?php } ?>
	<?php if ($vwhistoryorder->CreateUser->Visible) { // CreateUser ?>
		<td data-name="CreateUser" class="<?php echo $vwhistoryorder->CreateUser->footerCellClass() ?>"><span id="elf_vwhistoryorder_CreateUser" class="vwhistoryorder_CreateUser">
		&nbsp;
		</span></td>
	<?php } ?>
<?php

// Render list options (footer, right)
$vwhistoryorder_list->ListOptions->render("footer", "right");
?>
	</tr>
</tfoot>
<?php } ?>
</table><!-- /.ew-table -->
<?php } ?>
<?php if (!$vwhistoryorder->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</div><!-- /.ew-grid-middle-panel -->
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($vwhistoryorder_list->Recordset)
	$vwhistoryorder_list->Recordset->Close();
?>
<?php if (!$vwhistoryorder->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$vwhistoryorder->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php if (!isset($vwhistoryorder_list->Pager)) $vwhistoryorder_list->Pager = new PrevNextPager($vwhistoryorder_list->StartRec, $vwhistoryorder_list->DisplayRecs, $vwhistoryorder_list->TotalRecs, $vwhistoryorder_list->AutoHidePager) ?>
<?php if ($vwhistoryorder_list->Pager->RecordCount > 0 && $vwhistoryorder_list->Pager->Visible) { ?>
<div class="ew-pager">
<span><?php echo $Language->Phrase("Page") ?>&nbsp;</span>
<div class="ew-prev-next"><div class="input-group input-group-sm">
<div class="input-group-prepend">
<!-- first page button -->
	<?php if ($vwhistoryorder_list->Pager->FirstButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerFirst") ?>" href="<?php echo $vwhistoryorder_list->pageUrl() ?>start=<?php echo $vwhistoryorder_list->Pager->FirstButton->Start ?>"><i class="icon-first ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerFirst") ?>"><i class="icon-first ew-icon"></i></a>
	<?php } ?>
<!-- previous page button -->
	<?php if ($vwhistoryorder_list->Pager->PrevButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerPrevious") ?>" href="<?php echo $vwhistoryorder_list->pageUrl() ?>start=<?php echo $vwhistoryorder_list->Pager->PrevButton->Start ?>"><i class="icon-prev ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerPrevious") ?>"><i class="icon-prev ew-icon"></i></a>
	<?php } ?>
</div>
<!-- current page number -->
	<input class="form-control" type="text" name="<?php echo TABLE_PAGE_NO ?>" value="<?php echo $vwhistoryorder_list->Pager->CurrentPage ?>">
<div class="input-group-append">
<!-- next page button -->
	<?php if ($vwhistoryorder_list->Pager->NextButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerNext") ?>" href="<?php echo $vwhistoryorder_list->pageUrl() ?>start=<?php echo $vwhistoryorder_list->Pager->NextButton->Start ?>"><i class="icon-next ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerNext") ?>"><i class="icon-next ew-icon"></i></a>
	<?php } ?>
<!-- last page button -->
	<?php if ($vwhistoryorder_list->Pager->LastButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerLast") ?>" href="<?php echo $vwhistoryorder_list->pageUrl() ?>start=<?php echo $vwhistoryorder_list->Pager->LastButton->Start ?>"><i class="icon-last ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerLast") ?>"><i class="icon-last ew-icon"></i></a>
	<?php } ?>
</div>
</div>
</div>
<span>&nbsp;<?php echo $Language->Phrase("of") ?>&nbsp;<?php echo $vwhistoryorder_list->Pager->PageCount ?></span>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php if ($vwhistoryorder_list->Pager->RecordCount > 0) { ?>
<div class="ew-pager ew-rec">
	<span><?php echo $Language->Phrase("Record") ?>&nbsp;<?php echo $vwhistoryorder_list->Pager->FromIndex ?>&nbsp;<?php echo $Language->Phrase("To") ?>&nbsp;<?php echo $vwhistoryorder_list->Pager->ToIndex ?>&nbsp;<?php echo $Language->Phrase("Of") ?>&nbsp;<?php echo $vwhistoryorder_list->Pager->RecordCount ?></span>
</div>
<?php } ?>
<?php if ($vwhistoryorder_list->TotalRecs > 0 && (!$vwhistoryorder_list->AutoHidePageSizeSelector || $vwhistoryorder_list->Pager->Visible)) { ?>
<div class="ew-pager">
<input type="hidden" name="t" value="vwhistoryorder">
<select name="<?php echo TABLE_REC_PER_PAGE ?>" class="form-control form-control-sm ew-tooltip" title="<?php echo $Language->phrase("RecordsPerPage") ?>" onchange="this.form.submit();">
<option value="20"<?php if ($vwhistoryorder_list->DisplayRecs == 20) { ?> selected<?php } ?>>20</option>
<option value="50"<?php if ($vwhistoryorder_list->DisplayRecs == 50) { ?> selected<?php } ?>>50</option>
<option value="100"<?php if ($vwhistoryorder_list->DisplayRecs == 100) { ?> selected<?php } ?>>100</option>
<option value="200"<?php if ($vwhistoryorder_list->DisplayRecs == 200) { ?> selected<?php } ?>>200</option>
<option value="500"<?php if ($vwhistoryorder_list->DisplayRecs == 500) { ?> selected<?php } ?>>500</option>
<option value="ALL"<?php if ($vwhistoryorder->getRecordsPerPage() == -1) { ?> selected<?php } ?>><?php echo $Language->Phrase("AllRecords") ?></option>
</select>
</div>
<?php } ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $vwhistoryorder_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($vwhistoryorder_list->TotalRecs == 0 && !$vwhistoryorder->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $vwhistoryorder_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$vwhistoryorder_list->showPageFooter();
if (DEBUG_ENABLED)
	echo GetDebugMessage();
?>
<?php if (!$vwhistoryorder->isExport()) { ?>
<script>

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php } ?>
<?php include_once "footer.php" ?>
<?php
$vwhistoryorder_list->terminate();
?>