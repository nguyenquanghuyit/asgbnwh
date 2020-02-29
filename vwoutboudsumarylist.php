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
$vwoutboudsumary_list = new vwoutboudsumary_list();

// Run the page
$vwoutboudsumary_list->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$vwoutboudsumary_list->Page_Render();
?>
<?php include_once "header.php" ?>
<?php if (!$vwoutboudsumary->isExport()) { ?>
<script>

// Form object
currentPageID = ew.PAGE_ID = "list";
var fvwoutboudsumarylist = currentForm = new ew.Form("fvwoutboudsumarylist", "list");
fvwoutboudsumarylist.formKeyCountName = '<?php echo $vwoutboudsumary_list->FormKeyCountName ?>';

// Form_CustomValidate event
fvwoutboudsumarylist.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

	// Your custom validation code here, return false if invalid.
	return true;
}

// Use JavaScript validation or not
fvwoutboudsumarylist.validateRequired = <?php echo json_encode(CLIENT_VALIDATE) ?>;

// Dynamic selection lists
fvwoutboudsumarylist.lists["x_TypeName"] = <?php echo $vwoutboudsumary_list->TypeName->Lookup->toClientList() ?>;
fvwoutboudsumarylist.lists["x_TypeName"].options = <?php echo JsonEncode($vwoutboudsumary_list->TypeName->lookupOptions()) ?>;

// Form object for search
var fvwoutboudsumarylistsrch = currentSearchForm = new ew.Form("fvwoutboudsumarylistsrch");

// Validate function for search
fvwoutboudsumarylistsrch.validate = function(fobj) {
	if (!this.validateRequired)
		return true; // Ignore validation
	fobj = fobj || this._form;
	var infix = "";
	elm = this.getElements("x" + infix + "_Nam");
	if (elm && !ew.checkInteger(elm.value))
		return this.onError(elm, "<?php echo JsEncode($vwoutboudsumary->Nam->errorMessage()) ?>");
	elm = this.getElements("x" + infix + "_Thang");
	if (elm && !ew.checkInteger(elm.value))
		return this.onError(elm, "<?php echo JsEncode($vwoutboudsumary->Thang->errorMessage()) ?>");

	// Fire Form_CustomValidate event
	if (!this.Form_CustomValidate(fobj))
		return false;
	return true;
}

// Form_CustomValidate event
fvwoutboudsumarylistsrch.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

	// Your custom validation code here, return false if invalid.
	return true;
}

// Use JavaScript validation or not
fvwoutboudsumarylistsrch.validateRequired = <?php echo json_encode(CLIENT_VALIDATE) ?>;

// Dynamic selection lists
fvwoutboudsumarylistsrch.lists["x_TypeName"] = <?php echo $vwoutboudsumary_list->TypeName->Lookup->toClientList() ?>;
fvwoutboudsumarylistsrch.lists["x_TypeName"].options = <?php echo JsonEncode($vwoutboudsumary_list->TypeName->lookupOptions()) ?>;

// Filters
fvwoutboudsumarylistsrch.filterList = <?php echo $vwoutboudsumary_list->getFilterList() ?>;
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
<?php if (!$vwoutboudsumary->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($vwoutboudsumary_list->TotalRecs > 0 && $vwoutboudsumary_list->ExportOptions->visible()) { ?>
<?php $vwoutboudsumary_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($vwoutboudsumary_list->ImportOptions->visible()) { ?>
<?php $vwoutboudsumary_list->ImportOptions->render("body") ?>
<?php } ?>
<?php if ($vwoutboudsumary_list->SearchOptions->visible()) { ?>
<?php $vwoutboudsumary_list->SearchOptions->render("body") ?>
<?php } ?>
<?php if ($vwoutboudsumary_list->FilterOptions->visible()) { ?>
<?php $vwoutboudsumary_list->FilterOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php
$vwoutboudsumary_list->renderOtherOptions();
?>
<?php if ($Security->CanSearch()) { ?>
<?php if (!$vwoutboudsumary->isExport() && !$vwoutboudsumary->CurrentAction) { ?>
<form name="fvwoutboudsumarylistsrch" id="fvwoutboudsumarylistsrch" class="form-inline ew-form ew-ext-search-form" action="<?php echo CurrentPageName() ?>">
<?php $searchPanelClass = ($vwoutboudsumary_list->SearchWhere <> "") ? " show" : " show"; ?>
<div id="fvwoutboudsumarylistsrch-search-panel" class="ew-search-panel collapse<?php echo $searchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="vwoutboudsumary">
	<div class="ew-basic-search">
<?php
if ($SearchError == "")
	$vwoutboudsumary_list->LoadAdvancedSearch(); // Load advanced search

// Render for search
$vwoutboudsumary->RowType = ROWTYPE_SEARCH;

// Render row
$vwoutboudsumary->resetAttributes();
$vwoutboudsumary_list->renderRow();
?>
<div id="xsr_1" class="ew-row d-sm-flex">
<?php if ($vwoutboudsumary->Nam->Visible) { // Nam ?>
	<div id="xsc_Nam" class="ew-cell form-group">
		<label for="x_Nam" class="ew-search-caption ew-label"><?php echo $vwoutboudsumary->Nam->caption() ?></label>
		<span class="ew-search-operator"><?php echo $Language->phrase("=") ?><input type="hidden" name="z_Nam" id="z_Nam" value="="></span>
		<span class="ew-search-field">
<input type="text" data-table="vwoutboudsumary" data-field="x_Nam" name="x_Nam" id="x_Nam" size="30" placeholder="<?php echo HtmlEncode($vwoutboudsumary->Nam->getPlaceHolder()) ?>" value="<?php echo $vwoutboudsumary->Nam->EditValue ?>"<?php echo $vwoutboudsumary->Nam->editAttributes() ?>>
</span>
	</div>
<?php } ?>
</div>
<div id="xsr_2" class="ew-row d-sm-flex">
<?php if ($vwoutboudsumary->Thang->Visible) { // Thang ?>
	<div id="xsc_Thang" class="ew-cell form-group">
		<label for="x_Thang" class="ew-search-caption ew-label"><?php echo $vwoutboudsumary->Thang->caption() ?></label>
		<span class="ew-search-operator"><?php echo $Language->phrase("=") ?><input type="hidden" name="z_Thang" id="z_Thang" value="="></span>
		<span class="ew-search-field">
<input type="text" data-table="vwoutboudsumary" data-field="x_Thang" name="x_Thang" id="x_Thang" size="30" placeholder="<?php echo HtmlEncode($vwoutboudsumary->Thang->getPlaceHolder()) ?>" value="<?php echo $vwoutboudsumary->Thang->EditValue ?>"<?php echo $vwoutboudsumary->Thang->editAttributes() ?>>
</span>
	</div>
<?php } ?>
</div>
<div id="xsr_3" class="ew-row d-sm-flex">
<?php if ($vwoutboudsumary->TypeName->Visible) { // TypeName ?>
	<div id="xsc_TypeName" class="ew-cell form-group">
		<label for="x_TypeName" class="ew-search-caption ew-label"><?php echo $vwoutboudsumary->TypeName->caption() ?></label>
		<span class="ew-search-operator"><?php echo $Language->phrase("LIKE") ?><input type="hidden" name="z_TypeName" id="z_TypeName" value="LIKE"></span>
		<span class="ew-search-field">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="vwoutboudsumary" data-field="x_TypeName" data-value-separator="<?php echo $vwoutboudsumary->TypeName->displayValueSeparatorAttribute() ?>" id="x_TypeName" name="x_TypeName"<?php echo $vwoutboudsumary->TypeName->editAttributes() ?>>
		<?php echo $vwoutboudsumary->TypeName->selectOptionListHtml("x_TypeName") ?>
	</select>
</div>
<?php echo $vwoutboudsumary->TypeName->Lookup->getParamTag("p_x_TypeName") ?>
</span>
	</div>
<?php } ?>
</div>
<div id="xsr_4" class="ew-row d-sm-flex">
	<div class="ew-quick-search input-group">
		<input type="text" name="<?php echo TABLE_BASIC_SEARCH ?>" id="<?php echo TABLE_BASIC_SEARCH ?>" class="form-control" value="<?php echo HtmlEncode($vwoutboudsumary_list->BasicSearch->getKeyword()) ?>" placeholder="<?php echo HtmlEncode($Language->phrase("Search")) ?>">
		<input type="hidden" name="<?php echo TABLE_BASIC_SEARCH_TYPE ?>" id="<?php echo TABLE_BASIC_SEARCH_TYPE ?>" value="<?php echo HtmlEncode($vwoutboudsumary_list->BasicSearch->getType()) ?>">
		<div class="input-group-append">
			<button class="btn btn-primary" name="btn-submit" id="btn-submit" type="submit"><?php echo $Language->phrase("SearchBtn") ?></button>
			<button type="button" data-toggle="dropdown" class="btn btn-primary dropdown-toggle dropdown-toggle-split" aria-haspopup="true" aria-expanded="false"><span id="searchtype"><?php echo $vwoutboudsumary_list->BasicSearch->getTypeNameShort() ?></span></button>
			<div class="dropdown-menu dropdown-menu-right">
				<a class="dropdown-item<?php if ($vwoutboudsumary_list->BasicSearch->getType() == "") echo " active"; ?>" href="javascript:void(0);" onclick="ew.setSearchType(this)"><?php echo $Language->phrase("QuickSearchAuto") ?></a>
				<a class="dropdown-item<?php if ($vwoutboudsumary_list->BasicSearch->getType() == "=") echo " active"; ?>" href="javascript:void(0);" onclick="ew.setSearchType(this,'=')"><?php echo $Language->phrase("QuickSearchExact") ?></a>
				<a class="dropdown-item<?php if ($vwoutboudsumary_list->BasicSearch->getType() == "AND") echo " active"; ?>" href="javascript:void(0);" onclick="ew.setSearchType(this,'AND')"><?php echo $Language->phrase("QuickSearchAll") ?></a>
				<a class="dropdown-item<?php if ($vwoutboudsumary_list->BasicSearch->getType() == "OR") echo " active"; ?>" href="javascript:void(0);" onclick="ew.setSearchType(this,'OR')"><?php echo $Language->phrase("QuickSearchAny") ?></a>
			</div>
		</div>
	</div>
</div>
	</div>
</div>
</form>
<?php } ?>
<?php } ?>
<?php $vwoutboudsumary_list->showPageHeader(); ?>
<?php
$vwoutboudsumary_list->showMessage();
?>
<?php if ($vwoutboudsumary_list->TotalRecs > 0 || $vwoutboudsumary->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($vwoutboudsumary_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> vwoutboudsumary">
<?php if (!$vwoutboudsumary->isExport()) { ?>
<div class="card-header ew-grid-upper-panel">
<?php if (!$vwoutboudsumary->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php if (!isset($vwoutboudsumary_list->Pager)) $vwoutboudsumary_list->Pager = new PrevNextPager($vwoutboudsumary_list->StartRec, $vwoutboudsumary_list->DisplayRecs, $vwoutboudsumary_list->TotalRecs, $vwoutboudsumary_list->AutoHidePager) ?>
<?php if ($vwoutboudsumary_list->Pager->RecordCount > 0 && $vwoutboudsumary_list->Pager->Visible) { ?>
<div class="ew-pager">
<span><?php echo $Language->Phrase("Page") ?>&nbsp;</span>
<div class="ew-prev-next"><div class="input-group input-group-sm">
<div class="input-group-prepend">
<!-- first page button -->
	<?php if ($vwoutboudsumary_list->Pager->FirstButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerFirst") ?>" href="<?php echo $vwoutboudsumary_list->pageUrl() ?>start=<?php echo $vwoutboudsumary_list->Pager->FirstButton->Start ?>"><i class="icon-first ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerFirst") ?>"><i class="icon-first ew-icon"></i></a>
	<?php } ?>
<!-- previous page button -->
	<?php if ($vwoutboudsumary_list->Pager->PrevButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerPrevious") ?>" href="<?php echo $vwoutboudsumary_list->pageUrl() ?>start=<?php echo $vwoutboudsumary_list->Pager->PrevButton->Start ?>"><i class="icon-prev ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerPrevious") ?>"><i class="icon-prev ew-icon"></i></a>
	<?php } ?>
</div>
<!-- current page number -->
	<input class="form-control" type="text" name="<?php echo TABLE_PAGE_NO ?>" value="<?php echo $vwoutboudsumary_list->Pager->CurrentPage ?>">
<div class="input-group-append">
<!-- next page button -->
	<?php if ($vwoutboudsumary_list->Pager->NextButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerNext") ?>" href="<?php echo $vwoutboudsumary_list->pageUrl() ?>start=<?php echo $vwoutboudsumary_list->Pager->NextButton->Start ?>"><i class="icon-next ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerNext") ?>"><i class="icon-next ew-icon"></i></a>
	<?php } ?>
<!-- last page button -->
	<?php if ($vwoutboudsumary_list->Pager->LastButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerLast") ?>" href="<?php echo $vwoutboudsumary_list->pageUrl() ?>start=<?php echo $vwoutboudsumary_list->Pager->LastButton->Start ?>"><i class="icon-last ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerLast") ?>"><i class="icon-last ew-icon"></i></a>
	<?php } ?>
</div>
</div>
</div>
<span>&nbsp;<?php echo $Language->Phrase("of") ?>&nbsp;<?php echo $vwoutboudsumary_list->Pager->PageCount ?></span>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php if ($vwoutboudsumary_list->Pager->RecordCount > 0) { ?>
<div class="ew-pager ew-rec">
	<span><?php echo $Language->Phrase("Record") ?>&nbsp;<?php echo $vwoutboudsumary_list->Pager->FromIndex ?>&nbsp;<?php echo $Language->Phrase("To") ?>&nbsp;<?php echo $vwoutboudsumary_list->Pager->ToIndex ?>&nbsp;<?php echo $Language->Phrase("Of") ?>&nbsp;<?php echo $vwoutboudsumary_list->Pager->RecordCount ?></span>
</div>
<?php } ?>
<?php if ($vwoutboudsumary_list->TotalRecs > 0 && (!$vwoutboudsumary_list->AutoHidePageSizeSelector || $vwoutboudsumary_list->Pager->Visible)) { ?>
<div class="ew-pager">
<input type="hidden" name="t" value="vwoutboudsumary">
<select name="<?php echo TABLE_REC_PER_PAGE ?>" class="form-control form-control-sm ew-tooltip" title="<?php echo $Language->phrase("RecordsPerPage") ?>" onchange="this.form.submit();">
<option value="20"<?php if ($vwoutboudsumary_list->DisplayRecs == 20) { ?> selected<?php } ?>>20</option>
<option value="50"<?php if ($vwoutboudsumary_list->DisplayRecs == 50) { ?> selected<?php } ?>>50</option>
<option value="100"<?php if ($vwoutboudsumary_list->DisplayRecs == 100) { ?> selected<?php } ?>>100</option>
<option value="200"<?php if ($vwoutboudsumary_list->DisplayRecs == 200) { ?> selected<?php } ?>>200</option>
<option value="500"<?php if ($vwoutboudsumary_list->DisplayRecs == 500) { ?> selected<?php } ?>>500</option>
<option value="ALL"<?php if ($vwoutboudsumary->getRecordsPerPage() == -1) { ?> selected<?php } ?>><?php echo $Language->Phrase("AllRecords") ?></option>
</select>
</div>
<?php } ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $vwoutboudsumary_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
<form name="fvwoutboudsumarylist" id="fvwoutboudsumarylist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($vwoutboudsumary_list->CheckToken) { ?>
<input type="hidden" name="<?php echo TOKEN_NAME ?>" value="<?php echo $vwoutboudsumary_list->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="vwoutboudsumary">
<input type="hidden" name="exporttype" id="exporttype" value="">
<div id="gmp_vwoutboudsumary" class="<?php if (IsResponsiveLayout()) { ?>table-responsive <?php } ?>card-body ew-grid-middle-panel">
<?php if ($vwoutboudsumary_list->TotalRecs > 0 || $vwoutboudsumary->isGridEdit()) { ?>
<table id="tbl_vwoutboudsumarylist" class="table ew-table"><!-- .ew-table ##-->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$vwoutboudsumary_list->RowType = ROWTYPE_HEADER;

// Render list options
$vwoutboudsumary_list->renderListOptions();

// Render list options (header, left)
$vwoutboudsumary_list->ListOptions->render("header", "left");
?>
<?php if ($vwoutboudsumary->Nam->Visible) { // Nam ?>
	<?php if ($vwoutboudsumary->sortUrl($vwoutboudsumary->Nam) == "") { ?>
		<th data-name="Nam" class="<?php echo $vwoutboudsumary->Nam->headerCellClass() ?>" style="white-space: nowrap;"><div id="elh_vwoutboudsumary_Nam" class="vwoutboudsumary_Nam"><div class="ew-table-header-caption"><?php echo $vwoutboudsumary->Nam->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Nam" class="<?php echo $vwoutboudsumary->Nam->headerCellClass() ?>" style="white-space: nowrap;"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $vwoutboudsumary->SortUrl($vwoutboudsumary->Nam) ?>',2);"><div id="elh_vwoutboudsumary_Nam" class="vwoutboudsumary_Nam">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $vwoutboudsumary->Nam->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($vwoutboudsumary->Nam->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($vwoutboudsumary->Nam->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($vwoutboudsumary->Thang->Visible) { // Thang ?>
	<?php if ($vwoutboudsumary->sortUrl($vwoutboudsumary->Thang) == "") { ?>
		<th data-name="Thang" class="<?php echo $vwoutboudsumary->Thang->headerCellClass() ?>" style="white-space: nowrap;"><div id="elh_vwoutboudsumary_Thang" class="vwoutboudsumary_Thang"><div class="ew-table-header-caption"><?php echo $vwoutboudsumary->Thang->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Thang" class="<?php echo $vwoutboudsumary->Thang->headerCellClass() ?>" style="white-space: nowrap;"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $vwoutboudsumary->SortUrl($vwoutboudsumary->Thang) ?>',2);"><div id="elh_vwoutboudsumary_Thang" class="vwoutboudsumary_Thang">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $vwoutboudsumary->Thang->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($vwoutboudsumary->Thang->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($vwoutboudsumary->Thang->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($vwoutboudsumary->TruckNo->Visible) { // TruckNo ?>
	<?php if ($vwoutboudsumary->sortUrl($vwoutboudsumary->TruckNo) == "") { ?>
		<th data-name="TruckNo" class="<?php echo $vwoutboudsumary->TruckNo->headerCellClass() ?>" style="white-space: nowrap;"><div id="elh_vwoutboudsumary_TruckNo" class="vwoutboudsumary_TruckNo"><div class="ew-table-header-caption"><?php echo $vwoutboudsumary->TruckNo->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="TruckNo" class="<?php echo $vwoutboudsumary->TruckNo->headerCellClass() ?>" style="white-space: nowrap;"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $vwoutboudsumary->SortUrl($vwoutboudsumary->TruckNo) ?>',2);"><div id="elh_vwoutboudsumary_TruckNo" class="vwoutboudsumary_TruckNo">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $vwoutboudsumary->TruckNo->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($vwoutboudsumary->TruckNo->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($vwoutboudsumary->TruckNo->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($vwoutboudsumary->Code->Visible) { // Code ?>
	<?php if ($vwoutboudsumary->sortUrl($vwoutboudsumary->Code) == "") { ?>
		<th data-name="Code" class="<?php echo $vwoutboudsumary->Code->headerCellClass() ?>" style="white-space: nowrap;"><div id="elh_vwoutboudsumary_Code" class="vwoutboudsumary_Code"><div class="ew-table-header-caption"><?php echo $vwoutboudsumary->Code->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Code" class="<?php echo $vwoutboudsumary->Code->headerCellClass() ?>" style="white-space: nowrap;"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $vwoutboudsumary->SortUrl($vwoutboudsumary->Code) ?>',2);"><div id="elh_vwoutboudsumary_Code" class="vwoutboudsumary_Code">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $vwoutboudsumary->Code->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($vwoutboudsumary->Code->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($vwoutboudsumary->Code->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($vwoutboudsumary->ProductName->Visible) { // ProductName ?>
	<?php if ($vwoutboudsumary->sortUrl($vwoutboudsumary->ProductName) == "") { ?>
		<th data-name="ProductName" class="<?php echo $vwoutboudsumary->ProductName->headerCellClass() ?>" style="white-space: nowrap;"><div id="elh_vwoutboudsumary_ProductName" class="vwoutboudsumary_ProductName"><div class="ew-table-header-caption"><?php echo $vwoutboudsumary->ProductName->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="ProductName" class="<?php echo $vwoutboudsumary->ProductName->headerCellClass() ?>" style="white-space: nowrap;"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $vwoutboudsumary->SortUrl($vwoutboudsumary->ProductName) ?>',2);"><div id="elh_vwoutboudsumary_ProductName" class="vwoutboudsumary_ProductName">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $vwoutboudsumary->ProductName->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($vwoutboudsumary->ProductName->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($vwoutboudsumary->ProductName->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($vwoutboudsumary->TypeName->Visible) { // TypeName ?>
	<?php if ($vwoutboudsumary->sortUrl($vwoutboudsumary->TypeName) == "") { ?>
		<th data-name="TypeName" class="<?php echo $vwoutboudsumary->TypeName->headerCellClass() ?>" style="white-space: nowrap;"><div id="elh_vwoutboudsumary_TypeName" class="vwoutboudsumary_TypeName"><div class="ew-table-header-caption"><?php echo $vwoutboudsumary->TypeName->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="TypeName" class="<?php echo $vwoutboudsumary->TypeName->headerCellClass() ?>" style="white-space: nowrap;"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $vwoutboudsumary->SortUrl($vwoutboudsumary->TypeName) ?>',2);"><div id="elh_vwoutboudsumary_TypeName" class="vwoutboudsumary_TypeName">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $vwoutboudsumary->TypeName->caption() ?></span><span class="ew-table-header-sort"><?php if ($vwoutboudsumary->TypeName->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($vwoutboudsumary->TypeName->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($vwoutboudsumary->PCS->Visible) { // PCS ?>
	<?php if ($vwoutboudsumary->sortUrl($vwoutboudsumary->PCS) == "") { ?>
		<th data-name="PCS" class="<?php echo $vwoutboudsumary->PCS->headerCellClass() ?>" style="white-space: nowrap;"><div id="elh_vwoutboudsumary_PCS" class="vwoutboudsumary_PCS"><div class="ew-table-header-caption"><?php echo $vwoutboudsumary->PCS->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="PCS" class="<?php echo $vwoutboudsumary->PCS->headerCellClass() ?>" style="white-space: nowrap;"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $vwoutboudsumary->SortUrl($vwoutboudsumary->PCS) ?>',2);"><div id="elh_vwoutboudsumary_PCS" class="vwoutboudsumary_PCS">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $vwoutboudsumary->PCS->caption() ?></span><span class="ew-table-header-sort"><?php if ($vwoutboudsumary->PCS->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($vwoutboudsumary->PCS->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$vwoutboudsumary_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
if ($vwoutboudsumary->ExportAll && $vwoutboudsumary->isExport()) {
	$vwoutboudsumary_list->StopRec = $vwoutboudsumary_list->TotalRecs;
} else {

	// Set the last record to display
	if ($vwoutboudsumary_list->TotalRecs > $vwoutboudsumary_list->StartRec + $vwoutboudsumary_list->DisplayRecs - 1)
		$vwoutboudsumary_list->StopRec = $vwoutboudsumary_list->StartRec + $vwoutboudsumary_list->DisplayRecs - 1;
	else
		$vwoutboudsumary_list->StopRec = $vwoutboudsumary_list->TotalRecs;
}
$vwoutboudsumary_list->RecCnt = $vwoutboudsumary_list->StartRec - 1;
if ($vwoutboudsumary_list->Recordset && !$vwoutboudsumary_list->Recordset->EOF) {
	$vwoutboudsumary_list->Recordset->moveFirst();
	$selectLimit = $vwoutboudsumary_list->UseSelectLimit;
	if (!$selectLimit && $vwoutboudsumary_list->StartRec > 1)
		$vwoutboudsumary_list->Recordset->move($vwoutboudsumary_list->StartRec - 1);
} elseif (!$vwoutboudsumary->AllowAddDeleteRow && $vwoutboudsumary_list->StopRec == 0) {
	$vwoutboudsumary_list->StopRec = $vwoutboudsumary->GridAddRowCount;
}

// Initialize aggregate
$vwoutboudsumary->RowType = ROWTYPE_AGGREGATEINIT;
$vwoutboudsumary->resetAttributes();
$vwoutboudsumary_list->renderRow();
while ($vwoutboudsumary_list->RecCnt < $vwoutboudsumary_list->StopRec) {
	$vwoutboudsumary_list->RecCnt++;
	if ($vwoutboudsumary_list->RecCnt >= $vwoutboudsumary_list->StartRec) {
		$vwoutboudsumary_list->RowCnt++;

		// Set up key count
		$vwoutboudsumary_list->KeyCount = $vwoutboudsumary_list->RowIndex;

		// Init row class and style
		$vwoutboudsumary->resetAttributes();
		$vwoutboudsumary->CssClass = "";
		if ($vwoutboudsumary->isGridAdd()) {
		} else {
			$vwoutboudsumary_list->loadRowValues($vwoutboudsumary_list->Recordset); // Load row values
		}
		$vwoutboudsumary->RowType = ROWTYPE_VIEW; // Render view

		// Set up row id / data-rowindex
		$vwoutboudsumary->RowAttrs = array_merge($vwoutboudsumary->RowAttrs, array('data-rowindex'=>$vwoutboudsumary_list->RowCnt, 'id'=>'r' . $vwoutboudsumary_list->RowCnt . '_vwoutboudsumary', 'data-rowtype'=>$vwoutboudsumary->RowType));

		// Render row
		$vwoutboudsumary_list->renderRow();

		// Render list options
		$vwoutboudsumary_list->renderListOptions();
?>
	<tr<?php echo $vwoutboudsumary->rowAttributes() ?>>
<?php

// Render list options (body, left)
$vwoutboudsumary_list->ListOptions->render("body", "left", $vwoutboudsumary_list->RowCnt);
?>
	<?php if ($vwoutboudsumary->Nam->Visible) { // Nam ?>
		<td data-name="Nam"<?php echo $vwoutboudsumary->Nam->cellAttributes() ?>>
<span id="el<?php echo $vwoutboudsumary_list->RowCnt ?>_vwoutboudsumary_Nam" class="vwoutboudsumary_Nam">
<span<?php echo $vwoutboudsumary->Nam->viewAttributes() ?>>
<?php echo $vwoutboudsumary->Nam->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($vwoutboudsumary->Thang->Visible) { // Thang ?>
		<td data-name="Thang"<?php echo $vwoutboudsumary->Thang->cellAttributes() ?>>
<span id="el<?php echo $vwoutboudsumary_list->RowCnt ?>_vwoutboudsumary_Thang" class="vwoutboudsumary_Thang">
<span<?php echo $vwoutboudsumary->Thang->viewAttributes() ?>>
<?php echo $vwoutboudsumary->Thang->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($vwoutboudsumary->TruckNo->Visible) { // TruckNo ?>
		<td data-name="TruckNo"<?php echo $vwoutboudsumary->TruckNo->cellAttributes() ?>>
<span id="el<?php echo $vwoutboudsumary_list->RowCnt ?>_vwoutboudsumary_TruckNo" class="vwoutboudsumary_TruckNo">
<span<?php echo $vwoutboudsumary->TruckNo->viewAttributes() ?>>
<?php echo $vwoutboudsumary->TruckNo->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($vwoutboudsumary->Code->Visible) { // Code ?>
		<td data-name="Code"<?php echo $vwoutboudsumary->Code->cellAttributes() ?>>
<span id="el<?php echo $vwoutboudsumary_list->RowCnt ?>_vwoutboudsumary_Code" class="vwoutboudsumary_Code">
<span<?php echo $vwoutboudsumary->Code->viewAttributes() ?>>
<?php echo $vwoutboudsumary->Code->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($vwoutboudsumary->ProductName->Visible) { // ProductName ?>
		<td data-name="ProductName"<?php echo $vwoutboudsumary->ProductName->cellAttributes() ?>>
<span id="el<?php echo $vwoutboudsumary_list->RowCnt ?>_vwoutboudsumary_ProductName" class="vwoutboudsumary_ProductName">
<span<?php echo $vwoutboudsumary->ProductName->viewAttributes() ?>>
<?php echo $vwoutboudsumary->ProductName->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($vwoutboudsumary->TypeName->Visible) { // TypeName ?>
		<td data-name="TypeName"<?php echo $vwoutboudsumary->TypeName->cellAttributes() ?>>
<span id="el<?php echo $vwoutboudsumary_list->RowCnt ?>_vwoutboudsumary_TypeName" class="vwoutboudsumary_TypeName">
<span<?php echo $vwoutboudsumary->TypeName->viewAttributes() ?>>
<?php echo $vwoutboudsumary->TypeName->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($vwoutboudsumary->PCS->Visible) { // PCS ?>
		<td data-name="PCS"<?php echo $vwoutboudsumary->PCS->cellAttributes() ?>>
<span id="el<?php echo $vwoutboudsumary_list->RowCnt ?>_vwoutboudsumary_PCS" class="vwoutboudsumary_PCS">
<span<?php echo $vwoutboudsumary->PCS->viewAttributes() ?>>
<?php echo $vwoutboudsumary->PCS->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$vwoutboudsumary_list->ListOptions->render("body", "right", $vwoutboudsumary_list->RowCnt);
?>
	</tr>
<?php
	}
	if (!$vwoutboudsumary->isGridAdd())
		$vwoutboudsumary_list->Recordset->moveNext();
}
?>
</tbody>
<?php

// Render aggregate row
$vwoutboudsumary->RowType = ROWTYPE_AGGREGATE;
$vwoutboudsumary->resetAttributes();
$vwoutboudsumary_list->renderRow();
?>
<?php if ($vwoutboudsumary_list->TotalRecs > 0 && !$vwoutboudsumary->isGridAdd() && !$vwoutboudsumary->isGridEdit()) { ?>
<tfoot><!-- Table footer -->
	<tr class="ew-table-footer">
<?php

// Render list options
$vwoutboudsumary_list->renderListOptions();

// Render list options (footer, left)
$vwoutboudsumary_list->ListOptions->render("footer", "left");
?>
	<?php if ($vwoutboudsumary->Nam->Visible) { // Nam ?>
		<td data-name="Nam" class="<?php echo $vwoutboudsumary->Nam->footerCellClass() ?>"><span id="elf_vwoutboudsumary_Nam" class="vwoutboudsumary_Nam">
		&nbsp;
		</span></td>
	<?php } ?>
	<?php if ($vwoutboudsumary->Thang->Visible) { // Thang ?>
		<td data-name="Thang" class="<?php echo $vwoutboudsumary->Thang->footerCellClass() ?>"><span id="elf_vwoutboudsumary_Thang" class="vwoutboudsumary_Thang">
		&nbsp;
		</span></td>
	<?php } ?>
	<?php if ($vwoutboudsumary->TruckNo->Visible) { // TruckNo ?>
		<td data-name="TruckNo" class="<?php echo $vwoutboudsumary->TruckNo->footerCellClass() ?>"><span id="elf_vwoutboudsumary_TruckNo" class="vwoutboudsumary_TruckNo">
		&nbsp;
		</span></td>
	<?php } ?>
	<?php if ($vwoutboudsumary->Code->Visible) { // Code ?>
		<td data-name="Code" class="<?php echo $vwoutboudsumary->Code->footerCellClass() ?>"><span id="elf_vwoutboudsumary_Code" class="vwoutboudsumary_Code">
		&nbsp;
		</span></td>
	<?php } ?>
	<?php if ($vwoutboudsumary->ProductName->Visible) { // ProductName ?>
		<td data-name="ProductName" class="<?php echo $vwoutboudsumary->ProductName->footerCellClass() ?>"><span id="elf_vwoutboudsumary_ProductName" class="vwoutboudsumary_ProductName">
		&nbsp;
		</span></td>
	<?php } ?>
	<?php if ($vwoutboudsumary->TypeName->Visible) { // TypeName ?>
		<td data-name="TypeName" class="<?php echo $vwoutboudsumary->TypeName->footerCellClass() ?>"><span id="elf_vwoutboudsumary_TypeName" class="vwoutboudsumary_TypeName">
		&nbsp;
		</span></td>
	<?php } ?>
	<?php if ($vwoutboudsumary->PCS->Visible) { // PCS ?>
		<td data-name="PCS" class="<?php echo $vwoutboudsumary->PCS->footerCellClass() ?>"><span id="elf_vwoutboudsumary_PCS" class="vwoutboudsumary_PCS">
		<span class="ew-aggregate"><?php echo $Language->phrase("TOTAL") ?></span><span class="ew-aggregate-value">
		<?php echo $vwoutboudsumary->PCS->ViewValue ?></span>
		</span></td>
	<?php } ?>
<?php

// Render list options (footer, right)
$vwoutboudsumary_list->ListOptions->render("footer", "right");
?>
	</tr>
</tfoot>
<?php } ?>
</table><!-- /.ew-table -->
<?php } ?>
<?php if (!$vwoutboudsumary->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</div><!-- /.ew-grid-middle-panel -->
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($vwoutboudsumary_list->Recordset)
	$vwoutboudsumary_list->Recordset->Close();
?>
<?php if (!$vwoutboudsumary->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$vwoutboudsumary->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php if (!isset($vwoutboudsumary_list->Pager)) $vwoutboudsumary_list->Pager = new PrevNextPager($vwoutboudsumary_list->StartRec, $vwoutboudsumary_list->DisplayRecs, $vwoutboudsumary_list->TotalRecs, $vwoutboudsumary_list->AutoHidePager) ?>
<?php if ($vwoutboudsumary_list->Pager->RecordCount > 0 && $vwoutboudsumary_list->Pager->Visible) { ?>
<div class="ew-pager">
<span><?php echo $Language->Phrase("Page") ?>&nbsp;</span>
<div class="ew-prev-next"><div class="input-group input-group-sm">
<div class="input-group-prepend">
<!-- first page button -->
	<?php if ($vwoutboudsumary_list->Pager->FirstButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerFirst") ?>" href="<?php echo $vwoutboudsumary_list->pageUrl() ?>start=<?php echo $vwoutboudsumary_list->Pager->FirstButton->Start ?>"><i class="icon-first ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerFirst") ?>"><i class="icon-first ew-icon"></i></a>
	<?php } ?>
<!-- previous page button -->
	<?php if ($vwoutboudsumary_list->Pager->PrevButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerPrevious") ?>" href="<?php echo $vwoutboudsumary_list->pageUrl() ?>start=<?php echo $vwoutboudsumary_list->Pager->PrevButton->Start ?>"><i class="icon-prev ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerPrevious") ?>"><i class="icon-prev ew-icon"></i></a>
	<?php } ?>
</div>
<!-- current page number -->
	<input class="form-control" type="text" name="<?php echo TABLE_PAGE_NO ?>" value="<?php echo $vwoutboudsumary_list->Pager->CurrentPage ?>">
<div class="input-group-append">
<!-- next page button -->
	<?php if ($vwoutboudsumary_list->Pager->NextButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerNext") ?>" href="<?php echo $vwoutboudsumary_list->pageUrl() ?>start=<?php echo $vwoutboudsumary_list->Pager->NextButton->Start ?>"><i class="icon-next ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerNext") ?>"><i class="icon-next ew-icon"></i></a>
	<?php } ?>
<!-- last page button -->
	<?php if ($vwoutboudsumary_list->Pager->LastButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerLast") ?>" href="<?php echo $vwoutboudsumary_list->pageUrl() ?>start=<?php echo $vwoutboudsumary_list->Pager->LastButton->Start ?>"><i class="icon-last ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerLast") ?>"><i class="icon-last ew-icon"></i></a>
	<?php } ?>
</div>
</div>
</div>
<span>&nbsp;<?php echo $Language->Phrase("of") ?>&nbsp;<?php echo $vwoutboudsumary_list->Pager->PageCount ?></span>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php if ($vwoutboudsumary_list->Pager->RecordCount > 0) { ?>
<div class="ew-pager ew-rec">
	<span><?php echo $Language->Phrase("Record") ?>&nbsp;<?php echo $vwoutboudsumary_list->Pager->FromIndex ?>&nbsp;<?php echo $Language->Phrase("To") ?>&nbsp;<?php echo $vwoutboudsumary_list->Pager->ToIndex ?>&nbsp;<?php echo $Language->Phrase("Of") ?>&nbsp;<?php echo $vwoutboudsumary_list->Pager->RecordCount ?></span>
</div>
<?php } ?>
<?php if ($vwoutboudsumary_list->TotalRecs > 0 && (!$vwoutboudsumary_list->AutoHidePageSizeSelector || $vwoutboudsumary_list->Pager->Visible)) { ?>
<div class="ew-pager">
<input type="hidden" name="t" value="vwoutboudsumary">
<select name="<?php echo TABLE_REC_PER_PAGE ?>" class="form-control form-control-sm ew-tooltip" title="<?php echo $Language->phrase("RecordsPerPage") ?>" onchange="this.form.submit();">
<option value="20"<?php if ($vwoutboudsumary_list->DisplayRecs == 20) { ?> selected<?php } ?>>20</option>
<option value="50"<?php if ($vwoutboudsumary_list->DisplayRecs == 50) { ?> selected<?php } ?>>50</option>
<option value="100"<?php if ($vwoutboudsumary_list->DisplayRecs == 100) { ?> selected<?php } ?>>100</option>
<option value="200"<?php if ($vwoutboudsumary_list->DisplayRecs == 200) { ?> selected<?php } ?>>200</option>
<option value="500"<?php if ($vwoutboudsumary_list->DisplayRecs == 500) { ?> selected<?php } ?>>500</option>
<option value="ALL"<?php if ($vwoutboudsumary->getRecordsPerPage() == -1) { ?> selected<?php } ?>><?php echo $Language->Phrase("AllRecords") ?></option>
</select>
</div>
<?php } ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $vwoutboudsumary_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($vwoutboudsumary_list->TotalRecs == 0 && !$vwoutboudsumary->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $vwoutboudsumary_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$vwoutboudsumary_list->showPageFooter();
if (DEBUG_ENABLED)
	echo GetDebugMessage();
?>
<?php if (!$vwoutboudsumary->isExport()) { ?>
<script>
$(".ew-print").click(function(event){
		var allVals = [];										
		$('input[type="checkbox"]:checked').each(function () {													   
			allVals.push($(this).val()+'/');														   
		});
		var x="";
		for(var i=0;i<allVals.length;i++)
		{
			x+=allVals[i]; 
		}				
		window.location="rpt_Delivery.php?id="+x.substring(0,x.length-1);
	});
$(".ew-excel").click(function(event){
		var allVals = [];										
		$('input[type="checkbox"]:checked').each(function () {													   
			allVals.push($(this).val()+'/');														   
		});
		var x="";
		for(var i=0;i<allVals.length;i++)
		{
			x+=allVals[i]; 
		}				
		window.location="rpt_Delivery.php?id="+x.substring(0,x.length-1);
	});	
// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php } ?>
<?php include_once "footer.php" ?>
<?php
$vwoutboudsumary_list->terminate();
?>