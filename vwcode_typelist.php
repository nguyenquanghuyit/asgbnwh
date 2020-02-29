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
$vwcode_type_list = new vwcode_type_list();

// Run the page
$vwcode_type_list->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$vwcode_type_list->Page_Render();
?>
<?php include_once "header.php" ?>
<?php if (!$vwcode_type->isExport()) { ?>
<script>

// Form object
currentPageID = ew.PAGE_ID = "list";
var fvwcode_typelist = currentForm = new ew.Form("fvwcode_typelist", "list");
fvwcode_typelist.formKeyCountName = '<?php echo $vwcode_type_list->FormKeyCountName ?>';

// Form_CustomValidate event
fvwcode_typelist.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

	// Your custom validation code here, return false if invalid.
	return true;
}

// Use JavaScript validation or not
fvwcode_typelist.validateRequired = <?php echo json_encode(CLIENT_VALIDATE) ?>;

// Dynamic selection lists
// Form object for search

var fvwcode_typelistsrch = currentSearchForm = new ew.Form("fvwcode_typelistsrch");

// Filters
fvwcode_typelistsrch.filterList = <?php echo $vwcode_type_list->getFilterList() ?>;
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
<?php if (!$vwcode_type->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($vwcode_type_list->TotalRecs > 0 && $vwcode_type_list->ExportOptions->visible()) { ?>
<?php $vwcode_type_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($vwcode_type_list->ImportOptions->visible()) { ?>
<?php $vwcode_type_list->ImportOptions->render("body") ?>
<?php } ?>
<?php if ($vwcode_type_list->SearchOptions->visible()) { ?>
<?php $vwcode_type_list->SearchOptions->render("body") ?>
<?php } ?>
<?php if ($vwcode_type_list->FilterOptions->visible()) { ?>
<?php $vwcode_type_list->FilterOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php
$vwcode_type_list->renderOtherOptions();
?>
<?php if ($Security->CanSearch()) { ?>
<?php if (!$vwcode_type->isExport() && !$vwcode_type->CurrentAction) { ?>
<form name="fvwcode_typelistsrch" id="fvwcode_typelistsrch" class="form-inline ew-form ew-ext-search-form" action="<?php echo CurrentPageName() ?>">
<?php $searchPanelClass = ($vwcode_type_list->SearchWhere <> "") ? " show" : " show"; ?>
<div id="fvwcode_typelistsrch-search-panel" class="ew-search-panel collapse<?php echo $searchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="vwcode_type">
	<div class="ew-basic-search">
<div id="xsr_1" class="ew-row d-sm-flex">
	<div class="ew-quick-search input-group">
		<input type="text" name="<?php echo TABLE_BASIC_SEARCH ?>" id="<?php echo TABLE_BASIC_SEARCH ?>" class="form-control" value="<?php echo HtmlEncode($vwcode_type_list->BasicSearch->getKeyword()) ?>" placeholder="<?php echo HtmlEncode($Language->phrase("Search")) ?>">
		<input type="hidden" name="<?php echo TABLE_BASIC_SEARCH_TYPE ?>" id="<?php echo TABLE_BASIC_SEARCH_TYPE ?>" value="<?php echo HtmlEncode($vwcode_type_list->BasicSearch->getType()) ?>">
		<div class="input-group-append">
			<button class="btn btn-primary" name="btn-submit" id="btn-submit" type="submit"><?php echo $Language->phrase("SearchBtn") ?></button>
			<button type="button" data-toggle="dropdown" class="btn btn-primary dropdown-toggle dropdown-toggle-split" aria-haspopup="true" aria-expanded="false"><span id="searchtype"><?php echo $vwcode_type_list->BasicSearch->getTypeNameShort() ?></span></button>
			<div class="dropdown-menu dropdown-menu-right">
				<a class="dropdown-item<?php if ($vwcode_type_list->BasicSearch->getType() == "") echo " active"; ?>" href="javascript:void(0);" onclick="ew.setSearchType(this)"><?php echo $Language->phrase("QuickSearchAuto") ?></a>
				<a class="dropdown-item<?php if ($vwcode_type_list->BasicSearch->getType() == "=") echo " active"; ?>" href="javascript:void(0);" onclick="ew.setSearchType(this,'=')"><?php echo $Language->phrase("QuickSearchExact") ?></a>
				<a class="dropdown-item<?php if ($vwcode_type_list->BasicSearch->getType() == "AND") echo " active"; ?>" href="javascript:void(0);" onclick="ew.setSearchType(this,'AND')"><?php echo $Language->phrase("QuickSearchAll") ?></a>
				<a class="dropdown-item<?php if ($vwcode_type_list->BasicSearch->getType() == "OR") echo " active"; ?>" href="javascript:void(0);" onclick="ew.setSearchType(this,'OR')"><?php echo $Language->phrase("QuickSearchAny") ?></a>
			</div>
		</div>
	</div>
</div>
	</div>
</div>
</form>
<?php } ?>
<?php } ?>
<?php $vwcode_type_list->showPageHeader(); ?>
<?php
$vwcode_type_list->showMessage();
?>
<?php if ($vwcode_type_list->TotalRecs > 0 || $vwcode_type->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($vwcode_type_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> vwcode_type">
<?php if (!$vwcode_type->isExport()) { ?>
<div class="card-header ew-grid-upper-panel">
<?php if (!$vwcode_type->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php if (!isset($vwcode_type_list->Pager)) $vwcode_type_list->Pager = new PrevNextPager($vwcode_type_list->StartRec, $vwcode_type_list->DisplayRecs, $vwcode_type_list->TotalRecs, $vwcode_type_list->AutoHidePager) ?>
<?php if ($vwcode_type_list->Pager->RecordCount > 0 && $vwcode_type_list->Pager->Visible) { ?>
<div class="ew-pager">
<span><?php echo $Language->Phrase("Page") ?>&nbsp;</span>
<div class="ew-prev-next"><div class="input-group input-group-sm">
<div class="input-group-prepend">
<!-- first page button -->
	<?php if ($vwcode_type_list->Pager->FirstButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerFirst") ?>" href="<?php echo $vwcode_type_list->pageUrl() ?>start=<?php echo $vwcode_type_list->Pager->FirstButton->Start ?>"><i class="icon-first ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerFirst") ?>"><i class="icon-first ew-icon"></i></a>
	<?php } ?>
<!-- previous page button -->
	<?php if ($vwcode_type_list->Pager->PrevButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerPrevious") ?>" href="<?php echo $vwcode_type_list->pageUrl() ?>start=<?php echo $vwcode_type_list->Pager->PrevButton->Start ?>"><i class="icon-prev ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerPrevious") ?>"><i class="icon-prev ew-icon"></i></a>
	<?php } ?>
</div>
<!-- current page number -->
	<input class="form-control" type="text" name="<?php echo TABLE_PAGE_NO ?>" value="<?php echo $vwcode_type_list->Pager->CurrentPage ?>">
<div class="input-group-append">
<!-- next page button -->
	<?php if ($vwcode_type_list->Pager->NextButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerNext") ?>" href="<?php echo $vwcode_type_list->pageUrl() ?>start=<?php echo $vwcode_type_list->Pager->NextButton->Start ?>"><i class="icon-next ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerNext") ?>"><i class="icon-next ew-icon"></i></a>
	<?php } ?>
<!-- last page button -->
	<?php if ($vwcode_type_list->Pager->LastButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerLast") ?>" href="<?php echo $vwcode_type_list->pageUrl() ?>start=<?php echo $vwcode_type_list->Pager->LastButton->Start ?>"><i class="icon-last ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerLast") ?>"><i class="icon-last ew-icon"></i></a>
	<?php } ?>
</div>
</div>
</div>
<span>&nbsp;<?php echo $Language->Phrase("of") ?>&nbsp;<?php echo $vwcode_type_list->Pager->PageCount ?></span>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php if ($vwcode_type_list->Pager->RecordCount > 0) { ?>
<div class="ew-pager ew-rec">
	<span><?php echo $Language->Phrase("Record") ?>&nbsp;<?php echo $vwcode_type_list->Pager->FromIndex ?>&nbsp;<?php echo $Language->Phrase("To") ?>&nbsp;<?php echo $vwcode_type_list->Pager->ToIndex ?>&nbsp;<?php echo $Language->Phrase("Of") ?>&nbsp;<?php echo $vwcode_type_list->Pager->RecordCount ?></span>
</div>
<?php } ?>
<?php if ($vwcode_type_list->TotalRecs > 0 && (!$vwcode_type_list->AutoHidePageSizeSelector || $vwcode_type_list->Pager->Visible)) { ?>
<div class="ew-pager">
<input type="hidden" name="t" value="vwcode_type">
<select name="<?php echo TABLE_REC_PER_PAGE ?>" class="form-control form-control-sm ew-tooltip" title="<?php echo $Language->phrase("RecordsPerPage") ?>" onchange="this.form.submit();">
<option value="20"<?php if ($vwcode_type_list->DisplayRecs == 20) { ?> selected<?php } ?>>20</option>
<option value="50"<?php if ($vwcode_type_list->DisplayRecs == 50) { ?> selected<?php } ?>>50</option>
<option value="100"<?php if ($vwcode_type_list->DisplayRecs == 100) { ?> selected<?php } ?>>100</option>
<option value="200"<?php if ($vwcode_type_list->DisplayRecs == 200) { ?> selected<?php } ?>>200</option>
<option value="500"<?php if ($vwcode_type_list->DisplayRecs == 500) { ?> selected<?php } ?>>500</option>
<option value="ALL"<?php if ($vwcode_type->getRecordsPerPage() == -1) { ?> selected<?php } ?>><?php echo $Language->Phrase("AllRecords") ?></option>
</select>
</div>
<?php } ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $vwcode_type_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
<form name="fvwcode_typelist" id="fvwcode_typelist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($vwcode_type_list->CheckToken) { ?>
<input type="hidden" name="<?php echo TOKEN_NAME ?>" value="<?php echo $vwcode_type_list->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="vwcode_type">
<div id="gmp_vwcode_type" class="<?php if (IsResponsiveLayout()) { ?>table-responsive <?php } ?>card-body ew-grid-middle-panel">
<?php if ($vwcode_type_list->TotalRecs > 0 || $vwcode_type->isGridEdit()) { ?>
<table id="tbl_vwcode_typelist" class="table ew-table"><!-- .ew-table ##-->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$vwcode_type_list->RowType = ROWTYPE_HEADER;

// Render list options
$vwcode_type_list->renderListOptions();

// Render list options (header, left)
$vwcode_type_list->ListOptions->render("header", "left");
?>
<?php if ($vwcode_type->ProductName->Visible) { // ProductName ?>
	<?php if ($vwcode_type->sortUrl($vwcode_type->ProductName) == "") { ?>
		<th data-name="ProductName" class="<?php echo $vwcode_type->ProductName->headerCellClass() ?>"><div id="elh_vwcode_type_ProductName" class="vwcode_type_ProductName"><div class="ew-table-header-caption"><?php echo $vwcode_type->ProductName->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="ProductName" class="<?php echo $vwcode_type->ProductName->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $vwcode_type->SortUrl($vwcode_type->ProductName) ?>',2);"><div id="elh_vwcode_type_ProductName" class="vwcode_type_ProductName">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $vwcode_type->ProductName->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($vwcode_type->ProductName->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($vwcode_type->ProductName->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($vwcode_type->TypeName->Visible) { // TypeName ?>
	<?php if ($vwcode_type->sortUrl($vwcode_type->TypeName) == "") { ?>
		<th data-name="TypeName" class="<?php echo $vwcode_type->TypeName->headerCellClass() ?>"><div id="elh_vwcode_type_TypeName" class="vwcode_type_TypeName"><div class="ew-table-header-caption"><?php echo $vwcode_type->TypeName->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="TypeName" class="<?php echo $vwcode_type->TypeName->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $vwcode_type->SortUrl($vwcode_type->TypeName) ?>',2);"><div id="elh_vwcode_type_TypeName" class="vwcode_type_TypeName">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $vwcode_type->TypeName->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($vwcode_type->TypeName->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($vwcode_type->TypeName->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($vwcode_type->Code->Visible) { // Code ?>
	<?php if ($vwcode_type->sortUrl($vwcode_type->Code) == "") { ?>
		<th data-name="Code" class="<?php echo $vwcode_type->Code->headerCellClass() ?>"><div id="elh_vwcode_type_Code" class="vwcode_type_Code"><div class="ew-table-header-caption"><?php echo $vwcode_type->Code->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Code" class="<?php echo $vwcode_type->Code->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $vwcode_type->SortUrl($vwcode_type->Code) ?>',2);"><div id="elh_vwcode_type_Code" class="vwcode_type_Code">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $vwcode_type->Code->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($vwcode_type->Code->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($vwcode_type->Code->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($vwcode_type->IdType->Visible) { // IdType ?>
	<?php if ($vwcode_type->sortUrl($vwcode_type->IdType) == "") { ?>
		<th data-name="IdType" class="<?php echo $vwcode_type->IdType->headerCellClass() ?>"><div id="elh_vwcode_type_IdType" class="vwcode_type_IdType"><div class="ew-table-header-caption"><?php echo $vwcode_type->IdType->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="IdType" class="<?php echo $vwcode_type->IdType->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $vwcode_type->SortUrl($vwcode_type->IdType) ?>',2);"><div id="elh_vwcode_type_IdType" class="vwcode_type_IdType">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $vwcode_type->IdType->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($vwcode_type->IdType->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($vwcode_type->IdType->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$vwcode_type_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
if ($vwcode_type->ExportAll && $vwcode_type->isExport()) {
	$vwcode_type_list->StopRec = $vwcode_type_list->TotalRecs;
} else {

	// Set the last record to display
	if ($vwcode_type_list->TotalRecs > $vwcode_type_list->StartRec + $vwcode_type_list->DisplayRecs - 1)
		$vwcode_type_list->StopRec = $vwcode_type_list->StartRec + $vwcode_type_list->DisplayRecs - 1;
	else
		$vwcode_type_list->StopRec = $vwcode_type_list->TotalRecs;
}
$vwcode_type_list->RecCnt = $vwcode_type_list->StartRec - 1;
if ($vwcode_type_list->Recordset && !$vwcode_type_list->Recordset->EOF) {
	$vwcode_type_list->Recordset->moveFirst();
	$selectLimit = $vwcode_type_list->UseSelectLimit;
	if (!$selectLimit && $vwcode_type_list->StartRec > 1)
		$vwcode_type_list->Recordset->move($vwcode_type_list->StartRec - 1);
} elseif (!$vwcode_type->AllowAddDeleteRow && $vwcode_type_list->StopRec == 0) {
	$vwcode_type_list->StopRec = $vwcode_type->GridAddRowCount;
}

// Initialize aggregate
$vwcode_type->RowType = ROWTYPE_AGGREGATEINIT;
$vwcode_type->resetAttributes();
$vwcode_type_list->renderRow();
while ($vwcode_type_list->RecCnt < $vwcode_type_list->StopRec) {
	$vwcode_type_list->RecCnt++;
	if ($vwcode_type_list->RecCnt >= $vwcode_type_list->StartRec) {
		$vwcode_type_list->RowCnt++;

		// Set up key count
		$vwcode_type_list->KeyCount = $vwcode_type_list->RowIndex;

		// Init row class and style
		$vwcode_type->resetAttributes();
		$vwcode_type->CssClass = "";
		if ($vwcode_type->isGridAdd()) {
		} else {
			$vwcode_type_list->loadRowValues($vwcode_type_list->Recordset); // Load row values
		}
		$vwcode_type->RowType = ROWTYPE_VIEW; // Render view

		// Set up row id / data-rowindex
		$vwcode_type->RowAttrs = array_merge($vwcode_type->RowAttrs, array('data-rowindex'=>$vwcode_type_list->RowCnt, 'id'=>'r' . $vwcode_type_list->RowCnt . '_vwcode_type', 'data-rowtype'=>$vwcode_type->RowType));

		// Render row
		$vwcode_type_list->renderRow();

		// Render list options
		$vwcode_type_list->renderListOptions();
?>
	<tr<?php echo $vwcode_type->rowAttributes() ?>>
<?php

// Render list options (body, left)
$vwcode_type_list->ListOptions->render("body", "left", $vwcode_type_list->RowCnt);
?>
	<?php if ($vwcode_type->ProductName->Visible) { // ProductName ?>
		<td data-name="ProductName"<?php echo $vwcode_type->ProductName->cellAttributes() ?>>
<span id="el<?php echo $vwcode_type_list->RowCnt ?>_vwcode_type_ProductName" class="vwcode_type_ProductName">
<span<?php echo $vwcode_type->ProductName->viewAttributes() ?>>
<?php echo $vwcode_type->ProductName->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($vwcode_type->TypeName->Visible) { // TypeName ?>
		<td data-name="TypeName"<?php echo $vwcode_type->TypeName->cellAttributes() ?>>
<span id="el<?php echo $vwcode_type_list->RowCnt ?>_vwcode_type_TypeName" class="vwcode_type_TypeName">
<span<?php echo $vwcode_type->TypeName->viewAttributes() ?>>
<?php echo $vwcode_type->TypeName->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($vwcode_type->Code->Visible) { // Code ?>
		<td data-name="Code"<?php echo $vwcode_type->Code->cellAttributes() ?>>
<span id="el<?php echo $vwcode_type_list->RowCnt ?>_vwcode_type_Code" class="vwcode_type_Code">
<span<?php echo $vwcode_type->Code->viewAttributes() ?>>
<?php echo $vwcode_type->Code->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($vwcode_type->IdType->Visible) { // IdType ?>
		<td data-name="IdType"<?php echo $vwcode_type->IdType->cellAttributes() ?>>
<span id="el<?php echo $vwcode_type_list->RowCnt ?>_vwcode_type_IdType" class="vwcode_type_IdType">
<span<?php echo $vwcode_type->IdType->viewAttributes() ?>>
<?php echo $vwcode_type->IdType->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$vwcode_type_list->ListOptions->render("body", "right", $vwcode_type_list->RowCnt);
?>
	</tr>
<?php
	}
	if (!$vwcode_type->isGridAdd())
		$vwcode_type_list->Recordset->moveNext();
}
?>
</tbody>
</table><!-- /.ew-table -->
<?php } ?>
<?php if (!$vwcode_type->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</div><!-- /.ew-grid-middle-panel -->
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($vwcode_type_list->Recordset)
	$vwcode_type_list->Recordset->Close();
?>
<?php if (!$vwcode_type->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$vwcode_type->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php if (!isset($vwcode_type_list->Pager)) $vwcode_type_list->Pager = new PrevNextPager($vwcode_type_list->StartRec, $vwcode_type_list->DisplayRecs, $vwcode_type_list->TotalRecs, $vwcode_type_list->AutoHidePager) ?>
<?php if ($vwcode_type_list->Pager->RecordCount > 0 && $vwcode_type_list->Pager->Visible) { ?>
<div class="ew-pager">
<span><?php echo $Language->Phrase("Page") ?>&nbsp;</span>
<div class="ew-prev-next"><div class="input-group input-group-sm">
<div class="input-group-prepend">
<!-- first page button -->
	<?php if ($vwcode_type_list->Pager->FirstButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerFirst") ?>" href="<?php echo $vwcode_type_list->pageUrl() ?>start=<?php echo $vwcode_type_list->Pager->FirstButton->Start ?>"><i class="icon-first ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerFirst") ?>"><i class="icon-first ew-icon"></i></a>
	<?php } ?>
<!-- previous page button -->
	<?php if ($vwcode_type_list->Pager->PrevButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerPrevious") ?>" href="<?php echo $vwcode_type_list->pageUrl() ?>start=<?php echo $vwcode_type_list->Pager->PrevButton->Start ?>"><i class="icon-prev ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerPrevious") ?>"><i class="icon-prev ew-icon"></i></a>
	<?php } ?>
</div>
<!-- current page number -->
	<input class="form-control" type="text" name="<?php echo TABLE_PAGE_NO ?>" value="<?php echo $vwcode_type_list->Pager->CurrentPage ?>">
<div class="input-group-append">
<!-- next page button -->
	<?php if ($vwcode_type_list->Pager->NextButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerNext") ?>" href="<?php echo $vwcode_type_list->pageUrl() ?>start=<?php echo $vwcode_type_list->Pager->NextButton->Start ?>"><i class="icon-next ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerNext") ?>"><i class="icon-next ew-icon"></i></a>
	<?php } ?>
<!-- last page button -->
	<?php if ($vwcode_type_list->Pager->LastButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerLast") ?>" href="<?php echo $vwcode_type_list->pageUrl() ?>start=<?php echo $vwcode_type_list->Pager->LastButton->Start ?>"><i class="icon-last ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerLast") ?>"><i class="icon-last ew-icon"></i></a>
	<?php } ?>
</div>
</div>
</div>
<span>&nbsp;<?php echo $Language->Phrase("of") ?>&nbsp;<?php echo $vwcode_type_list->Pager->PageCount ?></span>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php if ($vwcode_type_list->Pager->RecordCount > 0) { ?>
<div class="ew-pager ew-rec">
	<span><?php echo $Language->Phrase("Record") ?>&nbsp;<?php echo $vwcode_type_list->Pager->FromIndex ?>&nbsp;<?php echo $Language->Phrase("To") ?>&nbsp;<?php echo $vwcode_type_list->Pager->ToIndex ?>&nbsp;<?php echo $Language->Phrase("Of") ?>&nbsp;<?php echo $vwcode_type_list->Pager->RecordCount ?></span>
</div>
<?php } ?>
<?php if ($vwcode_type_list->TotalRecs > 0 && (!$vwcode_type_list->AutoHidePageSizeSelector || $vwcode_type_list->Pager->Visible)) { ?>
<div class="ew-pager">
<input type="hidden" name="t" value="vwcode_type">
<select name="<?php echo TABLE_REC_PER_PAGE ?>" class="form-control form-control-sm ew-tooltip" title="<?php echo $Language->phrase("RecordsPerPage") ?>" onchange="this.form.submit();">
<option value="20"<?php if ($vwcode_type_list->DisplayRecs == 20) { ?> selected<?php } ?>>20</option>
<option value="50"<?php if ($vwcode_type_list->DisplayRecs == 50) { ?> selected<?php } ?>>50</option>
<option value="100"<?php if ($vwcode_type_list->DisplayRecs == 100) { ?> selected<?php } ?>>100</option>
<option value="200"<?php if ($vwcode_type_list->DisplayRecs == 200) { ?> selected<?php } ?>>200</option>
<option value="500"<?php if ($vwcode_type_list->DisplayRecs == 500) { ?> selected<?php } ?>>500</option>
<option value="ALL"<?php if ($vwcode_type->getRecordsPerPage() == -1) { ?> selected<?php } ?>><?php echo $Language->Phrase("AllRecords") ?></option>
</select>
</div>
<?php } ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $vwcode_type_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($vwcode_type_list->TotalRecs == 0 && !$vwcode_type->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $vwcode_type_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$vwcode_type_list->showPageFooter();
if (DEBUG_ENABLED)
	echo GetDebugMessage();
?>
<?php if (!$vwcode_type->isExport()) { ?>
<script>

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php } ?>
<?php include_once "footer.php" ?>
<?php
$vwcode_type_list->terminate();
?>