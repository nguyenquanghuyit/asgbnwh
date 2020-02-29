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
$vt_orderguide_list = new vt_orderguide_list();

// Run the page
$vt_orderguide_list->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$vt_orderguide_list->Page_Render();
?>
<?php include_once "header.php" ?>
<?php if (!$vt_orderguide->isExport()) { ?>
<script>

// Form object
currentPageID = ew.PAGE_ID = "list";
var fvt_orderguidelist = currentForm = new ew.Form("fvt_orderguidelist", "list");
fvt_orderguidelist.formKeyCountName = '<?php echo $vt_orderguide_list->FormKeyCountName ?>';

// Form_CustomValidate event
fvt_orderguidelist.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

	// Your custom validation code here, return false if invalid.
	return true;
}

// Use JavaScript validation or not
fvt_orderguidelist.validateRequired = <?php echo json_encode(CLIENT_VALIDATE) ?>;

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
<?php if (!$vt_orderguide->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($vt_orderguide_list->TotalRecs > 0 && $vt_orderguide_list->ExportOptions->visible()) { ?>
<?php $vt_orderguide_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($vt_orderguide_list->ImportOptions->visible()) { ?>
<?php $vt_orderguide_list->ImportOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php if (!$vt_orderguide->isExport() || EXPORT_MASTER_RECORD && $vt_orderguide->isExport("print")) { ?>
<?php
if ($vt_orderguide_list->DbMasterFilter <> "" && $vt_orderguide->getCurrentMasterTable() == "vt_order") {
	if ($vt_orderguide_list->MasterRecordExists) {
		include_once "vt_ordermaster.php";
	}
}
?>
<?php } ?>
<?php
$vt_orderguide_list->renderOtherOptions();
?>
<?php $vt_orderguide_list->showPageHeader(); ?>
<?php
$vt_orderguide_list->showMessage();
?>
<?php if ($vt_orderguide_list->TotalRecs > 0 || $vt_orderguide->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($vt_orderguide_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> vt_orderguide">
<?php if (!$vt_orderguide->isExport()) { ?>
<div class="card-header ew-grid-upper-panel">
<?php if (!$vt_orderguide->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php if (!isset($vt_orderguide_list->Pager)) $vt_orderguide_list->Pager = new PrevNextPager($vt_orderguide_list->StartRec, $vt_orderguide_list->DisplayRecs, $vt_orderguide_list->TotalRecs, $vt_orderguide_list->AutoHidePager) ?>
<?php if ($vt_orderguide_list->Pager->RecordCount > 0 && $vt_orderguide_list->Pager->Visible) { ?>
<div class="ew-pager">
<span><?php echo $Language->Phrase("Page") ?>&nbsp;</span>
<div class="ew-prev-next"><div class="input-group input-group-sm">
<div class="input-group-prepend">
<!-- first page button -->
	<?php if ($vt_orderguide_list->Pager->FirstButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerFirst") ?>" href="<?php echo $vt_orderguide_list->pageUrl() ?>start=<?php echo $vt_orderguide_list->Pager->FirstButton->Start ?>"><i class="icon-first ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerFirst") ?>"><i class="icon-first ew-icon"></i></a>
	<?php } ?>
<!-- previous page button -->
	<?php if ($vt_orderguide_list->Pager->PrevButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerPrevious") ?>" href="<?php echo $vt_orderguide_list->pageUrl() ?>start=<?php echo $vt_orderguide_list->Pager->PrevButton->Start ?>"><i class="icon-prev ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerPrevious") ?>"><i class="icon-prev ew-icon"></i></a>
	<?php } ?>
</div>
<!-- current page number -->
	<input class="form-control" type="text" name="<?php echo TABLE_PAGE_NO ?>" value="<?php echo $vt_orderguide_list->Pager->CurrentPage ?>">
<div class="input-group-append">
<!-- next page button -->
	<?php if ($vt_orderguide_list->Pager->NextButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerNext") ?>" href="<?php echo $vt_orderguide_list->pageUrl() ?>start=<?php echo $vt_orderguide_list->Pager->NextButton->Start ?>"><i class="icon-next ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerNext") ?>"><i class="icon-next ew-icon"></i></a>
	<?php } ?>
<!-- last page button -->
	<?php if ($vt_orderguide_list->Pager->LastButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerLast") ?>" href="<?php echo $vt_orderguide_list->pageUrl() ?>start=<?php echo $vt_orderguide_list->Pager->LastButton->Start ?>"><i class="icon-last ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerLast") ?>"><i class="icon-last ew-icon"></i></a>
	<?php } ?>
</div>
</div>
</div>
<span>&nbsp;<?php echo $Language->Phrase("of") ?>&nbsp;<?php echo $vt_orderguide_list->Pager->PageCount ?></span>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php if ($vt_orderguide_list->Pager->RecordCount > 0) { ?>
<div class="ew-pager ew-rec">
	<span><?php echo $Language->Phrase("Record") ?>&nbsp;<?php echo $vt_orderguide_list->Pager->FromIndex ?>&nbsp;<?php echo $Language->Phrase("To") ?>&nbsp;<?php echo $vt_orderguide_list->Pager->ToIndex ?>&nbsp;<?php echo $Language->Phrase("Of") ?>&nbsp;<?php echo $vt_orderguide_list->Pager->RecordCount ?></span>
</div>
<?php } ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $vt_orderguide_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
<form name="fvt_orderguidelist" id="fvt_orderguidelist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($vt_orderguide_list->CheckToken) { ?>
<input type="hidden" name="<?php echo TOKEN_NAME ?>" value="<?php echo $vt_orderguide_list->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="vt_orderguide">
<input type="hidden" name="exporttype" id="exporttype" value="">
<?php if ($vt_orderguide->getCurrentMasterTable() == "vt_order" && $vt_orderguide->CurrentAction) { ?>
<input type="hidden" name="<?php echo TABLE_SHOW_MASTER ?>" value="vt_order">
<input type="hidden" name="fk_ID_Order" value="<?php echo $vt_orderguide->ID_Order->getSessionValue() ?>">
<?php } ?>
<div id="gmp_vt_orderguide" class="<?php if (IsResponsiveLayout()) { ?>table-responsive <?php } ?>card-body ew-grid-middle-panel">
<?php if ($vt_orderguide_list->TotalRecs > 0 || $vt_orderguide->isGridEdit()) { ?>
<table id="tbl_vt_orderguidelist" class="table ew-table"><!-- .ew-table ##-->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$vt_orderguide_list->RowType = ROWTYPE_HEADER;

// Render list options
$vt_orderguide_list->renderListOptions();

// Render list options (header, left)
$vt_orderguide_list->ListOptions->render("header", "left");
?>
<?php if ($vt_orderguide->Code->Visible) { // Code ?>
	<?php if ($vt_orderguide->sortUrl($vt_orderguide->Code) == "") { ?>
		<th data-name="Code" class="<?php echo $vt_orderguide->Code->headerCellClass() ?>" style="white-space: nowrap;"><div id="elh_vt_orderguide_Code" class="vt_orderguide_Code"><div class="ew-table-header-caption"><?php echo $vt_orderguide->Code->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Code" class="<?php echo $vt_orderguide->Code->headerCellClass() ?>" style="white-space: nowrap;"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $vt_orderguide->SortUrl($vt_orderguide->Code) ?>',2);"><div id="elh_vt_orderguide_Code" class="vt_orderguide_Code">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $vt_orderguide->Code->caption() ?></span><span class="ew-table-header-sort"><?php if ($vt_orderguide->Code->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($vt_orderguide->Code->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($vt_orderguide->ProductName->Visible) { // ProductName ?>
	<?php if ($vt_orderguide->sortUrl($vt_orderguide->ProductName) == "") { ?>
		<th data-name="ProductName" class="<?php echo $vt_orderguide->ProductName->headerCellClass() ?>" style="white-space: nowrap;"><div id="elh_vt_orderguide_ProductName" class="vt_orderguide_ProductName"><div class="ew-table-header-caption"><?php echo $vt_orderguide->ProductName->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="ProductName" class="<?php echo $vt_orderguide->ProductName->headerCellClass() ?>" style="white-space: nowrap;"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $vt_orderguide->SortUrl($vt_orderguide->ProductName) ?>',2);"><div id="elh_vt_orderguide_ProductName" class="vt_orderguide_ProductName">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $vt_orderguide->ProductName->caption() ?></span><span class="ew-table-header-sort"><?php if ($vt_orderguide->ProductName->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($vt_orderguide->ProductName->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($vt_orderguide->PCS->Visible) { // PCS ?>
	<?php if ($vt_orderguide->sortUrl($vt_orderguide->PCS) == "") { ?>
		<th data-name="PCS" class="<?php echo $vt_orderguide->PCS->headerCellClass() ?>" style="white-space: nowrap;"><div id="elh_vt_orderguide_PCS" class="vt_orderguide_PCS"><div class="ew-table-header-caption"><?php echo $vt_orderguide->PCS->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="PCS" class="<?php echo $vt_orderguide->PCS->headerCellClass() ?>" style="white-space: nowrap;"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $vt_orderguide->SortUrl($vt_orderguide->PCS) ?>',2);"><div id="elh_vt_orderguide_PCS" class="vt_orderguide_PCS">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $vt_orderguide->PCS->caption() ?></span><span class="ew-table-header-sort"><?php if ($vt_orderguide->PCS->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($vt_orderguide->PCS->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($vt_orderguide->Location->Visible) { // Location ?>
	<?php if ($vt_orderguide->sortUrl($vt_orderguide->Location) == "") { ?>
		<th data-name="Location" class="<?php echo $vt_orderguide->Location->headerCellClass() ?>" style="white-space: nowrap;"><div id="elh_vt_orderguide_Location" class="vt_orderguide_Location"><div class="ew-table-header-caption"><?php echo $vt_orderguide->Location->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Location" class="<?php echo $vt_orderguide->Location->headerCellClass() ?>" style="white-space: nowrap;"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $vt_orderguide->SortUrl($vt_orderguide->Location) ?>',2);"><div id="elh_vt_orderguide_Location" class="vt_orderguide_Location">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $vt_orderguide->Location->caption() ?></span><span class="ew-table-header-sort"><?php if ($vt_orderguide->Location->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($vt_orderguide->Location->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$vt_orderguide_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
if ($vt_orderguide->ExportAll && $vt_orderguide->isExport()) {
	$vt_orderguide_list->StopRec = $vt_orderguide_list->TotalRecs;
} else {

	// Set the last record to display
	if ($vt_orderguide_list->TotalRecs > $vt_orderguide_list->StartRec + $vt_orderguide_list->DisplayRecs - 1)
		$vt_orderguide_list->StopRec = $vt_orderguide_list->StartRec + $vt_orderguide_list->DisplayRecs - 1;
	else
		$vt_orderguide_list->StopRec = $vt_orderguide_list->TotalRecs;
}
$vt_orderguide_list->RecCnt = $vt_orderguide_list->StartRec - 1;
if ($vt_orderguide_list->Recordset && !$vt_orderguide_list->Recordset->EOF) {
	$vt_orderguide_list->Recordset->moveFirst();
	$selectLimit = $vt_orderguide_list->UseSelectLimit;
	if (!$selectLimit && $vt_orderguide_list->StartRec > 1)
		$vt_orderguide_list->Recordset->move($vt_orderguide_list->StartRec - 1);
} elseif (!$vt_orderguide->AllowAddDeleteRow && $vt_orderguide_list->StopRec == 0) {
	$vt_orderguide_list->StopRec = $vt_orderguide->GridAddRowCount;
}

// Initialize aggregate
$vt_orderguide->RowType = ROWTYPE_AGGREGATEINIT;
$vt_orderguide->resetAttributes();
$vt_orderguide_list->renderRow();
while ($vt_orderguide_list->RecCnt < $vt_orderguide_list->StopRec) {
	$vt_orderguide_list->RecCnt++;
	if ($vt_orderguide_list->RecCnt >= $vt_orderguide_list->StartRec) {
		$vt_orderguide_list->RowCnt++;

		// Set up key count
		$vt_orderguide_list->KeyCount = $vt_orderguide_list->RowIndex;

		// Init row class and style
		$vt_orderguide->resetAttributes();
		$vt_orderguide->CssClass = "";
		if ($vt_orderguide->isGridAdd()) {
		} else {
			$vt_orderguide_list->loadRowValues($vt_orderguide_list->Recordset); // Load row values
		}
		$vt_orderguide->RowType = ROWTYPE_VIEW; // Render view

		// Set up row id / data-rowindex
		$vt_orderguide->RowAttrs = array_merge($vt_orderguide->RowAttrs, array('data-rowindex'=>$vt_orderguide_list->RowCnt, 'id'=>'r' . $vt_orderguide_list->RowCnt . '_vt_orderguide', 'data-rowtype'=>$vt_orderguide->RowType));

		// Render row
		$vt_orderguide_list->renderRow();

		// Render list options
		$vt_orderguide_list->renderListOptions();
?>
	<tr<?php echo $vt_orderguide->rowAttributes() ?>>
<?php

// Render list options (body, left)
$vt_orderguide_list->ListOptions->render("body", "left", $vt_orderguide_list->RowCnt);
?>
	<?php if ($vt_orderguide->Code->Visible) { // Code ?>
		<td data-name="Code"<?php echo $vt_orderguide->Code->cellAttributes() ?>>
<span id="el<?php echo $vt_orderguide_list->RowCnt ?>_vt_orderguide_Code" class="vt_orderguide_Code">
<span<?php echo $vt_orderguide->Code->viewAttributes() ?>>
<?php echo $vt_orderguide->Code->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($vt_orderguide->ProductName->Visible) { // ProductName ?>
		<td data-name="ProductName"<?php echo $vt_orderguide->ProductName->cellAttributes() ?>>
<span id="el<?php echo $vt_orderguide_list->RowCnt ?>_vt_orderguide_ProductName" class="vt_orderguide_ProductName">
<span<?php echo $vt_orderguide->ProductName->viewAttributes() ?>>
<?php echo $vt_orderguide->ProductName->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($vt_orderguide->PCS->Visible) { // PCS ?>
		<td data-name="PCS"<?php echo $vt_orderguide->PCS->cellAttributes() ?>>
<span id="el<?php echo $vt_orderguide_list->RowCnt ?>_vt_orderguide_PCS" class="vt_orderguide_PCS">
<span<?php echo $vt_orderguide->PCS->viewAttributes() ?>>
<?php echo $vt_orderguide->PCS->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($vt_orderguide->Location->Visible) { // Location ?>
		<td data-name="Location"<?php echo $vt_orderguide->Location->cellAttributes() ?>>
<span id="el<?php echo $vt_orderguide_list->RowCnt ?>_vt_orderguide_Location" class="vt_orderguide_Location">
<span<?php echo $vt_orderguide->Location->viewAttributes() ?>>
<?php echo $vt_orderguide->Location->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$vt_orderguide_list->ListOptions->render("body", "right", $vt_orderguide_list->RowCnt);
?>
	</tr>
<?php
	}
	if (!$vt_orderguide->isGridAdd())
		$vt_orderguide_list->Recordset->moveNext();
}
?>
</tbody>
</table><!-- /.ew-table -->
<?php } ?>
<?php if (!$vt_orderguide->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</div><!-- /.ew-grid-middle-panel -->
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($vt_orderguide_list->Recordset)
	$vt_orderguide_list->Recordset->Close();
?>
<?php if (!$vt_orderguide->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$vt_orderguide->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php if (!isset($vt_orderguide_list->Pager)) $vt_orderguide_list->Pager = new PrevNextPager($vt_orderguide_list->StartRec, $vt_orderguide_list->DisplayRecs, $vt_orderguide_list->TotalRecs, $vt_orderguide_list->AutoHidePager) ?>
<?php if ($vt_orderguide_list->Pager->RecordCount > 0 && $vt_orderguide_list->Pager->Visible) { ?>
<div class="ew-pager">
<span><?php echo $Language->Phrase("Page") ?>&nbsp;</span>
<div class="ew-prev-next"><div class="input-group input-group-sm">
<div class="input-group-prepend">
<!-- first page button -->
	<?php if ($vt_orderguide_list->Pager->FirstButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerFirst") ?>" href="<?php echo $vt_orderguide_list->pageUrl() ?>start=<?php echo $vt_orderguide_list->Pager->FirstButton->Start ?>"><i class="icon-first ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerFirst") ?>"><i class="icon-first ew-icon"></i></a>
	<?php } ?>
<!-- previous page button -->
	<?php if ($vt_orderguide_list->Pager->PrevButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerPrevious") ?>" href="<?php echo $vt_orderguide_list->pageUrl() ?>start=<?php echo $vt_orderguide_list->Pager->PrevButton->Start ?>"><i class="icon-prev ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerPrevious") ?>"><i class="icon-prev ew-icon"></i></a>
	<?php } ?>
</div>
<!-- current page number -->
	<input class="form-control" type="text" name="<?php echo TABLE_PAGE_NO ?>" value="<?php echo $vt_orderguide_list->Pager->CurrentPage ?>">
<div class="input-group-append">
<!-- next page button -->
	<?php if ($vt_orderguide_list->Pager->NextButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerNext") ?>" href="<?php echo $vt_orderguide_list->pageUrl() ?>start=<?php echo $vt_orderguide_list->Pager->NextButton->Start ?>"><i class="icon-next ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerNext") ?>"><i class="icon-next ew-icon"></i></a>
	<?php } ?>
<!-- last page button -->
	<?php if ($vt_orderguide_list->Pager->LastButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerLast") ?>" href="<?php echo $vt_orderguide_list->pageUrl() ?>start=<?php echo $vt_orderguide_list->Pager->LastButton->Start ?>"><i class="icon-last ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerLast") ?>"><i class="icon-last ew-icon"></i></a>
	<?php } ?>
</div>
</div>
</div>
<span>&nbsp;<?php echo $Language->Phrase("of") ?>&nbsp;<?php echo $vt_orderguide_list->Pager->PageCount ?></span>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php if ($vt_orderguide_list->Pager->RecordCount > 0) { ?>
<div class="ew-pager ew-rec">
	<span><?php echo $Language->Phrase("Record") ?>&nbsp;<?php echo $vt_orderguide_list->Pager->FromIndex ?>&nbsp;<?php echo $Language->Phrase("To") ?>&nbsp;<?php echo $vt_orderguide_list->Pager->ToIndex ?>&nbsp;<?php echo $Language->Phrase("Of") ?>&nbsp;<?php echo $vt_orderguide_list->Pager->RecordCount ?></span>
</div>
<?php } ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $vt_orderguide_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($vt_orderguide_list->TotalRecs == 0 && !$vt_orderguide->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $vt_orderguide_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$vt_orderguide_list->showPageFooter();
if (DEBUG_ENABLED)
	echo GetDebugMessage();
?>
<?php if (!$vt_orderguide->isExport()) { ?>
<script>

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php } ?>
<?php include_once "footer.php" ?>
<?php
$vt_orderguide_list->terminate();
?>