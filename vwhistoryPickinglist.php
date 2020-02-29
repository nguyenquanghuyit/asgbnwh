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
$vwhistoryPicking_list = new vwhistoryPicking_list();

// Run the page
$vwhistoryPicking_list->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$vwhistoryPicking_list->Page_Render();
?>
<?php include_once "header.php" ?>
<?php if (!$vwhistoryPicking->isExport()) { ?>
<script>

// Form object
currentPageID = ew.PAGE_ID = "list";
var fvwhistoryPickinglist = currentForm = new ew.Form("fvwhistoryPickinglist", "list");
fvwhistoryPickinglist.formKeyCountName = '<?php echo $vwhistoryPicking_list->FormKeyCountName ?>';

// Form_CustomValidate event
fvwhistoryPickinglist.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

	// Your custom validation code here, return false if invalid.
	return true;
}

// Use JavaScript validation or not
fvwhistoryPickinglist.validateRequired = <?php echo json_encode(CLIENT_VALIDATE) ?>;

// Dynamic selection lists
// Form object for search

var fvwhistoryPickinglistsrch = currentSearchForm = new ew.Form("fvwhistoryPickinglistsrch");

// Filters
fvwhistoryPickinglistsrch.filterList = <?php echo $vwhistoryPicking_list->getFilterList() ?>;
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
<?php if (!$vwhistoryPicking->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($vwhistoryPicking_list->TotalRecs > 0 && $vwhistoryPicking_list->ExportOptions->visible()) { ?>
<?php $vwhistoryPicking_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($vwhistoryPicking_list->ImportOptions->visible()) { ?>
<?php $vwhistoryPicking_list->ImportOptions->render("body") ?>
<?php } ?>
<?php if ($vwhistoryPicking_list->SearchOptions->visible()) { ?>
<?php $vwhistoryPicking_list->SearchOptions->render("body") ?>
<?php } ?>
<?php if ($vwhistoryPicking_list->FilterOptions->visible()) { ?>
<?php $vwhistoryPicking_list->FilterOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php if (!$vwhistoryPicking->isExport() || EXPORT_MASTER_RECORD && $vwhistoryPicking->isExport("print")) { ?>
<?php
if ($vwhistoryPicking_list->DbMasterFilter <> "" && $vwhistoryPicking->getCurrentMasterTable() == "tbl_order") {
	if ($vwhistoryPicking_list->MasterRecordExists) {
		include_once "tbl_ordermaster.php";
	}
}
?>
<?php } ?>
<?php
$vwhistoryPicking_list->renderOtherOptions();
?>
<?php if ($Security->CanSearch()) { ?>
<?php if (!$vwhistoryPicking->isExport() && !$vwhistoryPicking->CurrentAction) { ?>
<form name="fvwhistoryPickinglistsrch" id="fvwhistoryPickinglistsrch" class="form-inline ew-form ew-ext-search-form" action="<?php echo CurrentPageName() ?>">
<?php $searchPanelClass = ($vwhistoryPicking_list->SearchWhere <> "") ? " show" : " show"; ?>
<div id="fvwhistoryPickinglistsrch-search-panel" class="ew-search-panel collapse<?php echo $searchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="vwhistoryPicking">
	<div class="ew-basic-search">
<div id="xsr_1" class="ew-row d-sm-flex">
	<div class="ew-quick-search input-group">
		<input type="text" name="<?php echo TABLE_BASIC_SEARCH ?>" id="<?php echo TABLE_BASIC_SEARCH ?>" class="form-control" value="<?php echo HtmlEncode($vwhistoryPicking_list->BasicSearch->getKeyword()) ?>" placeholder="<?php echo HtmlEncode($Language->phrase("Search")) ?>">
		<input type="hidden" name="<?php echo TABLE_BASIC_SEARCH_TYPE ?>" id="<?php echo TABLE_BASIC_SEARCH_TYPE ?>" value="<?php echo HtmlEncode($vwhistoryPicking_list->BasicSearch->getType()) ?>">
		<div class="input-group-append">
			<button class="btn btn-primary" name="btn-submit" id="btn-submit" type="submit"><?php echo $Language->phrase("SearchBtn") ?></button>
			<button type="button" data-toggle="dropdown" class="btn btn-primary dropdown-toggle dropdown-toggle-split" aria-haspopup="true" aria-expanded="false"><span id="searchtype"><?php echo $vwhistoryPicking_list->BasicSearch->getTypeNameShort() ?></span></button>
			<div class="dropdown-menu dropdown-menu-right">
				<a class="dropdown-item<?php if ($vwhistoryPicking_list->BasicSearch->getType() == "") echo " active"; ?>" href="javascript:void(0);" onclick="ew.setSearchType(this)"><?php echo $Language->phrase("QuickSearchAuto") ?></a>
				<a class="dropdown-item<?php if ($vwhistoryPicking_list->BasicSearch->getType() == "=") echo " active"; ?>" href="javascript:void(0);" onclick="ew.setSearchType(this,'=')"><?php echo $Language->phrase("QuickSearchExact") ?></a>
				<a class="dropdown-item<?php if ($vwhistoryPicking_list->BasicSearch->getType() == "AND") echo " active"; ?>" href="javascript:void(0);" onclick="ew.setSearchType(this,'AND')"><?php echo $Language->phrase("QuickSearchAll") ?></a>
				<a class="dropdown-item<?php if ($vwhistoryPicking_list->BasicSearch->getType() == "OR") echo " active"; ?>" href="javascript:void(0);" onclick="ew.setSearchType(this,'OR')"><?php echo $Language->phrase("QuickSearchAny") ?></a>
			</div>
		</div>
	</div>
</div>
	</div>
</div>
</form>
<?php } ?>
<?php } ?>
<?php $vwhistoryPicking_list->showPageHeader(); ?>
<?php
$vwhistoryPicking_list->showMessage();
?>
<?php if ($vwhistoryPicking_list->TotalRecs > 0 || $vwhistoryPicking->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($vwhistoryPicking_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> vwhistoryPicking">
<?php if (!$vwhistoryPicking->isExport()) { ?>
<div class="card-header ew-grid-upper-panel">
<?php if (!$vwhistoryPicking->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php if (!isset($vwhistoryPicking_list->Pager)) $vwhistoryPicking_list->Pager = new PrevNextPager($vwhistoryPicking_list->StartRec, $vwhistoryPicking_list->DisplayRecs, $vwhistoryPicking_list->TotalRecs, $vwhistoryPicking_list->AutoHidePager) ?>
<?php if ($vwhistoryPicking_list->Pager->RecordCount > 0 && $vwhistoryPicking_list->Pager->Visible) { ?>
<div class="ew-pager">
<span><?php echo $Language->Phrase("Page") ?>&nbsp;</span>
<div class="ew-prev-next"><div class="input-group input-group-sm">
<div class="input-group-prepend">
<!-- first page button -->
	<?php if ($vwhistoryPicking_list->Pager->FirstButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerFirst") ?>" href="<?php echo $vwhistoryPicking_list->pageUrl() ?>start=<?php echo $vwhistoryPicking_list->Pager->FirstButton->Start ?>"><i class="icon-first ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerFirst") ?>"><i class="icon-first ew-icon"></i></a>
	<?php } ?>
<!-- previous page button -->
	<?php if ($vwhistoryPicking_list->Pager->PrevButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerPrevious") ?>" href="<?php echo $vwhistoryPicking_list->pageUrl() ?>start=<?php echo $vwhistoryPicking_list->Pager->PrevButton->Start ?>"><i class="icon-prev ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerPrevious") ?>"><i class="icon-prev ew-icon"></i></a>
	<?php } ?>
</div>
<!-- current page number -->
	<input class="form-control" type="text" name="<?php echo TABLE_PAGE_NO ?>" value="<?php echo $vwhistoryPicking_list->Pager->CurrentPage ?>">
<div class="input-group-append">
<!-- next page button -->
	<?php if ($vwhistoryPicking_list->Pager->NextButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerNext") ?>" href="<?php echo $vwhistoryPicking_list->pageUrl() ?>start=<?php echo $vwhistoryPicking_list->Pager->NextButton->Start ?>"><i class="icon-next ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerNext") ?>"><i class="icon-next ew-icon"></i></a>
	<?php } ?>
<!-- last page button -->
	<?php if ($vwhistoryPicking_list->Pager->LastButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerLast") ?>" href="<?php echo $vwhistoryPicking_list->pageUrl() ?>start=<?php echo $vwhistoryPicking_list->Pager->LastButton->Start ?>"><i class="icon-last ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerLast") ?>"><i class="icon-last ew-icon"></i></a>
	<?php } ?>
</div>
</div>
</div>
<span>&nbsp;<?php echo $Language->Phrase("of") ?>&nbsp;<?php echo $vwhistoryPicking_list->Pager->PageCount ?></span>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php if ($vwhistoryPicking_list->Pager->RecordCount > 0) { ?>
<div class="ew-pager ew-rec">
	<span><?php echo $Language->Phrase("Record") ?>&nbsp;<?php echo $vwhistoryPicking_list->Pager->FromIndex ?>&nbsp;<?php echo $Language->Phrase("To") ?>&nbsp;<?php echo $vwhistoryPicking_list->Pager->ToIndex ?>&nbsp;<?php echo $Language->Phrase("Of") ?>&nbsp;<?php echo $vwhistoryPicking_list->Pager->RecordCount ?></span>
</div>
<?php } ?>
<?php if ($vwhistoryPicking_list->TotalRecs > 0 && (!$vwhistoryPicking_list->AutoHidePageSizeSelector || $vwhistoryPicking_list->Pager->Visible)) { ?>
<div class="ew-pager">
<input type="hidden" name="t" value="vwhistoryPicking">
<select name="<?php echo TABLE_REC_PER_PAGE ?>" class="form-control form-control-sm ew-tooltip" title="<?php echo $Language->phrase("RecordsPerPage") ?>" onchange="this.form.submit();">
<option value="20"<?php if ($vwhistoryPicking_list->DisplayRecs == 20) { ?> selected<?php } ?>>20</option>
<option value="50"<?php if ($vwhistoryPicking_list->DisplayRecs == 50) { ?> selected<?php } ?>>50</option>
<option value="100"<?php if ($vwhistoryPicking_list->DisplayRecs == 100) { ?> selected<?php } ?>>100</option>
<option value="200"<?php if ($vwhistoryPicking_list->DisplayRecs == 200) { ?> selected<?php } ?>>200</option>
<option value="500"<?php if ($vwhistoryPicking_list->DisplayRecs == 500) { ?> selected<?php } ?>>500</option>
<option value="ALL"<?php if ($vwhistoryPicking->getRecordsPerPage() == -1) { ?> selected<?php } ?>><?php echo $Language->Phrase("AllRecords") ?></option>
</select>
</div>
<?php } ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $vwhistoryPicking_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
<form name="fvwhistoryPickinglist" id="fvwhistoryPickinglist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($vwhistoryPicking_list->CheckToken) { ?>
<input type="hidden" name="<?php echo TOKEN_NAME ?>" value="<?php echo $vwhistoryPicking_list->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="vwhistoryPicking">
<input type="hidden" name="exporttype" id="exporttype" value="">
<?php if ($vwhistoryPicking->getCurrentMasterTable() == "tbl_order" && $vwhistoryPicking->CurrentAction) { ?>
<input type="hidden" name="<?php echo TABLE_SHOW_MASTER ?>" value="tbl_order">
<input type="hidden" name="fk_ID_Order" value="<?php echo $vwhistoryPicking->ID_Order->getSessionValue() ?>">
<?php } ?>
<div id="gmp_vwhistoryPicking" class="<?php if (IsResponsiveLayout()) { ?>table-responsive <?php } ?>card-body ew-grid-middle-panel">
<?php if ($vwhistoryPicking_list->TotalRecs > 0 || $vwhistoryPicking->isGridEdit()) { ?>
<table id="tbl_vwhistoryPickinglist" class="table ew-table"><!-- .ew-table ##-->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$vwhistoryPicking_list->RowType = ROWTYPE_HEADER;

// Render list options
$vwhistoryPicking_list->renderListOptions();

// Render list options (header, left)
$vwhistoryPicking_list->ListOptions->render("header", "left");
?>
<?php if ($vwhistoryPicking->ID_His->Visible) { // ID_His ?>
	<?php if ($vwhistoryPicking->sortUrl($vwhistoryPicking->ID_His) == "") { ?>
		<th data-name="ID_His" class="<?php echo $vwhistoryPicking->ID_His->headerCellClass() ?>"><div id="elh_vwhistoryPicking_ID_His" class="vwhistoryPicking_ID_His"><div class="ew-table-header-caption"><?php echo $vwhistoryPicking->ID_His->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="ID_His" class="<?php echo $vwhistoryPicking->ID_His->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $vwhistoryPicking->SortUrl($vwhistoryPicking->ID_His) ?>',2);"><div id="elh_vwhistoryPicking_ID_His" class="vwhistoryPicking_ID_His">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $vwhistoryPicking->ID_His->caption() ?></span><span class="ew-table-header-sort"><?php if ($vwhistoryPicking->ID_His->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($vwhistoryPicking->ID_His->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($vwhistoryPicking->PalletID->Visible) { // PalletID ?>
	<?php if ($vwhistoryPicking->sortUrl($vwhistoryPicking->PalletID) == "") { ?>
		<th data-name="PalletID" class="<?php echo $vwhistoryPicking->PalletID->headerCellClass() ?>"><div id="elh_vwhistoryPicking_PalletID" class="vwhistoryPicking_PalletID"><div class="ew-table-header-caption"><?php echo $vwhistoryPicking->PalletID->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="PalletID" class="<?php echo $vwhistoryPicking->PalletID->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $vwhistoryPicking->SortUrl($vwhistoryPicking->PalletID) ?>',2);"><div id="elh_vwhistoryPicking_PalletID" class="vwhistoryPicking_PalletID">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $vwhistoryPicking->PalletID->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($vwhistoryPicking->PalletID->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($vwhistoryPicking->PalletID->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($vwhistoryPicking->Code->Visible) { // Code ?>
	<?php if ($vwhistoryPicking->sortUrl($vwhistoryPicking->Code) == "") { ?>
		<th data-name="Code" class="<?php echo $vwhistoryPicking->Code->headerCellClass() ?>"><div id="elh_vwhistoryPicking_Code" class="vwhistoryPicking_Code"><div class="ew-table-header-caption"><?php echo $vwhistoryPicking->Code->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Code" class="<?php echo $vwhistoryPicking->Code->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $vwhistoryPicking->SortUrl($vwhistoryPicking->Code) ?>',2);"><div id="elh_vwhistoryPicking_Code" class="vwhistoryPicking_Code">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $vwhistoryPicking->Code->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($vwhistoryPicking->Code->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($vwhistoryPicking->Code->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($vwhistoryPicking->PCS->Visible) { // PCS ?>
	<?php if ($vwhistoryPicking->sortUrl($vwhistoryPicking->PCS) == "") { ?>
		<th data-name="PCS" class="<?php echo $vwhistoryPicking->PCS->headerCellClass() ?>"><div id="elh_vwhistoryPicking_PCS" class="vwhistoryPicking_PCS"><div class="ew-table-header-caption"><?php echo $vwhistoryPicking->PCS->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="PCS" class="<?php echo $vwhistoryPicking->PCS->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $vwhistoryPicking->SortUrl($vwhistoryPicking->PCS) ?>',2);"><div id="elh_vwhistoryPicking_PCS" class="vwhistoryPicking_PCS">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $vwhistoryPicking->PCS->caption() ?></span><span class="ew-table-header-sort"><?php if ($vwhistoryPicking->PCS->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($vwhistoryPicking->PCS->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($vwhistoryPicking->Location->Visible) { // Location ?>
	<?php if ($vwhistoryPicking->sortUrl($vwhistoryPicking->Location) == "") { ?>
		<th data-name="Location" class="<?php echo $vwhistoryPicking->Location->headerCellClass() ?>"><div id="elh_vwhistoryPicking_Location" class="vwhistoryPicking_Location"><div class="ew-table-header-caption"><?php echo $vwhistoryPicking->Location->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Location" class="<?php echo $vwhistoryPicking->Location->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $vwhistoryPicking->SortUrl($vwhistoryPicking->Location) ?>',2);"><div id="elh_vwhistoryPicking_Location" class="vwhistoryPicking_Location">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $vwhistoryPicking->Location->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($vwhistoryPicking->Location->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($vwhistoryPicking->Location->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($vwhistoryPicking->Box->Visible) { // Box ?>
	<?php if ($vwhistoryPicking->sortUrl($vwhistoryPicking->Box) == "") { ?>
		<th data-name="Box" class="<?php echo $vwhistoryPicking->Box->headerCellClass() ?>"><div id="elh_vwhistoryPicking_Box" class="vwhistoryPicking_Box"><div class="ew-table-header-caption"><?php echo $vwhistoryPicking->Box->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Box" class="<?php echo $vwhistoryPicking->Box->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $vwhistoryPicking->SortUrl($vwhistoryPicking->Box) ?>',2);"><div id="elh_vwhistoryPicking_Box" class="vwhistoryPicking_Box">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $vwhistoryPicking->Box->caption() ?></span><span class="ew-table-header-sort"><?php if ($vwhistoryPicking->Box->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($vwhistoryPicking->Box->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($vwhistoryPicking->CreateUser->Visible) { // CreateUser ?>
	<?php if ($vwhistoryPicking->sortUrl($vwhistoryPicking->CreateUser) == "") { ?>
		<th data-name="CreateUser" class="<?php echo $vwhistoryPicking->CreateUser->headerCellClass() ?>"><div id="elh_vwhistoryPicking_CreateUser" class="vwhistoryPicking_CreateUser"><div class="ew-table-header-caption"><?php echo $vwhistoryPicking->CreateUser->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="CreateUser" class="<?php echo $vwhistoryPicking->CreateUser->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $vwhistoryPicking->SortUrl($vwhistoryPicking->CreateUser) ?>',2);"><div id="elh_vwhistoryPicking_CreateUser" class="vwhistoryPicking_CreateUser">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $vwhistoryPicking->CreateUser->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($vwhistoryPicking->CreateUser->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($vwhistoryPicking->CreateUser->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($vwhistoryPicking->CreateDate->Visible) { // CreateDate ?>
	<?php if ($vwhistoryPicking->sortUrl($vwhistoryPicking->CreateDate) == "") { ?>
		<th data-name="CreateDate" class="<?php echo $vwhistoryPicking->CreateDate->headerCellClass() ?>"><div id="elh_vwhistoryPicking_CreateDate" class="vwhistoryPicking_CreateDate"><div class="ew-table-header-caption"><?php echo $vwhistoryPicking->CreateDate->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="CreateDate" class="<?php echo $vwhistoryPicking->CreateDate->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $vwhistoryPicking->SortUrl($vwhistoryPicking->CreateDate) ?>',2);"><div id="elh_vwhistoryPicking_CreateDate" class="vwhistoryPicking_CreateDate">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $vwhistoryPicking->CreateDate->caption() ?></span><span class="ew-table-header-sort"><?php if ($vwhistoryPicking->CreateDate->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($vwhistoryPicking->CreateDate->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($vwhistoryPicking->UpdateUser->Visible) { // UpdateUser ?>
	<?php if ($vwhistoryPicking->sortUrl($vwhistoryPicking->UpdateUser) == "") { ?>
		<th data-name="UpdateUser" class="<?php echo $vwhistoryPicking->UpdateUser->headerCellClass() ?>"><div id="elh_vwhistoryPicking_UpdateUser" class="vwhistoryPicking_UpdateUser"><div class="ew-table-header-caption"><?php echo $vwhistoryPicking->UpdateUser->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="UpdateUser" class="<?php echo $vwhistoryPicking->UpdateUser->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $vwhistoryPicking->SortUrl($vwhistoryPicking->UpdateUser) ?>',2);"><div id="elh_vwhistoryPicking_UpdateUser" class="vwhistoryPicking_UpdateUser">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $vwhistoryPicking->UpdateUser->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($vwhistoryPicking->UpdateUser->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($vwhistoryPicking->UpdateUser->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($vwhistoryPicking->UpdateDate->Visible) { // UpdateDate ?>
	<?php if ($vwhistoryPicking->sortUrl($vwhistoryPicking->UpdateDate) == "") { ?>
		<th data-name="UpdateDate" class="<?php echo $vwhistoryPicking->UpdateDate->headerCellClass() ?>"><div id="elh_vwhistoryPicking_UpdateDate" class="vwhistoryPicking_UpdateDate"><div class="ew-table-header-caption"><?php echo $vwhistoryPicking->UpdateDate->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="UpdateDate" class="<?php echo $vwhistoryPicking->UpdateDate->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $vwhistoryPicking->SortUrl($vwhistoryPicking->UpdateDate) ?>',2);"><div id="elh_vwhistoryPicking_UpdateDate" class="vwhistoryPicking_UpdateDate">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $vwhistoryPicking->UpdateDate->caption() ?></span><span class="ew-table-header-sort"><?php if ($vwhistoryPicking->UpdateDate->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($vwhistoryPicking->UpdateDate->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($vwhistoryPicking->ID_Order->Visible) { // ID_Order ?>
	<?php if ($vwhistoryPicking->sortUrl($vwhistoryPicking->ID_Order) == "") { ?>
		<th data-name="ID_Order" class="<?php echo $vwhistoryPicking->ID_Order->headerCellClass() ?>"><div id="elh_vwhistoryPicking_ID_Order" class="vwhistoryPicking_ID_Order"><div class="ew-table-header-caption"><?php echo $vwhistoryPicking->ID_Order->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="ID_Order" class="<?php echo $vwhistoryPicking->ID_Order->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $vwhistoryPicking->SortUrl($vwhistoryPicking->ID_Order) ?>',2);"><div id="elh_vwhistoryPicking_ID_Order" class="vwhistoryPicking_ID_Order">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $vwhistoryPicking->ID_Order->caption() ?></span><span class="ew-table-header-sort"><?php if ($vwhistoryPicking->ID_Order->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($vwhistoryPicking->ID_Order->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$vwhistoryPicking_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
if ($vwhistoryPicking->ExportAll && $vwhistoryPicking->isExport()) {
	$vwhistoryPicking_list->StopRec = $vwhistoryPicking_list->TotalRecs;
} else {

	// Set the last record to display
	if ($vwhistoryPicking_list->TotalRecs > $vwhistoryPicking_list->StartRec + $vwhistoryPicking_list->DisplayRecs - 1)
		$vwhistoryPicking_list->StopRec = $vwhistoryPicking_list->StartRec + $vwhistoryPicking_list->DisplayRecs - 1;
	else
		$vwhistoryPicking_list->StopRec = $vwhistoryPicking_list->TotalRecs;
}
$vwhistoryPicking_list->RecCnt = $vwhistoryPicking_list->StartRec - 1;
if ($vwhistoryPicking_list->Recordset && !$vwhistoryPicking_list->Recordset->EOF) {
	$vwhistoryPicking_list->Recordset->moveFirst();
	$selectLimit = $vwhistoryPicking_list->UseSelectLimit;
	if (!$selectLimit && $vwhistoryPicking_list->StartRec > 1)
		$vwhistoryPicking_list->Recordset->move($vwhistoryPicking_list->StartRec - 1);
} elseif (!$vwhistoryPicking->AllowAddDeleteRow && $vwhistoryPicking_list->StopRec == 0) {
	$vwhistoryPicking_list->StopRec = $vwhistoryPicking->GridAddRowCount;
}

// Initialize aggregate
$vwhistoryPicking->RowType = ROWTYPE_AGGREGATEINIT;
$vwhistoryPicking->resetAttributes();
$vwhistoryPicking_list->renderRow();
while ($vwhistoryPicking_list->RecCnt < $vwhistoryPicking_list->StopRec) {
	$vwhistoryPicking_list->RecCnt++;
	if ($vwhistoryPicking_list->RecCnt >= $vwhistoryPicking_list->StartRec) {
		$vwhistoryPicking_list->RowCnt++;

		// Set up key count
		$vwhistoryPicking_list->KeyCount = $vwhistoryPicking_list->RowIndex;

		// Init row class and style
		$vwhistoryPicking->resetAttributes();
		$vwhistoryPicking->CssClass = "";
		if ($vwhistoryPicking->isGridAdd()) {
		} else {
			$vwhistoryPicking_list->loadRowValues($vwhistoryPicking_list->Recordset); // Load row values
		}
		$vwhistoryPicking->RowType = ROWTYPE_VIEW; // Render view

		// Set up row id / data-rowindex
		$vwhistoryPicking->RowAttrs = array_merge($vwhistoryPicking->RowAttrs, array('data-rowindex'=>$vwhistoryPicking_list->RowCnt, 'id'=>'r' . $vwhistoryPicking_list->RowCnt . '_vwhistoryPicking', 'data-rowtype'=>$vwhistoryPicking->RowType));

		// Render row
		$vwhistoryPicking_list->renderRow();

		// Render list options
		$vwhistoryPicking_list->renderListOptions();
?>
	<tr<?php echo $vwhistoryPicking->rowAttributes() ?>>
<?php

// Render list options (body, left)
$vwhistoryPicking_list->ListOptions->render("body", "left", $vwhistoryPicking_list->RowCnt);
?>
	<?php if ($vwhistoryPicking->ID_His->Visible) { // ID_His ?>
		<td data-name="ID_His"<?php echo $vwhistoryPicking->ID_His->cellAttributes() ?>>
<span id="el<?php echo $vwhistoryPicking_list->RowCnt ?>_vwhistoryPicking_ID_His" class="vwhistoryPicking_ID_His">
<span<?php echo $vwhistoryPicking->ID_His->viewAttributes() ?>>
<?php echo $vwhistoryPicking->ID_His->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($vwhistoryPicking->PalletID->Visible) { // PalletID ?>
		<td data-name="PalletID"<?php echo $vwhistoryPicking->PalletID->cellAttributes() ?>>
<span id="el<?php echo $vwhistoryPicking_list->RowCnt ?>_vwhistoryPicking_PalletID" class="vwhistoryPicking_PalletID">
<span<?php echo $vwhistoryPicking->PalletID->viewAttributes() ?>>
<?php echo $vwhistoryPicking->PalletID->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($vwhistoryPicking->Code->Visible) { // Code ?>
		<td data-name="Code"<?php echo $vwhistoryPicking->Code->cellAttributes() ?>>
<span id="el<?php echo $vwhistoryPicking_list->RowCnt ?>_vwhistoryPicking_Code" class="vwhistoryPicking_Code">
<span<?php echo $vwhistoryPicking->Code->viewAttributes() ?>>
<?php echo $vwhistoryPicking->Code->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($vwhistoryPicking->PCS->Visible) { // PCS ?>
		<td data-name="PCS"<?php echo $vwhistoryPicking->PCS->cellAttributes() ?>>
<span id="el<?php echo $vwhistoryPicking_list->RowCnt ?>_vwhistoryPicking_PCS" class="vwhistoryPicking_PCS">
<span<?php echo $vwhistoryPicking->PCS->viewAttributes() ?>>
<?php echo $vwhistoryPicking->PCS->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($vwhistoryPicking->Location->Visible) { // Location ?>
		<td data-name="Location"<?php echo $vwhistoryPicking->Location->cellAttributes() ?>>
<span id="el<?php echo $vwhistoryPicking_list->RowCnt ?>_vwhistoryPicking_Location" class="vwhistoryPicking_Location">
<span<?php echo $vwhistoryPicking->Location->viewAttributes() ?>>
<?php echo $vwhistoryPicking->Location->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($vwhistoryPicking->Box->Visible) { // Box ?>
		<td data-name="Box"<?php echo $vwhistoryPicking->Box->cellAttributes() ?>>
<span id="el<?php echo $vwhistoryPicking_list->RowCnt ?>_vwhistoryPicking_Box" class="vwhistoryPicking_Box">
<span<?php echo $vwhistoryPicking->Box->viewAttributes() ?>>
<?php echo $vwhistoryPicking->Box->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($vwhistoryPicking->CreateUser->Visible) { // CreateUser ?>
		<td data-name="CreateUser"<?php echo $vwhistoryPicking->CreateUser->cellAttributes() ?>>
<span id="el<?php echo $vwhistoryPicking_list->RowCnt ?>_vwhistoryPicking_CreateUser" class="vwhistoryPicking_CreateUser">
<span<?php echo $vwhistoryPicking->CreateUser->viewAttributes() ?>>
<?php echo $vwhistoryPicking->CreateUser->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($vwhistoryPicking->CreateDate->Visible) { // CreateDate ?>
		<td data-name="CreateDate"<?php echo $vwhistoryPicking->CreateDate->cellAttributes() ?>>
<span id="el<?php echo $vwhistoryPicking_list->RowCnt ?>_vwhistoryPicking_CreateDate" class="vwhistoryPicking_CreateDate">
<span<?php echo $vwhistoryPicking->CreateDate->viewAttributes() ?>>
<?php echo $vwhistoryPicking->CreateDate->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($vwhistoryPicking->UpdateUser->Visible) { // UpdateUser ?>
		<td data-name="UpdateUser"<?php echo $vwhistoryPicking->UpdateUser->cellAttributes() ?>>
<span id="el<?php echo $vwhistoryPicking_list->RowCnt ?>_vwhistoryPicking_UpdateUser" class="vwhistoryPicking_UpdateUser">
<span<?php echo $vwhistoryPicking->UpdateUser->viewAttributes() ?>>
<?php echo $vwhistoryPicking->UpdateUser->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($vwhistoryPicking->UpdateDate->Visible) { // UpdateDate ?>
		<td data-name="UpdateDate"<?php echo $vwhistoryPicking->UpdateDate->cellAttributes() ?>>
<span id="el<?php echo $vwhistoryPicking_list->RowCnt ?>_vwhistoryPicking_UpdateDate" class="vwhistoryPicking_UpdateDate">
<span<?php echo $vwhistoryPicking->UpdateDate->viewAttributes() ?>>
<?php echo $vwhistoryPicking->UpdateDate->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($vwhistoryPicking->ID_Order->Visible) { // ID_Order ?>
		<td data-name="ID_Order"<?php echo $vwhistoryPicking->ID_Order->cellAttributes() ?>>
<span id="el<?php echo $vwhistoryPicking_list->RowCnt ?>_vwhistoryPicking_ID_Order" class="vwhistoryPicking_ID_Order">
<span<?php echo $vwhistoryPicking->ID_Order->viewAttributes() ?>>
<?php echo $vwhistoryPicking->ID_Order->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$vwhistoryPicking_list->ListOptions->render("body", "right", $vwhistoryPicking_list->RowCnt);
?>
	</tr>
<?php
	}
	if (!$vwhistoryPicking->isGridAdd())
		$vwhistoryPicking_list->Recordset->moveNext();
}
?>
</tbody>
</table><!-- /.ew-table -->
<?php } ?>
<?php if (!$vwhistoryPicking->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</div><!-- /.ew-grid-middle-panel -->
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($vwhistoryPicking_list->Recordset)
	$vwhistoryPicking_list->Recordset->Close();
?>
<?php if (!$vwhistoryPicking->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$vwhistoryPicking->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php if (!isset($vwhistoryPicking_list->Pager)) $vwhistoryPicking_list->Pager = new PrevNextPager($vwhistoryPicking_list->StartRec, $vwhistoryPicking_list->DisplayRecs, $vwhistoryPicking_list->TotalRecs, $vwhistoryPicking_list->AutoHidePager) ?>
<?php if ($vwhistoryPicking_list->Pager->RecordCount > 0 && $vwhistoryPicking_list->Pager->Visible) { ?>
<div class="ew-pager">
<span><?php echo $Language->Phrase("Page") ?>&nbsp;</span>
<div class="ew-prev-next"><div class="input-group input-group-sm">
<div class="input-group-prepend">
<!-- first page button -->
	<?php if ($vwhistoryPicking_list->Pager->FirstButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerFirst") ?>" href="<?php echo $vwhistoryPicking_list->pageUrl() ?>start=<?php echo $vwhistoryPicking_list->Pager->FirstButton->Start ?>"><i class="icon-first ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerFirst") ?>"><i class="icon-first ew-icon"></i></a>
	<?php } ?>
<!-- previous page button -->
	<?php if ($vwhistoryPicking_list->Pager->PrevButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerPrevious") ?>" href="<?php echo $vwhistoryPicking_list->pageUrl() ?>start=<?php echo $vwhistoryPicking_list->Pager->PrevButton->Start ?>"><i class="icon-prev ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerPrevious") ?>"><i class="icon-prev ew-icon"></i></a>
	<?php } ?>
</div>
<!-- current page number -->
	<input class="form-control" type="text" name="<?php echo TABLE_PAGE_NO ?>" value="<?php echo $vwhistoryPicking_list->Pager->CurrentPage ?>">
<div class="input-group-append">
<!-- next page button -->
	<?php if ($vwhistoryPicking_list->Pager->NextButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerNext") ?>" href="<?php echo $vwhistoryPicking_list->pageUrl() ?>start=<?php echo $vwhistoryPicking_list->Pager->NextButton->Start ?>"><i class="icon-next ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerNext") ?>"><i class="icon-next ew-icon"></i></a>
	<?php } ?>
<!-- last page button -->
	<?php if ($vwhistoryPicking_list->Pager->LastButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerLast") ?>" href="<?php echo $vwhistoryPicking_list->pageUrl() ?>start=<?php echo $vwhistoryPicking_list->Pager->LastButton->Start ?>"><i class="icon-last ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerLast") ?>"><i class="icon-last ew-icon"></i></a>
	<?php } ?>
</div>
</div>
</div>
<span>&nbsp;<?php echo $Language->Phrase("of") ?>&nbsp;<?php echo $vwhistoryPicking_list->Pager->PageCount ?></span>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php if ($vwhistoryPicking_list->Pager->RecordCount > 0) { ?>
<div class="ew-pager ew-rec">
	<span><?php echo $Language->Phrase("Record") ?>&nbsp;<?php echo $vwhistoryPicking_list->Pager->FromIndex ?>&nbsp;<?php echo $Language->Phrase("To") ?>&nbsp;<?php echo $vwhistoryPicking_list->Pager->ToIndex ?>&nbsp;<?php echo $Language->Phrase("Of") ?>&nbsp;<?php echo $vwhistoryPicking_list->Pager->RecordCount ?></span>
</div>
<?php } ?>
<?php if ($vwhistoryPicking_list->TotalRecs > 0 && (!$vwhistoryPicking_list->AutoHidePageSizeSelector || $vwhistoryPicking_list->Pager->Visible)) { ?>
<div class="ew-pager">
<input type="hidden" name="t" value="vwhistoryPicking">
<select name="<?php echo TABLE_REC_PER_PAGE ?>" class="form-control form-control-sm ew-tooltip" title="<?php echo $Language->phrase("RecordsPerPage") ?>" onchange="this.form.submit();">
<option value="20"<?php if ($vwhistoryPicking_list->DisplayRecs == 20) { ?> selected<?php } ?>>20</option>
<option value="50"<?php if ($vwhistoryPicking_list->DisplayRecs == 50) { ?> selected<?php } ?>>50</option>
<option value="100"<?php if ($vwhistoryPicking_list->DisplayRecs == 100) { ?> selected<?php } ?>>100</option>
<option value="200"<?php if ($vwhistoryPicking_list->DisplayRecs == 200) { ?> selected<?php } ?>>200</option>
<option value="500"<?php if ($vwhistoryPicking_list->DisplayRecs == 500) { ?> selected<?php } ?>>500</option>
<option value="ALL"<?php if ($vwhistoryPicking->getRecordsPerPage() == -1) { ?> selected<?php } ?>><?php echo $Language->Phrase("AllRecords") ?></option>
</select>
</div>
<?php } ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $vwhistoryPicking_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($vwhistoryPicking_list->TotalRecs == 0 && !$vwhistoryPicking->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $vwhistoryPicking_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$vwhistoryPicking_list->showPageFooter();
if (DEBUG_ENABLED)
	echo GetDebugMessage();
?>
<?php if (!$vwhistoryPicking->isExport()) { ?>
<script>

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php } ?>
<?php include_once "footer.php" ?>
<?php
$vwhistoryPicking_list->terminate();
?>