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
$tbl_packunit_list = new tbl_packunit_list();

// Run the page
$tbl_packunit_list->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$tbl_packunit_list->Page_Render();
?>
<?php include_once "header.php" ?>
<?php if (!$tbl_packunit->isExport()) { ?>
<script>

// Form object
currentPageID = ew.PAGE_ID = "list";
var ftbl_packunitlist = currentForm = new ew.Form("ftbl_packunitlist", "list");
ftbl_packunitlist.formKeyCountName = '<?php echo $tbl_packunit_list->FormKeyCountName ?>';

// Validate form
ftbl_packunitlist.validate = function() {
	if (!this.validateRequired)
		return true; // Ignore validation
	var $ = jQuery, fobj = this.getForm(), $fobj = $(fobj);
	if ($fobj.find("#confirm").val() == "F")
		return true;
	var elm, felm, uelm, addcnt = 0;
	var $k = $fobj.find("#" + this.formKeyCountName); // Get key_count
	var rowcnt = ($k[0]) ? parseInt($k.val(), 10) : 1;
	var startcnt = (rowcnt == 0) ? 0 : 1; // Check rowcnt == 0 => Inline-Add
	var gridinsert = ["insert", "gridinsert"].includes($fobj.find("#action").val()) && $k[0];
	for (var i = startcnt; i <= rowcnt; i++) {
		var infix = ($k[0]) ? String(i) : "";
		$fobj.data("rowindex", infix);
		<?php if ($tbl_packunit_list->packNo->Required) { ?>
			elm = this.getElements("x" + infix + "_packNo");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $tbl_packunit->packNo->caption(), $tbl_packunit->packNo->RequiredErrorMessage)) ?>");
		<?php } ?>
			elm = this.getElements("x" + infix + "_packNo");
			if (elm && !ew.checkInteger(elm.value))
				return this.onError(elm, "<?php echo JsEncode($tbl_packunit->packNo->errorMessage()) ?>");
		<?php if ($tbl_packunit_list->idUnit->Required) { ?>
			elm = this.getElements("x" + infix + "_idUnit");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $tbl_packunit->idUnit->caption(), $tbl_packunit->idUnit->RequiredErrorMessage)) ?>");
		<?php } ?>

			// Fire Form_CustomValidate event
			if (!this.Form_CustomValidate(fobj))
				return false;
	}
	return true;
}

// Form_CustomValidate event
ftbl_packunitlist.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

	// Your custom validation code here, return false if invalid.
	return true;
}

// Use JavaScript validation or not
ftbl_packunitlist.validateRequired = <?php echo json_encode(CLIENT_VALIDATE) ?>;

// Dynamic selection lists
ftbl_packunitlist.lists["x_idUnit"] = <?php echo $tbl_packunit_list->idUnit->Lookup->toClientList() ?>;
ftbl_packunitlist.lists["x_idUnit"].options = <?php echo JsonEncode($tbl_packunit_list->idUnit->lookupOptions()) ?>;

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
<?php if (!$tbl_packunit->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($tbl_packunit_list->TotalRecs > 0 && $tbl_packunit_list->ExportOptions->visible()) { ?>
<?php $tbl_packunit_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($tbl_packunit_list->ImportOptions->visible()) { ?>
<?php $tbl_packunit_list->ImportOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php
$tbl_packunit_list->renderOtherOptions();
?>
<?php $tbl_packunit_list->showPageHeader(); ?>
<?php
$tbl_packunit_list->showMessage();
?>
<?php if ($tbl_packunit_list->TotalRecs > 0 || $tbl_packunit->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($tbl_packunit_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> tbl_packunit">
<?php if (!$tbl_packunit->isExport()) { ?>
<div class="card-header ew-grid-upper-panel">
<?php if (!$tbl_packunit->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php if (!isset($tbl_packunit_list->Pager)) $tbl_packunit_list->Pager = new PrevNextPager($tbl_packunit_list->StartRec, $tbl_packunit_list->DisplayRecs, $tbl_packunit_list->TotalRecs, $tbl_packunit_list->AutoHidePager) ?>
<?php if ($tbl_packunit_list->Pager->RecordCount > 0 && $tbl_packunit_list->Pager->Visible) { ?>
<div class="ew-pager">
<span><?php echo $Language->Phrase("Page") ?>&nbsp;</span>
<div class="ew-prev-next"><div class="input-group input-group-sm">
<div class="input-group-prepend">
<!-- first page button -->
	<?php if ($tbl_packunit_list->Pager->FirstButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerFirst") ?>" href="<?php echo $tbl_packunit_list->pageUrl() ?>start=<?php echo $tbl_packunit_list->Pager->FirstButton->Start ?>"><i class="icon-first ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerFirst") ?>"><i class="icon-first ew-icon"></i></a>
	<?php } ?>
<!-- previous page button -->
	<?php if ($tbl_packunit_list->Pager->PrevButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerPrevious") ?>" href="<?php echo $tbl_packunit_list->pageUrl() ?>start=<?php echo $tbl_packunit_list->Pager->PrevButton->Start ?>"><i class="icon-prev ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerPrevious") ?>"><i class="icon-prev ew-icon"></i></a>
	<?php } ?>
</div>
<!-- current page number -->
	<input class="form-control" type="text" name="<?php echo TABLE_PAGE_NO ?>" value="<?php echo $tbl_packunit_list->Pager->CurrentPage ?>">
<div class="input-group-append">
<!-- next page button -->
	<?php if ($tbl_packunit_list->Pager->NextButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerNext") ?>" href="<?php echo $tbl_packunit_list->pageUrl() ?>start=<?php echo $tbl_packunit_list->Pager->NextButton->Start ?>"><i class="icon-next ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerNext") ?>"><i class="icon-next ew-icon"></i></a>
	<?php } ?>
<!-- last page button -->
	<?php if ($tbl_packunit_list->Pager->LastButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerLast") ?>" href="<?php echo $tbl_packunit_list->pageUrl() ?>start=<?php echo $tbl_packunit_list->Pager->LastButton->Start ?>"><i class="icon-last ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerLast") ?>"><i class="icon-last ew-icon"></i></a>
	<?php } ?>
</div>
</div>
</div>
<span>&nbsp;<?php echo $Language->Phrase("of") ?>&nbsp;<?php echo $tbl_packunit_list->Pager->PageCount ?></span>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php if ($tbl_packunit_list->Pager->RecordCount > 0) { ?>
<div class="ew-pager ew-rec">
	<span><?php echo $Language->Phrase("Record") ?>&nbsp;<?php echo $tbl_packunit_list->Pager->FromIndex ?>&nbsp;<?php echo $Language->Phrase("To") ?>&nbsp;<?php echo $tbl_packunit_list->Pager->ToIndex ?>&nbsp;<?php echo $Language->Phrase("Of") ?>&nbsp;<?php echo $tbl_packunit_list->Pager->RecordCount ?></span>
</div>
<?php } ?>
<?php if ($tbl_packunit_list->TotalRecs > 0 && (!$tbl_packunit_list->AutoHidePageSizeSelector || $tbl_packunit_list->Pager->Visible)) { ?>
<div class="ew-pager">
<input type="hidden" name="t" value="tbl_packunit">
<select name="<?php echo TABLE_REC_PER_PAGE ?>" class="form-control form-control-sm ew-tooltip" title="<?php echo $Language->phrase("RecordsPerPage") ?>" onchange="this.form.submit();">
<option value="20"<?php if ($tbl_packunit_list->DisplayRecs == 20) { ?> selected<?php } ?>>20</option>
<option value="50"<?php if ($tbl_packunit_list->DisplayRecs == 50) { ?> selected<?php } ?>>50</option>
<option value="100"<?php if ($tbl_packunit_list->DisplayRecs == 100) { ?> selected<?php } ?>>100</option>
<option value="200"<?php if ($tbl_packunit_list->DisplayRecs == 200) { ?> selected<?php } ?>>200</option>
<option value="500"<?php if ($tbl_packunit_list->DisplayRecs == 500) { ?> selected<?php } ?>>500</option>
<option value="ALL"<?php if ($tbl_packunit->getRecordsPerPage() == -1) { ?> selected<?php } ?>><?php echo $Language->Phrase("AllRecords") ?></option>
</select>
</div>
<?php } ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $tbl_packunit_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
<form name="ftbl_packunitlist" id="ftbl_packunitlist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($tbl_packunit_list->CheckToken) { ?>
<input type="hidden" name="<?php echo TOKEN_NAME ?>" value="<?php echo $tbl_packunit_list->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="tbl_packunit">
<input type="hidden" name="exporttype" id="exporttype" value="">
<div id="gmp_tbl_packunit" class="<?php if (IsResponsiveLayout()) { ?>table-responsive <?php } ?>card-body ew-grid-middle-panel">
<?php if ($tbl_packunit_list->TotalRecs > 0 || $tbl_packunit->isAdd() || $tbl_packunit->isCopy() || $tbl_packunit->isGridEdit()) { ?>
<table id="tbl_tbl_packunitlist" class="table ew-table"><!-- .ew-table ##-->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$tbl_packunit_list->RowType = ROWTYPE_HEADER;

// Render list options
$tbl_packunit_list->renderListOptions();

// Render list options (header, left)
$tbl_packunit_list->ListOptions->render("header", "left");
?>
<?php if ($tbl_packunit->packNo->Visible) { // packNo ?>
	<?php if ($tbl_packunit->sortUrl($tbl_packunit->packNo) == "") { ?>
		<th data-name="packNo" class="<?php echo $tbl_packunit->packNo->headerCellClass() ?>" style="white-space: nowrap;"><div id="elh_tbl_packunit_packNo" class="tbl_packunit_packNo"><div class="ew-table-header-caption"><?php echo $tbl_packunit->packNo->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="packNo" class="<?php echo $tbl_packunit->packNo->headerCellClass() ?>" style="white-space: nowrap;"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $tbl_packunit->SortUrl($tbl_packunit->packNo) ?>',2);"><div id="elh_tbl_packunit_packNo" class="tbl_packunit_packNo">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $tbl_packunit->packNo->caption() ?></span><span class="ew-table-header-sort"><?php if ($tbl_packunit->packNo->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($tbl_packunit->packNo->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($tbl_packunit->idUnit->Visible) { // idUnit ?>
	<?php if ($tbl_packunit->sortUrl($tbl_packunit->idUnit) == "") { ?>
		<th data-name="idUnit" class="<?php echo $tbl_packunit->idUnit->headerCellClass() ?>" style="white-space: nowrap;"><div id="elh_tbl_packunit_idUnit" class="tbl_packunit_idUnit"><div class="ew-table-header-caption"><?php echo $tbl_packunit->idUnit->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="idUnit" class="<?php echo $tbl_packunit->idUnit->headerCellClass() ?>" style="white-space: nowrap;"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $tbl_packunit->SortUrl($tbl_packunit->idUnit) ?>',2);"><div id="elh_tbl_packunit_idUnit" class="tbl_packunit_idUnit">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $tbl_packunit->idUnit->caption() ?></span><span class="ew-table-header-sort"><?php if ($tbl_packunit->idUnit->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($tbl_packunit->idUnit->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$tbl_packunit_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
	if ($tbl_packunit->isAdd() || $tbl_packunit->isCopy()) {
		$tbl_packunit_list->RowIndex = 0;
		$tbl_packunit_list->KeyCount = $tbl_packunit_list->RowIndex;
		if ($tbl_packunit->isAdd())
			$tbl_packunit_list->loadRowValues();
		if ($tbl_packunit->EventCancelled) // Insert failed
			$tbl_packunit_list->restoreFormValues(); // Restore form values

		// Set row properties
		$tbl_packunit->resetAttributes();
		$tbl_packunit->RowAttrs = array_merge($tbl_packunit->RowAttrs, array('data-rowindex'=>0, 'id'=>'r0_tbl_packunit', 'data-rowtype'=>ROWTYPE_ADD));
		$tbl_packunit->RowType = ROWTYPE_ADD;

		// Render row
		$tbl_packunit_list->renderRow();

		// Render list options
		$tbl_packunit_list->renderListOptions();
		$tbl_packunit_list->StartRowCnt = 0;
?>
	<tr<?php echo $tbl_packunit->rowAttributes() ?>>
<?php

// Render list options (body, left)
$tbl_packunit_list->ListOptions->render("body", "left", $tbl_packunit_list->RowCnt);
?>
	<?php if ($tbl_packunit->packNo->Visible) { // packNo ?>
		<td data-name="packNo">
<span id="el<?php echo $tbl_packunit_list->RowCnt ?>_tbl_packunit_packNo" class="form-group tbl_packunit_packNo">
<input type="text" data-table="tbl_packunit" data-field="x_packNo" name="x<?php echo $tbl_packunit_list->RowIndex ?>_packNo" id="x<?php echo $tbl_packunit_list->RowIndex ?>_packNo" size="5" placeholder="<?php echo HtmlEncode($tbl_packunit->packNo->getPlaceHolder()) ?>" value="<?php echo $tbl_packunit->packNo->EditValue ?>"<?php echo $tbl_packunit->packNo->editAttributes() ?>>
</span>
<input type="hidden" data-table="tbl_packunit" data-field="x_packNo" name="o<?php echo $tbl_packunit_list->RowIndex ?>_packNo" id="o<?php echo $tbl_packunit_list->RowIndex ?>_packNo" value="<?php echo HtmlEncode($tbl_packunit->packNo->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($tbl_packunit->idUnit->Visible) { // idUnit ?>
		<td data-name="idUnit">
<span id="el<?php echo $tbl_packunit_list->RowCnt ?>_tbl_packunit_idUnit" class="form-group tbl_packunit_idUnit">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="tbl_packunit" data-field="x_idUnit" data-value-separator="<?php echo $tbl_packunit->idUnit->displayValueSeparatorAttribute() ?>" id="x<?php echo $tbl_packunit_list->RowIndex ?>_idUnit" name="x<?php echo $tbl_packunit_list->RowIndex ?>_idUnit"<?php echo $tbl_packunit->idUnit->editAttributes() ?>>
		<?php echo $tbl_packunit->idUnit->selectOptionListHtml("x<?php echo $tbl_packunit_list->RowIndex ?>_idUnit") ?>
	</select>
<?php if (AllowAdd(CurrentProjectID() . "tbl_unit") && !$tbl_packunit->idUnit->ReadOnly) { ?>
<div class="input-group-append"><button type="button" class="btn btn-default ew-add-opt-btn" id="aol_x<?php echo $tbl_packunit_list->RowIndex ?>_idUnit" title="<?php echo HtmlTitle($Language->phrase("AddLink")) . "&nbsp;" . $tbl_packunit->idUnit->caption() ?>" data-title="<?php echo $tbl_packunit->idUnit->caption() ?>" onclick="ew.addOptionDialogShow({lnk:this,el:'x<?php echo $tbl_packunit_list->RowIndex ?>_idUnit',url:'tbl_unitaddopt.php'});"><i class="fa fa-plus ew-icon"></i></button></div>
<?php } ?>
</div>
<?php echo $tbl_packunit->idUnit->Lookup->getParamTag("p_x" . $tbl_packunit_list->RowIndex . "_idUnit") ?>
</span>
<input type="hidden" data-table="tbl_packunit" data-field="x_idUnit" name="o<?php echo $tbl_packunit_list->RowIndex ?>_idUnit" id="o<?php echo $tbl_packunit_list->RowIndex ?>_idUnit" value="<?php echo HtmlEncode($tbl_packunit->idUnit->OldValue) ?>">
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$tbl_packunit_list->ListOptions->render("body", "right", $tbl_packunit_list->RowCnt);
?>
<script>
ftbl_packunitlist.updateLists(<?php echo $tbl_packunit_list->RowIndex ?>);
</script>
	</tr>
<?php
}
?>
<?php
if ($tbl_packunit->ExportAll && $tbl_packunit->isExport()) {
	$tbl_packunit_list->StopRec = $tbl_packunit_list->TotalRecs;
} else {

	// Set the last record to display
	if ($tbl_packunit_list->TotalRecs > $tbl_packunit_list->StartRec + $tbl_packunit_list->DisplayRecs - 1)
		$tbl_packunit_list->StopRec = $tbl_packunit_list->StartRec + $tbl_packunit_list->DisplayRecs - 1;
	else
		$tbl_packunit_list->StopRec = $tbl_packunit_list->TotalRecs;
}

// Restore number of post back records
if ($CurrentForm && $tbl_packunit_list->EventCancelled) {
	$CurrentForm->Index = -1;
	if ($CurrentForm->hasValue($tbl_packunit_list->FormKeyCountName) && ($tbl_packunit->isGridAdd() || $tbl_packunit->isGridEdit() || $tbl_packunit->isConfirm())) {
		$tbl_packunit_list->KeyCount = $CurrentForm->getValue($tbl_packunit_list->FormKeyCountName);
		$tbl_packunit_list->StopRec = $tbl_packunit_list->StartRec + $tbl_packunit_list->KeyCount - 1;
	}
}
$tbl_packunit_list->RecCnt = $tbl_packunit_list->StartRec - 1;
if ($tbl_packunit_list->Recordset && !$tbl_packunit_list->Recordset->EOF) {
	$tbl_packunit_list->Recordset->moveFirst();
	$selectLimit = $tbl_packunit_list->UseSelectLimit;
	if (!$selectLimit && $tbl_packunit_list->StartRec > 1)
		$tbl_packunit_list->Recordset->move($tbl_packunit_list->StartRec - 1);
} elseif (!$tbl_packunit->AllowAddDeleteRow && $tbl_packunit_list->StopRec == 0) {
	$tbl_packunit_list->StopRec = $tbl_packunit->GridAddRowCount;
}

// Initialize aggregate
$tbl_packunit->RowType = ROWTYPE_AGGREGATEINIT;
$tbl_packunit->resetAttributes();
$tbl_packunit_list->renderRow();
$tbl_packunit_list->EditRowCnt = 0;
if ($tbl_packunit->isEdit())
	$tbl_packunit_list->RowIndex = 1;
while ($tbl_packunit_list->RecCnt < $tbl_packunit_list->StopRec) {
	$tbl_packunit_list->RecCnt++;
	if ($tbl_packunit_list->RecCnt >= $tbl_packunit_list->StartRec) {
		$tbl_packunit_list->RowCnt++;

		// Set up key count
		$tbl_packunit_list->KeyCount = $tbl_packunit_list->RowIndex;

		// Init row class and style
		$tbl_packunit->resetAttributes();
		$tbl_packunit->CssClass = "";
		if ($tbl_packunit->isGridAdd()) {
			$tbl_packunit_list->loadRowValues(); // Load default values
		} else {
			$tbl_packunit_list->loadRowValues($tbl_packunit_list->Recordset); // Load row values
		}
		$tbl_packunit->RowType = ROWTYPE_VIEW; // Render view
		if ($tbl_packunit->isEdit()) {
			if ($tbl_packunit_list->checkInlineEditKey() && $tbl_packunit_list->EditRowCnt == 0) { // Inline edit
				$tbl_packunit->RowType = ROWTYPE_EDIT; // Render edit
			}
		}
		if ($tbl_packunit->isEdit() && $tbl_packunit->RowType == ROWTYPE_EDIT && $tbl_packunit->EventCancelled) { // Update failed
			$CurrentForm->Index = 1;
			$tbl_packunit_list->restoreFormValues(); // Restore form values
		}
		if ($tbl_packunit->RowType == ROWTYPE_EDIT) // Edit row
			$tbl_packunit_list->EditRowCnt++;

		// Set up row id / data-rowindex
		$tbl_packunit->RowAttrs = array_merge($tbl_packunit->RowAttrs, array('data-rowindex'=>$tbl_packunit_list->RowCnt, 'id'=>'r' . $tbl_packunit_list->RowCnt . '_tbl_packunit', 'data-rowtype'=>$tbl_packunit->RowType));

		// Render row
		$tbl_packunit_list->renderRow();

		// Render list options
		$tbl_packunit_list->renderListOptions();
?>
	<tr<?php echo $tbl_packunit->rowAttributes() ?>>
<?php

// Render list options (body, left)
$tbl_packunit_list->ListOptions->render("body", "left", $tbl_packunit_list->RowCnt);
?>
	<?php if ($tbl_packunit->packNo->Visible) { // packNo ?>
		<td data-name="packNo"<?php echo $tbl_packunit->packNo->cellAttributes() ?>>
<?php if ($tbl_packunit->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $tbl_packunit_list->RowCnt ?>_tbl_packunit_packNo" class="form-group tbl_packunit_packNo">
<input type="text" data-table="tbl_packunit" data-field="x_packNo" name="x<?php echo $tbl_packunit_list->RowIndex ?>_packNo" id="x<?php echo $tbl_packunit_list->RowIndex ?>_packNo" size="5" placeholder="<?php echo HtmlEncode($tbl_packunit->packNo->getPlaceHolder()) ?>" value="<?php echo $tbl_packunit->packNo->EditValue ?>"<?php echo $tbl_packunit->packNo->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($tbl_packunit->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $tbl_packunit_list->RowCnt ?>_tbl_packunit_packNo" class="tbl_packunit_packNo">
<span<?php echo $tbl_packunit->packNo->viewAttributes() ?>>
<?php echo $tbl_packunit->packNo->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
<?php if ($tbl_packunit->RowType == ROWTYPE_EDIT || $tbl_packunit->CurrentMode == "edit") { ?>
<input type="hidden" data-table="tbl_packunit" data-field="x_idPacking" name="x<?php echo $tbl_packunit_list->RowIndex ?>_idPacking" id="x<?php echo $tbl_packunit_list->RowIndex ?>_idPacking" value="<?php echo HtmlEncode($tbl_packunit->idPacking->CurrentValue) ?>">
<?php } ?>
	<?php if ($tbl_packunit->idUnit->Visible) { // idUnit ?>
		<td data-name="idUnit"<?php echo $tbl_packunit->idUnit->cellAttributes() ?>>
<?php if ($tbl_packunit->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $tbl_packunit_list->RowCnt ?>_tbl_packunit_idUnit" class="form-group tbl_packunit_idUnit">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="tbl_packunit" data-field="x_idUnit" data-value-separator="<?php echo $tbl_packunit->idUnit->displayValueSeparatorAttribute() ?>" id="x<?php echo $tbl_packunit_list->RowIndex ?>_idUnit" name="x<?php echo $tbl_packunit_list->RowIndex ?>_idUnit"<?php echo $tbl_packunit->idUnit->editAttributes() ?>>
		<?php echo $tbl_packunit->idUnit->selectOptionListHtml("x<?php echo $tbl_packunit_list->RowIndex ?>_idUnit") ?>
	</select>
<?php if (AllowAdd(CurrentProjectID() . "tbl_unit") && !$tbl_packunit->idUnit->ReadOnly) { ?>
<div class="input-group-append"><button type="button" class="btn btn-default ew-add-opt-btn" id="aol_x<?php echo $tbl_packunit_list->RowIndex ?>_idUnit" title="<?php echo HtmlTitle($Language->phrase("AddLink")) . "&nbsp;" . $tbl_packunit->idUnit->caption() ?>" data-title="<?php echo $tbl_packunit->idUnit->caption() ?>" onclick="ew.addOptionDialogShow({lnk:this,el:'x<?php echo $tbl_packunit_list->RowIndex ?>_idUnit',url:'tbl_unitaddopt.php'});"><i class="fa fa-plus ew-icon"></i></button></div>
<?php } ?>
</div>
<?php echo $tbl_packunit->idUnit->Lookup->getParamTag("p_x" . $tbl_packunit_list->RowIndex . "_idUnit") ?>
</span>
<?php } ?>
<?php if ($tbl_packunit->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $tbl_packunit_list->RowCnt ?>_tbl_packunit_idUnit" class="tbl_packunit_idUnit">
<span<?php echo $tbl_packunit->idUnit->viewAttributes() ?>>
<?php echo $tbl_packunit->idUnit->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$tbl_packunit_list->ListOptions->render("body", "right", $tbl_packunit_list->RowCnt);
?>
	</tr>
<?php if ($tbl_packunit->RowType == ROWTYPE_ADD || $tbl_packunit->RowType == ROWTYPE_EDIT) { ?>
<script>
ftbl_packunitlist.updateLists(<?php echo $tbl_packunit_list->RowIndex ?>);
</script>
<?php } ?>
<?php
	}
	if (!$tbl_packunit->isGridAdd())
		$tbl_packunit_list->Recordset->moveNext();
}
?>
</tbody>
</table><!-- /.ew-table -->
<?php } ?>
<?php if ($tbl_packunit->isAdd() || $tbl_packunit->isCopy()) { ?>
<input type="hidden" name="<?php echo $tbl_packunit_list->FormKeyCountName ?>" id="<?php echo $tbl_packunit_list->FormKeyCountName ?>" value="<?php echo $tbl_packunit_list->KeyCount ?>">
<?php } ?>
<?php if ($tbl_packunit->isEdit()) { ?>
<input type="hidden" name="<?php echo $tbl_packunit_list->FormKeyCountName ?>" id="<?php echo $tbl_packunit_list->FormKeyCountName ?>" value="<?php echo $tbl_packunit_list->KeyCount ?>">
<?php } ?>
<?php if (!$tbl_packunit->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</div><!-- /.ew-grid-middle-panel -->
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($tbl_packunit_list->Recordset)
	$tbl_packunit_list->Recordset->Close();
?>
<?php if (!$tbl_packunit->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$tbl_packunit->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php if (!isset($tbl_packunit_list->Pager)) $tbl_packunit_list->Pager = new PrevNextPager($tbl_packunit_list->StartRec, $tbl_packunit_list->DisplayRecs, $tbl_packunit_list->TotalRecs, $tbl_packunit_list->AutoHidePager) ?>
<?php if ($tbl_packunit_list->Pager->RecordCount > 0 && $tbl_packunit_list->Pager->Visible) { ?>
<div class="ew-pager">
<span><?php echo $Language->Phrase("Page") ?>&nbsp;</span>
<div class="ew-prev-next"><div class="input-group input-group-sm">
<div class="input-group-prepend">
<!-- first page button -->
	<?php if ($tbl_packunit_list->Pager->FirstButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerFirst") ?>" href="<?php echo $tbl_packunit_list->pageUrl() ?>start=<?php echo $tbl_packunit_list->Pager->FirstButton->Start ?>"><i class="icon-first ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerFirst") ?>"><i class="icon-first ew-icon"></i></a>
	<?php } ?>
<!-- previous page button -->
	<?php if ($tbl_packunit_list->Pager->PrevButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerPrevious") ?>" href="<?php echo $tbl_packunit_list->pageUrl() ?>start=<?php echo $tbl_packunit_list->Pager->PrevButton->Start ?>"><i class="icon-prev ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerPrevious") ?>"><i class="icon-prev ew-icon"></i></a>
	<?php } ?>
</div>
<!-- current page number -->
	<input class="form-control" type="text" name="<?php echo TABLE_PAGE_NO ?>" value="<?php echo $tbl_packunit_list->Pager->CurrentPage ?>">
<div class="input-group-append">
<!-- next page button -->
	<?php if ($tbl_packunit_list->Pager->NextButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerNext") ?>" href="<?php echo $tbl_packunit_list->pageUrl() ?>start=<?php echo $tbl_packunit_list->Pager->NextButton->Start ?>"><i class="icon-next ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerNext") ?>"><i class="icon-next ew-icon"></i></a>
	<?php } ?>
<!-- last page button -->
	<?php if ($tbl_packunit_list->Pager->LastButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerLast") ?>" href="<?php echo $tbl_packunit_list->pageUrl() ?>start=<?php echo $tbl_packunit_list->Pager->LastButton->Start ?>"><i class="icon-last ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerLast") ?>"><i class="icon-last ew-icon"></i></a>
	<?php } ?>
</div>
</div>
</div>
<span>&nbsp;<?php echo $Language->Phrase("of") ?>&nbsp;<?php echo $tbl_packunit_list->Pager->PageCount ?></span>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php if ($tbl_packunit_list->Pager->RecordCount > 0) { ?>
<div class="ew-pager ew-rec">
	<span><?php echo $Language->Phrase("Record") ?>&nbsp;<?php echo $tbl_packunit_list->Pager->FromIndex ?>&nbsp;<?php echo $Language->Phrase("To") ?>&nbsp;<?php echo $tbl_packunit_list->Pager->ToIndex ?>&nbsp;<?php echo $Language->Phrase("Of") ?>&nbsp;<?php echo $tbl_packunit_list->Pager->RecordCount ?></span>
</div>
<?php } ?>
<?php if ($tbl_packunit_list->TotalRecs > 0 && (!$tbl_packunit_list->AutoHidePageSizeSelector || $tbl_packunit_list->Pager->Visible)) { ?>
<div class="ew-pager">
<input type="hidden" name="t" value="tbl_packunit">
<select name="<?php echo TABLE_REC_PER_PAGE ?>" class="form-control form-control-sm ew-tooltip" title="<?php echo $Language->phrase("RecordsPerPage") ?>" onchange="this.form.submit();">
<option value="20"<?php if ($tbl_packunit_list->DisplayRecs == 20) { ?> selected<?php } ?>>20</option>
<option value="50"<?php if ($tbl_packunit_list->DisplayRecs == 50) { ?> selected<?php } ?>>50</option>
<option value="100"<?php if ($tbl_packunit_list->DisplayRecs == 100) { ?> selected<?php } ?>>100</option>
<option value="200"<?php if ($tbl_packunit_list->DisplayRecs == 200) { ?> selected<?php } ?>>200</option>
<option value="500"<?php if ($tbl_packunit_list->DisplayRecs == 500) { ?> selected<?php } ?>>500</option>
<option value="ALL"<?php if ($tbl_packunit->getRecordsPerPage() == -1) { ?> selected<?php } ?>><?php echo $Language->Phrase("AllRecords") ?></option>
</select>
</div>
<?php } ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $tbl_packunit_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($tbl_packunit_list->TotalRecs == 0 && !$tbl_packunit->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $tbl_packunit_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$tbl_packunit_list->showPageFooter();
if (DEBUG_ENABLED)
	echo GetDebugMessage();
?>
<?php if (!$tbl_packunit->isExport()) { ?>
<script>

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php } ?>
<?php include_once "footer.php" ?>
<?php
$tbl_packunit_list->terminate();
?>