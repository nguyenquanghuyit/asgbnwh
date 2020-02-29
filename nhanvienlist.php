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
$nhanvien_list = new nhanvien_list();

// Run the page
$nhanvien_list->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$nhanvien_list->Page_Render();
?>
<?php include_once "header.php" ?>
<?php if (!$nhanvien->isExport()) { ?>
<script>

// Form object
currentPageID = ew.PAGE_ID = "list";
var fnhanvienlist = currentForm = new ew.Form("fnhanvienlist", "list");
fnhanvienlist.formKeyCountName = '<?php echo $nhanvien_list->FormKeyCountName ?>';

// Form_CustomValidate event
fnhanvienlist.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

	// Your custom validation code here, return false if invalid.
	return true;
}

// Use JavaScript validation or not
fnhanvienlist.validateRequired = <?php echo json_encode(CLIENT_VALIDATE) ?>;

// Dynamic selection lists
fnhanvienlist.lists["x_gioiTinh"] = <?php echo $nhanvien_list->gioiTinh->Lookup->toClientList() ?>;
fnhanvienlist.lists["x_gioiTinh"].options = <?php echo JsonEncode($nhanvien_list->gioiTinh->options(FALSE, TRUE)) ?>;
fnhanvienlist.lists["x_TD_ID"] = <?php echo $nhanvien_list->TD_ID->Lookup->toClientList() ?>;
fnhanvienlist.lists["x_TD_ID"].options = <?php echo JsonEncode($nhanvien_list->TD_ID->lookupOptions()) ?>;
fnhanvienlist.autoSuggests["x_TD_ID"] = <?php echo json_encode(["data" => "ajax=autosuggest"]) ?>;
fnhanvienlist.lists["x_PB_ID"] = <?php echo $nhanvien_list->PB_ID->Lookup->toClientList() ?>;
fnhanvienlist.lists["x_PB_ID"].options = <?php echo JsonEncode($nhanvien_list->PB_ID->lookupOptions()) ?>;
fnhanvienlist.autoSuggests["x_PB_ID"] = <?php echo json_encode(["data" => "ajax=autosuggest"]) ?>;

// Form object for search
var fnhanvienlistsrch = currentSearchForm = new ew.Form("fnhanvienlistsrch");

// Filters
fnhanvienlistsrch.filterList = <?php echo $nhanvien_list->getFilterList() ?>;
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
<?php if (!$nhanvien->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($nhanvien_list->TotalRecs > 0 && $nhanvien_list->ExportOptions->visible()) { ?>
<?php $nhanvien_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($nhanvien_list->ImportOptions->visible()) { ?>
<?php $nhanvien_list->ImportOptions->render("body") ?>
<?php } ?>
<?php if ($nhanvien_list->SearchOptions->visible()) { ?>
<?php $nhanvien_list->SearchOptions->render("body") ?>
<?php } ?>
<?php if ($nhanvien_list->FilterOptions->visible()) { ?>
<?php $nhanvien_list->FilterOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php
$nhanvien_list->renderOtherOptions();
?>
<?php if ($Security->CanSearch()) { ?>
<?php if (!$nhanvien->isExport() && !$nhanvien->CurrentAction) { ?>
<form name="fnhanvienlistsrch" id="fnhanvienlistsrch" class="form-inline ew-form ew-ext-search-form" action="<?php echo CurrentPageName() ?>">
<?php $searchPanelClass = ($nhanvien_list->SearchWhere <> "") ? " show" : " show"; ?>
<div id="fnhanvienlistsrch-search-panel" class="ew-search-panel collapse<?php echo $searchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="nhanvien">
	<div class="ew-basic-search">
<div id="xsr_1" class="ew-row d-sm-flex">
	<div class="ew-quick-search input-group">
		<input type="text" name="<?php echo TABLE_BASIC_SEARCH ?>" id="<?php echo TABLE_BASIC_SEARCH ?>" class="form-control" value="<?php echo HtmlEncode($nhanvien_list->BasicSearch->getKeyword()) ?>" placeholder="<?php echo HtmlEncode($Language->phrase("Search")) ?>">
		<input type="hidden" name="<?php echo TABLE_BASIC_SEARCH_TYPE ?>" id="<?php echo TABLE_BASIC_SEARCH_TYPE ?>" value="<?php echo HtmlEncode($nhanvien_list->BasicSearch->getType()) ?>">
		<div class="input-group-append">
			<button class="btn btn-primary" name="btn-submit" id="btn-submit" type="submit"><?php echo $Language->phrase("SearchBtn") ?></button>
			<button type="button" data-toggle="dropdown" class="btn btn-primary dropdown-toggle dropdown-toggle-split" aria-haspopup="true" aria-expanded="false"><span id="searchtype"><?php echo $nhanvien_list->BasicSearch->getTypeNameShort() ?></span></button>
			<div class="dropdown-menu dropdown-menu-right">
				<a class="dropdown-item<?php if ($nhanvien_list->BasicSearch->getType() == "") echo " active"; ?>" href="javascript:void(0);" onclick="ew.setSearchType(this)"><?php echo $Language->phrase("QuickSearchAuto") ?></a>
				<a class="dropdown-item<?php if ($nhanvien_list->BasicSearch->getType() == "=") echo " active"; ?>" href="javascript:void(0);" onclick="ew.setSearchType(this,'=')"><?php echo $Language->phrase("QuickSearchExact") ?></a>
				<a class="dropdown-item<?php if ($nhanvien_list->BasicSearch->getType() == "AND") echo " active"; ?>" href="javascript:void(0);" onclick="ew.setSearchType(this,'AND')"><?php echo $Language->phrase("QuickSearchAll") ?></a>
				<a class="dropdown-item<?php if ($nhanvien_list->BasicSearch->getType() == "OR") echo " active"; ?>" href="javascript:void(0);" onclick="ew.setSearchType(this,'OR')"><?php echo $Language->phrase("QuickSearchAny") ?></a>
			</div>
		</div>
	</div>
</div>
	</div>
</div>
</form>
<?php } ?>
<?php } ?>
<?php $nhanvien_list->showPageHeader(); ?>
<?php
$nhanvien_list->showMessage();
?>
<?php if ($nhanvien_list->TotalRecs > 0 || $nhanvien->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($nhanvien_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> nhanvien">
<?php if (!$nhanvien->isExport()) { ?>
<div class="card-header ew-grid-upper-panel">
<?php if (!$nhanvien->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php if (!isset($nhanvien_list->Pager)) $nhanvien_list->Pager = new PrevNextPager($nhanvien_list->StartRec, $nhanvien_list->DisplayRecs, $nhanvien_list->TotalRecs, $nhanvien_list->AutoHidePager) ?>
<?php if ($nhanvien_list->Pager->RecordCount > 0 && $nhanvien_list->Pager->Visible) { ?>
<div class="ew-pager">
<span><?php echo $Language->Phrase("Page") ?>&nbsp;</span>
<div class="ew-prev-next"><div class="input-group input-group-sm">
<div class="input-group-prepend">
<!-- first page button -->
	<?php if ($nhanvien_list->Pager->FirstButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerFirst") ?>" href="<?php echo $nhanvien_list->pageUrl() ?>start=<?php echo $nhanvien_list->Pager->FirstButton->Start ?>"><i class="icon-first ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerFirst") ?>"><i class="icon-first ew-icon"></i></a>
	<?php } ?>
<!-- previous page button -->
	<?php if ($nhanvien_list->Pager->PrevButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerPrevious") ?>" href="<?php echo $nhanvien_list->pageUrl() ?>start=<?php echo $nhanvien_list->Pager->PrevButton->Start ?>"><i class="icon-prev ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerPrevious") ?>"><i class="icon-prev ew-icon"></i></a>
	<?php } ?>
</div>
<!-- current page number -->
	<input class="form-control" type="text" name="<?php echo TABLE_PAGE_NO ?>" value="<?php echo $nhanvien_list->Pager->CurrentPage ?>">
<div class="input-group-append">
<!-- next page button -->
	<?php if ($nhanvien_list->Pager->NextButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerNext") ?>" href="<?php echo $nhanvien_list->pageUrl() ?>start=<?php echo $nhanvien_list->Pager->NextButton->Start ?>"><i class="icon-next ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerNext") ?>"><i class="icon-next ew-icon"></i></a>
	<?php } ?>
<!-- last page button -->
	<?php if ($nhanvien_list->Pager->LastButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerLast") ?>" href="<?php echo $nhanvien_list->pageUrl() ?>start=<?php echo $nhanvien_list->Pager->LastButton->Start ?>"><i class="icon-last ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerLast") ?>"><i class="icon-last ew-icon"></i></a>
	<?php } ?>
</div>
</div>
</div>
<span>&nbsp;<?php echo $Language->Phrase("of") ?>&nbsp;<?php echo $nhanvien_list->Pager->PageCount ?></span>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php if ($nhanvien_list->Pager->RecordCount > 0) { ?>
<div class="ew-pager ew-rec">
	<span><?php echo $Language->Phrase("Record") ?>&nbsp;<?php echo $nhanvien_list->Pager->FromIndex ?>&nbsp;<?php echo $Language->Phrase("To") ?>&nbsp;<?php echo $nhanvien_list->Pager->ToIndex ?>&nbsp;<?php echo $Language->Phrase("Of") ?>&nbsp;<?php echo $nhanvien_list->Pager->RecordCount ?></span>
</div>
<?php } ?>
<?php if ($nhanvien_list->TotalRecs > 0 && (!$nhanvien_list->AutoHidePageSizeSelector || $nhanvien_list->Pager->Visible)) { ?>
<div class="ew-pager">
<input type="hidden" name="t" value="nhanvien">
<select name="<?php echo TABLE_REC_PER_PAGE ?>" class="form-control form-control-sm ew-tooltip" title="<?php echo $Language->phrase("RecordsPerPage") ?>" onchange="this.form.submit();">
<option value="20"<?php if ($nhanvien_list->DisplayRecs == 20) { ?> selected<?php } ?>>20</option>
<option value="50"<?php if ($nhanvien_list->DisplayRecs == 50) { ?> selected<?php } ?>>50</option>
<option value="100"<?php if ($nhanvien_list->DisplayRecs == 100) { ?> selected<?php } ?>>100</option>
<option value="200"<?php if ($nhanvien_list->DisplayRecs == 200) { ?> selected<?php } ?>>200</option>
<option value="500"<?php if ($nhanvien_list->DisplayRecs == 500) { ?> selected<?php } ?>>500</option>
<option value="ALL"<?php if ($nhanvien->getRecordsPerPage() == -1) { ?> selected<?php } ?>><?php echo $Language->Phrase("AllRecords") ?></option>
</select>
</div>
<?php } ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $nhanvien_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
<form name="fnhanvienlist" id="fnhanvienlist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($nhanvien_list->CheckToken) { ?>
<input type="hidden" name="<?php echo TOKEN_NAME ?>" value="<?php echo $nhanvien_list->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="nhanvien">
<input type="hidden" name="exporttype" id="exporttype" value="">
<div id="gmp_nhanvien" class="<?php if (IsResponsiveLayout()) { ?>table-responsive <?php } ?>card-body ew-grid-middle-panel">
<?php if ($nhanvien_list->TotalRecs > 0 || $nhanvien->isGridEdit()) { ?>
<table id="tbl_nhanvienlist" class="table ew-table"><!-- .ew-table ##-->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$nhanvien_list->RowType = ROWTYPE_HEADER;

// Render list options
$nhanvien_list->renderListOptions();

// Render list options (header, left)
$nhanvien_list->ListOptions->render("header", "left");
?>
<?php if ($nhanvien->Ma_NV->Visible) { // Ma_NV ?>
	<?php if ($nhanvien->sortUrl($nhanvien->Ma_NV) == "") { ?>
		<th data-name="Ma_NV" class="<?php echo $nhanvien->Ma_NV->headerCellClass() ?>" style="white-space: nowrap;"><div id="elh_nhanvien_Ma_NV" class="nhanvien_Ma_NV"><div class="ew-table-header-caption"><?php echo $nhanvien->Ma_NV->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Ma_NV" class="<?php echo $nhanvien->Ma_NV->headerCellClass() ?>" style="white-space: nowrap;"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $nhanvien->SortUrl($nhanvien->Ma_NV) ?>',2);"><div id="elh_nhanvien_Ma_NV" class="nhanvien_Ma_NV">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $nhanvien->Ma_NV->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($nhanvien->Ma_NV->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($nhanvien->Ma_NV->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($nhanvien->hoVaTen->Visible) { // hoVaTen ?>
	<?php if ($nhanvien->sortUrl($nhanvien->hoVaTen) == "") { ?>
		<th data-name="hoVaTen" class="<?php echo $nhanvien->hoVaTen->headerCellClass() ?>" style="white-space: nowrap;"><div id="elh_nhanvien_hoVaTen" class="nhanvien_hoVaTen"><div class="ew-table-header-caption"><?php echo $nhanvien->hoVaTen->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="hoVaTen" class="<?php echo $nhanvien->hoVaTen->headerCellClass() ?>" style="white-space: nowrap;"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $nhanvien->SortUrl($nhanvien->hoVaTen) ?>',2);"><div id="elh_nhanvien_hoVaTen" class="nhanvien_hoVaTen">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $nhanvien->hoVaTen->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($nhanvien->hoVaTen->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($nhanvien->hoVaTen->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($nhanvien->gioiTinh->Visible) { // gioiTinh ?>
	<?php if ($nhanvien->sortUrl($nhanvien->gioiTinh) == "") { ?>
		<th data-name="gioiTinh" class="<?php echo $nhanvien->gioiTinh->headerCellClass() ?>" style="white-space: nowrap;"><div id="elh_nhanvien_gioiTinh" class="nhanvien_gioiTinh"><div class="ew-table-header-caption"><?php echo $nhanvien->gioiTinh->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="gioiTinh" class="<?php echo $nhanvien->gioiTinh->headerCellClass() ?>" style="white-space: nowrap;"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $nhanvien->SortUrl($nhanvien->gioiTinh) ?>',2);"><div id="elh_nhanvien_gioiTinh" class="nhanvien_gioiTinh">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $nhanvien->gioiTinh->caption() ?></span><span class="ew-table-header-sort"><?php if ($nhanvien->gioiTinh->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($nhanvien->gioiTinh->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($nhanvien->ngaySinh->Visible) { // ngaySinh ?>
	<?php if ($nhanvien->sortUrl($nhanvien->ngaySinh) == "") { ?>
		<th data-name="ngaySinh" class="<?php echo $nhanvien->ngaySinh->headerCellClass() ?>" style="white-space: nowrap;"><div id="elh_nhanvien_ngaySinh" class="nhanvien_ngaySinh"><div class="ew-table-header-caption"><?php echo $nhanvien->ngaySinh->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="ngaySinh" class="<?php echo $nhanvien->ngaySinh->headerCellClass() ?>" style="white-space: nowrap;"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $nhanvien->SortUrl($nhanvien->ngaySinh) ?>',2);"><div id="elh_nhanvien_ngaySinh" class="nhanvien_ngaySinh">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $nhanvien->ngaySinh->caption() ?></span><span class="ew-table-header-sort"><?php if ($nhanvien->ngaySinh->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($nhanvien->ngaySinh->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($nhanvien->emailCaNhan->Visible) { // emailCaNhan ?>
	<?php if ($nhanvien->sortUrl($nhanvien->emailCaNhan) == "") { ?>
		<th data-name="emailCaNhan" class="<?php echo $nhanvien->emailCaNhan->headerCellClass() ?>" style="white-space: nowrap;"><div id="elh_nhanvien_emailCaNhan" class="nhanvien_emailCaNhan"><div class="ew-table-header-caption"><?php echo $nhanvien->emailCaNhan->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="emailCaNhan" class="<?php echo $nhanvien->emailCaNhan->headerCellClass() ?>" style="white-space: nowrap;"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $nhanvien->SortUrl($nhanvien->emailCaNhan) ?>',2);"><div id="elh_nhanvien_emailCaNhan" class="nhanvien_emailCaNhan">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $nhanvien->emailCaNhan->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($nhanvien->emailCaNhan->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($nhanvien->emailCaNhan->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($nhanvien->TD_ID->Visible) { // TD_ID ?>
	<?php if ($nhanvien->sortUrl($nhanvien->TD_ID) == "") { ?>
		<th data-name="TD_ID" class="<?php echo $nhanvien->TD_ID->headerCellClass() ?>" style="white-space: nowrap;"><div id="elh_nhanvien_TD_ID" class="nhanvien_TD_ID"><div class="ew-table-header-caption"><?php echo $nhanvien->TD_ID->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="TD_ID" class="<?php echo $nhanvien->TD_ID->headerCellClass() ?>" style="white-space: nowrap;"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $nhanvien->SortUrl($nhanvien->TD_ID) ?>',2);"><div id="elh_nhanvien_TD_ID" class="nhanvien_TD_ID">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $nhanvien->TD_ID->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($nhanvien->TD_ID->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($nhanvien->TD_ID->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($nhanvien->PB_ID->Visible) { // PB_ID ?>
	<?php if ($nhanvien->sortUrl($nhanvien->PB_ID) == "") { ?>
		<th data-name="PB_ID" class="<?php echo $nhanvien->PB_ID->headerCellClass() ?>" style="white-space: nowrap;"><div id="elh_nhanvien_PB_ID" class="nhanvien_PB_ID"><div class="ew-table-header-caption"><?php echo $nhanvien->PB_ID->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="PB_ID" class="<?php echo $nhanvien->PB_ID->headerCellClass() ?>" style="white-space: nowrap;"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $nhanvien->SortUrl($nhanvien->PB_ID) ?>',2);"><div id="elh_nhanvien_PB_ID" class="nhanvien_PB_ID">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $nhanvien->PB_ID->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($nhanvien->PB_ID->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($nhanvien->PB_ID->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$nhanvien_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
if ($nhanvien->ExportAll && $nhanvien->isExport()) {
	$nhanvien_list->StopRec = $nhanvien_list->TotalRecs;
} else {

	// Set the last record to display
	if ($nhanvien_list->TotalRecs > $nhanvien_list->StartRec + $nhanvien_list->DisplayRecs - 1)
		$nhanvien_list->StopRec = $nhanvien_list->StartRec + $nhanvien_list->DisplayRecs - 1;
	else
		$nhanvien_list->StopRec = $nhanvien_list->TotalRecs;
}
$nhanvien_list->RecCnt = $nhanvien_list->StartRec - 1;
if ($nhanvien_list->Recordset && !$nhanvien_list->Recordset->EOF) {
	$nhanvien_list->Recordset->moveFirst();
	$selectLimit = $nhanvien_list->UseSelectLimit;
	if (!$selectLimit && $nhanvien_list->StartRec > 1)
		$nhanvien_list->Recordset->move($nhanvien_list->StartRec - 1);
} elseif (!$nhanvien->AllowAddDeleteRow && $nhanvien_list->StopRec == 0) {
	$nhanvien_list->StopRec = $nhanvien->GridAddRowCount;
}

// Initialize aggregate
$nhanvien->RowType = ROWTYPE_AGGREGATEINIT;
$nhanvien->resetAttributes();
$nhanvien_list->renderRow();
while ($nhanvien_list->RecCnt < $nhanvien_list->StopRec) {
	$nhanvien_list->RecCnt++;
	if ($nhanvien_list->RecCnt >= $nhanvien_list->StartRec) {
		$nhanvien_list->RowCnt++;

		// Set up key count
		$nhanvien_list->KeyCount = $nhanvien_list->RowIndex;

		// Init row class and style
		$nhanvien->resetAttributes();
		$nhanvien->CssClass = "";
		if ($nhanvien->isGridAdd()) {
		} else {
			$nhanvien_list->loadRowValues($nhanvien_list->Recordset); // Load row values
		}
		$nhanvien->RowType = ROWTYPE_VIEW; // Render view

		// Set up row id / data-rowindex
		$nhanvien->RowAttrs = array_merge($nhanvien->RowAttrs, array('data-rowindex'=>$nhanvien_list->RowCnt, 'id'=>'r' . $nhanvien_list->RowCnt . '_nhanvien', 'data-rowtype'=>$nhanvien->RowType));

		// Render row
		$nhanvien_list->renderRow();

		// Render list options
		$nhanvien_list->renderListOptions();
?>
	<tr<?php echo $nhanvien->rowAttributes() ?>>
<?php

// Render list options (body, left)
$nhanvien_list->ListOptions->render("body", "left", $nhanvien_list->RowCnt);
?>
	<?php if ($nhanvien->Ma_NV->Visible) { // Ma_NV ?>
		<td data-name="Ma_NV"<?php echo $nhanvien->Ma_NV->cellAttributes() ?>>
<span id="el<?php echo $nhanvien_list->RowCnt ?>_nhanvien_Ma_NV" class="nhanvien_Ma_NV">
<span<?php echo $nhanvien->Ma_NV->viewAttributes() ?>>
<?php echo $nhanvien->Ma_NV->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($nhanvien->hoVaTen->Visible) { // hoVaTen ?>
		<td data-name="hoVaTen"<?php echo $nhanvien->hoVaTen->cellAttributes() ?>>
<span id="el<?php echo $nhanvien_list->RowCnt ?>_nhanvien_hoVaTen" class="nhanvien_hoVaTen">
<span<?php echo $nhanvien->hoVaTen->viewAttributes() ?>>
<?php echo $nhanvien->hoVaTen->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($nhanvien->gioiTinh->Visible) { // gioiTinh ?>
		<td data-name="gioiTinh"<?php echo $nhanvien->gioiTinh->cellAttributes() ?>>
<span id="el<?php echo $nhanvien_list->RowCnt ?>_nhanvien_gioiTinh" class="nhanvien_gioiTinh">
<span<?php echo $nhanvien->gioiTinh->viewAttributes() ?>>
<?php echo $nhanvien->gioiTinh->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($nhanvien->ngaySinh->Visible) { // ngaySinh ?>
		<td data-name="ngaySinh"<?php echo $nhanvien->ngaySinh->cellAttributes() ?>>
<span id="el<?php echo $nhanvien_list->RowCnt ?>_nhanvien_ngaySinh" class="nhanvien_ngaySinh">
<span<?php echo $nhanvien->ngaySinh->viewAttributes() ?>>
<?php echo $nhanvien->ngaySinh->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($nhanvien->emailCaNhan->Visible) { // emailCaNhan ?>
		<td data-name="emailCaNhan"<?php echo $nhanvien->emailCaNhan->cellAttributes() ?>>
<span id="el<?php echo $nhanvien_list->RowCnt ?>_nhanvien_emailCaNhan" class="nhanvien_emailCaNhan">
<span<?php echo $nhanvien->emailCaNhan->viewAttributes() ?>>
<?php echo $nhanvien->emailCaNhan->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($nhanvien->TD_ID->Visible) { // TD_ID ?>
		<td data-name="TD_ID"<?php echo $nhanvien->TD_ID->cellAttributes() ?>>
<span id="el<?php echo $nhanvien_list->RowCnt ?>_nhanvien_TD_ID" class="nhanvien_TD_ID">
<span<?php echo $nhanvien->TD_ID->viewAttributes() ?>>
<?php echo $nhanvien->TD_ID->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($nhanvien->PB_ID->Visible) { // PB_ID ?>
		<td data-name="PB_ID"<?php echo $nhanvien->PB_ID->cellAttributes() ?>>
<span id="el<?php echo $nhanvien_list->RowCnt ?>_nhanvien_PB_ID" class="nhanvien_PB_ID">
<span<?php echo $nhanvien->PB_ID->viewAttributes() ?>>
<?php echo $nhanvien->PB_ID->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$nhanvien_list->ListOptions->render("body", "right", $nhanvien_list->RowCnt);
?>
	</tr>
<?php
	}
	if (!$nhanvien->isGridAdd())
		$nhanvien_list->Recordset->moveNext();
}
?>
</tbody>
</table><!-- /.ew-table -->
<?php } ?>
<?php if (!$nhanvien->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</div><!-- /.ew-grid-middle-panel -->
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($nhanvien_list->Recordset)
	$nhanvien_list->Recordset->Close();
?>
<?php if (!$nhanvien->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$nhanvien->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php if (!isset($nhanvien_list->Pager)) $nhanvien_list->Pager = new PrevNextPager($nhanvien_list->StartRec, $nhanvien_list->DisplayRecs, $nhanvien_list->TotalRecs, $nhanvien_list->AutoHidePager) ?>
<?php if ($nhanvien_list->Pager->RecordCount > 0 && $nhanvien_list->Pager->Visible) { ?>
<div class="ew-pager">
<span><?php echo $Language->Phrase("Page") ?>&nbsp;</span>
<div class="ew-prev-next"><div class="input-group input-group-sm">
<div class="input-group-prepend">
<!-- first page button -->
	<?php if ($nhanvien_list->Pager->FirstButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerFirst") ?>" href="<?php echo $nhanvien_list->pageUrl() ?>start=<?php echo $nhanvien_list->Pager->FirstButton->Start ?>"><i class="icon-first ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerFirst") ?>"><i class="icon-first ew-icon"></i></a>
	<?php } ?>
<!-- previous page button -->
	<?php if ($nhanvien_list->Pager->PrevButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerPrevious") ?>" href="<?php echo $nhanvien_list->pageUrl() ?>start=<?php echo $nhanvien_list->Pager->PrevButton->Start ?>"><i class="icon-prev ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerPrevious") ?>"><i class="icon-prev ew-icon"></i></a>
	<?php } ?>
</div>
<!-- current page number -->
	<input class="form-control" type="text" name="<?php echo TABLE_PAGE_NO ?>" value="<?php echo $nhanvien_list->Pager->CurrentPage ?>">
<div class="input-group-append">
<!-- next page button -->
	<?php if ($nhanvien_list->Pager->NextButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerNext") ?>" href="<?php echo $nhanvien_list->pageUrl() ?>start=<?php echo $nhanvien_list->Pager->NextButton->Start ?>"><i class="icon-next ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerNext") ?>"><i class="icon-next ew-icon"></i></a>
	<?php } ?>
<!-- last page button -->
	<?php if ($nhanvien_list->Pager->LastButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerLast") ?>" href="<?php echo $nhanvien_list->pageUrl() ?>start=<?php echo $nhanvien_list->Pager->LastButton->Start ?>"><i class="icon-last ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerLast") ?>"><i class="icon-last ew-icon"></i></a>
	<?php } ?>
</div>
</div>
</div>
<span>&nbsp;<?php echo $Language->Phrase("of") ?>&nbsp;<?php echo $nhanvien_list->Pager->PageCount ?></span>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php if ($nhanvien_list->Pager->RecordCount > 0) { ?>
<div class="ew-pager ew-rec">
	<span><?php echo $Language->Phrase("Record") ?>&nbsp;<?php echo $nhanvien_list->Pager->FromIndex ?>&nbsp;<?php echo $Language->Phrase("To") ?>&nbsp;<?php echo $nhanvien_list->Pager->ToIndex ?>&nbsp;<?php echo $Language->Phrase("Of") ?>&nbsp;<?php echo $nhanvien_list->Pager->RecordCount ?></span>
</div>
<?php } ?>
<?php if ($nhanvien_list->TotalRecs > 0 && (!$nhanvien_list->AutoHidePageSizeSelector || $nhanvien_list->Pager->Visible)) { ?>
<div class="ew-pager">
<input type="hidden" name="t" value="nhanvien">
<select name="<?php echo TABLE_REC_PER_PAGE ?>" class="form-control form-control-sm ew-tooltip" title="<?php echo $Language->phrase("RecordsPerPage") ?>" onchange="this.form.submit();">
<option value="20"<?php if ($nhanvien_list->DisplayRecs == 20) { ?> selected<?php } ?>>20</option>
<option value="50"<?php if ($nhanvien_list->DisplayRecs == 50) { ?> selected<?php } ?>>50</option>
<option value="100"<?php if ($nhanvien_list->DisplayRecs == 100) { ?> selected<?php } ?>>100</option>
<option value="200"<?php if ($nhanvien_list->DisplayRecs == 200) { ?> selected<?php } ?>>200</option>
<option value="500"<?php if ($nhanvien_list->DisplayRecs == 500) { ?> selected<?php } ?>>500</option>
<option value="ALL"<?php if ($nhanvien->getRecordsPerPage() == -1) { ?> selected<?php } ?>><?php echo $Language->Phrase("AllRecords") ?></option>
</select>
</div>
<?php } ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $nhanvien_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($nhanvien_list->TotalRecs == 0 && !$nhanvien->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $nhanvien_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$nhanvien_list->showPageFooter();
if (DEBUG_ENABLED)
	echo GetDebugMessage();
?>
<?php if (!$nhanvien->isExport()) { ?>
<script>

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php } ?>
<?php include_once "footer.php" ?>
<?php
$nhanvien_list->terminate();
?>