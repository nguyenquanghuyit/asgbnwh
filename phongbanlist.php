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
$phongban_list = new phongban_list();

// Run the page
$phongban_list->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$phongban_list->Page_Render();
?>
<?php include_once "header.php" ?>
<?php if (!$phongban->isExport()) { ?>
<script>

// Form object
currentPageID = ew.PAGE_ID = "list";
var fphongbanlist = currentForm = new ew.Form("fphongbanlist", "list");
fphongbanlist.formKeyCountName = '<?php echo $phongban_list->FormKeyCountName ?>';

// Form_CustomValidate event
fphongbanlist.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

	// Your custom validation code here, return false if invalid.
	return true;
}

// Use JavaScript validation or not
fphongbanlist.validateRequired = <?php echo json_encode(CLIENT_VALIDATE) ?>;

// Dynamic selection lists
// Form object for search

var fphongbanlistsrch = currentSearchForm = new ew.Form("fphongbanlistsrch");

// Filters
fphongbanlistsrch.filterList = <?php echo $phongban_list->getFilterList() ?>;
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
<?php if (!$phongban->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($phongban_list->TotalRecs > 0 && $phongban_list->ExportOptions->visible()) { ?>
<?php $phongban_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($phongban_list->ImportOptions->visible()) { ?>
<?php $phongban_list->ImportOptions->render("body") ?>
<?php } ?>
<?php if ($phongban_list->SearchOptions->visible()) { ?>
<?php $phongban_list->SearchOptions->render("body") ?>
<?php } ?>
<?php if ($phongban_list->FilterOptions->visible()) { ?>
<?php $phongban_list->FilterOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php
$phongban_list->renderOtherOptions();
?>
<?php if ($Security->CanSearch()) { ?>
<?php if (!$phongban->isExport() && !$phongban->CurrentAction) { ?>
<form name="fphongbanlistsrch" id="fphongbanlistsrch" class="form-inline ew-form ew-ext-search-form" action="<?php echo CurrentPageName() ?>">
<?php $searchPanelClass = ($phongban_list->SearchWhere <> "") ? " show" : " show"; ?>
<div id="fphongbanlistsrch-search-panel" class="ew-search-panel collapse<?php echo $searchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="phongban">
	<div class="ew-basic-search">
<div id="xsr_1" class="ew-row d-sm-flex">
	<div class="ew-quick-search input-group">
		<input type="text" name="<?php echo TABLE_BASIC_SEARCH ?>" id="<?php echo TABLE_BASIC_SEARCH ?>" class="form-control" value="<?php echo HtmlEncode($phongban_list->BasicSearch->getKeyword()) ?>" placeholder="<?php echo HtmlEncode($Language->phrase("Search")) ?>">
		<input type="hidden" name="<?php echo TABLE_BASIC_SEARCH_TYPE ?>" id="<?php echo TABLE_BASIC_SEARCH_TYPE ?>" value="<?php echo HtmlEncode($phongban_list->BasicSearch->getType()) ?>">
		<div class="input-group-append">
			<button class="btn btn-primary" name="btn-submit" id="btn-submit" type="submit"><?php echo $Language->phrase("SearchBtn") ?></button>
			<button type="button" data-toggle="dropdown" class="btn btn-primary dropdown-toggle dropdown-toggle-split" aria-haspopup="true" aria-expanded="false"><span id="searchtype"><?php echo $phongban_list->BasicSearch->getTypeNameShort() ?></span></button>
			<div class="dropdown-menu dropdown-menu-right">
				<a class="dropdown-item<?php if ($phongban_list->BasicSearch->getType() == "") echo " active"; ?>" href="javascript:void(0);" onclick="ew.setSearchType(this)"><?php echo $Language->phrase("QuickSearchAuto") ?></a>
				<a class="dropdown-item<?php if ($phongban_list->BasicSearch->getType() == "=") echo " active"; ?>" href="javascript:void(0);" onclick="ew.setSearchType(this,'=')"><?php echo $Language->phrase("QuickSearchExact") ?></a>
				<a class="dropdown-item<?php if ($phongban_list->BasicSearch->getType() == "AND") echo " active"; ?>" href="javascript:void(0);" onclick="ew.setSearchType(this,'AND')"><?php echo $Language->phrase("QuickSearchAll") ?></a>
				<a class="dropdown-item<?php if ($phongban_list->BasicSearch->getType() == "OR") echo " active"; ?>" href="javascript:void(0);" onclick="ew.setSearchType(this,'OR')"><?php echo $Language->phrase("QuickSearchAny") ?></a>
			</div>
		</div>
	</div>
</div>
	</div>
</div>
</form>
<?php } ?>
<?php } ?>
<?php $phongban_list->showPageHeader(); ?>
<?php
$phongban_list->showMessage();
?>
<?php if ($phongban_list->TotalRecs > 0 || $phongban->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($phongban_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> phongban">
<?php if (!$phongban->isExport()) { ?>
<div class="card-header ew-grid-upper-panel">
<?php if (!$phongban->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php if (!isset($phongban_list->Pager)) $phongban_list->Pager = new PrevNextPager($phongban_list->StartRec, $phongban_list->DisplayRecs, $phongban_list->TotalRecs, $phongban_list->AutoHidePager) ?>
<?php if ($phongban_list->Pager->RecordCount > 0 && $phongban_list->Pager->Visible) { ?>
<div class="ew-pager">
<span><?php echo $Language->Phrase("Page") ?>&nbsp;</span>
<div class="ew-prev-next"><div class="input-group input-group-sm">
<div class="input-group-prepend">
<!-- first page button -->
	<?php if ($phongban_list->Pager->FirstButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerFirst") ?>" href="<?php echo $phongban_list->pageUrl() ?>start=<?php echo $phongban_list->Pager->FirstButton->Start ?>"><i class="icon-first ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerFirst") ?>"><i class="icon-first ew-icon"></i></a>
	<?php } ?>
<!-- previous page button -->
	<?php if ($phongban_list->Pager->PrevButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerPrevious") ?>" href="<?php echo $phongban_list->pageUrl() ?>start=<?php echo $phongban_list->Pager->PrevButton->Start ?>"><i class="icon-prev ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerPrevious") ?>"><i class="icon-prev ew-icon"></i></a>
	<?php } ?>
</div>
<!-- current page number -->
	<input class="form-control" type="text" name="<?php echo TABLE_PAGE_NO ?>" value="<?php echo $phongban_list->Pager->CurrentPage ?>">
<div class="input-group-append">
<!-- next page button -->
	<?php if ($phongban_list->Pager->NextButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerNext") ?>" href="<?php echo $phongban_list->pageUrl() ?>start=<?php echo $phongban_list->Pager->NextButton->Start ?>"><i class="icon-next ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerNext") ?>"><i class="icon-next ew-icon"></i></a>
	<?php } ?>
<!-- last page button -->
	<?php if ($phongban_list->Pager->LastButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerLast") ?>" href="<?php echo $phongban_list->pageUrl() ?>start=<?php echo $phongban_list->Pager->LastButton->Start ?>"><i class="icon-last ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerLast") ?>"><i class="icon-last ew-icon"></i></a>
	<?php } ?>
</div>
</div>
</div>
<span>&nbsp;<?php echo $Language->Phrase("of") ?>&nbsp;<?php echo $phongban_list->Pager->PageCount ?></span>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php if ($phongban_list->Pager->RecordCount > 0) { ?>
<div class="ew-pager ew-rec">
	<span><?php echo $Language->Phrase("Record") ?>&nbsp;<?php echo $phongban_list->Pager->FromIndex ?>&nbsp;<?php echo $Language->Phrase("To") ?>&nbsp;<?php echo $phongban_list->Pager->ToIndex ?>&nbsp;<?php echo $Language->Phrase("Of") ?>&nbsp;<?php echo $phongban_list->Pager->RecordCount ?></span>
</div>
<?php } ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $phongban_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
<form name="fphongbanlist" id="fphongbanlist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($phongban_list->CheckToken) { ?>
<input type="hidden" name="<?php echo TOKEN_NAME ?>" value="<?php echo $phongban_list->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="phongban">
<input type="hidden" name="exporttype" id="exporttype" value="">
<div id="gmp_phongban" class="<?php if (IsResponsiveLayout()) { ?>table-responsive <?php } ?>card-body ew-grid-middle-panel">
<?php if ($phongban_list->TotalRecs > 0 || $phongban->isGridEdit()) { ?>
<table id="tbl_phongbanlist" class="table ew-table"><!-- .ew-table ##-->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$phongban_list->RowType = ROWTYPE_HEADER;

// Render list options
$phongban_list->renderListOptions();

// Render list options (header, left)
$phongban_list->ListOptions->render("header", "left");
?>
<?php if ($phongban->PB_Tendd->Visible) { // PB_Tendd ?>
	<?php if ($phongban->sortUrl($phongban->PB_Tendd) == "") { ?>
		<th data-name="PB_Tendd" class="<?php echo $phongban->PB_Tendd->headerCellClass() ?>" style="white-space: nowrap;"><div id="elh_phongban_PB_Tendd" class="phongban_PB_Tendd"><div class="ew-table-header-caption"><?php echo $phongban->PB_Tendd->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="PB_Tendd" class="<?php echo $phongban->PB_Tendd->headerCellClass() ?>" style="white-space: nowrap;"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $phongban->SortUrl($phongban->PB_Tendd) ?>',2);"><div id="elh_phongban_PB_Tendd" class="phongban_PB_Tendd">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $phongban->PB_Tendd->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($phongban->PB_Tendd->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($phongban->PB_Tendd->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$phongban_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
if ($phongban->ExportAll && $phongban->isExport()) {
	$phongban_list->StopRec = $phongban_list->TotalRecs;
} else {

	// Set the last record to display
	if ($phongban_list->TotalRecs > $phongban_list->StartRec + $phongban_list->DisplayRecs - 1)
		$phongban_list->StopRec = $phongban_list->StartRec + $phongban_list->DisplayRecs - 1;
	else
		$phongban_list->StopRec = $phongban_list->TotalRecs;
}
$phongban_list->RecCnt = $phongban_list->StartRec - 1;
if ($phongban_list->Recordset && !$phongban_list->Recordset->EOF) {
	$phongban_list->Recordset->moveFirst();
	$selectLimit = $phongban_list->UseSelectLimit;
	if (!$selectLimit && $phongban_list->StartRec > 1)
		$phongban_list->Recordset->move($phongban_list->StartRec - 1);
} elseif (!$phongban->AllowAddDeleteRow && $phongban_list->StopRec == 0) {
	$phongban_list->StopRec = $phongban->GridAddRowCount;
}

// Initialize aggregate
$phongban->RowType = ROWTYPE_AGGREGATEINIT;
$phongban->resetAttributes();
$phongban_list->renderRow();
while ($phongban_list->RecCnt < $phongban_list->StopRec) {
	$phongban_list->RecCnt++;
	if ($phongban_list->RecCnt >= $phongban_list->StartRec) {
		$phongban_list->RowCnt++;

		// Set up key count
		$phongban_list->KeyCount = $phongban_list->RowIndex;

		// Init row class and style
		$phongban->resetAttributes();
		$phongban->CssClass = "";
		if ($phongban->isGridAdd()) {
		} else {
			$phongban_list->loadRowValues($phongban_list->Recordset); // Load row values
		}
		$phongban->RowType = ROWTYPE_VIEW; // Render view

		// Set up row id / data-rowindex
		$phongban->RowAttrs = array_merge($phongban->RowAttrs, array('data-rowindex'=>$phongban_list->RowCnt, 'id'=>'r' . $phongban_list->RowCnt . '_phongban', 'data-rowtype'=>$phongban->RowType));

		// Render row
		$phongban_list->renderRow();

		// Render list options
		$phongban_list->renderListOptions();
?>
	<tr<?php echo $phongban->rowAttributes() ?>>
<?php

// Render list options (body, left)
$phongban_list->ListOptions->render("body", "left", $phongban_list->RowCnt);
?>
	<?php if ($phongban->PB_Tendd->Visible) { // PB_Tendd ?>
		<td data-name="PB_Tendd"<?php echo $phongban->PB_Tendd->cellAttributes() ?>>
<span id="el<?php echo $phongban_list->RowCnt ?>_phongban_PB_Tendd" class="phongban_PB_Tendd">
<span<?php echo $phongban->PB_Tendd->viewAttributes() ?>>
<?php echo $phongban->PB_Tendd->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$phongban_list->ListOptions->render("body", "right", $phongban_list->RowCnt);
?>
	</tr>
<?php
	}
	if (!$phongban->isGridAdd())
		$phongban_list->Recordset->moveNext();
}
?>
</tbody>
</table><!-- /.ew-table -->
<?php } ?>
<?php if (!$phongban->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</div><!-- /.ew-grid-middle-panel -->
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($phongban_list->Recordset)
	$phongban_list->Recordset->Close();
?>
<?php if (!$phongban->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$phongban->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php if (!isset($phongban_list->Pager)) $phongban_list->Pager = new PrevNextPager($phongban_list->StartRec, $phongban_list->DisplayRecs, $phongban_list->TotalRecs, $phongban_list->AutoHidePager) ?>
<?php if ($phongban_list->Pager->RecordCount > 0 && $phongban_list->Pager->Visible) { ?>
<div class="ew-pager">
<span><?php echo $Language->Phrase("Page") ?>&nbsp;</span>
<div class="ew-prev-next"><div class="input-group input-group-sm">
<div class="input-group-prepend">
<!-- first page button -->
	<?php if ($phongban_list->Pager->FirstButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerFirst") ?>" href="<?php echo $phongban_list->pageUrl() ?>start=<?php echo $phongban_list->Pager->FirstButton->Start ?>"><i class="icon-first ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerFirst") ?>"><i class="icon-first ew-icon"></i></a>
	<?php } ?>
<!-- previous page button -->
	<?php if ($phongban_list->Pager->PrevButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerPrevious") ?>" href="<?php echo $phongban_list->pageUrl() ?>start=<?php echo $phongban_list->Pager->PrevButton->Start ?>"><i class="icon-prev ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerPrevious") ?>"><i class="icon-prev ew-icon"></i></a>
	<?php } ?>
</div>
<!-- current page number -->
	<input class="form-control" type="text" name="<?php echo TABLE_PAGE_NO ?>" value="<?php echo $phongban_list->Pager->CurrentPage ?>">
<div class="input-group-append">
<!-- next page button -->
	<?php if ($phongban_list->Pager->NextButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerNext") ?>" href="<?php echo $phongban_list->pageUrl() ?>start=<?php echo $phongban_list->Pager->NextButton->Start ?>"><i class="icon-next ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerNext") ?>"><i class="icon-next ew-icon"></i></a>
	<?php } ?>
<!-- last page button -->
	<?php if ($phongban_list->Pager->LastButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerLast") ?>" href="<?php echo $phongban_list->pageUrl() ?>start=<?php echo $phongban_list->Pager->LastButton->Start ?>"><i class="icon-last ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerLast") ?>"><i class="icon-last ew-icon"></i></a>
	<?php } ?>
</div>
</div>
</div>
<span>&nbsp;<?php echo $Language->Phrase("of") ?>&nbsp;<?php echo $phongban_list->Pager->PageCount ?></span>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php if ($phongban_list->Pager->RecordCount > 0) { ?>
<div class="ew-pager ew-rec">
	<span><?php echo $Language->Phrase("Record") ?>&nbsp;<?php echo $phongban_list->Pager->FromIndex ?>&nbsp;<?php echo $Language->Phrase("To") ?>&nbsp;<?php echo $phongban_list->Pager->ToIndex ?>&nbsp;<?php echo $Language->Phrase("Of") ?>&nbsp;<?php echo $phongban_list->Pager->RecordCount ?></span>
</div>
<?php } ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $phongban_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($phongban_list->TotalRecs == 0 && !$phongban->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $phongban_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$phongban_list->showPageFooter();
if (DEBUG_ENABLED)
	echo GetDebugMessage();
?>
<?php if (!$phongban->isExport()) { ?>
<script>

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php } ?>
<?php include_once "footer.php" ?>
<?php
$phongban_list->terminate();
?>