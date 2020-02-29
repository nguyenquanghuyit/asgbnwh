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
$vwinventory_list = new vwinventory_list();

// Run the page
$vwinventory_list->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$vwinventory_list->Page_Render();
?>
<?php include_once "header.php" ?>
<?php if (!$vwinventory->isExport()) { ?>
<script>

// Form object
currentPageID = ew.PAGE_ID = "list";
var fvwinventorylist = currentForm = new ew.Form("fvwinventorylist", "list");
fvwinventorylist.formKeyCountName = '<?php echo $vwinventory_list->FormKeyCountName ?>';

// Form_CustomValidate event
fvwinventorylist.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

	// Your custom validation code here, return false if invalid.
	return true;
}

// Use JavaScript validation or not
fvwinventorylist.validateRequired = <?php echo json_encode(CLIENT_VALIDATE) ?>;

// Dynamic selection lists
fvwinventorylist.lists["x_TypeName"] = <?php echo $vwinventory_list->TypeName->Lookup->toClientList() ?>;
fvwinventorylist.lists["x_TypeName"].options = <?php echo JsonEncode($vwinventory_list->TypeName->lookupOptions()) ?>;

// Form object for search
var fvwinventorylistsrch = currentSearchForm = new ew.Form("fvwinventorylistsrch");

// Validate function for search
fvwinventorylistsrch.validate = function(fobj) {
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
fvwinventorylistsrch.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

	// Your custom validation code here, return false if invalid.
	return true;
}

// Use JavaScript validation or not
fvwinventorylistsrch.validateRequired = <?php echo json_encode(CLIENT_VALIDATE) ?>;

// Dynamic selection lists
fvwinventorylistsrch.lists["x_TypeName"] = <?php echo $vwinventory_list->TypeName->Lookup->toClientList() ?>;
fvwinventorylistsrch.lists["x_TypeName"].options = <?php echo JsonEncode($vwinventory_list->TypeName->lookupOptions()) ?>;

// Filters
fvwinventorylistsrch.filterList = <?php echo $vwinventory_list->getFilterList() ?>;
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
<?php if (!$vwinventory->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($vwinventory_list->TotalRecs > 0 && $vwinventory_list->ExportOptions->visible()) { ?>
<?php $vwinventory_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($vwinventory_list->ImportOptions->visible()) { ?>
<?php $vwinventory_list->ImportOptions->render("body") ?>
<?php } ?>
<?php if ($vwinventory_list->SearchOptions->visible()) { ?>
<?php $vwinventory_list->SearchOptions->render("body") ?>
<?php } ?>
<?php if ($vwinventory_list->FilterOptions->visible()) { ?>
<?php $vwinventory_list->FilterOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php
$vwinventory_list->renderOtherOptions();
?>
<?php if ($Security->CanSearch()) { ?>
<?php if (!$vwinventory->isExport() && !$vwinventory->CurrentAction) { ?>
<form name="fvwinventorylistsrch" id="fvwinventorylistsrch" class="form-inline ew-form ew-ext-search-form" action="<?php echo CurrentPageName() ?>">
<?php $searchPanelClass = ($vwinventory_list->SearchWhere <> "") ? " show" : " show"; ?>
<div id="fvwinventorylistsrch-search-panel" class="ew-search-panel collapse<?php echo $searchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="vwinventory">
	<div class="ew-basic-search">
<?php
if ($SearchError == "")
	$vwinventory_list->LoadAdvancedSearch(); // Load advanced search

// Render for search
$vwinventory->RowType = ROWTYPE_SEARCH;

// Render row
$vwinventory->resetAttributes();
$vwinventory_list->renderRow();
?>
<div id="xsr_1" class="ew-row d-sm-flex">
<?php if ($vwinventory->TypeName->Visible) { // TypeName ?>
	<div id="xsc_TypeName" class="ew-cell form-group">
		<label for="x_TypeName" class="ew-search-caption ew-label"><?php echo $vwinventory->TypeName->caption() ?></label>
		<span class="ew-search-operator"><?php echo $Language->phrase("LIKE") ?><input type="hidden" name="z_TypeName" id="z_TypeName" value="LIKE"></span>
		<span class="ew-search-field">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="vwinventory" data-field="x_TypeName" data-value-separator="<?php echo $vwinventory->TypeName->displayValueSeparatorAttribute() ?>" id="x_TypeName" name="x_TypeName"<?php echo $vwinventory->TypeName->editAttributes() ?>>
		<?php echo $vwinventory->TypeName->selectOptionListHtml("x_TypeName") ?>
	</select>
</div>
<?php echo $vwinventory->TypeName->Lookup->getParamTag("p_x_TypeName") ?>
</span>
	</div>
<?php } ?>
</div>
<div id="xsr_2" class="ew-row d-sm-flex">
<?php if ($vwinventory->Code->Visible) { // Code ?>
	<div id="xsc_Code" class="ew-cell form-group">
		<label for="x_Code" class="ew-search-caption ew-label"><?php echo $vwinventory->Code->caption() ?></label>
		<span class="ew-search-operator"><?php echo $Language->phrase("LIKE") ?><input type="hidden" name="z_Code" id="z_Code" value="LIKE"></span>
		<span class="ew-search-field">
<input type="text" data-table="vwinventory" data-field="x_Code" name="x_Code" id="x_Code" size="30" maxlength="50" placeholder="<?php echo HtmlEncode($vwinventory->Code->getPlaceHolder()) ?>" value="<?php echo $vwinventory->Code->EditValue ?>"<?php echo $vwinventory->Code->editAttributes() ?>>
</span>
	</div>
<?php } ?>
</div>
<div id="xsr_3" class="ew-row d-sm-flex">
	<div class="ew-quick-search input-group">
		<input type="text" name="<?php echo TABLE_BASIC_SEARCH ?>" id="<?php echo TABLE_BASIC_SEARCH ?>" class="form-control" value="<?php echo HtmlEncode($vwinventory_list->BasicSearch->getKeyword()) ?>" placeholder="<?php echo HtmlEncode($Language->phrase("Search")) ?>">
		<input type="hidden" name="<?php echo TABLE_BASIC_SEARCH_TYPE ?>" id="<?php echo TABLE_BASIC_SEARCH_TYPE ?>" value="<?php echo HtmlEncode($vwinventory_list->BasicSearch->getType()) ?>">
		<div class="input-group-append">
			<button class="btn btn-primary" name="btn-submit" id="btn-submit" type="submit"><?php echo $Language->phrase("SearchBtn") ?></button>
			<button type="button" data-toggle="dropdown" class="btn btn-primary dropdown-toggle dropdown-toggle-split" aria-haspopup="true" aria-expanded="false"><span id="searchtype"><?php echo $vwinventory_list->BasicSearch->getTypeNameShort() ?></span></button>
			<div class="dropdown-menu dropdown-menu-right">
				<a class="dropdown-item<?php if ($vwinventory_list->BasicSearch->getType() == "") echo " active"; ?>" href="javascript:void(0);" onclick="ew.setSearchType(this)"><?php echo $Language->phrase("QuickSearchAuto") ?></a>
				<a class="dropdown-item<?php if ($vwinventory_list->BasicSearch->getType() == "=") echo " active"; ?>" href="javascript:void(0);" onclick="ew.setSearchType(this,'=')"><?php echo $Language->phrase("QuickSearchExact") ?></a>
				<a class="dropdown-item<?php if ($vwinventory_list->BasicSearch->getType() == "AND") echo " active"; ?>" href="javascript:void(0);" onclick="ew.setSearchType(this,'AND')"><?php echo $Language->phrase("QuickSearchAll") ?></a>
				<a class="dropdown-item<?php if ($vwinventory_list->BasicSearch->getType() == "OR") echo " active"; ?>" href="javascript:void(0);" onclick="ew.setSearchType(this,'OR')"><?php echo $Language->phrase("QuickSearchAny") ?></a>
			</div>
		</div>
	</div>
</div>
	</div>
</div>
</form>
<?php } ?>
<?php } ?>
<?php $vwinventory_list->showPageHeader(); ?>
<?php
$vwinventory_list->showMessage();
?>
<?php if ($vwinventory_list->TotalRecs > 0 || $vwinventory->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($vwinventory_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> vwinventory">
<?php if (!$vwinventory->isExport()) { ?>
<div class="card-header ew-grid-upper-panel">
<?php if (!$vwinventory->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php if (!isset($vwinventory_list->Pager)) $vwinventory_list->Pager = new PrevNextPager($vwinventory_list->StartRec, $vwinventory_list->DisplayRecs, $vwinventory_list->TotalRecs, $vwinventory_list->AutoHidePager) ?>
<?php if ($vwinventory_list->Pager->RecordCount > 0 && $vwinventory_list->Pager->Visible) { ?>
<div class="ew-pager">
<span><?php echo $Language->Phrase("Page") ?>&nbsp;</span>
<div class="ew-prev-next"><div class="input-group input-group-sm">
<div class="input-group-prepend">
<!-- first page button -->
	<?php if ($vwinventory_list->Pager->FirstButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerFirst") ?>" href="<?php echo $vwinventory_list->pageUrl() ?>start=<?php echo $vwinventory_list->Pager->FirstButton->Start ?>"><i class="icon-first ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerFirst") ?>"><i class="icon-first ew-icon"></i></a>
	<?php } ?>
<!-- previous page button -->
	<?php if ($vwinventory_list->Pager->PrevButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerPrevious") ?>" href="<?php echo $vwinventory_list->pageUrl() ?>start=<?php echo $vwinventory_list->Pager->PrevButton->Start ?>"><i class="icon-prev ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerPrevious") ?>"><i class="icon-prev ew-icon"></i></a>
	<?php } ?>
</div>
<!-- current page number -->
	<input class="form-control" type="text" name="<?php echo TABLE_PAGE_NO ?>" value="<?php echo $vwinventory_list->Pager->CurrentPage ?>">
<div class="input-group-append">
<!-- next page button -->
	<?php if ($vwinventory_list->Pager->NextButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerNext") ?>" href="<?php echo $vwinventory_list->pageUrl() ?>start=<?php echo $vwinventory_list->Pager->NextButton->Start ?>"><i class="icon-next ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerNext") ?>"><i class="icon-next ew-icon"></i></a>
	<?php } ?>
<!-- last page button -->
	<?php if ($vwinventory_list->Pager->LastButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerLast") ?>" href="<?php echo $vwinventory_list->pageUrl() ?>start=<?php echo $vwinventory_list->Pager->LastButton->Start ?>"><i class="icon-last ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerLast") ?>"><i class="icon-last ew-icon"></i></a>
	<?php } ?>
</div>
</div>
</div>
<span>&nbsp;<?php echo $Language->Phrase("of") ?>&nbsp;<?php echo $vwinventory_list->Pager->PageCount ?></span>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php if ($vwinventory_list->Pager->RecordCount > 0) { ?>
<div class="ew-pager ew-rec">
	<span><?php echo $Language->Phrase("Record") ?>&nbsp;<?php echo $vwinventory_list->Pager->FromIndex ?>&nbsp;<?php echo $Language->Phrase("To") ?>&nbsp;<?php echo $vwinventory_list->Pager->ToIndex ?>&nbsp;<?php echo $Language->Phrase("Of") ?>&nbsp;<?php echo $vwinventory_list->Pager->RecordCount ?></span>
</div>
<?php } ?>
<?php if ($vwinventory_list->TotalRecs > 0 && (!$vwinventory_list->AutoHidePageSizeSelector || $vwinventory_list->Pager->Visible)) { ?>
<div class="ew-pager">
<input type="hidden" name="t" value="vwinventory">
<select name="<?php echo TABLE_REC_PER_PAGE ?>" class="form-control form-control-sm ew-tooltip" title="<?php echo $Language->phrase("RecordsPerPage") ?>" onchange="this.form.submit();">
<option value="20"<?php if ($vwinventory_list->DisplayRecs == 20) { ?> selected<?php } ?>>20</option>
<option value="50"<?php if ($vwinventory_list->DisplayRecs == 50) { ?> selected<?php } ?>>50</option>
<option value="100"<?php if ($vwinventory_list->DisplayRecs == 100) { ?> selected<?php } ?>>100</option>
<option value="200"<?php if ($vwinventory_list->DisplayRecs == 200) { ?> selected<?php } ?>>200</option>
<option value="500"<?php if ($vwinventory_list->DisplayRecs == 500) { ?> selected<?php } ?>>500</option>
<option value="ALL"<?php if ($vwinventory->getRecordsPerPage() == -1) { ?> selected<?php } ?>><?php echo $Language->Phrase("AllRecords") ?></option>
</select>
</div>
<?php } ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $vwinventory_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
<form name="fvwinventorylist" id="fvwinventorylist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($vwinventory_list->CheckToken) { ?>
<input type="hidden" name="<?php echo TOKEN_NAME ?>" value="<?php echo $vwinventory_list->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="vwinventory">
<input type="hidden" name="exporttype" id="exporttype" value="">
<div id="gmp_vwinventory" class="<?php if (IsResponsiveLayout()) { ?>table-responsive <?php } ?>card-body ew-grid-middle-panel">
<?php if ($vwinventory_list->TotalRecs > 0 || $vwinventory->isGridEdit()) { ?>
<table id="tbl_vwinventorylist" class="table ew-table"><!-- .ew-table ##-->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$vwinventory_list->RowType = ROWTYPE_HEADER;

// Render list options
$vwinventory_list->renderListOptions();

// Render list options (header, left)
$vwinventory_list->ListOptions->render("header", "left");
?>
<?php if ($vwinventory->TypeName->Visible) { // TypeName ?>
	<?php if ($vwinventory->sortUrl($vwinventory->TypeName) == "") { ?>
		<th data-name="TypeName" class="<?php echo $vwinventory->TypeName->headerCellClass() ?>" style="white-space: nowrap;"><div id="elh_vwinventory_TypeName" class="vwinventory_TypeName"><div class="ew-table-header-caption"><?php echo $vwinventory->TypeName->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="TypeName" class="<?php echo $vwinventory->TypeName->headerCellClass() ?>" style="white-space: nowrap;"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $vwinventory->SortUrl($vwinventory->TypeName) ?>',2);"><div id="elh_vwinventory_TypeName" class="vwinventory_TypeName">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $vwinventory->TypeName->caption() ?></span><span class="ew-table-header-sort"><?php if ($vwinventory->TypeName->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($vwinventory->TypeName->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($vwinventory->Code->Visible) { // Code ?>
	<?php if ($vwinventory->sortUrl($vwinventory->Code) == "") { ?>
		<th data-name="Code" class="<?php echo $vwinventory->Code->headerCellClass() ?>" style="white-space: nowrap;"><div id="elh_vwinventory_Code" class="vwinventory_Code"><div class="ew-table-header-caption"><?php echo $vwinventory->Code->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Code" class="<?php echo $vwinventory->Code->headerCellClass() ?>" style="white-space: nowrap;"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $vwinventory->SortUrl($vwinventory->Code) ?>',2);"><div id="elh_vwinventory_Code" class="vwinventory_Code">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $vwinventory->Code->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($vwinventory->Code->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($vwinventory->Code->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($vwinventory->ProductName->Visible) { // ProductName ?>
	<?php if ($vwinventory->sortUrl($vwinventory->ProductName) == "") { ?>
		<th data-name="ProductName" class="<?php echo $vwinventory->ProductName->headerCellClass() ?>" style="white-space: nowrap;"><div id="elh_vwinventory_ProductName" class="vwinventory_ProductName"><div class="ew-table-header-caption"><?php echo $vwinventory->ProductName->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="ProductName" class="<?php echo $vwinventory->ProductName->headerCellClass() ?>" style="white-space: nowrap;"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $vwinventory->SortUrl($vwinventory->ProductName) ?>',2);"><div id="elh_vwinventory_ProductName" class="vwinventory_ProductName">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $vwinventory->ProductName->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($vwinventory->ProductName->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($vwinventory->ProductName->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($vwinventory->VnName->Visible) { // VnName ?>
	<?php if ($vwinventory->sortUrl($vwinventory->VnName) == "") { ?>
		<th data-name="VnName" class="<?php echo $vwinventory->VnName->headerCellClass() ?>" style="white-space: nowrap;"><div id="elh_vwinventory_VnName" class="vwinventory_VnName"><div class="ew-table-header-caption"><?php echo $vwinventory->VnName->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="VnName" class="<?php echo $vwinventory->VnName->headerCellClass() ?>" style="white-space: nowrap;"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $vwinventory->SortUrl($vwinventory->VnName) ?>',2);"><div id="elh_vwinventory_VnName" class="vwinventory_VnName">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $vwinventory->VnName->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($vwinventory->VnName->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($vwinventory->VnName->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($vwinventory->Model->Visible) { // Model ?>
	<?php if ($vwinventory->sortUrl($vwinventory->Model) == "") { ?>
		<th data-name="Model" class="<?php echo $vwinventory->Model->headerCellClass() ?>" style="white-space: nowrap;"><div id="elh_vwinventory_Model" class="vwinventory_Model"><div class="ew-table-header-caption"><?php echo $vwinventory->Model->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Model" class="<?php echo $vwinventory->Model->headerCellClass() ?>" style="white-space: nowrap;"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $vwinventory->SortUrl($vwinventory->Model) ?>',2);"><div id="elh_vwinventory_Model" class="vwinventory_Model">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $vwinventory->Model->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($vwinventory->Model->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($vwinventory->Model->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($vwinventory->PCS_IN->Visible) { // PCS_IN ?>
	<?php if ($vwinventory->sortUrl($vwinventory->PCS_IN) == "") { ?>
		<th data-name="PCS_IN" class="<?php echo $vwinventory->PCS_IN->headerCellClass() ?>" style="white-space: nowrap;"><div id="elh_vwinventory_PCS_IN" class="vwinventory_PCS_IN"><div class="ew-table-header-caption"><?php echo $vwinventory->PCS_IN->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="PCS_IN" class="<?php echo $vwinventory->PCS_IN->headerCellClass() ?>" style="white-space: nowrap;"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $vwinventory->SortUrl($vwinventory->PCS_IN) ?>',2);"><div id="elh_vwinventory_PCS_IN" class="vwinventory_PCS_IN">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $vwinventory->PCS_IN->caption() ?></span><span class="ew-table-header-sort"><?php if ($vwinventory->PCS_IN->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($vwinventory->PCS_IN->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($vwinventory->PCS_OUT->Visible) { // PCS_OUT ?>
	<?php if ($vwinventory->sortUrl($vwinventory->PCS_OUT) == "") { ?>
		<th data-name="PCS_OUT" class="<?php echo $vwinventory->PCS_OUT->headerCellClass() ?>" style="white-space: nowrap;"><div id="elh_vwinventory_PCS_OUT" class="vwinventory_PCS_OUT"><div class="ew-table-header-caption"><?php echo $vwinventory->PCS_OUT->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="PCS_OUT" class="<?php echo $vwinventory->PCS_OUT->headerCellClass() ?>" style="white-space: nowrap;"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $vwinventory->SortUrl($vwinventory->PCS_OUT) ?>',2);"><div id="elh_vwinventory_PCS_OUT" class="vwinventory_PCS_OUT">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $vwinventory->PCS_OUT->caption() ?></span><span class="ew-table-header-sort"><?php if ($vwinventory->PCS_OUT->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($vwinventory->PCS_OUT->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($vwinventory->PCS->Visible) { // PCS ?>
	<?php if ($vwinventory->sortUrl($vwinventory->PCS) == "") { ?>
		<th data-name="PCS" class="<?php echo $vwinventory->PCS->headerCellClass() ?>" style="white-space: nowrap;"><div id="elh_vwinventory_PCS" class="vwinventory_PCS"><div class="ew-table-header-caption"><?php echo $vwinventory->PCS->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="PCS" class="<?php echo $vwinventory->PCS->headerCellClass() ?>" style="white-space: nowrap;"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $vwinventory->SortUrl($vwinventory->PCS) ?>',2);"><div id="elh_vwinventory_PCS" class="vwinventory_PCS">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $vwinventory->PCS->caption() ?></span><span class="ew-table-header-sort"><?php if ($vwinventory->PCS->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($vwinventory->PCS->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$vwinventory_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
if ($vwinventory->ExportAll && $vwinventory->isExport()) {
	$vwinventory_list->StopRec = $vwinventory_list->TotalRecs;
} else {

	// Set the last record to display
	if ($vwinventory_list->TotalRecs > $vwinventory_list->StartRec + $vwinventory_list->DisplayRecs - 1)
		$vwinventory_list->StopRec = $vwinventory_list->StartRec + $vwinventory_list->DisplayRecs - 1;
	else
		$vwinventory_list->StopRec = $vwinventory_list->TotalRecs;
}
$vwinventory_list->RecCnt = $vwinventory_list->StartRec - 1;
if ($vwinventory_list->Recordset && !$vwinventory_list->Recordset->EOF) {
	$vwinventory_list->Recordset->moveFirst();
	$selectLimit = $vwinventory_list->UseSelectLimit;
	if (!$selectLimit && $vwinventory_list->StartRec > 1)
		$vwinventory_list->Recordset->move($vwinventory_list->StartRec - 1);
} elseif (!$vwinventory->AllowAddDeleteRow && $vwinventory_list->StopRec == 0) {
	$vwinventory_list->StopRec = $vwinventory->GridAddRowCount;
}

// Initialize aggregate
$vwinventory->RowType = ROWTYPE_AGGREGATEINIT;
$vwinventory->resetAttributes();
$vwinventory_list->renderRow();
while ($vwinventory_list->RecCnt < $vwinventory_list->StopRec) {
	$vwinventory_list->RecCnt++;
	if ($vwinventory_list->RecCnt >= $vwinventory_list->StartRec) {
		$vwinventory_list->RowCnt++;

		// Set up key count
		$vwinventory_list->KeyCount = $vwinventory_list->RowIndex;

		// Init row class and style
		$vwinventory->resetAttributes();
		$vwinventory->CssClass = "";
		if ($vwinventory->isGridAdd()) {
		} else {
			$vwinventory_list->loadRowValues($vwinventory_list->Recordset); // Load row values
		}
		$vwinventory->RowType = ROWTYPE_VIEW; // Render view

		// Set up row id / data-rowindex
		$vwinventory->RowAttrs = array_merge($vwinventory->RowAttrs, array('data-rowindex'=>$vwinventory_list->RowCnt, 'id'=>'r' . $vwinventory_list->RowCnt . '_vwinventory', 'data-rowtype'=>$vwinventory->RowType));

		// Render row
		$vwinventory_list->renderRow();

		// Render list options
		$vwinventory_list->renderListOptions();
?>
	<tr<?php echo $vwinventory->rowAttributes() ?>>
<?php

// Render list options (body, left)
$vwinventory_list->ListOptions->render("body", "left", $vwinventory_list->RowCnt);
?>
	<?php if ($vwinventory->TypeName->Visible) { // TypeName ?>
		<td data-name="TypeName"<?php echo $vwinventory->TypeName->cellAttributes() ?>>
<span id="el<?php echo $vwinventory_list->RowCnt ?>_vwinventory_TypeName" class="vwinventory_TypeName">
<span<?php echo $vwinventory->TypeName->viewAttributes() ?>>
<?php echo $vwinventory->TypeName->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($vwinventory->Code->Visible) { // Code ?>
		<td data-name="Code"<?php echo $vwinventory->Code->cellAttributes() ?>>
<span id="el<?php echo $vwinventory_list->RowCnt ?>_vwinventory_Code" class="vwinventory_Code">
<span<?php echo $vwinventory->Code->viewAttributes() ?>>
<?php echo $vwinventory->Code->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($vwinventory->ProductName->Visible) { // ProductName ?>
		<td data-name="ProductName"<?php echo $vwinventory->ProductName->cellAttributes() ?>>
<span id="el<?php echo $vwinventory_list->RowCnt ?>_vwinventory_ProductName" class="vwinventory_ProductName">
<span<?php echo $vwinventory->ProductName->viewAttributes() ?>>
<?php echo $vwinventory->ProductName->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($vwinventory->VnName->Visible) { // VnName ?>
		<td data-name="VnName"<?php echo $vwinventory->VnName->cellAttributes() ?>>
<span id="el<?php echo $vwinventory_list->RowCnt ?>_vwinventory_VnName" class="vwinventory_VnName">
<span<?php echo $vwinventory->VnName->viewAttributes() ?>>
<?php echo $vwinventory->VnName->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($vwinventory->Model->Visible) { // Model ?>
		<td data-name="Model"<?php echo $vwinventory->Model->cellAttributes() ?>>
<span id="el<?php echo $vwinventory_list->RowCnt ?>_vwinventory_Model" class="vwinventory_Model">
<span<?php echo $vwinventory->Model->viewAttributes() ?>>
<?php echo $vwinventory->Model->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($vwinventory->PCS_IN->Visible) { // PCS_IN ?>
		<td data-name="PCS_IN"<?php echo $vwinventory->PCS_IN->cellAttributes() ?>>
<span id="el<?php echo $vwinventory_list->RowCnt ?>_vwinventory_PCS_IN" class="vwinventory_PCS_IN">
<span<?php echo $vwinventory->PCS_IN->viewAttributes() ?>>
<?php echo $vwinventory->PCS_IN->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($vwinventory->PCS_OUT->Visible) { // PCS_OUT ?>
		<td data-name="PCS_OUT"<?php echo $vwinventory->PCS_OUT->cellAttributes() ?>>
<span id="el<?php echo $vwinventory_list->RowCnt ?>_vwinventory_PCS_OUT" class="vwinventory_PCS_OUT">
<span<?php echo $vwinventory->PCS_OUT->viewAttributes() ?>>
<?php echo $vwinventory->PCS_OUT->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($vwinventory->PCS->Visible) { // PCS ?>
		<td data-name="PCS"<?php echo $vwinventory->PCS->cellAttributes() ?>>
<span id="el<?php echo $vwinventory_list->RowCnt ?>_vwinventory_PCS" class="vwinventory_PCS">
<span<?php echo $vwinventory->PCS->viewAttributes() ?>>
<?php echo $vwinventory->PCS->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$vwinventory_list->ListOptions->render("body", "right", $vwinventory_list->RowCnt);
?>
	</tr>
<?php
	}
	if (!$vwinventory->isGridAdd())
		$vwinventory_list->Recordset->moveNext();
}
?>
</tbody>
<?php

// Render aggregate row
$vwinventory->RowType = ROWTYPE_AGGREGATE;
$vwinventory->resetAttributes();
$vwinventory_list->renderRow();
?>
<?php if ($vwinventory_list->TotalRecs > 0 && !$vwinventory->isGridAdd() && !$vwinventory->isGridEdit()) { ?>
<tfoot><!-- Table footer -->
	<tr class="ew-table-footer">
<?php

// Render list options
$vwinventory_list->renderListOptions();

// Render list options (footer, left)
$vwinventory_list->ListOptions->render("footer", "left");
?>
	<?php if ($vwinventory->TypeName->Visible) { // TypeName ?>
		<td data-name="TypeName" class="<?php echo $vwinventory->TypeName->footerCellClass() ?>"><span id="elf_vwinventory_TypeName" class="vwinventory_TypeName">
		&nbsp;
		</span></td>
	<?php } ?>
	<?php if ($vwinventory->Code->Visible) { // Code ?>
		<td data-name="Code" class="<?php echo $vwinventory->Code->footerCellClass() ?>"><span id="elf_vwinventory_Code" class="vwinventory_Code">
		&nbsp;
		</span></td>
	<?php } ?>
	<?php if ($vwinventory->ProductName->Visible) { // ProductName ?>
		<td data-name="ProductName" class="<?php echo $vwinventory->ProductName->footerCellClass() ?>"><span id="elf_vwinventory_ProductName" class="vwinventory_ProductName">
		&nbsp;
		</span></td>
	<?php } ?>
	<?php if ($vwinventory->VnName->Visible) { // VnName ?>
		<td data-name="VnName" class="<?php echo $vwinventory->VnName->footerCellClass() ?>"><span id="elf_vwinventory_VnName" class="vwinventory_VnName">
		&nbsp;
		</span></td>
	<?php } ?>
	<?php if ($vwinventory->Model->Visible) { // Model ?>
		<td data-name="Model" class="<?php echo $vwinventory->Model->footerCellClass() ?>"><span id="elf_vwinventory_Model" class="vwinventory_Model">
		&nbsp;
		</span></td>
	<?php } ?>
	<?php if ($vwinventory->PCS_IN->Visible) { // PCS_IN ?>
		<td data-name="PCS_IN" class="<?php echo $vwinventory->PCS_IN->footerCellClass() ?>"><span id="elf_vwinventory_PCS_IN" class="vwinventory_PCS_IN">
		<span class="ew-aggregate"><?php echo $Language->phrase("TOTAL") ?></span><span class="ew-aggregate-value">
		<?php echo $vwinventory->PCS_IN->ViewValue ?></span>
		</span></td>
	<?php } ?>
	<?php if ($vwinventory->PCS_OUT->Visible) { // PCS_OUT ?>
		<td data-name="PCS_OUT" class="<?php echo $vwinventory->PCS_OUT->footerCellClass() ?>"><span id="elf_vwinventory_PCS_OUT" class="vwinventory_PCS_OUT">
		<span class="ew-aggregate"><?php echo $Language->phrase("TOTAL") ?></span><span class="ew-aggregate-value">
		<?php echo $vwinventory->PCS_OUT->ViewValue ?></span>
		</span></td>
	<?php } ?>
	<?php if ($vwinventory->PCS->Visible) { // PCS ?>
		<td data-name="PCS" class="<?php echo $vwinventory->PCS->footerCellClass() ?>"><span id="elf_vwinventory_PCS" class="vwinventory_PCS">
		<span class="ew-aggregate"><?php echo $Language->phrase("TOTAL") ?></span><span class="ew-aggregate-value">
		<?php echo $vwinventory->PCS->ViewValue ?></span>
		</span></td>
	<?php } ?>
<?php

// Render list options (footer, right)
$vwinventory_list->ListOptions->render("footer", "right");
?>
	</tr>
</tfoot>
<?php } ?>
</table><!-- /.ew-table -->
<?php } ?>
<?php if (!$vwinventory->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</div><!-- /.ew-grid-middle-panel -->
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($vwinventory_list->Recordset)
	$vwinventory_list->Recordset->Close();
?>
<?php if (!$vwinventory->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$vwinventory->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php if (!isset($vwinventory_list->Pager)) $vwinventory_list->Pager = new PrevNextPager($vwinventory_list->StartRec, $vwinventory_list->DisplayRecs, $vwinventory_list->TotalRecs, $vwinventory_list->AutoHidePager) ?>
<?php if ($vwinventory_list->Pager->RecordCount > 0 && $vwinventory_list->Pager->Visible) { ?>
<div class="ew-pager">
<span><?php echo $Language->Phrase("Page") ?>&nbsp;</span>
<div class="ew-prev-next"><div class="input-group input-group-sm">
<div class="input-group-prepend">
<!-- first page button -->
	<?php if ($vwinventory_list->Pager->FirstButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerFirst") ?>" href="<?php echo $vwinventory_list->pageUrl() ?>start=<?php echo $vwinventory_list->Pager->FirstButton->Start ?>"><i class="icon-first ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerFirst") ?>"><i class="icon-first ew-icon"></i></a>
	<?php } ?>
<!-- previous page button -->
	<?php if ($vwinventory_list->Pager->PrevButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerPrevious") ?>" href="<?php echo $vwinventory_list->pageUrl() ?>start=<?php echo $vwinventory_list->Pager->PrevButton->Start ?>"><i class="icon-prev ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerPrevious") ?>"><i class="icon-prev ew-icon"></i></a>
	<?php } ?>
</div>
<!-- current page number -->
	<input class="form-control" type="text" name="<?php echo TABLE_PAGE_NO ?>" value="<?php echo $vwinventory_list->Pager->CurrentPage ?>">
<div class="input-group-append">
<!-- next page button -->
	<?php if ($vwinventory_list->Pager->NextButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerNext") ?>" href="<?php echo $vwinventory_list->pageUrl() ?>start=<?php echo $vwinventory_list->Pager->NextButton->Start ?>"><i class="icon-next ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerNext") ?>"><i class="icon-next ew-icon"></i></a>
	<?php } ?>
<!-- last page button -->
	<?php if ($vwinventory_list->Pager->LastButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerLast") ?>" href="<?php echo $vwinventory_list->pageUrl() ?>start=<?php echo $vwinventory_list->Pager->LastButton->Start ?>"><i class="icon-last ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerLast") ?>"><i class="icon-last ew-icon"></i></a>
	<?php } ?>
</div>
</div>
</div>
<span>&nbsp;<?php echo $Language->Phrase("of") ?>&nbsp;<?php echo $vwinventory_list->Pager->PageCount ?></span>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php if ($vwinventory_list->Pager->RecordCount > 0) { ?>
<div class="ew-pager ew-rec">
	<span><?php echo $Language->Phrase("Record") ?>&nbsp;<?php echo $vwinventory_list->Pager->FromIndex ?>&nbsp;<?php echo $Language->Phrase("To") ?>&nbsp;<?php echo $vwinventory_list->Pager->ToIndex ?>&nbsp;<?php echo $Language->Phrase("Of") ?>&nbsp;<?php echo $vwinventory_list->Pager->RecordCount ?></span>
</div>
<?php } ?>
<?php if ($vwinventory_list->TotalRecs > 0 && (!$vwinventory_list->AutoHidePageSizeSelector || $vwinventory_list->Pager->Visible)) { ?>
<div class="ew-pager">
<input type="hidden" name="t" value="vwinventory">
<select name="<?php echo TABLE_REC_PER_PAGE ?>" class="form-control form-control-sm ew-tooltip" title="<?php echo $Language->phrase("RecordsPerPage") ?>" onchange="this.form.submit();">
<option value="20"<?php if ($vwinventory_list->DisplayRecs == 20) { ?> selected<?php } ?>>20</option>
<option value="50"<?php if ($vwinventory_list->DisplayRecs == 50) { ?> selected<?php } ?>>50</option>
<option value="100"<?php if ($vwinventory_list->DisplayRecs == 100) { ?> selected<?php } ?>>100</option>
<option value="200"<?php if ($vwinventory_list->DisplayRecs == 200) { ?> selected<?php } ?>>200</option>
<option value="500"<?php if ($vwinventory_list->DisplayRecs == 500) { ?> selected<?php } ?>>500</option>
<option value="ALL"<?php if ($vwinventory->getRecordsPerPage() == -1) { ?> selected<?php } ?>><?php echo $Language->Phrase("AllRecords") ?></option>
</select>
</div>
<?php } ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $vwinventory_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($vwinventory_list->TotalRecs == 0 && !$vwinventory->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $vwinventory_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$vwinventory_list->showPageFooter();
if (DEBUG_ENABLED)
	echo GetDebugMessage();
?>
<?php if (!$vwinventory->isExport()) { ?>
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
		window.location="rpt_Inventory.php?id="+x.substring(0,x.length-1);
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
		window.location="rpt_Inventory.php?id="+x.substring(0,x.length-1);
	});	
// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php } ?>
<?php include_once "footer.php" ?>
<?php
$vwinventory_list->terminate();
?>