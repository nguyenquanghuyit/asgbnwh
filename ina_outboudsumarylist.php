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
$ina_outboudsumary_list = new ina_outboudsumary_list();

// Run the page
$ina_outboudsumary_list->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$ina_outboudsumary_list->Page_Render();
?>
<?php include_once "header.php" ?>
<?php if (!$ina_outboudsumary->isExport()) { ?>
<script>

// Form object
currentPageID = ew.PAGE_ID = "list";
var fina_outboudsumarylist = currentForm = new ew.Form("fina_outboudsumarylist", "list");
fina_outboudsumarylist.formKeyCountName = '<?php echo $ina_outboudsumary_list->FormKeyCountName ?>';

// Form_CustomValidate event
fina_outboudsumarylist.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

	// Your custom validation code here, return false if invalid.
	return true;
}

// Use JavaScript validation or not
fina_outboudsumarylist.validateRequired = <?php echo json_encode(CLIENT_VALIDATE) ?>;

// Dynamic selection lists
fina_outboudsumarylist.lists["x_Nam"] = <?php echo $ina_outboudsumary_list->Nam->Lookup->toClientList() ?>;
fina_outboudsumarylist.lists["x_Nam"].options = <?php echo JsonEncode($ina_outboudsumary_list->Nam->lookupOptions()) ?>;
fina_outboudsumarylist.autoSuggests["x_Nam"] = <?php echo json_encode(["data" => "ajax=autosuggest"]) ?>;
fina_outboudsumarylist.lists["x_Thang"] = <?php echo $ina_outboudsumary_list->Thang->Lookup->toClientList() ?>;
fina_outboudsumarylist.lists["x_Thang"].options = <?php echo JsonEncode($ina_outboudsumary_list->Thang->lookupOptions()) ?>;
fina_outboudsumarylist.autoSuggests["x_Thang"] = <?php echo json_encode(["data" => "ajax=autosuggest"]) ?>;

// Form object for search
var fina_outboudsumarylistsrch = currentSearchForm = new ew.Form("fina_outboudsumarylistsrch");

// Filters
fina_outboudsumarylistsrch.filterList = <?php echo $ina_outboudsumary_list->getFilterList() ?>;
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
<?php if (!$ina_outboudsumary->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($ina_outboudsumary_list->TotalRecs > 0 && $ina_outboudsumary_list->ExportOptions->visible()) { ?>
<?php $ina_outboudsumary_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($ina_outboudsumary_list->ImportOptions->visible()) { ?>
<?php $ina_outboudsumary_list->ImportOptions->render("body") ?>
<?php } ?>
<?php if ($ina_outboudsumary_list->SearchOptions->visible()) { ?>
<?php $ina_outboudsumary_list->SearchOptions->render("body") ?>
<?php } ?>
<?php if ($ina_outboudsumary_list->FilterOptions->visible()) { ?>
<?php $ina_outboudsumary_list->FilterOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php
$ina_outboudsumary_list->renderOtherOptions();
?>
<?php if ($Security->CanSearch()) { ?>
<?php if (!$ina_outboudsumary->isExport() && !$ina_outboudsumary->CurrentAction) { ?>
<form name="fina_outboudsumarylistsrch" id="fina_outboudsumarylistsrch" class="form-inline ew-form ew-ext-search-form" action="<?php echo CurrentPageName() ?>">
<?php $searchPanelClass = ($ina_outboudsumary_list->SearchWhere <> "") ? " show" : " show"; ?>
<div id="fina_outboudsumarylistsrch-search-panel" class="ew-search-panel collapse<?php echo $searchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="ina_outboudsumary">
	<div class="ew-basic-search">
<div id="xsr_1" class="ew-row d-sm-flex">
	<div class="ew-quick-search input-group">
		<input type="text" name="<?php echo TABLE_BASIC_SEARCH ?>" id="<?php echo TABLE_BASIC_SEARCH ?>" class="form-control" value="<?php echo HtmlEncode($ina_outboudsumary_list->BasicSearch->getKeyword()) ?>" placeholder="<?php echo HtmlEncode($Language->phrase("Search")) ?>">
		<input type="hidden" name="<?php echo TABLE_BASIC_SEARCH_TYPE ?>" id="<?php echo TABLE_BASIC_SEARCH_TYPE ?>" value="<?php echo HtmlEncode($ina_outboudsumary_list->BasicSearch->getType()) ?>">
		<div class="input-group-append">
			<button class="btn btn-primary" name="btn-submit" id="btn-submit" type="submit"><?php echo $Language->phrase("SearchBtn") ?></button>
			<button type="button" data-toggle="dropdown" class="btn btn-primary dropdown-toggle dropdown-toggle-split" aria-haspopup="true" aria-expanded="false"><span id="searchtype"><?php echo $ina_outboudsumary_list->BasicSearch->getTypeNameShort() ?></span></button>
			<div class="dropdown-menu dropdown-menu-right">
				<a class="dropdown-item<?php if ($ina_outboudsumary_list->BasicSearch->getType() == "") echo " active"; ?>" href="javascript:void(0);" onclick="ew.setSearchType(this)"><?php echo $Language->phrase("QuickSearchAuto") ?></a>
				<a class="dropdown-item<?php if ($ina_outboudsumary_list->BasicSearch->getType() == "=") echo " active"; ?>" href="javascript:void(0);" onclick="ew.setSearchType(this,'=')"><?php echo $Language->phrase("QuickSearchExact") ?></a>
				<a class="dropdown-item<?php if ($ina_outboudsumary_list->BasicSearch->getType() == "AND") echo " active"; ?>" href="javascript:void(0);" onclick="ew.setSearchType(this,'AND')"><?php echo $Language->phrase("QuickSearchAll") ?></a>
				<a class="dropdown-item<?php if ($ina_outboudsumary_list->BasicSearch->getType() == "OR") echo " active"; ?>" href="javascript:void(0);" onclick="ew.setSearchType(this,'OR')"><?php echo $Language->phrase("QuickSearchAny") ?></a>
			</div>
		</div>
	</div>
</div>
	</div>
</div>
</form>
<?php } ?>
<?php } ?>
<?php $ina_outboudsumary_list->showPageHeader(); ?>
<?php
$ina_outboudsumary_list->showMessage();
?>
<?php if ($ina_outboudsumary_list->TotalRecs > 0 || $ina_outboudsumary->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($ina_outboudsumary_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> ina_outboudsumary">
<?php if (!$ina_outboudsumary->isExport()) { ?>
<div class="card-header ew-grid-upper-panel">
<?php if (!$ina_outboudsumary->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php if (!isset($ina_outboudsumary_list->Pager)) $ina_outboudsumary_list->Pager = new PrevNextPager($ina_outboudsumary_list->StartRec, $ina_outboudsumary_list->DisplayRecs, $ina_outboudsumary_list->TotalRecs, $ina_outboudsumary_list->AutoHidePager) ?>
<?php if ($ina_outboudsumary_list->Pager->RecordCount > 0 && $ina_outboudsumary_list->Pager->Visible) { ?>
<div class="ew-pager">
<span><?php echo $Language->Phrase("Page") ?>&nbsp;</span>
<div class="ew-prev-next"><div class="input-group input-group-sm">
<div class="input-group-prepend">
<!-- first page button -->
	<?php if ($ina_outboudsumary_list->Pager->FirstButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerFirst") ?>" href="<?php echo $ina_outboudsumary_list->pageUrl() ?>start=<?php echo $ina_outboudsumary_list->Pager->FirstButton->Start ?>"><i class="icon-first ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerFirst") ?>"><i class="icon-first ew-icon"></i></a>
	<?php } ?>
<!-- previous page button -->
	<?php if ($ina_outboudsumary_list->Pager->PrevButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerPrevious") ?>" href="<?php echo $ina_outboudsumary_list->pageUrl() ?>start=<?php echo $ina_outboudsumary_list->Pager->PrevButton->Start ?>"><i class="icon-prev ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerPrevious") ?>"><i class="icon-prev ew-icon"></i></a>
	<?php } ?>
</div>
<!-- current page number -->
	<input class="form-control" type="text" name="<?php echo TABLE_PAGE_NO ?>" value="<?php echo $ina_outboudsumary_list->Pager->CurrentPage ?>">
<div class="input-group-append">
<!-- next page button -->
	<?php if ($ina_outboudsumary_list->Pager->NextButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerNext") ?>" href="<?php echo $ina_outboudsumary_list->pageUrl() ?>start=<?php echo $ina_outboudsumary_list->Pager->NextButton->Start ?>"><i class="icon-next ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerNext") ?>"><i class="icon-next ew-icon"></i></a>
	<?php } ?>
<!-- last page button -->
	<?php if ($ina_outboudsumary_list->Pager->LastButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerLast") ?>" href="<?php echo $ina_outboudsumary_list->pageUrl() ?>start=<?php echo $ina_outboudsumary_list->Pager->LastButton->Start ?>"><i class="icon-last ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerLast") ?>"><i class="icon-last ew-icon"></i></a>
	<?php } ?>
</div>
</div>
</div>
<span>&nbsp;<?php echo $Language->Phrase("of") ?>&nbsp;<?php echo $ina_outboudsumary_list->Pager->PageCount ?></span>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php if ($ina_outboudsumary_list->Pager->RecordCount > 0) { ?>
<div class="ew-pager ew-rec">
	<span><?php echo $Language->Phrase("Record") ?>&nbsp;<?php echo $ina_outboudsumary_list->Pager->FromIndex ?>&nbsp;<?php echo $Language->Phrase("To") ?>&nbsp;<?php echo $ina_outboudsumary_list->Pager->ToIndex ?>&nbsp;<?php echo $Language->Phrase("Of") ?>&nbsp;<?php echo $ina_outboudsumary_list->Pager->RecordCount ?></span>
</div>
<?php } ?>
<?php if ($ina_outboudsumary_list->TotalRecs > 0 && (!$ina_outboudsumary_list->AutoHidePageSizeSelector || $ina_outboudsumary_list->Pager->Visible)) { ?>
<div class="ew-pager">
<input type="hidden" name="t" value="ina_outboudsumary">
<select name="<?php echo TABLE_REC_PER_PAGE ?>" class="form-control form-control-sm ew-tooltip" title="<?php echo $Language->phrase("RecordsPerPage") ?>" onchange="this.form.submit();">
<option value="20"<?php if ($ina_outboudsumary_list->DisplayRecs == 20) { ?> selected<?php } ?>>20</option>
<option value="50"<?php if ($ina_outboudsumary_list->DisplayRecs == 50) { ?> selected<?php } ?>>50</option>
<option value="100"<?php if ($ina_outboudsumary_list->DisplayRecs == 100) { ?> selected<?php } ?>>100</option>
<option value="200"<?php if ($ina_outboudsumary_list->DisplayRecs == 200) { ?> selected<?php } ?>>200</option>
<option value="500"<?php if ($ina_outboudsumary_list->DisplayRecs == 500) { ?> selected<?php } ?>>500</option>
<option value="ALL"<?php if ($ina_outboudsumary->getRecordsPerPage() == -1) { ?> selected<?php } ?>><?php echo $Language->Phrase("AllRecords") ?></option>
</select>
</div>
<?php } ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $ina_outboudsumary_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
<form name="fina_outboudsumarylist" id="fina_outboudsumarylist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($ina_outboudsumary_list->CheckToken) { ?>
<input type="hidden" name="<?php echo TOKEN_NAME ?>" value="<?php echo $ina_outboudsumary_list->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="ina_outboudsumary">
<div id="gmp_ina_outboudsumary" class="<?php if (IsResponsiveLayout()) { ?>table-responsive <?php } ?>card-body ew-grid-middle-panel">
<?php if ($ina_outboudsumary_list->TotalRecs > 0 || $ina_outboudsumary->isGridEdit()) { ?>
<table id="tbl_ina_outboudsumarylist" class="table ew-table"><!-- .ew-table ##-->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$ina_outboudsumary_list->RowType = ROWTYPE_HEADER;

// Render list options
$ina_outboudsumary_list->renderListOptions();

// Render list options (header, left)
$ina_outboudsumary_list->ListOptions->render("header", "left");
?>
<?php if ($ina_outboudsumary->Nam->Visible) { // Nam ?>
	<?php if ($ina_outboudsumary->sortUrl($ina_outboudsumary->Nam) == "") { ?>
		<th data-name="Nam" class="<?php echo $ina_outboudsumary->Nam->headerCellClass() ?>"><div id="elh_ina_outboudsumary_Nam" class="ina_outboudsumary_Nam"><div class="ew-table-header-caption"><?php echo $ina_outboudsumary->Nam->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Nam" class="<?php echo $ina_outboudsumary->Nam->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $ina_outboudsumary->SortUrl($ina_outboudsumary->Nam) ?>',2);"><div id="elh_ina_outboudsumary_Nam" class="ina_outboudsumary_Nam">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $ina_outboudsumary->Nam->caption() ?></span><span class="ew-table-header-sort"><?php if ($ina_outboudsumary->Nam->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($ina_outboudsumary->Nam->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($ina_outboudsumary->Thang->Visible) { // Thang ?>
	<?php if ($ina_outboudsumary->sortUrl($ina_outboudsumary->Thang) == "") { ?>
		<th data-name="Thang" class="<?php echo $ina_outboudsumary->Thang->headerCellClass() ?>"><div id="elh_ina_outboudsumary_Thang" class="ina_outboudsumary_Thang"><div class="ew-table-header-caption"><?php echo $ina_outboudsumary->Thang->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Thang" class="<?php echo $ina_outboudsumary->Thang->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $ina_outboudsumary->SortUrl($ina_outboudsumary->Thang) ?>',2);"><div id="elh_ina_outboudsumary_Thang" class="ina_outboudsumary_Thang">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $ina_outboudsumary->Thang->caption() ?></span><span class="ew-table-header-sort"><?php if ($ina_outboudsumary->Thang->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($ina_outboudsumary->Thang->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($ina_outboudsumary->TruckNo->Visible) { // TruckNo ?>
	<?php if ($ina_outboudsumary->sortUrl($ina_outboudsumary->TruckNo) == "") { ?>
		<th data-name="TruckNo" class="<?php echo $ina_outboudsumary->TruckNo->headerCellClass() ?>"><div id="elh_ina_outboudsumary_TruckNo" class="ina_outboudsumary_TruckNo"><div class="ew-table-header-caption"><?php echo $ina_outboudsumary->TruckNo->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="TruckNo" class="<?php echo $ina_outboudsumary->TruckNo->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $ina_outboudsumary->SortUrl($ina_outboudsumary->TruckNo) ?>',2);"><div id="elh_ina_outboudsumary_TruckNo" class="ina_outboudsumary_TruckNo">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $ina_outboudsumary->TruckNo->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($ina_outboudsumary->TruckNo->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($ina_outboudsumary->TruckNo->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($ina_outboudsumary->Code->Visible) { // Code ?>
	<?php if ($ina_outboudsumary->sortUrl($ina_outboudsumary->Code) == "") { ?>
		<th data-name="Code" class="<?php echo $ina_outboudsumary->Code->headerCellClass() ?>"><div id="elh_ina_outboudsumary_Code" class="ina_outboudsumary_Code"><div class="ew-table-header-caption"><?php echo $ina_outboudsumary->Code->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Code" class="<?php echo $ina_outboudsumary->Code->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $ina_outboudsumary->SortUrl($ina_outboudsumary->Code) ?>',2);"><div id="elh_ina_outboudsumary_Code" class="ina_outboudsumary_Code">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $ina_outboudsumary->Code->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($ina_outboudsumary->Code->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($ina_outboudsumary->Code->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($ina_outboudsumary->ProductName->Visible) { // ProductName ?>
	<?php if ($ina_outboudsumary->sortUrl($ina_outboudsumary->ProductName) == "") { ?>
		<th data-name="ProductName" class="<?php echo $ina_outboudsumary->ProductName->headerCellClass() ?>"><div id="elh_ina_outboudsumary_ProductName" class="ina_outboudsumary_ProductName"><div class="ew-table-header-caption"><?php echo $ina_outboudsumary->ProductName->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="ProductName" class="<?php echo $ina_outboudsumary->ProductName->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $ina_outboudsumary->SortUrl($ina_outboudsumary->ProductName) ?>',2);"><div id="elh_ina_outboudsumary_ProductName" class="ina_outboudsumary_ProductName">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $ina_outboudsumary->ProductName->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($ina_outboudsumary->ProductName->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($ina_outboudsumary->ProductName->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($ina_outboudsumary->PCS->Visible) { // PCS ?>
	<?php if ($ina_outboudsumary->sortUrl($ina_outboudsumary->PCS) == "") { ?>
		<th data-name="PCS" class="<?php echo $ina_outboudsumary->PCS->headerCellClass() ?>"><div id="elh_ina_outboudsumary_PCS" class="ina_outboudsumary_PCS"><div class="ew-table-header-caption"><?php echo $ina_outboudsumary->PCS->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="PCS" class="<?php echo $ina_outboudsumary->PCS->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $ina_outboudsumary->SortUrl($ina_outboudsumary->PCS) ?>',2);"><div id="elh_ina_outboudsumary_PCS" class="ina_outboudsumary_PCS">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $ina_outboudsumary->PCS->caption() ?></span><span class="ew-table-header-sort"><?php if ($ina_outboudsumary->PCS->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($ina_outboudsumary->PCS->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$ina_outboudsumary_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
if ($ina_outboudsumary->ExportAll && $ina_outboudsumary->isExport()) {
	$ina_outboudsumary_list->StopRec = $ina_outboudsumary_list->TotalRecs;
} else {

	// Set the last record to display
	if ($ina_outboudsumary_list->TotalRecs > $ina_outboudsumary_list->StartRec + $ina_outboudsumary_list->DisplayRecs - 1)
		$ina_outboudsumary_list->StopRec = $ina_outboudsumary_list->StartRec + $ina_outboudsumary_list->DisplayRecs - 1;
	else
		$ina_outboudsumary_list->StopRec = $ina_outboudsumary_list->TotalRecs;
}
$ina_outboudsumary_list->RecCnt = $ina_outboudsumary_list->StartRec - 1;
if ($ina_outboudsumary_list->Recordset && !$ina_outboudsumary_list->Recordset->EOF) {
	$ina_outboudsumary_list->Recordset->moveFirst();
	$selectLimit = $ina_outboudsumary_list->UseSelectLimit;
	if (!$selectLimit && $ina_outboudsumary_list->StartRec > 1)
		$ina_outboudsumary_list->Recordset->move($ina_outboudsumary_list->StartRec - 1);
} elseif (!$ina_outboudsumary->AllowAddDeleteRow && $ina_outboudsumary_list->StopRec == 0) {
	$ina_outboudsumary_list->StopRec = $ina_outboudsumary->GridAddRowCount;
}

// Initialize aggregate
$ina_outboudsumary->RowType = ROWTYPE_AGGREGATEINIT;
$ina_outboudsumary->resetAttributes();
$ina_outboudsumary_list->renderRow();
while ($ina_outboudsumary_list->RecCnt < $ina_outboudsumary_list->StopRec) {
	$ina_outboudsumary_list->RecCnt++;
	if ($ina_outboudsumary_list->RecCnt >= $ina_outboudsumary_list->StartRec) {
		$ina_outboudsumary_list->RowCnt++;

		// Set up key count
		$ina_outboudsumary_list->KeyCount = $ina_outboudsumary_list->RowIndex;

		// Init row class and style
		$ina_outboudsumary->resetAttributes();
		$ina_outboudsumary->CssClass = "";
		if ($ina_outboudsumary->isGridAdd()) {
		} else {
			$ina_outboudsumary_list->loadRowValues($ina_outboudsumary_list->Recordset); // Load row values
		}
		$ina_outboudsumary->RowType = ROWTYPE_VIEW; // Render view

		// Set up row id / data-rowindex
		$ina_outboudsumary->RowAttrs = array_merge($ina_outboudsumary->RowAttrs, array('data-rowindex'=>$ina_outboudsumary_list->RowCnt, 'id'=>'r' . $ina_outboudsumary_list->RowCnt . '_ina_outboudsumary', 'data-rowtype'=>$ina_outboudsumary->RowType));

		// Render row
		$ina_outboudsumary_list->renderRow();

		// Render list options
		$ina_outboudsumary_list->renderListOptions();
?>
	<tr<?php echo $ina_outboudsumary->rowAttributes() ?>>
<?php

// Render list options (body, left)
$ina_outboudsumary_list->ListOptions->render("body", "left", $ina_outboudsumary_list->RowCnt);
?>
	<?php if ($ina_outboudsumary->Nam->Visible) { // Nam ?>
		<td data-name="Nam"<?php echo $ina_outboudsumary->Nam->cellAttributes() ?>>
<span id="el<?php echo $ina_outboudsumary_list->RowCnt ?>_ina_outboudsumary_Nam" class="ina_outboudsumary_Nam">
<span<?php echo $ina_outboudsumary->Nam->viewAttributes() ?>>
<?php echo $ina_outboudsumary->Nam->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($ina_outboudsumary->Thang->Visible) { // Thang ?>
		<td data-name="Thang"<?php echo $ina_outboudsumary->Thang->cellAttributes() ?>>
<span id="el<?php echo $ina_outboudsumary_list->RowCnt ?>_ina_outboudsumary_Thang" class="ina_outboudsumary_Thang">
<span<?php echo $ina_outboudsumary->Thang->viewAttributes() ?>>
<?php echo $ina_outboudsumary->Thang->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($ina_outboudsumary->TruckNo->Visible) { // TruckNo ?>
		<td data-name="TruckNo"<?php echo $ina_outboudsumary->TruckNo->cellAttributes() ?>>
<span id="el<?php echo $ina_outboudsumary_list->RowCnt ?>_ina_outboudsumary_TruckNo" class="ina_outboudsumary_TruckNo">
<span<?php echo $ina_outboudsumary->TruckNo->viewAttributes() ?>>
<?php echo $ina_outboudsumary->TruckNo->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($ina_outboudsumary->Code->Visible) { // Code ?>
		<td data-name="Code"<?php echo $ina_outboudsumary->Code->cellAttributes() ?>>
<span id="el<?php echo $ina_outboudsumary_list->RowCnt ?>_ina_outboudsumary_Code" class="ina_outboudsumary_Code">
<span<?php echo $ina_outboudsumary->Code->viewAttributes() ?>>
<?php echo $ina_outboudsumary->Code->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($ina_outboudsumary->ProductName->Visible) { // ProductName ?>
		<td data-name="ProductName"<?php echo $ina_outboudsumary->ProductName->cellAttributes() ?>>
<span id="el<?php echo $ina_outboudsumary_list->RowCnt ?>_ina_outboudsumary_ProductName" class="ina_outboudsumary_ProductName">
<span<?php echo $ina_outboudsumary->ProductName->viewAttributes() ?>>
<?php echo $ina_outboudsumary->ProductName->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($ina_outboudsumary->PCS->Visible) { // PCS ?>
		<td data-name="PCS"<?php echo $ina_outboudsumary->PCS->cellAttributes() ?>>
<span id="el<?php echo $ina_outboudsumary_list->RowCnt ?>_ina_outboudsumary_PCS" class="ina_outboudsumary_PCS">
<span<?php echo $ina_outboudsumary->PCS->viewAttributes() ?>>
<?php echo $ina_outboudsumary->PCS->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$ina_outboudsumary_list->ListOptions->render("body", "right", $ina_outboudsumary_list->RowCnt);
?>
	</tr>
<?php
	}
	if (!$ina_outboudsumary->isGridAdd())
		$ina_outboudsumary_list->Recordset->moveNext();
}
?>
</tbody>
<?php

// Render aggregate row
$ina_outboudsumary->RowType = ROWTYPE_AGGREGATE;
$ina_outboudsumary->resetAttributes();
$ina_outboudsumary_list->renderRow();
?>
<?php if ($ina_outboudsumary_list->TotalRecs > 0 && !$ina_outboudsumary->isGridAdd() && !$ina_outboudsumary->isGridEdit()) { ?>
<tfoot><!-- Table footer -->
	<tr class="ew-table-footer">
<?php

// Render list options
$ina_outboudsumary_list->renderListOptions();

// Render list options (footer, left)
$ina_outboudsumary_list->ListOptions->render("footer", "left");
?>
	<?php if ($ina_outboudsumary->Nam->Visible) { // Nam ?>
		<td data-name="Nam" class="<?php echo $ina_outboudsumary->Nam->footerCellClass() ?>"><span id="elf_ina_outboudsumary_Nam" class="ina_outboudsumary_Nam">
		&nbsp;
		</span></td>
	<?php } ?>
	<?php if ($ina_outboudsumary->Thang->Visible) { // Thang ?>
		<td data-name="Thang" class="<?php echo $ina_outboudsumary->Thang->footerCellClass() ?>"><span id="elf_ina_outboudsumary_Thang" class="ina_outboudsumary_Thang">
		&nbsp;
		</span></td>
	<?php } ?>
	<?php if ($ina_outboudsumary->TruckNo->Visible) { // TruckNo ?>
		<td data-name="TruckNo" class="<?php echo $ina_outboudsumary->TruckNo->footerCellClass() ?>"><span id="elf_ina_outboudsumary_TruckNo" class="ina_outboudsumary_TruckNo">
		&nbsp;
		</span></td>
	<?php } ?>
	<?php if ($ina_outboudsumary->Code->Visible) { // Code ?>
		<td data-name="Code" class="<?php echo $ina_outboudsumary->Code->footerCellClass() ?>"><span id="elf_ina_outboudsumary_Code" class="ina_outboudsumary_Code">
		&nbsp;
		</span></td>
	<?php } ?>
	<?php if ($ina_outboudsumary->ProductName->Visible) { // ProductName ?>
		<td data-name="ProductName" class="<?php echo $ina_outboudsumary->ProductName->footerCellClass() ?>"><span id="elf_ina_outboudsumary_ProductName" class="ina_outboudsumary_ProductName">
		&nbsp;
		</span></td>
	<?php } ?>
	<?php if ($ina_outboudsumary->PCS->Visible) { // PCS ?>
		<td data-name="PCS" class="<?php echo $ina_outboudsumary->PCS->footerCellClass() ?>"><span id="elf_ina_outboudsumary_PCS" class="ina_outboudsumary_PCS">
		<span class="ew-aggregate"><?php echo $Language->phrase("TOTAL") ?></span><span class="ew-aggregate-value">
		<?php echo $ina_outboudsumary->PCS->ViewValue ?></span>
		</span></td>
	<?php } ?>
<?php

// Render list options (footer, right)
$ina_outboudsumary_list->ListOptions->render("footer", "right");
?>
	</tr>
</tfoot>
<?php } ?>
</table><!-- /.ew-table -->
<?php } ?>
<?php if (!$ina_outboudsumary->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</div><!-- /.ew-grid-middle-panel -->
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($ina_outboudsumary_list->Recordset)
	$ina_outboudsumary_list->Recordset->Close();
?>
<?php if (!$ina_outboudsumary->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$ina_outboudsumary->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php if (!isset($ina_outboudsumary_list->Pager)) $ina_outboudsumary_list->Pager = new PrevNextPager($ina_outboudsumary_list->StartRec, $ina_outboudsumary_list->DisplayRecs, $ina_outboudsumary_list->TotalRecs, $ina_outboudsumary_list->AutoHidePager) ?>
<?php if ($ina_outboudsumary_list->Pager->RecordCount > 0 && $ina_outboudsumary_list->Pager->Visible) { ?>
<div class="ew-pager">
<span><?php echo $Language->Phrase("Page") ?>&nbsp;</span>
<div class="ew-prev-next"><div class="input-group input-group-sm">
<div class="input-group-prepend">
<!-- first page button -->
	<?php if ($ina_outboudsumary_list->Pager->FirstButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerFirst") ?>" href="<?php echo $ina_outboudsumary_list->pageUrl() ?>start=<?php echo $ina_outboudsumary_list->Pager->FirstButton->Start ?>"><i class="icon-first ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerFirst") ?>"><i class="icon-first ew-icon"></i></a>
	<?php } ?>
<!-- previous page button -->
	<?php if ($ina_outboudsumary_list->Pager->PrevButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerPrevious") ?>" href="<?php echo $ina_outboudsumary_list->pageUrl() ?>start=<?php echo $ina_outboudsumary_list->Pager->PrevButton->Start ?>"><i class="icon-prev ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerPrevious") ?>"><i class="icon-prev ew-icon"></i></a>
	<?php } ?>
</div>
<!-- current page number -->
	<input class="form-control" type="text" name="<?php echo TABLE_PAGE_NO ?>" value="<?php echo $ina_outboudsumary_list->Pager->CurrentPage ?>">
<div class="input-group-append">
<!-- next page button -->
	<?php if ($ina_outboudsumary_list->Pager->NextButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerNext") ?>" href="<?php echo $ina_outboudsumary_list->pageUrl() ?>start=<?php echo $ina_outboudsumary_list->Pager->NextButton->Start ?>"><i class="icon-next ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerNext") ?>"><i class="icon-next ew-icon"></i></a>
	<?php } ?>
<!-- last page button -->
	<?php if ($ina_outboudsumary_list->Pager->LastButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerLast") ?>" href="<?php echo $ina_outboudsumary_list->pageUrl() ?>start=<?php echo $ina_outboudsumary_list->Pager->LastButton->Start ?>"><i class="icon-last ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerLast") ?>"><i class="icon-last ew-icon"></i></a>
	<?php } ?>
</div>
</div>
</div>
<span>&nbsp;<?php echo $Language->Phrase("of") ?>&nbsp;<?php echo $ina_outboudsumary_list->Pager->PageCount ?></span>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php if ($ina_outboudsumary_list->Pager->RecordCount > 0) { ?>
<div class="ew-pager ew-rec">
	<span><?php echo $Language->Phrase("Record") ?>&nbsp;<?php echo $ina_outboudsumary_list->Pager->FromIndex ?>&nbsp;<?php echo $Language->Phrase("To") ?>&nbsp;<?php echo $ina_outboudsumary_list->Pager->ToIndex ?>&nbsp;<?php echo $Language->Phrase("Of") ?>&nbsp;<?php echo $ina_outboudsumary_list->Pager->RecordCount ?></span>
</div>
<?php } ?>
<?php if ($ina_outboudsumary_list->TotalRecs > 0 && (!$ina_outboudsumary_list->AutoHidePageSizeSelector || $ina_outboudsumary_list->Pager->Visible)) { ?>
<div class="ew-pager">
<input type="hidden" name="t" value="ina_outboudsumary">
<select name="<?php echo TABLE_REC_PER_PAGE ?>" class="form-control form-control-sm ew-tooltip" title="<?php echo $Language->phrase("RecordsPerPage") ?>" onchange="this.form.submit();">
<option value="20"<?php if ($ina_outboudsumary_list->DisplayRecs == 20) { ?> selected<?php } ?>>20</option>
<option value="50"<?php if ($ina_outboudsumary_list->DisplayRecs == 50) { ?> selected<?php } ?>>50</option>
<option value="100"<?php if ($ina_outboudsumary_list->DisplayRecs == 100) { ?> selected<?php } ?>>100</option>
<option value="200"<?php if ($ina_outboudsumary_list->DisplayRecs == 200) { ?> selected<?php } ?>>200</option>
<option value="500"<?php if ($ina_outboudsumary_list->DisplayRecs == 500) { ?> selected<?php } ?>>500</option>
<option value="ALL"<?php if ($ina_outboudsumary->getRecordsPerPage() == -1) { ?> selected<?php } ?>><?php echo $Language->Phrase("AllRecords") ?></option>
</select>
</div>
<?php } ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $ina_outboudsumary_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($ina_outboudsumary_list->TotalRecs == 0 && !$ina_outboudsumary->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $ina_outboudsumary_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$ina_outboudsumary_list->showPageFooter();
if (DEBUG_ENABLED)
	echo GetDebugMessage();
?>
<?php if (!$ina_outboudsumary->isExport()) { ?>
<script>

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php } ?>
<?php include_once "footer.php" ?>
<?php
$ina_outboudsumary_list->terminate();
?>