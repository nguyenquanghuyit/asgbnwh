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
$vworder_packing_list = new vworder_packing_list();

// Run the page
$vworder_packing_list->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$vworder_packing_list->Page_Render();
?>
<?php include_once "header.php" ?>
<?php if (!$vworder_packing->isExport()) { ?>
<script>

// Form object
currentPageID = ew.PAGE_ID = "list";
var fvworder_packinglist = currentForm = new ew.Form("fvworder_packinglist", "list");
fvworder_packinglist.formKeyCountName = '<?php echo $vworder_packing_list->FormKeyCountName ?>';

// Form_CustomValidate event
fvworder_packinglist.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

	// Your custom validation code here, return false if invalid.
	return true;
}

// Use JavaScript validation or not
fvworder_packinglist.validateRequired = <?php echo json_encode(CLIENT_VALIDATE) ?>;

// Dynamic selection lists
// Form object for search

var fvworder_packinglistsrch = currentSearchForm = new ew.Form("fvworder_packinglistsrch");

// Filters
fvworder_packinglistsrch.filterList = <?php echo $vworder_packing_list->getFilterList() ?>;
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
<?php if (!$vworder_packing->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($vworder_packing_list->TotalRecs > 0 && $vworder_packing_list->ExportOptions->visible()) { ?>
<?php $vworder_packing_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($vworder_packing_list->ImportOptions->visible()) { ?>
<?php $vworder_packing_list->ImportOptions->render("body") ?>
<?php } ?>
<?php if ($vworder_packing_list->SearchOptions->visible()) { ?>
<?php $vworder_packing_list->SearchOptions->render("body") ?>
<?php } ?>
<?php if ($vworder_packing_list->FilterOptions->visible()) { ?>
<?php $vworder_packing_list->FilterOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php
$vworder_packing_list->renderOtherOptions();
?>
<?php if ($Security->CanSearch()) { ?>
<?php if (!$vworder_packing->isExport() && !$vworder_packing->CurrentAction) { ?>
<form name="fvworder_packinglistsrch" id="fvworder_packinglistsrch" class="form-inline ew-form ew-ext-search-form" action="<?php echo CurrentPageName() ?>">
<?php $searchPanelClass = ($vworder_packing_list->SearchWhere <> "") ? " show" : " show"; ?>
<div id="fvworder_packinglistsrch-search-panel" class="ew-search-panel collapse<?php echo $searchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="vworder_packing">
	<div class="ew-basic-search">
<div id="xsr_1" class="ew-row d-sm-flex">
	<div class="ew-quick-search input-group">
		<input type="text" name="<?php echo TABLE_BASIC_SEARCH ?>" id="<?php echo TABLE_BASIC_SEARCH ?>" class="form-control" value="<?php echo HtmlEncode($vworder_packing_list->BasicSearch->getKeyword()) ?>" placeholder="<?php echo HtmlEncode($Language->phrase("Search")) ?>">
		<input type="hidden" name="<?php echo TABLE_BASIC_SEARCH_TYPE ?>" id="<?php echo TABLE_BASIC_SEARCH_TYPE ?>" value="<?php echo HtmlEncode($vworder_packing_list->BasicSearch->getType()) ?>">
		<div class="input-group-append">
			<button class="btn btn-primary" name="btn-submit" id="btn-submit" type="submit"><?php echo $Language->phrase("SearchBtn") ?></button>
			<button type="button" data-toggle="dropdown" class="btn btn-primary dropdown-toggle dropdown-toggle-split" aria-haspopup="true" aria-expanded="false"><span id="searchtype"><?php echo $vworder_packing_list->BasicSearch->getTypeNameShort() ?></span></button>
			<div class="dropdown-menu dropdown-menu-right">
				<a class="dropdown-item<?php if ($vworder_packing_list->BasicSearch->getType() == "") echo " active"; ?>" href="javascript:void(0);" onclick="ew.setSearchType(this)"><?php echo $Language->phrase("QuickSearchAuto") ?></a>
				<a class="dropdown-item<?php if ($vworder_packing_list->BasicSearch->getType() == "=") echo " active"; ?>" href="javascript:void(0);" onclick="ew.setSearchType(this,'=')"><?php echo $Language->phrase("QuickSearchExact") ?></a>
				<a class="dropdown-item<?php if ($vworder_packing_list->BasicSearch->getType() == "AND") echo " active"; ?>" href="javascript:void(0);" onclick="ew.setSearchType(this,'AND')"><?php echo $Language->phrase("QuickSearchAll") ?></a>
				<a class="dropdown-item<?php if ($vworder_packing_list->BasicSearch->getType() == "OR") echo " active"; ?>" href="javascript:void(0);" onclick="ew.setSearchType(this,'OR')"><?php echo $Language->phrase("QuickSearchAny") ?></a>
			</div>
		</div>
	</div>
</div>
	</div>
</div>
</form>
<?php } ?>
<?php } ?>
<?php $vworder_packing_list->showPageHeader(); ?>
<?php
$vworder_packing_list->showMessage();
?>
<?php if ($vworder_packing_list->TotalRecs > 0 || $vworder_packing->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($vworder_packing_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> vworder_packing">
<?php if (!$vworder_packing->isExport()) { ?>
<div class="card-header ew-grid-upper-panel">
<?php if (!$vworder_packing->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php if (!isset($vworder_packing_list->Pager)) $vworder_packing_list->Pager = new PrevNextPager($vworder_packing_list->StartRec, $vworder_packing_list->DisplayRecs, $vworder_packing_list->TotalRecs, $vworder_packing_list->AutoHidePager) ?>
<?php if ($vworder_packing_list->Pager->RecordCount > 0 && $vworder_packing_list->Pager->Visible) { ?>
<div class="ew-pager">
<span><?php echo $Language->Phrase("Page") ?>&nbsp;</span>
<div class="ew-prev-next"><div class="input-group input-group-sm">
<div class="input-group-prepend">
<!-- first page button -->
	<?php if ($vworder_packing_list->Pager->FirstButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerFirst") ?>" href="<?php echo $vworder_packing_list->pageUrl() ?>start=<?php echo $vworder_packing_list->Pager->FirstButton->Start ?>"><i class="icon-first ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerFirst") ?>"><i class="icon-first ew-icon"></i></a>
	<?php } ?>
<!-- previous page button -->
	<?php if ($vworder_packing_list->Pager->PrevButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerPrevious") ?>" href="<?php echo $vworder_packing_list->pageUrl() ?>start=<?php echo $vworder_packing_list->Pager->PrevButton->Start ?>"><i class="icon-prev ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerPrevious") ?>"><i class="icon-prev ew-icon"></i></a>
	<?php } ?>
</div>
<!-- current page number -->
	<input class="form-control" type="text" name="<?php echo TABLE_PAGE_NO ?>" value="<?php echo $vworder_packing_list->Pager->CurrentPage ?>">
<div class="input-group-append">
<!-- next page button -->
	<?php if ($vworder_packing_list->Pager->NextButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerNext") ?>" href="<?php echo $vworder_packing_list->pageUrl() ?>start=<?php echo $vworder_packing_list->Pager->NextButton->Start ?>"><i class="icon-next ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerNext") ?>"><i class="icon-next ew-icon"></i></a>
	<?php } ?>
<!-- last page button -->
	<?php if ($vworder_packing_list->Pager->LastButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerLast") ?>" href="<?php echo $vworder_packing_list->pageUrl() ?>start=<?php echo $vworder_packing_list->Pager->LastButton->Start ?>"><i class="icon-last ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerLast") ?>"><i class="icon-last ew-icon"></i></a>
	<?php } ?>
</div>
</div>
</div>
<span>&nbsp;<?php echo $Language->Phrase("of") ?>&nbsp;<?php echo $vworder_packing_list->Pager->PageCount ?></span>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php if ($vworder_packing_list->Pager->RecordCount > 0) { ?>
<div class="ew-pager ew-rec">
	<span><?php echo $Language->Phrase("Record") ?>&nbsp;<?php echo $vworder_packing_list->Pager->FromIndex ?>&nbsp;<?php echo $Language->Phrase("To") ?>&nbsp;<?php echo $vworder_packing_list->Pager->ToIndex ?>&nbsp;<?php echo $Language->Phrase("Of") ?>&nbsp;<?php echo $vworder_packing_list->Pager->RecordCount ?></span>
</div>
<?php } ?>
<?php if ($vworder_packing_list->TotalRecs > 0 && (!$vworder_packing_list->AutoHidePageSizeSelector || $vworder_packing_list->Pager->Visible)) { ?>
<div class="ew-pager">
<input type="hidden" name="t" value="vworder_packing">
<select name="<?php echo TABLE_REC_PER_PAGE ?>" class="form-control form-control-sm ew-tooltip" title="<?php echo $Language->phrase("RecordsPerPage") ?>" onchange="this.form.submit();">
<option value="20"<?php if ($vworder_packing_list->DisplayRecs == 20) { ?> selected<?php } ?>>20</option>
<option value="50"<?php if ($vworder_packing_list->DisplayRecs == 50) { ?> selected<?php } ?>>50</option>
<option value="100"<?php if ($vworder_packing_list->DisplayRecs == 100) { ?> selected<?php } ?>>100</option>
<option value="200"<?php if ($vworder_packing_list->DisplayRecs == 200) { ?> selected<?php } ?>>200</option>
<option value="500"<?php if ($vworder_packing_list->DisplayRecs == 500) { ?> selected<?php } ?>>500</option>
<option value="ALL"<?php if ($vworder_packing->getRecordsPerPage() == -1) { ?> selected<?php } ?>><?php echo $Language->Phrase("AllRecords") ?></option>
</select>
</div>
<?php } ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $vworder_packing_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
<form name="fvworder_packinglist" id="fvworder_packinglist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($vworder_packing_list->CheckToken) { ?>
<input type="hidden" name="<?php echo TOKEN_NAME ?>" value="<?php echo $vworder_packing_list->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="vworder_packing">
<input type="hidden" name="exporttype" id="exporttype" value="">
<div id="gmp_vworder_packing" class="<?php if (IsResponsiveLayout()) { ?>table-responsive <?php } ?>card-body ew-grid-middle-panel">
<?php if ($vworder_packing_list->TotalRecs > 0 || $vworder_packing->isGridEdit()) { ?>
<table id="tbl_vworder_packinglist" class="table ew-table"><!-- .ew-table ##-->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$vworder_packing_list->RowType = ROWTYPE_HEADER;

// Render list options
$vworder_packing_list->renderListOptions();

// Render list options (header, left)
$vworder_packing_list->ListOptions->render("header", "left");
?>
<?php if ($vworder_packing->ID_Order->Visible) { // ID_Order ?>
	<?php if ($vworder_packing->sortUrl($vworder_packing->ID_Order) == "") { ?>
		<th data-name="ID_Order" class="<?php echo $vworder_packing->ID_Order->headerCellClass() ?>" style="white-space: nowrap;"><div id="elh_vworder_packing_ID_Order" class="vworder_packing_ID_Order"><div class="ew-table-header-caption"><?php echo $vworder_packing->ID_Order->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="ID_Order" class="<?php echo $vworder_packing->ID_Order->headerCellClass() ?>" style="white-space: nowrap;"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $vworder_packing->SortUrl($vworder_packing->ID_Order) ?>',2);"><div id="elh_vworder_packing_ID_Order" class="vworder_packing_ID_Order">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $vworder_packing->ID_Order->caption() ?></span><span class="ew-table-header-sort"><?php if ($vworder_packing->ID_Order->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($vworder_packing->ID_Order->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($vworder_packing->OrderDate->Visible) { // OrderDate ?>
	<?php if ($vworder_packing->sortUrl($vworder_packing->OrderDate) == "") { ?>
		<th data-name="OrderDate" class="<?php echo $vworder_packing->OrderDate->headerCellClass() ?>" style="white-space: nowrap;"><div id="elh_vworder_packing_OrderDate" class="vworder_packing_OrderDate"><div class="ew-table-header-caption"><?php echo $vworder_packing->OrderDate->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="OrderDate" class="<?php echo $vworder_packing->OrderDate->headerCellClass() ?>" style="white-space: nowrap;"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $vworder_packing->SortUrl($vworder_packing->OrderDate) ?>',2);"><div id="elh_vworder_packing_OrderDate" class="vworder_packing_OrderDate">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $vworder_packing->OrderDate->caption() ?></span><span class="ew-table-header-sort"><?php if ($vworder_packing->OrderDate->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($vworder_packing->OrderDate->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($vworder_packing->ID_Contact->Visible) { // ID_Contact ?>
	<?php if ($vworder_packing->sortUrl($vworder_packing->ID_Contact) == "") { ?>
		<th data-name="ID_Contact" class="<?php echo $vworder_packing->ID_Contact->headerCellClass() ?>" style="white-space: nowrap;"><div id="elh_vworder_packing_ID_Contact" class="vworder_packing_ID_Contact"><div class="ew-table-header-caption"><?php echo $vworder_packing->ID_Contact->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="ID_Contact" class="<?php echo $vworder_packing->ID_Contact->headerCellClass() ?>" style="white-space: nowrap;"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $vworder_packing->SortUrl($vworder_packing->ID_Contact) ?>',2);"><div id="elh_vworder_packing_ID_Contact" class="vworder_packing_ID_Contact">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $vworder_packing->ID_Contact->caption() ?></span><span class="ew-table-header-sort"><?php if ($vworder_packing->ID_Contact->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($vworder_packing->ID_Contact->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($vworder_packing->StatusLoad->Visible) { // StatusLoad ?>
	<?php if ($vworder_packing->sortUrl($vworder_packing->StatusLoad) == "") { ?>
		<th data-name="StatusLoad" class="<?php echo $vworder_packing->StatusLoad->headerCellClass() ?>" style="white-space: nowrap;"><div id="elh_vworder_packing_StatusLoad" class="vworder_packing_StatusLoad"><div class="ew-table-header-caption"><?php echo $vworder_packing->StatusLoad->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="StatusLoad" class="<?php echo $vworder_packing->StatusLoad->headerCellClass() ?>" style="white-space: nowrap;"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $vworder_packing->SortUrl($vworder_packing->StatusLoad) ?>',2);"><div id="elh_vworder_packing_StatusLoad" class="vworder_packing_StatusLoad">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $vworder_packing->StatusLoad->caption() ?></span><span class="ew-table-header-sort"><?php if ($vworder_packing->StatusLoad->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($vworder_packing->StatusLoad->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($vworder_packing->StatusFinishOrder->Visible) { // StatusFinishOrder ?>
	<?php if ($vworder_packing->sortUrl($vworder_packing->StatusFinishOrder) == "") { ?>
		<th data-name="StatusFinishOrder" class="<?php echo $vworder_packing->StatusFinishOrder->headerCellClass() ?>" style="white-space: nowrap;"><div id="elh_vworder_packing_StatusFinishOrder" class="vworder_packing_StatusFinishOrder"><div class="ew-table-header-caption"><?php echo $vworder_packing->StatusFinishOrder->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="StatusFinishOrder" class="<?php echo $vworder_packing->StatusFinishOrder->headerCellClass() ?>" style="white-space: nowrap;"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $vworder_packing->SortUrl($vworder_packing->StatusFinishOrder) ?>',2);"><div id="elh_vworder_packing_StatusFinishOrder" class="vworder_packing_StatusFinishOrder">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $vworder_packing->StatusFinishOrder->caption() ?></span><span class="ew-table-header-sort"><?php if ($vworder_packing->StatusFinishOrder->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($vworder_packing->StatusFinishOrder->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($vworder_packing->DateTimefinishOrder->Visible) { // DateTimefinishOrder ?>
	<?php if ($vworder_packing->sortUrl($vworder_packing->DateTimefinishOrder) == "") { ?>
		<th data-name="DateTimefinishOrder" class="<?php echo $vworder_packing->DateTimefinishOrder->headerCellClass() ?>" style="white-space: nowrap;"><div id="elh_vworder_packing_DateTimefinishOrder" class="vworder_packing_DateTimefinishOrder"><div class="ew-table-header-caption"><?php echo $vworder_packing->DateTimefinishOrder->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="DateTimefinishOrder" class="<?php echo $vworder_packing->DateTimefinishOrder->headerCellClass() ?>" style="white-space: nowrap;"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $vworder_packing->SortUrl($vworder_packing->DateTimefinishOrder) ?>',2);"><div id="elh_vworder_packing_DateTimefinishOrder" class="vworder_packing_DateTimefinishOrder">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $vworder_packing->DateTimefinishOrder->caption() ?></span><span class="ew-table-header-sort"><?php if ($vworder_packing->DateTimefinishOrder->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($vworder_packing->DateTimefinishOrder->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($vworder_packing->CusomterOrderNo->Visible) { // CusomterOrderNo ?>
	<?php if ($vworder_packing->sortUrl($vworder_packing->CusomterOrderNo) == "") { ?>
		<th data-name="CusomterOrderNo" class="<?php echo $vworder_packing->CusomterOrderNo->headerCellClass() ?>" style="white-space: nowrap;"><div id="elh_vworder_packing_CusomterOrderNo" class="vworder_packing_CusomterOrderNo"><div class="ew-table-header-caption"><?php echo $vworder_packing->CusomterOrderNo->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="CusomterOrderNo" class="<?php echo $vworder_packing->CusomterOrderNo->headerCellClass() ?>" style="white-space: nowrap;"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $vworder_packing->SortUrl($vworder_packing->CusomterOrderNo) ?>',2);"><div id="elh_vworder_packing_CusomterOrderNo" class="vworder_packing_CusomterOrderNo">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $vworder_packing->CusomterOrderNo->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($vworder_packing->CusomterOrderNo->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($vworder_packing->CusomterOrderNo->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($vworder_packing->InvoiceNo->Visible) { // InvoiceNo ?>
	<?php if ($vworder_packing->sortUrl($vworder_packing->InvoiceNo) == "") { ?>
		<th data-name="InvoiceNo" class="<?php echo $vworder_packing->InvoiceNo->headerCellClass() ?>" style="white-space: nowrap;"><div id="elh_vworder_packing_InvoiceNo" class="vworder_packing_InvoiceNo"><div class="ew-table-header-caption"><?php echo $vworder_packing->InvoiceNo->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="InvoiceNo" class="<?php echo $vworder_packing->InvoiceNo->headerCellClass() ?>" style="white-space: nowrap;"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $vworder_packing->SortUrl($vworder_packing->InvoiceNo) ?>',2);"><div id="elh_vworder_packing_InvoiceNo" class="vworder_packing_InvoiceNo">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $vworder_packing->InvoiceNo->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($vworder_packing->InvoiceNo->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($vworder_packing->InvoiceNo->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$vworder_packing_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
if ($vworder_packing->ExportAll && $vworder_packing->isExport()) {
	$vworder_packing_list->StopRec = $vworder_packing_list->TotalRecs;
} else {

	// Set the last record to display
	if ($vworder_packing_list->TotalRecs > $vworder_packing_list->StartRec + $vworder_packing_list->DisplayRecs - 1)
		$vworder_packing_list->StopRec = $vworder_packing_list->StartRec + $vworder_packing_list->DisplayRecs - 1;
	else
		$vworder_packing_list->StopRec = $vworder_packing_list->TotalRecs;
}
$vworder_packing_list->RecCnt = $vworder_packing_list->StartRec - 1;
if ($vworder_packing_list->Recordset && !$vworder_packing_list->Recordset->EOF) {
	$vworder_packing_list->Recordset->moveFirst();
	$selectLimit = $vworder_packing_list->UseSelectLimit;
	if (!$selectLimit && $vworder_packing_list->StartRec > 1)
		$vworder_packing_list->Recordset->move($vworder_packing_list->StartRec - 1);
} elseif (!$vworder_packing->AllowAddDeleteRow && $vworder_packing_list->StopRec == 0) {
	$vworder_packing_list->StopRec = $vworder_packing->GridAddRowCount;
}

// Initialize aggregate
$vworder_packing->RowType = ROWTYPE_AGGREGATEINIT;
$vworder_packing->resetAttributes();
$vworder_packing_list->renderRow();
while ($vworder_packing_list->RecCnt < $vworder_packing_list->StopRec) {
	$vworder_packing_list->RecCnt++;
	if ($vworder_packing_list->RecCnt >= $vworder_packing_list->StartRec) {
		$vworder_packing_list->RowCnt++;

		// Set up key count
		$vworder_packing_list->KeyCount = $vworder_packing_list->RowIndex;

		// Init row class and style
		$vworder_packing->resetAttributes();
		$vworder_packing->CssClass = "";
		if ($vworder_packing->isGridAdd()) {
		} else {
			$vworder_packing_list->loadRowValues($vworder_packing_list->Recordset); // Load row values
		}
		$vworder_packing->RowType = ROWTYPE_VIEW; // Render view

		// Set up row id / data-rowindex
		$vworder_packing->RowAttrs = array_merge($vworder_packing->RowAttrs, array('data-rowindex'=>$vworder_packing_list->RowCnt, 'id'=>'r' . $vworder_packing_list->RowCnt . '_vworder_packing', 'data-rowtype'=>$vworder_packing->RowType));

		// Render row
		$vworder_packing_list->renderRow();

		// Render list options
		$vworder_packing_list->renderListOptions();
?>
	<tr<?php echo $vworder_packing->rowAttributes() ?>>
<?php

// Render list options (body, left)
$vworder_packing_list->ListOptions->render("body", "left", $vworder_packing_list->RowCnt);
?>
	<?php if ($vworder_packing->ID_Order->Visible) { // ID_Order ?>
		<td data-name="ID_Order"<?php echo $vworder_packing->ID_Order->cellAttributes() ?>>
<span id="el<?php echo $vworder_packing_list->RowCnt ?>_vworder_packing_ID_Order" class="vworder_packing_ID_Order">
<span<?php echo $vworder_packing->ID_Order->viewAttributes() ?>>
<?php echo $vworder_packing->ID_Order->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($vworder_packing->OrderDate->Visible) { // OrderDate ?>
		<td data-name="OrderDate"<?php echo $vworder_packing->OrderDate->cellAttributes() ?>>
<span id="el<?php echo $vworder_packing_list->RowCnt ?>_vworder_packing_OrderDate" class="vworder_packing_OrderDate">
<span<?php echo $vworder_packing->OrderDate->viewAttributes() ?>>
<?php echo $vworder_packing->OrderDate->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($vworder_packing->ID_Contact->Visible) { // ID_Contact ?>
		<td data-name="ID_Contact"<?php echo $vworder_packing->ID_Contact->cellAttributes() ?>>
<span id="el<?php echo $vworder_packing_list->RowCnt ?>_vworder_packing_ID_Contact" class="vworder_packing_ID_Contact">
<span<?php echo $vworder_packing->ID_Contact->viewAttributes() ?>>
<?php echo $vworder_packing->ID_Contact->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($vworder_packing->StatusLoad->Visible) { // StatusLoad ?>
		<td data-name="StatusLoad"<?php echo $vworder_packing->StatusLoad->cellAttributes() ?>>
<span id="el<?php echo $vworder_packing_list->RowCnt ?>_vworder_packing_StatusLoad" class="vworder_packing_StatusLoad">
<span<?php echo $vworder_packing->StatusLoad->viewAttributes() ?>>
<?php echo $vworder_packing->StatusLoad->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($vworder_packing->StatusFinishOrder->Visible) { // StatusFinishOrder ?>
		<td data-name="StatusFinishOrder"<?php echo $vworder_packing->StatusFinishOrder->cellAttributes() ?>>
<span id="el<?php echo $vworder_packing_list->RowCnt ?>_vworder_packing_StatusFinishOrder" class="vworder_packing_StatusFinishOrder">
<span<?php echo $vworder_packing->StatusFinishOrder->viewAttributes() ?>>
<?php echo $vworder_packing->StatusFinishOrder->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($vworder_packing->DateTimefinishOrder->Visible) { // DateTimefinishOrder ?>
		<td data-name="DateTimefinishOrder"<?php echo $vworder_packing->DateTimefinishOrder->cellAttributes() ?>>
<span id="el<?php echo $vworder_packing_list->RowCnt ?>_vworder_packing_DateTimefinishOrder" class="vworder_packing_DateTimefinishOrder">
<span<?php echo $vworder_packing->DateTimefinishOrder->viewAttributes() ?>>
<?php echo $vworder_packing->DateTimefinishOrder->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($vworder_packing->CusomterOrderNo->Visible) { // CusomterOrderNo ?>
		<td data-name="CusomterOrderNo"<?php echo $vworder_packing->CusomterOrderNo->cellAttributes() ?>>
<span id="el<?php echo $vworder_packing_list->RowCnt ?>_vworder_packing_CusomterOrderNo" class="vworder_packing_CusomterOrderNo">
<span<?php echo $vworder_packing->CusomterOrderNo->viewAttributes() ?>>
<?php echo $vworder_packing->CusomterOrderNo->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($vworder_packing->InvoiceNo->Visible) { // InvoiceNo ?>
		<td data-name="InvoiceNo"<?php echo $vworder_packing->InvoiceNo->cellAttributes() ?>>
<span id="el<?php echo $vworder_packing_list->RowCnt ?>_vworder_packing_InvoiceNo" class="vworder_packing_InvoiceNo">
<span<?php echo $vworder_packing->InvoiceNo->viewAttributes() ?>>
<?php echo $vworder_packing->InvoiceNo->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$vworder_packing_list->ListOptions->render("body", "right", $vworder_packing_list->RowCnt);
?>
	</tr>
<?php
	}
	if (!$vworder_packing->isGridAdd())
		$vworder_packing_list->Recordset->moveNext();
}
?>
</tbody>
</table><!-- /.ew-table -->
<?php } ?>
<?php if (!$vworder_packing->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</div><!-- /.ew-grid-middle-panel -->
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($vworder_packing_list->Recordset)
	$vworder_packing_list->Recordset->Close();
?>
<?php if (!$vworder_packing->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$vworder_packing->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php if (!isset($vworder_packing_list->Pager)) $vworder_packing_list->Pager = new PrevNextPager($vworder_packing_list->StartRec, $vworder_packing_list->DisplayRecs, $vworder_packing_list->TotalRecs, $vworder_packing_list->AutoHidePager) ?>
<?php if ($vworder_packing_list->Pager->RecordCount > 0 && $vworder_packing_list->Pager->Visible) { ?>
<div class="ew-pager">
<span><?php echo $Language->Phrase("Page") ?>&nbsp;</span>
<div class="ew-prev-next"><div class="input-group input-group-sm">
<div class="input-group-prepend">
<!-- first page button -->
	<?php if ($vworder_packing_list->Pager->FirstButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerFirst") ?>" href="<?php echo $vworder_packing_list->pageUrl() ?>start=<?php echo $vworder_packing_list->Pager->FirstButton->Start ?>"><i class="icon-first ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerFirst") ?>"><i class="icon-first ew-icon"></i></a>
	<?php } ?>
<!-- previous page button -->
	<?php if ($vworder_packing_list->Pager->PrevButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerPrevious") ?>" href="<?php echo $vworder_packing_list->pageUrl() ?>start=<?php echo $vworder_packing_list->Pager->PrevButton->Start ?>"><i class="icon-prev ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerPrevious") ?>"><i class="icon-prev ew-icon"></i></a>
	<?php } ?>
</div>
<!-- current page number -->
	<input class="form-control" type="text" name="<?php echo TABLE_PAGE_NO ?>" value="<?php echo $vworder_packing_list->Pager->CurrentPage ?>">
<div class="input-group-append">
<!-- next page button -->
	<?php if ($vworder_packing_list->Pager->NextButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerNext") ?>" href="<?php echo $vworder_packing_list->pageUrl() ?>start=<?php echo $vworder_packing_list->Pager->NextButton->Start ?>"><i class="icon-next ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerNext") ?>"><i class="icon-next ew-icon"></i></a>
	<?php } ?>
<!-- last page button -->
	<?php if ($vworder_packing_list->Pager->LastButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerLast") ?>" href="<?php echo $vworder_packing_list->pageUrl() ?>start=<?php echo $vworder_packing_list->Pager->LastButton->Start ?>"><i class="icon-last ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerLast") ?>"><i class="icon-last ew-icon"></i></a>
	<?php } ?>
</div>
</div>
</div>
<span>&nbsp;<?php echo $Language->Phrase("of") ?>&nbsp;<?php echo $vworder_packing_list->Pager->PageCount ?></span>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php if ($vworder_packing_list->Pager->RecordCount > 0) { ?>
<div class="ew-pager ew-rec">
	<span><?php echo $Language->Phrase("Record") ?>&nbsp;<?php echo $vworder_packing_list->Pager->FromIndex ?>&nbsp;<?php echo $Language->Phrase("To") ?>&nbsp;<?php echo $vworder_packing_list->Pager->ToIndex ?>&nbsp;<?php echo $Language->Phrase("Of") ?>&nbsp;<?php echo $vworder_packing_list->Pager->RecordCount ?></span>
</div>
<?php } ?>
<?php if ($vworder_packing_list->TotalRecs > 0 && (!$vworder_packing_list->AutoHidePageSizeSelector || $vworder_packing_list->Pager->Visible)) { ?>
<div class="ew-pager">
<input type="hidden" name="t" value="vworder_packing">
<select name="<?php echo TABLE_REC_PER_PAGE ?>" class="form-control form-control-sm ew-tooltip" title="<?php echo $Language->phrase("RecordsPerPage") ?>" onchange="this.form.submit();">
<option value="20"<?php if ($vworder_packing_list->DisplayRecs == 20) { ?> selected<?php } ?>>20</option>
<option value="50"<?php if ($vworder_packing_list->DisplayRecs == 50) { ?> selected<?php } ?>>50</option>
<option value="100"<?php if ($vworder_packing_list->DisplayRecs == 100) { ?> selected<?php } ?>>100</option>
<option value="200"<?php if ($vworder_packing_list->DisplayRecs == 200) { ?> selected<?php } ?>>200</option>
<option value="500"<?php if ($vworder_packing_list->DisplayRecs == 500) { ?> selected<?php } ?>>500</option>
<option value="ALL"<?php if ($vworder_packing->getRecordsPerPage() == -1) { ?> selected<?php } ?>><?php echo $Language->Phrase("AllRecords") ?></option>
</select>
</div>
<?php } ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $vworder_packing_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($vworder_packing_list->TotalRecs == 0 && !$vworder_packing->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $vworder_packing_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$vworder_packing_list->showPageFooter();
if (DEBUG_ENABLED)
	echo GetDebugMessage();
?>
<?php if (!$vworder_packing->isExport()) { ?>
<script>

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php } ?>
<?php include_once "footer.php" ?>
<?php
$vworder_packing_list->terminate();
?>