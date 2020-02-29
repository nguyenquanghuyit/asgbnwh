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
$tbl_route_list = new tbl_route_list();

// Run the page
$tbl_route_list->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$tbl_route_list->Page_Render();
?>
<?php include_once "header.php" ?>
<?php if (!$tbl_route->isExport()) { ?>
<script>

// Form object
currentPageID = ew.PAGE_ID = "list";
var ftbl_routelist = currentForm = new ew.Form("ftbl_routelist", "list");
ftbl_routelist.formKeyCountName = '<?php echo $tbl_route_list->FormKeyCountName ?>';

// Form_CustomValidate event
ftbl_routelist.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

	// Your custom validation code here, return false if invalid.
	return true;
}

// Use JavaScript validation or not
ftbl_routelist.validateRequired = <?php echo json_encode(CLIENT_VALIDATE) ?>;

// Dynamic selection lists
ftbl_routelist.lists["x_RouteName"] = <?php echo $tbl_route_list->RouteName->Lookup->toClientList() ?>;
ftbl_routelist.lists["x_RouteName"].options = <?php echo JsonEncode($tbl_route_list->RouteName->options(FALSE, TRUE)) ?>;
ftbl_routelist.lists["x_FinishUnload"] = <?php echo $tbl_route_list->FinishUnload->Lookup->toClientList() ?>;
ftbl_routelist.lists["x_FinishUnload"].options = <?php echo JsonEncode($tbl_route_list->FinishUnload->options(FALSE, TRUE)) ?>;

// Form object for search
var ftbl_routelistsrch = currentSearchForm = new ew.Form("ftbl_routelistsrch");

// Validate function for search
ftbl_routelistsrch.validate = function(fobj) {
	if (!this.validateRequired)
		return true; // Ignore validation
	fobj = fobj || this._form;
	var infix = "";
	elm = this.getElements("x" + infix + "_CreateDate");
	if (elm && !ew.checkEuroDate(elm.value))
		return this.onError(elm, "<?php echo JsEncode($tbl_route->CreateDate->errorMessage()) ?>");

	// Fire Form_CustomValidate event
	if (!this.Form_CustomValidate(fobj))
		return false;
	return true;
}

// Form_CustomValidate event
ftbl_routelistsrch.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

	// Your custom validation code here, return false if invalid.
	return true;
}

// Use JavaScript validation or not
ftbl_routelistsrch.validateRequired = <?php echo json_encode(CLIENT_VALIDATE) ?>;

// Dynamic selection lists
ftbl_routelistsrch.lists["x_FinishUnload"] = <?php echo $tbl_route_list->FinishUnload->Lookup->toClientList() ?>;
ftbl_routelistsrch.lists["x_FinishUnload"].options = <?php echo JsonEncode($tbl_route_list->FinishUnload->options(FALSE, TRUE)) ?>;

// Filters
ftbl_routelistsrch.filterList = <?php echo $tbl_route_list->getFilterList() ?>;
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
<?php if (!$tbl_route->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($tbl_route_list->TotalRecs > 0 && $tbl_route_list->ExportOptions->visible()) { ?>
<?php $tbl_route_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($tbl_route_list->ImportOptions->visible()) { ?>
<?php $tbl_route_list->ImportOptions->render("body") ?>
<?php } ?>
<?php if ($tbl_route_list->SearchOptions->visible()) { ?>
<?php $tbl_route_list->SearchOptions->render("body") ?>
<?php } ?>
<?php if ($tbl_route_list->FilterOptions->visible()) { ?>
<?php $tbl_route_list->FilterOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php
$tbl_route_list->renderOtherOptions();
?>
<?php if ($Security->CanSearch()) { ?>
<?php if (!$tbl_route->isExport() && !$tbl_route->CurrentAction) { ?>
<form name="ftbl_routelistsrch" id="ftbl_routelistsrch" class="form-inline ew-form ew-ext-search-form" action="<?php echo CurrentPageName() ?>">
<?php $searchPanelClass = ($tbl_route_list->SearchWhere <> "") ? " show" : " show"; ?>
<div id="ftbl_routelistsrch-search-panel" class="ew-search-panel collapse<?php echo $searchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="tbl_route">
	<div class="ew-basic-search">
<?php
if ($SearchError == "")
	$tbl_route_list->LoadAdvancedSearch(); // Load advanced search

// Render for search
$tbl_route->RowType = ROWTYPE_SEARCH;

// Render row
$tbl_route->resetAttributes();
$tbl_route_list->renderRow();
?>
<div id="xsr_1" class="ew-row d-sm-flex">
<?php if ($tbl_route->CreateDate->Visible) { // CreateDate ?>
	<div id="xsc_CreateDate" class="ew-cell form-group">
		<label for="x_CreateDate" class="ew-search-caption ew-label"><?php echo $tbl_route->CreateDate->caption() ?></label>
		<span class="ew-search-operator"><?php echo $Language->phrase("BETWEEN") ?><input type="hidden" name="z_CreateDate" id="z_CreateDate" value="BETWEEN"></span>
		<span class="ew-search-field">
<input type="text" data-table="tbl_route" data-field="x_CreateDate" data-format="11" name="x_CreateDate" id="x_CreateDate" placeholder="<?php echo HtmlEncode($tbl_route->CreateDate->getPlaceHolder()) ?>" value="<?php echo $tbl_route->CreateDate->EditValue ?>"<?php echo $tbl_route->CreateDate->editAttributes() ?>>
<?php if (!$tbl_route->CreateDate->ReadOnly && !$tbl_route->CreateDate->Disabled && !isset($tbl_route->CreateDate->EditAttrs["readonly"]) && !isset($tbl_route->CreateDate->EditAttrs["disabled"])) { ?>
<script>
ew.createDateTimePicker("ftbl_routelistsrch", "x_CreateDate", {"ignoreReadonly":true,"useCurrent":false,"format":11});
</script>
<?php } ?>
</span>
		<span class="ew-search-cond btw1_CreateDate"><label><?php echo $Language->Phrase("AND") ?></label></span>
		<span class="ew-search-field btw1_CreateDate">
<input type="text" data-table="tbl_route" data-field="x_CreateDate" data-format="11" name="y_CreateDate" id="y_CreateDate" placeholder="<?php echo HtmlEncode($tbl_route->CreateDate->getPlaceHolder()) ?>" value="<?php echo $tbl_route->CreateDate->EditValue2 ?>"<?php echo $tbl_route->CreateDate->editAttributes() ?>>
<?php if (!$tbl_route->CreateDate->ReadOnly && !$tbl_route->CreateDate->Disabled && !isset($tbl_route->CreateDate->EditAttrs["readonly"]) && !isset($tbl_route->CreateDate->EditAttrs["disabled"])) { ?>
<script>
ew.createDateTimePicker("ftbl_routelistsrch", "y_CreateDate", {"ignoreReadonly":true,"useCurrent":false,"format":11});
</script>
<?php } ?>
</span>
	</div>
<?php } ?>
</div>
<div id="xsr_2" class="ew-row d-sm-flex">
<?php if ($tbl_route->FinishUnload->Visible) { // FinishUnload ?>
	<div id="xsc_FinishUnload" class="ew-cell form-group">
		<label for="x_FinishUnload" class="ew-search-caption ew-label"><?php echo $tbl_route->FinishUnload->caption() ?></label>
		<span class="ew-search-operator"><?php echo $Language->phrase("=") ?><input type="hidden" name="z_FinishUnload" id="z_FinishUnload" value="="></span>
		<span class="ew-search-field">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="tbl_route" data-field="x_FinishUnload" data-value-separator="<?php echo $tbl_route->FinishUnload->displayValueSeparatorAttribute() ?>" id="x_FinishUnload" name="x_FinishUnload"<?php echo $tbl_route->FinishUnload->editAttributes() ?>>
		<?php echo $tbl_route->FinishUnload->selectOptionListHtml("x_FinishUnload") ?>
	</select>
</div>
</span>
	</div>
<?php } ?>
</div>
<div id="xsr_3" class="ew-row d-sm-flex">
	<div class="ew-quick-search input-group">
		<input type="text" name="<?php echo TABLE_BASIC_SEARCH ?>" id="<?php echo TABLE_BASIC_SEARCH ?>" class="form-control" value="<?php echo HtmlEncode($tbl_route_list->BasicSearch->getKeyword()) ?>" placeholder="<?php echo HtmlEncode($Language->phrase("Search")) ?>">
		<input type="hidden" name="<?php echo TABLE_BASIC_SEARCH_TYPE ?>" id="<?php echo TABLE_BASIC_SEARCH_TYPE ?>" value="<?php echo HtmlEncode($tbl_route_list->BasicSearch->getType()) ?>">
		<div class="input-group-append">
			<button class="btn btn-primary" name="btn-submit" id="btn-submit" type="submit"><?php echo $Language->phrase("SearchBtn") ?></button>
			<button type="button" data-toggle="dropdown" class="btn btn-primary dropdown-toggle dropdown-toggle-split" aria-haspopup="true" aria-expanded="false"><span id="searchtype"><?php echo $tbl_route_list->BasicSearch->getTypeNameShort() ?></span></button>
			<div class="dropdown-menu dropdown-menu-right">
				<a class="dropdown-item<?php if ($tbl_route_list->BasicSearch->getType() == "") echo " active"; ?>" href="javascript:void(0);" onclick="ew.setSearchType(this)"><?php echo $Language->phrase("QuickSearchAuto") ?></a>
				<a class="dropdown-item<?php if ($tbl_route_list->BasicSearch->getType() == "=") echo " active"; ?>" href="javascript:void(0);" onclick="ew.setSearchType(this,'=')"><?php echo $Language->phrase("QuickSearchExact") ?></a>
				<a class="dropdown-item<?php if ($tbl_route_list->BasicSearch->getType() == "AND") echo " active"; ?>" href="javascript:void(0);" onclick="ew.setSearchType(this,'AND')"><?php echo $Language->phrase("QuickSearchAll") ?></a>
				<a class="dropdown-item<?php if ($tbl_route_list->BasicSearch->getType() == "OR") echo " active"; ?>" href="javascript:void(0);" onclick="ew.setSearchType(this,'OR')"><?php echo $Language->phrase("QuickSearchAny") ?></a>
			</div>
		</div>
	</div>
</div>
	</div>
</div>
</form>
<?php } ?>
<?php } ?>
<?php $tbl_route_list->showPageHeader(); ?>
<?php
$tbl_route_list->showMessage();
?>
<?php if ($tbl_route_list->TotalRecs > 0 || $tbl_route->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($tbl_route_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> tbl_route">
<?php if (!$tbl_route->isExport()) { ?>
<div class="card-header ew-grid-upper-panel">
<?php if (!$tbl_route->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php if (!isset($tbl_route_list->Pager)) $tbl_route_list->Pager = new PrevNextPager($tbl_route_list->StartRec, $tbl_route_list->DisplayRecs, $tbl_route_list->TotalRecs, $tbl_route_list->AutoHidePager) ?>
<?php if ($tbl_route_list->Pager->RecordCount > 0 && $tbl_route_list->Pager->Visible) { ?>
<div class="ew-pager">
<span><?php echo $Language->Phrase("Page") ?>&nbsp;</span>
<div class="ew-prev-next"><div class="input-group input-group-sm">
<div class="input-group-prepend">
<!-- first page button -->
	<?php if ($tbl_route_list->Pager->FirstButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerFirst") ?>" href="<?php echo $tbl_route_list->pageUrl() ?>start=<?php echo $tbl_route_list->Pager->FirstButton->Start ?>"><i class="icon-first ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerFirst") ?>"><i class="icon-first ew-icon"></i></a>
	<?php } ?>
<!-- previous page button -->
	<?php if ($tbl_route_list->Pager->PrevButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerPrevious") ?>" href="<?php echo $tbl_route_list->pageUrl() ?>start=<?php echo $tbl_route_list->Pager->PrevButton->Start ?>"><i class="icon-prev ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerPrevious") ?>"><i class="icon-prev ew-icon"></i></a>
	<?php } ?>
</div>
<!-- current page number -->
	<input class="form-control" type="text" name="<?php echo TABLE_PAGE_NO ?>" value="<?php echo $tbl_route_list->Pager->CurrentPage ?>">
<div class="input-group-append">
<!-- next page button -->
	<?php if ($tbl_route_list->Pager->NextButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerNext") ?>" href="<?php echo $tbl_route_list->pageUrl() ?>start=<?php echo $tbl_route_list->Pager->NextButton->Start ?>"><i class="icon-next ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerNext") ?>"><i class="icon-next ew-icon"></i></a>
	<?php } ?>
<!-- last page button -->
	<?php if ($tbl_route_list->Pager->LastButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerLast") ?>" href="<?php echo $tbl_route_list->pageUrl() ?>start=<?php echo $tbl_route_list->Pager->LastButton->Start ?>"><i class="icon-last ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerLast") ?>"><i class="icon-last ew-icon"></i></a>
	<?php } ?>
</div>
</div>
</div>
<span>&nbsp;<?php echo $Language->Phrase("of") ?>&nbsp;<?php echo $tbl_route_list->Pager->PageCount ?></span>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php if ($tbl_route_list->Pager->RecordCount > 0) { ?>
<div class="ew-pager ew-rec">
	<span><?php echo $Language->Phrase("Record") ?>&nbsp;<?php echo $tbl_route_list->Pager->FromIndex ?>&nbsp;<?php echo $Language->Phrase("To") ?>&nbsp;<?php echo $tbl_route_list->Pager->ToIndex ?>&nbsp;<?php echo $Language->Phrase("Of") ?>&nbsp;<?php echo $tbl_route_list->Pager->RecordCount ?></span>
</div>
<?php } ?>
<?php if ($tbl_route_list->TotalRecs > 0 && (!$tbl_route_list->AutoHidePageSizeSelector || $tbl_route_list->Pager->Visible)) { ?>
<div class="ew-pager">
<input type="hidden" name="t" value="tbl_route">
<select name="<?php echo TABLE_REC_PER_PAGE ?>" class="form-control form-control-sm ew-tooltip" title="<?php echo $Language->phrase("RecordsPerPage") ?>" onchange="this.form.submit();">
<option value="20"<?php if ($tbl_route_list->DisplayRecs == 20) { ?> selected<?php } ?>>20</option>
<option value="50"<?php if ($tbl_route_list->DisplayRecs == 50) { ?> selected<?php } ?>>50</option>
<option value="100"<?php if ($tbl_route_list->DisplayRecs == 100) { ?> selected<?php } ?>>100</option>
<option value="200"<?php if ($tbl_route_list->DisplayRecs == 200) { ?> selected<?php } ?>>200</option>
<option value="500"<?php if ($tbl_route_list->DisplayRecs == 500) { ?> selected<?php } ?>>500</option>
<option value="ALL"<?php if ($tbl_route->getRecordsPerPage() == -1) { ?> selected<?php } ?>><?php echo $Language->Phrase("AllRecords") ?></option>
</select>
</div>
<?php } ?>
</form>
<?php } ?>
<span><div data-toggle="modal" data-target="#myModal" class="btn btn-outline-danger btnx" thongtin="tooltip" title="Import excel (*.xlsx) file type)">Import Excel</div></span>
<span align="right"><a href="ImportPlan.xlsx" class="btn btn-outline-danger btnxx" thongtin="tooltip" title="Download template excel file">Template</a></span>
<div class="ew-list-other-options">
<?php $tbl_route_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
<form name="ftbl_routelist" id="ftbl_routelist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($tbl_route_list->CheckToken) { ?>
<input type="hidden" name="<?php echo TOKEN_NAME ?>" value="<?php echo $tbl_route_list->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="tbl_route">
<input type="hidden" name="exporttype" id="exporttype" value="">
<div id="gmp_tbl_route" class="<?php if (IsResponsiveLayout()) { ?>table-responsive <?php } ?>card-body ew-grid-middle-panel">
<?php if ($tbl_route_list->TotalRecs > 0 || $tbl_route->isGridEdit()) { ?>
<table id="tbl_tbl_routelist" class="table ew-table"><!-- .ew-table ##-->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$tbl_route_list->RowType = ROWTYPE_HEADER;

// Render list options
$tbl_route_list->renderListOptions();

// Render list options (header, left)
$tbl_route_list->ListOptions->render("header", "left");
?>
<?php if ($tbl_route->RouteName->Visible) { // RouteName ?>
	<?php if ($tbl_route->sortUrl($tbl_route->RouteName) == "") { ?>
		<th data-name="RouteName" class="<?php echo $tbl_route->RouteName->headerCellClass() ?>" style="white-space: nowrap;"><div id="elh_tbl_route_RouteName" class="tbl_route_RouteName"><div class="ew-table-header-caption"><?php echo $tbl_route->RouteName->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="RouteName" class="<?php echo $tbl_route->RouteName->headerCellClass() ?>" style="white-space: nowrap;"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $tbl_route->SortUrl($tbl_route->RouteName) ?>',2);"><div id="elh_tbl_route_RouteName" class="tbl_route_RouteName">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $tbl_route->RouteName->caption() ?></span><span class="ew-table-header-sort"><?php if ($tbl_route->RouteName->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($tbl_route->RouteName->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($tbl_route->TruckNo->Visible) { // TruckNo ?>
	<?php if ($tbl_route->sortUrl($tbl_route->TruckNo) == "") { ?>
		<th data-name="TruckNo" class="<?php echo $tbl_route->TruckNo->headerCellClass() ?>" style="white-space: nowrap;"><div id="elh_tbl_route_TruckNo" class="tbl_route_TruckNo"><div class="ew-table-header-caption"><?php echo $tbl_route->TruckNo->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="TruckNo" class="<?php echo $tbl_route->TruckNo->headerCellClass() ?>" style="white-space: nowrap;"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $tbl_route->SortUrl($tbl_route->TruckNo) ?>',2);"><div id="elh_tbl_route_TruckNo" class="tbl_route_TruckNo">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $tbl_route->TruckNo->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($tbl_route->TruckNo->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($tbl_route->TruckNo->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($tbl_route->DriverName->Visible) { // DriverName ?>
	<?php if ($tbl_route->sortUrl($tbl_route->DriverName) == "") { ?>
		<th data-name="DriverName" class="<?php echo $tbl_route->DriverName->headerCellClass() ?>" style="white-space: nowrap;"><div id="elh_tbl_route_DriverName" class="tbl_route_DriverName"><div class="ew-table-header-caption"><?php echo $tbl_route->DriverName->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="DriverName" class="<?php echo $tbl_route->DriverName->headerCellClass() ?>" style="white-space: nowrap;"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $tbl_route->SortUrl($tbl_route->DriverName) ?>',2);"><div id="elh_tbl_route_DriverName" class="tbl_route_DriverName">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $tbl_route->DriverName->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($tbl_route->DriverName->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($tbl_route->DriverName->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($tbl_route->DriverMobile->Visible) { // DriverMobile ?>
	<?php if ($tbl_route->sortUrl($tbl_route->DriverMobile) == "") { ?>
		<th data-name="DriverMobile" class="<?php echo $tbl_route->DriverMobile->headerCellClass() ?>" style="white-space: nowrap;"><div id="elh_tbl_route_DriverMobile" class="tbl_route_DriverMobile"><div class="ew-table-header-caption"><?php echo $tbl_route->DriverMobile->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="DriverMobile" class="<?php echo $tbl_route->DriverMobile->headerCellClass() ?>" style="white-space: nowrap;"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $tbl_route->SortUrl($tbl_route->DriverMobile) ?>',2);"><div id="elh_tbl_route_DriverMobile" class="tbl_route_DriverMobile">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $tbl_route->DriverMobile->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($tbl_route->DriverMobile->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($tbl_route->DriverMobile->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($tbl_route->InvoiceNo->Visible) { // InvoiceNo ?>
	<?php if ($tbl_route->sortUrl($tbl_route->InvoiceNo) == "") { ?>
		<th data-name="InvoiceNo" class="<?php echo $tbl_route->InvoiceNo->headerCellClass() ?>" style="white-space: nowrap;"><div id="elh_tbl_route_InvoiceNo" class="tbl_route_InvoiceNo"><div class="ew-table-header-caption"><?php echo $tbl_route->InvoiceNo->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="InvoiceNo" class="<?php echo $tbl_route->InvoiceNo->headerCellClass() ?>" style="white-space: nowrap;"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $tbl_route->SortUrl($tbl_route->InvoiceNo) ?>',2);"><div id="elh_tbl_route_InvoiceNo" class="tbl_route_InvoiceNo">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $tbl_route->InvoiceNo->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($tbl_route->InvoiceNo->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($tbl_route->InvoiceNo->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($tbl_route->InvoiceDate->Visible) { // InvoiceDate ?>
	<?php if ($tbl_route->sortUrl($tbl_route->InvoiceDate) == "") { ?>
		<th data-name="InvoiceDate" class="<?php echo $tbl_route->InvoiceDate->headerCellClass() ?>" style="white-space: nowrap;"><div id="elh_tbl_route_InvoiceDate" class="tbl_route_InvoiceDate"><div class="ew-table-header-caption"><?php echo $tbl_route->InvoiceDate->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="InvoiceDate" class="<?php echo $tbl_route->InvoiceDate->headerCellClass() ?>" style="white-space: nowrap;"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $tbl_route->SortUrl($tbl_route->InvoiceDate) ?>',2);"><div id="elh_tbl_route_InvoiceDate" class="tbl_route_InvoiceDate">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $tbl_route->InvoiceDate->caption() ?></span><span class="ew-table-header-sort"><?php if ($tbl_route->InvoiceDate->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($tbl_route->InvoiceDate->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($tbl_route->CreateUser->Visible) { // CreateUser ?>
	<?php if ($tbl_route->sortUrl($tbl_route->CreateUser) == "") { ?>
		<th data-name="CreateUser" class="<?php echo $tbl_route->CreateUser->headerCellClass() ?>" style="white-space: nowrap;"><div id="elh_tbl_route_CreateUser" class="tbl_route_CreateUser"><div class="ew-table-header-caption"><?php echo $tbl_route->CreateUser->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="CreateUser" class="<?php echo $tbl_route->CreateUser->headerCellClass() ?>" style="white-space: nowrap;"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $tbl_route->SortUrl($tbl_route->CreateUser) ?>',2);"><div id="elh_tbl_route_CreateUser" class="tbl_route_CreateUser">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $tbl_route->CreateUser->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($tbl_route->CreateUser->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($tbl_route->CreateUser->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($tbl_route->CreateDate->Visible) { // CreateDate ?>
	<?php if ($tbl_route->sortUrl($tbl_route->CreateDate) == "") { ?>
		<th data-name="CreateDate" class="<?php echo $tbl_route->CreateDate->headerCellClass() ?>" style="white-space: nowrap;"><div id="elh_tbl_route_CreateDate" class="tbl_route_CreateDate"><div class="ew-table-header-caption"><?php echo $tbl_route->CreateDate->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="CreateDate" class="<?php echo $tbl_route->CreateDate->headerCellClass() ?>" style="white-space: nowrap;"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $tbl_route->SortUrl($tbl_route->CreateDate) ?>',2);"><div id="elh_tbl_route_CreateDate" class="tbl_route_CreateDate">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $tbl_route->CreateDate->caption() ?></span><span class="ew-table-header-sort"><?php if ($tbl_route->CreateDate->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($tbl_route->CreateDate->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($tbl_route->FinishUnload->Visible) { // FinishUnload ?>
	<?php if ($tbl_route->sortUrl($tbl_route->FinishUnload) == "") { ?>
		<th data-name="FinishUnload" class="<?php echo $tbl_route->FinishUnload->headerCellClass() ?>" style="white-space: nowrap;"><div id="elh_tbl_route_FinishUnload" class="tbl_route_FinishUnload"><div class="ew-table-header-caption"><?php echo $tbl_route->FinishUnload->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="FinishUnload" class="<?php echo $tbl_route->FinishUnload->headerCellClass() ?>" style="white-space: nowrap;"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $tbl_route->SortUrl($tbl_route->FinishUnload) ?>',2);"><div id="elh_tbl_route_FinishUnload" class="tbl_route_FinishUnload">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $tbl_route->FinishUnload->caption() ?></span><span class="ew-table-header-sort"><?php if ($tbl_route->FinishUnload->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($tbl_route->FinishUnload->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($tbl_route->SealNo->Visible) { // SealNo ?>
	<?php if ($tbl_route->sortUrl($tbl_route->SealNo) == "") { ?>
		<th data-name="SealNo" class="<?php echo $tbl_route->SealNo->headerCellClass() ?>" style="white-space: nowrap;"><div id="elh_tbl_route_SealNo" class="tbl_route_SealNo"><div class="ew-table-header-caption"><?php echo $tbl_route->SealNo->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="SealNo" class="<?php echo $tbl_route->SealNo->headerCellClass() ?>" style="white-space: nowrap;"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $tbl_route->SortUrl($tbl_route->SealNo) ?>',2);"><div id="elh_tbl_route_SealNo" class="tbl_route_SealNo">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $tbl_route->SealNo->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($tbl_route->SealNo->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($tbl_route->SealNo->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($tbl_route->AttachFile->Visible) { // AttachFile ?>
	<?php if ($tbl_route->sortUrl($tbl_route->AttachFile) == "") { ?>
		<th data-name="AttachFile" class="<?php echo $tbl_route->AttachFile->headerCellClass() ?>"><div id="elh_tbl_route_AttachFile" class="tbl_route_AttachFile"><div class="ew-table-header-caption"><?php echo $tbl_route->AttachFile->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="AttachFile" class="<?php echo $tbl_route->AttachFile->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $tbl_route->SortUrl($tbl_route->AttachFile) ?>',2);"><div id="elh_tbl_route_AttachFile" class="tbl_route_AttachFile">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $tbl_route->AttachFile->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($tbl_route->AttachFile->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($tbl_route->AttachFile->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>

<?php

// Render list options (header, right)
$tbl_route_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
if ($tbl_route->ExportAll && $tbl_route->isExport()) {
	$tbl_route_list->StopRec = $tbl_route_list->TotalRecs;
} else {

	// Set the last record to display
	if ($tbl_route_list->TotalRecs > $tbl_route_list->StartRec + $tbl_route_list->DisplayRecs - 1)
		$tbl_route_list->StopRec = $tbl_route_list->StartRec + $tbl_route_list->DisplayRecs - 1;
	else
		$tbl_route_list->StopRec = $tbl_route_list->TotalRecs;
}
$tbl_route_list->RecCnt = $tbl_route_list->StartRec - 1;
if ($tbl_route_list->Recordset && !$tbl_route_list->Recordset->EOF) {
	$tbl_route_list->Recordset->moveFirst();
	$selectLimit = $tbl_route_list->UseSelectLimit;
	if (!$selectLimit && $tbl_route_list->StartRec > 1)
		$tbl_route_list->Recordset->move($tbl_route_list->StartRec - 1);
} elseif (!$tbl_route->AllowAddDeleteRow && $tbl_route_list->StopRec == 0) {
	$tbl_route_list->StopRec = $tbl_route->GridAddRowCount;
}

// Initialize aggregate
$tbl_route->RowType = ROWTYPE_AGGREGATEINIT;
$tbl_route->resetAttributes();
$tbl_route_list->renderRow();
while ($tbl_route_list->RecCnt < $tbl_route_list->StopRec) {
	$tbl_route_list->RecCnt++;
	if ($tbl_route_list->RecCnt >= $tbl_route_list->StartRec) {
		$tbl_route_list->RowCnt++;

		// Set up key count
		$tbl_route_list->KeyCount = $tbl_route_list->RowIndex;

		// Init row class and style
		$tbl_route->resetAttributes();
		$tbl_route->CssClass = "";
		if ($tbl_route->isGridAdd()) {
		} else {
			$tbl_route_list->loadRowValues($tbl_route_list->Recordset); // Load row values
		}
		$tbl_route->RowType = ROWTYPE_VIEW; // Render view

		// Set up row id / data-rowindex
		$tbl_route->RowAttrs = array_merge($tbl_route->RowAttrs, array('data-rowindex'=>$tbl_route_list->RowCnt, 'id'=>'r' . $tbl_route_list->RowCnt . '_tbl_route', 'data-rowtype'=>$tbl_route->RowType));

		// Render row
		$tbl_route_list->renderRow();

		// Render list options
		$tbl_route_list->renderListOptions();
?>
	<tr<?php echo $tbl_route->rowAttributes() ?>>
<?php

// Render list options (body, left)
$tbl_route_list->ListOptions->render("body", "left", $tbl_route_list->RowCnt);
?>
	<?php if ($tbl_route->RouteName->Visible) { // RouteName ?>
		<td data-name="RouteName"<?php echo $tbl_route->RouteName->cellAttributes() ?>>
<span id="el<?php echo $tbl_route_list->RowCnt ?>_tbl_route_RouteName" class="tbl_route_RouteName">
<span<?php echo $tbl_route->RouteName->viewAttributes() ?>>
<?php echo $tbl_route->RouteName->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($tbl_route->TruckNo->Visible) { // TruckNo ?>
		<td data-name="TruckNo"<?php echo $tbl_route->TruckNo->cellAttributes() ?>>
<span id="el<?php echo $tbl_route_list->RowCnt ?>_tbl_route_TruckNo" class="tbl_route_TruckNo">
<span<?php echo $tbl_route->TruckNo->viewAttributes() ?>>
<?php echo $tbl_route->TruckNo->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($tbl_route->DriverName->Visible) { // DriverName ?>
		<td data-name="DriverName"<?php echo $tbl_route->DriverName->cellAttributes() ?>>
<span id="el<?php echo $tbl_route_list->RowCnt ?>_tbl_route_DriverName" class="tbl_route_DriverName">
<span<?php echo $tbl_route->DriverName->viewAttributes() ?>>
<?php echo $tbl_route->DriverName->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($tbl_route->DriverMobile->Visible) { // DriverMobile ?>
		<td data-name="DriverMobile"<?php echo $tbl_route->DriverMobile->cellAttributes() ?>>
<span id="el<?php echo $tbl_route_list->RowCnt ?>_tbl_route_DriverMobile" class="tbl_route_DriverMobile">
<span<?php echo $tbl_route->DriverMobile->viewAttributes() ?>>
<?php echo $tbl_route->DriverMobile->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($tbl_route->InvoiceNo->Visible) { // InvoiceNo ?>
		<td data-name="InvoiceNo"<?php echo $tbl_route->InvoiceNo->cellAttributes() ?>>
<span id="el<?php echo $tbl_route_list->RowCnt ?>_tbl_route_InvoiceNo" class="tbl_route_InvoiceNo">
<span<?php echo $tbl_route->InvoiceNo->viewAttributes() ?>>
<?php echo $tbl_route->InvoiceNo->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($tbl_route->InvoiceDate->Visible) { // InvoiceDate ?>
		<td data-name="InvoiceDate"<?php echo $tbl_route->InvoiceDate->cellAttributes() ?>>
<span id="el<?php echo $tbl_route_list->RowCnt ?>_tbl_route_InvoiceDate" class="tbl_route_InvoiceDate">
<span<?php echo $tbl_route->InvoiceDate->viewAttributes() ?>>
<?php echo $tbl_route->InvoiceDate->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($tbl_route->CreateUser->Visible) { // CreateUser ?>
		<td data-name="CreateUser"<?php echo $tbl_route->CreateUser->cellAttributes() ?>>
<span id="el<?php echo $tbl_route_list->RowCnt ?>_tbl_route_CreateUser" class="tbl_route_CreateUser">
<span<?php echo $tbl_route->CreateUser->viewAttributes() ?>>
<?php echo $tbl_route->CreateUser->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($tbl_route->CreateDate->Visible) { // CreateDate ?>
		<td data-name="CreateDate"<?php echo $tbl_route->CreateDate->cellAttributes() ?>>
<span id="el<?php echo $tbl_route_list->RowCnt ?>_tbl_route_CreateDate" class="tbl_route_CreateDate">
<span<?php echo $tbl_route->CreateDate->viewAttributes() ?>>
<?php echo $tbl_route->CreateDate->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($tbl_route->FinishUnload->Visible) { // FinishUnload ?>
		<td data-name="FinishUnload"<?php echo $tbl_route->FinishUnload->cellAttributes() ?>>
<span id="el<?php echo $tbl_route_list->RowCnt ?>_tbl_route_FinishUnload" class="tbl_route_FinishUnload">
<span<?php echo $tbl_route->FinishUnload->viewAttributes() ?>>
<?php echo $tbl_route->FinishUnload->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($tbl_route->SealNo->Visible) { // SealNo ?>
		<td data-name="SealNo"<?php echo $tbl_route->SealNo->cellAttributes() ?>>
<span id="el<?php echo $tbl_route_list->RowCnt ?>_tbl_route_SealNo" class="tbl_route_SealNo">
<span<?php echo $tbl_route->SealNo->viewAttributes() ?>>
<?php echo $tbl_route->SealNo->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($tbl_route->AttachFile->Visible) { // AttachFile ?>
		<td data-name="AttachFile"<?php echo $tbl_route->AttachFile->cellAttributes() ?>>
<span id="el<?php echo $tbl_route_list->RowCnt ?>_tbl_route_AttachFile" class="tbl_route_AttachFile">
<span<?php echo $tbl_route->AttachFile->viewAttributes() ?>>
<?php echo GetFileViewTag($tbl_route->AttachFile, $tbl_route->AttachFile->getViewValue()) ?>
</span>
</span>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$tbl_route_list->ListOptions->render("body", "right", $tbl_route_list->RowCnt);
?>
	</tr>
<?php
	}
	if (!$tbl_route->isGridAdd())
		$tbl_route_list->Recordset->moveNext();
}
?>
</tbody>
</table><!-- /.ew-table -->
<?php } ?>
<?php if (!$tbl_route->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</div><!-- /.ew-grid-middle-panel -->
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($tbl_route_list->Recordset)
	$tbl_route_list->Recordset->Close();
?>
<?php if (!$tbl_route->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$tbl_route->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php if (!isset($tbl_route_list->Pager)) $tbl_route_list->Pager = new PrevNextPager($tbl_route_list->StartRec, $tbl_route_list->DisplayRecs, $tbl_route_list->TotalRecs, $tbl_route_list->AutoHidePager) ?>
<?php if ($tbl_route_list->Pager->RecordCount > 0 && $tbl_route_list->Pager->Visible) { ?>
<div class="ew-pager">
<span><?php echo $Language->Phrase("Page") ?>&nbsp;</span>
<div class="ew-prev-next"><div class="input-group input-group-sm">
<div class="input-group-prepend">
<!-- first page button -->
	<?php if ($tbl_route_list->Pager->FirstButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerFirst") ?>" href="<?php echo $tbl_route_list->pageUrl() ?>start=<?php echo $tbl_route_list->Pager->FirstButton->Start ?>"><i class="icon-first ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerFirst") ?>"><i class="icon-first ew-icon"></i></a>
	<?php } ?>
<!-- previous page button -->
	<?php if ($tbl_route_list->Pager->PrevButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerPrevious") ?>" href="<?php echo $tbl_route_list->pageUrl() ?>start=<?php echo $tbl_route_list->Pager->PrevButton->Start ?>"><i class="icon-prev ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerPrevious") ?>"><i class="icon-prev ew-icon"></i></a>
	<?php } ?>
</div>
<!-- current page number -->
	<input class="form-control" type="text" name="<?php echo TABLE_PAGE_NO ?>" value="<?php echo $tbl_route_list->Pager->CurrentPage ?>">
<div class="input-group-append">
<!-- next page button -->
	<?php if ($tbl_route_list->Pager->NextButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerNext") ?>" href="<?php echo $tbl_route_list->pageUrl() ?>start=<?php echo $tbl_route_list->Pager->NextButton->Start ?>"><i class="icon-next ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerNext") ?>"><i class="icon-next ew-icon"></i></a>
	<?php } ?>
<!-- last page button -->
	<?php if ($tbl_route_list->Pager->LastButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerLast") ?>" href="<?php echo $tbl_route_list->pageUrl() ?>start=<?php echo $tbl_route_list->Pager->LastButton->Start ?>"><i class="icon-last ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerLast") ?>"><i class="icon-last ew-icon"></i></a>
	<?php } ?>
</div>
</div>
</div>
<span>&nbsp;<?php echo $Language->Phrase("of") ?>&nbsp;<?php echo $tbl_route_list->Pager->PageCount ?></span>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php if ($tbl_route_list->Pager->RecordCount > 0) { ?>
<div class="ew-pager ew-rec">
	<span><?php echo $Language->Phrase("Record") ?>&nbsp;<?php echo $tbl_route_list->Pager->FromIndex ?>&nbsp;<?php echo $Language->Phrase("To") ?>&nbsp;<?php echo $tbl_route_list->Pager->ToIndex ?>&nbsp;<?php echo $Language->Phrase("Of") ?>&nbsp;<?php echo $tbl_route_list->Pager->RecordCount ?></span>
</div>
<?php } ?>
<?php if ($tbl_route_list->TotalRecs > 0 && (!$tbl_route_list->AutoHidePageSizeSelector || $tbl_route_list->Pager->Visible)) { ?>
<div class="ew-pager">
<input type="hidden" name="t" value="tbl_route">
<select name="<?php echo TABLE_REC_PER_PAGE ?>" class="form-control form-control-sm ew-tooltip" title="<?php echo $Language->phrase("RecordsPerPage") ?>" onchange="this.form.submit();">
<option value="20"<?php if ($tbl_route_list->DisplayRecs == 20) { ?> selected<?php } ?>>20</option>
<option value="50"<?php if ($tbl_route_list->DisplayRecs == 50) { ?> selected<?php } ?>>50</option>
<option value="100"<?php if ($tbl_route_list->DisplayRecs == 100) { ?> selected<?php } ?>>100</option>
<option value="200"<?php if ($tbl_route_list->DisplayRecs == 200) { ?> selected<?php } ?>>200</option>
<option value="500"<?php if ($tbl_route_list->DisplayRecs == 500) { ?> selected<?php } ?>>500</option>
<option value="ALL"<?php if ($tbl_route->getRecordsPerPage() == -1) { ?> selected<?php } ?>><?php echo $Language->Phrase("AllRecords") ?></option>
</select>
</div>
<?php } ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $tbl_route_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($tbl_route_list->TotalRecs == 0 && !$tbl_route->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $tbl_route_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$tbl_route_list->showPageFooter();
if (DEBUG_ENABLED)
	echo GetDebugMessage();
?>
<?php if (!$tbl_route->isExport()) { ?>
<script>
$("[thongtin='tooltip']").tooltip();
function importExcel(ten,ID_Route)
{
	if(ten.length>0){
	window.location="importExcel.php?file_name="+ten+"&ID_Route="+ID_Route;
	}
	else
	{
		alert('Not found Excel (*.xlsx) file');
	}
}
function hello(){
	var ds=[];	
	var dsChon="";
	$('input[type="checkbox"]:checked').each(function() {
        ds.push($(this).val());
    });
	for(var i=0;i<ds.length;i++)
	{
		dsChon+=","+ds[i];
	}
	window.location="receipt_delivery.php?dsChon="+dsChon.replace(",on","");
}
$(".ew-print").click(hello);
</script>
<?php } ?>
<form method="post" action="upload.php" enctype="multipart/form-data">
<div id="myModal" class="modal" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Import plan</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <p>Excel file <input type="file" accept=".xlsx" name="fileToUpload" id="fileToUpload" value="Choose file">
        <input name="userName" type="hidden" value="<?php echo CurrentUserName()?>">
        </p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button name="submit" id="idsubmit" type="submit" class="btn btn-primary">Import</button>
      </div>
    </div>
  </div>
</div>
</form>

<?php include_once "footer.php" ?>
<?php
$tbl_route_list->terminate();
?>