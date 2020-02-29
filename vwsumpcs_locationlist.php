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
$vwsumpcs_location_list = new vwsumpcs_location_list();

// Run the page
$vwsumpcs_location_list->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$vwsumpcs_location_list->Page_Render();
?>
<?php include_once "header.php" ?>
<?php if (!$vwsumpcs_location->isExport()) { ?>
<script>

// Form object
currentPageID = ew.PAGE_ID = "list";
var fvwsumpcs_locationlist = currentForm = new ew.Form("fvwsumpcs_locationlist", "list");
fvwsumpcs_locationlist.formKeyCountName = '<?php echo $vwsumpcs_location_list->FormKeyCountName ?>';

// Form_CustomValidate event
fvwsumpcs_locationlist.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

	// Your custom validation code here, return false if invalid.
	return true;
}

// Use JavaScript validation or not
fvwsumpcs_locationlist.validateRequired = <?php echo json_encode(CLIENT_VALIDATE) ?>;

// Dynamic selection lists
fvwsumpcs_locationlist.lists["x_TypeName"] = <?php echo $vwsumpcs_location_list->TypeName->Lookup->toClientList() ?>;
fvwsumpcs_locationlist.lists["x_TypeName"].options = <?php echo JsonEncode($vwsumpcs_location_list->TypeName->lookupOptions()) ?>;

// Form object for search
var fvwsumpcs_locationlistsrch = currentSearchForm = new ew.Form("fvwsumpcs_locationlistsrch");

// Validate function for search
fvwsumpcs_locationlistsrch.validate = function(fobj) {
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
fvwsumpcs_locationlistsrch.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

	// Your custom validation code here, return false if invalid.
	return true;
}

// Use JavaScript validation or not
fvwsumpcs_locationlistsrch.validateRequired = <?php echo json_encode(CLIENT_VALIDATE) ?>;

// Dynamic selection lists
fvwsumpcs_locationlistsrch.lists["x_TypeName"] = <?php echo $vwsumpcs_location_list->TypeName->Lookup->toClientList() ?>;
fvwsumpcs_locationlistsrch.lists["x_TypeName"].options = <?php echo JsonEncode($vwsumpcs_location_list->TypeName->lookupOptions()) ?>;

// Filters
fvwsumpcs_locationlistsrch.filterList = <?php echo $vwsumpcs_location_list->getFilterList() ?>;
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
<?php if (!$vwsumpcs_location->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($vwsumpcs_location_list->TotalRecs > 0 && $vwsumpcs_location_list->ExportOptions->visible()) { ?>
<?php $vwsumpcs_location_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($vwsumpcs_location_list->ImportOptions->visible()) { ?>
<?php $vwsumpcs_location_list->ImportOptions->render("body") ?>
<?php } ?>
<?php if ($vwsumpcs_location_list->SearchOptions->visible()) { ?>
<?php $vwsumpcs_location_list->SearchOptions->render("body") ?>
<?php } ?>
<?php if ($vwsumpcs_location_list->FilterOptions->visible()) { ?>
<?php $vwsumpcs_location_list->FilterOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php
$vwsumpcs_location_list->renderOtherOptions();
?>
<?php if ($Security->CanSearch()) { ?>
<?php if (!$vwsumpcs_location->isExport() && !$vwsumpcs_location->CurrentAction) { ?>
<form name="fvwsumpcs_locationlistsrch" id="fvwsumpcs_locationlistsrch" class="form-inline ew-form ew-ext-search-form" action="<?php echo CurrentPageName() ?>">
<?php $searchPanelClass = ($vwsumpcs_location_list->SearchWhere <> "") ? " show" : " show"; ?>
<div id="fvwsumpcs_locationlistsrch-search-panel" class="ew-search-panel collapse<?php echo $searchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="vwsumpcs_location">
	<div class="ew-basic-search">
<?php
if ($SearchError == "")
	$vwsumpcs_location_list->LoadAdvancedSearch(); // Load advanced search

// Render for search
$vwsumpcs_location->RowType = ROWTYPE_SEARCH;

// Render row
$vwsumpcs_location->resetAttributes();
$vwsumpcs_location_list->renderRow();
?>
<div id="xsr_1" class="ew-row d-sm-flex">
<?php if ($vwsumpcs_location->TypeName->Visible) { // TypeName ?>
	<div id="xsc_TypeName" class="ew-cell form-group">
		<label for="x_TypeName" class="ew-search-caption ew-label"><?php echo $vwsumpcs_location->TypeName->caption() ?></label>
		<span class="ew-search-operator"><?php echo $Language->phrase("LIKE") ?><input type="hidden" name="z_TypeName" id="z_TypeName" value="LIKE"></span>
		<span class="ew-search-field">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="vwsumpcs_location" data-field="x_TypeName" data-value-separator="<?php echo $vwsumpcs_location->TypeName->displayValueSeparatorAttribute() ?>" id="x_TypeName" name="x_TypeName"<?php echo $vwsumpcs_location->TypeName->editAttributes() ?>>
		<?php echo $vwsumpcs_location->TypeName->selectOptionListHtml("x_TypeName") ?>
	</select>
</div>
<?php echo $vwsumpcs_location->TypeName->Lookup->getParamTag("p_x_TypeName") ?>
</span>
	</div>
<?php } ?>
</div>
<div id="xsr_2" class="ew-row d-sm-flex">
	<div class="ew-quick-search input-group">
		<input type="text" name="<?php echo TABLE_BASIC_SEARCH ?>" id="<?php echo TABLE_BASIC_SEARCH ?>" class="form-control" value="<?php echo HtmlEncode($vwsumpcs_location_list->BasicSearch->getKeyword()) ?>" placeholder="<?php echo HtmlEncode($Language->phrase("Search")) ?>">
		<input type="hidden" name="<?php echo TABLE_BASIC_SEARCH_TYPE ?>" id="<?php echo TABLE_BASIC_SEARCH_TYPE ?>" value="<?php echo HtmlEncode($vwsumpcs_location_list->BasicSearch->getType()) ?>">
		<div class="input-group-append">
			<button class="btn btn-primary" name="btn-submit" id="btn-submit" type="submit"><?php echo $Language->phrase("SearchBtn") ?></button>
			<button type="button" data-toggle="dropdown" class="btn btn-primary dropdown-toggle dropdown-toggle-split" aria-haspopup="true" aria-expanded="false"><span id="searchtype"><?php echo $vwsumpcs_location_list->BasicSearch->getTypeNameShort() ?></span></button>
			<div class="dropdown-menu dropdown-menu-right">
				<a class="dropdown-item<?php if ($vwsumpcs_location_list->BasicSearch->getType() == "") echo " active"; ?>" href="javascript:void(0);" onclick="ew.setSearchType(this)"><?php echo $Language->phrase("QuickSearchAuto") ?></a>
				<a class="dropdown-item<?php if ($vwsumpcs_location_list->BasicSearch->getType() == "=") echo " active"; ?>" href="javascript:void(0);" onclick="ew.setSearchType(this,'=')"><?php echo $Language->phrase("QuickSearchExact") ?></a>
				<a class="dropdown-item<?php if ($vwsumpcs_location_list->BasicSearch->getType() == "AND") echo " active"; ?>" href="javascript:void(0);" onclick="ew.setSearchType(this,'AND')"><?php echo $Language->phrase("QuickSearchAll") ?></a>
				<a class="dropdown-item<?php if ($vwsumpcs_location_list->BasicSearch->getType() == "OR") echo " active"; ?>" href="javascript:void(0);" onclick="ew.setSearchType(this,'OR')"><?php echo $Language->phrase("QuickSearchAny") ?></a>
			</div>
		</div>
	</div>
</div>
	</div>
</div>
</form>
<?php } ?>
<?php } ?>
<?php $vwsumpcs_location_list->showPageHeader(); ?>
<?php
$vwsumpcs_location_list->showMessage();
?>
<?php if ($vwsumpcs_location_list->TotalRecs > 0 || $vwsumpcs_location->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($vwsumpcs_location_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> vwsumpcs_location">
<?php if (!$vwsumpcs_location->isExport()) { ?>
<div class="card-header ew-grid-upper-panel">
<?php if (!$vwsumpcs_location->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php if (!isset($vwsumpcs_location_list->Pager)) $vwsumpcs_location_list->Pager = new PrevNextPager($vwsumpcs_location_list->StartRec, $vwsumpcs_location_list->DisplayRecs, $vwsumpcs_location_list->TotalRecs, $vwsumpcs_location_list->AutoHidePager) ?>
<?php if ($vwsumpcs_location_list->Pager->RecordCount > 0 && $vwsumpcs_location_list->Pager->Visible) { ?>
<div class="ew-pager">
<span><?php echo $Language->Phrase("Page") ?>&nbsp;</span>
<div class="ew-prev-next"><div class="input-group input-group-sm">
<div class="input-group-prepend">
<!-- first page button -->
	<?php if ($vwsumpcs_location_list->Pager->FirstButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerFirst") ?>" href="<?php echo $vwsumpcs_location_list->pageUrl() ?>start=<?php echo $vwsumpcs_location_list->Pager->FirstButton->Start ?>"><i class="icon-first ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerFirst") ?>"><i class="icon-first ew-icon"></i></a>
	<?php } ?>
<!-- previous page button -->
	<?php if ($vwsumpcs_location_list->Pager->PrevButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerPrevious") ?>" href="<?php echo $vwsumpcs_location_list->pageUrl() ?>start=<?php echo $vwsumpcs_location_list->Pager->PrevButton->Start ?>"><i class="icon-prev ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerPrevious") ?>"><i class="icon-prev ew-icon"></i></a>
	<?php } ?>
</div>
<!-- current page number -->
	<input class="form-control" type="text" name="<?php echo TABLE_PAGE_NO ?>" value="<?php echo $vwsumpcs_location_list->Pager->CurrentPage ?>">
<div class="input-group-append">
<!-- next page button -->
	<?php if ($vwsumpcs_location_list->Pager->NextButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerNext") ?>" href="<?php echo $vwsumpcs_location_list->pageUrl() ?>start=<?php echo $vwsumpcs_location_list->Pager->NextButton->Start ?>"><i class="icon-next ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerNext") ?>"><i class="icon-next ew-icon"></i></a>
	<?php } ?>
<!-- last page button -->
	<?php if ($vwsumpcs_location_list->Pager->LastButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerLast") ?>" href="<?php echo $vwsumpcs_location_list->pageUrl() ?>start=<?php echo $vwsumpcs_location_list->Pager->LastButton->Start ?>"><i class="icon-last ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerLast") ?>"><i class="icon-last ew-icon"></i></a>
	<?php } ?>
</div>
</div>
</div>
<span>&nbsp;<?php echo $Language->Phrase("of") ?>&nbsp;<?php echo $vwsumpcs_location_list->Pager->PageCount ?></span>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php if ($vwsumpcs_location_list->Pager->RecordCount > 0) { ?>
<div class="ew-pager ew-rec">
	<span><?php echo $Language->Phrase("Record") ?>&nbsp;<?php echo $vwsumpcs_location_list->Pager->FromIndex ?>&nbsp;<?php echo $Language->Phrase("To") ?>&nbsp;<?php echo $vwsumpcs_location_list->Pager->ToIndex ?>&nbsp;<?php echo $Language->Phrase("Of") ?>&nbsp;<?php echo $vwsumpcs_location_list->Pager->RecordCount ?></span>
</div>
<?php } ?>
<?php if ($vwsumpcs_location_list->TotalRecs > 0 && (!$vwsumpcs_location_list->AutoHidePageSizeSelector || $vwsumpcs_location_list->Pager->Visible)) { ?>
<div class="ew-pager">
<input type="hidden" name="t" value="vwsumpcs_location">
<select name="<?php echo TABLE_REC_PER_PAGE ?>" class="form-control form-control-sm ew-tooltip" title="<?php echo $Language->phrase("RecordsPerPage") ?>" onchange="this.form.submit();">
<option value="20"<?php if ($vwsumpcs_location_list->DisplayRecs == 20) { ?> selected<?php } ?>>20</option>
<option value="50"<?php if ($vwsumpcs_location_list->DisplayRecs == 50) { ?> selected<?php } ?>>50</option>
<option value="100"<?php if ($vwsumpcs_location_list->DisplayRecs == 100) { ?> selected<?php } ?>>100</option>
<option value="200"<?php if ($vwsumpcs_location_list->DisplayRecs == 200) { ?> selected<?php } ?>>200</option>
<option value="500"<?php if ($vwsumpcs_location_list->DisplayRecs == 500) { ?> selected<?php } ?>>500</option>
<option value="ALL"<?php if ($vwsumpcs_location->getRecordsPerPage() == -1) { ?> selected<?php } ?>><?php echo $Language->Phrase("AllRecords") ?></option>
</select>
</div>
<?php } ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $vwsumpcs_location_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
<form name="fvwsumpcs_locationlist" id="fvwsumpcs_locationlist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($vwsumpcs_location_list->CheckToken) { ?>
<input type="hidden" name="<?php echo TOKEN_NAME ?>" value="<?php echo $vwsumpcs_location_list->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="vwsumpcs_location">
<input type="hidden" name="exporttype" id="exporttype" value="">
<div id="gmp_vwsumpcs_location" class="<?php if (IsResponsiveLayout()) { ?>table-responsive <?php } ?>card-body ew-grid-middle-panel">
<?php if ($vwsumpcs_location_list->TotalRecs > 0 || $vwsumpcs_location->isGridEdit()) { ?>
<table id="tbl_vwsumpcs_locationlist" class="table ew-table"><!-- .ew-table ##-->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$vwsumpcs_location_list->RowType = ROWTYPE_HEADER;

// Render list options
$vwsumpcs_location_list->renderListOptions();

// Render list options (header, left)
$vwsumpcs_location_list->ListOptions->render("header", "left");
?>
<?php if ($vwsumpcs_location->Location->Visible) { // Location ?>
	<?php if ($vwsumpcs_location->sortUrl($vwsumpcs_location->Location) == "") { ?>
		<th data-name="Location" class="<?php echo $vwsumpcs_location->Location->headerCellClass() ?>" style="white-space: nowrap;"><div id="elh_vwsumpcs_location_Location" class="vwsumpcs_location_Location"><div class="ew-table-header-caption"><?php echo $vwsumpcs_location->Location->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Location" class="<?php echo $vwsumpcs_location->Location->headerCellClass() ?>" style="white-space: nowrap;"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $vwsumpcs_location->SortUrl($vwsumpcs_location->Location) ?>',2);"><div id="elh_vwsumpcs_location_Location" class="vwsumpcs_location_Location">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $vwsumpcs_location->Location->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($vwsumpcs_location->Location->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($vwsumpcs_location->Location->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($vwsumpcs_location->TypeName->Visible) { // TypeName ?>
	<?php if ($vwsumpcs_location->sortUrl($vwsumpcs_location->TypeName) == "") { ?>
		<th data-name="TypeName" class="<?php echo $vwsumpcs_location->TypeName->headerCellClass() ?>" style="white-space: nowrap;"><div id="elh_vwsumpcs_location_TypeName" class="vwsumpcs_location_TypeName"><div class="ew-table-header-caption"><?php echo $vwsumpcs_location->TypeName->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="TypeName" class="<?php echo $vwsumpcs_location->TypeName->headerCellClass() ?>" style="white-space: nowrap;"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $vwsumpcs_location->SortUrl($vwsumpcs_location->TypeName) ?>',2);"><div id="elh_vwsumpcs_location_TypeName" class="vwsumpcs_location_TypeName">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $vwsumpcs_location->TypeName->caption() ?></span><span class="ew-table-header-sort"><?php if ($vwsumpcs_location->TypeName->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($vwsumpcs_location->TypeName->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($vwsumpcs_location->Code->Visible) { // Code ?>
	<?php if ($vwsumpcs_location->sortUrl($vwsumpcs_location->Code) == "") { ?>
		<th data-name="Code" class="<?php echo $vwsumpcs_location->Code->headerCellClass() ?>" style="white-space: nowrap;"><div id="elh_vwsumpcs_location_Code" class="vwsumpcs_location_Code"><div class="ew-table-header-caption"><?php echo $vwsumpcs_location->Code->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Code" class="<?php echo $vwsumpcs_location->Code->headerCellClass() ?>" style="white-space: nowrap;"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $vwsumpcs_location->SortUrl($vwsumpcs_location->Code) ?>',2);"><div id="elh_vwsumpcs_location_Code" class="vwsumpcs_location_Code">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $vwsumpcs_location->Code->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($vwsumpcs_location->Code->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($vwsumpcs_location->Code->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($vwsumpcs_location->ProductName->Visible) { // ProductName ?>
	<?php if ($vwsumpcs_location->sortUrl($vwsumpcs_location->ProductName) == "") { ?>
		<th data-name="ProductName" class="<?php echo $vwsumpcs_location->ProductName->headerCellClass() ?>" style="white-space: nowrap;"><div id="elh_vwsumpcs_location_ProductName" class="vwsumpcs_location_ProductName"><div class="ew-table-header-caption"><?php echo $vwsumpcs_location->ProductName->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="ProductName" class="<?php echo $vwsumpcs_location->ProductName->headerCellClass() ?>" style="white-space: nowrap;"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $vwsumpcs_location->SortUrl($vwsumpcs_location->ProductName) ?>',2);"><div id="elh_vwsumpcs_location_ProductName" class="vwsumpcs_location_ProductName">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $vwsumpcs_location->ProductName->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($vwsumpcs_location->ProductName->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($vwsumpcs_location->ProductName->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($vwsumpcs_location->Model->Visible) { // Model ?>
	<?php if ($vwsumpcs_location->sortUrl($vwsumpcs_location->Model) == "") { ?>
		<th data-name="Model" class="<?php echo $vwsumpcs_location->Model->headerCellClass() ?>" style="white-space: nowrap;"><div id="elh_vwsumpcs_location_Model" class="vwsumpcs_location_Model"><div class="ew-table-header-caption"><?php echo $vwsumpcs_location->Model->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Model" class="<?php echo $vwsumpcs_location->Model->headerCellClass() ?>" style="white-space: nowrap;"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $vwsumpcs_location->SortUrl($vwsumpcs_location->Model) ?>',2);"><div id="elh_vwsumpcs_location_Model" class="vwsumpcs_location_Model">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $vwsumpcs_location->Model->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($vwsumpcs_location->Model->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($vwsumpcs_location->Model->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($vwsumpcs_location->PCS->Visible) { // PCS ?>
	<?php if ($vwsumpcs_location->sortUrl($vwsumpcs_location->PCS) == "") { ?>
		<th data-name="PCS" class="<?php echo $vwsumpcs_location->PCS->headerCellClass() ?>" style="white-space: nowrap;"><div id="elh_vwsumpcs_location_PCS" class="vwsumpcs_location_PCS"><div class="ew-table-header-caption"><?php echo $vwsumpcs_location->PCS->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="PCS" class="<?php echo $vwsumpcs_location->PCS->headerCellClass() ?>" style="white-space: nowrap;"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $vwsumpcs_location->SortUrl($vwsumpcs_location->PCS) ?>',2);"><div id="elh_vwsumpcs_location_PCS" class="vwsumpcs_location_PCS">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $vwsumpcs_location->PCS->caption() ?></span><span class="ew-table-header-sort"><?php if ($vwsumpcs_location->PCS->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($vwsumpcs_location->PCS->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$vwsumpcs_location_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
if ($vwsumpcs_location->ExportAll && $vwsumpcs_location->isExport()) {
	$vwsumpcs_location_list->StopRec = $vwsumpcs_location_list->TotalRecs;
} else {

	// Set the last record to display
	if ($vwsumpcs_location_list->TotalRecs > $vwsumpcs_location_list->StartRec + $vwsumpcs_location_list->DisplayRecs - 1)
		$vwsumpcs_location_list->StopRec = $vwsumpcs_location_list->StartRec + $vwsumpcs_location_list->DisplayRecs - 1;
	else
		$vwsumpcs_location_list->StopRec = $vwsumpcs_location_list->TotalRecs;
}
$vwsumpcs_location_list->RecCnt = $vwsumpcs_location_list->StartRec - 1;
if ($vwsumpcs_location_list->Recordset && !$vwsumpcs_location_list->Recordset->EOF) {
	$vwsumpcs_location_list->Recordset->moveFirst();
	$selectLimit = $vwsumpcs_location_list->UseSelectLimit;
	if (!$selectLimit && $vwsumpcs_location_list->StartRec > 1)
		$vwsumpcs_location_list->Recordset->move($vwsumpcs_location_list->StartRec - 1);
} elseif (!$vwsumpcs_location->AllowAddDeleteRow && $vwsumpcs_location_list->StopRec == 0) {
	$vwsumpcs_location_list->StopRec = $vwsumpcs_location->GridAddRowCount;
}

// Initialize aggregate
$vwsumpcs_location->RowType = ROWTYPE_AGGREGATEINIT;
$vwsumpcs_location->resetAttributes();
$vwsumpcs_location_list->renderRow();
while ($vwsumpcs_location_list->RecCnt < $vwsumpcs_location_list->StopRec) {
	$vwsumpcs_location_list->RecCnt++;
	if ($vwsumpcs_location_list->RecCnt >= $vwsumpcs_location_list->StartRec) {
		$vwsumpcs_location_list->RowCnt++;

		// Set up key count
		$vwsumpcs_location_list->KeyCount = $vwsumpcs_location_list->RowIndex;

		// Init row class and style
		$vwsumpcs_location->resetAttributes();
		$vwsumpcs_location->CssClass = "";
		if ($vwsumpcs_location->isGridAdd()) {
		} else {
			$vwsumpcs_location_list->loadRowValues($vwsumpcs_location_list->Recordset); // Load row values
		}
		$vwsumpcs_location->RowType = ROWTYPE_VIEW; // Render view

		// Set up row id / data-rowindex
		$vwsumpcs_location->RowAttrs = array_merge($vwsumpcs_location->RowAttrs, array('data-rowindex'=>$vwsumpcs_location_list->RowCnt, 'id'=>'r' . $vwsumpcs_location_list->RowCnt . '_vwsumpcs_location', 'data-rowtype'=>$vwsumpcs_location->RowType));

		// Render row
		$vwsumpcs_location_list->renderRow();

		// Render list options
		$vwsumpcs_location_list->renderListOptions();
?>
	<tr<?php echo $vwsumpcs_location->rowAttributes() ?>>
<?php

// Render list options (body, left)
$vwsumpcs_location_list->ListOptions->render("body", "left", $vwsumpcs_location_list->RowCnt);
?>
	<?php if ($vwsumpcs_location->Location->Visible) { // Location ?>
		<td data-name="Location"<?php echo $vwsumpcs_location->Location->cellAttributes() ?>>
<span id="el<?php echo $vwsumpcs_location_list->RowCnt ?>_vwsumpcs_location_Location" class="vwsumpcs_location_Location">
<span<?php echo $vwsumpcs_location->Location->viewAttributes() ?>>
<?php echo $vwsumpcs_location->Location->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($vwsumpcs_location->TypeName->Visible) { // TypeName ?>
		<td data-name="TypeName"<?php echo $vwsumpcs_location->TypeName->cellAttributes() ?>>
<span id="el<?php echo $vwsumpcs_location_list->RowCnt ?>_vwsumpcs_location_TypeName" class="vwsumpcs_location_TypeName">
<span<?php echo $vwsumpcs_location->TypeName->viewAttributes() ?>>
<?php echo $vwsumpcs_location->TypeName->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($vwsumpcs_location->Code->Visible) { // Code ?>
		<td data-name="Code"<?php echo $vwsumpcs_location->Code->cellAttributes() ?>>
<span id="el<?php echo $vwsumpcs_location_list->RowCnt ?>_vwsumpcs_location_Code" class="vwsumpcs_location_Code">
<span<?php echo $vwsumpcs_location->Code->viewAttributes() ?>>
<?php echo $vwsumpcs_location->Code->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($vwsumpcs_location->ProductName->Visible) { // ProductName ?>
		<td data-name="ProductName"<?php echo $vwsumpcs_location->ProductName->cellAttributes() ?>>
<span id="el<?php echo $vwsumpcs_location_list->RowCnt ?>_vwsumpcs_location_ProductName" class="vwsumpcs_location_ProductName">
<span<?php echo $vwsumpcs_location->ProductName->viewAttributes() ?>>
<?php echo $vwsumpcs_location->ProductName->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($vwsumpcs_location->Model->Visible) { // Model ?>
		<td data-name="Model"<?php echo $vwsumpcs_location->Model->cellAttributes() ?>>
<span id="el<?php echo $vwsumpcs_location_list->RowCnt ?>_vwsumpcs_location_Model" class="vwsumpcs_location_Model">
<span<?php echo $vwsumpcs_location->Model->viewAttributes() ?>>
<?php echo $vwsumpcs_location->Model->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($vwsumpcs_location->PCS->Visible) { // PCS ?>
		<td data-name="PCS"<?php echo $vwsumpcs_location->PCS->cellAttributes() ?>>
<span id="el<?php echo $vwsumpcs_location_list->RowCnt ?>_vwsumpcs_location_PCS" class="vwsumpcs_location_PCS">
<span<?php echo $vwsumpcs_location->PCS->viewAttributes() ?>>
<?php echo $vwsumpcs_location->PCS->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$vwsumpcs_location_list->ListOptions->render("body", "right", $vwsumpcs_location_list->RowCnt);
?>
	</tr>
<?php
	}
	if (!$vwsumpcs_location->isGridAdd())
		$vwsumpcs_location_list->Recordset->moveNext();
}
?>
</tbody>
<?php

// Render aggregate row
$vwsumpcs_location->RowType = ROWTYPE_AGGREGATE;
$vwsumpcs_location->resetAttributes();
$vwsumpcs_location_list->renderRow();
?>
<?php if ($vwsumpcs_location_list->TotalRecs > 0 && !$vwsumpcs_location->isGridAdd() && !$vwsumpcs_location->isGridEdit()) { ?>
<tfoot><!-- Table footer -->
	<tr class="ew-table-footer">
<?php

// Render list options
$vwsumpcs_location_list->renderListOptions();

// Render list options (footer, left)
$vwsumpcs_location_list->ListOptions->render("footer", "left");
?>
	<?php if ($vwsumpcs_location->Location->Visible) { // Location ?>
		<td data-name="Location" class="<?php echo $vwsumpcs_location->Location->footerCellClass() ?>"><span id="elf_vwsumpcs_location_Location" class="vwsumpcs_location_Location">
		&nbsp;
		</span></td>
	<?php } ?>
	<?php if ($vwsumpcs_location->TypeName->Visible) { // TypeName ?>
		<td data-name="TypeName" class="<?php echo $vwsumpcs_location->TypeName->footerCellClass() ?>"><span id="elf_vwsumpcs_location_TypeName" class="vwsumpcs_location_TypeName">
		&nbsp;
		</span></td>
	<?php } ?>
	<?php if ($vwsumpcs_location->Code->Visible) { // Code ?>
		<td data-name="Code" class="<?php echo $vwsumpcs_location->Code->footerCellClass() ?>"><span id="elf_vwsumpcs_location_Code" class="vwsumpcs_location_Code">
		&nbsp;
		</span></td>
	<?php } ?>
	<?php if ($vwsumpcs_location->ProductName->Visible) { // ProductName ?>
		<td data-name="ProductName" class="<?php echo $vwsumpcs_location->ProductName->footerCellClass() ?>"><span id="elf_vwsumpcs_location_ProductName" class="vwsumpcs_location_ProductName">
		&nbsp;
		</span></td>
	<?php } ?>
	<?php if ($vwsumpcs_location->Model->Visible) { // Model ?>
		<td data-name="Model" class="<?php echo $vwsumpcs_location->Model->footerCellClass() ?>"><span id="elf_vwsumpcs_location_Model" class="vwsumpcs_location_Model">
		&nbsp;
		</span></td>
	<?php } ?>
	<?php if ($vwsumpcs_location->PCS->Visible) { // PCS ?>
		<td data-name="PCS" class="<?php echo $vwsumpcs_location->PCS->footerCellClass() ?>"><span id="elf_vwsumpcs_location_PCS" class="vwsumpcs_location_PCS">
		<span class="ew-aggregate"><?php echo $Language->phrase("TOTAL") ?></span><span class="ew-aggregate-value">
		<?php echo $vwsumpcs_location->PCS->ViewValue ?></span>
		</span></td>
	<?php } ?>
<?php

// Render list options (footer, right)
$vwsumpcs_location_list->ListOptions->render("footer", "right");
?>
	</tr>
</tfoot>
<?php } ?>
</table><!-- /.ew-table -->
<?php } ?>
<?php if (!$vwsumpcs_location->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</div><!-- /.ew-grid-middle-panel -->
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($vwsumpcs_location_list->Recordset)
	$vwsumpcs_location_list->Recordset->Close();
?>
<?php if (!$vwsumpcs_location->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$vwsumpcs_location->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php if (!isset($vwsumpcs_location_list->Pager)) $vwsumpcs_location_list->Pager = new PrevNextPager($vwsumpcs_location_list->StartRec, $vwsumpcs_location_list->DisplayRecs, $vwsumpcs_location_list->TotalRecs, $vwsumpcs_location_list->AutoHidePager) ?>
<?php if ($vwsumpcs_location_list->Pager->RecordCount > 0 && $vwsumpcs_location_list->Pager->Visible) { ?>
<div class="ew-pager">
<span><?php echo $Language->Phrase("Page") ?>&nbsp;</span>
<div class="ew-prev-next"><div class="input-group input-group-sm">
<div class="input-group-prepend">
<!-- first page button -->
	<?php if ($vwsumpcs_location_list->Pager->FirstButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerFirst") ?>" href="<?php echo $vwsumpcs_location_list->pageUrl() ?>start=<?php echo $vwsumpcs_location_list->Pager->FirstButton->Start ?>"><i class="icon-first ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerFirst") ?>"><i class="icon-first ew-icon"></i></a>
	<?php } ?>
<!-- previous page button -->
	<?php if ($vwsumpcs_location_list->Pager->PrevButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerPrevious") ?>" href="<?php echo $vwsumpcs_location_list->pageUrl() ?>start=<?php echo $vwsumpcs_location_list->Pager->PrevButton->Start ?>"><i class="icon-prev ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerPrevious") ?>"><i class="icon-prev ew-icon"></i></a>
	<?php } ?>
</div>
<!-- current page number -->
	<input class="form-control" type="text" name="<?php echo TABLE_PAGE_NO ?>" value="<?php echo $vwsumpcs_location_list->Pager->CurrentPage ?>">
<div class="input-group-append">
<!-- next page button -->
	<?php if ($vwsumpcs_location_list->Pager->NextButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerNext") ?>" href="<?php echo $vwsumpcs_location_list->pageUrl() ?>start=<?php echo $vwsumpcs_location_list->Pager->NextButton->Start ?>"><i class="icon-next ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerNext") ?>"><i class="icon-next ew-icon"></i></a>
	<?php } ?>
<!-- last page button -->
	<?php if ($vwsumpcs_location_list->Pager->LastButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerLast") ?>" href="<?php echo $vwsumpcs_location_list->pageUrl() ?>start=<?php echo $vwsumpcs_location_list->Pager->LastButton->Start ?>"><i class="icon-last ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerLast") ?>"><i class="icon-last ew-icon"></i></a>
	<?php } ?>
</div>
</div>
</div>
<span>&nbsp;<?php echo $Language->Phrase("of") ?>&nbsp;<?php echo $vwsumpcs_location_list->Pager->PageCount ?></span>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php if ($vwsumpcs_location_list->Pager->RecordCount > 0) { ?>
<div class="ew-pager ew-rec">
	<span><?php echo $Language->Phrase("Record") ?>&nbsp;<?php echo $vwsumpcs_location_list->Pager->FromIndex ?>&nbsp;<?php echo $Language->Phrase("To") ?>&nbsp;<?php echo $vwsumpcs_location_list->Pager->ToIndex ?>&nbsp;<?php echo $Language->Phrase("Of") ?>&nbsp;<?php echo $vwsumpcs_location_list->Pager->RecordCount ?></span>
</div>
<?php } ?>
<?php if ($vwsumpcs_location_list->TotalRecs > 0 && (!$vwsumpcs_location_list->AutoHidePageSizeSelector || $vwsumpcs_location_list->Pager->Visible)) { ?>
<div class="ew-pager">
<input type="hidden" name="t" value="vwsumpcs_location">
<select name="<?php echo TABLE_REC_PER_PAGE ?>" class="form-control form-control-sm ew-tooltip" title="<?php echo $Language->phrase("RecordsPerPage") ?>" onchange="this.form.submit();">
<option value="20"<?php if ($vwsumpcs_location_list->DisplayRecs == 20) { ?> selected<?php } ?>>20</option>
<option value="50"<?php if ($vwsumpcs_location_list->DisplayRecs == 50) { ?> selected<?php } ?>>50</option>
<option value="100"<?php if ($vwsumpcs_location_list->DisplayRecs == 100) { ?> selected<?php } ?>>100</option>
<option value="200"<?php if ($vwsumpcs_location_list->DisplayRecs == 200) { ?> selected<?php } ?>>200</option>
<option value="500"<?php if ($vwsumpcs_location_list->DisplayRecs == 500) { ?> selected<?php } ?>>500</option>
<option value="ALL"<?php if ($vwsumpcs_location->getRecordsPerPage() == -1) { ?> selected<?php } ?>><?php echo $Language->Phrase("AllRecords") ?></option>
</select>
</div>
<?php } ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $vwsumpcs_location_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($vwsumpcs_location_list->TotalRecs == 0 && !$vwsumpcs_location->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $vwsumpcs_location_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$vwsumpcs_location_list->showPageFooter();
if (DEBUG_ENABLED)
	echo GetDebugMessage();
?>
<?php if (!$vwsumpcs_location->isExport()) { ?>
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
		window.location="rpt_Sum_location.php?id="+x.substring(0,x.length-1);
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
		window.location="rpt_Sum_location.php?id="+x.substring(0,x.length-1);
	});	
// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php } ?>
<?php include_once "footer.php" ?>
<?php
$vwsumpcs_location_list->terminate();
?>