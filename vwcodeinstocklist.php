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
$vwcodeinstock_list = new vwcodeinstock_list();

// Run the page
$vwcodeinstock_list->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$vwcodeinstock_list->Page_Render();
?>
<?php include_once "header.php" ?>
<?php if (!$vwcodeinstock->isExport()) { ?>
<script>

// Form object
currentPageID = ew.PAGE_ID = "list";
var fvwcodeinstocklist = currentForm = new ew.Form("fvwcodeinstocklist", "list");
fvwcodeinstocklist.formKeyCountName = '<?php echo $vwcodeinstock_list->FormKeyCountName ?>';

// Form_CustomValidate event
fvwcodeinstocklist.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

	// Your custom validation code here, return false if invalid.
	return true;
}

// Use JavaScript validation or not
fvwcodeinstocklist.validateRequired = <?php echo json_encode(CLIENT_VALIDATE) ?>;

// Dynamic selection lists
// Form object for search

var fvwcodeinstocklistsrch = currentSearchForm = new ew.Form("fvwcodeinstocklistsrch");

// Filters
fvwcodeinstocklistsrch.filterList = <?php echo $vwcodeinstock_list->getFilterList() ?>;
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
<?php if (!$vwcodeinstock->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($vwcodeinstock_list->TotalRecs > 0 && $vwcodeinstock_list->ExportOptions->visible()) { ?>
<?php $vwcodeinstock_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($vwcodeinstock_list->ImportOptions->visible()) { ?>
<?php $vwcodeinstock_list->ImportOptions->render("body") ?>
<?php } ?>
<?php if ($vwcodeinstock_list->SearchOptions->visible()) { ?>
<?php $vwcodeinstock_list->SearchOptions->render("body") ?>
<?php } ?>
<?php if ($vwcodeinstock_list->FilterOptions->visible()) { ?>
<?php $vwcodeinstock_list->FilterOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php
$vwcodeinstock_list->renderOtherOptions();
?>
<?php if ($Security->CanSearch()) { ?>
<?php if (!$vwcodeinstock->isExport() && !$vwcodeinstock->CurrentAction) { ?>
<form name="fvwcodeinstocklistsrch" id="fvwcodeinstocklistsrch" class="form-inline ew-form ew-ext-search-form" action="<?php echo CurrentPageName() ?>">
<?php $searchPanelClass = ($vwcodeinstock_list->SearchWhere <> "") ? " show" : " show"; ?>
<div id="fvwcodeinstocklistsrch-search-panel" class="ew-search-panel collapse<?php echo $searchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="vwcodeinstock">
	<div class="ew-basic-search">
<div id="xsr_1" class="ew-row d-sm-flex">
	<div class="ew-quick-search input-group">
		<input type="text" name="<?php echo TABLE_BASIC_SEARCH ?>" id="<?php echo TABLE_BASIC_SEARCH ?>" class="form-control" value="<?php echo HtmlEncode($vwcodeinstock_list->BasicSearch->getKeyword()) ?>" placeholder="<?php echo HtmlEncode($Language->phrase("Search")) ?>">
		<input type="hidden" name="<?php echo TABLE_BASIC_SEARCH_TYPE ?>" id="<?php echo TABLE_BASIC_SEARCH_TYPE ?>" value="<?php echo HtmlEncode($vwcodeinstock_list->BasicSearch->getType()) ?>">
		<div class="input-group-append">
			<button class="btn btn-primary" name="btn-submit" id="btn-submit" type="submit"><?php echo $Language->phrase("SearchBtn") ?></button>
			<button type="button" data-toggle="dropdown" class="btn btn-primary dropdown-toggle dropdown-toggle-split" aria-haspopup="true" aria-expanded="false"><span id="searchtype"><?php echo $vwcodeinstock_list->BasicSearch->getTypeNameShort() ?></span></button>
			<div class="dropdown-menu dropdown-menu-right">
				<a class="dropdown-item<?php if ($vwcodeinstock_list->BasicSearch->getType() == "") echo " active"; ?>" href="javascript:void(0);" onclick="ew.setSearchType(this)"><?php echo $Language->phrase("QuickSearchAuto") ?></a>
				<a class="dropdown-item<?php if ($vwcodeinstock_list->BasicSearch->getType() == "=") echo " active"; ?>" href="javascript:void(0);" onclick="ew.setSearchType(this,'=')"><?php echo $Language->phrase("QuickSearchExact") ?></a>
				<a class="dropdown-item<?php if ($vwcodeinstock_list->BasicSearch->getType() == "AND") echo " active"; ?>" href="javascript:void(0);" onclick="ew.setSearchType(this,'AND')"><?php echo $Language->phrase("QuickSearchAll") ?></a>
				<a class="dropdown-item<?php if ($vwcodeinstock_list->BasicSearch->getType() == "OR") echo " active"; ?>" href="javascript:void(0);" onclick="ew.setSearchType(this,'OR')"><?php echo $Language->phrase("QuickSearchAny") ?></a>
			</div>
		</div>
	</div>
</div>
	</div>
</div>
</form>
<?php } ?>
<?php } ?>
<?php $vwcodeinstock_list->showPageHeader(); ?>
<?php
$vwcodeinstock_list->showMessage();
?>
<?php if ($vwcodeinstock_list->TotalRecs > 0 || $vwcodeinstock->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($vwcodeinstock_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> vwcodeinstock">
<?php if (!$vwcodeinstock->isExport()) { ?>
<div class="card-header ew-grid-upper-panel">
<?php if (!$vwcodeinstock->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php if (!isset($vwcodeinstock_list->Pager)) $vwcodeinstock_list->Pager = new PrevNextPager($vwcodeinstock_list->StartRec, $vwcodeinstock_list->DisplayRecs, $vwcodeinstock_list->TotalRecs, $vwcodeinstock_list->AutoHidePager) ?>
<?php if ($vwcodeinstock_list->Pager->RecordCount > 0 && $vwcodeinstock_list->Pager->Visible) { ?>
<div class="ew-pager">
<span><?php echo $Language->Phrase("Page") ?>&nbsp;</span>
<div class="ew-prev-next"><div class="input-group input-group-sm">
<div class="input-group-prepend">
<!-- first page button -->
	<?php if ($vwcodeinstock_list->Pager->FirstButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerFirst") ?>" href="<?php echo $vwcodeinstock_list->pageUrl() ?>start=<?php echo $vwcodeinstock_list->Pager->FirstButton->Start ?>"><i class="icon-first ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerFirst") ?>"><i class="icon-first ew-icon"></i></a>
	<?php } ?>
<!-- previous page button -->
	<?php if ($vwcodeinstock_list->Pager->PrevButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerPrevious") ?>" href="<?php echo $vwcodeinstock_list->pageUrl() ?>start=<?php echo $vwcodeinstock_list->Pager->PrevButton->Start ?>"><i class="icon-prev ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerPrevious") ?>"><i class="icon-prev ew-icon"></i></a>
	<?php } ?>
</div>
<!-- current page number -->
	<input class="form-control" type="text" name="<?php echo TABLE_PAGE_NO ?>" value="<?php echo $vwcodeinstock_list->Pager->CurrentPage ?>">
<div class="input-group-append">
<!-- next page button -->
	<?php if ($vwcodeinstock_list->Pager->NextButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerNext") ?>" href="<?php echo $vwcodeinstock_list->pageUrl() ?>start=<?php echo $vwcodeinstock_list->Pager->NextButton->Start ?>"><i class="icon-next ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerNext") ?>"><i class="icon-next ew-icon"></i></a>
	<?php } ?>
<!-- last page button -->
	<?php if ($vwcodeinstock_list->Pager->LastButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerLast") ?>" href="<?php echo $vwcodeinstock_list->pageUrl() ?>start=<?php echo $vwcodeinstock_list->Pager->LastButton->Start ?>"><i class="icon-last ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerLast") ?>"><i class="icon-last ew-icon"></i></a>
	<?php } ?>
</div>
</div>
</div>
<span>&nbsp;<?php echo $Language->Phrase("of") ?>&nbsp;<?php echo $vwcodeinstock_list->Pager->PageCount ?></span>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php if ($vwcodeinstock_list->Pager->RecordCount > 0) { ?>
<div class="ew-pager ew-rec">
	<span><?php echo $Language->Phrase("Record") ?>&nbsp;<?php echo $vwcodeinstock_list->Pager->FromIndex ?>&nbsp;<?php echo $Language->Phrase("To") ?>&nbsp;<?php echo $vwcodeinstock_list->Pager->ToIndex ?>&nbsp;<?php echo $Language->Phrase("Of") ?>&nbsp;<?php echo $vwcodeinstock_list->Pager->RecordCount ?></span>
</div>
<?php } ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $vwcodeinstock_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
<form name="fvwcodeinstocklist" id="fvwcodeinstocklist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($vwcodeinstock_list->CheckToken) { ?>
<input type="hidden" name="<?php echo TOKEN_NAME ?>" value="<?php echo $vwcodeinstock_list->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="vwcodeinstock">
<div id="gmp_vwcodeinstock" class="<?php if (IsResponsiveLayout()) { ?>table-responsive <?php } ?>card-body ew-grid-middle-panel">
<?php if ($vwcodeinstock_list->TotalRecs > 0 || $vwcodeinstock->isGridEdit()) { ?>
<table id="tbl_vwcodeinstocklist" class="table ew-table"><!-- .ew-table ##-->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$vwcodeinstock_list->RowType = ROWTYPE_HEADER;

// Render list options
$vwcodeinstock_list->renderListOptions();

// Render list options (header, left)
$vwcodeinstock_list->ListOptions->render("header", "left");
?>
<?php if ($vwcodeinstock->Code->Visible) { // Code ?>
	<?php if ($vwcodeinstock->sortUrl($vwcodeinstock->Code) == "") { ?>
		<th data-name="Code" class="<?php echo $vwcodeinstock->Code->headerCellClass() ?>"><div id="elh_vwcodeinstock_Code" class="vwcodeinstock_Code"><div class="ew-table-header-caption"><?php echo $vwcodeinstock->Code->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Code" class="<?php echo $vwcodeinstock->Code->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $vwcodeinstock->SortUrl($vwcodeinstock->Code) ?>',2);"><div id="elh_vwcodeinstock_Code" class="vwcodeinstock_Code">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $vwcodeinstock->Code->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($vwcodeinstock->Code->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($vwcodeinstock->Code->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($vwcodeinstock->PCS->Visible) { // PCS ?>
	<?php if ($vwcodeinstock->sortUrl($vwcodeinstock->PCS) == "") { ?>
		<th data-name="PCS" class="<?php echo $vwcodeinstock->PCS->headerCellClass() ?>"><div id="elh_vwcodeinstock_PCS" class="vwcodeinstock_PCS"><div class="ew-table-header-caption"><?php echo $vwcodeinstock->PCS->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="PCS" class="<?php echo $vwcodeinstock->PCS->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $vwcodeinstock->SortUrl($vwcodeinstock->PCS) ?>',2);"><div id="elh_vwcodeinstock_PCS" class="vwcodeinstock_PCS">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $vwcodeinstock->PCS->caption() ?></span><span class="ew-table-header-sort"><?php if ($vwcodeinstock->PCS->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($vwcodeinstock->PCS->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($vwcodeinstock->ProductName->Visible) { // ProductName ?>
	<?php if ($vwcodeinstock->sortUrl($vwcodeinstock->ProductName) == "") { ?>
		<th data-name="ProductName" class="<?php echo $vwcodeinstock->ProductName->headerCellClass() ?>"><div id="elh_vwcodeinstock_ProductName" class="vwcodeinstock_ProductName"><div class="ew-table-header-caption"><?php echo $vwcodeinstock->ProductName->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="ProductName" class="<?php echo $vwcodeinstock->ProductName->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $vwcodeinstock->SortUrl($vwcodeinstock->ProductName) ?>',2);"><div id="elh_vwcodeinstock_ProductName" class="vwcodeinstock_ProductName">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $vwcodeinstock->ProductName->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($vwcodeinstock->ProductName->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($vwcodeinstock->ProductName->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($vwcodeinstock->Product->Visible) { // Product ?>
	<?php if ($vwcodeinstock->sortUrl($vwcodeinstock->Product) == "") { ?>
		<th data-name="Product" class="<?php echo $vwcodeinstock->Product->headerCellClass() ?>"><div id="elh_vwcodeinstock_Product" class="vwcodeinstock_Product"><div class="ew-table-header-caption"><?php echo $vwcodeinstock->Product->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Product" class="<?php echo $vwcodeinstock->Product->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $vwcodeinstock->SortUrl($vwcodeinstock->Product) ?>',2);"><div id="elh_vwcodeinstock_Product" class="vwcodeinstock_Product">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $vwcodeinstock->Product->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($vwcodeinstock->Product->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($vwcodeinstock->Product->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$vwcodeinstock_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
if ($vwcodeinstock->ExportAll && $vwcodeinstock->isExport()) {
	$vwcodeinstock_list->StopRec = $vwcodeinstock_list->TotalRecs;
} else {

	// Set the last record to display
	if ($vwcodeinstock_list->TotalRecs > $vwcodeinstock_list->StartRec + $vwcodeinstock_list->DisplayRecs - 1)
		$vwcodeinstock_list->StopRec = $vwcodeinstock_list->StartRec + $vwcodeinstock_list->DisplayRecs - 1;
	else
		$vwcodeinstock_list->StopRec = $vwcodeinstock_list->TotalRecs;
}
$vwcodeinstock_list->RecCnt = $vwcodeinstock_list->StartRec - 1;
if ($vwcodeinstock_list->Recordset && !$vwcodeinstock_list->Recordset->EOF) {
	$vwcodeinstock_list->Recordset->moveFirst();
	$selectLimit = $vwcodeinstock_list->UseSelectLimit;
	if (!$selectLimit && $vwcodeinstock_list->StartRec > 1)
		$vwcodeinstock_list->Recordset->move($vwcodeinstock_list->StartRec - 1);
} elseif (!$vwcodeinstock->AllowAddDeleteRow && $vwcodeinstock_list->StopRec == 0) {
	$vwcodeinstock_list->StopRec = $vwcodeinstock->GridAddRowCount;
}

// Initialize aggregate
$vwcodeinstock->RowType = ROWTYPE_AGGREGATEINIT;
$vwcodeinstock->resetAttributes();
$vwcodeinstock_list->renderRow();
while ($vwcodeinstock_list->RecCnt < $vwcodeinstock_list->StopRec) {
	$vwcodeinstock_list->RecCnt++;
	if ($vwcodeinstock_list->RecCnt >= $vwcodeinstock_list->StartRec) {
		$vwcodeinstock_list->RowCnt++;

		// Set up key count
		$vwcodeinstock_list->KeyCount = $vwcodeinstock_list->RowIndex;

		// Init row class and style
		$vwcodeinstock->resetAttributes();
		$vwcodeinstock->CssClass = "";
		if ($vwcodeinstock->isGridAdd()) {
		} else {
			$vwcodeinstock_list->loadRowValues($vwcodeinstock_list->Recordset); // Load row values
		}
		$vwcodeinstock->RowType = ROWTYPE_VIEW; // Render view

		// Set up row id / data-rowindex
		$vwcodeinstock->RowAttrs = array_merge($vwcodeinstock->RowAttrs, array('data-rowindex'=>$vwcodeinstock_list->RowCnt, 'id'=>'r' . $vwcodeinstock_list->RowCnt . '_vwcodeinstock', 'data-rowtype'=>$vwcodeinstock->RowType));

		// Render row
		$vwcodeinstock_list->renderRow();

		// Render list options
		$vwcodeinstock_list->renderListOptions();
?>
	<tr<?php echo $vwcodeinstock->rowAttributes() ?>>
<?php

// Render list options (body, left)
$vwcodeinstock_list->ListOptions->render("body", "left", $vwcodeinstock_list->RowCnt);
?>
	<?php if ($vwcodeinstock->Code->Visible) { // Code ?>
		<td data-name="Code"<?php echo $vwcodeinstock->Code->cellAttributes() ?>>
<span id="el<?php echo $vwcodeinstock_list->RowCnt ?>_vwcodeinstock_Code" class="vwcodeinstock_Code">
<span<?php echo $vwcodeinstock->Code->viewAttributes() ?>>
<?php echo $vwcodeinstock->Code->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($vwcodeinstock->PCS->Visible) { // PCS ?>
		<td data-name="PCS"<?php echo $vwcodeinstock->PCS->cellAttributes() ?>>
<span id="el<?php echo $vwcodeinstock_list->RowCnt ?>_vwcodeinstock_PCS" class="vwcodeinstock_PCS">
<span<?php echo $vwcodeinstock->PCS->viewAttributes() ?>>
<?php echo $vwcodeinstock->PCS->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($vwcodeinstock->ProductName->Visible) { // ProductName ?>
		<td data-name="ProductName"<?php echo $vwcodeinstock->ProductName->cellAttributes() ?>>
<span id="el<?php echo $vwcodeinstock_list->RowCnt ?>_vwcodeinstock_ProductName" class="vwcodeinstock_ProductName">
<span<?php echo $vwcodeinstock->ProductName->viewAttributes() ?>>
<?php echo $vwcodeinstock->ProductName->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($vwcodeinstock->Product->Visible) { // Product ?>
		<td data-name="Product"<?php echo $vwcodeinstock->Product->cellAttributes() ?>>
<span id="el<?php echo $vwcodeinstock_list->RowCnt ?>_vwcodeinstock_Product" class="vwcodeinstock_Product">
<span<?php echo $vwcodeinstock->Product->viewAttributes() ?>>
<?php echo $vwcodeinstock->Product->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$vwcodeinstock_list->ListOptions->render("body", "right", $vwcodeinstock_list->RowCnt);
?>
	</tr>
<?php
	}
	if (!$vwcodeinstock->isGridAdd())
		$vwcodeinstock_list->Recordset->moveNext();
}
?>
</tbody>
</table><!-- /.ew-table -->
<?php } ?>
<?php if (!$vwcodeinstock->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</div><!-- /.ew-grid-middle-panel -->
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($vwcodeinstock_list->Recordset)
	$vwcodeinstock_list->Recordset->Close();
?>
<?php if (!$vwcodeinstock->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$vwcodeinstock->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php if (!isset($vwcodeinstock_list->Pager)) $vwcodeinstock_list->Pager = new PrevNextPager($vwcodeinstock_list->StartRec, $vwcodeinstock_list->DisplayRecs, $vwcodeinstock_list->TotalRecs, $vwcodeinstock_list->AutoHidePager) ?>
<?php if ($vwcodeinstock_list->Pager->RecordCount > 0 && $vwcodeinstock_list->Pager->Visible) { ?>
<div class="ew-pager">
<span><?php echo $Language->Phrase("Page") ?>&nbsp;</span>
<div class="ew-prev-next"><div class="input-group input-group-sm">
<div class="input-group-prepend">
<!-- first page button -->
	<?php if ($vwcodeinstock_list->Pager->FirstButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerFirst") ?>" href="<?php echo $vwcodeinstock_list->pageUrl() ?>start=<?php echo $vwcodeinstock_list->Pager->FirstButton->Start ?>"><i class="icon-first ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerFirst") ?>"><i class="icon-first ew-icon"></i></a>
	<?php } ?>
<!-- previous page button -->
	<?php if ($vwcodeinstock_list->Pager->PrevButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerPrevious") ?>" href="<?php echo $vwcodeinstock_list->pageUrl() ?>start=<?php echo $vwcodeinstock_list->Pager->PrevButton->Start ?>"><i class="icon-prev ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerPrevious") ?>"><i class="icon-prev ew-icon"></i></a>
	<?php } ?>
</div>
<!-- current page number -->
	<input class="form-control" type="text" name="<?php echo TABLE_PAGE_NO ?>" value="<?php echo $vwcodeinstock_list->Pager->CurrentPage ?>">
<div class="input-group-append">
<!-- next page button -->
	<?php if ($vwcodeinstock_list->Pager->NextButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerNext") ?>" href="<?php echo $vwcodeinstock_list->pageUrl() ?>start=<?php echo $vwcodeinstock_list->Pager->NextButton->Start ?>"><i class="icon-next ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerNext") ?>"><i class="icon-next ew-icon"></i></a>
	<?php } ?>
<!-- last page button -->
	<?php if ($vwcodeinstock_list->Pager->LastButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerLast") ?>" href="<?php echo $vwcodeinstock_list->pageUrl() ?>start=<?php echo $vwcodeinstock_list->Pager->LastButton->Start ?>"><i class="icon-last ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerLast") ?>"><i class="icon-last ew-icon"></i></a>
	<?php } ?>
</div>
</div>
</div>
<span>&nbsp;<?php echo $Language->Phrase("of") ?>&nbsp;<?php echo $vwcodeinstock_list->Pager->PageCount ?></span>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php if ($vwcodeinstock_list->Pager->RecordCount > 0) { ?>
<div class="ew-pager ew-rec">
	<span><?php echo $Language->Phrase("Record") ?>&nbsp;<?php echo $vwcodeinstock_list->Pager->FromIndex ?>&nbsp;<?php echo $Language->Phrase("To") ?>&nbsp;<?php echo $vwcodeinstock_list->Pager->ToIndex ?>&nbsp;<?php echo $Language->Phrase("Of") ?>&nbsp;<?php echo $vwcodeinstock_list->Pager->RecordCount ?></span>
</div>
<?php } ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $vwcodeinstock_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($vwcodeinstock_list->TotalRecs == 0 && !$vwcodeinstock->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $vwcodeinstock_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$vwcodeinstock_list->showPageFooter();
if (DEBUG_ENABLED)
	echo GetDebugMessage();
?>
<?php if (!$vwcodeinstock->isExport()) { ?>
<script>

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php } ?>
<?php include_once "footer.php" ?>
<?php
$vwcodeinstock_list->terminate();
?>