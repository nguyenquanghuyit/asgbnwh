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
$vwpickingbyorder_list = new vwpickingbyorder_list();

// Run the page
$vwpickingbyorder_list->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$vwpickingbyorder_list->Page_Render();
?>
<?php include_once "header.php" ?>
<?php if (!$vwpickingbyorder->isExport()) { ?>
<script>

// Form object
currentPageID = ew.PAGE_ID = "list";
var fvwpickingbyorderlist = currentForm = new ew.Form("fvwpickingbyorderlist", "list");
fvwpickingbyorderlist.formKeyCountName = '<?php echo $vwpickingbyorder_list->FormKeyCountName ?>';

// Form_CustomValidate event
fvwpickingbyorderlist.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

	// Your custom validation code here, return false if invalid.
	return true;
}

// Use JavaScript validation or not
fvwpickingbyorderlist.validateRequired = <?php echo json_encode(CLIENT_VALIDATE) ?>;

// Dynamic selection lists
fvwpickingbyorderlist.lists["x_TypeName"] = <?php echo $vwpickingbyorder_list->TypeName->Lookup->toClientList() ?>;
fvwpickingbyorderlist.lists["x_TypeName"].options = <?php echo JsonEncode($vwpickingbyorder_list->TypeName->lookupOptions()) ?>;
fvwpickingbyorderlist.lists["x_StatusLoad"] = <?php echo $vwpickingbyorder_list->StatusLoad->Lookup->toClientList() ?>;
fvwpickingbyorderlist.lists["x_StatusLoad"].options = <?php echo JsonEncode($vwpickingbyorder_list->StatusLoad->options(FALSE, TRUE)) ?>;

// Form object for search
var fvwpickingbyorderlistsrch = currentSearchForm = new ew.Form("fvwpickingbyorderlistsrch");

// Validate function for search
fvwpickingbyorderlistsrch.validate = function(fobj) {
	if (!this.validateRequired)
		return true; // Ignore validation
	fobj = fobj || this._form;
	var infix = "";
	elm = this.getElements("x" + infix + "_OrderDate");
	if (elm && !ew.checkEuroDate(elm.value))
		return this.onError(elm, "<?php echo JsEncode($vwpickingbyorder->OrderDate->errorMessage()) ?>");

	// Fire Form_CustomValidate event
	if (!this.Form_CustomValidate(fobj))
		return false;
	return true;
}

// Form_CustomValidate event
fvwpickingbyorderlistsrch.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

	// Your custom validation code here, return false if invalid.
	return true;
}

// Use JavaScript validation or not
fvwpickingbyorderlistsrch.validateRequired = <?php echo json_encode(CLIENT_VALIDATE) ?>;

// Dynamic selection lists
fvwpickingbyorderlistsrch.lists["x_TypeName"] = <?php echo $vwpickingbyorder_list->TypeName->Lookup->toClientList() ?>;
fvwpickingbyorderlistsrch.lists["x_TypeName"].options = <?php echo JsonEncode($vwpickingbyorder_list->TypeName->lookupOptions()) ?>;

// Filters
fvwpickingbyorderlistsrch.filterList = <?php echo $vwpickingbyorder_list->getFilterList() ?>;
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
<?php if (!$vwpickingbyorder->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($vwpickingbyorder_list->TotalRecs > 0 && $vwpickingbyorder_list->ExportOptions->visible()) { ?>
<?php $vwpickingbyorder_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($vwpickingbyorder_list->ImportOptions->visible()) { ?>
<?php $vwpickingbyorder_list->ImportOptions->render("body") ?>
<?php } ?>
<?php if ($vwpickingbyorder_list->SearchOptions->visible()) { ?>
<?php $vwpickingbyorder_list->SearchOptions->render("body") ?>
<?php } ?>
<?php if ($vwpickingbyorder_list->FilterOptions->visible()) { ?>
<?php $vwpickingbyorder_list->FilterOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php
$vwpickingbyorder_list->renderOtherOptions();
?>
<?php if ($Security->CanSearch()) { ?>
<?php if (!$vwpickingbyorder->isExport() && !$vwpickingbyorder->CurrentAction) { ?>
<form name="fvwpickingbyorderlistsrch" id="fvwpickingbyorderlistsrch" class="form-inline ew-form ew-ext-search-form" action="<?php echo CurrentPageName() ?>">
<?php $searchPanelClass = ($vwpickingbyorder_list->SearchWhere <> "") ? " show" : " show"; ?>
<div id="fvwpickingbyorderlistsrch-search-panel" class="ew-search-panel collapse<?php echo $searchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="vwpickingbyorder">
	<div class="ew-basic-search">
<?php
if ($SearchError == "")
	$vwpickingbyorder_list->LoadAdvancedSearch(); // Load advanced search

// Render for search
$vwpickingbyorder->RowType = ROWTYPE_SEARCH;

// Render row
$vwpickingbyorder->resetAttributes();
$vwpickingbyorder_list->renderRow();
?>
<div id="xsr_1" class="ew-row d-sm-flex">
<?php if ($vwpickingbyorder->TypeName->Visible) { // TypeName ?>
	<div id="xsc_TypeName" class="ew-cell form-group">
		<label for="x_TypeName" class="ew-search-caption ew-label"><?php echo $vwpickingbyorder->TypeName->caption() ?></label>
		<span class="ew-search-operator"><?php //echo $Language->phrase("LIKE") ?><input type="hidden" name="z_TypeName" id="z_TypeName" value="LIKE"></span>
		<span class="ew-search-field">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="vwpickingbyorder" data-field="x_TypeName" data-value-separator="<?php echo $vwpickingbyorder->TypeName->displayValueSeparatorAttribute() ?>" id="x_TypeName" name="x_TypeName"<?php echo $vwpickingbyorder->TypeName->editAttributes() ?>>
		<?php echo $vwpickingbyorder->TypeName->selectOptionListHtml("x_TypeName") ?>
	</select>
</div>
<?php echo $vwpickingbyorder->TypeName->Lookup->getParamTag("p_x_TypeName") ?>
</span>
	</div>
<?php } ?>
</div>
<div id="xsr_2" class="ew-row d-sm-flex">
<?php if ($vwpickingbyorder->OrderDate->Visible) { // OrderDate ?>
	<div id="xsc_OrderDate" class="ew-cell form-group">
		<label for="x_OrderDate" class="ew-search-caption ew-label"><?php echo $vwpickingbyorder->OrderDate->caption() ?></label>
		<span class="ew-search-operator"><?php //echo $Language->phrase("BETWEEN") ?><input type="hidden" name="z_OrderDate" id="z_OrderDate" value="BETWEEN"></span>
		<span class="ew-search-field">
<input type="text" data-table="vwpickingbyorder" data-field="x_OrderDate" data-format="7" name="x_OrderDate" id="x_OrderDate" placeholder="<?php echo HtmlEncode($vwpickingbyorder->OrderDate->getPlaceHolder()) ?>" value="<?php echo $vwpickingbyorder->OrderDate->EditValue ?>"<?php echo $vwpickingbyorder->OrderDate->editAttributes() ?>>
<?php if (!$vwpickingbyorder->OrderDate->ReadOnly && !$vwpickingbyorder->OrderDate->Disabled && !isset($vwpickingbyorder->OrderDate->EditAttrs["readonly"]) && !isset($vwpickingbyorder->OrderDate->EditAttrs["disabled"])) { ?>
<script>
ew.createDateTimePicker("fvwpickingbyorderlistsrch", "x_OrderDate", {"ignoreReadonly":true,"useCurrent":false,"format":7});
</script>
<?php } ?>
</span>
		<span class="ew-search-cond btw1_OrderDate"><label><?php echo $Language->Phrase("AND") ?></label></span>
		<span class="ew-search-field btw1_OrderDate">
<input type="text" data-table="vwpickingbyorder" data-field="x_OrderDate" data-format="7" name="y_OrderDate" id="y_OrderDate" placeholder="<?php echo HtmlEncode($vwpickingbyorder->OrderDate->getPlaceHolder()) ?>" value="<?php echo $vwpickingbyorder->OrderDate->EditValue2 ?>"<?php echo $vwpickingbyorder->OrderDate->editAttributes() ?>>
<?php if (!$vwpickingbyorder->OrderDate->ReadOnly && !$vwpickingbyorder->OrderDate->Disabled && !isset($vwpickingbyorder->OrderDate->EditAttrs["readonly"]) && !isset($vwpickingbyorder->OrderDate->EditAttrs["disabled"])) { ?>
<script>
ew.createDateTimePicker("fvwpickingbyorderlistsrch", "y_OrderDate", {"ignoreReadonly":true,"useCurrent":false,"format":7});
</script>
<?php } ?>
</span>
	</div>
<?php } ?>
</div>
<div id="xsr_3" class="ew-row d-sm-flex">
	<div class="ew-quick-search input-group">
		<input type="text" name="<?php echo TABLE_BASIC_SEARCH ?>" id="<?php echo TABLE_BASIC_SEARCH ?>" class="form-control" value="<?php echo HtmlEncode($vwpickingbyorder_list->BasicSearch->getKeyword()) ?>" placeholder="<?php echo HtmlEncode($Language->phrase("Search")) ?>">
		<input type="hidden" name="<?php echo TABLE_BASIC_SEARCH_TYPE ?>" id="<?php echo TABLE_BASIC_SEARCH_TYPE ?>" value="<?php echo HtmlEncode($vwpickingbyorder_list->BasicSearch->getType()) ?>">
		<div class="input-group-append">
			<button class="btn btn-primary" name="btn-submit" id="btn-submit" type="submit"><?php echo $Language->phrase("SearchBtn") ?></button>
			<button type="button" data-toggle="dropdown" class="btn btn-primary dropdown-toggle dropdown-toggle-split" aria-haspopup="true" aria-expanded="false"><span id="searchtype"><?php echo $vwpickingbyorder_list->BasicSearch->getTypeNameShort() ?></span></button>
			<div class="dropdown-menu dropdown-menu-right">
				<a class="dropdown-item<?php if ($vwpickingbyorder_list->BasicSearch->getType() == "") echo " active"; ?>" href="javascript:void(0);" onclick="ew.setSearchType(this)"><?php echo $Language->phrase("QuickSearchAuto") ?></a>
				<a class="dropdown-item<?php if ($vwpickingbyorder_list->BasicSearch->getType() == "=") echo " active"; ?>" href="javascript:void(0);" onclick="ew.setSearchType(this,'=')"><?php echo $Language->phrase("QuickSearchExact") ?></a>
				<a class="dropdown-item<?php if ($vwpickingbyorder_list->BasicSearch->getType() == "AND") echo " active"; ?>" href="javascript:void(0);" onclick="ew.setSearchType(this,'AND')"><?php echo $Language->phrase("QuickSearchAll") ?></a>
				<a class="dropdown-item<?php if ($vwpickingbyorder_list->BasicSearch->getType() == "OR") echo " active"; ?>" href="javascript:void(0);" onclick="ew.setSearchType(this,'OR')"><?php echo $Language->phrase("QuickSearchAny") ?></a>
			</div>
		</div>
	</div>
</div>
	</div>
</div>
</form>
<?php } ?>
<?php } ?>
<?php $vwpickingbyorder_list->showPageHeader(); ?>
<?php
$vwpickingbyorder_list->showMessage();
?>
<?php if ($vwpickingbyorder_list->TotalRecs > 0 || $vwpickingbyorder->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($vwpickingbyorder_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> vwpickingbyorder">
<?php if (!$vwpickingbyorder->isExport()) { ?>
<div class="card-header ew-grid-upper-panel">
<?php if (!$vwpickingbyorder->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php if (!isset($vwpickingbyorder_list->Pager)) $vwpickingbyorder_list->Pager = new PrevNextPager($vwpickingbyorder_list->StartRec, $vwpickingbyorder_list->DisplayRecs, $vwpickingbyorder_list->TotalRecs, $vwpickingbyorder_list->AutoHidePager) ?>
<?php if ($vwpickingbyorder_list->Pager->RecordCount > 0 && $vwpickingbyorder_list->Pager->Visible) { ?>
<div class="ew-pager">
<span><?php echo $Language->Phrase("Page") ?>&nbsp;</span>
<div class="ew-prev-next"><div class="input-group input-group-sm">
<div class="input-group-prepend">
<!-- first page button -->
	<?php if ($vwpickingbyorder_list->Pager->FirstButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerFirst") ?>" href="<?php echo $vwpickingbyorder_list->pageUrl() ?>start=<?php echo $vwpickingbyorder_list->Pager->FirstButton->Start ?>"><i class="icon-first ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerFirst") ?>"><i class="icon-first ew-icon"></i></a>
	<?php } ?>
<!-- previous page button -->
	<?php if ($vwpickingbyorder_list->Pager->PrevButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerPrevious") ?>" href="<?php echo $vwpickingbyorder_list->pageUrl() ?>start=<?php echo $vwpickingbyorder_list->Pager->PrevButton->Start ?>"><i class="icon-prev ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerPrevious") ?>"><i class="icon-prev ew-icon"></i></a>
	<?php } ?>
</div>
<!-- current page number -->
	<input class="form-control" type="text" name="<?php echo TABLE_PAGE_NO ?>" value="<?php echo $vwpickingbyorder_list->Pager->CurrentPage ?>">
<div class="input-group-append">
<!-- next page button -->
	<?php if ($vwpickingbyorder_list->Pager->NextButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerNext") ?>" href="<?php echo $vwpickingbyorder_list->pageUrl() ?>start=<?php echo $vwpickingbyorder_list->Pager->NextButton->Start ?>"><i class="icon-next ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerNext") ?>"><i class="icon-next ew-icon"></i></a>
	<?php } ?>
<!-- last page button -->
	<?php if ($vwpickingbyorder_list->Pager->LastButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerLast") ?>" href="<?php echo $vwpickingbyorder_list->pageUrl() ?>start=<?php echo $vwpickingbyorder_list->Pager->LastButton->Start ?>"><i class="icon-last ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerLast") ?>"><i class="icon-last ew-icon"></i></a>
	<?php } ?>
</div>
</div>
</div>
<span>&nbsp;<?php echo $Language->Phrase("of") ?>&nbsp;<?php echo $vwpickingbyorder_list->Pager->PageCount ?></span>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php if ($vwpickingbyorder_list->Pager->RecordCount > 0) { ?>
<div class="ew-pager ew-rec">
	<span><?php echo $Language->Phrase("Record") ?>&nbsp;<?php echo $vwpickingbyorder_list->Pager->FromIndex ?>&nbsp;<?php echo $Language->Phrase("To") ?>&nbsp;<?php echo $vwpickingbyorder_list->Pager->ToIndex ?>&nbsp;<?php echo $Language->Phrase("Of") ?>&nbsp;<?php echo $vwpickingbyorder_list->Pager->RecordCount ?></span>
</div>
<?php } ?>
<?php if ($vwpickingbyorder_list->TotalRecs > 0 && (!$vwpickingbyorder_list->AutoHidePageSizeSelector || $vwpickingbyorder_list->Pager->Visible)) { ?>
<div class="ew-pager">
<input type="hidden" name="t" value="vwpickingbyorder">
<select name="<?php echo TABLE_REC_PER_PAGE ?>" class="form-control form-control-sm ew-tooltip" title="<?php echo $Language->phrase("RecordsPerPage") ?>" onchange="this.form.submit();">
<option value="20"<?php if ($vwpickingbyorder_list->DisplayRecs == 20) { ?> selected<?php } ?>>20</option>
<option value="50"<?php if ($vwpickingbyorder_list->DisplayRecs == 50) { ?> selected<?php } ?>>50</option>
<option value="100"<?php if ($vwpickingbyorder_list->DisplayRecs == 100) { ?> selected<?php } ?>>100</option>
<option value="200"<?php if ($vwpickingbyorder_list->DisplayRecs == 200) { ?> selected<?php } ?>>200</option>
<option value="500"<?php if ($vwpickingbyorder_list->DisplayRecs == 500) { ?> selected<?php } ?>>500</option>
<option value="ALL"<?php if ($vwpickingbyorder->getRecordsPerPage() == -1) { ?> selected<?php } ?>><?php echo $Language->Phrase("AllRecords") ?></option>
</select>
</div>
<?php } ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $vwpickingbyorder_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
<form name="fvwpickingbyorderlist" id="fvwpickingbyorderlist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($vwpickingbyorder_list->CheckToken) { ?>
<input type="hidden" name="<?php echo TOKEN_NAME ?>" value="<?php echo $vwpickingbyorder_list->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="vwpickingbyorder">
<input type="hidden" name="exporttype" id="exporttype" value="">
<div id="gmp_vwpickingbyorder" class="<?php if (IsResponsiveLayout()) { ?>table-responsive <?php } ?>card-body ew-grid-middle-panel">
<?php if ($vwpickingbyorder_list->TotalRecs > 0 || $vwpickingbyorder->isGridEdit()) { ?>
<table id="tbl_vwpickingbyorderlist" class="table ew-table"><!-- .ew-table ##-->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$vwpickingbyorder_list->RowType = ROWTYPE_HEADER;

// Render list options
$vwpickingbyorder_list->renderListOptions();

// Render list options (header, left)
$vwpickingbyorder_list->ListOptions->render("header", "left");
?>
<?php if ($vwpickingbyorder->ID_Order->Visible) { // ID_Order ?>
	<?php if ($vwpickingbyorder->sortUrl($vwpickingbyorder->ID_Order) == "") { ?>
		<th data-name="ID_Order" class="<?php echo $vwpickingbyorder->ID_Order->headerCellClass() ?>" style="white-space: nowrap;"><div id="elh_vwpickingbyorder_ID_Order" class="vwpickingbyorder_ID_Order"><div class="ew-table-header-caption"><?php echo $vwpickingbyorder->ID_Order->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="ID_Order" class="<?php echo $vwpickingbyorder->ID_Order->headerCellClass() ?>" style="white-space: nowrap;"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $vwpickingbyorder->SortUrl($vwpickingbyorder->ID_Order) ?>',2);"><div id="elh_vwpickingbyorder_ID_Order" class="vwpickingbyorder_ID_Order">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $vwpickingbyorder->ID_Order->caption() ?></span><span class="ew-table-header-sort"><?php if ($vwpickingbyorder->ID_Order->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($vwpickingbyorder->ID_Order->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($vwpickingbyorder->TypeName->Visible) { // TypeName ?>
	<?php if ($vwpickingbyorder->sortUrl($vwpickingbyorder->TypeName) == "") { ?>
		<th data-name="TypeName" class="<?php echo $vwpickingbyorder->TypeName->headerCellClass() ?>"><div id="elh_vwpickingbyorder_TypeName" class="vwpickingbyorder_TypeName"><div class="ew-table-header-caption"><?php echo $vwpickingbyorder->TypeName->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="TypeName" class="<?php echo $vwpickingbyorder->TypeName->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $vwpickingbyorder->SortUrl($vwpickingbyorder->TypeName) ?>',2);"><div id="elh_vwpickingbyorder_TypeName" class="vwpickingbyorder_TypeName">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $vwpickingbyorder->TypeName->caption() ?></span><span class="ew-table-header-sort"><?php if ($vwpickingbyorder->TypeName->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($vwpickingbyorder->TypeName->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($vwpickingbyorder->OrderDate->Visible) { // OrderDate ?>
	<?php if ($vwpickingbyorder->sortUrl($vwpickingbyorder->OrderDate) == "") { ?>
		<th data-name="OrderDate" class="<?php echo $vwpickingbyorder->OrderDate->headerCellClass() ?>" style="white-space: nowrap;"><div id="elh_vwpickingbyorder_OrderDate" class="vwpickingbyorder_OrderDate"><div class="ew-table-header-caption"><?php echo $vwpickingbyorder->OrderDate->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="OrderDate" class="<?php echo $vwpickingbyorder->OrderDate->headerCellClass() ?>" style="white-space: nowrap;"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $vwpickingbyorder->SortUrl($vwpickingbyorder->OrderDate) ?>',2);"><div id="elh_vwpickingbyorder_OrderDate" class="vwpickingbyorder_OrderDate">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $vwpickingbyorder->OrderDate->caption() ?></span><span class="ew-table-header-sort"><?php if ($vwpickingbyorder->OrderDate->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($vwpickingbyorder->OrderDate->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($vwpickingbyorder->ContactName->Visible) { // ContactName ?>
	<?php if ($vwpickingbyorder->sortUrl($vwpickingbyorder->ContactName) == "") { ?>
		<th data-name="ContactName" class="<?php echo $vwpickingbyorder->ContactName->headerCellClass() ?>" style="white-space: nowrap;"><div id="elh_vwpickingbyorder_ContactName" class="vwpickingbyorder_ContactName"><div class="ew-table-header-caption"><?php echo $vwpickingbyorder->ContactName->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="ContactName" class="<?php echo $vwpickingbyorder->ContactName->headerCellClass() ?>" style="white-space: nowrap;"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $vwpickingbyorder->SortUrl($vwpickingbyorder->ContactName) ?>',2);"><div id="elh_vwpickingbyorder_ContactName" class="vwpickingbyorder_ContactName">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $vwpickingbyorder->ContactName->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($vwpickingbyorder->ContactName->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($vwpickingbyorder->ContactName->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($vwpickingbyorder->ContactPhone->Visible) { // ContactPhone ?>
	<?php if ($vwpickingbyorder->sortUrl($vwpickingbyorder->ContactPhone) == "") { ?>
		<th data-name="ContactPhone" class="<?php echo $vwpickingbyorder->ContactPhone->headerCellClass() ?>" style="white-space: nowrap;"><div id="elh_vwpickingbyorder_ContactPhone" class="vwpickingbyorder_ContactPhone"><div class="ew-table-header-caption"><?php echo $vwpickingbyorder->ContactPhone->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="ContactPhone" class="<?php echo $vwpickingbyorder->ContactPhone->headerCellClass() ?>" style="white-space: nowrap;"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $vwpickingbyorder->SortUrl($vwpickingbyorder->ContactPhone) ?>',2);"><div id="elh_vwpickingbyorder_ContactPhone" class="vwpickingbyorder_ContactPhone">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $vwpickingbyorder->ContactPhone->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($vwpickingbyorder->ContactPhone->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($vwpickingbyorder->ContactPhone->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($vwpickingbyorder->CompanyName->Visible) { // CompanyName ?>
	<?php if ($vwpickingbyorder->sortUrl($vwpickingbyorder->CompanyName) == "") { ?>
		<th data-name="CompanyName" class="<?php echo $vwpickingbyorder->CompanyName->headerCellClass() ?>" style="white-space: nowrap;"><div id="elh_vwpickingbyorder_CompanyName" class="vwpickingbyorder_CompanyName"><div class="ew-table-header-caption"><?php echo $vwpickingbyorder->CompanyName->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="CompanyName" class="<?php echo $vwpickingbyorder->CompanyName->headerCellClass() ?>" style="white-space: nowrap;"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $vwpickingbyorder->SortUrl($vwpickingbyorder->CompanyName) ?>',2);"><div id="elh_vwpickingbyorder_CompanyName" class="vwpickingbyorder_CompanyName">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $vwpickingbyorder->CompanyName->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($vwpickingbyorder->CompanyName->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($vwpickingbyorder->CompanyName->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($vwpickingbyorder->StatusLoad->Visible) { // StatusLoad ?>
	<?php if ($vwpickingbyorder->sortUrl($vwpickingbyorder->StatusLoad) == "") { ?>
		<th data-name="StatusLoad" class="<?php echo $vwpickingbyorder->StatusLoad->headerCellClass() ?>" style="white-space: nowrap;"><div id="elh_vwpickingbyorder_StatusLoad" class="vwpickingbyorder_StatusLoad"><div class="ew-table-header-caption"><?php echo $vwpickingbyorder->StatusLoad->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="StatusLoad" class="<?php echo $vwpickingbyorder->StatusLoad->headerCellClass() ?>" style="white-space: nowrap;"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $vwpickingbyorder->SortUrl($vwpickingbyorder->StatusLoad) ?>',2);"><div id="elh_vwpickingbyorder_StatusLoad" class="vwpickingbyorder_StatusLoad">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $vwpickingbyorder->StatusLoad->caption() ?></span><span class="ew-table-header-sort"><?php if ($vwpickingbyorder->StatusLoad->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($vwpickingbyorder->StatusLoad->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$vwpickingbyorder_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
if ($vwpickingbyorder->ExportAll && $vwpickingbyorder->isExport()) {
	$vwpickingbyorder_list->StopRec = $vwpickingbyorder_list->TotalRecs;
} else {

	// Set the last record to display
	if ($vwpickingbyorder_list->TotalRecs > $vwpickingbyorder_list->StartRec + $vwpickingbyorder_list->DisplayRecs - 1)
		$vwpickingbyorder_list->StopRec = $vwpickingbyorder_list->StartRec + $vwpickingbyorder_list->DisplayRecs - 1;
	else
		$vwpickingbyorder_list->StopRec = $vwpickingbyorder_list->TotalRecs;
}
$vwpickingbyorder_list->RecCnt = $vwpickingbyorder_list->StartRec - 1;
if ($vwpickingbyorder_list->Recordset && !$vwpickingbyorder_list->Recordset->EOF) {
	$vwpickingbyorder_list->Recordset->moveFirst();
	$selectLimit = $vwpickingbyorder_list->UseSelectLimit;
	if (!$selectLimit && $vwpickingbyorder_list->StartRec > 1)
		$vwpickingbyorder_list->Recordset->move($vwpickingbyorder_list->StartRec - 1);
} elseif (!$vwpickingbyorder->AllowAddDeleteRow && $vwpickingbyorder_list->StopRec == 0) {
	$vwpickingbyorder_list->StopRec = $vwpickingbyorder->GridAddRowCount;
}

// Initialize aggregate
$vwpickingbyorder->RowType = ROWTYPE_AGGREGATEINIT;
$vwpickingbyorder->resetAttributes();
$vwpickingbyorder_list->renderRow();
while ($vwpickingbyorder_list->RecCnt < $vwpickingbyorder_list->StopRec) {
	$vwpickingbyorder_list->RecCnt++;
	if ($vwpickingbyorder_list->RecCnt >= $vwpickingbyorder_list->StartRec) {
		$vwpickingbyorder_list->RowCnt++;

		// Set up key count
		$vwpickingbyorder_list->KeyCount = $vwpickingbyorder_list->RowIndex;

		// Init row class and style
		$vwpickingbyorder->resetAttributes();
		$vwpickingbyorder->CssClass = "";
		if ($vwpickingbyorder->isGridAdd()) {
		} else {
			$vwpickingbyorder_list->loadRowValues($vwpickingbyorder_list->Recordset); // Load row values
		}
		$vwpickingbyorder->RowType = ROWTYPE_VIEW; // Render view

		// Set up row id / data-rowindex
		$vwpickingbyorder->RowAttrs = array_merge($vwpickingbyorder->RowAttrs, array('data-rowindex'=>$vwpickingbyorder_list->RowCnt, 'id'=>'r' . $vwpickingbyorder_list->RowCnt . '_vwpickingbyorder', 'data-rowtype'=>$vwpickingbyorder->RowType));

		// Render row
		$vwpickingbyorder_list->renderRow();

		// Render list options
		$vwpickingbyorder_list->renderListOptions();
?>
	<tr<?php echo $vwpickingbyorder->rowAttributes() ?>>
<?php

// Render list options (body, left)
$vwpickingbyorder_list->ListOptions->render("body", "left", $vwpickingbyorder_list->RowCnt);
?>
	<?php if ($vwpickingbyorder->ID_Order->Visible) { // ID_Order ?>
		<td data-name="ID_Order"<?php echo $vwpickingbyorder->ID_Order->cellAttributes() ?>>
<span id="el<?php echo $vwpickingbyorder_list->RowCnt ?>_vwpickingbyorder_ID_Order" class="vwpickingbyorder_ID_Order">
<span<?php echo $vwpickingbyorder->ID_Order->viewAttributes() ?>>
<?php echo $vwpickingbyorder->ID_Order->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($vwpickingbyorder->TypeName->Visible) { // TypeName ?>
		<td data-name="TypeName"<?php echo $vwpickingbyorder->TypeName->cellAttributes() ?>>
<span id="el<?php echo $vwpickingbyorder_list->RowCnt ?>_vwpickingbyorder_TypeName" class="vwpickingbyorder_TypeName">
<span<?php echo $vwpickingbyorder->TypeName->viewAttributes() ?>>
<?php echo $vwpickingbyorder->TypeName->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($vwpickingbyorder->OrderDate->Visible) { // OrderDate ?>
		<td data-name="OrderDate"<?php echo $vwpickingbyorder->OrderDate->cellAttributes() ?>>
<span id="el<?php echo $vwpickingbyorder_list->RowCnt ?>_vwpickingbyorder_OrderDate" class="vwpickingbyorder_OrderDate">
<span<?php echo $vwpickingbyorder->OrderDate->viewAttributes() ?>>
<?php echo $vwpickingbyorder->OrderDate->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($vwpickingbyorder->ContactName->Visible) { // ContactName ?>
		<td data-name="ContactName"<?php echo $vwpickingbyorder->ContactName->cellAttributes() ?>>
<span id="el<?php echo $vwpickingbyorder_list->RowCnt ?>_vwpickingbyorder_ContactName" class="vwpickingbyorder_ContactName">
<span<?php echo $vwpickingbyorder->ContactName->viewAttributes() ?>>
<?php echo $vwpickingbyorder->ContactName->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($vwpickingbyorder->ContactPhone->Visible) { // ContactPhone ?>
		<td data-name="ContactPhone"<?php echo $vwpickingbyorder->ContactPhone->cellAttributes() ?>>
<span id="el<?php echo $vwpickingbyorder_list->RowCnt ?>_vwpickingbyorder_ContactPhone" class="vwpickingbyorder_ContactPhone">
<span<?php echo $vwpickingbyorder->ContactPhone->viewAttributes() ?>>
<?php echo $vwpickingbyorder->ContactPhone->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($vwpickingbyorder->CompanyName->Visible) { // CompanyName ?>
		<td data-name="CompanyName"<?php echo $vwpickingbyorder->CompanyName->cellAttributes() ?>>
<span id="el<?php echo $vwpickingbyorder_list->RowCnt ?>_vwpickingbyorder_CompanyName" class="vwpickingbyorder_CompanyName">
<span<?php echo $vwpickingbyorder->CompanyName->viewAttributes() ?>>
<?php echo $vwpickingbyorder->CompanyName->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($vwpickingbyorder->StatusLoad->Visible) { // StatusLoad ?>
		<td data-name="StatusLoad"<?php echo $vwpickingbyorder->StatusLoad->cellAttributes() ?>>
<span id="el<?php echo $vwpickingbyorder_list->RowCnt ?>_vwpickingbyorder_StatusLoad" class="vwpickingbyorder_StatusLoad">
<span<?php echo $vwpickingbyorder->StatusLoad->viewAttributes() ?>>
<?php echo $vwpickingbyorder->StatusLoad->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$vwpickingbyorder_list->ListOptions->render("body", "right", $vwpickingbyorder_list->RowCnt);
?>
	</tr>
<?php
	}
	if (!$vwpickingbyorder->isGridAdd())
		$vwpickingbyorder_list->Recordset->moveNext();
}
?>
</tbody>
</table><!-- /.ew-table -->
<?php } ?>
<?php if (!$vwpickingbyorder->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</div><!-- /.ew-grid-middle-panel -->
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($vwpickingbyorder_list->Recordset)
	$vwpickingbyorder_list->Recordset->Close();
?>
<?php if (!$vwpickingbyorder->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$vwpickingbyorder->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php if (!isset($vwpickingbyorder_list->Pager)) $vwpickingbyorder_list->Pager = new PrevNextPager($vwpickingbyorder_list->StartRec, $vwpickingbyorder_list->DisplayRecs, $vwpickingbyorder_list->TotalRecs, $vwpickingbyorder_list->AutoHidePager) ?>
<?php if ($vwpickingbyorder_list->Pager->RecordCount > 0 && $vwpickingbyorder_list->Pager->Visible) { ?>
<div class="ew-pager">
<span><?php echo $Language->Phrase("Page") ?>&nbsp;</span>
<div class="ew-prev-next"><div class="input-group input-group-sm">
<div class="input-group-prepend">
<!-- first page button -->
	<?php if ($vwpickingbyorder_list->Pager->FirstButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerFirst") ?>" href="<?php echo $vwpickingbyorder_list->pageUrl() ?>start=<?php echo $vwpickingbyorder_list->Pager->FirstButton->Start ?>"><i class="icon-first ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerFirst") ?>"><i class="icon-first ew-icon"></i></a>
	<?php } ?>
<!-- previous page button -->
	<?php if ($vwpickingbyorder_list->Pager->PrevButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerPrevious") ?>" href="<?php echo $vwpickingbyorder_list->pageUrl() ?>start=<?php echo $vwpickingbyorder_list->Pager->PrevButton->Start ?>"><i class="icon-prev ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerPrevious") ?>"><i class="icon-prev ew-icon"></i></a>
	<?php } ?>
</div>
<!-- current page number -->
	<input class="form-control" type="text" name="<?php echo TABLE_PAGE_NO ?>" value="<?php echo $vwpickingbyorder_list->Pager->CurrentPage ?>">
<div class="input-group-append">
<!-- next page button -->
	<?php if ($vwpickingbyorder_list->Pager->NextButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerNext") ?>" href="<?php echo $vwpickingbyorder_list->pageUrl() ?>start=<?php echo $vwpickingbyorder_list->Pager->NextButton->Start ?>"><i class="icon-next ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerNext") ?>"><i class="icon-next ew-icon"></i></a>
	<?php } ?>
<!-- last page button -->
	<?php if ($vwpickingbyorder_list->Pager->LastButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerLast") ?>" href="<?php echo $vwpickingbyorder_list->pageUrl() ?>start=<?php echo $vwpickingbyorder_list->Pager->LastButton->Start ?>"><i class="icon-last ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerLast") ?>"><i class="icon-last ew-icon"></i></a>
	<?php } ?>
</div>
</div>
</div>
<span>&nbsp;<?php echo $Language->Phrase("of") ?>&nbsp;<?php echo $vwpickingbyorder_list->Pager->PageCount ?></span>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php if ($vwpickingbyorder_list->Pager->RecordCount > 0) { ?>
<div class="ew-pager ew-rec">
	<span><?php echo $Language->Phrase("Record") ?>&nbsp;<?php echo $vwpickingbyorder_list->Pager->FromIndex ?>&nbsp;<?php echo $Language->Phrase("To") ?>&nbsp;<?php echo $vwpickingbyorder_list->Pager->ToIndex ?>&nbsp;<?php echo $Language->Phrase("Of") ?>&nbsp;<?php echo $vwpickingbyorder_list->Pager->RecordCount ?></span>
</div>
<?php } ?>
<?php if ($vwpickingbyorder_list->TotalRecs > 0 && (!$vwpickingbyorder_list->AutoHidePageSizeSelector || $vwpickingbyorder_list->Pager->Visible)) { ?>
<div class="ew-pager">
<input type="hidden" name="t" value="vwpickingbyorder">
<select name="<?php echo TABLE_REC_PER_PAGE ?>" class="form-control form-control-sm ew-tooltip" title="<?php echo $Language->phrase("RecordsPerPage") ?>" onchange="this.form.submit();">
<option value="20"<?php if ($vwpickingbyorder_list->DisplayRecs == 20) { ?> selected<?php } ?>>20</option>
<option value="50"<?php if ($vwpickingbyorder_list->DisplayRecs == 50) { ?> selected<?php } ?>>50</option>
<option value="100"<?php if ($vwpickingbyorder_list->DisplayRecs == 100) { ?> selected<?php } ?>>100</option>
<option value="200"<?php if ($vwpickingbyorder_list->DisplayRecs == 200) { ?> selected<?php } ?>>200</option>
<option value="500"<?php if ($vwpickingbyorder_list->DisplayRecs == 500) { ?> selected<?php } ?>>500</option>
<option value="ALL"<?php if ($vwpickingbyorder->getRecordsPerPage() == -1) { ?> selected<?php } ?>><?php echo $Language->Phrase("AllRecords") ?></option>
</select>
</div>
<?php } ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $vwpickingbyorder_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($vwpickingbyorder_list->TotalRecs == 0 && !$vwpickingbyorder->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $vwpickingbyorder_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$vwpickingbyorder_list->showPageFooter();
if (DEBUG_ENABLED)
	echo GetDebugMessage();
?>
<?php if (!$vwpickingbyorder->isExport()) { ?>
<script>

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php } ?>
<?php include_once "footer.php" ?>
<?php
$vwpickingbyorder_list->terminate();
?>