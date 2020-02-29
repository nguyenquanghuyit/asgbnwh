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
$spica_outboudsumary_list = new spica_outboudsumary_list();

// Run the page
$spica_outboudsumary_list->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$spica_outboudsumary_list->Page_Render();
?>
<?php include_once "header.php" ?>
<?php if (!$spica_outboudsumary->isExport()) { ?>
<script>

// Form object
currentPageID = ew.PAGE_ID = "list";
var fspica_outboudsumarylist = currentForm = new ew.Form("fspica_outboudsumarylist", "list");
fspica_outboudsumarylist.formKeyCountName = '<?php echo $spica_outboudsumary_list->FormKeyCountName ?>';

// Form_CustomValidate event
fspica_outboudsumarylist.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

	// Your custom validation code here, return false if invalid.
	return true;
}

// Use JavaScript validation or not
fspica_outboudsumarylist.validateRequired = <?php echo json_encode(CLIENT_VALIDATE) ?>;

// Dynamic selection lists
fspica_outboudsumarylist.lists["x_Nam"] = <?php echo $spica_outboudsumary_list->Nam->Lookup->toClientList() ?>;
fspica_outboudsumarylist.lists["x_Nam"].options = <?php echo JsonEncode($spica_outboudsumary_list->Nam->lookupOptions()) ?>;
fspica_outboudsumarylist.lists["x_Thang"] = <?php echo $spica_outboudsumary_list->Thang->Lookup->toClientList() ?>;
fspica_outboudsumarylist.lists["x_Thang"].options = <?php echo JsonEncode($spica_outboudsumary_list->Thang->lookupOptions()) ?>;

// Form object for search
var fspica_outboudsumarylistsrch = currentSearchForm = new ew.Form("fspica_outboudsumarylistsrch");

// Validate function for search
fspica_outboudsumarylistsrch.validate = function(fobj) {
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
fspica_outboudsumarylistsrch.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

	// Your custom validation code here, return false if invalid.
	return true;
}

// Use JavaScript validation or not
fspica_outboudsumarylistsrch.validateRequired = <?php echo json_encode(CLIENT_VALIDATE) ?>;

// Dynamic selection lists
fspica_outboudsumarylistsrch.lists["x_Nam"] = <?php echo $spica_outboudsumary_list->Nam->Lookup->toClientList() ?>;
fspica_outboudsumarylistsrch.lists["x_Nam"].options = <?php echo JsonEncode($spica_outboudsumary_list->Nam->lookupOptions()) ?>;
fspica_outboudsumarylistsrch.lists["x_Thang"] = <?php echo $spica_outboudsumary_list->Thang->Lookup->toClientList() ?>;
fspica_outboudsumarylistsrch.lists["x_Thang"].options = <?php echo JsonEncode($spica_outboudsumary_list->Thang->lookupOptions()) ?>;

// Filters
fspica_outboudsumarylistsrch.filterList = <?php echo $spica_outboudsumary_list->getFilterList() ?>;
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
<?php if (!$spica_outboudsumary->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($spica_outboudsumary_list->TotalRecs > 0 && $spica_outboudsumary_list->ExportOptions->visible()) { ?>
<?php $spica_outboudsumary_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($spica_outboudsumary_list->ImportOptions->visible()) { ?>
<?php $spica_outboudsumary_list->ImportOptions->render("body") ?>
<?php } ?>
<?php if ($spica_outboudsumary_list->SearchOptions->visible()) { ?>
<?php $spica_outboudsumary_list->SearchOptions->render("body") ?>
<?php } ?>
<?php if ($spica_outboudsumary_list->FilterOptions->visible()) { ?>
<?php $spica_outboudsumary_list->FilterOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php
$spica_outboudsumary_list->renderOtherOptions();
?>
<?php if ($Security->CanSearch()) { ?>
<?php if (!$spica_outboudsumary->isExport() && !$spica_outboudsumary->CurrentAction) { ?>
<form name="fspica_outboudsumarylistsrch" id="fspica_outboudsumarylistsrch" class="form-inline ew-form ew-ext-search-form" action="<?php echo CurrentPageName() ?>">
<?php $searchPanelClass = ($spica_outboudsumary_list->SearchWhere <> "") ? " show" : " show"; ?>
<div id="fspica_outboudsumarylistsrch-search-panel" class="ew-search-panel collapse<?php echo $searchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="spica_outboudsumary">
	<div class="ew-basic-search">
<?php
if ($SearchError == "")
	$spica_outboudsumary_list->LoadAdvancedSearch(); // Load advanced search

// Render for search
$spica_outboudsumary->RowType = ROWTYPE_SEARCH;

// Render row
$spica_outboudsumary->resetAttributes();
$spica_outboudsumary_list->renderRow();
?>
<div id="xsr_1" class="ew-row d-sm-flex">
<?php if ($spica_outboudsumary->Nam->Visible) { // Nam ?>
	<div id="xsc_Nam" class="ew-cell form-group">
		<label for="x_Nam" class="ew-search-caption ew-label"><?php echo $spica_outboudsumary->Nam->caption() ?></label>
		<span class="ew-search-operator"><?php echo $Language->phrase("=") ?><input type="hidden" name="z_Nam" id="z_Nam" value="="></span>
		<span class="ew-search-field">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="spica_outboudsumary" data-field="x_Nam" data-value-separator="<?php echo $spica_outboudsumary->Nam->displayValueSeparatorAttribute() ?>" id="x_Nam" name="x_Nam"<?php echo $spica_outboudsumary->Nam->editAttributes() ?>>
		<?php echo $spica_outboudsumary->Nam->selectOptionListHtml("x_Nam") ?>
	</select>
</div>
<?php echo $spica_outboudsumary->Nam->Lookup->getParamTag("p_x_Nam") ?>
</span>
	</div>
<?php } ?>
</div>
<div id="xsr_2" class="ew-row d-sm-flex">
<?php if ($spica_outboudsumary->Thang->Visible) { // Thang ?>
	<div id="xsc_Thang" class="ew-cell form-group">
		<label for="x_Thang" class="ew-search-caption ew-label"><?php echo $spica_outboudsumary->Thang->caption() ?></label>
		<span class="ew-search-operator"><?php echo $Language->phrase("=") ?><input type="hidden" name="z_Thang" id="z_Thang" value="="></span>
		<span class="ew-search-field">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="spica_outboudsumary" data-field="x_Thang" data-value-separator="<?php echo $spica_outboudsumary->Thang->displayValueSeparatorAttribute() ?>" id="x_Thang" name="x_Thang"<?php echo $spica_outboudsumary->Thang->editAttributes() ?>>
		<?php echo $spica_outboudsumary->Thang->selectOptionListHtml("x_Thang") ?>
	</select>
</div>
<?php echo $spica_outboudsumary->Thang->Lookup->getParamTag("p_x_Thang") ?>
</span>
	</div>
<?php } ?>
</div>
<div id="xsr_3" class="ew-row d-sm-flex">
	<div class="ew-quick-search input-group">
		<input type="text" name="<?php echo TABLE_BASIC_SEARCH ?>" id="<?php echo TABLE_BASIC_SEARCH ?>" class="form-control" value="<?php echo HtmlEncode($spica_outboudsumary_list->BasicSearch->getKeyword()) ?>" placeholder="<?php echo HtmlEncode($Language->phrase("Search")) ?>">
		<input type="hidden" name="<?php echo TABLE_BASIC_SEARCH_TYPE ?>" id="<?php echo TABLE_BASIC_SEARCH_TYPE ?>" value="<?php echo HtmlEncode($spica_outboudsumary_list->BasicSearch->getType()) ?>">
		<div class="input-group-append">
			<button class="btn btn-primary" name="btn-submit" id="btn-submit" type="submit"><?php echo $Language->phrase("SearchBtn") ?></button>
			<button type="button" data-toggle="dropdown" class="btn btn-primary dropdown-toggle dropdown-toggle-split" aria-haspopup="true" aria-expanded="false"><span id="searchtype"><?php echo $spica_outboudsumary_list->BasicSearch->getTypeNameShort() ?></span></button>
			<div class="dropdown-menu dropdown-menu-right">
				<a class="dropdown-item<?php if ($spica_outboudsumary_list->BasicSearch->getType() == "") echo " active"; ?>" href="javascript:void(0);" onclick="ew.setSearchType(this)"><?php echo $Language->phrase("QuickSearchAuto") ?></a>
				<a class="dropdown-item<?php if ($spica_outboudsumary_list->BasicSearch->getType() == "=") echo " active"; ?>" href="javascript:void(0);" onclick="ew.setSearchType(this,'=')"><?php echo $Language->phrase("QuickSearchExact") ?></a>
				<a class="dropdown-item<?php if ($spica_outboudsumary_list->BasicSearch->getType() == "AND") echo " active"; ?>" href="javascript:void(0);" onclick="ew.setSearchType(this,'AND')"><?php echo $Language->phrase("QuickSearchAll") ?></a>
				<a class="dropdown-item<?php if ($spica_outboudsumary_list->BasicSearch->getType() == "OR") echo " active"; ?>" href="javascript:void(0);" onclick="ew.setSearchType(this,'OR')"><?php echo $Language->phrase("QuickSearchAny") ?></a>
			</div>
		</div>
	</div>
</div>
	</div>
</div>
</form>
<?php } ?>
<?php } ?>
<?php $spica_outboudsumary_list->showPageHeader(); ?>
<?php
$spica_outboudsumary_list->showMessage();
?>
<?php if ($spica_outboudsumary_list->TotalRecs > 0 || $spica_outboudsumary->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($spica_outboudsumary_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> spica_outboudsumary">
<?php if (!$spica_outboudsumary->isExport()) { ?>
<div class="card-header ew-grid-upper-panel">
<?php if (!$spica_outboudsumary->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php if (!isset($spica_outboudsumary_list->Pager)) $spica_outboudsumary_list->Pager = new PrevNextPager($spica_outboudsumary_list->StartRec, $spica_outboudsumary_list->DisplayRecs, $spica_outboudsumary_list->TotalRecs, $spica_outboudsumary_list->AutoHidePager) ?>
<?php if ($spica_outboudsumary_list->Pager->RecordCount > 0 && $spica_outboudsumary_list->Pager->Visible) { ?>
<div class="ew-pager">
<span><?php echo $Language->Phrase("Page") ?>&nbsp;</span>
<div class="ew-prev-next"><div class="input-group input-group-sm">
<div class="input-group-prepend">
<!-- first page button -->
	<?php if ($spica_outboudsumary_list->Pager->FirstButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerFirst") ?>" href="<?php echo $spica_outboudsumary_list->pageUrl() ?>start=<?php echo $spica_outboudsumary_list->Pager->FirstButton->Start ?>"><i class="icon-first ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerFirst") ?>"><i class="icon-first ew-icon"></i></a>
	<?php } ?>
<!-- previous page button -->
	<?php if ($spica_outboudsumary_list->Pager->PrevButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerPrevious") ?>" href="<?php echo $spica_outboudsumary_list->pageUrl() ?>start=<?php echo $spica_outboudsumary_list->Pager->PrevButton->Start ?>"><i class="icon-prev ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerPrevious") ?>"><i class="icon-prev ew-icon"></i></a>
	<?php } ?>
</div>
<!-- current page number -->
	<input class="form-control" type="text" name="<?php echo TABLE_PAGE_NO ?>" value="<?php echo $spica_outboudsumary_list->Pager->CurrentPage ?>">
<div class="input-group-append">
<!-- next page button -->
	<?php if ($spica_outboudsumary_list->Pager->NextButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerNext") ?>" href="<?php echo $spica_outboudsumary_list->pageUrl() ?>start=<?php echo $spica_outboudsumary_list->Pager->NextButton->Start ?>"><i class="icon-next ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerNext") ?>"><i class="icon-next ew-icon"></i></a>
	<?php } ?>
<!-- last page button -->
	<?php if ($spica_outboudsumary_list->Pager->LastButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerLast") ?>" href="<?php echo $spica_outboudsumary_list->pageUrl() ?>start=<?php echo $spica_outboudsumary_list->Pager->LastButton->Start ?>"><i class="icon-last ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerLast") ?>"><i class="icon-last ew-icon"></i></a>
	<?php } ?>
</div>
</div>
</div>
<span>&nbsp;<?php echo $Language->Phrase("of") ?>&nbsp;<?php echo $spica_outboudsumary_list->Pager->PageCount ?></span>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php if ($spica_outboudsumary_list->Pager->RecordCount > 0) { ?>
<div class="ew-pager ew-rec">
	<span><?php echo $Language->Phrase("Record") ?>&nbsp;<?php echo $spica_outboudsumary_list->Pager->FromIndex ?>&nbsp;<?php echo $Language->Phrase("To") ?>&nbsp;<?php echo $spica_outboudsumary_list->Pager->ToIndex ?>&nbsp;<?php echo $Language->Phrase("Of") ?>&nbsp;<?php echo $spica_outboudsumary_list->Pager->RecordCount ?></span>
</div>
<?php } ?>
<?php if ($spica_outboudsumary_list->TotalRecs > 0 && (!$spica_outboudsumary_list->AutoHidePageSizeSelector || $spica_outboudsumary_list->Pager->Visible)) { ?>
<div class="ew-pager">
<input type="hidden" name="t" value="spica_outboudsumary">
<select name="<?php echo TABLE_REC_PER_PAGE ?>" class="form-control form-control-sm ew-tooltip" title="<?php echo $Language->phrase("RecordsPerPage") ?>" onchange="this.form.submit();">
<option value="20"<?php if ($spica_outboudsumary_list->DisplayRecs == 20) { ?> selected<?php } ?>>20</option>
<option value="50"<?php if ($spica_outboudsumary_list->DisplayRecs == 50) { ?> selected<?php } ?>>50</option>
<option value="100"<?php if ($spica_outboudsumary_list->DisplayRecs == 100) { ?> selected<?php } ?>>100</option>
<option value="200"<?php if ($spica_outboudsumary_list->DisplayRecs == 200) { ?> selected<?php } ?>>200</option>
<option value="500"<?php if ($spica_outboudsumary_list->DisplayRecs == 500) { ?> selected<?php } ?>>500</option>
<option value="ALL"<?php if ($spica_outboudsumary->getRecordsPerPage() == -1) { ?> selected<?php } ?>><?php echo $Language->Phrase("AllRecords") ?></option>
</select>
</div>
<?php } ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $spica_outboudsumary_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
<form name="fspica_outboudsumarylist" id="fspica_outboudsumarylist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($spica_outboudsumary_list->CheckToken) { ?>
<input type="hidden" name="<?php echo TOKEN_NAME ?>" value="<?php echo $spica_outboudsumary_list->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="spica_outboudsumary">
<div id="gmp_spica_outboudsumary" class="<?php if (IsResponsiveLayout()) { ?>table-responsive <?php } ?>card-body ew-grid-middle-panel">
<?php if ($spica_outboudsumary_list->TotalRecs > 0 || $spica_outboudsumary->isGridEdit()) { ?>
<table id="tbl_spica_outboudsumarylist" class="table ew-table"><!-- .ew-table ##-->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$spica_outboudsumary_list->RowType = ROWTYPE_HEADER;

// Render list options
$spica_outboudsumary_list->renderListOptions();

// Render list options (header, left)
$spica_outboudsumary_list->ListOptions->render("header", "left");
?>
<?php if ($spica_outboudsumary->Nam->Visible) { // Nam ?>
	<?php if ($spica_outboudsumary->sortUrl($spica_outboudsumary->Nam) == "") { ?>
		<th data-name="Nam" class="<?php echo $spica_outboudsumary->Nam->headerCellClass() ?>" style="white-space: nowrap;"><div id="elh_spica_outboudsumary_Nam" class="spica_outboudsumary_Nam"><div class="ew-table-header-caption"><?php echo $spica_outboudsumary->Nam->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Nam" class="<?php echo $spica_outboudsumary->Nam->headerCellClass() ?>" style="white-space: nowrap;"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $spica_outboudsumary->SortUrl($spica_outboudsumary->Nam) ?>',2);"><div id="elh_spica_outboudsumary_Nam" class="spica_outboudsumary_Nam">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $spica_outboudsumary->Nam->caption() ?></span><span class="ew-table-header-sort"><?php if ($spica_outboudsumary->Nam->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($spica_outboudsumary->Nam->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($spica_outboudsumary->Thang->Visible) { // Thang ?>
	<?php if ($spica_outboudsumary->sortUrl($spica_outboudsumary->Thang) == "") { ?>
		<th data-name="Thang" class="<?php echo $spica_outboudsumary->Thang->headerCellClass() ?>" style="white-space: nowrap;"><div id="elh_spica_outboudsumary_Thang" class="spica_outboudsumary_Thang"><div class="ew-table-header-caption"><?php echo $spica_outboudsumary->Thang->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Thang" class="<?php echo $spica_outboudsumary->Thang->headerCellClass() ?>" style="white-space: nowrap;"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $spica_outboudsumary->SortUrl($spica_outboudsumary->Thang) ?>',2);"><div id="elh_spica_outboudsumary_Thang" class="spica_outboudsumary_Thang">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $spica_outboudsumary->Thang->caption() ?></span><span class="ew-table-header-sort"><?php if ($spica_outboudsumary->Thang->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($spica_outboudsumary->Thang->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($spica_outboudsumary->TruckNo->Visible) { // TruckNo ?>
	<?php if ($spica_outboudsumary->sortUrl($spica_outboudsumary->TruckNo) == "") { ?>
		<th data-name="TruckNo" class="<?php echo $spica_outboudsumary->TruckNo->headerCellClass() ?>" style="white-space: nowrap;"><div id="elh_spica_outboudsumary_TruckNo" class="spica_outboudsumary_TruckNo"><div class="ew-table-header-caption"><?php echo $spica_outboudsumary->TruckNo->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="TruckNo" class="<?php echo $spica_outboudsumary->TruckNo->headerCellClass() ?>" style="white-space: nowrap;"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $spica_outboudsumary->SortUrl($spica_outboudsumary->TruckNo) ?>',2);"><div id="elh_spica_outboudsumary_TruckNo" class="spica_outboudsumary_TruckNo">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $spica_outboudsumary->TruckNo->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($spica_outboudsumary->TruckNo->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($spica_outboudsumary->TruckNo->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($spica_outboudsumary->Code->Visible) { // Code ?>
	<?php if ($spica_outboudsumary->sortUrl($spica_outboudsumary->Code) == "") { ?>
		<th data-name="Code" class="<?php echo $spica_outboudsumary->Code->headerCellClass() ?>" style="white-space: nowrap;"><div id="elh_spica_outboudsumary_Code" class="spica_outboudsumary_Code"><div class="ew-table-header-caption"><?php echo $spica_outboudsumary->Code->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Code" class="<?php echo $spica_outboudsumary->Code->headerCellClass() ?>" style="white-space: nowrap;"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $spica_outboudsumary->SortUrl($spica_outboudsumary->Code) ?>',2);"><div id="elh_spica_outboudsumary_Code" class="spica_outboudsumary_Code">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $spica_outboudsumary->Code->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($spica_outboudsumary->Code->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($spica_outboudsumary->Code->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($spica_outboudsumary->ProductName->Visible) { // ProductName ?>
	<?php if ($spica_outboudsumary->sortUrl($spica_outboudsumary->ProductName) == "") { ?>
		<th data-name="ProductName" class="<?php echo $spica_outboudsumary->ProductName->headerCellClass() ?>" style="white-space: nowrap;"><div id="elh_spica_outboudsumary_ProductName" class="spica_outboudsumary_ProductName"><div class="ew-table-header-caption"><?php echo $spica_outboudsumary->ProductName->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="ProductName" class="<?php echo $spica_outboudsumary->ProductName->headerCellClass() ?>" style="white-space: nowrap;"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $spica_outboudsumary->SortUrl($spica_outboudsumary->ProductName) ?>',2);"><div id="elh_spica_outboudsumary_ProductName" class="spica_outboudsumary_ProductName">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $spica_outboudsumary->ProductName->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($spica_outboudsumary->ProductName->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($spica_outboudsumary->ProductName->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($spica_outboudsumary->PCS->Visible) { // PCS ?>
	<?php if ($spica_outboudsumary->sortUrl($spica_outboudsumary->PCS) == "") { ?>
		<th data-name="PCS" class="<?php echo $spica_outboudsumary->PCS->headerCellClass() ?>" style="white-space: nowrap;"><div id="elh_spica_outboudsumary_PCS" class="spica_outboudsumary_PCS"><div class="ew-table-header-caption"><?php echo $spica_outboudsumary->PCS->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="PCS" class="<?php echo $spica_outboudsumary->PCS->headerCellClass() ?>" style="white-space: nowrap;"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $spica_outboudsumary->SortUrl($spica_outboudsumary->PCS) ?>',2);"><div id="elh_spica_outboudsumary_PCS" class="spica_outboudsumary_PCS">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $spica_outboudsumary->PCS->caption() ?></span><span class="ew-table-header-sort"><?php if ($spica_outboudsumary->PCS->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($spica_outboudsumary->PCS->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$spica_outboudsumary_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
if ($spica_outboudsumary->ExportAll && $spica_outboudsumary->isExport()) {
	$spica_outboudsumary_list->StopRec = $spica_outboudsumary_list->TotalRecs;
} else {

	// Set the last record to display
	if ($spica_outboudsumary_list->TotalRecs > $spica_outboudsumary_list->StartRec + $spica_outboudsumary_list->DisplayRecs - 1)
		$spica_outboudsumary_list->StopRec = $spica_outboudsumary_list->StartRec + $spica_outboudsumary_list->DisplayRecs - 1;
	else
		$spica_outboudsumary_list->StopRec = $spica_outboudsumary_list->TotalRecs;
}
$spica_outboudsumary_list->RecCnt = $spica_outboudsumary_list->StartRec - 1;
if ($spica_outboudsumary_list->Recordset && !$spica_outboudsumary_list->Recordset->EOF) {
	$spica_outboudsumary_list->Recordset->moveFirst();
	$selectLimit = $spica_outboudsumary_list->UseSelectLimit;
	if (!$selectLimit && $spica_outboudsumary_list->StartRec > 1)
		$spica_outboudsumary_list->Recordset->move($spica_outboudsumary_list->StartRec - 1);
} elseif (!$spica_outboudsumary->AllowAddDeleteRow && $spica_outboudsumary_list->StopRec == 0) {
	$spica_outboudsumary_list->StopRec = $spica_outboudsumary->GridAddRowCount;
}

// Initialize aggregate
$spica_outboudsumary->RowType = ROWTYPE_AGGREGATEINIT;
$spica_outboudsumary->resetAttributes();
$spica_outboudsumary_list->renderRow();
while ($spica_outboudsumary_list->RecCnt < $spica_outboudsumary_list->StopRec) {
	$spica_outboudsumary_list->RecCnt++;
	if ($spica_outboudsumary_list->RecCnt >= $spica_outboudsumary_list->StartRec) {
		$spica_outboudsumary_list->RowCnt++;

		// Set up key count
		$spica_outboudsumary_list->KeyCount = $spica_outboudsumary_list->RowIndex;

		// Init row class and style
		$spica_outboudsumary->resetAttributes();
		$spica_outboudsumary->CssClass = "";
		if ($spica_outboudsumary->isGridAdd()) {
		} else {
			$spica_outboudsumary_list->loadRowValues($spica_outboudsumary_list->Recordset); // Load row values
		}
		$spica_outboudsumary->RowType = ROWTYPE_VIEW; // Render view

		// Set up row id / data-rowindex
		$spica_outboudsumary->RowAttrs = array_merge($spica_outboudsumary->RowAttrs, array('data-rowindex'=>$spica_outboudsumary_list->RowCnt, 'id'=>'r' . $spica_outboudsumary_list->RowCnt . '_spica_outboudsumary', 'data-rowtype'=>$spica_outboudsumary->RowType));

		// Render row
		$spica_outboudsumary_list->renderRow();

		// Render list options
		$spica_outboudsumary_list->renderListOptions();
?>
	<tr<?php echo $spica_outboudsumary->rowAttributes() ?>>
<?php

// Render list options (body, left)
$spica_outboudsumary_list->ListOptions->render("body", "left", $spica_outboudsumary_list->RowCnt);
?>
	<?php if ($spica_outboudsumary->Nam->Visible) { // Nam ?>
		<td data-name="Nam"<?php echo $spica_outboudsumary->Nam->cellAttributes() ?>>
<span id="el<?php echo $spica_outboudsumary_list->RowCnt ?>_spica_outboudsumary_Nam" class="spica_outboudsumary_Nam">
<span<?php echo $spica_outboudsumary->Nam->viewAttributes() ?>>
<?php echo $spica_outboudsumary->Nam->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($spica_outboudsumary->Thang->Visible) { // Thang ?>
		<td data-name="Thang"<?php echo $spica_outboudsumary->Thang->cellAttributes() ?>>
<span id="el<?php echo $spica_outboudsumary_list->RowCnt ?>_spica_outboudsumary_Thang" class="spica_outboudsumary_Thang">
<span<?php echo $spica_outboudsumary->Thang->viewAttributes() ?>>
<?php echo $spica_outboudsumary->Thang->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($spica_outboudsumary->TruckNo->Visible) { // TruckNo ?>
		<td data-name="TruckNo"<?php echo $spica_outboudsumary->TruckNo->cellAttributes() ?>>
<span id="el<?php echo $spica_outboudsumary_list->RowCnt ?>_spica_outboudsumary_TruckNo" class="spica_outboudsumary_TruckNo">
<span<?php echo $spica_outboudsumary->TruckNo->viewAttributes() ?>>
<?php echo $spica_outboudsumary->TruckNo->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($spica_outboudsumary->Code->Visible) { // Code ?>
		<td data-name="Code"<?php echo $spica_outboudsumary->Code->cellAttributes() ?>>
<span id="el<?php echo $spica_outboudsumary_list->RowCnt ?>_spica_outboudsumary_Code" class="spica_outboudsumary_Code">
<span<?php echo $spica_outboudsumary->Code->viewAttributes() ?>>
<?php echo $spica_outboudsumary->Code->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($spica_outboudsumary->ProductName->Visible) { // ProductName ?>
		<td data-name="ProductName"<?php echo $spica_outboudsumary->ProductName->cellAttributes() ?>>
<span id="el<?php echo $spica_outboudsumary_list->RowCnt ?>_spica_outboudsumary_ProductName" class="spica_outboudsumary_ProductName">
<span<?php echo $spica_outboudsumary->ProductName->viewAttributes() ?>>
<?php echo $spica_outboudsumary->ProductName->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($spica_outboudsumary->PCS->Visible) { // PCS ?>
		<td data-name="PCS"<?php echo $spica_outboudsumary->PCS->cellAttributes() ?>>
<span id="el<?php echo $spica_outboudsumary_list->RowCnt ?>_spica_outboudsumary_PCS" class="spica_outboudsumary_PCS">
<span<?php echo $spica_outboudsumary->PCS->viewAttributes() ?>>
<?php echo $spica_outboudsumary->PCS->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$spica_outboudsumary_list->ListOptions->render("body", "right", $spica_outboudsumary_list->RowCnt);
?>
	</tr>
<?php
	}
	if (!$spica_outboudsumary->isGridAdd())
		$spica_outboudsumary_list->Recordset->moveNext();
}
?>
</tbody>
</table><!-- /.ew-table -->
<?php } ?>
<?php if (!$spica_outboudsumary->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</div><!-- /.ew-grid-middle-panel -->
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($spica_outboudsumary_list->Recordset)
	$spica_outboudsumary_list->Recordset->Close();
?>
<?php if (!$spica_outboudsumary->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$spica_outboudsumary->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php if (!isset($spica_outboudsumary_list->Pager)) $spica_outboudsumary_list->Pager = new PrevNextPager($spica_outboudsumary_list->StartRec, $spica_outboudsumary_list->DisplayRecs, $spica_outboudsumary_list->TotalRecs, $spica_outboudsumary_list->AutoHidePager) ?>
<?php if ($spica_outboudsumary_list->Pager->RecordCount > 0 && $spica_outboudsumary_list->Pager->Visible) { ?>
<div class="ew-pager">
<span><?php echo $Language->Phrase("Page") ?>&nbsp;</span>
<div class="ew-prev-next"><div class="input-group input-group-sm">
<div class="input-group-prepend">
<!-- first page button -->
	<?php if ($spica_outboudsumary_list->Pager->FirstButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerFirst") ?>" href="<?php echo $spica_outboudsumary_list->pageUrl() ?>start=<?php echo $spica_outboudsumary_list->Pager->FirstButton->Start ?>"><i class="icon-first ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerFirst") ?>"><i class="icon-first ew-icon"></i></a>
	<?php } ?>
<!-- previous page button -->
	<?php if ($spica_outboudsumary_list->Pager->PrevButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerPrevious") ?>" href="<?php echo $spica_outboudsumary_list->pageUrl() ?>start=<?php echo $spica_outboudsumary_list->Pager->PrevButton->Start ?>"><i class="icon-prev ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerPrevious") ?>"><i class="icon-prev ew-icon"></i></a>
	<?php } ?>
</div>
<!-- current page number -->
	<input class="form-control" type="text" name="<?php echo TABLE_PAGE_NO ?>" value="<?php echo $spica_outboudsumary_list->Pager->CurrentPage ?>">
<div class="input-group-append">
<!-- next page button -->
	<?php if ($spica_outboudsumary_list->Pager->NextButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerNext") ?>" href="<?php echo $spica_outboudsumary_list->pageUrl() ?>start=<?php echo $spica_outboudsumary_list->Pager->NextButton->Start ?>"><i class="icon-next ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerNext") ?>"><i class="icon-next ew-icon"></i></a>
	<?php } ?>
<!-- last page button -->
	<?php if ($spica_outboudsumary_list->Pager->LastButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerLast") ?>" href="<?php echo $spica_outboudsumary_list->pageUrl() ?>start=<?php echo $spica_outboudsumary_list->Pager->LastButton->Start ?>"><i class="icon-last ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerLast") ?>"><i class="icon-last ew-icon"></i></a>
	<?php } ?>
</div>
</div>
</div>
<span>&nbsp;<?php echo $Language->Phrase("of") ?>&nbsp;<?php echo $spica_outboudsumary_list->Pager->PageCount ?></span>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php if ($spica_outboudsumary_list->Pager->RecordCount > 0) { ?>
<div class="ew-pager ew-rec">
	<span><?php echo $Language->Phrase("Record") ?>&nbsp;<?php echo $spica_outboudsumary_list->Pager->FromIndex ?>&nbsp;<?php echo $Language->Phrase("To") ?>&nbsp;<?php echo $spica_outboudsumary_list->Pager->ToIndex ?>&nbsp;<?php echo $Language->Phrase("Of") ?>&nbsp;<?php echo $spica_outboudsumary_list->Pager->RecordCount ?></span>
</div>
<?php } ?>
<?php if ($spica_outboudsumary_list->TotalRecs > 0 && (!$spica_outboudsumary_list->AutoHidePageSizeSelector || $spica_outboudsumary_list->Pager->Visible)) { ?>
<div class="ew-pager">
<input type="hidden" name="t" value="spica_outboudsumary">
<select name="<?php echo TABLE_REC_PER_PAGE ?>" class="form-control form-control-sm ew-tooltip" title="<?php echo $Language->phrase("RecordsPerPage") ?>" onchange="this.form.submit();">
<option value="20"<?php if ($spica_outboudsumary_list->DisplayRecs == 20) { ?> selected<?php } ?>>20</option>
<option value="50"<?php if ($spica_outboudsumary_list->DisplayRecs == 50) { ?> selected<?php } ?>>50</option>
<option value="100"<?php if ($spica_outboudsumary_list->DisplayRecs == 100) { ?> selected<?php } ?>>100</option>
<option value="200"<?php if ($spica_outboudsumary_list->DisplayRecs == 200) { ?> selected<?php } ?>>200</option>
<option value="500"<?php if ($spica_outboudsumary_list->DisplayRecs == 500) { ?> selected<?php } ?>>500</option>
<option value="ALL"<?php if ($spica_outboudsumary->getRecordsPerPage() == -1) { ?> selected<?php } ?>><?php echo $Language->Phrase("AllRecords") ?></option>
</select>
</div>
<?php } ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $spica_outboudsumary_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($spica_outboudsumary_list->TotalRecs == 0 && !$spica_outboudsumary->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $spica_outboudsumary_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$spica_outboudsumary_list->showPageFooter();
if (DEBUG_ENABLED)
	echo GetDebugMessage();
?>
<?php if (!$spica_outboudsumary->isExport()) { ?>
<script>

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php } ?>
<?php include_once "footer.php" ?>
<?php
$spica_outboudsumary_list->terminate();
?>