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
$vwcodesummary_list = new vwcodesummary_list();

// Run the page
$vwcodesummary_list->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$vwcodesummary_list->Page_Render();
?>
<?php include_once "header.php" ?>
<?php if (!$vwcodesummary->isExport()) { ?>
<script>

// Form object
currentPageID = ew.PAGE_ID = "list";
var fvwcodesummarylist = currentForm = new ew.Form("fvwcodesummarylist", "list");
fvwcodesummarylist.formKeyCountName = '<?php echo $vwcodesummary_list->FormKeyCountName ?>';

// Form_CustomValidate event
fvwcodesummarylist.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

	// Your custom validation code here, return false if invalid.
	return true;
}

// Use JavaScript validation or not
fvwcodesummarylist.validateRequired = <?php echo json_encode(CLIENT_VALIDATE) ?>;

// Dynamic selection lists
// Form object for search

var fvwcodesummarylistsrch = currentSearchForm = new ew.Form("fvwcodesummarylistsrch");

// Filters
fvwcodesummarylistsrch.filterList = <?php echo $vwcodesummary_list->getFilterList() ?>;
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
<?php if (!$vwcodesummary->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($vwcodesummary_list->TotalRecs > 0 && $vwcodesummary_list->ExportOptions->visible()) { ?>
<?php $vwcodesummary_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($vwcodesummary_list->ImportOptions->visible()) { ?>
<?php $vwcodesummary_list->ImportOptions->render("body") ?>
<?php } ?>
<?php if ($vwcodesummary_list->SearchOptions->visible()) { ?>
<?php $vwcodesummary_list->SearchOptions->render("body") ?>
<?php } ?>
<?php if ($vwcodesummary_list->FilterOptions->visible()) { ?>
<?php $vwcodesummary_list->FilterOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php
$vwcodesummary_list->renderOtherOptions();
?>
<?php if ($Security->CanSearch()) { ?>
<?php if (!$vwcodesummary->isExport() && !$vwcodesummary->CurrentAction) { ?>
<form name="fvwcodesummarylistsrch" id="fvwcodesummarylistsrch" class="form-inline ew-form ew-ext-search-form" action="<?php echo CurrentPageName() ?>">
<?php $searchPanelClass = ($vwcodesummary_list->SearchWhere <> "") ? " show" : " show"; ?>
<div id="fvwcodesummarylistsrch-search-panel" class="ew-search-panel collapse<?php echo $searchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="vwcodesummary">
	<div class="ew-basic-search">
<div id="xsr_1" class="ew-row d-sm-flex">
	<div class="ew-quick-search input-group">
		<input type="text" name="<?php echo TABLE_BASIC_SEARCH ?>" id="<?php echo TABLE_BASIC_SEARCH ?>" class="form-control" value="<?php echo HtmlEncode($vwcodesummary_list->BasicSearch->getKeyword()) ?>" placeholder="<?php echo HtmlEncode($Language->phrase("Search")) ?>">
		<input type="hidden" name="<?php echo TABLE_BASIC_SEARCH_TYPE ?>" id="<?php echo TABLE_BASIC_SEARCH_TYPE ?>" value="<?php echo HtmlEncode($vwcodesummary_list->BasicSearch->getType()) ?>">
		<div class="input-group-append">
			<button class="btn btn-primary" name="btn-submit" id="btn-submit" type="submit"><?php echo $Language->phrase("SearchBtn") ?></button>
			<button type="button" data-toggle="dropdown" class="btn btn-primary dropdown-toggle dropdown-toggle-split" aria-haspopup="true" aria-expanded="false"><span id="searchtype"><?php echo $vwcodesummary_list->BasicSearch->getTypeNameShort() ?></span></button>
			<div class="dropdown-menu dropdown-menu-right">
				<a class="dropdown-item<?php if ($vwcodesummary_list->BasicSearch->getType() == "") echo " active"; ?>" href="javascript:void(0);" onclick="ew.setSearchType(this)"><?php echo $Language->phrase("QuickSearchAuto") ?></a>
				<a class="dropdown-item<?php if ($vwcodesummary_list->BasicSearch->getType() == "=") echo " active"; ?>" href="javascript:void(0);" onclick="ew.setSearchType(this,'=')"><?php echo $Language->phrase("QuickSearchExact") ?></a>
				<a class="dropdown-item<?php if ($vwcodesummary_list->BasicSearch->getType() == "AND") echo " active"; ?>" href="javascript:void(0);" onclick="ew.setSearchType(this,'AND')"><?php echo $Language->phrase("QuickSearchAll") ?></a>
				<a class="dropdown-item<?php if ($vwcodesummary_list->BasicSearch->getType() == "OR") echo " active"; ?>" href="javascript:void(0);" onclick="ew.setSearchType(this,'OR')"><?php echo $Language->phrase("QuickSearchAny") ?></a>
			</div>
		</div>
	</div>
</div>
	</div>
</div>
</form>
<?php } ?>
<?php } ?>
<?php $vwcodesummary_list->showPageHeader(); ?>
<?php
$vwcodesummary_list->showMessage();
?>
<?php if ($vwcodesummary_list->TotalRecs > 0 || $vwcodesummary->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($vwcodesummary_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> vwcodesummary">
<?php if (!$vwcodesummary->isExport()) { ?>
<div class="card-header ew-grid-upper-panel">
<?php if (!$vwcodesummary->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php if (!isset($vwcodesummary_list->Pager)) $vwcodesummary_list->Pager = new PrevNextPager($vwcodesummary_list->StartRec, $vwcodesummary_list->DisplayRecs, $vwcodesummary_list->TotalRecs, $vwcodesummary_list->AutoHidePager) ?>
<?php if ($vwcodesummary_list->Pager->RecordCount > 0 && $vwcodesummary_list->Pager->Visible) { ?>
<div class="ew-pager">
<span><?php echo $Language->Phrase("Page") ?>&nbsp;</span>
<div class="ew-prev-next"><div class="input-group input-group-sm">
<div class="input-group-prepend">
<!-- first page button -->
	<?php if ($vwcodesummary_list->Pager->FirstButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerFirst") ?>" href="<?php echo $vwcodesummary_list->pageUrl() ?>start=<?php echo $vwcodesummary_list->Pager->FirstButton->Start ?>"><i class="icon-first ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerFirst") ?>"><i class="icon-first ew-icon"></i></a>
	<?php } ?>
<!-- previous page button -->
	<?php if ($vwcodesummary_list->Pager->PrevButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerPrevious") ?>" href="<?php echo $vwcodesummary_list->pageUrl() ?>start=<?php echo $vwcodesummary_list->Pager->PrevButton->Start ?>"><i class="icon-prev ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerPrevious") ?>"><i class="icon-prev ew-icon"></i></a>
	<?php } ?>
</div>
<!-- current page number -->
	<input class="form-control" type="text" name="<?php echo TABLE_PAGE_NO ?>" value="<?php echo $vwcodesummary_list->Pager->CurrentPage ?>">
<div class="input-group-append">
<!-- next page button -->
	<?php if ($vwcodesummary_list->Pager->NextButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerNext") ?>" href="<?php echo $vwcodesummary_list->pageUrl() ?>start=<?php echo $vwcodesummary_list->Pager->NextButton->Start ?>"><i class="icon-next ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerNext") ?>"><i class="icon-next ew-icon"></i></a>
	<?php } ?>
<!-- last page button -->
	<?php if ($vwcodesummary_list->Pager->LastButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerLast") ?>" href="<?php echo $vwcodesummary_list->pageUrl() ?>start=<?php echo $vwcodesummary_list->Pager->LastButton->Start ?>"><i class="icon-last ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerLast") ?>"><i class="icon-last ew-icon"></i></a>
	<?php } ?>
</div>
</div>
</div>
<span>&nbsp;<?php echo $Language->Phrase("of") ?>&nbsp;<?php echo $vwcodesummary_list->Pager->PageCount ?></span>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php if ($vwcodesummary_list->Pager->RecordCount > 0) { ?>
<div class="ew-pager ew-rec">
	<span><?php echo $Language->Phrase("Record") ?>&nbsp;<?php echo $vwcodesummary_list->Pager->FromIndex ?>&nbsp;<?php echo $Language->Phrase("To") ?>&nbsp;<?php echo $vwcodesummary_list->Pager->ToIndex ?>&nbsp;<?php echo $Language->Phrase("Of") ?>&nbsp;<?php echo $vwcodesummary_list->Pager->RecordCount ?></span>
</div>
<?php } ?>
<?php if ($vwcodesummary_list->TotalRecs > 0 && (!$vwcodesummary_list->AutoHidePageSizeSelector || $vwcodesummary_list->Pager->Visible)) { ?>
<div class="ew-pager">
<input type="hidden" name="t" value="vwcodesummary">
<select name="<?php echo TABLE_REC_PER_PAGE ?>" class="form-control form-control-sm ew-tooltip" title="<?php echo $Language->phrase("RecordsPerPage") ?>" onchange="this.form.submit();">
<option value="20"<?php if ($vwcodesummary_list->DisplayRecs == 20) { ?> selected<?php } ?>>20</option>
<option value="50"<?php if ($vwcodesummary_list->DisplayRecs == 50) { ?> selected<?php } ?>>50</option>
<option value="100"<?php if ($vwcodesummary_list->DisplayRecs == 100) { ?> selected<?php } ?>>100</option>
<option value="200"<?php if ($vwcodesummary_list->DisplayRecs == 200) { ?> selected<?php } ?>>200</option>
<option value="500"<?php if ($vwcodesummary_list->DisplayRecs == 500) { ?> selected<?php } ?>>500</option>
<option value="ALL"<?php if ($vwcodesummary->getRecordsPerPage() == -1) { ?> selected<?php } ?>><?php echo $Language->Phrase("AllRecords") ?></option>
</select>
</div>
<?php } ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $vwcodesummary_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
<form name="fvwcodesummarylist" id="fvwcodesummarylist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($vwcodesummary_list->CheckToken) { ?>
<input type="hidden" name="<?php echo TOKEN_NAME ?>" value="<?php echo $vwcodesummary_list->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="vwcodesummary">
<input type="hidden" name="exporttype" id="exporttype" value="">
<div id="gmp_vwcodesummary" class="<?php if (IsResponsiveLayout()) { ?>table-responsive <?php } ?>card-body ew-grid-middle-panel">
<?php if ($vwcodesummary_list->TotalRecs > 0 || $vwcodesummary->isGridEdit()) { ?>
<table id="tbl_vwcodesummarylist" class="table ew-table"><!-- .ew-table ##-->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$vwcodesummary_list->RowType = ROWTYPE_HEADER;

// Render list options
$vwcodesummary_list->renderListOptions();

// Render list options (header, left)
$vwcodesummary_list->ListOptions->render("header", "left");
?>
<?php if ($vwcodesummary->Code->Visible) { // Code ?>
	<?php if ($vwcodesummary->sortUrl($vwcodesummary->Code) == "") { ?>
		<th data-name="Code" class="<?php echo $vwcodesummary->Code->headerCellClass() ?>" style="white-space: nowrap;"><div id="elh_vwcodesummary_Code" class="vwcodesummary_Code"><div class="ew-table-header-caption"><?php echo $vwcodesummary->Code->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Code" class="<?php echo $vwcodesummary->Code->headerCellClass() ?>" style="white-space: nowrap;"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $vwcodesummary->SortUrl($vwcodesummary->Code) ?>',2);"><div id="elh_vwcodesummary_Code" class="vwcodesummary_Code">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $vwcodesummary->Code->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($vwcodesummary->Code->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($vwcodesummary->Code->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($vwcodesummary->ProductName->Visible) { // ProductName ?>
	<?php if ($vwcodesummary->sortUrl($vwcodesummary->ProductName) == "") { ?>
		<th data-name="ProductName" class="<?php echo $vwcodesummary->ProductName->headerCellClass() ?>" style="white-space: nowrap;"><div id="elh_vwcodesummary_ProductName" class="vwcodesummary_ProductName"><div class="ew-table-header-caption"><?php echo $vwcodesummary->ProductName->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="ProductName" class="<?php echo $vwcodesummary->ProductName->headerCellClass() ?>" style="white-space: nowrap;"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $vwcodesummary->SortUrl($vwcodesummary->ProductName) ?>',2);"><div id="elh_vwcodesummary_ProductName" class="vwcodesummary_ProductName">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $vwcodesummary->ProductName->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($vwcodesummary->ProductName->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($vwcodesummary->ProductName->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($vwcodesummary->VnName->Visible) { // VnName ?>
	<?php if ($vwcodesummary->sortUrl($vwcodesummary->VnName) == "") { ?>
		<th data-name="VnName" class="<?php echo $vwcodesummary->VnName->headerCellClass() ?>" style="white-space: nowrap;"><div id="elh_vwcodesummary_VnName" class="vwcodesummary_VnName"><div class="ew-table-header-caption"><?php echo $vwcodesummary->VnName->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="VnName" class="<?php echo $vwcodesummary->VnName->headerCellClass() ?>" style="white-space: nowrap;"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $vwcodesummary->SortUrl($vwcodesummary->VnName) ?>',2);"><div id="elh_vwcodesummary_VnName" class="vwcodesummary_VnName">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $vwcodesummary->VnName->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($vwcodesummary->VnName->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($vwcodesummary->VnName->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($vwcodesummary->Model->Visible) { // Model ?>
	<?php if ($vwcodesummary->sortUrl($vwcodesummary->Model) == "") { ?>
		<th data-name="Model" class="<?php echo $vwcodesummary->Model->headerCellClass() ?>" style="white-space: nowrap;"><div id="elh_vwcodesummary_Model" class="vwcodesummary_Model"><div class="ew-table-header-caption"><?php echo $vwcodesummary->Model->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Model" class="<?php echo $vwcodesummary->Model->headerCellClass() ?>" style="white-space: nowrap;"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $vwcodesummary->SortUrl($vwcodesummary->Model) ?>',2);"><div id="elh_vwcodesummary_Model" class="vwcodesummary_Model">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $vwcodesummary->Model->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($vwcodesummary->Model->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($vwcodesummary->Model->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($vwcodesummary->PCS->Visible) { // PCS ?>
	<?php if ($vwcodesummary->sortUrl($vwcodesummary->PCS) == "") { ?>
		<th data-name="PCS" class="<?php echo $vwcodesummary->PCS->headerCellClass() ?>" style="white-space: nowrap;"><div id="elh_vwcodesummary_PCS" class="vwcodesummary_PCS"><div class="ew-table-header-caption"><?php echo $vwcodesummary->PCS->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="PCS" class="<?php echo $vwcodesummary->PCS->headerCellClass() ?>" style="white-space: nowrap;"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $vwcodesummary->SortUrl($vwcodesummary->PCS) ?>',2);"><div id="elh_vwcodesummary_PCS" class="vwcodesummary_PCS">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $vwcodesummary->PCS->caption() ?></span><span class="ew-table-header-sort"><?php if ($vwcodesummary->PCS->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($vwcodesummary->PCS->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$vwcodesummary_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
if ($vwcodesummary->ExportAll && $vwcodesummary->isExport()) {
	$vwcodesummary_list->StopRec = $vwcodesummary_list->TotalRecs;
} else {

	// Set the last record to display
	if ($vwcodesummary_list->TotalRecs > $vwcodesummary_list->StartRec + $vwcodesummary_list->DisplayRecs - 1)
		$vwcodesummary_list->StopRec = $vwcodesummary_list->StartRec + $vwcodesummary_list->DisplayRecs - 1;
	else
		$vwcodesummary_list->StopRec = $vwcodesummary_list->TotalRecs;
}
$vwcodesummary_list->RecCnt = $vwcodesummary_list->StartRec - 1;
if ($vwcodesummary_list->Recordset && !$vwcodesummary_list->Recordset->EOF) {
	$vwcodesummary_list->Recordset->moveFirst();
	$selectLimit = $vwcodesummary_list->UseSelectLimit;
	if (!$selectLimit && $vwcodesummary_list->StartRec > 1)
		$vwcodesummary_list->Recordset->move($vwcodesummary_list->StartRec - 1);
} elseif (!$vwcodesummary->AllowAddDeleteRow && $vwcodesummary_list->StopRec == 0) {
	$vwcodesummary_list->StopRec = $vwcodesummary->GridAddRowCount;
}

// Initialize aggregate
$vwcodesummary->RowType = ROWTYPE_AGGREGATEINIT;
$vwcodesummary->resetAttributes();
$vwcodesummary_list->renderRow();
while ($vwcodesummary_list->RecCnt < $vwcodesummary_list->StopRec) {
	$vwcodesummary_list->RecCnt++;
	if ($vwcodesummary_list->RecCnt >= $vwcodesummary_list->StartRec) {
		$vwcodesummary_list->RowCnt++;

		// Set up key count
		$vwcodesummary_list->KeyCount = $vwcodesummary_list->RowIndex;

		// Init row class and style
		$vwcodesummary->resetAttributes();
		$vwcodesummary->CssClass = "";
		if ($vwcodesummary->isGridAdd()) {
		} else {
			$vwcodesummary_list->loadRowValues($vwcodesummary_list->Recordset); // Load row values
		}
		$vwcodesummary->RowType = ROWTYPE_VIEW; // Render view

		// Set up row id / data-rowindex
		$vwcodesummary->RowAttrs = array_merge($vwcodesummary->RowAttrs, array('data-rowindex'=>$vwcodesummary_list->RowCnt, 'id'=>'r' . $vwcodesummary_list->RowCnt . '_vwcodesummary', 'data-rowtype'=>$vwcodesummary->RowType));

		// Render row
		$vwcodesummary_list->renderRow();

		// Render list options
		$vwcodesummary_list->renderListOptions();
?>
	<tr<?php echo $vwcodesummary->rowAttributes() ?>>
<?php

// Render list options (body, left)
$vwcodesummary_list->ListOptions->render("body", "left", $vwcodesummary_list->RowCnt);
?>
	<?php if ($vwcodesummary->Code->Visible) { // Code ?>
		<td data-name="Code"<?php echo $vwcodesummary->Code->cellAttributes() ?>>
<span id="el<?php echo $vwcodesummary_list->RowCnt ?>_vwcodesummary_Code" class="vwcodesummary_Code">
<span<?php echo $vwcodesummary->Code->viewAttributes() ?>>
<?php echo $vwcodesummary->Code->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($vwcodesummary->ProductName->Visible) { // ProductName ?>
		<td data-name="ProductName"<?php echo $vwcodesummary->ProductName->cellAttributes() ?>>
<span id="el<?php echo $vwcodesummary_list->RowCnt ?>_vwcodesummary_ProductName" class="vwcodesummary_ProductName">
<span<?php echo $vwcodesummary->ProductName->viewAttributes() ?>>
<?php echo $vwcodesummary->ProductName->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($vwcodesummary->VnName->Visible) { // VnName ?>
		<td data-name="VnName"<?php echo $vwcodesummary->VnName->cellAttributes() ?>>
<span id="el<?php echo $vwcodesummary_list->RowCnt ?>_vwcodesummary_VnName" class="vwcodesummary_VnName">
<span<?php echo $vwcodesummary->VnName->viewAttributes() ?>>
<?php echo $vwcodesummary->VnName->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($vwcodesummary->Model->Visible) { // Model ?>
		<td data-name="Model"<?php echo $vwcodesummary->Model->cellAttributes() ?>>
<span id="el<?php echo $vwcodesummary_list->RowCnt ?>_vwcodesummary_Model" class="vwcodesummary_Model">
<span<?php echo $vwcodesummary->Model->viewAttributes() ?>>
<?php echo $vwcodesummary->Model->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($vwcodesummary->PCS->Visible) { // PCS ?>
		<td data-name="PCS"<?php echo $vwcodesummary->PCS->cellAttributes() ?>>
<span id="el<?php echo $vwcodesummary_list->RowCnt ?>_vwcodesummary_PCS" class="vwcodesummary_PCS">
<span<?php echo $vwcodesummary->PCS->viewAttributes() ?>>
<?php echo $vwcodesummary->PCS->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$vwcodesummary_list->ListOptions->render("body", "right", $vwcodesummary_list->RowCnt);
?>
	</tr>
<?php
	}
	if (!$vwcodesummary->isGridAdd())
		$vwcodesummary_list->Recordset->moveNext();
}
?>
</tbody>
<?php

// Render aggregate row
$vwcodesummary->RowType = ROWTYPE_AGGREGATE;
$vwcodesummary->resetAttributes();
$vwcodesummary_list->renderRow();
?>
<?php if ($vwcodesummary_list->TotalRecs > 0 && !$vwcodesummary->isGridAdd() && !$vwcodesummary->isGridEdit()) { ?>
<tfoot><!-- Table footer -->
	<tr class="ew-table-footer">
<?php

// Render list options
$vwcodesummary_list->renderListOptions();

// Render list options (footer, left)
$vwcodesummary_list->ListOptions->render("footer", "left");
?>
	<?php if ($vwcodesummary->Code->Visible) { // Code ?>
		<td data-name="Code" class="<?php echo $vwcodesummary->Code->footerCellClass() ?>"><span id="elf_vwcodesummary_Code" class="vwcodesummary_Code">
		&nbsp;
		</span></td>
	<?php } ?>
	<?php if ($vwcodesummary->ProductName->Visible) { // ProductName ?>
		<td data-name="ProductName" class="<?php echo $vwcodesummary->ProductName->footerCellClass() ?>"><span id="elf_vwcodesummary_ProductName" class="vwcodesummary_ProductName">
		&nbsp;
		</span></td>
	<?php } ?>
	<?php if ($vwcodesummary->VnName->Visible) { // VnName ?>
		<td data-name="VnName" class="<?php echo $vwcodesummary->VnName->footerCellClass() ?>"><span id="elf_vwcodesummary_VnName" class="vwcodesummary_VnName">
		&nbsp;
		</span></td>
	<?php } ?>
	<?php if ($vwcodesummary->Model->Visible) { // Model ?>
		<td data-name="Model" class="<?php echo $vwcodesummary->Model->footerCellClass() ?>"><span id="elf_vwcodesummary_Model" class="vwcodesummary_Model">
		&nbsp;
		</span></td>
	<?php } ?>
	<?php if ($vwcodesummary->PCS->Visible) { // PCS ?>
		<td data-name="PCS" class="<?php echo $vwcodesummary->PCS->footerCellClass() ?>"><span id="elf_vwcodesummary_PCS" class="vwcodesummary_PCS">
		<span class="ew-aggregate"><?php echo $Language->phrase("TOTAL") ?></span><span class="ew-aggregate-value">
		<?php echo $vwcodesummary->PCS->ViewValue ?></span>
		</span></td>
	<?php } ?>
<?php

// Render list options (footer, right)
$vwcodesummary_list->ListOptions->render("footer", "right");
?>
	</tr>
</tfoot>
<?php } ?>
</table><!-- /.ew-table -->
<?php } ?>
<?php if (!$vwcodesummary->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</div><!-- /.ew-grid-middle-panel -->
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($vwcodesummary_list->Recordset)
	$vwcodesummary_list->Recordset->Close();
?>
<?php if (!$vwcodesummary->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$vwcodesummary->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php if (!isset($vwcodesummary_list->Pager)) $vwcodesummary_list->Pager = new PrevNextPager($vwcodesummary_list->StartRec, $vwcodesummary_list->DisplayRecs, $vwcodesummary_list->TotalRecs, $vwcodesummary_list->AutoHidePager) ?>
<?php if ($vwcodesummary_list->Pager->RecordCount > 0 && $vwcodesummary_list->Pager->Visible) { ?>
<div class="ew-pager">
<span><?php echo $Language->Phrase("Page") ?>&nbsp;</span>
<div class="ew-prev-next"><div class="input-group input-group-sm">
<div class="input-group-prepend">
<!-- first page button -->
	<?php if ($vwcodesummary_list->Pager->FirstButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerFirst") ?>" href="<?php echo $vwcodesummary_list->pageUrl() ?>start=<?php echo $vwcodesummary_list->Pager->FirstButton->Start ?>"><i class="icon-first ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerFirst") ?>"><i class="icon-first ew-icon"></i></a>
	<?php } ?>
<!-- previous page button -->
	<?php if ($vwcodesummary_list->Pager->PrevButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerPrevious") ?>" href="<?php echo $vwcodesummary_list->pageUrl() ?>start=<?php echo $vwcodesummary_list->Pager->PrevButton->Start ?>"><i class="icon-prev ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerPrevious") ?>"><i class="icon-prev ew-icon"></i></a>
	<?php } ?>
</div>
<!-- current page number -->
	<input class="form-control" type="text" name="<?php echo TABLE_PAGE_NO ?>" value="<?php echo $vwcodesummary_list->Pager->CurrentPage ?>">
<div class="input-group-append">
<!-- next page button -->
	<?php if ($vwcodesummary_list->Pager->NextButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerNext") ?>" href="<?php echo $vwcodesummary_list->pageUrl() ?>start=<?php echo $vwcodesummary_list->Pager->NextButton->Start ?>"><i class="icon-next ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerNext") ?>"><i class="icon-next ew-icon"></i></a>
	<?php } ?>
<!-- last page button -->
	<?php if ($vwcodesummary_list->Pager->LastButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerLast") ?>" href="<?php echo $vwcodesummary_list->pageUrl() ?>start=<?php echo $vwcodesummary_list->Pager->LastButton->Start ?>"><i class="icon-last ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerLast") ?>"><i class="icon-last ew-icon"></i></a>
	<?php } ?>
</div>
</div>
</div>
<span>&nbsp;<?php echo $Language->Phrase("of") ?>&nbsp;<?php echo $vwcodesummary_list->Pager->PageCount ?></span>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php if ($vwcodesummary_list->Pager->RecordCount > 0) { ?>
<div class="ew-pager ew-rec">
	<span><?php echo $Language->Phrase("Record") ?>&nbsp;<?php echo $vwcodesummary_list->Pager->FromIndex ?>&nbsp;<?php echo $Language->Phrase("To") ?>&nbsp;<?php echo $vwcodesummary_list->Pager->ToIndex ?>&nbsp;<?php echo $Language->Phrase("Of") ?>&nbsp;<?php echo $vwcodesummary_list->Pager->RecordCount ?></span>
</div>
<?php } ?>
<?php if ($vwcodesummary_list->TotalRecs > 0 && (!$vwcodesummary_list->AutoHidePageSizeSelector || $vwcodesummary_list->Pager->Visible)) { ?>
<div class="ew-pager">
<input type="hidden" name="t" value="vwcodesummary">
<select name="<?php echo TABLE_REC_PER_PAGE ?>" class="form-control form-control-sm ew-tooltip" title="<?php echo $Language->phrase("RecordsPerPage") ?>" onchange="this.form.submit();">
<option value="20"<?php if ($vwcodesummary_list->DisplayRecs == 20) { ?> selected<?php } ?>>20</option>
<option value="50"<?php if ($vwcodesummary_list->DisplayRecs == 50) { ?> selected<?php } ?>>50</option>
<option value="100"<?php if ($vwcodesummary_list->DisplayRecs == 100) { ?> selected<?php } ?>>100</option>
<option value="200"<?php if ($vwcodesummary_list->DisplayRecs == 200) { ?> selected<?php } ?>>200</option>
<option value="500"<?php if ($vwcodesummary_list->DisplayRecs == 500) { ?> selected<?php } ?>>500</option>
<option value="ALL"<?php if ($vwcodesummary->getRecordsPerPage() == -1) { ?> selected<?php } ?>><?php echo $Language->Phrase("AllRecords") ?></option>
</select>
</div>
<?php } ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $vwcodesummary_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($vwcodesummary_list->TotalRecs == 0 && !$vwcodesummary->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $vwcodesummary_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$vwcodesummary_list->showPageFooter();
if (DEBUG_ENABLED)
	echo GetDebugMessage();
?>
<?php if (!$vwcodesummary->isExport()) { ?>
<script>

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php } ?>
<?php include_once "footer.php" ?>
<?php
$vwcodesummary_list->terminate();
?>