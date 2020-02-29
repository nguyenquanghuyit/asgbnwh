<?php
namespace PHPMaker2019\asgbn_wh;

// Write header
WriteHeader(FALSE);

// Create page object
if (!isset($tbl_product_detail_grid))
	$tbl_product_detail_grid = new tbl_product_detail_grid();

// Run the page
$tbl_product_detail_grid->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$tbl_product_detail_grid->Page_Render();
?>
<?php if (!$tbl_product_detail->isExport()) { ?>
<script>

// Form object
var ftbl_product_detailgrid = new ew.Form("ftbl_product_detailgrid", "grid");
ftbl_product_detailgrid.formKeyCountName = '<?php echo $tbl_product_detail_grid->FormKeyCountName ?>';

// Validate form
ftbl_product_detailgrid.validate = function() {
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
		var checkrow = (gridinsert) ? !this.emptyRow(infix) : true;
		if (checkrow) {
			addcnt++;
		<?php if ($tbl_product_detail_grid->PackingQty->Required) { ?>
			elm = this.getElements("x" + infix + "_PackingQty");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $tbl_product_detail->PackingQty->caption(), $tbl_product_detail->PackingQty->RequiredErrorMessage)) ?>");
		<?php } ?>
			elm = this.getElements("x" + infix + "_PackingQty");
			if (elm && !ew.checkInteger(elm.value))
				return this.onError(elm, "<?php echo JsEncode($tbl_product_detail->PackingQty->errorMessage()) ?>");
		<?php if ($tbl_product_detail_grid->IdUnit->Required) { ?>
			elm = this.getElements("x" + infix + "_IdUnit");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $tbl_product_detail->IdUnit->caption(), $tbl_product_detail->IdUnit->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($tbl_product_detail_grid->DefaultCode->Required) { ?>
			elm = this.getElements("x" + infix + "_DefaultCode");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $tbl_product_detail->DefaultCode->caption(), $tbl_product_detail->DefaultCode->RequiredErrorMessage)) ?>");
		<?php } ?>

			// Fire Form_CustomValidate event
			if (!this.Form_CustomValidate(fobj))
				return false;
		} // End Grid Add checking
	}
	return true;
}

// Check empty row
ftbl_product_detailgrid.emptyRow = function(infix) {
	var fobj = this._form;
	if (ew.valueChanged(fobj, infix, "PackingQty", false)) return false;
	if (ew.valueChanged(fobj, infix, "IdUnit", false)) return false;
	if (ew.valueChanged(fobj, infix, "DefaultCode", false)) return false;
	return true;
}

// Form_CustomValidate event
ftbl_product_detailgrid.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

	// Your custom validation code here, return false if invalid.
	return true;
}

// Use JavaScript validation or not
ftbl_product_detailgrid.validateRequired = <?php echo json_encode(CLIENT_VALIDATE) ?>;

// Dynamic selection lists
ftbl_product_detailgrid.lists["x_IdUnit"] = <?php echo $tbl_product_detail_grid->IdUnit->Lookup->toClientList() ?>;
ftbl_product_detailgrid.lists["x_IdUnit"].options = <?php echo JsonEncode($tbl_product_detail_grid->IdUnit->lookupOptions()) ?>;
ftbl_product_detailgrid.lists["x_DefaultCode"] = <?php echo $tbl_product_detail_grid->DefaultCode->Lookup->toClientList() ?>;
ftbl_product_detailgrid.lists["x_DefaultCode"].options = <?php echo JsonEncode($tbl_product_detail_grid->DefaultCode->options(FALSE, TRUE)) ?>;

// Form object for search
</script>
<?php } ?>
<?php
$tbl_product_detail_grid->renderOtherOptions();
?>
<?php $tbl_product_detail_grid->showPageHeader(); ?>
<?php
$tbl_product_detail_grid->showMessage();
?>
<?php if ($tbl_product_detail_grid->TotalRecs > 0 || $tbl_product_detail->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($tbl_product_detail_grid->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> tbl_product_detail">
<?php if ($tbl_product_detail_grid->ShowOtherOptions) { ?>
<div class="card-header ew-grid-upper-panel">
<?php $tbl_product_detail_grid->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<div id="ftbl_product_detailgrid" class="ew-form ew-list-form form-inline">
<div id="gmp_tbl_product_detail" class="<?php if (IsResponsiveLayout()) { ?>table-responsive <?php } ?>card-body ew-grid-middle-panel">
<table id="tbl_tbl_product_detailgrid" class="table ew-table"><!-- .ew-table ##-->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$tbl_product_detail_grid->RowType = ROWTYPE_HEADER;

// Render list options
$tbl_product_detail_grid->renderListOptions();

// Render list options (header, left)
$tbl_product_detail_grid->ListOptions->render("header", "left");
?>
<?php if ($tbl_product_detail->PackingQty->Visible) { // PackingQty ?>
	<?php if ($tbl_product_detail->sortUrl($tbl_product_detail->PackingQty) == "") { ?>
		<th data-name="PackingQty" class="<?php echo $tbl_product_detail->PackingQty->headerCellClass() ?>" style="white-space: nowrap;"><div id="elh_tbl_product_detail_PackingQty" class="tbl_product_detail_PackingQty"><div class="ew-table-header-caption"><?php echo $tbl_product_detail->PackingQty->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="PackingQty" class="<?php echo $tbl_product_detail->PackingQty->headerCellClass() ?>" style="white-space: nowrap;"><div><div id="elh_tbl_product_detail_PackingQty" class="tbl_product_detail_PackingQty">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $tbl_product_detail->PackingQty->caption() ?></span><span class="ew-table-header-sort"><?php if ($tbl_product_detail->PackingQty->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($tbl_product_detail->PackingQty->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($tbl_product_detail->IdUnit->Visible) { // IdUnit ?>
	<?php if ($tbl_product_detail->sortUrl($tbl_product_detail->IdUnit) == "") { ?>
		<th data-name="IdUnit" class="<?php echo $tbl_product_detail->IdUnit->headerCellClass() ?>"><div id="elh_tbl_product_detail_IdUnit" class="tbl_product_detail_IdUnit"><div class="ew-table-header-caption"><?php echo $tbl_product_detail->IdUnit->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="IdUnit" class="<?php echo $tbl_product_detail->IdUnit->headerCellClass() ?>"><div><div id="elh_tbl_product_detail_IdUnit" class="tbl_product_detail_IdUnit">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $tbl_product_detail->IdUnit->caption() ?></span><span class="ew-table-header-sort"><?php if ($tbl_product_detail->IdUnit->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($tbl_product_detail->IdUnit->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($tbl_product_detail->DefaultCode->Visible) { // DefaultCode ?>
	<?php if ($tbl_product_detail->sortUrl($tbl_product_detail->DefaultCode) == "") { ?>
		<th data-name="DefaultCode" class="<?php echo $tbl_product_detail->DefaultCode->headerCellClass() ?>" style="white-space: nowrap;"><div id="elh_tbl_product_detail_DefaultCode" class="tbl_product_detail_DefaultCode"><div class="ew-table-header-caption"><?php echo $tbl_product_detail->DefaultCode->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="DefaultCode" class="<?php echo $tbl_product_detail->DefaultCode->headerCellClass() ?>" style="white-space: nowrap;"><div><div id="elh_tbl_product_detail_DefaultCode" class="tbl_product_detail_DefaultCode">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $tbl_product_detail->DefaultCode->caption() ?></span><span class="ew-table-header-sort"><?php if ($tbl_product_detail->DefaultCode->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($tbl_product_detail->DefaultCode->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$tbl_product_detail_grid->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
$tbl_product_detail_grid->StartRec = 1;
$tbl_product_detail_grid->StopRec = $tbl_product_detail_grid->TotalRecs; // Show all records

// Restore number of post back records
if ($CurrentForm && $tbl_product_detail_grid->EventCancelled) {
	$CurrentForm->Index = -1;
	if ($CurrentForm->hasValue($tbl_product_detail_grid->FormKeyCountName) && ($tbl_product_detail->isGridAdd() || $tbl_product_detail->isGridEdit() || $tbl_product_detail->isConfirm())) {
		$tbl_product_detail_grid->KeyCount = $CurrentForm->getValue($tbl_product_detail_grid->FormKeyCountName);
		$tbl_product_detail_grid->StopRec = $tbl_product_detail_grid->StartRec + $tbl_product_detail_grid->KeyCount - 1;
	}
}
$tbl_product_detail_grid->RecCnt = $tbl_product_detail_grid->StartRec - 1;
if ($tbl_product_detail_grid->Recordset && !$tbl_product_detail_grid->Recordset->EOF) {
	$tbl_product_detail_grid->Recordset->moveFirst();
	$selectLimit = $tbl_product_detail_grid->UseSelectLimit;
	if (!$selectLimit && $tbl_product_detail_grid->StartRec > 1)
		$tbl_product_detail_grid->Recordset->move($tbl_product_detail_grid->StartRec - 1);
} elseif (!$tbl_product_detail->AllowAddDeleteRow && $tbl_product_detail_grid->StopRec == 0) {
	$tbl_product_detail_grid->StopRec = $tbl_product_detail->GridAddRowCount;
}

// Initialize aggregate
$tbl_product_detail->RowType = ROWTYPE_AGGREGATEINIT;
$tbl_product_detail->resetAttributes();
$tbl_product_detail_grid->renderRow();
if ($tbl_product_detail->isGridAdd())
	$tbl_product_detail_grid->RowIndex = 0;
if ($tbl_product_detail->isGridEdit())
	$tbl_product_detail_grid->RowIndex = 0;
while ($tbl_product_detail_grid->RecCnt < $tbl_product_detail_grid->StopRec) {
	$tbl_product_detail_grid->RecCnt++;
	if ($tbl_product_detail_grid->RecCnt >= $tbl_product_detail_grid->StartRec) {
		$tbl_product_detail_grid->RowCnt++;
		if ($tbl_product_detail->isGridAdd() || $tbl_product_detail->isGridEdit() || $tbl_product_detail->isConfirm()) {
			$tbl_product_detail_grid->RowIndex++;
			$CurrentForm->Index = $tbl_product_detail_grid->RowIndex;
			if ($CurrentForm->hasValue($tbl_product_detail_grid->FormActionName) && $tbl_product_detail_grid->EventCancelled)
				$tbl_product_detail_grid->RowAction = strval($CurrentForm->getValue($tbl_product_detail_grid->FormActionName));
			elseif ($tbl_product_detail->isGridAdd())
				$tbl_product_detail_grid->RowAction = "insert";
			else
				$tbl_product_detail_grid->RowAction = "";
		}

		// Set up key count
		$tbl_product_detail_grid->KeyCount = $tbl_product_detail_grid->RowIndex;

		// Init row class and style
		$tbl_product_detail->resetAttributes();
		$tbl_product_detail->CssClass = "";
		if ($tbl_product_detail->isGridAdd()) {
			if ($tbl_product_detail->CurrentMode == "copy") {
				$tbl_product_detail_grid->loadRowValues($tbl_product_detail_grid->Recordset); // Load row values
				$tbl_product_detail_grid->setRecordKey($tbl_product_detail_grid->RowOldKey, $tbl_product_detail_grid->Recordset); // Set old record key
			} else {
				$tbl_product_detail_grid->loadRowValues(); // Load default values
				$tbl_product_detail_grid->RowOldKey = ""; // Clear old key value
			}
		} else {
			$tbl_product_detail_grid->loadRowValues($tbl_product_detail_grid->Recordset); // Load row values
		}
		$tbl_product_detail->RowType = ROWTYPE_VIEW; // Render view
		if ($tbl_product_detail->isGridAdd()) // Grid add
			$tbl_product_detail->RowType = ROWTYPE_ADD; // Render add
		if ($tbl_product_detail->isGridAdd() && $tbl_product_detail->EventCancelled && !$CurrentForm->hasValue("k_blankrow")) // Insert failed
			$tbl_product_detail_grid->restoreCurrentRowFormValues($tbl_product_detail_grid->RowIndex); // Restore form values
		if ($tbl_product_detail->isGridEdit()) { // Grid edit
			if ($tbl_product_detail->EventCancelled)
				$tbl_product_detail_grid->restoreCurrentRowFormValues($tbl_product_detail_grid->RowIndex); // Restore form values
			if ($tbl_product_detail_grid->RowAction == "insert")
				$tbl_product_detail->RowType = ROWTYPE_ADD; // Render add
			else
				$tbl_product_detail->RowType = ROWTYPE_EDIT; // Render edit
		}
		if ($tbl_product_detail->isGridEdit() && ($tbl_product_detail->RowType == ROWTYPE_EDIT || $tbl_product_detail->RowType == ROWTYPE_ADD) && $tbl_product_detail->EventCancelled) // Update failed
			$tbl_product_detail_grid->restoreCurrentRowFormValues($tbl_product_detail_grid->RowIndex); // Restore form values
		if ($tbl_product_detail->RowType == ROWTYPE_EDIT) // Edit row
			$tbl_product_detail_grid->EditRowCnt++;
		if ($tbl_product_detail->isConfirm()) // Confirm row
			$tbl_product_detail_grid->restoreCurrentRowFormValues($tbl_product_detail_grid->RowIndex); // Restore form values

		// Set up row id / data-rowindex
		$tbl_product_detail->RowAttrs = array_merge($tbl_product_detail->RowAttrs, array('data-rowindex'=>$tbl_product_detail_grid->RowCnt, 'id'=>'r' . $tbl_product_detail_grid->RowCnt . '_tbl_product_detail', 'data-rowtype'=>$tbl_product_detail->RowType));

		// Render row
		$tbl_product_detail_grid->renderRow();

		// Render list options
		$tbl_product_detail_grid->renderListOptions();

		// Skip delete row / empty row for confirm page
		if ($tbl_product_detail_grid->RowAction <> "delete" && $tbl_product_detail_grid->RowAction <> "insertdelete" && !($tbl_product_detail_grid->RowAction == "insert" && $tbl_product_detail->isConfirm() && $tbl_product_detail_grid->emptyRow())) {
?>
	<tr<?php echo $tbl_product_detail->rowAttributes() ?>>
<?php

// Render list options (body, left)
$tbl_product_detail_grid->ListOptions->render("body", "left", $tbl_product_detail_grid->RowCnt);
?>
	<?php if ($tbl_product_detail->PackingQty->Visible) { // PackingQty ?>
		<td data-name="PackingQty"<?php echo $tbl_product_detail->PackingQty->cellAttributes() ?>>
<?php if ($tbl_product_detail->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $tbl_product_detail_grid->RowCnt ?>_tbl_product_detail_PackingQty" class="form-group tbl_product_detail_PackingQty">
<input type="text" data-table="tbl_product_detail" data-field="x_PackingQty" name="x<?php echo $tbl_product_detail_grid->RowIndex ?>_PackingQty" id="x<?php echo $tbl_product_detail_grid->RowIndex ?>_PackingQty" size="5" placeholder="<?php echo HtmlEncode($tbl_product_detail->PackingQty->getPlaceHolder()) ?>" value="<?php echo $tbl_product_detail->PackingQty->EditValue ?>"<?php echo $tbl_product_detail->PackingQty->editAttributes() ?>>
</span>
<input type="hidden" data-table="tbl_product_detail" data-field="x_PackingQty" name="o<?php echo $tbl_product_detail_grid->RowIndex ?>_PackingQty" id="o<?php echo $tbl_product_detail_grid->RowIndex ?>_PackingQty" value="<?php echo HtmlEncode($tbl_product_detail->PackingQty->OldValue) ?>">
<?php } ?>
<?php if ($tbl_product_detail->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $tbl_product_detail_grid->RowCnt ?>_tbl_product_detail_PackingQty" class="form-group tbl_product_detail_PackingQty">
<input type="text" data-table="tbl_product_detail" data-field="x_PackingQty" name="x<?php echo $tbl_product_detail_grid->RowIndex ?>_PackingQty" id="x<?php echo $tbl_product_detail_grid->RowIndex ?>_PackingQty" size="5" placeholder="<?php echo HtmlEncode($tbl_product_detail->PackingQty->getPlaceHolder()) ?>" value="<?php echo $tbl_product_detail->PackingQty->EditValue ?>"<?php echo $tbl_product_detail->PackingQty->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($tbl_product_detail->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $tbl_product_detail_grid->RowCnt ?>_tbl_product_detail_PackingQty" class="tbl_product_detail_PackingQty">
<span<?php echo $tbl_product_detail->PackingQty->viewAttributes() ?>>
<?php echo $tbl_product_detail->PackingQty->getViewValue() ?></span>
</span>
<?php if (!$tbl_product_detail->isConfirm()) { ?>
<input type="hidden" data-table="tbl_product_detail" data-field="x_PackingQty" name="x<?php echo $tbl_product_detail_grid->RowIndex ?>_PackingQty" id="x<?php echo $tbl_product_detail_grid->RowIndex ?>_PackingQty" value="<?php echo HtmlEncode($tbl_product_detail->PackingQty->FormValue) ?>">
<input type="hidden" data-table="tbl_product_detail" data-field="x_PackingQty" name="o<?php echo $tbl_product_detail_grid->RowIndex ?>_PackingQty" id="o<?php echo $tbl_product_detail_grid->RowIndex ?>_PackingQty" value="<?php echo HtmlEncode($tbl_product_detail->PackingQty->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="tbl_product_detail" data-field="x_PackingQty" name="ftbl_product_detailgrid$x<?php echo $tbl_product_detail_grid->RowIndex ?>_PackingQty" id="ftbl_product_detailgrid$x<?php echo $tbl_product_detail_grid->RowIndex ?>_PackingQty" value="<?php echo HtmlEncode($tbl_product_detail->PackingQty->FormValue) ?>">
<input type="hidden" data-table="tbl_product_detail" data-field="x_PackingQty" name="ftbl_product_detailgrid$o<?php echo $tbl_product_detail_grid->RowIndex ?>_PackingQty" id="ftbl_product_detailgrid$o<?php echo $tbl_product_detail_grid->RowIndex ?>_PackingQty" value="<?php echo HtmlEncode($tbl_product_detail->PackingQty->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
<?php if ($tbl_product_detail->RowType == ROWTYPE_ADD) { // Add record ?>
<input type="hidden" data-table="tbl_product_detail" data-field="x_IdCode" name="x<?php echo $tbl_product_detail_grid->RowIndex ?>_IdCode" id="x<?php echo $tbl_product_detail_grid->RowIndex ?>_IdCode" value="<?php echo HtmlEncode($tbl_product_detail->IdCode->CurrentValue) ?>">
<input type="hidden" data-table="tbl_product_detail" data-field="x_IdCode" name="o<?php echo $tbl_product_detail_grid->RowIndex ?>_IdCode" id="o<?php echo $tbl_product_detail_grid->RowIndex ?>_IdCode" value="<?php echo HtmlEncode($tbl_product_detail->IdCode->OldValue) ?>">
<?php } ?>
<?php if ($tbl_product_detail->RowType == ROWTYPE_EDIT || $tbl_product_detail->CurrentMode == "edit") { ?>
<input type="hidden" data-table="tbl_product_detail" data-field="x_IdCode" name="x<?php echo $tbl_product_detail_grid->RowIndex ?>_IdCode" id="x<?php echo $tbl_product_detail_grid->RowIndex ?>_IdCode" value="<?php echo HtmlEncode($tbl_product_detail->IdCode->CurrentValue) ?>">
<?php } ?>
	<?php if ($tbl_product_detail->IdUnit->Visible) { // IdUnit ?>
		<td data-name="IdUnit"<?php echo $tbl_product_detail->IdUnit->cellAttributes() ?>>
<?php if ($tbl_product_detail->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $tbl_product_detail_grid->RowCnt ?>_tbl_product_detail_IdUnit" class="form-group tbl_product_detail_IdUnit">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="tbl_product_detail" data-field="x_IdUnit" data-value-separator="<?php echo $tbl_product_detail->IdUnit->displayValueSeparatorAttribute() ?>" id="x<?php echo $tbl_product_detail_grid->RowIndex ?>_IdUnit" name="x<?php echo $tbl_product_detail_grid->RowIndex ?>_IdUnit"<?php echo $tbl_product_detail->IdUnit->editAttributes() ?>>
		<?php echo $tbl_product_detail->IdUnit->selectOptionListHtml("x<?php echo $tbl_product_detail_grid->RowIndex ?>_IdUnit") ?>
	</select>
</div>
<?php echo $tbl_product_detail->IdUnit->Lookup->getParamTag("p_x" . $tbl_product_detail_grid->RowIndex . "_IdUnit") ?>
</span>
<input type="hidden" data-table="tbl_product_detail" data-field="x_IdUnit" name="o<?php echo $tbl_product_detail_grid->RowIndex ?>_IdUnit" id="o<?php echo $tbl_product_detail_grid->RowIndex ?>_IdUnit" value="<?php echo HtmlEncode($tbl_product_detail->IdUnit->OldValue) ?>">
<?php } ?>
<?php if ($tbl_product_detail->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $tbl_product_detail_grid->RowCnt ?>_tbl_product_detail_IdUnit" class="form-group tbl_product_detail_IdUnit">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="tbl_product_detail" data-field="x_IdUnit" data-value-separator="<?php echo $tbl_product_detail->IdUnit->displayValueSeparatorAttribute() ?>" id="x<?php echo $tbl_product_detail_grid->RowIndex ?>_IdUnit" name="x<?php echo $tbl_product_detail_grid->RowIndex ?>_IdUnit"<?php echo $tbl_product_detail->IdUnit->editAttributes() ?>>
		<?php echo $tbl_product_detail->IdUnit->selectOptionListHtml("x<?php echo $tbl_product_detail_grid->RowIndex ?>_IdUnit") ?>
	</select>
</div>
<?php echo $tbl_product_detail->IdUnit->Lookup->getParamTag("p_x" . $tbl_product_detail_grid->RowIndex . "_IdUnit") ?>
</span>
<?php } ?>
<?php if ($tbl_product_detail->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $tbl_product_detail_grid->RowCnt ?>_tbl_product_detail_IdUnit" class="tbl_product_detail_IdUnit">
<span<?php echo $tbl_product_detail->IdUnit->viewAttributes() ?>>
<?php echo $tbl_product_detail->IdUnit->getViewValue() ?></span>
</span>
<?php if (!$tbl_product_detail->isConfirm()) { ?>
<input type="hidden" data-table="tbl_product_detail" data-field="x_IdUnit" name="x<?php echo $tbl_product_detail_grid->RowIndex ?>_IdUnit" id="x<?php echo $tbl_product_detail_grid->RowIndex ?>_IdUnit" value="<?php echo HtmlEncode($tbl_product_detail->IdUnit->FormValue) ?>">
<input type="hidden" data-table="tbl_product_detail" data-field="x_IdUnit" name="o<?php echo $tbl_product_detail_grid->RowIndex ?>_IdUnit" id="o<?php echo $tbl_product_detail_grid->RowIndex ?>_IdUnit" value="<?php echo HtmlEncode($tbl_product_detail->IdUnit->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="tbl_product_detail" data-field="x_IdUnit" name="ftbl_product_detailgrid$x<?php echo $tbl_product_detail_grid->RowIndex ?>_IdUnit" id="ftbl_product_detailgrid$x<?php echo $tbl_product_detail_grid->RowIndex ?>_IdUnit" value="<?php echo HtmlEncode($tbl_product_detail->IdUnit->FormValue) ?>">
<input type="hidden" data-table="tbl_product_detail" data-field="x_IdUnit" name="ftbl_product_detailgrid$o<?php echo $tbl_product_detail_grid->RowIndex ?>_IdUnit" id="ftbl_product_detailgrid$o<?php echo $tbl_product_detail_grid->RowIndex ?>_IdUnit" value="<?php echo HtmlEncode($tbl_product_detail->IdUnit->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($tbl_product_detail->DefaultCode->Visible) { // DefaultCode ?>
		<td data-name="DefaultCode"<?php echo $tbl_product_detail->DefaultCode->cellAttributes() ?>>
<?php if ($tbl_product_detail->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $tbl_product_detail_grid->RowCnt ?>_tbl_product_detail_DefaultCode" class="form-group tbl_product_detail_DefaultCode">
<div id="tp_x<?php echo $tbl_product_detail_grid->RowIndex ?>_DefaultCode" class="ew-template"><input type="radio" class="form-check-input" data-table="tbl_product_detail" data-field="x_DefaultCode" data-value-separator="<?php echo $tbl_product_detail->DefaultCode->displayValueSeparatorAttribute() ?>" name="x<?php echo $tbl_product_detail_grid->RowIndex ?>_DefaultCode" id="x<?php echo $tbl_product_detail_grid->RowIndex ?>_DefaultCode" value="{value}"<?php echo $tbl_product_detail->DefaultCode->editAttributes() ?>></div>
<div id="dsl_x<?php echo $tbl_product_detail_grid->RowIndex ?>_DefaultCode" data-repeatcolumn="5" class="ew-item-list d-none"><div>
<?php echo $tbl_product_detail->DefaultCode->radioButtonListHtml(FALSE, "x{$tbl_product_detail_grid->RowIndex}_DefaultCode") ?>
</div></div>
</span>
<input type="hidden" data-table="tbl_product_detail" data-field="x_DefaultCode" name="o<?php echo $tbl_product_detail_grid->RowIndex ?>_DefaultCode" id="o<?php echo $tbl_product_detail_grid->RowIndex ?>_DefaultCode" value="<?php echo HtmlEncode($tbl_product_detail->DefaultCode->OldValue) ?>">
<?php } ?>
<?php if ($tbl_product_detail->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $tbl_product_detail_grid->RowCnt ?>_tbl_product_detail_DefaultCode" class="form-group tbl_product_detail_DefaultCode">
<div id="tp_x<?php echo $tbl_product_detail_grid->RowIndex ?>_DefaultCode" class="ew-template"><input type="radio" class="form-check-input" data-table="tbl_product_detail" data-field="x_DefaultCode" data-value-separator="<?php echo $tbl_product_detail->DefaultCode->displayValueSeparatorAttribute() ?>" name="x<?php echo $tbl_product_detail_grid->RowIndex ?>_DefaultCode" id="x<?php echo $tbl_product_detail_grid->RowIndex ?>_DefaultCode" value="{value}"<?php echo $tbl_product_detail->DefaultCode->editAttributes() ?>></div>
<div id="dsl_x<?php echo $tbl_product_detail_grid->RowIndex ?>_DefaultCode" data-repeatcolumn="5" class="ew-item-list d-none"><div>
<?php echo $tbl_product_detail->DefaultCode->radioButtonListHtml(FALSE, "x{$tbl_product_detail_grid->RowIndex}_DefaultCode") ?>
</div></div>
</span>
<?php } ?>
<?php if ($tbl_product_detail->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $tbl_product_detail_grid->RowCnt ?>_tbl_product_detail_DefaultCode" class="tbl_product_detail_DefaultCode">
<span<?php echo $tbl_product_detail->DefaultCode->viewAttributes() ?>>
<?php echo $tbl_product_detail->DefaultCode->getViewValue() ?></span>
</span>
<?php if (!$tbl_product_detail->isConfirm()) { ?>
<input type="hidden" data-table="tbl_product_detail" data-field="x_DefaultCode" name="x<?php echo $tbl_product_detail_grid->RowIndex ?>_DefaultCode" id="x<?php echo $tbl_product_detail_grid->RowIndex ?>_DefaultCode" value="<?php echo HtmlEncode($tbl_product_detail->DefaultCode->FormValue) ?>">
<input type="hidden" data-table="tbl_product_detail" data-field="x_DefaultCode" name="o<?php echo $tbl_product_detail_grid->RowIndex ?>_DefaultCode" id="o<?php echo $tbl_product_detail_grid->RowIndex ?>_DefaultCode" value="<?php echo HtmlEncode($tbl_product_detail->DefaultCode->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="tbl_product_detail" data-field="x_DefaultCode" name="ftbl_product_detailgrid$x<?php echo $tbl_product_detail_grid->RowIndex ?>_DefaultCode" id="ftbl_product_detailgrid$x<?php echo $tbl_product_detail_grid->RowIndex ?>_DefaultCode" value="<?php echo HtmlEncode($tbl_product_detail->DefaultCode->FormValue) ?>">
<input type="hidden" data-table="tbl_product_detail" data-field="x_DefaultCode" name="ftbl_product_detailgrid$o<?php echo $tbl_product_detail_grid->RowIndex ?>_DefaultCode" id="ftbl_product_detailgrid$o<?php echo $tbl_product_detail_grid->RowIndex ?>_DefaultCode" value="<?php echo HtmlEncode($tbl_product_detail->DefaultCode->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$tbl_product_detail_grid->ListOptions->render("body", "right", $tbl_product_detail_grid->RowCnt);
?>
	</tr>
<?php if ($tbl_product_detail->RowType == ROWTYPE_ADD || $tbl_product_detail->RowType == ROWTYPE_EDIT) { ?>
<script>
ftbl_product_detailgrid.updateLists(<?php echo $tbl_product_detail_grid->RowIndex ?>);
</script>
<?php } ?>
<?php
	}
	} // End delete row checking
	if (!$tbl_product_detail->isGridAdd() || $tbl_product_detail->CurrentMode == "copy")
		if (!$tbl_product_detail_grid->Recordset->EOF)
			$tbl_product_detail_grid->Recordset->moveNext();
}
?>
<?php
	if ($tbl_product_detail->CurrentMode == "add" || $tbl_product_detail->CurrentMode == "copy" || $tbl_product_detail->CurrentMode == "edit") {
		$tbl_product_detail_grid->RowIndex = '$rowindex$';
		$tbl_product_detail_grid->loadRowValues();

		// Set row properties
		$tbl_product_detail->resetAttributes();
		$tbl_product_detail->RowAttrs = array_merge($tbl_product_detail->RowAttrs, array('data-rowindex'=>$tbl_product_detail_grid->RowIndex, 'id'=>'r0_tbl_product_detail', 'data-rowtype'=>ROWTYPE_ADD));
		AppendClass($tbl_product_detail->RowAttrs["class"], "ew-template");
		$tbl_product_detail->RowType = ROWTYPE_ADD;

		// Render row
		$tbl_product_detail_grid->renderRow();

		// Render list options
		$tbl_product_detail_grid->renderListOptions();
		$tbl_product_detail_grid->StartRowCnt = 0;
?>
	<tr<?php echo $tbl_product_detail->rowAttributes() ?>>
<?php

// Render list options (body, left)
$tbl_product_detail_grid->ListOptions->render("body", "left", $tbl_product_detail_grid->RowIndex);
?>
	<?php if ($tbl_product_detail->PackingQty->Visible) { // PackingQty ?>
		<td data-name="PackingQty">
<?php if (!$tbl_product_detail->isConfirm()) { ?>
<span id="el$rowindex$_tbl_product_detail_PackingQty" class="form-group tbl_product_detail_PackingQty">
<input type="text" data-table="tbl_product_detail" data-field="x_PackingQty" name="x<?php echo $tbl_product_detail_grid->RowIndex ?>_PackingQty" id="x<?php echo $tbl_product_detail_grid->RowIndex ?>_PackingQty" size="5" placeholder="<?php echo HtmlEncode($tbl_product_detail->PackingQty->getPlaceHolder()) ?>" value="<?php echo $tbl_product_detail->PackingQty->EditValue ?>"<?php echo $tbl_product_detail->PackingQty->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_tbl_product_detail_PackingQty" class="form-group tbl_product_detail_PackingQty">
<span<?php echo $tbl_product_detail->PackingQty->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?php echo RemoveHtml($tbl_product_detail->PackingQty->ViewValue) ?>"></span>
</span>
<input type="hidden" data-table="tbl_product_detail" data-field="x_PackingQty" name="x<?php echo $tbl_product_detail_grid->RowIndex ?>_PackingQty" id="x<?php echo $tbl_product_detail_grid->RowIndex ?>_PackingQty" value="<?php echo HtmlEncode($tbl_product_detail->PackingQty->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="tbl_product_detail" data-field="x_PackingQty" name="o<?php echo $tbl_product_detail_grid->RowIndex ?>_PackingQty" id="o<?php echo $tbl_product_detail_grid->RowIndex ?>_PackingQty" value="<?php echo HtmlEncode($tbl_product_detail->PackingQty->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($tbl_product_detail->IdUnit->Visible) { // IdUnit ?>
		<td data-name="IdUnit">
<?php if (!$tbl_product_detail->isConfirm()) { ?>
<span id="el$rowindex$_tbl_product_detail_IdUnit" class="form-group tbl_product_detail_IdUnit">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="tbl_product_detail" data-field="x_IdUnit" data-value-separator="<?php echo $tbl_product_detail->IdUnit->displayValueSeparatorAttribute() ?>" id="x<?php echo $tbl_product_detail_grid->RowIndex ?>_IdUnit" name="x<?php echo $tbl_product_detail_grid->RowIndex ?>_IdUnit"<?php echo $tbl_product_detail->IdUnit->editAttributes() ?>>
		<?php echo $tbl_product_detail->IdUnit->selectOptionListHtml("x<?php echo $tbl_product_detail_grid->RowIndex ?>_IdUnit") ?>
	</select>
</div>
<?php echo $tbl_product_detail->IdUnit->Lookup->getParamTag("p_x" . $tbl_product_detail_grid->RowIndex . "_IdUnit") ?>
</span>
<?php } else { ?>
<span id="el$rowindex$_tbl_product_detail_IdUnit" class="form-group tbl_product_detail_IdUnit">
<span<?php echo $tbl_product_detail->IdUnit->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?php echo RemoveHtml($tbl_product_detail->IdUnit->ViewValue) ?>"></span>
</span>
<input type="hidden" data-table="tbl_product_detail" data-field="x_IdUnit" name="x<?php echo $tbl_product_detail_grid->RowIndex ?>_IdUnit" id="x<?php echo $tbl_product_detail_grid->RowIndex ?>_IdUnit" value="<?php echo HtmlEncode($tbl_product_detail->IdUnit->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="tbl_product_detail" data-field="x_IdUnit" name="o<?php echo $tbl_product_detail_grid->RowIndex ?>_IdUnit" id="o<?php echo $tbl_product_detail_grid->RowIndex ?>_IdUnit" value="<?php echo HtmlEncode($tbl_product_detail->IdUnit->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($tbl_product_detail->DefaultCode->Visible) { // DefaultCode ?>
		<td data-name="DefaultCode">
<?php if (!$tbl_product_detail->isConfirm()) { ?>
<span id="el$rowindex$_tbl_product_detail_DefaultCode" class="form-group tbl_product_detail_DefaultCode">
<div id="tp_x<?php echo $tbl_product_detail_grid->RowIndex ?>_DefaultCode" class="ew-template"><input type="radio" class="form-check-input" data-table="tbl_product_detail" data-field="x_DefaultCode" data-value-separator="<?php echo $tbl_product_detail->DefaultCode->displayValueSeparatorAttribute() ?>" name="x<?php echo $tbl_product_detail_grid->RowIndex ?>_DefaultCode" id="x<?php echo $tbl_product_detail_grid->RowIndex ?>_DefaultCode" value="{value}"<?php echo $tbl_product_detail->DefaultCode->editAttributes() ?>></div>
<div id="dsl_x<?php echo $tbl_product_detail_grid->RowIndex ?>_DefaultCode" data-repeatcolumn="5" class="ew-item-list d-none"><div>
<?php echo $tbl_product_detail->DefaultCode->radioButtonListHtml(FALSE, "x{$tbl_product_detail_grid->RowIndex}_DefaultCode") ?>
</div></div>
</span>
<?php } else { ?>
<span id="el$rowindex$_tbl_product_detail_DefaultCode" class="form-group tbl_product_detail_DefaultCode">
<span<?php echo $tbl_product_detail->DefaultCode->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?php echo RemoveHtml($tbl_product_detail->DefaultCode->ViewValue) ?>"></span>
</span>
<input type="hidden" data-table="tbl_product_detail" data-field="x_DefaultCode" name="x<?php echo $tbl_product_detail_grid->RowIndex ?>_DefaultCode" id="x<?php echo $tbl_product_detail_grid->RowIndex ?>_DefaultCode" value="<?php echo HtmlEncode($tbl_product_detail->DefaultCode->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="tbl_product_detail" data-field="x_DefaultCode" name="o<?php echo $tbl_product_detail_grid->RowIndex ?>_DefaultCode" id="o<?php echo $tbl_product_detail_grid->RowIndex ?>_DefaultCode" value="<?php echo HtmlEncode($tbl_product_detail->DefaultCode->OldValue) ?>">
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$tbl_product_detail_grid->ListOptions->render("body", "right", $tbl_product_detail_grid->RowIndex);
?>
<script>
ftbl_product_detailgrid.updateLists(<?php echo $tbl_product_detail_grid->RowIndex ?>);
</script>
	</tr>
<?php
}
?>
</tbody>
</table><!-- /.ew-table -->
<?php if ($tbl_product_detail->CurrentMode == "add" || $tbl_product_detail->CurrentMode == "copy") { ?>
<input type="hidden" name="<?php echo $tbl_product_detail_grid->FormKeyCountName ?>" id="<?php echo $tbl_product_detail_grid->FormKeyCountName ?>" value="<?php echo $tbl_product_detail_grid->KeyCount ?>">
<?php echo $tbl_product_detail_grid->MultiSelectKey ?>
<?php } ?>
<?php if ($tbl_product_detail->CurrentMode == "edit") { ?>
<input type="hidden" name="<?php echo $tbl_product_detail_grid->FormKeyCountName ?>" id="<?php echo $tbl_product_detail_grid->FormKeyCountName ?>" value="<?php echo $tbl_product_detail_grid->KeyCount ?>">
<?php echo $tbl_product_detail_grid->MultiSelectKey ?>
<?php } ?>
<?php if ($tbl_product_detail->CurrentMode == "") { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
<input type="hidden" name="detailpage" value="ftbl_product_detailgrid">
</div><!-- /.ew-grid-middle-panel -->
<?php

// Close recordset
if ($tbl_product_detail_grid->Recordset)
	$tbl_product_detail_grid->Recordset->Close();
?>
</div>
<?php if ($tbl_product_detail_grid->ShowOtherOptions) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php $tbl_product_detail_grid->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($tbl_product_detail_grid->TotalRecs == 0 && !$tbl_product_detail->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $tbl_product_detail_grid->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$tbl_product_detail_grid->terminate();
?>