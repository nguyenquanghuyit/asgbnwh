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
$vwStock_list = new vwStock_list();

// Run the page
$vwStock_list->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$vwStock_list->Page_Render();
?>
<?php include_once "header.php" ?>
<?php if (!$vwStock->isExport()) { ?>
<script>

// Form object
currentPageID = ew.PAGE_ID = "list";
var fvwStocklist = currentForm = new ew.Form("fvwStocklist", "list");
fvwStocklist.formKeyCountName = '<?php echo $vwStock_list->FormKeyCountName ?>';

// Form_CustomValidate event
fvwStocklist.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

	// Your custom validation code here, return false if invalid.
	return true;
}

// Use JavaScript validation or not
fvwStocklist.validateRequired = <?php echo json_encode(CLIENT_VALIDATE) ?>;

// Dynamic selection lists
fvwStocklist.lists["x_TypeName"] = <?php echo $vwStock_list->TypeName->Lookup->toClientList() ?>;
fvwStocklist.lists["x_TypeName"].options = <?php echo JsonEncode($vwStock_list->TypeName->lookupOptions()) ?>;
fvwStocklist.lists["x_Location"] = <?php echo $vwStock_list->Location->Lookup->toClientList() ?>;
fvwStocklist.lists["x_Location"].options = <?php echo JsonEncode($vwStock_list->Location->lookupOptions()) ?>;
fvwStocklist.autoSuggests["x_Location"] = <?php echo json_encode(["data" => "ajax=autosuggest"]) ?>;

// Form object for search
var fvwStocklistsrch = currentSearchForm = new ew.Form("fvwStocklistsrch");

// Validate function for search
fvwStocklistsrch.validate = function(fobj) {
	if (!this.validateRequired)
		return true; // Ignore validation
	fobj = fobj || this._form;
	var infix = "";
	elm = this.getElements("x" + infix + "_Location");
	if (elm && !ew.checkInteger(elm.value))
		return this.onError(elm, "<?php echo JsEncode($vwStock->Location->errorMessage()) ?>");
	elm = this.getElements("x" + infix + "_MFG");
	if (elm && !ew.checkEuroDate(elm.value))
		return this.onError(elm, "<?php echo JsEncode($vwStock->MFG->errorMessage()) ?>");

	// Fire Form_CustomValidate event
	if (!this.Form_CustomValidate(fobj))
		return false;
	return true;
}

// Form_CustomValidate event
fvwStocklistsrch.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

	// Your custom validation code here, return false if invalid.
	return true;
}

// Use JavaScript validation or not
fvwStocklistsrch.validateRequired = <?php echo json_encode(CLIENT_VALIDATE) ?>;

// Dynamic selection lists
fvwStocklistsrch.lists["x_TypeName"] = <?php echo $vwStock_list->TypeName->Lookup->toClientList() ?>;
fvwStocklistsrch.lists["x_TypeName"].options = <?php echo JsonEncode($vwStock_list->TypeName->lookupOptions()) ?>;
fvwStocklistsrch.lists["x_Location"] = <?php echo $vwStock_list->Location->Lookup->toClientList() ?>;
fvwStocklistsrch.lists["x_Location"].options = <?php echo JsonEncode($vwStock_list->Location->lookupOptions()) ?>;
fvwStocklistsrch.autoSuggests["x_Location"] = <?php echo json_encode(["data" => "ajax=autosuggest"]) ?>;

// Filters
fvwStocklistsrch.filterList = <?php echo $vwStock_list->getFilterList() ?>;
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
<?php if (!$vwStock->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($vwStock_list->TotalRecs > 0 && $vwStock_list->ExportOptions->visible()) { ?>
<?php $vwStock_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($vwStock_list->ImportOptions->visible()) { ?>
<?php $vwStock_list->ImportOptions->render("body") ?>
<?php } ?>
<?php if ($vwStock_list->SearchOptions->visible()) { ?>
<?php $vwStock_list->SearchOptions->render("body") ?>
<?php } ?>
<?php if ($vwStock_list->FilterOptions->visible()) { ?>
<?php $vwStock_list->FilterOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php
$vwStock_list->renderOtherOptions();
?>
<?php if ($Security->CanSearch()) { ?>
<?php if (!$vwStock->isExport() && !$vwStock->CurrentAction) { ?>
<form name="fvwStocklistsrch" id="fvwStocklistsrch" class="form-inline ew-form ew-ext-search-form" action="<?php echo CurrentPageName() ?>">
<?php $searchPanelClass = ($vwStock_list->SearchWhere <> "") ? " show" : " show"; ?>
<div id="fvwStocklistsrch-search-panel" class="ew-search-panel collapse<?php echo $searchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="vwStock">
	<div class="ew-basic-search">
<?php
if ($SearchError == "")
	$vwStock_list->LoadAdvancedSearch(); // Load advanced search

// Render for search
$vwStock->RowType = ROWTYPE_SEARCH;

// Render row
$vwStock->resetAttributes();
$vwStock_list->renderRow();
?>
<div id="xsr_1" class="ew-row d-sm-flex">
<?php if ($vwStock->TypeName->Visible) { // TypeName ?>
	<div id="xsc_TypeName" class="ew-cell form-group">
		<label for="x_TypeName" class="ew-search-caption ew-label"><?php echo $vwStock->TypeName->caption() ?></label>
		<span class="ew-search-operator"><?php //echo $Language->phrase("LIKE") ?><input type="hidden" name="z_TypeName" id="z_TypeName" value="LIKE"></span>
		<span class="ew-search-field">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="vwStock" data-field="x_TypeName" data-value-separator="<?php echo $vwStock->TypeName->displayValueSeparatorAttribute() ?>" id="x_TypeName" name="x_TypeName"<?php echo $vwStock->TypeName->editAttributes() ?>>
		<?php echo $vwStock->TypeName->selectOptionListHtml("x_TypeName") ?>
	</select>
</div>
<?php echo $vwStock->TypeName->Lookup->getParamTag("p_x_TypeName") ?>
</span>
	</div>
<?php } ?>
</div>
<div id="xsr_2" class="ew-row d-sm-flex">
<?php if ($vwStock->Location->Visible) { // Location ?>
	<div id="xsc_Location" class="ew-cell form-group">
		<label class="ew-search-caption ew-label"><?php echo $vwStock->Location->caption() ?></label>
		<span class="ew-search-operator"><?php //echo $Language->phrase("LIKE") ?><input type="hidden" name="z_Location" id="z_Location" value="LIKE"></span>
		<span class="ew-search-field">
<?php
$wrkonchange = "" . trim(@$vwStock->Location->EditAttrs["onchange"]);
if (trim($wrkonchange) <> "") $wrkonchange = " onchange=\"" . JsEncode($wrkonchange) . "\"";
$vwStock->Location->EditAttrs["onchange"] = "";
?>
<span id="as_x_Location" class="text-nowrap" style="z-index: 8960">
	<input type="text" class="form-control" name="sv_x_Location" id="sv_x_Location" value="<?php echo RemoveHtml($vwStock->Location->EditValue) ?>" size="30" placeholder="<?php echo HtmlEncode($vwStock->Location->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($vwStock->Location->getPlaceHolder()) ?>"<?php echo $vwStock->Location->editAttributes() ?>>
</span>
<input type="hidden" data-table="vwStock" data-field="x_Location" data-value-separator="<?php echo $vwStock->Location->displayValueSeparatorAttribute() ?>" name="x_Location" id="x_Location" value="<?php echo HtmlEncode($vwStock->Location->AdvancedSearch->SearchValue) ?>"<?php echo $wrkonchange ?>>
<script>
fvwStocklistsrch.createAutoSuggest({"id":"x_Location","forceSelect":true});
</script>
<?php echo $vwStock->Location->Lookup->getParamTag("p_x_Location") ?>
</span>
	</div>
<?php } ?>
</div>
<div id="xsr_3" class="ew-row d-sm-flex">
<?php if ($vwStock->MFG->Visible) { // MFG ?>
	<div id="xsc_MFG" class="ew-cell form-group">
		<label for="x_MFG" class="ew-search-caption ew-label"><?php echo $vwStock->MFG->caption() ?></label>
		<span class="ew-search-operator"><?php //echo $Language->phrase("BETWEEN") ?><input type="hidden" name="z_MFG" id="z_MFG" value="BETWEEN"></span>
		<span class="ew-search-field">
<input type="text" data-table="vwStock" data-field="x_MFG" data-format="7" name="x_MFG" id="x_MFG" placeholder="<?php echo HtmlEncode($vwStock->MFG->getPlaceHolder()) ?>" value="<?php echo $vwStock->MFG->EditValue ?>"<?php echo $vwStock->MFG->editAttributes() ?>>
<?php if (!$vwStock->MFG->ReadOnly && !$vwStock->MFG->Disabled && !isset($vwStock->MFG->EditAttrs["readonly"]) && !isset($vwStock->MFG->EditAttrs["disabled"])) { ?>
<script>
ew.createDateTimePicker("fvwStocklistsrch", "x_MFG", {"ignoreReadonly":true,"useCurrent":false,"format":7});
</script>
<?php } ?>
</span>
		<span class="ew-search-cond btw1_MFG"><label><?php echo $Language->Phrase("AND") ?></label></span>
		<span class="ew-search-field btw1_MFG">
<input type="text" data-table="vwStock" data-field="x_MFG" data-format="7" name="y_MFG" id="y_MFG" placeholder="<?php echo HtmlEncode($vwStock->MFG->getPlaceHolder()) ?>" value="<?php echo $vwStock->MFG->EditValue2 ?>"<?php echo $vwStock->MFG->editAttributes() ?>>
<?php if (!$vwStock->MFG->ReadOnly && !$vwStock->MFG->Disabled && !isset($vwStock->MFG->EditAttrs["readonly"]) && !isset($vwStock->MFG->EditAttrs["disabled"])) { ?>
<script>
ew.createDateTimePicker("fvwStocklistsrch", "y_MFG", {"ignoreReadonly":true,"useCurrent":false,"format":7});
</script>
<?php } ?>
</span>
	</div>
<?php } ?>
</div>
<div id="xsr_4" class="ew-row d-sm-flex">
	<div class="ew-quick-search input-group">
		<input type="text" name="<?php echo TABLE_BASIC_SEARCH ?>" id="<?php echo TABLE_BASIC_SEARCH ?>" class="form-control" value="<?php echo HtmlEncode($vwStock_list->BasicSearch->getKeyword()) ?>" placeholder="<?php echo HtmlEncode($Language->phrase("Search")) ?>">
		<input type="hidden" name="<?php echo TABLE_BASIC_SEARCH_TYPE ?>" id="<?php echo TABLE_BASIC_SEARCH_TYPE ?>" value="<?php echo HtmlEncode($vwStock_list->BasicSearch->getType()) ?>">
		<div class="input-group-append">
			<button class="btn btn-primary" name="btn-submit" id="btn-submit" type="submit"><?php echo $Language->phrase("SearchBtn") ?></button>
			<button type="button" data-toggle="dropdown" class="btn btn-primary dropdown-toggle dropdown-toggle-split" aria-haspopup="true" aria-expanded="false"><span id="searchtype"><?php echo $vwStock_list->BasicSearch->getTypeNameShort() ?></span></button>
			<div class="dropdown-menu dropdown-menu-right">
				<a class="dropdown-item<?php if ($vwStock_list->BasicSearch->getType() == "") echo " active"; ?>" href="javascript:void(0);" onclick="ew.setSearchType(this)"><?php echo $Language->phrase("QuickSearchAuto") ?></a>
				<a class="dropdown-item<?php if ($vwStock_list->BasicSearch->getType() == "=") echo " active"; ?>" href="javascript:void(0);" onclick="ew.setSearchType(this,'=')"><?php echo $Language->phrase("QuickSearchExact") ?></a>
				<a class="dropdown-item<?php if ($vwStock_list->BasicSearch->getType() == "AND") echo " active"; ?>" href="javascript:void(0);" onclick="ew.setSearchType(this,'AND')"><?php echo $Language->phrase("QuickSearchAll") ?></a>
				<a class="dropdown-item<?php if ($vwStock_list->BasicSearch->getType() == "OR") echo " active"; ?>" href="javascript:void(0);" onclick="ew.setSearchType(this,'OR')"><?php echo $Language->phrase("QuickSearchAny") ?></a>
			</div>
		</div>
	</div>
</div>
	</div>
</div>
</form>
<?php } ?>
<?php } ?>
<?php $vwStock_list->showPageHeader(); ?>
<?php
$vwStock_list->showMessage();
?>
<?php if ($vwStock_list->TotalRecs > 0 || $vwStock->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($vwStock_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> vwStock">
<?php if (!$vwStock->isExport()) { ?>
<div class="card-header ew-grid-upper-panel">
<?php if (!$vwStock->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php if (!isset($vwStock_list->Pager)) $vwStock_list->Pager = new PrevNextPager($vwStock_list->StartRec, $vwStock_list->DisplayRecs, $vwStock_list->TotalRecs, $vwStock_list->AutoHidePager) ?>
<?php if ($vwStock_list->Pager->RecordCount > 0 && $vwStock_list->Pager->Visible) { ?>
<div class="ew-pager">
<span><?php echo $Language->Phrase("Page") ?>&nbsp;</span>
<div class="ew-prev-next"><div class="input-group input-group-sm">
<div class="input-group-prepend">
<!-- first page button -->
	<?php if ($vwStock_list->Pager->FirstButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerFirst") ?>" href="<?php echo $vwStock_list->pageUrl() ?>start=<?php echo $vwStock_list->Pager->FirstButton->Start ?>"><i class="icon-first ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerFirst") ?>"><i class="icon-first ew-icon"></i></a>
	<?php } ?>
<!-- previous page button -->
	<?php if ($vwStock_list->Pager->PrevButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerPrevious") ?>" href="<?php echo $vwStock_list->pageUrl() ?>start=<?php echo $vwStock_list->Pager->PrevButton->Start ?>"><i class="icon-prev ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerPrevious") ?>"><i class="icon-prev ew-icon"></i></a>
	<?php } ?>
</div>
<!-- current page number -->
	<input class="form-control" type="text" name="<?php echo TABLE_PAGE_NO ?>" value="<?php echo $vwStock_list->Pager->CurrentPage ?>">
<div class="input-group-append">
<!-- next page button -->
	<?php if ($vwStock_list->Pager->NextButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerNext") ?>" href="<?php echo $vwStock_list->pageUrl() ?>start=<?php echo $vwStock_list->Pager->NextButton->Start ?>"><i class="icon-next ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerNext") ?>"><i class="icon-next ew-icon"></i></a>
	<?php } ?>
<!-- last page button -->
	<?php if ($vwStock_list->Pager->LastButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerLast") ?>" href="<?php echo $vwStock_list->pageUrl() ?>start=<?php echo $vwStock_list->Pager->LastButton->Start ?>"><i class="icon-last ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerLast") ?>"><i class="icon-last ew-icon"></i></a>
	<?php } ?>
</div>
</div>
</div>
<span>&nbsp;<?php echo $Language->Phrase("of") ?>&nbsp;<?php echo $vwStock_list->Pager->PageCount ?></span>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php if ($vwStock_list->Pager->RecordCount > 0) { ?>
<div class="ew-pager ew-rec">
	<span><?php echo $Language->Phrase("Record") ?>&nbsp;<?php echo $vwStock_list->Pager->FromIndex ?>&nbsp;<?php echo $Language->Phrase("To") ?>&nbsp;<?php echo $vwStock_list->Pager->ToIndex ?>&nbsp;<?php echo $Language->Phrase("Of") ?>&nbsp;<?php echo $vwStock_list->Pager->RecordCount ?></span>
</div>
<?php } ?>
<?php if ($vwStock_list->TotalRecs > 0 && (!$vwStock_list->AutoHidePageSizeSelector || $vwStock_list->Pager->Visible)) { ?>
<div class="ew-pager">
<input type="hidden" name="t" value="vwStock">
<select name="<?php echo TABLE_REC_PER_PAGE ?>" class="form-control form-control-sm ew-tooltip" title="<?php echo $Language->phrase("RecordsPerPage") ?>" onchange="this.form.submit();">
<option value="20"<?php if ($vwStock_list->DisplayRecs == 20) { ?> selected<?php } ?>>20</option>
<option value="50"<?php if ($vwStock_list->DisplayRecs == 50) { ?> selected<?php } ?>>50</option>
<option value="100"<?php if ($vwStock_list->DisplayRecs == 100) { ?> selected<?php } ?>>100</option>
<option value="200"<?php if ($vwStock_list->DisplayRecs == 200) { ?> selected<?php } ?>>200</option>
<option value="500"<?php if ($vwStock_list->DisplayRecs == 500) { ?> selected<?php } ?>>500</option>
<option value="ALL"<?php if ($vwStock->getRecordsPerPage() == -1) { ?> selected<?php } ?>><?php echo $Language->Phrase("AllRecords") ?></option>
</select>
</div>
<?php } ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $vwStock_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
<form name="fvwStocklist" id="fvwStocklist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($vwStock_list->CheckToken) { ?>
<input type="hidden" name="<?php echo TOKEN_NAME ?>" value="<?php echo $vwStock_list->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="vwStock">
<div id="gmp_vwStock" class="<?php if (IsResponsiveLayout()) { ?>table-responsive <?php } ?>card-body ew-grid-middle-panel">
<?php if ($vwStock_list->TotalRecs > 0 || $vwStock->isGridEdit()) { ?>
<table id="tbl_vwStocklist" class="table ew-table"><!-- .ew-table ##-->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$vwStock_list->RowType = ROWTYPE_HEADER;

// Render list options
$vwStock_list->renderListOptions();

// Render list options (header, left)
$vwStock_list->ListOptions->render("header", "left");
?>
<?php if ($vwStock->PalletID->Visible) { // PalletID ?>
	<?php if ($vwStock->sortUrl($vwStock->PalletID) == "") { ?>
		<th data-name="PalletID" class="<?php echo $vwStock->PalletID->headerCellClass() ?>" style="white-space: nowrap;"><div id="elh_vwStock_PalletID" class="vwStock_PalletID"><div class="ew-table-header-caption"><?php echo $vwStock->PalletID->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="PalletID" class="<?php echo $vwStock->PalletID->headerCellClass() ?>" style="white-space: nowrap;"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $vwStock->SortUrl($vwStock->PalletID) ?>',2);"><div id="elh_vwStock_PalletID" class="vwStock_PalletID">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $vwStock->PalletID->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($vwStock->PalletID->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($vwStock->PalletID->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($vwStock->TypeName->Visible) { // TypeName ?>
	<?php if ($vwStock->sortUrl($vwStock->TypeName) == "") { ?>
		<th data-name="TypeName" class="<?php echo $vwStock->TypeName->headerCellClass() ?>" style="white-space: nowrap;"><div id="elh_vwStock_TypeName" class="vwStock_TypeName"><div class="ew-table-header-caption"><?php echo $vwStock->TypeName->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="TypeName" class="<?php echo $vwStock->TypeName->headerCellClass() ?>" style="white-space: nowrap;"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $vwStock->SortUrl($vwStock->TypeName) ?>',2);"><div id="elh_vwStock_TypeName" class="vwStock_TypeName">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $vwStock->TypeName->caption() ?></span><span class="ew-table-header-sort"><?php if ($vwStock->TypeName->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($vwStock->TypeName->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($vwStock->Code->Visible) { // Code ?>
	<?php if ($vwStock->sortUrl($vwStock->Code) == "") { ?>
		<th data-name="Code" class="<?php echo $vwStock->Code->headerCellClass() ?>" style="white-space: nowrap;"><div id="elh_vwStock_Code" class="vwStock_Code"><div class="ew-table-header-caption"><?php echo $vwStock->Code->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Code" class="<?php echo $vwStock->Code->headerCellClass() ?>" style="white-space: nowrap;"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $vwStock->SortUrl($vwStock->Code) ?>',2);"><div id="elh_vwStock_Code" class="vwStock_Code">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $vwStock->Code->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($vwStock->Code->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($vwStock->Code->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($vwStock->Location->Visible) { // Location ?>
	<?php if ($vwStock->sortUrl($vwStock->Location) == "") { ?>
		<th data-name="Location" class="<?php echo $vwStock->Location->headerCellClass() ?>" style="white-space: nowrap;"><div id="elh_vwStock_Location" class="vwStock_Location"><div class="ew-table-header-caption"><?php echo $vwStock->Location->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Location" class="<?php echo $vwStock->Location->headerCellClass() ?>" style="white-space: nowrap;"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $vwStock->SortUrl($vwStock->Location) ?>',2);"><div id="elh_vwStock_Location" class="vwStock_Location">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $vwStock->Location->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($vwStock->Location->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($vwStock->Location->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($vwStock->Pcs_RemainPicking->Visible) { // Pcs_RemainPicking ?>
	<?php if ($vwStock->sortUrl($vwStock->Pcs_RemainPicking) == "") { ?>
		<th data-name="Pcs_RemainPicking" class="<?php echo $vwStock->Pcs_RemainPicking->headerCellClass() ?>" style="white-space: nowrap;"><div id="elh_vwStock_Pcs_RemainPicking" class="vwStock_Pcs_RemainPicking"><div class="ew-table-header-caption"><?php echo $vwStock->Pcs_RemainPicking->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Pcs_RemainPicking" class="<?php echo $vwStock->Pcs_RemainPicking->headerCellClass() ?>" style="white-space: nowrap;"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $vwStock->SortUrl($vwStock->Pcs_RemainPicking) ?>',2);"><div id="elh_vwStock_Pcs_RemainPicking" class="vwStock_Pcs_RemainPicking">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $vwStock->Pcs_RemainPicking->caption() ?></span><span class="ew-table-header-sort"><?php if ($vwStock->Pcs_RemainPicking->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($vwStock->Pcs_RemainPicking->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($vwStock->MFG->Visible) { // MFG ?>
	<?php if ($vwStock->sortUrl($vwStock->MFG) == "") { ?>
		<th data-name="MFG" class="<?php echo $vwStock->MFG->headerCellClass() ?>" style="white-space: nowrap;"><div id="elh_vwStock_MFG" class="vwStock_MFG"><div class="ew-table-header-caption"><?php echo $vwStock->MFG->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="MFG" class="<?php echo $vwStock->MFG->headerCellClass() ?>" style="white-space: nowrap;"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $vwStock->SortUrl($vwStock->MFG) ?>',2);"><div id="elh_vwStock_MFG" class="vwStock_MFG">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $vwStock->MFG->caption() ?></span><span class="ew-table-header-sort"><?php if ($vwStock->MFG->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($vwStock->MFG->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($vwStock->Note_PalletId->Visible) { // Note_PalletId ?>
	<?php if ($vwStock->sortUrl($vwStock->Note_PalletId) == "") { ?>
		<th data-name="Note_PalletId" class="<?php echo $vwStock->Note_PalletId->headerCellClass() ?>" style="white-space: nowrap;"><div id="elh_vwStock_Note_PalletId" class="vwStock_Note_PalletId"><div class="ew-table-header-caption"><?php echo $vwStock->Note_PalletId->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Note_PalletId" class="<?php echo $vwStock->Note_PalletId->headerCellClass() ?>" style="white-space: nowrap;"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $vwStock->SortUrl($vwStock->Note_PalletId) ?>',2);"><div id="elh_vwStock_Note_PalletId" class="vwStock_Note_PalletId">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $vwStock->Note_PalletId->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($vwStock->Note_PalletId->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($vwStock->Note_PalletId->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($vwStock->CreateUser->Visible) { // CreateUser ?>
	<?php if ($vwStock->sortUrl($vwStock->CreateUser) == "") { ?>
		<th data-name="CreateUser" class="<?php echo $vwStock->CreateUser->headerCellClass() ?>" style="white-space: nowrap;"><div id="elh_vwStock_CreateUser" class="vwStock_CreateUser"><div class="ew-table-header-caption"><?php echo $vwStock->CreateUser->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="CreateUser" class="<?php echo $vwStock->CreateUser->headerCellClass() ?>" style="white-space: nowrap;"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $vwStock->SortUrl($vwStock->CreateUser) ?>',2);"><div id="elh_vwStock_CreateUser" class="vwStock_CreateUser">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $vwStock->CreateUser->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($vwStock->CreateUser->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($vwStock->CreateUser->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($vwStock->CreateDate->Visible) { // CreateDate ?>
	<?php if ($vwStock->sortUrl($vwStock->CreateDate) == "") { ?>
		<th data-name="CreateDate" class="<?php echo $vwStock->CreateDate->headerCellClass() ?>" style="white-space: nowrap;"><div id="elh_vwStock_CreateDate" class="vwStock_CreateDate"><div class="ew-table-header-caption"><?php echo $vwStock->CreateDate->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="CreateDate" class="<?php echo $vwStock->CreateDate->headerCellClass() ?>" style="white-space: nowrap;"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $vwStock->SortUrl($vwStock->CreateDate) ?>',2);"><div id="elh_vwStock_CreateDate" class="vwStock_CreateDate">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $vwStock->CreateDate->caption() ?></span><span class="ew-table-header-sort"><?php if ($vwStock->CreateDate->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($vwStock->CreateDate->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$vwStock_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
if ($vwStock->ExportAll && $vwStock->isExport()) {
	$vwStock_list->StopRec = $vwStock_list->TotalRecs;
} else {

	// Set the last record to display
	if ($vwStock_list->TotalRecs > $vwStock_list->StartRec + $vwStock_list->DisplayRecs - 1)
		$vwStock_list->StopRec = $vwStock_list->StartRec + $vwStock_list->DisplayRecs - 1;
	else
		$vwStock_list->StopRec = $vwStock_list->TotalRecs;
}
$vwStock_list->RecCnt = $vwStock_list->StartRec - 1;
if ($vwStock_list->Recordset && !$vwStock_list->Recordset->EOF) {
	$vwStock_list->Recordset->moveFirst();
	$selectLimit = $vwStock_list->UseSelectLimit;
	if (!$selectLimit && $vwStock_list->StartRec > 1)
		$vwStock_list->Recordset->move($vwStock_list->StartRec - 1);
} elseif (!$vwStock->AllowAddDeleteRow && $vwStock_list->StopRec == 0) {
	$vwStock_list->StopRec = $vwStock->GridAddRowCount;
}

// Initialize aggregate
$vwStock->RowType = ROWTYPE_AGGREGATEINIT;
$vwStock->resetAttributes();
$vwStock_list->renderRow();
while ($vwStock_list->RecCnt < $vwStock_list->StopRec) {
	$vwStock_list->RecCnt++;
	if ($vwStock_list->RecCnt >= $vwStock_list->StartRec) {
		$vwStock_list->RowCnt++;

		// Set up key count
		$vwStock_list->KeyCount = $vwStock_list->RowIndex;

		// Init row class and style
		$vwStock->resetAttributes();
		$vwStock->CssClass = "";
		if ($vwStock->isGridAdd()) {
		} else {
			$vwStock_list->loadRowValues($vwStock_list->Recordset); // Load row values
		}
		$vwStock->RowType = ROWTYPE_VIEW; // Render view

		// Set up row id / data-rowindex
		$vwStock->RowAttrs = array_merge($vwStock->RowAttrs, array('data-rowindex'=>$vwStock_list->RowCnt, 'id'=>'r' . $vwStock_list->RowCnt . '_vwStock', 'data-rowtype'=>$vwStock->RowType));

		// Render row
		$vwStock_list->renderRow();

		// Render list options
		$vwStock_list->renderListOptions();
?>
	<tr<?php echo $vwStock->rowAttributes() ?>>
<?php

// Render list options (body, left)
$vwStock_list->ListOptions->render("body", "left", $vwStock_list->RowCnt);
?>
	<?php if ($vwStock->PalletID->Visible) { // PalletID ?>
		<td data-name="PalletID"<?php echo $vwStock->PalletID->cellAttributes() ?>>
<span id="el<?php echo $vwStock_list->RowCnt ?>_vwStock_PalletID" class="vwStock_PalletID">
<span<?php echo $vwStock->PalletID->viewAttributes() ?>>
<?php echo $vwStock->PalletID->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($vwStock->TypeName->Visible) { // TypeName ?>
		<td data-name="TypeName"<?php echo $vwStock->TypeName->cellAttributes() ?>>
<span id="el<?php echo $vwStock_list->RowCnt ?>_vwStock_TypeName" class="vwStock_TypeName">
<span<?php echo $vwStock->TypeName->viewAttributes() ?>>
<?php echo $vwStock->TypeName->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($vwStock->Code->Visible) { // Code ?>
		<td data-name="Code"<?php echo $vwStock->Code->cellAttributes() ?>>
<span id="el<?php echo $vwStock_list->RowCnt ?>_vwStock_Code" class="vwStock_Code">
<span<?php echo $vwStock->Code->viewAttributes() ?>>
<?php echo $vwStock->Code->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($vwStock->Location->Visible) { // Location ?>
		<td data-name="Location"<?php echo $vwStock->Location->cellAttributes() ?>>
<span id="el<?php echo $vwStock_list->RowCnt ?>_vwStock_Location" class="vwStock_Location">
<span<?php echo $vwStock->Location->viewAttributes() ?>>
<?php echo $vwStock->Location->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($vwStock->Pcs_RemainPicking->Visible) { // Pcs_RemainPicking ?>
		<td data-name="Pcs_RemainPicking"<?php echo $vwStock->Pcs_RemainPicking->cellAttributes() ?>>
<span id="el<?php echo $vwStock_list->RowCnt ?>_vwStock_Pcs_RemainPicking" class="vwStock_Pcs_RemainPicking">
<span<?php echo $vwStock->Pcs_RemainPicking->viewAttributes() ?>>
<?php echo $vwStock->Pcs_RemainPicking->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($vwStock->MFG->Visible) { // MFG ?>
		<td data-name="MFG"<?php echo $vwStock->MFG->cellAttributes() ?>>
<span id="el<?php echo $vwStock_list->RowCnt ?>_vwStock_MFG" class="vwStock_MFG">
<span<?php echo $vwStock->MFG->viewAttributes() ?>>
<?php echo $vwStock->MFG->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($vwStock->Note_PalletId->Visible) { // Note_PalletId ?>
		<td data-name="Note_PalletId"<?php echo $vwStock->Note_PalletId->cellAttributes() ?>>
<span id="el<?php echo $vwStock_list->RowCnt ?>_vwStock_Note_PalletId" class="vwStock_Note_PalletId">
<span<?php echo $vwStock->Note_PalletId->viewAttributes() ?>>
<?php echo $vwStock->Note_PalletId->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($vwStock->CreateUser->Visible) { // CreateUser ?>
		<td data-name="CreateUser"<?php echo $vwStock->CreateUser->cellAttributes() ?>>
<span id="el<?php echo $vwStock_list->RowCnt ?>_vwStock_CreateUser" class="vwStock_CreateUser">
<span<?php echo $vwStock->CreateUser->viewAttributes() ?>>
<?php echo $vwStock->CreateUser->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($vwStock->CreateDate->Visible) { // CreateDate ?>
		<td data-name="CreateDate"<?php echo $vwStock->CreateDate->cellAttributes() ?>>
<span id="el<?php echo $vwStock_list->RowCnt ?>_vwStock_CreateDate" class="vwStock_CreateDate">
<span<?php echo $vwStock->CreateDate->viewAttributes() ?>>
<?php echo $vwStock->CreateDate->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$vwStock_list->ListOptions->render("body", "right", $vwStock_list->RowCnt);
?>
	</tr>
<?php
	}
	if (!$vwStock->isGridAdd())
		$vwStock_list->Recordset->moveNext();
}
?>
</tbody>
<?php

// Render aggregate row
$vwStock->RowType = ROWTYPE_AGGREGATE;
$vwStock->resetAttributes();
$vwStock_list->renderRow();
?>
<?php if ($vwStock_list->TotalRecs > 0 && !$vwStock->isGridAdd() && !$vwStock->isGridEdit()) { ?>
<tfoot><!-- Table footer -->
	<tr class="ew-table-footer">
<?php

// Render list options
$vwStock_list->renderListOptions();

// Render list options (footer, left)
$vwStock_list->ListOptions->render("footer", "left");
?>
	<?php if ($vwStock->PalletID->Visible) { // PalletID ?>
		<td data-name="PalletID" class="<?php echo $vwStock->PalletID->footerCellClass() ?>"><span id="elf_vwStock_PalletID" class="vwStock_PalletID">
		&nbsp;
		</span></td>
	<?php } ?>
	<?php if ($vwStock->TypeName->Visible) { // TypeName ?>
		<td data-name="TypeName" class="<?php echo $vwStock->TypeName->footerCellClass() ?>"><span id="elf_vwStock_TypeName" class="vwStock_TypeName">
		&nbsp;
		</span></td>
	<?php } ?>
	<?php if ($vwStock->Code->Visible) { // Code ?>
		<td data-name="Code" class="<?php echo $vwStock->Code->footerCellClass() ?>"><span id="elf_vwStock_Code" class="vwStock_Code">
		&nbsp;
		</span></td>
	<?php } ?>
	<?php if ($vwStock->Location->Visible) { // Location ?>
		<td data-name="Location" class="<?php echo $vwStock->Location->footerCellClass() ?>"><span id="elf_vwStock_Location" class="vwStock_Location">
		&nbsp;
		</span></td>
	<?php } ?>
	<?php if ($vwStock->Pcs_RemainPicking->Visible) { // Pcs_RemainPicking ?>
		<td data-name="Pcs_RemainPicking" class="<?php echo $vwStock->Pcs_RemainPicking->footerCellClass() ?>"><span id="elf_vwStock_Pcs_RemainPicking" class="vwStock_Pcs_RemainPicking">
		<span class="ew-aggregate"><?php echo $Language->phrase("TOTAL") ?></span><span class="ew-aggregate-value">
		<?php echo $vwStock->Pcs_RemainPicking->ViewValue ?></span>
		</span></td>
	<?php } ?>
	<?php if ($vwStock->MFG->Visible) { // MFG ?>
		<td data-name="MFG" class="<?php echo $vwStock->MFG->footerCellClass() ?>"><span id="elf_vwStock_MFG" class="vwStock_MFG">
		&nbsp;
		</span></td>
	<?php } ?>
	<?php if ($vwStock->Note_PalletId->Visible) { // Note_PalletId ?>
		<td data-name="Note_PalletId" class="<?php echo $vwStock->Note_PalletId->footerCellClass() ?>"><span id="elf_vwStock_Note_PalletId" class="vwStock_Note_PalletId">
		&nbsp;
		</span></td>
	<?php } ?>
	<?php if ($vwStock->CreateUser->Visible) { // CreateUser ?>
		<td data-name="CreateUser" class="<?php echo $vwStock->CreateUser->footerCellClass() ?>"><span id="elf_vwStock_CreateUser" class="vwStock_CreateUser">
		&nbsp;
		</span></td>
	<?php } ?>
	<?php if ($vwStock->CreateDate->Visible) { // CreateDate ?>
		<td data-name="CreateDate" class="<?php echo $vwStock->CreateDate->footerCellClass() ?>"><span id="elf_vwStock_CreateDate" class="vwStock_CreateDate">
		&nbsp;
		</span></td>
	<?php } ?>
<?php

// Render list options (footer, right)
$vwStock_list->ListOptions->render("footer", "right");
?>
	</tr>
</tfoot>
<?php } ?>
</table><!-- /.ew-table -->
<?php } ?>
<?php if (!$vwStock->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</div><!-- /.ew-grid-middle-panel -->
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($vwStock_list->Recordset)
	$vwStock_list->Recordset->Close();
?>
<?php if (!$vwStock->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$vwStock->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php if (!isset($vwStock_list->Pager)) $vwStock_list->Pager = new PrevNextPager($vwStock_list->StartRec, $vwStock_list->DisplayRecs, $vwStock_list->TotalRecs, $vwStock_list->AutoHidePager) ?>
<?php if ($vwStock_list->Pager->RecordCount > 0 && $vwStock_list->Pager->Visible) { ?>
<div class="ew-pager">
<span><?php echo $Language->Phrase("Page") ?>&nbsp;</span>
<div class="ew-prev-next"><div class="input-group input-group-sm">
<div class="input-group-prepend">
<!-- first page button -->
	<?php if ($vwStock_list->Pager->FirstButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerFirst") ?>" href="<?php echo $vwStock_list->pageUrl() ?>start=<?php echo $vwStock_list->Pager->FirstButton->Start ?>"><i class="icon-first ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerFirst") ?>"><i class="icon-first ew-icon"></i></a>
	<?php } ?>
<!-- previous page button -->
	<?php if ($vwStock_list->Pager->PrevButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerPrevious") ?>" href="<?php echo $vwStock_list->pageUrl() ?>start=<?php echo $vwStock_list->Pager->PrevButton->Start ?>"><i class="icon-prev ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerPrevious") ?>"><i class="icon-prev ew-icon"></i></a>
	<?php } ?>
</div>
<!-- current page number -->
	<input class="form-control" type="text" name="<?php echo TABLE_PAGE_NO ?>" value="<?php echo $vwStock_list->Pager->CurrentPage ?>">
<div class="input-group-append">
<!-- next page button -->
	<?php if ($vwStock_list->Pager->NextButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerNext") ?>" href="<?php echo $vwStock_list->pageUrl() ?>start=<?php echo $vwStock_list->Pager->NextButton->Start ?>"><i class="icon-next ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerNext") ?>"><i class="icon-next ew-icon"></i></a>
	<?php } ?>
<!-- last page button -->
	<?php if ($vwStock_list->Pager->LastButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerLast") ?>" href="<?php echo $vwStock_list->pageUrl() ?>start=<?php echo $vwStock_list->Pager->LastButton->Start ?>"><i class="icon-last ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerLast") ?>"><i class="icon-last ew-icon"></i></a>
	<?php } ?>
</div>
</div>
</div>
<span>&nbsp;<?php echo $Language->Phrase("of") ?>&nbsp;<?php echo $vwStock_list->Pager->PageCount ?></span>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php if ($vwStock_list->Pager->RecordCount > 0) { ?>
<div class="ew-pager ew-rec">
	<span><?php echo $Language->Phrase("Record") ?>&nbsp;<?php echo $vwStock_list->Pager->FromIndex ?>&nbsp;<?php echo $Language->Phrase("To") ?>&nbsp;<?php echo $vwStock_list->Pager->ToIndex ?>&nbsp;<?php echo $Language->Phrase("Of") ?>&nbsp;<?php echo $vwStock_list->Pager->RecordCount ?></span>
</div>
<?php } ?>
<?php if ($vwStock_list->TotalRecs > 0 && (!$vwStock_list->AutoHidePageSizeSelector || $vwStock_list->Pager->Visible)) { ?>
<div class="ew-pager">
<input type="hidden" name="t" value="vwStock">
<select name="<?php echo TABLE_REC_PER_PAGE ?>" class="form-control form-control-sm ew-tooltip" title="<?php echo $Language->phrase("RecordsPerPage") ?>" onchange="this.form.submit();">
<option value="20"<?php if ($vwStock_list->DisplayRecs == 20) { ?> selected<?php } ?>>20</option>
<option value="50"<?php if ($vwStock_list->DisplayRecs == 50) { ?> selected<?php } ?>>50</option>
<option value="100"<?php if ($vwStock_list->DisplayRecs == 100) { ?> selected<?php } ?>>100</option>
<option value="200"<?php if ($vwStock_list->DisplayRecs == 200) { ?> selected<?php } ?>>200</option>
<option value="500"<?php if ($vwStock_list->DisplayRecs == 500) { ?> selected<?php } ?>>500</option>
<option value="ALL"<?php if ($vwStock->getRecordsPerPage() == -1) { ?> selected<?php } ?>><?php echo $Language->Phrase("AllRecords") ?></option>
</select>
</div>
<?php } ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $vwStock_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($vwStock_list->TotalRecs == 0 && !$vwStock->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $vwStock_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$vwStock_list->showPageFooter();
if (DEBUG_ENABLED)
	echo GetDebugMessage();
?>
<?php if (!$vwStock->isExport()) { ?>
<script>

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php } ?>
<?php include_once "footer.php" ?>
<?php
$vwStock_list->terminate();
?>