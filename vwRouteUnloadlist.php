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
$vwRouteUnload_list = new vwRouteUnload_list();

// Run the page
$vwRouteUnload_list->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$vwRouteUnload_list->Page_Render();
?>
<?php include_once "header.php" ?>
<?php if (!$vwRouteUnload->isExport()) { ?>
<script>

// Form object
currentPageID = ew.PAGE_ID = "list";
var fvwRouteUnloadlist = currentForm = new ew.Form("fvwRouteUnloadlist", "list");
fvwRouteUnloadlist.formKeyCountName = '<?php echo $vwRouteUnload_list->FormKeyCountName ?>';

// Form_CustomValidate event
fvwRouteUnloadlist.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

	// Your custom validation code here, return false if invalid.
	return true;
}

// Use JavaScript validation or not
fvwRouteUnloadlist.validateRequired = <?php echo json_encode(CLIENT_VALIDATE) ?>;

// Dynamic selection lists
fvwRouteUnloadlist.lists["x_Code"] = <?php echo $vwRouteUnload_list->Code->Lookup->toClientList() ?>;
fvwRouteUnloadlist.lists["x_Code"].options = <?php echo JsonEncode($vwRouteUnload_list->Code->lookupOptions()) ?>;
fvwRouteUnloadlist.autoSuggests["x_Code"] = <?php echo json_encode(["data" => "ajax=autosuggest"]) ?>;

// Form object for search
var fvwRouteUnloadlistsrch = currentSearchForm = new ew.Form("fvwRouteUnloadlistsrch");

// Filters
fvwRouteUnloadlistsrch.filterList = <?php echo $vwRouteUnload_list->getFilterList() ?>;
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
<?php if (!$vwRouteUnload->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($vwRouteUnload_list->TotalRecs > 0 && $vwRouteUnload_list->ExportOptions->visible()) { ?>
<?php $vwRouteUnload_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($vwRouteUnload_list->ImportOptions->visible()) { ?>
<?php $vwRouteUnload_list->ImportOptions->render("body") ?>
<?php } ?>
<?php if ($vwRouteUnload_list->SearchOptions->visible()) { ?>
<?php $vwRouteUnload_list->SearchOptions->render("body") ?>
<?php } ?>
<?php if ($vwRouteUnload_list->FilterOptions->visible()) { ?>
<?php $vwRouteUnload_list->FilterOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php if (!$vwRouteUnload->isExport() || EXPORT_MASTER_RECORD && $vwRouteUnload->isExport("print")) { ?>
<?php
if ($vwRouteUnload_list->DbMasterFilter <> "" && $vwRouteUnload->getCurrentMasterTable() == "tbl_route") {
	if ($vwRouteUnload_list->MasterRecordExists) {
		include_once "tbl_routemaster.php";
	}
}
?>
<?php } ?>
<?php
$vwRouteUnload_list->renderOtherOptions();
?>
<?php if ($Security->CanSearch()) { ?>
<?php if (!$vwRouteUnload->isExport() && !$vwRouteUnload->CurrentAction) { ?>
<form name="fvwRouteUnloadlistsrch" id="fvwRouteUnloadlistsrch" class="form-inline ew-form ew-ext-search-form" action="<?php echo CurrentPageName() ?>">
<?php $searchPanelClass = ($vwRouteUnload_list->SearchWhere <> "") ? " show" : " show"; ?>
<div id="fvwRouteUnloadlistsrch-search-panel" class="ew-search-panel collapse<?php echo $searchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="vwRouteUnload">
	<div class="ew-basic-search">
<div id="xsr_1" class="ew-row d-sm-flex">
	<div class="ew-quick-search input-group">
		<input type="text" name="<?php echo TABLE_BASIC_SEARCH ?>" id="<?php echo TABLE_BASIC_SEARCH ?>" class="form-control" value="<?php echo HtmlEncode($vwRouteUnload_list->BasicSearch->getKeyword()) ?>" placeholder="<?php echo HtmlEncode($Language->phrase("Search")) ?>">
		<input type="hidden" name="<?php echo TABLE_BASIC_SEARCH_TYPE ?>" id="<?php echo TABLE_BASIC_SEARCH_TYPE ?>" value="<?php echo HtmlEncode($vwRouteUnload_list->BasicSearch->getType()) ?>">
		<div class="input-group-append">
			<button class="btn btn-primary" name="btn-submit" id="btn-submit" type="submit"><?php echo $Language->phrase("SearchBtn") ?></button>
			<button type="button" data-toggle="dropdown" class="btn btn-primary dropdown-toggle dropdown-toggle-split" aria-haspopup="true" aria-expanded="false"><span id="searchtype"><?php echo $vwRouteUnload_list->BasicSearch->getTypeNameShort() ?></span></button>
			<div class="dropdown-menu dropdown-menu-right">
				<a class="dropdown-item<?php if ($vwRouteUnload_list->BasicSearch->getType() == "") echo " active"; ?>" href="javascript:void(0);" onclick="ew.setSearchType(this)"><?php echo $Language->phrase("QuickSearchAuto") ?></a>
				<a class="dropdown-item<?php if ($vwRouteUnload_list->BasicSearch->getType() == "=") echo " active"; ?>" href="javascript:void(0);" onclick="ew.setSearchType(this,'=')"><?php echo $Language->phrase("QuickSearchExact") ?></a>
				<a class="dropdown-item<?php if ($vwRouteUnload_list->BasicSearch->getType() == "AND") echo " active"; ?>" href="javascript:void(0);" onclick="ew.setSearchType(this,'AND')"><?php echo $Language->phrase("QuickSearchAll") ?></a>
				<a class="dropdown-item<?php if ($vwRouteUnload_list->BasicSearch->getType() == "OR") echo " active"; ?>" href="javascript:void(0);" onclick="ew.setSearchType(this,'OR')"><?php echo $Language->phrase("QuickSearchAny") ?></a>
			</div>
		</div>
	</div>
</div>
	</div>
</div>
</form>
<?php } ?>
<?php } ?>
<?php $vwRouteUnload_list->showPageHeader(); ?>
<?php
$vwRouteUnload_list->showMessage();
?>
<?php if ($vwRouteUnload_list->TotalRecs > 0 || $vwRouteUnload->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($vwRouteUnload_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> vwRouteUnload">
<?php if (!$vwRouteUnload->isExport()) { ?>
<div class="card-header ew-grid-upper-panel">
<?php if (!$vwRouteUnload->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php if (!isset($vwRouteUnload_list->Pager)) $vwRouteUnload_list->Pager = new PrevNextPager($vwRouteUnload_list->StartRec, $vwRouteUnload_list->DisplayRecs, $vwRouteUnload_list->TotalRecs, $vwRouteUnload_list->AutoHidePager) ?>
<?php if ($vwRouteUnload_list->Pager->RecordCount > 0 && $vwRouteUnload_list->Pager->Visible) { ?>
<div class="ew-pager">
<span><?php echo $Language->Phrase("Page") ?>&nbsp;</span>
<div class="ew-prev-next"><div class="input-group input-group-sm">
<div class="input-group-prepend">
<!-- first page button -->
	<?php if ($vwRouteUnload_list->Pager->FirstButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerFirst") ?>" href="<?php echo $vwRouteUnload_list->pageUrl() ?>start=<?php echo $vwRouteUnload_list->Pager->FirstButton->Start ?>"><i class="icon-first ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerFirst") ?>"><i class="icon-first ew-icon"></i></a>
	<?php } ?>
<!-- previous page button -->
	<?php if ($vwRouteUnload_list->Pager->PrevButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerPrevious") ?>" href="<?php echo $vwRouteUnload_list->pageUrl() ?>start=<?php echo $vwRouteUnload_list->Pager->PrevButton->Start ?>"><i class="icon-prev ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerPrevious") ?>"><i class="icon-prev ew-icon"></i></a>
	<?php } ?>
</div>
<!-- current page number -->
	<input class="form-control" type="text" name="<?php echo TABLE_PAGE_NO ?>" value="<?php echo $vwRouteUnload_list->Pager->CurrentPage ?>">
<div class="input-group-append">
<!-- next page button -->
	<?php if ($vwRouteUnload_list->Pager->NextButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerNext") ?>" href="<?php echo $vwRouteUnload_list->pageUrl() ?>start=<?php echo $vwRouteUnload_list->Pager->NextButton->Start ?>"><i class="icon-next ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerNext") ?>"><i class="icon-next ew-icon"></i></a>
	<?php } ?>
<!-- last page button -->
	<?php if ($vwRouteUnload_list->Pager->LastButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerLast") ?>" href="<?php echo $vwRouteUnload_list->pageUrl() ?>start=<?php echo $vwRouteUnload_list->Pager->LastButton->Start ?>"><i class="icon-last ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerLast") ?>"><i class="icon-last ew-icon"></i></a>
	<?php } ?>
</div>
</div>
</div>
<span>&nbsp;<?php echo $Language->Phrase("of") ?>&nbsp;<?php echo $vwRouteUnload_list->Pager->PageCount ?></span>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php if ($vwRouteUnload_list->Pager->RecordCount > 0) { ?>
<div class="ew-pager ew-rec">
	<span><?php echo $Language->Phrase("Record") ?>&nbsp;<?php echo $vwRouteUnload_list->Pager->FromIndex ?>&nbsp;<?php echo $Language->Phrase("To") ?>&nbsp;<?php echo $vwRouteUnload_list->Pager->ToIndex ?>&nbsp;<?php echo $Language->Phrase("Of") ?>&nbsp;<?php echo $vwRouteUnload_list->Pager->RecordCount ?></span>
</div>
<?php } ?>
<?php if ($vwRouteUnload_list->TotalRecs > 0 && (!$vwRouteUnload_list->AutoHidePageSizeSelector || $vwRouteUnload_list->Pager->Visible)) { ?>
<div class="ew-pager">
<input type="hidden" name="t" value="vwRouteUnload">
<select name="<?php echo TABLE_REC_PER_PAGE ?>" class="form-control form-control-sm ew-tooltip" title="<?php echo $Language->phrase("RecordsPerPage") ?>" onchange="this.form.submit();">
<option value="20"<?php if ($vwRouteUnload_list->DisplayRecs == 20) { ?> selected<?php } ?>>20</option>
<option value="50"<?php if ($vwRouteUnload_list->DisplayRecs == 50) { ?> selected<?php } ?>>50</option>
<option value="100"<?php if ($vwRouteUnload_list->DisplayRecs == 100) { ?> selected<?php } ?>>100</option>
<option value="200"<?php if ($vwRouteUnload_list->DisplayRecs == 200) { ?> selected<?php } ?>>200</option>
<option value="500"<?php if ($vwRouteUnload_list->DisplayRecs == 500) { ?> selected<?php } ?>>500</option>
<option value="ALL"<?php if ($vwRouteUnload->getRecordsPerPage() == -1) { ?> selected<?php } ?>><?php echo $Language->Phrase("AllRecords") ?></option>
</select>
</div>
<?php } ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $vwRouteUnload_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
<form name="fvwRouteUnloadlist" id="fvwRouteUnloadlist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($vwRouteUnload_list->CheckToken) { ?>
<input type="hidden" name="<?php echo TOKEN_NAME ?>" value="<?php echo $vwRouteUnload_list->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="vwRouteUnload">
<input type="hidden" name="exporttype" id="exporttype" value="">
<?php if ($vwRouteUnload->getCurrentMasterTable() == "tbl_route" && $vwRouteUnload->CurrentAction) { ?>
<input type="hidden" name="<?php echo TABLE_SHOW_MASTER ?>" value="tbl_route">
<input type="hidden" name="fk_ID_Route" value="<?php echo $vwRouteUnload->ID_Route->getSessionValue() ?>">
<?php } ?>
<div id="gmp_vwRouteUnload" class="<?php if (IsResponsiveLayout()) { ?>table-responsive <?php } ?>card-body ew-grid-middle-panel">
<?php if ($vwRouteUnload_list->TotalRecs > 0 || $vwRouteUnload->isGridEdit()) { ?>
<table id="tbl_vwRouteUnloadlist" class="table ew-table"><!-- .ew-table ##-->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$vwRouteUnload_list->RowType = ROWTYPE_HEADER;

// Render list options
$vwRouteUnload_list->renderListOptions();

// Render list options (header, left)
$vwRouteUnload_list->ListOptions->render("header", "left");
?>
<?php if ($vwRouteUnload->PalletID->Visible) { // PalletID ?>
	<?php if ($vwRouteUnload->sortUrl($vwRouteUnload->PalletID) == "") { ?>
		<th data-name="PalletID" class="<?php echo $vwRouteUnload->PalletID->headerCellClass() ?>"><div id="elh_vwRouteUnload_PalletID" class="vwRouteUnload_PalletID"><div class="ew-table-header-caption"><?php echo $vwRouteUnload->PalletID->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="PalletID" class="<?php echo $vwRouteUnload->PalletID->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $vwRouteUnload->SortUrl($vwRouteUnload->PalletID) ?>',2);"><div id="elh_vwRouteUnload_PalletID" class="vwRouteUnload_PalletID">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $vwRouteUnload->PalletID->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($vwRouteUnload->PalletID->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($vwRouteUnload->PalletID->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($vwRouteUnload->Code->Visible) { // Code ?>
	<?php if ($vwRouteUnload->sortUrl($vwRouteUnload->Code) == "") { ?>
		<th data-name="Code" class="<?php echo $vwRouteUnload->Code->headerCellClass() ?>"><div id="elh_vwRouteUnload_Code" class="vwRouteUnload_Code"><div class="ew-table-header-caption"><?php echo $vwRouteUnload->Code->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Code" class="<?php echo $vwRouteUnload->Code->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $vwRouteUnload->SortUrl($vwRouteUnload->Code) ?>',2);"><div id="elh_vwRouteUnload_Code" class="vwRouteUnload_Code">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $vwRouteUnload->Code->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($vwRouteUnload->Code->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($vwRouteUnload->Code->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($vwRouteUnload->PCS->Visible) { // PCS ?>
	<?php if ($vwRouteUnload->sortUrl($vwRouteUnload->PCS) == "") { ?>
		<th data-name="PCS" class="<?php echo $vwRouteUnload->PCS->headerCellClass() ?>"><div id="elh_vwRouteUnload_PCS" class="vwRouteUnload_PCS"><div class="ew-table-header-caption"><?php echo $vwRouteUnload->PCS->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="PCS" class="<?php echo $vwRouteUnload->PCS->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $vwRouteUnload->SortUrl($vwRouteUnload->PCS) ?>',2);"><div id="elh_vwRouteUnload_PCS" class="vwRouteUnload_PCS">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $vwRouteUnload->PCS->caption() ?></span><span class="ew-table-header-sort"><?php if ($vwRouteUnload->PCS->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($vwRouteUnload->PCS->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($vwRouteUnload->PcsReal->Visible) { // PcsReal ?>
	<?php if ($vwRouteUnload->sortUrl($vwRouteUnload->PcsReal) == "") { ?>
		<th data-name="PcsReal" class="<?php echo $vwRouteUnload->PcsReal->headerCellClass() ?>"><div id="elh_vwRouteUnload_PcsReal" class="vwRouteUnload_PcsReal"><div class="ew-table-header-caption"><?php echo $vwRouteUnload->PcsReal->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="PcsReal" class="<?php echo $vwRouteUnload->PcsReal->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $vwRouteUnload->SortUrl($vwRouteUnload->PcsReal) ?>',2);"><div id="elh_vwRouteUnload_PcsReal" class="vwRouteUnload_PcsReal">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $vwRouteUnload->PcsReal->caption() ?></span><span class="ew-table-header-sort"><?php if ($vwRouteUnload->PcsReal->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($vwRouteUnload->PcsReal->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($vwRouteUnload->CreateUser->Visible) { // CreateUser ?>
	<?php if ($vwRouteUnload->sortUrl($vwRouteUnload->CreateUser) == "") { ?>
		<th data-name="CreateUser" class="<?php echo $vwRouteUnload->CreateUser->headerCellClass() ?>"><div id="elh_vwRouteUnload_CreateUser" class="vwRouteUnload_CreateUser"><div class="ew-table-header-caption"><?php echo $vwRouteUnload->CreateUser->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="CreateUser" class="<?php echo $vwRouteUnload->CreateUser->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $vwRouteUnload->SortUrl($vwRouteUnload->CreateUser) ?>',2);"><div id="elh_vwRouteUnload_CreateUser" class="vwRouteUnload_CreateUser">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $vwRouteUnload->CreateUser->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($vwRouteUnload->CreateUser->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($vwRouteUnload->CreateUser->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($vwRouteUnload->CreateDate->Visible) { // CreateDate ?>
	<?php if ($vwRouteUnload->sortUrl($vwRouteUnload->CreateDate) == "") { ?>
		<th data-name="CreateDate" class="<?php echo $vwRouteUnload->CreateDate->headerCellClass() ?>"><div id="elh_vwRouteUnload_CreateDate" class="vwRouteUnload_CreateDate"><div class="ew-table-header-caption"><?php echo $vwRouteUnload->CreateDate->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="CreateDate" class="<?php echo $vwRouteUnload->CreateDate->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $vwRouteUnload->SortUrl($vwRouteUnload->CreateDate) ?>',2);"><div id="elh_vwRouteUnload_CreateDate" class="vwRouteUnload_CreateDate">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $vwRouteUnload->CreateDate->caption() ?></span><span class="ew-table-header-sort"><?php if ($vwRouteUnload->CreateDate->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($vwRouteUnload->CreateDate->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($vwRouteUnload->MFG->Visible) { // MFG ?>
	<?php if ($vwRouteUnload->sortUrl($vwRouteUnload->MFG) == "") { ?>
		<th data-name="MFG" class="<?php echo $vwRouteUnload->MFG->headerCellClass() ?>"><div id="elh_vwRouteUnload_MFG" class="vwRouteUnload_MFG"><div class="ew-table-header-caption"><?php echo $vwRouteUnload->MFG->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="MFG" class="<?php echo $vwRouteUnload->MFG->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $vwRouteUnload->SortUrl($vwRouteUnload->MFG) ?>',2);"><div id="elh_vwRouteUnload_MFG" class="vwRouteUnload_MFG">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $vwRouteUnload->MFG->caption() ?></span><span class="ew-table-header-sort"><?php if ($vwRouteUnload->MFG->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($vwRouteUnload->MFG->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($vwRouteUnload->Description->Visible) { // Description ?>
	<?php if ($vwRouteUnload->sortUrl($vwRouteUnload->Description) == "") { ?>
		<th data-name="Description" class="<?php echo $vwRouteUnload->Description->headerCellClass() ?>"><div id="elh_vwRouteUnload_Description" class="vwRouteUnload_Description"><div class="ew-table-header-caption"><?php echo $vwRouteUnload->Description->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Description" class="<?php echo $vwRouteUnload->Description->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $vwRouteUnload->SortUrl($vwRouteUnload->Description) ?>',2);"><div id="elh_vwRouteUnload_Description" class="vwRouteUnload_Description">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $vwRouteUnload->Description->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($vwRouteUnload->Description->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($vwRouteUnload->Description->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$vwRouteUnload_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
if ($vwRouteUnload->ExportAll && $vwRouteUnload->isExport()) {
	$vwRouteUnload_list->StopRec = $vwRouteUnload_list->TotalRecs;
} else {

	// Set the last record to display
	if ($vwRouteUnload_list->TotalRecs > $vwRouteUnload_list->StartRec + $vwRouteUnload_list->DisplayRecs - 1)
		$vwRouteUnload_list->StopRec = $vwRouteUnload_list->StartRec + $vwRouteUnload_list->DisplayRecs - 1;
	else
		$vwRouteUnload_list->StopRec = $vwRouteUnload_list->TotalRecs;
}
$vwRouteUnload_list->RecCnt = $vwRouteUnload_list->StartRec - 1;
if ($vwRouteUnload_list->Recordset && !$vwRouteUnload_list->Recordset->EOF) {
	$vwRouteUnload_list->Recordset->moveFirst();
	$selectLimit = $vwRouteUnload_list->UseSelectLimit;
	if (!$selectLimit && $vwRouteUnload_list->StartRec > 1)
		$vwRouteUnload_list->Recordset->move($vwRouteUnload_list->StartRec - 1);
} elseif (!$vwRouteUnload->AllowAddDeleteRow && $vwRouteUnload_list->StopRec == 0) {
	$vwRouteUnload_list->StopRec = $vwRouteUnload->GridAddRowCount;
}

// Initialize aggregate
$vwRouteUnload->RowType = ROWTYPE_AGGREGATEINIT;
$vwRouteUnload->resetAttributes();
$vwRouteUnload_list->renderRow();
while ($vwRouteUnload_list->RecCnt < $vwRouteUnload_list->StopRec) {
	$vwRouteUnload_list->RecCnt++;
	if ($vwRouteUnload_list->RecCnt >= $vwRouteUnload_list->StartRec) {
		$vwRouteUnload_list->RowCnt++;

		// Set up key count
		$vwRouteUnload_list->KeyCount = $vwRouteUnload_list->RowIndex;

		// Init row class and style
		$vwRouteUnload->resetAttributes();
		$vwRouteUnload->CssClass = "";
		if ($vwRouteUnload->isGridAdd()) {
		} else {
			$vwRouteUnload_list->loadRowValues($vwRouteUnload_list->Recordset); // Load row values
		}
		$vwRouteUnload->RowType = ROWTYPE_VIEW; // Render view

		// Set up row id / data-rowindex
		$vwRouteUnload->RowAttrs = array_merge($vwRouteUnload->RowAttrs, array('data-rowindex'=>$vwRouteUnload_list->RowCnt, 'id'=>'r' . $vwRouteUnload_list->RowCnt . '_vwRouteUnload', 'data-rowtype'=>$vwRouteUnload->RowType));

		// Render row
		$vwRouteUnload_list->renderRow();

		// Render list options
		$vwRouteUnload_list->renderListOptions();
?>
	<tr<?php echo $vwRouteUnload->rowAttributes() ?>>
<?php

// Render list options (body, left)
$vwRouteUnload_list->ListOptions->render("body", "left", $vwRouteUnload_list->RowCnt);
?>
	<?php if ($vwRouteUnload->PalletID->Visible) { // PalletID ?>
		<td data-name="PalletID"<?php echo $vwRouteUnload->PalletID->cellAttributes() ?>>
<span id="el<?php echo $vwRouteUnload_list->RowCnt ?>_vwRouteUnload_PalletID" class="vwRouteUnload_PalletID">
<span<?php echo $vwRouteUnload->PalletID->viewAttributes() ?>>
<?php echo $vwRouteUnload->PalletID->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($vwRouteUnload->Code->Visible) { // Code ?>
		<td data-name="Code"<?php echo $vwRouteUnload->Code->cellAttributes() ?>>
<span id="el<?php echo $vwRouteUnload_list->RowCnt ?>_vwRouteUnload_Code" class="vwRouteUnload_Code">
<span<?php echo $vwRouteUnload->Code->viewAttributes() ?>>
<?php echo $vwRouteUnload->Code->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($vwRouteUnload->PCS->Visible) { // PCS ?>
		<td data-name="PCS"<?php echo $vwRouteUnload->PCS->cellAttributes() ?>>
<span id="el<?php echo $vwRouteUnload_list->RowCnt ?>_vwRouteUnload_PCS" class="vwRouteUnload_PCS">
<span<?php echo $vwRouteUnload->PCS->viewAttributes() ?>>
<?php echo $vwRouteUnload->PCS->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($vwRouteUnload->PcsReal->Visible) { // PcsReal ?>
		<td data-name="PcsReal"<?php echo $vwRouteUnload->PcsReal->cellAttributes() ?>>
<span id="el<?php echo $vwRouteUnload_list->RowCnt ?>_vwRouteUnload_PcsReal" class="vwRouteUnload_PcsReal">
<span<?php echo $vwRouteUnload->PcsReal->viewAttributes() ?>>
<?php echo $vwRouteUnload->PcsReal->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($vwRouteUnload->CreateUser->Visible) { // CreateUser ?>
		<td data-name="CreateUser"<?php echo $vwRouteUnload->CreateUser->cellAttributes() ?>>
<span id="el<?php echo $vwRouteUnload_list->RowCnt ?>_vwRouteUnload_CreateUser" class="vwRouteUnload_CreateUser">
<span<?php echo $vwRouteUnload->CreateUser->viewAttributes() ?>>
<?php echo $vwRouteUnload->CreateUser->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($vwRouteUnload->CreateDate->Visible) { // CreateDate ?>
		<td data-name="CreateDate"<?php echo $vwRouteUnload->CreateDate->cellAttributes() ?>>
<span id="el<?php echo $vwRouteUnload_list->RowCnt ?>_vwRouteUnload_CreateDate" class="vwRouteUnload_CreateDate">
<span<?php echo $vwRouteUnload->CreateDate->viewAttributes() ?>>
<?php echo $vwRouteUnload->CreateDate->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($vwRouteUnload->MFG->Visible) { // MFG ?>
		<td data-name="MFG"<?php echo $vwRouteUnload->MFG->cellAttributes() ?>>
<span id="el<?php echo $vwRouteUnload_list->RowCnt ?>_vwRouteUnload_MFG" class="vwRouteUnload_MFG">
<span<?php echo $vwRouteUnload->MFG->viewAttributes() ?>>
<?php echo $vwRouteUnload->MFG->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($vwRouteUnload->Description->Visible) { // Description ?>
		<td data-name="Description"<?php echo $vwRouteUnload->Description->cellAttributes() ?>>
<span id="el<?php echo $vwRouteUnload_list->RowCnt ?>_vwRouteUnload_Description" class="vwRouteUnload_Description">
<span<?php echo $vwRouteUnload->Description->viewAttributes() ?>>
<?php echo $vwRouteUnload->Description->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$vwRouteUnload_list->ListOptions->render("body", "right", $vwRouteUnload_list->RowCnt);
?>
	</tr>
<?php
	}
	if (!$vwRouteUnload->isGridAdd())
		$vwRouteUnload_list->Recordset->moveNext();
}
?>
</tbody>
<?php

// Render aggregate row
$vwRouteUnload->RowType = ROWTYPE_AGGREGATE;
$vwRouteUnload->resetAttributes();
$vwRouteUnload_list->renderRow();
?>
<?php if ($vwRouteUnload_list->TotalRecs > 0 && !$vwRouteUnload->isGridAdd() && !$vwRouteUnload->isGridEdit()) { ?>
<tfoot><!-- Table footer -->
	<tr class="ew-table-footer">
<?php

// Render list options
$vwRouteUnload_list->renderListOptions();

// Render list options (footer, left)
$vwRouteUnload_list->ListOptions->render("footer", "left");
?>
	<?php if ($vwRouteUnload->PalletID->Visible) { // PalletID ?>
		<td data-name="PalletID" class="<?php echo $vwRouteUnload->PalletID->footerCellClass() ?>"><span id="elf_vwRouteUnload_PalletID" class="vwRouteUnload_PalletID">
		&nbsp;
		</span></td>
	<?php } ?>
	<?php if ($vwRouteUnload->Code->Visible) { // Code ?>
		<td data-name="Code" class="<?php echo $vwRouteUnload->Code->footerCellClass() ?>"><span id="elf_vwRouteUnload_Code" class="vwRouteUnload_Code">
		&nbsp;
		</span></td>
	<?php } ?>
	<?php if ($vwRouteUnload->PCS->Visible) { // PCS ?>
		<td data-name="PCS" class="<?php echo $vwRouteUnload->PCS->footerCellClass() ?>"><span id="elf_vwRouteUnload_PCS" class="vwRouteUnload_PCS">
		<span class="ew-aggregate"><?php echo $Language->phrase("TOTAL") ?></span><span class="ew-aggregate-value">
		<?php echo $vwRouteUnload->PCS->ViewValue ?></span>
		</span></td>
	<?php } ?>
	<?php if ($vwRouteUnload->PcsReal->Visible) { // PcsReal ?>
		<td data-name="PcsReal" class="<?php echo $vwRouteUnload->PcsReal->footerCellClass() ?>"><span id="elf_vwRouteUnload_PcsReal" class="vwRouteUnload_PcsReal">
		<span class="ew-aggregate"><?php echo $Language->phrase("TOTAL") ?></span><span class="ew-aggregate-value">
		<?php echo $vwRouteUnload->PcsReal->ViewValue ?></span>
		</span></td>
	<?php } ?>
	<?php if ($vwRouteUnload->CreateUser->Visible) { // CreateUser ?>
		<td data-name="CreateUser" class="<?php echo $vwRouteUnload->CreateUser->footerCellClass() ?>"><span id="elf_vwRouteUnload_CreateUser" class="vwRouteUnload_CreateUser">
		&nbsp;
		</span></td>
	<?php } ?>
	<?php if ($vwRouteUnload->CreateDate->Visible) { // CreateDate ?>
		<td data-name="CreateDate" class="<?php echo $vwRouteUnload->CreateDate->footerCellClass() ?>"><span id="elf_vwRouteUnload_CreateDate" class="vwRouteUnload_CreateDate">
		&nbsp;
		</span></td>
	<?php } ?>
	<?php if ($vwRouteUnload->MFG->Visible) { // MFG ?>
		<td data-name="MFG" class="<?php echo $vwRouteUnload->MFG->footerCellClass() ?>"><span id="elf_vwRouteUnload_MFG" class="vwRouteUnload_MFG">
		&nbsp;
		</span></td>
	<?php } ?>
	<?php if ($vwRouteUnload->Description->Visible) { // Description ?>
		<td data-name="Description" class="<?php echo $vwRouteUnload->Description->footerCellClass() ?>"><span id="elf_vwRouteUnload_Description" class="vwRouteUnload_Description">
		&nbsp;
		</span></td>
	<?php } ?>
<?php

// Render list options (footer, right)
$vwRouteUnload_list->ListOptions->render("footer", "right");
?>
	</tr>
</tfoot>
<?php } ?>
</table><!-- /.ew-table -->
<?php } ?>
<?php if (!$vwRouteUnload->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</div><!-- /.ew-grid-middle-panel -->
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($vwRouteUnload_list->Recordset)
	$vwRouteUnload_list->Recordset->Close();
?>
<?php if (!$vwRouteUnload->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$vwRouteUnload->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php if (!isset($vwRouteUnload_list->Pager)) $vwRouteUnload_list->Pager = new PrevNextPager($vwRouteUnload_list->StartRec, $vwRouteUnload_list->DisplayRecs, $vwRouteUnload_list->TotalRecs, $vwRouteUnload_list->AutoHidePager) ?>
<?php if ($vwRouteUnload_list->Pager->RecordCount > 0 && $vwRouteUnload_list->Pager->Visible) { ?>
<div class="ew-pager">
<span><?php echo $Language->Phrase("Page") ?>&nbsp;</span>
<div class="ew-prev-next"><div class="input-group input-group-sm">
<div class="input-group-prepend">
<!-- first page button -->
	<?php if ($vwRouteUnload_list->Pager->FirstButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerFirst") ?>" href="<?php echo $vwRouteUnload_list->pageUrl() ?>start=<?php echo $vwRouteUnload_list->Pager->FirstButton->Start ?>"><i class="icon-first ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerFirst") ?>"><i class="icon-first ew-icon"></i></a>
	<?php } ?>
<!-- previous page button -->
	<?php if ($vwRouteUnload_list->Pager->PrevButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerPrevious") ?>" href="<?php echo $vwRouteUnload_list->pageUrl() ?>start=<?php echo $vwRouteUnload_list->Pager->PrevButton->Start ?>"><i class="icon-prev ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerPrevious") ?>"><i class="icon-prev ew-icon"></i></a>
	<?php } ?>
</div>
<!-- current page number -->
	<input class="form-control" type="text" name="<?php echo TABLE_PAGE_NO ?>" value="<?php echo $vwRouteUnload_list->Pager->CurrentPage ?>">
<div class="input-group-append">
<!-- next page button -->
	<?php if ($vwRouteUnload_list->Pager->NextButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerNext") ?>" href="<?php echo $vwRouteUnload_list->pageUrl() ?>start=<?php echo $vwRouteUnload_list->Pager->NextButton->Start ?>"><i class="icon-next ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerNext") ?>"><i class="icon-next ew-icon"></i></a>
	<?php } ?>
<!-- last page button -->
	<?php if ($vwRouteUnload_list->Pager->LastButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerLast") ?>" href="<?php echo $vwRouteUnload_list->pageUrl() ?>start=<?php echo $vwRouteUnload_list->Pager->LastButton->Start ?>"><i class="icon-last ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerLast") ?>"><i class="icon-last ew-icon"></i></a>
	<?php } ?>
</div>
</div>
</div>
<span>&nbsp;<?php echo $Language->Phrase("of") ?>&nbsp;<?php echo $vwRouteUnload_list->Pager->PageCount ?></span>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php if ($vwRouteUnload_list->Pager->RecordCount > 0) { ?>
<div class="ew-pager ew-rec">
	<span><?php echo $Language->Phrase("Record") ?>&nbsp;<?php echo $vwRouteUnload_list->Pager->FromIndex ?>&nbsp;<?php echo $Language->Phrase("To") ?>&nbsp;<?php echo $vwRouteUnload_list->Pager->ToIndex ?>&nbsp;<?php echo $Language->Phrase("Of") ?>&nbsp;<?php echo $vwRouteUnload_list->Pager->RecordCount ?></span>
</div>
<?php } ?>
<?php if ($vwRouteUnload_list->TotalRecs > 0 && (!$vwRouteUnload_list->AutoHidePageSizeSelector || $vwRouteUnload_list->Pager->Visible)) { ?>
<div class="ew-pager">
<input type="hidden" name="t" value="vwRouteUnload">
<select name="<?php echo TABLE_REC_PER_PAGE ?>" class="form-control form-control-sm ew-tooltip" title="<?php echo $Language->phrase("RecordsPerPage") ?>" onchange="this.form.submit();">
<option value="20"<?php if ($vwRouteUnload_list->DisplayRecs == 20) { ?> selected<?php } ?>>20</option>
<option value="50"<?php if ($vwRouteUnload_list->DisplayRecs == 50) { ?> selected<?php } ?>>50</option>
<option value="100"<?php if ($vwRouteUnload_list->DisplayRecs == 100) { ?> selected<?php } ?>>100</option>
<option value="200"<?php if ($vwRouteUnload_list->DisplayRecs == 200) { ?> selected<?php } ?>>200</option>
<option value="500"<?php if ($vwRouteUnload_list->DisplayRecs == 500) { ?> selected<?php } ?>>500</option>
<option value="ALL"<?php if ($vwRouteUnload->getRecordsPerPage() == -1) { ?> selected<?php } ?>><?php echo $Language->Phrase("AllRecords") ?></option>
</select>
</div>
<?php } ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $vwRouteUnload_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($vwRouteUnload_list->TotalRecs == 0 && !$vwRouteUnload->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $vwRouteUnload_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$vwRouteUnload_list->showPageFooter();
if (DEBUG_ENABLED)
	echo GetDebugMessage();
?>
<?php if (!$vwRouteUnload->isExport()) { ?>
<script>

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php } ?>
<?php include_once "footer.php" ?>
<?php
$vwRouteUnload_list->terminate();
?>