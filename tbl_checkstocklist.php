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
$tbl_checkstock_list = new tbl_checkstock_list();

// Run the page
$tbl_checkstock_list->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$tbl_checkstock_list->Page_Render();
?>
<?php include_once "header.php" ?>
<?php if (!$tbl_checkstock->isExport()) { ?>
<script>

// Form object
currentPageID = ew.PAGE_ID = "list";
var ftbl_checkstocklist = currentForm = new ew.Form("ftbl_checkstocklist", "list");
ftbl_checkstocklist.formKeyCountName = '<?php echo $tbl_checkstock_list->FormKeyCountName ?>';

// Form_CustomValidate event
ftbl_checkstocklist.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

	// Your custom validation code here, return false if invalid.
	return true;
}

// Use JavaScript validation or not
ftbl_checkstocklist.validateRequired = <?php echo json_encode(CLIENT_VALIDATE) ?>;

// Dynamic selection lists
// Form object for search

var ftbl_checkstocklistsrch = currentSearchForm = new ew.Form("ftbl_checkstocklistsrch");

// Validate function for search
ftbl_checkstocklistsrch.validate = function(fobj) {
	if (!this.validateRequired)
		return true; // Ignore validation
	fobj = fobj || this._form;
	var infix = "";
	elm = this.getElements("x" + infix + "_DatetimeCreate");
	if (elm && !ew.checkEuroDate(elm.value))
		return this.onError(elm, "<?php echo JsEncode($tbl_checkstock->DatetimeCreate->errorMessage()) ?>");

	// Fire Form_CustomValidate event
	if (!this.Form_CustomValidate(fobj))
		return false;
	return true;
}

// Form_CustomValidate event
ftbl_checkstocklistsrch.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

	// Your custom validation code here, return false if invalid.
	return true;
}

// Use JavaScript validation or not
ftbl_checkstocklistsrch.validateRequired = <?php echo json_encode(CLIENT_VALIDATE) ?>;

// Dynamic selection lists
// Filters

ftbl_checkstocklistsrch.filterList = <?php echo $tbl_checkstock_list->getFilterList() ?>;
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
<?php if (!$tbl_checkstock->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($tbl_checkstock_list->TotalRecs > 0 && $tbl_checkstock_list->ExportOptions->visible()) { ?>
<?php $tbl_checkstock_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($tbl_checkstock_list->ImportOptions->visible()) { ?>
<?php $tbl_checkstock_list->ImportOptions->render("body") ?>
<?php } ?>
<?php if ($tbl_checkstock_list->SearchOptions->visible()) { ?>
<?php $tbl_checkstock_list->SearchOptions->render("body") ?>
<?php } ?>
<?php if ($tbl_checkstock_list->FilterOptions->visible()) { ?>
<?php $tbl_checkstock_list->FilterOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php
$tbl_checkstock_list->renderOtherOptions();
?>
<?php if ($Security->CanSearch()) { ?>
<?php if (!$tbl_checkstock->isExport() && !$tbl_checkstock->CurrentAction) { ?>
<form name="ftbl_checkstocklistsrch" id="ftbl_checkstocklistsrch" class="form-inline ew-form ew-ext-search-form" action="<?php echo CurrentPageName() ?>">
<?php $searchPanelClass = ($tbl_checkstock_list->SearchWhere <> "") ? " show" : " show"; ?>
<div id="ftbl_checkstocklistsrch-search-panel" class="ew-search-panel collapse<?php echo $searchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="tbl_checkstock">
	<div class="ew-basic-search">
<?php
if ($SearchError == "")
	$tbl_checkstock_list->LoadAdvancedSearch(); // Load advanced search

// Render for search
$tbl_checkstock->RowType = ROWTYPE_SEARCH;

// Render row
$tbl_checkstock->resetAttributes();
$tbl_checkstock_list->renderRow();
?>
<div id="xsr_1" class="ew-row d-sm-flex">
<?php if ($tbl_checkstock->DatetimeCreate->Visible) { // DatetimeCreate ?>
	<div id="xsc_DatetimeCreate" class="ew-cell form-group">
		<label for="x_DatetimeCreate" class="ew-search-caption ew-label"><?php echo $tbl_checkstock->DatetimeCreate->caption() ?></label>
		<span class="ew-search-operator"><?php echo $Language->phrase("BETWEEN") ?><input type="hidden" name="z_DatetimeCreate" id="z_DatetimeCreate" value="BETWEEN"></span>
		<span class="ew-search-field">
<input type="text" data-table="tbl_checkstock" data-field="x_DatetimeCreate" data-format="7" name="x_DatetimeCreate" id="x_DatetimeCreate" placeholder="<?php echo HtmlEncode($tbl_checkstock->DatetimeCreate->getPlaceHolder()) ?>" value="<?php echo $tbl_checkstock->DatetimeCreate->EditValue ?>"<?php echo $tbl_checkstock->DatetimeCreate->editAttributes() ?>>
<?php if (!$tbl_checkstock->DatetimeCreate->ReadOnly && !$tbl_checkstock->DatetimeCreate->Disabled && !isset($tbl_checkstock->DatetimeCreate->EditAttrs["readonly"]) && !isset($tbl_checkstock->DatetimeCreate->EditAttrs["disabled"])) { ?>
<script>
ew.createDateTimePicker("ftbl_checkstocklistsrch", "x_DatetimeCreate", {"ignoreReadonly":true,"useCurrent":false,"format":7});
</script>
<?php } ?>
</span>
		<span class="ew-search-cond btw1_DatetimeCreate"><label><?php echo $Language->Phrase("AND") ?></label></span>
		<span class="ew-search-field btw1_DatetimeCreate">
<input type="text" data-table="tbl_checkstock" data-field="x_DatetimeCreate" data-format="7" name="y_DatetimeCreate" id="y_DatetimeCreate" placeholder="<?php echo HtmlEncode($tbl_checkstock->DatetimeCreate->getPlaceHolder()) ?>" value="<?php echo $tbl_checkstock->DatetimeCreate->EditValue2 ?>"<?php echo $tbl_checkstock->DatetimeCreate->editAttributes() ?>>
<?php if (!$tbl_checkstock->DatetimeCreate->ReadOnly && !$tbl_checkstock->DatetimeCreate->Disabled && !isset($tbl_checkstock->DatetimeCreate->EditAttrs["readonly"]) && !isset($tbl_checkstock->DatetimeCreate->EditAttrs["disabled"])) { ?>
<script>
ew.createDateTimePicker("ftbl_checkstocklistsrch", "y_DatetimeCreate", {"ignoreReadonly":true,"useCurrent":false,"format":7});
</script>
<?php } ?>
</span>
	</div>
<?php } ?>
</div>
<div id="xsr_2" class="ew-row d-sm-flex">
	<div class="ew-quick-search input-group">
		<input type="text" name="<?php echo TABLE_BASIC_SEARCH ?>" id="<?php echo TABLE_BASIC_SEARCH ?>" class="form-control" value="<?php echo HtmlEncode($tbl_checkstock_list->BasicSearch->getKeyword()) ?>" placeholder="<?php echo HtmlEncode($Language->phrase("Search")) ?>">
		<input type="hidden" name="<?php echo TABLE_BASIC_SEARCH_TYPE ?>" id="<?php echo TABLE_BASIC_SEARCH_TYPE ?>" value="<?php echo HtmlEncode($tbl_checkstock_list->BasicSearch->getType()) ?>">
		<div class="input-group-append">
			<button class="btn btn-primary" name="btn-submit" id="btn-submit" type="submit"><?php echo $Language->phrase("SearchBtn") ?></button>
			<button type="button" data-toggle="dropdown" class="btn btn-primary dropdown-toggle dropdown-toggle-split" aria-haspopup="true" aria-expanded="false"><span id="searchtype"><?php echo $tbl_checkstock_list->BasicSearch->getTypeNameShort() ?></span></button>
			<div class="dropdown-menu dropdown-menu-right">
				<a class="dropdown-item<?php if ($tbl_checkstock_list->BasicSearch->getType() == "") echo " active"; ?>" href="javascript:void(0);" onclick="ew.setSearchType(this)"><?php echo $Language->phrase("QuickSearchAuto") ?></a>
				<a class="dropdown-item<?php if ($tbl_checkstock_list->BasicSearch->getType() == "=") echo " active"; ?>" href="javascript:void(0);" onclick="ew.setSearchType(this,'=')"><?php echo $Language->phrase("QuickSearchExact") ?></a>
				<a class="dropdown-item<?php if ($tbl_checkstock_list->BasicSearch->getType() == "AND") echo " active"; ?>" href="javascript:void(0);" onclick="ew.setSearchType(this,'AND')"><?php echo $Language->phrase("QuickSearchAll") ?></a>
				<a class="dropdown-item<?php if ($tbl_checkstock_list->BasicSearch->getType() == "OR") echo " active"; ?>" href="javascript:void(0);" onclick="ew.setSearchType(this,'OR')"><?php echo $Language->phrase("QuickSearchAny") ?></a>
			</div>
		</div>
	</div>
</div>
	</div>
</div>
</form>
<?php } ?>
<?php } ?>
<?php $tbl_checkstock_list->showPageHeader(); ?>
<?php
$tbl_checkstock_list->showMessage();
?>
<?php if ($tbl_checkstock_list->TotalRecs > 0 || $tbl_checkstock->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($tbl_checkstock_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> tbl_checkstock">
<?php if (!$tbl_checkstock->isExport()) { ?>
<div class="card-header ew-grid-upper-panel">
<?php if (!$tbl_checkstock->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php if (!isset($tbl_checkstock_list->Pager)) $tbl_checkstock_list->Pager = new PrevNextPager($tbl_checkstock_list->StartRec, $tbl_checkstock_list->DisplayRecs, $tbl_checkstock_list->TotalRecs, $tbl_checkstock_list->AutoHidePager) ?>
<?php if ($tbl_checkstock_list->Pager->RecordCount > 0 && $tbl_checkstock_list->Pager->Visible) { ?>
<div class="ew-pager">
<span><?php echo $Language->Phrase("Page") ?>&nbsp;</span>
<div class="ew-prev-next"><div class="input-group input-group-sm">
<div class="input-group-prepend">
<!-- first page button -->
	<?php if ($tbl_checkstock_list->Pager->FirstButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerFirst") ?>" href="<?php echo $tbl_checkstock_list->pageUrl() ?>start=<?php echo $tbl_checkstock_list->Pager->FirstButton->Start ?>"><i class="icon-first ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerFirst") ?>"><i class="icon-first ew-icon"></i></a>
	<?php } ?>
<!-- previous page button -->
	<?php if ($tbl_checkstock_list->Pager->PrevButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerPrevious") ?>" href="<?php echo $tbl_checkstock_list->pageUrl() ?>start=<?php echo $tbl_checkstock_list->Pager->PrevButton->Start ?>"><i class="icon-prev ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerPrevious") ?>"><i class="icon-prev ew-icon"></i></a>
	<?php } ?>
</div>
<!-- current page number -->
	<input class="form-control" type="text" name="<?php echo TABLE_PAGE_NO ?>" value="<?php echo $tbl_checkstock_list->Pager->CurrentPage ?>">
<div class="input-group-append">
<!-- next page button -->
	<?php if ($tbl_checkstock_list->Pager->NextButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerNext") ?>" href="<?php echo $tbl_checkstock_list->pageUrl() ?>start=<?php echo $tbl_checkstock_list->Pager->NextButton->Start ?>"><i class="icon-next ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerNext") ?>"><i class="icon-next ew-icon"></i></a>
	<?php } ?>
<!-- last page button -->
	<?php if ($tbl_checkstock_list->Pager->LastButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerLast") ?>" href="<?php echo $tbl_checkstock_list->pageUrl() ?>start=<?php echo $tbl_checkstock_list->Pager->LastButton->Start ?>"><i class="icon-last ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerLast") ?>"><i class="icon-last ew-icon"></i></a>
	<?php } ?>
</div>
</div>
</div>
<span>&nbsp;<?php echo $Language->Phrase("of") ?>&nbsp;<?php echo $tbl_checkstock_list->Pager->PageCount ?></span>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php if ($tbl_checkstock_list->Pager->RecordCount > 0) { ?>
<div class="ew-pager ew-rec">
	<span><?php echo $Language->Phrase("Record") ?>&nbsp;<?php echo $tbl_checkstock_list->Pager->FromIndex ?>&nbsp;<?php echo $Language->Phrase("To") ?>&nbsp;<?php echo $tbl_checkstock_list->Pager->ToIndex ?>&nbsp;<?php echo $Language->Phrase("Of") ?>&nbsp;<?php echo $tbl_checkstock_list->Pager->RecordCount ?></span>
</div>
<?php } ?>
<?php if ($tbl_checkstock_list->TotalRecs > 0 && (!$tbl_checkstock_list->AutoHidePageSizeSelector || $tbl_checkstock_list->Pager->Visible)) { ?>
<div class="ew-pager">
<input type="hidden" name="t" value="tbl_checkstock">
<select name="<?php echo TABLE_REC_PER_PAGE ?>" class="form-control form-control-sm ew-tooltip" title="<?php echo $Language->phrase("RecordsPerPage") ?>" onchange="this.form.submit();">
<option value="20"<?php if ($tbl_checkstock_list->DisplayRecs == 20) { ?> selected<?php } ?>>20</option>
<option value="50"<?php if ($tbl_checkstock_list->DisplayRecs == 50) { ?> selected<?php } ?>>50</option>
<option value="100"<?php if ($tbl_checkstock_list->DisplayRecs == 100) { ?> selected<?php } ?>>100</option>
<option value="200"<?php if ($tbl_checkstock_list->DisplayRecs == 200) { ?> selected<?php } ?>>200</option>
<option value="500"<?php if ($tbl_checkstock_list->DisplayRecs == 500) { ?> selected<?php } ?>>500</option>
<option value="ALL"<?php if ($tbl_checkstock->getRecordsPerPage() == -1) { ?> selected<?php } ?>><?php echo $Language->Phrase("AllRecords") ?></option>
</select>
</div>
<?php } ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $tbl_checkstock_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
<form name="ftbl_checkstocklist" id="ftbl_checkstocklist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($tbl_checkstock_list->CheckToken) { ?>
<input type="hidden" name="<?php echo TOKEN_NAME ?>" value="<?php echo $tbl_checkstock_list->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="tbl_checkstock">
<input type="hidden" name="exporttype" id="exporttype" value="">
<div id="gmp_tbl_checkstock" class="<?php if (IsResponsiveLayout()) { ?>table-responsive <?php } ?>card-body ew-grid-middle-panel">
<?php if ($tbl_checkstock_list->TotalRecs > 0 || $tbl_checkstock->isGridEdit()) { ?>
<table id="tbl_tbl_checkstocklist" class="table ew-table"><!-- .ew-table ##-->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$tbl_checkstock_list->RowType = ROWTYPE_HEADER;

// Render list options
$tbl_checkstock_list->renderListOptions();

// Render list options (header, left)
$tbl_checkstock_list->ListOptions->render("header", "left");
?>
<?php if ($tbl_checkstock->tenDotKiemKho->Visible) { // tenDotKiemKho ?>
	<?php if ($tbl_checkstock->sortUrl($tbl_checkstock->tenDotKiemKho) == "") { ?>
		<th data-name="tenDotKiemKho" class="<?php echo $tbl_checkstock->tenDotKiemKho->headerCellClass() ?>" style="white-space: nowrap;"><div id="elh_tbl_checkstock_tenDotKiemKho" class="tbl_checkstock_tenDotKiemKho"><div class="ew-table-header-caption"><?php echo $tbl_checkstock->tenDotKiemKho->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="tenDotKiemKho" class="<?php echo $tbl_checkstock->tenDotKiemKho->headerCellClass() ?>" style="white-space: nowrap;"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $tbl_checkstock->SortUrl($tbl_checkstock->tenDotKiemKho) ?>',2);"><div id="elh_tbl_checkstock_tenDotKiemKho" class="tbl_checkstock_tenDotKiemKho">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $tbl_checkstock->tenDotKiemKho->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($tbl_checkstock->tenDotKiemKho->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($tbl_checkstock->tenDotKiemKho->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($tbl_checkstock->NoiDung->Visible) { // NoiDung ?>
	<?php if ($tbl_checkstock->sortUrl($tbl_checkstock->NoiDung) == "") { ?>
		<th data-name="NoiDung" class="<?php echo $tbl_checkstock->NoiDung->headerCellClass() ?>" style="white-space: nowrap;"><div id="elh_tbl_checkstock_NoiDung" class="tbl_checkstock_NoiDung"><div class="ew-table-header-caption"><?php echo $tbl_checkstock->NoiDung->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="NoiDung" class="<?php echo $tbl_checkstock->NoiDung->headerCellClass() ?>" style="white-space: nowrap;"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $tbl_checkstock->SortUrl($tbl_checkstock->NoiDung) ?>',2);"><div id="elh_tbl_checkstock_NoiDung" class="tbl_checkstock_NoiDung">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $tbl_checkstock->NoiDung->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($tbl_checkstock->NoiDung->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($tbl_checkstock->NoiDung->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($tbl_checkstock->UserCreate->Visible) { // UserCreate ?>
	<?php if ($tbl_checkstock->sortUrl($tbl_checkstock->UserCreate) == "") { ?>
		<th data-name="UserCreate" class="<?php echo $tbl_checkstock->UserCreate->headerCellClass() ?>" style="white-space: nowrap;"><div id="elh_tbl_checkstock_UserCreate" class="tbl_checkstock_UserCreate"><div class="ew-table-header-caption"><?php echo $tbl_checkstock->UserCreate->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="UserCreate" class="<?php echo $tbl_checkstock->UserCreate->headerCellClass() ?>" style="white-space: nowrap;"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $tbl_checkstock->SortUrl($tbl_checkstock->UserCreate) ?>',2);"><div id="elh_tbl_checkstock_UserCreate" class="tbl_checkstock_UserCreate">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $tbl_checkstock->UserCreate->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($tbl_checkstock->UserCreate->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($tbl_checkstock->UserCreate->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($tbl_checkstock->DatetimeCreate->Visible) { // DatetimeCreate ?>
	<?php if ($tbl_checkstock->sortUrl($tbl_checkstock->DatetimeCreate) == "") { ?>
		<th data-name="DatetimeCreate" class="<?php echo $tbl_checkstock->DatetimeCreate->headerCellClass() ?>" style="white-space: nowrap;"><div id="elh_tbl_checkstock_DatetimeCreate" class="tbl_checkstock_DatetimeCreate"><div class="ew-table-header-caption"><?php echo $tbl_checkstock->DatetimeCreate->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="DatetimeCreate" class="<?php echo $tbl_checkstock->DatetimeCreate->headerCellClass() ?>" style="white-space: nowrap;"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $tbl_checkstock->SortUrl($tbl_checkstock->DatetimeCreate) ?>',2);"><div id="elh_tbl_checkstock_DatetimeCreate" class="tbl_checkstock_DatetimeCreate">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $tbl_checkstock->DatetimeCreate->caption() ?></span><span class="ew-table-header-sort"><?php if ($tbl_checkstock->DatetimeCreate->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($tbl_checkstock->DatetimeCreate->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($tbl_checkstock->UserUpdate->Visible) { // UserUpdate ?>
	<?php if ($tbl_checkstock->sortUrl($tbl_checkstock->UserUpdate) == "") { ?>
		<th data-name="UserUpdate" class="<?php echo $tbl_checkstock->UserUpdate->headerCellClass() ?>" style="white-space: nowrap;"><div id="elh_tbl_checkstock_UserUpdate" class="tbl_checkstock_UserUpdate"><div class="ew-table-header-caption"><?php echo $tbl_checkstock->UserUpdate->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="UserUpdate" class="<?php echo $tbl_checkstock->UserUpdate->headerCellClass() ?>" style="white-space: nowrap;"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $tbl_checkstock->SortUrl($tbl_checkstock->UserUpdate) ?>',2);"><div id="elh_tbl_checkstock_UserUpdate" class="tbl_checkstock_UserUpdate">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $tbl_checkstock->UserUpdate->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($tbl_checkstock->UserUpdate->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($tbl_checkstock->UserUpdate->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($tbl_checkstock->DatetimeUpdate->Visible) { // DatetimeUpdate ?>
	<?php if ($tbl_checkstock->sortUrl($tbl_checkstock->DatetimeUpdate) == "") { ?>
		<th data-name="DatetimeUpdate" class="<?php echo $tbl_checkstock->DatetimeUpdate->headerCellClass() ?>" style="white-space: nowrap;"><div id="elh_tbl_checkstock_DatetimeUpdate" class="tbl_checkstock_DatetimeUpdate"><div class="ew-table-header-caption"><?php echo $tbl_checkstock->DatetimeUpdate->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="DatetimeUpdate" class="<?php echo $tbl_checkstock->DatetimeUpdate->headerCellClass() ?>" style="white-space: nowrap;"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $tbl_checkstock->SortUrl($tbl_checkstock->DatetimeUpdate) ?>',2);"><div id="elh_tbl_checkstock_DatetimeUpdate" class="tbl_checkstock_DatetimeUpdate">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $tbl_checkstock->DatetimeUpdate->caption() ?></span><span class="ew-table-header-sort"><?php if ($tbl_checkstock->DatetimeUpdate->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($tbl_checkstock->DatetimeUpdate->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$tbl_checkstock_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
if ($tbl_checkstock->ExportAll && $tbl_checkstock->isExport()) {
	$tbl_checkstock_list->StopRec = $tbl_checkstock_list->TotalRecs;
} else {

	// Set the last record to display
	if ($tbl_checkstock_list->TotalRecs > $tbl_checkstock_list->StartRec + $tbl_checkstock_list->DisplayRecs - 1)
		$tbl_checkstock_list->StopRec = $tbl_checkstock_list->StartRec + $tbl_checkstock_list->DisplayRecs - 1;
	else
		$tbl_checkstock_list->StopRec = $tbl_checkstock_list->TotalRecs;
}
$tbl_checkstock_list->RecCnt = $tbl_checkstock_list->StartRec - 1;
if ($tbl_checkstock_list->Recordset && !$tbl_checkstock_list->Recordset->EOF) {
	$tbl_checkstock_list->Recordset->moveFirst();
	$selectLimit = $tbl_checkstock_list->UseSelectLimit;
	if (!$selectLimit && $tbl_checkstock_list->StartRec > 1)
		$tbl_checkstock_list->Recordset->move($tbl_checkstock_list->StartRec - 1);
} elseif (!$tbl_checkstock->AllowAddDeleteRow && $tbl_checkstock_list->StopRec == 0) {
	$tbl_checkstock_list->StopRec = $tbl_checkstock->GridAddRowCount;
}

// Initialize aggregate
$tbl_checkstock->RowType = ROWTYPE_AGGREGATEINIT;
$tbl_checkstock->resetAttributes();
$tbl_checkstock_list->renderRow();
while ($tbl_checkstock_list->RecCnt < $tbl_checkstock_list->StopRec) {
	$tbl_checkstock_list->RecCnt++;
	if ($tbl_checkstock_list->RecCnt >= $tbl_checkstock_list->StartRec) {
		$tbl_checkstock_list->RowCnt++;

		// Set up key count
		$tbl_checkstock_list->KeyCount = $tbl_checkstock_list->RowIndex;

		// Init row class and style
		$tbl_checkstock->resetAttributes();
		$tbl_checkstock->CssClass = "";
		if ($tbl_checkstock->isGridAdd()) {
		} else {
			$tbl_checkstock_list->loadRowValues($tbl_checkstock_list->Recordset); // Load row values
		}
		$tbl_checkstock->RowType = ROWTYPE_VIEW; // Render view

		// Set up row id / data-rowindex
		$tbl_checkstock->RowAttrs = array_merge($tbl_checkstock->RowAttrs, array('data-rowindex'=>$tbl_checkstock_list->RowCnt, 'id'=>'r' . $tbl_checkstock_list->RowCnt . '_tbl_checkstock', 'data-rowtype'=>$tbl_checkstock->RowType));

		// Render row
		$tbl_checkstock_list->renderRow();

		// Render list options
		$tbl_checkstock_list->renderListOptions();
?>
	<tr<?php echo $tbl_checkstock->rowAttributes() ?>>
<?php

// Render list options (body, left)
$tbl_checkstock_list->ListOptions->render("body", "left", $tbl_checkstock_list->RowCnt);
?>
	<?php if ($tbl_checkstock->tenDotKiemKho->Visible) { // tenDotKiemKho ?>
		<td data-name="tenDotKiemKho"<?php echo $tbl_checkstock->tenDotKiemKho->cellAttributes() ?>>
<span id="el<?php echo $tbl_checkstock_list->RowCnt ?>_tbl_checkstock_tenDotKiemKho" class="tbl_checkstock_tenDotKiemKho">
<span<?php echo $tbl_checkstock->tenDotKiemKho->viewAttributes() ?>>
<?php echo $tbl_checkstock->tenDotKiemKho->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($tbl_checkstock->NoiDung->Visible) { // NoiDung ?>
		<td data-name="NoiDung"<?php echo $tbl_checkstock->NoiDung->cellAttributes() ?>>
<span id="el<?php echo $tbl_checkstock_list->RowCnt ?>_tbl_checkstock_NoiDung" class="tbl_checkstock_NoiDung">
<span<?php echo $tbl_checkstock->NoiDung->viewAttributes() ?>>
<?php echo $tbl_checkstock->NoiDung->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($tbl_checkstock->UserCreate->Visible) { // UserCreate ?>
		<td data-name="UserCreate"<?php echo $tbl_checkstock->UserCreate->cellAttributes() ?>>
<span id="el<?php echo $tbl_checkstock_list->RowCnt ?>_tbl_checkstock_UserCreate" class="tbl_checkstock_UserCreate">
<span<?php echo $tbl_checkstock->UserCreate->viewAttributes() ?>>
<?php echo $tbl_checkstock->UserCreate->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($tbl_checkstock->DatetimeCreate->Visible) { // DatetimeCreate ?>
		<td data-name="DatetimeCreate"<?php echo $tbl_checkstock->DatetimeCreate->cellAttributes() ?>>
<span id="el<?php echo $tbl_checkstock_list->RowCnt ?>_tbl_checkstock_DatetimeCreate" class="tbl_checkstock_DatetimeCreate">
<span<?php echo $tbl_checkstock->DatetimeCreate->viewAttributes() ?>>
<?php echo $tbl_checkstock->DatetimeCreate->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($tbl_checkstock->UserUpdate->Visible) { // UserUpdate ?>
		<td data-name="UserUpdate"<?php echo $tbl_checkstock->UserUpdate->cellAttributes() ?>>
<span id="el<?php echo $tbl_checkstock_list->RowCnt ?>_tbl_checkstock_UserUpdate" class="tbl_checkstock_UserUpdate">
<span<?php echo $tbl_checkstock->UserUpdate->viewAttributes() ?>>
<?php echo $tbl_checkstock->UserUpdate->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($tbl_checkstock->DatetimeUpdate->Visible) { // DatetimeUpdate ?>
		<td data-name="DatetimeUpdate"<?php echo $tbl_checkstock->DatetimeUpdate->cellAttributes() ?>>
<span id="el<?php echo $tbl_checkstock_list->RowCnt ?>_tbl_checkstock_DatetimeUpdate" class="tbl_checkstock_DatetimeUpdate">
<span<?php echo $tbl_checkstock->DatetimeUpdate->viewAttributes() ?>>
<?php echo $tbl_checkstock->DatetimeUpdate->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$tbl_checkstock_list->ListOptions->render("body", "right", $tbl_checkstock_list->RowCnt);
?>
	</tr>
<?php
	}
	if (!$tbl_checkstock->isGridAdd())
		$tbl_checkstock_list->Recordset->moveNext();
}
?>
</tbody>
</table><!-- /.ew-table -->
<?php } ?>
<?php if (!$tbl_checkstock->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</div><!-- /.ew-grid-middle-panel -->
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($tbl_checkstock_list->Recordset)
	$tbl_checkstock_list->Recordset->Close();
?>
<?php if (!$tbl_checkstock->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$tbl_checkstock->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php if (!isset($tbl_checkstock_list->Pager)) $tbl_checkstock_list->Pager = new PrevNextPager($tbl_checkstock_list->StartRec, $tbl_checkstock_list->DisplayRecs, $tbl_checkstock_list->TotalRecs, $tbl_checkstock_list->AutoHidePager) ?>
<?php if ($tbl_checkstock_list->Pager->RecordCount > 0 && $tbl_checkstock_list->Pager->Visible) { ?>
<div class="ew-pager">
<span><?php echo $Language->Phrase("Page") ?>&nbsp;</span>
<div class="ew-prev-next"><div class="input-group input-group-sm">
<div class="input-group-prepend">
<!-- first page button -->
	<?php if ($tbl_checkstock_list->Pager->FirstButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerFirst") ?>" href="<?php echo $tbl_checkstock_list->pageUrl() ?>start=<?php echo $tbl_checkstock_list->Pager->FirstButton->Start ?>"><i class="icon-first ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerFirst") ?>"><i class="icon-first ew-icon"></i></a>
	<?php } ?>
<!-- previous page button -->
	<?php if ($tbl_checkstock_list->Pager->PrevButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerPrevious") ?>" href="<?php echo $tbl_checkstock_list->pageUrl() ?>start=<?php echo $tbl_checkstock_list->Pager->PrevButton->Start ?>"><i class="icon-prev ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerPrevious") ?>"><i class="icon-prev ew-icon"></i></a>
	<?php } ?>
</div>
<!-- current page number -->
	<input class="form-control" type="text" name="<?php echo TABLE_PAGE_NO ?>" value="<?php echo $tbl_checkstock_list->Pager->CurrentPage ?>">
<div class="input-group-append">
<!-- next page button -->
	<?php if ($tbl_checkstock_list->Pager->NextButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerNext") ?>" href="<?php echo $tbl_checkstock_list->pageUrl() ?>start=<?php echo $tbl_checkstock_list->Pager->NextButton->Start ?>"><i class="icon-next ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerNext") ?>"><i class="icon-next ew-icon"></i></a>
	<?php } ?>
<!-- last page button -->
	<?php if ($tbl_checkstock_list->Pager->LastButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerLast") ?>" href="<?php echo $tbl_checkstock_list->pageUrl() ?>start=<?php echo $tbl_checkstock_list->Pager->LastButton->Start ?>"><i class="icon-last ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerLast") ?>"><i class="icon-last ew-icon"></i></a>
	<?php } ?>
</div>
</div>
</div>
<span>&nbsp;<?php echo $Language->Phrase("of") ?>&nbsp;<?php echo $tbl_checkstock_list->Pager->PageCount ?></span>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php if ($tbl_checkstock_list->Pager->RecordCount > 0) { ?>
<div class="ew-pager ew-rec">
	<span><?php echo $Language->Phrase("Record") ?>&nbsp;<?php echo $tbl_checkstock_list->Pager->FromIndex ?>&nbsp;<?php echo $Language->Phrase("To") ?>&nbsp;<?php echo $tbl_checkstock_list->Pager->ToIndex ?>&nbsp;<?php echo $Language->Phrase("Of") ?>&nbsp;<?php echo $tbl_checkstock_list->Pager->RecordCount ?></span>
</div>
<?php } ?>
<?php if ($tbl_checkstock_list->TotalRecs > 0 && (!$tbl_checkstock_list->AutoHidePageSizeSelector || $tbl_checkstock_list->Pager->Visible)) { ?>
<div class="ew-pager">
<input type="hidden" name="t" value="tbl_checkstock">
<select name="<?php echo TABLE_REC_PER_PAGE ?>" class="form-control form-control-sm ew-tooltip" title="<?php echo $Language->phrase("RecordsPerPage") ?>" onchange="this.form.submit();">
<option value="20"<?php if ($tbl_checkstock_list->DisplayRecs == 20) { ?> selected<?php } ?>>20</option>
<option value="50"<?php if ($tbl_checkstock_list->DisplayRecs == 50) { ?> selected<?php } ?>>50</option>
<option value="100"<?php if ($tbl_checkstock_list->DisplayRecs == 100) { ?> selected<?php } ?>>100</option>
<option value="200"<?php if ($tbl_checkstock_list->DisplayRecs == 200) { ?> selected<?php } ?>>200</option>
<option value="500"<?php if ($tbl_checkstock_list->DisplayRecs == 500) { ?> selected<?php } ?>>500</option>
<option value="ALL"<?php if ($tbl_checkstock->getRecordsPerPage() == -1) { ?> selected<?php } ?>><?php echo $Language->Phrase("AllRecords") ?></option>
</select>
</div>
<?php } ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $tbl_checkstock_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($tbl_checkstock_list->TotalRecs == 0 && !$tbl_checkstock->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $tbl_checkstock_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$tbl_checkstock_list->showPageFooter();
if (DEBUG_ENABLED)
	echo GetDebugMessage();
?>
<?php if (!$tbl_checkstock->isExport()) { ?>
<script>

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php } ?>
<?php include_once "footer.php" ?>
<?php
$tbl_checkstock_list->terminate();
?>