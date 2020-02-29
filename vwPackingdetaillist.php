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
$vwPackingdetail_list = new vwPackingdetail_list();

// Run the page
$vwPackingdetail_list->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$vwPackingdetail_list->Page_Render();
?>
<?php include_once "header.php" ?>
<?php if (!$vwPackingdetail->isExport()) { ?>
<script>

// Form object
currentPageID = ew.PAGE_ID = "list";
var fvwPackingdetaillist = currentForm = new ew.Form("fvwPackingdetaillist", "list");
fvwPackingdetaillist.formKeyCountName = '<?php echo $vwPackingdetail_list->FormKeyCountName ?>';

// Form_CustomValidate event
fvwPackingdetaillist.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

	// Your custom validation code here, return false if invalid.
	return true;
}

// Use JavaScript validation or not
fvwPackingdetaillist.validateRequired = <?php echo json_encode(CLIENT_VALIDATE) ?>;

// Dynamic selection lists
// Form object for search

var fvwPackingdetaillistsrch = currentSearchForm = new ew.Form("fvwPackingdetaillistsrch");

// Filters
fvwPackingdetaillistsrch.filterList = <?php echo $vwPackingdetail_list->getFilterList() ?>;
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
<?php if (!$vwPackingdetail->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($vwPackingdetail_list->TotalRecs > 0 && $vwPackingdetail_list->ExportOptions->visible()) { ?>
<?php $vwPackingdetail_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($vwPackingdetail_list->ImportOptions->visible()) { ?>
<?php $vwPackingdetail_list->ImportOptions->render("body") ?>
<?php } ?>
<?php if ($vwPackingdetail_list->SearchOptions->visible()) { ?>
<?php $vwPackingdetail_list->SearchOptions->render("body") ?>
<?php } ?>
<?php if ($vwPackingdetail_list->FilterOptions->visible()) { ?>
<?php $vwPackingdetail_list->FilterOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php if (!$vwPackingdetail->isExport() || EXPORT_MASTER_RECORD && $vwPackingdetail->isExport("print")) { ?>
<?php
if ($vwPackingdetail_list->DbMasterFilter <> "" && $vwPackingdetail->getCurrentMasterTable() == "tbl_order") {
	if ($vwPackingdetail_list->MasterRecordExists) {
		include_once "tbl_ordermaster.php";
	}
}
?>
<?php } ?>
<?php
$vwPackingdetail_list->renderOtherOptions();
?>
<?php if ($Security->CanSearch()) { ?>
<?php if (!$vwPackingdetail->isExport() && !$vwPackingdetail->CurrentAction) { ?>
<form name="fvwPackingdetaillistsrch" id="fvwPackingdetaillistsrch" class="form-inline ew-form ew-ext-search-form" action="<?php echo CurrentPageName() ?>">
<?php $searchPanelClass = ($vwPackingdetail_list->SearchWhere <> "") ? " show" : " show"; ?>
<div id="fvwPackingdetaillistsrch-search-panel" class="ew-search-panel collapse<?php echo $searchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="vwPackingdetail">
	<div class="ew-basic-search">
<div id="xsr_1" class="ew-row d-sm-flex">
	<div class="ew-quick-search input-group">
		<input type="text" name="<?php echo TABLE_BASIC_SEARCH ?>" id="<?php echo TABLE_BASIC_SEARCH ?>" class="form-control" value="<?php echo HtmlEncode($vwPackingdetail_list->BasicSearch->getKeyword()) ?>" placeholder="<?php echo HtmlEncode($Language->phrase("Search")) ?>">
		<input type="hidden" name="<?php echo TABLE_BASIC_SEARCH_TYPE ?>" id="<?php echo TABLE_BASIC_SEARCH_TYPE ?>" value="<?php echo HtmlEncode($vwPackingdetail_list->BasicSearch->getType()) ?>">
		<div class="input-group-append">
			<button class="btn btn-primary" name="btn-submit" id="btn-submit" type="submit"><?php echo $Language->phrase("SearchBtn") ?></button>
			<button type="button" data-toggle="dropdown" class="btn btn-primary dropdown-toggle dropdown-toggle-split" aria-haspopup="true" aria-expanded="false"><span id="searchtype"><?php echo $vwPackingdetail_list->BasicSearch->getTypeNameShort() ?></span></button>
			<div class="dropdown-menu dropdown-menu-right">
				<a class="dropdown-item<?php if ($vwPackingdetail_list->BasicSearch->getType() == "") echo " active"; ?>" href="javascript:void(0);" onclick="ew.setSearchType(this)"><?php echo $Language->phrase("QuickSearchAuto") ?></a>
				<a class="dropdown-item<?php if ($vwPackingdetail_list->BasicSearch->getType() == "=") echo " active"; ?>" href="javascript:void(0);" onclick="ew.setSearchType(this,'=')"><?php echo $Language->phrase("QuickSearchExact") ?></a>
				<a class="dropdown-item<?php if ($vwPackingdetail_list->BasicSearch->getType() == "AND") echo " active"; ?>" href="javascript:void(0);" onclick="ew.setSearchType(this,'AND')"><?php echo $Language->phrase("QuickSearchAll") ?></a>
				<a class="dropdown-item<?php if ($vwPackingdetail_list->BasicSearch->getType() == "OR") echo " active"; ?>" href="javascript:void(0);" onclick="ew.setSearchType(this,'OR')"><?php echo $Language->phrase("QuickSearchAny") ?></a>
			</div>
		</div>
	</div>
</div>
	</div>
</div>
</form>
<?php } ?>
<?php } ?>
<?php $vwPackingdetail_list->showPageHeader(); ?>
<?php
$vwPackingdetail_list->showMessage();
?>
<?php if ($vwPackingdetail_list->TotalRecs > 0 || $vwPackingdetail->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($vwPackingdetail_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> vwPackingdetail">
<?php if (!$vwPackingdetail->isExport()) { ?>
<div class="card-header ew-grid-upper-panel">
<?php if (!$vwPackingdetail->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php if (!isset($vwPackingdetail_list->Pager)) $vwPackingdetail_list->Pager = new PrevNextPager($vwPackingdetail_list->StartRec, $vwPackingdetail_list->DisplayRecs, $vwPackingdetail_list->TotalRecs, $vwPackingdetail_list->AutoHidePager) ?>
<?php if ($vwPackingdetail_list->Pager->RecordCount > 0 && $vwPackingdetail_list->Pager->Visible) { ?>
<div class="ew-pager">
<span><?php echo $Language->Phrase("Page") ?>&nbsp;</span>
<div class="ew-prev-next"><div class="input-group input-group-sm">
<div class="input-group-prepend">
<!-- first page button -->
	<?php if ($vwPackingdetail_list->Pager->FirstButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerFirst") ?>" href="<?php echo $vwPackingdetail_list->pageUrl() ?>start=<?php echo $vwPackingdetail_list->Pager->FirstButton->Start ?>"><i class="icon-first ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerFirst") ?>"><i class="icon-first ew-icon"></i></a>
	<?php } ?>
<!-- previous page button -->
	<?php if ($vwPackingdetail_list->Pager->PrevButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerPrevious") ?>" href="<?php echo $vwPackingdetail_list->pageUrl() ?>start=<?php echo $vwPackingdetail_list->Pager->PrevButton->Start ?>"><i class="icon-prev ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerPrevious") ?>"><i class="icon-prev ew-icon"></i></a>
	<?php } ?>
</div>
<!-- current page number -->
	<input class="form-control" type="text" name="<?php echo TABLE_PAGE_NO ?>" value="<?php echo $vwPackingdetail_list->Pager->CurrentPage ?>">
<div class="input-group-append">
<!-- next page button -->
	<?php if ($vwPackingdetail_list->Pager->NextButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerNext") ?>" href="<?php echo $vwPackingdetail_list->pageUrl() ?>start=<?php echo $vwPackingdetail_list->Pager->NextButton->Start ?>"><i class="icon-next ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerNext") ?>"><i class="icon-next ew-icon"></i></a>
	<?php } ?>
<!-- last page button -->
	<?php if ($vwPackingdetail_list->Pager->LastButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerLast") ?>" href="<?php echo $vwPackingdetail_list->pageUrl() ?>start=<?php echo $vwPackingdetail_list->Pager->LastButton->Start ?>"><i class="icon-last ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerLast") ?>"><i class="icon-last ew-icon"></i></a>
	<?php } ?>
</div>
</div>
</div>
<span>&nbsp;<?php echo $Language->Phrase("of") ?>&nbsp;<?php echo $vwPackingdetail_list->Pager->PageCount ?></span>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php if ($vwPackingdetail_list->Pager->RecordCount > 0) { ?>
<div class="ew-pager ew-rec">
	<span><?php echo $Language->Phrase("Record") ?>&nbsp;<?php echo $vwPackingdetail_list->Pager->FromIndex ?>&nbsp;<?php echo $Language->Phrase("To") ?>&nbsp;<?php echo $vwPackingdetail_list->Pager->ToIndex ?>&nbsp;<?php echo $Language->Phrase("Of") ?>&nbsp;<?php echo $vwPackingdetail_list->Pager->RecordCount ?></span>
</div>
<?php } ?>
<?php if ($vwPackingdetail_list->TotalRecs > 0 && (!$vwPackingdetail_list->AutoHidePageSizeSelector || $vwPackingdetail_list->Pager->Visible)) { ?>
<div class="ew-pager">
<input type="hidden" name="t" value="vwPackingdetail">
<select name="<?php echo TABLE_REC_PER_PAGE ?>" class="form-control form-control-sm ew-tooltip" title="<?php echo $Language->phrase("RecordsPerPage") ?>" onchange="this.form.submit();">
<option value="20"<?php if ($vwPackingdetail_list->DisplayRecs == 20) { ?> selected<?php } ?>>20</option>
<option value="50"<?php if ($vwPackingdetail_list->DisplayRecs == 50) { ?> selected<?php } ?>>50</option>
<option value="100"<?php if ($vwPackingdetail_list->DisplayRecs == 100) { ?> selected<?php } ?>>100</option>
<option value="200"<?php if ($vwPackingdetail_list->DisplayRecs == 200) { ?> selected<?php } ?>>200</option>
<option value="500"<?php if ($vwPackingdetail_list->DisplayRecs == 500) { ?> selected<?php } ?>>500</option>
<option value="ALL"<?php if ($vwPackingdetail->getRecordsPerPage() == -1) { ?> selected<?php } ?>><?php echo $Language->Phrase("AllRecords") ?></option>
</select>
</div>
<?php } ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $vwPackingdetail_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
<form name="fvwPackingdetaillist" id="fvwPackingdetaillist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($vwPackingdetail_list->CheckToken) { ?>
<input type="hidden" name="<?php echo TOKEN_NAME ?>" value="<?php echo $vwPackingdetail_list->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="vwPackingdetail">
<input type="hidden" name="exporttype" id="exporttype" value="">
<?php if ($vwPackingdetail->getCurrentMasterTable() == "tbl_order" && $vwPackingdetail->CurrentAction) { ?>
<input type="hidden" name="<?php echo TABLE_SHOW_MASTER ?>" value="tbl_order">
<input type="hidden" name="fk_ID_Order" value="<?php echo $vwPackingdetail->Id_order->getSessionValue() ?>">
<?php } ?>
<div id="gmp_vwPackingdetail" class="<?php if (IsResponsiveLayout()) { ?>table-responsive <?php } ?>card-body ew-grid-middle-panel">
<?php if ($vwPackingdetail_list->TotalRecs > 0 || $vwPackingdetail->isGridEdit()) { ?>
<table id="tbl_vwPackingdetaillist" class="table ew-table"><!-- .ew-table ##-->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$vwPackingdetail_list->RowType = ROWTYPE_HEADER;

// Render list options
$vwPackingdetail_list->renderListOptions();

// Render list options (header, left)
$vwPackingdetail_list->ListOptions->render("header", "left");
?>
<?php if ($vwPackingdetail->Id_packing->Visible) { // Id_packing ?>
	<?php if ($vwPackingdetail->sortUrl($vwPackingdetail->Id_packing) == "") { ?>
		<th data-name="Id_packing" class="<?php echo $vwPackingdetail->Id_packing->headerCellClass() ?>"><div id="elh_vwPackingdetail_Id_packing" class="vwPackingdetail_Id_packing"><div class="ew-table-header-caption"><?php echo $vwPackingdetail->Id_packing->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Id_packing" class="<?php echo $vwPackingdetail->Id_packing->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $vwPackingdetail->SortUrl($vwPackingdetail->Id_packing) ?>',2);"><div id="elh_vwPackingdetail_Id_packing" class="vwPackingdetail_Id_packing">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $vwPackingdetail->Id_packing->caption() ?></span><span class="ew-table-header-sort"><?php if ($vwPackingdetail->Id_packing->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($vwPackingdetail->Id_packing->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($vwPackingdetail->Code->Visible) { // Code ?>
	<?php if ($vwPackingdetail->sortUrl($vwPackingdetail->Code) == "") { ?>
		<th data-name="Code" class="<?php echo $vwPackingdetail->Code->headerCellClass() ?>"><div id="elh_vwPackingdetail_Code" class="vwPackingdetail_Code"><div class="ew-table-header-caption"><?php echo $vwPackingdetail->Code->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Code" class="<?php echo $vwPackingdetail->Code->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $vwPackingdetail->SortUrl($vwPackingdetail->Code) ?>',2);"><div id="elh_vwPackingdetail_Code" class="vwPackingdetail_Code">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $vwPackingdetail->Code->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($vwPackingdetail->Code->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($vwPackingdetail->Code->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($vwPackingdetail->PCS->Visible) { // PCS ?>
	<?php if ($vwPackingdetail->sortUrl($vwPackingdetail->PCS) == "") { ?>
		<th data-name="PCS" class="<?php echo $vwPackingdetail->PCS->headerCellClass() ?>"><div id="elh_vwPackingdetail_PCS" class="vwPackingdetail_PCS"><div class="ew-table-header-caption"><?php echo $vwPackingdetail->PCS->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="PCS" class="<?php echo $vwPackingdetail->PCS->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $vwPackingdetail->SortUrl($vwPackingdetail->PCS) ?>',2);"><div id="elh_vwPackingdetail_PCS" class="vwPackingdetail_PCS">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $vwPackingdetail->PCS->caption() ?></span><span class="ew-table-header-sort"><?php if ($vwPackingdetail->PCS->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($vwPackingdetail->PCS->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($vwPackingdetail->PackingType->Visible) { // PackingType ?>
	<?php if ($vwPackingdetail->sortUrl($vwPackingdetail->PackingType) == "") { ?>
		<th data-name="PackingType" class="<?php echo $vwPackingdetail->PackingType->headerCellClass() ?>"><div id="elh_vwPackingdetail_PackingType" class="vwPackingdetail_PackingType"><div class="ew-table-header-caption"><?php echo $vwPackingdetail->PackingType->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="PackingType" class="<?php echo $vwPackingdetail->PackingType->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $vwPackingdetail->SortUrl($vwPackingdetail->PackingType) ?>',2);"><div id="elh_vwPackingdetail_PackingType" class="vwPackingdetail_PackingType">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $vwPackingdetail->PackingType->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($vwPackingdetail->PackingType->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($vwPackingdetail->PackingType->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($vwPackingdetail->Length->Visible) { // Length ?>
	<?php if ($vwPackingdetail->sortUrl($vwPackingdetail->Length) == "") { ?>
		<th data-name="Length" class="<?php echo $vwPackingdetail->Length->headerCellClass() ?>"><div id="elh_vwPackingdetail_Length" class="vwPackingdetail_Length"><div class="ew-table-header-caption"><?php echo $vwPackingdetail->Length->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Length" class="<?php echo $vwPackingdetail->Length->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $vwPackingdetail->SortUrl($vwPackingdetail->Length) ?>',2);"><div id="elh_vwPackingdetail_Length" class="vwPackingdetail_Length">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $vwPackingdetail->Length->caption() ?></span><span class="ew-table-header-sort"><?php if ($vwPackingdetail->Length->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($vwPackingdetail->Length->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($vwPackingdetail->Width->Visible) { // Width ?>
	<?php if ($vwPackingdetail->sortUrl($vwPackingdetail->Width) == "") { ?>
		<th data-name="Width" class="<?php echo $vwPackingdetail->Width->headerCellClass() ?>"><div id="elh_vwPackingdetail_Width" class="vwPackingdetail_Width"><div class="ew-table-header-caption"><?php echo $vwPackingdetail->Width->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Width" class="<?php echo $vwPackingdetail->Width->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $vwPackingdetail->SortUrl($vwPackingdetail->Width) ?>',2);"><div id="elh_vwPackingdetail_Width" class="vwPackingdetail_Width">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $vwPackingdetail->Width->caption() ?></span><span class="ew-table-header-sort"><?php if ($vwPackingdetail->Width->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($vwPackingdetail->Width->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($vwPackingdetail->Heigth->Visible) { // Heigth ?>
	<?php if ($vwPackingdetail->sortUrl($vwPackingdetail->Heigth) == "") { ?>
		<th data-name="Heigth" class="<?php echo $vwPackingdetail->Heigth->headerCellClass() ?>"><div id="elh_vwPackingdetail_Heigth" class="vwPackingdetail_Heigth"><div class="ew-table-header-caption"><?php echo $vwPackingdetail->Heigth->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Heigth" class="<?php echo $vwPackingdetail->Heigth->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $vwPackingdetail->SortUrl($vwPackingdetail->Heigth) ?>',2);"><div id="elh_vwPackingdetail_Heigth" class="vwPackingdetail_Heigth">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $vwPackingdetail->Heigth->caption() ?></span><span class="ew-table-header-sort"><?php if ($vwPackingdetail->Heigth->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($vwPackingdetail->Heigth->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($vwPackingdetail->finishpacking->Visible) { // finishpacking ?>
	<?php if ($vwPackingdetail->sortUrl($vwPackingdetail->finishpacking) == "") { ?>
		<th data-name="finishpacking" class="<?php echo $vwPackingdetail->finishpacking->headerCellClass() ?>"><div id="elh_vwPackingdetail_finishpacking" class="vwPackingdetail_finishpacking"><div class="ew-table-header-caption"><?php echo $vwPackingdetail->finishpacking->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="finishpacking" class="<?php echo $vwPackingdetail->finishpacking->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $vwPackingdetail->SortUrl($vwPackingdetail->finishpacking) ?>',2);"><div id="elh_vwPackingdetail_finishpacking" class="vwPackingdetail_finishpacking">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $vwPackingdetail->finishpacking->caption() ?></span><span class="ew-table-header-sort"><?php if ($vwPackingdetail->finishpacking->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($vwPackingdetail->finishpacking->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($vwPackingdetail->PE_film_Cover->Visible) { // PE_film_Cover ?>
	<?php if ($vwPackingdetail->sortUrl($vwPackingdetail->PE_film_Cover) == "") { ?>
		<th data-name="PE_film_Cover" class="<?php echo $vwPackingdetail->PE_film_Cover->headerCellClass() ?>"><div id="elh_vwPackingdetail_PE_film_Cover" class="vwPackingdetail_PE_film_Cover"><div class="ew-table-header-caption"><?php echo $vwPackingdetail->PE_film_Cover->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="PE_film_Cover" class="<?php echo $vwPackingdetail->PE_film_Cover->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $vwPackingdetail->SortUrl($vwPackingdetail->PE_film_Cover) ?>',2);"><div id="elh_vwPackingdetail_PE_film_Cover" class="vwPackingdetail_PE_film_Cover">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $vwPackingdetail->PE_film_Cover->caption() ?></span><span class="ew-table-header-sort"><?php if ($vwPackingdetail->PE_film_Cover->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($vwPackingdetail->PE_film_Cover->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($vwPackingdetail->CreateUser->Visible) { // CreateUser ?>
	<?php if ($vwPackingdetail->sortUrl($vwPackingdetail->CreateUser) == "") { ?>
		<th data-name="CreateUser" class="<?php echo $vwPackingdetail->CreateUser->headerCellClass() ?>"><div id="elh_vwPackingdetail_CreateUser" class="vwPackingdetail_CreateUser"><div class="ew-table-header-caption"><?php echo $vwPackingdetail->CreateUser->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="CreateUser" class="<?php echo $vwPackingdetail->CreateUser->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $vwPackingdetail->SortUrl($vwPackingdetail->CreateUser) ?>',2);"><div id="elh_vwPackingdetail_CreateUser" class="vwPackingdetail_CreateUser">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $vwPackingdetail->CreateUser->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($vwPackingdetail->CreateUser->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($vwPackingdetail->CreateUser->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($vwPackingdetail->CreateDate->Visible) { // CreateDate ?>
	<?php if ($vwPackingdetail->sortUrl($vwPackingdetail->CreateDate) == "") { ?>
		<th data-name="CreateDate" class="<?php echo $vwPackingdetail->CreateDate->headerCellClass() ?>"><div id="elh_vwPackingdetail_CreateDate" class="vwPackingdetail_CreateDate"><div class="ew-table-header-caption"><?php echo $vwPackingdetail->CreateDate->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="CreateDate" class="<?php echo $vwPackingdetail->CreateDate->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $vwPackingdetail->SortUrl($vwPackingdetail->CreateDate) ?>',2);"><div id="elh_vwPackingdetail_CreateDate" class="vwPackingdetail_CreateDate">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $vwPackingdetail->CreateDate->caption() ?></span><span class="ew-table-header-sort"><?php if ($vwPackingdetail->CreateDate->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($vwPackingdetail->CreateDate->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($vwPackingdetail->Box->Visible) { // Box ?>
	<?php if ($vwPackingdetail->sortUrl($vwPackingdetail->Box) == "") { ?>
		<th data-name="Box" class="<?php echo $vwPackingdetail->Box->headerCellClass() ?>"><div id="elh_vwPackingdetail_Box" class="vwPackingdetail_Box"><div class="ew-table-header-caption"><?php echo $vwPackingdetail->Box->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Box" class="<?php echo $vwPackingdetail->Box->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $vwPackingdetail->SortUrl($vwPackingdetail->Box) ?>',2);"><div id="elh_vwPackingdetail_Box" class="vwPackingdetail_Box">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $vwPackingdetail->Box->caption() ?></span><span class="ew-table-header-sort"><?php if ($vwPackingdetail->Box->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($vwPackingdetail->Box->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$vwPackingdetail_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
if ($vwPackingdetail->ExportAll && $vwPackingdetail->isExport()) {
	$vwPackingdetail_list->StopRec = $vwPackingdetail_list->TotalRecs;
} else {

	// Set the last record to display
	if ($vwPackingdetail_list->TotalRecs > $vwPackingdetail_list->StartRec + $vwPackingdetail_list->DisplayRecs - 1)
		$vwPackingdetail_list->StopRec = $vwPackingdetail_list->StartRec + $vwPackingdetail_list->DisplayRecs - 1;
	else
		$vwPackingdetail_list->StopRec = $vwPackingdetail_list->TotalRecs;
}
$vwPackingdetail_list->RecCnt = $vwPackingdetail_list->StartRec - 1;
if ($vwPackingdetail_list->Recordset && !$vwPackingdetail_list->Recordset->EOF) {
	$vwPackingdetail_list->Recordset->moveFirst();
	$selectLimit = $vwPackingdetail_list->UseSelectLimit;
	if (!$selectLimit && $vwPackingdetail_list->StartRec > 1)
		$vwPackingdetail_list->Recordset->move($vwPackingdetail_list->StartRec - 1);
} elseif (!$vwPackingdetail->AllowAddDeleteRow && $vwPackingdetail_list->StopRec == 0) {
	$vwPackingdetail_list->StopRec = $vwPackingdetail->GridAddRowCount;
}

// Initialize aggregate
$vwPackingdetail->RowType = ROWTYPE_AGGREGATEINIT;
$vwPackingdetail->resetAttributes();
$vwPackingdetail_list->renderRow();
while ($vwPackingdetail_list->RecCnt < $vwPackingdetail_list->StopRec) {
	$vwPackingdetail_list->RecCnt++;
	if ($vwPackingdetail_list->RecCnt >= $vwPackingdetail_list->StartRec) {
		$vwPackingdetail_list->RowCnt++;

		// Set up key count
		$vwPackingdetail_list->KeyCount = $vwPackingdetail_list->RowIndex;

		// Init row class and style
		$vwPackingdetail->resetAttributes();
		$vwPackingdetail->CssClass = "";
		if ($vwPackingdetail->isGridAdd()) {
		} else {
			$vwPackingdetail_list->loadRowValues($vwPackingdetail_list->Recordset); // Load row values
		}
		$vwPackingdetail->RowType = ROWTYPE_VIEW; // Render view

		// Set up row id / data-rowindex
		$vwPackingdetail->RowAttrs = array_merge($vwPackingdetail->RowAttrs, array('data-rowindex'=>$vwPackingdetail_list->RowCnt, 'id'=>'r' . $vwPackingdetail_list->RowCnt . '_vwPackingdetail', 'data-rowtype'=>$vwPackingdetail->RowType));

		// Render row
		$vwPackingdetail_list->renderRow();

		// Render list options
		$vwPackingdetail_list->renderListOptions();
?>
	<tr<?php echo $vwPackingdetail->rowAttributes() ?>>
<?php

// Render list options (body, left)
$vwPackingdetail_list->ListOptions->render("body", "left", $vwPackingdetail_list->RowCnt);
?>
	<?php if ($vwPackingdetail->Id_packing->Visible) { // Id_packing ?>
		<td data-name="Id_packing"<?php echo $vwPackingdetail->Id_packing->cellAttributes() ?>>
<span id="el<?php echo $vwPackingdetail_list->RowCnt ?>_vwPackingdetail_Id_packing" class="vwPackingdetail_Id_packing">
<span<?php echo $vwPackingdetail->Id_packing->viewAttributes() ?>>
<?php echo $vwPackingdetail->Id_packing->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($vwPackingdetail->Code->Visible) { // Code ?>
		<td data-name="Code"<?php echo $vwPackingdetail->Code->cellAttributes() ?>>
<span id="el<?php echo $vwPackingdetail_list->RowCnt ?>_vwPackingdetail_Code" class="vwPackingdetail_Code">
<span<?php echo $vwPackingdetail->Code->viewAttributes() ?>>
<?php echo $vwPackingdetail->Code->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($vwPackingdetail->PCS->Visible) { // PCS ?>
		<td data-name="PCS"<?php echo $vwPackingdetail->PCS->cellAttributes() ?>>
<span id="el<?php echo $vwPackingdetail_list->RowCnt ?>_vwPackingdetail_PCS" class="vwPackingdetail_PCS">
<span<?php echo $vwPackingdetail->PCS->viewAttributes() ?>>
<?php echo $vwPackingdetail->PCS->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($vwPackingdetail->PackingType->Visible) { // PackingType ?>
		<td data-name="PackingType"<?php echo $vwPackingdetail->PackingType->cellAttributes() ?>>
<span id="el<?php echo $vwPackingdetail_list->RowCnt ?>_vwPackingdetail_PackingType" class="vwPackingdetail_PackingType">
<span<?php echo $vwPackingdetail->PackingType->viewAttributes() ?>>
<?php echo $vwPackingdetail->PackingType->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($vwPackingdetail->Length->Visible) { // Length ?>
		<td data-name="Length"<?php echo $vwPackingdetail->Length->cellAttributes() ?>>
<span id="el<?php echo $vwPackingdetail_list->RowCnt ?>_vwPackingdetail_Length" class="vwPackingdetail_Length">
<span<?php echo $vwPackingdetail->Length->viewAttributes() ?>>
<?php echo $vwPackingdetail->Length->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($vwPackingdetail->Width->Visible) { // Width ?>
		<td data-name="Width"<?php echo $vwPackingdetail->Width->cellAttributes() ?>>
<span id="el<?php echo $vwPackingdetail_list->RowCnt ?>_vwPackingdetail_Width" class="vwPackingdetail_Width">
<span<?php echo $vwPackingdetail->Width->viewAttributes() ?>>
<?php echo $vwPackingdetail->Width->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($vwPackingdetail->Heigth->Visible) { // Heigth ?>
		<td data-name="Heigth"<?php echo $vwPackingdetail->Heigth->cellAttributes() ?>>
<span id="el<?php echo $vwPackingdetail_list->RowCnt ?>_vwPackingdetail_Heigth" class="vwPackingdetail_Heigth">
<span<?php echo $vwPackingdetail->Heigth->viewAttributes() ?>>
<?php echo $vwPackingdetail->Heigth->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($vwPackingdetail->finishpacking->Visible) { // finishpacking ?>
		<td data-name="finishpacking"<?php echo $vwPackingdetail->finishpacking->cellAttributes() ?>>
<span id="el<?php echo $vwPackingdetail_list->RowCnt ?>_vwPackingdetail_finishpacking" class="vwPackingdetail_finishpacking">
<span<?php echo $vwPackingdetail->finishpacking->viewAttributes() ?>>
<?php echo $vwPackingdetail->finishpacking->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($vwPackingdetail->PE_film_Cover->Visible) { // PE_film_Cover ?>
		<td data-name="PE_film_Cover"<?php echo $vwPackingdetail->PE_film_Cover->cellAttributes() ?>>
<span id="el<?php echo $vwPackingdetail_list->RowCnt ?>_vwPackingdetail_PE_film_Cover" class="vwPackingdetail_PE_film_Cover">
<span<?php echo $vwPackingdetail->PE_film_Cover->viewAttributes() ?>>
<?php echo $vwPackingdetail->PE_film_Cover->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($vwPackingdetail->CreateUser->Visible) { // CreateUser ?>
		<td data-name="CreateUser"<?php echo $vwPackingdetail->CreateUser->cellAttributes() ?>>
<span id="el<?php echo $vwPackingdetail_list->RowCnt ?>_vwPackingdetail_CreateUser" class="vwPackingdetail_CreateUser">
<span<?php echo $vwPackingdetail->CreateUser->viewAttributes() ?>>
<?php echo $vwPackingdetail->CreateUser->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($vwPackingdetail->CreateDate->Visible) { // CreateDate ?>
		<td data-name="CreateDate"<?php echo $vwPackingdetail->CreateDate->cellAttributes() ?>>
<span id="el<?php echo $vwPackingdetail_list->RowCnt ?>_vwPackingdetail_CreateDate" class="vwPackingdetail_CreateDate">
<span<?php echo $vwPackingdetail->CreateDate->viewAttributes() ?>>
<?php echo $vwPackingdetail->CreateDate->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($vwPackingdetail->Box->Visible) { // Box ?>
		<td data-name="Box"<?php echo $vwPackingdetail->Box->cellAttributes() ?>>
<span id="el<?php echo $vwPackingdetail_list->RowCnt ?>_vwPackingdetail_Box" class="vwPackingdetail_Box">
<span<?php echo $vwPackingdetail->Box->viewAttributes() ?>>
<?php echo $vwPackingdetail->Box->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$vwPackingdetail_list->ListOptions->render("body", "right", $vwPackingdetail_list->RowCnt);
?>
	</tr>
<?php
	}
	if (!$vwPackingdetail->isGridAdd())
		$vwPackingdetail_list->Recordset->moveNext();
}
?>
</tbody>
</table><!-- /.ew-table -->
<?php } ?>
<?php if (!$vwPackingdetail->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</div><!-- /.ew-grid-middle-panel -->
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($vwPackingdetail_list->Recordset)
	$vwPackingdetail_list->Recordset->Close();
?>
<?php if (!$vwPackingdetail->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$vwPackingdetail->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php if (!isset($vwPackingdetail_list->Pager)) $vwPackingdetail_list->Pager = new PrevNextPager($vwPackingdetail_list->StartRec, $vwPackingdetail_list->DisplayRecs, $vwPackingdetail_list->TotalRecs, $vwPackingdetail_list->AutoHidePager) ?>
<?php if ($vwPackingdetail_list->Pager->RecordCount > 0 && $vwPackingdetail_list->Pager->Visible) { ?>
<div class="ew-pager">
<span><?php echo $Language->Phrase("Page") ?>&nbsp;</span>
<div class="ew-prev-next"><div class="input-group input-group-sm">
<div class="input-group-prepend">
<!-- first page button -->
	<?php if ($vwPackingdetail_list->Pager->FirstButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerFirst") ?>" href="<?php echo $vwPackingdetail_list->pageUrl() ?>start=<?php echo $vwPackingdetail_list->Pager->FirstButton->Start ?>"><i class="icon-first ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerFirst") ?>"><i class="icon-first ew-icon"></i></a>
	<?php } ?>
<!-- previous page button -->
	<?php if ($vwPackingdetail_list->Pager->PrevButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerPrevious") ?>" href="<?php echo $vwPackingdetail_list->pageUrl() ?>start=<?php echo $vwPackingdetail_list->Pager->PrevButton->Start ?>"><i class="icon-prev ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerPrevious") ?>"><i class="icon-prev ew-icon"></i></a>
	<?php } ?>
</div>
<!-- current page number -->
	<input class="form-control" type="text" name="<?php echo TABLE_PAGE_NO ?>" value="<?php echo $vwPackingdetail_list->Pager->CurrentPage ?>">
<div class="input-group-append">
<!-- next page button -->
	<?php if ($vwPackingdetail_list->Pager->NextButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerNext") ?>" href="<?php echo $vwPackingdetail_list->pageUrl() ?>start=<?php echo $vwPackingdetail_list->Pager->NextButton->Start ?>"><i class="icon-next ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerNext") ?>"><i class="icon-next ew-icon"></i></a>
	<?php } ?>
<!-- last page button -->
	<?php if ($vwPackingdetail_list->Pager->LastButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerLast") ?>" href="<?php echo $vwPackingdetail_list->pageUrl() ?>start=<?php echo $vwPackingdetail_list->Pager->LastButton->Start ?>"><i class="icon-last ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerLast") ?>"><i class="icon-last ew-icon"></i></a>
	<?php } ?>
</div>
</div>
</div>
<span>&nbsp;<?php echo $Language->Phrase("of") ?>&nbsp;<?php echo $vwPackingdetail_list->Pager->PageCount ?></span>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php if ($vwPackingdetail_list->Pager->RecordCount > 0) { ?>
<div class="ew-pager ew-rec">
	<span><?php echo $Language->Phrase("Record") ?>&nbsp;<?php echo $vwPackingdetail_list->Pager->FromIndex ?>&nbsp;<?php echo $Language->Phrase("To") ?>&nbsp;<?php echo $vwPackingdetail_list->Pager->ToIndex ?>&nbsp;<?php echo $Language->Phrase("Of") ?>&nbsp;<?php echo $vwPackingdetail_list->Pager->RecordCount ?></span>
</div>
<?php } ?>
<?php if ($vwPackingdetail_list->TotalRecs > 0 && (!$vwPackingdetail_list->AutoHidePageSizeSelector || $vwPackingdetail_list->Pager->Visible)) { ?>
<div class="ew-pager">
<input type="hidden" name="t" value="vwPackingdetail">
<select name="<?php echo TABLE_REC_PER_PAGE ?>" class="form-control form-control-sm ew-tooltip" title="<?php echo $Language->phrase("RecordsPerPage") ?>" onchange="this.form.submit();">
<option value="20"<?php if ($vwPackingdetail_list->DisplayRecs == 20) { ?> selected<?php } ?>>20</option>
<option value="50"<?php if ($vwPackingdetail_list->DisplayRecs == 50) { ?> selected<?php } ?>>50</option>
<option value="100"<?php if ($vwPackingdetail_list->DisplayRecs == 100) { ?> selected<?php } ?>>100</option>
<option value="200"<?php if ($vwPackingdetail_list->DisplayRecs == 200) { ?> selected<?php } ?>>200</option>
<option value="500"<?php if ($vwPackingdetail_list->DisplayRecs == 500) { ?> selected<?php } ?>>500</option>
<option value="ALL"<?php if ($vwPackingdetail->getRecordsPerPage() == -1) { ?> selected<?php } ?>><?php echo $Language->Phrase("AllRecords") ?></option>
</select>
</div>
<?php } ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $vwPackingdetail_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($vwPackingdetail_list->TotalRecs == 0 && !$vwPackingdetail->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $vwPackingdetail_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$vwPackingdetail_list->showPageFooter();
if (DEBUG_ENABLED)
	echo GetDebugMessage();
?>
<?php if (!$vwPackingdetail->isExport()) { ?>
<script>

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php } ?>
<?php include_once "footer.php" ?>
<?php
$vwPackingdetail_list->terminate();
?>