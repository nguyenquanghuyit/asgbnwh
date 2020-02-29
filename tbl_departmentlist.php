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
$tbl_department_list = new tbl_department_list();

// Run the page
$tbl_department_list->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$tbl_department_list->Page_Render();
?>
<?php include_once "header.php" ?>
<?php if (!$tbl_department->isExport()) { ?>
<script>

// Form object
currentPageID = ew.PAGE_ID = "list";
var ftbl_departmentlist = currentForm = new ew.Form("ftbl_departmentlist", "list");
ftbl_departmentlist.formKeyCountName = '<?php echo $tbl_department_list->FormKeyCountName ?>';

// Form_CustomValidate event
ftbl_departmentlist.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

	// Your custom validation code here, return false if invalid.
	return true;
}

// Use JavaScript validation or not
ftbl_departmentlist.validateRequired = <?php echo json_encode(CLIENT_VALIDATE) ?>;

// Dynamic selection lists
// Form object for search

var ftbl_departmentlistsrch = currentSearchForm = new ew.Form("ftbl_departmentlistsrch");

// Filters
ftbl_departmentlistsrch.filterList = <?php echo $tbl_department_list->getFilterList() ?>;
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
<?php if (!$tbl_department->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($tbl_department_list->TotalRecs > 0 && $tbl_department_list->ExportOptions->visible()) { ?>
<?php $tbl_department_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($tbl_department_list->ImportOptions->visible()) { ?>
<?php $tbl_department_list->ImportOptions->render("body") ?>
<?php } ?>
<?php if ($tbl_department_list->SearchOptions->visible()) { ?>
<?php $tbl_department_list->SearchOptions->render("body") ?>
<?php } ?>
<?php if ($tbl_department_list->FilterOptions->visible()) { ?>
<?php $tbl_department_list->FilterOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php
$tbl_department_list->renderOtherOptions();
?>
<?php if ($Security->CanSearch()) { ?>
<?php if (!$tbl_department->isExport() && !$tbl_department->CurrentAction) { ?>
<form name="ftbl_departmentlistsrch" id="ftbl_departmentlistsrch" class="form-inline ew-form ew-ext-search-form" action="<?php echo CurrentPageName() ?>">
<?php $searchPanelClass = ($tbl_department_list->SearchWhere <> "") ? " show" : " show"; ?>
<div id="ftbl_departmentlistsrch-search-panel" class="ew-search-panel collapse<?php echo $searchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="tbl_department">
	<div class="ew-basic-search">
<div id="xsr_1" class="ew-row d-sm-flex">
	<div class="ew-quick-search input-group">
		<input type="text" name="<?php echo TABLE_BASIC_SEARCH ?>" id="<?php echo TABLE_BASIC_SEARCH ?>" class="form-control" value="<?php echo HtmlEncode($tbl_department_list->BasicSearch->getKeyword()) ?>" placeholder="<?php echo HtmlEncode($Language->phrase("Search")) ?>">
		<input type="hidden" name="<?php echo TABLE_BASIC_SEARCH_TYPE ?>" id="<?php echo TABLE_BASIC_SEARCH_TYPE ?>" value="<?php echo HtmlEncode($tbl_department_list->BasicSearch->getType()) ?>">
		<div class="input-group-append">
			<button class="btn btn-primary" name="btn-submit" id="btn-submit" type="submit"><?php echo $Language->phrase("SearchBtn") ?></button>
			<button type="button" data-toggle="dropdown" class="btn btn-primary dropdown-toggle dropdown-toggle-split" aria-haspopup="true" aria-expanded="false"><span id="searchtype"><?php echo $tbl_department_list->BasicSearch->getTypeNameShort() ?></span></button>
			<div class="dropdown-menu dropdown-menu-right">
				<a class="dropdown-item<?php if ($tbl_department_list->BasicSearch->getType() == "") echo " active"; ?>" href="javascript:void(0);" onclick="ew.setSearchType(this)"><?php echo $Language->phrase("QuickSearchAuto") ?></a>
				<a class="dropdown-item<?php if ($tbl_department_list->BasicSearch->getType() == "=") echo " active"; ?>" href="javascript:void(0);" onclick="ew.setSearchType(this,'=')"><?php echo $Language->phrase("QuickSearchExact") ?></a>
				<a class="dropdown-item<?php if ($tbl_department_list->BasicSearch->getType() == "AND") echo " active"; ?>" href="javascript:void(0);" onclick="ew.setSearchType(this,'AND')"><?php echo $Language->phrase("QuickSearchAll") ?></a>
				<a class="dropdown-item<?php if ($tbl_department_list->BasicSearch->getType() == "OR") echo " active"; ?>" href="javascript:void(0);" onclick="ew.setSearchType(this,'OR')"><?php echo $Language->phrase("QuickSearchAny") ?></a>
			</div>
		</div>
	</div>
</div>
	</div>
</div>
</form>
<?php } ?>
<?php } ?>
<?php $tbl_department_list->showPageHeader(); ?>
<?php
$tbl_department_list->showMessage();
?>
<?php if ($tbl_department_list->TotalRecs > 0 || $tbl_department->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($tbl_department_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> tbl_department">
<?php if (!$tbl_department->isExport()) { ?>
<div class="card-header ew-grid-upper-panel">
<?php if (!$tbl_department->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php if (!isset($tbl_department_list->Pager)) $tbl_department_list->Pager = new PrevNextPager($tbl_department_list->StartRec, $tbl_department_list->DisplayRecs, $tbl_department_list->TotalRecs, $tbl_department_list->AutoHidePager) ?>
<?php if ($tbl_department_list->Pager->RecordCount > 0 && $tbl_department_list->Pager->Visible) { ?>
<div class="ew-pager">
<span><?php echo $Language->Phrase("Page") ?>&nbsp;</span>
<div class="ew-prev-next"><div class="input-group input-group-sm">
<div class="input-group-prepend">
<!-- first page button -->
	<?php if ($tbl_department_list->Pager->FirstButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerFirst") ?>" href="<?php echo $tbl_department_list->pageUrl() ?>start=<?php echo $tbl_department_list->Pager->FirstButton->Start ?>"><i class="icon-first ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerFirst") ?>"><i class="icon-first ew-icon"></i></a>
	<?php } ?>
<!-- previous page button -->
	<?php if ($tbl_department_list->Pager->PrevButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerPrevious") ?>" href="<?php echo $tbl_department_list->pageUrl() ?>start=<?php echo $tbl_department_list->Pager->PrevButton->Start ?>"><i class="icon-prev ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerPrevious") ?>"><i class="icon-prev ew-icon"></i></a>
	<?php } ?>
</div>
<!-- current page number -->
	<input class="form-control" type="text" name="<?php echo TABLE_PAGE_NO ?>" value="<?php echo $tbl_department_list->Pager->CurrentPage ?>">
<div class="input-group-append">
<!-- next page button -->
	<?php if ($tbl_department_list->Pager->NextButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerNext") ?>" href="<?php echo $tbl_department_list->pageUrl() ?>start=<?php echo $tbl_department_list->Pager->NextButton->Start ?>"><i class="icon-next ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerNext") ?>"><i class="icon-next ew-icon"></i></a>
	<?php } ?>
<!-- last page button -->
	<?php if ($tbl_department_list->Pager->LastButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerLast") ?>" href="<?php echo $tbl_department_list->pageUrl() ?>start=<?php echo $tbl_department_list->Pager->LastButton->Start ?>"><i class="icon-last ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerLast") ?>"><i class="icon-last ew-icon"></i></a>
	<?php } ?>
</div>
</div>
</div>
<span>&nbsp;<?php echo $Language->Phrase("of") ?>&nbsp;<?php echo $tbl_department_list->Pager->PageCount ?></span>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php if ($tbl_department_list->Pager->RecordCount > 0) { ?>
<div class="ew-pager ew-rec">
	<span><?php echo $Language->Phrase("Record") ?>&nbsp;<?php echo $tbl_department_list->Pager->FromIndex ?>&nbsp;<?php echo $Language->Phrase("To") ?>&nbsp;<?php echo $tbl_department_list->Pager->ToIndex ?>&nbsp;<?php echo $Language->Phrase("Of") ?>&nbsp;<?php echo $tbl_department_list->Pager->RecordCount ?></span>
</div>
<?php } ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $tbl_department_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
<form name="ftbl_departmentlist" id="ftbl_departmentlist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($tbl_department_list->CheckToken) { ?>
<input type="hidden" name="<?php echo TOKEN_NAME ?>" value="<?php echo $tbl_department_list->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="tbl_department">
<input type="hidden" name="exporttype" id="exporttype" value="">
<div id="gmp_tbl_department" class="<?php if (IsResponsiveLayout()) { ?>table-responsive <?php } ?>card-body ew-grid-middle-panel">
<?php if ($tbl_department_list->TotalRecs > 0 || $tbl_department->isGridEdit()) { ?>
<table id="tbl_tbl_departmentlist" class="table ew-table"><!-- .ew-table ##-->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$tbl_department_list->RowType = ROWTYPE_HEADER;

// Render list options
$tbl_department_list->renderListOptions();

// Render list options (header, left)
$tbl_department_list->ListOptions->render("header", "left");
?>
<?php if ($tbl_department->PB_Tendd->Visible) { // PB_Tendd ?>
	<?php if ($tbl_department->sortUrl($tbl_department->PB_Tendd) == "") { ?>
		<th data-name="PB_Tendd" class="<?php echo $tbl_department->PB_Tendd->headerCellClass() ?>" style="white-space: nowrap;"><div id="elh_tbl_department_PB_Tendd" class="tbl_department_PB_Tendd"><div class="ew-table-header-caption"><?php echo $tbl_department->PB_Tendd->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="PB_Tendd" class="<?php echo $tbl_department->PB_Tendd->headerCellClass() ?>" style="white-space: nowrap;"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $tbl_department->SortUrl($tbl_department->PB_Tendd) ?>',2);"><div id="elh_tbl_department_PB_Tendd" class="tbl_department_PB_Tendd">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $tbl_department->PB_Tendd->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($tbl_department->PB_Tendd->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($tbl_department->PB_Tendd->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$tbl_department_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
if ($tbl_department->ExportAll && $tbl_department->isExport()) {
	$tbl_department_list->StopRec = $tbl_department_list->TotalRecs;
} else {

	// Set the last record to display
	if ($tbl_department_list->TotalRecs > $tbl_department_list->StartRec + $tbl_department_list->DisplayRecs - 1)
		$tbl_department_list->StopRec = $tbl_department_list->StartRec + $tbl_department_list->DisplayRecs - 1;
	else
		$tbl_department_list->StopRec = $tbl_department_list->TotalRecs;
}
$tbl_department_list->RecCnt = $tbl_department_list->StartRec - 1;
if ($tbl_department_list->Recordset && !$tbl_department_list->Recordset->EOF) {
	$tbl_department_list->Recordset->moveFirst();
	$selectLimit = $tbl_department_list->UseSelectLimit;
	if (!$selectLimit && $tbl_department_list->StartRec > 1)
		$tbl_department_list->Recordset->move($tbl_department_list->StartRec - 1);
} elseif (!$tbl_department->AllowAddDeleteRow && $tbl_department_list->StopRec == 0) {
	$tbl_department_list->StopRec = $tbl_department->GridAddRowCount;
}

// Initialize aggregate
$tbl_department->RowType = ROWTYPE_AGGREGATEINIT;
$tbl_department->resetAttributes();
$tbl_department_list->renderRow();
while ($tbl_department_list->RecCnt < $tbl_department_list->StopRec) {
	$tbl_department_list->RecCnt++;
	if ($tbl_department_list->RecCnt >= $tbl_department_list->StartRec) {
		$tbl_department_list->RowCnt++;

		// Set up key count
		$tbl_department_list->KeyCount = $tbl_department_list->RowIndex;

		// Init row class and style
		$tbl_department->resetAttributes();
		$tbl_department->CssClass = "";
		if ($tbl_department->isGridAdd()) {
		} else {
			$tbl_department_list->loadRowValues($tbl_department_list->Recordset); // Load row values
		}
		$tbl_department->RowType = ROWTYPE_VIEW; // Render view

		// Set up row id / data-rowindex
		$tbl_department->RowAttrs = array_merge($tbl_department->RowAttrs, array('data-rowindex'=>$tbl_department_list->RowCnt, 'id'=>'r' . $tbl_department_list->RowCnt . '_tbl_department', 'data-rowtype'=>$tbl_department->RowType));

		// Render row
		$tbl_department_list->renderRow();

		// Render list options
		$tbl_department_list->renderListOptions();
?>
	<tr<?php echo $tbl_department->rowAttributes() ?>>
<?php

// Render list options (body, left)
$tbl_department_list->ListOptions->render("body", "left", $tbl_department_list->RowCnt);
?>
	<?php if ($tbl_department->PB_Tendd->Visible) { // PB_Tendd ?>
		<td data-name="PB_Tendd"<?php echo $tbl_department->PB_Tendd->cellAttributes() ?>>
<span id="el<?php echo $tbl_department_list->RowCnt ?>_tbl_department_PB_Tendd" class="tbl_department_PB_Tendd">
<span<?php echo $tbl_department->PB_Tendd->viewAttributes() ?>>
<?php echo $tbl_department->PB_Tendd->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$tbl_department_list->ListOptions->render("body", "right", $tbl_department_list->RowCnt);
?>
	</tr>
<?php
	}
	if (!$tbl_department->isGridAdd())
		$tbl_department_list->Recordset->moveNext();
}
?>
</tbody>
</table><!-- /.ew-table -->
<?php } ?>
<?php if (!$tbl_department->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</div><!-- /.ew-grid-middle-panel -->
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($tbl_department_list->Recordset)
	$tbl_department_list->Recordset->Close();
?>
<?php if (!$tbl_department->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$tbl_department->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php if (!isset($tbl_department_list->Pager)) $tbl_department_list->Pager = new PrevNextPager($tbl_department_list->StartRec, $tbl_department_list->DisplayRecs, $tbl_department_list->TotalRecs, $tbl_department_list->AutoHidePager) ?>
<?php if ($tbl_department_list->Pager->RecordCount > 0 && $tbl_department_list->Pager->Visible) { ?>
<div class="ew-pager">
<span><?php echo $Language->Phrase("Page") ?>&nbsp;</span>
<div class="ew-prev-next"><div class="input-group input-group-sm">
<div class="input-group-prepend">
<!-- first page button -->
	<?php if ($tbl_department_list->Pager->FirstButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerFirst") ?>" href="<?php echo $tbl_department_list->pageUrl() ?>start=<?php echo $tbl_department_list->Pager->FirstButton->Start ?>"><i class="icon-first ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerFirst") ?>"><i class="icon-first ew-icon"></i></a>
	<?php } ?>
<!-- previous page button -->
	<?php if ($tbl_department_list->Pager->PrevButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerPrevious") ?>" href="<?php echo $tbl_department_list->pageUrl() ?>start=<?php echo $tbl_department_list->Pager->PrevButton->Start ?>"><i class="icon-prev ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerPrevious") ?>"><i class="icon-prev ew-icon"></i></a>
	<?php } ?>
</div>
<!-- current page number -->
	<input class="form-control" type="text" name="<?php echo TABLE_PAGE_NO ?>" value="<?php echo $tbl_department_list->Pager->CurrentPage ?>">
<div class="input-group-append">
<!-- next page button -->
	<?php if ($tbl_department_list->Pager->NextButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerNext") ?>" href="<?php echo $tbl_department_list->pageUrl() ?>start=<?php echo $tbl_department_list->Pager->NextButton->Start ?>"><i class="icon-next ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerNext") ?>"><i class="icon-next ew-icon"></i></a>
	<?php } ?>
<!-- last page button -->
	<?php if ($tbl_department_list->Pager->LastButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerLast") ?>" href="<?php echo $tbl_department_list->pageUrl() ?>start=<?php echo $tbl_department_list->Pager->LastButton->Start ?>"><i class="icon-last ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerLast") ?>"><i class="icon-last ew-icon"></i></a>
	<?php } ?>
</div>
</div>
</div>
<span>&nbsp;<?php echo $Language->Phrase("of") ?>&nbsp;<?php echo $tbl_department_list->Pager->PageCount ?></span>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php if ($tbl_department_list->Pager->RecordCount > 0) { ?>
<div class="ew-pager ew-rec">
	<span><?php echo $Language->Phrase("Record") ?>&nbsp;<?php echo $tbl_department_list->Pager->FromIndex ?>&nbsp;<?php echo $Language->Phrase("To") ?>&nbsp;<?php echo $tbl_department_list->Pager->ToIndex ?>&nbsp;<?php echo $Language->Phrase("Of") ?>&nbsp;<?php echo $tbl_department_list->Pager->RecordCount ?></span>
</div>
<?php } ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $tbl_department_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($tbl_department_list->TotalRecs == 0 && !$tbl_department->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $tbl_department_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$tbl_department_list->showPageFooter();
if (DEBUG_ENABLED)
	echo GetDebugMessage();
?>
<?php if (!$tbl_department->isExport()) { ?>
<script>

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php } ?>
<?php include_once "footer.php" ?>
<?php
$tbl_department_list->terminate();
?>