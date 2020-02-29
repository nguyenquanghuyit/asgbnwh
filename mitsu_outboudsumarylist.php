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
$mitsu_outboudsumary_list = new mitsu_outboudsumary_list();

// Run the page
$mitsu_outboudsumary_list->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$mitsu_outboudsumary_list->Page_Render();
?>
<?php include_once "header.php" ?>
<?php if (!$mitsu_outboudsumary->isExport()) { ?>
<script>

// Form object
currentPageID = ew.PAGE_ID = "list";
var fmitsu_outboudsumarylist = currentForm = new ew.Form("fmitsu_outboudsumarylist", "list");
fmitsu_outboudsumarylist.formKeyCountName = '<?php echo $mitsu_outboudsumary_list->FormKeyCountName ?>';

// Form_CustomValidate event
fmitsu_outboudsumarylist.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

	// Your custom validation code here, return false if invalid.
	return true;
}

// Use JavaScript validation or not
fmitsu_outboudsumarylist.validateRequired = <?php echo json_encode(CLIENT_VALIDATE) ?>;

// Dynamic selection lists
fmitsu_outboudsumarylist.lists["x_Nam"] = <?php echo $mitsu_outboudsumary_list->Nam->Lookup->toClientList() ?>;
fmitsu_outboudsumarylist.lists["x_Nam"].options = <?php echo JsonEncode($mitsu_outboudsumary_list->Nam->lookupOptions()) ?>;
fmitsu_outboudsumarylist.lists["x_Thang"] = <?php echo $mitsu_outboudsumary_list->Thang->Lookup->toClientList() ?>;
fmitsu_outboudsumarylist.lists["x_Thang"].options = <?php echo JsonEncode($mitsu_outboudsumary_list->Thang->lookupOptions()) ?>;

// Form object for search
var fmitsu_outboudsumarylistsrch = currentSearchForm = new ew.Form("fmitsu_outboudsumarylistsrch");

// Validate function for search
fmitsu_outboudsumarylistsrch.validate = function(fobj) {
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
fmitsu_outboudsumarylistsrch.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

	// Your custom validation code here, return false if invalid.
	return true;
}

// Use JavaScript validation or not
fmitsu_outboudsumarylistsrch.validateRequired = <?php echo json_encode(CLIENT_VALIDATE) ?>;

// Dynamic selection lists
fmitsu_outboudsumarylistsrch.lists["x_Nam"] = <?php echo $mitsu_outboudsumary_list->Nam->Lookup->toClientList() ?>;
fmitsu_outboudsumarylistsrch.lists["x_Nam"].options = <?php echo JsonEncode($mitsu_outboudsumary_list->Nam->lookupOptions()) ?>;
fmitsu_outboudsumarylistsrch.lists["x_Thang"] = <?php echo $mitsu_outboudsumary_list->Thang->Lookup->toClientList() ?>;
fmitsu_outboudsumarylistsrch.lists["x_Thang"].options = <?php echo JsonEncode($mitsu_outboudsumary_list->Thang->lookupOptions()) ?>;

// Filters
fmitsu_outboudsumarylistsrch.filterList = <?php echo $mitsu_outboudsumary_list->getFilterList() ?>;
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
<?php if (!$mitsu_outboudsumary->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($mitsu_outboudsumary_list->TotalRecs > 0 && $mitsu_outboudsumary_list->ExportOptions->visible()) { ?>
<?php $mitsu_outboudsumary_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($mitsu_outboudsumary_list->ImportOptions->visible()) { ?>
<?php $mitsu_outboudsumary_list->ImportOptions->render("body") ?>
<?php } ?>
<?php if ($mitsu_outboudsumary_list->SearchOptions->visible()) { ?>
<?php $mitsu_outboudsumary_list->SearchOptions->render("body") ?>
<?php } ?>
<?php if ($mitsu_outboudsumary_list->FilterOptions->visible()) { ?>
<?php $mitsu_outboudsumary_list->FilterOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php
$mitsu_outboudsumary_list->renderOtherOptions();
?>
<?php if ($Security->CanSearch()) { ?>
<?php if (!$mitsu_outboudsumary->isExport() && !$mitsu_outboudsumary->CurrentAction) { ?>
<form name="fmitsu_outboudsumarylistsrch" id="fmitsu_outboudsumarylistsrch" class="form-inline ew-form ew-ext-search-form" action="<?php echo CurrentPageName() ?>">
<?php $searchPanelClass = ($mitsu_outboudsumary_list->SearchWhere <> "") ? " show" : " show"; ?>
<div id="fmitsu_outboudsumarylistsrch-search-panel" class="ew-search-panel collapse<?php echo $searchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="mitsu_outboudsumary">
	<div class="ew-basic-search">
<?php
if ($SearchError == "")
	$mitsu_outboudsumary_list->LoadAdvancedSearch(); // Load advanced search

// Render for search
$mitsu_outboudsumary->RowType = ROWTYPE_SEARCH;

// Render row
$mitsu_outboudsumary->resetAttributes();
$mitsu_outboudsumary_list->renderRow();
?>
<div id="xsr_1" class="ew-row d-sm-flex">
<?php if ($mitsu_outboudsumary->Nam->Visible) { // Nam ?>
	<div id="xsc_Nam" class="ew-cell form-group">
		<label for="x_Nam" class="ew-search-caption ew-label"><?php echo $mitsu_outboudsumary->Nam->caption() ?></label>
		<span class="ew-search-operator"><?php echo $Language->phrase("=") ?><input type="hidden" name="z_Nam" id="z_Nam" value="="></span>
		<span class="ew-search-field">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="mitsu_outboudsumary" data-field="x_Nam" data-value-separator="<?php echo $mitsu_outboudsumary->Nam->displayValueSeparatorAttribute() ?>" id="x_Nam" name="x_Nam"<?php echo $mitsu_outboudsumary->Nam->editAttributes() ?>>
		<?php echo $mitsu_outboudsumary->Nam->selectOptionListHtml("x_Nam") ?>
	</select>
</div>
<?php echo $mitsu_outboudsumary->Nam->Lookup->getParamTag("p_x_Nam") ?>
</span>
	</div>
<?php } ?>
</div>
<div id="xsr_2" class="ew-row d-sm-flex">
<?php if ($mitsu_outboudsumary->Thang->Visible) { // Thang ?>
	<div id="xsc_Thang" class="ew-cell form-group">
		<label for="x_Thang" class="ew-search-caption ew-label"><?php echo $mitsu_outboudsumary->Thang->caption() ?></label>
		<span class="ew-search-operator"><?php echo $Language->phrase("=") ?><input type="hidden" name="z_Thang" id="z_Thang" value="="></span>
		<span class="ew-search-field">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="mitsu_outboudsumary" data-field="x_Thang" data-value-separator="<?php echo $mitsu_outboudsumary->Thang->displayValueSeparatorAttribute() ?>" id="x_Thang" name="x_Thang"<?php echo $mitsu_outboudsumary->Thang->editAttributes() ?>>
		<?php echo $mitsu_outboudsumary->Thang->selectOptionListHtml("x_Thang") ?>
	</select>
</div>
<?php echo $mitsu_outboudsumary->Thang->Lookup->getParamTag("p_x_Thang") ?>
</span>
	</div>
<?php } ?>
</div>
<div id="xsr_3" class="ew-row d-sm-flex">
	<div class="ew-quick-search input-group">
		<input type="text" name="<?php echo TABLE_BASIC_SEARCH ?>" id="<?php echo TABLE_BASIC_SEARCH ?>" class="form-control" value="<?php echo HtmlEncode($mitsu_outboudsumary_list->BasicSearch->getKeyword()) ?>" placeholder="<?php echo HtmlEncode($Language->phrase("Search")) ?>">
		<input type="hidden" name="<?php echo TABLE_BASIC_SEARCH_TYPE ?>" id="<?php echo TABLE_BASIC_SEARCH_TYPE ?>" value="<?php echo HtmlEncode($mitsu_outboudsumary_list->BasicSearch->getType()) ?>">
		<div class="input-group-append">
			<button class="btn btn-primary" name="btn-submit" id="btn-submit" type="submit"><?php echo $Language->phrase("SearchBtn") ?></button>
			<button type="button" data-toggle="dropdown" class="btn btn-primary dropdown-toggle dropdown-toggle-split" aria-haspopup="true" aria-expanded="false"><span id="searchtype"><?php echo $mitsu_outboudsumary_list->BasicSearch->getTypeNameShort() ?></span></button>
			<div class="dropdown-menu dropdown-menu-right">
				<a class="dropdown-item<?php if ($mitsu_outboudsumary_list->BasicSearch->getType() == "") echo " active"; ?>" href="javascript:void(0);" onclick="ew.setSearchType(this)"><?php echo $Language->phrase("QuickSearchAuto") ?></a>
				<a class="dropdown-item<?php if ($mitsu_outboudsumary_list->BasicSearch->getType() == "=") echo " active"; ?>" href="javascript:void(0);" onclick="ew.setSearchType(this,'=')"><?php echo $Language->phrase("QuickSearchExact") ?></a>
				<a class="dropdown-item<?php if ($mitsu_outboudsumary_list->BasicSearch->getType() == "AND") echo " active"; ?>" href="javascript:void(0);" onclick="ew.setSearchType(this,'AND')"><?php echo $Language->phrase("QuickSearchAll") ?></a>
				<a class="dropdown-item<?php if ($mitsu_outboudsumary_list->BasicSearch->getType() == "OR") echo " active"; ?>" href="javascript:void(0);" onclick="ew.setSearchType(this,'OR')"><?php echo $Language->phrase("QuickSearchAny") ?></a>
			</div>
		</div>
	</div>
</div>
	</div>
</div>
</form>
<?php } ?>
<?php } ?>
<?php $mitsu_outboudsumary_list->showPageHeader(); ?>
<?php
$mitsu_outboudsumary_list->showMessage();
?>
<?php if ($mitsu_outboudsumary_list->TotalRecs > 0 || $mitsu_outboudsumary->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($mitsu_outboudsumary_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> mitsu_outboudsumary">
<?php if (!$mitsu_outboudsumary->isExport()) { ?>
<div class="card-header ew-grid-upper-panel">
<?php if (!$mitsu_outboudsumary->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php if (!isset($mitsu_outboudsumary_list->Pager)) $mitsu_outboudsumary_list->Pager = new PrevNextPager($mitsu_outboudsumary_list->StartRec, $mitsu_outboudsumary_list->DisplayRecs, $mitsu_outboudsumary_list->TotalRecs, $mitsu_outboudsumary_list->AutoHidePager) ?>
<?php if ($mitsu_outboudsumary_list->Pager->RecordCount > 0 && $mitsu_outboudsumary_list->Pager->Visible) { ?>
<div class="ew-pager">
<span><?php echo $Language->Phrase("Page") ?>&nbsp;</span>
<div class="ew-prev-next"><div class="input-group input-group-sm">
<div class="input-group-prepend">
<!-- first page button -->
	<?php if ($mitsu_outboudsumary_list->Pager->FirstButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerFirst") ?>" href="<?php echo $mitsu_outboudsumary_list->pageUrl() ?>start=<?php echo $mitsu_outboudsumary_list->Pager->FirstButton->Start ?>"><i class="icon-first ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerFirst") ?>"><i class="icon-first ew-icon"></i></a>
	<?php } ?>
<!-- previous page button -->
	<?php if ($mitsu_outboudsumary_list->Pager->PrevButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerPrevious") ?>" href="<?php echo $mitsu_outboudsumary_list->pageUrl() ?>start=<?php echo $mitsu_outboudsumary_list->Pager->PrevButton->Start ?>"><i class="icon-prev ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerPrevious") ?>"><i class="icon-prev ew-icon"></i></a>
	<?php } ?>
</div>
<!-- current page number -->
	<input class="form-control" type="text" name="<?php echo TABLE_PAGE_NO ?>" value="<?php echo $mitsu_outboudsumary_list->Pager->CurrentPage ?>">
<div class="input-group-append">
<!-- next page button -->
	<?php if ($mitsu_outboudsumary_list->Pager->NextButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerNext") ?>" href="<?php echo $mitsu_outboudsumary_list->pageUrl() ?>start=<?php echo $mitsu_outboudsumary_list->Pager->NextButton->Start ?>"><i class="icon-next ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerNext") ?>"><i class="icon-next ew-icon"></i></a>
	<?php } ?>
<!-- last page button -->
	<?php if ($mitsu_outboudsumary_list->Pager->LastButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerLast") ?>" href="<?php echo $mitsu_outboudsumary_list->pageUrl() ?>start=<?php echo $mitsu_outboudsumary_list->Pager->LastButton->Start ?>"><i class="icon-last ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerLast") ?>"><i class="icon-last ew-icon"></i></a>
	<?php } ?>
</div>
</div>
</div>
<span>&nbsp;<?php echo $Language->Phrase("of") ?>&nbsp;<?php echo $mitsu_outboudsumary_list->Pager->PageCount ?></span>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php if ($mitsu_outboudsumary_list->Pager->RecordCount > 0) { ?>
<div class="ew-pager ew-rec">
	<span><?php echo $Language->Phrase("Record") ?>&nbsp;<?php echo $mitsu_outboudsumary_list->Pager->FromIndex ?>&nbsp;<?php echo $Language->Phrase("To") ?>&nbsp;<?php echo $mitsu_outboudsumary_list->Pager->ToIndex ?>&nbsp;<?php echo $Language->Phrase("Of") ?>&nbsp;<?php echo $mitsu_outboudsumary_list->Pager->RecordCount ?></span>
</div>
<?php } ?>
<?php if ($mitsu_outboudsumary_list->TotalRecs > 0 && (!$mitsu_outboudsumary_list->AutoHidePageSizeSelector || $mitsu_outboudsumary_list->Pager->Visible)) { ?>
<div class="ew-pager">
<input type="hidden" name="t" value="mitsu_outboudsumary">
<select name="<?php echo TABLE_REC_PER_PAGE ?>" class="form-control form-control-sm ew-tooltip" title="<?php echo $Language->phrase("RecordsPerPage") ?>" onchange="this.form.submit();">
<option value="20"<?php if ($mitsu_outboudsumary_list->DisplayRecs == 20) { ?> selected<?php } ?>>20</option>
<option value="50"<?php if ($mitsu_outboudsumary_list->DisplayRecs == 50) { ?> selected<?php } ?>>50</option>
<option value="100"<?php if ($mitsu_outboudsumary_list->DisplayRecs == 100) { ?> selected<?php } ?>>100</option>
<option value="200"<?php if ($mitsu_outboudsumary_list->DisplayRecs == 200) { ?> selected<?php } ?>>200</option>
<option value="500"<?php if ($mitsu_outboudsumary_list->DisplayRecs == 500) { ?> selected<?php } ?>>500</option>
<option value="ALL"<?php if ($mitsu_outboudsumary->getRecordsPerPage() == -1) { ?> selected<?php } ?>><?php echo $Language->Phrase("AllRecords") ?></option>
</select>
</div>
<?php } ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $mitsu_outboudsumary_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
<form name="fmitsu_outboudsumarylist" id="fmitsu_outboudsumarylist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($mitsu_outboudsumary_list->CheckToken) { ?>
<input type="hidden" name="<?php echo TOKEN_NAME ?>" value="<?php echo $mitsu_outboudsumary_list->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="mitsu_outboudsumary">
<div id="gmp_mitsu_outboudsumary" class="<?php if (IsResponsiveLayout()) { ?>table-responsive <?php } ?>card-body ew-grid-middle-panel">
<?php if ($mitsu_outboudsumary_list->TotalRecs > 0 || $mitsu_outboudsumary->isGridEdit()) { ?>
<table id="tbl_mitsu_outboudsumarylist" class="table ew-table"><!-- .ew-table ##-->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$mitsu_outboudsumary_list->RowType = ROWTYPE_HEADER;

// Render list options
$mitsu_outboudsumary_list->renderListOptions();

// Render list options (header, left)
$mitsu_outboudsumary_list->ListOptions->render("header", "left");
?>
<?php if ($mitsu_outboudsumary->Nam->Visible) { // Nam ?>
	<?php if ($mitsu_outboudsumary->sortUrl($mitsu_outboudsumary->Nam) == "") { ?>
		<th data-name="Nam" class="<?php echo $mitsu_outboudsumary->Nam->headerCellClass() ?>" style="white-space: nowrap;"><div id="elh_mitsu_outboudsumary_Nam" class="mitsu_outboudsumary_Nam"><div class="ew-table-header-caption"><?php echo $mitsu_outboudsumary->Nam->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Nam" class="<?php echo $mitsu_outboudsumary->Nam->headerCellClass() ?>" style="white-space: nowrap;"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $mitsu_outboudsumary->SortUrl($mitsu_outboudsumary->Nam) ?>',2);"><div id="elh_mitsu_outboudsumary_Nam" class="mitsu_outboudsumary_Nam">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $mitsu_outboudsumary->Nam->caption() ?></span><span class="ew-table-header-sort"><?php if ($mitsu_outboudsumary->Nam->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($mitsu_outboudsumary->Nam->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($mitsu_outboudsumary->Thang->Visible) { // Thang ?>
	<?php if ($mitsu_outboudsumary->sortUrl($mitsu_outboudsumary->Thang) == "") { ?>
		<th data-name="Thang" class="<?php echo $mitsu_outboudsumary->Thang->headerCellClass() ?>" style="white-space: nowrap;"><div id="elh_mitsu_outboudsumary_Thang" class="mitsu_outboudsumary_Thang"><div class="ew-table-header-caption"><?php echo $mitsu_outboudsumary->Thang->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Thang" class="<?php echo $mitsu_outboudsumary->Thang->headerCellClass() ?>" style="white-space: nowrap;"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $mitsu_outboudsumary->SortUrl($mitsu_outboudsumary->Thang) ?>',2);"><div id="elh_mitsu_outboudsumary_Thang" class="mitsu_outboudsumary_Thang">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $mitsu_outboudsumary->Thang->caption() ?></span><span class="ew-table-header-sort"><?php if ($mitsu_outboudsumary->Thang->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($mitsu_outboudsumary->Thang->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($mitsu_outboudsumary->TruckNo->Visible) { // TruckNo ?>
	<?php if ($mitsu_outboudsumary->sortUrl($mitsu_outboudsumary->TruckNo) == "") { ?>
		<th data-name="TruckNo" class="<?php echo $mitsu_outboudsumary->TruckNo->headerCellClass() ?>" style="white-space: nowrap;"><div id="elh_mitsu_outboudsumary_TruckNo" class="mitsu_outboudsumary_TruckNo"><div class="ew-table-header-caption"><?php echo $mitsu_outboudsumary->TruckNo->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="TruckNo" class="<?php echo $mitsu_outboudsumary->TruckNo->headerCellClass() ?>" style="white-space: nowrap;"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $mitsu_outboudsumary->SortUrl($mitsu_outboudsumary->TruckNo) ?>',2);"><div id="elh_mitsu_outboudsumary_TruckNo" class="mitsu_outboudsumary_TruckNo">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $mitsu_outboudsumary->TruckNo->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($mitsu_outboudsumary->TruckNo->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($mitsu_outboudsumary->TruckNo->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($mitsu_outboudsumary->Code->Visible) { // Code ?>
	<?php if ($mitsu_outboudsumary->sortUrl($mitsu_outboudsumary->Code) == "") { ?>
		<th data-name="Code" class="<?php echo $mitsu_outboudsumary->Code->headerCellClass() ?>" style="white-space: nowrap;"><div id="elh_mitsu_outboudsumary_Code" class="mitsu_outboudsumary_Code"><div class="ew-table-header-caption"><?php echo $mitsu_outboudsumary->Code->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Code" class="<?php echo $mitsu_outboudsumary->Code->headerCellClass() ?>" style="white-space: nowrap;"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $mitsu_outboudsumary->SortUrl($mitsu_outboudsumary->Code) ?>',2);"><div id="elh_mitsu_outboudsumary_Code" class="mitsu_outboudsumary_Code">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $mitsu_outboudsumary->Code->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($mitsu_outboudsumary->Code->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($mitsu_outboudsumary->Code->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($mitsu_outboudsumary->ProductName->Visible) { // ProductName ?>
	<?php if ($mitsu_outboudsumary->sortUrl($mitsu_outboudsumary->ProductName) == "") { ?>
		<th data-name="ProductName" class="<?php echo $mitsu_outboudsumary->ProductName->headerCellClass() ?>" style="white-space: nowrap;"><div id="elh_mitsu_outboudsumary_ProductName" class="mitsu_outboudsumary_ProductName"><div class="ew-table-header-caption"><?php echo $mitsu_outboudsumary->ProductName->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="ProductName" class="<?php echo $mitsu_outboudsumary->ProductName->headerCellClass() ?>" style="white-space: nowrap;"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $mitsu_outboudsumary->SortUrl($mitsu_outboudsumary->ProductName) ?>',2);"><div id="elh_mitsu_outboudsumary_ProductName" class="mitsu_outboudsumary_ProductName">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $mitsu_outboudsumary->ProductName->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($mitsu_outboudsumary->ProductName->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($mitsu_outboudsumary->ProductName->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($mitsu_outboudsumary->PCS->Visible) { // PCS ?>
	<?php if ($mitsu_outboudsumary->sortUrl($mitsu_outboudsumary->PCS) == "") { ?>
		<th data-name="PCS" class="<?php echo $mitsu_outboudsumary->PCS->headerCellClass() ?>" style="white-space: nowrap;"><div id="elh_mitsu_outboudsumary_PCS" class="mitsu_outboudsumary_PCS"><div class="ew-table-header-caption"><?php echo $mitsu_outboudsumary->PCS->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="PCS" class="<?php echo $mitsu_outboudsumary->PCS->headerCellClass() ?>" style="white-space: nowrap;"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $mitsu_outboudsumary->SortUrl($mitsu_outboudsumary->PCS) ?>',2);"><div id="elh_mitsu_outboudsumary_PCS" class="mitsu_outboudsumary_PCS">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $mitsu_outboudsumary->PCS->caption() ?></span><span class="ew-table-header-sort"><?php if ($mitsu_outboudsumary->PCS->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($mitsu_outboudsumary->PCS->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$mitsu_outboudsumary_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
if ($mitsu_outboudsumary->ExportAll && $mitsu_outboudsumary->isExport()) {
	$mitsu_outboudsumary_list->StopRec = $mitsu_outboudsumary_list->TotalRecs;
} else {

	// Set the last record to display
	if ($mitsu_outboudsumary_list->TotalRecs > $mitsu_outboudsumary_list->StartRec + $mitsu_outboudsumary_list->DisplayRecs - 1)
		$mitsu_outboudsumary_list->StopRec = $mitsu_outboudsumary_list->StartRec + $mitsu_outboudsumary_list->DisplayRecs - 1;
	else
		$mitsu_outboudsumary_list->StopRec = $mitsu_outboudsumary_list->TotalRecs;
}
$mitsu_outboudsumary_list->RecCnt = $mitsu_outboudsumary_list->StartRec - 1;
if ($mitsu_outboudsumary_list->Recordset && !$mitsu_outboudsumary_list->Recordset->EOF) {
	$mitsu_outboudsumary_list->Recordset->moveFirst();
	$selectLimit = $mitsu_outboudsumary_list->UseSelectLimit;
	if (!$selectLimit && $mitsu_outboudsumary_list->StartRec > 1)
		$mitsu_outboudsumary_list->Recordset->move($mitsu_outboudsumary_list->StartRec - 1);
} elseif (!$mitsu_outboudsumary->AllowAddDeleteRow && $mitsu_outboudsumary_list->StopRec == 0) {
	$mitsu_outboudsumary_list->StopRec = $mitsu_outboudsumary->GridAddRowCount;
}

// Initialize aggregate
$mitsu_outboudsumary->RowType = ROWTYPE_AGGREGATEINIT;
$mitsu_outboudsumary->resetAttributes();
$mitsu_outboudsumary_list->renderRow();
while ($mitsu_outboudsumary_list->RecCnt < $mitsu_outboudsumary_list->StopRec) {
	$mitsu_outboudsumary_list->RecCnt++;
	if ($mitsu_outboudsumary_list->RecCnt >= $mitsu_outboudsumary_list->StartRec) {
		$mitsu_outboudsumary_list->RowCnt++;

		// Set up key count
		$mitsu_outboudsumary_list->KeyCount = $mitsu_outboudsumary_list->RowIndex;

		// Init row class and style
		$mitsu_outboudsumary->resetAttributes();
		$mitsu_outboudsumary->CssClass = "";
		if ($mitsu_outboudsumary->isGridAdd()) {
		} else {
			$mitsu_outboudsumary_list->loadRowValues($mitsu_outboudsumary_list->Recordset); // Load row values
		}
		$mitsu_outboudsumary->RowType = ROWTYPE_VIEW; // Render view

		// Set up row id / data-rowindex
		$mitsu_outboudsumary->RowAttrs = array_merge($mitsu_outboudsumary->RowAttrs, array('data-rowindex'=>$mitsu_outboudsumary_list->RowCnt, 'id'=>'r' . $mitsu_outboudsumary_list->RowCnt . '_mitsu_outboudsumary', 'data-rowtype'=>$mitsu_outboudsumary->RowType));

		// Render row
		$mitsu_outboudsumary_list->renderRow();

		// Render list options
		$mitsu_outboudsumary_list->renderListOptions();
?>
	<tr<?php echo $mitsu_outboudsumary->rowAttributes() ?>>
<?php

// Render list options (body, left)
$mitsu_outboudsumary_list->ListOptions->render("body", "left", $mitsu_outboudsumary_list->RowCnt);
?>
	<?php if ($mitsu_outboudsumary->Nam->Visible) { // Nam ?>
		<td data-name="Nam"<?php echo $mitsu_outboudsumary->Nam->cellAttributes() ?>>
<span id="el<?php echo $mitsu_outboudsumary_list->RowCnt ?>_mitsu_outboudsumary_Nam" class="mitsu_outboudsumary_Nam">
<span<?php echo $mitsu_outboudsumary->Nam->viewAttributes() ?>>
<?php echo $mitsu_outboudsumary->Nam->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($mitsu_outboudsumary->Thang->Visible) { // Thang ?>
		<td data-name="Thang"<?php echo $mitsu_outboudsumary->Thang->cellAttributes() ?>>
<span id="el<?php echo $mitsu_outboudsumary_list->RowCnt ?>_mitsu_outboudsumary_Thang" class="mitsu_outboudsumary_Thang">
<span<?php echo $mitsu_outboudsumary->Thang->viewAttributes() ?>>
<?php echo $mitsu_outboudsumary->Thang->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($mitsu_outboudsumary->TruckNo->Visible) { // TruckNo ?>
		<td data-name="TruckNo"<?php echo $mitsu_outboudsumary->TruckNo->cellAttributes() ?>>
<span id="el<?php echo $mitsu_outboudsumary_list->RowCnt ?>_mitsu_outboudsumary_TruckNo" class="mitsu_outboudsumary_TruckNo">
<span<?php echo $mitsu_outboudsumary->TruckNo->viewAttributes() ?>>
<?php echo $mitsu_outboudsumary->TruckNo->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($mitsu_outboudsumary->Code->Visible) { // Code ?>
		<td data-name="Code"<?php echo $mitsu_outboudsumary->Code->cellAttributes() ?>>
<span id="el<?php echo $mitsu_outboudsumary_list->RowCnt ?>_mitsu_outboudsumary_Code" class="mitsu_outboudsumary_Code">
<span<?php echo $mitsu_outboudsumary->Code->viewAttributes() ?>>
<?php echo $mitsu_outboudsumary->Code->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($mitsu_outboudsumary->ProductName->Visible) { // ProductName ?>
		<td data-name="ProductName"<?php echo $mitsu_outboudsumary->ProductName->cellAttributes() ?>>
<span id="el<?php echo $mitsu_outboudsumary_list->RowCnt ?>_mitsu_outboudsumary_ProductName" class="mitsu_outboudsumary_ProductName">
<span<?php echo $mitsu_outboudsumary->ProductName->viewAttributes() ?>>
<?php echo $mitsu_outboudsumary->ProductName->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($mitsu_outboudsumary->PCS->Visible) { // PCS ?>
		<td data-name="PCS"<?php echo $mitsu_outboudsumary->PCS->cellAttributes() ?>>
<span id="el<?php echo $mitsu_outboudsumary_list->RowCnt ?>_mitsu_outboudsumary_PCS" class="mitsu_outboudsumary_PCS">
<span<?php echo $mitsu_outboudsumary->PCS->viewAttributes() ?>>
<?php echo $mitsu_outboudsumary->PCS->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$mitsu_outboudsumary_list->ListOptions->render("body", "right", $mitsu_outboudsumary_list->RowCnt);
?>
	</tr>
<?php
	}
	if (!$mitsu_outboudsumary->isGridAdd())
		$mitsu_outboudsumary_list->Recordset->moveNext();
}
?>
</tbody>
<?php

// Render aggregate row
$mitsu_outboudsumary->RowType = ROWTYPE_AGGREGATE;
$mitsu_outboudsumary->resetAttributes();
$mitsu_outboudsumary_list->renderRow();
?>
<?php if ($mitsu_outboudsumary_list->TotalRecs > 0 && !$mitsu_outboudsumary->isGridAdd() && !$mitsu_outboudsumary->isGridEdit()) { ?>
<tfoot><!-- Table footer -->
	<tr class="ew-table-footer">
<?php

// Render list options
$mitsu_outboudsumary_list->renderListOptions();

// Render list options (footer, left)
$mitsu_outboudsumary_list->ListOptions->render("footer", "left");
?>
	<?php if ($mitsu_outboudsumary->Nam->Visible) { // Nam ?>
		<td data-name="Nam" class="<?php echo $mitsu_outboudsumary->Nam->footerCellClass() ?>"><span id="elf_mitsu_outboudsumary_Nam" class="mitsu_outboudsumary_Nam">
		&nbsp;
		</span></td>
	<?php } ?>
	<?php if ($mitsu_outboudsumary->Thang->Visible) { // Thang ?>
		<td data-name="Thang" class="<?php echo $mitsu_outboudsumary->Thang->footerCellClass() ?>"><span id="elf_mitsu_outboudsumary_Thang" class="mitsu_outboudsumary_Thang">
		&nbsp;
		</span></td>
	<?php } ?>
	<?php if ($mitsu_outboudsumary->TruckNo->Visible) { // TruckNo ?>
		<td data-name="TruckNo" class="<?php echo $mitsu_outboudsumary->TruckNo->footerCellClass() ?>"><span id="elf_mitsu_outboudsumary_TruckNo" class="mitsu_outboudsumary_TruckNo">
		&nbsp;
		</span></td>
	<?php } ?>
	<?php if ($mitsu_outboudsumary->Code->Visible) { // Code ?>
		<td data-name="Code" class="<?php echo $mitsu_outboudsumary->Code->footerCellClass() ?>"><span id="elf_mitsu_outboudsumary_Code" class="mitsu_outboudsumary_Code">
		&nbsp;
		</span></td>
	<?php } ?>
	<?php if ($mitsu_outboudsumary->ProductName->Visible) { // ProductName ?>
		<td data-name="ProductName" class="<?php echo $mitsu_outboudsumary->ProductName->footerCellClass() ?>"><span id="elf_mitsu_outboudsumary_ProductName" class="mitsu_outboudsumary_ProductName">
		&nbsp;
		</span></td>
	<?php } ?>
	<?php if ($mitsu_outboudsumary->PCS->Visible) { // PCS ?>
		<td data-name="PCS" class="<?php echo $mitsu_outboudsumary->PCS->footerCellClass() ?>"><span id="elf_mitsu_outboudsumary_PCS" class="mitsu_outboudsumary_PCS">
		<span class="ew-aggregate"><?php echo $Language->phrase("TOTAL") ?></span><span class="ew-aggregate-value">
		<?php echo $mitsu_outboudsumary->PCS->ViewValue ?></span>
		</span></td>
	<?php } ?>
<?php

// Render list options (footer, right)
$mitsu_outboudsumary_list->ListOptions->render("footer", "right");
?>
	</tr>
</tfoot>
<?php } ?>
</table><!-- /.ew-table -->
<?php } ?>
<?php if (!$mitsu_outboudsumary->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</div><!-- /.ew-grid-middle-panel -->
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($mitsu_outboudsumary_list->Recordset)
	$mitsu_outboudsumary_list->Recordset->Close();
?>
<?php if (!$mitsu_outboudsumary->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$mitsu_outboudsumary->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php if (!isset($mitsu_outboudsumary_list->Pager)) $mitsu_outboudsumary_list->Pager = new PrevNextPager($mitsu_outboudsumary_list->StartRec, $mitsu_outboudsumary_list->DisplayRecs, $mitsu_outboudsumary_list->TotalRecs, $mitsu_outboudsumary_list->AutoHidePager) ?>
<?php if ($mitsu_outboudsumary_list->Pager->RecordCount > 0 && $mitsu_outboudsumary_list->Pager->Visible) { ?>
<div class="ew-pager">
<span><?php echo $Language->Phrase("Page") ?>&nbsp;</span>
<div class="ew-prev-next"><div class="input-group input-group-sm">
<div class="input-group-prepend">
<!-- first page button -->
	<?php if ($mitsu_outboudsumary_list->Pager->FirstButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerFirst") ?>" href="<?php echo $mitsu_outboudsumary_list->pageUrl() ?>start=<?php echo $mitsu_outboudsumary_list->Pager->FirstButton->Start ?>"><i class="icon-first ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerFirst") ?>"><i class="icon-first ew-icon"></i></a>
	<?php } ?>
<!-- previous page button -->
	<?php if ($mitsu_outboudsumary_list->Pager->PrevButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerPrevious") ?>" href="<?php echo $mitsu_outboudsumary_list->pageUrl() ?>start=<?php echo $mitsu_outboudsumary_list->Pager->PrevButton->Start ?>"><i class="icon-prev ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerPrevious") ?>"><i class="icon-prev ew-icon"></i></a>
	<?php } ?>
</div>
<!-- current page number -->
	<input class="form-control" type="text" name="<?php echo TABLE_PAGE_NO ?>" value="<?php echo $mitsu_outboudsumary_list->Pager->CurrentPage ?>">
<div class="input-group-append">
<!-- next page button -->
	<?php if ($mitsu_outboudsumary_list->Pager->NextButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerNext") ?>" href="<?php echo $mitsu_outboudsumary_list->pageUrl() ?>start=<?php echo $mitsu_outboudsumary_list->Pager->NextButton->Start ?>"><i class="icon-next ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerNext") ?>"><i class="icon-next ew-icon"></i></a>
	<?php } ?>
<!-- last page button -->
	<?php if ($mitsu_outboudsumary_list->Pager->LastButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerLast") ?>" href="<?php echo $mitsu_outboudsumary_list->pageUrl() ?>start=<?php echo $mitsu_outboudsumary_list->Pager->LastButton->Start ?>"><i class="icon-last ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerLast") ?>"><i class="icon-last ew-icon"></i></a>
	<?php } ?>
</div>
</div>
</div>
<span>&nbsp;<?php echo $Language->Phrase("of") ?>&nbsp;<?php echo $mitsu_outboudsumary_list->Pager->PageCount ?></span>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php if ($mitsu_outboudsumary_list->Pager->RecordCount > 0) { ?>
<div class="ew-pager ew-rec">
	<span><?php echo $Language->Phrase("Record") ?>&nbsp;<?php echo $mitsu_outboudsumary_list->Pager->FromIndex ?>&nbsp;<?php echo $Language->Phrase("To") ?>&nbsp;<?php echo $mitsu_outboudsumary_list->Pager->ToIndex ?>&nbsp;<?php echo $Language->Phrase("Of") ?>&nbsp;<?php echo $mitsu_outboudsumary_list->Pager->RecordCount ?></span>
</div>
<?php } ?>
<?php if ($mitsu_outboudsumary_list->TotalRecs > 0 && (!$mitsu_outboudsumary_list->AutoHidePageSizeSelector || $mitsu_outboudsumary_list->Pager->Visible)) { ?>
<div class="ew-pager">
<input type="hidden" name="t" value="mitsu_outboudsumary">
<select name="<?php echo TABLE_REC_PER_PAGE ?>" class="form-control form-control-sm ew-tooltip" title="<?php echo $Language->phrase("RecordsPerPage") ?>" onchange="this.form.submit();">
<option value="20"<?php if ($mitsu_outboudsumary_list->DisplayRecs == 20) { ?> selected<?php } ?>>20</option>
<option value="50"<?php if ($mitsu_outboudsumary_list->DisplayRecs == 50) { ?> selected<?php } ?>>50</option>
<option value="100"<?php if ($mitsu_outboudsumary_list->DisplayRecs == 100) { ?> selected<?php } ?>>100</option>
<option value="200"<?php if ($mitsu_outboudsumary_list->DisplayRecs == 200) { ?> selected<?php } ?>>200</option>
<option value="500"<?php if ($mitsu_outboudsumary_list->DisplayRecs == 500) { ?> selected<?php } ?>>500</option>
<option value="ALL"<?php if ($mitsu_outboudsumary->getRecordsPerPage() == -1) { ?> selected<?php } ?>><?php echo $Language->Phrase("AllRecords") ?></option>
</select>
</div>
<?php } ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $mitsu_outboudsumary_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($mitsu_outboudsumary_list->TotalRecs == 0 && !$mitsu_outboudsumary->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $mitsu_outboudsumary_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$mitsu_outboudsumary_list->showPageFooter();
if (DEBUG_ENABLED)
	echo GetDebugMessage();
?>
<?php if (!$mitsu_outboudsumary->isExport()) { ?>
<script>

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php } ?>
<?php include_once "footer.php" ?>
<?php
$mitsu_outboudsumary_list->terminate();
?>