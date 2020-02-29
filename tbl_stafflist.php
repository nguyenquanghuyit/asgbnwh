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
$tbl_staff_list = new tbl_staff_list();

// Run the page
$tbl_staff_list->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$tbl_staff_list->Page_Render();
?>
<?php include_once "header.php" ?>
<?php if (!$tbl_staff->isExport()) { ?>
<script>

// Form object
currentPageID = ew.PAGE_ID = "list";
var ftbl_stafflist = currentForm = new ew.Form("ftbl_stafflist", "list");
ftbl_stafflist.formKeyCountName = '<?php echo $tbl_staff_list->FormKeyCountName ?>';

// Form_CustomValidate event
ftbl_stafflist.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

	// Your custom validation code here, return false if invalid.
	return true;
}

// Use JavaScript validation or not
ftbl_stafflist.validateRequired = <?php echo json_encode(CLIENT_VALIDATE) ?>;

// Dynamic selection lists
ftbl_stafflist.lists["x_gioiTinh"] = <?php echo $tbl_staff_list->gioiTinh->Lookup->toClientList() ?>;
ftbl_stafflist.lists["x_gioiTinh"].options = <?php echo JsonEncode($tbl_staff_list->gioiTinh->options(FALSE, TRUE)) ?>;
ftbl_stafflist.lists["x_TD_ID"] = <?php echo $tbl_staff_list->TD_ID->Lookup->toClientList() ?>;
ftbl_stafflist.lists["x_TD_ID"].options = <?php echo JsonEncode($tbl_staff_list->TD_ID->lookupOptions()) ?>;
ftbl_stafflist.autoSuggests["x_TD_ID"] = <?php echo json_encode(["data" => "ajax=autosuggest"]) ?>;
ftbl_stafflist.lists["x_PB_ID"] = <?php echo $tbl_staff_list->PB_ID->Lookup->toClientList() ?>;
ftbl_stafflist.lists["x_PB_ID"].options = <?php echo JsonEncode($tbl_staff_list->PB_ID->lookupOptions()) ?>;
ftbl_stafflist.autoSuggests["x_PB_ID"] = <?php echo json_encode(["data" => "ajax=autosuggest"]) ?>;

// Form object for search
var ftbl_stafflistsrch = currentSearchForm = new ew.Form("ftbl_stafflistsrch");

// Filters
ftbl_stafflistsrch.filterList = <?php echo $tbl_staff_list->getFilterList() ?>;
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
<?php if (!$tbl_staff->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($tbl_staff_list->TotalRecs > 0 && $tbl_staff_list->ExportOptions->visible()) { ?>
<?php $tbl_staff_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($tbl_staff_list->ImportOptions->visible()) { ?>
<?php $tbl_staff_list->ImportOptions->render("body") ?>
<?php } ?>
<?php if ($tbl_staff_list->SearchOptions->visible()) { ?>
<?php $tbl_staff_list->SearchOptions->render("body") ?>
<?php } ?>
<?php if ($tbl_staff_list->FilterOptions->visible()) { ?>
<?php $tbl_staff_list->FilterOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php
$tbl_staff_list->renderOtherOptions();
?>
<?php if ($Security->CanSearch()) { ?>
<?php if (!$tbl_staff->isExport() && !$tbl_staff->CurrentAction) { ?>
<form name="ftbl_stafflistsrch" id="ftbl_stafflistsrch" class="form-inline ew-form ew-ext-search-form" action="<?php echo CurrentPageName() ?>">
<?php $searchPanelClass = ($tbl_staff_list->SearchWhere <> "") ? " show" : " show"; ?>
<div id="ftbl_stafflistsrch-search-panel" class="ew-search-panel collapse<?php echo $searchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="tbl_staff">
	<div class="ew-basic-search">
<div id="xsr_1" class="ew-row d-sm-flex">
	<div class="ew-quick-search input-group">
		<input type="text" name="<?php echo TABLE_BASIC_SEARCH ?>" id="<?php echo TABLE_BASIC_SEARCH ?>" class="form-control" value="<?php echo HtmlEncode($tbl_staff_list->BasicSearch->getKeyword()) ?>" placeholder="<?php echo HtmlEncode($Language->phrase("Search")) ?>">
		<input type="hidden" name="<?php echo TABLE_BASIC_SEARCH_TYPE ?>" id="<?php echo TABLE_BASIC_SEARCH_TYPE ?>" value="<?php echo HtmlEncode($tbl_staff_list->BasicSearch->getType()) ?>">
		<div class="input-group-append">
			<button class="btn btn-primary" name="btn-submit" id="btn-submit" type="submit"><?php echo $Language->phrase("SearchBtn") ?></button>
			<button type="button" data-toggle="dropdown" class="btn btn-primary dropdown-toggle dropdown-toggle-split" aria-haspopup="true" aria-expanded="false"><span id="searchtype"><?php echo $tbl_staff_list->BasicSearch->getTypeNameShort() ?></span></button>
			<div class="dropdown-menu dropdown-menu-right">
				<a class="dropdown-item<?php if ($tbl_staff_list->BasicSearch->getType() == "") echo " active"; ?>" href="javascript:void(0);" onclick="ew.setSearchType(this)"><?php echo $Language->phrase("QuickSearchAuto") ?></a>
				<a class="dropdown-item<?php if ($tbl_staff_list->BasicSearch->getType() == "=") echo " active"; ?>" href="javascript:void(0);" onclick="ew.setSearchType(this,'=')"><?php echo $Language->phrase("QuickSearchExact") ?></a>
				<a class="dropdown-item<?php if ($tbl_staff_list->BasicSearch->getType() == "AND") echo " active"; ?>" href="javascript:void(0);" onclick="ew.setSearchType(this,'AND')"><?php echo $Language->phrase("QuickSearchAll") ?></a>
				<a class="dropdown-item<?php if ($tbl_staff_list->BasicSearch->getType() == "OR") echo " active"; ?>" href="javascript:void(0);" onclick="ew.setSearchType(this,'OR')"><?php echo $Language->phrase("QuickSearchAny") ?></a>
			</div>
		</div>
	</div>
</div>
	</div>
</div>
</form>
<?php } ?>
<?php } ?>
<?php $tbl_staff_list->showPageHeader(); ?>
<?php
$tbl_staff_list->showMessage();
?>
<?php if ($tbl_staff_list->TotalRecs > 0 || $tbl_staff->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($tbl_staff_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> tbl_staff">
<?php if (!$tbl_staff->isExport()) { ?>
<div class="card-header ew-grid-upper-panel">
<?php if (!$tbl_staff->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php if (!isset($tbl_staff_list->Pager)) $tbl_staff_list->Pager = new PrevNextPager($tbl_staff_list->StartRec, $tbl_staff_list->DisplayRecs, $tbl_staff_list->TotalRecs, $tbl_staff_list->AutoHidePager) ?>
<?php if ($tbl_staff_list->Pager->RecordCount > 0 && $tbl_staff_list->Pager->Visible) { ?>
<div class="ew-pager">
<span><?php echo $Language->Phrase("Page") ?>&nbsp;</span>
<div class="ew-prev-next"><div class="input-group input-group-sm">
<div class="input-group-prepend">
<!-- first page button -->
	<?php if ($tbl_staff_list->Pager->FirstButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerFirst") ?>" href="<?php echo $tbl_staff_list->pageUrl() ?>start=<?php echo $tbl_staff_list->Pager->FirstButton->Start ?>"><i class="icon-first ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerFirst") ?>"><i class="icon-first ew-icon"></i></a>
	<?php } ?>
<!-- previous page button -->
	<?php if ($tbl_staff_list->Pager->PrevButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerPrevious") ?>" href="<?php echo $tbl_staff_list->pageUrl() ?>start=<?php echo $tbl_staff_list->Pager->PrevButton->Start ?>"><i class="icon-prev ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerPrevious") ?>"><i class="icon-prev ew-icon"></i></a>
	<?php } ?>
</div>
<!-- current page number -->
	<input class="form-control" type="text" name="<?php echo TABLE_PAGE_NO ?>" value="<?php echo $tbl_staff_list->Pager->CurrentPage ?>">
<div class="input-group-append">
<!-- next page button -->
	<?php if ($tbl_staff_list->Pager->NextButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerNext") ?>" href="<?php echo $tbl_staff_list->pageUrl() ?>start=<?php echo $tbl_staff_list->Pager->NextButton->Start ?>"><i class="icon-next ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerNext") ?>"><i class="icon-next ew-icon"></i></a>
	<?php } ?>
<!-- last page button -->
	<?php if ($tbl_staff_list->Pager->LastButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerLast") ?>" href="<?php echo $tbl_staff_list->pageUrl() ?>start=<?php echo $tbl_staff_list->Pager->LastButton->Start ?>"><i class="icon-last ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerLast") ?>"><i class="icon-last ew-icon"></i></a>
	<?php } ?>
</div>
</div>
</div>
<span>&nbsp;<?php echo $Language->Phrase("of") ?>&nbsp;<?php echo $tbl_staff_list->Pager->PageCount ?></span>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php if ($tbl_staff_list->Pager->RecordCount > 0) { ?>
<div class="ew-pager ew-rec">
	<span><?php echo $Language->Phrase("Record") ?>&nbsp;<?php echo $tbl_staff_list->Pager->FromIndex ?>&nbsp;<?php echo $Language->Phrase("To") ?>&nbsp;<?php echo $tbl_staff_list->Pager->ToIndex ?>&nbsp;<?php echo $Language->Phrase("Of") ?>&nbsp;<?php echo $tbl_staff_list->Pager->RecordCount ?></span>
</div>
<?php } ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $tbl_staff_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
<form name="ftbl_stafflist" id="ftbl_stafflist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($tbl_staff_list->CheckToken) { ?>
<input type="hidden" name="<?php echo TOKEN_NAME ?>" value="<?php echo $tbl_staff_list->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="tbl_staff">
<input type="hidden" name="exporttype" id="exporttype" value="">
<div id="gmp_tbl_staff" class="<?php if (IsResponsiveLayout()) { ?>table-responsive <?php } ?>card-body ew-grid-middle-panel">
<?php if ($tbl_staff_list->TotalRecs > 0 || $tbl_staff->isGridEdit()) { ?>
<table id="tbl_tbl_stafflist" class="table ew-table"><!-- .ew-table ##-->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$tbl_staff_list->RowType = ROWTYPE_HEADER;

// Render list options
$tbl_staff_list->renderListOptions();

// Render list options (header, left)
$tbl_staff_list->ListOptions->render("header", "left");
?>
<?php if ($tbl_staff->Ma_NV->Visible) { // Ma_NV ?>
	<?php if ($tbl_staff->sortUrl($tbl_staff->Ma_NV) == "") { ?>
		<th data-name="Ma_NV" class="<?php echo $tbl_staff->Ma_NV->headerCellClass() ?>" style="white-space: nowrap;"><div id="elh_tbl_staff_Ma_NV" class="tbl_staff_Ma_NV"><div class="ew-table-header-caption"><?php echo $tbl_staff->Ma_NV->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Ma_NV" class="<?php echo $tbl_staff->Ma_NV->headerCellClass() ?>" style="white-space: nowrap;"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $tbl_staff->SortUrl($tbl_staff->Ma_NV) ?>',2);"><div id="elh_tbl_staff_Ma_NV" class="tbl_staff_Ma_NV">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $tbl_staff->Ma_NV->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($tbl_staff->Ma_NV->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($tbl_staff->Ma_NV->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($tbl_staff->hoVaTen->Visible) { // hoVaTen ?>
	<?php if ($tbl_staff->sortUrl($tbl_staff->hoVaTen) == "") { ?>
		<th data-name="hoVaTen" class="<?php echo $tbl_staff->hoVaTen->headerCellClass() ?>" style="white-space: nowrap;"><div id="elh_tbl_staff_hoVaTen" class="tbl_staff_hoVaTen"><div class="ew-table-header-caption"><?php echo $tbl_staff->hoVaTen->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="hoVaTen" class="<?php echo $tbl_staff->hoVaTen->headerCellClass() ?>" style="white-space: nowrap;"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $tbl_staff->SortUrl($tbl_staff->hoVaTen) ?>',2);"><div id="elh_tbl_staff_hoVaTen" class="tbl_staff_hoVaTen">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $tbl_staff->hoVaTen->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($tbl_staff->hoVaTen->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($tbl_staff->hoVaTen->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($tbl_staff->gioiTinh->Visible) { // gioiTinh ?>
	<?php if ($tbl_staff->sortUrl($tbl_staff->gioiTinh) == "") { ?>
		<th data-name="gioiTinh" class="<?php echo $tbl_staff->gioiTinh->headerCellClass() ?>" style="white-space: nowrap;"><div id="elh_tbl_staff_gioiTinh" class="tbl_staff_gioiTinh"><div class="ew-table-header-caption"><?php echo $tbl_staff->gioiTinh->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="gioiTinh" class="<?php echo $tbl_staff->gioiTinh->headerCellClass() ?>" style="white-space: nowrap;"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $tbl_staff->SortUrl($tbl_staff->gioiTinh) ?>',2);"><div id="elh_tbl_staff_gioiTinh" class="tbl_staff_gioiTinh">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $tbl_staff->gioiTinh->caption() ?></span><span class="ew-table-header-sort"><?php if ($tbl_staff->gioiTinh->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($tbl_staff->gioiTinh->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($tbl_staff->ngaySinh->Visible) { // ngaySinh ?>
	<?php if ($tbl_staff->sortUrl($tbl_staff->ngaySinh) == "") { ?>
		<th data-name="ngaySinh" class="<?php echo $tbl_staff->ngaySinh->headerCellClass() ?>" style="white-space: nowrap;"><div id="elh_tbl_staff_ngaySinh" class="tbl_staff_ngaySinh"><div class="ew-table-header-caption"><?php echo $tbl_staff->ngaySinh->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="ngaySinh" class="<?php echo $tbl_staff->ngaySinh->headerCellClass() ?>" style="white-space: nowrap;"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $tbl_staff->SortUrl($tbl_staff->ngaySinh) ?>',2);"><div id="elh_tbl_staff_ngaySinh" class="tbl_staff_ngaySinh">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $tbl_staff->ngaySinh->caption() ?></span><span class="ew-table-header-sort"><?php if ($tbl_staff->ngaySinh->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($tbl_staff->ngaySinh->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($tbl_staff->emailCaNhan->Visible) { // emailCaNhan ?>
	<?php if ($tbl_staff->sortUrl($tbl_staff->emailCaNhan) == "") { ?>
		<th data-name="emailCaNhan" class="<?php echo $tbl_staff->emailCaNhan->headerCellClass() ?>" style="white-space: nowrap;"><div id="elh_tbl_staff_emailCaNhan" class="tbl_staff_emailCaNhan"><div class="ew-table-header-caption"><?php echo $tbl_staff->emailCaNhan->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="emailCaNhan" class="<?php echo $tbl_staff->emailCaNhan->headerCellClass() ?>" style="white-space: nowrap;"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $tbl_staff->SortUrl($tbl_staff->emailCaNhan) ?>',2);"><div id="elh_tbl_staff_emailCaNhan" class="tbl_staff_emailCaNhan">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $tbl_staff->emailCaNhan->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($tbl_staff->emailCaNhan->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($tbl_staff->emailCaNhan->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($tbl_staff->TD_ID->Visible) { // TD_ID ?>
	<?php if ($tbl_staff->sortUrl($tbl_staff->TD_ID) == "") { ?>
		<th data-name="TD_ID" class="<?php echo $tbl_staff->TD_ID->headerCellClass() ?>" style="white-space: nowrap;"><div id="elh_tbl_staff_TD_ID" class="tbl_staff_TD_ID"><div class="ew-table-header-caption"><?php echo $tbl_staff->TD_ID->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="TD_ID" class="<?php echo $tbl_staff->TD_ID->headerCellClass() ?>" style="white-space: nowrap;"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $tbl_staff->SortUrl($tbl_staff->TD_ID) ?>',2);"><div id="elh_tbl_staff_TD_ID" class="tbl_staff_TD_ID">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $tbl_staff->TD_ID->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($tbl_staff->TD_ID->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($tbl_staff->TD_ID->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($tbl_staff->PB_ID->Visible) { // PB_ID ?>
	<?php if ($tbl_staff->sortUrl($tbl_staff->PB_ID) == "") { ?>
		<th data-name="PB_ID" class="<?php echo $tbl_staff->PB_ID->headerCellClass() ?>" style="white-space: nowrap;"><div id="elh_tbl_staff_PB_ID" class="tbl_staff_PB_ID"><div class="ew-table-header-caption"><?php echo $tbl_staff->PB_ID->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="PB_ID" class="<?php echo $tbl_staff->PB_ID->headerCellClass() ?>" style="white-space: nowrap;"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $tbl_staff->SortUrl($tbl_staff->PB_ID) ?>',2);"><div id="elh_tbl_staff_PB_ID" class="tbl_staff_PB_ID">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $tbl_staff->PB_ID->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($tbl_staff->PB_ID->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($tbl_staff->PB_ID->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$tbl_staff_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
if ($tbl_staff->ExportAll && $tbl_staff->isExport()) {
	$tbl_staff_list->StopRec = $tbl_staff_list->TotalRecs;
} else {

	// Set the last record to display
	if ($tbl_staff_list->TotalRecs > $tbl_staff_list->StartRec + $tbl_staff_list->DisplayRecs - 1)
		$tbl_staff_list->StopRec = $tbl_staff_list->StartRec + $tbl_staff_list->DisplayRecs - 1;
	else
		$tbl_staff_list->StopRec = $tbl_staff_list->TotalRecs;
}
$tbl_staff_list->RecCnt = $tbl_staff_list->StartRec - 1;
if ($tbl_staff_list->Recordset && !$tbl_staff_list->Recordset->EOF) {
	$tbl_staff_list->Recordset->moveFirst();
	$selectLimit = $tbl_staff_list->UseSelectLimit;
	if (!$selectLimit && $tbl_staff_list->StartRec > 1)
		$tbl_staff_list->Recordset->move($tbl_staff_list->StartRec - 1);
} elseif (!$tbl_staff->AllowAddDeleteRow && $tbl_staff_list->StopRec == 0) {
	$tbl_staff_list->StopRec = $tbl_staff->GridAddRowCount;
}

// Initialize aggregate
$tbl_staff->RowType = ROWTYPE_AGGREGATEINIT;
$tbl_staff->resetAttributes();
$tbl_staff_list->renderRow();
while ($tbl_staff_list->RecCnt < $tbl_staff_list->StopRec) {
	$tbl_staff_list->RecCnt++;
	if ($tbl_staff_list->RecCnt >= $tbl_staff_list->StartRec) {
		$tbl_staff_list->RowCnt++;

		// Set up key count
		$tbl_staff_list->KeyCount = $tbl_staff_list->RowIndex;

		// Init row class and style
		$tbl_staff->resetAttributes();
		$tbl_staff->CssClass = "";
		if ($tbl_staff->isGridAdd()) {
		} else {
			$tbl_staff_list->loadRowValues($tbl_staff_list->Recordset); // Load row values
		}
		$tbl_staff->RowType = ROWTYPE_VIEW; // Render view

		// Set up row id / data-rowindex
		$tbl_staff->RowAttrs = array_merge($tbl_staff->RowAttrs, array('data-rowindex'=>$tbl_staff_list->RowCnt, 'id'=>'r' . $tbl_staff_list->RowCnt . '_tbl_staff', 'data-rowtype'=>$tbl_staff->RowType));

		// Render row
		$tbl_staff_list->renderRow();

		// Render list options
		$tbl_staff_list->renderListOptions();
?>
	<tr<?php echo $tbl_staff->rowAttributes() ?>>
<?php

// Render list options (body, left)
$tbl_staff_list->ListOptions->render("body", "left", $tbl_staff_list->RowCnt);
?>
	<?php if ($tbl_staff->Ma_NV->Visible) { // Ma_NV ?>
		<td data-name="Ma_NV"<?php echo $tbl_staff->Ma_NV->cellAttributes() ?>>
<span id="el<?php echo $tbl_staff_list->RowCnt ?>_tbl_staff_Ma_NV" class="tbl_staff_Ma_NV">
<span<?php echo $tbl_staff->Ma_NV->viewAttributes() ?>>
<?php echo $tbl_staff->Ma_NV->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($tbl_staff->hoVaTen->Visible) { // hoVaTen ?>
		<td data-name="hoVaTen"<?php echo $tbl_staff->hoVaTen->cellAttributes() ?>>
<span id="el<?php echo $tbl_staff_list->RowCnt ?>_tbl_staff_hoVaTen" class="tbl_staff_hoVaTen">
<span<?php echo $tbl_staff->hoVaTen->viewAttributes() ?>>
<?php echo $tbl_staff->hoVaTen->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($tbl_staff->gioiTinh->Visible) { // gioiTinh ?>
		<td data-name="gioiTinh"<?php echo $tbl_staff->gioiTinh->cellAttributes() ?>>
<span id="el<?php echo $tbl_staff_list->RowCnt ?>_tbl_staff_gioiTinh" class="tbl_staff_gioiTinh">
<span<?php echo $tbl_staff->gioiTinh->viewAttributes() ?>>
<?php echo $tbl_staff->gioiTinh->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($tbl_staff->ngaySinh->Visible) { // ngaySinh ?>
		<td data-name="ngaySinh"<?php echo $tbl_staff->ngaySinh->cellAttributes() ?>>
<span id="el<?php echo $tbl_staff_list->RowCnt ?>_tbl_staff_ngaySinh" class="tbl_staff_ngaySinh">
<span<?php echo $tbl_staff->ngaySinh->viewAttributes() ?>>
<?php echo $tbl_staff->ngaySinh->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($tbl_staff->emailCaNhan->Visible) { // emailCaNhan ?>
		<td data-name="emailCaNhan"<?php echo $tbl_staff->emailCaNhan->cellAttributes() ?>>
<span id="el<?php echo $tbl_staff_list->RowCnt ?>_tbl_staff_emailCaNhan" class="tbl_staff_emailCaNhan">
<span<?php echo $tbl_staff->emailCaNhan->viewAttributes() ?>>
<?php echo $tbl_staff->emailCaNhan->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($tbl_staff->TD_ID->Visible) { // TD_ID ?>
		<td data-name="TD_ID"<?php echo $tbl_staff->TD_ID->cellAttributes() ?>>
<span id="el<?php echo $tbl_staff_list->RowCnt ?>_tbl_staff_TD_ID" class="tbl_staff_TD_ID">
<span<?php echo $tbl_staff->TD_ID->viewAttributes() ?>>
<?php echo $tbl_staff->TD_ID->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($tbl_staff->PB_ID->Visible) { // PB_ID ?>
		<td data-name="PB_ID"<?php echo $tbl_staff->PB_ID->cellAttributes() ?>>
<span id="el<?php echo $tbl_staff_list->RowCnt ?>_tbl_staff_PB_ID" class="tbl_staff_PB_ID">
<span<?php echo $tbl_staff->PB_ID->viewAttributes() ?>>
<?php echo $tbl_staff->PB_ID->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$tbl_staff_list->ListOptions->render("body", "right", $tbl_staff_list->RowCnt);
?>
	</tr>
<?php
	}
	if (!$tbl_staff->isGridAdd())
		$tbl_staff_list->Recordset->moveNext();
}
?>
</tbody>
</table><!-- /.ew-table -->
<?php } ?>
<?php if (!$tbl_staff->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</div><!-- /.ew-grid-middle-panel -->
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($tbl_staff_list->Recordset)
	$tbl_staff_list->Recordset->Close();
?>
<?php if (!$tbl_staff->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$tbl_staff->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php if (!isset($tbl_staff_list->Pager)) $tbl_staff_list->Pager = new PrevNextPager($tbl_staff_list->StartRec, $tbl_staff_list->DisplayRecs, $tbl_staff_list->TotalRecs, $tbl_staff_list->AutoHidePager) ?>
<?php if ($tbl_staff_list->Pager->RecordCount > 0 && $tbl_staff_list->Pager->Visible) { ?>
<div class="ew-pager">
<span><?php echo $Language->Phrase("Page") ?>&nbsp;</span>
<div class="ew-prev-next"><div class="input-group input-group-sm">
<div class="input-group-prepend">
<!-- first page button -->
	<?php if ($tbl_staff_list->Pager->FirstButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerFirst") ?>" href="<?php echo $tbl_staff_list->pageUrl() ?>start=<?php echo $tbl_staff_list->Pager->FirstButton->Start ?>"><i class="icon-first ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerFirst") ?>"><i class="icon-first ew-icon"></i></a>
	<?php } ?>
<!-- previous page button -->
	<?php if ($tbl_staff_list->Pager->PrevButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerPrevious") ?>" href="<?php echo $tbl_staff_list->pageUrl() ?>start=<?php echo $tbl_staff_list->Pager->PrevButton->Start ?>"><i class="icon-prev ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerPrevious") ?>"><i class="icon-prev ew-icon"></i></a>
	<?php } ?>
</div>
<!-- current page number -->
	<input class="form-control" type="text" name="<?php echo TABLE_PAGE_NO ?>" value="<?php echo $tbl_staff_list->Pager->CurrentPage ?>">
<div class="input-group-append">
<!-- next page button -->
	<?php if ($tbl_staff_list->Pager->NextButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerNext") ?>" href="<?php echo $tbl_staff_list->pageUrl() ?>start=<?php echo $tbl_staff_list->Pager->NextButton->Start ?>"><i class="icon-next ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerNext") ?>"><i class="icon-next ew-icon"></i></a>
	<?php } ?>
<!-- last page button -->
	<?php if ($tbl_staff_list->Pager->LastButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerLast") ?>" href="<?php echo $tbl_staff_list->pageUrl() ?>start=<?php echo $tbl_staff_list->Pager->LastButton->Start ?>"><i class="icon-last ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerLast") ?>"><i class="icon-last ew-icon"></i></a>
	<?php } ?>
</div>
</div>
</div>
<span>&nbsp;<?php echo $Language->Phrase("of") ?>&nbsp;<?php echo $tbl_staff_list->Pager->PageCount ?></span>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php if ($tbl_staff_list->Pager->RecordCount > 0) { ?>
<div class="ew-pager ew-rec">
	<span><?php echo $Language->Phrase("Record") ?>&nbsp;<?php echo $tbl_staff_list->Pager->FromIndex ?>&nbsp;<?php echo $Language->Phrase("To") ?>&nbsp;<?php echo $tbl_staff_list->Pager->ToIndex ?>&nbsp;<?php echo $Language->Phrase("Of") ?>&nbsp;<?php echo $tbl_staff_list->Pager->RecordCount ?></span>
</div>
<?php } ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $tbl_staff_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($tbl_staff_list->TotalRecs == 0 && !$tbl_staff->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $tbl_staff_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$tbl_staff_list->showPageFooter();
if (DEBUG_ENABLED)
	echo GetDebugMessage();
?>
<?php if (!$tbl_staff->isExport()) { ?>
<script>

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php } ?>
<?php include_once "footer.php" ?>
<?php
$tbl_staff_list->terminate();
?>