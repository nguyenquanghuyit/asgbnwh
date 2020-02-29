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
$spica_pcs_location_list = new spica_pcs_location_list();

// Run the page
$spica_pcs_location_list->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$spica_pcs_location_list->Page_Render();
?>
<?php include_once "header.php" ?>
<?php if (!$spica_pcs_location->isExport()) { ?>
<script>

// Form object
currentPageID = ew.PAGE_ID = "list";
var fspica_pcs_locationlist = currentForm = new ew.Form("fspica_pcs_locationlist", "list");
fspica_pcs_locationlist.formKeyCountName = '<?php echo $spica_pcs_location_list->FormKeyCountName ?>';

// Form_CustomValidate event
fspica_pcs_locationlist.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

	// Your custom validation code here, return false if invalid.
	return true;
}

// Use JavaScript validation or not
fspica_pcs_locationlist.validateRequired = <?php echo json_encode(CLIENT_VALIDATE) ?>;

// Dynamic selection lists
// Form object for search

var fspica_pcs_locationlistsrch = currentSearchForm = new ew.Form("fspica_pcs_locationlistsrch");

// Filters
fspica_pcs_locationlistsrch.filterList = <?php echo $spica_pcs_location_list->getFilterList() ?>;
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
<?php if (!$spica_pcs_location->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($spica_pcs_location_list->TotalRecs > 0 && $spica_pcs_location_list->ExportOptions->visible()) { ?>
<?php $spica_pcs_location_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($spica_pcs_location_list->ImportOptions->visible()) { ?>
<?php $spica_pcs_location_list->ImportOptions->render("body") ?>
<?php } ?>
<?php if ($spica_pcs_location_list->SearchOptions->visible()) { ?>
<?php $spica_pcs_location_list->SearchOptions->render("body") ?>
<?php } ?>
<?php if ($spica_pcs_location_list->FilterOptions->visible()) { ?>
<?php $spica_pcs_location_list->FilterOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php
$spica_pcs_location_list->renderOtherOptions();
?>
<?php if ($Security->CanSearch()) { ?>
<?php if (!$spica_pcs_location->isExport() && !$spica_pcs_location->CurrentAction) { ?>
<form name="fspica_pcs_locationlistsrch" id="fspica_pcs_locationlistsrch" class="form-inline ew-form ew-ext-search-form" action="<?php echo CurrentPageName() ?>">
<?php $searchPanelClass = ($spica_pcs_location_list->SearchWhere <> "") ? " show" : " show"; ?>
<div id="fspica_pcs_locationlistsrch-search-panel" class="ew-search-panel collapse<?php echo $searchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="spica_pcs_location">
	<div class="ew-basic-search">
<div id="xsr_1" class="ew-row d-sm-flex">
	<div class="ew-quick-search input-group">
		<input type="text" name="<?php echo TABLE_BASIC_SEARCH ?>" id="<?php echo TABLE_BASIC_SEARCH ?>" class="form-control" value="<?php echo HtmlEncode($spica_pcs_location_list->BasicSearch->getKeyword()) ?>" placeholder="<?php echo HtmlEncode($Language->phrase("Search")) ?>">
		<input type="hidden" name="<?php echo TABLE_BASIC_SEARCH_TYPE ?>" id="<?php echo TABLE_BASIC_SEARCH_TYPE ?>" value="<?php echo HtmlEncode($spica_pcs_location_list->BasicSearch->getType()) ?>">
		<div class="input-group-append">
			<button class="btn btn-primary" name="btn-submit" id="btn-submit" type="submit"><?php echo $Language->phrase("SearchBtn") ?></button>
			<button type="button" data-toggle="dropdown" class="btn btn-primary dropdown-toggle dropdown-toggle-split" aria-haspopup="true" aria-expanded="false"><span id="searchtype"><?php echo $spica_pcs_location_list->BasicSearch->getTypeNameShort() ?></span></button>
			<div class="dropdown-menu dropdown-menu-right">
				<a class="dropdown-item<?php if ($spica_pcs_location_list->BasicSearch->getType() == "") echo " active"; ?>" href="javascript:void(0);" onclick="ew.setSearchType(this)"><?php echo $Language->phrase("QuickSearchAuto") ?></a>
				<a class="dropdown-item<?php if ($spica_pcs_location_list->BasicSearch->getType() == "=") echo " active"; ?>" href="javascript:void(0);" onclick="ew.setSearchType(this,'=')"><?php echo $Language->phrase("QuickSearchExact") ?></a>
				<a class="dropdown-item<?php if ($spica_pcs_location_list->BasicSearch->getType() == "AND") echo " active"; ?>" href="javascript:void(0);" onclick="ew.setSearchType(this,'AND')"><?php echo $Language->phrase("QuickSearchAll") ?></a>
				<a class="dropdown-item<?php if ($spica_pcs_location_list->BasicSearch->getType() == "OR") echo " active"; ?>" href="javascript:void(0);" onclick="ew.setSearchType(this,'OR')"><?php echo $Language->phrase("QuickSearchAny") ?></a>
			</div>
		</div>
	</div>
</div>
	</div>
</div>
</form>
<?php } ?>
<?php } ?>
<?php $spica_pcs_location_list->showPageHeader(); ?>
<?php
$spica_pcs_location_list->showMessage();
?>
<?php if ($spica_pcs_location_list->TotalRecs > 0 || $spica_pcs_location->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($spica_pcs_location_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> spica_pcs_location">
<?php if (!$spica_pcs_location->isExport()) { ?>
<div class="card-header ew-grid-upper-panel">
<?php if (!$spica_pcs_location->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php if (!isset($spica_pcs_location_list->Pager)) $spica_pcs_location_list->Pager = new PrevNextPager($spica_pcs_location_list->StartRec, $spica_pcs_location_list->DisplayRecs, $spica_pcs_location_list->TotalRecs, $spica_pcs_location_list->AutoHidePager) ?>
<?php if ($spica_pcs_location_list->Pager->RecordCount > 0 && $spica_pcs_location_list->Pager->Visible) { ?>
<div class="ew-pager">
<span><?php echo $Language->Phrase("Page") ?>&nbsp;</span>
<div class="ew-prev-next"><div class="input-group input-group-sm">
<div class="input-group-prepend">
<!-- first page button -->
	<?php if ($spica_pcs_location_list->Pager->FirstButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerFirst") ?>" href="<?php echo $spica_pcs_location_list->pageUrl() ?>start=<?php echo $spica_pcs_location_list->Pager->FirstButton->Start ?>"><i class="icon-first ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerFirst") ?>"><i class="icon-first ew-icon"></i></a>
	<?php } ?>
<!-- previous page button -->
	<?php if ($spica_pcs_location_list->Pager->PrevButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerPrevious") ?>" href="<?php echo $spica_pcs_location_list->pageUrl() ?>start=<?php echo $spica_pcs_location_list->Pager->PrevButton->Start ?>"><i class="icon-prev ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerPrevious") ?>"><i class="icon-prev ew-icon"></i></a>
	<?php } ?>
</div>
<!-- current page number -->
	<input class="form-control" type="text" name="<?php echo TABLE_PAGE_NO ?>" value="<?php echo $spica_pcs_location_list->Pager->CurrentPage ?>">
<div class="input-group-append">
<!-- next page button -->
	<?php if ($spica_pcs_location_list->Pager->NextButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerNext") ?>" href="<?php echo $spica_pcs_location_list->pageUrl() ?>start=<?php echo $spica_pcs_location_list->Pager->NextButton->Start ?>"><i class="icon-next ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerNext") ?>"><i class="icon-next ew-icon"></i></a>
	<?php } ?>
<!-- last page button -->
	<?php if ($spica_pcs_location_list->Pager->LastButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerLast") ?>" href="<?php echo $spica_pcs_location_list->pageUrl() ?>start=<?php echo $spica_pcs_location_list->Pager->LastButton->Start ?>"><i class="icon-last ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerLast") ?>"><i class="icon-last ew-icon"></i></a>
	<?php } ?>
</div>
</div>
</div>
<span>&nbsp;<?php echo $Language->Phrase("of") ?>&nbsp;<?php echo $spica_pcs_location_list->Pager->PageCount ?></span>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php if ($spica_pcs_location_list->Pager->RecordCount > 0) { ?>
<div class="ew-pager ew-rec">
	<span><?php echo $Language->Phrase("Record") ?>&nbsp;<?php echo $spica_pcs_location_list->Pager->FromIndex ?>&nbsp;<?php echo $Language->Phrase("To") ?>&nbsp;<?php echo $spica_pcs_location_list->Pager->ToIndex ?>&nbsp;<?php echo $Language->Phrase("Of") ?>&nbsp;<?php echo $spica_pcs_location_list->Pager->RecordCount ?></span>
</div>
<?php } ?>
<?php if ($spica_pcs_location_list->TotalRecs > 0 && (!$spica_pcs_location_list->AutoHidePageSizeSelector || $spica_pcs_location_list->Pager->Visible)) { ?>
<div class="ew-pager">
<input type="hidden" name="t" value="spica_pcs_location">
<select name="<?php echo TABLE_REC_PER_PAGE ?>" class="form-control form-control-sm ew-tooltip" title="<?php echo $Language->phrase("RecordsPerPage") ?>" onchange="this.form.submit();">
<option value="20"<?php if ($spica_pcs_location_list->DisplayRecs == 20) { ?> selected<?php } ?>>20</option>
<option value="50"<?php if ($spica_pcs_location_list->DisplayRecs == 50) { ?> selected<?php } ?>>50</option>
<option value="100"<?php if ($spica_pcs_location_list->DisplayRecs == 100) { ?> selected<?php } ?>>100</option>
<option value="200"<?php if ($spica_pcs_location_list->DisplayRecs == 200) { ?> selected<?php } ?>>200</option>
<option value="500"<?php if ($spica_pcs_location_list->DisplayRecs == 500) { ?> selected<?php } ?>>500</option>
<option value="ALL"<?php if ($spica_pcs_location->getRecordsPerPage() == -1) { ?> selected<?php } ?>><?php echo $Language->Phrase("AllRecords") ?></option>
</select>
</div>
<?php } ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $spica_pcs_location_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
<form name="fspica_pcs_locationlist" id="fspica_pcs_locationlist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($spica_pcs_location_list->CheckToken) { ?>
<input type="hidden" name="<?php echo TOKEN_NAME ?>" value="<?php echo $spica_pcs_location_list->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="spica_pcs_location">
<div id="gmp_spica_pcs_location" class="<?php if (IsResponsiveLayout()) { ?>table-responsive <?php } ?>card-body ew-grid-middle-panel">
<?php if ($spica_pcs_location_list->TotalRecs > 0 || $spica_pcs_location->isGridEdit()) { ?>
<table id="tbl_spica_pcs_locationlist" class="table ew-table"><!-- .ew-table ##-->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$spica_pcs_location_list->RowType = ROWTYPE_HEADER;

// Render list options
$spica_pcs_location_list->renderListOptions();

// Render list options (header, left)
$spica_pcs_location_list->ListOptions->render("header", "left");
?>
<?php if ($spica_pcs_location->Location->Visible) { // Location ?>
	<?php if ($spica_pcs_location->sortUrl($spica_pcs_location->Location) == "") { ?>
		<th data-name="Location" class="<?php echo $spica_pcs_location->Location->headerCellClass() ?>" style="white-space: nowrap;"><div id="elh_spica_pcs_location_Location" class="spica_pcs_location_Location"><div class="ew-table-header-caption"><?php echo $spica_pcs_location->Location->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Location" class="<?php echo $spica_pcs_location->Location->headerCellClass() ?>" style="white-space: nowrap;"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $spica_pcs_location->SortUrl($spica_pcs_location->Location) ?>',2);"><div id="elh_spica_pcs_location_Location" class="spica_pcs_location_Location">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $spica_pcs_location->Location->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($spica_pcs_location->Location->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($spica_pcs_location->Location->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($spica_pcs_location->Code->Visible) { // Code ?>
	<?php if ($spica_pcs_location->sortUrl($spica_pcs_location->Code) == "") { ?>
		<th data-name="Code" class="<?php echo $spica_pcs_location->Code->headerCellClass() ?>" style="white-space: nowrap;"><div id="elh_spica_pcs_location_Code" class="spica_pcs_location_Code"><div class="ew-table-header-caption"><?php echo $spica_pcs_location->Code->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Code" class="<?php echo $spica_pcs_location->Code->headerCellClass() ?>" style="white-space: nowrap;"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $spica_pcs_location->SortUrl($spica_pcs_location->Code) ?>',2);"><div id="elh_spica_pcs_location_Code" class="spica_pcs_location_Code">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $spica_pcs_location->Code->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($spica_pcs_location->Code->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($spica_pcs_location->Code->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($spica_pcs_location->ProductName->Visible) { // ProductName ?>
	<?php if ($spica_pcs_location->sortUrl($spica_pcs_location->ProductName) == "") { ?>
		<th data-name="ProductName" class="<?php echo $spica_pcs_location->ProductName->headerCellClass() ?>" style="white-space: nowrap;"><div id="elh_spica_pcs_location_ProductName" class="spica_pcs_location_ProductName"><div class="ew-table-header-caption"><?php echo $spica_pcs_location->ProductName->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="ProductName" class="<?php echo $spica_pcs_location->ProductName->headerCellClass() ?>" style="white-space: nowrap;"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $spica_pcs_location->SortUrl($spica_pcs_location->ProductName) ?>',2);"><div id="elh_spica_pcs_location_ProductName" class="spica_pcs_location_ProductName">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $spica_pcs_location->ProductName->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($spica_pcs_location->ProductName->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($spica_pcs_location->ProductName->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($spica_pcs_location->Model->Visible) { // Model ?>
	<?php if ($spica_pcs_location->sortUrl($spica_pcs_location->Model) == "") { ?>
		<th data-name="Model" class="<?php echo $spica_pcs_location->Model->headerCellClass() ?>" style="white-space: nowrap;"><div id="elh_spica_pcs_location_Model" class="spica_pcs_location_Model"><div class="ew-table-header-caption"><?php echo $spica_pcs_location->Model->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Model" class="<?php echo $spica_pcs_location->Model->headerCellClass() ?>" style="white-space: nowrap;"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $spica_pcs_location->SortUrl($spica_pcs_location->Model) ?>',2);"><div id="elh_spica_pcs_location_Model" class="spica_pcs_location_Model">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $spica_pcs_location->Model->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($spica_pcs_location->Model->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($spica_pcs_location->Model->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($spica_pcs_location->PCS->Visible) { // PCS ?>
	<?php if ($spica_pcs_location->sortUrl($spica_pcs_location->PCS) == "") { ?>
		<th data-name="PCS" class="<?php echo $spica_pcs_location->PCS->headerCellClass() ?>" style="white-space: nowrap;"><div id="elh_spica_pcs_location_PCS" class="spica_pcs_location_PCS"><div class="ew-table-header-caption"><?php echo $spica_pcs_location->PCS->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="PCS" class="<?php echo $spica_pcs_location->PCS->headerCellClass() ?>" style="white-space: nowrap;"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $spica_pcs_location->SortUrl($spica_pcs_location->PCS) ?>',2);"><div id="elh_spica_pcs_location_PCS" class="spica_pcs_location_PCS">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $spica_pcs_location->PCS->caption() ?></span><span class="ew-table-header-sort"><?php if ($spica_pcs_location->PCS->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($spica_pcs_location->PCS->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$spica_pcs_location_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
if ($spica_pcs_location->ExportAll && $spica_pcs_location->isExport()) {
	$spica_pcs_location_list->StopRec = $spica_pcs_location_list->TotalRecs;
} else {

	// Set the last record to display
	if ($spica_pcs_location_list->TotalRecs > $spica_pcs_location_list->StartRec + $spica_pcs_location_list->DisplayRecs - 1)
		$spica_pcs_location_list->StopRec = $spica_pcs_location_list->StartRec + $spica_pcs_location_list->DisplayRecs - 1;
	else
		$spica_pcs_location_list->StopRec = $spica_pcs_location_list->TotalRecs;
}
$spica_pcs_location_list->RecCnt = $spica_pcs_location_list->StartRec - 1;
if ($spica_pcs_location_list->Recordset && !$spica_pcs_location_list->Recordset->EOF) {
	$spica_pcs_location_list->Recordset->moveFirst();
	$selectLimit = $spica_pcs_location_list->UseSelectLimit;
	if (!$selectLimit && $spica_pcs_location_list->StartRec > 1)
		$spica_pcs_location_list->Recordset->move($spica_pcs_location_list->StartRec - 1);
} elseif (!$spica_pcs_location->AllowAddDeleteRow && $spica_pcs_location_list->StopRec == 0) {
	$spica_pcs_location_list->StopRec = $spica_pcs_location->GridAddRowCount;
}

// Initialize aggregate
$spica_pcs_location->RowType = ROWTYPE_AGGREGATEINIT;
$spica_pcs_location->resetAttributes();
$spica_pcs_location_list->renderRow();
while ($spica_pcs_location_list->RecCnt < $spica_pcs_location_list->StopRec) {
	$spica_pcs_location_list->RecCnt++;
	if ($spica_pcs_location_list->RecCnt >= $spica_pcs_location_list->StartRec) {
		$spica_pcs_location_list->RowCnt++;

		// Set up key count
		$spica_pcs_location_list->KeyCount = $spica_pcs_location_list->RowIndex;

		// Init row class and style
		$spica_pcs_location->resetAttributes();
		$spica_pcs_location->CssClass = "";
		if ($spica_pcs_location->isGridAdd()) {
		} else {
			$spica_pcs_location_list->loadRowValues($spica_pcs_location_list->Recordset); // Load row values
		}
		$spica_pcs_location->RowType = ROWTYPE_VIEW; // Render view

		// Set up row id / data-rowindex
		$spica_pcs_location->RowAttrs = array_merge($spica_pcs_location->RowAttrs, array('data-rowindex'=>$spica_pcs_location_list->RowCnt, 'id'=>'r' . $spica_pcs_location_list->RowCnt . '_spica_pcs_location', 'data-rowtype'=>$spica_pcs_location->RowType));

		// Render row
		$spica_pcs_location_list->renderRow();

		// Render list options
		$spica_pcs_location_list->renderListOptions();
?>
	<tr<?php echo $spica_pcs_location->rowAttributes() ?>>
<?php

// Render list options (body, left)
$spica_pcs_location_list->ListOptions->render("body", "left", $spica_pcs_location_list->RowCnt);
?>
	<?php if ($spica_pcs_location->Location->Visible) { // Location ?>
		<td data-name="Location"<?php echo $spica_pcs_location->Location->cellAttributes() ?>>
<span id="el<?php echo $spica_pcs_location_list->RowCnt ?>_spica_pcs_location_Location" class="spica_pcs_location_Location">
<span<?php echo $spica_pcs_location->Location->viewAttributes() ?>>
<?php echo $spica_pcs_location->Location->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($spica_pcs_location->Code->Visible) { // Code ?>
		<td data-name="Code"<?php echo $spica_pcs_location->Code->cellAttributes() ?>>
<span id="el<?php echo $spica_pcs_location_list->RowCnt ?>_spica_pcs_location_Code" class="spica_pcs_location_Code">
<span<?php echo $spica_pcs_location->Code->viewAttributes() ?>>
<?php echo $spica_pcs_location->Code->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($spica_pcs_location->ProductName->Visible) { // ProductName ?>
		<td data-name="ProductName"<?php echo $spica_pcs_location->ProductName->cellAttributes() ?>>
<span id="el<?php echo $spica_pcs_location_list->RowCnt ?>_spica_pcs_location_ProductName" class="spica_pcs_location_ProductName">
<span<?php echo $spica_pcs_location->ProductName->viewAttributes() ?>>
<?php echo $spica_pcs_location->ProductName->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($spica_pcs_location->Model->Visible) { // Model ?>
		<td data-name="Model"<?php echo $spica_pcs_location->Model->cellAttributes() ?>>
<span id="el<?php echo $spica_pcs_location_list->RowCnt ?>_spica_pcs_location_Model" class="spica_pcs_location_Model">
<span<?php echo $spica_pcs_location->Model->viewAttributes() ?>>
<?php echo $spica_pcs_location->Model->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($spica_pcs_location->PCS->Visible) { // PCS ?>
		<td data-name="PCS"<?php echo $spica_pcs_location->PCS->cellAttributes() ?>>
<span id="el<?php echo $spica_pcs_location_list->RowCnt ?>_spica_pcs_location_PCS" class="spica_pcs_location_PCS">
<span<?php echo $spica_pcs_location->PCS->viewAttributes() ?>>
<?php echo $spica_pcs_location->PCS->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$spica_pcs_location_list->ListOptions->render("body", "right", $spica_pcs_location_list->RowCnt);
?>
	</tr>
<?php
	}
	if (!$spica_pcs_location->isGridAdd())
		$spica_pcs_location_list->Recordset->moveNext();
}
?>
</tbody>
</table><!-- /.ew-table -->
<?php } ?>
<?php if (!$spica_pcs_location->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</div><!-- /.ew-grid-middle-panel -->
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($spica_pcs_location_list->Recordset)
	$spica_pcs_location_list->Recordset->Close();
?>
<?php if (!$spica_pcs_location->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$spica_pcs_location->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php if (!isset($spica_pcs_location_list->Pager)) $spica_pcs_location_list->Pager = new PrevNextPager($spica_pcs_location_list->StartRec, $spica_pcs_location_list->DisplayRecs, $spica_pcs_location_list->TotalRecs, $spica_pcs_location_list->AutoHidePager) ?>
<?php if ($spica_pcs_location_list->Pager->RecordCount > 0 && $spica_pcs_location_list->Pager->Visible) { ?>
<div class="ew-pager">
<span><?php echo $Language->Phrase("Page") ?>&nbsp;</span>
<div class="ew-prev-next"><div class="input-group input-group-sm">
<div class="input-group-prepend">
<!-- first page button -->
	<?php if ($spica_pcs_location_list->Pager->FirstButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerFirst") ?>" href="<?php echo $spica_pcs_location_list->pageUrl() ?>start=<?php echo $spica_pcs_location_list->Pager->FirstButton->Start ?>"><i class="icon-first ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerFirst") ?>"><i class="icon-first ew-icon"></i></a>
	<?php } ?>
<!-- previous page button -->
	<?php if ($spica_pcs_location_list->Pager->PrevButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerPrevious") ?>" href="<?php echo $spica_pcs_location_list->pageUrl() ?>start=<?php echo $spica_pcs_location_list->Pager->PrevButton->Start ?>"><i class="icon-prev ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerPrevious") ?>"><i class="icon-prev ew-icon"></i></a>
	<?php } ?>
</div>
<!-- current page number -->
	<input class="form-control" type="text" name="<?php echo TABLE_PAGE_NO ?>" value="<?php echo $spica_pcs_location_list->Pager->CurrentPage ?>">
<div class="input-group-append">
<!-- next page button -->
	<?php if ($spica_pcs_location_list->Pager->NextButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerNext") ?>" href="<?php echo $spica_pcs_location_list->pageUrl() ?>start=<?php echo $spica_pcs_location_list->Pager->NextButton->Start ?>"><i class="icon-next ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerNext") ?>"><i class="icon-next ew-icon"></i></a>
	<?php } ?>
<!-- last page button -->
	<?php if ($spica_pcs_location_list->Pager->LastButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerLast") ?>" href="<?php echo $spica_pcs_location_list->pageUrl() ?>start=<?php echo $spica_pcs_location_list->Pager->LastButton->Start ?>"><i class="icon-last ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerLast") ?>"><i class="icon-last ew-icon"></i></a>
	<?php } ?>
</div>
</div>
</div>
<span>&nbsp;<?php echo $Language->Phrase("of") ?>&nbsp;<?php echo $spica_pcs_location_list->Pager->PageCount ?></span>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php if ($spica_pcs_location_list->Pager->RecordCount > 0) { ?>
<div class="ew-pager ew-rec">
	<span><?php echo $Language->Phrase("Record") ?>&nbsp;<?php echo $spica_pcs_location_list->Pager->FromIndex ?>&nbsp;<?php echo $Language->Phrase("To") ?>&nbsp;<?php echo $spica_pcs_location_list->Pager->ToIndex ?>&nbsp;<?php echo $Language->Phrase("Of") ?>&nbsp;<?php echo $spica_pcs_location_list->Pager->RecordCount ?></span>
</div>
<?php } ?>
<?php if ($spica_pcs_location_list->TotalRecs > 0 && (!$spica_pcs_location_list->AutoHidePageSizeSelector || $spica_pcs_location_list->Pager->Visible)) { ?>
<div class="ew-pager">
<input type="hidden" name="t" value="spica_pcs_location">
<select name="<?php echo TABLE_REC_PER_PAGE ?>" class="form-control form-control-sm ew-tooltip" title="<?php echo $Language->phrase("RecordsPerPage") ?>" onchange="this.form.submit();">
<option value="20"<?php if ($spica_pcs_location_list->DisplayRecs == 20) { ?> selected<?php } ?>>20</option>
<option value="50"<?php if ($spica_pcs_location_list->DisplayRecs == 50) { ?> selected<?php } ?>>50</option>
<option value="100"<?php if ($spica_pcs_location_list->DisplayRecs == 100) { ?> selected<?php } ?>>100</option>
<option value="200"<?php if ($spica_pcs_location_list->DisplayRecs == 200) { ?> selected<?php } ?>>200</option>
<option value="500"<?php if ($spica_pcs_location_list->DisplayRecs == 500) { ?> selected<?php } ?>>500</option>
<option value="ALL"<?php if ($spica_pcs_location->getRecordsPerPage() == -1) { ?> selected<?php } ?>><?php echo $Language->Phrase("AllRecords") ?></option>
</select>
</div>
<?php } ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $spica_pcs_location_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($spica_pcs_location_list->TotalRecs == 0 && !$spica_pcs_location->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $spica_pcs_location_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$spica_pcs_location_list->showPageFooter();
if (DEBUG_ENABLED)
	echo GetDebugMessage();
?>
<?php if (!$spica_pcs_location->isExport()) { ?>
<script>

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php } ?>
<?php include_once "footer.php" ?>
<?php
$spica_pcs_location_list->terminate();
?>