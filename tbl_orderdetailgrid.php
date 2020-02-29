<?php
namespace PHPMaker2019\asgbn_wh;

// Write header
WriteHeader(FALSE);

// Create page object
if (!isset($tbl_orderdetail_grid))
	$tbl_orderdetail_grid = new tbl_orderdetail_grid();

// Run the page
$tbl_orderdetail_grid->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$tbl_orderdetail_grid->Page_Render();
?>
<?php if (!$tbl_orderdetail->isExport()) { ?>
<script>

// Form object
var ftbl_orderdetailgrid = new ew.Form("ftbl_orderdetailgrid", "grid");
ftbl_orderdetailgrid.formKeyCountName = '<?php echo $tbl_orderdetail_grid->FormKeyCountName ?>';

// Validate form
ftbl_orderdetailgrid.validate = function() {
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
		<?php if ($tbl_orderdetail_grid->Code->Required) { ?>
			elm = this.getElements("x" + infix + "_Code");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $tbl_orderdetail->Code->caption(), $tbl_orderdetail->Code->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($tbl_orderdetail_grid->PCS->Required) { ?>
			elm = this.getElements("x" + infix + "_PCS");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $tbl_orderdetail->PCS->caption(), $tbl_orderdetail->PCS->RequiredErrorMessage)) ?>");
		<?php } ?>
			elm = this.getElements("x" + infix + "_PCS");
			if (elm && !ew.checkInteger(elm.value))
				return this.onError(elm, "<?php echo JsEncode($tbl_orderdetail->PCS->errorMessage()) ?>");

			// Fire Form_CustomValidate event
			if (!this.Form_CustomValidate(fobj))
				return false;
		} // End Grid Add checking
	}
	return true;
}

// Check empty row
ftbl_orderdetailgrid.emptyRow = function(infix) {
	var fobj = this._form;
	if (ew.valueChanged(fobj, infix, "Code", false)) return false;
	if (ew.valueChanged(fobj, infix, "PCS", false)) return false;
	return true;
}

// Form_CustomValidate event
ftbl_orderdetailgrid.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

	// Your custom validation code here, return false if invalid.
	return true;
}

// Use JavaScript validation or not
ftbl_orderdetailgrid.validateRequired = <?php echo json_encode(CLIENT_VALIDATE) ?>;

// Dynamic selection lists
ftbl_orderdetailgrid.lists["x_Code"] = <?php echo $tbl_orderdetail_grid->Code->Lookup->toClientList() ?>;
ftbl_orderdetailgrid.lists["x_Code"].options = <?php echo JsonEncode($tbl_orderdetail_grid->Code->lookupOptions()) ?>;
ftbl_orderdetailgrid.autoSuggests["x_Code"] = <?php echo json_encode(["data" => "ajax=autosuggest"]) ?>;

// Form object for search
</script>
<?php } ?>
<?php
$tbl_orderdetail_grid->renderOtherOptions();
?>
<?php $tbl_orderdetail_grid->showPageHeader(); ?>
<?php
$tbl_orderdetail_grid->showMessage();
?>
<?php if ($tbl_orderdetail_grid->TotalRecs > 0 || $tbl_orderdetail->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($tbl_orderdetail_grid->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> tbl_orderdetail">
<?php if ($tbl_orderdetail_grid->ShowOtherOptions) { ?>
<div class="card-header ew-grid-upper-panel">
<?php $tbl_orderdetail_grid->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<div id="ftbl_orderdetailgrid" class="ew-form ew-list-form form-inline">
<div id="gmp_tbl_orderdetail" class="<?php if (IsResponsiveLayout()) { ?>table-responsive <?php } ?>card-body ew-grid-middle-panel">
<table id="tbl_tbl_orderdetailgrid" class="table ew-table"><!-- .ew-table ##-->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$tbl_orderdetail_grid->RowType = ROWTYPE_HEADER;

// Render list options
$tbl_orderdetail_grid->renderListOptions();

// Render list options (header, left)
$tbl_orderdetail_grid->ListOptions->render("header", "left");
?>
<?php if ($tbl_orderdetail->Code->Visible) { // Code ?>
	<?php if ($tbl_orderdetail->sortUrl($tbl_orderdetail->Code) == "") { ?>
		<th data-name="Code" class="<?php echo $tbl_orderdetail->Code->headerCellClass() ?>" style="white-space: nowrap;"><div id="elh_tbl_orderdetail_Code" class="tbl_orderdetail_Code"><div class="ew-table-header-caption"><?php echo $tbl_orderdetail->Code->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Code" class="<?php echo $tbl_orderdetail->Code->headerCellClass() ?>" style="white-space: nowrap;"><div><div id="elh_tbl_orderdetail_Code" class="tbl_orderdetail_Code">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $tbl_orderdetail->Code->caption() ?></span><span class="ew-table-header-sort"><?php if ($tbl_orderdetail->Code->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($tbl_orderdetail->Code->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($tbl_orderdetail->PCS->Visible) { // PCS ?>
	<?php if ($tbl_orderdetail->sortUrl($tbl_orderdetail->PCS) == "") { ?>
		<th data-name="PCS" class="<?php echo $tbl_orderdetail->PCS->headerCellClass() ?>" style="white-space: nowrap;"><div id="elh_tbl_orderdetail_PCS" class="tbl_orderdetail_PCS"><div class="ew-table-header-caption"><?php echo $tbl_orderdetail->PCS->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="PCS" class="<?php echo $tbl_orderdetail->PCS->headerCellClass() ?>" style="white-space: nowrap;"><div><div id="elh_tbl_orderdetail_PCS" class="tbl_orderdetail_PCS">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $tbl_orderdetail->PCS->caption() ?></span><span class="ew-table-header-sort"><?php if ($tbl_orderdetail->PCS->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($tbl_orderdetail->PCS->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$tbl_orderdetail_grid->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
$tbl_orderdetail_grid->StartRec = 1;
$tbl_orderdetail_grid->StopRec = $tbl_orderdetail_grid->TotalRecs; // Show all records

// Restore number of post back records
if ($CurrentForm && $tbl_orderdetail_grid->EventCancelled) {
	$CurrentForm->Index = -1;
	if ($CurrentForm->hasValue($tbl_orderdetail_grid->FormKeyCountName) && ($tbl_orderdetail->isGridAdd() || $tbl_orderdetail->isGridEdit() || $tbl_orderdetail->isConfirm())) {
		$tbl_orderdetail_grid->KeyCount = $CurrentForm->getValue($tbl_orderdetail_grid->FormKeyCountName);
		$tbl_orderdetail_grid->StopRec = $tbl_orderdetail_grid->StartRec + $tbl_orderdetail_grid->KeyCount - 1;
	}
}
$tbl_orderdetail_grid->RecCnt = $tbl_orderdetail_grid->StartRec - 1;
if ($tbl_orderdetail_grid->Recordset && !$tbl_orderdetail_grid->Recordset->EOF) {
	$tbl_orderdetail_grid->Recordset->moveFirst();
	$selectLimit = $tbl_orderdetail_grid->UseSelectLimit;
	if (!$selectLimit && $tbl_orderdetail_grid->StartRec > 1)
		$tbl_orderdetail_grid->Recordset->move($tbl_orderdetail_grid->StartRec - 1);
} elseif (!$tbl_orderdetail->AllowAddDeleteRow && $tbl_orderdetail_grid->StopRec == 0) {
	$tbl_orderdetail_grid->StopRec = $tbl_orderdetail->GridAddRowCount;
}

// Initialize aggregate
$tbl_orderdetail->RowType = ROWTYPE_AGGREGATEINIT;
$tbl_orderdetail->resetAttributes();
$tbl_orderdetail_grid->renderRow();
if ($tbl_orderdetail->isGridAdd())
	$tbl_orderdetail_grid->RowIndex = 0;
if ($tbl_orderdetail->isGridEdit())
	$tbl_orderdetail_grid->RowIndex = 0;
while ($tbl_orderdetail_grid->RecCnt < $tbl_orderdetail_grid->StopRec) {
	$tbl_orderdetail_grid->RecCnt++;
	if ($tbl_orderdetail_grid->RecCnt >= $tbl_orderdetail_grid->StartRec) {
		$tbl_orderdetail_grid->RowCnt++;
		if ($tbl_orderdetail->isGridAdd() || $tbl_orderdetail->isGridEdit() || $tbl_orderdetail->isConfirm()) {
			$tbl_orderdetail_grid->RowIndex++;
			$CurrentForm->Index = $tbl_orderdetail_grid->RowIndex;
			if ($CurrentForm->hasValue($tbl_orderdetail_grid->FormActionName) && $tbl_orderdetail_grid->EventCancelled)
				$tbl_orderdetail_grid->RowAction = strval($CurrentForm->getValue($tbl_orderdetail_grid->FormActionName));
			elseif ($tbl_orderdetail->isGridAdd())
				$tbl_orderdetail_grid->RowAction = "insert";
			else
				$tbl_orderdetail_grid->RowAction = "";
		}

		// Set up key count
		$tbl_orderdetail_grid->KeyCount = $tbl_orderdetail_grid->RowIndex;

		// Init row class and style
		$tbl_orderdetail->resetAttributes();
		$tbl_orderdetail->CssClass = "";
		if ($tbl_orderdetail->isGridAdd()) {
			if ($tbl_orderdetail->CurrentMode == "copy") {
				$tbl_orderdetail_grid->loadRowValues($tbl_orderdetail_grid->Recordset); // Load row values
				$tbl_orderdetail_grid->setRecordKey($tbl_orderdetail_grid->RowOldKey, $tbl_orderdetail_grid->Recordset); // Set old record key
			} else {
				$tbl_orderdetail_grid->loadRowValues(); // Load default values
				$tbl_orderdetail_grid->RowOldKey = ""; // Clear old key value
			}
		} else {
			$tbl_orderdetail_grid->loadRowValues($tbl_orderdetail_grid->Recordset); // Load row values
		}
		$tbl_orderdetail->RowType = ROWTYPE_VIEW; // Render view
		if ($tbl_orderdetail->isGridAdd()) // Grid add
			$tbl_orderdetail->RowType = ROWTYPE_ADD; // Render add
		if ($tbl_orderdetail->isGridAdd() && $tbl_orderdetail->EventCancelled && !$CurrentForm->hasValue("k_blankrow")) // Insert failed
			$tbl_orderdetail_grid->restoreCurrentRowFormValues($tbl_orderdetail_grid->RowIndex); // Restore form values
		if ($tbl_orderdetail->isGridEdit()) { // Grid edit
			if ($tbl_orderdetail->EventCancelled)
				$tbl_orderdetail_grid->restoreCurrentRowFormValues($tbl_orderdetail_grid->RowIndex); // Restore form values
			if ($tbl_orderdetail_grid->RowAction == "insert")
				$tbl_orderdetail->RowType = ROWTYPE_ADD; // Render add
			else
				$tbl_orderdetail->RowType = ROWTYPE_EDIT; // Render edit
		}
		if ($tbl_orderdetail->isGridEdit() && ($tbl_orderdetail->RowType == ROWTYPE_EDIT || $tbl_orderdetail->RowType == ROWTYPE_ADD) && $tbl_orderdetail->EventCancelled) // Update failed
			$tbl_orderdetail_grid->restoreCurrentRowFormValues($tbl_orderdetail_grid->RowIndex); // Restore form values
		if ($tbl_orderdetail->RowType == ROWTYPE_EDIT) // Edit row
			$tbl_orderdetail_grid->EditRowCnt++;
		if ($tbl_orderdetail->isConfirm()) // Confirm row
			$tbl_orderdetail_grid->restoreCurrentRowFormValues($tbl_orderdetail_grid->RowIndex); // Restore form values

		// Set up row id / data-rowindex
		$tbl_orderdetail->RowAttrs = array_merge($tbl_orderdetail->RowAttrs, array('data-rowindex'=>$tbl_orderdetail_grid->RowCnt, 'id'=>'r' . $tbl_orderdetail_grid->RowCnt . '_tbl_orderdetail', 'data-rowtype'=>$tbl_orderdetail->RowType));

		// Render row
		$tbl_orderdetail_grid->renderRow();

		// Render list options
		$tbl_orderdetail_grid->renderListOptions();

		// Skip delete row / empty row for confirm page
		if ($tbl_orderdetail_grid->RowAction <> "delete" && $tbl_orderdetail_grid->RowAction <> "insertdelete" && !($tbl_orderdetail_grid->RowAction == "insert" && $tbl_orderdetail->isConfirm() && $tbl_orderdetail_grid->emptyRow())) {
?>
	<tr<?php echo $tbl_orderdetail->rowAttributes() ?>>
<?php

// Render list options (body, left)
$tbl_orderdetail_grid->ListOptions->render("body", "left", $tbl_orderdetail_grid->RowCnt);
?>
	<?php if ($tbl_orderdetail->Code->Visible) { // Code ?>
		<td data-name="Code"<?php echo $tbl_orderdetail->Code->cellAttributes() ?>>
<?php if ($tbl_orderdetail->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $tbl_orderdetail_grid->RowCnt ?>_tbl_orderdetail_Code" class="form-group tbl_orderdetail_Code">
<?php
$wrkonchange = "ew.autoFill(this);" . trim(@$tbl_orderdetail->Code->EditAttrs["onchange"]);
if (trim($wrkonchange) <> "") $wrkonchange = " onchange=\"" . JsEncode($wrkonchange) . "\"";
$tbl_orderdetail->Code->EditAttrs["onchange"] = "";
?>
<span id="as_x<?php echo $tbl_orderdetail_grid->RowIndex ?>_Code" class="text-nowrap" style="z-index: <?php echo (9000 - $tbl_orderdetail_grid->RowCnt * 10) ?>">
	<input type="text" class="form-control" name="sv_x<?php echo $tbl_orderdetail_grid->RowIndex ?>_Code" id="sv_x<?php echo $tbl_orderdetail_grid->RowIndex ?>_Code" value="<?php echo RemoveHtml($tbl_orderdetail->Code->EditValue) ?>" size="30" placeholder="<?php echo HtmlEncode($tbl_orderdetail->Code->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($tbl_orderdetail->Code->getPlaceHolder()) ?>"<?php echo $tbl_orderdetail->Code->editAttributes() ?>>
</span>
<input type="hidden" data-table="tbl_orderdetail" data-field="x_Code" data-value-separator="<?php echo $tbl_orderdetail->Code->displayValueSeparatorAttribute() ?>" name="x<?php echo $tbl_orderdetail_grid->RowIndex ?>_Code" id="x<?php echo $tbl_orderdetail_grid->RowIndex ?>_Code" value="<?php echo HtmlEncode($tbl_orderdetail->Code->CurrentValue) ?>"<?php echo $wrkonchange ?>>
<script>
ftbl_orderdetailgrid.createAutoSuggest({"id":"x<?php echo $tbl_orderdetail_grid->RowIndex ?>_Code","forceSelect":true});
</script>
<?php echo $tbl_orderdetail->Code->Lookup->getParamTag("p_x" . $tbl_orderdetail_grid->RowIndex . "_Code") ?>
</span>
<input type="hidden" data-table="tbl_orderdetail" data-field="x_Code" name="o<?php echo $tbl_orderdetail_grid->RowIndex ?>_Code" id="o<?php echo $tbl_orderdetail_grid->RowIndex ?>_Code" value="<?php echo HtmlEncode($tbl_orderdetail->Code->OldValue) ?>">
<?php } ?>
<?php if ($tbl_orderdetail->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $tbl_orderdetail_grid->RowCnt ?>_tbl_orderdetail_Code" class="form-group tbl_orderdetail_Code">
<?php
$wrkonchange = "ew.autoFill(this);" . trim(@$tbl_orderdetail->Code->EditAttrs["onchange"]);
if (trim($wrkonchange) <> "") $wrkonchange = " onchange=\"" . JsEncode($wrkonchange) . "\"";
$tbl_orderdetail->Code->EditAttrs["onchange"] = "";
?>
<span id="as_x<?php echo $tbl_orderdetail_grid->RowIndex ?>_Code" class="text-nowrap" style="z-index: <?php echo (9000 - $tbl_orderdetail_grid->RowCnt * 10) ?>">
	<input type="text" class="form-control" name="sv_x<?php echo $tbl_orderdetail_grid->RowIndex ?>_Code" id="sv_x<?php echo $tbl_orderdetail_grid->RowIndex ?>_Code" value="<?php echo RemoveHtml($tbl_orderdetail->Code->EditValue) ?>" size="30" placeholder="<?php echo HtmlEncode($tbl_orderdetail->Code->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($tbl_orderdetail->Code->getPlaceHolder()) ?>"<?php echo $tbl_orderdetail->Code->editAttributes() ?>>
</span>
<input type="hidden" data-table="tbl_orderdetail" data-field="x_Code" data-value-separator="<?php echo $tbl_orderdetail->Code->displayValueSeparatorAttribute() ?>" name="x<?php echo $tbl_orderdetail_grid->RowIndex ?>_Code" id="x<?php echo $tbl_orderdetail_grid->RowIndex ?>_Code" value="<?php echo HtmlEncode($tbl_orderdetail->Code->CurrentValue) ?>"<?php echo $wrkonchange ?>>
<script>
ftbl_orderdetailgrid.createAutoSuggest({"id":"x<?php echo $tbl_orderdetail_grid->RowIndex ?>_Code","forceSelect":true});
</script>
<?php echo $tbl_orderdetail->Code->Lookup->getParamTag("p_x" . $tbl_orderdetail_grid->RowIndex . "_Code") ?>
</span>
<?php } ?>
<?php if ($tbl_orderdetail->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $tbl_orderdetail_grid->RowCnt ?>_tbl_orderdetail_Code" class="tbl_orderdetail_Code">
<span<?php echo $tbl_orderdetail->Code->viewAttributes() ?>>
<?php echo $tbl_orderdetail->Code->getViewValue() ?></span>
</span>
<?php if (!$tbl_orderdetail->isConfirm()) { ?>
<input type="hidden" data-table="tbl_orderdetail" data-field="x_Code" name="x<?php echo $tbl_orderdetail_grid->RowIndex ?>_Code" id="x<?php echo $tbl_orderdetail_grid->RowIndex ?>_Code" value="<?php echo HtmlEncode($tbl_orderdetail->Code->FormValue) ?>">
<input type="hidden" data-table="tbl_orderdetail" data-field="x_Code" name="o<?php echo $tbl_orderdetail_grid->RowIndex ?>_Code" id="o<?php echo $tbl_orderdetail_grid->RowIndex ?>_Code" value="<?php echo HtmlEncode($tbl_orderdetail->Code->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="tbl_orderdetail" data-field="x_Code" name="ftbl_orderdetailgrid$x<?php echo $tbl_orderdetail_grid->RowIndex ?>_Code" id="ftbl_orderdetailgrid$x<?php echo $tbl_orderdetail_grid->RowIndex ?>_Code" value="<?php echo HtmlEncode($tbl_orderdetail->Code->FormValue) ?>">
<input type="hidden" data-table="tbl_orderdetail" data-field="x_Code" name="ftbl_orderdetailgrid$o<?php echo $tbl_orderdetail_grid->RowIndex ?>_Code" id="ftbl_orderdetailgrid$o<?php echo $tbl_orderdetail_grid->RowIndex ?>_Code" value="<?php echo HtmlEncode($tbl_orderdetail->Code->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
<?php if ($tbl_orderdetail->RowType == ROWTYPE_ADD) { // Add record ?>
<input type="hidden" data-table="tbl_orderdetail" data-field="x_ID_Detail" name="x<?php echo $tbl_orderdetail_grid->RowIndex ?>_ID_Detail" id="x<?php echo $tbl_orderdetail_grid->RowIndex ?>_ID_Detail" value="<?php echo HtmlEncode($tbl_orderdetail->ID_Detail->CurrentValue) ?>">
<input type="hidden" data-table="tbl_orderdetail" data-field="x_ID_Detail" name="o<?php echo $tbl_orderdetail_grid->RowIndex ?>_ID_Detail" id="o<?php echo $tbl_orderdetail_grid->RowIndex ?>_ID_Detail" value="<?php echo HtmlEncode($tbl_orderdetail->ID_Detail->OldValue) ?>">
<?php } ?>
<?php if ($tbl_orderdetail->RowType == ROWTYPE_EDIT || $tbl_orderdetail->CurrentMode == "edit") { ?>
<input type="hidden" data-table="tbl_orderdetail" data-field="x_ID_Detail" name="x<?php echo $tbl_orderdetail_grid->RowIndex ?>_ID_Detail" id="x<?php echo $tbl_orderdetail_grid->RowIndex ?>_ID_Detail" value="<?php echo HtmlEncode($tbl_orderdetail->ID_Detail->CurrentValue) ?>">
<?php } ?>
	<?php if ($tbl_orderdetail->PCS->Visible) { // PCS ?>
		<td data-name="PCS"<?php echo $tbl_orderdetail->PCS->cellAttributes() ?>>
<?php if ($tbl_orderdetail->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $tbl_orderdetail_grid->RowCnt ?>_tbl_orderdetail_PCS" class="form-group tbl_orderdetail_PCS">
<input type="text" data-table="tbl_orderdetail" data-field="x_PCS" name="x<?php echo $tbl_orderdetail_grid->RowIndex ?>_PCS" id="x<?php echo $tbl_orderdetail_grid->RowIndex ?>_PCS" size="5" placeholder="<?php echo HtmlEncode($tbl_orderdetail->PCS->getPlaceHolder()) ?>" value="<?php echo $tbl_orderdetail->PCS->EditValue ?>"<?php echo $tbl_orderdetail->PCS->editAttributes() ?>>
</span>
<input type="hidden" data-table="tbl_orderdetail" data-field="x_PCS" name="o<?php echo $tbl_orderdetail_grid->RowIndex ?>_PCS" id="o<?php echo $tbl_orderdetail_grid->RowIndex ?>_PCS" value="<?php echo HtmlEncode($tbl_orderdetail->PCS->OldValue) ?>">
<?php } ?>
<?php if ($tbl_orderdetail->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $tbl_orderdetail_grid->RowCnt ?>_tbl_orderdetail_PCS" class="form-group tbl_orderdetail_PCS">
<input type="text" data-table="tbl_orderdetail" data-field="x_PCS" name="x<?php echo $tbl_orderdetail_grid->RowIndex ?>_PCS" id="x<?php echo $tbl_orderdetail_grid->RowIndex ?>_PCS" size="5" placeholder="<?php echo HtmlEncode($tbl_orderdetail->PCS->getPlaceHolder()) ?>" value="<?php echo $tbl_orderdetail->PCS->EditValue ?>"<?php echo $tbl_orderdetail->PCS->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($tbl_orderdetail->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $tbl_orderdetail_grid->RowCnt ?>_tbl_orderdetail_PCS" class="tbl_orderdetail_PCS">
<span<?php echo $tbl_orderdetail->PCS->viewAttributes() ?>>
<?php echo $tbl_orderdetail->PCS->getViewValue() ?></span>
</span>
<?php if (!$tbl_orderdetail->isConfirm()) { ?>
<input type="hidden" data-table="tbl_orderdetail" data-field="x_PCS" name="x<?php echo $tbl_orderdetail_grid->RowIndex ?>_PCS" id="x<?php echo $tbl_orderdetail_grid->RowIndex ?>_PCS" value="<?php echo HtmlEncode($tbl_orderdetail->PCS->FormValue) ?>">
<input type="hidden" data-table="tbl_orderdetail" data-field="x_PCS" name="o<?php echo $tbl_orderdetail_grid->RowIndex ?>_PCS" id="o<?php echo $tbl_orderdetail_grid->RowIndex ?>_PCS" value="<?php echo HtmlEncode($tbl_orderdetail->PCS->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="tbl_orderdetail" data-field="x_PCS" name="ftbl_orderdetailgrid$x<?php echo $tbl_orderdetail_grid->RowIndex ?>_PCS" id="ftbl_orderdetailgrid$x<?php echo $tbl_orderdetail_grid->RowIndex ?>_PCS" value="<?php echo HtmlEncode($tbl_orderdetail->PCS->FormValue) ?>">
<input type="hidden" data-table="tbl_orderdetail" data-field="x_PCS" name="ftbl_orderdetailgrid$o<?php echo $tbl_orderdetail_grid->RowIndex ?>_PCS" id="ftbl_orderdetailgrid$o<?php echo $tbl_orderdetail_grid->RowIndex ?>_PCS" value="<?php echo HtmlEncode($tbl_orderdetail->PCS->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$tbl_orderdetail_grid->ListOptions->render("body", "right", $tbl_orderdetail_grid->RowCnt);
?>
	</tr>
<?php if ($tbl_orderdetail->RowType == ROWTYPE_ADD || $tbl_orderdetail->RowType == ROWTYPE_EDIT) { ?>
<script>
ftbl_orderdetailgrid.updateLists(<?php echo $tbl_orderdetail_grid->RowIndex ?>);
</script>
<?php } ?>
<?php
	}
	} // End delete row checking
	if (!$tbl_orderdetail->isGridAdd() || $tbl_orderdetail->CurrentMode == "copy")
		if (!$tbl_orderdetail_grid->Recordset->EOF)
			$tbl_orderdetail_grid->Recordset->moveNext();
}
?>
<?php
	if ($tbl_orderdetail->CurrentMode == "add" || $tbl_orderdetail->CurrentMode == "copy" || $tbl_orderdetail->CurrentMode == "edit") {
		$tbl_orderdetail_grid->RowIndex = '$rowindex$';
		$tbl_orderdetail_grid->loadRowValues();

		// Set row properties
		$tbl_orderdetail->resetAttributes();
		$tbl_orderdetail->RowAttrs = array_merge($tbl_orderdetail->RowAttrs, array('data-rowindex'=>$tbl_orderdetail_grid->RowIndex, 'id'=>'r0_tbl_orderdetail', 'data-rowtype'=>ROWTYPE_ADD));
		AppendClass($tbl_orderdetail->RowAttrs["class"], "ew-template");
		$tbl_orderdetail->RowType = ROWTYPE_ADD;

		// Render row
		$tbl_orderdetail_grid->renderRow();

		// Render list options
		$tbl_orderdetail_grid->renderListOptions();
		$tbl_orderdetail_grid->StartRowCnt = 0;
?>
	<tr<?php echo $tbl_orderdetail->rowAttributes() ?>>
<?php

// Render list options (body, left)
$tbl_orderdetail_grid->ListOptions->render("body", "left", $tbl_orderdetail_grid->RowIndex);
?>
	<?php if ($tbl_orderdetail->Code->Visible) { // Code ?>
		<td data-name="Code">
<?php if (!$tbl_orderdetail->isConfirm()) { ?>
<span id="el$rowindex$_tbl_orderdetail_Code" class="form-group tbl_orderdetail_Code">
<?php
$wrkonchange = "ew.autoFill(this);" . trim(@$tbl_orderdetail->Code->EditAttrs["onchange"]);
if (trim($wrkonchange) <> "") $wrkonchange = " onchange=\"" . JsEncode($wrkonchange) . "\"";
$tbl_orderdetail->Code->EditAttrs["onchange"] = "";
?>
<span id="as_x<?php echo $tbl_orderdetail_grid->RowIndex ?>_Code" class="text-nowrap" style="z-index: <?php echo (9000 - $tbl_orderdetail_grid->RowCnt * 10) ?>">
	<input type="text" class="form-control" name="sv_x<?php echo $tbl_orderdetail_grid->RowIndex ?>_Code" id="sv_x<?php echo $tbl_orderdetail_grid->RowIndex ?>_Code" value="<?php echo RemoveHtml($tbl_orderdetail->Code->EditValue) ?>" size="30" placeholder="<?php echo HtmlEncode($tbl_orderdetail->Code->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($tbl_orderdetail->Code->getPlaceHolder()) ?>"<?php echo $tbl_orderdetail->Code->editAttributes() ?>>
</span>
<input type="hidden" data-table="tbl_orderdetail" data-field="x_Code" data-value-separator="<?php echo $tbl_orderdetail->Code->displayValueSeparatorAttribute() ?>" name="x<?php echo $tbl_orderdetail_grid->RowIndex ?>_Code" id="x<?php echo $tbl_orderdetail_grid->RowIndex ?>_Code" value="<?php echo HtmlEncode($tbl_orderdetail->Code->CurrentValue) ?>"<?php echo $wrkonchange ?>>
<script>
ftbl_orderdetailgrid.createAutoSuggest({"id":"x<?php echo $tbl_orderdetail_grid->RowIndex ?>_Code","forceSelect":true});
</script>
<?php echo $tbl_orderdetail->Code->Lookup->getParamTag("p_x" . $tbl_orderdetail_grid->RowIndex . "_Code") ?>
</span>
<?php } else { ?>
<span id="el$rowindex$_tbl_orderdetail_Code" class="form-group tbl_orderdetail_Code">
<span<?php echo $tbl_orderdetail->Code->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?php echo RemoveHtml($tbl_orderdetail->Code->ViewValue) ?>"></span>
</span>
<input type="hidden" data-table="tbl_orderdetail" data-field="x_Code" name="x<?php echo $tbl_orderdetail_grid->RowIndex ?>_Code" id="x<?php echo $tbl_orderdetail_grid->RowIndex ?>_Code" value="<?php echo HtmlEncode($tbl_orderdetail->Code->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="tbl_orderdetail" data-field="x_Code" name="o<?php echo $tbl_orderdetail_grid->RowIndex ?>_Code" id="o<?php echo $tbl_orderdetail_grid->RowIndex ?>_Code" value="<?php echo HtmlEncode($tbl_orderdetail->Code->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($tbl_orderdetail->PCS->Visible) { // PCS ?>
		<td data-name="PCS">
<?php if (!$tbl_orderdetail->isConfirm()) { ?>
<span id="el$rowindex$_tbl_orderdetail_PCS" class="form-group tbl_orderdetail_PCS">
<input type="text" data-table="tbl_orderdetail" data-field="x_PCS" name="x<?php echo $tbl_orderdetail_grid->RowIndex ?>_PCS" id="x<?php echo $tbl_orderdetail_grid->RowIndex ?>_PCS" size="5" placeholder="<?php echo HtmlEncode($tbl_orderdetail->PCS->getPlaceHolder()) ?>" value="<?php echo $tbl_orderdetail->PCS->EditValue ?>"<?php echo $tbl_orderdetail->PCS->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_tbl_orderdetail_PCS" class="form-group tbl_orderdetail_PCS">
<span<?php echo $tbl_orderdetail->PCS->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?php echo RemoveHtml($tbl_orderdetail->PCS->ViewValue) ?>"></span>
</span>
<input type="hidden" data-table="tbl_orderdetail" data-field="x_PCS" name="x<?php echo $tbl_orderdetail_grid->RowIndex ?>_PCS" id="x<?php echo $tbl_orderdetail_grid->RowIndex ?>_PCS" value="<?php echo HtmlEncode($tbl_orderdetail->PCS->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="tbl_orderdetail" data-field="x_PCS" name="o<?php echo $tbl_orderdetail_grid->RowIndex ?>_PCS" id="o<?php echo $tbl_orderdetail_grid->RowIndex ?>_PCS" value="<?php echo HtmlEncode($tbl_orderdetail->PCS->OldValue) ?>">
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$tbl_orderdetail_grid->ListOptions->render("body", "right", $tbl_orderdetail_grid->RowIndex);
?>
<script>
ftbl_orderdetailgrid.updateLists(<?php echo $tbl_orderdetail_grid->RowIndex ?>);
</script>
	</tr>
<?php
}
?>
</tbody>
</table><!-- /.ew-table -->
<?php if ($tbl_orderdetail->CurrentMode == "add" || $tbl_orderdetail->CurrentMode == "copy") { ?>
<input type="hidden" name="<?php echo $tbl_orderdetail_grid->FormKeyCountName ?>" id="<?php echo $tbl_orderdetail_grid->FormKeyCountName ?>" value="<?php echo $tbl_orderdetail_grid->KeyCount ?>">
<?php echo $tbl_orderdetail_grid->MultiSelectKey ?>
<?php } ?>
<?php if ($tbl_orderdetail->CurrentMode == "edit") { ?>
<input type="hidden" name="<?php echo $tbl_orderdetail_grid->FormKeyCountName ?>" id="<?php echo $tbl_orderdetail_grid->FormKeyCountName ?>" value="<?php echo $tbl_orderdetail_grid->KeyCount ?>">
<?php echo $tbl_orderdetail_grid->MultiSelectKey ?>
<?php } ?>
<?php if ($tbl_orderdetail->CurrentMode == "") { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
<input type="hidden" name="detailpage" value="ftbl_orderdetailgrid">
</div><!-- /.ew-grid-middle-panel -->
<?php

// Close recordset
if ($tbl_orderdetail_grid->Recordset)
	$tbl_orderdetail_grid->Recordset->Close();
?>
</div>
<?php if ($tbl_orderdetail_grid->ShowOtherOptions) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php $tbl_orderdetail_grid->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($tbl_orderdetail_grid->TotalRecs == 0 && !$tbl_orderdetail->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $tbl_orderdetail_grid->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$tbl_orderdetail_grid->terminate();
?>