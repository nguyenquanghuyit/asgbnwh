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
$tbl_history_list = new tbl_history_list();

// Run the page
$tbl_history_list->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$tbl_history_list->Page_Render();
?>
<?php include_once "header.php" ?>
<?php if (!$tbl_history->isExport()) { ?>
<script>

// Form object
currentPageID = ew.PAGE_ID = "list";
var ftbl_historylist = currentForm = new ew.Form("ftbl_historylist", "list");
ftbl_historylist.formKeyCountName = '<?php echo $tbl_history_list->FormKeyCountName ?>';

// Form_CustomValidate event
ftbl_historylist.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

	// Your custom validation code here, return false if invalid.
	return true;
}

// Use JavaScript validation or not
ftbl_historylist.validateRequired = <?php echo json_encode(CLIENT_VALIDATE) ?>;

// Dynamic selection lists
ftbl_historylist.lists["x_ID_Location"] = <?php echo $tbl_history_list->ID_Location->Lookup->toClientList() ?>;
ftbl_historylist.lists["x_ID_Location"].options = <?php echo JsonEncode($tbl_history_list->ID_Location->lookupOptions()) ?>;
ftbl_historylist.autoSuggests["x_ID_Location"] = <?php echo json_encode(["data" => "ajax=autosuggest"]) ?>;

// Form object for search
var ftbl_historylistsrch = currentSearchForm = new ew.Form("ftbl_historylistsrch");

// Validate function for search
ftbl_historylistsrch.validate = function(fobj) {
	if (!this.validateRequired)
		return true; // Ignore validation
	fobj = fobj || this._form;
	var infix = "";
	elm = this.getElements("x" + infix + "_ID_Order");
	if (elm && !ew.checkInteger(elm.value))
		return this.onError(elm, "<?php echo JsEncode($tbl_history->ID_Order->errorMessage()) ?>");

	// Fire Form_CustomValidate event
	if (!this.Form_CustomValidate(fobj))
		return false;
	return true;
}

// Form_CustomValidate event
ftbl_historylistsrch.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

	// Your custom validation code here, return false if invalid.
	return true;
}

// Use JavaScript validation or not
ftbl_historylistsrch.validateRequired = <?php echo json_encode(CLIENT_VALIDATE) ?>;

// Dynamic selection lists
// Filters

ftbl_historylistsrch.filterList = <?php echo $tbl_history_list->getFilterList() ?>;
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
<?php if (!$tbl_history->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($tbl_history_list->TotalRecs > 0 && $tbl_history_list->ExportOptions->visible()) { ?>
<?php $tbl_history_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($tbl_history_list->ImportOptions->visible()) { ?>
<?php $tbl_history_list->ImportOptions->render("body") ?>
<?php } ?>
<?php if ($tbl_history_list->SearchOptions->visible()) { ?>
<?php $tbl_history_list->SearchOptions->render("body") ?>
<?php } ?>
<?php if ($tbl_history_list->FilterOptions->visible()) { ?>
<?php $tbl_history_list->FilterOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php
$tbl_history_list->renderOtherOptions();
?>
<?php if ($Security->CanSearch()) { ?>
<?php if (!$tbl_history->isExport() && !$tbl_history->CurrentAction) { ?>
<form name="ftbl_historylistsrch" id="ftbl_historylistsrch" class="form-inline ew-form ew-ext-search-form" action="<?php echo CurrentPageName() ?>">
<?php $searchPanelClass = ($tbl_history_list->SearchWhere <> "") ? " show" : " show"; ?>
<div id="ftbl_historylistsrch-search-panel" class="ew-search-panel collapse<?php echo $searchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="tbl_history">
	<div class="ew-basic-search">
<?php
if ($SearchError == "")
	$tbl_history_list->LoadAdvancedSearch(); // Load advanced search

// Render for search
$tbl_history->RowType = ROWTYPE_SEARCH;

// Render row
$tbl_history->resetAttributes();
$tbl_history_list->renderRow();
?>
<div id="xsr_1" class="ew-row d-sm-flex">
<?php if ($tbl_history->ID_Order->Visible) { // ID_Order ?>
	<div id="xsc_ID_Order" class="ew-cell form-group">
		<label for="x_ID_Order" class="ew-search-caption ew-label"><?php //echo $tbl_history->ID_Order->caption() ?></label>
		<span class="ew-search-operator"><?php echo $Language->phrase("=") ?><input type="hidden" name="z_ID_Order" id="z_ID_Order" value="="></span>
		<span class="ew-search-field">
<input type="text" data-table="tbl_history" data-field="x_ID_Order" name="x_ID_Order" id="x_ID_Order" size="30" placeholder="<?php echo HtmlEncode($tbl_history->ID_Order->getPlaceHolder()) ?>" value="<?php echo $tbl_history->ID_Order->EditValue ?>"<?php echo $tbl_history->ID_Order->editAttributes() ?>>
</span>
	</div>
<?php } ?>
</div>
<div id="xsr_2" class="ew-row d-sm-flex">
	<div class="ew-quick-search input-group">
		<input type="text" name="<?php echo TABLE_BASIC_SEARCH ?>" id="<?php echo TABLE_BASIC_SEARCH ?>" class="form-control" value="<?php echo HtmlEncode($tbl_history_list->BasicSearch->getKeyword()) ?>" placeholder="<?php echo HtmlEncode($Language->phrase("Search")) ?>">
		<input type="hidden" name="<?php echo TABLE_BASIC_SEARCH_TYPE ?>" id="<?php echo TABLE_BASIC_SEARCH_TYPE ?>" value="<?php echo HtmlEncode($tbl_history_list->BasicSearch->getType()) ?>">
		<div class="input-group-append">
			<button class="btn btn-primary" name="btn-submit" id="btn-submit" type="submit"><?php echo $Language->phrase("SearchBtn") ?></button>
			<button type="button" data-toggle="dropdown" class="btn btn-primary dropdown-toggle dropdown-toggle-split" aria-haspopup="true" aria-expanded="false"><span id="searchtype"><?php echo $tbl_history_list->BasicSearch->getTypeNameShort() ?></span></button>
			<div class="dropdown-menu dropdown-menu-right">
				<a class="dropdown-item<?php if ($tbl_history_list->BasicSearch->getType() == "") echo " active"; ?>" href="javascript:void(0);" onclick="ew.setSearchType(this)"><?php echo $Language->phrase("QuickSearchAuto") ?></a>
				<a class="dropdown-item<?php if ($tbl_history_list->BasicSearch->getType() == "=") echo " active"; ?>" href="javascript:void(0);" onclick="ew.setSearchType(this,'=')"><?php echo $Language->phrase("QuickSearchExact") ?></a>
				<a class="dropdown-item<?php if ($tbl_history_list->BasicSearch->getType() == "AND") echo " active"; ?>" href="javascript:void(0);" onclick="ew.setSearchType(this,'AND')"><?php echo $Language->phrase("QuickSearchAll") ?></a>
				<a class="dropdown-item<?php if ($tbl_history_list->BasicSearch->getType() == "OR") echo " active"; ?>" href="javascript:void(0);" onclick="ew.setSearchType(this,'OR')"><?php echo $Language->phrase("QuickSearchAny") ?></a>
			</div>
		</div>
	</div>
</div>
	</div>
</div>
</form>
<?php } ?>
<?php } ?>
<?php $tbl_history_list->showPageHeader(); ?>
<?php
$tbl_history_list->showMessage();
?>
<?php if ($tbl_history_list->TotalRecs > 0 || $tbl_history->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($tbl_history_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> tbl_history">
<?php if (!$tbl_history->isExport()) { ?>
<div class="card-header ew-grid-upper-panel">
<?php if (!$tbl_history->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php if (!isset($tbl_history_list->Pager)) $tbl_history_list->Pager = new PrevNextPager($tbl_history_list->StartRec, $tbl_history_list->DisplayRecs, $tbl_history_list->TotalRecs, $tbl_history_list->AutoHidePager) ?>
<?php if ($tbl_history_list->Pager->RecordCount > 0 && $tbl_history_list->Pager->Visible) { ?>
<div class="ew-pager">
<span><?php echo $Language->Phrase("Page") ?>&nbsp;</span>
<div class="ew-prev-next"><div class="input-group input-group-sm">
<div class="input-group-prepend">
<!-- first page button -->
	<?php if ($tbl_history_list->Pager->FirstButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerFirst") ?>" href="<?php echo $tbl_history_list->pageUrl() ?>start=<?php echo $tbl_history_list->Pager->FirstButton->Start ?>"><i class="icon-first ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerFirst") ?>"><i class="icon-first ew-icon"></i></a>
	<?php } ?>
<!-- previous page button -->
	<?php if ($tbl_history_list->Pager->PrevButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerPrevious") ?>" href="<?php echo $tbl_history_list->pageUrl() ?>start=<?php echo $tbl_history_list->Pager->PrevButton->Start ?>"><i class="icon-prev ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerPrevious") ?>"><i class="icon-prev ew-icon"></i></a>
	<?php } ?>
</div>
<!-- current page number -->
	<input class="form-control" type="text" name="<?php echo TABLE_PAGE_NO ?>" value="<?php echo $tbl_history_list->Pager->CurrentPage ?>">
<div class="input-group-append">
<!-- next page button -->
	<?php if ($tbl_history_list->Pager->NextButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerNext") ?>" href="<?php echo $tbl_history_list->pageUrl() ?>start=<?php echo $tbl_history_list->Pager->NextButton->Start ?>"><i class="icon-next ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerNext") ?>"><i class="icon-next ew-icon"></i></a>
	<?php } ?>
<!-- last page button -->
	<?php if ($tbl_history_list->Pager->LastButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerLast") ?>" href="<?php echo $tbl_history_list->pageUrl() ?>start=<?php echo $tbl_history_list->Pager->LastButton->Start ?>"><i class="icon-last ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerLast") ?>"><i class="icon-last ew-icon"></i></a>
	<?php } ?>
</div>
</div>
</div>
<span>&nbsp;<?php echo $Language->Phrase("of") ?>&nbsp;<?php echo $tbl_history_list->Pager->PageCount ?></span>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php if ($tbl_history_list->Pager->RecordCount > 0) { ?>
<div class="ew-pager ew-rec">
	<span><?php echo $Language->Phrase("Record") ?>&nbsp;<?php echo $tbl_history_list->Pager->FromIndex ?>&nbsp;<?php echo $Language->Phrase("To") ?>&nbsp;<?php echo $tbl_history_list->Pager->ToIndex ?>&nbsp;<?php echo $Language->Phrase("Of") ?>&nbsp;<?php echo $tbl_history_list->Pager->RecordCount ?></span>
</div>
<?php } ?>
<?php if ($tbl_history_list->TotalRecs > 0 && (!$tbl_history_list->AutoHidePageSizeSelector || $tbl_history_list->Pager->Visible)) { ?>
<div class="ew-pager">
<input type="hidden" name="t" value="tbl_history">
<select name="<?php echo TABLE_REC_PER_PAGE ?>" class="form-control form-control-sm ew-tooltip" title="<?php echo $Language->phrase("RecordsPerPage") ?>" onchange="this.form.submit();">
<option value="20"<?php if ($tbl_history_list->DisplayRecs == 20) { ?> selected<?php } ?>>20</option>
<option value="50"<?php if ($tbl_history_list->DisplayRecs == 50) { ?> selected<?php } ?>>50</option>
<option value="100"<?php if ($tbl_history_list->DisplayRecs == 100) { ?> selected<?php } ?>>100</option>
<option value="200"<?php if ($tbl_history_list->DisplayRecs == 200) { ?> selected<?php } ?>>200</option>
<option value="500"<?php if ($tbl_history_list->DisplayRecs == 500) { ?> selected<?php } ?>>500</option>
<option value="ALL"<?php if ($tbl_history->getRecordsPerPage() == -1) { ?> selected<?php } ?>><?php echo $Language->Phrase("AllRecords") ?></option>
</select>
</div>
<?php } ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $tbl_history_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
<form name="ftbl_historylist" id="ftbl_historylist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($tbl_history_list->CheckToken) { ?>
<input type="hidden" name="<?php echo TOKEN_NAME ?>" value="<?php echo $tbl_history_list->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="tbl_history">
<input type="hidden" name="exporttype" id="exporttype" value="">
<div id="gmp_tbl_history" class="<?php if (IsResponsiveLayout()) { ?>table-responsive <?php } ?>card-body ew-grid-middle-panel">
<?php if ($tbl_history_list->TotalRecs > 0 || $tbl_history->isGridEdit()) { ?>
<table id="tbl_tbl_historylist" class="table ew-table"><!-- .ew-table ##-->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$tbl_history_list->RowType = ROWTYPE_HEADER;

// Render list options
$tbl_history_list->renderListOptions();

// Render list options (header, left)
$tbl_history_list->ListOptions->render("header", "left");
?>
<?php if ($tbl_history->ID_Order->Visible) { // ID_Order ?>
	<?php if ($tbl_history->sortUrl($tbl_history->ID_Order) == "") { ?>
		<th data-name="ID_Order" class="<?php echo $tbl_history->ID_Order->headerCellClass() ?>" style="white-space: nowrap;"><div id="elh_tbl_history_ID_Order" class="tbl_history_ID_Order"><div class="ew-table-header-caption"><?php echo $tbl_history->ID_Order->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="ID_Order" class="<?php echo $tbl_history->ID_Order->headerCellClass() ?>" style="white-space: nowrap;"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $tbl_history->SortUrl($tbl_history->ID_Order) ?>',2);"><div id="elh_tbl_history_ID_Order" class="tbl_history_ID_Order">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $tbl_history->ID_Order->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($tbl_history->ID_Order->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($tbl_history->ID_Order->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($tbl_history->PalletID->Visible) { // PalletID ?>
	<?php if ($tbl_history->sortUrl($tbl_history->PalletID) == "") { ?>
		<th data-name="PalletID" class="<?php echo $tbl_history->PalletID->headerCellClass() ?>" style="white-space: nowrap;"><div id="elh_tbl_history_PalletID" class="tbl_history_PalletID"><div class="ew-table-header-caption"><?php echo $tbl_history->PalletID->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="PalletID" class="<?php echo $tbl_history->PalletID->headerCellClass() ?>" style="white-space: nowrap;"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $tbl_history->SortUrl($tbl_history->PalletID) ?>',2);"><div id="elh_tbl_history_PalletID" class="tbl_history_PalletID">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $tbl_history->PalletID->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($tbl_history->PalletID->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($tbl_history->PalletID->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($tbl_history->Code->Visible) { // Code ?>
	<?php if ($tbl_history->sortUrl($tbl_history->Code) == "") { ?>
		<th data-name="Code" class="<?php echo $tbl_history->Code->headerCellClass() ?>" style="white-space: nowrap;"><div id="elh_tbl_history_Code" class="tbl_history_Code"><div class="ew-table-header-caption"><?php echo $tbl_history->Code->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Code" class="<?php echo $tbl_history->Code->headerCellClass() ?>" style="white-space: nowrap;"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $tbl_history->SortUrl($tbl_history->Code) ?>',2);"><div id="elh_tbl_history_Code" class="tbl_history_Code">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $tbl_history->Code->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($tbl_history->Code->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($tbl_history->Code->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($tbl_history->ID_Location->Visible) { // ID_Location ?>
	<?php if ($tbl_history->sortUrl($tbl_history->ID_Location) == "") { ?>
		<th data-name="ID_Location" class="<?php echo $tbl_history->ID_Location->headerCellClass() ?>" style="white-space: nowrap;"><div id="elh_tbl_history_ID_Location" class="tbl_history_ID_Location"><div class="ew-table-header-caption"><?php echo $tbl_history->ID_Location->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="ID_Location" class="<?php echo $tbl_history->ID_Location->headerCellClass() ?>" style="white-space: nowrap;"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $tbl_history->SortUrl($tbl_history->ID_Location) ?>',2);"><div id="elh_tbl_history_ID_Location" class="tbl_history_ID_Location">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $tbl_history->ID_Location->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($tbl_history->ID_Location->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($tbl_history->ID_Location->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($tbl_history->PCS->Visible) { // PCS ?>
	<?php if ($tbl_history->sortUrl($tbl_history->PCS) == "") { ?>
		<th data-name="PCS" class="<?php echo $tbl_history->PCS->headerCellClass() ?>" style="white-space: nowrap;"><div id="elh_tbl_history_PCS" class="tbl_history_PCS"><div class="ew-table-header-caption"><?php echo $tbl_history->PCS->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="PCS" class="<?php echo $tbl_history->PCS->headerCellClass() ?>" style="white-space: nowrap;"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $tbl_history->SortUrl($tbl_history->PCS) ?>',2);"><div id="elh_tbl_history_PCS" class="tbl_history_PCS">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $tbl_history->PCS->caption() ?></span><span class="ew-table-header-sort"><?php if ($tbl_history->PCS->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($tbl_history->PCS->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($tbl_history->PalletStatus->Visible) { // PalletStatus ?>
	<?php if ($tbl_history->sortUrl($tbl_history->PalletStatus) == "") { ?>
		<th data-name="PalletStatus" class="<?php echo $tbl_history->PalletStatus->headerCellClass() ?>" style="white-space: nowrap;"><div id="elh_tbl_history_PalletStatus" class="tbl_history_PalletStatus"><div class="ew-table-header-caption"><?php echo $tbl_history->PalletStatus->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="PalletStatus" class="<?php echo $tbl_history->PalletStatus->headerCellClass() ?>" style="white-space: nowrap;"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $tbl_history->SortUrl($tbl_history->PalletStatus) ?>',2);"><div id="elh_tbl_history_PalletStatus" class="tbl_history_PalletStatus">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $tbl_history->PalletStatus->caption() ?></span><span class="ew-table-header-sort"><?php if ($tbl_history->PalletStatus->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($tbl_history->PalletStatus->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($tbl_history->CreateUser->Visible) { // CreateUser ?>
	<?php if ($tbl_history->sortUrl($tbl_history->CreateUser) == "") { ?>
		<th data-name="CreateUser" class="<?php echo $tbl_history->CreateUser->headerCellClass() ?>" style="white-space: nowrap;"><div id="elh_tbl_history_CreateUser" class="tbl_history_CreateUser"><div class="ew-table-header-caption"><?php echo $tbl_history->CreateUser->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="CreateUser" class="<?php echo $tbl_history->CreateUser->headerCellClass() ?>" style="white-space: nowrap;"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $tbl_history->SortUrl($tbl_history->CreateUser) ?>',2);"><div id="elh_tbl_history_CreateUser" class="tbl_history_CreateUser">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $tbl_history->CreateUser->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($tbl_history->CreateUser->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($tbl_history->CreateUser->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($tbl_history->CreateDate->Visible) { // CreateDate ?>
	<?php if ($tbl_history->sortUrl($tbl_history->CreateDate) == "") { ?>
		<th data-name="CreateDate" class="<?php echo $tbl_history->CreateDate->headerCellClass() ?>" style="white-space: nowrap;"><div id="elh_tbl_history_CreateDate" class="tbl_history_CreateDate"><div class="ew-table-header-caption"><?php echo $tbl_history->CreateDate->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="CreateDate" class="<?php echo $tbl_history->CreateDate->headerCellClass() ?>" style="white-space: nowrap;"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $tbl_history->SortUrl($tbl_history->CreateDate) ?>',2);"><div id="elh_tbl_history_CreateDate" class="tbl_history_CreateDate">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $tbl_history->CreateDate->caption() ?></span><span class="ew-table-header-sort"><?php if ($tbl_history->CreateDate->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($tbl_history->CreateDate->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($tbl_history->UpdateUser->Visible) { // UpdateUser ?>
	<?php if ($tbl_history->sortUrl($tbl_history->UpdateUser) == "") { ?>
		<th data-name="UpdateUser" class="<?php echo $tbl_history->UpdateUser->headerCellClass() ?>" style="white-space: nowrap;"><div id="elh_tbl_history_UpdateUser" class="tbl_history_UpdateUser"><div class="ew-table-header-caption"><?php echo $tbl_history->UpdateUser->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="UpdateUser" class="<?php echo $tbl_history->UpdateUser->headerCellClass() ?>" style="white-space: nowrap;"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $tbl_history->SortUrl($tbl_history->UpdateUser) ?>',2);"><div id="elh_tbl_history_UpdateUser" class="tbl_history_UpdateUser">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $tbl_history->UpdateUser->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($tbl_history->UpdateUser->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($tbl_history->UpdateUser->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($tbl_history->UpdateDate->Visible) { // UpdateDate ?>
	<?php if ($tbl_history->sortUrl($tbl_history->UpdateDate) == "") { ?>
		<th data-name="UpdateDate" class="<?php echo $tbl_history->UpdateDate->headerCellClass() ?>" style="white-space: nowrap;"><div id="elh_tbl_history_UpdateDate" class="tbl_history_UpdateDate"><div class="ew-table-header-caption"><?php echo $tbl_history->UpdateDate->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="UpdateDate" class="<?php echo $tbl_history->UpdateDate->headerCellClass() ?>" style="white-space: nowrap;"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $tbl_history->SortUrl($tbl_history->UpdateDate) ?>',2);"><div id="elh_tbl_history_UpdateDate" class="tbl_history_UpdateDate">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $tbl_history->UpdateDate->caption() ?></span><span class="ew-table-header-sort"><?php if ($tbl_history->UpdateDate->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($tbl_history->UpdateDate->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$tbl_history_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
if ($tbl_history->ExportAll && $tbl_history->isExport()) {
	$tbl_history_list->StopRec = $tbl_history_list->TotalRecs;
} else {

	// Set the last record to display
	if ($tbl_history_list->TotalRecs > $tbl_history_list->StartRec + $tbl_history_list->DisplayRecs - 1)
		$tbl_history_list->StopRec = $tbl_history_list->StartRec + $tbl_history_list->DisplayRecs - 1;
	else
		$tbl_history_list->StopRec = $tbl_history_list->TotalRecs;
}
$tbl_history_list->RecCnt = $tbl_history_list->StartRec - 1;
if ($tbl_history_list->Recordset && !$tbl_history_list->Recordset->EOF) {
	$tbl_history_list->Recordset->moveFirst();
	$selectLimit = $tbl_history_list->UseSelectLimit;
	if (!$selectLimit && $tbl_history_list->StartRec > 1)
		$tbl_history_list->Recordset->move($tbl_history_list->StartRec - 1);
} elseif (!$tbl_history->AllowAddDeleteRow && $tbl_history_list->StopRec == 0) {
	$tbl_history_list->StopRec = $tbl_history->GridAddRowCount;
}

// Initialize aggregate
$tbl_history->RowType = ROWTYPE_AGGREGATEINIT;
$tbl_history->resetAttributes();
$tbl_history_list->renderRow();
while ($tbl_history_list->RecCnt < $tbl_history_list->StopRec) {
	$tbl_history_list->RecCnt++;
	if ($tbl_history_list->RecCnt >= $tbl_history_list->StartRec) {
		$tbl_history_list->RowCnt++;

		// Set up key count
		$tbl_history_list->KeyCount = $tbl_history_list->RowIndex;

		// Init row class and style
		$tbl_history->resetAttributes();
		$tbl_history->CssClass = "";
		if ($tbl_history->isGridAdd()) {
		} else {
			$tbl_history_list->loadRowValues($tbl_history_list->Recordset); // Load row values
		}
		$tbl_history->RowType = ROWTYPE_VIEW; // Render view

		// Set up row id / data-rowindex
		$tbl_history->RowAttrs = array_merge($tbl_history->RowAttrs, array('data-rowindex'=>$tbl_history_list->RowCnt, 'id'=>'r' . $tbl_history_list->RowCnt . '_tbl_history', 'data-rowtype'=>$tbl_history->RowType));

		// Render row
		$tbl_history_list->renderRow();

		// Render list options
		$tbl_history_list->renderListOptions();
?>
	<tr<?php echo $tbl_history->rowAttributes() ?>>
<?php

// Render list options (body, left)
$tbl_history_list->ListOptions->render("body", "left", $tbl_history_list->RowCnt);
?>
	<?php if ($tbl_history->ID_Order->Visible) { // ID_Order ?>
		<td data-name="ID_Order"<?php echo $tbl_history->ID_Order->cellAttributes() ?>>
<span id="el<?php echo $tbl_history_list->RowCnt ?>_tbl_history_ID_Order" class="tbl_history_ID_Order">
<span<?php echo $tbl_history->ID_Order->viewAttributes() ?>>
<?php echo $tbl_history->ID_Order->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($tbl_history->PalletID->Visible) { // PalletID ?>
		<td data-name="PalletID"<?php echo $tbl_history->PalletID->cellAttributes() ?>>
<span id="el<?php echo $tbl_history_list->RowCnt ?>_tbl_history_PalletID" class="tbl_history_PalletID">
<span<?php echo $tbl_history->PalletID->viewAttributes() ?>>
<?php echo $tbl_history->PalletID->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($tbl_history->Code->Visible) { // Code ?>
		<td data-name="Code"<?php echo $tbl_history->Code->cellAttributes() ?>>
<span id="el<?php echo $tbl_history_list->RowCnt ?>_tbl_history_Code" class="tbl_history_Code">
<span<?php echo $tbl_history->Code->viewAttributes() ?>>
<?php echo $tbl_history->Code->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($tbl_history->ID_Location->Visible) { // ID_Location ?>
		<td data-name="ID_Location"<?php echo $tbl_history->ID_Location->cellAttributes() ?>>
<span id="el<?php echo $tbl_history_list->RowCnt ?>_tbl_history_ID_Location" class="tbl_history_ID_Location">
<span<?php echo $tbl_history->ID_Location->viewAttributes() ?>>
<?php echo $tbl_history->ID_Location->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($tbl_history->PCS->Visible) { // PCS ?>
		<td data-name="PCS"<?php echo $tbl_history->PCS->cellAttributes() ?>>
<span id="el<?php echo $tbl_history_list->RowCnt ?>_tbl_history_PCS" class="tbl_history_PCS">
<span<?php echo $tbl_history->PCS->viewAttributes() ?>>
<?php echo $tbl_history->PCS->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($tbl_history->PalletStatus->Visible) { // PalletStatus ?>
		<td data-name="PalletStatus"<?php echo $tbl_history->PalletStatus->cellAttributes() ?>>
<span id="el<?php echo $tbl_history_list->RowCnt ?>_tbl_history_PalletStatus" class="tbl_history_PalletStatus">
<span<?php echo $tbl_history->PalletStatus->viewAttributes() ?>>
<?php echo $tbl_history->PalletStatus->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($tbl_history->CreateUser->Visible) { // CreateUser ?>
		<td data-name="CreateUser"<?php echo $tbl_history->CreateUser->cellAttributes() ?>>
<span id="el<?php echo $tbl_history_list->RowCnt ?>_tbl_history_CreateUser" class="tbl_history_CreateUser">
<span<?php echo $tbl_history->CreateUser->viewAttributes() ?>>
<?php echo $tbl_history->CreateUser->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($tbl_history->CreateDate->Visible) { // CreateDate ?>
		<td data-name="CreateDate"<?php echo $tbl_history->CreateDate->cellAttributes() ?>>
<span id="el<?php echo $tbl_history_list->RowCnt ?>_tbl_history_CreateDate" class="tbl_history_CreateDate">
<span<?php echo $tbl_history->CreateDate->viewAttributes() ?>>
<?php echo $tbl_history->CreateDate->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($tbl_history->UpdateUser->Visible) { // UpdateUser ?>
		<td data-name="UpdateUser"<?php echo $tbl_history->UpdateUser->cellAttributes() ?>>
<span id="el<?php echo $tbl_history_list->RowCnt ?>_tbl_history_UpdateUser" class="tbl_history_UpdateUser">
<span<?php echo $tbl_history->UpdateUser->viewAttributes() ?>>
<?php echo $tbl_history->UpdateUser->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($tbl_history->UpdateDate->Visible) { // UpdateDate ?>
		<td data-name="UpdateDate"<?php echo $tbl_history->UpdateDate->cellAttributes() ?>>
<span id="el<?php echo $tbl_history_list->RowCnt ?>_tbl_history_UpdateDate" class="tbl_history_UpdateDate">
<span<?php echo $tbl_history->UpdateDate->viewAttributes() ?>>
<?php echo $tbl_history->UpdateDate->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$tbl_history_list->ListOptions->render("body", "right", $tbl_history_list->RowCnt);
?>
	</tr>
<?php
	}
	if (!$tbl_history->isGridAdd())
		$tbl_history_list->Recordset->moveNext();
}
?>
</tbody>
</table><!-- /.ew-table -->
<?php } ?>
<?php if (!$tbl_history->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</div><!-- /.ew-grid-middle-panel -->
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($tbl_history_list->Recordset)
	$tbl_history_list->Recordset->Close();
?>
<?php if (!$tbl_history->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$tbl_history->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php if (!isset($tbl_history_list->Pager)) $tbl_history_list->Pager = new PrevNextPager($tbl_history_list->StartRec, $tbl_history_list->DisplayRecs, $tbl_history_list->TotalRecs, $tbl_history_list->AutoHidePager) ?>
<?php if ($tbl_history_list->Pager->RecordCount > 0 && $tbl_history_list->Pager->Visible) { ?>
<div class="ew-pager">
<span><?php echo $Language->Phrase("Page") ?>&nbsp;</span>
<div class="ew-prev-next"><div class="input-group input-group-sm">
<div class="input-group-prepend">
<!-- first page button -->
	<?php if ($tbl_history_list->Pager->FirstButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerFirst") ?>" href="<?php echo $tbl_history_list->pageUrl() ?>start=<?php echo $tbl_history_list->Pager->FirstButton->Start ?>"><i class="icon-first ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerFirst") ?>"><i class="icon-first ew-icon"></i></a>
	<?php } ?>
<!-- previous page button -->
	<?php if ($tbl_history_list->Pager->PrevButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerPrevious") ?>" href="<?php echo $tbl_history_list->pageUrl() ?>start=<?php echo $tbl_history_list->Pager->PrevButton->Start ?>"><i class="icon-prev ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerPrevious") ?>"><i class="icon-prev ew-icon"></i></a>
	<?php } ?>
</div>
<!-- current page number -->
	<input class="form-control" type="text" name="<?php echo TABLE_PAGE_NO ?>" value="<?php echo $tbl_history_list->Pager->CurrentPage ?>">
<div class="input-group-append">
<!-- next page button -->
	<?php if ($tbl_history_list->Pager->NextButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerNext") ?>" href="<?php echo $tbl_history_list->pageUrl() ?>start=<?php echo $tbl_history_list->Pager->NextButton->Start ?>"><i class="icon-next ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerNext") ?>"><i class="icon-next ew-icon"></i></a>
	<?php } ?>
<!-- last page button -->
	<?php if ($tbl_history_list->Pager->LastButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerLast") ?>" href="<?php echo $tbl_history_list->pageUrl() ?>start=<?php echo $tbl_history_list->Pager->LastButton->Start ?>"><i class="icon-last ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerLast") ?>"><i class="icon-last ew-icon"></i></a>
	<?php } ?>
</div>
</div>
</div>
<span>&nbsp;<?php echo $Language->Phrase("of") ?>&nbsp;<?php echo $tbl_history_list->Pager->PageCount ?></span>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php if ($tbl_history_list->Pager->RecordCount > 0) { ?>
<div class="ew-pager ew-rec">
	<span><?php echo $Language->Phrase("Record") ?>&nbsp;<?php echo $tbl_history_list->Pager->FromIndex ?>&nbsp;<?php echo $Language->Phrase("To") ?>&nbsp;<?php echo $tbl_history_list->Pager->ToIndex ?>&nbsp;<?php echo $Language->Phrase("Of") ?>&nbsp;<?php echo $tbl_history_list->Pager->RecordCount ?></span>
</div>
<?php } ?>
<?php if ($tbl_history_list->TotalRecs > 0 && (!$tbl_history_list->AutoHidePageSizeSelector || $tbl_history_list->Pager->Visible)) { ?>
<div class="ew-pager">
<input type="hidden" name="t" value="tbl_history">
<select name="<?php echo TABLE_REC_PER_PAGE ?>" class="form-control form-control-sm ew-tooltip" title="<?php echo $Language->phrase("RecordsPerPage") ?>" onchange="this.form.submit();">
<option value="20"<?php if ($tbl_history_list->DisplayRecs == 20) { ?> selected<?php } ?>>20</option>
<option value="50"<?php if ($tbl_history_list->DisplayRecs == 50) { ?> selected<?php } ?>>50</option>
<option value="100"<?php if ($tbl_history_list->DisplayRecs == 100) { ?> selected<?php } ?>>100</option>
<option value="200"<?php if ($tbl_history_list->DisplayRecs == 200) { ?> selected<?php } ?>>200</option>
<option value="500"<?php if ($tbl_history_list->DisplayRecs == 500) { ?> selected<?php } ?>>500</option>
<option value="ALL"<?php if ($tbl_history->getRecordsPerPage() == -1) { ?> selected<?php } ?>><?php echo $Language->Phrase("AllRecords") ?></option>
</select>
</div>
<?php } ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $tbl_history_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($tbl_history_list->TotalRecs == 0 && !$tbl_history->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $tbl_history_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$tbl_history_list->showPageFooter();
if (DEBUG_ENABLED)
	echo GetDebugMessage();
?>
<?php if (!$tbl_history->isExport()) { ?>
<script>

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php } ?>
<?php include_once "footer.php" ?>
<?php
$tbl_history_list->terminate();
?>