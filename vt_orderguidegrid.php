<?php
namespace PHPMaker2019\asgbn_wh;

// Write header
WriteHeader(FALSE);

// Create page object
if (!isset($vt_orderguide_grid))
	$vt_orderguide_grid = new vt_orderguide_grid();

// Run the page
$vt_orderguide_grid->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$vt_orderguide_grid->Page_Render();
?>
<?php if (!$vt_orderguide->isExport()) { ?>
<script>

// Form object
var fvt_orderguidegrid = new ew.Form("fvt_orderguidegrid", "grid");
fvt_orderguidegrid.formKeyCountName = '<?php echo $vt_orderguide_grid->FormKeyCountName ?>';

// Validate form
fvt_orderguidegrid.validate = function() {
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
		<?php if ($vt_orderguide_grid->Code->Required) { ?>
			elm = this.getElements("x" + infix + "_Code");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $vt_orderguide->Code->caption(), $vt_orderguide->Code->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($vt_orderguide_grid->ProductName->Required) { ?>
			elm = this.getElements("x" + infix + "_ProductName");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $vt_orderguide->ProductName->caption(), $vt_orderguide->ProductName->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($vt_orderguide_grid->PCS->Required) { ?>
			elm = this.getElements("x" + infix + "_PCS");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $vt_orderguide->PCS->caption(), $vt_orderguide->PCS->RequiredErrorMessage)) ?>");
		<?php } ?>
			elm = this.getElements("x" + infix + "_PCS");
			if (elm && !ew.checkInteger(elm.value))
				return this.onError(elm, "<?php echo JsEncode($vt_orderguide->PCS->errorMessage()) ?>");
		<?php if ($vt_orderguide_grid->Location->Required) { ?>
			elm = this.getElements("x" + infix + "_Location");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $vt_orderguide->Location->caption(), $vt_orderguide->Location->RequiredErrorMessage)) ?>");
		<?php } ?>

			// Fire Form_CustomValidate event
			if (!this.Form_CustomValidate(fobj))
				return false;
		} // End Grid Add checking
	}
	return true;
}

// Check empty row
fvt_orderguidegrid.emptyRow = function(infix) {
	var fobj = this._form;
	if (ew.valueChanged(fobj, infix, "Code", false)) return false;
	if (ew.valueChanged(fobj, infix, "ProductName", false)) return false;
	if (ew.valueChanged(fobj, infix, "PCS", false)) return false;
	if (ew.valueChanged(fobj, infix, "Location", false)) return false;
	return true;
}

// Form_CustomValidate event
fvt_orderguidegrid.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

	// Your custom validation code here, return false if invalid.
	return true;
}

// Use JavaScript validation or not
fvt_orderguidegrid.validateRequired = <?php echo json_encode(CLIENT_VALIDATE) ?>;

// Dynamic selection lists
// Form object for search

</script>
<?php } ?>
<?php
$vt_orderguide_grid->renderOtherOptions();
?>
<?php $vt_orderguide_grid->showPageHeader(); ?>
<?php
$vt_orderguide_grid->showMessage();
?>
<?php if ($vt_orderguide_grid->TotalRecs > 0 || $vt_orderguide->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($vt_orderguide_grid->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> vt_orderguide">
<?php if ($vt_orderguide_grid->ShowOtherOptions) { ?>
<div class="card-header ew-grid-upper-panel">
<?php $vt_orderguide_grid->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<div id="fvt_orderguidegrid" class="ew-form ew-list-form form-inline">
<div id="gmp_vt_orderguide" class="<?php if (IsResponsiveLayout()) { ?>table-responsive <?php } ?>card-body ew-grid-middle-panel">
<table id="tbl_vt_orderguidegrid" class="table ew-table"><!-- .ew-table ##-->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$vt_orderguide_grid->RowType = ROWTYPE_HEADER;

// Render list options
$vt_orderguide_grid->renderListOptions();

// Render list options (header, left)
$vt_orderguide_grid->ListOptions->render("header", "left");
?>
<?php if ($vt_orderguide->Code->Visible) { // Code ?>
	<?php if ($vt_orderguide->sortUrl($vt_orderguide->Code) == "") { ?>
		<th data-name="Code" class="<?php echo $vt_orderguide->Code->headerCellClass() ?>" style="white-space: nowrap;"><div id="elh_vt_orderguide_Code" class="vt_orderguide_Code"><div class="ew-table-header-caption"><?php echo $vt_orderguide->Code->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Code" class="<?php echo $vt_orderguide->Code->headerCellClass() ?>" style="white-space: nowrap;"><div><div id="elh_vt_orderguide_Code" class="vt_orderguide_Code">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $vt_orderguide->Code->caption() ?></span><span class="ew-table-header-sort"><?php if ($vt_orderguide->Code->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($vt_orderguide->Code->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($vt_orderguide->ProductName->Visible) { // ProductName ?>
	<?php if ($vt_orderguide->sortUrl($vt_orderguide->ProductName) == "") { ?>
		<th data-name="ProductName" class="<?php echo $vt_orderguide->ProductName->headerCellClass() ?>" style="white-space: nowrap;"><div id="elh_vt_orderguide_ProductName" class="vt_orderguide_ProductName"><div class="ew-table-header-caption"><?php echo $vt_orderguide->ProductName->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="ProductName" class="<?php echo $vt_orderguide->ProductName->headerCellClass() ?>" style="white-space: nowrap;"><div><div id="elh_vt_orderguide_ProductName" class="vt_orderguide_ProductName">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $vt_orderguide->ProductName->caption() ?></span><span class="ew-table-header-sort"><?php if ($vt_orderguide->ProductName->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($vt_orderguide->ProductName->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($vt_orderguide->PCS->Visible) { // PCS ?>
	<?php if ($vt_orderguide->sortUrl($vt_orderguide->PCS) == "") { ?>
		<th data-name="PCS" class="<?php echo $vt_orderguide->PCS->headerCellClass() ?>" style="white-space: nowrap;"><div id="elh_vt_orderguide_PCS" class="vt_orderguide_PCS"><div class="ew-table-header-caption"><?php echo $vt_orderguide->PCS->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="PCS" class="<?php echo $vt_orderguide->PCS->headerCellClass() ?>" style="white-space: nowrap;"><div><div id="elh_vt_orderguide_PCS" class="vt_orderguide_PCS">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $vt_orderguide->PCS->caption() ?></span><span class="ew-table-header-sort"><?php if ($vt_orderguide->PCS->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($vt_orderguide->PCS->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($vt_orderguide->Location->Visible) { // Location ?>
	<?php if ($vt_orderguide->sortUrl($vt_orderguide->Location) == "") { ?>
		<th data-name="Location" class="<?php echo $vt_orderguide->Location->headerCellClass() ?>" style="white-space: nowrap;"><div id="elh_vt_orderguide_Location" class="vt_orderguide_Location"><div class="ew-table-header-caption"><?php echo $vt_orderguide->Location->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Location" class="<?php echo $vt_orderguide->Location->headerCellClass() ?>" style="white-space: nowrap;"><div><div id="elh_vt_orderguide_Location" class="vt_orderguide_Location">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $vt_orderguide->Location->caption() ?></span><span class="ew-table-header-sort"><?php if ($vt_orderguide->Location->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($vt_orderguide->Location->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$vt_orderguide_grid->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
$vt_orderguide_grid->StartRec = 1;
$vt_orderguide_grid->StopRec = $vt_orderguide_grid->TotalRecs; // Show all records

// Restore number of post back records
if ($CurrentForm && $vt_orderguide_grid->EventCancelled) {
	$CurrentForm->Index = -1;
	if ($CurrentForm->hasValue($vt_orderguide_grid->FormKeyCountName) && ($vt_orderguide->isGridAdd() || $vt_orderguide->isGridEdit() || $vt_orderguide->isConfirm())) {
		$vt_orderguide_grid->KeyCount = $CurrentForm->getValue($vt_orderguide_grid->FormKeyCountName);
		$vt_orderguide_grid->StopRec = $vt_orderguide_grid->StartRec + $vt_orderguide_grid->KeyCount - 1;
	}
}
$vt_orderguide_grid->RecCnt = $vt_orderguide_grid->StartRec - 1;
if ($vt_orderguide_grid->Recordset && !$vt_orderguide_grid->Recordset->EOF) {
	$vt_orderguide_grid->Recordset->moveFirst();
	$selectLimit = $vt_orderguide_grid->UseSelectLimit;
	if (!$selectLimit && $vt_orderguide_grid->StartRec > 1)
		$vt_orderguide_grid->Recordset->move($vt_orderguide_grid->StartRec - 1);
} elseif (!$vt_orderguide->AllowAddDeleteRow && $vt_orderguide_grid->StopRec == 0) {
	$vt_orderguide_grid->StopRec = $vt_orderguide->GridAddRowCount;
}

// Initialize aggregate
$vt_orderguide->RowType = ROWTYPE_AGGREGATEINIT;
$vt_orderguide->resetAttributes();
$vt_orderguide_grid->renderRow();
if ($vt_orderguide->isGridAdd())
	$vt_orderguide_grid->RowIndex = 0;
if ($vt_orderguide->isGridEdit())
	$vt_orderguide_grid->RowIndex = 0;
while ($vt_orderguide_grid->RecCnt < $vt_orderguide_grid->StopRec) {
	$vt_orderguide_grid->RecCnt++;
	if ($vt_orderguide_grid->RecCnt >= $vt_orderguide_grid->StartRec) {
		$vt_orderguide_grid->RowCnt++;
		if ($vt_orderguide->isGridAdd() || $vt_orderguide->isGridEdit() || $vt_orderguide->isConfirm()) {
			$vt_orderguide_grid->RowIndex++;
			$CurrentForm->Index = $vt_orderguide_grid->RowIndex;
			if ($CurrentForm->hasValue($vt_orderguide_grid->FormActionName) && $vt_orderguide_grid->EventCancelled)
				$vt_orderguide_grid->RowAction = strval($CurrentForm->getValue($vt_orderguide_grid->FormActionName));
			elseif ($vt_orderguide->isGridAdd())
				$vt_orderguide_grid->RowAction = "insert";
			else
				$vt_orderguide_grid->RowAction = "";
		}

		// Set up key count
		$vt_orderguide_grid->KeyCount = $vt_orderguide_grid->RowIndex;

		// Init row class and style
		$vt_orderguide->resetAttributes();
		$vt_orderguide->CssClass = "";
		if ($vt_orderguide->isGridAdd()) {
			if ($vt_orderguide->CurrentMode == "copy") {
				$vt_orderguide_grid->loadRowValues($vt_orderguide_grid->Recordset); // Load row values
				$vt_orderguide_grid->setRecordKey($vt_orderguide_grid->RowOldKey, $vt_orderguide_grid->Recordset); // Set old record key
			} else {
				$vt_orderguide_grid->loadRowValues(); // Load default values
				$vt_orderguide_grid->RowOldKey = ""; // Clear old key value
			}
		} else {
			$vt_orderguide_grid->loadRowValues($vt_orderguide_grid->Recordset); // Load row values
		}
		$vt_orderguide->RowType = ROWTYPE_VIEW; // Render view
		if ($vt_orderguide->isGridAdd()) // Grid add
			$vt_orderguide->RowType = ROWTYPE_ADD; // Render add
		if ($vt_orderguide->isGridAdd() && $vt_orderguide->EventCancelled && !$CurrentForm->hasValue("k_blankrow")) // Insert failed
			$vt_orderguide_grid->restoreCurrentRowFormValues($vt_orderguide_grid->RowIndex); // Restore form values
		if ($vt_orderguide->isGridEdit()) { // Grid edit
			if ($vt_orderguide->EventCancelled)
				$vt_orderguide_grid->restoreCurrentRowFormValues($vt_orderguide_grid->RowIndex); // Restore form values
			if ($vt_orderguide_grid->RowAction == "insert")
				$vt_orderguide->RowType = ROWTYPE_ADD; // Render add
			else
				$vt_orderguide->RowType = ROWTYPE_EDIT; // Render edit
		}
		if ($vt_orderguide->isGridEdit() && ($vt_orderguide->RowType == ROWTYPE_EDIT || $vt_orderguide->RowType == ROWTYPE_ADD) && $vt_orderguide->EventCancelled) // Update failed
			$vt_orderguide_grid->restoreCurrentRowFormValues($vt_orderguide_grid->RowIndex); // Restore form values
		if ($vt_orderguide->RowType == ROWTYPE_EDIT) // Edit row
			$vt_orderguide_grid->EditRowCnt++;
		if ($vt_orderguide->isConfirm()) // Confirm row
			$vt_orderguide_grid->restoreCurrentRowFormValues($vt_orderguide_grid->RowIndex); // Restore form values

		// Set up row id / data-rowindex
		$vt_orderguide->RowAttrs = array_merge($vt_orderguide->RowAttrs, array('data-rowindex'=>$vt_orderguide_grid->RowCnt, 'id'=>'r' . $vt_orderguide_grid->RowCnt . '_vt_orderguide', 'data-rowtype'=>$vt_orderguide->RowType));

		// Render row
		$vt_orderguide_grid->renderRow();

		// Render list options
		$vt_orderguide_grid->renderListOptions();

		// Skip delete row / empty row for confirm page
		if ($vt_orderguide_grid->RowAction <> "delete" && $vt_orderguide_grid->RowAction <> "insertdelete" && !($vt_orderguide_grid->RowAction == "insert" && $vt_orderguide->isConfirm() && $vt_orderguide_grid->emptyRow())) {
?>
	<tr<?php echo $vt_orderguide->rowAttributes() ?>>
<?php

// Render list options (body, left)
$vt_orderguide_grid->ListOptions->render("body", "left", $vt_orderguide_grid->RowCnt);
?>
	<?php if ($vt_orderguide->Code->Visible) { // Code ?>
		<td data-name="Code"<?php echo $vt_orderguide->Code->cellAttributes() ?>>
<?php if ($vt_orderguide->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $vt_orderguide_grid->RowCnt ?>_vt_orderguide_Code" class="form-group vt_orderguide_Code">
<input type="text" data-table="vt_orderguide" data-field="x_Code" name="x<?php echo $vt_orderguide_grid->RowIndex ?>_Code" id="x<?php echo $vt_orderguide_grid->RowIndex ?>_Code" size="30" maxlength="50" placeholder="<?php echo HtmlEncode($vt_orderguide->Code->getPlaceHolder()) ?>" value="<?php echo $vt_orderguide->Code->EditValue ?>"<?php echo $vt_orderguide->Code->editAttributes() ?>>
</span>
<input type="hidden" data-table="vt_orderguide" data-field="x_Code" name="o<?php echo $vt_orderguide_grid->RowIndex ?>_Code" id="o<?php echo $vt_orderguide_grid->RowIndex ?>_Code" value="<?php echo HtmlEncode($vt_orderguide->Code->OldValue) ?>">
<?php } ?>
<?php if ($vt_orderguide->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $vt_orderguide_grid->RowCnt ?>_vt_orderguide_Code" class="form-group vt_orderguide_Code">
<input type="text" data-table="vt_orderguide" data-field="x_Code" name="x<?php echo $vt_orderguide_grid->RowIndex ?>_Code" id="x<?php echo $vt_orderguide_grid->RowIndex ?>_Code" size="30" maxlength="50" placeholder="<?php echo HtmlEncode($vt_orderguide->Code->getPlaceHolder()) ?>" value="<?php echo $vt_orderguide->Code->EditValue ?>"<?php echo $vt_orderguide->Code->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($vt_orderguide->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $vt_orderguide_grid->RowCnt ?>_vt_orderguide_Code" class="vt_orderguide_Code">
<span<?php echo $vt_orderguide->Code->viewAttributes() ?>>
<?php echo $vt_orderguide->Code->getViewValue() ?></span>
</span>
<?php if (!$vt_orderguide->isConfirm()) { ?>
<input type="hidden" data-table="vt_orderguide" data-field="x_Code" name="x<?php echo $vt_orderguide_grid->RowIndex ?>_Code" id="x<?php echo $vt_orderguide_grid->RowIndex ?>_Code" value="<?php echo HtmlEncode($vt_orderguide->Code->FormValue) ?>">
<input type="hidden" data-table="vt_orderguide" data-field="x_Code" name="o<?php echo $vt_orderguide_grid->RowIndex ?>_Code" id="o<?php echo $vt_orderguide_grid->RowIndex ?>_Code" value="<?php echo HtmlEncode($vt_orderguide->Code->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="vt_orderguide" data-field="x_Code" name="fvt_orderguidegrid$x<?php echo $vt_orderguide_grid->RowIndex ?>_Code" id="fvt_orderguidegrid$x<?php echo $vt_orderguide_grid->RowIndex ?>_Code" value="<?php echo HtmlEncode($vt_orderguide->Code->FormValue) ?>">
<input type="hidden" data-table="vt_orderguide" data-field="x_Code" name="fvt_orderguidegrid$o<?php echo $vt_orderguide_grid->RowIndex ?>_Code" id="fvt_orderguidegrid$o<?php echo $vt_orderguide_grid->RowIndex ?>_Code" value="<?php echo HtmlEncode($vt_orderguide->Code->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
<?php if ($vt_orderguide->RowType == ROWTYPE_ADD) { // Add record ?>
<input type="hidden" data-table="vt_orderguide" data-field="x_ID_Order" name="x<?php echo $vt_orderguide_grid->RowIndex ?>_ID_Order" id="x<?php echo $vt_orderguide_grid->RowIndex ?>_ID_Order" value="<?php echo HtmlEncode($vt_orderguide->ID_Order->CurrentValue) ?>">
<input type="hidden" data-table="vt_orderguide" data-field="x_ID_Order" name="o<?php echo $vt_orderguide_grid->RowIndex ?>_ID_Order" id="o<?php echo $vt_orderguide_grid->RowIndex ?>_ID_Order" value="<?php echo HtmlEncode($vt_orderguide->ID_Order->OldValue) ?>">
<?php } ?>
<?php if ($vt_orderguide->RowType == ROWTYPE_EDIT || $vt_orderguide->CurrentMode == "edit") { ?>
<input type="hidden" data-table="vt_orderguide" data-field="x_ID_Order" name="x<?php echo $vt_orderguide_grid->RowIndex ?>_ID_Order" id="x<?php echo $vt_orderguide_grid->RowIndex ?>_ID_Order" value="<?php echo HtmlEncode($vt_orderguide->ID_Order->CurrentValue) ?>">
<?php } ?>
	<?php if ($vt_orderguide->ProductName->Visible) { // ProductName ?>
		<td data-name="ProductName"<?php echo $vt_orderguide->ProductName->cellAttributes() ?>>
<?php if ($vt_orderguide->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $vt_orderguide_grid->RowCnt ?>_vt_orderguide_ProductName" class="form-group vt_orderguide_ProductName">
<input type="text" data-table="vt_orderguide" data-field="x_ProductName" name="x<?php echo $vt_orderguide_grid->RowIndex ?>_ProductName" id="x<?php echo $vt_orderguide_grid->RowIndex ?>_ProductName" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($vt_orderguide->ProductName->getPlaceHolder()) ?>" value="<?php echo $vt_orderguide->ProductName->EditValue ?>"<?php echo $vt_orderguide->ProductName->editAttributes() ?>>
</span>
<input type="hidden" data-table="vt_orderguide" data-field="x_ProductName" name="o<?php echo $vt_orderguide_grid->RowIndex ?>_ProductName" id="o<?php echo $vt_orderguide_grid->RowIndex ?>_ProductName" value="<?php echo HtmlEncode($vt_orderguide->ProductName->OldValue) ?>">
<?php } ?>
<?php if ($vt_orderguide->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $vt_orderguide_grid->RowCnt ?>_vt_orderguide_ProductName" class="form-group vt_orderguide_ProductName">
<input type="text" data-table="vt_orderguide" data-field="x_ProductName" name="x<?php echo $vt_orderguide_grid->RowIndex ?>_ProductName" id="x<?php echo $vt_orderguide_grid->RowIndex ?>_ProductName" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($vt_orderguide->ProductName->getPlaceHolder()) ?>" value="<?php echo $vt_orderguide->ProductName->EditValue ?>"<?php echo $vt_orderguide->ProductName->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($vt_orderguide->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $vt_orderguide_grid->RowCnt ?>_vt_orderguide_ProductName" class="vt_orderguide_ProductName">
<span<?php echo $vt_orderguide->ProductName->viewAttributes() ?>>
<?php echo $vt_orderguide->ProductName->getViewValue() ?></span>
</span>
<?php if (!$vt_orderguide->isConfirm()) { ?>
<input type="hidden" data-table="vt_orderguide" data-field="x_ProductName" name="x<?php echo $vt_orderguide_grid->RowIndex ?>_ProductName" id="x<?php echo $vt_orderguide_grid->RowIndex ?>_ProductName" value="<?php echo HtmlEncode($vt_orderguide->ProductName->FormValue) ?>">
<input type="hidden" data-table="vt_orderguide" data-field="x_ProductName" name="o<?php echo $vt_orderguide_grid->RowIndex ?>_ProductName" id="o<?php echo $vt_orderguide_grid->RowIndex ?>_ProductName" value="<?php echo HtmlEncode($vt_orderguide->ProductName->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="vt_orderguide" data-field="x_ProductName" name="fvt_orderguidegrid$x<?php echo $vt_orderguide_grid->RowIndex ?>_ProductName" id="fvt_orderguidegrid$x<?php echo $vt_orderguide_grid->RowIndex ?>_ProductName" value="<?php echo HtmlEncode($vt_orderguide->ProductName->FormValue) ?>">
<input type="hidden" data-table="vt_orderguide" data-field="x_ProductName" name="fvt_orderguidegrid$o<?php echo $vt_orderguide_grid->RowIndex ?>_ProductName" id="fvt_orderguidegrid$o<?php echo $vt_orderguide_grid->RowIndex ?>_ProductName" value="<?php echo HtmlEncode($vt_orderguide->ProductName->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($vt_orderguide->PCS->Visible) { // PCS ?>
		<td data-name="PCS"<?php echo $vt_orderguide->PCS->cellAttributes() ?>>
<?php if ($vt_orderguide->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $vt_orderguide_grid->RowCnt ?>_vt_orderguide_PCS" class="form-group vt_orderguide_PCS">
<input type="text" data-table="vt_orderguide" data-field="x_PCS" name="x<?php echo $vt_orderguide_grid->RowIndex ?>_PCS" id="x<?php echo $vt_orderguide_grid->RowIndex ?>_PCS" size="30" placeholder="<?php echo HtmlEncode($vt_orderguide->PCS->getPlaceHolder()) ?>" value="<?php echo $vt_orderguide->PCS->EditValue ?>"<?php echo $vt_orderguide->PCS->editAttributes() ?>>
</span>
<input type="hidden" data-table="vt_orderguide" data-field="x_PCS" name="o<?php echo $vt_orderguide_grid->RowIndex ?>_PCS" id="o<?php echo $vt_orderguide_grid->RowIndex ?>_PCS" value="<?php echo HtmlEncode($vt_orderguide->PCS->OldValue) ?>">
<?php } ?>
<?php if ($vt_orderguide->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $vt_orderguide_grid->RowCnt ?>_vt_orderguide_PCS" class="form-group vt_orderguide_PCS">
<input type="text" data-table="vt_orderguide" data-field="x_PCS" name="x<?php echo $vt_orderguide_grid->RowIndex ?>_PCS" id="x<?php echo $vt_orderguide_grid->RowIndex ?>_PCS" size="30" placeholder="<?php echo HtmlEncode($vt_orderguide->PCS->getPlaceHolder()) ?>" value="<?php echo $vt_orderguide->PCS->EditValue ?>"<?php echo $vt_orderguide->PCS->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($vt_orderguide->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $vt_orderguide_grid->RowCnt ?>_vt_orderguide_PCS" class="vt_orderguide_PCS">
<span<?php echo $vt_orderguide->PCS->viewAttributes() ?>>
<?php echo $vt_orderguide->PCS->getViewValue() ?></span>
</span>
<?php if (!$vt_orderguide->isConfirm()) { ?>
<input type="hidden" data-table="vt_orderguide" data-field="x_PCS" name="x<?php echo $vt_orderguide_grid->RowIndex ?>_PCS" id="x<?php echo $vt_orderguide_grid->RowIndex ?>_PCS" value="<?php echo HtmlEncode($vt_orderguide->PCS->FormValue) ?>">
<input type="hidden" data-table="vt_orderguide" data-field="x_PCS" name="o<?php echo $vt_orderguide_grid->RowIndex ?>_PCS" id="o<?php echo $vt_orderguide_grid->RowIndex ?>_PCS" value="<?php echo HtmlEncode($vt_orderguide->PCS->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="vt_orderguide" data-field="x_PCS" name="fvt_orderguidegrid$x<?php echo $vt_orderguide_grid->RowIndex ?>_PCS" id="fvt_orderguidegrid$x<?php echo $vt_orderguide_grid->RowIndex ?>_PCS" value="<?php echo HtmlEncode($vt_orderguide->PCS->FormValue) ?>">
<input type="hidden" data-table="vt_orderguide" data-field="x_PCS" name="fvt_orderguidegrid$o<?php echo $vt_orderguide_grid->RowIndex ?>_PCS" id="fvt_orderguidegrid$o<?php echo $vt_orderguide_grid->RowIndex ?>_PCS" value="<?php echo HtmlEncode($vt_orderguide->PCS->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($vt_orderguide->Location->Visible) { // Location ?>
		<td data-name="Location"<?php echo $vt_orderguide->Location->cellAttributes() ?>>
<?php if ($vt_orderguide->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $vt_orderguide_grid->RowCnt ?>_vt_orderguide_Location" class="form-group vt_orderguide_Location">
<input type="text" data-table="vt_orderguide" data-field="x_Location" name="x<?php echo $vt_orderguide_grid->RowIndex ?>_Location" id="x<?php echo $vt_orderguide_grid->RowIndex ?>_Location" size="30" maxlength="55" placeholder="<?php echo HtmlEncode($vt_orderguide->Location->getPlaceHolder()) ?>" value="<?php echo $vt_orderguide->Location->EditValue ?>"<?php echo $vt_orderguide->Location->editAttributes() ?>>
</span>
<input type="hidden" data-table="vt_orderguide" data-field="x_Location" name="o<?php echo $vt_orderguide_grid->RowIndex ?>_Location" id="o<?php echo $vt_orderguide_grid->RowIndex ?>_Location" value="<?php echo HtmlEncode($vt_orderguide->Location->OldValue) ?>">
<?php } ?>
<?php if ($vt_orderguide->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $vt_orderguide_grid->RowCnt ?>_vt_orderguide_Location" class="form-group vt_orderguide_Location">
<input type="text" data-table="vt_orderguide" data-field="x_Location" name="x<?php echo $vt_orderguide_grid->RowIndex ?>_Location" id="x<?php echo $vt_orderguide_grid->RowIndex ?>_Location" size="30" maxlength="55" placeholder="<?php echo HtmlEncode($vt_orderguide->Location->getPlaceHolder()) ?>" value="<?php echo $vt_orderguide->Location->EditValue ?>"<?php echo $vt_orderguide->Location->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($vt_orderguide->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $vt_orderguide_grid->RowCnt ?>_vt_orderguide_Location" class="vt_orderguide_Location">
<span<?php echo $vt_orderguide->Location->viewAttributes() ?>>
<?php echo $vt_orderguide->Location->getViewValue() ?></span>
</span>
<?php if (!$vt_orderguide->isConfirm()) { ?>
<input type="hidden" data-table="vt_orderguide" data-field="x_Location" name="x<?php echo $vt_orderguide_grid->RowIndex ?>_Location" id="x<?php echo $vt_orderguide_grid->RowIndex ?>_Location" value="<?php echo HtmlEncode($vt_orderguide->Location->FormValue) ?>">
<input type="hidden" data-table="vt_orderguide" data-field="x_Location" name="o<?php echo $vt_orderguide_grid->RowIndex ?>_Location" id="o<?php echo $vt_orderguide_grid->RowIndex ?>_Location" value="<?php echo HtmlEncode($vt_orderguide->Location->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="vt_orderguide" data-field="x_Location" name="fvt_orderguidegrid$x<?php echo $vt_orderguide_grid->RowIndex ?>_Location" id="fvt_orderguidegrid$x<?php echo $vt_orderguide_grid->RowIndex ?>_Location" value="<?php echo HtmlEncode($vt_orderguide->Location->FormValue) ?>">
<input type="hidden" data-table="vt_orderguide" data-field="x_Location" name="fvt_orderguidegrid$o<?php echo $vt_orderguide_grid->RowIndex ?>_Location" id="fvt_orderguidegrid$o<?php echo $vt_orderguide_grid->RowIndex ?>_Location" value="<?php echo HtmlEncode($vt_orderguide->Location->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$vt_orderguide_grid->ListOptions->render("body", "right", $vt_orderguide_grid->RowCnt);
?>
	</tr>
<?php if ($vt_orderguide->RowType == ROWTYPE_ADD || $vt_orderguide->RowType == ROWTYPE_EDIT) { ?>
<script>
fvt_orderguidegrid.updateLists(<?php echo $vt_orderguide_grid->RowIndex ?>);
</script>
<?php } ?>
<?php
	}
	} // End delete row checking
	if (!$vt_orderguide->isGridAdd() || $vt_orderguide->CurrentMode == "copy")
		if (!$vt_orderguide_grid->Recordset->EOF)
			$vt_orderguide_grid->Recordset->moveNext();
}
?>
<?php
	if ($vt_orderguide->CurrentMode == "add" || $vt_orderguide->CurrentMode == "copy" || $vt_orderguide->CurrentMode == "edit") {
		$vt_orderguide_grid->RowIndex = '$rowindex$';
		$vt_orderguide_grid->loadRowValues();

		// Set row properties
		$vt_orderguide->resetAttributes();
		$vt_orderguide->RowAttrs = array_merge($vt_orderguide->RowAttrs, array('data-rowindex'=>$vt_orderguide_grid->RowIndex, 'id'=>'r0_vt_orderguide', 'data-rowtype'=>ROWTYPE_ADD));
		AppendClass($vt_orderguide->RowAttrs["class"], "ew-template");
		$vt_orderguide->RowType = ROWTYPE_ADD;

		// Render row
		$vt_orderguide_grid->renderRow();

		// Render list options
		$vt_orderguide_grid->renderListOptions();
		$vt_orderguide_grid->StartRowCnt = 0;
?>
	<tr<?php echo $vt_orderguide->rowAttributes() ?>>
<?php

// Render list options (body, left)
$vt_orderguide_grid->ListOptions->render("body", "left", $vt_orderguide_grid->RowIndex);
?>
	<?php if ($vt_orderguide->Code->Visible) { // Code ?>
		<td data-name="Code">
<?php if (!$vt_orderguide->isConfirm()) { ?>
<span id="el$rowindex$_vt_orderguide_Code" class="form-group vt_orderguide_Code">
<input type="text" data-table="vt_orderguide" data-field="x_Code" name="x<?php echo $vt_orderguide_grid->RowIndex ?>_Code" id="x<?php echo $vt_orderguide_grid->RowIndex ?>_Code" size="30" maxlength="50" placeholder="<?php echo HtmlEncode($vt_orderguide->Code->getPlaceHolder()) ?>" value="<?php echo $vt_orderguide->Code->EditValue ?>"<?php echo $vt_orderguide->Code->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_vt_orderguide_Code" class="form-group vt_orderguide_Code">
<span<?php echo $vt_orderguide->Code->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?php echo RemoveHtml($vt_orderguide->Code->ViewValue) ?>"></span>
</span>
<input type="hidden" data-table="vt_orderguide" data-field="x_Code" name="x<?php echo $vt_orderguide_grid->RowIndex ?>_Code" id="x<?php echo $vt_orderguide_grid->RowIndex ?>_Code" value="<?php echo HtmlEncode($vt_orderguide->Code->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="vt_orderguide" data-field="x_Code" name="o<?php echo $vt_orderguide_grid->RowIndex ?>_Code" id="o<?php echo $vt_orderguide_grid->RowIndex ?>_Code" value="<?php echo HtmlEncode($vt_orderguide->Code->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($vt_orderguide->ProductName->Visible) { // ProductName ?>
		<td data-name="ProductName">
<?php if (!$vt_orderguide->isConfirm()) { ?>
<span id="el$rowindex$_vt_orderguide_ProductName" class="form-group vt_orderguide_ProductName">
<input type="text" data-table="vt_orderguide" data-field="x_ProductName" name="x<?php echo $vt_orderguide_grid->RowIndex ?>_ProductName" id="x<?php echo $vt_orderguide_grid->RowIndex ?>_ProductName" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($vt_orderguide->ProductName->getPlaceHolder()) ?>" value="<?php echo $vt_orderguide->ProductName->EditValue ?>"<?php echo $vt_orderguide->ProductName->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_vt_orderguide_ProductName" class="form-group vt_orderguide_ProductName">
<span<?php echo $vt_orderguide->ProductName->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?php echo RemoveHtml($vt_orderguide->ProductName->ViewValue) ?>"></span>
</span>
<input type="hidden" data-table="vt_orderguide" data-field="x_ProductName" name="x<?php echo $vt_orderguide_grid->RowIndex ?>_ProductName" id="x<?php echo $vt_orderguide_grid->RowIndex ?>_ProductName" value="<?php echo HtmlEncode($vt_orderguide->ProductName->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="vt_orderguide" data-field="x_ProductName" name="o<?php echo $vt_orderguide_grid->RowIndex ?>_ProductName" id="o<?php echo $vt_orderguide_grid->RowIndex ?>_ProductName" value="<?php echo HtmlEncode($vt_orderguide->ProductName->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($vt_orderguide->PCS->Visible) { // PCS ?>
		<td data-name="PCS">
<?php if (!$vt_orderguide->isConfirm()) { ?>
<span id="el$rowindex$_vt_orderguide_PCS" class="form-group vt_orderguide_PCS">
<input type="text" data-table="vt_orderguide" data-field="x_PCS" name="x<?php echo $vt_orderguide_grid->RowIndex ?>_PCS" id="x<?php echo $vt_orderguide_grid->RowIndex ?>_PCS" size="30" placeholder="<?php echo HtmlEncode($vt_orderguide->PCS->getPlaceHolder()) ?>" value="<?php echo $vt_orderguide->PCS->EditValue ?>"<?php echo $vt_orderguide->PCS->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_vt_orderguide_PCS" class="form-group vt_orderguide_PCS">
<span<?php echo $vt_orderguide->PCS->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?php echo RemoveHtml($vt_orderguide->PCS->ViewValue) ?>"></span>
</span>
<input type="hidden" data-table="vt_orderguide" data-field="x_PCS" name="x<?php echo $vt_orderguide_grid->RowIndex ?>_PCS" id="x<?php echo $vt_orderguide_grid->RowIndex ?>_PCS" value="<?php echo HtmlEncode($vt_orderguide->PCS->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="vt_orderguide" data-field="x_PCS" name="o<?php echo $vt_orderguide_grid->RowIndex ?>_PCS" id="o<?php echo $vt_orderguide_grid->RowIndex ?>_PCS" value="<?php echo HtmlEncode($vt_orderguide->PCS->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($vt_orderguide->Location->Visible) { // Location ?>
		<td data-name="Location">
<?php if (!$vt_orderguide->isConfirm()) { ?>
<span id="el$rowindex$_vt_orderguide_Location" class="form-group vt_orderguide_Location">
<input type="text" data-table="vt_orderguide" data-field="x_Location" name="x<?php echo $vt_orderguide_grid->RowIndex ?>_Location" id="x<?php echo $vt_orderguide_grid->RowIndex ?>_Location" size="30" maxlength="55" placeholder="<?php echo HtmlEncode($vt_orderguide->Location->getPlaceHolder()) ?>" value="<?php echo $vt_orderguide->Location->EditValue ?>"<?php echo $vt_orderguide->Location->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_vt_orderguide_Location" class="form-group vt_orderguide_Location">
<span<?php echo $vt_orderguide->Location->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?php echo RemoveHtml($vt_orderguide->Location->ViewValue) ?>"></span>
</span>
<input type="hidden" data-table="vt_orderguide" data-field="x_Location" name="x<?php echo $vt_orderguide_grid->RowIndex ?>_Location" id="x<?php echo $vt_orderguide_grid->RowIndex ?>_Location" value="<?php echo HtmlEncode($vt_orderguide->Location->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="vt_orderguide" data-field="x_Location" name="o<?php echo $vt_orderguide_grid->RowIndex ?>_Location" id="o<?php echo $vt_orderguide_grid->RowIndex ?>_Location" value="<?php echo HtmlEncode($vt_orderguide->Location->OldValue) ?>">
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$vt_orderguide_grid->ListOptions->render("body", "right", $vt_orderguide_grid->RowIndex);
?>
<script>
fvt_orderguidegrid.updateLists(<?php echo $vt_orderguide_grid->RowIndex ?>);
</script>
	</tr>
<?php
}
?>
</tbody>
</table><!-- /.ew-table -->
<?php if ($vt_orderguide->CurrentMode == "add" || $vt_orderguide->CurrentMode == "copy") { ?>
<input type="hidden" name="<?php echo $vt_orderguide_grid->FormKeyCountName ?>" id="<?php echo $vt_orderguide_grid->FormKeyCountName ?>" value="<?php echo $vt_orderguide_grid->KeyCount ?>">
<?php echo $vt_orderguide_grid->MultiSelectKey ?>
<?php } ?>
<?php if ($vt_orderguide->CurrentMode == "edit") { ?>
<input type="hidden" name="<?php echo $vt_orderguide_grid->FormKeyCountName ?>" id="<?php echo $vt_orderguide_grid->FormKeyCountName ?>" value="<?php echo $vt_orderguide_grid->KeyCount ?>">
<?php echo $vt_orderguide_grid->MultiSelectKey ?>
<?php } ?>
<?php if ($vt_orderguide->CurrentMode == "") { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
<input type="hidden" name="detailpage" value="fvt_orderguidegrid">
</div><!-- /.ew-grid-middle-panel -->
<?php

// Close recordset
if ($vt_orderguide_grid->Recordset)
	$vt_orderguide_grid->Recordset->Close();
?>
</div>
<?php if ($vt_orderguide_grid->ShowOtherOptions) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php $vt_orderguide_grid->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($vt_orderguide_grid->TotalRecs == 0 && !$vt_orderguide->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $vt_orderguide_grid->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$vt_orderguide_grid->terminate();
?>