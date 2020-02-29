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
$vwguidepicking_list = new vwguidepicking_list();

// Run the page
$vwguidepicking_list->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$vwguidepicking_list->Page_Render();
?>
<?php include_once "header.php" ?>
<?php if (!$vwguidepicking->isExport()) { ?>
<script>

// Form object
currentPageID = ew.PAGE_ID = "list";
var fvwguidepickinglist = currentForm = new ew.Form("fvwguidepickinglist", "list");
fvwguidepickinglist.formKeyCountName = '<?php echo $vwguidepicking_list->FormKeyCountName ?>';

// Form_CustomValidate event
fvwguidepickinglist.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

	// Your custom validation code here, return false if invalid.
	return true;
}

// Use JavaScript validation or not
fvwguidepickinglist.validateRequired = <?php echo json_encode(CLIENT_VALIDATE) ?>;

// Dynamic selection lists
fvwguidepickinglist.lists["x_ID_Location"] = <?php echo $vwguidepicking_list->ID_Location->Lookup->toClientList() ?>;
fvwguidepickinglist.lists["x_ID_Location"].options = <?php echo JsonEncode($vwguidepicking_list->ID_Location->lookupOptions()) ?>;
fvwguidepickinglist.autoSuggests["x_ID_Location"] = <?php echo json_encode(["data" => "ajax=autosuggest"]) ?>;

// Form object for search
var fvwguidepickinglistsrch = currentSearchForm = new ew.Form("fvwguidepickinglistsrch");

// Filters
fvwguidepickinglistsrch.filterList = <?php echo $vwguidepicking_list->getFilterList() ?>;
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
<?php if (!$vwguidepicking->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($vwguidepicking_list->TotalRecs > 0 && $vwguidepicking_list->ExportOptions->visible()) { ?>
<?php $vwguidepicking_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($vwguidepicking_list->ImportOptions->visible()) { ?>
<?php $vwguidepicking_list->ImportOptions->render("body") ?>
<?php } ?>
<?php if ($vwguidepicking_list->SearchOptions->visible()) { ?>
<?php $vwguidepicking_list->SearchOptions->render("body") ?>
<?php } ?>
<?php if ($vwguidepicking_list->FilterOptions->visible()) { ?>
<?php $vwguidepicking_list->FilterOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php
$vwguidepicking_list->renderOtherOptions();
?>
<?php if ($Security->CanSearch()) { ?>
<?php if (!$vwguidepicking->isExport() && !$vwguidepicking->CurrentAction) { ?>
<form name="fvwguidepickinglistsrch" id="fvwguidepickinglistsrch" class="form-inline ew-form ew-ext-search-form" action="<?php echo CurrentPageName() ?>">
<?php $searchPanelClass = ($vwguidepicking_list->SearchWhere <> "") ? " show" : " show"; ?>
<div id="fvwguidepickinglistsrch-search-panel" class="ew-search-panel collapse<?php echo $searchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="vwguidepicking">
	<div class="ew-basic-search">
<div id="xsr_1" class="ew-row d-sm-flex">
	<div class="ew-quick-search input-group">
		<input type="text" name="<?php echo TABLE_BASIC_SEARCH ?>" id="<?php echo TABLE_BASIC_SEARCH ?>" class="form-control" value="<?php echo HtmlEncode($vwguidepicking_list->BasicSearch->getKeyword()) ?>" placeholder="<?php echo HtmlEncode($Language->phrase("Search")) ?>">
		<input type="hidden" name="<?php echo TABLE_BASIC_SEARCH_TYPE ?>" id="<?php echo TABLE_BASIC_SEARCH_TYPE ?>" value="<?php echo HtmlEncode($vwguidepicking_list->BasicSearch->getType()) ?>">
		<div class="input-group-append">
			<button class="btn btn-primary" name="btn-submit" id="btn-submit" type="submit"><?php echo $Language->phrase("SearchBtn") ?></button>
			<button type="button" data-toggle="dropdown" class="btn btn-primary dropdown-toggle dropdown-toggle-split" aria-haspopup="true" aria-expanded="false"><span id="searchtype"><?php echo $vwguidepicking_list->BasicSearch->getTypeNameShort() ?></span></button>
			<div class="dropdown-menu dropdown-menu-right">
				<a class="dropdown-item<?php if ($vwguidepicking_list->BasicSearch->getType() == "") echo " active"; ?>" href="javascript:void(0);" onclick="ew.setSearchType(this)"><?php echo $Language->phrase("QuickSearchAuto") ?></a>
				<a class="dropdown-item<?php if ($vwguidepicking_list->BasicSearch->getType() == "=") echo " active"; ?>" href="javascript:void(0);" onclick="ew.setSearchType(this,'=')"><?php echo $Language->phrase("QuickSearchExact") ?></a>
				<a class="dropdown-item<?php if ($vwguidepicking_list->BasicSearch->getType() == "AND") echo " active"; ?>" href="javascript:void(0);" onclick="ew.setSearchType(this,'AND')"><?php echo $Language->phrase("QuickSearchAll") ?></a>
				<a class="dropdown-item<?php if ($vwguidepicking_list->BasicSearch->getType() == "OR") echo " active"; ?>" href="javascript:void(0);" onclick="ew.setSearchType(this,'OR')"><?php echo $Language->phrase("QuickSearchAny") ?></a>
			</div>
		</div>
	</div>
</div>
	</div>
</div>
</form>
<?php } ?>
<?php } ?>
<?php $vwguidepicking_list->showPageHeader(); ?>
<?php
$vwguidepicking_list->showMessage();
?>
<?php if ($vwguidepicking_list->TotalRecs > 0 || $vwguidepicking->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($vwguidepicking_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> vwguidepicking">
<?php if (!$vwguidepicking->isExport()) { ?>
<div class="card-header ew-grid-upper-panel">
<?php if (!$vwguidepicking->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php if (!isset($vwguidepicking_list->Pager)) $vwguidepicking_list->Pager = new PrevNextPager($vwguidepicking_list->StartRec, $vwguidepicking_list->DisplayRecs, $vwguidepicking_list->TotalRecs, $vwguidepicking_list->AutoHidePager) ?>
<?php if ($vwguidepicking_list->Pager->RecordCount > 0 && $vwguidepicking_list->Pager->Visible) { ?>
<div class="ew-pager">
<span><?php echo $Language->Phrase("Page") ?>&nbsp;</span>
<div class="ew-prev-next"><div class="input-group input-group-sm">
<div class="input-group-prepend">
<!-- first page button -->
	<?php if ($vwguidepicking_list->Pager->FirstButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerFirst") ?>" href="<?php echo $vwguidepicking_list->pageUrl() ?>start=<?php echo $vwguidepicking_list->Pager->FirstButton->Start ?>"><i class="icon-first ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerFirst") ?>"><i class="icon-first ew-icon"></i></a>
	<?php } ?>
<!-- previous page button -->
	<?php if ($vwguidepicking_list->Pager->PrevButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerPrevious") ?>" href="<?php echo $vwguidepicking_list->pageUrl() ?>start=<?php echo $vwguidepicking_list->Pager->PrevButton->Start ?>"><i class="icon-prev ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerPrevious") ?>"><i class="icon-prev ew-icon"></i></a>
	<?php } ?>
</div>
<!-- current page number -->
	<input class="form-control" type="text" name="<?php echo TABLE_PAGE_NO ?>" value="<?php echo $vwguidepicking_list->Pager->CurrentPage ?>">
<div class="input-group-append">
<!-- next page button -->
	<?php if ($vwguidepicking_list->Pager->NextButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerNext") ?>" href="<?php echo $vwguidepicking_list->pageUrl() ?>start=<?php echo $vwguidepicking_list->Pager->NextButton->Start ?>"><i class="icon-next ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerNext") ?>"><i class="icon-next ew-icon"></i></a>
	<?php } ?>
<!-- last page button -->
	<?php if ($vwguidepicking_list->Pager->LastButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerLast") ?>" href="<?php echo $vwguidepicking_list->pageUrl() ?>start=<?php echo $vwguidepicking_list->Pager->LastButton->Start ?>"><i class="icon-last ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerLast") ?>"><i class="icon-last ew-icon"></i></a>
	<?php } ?>
</div>
</div>
</div>
<span>&nbsp;<?php echo $Language->Phrase("of") ?>&nbsp;<?php echo $vwguidepicking_list->Pager->PageCount ?></span>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php if ($vwguidepicking_list->Pager->RecordCount > 0) { ?>
<div class="ew-pager ew-rec">
	<span><?php echo $Language->Phrase("Record") ?>&nbsp;<?php echo $vwguidepicking_list->Pager->FromIndex ?>&nbsp;<?php echo $Language->Phrase("To") ?>&nbsp;<?php echo $vwguidepicking_list->Pager->ToIndex ?>&nbsp;<?php echo $Language->Phrase("Of") ?>&nbsp;<?php echo $vwguidepicking_list->Pager->RecordCount ?></span>
</div>
<?php } ?>
<?php if ($vwguidepicking_list->TotalRecs > 0 && (!$vwguidepicking_list->AutoHidePageSizeSelector || $vwguidepicking_list->Pager->Visible)) { ?>
<div class="ew-pager">
<input type="hidden" name="t" value="vwguidepicking">
<select name="<?php echo TABLE_REC_PER_PAGE ?>" class="form-control form-control-sm ew-tooltip" title="<?php echo $Language->phrase("RecordsPerPage") ?>" onchange="this.form.submit();">
<option value="20"<?php if ($vwguidepicking_list->DisplayRecs == 20) { ?> selected<?php } ?>>20</option>
<option value="50"<?php if ($vwguidepicking_list->DisplayRecs == 50) { ?> selected<?php } ?>>50</option>
<option value="100"<?php if ($vwguidepicking_list->DisplayRecs == 100) { ?> selected<?php } ?>>100</option>
<option value="200"<?php if ($vwguidepicking_list->DisplayRecs == 200) { ?> selected<?php } ?>>200</option>
<option value="500"<?php if ($vwguidepicking_list->DisplayRecs == 500) { ?> selected<?php } ?>>500</option>
<option value="ALL"<?php if ($vwguidepicking->getRecordsPerPage() == -1) { ?> selected<?php } ?>><?php echo $Language->Phrase("AllRecords") ?></option>
</select>
</div>
<?php } ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $vwguidepicking_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
<form name="fvwguidepickinglist" id="fvwguidepickinglist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($vwguidepicking_list->CheckToken) { ?>
<input type="hidden" name="<?php echo TOKEN_NAME ?>" value="<?php echo $vwguidepicking_list->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="vwguidepicking">
<input type="hidden" name="exporttype" id="exporttype" value="">
<div id="gmp_vwguidepicking" class="<?php if (IsResponsiveLayout()) { ?>table-responsive <?php } ?>card-body ew-grid-middle-panel">
<?php if ($vwguidepicking_list->TotalRecs > 0 || $vwguidepicking->isGridEdit()) { ?>
<table id="tbl_vwguidepickinglist" class="table ew-table"><!-- .ew-table ##-->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$vwguidepicking_list->RowType = ROWTYPE_HEADER;

// Render list options
$vwguidepicking_list->renderListOptions();

// Render list options (header, left)
$vwguidepicking_list->ListOptions->render("header", "left");
?>
<?php if ($vwguidepicking->ID_Order->Visible) { // ID_Order ?>
	<?php if ($vwguidepicking->sortUrl($vwguidepicking->ID_Order) == "") { ?>
		<th data-name="ID_Order" class="<?php echo $vwguidepicking->ID_Order->headerCellClass() ?>" style="white-space: nowrap;"><div id="elh_vwguidepicking_ID_Order" class="vwguidepicking_ID_Order"><div class="ew-table-header-caption"><?php echo $vwguidepicking->ID_Order->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="ID_Order" class="<?php echo $vwguidepicking->ID_Order->headerCellClass() ?>" style="white-space: nowrap;"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $vwguidepicking->SortUrl($vwguidepicking->ID_Order) ?>',2);"><div id="elh_vwguidepicking_ID_Order" class="vwguidepicking_ID_Order">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $vwguidepicking->ID_Order->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($vwguidepicking->ID_Order->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($vwguidepicking->ID_Order->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($vwguidepicking->Code->Visible) { // Code ?>
	<?php if ($vwguidepicking->sortUrl($vwguidepicking->Code) == "") { ?>
		<th data-name="Code" class="<?php echo $vwguidepicking->Code->headerCellClass() ?>" style="white-space: nowrap;"><div id="elh_vwguidepicking_Code" class="vwguidepicking_Code"><div class="ew-table-header-caption"><?php echo $vwguidepicking->Code->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Code" class="<?php echo $vwguidepicking->Code->headerCellClass() ?>" style="white-space: nowrap;"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $vwguidepicking->SortUrl($vwguidepicking->Code) ?>',2);"><div id="elh_vwguidepicking_Code" class="vwguidepicking_Code">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $vwguidepicking->Code->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($vwguidepicking->Code->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($vwguidepicking->Code->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($vwguidepicking->ProductName->Visible) { // ProductName ?>
	<?php if ($vwguidepicking->sortUrl($vwguidepicking->ProductName) == "") { ?>
		<th data-name="ProductName" class="<?php echo $vwguidepicking->ProductName->headerCellClass() ?>" style="white-space: nowrap;"><div id="elh_vwguidepicking_ProductName" class="vwguidepicking_ProductName"><div class="ew-table-header-caption"><?php echo $vwguidepicking->ProductName->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="ProductName" class="<?php echo $vwguidepicking->ProductName->headerCellClass() ?>" style="white-space: nowrap;"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $vwguidepicking->SortUrl($vwguidepicking->ProductName) ?>',2);"><div id="elh_vwguidepicking_ProductName" class="vwguidepicking_ProductName">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $vwguidepicking->ProductName->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($vwguidepicking->ProductName->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($vwguidepicking->ProductName->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($vwguidepicking->PalletID->Visible) { // PalletID ?>
	<?php if ($vwguidepicking->sortUrl($vwguidepicking->PalletID) == "") { ?>
		<th data-name="PalletID" class="<?php echo $vwguidepicking->PalletID->headerCellClass() ?>" style="white-space: nowrap;"><div id="elh_vwguidepicking_PalletID" class="vwguidepicking_PalletID"><div class="ew-table-header-caption"><?php echo $vwguidepicking->PalletID->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="PalletID" class="<?php echo $vwguidepicking->PalletID->headerCellClass() ?>" style="white-space: nowrap;"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $vwguidepicking->SortUrl($vwguidepicking->PalletID) ?>',2);"><div id="elh_vwguidepicking_PalletID" class="vwguidepicking_PalletID">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $vwguidepicking->PalletID->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($vwguidepicking->PalletID->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($vwguidepicking->PalletID->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($vwguidepicking->PCS_In->Visible) { // PCS_In ?>
	<?php if ($vwguidepicking->sortUrl($vwguidepicking->PCS_In) == "") { ?>
		<th data-name="PCS_In" class="<?php echo $vwguidepicking->PCS_In->headerCellClass() ?>" style="white-space: nowrap;"><div id="elh_vwguidepicking_PCS_In" class="vwguidepicking_PCS_In"><div class="ew-table-header-caption"><?php echo $vwguidepicking->PCS_In->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="PCS_In" class="<?php echo $vwguidepicking->PCS_In->headerCellClass() ?>" style="white-space: nowrap;"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $vwguidepicking->SortUrl($vwguidepicking->PCS_In) ?>',2);"><div id="elh_vwguidepicking_PCS_In" class="vwguidepicking_PCS_In">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $vwguidepicking->PCS_In->caption() ?></span><span class="ew-table-header-sort"><?php if ($vwguidepicking->PCS_In->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($vwguidepicking->PCS_In->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($vwguidepicking->PCS->Visible) { // PCS ?>
	<?php if ($vwguidepicking->sortUrl($vwguidepicking->PCS) == "") { ?>
		<th data-name="PCS" class="<?php echo $vwguidepicking->PCS->headerCellClass() ?>" style="white-space: nowrap;"><div id="elh_vwguidepicking_PCS" class="vwguidepicking_PCS"><div class="ew-table-header-caption"><?php echo $vwguidepicking->PCS->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="PCS" class="<?php echo $vwguidepicking->PCS->headerCellClass() ?>" style="white-space: nowrap;"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $vwguidepicking->SortUrl($vwguidepicking->PCS) ?>',2);"><div id="elh_vwguidepicking_PCS" class="vwguidepicking_PCS">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $vwguidepicking->PCS->caption() ?></span><span class="ew-table-header-sort"><?php if ($vwguidepicking->PCS->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($vwguidepicking->PCS->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($vwguidepicking->ID_Location->Visible) { // ID_Location ?>
	<?php if ($vwguidepicking->sortUrl($vwguidepicking->ID_Location) == "") { ?>
		<th data-name="ID_Location" class="<?php echo $vwguidepicking->ID_Location->headerCellClass() ?>" style="white-space: nowrap;"><div id="elh_vwguidepicking_ID_Location" class="vwguidepicking_ID_Location"><div class="ew-table-header-caption"><?php echo $vwguidepicking->ID_Location->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="ID_Location" class="<?php echo $vwguidepicking->ID_Location->headerCellClass() ?>" style="white-space: nowrap;"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $vwguidepicking->SortUrl($vwguidepicking->ID_Location) ?>',2);"><div id="elh_vwguidepicking_ID_Location" class="vwguidepicking_ID_Location">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $vwguidepicking->ID_Location->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($vwguidepicking->ID_Location->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($vwguidepicking->ID_Location->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($vwguidepicking->DateIn->Visible) { // DateIn ?>
	<?php if ($vwguidepicking->sortUrl($vwguidepicking->DateIn) == "") { ?>
		<th data-name="DateIn" class="<?php echo $vwguidepicking->DateIn->headerCellClass() ?>" style="white-space: nowrap;"><div id="elh_vwguidepicking_DateIn" class="vwguidepicking_DateIn"><div class="ew-table-header-caption"><?php echo $vwguidepicking->DateIn->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="DateIn" class="<?php echo $vwguidepicking->DateIn->headerCellClass() ?>" style="white-space: nowrap;"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $vwguidepicking->SortUrl($vwguidepicking->DateIn) ?>',2);"><div id="elh_vwguidepicking_DateIn" class="vwguidepicking_DateIn">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $vwguidepicking->DateIn->caption() ?></span><span class="ew-table-header-sort"><?php if ($vwguidepicking->DateIn->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($vwguidepicking->DateIn->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$vwguidepicking_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
if ($vwguidepicking->ExportAll && $vwguidepicking->isExport()) {
	$vwguidepicking_list->StopRec = $vwguidepicking_list->TotalRecs;
} else {

	// Set the last record to display
	if ($vwguidepicking_list->TotalRecs > $vwguidepicking_list->StartRec + $vwguidepicking_list->DisplayRecs - 1)
		$vwguidepicking_list->StopRec = $vwguidepicking_list->StartRec + $vwguidepicking_list->DisplayRecs - 1;
	else
		$vwguidepicking_list->StopRec = $vwguidepicking_list->TotalRecs;
}
$vwguidepicking_list->RecCnt = $vwguidepicking_list->StartRec - 1;
if ($vwguidepicking_list->Recordset && !$vwguidepicking_list->Recordset->EOF) {
	$vwguidepicking_list->Recordset->moveFirst();
	$selectLimit = $vwguidepicking_list->UseSelectLimit;
	if (!$selectLimit && $vwguidepicking_list->StartRec > 1)
		$vwguidepicking_list->Recordset->move($vwguidepicking_list->StartRec - 1);
} elseif (!$vwguidepicking->AllowAddDeleteRow && $vwguidepicking_list->StopRec == 0) {
	$vwguidepicking_list->StopRec = $vwguidepicking->GridAddRowCount;
}

// Initialize aggregate
$vwguidepicking->RowType = ROWTYPE_AGGREGATEINIT;
$vwguidepicking->resetAttributes();
$vwguidepicking_list->renderRow();
while ($vwguidepicking_list->RecCnt < $vwguidepicking_list->StopRec) {
	$vwguidepicking_list->RecCnt++;
	if ($vwguidepicking_list->RecCnt >= $vwguidepicking_list->StartRec) {
		$vwguidepicking_list->RowCnt++;

		// Set up key count
		$vwguidepicking_list->KeyCount = $vwguidepicking_list->RowIndex;

		// Init row class and style
		$vwguidepicking->resetAttributes();
		$vwguidepicking->CssClass = "";
		if ($vwguidepicking->isGridAdd()) {
		} else {
			$vwguidepicking_list->loadRowValues($vwguidepicking_list->Recordset); // Load row values
		}
		$vwguidepicking->RowType = ROWTYPE_VIEW; // Render view

		// Set up row id / data-rowindex
		$vwguidepicking->RowAttrs = array_merge($vwguidepicking->RowAttrs, array('data-rowindex'=>$vwguidepicking_list->RowCnt, 'id'=>'r' . $vwguidepicking_list->RowCnt . '_vwguidepicking', 'data-rowtype'=>$vwguidepicking->RowType));

		// Render row
		$vwguidepicking_list->renderRow();

		// Render list options
		$vwguidepicking_list->renderListOptions();
?>
	<tr<?php echo $vwguidepicking->rowAttributes() ?>>
<?php

// Render list options (body, left)
$vwguidepicking_list->ListOptions->render("body", "left", $vwguidepicking_list->RowCnt);
?>
	<?php if ($vwguidepicking->ID_Order->Visible) { // ID_Order ?>
		<td data-name="ID_Order"<?php echo $vwguidepicking->ID_Order->cellAttributes() ?>>
<span id="el<?php echo $vwguidepicking_list->RowCnt ?>_vwguidepicking_ID_Order" class="vwguidepicking_ID_Order">
<span<?php echo $vwguidepicking->ID_Order->viewAttributes() ?>>
<?php echo $vwguidepicking->ID_Order->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($vwguidepicking->Code->Visible) { // Code ?>
		<td data-name="Code"<?php echo $vwguidepicking->Code->cellAttributes() ?>>
<span id="el<?php echo $vwguidepicking_list->RowCnt ?>_vwguidepicking_Code" class="vwguidepicking_Code">
<span<?php echo $vwguidepicking->Code->viewAttributes() ?>>
<?php echo $vwguidepicking->Code->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($vwguidepicking->ProductName->Visible) { // ProductName ?>
		<td data-name="ProductName"<?php echo $vwguidepicking->ProductName->cellAttributes() ?>>
<span id="el<?php echo $vwguidepicking_list->RowCnt ?>_vwguidepicking_ProductName" class="vwguidepicking_ProductName">
<span<?php echo $vwguidepicking->ProductName->viewAttributes() ?>>
<?php echo $vwguidepicking->ProductName->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($vwguidepicking->PalletID->Visible) { // PalletID ?>
		<td data-name="PalletID"<?php echo $vwguidepicking->PalletID->cellAttributes() ?>>
<span id="el<?php echo $vwguidepicking_list->RowCnt ?>_vwguidepicking_PalletID" class="vwguidepicking_PalletID">
<span<?php echo $vwguidepicking->PalletID->viewAttributes() ?>>
<?php echo $vwguidepicking->PalletID->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($vwguidepicking->PCS_In->Visible) { // PCS_In ?>
		<td data-name="PCS_In"<?php echo $vwguidepicking->PCS_In->cellAttributes() ?>>
<span id="el<?php echo $vwguidepicking_list->RowCnt ?>_vwguidepicking_PCS_In" class="vwguidepicking_PCS_In">
<span<?php echo $vwguidepicking->PCS_In->viewAttributes() ?>>
<?php echo $vwguidepicking->PCS_In->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($vwguidepicking->PCS->Visible) { // PCS ?>
		<td data-name="PCS"<?php echo $vwguidepicking->PCS->cellAttributes() ?>>
<span id="el<?php echo $vwguidepicking_list->RowCnt ?>_vwguidepicking_PCS" class="vwguidepicking_PCS">
<span<?php echo $vwguidepicking->PCS->viewAttributes() ?>>
<?php echo $vwguidepicking->PCS->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($vwguidepicking->ID_Location->Visible) { // ID_Location ?>
		<td data-name="ID_Location"<?php echo $vwguidepicking->ID_Location->cellAttributes() ?>>
<span id="el<?php echo $vwguidepicking_list->RowCnt ?>_vwguidepicking_ID_Location" class="vwguidepicking_ID_Location">
<span<?php echo $vwguidepicking->ID_Location->viewAttributes() ?>>
<?php echo $vwguidepicking->ID_Location->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($vwguidepicking->DateIn->Visible) { // DateIn ?>
		<td data-name="DateIn"<?php echo $vwguidepicking->DateIn->cellAttributes() ?>>
<span id="el<?php echo $vwguidepicking_list->RowCnt ?>_vwguidepicking_DateIn" class="vwguidepicking_DateIn">
<span<?php echo $vwguidepicking->DateIn->viewAttributes() ?>>
<?php echo $vwguidepicking->DateIn->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$vwguidepicking_list->ListOptions->render("body", "right", $vwguidepicking_list->RowCnt);
?>
	</tr>
<?php
	}
	if (!$vwguidepicking->isGridAdd())
		$vwguidepicking_list->Recordset->moveNext();
}
?>
</tbody>
</table><!-- /.ew-table -->
<?php } ?>
<?php if (!$vwguidepicking->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</div><!-- /.ew-grid-middle-panel -->
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($vwguidepicking_list->Recordset)
	$vwguidepicking_list->Recordset->Close();
?>
<?php if (!$vwguidepicking->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$vwguidepicking->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php if (!isset($vwguidepicking_list->Pager)) $vwguidepicking_list->Pager = new PrevNextPager($vwguidepicking_list->StartRec, $vwguidepicking_list->DisplayRecs, $vwguidepicking_list->TotalRecs, $vwguidepicking_list->AutoHidePager) ?>
<?php if ($vwguidepicking_list->Pager->RecordCount > 0 && $vwguidepicking_list->Pager->Visible) { ?>
<div class="ew-pager">
<span><?php echo $Language->Phrase("Page") ?>&nbsp;</span>
<div class="ew-prev-next"><div class="input-group input-group-sm">
<div class="input-group-prepend">
<!-- first page button -->
	<?php if ($vwguidepicking_list->Pager->FirstButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerFirst") ?>" href="<?php echo $vwguidepicking_list->pageUrl() ?>start=<?php echo $vwguidepicking_list->Pager->FirstButton->Start ?>"><i class="icon-first ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerFirst") ?>"><i class="icon-first ew-icon"></i></a>
	<?php } ?>
<!-- previous page button -->
	<?php if ($vwguidepicking_list->Pager->PrevButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerPrevious") ?>" href="<?php echo $vwguidepicking_list->pageUrl() ?>start=<?php echo $vwguidepicking_list->Pager->PrevButton->Start ?>"><i class="icon-prev ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerPrevious") ?>"><i class="icon-prev ew-icon"></i></a>
	<?php } ?>
</div>
<!-- current page number -->
	<input class="form-control" type="text" name="<?php echo TABLE_PAGE_NO ?>" value="<?php echo $vwguidepicking_list->Pager->CurrentPage ?>">
<div class="input-group-append">
<!-- next page button -->
	<?php if ($vwguidepicking_list->Pager->NextButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerNext") ?>" href="<?php echo $vwguidepicking_list->pageUrl() ?>start=<?php echo $vwguidepicking_list->Pager->NextButton->Start ?>"><i class="icon-next ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerNext") ?>"><i class="icon-next ew-icon"></i></a>
	<?php } ?>
<!-- last page button -->
	<?php if ($vwguidepicking_list->Pager->LastButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerLast") ?>" href="<?php echo $vwguidepicking_list->pageUrl() ?>start=<?php echo $vwguidepicking_list->Pager->LastButton->Start ?>"><i class="icon-last ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerLast") ?>"><i class="icon-last ew-icon"></i></a>
	<?php } ?>
</div>
</div>
</div>
<span>&nbsp;<?php echo $Language->Phrase("of") ?>&nbsp;<?php echo $vwguidepicking_list->Pager->PageCount ?></span>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php if ($vwguidepicking_list->Pager->RecordCount > 0) { ?>
<div class="ew-pager ew-rec">
	<span><?php echo $Language->Phrase("Record") ?>&nbsp;<?php echo $vwguidepicking_list->Pager->FromIndex ?>&nbsp;<?php echo $Language->Phrase("To") ?>&nbsp;<?php echo $vwguidepicking_list->Pager->ToIndex ?>&nbsp;<?php echo $Language->Phrase("Of") ?>&nbsp;<?php echo $vwguidepicking_list->Pager->RecordCount ?></span>
</div>
<?php } ?>
<?php if ($vwguidepicking_list->TotalRecs > 0 && (!$vwguidepicking_list->AutoHidePageSizeSelector || $vwguidepicking_list->Pager->Visible)) { ?>
<div class="ew-pager">
<input type="hidden" name="t" value="vwguidepicking">
<select name="<?php echo TABLE_REC_PER_PAGE ?>" class="form-control form-control-sm ew-tooltip" title="<?php echo $Language->phrase("RecordsPerPage") ?>" onchange="this.form.submit();">
<option value="20"<?php if ($vwguidepicking_list->DisplayRecs == 20) { ?> selected<?php } ?>>20</option>
<option value="50"<?php if ($vwguidepicking_list->DisplayRecs == 50) { ?> selected<?php } ?>>50</option>
<option value="100"<?php if ($vwguidepicking_list->DisplayRecs == 100) { ?> selected<?php } ?>>100</option>
<option value="200"<?php if ($vwguidepicking_list->DisplayRecs == 200) { ?> selected<?php } ?>>200</option>
<option value="500"<?php if ($vwguidepicking_list->DisplayRecs == 500) { ?> selected<?php } ?>>500</option>
<option value="ALL"<?php if ($vwguidepicking->getRecordsPerPage() == -1) { ?> selected<?php } ?>><?php echo $Language->Phrase("AllRecords") ?></option>
</select>
</div>
<?php } ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $vwguidepicking_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($vwguidepicking_list->TotalRecs == 0 && !$vwguidepicking->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $vwguidepicking_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$vwguidepicking_list->showPageFooter();
if (DEBUG_ENABLED)
	echo GetDebugMessage();
?>
<?php if (!$vwguidepicking->isExport()) { ?>
<script>

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php } ?>
<?php include_once "footer.php" ?>
<?php
$vwguidepicking_list->terminate();
?>