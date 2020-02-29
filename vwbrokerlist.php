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
$vwbroker_list = new vwbroker_list();

// Run the page
$vwbroker_list->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$vwbroker_list->Page_Render();
?>
<?php include_once "header.php" ?>
<?php if (!$vwbroker->isExport()) { ?>
<script>

// Form object
currentPageID = ew.PAGE_ID = "list";
var fvwbrokerlist = currentForm = new ew.Form("fvwbrokerlist", "list");
fvwbrokerlist.formKeyCountName = '<?php echo $vwbroker_list->FormKeyCountName ?>';

// Form_CustomValidate event
fvwbrokerlist.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

	// Your custom validation code here, return false if invalid.
	return true;
}

// Use JavaScript validation or not
fvwbrokerlist.validateRequired = <?php echo json_encode(CLIENT_VALIDATE) ?>;

// Dynamic selection lists
fvwbrokerlist.lists["x_TypeName"] = <?php echo $vwbroker_list->TypeName->Lookup->toClientList() ?>;
fvwbrokerlist.lists["x_TypeName"].options = <?php echo JsonEncode($vwbroker_list->TypeName->lookupOptions()) ?>;

// Form object for search
var fvwbrokerlistsrch = currentSearchForm = new ew.Form("fvwbrokerlistsrch");

// Validate function for search
fvwbrokerlistsrch.validate = function(fobj) {
	if (!this.validateRequired)
		return true; // Ignore validation
	fobj = fobj || this._form;
	var infix = "";
	elm = this.getElements("x" + infix + "_OrderDate");
	if (elm && !ew.checkDateDef(elm.value))
		return this.onError(elm, "<?php echo JsEncode($vwbroker->OrderDate->errorMessage()) ?>");

	// Fire Form_CustomValidate event
	if (!this.Form_CustomValidate(fobj))
		return false;
	return true;
}

// Form_CustomValidate event
fvwbrokerlistsrch.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

	// Your custom validation code here, return false if invalid.
	return true;
}

// Use JavaScript validation or not
fvwbrokerlistsrch.validateRequired = <?php echo json_encode(CLIENT_VALIDATE) ?>;

// Dynamic selection lists
fvwbrokerlistsrch.lists["x_TypeName"] = <?php echo $vwbroker_list->TypeName->Lookup->toClientList() ?>;
fvwbrokerlistsrch.lists["x_TypeName"].options = <?php echo JsonEncode($vwbroker_list->TypeName->lookupOptions()) ?>;

// Filters
fvwbrokerlistsrch.filterList = <?php echo $vwbroker_list->getFilterList() ?>;
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
<script src="phpjs/ewscrolltable.js"></script>
<script>

// Write your client script here, no need to add script tags.
</script>
<?php } ?>
<?php if (!$vwbroker->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($vwbroker_list->TotalRecs > 0 && $vwbroker_list->ExportOptions->visible()) { ?>
<?php $vwbroker_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($vwbroker_list->ImportOptions->visible()) { ?>
<?php $vwbroker_list->ImportOptions->render("body") ?>
<?php } ?>
<?php if ($vwbroker_list->SearchOptions->visible()) { ?>
<?php $vwbroker_list->SearchOptions->render("body") ?>
<?php } ?>
<?php if ($vwbroker_list->FilterOptions->visible()) { ?>
<?php $vwbroker_list->FilterOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php
$vwbroker_list->renderOtherOptions();
?>
<?php if ($Security->CanSearch()) { ?>
<?php if (!$vwbroker->isExport() && !$vwbroker->CurrentAction) { ?>
<form name="fvwbrokerlistsrch" id="fvwbrokerlistsrch" class="form-inline ew-form ew-ext-search-form" action="<?php echo CurrentPageName() ?>">
<?php $searchPanelClass = ($vwbroker_list->SearchWhere <> "") ? " show" : " show"; ?>
<div id="fvwbrokerlistsrch-search-panel" class="ew-search-panel collapse<?php echo $searchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="vwbroker">
	<div class="ew-basic-search">
<?php
if ($SearchError == "")
	$vwbroker_list->LoadAdvancedSearch(); // Load advanced search

// Render for search
$vwbroker->RowType = ROWTYPE_SEARCH;

// Render row
$vwbroker->resetAttributes();
$vwbroker_list->renderRow();
?>
<div id="xsr_1" class="ew-row d-sm-flex">
<?php if ($vwbroker->TypeName->Visible) { // TypeName ?>
	<div id="xsc_TypeName" class="ew-cell form-group">
		<label for="x_TypeName" class="ew-search-caption ew-label"><?php echo $vwbroker->TypeName->caption() ?></label>
		<span class="ew-search-operator"><?php echo $Language->phrase("LIKE") ?><input type="hidden" name="z_TypeName" id="z_TypeName" value="LIKE"></span>
		<span class="ew-search-field">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="vwbroker" data-field="x_TypeName" data-value-separator="<?php echo $vwbroker->TypeName->displayValueSeparatorAttribute() ?>" id="x_TypeName" name="x_TypeName"<?php echo $vwbroker->TypeName->editAttributes() ?>>
		<?php echo $vwbroker->TypeName->selectOptionListHtml("x_TypeName") ?>
	</select>
</div>
<?php echo $vwbroker->TypeName->Lookup->getParamTag("p_x_TypeName") ?>
</span>
	</div>
<?php } ?>
</div>
<div id="xsr_2" class="ew-row d-sm-flex">
<?php if ($vwbroker->OrderDate->Visible) { // OrderDate ?>
	<div id="xsc_OrderDate" class="ew-cell form-group">
		<label for="x_OrderDate" class="ew-search-caption ew-label"><?php echo $vwbroker->OrderDate->caption() ?></label>
		<span class="ew-search-operator"><?php echo $Language->phrase("BETWEEN") ?><input type="hidden" name="z_OrderDate" id="z_OrderDate" value="BETWEEN"></span>
		<span class="ew-search-field">
<input type="text" data-table="vwbroker" data-field="x_OrderDate" data-format="1" name="x_OrderDate" id="x_OrderDate" placeholder="<?php echo HtmlEncode($vwbroker->OrderDate->getPlaceHolder()) ?>" value="<?php echo $vwbroker->OrderDate->EditValue ?>"<?php echo $vwbroker->OrderDate->editAttributes() ?>>
<?php if (!$vwbroker->OrderDate->ReadOnly && !$vwbroker->OrderDate->Disabled && !isset($vwbroker->OrderDate->EditAttrs["readonly"]) && !isset($vwbroker->OrderDate->EditAttrs["disabled"])) { ?>
<script>
ew.createDateTimePicker("fvwbrokerlistsrch", "x_OrderDate", {"ignoreReadonly":true,"useCurrent":false,"format":1});
</script>
<?php } ?>
</span>
		<span class="ew-search-cond btw1_OrderDate"><label><?php echo $Language->Phrase("AND") ?></label></span>
		<span class="ew-search-field btw1_OrderDate">
<input type="text" data-table="vwbroker" data-field="x_OrderDate" data-format="1" name="y_OrderDate" id="y_OrderDate" placeholder="<?php echo HtmlEncode($vwbroker->OrderDate->getPlaceHolder()) ?>" value="<?php echo $vwbroker->OrderDate->EditValue2 ?>"<?php echo $vwbroker->OrderDate->editAttributes() ?>>
<?php if (!$vwbroker->OrderDate->ReadOnly && !$vwbroker->OrderDate->Disabled && !isset($vwbroker->OrderDate->EditAttrs["readonly"]) && !isset($vwbroker->OrderDate->EditAttrs["disabled"])) { ?>
<script>
ew.createDateTimePicker("fvwbrokerlistsrch", "y_OrderDate", {"ignoreReadonly":true,"useCurrent":false,"format":1});
</script>
<?php } ?>
</span>
	</div>
<?php } ?>
</div>
<div id="xsr_3" class="ew-row d-sm-flex">
	<div class="ew-quick-search input-group">
		<input type="text" name="<?php echo TABLE_BASIC_SEARCH ?>" id="<?php echo TABLE_BASIC_SEARCH ?>" class="form-control" value="<?php echo HtmlEncode($vwbroker_list->BasicSearch->getKeyword()) ?>" placeholder="<?php echo HtmlEncode($Language->phrase("Search")) ?>">
		<input type="hidden" name="<?php echo TABLE_BASIC_SEARCH_TYPE ?>" id="<?php echo TABLE_BASIC_SEARCH_TYPE ?>" value="<?php echo HtmlEncode($vwbroker_list->BasicSearch->getType()) ?>">
		<div class="input-group-append">
			<button class="btn btn-primary" name="btn-submit" id="btn-submit" type="submit"><?php echo $Language->phrase("SearchBtn") ?></button>
			<button type="button" data-toggle="dropdown" class="btn btn-primary dropdown-toggle dropdown-toggle-split" aria-haspopup="true" aria-expanded="false"><span id="searchtype"><?php echo $vwbroker_list->BasicSearch->getTypeNameShort() ?></span></button>
			<div class="dropdown-menu dropdown-menu-right">
				<a class="dropdown-item<?php if ($vwbroker_list->BasicSearch->getType() == "") echo " active"; ?>" href="javascript:void(0);" onclick="ew.setSearchType(this)"><?php echo $Language->phrase("QuickSearchAuto") ?></a>
				<a class="dropdown-item<?php if ($vwbroker_list->BasicSearch->getType() == "=") echo " active"; ?>" href="javascript:void(0);" onclick="ew.setSearchType(this,'=')"><?php echo $Language->phrase("QuickSearchExact") ?></a>
				<a class="dropdown-item<?php if ($vwbroker_list->BasicSearch->getType() == "AND") echo " active"; ?>" href="javascript:void(0);" onclick="ew.setSearchType(this,'AND')"><?php echo $Language->phrase("QuickSearchAll") ?></a>
				<a class="dropdown-item<?php if ($vwbroker_list->BasicSearch->getType() == "OR") echo " active"; ?>" href="javascript:void(0);" onclick="ew.setSearchType(this,'OR')"><?php echo $Language->phrase("QuickSearchAny") ?></a>
			</div>
		</div>
	</div>
</div>
	</div>
</div>
</form>
<?php } ?>
<?php } ?>
<?php $vwbroker_list->showPageHeader(); ?>
<?php
$vwbroker_list->showMessage();
?>
<?php if ($vwbroker_list->TotalRecs > 0 || $vwbroker->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($vwbroker_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> vwbroker">
<?php if (!$vwbroker->isExport()) { ?>
<div class="card-header ew-grid-upper-panel">
<?php if (!$vwbroker->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php if (!isset($vwbroker_list->Pager)) $vwbroker_list->Pager = new PrevNextPager($vwbroker_list->StartRec, $vwbroker_list->DisplayRecs, $vwbroker_list->TotalRecs, $vwbroker_list->AutoHidePager) ?>
<?php if ($vwbroker_list->Pager->RecordCount > 0 && $vwbroker_list->Pager->Visible) { ?>
<div class="ew-pager">
<span><?php echo $Language->Phrase("Page") ?>&nbsp;</span>
<div class="ew-prev-next"><div class="input-group input-group-sm">
<div class="input-group-prepend">
<!-- first page button -->
	<?php if ($vwbroker_list->Pager->FirstButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerFirst") ?>" href="<?php echo $vwbroker_list->pageUrl() ?>start=<?php echo $vwbroker_list->Pager->FirstButton->Start ?>"><i class="icon-first ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerFirst") ?>"><i class="icon-first ew-icon"></i></a>
	<?php } ?>
<!-- previous page button -->
	<?php if ($vwbroker_list->Pager->PrevButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerPrevious") ?>" href="<?php echo $vwbroker_list->pageUrl() ?>start=<?php echo $vwbroker_list->Pager->PrevButton->Start ?>"><i class="icon-prev ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerPrevious") ?>"><i class="icon-prev ew-icon"></i></a>
	<?php } ?>
</div>
<!-- current page number -->
	<input class="form-control" type="text" name="<?php echo TABLE_PAGE_NO ?>" value="<?php echo $vwbroker_list->Pager->CurrentPage ?>">
<div class="input-group-append">
<!-- next page button -->
	<?php if ($vwbroker_list->Pager->NextButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerNext") ?>" href="<?php echo $vwbroker_list->pageUrl() ?>start=<?php echo $vwbroker_list->Pager->NextButton->Start ?>"><i class="icon-next ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerNext") ?>"><i class="icon-next ew-icon"></i></a>
	<?php } ?>
<!-- last page button -->
	<?php if ($vwbroker_list->Pager->LastButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerLast") ?>" href="<?php echo $vwbroker_list->pageUrl() ?>start=<?php echo $vwbroker_list->Pager->LastButton->Start ?>"><i class="icon-last ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerLast") ?>"><i class="icon-last ew-icon"></i></a>
	<?php } ?>
</div>
</div>
</div>
<span>&nbsp;<?php echo $Language->Phrase("of") ?>&nbsp;<?php echo $vwbroker_list->Pager->PageCount ?></span>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php if ($vwbroker_list->Pager->RecordCount > 0) { ?>
<div class="ew-pager ew-rec">
	<span><?php echo $Language->Phrase("Record") ?>&nbsp;<?php echo $vwbroker_list->Pager->FromIndex ?>&nbsp;<?php echo $Language->Phrase("To") ?>&nbsp;<?php echo $vwbroker_list->Pager->ToIndex ?>&nbsp;<?php echo $Language->Phrase("Of") ?>&nbsp;<?php echo $vwbroker_list->Pager->RecordCount ?></span>
</div>
<?php } ?>
<?php if ($vwbroker_list->TotalRecs > 0 && (!$vwbroker_list->AutoHidePageSizeSelector || $vwbroker_list->Pager->Visible)) { ?>
<div class="ew-pager">
<input type="hidden" name="t" value="vwbroker">
<select name="<?php echo TABLE_REC_PER_PAGE ?>" class="form-control form-control-sm ew-tooltip" title="<?php echo $Language->phrase("RecordsPerPage") ?>" onchange="this.form.submit();">
<option value="20"<?php if ($vwbroker_list->DisplayRecs == 20) { ?> selected<?php } ?>>20</option>
<option value="50"<?php if ($vwbroker_list->DisplayRecs == 50) { ?> selected<?php } ?>>50</option>
<option value="100"<?php if ($vwbroker_list->DisplayRecs == 100) { ?> selected<?php } ?>>100</option>
<option value="200"<?php if ($vwbroker_list->DisplayRecs == 200) { ?> selected<?php } ?>>200</option>
<option value="500"<?php if ($vwbroker_list->DisplayRecs == 500) { ?> selected<?php } ?>>500</option>
<option value="ALL"<?php if ($vwbroker->getRecordsPerPage() == -1) { ?> selected<?php } ?>><?php echo $Language->Phrase("AllRecords") ?></option>
</select>
</div>
<?php } ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $vwbroker_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
<form name="fvwbrokerlist" id="fvwbrokerlist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($vwbroker_list->CheckToken) { ?>
<input type="hidden" name="<?php echo TOKEN_NAME ?>" value="<?php echo $vwbroker_list->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="vwbroker">
<input type="hidden" name="exporttype" id="exporttype" value="">
<div id="gmp_vwbroker" class="<?php if (IsResponsiveLayout()) { ?>table-responsive <?php } ?>card-body ew-grid-middle-panel">
<?php if ($vwbroker_list->TotalRecs > 0 || $vwbroker->isGridEdit()) { ?>
<table id="tbl_vwbrokerlist" class="table ew-table"><!-- .ew-table ##-->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$vwbroker_list->RowType = ROWTYPE_HEADER;

// Render list options
$vwbroker_list->renderListOptions();

// Render list options (header, left)
$vwbroker_list->ListOptions->render("header", "left");
?>
<?php if ($vwbroker->OrderID->Visible) { // OrderID ?>
	<?php if ($vwbroker->sortUrl($vwbroker->OrderID) == "") { ?>
		<th data-name="OrderID" class="<?php echo $vwbroker->OrderID->headerCellClass() ?>"><div id="elh_vwbroker_OrderID" class="vwbroker_OrderID"><div class="ew-table-header-caption"><?php echo $vwbroker->OrderID->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="OrderID" class="<?php echo $vwbroker->OrderID->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $vwbroker->SortUrl($vwbroker->OrderID) ?>',2);"><div id="elh_vwbroker_OrderID" class="vwbroker_OrderID">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $vwbroker->OrderID->caption() ?></span><span class="ew-table-header-sort"><?php if ($vwbroker->OrderID->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($vwbroker->OrderID->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($vwbroker->ID_Order->Visible) { // ID_Order ?>
	<?php if ($vwbroker->sortUrl($vwbroker->ID_Order) == "") { ?>
		<th data-name="ID_Order" class="<?php echo $vwbroker->ID_Order->headerCellClass() ?>" style="white-space: nowrap;"><div id="elh_vwbroker_ID_Order" class="vwbroker_ID_Order"><div class="ew-table-header-caption"><?php echo $vwbroker->ID_Order->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="ID_Order" class="<?php echo $vwbroker->ID_Order->headerCellClass() ?>" style="white-space: nowrap;"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $vwbroker->SortUrl($vwbroker->ID_Order) ?>',2);"><div id="elh_vwbroker_ID_Order" class="vwbroker_ID_Order">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $vwbroker->ID_Order->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($vwbroker->ID_Order->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($vwbroker->ID_Order->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($vwbroker->CodeContact->Visible) { // CodeContact ?>
	<?php if ($vwbroker->sortUrl($vwbroker->CodeContact) == "") { ?>
		<th data-name="CodeContact" class="<?php echo $vwbroker->CodeContact->headerCellClass() ?>" style="white-space: nowrap;"><div id="elh_vwbroker_CodeContact" class="vwbroker_CodeContact"><div class="ew-table-header-caption"><?php echo $vwbroker->CodeContact->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="CodeContact" class="<?php echo $vwbroker->CodeContact->headerCellClass() ?>" style="white-space: nowrap;"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $vwbroker->SortUrl($vwbroker->CodeContact) ?>',2);"><div id="elh_vwbroker_CodeContact" class="vwbroker_CodeContact">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $vwbroker->CodeContact->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($vwbroker->CodeContact->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($vwbroker->CodeContact->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($vwbroker->CompanyName->Visible) { // CompanyName ?>
	<?php if ($vwbroker->sortUrl($vwbroker->CompanyName) == "") { ?>
		<th data-name="CompanyName" class="<?php echo $vwbroker->CompanyName->headerCellClass() ?>" style="white-space: nowrap;"><div id="elh_vwbroker_CompanyName" class="vwbroker_CompanyName"><div class="ew-table-header-caption"><?php echo $vwbroker->CompanyName->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="CompanyName" class="<?php echo $vwbroker->CompanyName->headerCellClass() ?>" style="white-space: nowrap;"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $vwbroker->SortUrl($vwbroker->CompanyName) ?>',2);"><div id="elh_vwbroker_CompanyName" class="vwbroker_CompanyName">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $vwbroker->CompanyName->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($vwbroker->CompanyName->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($vwbroker->CompanyName->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($vwbroker->Address->Visible) { // Address ?>
	<?php if ($vwbroker->sortUrl($vwbroker->Address) == "") { ?>
		<th data-name="Address" class="<?php echo $vwbroker->Address->headerCellClass() ?>" style="white-space: nowrap;"><div id="elh_vwbroker_Address" class="vwbroker_Address"><div class="ew-table-header-caption"><?php echo $vwbroker->Address->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Address" class="<?php echo $vwbroker->Address->headerCellClass() ?>" style="white-space: nowrap;"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $vwbroker->SortUrl($vwbroker->Address) ?>',2);"><div id="elh_vwbroker_Address" class="vwbroker_Address">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $vwbroker->Address->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($vwbroker->Address->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($vwbroker->Address->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($vwbroker->TypeName->Visible) { // TypeName ?>
	<?php if ($vwbroker->sortUrl($vwbroker->TypeName) == "") { ?>
		<th data-name="TypeName" class="<?php echo $vwbroker->TypeName->headerCellClass() ?>"><div id="elh_vwbroker_TypeName" class="vwbroker_TypeName"><div class="ew-table-header-caption"><?php echo $vwbroker->TypeName->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="TypeName" class="<?php echo $vwbroker->TypeName->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $vwbroker->SortUrl($vwbroker->TypeName) ?>',2);"><div id="elh_vwbroker_TypeName" class="vwbroker_TypeName">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $vwbroker->TypeName->caption() ?></span><span class="ew-table-header-sort"><?php if ($vwbroker->TypeName->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($vwbroker->TypeName->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($vwbroker->Code->Visible) { // Code ?>
	<?php if ($vwbroker->sortUrl($vwbroker->Code) == "") { ?>
		<th data-name="Code" class="<?php echo $vwbroker->Code->headerCellClass() ?>" style="white-space: nowrap;"><div id="elh_vwbroker_Code" class="vwbroker_Code"><div class="ew-table-header-caption"><?php echo $vwbroker->Code->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Code" class="<?php echo $vwbroker->Code->headerCellClass() ?>" style="white-space: nowrap;"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $vwbroker->SortUrl($vwbroker->Code) ?>',2);"><div id="elh_vwbroker_Code" class="vwbroker_Code">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $vwbroker->Code->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($vwbroker->Code->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($vwbroker->Code->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($vwbroker->ProductName->Visible) { // ProductName ?>
	<?php if ($vwbroker->sortUrl($vwbroker->ProductName) == "") { ?>
		<th data-name="ProductName" class="<?php echo $vwbroker->ProductName->headerCellClass() ?>" style="white-space: nowrap;"><div id="elh_vwbroker_ProductName" class="vwbroker_ProductName"><div class="ew-table-header-caption"><?php echo $vwbroker->ProductName->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="ProductName" class="<?php echo $vwbroker->ProductName->headerCellClass() ?>" style="white-space: nowrap;"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $vwbroker->SortUrl($vwbroker->ProductName) ?>',2);"><div id="elh_vwbroker_ProductName" class="vwbroker_ProductName">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $vwbroker->ProductName->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($vwbroker->ProductName->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($vwbroker->ProductName->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($vwbroker->Model->Visible) { // Model ?>
	<?php if ($vwbroker->sortUrl($vwbroker->Model) == "") { ?>
		<th data-name="Model" class="<?php echo $vwbroker->Model->headerCellClass() ?>" style="white-space: nowrap;"><div id="elh_vwbroker_Model" class="vwbroker_Model"><div class="ew-table-header-caption"><?php echo $vwbroker->Model->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Model" class="<?php echo $vwbroker->Model->headerCellClass() ?>" style="white-space: nowrap;"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $vwbroker->SortUrl($vwbroker->Model) ?>',2);"><div id="elh_vwbroker_Model" class="vwbroker_Model">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $vwbroker->Model->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($vwbroker->Model->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($vwbroker->Model->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($vwbroker->PCS->Visible) { // PCS ?>
	<?php if ($vwbroker->sortUrl($vwbroker->PCS) == "") { ?>
		<th data-name="PCS" class="<?php echo $vwbroker->PCS->headerCellClass() ?>" style="white-space: nowrap;"><div id="elh_vwbroker_PCS" class="vwbroker_PCS"><div class="ew-table-header-caption"><?php echo $vwbroker->PCS->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="PCS" class="<?php echo $vwbroker->PCS->headerCellClass() ?>" style="white-space: nowrap;"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $vwbroker->SortUrl($vwbroker->PCS) ?>',2);"><div id="elh_vwbroker_PCS" class="vwbroker_PCS">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $vwbroker->PCS->caption() ?></span><span class="ew-table-header-sort"><?php if ($vwbroker->PCS->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($vwbroker->PCS->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($vwbroker->CreateDate->Visible) { // CreateDate ?>
	<?php if ($vwbroker->sortUrl($vwbroker->CreateDate) == "") { ?>
		<th data-name="CreateDate" class="<?php echo $vwbroker->CreateDate->headerCellClass() ?>" style="white-space: nowrap;"><div id="elh_vwbroker_CreateDate" class="vwbroker_CreateDate"><div class="ew-table-header-caption"><?php echo $vwbroker->CreateDate->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="CreateDate" class="<?php echo $vwbroker->CreateDate->headerCellClass() ?>" style="white-space: nowrap;"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $vwbroker->SortUrl($vwbroker->CreateDate) ?>',2);"><div id="elh_vwbroker_CreateDate" class="vwbroker_CreateDate">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $vwbroker->CreateDate->caption() ?></span><span class="ew-table-header-sort"><?php if ($vwbroker->CreateDate->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($vwbroker->CreateDate->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($vwbroker->OrderDate->Visible) { // OrderDate ?>
	<?php if ($vwbroker->sortUrl($vwbroker->OrderDate) == "") { ?>
		<th data-name="OrderDate" class="<?php echo $vwbroker->OrderDate->headerCellClass() ?>"><div id="elh_vwbroker_OrderDate" class="vwbroker_OrderDate"><div class="ew-table-header-caption"><?php echo $vwbroker->OrderDate->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="OrderDate" class="<?php echo $vwbroker->OrderDate->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $vwbroker->SortUrl($vwbroker->OrderDate) ?>',2);"><div id="elh_vwbroker_OrderDate" class="vwbroker_OrderDate">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $vwbroker->OrderDate->caption() ?></span><span class="ew-table-header-sort"><?php if ($vwbroker->OrderDate->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($vwbroker->OrderDate->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$vwbroker_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
if ($vwbroker->ExportAll && $vwbroker->isExport()) {
	$vwbroker_list->StopRec = $vwbroker_list->TotalRecs;
} else {

	// Set the last record to display
	if ($vwbroker_list->TotalRecs > $vwbroker_list->StartRec + $vwbroker_list->DisplayRecs - 1)
		$vwbroker_list->StopRec = $vwbroker_list->StartRec + $vwbroker_list->DisplayRecs - 1;
	else
		$vwbroker_list->StopRec = $vwbroker_list->TotalRecs;
}
$vwbroker_list->RecCnt = $vwbroker_list->StartRec - 1;
if ($vwbroker_list->Recordset && !$vwbroker_list->Recordset->EOF) {
	$vwbroker_list->Recordset->moveFirst();
	$selectLimit = $vwbroker_list->UseSelectLimit;
	if (!$selectLimit && $vwbroker_list->StartRec > 1)
		$vwbroker_list->Recordset->move($vwbroker_list->StartRec - 1);
} elseif (!$vwbroker->AllowAddDeleteRow && $vwbroker_list->StopRec == 0) {
	$vwbroker_list->StopRec = $vwbroker->GridAddRowCount;
}

// Initialize aggregate
$vwbroker->RowType = ROWTYPE_AGGREGATEINIT;
$vwbroker->resetAttributes();
$vwbroker_list->renderRow();
while ($vwbroker_list->RecCnt < $vwbroker_list->StopRec) {
	$vwbroker_list->RecCnt++;
	if ($vwbroker_list->RecCnt >= $vwbroker_list->StartRec) {
		$vwbroker_list->RowCnt++;

		// Set up key count
		$vwbroker_list->KeyCount = $vwbroker_list->RowIndex;

		// Init row class and style
		$vwbroker->resetAttributes();
		$vwbroker->CssClass = "";
		if ($vwbroker->isGridAdd()) {
		} else {
			$vwbroker_list->loadRowValues($vwbroker_list->Recordset); // Load row values
		}
		$vwbroker->RowType = ROWTYPE_VIEW; // Render view

		// Set up row id / data-rowindex
		$vwbroker->RowAttrs = array_merge($vwbroker->RowAttrs, array('data-rowindex'=>$vwbroker_list->RowCnt, 'id'=>'r' . $vwbroker_list->RowCnt . '_vwbroker', 'data-rowtype'=>$vwbroker->RowType));

		// Render row
		$vwbroker_list->renderRow();

		// Render list options
		$vwbroker_list->renderListOptions();
?>
	<tr<?php echo $vwbroker->rowAttributes() ?>>
<?php

// Render list options (body, left)
$vwbroker_list->ListOptions->render("body", "left", $vwbroker_list->RowCnt);
?>
	<?php if ($vwbroker->OrderID->Visible) { // OrderID ?>
		<td data-name="OrderID"<?php echo $vwbroker->OrderID->cellAttributes() ?>>
<span id="el<?php echo $vwbroker_list->RowCnt ?>_vwbroker_OrderID" class="vwbroker_OrderID">
<span<?php echo $vwbroker->OrderID->viewAttributes() ?>>
<?php echo $vwbroker->OrderID->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($vwbroker->ID_Order->Visible) { // ID_Order ?>
		<td data-name="ID_Order"<?php echo $vwbroker->ID_Order->cellAttributes() ?>>
<span id="el<?php echo $vwbroker_list->RowCnt ?>_vwbroker_ID_Order" class="vwbroker_ID_Order">
<span<?php echo $vwbroker->ID_Order->viewAttributes() ?>>
<?php echo $vwbroker->ID_Order->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($vwbroker->CodeContact->Visible) { // CodeContact ?>
		<td data-name="CodeContact"<?php echo $vwbroker->CodeContact->cellAttributes() ?>>
<span id="el<?php echo $vwbroker_list->RowCnt ?>_vwbroker_CodeContact" class="vwbroker_CodeContact">
<span<?php echo $vwbroker->CodeContact->viewAttributes() ?>>
<?php echo $vwbroker->CodeContact->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($vwbroker->CompanyName->Visible) { // CompanyName ?>
		<td data-name="CompanyName"<?php echo $vwbroker->CompanyName->cellAttributes() ?>>
<span id="el<?php echo $vwbroker_list->RowCnt ?>_vwbroker_CompanyName" class="vwbroker_CompanyName">
<span<?php echo $vwbroker->CompanyName->viewAttributes() ?>>
<?php echo $vwbroker->CompanyName->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($vwbroker->Address->Visible) { // Address ?>
		<td data-name="Address"<?php echo $vwbroker->Address->cellAttributes() ?>>
<span id="el<?php echo $vwbroker_list->RowCnt ?>_vwbroker_Address" class="vwbroker_Address">
<span<?php echo $vwbroker->Address->viewAttributes() ?>>
<?php echo $vwbroker->Address->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($vwbroker->TypeName->Visible) { // TypeName ?>
		<td data-name="TypeName"<?php echo $vwbroker->TypeName->cellAttributes() ?>>
<span id="el<?php echo $vwbroker_list->RowCnt ?>_vwbroker_TypeName" class="vwbroker_TypeName">
<span<?php echo $vwbroker->TypeName->viewAttributes() ?>>
<?php echo $vwbroker->TypeName->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($vwbroker->Code->Visible) { // Code ?>
		<td data-name="Code"<?php echo $vwbroker->Code->cellAttributes() ?>>
<span id="el<?php echo $vwbroker_list->RowCnt ?>_vwbroker_Code" class="vwbroker_Code">
<span<?php echo $vwbroker->Code->viewAttributes() ?>>
<?php echo $vwbroker->Code->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($vwbroker->ProductName->Visible) { // ProductName ?>
		<td data-name="ProductName"<?php echo $vwbroker->ProductName->cellAttributes() ?>>
<span id="el<?php echo $vwbroker_list->RowCnt ?>_vwbroker_ProductName" class="vwbroker_ProductName">
<span<?php echo $vwbroker->ProductName->viewAttributes() ?>>
<?php echo $vwbroker->ProductName->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($vwbroker->Model->Visible) { // Model ?>
		<td data-name="Model"<?php echo $vwbroker->Model->cellAttributes() ?>>
<span id="el<?php echo $vwbroker_list->RowCnt ?>_vwbroker_Model" class="vwbroker_Model">
<span<?php echo $vwbroker->Model->viewAttributes() ?>>
<?php echo $vwbroker->Model->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($vwbroker->PCS->Visible) { // PCS ?>
		<td data-name="PCS"<?php echo $vwbroker->PCS->cellAttributes() ?>>
<span id="el<?php echo $vwbroker_list->RowCnt ?>_vwbroker_PCS" class="vwbroker_PCS">
<span<?php echo $vwbroker->PCS->viewAttributes() ?>>
<?php echo $vwbroker->PCS->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($vwbroker->CreateDate->Visible) { // CreateDate ?>
		<td data-name="CreateDate"<?php echo $vwbroker->CreateDate->cellAttributes() ?>>
<span id="el<?php echo $vwbroker_list->RowCnt ?>_vwbroker_CreateDate" class="vwbroker_CreateDate">
<span<?php echo $vwbroker->CreateDate->viewAttributes() ?>>
<?php echo $vwbroker->CreateDate->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($vwbroker->OrderDate->Visible) { // OrderDate ?>
		<td data-name="OrderDate"<?php echo $vwbroker->OrderDate->cellAttributes() ?>>
<span id="el<?php echo $vwbroker_list->RowCnt ?>_vwbroker_OrderDate" class="vwbroker_OrderDate">
<span<?php echo $vwbroker->OrderDate->viewAttributes() ?>>
<?php echo $vwbroker->OrderDate->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$vwbroker_list->ListOptions->render("body", "right", $vwbroker_list->RowCnt);
?>
	</tr>
<?php
	}
	if (!$vwbroker->isGridAdd())
		$vwbroker_list->Recordset->moveNext();
}
?>
</tbody>
<?php

// Render aggregate row
$vwbroker->RowType = ROWTYPE_AGGREGATE;
$vwbroker->resetAttributes();
$vwbroker_list->renderRow();
?>
<?php if ($vwbroker_list->TotalRecs > 0 && !$vwbroker->isGridAdd() && !$vwbroker->isGridEdit()) { ?>
<tfoot><!-- Table footer -->
	<tr class="ew-table-footer">
<?php

// Render list options
$vwbroker_list->renderListOptions();

// Render list options (footer, left)
$vwbroker_list->ListOptions->render("footer", "left");
?>
	<?php if ($vwbroker->OrderID->Visible) { // OrderID ?>
		<td data-name="OrderID" class="<?php echo $vwbroker->OrderID->footerCellClass() ?>"><span id="elf_vwbroker_OrderID" class="vwbroker_OrderID">
		&nbsp;
		</span></td>
	<?php } ?>
	<?php if ($vwbroker->ID_Order->Visible) { // ID_Order ?>
		<td data-name="ID_Order" class="<?php echo $vwbroker->ID_Order->footerCellClass() ?>"><span id="elf_vwbroker_ID_Order" class="vwbroker_ID_Order">
		&nbsp;
		</span></td>
	<?php } ?>
	<?php if ($vwbroker->CodeContact->Visible) { // CodeContact ?>
		<td data-name="CodeContact" class="<?php echo $vwbroker->CodeContact->footerCellClass() ?>"><span id="elf_vwbroker_CodeContact" class="vwbroker_CodeContact">
		&nbsp;
		</span></td>
	<?php } ?>
	<?php if ($vwbroker->CompanyName->Visible) { // CompanyName ?>
		<td data-name="CompanyName" class="<?php echo $vwbroker->CompanyName->footerCellClass() ?>"><span id="elf_vwbroker_CompanyName" class="vwbroker_CompanyName">
		&nbsp;
		</span></td>
	<?php } ?>
	<?php if ($vwbroker->Address->Visible) { // Address ?>
		<td data-name="Address" class="<?php echo $vwbroker->Address->footerCellClass() ?>"><span id="elf_vwbroker_Address" class="vwbroker_Address">
		&nbsp;
		</span></td>
	<?php } ?>
	<?php if ($vwbroker->TypeName->Visible) { // TypeName ?>
		<td data-name="TypeName" class="<?php echo $vwbroker->TypeName->footerCellClass() ?>"><span id="elf_vwbroker_TypeName" class="vwbroker_TypeName">
		&nbsp;
		</span></td>
	<?php } ?>
	<?php if ($vwbroker->Code->Visible) { // Code ?>
		<td data-name="Code" class="<?php echo $vwbroker->Code->footerCellClass() ?>"><span id="elf_vwbroker_Code" class="vwbroker_Code">
		&nbsp;
		</span></td>
	<?php } ?>
	<?php if ($vwbroker->ProductName->Visible) { // ProductName ?>
		<td data-name="ProductName" class="<?php echo $vwbroker->ProductName->footerCellClass() ?>"><span id="elf_vwbroker_ProductName" class="vwbroker_ProductName">
		&nbsp;
		</span></td>
	<?php } ?>
	<?php if ($vwbroker->Model->Visible) { // Model ?>
		<td data-name="Model" class="<?php echo $vwbroker->Model->footerCellClass() ?>"><span id="elf_vwbroker_Model" class="vwbroker_Model">
		&nbsp;
		</span></td>
	<?php } ?>
	<?php if ($vwbroker->PCS->Visible) { // PCS ?>
		<td data-name="PCS" class="<?php echo $vwbroker->PCS->footerCellClass() ?>"><span id="elf_vwbroker_PCS" class="vwbroker_PCS">
		<span class="ew-aggregate"><?php echo $Language->phrase("TOTAL") ?></span><span class="ew-aggregate-value">
		<?php echo $vwbroker->PCS->ViewValue ?></span>
		</span></td>
	<?php } ?>
	<?php if ($vwbroker->CreateDate->Visible) { // CreateDate ?>
		<td data-name="CreateDate" class="<?php echo $vwbroker->CreateDate->footerCellClass() ?>"><span id="elf_vwbroker_CreateDate" class="vwbroker_CreateDate">
		&nbsp;
		</span></td>
	<?php } ?>
	<?php if ($vwbroker->OrderDate->Visible) { // OrderDate ?>
		<td data-name="OrderDate" class="<?php echo $vwbroker->OrderDate->footerCellClass() ?>"><span id="elf_vwbroker_OrderDate" class="vwbroker_OrderDate">
		&nbsp;
		</span></td>
	<?php } ?>
<?php

// Render list options (footer, right)
$vwbroker_list->ListOptions->render("footer", "right");
?>
	</tr>
</tfoot>
<?php } ?>
</table><!-- /.ew-table -->
<?php } ?>
<?php if (!$vwbroker->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</div><!-- /.ew-grid-middle-panel -->
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($vwbroker_list->Recordset)
	$vwbroker_list->Recordset->Close();
?>
<?php if (!$vwbroker->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$vwbroker->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php if (!isset($vwbroker_list->Pager)) $vwbroker_list->Pager = new PrevNextPager($vwbroker_list->StartRec, $vwbroker_list->DisplayRecs, $vwbroker_list->TotalRecs, $vwbroker_list->AutoHidePager) ?>
<?php if ($vwbroker_list->Pager->RecordCount > 0 && $vwbroker_list->Pager->Visible) { ?>
<div class="ew-pager">
<span><?php echo $Language->Phrase("Page") ?>&nbsp;</span>
<div class="ew-prev-next"><div class="input-group input-group-sm">
<div class="input-group-prepend">
<!-- first page button -->
	<?php if ($vwbroker_list->Pager->FirstButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerFirst") ?>" href="<?php echo $vwbroker_list->pageUrl() ?>start=<?php echo $vwbroker_list->Pager->FirstButton->Start ?>"><i class="icon-first ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerFirst") ?>"><i class="icon-first ew-icon"></i></a>
	<?php } ?>
<!-- previous page button -->
	<?php if ($vwbroker_list->Pager->PrevButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerPrevious") ?>" href="<?php echo $vwbroker_list->pageUrl() ?>start=<?php echo $vwbroker_list->Pager->PrevButton->Start ?>"><i class="icon-prev ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerPrevious") ?>"><i class="icon-prev ew-icon"></i></a>
	<?php } ?>
</div>
<!-- current page number -->
	<input class="form-control" type="text" name="<?php echo TABLE_PAGE_NO ?>" value="<?php echo $vwbroker_list->Pager->CurrentPage ?>">
<div class="input-group-append">
<!-- next page button -->
	<?php if ($vwbroker_list->Pager->NextButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerNext") ?>" href="<?php echo $vwbroker_list->pageUrl() ?>start=<?php echo $vwbroker_list->Pager->NextButton->Start ?>"><i class="icon-next ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerNext") ?>"><i class="icon-next ew-icon"></i></a>
	<?php } ?>
<!-- last page button -->
	<?php if ($vwbroker_list->Pager->LastButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerLast") ?>" href="<?php echo $vwbroker_list->pageUrl() ?>start=<?php echo $vwbroker_list->Pager->LastButton->Start ?>"><i class="icon-last ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerLast") ?>"><i class="icon-last ew-icon"></i></a>
	<?php } ?>
</div>
</div>
</div>
<span>&nbsp;<?php echo $Language->Phrase("of") ?>&nbsp;<?php echo $vwbroker_list->Pager->PageCount ?></span>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php if ($vwbroker_list->Pager->RecordCount > 0) { ?>
<div class="ew-pager ew-rec">
	<span><?php echo $Language->Phrase("Record") ?>&nbsp;<?php echo $vwbroker_list->Pager->FromIndex ?>&nbsp;<?php echo $Language->Phrase("To") ?>&nbsp;<?php echo $vwbroker_list->Pager->ToIndex ?>&nbsp;<?php echo $Language->Phrase("Of") ?>&nbsp;<?php echo $vwbroker_list->Pager->RecordCount ?></span>
</div>
<?php } ?>
<?php if ($vwbroker_list->TotalRecs > 0 && (!$vwbroker_list->AutoHidePageSizeSelector || $vwbroker_list->Pager->Visible)) { ?>
<div class="ew-pager">
<input type="hidden" name="t" value="vwbroker">
<select name="<?php echo TABLE_REC_PER_PAGE ?>" class="form-control form-control-sm ew-tooltip" title="<?php echo $Language->phrase("RecordsPerPage") ?>" onchange="this.form.submit();">
<option value="20"<?php if ($vwbroker_list->DisplayRecs == 20) { ?> selected<?php } ?>>20</option>
<option value="50"<?php if ($vwbroker_list->DisplayRecs == 50) { ?> selected<?php } ?>>50</option>
<option value="100"<?php if ($vwbroker_list->DisplayRecs == 100) { ?> selected<?php } ?>>100</option>
<option value="200"<?php if ($vwbroker_list->DisplayRecs == 200) { ?> selected<?php } ?>>200</option>
<option value="500"<?php if ($vwbroker_list->DisplayRecs == 500) { ?> selected<?php } ?>>500</option>
<option value="ALL"<?php if ($vwbroker->getRecordsPerPage() == -1) { ?> selected<?php } ?>><?php echo $Language->Phrase("AllRecords") ?></option>
</select>
</div>
<?php } ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $vwbroker_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($vwbroker_list->TotalRecs == 0 && !$vwbroker->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $vwbroker_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$vwbroker_list->showPageFooter();
if (DEBUG_ENABLED)
	echo GetDebugMessage();
?>
<?php if (!$vwbroker->isExport()) { ?>
<script>

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php if (!$vwbroker->isExport()) { ?>
<script>
ew.scrollableTable("gmp_vwbroker", "100%", "400px");
</script>
<?php } ?>
<?php } ?>
<?php include_once "footer.php" ?>
<?php
$vwbroker_list->terminate();
?>