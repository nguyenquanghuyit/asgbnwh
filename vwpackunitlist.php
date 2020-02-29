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
$vwpackunit_list = new vwpackunit_list();

// Run the page
$vwpackunit_list->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$vwpackunit_list->Page_Render();
?>
<?php include_once "header.php" ?>
<?php if (!$vwpackunit->isExport()) { ?>
<script>

// Form object
currentPageID = ew.PAGE_ID = "list";
var fvwpackunitlist = currentForm = new ew.Form("fvwpackunitlist", "list");
fvwpackunitlist.formKeyCountName = '<?php echo $vwpackunit_list->FormKeyCountName ?>';

// Form_CustomValidate event
fvwpackunitlist.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

	// Your custom validation code here, return false if invalid.
	return true;
}

// Use JavaScript validation or not
fvwpackunitlist.validateRequired = <?php echo json_encode(CLIENT_VALIDATE) ?>;

// Dynamic selection lists
// Form object for search

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
<?php if (!$vwpackunit->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($vwpackunit_list->TotalRecs > 0 && $vwpackunit_list->ExportOptions->visible()) { ?>
<?php $vwpackunit_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($vwpackunit_list->ImportOptions->visible()) { ?>
<?php $vwpackunit_list->ImportOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php
$vwpackunit_list->renderOtherOptions();
?>
<?php $vwpackunit_list->showPageHeader(); ?>
<?php
$vwpackunit_list->showMessage();
?>
<?php if ($vwpackunit_list->TotalRecs > 0 || $vwpackunit->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($vwpackunit_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> vwpackunit">
<?php if (!$vwpackunit->isExport()) { ?>
<div class="card-header ew-grid-upper-panel">
<?php if (!$vwpackunit->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php if (!isset($vwpackunit_list->Pager)) $vwpackunit_list->Pager = new PrevNextPager($vwpackunit_list->StartRec, $vwpackunit_list->DisplayRecs, $vwpackunit_list->TotalRecs, $vwpackunit_list->AutoHidePager) ?>
<?php if ($vwpackunit_list->Pager->RecordCount > 0 && $vwpackunit_list->Pager->Visible) { ?>
<div class="ew-pager">
<span><?php echo $Language->Phrase("Page") ?>&nbsp;</span>
<div class="ew-prev-next"><div class="input-group input-group-sm">
<div class="input-group-prepend">
<!-- first page button -->
	<?php if ($vwpackunit_list->Pager->FirstButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerFirst") ?>" href="<?php echo $vwpackunit_list->pageUrl() ?>start=<?php echo $vwpackunit_list->Pager->FirstButton->Start ?>"><i class="icon-first ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerFirst") ?>"><i class="icon-first ew-icon"></i></a>
	<?php } ?>
<!-- previous page button -->
	<?php if ($vwpackunit_list->Pager->PrevButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerPrevious") ?>" href="<?php echo $vwpackunit_list->pageUrl() ?>start=<?php echo $vwpackunit_list->Pager->PrevButton->Start ?>"><i class="icon-prev ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerPrevious") ?>"><i class="icon-prev ew-icon"></i></a>
	<?php } ?>
</div>
<!-- current page number -->
	<input class="form-control" type="text" name="<?php echo TABLE_PAGE_NO ?>" value="<?php echo $vwpackunit_list->Pager->CurrentPage ?>">
<div class="input-group-append">
<!-- next page button -->
	<?php if ($vwpackunit_list->Pager->NextButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerNext") ?>" href="<?php echo $vwpackunit_list->pageUrl() ?>start=<?php echo $vwpackunit_list->Pager->NextButton->Start ?>"><i class="icon-next ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerNext") ?>"><i class="icon-next ew-icon"></i></a>
	<?php } ?>
<!-- last page button -->
	<?php if ($vwpackunit_list->Pager->LastButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerLast") ?>" href="<?php echo $vwpackunit_list->pageUrl() ?>start=<?php echo $vwpackunit_list->Pager->LastButton->Start ?>"><i class="icon-last ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerLast") ?>"><i class="icon-last ew-icon"></i></a>
	<?php } ?>
</div>
</div>
</div>
<span>&nbsp;<?php echo $Language->Phrase("of") ?>&nbsp;<?php echo $vwpackunit_list->Pager->PageCount ?></span>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php if ($vwpackunit_list->Pager->RecordCount > 0) { ?>
<div class="ew-pager ew-rec">
	<span><?php echo $Language->Phrase("Record") ?>&nbsp;<?php echo $vwpackunit_list->Pager->FromIndex ?>&nbsp;<?php echo $Language->Phrase("To") ?>&nbsp;<?php echo $vwpackunit_list->Pager->ToIndex ?>&nbsp;<?php echo $Language->Phrase("Of") ?>&nbsp;<?php echo $vwpackunit_list->Pager->RecordCount ?></span>
</div>
<?php } ?>
<?php if ($vwpackunit_list->TotalRecs > 0 && (!$vwpackunit_list->AutoHidePageSizeSelector || $vwpackunit_list->Pager->Visible)) { ?>
<div class="ew-pager">
<input type="hidden" name="t" value="vwpackunit">
<select name="<?php echo TABLE_REC_PER_PAGE ?>" class="form-control form-control-sm ew-tooltip" title="<?php echo $Language->phrase("RecordsPerPage") ?>" onchange="this.form.submit();">
<option value="20"<?php if ($vwpackunit_list->DisplayRecs == 20) { ?> selected<?php } ?>>20</option>
<option value="50"<?php if ($vwpackunit_list->DisplayRecs == 50) { ?> selected<?php } ?>>50</option>
<option value="100"<?php if ($vwpackunit_list->DisplayRecs == 100) { ?> selected<?php } ?>>100</option>
<option value="200"<?php if ($vwpackunit_list->DisplayRecs == 200) { ?> selected<?php } ?>>200</option>
<option value="500"<?php if ($vwpackunit_list->DisplayRecs == 500) { ?> selected<?php } ?>>500</option>
<option value="ALL"<?php if ($vwpackunit->getRecordsPerPage() == -1) { ?> selected<?php } ?>><?php echo $Language->Phrase("AllRecords") ?></option>
</select>
</div>
<?php } ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $vwpackunit_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
<form name="fvwpackunitlist" id="fvwpackunitlist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($vwpackunit_list->CheckToken) { ?>
<input type="hidden" name="<?php echo TOKEN_NAME ?>" value="<?php echo $vwpackunit_list->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="vwpackunit">
<input type="hidden" name="exporttype" id="exporttype" value="">
<div id="gmp_vwpackunit" class="<?php if (IsResponsiveLayout()) { ?>table-responsive <?php } ?>card-body ew-grid-middle-panel">
<?php if ($vwpackunit_list->TotalRecs > 0 || $vwpackunit->isGridEdit()) { ?>
<table id="tbl_vwpackunitlist" class="table ew-table"><!-- .ew-table ##-->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$vwpackunit_list->RowType = ROWTYPE_HEADER;

// Render list options
$vwpackunit_list->renderListOptions();

// Render list options (header, left)
$vwpackunit_list->ListOptions->render("header", "left");
?>
<?php if ($vwpackunit->idPacking->Visible) { // idPacking ?>
	<?php if ($vwpackunit->sortUrl($vwpackunit->idPacking) == "") { ?>
		<th data-name="idPacking" class="<?php echo $vwpackunit->idPacking->headerCellClass() ?>"><div id="elh_vwpackunit_idPacking" class="vwpackunit_idPacking"><div class="ew-table-header-caption"><?php echo $vwpackunit->idPacking->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="idPacking" class="<?php echo $vwpackunit->idPacking->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $vwpackunit->SortUrl($vwpackunit->idPacking) ?>',2);"><div id="elh_vwpackunit_idPacking" class="vwpackunit_idPacking">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $vwpackunit->idPacking->caption() ?></span><span class="ew-table-header-sort"><?php if ($vwpackunit->idPacking->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($vwpackunit->idPacking->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$vwpackunit_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
if ($vwpackunit->ExportAll && $vwpackunit->isExport()) {
	$vwpackunit_list->StopRec = $vwpackunit_list->TotalRecs;
} else {

	// Set the last record to display
	if ($vwpackunit_list->TotalRecs > $vwpackunit_list->StartRec + $vwpackunit_list->DisplayRecs - 1)
		$vwpackunit_list->StopRec = $vwpackunit_list->StartRec + $vwpackunit_list->DisplayRecs - 1;
	else
		$vwpackunit_list->StopRec = $vwpackunit_list->TotalRecs;
}
$vwpackunit_list->RecCnt = $vwpackunit_list->StartRec - 1;
if ($vwpackunit_list->Recordset && !$vwpackunit_list->Recordset->EOF) {
	$vwpackunit_list->Recordset->moveFirst();
	$selectLimit = $vwpackunit_list->UseSelectLimit;
	if (!$selectLimit && $vwpackunit_list->StartRec > 1)
		$vwpackunit_list->Recordset->move($vwpackunit_list->StartRec - 1);
} elseif (!$vwpackunit->AllowAddDeleteRow && $vwpackunit_list->StopRec == 0) {
	$vwpackunit_list->StopRec = $vwpackunit->GridAddRowCount;
}

// Initialize aggregate
$vwpackunit->RowType = ROWTYPE_AGGREGATEINIT;
$vwpackunit->resetAttributes();
$vwpackunit_list->renderRow();
while ($vwpackunit_list->RecCnt < $vwpackunit_list->StopRec) {
	$vwpackunit_list->RecCnt++;
	if ($vwpackunit_list->RecCnt >= $vwpackunit_list->StartRec) {
		$vwpackunit_list->RowCnt++;

		// Set up key count
		$vwpackunit_list->KeyCount = $vwpackunit_list->RowIndex;

		// Init row class and style
		$vwpackunit->resetAttributes();
		$vwpackunit->CssClass = "";
		if ($vwpackunit->isGridAdd()) {
		} else {
			$vwpackunit_list->loadRowValues($vwpackunit_list->Recordset); // Load row values
		}
		$vwpackunit->RowType = ROWTYPE_VIEW; // Render view

		// Set up row id / data-rowindex
		$vwpackunit->RowAttrs = array_merge($vwpackunit->RowAttrs, array('data-rowindex'=>$vwpackunit_list->RowCnt, 'id'=>'r' . $vwpackunit_list->RowCnt . '_vwpackunit', 'data-rowtype'=>$vwpackunit->RowType));

		// Render row
		$vwpackunit_list->renderRow();

		// Render list options
		$vwpackunit_list->renderListOptions();
?>
	<tr<?php echo $vwpackunit->rowAttributes() ?>>
<?php

// Render list options (body, left)
$vwpackunit_list->ListOptions->render("body", "left", $vwpackunit_list->RowCnt);
?>
	<?php if ($vwpackunit->idPacking->Visible) { // idPacking ?>
		<td data-name="idPacking"<?php echo $vwpackunit->idPacking->cellAttributes() ?>>
<span id="el<?php echo $vwpackunit_list->RowCnt ?>_vwpackunit_idPacking" class="vwpackunit_idPacking">
<span<?php echo $vwpackunit->idPacking->viewAttributes() ?>>
<?php echo $vwpackunit->idPacking->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$vwpackunit_list->ListOptions->render("body", "right", $vwpackunit_list->RowCnt);
?>
	</tr>
<?php
	}
	if (!$vwpackunit->isGridAdd())
		$vwpackunit_list->Recordset->moveNext();
}
?>
</tbody>
</table><!-- /.ew-table -->
<?php } ?>
<?php if (!$vwpackunit->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</div><!-- /.ew-grid-middle-panel -->
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($vwpackunit_list->Recordset)
	$vwpackunit_list->Recordset->Close();
?>
<?php if (!$vwpackunit->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$vwpackunit->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php if (!isset($vwpackunit_list->Pager)) $vwpackunit_list->Pager = new PrevNextPager($vwpackunit_list->StartRec, $vwpackunit_list->DisplayRecs, $vwpackunit_list->TotalRecs, $vwpackunit_list->AutoHidePager) ?>
<?php if ($vwpackunit_list->Pager->RecordCount > 0 && $vwpackunit_list->Pager->Visible) { ?>
<div class="ew-pager">
<span><?php echo $Language->Phrase("Page") ?>&nbsp;</span>
<div class="ew-prev-next"><div class="input-group input-group-sm">
<div class="input-group-prepend">
<!-- first page button -->
	<?php if ($vwpackunit_list->Pager->FirstButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerFirst") ?>" href="<?php echo $vwpackunit_list->pageUrl() ?>start=<?php echo $vwpackunit_list->Pager->FirstButton->Start ?>"><i class="icon-first ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerFirst") ?>"><i class="icon-first ew-icon"></i></a>
	<?php } ?>
<!-- previous page button -->
	<?php if ($vwpackunit_list->Pager->PrevButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerPrevious") ?>" href="<?php echo $vwpackunit_list->pageUrl() ?>start=<?php echo $vwpackunit_list->Pager->PrevButton->Start ?>"><i class="icon-prev ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerPrevious") ?>"><i class="icon-prev ew-icon"></i></a>
	<?php } ?>
</div>
<!-- current page number -->
	<input class="form-control" type="text" name="<?php echo TABLE_PAGE_NO ?>" value="<?php echo $vwpackunit_list->Pager->CurrentPage ?>">
<div class="input-group-append">
<!-- next page button -->
	<?php if ($vwpackunit_list->Pager->NextButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerNext") ?>" href="<?php echo $vwpackunit_list->pageUrl() ?>start=<?php echo $vwpackunit_list->Pager->NextButton->Start ?>"><i class="icon-next ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerNext") ?>"><i class="icon-next ew-icon"></i></a>
	<?php } ?>
<!-- last page button -->
	<?php if ($vwpackunit_list->Pager->LastButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerLast") ?>" href="<?php echo $vwpackunit_list->pageUrl() ?>start=<?php echo $vwpackunit_list->Pager->LastButton->Start ?>"><i class="icon-last ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerLast") ?>"><i class="icon-last ew-icon"></i></a>
	<?php } ?>
</div>
</div>
</div>
<span>&nbsp;<?php echo $Language->Phrase("of") ?>&nbsp;<?php echo $vwpackunit_list->Pager->PageCount ?></span>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php if ($vwpackunit_list->Pager->RecordCount > 0) { ?>
<div class="ew-pager ew-rec">
	<span><?php echo $Language->Phrase("Record") ?>&nbsp;<?php echo $vwpackunit_list->Pager->FromIndex ?>&nbsp;<?php echo $Language->Phrase("To") ?>&nbsp;<?php echo $vwpackunit_list->Pager->ToIndex ?>&nbsp;<?php echo $Language->Phrase("Of") ?>&nbsp;<?php echo $vwpackunit_list->Pager->RecordCount ?></span>
</div>
<?php } ?>
<?php if ($vwpackunit_list->TotalRecs > 0 && (!$vwpackunit_list->AutoHidePageSizeSelector || $vwpackunit_list->Pager->Visible)) { ?>
<div class="ew-pager">
<input type="hidden" name="t" value="vwpackunit">
<select name="<?php echo TABLE_REC_PER_PAGE ?>" class="form-control form-control-sm ew-tooltip" title="<?php echo $Language->phrase("RecordsPerPage") ?>" onchange="this.form.submit();">
<option value="20"<?php if ($vwpackunit_list->DisplayRecs == 20) { ?> selected<?php } ?>>20</option>
<option value="50"<?php if ($vwpackunit_list->DisplayRecs == 50) { ?> selected<?php } ?>>50</option>
<option value="100"<?php if ($vwpackunit_list->DisplayRecs == 100) { ?> selected<?php } ?>>100</option>
<option value="200"<?php if ($vwpackunit_list->DisplayRecs == 200) { ?> selected<?php } ?>>200</option>
<option value="500"<?php if ($vwpackunit_list->DisplayRecs == 500) { ?> selected<?php } ?>>500</option>
<option value="ALL"<?php if ($vwpackunit->getRecordsPerPage() == -1) { ?> selected<?php } ?>><?php echo $Language->Phrase("AllRecords") ?></option>
</select>
</div>
<?php } ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $vwpackunit_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($vwpackunit_list->TotalRecs == 0 && !$vwpackunit->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $vwpackunit_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$vwpackunit_list->showPageFooter();
if (DEBUG_ENABLED)
	echo GetDebugMessage();
?>
<?php if (!$vwpackunit->isExport()) { ?>
<script>

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php } ?>
<?php include_once "footer.php" ?>
<?php
$vwpackunit_list->terminate();
?>