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
$spica_inboudsumary_list = new spica_inboudsumary_list();

// Run the page
$spica_inboudsumary_list->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$spica_inboudsumary_list->Page_Render();
?>
<?php include_once "header.php" ?>
<?php if (!$spica_inboudsumary->isExport()) { ?>
<script>

// Form object
currentPageID = ew.PAGE_ID = "list";
var fspica_inboudsumarylist = currentForm = new ew.Form("fspica_inboudsumarylist", "list");
fspica_inboudsumarylist.formKeyCountName = '<?php echo $spica_inboudsumary_list->FormKeyCountName ?>';

// Form_CustomValidate event
fspica_inboudsumarylist.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

	// Your custom validation code here, return false if invalid.
	return true;
}

// Use JavaScript validation or not
fspica_inboudsumarylist.validateRequired = <?php echo json_encode(CLIENT_VALIDATE) ?>;

// Dynamic selection lists
fspica_inboudsumarylist.lists["x_Nam"] = <?php echo $spica_inboudsumary_list->Nam->Lookup->toClientList() ?>;
fspica_inboudsumarylist.lists["x_Nam"].options = <?php echo JsonEncode($spica_inboudsumary_list->Nam->lookupOptions()) ?>;
fspica_inboudsumarylist.lists["x_Thang"] = <?php echo $spica_inboudsumary_list->Thang->Lookup->toClientList() ?>;
fspica_inboudsumarylist.lists["x_Thang"].options = <?php echo JsonEncode($spica_inboudsumary_list->Thang->lookupOptions()) ?>;

// Form object for search
var fspica_inboudsumarylistsrch = currentSearchForm = new ew.Form("fspica_inboudsumarylistsrch");

// Validate function for search
fspica_inboudsumarylistsrch.validate = function(fobj) {
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
fspica_inboudsumarylistsrch.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

	// Your custom validation code here, return false if invalid.
	return true;
}

// Use JavaScript validation or not
fspica_inboudsumarylistsrch.validateRequired = <?php echo json_encode(CLIENT_VALIDATE) ?>;

// Dynamic selection lists
fspica_inboudsumarylistsrch.lists["x_Nam"] = <?php echo $spica_inboudsumary_list->Nam->Lookup->toClientList() ?>;
fspica_inboudsumarylistsrch.lists["x_Nam"].options = <?php echo JsonEncode($spica_inboudsumary_list->Nam->lookupOptions()) ?>;
fspica_inboudsumarylistsrch.lists["x_Thang"] = <?php echo $spica_inboudsumary_list->Thang->Lookup->toClientList() ?>;
fspica_inboudsumarylistsrch.lists["x_Thang"].options = <?php echo JsonEncode($spica_inboudsumary_list->Thang->lookupOptions()) ?>;

// Filters
fspica_inboudsumarylistsrch.filterList = <?php echo $spica_inboudsumary_list->getFilterList() ?>;
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
<?php if (!$spica_inboudsumary->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($spica_inboudsumary_list->TotalRecs > 0 && $spica_inboudsumary_list->ExportOptions->visible()) { ?>
<?php $spica_inboudsumary_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($spica_inboudsumary_list->ImportOptions->visible()) { ?>
<?php $spica_inboudsumary_list->ImportOptions->render("body") ?>
<?php } ?>
<?php if ($spica_inboudsumary_list->SearchOptions->visible()) { ?>
<?php $spica_inboudsumary_list->SearchOptions->render("body") ?>
<?php } ?>
<?php if ($spica_inboudsumary_list->FilterOptions->visible()) { ?>
<?php $spica_inboudsumary_list->FilterOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php
$spica_inboudsumary_list->renderOtherOptions();
?>
<?php if ($Security->CanSearch()) { ?>
<?php if (!$spica_inboudsumary->isExport() && !$spica_inboudsumary->CurrentAction) { ?>
<form name="fspica_inboudsumarylistsrch" id="fspica_inboudsumarylistsrch" class="form-inline ew-form ew-ext-search-form" action="<?php echo CurrentPageName() ?>">
<?php $searchPanelClass = ($spica_inboudsumary_list->SearchWhere <> "") ? " show" : " show"; ?>
<div id="fspica_inboudsumarylistsrch-search-panel" class="ew-search-panel collapse<?php echo $searchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="spica_inboudsumary">
	<div class="ew-basic-search">
<?php
if ($SearchError == "")
	$spica_inboudsumary_list->LoadAdvancedSearch(); // Load advanced search

// Render for search
$spica_inboudsumary->RowType = ROWTYPE_SEARCH;

// Render row
$spica_inboudsumary->resetAttributes();
$spica_inboudsumary_list->renderRow();
?>
<div id="xsr_1" class="ew-row d-sm-flex">
<?php if ($spica_inboudsumary->Nam->Visible) { // Nam ?>
	<div id="xsc_Nam" class="ew-cell form-group">
		<label for="x_Nam" class="ew-search-caption ew-label"><?php echo $spica_inboudsumary->Nam->caption() ?></label>
		<span class="ew-search-operator"><?php echo $Language->phrase("=") ?><input type="hidden" name="z_Nam" id="z_Nam" value="="></span>
		<span class="ew-search-field">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="spica_inboudsumary" data-field="x_Nam" data-value-separator="<?php echo $spica_inboudsumary->Nam->displayValueSeparatorAttribute() ?>" id="x_Nam" name="x_Nam"<?php echo $spica_inboudsumary->Nam->editAttributes() ?>>
		<?php echo $spica_inboudsumary->Nam->selectOptionListHtml("x_Nam") ?>
	</select>
</div>
<?php echo $spica_inboudsumary->Nam->Lookup->getParamTag("p_x_Nam") ?>
</span>
	</div>
<?php } ?>
</div>
<div id="xsr_2" class="ew-row d-sm-flex">
<?php if ($spica_inboudsumary->Thang->Visible) { // Thang ?>
	<div id="xsc_Thang" class="ew-cell form-group">
		<label for="x_Thang" class="ew-search-caption ew-label"><?php echo $spica_inboudsumary->Thang->caption() ?></label>
		<span class="ew-search-operator"><?php echo $Language->phrase("=") ?><input type="hidden" name="z_Thang" id="z_Thang" value="="></span>
		<span class="ew-search-field">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="spica_inboudsumary" data-field="x_Thang" data-value-separator="<?php echo $spica_inboudsumary->Thang->displayValueSeparatorAttribute() ?>" id="x_Thang" name="x_Thang"<?php echo $spica_inboudsumary->Thang->editAttributes() ?>>
		<?php echo $spica_inboudsumary->Thang->selectOptionListHtml("x_Thang") ?>
	</select>
</div>
<?php echo $spica_inboudsumary->Thang->Lookup->getParamTag("p_x_Thang") ?>
</span>
	</div>
<?php } ?>
</div>
<div id="xsr_3" class="ew-row d-sm-flex">
	<div class="ew-quick-search input-group">
		<input type="text" name="<?php echo TABLE_BASIC_SEARCH ?>" id="<?php echo TABLE_BASIC_SEARCH ?>" class="form-control" value="<?php echo HtmlEncode($spica_inboudsumary_list->BasicSearch->getKeyword()) ?>" placeholder="<?php echo HtmlEncode($Language->phrase("Search")) ?>">
		<input type="hidden" name="<?php echo TABLE_BASIC_SEARCH_TYPE ?>" id="<?php echo TABLE_BASIC_SEARCH_TYPE ?>" value="<?php echo HtmlEncode($spica_inboudsumary_list->BasicSearch->getType()) ?>">
		<div class="input-group-append">
			<button class="btn btn-primary" name="btn-submit" id="btn-submit" type="submit"><?php echo $Language->phrase("SearchBtn") ?></button>
			<button type="button" data-toggle="dropdown" class="btn btn-primary dropdown-toggle dropdown-toggle-split" aria-haspopup="true" aria-expanded="false"><span id="searchtype"><?php echo $spica_inboudsumary_list->BasicSearch->getTypeNameShort() ?></span></button>
			<div class="dropdown-menu dropdown-menu-right">
				<a class="dropdown-item<?php if ($spica_inboudsumary_list->BasicSearch->getType() == "") echo " active"; ?>" href="javascript:void(0);" onclick="ew.setSearchType(this)"><?php echo $Language->phrase("QuickSearchAuto") ?></a>
				<a class="dropdown-item<?php if ($spica_inboudsumary_list->BasicSearch->getType() == "=") echo " active"; ?>" href="javascript:void(0);" onclick="ew.setSearchType(this,'=')"><?php echo $Language->phrase("QuickSearchExact") ?></a>
				<a class="dropdown-item<?php if ($spica_inboudsumary_list->BasicSearch->getType() == "AND") echo " active"; ?>" href="javascript:void(0);" onclick="ew.setSearchType(this,'AND')"><?php echo $Language->phrase("QuickSearchAll") ?></a>
				<a class="dropdown-item<?php if ($spica_inboudsumary_list->BasicSearch->getType() == "OR") echo " active"; ?>" href="javascript:void(0);" onclick="ew.setSearchType(this,'OR')"><?php echo $Language->phrase("QuickSearchAny") ?></a>
			</div>
		</div>
	</div>
</div>
	</div>
</div>
</form>
<?php } ?>
<?php } ?>
<?php $spica_inboudsumary_list->showPageHeader(); ?>
<?php
$spica_inboudsumary_list->showMessage();
?>
<?php if ($spica_inboudsumary_list->TotalRecs > 0 || $spica_inboudsumary->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($spica_inboudsumary_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> spica_inboudsumary">
<?php if (!$spica_inboudsumary->isExport()) { ?>
<div class="card-header ew-grid-upper-panel">
<?php if (!$spica_inboudsumary->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php if (!isset($spica_inboudsumary_list->Pager)) $spica_inboudsumary_list->Pager = new PrevNextPager($spica_inboudsumary_list->StartRec, $spica_inboudsumary_list->DisplayRecs, $spica_inboudsumary_list->TotalRecs, $spica_inboudsumary_list->AutoHidePager) ?>
<?php if ($spica_inboudsumary_list->Pager->RecordCount > 0 && $spica_inboudsumary_list->Pager->Visible) { ?>
<div class="ew-pager">
<span><?php echo $Language->Phrase("Page") ?>&nbsp;</span>
<div class="ew-prev-next"><div class="input-group input-group-sm">
<div class="input-group-prepend">
<!-- first page button -->
	<?php if ($spica_inboudsumary_list->Pager->FirstButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerFirst") ?>" href="<?php echo $spica_inboudsumary_list->pageUrl() ?>start=<?php echo $spica_inboudsumary_list->Pager->FirstButton->Start ?>"><i class="icon-first ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerFirst") ?>"><i class="icon-first ew-icon"></i></a>
	<?php } ?>
<!-- previous page button -->
	<?php if ($spica_inboudsumary_list->Pager->PrevButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerPrevious") ?>" href="<?php echo $spica_inboudsumary_list->pageUrl() ?>start=<?php echo $spica_inboudsumary_list->Pager->PrevButton->Start ?>"><i class="icon-prev ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerPrevious") ?>"><i class="icon-prev ew-icon"></i></a>
	<?php } ?>
</div>
<!-- current page number -->
	<input class="form-control" type="text" name="<?php echo TABLE_PAGE_NO ?>" value="<?php echo $spica_inboudsumary_list->Pager->CurrentPage ?>">
<div class="input-group-append">
<!-- next page button -->
	<?php if ($spica_inboudsumary_list->Pager->NextButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerNext") ?>" href="<?php echo $spica_inboudsumary_list->pageUrl() ?>start=<?php echo $spica_inboudsumary_list->Pager->NextButton->Start ?>"><i class="icon-next ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerNext") ?>"><i class="icon-next ew-icon"></i></a>
	<?php } ?>
<!-- last page button -->
	<?php if ($spica_inboudsumary_list->Pager->LastButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerLast") ?>" href="<?php echo $spica_inboudsumary_list->pageUrl() ?>start=<?php echo $spica_inboudsumary_list->Pager->LastButton->Start ?>"><i class="icon-last ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerLast") ?>"><i class="icon-last ew-icon"></i></a>
	<?php } ?>
</div>
</div>
</div>
<span>&nbsp;<?php echo $Language->Phrase("of") ?>&nbsp;<?php echo $spica_inboudsumary_list->Pager->PageCount ?></span>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php if ($spica_inboudsumary_list->Pager->RecordCount > 0) { ?>
<div class="ew-pager ew-rec">
	<span><?php echo $Language->Phrase("Record") ?>&nbsp;<?php echo $spica_inboudsumary_list->Pager->FromIndex ?>&nbsp;<?php echo $Language->Phrase("To") ?>&nbsp;<?php echo $spica_inboudsumary_list->Pager->ToIndex ?>&nbsp;<?php echo $Language->Phrase("Of") ?>&nbsp;<?php echo $spica_inboudsumary_list->Pager->RecordCount ?></span>
</div>
<?php } ?>
<?php if ($spica_inboudsumary_list->TotalRecs > 0 && (!$spica_inboudsumary_list->AutoHidePageSizeSelector || $spica_inboudsumary_list->Pager->Visible)) { ?>
<div class="ew-pager">
<input type="hidden" name="t" value="spica_inboudsumary">
<select name="<?php echo TABLE_REC_PER_PAGE ?>" class="form-control form-control-sm ew-tooltip" title="<?php echo $Language->phrase("RecordsPerPage") ?>" onchange="this.form.submit();">
<option value="20"<?php if ($spica_inboudsumary_list->DisplayRecs == 20) { ?> selected<?php } ?>>20</option>
<option value="50"<?php if ($spica_inboudsumary_list->DisplayRecs == 50) { ?> selected<?php } ?>>50</option>
<option value="100"<?php if ($spica_inboudsumary_list->DisplayRecs == 100) { ?> selected<?php } ?>>100</option>
<option value="200"<?php if ($spica_inboudsumary_list->DisplayRecs == 200) { ?> selected<?php } ?>>200</option>
<option value="500"<?php if ($spica_inboudsumary_list->DisplayRecs == 500) { ?> selected<?php } ?>>500</option>
<option value="ALL"<?php if ($spica_inboudsumary->getRecordsPerPage() == -1) { ?> selected<?php } ?>><?php echo $Language->Phrase("AllRecords") ?></option>
</select>
</div>
<?php } ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $spica_inboudsumary_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
<form name="fspica_inboudsumarylist" id="fspica_inboudsumarylist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($spica_inboudsumary_list->CheckToken) { ?>
<input type="hidden" name="<?php echo TOKEN_NAME ?>" value="<?php echo $spica_inboudsumary_list->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="spica_inboudsumary">
<div id="gmp_spica_inboudsumary" class="<?php if (IsResponsiveLayout()) { ?>table-responsive <?php } ?>card-body ew-grid-middle-panel">
<?php if ($spica_inboudsumary_list->TotalRecs > 0 || $spica_inboudsumary->isGridEdit()) { ?>
<table id="tbl_spica_inboudsumarylist" class="table ew-table"><!-- .ew-table ##-->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$spica_inboudsumary_list->RowType = ROWTYPE_HEADER;

// Render list options
$spica_inboudsumary_list->renderListOptions();

// Render list options (header, left)
$spica_inboudsumary_list->ListOptions->render("header", "left");
?>
<?php if ($spica_inboudsumary->Nam->Visible) { // Nam ?>
	<?php if ($spica_inboudsumary->sortUrl($spica_inboudsumary->Nam) == "") { ?>
		<th data-name="Nam" class="<?php echo $spica_inboudsumary->Nam->headerCellClass() ?>" style="white-space: nowrap;"><div id="elh_spica_inboudsumary_Nam" class="spica_inboudsumary_Nam"><div class="ew-table-header-caption"><?php echo $spica_inboudsumary->Nam->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Nam" class="<?php echo $spica_inboudsumary->Nam->headerCellClass() ?>" style="white-space: nowrap;"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $spica_inboudsumary->SortUrl($spica_inboudsumary->Nam) ?>',2);"><div id="elh_spica_inboudsumary_Nam" class="spica_inboudsumary_Nam">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $spica_inboudsumary->Nam->caption() ?></span><span class="ew-table-header-sort"><?php if ($spica_inboudsumary->Nam->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($spica_inboudsumary->Nam->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($spica_inboudsumary->Thang->Visible) { // Thang ?>
	<?php if ($spica_inboudsumary->sortUrl($spica_inboudsumary->Thang) == "") { ?>
		<th data-name="Thang" class="<?php echo $spica_inboudsumary->Thang->headerCellClass() ?>" style="white-space: nowrap;"><div id="elh_spica_inboudsumary_Thang" class="spica_inboudsumary_Thang"><div class="ew-table-header-caption"><?php echo $spica_inboudsumary->Thang->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Thang" class="<?php echo $spica_inboudsumary->Thang->headerCellClass() ?>" style="white-space: nowrap;"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $spica_inboudsumary->SortUrl($spica_inboudsumary->Thang) ?>',2);"><div id="elh_spica_inboudsumary_Thang" class="spica_inboudsumary_Thang">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $spica_inboudsumary->Thang->caption() ?></span><span class="ew-table-header-sort"><?php if ($spica_inboudsumary->Thang->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($spica_inboudsumary->Thang->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($spica_inboudsumary->Code->Visible) { // Code ?>
	<?php if ($spica_inboudsumary->sortUrl($spica_inboudsumary->Code) == "") { ?>
		<th data-name="Code" class="<?php echo $spica_inboudsumary->Code->headerCellClass() ?>" style="white-space: nowrap;"><div id="elh_spica_inboudsumary_Code" class="spica_inboudsumary_Code"><div class="ew-table-header-caption"><?php echo $spica_inboudsumary->Code->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Code" class="<?php echo $spica_inboudsumary->Code->headerCellClass() ?>" style="white-space: nowrap;"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $spica_inboudsumary->SortUrl($spica_inboudsumary->Code) ?>',2);"><div id="elh_spica_inboudsumary_Code" class="spica_inboudsumary_Code">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $spica_inboudsumary->Code->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($spica_inboudsumary->Code->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($spica_inboudsumary->Code->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($spica_inboudsumary->ProductName->Visible) { // ProductName ?>
	<?php if ($spica_inboudsumary->sortUrl($spica_inboudsumary->ProductName) == "") { ?>
		<th data-name="ProductName" class="<?php echo $spica_inboudsumary->ProductName->headerCellClass() ?>" style="white-space: nowrap;"><div id="elh_spica_inboudsumary_ProductName" class="spica_inboudsumary_ProductName"><div class="ew-table-header-caption"><?php echo $spica_inboudsumary->ProductName->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="ProductName" class="<?php echo $spica_inboudsumary->ProductName->headerCellClass() ?>" style="white-space: nowrap;"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $spica_inboudsumary->SortUrl($spica_inboudsumary->ProductName) ?>',2);"><div id="elh_spica_inboudsumary_ProductName" class="spica_inboudsumary_ProductName">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $spica_inboudsumary->ProductName->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($spica_inboudsumary->ProductName->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($spica_inboudsumary->ProductName->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($spica_inboudsumary->PCS->Visible) { // PCS ?>
	<?php if ($spica_inboudsumary->sortUrl($spica_inboudsumary->PCS) == "") { ?>
		<th data-name="PCS" class="<?php echo $spica_inboudsumary->PCS->headerCellClass() ?>" style="white-space: nowrap;"><div id="elh_spica_inboudsumary_PCS" class="spica_inboudsumary_PCS"><div class="ew-table-header-caption"><?php echo $spica_inboudsumary->PCS->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="PCS" class="<?php echo $spica_inboudsumary->PCS->headerCellClass() ?>" style="white-space: nowrap;"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $spica_inboudsumary->SortUrl($spica_inboudsumary->PCS) ?>',2);"><div id="elh_spica_inboudsumary_PCS" class="spica_inboudsumary_PCS">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $spica_inboudsumary->PCS->caption() ?></span><span class="ew-table-header-sort"><?php if ($spica_inboudsumary->PCS->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($spica_inboudsumary->PCS->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$spica_inboudsumary_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
if ($spica_inboudsumary->ExportAll && $spica_inboudsumary->isExport()) {
	$spica_inboudsumary_list->StopRec = $spica_inboudsumary_list->TotalRecs;
} else {

	// Set the last record to display
	if ($spica_inboudsumary_list->TotalRecs > $spica_inboudsumary_list->StartRec + $spica_inboudsumary_list->DisplayRecs - 1)
		$spica_inboudsumary_list->StopRec = $spica_inboudsumary_list->StartRec + $spica_inboudsumary_list->DisplayRecs - 1;
	else
		$spica_inboudsumary_list->StopRec = $spica_inboudsumary_list->TotalRecs;
}
$spica_inboudsumary_list->RecCnt = $spica_inboudsumary_list->StartRec - 1;
if ($spica_inboudsumary_list->Recordset && !$spica_inboudsumary_list->Recordset->EOF) {
	$spica_inboudsumary_list->Recordset->moveFirst();
	$selectLimit = $spica_inboudsumary_list->UseSelectLimit;
	if (!$selectLimit && $spica_inboudsumary_list->StartRec > 1)
		$spica_inboudsumary_list->Recordset->move($spica_inboudsumary_list->StartRec - 1);
} elseif (!$spica_inboudsumary->AllowAddDeleteRow && $spica_inboudsumary_list->StopRec == 0) {
	$spica_inboudsumary_list->StopRec = $spica_inboudsumary->GridAddRowCount;
}

// Initialize aggregate
$spica_inboudsumary->RowType = ROWTYPE_AGGREGATEINIT;
$spica_inboudsumary->resetAttributes();
$spica_inboudsumary_list->renderRow();
while ($spica_inboudsumary_list->RecCnt < $spica_inboudsumary_list->StopRec) {
	$spica_inboudsumary_list->RecCnt++;
	if ($spica_inboudsumary_list->RecCnt >= $spica_inboudsumary_list->StartRec) {
		$spica_inboudsumary_list->RowCnt++;

		// Set up key count
		$spica_inboudsumary_list->KeyCount = $spica_inboudsumary_list->RowIndex;

		// Init row class and style
		$spica_inboudsumary->resetAttributes();
		$spica_inboudsumary->CssClass = "";
		if ($spica_inboudsumary->isGridAdd()) {
		} else {
			$spica_inboudsumary_list->loadRowValues($spica_inboudsumary_list->Recordset); // Load row values
		}
		$spica_inboudsumary->RowType = ROWTYPE_VIEW; // Render view

		// Set up row id / data-rowindex
		$spica_inboudsumary->RowAttrs = array_merge($spica_inboudsumary->RowAttrs, array('data-rowindex'=>$spica_inboudsumary_list->RowCnt, 'id'=>'r' . $spica_inboudsumary_list->RowCnt . '_spica_inboudsumary', 'data-rowtype'=>$spica_inboudsumary->RowType));

		// Render row
		$spica_inboudsumary_list->renderRow();

		// Render list options
		$spica_inboudsumary_list->renderListOptions();
?>
	<tr<?php echo $spica_inboudsumary->rowAttributes() ?>>
<?php

// Render list options (body, left)
$spica_inboudsumary_list->ListOptions->render("body", "left", $spica_inboudsumary_list->RowCnt);
?>
	<?php if ($spica_inboudsumary->Nam->Visible) { // Nam ?>
		<td data-name="Nam"<?php echo $spica_inboudsumary->Nam->cellAttributes() ?>>
<span id="el<?php echo $spica_inboudsumary_list->RowCnt ?>_spica_inboudsumary_Nam" class="spica_inboudsumary_Nam">
<span<?php echo $spica_inboudsumary->Nam->viewAttributes() ?>>
<?php echo $spica_inboudsumary->Nam->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($spica_inboudsumary->Thang->Visible) { // Thang ?>
		<td data-name="Thang"<?php echo $spica_inboudsumary->Thang->cellAttributes() ?>>
<span id="el<?php echo $spica_inboudsumary_list->RowCnt ?>_spica_inboudsumary_Thang" class="spica_inboudsumary_Thang">
<span<?php echo $spica_inboudsumary->Thang->viewAttributes() ?>>
<?php echo $spica_inboudsumary->Thang->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($spica_inboudsumary->Code->Visible) { // Code ?>
		<td data-name="Code"<?php echo $spica_inboudsumary->Code->cellAttributes() ?>>
<span id="el<?php echo $spica_inboudsumary_list->RowCnt ?>_spica_inboudsumary_Code" class="spica_inboudsumary_Code">
<span<?php echo $spica_inboudsumary->Code->viewAttributes() ?>>
<?php echo $spica_inboudsumary->Code->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($spica_inboudsumary->ProductName->Visible) { // ProductName ?>
		<td data-name="ProductName"<?php echo $spica_inboudsumary->ProductName->cellAttributes() ?>>
<span id="el<?php echo $spica_inboudsumary_list->RowCnt ?>_spica_inboudsumary_ProductName" class="spica_inboudsumary_ProductName">
<span<?php echo $spica_inboudsumary->ProductName->viewAttributes() ?>>
<?php echo $spica_inboudsumary->ProductName->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($spica_inboudsumary->PCS->Visible) { // PCS ?>
		<td data-name="PCS"<?php echo $spica_inboudsumary->PCS->cellAttributes() ?>>
<span id="el<?php echo $spica_inboudsumary_list->RowCnt ?>_spica_inboudsumary_PCS" class="spica_inboudsumary_PCS">
<span<?php echo $spica_inboudsumary->PCS->viewAttributes() ?>>
<?php echo $spica_inboudsumary->PCS->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$spica_inboudsumary_list->ListOptions->render("body", "right", $spica_inboudsumary_list->RowCnt);
?>
	</tr>
<?php
	}
	if (!$spica_inboudsumary->isGridAdd())
		$spica_inboudsumary_list->Recordset->moveNext();
}
?>
</tbody>
<?php

// Render aggregate row
$spica_inboudsumary->RowType = ROWTYPE_AGGREGATE;
$spica_inboudsumary->resetAttributes();
$spica_inboudsumary_list->renderRow();
?>
<?php if ($spica_inboudsumary_list->TotalRecs > 0 && !$spica_inboudsumary->isGridAdd() && !$spica_inboudsumary->isGridEdit()) { ?>
<tfoot><!-- Table footer -->
	<tr class="ew-table-footer">
<?php

// Render list options
$spica_inboudsumary_list->renderListOptions();

// Render list options (footer, left)
$spica_inboudsumary_list->ListOptions->render("footer", "left");
?>
	<?php if ($spica_inboudsumary->Nam->Visible) { // Nam ?>
		<td data-name="Nam" class="<?php echo $spica_inboudsumary->Nam->footerCellClass() ?>"><span id="elf_spica_inboudsumary_Nam" class="spica_inboudsumary_Nam">
		&nbsp;
		</span></td>
	<?php } ?>
	<?php if ($spica_inboudsumary->Thang->Visible) { // Thang ?>
		<td data-name="Thang" class="<?php echo $spica_inboudsumary->Thang->footerCellClass() ?>"><span id="elf_spica_inboudsumary_Thang" class="spica_inboudsumary_Thang">
		&nbsp;
		</span></td>
	<?php } ?>
	<?php if ($spica_inboudsumary->Code->Visible) { // Code ?>
		<td data-name="Code" class="<?php echo $spica_inboudsumary->Code->footerCellClass() ?>"><span id="elf_spica_inboudsumary_Code" class="spica_inboudsumary_Code">
		&nbsp;
		</span></td>
	<?php } ?>
	<?php if ($spica_inboudsumary->ProductName->Visible) { // ProductName ?>
		<td data-name="ProductName" class="<?php echo $spica_inboudsumary->ProductName->footerCellClass() ?>"><span id="elf_spica_inboudsumary_ProductName" class="spica_inboudsumary_ProductName">
		&nbsp;
		</span></td>
	<?php } ?>
	<?php if ($spica_inboudsumary->PCS->Visible) { // PCS ?>
		<td data-name="PCS" class="<?php echo $spica_inboudsumary->PCS->footerCellClass() ?>"><span id="elf_spica_inboudsumary_PCS" class="spica_inboudsumary_PCS">
		<span class="ew-aggregate"><?php echo $Language->phrase("TOTAL") ?></span><span class="ew-aggregate-value">
		<?php echo $spica_inboudsumary->PCS->ViewValue ?></span>
		</span></td>
	<?php } ?>
<?php

// Render list options (footer, right)
$spica_inboudsumary_list->ListOptions->render("footer", "right");
?>
	</tr>
</tfoot>
<?php } ?>
</table><!-- /.ew-table -->
<?php } ?>
<?php if (!$spica_inboudsumary->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</div><!-- /.ew-grid-middle-panel -->
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($spica_inboudsumary_list->Recordset)
	$spica_inboudsumary_list->Recordset->Close();
?>
<?php if (!$spica_inboudsumary->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$spica_inboudsumary->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php if (!isset($spica_inboudsumary_list->Pager)) $spica_inboudsumary_list->Pager = new PrevNextPager($spica_inboudsumary_list->StartRec, $spica_inboudsumary_list->DisplayRecs, $spica_inboudsumary_list->TotalRecs, $spica_inboudsumary_list->AutoHidePager) ?>
<?php if ($spica_inboudsumary_list->Pager->RecordCount > 0 && $spica_inboudsumary_list->Pager->Visible) { ?>
<div class="ew-pager">
<span><?php echo $Language->Phrase("Page") ?>&nbsp;</span>
<div class="ew-prev-next"><div class="input-group input-group-sm">
<div class="input-group-prepend">
<!-- first page button -->
	<?php if ($spica_inboudsumary_list->Pager->FirstButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerFirst") ?>" href="<?php echo $spica_inboudsumary_list->pageUrl() ?>start=<?php echo $spica_inboudsumary_list->Pager->FirstButton->Start ?>"><i class="icon-first ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerFirst") ?>"><i class="icon-first ew-icon"></i></a>
	<?php } ?>
<!-- previous page button -->
	<?php if ($spica_inboudsumary_list->Pager->PrevButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerPrevious") ?>" href="<?php echo $spica_inboudsumary_list->pageUrl() ?>start=<?php echo $spica_inboudsumary_list->Pager->PrevButton->Start ?>"><i class="icon-prev ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerPrevious") ?>"><i class="icon-prev ew-icon"></i></a>
	<?php } ?>
</div>
<!-- current page number -->
	<input class="form-control" type="text" name="<?php echo TABLE_PAGE_NO ?>" value="<?php echo $spica_inboudsumary_list->Pager->CurrentPage ?>">
<div class="input-group-append">
<!-- next page button -->
	<?php if ($spica_inboudsumary_list->Pager->NextButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerNext") ?>" href="<?php echo $spica_inboudsumary_list->pageUrl() ?>start=<?php echo $spica_inboudsumary_list->Pager->NextButton->Start ?>"><i class="icon-next ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerNext") ?>"><i class="icon-next ew-icon"></i></a>
	<?php } ?>
<!-- last page button -->
	<?php if ($spica_inboudsumary_list->Pager->LastButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerLast") ?>" href="<?php echo $spica_inboudsumary_list->pageUrl() ?>start=<?php echo $spica_inboudsumary_list->Pager->LastButton->Start ?>"><i class="icon-last ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerLast") ?>"><i class="icon-last ew-icon"></i></a>
	<?php } ?>
</div>
</div>
</div>
<span>&nbsp;<?php echo $Language->Phrase("of") ?>&nbsp;<?php echo $spica_inboudsumary_list->Pager->PageCount ?></span>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php if ($spica_inboudsumary_list->Pager->RecordCount > 0) { ?>
<div class="ew-pager ew-rec">
	<span><?php echo $Language->Phrase("Record") ?>&nbsp;<?php echo $spica_inboudsumary_list->Pager->FromIndex ?>&nbsp;<?php echo $Language->Phrase("To") ?>&nbsp;<?php echo $spica_inboudsumary_list->Pager->ToIndex ?>&nbsp;<?php echo $Language->Phrase("Of") ?>&nbsp;<?php echo $spica_inboudsumary_list->Pager->RecordCount ?></span>
</div>
<?php } ?>
<?php if ($spica_inboudsumary_list->TotalRecs > 0 && (!$spica_inboudsumary_list->AutoHidePageSizeSelector || $spica_inboudsumary_list->Pager->Visible)) { ?>
<div class="ew-pager">
<input type="hidden" name="t" value="spica_inboudsumary">
<select name="<?php echo TABLE_REC_PER_PAGE ?>" class="form-control form-control-sm ew-tooltip" title="<?php echo $Language->phrase("RecordsPerPage") ?>" onchange="this.form.submit();">
<option value="20"<?php if ($spica_inboudsumary_list->DisplayRecs == 20) { ?> selected<?php } ?>>20</option>
<option value="50"<?php if ($spica_inboudsumary_list->DisplayRecs == 50) { ?> selected<?php } ?>>50</option>
<option value="100"<?php if ($spica_inboudsumary_list->DisplayRecs == 100) { ?> selected<?php } ?>>100</option>
<option value="200"<?php if ($spica_inboudsumary_list->DisplayRecs == 200) { ?> selected<?php } ?>>200</option>
<option value="500"<?php if ($spica_inboudsumary_list->DisplayRecs == 500) { ?> selected<?php } ?>>500</option>
<option value="ALL"<?php if ($spica_inboudsumary->getRecordsPerPage() == -1) { ?> selected<?php } ?>><?php echo $Language->Phrase("AllRecords") ?></option>
</select>
</div>
<?php } ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $spica_inboudsumary_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($spica_inboudsumary_list->TotalRecs == 0 && !$spica_inboudsumary->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $spica_inboudsumary_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$spica_inboudsumary_list->showPageFooter();
if (DEBUG_ENABLED)
	echo GetDebugMessage();
?>
<?php if (!$spica_inboudsumary->isExport()) { ?>
<script>

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php } ?>
<?php include_once "footer.php" ?>
<?php
$spica_inboudsumary_list->terminate();
?>