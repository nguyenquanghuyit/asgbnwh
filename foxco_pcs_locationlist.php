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
$foxco_pcs_location_list = new foxco_pcs_location_list();

// Run the page
$foxco_pcs_location_list->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$foxco_pcs_location_list->Page_Render();
?>
<?php include_once "header.php" ?>
<?php if (!$foxco_pcs_location->isExport()) { ?>
<script>

// Form object
currentPageID = ew.PAGE_ID = "list";
var ffoxco_pcs_locationlist = currentForm = new ew.Form("ffoxco_pcs_locationlist", "list");
ffoxco_pcs_locationlist.formKeyCountName = '<?php echo $foxco_pcs_location_list->FormKeyCountName ?>';

// Form_CustomValidate event
ffoxco_pcs_locationlist.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

	// Your custom validation code here, return false if invalid.
	return true;
}

// Use JavaScript validation or not
ffoxco_pcs_locationlist.validateRequired = <?php echo json_encode(CLIENT_VALIDATE) ?>;

// Dynamic selection lists
// Form object for search

var ffoxco_pcs_locationlistsrch = currentSearchForm = new ew.Form("ffoxco_pcs_locationlistsrch");

// Filters
ffoxco_pcs_locationlistsrch.filterList = <?php echo $foxco_pcs_location_list->getFilterList() ?>;
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
<?php if (!$foxco_pcs_location->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($foxco_pcs_location_list->TotalRecs > 0 && $foxco_pcs_location_list->ExportOptions->visible()) { ?>
<?php $foxco_pcs_location_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($foxco_pcs_location_list->ImportOptions->visible()) { ?>
<?php $foxco_pcs_location_list->ImportOptions->render("body") ?>
<?php } ?>
<?php if ($foxco_pcs_location_list->SearchOptions->visible()) { ?>
<?php $foxco_pcs_location_list->SearchOptions->render("body") ?>
<?php } ?>
<?php if ($foxco_pcs_location_list->FilterOptions->visible()) { ?>
<?php $foxco_pcs_location_list->FilterOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php
$foxco_pcs_location_list->renderOtherOptions();
?>
<?php if ($Security->CanSearch()) { ?>
<?php if (!$foxco_pcs_location->isExport() && !$foxco_pcs_location->CurrentAction) { ?>
<form name="ffoxco_pcs_locationlistsrch" id="ffoxco_pcs_locationlistsrch" class="form-inline ew-form ew-ext-search-form" action="<?php echo CurrentPageName() ?>">
<?php $searchPanelClass = ($foxco_pcs_location_list->SearchWhere <> "") ? " show" : " show"; ?>
<div id="ffoxco_pcs_locationlistsrch-search-panel" class="ew-search-panel collapse<?php echo $searchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="foxco_pcs_location">
	<div class="ew-basic-search">
<div id="xsr_1" class="ew-row d-sm-flex">
	<div class="ew-quick-search input-group">
		<input type="text" name="<?php echo TABLE_BASIC_SEARCH ?>" id="<?php echo TABLE_BASIC_SEARCH ?>" class="form-control" value="<?php echo HtmlEncode($foxco_pcs_location_list->BasicSearch->getKeyword()) ?>" placeholder="<?php echo HtmlEncode($Language->phrase("Search")) ?>">
		<input type="hidden" name="<?php echo TABLE_BASIC_SEARCH_TYPE ?>" id="<?php echo TABLE_BASIC_SEARCH_TYPE ?>" value="<?php echo HtmlEncode($foxco_pcs_location_list->BasicSearch->getType()) ?>">
		<div class="input-group-append">
			<button class="btn btn-primary" name="btn-submit" id="btn-submit" type="submit"><?php echo $Language->phrase("SearchBtn") ?></button>
			<button type="button" data-toggle="dropdown" class="btn btn-primary dropdown-toggle dropdown-toggle-split" aria-haspopup="true" aria-expanded="false"><span id="searchtype"><?php echo $foxco_pcs_location_list->BasicSearch->getTypeNameShort() ?></span></button>
			<div class="dropdown-menu dropdown-menu-right">
				<a class="dropdown-item<?php if ($foxco_pcs_location_list->BasicSearch->getType() == "") echo " active"; ?>" href="javascript:void(0);" onclick="ew.setSearchType(this)"><?php echo $Language->phrase("QuickSearchAuto") ?></a>
				<a class="dropdown-item<?php if ($foxco_pcs_location_list->BasicSearch->getType() == "=") echo " active"; ?>" href="javascript:void(0);" onclick="ew.setSearchType(this,'=')"><?php echo $Language->phrase("QuickSearchExact") ?></a>
				<a class="dropdown-item<?php if ($foxco_pcs_location_list->BasicSearch->getType() == "AND") echo " active"; ?>" href="javascript:void(0);" onclick="ew.setSearchType(this,'AND')"><?php echo $Language->phrase("QuickSearchAll") ?></a>
				<a class="dropdown-item<?php if ($foxco_pcs_location_list->BasicSearch->getType() == "OR") echo " active"; ?>" href="javascript:void(0);" onclick="ew.setSearchType(this,'OR')"><?php echo $Language->phrase("QuickSearchAny") ?></a>
			</div>
		</div>
	</div>
</div>
	</div>
</div>
</form>
<?php } ?>
<?php } ?>
<?php $foxco_pcs_location_list->showPageHeader(); ?>
<?php
$foxco_pcs_location_list->showMessage();
?>
<?php if ($foxco_pcs_location_list->TotalRecs > 0 || $foxco_pcs_location->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($foxco_pcs_location_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> foxco_pcs_location">
<?php if (!$foxco_pcs_location->isExport()) { ?>
<div class="card-header ew-grid-upper-panel">
<?php if (!$foxco_pcs_location->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php if (!isset($foxco_pcs_location_list->Pager)) $foxco_pcs_location_list->Pager = new PrevNextPager($foxco_pcs_location_list->StartRec, $foxco_pcs_location_list->DisplayRecs, $foxco_pcs_location_list->TotalRecs, $foxco_pcs_location_list->AutoHidePager) ?>
<?php if ($foxco_pcs_location_list->Pager->RecordCount > 0 && $foxco_pcs_location_list->Pager->Visible) { ?>
<div class="ew-pager">
<span><?php echo $Language->Phrase("Page") ?>&nbsp;</span>
<div class="ew-prev-next"><div class="input-group input-group-sm">
<div class="input-group-prepend">
<!-- first page button -->
	<?php if ($foxco_pcs_location_list->Pager->FirstButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerFirst") ?>" href="<?php echo $foxco_pcs_location_list->pageUrl() ?>start=<?php echo $foxco_pcs_location_list->Pager->FirstButton->Start ?>"><i class="icon-first ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerFirst") ?>"><i class="icon-first ew-icon"></i></a>
	<?php } ?>
<!-- previous page button -->
	<?php if ($foxco_pcs_location_list->Pager->PrevButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerPrevious") ?>" href="<?php echo $foxco_pcs_location_list->pageUrl() ?>start=<?php echo $foxco_pcs_location_list->Pager->PrevButton->Start ?>"><i class="icon-prev ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerPrevious") ?>"><i class="icon-prev ew-icon"></i></a>
	<?php } ?>
</div>
<!-- current page number -->
	<input class="form-control" type="text" name="<?php echo TABLE_PAGE_NO ?>" value="<?php echo $foxco_pcs_location_list->Pager->CurrentPage ?>">
<div class="input-group-append">
<!-- next page button -->
	<?php if ($foxco_pcs_location_list->Pager->NextButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerNext") ?>" href="<?php echo $foxco_pcs_location_list->pageUrl() ?>start=<?php echo $foxco_pcs_location_list->Pager->NextButton->Start ?>"><i class="icon-next ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerNext") ?>"><i class="icon-next ew-icon"></i></a>
	<?php } ?>
<!-- last page button -->
	<?php if ($foxco_pcs_location_list->Pager->LastButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerLast") ?>" href="<?php echo $foxco_pcs_location_list->pageUrl() ?>start=<?php echo $foxco_pcs_location_list->Pager->LastButton->Start ?>"><i class="icon-last ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerLast") ?>"><i class="icon-last ew-icon"></i></a>
	<?php } ?>
</div>
</div>
</div>
<span>&nbsp;<?php echo $Language->Phrase("of") ?>&nbsp;<?php echo $foxco_pcs_location_list->Pager->PageCount ?></span>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php if ($foxco_pcs_location_list->Pager->RecordCount > 0) { ?>
<div class="ew-pager ew-rec">
	<span><?php echo $Language->Phrase("Record") ?>&nbsp;<?php echo $foxco_pcs_location_list->Pager->FromIndex ?>&nbsp;<?php echo $Language->Phrase("To") ?>&nbsp;<?php echo $foxco_pcs_location_list->Pager->ToIndex ?>&nbsp;<?php echo $Language->Phrase("Of") ?>&nbsp;<?php echo $foxco_pcs_location_list->Pager->RecordCount ?></span>
</div>
<?php } ?>
<?php if ($foxco_pcs_location_list->TotalRecs > 0 && (!$foxco_pcs_location_list->AutoHidePageSizeSelector || $foxco_pcs_location_list->Pager->Visible)) { ?>
<div class="ew-pager">
<input type="hidden" name="t" value="foxco_pcs_location">
<select name="<?php echo TABLE_REC_PER_PAGE ?>" class="form-control form-control-sm ew-tooltip" title="<?php echo $Language->phrase("RecordsPerPage") ?>" onchange="this.form.submit();">
<option value="20"<?php if ($foxco_pcs_location_list->DisplayRecs == 20) { ?> selected<?php } ?>>20</option>
<option value="50"<?php if ($foxco_pcs_location_list->DisplayRecs == 50) { ?> selected<?php } ?>>50</option>
<option value="100"<?php if ($foxco_pcs_location_list->DisplayRecs == 100) { ?> selected<?php } ?>>100</option>
<option value="200"<?php if ($foxco_pcs_location_list->DisplayRecs == 200) { ?> selected<?php } ?>>200</option>
<option value="500"<?php if ($foxco_pcs_location_list->DisplayRecs == 500) { ?> selected<?php } ?>>500</option>
<option value="ALL"<?php if ($foxco_pcs_location->getRecordsPerPage() == -1) { ?> selected<?php } ?>><?php echo $Language->Phrase("AllRecords") ?></option>
</select>
</div>
<?php } ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $foxco_pcs_location_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
<form name="ffoxco_pcs_locationlist" id="ffoxco_pcs_locationlist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($foxco_pcs_location_list->CheckToken) { ?>
<input type="hidden" name="<?php echo TOKEN_NAME ?>" value="<?php echo $foxco_pcs_location_list->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="foxco_pcs_location">
<div id="gmp_foxco_pcs_location" class="<?php if (IsResponsiveLayout()) { ?>table-responsive <?php } ?>card-body ew-grid-middle-panel">
<?php if ($foxco_pcs_location_list->TotalRecs > 0 || $foxco_pcs_location->isGridEdit()) { ?>
<table id="tbl_foxco_pcs_locationlist" class="table ew-table"><!-- .ew-table ##-->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$foxco_pcs_location_list->RowType = ROWTYPE_HEADER;

// Render list options
$foxco_pcs_location_list->renderListOptions();

// Render list options (header, left)
$foxco_pcs_location_list->ListOptions->render("header", "left");
?>
<?php if ($foxco_pcs_location->Location->Visible) { // Location ?>
	<?php if ($foxco_pcs_location->sortUrl($foxco_pcs_location->Location) == "") { ?>
		<th data-name="Location" class="<?php echo $foxco_pcs_location->Location->headerCellClass() ?>" style="white-space: nowrap;"><div id="elh_foxco_pcs_location_Location" class="foxco_pcs_location_Location"><div class="ew-table-header-caption"><?php echo $foxco_pcs_location->Location->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Location" class="<?php echo $foxco_pcs_location->Location->headerCellClass() ?>" style="white-space: nowrap;"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $foxco_pcs_location->SortUrl($foxco_pcs_location->Location) ?>',2);"><div id="elh_foxco_pcs_location_Location" class="foxco_pcs_location_Location">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $foxco_pcs_location->Location->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($foxco_pcs_location->Location->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($foxco_pcs_location->Location->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($foxco_pcs_location->Code->Visible) { // Code ?>
	<?php if ($foxco_pcs_location->sortUrl($foxco_pcs_location->Code) == "") { ?>
		<th data-name="Code" class="<?php echo $foxco_pcs_location->Code->headerCellClass() ?>" style="white-space: nowrap;"><div id="elh_foxco_pcs_location_Code" class="foxco_pcs_location_Code"><div class="ew-table-header-caption"><?php echo $foxco_pcs_location->Code->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Code" class="<?php echo $foxco_pcs_location->Code->headerCellClass() ?>" style="white-space: nowrap;"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $foxco_pcs_location->SortUrl($foxco_pcs_location->Code) ?>',2);"><div id="elh_foxco_pcs_location_Code" class="foxco_pcs_location_Code">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $foxco_pcs_location->Code->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($foxco_pcs_location->Code->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($foxco_pcs_location->Code->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($foxco_pcs_location->ProductName->Visible) { // ProductName ?>
	<?php if ($foxco_pcs_location->sortUrl($foxco_pcs_location->ProductName) == "") { ?>
		<th data-name="ProductName" class="<?php echo $foxco_pcs_location->ProductName->headerCellClass() ?>" style="white-space: nowrap;"><div id="elh_foxco_pcs_location_ProductName" class="foxco_pcs_location_ProductName"><div class="ew-table-header-caption"><?php echo $foxco_pcs_location->ProductName->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="ProductName" class="<?php echo $foxco_pcs_location->ProductName->headerCellClass() ?>" style="white-space: nowrap;"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $foxco_pcs_location->SortUrl($foxco_pcs_location->ProductName) ?>',2);"><div id="elh_foxco_pcs_location_ProductName" class="foxco_pcs_location_ProductName">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $foxco_pcs_location->ProductName->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($foxco_pcs_location->ProductName->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($foxco_pcs_location->ProductName->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($foxco_pcs_location->Model->Visible) { // Model ?>
	<?php if ($foxco_pcs_location->sortUrl($foxco_pcs_location->Model) == "") { ?>
		<th data-name="Model" class="<?php echo $foxco_pcs_location->Model->headerCellClass() ?>" style="white-space: nowrap;"><div id="elh_foxco_pcs_location_Model" class="foxco_pcs_location_Model"><div class="ew-table-header-caption"><?php echo $foxco_pcs_location->Model->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Model" class="<?php echo $foxco_pcs_location->Model->headerCellClass() ?>" style="white-space: nowrap;"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $foxco_pcs_location->SortUrl($foxco_pcs_location->Model) ?>',2);"><div id="elh_foxco_pcs_location_Model" class="foxco_pcs_location_Model">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $foxco_pcs_location->Model->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($foxco_pcs_location->Model->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($foxco_pcs_location->Model->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($foxco_pcs_location->PCS->Visible) { // PCS ?>
	<?php if ($foxco_pcs_location->sortUrl($foxco_pcs_location->PCS) == "") { ?>
		<th data-name="PCS" class="<?php echo $foxco_pcs_location->PCS->headerCellClass() ?>" style="white-space: nowrap;"><div id="elh_foxco_pcs_location_PCS" class="foxco_pcs_location_PCS"><div class="ew-table-header-caption"><?php echo $foxco_pcs_location->PCS->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="PCS" class="<?php echo $foxco_pcs_location->PCS->headerCellClass() ?>" style="white-space: nowrap;"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $foxco_pcs_location->SortUrl($foxco_pcs_location->PCS) ?>',2);"><div id="elh_foxco_pcs_location_PCS" class="foxco_pcs_location_PCS">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $foxco_pcs_location->PCS->caption() ?></span><span class="ew-table-header-sort"><?php if ($foxco_pcs_location->PCS->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($foxco_pcs_location->PCS->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$foxco_pcs_location_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
if ($foxco_pcs_location->ExportAll && $foxco_pcs_location->isExport()) {
	$foxco_pcs_location_list->StopRec = $foxco_pcs_location_list->TotalRecs;
} else {

	// Set the last record to display
	if ($foxco_pcs_location_list->TotalRecs > $foxco_pcs_location_list->StartRec + $foxco_pcs_location_list->DisplayRecs - 1)
		$foxco_pcs_location_list->StopRec = $foxco_pcs_location_list->StartRec + $foxco_pcs_location_list->DisplayRecs - 1;
	else
		$foxco_pcs_location_list->StopRec = $foxco_pcs_location_list->TotalRecs;
}
$foxco_pcs_location_list->RecCnt = $foxco_pcs_location_list->StartRec - 1;
if ($foxco_pcs_location_list->Recordset && !$foxco_pcs_location_list->Recordset->EOF) {
	$foxco_pcs_location_list->Recordset->moveFirst();
	$selectLimit = $foxco_pcs_location_list->UseSelectLimit;
	if (!$selectLimit && $foxco_pcs_location_list->StartRec > 1)
		$foxco_pcs_location_list->Recordset->move($foxco_pcs_location_list->StartRec - 1);
} elseif (!$foxco_pcs_location->AllowAddDeleteRow && $foxco_pcs_location_list->StopRec == 0) {
	$foxco_pcs_location_list->StopRec = $foxco_pcs_location->GridAddRowCount;
}

// Initialize aggregate
$foxco_pcs_location->RowType = ROWTYPE_AGGREGATEINIT;
$foxco_pcs_location->resetAttributes();
$foxco_pcs_location_list->renderRow();
while ($foxco_pcs_location_list->RecCnt < $foxco_pcs_location_list->StopRec) {
	$foxco_pcs_location_list->RecCnt++;
	if ($foxco_pcs_location_list->RecCnt >= $foxco_pcs_location_list->StartRec) {
		$foxco_pcs_location_list->RowCnt++;

		// Set up key count
		$foxco_pcs_location_list->KeyCount = $foxco_pcs_location_list->RowIndex;

		// Init row class and style
		$foxco_pcs_location->resetAttributes();
		$foxco_pcs_location->CssClass = "";
		if ($foxco_pcs_location->isGridAdd()) {
		} else {
			$foxco_pcs_location_list->loadRowValues($foxco_pcs_location_list->Recordset); // Load row values
		}
		$foxco_pcs_location->RowType = ROWTYPE_VIEW; // Render view

		// Set up row id / data-rowindex
		$foxco_pcs_location->RowAttrs = array_merge($foxco_pcs_location->RowAttrs, array('data-rowindex'=>$foxco_pcs_location_list->RowCnt, 'id'=>'r' . $foxco_pcs_location_list->RowCnt . '_foxco_pcs_location', 'data-rowtype'=>$foxco_pcs_location->RowType));

		// Render row
		$foxco_pcs_location_list->renderRow();

		// Render list options
		$foxco_pcs_location_list->renderListOptions();
?>
	<tr<?php echo $foxco_pcs_location->rowAttributes() ?>>
<?php

// Render list options (body, left)
$foxco_pcs_location_list->ListOptions->render("body", "left", $foxco_pcs_location_list->RowCnt);
?>
	<?php if ($foxco_pcs_location->Location->Visible) { // Location ?>
		<td data-name="Location"<?php echo $foxco_pcs_location->Location->cellAttributes() ?>>
<span id="el<?php echo $foxco_pcs_location_list->RowCnt ?>_foxco_pcs_location_Location" class="foxco_pcs_location_Location">
<span<?php echo $foxco_pcs_location->Location->viewAttributes() ?>>
<?php echo $foxco_pcs_location->Location->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($foxco_pcs_location->Code->Visible) { // Code ?>
		<td data-name="Code"<?php echo $foxco_pcs_location->Code->cellAttributes() ?>>
<span id="el<?php echo $foxco_pcs_location_list->RowCnt ?>_foxco_pcs_location_Code" class="foxco_pcs_location_Code">
<span<?php echo $foxco_pcs_location->Code->viewAttributes() ?>>
<?php echo $foxco_pcs_location->Code->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($foxco_pcs_location->ProductName->Visible) { // ProductName ?>
		<td data-name="ProductName"<?php echo $foxco_pcs_location->ProductName->cellAttributes() ?>>
<span id="el<?php echo $foxco_pcs_location_list->RowCnt ?>_foxco_pcs_location_ProductName" class="foxco_pcs_location_ProductName">
<span<?php echo $foxco_pcs_location->ProductName->viewAttributes() ?>>
<?php echo $foxco_pcs_location->ProductName->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($foxco_pcs_location->Model->Visible) { // Model ?>
		<td data-name="Model"<?php echo $foxco_pcs_location->Model->cellAttributes() ?>>
<span id="el<?php echo $foxco_pcs_location_list->RowCnt ?>_foxco_pcs_location_Model" class="foxco_pcs_location_Model">
<span<?php echo $foxco_pcs_location->Model->viewAttributes() ?>>
<?php echo $foxco_pcs_location->Model->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($foxco_pcs_location->PCS->Visible) { // PCS ?>
		<td data-name="PCS"<?php echo $foxco_pcs_location->PCS->cellAttributes() ?>>
<span id="el<?php echo $foxco_pcs_location_list->RowCnt ?>_foxco_pcs_location_PCS" class="foxco_pcs_location_PCS">
<span<?php echo $foxco_pcs_location->PCS->viewAttributes() ?>>
<?php echo $foxco_pcs_location->PCS->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$foxco_pcs_location_list->ListOptions->render("body", "right", $foxco_pcs_location_list->RowCnt);
?>
	</tr>
<?php
	}
	if (!$foxco_pcs_location->isGridAdd())
		$foxco_pcs_location_list->Recordset->moveNext();
}
?>
</tbody>
<?php

// Render aggregate row
$foxco_pcs_location->RowType = ROWTYPE_AGGREGATE;
$foxco_pcs_location->resetAttributes();
$foxco_pcs_location_list->renderRow();
?>
<?php if ($foxco_pcs_location_list->TotalRecs > 0 && !$foxco_pcs_location->isGridAdd() && !$foxco_pcs_location->isGridEdit()) { ?>
<tfoot><!-- Table footer -->
	<tr class="ew-table-footer">
<?php

// Render list options
$foxco_pcs_location_list->renderListOptions();

// Render list options (footer, left)
$foxco_pcs_location_list->ListOptions->render("footer", "left");
?>
	<?php if ($foxco_pcs_location->Location->Visible) { // Location ?>
		<td data-name="Location" class="<?php echo $foxco_pcs_location->Location->footerCellClass() ?>"><span id="elf_foxco_pcs_location_Location" class="foxco_pcs_location_Location">
		&nbsp;
		</span></td>
	<?php } ?>
	<?php if ($foxco_pcs_location->Code->Visible) { // Code ?>
		<td data-name="Code" class="<?php echo $foxco_pcs_location->Code->footerCellClass() ?>"><span id="elf_foxco_pcs_location_Code" class="foxco_pcs_location_Code">
		&nbsp;
		</span></td>
	<?php } ?>
	<?php if ($foxco_pcs_location->ProductName->Visible) { // ProductName ?>
		<td data-name="ProductName" class="<?php echo $foxco_pcs_location->ProductName->footerCellClass() ?>"><span id="elf_foxco_pcs_location_ProductName" class="foxco_pcs_location_ProductName">
		&nbsp;
		</span></td>
	<?php } ?>
	<?php if ($foxco_pcs_location->Model->Visible) { // Model ?>
		<td data-name="Model" class="<?php echo $foxco_pcs_location->Model->footerCellClass() ?>"><span id="elf_foxco_pcs_location_Model" class="foxco_pcs_location_Model">
		&nbsp;
		</span></td>
	<?php } ?>
	<?php if ($foxco_pcs_location->PCS->Visible) { // PCS ?>
		<td data-name="PCS" class="<?php echo $foxco_pcs_location->PCS->footerCellClass() ?>"><span id="elf_foxco_pcs_location_PCS" class="foxco_pcs_location_PCS">
		<span class="ew-aggregate"><?php echo $Language->phrase("TOTAL") ?></span><span class="ew-aggregate-value">
		<?php echo $foxco_pcs_location->PCS->ViewValue ?></span>
		</span></td>
	<?php } ?>
<?php

// Render list options (footer, right)
$foxco_pcs_location_list->ListOptions->render("footer", "right");
?>
	</tr>
</tfoot>
<?php } ?>
</table><!-- /.ew-table -->
<?php } ?>
<?php if (!$foxco_pcs_location->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</div><!-- /.ew-grid-middle-panel -->
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($foxco_pcs_location_list->Recordset)
	$foxco_pcs_location_list->Recordset->Close();
?>
<?php if (!$foxco_pcs_location->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$foxco_pcs_location->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php if (!isset($foxco_pcs_location_list->Pager)) $foxco_pcs_location_list->Pager = new PrevNextPager($foxco_pcs_location_list->StartRec, $foxco_pcs_location_list->DisplayRecs, $foxco_pcs_location_list->TotalRecs, $foxco_pcs_location_list->AutoHidePager) ?>
<?php if ($foxco_pcs_location_list->Pager->RecordCount > 0 && $foxco_pcs_location_list->Pager->Visible) { ?>
<div class="ew-pager">
<span><?php echo $Language->Phrase("Page") ?>&nbsp;</span>
<div class="ew-prev-next"><div class="input-group input-group-sm">
<div class="input-group-prepend">
<!-- first page button -->
	<?php if ($foxco_pcs_location_list->Pager->FirstButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerFirst") ?>" href="<?php echo $foxco_pcs_location_list->pageUrl() ?>start=<?php echo $foxco_pcs_location_list->Pager->FirstButton->Start ?>"><i class="icon-first ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerFirst") ?>"><i class="icon-first ew-icon"></i></a>
	<?php } ?>
<!-- previous page button -->
	<?php if ($foxco_pcs_location_list->Pager->PrevButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerPrevious") ?>" href="<?php echo $foxco_pcs_location_list->pageUrl() ?>start=<?php echo $foxco_pcs_location_list->Pager->PrevButton->Start ?>"><i class="icon-prev ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerPrevious") ?>"><i class="icon-prev ew-icon"></i></a>
	<?php } ?>
</div>
<!-- current page number -->
	<input class="form-control" type="text" name="<?php echo TABLE_PAGE_NO ?>" value="<?php echo $foxco_pcs_location_list->Pager->CurrentPage ?>">
<div class="input-group-append">
<!-- next page button -->
	<?php if ($foxco_pcs_location_list->Pager->NextButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerNext") ?>" href="<?php echo $foxco_pcs_location_list->pageUrl() ?>start=<?php echo $foxco_pcs_location_list->Pager->NextButton->Start ?>"><i class="icon-next ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerNext") ?>"><i class="icon-next ew-icon"></i></a>
	<?php } ?>
<!-- last page button -->
	<?php if ($foxco_pcs_location_list->Pager->LastButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerLast") ?>" href="<?php echo $foxco_pcs_location_list->pageUrl() ?>start=<?php echo $foxco_pcs_location_list->Pager->LastButton->Start ?>"><i class="icon-last ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerLast") ?>"><i class="icon-last ew-icon"></i></a>
	<?php } ?>
</div>
</div>
</div>
<span>&nbsp;<?php echo $Language->Phrase("of") ?>&nbsp;<?php echo $foxco_pcs_location_list->Pager->PageCount ?></span>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php if ($foxco_pcs_location_list->Pager->RecordCount > 0) { ?>
<div class="ew-pager ew-rec">
	<span><?php echo $Language->Phrase("Record") ?>&nbsp;<?php echo $foxco_pcs_location_list->Pager->FromIndex ?>&nbsp;<?php echo $Language->Phrase("To") ?>&nbsp;<?php echo $foxco_pcs_location_list->Pager->ToIndex ?>&nbsp;<?php echo $Language->Phrase("Of") ?>&nbsp;<?php echo $foxco_pcs_location_list->Pager->RecordCount ?></span>
</div>
<?php } ?>
<?php if ($foxco_pcs_location_list->TotalRecs > 0 && (!$foxco_pcs_location_list->AutoHidePageSizeSelector || $foxco_pcs_location_list->Pager->Visible)) { ?>
<div class="ew-pager">
<input type="hidden" name="t" value="foxco_pcs_location">
<select name="<?php echo TABLE_REC_PER_PAGE ?>" class="form-control form-control-sm ew-tooltip" title="<?php echo $Language->phrase("RecordsPerPage") ?>" onchange="this.form.submit();">
<option value="20"<?php if ($foxco_pcs_location_list->DisplayRecs == 20) { ?> selected<?php } ?>>20</option>
<option value="50"<?php if ($foxco_pcs_location_list->DisplayRecs == 50) { ?> selected<?php } ?>>50</option>
<option value="100"<?php if ($foxco_pcs_location_list->DisplayRecs == 100) { ?> selected<?php } ?>>100</option>
<option value="200"<?php if ($foxco_pcs_location_list->DisplayRecs == 200) { ?> selected<?php } ?>>200</option>
<option value="500"<?php if ($foxco_pcs_location_list->DisplayRecs == 500) { ?> selected<?php } ?>>500</option>
<option value="ALL"<?php if ($foxco_pcs_location->getRecordsPerPage() == -1) { ?> selected<?php } ?>><?php echo $Language->Phrase("AllRecords") ?></option>
</select>
</div>
<?php } ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $foxco_pcs_location_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($foxco_pcs_location_list->TotalRecs == 0 && !$foxco_pcs_location->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $foxco_pcs_location_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$foxco_pcs_location_list->showPageFooter();
if (DEBUG_ENABLED)
	echo GetDebugMessage();
?>
<?php if (!$foxco_pcs_location->isExport()) { ?>
<script>

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php } ?>
<?php include_once "footer.php" ?>
<?php
$foxco_pcs_location_list->terminate();
?>