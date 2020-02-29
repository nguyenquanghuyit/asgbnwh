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
$vwroutepending_list = new vwroutepending_list();

// Run the page
$vwroutepending_list->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$vwroutepending_list->Page_Render();
?>
<?php include_once "header.php" ?>
<?php if (!$vwroutepending->isExport()) { ?>
<script>

// Form object
currentPageID = ew.PAGE_ID = "list";
var fvwroutependinglist = currentForm = new ew.Form("fvwroutependinglist", "list");
fvwroutependinglist.formKeyCountName = '<?php echo $vwroutepending_list->FormKeyCountName ?>';

// Form_CustomValidate event
fvwroutependinglist.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

	// Your custom validation code here, return false if invalid.
	return true;
}

// Use JavaScript validation or not
fvwroutependinglist.validateRequired = <?php echo json_encode(CLIENT_VALIDATE) ?>;

// Dynamic selection lists
// Form object for search

var fvwroutependinglistsrch = currentSearchForm = new ew.Form("fvwroutependinglistsrch");

// Filters
fvwroutependinglistsrch.filterList = <?php echo $vwroutepending_list->getFilterList() ?>;
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
<?php if (!$vwroutepending->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($vwroutepending_list->TotalRecs > 0 && $vwroutepending_list->ExportOptions->visible()) { ?>
<?php $vwroutepending_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($vwroutepending_list->ImportOptions->visible()) { ?>
<?php $vwroutepending_list->ImportOptions->render("body") ?>
<?php } ?>
<?php if ($vwroutepending_list->SearchOptions->visible()) { ?>
<?php $vwroutepending_list->SearchOptions->render("body") ?>
<?php } ?>
<?php if ($vwroutepending_list->FilterOptions->visible()) { ?>
<?php $vwroutepending_list->FilterOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php
$vwroutepending_list->renderOtherOptions();
?>
<?php if ($Security->CanSearch()) { ?>
<?php if (!$vwroutepending->isExport() && !$vwroutepending->CurrentAction) { ?>
<form name="fvwroutependinglistsrch" id="fvwroutependinglistsrch" class="form-inline ew-form ew-ext-search-form" action="<?php echo CurrentPageName() ?>">
<?php $searchPanelClass = ($vwroutepending_list->SearchWhere <> "") ? " show" : " show"; ?>
<div id="fvwroutependinglistsrch-search-panel" class="ew-search-panel collapse<?php echo $searchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="vwroutepending">
	<div class="ew-basic-search">
<div id="xsr_1" class="ew-row d-sm-flex">
	<div class="ew-quick-search input-group">
		<input type="text" name="<?php echo TABLE_BASIC_SEARCH ?>" id="<?php echo TABLE_BASIC_SEARCH ?>" class="form-control" value="<?php echo HtmlEncode($vwroutepending_list->BasicSearch->getKeyword()) ?>" placeholder="<?php echo HtmlEncode($Language->phrase("Search")) ?>">
		<input type="hidden" name="<?php echo TABLE_BASIC_SEARCH_TYPE ?>" id="<?php echo TABLE_BASIC_SEARCH_TYPE ?>" value="<?php echo HtmlEncode($vwroutepending_list->BasicSearch->getType()) ?>">
		<div class="input-group-append">
			<button class="btn btn-primary" name="btn-submit" id="btn-submit" type="submit"><?php echo $Language->phrase("SearchBtn") ?></button>
			<button type="button" data-toggle="dropdown" class="btn btn-primary dropdown-toggle dropdown-toggle-split" aria-haspopup="true" aria-expanded="false"><span id="searchtype"><?php echo $vwroutepending_list->BasicSearch->getTypeNameShort() ?></span></button>
			<div class="dropdown-menu dropdown-menu-right">
				<a class="dropdown-item<?php if ($vwroutepending_list->BasicSearch->getType() == "") echo " active"; ?>" href="javascript:void(0);" onclick="ew.setSearchType(this)"><?php echo $Language->phrase("QuickSearchAuto") ?></a>
				<a class="dropdown-item<?php if ($vwroutepending_list->BasicSearch->getType() == "=") echo " active"; ?>" href="javascript:void(0);" onclick="ew.setSearchType(this,'=')"><?php echo $Language->phrase("QuickSearchExact") ?></a>
				<a class="dropdown-item<?php if ($vwroutepending_list->BasicSearch->getType() == "AND") echo " active"; ?>" href="javascript:void(0);" onclick="ew.setSearchType(this,'AND')"><?php echo $Language->phrase("QuickSearchAll") ?></a>
				<a class="dropdown-item<?php if ($vwroutepending_list->BasicSearch->getType() == "OR") echo " active"; ?>" href="javascript:void(0);" onclick="ew.setSearchType(this,'OR')"><?php echo $Language->phrase("QuickSearchAny") ?></a>
			</div>
		</div>
	</div>
</div>
	</div>
</div>
</form>
<?php } ?>
<?php } ?>
<?php $vwroutepending_list->showPageHeader(); ?>
<?php
$vwroutepending_list->showMessage();
?>
<?php if ($vwroutepending_list->TotalRecs > 0 || $vwroutepending->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($vwroutepending_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> vwroutepending">
<?php if (!$vwroutepending->isExport()) { ?>
<div class="card-header ew-grid-upper-panel">
<?php if (!$vwroutepending->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php if (!isset($vwroutepending_list->Pager)) $vwroutepending_list->Pager = new PrevNextPager($vwroutepending_list->StartRec, $vwroutepending_list->DisplayRecs, $vwroutepending_list->TotalRecs, $vwroutepending_list->AutoHidePager) ?>
<?php if ($vwroutepending_list->Pager->RecordCount > 0 && $vwroutepending_list->Pager->Visible) { ?>
<div class="ew-pager">
<span><?php echo $Language->Phrase("Page") ?>&nbsp;</span>
<div class="ew-prev-next"><div class="input-group input-group-sm">
<div class="input-group-prepend">
<!-- first page button -->
	<?php if ($vwroutepending_list->Pager->FirstButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerFirst") ?>" href="<?php echo $vwroutepending_list->pageUrl() ?>start=<?php echo $vwroutepending_list->Pager->FirstButton->Start ?>"><i class="icon-first ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerFirst") ?>"><i class="icon-first ew-icon"></i></a>
	<?php } ?>
<!-- previous page button -->
	<?php if ($vwroutepending_list->Pager->PrevButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerPrevious") ?>" href="<?php echo $vwroutepending_list->pageUrl() ?>start=<?php echo $vwroutepending_list->Pager->PrevButton->Start ?>"><i class="icon-prev ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerPrevious") ?>"><i class="icon-prev ew-icon"></i></a>
	<?php } ?>
</div>
<!-- current page number -->
	<input class="form-control" type="text" name="<?php echo TABLE_PAGE_NO ?>" value="<?php echo $vwroutepending_list->Pager->CurrentPage ?>">
<div class="input-group-append">
<!-- next page button -->
	<?php if ($vwroutepending_list->Pager->NextButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerNext") ?>" href="<?php echo $vwroutepending_list->pageUrl() ?>start=<?php echo $vwroutepending_list->Pager->NextButton->Start ?>"><i class="icon-next ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerNext") ?>"><i class="icon-next ew-icon"></i></a>
	<?php } ?>
<!-- last page button -->
	<?php if ($vwroutepending_list->Pager->LastButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerLast") ?>" href="<?php echo $vwroutepending_list->pageUrl() ?>start=<?php echo $vwroutepending_list->Pager->LastButton->Start ?>"><i class="icon-last ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerLast") ?>"><i class="icon-last ew-icon"></i></a>
	<?php } ?>
</div>
</div>
</div>
<span>&nbsp;<?php echo $Language->Phrase("of") ?>&nbsp;<?php echo $vwroutepending_list->Pager->PageCount ?></span>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php if ($vwroutepending_list->Pager->RecordCount > 0) { ?>
<div class="ew-pager ew-rec">
	<span><?php echo $Language->Phrase("Record") ?>&nbsp;<?php echo $vwroutepending_list->Pager->FromIndex ?>&nbsp;<?php echo $Language->Phrase("To") ?>&nbsp;<?php echo $vwroutepending_list->Pager->ToIndex ?>&nbsp;<?php echo $Language->Phrase("Of") ?>&nbsp;<?php echo $vwroutepending_list->Pager->RecordCount ?></span>
</div>
<?php } ?>
<?php if ($vwroutepending_list->TotalRecs > 0 && (!$vwroutepending_list->AutoHidePageSizeSelector || $vwroutepending_list->Pager->Visible)) { ?>
<div class="ew-pager">
<input type="hidden" name="t" value="vwroutepending">
<select name="<?php echo TABLE_REC_PER_PAGE ?>" class="form-control form-control-sm ew-tooltip" title="<?php echo $Language->phrase("RecordsPerPage") ?>" onchange="this.form.submit();">
<option value="20"<?php if ($vwroutepending_list->DisplayRecs == 20) { ?> selected<?php } ?>>20</option>
<option value="50"<?php if ($vwroutepending_list->DisplayRecs == 50) { ?> selected<?php } ?>>50</option>
<option value="100"<?php if ($vwroutepending_list->DisplayRecs == 100) { ?> selected<?php } ?>>100</option>
<option value="200"<?php if ($vwroutepending_list->DisplayRecs == 200) { ?> selected<?php } ?>>200</option>
<option value="500"<?php if ($vwroutepending_list->DisplayRecs == 500) { ?> selected<?php } ?>>500</option>
<option value="ALL"<?php if ($vwroutepending->getRecordsPerPage() == -1) { ?> selected<?php } ?>><?php echo $Language->Phrase("AllRecords") ?></option>
</select>
</div>
<?php } ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $vwroutepending_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
<form name="fvwroutependinglist" id="fvwroutependinglist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($vwroutepending_list->CheckToken) { ?>
<input type="hidden" name="<?php echo TOKEN_NAME ?>" value="<?php echo $vwroutepending_list->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="vwroutepending">
<input type="hidden" name="exporttype" id="exporttype" value="">
<div id="gmp_vwroutepending" class="<?php if (IsResponsiveLayout()) { ?>table-responsive <?php } ?>card-body ew-grid-middle-panel">
<?php if ($vwroutepending_list->TotalRecs > 0 || $vwroutepending->isGridEdit()) { ?>
<table id="tbl_vwroutependinglist" class="table ew-table"><!-- .ew-table ##-->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$vwroutepending_list->RowType = ROWTYPE_HEADER;

// Render list options
$vwroutepending_list->renderListOptions();

// Render list options (header, left)
$vwroutepending_list->ListOptions->render("header", "left");
?>
<?php if ($vwroutepending->Code->Visible) { // Code ?>
	<?php if ($vwroutepending->sortUrl($vwroutepending->Code) == "") { ?>
		<th data-name="Code" class="<?php echo $vwroutepending->Code->headerCellClass() ?>"><div id="elh_vwroutepending_Code" class="vwroutepending_Code"><div class="ew-table-header-caption"><?php echo $vwroutepending->Code->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Code" class="<?php echo $vwroutepending->Code->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $vwroutepending->SortUrl($vwroutepending->Code) ?>',2);"><div id="elh_vwroutepending_Code" class="vwroutepending_Code">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $vwroutepending->Code->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($vwroutepending->Code->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($vwroutepending->Code->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($vwroutepending->PCS->Visible) { // PCS ?>
	<?php if ($vwroutepending->sortUrl($vwroutepending->PCS) == "") { ?>
		<th data-name="PCS" class="<?php echo $vwroutepending->PCS->headerCellClass() ?>"><div id="elh_vwroutepending_PCS" class="vwroutepending_PCS"><div class="ew-table-header-caption"><?php echo $vwroutepending->PCS->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="PCS" class="<?php echo $vwroutepending->PCS->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $vwroutepending->SortUrl($vwroutepending->PCS) ?>',2);"><div id="elh_vwroutepending_PCS" class="vwroutepending_PCS">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $vwroutepending->PCS->caption() ?></span><span class="ew-table-header-sort"><?php if ($vwroutepending->PCS->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($vwroutepending->PCS->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($vwroutepending->TruckNo->Visible) { // TruckNo ?>
	<?php if ($vwroutepending->sortUrl($vwroutepending->TruckNo) == "") { ?>
		<th data-name="TruckNo" class="<?php echo $vwroutepending->TruckNo->headerCellClass() ?>"><div id="elh_vwroutepending_TruckNo" class="vwroutepending_TruckNo"><div class="ew-table-header-caption"><?php echo $vwroutepending->TruckNo->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="TruckNo" class="<?php echo $vwroutepending->TruckNo->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $vwroutepending->SortUrl($vwroutepending->TruckNo) ?>',2);"><div id="elh_vwroutepending_TruckNo" class="vwroutepending_TruckNo">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $vwroutepending->TruckNo->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($vwroutepending->TruckNo->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($vwroutepending->TruckNo->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($vwroutepending->ID_Route->Visible) { // ID_Route ?>
	<?php if ($vwroutepending->sortUrl($vwroutepending->ID_Route) == "") { ?>
		<th data-name="ID_Route" class="<?php echo $vwroutepending->ID_Route->headerCellClass() ?>"><div id="elh_vwroutepending_ID_Route" class="vwroutepending_ID_Route"><div class="ew-table-header-caption"><?php echo $vwroutepending->ID_Route->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="ID_Route" class="<?php echo $vwroutepending->ID_Route->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $vwroutepending->SortUrl($vwroutepending->ID_Route) ?>',2);"><div id="elh_vwroutepending_ID_Route" class="vwroutepending_ID_Route">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $vwroutepending->ID_Route->caption() ?></span><span class="ew-table-header-sort"><?php if ($vwroutepending->ID_Route->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($vwroutepending->ID_Route->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($vwroutepending->RouteName->Visible) { // RouteName ?>
	<?php if ($vwroutepending->sortUrl($vwroutepending->RouteName) == "") { ?>
		<th data-name="RouteName" class="<?php echo $vwroutepending->RouteName->headerCellClass() ?>"><div id="elh_vwroutepending_RouteName" class="vwroutepending_RouteName"><div class="ew-table-header-caption"><?php echo $vwroutepending->RouteName->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="RouteName" class="<?php echo $vwroutepending->RouteName->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $vwroutepending->SortUrl($vwroutepending->RouteName) ?>',2);"><div id="elh_vwroutepending_RouteName" class="vwroutepending_RouteName">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $vwroutepending->RouteName->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($vwroutepending->RouteName->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($vwroutepending->RouteName->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$vwroutepending_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
if ($vwroutepending->ExportAll && $vwroutepending->isExport()) {
	$vwroutepending_list->StopRec = $vwroutepending_list->TotalRecs;
} else {

	// Set the last record to display
	if ($vwroutepending_list->TotalRecs > $vwroutepending_list->StartRec + $vwroutepending_list->DisplayRecs - 1)
		$vwroutepending_list->StopRec = $vwroutepending_list->StartRec + $vwroutepending_list->DisplayRecs - 1;
	else
		$vwroutepending_list->StopRec = $vwroutepending_list->TotalRecs;
}
$vwroutepending_list->RecCnt = $vwroutepending_list->StartRec - 1;
if ($vwroutepending_list->Recordset && !$vwroutepending_list->Recordset->EOF) {
	$vwroutepending_list->Recordset->moveFirst();
	$selectLimit = $vwroutepending_list->UseSelectLimit;
	if (!$selectLimit && $vwroutepending_list->StartRec > 1)
		$vwroutepending_list->Recordset->move($vwroutepending_list->StartRec - 1);
} elseif (!$vwroutepending->AllowAddDeleteRow && $vwroutepending_list->StopRec == 0) {
	$vwroutepending_list->StopRec = $vwroutepending->GridAddRowCount;
}

// Initialize aggregate
$vwroutepending->RowType = ROWTYPE_AGGREGATEINIT;
$vwroutepending->resetAttributes();
$vwroutepending_list->renderRow();
while ($vwroutepending_list->RecCnt < $vwroutepending_list->StopRec) {
	$vwroutepending_list->RecCnt++;
	if ($vwroutepending_list->RecCnt >= $vwroutepending_list->StartRec) {
		$vwroutepending_list->RowCnt++;

		// Set up key count
		$vwroutepending_list->KeyCount = $vwroutepending_list->RowIndex;

		// Init row class and style
		$vwroutepending->resetAttributes();
		$vwroutepending->CssClass = "";
		if ($vwroutepending->isGridAdd()) {
		} else {
			$vwroutepending_list->loadRowValues($vwroutepending_list->Recordset); // Load row values
		}
		$vwroutepending->RowType = ROWTYPE_VIEW; // Render view

		// Set up row id / data-rowindex
		$vwroutepending->RowAttrs = array_merge($vwroutepending->RowAttrs, array('data-rowindex'=>$vwroutepending_list->RowCnt, 'id'=>'r' . $vwroutepending_list->RowCnt . '_vwroutepending', 'data-rowtype'=>$vwroutepending->RowType));

		// Render row
		$vwroutepending_list->renderRow();

		// Render list options
		$vwroutepending_list->renderListOptions();
?>
	<tr<?php echo $vwroutepending->rowAttributes() ?>>
<?php

// Render list options (body, left)
$vwroutepending_list->ListOptions->render("body", "left", $vwroutepending_list->RowCnt);
?>
	<?php if ($vwroutepending->Code->Visible) { // Code ?>
		<td data-name="Code"<?php echo $vwroutepending->Code->cellAttributes() ?>>
<span id="el<?php echo $vwroutepending_list->RowCnt ?>_vwroutepending_Code" class="vwroutepending_Code">
<span<?php echo $vwroutepending->Code->viewAttributes() ?>>
<?php echo $vwroutepending->Code->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($vwroutepending->PCS->Visible) { // PCS ?>
		<td data-name="PCS"<?php echo $vwroutepending->PCS->cellAttributes() ?>>
<span id="el<?php echo $vwroutepending_list->RowCnt ?>_vwroutepending_PCS" class="vwroutepending_PCS">
<span<?php echo $vwroutepending->PCS->viewAttributes() ?>>
<?php echo $vwroutepending->PCS->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($vwroutepending->TruckNo->Visible) { // TruckNo ?>
		<td data-name="TruckNo"<?php echo $vwroutepending->TruckNo->cellAttributes() ?>>
<span id="el<?php echo $vwroutepending_list->RowCnt ?>_vwroutepending_TruckNo" class="vwroutepending_TruckNo">
<span<?php echo $vwroutepending->TruckNo->viewAttributes() ?>>
<?php echo $vwroutepending->TruckNo->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($vwroutepending->ID_Route->Visible) { // ID_Route ?>
		<td data-name="ID_Route"<?php echo $vwroutepending->ID_Route->cellAttributes() ?>>
<span id="el<?php echo $vwroutepending_list->RowCnt ?>_vwroutepending_ID_Route" class="vwroutepending_ID_Route">
<span<?php echo $vwroutepending->ID_Route->viewAttributes() ?>>
<?php echo $vwroutepending->ID_Route->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($vwroutepending->RouteName->Visible) { // RouteName ?>
		<td data-name="RouteName"<?php echo $vwroutepending->RouteName->cellAttributes() ?>>
<span id="el<?php echo $vwroutepending_list->RowCnt ?>_vwroutepending_RouteName" class="vwroutepending_RouteName">
<span<?php echo $vwroutepending->RouteName->viewAttributes() ?>>
<?php echo $vwroutepending->RouteName->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$vwroutepending_list->ListOptions->render("body", "right", $vwroutepending_list->RowCnt);
?>
	</tr>
<?php
	}
	if (!$vwroutepending->isGridAdd())
		$vwroutepending_list->Recordset->moveNext();
}
?>
</tbody>
</table><!-- /.ew-table -->
<?php } ?>
<?php if (!$vwroutepending->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</div><!-- /.ew-grid-middle-panel -->
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($vwroutepending_list->Recordset)
	$vwroutepending_list->Recordset->Close();
?>
<?php if (!$vwroutepending->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$vwroutepending->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php if (!isset($vwroutepending_list->Pager)) $vwroutepending_list->Pager = new PrevNextPager($vwroutepending_list->StartRec, $vwroutepending_list->DisplayRecs, $vwroutepending_list->TotalRecs, $vwroutepending_list->AutoHidePager) ?>
<?php if ($vwroutepending_list->Pager->RecordCount > 0 && $vwroutepending_list->Pager->Visible) { ?>
<div class="ew-pager">
<span><?php echo $Language->Phrase("Page") ?>&nbsp;</span>
<div class="ew-prev-next"><div class="input-group input-group-sm">
<div class="input-group-prepend">
<!-- first page button -->
	<?php if ($vwroutepending_list->Pager->FirstButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerFirst") ?>" href="<?php echo $vwroutepending_list->pageUrl() ?>start=<?php echo $vwroutepending_list->Pager->FirstButton->Start ?>"><i class="icon-first ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerFirst") ?>"><i class="icon-first ew-icon"></i></a>
	<?php } ?>
<!-- previous page button -->
	<?php if ($vwroutepending_list->Pager->PrevButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerPrevious") ?>" href="<?php echo $vwroutepending_list->pageUrl() ?>start=<?php echo $vwroutepending_list->Pager->PrevButton->Start ?>"><i class="icon-prev ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerPrevious") ?>"><i class="icon-prev ew-icon"></i></a>
	<?php } ?>
</div>
<!-- current page number -->
	<input class="form-control" type="text" name="<?php echo TABLE_PAGE_NO ?>" value="<?php echo $vwroutepending_list->Pager->CurrentPage ?>">
<div class="input-group-append">
<!-- next page button -->
	<?php if ($vwroutepending_list->Pager->NextButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerNext") ?>" href="<?php echo $vwroutepending_list->pageUrl() ?>start=<?php echo $vwroutepending_list->Pager->NextButton->Start ?>"><i class="icon-next ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerNext") ?>"><i class="icon-next ew-icon"></i></a>
	<?php } ?>
<!-- last page button -->
	<?php if ($vwroutepending_list->Pager->LastButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerLast") ?>" href="<?php echo $vwroutepending_list->pageUrl() ?>start=<?php echo $vwroutepending_list->Pager->LastButton->Start ?>"><i class="icon-last ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerLast") ?>"><i class="icon-last ew-icon"></i></a>
	<?php } ?>
</div>
</div>
</div>
<span>&nbsp;<?php echo $Language->Phrase("of") ?>&nbsp;<?php echo $vwroutepending_list->Pager->PageCount ?></span>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php if ($vwroutepending_list->Pager->RecordCount > 0) { ?>
<div class="ew-pager ew-rec">
	<span><?php echo $Language->Phrase("Record") ?>&nbsp;<?php echo $vwroutepending_list->Pager->FromIndex ?>&nbsp;<?php echo $Language->Phrase("To") ?>&nbsp;<?php echo $vwroutepending_list->Pager->ToIndex ?>&nbsp;<?php echo $Language->Phrase("Of") ?>&nbsp;<?php echo $vwroutepending_list->Pager->RecordCount ?></span>
</div>
<?php } ?>
<?php if ($vwroutepending_list->TotalRecs > 0 && (!$vwroutepending_list->AutoHidePageSizeSelector || $vwroutepending_list->Pager->Visible)) { ?>
<div class="ew-pager">
<input type="hidden" name="t" value="vwroutepending">
<select name="<?php echo TABLE_REC_PER_PAGE ?>" class="form-control form-control-sm ew-tooltip" title="<?php echo $Language->phrase("RecordsPerPage") ?>" onchange="this.form.submit();">
<option value="20"<?php if ($vwroutepending_list->DisplayRecs == 20) { ?> selected<?php } ?>>20</option>
<option value="50"<?php if ($vwroutepending_list->DisplayRecs == 50) { ?> selected<?php } ?>>50</option>
<option value="100"<?php if ($vwroutepending_list->DisplayRecs == 100) { ?> selected<?php } ?>>100</option>
<option value="200"<?php if ($vwroutepending_list->DisplayRecs == 200) { ?> selected<?php } ?>>200</option>
<option value="500"<?php if ($vwroutepending_list->DisplayRecs == 500) { ?> selected<?php } ?>>500</option>
<option value="ALL"<?php if ($vwroutepending->getRecordsPerPage() == -1) { ?> selected<?php } ?>><?php echo $Language->Phrase("AllRecords") ?></option>
</select>
</div>
<?php } ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $vwroutepending_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($vwroutepending_list->TotalRecs == 0 && !$vwroutepending->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $vwroutepending_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$vwroutepending_list->showPageFooter();
if (DEBUG_ENABLED)
	echo GetDebugMessage();
?>
<?php if (!$vwroutepending->isExport()) { ?>
<script>

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php } ?>
<?php include_once "footer.php" ?>
<?php
$vwroutepending_list->terminate();
?>