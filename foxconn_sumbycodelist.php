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
$foxconn_sumbycode_list = new foxconn_sumbycode_list();

// Run the page
$foxconn_sumbycode_list->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$foxconn_sumbycode_list->Page_Render();
?>
<?php include_once "header.php" ?>
<?php if (!$foxconn_sumbycode->isExport()) { ?>
<script>

// Form object
currentPageID = ew.PAGE_ID = "list";
var ffoxconn_sumbycodelist = currentForm = new ew.Form("ffoxconn_sumbycodelist", "list");
ffoxconn_sumbycodelist.formKeyCountName = '<?php echo $foxconn_sumbycode_list->FormKeyCountName ?>';

// Form_CustomValidate event
ffoxconn_sumbycodelist.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

	// Your custom validation code here, return false if invalid.
	return true;
}

// Use JavaScript validation or not
ffoxconn_sumbycodelist.validateRequired = <?php echo json_encode(CLIENT_VALIDATE) ?>;

// Dynamic selection lists
ffoxconn_sumbycodelist.lists["x_Pallet"] = <?php echo $foxconn_sumbycode_list->Pallet->Lookup->toClientList() ?>;
ffoxconn_sumbycodelist.lists["x_Pallet"].options = <?php echo JsonEncode($foxconn_sumbycode_list->Pallet->options(FALSE, TRUE)) ?>;

// Form object for search
var ffoxconn_sumbycodelistsrch = currentSearchForm = new ew.Form("ffoxconn_sumbycodelistsrch");

// Filters
ffoxconn_sumbycodelistsrch.filterList = <?php echo $foxconn_sumbycode_list->getFilterList() ?>;
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
<?php if (!$foxconn_sumbycode->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($foxconn_sumbycode_list->TotalRecs > 0 && $foxconn_sumbycode_list->ExportOptions->visible()) { ?>
<?php $foxconn_sumbycode_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($foxconn_sumbycode_list->ImportOptions->visible()) { ?>
<?php $foxconn_sumbycode_list->ImportOptions->render("body") ?>
<?php } ?>
<?php if ($foxconn_sumbycode_list->SearchOptions->visible()) { ?>
<?php $foxconn_sumbycode_list->SearchOptions->render("body") ?>
<?php } ?>
<?php if ($foxconn_sumbycode_list->FilterOptions->visible()) { ?>
<?php $foxconn_sumbycode_list->FilterOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php
$foxconn_sumbycode_list->renderOtherOptions();
?>
<?php if ($Security->CanSearch()) { ?>
<?php if (!$foxconn_sumbycode->isExport() && !$foxconn_sumbycode->CurrentAction) { ?>
<form name="ffoxconn_sumbycodelistsrch" id="ffoxconn_sumbycodelistsrch" class="form-inline ew-form ew-ext-search-form" action="<?php echo CurrentPageName() ?>">
<?php $searchPanelClass = ($foxconn_sumbycode_list->SearchWhere <> "") ? " show" : " show"; ?>
<div id="ffoxconn_sumbycodelistsrch-search-panel" class="ew-search-panel collapse<?php echo $searchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="foxconn_sumbycode">
	<div class="ew-basic-search">
<div id="xsr_1" class="ew-row d-sm-flex">
	<div class="ew-quick-search input-group">
		<input type="text" name="<?php echo TABLE_BASIC_SEARCH ?>" id="<?php echo TABLE_BASIC_SEARCH ?>" class="form-control" value="<?php echo HtmlEncode($foxconn_sumbycode_list->BasicSearch->getKeyword()) ?>" placeholder="<?php echo HtmlEncode($Language->phrase("Search")) ?>">
		<input type="hidden" name="<?php echo TABLE_BASIC_SEARCH_TYPE ?>" id="<?php echo TABLE_BASIC_SEARCH_TYPE ?>" value="<?php echo HtmlEncode($foxconn_sumbycode_list->BasicSearch->getType()) ?>">
		<div class="input-group-append">
			<button class="btn btn-primary" name="btn-submit" id="btn-submit" type="submit"><?php echo $Language->phrase("SearchBtn") ?></button>
			<button type="button" data-toggle="dropdown" class="btn btn-primary dropdown-toggle dropdown-toggle-split" aria-haspopup="true" aria-expanded="false"><span id="searchtype"><?php echo $foxconn_sumbycode_list->BasicSearch->getTypeNameShort() ?></span></button>
			<div class="dropdown-menu dropdown-menu-right">
				<a class="dropdown-item<?php if ($foxconn_sumbycode_list->BasicSearch->getType() == "") echo " active"; ?>" href="javascript:void(0);" onclick="ew.setSearchType(this)"><?php echo $Language->phrase("QuickSearchAuto") ?></a>
				<a class="dropdown-item<?php if ($foxconn_sumbycode_list->BasicSearch->getType() == "=") echo " active"; ?>" href="javascript:void(0);" onclick="ew.setSearchType(this,'=')"><?php echo $Language->phrase("QuickSearchExact") ?></a>
				<a class="dropdown-item<?php if ($foxconn_sumbycode_list->BasicSearch->getType() == "AND") echo " active"; ?>" href="javascript:void(0);" onclick="ew.setSearchType(this,'AND')"><?php echo $Language->phrase("QuickSearchAll") ?></a>
				<a class="dropdown-item<?php if ($foxconn_sumbycode_list->BasicSearch->getType() == "OR") echo " active"; ?>" href="javascript:void(0);" onclick="ew.setSearchType(this,'OR')"><?php echo $Language->phrase("QuickSearchAny") ?></a>
			</div>
		</div>
	</div>
</div>
	</div>
</div>
</form>
<?php } ?>
<?php } ?>
<?php $foxconn_sumbycode_list->showPageHeader(); ?>
<?php
$foxconn_sumbycode_list->showMessage();
?>
<?php if ($foxconn_sumbycode_list->TotalRecs > 0 || $foxconn_sumbycode->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($foxconn_sumbycode_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> foxconn_sumbycode">
<?php if (!$foxconn_sumbycode->isExport()) { ?>
<div class="card-header ew-grid-upper-panel">
<?php if (!$foxconn_sumbycode->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php if (!isset($foxconn_sumbycode_list->Pager)) $foxconn_sumbycode_list->Pager = new PrevNextPager($foxconn_sumbycode_list->StartRec, $foxconn_sumbycode_list->DisplayRecs, $foxconn_sumbycode_list->TotalRecs, $foxconn_sumbycode_list->AutoHidePager) ?>
<?php if ($foxconn_sumbycode_list->Pager->RecordCount > 0 && $foxconn_sumbycode_list->Pager->Visible) { ?>
<div class="ew-pager">
<span><?php echo $Language->Phrase("Page") ?>&nbsp;</span>
<div class="ew-prev-next"><div class="input-group input-group-sm">
<div class="input-group-prepend">
<!-- first page button -->
	<?php if ($foxconn_sumbycode_list->Pager->FirstButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerFirst") ?>" href="<?php echo $foxconn_sumbycode_list->pageUrl() ?>start=<?php echo $foxconn_sumbycode_list->Pager->FirstButton->Start ?>"><i class="icon-first ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerFirst") ?>"><i class="icon-first ew-icon"></i></a>
	<?php } ?>
<!-- previous page button -->
	<?php if ($foxconn_sumbycode_list->Pager->PrevButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerPrevious") ?>" href="<?php echo $foxconn_sumbycode_list->pageUrl() ?>start=<?php echo $foxconn_sumbycode_list->Pager->PrevButton->Start ?>"><i class="icon-prev ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerPrevious") ?>"><i class="icon-prev ew-icon"></i></a>
	<?php } ?>
</div>
<!-- current page number -->
	<input class="form-control" type="text" name="<?php echo TABLE_PAGE_NO ?>" value="<?php echo $foxconn_sumbycode_list->Pager->CurrentPage ?>">
<div class="input-group-append">
<!-- next page button -->
	<?php if ($foxconn_sumbycode_list->Pager->NextButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerNext") ?>" href="<?php echo $foxconn_sumbycode_list->pageUrl() ?>start=<?php echo $foxconn_sumbycode_list->Pager->NextButton->Start ?>"><i class="icon-next ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerNext") ?>"><i class="icon-next ew-icon"></i></a>
	<?php } ?>
<!-- last page button -->
	<?php if ($foxconn_sumbycode_list->Pager->LastButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerLast") ?>" href="<?php echo $foxconn_sumbycode_list->pageUrl() ?>start=<?php echo $foxconn_sumbycode_list->Pager->LastButton->Start ?>"><i class="icon-last ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerLast") ?>"><i class="icon-last ew-icon"></i></a>
	<?php } ?>
</div>
</div>
</div>
<span>&nbsp;<?php echo $Language->Phrase("of") ?>&nbsp;<?php echo $foxconn_sumbycode_list->Pager->PageCount ?></span>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php if ($foxconn_sumbycode_list->Pager->RecordCount > 0) { ?>
<div class="ew-pager ew-rec">
	<span><?php echo $Language->Phrase("Record") ?>&nbsp;<?php echo $foxconn_sumbycode_list->Pager->FromIndex ?>&nbsp;<?php echo $Language->Phrase("To") ?>&nbsp;<?php echo $foxconn_sumbycode_list->Pager->ToIndex ?>&nbsp;<?php echo $Language->Phrase("Of") ?>&nbsp;<?php echo $foxconn_sumbycode_list->Pager->RecordCount ?></span>
</div>
<?php } ?>
<?php if ($foxconn_sumbycode_list->TotalRecs > 0 && (!$foxconn_sumbycode_list->AutoHidePageSizeSelector || $foxconn_sumbycode_list->Pager->Visible)) { ?>
<div class="ew-pager">
<input type="hidden" name="t" value="foxconn_sumbycode">
<select name="<?php echo TABLE_REC_PER_PAGE ?>" class="form-control form-control-sm ew-tooltip" title="<?php echo $Language->phrase("RecordsPerPage") ?>" onchange="this.form.submit();">
<option value="20"<?php if ($foxconn_sumbycode_list->DisplayRecs == 20) { ?> selected<?php } ?>>20</option>
<option value="50"<?php if ($foxconn_sumbycode_list->DisplayRecs == 50) { ?> selected<?php } ?>>50</option>
<option value="100"<?php if ($foxconn_sumbycode_list->DisplayRecs == 100) { ?> selected<?php } ?>>100</option>
<option value="200"<?php if ($foxconn_sumbycode_list->DisplayRecs == 200) { ?> selected<?php } ?>>200</option>
<option value="500"<?php if ($foxconn_sumbycode_list->DisplayRecs == 500) { ?> selected<?php } ?>>500</option>
<option value="ALL"<?php if ($foxconn_sumbycode->getRecordsPerPage() == -1) { ?> selected<?php } ?>><?php echo $Language->Phrase("AllRecords") ?></option>
</select>
</div>
<?php } ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $foxconn_sumbycode_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
<form name="ffoxconn_sumbycodelist" id="ffoxconn_sumbycodelist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($foxconn_sumbycode_list->CheckToken) { ?>
<input type="hidden" name="<?php echo TOKEN_NAME ?>" value="<?php echo $foxconn_sumbycode_list->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="foxconn_sumbycode">
<div id="gmp_foxconn_sumbycode" class="<?php if (IsResponsiveLayout()) { ?>table-responsive <?php } ?>card-body ew-grid-middle-panel">
<?php if ($foxconn_sumbycode_list->TotalRecs > 0 || $foxconn_sumbycode->isGridEdit()) { ?>
<table id="tbl_foxconn_sumbycodelist" class="table ew-table"><!-- .ew-table ##-->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$foxconn_sumbycode_list->RowType = ROWTYPE_HEADER;

// Render list options
$foxconn_sumbycode_list->renderListOptions();

// Render list options (header, left)
$foxconn_sumbycode_list->ListOptions->render("header", "left");
?>
<?php if ($foxconn_sumbycode->Code->Visible) { // Code ?>
	<?php if ($foxconn_sumbycode->sortUrl($foxconn_sumbycode->Code) == "") { ?>
		<th data-name="Code" class="<?php echo $foxconn_sumbycode->Code->headerCellClass() ?>" style="white-space: nowrap;"><div id="elh_foxconn_sumbycode_Code" class="foxconn_sumbycode_Code"><div class="ew-table-header-caption"><?php echo $foxconn_sumbycode->Code->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Code" class="<?php echo $foxconn_sumbycode->Code->headerCellClass() ?>" style="white-space: nowrap;"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $foxconn_sumbycode->SortUrl($foxconn_sumbycode->Code) ?>',2);"><div id="elh_foxconn_sumbycode_Code" class="foxconn_sumbycode_Code">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $foxconn_sumbycode->Code->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($foxconn_sumbycode->Code->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($foxconn_sumbycode->Code->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($foxconn_sumbycode->ProductName->Visible) { // ProductName ?>
	<?php if ($foxconn_sumbycode->sortUrl($foxconn_sumbycode->ProductName) == "") { ?>
		<th data-name="ProductName" class="<?php echo $foxconn_sumbycode->ProductName->headerCellClass() ?>" style="white-space: nowrap;"><div id="elh_foxconn_sumbycode_ProductName" class="foxconn_sumbycode_ProductName"><div class="ew-table-header-caption"><?php echo $foxconn_sumbycode->ProductName->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="ProductName" class="<?php echo $foxconn_sumbycode->ProductName->headerCellClass() ?>" style="white-space: nowrap;"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $foxconn_sumbycode->SortUrl($foxconn_sumbycode->ProductName) ?>',2);"><div id="elh_foxconn_sumbycode_ProductName" class="foxconn_sumbycode_ProductName">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $foxconn_sumbycode->ProductName->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($foxconn_sumbycode->ProductName->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($foxconn_sumbycode->ProductName->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($foxconn_sumbycode->Model->Visible) { // Model ?>
	<?php if ($foxconn_sumbycode->sortUrl($foxconn_sumbycode->Model) == "") { ?>
		<th data-name="Model" class="<?php echo $foxconn_sumbycode->Model->headerCellClass() ?>" style="white-space: nowrap;"><div id="elh_foxconn_sumbycode_Model" class="foxconn_sumbycode_Model"><div class="ew-table-header-caption"><?php echo $foxconn_sumbycode->Model->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Model" class="<?php echo $foxconn_sumbycode->Model->headerCellClass() ?>" style="white-space: nowrap;"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $foxconn_sumbycode->SortUrl($foxconn_sumbycode->Model) ?>',2);"><div id="elh_foxconn_sumbycode_Model" class="foxconn_sumbycode_Model">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $foxconn_sumbycode->Model->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($foxconn_sumbycode->Model->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($foxconn_sumbycode->Model->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($foxconn_sumbycode->SUM28ts_PCS29->Visible) { // SUM(ts.PCS) ?>
	<?php if ($foxconn_sumbycode->sortUrl($foxconn_sumbycode->SUM28ts_PCS29) == "") { ?>
		<th data-name="SUM28ts_PCS29" class="<?php echo $foxconn_sumbycode->SUM28ts_PCS29->headerCellClass() ?>" style="white-space: nowrap;"><div id="elh_foxconn_sumbycode_SUM28ts_PCS29" class="foxconn_sumbycode_SUM28ts_PCS29"><div class="ew-table-header-caption"><?php echo $foxconn_sumbycode->SUM28ts_PCS29->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="SUM28ts_PCS29" class="<?php echo $foxconn_sumbycode->SUM28ts_PCS29->headerCellClass() ?>" style="white-space: nowrap;"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $foxconn_sumbycode->SortUrl($foxconn_sumbycode->SUM28ts_PCS29) ?>',2);"><div id="elh_foxconn_sumbycode_SUM28ts_PCS29" class="foxconn_sumbycode_SUM28ts_PCS29">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $foxconn_sumbycode->SUM28ts_PCS29->caption() ?></span><span class="ew-table-header-sort"><?php if ($foxconn_sumbycode->SUM28ts_PCS29->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($foxconn_sumbycode->SUM28ts_PCS29->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($foxconn_sumbycode->Pallet->Visible) { // Pallet ?>
	<?php if ($foxconn_sumbycode->sortUrl($foxconn_sumbycode->Pallet) == "") { ?>
		<th data-name="Pallet" class="<?php echo $foxconn_sumbycode->Pallet->headerCellClass() ?>" style="white-space: nowrap;"><div id="elh_foxconn_sumbycode_Pallet" class="foxconn_sumbycode_Pallet"><div class="ew-table-header-caption"><?php echo $foxconn_sumbycode->Pallet->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Pallet" class="<?php echo $foxconn_sumbycode->Pallet->headerCellClass() ?>" style="white-space: nowrap;"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $foxconn_sumbycode->SortUrl($foxconn_sumbycode->Pallet) ?>',2);"><div id="elh_foxconn_sumbycode_Pallet" class="foxconn_sumbycode_Pallet">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $foxconn_sumbycode->Pallet->caption() ?></span><span class="ew-table-header-sort"><?php if ($foxconn_sumbycode->Pallet->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($foxconn_sumbycode->Pallet->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$foxconn_sumbycode_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
if ($foxconn_sumbycode->ExportAll && $foxconn_sumbycode->isExport()) {
	$foxconn_sumbycode_list->StopRec = $foxconn_sumbycode_list->TotalRecs;
} else {

	// Set the last record to display
	if ($foxconn_sumbycode_list->TotalRecs > $foxconn_sumbycode_list->StartRec + $foxconn_sumbycode_list->DisplayRecs - 1)
		$foxconn_sumbycode_list->StopRec = $foxconn_sumbycode_list->StartRec + $foxconn_sumbycode_list->DisplayRecs - 1;
	else
		$foxconn_sumbycode_list->StopRec = $foxconn_sumbycode_list->TotalRecs;
}
$foxconn_sumbycode_list->RecCnt = $foxconn_sumbycode_list->StartRec - 1;
if ($foxconn_sumbycode_list->Recordset && !$foxconn_sumbycode_list->Recordset->EOF) {
	$foxconn_sumbycode_list->Recordset->moveFirst();
	$selectLimit = $foxconn_sumbycode_list->UseSelectLimit;
	if (!$selectLimit && $foxconn_sumbycode_list->StartRec > 1)
		$foxconn_sumbycode_list->Recordset->move($foxconn_sumbycode_list->StartRec - 1);
} elseif (!$foxconn_sumbycode->AllowAddDeleteRow && $foxconn_sumbycode_list->StopRec == 0) {
	$foxconn_sumbycode_list->StopRec = $foxconn_sumbycode->GridAddRowCount;
}

// Initialize aggregate
$foxconn_sumbycode->RowType = ROWTYPE_AGGREGATEINIT;
$foxconn_sumbycode->resetAttributes();
$foxconn_sumbycode_list->renderRow();
while ($foxconn_sumbycode_list->RecCnt < $foxconn_sumbycode_list->StopRec) {
	$foxconn_sumbycode_list->RecCnt++;
	if ($foxconn_sumbycode_list->RecCnt >= $foxconn_sumbycode_list->StartRec) {
		$foxconn_sumbycode_list->RowCnt++;

		// Set up key count
		$foxconn_sumbycode_list->KeyCount = $foxconn_sumbycode_list->RowIndex;

		// Init row class and style
		$foxconn_sumbycode->resetAttributes();
		$foxconn_sumbycode->CssClass = "";
		if ($foxconn_sumbycode->isGridAdd()) {
		} else {
			$foxconn_sumbycode_list->loadRowValues($foxconn_sumbycode_list->Recordset); // Load row values
		}
		$foxconn_sumbycode->RowType = ROWTYPE_VIEW; // Render view

		// Set up row id / data-rowindex
		$foxconn_sumbycode->RowAttrs = array_merge($foxconn_sumbycode->RowAttrs, array('data-rowindex'=>$foxconn_sumbycode_list->RowCnt, 'id'=>'r' . $foxconn_sumbycode_list->RowCnt . '_foxconn_sumbycode', 'data-rowtype'=>$foxconn_sumbycode->RowType));

		// Render row
		$foxconn_sumbycode_list->renderRow();

		// Render list options
		$foxconn_sumbycode_list->renderListOptions();
?>
	<tr<?php echo $foxconn_sumbycode->rowAttributes() ?>>
<?php

// Render list options (body, left)
$foxconn_sumbycode_list->ListOptions->render("body", "left", $foxconn_sumbycode_list->RowCnt);
?>
	<?php if ($foxconn_sumbycode->Code->Visible) { // Code ?>
		<td data-name="Code"<?php echo $foxconn_sumbycode->Code->cellAttributes() ?>>
<span id="el<?php echo $foxconn_sumbycode_list->RowCnt ?>_foxconn_sumbycode_Code" class="foxconn_sumbycode_Code">
<span<?php echo $foxconn_sumbycode->Code->viewAttributes() ?>>
<?php echo $foxconn_sumbycode->Code->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($foxconn_sumbycode->ProductName->Visible) { // ProductName ?>
		<td data-name="ProductName"<?php echo $foxconn_sumbycode->ProductName->cellAttributes() ?>>
<span id="el<?php echo $foxconn_sumbycode_list->RowCnt ?>_foxconn_sumbycode_ProductName" class="foxconn_sumbycode_ProductName">
<span<?php echo $foxconn_sumbycode->ProductName->viewAttributes() ?>>
<?php echo $foxconn_sumbycode->ProductName->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($foxconn_sumbycode->Model->Visible) { // Model ?>
		<td data-name="Model"<?php echo $foxconn_sumbycode->Model->cellAttributes() ?>>
<span id="el<?php echo $foxconn_sumbycode_list->RowCnt ?>_foxconn_sumbycode_Model" class="foxconn_sumbycode_Model">
<span<?php echo $foxconn_sumbycode->Model->viewAttributes() ?>>
<?php echo $foxconn_sumbycode->Model->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($foxconn_sumbycode->SUM28ts_PCS29->Visible) { // SUM(ts.PCS) ?>
		<td data-name="SUM28ts_PCS29"<?php echo $foxconn_sumbycode->SUM28ts_PCS29->cellAttributes() ?>>
<span id="el<?php echo $foxconn_sumbycode_list->RowCnt ?>_foxconn_sumbycode_SUM28ts_PCS29" class="foxconn_sumbycode_SUM28ts_PCS29">
<span<?php echo $foxconn_sumbycode->SUM28ts_PCS29->viewAttributes() ?>>
<?php echo $foxconn_sumbycode->SUM28ts_PCS29->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($foxconn_sumbycode->Pallet->Visible) { // Pallet ?>
		<td data-name="Pallet"<?php echo $foxconn_sumbycode->Pallet->cellAttributes() ?>>
<span id="el<?php echo $foxconn_sumbycode_list->RowCnt ?>_foxconn_sumbycode_Pallet" class="foxconn_sumbycode_Pallet">
<span<?php echo $foxconn_sumbycode->Pallet->viewAttributes() ?>>
<?php echo $foxconn_sumbycode->Pallet->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$foxconn_sumbycode_list->ListOptions->render("body", "right", $foxconn_sumbycode_list->RowCnt);
?>
	</tr>
<?php
	}
	if (!$foxconn_sumbycode->isGridAdd())
		$foxconn_sumbycode_list->Recordset->moveNext();
}
?>
</tbody>
<?php

// Render aggregate row
$foxconn_sumbycode->RowType = ROWTYPE_AGGREGATE;
$foxconn_sumbycode->resetAttributes();
$foxconn_sumbycode_list->renderRow();
?>
<?php if ($foxconn_sumbycode_list->TotalRecs > 0 && !$foxconn_sumbycode->isGridAdd() && !$foxconn_sumbycode->isGridEdit()) { ?>
<tfoot><!-- Table footer -->
	<tr class="ew-table-footer">
<?php

// Render list options
$foxconn_sumbycode_list->renderListOptions();

// Render list options (footer, left)
$foxconn_sumbycode_list->ListOptions->render("footer", "left");
?>
	<?php if ($foxconn_sumbycode->Code->Visible) { // Code ?>
		<td data-name="Code" class="<?php echo $foxconn_sumbycode->Code->footerCellClass() ?>"><span id="elf_foxconn_sumbycode_Code" class="foxconn_sumbycode_Code">
		&nbsp;
		</span></td>
	<?php } ?>
	<?php if ($foxconn_sumbycode->ProductName->Visible) { // ProductName ?>
		<td data-name="ProductName" class="<?php echo $foxconn_sumbycode->ProductName->footerCellClass() ?>"><span id="elf_foxconn_sumbycode_ProductName" class="foxconn_sumbycode_ProductName">
		&nbsp;
		</span></td>
	<?php } ?>
	<?php if ($foxconn_sumbycode->Model->Visible) { // Model ?>
		<td data-name="Model" class="<?php echo $foxconn_sumbycode->Model->footerCellClass() ?>"><span id="elf_foxconn_sumbycode_Model" class="foxconn_sumbycode_Model">
		&nbsp;
		</span></td>
	<?php } ?>
	<?php if ($foxconn_sumbycode->SUM28ts_PCS29->Visible) { // SUM(ts.PCS) ?>
		<td data-name="SUM28ts_PCS29" class="<?php echo $foxconn_sumbycode->SUM28ts_PCS29->footerCellClass() ?>"><span id="elf_foxconn_sumbycode_SUM28ts_PCS29" class="foxconn_sumbycode_SUM28ts_PCS29">
		<span class="ew-aggregate"><?php echo $Language->phrase("TOTAL") ?></span><span class="ew-aggregate-value">
		<?php echo $foxconn_sumbycode->SUM28ts_PCS29->ViewValue ?></span>
		</span></td>
	<?php } ?>
	<?php if ($foxconn_sumbycode->Pallet->Visible) { // Pallet ?>
		<td data-name="Pallet" class="<?php echo $foxconn_sumbycode->Pallet->footerCellClass() ?>"><span id="elf_foxconn_sumbycode_Pallet" class="foxconn_sumbycode_Pallet">
		&nbsp;
		</span></td>
	<?php } ?>
<?php

// Render list options (footer, right)
$foxconn_sumbycode_list->ListOptions->render("footer", "right");
?>
	</tr>
</tfoot>
<?php } ?>
</table><!-- /.ew-table -->
<?php } ?>
<?php if (!$foxconn_sumbycode->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</div><!-- /.ew-grid-middle-panel -->
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($foxconn_sumbycode_list->Recordset)
	$foxconn_sumbycode_list->Recordset->Close();
?>
<?php if (!$foxconn_sumbycode->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$foxconn_sumbycode->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php if (!isset($foxconn_sumbycode_list->Pager)) $foxconn_sumbycode_list->Pager = new PrevNextPager($foxconn_sumbycode_list->StartRec, $foxconn_sumbycode_list->DisplayRecs, $foxconn_sumbycode_list->TotalRecs, $foxconn_sumbycode_list->AutoHidePager) ?>
<?php if ($foxconn_sumbycode_list->Pager->RecordCount > 0 && $foxconn_sumbycode_list->Pager->Visible) { ?>
<div class="ew-pager">
<span><?php echo $Language->Phrase("Page") ?>&nbsp;</span>
<div class="ew-prev-next"><div class="input-group input-group-sm">
<div class="input-group-prepend">
<!-- first page button -->
	<?php if ($foxconn_sumbycode_list->Pager->FirstButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerFirst") ?>" href="<?php echo $foxconn_sumbycode_list->pageUrl() ?>start=<?php echo $foxconn_sumbycode_list->Pager->FirstButton->Start ?>"><i class="icon-first ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerFirst") ?>"><i class="icon-first ew-icon"></i></a>
	<?php } ?>
<!-- previous page button -->
	<?php if ($foxconn_sumbycode_list->Pager->PrevButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerPrevious") ?>" href="<?php echo $foxconn_sumbycode_list->pageUrl() ?>start=<?php echo $foxconn_sumbycode_list->Pager->PrevButton->Start ?>"><i class="icon-prev ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerPrevious") ?>"><i class="icon-prev ew-icon"></i></a>
	<?php } ?>
</div>
<!-- current page number -->
	<input class="form-control" type="text" name="<?php echo TABLE_PAGE_NO ?>" value="<?php echo $foxconn_sumbycode_list->Pager->CurrentPage ?>">
<div class="input-group-append">
<!-- next page button -->
	<?php if ($foxconn_sumbycode_list->Pager->NextButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerNext") ?>" href="<?php echo $foxconn_sumbycode_list->pageUrl() ?>start=<?php echo $foxconn_sumbycode_list->Pager->NextButton->Start ?>"><i class="icon-next ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerNext") ?>"><i class="icon-next ew-icon"></i></a>
	<?php } ?>
<!-- last page button -->
	<?php if ($foxconn_sumbycode_list->Pager->LastButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerLast") ?>" href="<?php echo $foxconn_sumbycode_list->pageUrl() ?>start=<?php echo $foxconn_sumbycode_list->Pager->LastButton->Start ?>"><i class="icon-last ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerLast") ?>"><i class="icon-last ew-icon"></i></a>
	<?php } ?>
</div>
</div>
</div>
<span>&nbsp;<?php echo $Language->Phrase("of") ?>&nbsp;<?php echo $foxconn_sumbycode_list->Pager->PageCount ?></span>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php if ($foxconn_sumbycode_list->Pager->RecordCount > 0) { ?>
<div class="ew-pager ew-rec">
	<span><?php echo $Language->Phrase("Record") ?>&nbsp;<?php echo $foxconn_sumbycode_list->Pager->FromIndex ?>&nbsp;<?php echo $Language->Phrase("To") ?>&nbsp;<?php echo $foxconn_sumbycode_list->Pager->ToIndex ?>&nbsp;<?php echo $Language->Phrase("Of") ?>&nbsp;<?php echo $foxconn_sumbycode_list->Pager->RecordCount ?></span>
</div>
<?php } ?>
<?php if ($foxconn_sumbycode_list->TotalRecs > 0 && (!$foxconn_sumbycode_list->AutoHidePageSizeSelector || $foxconn_sumbycode_list->Pager->Visible)) { ?>
<div class="ew-pager">
<input type="hidden" name="t" value="foxconn_sumbycode">
<select name="<?php echo TABLE_REC_PER_PAGE ?>" class="form-control form-control-sm ew-tooltip" title="<?php echo $Language->phrase("RecordsPerPage") ?>" onchange="this.form.submit();">
<option value="20"<?php if ($foxconn_sumbycode_list->DisplayRecs == 20) { ?> selected<?php } ?>>20</option>
<option value="50"<?php if ($foxconn_sumbycode_list->DisplayRecs == 50) { ?> selected<?php } ?>>50</option>
<option value="100"<?php if ($foxconn_sumbycode_list->DisplayRecs == 100) { ?> selected<?php } ?>>100</option>
<option value="200"<?php if ($foxconn_sumbycode_list->DisplayRecs == 200) { ?> selected<?php } ?>>200</option>
<option value="500"<?php if ($foxconn_sumbycode_list->DisplayRecs == 500) { ?> selected<?php } ?>>500</option>
<option value="ALL"<?php if ($foxconn_sumbycode->getRecordsPerPage() == -1) { ?> selected<?php } ?>><?php echo $Language->Phrase("AllRecords") ?></option>
</select>
</div>
<?php } ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $foxconn_sumbycode_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($foxconn_sumbycode_list->TotalRecs == 0 && !$foxconn_sumbycode->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $foxconn_sumbycode_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$foxconn_sumbycode_list->showPageFooter();
if (DEBUG_ENABLED)
	echo GetDebugMessage();
?>
<?php if (!$foxconn_sumbycode->isExport()) { ?>
<script>

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php } ?>
<?php include_once "footer.php" ?>
<?php
$foxconn_sumbycode_list->terminate();
?>