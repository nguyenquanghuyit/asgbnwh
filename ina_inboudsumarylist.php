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
$ina_inboudsumary_list = new ina_inboudsumary_list();

// Run the page
$ina_inboudsumary_list->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$ina_inboudsumary_list->Page_Render();
?>
<?php include_once "header.php" ?>
<?php if (!$ina_inboudsumary->isExport()) { ?>
<script>

// Form object
currentPageID = ew.PAGE_ID = "list";
var fina_inboudsumarylist = currentForm = new ew.Form("fina_inboudsumarylist", "list");
fina_inboudsumarylist.formKeyCountName = '<?php echo $ina_inboudsumary_list->FormKeyCountName ?>';

// Form_CustomValidate event
fina_inboudsumarylist.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

	// Your custom validation code here, return false if invalid.
	return true;
}

// Use JavaScript validation or not
fina_inboudsumarylist.validateRequired = <?php echo json_encode(CLIENT_VALIDATE) ?>;

// Dynamic selection lists
fina_inboudsumarylist.lists["x_Nam"] = <?php echo $ina_inboudsumary_list->Nam->Lookup->toClientList() ?>;
fina_inboudsumarylist.lists["x_Nam"].options = <?php echo JsonEncode($ina_inboudsumary_list->Nam->lookupOptions()) ?>;
fina_inboudsumarylist.lists["x_Thang"] = <?php echo $ina_inboudsumary_list->Thang->Lookup->toClientList() ?>;
fina_inboudsumarylist.lists["x_Thang"].options = <?php echo JsonEncode($ina_inboudsumary_list->Thang->lookupOptions()) ?>;

// Form object for search
var fina_inboudsumarylistsrch = currentSearchForm = new ew.Form("fina_inboudsumarylistsrch");

// Filters
fina_inboudsumarylistsrch.filterList = <?php echo $ina_inboudsumary_list->getFilterList() ?>;
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
<?php if (!$ina_inboudsumary->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($ina_inboudsumary_list->TotalRecs > 0 && $ina_inboudsumary_list->ExportOptions->visible()) { ?>
<?php $ina_inboudsumary_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($ina_inboudsumary_list->ImportOptions->visible()) { ?>
<?php $ina_inboudsumary_list->ImportOptions->render("body") ?>
<?php } ?>
<?php if ($ina_inboudsumary_list->SearchOptions->visible()) { ?>
<?php $ina_inboudsumary_list->SearchOptions->render("body") ?>
<?php } ?>
<?php if ($ina_inboudsumary_list->FilterOptions->visible()) { ?>
<?php $ina_inboudsumary_list->FilterOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php
$ina_inboudsumary_list->renderOtherOptions();
?>
<?php if ($Security->CanSearch()) { ?>
<?php if (!$ina_inboudsumary->isExport() && !$ina_inboudsumary->CurrentAction) { ?>
<form name="fina_inboudsumarylistsrch" id="fina_inboudsumarylistsrch" class="form-inline ew-form ew-ext-search-form" action="<?php echo CurrentPageName() ?>">
<?php $searchPanelClass = ($ina_inboudsumary_list->SearchWhere <> "") ? " show" : " show"; ?>
<div id="fina_inboudsumarylistsrch-search-panel" class="ew-search-panel collapse<?php echo $searchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="ina_inboudsumary">
	<div class="ew-basic-search">
<div id="xsr_1" class="ew-row d-sm-flex">
	<div class="ew-quick-search input-group">
		<input type="text" name="<?php echo TABLE_BASIC_SEARCH ?>" id="<?php echo TABLE_BASIC_SEARCH ?>" class="form-control" value="<?php echo HtmlEncode($ina_inboudsumary_list->BasicSearch->getKeyword()) ?>" placeholder="<?php echo HtmlEncode($Language->phrase("Search")) ?>">
		<input type="hidden" name="<?php echo TABLE_BASIC_SEARCH_TYPE ?>" id="<?php echo TABLE_BASIC_SEARCH_TYPE ?>" value="<?php echo HtmlEncode($ina_inboudsumary_list->BasicSearch->getType()) ?>">
		<div class="input-group-append">
			<button class="btn btn-primary" name="btn-submit" id="btn-submit" type="submit"><?php echo $Language->phrase("SearchBtn") ?></button>
			<button type="button" data-toggle="dropdown" class="btn btn-primary dropdown-toggle dropdown-toggle-split" aria-haspopup="true" aria-expanded="false"><span id="searchtype"><?php echo $ina_inboudsumary_list->BasicSearch->getTypeNameShort() ?></span></button>
			<div class="dropdown-menu dropdown-menu-right">
				<a class="dropdown-item<?php if ($ina_inboudsumary_list->BasicSearch->getType() == "") echo " active"; ?>" href="javascript:void(0);" onclick="ew.setSearchType(this)"><?php echo $Language->phrase("QuickSearchAuto") ?></a>
				<a class="dropdown-item<?php if ($ina_inboudsumary_list->BasicSearch->getType() == "=") echo " active"; ?>" href="javascript:void(0);" onclick="ew.setSearchType(this,'=')"><?php echo $Language->phrase("QuickSearchExact") ?></a>
				<a class="dropdown-item<?php if ($ina_inboudsumary_list->BasicSearch->getType() == "AND") echo " active"; ?>" href="javascript:void(0);" onclick="ew.setSearchType(this,'AND')"><?php echo $Language->phrase("QuickSearchAll") ?></a>
				<a class="dropdown-item<?php if ($ina_inboudsumary_list->BasicSearch->getType() == "OR") echo " active"; ?>" href="javascript:void(0);" onclick="ew.setSearchType(this,'OR')"><?php echo $Language->phrase("QuickSearchAny") ?></a>
			</div>
		</div>
	</div>
</div>
	</div>
</div>
</form>
<?php } ?>
<?php } ?>
<?php $ina_inboudsumary_list->showPageHeader(); ?>
<?php
$ina_inboudsumary_list->showMessage();
?>
<?php if ($ina_inboudsumary_list->TotalRecs > 0 || $ina_inboudsumary->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($ina_inboudsumary_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> ina_inboudsumary">
<?php if (!$ina_inboudsumary->isExport()) { ?>
<div class="card-header ew-grid-upper-panel">
<?php if (!$ina_inboudsumary->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php if (!isset($ina_inboudsumary_list->Pager)) $ina_inboudsumary_list->Pager = new PrevNextPager($ina_inboudsumary_list->StartRec, $ina_inboudsumary_list->DisplayRecs, $ina_inboudsumary_list->TotalRecs, $ina_inboudsumary_list->AutoHidePager) ?>
<?php if ($ina_inboudsumary_list->Pager->RecordCount > 0 && $ina_inboudsumary_list->Pager->Visible) { ?>
<div class="ew-pager">
<span><?php echo $Language->Phrase("Page") ?>&nbsp;</span>
<div class="ew-prev-next"><div class="input-group input-group-sm">
<div class="input-group-prepend">
<!-- first page button -->
	<?php if ($ina_inboudsumary_list->Pager->FirstButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerFirst") ?>" href="<?php echo $ina_inboudsumary_list->pageUrl() ?>start=<?php echo $ina_inboudsumary_list->Pager->FirstButton->Start ?>"><i class="icon-first ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerFirst") ?>"><i class="icon-first ew-icon"></i></a>
	<?php } ?>
<!-- previous page button -->
	<?php if ($ina_inboudsumary_list->Pager->PrevButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerPrevious") ?>" href="<?php echo $ina_inboudsumary_list->pageUrl() ?>start=<?php echo $ina_inboudsumary_list->Pager->PrevButton->Start ?>"><i class="icon-prev ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerPrevious") ?>"><i class="icon-prev ew-icon"></i></a>
	<?php } ?>
</div>
<!-- current page number -->
	<input class="form-control" type="text" name="<?php echo TABLE_PAGE_NO ?>" value="<?php echo $ina_inboudsumary_list->Pager->CurrentPage ?>">
<div class="input-group-append">
<!-- next page button -->
	<?php if ($ina_inboudsumary_list->Pager->NextButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerNext") ?>" href="<?php echo $ina_inboudsumary_list->pageUrl() ?>start=<?php echo $ina_inboudsumary_list->Pager->NextButton->Start ?>"><i class="icon-next ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerNext") ?>"><i class="icon-next ew-icon"></i></a>
	<?php } ?>
<!-- last page button -->
	<?php if ($ina_inboudsumary_list->Pager->LastButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerLast") ?>" href="<?php echo $ina_inboudsumary_list->pageUrl() ?>start=<?php echo $ina_inboudsumary_list->Pager->LastButton->Start ?>"><i class="icon-last ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerLast") ?>"><i class="icon-last ew-icon"></i></a>
	<?php } ?>
</div>
</div>
</div>
<span>&nbsp;<?php echo $Language->Phrase("of") ?>&nbsp;<?php echo $ina_inboudsumary_list->Pager->PageCount ?></span>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php if ($ina_inboudsumary_list->Pager->RecordCount > 0) { ?>
<div class="ew-pager ew-rec">
	<span><?php echo $Language->Phrase("Record") ?>&nbsp;<?php echo $ina_inboudsumary_list->Pager->FromIndex ?>&nbsp;<?php echo $Language->Phrase("To") ?>&nbsp;<?php echo $ina_inboudsumary_list->Pager->ToIndex ?>&nbsp;<?php echo $Language->Phrase("Of") ?>&nbsp;<?php echo $ina_inboudsumary_list->Pager->RecordCount ?></span>
</div>
<?php } ?>
<?php if ($ina_inboudsumary_list->TotalRecs > 0 && (!$ina_inboudsumary_list->AutoHidePageSizeSelector || $ina_inboudsumary_list->Pager->Visible)) { ?>
<div class="ew-pager">
<input type="hidden" name="t" value="ina_inboudsumary">
<select name="<?php echo TABLE_REC_PER_PAGE ?>" class="form-control form-control-sm ew-tooltip" title="<?php echo $Language->phrase("RecordsPerPage") ?>" onchange="this.form.submit();">
<option value="20"<?php if ($ina_inboudsumary_list->DisplayRecs == 20) { ?> selected<?php } ?>>20</option>
<option value="50"<?php if ($ina_inboudsumary_list->DisplayRecs == 50) { ?> selected<?php } ?>>50</option>
<option value="100"<?php if ($ina_inboudsumary_list->DisplayRecs == 100) { ?> selected<?php } ?>>100</option>
<option value="200"<?php if ($ina_inboudsumary_list->DisplayRecs == 200) { ?> selected<?php } ?>>200</option>
<option value="500"<?php if ($ina_inboudsumary_list->DisplayRecs == 500) { ?> selected<?php } ?>>500</option>
<option value="ALL"<?php if ($ina_inboudsumary->getRecordsPerPage() == -1) { ?> selected<?php } ?>><?php echo $Language->Phrase("AllRecords") ?></option>
</select>
</div>
<?php } ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $ina_inboudsumary_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
<form name="fina_inboudsumarylist" id="fina_inboudsumarylist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($ina_inboudsumary_list->CheckToken) { ?>
<input type="hidden" name="<?php echo TOKEN_NAME ?>" value="<?php echo $ina_inboudsumary_list->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="ina_inboudsumary">
<div id="gmp_ina_inboudsumary" class="<?php if (IsResponsiveLayout()) { ?>table-responsive <?php } ?>card-body ew-grid-middle-panel">
<?php if ($ina_inboudsumary_list->TotalRecs > 0 || $ina_inboudsumary->isGridEdit()) { ?>
<table id="tbl_ina_inboudsumarylist" class="table ew-table"><!-- .ew-table ##-->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$ina_inboudsumary_list->RowType = ROWTYPE_HEADER;

// Render list options
$ina_inboudsumary_list->renderListOptions();

// Render list options (header, left)
$ina_inboudsumary_list->ListOptions->render("header", "left");
?>
<?php if ($ina_inboudsumary->Nam->Visible) { // Nam ?>
	<?php if ($ina_inboudsumary->sortUrl($ina_inboudsumary->Nam) == "") { ?>
		<th data-name="Nam" class="<?php echo $ina_inboudsumary->Nam->headerCellClass() ?>"><div id="elh_ina_inboudsumary_Nam" class="ina_inboudsumary_Nam"><div class="ew-table-header-caption"><?php echo $ina_inboudsumary->Nam->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Nam" class="<?php echo $ina_inboudsumary->Nam->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $ina_inboudsumary->SortUrl($ina_inboudsumary->Nam) ?>',2);"><div id="elh_ina_inboudsumary_Nam" class="ina_inboudsumary_Nam">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $ina_inboudsumary->Nam->caption() ?></span><span class="ew-table-header-sort"><?php if ($ina_inboudsumary->Nam->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($ina_inboudsumary->Nam->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($ina_inboudsumary->Thang->Visible) { // Thang ?>
	<?php if ($ina_inboudsumary->sortUrl($ina_inboudsumary->Thang) == "") { ?>
		<th data-name="Thang" class="<?php echo $ina_inboudsumary->Thang->headerCellClass() ?>"><div id="elh_ina_inboudsumary_Thang" class="ina_inboudsumary_Thang"><div class="ew-table-header-caption"><?php echo $ina_inboudsumary->Thang->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Thang" class="<?php echo $ina_inboudsumary->Thang->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $ina_inboudsumary->SortUrl($ina_inboudsumary->Thang) ?>',2);"><div id="elh_ina_inboudsumary_Thang" class="ina_inboudsumary_Thang">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $ina_inboudsumary->Thang->caption() ?></span><span class="ew-table-header-sort"><?php if ($ina_inboudsumary->Thang->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($ina_inboudsumary->Thang->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($ina_inboudsumary->Code->Visible) { // Code ?>
	<?php if ($ina_inboudsumary->sortUrl($ina_inboudsumary->Code) == "") { ?>
		<th data-name="Code" class="<?php echo $ina_inboudsumary->Code->headerCellClass() ?>"><div id="elh_ina_inboudsumary_Code" class="ina_inboudsumary_Code"><div class="ew-table-header-caption"><?php echo $ina_inboudsumary->Code->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Code" class="<?php echo $ina_inboudsumary->Code->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $ina_inboudsumary->SortUrl($ina_inboudsumary->Code) ?>',2);"><div id="elh_ina_inboudsumary_Code" class="ina_inboudsumary_Code">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $ina_inboudsumary->Code->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($ina_inboudsumary->Code->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($ina_inboudsumary->Code->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($ina_inboudsumary->ProductName->Visible) { // ProductName ?>
	<?php if ($ina_inboudsumary->sortUrl($ina_inboudsumary->ProductName) == "") { ?>
		<th data-name="ProductName" class="<?php echo $ina_inboudsumary->ProductName->headerCellClass() ?>"><div id="elh_ina_inboudsumary_ProductName" class="ina_inboudsumary_ProductName"><div class="ew-table-header-caption"><?php echo $ina_inboudsumary->ProductName->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="ProductName" class="<?php echo $ina_inboudsumary->ProductName->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $ina_inboudsumary->SortUrl($ina_inboudsumary->ProductName) ?>',2);"><div id="elh_ina_inboudsumary_ProductName" class="ina_inboudsumary_ProductName">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $ina_inboudsumary->ProductName->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($ina_inboudsumary->ProductName->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($ina_inboudsumary->ProductName->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($ina_inboudsumary->PCS->Visible) { // PCS ?>
	<?php if ($ina_inboudsumary->sortUrl($ina_inboudsumary->PCS) == "") { ?>
		<th data-name="PCS" class="<?php echo $ina_inboudsumary->PCS->headerCellClass() ?>"><div id="elh_ina_inboudsumary_PCS" class="ina_inboudsumary_PCS"><div class="ew-table-header-caption"><?php echo $ina_inboudsumary->PCS->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="PCS" class="<?php echo $ina_inboudsumary->PCS->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $ina_inboudsumary->SortUrl($ina_inboudsumary->PCS) ?>',2);"><div id="elh_ina_inboudsumary_PCS" class="ina_inboudsumary_PCS">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $ina_inboudsumary->PCS->caption() ?></span><span class="ew-table-header-sort"><?php if ($ina_inboudsumary->PCS->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($ina_inboudsumary->PCS->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$ina_inboudsumary_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
if ($ina_inboudsumary->ExportAll && $ina_inboudsumary->isExport()) {
	$ina_inboudsumary_list->StopRec = $ina_inboudsumary_list->TotalRecs;
} else {

	// Set the last record to display
	if ($ina_inboudsumary_list->TotalRecs > $ina_inboudsumary_list->StartRec + $ina_inboudsumary_list->DisplayRecs - 1)
		$ina_inboudsumary_list->StopRec = $ina_inboudsumary_list->StartRec + $ina_inboudsumary_list->DisplayRecs - 1;
	else
		$ina_inboudsumary_list->StopRec = $ina_inboudsumary_list->TotalRecs;
}
$ina_inboudsumary_list->RecCnt = $ina_inboudsumary_list->StartRec - 1;
if ($ina_inboudsumary_list->Recordset && !$ina_inboudsumary_list->Recordset->EOF) {
	$ina_inboudsumary_list->Recordset->moveFirst();
	$selectLimit = $ina_inboudsumary_list->UseSelectLimit;
	if (!$selectLimit && $ina_inboudsumary_list->StartRec > 1)
		$ina_inboudsumary_list->Recordset->move($ina_inboudsumary_list->StartRec - 1);
} elseif (!$ina_inboudsumary->AllowAddDeleteRow && $ina_inboudsumary_list->StopRec == 0) {
	$ina_inboudsumary_list->StopRec = $ina_inboudsumary->GridAddRowCount;
}

// Initialize aggregate
$ina_inboudsumary->RowType = ROWTYPE_AGGREGATEINIT;
$ina_inboudsumary->resetAttributes();
$ina_inboudsumary_list->renderRow();
while ($ina_inboudsumary_list->RecCnt < $ina_inboudsumary_list->StopRec) {
	$ina_inboudsumary_list->RecCnt++;
	if ($ina_inboudsumary_list->RecCnt >= $ina_inboudsumary_list->StartRec) {
		$ina_inboudsumary_list->RowCnt++;

		// Set up key count
		$ina_inboudsumary_list->KeyCount = $ina_inboudsumary_list->RowIndex;

		// Init row class and style
		$ina_inboudsumary->resetAttributes();
		$ina_inboudsumary->CssClass = "";
		if ($ina_inboudsumary->isGridAdd()) {
		} else {
			$ina_inboudsumary_list->loadRowValues($ina_inboudsumary_list->Recordset); // Load row values
		}
		$ina_inboudsumary->RowType = ROWTYPE_VIEW; // Render view

		// Set up row id / data-rowindex
		$ina_inboudsumary->RowAttrs = array_merge($ina_inboudsumary->RowAttrs, array('data-rowindex'=>$ina_inboudsumary_list->RowCnt, 'id'=>'r' . $ina_inboudsumary_list->RowCnt . '_ina_inboudsumary', 'data-rowtype'=>$ina_inboudsumary->RowType));

		// Render row
		$ina_inboudsumary_list->renderRow();

		// Render list options
		$ina_inboudsumary_list->renderListOptions();
?>
	<tr<?php echo $ina_inboudsumary->rowAttributes() ?>>
<?php

// Render list options (body, left)
$ina_inboudsumary_list->ListOptions->render("body", "left", $ina_inboudsumary_list->RowCnt);
?>
	<?php if ($ina_inboudsumary->Nam->Visible) { // Nam ?>
		<td data-name="Nam"<?php echo $ina_inboudsumary->Nam->cellAttributes() ?>>
<span id="el<?php echo $ina_inboudsumary_list->RowCnt ?>_ina_inboudsumary_Nam" class="ina_inboudsumary_Nam">
<span<?php echo $ina_inboudsumary->Nam->viewAttributes() ?>>
<?php echo $ina_inboudsumary->Nam->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($ina_inboudsumary->Thang->Visible) { // Thang ?>
		<td data-name="Thang"<?php echo $ina_inboudsumary->Thang->cellAttributes() ?>>
<span id="el<?php echo $ina_inboudsumary_list->RowCnt ?>_ina_inboudsumary_Thang" class="ina_inboudsumary_Thang">
<span<?php echo $ina_inboudsumary->Thang->viewAttributes() ?>>
<?php echo $ina_inboudsumary->Thang->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($ina_inboudsumary->Code->Visible) { // Code ?>
		<td data-name="Code"<?php echo $ina_inboudsumary->Code->cellAttributes() ?>>
<span id="el<?php echo $ina_inboudsumary_list->RowCnt ?>_ina_inboudsumary_Code" class="ina_inboudsumary_Code">
<span<?php echo $ina_inboudsumary->Code->viewAttributes() ?>>
<?php echo $ina_inboudsumary->Code->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($ina_inboudsumary->ProductName->Visible) { // ProductName ?>
		<td data-name="ProductName"<?php echo $ina_inboudsumary->ProductName->cellAttributes() ?>>
<span id="el<?php echo $ina_inboudsumary_list->RowCnt ?>_ina_inboudsumary_ProductName" class="ina_inboudsumary_ProductName">
<span<?php echo $ina_inboudsumary->ProductName->viewAttributes() ?>>
<?php echo $ina_inboudsumary->ProductName->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($ina_inboudsumary->PCS->Visible) { // PCS ?>
		<td data-name="PCS"<?php echo $ina_inboudsumary->PCS->cellAttributes() ?>>
<span id="el<?php echo $ina_inboudsumary_list->RowCnt ?>_ina_inboudsumary_PCS" class="ina_inboudsumary_PCS">
<span<?php echo $ina_inboudsumary->PCS->viewAttributes() ?>>
<?php echo $ina_inboudsumary->PCS->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$ina_inboudsumary_list->ListOptions->render("body", "right", $ina_inboudsumary_list->RowCnt);
?>
	</tr>
<?php
	}
	if (!$ina_inboudsumary->isGridAdd())
		$ina_inboudsumary_list->Recordset->moveNext();
}
?>
</tbody>
<?php

// Render aggregate row
$ina_inboudsumary->RowType = ROWTYPE_AGGREGATE;
$ina_inboudsumary->resetAttributes();
$ina_inboudsumary_list->renderRow();
?>
<?php if ($ina_inboudsumary_list->TotalRecs > 0 && !$ina_inboudsumary->isGridAdd() && !$ina_inboudsumary->isGridEdit()) { ?>
<tfoot><!-- Table footer -->
	<tr class="ew-table-footer">
<?php

// Render list options
$ina_inboudsumary_list->renderListOptions();

// Render list options (footer, left)
$ina_inboudsumary_list->ListOptions->render("footer", "left");
?>
	<?php if ($ina_inboudsumary->Nam->Visible) { // Nam ?>
		<td data-name="Nam" class="<?php echo $ina_inboudsumary->Nam->footerCellClass() ?>"><span id="elf_ina_inboudsumary_Nam" class="ina_inboudsumary_Nam">
		&nbsp;
		</span></td>
	<?php } ?>
	<?php if ($ina_inboudsumary->Thang->Visible) { // Thang ?>
		<td data-name="Thang" class="<?php echo $ina_inboudsumary->Thang->footerCellClass() ?>"><span id="elf_ina_inboudsumary_Thang" class="ina_inboudsumary_Thang">
		&nbsp;
		</span></td>
	<?php } ?>
	<?php if ($ina_inboudsumary->Code->Visible) { // Code ?>
		<td data-name="Code" class="<?php echo $ina_inboudsumary->Code->footerCellClass() ?>"><span id="elf_ina_inboudsumary_Code" class="ina_inboudsumary_Code">
		&nbsp;
		</span></td>
	<?php } ?>
	<?php if ($ina_inboudsumary->ProductName->Visible) { // ProductName ?>
		<td data-name="ProductName" class="<?php echo $ina_inboudsumary->ProductName->footerCellClass() ?>"><span id="elf_ina_inboudsumary_ProductName" class="ina_inboudsumary_ProductName">
		&nbsp;
		</span></td>
	<?php } ?>
	<?php if ($ina_inboudsumary->PCS->Visible) { // PCS ?>
		<td data-name="PCS" class="<?php echo $ina_inboudsumary->PCS->footerCellClass() ?>"><span id="elf_ina_inboudsumary_PCS" class="ina_inboudsumary_PCS">
		<span class="ew-aggregate"><?php echo $Language->phrase("TOTAL") ?></span><span class="ew-aggregate-value">
		<?php echo $ina_inboudsumary->PCS->ViewValue ?></span>
		</span></td>
	<?php } ?>
<?php

// Render list options (footer, right)
$ina_inboudsumary_list->ListOptions->render("footer", "right");
?>
	</tr>
</tfoot>
<?php } ?>
</table><!-- /.ew-table -->
<?php } ?>
<?php if (!$ina_inboudsumary->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</div><!-- /.ew-grid-middle-panel -->
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($ina_inboudsumary_list->Recordset)
	$ina_inboudsumary_list->Recordset->Close();
?>
<?php if (!$ina_inboudsumary->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$ina_inboudsumary->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php if (!isset($ina_inboudsumary_list->Pager)) $ina_inboudsumary_list->Pager = new PrevNextPager($ina_inboudsumary_list->StartRec, $ina_inboudsumary_list->DisplayRecs, $ina_inboudsumary_list->TotalRecs, $ina_inboudsumary_list->AutoHidePager) ?>
<?php if ($ina_inboudsumary_list->Pager->RecordCount > 0 && $ina_inboudsumary_list->Pager->Visible) { ?>
<div class="ew-pager">
<span><?php echo $Language->Phrase("Page") ?>&nbsp;</span>
<div class="ew-prev-next"><div class="input-group input-group-sm">
<div class="input-group-prepend">
<!-- first page button -->
	<?php if ($ina_inboudsumary_list->Pager->FirstButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerFirst") ?>" href="<?php echo $ina_inboudsumary_list->pageUrl() ?>start=<?php echo $ina_inboudsumary_list->Pager->FirstButton->Start ?>"><i class="icon-first ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerFirst") ?>"><i class="icon-first ew-icon"></i></a>
	<?php } ?>
<!-- previous page button -->
	<?php if ($ina_inboudsumary_list->Pager->PrevButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerPrevious") ?>" href="<?php echo $ina_inboudsumary_list->pageUrl() ?>start=<?php echo $ina_inboudsumary_list->Pager->PrevButton->Start ?>"><i class="icon-prev ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerPrevious") ?>"><i class="icon-prev ew-icon"></i></a>
	<?php } ?>
</div>
<!-- current page number -->
	<input class="form-control" type="text" name="<?php echo TABLE_PAGE_NO ?>" value="<?php echo $ina_inboudsumary_list->Pager->CurrentPage ?>">
<div class="input-group-append">
<!-- next page button -->
	<?php if ($ina_inboudsumary_list->Pager->NextButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerNext") ?>" href="<?php echo $ina_inboudsumary_list->pageUrl() ?>start=<?php echo $ina_inboudsumary_list->Pager->NextButton->Start ?>"><i class="icon-next ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerNext") ?>"><i class="icon-next ew-icon"></i></a>
	<?php } ?>
<!-- last page button -->
	<?php if ($ina_inboudsumary_list->Pager->LastButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerLast") ?>" href="<?php echo $ina_inboudsumary_list->pageUrl() ?>start=<?php echo $ina_inboudsumary_list->Pager->LastButton->Start ?>"><i class="icon-last ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerLast") ?>"><i class="icon-last ew-icon"></i></a>
	<?php } ?>
</div>
</div>
</div>
<span>&nbsp;<?php echo $Language->Phrase("of") ?>&nbsp;<?php echo $ina_inboudsumary_list->Pager->PageCount ?></span>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php if ($ina_inboudsumary_list->Pager->RecordCount > 0) { ?>
<div class="ew-pager ew-rec">
	<span><?php echo $Language->Phrase("Record") ?>&nbsp;<?php echo $ina_inboudsumary_list->Pager->FromIndex ?>&nbsp;<?php echo $Language->Phrase("To") ?>&nbsp;<?php echo $ina_inboudsumary_list->Pager->ToIndex ?>&nbsp;<?php echo $Language->Phrase("Of") ?>&nbsp;<?php echo $ina_inboudsumary_list->Pager->RecordCount ?></span>
</div>
<?php } ?>
<?php if ($ina_inboudsumary_list->TotalRecs > 0 && (!$ina_inboudsumary_list->AutoHidePageSizeSelector || $ina_inboudsumary_list->Pager->Visible)) { ?>
<div class="ew-pager">
<input type="hidden" name="t" value="ina_inboudsumary">
<select name="<?php echo TABLE_REC_PER_PAGE ?>" class="form-control form-control-sm ew-tooltip" title="<?php echo $Language->phrase("RecordsPerPage") ?>" onchange="this.form.submit();">
<option value="20"<?php if ($ina_inboudsumary_list->DisplayRecs == 20) { ?> selected<?php } ?>>20</option>
<option value="50"<?php if ($ina_inboudsumary_list->DisplayRecs == 50) { ?> selected<?php } ?>>50</option>
<option value="100"<?php if ($ina_inboudsumary_list->DisplayRecs == 100) { ?> selected<?php } ?>>100</option>
<option value="200"<?php if ($ina_inboudsumary_list->DisplayRecs == 200) { ?> selected<?php } ?>>200</option>
<option value="500"<?php if ($ina_inboudsumary_list->DisplayRecs == 500) { ?> selected<?php } ?>>500</option>
<option value="ALL"<?php if ($ina_inboudsumary->getRecordsPerPage() == -1) { ?> selected<?php } ?>><?php echo $Language->Phrase("AllRecords") ?></option>
</select>
</div>
<?php } ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $ina_inboudsumary_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($ina_inboudsumary_list->TotalRecs == 0 && !$ina_inboudsumary->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $ina_inboudsumary_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$ina_inboudsumary_list->showPageFooter();
if (DEBUG_ENABLED)
	echo GetDebugMessage();
?>
<?php if (!$ina_inboudsumary->isExport()) { ?>
<script>

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php } ?>
<?php include_once "footer.php" ?>
<?php
$ina_inboudsumary_list->terminate();
?>