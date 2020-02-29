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
$fox_outboudsumary_list = new fox_outboudsumary_list();

// Run the page
$fox_outboudsumary_list->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$fox_outboudsumary_list->Page_Render();
?>
<?php include_once "header.php" ?>
<?php if (!$fox_outboudsumary->isExport()) { ?>
<script>

// Form object
currentPageID = ew.PAGE_ID = "list";
var ffox_outboudsumarylist = currentForm = new ew.Form("ffox_outboudsumarylist", "list");
ffox_outboudsumarylist.formKeyCountName = '<?php echo $fox_outboudsumary_list->FormKeyCountName ?>';

// Form_CustomValidate event
ffox_outboudsumarylist.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

	// Your custom validation code here, return false if invalid.
	return true;
}

// Use JavaScript validation or not
ffox_outboudsumarylist.validateRequired = <?php echo json_encode(CLIENT_VALIDATE) ?>;

// Dynamic selection lists
ffox_outboudsumarylist.lists["x_Nam"] = <?php echo $fox_outboudsumary_list->Nam->Lookup->toClientList() ?>;
ffox_outboudsumarylist.lists["x_Nam"].options = <?php echo JsonEncode($fox_outboudsumary_list->Nam->lookupOptions()) ?>;
ffox_outboudsumarylist.lists["x_Thang"] = <?php echo $fox_outboudsumary_list->Thang->Lookup->toClientList() ?>;
ffox_outboudsumarylist.lists["x_Thang"].options = <?php echo JsonEncode($fox_outboudsumary_list->Thang->lookupOptions()) ?>;

// Form object for search
var ffox_outboudsumarylistsrch = currentSearchForm = new ew.Form("ffox_outboudsumarylistsrch");

// Validate function for search
ffox_outboudsumarylistsrch.validate = function(fobj) {
	if (!this.validateRequired)
		return true; // Ignore validation
	fobj = fobj || this._form;
	var infix = "";

	// Fire Form_CustomValidate event
	if (!this.Form_CustomValidate(fobj))
		return false;
	return true;
}

// Form_CustomValidate event
ffox_outboudsumarylistsrch.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

	// Your custom validation code here, return false if invalid.
	return true;
}

// Use JavaScript validation or not
ffox_outboudsumarylistsrch.validateRequired = <?php echo json_encode(CLIENT_VALIDATE) ?>;

// Dynamic selection lists
ffox_outboudsumarylistsrch.lists["x_Nam"] = <?php echo $fox_outboudsumary_list->Nam->Lookup->toClientList() ?>;
ffox_outboudsumarylistsrch.lists["x_Nam"].options = <?php echo JsonEncode($fox_outboudsumary_list->Nam->lookupOptions()) ?>;
ffox_outboudsumarylistsrch.lists["x_Thang"] = <?php echo $fox_outboudsumary_list->Thang->Lookup->toClientList() ?>;
ffox_outboudsumarylistsrch.lists["x_Thang"].options = <?php echo JsonEncode($fox_outboudsumary_list->Thang->lookupOptions()) ?>;

// Filters
ffox_outboudsumarylistsrch.filterList = <?php echo $fox_outboudsumary_list->getFilterList() ?>;
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
<?php if (!$fox_outboudsumary->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($fox_outboudsumary_list->TotalRecs > 0 && $fox_outboudsumary_list->ExportOptions->visible()) { ?>
<?php $fox_outboudsumary_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($fox_outboudsumary_list->ImportOptions->visible()) { ?>
<?php $fox_outboudsumary_list->ImportOptions->render("body") ?>
<?php } ?>
<?php if ($fox_outboudsumary_list->SearchOptions->visible()) { ?>
<?php $fox_outboudsumary_list->SearchOptions->render("body") ?>
<?php } ?>
<?php if ($fox_outboudsumary_list->FilterOptions->visible()) { ?>
<?php $fox_outboudsumary_list->FilterOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php
$fox_outboudsumary_list->renderOtherOptions();
?>
<?php if ($Security->CanSearch()) { ?>
<?php if (!$fox_outboudsumary->isExport() && !$fox_outboudsumary->CurrentAction) { ?>
<form name="ffox_outboudsumarylistsrch" id="ffox_outboudsumarylistsrch" class="form-inline ew-form ew-ext-search-form" action="<?php echo CurrentPageName() ?>">
<?php $searchPanelClass = ($fox_outboudsumary_list->SearchWhere <> "") ? " show" : " show"; ?>
<div id="ffox_outboudsumarylistsrch-search-panel" class="ew-search-panel collapse<?php echo $searchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="fox_outboudsumary">
	<div class="ew-basic-search">
<?php
if ($SearchError == "")
	$fox_outboudsumary_list->LoadAdvancedSearch(); // Load advanced search

// Render for search
$fox_outboudsumary->RowType = ROWTYPE_SEARCH;

// Render row
$fox_outboudsumary->resetAttributes();
$fox_outboudsumary_list->renderRow();
?>
<div id="xsr_1" class="ew-row d-sm-flex">
<?php if ($fox_outboudsumary->Nam->Visible) { // Nam ?>
	<div id="xsc_Nam" class="ew-cell form-group">
		<label for="x_Nam" class="ew-search-caption ew-label"><?php echo $fox_outboudsumary->Nam->caption() ?></label>
		<span class="ew-search-operator"><?php echo $Language->phrase("=") ?><input type="hidden" name="z_Nam" id="z_Nam" value="="></span>
		<span class="ew-search-field">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="fox_outboudsumary" data-field="x_Nam" data-value-separator="<?php echo $fox_outboudsumary->Nam->displayValueSeparatorAttribute() ?>" id="x_Nam" name="x_Nam"<?php echo $fox_outboudsumary->Nam->editAttributes() ?>>
		<?php echo $fox_outboudsumary->Nam->selectOptionListHtml("x_Nam") ?>
	</select>
</div>
<?php echo $fox_outboudsumary->Nam->Lookup->getParamTag("p_x_Nam") ?>
</span>
	</div>
<?php } ?>
</div>
<div id="xsr_2" class="ew-row d-sm-flex">
<?php if ($fox_outboudsumary->Thang->Visible) { // Thang ?>
	<div id="xsc_Thang" class="ew-cell form-group">
		<label for="x_Thang" class="ew-search-caption ew-label"><?php echo $fox_outboudsumary->Thang->caption() ?></label>
		<span class="ew-search-operator"><?php echo $Language->phrase("=") ?><input type="hidden" name="z_Thang" id="z_Thang" value="="></span>
		<span class="ew-search-field">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="fox_outboudsumary" data-field="x_Thang" data-value-separator="<?php echo $fox_outboudsumary->Thang->displayValueSeparatorAttribute() ?>" id="x_Thang" name="x_Thang"<?php echo $fox_outboudsumary->Thang->editAttributes() ?>>
		<?php echo $fox_outboudsumary->Thang->selectOptionListHtml("x_Thang") ?>
	</select>
</div>
<?php echo $fox_outboudsumary->Thang->Lookup->getParamTag("p_x_Thang") ?>
</span>
	</div>
<?php } ?>
</div>
<div id="xsr_3" class="ew-row d-sm-flex">
	<div class="ew-quick-search input-group">
		<input type="text" name="<?php echo TABLE_BASIC_SEARCH ?>" id="<?php echo TABLE_BASIC_SEARCH ?>" class="form-control" value="<?php echo HtmlEncode($fox_outboudsumary_list->BasicSearch->getKeyword()) ?>" placeholder="<?php echo HtmlEncode($Language->phrase("Search")) ?>">
		<input type="hidden" name="<?php echo TABLE_BASIC_SEARCH_TYPE ?>" id="<?php echo TABLE_BASIC_SEARCH_TYPE ?>" value="<?php echo HtmlEncode($fox_outboudsumary_list->BasicSearch->getType()) ?>">
		<div class="input-group-append">
			<button class="btn btn-primary" name="btn-submit" id="btn-submit" type="submit"><?php echo $Language->phrase("SearchBtn") ?></button>
			<button type="button" data-toggle="dropdown" class="btn btn-primary dropdown-toggle dropdown-toggle-split" aria-haspopup="true" aria-expanded="false"><span id="searchtype"><?php echo $fox_outboudsumary_list->BasicSearch->getTypeNameShort() ?></span></button>
			<div class="dropdown-menu dropdown-menu-right">
				<a class="dropdown-item<?php if ($fox_outboudsumary_list->BasicSearch->getType() == "") echo " active"; ?>" href="javascript:void(0);" onclick="ew.setSearchType(this)"><?php echo $Language->phrase("QuickSearchAuto") ?></a>
				<a class="dropdown-item<?php if ($fox_outboudsumary_list->BasicSearch->getType() == "=") echo " active"; ?>" href="javascript:void(0);" onclick="ew.setSearchType(this,'=')"><?php echo $Language->phrase("QuickSearchExact") ?></a>
				<a class="dropdown-item<?php if ($fox_outboudsumary_list->BasicSearch->getType() == "AND") echo " active"; ?>" href="javascript:void(0);" onclick="ew.setSearchType(this,'AND')"><?php echo $Language->phrase("QuickSearchAll") ?></a>
				<a class="dropdown-item<?php if ($fox_outboudsumary_list->BasicSearch->getType() == "OR") echo " active"; ?>" href="javascript:void(0);" onclick="ew.setSearchType(this,'OR')"><?php echo $Language->phrase("QuickSearchAny") ?></a>
			</div>
		</div>
	</div>
</div>
	</div>
</div>
</form>
<?php } ?>
<?php } ?>
<?php $fox_outboudsumary_list->showPageHeader(); ?>
<?php
$fox_outboudsumary_list->showMessage();
?>
<?php if ($fox_outboudsumary_list->TotalRecs > 0 || $fox_outboudsumary->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($fox_outboudsumary_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> fox_outboudsumary">
<?php if (!$fox_outboudsumary->isExport()) { ?>
<div class="card-header ew-grid-upper-panel">
<?php if (!$fox_outboudsumary->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php if (!isset($fox_outboudsumary_list->Pager)) $fox_outboudsumary_list->Pager = new PrevNextPager($fox_outboudsumary_list->StartRec, $fox_outboudsumary_list->DisplayRecs, $fox_outboudsumary_list->TotalRecs, $fox_outboudsumary_list->AutoHidePager) ?>
<?php if ($fox_outboudsumary_list->Pager->RecordCount > 0 && $fox_outboudsumary_list->Pager->Visible) { ?>
<div class="ew-pager">
<span><?php echo $Language->Phrase("Page") ?>&nbsp;</span>
<div class="ew-prev-next"><div class="input-group input-group-sm">
<div class="input-group-prepend">
<!-- first page button -->
	<?php if ($fox_outboudsumary_list->Pager->FirstButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerFirst") ?>" href="<?php echo $fox_outboudsumary_list->pageUrl() ?>start=<?php echo $fox_outboudsumary_list->Pager->FirstButton->Start ?>"><i class="icon-first ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerFirst") ?>"><i class="icon-first ew-icon"></i></a>
	<?php } ?>
<!-- previous page button -->
	<?php if ($fox_outboudsumary_list->Pager->PrevButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerPrevious") ?>" href="<?php echo $fox_outboudsumary_list->pageUrl() ?>start=<?php echo $fox_outboudsumary_list->Pager->PrevButton->Start ?>"><i class="icon-prev ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerPrevious") ?>"><i class="icon-prev ew-icon"></i></a>
	<?php } ?>
</div>
<!-- current page number -->
	<input class="form-control" type="text" name="<?php echo TABLE_PAGE_NO ?>" value="<?php echo $fox_outboudsumary_list->Pager->CurrentPage ?>">
<div class="input-group-append">
<!-- next page button -->
	<?php if ($fox_outboudsumary_list->Pager->NextButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerNext") ?>" href="<?php echo $fox_outboudsumary_list->pageUrl() ?>start=<?php echo $fox_outboudsumary_list->Pager->NextButton->Start ?>"><i class="icon-next ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerNext") ?>"><i class="icon-next ew-icon"></i></a>
	<?php } ?>
<!-- last page button -->
	<?php if ($fox_outboudsumary_list->Pager->LastButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerLast") ?>" href="<?php echo $fox_outboudsumary_list->pageUrl() ?>start=<?php echo $fox_outboudsumary_list->Pager->LastButton->Start ?>"><i class="icon-last ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerLast") ?>"><i class="icon-last ew-icon"></i></a>
	<?php } ?>
</div>
</div>
</div>
<span>&nbsp;<?php echo $Language->Phrase("of") ?>&nbsp;<?php echo $fox_outboudsumary_list->Pager->PageCount ?></span>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php if ($fox_outboudsumary_list->Pager->RecordCount > 0) { ?>
<div class="ew-pager ew-rec">
	<span><?php echo $Language->Phrase("Record") ?>&nbsp;<?php echo $fox_outboudsumary_list->Pager->FromIndex ?>&nbsp;<?php echo $Language->Phrase("To") ?>&nbsp;<?php echo $fox_outboudsumary_list->Pager->ToIndex ?>&nbsp;<?php echo $Language->Phrase("Of") ?>&nbsp;<?php echo $fox_outboudsumary_list->Pager->RecordCount ?></span>
</div>
<?php } ?>
<?php if ($fox_outboudsumary_list->TotalRecs > 0 && (!$fox_outboudsumary_list->AutoHidePageSizeSelector || $fox_outboudsumary_list->Pager->Visible)) { ?>
<div class="ew-pager">
<input type="hidden" name="t" value="fox_outboudsumary">
<select name="<?php echo TABLE_REC_PER_PAGE ?>" class="form-control form-control-sm ew-tooltip" title="<?php echo $Language->phrase("RecordsPerPage") ?>" onchange="this.form.submit();">
<option value="20"<?php if ($fox_outboudsumary_list->DisplayRecs == 20) { ?> selected<?php } ?>>20</option>
<option value="50"<?php if ($fox_outboudsumary_list->DisplayRecs == 50) { ?> selected<?php } ?>>50</option>
<option value="100"<?php if ($fox_outboudsumary_list->DisplayRecs == 100) { ?> selected<?php } ?>>100</option>
<option value="200"<?php if ($fox_outboudsumary_list->DisplayRecs == 200) { ?> selected<?php } ?>>200</option>
<option value="500"<?php if ($fox_outboudsumary_list->DisplayRecs == 500) { ?> selected<?php } ?>>500</option>
<option value="ALL"<?php if ($fox_outboudsumary->getRecordsPerPage() == -1) { ?> selected<?php } ?>><?php echo $Language->Phrase("AllRecords") ?></option>
</select>
</div>
<?php } ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $fox_outboudsumary_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
<form name="ffox_outboudsumarylist" id="ffox_outboudsumarylist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($fox_outboudsumary_list->CheckToken) { ?>
<input type="hidden" name="<?php echo TOKEN_NAME ?>" value="<?php echo $fox_outboudsumary_list->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="fox_outboudsumary">
<div id="gmp_fox_outboudsumary" class="<?php if (IsResponsiveLayout()) { ?>table-responsive <?php } ?>card-body ew-grid-middle-panel">
<?php if ($fox_outboudsumary_list->TotalRecs > 0 || $fox_outboudsumary->isGridEdit()) { ?>
<table id="tbl_fox_outboudsumarylist" class="table ew-table"><!-- .ew-table ##-->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$fox_outboudsumary_list->RowType = ROWTYPE_HEADER;

// Render list options
$fox_outboudsumary_list->renderListOptions();

// Render list options (header, left)
$fox_outboudsumary_list->ListOptions->render("header", "left");
?>
<?php if ($fox_outboudsumary->Nam->Visible) { // Nam ?>
	<?php if ($fox_outboudsumary->sortUrl($fox_outboudsumary->Nam) == "") { ?>
		<th data-name="Nam" class="<?php echo $fox_outboudsumary->Nam->headerCellClass() ?>" style="white-space: nowrap;"><div id="elh_fox_outboudsumary_Nam" class="fox_outboudsumary_Nam"><div class="ew-table-header-caption"><?php echo $fox_outboudsumary->Nam->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Nam" class="<?php echo $fox_outboudsumary->Nam->headerCellClass() ?>" style="white-space: nowrap;"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $fox_outboudsumary->SortUrl($fox_outboudsumary->Nam) ?>',2);"><div id="elh_fox_outboudsumary_Nam" class="fox_outboudsumary_Nam">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $fox_outboudsumary->Nam->caption() ?></span><span class="ew-table-header-sort"><?php if ($fox_outboudsumary->Nam->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($fox_outboudsumary->Nam->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($fox_outboudsumary->Thang->Visible) { // Thang ?>
	<?php if ($fox_outboudsumary->sortUrl($fox_outboudsumary->Thang) == "") { ?>
		<th data-name="Thang" class="<?php echo $fox_outboudsumary->Thang->headerCellClass() ?>" style="white-space: nowrap;"><div id="elh_fox_outboudsumary_Thang" class="fox_outboudsumary_Thang"><div class="ew-table-header-caption"><?php echo $fox_outboudsumary->Thang->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Thang" class="<?php echo $fox_outboudsumary->Thang->headerCellClass() ?>" style="white-space: nowrap;"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $fox_outboudsumary->SortUrl($fox_outboudsumary->Thang) ?>',2);"><div id="elh_fox_outboudsumary_Thang" class="fox_outboudsumary_Thang">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $fox_outboudsumary->Thang->caption() ?></span><span class="ew-table-header-sort"><?php if ($fox_outboudsumary->Thang->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($fox_outboudsumary->Thang->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($fox_outboudsumary->TruckNo->Visible) { // TruckNo ?>
	<?php if ($fox_outboudsumary->sortUrl($fox_outboudsumary->TruckNo) == "") { ?>
		<th data-name="TruckNo" class="<?php echo $fox_outboudsumary->TruckNo->headerCellClass() ?>" style="white-space: nowrap;"><div id="elh_fox_outboudsumary_TruckNo" class="fox_outboudsumary_TruckNo"><div class="ew-table-header-caption"><?php echo $fox_outboudsumary->TruckNo->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="TruckNo" class="<?php echo $fox_outboudsumary->TruckNo->headerCellClass() ?>" style="white-space: nowrap;"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $fox_outboudsumary->SortUrl($fox_outboudsumary->TruckNo) ?>',2);"><div id="elh_fox_outboudsumary_TruckNo" class="fox_outboudsumary_TruckNo">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $fox_outboudsumary->TruckNo->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($fox_outboudsumary->TruckNo->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($fox_outboudsumary->TruckNo->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($fox_outboudsumary->Code->Visible) { // Code ?>
	<?php if ($fox_outboudsumary->sortUrl($fox_outboudsumary->Code) == "") { ?>
		<th data-name="Code" class="<?php echo $fox_outboudsumary->Code->headerCellClass() ?>" style="white-space: nowrap;"><div id="elh_fox_outboudsumary_Code" class="fox_outboudsumary_Code"><div class="ew-table-header-caption"><?php echo $fox_outboudsumary->Code->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Code" class="<?php echo $fox_outboudsumary->Code->headerCellClass() ?>" style="white-space: nowrap;"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $fox_outboudsumary->SortUrl($fox_outboudsumary->Code) ?>',2);"><div id="elh_fox_outboudsumary_Code" class="fox_outboudsumary_Code">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $fox_outboudsumary->Code->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($fox_outboudsumary->Code->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($fox_outboudsumary->Code->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($fox_outboudsumary->ProductName->Visible) { // ProductName ?>
	<?php if ($fox_outboudsumary->sortUrl($fox_outboudsumary->ProductName) == "") { ?>
		<th data-name="ProductName" class="<?php echo $fox_outboudsumary->ProductName->headerCellClass() ?>" style="white-space: nowrap;"><div id="elh_fox_outboudsumary_ProductName" class="fox_outboudsumary_ProductName"><div class="ew-table-header-caption"><?php echo $fox_outboudsumary->ProductName->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="ProductName" class="<?php echo $fox_outboudsumary->ProductName->headerCellClass() ?>" style="white-space: nowrap;"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $fox_outboudsumary->SortUrl($fox_outboudsumary->ProductName) ?>',2);"><div id="elh_fox_outboudsumary_ProductName" class="fox_outboudsumary_ProductName">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $fox_outboudsumary->ProductName->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($fox_outboudsumary->ProductName->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($fox_outboudsumary->ProductName->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($fox_outboudsumary->PCS->Visible) { // PCS ?>
	<?php if ($fox_outboudsumary->sortUrl($fox_outboudsumary->PCS) == "") { ?>
		<th data-name="PCS" class="<?php echo $fox_outboudsumary->PCS->headerCellClass() ?>" style="white-space: nowrap;"><div id="elh_fox_outboudsumary_PCS" class="fox_outboudsumary_PCS"><div class="ew-table-header-caption"><?php echo $fox_outboudsumary->PCS->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="PCS" class="<?php echo $fox_outboudsumary->PCS->headerCellClass() ?>" style="white-space: nowrap;"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $fox_outboudsumary->SortUrl($fox_outboudsumary->PCS) ?>',2);"><div id="elh_fox_outboudsumary_PCS" class="fox_outboudsumary_PCS">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $fox_outboudsumary->PCS->caption() ?></span><span class="ew-table-header-sort"><?php if ($fox_outboudsumary->PCS->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($fox_outboudsumary->PCS->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$fox_outboudsumary_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
if ($fox_outboudsumary->ExportAll && $fox_outboudsumary->isExport()) {
	$fox_outboudsumary_list->StopRec = $fox_outboudsumary_list->TotalRecs;
} else {

	// Set the last record to display
	if ($fox_outboudsumary_list->TotalRecs > $fox_outboudsumary_list->StartRec + $fox_outboudsumary_list->DisplayRecs - 1)
		$fox_outboudsumary_list->StopRec = $fox_outboudsumary_list->StartRec + $fox_outboudsumary_list->DisplayRecs - 1;
	else
		$fox_outboudsumary_list->StopRec = $fox_outboudsumary_list->TotalRecs;
}
$fox_outboudsumary_list->RecCnt = $fox_outboudsumary_list->StartRec - 1;
if ($fox_outboudsumary_list->Recordset && !$fox_outboudsumary_list->Recordset->EOF) {
	$fox_outboudsumary_list->Recordset->moveFirst();
	$selectLimit = $fox_outboudsumary_list->UseSelectLimit;
	if (!$selectLimit && $fox_outboudsumary_list->StartRec > 1)
		$fox_outboudsumary_list->Recordset->move($fox_outboudsumary_list->StartRec - 1);
} elseif (!$fox_outboudsumary->AllowAddDeleteRow && $fox_outboudsumary_list->StopRec == 0) {
	$fox_outboudsumary_list->StopRec = $fox_outboudsumary->GridAddRowCount;
}

// Initialize aggregate
$fox_outboudsumary->RowType = ROWTYPE_AGGREGATEINIT;
$fox_outboudsumary->resetAttributes();
$fox_outboudsumary_list->renderRow();
while ($fox_outboudsumary_list->RecCnt < $fox_outboudsumary_list->StopRec) {
	$fox_outboudsumary_list->RecCnt++;
	if ($fox_outboudsumary_list->RecCnt >= $fox_outboudsumary_list->StartRec) {
		$fox_outboudsumary_list->RowCnt++;

		// Set up key count
		$fox_outboudsumary_list->KeyCount = $fox_outboudsumary_list->RowIndex;

		// Init row class and style
		$fox_outboudsumary->resetAttributes();
		$fox_outboudsumary->CssClass = "";
		if ($fox_outboudsumary->isGridAdd()) {
		} else {
			$fox_outboudsumary_list->loadRowValues($fox_outboudsumary_list->Recordset); // Load row values
		}
		$fox_outboudsumary->RowType = ROWTYPE_VIEW; // Render view

		// Set up row id / data-rowindex
		$fox_outboudsumary->RowAttrs = array_merge($fox_outboudsumary->RowAttrs, array('data-rowindex'=>$fox_outboudsumary_list->RowCnt, 'id'=>'r' . $fox_outboudsumary_list->RowCnt . '_fox_outboudsumary', 'data-rowtype'=>$fox_outboudsumary->RowType));

		// Render row
		$fox_outboudsumary_list->renderRow();

		// Render list options
		$fox_outboudsumary_list->renderListOptions();
?>
	<tr<?php echo $fox_outboudsumary->rowAttributes() ?>>
<?php

// Render list options (body, left)
$fox_outboudsumary_list->ListOptions->render("body", "left", $fox_outboudsumary_list->RowCnt);
?>
	<?php if ($fox_outboudsumary->Nam->Visible) { // Nam ?>
		<td data-name="Nam"<?php echo $fox_outboudsumary->Nam->cellAttributes() ?>>
<span id="el<?php echo $fox_outboudsumary_list->RowCnt ?>_fox_outboudsumary_Nam" class="fox_outboudsumary_Nam">
<span<?php echo $fox_outboudsumary->Nam->viewAttributes() ?>>
<?php echo $fox_outboudsumary->Nam->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($fox_outboudsumary->Thang->Visible) { // Thang ?>
		<td data-name="Thang"<?php echo $fox_outboudsumary->Thang->cellAttributes() ?>>
<span id="el<?php echo $fox_outboudsumary_list->RowCnt ?>_fox_outboudsumary_Thang" class="fox_outboudsumary_Thang">
<span<?php echo $fox_outboudsumary->Thang->viewAttributes() ?>>
<?php echo $fox_outboudsumary->Thang->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($fox_outboudsumary->TruckNo->Visible) { // TruckNo ?>
		<td data-name="TruckNo"<?php echo $fox_outboudsumary->TruckNo->cellAttributes() ?>>
<span id="el<?php echo $fox_outboudsumary_list->RowCnt ?>_fox_outboudsumary_TruckNo" class="fox_outboudsumary_TruckNo">
<span<?php echo $fox_outboudsumary->TruckNo->viewAttributes() ?>>
<?php echo $fox_outboudsumary->TruckNo->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($fox_outboudsumary->Code->Visible) { // Code ?>
		<td data-name="Code"<?php echo $fox_outboudsumary->Code->cellAttributes() ?>>
<span id="el<?php echo $fox_outboudsumary_list->RowCnt ?>_fox_outboudsumary_Code" class="fox_outboudsumary_Code">
<span<?php echo $fox_outboudsumary->Code->viewAttributes() ?>>
<?php echo $fox_outboudsumary->Code->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($fox_outboudsumary->ProductName->Visible) { // ProductName ?>
		<td data-name="ProductName"<?php echo $fox_outboudsumary->ProductName->cellAttributes() ?>>
<span id="el<?php echo $fox_outboudsumary_list->RowCnt ?>_fox_outboudsumary_ProductName" class="fox_outboudsumary_ProductName">
<span<?php echo $fox_outboudsumary->ProductName->viewAttributes() ?>>
<?php echo $fox_outboudsumary->ProductName->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($fox_outboudsumary->PCS->Visible) { // PCS ?>
		<td data-name="PCS"<?php echo $fox_outboudsumary->PCS->cellAttributes() ?>>
<span id="el<?php echo $fox_outboudsumary_list->RowCnt ?>_fox_outboudsumary_PCS" class="fox_outboudsumary_PCS">
<span<?php echo $fox_outboudsumary->PCS->viewAttributes() ?>>
<?php echo $fox_outboudsumary->PCS->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$fox_outboudsumary_list->ListOptions->render("body", "right", $fox_outboudsumary_list->RowCnt);
?>
	</tr>
<?php
	}
	if (!$fox_outboudsumary->isGridAdd())
		$fox_outboudsumary_list->Recordset->moveNext();
}
?>
</tbody>
<?php

// Render aggregate row
$fox_outboudsumary->RowType = ROWTYPE_AGGREGATE;
$fox_outboudsumary->resetAttributes();
$fox_outboudsumary_list->renderRow();
?>
<?php if ($fox_outboudsumary_list->TotalRecs > 0 && !$fox_outboudsumary->isGridAdd() && !$fox_outboudsumary->isGridEdit()) { ?>
<tfoot><!-- Table footer -->
	<tr class="ew-table-footer">
<?php

// Render list options
$fox_outboudsumary_list->renderListOptions();

// Render list options (footer, left)
$fox_outboudsumary_list->ListOptions->render("footer", "left");
?>
	<?php if ($fox_outboudsumary->Nam->Visible) { // Nam ?>
		<td data-name="Nam" class="<?php echo $fox_outboudsumary->Nam->footerCellClass() ?>"><span id="elf_fox_outboudsumary_Nam" class="fox_outboudsumary_Nam">
		&nbsp;
		</span></td>
	<?php } ?>
	<?php if ($fox_outboudsumary->Thang->Visible) { // Thang ?>
		<td data-name="Thang" class="<?php echo $fox_outboudsumary->Thang->footerCellClass() ?>"><span id="elf_fox_outboudsumary_Thang" class="fox_outboudsumary_Thang">
		&nbsp;
		</span></td>
	<?php } ?>
	<?php if ($fox_outboudsumary->TruckNo->Visible) { // TruckNo ?>
		<td data-name="TruckNo" class="<?php echo $fox_outboudsumary->TruckNo->footerCellClass() ?>"><span id="elf_fox_outboudsumary_TruckNo" class="fox_outboudsumary_TruckNo">
		&nbsp;
		</span></td>
	<?php } ?>
	<?php if ($fox_outboudsumary->Code->Visible) { // Code ?>
		<td data-name="Code" class="<?php echo $fox_outboudsumary->Code->footerCellClass() ?>"><span id="elf_fox_outboudsumary_Code" class="fox_outboudsumary_Code">
		&nbsp;
		</span></td>
	<?php } ?>
	<?php if ($fox_outboudsumary->ProductName->Visible) { // ProductName ?>
		<td data-name="ProductName" class="<?php echo $fox_outboudsumary->ProductName->footerCellClass() ?>"><span id="elf_fox_outboudsumary_ProductName" class="fox_outboudsumary_ProductName">
		&nbsp;
		</span></td>
	<?php } ?>
	<?php if ($fox_outboudsumary->PCS->Visible) { // PCS ?>
		<td data-name="PCS" class="<?php echo $fox_outboudsumary->PCS->footerCellClass() ?>"><span id="elf_fox_outboudsumary_PCS" class="fox_outboudsumary_PCS">
		<span class="ew-aggregate"><?php echo $Language->phrase("TOTAL") ?></span><span class="ew-aggregate-value">
		<?php echo $fox_outboudsumary->PCS->ViewValue ?></span>
		</span></td>
	<?php } ?>
<?php

// Render list options (footer, right)
$fox_outboudsumary_list->ListOptions->render("footer", "right");
?>
	</tr>
</tfoot>
<?php } ?>
</table><!-- /.ew-table -->
<?php } ?>
<?php if (!$fox_outboudsumary->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</div><!-- /.ew-grid-middle-panel -->
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($fox_outboudsumary_list->Recordset)
	$fox_outboudsumary_list->Recordset->Close();
?>
<?php if (!$fox_outboudsumary->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$fox_outboudsumary->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php if (!isset($fox_outboudsumary_list->Pager)) $fox_outboudsumary_list->Pager = new PrevNextPager($fox_outboudsumary_list->StartRec, $fox_outboudsumary_list->DisplayRecs, $fox_outboudsumary_list->TotalRecs, $fox_outboudsumary_list->AutoHidePager) ?>
<?php if ($fox_outboudsumary_list->Pager->RecordCount > 0 && $fox_outboudsumary_list->Pager->Visible) { ?>
<div class="ew-pager">
<span><?php echo $Language->Phrase("Page") ?>&nbsp;</span>
<div class="ew-prev-next"><div class="input-group input-group-sm">
<div class="input-group-prepend">
<!-- first page button -->
	<?php if ($fox_outboudsumary_list->Pager->FirstButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerFirst") ?>" href="<?php echo $fox_outboudsumary_list->pageUrl() ?>start=<?php echo $fox_outboudsumary_list->Pager->FirstButton->Start ?>"><i class="icon-first ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerFirst") ?>"><i class="icon-first ew-icon"></i></a>
	<?php } ?>
<!-- previous page button -->
	<?php if ($fox_outboudsumary_list->Pager->PrevButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerPrevious") ?>" href="<?php echo $fox_outboudsumary_list->pageUrl() ?>start=<?php echo $fox_outboudsumary_list->Pager->PrevButton->Start ?>"><i class="icon-prev ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerPrevious") ?>"><i class="icon-prev ew-icon"></i></a>
	<?php } ?>
</div>
<!-- current page number -->
	<input class="form-control" type="text" name="<?php echo TABLE_PAGE_NO ?>" value="<?php echo $fox_outboudsumary_list->Pager->CurrentPage ?>">
<div class="input-group-append">
<!-- next page button -->
	<?php if ($fox_outboudsumary_list->Pager->NextButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerNext") ?>" href="<?php echo $fox_outboudsumary_list->pageUrl() ?>start=<?php echo $fox_outboudsumary_list->Pager->NextButton->Start ?>"><i class="icon-next ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerNext") ?>"><i class="icon-next ew-icon"></i></a>
	<?php } ?>
<!-- last page button -->
	<?php if ($fox_outboudsumary_list->Pager->LastButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerLast") ?>" href="<?php echo $fox_outboudsumary_list->pageUrl() ?>start=<?php echo $fox_outboudsumary_list->Pager->LastButton->Start ?>"><i class="icon-last ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerLast") ?>"><i class="icon-last ew-icon"></i></a>
	<?php } ?>
</div>
</div>
</div>
<span>&nbsp;<?php echo $Language->Phrase("of") ?>&nbsp;<?php echo $fox_outboudsumary_list->Pager->PageCount ?></span>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php if ($fox_outboudsumary_list->Pager->RecordCount > 0) { ?>
<div class="ew-pager ew-rec">
	<span><?php echo $Language->Phrase("Record") ?>&nbsp;<?php echo $fox_outboudsumary_list->Pager->FromIndex ?>&nbsp;<?php echo $Language->Phrase("To") ?>&nbsp;<?php echo $fox_outboudsumary_list->Pager->ToIndex ?>&nbsp;<?php echo $Language->Phrase("Of") ?>&nbsp;<?php echo $fox_outboudsumary_list->Pager->RecordCount ?></span>
</div>
<?php } ?>
<?php if ($fox_outboudsumary_list->TotalRecs > 0 && (!$fox_outboudsumary_list->AutoHidePageSizeSelector || $fox_outboudsumary_list->Pager->Visible)) { ?>
<div class="ew-pager">
<input type="hidden" name="t" value="fox_outboudsumary">
<select name="<?php echo TABLE_REC_PER_PAGE ?>" class="form-control form-control-sm ew-tooltip" title="<?php echo $Language->phrase("RecordsPerPage") ?>" onchange="this.form.submit();">
<option value="20"<?php if ($fox_outboudsumary_list->DisplayRecs == 20) { ?> selected<?php } ?>>20</option>
<option value="50"<?php if ($fox_outboudsumary_list->DisplayRecs == 50) { ?> selected<?php } ?>>50</option>
<option value="100"<?php if ($fox_outboudsumary_list->DisplayRecs == 100) { ?> selected<?php } ?>>100</option>
<option value="200"<?php if ($fox_outboudsumary_list->DisplayRecs == 200) { ?> selected<?php } ?>>200</option>
<option value="500"<?php if ($fox_outboudsumary_list->DisplayRecs == 500) { ?> selected<?php } ?>>500</option>
<option value="ALL"<?php if ($fox_outboudsumary->getRecordsPerPage() == -1) { ?> selected<?php } ?>><?php echo $Language->Phrase("AllRecords") ?></option>
</select>
</div>
<?php } ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $fox_outboudsumary_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($fox_outboudsumary_list->TotalRecs == 0 && !$fox_outboudsumary->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $fox_outboudsumary_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$fox_outboudsumary_list->showPageFooter();
if (DEBUG_ENABLED)
	echo GetDebugMessage();
?>
<?php if (!$fox_outboudsumary->isExport()) { ?>
<script>

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php } ?>
<?php include_once "footer.php" ?>
<?php
$fox_outboudsumary_list->terminate();
?>