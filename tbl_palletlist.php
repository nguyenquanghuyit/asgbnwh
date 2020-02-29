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
$tbl_pallet_list = new tbl_pallet_list();

// Run the page
$tbl_pallet_list->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$tbl_pallet_list->Page_Render();
?>
<?php include_once "header.php" ?>
<?php if (!$tbl_pallet->isExport()) { ?>
<script>

// Form object
currentPageID = ew.PAGE_ID = "list";
var ftbl_palletlist = currentForm = new ew.Form("ftbl_palletlist", "list");
ftbl_palletlist.formKeyCountName = '<?php echo $tbl_pallet_list->FormKeyCountName ?>';

// Form_CustomValidate event
ftbl_palletlist.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

	// Your custom validation code here, return false if invalid.
	return true;
}

// Use JavaScript validation or not
ftbl_palletlist.validateRequired = <?php echo json_encode(CLIENT_VALIDATE) ?>;

// Dynamic selection lists
ftbl_palletlist.lists["x_Id_Type"] = <?php echo $tbl_pallet_list->Id_Type->Lookup->toClientList() ?>;
ftbl_palletlist.lists["x_Id_Type"].options = <?php echo JsonEncode($tbl_pallet_list->Id_Type->lookupOptions()) ?>;
ftbl_palletlist.lists["x_ExistStatus"] = <?php echo $tbl_pallet_list->ExistStatus->Lookup->toClientList() ?>;
ftbl_palletlist.lists["x_ExistStatus"].options = <?php echo JsonEncode($tbl_pallet_list->ExistStatus->options(FALSE, TRUE)) ?>;
ftbl_palletlist.lists["x_PenddingStatus"] = <?php echo $tbl_pallet_list->PenddingStatus->Lookup->toClientList() ?>;
ftbl_palletlist.lists["x_PenddingStatus"].options = <?php echo JsonEncode($tbl_pallet_list->PenddingStatus->options(FALSE, TRUE)) ?>;

// Form object for search
var ftbl_palletlistsrch = currentSearchForm = new ew.Form("ftbl_palletlistsrch");

// Validate function for search
ftbl_palletlistsrch.validate = function(fobj) {
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
ftbl_palletlistsrch.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

	// Your custom validation code here, return false if invalid.
	return true;
}

// Use JavaScript validation or not
ftbl_palletlistsrch.validateRequired = <?php echo json_encode(CLIENT_VALIDATE) ?>;

// Dynamic selection lists
ftbl_palletlistsrch.lists["x_Id_Type"] = <?php echo $tbl_pallet_list->Id_Type->Lookup->toClientList() ?>;
ftbl_palletlistsrch.lists["x_Id_Type"].options = <?php echo JsonEncode($tbl_pallet_list->Id_Type->lookupOptions()) ?>;
ftbl_palletlistsrch.lists["x_ExistStatus"] = <?php echo $tbl_pallet_list->ExistStatus->Lookup->toClientList() ?>;
ftbl_palletlistsrch.lists["x_ExistStatus"].options = <?php echo JsonEncode($tbl_pallet_list->ExistStatus->options(FALSE, TRUE)) ?>;
ftbl_palletlistsrch.lists["x_PenddingStatus"] = <?php echo $tbl_pallet_list->PenddingStatus->Lookup->toClientList() ?>;
ftbl_palletlistsrch.lists["x_PenddingStatus"].options = <?php echo JsonEncode($tbl_pallet_list->PenddingStatus->options(FALSE, TRUE)) ?>;

// Filters
ftbl_palletlistsrch.filterList = <?php echo $tbl_pallet_list->getFilterList() ?>;
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
<?php if (!$tbl_pallet->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($tbl_pallet_list->TotalRecs > 0 && $tbl_pallet_list->ExportOptions->visible()) { ?>
<?php $tbl_pallet_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($tbl_pallet_list->ImportOptions->visible()) { ?>
<?php $tbl_pallet_list->ImportOptions->render("body") ?>
<?php } ?>
<?php if ($tbl_pallet_list->SearchOptions->visible()) { ?>
<?php $tbl_pallet_list->SearchOptions->render("body") ?>
<?php } ?>
<?php if ($tbl_pallet_list->FilterOptions->visible()) { ?>
<?php $tbl_pallet_list->FilterOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php
$tbl_pallet_list->renderOtherOptions();
?>
<?php if ($Security->CanSearch()) { ?>
<?php if (!$tbl_pallet->isExport() && !$tbl_pallet->CurrentAction) { ?>
<form name="ftbl_palletlistsrch" id="ftbl_palletlistsrch" class="form-inline ew-form ew-ext-search-form" action="<?php echo CurrentPageName() ?>">
<?php $searchPanelClass = ($tbl_pallet_list->SearchWhere <> "") ? " show" : " show"; ?>
<div id="ftbl_palletlistsrch-search-panel" class="ew-search-panel collapse<?php echo $searchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="tbl_pallet">
	<div class="ew-basic-search">
<?php
if ($SearchError == "")
	$tbl_pallet_list->LoadAdvancedSearch(); // Load advanced search

// Render for search
$tbl_pallet->RowType = ROWTYPE_SEARCH;

// Render row
$tbl_pallet->resetAttributes();
$tbl_pallet_list->renderRow();
?>
<div id="xsr_1" class="ew-row d-sm-flex">
<?php if ($tbl_pallet->Id_Type->Visible) { // Id_Type ?>
	<div id="xsc_Id_Type" class="ew-cell form-group">
		<label for="x_Id_Type" class="ew-search-caption ew-label"><?php echo $tbl_pallet->Id_Type->caption() ?></label>
		<span class="ew-search-operator"><?php echo $Language->phrase("LIKE") ?><input type="hidden" name="z_Id_Type" id="z_Id_Type" value="LIKE"></span>
		<span class="ew-search-field">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="tbl_pallet" data-field="x_Id_Type" data-value-separator="<?php echo $tbl_pallet->Id_Type->displayValueSeparatorAttribute() ?>" id="x_Id_Type" name="x_Id_Type"<?php echo $tbl_pallet->Id_Type->editAttributes() ?>>
		<?php echo $tbl_pallet->Id_Type->selectOptionListHtml("x_Id_Type") ?>
	</select>
</div>
<?php echo $tbl_pallet->Id_Type->Lookup->getParamTag("p_x_Id_Type") ?>
</span>
	</div>
<?php } ?>
</div>
<div id="xsr_2" class="ew-row d-sm-flex">
<?php if ($tbl_pallet->ExistStatus->Visible) { // ExistStatus ?>
	<div id="xsc_ExistStatus" class="ew-cell form-group">
		<label for="x_ExistStatus" class="ew-search-caption ew-label"><?php echo $tbl_pallet->ExistStatus->caption() ?></label>
		<span class="ew-search-operator"><?php echo $Language->phrase("=") ?><input type="hidden" name="z_ExistStatus" id="z_ExistStatus" value="="></span>
		<span class="ew-search-field">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="tbl_pallet" data-field="x_ExistStatus" data-value-separator="<?php echo $tbl_pallet->ExistStatus->displayValueSeparatorAttribute() ?>" id="x_ExistStatus" name="x_ExistStatus"<?php echo $tbl_pallet->ExistStatus->editAttributes() ?>>
		<?php echo $tbl_pallet->ExistStatus->selectOptionListHtml("x_ExistStatus") ?>
	</select>
</div>
</span>
	</div>
<?php } ?>
</div>
<div id="xsr_3" class="ew-row d-sm-flex">
<?php if ($tbl_pallet->PenddingStatus->Visible) { // PenddingStatus ?>
	<div id="xsc_PenddingStatus" class="ew-cell form-group">
		<label for="x_PenddingStatus" class="ew-search-caption ew-label"><?php echo $tbl_pallet->PenddingStatus->caption() ?></label>
		<span class="ew-search-operator"><?php echo $Language->phrase("=") ?><input type="hidden" name="z_PenddingStatus" id="z_PenddingStatus" value="="></span>
		<span class="ew-search-field">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="tbl_pallet" data-field="x_PenddingStatus" data-value-separator="<?php echo $tbl_pallet->PenddingStatus->displayValueSeparatorAttribute() ?>" id="x_PenddingStatus" name="x_PenddingStatus"<?php echo $tbl_pallet->PenddingStatus->editAttributes() ?>>
		<?php echo $tbl_pallet->PenddingStatus->selectOptionListHtml("x_PenddingStatus") ?>
	</select>
</div>
</span>
	</div>
<?php } ?>
</div>
<div id="xsr_4" class="ew-row d-sm-flex">
	<div class="ew-quick-search input-group">
		<input type="text" name="<?php echo TABLE_BASIC_SEARCH ?>" id="<?php echo TABLE_BASIC_SEARCH ?>" class="form-control" value="<?php echo HtmlEncode($tbl_pallet_list->BasicSearch->getKeyword()) ?>" placeholder="<?php echo HtmlEncode($Language->phrase("Search")) ?>">
		<input type="hidden" name="<?php echo TABLE_BASIC_SEARCH_TYPE ?>" id="<?php echo TABLE_BASIC_SEARCH_TYPE ?>" value="<?php echo HtmlEncode($tbl_pallet_list->BasicSearch->getType()) ?>">
		<div class="input-group-append">
			<button class="btn btn-primary" name="btn-submit" id="btn-submit" type="submit"><?php echo $Language->phrase("SearchBtn") ?></button>
			<button type="button" data-toggle="dropdown" class="btn btn-primary dropdown-toggle dropdown-toggle-split" aria-haspopup="true" aria-expanded="false"><span id="searchtype"><?php echo $tbl_pallet_list->BasicSearch->getTypeNameShort() ?></span></button>
			<div class="dropdown-menu dropdown-menu-right">
				<a class="dropdown-item<?php if ($tbl_pallet_list->BasicSearch->getType() == "") echo " active"; ?>" href="javascript:void(0);" onclick="ew.setSearchType(this)"><?php echo $Language->phrase("QuickSearchAuto") ?></a>
				<a class="dropdown-item<?php if ($tbl_pallet_list->BasicSearch->getType() == "=") echo " active"; ?>" href="javascript:void(0);" onclick="ew.setSearchType(this,'=')"><?php echo $Language->phrase("QuickSearchExact") ?></a>
				<a class="dropdown-item<?php if ($tbl_pallet_list->BasicSearch->getType() == "AND") echo " active"; ?>" href="javascript:void(0);" onclick="ew.setSearchType(this,'AND')"><?php echo $Language->phrase("QuickSearchAll") ?></a>
				<a class="dropdown-item<?php if ($tbl_pallet_list->BasicSearch->getType() == "OR") echo " active"; ?>" href="javascript:void(0);" onclick="ew.setSearchType(this,'OR')"><?php echo $Language->phrase("QuickSearchAny") ?></a>
			</div>
		</div>
	</div>
</div>
	</div>
</div>
</form>
<?php } ?>
<?php } ?>
<?php $tbl_pallet_list->showPageHeader(); ?>
<?php
$tbl_pallet_list->showMessage();
?>
<?php if ($tbl_pallet_list->TotalRecs > 0 || $tbl_pallet->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($tbl_pallet_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> tbl_pallet">
<?php if (!$tbl_pallet->isExport()) { ?>
<div class="card-header ew-grid-upper-panel">
<?php if (!$tbl_pallet->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php if (!isset($tbl_pallet_list->Pager)) $tbl_pallet_list->Pager = new PrevNextPager($tbl_pallet_list->StartRec, $tbl_pallet_list->DisplayRecs, $tbl_pallet_list->TotalRecs, $tbl_pallet_list->AutoHidePager) ?>
<?php if ($tbl_pallet_list->Pager->RecordCount > 0 && $tbl_pallet_list->Pager->Visible) { ?>
<div class="ew-pager">
<span><?php echo $Language->Phrase("Page") ?>&nbsp;</span>
<div class="ew-prev-next"><div class="input-group input-group-sm">
<div class="input-group-prepend">
<!-- first page button -->
	<?php if ($tbl_pallet_list->Pager->FirstButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerFirst") ?>" href="<?php echo $tbl_pallet_list->pageUrl() ?>start=<?php echo $tbl_pallet_list->Pager->FirstButton->Start ?>"><i class="icon-first ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerFirst") ?>"><i class="icon-first ew-icon"></i></a>
	<?php } ?>
<!-- previous page button -->
	<?php if ($tbl_pallet_list->Pager->PrevButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerPrevious") ?>" href="<?php echo $tbl_pallet_list->pageUrl() ?>start=<?php echo $tbl_pallet_list->Pager->PrevButton->Start ?>"><i class="icon-prev ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerPrevious") ?>"><i class="icon-prev ew-icon"></i></a>
	<?php } ?>
</div>
<!-- current page number -->
	<input class="form-control" type="text" name="<?php echo TABLE_PAGE_NO ?>" value="<?php echo $tbl_pallet_list->Pager->CurrentPage ?>">
<div class="input-group-append">
<!-- next page button -->
	<?php if ($tbl_pallet_list->Pager->NextButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerNext") ?>" href="<?php echo $tbl_pallet_list->pageUrl() ?>start=<?php echo $tbl_pallet_list->Pager->NextButton->Start ?>"><i class="icon-next ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerNext") ?>"><i class="icon-next ew-icon"></i></a>
	<?php } ?>
<!-- last page button -->
	<?php if ($tbl_pallet_list->Pager->LastButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerLast") ?>" href="<?php echo $tbl_pallet_list->pageUrl() ?>start=<?php echo $tbl_pallet_list->Pager->LastButton->Start ?>"><i class="icon-last ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerLast") ?>"><i class="icon-last ew-icon"></i></a>
	<?php } ?>
</div>
</div>
</div>
<span>&nbsp;<?php echo $Language->Phrase("of") ?>&nbsp;<?php echo $tbl_pallet_list->Pager->PageCount ?></span>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php if ($tbl_pallet_list->Pager->RecordCount > 0) { ?>
<div class="ew-pager ew-rec">
	<span><?php echo $Language->Phrase("Record") ?>&nbsp;<?php echo $tbl_pallet_list->Pager->FromIndex ?>&nbsp;<?php echo $Language->Phrase("To") ?>&nbsp;<?php echo $tbl_pallet_list->Pager->ToIndex ?>&nbsp;<?php echo $Language->Phrase("Of") ?>&nbsp;<?php echo $tbl_pallet_list->Pager->RecordCount ?></span>
</div>
<?php } ?>
<?php if ($tbl_pallet_list->TotalRecs > 0 && (!$tbl_pallet_list->AutoHidePageSizeSelector || $tbl_pallet_list->Pager->Visible)) { ?>
<div class="ew-pager">
<input type="hidden" name="t" value="tbl_pallet">
<select name="<?php echo TABLE_REC_PER_PAGE ?>" class="form-control form-control-sm ew-tooltip" title="<?php echo $Language->phrase("RecordsPerPage") ?>" onchange="this.form.submit();">
<option value="20"<?php if ($tbl_pallet_list->DisplayRecs == 20) { ?> selected<?php } ?>>20</option>
<option value="50"<?php if ($tbl_pallet_list->DisplayRecs == 50) { ?> selected<?php } ?>>50</option>
<option value="100"<?php if ($tbl_pallet_list->DisplayRecs == 100) { ?> selected<?php } ?>>100</option>
<option value="200"<?php if ($tbl_pallet_list->DisplayRecs == 200) { ?> selected<?php } ?>>200</option>
<option value="500"<?php if ($tbl_pallet_list->DisplayRecs == 500) { ?> selected<?php } ?>>500</option>
<option value="ALL"<?php if ($tbl_pallet->getRecordsPerPage() == -1) { ?> selected<?php } ?>><?php echo $Language->Phrase("AllRecords") ?></option>
</select>
</div>
<?php } ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $tbl_pallet_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
<form name="ftbl_palletlist" id="ftbl_palletlist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($tbl_pallet_list->CheckToken) { ?>
<input type="hidden" name="<?php echo TOKEN_NAME ?>" value="<?php echo $tbl_pallet_list->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="tbl_pallet">
<input type="hidden" name="exporttype" id="exporttype" value="">
<div id="gmp_tbl_pallet" class="<?php if (IsResponsiveLayout()) { ?>table-responsive <?php } ?>card-body ew-grid-middle-panel">
<?php if ($tbl_pallet_list->TotalRecs > 0 || $tbl_pallet->isGridEdit()) { ?>
<table id="tbl_tbl_palletlist" class="table ew-table"><!-- .ew-table ##-->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$tbl_pallet_list->RowType = ROWTYPE_HEADER;

// Render list options
$tbl_pallet_list->renderListOptions();

// Render list options (header, left)
$tbl_pallet_list->ListOptions->render("header", "left");
?>
<?php if ($tbl_pallet->PalletID->Visible) { // PalletID ?>
	<?php if ($tbl_pallet->sortUrl($tbl_pallet->PalletID) == "") { ?>
		<th data-name="PalletID" class="<?php echo $tbl_pallet->PalletID->headerCellClass() ?>" style="white-space: nowrap;"><div id="elh_tbl_pallet_PalletID" class="tbl_pallet_PalletID"><div class="ew-table-header-caption"><?php echo $tbl_pallet->PalletID->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="PalletID" class="<?php echo $tbl_pallet->PalletID->headerCellClass() ?>" style="white-space: nowrap;"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $tbl_pallet->SortUrl($tbl_pallet->PalletID) ?>',2);"><div id="elh_tbl_pallet_PalletID" class="tbl_pallet_PalletID">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $tbl_pallet->PalletID->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($tbl_pallet->PalletID->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($tbl_pallet->PalletID->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($tbl_pallet->Code->Visible) { // Code ?>
	<?php if ($tbl_pallet->sortUrl($tbl_pallet->Code) == "") { ?>
		<th data-name="Code" class="<?php echo $tbl_pallet->Code->headerCellClass() ?>" style="white-space: nowrap;"><div id="elh_tbl_pallet_Code" class="tbl_pallet_Code"><div class="ew-table-header-caption"><?php echo $tbl_pallet->Code->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Code" class="<?php echo $tbl_pallet->Code->headerCellClass() ?>" style="white-space: nowrap;"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $tbl_pallet->SortUrl($tbl_pallet->Code) ?>',2);"><div id="elh_tbl_pallet_Code" class="tbl_pallet_Code">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $tbl_pallet->Code->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($tbl_pallet->Code->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($tbl_pallet->Code->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($tbl_pallet->Id_Type->Visible) { // Id_Type ?>
	<?php if ($tbl_pallet->sortUrl($tbl_pallet->Id_Type) == "") { ?>
		<th data-name="Id_Type" class="<?php echo $tbl_pallet->Id_Type->headerCellClass() ?>" style="white-space: nowrap;"><div id="elh_tbl_pallet_Id_Type" class="tbl_pallet_Id_Type"><div class="ew-table-header-caption"><?php echo $tbl_pallet->Id_Type->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Id_Type" class="<?php echo $tbl_pallet->Id_Type->headerCellClass() ?>" style="white-space: nowrap;"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $tbl_pallet->SortUrl($tbl_pallet->Id_Type) ?>',2);"><div id="elh_tbl_pallet_Id_Type" class="tbl_pallet_Id_Type">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $tbl_pallet->Id_Type->caption() ?></span><span class="ew-table-header-sort"><?php if ($tbl_pallet->Id_Type->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($tbl_pallet->Id_Type->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($tbl_pallet->PCS->Visible) { // PCS ?>
	<?php if ($tbl_pallet->sortUrl($tbl_pallet->PCS) == "") { ?>
		<th data-name="PCS" class="<?php echo $tbl_pallet->PCS->headerCellClass() ?>" style="white-space: nowrap;"><div id="elh_tbl_pallet_PCS" class="tbl_pallet_PCS"><div class="ew-table-header-caption"><?php echo $tbl_pallet->PCS->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="PCS" class="<?php echo $tbl_pallet->PCS->headerCellClass() ?>" style="white-space: nowrap;"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $tbl_pallet->SortUrl($tbl_pallet->PCS) ?>',2);"><div id="elh_tbl_pallet_PCS" class="tbl_pallet_PCS">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $tbl_pallet->PCS->caption() ?></span><span class="ew-table-header-sort"><?php if ($tbl_pallet->PCS->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($tbl_pallet->PCS->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($tbl_pallet->ExistStatus->Visible) { // ExistStatus ?>
	<?php if ($tbl_pallet->sortUrl($tbl_pallet->ExistStatus) == "") { ?>
		<th data-name="ExistStatus" class="<?php echo $tbl_pallet->ExistStatus->headerCellClass() ?>" style="white-space: nowrap;"><div id="elh_tbl_pallet_ExistStatus" class="tbl_pallet_ExistStatus"><div class="ew-table-header-caption"><?php echo $tbl_pallet->ExistStatus->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="ExistStatus" class="<?php echo $tbl_pallet->ExistStatus->headerCellClass() ?>" style="white-space: nowrap;"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $tbl_pallet->SortUrl($tbl_pallet->ExistStatus) ?>',2);"><div id="elh_tbl_pallet_ExistStatus" class="tbl_pallet_ExistStatus">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $tbl_pallet->ExistStatus->caption() ?></span><span class="ew-table-header-sort"><?php if ($tbl_pallet->ExistStatus->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($tbl_pallet->ExistStatus->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($tbl_pallet->CreateUser->Visible) { // CreateUser ?>
	<?php if ($tbl_pallet->sortUrl($tbl_pallet->CreateUser) == "") { ?>
		<th data-name="CreateUser" class="<?php echo $tbl_pallet->CreateUser->headerCellClass() ?>" style="white-space: nowrap;"><div id="elh_tbl_pallet_CreateUser" class="tbl_pallet_CreateUser"><div class="ew-table-header-caption"><?php echo $tbl_pallet->CreateUser->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="CreateUser" class="<?php echo $tbl_pallet->CreateUser->headerCellClass() ?>" style="white-space: nowrap;"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $tbl_pallet->SortUrl($tbl_pallet->CreateUser) ?>',2);"><div id="elh_tbl_pallet_CreateUser" class="tbl_pallet_CreateUser">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $tbl_pallet->CreateUser->caption() ?></span><span class="ew-table-header-sort"><?php if ($tbl_pallet->CreateUser->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($tbl_pallet->CreateUser->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($tbl_pallet->CreateDate->Visible) { // CreateDate ?>
	<?php if ($tbl_pallet->sortUrl($tbl_pallet->CreateDate) == "") { ?>
		<th data-name="CreateDate" class="<?php echo $tbl_pallet->CreateDate->headerCellClass() ?>" style="white-space: nowrap;"><div id="elh_tbl_pallet_CreateDate" class="tbl_pallet_CreateDate"><div class="ew-table-header-caption"><?php echo $tbl_pallet->CreateDate->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="CreateDate" class="<?php echo $tbl_pallet->CreateDate->headerCellClass() ?>" style="white-space: nowrap;"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $tbl_pallet->SortUrl($tbl_pallet->CreateDate) ?>',2);"><div id="elh_tbl_pallet_CreateDate" class="tbl_pallet_CreateDate">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $tbl_pallet->CreateDate->caption() ?></span><span class="ew-table-header-sort"><?php if ($tbl_pallet->CreateDate->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($tbl_pallet->CreateDate->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($tbl_pallet->PenddingStatus->Visible) { // PenddingStatus ?>
	<?php if ($tbl_pallet->sortUrl($tbl_pallet->PenddingStatus) == "") { ?>
		<th data-name="PenddingStatus" class="<?php echo $tbl_pallet->PenddingStatus->headerCellClass() ?>" style="white-space: nowrap;"><div id="elh_tbl_pallet_PenddingStatus" class="tbl_pallet_PenddingStatus"><div class="ew-table-header-caption"><?php echo $tbl_pallet->PenddingStatus->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="PenddingStatus" class="<?php echo $tbl_pallet->PenddingStatus->headerCellClass() ?>" style="white-space: nowrap;"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $tbl_pallet->SortUrl($tbl_pallet->PenddingStatus) ?>',2);"><div id="elh_tbl_pallet_PenddingStatus" class="tbl_pallet_PenddingStatus">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $tbl_pallet->PenddingStatus->caption() ?></span><span class="ew-table-header-sort"><?php if ($tbl_pallet->PenddingStatus->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($tbl_pallet->PenddingStatus->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($tbl_pallet->UserFinishPendding->Visible) { // UserFinishPendding ?>
	<?php if ($tbl_pallet->sortUrl($tbl_pallet->UserFinishPendding) == "") { ?>
		<th data-name="UserFinishPendding" class="<?php echo $tbl_pallet->UserFinishPendding->headerCellClass() ?>" style="white-space: nowrap;"><div id="elh_tbl_pallet_UserFinishPendding" class="tbl_pallet_UserFinishPendding"><div class="ew-table-header-caption"><?php echo $tbl_pallet->UserFinishPendding->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="UserFinishPendding" class="<?php echo $tbl_pallet->UserFinishPendding->headerCellClass() ?>" style="white-space: nowrap;"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $tbl_pallet->SortUrl($tbl_pallet->UserFinishPendding) ?>',2);"><div id="elh_tbl_pallet_UserFinishPendding" class="tbl_pallet_UserFinishPendding">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $tbl_pallet->UserFinishPendding->caption() ?></span><span class="ew-table-header-sort"><?php if ($tbl_pallet->UserFinishPendding->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($tbl_pallet->UserFinishPendding->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($tbl_pallet->DateTimeFinishPedding->Visible) { // DateTimeFinishPedding ?>
	<?php if ($tbl_pallet->sortUrl($tbl_pallet->DateTimeFinishPedding) == "") { ?>
		<th data-name="DateTimeFinishPedding" class="<?php echo $tbl_pallet->DateTimeFinishPedding->headerCellClass() ?>" style="white-space: nowrap;"><div id="elh_tbl_pallet_DateTimeFinishPedding" class="tbl_pallet_DateTimeFinishPedding"><div class="ew-table-header-caption"><?php echo $tbl_pallet->DateTimeFinishPedding->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="DateTimeFinishPedding" class="<?php echo $tbl_pallet->DateTimeFinishPedding->headerCellClass() ?>" style="white-space: nowrap;"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $tbl_pallet->SortUrl($tbl_pallet->DateTimeFinishPedding) ?>',2);"><div id="elh_tbl_pallet_DateTimeFinishPedding" class="tbl_pallet_DateTimeFinishPedding">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $tbl_pallet->DateTimeFinishPedding->caption() ?></span><span class="ew-table-header-sort"><?php if ($tbl_pallet->DateTimeFinishPedding->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($tbl_pallet->DateTimeFinishPedding->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$tbl_pallet_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
if ($tbl_pallet->ExportAll && $tbl_pallet->isExport()) {
	$tbl_pallet_list->StopRec = $tbl_pallet_list->TotalRecs;
} else {

	// Set the last record to display
	if ($tbl_pallet_list->TotalRecs > $tbl_pallet_list->StartRec + $tbl_pallet_list->DisplayRecs - 1)
		$tbl_pallet_list->StopRec = $tbl_pallet_list->StartRec + $tbl_pallet_list->DisplayRecs - 1;
	else
		$tbl_pallet_list->StopRec = $tbl_pallet_list->TotalRecs;
}
$tbl_pallet_list->RecCnt = $tbl_pallet_list->StartRec - 1;
if ($tbl_pallet_list->Recordset && !$tbl_pallet_list->Recordset->EOF) {
	$tbl_pallet_list->Recordset->moveFirst();
	$selectLimit = $tbl_pallet_list->UseSelectLimit;
	if (!$selectLimit && $tbl_pallet_list->StartRec > 1)
		$tbl_pallet_list->Recordset->move($tbl_pallet_list->StartRec - 1);
} elseif (!$tbl_pallet->AllowAddDeleteRow && $tbl_pallet_list->StopRec == 0) {
	$tbl_pallet_list->StopRec = $tbl_pallet->GridAddRowCount;
}

// Initialize aggregate
$tbl_pallet->RowType = ROWTYPE_AGGREGATEINIT;
$tbl_pallet->resetAttributes();
$tbl_pallet_list->renderRow();
while ($tbl_pallet_list->RecCnt < $tbl_pallet_list->StopRec) {
	$tbl_pallet_list->RecCnt++;
	if ($tbl_pallet_list->RecCnt >= $tbl_pallet_list->StartRec) {
		$tbl_pallet_list->RowCnt++;

		// Set up key count
		$tbl_pallet_list->KeyCount = $tbl_pallet_list->RowIndex;

		// Init row class and style
		$tbl_pallet->resetAttributes();
		$tbl_pallet->CssClass = "";
		if ($tbl_pallet->isGridAdd()) {
		} else {
			$tbl_pallet_list->loadRowValues($tbl_pallet_list->Recordset); // Load row values
		}
		$tbl_pallet->RowType = ROWTYPE_VIEW; // Render view

		// Set up row id / data-rowindex
		$tbl_pallet->RowAttrs = array_merge($tbl_pallet->RowAttrs, array('data-rowindex'=>$tbl_pallet_list->RowCnt, 'id'=>'r' . $tbl_pallet_list->RowCnt . '_tbl_pallet', 'data-rowtype'=>$tbl_pallet->RowType));

		// Render row
		$tbl_pallet_list->renderRow();

		// Render list options
		$tbl_pallet_list->renderListOptions();
?>
	<tr<?php echo $tbl_pallet->rowAttributes() ?>>
<?php

// Render list options (body, left)
$tbl_pallet_list->ListOptions->render("body", "left", $tbl_pallet_list->RowCnt);
?>
	<?php if ($tbl_pallet->PalletID->Visible) { // PalletID ?>
		<td data-name="PalletID"<?php echo $tbl_pallet->PalletID->cellAttributes() ?>>
<span id="el<?php echo $tbl_pallet_list->RowCnt ?>_tbl_pallet_PalletID" class="tbl_pallet_PalletID">
<span<?php echo $tbl_pallet->PalletID->viewAttributes() ?>>
<?php echo $tbl_pallet->PalletID->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($tbl_pallet->Code->Visible) { // Code ?>
		<td data-name="Code"<?php echo $tbl_pallet->Code->cellAttributes() ?>>
<span id="el<?php echo $tbl_pallet_list->RowCnt ?>_tbl_pallet_Code" class="tbl_pallet_Code">
<span<?php echo $tbl_pallet->Code->viewAttributes() ?>>
<?php echo $tbl_pallet->Code->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($tbl_pallet->Id_Type->Visible) { // Id_Type ?>
		<td data-name="Id_Type"<?php echo $tbl_pallet->Id_Type->cellAttributes() ?>>
<span id="el<?php echo $tbl_pallet_list->RowCnt ?>_tbl_pallet_Id_Type" class="tbl_pallet_Id_Type">
<span<?php echo $tbl_pallet->Id_Type->viewAttributes() ?>>
<?php echo $tbl_pallet->Id_Type->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($tbl_pallet->PCS->Visible) { // PCS ?>
		<td data-name="PCS"<?php echo $tbl_pallet->PCS->cellAttributes() ?>>
<span id="el<?php echo $tbl_pallet_list->RowCnt ?>_tbl_pallet_PCS" class="tbl_pallet_PCS">
<span<?php echo $tbl_pallet->PCS->viewAttributes() ?>>
<?php echo $tbl_pallet->PCS->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($tbl_pallet->ExistStatus->Visible) { // ExistStatus ?>
		<td data-name="ExistStatus"<?php echo $tbl_pallet->ExistStatus->cellAttributes() ?>>
<span id="el<?php echo $tbl_pallet_list->RowCnt ?>_tbl_pallet_ExistStatus" class="tbl_pallet_ExistStatus">
<span<?php echo $tbl_pallet->ExistStatus->viewAttributes() ?>>
<?php echo $tbl_pallet->ExistStatus->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($tbl_pallet->CreateUser->Visible) { // CreateUser ?>
		<td data-name="CreateUser"<?php echo $tbl_pallet->CreateUser->cellAttributes() ?>>
<span id="el<?php echo $tbl_pallet_list->RowCnt ?>_tbl_pallet_CreateUser" class="tbl_pallet_CreateUser">
<span<?php echo $tbl_pallet->CreateUser->viewAttributes() ?>>
<?php echo $tbl_pallet->CreateUser->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($tbl_pallet->CreateDate->Visible) { // CreateDate ?>
		<td data-name="CreateDate"<?php echo $tbl_pallet->CreateDate->cellAttributes() ?>>
<span id="el<?php echo $tbl_pallet_list->RowCnt ?>_tbl_pallet_CreateDate" class="tbl_pallet_CreateDate">
<span<?php echo $tbl_pallet->CreateDate->viewAttributes() ?>>
<?php echo $tbl_pallet->CreateDate->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($tbl_pallet->PenddingStatus->Visible) { // PenddingStatus ?>
		<td data-name="PenddingStatus"<?php echo $tbl_pallet->PenddingStatus->cellAttributes() ?>>
<span id="el<?php echo $tbl_pallet_list->RowCnt ?>_tbl_pallet_PenddingStatus" class="tbl_pallet_PenddingStatus">
<span<?php echo $tbl_pallet->PenddingStatus->viewAttributes() ?>>
<?php echo $tbl_pallet->PenddingStatus->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($tbl_pallet->UserFinishPendding->Visible) { // UserFinishPendding ?>
		<td data-name="UserFinishPendding"<?php echo $tbl_pallet->UserFinishPendding->cellAttributes() ?>>
<span id="el<?php echo $tbl_pallet_list->RowCnt ?>_tbl_pallet_UserFinishPendding" class="tbl_pallet_UserFinishPendding">
<span<?php echo $tbl_pallet->UserFinishPendding->viewAttributes() ?>>
<?php echo $tbl_pallet->UserFinishPendding->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($tbl_pallet->DateTimeFinishPedding->Visible) { // DateTimeFinishPedding ?>
		<td data-name="DateTimeFinishPedding"<?php echo $tbl_pallet->DateTimeFinishPedding->cellAttributes() ?>>
<span id="el<?php echo $tbl_pallet_list->RowCnt ?>_tbl_pallet_DateTimeFinishPedding" class="tbl_pallet_DateTimeFinishPedding">
<span<?php echo $tbl_pallet->DateTimeFinishPedding->viewAttributes() ?>>
<?php echo $tbl_pallet->DateTimeFinishPedding->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$tbl_pallet_list->ListOptions->render("body", "right", $tbl_pallet_list->RowCnt);
?>
	</tr>
<?php
	}
	if (!$tbl_pallet->isGridAdd())
		$tbl_pallet_list->Recordset->moveNext();
}
?>
</tbody>
<?php

// Render aggregate row
$tbl_pallet->RowType = ROWTYPE_AGGREGATE;
$tbl_pallet->resetAttributes();
$tbl_pallet_list->renderRow();
?>
<?php if ($tbl_pallet_list->TotalRecs > 0 && !$tbl_pallet->isGridAdd() && !$tbl_pallet->isGridEdit()) { ?>
<tfoot><!-- Table footer -->
	<tr class="ew-table-footer">
<?php

// Render list options
$tbl_pallet_list->renderListOptions();

// Render list options (footer, left)
$tbl_pallet_list->ListOptions->render("footer", "left");
?>
	<?php if ($tbl_pallet->PalletID->Visible) { // PalletID ?>
		<td data-name="PalletID" class="<?php echo $tbl_pallet->PalletID->footerCellClass() ?>"><span id="elf_tbl_pallet_PalletID" class="tbl_pallet_PalletID">
		&nbsp;
		</span></td>
	<?php } ?>
	<?php if ($tbl_pallet->Code->Visible) { // Code ?>
		<td data-name="Code" class="<?php echo $tbl_pallet->Code->footerCellClass() ?>"><span id="elf_tbl_pallet_Code" class="tbl_pallet_Code">
		&nbsp;
		</span></td>
	<?php } ?>
	<?php if ($tbl_pallet->Id_Type->Visible) { // Id_Type ?>
		<td data-name="Id_Type" class="<?php echo $tbl_pallet->Id_Type->footerCellClass() ?>"><span id="elf_tbl_pallet_Id_Type" class="tbl_pallet_Id_Type">
		&nbsp;
		</span></td>
	<?php } ?>
	<?php if ($tbl_pallet->PCS->Visible) { // PCS ?>
		<td data-name="PCS" class="<?php echo $tbl_pallet->PCS->footerCellClass() ?>"><span id="elf_tbl_pallet_PCS" class="tbl_pallet_PCS">
		<span class="ew-aggregate"><?php echo $Language->phrase("TOTAL") ?></span><span class="ew-aggregate-value">
		<?php echo $tbl_pallet->PCS->ViewValue ?></span>
		</span></td>
	<?php } ?>
	<?php if ($tbl_pallet->ExistStatus->Visible) { // ExistStatus ?>
		<td data-name="ExistStatus" class="<?php echo $tbl_pallet->ExistStatus->footerCellClass() ?>"><span id="elf_tbl_pallet_ExistStatus" class="tbl_pallet_ExistStatus">
		&nbsp;
		</span></td>
	<?php } ?>
	<?php if ($tbl_pallet->CreateUser->Visible) { // CreateUser ?>
		<td data-name="CreateUser" class="<?php echo $tbl_pallet->CreateUser->footerCellClass() ?>"><span id="elf_tbl_pallet_CreateUser" class="tbl_pallet_CreateUser">
		&nbsp;
		</span></td>
	<?php } ?>
	<?php if ($tbl_pallet->CreateDate->Visible) { // CreateDate ?>
		<td data-name="CreateDate" class="<?php echo $tbl_pallet->CreateDate->footerCellClass() ?>"><span id="elf_tbl_pallet_CreateDate" class="tbl_pallet_CreateDate">
		&nbsp;
		</span></td>
	<?php } ?>
	<?php if ($tbl_pallet->PenddingStatus->Visible) { // PenddingStatus ?>
		<td data-name="PenddingStatus" class="<?php echo $tbl_pallet->PenddingStatus->footerCellClass() ?>"><span id="elf_tbl_pallet_PenddingStatus" class="tbl_pallet_PenddingStatus">
		&nbsp;
		</span></td>
	<?php } ?>
	<?php if ($tbl_pallet->UserFinishPendding->Visible) { // UserFinishPendding ?>
		<td data-name="UserFinishPendding" class="<?php echo $tbl_pallet->UserFinishPendding->footerCellClass() ?>"><span id="elf_tbl_pallet_UserFinishPendding" class="tbl_pallet_UserFinishPendding">
		&nbsp;
		</span></td>
	<?php } ?>
	<?php if ($tbl_pallet->DateTimeFinishPedding->Visible) { // DateTimeFinishPedding ?>
		<td data-name="DateTimeFinishPedding" class="<?php echo $tbl_pallet->DateTimeFinishPedding->footerCellClass() ?>"><span id="elf_tbl_pallet_DateTimeFinishPedding" class="tbl_pallet_DateTimeFinishPedding">
		&nbsp;
		</span></td>
	<?php } ?>
<?php

// Render list options (footer, right)
$tbl_pallet_list->ListOptions->render("footer", "right");
?>
	</tr>
</tfoot>
<?php } ?>
</table><!-- /.ew-table -->
<?php } ?>
<?php if (!$tbl_pallet->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</div><!-- /.ew-grid-middle-panel -->
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($tbl_pallet_list->Recordset)
	$tbl_pallet_list->Recordset->Close();
?>
<?php if (!$tbl_pallet->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$tbl_pallet->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php if (!isset($tbl_pallet_list->Pager)) $tbl_pallet_list->Pager = new PrevNextPager($tbl_pallet_list->StartRec, $tbl_pallet_list->DisplayRecs, $tbl_pallet_list->TotalRecs, $tbl_pallet_list->AutoHidePager) ?>
<?php if ($tbl_pallet_list->Pager->RecordCount > 0 && $tbl_pallet_list->Pager->Visible) { ?>
<div class="ew-pager">
<span><?php echo $Language->Phrase("Page") ?>&nbsp;</span>
<div class="ew-prev-next"><div class="input-group input-group-sm">
<div class="input-group-prepend">
<!-- first page button -->
	<?php if ($tbl_pallet_list->Pager->FirstButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerFirst") ?>" href="<?php echo $tbl_pallet_list->pageUrl() ?>start=<?php echo $tbl_pallet_list->Pager->FirstButton->Start ?>"><i class="icon-first ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerFirst") ?>"><i class="icon-first ew-icon"></i></a>
	<?php } ?>
<!-- previous page button -->
	<?php if ($tbl_pallet_list->Pager->PrevButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerPrevious") ?>" href="<?php echo $tbl_pallet_list->pageUrl() ?>start=<?php echo $tbl_pallet_list->Pager->PrevButton->Start ?>"><i class="icon-prev ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerPrevious") ?>"><i class="icon-prev ew-icon"></i></a>
	<?php } ?>
</div>
<!-- current page number -->
	<input class="form-control" type="text" name="<?php echo TABLE_PAGE_NO ?>" value="<?php echo $tbl_pallet_list->Pager->CurrentPage ?>">
<div class="input-group-append">
<!-- next page button -->
	<?php if ($tbl_pallet_list->Pager->NextButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerNext") ?>" href="<?php echo $tbl_pallet_list->pageUrl() ?>start=<?php echo $tbl_pallet_list->Pager->NextButton->Start ?>"><i class="icon-next ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerNext") ?>"><i class="icon-next ew-icon"></i></a>
	<?php } ?>
<!-- last page button -->
	<?php if ($tbl_pallet_list->Pager->LastButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerLast") ?>" href="<?php echo $tbl_pallet_list->pageUrl() ?>start=<?php echo $tbl_pallet_list->Pager->LastButton->Start ?>"><i class="icon-last ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerLast") ?>"><i class="icon-last ew-icon"></i></a>
	<?php } ?>
</div>
</div>
</div>
<span>&nbsp;<?php echo $Language->Phrase("of") ?>&nbsp;<?php echo $tbl_pallet_list->Pager->PageCount ?></span>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php if ($tbl_pallet_list->Pager->RecordCount > 0) { ?>
<div class="ew-pager ew-rec">
	<span><?php echo $Language->Phrase("Record") ?>&nbsp;<?php echo $tbl_pallet_list->Pager->FromIndex ?>&nbsp;<?php echo $Language->Phrase("To") ?>&nbsp;<?php echo $tbl_pallet_list->Pager->ToIndex ?>&nbsp;<?php echo $Language->Phrase("Of") ?>&nbsp;<?php echo $tbl_pallet_list->Pager->RecordCount ?></span>
</div>
<?php } ?>
<?php if ($tbl_pallet_list->TotalRecs > 0 && (!$tbl_pallet_list->AutoHidePageSizeSelector || $tbl_pallet_list->Pager->Visible)) { ?>
<div class="ew-pager">
<input type="hidden" name="t" value="tbl_pallet">
<select name="<?php echo TABLE_REC_PER_PAGE ?>" class="form-control form-control-sm ew-tooltip" title="<?php echo $Language->phrase("RecordsPerPage") ?>" onchange="this.form.submit();">
<option value="20"<?php if ($tbl_pallet_list->DisplayRecs == 20) { ?> selected<?php } ?>>20</option>
<option value="50"<?php if ($tbl_pallet_list->DisplayRecs == 50) { ?> selected<?php } ?>>50</option>
<option value="100"<?php if ($tbl_pallet_list->DisplayRecs == 100) { ?> selected<?php } ?>>100</option>
<option value="200"<?php if ($tbl_pallet_list->DisplayRecs == 200) { ?> selected<?php } ?>>200</option>
<option value="500"<?php if ($tbl_pallet_list->DisplayRecs == 500) { ?> selected<?php } ?>>500</option>
<option value="ALL"<?php if ($tbl_pallet->getRecordsPerPage() == -1) { ?> selected<?php } ?>><?php echo $Language->Phrase("AllRecords") ?></option>
</select>
</div>
<?php } ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $tbl_pallet_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($tbl_pallet_list->TotalRecs == 0 && !$tbl_pallet->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $tbl_pallet_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$tbl_pallet_list->showPageFooter();
if (DEBUG_ENABLED)
	echo GetDebugMessage();
?>
<?php if (!$tbl_pallet->isExport()) { ?>
<script>

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php } ?>
<?php include_once "footer.php" ?>
<?php
$tbl_pallet_list->terminate();
?>