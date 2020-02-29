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
$vwsumpcs_code_list = new vwsumpcs_code_list();

// Run the page
$vwsumpcs_code_list->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$vwsumpcs_code_list->Page_Render();
?>
<?php include_once "header.php" ?>
<?php if (!$vwsumpcs_code->isExport()) { ?>
<script>

// Form object
currentPageID = ew.PAGE_ID = "list";
var fvwsumpcs_codelist = currentForm = new ew.Form("fvwsumpcs_codelist", "list");
fvwsumpcs_codelist.formKeyCountName = '<?php echo $vwsumpcs_code_list->FormKeyCountName ?>';

// Form_CustomValidate event
fvwsumpcs_codelist.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

	// Your custom validation code here, return false if invalid.
	return true;
}

// Use JavaScript validation or not
fvwsumpcs_codelist.validateRequired = <?php echo json_encode(CLIENT_VALIDATE) ?>;

// Dynamic selection lists
fvwsumpcs_codelist.lists["x_TypeName"] = <?php echo $vwsumpcs_code_list->TypeName->Lookup->toClientList() ?>;
fvwsumpcs_codelist.lists["x_TypeName"].options = <?php echo JsonEncode($vwsumpcs_code_list->TypeName->lookupOptions()) ?>;
fvwsumpcs_codelist.lists["x_Pallet"] = <?php echo $vwsumpcs_code_list->Pallet->Lookup->toClientList() ?>;
fvwsumpcs_codelist.lists["x_Pallet"].options = <?php echo JsonEncode($vwsumpcs_code_list->Pallet->options(FALSE, TRUE)) ?>;

// Form object for search
var fvwsumpcs_codelistsrch = currentSearchForm = new ew.Form("fvwsumpcs_codelistsrch");

// Validate function for search
fvwsumpcs_codelistsrch.validate = function(fobj) {
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
fvwsumpcs_codelistsrch.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

	// Your custom validation code here, return false if invalid.
	return true;
}

// Use JavaScript validation or not
fvwsumpcs_codelistsrch.validateRequired = <?php echo json_encode(CLIENT_VALIDATE) ?>;

// Dynamic selection lists
fvwsumpcs_codelistsrch.lists["x_TypeName"] = <?php echo $vwsumpcs_code_list->TypeName->Lookup->toClientList() ?>;
fvwsumpcs_codelistsrch.lists["x_TypeName"].options = <?php echo JsonEncode($vwsumpcs_code_list->TypeName->lookupOptions()) ?>;

// Filters
fvwsumpcs_codelistsrch.filterList = <?php echo $vwsumpcs_code_list->getFilterList() ?>;
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
<?php if (!$vwsumpcs_code->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($vwsumpcs_code_list->TotalRecs > 0 && $vwsumpcs_code_list->ExportOptions->visible()) { ?>
<?php $vwsumpcs_code_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($vwsumpcs_code_list->ImportOptions->visible()) { ?>
<?php $vwsumpcs_code_list->ImportOptions->render("body") ?>
<?php } ?>
<?php if ($vwsumpcs_code_list->SearchOptions->visible()) { ?>
<?php $vwsumpcs_code_list->SearchOptions->render("body") ?>
<?php } ?>
<?php if ($vwsumpcs_code_list->FilterOptions->visible()) { ?>
<?php $vwsumpcs_code_list->FilterOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php
$vwsumpcs_code_list->renderOtherOptions();
?>
<?php if ($Security->CanSearch()) { ?>
<?php if (!$vwsumpcs_code->isExport() && !$vwsumpcs_code->CurrentAction) { ?>
<form name="fvwsumpcs_codelistsrch" id="fvwsumpcs_codelistsrch" class="form-inline ew-form ew-ext-search-form" action="<?php echo CurrentPageName() ?>">
<?php $searchPanelClass = ($vwsumpcs_code_list->SearchWhere <> "") ? " show" : " show"; ?>
<div id="fvwsumpcs_codelistsrch-search-panel" class="ew-search-panel collapse<?php echo $searchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="vwsumpcs_code">
	<div class="ew-basic-search">
<?php
if ($SearchError == "")
	$vwsumpcs_code_list->LoadAdvancedSearch(); // Load advanced search

// Render for search
$vwsumpcs_code->RowType = ROWTYPE_SEARCH;

// Render row
$vwsumpcs_code->resetAttributes();
$vwsumpcs_code_list->renderRow();
?>
<div id="xsr_1" class="ew-row d-sm-flex">
<?php if ($vwsumpcs_code->TypeName->Visible) { // TypeName ?>
	<div id="xsc_TypeName" class="ew-cell form-group">
		<label for="x_TypeName" class="ew-search-caption ew-label"><?php echo $vwsumpcs_code->TypeName->caption() ?></label>
		<span class="ew-search-operator"><?php echo $Language->phrase("LIKE") ?><input type="hidden" name="z_TypeName" id="z_TypeName" value="LIKE"></span>
		<span class="ew-search-field">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="vwsumpcs_code" data-field="x_TypeName" data-value-separator="<?php echo $vwsumpcs_code->TypeName->displayValueSeparatorAttribute() ?>" id="x_TypeName" name="x_TypeName"<?php echo $vwsumpcs_code->TypeName->editAttributes() ?>>
		<?php echo $vwsumpcs_code->TypeName->selectOptionListHtml("x_TypeName") ?>
	</select>
</div>
<?php echo $vwsumpcs_code->TypeName->Lookup->getParamTag("p_x_TypeName") ?>
</span>
	</div>
<?php } ?>
</div>
<div id="xsr_2" class="ew-row d-sm-flex">
	<div class="ew-quick-search input-group">
		<input type="text" name="<?php echo TABLE_BASIC_SEARCH ?>" id="<?php echo TABLE_BASIC_SEARCH ?>" class="form-control" value="<?php echo HtmlEncode($vwsumpcs_code_list->BasicSearch->getKeyword()) ?>" placeholder="<?php echo HtmlEncode($Language->phrase("Search")) ?>">
		<input type="hidden" name="<?php echo TABLE_BASIC_SEARCH_TYPE ?>" id="<?php echo TABLE_BASIC_SEARCH_TYPE ?>" value="<?php echo HtmlEncode($vwsumpcs_code_list->BasicSearch->getType()) ?>">
		<div class="input-group-append">
			<button class="btn btn-primary" name="btn-submit" id="btn-submit" type="submit"><?php echo $Language->phrase("SearchBtn") ?></button>
			<button type="button" data-toggle="dropdown" class="btn btn-primary dropdown-toggle dropdown-toggle-split" aria-haspopup="true" aria-expanded="false"><span id="searchtype"><?php echo $vwsumpcs_code_list->BasicSearch->getTypeNameShort() ?></span></button>
			<div class="dropdown-menu dropdown-menu-right">
				<a class="dropdown-item<?php if ($vwsumpcs_code_list->BasicSearch->getType() == "") echo " active"; ?>" href="javascript:void(0);" onclick="ew.setSearchType(this)"><?php echo $Language->phrase("QuickSearchAuto") ?></a>
				<a class="dropdown-item<?php if ($vwsumpcs_code_list->BasicSearch->getType() == "=") echo " active"; ?>" href="javascript:void(0);" onclick="ew.setSearchType(this,'=')"><?php echo $Language->phrase("QuickSearchExact") ?></a>
				<a class="dropdown-item<?php if ($vwsumpcs_code_list->BasicSearch->getType() == "AND") echo " active"; ?>" href="javascript:void(0);" onclick="ew.setSearchType(this,'AND')"><?php echo $Language->phrase("QuickSearchAll") ?></a>
				<a class="dropdown-item<?php if ($vwsumpcs_code_list->BasicSearch->getType() == "OR") echo " active"; ?>" href="javascript:void(0);" onclick="ew.setSearchType(this,'OR')"><?php echo $Language->phrase("QuickSearchAny") ?></a>
			</div>
		</div>
	</div>
</div>
	</div>
</div>
</form>
<?php } ?>
<?php } ?>
<?php $vwsumpcs_code_list->showPageHeader(); ?>
<?php
$vwsumpcs_code_list->showMessage();
?>
<?php if ($vwsumpcs_code_list->TotalRecs > 0 || $vwsumpcs_code->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($vwsumpcs_code_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> vwsumpcs_code">
<?php if (!$vwsumpcs_code->isExport()) { ?>
<div class="card-header ew-grid-upper-panel">
<?php if (!$vwsumpcs_code->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php if (!isset($vwsumpcs_code_list->Pager)) $vwsumpcs_code_list->Pager = new PrevNextPager($vwsumpcs_code_list->StartRec, $vwsumpcs_code_list->DisplayRecs, $vwsumpcs_code_list->TotalRecs, $vwsumpcs_code_list->AutoHidePager) ?>
<?php if ($vwsumpcs_code_list->Pager->RecordCount > 0 && $vwsumpcs_code_list->Pager->Visible) { ?>
<div class="ew-pager">
<span><?php echo $Language->Phrase("Page") ?>&nbsp;</span>
<div class="ew-prev-next"><div class="input-group input-group-sm">
<div class="input-group-prepend">
<!-- first page button -->
	<?php if ($vwsumpcs_code_list->Pager->FirstButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerFirst") ?>" href="<?php echo $vwsumpcs_code_list->pageUrl() ?>start=<?php echo $vwsumpcs_code_list->Pager->FirstButton->Start ?>"><i class="icon-first ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerFirst") ?>"><i class="icon-first ew-icon"></i></a>
	<?php } ?>
<!-- previous page button -->
	<?php if ($vwsumpcs_code_list->Pager->PrevButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerPrevious") ?>" href="<?php echo $vwsumpcs_code_list->pageUrl() ?>start=<?php echo $vwsumpcs_code_list->Pager->PrevButton->Start ?>"><i class="icon-prev ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerPrevious") ?>"><i class="icon-prev ew-icon"></i></a>
	<?php } ?>
</div>
<!-- current page number -->
	<input class="form-control" type="text" name="<?php echo TABLE_PAGE_NO ?>" value="<?php echo $vwsumpcs_code_list->Pager->CurrentPage ?>">
<div class="input-group-append">
<!-- next page button -->
	<?php if ($vwsumpcs_code_list->Pager->NextButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerNext") ?>" href="<?php echo $vwsumpcs_code_list->pageUrl() ?>start=<?php echo $vwsumpcs_code_list->Pager->NextButton->Start ?>"><i class="icon-next ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerNext") ?>"><i class="icon-next ew-icon"></i></a>
	<?php } ?>
<!-- last page button -->
	<?php if ($vwsumpcs_code_list->Pager->LastButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerLast") ?>" href="<?php echo $vwsumpcs_code_list->pageUrl() ?>start=<?php echo $vwsumpcs_code_list->Pager->LastButton->Start ?>"><i class="icon-last ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerLast") ?>"><i class="icon-last ew-icon"></i></a>
	<?php } ?>
</div>
</div>
</div>
<span>&nbsp;<?php echo $Language->Phrase("of") ?>&nbsp;<?php echo $vwsumpcs_code_list->Pager->PageCount ?></span>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php if ($vwsumpcs_code_list->Pager->RecordCount > 0) { ?>
<div class="ew-pager ew-rec">
	<span><?php echo $Language->Phrase("Record") ?>&nbsp;<?php echo $vwsumpcs_code_list->Pager->FromIndex ?>&nbsp;<?php echo $Language->Phrase("To") ?>&nbsp;<?php echo $vwsumpcs_code_list->Pager->ToIndex ?>&nbsp;<?php echo $Language->Phrase("Of") ?>&nbsp;<?php echo $vwsumpcs_code_list->Pager->RecordCount ?></span>
</div>
<?php } ?>
<?php if ($vwsumpcs_code_list->TotalRecs > 0 && (!$vwsumpcs_code_list->AutoHidePageSizeSelector || $vwsumpcs_code_list->Pager->Visible)) { ?>
<div class="ew-pager">
<input type="hidden" name="t" value="vwsumpcs_code">
<select name="<?php echo TABLE_REC_PER_PAGE ?>" class="form-control form-control-sm ew-tooltip" title="<?php echo $Language->phrase("RecordsPerPage") ?>" onchange="this.form.submit();">
<option value="20"<?php if ($vwsumpcs_code_list->DisplayRecs == 20) { ?> selected<?php } ?>>20</option>
<option value="50"<?php if ($vwsumpcs_code_list->DisplayRecs == 50) { ?> selected<?php } ?>>50</option>
<option value="100"<?php if ($vwsumpcs_code_list->DisplayRecs == 100) { ?> selected<?php } ?>>100</option>
<option value="200"<?php if ($vwsumpcs_code_list->DisplayRecs == 200) { ?> selected<?php } ?>>200</option>
<option value="500"<?php if ($vwsumpcs_code_list->DisplayRecs == 500) { ?> selected<?php } ?>>500</option>
<option value="ALL"<?php if ($vwsumpcs_code->getRecordsPerPage() == -1) { ?> selected<?php } ?>><?php echo $Language->Phrase("AllRecords") ?></option>
</select>
</div>
<?php } ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $vwsumpcs_code_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
<form name="fvwsumpcs_codelist" id="fvwsumpcs_codelist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($vwsumpcs_code_list->CheckToken) { ?>
<input type="hidden" name="<?php echo TOKEN_NAME ?>" value="<?php echo $vwsumpcs_code_list->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="vwsumpcs_code">
<input type="hidden" name="exporttype" id="exporttype" value="">
<div id="gmp_vwsumpcs_code" class="<?php if (IsResponsiveLayout()) { ?>table-responsive <?php } ?>card-body ew-grid-middle-panel">
<?php if ($vwsumpcs_code_list->TotalRecs > 0 || $vwsumpcs_code->isGridEdit()) { ?>
<table id="tbl_vwsumpcs_codelist" class="table ew-table"><!-- .ew-table ##-->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$vwsumpcs_code_list->RowType = ROWTYPE_HEADER;

// Render list options
$vwsumpcs_code_list->renderListOptions();

// Render list options (header, left)
$vwsumpcs_code_list->ListOptions->render("header", "left");
?>
<?php if ($vwsumpcs_code->TypeName->Visible) { // TypeName ?>
	<?php if ($vwsumpcs_code->sortUrl($vwsumpcs_code->TypeName) == "") { ?>
		<th data-name="TypeName" class="<?php echo $vwsumpcs_code->TypeName->headerCellClass() ?>" style="white-space: nowrap;"><div id="elh_vwsumpcs_code_TypeName" class="vwsumpcs_code_TypeName"><div class="ew-table-header-caption"><?php echo $vwsumpcs_code->TypeName->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="TypeName" class="<?php echo $vwsumpcs_code->TypeName->headerCellClass() ?>" style="white-space: nowrap;"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $vwsumpcs_code->SortUrl($vwsumpcs_code->TypeName) ?>',2);"><div id="elh_vwsumpcs_code_TypeName" class="vwsumpcs_code_TypeName">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $vwsumpcs_code->TypeName->caption() ?></span><span class="ew-table-header-sort"><?php if ($vwsumpcs_code->TypeName->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($vwsumpcs_code->TypeName->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($vwsumpcs_code->Code->Visible) { // Code ?>
	<?php if ($vwsumpcs_code->sortUrl($vwsumpcs_code->Code) == "") { ?>
		<th data-name="Code" class="<?php echo $vwsumpcs_code->Code->headerCellClass() ?>" style="white-space: nowrap;"><div id="elh_vwsumpcs_code_Code" class="vwsumpcs_code_Code"><div class="ew-table-header-caption"><?php echo $vwsumpcs_code->Code->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Code" class="<?php echo $vwsumpcs_code->Code->headerCellClass() ?>" style="white-space: nowrap;"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $vwsumpcs_code->SortUrl($vwsumpcs_code->Code) ?>',2);"><div id="elh_vwsumpcs_code_Code" class="vwsumpcs_code_Code">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $vwsumpcs_code->Code->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($vwsumpcs_code->Code->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($vwsumpcs_code->Code->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($vwsumpcs_code->ProductName->Visible) { // ProductName ?>
	<?php if ($vwsumpcs_code->sortUrl($vwsumpcs_code->ProductName) == "") { ?>
		<th data-name="ProductName" class="<?php echo $vwsumpcs_code->ProductName->headerCellClass() ?>" style="white-space: nowrap;"><div id="elh_vwsumpcs_code_ProductName" class="vwsumpcs_code_ProductName"><div class="ew-table-header-caption"><?php echo $vwsumpcs_code->ProductName->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="ProductName" class="<?php echo $vwsumpcs_code->ProductName->headerCellClass() ?>" style="white-space: nowrap;"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $vwsumpcs_code->SortUrl($vwsumpcs_code->ProductName) ?>',2);"><div id="elh_vwsumpcs_code_ProductName" class="vwsumpcs_code_ProductName">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $vwsumpcs_code->ProductName->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($vwsumpcs_code->ProductName->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($vwsumpcs_code->ProductName->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($vwsumpcs_code->Model->Visible) { // Model ?>
	<?php if ($vwsumpcs_code->sortUrl($vwsumpcs_code->Model) == "") { ?>
		<th data-name="Model" class="<?php echo $vwsumpcs_code->Model->headerCellClass() ?>" style="white-space: nowrap;"><div id="elh_vwsumpcs_code_Model" class="vwsumpcs_code_Model"><div class="ew-table-header-caption"><?php echo $vwsumpcs_code->Model->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Model" class="<?php echo $vwsumpcs_code->Model->headerCellClass() ?>" style="white-space: nowrap;"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $vwsumpcs_code->SortUrl($vwsumpcs_code->Model) ?>',2);"><div id="elh_vwsumpcs_code_Model" class="vwsumpcs_code_Model">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $vwsumpcs_code->Model->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($vwsumpcs_code->Model->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($vwsumpcs_code->Model->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($vwsumpcs_code->SUM28ts_PCS29->Visible) { // SUM(ts.PCS) ?>
	<?php if ($vwsumpcs_code->sortUrl($vwsumpcs_code->SUM28ts_PCS29) == "") { ?>
		<th data-name="SUM28ts_PCS29" class="<?php echo $vwsumpcs_code->SUM28ts_PCS29->headerCellClass() ?>" style="white-space: nowrap;"><div id="elh_vwsumpcs_code_SUM28ts_PCS29" class="vwsumpcs_code_SUM28ts_PCS29"><div class="ew-table-header-caption"><?php echo $vwsumpcs_code->SUM28ts_PCS29->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="SUM28ts_PCS29" class="<?php echo $vwsumpcs_code->SUM28ts_PCS29->headerCellClass() ?>" style="white-space: nowrap;"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $vwsumpcs_code->SortUrl($vwsumpcs_code->SUM28ts_PCS29) ?>',2);"><div id="elh_vwsumpcs_code_SUM28ts_PCS29" class="vwsumpcs_code_SUM28ts_PCS29">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $vwsumpcs_code->SUM28ts_PCS29->caption() ?></span><span class="ew-table-header-sort"><?php if ($vwsumpcs_code->SUM28ts_PCS29->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($vwsumpcs_code->SUM28ts_PCS29->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($vwsumpcs_code->Pallet->Visible) { // Pallet ?>
	<?php if ($vwsumpcs_code->sortUrl($vwsumpcs_code->Pallet) == "") { ?>
		<th data-name="Pallet" class="<?php echo $vwsumpcs_code->Pallet->headerCellClass() ?>" style="white-space: nowrap;"><div id="elh_vwsumpcs_code_Pallet" class="vwsumpcs_code_Pallet"><div class="ew-table-header-caption"><?php echo $vwsumpcs_code->Pallet->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Pallet" class="<?php echo $vwsumpcs_code->Pallet->headerCellClass() ?>" style="white-space: nowrap;"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $vwsumpcs_code->SortUrl($vwsumpcs_code->Pallet) ?>',2);"><div id="elh_vwsumpcs_code_Pallet" class="vwsumpcs_code_Pallet">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $vwsumpcs_code->Pallet->caption() ?></span><span class="ew-table-header-sort"><?php if ($vwsumpcs_code->Pallet->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($vwsumpcs_code->Pallet->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$vwsumpcs_code_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
if ($vwsumpcs_code->ExportAll && $vwsumpcs_code->isExport()) {
	$vwsumpcs_code_list->StopRec = $vwsumpcs_code_list->TotalRecs;
} else {

	// Set the last record to display
	if ($vwsumpcs_code_list->TotalRecs > $vwsumpcs_code_list->StartRec + $vwsumpcs_code_list->DisplayRecs - 1)
		$vwsumpcs_code_list->StopRec = $vwsumpcs_code_list->StartRec + $vwsumpcs_code_list->DisplayRecs - 1;
	else
		$vwsumpcs_code_list->StopRec = $vwsumpcs_code_list->TotalRecs;
}
$vwsumpcs_code_list->RecCnt = $vwsumpcs_code_list->StartRec - 1;
if ($vwsumpcs_code_list->Recordset && !$vwsumpcs_code_list->Recordset->EOF) {
	$vwsumpcs_code_list->Recordset->moveFirst();
	$selectLimit = $vwsumpcs_code_list->UseSelectLimit;
	if (!$selectLimit && $vwsumpcs_code_list->StartRec > 1)
		$vwsumpcs_code_list->Recordset->move($vwsumpcs_code_list->StartRec - 1);
} elseif (!$vwsumpcs_code->AllowAddDeleteRow && $vwsumpcs_code_list->StopRec == 0) {
	$vwsumpcs_code_list->StopRec = $vwsumpcs_code->GridAddRowCount;
}

// Initialize aggregate
$vwsumpcs_code->RowType = ROWTYPE_AGGREGATEINIT;
$vwsumpcs_code->resetAttributes();
$vwsumpcs_code_list->renderRow();
while ($vwsumpcs_code_list->RecCnt < $vwsumpcs_code_list->StopRec) {
	$vwsumpcs_code_list->RecCnt++;
	if ($vwsumpcs_code_list->RecCnt >= $vwsumpcs_code_list->StartRec) {
		$vwsumpcs_code_list->RowCnt++;

		// Set up key count
		$vwsumpcs_code_list->KeyCount = $vwsumpcs_code_list->RowIndex;

		// Init row class and style
		$vwsumpcs_code->resetAttributes();
		$vwsumpcs_code->CssClass = "";
		if ($vwsumpcs_code->isGridAdd()) {
		} else {
			$vwsumpcs_code_list->loadRowValues($vwsumpcs_code_list->Recordset); // Load row values
		}
		$vwsumpcs_code->RowType = ROWTYPE_VIEW; // Render view

		// Set up row id / data-rowindex
		$vwsumpcs_code->RowAttrs = array_merge($vwsumpcs_code->RowAttrs, array('data-rowindex'=>$vwsumpcs_code_list->RowCnt, 'id'=>'r' . $vwsumpcs_code_list->RowCnt . '_vwsumpcs_code', 'data-rowtype'=>$vwsumpcs_code->RowType));

		// Render row
		$vwsumpcs_code_list->renderRow();

		// Render list options
		$vwsumpcs_code_list->renderListOptions();
?>
	<tr<?php echo $vwsumpcs_code->rowAttributes() ?>>
<?php

// Render list options (body, left)
$vwsumpcs_code_list->ListOptions->render("body", "left", $vwsumpcs_code_list->RowCnt);
?>
	<?php if ($vwsumpcs_code->TypeName->Visible) { // TypeName ?>
		<td data-name="TypeName"<?php echo $vwsumpcs_code->TypeName->cellAttributes() ?>>
<span id="el<?php echo $vwsumpcs_code_list->RowCnt ?>_vwsumpcs_code_TypeName" class="vwsumpcs_code_TypeName">
<span<?php echo $vwsumpcs_code->TypeName->viewAttributes() ?>>
<?php echo $vwsumpcs_code->TypeName->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($vwsumpcs_code->Code->Visible) { // Code ?>
		<td data-name="Code"<?php echo $vwsumpcs_code->Code->cellAttributes() ?>>
<span id="el<?php echo $vwsumpcs_code_list->RowCnt ?>_vwsumpcs_code_Code" class="vwsumpcs_code_Code">
<span<?php echo $vwsumpcs_code->Code->viewAttributes() ?>>
<?php echo $vwsumpcs_code->Code->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($vwsumpcs_code->ProductName->Visible) { // ProductName ?>
		<td data-name="ProductName"<?php echo $vwsumpcs_code->ProductName->cellAttributes() ?>>
<span id="el<?php echo $vwsumpcs_code_list->RowCnt ?>_vwsumpcs_code_ProductName" class="vwsumpcs_code_ProductName">
<span<?php echo $vwsumpcs_code->ProductName->viewAttributes() ?>>
<?php echo $vwsumpcs_code->ProductName->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($vwsumpcs_code->Model->Visible) { // Model ?>
		<td data-name="Model"<?php echo $vwsumpcs_code->Model->cellAttributes() ?>>
<span id="el<?php echo $vwsumpcs_code_list->RowCnt ?>_vwsumpcs_code_Model" class="vwsumpcs_code_Model">
<span<?php echo $vwsumpcs_code->Model->viewAttributes() ?>>
<?php echo $vwsumpcs_code->Model->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($vwsumpcs_code->SUM28ts_PCS29->Visible) { // SUM(ts.PCS) ?>
		<td data-name="SUM28ts_PCS29"<?php echo $vwsumpcs_code->SUM28ts_PCS29->cellAttributes() ?>>
<span id="el<?php echo $vwsumpcs_code_list->RowCnt ?>_vwsumpcs_code_SUM28ts_PCS29" class="vwsumpcs_code_SUM28ts_PCS29">
<span<?php echo $vwsumpcs_code->SUM28ts_PCS29->viewAttributes() ?>>
<?php echo $vwsumpcs_code->SUM28ts_PCS29->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($vwsumpcs_code->Pallet->Visible) { // Pallet ?>
		<td data-name="Pallet"<?php echo $vwsumpcs_code->Pallet->cellAttributes() ?>>
<span id="el<?php echo $vwsumpcs_code_list->RowCnt ?>_vwsumpcs_code_Pallet" class="vwsumpcs_code_Pallet">
<span<?php echo $vwsumpcs_code->Pallet->viewAttributes() ?>>
<?php echo $vwsumpcs_code->Pallet->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$vwsumpcs_code_list->ListOptions->render("body", "right", $vwsumpcs_code_list->RowCnt);
?>
	</tr>
<?php
	}
	if (!$vwsumpcs_code->isGridAdd())
		$vwsumpcs_code_list->Recordset->moveNext();
}
?>
</tbody>
<?php

// Render aggregate row
$vwsumpcs_code->RowType = ROWTYPE_AGGREGATE;
$vwsumpcs_code->resetAttributes();
$vwsumpcs_code_list->renderRow();
?>
<?php if ($vwsumpcs_code_list->TotalRecs > 0 && !$vwsumpcs_code->isGridAdd() && !$vwsumpcs_code->isGridEdit()) { ?>
<tfoot><!-- Table footer -->
	<tr class="ew-table-footer">
<?php

// Render list options
$vwsumpcs_code_list->renderListOptions();

// Render list options (footer, left)
$vwsumpcs_code_list->ListOptions->render("footer", "left");
?>
	<?php if ($vwsumpcs_code->TypeName->Visible) { // TypeName ?>
		<td data-name="TypeName" class="<?php echo $vwsumpcs_code->TypeName->footerCellClass() ?>"><span id="elf_vwsumpcs_code_TypeName" class="vwsumpcs_code_TypeName">
		&nbsp;
		</span></td>
	<?php } ?>
	<?php if ($vwsumpcs_code->Code->Visible) { // Code ?>
		<td data-name="Code" class="<?php echo $vwsumpcs_code->Code->footerCellClass() ?>"><span id="elf_vwsumpcs_code_Code" class="vwsumpcs_code_Code">
		&nbsp;
		</span></td>
	<?php } ?>
	<?php if ($vwsumpcs_code->ProductName->Visible) { // ProductName ?>
		<td data-name="ProductName" class="<?php echo $vwsumpcs_code->ProductName->footerCellClass() ?>"><span id="elf_vwsumpcs_code_ProductName" class="vwsumpcs_code_ProductName">
		&nbsp;
		</span></td>
	<?php } ?>
	<?php if ($vwsumpcs_code->Model->Visible) { // Model ?>
		<td data-name="Model" class="<?php echo $vwsumpcs_code->Model->footerCellClass() ?>"><span id="elf_vwsumpcs_code_Model" class="vwsumpcs_code_Model">
		&nbsp;
		</span></td>
	<?php } ?>
	<?php if ($vwsumpcs_code->SUM28ts_PCS29->Visible) { // SUM(ts.PCS) ?>
		<td data-name="SUM28ts_PCS29" class="<?php echo $vwsumpcs_code->SUM28ts_PCS29->footerCellClass() ?>"><span id="elf_vwsumpcs_code_SUM28ts_PCS29" class="vwsumpcs_code_SUM28ts_PCS29">
		<span class="ew-aggregate"><?php echo $Language->phrase("TOTAL") ?></span><span class="ew-aggregate-value">
		<?php echo $vwsumpcs_code->SUM28ts_PCS29->ViewValue ?></span>
		</span></td>
	<?php } ?>
	<?php if ($vwsumpcs_code->Pallet->Visible) { // Pallet ?>
		<td data-name="Pallet" class="<?php echo $vwsumpcs_code->Pallet->footerCellClass() ?>"><span id="elf_vwsumpcs_code_Pallet" class="vwsumpcs_code_Pallet">
		&nbsp;
		</span></td>
	<?php } ?>
<?php

// Render list options (footer, right)
$vwsumpcs_code_list->ListOptions->render("footer", "right");
?>
	</tr>
</tfoot>
<?php } ?>
</table><!-- /.ew-table -->
<?php } ?>
<?php if (!$vwsumpcs_code->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</div><!-- /.ew-grid-middle-panel -->
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($vwsumpcs_code_list->Recordset)
	$vwsumpcs_code_list->Recordset->Close();
?>
<?php if (!$vwsumpcs_code->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$vwsumpcs_code->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php if (!isset($vwsumpcs_code_list->Pager)) $vwsumpcs_code_list->Pager = new PrevNextPager($vwsumpcs_code_list->StartRec, $vwsumpcs_code_list->DisplayRecs, $vwsumpcs_code_list->TotalRecs, $vwsumpcs_code_list->AutoHidePager) ?>
<?php if ($vwsumpcs_code_list->Pager->RecordCount > 0 && $vwsumpcs_code_list->Pager->Visible) { ?>
<div class="ew-pager">
<span><?php echo $Language->Phrase("Page") ?>&nbsp;</span>
<div class="ew-prev-next"><div class="input-group input-group-sm">
<div class="input-group-prepend">
<!-- first page button -->
	<?php if ($vwsumpcs_code_list->Pager->FirstButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerFirst") ?>" href="<?php echo $vwsumpcs_code_list->pageUrl() ?>start=<?php echo $vwsumpcs_code_list->Pager->FirstButton->Start ?>"><i class="icon-first ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerFirst") ?>"><i class="icon-first ew-icon"></i></a>
	<?php } ?>
<!-- previous page button -->
	<?php if ($vwsumpcs_code_list->Pager->PrevButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerPrevious") ?>" href="<?php echo $vwsumpcs_code_list->pageUrl() ?>start=<?php echo $vwsumpcs_code_list->Pager->PrevButton->Start ?>"><i class="icon-prev ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerPrevious") ?>"><i class="icon-prev ew-icon"></i></a>
	<?php } ?>
</div>
<!-- current page number -->
	<input class="form-control" type="text" name="<?php echo TABLE_PAGE_NO ?>" value="<?php echo $vwsumpcs_code_list->Pager->CurrentPage ?>">
<div class="input-group-append">
<!-- next page button -->
	<?php if ($vwsumpcs_code_list->Pager->NextButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerNext") ?>" href="<?php echo $vwsumpcs_code_list->pageUrl() ?>start=<?php echo $vwsumpcs_code_list->Pager->NextButton->Start ?>"><i class="icon-next ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerNext") ?>"><i class="icon-next ew-icon"></i></a>
	<?php } ?>
<!-- last page button -->
	<?php if ($vwsumpcs_code_list->Pager->LastButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerLast") ?>" href="<?php echo $vwsumpcs_code_list->pageUrl() ?>start=<?php echo $vwsumpcs_code_list->Pager->LastButton->Start ?>"><i class="icon-last ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerLast") ?>"><i class="icon-last ew-icon"></i></a>
	<?php } ?>
</div>
</div>
</div>
<span>&nbsp;<?php echo $Language->Phrase("of") ?>&nbsp;<?php echo $vwsumpcs_code_list->Pager->PageCount ?></span>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php if ($vwsumpcs_code_list->Pager->RecordCount > 0) { ?>
<div class="ew-pager ew-rec">
	<span><?php echo $Language->Phrase("Record") ?>&nbsp;<?php echo $vwsumpcs_code_list->Pager->FromIndex ?>&nbsp;<?php echo $Language->Phrase("To") ?>&nbsp;<?php echo $vwsumpcs_code_list->Pager->ToIndex ?>&nbsp;<?php echo $Language->Phrase("Of") ?>&nbsp;<?php echo $vwsumpcs_code_list->Pager->RecordCount ?></span>
</div>
<?php } ?>
<?php if ($vwsumpcs_code_list->TotalRecs > 0 && (!$vwsumpcs_code_list->AutoHidePageSizeSelector || $vwsumpcs_code_list->Pager->Visible)) { ?>
<div class="ew-pager">
<input type="hidden" name="t" value="vwsumpcs_code">
<select name="<?php echo TABLE_REC_PER_PAGE ?>" class="form-control form-control-sm ew-tooltip" title="<?php echo $Language->phrase("RecordsPerPage") ?>" onchange="this.form.submit();">
<option value="20"<?php if ($vwsumpcs_code_list->DisplayRecs == 20) { ?> selected<?php } ?>>20</option>
<option value="50"<?php if ($vwsumpcs_code_list->DisplayRecs == 50) { ?> selected<?php } ?>>50</option>
<option value="100"<?php if ($vwsumpcs_code_list->DisplayRecs == 100) { ?> selected<?php } ?>>100</option>
<option value="200"<?php if ($vwsumpcs_code_list->DisplayRecs == 200) { ?> selected<?php } ?>>200</option>
<option value="500"<?php if ($vwsumpcs_code_list->DisplayRecs == 500) { ?> selected<?php } ?>>500</option>
<option value="ALL"<?php if ($vwsumpcs_code->getRecordsPerPage() == -1) { ?> selected<?php } ?>><?php echo $Language->Phrase("AllRecords") ?></option>
</select>
</div>
<?php } ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $vwsumpcs_code_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($vwsumpcs_code_list->TotalRecs == 0 && !$vwsumpcs_code->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $vwsumpcs_code_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$vwsumpcs_code_list->showPageFooter();
if (DEBUG_ENABLED)
	echo GetDebugMessage();
?>
<?php if (!$vwsumpcs_code->isExport()) { ?>
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
		window.location="rpt_Sumbycode.php?id="+x.substring(0,x.length-1);
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
		window.location="rpt_Sumbycode.php?id="+x.substring(0,x.length-1);
	});
// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php } ?>
<?php include_once "footer.php" ?>
<?php
$vwsumpcs_code_list->terminate();
?>