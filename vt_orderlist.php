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
$vt_order_list = new vt_order_list();

// Run the page
$vt_order_list->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$vt_order_list->Page_Render();
?>
<?php include_once "header.php" ?>
<?php if (!$vt_order->isExport()) { ?>
<script>

// Form object
currentPageID = ew.PAGE_ID = "list";
var fvt_orderlist = currentForm = new ew.Form("fvt_orderlist", "list");
fvt_orderlist.formKeyCountName = '<?php echo $vt_order_list->FormKeyCountName ?>';

// Form_CustomValidate event
fvt_orderlist.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

	// Your custom validation code here, return false if invalid.
	return true;
}

// Use JavaScript validation or not
fvt_orderlist.validateRequired = <?php echo json_encode(CLIENT_VALIDATE) ?>;

// Dynamic selection lists
// Form object for search

var fvt_orderlistsrch = currentSearchForm = new ew.Form("fvt_orderlistsrch");

// Filters
fvt_orderlistsrch.filterList = <?php echo $vt_order_list->getFilterList() ?>;
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
<?php if (!$vt_order->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($vt_order_list->TotalRecs > 0 && $vt_order_list->ExportOptions->visible()) { ?>
<?php $vt_order_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($vt_order_list->ImportOptions->visible()) { ?>
<?php $vt_order_list->ImportOptions->render("body") ?>
<?php } ?>
<?php if ($vt_order_list->SearchOptions->visible()) { ?>
<?php $vt_order_list->SearchOptions->render("body") ?>
<?php } ?>
<?php if ($vt_order_list->FilterOptions->visible()) { ?>
<?php $vt_order_list->FilterOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php
$vt_order_list->renderOtherOptions();
?>
<?php if ($Security->CanSearch()) { ?>
<?php if (!$vt_order->isExport() && !$vt_order->CurrentAction) { ?>
<form name="fvt_orderlistsrch" id="fvt_orderlistsrch" class="form-inline ew-form ew-ext-search-form" action="<?php echo CurrentPageName() ?>">
<?php $searchPanelClass = ($vt_order_list->SearchWhere <> "") ? " show" : " show"; ?>
<div id="fvt_orderlistsrch-search-panel" class="ew-search-panel collapse<?php echo $searchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="vt_order">
	<div class="ew-basic-search">
<div id="xsr_1" class="ew-row d-sm-flex">
	<div class="ew-quick-search input-group">
		<input type="text" name="<?php echo TABLE_BASIC_SEARCH ?>" id="<?php echo TABLE_BASIC_SEARCH ?>" class="form-control" value="<?php echo HtmlEncode($vt_order_list->BasicSearch->getKeyword()) ?>" placeholder="<?php echo HtmlEncode($Language->phrase("Search")) ?>">
		<input type="hidden" name="<?php echo TABLE_BASIC_SEARCH_TYPE ?>" id="<?php echo TABLE_BASIC_SEARCH_TYPE ?>" value="<?php echo HtmlEncode($vt_order_list->BasicSearch->getType()) ?>">
		<div class="input-group-append">
			<button class="btn btn-primary" name="btn-submit" id="btn-submit" type="submit"><?php echo $Language->phrase("SearchBtn") ?></button>
			<button type="button" data-toggle="dropdown" class="btn btn-primary dropdown-toggle dropdown-toggle-split" aria-haspopup="true" aria-expanded="false"><span id="searchtype"><?php echo $vt_order_list->BasicSearch->getTypeNameShort() ?></span></button>
			<div class="dropdown-menu dropdown-menu-right">
				<a class="dropdown-item<?php if ($vt_order_list->BasicSearch->getType() == "") echo " active"; ?>" href="javascript:void(0);" onclick="ew.setSearchType(this)"><?php echo $Language->phrase("QuickSearchAuto") ?></a>
				<a class="dropdown-item<?php if ($vt_order_list->BasicSearch->getType() == "=") echo " active"; ?>" href="javascript:void(0);" onclick="ew.setSearchType(this,'=')"><?php echo $Language->phrase("QuickSearchExact") ?></a>
				<a class="dropdown-item<?php if ($vt_order_list->BasicSearch->getType() == "AND") echo " active"; ?>" href="javascript:void(0);" onclick="ew.setSearchType(this,'AND')"><?php echo $Language->phrase("QuickSearchAll") ?></a>
				<a class="dropdown-item<?php if ($vt_order_list->BasicSearch->getType() == "OR") echo " active"; ?>" href="javascript:void(0);" onclick="ew.setSearchType(this,'OR')"><?php echo $Language->phrase("QuickSearchAny") ?></a>
			</div>
		</div>
	</div>
</div>
	</div>
</div>
</form>
<?php } ?>
<?php } ?>
<?php $vt_order_list->showPageHeader(); ?>
<?php
$vt_order_list->showMessage();
?>
<?php if ($vt_order_list->TotalRecs > 0 || $vt_order->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($vt_order_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> vt_order">
<?php if (!$vt_order->isExport()) { ?>
<div class="card-header ew-grid-upper-panel">
<?php if (!$vt_order->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php if (!isset($vt_order_list->Pager)) $vt_order_list->Pager = new PrevNextPager($vt_order_list->StartRec, $vt_order_list->DisplayRecs, $vt_order_list->TotalRecs, $vt_order_list->AutoHidePager) ?>
<?php if ($vt_order_list->Pager->RecordCount > 0 && $vt_order_list->Pager->Visible) { ?>
<div class="ew-pager">
<span><?php echo $Language->Phrase("Page") ?>&nbsp;</span>
<div class="ew-prev-next"><div class="input-group input-group-sm">
<div class="input-group-prepend">
<!-- first page button -->
	<?php if ($vt_order_list->Pager->FirstButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerFirst") ?>" href="<?php echo $vt_order_list->pageUrl() ?>start=<?php echo $vt_order_list->Pager->FirstButton->Start ?>"><i class="icon-first ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerFirst") ?>"><i class="icon-first ew-icon"></i></a>
	<?php } ?>
<!-- previous page button -->
	<?php if ($vt_order_list->Pager->PrevButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerPrevious") ?>" href="<?php echo $vt_order_list->pageUrl() ?>start=<?php echo $vt_order_list->Pager->PrevButton->Start ?>"><i class="icon-prev ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerPrevious") ?>"><i class="icon-prev ew-icon"></i></a>
	<?php } ?>
</div>
<!-- current page number -->
	<input class="form-control" type="text" name="<?php echo TABLE_PAGE_NO ?>" value="<?php echo $vt_order_list->Pager->CurrentPage ?>">
<div class="input-group-append">
<!-- next page button -->
	<?php if ($vt_order_list->Pager->NextButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerNext") ?>" href="<?php echo $vt_order_list->pageUrl() ?>start=<?php echo $vt_order_list->Pager->NextButton->Start ?>"><i class="icon-next ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerNext") ?>"><i class="icon-next ew-icon"></i></a>
	<?php } ?>
<!-- last page button -->
	<?php if ($vt_order_list->Pager->LastButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerLast") ?>" href="<?php echo $vt_order_list->pageUrl() ?>start=<?php echo $vt_order_list->Pager->LastButton->Start ?>"><i class="icon-last ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerLast") ?>"><i class="icon-last ew-icon"></i></a>
	<?php } ?>
</div>
</div>
</div>
<span>&nbsp;<?php echo $Language->Phrase("of") ?>&nbsp;<?php echo $vt_order_list->Pager->PageCount ?></span>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php if ($vt_order_list->Pager->RecordCount > 0) { ?>
<div class="ew-pager ew-rec">
	<span><?php echo $Language->Phrase("Record") ?>&nbsp;<?php echo $vt_order_list->Pager->FromIndex ?>&nbsp;<?php echo $Language->Phrase("To") ?>&nbsp;<?php echo $vt_order_list->Pager->ToIndex ?>&nbsp;<?php echo $Language->Phrase("Of") ?>&nbsp;<?php echo $vt_order_list->Pager->RecordCount ?></span>
</div>
<?php } ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $vt_order_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
<form name="fvt_orderlist" id="fvt_orderlist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($vt_order_list->CheckToken) { ?>
<input type="hidden" name="<?php echo TOKEN_NAME ?>" value="<?php echo $vt_order_list->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="vt_order">
<input type="hidden" name="exporttype" id="exporttype" value="">
<div id="gmp_vt_order" class="<?php if (IsResponsiveLayout()) { ?>table-responsive <?php } ?>card-body ew-grid-middle-panel">
<?php if ($vt_order_list->TotalRecs > 0 || $vt_order->isGridEdit()) { ?>
<table id="tbl_vt_orderlist" class="table ew-table"><!-- .ew-table ##-->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$vt_order_list->RowType = ROWTYPE_HEADER;

// Render list options
$vt_order_list->renderListOptions();

// Render list options (header, left)
$vt_order_list->ListOptions->render("header", "left");
?>
<?php if ($vt_order->ID_Order->Visible) { // ID_Order ?>
	<?php if ($vt_order->sortUrl($vt_order->ID_Order) == "") { ?>
		<th data-name="ID_Order" class="<?php echo $vt_order->ID_Order->headerCellClass() ?>" style="white-space: nowrap;"><div id="elh_vt_order_ID_Order" class="vt_order_ID_Order"><div class="ew-table-header-caption"><?php echo $vt_order->ID_Order->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="ID_Order" class="<?php echo $vt_order->ID_Order->headerCellClass() ?>" style="white-space: nowrap;"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $vt_order->SortUrl($vt_order->ID_Order) ?>',2);"><div id="elh_vt_order_ID_Order" class="vt_order_ID_Order">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $vt_order->ID_Order->caption() ?></span><span class="ew-table-header-sort"><?php if ($vt_order->ID_Order->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($vt_order->ID_Order->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($vt_order->OrderDate->Visible) { // OrderDate ?>
	<?php if ($vt_order->sortUrl($vt_order->OrderDate) == "") { ?>
		<th data-name="OrderDate" class="<?php echo $vt_order->OrderDate->headerCellClass() ?>" style="white-space: nowrap;"><div id="elh_vt_order_OrderDate" class="vt_order_OrderDate"><div class="ew-table-header-caption"><?php echo $vt_order->OrderDate->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="OrderDate" class="<?php echo $vt_order->OrderDate->headerCellClass() ?>" style="white-space: nowrap;"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $vt_order->SortUrl($vt_order->OrderDate) ?>',2);"><div id="elh_vt_order_OrderDate" class="vt_order_OrderDate">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $vt_order->OrderDate->caption() ?></span><span class="ew-table-header-sort"><?php if ($vt_order->OrderDate->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($vt_order->OrderDate->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($vt_order->Code->Visible) { // Code ?>
	<?php if ($vt_order->sortUrl($vt_order->Code) == "") { ?>
		<th data-name="Code" class="<?php echo $vt_order->Code->headerCellClass() ?>" style="white-space: nowrap;"><div id="elh_vt_order_Code" class="vt_order_Code"><div class="ew-table-header-caption"><?php echo $vt_order->Code->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Code" class="<?php echo $vt_order->Code->headerCellClass() ?>" style="white-space: nowrap;"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $vt_order->SortUrl($vt_order->Code) ?>',2);"><div id="elh_vt_order_Code" class="vt_order_Code">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $vt_order->Code->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($vt_order->Code->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($vt_order->Code->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($vt_order->PCS->Visible) { // PCS ?>
	<?php if ($vt_order->sortUrl($vt_order->PCS) == "") { ?>
		<th data-name="PCS" class="<?php echo $vt_order->PCS->headerCellClass() ?>" style="white-space: nowrap;"><div id="elh_vt_order_PCS" class="vt_order_PCS"><div class="ew-table-header-caption"><?php echo $vt_order->PCS->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="PCS" class="<?php echo $vt_order->PCS->headerCellClass() ?>" style="white-space: nowrap;"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $vt_order->SortUrl($vt_order->PCS) ?>',2);"><div id="elh_vt_order_PCS" class="vt_order_PCS">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $vt_order->PCS->caption() ?></span><span class="ew-table-header-sort"><?php if ($vt_order->PCS->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($vt_order->PCS->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($vt_order->ContactName->Visible) { // ContactName ?>
	<?php if ($vt_order->sortUrl($vt_order->ContactName) == "") { ?>
		<th data-name="ContactName" class="<?php echo $vt_order->ContactName->headerCellClass() ?>" style="white-space: nowrap;"><div id="elh_vt_order_ContactName" class="vt_order_ContactName"><div class="ew-table-header-caption"><?php echo $vt_order->ContactName->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="ContactName" class="<?php echo $vt_order->ContactName->headerCellClass() ?>" style="white-space: nowrap;"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $vt_order->SortUrl($vt_order->ContactName) ?>',2);"><div id="elh_vt_order_ContactName" class="vt_order_ContactName">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $vt_order->ContactName->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($vt_order->ContactName->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($vt_order->ContactName->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($vt_order->Address->Visible) { // Address ?>
	<?php if ($vt_order->sortUrl($vt_order->Address) == "") { ?>
		<th data-name="Address" class="<?php echo $vt_order->Address->headerCellClass() ?>" style="white-space: nowrap;"><div id="elh_vt_order_Address" class="vt_order_Address"><div class="ew-table-header-caption"><?php echo $vt_order->Address->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Address" class="<?php echo $vt_order->Address->headerCellClass() ?>" style="white-space: nowrap;"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $vt_order->SortUrl($vt_order->Address) ?>',2);"><div id="elh_vt_order_Address" class="vt_order_Address">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $vt_order->Address->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($vt_order->Address->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($vt_order->Address->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($vt_order->CompanyName->Visible) { // CompanyName ?>
	<?php if ($vt_order->sortUrl($vt_order->CompanyName) == "") { ?>
		<th data-name="CompanyName" class="<?php echo $vt_order->CompanyName->headerCellClass() ?>" style="white-space: nowrap;"><div id="elh_vt_order_CompanyName" class="vt_order_CompanyName"><div class="ew-table-header-caption"><?php echo $vt_order->CompanyName->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="CompanyName" class="<?php echo $vt_order->CompanyName->headerCellClass() ?>" style="white-space: nowrap;"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $vt_order->SortUrl($vt_order->CompanyName) ?>',2);"><div id="elh_vt_order_CompanyName" class="vt_order_CompanyName">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $vt_order->CompanyName->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($vt_order->CompanyName->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($vt_order->CompanyName->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($vt_order->ContactEmail->Visible) { // ContactEmail ?>
	<?php if ($vt_order->sortUrl($vt_order->ContactEmail) == "") { ?>
		<th data-name="ContactEmail" class="<?php echo $vt_order->ContactEmail->headerCellClass() ?>" style="white-space: nowrap;"><div id="elh_vt_order_ContactEmail" class="vt_order_ContactEmail"><div class="ew-table-header-caption"><?php echo $vt_order->ContactEmail->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="ContactEmail" class="<?php echo $vt_order->ContactEmail->headerCellClass() ?>" style="white-space: nowrap;"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $vt_order->SortUrl($vt_order->ContactEmail) ?>',2);"><div id="elh_vt_order_ContactEmail" class="vt_order_ContactEmail">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $vt_order->ContactEmail->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($vt_order->ContactEmail->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($vt_order->ContactEmail->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($vt_order->ContactPhone->Visible) { // ContactPhone ?>
	<?php if ($vt_order->sortUrl($vt_order->ContactPhone) == "") { ?>
		<th data-name="ContactPhone" class="<?php echo $vt_order->ContactPhone->headerCellClass() ?>" style="white-space: nowrap;"><div id="elh_vt_order_ContactPhone" class="vt_order_ContactPhone"><div class="ew-table-header-caption"><?php echo $vt_order->ContactPhone->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="ContactPhone" class="<?php echo $vt_order->ContactPhone->headerCellClass() ?>" style="white-space: nowrap;"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $vt_order->SortUrl($vt_order->ContactPhone) ?>',2);"><div id="elh_vt_order_ContactPhone" class="vt_order_ContactPhone">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $vt_order->ContactPhone->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($vt_order->ContactPhone->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($vt_order->ContactPhone->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$vt_order_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
if ($vt_order->ExportAll && $vt_order->isExport()) {
	$vt_order_list->StopRec = $vt_order_list->TotalRecs;
} else {

	// Set the last record to display
	if ($vt_order_list->TotalRecs > $vt_order_list->StartRec + $vt_order_list->DisplayRecs - 1)
		$vt_order_list->StopRec = $vt_order_list->StartRec + $vt_order_list->DisplayRecs - 1;
	else
		$vt_order_list->StopRec = $vt_order_list->TotalRecs;
}
$vt_order_list->RecCnt = $vt_order_list->StartRec - 1;
if ($vt_order_list->Recordset && !$vt_order_list->Recordset->EOF) {
	$vt_order_list->Recordset->moveFirst();
	$selectLimit = $vt_order_list->UseSelectLimit;
	if (!$selectLimit && $vt_order_list->StartRec > 1)
		$vt_order_list->Recordset->move($vt_order_list->StartRec - 1);
} elseif (!$vt_order->AllowAddDeleteRow && $vt_order_list->StopRec == 0) {
	$vt_order_list->StopRec = $vt_order->GridAddRowCount;
}

// Initialize aggregate
$vt_order->RowType = ROWTYPE_AGGREGATEINIT;
$vt_order->resetAttributes();
$vt_order_list->renderRow();
while ($vt_order_list->RecCnt < $vt_order_list->StopRec) {
	$vt_order_list->RecCnt++;
	if ($vt_order_list->RecCnt >= $vt_order_list->StartRec) {
		$vt_order_list->RowCnt++;

		// Set up key count
		$vt_order_list->KeyCount = $vt_order_list->RowIndex;

		// Init row class and style
		$vt_order->resetAttributes();
		$vt_order->CssClass = "";
		if ($vt_order->isGridAdd()) {
		} else {
			$vt_order_list->loadRowValues($vt_order_list->Recordset); // Load row values
		}
		$vt_order->RowType = ROWTYPE_VIEW; // Render view

		// Set up row id / data-rowindex
		$vt_order->RowAttrs = array_merge($vt_order->RowAttrs, array('data-rowindex'=>$vt_order_list->RowCnt, 'id'=>'r' . $vt_order_list->RowCnt . '_vt_order', 'data-rowtype'=>$vt_order->RowType));

		// Render row
		$vt_order_list->renderRow();

		// Render list options
		$vt_order_list->renderListOptions();
?>
	<tr<?php echo $vt_order->rowAttributes() ?>>
<?php

// Render list options (body, left)
$vt_order_list->ListOptions->render("body", "left", $vt_order_list->RowCnt);
?>
	<?php if ($vt_order->ID_Order->Visible) { // ID_Order ?>
		<td data-name="ID_Order"<?php echo $vt_order->ID_Order->cellAttributes() ?>>
<span id="el<?php echo $vt_order_list->RowCnt ?>_vt_order_ID_Order" class="vt_order_ID_Order">
<span<?php echo $vt_order->ID_Order->viewAttributes() ?>>
<?php echo $vt_order->ID_Order->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($vt_order->OrderDate->Visible) { // OrderDate ?>
		<td data-name="OrderDate"<?php echo $vt_order->OrderDate->cellAttributes() ?>>
<span id="el<?php echo $vt_order_list->RowCnt ?>_vt_order_OrderDate" class="vt_order_OrderDate">
<span<?php echo $vt_order->OrderDate->viewAttributes() ?>>
<?php echo $vt_order->OrderDate->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($vt_order->Code->Visible) { // Code ?>
		<td data-name="Code"<?php echo $vt_order->Code->cellAttributes() ?>>
<span id="el<?php echo $vt_order_list->RowCnt ?>_vt_order_Code" class="vt_order_Code">
<span<?php echo $vt_order->Code->viewAttributes() ?>>
<?php echo $vt_order->Code->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($vt_order->PCS->Visible) { // PCS ?>
		<td data-name="PCS"<?php echo $vt_order->PCS->cellAttributes() ?>>
<span id="el<?php echo $vt_order_list->RowCnt ?>_vt_order_PCS" class="vt_order_PCS">
<span<?php echo $vt_order->PCS->viewAttributes() ?>>
<?php echo $vt_order->PCS->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($vt_order->ContactName->Visible) { // ContactName ?>
		<td data-name="ContactName"<?php echo $vt_order->ContactName->cellAttributes() ?>>
<span id="el<?php echo $vt_order_list->RowCnt ?>_vt_order_ContactName" class="vt_order_ContactName">
<span<?php echo $vt_order->ContactName->viewAttributes() ?>>
<?php echo $vt_order->ContactName->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($vt_order->Address->Visible) { // Address ?>
		<td data-name="Address"<?php echo $vt_order->Address->cellAttributes() ?>>
<span id="el<?php echo $vt_order_list->RowCnt ?>_vt_order_Address" class="vt_order_Address">
<span<?php echo $vt_order->Address->viewAttributes() ?>>
<?php echo $vt_order->Address->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($vt_order->CompanyName->Visible) { // CompanyName ?>
		<td data-name="CompanyName"<?php echo $vt_order->CompanyName->cellAttributes() ?>>
<span id="el<?php echo $vt_order_list->RowCnt ?>_vt_order_CompanyName" class="vt_order_CompanyName">
<span<?php echo $vt_order->CompanyName->viewAttributes() ?>>
<?php echo $vt_order->CompanyName->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($vt_order->ContactEmail->Visible) { // ContactEmail ?>
		<td data-name="ContactEmail"<?php echo $vt_order->ContactEmail->cellAttributes() ?>>
<span id="el<?php echo $vt_order_list->RowCnt ?>_vt_order_ContactEmail" class="vt_order_ContactEmail">
<span<?php echo $vt_order->ContactEmail->viewAttributes() ?>>
<?php echo $vt_order->ContactEmail->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($vt_order->ContactPhone->Visible) { // ContactPhone ?>
		<td data-name="ContactPhone"<?php echo $vt_order->ContactPhone->cellAttributes() ?>>
<span id="el<?php echo $vt_order_list->RowCnt ?>_vt_order_ContactPhone" class="vt_order_ContactPhone">
<span<?php echo $vt_order->ContactPhone->viewAttributes() ?>>
<?php echo $vt_order->ContactPhone->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$vt_order_list->ListOptions->render("body", "right", $vt_order_list->RowCnt);
?>
	</tr>
<?php
	}
	if (!$vt_order->isGridAdd())
		$vt_order_list->Recordset->moveNext();
}
?>
</tbody>
</table><!-- /.ew-table -->
<?php } ?>
<?php if (!$vt_order->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</div><!-- /.ew-grid-middle-panel -->
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($vt_order_list->Recordset)
	$vt_order_list->Recordset->Close();
?>
<?php if (!$vt_order->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$vt_order->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php if (!isset($vt_order_list->Pager)) $vt_order_list->Pager = new PrevNextPager($vt_order_list->StartRec, $vt_order_list->DisplayRecs, $vt_order_list->TotalRecs, $vt_order_list->AutoHidePager) ?>
<?php if ($vt_order_list->Pager->RecordCount > 0 && $vt_order_list->Pager->Visible) { ?>
<div class="ew-pager">
<span><?php echo $Language->Phrase("Page") ?>&nbsp;</span>
<div class="ew-prev-next"><div class="input-group input-group-sm">
<div class="input-group-prepend">
<!-- first page button -->
	<?php if ($vt_order_list->Pager->FirstButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerFirst") ?>" href="<?php echo $vt_order_list->pageUrl() ?>start=<?php echo $vt_order_list->Pager->FirstButton->Start ?>"><i class="icon-first ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerFirst") ?>"><i class="icon-first ew-icon"></i></a>
	<?php } ?>
<!-- previous page button -->
	<?php if ($vt_order_list->Pager->PrevButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerPrevious") ?>" href="<?php echo $vt_order_list->pageUrl() ?>start=<?php echo $vt_order_list->Pager->PrevButton->Start ?>"><i class="icon-prev ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerPrevious") ?>"><i class="icon-prev ew-icon"></i></a>
	<?php } ?>
</div>
<!-- current page number -->
	<input class="form-control" type="text" name="<?php echo TABLE_PAGE_NO ?>" value="<?php echo $vt_order_list->Pager->CurrentPage ?>">
<div class="input-group-append">
<!-- next page button -->
	<?php if ($vt_order_list->Pager->NextButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerNext") ?>" href="<?php echo $vt_order_list->pageUrl() ?>start=<?php echo $vt_order_list->Pager->NextButton->Start ?>"><i class="icon-next ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerNext") ?>"><i class="icon-next ew-icon"></i></a>
	<?php } ?>
<!-- last page button -->
	<?php if ($vt_order_list->Pager->LastButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerLast") ?>" href="<?php echo $vt_order_list->pageUrl() ?>start=<?php echo $vt_order_list->Pager->LastButton->Start ?>"><i class="icon-last ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerLast") ?>"><i class="icon-last ew-icon"></i></a>
	<?php } ?>
</div>
</div>
</div>
<span>&nbsp;<?php echo $Language->Phrase("of") ?>&nbsp;<?php echo $vt_order_list->Pager->PageCount ?></span>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php if ($vt_order_list->Pager->RecordCount > 0) { ?>
<div class="ew-pager ew-rec">
	<span><?php echo $Language->Phrase("Record") ?>&nbsp;<?php echo $vt_order_list->Pager->FromIndex ?>&nbsp;<?php echo $Language->Phrase("To") ?>&nbsp;<?php echo $vt_order_list->Pager->ToIndex ?>&nbsp;<?php echo $Language->Phrase("Of") ?>&nbsp;<?php echo $vt_order_list->Pager->RecordCount ?></span>
</div>
<?php } ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $vt_order_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($vt_order_list->TotalRecs == 0 && !$vt_order->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $vt_order_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$vt_order_list->showPageFooter();
if (DEBUG_ENABLED)
	echo GetDebugMessage();
?>
<?php if (!$vt_order->isExport()) { ?>
<script>

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php } ?>
<?php include_once "footer.php" ?>
<?php
$vt_order_list->terminate();
?>