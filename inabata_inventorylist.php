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
$inabata_inventory_list = new inabata_inventory_list();

// Run the page
$inabata_inventory_list->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$inabata_inventory_list->Page_Render();
?>
<?php include_once "header.php" ?>
<?php if (!$inabata_inventory->isExport()) { ?>
<script>

// Form object
currentPageID = ew.PAGE_ID = "list";
var finabata_inventorylist = currentForm = new ew.Form("finabata_inventorylist", "list");
finabata_inventorylist.formKeyCountName = '<?php echo $inabata_inventory_list->FormKeyCountName ?>';

// Form_CustomValidate event
finabata_inventorylist.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

	// Your custom validation code here, return false if invalid.
	return true;
}

// Use JavaScript validation or not
finabata_inventorylist.validateRequired = <?php echo json_encode(CLIENT_VALIDATE) ?>;

// Dynamic selection lists
// Form object for search

var finabata_inventorylistsrch = currentSearchForm = new ew.Form("finabata_inventorylistsrch");

// Filters
finabata_inventorylistsrch.filterList = <?php echo $inabata_inventory_list->getFilterList() ?>;
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
<?php if (!$inabata_inventory->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($inabata_inventory_list->TotalRecs > 0 && $inabata_inventory_list->ExportOptions->visible()) { ?>
<?php $inabata_inventory_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($inabata_inventory_list->ImportOptions->visible()) { ?>
<?php $inabata_inventory_list->ImportOptions->render("body") ?>
<?php } ?>
<?php if ($inabata_inventory_list->SearchOptions->visible()) { ?>
<?php $inabata_inventory_list->SearchOptions->render("body") ?>
<?php } ?>
<?php if ($inabata_inventory_list->FilterOptions->visible()) { ?>
<?php $inabata_inventory_list->FilterOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php
$inabata_inventory_list->renderOtherOptions();
?>
<?php if ($Security->CanSearch()) { ?>
<?php if (!$inabata_inventory->isExport() && !$inabata_inventory->CurrentAction) { ?>
<form name="finabata_inventorylistsrch" id="finabata_inventorylistsrch" class="form-inline ew-form ew-ext-search-form" action="<?php echo CurrentPageName() ?>">
<?php $searchPanelClass = ($inabata_inventory_list->SearchWhere <> "") ? " show" : " show"; ?>
<div id="finabata_inventorylistsrch-search-panel" class="ew-search-panel collapse<?php echo $searchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="inabata_inventory">
	<div class="ew-basic-search">
<div id="xsr_1" class="ew-row d-sm-flex">
	<div class="ew-quick-search input-group">
		<input type="text" name="<?php echo TABLE_BASIC_SEARCH ?>" id="<?php echo TABLE_BASIC_SEARCH ?>" class="form-control" value="<?php echo HtmlEncode($inabata_inventory_list->BasicSearch->getKeyword()) ?>" placeholder="<?php echo HtmlEncode($Language->phrase("Search")) ?>">
		<input type="hidden" name="<?php echo TABLE_BASIC_SEARCH_TYPE ?>" id="<?php echo TABLE_BASIC_SEARCH_TYPE ?>" value="<?php echo HtmlEncode($inabata_inventory_list->BasicSearch->getType()) ?>">
		<div class="input-group-append">
			<button class="btn btn-primary" name="btn-submit" id="btn-submit" type="submit"><?php echo $Language->phrase("SearchBtn") ?></button>
			<button type="button" data-toggle="dropdown" class="btn btn-primary dropdown-toggle dropdown-toggle-split" aria-haspopup="true" aria-expanded="false"><span id="searchtype"><?php echo $inabata_inventory_list->BasicSearch->getTypeNameShort() ?></span></button>
			<div class="dropdown-menu dropdown-menu-right">
				<a class="dropdown-item<?php if ($inabata_inventory_list->BasicSearch->getType() == "") echo " active"; ?>" href="javascript:void(0);" onclick="ew.setSearchType(this)"><?php echo $Language->phrase("QuickSearchAuto") ?></a>
				<a class="dropdown-item<?php if ($inabata_inventory_list->BasicSearch->getType() == "=") echo " active"; ?>" href="javascript:void(0);" onclick="ew.setSearchType(this,'=')"><?php echo $Language->phrase("QuickSearchExact") ?></a>
				<a class="dropdown-item<?php if ($inabata_inventory_list->BasicSearch->getType() == "AND") echo " active"; ?>" href="javascript:void(0);" onclick="ew.setSearchType(this,'AND')"><?php echo $Language->phrase("QuickSearchAll") ?></a>
				<a class="dropdown-item<?php if ($inabata_inventory_list->BasicSearch->getType() == "OR") echo " active"; ?>" href="javascript:void(0);" onclick="ew.setSearchType(this,'OR')"><?php echo $Language->phrase("QuickSearchAny") ?></a>
			</div>
		</div>
	</div>
</div>
	</div>
</div>
</form>
<?php } ?>
<?php } ?>
<?php $inabata_inventory_list->showPageHeader(); ?>
<?php
$inabata_inventory_list->showMessage();
?>
<?php if ($inabata_inventory_list->TotalRecs > 0 || $inabata_inventory->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($inabata_inventory_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> inabata_inventory">
<?php if (!$inabata_inventory->isExport()) { ?>
<div class="card-header ew-grid-upper-panel">
<?php if (!$inabata_inventory->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php if (!isset($inabata_inventory_list->Pager)) $inabata_inventory_list->Pager = new PrevNextPager($inabata_inventory_list->StartRec, $inabata_inventory_list->DisplayRecs, $inabata_inventory_list->TotalRecs, $inabata_inventory_list->AutoHidePager) ?>
<?php if ($inabata_inventory_list->Pager->RecordCount > 0 && $inabata_inventory_list->Pager->Visible) { ?>
<div class="ew-pager">
<span><?php echo $Language->Phrase("Page") ?>&nbsp;</span>
<div class="ew-prev-next"><div class="input-group input-group-sm">
<div class="input-group-prepend">
<!-- first page button -->
	<?php if ($inabata_inventory_list->Pager->FirstButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerFirst") ?>" href="<?php echo $inabata_inventory_list->pageUrl() ?>start=<?php echo $inabata_inventory_list->Pager->FirstButton->Start ?>"><i class="icon-first ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerFirst") ?>"><i class="icon-first ew-icon"></i></a>
	<?php } ?>
<!-- previous page button -->
	<?php if ($inabata_inventory_list->Pager->PrevButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerPrevious") ?>" href="<?php echo $inabata_inventory_list->pageUrl() ?>start=<?php echo $inabata_inventory_list->Pager->PrevButton->Start ?>"><i class="icon-prev ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerPrevious") ?>"><i class="icon-prev ew-icon"></i></a>
	<?php } ?>
</div>
<!-- current page number -->
	<input class="form-control" type="text" name="<?php echo TABLE_PAGE_NO ?>" value="<?php echo $inabata_inventory_list->Pager->CurrentPage ?>">
<div class="input-group-append">
<!-- next page button -->
	<?php if ($inabata_inventory_list->Pager->NextButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerNext") ?>" href="<?php echo $inabata_inventory_list->pageUrl() ?>start=<?php echo $inabata_inventory_list->Pager->NextButton->Start ?>"><i class="icon-next ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerNext") ?>"><i class="icon-next ew-icon"></i></a>
	<?php } ?>
<!-- last page button -->
	<?php if ($inabata_inventory_list->Pager->LastButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerLast") ?>" href="<?php echo $inabata_inventory_list->pageUrl() ?>start=<?php echo $inabata_inventory_list->Pager->LastButton->Start ?>"><i class="icon-last ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerLast") ?>"><i class="icon-last ew-icon"></i></a>
	<?php } ?>
</div>
</div>
</div>
<span>&nbsp;<?php echo $Language->Phrase("of") ?>&nbsp;<?php echo $inabata_inventory_list->Pager->PageCount ?></span>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php if ($inabata_inventory_list->Pager->RecordCount > 0) { ?>
<div class="ew-pager ew-rec">
	<span><?php echo $Language->Phrase("Record") ?>&nbsp;<?php echo $inabata_inventory_list->Pager->FromIndex ?>&nbsp;<?php echo $Language->Phrase("To") ?>&nbsp;<?php echo $inabata_inventory_list->Pager->ToIndex ?>&nbsp;<?php echo $Language->Phrase("Of") ?>&nbsp;<?php echo $inabata_inventory_list->Pager->RecordCount ?></span>
</div>
<?php } ?>
<?php if ($inabata_inventory_list->TotalRecs > 0 && (!$inabata_inventory_list->AutoHidePageSizeSelector || $inabata_inventory_list->Pager->Visible)) { ?>
<div class="ew-pager">
<input type="hidden" name="t" value="inabata_inventory">
<select name="<?php echo TABLE_REC_PER_PAGE ?>" class="form-control form-control-sm ew-tooltip" title="<?php echo $Language->phrase("RecordsPerPage") ?>" onchange="this.form.submit();">
<option value="20"<?php if ($inabata_inventory_list->DisplayRecs == 20) { ?> selected<?php } ?>>20</option>
<option value="50"<?php if ($inabata_inventory_list->DisplayRecs == 50) { ?> selected<?php } ?>>50</option>
<option value="100"<?php if ($inabata_inventory_list->DisplayRecs == 100) { ?> selected<?php } ?>>100</option>
<option value="200"<?php if ($inabata_inventory_list->DisplayRecs == 200) { ?> selected<?php } ?>>200</option>
<option value="500"<?php if ($inabata_inventory_list->DisplayRecs == 500) { ?> selected<?php } ?>>500</option>
<option value="ALL"<?php if ($inabata_inventory->getRecordsPerPage() == -1) { ?> selected<?php } ?>><?php echo $Language->Phrase("AllRecords") ?></option>
</select>
</div>
<?php } ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $inabata_inventory_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
<form name="finabata_inventorylist" id="finabata_inventorylist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($inabata_inventory_list->CheckToken) { ?>
<input type="hidden" name="<?php echo TOKEN_NAME ?>" value="<?php echo $inabata_inventory_list->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="inabata_inventory">
<div id="gmp_inabata_inventory" class="<?php if (IsResponsiveLayout()) { ?>table-responsive <?php } ?>card-body ew-grid-middle-panel">
<?php if ($inabata_inventory_list->TotalRecs > 0 || $inabata_inventory->isGridEdit()) { ?>
<table id="tbl_inabata_inventorylist" class="table ew-table"><!-- .ew-table ##-->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$inabata_inventory_list->RowType = ROWTYPE_HEADER;

// Render list options
$inabata_inventory_list->renderListOptions();

// Render list options (header, left)
$inabata_inventory_list->ListOptions->render("header", "left");
?>
<?php if ($inabata_inventory->Code->Visible) { // Code ?>
	<?php if ($inabata_inventory->sortUrl($inabata_inventory->Code) == "") { ?>
		<th data-name="Code" class="<?php echo $inabata_inventory->Code->headerCellClass() ?>" style="white-space: nowrap;"><div id="elh_inabata_inventory_Code" class="inabata_inventory_Code"><div class="ew-table-header-caption"><?php echo $inabata_inventory->Code->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Code" class="<?php echo $inabata_inventory->Code->headerCellClass() ?>" style="white-space: nowrap;"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $inabata_inventory->SortUrl($inabata_inventory->Code) ?>',2);"><div id="elh_inabata_inventory_Code" class="inabata_inventory_Code">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $inabata_inventory->Code->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($inabata_inventory->Code->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($inabata_inventory->Code->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($inabata_inventory->ProductName->Visible) { // ProductName ?>
	<?php if ($inabata_inventory->sortUrl($inabata_inventory->ProductName) == "") { ?>
		<th data-name="ProductName" class="<?php echo $inabata_inventory->ProductName->headerCellClass() ?>" style="white-space: nowrap;"><div id="elh_inabata_inventory_ProductName" class="inabata_inventory_ProductName"><div class="ew-table-header-caption"><?php echo $inabata_inventory->ProductName->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="ProductName" class="<?php echo $inabata_inventory->ProductName->headerCellClass() ?>" style="white-space: nowrap;"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $inabata_inventory->SortUrl($inabata_inventory->ProductName) ?>',2);"><div id="elh_inabata_inventory_ProductName" class="inabata_inventory_ProductName">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $inabata_inventory->ProductName->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($inabata_inventory->ProductName->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($inabata_inventory->ProductName->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($inabata_inventory->VnName->Visible) { // VnName ?>
	<?php if ($inabata_inventory->sortUrl($inabata_inventory->VnName) == "") { ?>
		<th data-name="VnName" class="<?php echo $inabata_inventory->VnName->headerCellClass() ?>" style="white-space: nowrap;"><div id="elh_inabata_inventory_VnName" class="inabata_inventory_VnName"><div class="ew-table-header-caption"><?php echo $inabata_inventory->VnName->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="VnName" class="<?php echo $inabata_inventory->VnName->headerCellClass() ?>" style="white-space: nowrap;"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $inabata_inventory->SortUrl($inabata_inventory->VnName) ?>',2);"><div id="elh_inabata_inventory_VnName" class="inabata_inventory_VnName">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $inabata_inventory->VnName->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($inabata_inventory->VnName->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($inabata_inventory->VnName->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($inabata_inventory->Model->Visible) { // Model ?>
	<?php if ($inabata_inventory->sortUrl($inabata_inventory->Model) == "") { ?>
		<th data-name="Model" class="<?php echo $inabata_inventory->Model->headerCellClass() ?>" style="white-space: nowrap;"><div id="elh_inabata_inventory_Model" class="inabata_inventory_Model"><div class="ew-table-header-caption"><?php echo $inabata_inventory->Model->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Model" class="<?php echo $inabata_inventory->Model->headerCellClass() ?>" style="white-space: nowrap;"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $inabata_inventory->SortUrl($inabata_inventory->Model) ?>',2);"><div id="elh_inabata_inventory_Model" class="inabata_inventory_Model">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $inabata_inventory->Model->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($inabata_inventory->Model->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($inabata_inventory->Model->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($inabata_inventory->PCS_IN->Visible) { // PCS_IN ?>
	<?php if ($inabata_inventory->sortUrl($inabata_inventory->PCS_IN) == "") { ?>
		<th data-name="PCS_IN" class="<?php echo $inabata_inventory->PCS_IN->headerCellClass() ?>" style="white-space: nowrap;"><div id="elh_inabata_inventory_PCS_IN" class="inabata_inventory_PCS_IN"><div class="ew-table-header-caption"><?php echo $inabata_inventory->PCS_IN->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="PCS_IN" class="<?php echo $inabata_inventory->PCS_IN->headerCellClass() ?>" style="white-space: nowrap;"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $inabata_inventory->SortUrl($inabata_inventory->PCS_IN) ?>',2);"><div id="elh_inabata_inventory_PCS_IN" class="inabata_inventory_PCS_IN">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $inabata_inventory->PCS_IN->caption() ?></span><span class="ew-table-header-sort"><?php if ($inabata_inventory->PCS_IN->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($inabata_inventory->PCS_IN->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($inabata_inventory->PCS_OUT->Visible) { // PCS_OUT ?>
	<?php if ($inabata_inventory->sortUrl($inabata_inventory->PCS_OUT) == "") { ?>
		<th data-name="PCS_OUT" class="<?php echo $inabata_inventory->PCS_OUT->headerCellClass() ?>" style="white-space: nowrap;"><div id="elh_inabata_inventory_PCS_OUT" class="inabata_inventory_PCS_OUT"><div class="ew-table-header-caption"><?php echo $inabata_inventory->PCS_OUT->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="PCS_OUT" class="<?php echo $inabata_inventory->PCS_OUT->headerCellClass() ?>" style="white-space: nowrap;"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $inabata_inventory->SortUrl($inabata_inventory->PCS_OUT) ?>',2);"><div id="elh_inabata_inventory_PCS_OUT" class="inabata_inventory_PCS_OUT">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $inabata_inventory->PCS_OUT->caption() ?></span><span class="ew-table-header-sort"><?php if ($inabata_inventory->PCS_OUT->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($inabata_inventory->PCS_OUT->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($inabata_inventory->PCS->Visible) { // PCS ?>
	<?php if ($inabata_inventory->sortUrl($inabata_inventory->PCS) == "") { ?>
		<th data-name="PCS" class="<?php echo $inabata_inventory->PCS->headerCellClass() ?>" style="white-space: nowrap;"><div id="elh_inabata_inventory_PCS" class="inabata_inventory_PCS"><div class="ew-table-header-caption"><?php echo $inabata_inventory->PCS->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="PCS" class="<?php echo $inabata_inventory->PCS->headerCellClass() ?>" style="white-space: nowrap;"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $inabata_inventory->SortUrl($inabata_inventory->PCS) ?>',2);"><div id="elh_inabata_inventory_PCS" class="inabata_inventory_PCS">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $inabata_inventory->PCS->caption() ?></span><span class="ew-table-header-sort"><?php if ($inabata_inventory->PCS->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($inabata_inventory->PCS->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$inabata_inventory_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
if ($inabata_inventory->ExportAll && $inabata_inventory->isExport()) {
	$inabata_inventory_list->StopRec = $inabata_inventory_list->TotalRecs;
} else {

	// Set the last record to display
	if ($inabata_inventory_list->TotalRecs > $inabata_inventory_list->StartRec + $inabata_inventory_list->DisplayRecs - 1)
		$inabata_inventory_list->StopRec = $inabata_inventory_list->StartRec + $inabata_inventory_list->DisplayRecs - 1;
	else
		$inabata_inventory_list->StopRec = $inabata_inventory_list->TotalRecs;
}
$inabata_inventory_list->RecCnt = $inabata_inventory_list->StartRec - 1;
if ($inabata_inventory_list->Recordset && !$inabata_inventory_list->Recordset->EOF) {
	$inabata_inventory_list->Recordset->moveFirst();
	$selectLimit = $inabata_inventory_list->UseSelectLimit;
	if (!$selectLimit && $inabata_inventory_list->StartRec > 1)
		$inabata_inventory_list->Recordset->move($inabata_inventory_list->StartRec - 1);
} elseif (!$inabata_inventory->AllowAddDeleteRow && $inabata_inventory_list->StopRec == 0) {
	$inabata_inventory_list->StopRec = $inabata_inventory->GridAddRowCount;
}

// Initialize aggregate
$inabata_inventory->RowType = ROWTYPE_AGGREGATEINIT;
$inabata_inventory->resetAttributes();
$inabata_inventory_list->renderRow();
while ($inabata_inventory_list->RecCnt < $inabata_inventory_list->StopRec) {
	$inabata_inventory_list->RecCnt++;
	if ($inabata_inventory_list->RecCnt >= $inabata_inventory_list->StartRec) {
		$inabata_inventory_list->RowCnt++;

		// Set up key count
		$inabata_inventory_list->KeyCount = $inabata_inventory_list->RowIndex;

		// Init row class and style
		$inabata_inventory->resetAttributes();
		$inabata_inventory->CssClass = "";
		if ($inabata_inventory->isGridAdd()) {
		} else {
			$inabata_inventory_list->loadRowValues($inabata_inventory_list->Recordset); // Load row values
		}
		$inabata_inventory->RowType = ROWTYPE_VIEW; // Render view

		// Set up row id / data-rowindex
		$inabata_inventory->RowAttrs = array_merge($inabata_inventory->RowAttrs, array('data-rowindex'=>$inabata_inventory_list->RowCnt, 'id'=>'r' . $inabata_inventory_list->RowCnt . '_inabata_inventory', 'data-rowtype'=>$inabata_inventory->RowType));

		// Render row
		$inabata_inventory_list->renderRow();

		// Render list options
		$inabata_inventory_list->renderListOptions();
?>
	<tr<?php echo $inabata_inventory->rowAttributes() ?>>
<?php

// Render list options (body, left)
$inabata_inventory_list->ListOptions->render("body", "left", $inabata_inventory_list->RowCnt);
?>
	<?php if ($inabata_inventory->Code->Visible) { // Code ?>
		<td data-name="Code"<?php echo $inabata_inventory->Code->cellAttributes() ?>>
<span id="el<?php echo $inabata_inventory_list->RowCnt ?>_inabata_inventory_Code" class="inabata_inventory_Code">
<span<?php echo $inabata_inventory->Code->viewAttributes() ?>>
<?php echo $inabata_inventory->Code->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($inabata_inventory->ProductName->Visible) { // ProductName ?>
		<td data-name="ProductName"<?php echo $inabata_inventory->ProductName->cellAttributes() ?>>
<span id="el<?php echo $inabata_inventory_list->RowCnt ?>_inabata_inventory_ProductName" class="inabata_inventory_ProductName">
<span<?php echo $inabata_inventory->ProductName->viewAttributes() ?>>
<?php echo $inabata_inventory->ProductName->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($inabata_inventory->VnName->Visible) { // VnName ?>
		<td data-name="VnName"<?php echo $inabata_inventory->VnName->cellAttributes() ?>>
<span id="el<?php echo $inabata_inventory_list->RowCnt ?>_inabata_inventory_VnName" class="inabata_inventory_VnName">
<span<?php echo $inabata_inventory->VnName->viewAttributes() ?>>
<?php echo $inabata_inventory->VnName->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($inabata_inventory->Model->Visible) { // Model ?>
		<td data-name="Model"<?php echo $inabata_inventory->Model->cellAttributes() ?>>
<span id="el<?php echo $inabata_inventory_list->RowCnt ?>_inabata_inventory_Model" class="inabata_inventory_Model">
<span<?php echo $inabata_inventory->Model->viewAttributes() ?>>
<?php echo $inabata_inventory->Model->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($inabata_inventory->PCS_IN->Visible) { // PCS_IN ?>
		<td data-name="PCS_IN"<?php echo $inabata_inventory->PCS_IN->cellAttributes() ?>>
<span id="el<?php echo $inabata_inventory_list->RowCnt ?>_inabata_inventory_PCS_IN" class="inabata_inventory_PCS_IN">
<span<?php echo $inabata_inventory->PCS_IN->viewAttributes() ?>>
<?php echo $inabata_inventory->PCS_IN->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($inabata_inventory->PCS_OUT->Visible) { // PCS_OUT ?>
		<td data-name="PCS_OUT"<?php echo $inabata_inventory->PCS_OUT->cellAttributes() ?>>
<span id="el<?php echo $inabata_inventory_list->RowCnt ?>_inabata_inventory_PCS_OUT" class="inabata_inventory_PCS_OUT">
<span<?php echo $inabata_inventory->PCS_OUT->viewAttributes() ?>>
<?php echo $inabata_inventory->PCS_OUT->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($inabata_inventory->PCS->Visible) { // PCS ?>
		<td data-name="PCS"<?php echo $inabata_inventory->PCS->cellAttributes() ?>>
<span id="el<?php echo $inabata_inventory_list->RowCnt ?>_inabata_inventory_PCS" class="inabata_inventory_PCS">
<span<?php echo $inabata_inventory->PCS->viewAttributes() ?>>
<?php echo $inabata_inventory->PCS->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$inabata_inventory_list->ListOptions->render("body", "right", $inabata_inventory_list->RowCnt);
?>
	</tr>
<?php
	}
	if (!$inabata_inventory->isGridAdd())
		$inabata_inventory_list->Recordset->moveNext();
}
?>
</tbody>
<?php

// Render aggregate row
$inabata_inventory->RowType = ROWTYPE_AGGREGATE;
$inabata_inventory->resetAttributes();
$inabata_inventory_list->renderRow();
?>
<?php if ($inabata_inventory_list->TotalRecs > 0 && !$inabata_inventory->isGridAdd() && !$inabata_inventory->isGridEdit()) { ?>
<tfoot><!-- Table footer -->
	<tr class="ew-table-footer">
<?php

// Render list options
$inabata_inventory_list->renderListOptions();

// Render list options (footer, left)
$inabata_inventory_list->ListOptions->render("footer", "left");
?>
	<?php if ($inabata_inventory->Code->Visible) { // Code ?>
		<td data-name="Code" class="<?php echo $inabata_inventory->Code->footerCellClass() ?>"><span id="elf_inabata_inventory_Code" class="inabata_inventory_Code">
		&nbsp;
		</span></td>
	<?php } ?>
	<?php if ($inabata_inventory->ProductName->Visible) { // ProductName ?>
		<td data-name="ProductName" class="<?php echo $inabata_inventory->ProductName->footerCellClass() ?>"><span id="elf_inabata_inventory_ProductName" class="inabata_inventory_ProductName">
		&nbsp;
		</span></td>
	<?php } ?>
	<?php if ($inabata_inventory->VnName->Visible) { // VnName ?>
		<td data-name="VnName" class="<?php echo $inabata_inventory->VnName->footerCellClass() ?>"><span id="elf_inabata_inventory_VnName" class="inabata_inventory_VnName">
		&nbsp;
		</span></td>
	<?php } ?>
	<?php if ($inabata_inventory->Model->Visible) { // Model ?>
		<td data-name="Model" class="<?php echo $inabata_inventory->Model->footerCellClass() ?>"><span id="elf_inabata_inventory_Model" class="inabata_inventory_Model">
		&nbsp;
		</span></td>
	<?php } ?>
	<?php if ($inabata_inventory->PCS_IN->Visible) { // PCS_IN ?>
		<td data-name="PCS_IN" class="<?php echo $inabata_inventory->PCS_IN->footerCellClass() ?>"><span id="elf_inabata_inventory_PCS_IN" class="inabata_inventory_PCS_IN">
		<span class="ew-aggregate"><?php echo $Language->phrase("TOTAL") ?></span><span class="ew-aggregate-value">
		<?php echo $inabata_inventory->PCS_IN->ViewValue ?></span>
		</span></td>
	<?php } ?>
	<?php if ($inabata_inventory->PCS_OUT->Visible) { // PCS_OUT ?>
		<td data-name="PCS_OUT" class="<?php echo $inabata_inventory->PCS_OUT->footerCellClass() ?>"><span id="elf_inabata_inventory_PCS_OUT" class="inabata_inventory_PCS_OUT">
		<span class="ew-aggregate"><?php echo $Language->phrase("TOTAL") ?></span><span class="ew-aggregate-value">
		<?php echo $inabata_inventory->PCS_OUT->ViewValue ?></span>
		</span></td>
	<?php } ?>
	<?php if ($inabata_inventory->PCS->Visible) { // PCS ?>
		<td data-name="PCS" class="<?php echo $inabata_inventory->PCS->footerCellClass() ?>"><span id="elf_inabata_inventory_PCS" class="inabata_inventory_PCS">
		<span class="ew-aggregate"><?php echo $Language->phrase("TOTAL") ?></span><span class="ew-aggregate-value">
		<?php echo $inabata_inventory->PCS->ViewValue ?></span>
		</span></td>
	<?php } ?>
<?php

// Render list options (footer, right)
$inabata_inventory_list->ListOptions->render("footer", "right");
?>
	</tr>
</tfoot>
<?php } ?>
</table><!-- /.ew-table -->
<?php } ?>
<?php if (!$inabata_inventory->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</div><!-- /.ew-grid-middle-panel -->
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($inabata_inventory_list->Recordset)
	$inabata_inventory_list->Recordset->Close();
?>
<?php if (!$inabata_inventory->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$inabata_inventory->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php if (!isset($inabata_inventory_list->Pager)) $inabata_inventory_list->Pager = new PrevNextPager($inabata_inventory_list->StartRec, $inabata_inventory_list->DisplayRecs, $inabata_inventory_list->TotalRecs, $inabata_inventory_list->AutoHidePager) ?>
<?php if ($inabata_inventory_list->Pager->RecordCount > 0 && $inabata_inventory_list->Pager->Visible) { ?>
<div class="ew-pager">
<span><?php echo $Language->Phrase("Page") ?>&nbsp;</span>
<div class="ew-prev-next"><div class="input-group input-group-sm">
<div class="input-group-prepend">
<!-- first page button -->
	<?php if ($inabata_inventory_list->Pager->FirstButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerFirst") ?>" href="<?php echo $inabata_inventory_list->pageUrl() ?>start=<?php echo $inabata_inventory_list->Pager->FirstButton->Start ?>"><i class="icon-first ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerFirst") ?>"><i class="icon-first ew-icon"></i></a>
	<?php } ?>
<!-- previous page button -->
	<?php if ($inabata_inventory_list->Pager->PrevButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerPrevious") ?>" href="<?php echo $inabata_inventory_list->pageUrl() ?>start=<?php echo $inabata_inventory_list->Pager->PrevButton->Start ?>"><i class="icon-prev ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerPrevious") ?>"><i class="icon-prev ew-icon"></i></a>
	<?php } ?>
</div>
<!-- current page number -->
	<input class="form-control" type="text" name="<?php echo TABLE_PAGE_NO ?>" value="<?php echo $inabata_inventory_list->Pager->CurrentPage ?>">
<div class="input-group-append">
<!-- next page button -->
	<?php if ($inabata_inventory_list->Pager->NextButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerNext") ?>" href="<?php echo $inabata_inventory_list->pageUrl() ?>start=<?php echo $inabata_inventory_list->Pager->NextButton->Start ?>"><i class="icon-next ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerNext") ?>"><i class="icon-next ew-icon"></i></a>
	<?php } ?>
<!-- last page button -->
	<?php if ($inabata_inventory_list->Pager->LastButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerLast") ?>" href="<?php echo $inabata_inventory_list->pageUrl() ?>start=<?php echo $inabata_inventory_list->Pager->LastButton->Start ?>"><i class="icon-last ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerLast") ?>"><i class="icon-last ew-icon"></i></a>
	<?php } ?>
</div>
</div>
</div>
<span>&nbsp;<?php echo $Language->Phrase("of") ?>&nbsp;<?php echo $inabata_inventory_list->Pager->PageCount ?></span>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php if ($inabata_inventory_list->Pager->RecordCount > 0) { ?>
<div class="ew-pager ew-rec">
	<span><?php echo $Language->Phrase("Record") ?>&nbsp;<?php echo $inabata_inventory_list->Pager->FromIndex ?>&nbsp;<?php echo $Language->Phrase("To") ?>&nbsp;<?php echo $inabata_inventory_list->Pager->ToIndex ?>&nbsp;<?php echo $Language->Phrase("Of") ?>&nbsp;<?php echo $inabata_inventory_list->Pager->RecordCount ?></span>
</div>
<?php } ?>
<?php if ($inabata_inventory_list->TotalRecs > 0 && (!$inabata_inventory_list->AutoHidePageSizeSelector || $inabata_inventory_list->Pager->Visible)) { ?>
<div class="ew-pager">
<input type="hidden" name="t" value="inabata_inventory">
<select name="<?php echo TABLE_REC_PER_PAGE ?>" class="form-control form-control-sm ew-tooltip" title="<?php echo $Language->phrase("RecordsPerPage") ?>" onchange="this.form.submit();">
<option value="20"<?php if ($inabata_inventory_list->DisplayRecs == 20) { ?> selected<?php } ?>>20</option>
<option value="50"<?php if ($inabata_inventory_list->DisplayRecs == 50) { ?> selected<?php } ?>>50</option>
<option value="100"<?php if ($inabata_inventory_list->DisplayRecs == 100) { ?> selected<?php } ?>>100</option>
<option value="200"<?php if ($inabata_inventory_list->DisplayRecs == 200) { ?> selected<?php } ?>>200</option>
<option value="500"<?php if ($inabata_inventory_list->DisplayRecs == 500) { ?> selected<?php } ?>>500</option>
<option value="ALL"<?php if ($inabata_inventory->getRecordsPerPage() == -1) { ?> selected<?php } ?>><?php echo $Language->Phrase("AllRecords") ?></option>
</select>
</div>
<?php } ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $inabata_inventory_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($inabata_inventory_list->TotalRecs == 0 && !$inabata_inventory->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $inabata_inventory_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$inabata_inventory_list->showPageFooter();
if (DEBUG_ENABLED)
	echo GetDebugMessage();
?>
<?php if (!$inabata_inventory->isExport()) { ?>
<script>

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php } ?>
<?php include_once "footer.php" ?>
<?php
$inabata_inventory_list->terminate();
?>