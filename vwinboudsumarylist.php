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
$vwinboudsumary_list = new vwinboudsumary_list();

// Run the page
$vwinboudsumary_list->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$vwinboudsumary_list->Page_Render();
?>
<?php include_once "header.php" ?>
<?php if (!$vwinboudsumary->isExport()) { ?>
<script>

// Form object
currentPageID = ew.PAGE_ID = "list";
var fvwinboudsumarylist = currentForm = new ew.Form("fvwinboudsumarylist", "list");
fvwinboudsumarylist.formKeyCountName = '<?php echo $vwinboudsumary_list->FormKeyCountName ?>';

// Form_CustomValidate event
fvwinboudsumarylist.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

	// Your custom validation code here, return false if invalid.
	return true;
}

// Use JavaScript validation or not
fvwinboudsumarylist.validateRequired = <?php echo json_encode(CLIENT_VALIDATE) ?>;

// Dynamic selection lists
fvwinboudsumarylist.lists["x_TypeName"] = <?php echo $vwinboudsumary_list->TypeName->Lookup->toClientList() ?>;
fvwinboudsumarylist.lists["x_TypeName"].options = <?php echo JsonEncode($vwinboudsumary_list->TypeName->lookupOptions()) ?>;

// Form object for search
var fvwinboudsumarylistsrch = currentSearchForm = new ew.Form("fvwinboudsumarylistsrch");

// Validate function for search
fvwinboudsumarylistsrch.validate = function(fobj) {
	if (!this.validateRequired)
		return true; // Ignore validation
	fobj = fobj || this._form;
	var infix = "";
	elm = this.getElements("x" + infix + "_Nam");
	if (elm && !ew.checkInteger(elm.value))
		return this.onError(elm, "<?php echo JsEncode($vwinboudsumary->Nam->errorMessage()) ?>");
	elm = this.getElements("x" + infix + "_Thang");
	if (elm && !ew.checkInteger(elm.value))
		return this.onError(elm, "<?php echo JsEncode($vwinboudsumary->Thang->errorMessage()) ?>");

	// Fire Form_CustomValidate event
	if (!this.Form_CustomValidate(fobj))
		return false;
	return true;
}

// Form_CustomValidate event
fvwinboudsumarylistsrch.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

	// Your custom validation code here, return false if invalid.
	return true;
}

// Use JavaScript validation or not
fvwinboudsumarylistsrch.validateRequired = <?php echo json_encode(CLIENT_VALIDATE) ?>;

// Dynamic selection lists
fvwinboudsumarylistsrch.lists["x_TypeName"] = <?php echo $vwinboudsumary_list->TypeName->Lookup->toClientList() ?>;
fvwinboudsumarylistsrch.lists["x_TypeName"].options = <?php echo JsonEncode($vwinboudsumary_list->TypeName->lookupOptions()) ?>;

// Filters
fvwinboudsumarylistsrch.filterList = <?php echo $vwinboudsumary_list->getFilterList() ?>;
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
<?php if (!$vwinboudsumary->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($vwinboudsumary_list->TotalRecs > 0 && $vwinboudsumary_list->ExportOptions->visible()) { ?>
<?php $vwinboudsumary_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($vwinboudsumary_list->ImportOptions->visible()) { ?>
<?php $vwinboudsumary_list->ImportOptions->render("body") ?>
<?php } ?>
<?php if ($vwinboudsumary_list->SearchOptions->visible()) { ?>
<?php $vwinboudsumary_list->SearchOptions->render("body") ?>
<?php } ?>
<?php if ($vwinboudsumary_list->FilterOptions->visible()) { ?>
<?php $vwinboudsumary_list->FilterOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php
$vwinboudsumary_list->renderOtherOptions();
?>
<?php if ($Security->CanSearch()) { ?>
<?php if (!$vwinboudsumary->isExport() && !$vwinboudsumary->CurrentAction) { ?>
<form name="fvwinboudsumarylistsrch" id="fvwinboudsumarylistsrch" class="form-inline ew-form ew-ext-search-form" action="<?php echo CurrentPageName() ?>">
<?php $searchPanelClass = ($vwinboudsumary_list->SearchWhere <> "") ? " show" : " show"; ?>
<div id="fvwinboudsumarylistsrch-search-panel" class="ew-search-panel collapse<?php echo $searchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="vwinboudsumary">
	<div class="ew-basic-search">
<?php
if ($SearchError == "")
	$vwinboudsumary_list->LoadAdvancedSearch(); // Load advanced search

// Render for search
$vwinboudsumary->RowType = ROWTYPE_SEARCH;

// Render row
$vwinboudsumary->resetAttributes();
$vwinboudsumary_list->renderRow();
?>
<div id="xsr_1" class="ew-row d-sm-flex">
<?php if ($vwinboudsumary->Nam->Visible) { // Nam ?>
	<div id="xsc_Nam" class="ew-cell form-group">
		<label for="x_Nam" class="ew-search-caption ew-label"><?php echo $vwinboudsumary->Nam->caption() ?></label>
		<span class="ew-search-operator"><?php echo $Language->phrase("=") ?><input type="hidden" name="z_Nam" id="z_Nam" value="="></span>
		<span class="ew-search-field">
<input type="text" data-table="vwinboudsumary" data-field="x_Nam" name="x_Nam" id="x_Nam" size="30" placeholder="<?php echo HtmlEncode($vwinboudsumary->Nam->getPlaceHolder()) ?>" value="<?php echo $vwinboudsumary->Nam->EditValue ?>"<?php echo $vwinboudsumary->Nam->editAttributes() ?>>
</span>
	</div>
<?php } ?>
</div>
<div id="xsr_2" class="ew-row d-sm-flex">
<?php if ($vwinboudsumary->Thang->Visible) { // Thang ?>
	<div id="xsc_Thang" class="ew-cell form-group">
		<label for="x_Thang" class="ew-search-caption ew-label"><?php echo $vwinboudsumary->Thang->caption() ?></label>
		<span class="ew-search-operator"><?php echo $Language->phrase("=") ?><input type="hidden" name="z_Thang" id="z_Thang" value="="></span>
		<span class="ew-search-field">
<input type="text" data-table="vwinboudsumary" data-field="x_Thang" name="x_Thang" id="x_Thang" size="30" placeholder="<?php echo HtmlEncode($vwinboudsumary->Thang->getPlaceHolder()) ?>" value="<?php echo $vwinboudsumary->Thang->EditValue ?>"<?php echo $vwinboudsumary->Thang->editAttributes() ?>>
</span>
	</div>
<?php } ?>
</div>
<div id="xsr_3" class="ew-row d-sm-flex">
<?php if ($vwinboudsumary->TypeName->Visible) { // TypeName ?>
	<div id="xsc_TypeName" class="ew-cell form-group">
		<label for="x_TypeName" class="ew-search-caption ew-label"><?php echo $vwinboudsumary->TypeName->caption() ?></label>
		<span class="ew-search-operator"><?php echo $Language->phrase("LIKE") ?><input type="hidden" name="z_TypeName" id="z_TypeName" value="LIKE"></span>
		<span class="ew-search-field">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="vwinboudsumary" data-field="x_TypeName" data-value-separator="<?php echo $vwinboudsumary->TypeName->displayValueSeparatorAttribute() ?>" id="x_TypeName" name="x_TypeName"<?php echo $vwinboudsumary->TypeName->editAttributes() ?>>
		<?php echo $vwinboudsumary->TypeName->selectOptionListHtml("x_TypeName") ?>
	</select>
</div>
<?php echo $vwinboudsumary->TypeName->Lookup->getParamTag("p_x_TypeName") ?>
</span>
	</div>
<?php } ?>
</div>
<div id="xsr_4" class="ew-row d-sm-flex">
	<div class="ew-quick-search input-group">
		<input type="text" name="<?php echo TABLE_BASIC_SEARCH ?>" id="<?php echo TABLE_BASIC_SEARCH ?>" class="form-control" value="<?php echo HtmlEncode($vwinboudsumary_list->BasicSearch->getKeyword()) ?>" placeholder="<?php echo HtmlEncode($Language->phrase("Search")) ?>">
		<input type="hidden" name="<?php echo TABLE_BASIC_SEARCH_TYPE ?>" id="<?php echo TABLE_BASIC_SEARCH_TYPE ?>" value="<?php echo HtmlEncode($vwinboudsumary_list->BasicSearch->getType()) ?>">
		<div class="input-group-append">
			<button class="btn btn-primary" name="btn-submit" id="btn-submit" type="submit"><?php echo $Language->phrase("SearchBtn") ?></button>
			<button type="button" data-toggle="dropdown" class="btn btn-primary dropdown-toggle dropdown-toggle-split" aria-haspopup="true" aria-expanded="false"><span id="searchtype"><?php echo $vwinboudsumary_list->BasicSearch->getTypeNameShort() ?></span></button>
			<div class="dropdown-menu dropdown-menu-right">
				<a class="dropdown-item<?php if ($vwinboudsumary_list->BasicSearch->getType() == "") echo " active"; ?>" href="javascript:void(0);" onclick="ew.setSearchType(this)"><?php echo $Language->phrase("QuickSearchAuto") ?></a>
				<a class="dropdown-item<?php if ($vwinboudsumary_list->BasicSearch->getType() == "=") echo " active"; ?>" href="javascript:void(0);" onclick="ew.setSearchType(this,'=')"><?php echo $Language->phrase("QuickSearchExact") ?></a>
				<a class="dropdown-item<?php if ($vwinboudsumary_list->BasicSearch->getType() == "AND") echo " active"; ?>" href="javascript:void(0);" onclick="ew.setSearchType(this,'AND')"><?php echo $Language->phrase("QuickSearchAll") ?></a>
				<a class="dropdown-item<?php if ($vwinboudsumary_list->BasicSearch->getType() == "OR") echo " active"; ?>" href="javascript:void(0);" onclick="ew.setSearchType(this,'OR')"><?php echo $Language->phrase("QuickSearchAny") ?></a>
			</div>
		</div>
	</div>
</div>
	</div>
</div>
</form>
<?php } ?>
<?php } ?>
<?php $vwinboudsumary_list->showPageHeader(); ?>
<?php
$vwinboudsumary_list->showMessage();
?>
<?php if ($vwinboudsumary_list->TotalRecs > 0 || $vwinboudsumary->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($vwinboudsumary_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> vwinboudsumary">
<?php if (!$vwinboudsumary->isExport()) { ?>
<div class="card-header ew-grid-upper-panel">
<?php if (!$vwinboudsumary->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php if (!isset($vwinboudsumary_list->Pager)) $vwinboudsumary_list->Pager = new PrevNextPager($vwinboudsumary_list->StartRec, $vwinboudsumary_list->DisplayRecs, $vwinboudsumary_list->TotalRecs, $vwinboudsumary_list->AutoHidePager) ?>
<?php if ($vwinboudsumary_list->Pager->RecordCount > 0 && $vwinboudsumary_list->Pager->Visible) { ?>
<div class="ew-pager">
<span><?php echo $Language->Phrase("Page") ?>&nbsp;</span>
<div class="ew-prev-next"><div class="input-group input-group-sm">
<div class="input-group-prepend">
<!-- first page button -->
	<?php if ($vwinboudsumary_list->Pager->FirstButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerFirst") ?>" href="<?php echo $vwinboudsumary_list->pageUrl() ?>start=<?php echo $vwinboudsumary_list->Pager->FirstButton->Start ?>"><i class="icon-first ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerFirst") ?>"><i class="icon-first ew-icon"></i></a>
	<?php } ?>
<!-- previous page button -->
	<?php if ($vwinboudsumary_list->Pager->PrevButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerPrevious") ?>" href="<?php echo $vwinboudsumary_list->pageUrl() ?>start=<?php echo $vwinboudsumary_list->Pager->PrevButton->Start ?>"><i class="icon-prev ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerPrevious") ?>"><i class="icon-prev ew-icon"></i></a>
	<?php } ?>
</div>
<!-- current page number -->
	<input class="form-control" type="text" name="<?php echo TABLE_PAGE_NO ?>" value="<?php echo $vwinboudsumary_list->Pager->CurrentPage ?>">
<div class="input-group-append">
<!-- next page button -->
	<?php if ($vwinboudsumary_list->Pager->NextButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerNext") ?>" href="<?php echo $vwinboudsumary_list->pageUrl() ?>start=<?php echo $vwinboudsumary_list->Pager->NextButton->Start ?>"><i class="icon-next ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerNext") ?>"><i class="icon-next ew-icon"></i></a>
	<?php } ?>
<!-- last page button -->
	<?php if ($vwinboudsumary_list->Pager->LastButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerLast") ?>" href="<?php echo $vwinboudsumary_list->pageUrl() ?>start=<?php echo $vwinboudsumary_list->Pager->LastButton->Start ?>"><i class="icon-last ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerLast") ?>"><i class="icon-last ew-icon"></i></a>
	<?php } ?>
</div>
</div>
</div>
<span>&nbsp;<?php echo $Language->Phrase("of") ?>&nbsp;<?php echo $vwinboudsumary_list->Pager->PageCount ?></span>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php if ($vwinboudsumary_list->Pager->RecordCount > 0) { ?>
<div class="ew-pager ew-rec">
	<span><?php echo $Language->Phrase("Record") ?>&nbsp;<?php echo $vwinboudsumary_list->Pager->FromIndex ?>&nbsp;<?php echo $Language->Phrase("To") ?>&nbsp;<?php echo $vwinboudsumary_list->Pager->ToIndex ?>&nbsp;<?php echo $Language->Phrase("Of") ?>&nbsp;<?php echo $vwinboudsumary_list->Pager->RecordCount ?></span>
</div>
<?php } ?>
<?php if ($vwinboudsumary_list->TotalRecs > 0 && (!$vwinboudsumary_list->AutoHidePageSizeSelector || $vwinboudsumary_list->Pager->Visible)) { ?>
<div class="ew-pager">
<input type="hidden" name="t" value="vwinboudsumary">
<select name="<?php echo TABLE_REC_PER_PAGE ?>" class="form-control form-control-sm ew-tooltip" title="<?php echo $Language->phrase("RecordsPerPage") ?>" onchange="this.form.submit();">
<option value="20"<?php if ($vwinboudsumary_list->DisplayRecs == 20) { ?> selected<?php } ?>>20</option>
<option value="50"<?php if ($vwinboudsumary_list->DisplayRecs == 50) { ?> selected<?php } ?>>50</option>
<option value="100"<?php if ($vwinboudsumary_list->DisplayRecs == 100) { ?> selected<?php } ?>>100</option>
<option value="200"<?php if ($vwinboudsumary_list->DisplayRecs == 200) { ?> selected<?php } ?>>200</option>
<option value="500"<?php if ($vwinboudsumary_list->DisplayRecs == 500) { ?> selected<?php } ?>>500</option>
<option value="ALL"<?php if ($vwinboudsumary->getRecordsPerPage() == -1) { ?> selected<?php } ?>><?php echo $Language->Phrase("AllRecords") ?></option>
</select>
</div>
<?php } ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $vwinboudsumary_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
<form name="fvwinboudsumarylist" id="fvwinboudsumarylist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($vwinboudsumary_list->CheckToken) { ?>
<input type="hidden" name="<?php echo TOKEN_NAME ?>" value="<?php echo $vwinboudsumary_list->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="vwinboudsumary">
<input type="hidden" name="exporttype" id="exporttype" value="">
<div id="gmp_vwinboudsumary" class="<?php if (IsResponsiveLayout()) { ?>table-responsive <?php } ?>card-body ew-grid-middle-panel">
<?php if ($vwinboudsumary_list->TotalRecs > 0 || $vwinboudsumary->isGridEdit()) { ?>
<table id="tbl_vwinboudsumarylist" class="table ew-table"><!-- .ew-table ##-->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$vwinboudsumary_list->RowType = ROWTYPE_HEADER;

// Render list options
$vwinboudsumary_list->renderListOptions();

// Render list options (header, left)
$vwinboudsumary_list->ListOptions->render("header", "left");
?>
<?php if ($vwinboudsumary->Nam->Visible) { // Nam ?>
	<?php if ($vwinboudsumary->sortUrl($vwinboudsumary->Nam) == "") { ?>
		<th data-name="Nam" class="<?php echo $vwinboudsumary->Nam->headerCellClass() ?>" style="white-space: nowrap;"><div id="elh_vwinboudsumary_Nam" class="vwinboudsumary_Nam"><div class="ew-table-header-caption"><?php echo $vwinboudsumary->Nam->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Nam" class="<?php echo $vwinboudsumary->Nam->headerCellClass() ?>" style="white-space: nowrap;"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $vwinboudsumary->SortUrl($vwinboudsumary->Nam) ?>',2);"><div id="elh_vwinboudsumary_Nam" class="vwinboudsumary_Nam">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $vwinboudsumary->Nam->caption() ?></span><span class="ew-table-header-sort"><?php if ($vwinboudsumary->Nam->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($vwinboudsumary->Nam->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($vwinboudsumary->Thang->Visible) { // Thang ?>
	<?php if ($vwinboudsumary->sortUrl($vwinboudsumary->Thang) == "") { ?>
		<th data-name="Thang" class="<?php echo $vwinboudsumary->Thang->headerCellClass() ?>" style="white-space: nowrap;"><div id="elh_vwinboudsumary_Thang" class="vwinboudsumary_Thang"><div class="ew-table-header-caption"><?php echo $vwinboudsumary->Thang->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Thang" class="<?php echo $vwinboudsumary->Thang->headerCellClass() ?>" style="white-space: nowrap;"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $vwinboudsumary->SortUrl($vwinboudsumary->Thang) ?>',2);"><div id="elh_vwinboudsumary_Thang" class="vwinboudsumary_Thang">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $vwinboudsumary->Thang->caption() ?></span><span class="ew-table-header-sort"><?php if ($vwinboudsumary->Thang->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($vwinboudsumary->Thang->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($vwinboudsumary->TruckNo->Visible) { // TruckNo ?>
	<?php if ($vwinboudsumary->sortUrl($vwinboudsumary->TruckNo) == "") { ?>
		<th data-name="TruckNo" class="<?php echo $vwinboudsumary->TruckNo->headerCellClass() ?>" style="white-space: nowrap;"><div id="elh_vwinboudsumary_TruckNo" class="vwinboudsumary_TruckNo"><div class="ew-table-header-caption"><?php echo $vwinboudsumary->TruckNo->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="TruckNo" class="<?php echo $vwinboudsumary->TruckNo->headerCellClass() ?>" style="white-space: nowrap;"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $vwinboudsumary->SortUrl($vwinboudsumary->TruckNo) ?>',2);"><div id="elh_vwinboudsumary_TruckNo" class="vwinboudsumary_TruckNo">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $vwinboudsumary->TruckNo->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($vwinboudsumary->TruckNo->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($vwinboudsumary->TruckNo->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($vwinboudsumary->Code->Visible) { // Code ?>
	<?php if ($vwinboudsumary->sortUrl($vwinboudsumary->Code) == "") { ?>
		<th data-name="Code" class="<?php echo $vwinboudsumary->Code->headerCellClass() ?>" style="white-space: nowrap;"><div id="elh_vwinboudsumary_Code" class="vwinboudsumary_Code"><div class="ew-table-header-caption"><?php echo $vwinboudsumary->Code->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Code" class="<?php echo $vwinboudsumary->Code->headerCellClass() ?>" style="white-space: nowrap;"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $vwinboudsumary->SortUrl($vwinboudsumary->Code) ?>',2);"><div id="elh_vwinboudsumary_Code" class="vwinboudsumary_Code">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $vwinboudsumary->Code->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($vwinboudsumary->Code->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($vwinboudsumary->Code->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($vwinboudsumary->ProductName->Visible) { // ProductName ?>
	<?php if ($vwinboudsumary->sortUrl($vwinboudsumary->ProductName) == "") { ?>
		<th data-name="ProductName" class="<?php echo $vwinboudsumary->ProductName->headerCellClass() ?>" style="white-space: nowrap;"><div id="elh_vwinboudsumary_ProductName" class="vwinboudsumary_ProductName"><div class="ew-table-header-caption"><?php echo $vwinboudsumary->ProductName->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="ProductName" class="<?php echo $vwinboudsumary->ProductName->headerCellClass() ?>" style="white-space: nowrap;"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $vwinboudsumary->SortUrl($vwinboudsumary->ProductName) ?>',2);"><div id="elh_vwinboudsumary_ProductName" class="vwinboudsumary_ProductName">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $vwinboudsumary->ProductName->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($vwinboudsumary->ProductName->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($vwinboudsumary->ProductName->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($vwinboudsumary->TypeName->Visible) { // TypeName ?>
	<?php if ($vwinboudsumary->sortUrl($vwinboudsumary->TypeName) == "") { ?>
		<th data-name="TypeName" class="<?php echo $vwinboudsumary->TypeName->headerCellClass() ?>"><div id="elh_vwinboudsumary_TypeName" class="vwinboudsumary_TypeName"><div class="ew-table-header-caption"><?php echo $vwinboudsumary->TypeName->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="TypeName" class="<?php echo $vwinboudsumary->TypeName->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $vwinboudsumary->SortUrl($vwinboudsumary->TypeName) ?>',2);"><div id="elh_vwinboudsumary_TypeName" class="vwinboudsumary_TypeName">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $vwinboudsumary->TypeName->caption() ?></span><span class="ew-table-header-sort"><?php if ($vwinboudsumary->TypeName->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($vwinboudsumary->TypeName->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($vwinboudsumary->PCS_INV->Visible) { // PCS_INV ?>
	<?php if ($vwinboudsumary->sortUrl($vwinboudsumary->PCS_INV) == "") { ?>
		<th data-name="PCS_INV" class="<?php echo $vwinboudsumary->PCS_INV->headerCellClass() ?>" style="white-space: nowrap;"><div id="elh_vwinboudsumary_PCS_INV" class="vwinboudsumary_PCS_INV"><div class="ew-table-header-caption"><?php echo $vwinboudsumary->PCS_INV->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="PCS_INV" class="<?php echo $vwinboudsumary->PCS_INV->headerCellClass() ?>" style="white-space: nowrap;"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $vwinboudsumary->SortUrl($vwinboudsumary->PCS_INV) ?>',2);"><div id="elh_vwinboudsumary_PCS_INV" class="vwinboudsumary_PCS_INV">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $vwinboudsumary->PCS_INV->caption() ?></span><span class="ew-table-header-sort"><?php if ($vwinboudsumary->PCS_INV->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($vwinboudsumary->PCS_INV->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($vwinboudsumary->PCS_really->Visible) { // PCS_really ?>
	<?php if ($vwinboudsumary->sortUrl($vwinboudsumary->PCS_really) == "") { ?>
		<th data-name="PCS_really" class="<?php echo $vwinboudsumary->PCS_really->headerCellClass() ?>" style="white-space: nowrap;"><div id="elh_vwinboudsumary_PCS_really" class="vwinboudsumary_PCS_really"><div class="ew-table-header-caption"><?php echo $vwinboudsumary->PCS_really->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="PCS_really" class="<?php echo $vwinboudsumary->PCS_really->headerCellClass() ?>" style="white-space: nowrap;"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $vwinboudsumary->SortUrl($vwinboudsumary->PCS_really) ?>',2);"><div id="elh_vwinboudsumary_PCS_really" class="vwinboudsumary_PCS_really">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $vwinboudsumary->PCS_really->caption() ?></span><span class="ew-table-header-sort"><?php if ($vwinboudsumary->PCS_really->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($vwinboudsumary->PCS_really->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$vwinboudsumary_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
if ($vwinboudsumary->ExportAll && $vwinboudsumary->isExport()) {
	$vwinboudsumary_list->StopRec = $vwinboudsumary_list->TotalRecs;
} else {

	// Set the last record to display
	if ($vwinboudsumary_list->TotalRecs > $vwinboudsumary_list->StartRec + $vwinboudsumary_list->DisplayRecs - 1)
		$vwinboudsumary_list->StopRec = $vwinboudsumary_list->StartRec + $vwinboudsumary_list->DisplayRecs - 1;
	else
		$vwinboudsumary_list->StopRec = $vwinboudsumary_list->TotalRecs;
}
$vwinboudsumary_list->RecCnt = $vwinboudsumary_list->StartRec - 1;
if ($vwinboudsumary_list->Recordset && !$vwinboudsumary_list->Recordset->EOF) {
	$vwinboudsumary_list->Recordset->moveFirst();
	$selectLimit = $vwinboudsumary_list->UseSelectLimit;
	if (!$selectLimit && $vwinboudsumary_list->StartRec > 1)
		$vwinboudsumary_list->Recordset->move($vwinboudsumary_list->StartRec - 1);
} elseif (!$vwinboudsumary->AllowAddDeleteRow && $vwinboudsumary_list->StopRec == 0) {
	$vwinboudsumary_list->StopRec = $vwinboudsumary->GridAddRowCount;
}

// Initialize aggregate
$vwinboudsumary->RowType = ROWTYPE_AGGREGATEINIT;
$vwinboudsumary->resetAttributes();
$vwinboudsumary_list->renderRow();
while ($vwinboudsumary_list->RecCnt < $vwinboudsumary_list->StopRec) {
	$vwinboudsumary_list->RecCnt++;
	if ($vwinboudsumary_list->RecCnt >= $vwinboudsumary_list->StartRec) {
		$vwinboudsumary_list->RowCnt++;

		// Set up key count
		$vwinboudsumary_list->KeyCount = $vwinboudsumary_list->RowIndex;

		// Init row class and style
		$vwinboudsumary->resetAttributes();
		$vwinboudsumary->CssClass = "";
		if ($vwinboudsumary->isGridAdd()) {
		} else {
			$vwinboudsumary_list->loadRowValues($vwinboudsumary_list->Recordset); // Load row values
		}
		$vwinboudsumary->RowType = ROWTYPE_VIEW; // Render view

		// Set up row id / data-rowindex
		$vwinboudsumary->RowAttrs = array_merge($vwinboudsumary->RowAttrs, array('data-rowindex'=>$vwinboudsumary_list->RowCnt, 'id'=>'r' . $vwinboudsumary_list->RowCnt . '_vwinboudsumary', 'data-rowtype'=>$vwinboudsumary->RowType));

		// Render row
		$vwinboudsumary_list->renderRow();

		// Render list options
		$vwinboudsumary_list->renderListOptions();
?>
	<tr<?php echo $vwinboudsumary->rowAttributes() ?>>
<?php

// Render list options (body, left)
$vwinboudsumary_list->ListOptions->render("body", "left", $vwinboudsumary_list->RowCnt);
?>
	<?php if ($vwinboudsumary->Nam->Visible) { // Nam ?>
		<td data-name="Nam"<?php echo $vwinboudsumary->Nam->cellAttributes() ?>>
<span id="el<?php echo $vwinboudsumary_list->RowCnt ?>_vwinboudsumary_Nam" class="vwinboudsumary_Nam">
<span<?php echo $vwinboudsumary->Nam->viewAttributes() ?>>
<?php echo $vwinboudsumary->Nam->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($vwinboudsumary->Thang->Visible) { // Thang ?>
		<td data-name="Thang"<?php echo $vwinboudsumary->Thang->cellAttributes() ?>>
<span id="el<?php echo $vwinboudsumary_list->RowCnt ?>_vwinboudsumary_Thang" class="vwinboudsumary_Thang">
<span<?php echo $vwinboudsumary->Thang->viewAttributes() ?>>
<?php echo $vwinboudsumary->Thang->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($vwinboudsumary->TruckNo->Visible) { // TruckNo ?>
		<td data-name="TruckNo"<?php echo $vwinboudsumary->TruckNo->cellAttributes() ?>>
<span id="el<?php echo $vwinboudsumary_list->RowCnt ?>_vwinboudsumary_TruckNo" class="vwinboudsumary_TruckNo">
<span<?php echo $vwinboudsumary->TruckNo->viewAttributes() ?>>
<?php echo $vwinboudsumary->TruckNo->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($vwinboudsumary->Code->Visible) { // Code ?>
		<td data-name="Code"<?php echo $vwinboudsumary->Code->cellAttributes() ?>>
<span id="el<?php echo $vwinboudsumary_list->RowCnt ?>_vwinboudsumary_Code" class="vwinboudsumary_Code">
<span<?php echo $vwinboudsumary->Code->viewAttributes() ?>>
<?php echo $vwinboudsumary->Code->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($vwinboudsumary->ProductName->Visible) { // ProductName ?>
		<td data-name="ProductName"<?php echo $vwinboudsumary->ProductName->cellAttributes() ?>>
<span id="el<?php echo $vwinboudsumary_list->RowCnt ?>_vwinboudsumary_ProductName" class="vwinboudsumary_ProductName">
<span<?php echo $vwinboudsumary->ProductName->viewAttributes() ?>>
<?php echo $vwinboudsumary->ProductName->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($vwinboudsumary->TypeName->Visible) { // TypeName ?>
		<td data-name="TypeName"<?php echo $vwinboudsumary->TypeName->cellAttributes() ?>>
<span id="el<?php echo $vwinboudsumary_list->RowCnt ?>_vwinboudsumary_TypeName" class="vwinboudsumary_TypeName">
<span<?php echo $vwinboudsumary->TypeName->viewAttributes() ?>>
<?php echo $vwinboudsumary->TypeName->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($vwinboudsumary->PCS_INV->Visible) { // PCS_INV ?>
		<td data-name="PCS_INV"<?php echo $vwinboudsumary->PCS_INV->cellAttributes() ?>>
<span id="el<?php echo $vwinboudsumary_list->RowCnt ?>_vwinboudsumary_PCS_INV" class="vwinboudsumary_PCS_INV">
<span<?php echo $vwinboudsumary->PCS_INV->viewAttributes() ?>>
<?php echo $vwinboudsumary->PCS_INV->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($vwinboudsumary->PCS_really->Visible) { // PCS_really ?>
		<td data-name="PCS_really"<?php echo $vwinboudsumary->PCS_really->cellAttributes() ?>>
<span id="el<?php echo $vwinboudsumary_list->RowCnt ?>_vwinboudsumary_PCS_really" class="vwinboudsumary_PCS_really">
<span<?php echo $vwinboudsumary->PCS_really->viewAttributes() ?>>
<?php echo $vwinboudsumary->PCS_really->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$vwinboudsumary_list->ListOptions->render("body", "right", $vwinboudsumary_list->RowCnt);
?>
	</tr>
<?php
	}
	if (!$vwinboudsumary->isGridAdd())
		$vwinboudsumary_list->Recordset->moveNext();
}
?>
</tbody>
<?php

// Render aggregate row
$vwinboudsumary->RowType = ROWTYPE_AGGREGATE;
$vwinboudsumary->resetAttributes();
$vwinboudsumary_list->renderRow();
?>
<?php if ($vwinboudsumary_list->TotalRecs > 0 && !$vwinboudsumary->isGridAdd() && !$vwinboudsumary->isGridEdit()) { ?>
<tfoot><!-- Table footer -->
	<tr class="ew-table-footer">
<?php

// Render list options
$vwinboudsumary_list->renderListOptions();

// Render list options (footer, left)
$vwinboudsumary_list->ListOptions->render("footer", "left");
?>
	<?php if ($vwinboudsumary->Nam->Visible) { // Nam ?>
		<td data-name="Nam" class="<?php echo $vwinboudsumary->Nam->footerCellClass() ?>"><span id="elf_vwinboudsumary_Nam" class="vwinboudsumary_Nam">
		&nbsp;
		</span></td>
	<?php } ?>
	<?php if ($vwinboudsumary->Thang->Visible) { // Thang ?>
		<td data-name="Thang" class="<?php echo $vwinboudsumary->Thang->footerCellClass() ?>"><span id="elf_vwinboudsumary_Thang" class="vwinboudsumary_Thang">
		&nbsp;
		</span></td>
	<?php } ?>
	<?php if ($vwinboudsumary->TruckNo->Visible) { // TruckNo ?>
		<td data-name="TruckNo" class="<?php echo $vwinboudsumary->TruckNo->footerCellClass() ?>"><span id="elf_vwinboudsumary_TruckNo" class="vwinboudsumary_TruckNo">
		&nbsp;
		</span></td>
	<?php } ?>
	<?php if ($vwinboudsumary->Code->Visible) { // Code ?>
		<td data-name="Code" class="<?php echo $vwinboudsumary->Code->footerCellClass() ?>"><span id="elf_vwinboudsumary_Code" class="vwinboudsumary_Code">
		&nbsp;
		</span></td>
	<?php } ?>
	<?php if ($vwinboudsumary->ProductName->Visible) { // ProductName ?>
		<td data-name="ProductName" class="<?php echo $vwinboudsumary->ProductName->footerCellClass() ?>"><span id="elf_vwinboudsumary_ProductName" class="vwinboudsumary_ProductName">
		&nbsp;
		</span></td>
	<?php } ?>
	<?php if ($vwinboudsumary->TypeName->Visible) { // TypeName ?>
		<td data-name="TypeName" class="<?php echo $vwinboudsumary->TypeName->footerCellClass() ?>"><span id="elf_vwinboudsumary_TypeName" class="vwinboudsumary_TypeName">
		&nbsp;
		</span></td>
	<?php } ?>
	<?php if ($vwinboudsumary->PCS_INV->Visible) { // PCS_INV ?>
		<td data-name="PCS_INV" class="<?php echo $vwinboudsumary->PCS_INV->footerCellClass() ?>"><span id="elf_vwinboudsumary_PCS_INV" class="vwinboudsumary_PCS_INV">
		<span class="ew-aggregate"><?php echo $Language->phrase("TOTAL") ?></span><span class="ew-aggregate-value">
		<?php echo $vwinboudsumary->PCS_INV->ViewValue ?></span>
		</span></td>
	<?php } ?>
	<?php if ($vwinboudsumary->PCS_really->Visible) { // PCS_really ?>
		<td data-name="PCS_really" class="<?php echo $vwinboudsumary->PCS_really->footerCellClass() ?>"><span id="elf_vwinboudsumary_PCS_really" class="vwinboudsumary_PCS_really">
		<span class="ew-aggregate"><?php echo $Language->phrase("TOTAL") ?></span><span class="ew-aggregate-value">
		<?php echo $vwinboudsumary->PCS_really->ViewValue ?></span>
		</span></td>
	<?php } ?>
<?php

// Render list options (footer, right)
$vwinboudsumary_list->ListOptions->render("footer", "right");
?>
	</tr>
</tfoot>
<?php } ?>
</table><!-- /.ew-table -->
<?php } ?>
<?php if (!$vwinboudsumary->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</div><!-- /.ew-grid-middle-panel -->
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($vwinboudsumary_list->Recordset)
	$vwinboudsumary_list->Recordset->Close();
?>
<?php if (!$vwinboudsumary->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$vwinboudsumary->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php if (!isset($vwinboudsumary_list->Pager)) $vwinboudsumary_list->Pager = new PrevNextPager($vwinboudsumary_list->StartRec, $vwinboudsumary_list->DisplayRecs, $vwinboudsumary_list->TotalRecs, $vwinboudsumary_list->AutoHidePager) ?>
<?php if ($vwinboudsumary_list->Pager->RecordCount > 0 && $vwinboudsumary_list->Pager->Visible) { ?>
<div class="ew-pager">
<span><?php echo $Language->Phrase("Page") ?>&nbsp;</span>
<div class="ew-prev-next"><div class="input-group input-group-sm">
<div class="input-group-prepend">
<!-- first page button -->
	<?php if ($vwinboudsumary_list->Pager->FirstButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerFirst") ?>" href="<?php echo $vwinboudsumary_list->pageUrl() ?>start=<?php echo $vwinboudsumary_list->Pager->FirstButton->Start ?>"><i class="icon-first ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerFirst") ?>"><i class="icon-first ew-icon"></i></a>
	<?php } ?>
<!-- previous page button -->
	<?php if ($vwinboudsumary_list->Pager->PrevButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerPrevious") ?>" href="<?php echo $vwinboudsumary_list->pageUrl() ?>start=<?php echo $vwinboudsumary_list->Pager->PrevButton->Start ?>"><i class="icon-prev ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerPrevious") ?>"><i class="icon-prev ew-icon"></i></a>
	<?php } ?>
</div>
<!-- current page number -->
	<input class="form-control" type="text" name="<?php echo TABLE_PAGE_NO ?>" value="<?php echo $vwinboudsumary_list->Pager->CurrentPage ?>">
<div class="input-group-append">
<!-- next page button -->
	<?php if ($vwinboudsumary_list->Pager->NextButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerNext") ?>" href="<?php echo $vwinboudsumary_list->pageUrl() ?>start=<?php echo $vwinboudsumary_list->Pager->NextButton->Start ?>"><i class="icon-next ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerNext") ?>"><i class="icon-next ew-icon"></i></a>
	<?php } ?>
<!-- last page button -->
	<?php if ($vwinboudsumary_list->Pager->LastButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerLast") ?>" href="<?php echo $vwinboudsumary_list->pageUrl() ?>start=<?php echo $vwinboudsumary_list->Pager->LastButton->Start ?>"><i class="icon-last ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerLast") ?>"><i class="icon-last ew-icon"></i></a>
	<?php } ?>
</div>
</div>
</div>
<span>&nbsp;<?php echo $Language->Phrase("of") ?>&nbsp;<?php echo $vwinboudsumary_list->Pager->PageCount ?></span>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php if ($vwinboudsumary_list->Pager->RecordCount > 0) { ?>
<div class="ew-pager ew-rec">
	<span><?php echo $Language->Phrase("Record") ?>&nbsp;<?php echo $vwinboudsumary_list->Pager->FromIndex ?>&nbsp;<?php echo $Language->Phrase("To") ?>&nbsp;<?php echo $vwinboudsumary_list->Pager->ToIndex ?>&nbsp;<?php echo $Language->Phrase("Of") ?>&nbsp;<?php echo $vwinboudsumary_list->Pager->RecordCount ?></span>
</div>
<?php } ?>
<?php if ($vwinboudsumary_list->TotalRecs > 0 && (!$vwinboudsumary_list->AutoHidePageSizeSelector || $vwinboudsumary_list->Pager->Visible)) { ?>
<div class="ew-pager">
<input type="hidden" name="t" value="vwinboudsumary">
<select name="<?php echo TABLE_REC_PER_PAGE ?>" class="form-control form-control-sm ew-tooltip" title="<?php echo $Language->phrase("RecordsPerPage") ?>" onchange="this.form.submit();">
<option value="20"<?php if ($vwinboudsumary_list->DisplayRecs == 20) { ?> selected<?php } ?>>20</option>
<option value="50"<?php if ($vwinboudsumary_list->DisplayRecs == 50) { ?> selected<?php } ?>>50</option>
<option value="100"<?php if ($vwinboudsumary_list->DisplayRecs == 100) { ?> selected<?php } ?>>100</option>
<option value="200"<?php if ($vwinboudsumary_list->DisplayRecs == 200) { ?> selected<?php } ?>>200</option>
<option value="500"<?php if ($vwinboudsumary_list->DisplayRecs == 500) { ?> selected<?php } ?>>500</option>
<option value="ALL"<?php if ($vwinboudsumary->getRecordsPerPage() == -1) { ?> selected<?php } ?>><?php echo $Language->Phrase("AllRecords") ?></option>
</select>
</div>
<?php } ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $vwinboudsumary_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($vwinboudsumary_list->TotalRecs == 0 && !$vwinboudsumary->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $vwinboudsumary_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$vwinboudsumary_list->showPageFooter();
if (DEBUG_ENABLED)
	echo GetDebugMessage();
?>
<?php if (!$vwinboudsumary->isExport()) { ?>
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
		window.location="rpt_received.php?id="+x.substring(0,x.length-1);
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
		window.location="rpt_received.php?id="+x.substring(0,x.length-1);
	});	
// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php } ?>
<?php include_once "footer.php" ?>
<?php
$vwinboudsumary_list->terminate();
?>