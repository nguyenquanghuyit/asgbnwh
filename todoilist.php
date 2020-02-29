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
$todoi_list = new todoi_list();

// Run the page
$todoi_list->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$todoi_list->Page_Render();
?>
<?php include_once "header.php" ?>
<?php if (!$todoi->isExport()) { ?>
<script>

// Form object
currentPageID = ew.PAGE_ID = "list";
var ftodoilist = currentForm = new ew.Form("ftodoilist", "list");
ftodoilist.formKeyCountName = '<?php echo $todoi_list->FormKeyCountName ?>';

// Form_CustomValidate event
ftodoilist.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

	// Your custom validation code here, return false if invalid.
	return true;
}

// Use JavaScript validation or not
ftodoilist.validateRequired = <?php echo json_encode(CLIENT_VALIDATE) ?>;

// Dynamic selection lists
ftodoilist.lists["x_PB_ID"] = <?php echo $todoi_list->PB_ID->Lookup->toClientList() ?>;
ftodoilist.lists["x_PB_ID"].options = <?php echo JsonEncode($todoi_list->PB_ID->lookupOptions()) ?>;
ftodoilist.autoSuggests["x_PB_ID"] = <?php echo json_encode(["data" => "ajax=autosuggest"]) ?>;

// Form object for search
var ftodoilistsrch = currentSearchForm = new ew.Form("ftodoilistsrch");

// Filters
ftodoilistsrch.filterList = <?php echo $todoi_list->getFilterList() ?>;
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
<?php if (!$todoi->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($todoi_list->TotalRecs > 0 && $todoi_list->ExportOptions->visible()) { ?>
<?php $todoi_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($todoi_list->ImportOptions->visible()) { ?>
<?php $todoi_list->ImportOptions->render("body") ?>
<?php } ?>
<?php if ($todoi_list->SearchOptions->visible()) { ?>
<?php $todoi_list->SearchOptions->render("body") ?>
<?php } ?>
<?php if ($todoi_list->FilterOptions->visible()) { ?>
<?php $todoi_list->FilterOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php
$todoi_list->renderOtherOptions();
?>
<?php if ($Security->CanSearch()) { ?>
<?php if (!$todoi->isExport() && !$todoi->CurrentAction) { ?>
<form name="ftodoilistsrch" id="ftodoilistsrch" class="form-inline ew-form ew-ext-search-form" action="<?php echo CurrentPageName() ?>">
<?php $searchPanelClass = ($todoi_list->SearchWhere <> "") ? " show" : " show"; ?>
<div id="ftodoilistsrch-search-panel" class="ew-search-panel collapse<?php echo $searchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="todoi">
	<div class="ew-basic-search">
<div id="xsr_1" class="ew-row d-sm-flex">
	<div class="ew-quick-search input-group">
		<input type="text" name="<?php echo TABLE_BASIC_SEARCH ?>" id="<?php echo TABLE_BASIC_SEARCH ?>" class="form-control" value="<?php echo HtmlEncode($todoi_list->BasicSearch->getKeyword()) ?>" placeholder="<?php echo HtmlEncode($Language->phrase("Search")) ?>">
		<input type="hidden" name="<?php echo TABLE_BASIC_SEARCH_TYPE ?>" id="<?php echo TABLE_BASIC_SEARCH_TYPE ?>" value="<?php echo HtmlEncode($todoi_list->BasicSearch->getType()) ?>">
		<div class="input-group-append">
			<button class="btn btn-primary" name="btn-submit" id="btn-submit" type="submit"><?php echo $Language->phrase("SearchBtn") ?></button>
			<button type="button" data-toggle="dropdown" class="btn btn-primary dropdown-toggle dropdown-toggle-split" aria-haspopup="true" aria-expanded="false"><span id="searchtype"><?php echo $todoi_list->BasicSearch->getTypeNameShort() ?></span></button>
			<div class="dropdown-menu dropdown-menu-right">
				<a class="dropdown-item<?php if ($todoi_list->BasicSearch->getType() == "") echo " active"; ?>" href="javascript:void(0);" onclick="ew.setSearchType(this)"><?php echo $Language->phrase("QuickSearchAuto") ?></a>
				<a class="dropdown-item<?php if ($todoi_list->BasicSearch->getType() == "=") echo " active"; ?>" href="javascript:void(0);" onclick="ew.setSearchType(this,'=')"><?php echo $Language->phrase("QuickSearchExact") ?></a>
				<a class="dropdown-item<?php if ($todoi_list->BasicSearch->getType() == "AND") echo " active"; ?>" href="javascript:void(0);" onclick="ew.setSearchType(this,'AND')"><?php echo $Language->phrase("QuickSearchAll") ?></a>
				<a class="dropdown-item<?php if ($todoi_list->BasicSearch->getType() == "OR") echo " active"; ?>" href="javascript:void(0);" onclick="ew.setSearchType(this,'OR')"><?php echo $Language->phrase("QuickSearchAny") ?></a>
			</div>
		</div>
	</div>
</div>
	</div>
</div>
</form>
<?php } ?>
<?php } ?>
<?php $todoi_list->showPageHeader(); ?>
<?php
$todoi_list->showMessage();
?>
<?php if ($todoi_list->TotalRecs > 0 || $todoi->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($todoi_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> todoi">
<?php if (!$todoi->isExport()) { ?>
<div class="card-header ew-grid-upper-panel">
<?php if (!$todoi->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php if (!isset($todoi_list->Pager)) $todoi_list->Pager = new PrevNextPager($todoi_list->StartRec, $todoi_list->DisplayRecs, $todoi_list->TotalRecs, $todoi_list->AutoHidePager) ?>
<?php if ($todoi_list->Pager->RecordCount > 0 && $todoi_list->Pager->Visible) { ?>
<div class="ew-pager">
<span><?php echo $Language->Phrase("Page") ?>&nbsp;</span>
<div class="ew-prev-next"><div class="input-group input-group-sm">
<div class="input-group-prepend">
<!-- first page button -->
	<?php if ($todoi_list->Pager->FirstButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerFirst") ?>" href="<?php echo $todoi_list->pageUrl() ?>start=<?php echo $todoi_list->Pager->FirstButton->Start ?>"><i class="icon-first ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerFirst") ?>"><i class="icon-first ew-icon"></i></a>
	<?php } ?>
<!-- previous page button -->
	<?php if ($todoi_list->Pager->PrevButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerPrevious") ?>" href="<?php echo $todoi_list->pageUrl() ?>start=<?php echo $todoi_list->Pager->PrevButton->Start ?>"><i class="icon-prev ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerPrevious") ?>"><i class="icon-prev ew-icon"></i></a>
	<?php } ?>
</div>
<!-- current page number -->
	<input class="form-control" type="text" name="<?php echo TABLE_PAGE_NO ?>" value="<?php echo $todoi_list->Pager->CurrentPage ?>">
<div class="input-group-append">
<!-- next page button -->
	<?php if ($todoi_list->Pager->NextButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerNext") ?>" href="<?php echo $todoi_list->pageUrl() ?>start=<?php echo $todoi_list->Pager->NextButton->Start ?>"><i class="icon-next ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerNext") ?>"><i class="icon-next ew-icon"></i></a>
	<?php } ?>
<!-- last page button -->
	<?php if ($todoi_list->Pager->LastButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerLast") ?>" href="<?php echo $todoi_list->pageUrl() ?>start=<?php echo $todoi_list->Pager->LastButton->Start ?>"><i class="icon-last ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerLast") ?>"><i class="icon-last ew-icon"></i></a>
	<?php } ?>
</div>
</div>
</div>
<span>&nbsp;<?php echo $Language->Phrase("of") ?>&nbsp;<?php echo $todoi_list->Pager->PageCount ?></span>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php if ($todoi_list->Pager->RecordCount > 0) { ?>
<div class="ew-pager ew-rec">
	<span><?php echo $Language->Phrase("Record") ?>&nbsp;<?php echo $todoi_list->Pager->FromIndex ?>&nbsp;<?php echo $Language->Phrase("To") ?>&nbsp;<?php echo $todoi_list->Pager->ToIndex ?>&nbsp;<?php echo $Language->Phrase("Of") ?>&nbsp;<?php echo $todoi_list->Pager->RecordCount ?></span>
</div>
<?php } ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $todoi_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
<form name="ftodoilist" id="ftodoilist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($todoi_list->CheckToken) { ?>
<input type="hidden" name="<?php echo TOKEN_NAME ?>" value="<?php echo $todoi_list->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="todoi">
<input type="hidden" name="exporttype" id="exporttype" value="">
<div id="gmp_todoi" class="<?php if (IsResponsiveLayout()) { ?>table-responsive <?php } ?>card-body ew-grid-middle-panel">
<?php if ($todoi_list->TotalRecs > 0 || $todoi->isGridEdit()) { ?>
<table id="tbl_todoilist" class="table ew-table"><!-- .ew-table ##-->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$todoi_list->RowType = ROWTYPE_HEADER;

// Render list options
$todoi_list->renderListOptions();

// Render list options (header, left)
$todoi_list->ListOptions->render("header", "left");
?>
<?php if ($todoi->TD_Tendd->Visible) { // TD_Tendd ?>
	<?php if ($todoi->sortUrl($todoi->TD_Tendd) == "") { ?>
		<th data-name="TD_Tendd" class="<?php echo $todoi->TD_Tendd->headerCellClass() ?>" style="white-space: nowrap;"><div id="elh_todoi_TD_Tendd" class="todoi_TD_Tendd"><div class="ew-table-header-caption"><?php echo $todoi->TD_Tendd->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="TD_Tendd" class="<?php echo $todoi->TD_Tendd->headerCellClass() ?>" style="white-space: nowrap;"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $todoi->SortUrl($todoi->TD_Tendd) ?>',2);"><div id="elh_todoi_TD_Tendd" class="todoi_TD_Tendd">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $todoi->TD_Tendd->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($todoi->TD_Tendd->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($todoi->TD_Tendd->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($todoi->PB_ID->Visible) { // PB_ID ?>
	<?php if ($todoi->sortUrl($todoi->PB_ID) == "") { ?>
		<th data-name="PB_ID" class="<?php echo $todoi->PB_ID->headerCellClass() ?>" style="white-space: nowrap;"><div id="elh_todoi_PB_ID" class="todoi_PB_ID"><div class="ew-table-header-caption"><?php echo $todoi->PB_ID->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="PB_ID" class="<?php echo $todoi->PB_ID->headerCellClass() ?>" style="white-space: nowrap;"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $todoi->SortUrl($todoi->PB_ID) ?>',2);"><div id="elh_todoi_PB_ID" class="todoi_PB_ID">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $todoi->PB_ID->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($todoi->PB_ID->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($todoi->PB_ID->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$todoi_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
if ($todoi->ExportAll && $todoi->isExport()) {
	$todoi_list->StopRec = $todoi_list->TotalRecs;
} else {

	// Set the last record to display
	if ($todoi_list->TotalRecs > $todoi_list->StartRec + $todoi_list->DisplayRecs - 1)
		$todoi_list->StopRec = $todoi_list->StartRec + $todoi_list->DisplayRecs - 1;
	else
		$todoi_list->StopRec = $todoi_list->TotalRecs;
}
$todoi_list->RecCnt = $todoi_list->StartRec - 1;
if ($todoi_list->Recordset && !$todoi_list->Recordset->EOF) {
	$todoi_list->Recordset->moveFirst();
	$selectLimit = $todoi_list->UseSelectLimit;
	if (!$selectLimit && $todoi_list->StartRec > 1)
		$todoi_list->Recordset->move($todoi_list->StartRec - 1);
} elseif (!$todoi->AllowAddDeleteRow && $todoi_list->StopRec == 0) {
	$todoi_list->StopRec = $todoi->GridAddRowCount;
}

// Initialize aggregate
$todoi->RowType = ROWTYPE_AGGREGATEINIT;
$todoi->resetAttributes();
$todoi_list->renderRow();
while ($todoi_list->RecCnt < $todoi_list->StopRec) {
	$todoi_list->RecCnt++;
	if ($todoi_list->RecCnt >= $todoi_list->StartRec) {
		$todoi_list->RowCnt++;

		// Set up key count
		$todoi_list->KeyCount = $todoi_list->RowIndex;

		// Init row class and style
		$todoi->resetAttributes();
		$todoi->CssClass = "";
		if ($todoi->isGridAdd()) {
		} else {
			$todoi_list->loadRowValues($todoi_list->Recordset); // Load row values
		}
		$todoi->RowType = ROWTYPE_VIEW; // Render view

		// Set up row id / data-rowindex
		$todoi->RowAttrs = array_merge($todoi->RowAttrs, array('data-rowindex'=>$todoi_list->RowCnt, 'id'=>'r' . $todoi_list->RowCnt . '_todoi', 'data-rowtype'=>$todoi->RowType));

		// Render row
		$todoi_list->renderRow();

		// Render list options
		$todoi_list->renderListOptions();
?>
	<tr<?php echo $todoi->rowAttributes() ?>>
<?php

// Render list options (body, left)
$todoi_list->ListOptions->render("body", "left", $todoi_list->RowCnt);
?>
	<?php if ($todoi->TD_Tendd->Visible) { // TD_Tendd ?>
		<td data-name="TD_Tendd"<?php echo $todoi->TD_Tendd->cellAttributes() ?>>
<span id="el<?php echo $todoi_list->RowCnt ?>_todoi_TD_Tendd" class="todoi_TD_Tendd">
<span<?php echo $todoi->TD_Tendd->viewAttributes() ?>>
<?php echo $todoi->TD_Tendd->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($todoi->PB_ID->Visible) { // PB_ID ?>
		<td data-name="PB_ID"<?php echo $todoi->PB_ID->cellAttributes() ?>>
<span id="el<?php echo $todoi_list->RowCnt ?>_todoi_PB_ID" class="todoi_PB_ID">
<span<?php echo $todoi->PB_ID->viewAttributes() ?>>
<?php echo $todoi->PB_ID->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$todoi_list->ListOptions->render("body", "right", $todoi_list->RowCnt);
?>
	</tr>
<?php
	}
	if (!$todoi->isGridAdd())
		$todoi_list->Recordset->moveNext();
}
?>
</tbody>
</table><!-- /.ew-table -->
<?php } ?>
<?php if (!$todoi->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</div><!-- /.ew-grid-middle-panel -->
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($todoi_list->Recordset)
	$todoi_list->Recordset->Close();
?>
<?php if (!$todoi->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$todoi->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php if (!isset($todoi_list->Pager)) $todoi_list->Pager = new PrevNextPager($todoi_list->StartRec, $todoi_list->DisplayRecs, $todoi_list->TotalRecs, $todoi_list->AutoHidePager) ?>
<?php if ($todoi_list->Pager->RecordCount > 0 && $todoi_list->Pager->Visible) { ?>
<div class="ew-pager">
<span><?php echo $Language->Phrase("Page") ?>&nbsp;</span>
<div class="ew-prev-next"><div class="input-group input-group-sm">
<div class="input-group-prepend">
<!-- first page button -->
	<?php if ($todoi_list->Pager->FirstButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerFirst") ?>" href="<?php echo $todoi_list->pageUrl() ?>start=<?php echo $todoi_list->Pager->FirstButton->Start ?>"><i class="icon-first ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerFirst") ?>"><i class="icon-first ew-icon"></i></a>
	<?php } ?>
<!-- previous page button -->
	<?php if ($todoi_list->Pager->PrevButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerPrevious") ?>" href="<?php echo $todoi_list->pageUrl() ?>start=<?php echo $todoi_list->Pager->PrevButton->Start ?>"><i class="icon-prev ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerPrevious") ?>"><i class="icon-prev ew-icon"></i></a>
	<?php } ?>
</div>
<!-- current page number -->
	<input class="form-control" type="text" name="<?php echo TABLE_PAGE_NO ?>" value="<?php echo $todoi_list->Pager->CurrentPage ?>">
<div class="input-group-append">
<!-- next page button -->
	<?php if ($todoi_list->Pager->NextButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerNext") ?>" href="<?php echo $todoi_list->pageUrl() ?>start=<?php echo $todoi_list->Pager->NextButton->Start ?>"><i class="icon-next ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerNext") ?>"><i class="icon-next ew-icon"></i></a>
	<?php } ?>
<!-- last page button -->
	<?php if ($todoi_list->Pager->LastButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerLast") ?>" href="<?php echo $todoi_list->pageUrl() ?>start=<?php echo $todoi_list->Pager->LastButton->Start ?>"><i class="icon-last ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerLast") ?>"><i class="icon-last ew-icon"></i></a>
	<?php } ?>
</div>
</div>
</div>
<span>&nbsp;<?php echo $Language->Phrase("of") ?>&nbsp;<?php echo $todoi_list->Pager->PageCount ?></span>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php if ($todoi_list->Pager->RecordCount > 0) { ?>
<div class="ew-pager ew-rec">
	<span><?php echo $Language->Phrase("Record") ?>&nbsp;<?php echo $todoi_list->Pager->FromIndex ?>&nbsp;<?php echo $Language->Phrase("To") ?>&nbsp;<?php echo $todoi_list->Pager->ToIndex ?>&nbsp;<?php echo $Language->Phrase("Of") ?>&nbsp;<?php echo $todoi_list->Pager->RecordCount ?></span>
</div>
<?php } ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $todoi_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($todoi_list->TotalRecs == 0 && !$todoi->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $todoi_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$todoi_list->showPageFooter();
if (DEBUG_ENABLED)
	echo GetDebugMessage();
?>
<?php if (!$todoi->isExport()) { ?>
<script>

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php } ?>
<?php include_once "footer.php" ?>
<?php
$todoi_list->terminate();
?>