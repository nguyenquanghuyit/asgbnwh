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
$vworder_not_route_list = new vworder_not_route_list();

// Run the page
$vworder_not_route_list->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$vworder_not_route_list->Page_Render();
?>
<?php include_once "header.php" ?>
<?php if (!$vworder_not_route->isExport()) { ?>
<script>

// Form object
currentPageID = ew.PAGE_ID = "list";
var fvworder_not_routelist = currentForm = new ew.Form("fvworder_not_routelist", "list");
fvworder_not_routelist.formKeyCountName = '<?php echo $vworder_not_route_list->FormKeyCountName ?>';

// Form_CustomValidate event
fvworder_not_routelist.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

	// Your custom validation code here, return false if invalid.
	return true;
}

// Use JavaScript validation or not
fvworder_not_routelist.validateRequired = <?php echo json_encode(CLIENT_VALIDATE) ?>;

// Dynamic selection lists
// Form object for search

var fvworder_not_routelistsrch = currentSearchForm = new ew.Form("fvworder_not_routelistsrch");

// Filters
fvworder_not_routelistsrch.filterList = <?php echo $vworder_not_route_list->getFilterList() ?>;
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
<?php if (!$vworder_not_route->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($vworder_not_route_list->TotalRecs > 0 && $vworder_not_route_list->ExportOptions->visible()) { ?>
<?php $vworder_not_route_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($vworder_not_route_list->ImportOptions->visible()) { ?>
<?php $vworder_not_route_list->ImportOptions->render("body") ?>
<?php } ?>
<?php if ($vworder_not_route_list->SearchOptions->visible()) { ?>
<?php $vworder_not_route_list->SearchOptions->render("body") ?>
<?php } ?>
<?php if ($vworder_not_route_list->FilterOptions->visible()) { ?>
<?php $vworder_not_route_list->FilterOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php
$vworder_not_route_list->renderOtherOptions();
?>
<?php if ($Security->CanSearch()) { ?>
<?php if (!$vworder_not_route->isExport() && !$vworder_not_route->CurrentAction) { ?>
<form name="fvworder_not_routelistsrch" id="fvworder_not_routelistsrch" class="form-inline ew-form ew-ext-search-form" action="<?php echo CurrentPageName() ?>">
<?php $searchPanelClass = ($vworder_not_route_list->SearchWhere <> "") ? " show" : " show"; ?>
<div id="fvworder_not_routelistsrch-search-panel" class="ew-search-panel collapse<?php echo $searchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="vworder_not_route">
	<div class="ew-basic-search">
<div id="xsr_1" class="ew-row d-sm-flex">
	<div class="ew-quick-search input-group">
		<input type="text" name="<?php echo TABLE_BASIC_SEARCH ?>" id="<?php echo TABLE_BASIC_SEARCH ?>" class="form-control" value="<?php echo HtmlEncode($vworder_not_route_list->BasicSearch->getKeyword()) ?>" placeholder="<?php echo HtmlEncode($Language->phrase("Search")) ?>">
		<input type="hidden" name="<?php echo TABLE_BASIC_SEARCH_TYPE ?>" id="<?php echo TABLE_BASIC_SEARCH_TYPE ?>" value="<?php echo HtmlEncode($vworder_not_route_list->BasicSearch->getType()) ?>">
		<div class="input-group-append">
			<button class="btn btn-primary" name="btn-submit" id="btn-submit" type="submit"><?php echo $Language->phrase("SearchBtn") ?></button>
			<button type="button" data-toggle="dropdown" class="btn btn-primary dropdown-toggle dropdown-toggle-split" aria-haspopup="true" aria-expanded="false"><span id="searchtype"><?php echo $vworder_not_route_list->BasicSearch->getTypeNameShort() ?></span></button>
			<div class="dropdown-menu dropdown-menu-right">
				<a class="dropdown-item<?php if ($vworder_not_route_list->BasicSearch->getType() == "") echo " active"; ?>" href="javascript:void(0);" onclick="ew.setSearchType(this)"><?php echo $Language->phrase("QuickSearchAuto") ?></a>
				<a class="dropdown-item<?php if ($vworder_not_route_list->BasicSearch->getType() == "=") echo " active"; ?>" href="javascript:void(0);" onclick="ew.setSearchType(this,'=')"><?php echo $Language->phrase("QuickSearchExact") ?></a>
				<a class="dropdown-item<?php if ($vworder_not_route_list->BasicSearch->getType() == "AND") echo " active"; ?>" href="javascript:void(0);" onclick="ew.setSearchType(this,'AND')"><?php echo $Language->phrase("QuickSearchAll") ?></a>
				<a class="dropdown-item<?php if ($vworder_not_route_list->BasicSearch->getType() == "OR") echo " active"; ?>" href="javascript:void(0);" onclick="ew.setSearchType(this,'OR')"><?php echo $Language->phrase("QuickSearchAny") ?></a>
			</div>
		</div>
	</div>
</div>
	</div>
</div>
</form>
<?php } ?>
<?php } ?>
<?php $vworder_not_route_list->showPageHeader(); ?>
<?php
$vworder_not_route_list->showMessage();
?>
<?php if ($vworder_not_route_list->TotalRecs > 0 || $vworder_not_route->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($vworder_not_route_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> vworder_not_route">
<?php if (!$vworder_not_route->isExport()) { ?>
<div class="card-header ew-grid-upper-panel">
<?php if (!$vworder_not_route->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php if (!isset($vworder_not_route_list->Pager)) $vworder_not_route_list->Pager = new PrevNextPager($vworder_not_route_list->StartRec, $vworder_not_route_list->DisplayRecs, $vworder_not_route_list->TotalRecs, $vworder_not_route_list->AutoHidePager) ?>
<?php if ($vworder_not_route_list->Pager->RecordCount > 0 && $vworder_not_route_list->Pager->Visible) { ?>
<div class="ew-pager">
<span><?php echo $Language->Phrase("Page") ?>&nbsp;</span>
<div class="ew-prev-next"><div class="input-group input-group-sm">
<div class="input-group-prepend">
<!-- first page button -->
	<?php if ($vworder_not_route_list->Pager->FirstButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerFirst") ?>" href="<?php echo $vworder_not_route_list->pageUrl() ?>start=<?php echo $vworder_not_route_list->Pager->FirstButton->Start ?>"><i class="icon-first ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerFirst") ?>"><i class="icon-first ew-icon"></i></a>
	<?php } ?>
<!-- previous page button -->
	<?php if ($vworder_not_route_list->Pager->PrevButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerPrevious") ?>" href="<?php echo $vworder_not_route_list->pageUrl() ?>start=<?php echo $vworder_not_route_list->Pager->PrevButton->Start ?>"><i class="icon-prev ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerPrevious") ?>"><i class="icon-prev ew-icon"></i></a>
	<?php } ?>
</div>
<!-- current page number -->
	<input class="form-control" type="text" name="<?php echo TABLE_PAGE_NO ?>" value="<?php echo $vworder_not_route_list->Pager->CurrentPage ?>">
<div class="input-group-append">
<!-- next page button -->
	<?php if ($vworder_not_route_list->Pager->NextButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerNext") ?>" href="<?php echo $vworder_not_route_list->pageUrl() ?>start=<?php echo $vworder_not_route_list->Pager->NextButton->Start ?>"><i class="icon-next ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerNext") ?>"><i class="icon-next ew-icon"></i></a>
	<?php } ?>
<!-- last page button -->
	<?php if ($vworder_not_route_list->Pager->LastButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerLast") ?>" href="<?php echo $vworder_not_route_list->pageUrl() ?>start=<?php echo $vworder_not_route_list->Pager->LastButton->Start ?>"><i class="icon-last ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerLast") ?>"><i class="icon-last ew-icon"></i></a>
	<?php } ?>
</div>
</div>
</div>
<span>&nbsp;<?php echo $Language->Phrase("of") ?>&nbsp;<?php echo $vworder_not_route_list->Pager->PageCount ?></span>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php if ($vworder_not_route_list->Pager->RecordCount > 0) { ?>
<div class="ew-pager ew-rec">
	<span><?php echo $Language->Phrase("Record") ?>&nbsp;<?php echo $vworder_not_route_list->Pager->FromIndex ?>&nbsp;<?php echo $Language->Phrase("To") ?>&nbsp;<?php echo $vworder_not_route_list->Pager->ToIndex ?>&nbsp;<?php echo $Language->Phrase("Of") ?>&nbsp;<?php echo $vworder_not_route_list->Pager->RecordCount ?></span>
</div>
<?php } ?>
<?php if ($vworder_not_route_list->TotalRecs > 0 && (!$vworder_not_route_list->AutoHidePageSizeSelector || $vworder_not_route_list->Pager->Visible)) { ?>
<div class="ew-pager">
<input type="hidden" name="t" value="vworder_not_route">
<select name="<?php echo TABLE_REC_PER_PAGE ?>" class="form-control form-control-sm ew-tooltip" title="<?php echo $Language->phrase("RecordsPerPage") ?>" onchange="this.form.submit();">
<option value="20"<?php if ($vworder_not_route_list->DisplayRecs == 20) { ?> selected<?php } ?>>20</option>
<option value="50"<?php if ($vworder_not_route_list->DisplayRecs == 50) { ?> selected<?php } ?>>50</option>
<option value="100"<?php if ($vworder_not_route_list->DisplayRecs == 100) { ?> selected<?php } ?>>100</option>
<option value="200"<?php if ($vworder_not_route_list->DisplayRecs == 200) { ?> selected<?php } ?>>200</option>
<option value="500"<?php if ($vworder_not_route_list->DisplayRecs == 500) { ?> selected<?php } ?>>500</option>
<option value="ALL"<?php if ($vworder_not_route->getRecordsPerPage() == -1) { ?> selected<?php } ?>><?php echo $Language->Phrase("AllRecords") ?></option>
</select>
</div>
<?php } ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $vworder_not_route_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
<form name="fvworder_not_routelist" id="fvworder_not_routelist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($vworder_not_route_list->CheckToken) { ?>
<input type="hidden" name="<?php echo TOKEN_NAME ?>" value="<?php echo $vworder_not_route_list->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="vworder_not_route">
<input type="hidden" name="exporttype" id="exporttype" value="">
<div id="gmp_vworder_not_route" class="<?php if (IsResponsiveLayout()) { ?>table-responsive <?php } ?>card-body ew-grid-middle-panel">
<?php if ($vworder_not_route_list->TotalRecs > 0 || $vworder_not_route->isGridEdit()) { ?>
<table id="tbl_vworder_not_routelist" class="table ew-table"><!-- .ew-table ##-->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$vworder_not_route_list->RowType = ROWTYPE_HEADER;

// Render list options
$vworder_not_route_list->renderListOptions();

// Render list options (header, left)
$vworder_not_route_list->ListOptions->render("header", "left");
?>
<?php if ($vworder_not_route->ID_Order->Visible) { // ID_Order ?>
	<?php if ($vworder_not_route->sortUrl($vworder_not_route->ID_Order) == "") { ?>
		<th data-name="ID_Order" class="<?php echo $vworder_not_route->ID_Order->headerCellClass() ?>"><div id="elh_vworder_not_route_ID_Order" class="vworder_not_route_ID_Order"><div class="ew-table-header-caption"><?php echo $vworder_not_route->ID_Order->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="ID_Order" class="<?php echo $vworder_not_route->ID_Order->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $vworder_not_route->SortUrl($vworder_not_route->ID_Order) ?>',2);"><div id="elh_vworder_not_route_ID_Order" class="vworder_not_route_ID_Order">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $vworder_not_route->ID_Order->caption() ?></span><span class="ew-table-header-sort"><?php if ($vworder_not_route->ID_Order->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($vworder_not_route->ID_Order->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($vworder_not_route->CusomterOrderNo->Visible) { // CusomterOrderNo ?>
	<?php if ($vworder_not_route->sortUrl($vworder_not_route->CusomterOrderNo) == "") { ?>
		<th data-name="CusomterOrderNo" class="<?php echo $vworder_not_route->CusomterOrderNo->headerCellClass() ?>"><div id="elh_vworder_not_route_CusomterOrderNo" class="vworder_not_route_CusomterOrderNo"><div class="ew-table-header-caption"><?php echo $vworder_not_route->CusomterOrderNo->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="CusomterOrderNo" class="<?php echo $vworder_not_route->CusomterOrderNo->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $vworder_not_route->SortUrl($vworder_not_route->CusomterOrderNo) ?>',2);"><div id="elh_vworder_not_route_CusomterOrderNo" class="vworder_not_route_CusomterOrderNo">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $vworder_not_route->CusomterOrderNo->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($vworder_not_route->CusomterOrderNo->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($vworder_not_route->CusomterOrderNo->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$vworder_not_route_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
if ($vworder_not_route->ExportAll && $vworder_not_route->isExport()) {
	$vworder_not_route_list->StopRec = $vworder_not_route_list->TotalRecs;
} else {

	// Set the last record to display
	if ($vworder_not_route_list->TotalRecs > $vworder_not_route_list->StartRec + $vworder_not_route_list->DisplayRecs - 1)
		$vworder_not_route_list->StopRec = $vworder_not_route_list->StartRec + $vworder_not_route_list->DisplayRecs - 1;
	else
		$vworder_not_route_list->StopRec = $vworder_not_route_list->TotalRecs;
}
$vworder_not_route_list->RecCnt = $vworder_not_route_list->StartRec - 1;
if ($vworder_not_route_list->Recordset && !$vworder_not_route_list->Recordset->EOF) {
	$vworder_not_route_list->Recordset->moveFirst();
	$selectLimit = $vworder_not_route_list->UseSelectLimit;
	if (!$selectLimit && $vworder_not_route_list->StartRec > 1)
		$vworder_not_route_list->Recordset->move($vworder_not_route_list->StartRec - 1);
} elseif (!$vworder_not_route->AllowAddDeleteRow && $vworder_not_route_list->StopRec == 0) {
	$vworder_not_route_list->StopRec = $vworder_not_route->GridAddRowCount;
}

// Initialize aggregate
$vworder_not_route->RowType = ROWTYPE_AGGREGATEINIT;
$vworder_not_route->resetAttributes();
$vworder_not_route_list->renderRow();
while ($vworder_not_route_list->RecCnt < $vworder_not_route_list->StopRec) {
	$vworder_not_route_list->RecCnt++;
	if ($vworder_not_route_list->RecCnt >= $vworder_not_route_list->StartRec) {
		$vworder_not_route_list->RowCnt++;

		// Set up key count
		$vworder_not_route_list->KeyCount = $vworder_not_route_list->RowIndex;

		// Init row class and style
		$vworder_not_route->resetAttributes();
		$vworder_not_route->CssClass = "";
		if ($vworder_not_route->isGridAdd()) {
		} else {
			$vworder_not_route_list->loadRowValues($vworder_not_route_list->Recordset); // Load row values
		}
		$vworder_not_route->RowType = ROWTYPE_VIEW; // Render view

		// Set up row id / data-rowindex
		$vworder_not_route->RowAttrs = array_merge($vworder_not_route->RowAttrs, array('data-rowindex'=>$vworder_not_route_list->RowCnt, 'id'=>'r' . $vworder_not_route_list->RowCnt . '_vworder_not_route', 'data-rowtype'=>$vworder_not_route->RowType));

		// Render row
		$vworder_not_route_list->renderRow();

		// Render list options
		$vworder_not_route_list->renderListOptions();
?>
	<tr<?php echo $vworder_not_route->rowAttributes() ?>>
<?php

// Render list options (body, left)
$vworder_not_route_list->ListOptions->render("body", "left", $vworder_not_route_list->RowCnt);
?>
	<?php if ($vworder_not_route->ID_Order->Visible) { // ID_Order ?>
		<td data-name="ID_Order"<?php echo $vworder_not_route->ID_Order->cellAttributes() ?>>
<span id="el<?php echo $vworder_not_route_list->RowCnt ?>_vworder_not_route_ID_Order" class="vworder_not_route_ID_Order">
<span<?php echo $vworder_not_route->ID_Order->viewAttributes() ?>>
<?php echo $vworder_not_route->ID_Order->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($vworder_not_route->CusomterOrderNo->Visible) { // CusomterOrderNo ?>
		<td data-name="CusomterOrderNo"<?php echo $vworder_not_route->CusomterOrderNo->cellAttributes() ?>>
<span id="el<?php echo $vworder_not_route_list->RowCnt ?>_vworder_not_route_CusomterOrderNo" class="vworder_not_route_CusomterOrderNo">
<span<?php echo $vworder_not_route->CusomterOrderNo->viewAttributes() ?>>
<?php echo $vworder_not_route->CusomterOrderNo->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$vworder_not_route_list->ListOptions->render("body", "right", $vworder_not_route_list->RowCnt);
?>
	</tr>
<?php
	}
	if (!$vworder_not_route->isGridAdd())
		$vworder_not_route_list->Recordset->moveNext();
}
?>
</tbody>
</table><!-- /.ew-table -->
<?php } ?>
<?php if (!$vworder_not_route->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</div><!-- /.ew-grid-middle-panel -->
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($vworder_not_route_list->Recordset)
	$vworder_not_route_list->Recordset->Close();
?>
<?php if (!$vworder_not_route->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$vworder_not_route->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php if (!isset($vworder_not_route_list->Pager)) $vworder_not_route_list->Pager = new PrevNextPager($vworder_not_route_list->StartRec, $vworder_not_route_list->DisplayRecs, $vworder_not_route_list->TotalRecs, $vworder_not_route_list->AutoHidePager) ?>
<?php if ($vworder_not_route_list->Pager->RecordCount > 0 && $vworder_not_route_list->Pager->Visible) { ?>
<div class="ew-pager">
<span><?php echo $Language->Phrase("Page") ?>&nbsp;</span>
<div class="ew-prev-next"><div class="input-group input-group-sm">
<div class="input-group-prepend">
<!-- first page button -->
	<?php if ($vworder_not_route_list->Pager->FirstButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerFirst") ?>" href="<?php echo $vworder_not_route_list->pageUrl() ?>start=<?php echo $vworder_not_route_list->Pager->FirstButton->Start ?>"><i class="icon-first ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerFirst") ?>"><i class="icon-first ew-icon"></i></a>
	<?php } ?>
<!-- previous page button -->
	<?php if ($vworder_not_route_list->Pager->PrevButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerPrevious") ?>" href="<?php echo $vworder_not_route_list->pageUrl() ?>start=<?php echo $vworder_not_route_list->Pager->PrevButton->Start ?>"><i class="icon-prev ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerPrevious") ?>"><i class="icon-prev ew-icon"></i></a>
	<?php } ?>
</div>
<!-- current page number -->
	<input class="form-control" type="text" name="<?php echo TABLE_PAGE_NO ?>" value="<?php echo $vworder_not_route_list->Pager->CurrentPage ?>">
<div class="input-group-append">
<!-- next page button -->
	<?php if ($vworder_not_route_list->Pager->NextButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerNext") ?>" href="<?php echo $vworder_not_route_list->pageUrl() ?>start=<?php echo $vworder_not_route_list->Pager->NextButton->Start ?>"><i class="icon-next ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerNext") ?>"><i class="icon-next ew-icon"></i></a>
	<?php } ?>
<!-- last page button -->
	<?php if ($vworder_not_route_list->Pager->LastButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerLast") ?>" href="<?php echo $vworder_not_route_list->pageUrl() ?>start=<?php echo $vworder_not_route_list->Pager->LastButton->Start ?>"><i class="icon-last ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerLast") ?>"><i class="icon-last ew-icon"></i></a>
	<?php } ?>
</div>
</div>
</div>
<span>&nbsp;<?php echo $Language->Phrase("of") ?>&nbsp;<?php echo $vworder_not_route_list->Pager->PageCount ?></span>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php if ($vworder_not_route_list->Pager->RecordCount > 0) { ?>
<div class="ew-pager ew-rec">
	<span><?php echo $Language->Phrase("Record") ?>&nbsp;<?php echo $vworder_not_route_list->Pager->FromIndex ?>&nbsp;<?php echo $Language->Phrase("To") ?>&nbsp;<?php echo $vworder_not_route_list->Pager->ToIndex ?>&nbsp;<?php echo $Language->Phrase("Of") ?>&nbsp;<?php echo $vworder_not_route_list->Pager->RecordCount ?></span>
</div>
<?php } ?>
<?php if ($vworder_not_route_list->TotalRecs > 0 && (!$vworder_not_route_list->AutoHidePageSizeSelector || $vworder_not_route_list->Pager->Visible)) { ?>
<div class="ew-pager">
<input type="hidden" name="t" value="vworder_not_route">
<select name="<?php echo TABLE_REC_PER_PAGE ?>" class="form-control form-control-sm ew-tooltip" title="<?php echo $Language->phrase("RecordsPerPage") ?>" onchange="this.form.submit();">
<option value="20"<?php if ($vworder_not_route_list->DisplayRecs == 20) { ?> selected<?php } ?>>20</option>
<option value="50"<?php if ($vworder_not_route_list->DisplayRecs == 50) { ?> selected<?php } ?>>50</option>
<option value="100"<?php if ($vworder_not_route_list->DisplayRecs == 100) { ?> selected<?php } ?>>100</option>
<option value="200"<?php if ($vworder_not_route_list->DisplayRecs == 200) { ?> selected<?php } ?>>200</option>
<option value="500"<?php if ($vworder_not_route_list->DisplayRecs == 500) { ?> selected<?php } ?>>500</option>
<option value="ALL"<?php if ($vworder_not_route->getRecordsPerPage() == -1) { ?> selected<?php } ?>><?php echo $Language->Phrase("AllRecords") ?></option>
</select>
</div>
<?php } ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $vworder_not_route_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($vworder_not_route_list->TotalRecs == 0 && !$vworder_not_route->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $vworder_not_route_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$vworder_not_route_list->showPageFooter();
if (DEBUG_ENABLED)
	echo GetDebugMessage();
?>
<?php if (!$vworder_not_route->isExport()) { ?>
<script>

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php } ?>
<?php include_once "footer.php" ?>
<?php
$vworder_not_route_list->terminate();
?>