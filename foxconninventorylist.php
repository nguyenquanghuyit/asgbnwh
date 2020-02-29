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
$foxconninventory_list = new foxconninventory_list();

// Run the page
$foxconninventory_list->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$foxconninventory_list->Page_Render();
?>
<?php include_once "header.php" ?>
<?php if (!$foxconninventory->isExport()) { ?>
<script>

// Form object
currentPageID = ew.PAGE_ID = "list";
var ffoxconninventorylist = currentForm = new ew.Form("ffoxconninventorylist", "list");
ffoxconninventorylist.formKeyCountName = '<?php echo $foxconninventory_list->FormKeyCountName ?>';

// Form_CustomValidate event
ffoxconninventorylist.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

	// Your custom validation code here, return false if invalid.
	return true;
}

// Use JavaScript validation or not
ffoxconninventorylist.validateRequired = <?php echo json_encode(CLIENT_VALIDATE) ?>;

// Dynamic selection lists
// Form object for search

var ffoxconninventorylistsrch = currentSearchForm = new ew.Form("ffoxconninventorylistsrch");

// Filters
ffoxconninventorylistsrch.filterList = <?php echo $foxconninventory_list->getFilterList() ?>;
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
<?php if (!$foxconninventory->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($foxconninventory_list->TotalRecs > 0 && $foxconninventory_list->ExportOptions->visible()) { ?>
<?php $foxconninventory_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($foxconninventory_list->ImportOptions->visible()) { ?>
<?php $foxconninventory_list->ImportOptions->render("body") ?>
<?php } ?>
<?php if ($foxconninventory_list->SearchOptions->visible()) { ?>
<?php $foxconninventory_list->SearchOptions->render("body") ?>
<?php } ?>
<?php if ($foxconninventory_list->FilterOptions->visible()) { ?>
<?php $foxconninventory_list->FilterOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php
$foxconninventory_list->renderOtherOptions();
?>
<?php if ($Security->CanSearch()) { ?>
<?php if (!$foxconninventory->isExport() && !$foxconninventory->CurrentAction) { ?>
<form name="ffoxconninventorylistsrch" id="ffoxconninventorylistsrch" class="form-inline ew-form ew-ext-search-form" action="<?php echo CurrentPageName() ?>">
<?php $searchPanelClass = ($foxconninventory_list->SearchWhere <> "") ? " show" : " show"; ?>
<div id="ffoxconninventorylistsrch-search-panel" class="ew-search-panel collapse<?php echo $searchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="foxconninventory">
	<div class="ew-basic-search">
<div id="xsr_1" class="ew-row d-sm-flex">
	<div class="ew-quick-search input-group">
		<input type="text" name="<?php echo TABLE_BASIC_SEARCH ?>" id="<?php echo TABLE_BASIC_SEARCH ?>" class="form-control" value="<?php echo HtmlEncode($foxconninventory_list->BasicSearch->getKeyword()) ?>" placeholder="<?php echo HtmlEncode($Language->phrase("Search")) ?>">
		<input type="hidden" name="<?php echo TABLE_BASIC_SEARCH_TYPE ?>" id="<?php echo TABLE_BASIC_SEARCH_TYPE ?>" value="<?php echo HtmlEncode($foxconninventory_list->BasicSearch->getType()) ?>">
		<div class="input-group-append">
			<button class="btn btn-primary" name="btn-submit" id="btn-submit" type="submit"><?php echo $Language->phrase("SearchBtn") ?></button>
			<button type="button" data-toggle="dropdown" class="btn btn-primary dropdown-toggle dropdown-toggle-split" aria-haspopup="true" aria-expanded="false"><span id="searchtype"><?php echo $foxconninventory_list->BasicSearch->getTypeNameShort() ?></span></button>
			<div class="dropdown-menu dropdown-menu-right">
				<a class="dropdown-item<?php if ($foxconninventory_list->BasicSearch->getType() == "") echo " active"; ?>" href="javascript:void(0);" onclick="ew.setSearchType(this)"><?php echo $Language->phrase("QuickSearchAuto") ?></a>
				<a class="dropdown-item<?php if ($foxconninventory_list->BasicSearch->getType() == "=") echo " active"; ?>" href="javascript:void(0);" onclick="ew.setSearchType(this,'=')"><?php echo $Language->phrase("QuickSearchExact") ?></a>
				<a class="dropdown-item<?php if ($foxconninventory_list->BasicSearch->getType() == "AND") echo " active"; ?>" href="javascript:void(0);" onclick="ew.setSearchType(this,'AND')"><?php echo $Language->phrase("QuickSearchAll") ?></a>
				<a class="dropdown-item<?php if ($foxconninventory_list->BasicSearch->getType() == "OR") echo " active"; ?>" href="javascript:void(0);" onclick="ew.setSearchType(this,'OR')"><?php echo $Language->phrase("QuickSearchAny") ?></a>
			</div>
		</div>
	</div>
</div>
	</div>
</div>
</form>
<?php } ?>
<?php } ?>
<?php $foxconninventory_list->showPageHeader(); ?>
<?php
$foxconninventory_list->showMessage();
?>
<?php if ($foxconninventory_list->TotalRecs > 0 || $foxconninventory->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($foxconninventory_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> foxconninventory">
<?php if (!$foxconninventory->isExport()) { ?>
<div class="card-header ew-grid-upper-panel">
<?php if (!$foxconninventory->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php if (!isset($foxconninventory_list->Pager)) $foxconninventory_list->Pager = new PrevNextPager($foxconninventory_list->StartRec, $foxconninventory_list->DisplayRecs, $foxconninventory_list->TotalRecs, $foxconninventory_list->AutoHidePager) ?>
<?php if ($foxconninventory_list->Pager->RecordCount > 0 && $foxconninventory_list->Pager->Visible) { ?>
<div class="ew-pager">
<span><?php echo $Language->Phrase("Page") ?>&nbsp;</span>
<div class="ew-prev-next"><div class="input-group input-group-sm">
<div class="input-group-prepend">
<!-- first page button -->
	<?php if ($foxconninventory_list->Pager->FirstButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerFirst") ?>" href="<?php echo $foxconninventory_list->pageUrl() ?>start=<?php echo $foxconninventory_list->Pager->FirstButton->Start ?>"><i class="icon-first ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerFirst") ?>"><i class="icon-first ew-icon"></i></a>
	<?php } ?>
<!-- previous page button -->
	<?php if ($foxconninventory_list->Pager->PrevButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerPrevious") ?>" href="<?php echo $foxconninventory_list->pageUrl() ?>start=<?php echo $foxconninventory_list->Pager->PrevButton->Start ?>"><i class="icon-prev ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerPrevious") ?>"><i class="icon-prev ew-icon"></i></a>
	<?php } ?>
</div>
<!-- current page number -->
	<input class="form-control" type="text" name="<?php echo TABLE_PAGE_NO ?>" value="<?php echo $foxconninventory_list->Pager->CurrentPage ?>">
<div class="input-group-append">
<!-- next page button -->
	<?php if ($foxconninventory_list->Pager->NextButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerNext") ?>" href="<?php echo $foxconninventory_list->pageUrl() ?>start=<?php echo $foxconninventory_list->Pager->NextButton->Start ?>"><i class="icon-next ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerNext") ?>"><i class="icon-next ew-icon"></i></a>
	<?php } ?>
<!-- last page button -->
	<?php if ($foxconninventory_list->Pager->LastButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerLast") ?>" href="<?php echo $foxconninventory_list->pageUrl() ?>start=<?php echo $foxconninventory_list->Pager->LastButton->Start ?>"><i class="icon-last ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerLast") ?>"><i class="icon-last ew-icon"></i></a>
	<?php } ?>
</div>
</div>
</div>
<span>&nbsp;<?php echo $Language->Phrase("of") ?>&nbsp;<?php echo $foxconninventory_list->Pager->PageCount ?></span>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php if ($foxconninventory_list->Pager->RecordCount > 0) { ?>
<div class="ew-pager ew-rec">
	<span><?php echo $Language->Phrase("Record") ?>&nbsp;<?php echo $foxconninventory_list->Pager->FromIndex ?>&nbsp;<?php echo $Language->Phrase("To") ?>&nbsp;<?php echo $foxconninventory_list->Pager->ToIndex ?>&nbsp;<?php echo $Language->Phrase("Of") ?>&nbsp;<?php echo $foxconninventory_list->Pager->RecordCount ?></span>
</div>
<?php } ?>
<?php if ($foxconninventory_list->TotalRecs > 0 && (!$foxconninventory_list->AutoHidePageSizeSelector || $foxconninventory_list->Pager->Visible)) { ?>
<div class="ew-pager">
<input type="hidden" name="t" value="foxconninventory">
<select name="<?php echo TABLE_REC_PER_PAGE ?>" class="form-control form-control-sm ew-tooltip" title="<?php echo $Language->phrase("RecordsPerPage") ?>" onchange="this.form.submit();">
<option value="20"<?php if ($foxconninventory_list->DisplayRecs == 20) { ?> selected<?php } ?>>20</option>
<option value="50"<?php if ($foxconninventory_list->DisplayRecs == 50) { ?> selected<?php } ?>>50</option>
<option value="100"<?php if ($foxconninventory_list->DisplayRecs == 100) { ?> selected<?php } ?>>100</option>
<option value="200"<?php if ($foxconninventory_list->DisplayRecs == 200) { ?> selected<?php } ?>>200</option>
<option value="500"<?php if ($foxconninventory_list->DisplayRecs == 500) { ?> selected<?php } ?>>500</option>
<option value="ALL"<?php if ($foxconninventory->getRecordsPerPage() == -1) { ?> selected<?php } ?>><?php echo $Language->Phrase("AllRecords") ?></option>
</select>
</div>
<?php } ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $foxconninventory_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
<form name="ffoxconninventorylist" id="ffoxconninventorylist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($foxconninventory_list->CheckToken) { ?>
<input type="hidden" name="<?php echo TOKEN_NAME ?>" value="<?php echo $foxconninventory_list->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="foxconninventory">
<div id="gmp_foxconninventory" class="<?php if (IsResponsiveLayout()) { ?>table-responsive <?php } ?>card-body ew-grid-middle-panel">
<?php if ($foxconninventory_list->TotalRecs > 0 || $foxconninventory->isGridEdit()) { ?>
<table id="tbl_foxconninventorylist" class="table ew-table"><!-- .ew-table ##-->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$foxconninventory_list->RowType = ROWTYPE_HEADER;

// Render list options
$foxconninventory_list->renderListOptions();

// Render list options (header, left)
$foxconninventory_list->ListOptions->render("header", "left");
?>
<?php if ($foxconninventory->Code->Visible) { // Code ?>
	<?php if ($foxconninventory->sortUrl($foxconninventory->Code) == "") { ?>
		<th data-name="Code" class="<?php echo $foxconninventory->Code->headerCellClass() ?>" style="white-space: nowrap;"><div id="elh_foxconninventory_Code" class="foxconninventory_Code"><div class="ew-table-header-caption"><?php echo $foxconninventory->Code->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Code" class="<?php echo $foxconninventory->Code->headerCellClass() ?>" style="white-space: nowrap;"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $foxconninventory->SortUrl($foxconninventory->Code) ?>',2);"><div id="elh_foxconninventory_Code" class="foxconninventory_Code">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $foxconninventory->Code->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($foxconninventory->Code->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($foxconninventory->Code->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($foxconninventory->ProductName->Visible) { // ProductName ?>
	<?php if ($foxconninventory->sortUrl($foxconninventory->ProductName) == "") { ?>
		<th data-name="ProductName" class="<?php echo $foxconninventory->ProductName->headerCellClass() ?>" style="white-space: nowrap;"><div id="elh_foxconninventory_ProductName" class="foxconninventory_ProductName"><div class="ew-table-header-caption"><?php echo $foxconninventory->ProductName->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="ProductName" class="<?php echo $foxconninventory->ProductName->headerCellClass() ?>" style="white-space: nowrap;"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $foxconninventory->SortUrl($foxconninventory->ProductName) ?>',2);"><div id="elh_foxconninventory_ProductName" class="foxconninventory_ProductName">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $foxconninventory->ProductName->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($foxconninventory->ProductName->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($foxconninventory->ProductName->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($foxconninventory->VnName->Visible) { // VnName ?>
	<?php if ($foxconninventory->sortUrl($foxconninventory->VnName) == "") { ?>
		<th data-name="VnName" class="<?php echo $foxconninventory->VnName->headerCellClass() ?>" style="white-space: nowrap;"><div id="elh_foxconninventory_VnName" class="foxconninventory_VnName"><div class="ew-table-header-caption"><?php echo $foxconninventory->VnName->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="VnName" class="<?php echo $foxconninventory->VnName->headerCellClass() ?>" style="white-space: nowrap;"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $foxconninventory->SortUrl($foxconninventory->VnName) ?>',2);"><div id="elh_foxconninventory_VnName" class="foxconninventory_VnName">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $foxconninventory->VnName->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($foxconninventory->VnName->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($foxconninventory->VnName->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($foxconninventory->Model->Visible) { // Model ?>
	<?php if ($foxconninventory->sortUrl($foxconninventory->Model) == "") { ?>
		<th data-name="Model" class="<?php echo $foxconninventory->Model->headerCellClass() ?>" style="white-space: nowrap;"><div id="elh_foxconninventory_Model" class="foxconninventory_Model"><div class="ew-table-header-caption"><?php echo $foxconninventory->Model->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Model" class="<?php echo $foxconninventory->Model->headerCellClass() ?>" style="white-space: nowrap;"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $foxconninventory->SortUrl($foxconninventory->Model) ?>',2);"><div id="elh_foxconninventory_Model" class="foxconninventory_Model">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $foxconninventory->Model->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($foxconninventory->Model->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($foxconninventory->Model->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($foxconninventory->PCS_IN->Visible) { // PCS_IN ?>
	<?php if ($foxconninventory->sortUrl($foxconninventory->PCS_IN) == "") { ?>
		<th data-name="PCS_IN" class="<?php echo $foxconninventory->PCS_IN->headerCellClass() ?>" style="white-space: nowrap;"><div id="elh_foxconninventory_PCS_IN" class="foxconninventory_PCS_IN"><div class="ew-table-header-caption"><?php echo $foxconninventory->PCS_IN->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="PCS_IN" class="<?php echo $foxconninventory->PCS_IN->headerCellClass() ?>" style="white-space: nowrap;"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $foxconninventory->SortUrl($foxconninventory->PCS_IN) ?>',2);"><div id="elh_foxconninventory_PCS_IN" class="foxconninventory_PCS_IN">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $foxconninventory->PCS_IN->caption() ?></span><span class="ew-table-header-sort"><?php if ($foxconninventory->PCS_IN->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($foxconninventory->PCS_IN->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($foxconninventory->PCS_OUT->Visible) { // PCS_OUT ?>
	<?php if ($foxconninventory->sortUrl($foxconninventory->PCS_OUT) == "") { ?>
		<th data-name="PCS_OUT" class="<?php echo $foxconninventory->PCS_OUT->headerCellClass() ?>" style="white-space: nowrap;"><div id="elh_foxconninventory_PCS_OUT" class="foxconninventory_PCS_OUT"><div class="ew-table-header-caption"><?php echo $foxconninventory->PCS_OUT->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="PCS_OUT" class="<?php echo $foxconninventory->PCS_OUT->headerCellClass() ?>" style="white-space: nowrap;"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $foxconninventory->SortUrl($foxconninventory->PCS_OUT) ?>',2);"><div id="elh_foxconninventory_PCS_OUT" class="foxconninventory_PCS_OUT">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $foxconninventory->PCS_OUT->caption() ?></span><span class="ew-table-header-sort"><?php if ($foxconninventory->PCS_OUT->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($foxconninventory->PCS_OUT->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($foxconninventory->PCS->Visible) { // PCS ?>
	<?php if ($foxconninventory->sortUrl($foxconninventory->PCS) == "") { ?>
		<th data-name="PCS" class="<?php echo $foxconninventory->PCS->headerCellClass() ?>" style="white-space: nowrap;"><div id="elh_foxconninventory_PCS" class="foxconninventory_PCS"><div class="ew-table-header-caption"><?php echo $foxconninventory->PCS->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="PCS" class="<?php echo $foxconninventory->PCS->headerCellClass() ?>" style="white-space: nowrap;"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $foxconninventory->SortUrl($foxconninventory->PCS) ?>',2);"><div id="elh_foxconninventory_PCS" class="foxconninventory_PCS">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $foxconninventory->PCS->caption() ?></span><span class="ew-table-header-sort"><?php if ($foxconninventory->PCS->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($foxconninventory->PCS->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$foxconninventory_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
if ($foxconninventory->ExportAll && $foxconninventory->isExport()) {
	$foxconninventory_list->StopRec = $foxconninventory_list->TotalRecs;
} else {

	// Set the last record to display
	if ($foxconninventory_list->TotalRecs > $foxconninventory_list->StartRec + $foxconninventory_list->DisplayRecs - 1)
		$foxconninventory_list->StopRec = $foxconninventory_list->StartRec + $foxconninventory_list->DisplayRecs - 1;
	else
		$foxconninventory_list->StopRec = $foxconninventory_list->TotalRecs;
}
$foxconninventory_list->RecCnt = $foxconninventory_list->StartRec - 1;
if ($foxconninventory_list->Recordset && !$foxconninventory_list->Recordset->EOF) {
	$foxconninventory_list->Recordset->moveFirst();
	$selectLimit = $foxconninventory_list->UseSelectLimit;
	if (!$selectLimit && $foxconninventory_list->StartRec > 1)
		$foxconninventory_list->Recordset->move($foxconninventory_list->StartRec - 1);
} elseif (!$foxconninventory->AllowAddDeleteRow && $foxconninventory_list->StopRec == 0) {
	$foxconninventory_list->StopRec = $foxconninventory->GridAddRowCount;
}

// Initialize aggregate
$foxconninventory->RowType = ROWTYPE_AGGREGATEINIT;
$foxconninventory->resetAttributes();
$foxconninventory_list->renderRow();
while ($foxconninventory_list->RecCnt < $foxconninventory_list->StopRec) {
	$foxconninventory_list->RecCnt++;
	if ($foxconninventory_list->RecCnt >= $foxconninventory_list->StartRec) {
		$foxconninventory_list->RowCnt++;

		// Set up key count
		$foxconninventory_list->KeyCount = $foxconninventory_list->RowIndex;

		// Init row class and style
		$foxconninventory->resetAttributes();
		$foxconninventory->CssClass = "";
		if ($foxconninventory->isGridAdd()) {
		} else {
			$foxconninventory_list->loadRowValues($foxconninventory_list->Recordset); // Load row values
		}
		$foxconninventory->RowType = ROWTYPE_VIEW; // Render view

		// Set up row id / data-rowindex
		$foxconninventory->RowAttrs = array_merge($foxconninventory->RowAttrs, array('data-rowindex'=>$foxconninventory_list->RowCnt, 'id'=>'r' . $foxconninventory_list->RowCnt . '_foxconninventory', 'data-rowtype'=>$foxconninventory->RowType));

		// Render row
		$foxconninventory_list->renderRow();

		// Render list options
		$foxconninventory_list->renderListOptions();
?>
	<tr<?php echo $foxconninventory->rowAttributes() ?>>
<?php

// Render list options (body, left)
$foxconninventory_list->ListOptions->render("body", "left", $foxconninventory_list->RowCnt);
?>
	<?php if ($foxconninventory->Code->Visible) { // Code ?>
		<td data-name="Code"<?php echo $foxconninventory->Code->cellAttributes() ?>>
<span id="el<?php echo $foxconninventory_list->RowCnt ?>_foxconninventory_Code" class="foxconninventory_Code">
<span<?php echo $foxconninventory->Code->viewAttributes() ?>>
<?php echo $foxconninventory->Code->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($foxconninventory->ProductName->Visible) { // ProductName ?>
		<td data-name="ProductName"<?php echo $foxconninventory->ProductName->cellAttributes() ?>>
<span id="el<?php echo $foxconninventory_list->RowCnt ?>_foxconninventory_ProductName" class="foxconninventory_ProductName">
<span<?php echo $foxconninventory->ProductName->viewAttributes() ?>>
<?php echo $foxconninventory->ProductName->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($foxconninventory->VnName->Visible) { // VnName ?>
		<td data-name="VnName"<?php echo $foxconninventory->VnName->cellAttributes() ?>>
<span id="el<?php echo $foxconninventory_list->RowCnt ?>_foxconninventory_VnName" class="foxconninventory_VnName">
<span<?php echo $foxconninventory->VnName->viewAttributes() ?>>
<?php echo $foxconninventory->VnName->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($foxconninventory->Model->Visible) { // Model ?>
		<td data-name="Model"<?php echo $foxconninventory->Model->cellAttributes() ?>>
<span id="el<?php echo $foxconninventory_list->RowCnt ?>_foxconninventory_Model" class="foxconninventory_Model">
<span<?php echo $foxconninventory->Model->viewAttributes() ?>>
<?php echo $foxconninventory->Model->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($foxconninventory->PCS_IN->Visible) { // PCS_IN ?>
		<td data-name="PCS_IN"<?php echo $foxconninventory->PCS_IN->cellAttributes() ?>>
<span id="el<?php echo $foxconninventory_list->RowCnt ?>_foxconninventory_PCS_IN" class="foxconninventory_PCS_IN">
<span<?php echo $foxconninventory->PCS_IN->viewAttributes() ?>>
<?php echo $foxconninventory->PCS_IN->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($foxconninventory->PCS_OUT->Visible) { // PCS_OUT ?>
		<td data-name="PCS_OUT"<?php echo $foxconninventory->PCS_OUT->cellAttributes() ?>>
<span id="el<?php echo $foxconninventory_list->RowCnt ?>_foxconninventory_PCS_OUT" class="foxconninventory_PCS_OUT">
<span<?php echo $foxconninventory->PCS_OUT->viewAttributes() ?>>
<?php echo $foxconninventory->PCS_OUT->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($foxconninventory->PCS->Visible) { // PCS ?>
		<td data-name="PCS"<?php echo $foxconninventory->PCS->cellAttributes() ?>>
<span id="el<?php echo $foxconninventory_list->RowCnt ?>_foxconninventory_PCS" class="foxconninventory_PCS">
<span<?php echo $foxconninventory->PCS->viewAttributes() ?>>
<?php echo $foxconninventory->PCS->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$foxconninventory_list->ListOptions->render("body", "right", $foxconninventory_list->RowCnt);
?>
	</tr>
<?php
	}
	if (!$foxconninventory->isGridAdd())
		$foxconninventory_list->Recordset->moveNext();
}
?>
</tbody>
<?php

// Render aggregate row
$foxconninventory->RowType = ROWTYPE_AGGREGATE;
$foxconninventory->resetAttributes();
$foxconninventory_list->renderRow();
?>
<?php if ($foxconninventory_list->TotalRecs > 0 && !$foxconninventory->isGridAdd() && !$foxconninventory->isGridEdit()) { ?>
<tfoot><!-- Table footer -->
	<tr class="ew-table-footer">
<?php

// Render list options
$foxconninventory_list->renderListOptions();

// Render list options (footer, left)
$foxconninventory_list->ListOptions->render("footer", "left");
?>
	<?php if ($foxconninventory->Code->Visible) { // Code ?>
		<td data-name="Code" class="<?php echo $foxconninventory->Code->footerCellClass() ?>"><span id="elf_foxconninventory_Code" class="foxconninventory_Code">
		&nbsp;
		</span></td>
	<?php } ?>
	<?php if ($foxconninventory->ProductName->Visible) { // ProductName ?>
		<td data-name="ProductName" class="<?php echo $foxconninventory->ProductName->footerCellClass() ?>"><span id="elf_foxconninventory_ProductName" class="foxconninventory_ProductName">
		&nbsp;
		</span></td>
	<?php } ?>
	<?php if ($foxconninventory->VnName->Visible) { // VnName ?>
		<td data-name="VnName" class="<?php echo $foxconninventory->VnName->footerCellClass() ?>"><span id="elf_foxconninventory_VnName" class="foxconninventory_VnName">
		&nbsp;
		</span></td>
	<?php } ?>
	<?php if ($foxconninventory->Model->Visible) { // Model ?>
		<td data-name="Model" class="<?php echo $foxconninventory->Model->footerCellClass() ?>"><span id="elf_foxconninventory_Model" class="foxconninventory_Model">
		&nbsp;
		</span></td>
	<?php } ?>
	<?php if ($foxconninventory->PCS_IN->Visible) { // PCS_IN ?>
		<td data-name="PCS_IN" class="<?php echo $foxconninventory->PCS_IN->footerCellClass() ?>"><span id="elf_foxconninventory_PCS_IN" class="foxconninventory_PCS_IN">
		<span class="ew-aggregate"><?php echo $Language->phrase("TOTAL") ?></span><span class="ew-aggregate-value">
		<?php echo $foxconninventory->PCS_IN->ViewValue ?></span>
		</span></td>
	<?php } ?>
	<?php if ($foxconninventory->PCS_OUT->Visible) { // PCS_OUT ?>
		<td data-name="PCS_OUT" class="<?php echo $foxconninventory->PCS_OUT->footerCellClass() ?>"><span id="elf_foxconninventory_PCS_OUT" class="foxconninventory_PCS_OUT">
		<span class="ew-aggregate"><?php echo $Language->phrase("TOTAL") ?></span><span class="ew-aggregate-value">
		<?php echo $foxconninventory->PCS_OUT->ViewValue ?></span>
		</span></td>
	<?php } ?>
	<?php if ($foxconninventory->PCS->Visible) { // PCS ?>
		<td data-name="PCS" class="<?php echo $foxconninventory->PCS->footerCellClass() ?>"><span id="elf_foxconninventory_PCS" class="foxconninventory_PCS">
		<span class="ew-aggregate"><?php echo $Language->phrase("TOTAL") ?></span><span class="ew-aggregate-value">
		<?php echo $foxconninventory->PCS->ViewValue ?></span>
		</span></td>
	<?php } ?>
<?php

// Render list options (footer, right)
$foxconninventory_list->ListOptions->render("footer", "right");
?>
	</tr>
</tfoot>
<?php } ?>
</table><!-- /.ew-table -->
<?php } ?>
<?php if (!$foxconninventory->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</div><!-- /.ew-grid-middle-panel -->
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($foxconninventory_list->Recordset)
	$foxconninventory_list->Recordset->Close();
?>
<?php if (!$foxconninventory->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$foxconninventory->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php if (!isset($foxconninventory_list->Pager)) $foxconninventory_list->Pager = new PrevNextPager($foxconninventory_list->StartRec, $foxconninventory_list->DisplayRecs, $foxconninventory_list->TotalRecs, $foxconninventory_list->AutoHidePager) ?>
<?php if ($foxconninventory_list->Pager->RecordCount > 0 && $foxconninventory_list->Pager->Visible) { ?>
<div class="ew-pager">
<span><?php echo $Language->Phrase("Page") ?>&nbsp;</span>
<div class="ew-prev-next"><div class="input-group input-group-sm">
<div class="input-group-prepend">
<!-- first page button -->
	<?php if ($foxconninventory_list->Pager->FirstButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerFirst") ?>" href="<?php echo $foxconninventory_list->pageUrl() ?>start=<?php echo $foxconninventory_list->Pager->FirstButton->Start ?>"><i class="icon-first ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerFirst") ?>"><i class="icon-first ew-icon"></i></a>
	<?php } ?>
<!-- previous page button -->
	<?php if ($foxconninventory_list->Pager->PrevButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerPrevious") ?>" href="<?php echo $foxconninventory_list->pageUrl() ?>start=<?php echo $foxconninventory_list->Pager->PrevButton->Start ?>"><i class="icon-prev ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerPrevious") ?>"><i class="icon-prev ew-icon"></i></a>
	<?php } ?>
</div>
<!-- current page number -->
	<input class="form-control" type="text" name="<?php echo TABLE_PAGE_NO ?>" value="<?php echo $foxconninventory_list->Pager->CurrentPage ?>">
<div class="input-group-append">
<!-- next page button -->
	<?php if ($foxconninventory_list->Pager->NextButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerNext") ?>" href="<?php echo $foxconninventory_list->pageUrl() ?>start=<?php echo $foxconninventory_list->Pager->NextButton->Start ?>"><i class="icon-next ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerNext") ?>"><i class="icon-next ew-icon"></i></a>
	<?php } ?>
<!-- last page button -->
	<?php if ($foxconninventory_list->Pager->LastButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerLast") ?>" href="<?php echo $foxconninventory_list->pageUrl() ?>start=<?php echo $foxconninventory_list->Pager->LastButton->Start ?>"><i class="icon-last ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerLast") ?>"><i class="icon-last ew-icon"></i></a>
	<?php } ?>
</div>
</div>
</div>
<span>&nbsp;<?php echo $Language->Phrase("of") ?>&nbsp;<?php echo $foxconninventory_list->Pager->PageCount ?></span>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php if ($foxconninventory_list->Pager->RecordCount > 0) { ?>
<div class="ew-pager ew-rec">
	<span><?php echo $Language->Phrase("Record") ?>&nbsp;<?php echo $foxconninventory_list->Pager->FromIndex ?>&nbsp;<?php echo $Language->Phrase("To") ?>&nbsp;<?php echo $foxconninventory_list->Pager->ToIndex ?>&nbsp;<?php echo $Language->Phrase("Of") ?>&nbsp;<?php echo $foxconninventory_list->Pager->RecordCount ?></span>
</div>
<?php } ?>
<?php if ($foxconninventory_list->TotalRecs > 0 && (!$foxconninventory_list->AutoHidePageSizeSelector || $foxconninventory_list->Pager->Visible)) { ?>
<div class="ew-pager">
<input type="hidden" name="t" value="foxconninventory">
<select name="<?php echo TABLE_REC_PER_PAGE ?>" class="form-control form-control-sm ew-tooltip" title="<?php echo $Language->phrase("RecordsPerPage") ?>" onchange="this.form.submit();">
<option value="20"<?php if ($foxconninventory_list->DisplayRecs == 20) { ?> selected<?php } ?>>20</option>
<option value="50"<?php if ($foxconninventory_list->DisplayRecs == 50) { ?> selected<?php } ?>>50</option>
<option value="100"<?php if ($foxconninventory_list->DisplayRecs == 100) { ?> selected<?php } ?>>100</option>
<option value="200"<?php if ($foxconninventory_list->DisplayRecs == 200) { ?> selected<?php } ?>>200</option>
<option value="500"<?php if ($foxconninventory_list->DisplayRecs == 500) { ?> selected<?php } ?>>500</option>
<option value="ALL"<?php if ($foxconninventory->getRecordsPerPage() == -1) { ?> selected<?php } ?>><?php echo $Language->Phrase("AllRecords") ?></option>
</select>
</div>
<?php } ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $foxconninventory_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($foxconninventory_list->TotalRecs == 0 && !$foxconninventory->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $foxconninventory_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$foxconninventory_list->showPageFooter();
if (DEBUG_ENABLED)
	echo GetDebugMessage();
?>
<?php if (!$foxconninventory->isExport()) { ?>
<script>

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php } ?>
<?php include_once "footer.php" ?>
<?php
$foxconninventory_list->terminate();
?>