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
$vwrouteout_list = new vwrouteout_list();

// Run the page
$vwrouteout_list->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$vwrouteout_list->Page_Render();
?>
<?php include_once "header.php" ?>
<?php if (!$vwrouteout->isExport()) { ?>
<script>

// Form object
currentPageID = ew.PAGE_ID = "list";
var fvwrouteoutlist = currentForm = new ew.Form("fvwrouteoutlist", "list");
fvwrouteoutlist.formKeyCountName = '<?php echo $vwrouteout_list->FormKeyCountName ?>';

// Form_CustomValidate event
fvwrouteoutlist.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

	// Your custom validation code here, return false if invalid.
	return true;
}

// Use JavaScript validation or not
fvwrouteoutlist.validateRequired = <?php echo json_encode(CLIENT_VALIDATE) ?>;

// Dynamic selection lists
fvwrouteoutlist.lists["x_RouteName"] = <?php echo $vwrouteout_list->RouteName->Lookup->toClientList() ?>;
fvwrouteoutlist.lists["x_RouteName"].options = <?php echo JsonEncode($vwrouteout_list->RouteName->options(FALSE, TRUE)) ?>;

// Form object for search
var fvwrouteoutlistsrch = currentSearchForm = new ew.Form("fvwrouteoutlistsrch");

// Validate function for search
fvwrouteoutlistsrch.validate = function(fobj) {
	if (!this.validateRequired)
		return true; // Ignore validation
	fobj = fobj || this._form;
	var infix = "";
	elm = this.getElements("x" + infix + "_CreateDate");
	if (elm && !ew.checkEuroDate(elm.value))
		return this.onError(elm, "<?php echo JsEncode($vwrouteout->CreateDate->errorMessage()) ?>");

	// Fire Form_CustomValidate event
	if (!this.Form_CustomValidate(fobj))
		return false;
	return true;
}

// Form_CustomValidate event
fvwrouteoutlistsrch.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

	// Your custom validation code here, return false if invalid.
	return true;
}

// Use JavaScript validation or not
fvwrouteoutlistsrch.validateRequired = <?php echo json_encode(CLIENT_VALIDATE) ?>;

// Dynamic selection lists
// Filters

fvwrouteoutlistsrch.filterList = <?php echo $vwrouteout_list->getFilterList() ?>;
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
<table width="100%"><tr><td>
<?php if (!$vwrouteout->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($vwrouteout_list->TotalRecs > 0 && $vwrouteout_list->ExportOptions->visible()) { ?>
<?php $vwrouteout_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($vwrouteout_list->ImportOptions->visible()) { ?>
<?php $vwrouteout_list->ImportOptions->render("body") ?>
<?php } ?>
<?php if ($vwrouteout_list->SearchOptions->visible()) { ?>
<?php $vwrouteout_list->SearchOptions->render("body") ?>
<?php } ?>
<?php if ($vwrouteout_list->FilterOptions->visible()) { ?>
<?php $vwrouteout_list->FilterOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php
$vwrouteout_list->renderOtherOptions();
?>
<?php if ($Security->CanSearch()) { ?>
<?php if (!$vwrouteout->isExport() && !$vwrouteout->CurrentAction) { ?>
<form name="fvwrouteoutlistsrch" id="fvwrouteoutlistsrch" class="form-inline ew-form ew-ext-search-form" action="<?php echo CurrentPageName() ?>">
<?php $searchPanelClass = ($vwrouteout_list->SearchWhere <> "") ? " show" : " show"; ?>
<div id="fvwrouteoutlistsrch-search-panel" class="ew-search-panel collapse<?php echo $searchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="vwrouteout">
	<div class="ew-basic-search">
<?php
if ($SearchError == "")
	$vwrouteout_list->LoadAdvancedSearch(); // Load advanced search

// Render for search
$vwrouteout->RowType = ROWTYPE_SEARCH;

// Render row
$vwrouteout->resetAttributes();
$vwrouteout_list->renderRow();
?>
<div id="xsr_1" class="ew-row d-sm-flex">
<?php if ($vwrouteout->TruckNo->Visible) { // TruckNo ?>
	<div id="xsc_TruckNo" class="ew-cell form-group">
		<label for="x_TruckNo" class="ew-search-caption ew-label"><?php echo $vwrouteout->TruckNo->caption() ?></label>
		<span class="ew-search-operator"><?php //echo $Language->phrase("LIKE") ?><input type="hidden" name="z_TruckNo" id="z_TruckNo" value="LIKE"></span>
		<span class="ew-search-field">
<input type="text" data-table="vwrouteout" data-field="x_TruckNo" name="x_TruckNo" id="x_TruckNo" size="30" maxlength="25" placeholder="<?php echo HtmlEncode($vwrouteout->TruckNo->getPlaceHolder()) ?>" value="<?php echo $vwrouteout->TruckNo->EditValue ?>"<?php echo $vwrouteout->TruckNo->editAttributes() ?>>
</span>
	</div>
<?php } ?>
</div>
<div id="xsr_2" class="ew-row d-sm-flex">
<?php if ($vwrouteout->CreateDate->Visible) { // CreateDate ?>
	<div id="xsc_CreateDate" class="ew-cell form-group">
		<label for="x_CreateDate" class="ew-search-caption ew-label"><?php echo $vwrouteout->CreateDate->caption() ?></label>
		<span class="ew-search-operator"><?php //echo $Language->phrase("BETWEEN") ?><input type="hidden" name="z_CreateDate" id="z_CreateDate" value="BETWEEN"></span>
		<span class="ew-search-field">
<input type="text" data-table="vwrouteout" data-field="x_CreateDate" data-format="11" name="x_CreateDate" id="x_CreateDate" placeholder="<?php echo HtmlEncode($vwrouteout->CreateDate->getPlaceHolder()) ?>" value="<?php echo $vwrouteout->CreateDate->EditValue ?>"<?php echo $vwrouteout->CreateDate->editAttributes() ?>>
<?php if (!$vwrouteout->CreateDate->ReadOnly && !$vwrouteout->CreateDate->Disabled && !isset($vwrouteout->CreateDate->EditAttrs["readonly"]) && !isset($vwrouteout->CreateDate->EditAttrs["disabled"])) { ?>
<script>
ew.createDateTimePicker("fvwrouteoutlistsrch", "x_CreateDate", {"ignoreReadonly":true,"useCurrent":false,"format":11});
</script>
<?php } ?>
</span>
		<span class="ew-search-cond btw1_CreateDate"><label><?php echo $Language->Phrase("AND") ?></label></span>
		<span class="ew-search-field btw1_CreateDate">
<input type="text" data-table="vwrouteout" data-field="x_CreateDate" data-format="11" name="y_CreateDate" id="y_CreateDate" placeholder="<?php echo HtmlEncode($vwrouteout->CreateDate->getPlaceHolder()) ?>" value="<?php echo $vwrouteout->CreateDate->EditValue2 ?>"<?php echo $vwrouteout->CreateDate->editAttributes() ?>>
<?php if (!$vwrouteout->CreateDate->ReadOnly && !$vwrouteout->CreateDate->Disabled && !isset($vwrouteout->CreateDate->EditAttrs["readonly"]) && !isset($vwrouteout->CreateDate->EditAttrs["disabled"])) { ?>
<script>
ew.createDateTimePicker("fvwrouteoutlistsrch", "y_CreateDate", {"ignoreReadonly":true,"useCurrent":false,"format":11});
</script>
<?php } ?>
</span>
	</div>
<?php } ?>
</div>
<div id="xsr_3" class="ew-row d-sm-flex">
	<div class="ew-quick-search input-group">
		<input type="text" name="<?php echo TABLE_BASIC_SEARCH ?>" id="<?php echo TABLE_BASIC_SEARCH ?>" class="form-control" value="<?php echo HtmlEncode($vwrouteout_list->BasicSearch->getKeyword()) ?>" placeholder="<?php echo HtmlEncode($Language->phrase("Search")) ?>">
		<input type="hidden" name="<?php echo TABLE_BASIC_SEARCH_TYPE ?>" id="<?php echo TABLE_BASIC_SEARCH_TYPE ?>" value="<?php echo HtmlEncode($vwrouteout_list->BasicSearch->getType()) ?>">
		<div class="input-group-append">
			<button class="btn btn-primary" name="btn-submit" id="btn-submit" type="submit"><?php echo $Language->phrase("SearchBtn") ?></button>
			<button type="button" data-toggle="dropdown" class="btn btn-primary dropdown-toggle dropdown-toggle-split" aria-haspopup="true" aria-expanded="false"><span id="searchtype"><?php echo $vwrouteout_list->BasicSearch->getTypeNameShort() ?></span></button>
			<div class="dropdown-menu dropdown-menu-right">
				<a class="dropdown-item<?php if ($vwrouteout_list->BasicSearch->getType() == "") echo " active"; ?>" href="javascript:void(0);" onclick="ew.setSearchType(this)"><?php echo $Language->phrase("QuickSearchAuto") ?></a>
				<a class="dropdown-item<?php if ($vwrouteout_list->BasicSearch->getType() == "=") echo " active"; ?>" href="javascript:void(0);" onclick="ew.setSearchType(this,'=')"><?php echo $Language->phrase("QuickSearchExact") ?></a>
				<a class="dropdown-item<?php if ($vwrouteout_list->BasicSearch->getType() == "AND") echo " active"; ?>" href="javascript:void(0);" onclick="ew.setSearchType(this,'AND')"><?php echo $Language->phrase("QuickSearchAll") ?></a>
				<a class="dropdown-item<?php if ($vwrouteout_list->BasicSearch->getType() == "OR") echo " active"; ?>" href="javascript:void(0);" onclick="ew.setSearchType(this,'OR')"><?php echo $Language->phrase("QuickSearchAny") ?></a>
			</div>
		</div>
	</div>
</div>
	</div>
</div>
</form>
<?php } ?>
<?php } ?>
<?php $vwrouteout_list->showPageHeader(); ?>
<input type="button" class="btn btn-outline-danger btnx" id="idPrintPXK" value="Outbound WH">
<input type="button" class="btn btn-outline-danger btnx" id="idPrintBBBG" value="Proof of delivery">
<?php
$vwrouteout_list->showMessage();
?>
</td><td><img src="images/loading.png" width="200" height="120"></td></tr>
</table>
<?php if ($vwrouteout_list->TotalRecs > 0 || $vwrouteout->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($vwrouteout_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> vwrouteout">
<?php if (!$vwrouteout->isExport()) { ?>
<div class="card-header ew-grid-upper-panel">
<?php if (!$vwrouteout->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php if (!isset($vwrouteout_list->Pager)) $vwrouteout_list->Pager = new PrevNextPager($vwrouteout_list->StartRec, $vwrouteout_list->DisplayRecs, $vwrouteout_list->TotalRecs, $vwrouteout_list->AutoHidePager) ?>
<?php if ($vwrouteout_list->Pager->RecordCount > 0 && $vwrouteout_list->Pager->Visible) { ?>
<div class="ew-pager">
<span><?php echo $Language->Phrase("Page") ?>&nbsp;</span>
<div class="ew-prev-next"><div class="input-group input-group-sm">
<div class="input-group-prepend">
<!-- first page button -->
	<?php if ($vwrouteout_list->Pager->FirstButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerFirst") ?>" href="<?php echo $vwrouteout_list->pageUrl() ?>start=<?php echo $vwrouteout_list->Pager->FirstButton->Start ?>"><i class="icon-first ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerFirst") ?>"><i class="icon-first ew-icon"></i></a>
	<?php } ?>
<!-- previous page button -->
	<?php if ($vwrouteout_list->Pager->PrevButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerPrevious") ?>" href="<?php echo $vwrouteout_list->pageUrl() ?>start=<?php echo $vwrouteout_list->Pager->PrevButton->Start ?>"><i class="icon-prev ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerPrevious") ?>"><i class="icon-prev ew-icon"></i></a>
	<?php } ?>
</div>
<!-- current page number -->
	<input class="form-control" type="text" name="<?php echo TABLE_PAGE_NO ?>" value="<?php echo $vwrouteout_list->Pager->CurrentPage ?>">
<div class="input-group-append">
<!-- next page button -->
	<?php if ($vwrouteout_list->Pager->NextButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerNext") ?>" href="<?php echo $vwrouteout_list->pageUrl() ?>start=<?php echo $vwrouteout_list->Pager->NextButton->Start ?>"><i class="icon-next ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerNext") ?>"><i class="icon-next ew-icon"></i></a>
	<?php } ?>
<!-- last page button -->
	<?php if ($vwrouteout_list->Pager->LastButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerLast") ?>" href="<?php echo $vwrouteout_list->pageUrl() ?>start=<?php echo $vwrouteout_list->Pager->LastButton->Start ?>"><i class="icon-last ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerLast") ?>"><i class="icon-last ew-icon"></i></a>
	<?php } ?>
</div>
</div>
</div>
<span>&nbsp;<?php echo $Language->Phrase("of") ?>&nbsp;<?php echo $vwrouteout_list->Pager->PageCount ?></span>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php if ($vwrouteout_list->Pager->RecordCount > 0) { ?>
<div class="ew-pager ew-rec">
	<span><?php echo $Language->Phrase("Record") ?>&nbsp;<?php echo $vwrouteout_list->Pager->FromIndex ?>&nbsp;<?php echo $Language->Phrase("To") ?>&nbsp;<?php echo $vwrouteout_list->Pager->ToIndex ?>&nbsp;<?php echo $Language->Phrase("Of") ?>&nbsp;<?php echo $vwrouteout_list->Pager->RecordCount ?></span>
</div>
<?php } ?>
<?php if ($vwrouteout_list->TotalRecs > 0 && (!$vwrouteout_list->AutoHidePageSizeSelector || $vwrouteout_list->Pager->Visible)) { ?>
<div class="ew-pager">
<input type="hidden" name="t" value="vwrouteout">
<select name="<?php echo TABLE_REC_PER_PAGE ?>" class="form-control form-control-sm ew-tooltip" title="<?php echo $Language->phrase("RecordsPerPage") ?>" onchange="this.form.submit();">
<option value="20"<?php if ($vwrouteout_list->DisplayRecs == 20) { ?> selected<?php } ?>>20</option>
<option value="50"<?php if ($vwrouteout_list->DisplayRecs == 50) { ?> selected<?php } ?>>50</option>
<option value="100"<?php if ($vwrouteout_list->DisplayRecs == 100) { ?> selected<?php } ?>>100</option>
<option value="200"<?php if ($vwrouteout_list->DisplayRecs == 200) { ?> selected<?php } ?>>200</option>
<option value="500"<?php if ($vwrouteout_list->DisplayRecs == 500) { ?> selected<?php } ?>>500</option>
<option value="ALL"<?php if ($vwrouteout->getRecordsPerPage() == -1) { ?> selected<?php } ?>><?php echo $Language->Phrase("AllRecords") ?></option>
</select>
</div>
<?php } ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $vwrouteout_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
<form name="fvwrouteoutlist" id="fvwrouteoutlist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($vwrouteout_list->CheckToken) { ?>
<input type="hidden" name="<?php echo TOKEN_NAME ?>" value="<?php echo $vwrouteout_list->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="vwrouteout">
<input type="hidden" name="exporttype" id="exporttype" value="">
<div id="gmp_vwrouteout" class="<?php if (IsResponsiveLayout()) { ?>table-responsive <?php } ?>card-body ew-grid-middle-panel">
<?php if ($vwrouteout_list->TotalRecs > 0 || $vwrouteout->isGridEdit()) { ?>
<table id="tbl_vwrouteoutlist" class="table ew-table"><!-- .ew-table ##-->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$vwrouteout_list->RowType = ROWTYPE_HEADER;

// Render list options
$vwrouteout_list->renderListOptions();

// Render list options (header, left)
$vwrouteout_list->ListOptions->render("header", "left");
?>
<?php if ($vwrouteout->RouteName->Visible) { // RouteName ?>
	<?php if ($vwrouteout->sortUrl($vwrouteout->RouteName) == "") { ?>
		<th data-name="RouteName" class="<?php echo $vwrouteout->RouteName->headerCellClass() ?>" style="white-space: nowrap;"><div id="elh_vwrouteout_RouteName" class="vwrouteout_RouteName"><div class="ew-table-header-caption"><?php echo $vwrouteout->RouteName->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="RouteName" class="<?php echo $vwrouteout->RouteName->headerCellClass() ?>" style="white-space: nowrap;"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $vwrouteout->SortUrl($vwrouteout->RouteName) ?>',2);"><div id="elh_vwrouteout_RouteName" class="vwrouteout_RouteName">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $vwrouteout->RouteName->caption() ?></span><span class="ew-table-header-sort"><?php if ($vwrouteout->RouteName->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($vwrouteout->RouteName->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($vwrouteout->TruckNo->Visible) { // TruckNo ?>
	<?php if ($vwrouteout->sortUrl($vwrouteout->TruckNo) == "") { ?>
		<th data-name="TruckNo" class="<?php echo $vwrouteout->TruckNo->headerCellClass() ?>" style="white-space: nowrap;"><div id="elh_vwrouteout_TruckNo" class="vwrouteout_TruckNo"><div class="ew-table-header-caption"><?php echo $vwrouteout->TruckNo->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="TruckNo" class="<?php echo $vwrouteout->TruckNo->headerCellClass() ?>" style="white-space: nowrap;"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $vwrouteout->SortUrl($vwrouteout->TruckNo) ?>',2);"><div id="elh_vwrouteout_TruckNo" class="vwrouteout_TruckNo">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $vwrouteout->TruckNo->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($vwrouteout->TruckNo->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($vwrouteout->TruckNo->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($vwrouteout->DriverName->Visible) { // DriverName ?>
	<?php if ($vwrouteout->sortUrl($vwrouteout->DriverName) == "") { ?>
		<th data-name="DriverName" class="<?php echo $vwrouteout->DriverName->headerCellClass() ?>" style="white-space: nowrap;"><div id="elh_vwrouteout_DriverName" class="vwrouteout_DriverName"><div class="ew-table-header-caption"><?php echo $vwrouteout->DriverName->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="DriverName" class="<?php echo $vwrouteout->DriverName->headerCellClass() ?>" style="white-space: nowrap;"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $vwrouteout->SortUrl($vwrouteout->DriverName) ?>',2);"><div id="elh_vwrouteout_DriverName" class="vwrouteout_DriverName">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $vwrouteout->DriverName->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($vwrouteout->DriverName->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($vwrouteout->DriverName->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($vwrouteout->DriverMobile->Visible) { // DriverMobile ?>
	<?php if ($vwrouteout->sortUrl($vwrouteout->DriverMobile) == "") { ?>
		<th data-name="DriverMobile" class="<?php echo $vwrouteout->DriverMobile->headerCellClass() ?>" style="white-space: nowrap;"><div id="elh_vwrouteout_DriverMobile" class="vwrouteout_DriverMobile"><div class="ew-table-header-caption"><?php echo $vwrouteout->DriverMobile->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="DriverMobile" class="<?php echo $vwrouteout->DriverMobile->headerCellClass() ?>" style="white-space: nowrap;"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $vwrouteout->SortUrl($vwrouteout->DriverMobile) ?>',2);"><div id="elh_vwrouteout_DriverMobile" class="vwrouteout_DriverMobile">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $vwrouteout->DriverMobile->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($vwrouteout->DriverMobile->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($vwrouteout->DriverMobile->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($vwrouteout->InvoiceNo->Visible) { // InvoiceNo ?>
	<?php if ($vwrouteout->sortUrl($vwrouteout->InvoiceNo) == "") { ?>
		<th data-name="InvoiceNo" class="<?php echo $vwrouteout->InvoiceNo->headerCellClass() ?>" style="white-space: nowrap;"><div id="elh_vwrouteout_InvoiceNo" class="vwrouteout_InvoiceNo"><div class="ew-table-header-caption"><?php echo $vwrouteout->InvoiceNo->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="InvoiceNo" class="<?php echo $vwrouteout->InvoiceNo->headerCellClass() ?>" style="white-space: nowrap;"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $vwrouteout->SortUrl($vwrouteout->InvoiceNo) ?>',2);"><div id="elh_vwrouteout_InvoiceNo" class="vwrouteout_InvoiceNo">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $vwrouteout->InvoiceNo->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($vwrouteout->InvoiceNo->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($vwrouteout->InvoiceNo->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($vwrouteout->InvoiceDate->Visible) { // InvoiceDate ?>
	<?php if ($vwrouteout->sortUrl($vwrouteout->InvoiceDate) == "") { ?>
		<th data-name="InvoiceDate" class="<?php echo $vwrouteout->InvoiceDate->headerCellClass() ?>" style="white-space: nowrap;"><div id="elh_vwrouteout_InvoiceDate" class="vwrouteout_InvoiceDate"><div class="ew-table-header-caption"><?php echo $vwrouteout->InvoiceDate->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="InvoiceDate" class="<?php echo $vwrouteout->InvoiceDate->headerCellClass() ?>" style="white-space: nowrap;"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $vwrouteout->SortUrl($vwrouteout->InvoiceDate) ?>',2);"><div id="elh_vwrouteout_InvoiceDate" class="vwrouteout_InvoiceDate">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $vwrouteout->InvoiceDate->caption() ?></span><span class="ew-table-header-sort"><?php if ($vwrouteout->InvoiceDate->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($vwrouteout->InvoiceDate->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($vwrouteout->CreateUser->Visible) { // CreateUser ?>
	<?php if ($vwrouteout->sortUrl($vwrouteout->CreateUser) == "") { ?>
		<th data-name="CreateUser" class="<?php echo $vwrouteout->CreateUser->headerCellClass() ?>" style="white-space: nowrap;"><div id="elh_vwrouteout_CreateUser" class="vwrouteout_CreateUser"><div class="ew-table-header-caption"><?php echo $vwrouteout->CreateUser->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="CreateUser" class="<?php echo $vwrouteout->CreateUser->headerCellClass() ?>" style="white-space: nowrap;"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $vwrouteout->SortUrl($vwrouteout->CreateUser) ?>',2);"><div id="elh_vwrouteout_CreateUser" class="vwrouteout_CreateUser">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $vwrouteout->CreateUser->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($vwrouteout->CreateUser->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($vwrouteout->CreateUser->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($vwrouteout->CreateDate->Visible) { // CreateDate ?>
	<?php if ($vwrouteout->sortUrl($vwrouteout->CreateDate) == "") { ?>
		<th data-name="CreateDate" class="<?php echo $vwrouteout->CreateDate->headerCellClass() ?>" style="white-space: nowrap;"><div id="elh_vwrouteout_CreateDate" class="vwrouteout_CreateDate"><div class="ew-table-header-caption"><?php echo $vwrouteout->CreateDate->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="CreateDate" class="<?php echo $vwrouteout->CreateDate->headerCellClass() ?>" style="white-space: nowrap;"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $vwrouteout->SortUrl($vwrouteout->CreateDate) ?>',2);"><div id="elh_vwrouteout_CreateDate" class="vwrouteout_CreateDate">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $vwrouteout->CreateDate->caption() ?></span><span class="ew-table-header-sort"><?php if ($vwrouteout->CreateDate->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($vwrouteout->CreateDate->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($vwrouteout->SealNo->Visible) { // SealNo ?>
	<?php if ($vwrouteout->sortUrl($vwrouteout->SealNo) == "") { ?>
		<th data-name="SealNo" class="<?php echo $vwrouteout->SealNo->headerCellClass() ?>"><div id="elh_vwrouteout_SealNo" class="vwrouteout_SealNo"><div class="ew-table-header-caption"><?php echo $vwrouteout->SealNo->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="SealNo" class="<?php echo $vwrouteout->SealNo->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $vwrouteout->SortUrl($vwrouteout->SealNo) ?>',2);"><div id="elh_vwrouteout_SealNo" class="vwrouteout_SealNo">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $vwrouteout->SealNo->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($vwrouteout->SealNo->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($vwrouteout->SealNo->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<th>&nbsp;</th>
<?php

// Render list options (header, right)
$vwrouteout_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
if ($vwrouteout->ExportAll && $vwrouteout->isExport()) {
	$vwrouteout_list->StopRec = $vwrouteout_list->TotalRecs;
} else {

	// Set the last record to display
	if ($vwrouteout_list->TotalRecs > $vwrouteout_list->StartRec + $vwrouteout_list->DisplayRecs - 1)
		$vwrouteout_list->StopRec = $vwrouteout_list->StartRec + $vwrouteout_list->DisplayRecs - 1;
	else
		$vwrouteout_list->StopRec = $vwrouteout_list->TotalRecs;
}
$vwrouteout_list->RecCnt = $vwrouteout_list->StartRec - 1;
if ($vwrouteout_list->Recordset && !$vwrouteout_list->Recordset->EOF) {
	$vwrouteout_list->Recordset->moveFirst();
	$selectLimit = $vwrouteout_list->UseSelectLimit;
	if (!$selectLimit && $vwrouteout_list->StartRec > 1)
		$vwrouteout_list->Recordset->move($vwrouteout_list->StartRec - 1);
} elseif (!$vwrouteout->AllowAddDeleteRow && $vwrouteout_list->StopRec == 0) {
	$vwrouteout_list->StopRec = $vwrouteout->GridAddRowCount;
}

// Initialize aggregate
$vwrouteout->RowType = ROWTYPE_AGGREGATEINIT;
$vwrouteout->resetAttributes();
$vwrouteout_list->renderRow();
while ($vwrouteout_list->RecCnt < $vwrouteout_list->StopRec) {
	$vwrouteout_list->RecCnt++;
	if ($vwrouteout_list->RecCnt >= $vwrouteout_list->StartRec) {
		$vwrouteout_list->RowCnt++;

		// Set up key count
		$vwrouteout_list->KeyCount = $vwrouteout_list->RowIndex;

		// Init row class and style
		$vwrouteout->resetAttributes();
		$vwrouteout->CssClass = "";
		if ($vwrouteout->isGridAdd()) {
		} else {
			$vwrouteout_list->loadRowValues($vwrouteout_list->Recordset); // Load row values
		}
		$vwrouteout->RowType = ROWTYPE_VIEW; // Render view

		// Set up row id / data-rowindex
		$vwrouteout->RowAttrs = array_merge($vwrouteout->RowAttrs, array('data-rowindex'=>$vwrouteout_list->RowCnt, 'id'=>'r' . $vwrouteout_list->RowCnt . '_vwrouteout', 'data-rowtype'=>$vwrouteout->RowType));

		// Render row
		$vwrouteout_list->renderRow();

		// Render list options
		$vwrouteout_list->renderListOptions();
?>
	<tr<?php echo $vwrouteout->rowAttributes() ?>>
<?php

// Render list options (body, left)
$vwrouteout_list->ListOptions->render("body", "left", $vwrouteout_list->RowCnt);
?>
	<?php if ($vwrouteout->RouteName->Visible) { // RouteName ?>
		<td data-name="RouteName"<?php echo $vwrouteout->RouteName->cellAttributes() ?>>
<span id="el<?php echo $vwrouteout_list->RowCnt ?>_vwrouteout_RouteName" class="vwrouteout_RouteName">
<span<?php echo $vwrouteout->RouteName->viewAttributes() ?>>
<?php echo $vwrouteout->RouteName->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($vwrouteout->TruckNo->Visible) { // TruckNo ?>
		<td data-name="TruckNo"<?php echo $vwrouteout->TruckNo->cellAttributes() ?>>
<span id="el<?php echo $vwrouteout_list->RowCnt ?>_vwrouteout_TruckNo" class="vwrouteout_TruckNo">
<span<?php echo $vwrouteout->TruckNo->viewAttributes() ?>>
<?php echo $vwrouteout->TruckNo->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($vwrouteout->DriverName->Visible) { // DriverName ?>
		<td data-name="DriverName"<?php echo $vwrouteout->DriverName->cellAttributes() ?>>
<span id="el<?php echo $vwrouteout_list->RowCnt ?>_vwrouteout_DriverName" class="vwrouteout_DriverName">
<span<?php echo $vwrouteout->DriverName->viewAttributes() ?>>
<?php echo $vwrouteout->DriverName->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($vwrouteout->DriverMobile->Visible) { // DriverMobile ?>
		<td data-name="DriverMobile"<?php echo $vwrouteout->DriverMobile->cellAttributes() ?>>
<span id="el<?php echo $vwrouteout_list->RowCnt ?>_vwrouteout_DriverMobile" class="vwrouteout_DriverMobile">
<span<?php echo $vwrouteout->DriverMobile->viewAttributes() ?>>
<?php echo $vwrouteout->DriverMobile->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($vwrouteout->InvoiceNo->Visible) { // InvoiceNo ?>
		<td data-name="InvoiceNo"<?php echo $vwrouteout->InvoiceNo->cellAttributes() ?>>
<span id="el<?php echo $vwrouteout_list->RowCnt ?>_vwrouteout_InvoiceNo" class="vwrouteout_InvoiceNo">
<span<?php echo $vwrouteout->InvoiceNo->viewAttributes() ?>>
<?php echo $vwrouteout->InvoiceNo->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($vwrouteout->InvoiceDate->Visible) { // InvoiceDate ?>
		<td data-name="InvoiceDate"<?php echo $vwrouteout->InvoiceDate->cellAttributes() ?>>
<span id="el<?php echo $vwrouteout_list->RowCnt ?>_vwrouteout_InvoiceDate" class="vwrouteout_InvoiceDate">
<span<?php echo $vwrouteout->InvoiceDate->viewAttributes() ?>>
<?php echo $vwrouteout->InvoiceDate->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($vwrouteout->CreateUser->Visible) { // CreateUser ?>
		<td data-name="CreateUser"<?php echo $vwrouteout->CreateUser->cellAttributes() ?>>
<span id="el<?php echo $vwrouteout_list->RowCnt ?>_vwrouteout_CreateUser" class="vwrouteout_CreateUser">
<span<?php echo $vwrouteout->CreateUser->viewAttributes() ?>>
<?php echo $vwrouteout->CreateUser->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($vwrouteout->CreateDate->Visible) { // CreateDate ?>
		<td data-name="CreateDate"<?php echo $vwrouteout->CreateDate->cellAttributes() ?>>
<span id="el<?php echo $vwrouteout_list->RowCnt ?>_vwrouteout_CreateDate" class="vwrouteout_CreateDate">
<span<?php echo $vwrouteout->CreateDate->viewAttributes() ?>>
<?php echo $vwrouteout->CreateDate->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($vwrouteout->SealNo->Visible) { // SealNo ?>
		<td data-name="SealNo"<?php echo $vwrouteout->SealNo->cellAttributes() ?>>
<span id="el<?php echo $vwrouteout_list->RowCnt ?>_vwrouteout_SealNo" class="vwrouteout_SealNo">
<span<?php echo $vwrouteout->SealNo->viewAttributes() ?>>
<?php echo $vwrouteout->SealNo->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
<td>
<a class="btn btn-outline-danger" href="updateFinishOrder.php?id_route=<?php echo $vwrouteout->ID_Route->CurrentValue?>">Finish checkout order</a>  
</td>
<?php

// Render list options (body, right)
$vwrouteout_list->ListOptions->render("body", "right", $vwrouteout_list->RowCnt);
?>
	</tr>
<?php
	}
	if (!$vwrouteout->isGridAdd())
		$vwrouteout_list->Recordset->moveNext();
}
?>
</tbody>
</table><!-- /.ew-table -->
<?php } ?>
<?php if (!$vwrouteout->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</div><!-- /.ew-grid-middle-panel -->
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($vwrouteout_list->Recordset)
	$vwrouteout_list->Recordset->Close();
?>
<?php if (!$vwrouteout->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$vwrouteout->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php if (!isset($vwrouteout_list->Pager)) $vwrouteout_list->Pager = new PrevNextPager($vwrouteout_list->StartRec, $vwrouteout_list->DisplayRecs, $vwrouteout_list->TotalRecs, $vwrouteout_list->AutoHidePager) ?>
<?php if ($vwrouteout_list->Pager->RecordCount > 0 && $vwrouteout_list->Pager->Visible) { ?>
<div class="ew-pager">
<span><?php echo $Language->Phrase("Page") ?>&nbsp;</span>
<div class="ew-prev-next"><div class="input-group input-group-sm">
<div class="input-group-prepend">
<!-- first page button -->
	<?php if ($vwrouteout_list->Pager->FirstButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerFirst") ?>" href="<?php echo $vwrouteout_list->pageUrl() ?>start=<?php echo $vwrouteout_list->Pager->FirstButton->Start ?>"><i class="icon-first ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerFirst") ?>"><i class="icon-first ew-icon"></i></a>
	<?php } ?>
<!-- previous page button -->
	<?php if ($vwrouteout_list->Pager->PrevButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerPrevious") ?>" href="<?php echo $vwrouteout_list->pageUrl() ?>start=<?php echo $vwrouteout_list->Pager->PrevButton->Start ?>"><i class="icon-prev ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerPrevious") ?>"><i class="icon-prev ew-icon"></i></a>
	<?php } ?>
</div>
<!-- current page number -->
	<input class="form-control" type="text" name="<?php echo TABLE_PAGE_NO ?>" value="<?php echo $vwrouteout_list->Pager->CurrentPage ?>">
<div class="input-group-append">
<!-- next page button -->
	<?php if ($vwrouteout_list->Pager->NextButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerNext") ?>" href="<?php echo $vwrouteout_list->pageUrl() ?>start=<?php echo $vwrouteout_list->Pager->NextButton->Start ?>"><i class="icon-next ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerNext") ?>"><i class="icon-next ew-icon"></i></a>
	<?php } ?>
<!-- last page button -->
	<?php if ($vwrouteout_list->Pager->LastButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerLast") ?>" href="<?php echo $vwrouteout_list->pageUrl() ?>start=<?php echo $vwrouteout_list->Pager->LastButton->Start ?>"><i class="icon-last ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerLast") ?>"><i class="icon-last ew-icon"></i></a>
	<?php } ?>
</div>
</div>
</div>
<span>&nbsp;<?php echo $Language->Phrase("of") ?>&nbsp;<?php echo $vwrouteout_list->Pager->PageCount ?></span>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php if ($vwrouteout_list->Pager->RecordCount > 0) { ?>
<div class="ew-pager ew-rec">
	<span><?php echo $Language->Phrase("Record") ?>&nbsp;<?php echo $vwrouteout_list->Pager->FromIndex ?>&nbsp;<?php echo $Language->Phrase("To") ?>&nbsp;<?php echo $vwrouteout_list->Pager->ToIndex ?>&nbsp;<?php echo $Language->Phrase("Of") ?>&nbsp;<?php echo $vwrouteout_list->Pager->RecordCount ?></span>
</div>
<?php } ?>
<?php if ($vwrouteout_list->TotalRecs > 0 && (!$vwrouteout_list->AutoHidePageSizeSelector || $vwrouteout_list->Pager->Visible)) { ?>
<div class="ew-pager">
<input type="hidden" name="t" value="vwrouteout">
<select name="<?php echo TABLE_REC_PER_PAGE ?>" class="form-control form-control-sm ew-tooltip" title="<?php echo $Language->phrase("RecordsPerPage") ?>" onchange="this.form.submit();">
<option value="20"<?php if ($vwrouteout_list->DisplayRecs == 20) { ?> selected<?php } ?>>20</option>
<option value="50"<?php if ($vwrouteout_list->DisplayRecs == 50) { ?> selected<?php } ?>>50</option>
<option value="100"<?php if ($vwrouteout_list->DisplayRecs == 100) { ?> selected<?php } ?>>100</option>
<option value="200"<?php if ($vwrouteout_list->DisplayRecs == 200) { ?> selected<?php } ?>>200</option>
<option value="500"<?php if ($vwrouteout_list->DisplayRecs == 500) { ?> selected<?php } ?>>500</option>
<option value="ALL"<?php if ($vwrouteout->getRecordsPerPage() == -1) { ?> selected<?php } ?>><?php echo $Language->Phrase("AllRecords") ?></option>
</select>
</div>
<?php } ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $vwrouteout_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($vwrouteout_list->TotalRecs == 0 && !$vwrouteout->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $vwrouteout_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$vwrouteout_list->showPageFooter();
if (DEBUG_ENABLED)
	echo GetDebugMessage();
?>
<?php if (!$vwrouteout->isExport()) { ?>
<script src="phpjs/js_outbound.js">
</script>
<?php } ?>
<?php include_once "footer.php" ?>
<?php
$vwrouteout_list->terminate();
?>