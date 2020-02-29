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
$vwmasterguide_list = new vwmasterguide_list();

// Run the page
$vwmasterguide_list->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$vwmasterguide_list->Page_Render();
?>
<?php include_once "header.php" ?>
<?php if (!$vwmasterguide->isExport()) { ?>
<script>

// Form object
currentPageID = ew.PAGE_ID = "list";
var fvwmasterguidelist = currentForm = new ew.Form("fvwmasterguidelist", "list");
fvwmasterguidelist.formKeyCountName = '<?php echo $vwmasterguide_list->FormKeyCountName ?>';

// Form_CustomValidate event
fvwmasterguidelist.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

	// Your custom validation code here, return false if invalid.
	return true;
}

// Use JavaScript validation or not
fvwmasterguidelist.validateRequired = <?php echo json_encode(CLIENT_VALIDATE) ?>;

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
<?php if (!$vwmasterguide->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($vwmasterguide_list->TotalRecs > 0 && $vwmasterguide_list->ExportOptions->visible()) { ?>
<?php $vwmasterguide_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($vwmasterguide_list->ImportOptions->visible()) { ?>
<?php $vwmasterguide_list->ImportOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php
$vwmasterguide_list->renderOtherOptions();
?>
<?php $vwmasterguide_list->showPageHeader(); ?>
<?php
$vwmasterguide_list->showMessage();
?>
<?php if ($vwmasterguide_list->TotalRecs > 0 || $vwmasterguide->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($vwmasterguide_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> vwmasterguide">
<?php if (!$vwmasterguide->isExport()) { ?>
<div class="card-header ew-grid-upper-panel">
<?php if (!$vwmasterguide->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php if (!isset($vwmasterguide_list->Pager)) $vwmasterguide_list->Pager = new PrevNextPager($vwmasterguide_list->StartRec, $vwmasterguide_list->DisplayRecs, $vwmasterguide_list->TotalRecs, $vwmasterguide_list->AutoHidePager) ?>
<?php if ($vwmasterguide_list->Pager->RecordCount > 0 && $vwmasterguide_list->Pager->Visible) { ?>
<div class="ew-pager">
<span><?php echo $Language->Phrase("Page") ?>&nbsp;</span>
<div class="ew-prev-next"><div class="input-group input-group-sm">
<div class="input-group-prepend">
<!-- first page button -->
	<?php if ($vwmasterguide_list->Pager->FirstButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerFirst") ?>" href="<?php echo $vwmasterguide_list->pageUrl() ?>start=<?php echo $vwmasterguide_list->Pager->FirstButton->Start ?>"><i class="icon-first ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerFirst") ?>"><i class="icon-first ew-icon"></i></a>
	<?php } ?>
<!-- previous page button -->
	<?php if ($vwmasterguide_list->Pager->PrevButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerPrevious") ?>" href="<?php echo $vwmasterguide_list->pageUrl() ?>start=<?php echo $vwmasterguide_list->Pager->PrevButton->Start ?>"><i class="icon-prev ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerPrevious") ?>"><i class="icon-prev ew-icon"></i></a>
	<?php } ?>
</div>
<!-- current page number -->
	<input class="form-control" type="text" name="<?php echo TABLE_PAGE_NO ?>" value="<?php echo $vwmasterguide_list->Pager->CurrentPage ?>">
<div class="input-group-append">
<!-- next page button -->
	<?php if ($vwmasterguide_list->Pager->NextButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerNext") ?>" href="<?php echo $vwmasterguide_list->pageUrl() ?>start=<?php echo $vwmasterguide_list->Pager->NextButton->Start ?>"><i class="icon-next ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerNext") ?>"><i class="icon-next ew-icon"></i></a>
	<?php } ?>
<!-- last page button -->
	<?php if ($vwmasterguide_list->Pager->LastButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerLast") ?>" href="<?php echo $vwmasterguide_list->pageUrl() ?>start=<?php echo $vwmasterguide_list->Pager->LastButton->Start ?>"><i class="icon-last ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerLast") ?>"><i class="icon-last ew-icon"></i></a>
	<?php } ?>
</div>
</div>
</div>
<span>&nbsp;<?php echo $Language->Phrase("of") ?>&nbsp;<?php echo $vwmasterguide_list->Pager->PageCount ?></span>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php if ($vwmasterguide_list->Pager->RecordCount > 0) { ?>
<div class="ew-pager ew-rec">
	<span><?php echo $Language->Phrase("Record") ?>&nbsp;<?php echo $vwmasterguide_list->Pager->FromIndex ?>&nbsp;<?php echo $Language->Phrase("To") ?>&nbsp;<?php echo $vwmasterguide_list->Pager->ToIndex ?>&nbsp;<?php echo $Language->Phrase("Of") ?>&nbsp;<?php echo $vwmasterguide_list->Pager->RecordCount ?></span>
</div>
<?php } ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $vwmasterguide_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
<form name="fvwmasterguidelist" id="fvwmasterguidelist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($vwmasterguide_list->CheckToken) { ?>
<input type="hidden" name="<?php echo TOKEN_NAME ?>" value="<?php echo $vwmasterguide_list->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="vwmasterguide">
<input type="hidden" name="exporttype" id="exporttype" value="">
<div id="gmp_vwmasterguide" class="<?php if (IsResponsiveLayout()) { ?>table-responsive <?php } ?>card-body ew-grid-middle-panel">
<?php if ($vwmasterguide_list->TotalRecs > 0 || $vwmasterguide->isGridEdit()) { ?>
<table id="tbl_vwmasterguidelist" class="table ew-table"><!-- .ew-table ##-->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$vwmasterguide_list->RowType = ROWTYPE_HEADER;

// Render list options
$vwmasterguide_list->renderListOptions();

// Render list options (header, left)
$vwmasterguide_list->ListOptions->render("header", "left");
?>
<?php if ($vwmasterguide->ID_Order->Visible) { // ID_Order ?>
	<?php if ($vwmasterguide->sortUrl($vwmasterguide->ID_Order) == "") { ?>
		<th data-name="ID_Order" class="<?php echo $vwmasterguide->ID_Order->headerCellClass() ?>"><div id="elh_vwmasterguide_ID_Order" class="vwmasterguide_ID_Order"><div class="ew-table-header-caption"><?php echo $vwmasterguide->ID_Order->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="ID_Order" class="<?php echo $vwmasterguide->ID_Order->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $vwmasterguide->SortUrl($vwmasterguide->ID_Order) ?>',2);"><div id="elh_vwmasterguide_ID_Order" class="vwmasterguide_ID_Order">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $vwmasterguide->ID_Order->caption() ?></span><span class="ew-table-header-sort"><?php if ($vwmasterguide->ID_Order->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($vwmasterguide->ID_Order->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$vwmasterguide_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
if ($vwmasterguide->ExportAll && $vwmasterguide->isExport()) {
	$vwmasterguide_list->StopRec = $vwmasterguide_list->TotalRecs;
} else {

	// Set the last record to display
	if ($vwmasterguide_list->TotalRecs > $vwmasterguide_list->StartRec + $vwmasterguide_list->DisplayRecs - 1)
		$vwmasterguide_list->StopRec = $vwmasterguide_list->StartRec + $vwmasterguide_list->DisplayRecs - 1;
	else
		$vwmasterguide_list->StopRec = $vwmasterguide_list->TotalRecs;
}
$vwmasterguide_list->RecCnt = $vwmasterguide_list->StartRec - 1;
if ($vwmasterguide_list->Recordset && !$vwmasterguide_list->Recordset->EOF) {
	$vwmasterguide_list->Recordset->moveFirst();
	$selectLimit = $vwmasterguide_list->UseSelectLimit;
	if (!$selectLimit && $vwmasterguide_list->StartRec > 1)
		$vwmasterguide_list->Recordset->move($vwmasterguide_list->StartRec - 1);
} elseif (!$vwmasterguide->AllowAddDeleteRow && $vwmasterguide_list->StopRec == 0) {
	$vwmasterguide_list->StopRec = $vwmasterguide->GridAddRowCount;
}

// Initialize aggregate
$vwmasterguide->RowType = ROWTYPE_AGGREGATEINIT;
$vwmasterguide->resetAttributes();
$vwmasterguide_list->renderRow();
while ($vwmasterguide_list->RecCnt < $vwmasterguide_list->StopRec) {
	$vwmasterguide_list->RecCnt++;
	if ($vwmasterguide_list->RecCnt >= $vwmasterguide_list->StartRec) {
		$vwmasterguide_list->RowCnt++;

		// Set up key count
		$vwmasterguide_list->KeyCount = $vwmasterguide_list->RowIndex;

		// Init row class and style
		$vwmasterguide->resetAttributes();
		$vwmasterguide->CssClass = "";
		if ($vwmasterguide->isGridAdd()) {
		} else {
			$vwmasterguide_list->loadRowValues($vwmasterguide_list->Recordset); // Load row values
		}
		$vwmasterguide->RowType = ROWTYPE_VIEW; // Render view

		// Set up row id / data-rowindex
		$vwmasterguide->RowAttrs = array_merge($vwmasterguide->RowAttrs, array('data-rowindex'=>$vwmasterguide_list->RowCnt, 'id'=>'r' . $vwmasterguide_list->RowCnt . '_vwmasterguide', 'data-rowtype'=>$vwmasterguide->RowType));

		// Render row
		$vwmasterguide_list->renderRow();

		// Render list options
		$vwmasterguide_list->renderListOptions();
?>
	<tr<?php echo $vwmasterguide->rowAttributes() ?>>
<?php

// Render list options (body, left)
$vwmasterguide_list->ListOptions->render("body", "left", $vwmasterguide_list->RowCnt);
?>
	<?php if ($vwmasterguide->ID_Order->Visible) { // ID_Order ?>
		<td data-name="ID_Order"<?php echo $vwmasterguide->ID_Order->cellAttributes() ?>>
<span id="el<?php echo $vwmasterguide_list->RowCnt ?>_vwmasterguide_ID_Order" class="vwmasterguide_ID_Order">
<span<?php echo $vwmasterguide->ID_Order->viewAttributes() ?>>
<?php echo $vwmasterguide->ID_Order->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$vwmasterguide_list->ListOptions->render("body", "right", $vwmasterguide_list->RowCnt);
?>
	</tr>
<?php
	}
	if (!$vwmasterguide->isGridAdd())
		$vwmasterguide_list->Recordset->moveNext();
}
?>
</tbody>
</table><!-- /.ew-table -->
<?php } ?>
<?php if (!$vwmasterguide->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</div><!-- /.ew-grid-middle-panel -->
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($vwmasterguide_list->Recordset)
	$vwmasterguide_list->Recordset->Close();
?>
<?php if (!$vwmasterguide->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$vwmasterguide->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php if (!isset($vwmasterguide_list->Pager)) $vwmasterguide_list->Pager = new PrevNextPager($vwmasterguide_list->StartRec, $vwmasterguide_list->DisplayRecs, $vwmasterguide_list->TotalRecs, $vwmasterguide_list->AutoHidePager) ?>
<?php if ($vwmasterguide_list->Pager->RecordCount > 0 && $vwmasterguide_list->Pager->Visible) { ?>
<div class="ew-pager">
<span><?php echo $Language->Phrase("Page") ?>&nbsp;</span>
<div class="ew-prev-next"><div class="input-group input-group-sm">
<div class="input-group-prepend">
<!-- first page button -->
	<?php if ($vwmasterguide_list->Pager->FirstButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerFirst") ?>" href="<?php echo $vwmasterguide_list->pageUrl() ?>start=<?php echo $vwmasterguide_list->Pager->FirstButton->Start ?>"><i class="icon-first ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerFirst") ?>"><i class="icon-first ew-icon"></i></a>
	<?php } ?>
<!-- previous page button -->
	<?php if ($vwmasterguide_list->Pager->PrevButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerPrevious") ?>" href="<?php echo $vwmasterguide_list->pageUrl() ?>start=<?php echo $vwmasterguide_list->Pager->PrevButton->Start ?>"><i class="icon-prev ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerPrevious") ?>"><i class="icon-prev ew-icon"></i></a>
	<?php } ?>
</div>
<!-- current page number -->
	<input class="form-control" type="text" name="<?php echo TABLE_PAGE_NO ?>" value="<?php echo $vwmasterguide_list->Pager->CurrentPage ?>">
<div class="input-group-append">
<!-- next page button -->
	<?php if ($vwmasterguide_list->Pager->NextButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerNext") ?>" href="<?php echo $vwmasterguide_list->pageUrl() ?>start=<?php echo $vwmasterguide_list->Pager->NextButton->Start ?>"><i class="icon-next ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerNext") ?>"><i class="icon-next ew-icon"></i></a>
	<?php } ?>
<!-- last page button -->
	<?php if ($vwmasterguide_list->Pager->LastButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerLast") ?>" href="<?php echo $vwmasterguide_list->pageUrl() ?>start=<?php echo $vwmasterguide_list->Pager->LastButton->Start ?>"><i class="icon-last ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerLast") ?>"><i class="icon-last ew-icon"></i></a>
	<?php } ?>
</div>
</div>
</div>
<span>&nbsp;<?php echo $Language->Phrase("of") ?>&nbsp;<?php echo $vwmasterguide_list->Pager->PageCount ?></span>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php if ($vwmasterguide_list->Pager->RecordCount > 0) { ?>
<div class="ew-pager ew-rec">
	<span><?php echo $Language->Phrase("Record") ?>&nbsp;<?php echo $vwmasterguide_list->Pager->FromIndex ?>&nbsp;<?php echo $Language->Phrase("To") ?>&nbsp;<?php echo $vwmasterguide_list->Pager->ToIndex ?>&nbsp;<?php echo $Language->Phrase("Of") ?>&nbsp;<?php echo $vwmasterguide_list->Pager->RecordCount ?></span>
</div>
<?php } ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $vwmasterguide_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($vwmasterguide_list->TotalRecs == 0 && !$vwmasterguide->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $vwmasterguide_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$vwmasterguide_list->showPageFooter();
if (DEBUG_ENABLED)
	echo GetDebugMessage();
?>
<?php if (!$vwmasterguide->isExport()) { ?>
<script>

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php } ?>
<?php include_once "footer.php" ?>
<?php
$vwmasterguide_list->terminate();
?>