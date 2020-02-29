<?php
namespace PHPMaker2019\asgbn_wh;

// Write header
WriteHeader(FALSE);

// Create page object
if (!isset($vworderdetail_grid))
	$vworderdetail_grid = new vworderdetail_grid();

// Run the page
$vworderdetail_grid->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$vworderdetail_grid->Page_Render();
?>
<?php if (!$vworderdetail->isExport()) { ?>
<script>

// Form object
var fvworderdetailgrid = new ew.Form("fvworderdetailgrid", "grid");
fvworderdetailgrid.formKeyCountName = '<?php echo $vworderdetail_grid->FormKeyCountName ?>';

// Validate form
fvworderdetailgrid.validate = function() {
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
		<?php if ($vworderdetail_grid->Code->Required) { ?>
			elm = this.getElements("x" + infix + "_Code");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $vworderdetail->Code->caption(), $vworderdetail->Code->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($vworderdetail_grid->PCS->Required) { ?>
			elm = this.getElements("x" + infix + "_PCS");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $vworderdetail->PCS->caption(), $vworderdetail->PCS->RequiredErrorMessage)) ?>");
		<?php } ?>
			elm = this.getElements("x" + infix + "_PCS");
			if (elm && !ew.checkInteger(elm.value))
				return this.onError(elm, "<?php echo JsEncode($vworderdetail->PCS->errorMessage()) ?>");
		<?php if ($vworderdetail_grid->StatusPickUp->Required) { ?>
			elm = this.getElements("x" + infix + "_StatusPickUp");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $vworderdetail->StatusPickUp->caption(), $vworderdetail->StatusPickUp->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($vworderdetail_grid->CreateUser->Required) { ?>
			elm = this.getElements("x" + infix + "_CreateUser");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $vworderdetail->CreateUser->caption(), $vworderdetail->CreateUser->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($vworderdetail_grid->CreateDate->Required) { ?>
			elm = this.getElements("x" + infix + "_CreateDate");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $vworderdetail->CreateDate->caption(), $vworderdetail->CreateDate->RequiredErrorMessage)) ?>");
		<?php } ?>

			// Fire Form_CustomValidate event
			if (!this.Form_CustomValidate(fobj))
				return false;
		} // End Grid Add checking
	}
	return true;
}

// Check empty row
fvworderdetailgrid.emptyRow = function(infix) {
	var fobj = this._form;
	if (ew.valueChanged(fobj, infix, "Code", false)) return false;
	if (ew.valueChanged(fobj, infix, "PCS", false)) return false;
	if (ew.valueChanged(fobj, infix, "StatusPickUp", false)) return false;
	return true;
}

// Form_CustomValidate event
fvworderdetailgrid.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

	// Your custom validation code here, return false if invalid.
	return true;
}

// Use JavaScript validation or not
fvworderdetailgrid.validateRequired = <?php echo json_encode(CLIENT_VALIDATE) ?>;

// Dynamic selection lists
fvworderdetailgrid.lists["x_StatusPickUp"] = <?php echo $vworderdetail_grid->StatusPickUp->Lookup->toClientList() ?>;
fvworderdetailgrid.lists["x_StatusPickUp"].options = <?php echo JsonEncode($vworderdetail_grid->StatusPickUp->options(FALSE, TRUE)) ?>;

// Form object for search
</script>
<?php } ?>
<?php
$vworderdetail_grid->renderOtherOptions();
?>
<?php $vworderdetail_grid->showPageHeader(); ?>
<?php
$vworderdetail_grid->showMessage();
?>
<?php if ($vworderdetail_grid->TotalRecs > 0 || $vworderdetail->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($vworderdetail_grid->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> vworderdetail">
<?php if ($vworderdetail_grid->ShowOtherOptions) { ?>
<div class="card-header ew-grid-upper-panel">
<?php $vworderdetail_grid->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<div id="fvworderdetailgrid" class="ew-form ew-list-form form-inline">
<div id="gmp_vworderdetail" class="<?php if (IsResponsiveLayout()) { ?>table-responsive <?php } ?>card-body ew-grid-middle-panel">
<table id="tbl_vworderdetailgrid" class="table ew-table"><!-- .ew-table ##-->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$vworderdetail_grid->RowType = ROWTYPE_HEADER;

// Render list options
$vworderdetail_grid->renderListOptions();

// Render list options (header, left)
$vworderdetail_grid->ListOptions->render("header", "left");
?>
<?php if ($vworderdetail->Code->Visible) { // Code ?>
	<?php if ($vworderdetail->sortUrl($vworderdetail->Code) == "") { ?>
		<th data-name="Code" class="<?php echo $vworderdetail->Code->headerCellClass() ?>" style="white-space: nowrap;"><div id="elh_vworderdetail_Code" class="vworderdetail_Code"><div class="ew-table-header-caption"><?php echo $vworderdetail->Code->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Code" class="<?php echo $vworderdetail->Code->headerCellClass() ?>" style="white-space: nowrap;"><div><div id="elh_vworderdetail_Code" class="vworderdetail_Code">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $vworderdetail->Code->caption() ?></span><span class="ew-table-header-sort"><?php if ($vworderdetail->Code->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($vworderdetail->Code->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($vworderdetail->PCS->Visible) { // PCS ?>
	<?php if ($vworderdetail->sortUrl($vworderdetail->PCS) == "") { ?>
		<th data-name="PCS" class="<?php echo $vworderdetail->PCS->headerCellClass() ?>" style="white-space: nowrap;"><div id="elh_vworderdetail_PCS" class="vworderdetail_PCS"><div class="ew-table-header-caption"><?php echo $vworderdetail->PCS->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="PCS" class="<?php echo $vworderdetail->PCS->headerCellClass() ?>" style="white-space: nowrap;"><div><div id="elh_vworderdetail_PCS" class="vworderdetail_PCS">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $vworderdetail->PCS->caption() ?></span><span class="ew-table-header-sort"><?php if ($vworderdetail->PCS->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($vworderdetail->PCS->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($vworderdetail->StatusPickUp->Visible) { // StatusPickUp ?>
	<?php if ($vworderdetail->sortUrl($vworderdetail->StatusPickUp) == "") { ?>
		<th data-name="StatusPickUp" class="<?php echo $vworderdetail->StatusPickUp->headerCellClass() ?>" style="white-space: nowrap;"><div id="elh_vworderdetail_StatusPickUp" class="vworderdetail_StatusPickUp"><div class="ew-table-header-caption"><?php echo $vworderdetail->StatusPickUp->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="StatusPickUp" class="<?php echo $vworderdetail->StatusPickUp->headerCellClass() ?>" style="white-space: nowrap;"><div><div id="elh_vworderdetail_StatusPickUp" class="vworderdetail_StatusPickUp">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $vworderdetail->StatusPickUp->caption() ?></span><span class="ew-table-header-sort"><?php if ($vworderdetail->StatusPickUp->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($vworderdetail->StatusPickUp->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($vworderdetail->CreateUser->Visible) { // CreateUser ?>
	<?php if ($vworderdetail->sortUrl($vworderdetail->CreateUser) == "") { ?>
		<th data-name="CreateUser" class="<?php echo $vworderdetail->CreateUser->headerCellClass() ?>" style="white-space: nowrap;"><div id="elh_vworderdetail_CreateUser" class="vworderdetail_CreateUser"><div class="ew-table-header-caption"><?php echo $vworderdetail->CreateUser->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="CreateUser" class="<?php echo $vworderdetail->CreateUser->headerCellClass() ?>" style="white-space: nowrap;"><div><div id="elh_vworderdetail_CreateUser" class="vworderdetail_CreateUser">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $vworderdetail->CreateUser->caption() ?></span><span class="ew-table-header-sort"><?php if ($vworderdetail->CreateUser->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($vworderdetail->CreateUser->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($vworderdetail->CreateDate->Visible) { // CreateDate ?>
	<?php if ($vworderdetail->sortUrl($vworderdetail->CreateDate) == "") { ?>
		<th data-name="CreateDate" class="<?php echo $vworderdetail->CreateDate->headerCellClass() ?>" style="white-space: nowrap;"><div id="elh_vworderdetail_CreateDate" class="vworderdetail_CreateDate"><div class="ew-table-header-caption"><?php echo $vworderdetail->CreateDate->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="CreateDate" class="<?php echo $vworderdetail->CreateDate->headerCellClass() ?>" style="white-space: nowrap;"><div><div id="elh_vworderdetail_CreateDate" class="vworderdetail_CreateDate">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $vworderdetail->CreateDate->caption() ?></span><span class="ew-table-header-sort"><?php if ($vworderdetail->CreateDate->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($vworderdetail->CreateDate->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$vworderdetail_grid->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
$vworderdetail_grid->StartRec = 1;
$vworderdetail_grid->StopRec = $vworderdetail_grid->TotalRecs; // Show all records

// Restore number of post back records
if ($CurrentForm && $vworderdetail_grid->EventCancelled) {
	$CurrentForm->Index = -1;
	if ($CurrentForm->hasValue($vworderdetail_grid->FormKeyCountName) && ($vworderdetail->isGridAdd() || $vworderdetail->isGridEdit() || $vworderdetail->isConfirm())) {
		$vworderdetail_grid->KeyCount = $CurrentForm->getValue($vworderdetail_grid->FormKeyCountName);
		$vworderdetail_grid->StopRec = $vworderdetail_grid->StartRec + $vworderdetail_grid->KeyCount - 1;
	}
}
$vworderdetail_grid->RecCnt = $vworderdetail_grid->StartRec - 1;
if ($vworderdetail_grid->Recordset && !$vworderdetail_grid->Recordset->EOF) {
	$vworderdetail_grid->Recordset->moveFirst();
	$selectLimit = $vworderdetail_grid->UseSelectLimit;
	if (!$selectLimit && $vworderdetail_grid->StartRec > 1)
		$vworderdetail_grid->Recordset->move($vworderdetail_grid->StartRec - 1);
} elseif (!$vworderdetail->AllowAddDeleteRow && $vworderdetail_grid->StopRec == 0) {
	$vworderdetail_grid->StopRec = $vworderdetail->GridAddRowCount;
}

// Initialize aggregate
$vworderdetail->RowType = ROWTYPE_AGGREGATEINIT;
$vworderdetail->resetAttributes();
$vworderdetail_grid->renderRow();
if ($vworderdetail->isGridAdd())
	$vworderdetail_grid->RowIndex = 0;
if ($vworderdetail->isGridEdit())
	$vworderdetail_grid->RowIndex = 0;
while ($vworderdetail_grid->RecCnt < $vworderdetail_grid->StopRec) {
	$vworderdetail_grid->RecCnt++;
	if ($vworderdetail_grid->RecCnt >= $vworderdetail_grid->StartRec) {
		$vworderdetail_grid->RowCnt++;
		if ($vworderdetail->isGridAdd() || $vworderdetail->isGridEdit() || $vworderdetail->isConfirm()) {
			$vworderdetail_grid->RowIndex++;
			$CurrentForm->Index = $vworderdetail_grid->RowIndex;
			if ($CurrentForm->hasValue($vworderdetail_grid->FormActionName) && $vworderdetail_grid->EventCancelled)
				$vworderdetail_grid->RowAction = strval($CurrentForm->getValue($vworderdetail_grid->FormActionName));
			elseif ($vworderdetail->isGridAdd())
				$vworderdetail_grid->RowAction = "insert";
			else
				$vworderdetail_grid->RowAction = "";
		}

		// Set up key count
		$vworderdetail_grid->KeyCount = $vworderdetail_grid->RowIndex;

		// Init row class and style
		$vworderdetail->resetAttributes();
		$vworderdetail->CssClass = "";
		if ($vworderdetail->isGridAdd()) {
			if ($vworderdetail->CurrentMode == "copy") {
				$vworderdetail_grid->loadRowValues($vworderdetail_grid->Recordset); // Load row values
				$vworderdetail_grid->setRecordKey($vworderdetail_grid->RowOldKey, $vworderdetail_grid->Recordset); // Set old record key
			} else {
				$vworderdetail_grid->loadRowValues(); // Load default values
				$vworderdetail_grid->RowOldKey = ""; // Clear old key value
			}
		} else {
			$vworderdetail_grid->loadRowValues($vworderdetail_grid->Recordset); // Load row values
		}
		$vworderdetail->RowType = ROWTYPE_VIEW; // Render view
		if ($vworderdetail->isGridAdd()) // Grid add
			$vworderdetail->RowType = ROWTYPE_ADD; // Render add
		if ($vworderdetail->isGridAdd() && $vworderdetail->EventCancelled && !$CurrentForm->hasValue("k_blankrow")) // Insert failed
			$vworderdetail_grid->restoreCurrentRowFormValues($vworderdetail_grid->RowIndex); // Restore form values
		if ($vworderdetail->isGridEdit()) { // Grid edit
			if ($vworderdetail->EventCancelled)
				$vworderdetail_grid->restoreCurrentRowFormValues($vworderdetail_grid->RowIndex); // Restore form values
			if ($vworderdetail_grid->RowAction == "insert")
				$vworderdetail->RowType = ROWTYPE_ADD; // Render add
			else
				$vworderdetail->RowType = ROWTYPE_EDIT; // Render edit
		}
		if ($vworderdetail->isGridEdit() && ($vworderdetail->RowType == ROWTYPE_EDIT || $vworderdetail->RowType == ROWTYPE_ADD) && $vworderdetail->EventCancelled) // Update failed
			$vworderdetail_grid->restoreCurrentRowFormValues($vworderdetail_grid->RowIndex); // Restore form values
		if ($vworderdetail->RowType == ROWTYPE_EDIT) // Edit row
			$vworderdetail_grid->EditRowCnt++;
		if ($vworderdetail->isConfirm()) // Confirm row
			$vworderdetail_grid->restoreCurrentRowFormValues($vworderdetail_grid->RowIndex); // Restore form values

		// Set up row id / data-rowindex
		$vworderdetail->RowAttrs = array_merge($vworderdetail->RowAttrs, array('data-rowindex'=>$vworderdetail_grid->RowCnt, 'id'=>'r' . $vworderdetail_grid->RowCnt . '_vworderdetail', 'data-rowtype'=>$vworderdetail->RowType));

		// Render row
		$vworderdetail_grid->renderRow();

		// Render list options
		$vworderdetail_grid->renderListOptions();

		// Skip delete row / empty row for confirm page
		if ($vworderdetail_grid->RowAction <> "delete" && $vworderdetail_grid->RowAction <> "insertdelete" && !($vworderdetail_grid->RowAction == "insert" && $vworderdetail->isConfirm() && $vworderdetail_grid->emptyRow())) {
?>
	<tr<?php echo $vworderdetail->rowAttributes() ?>>
<?php

// Render list options (body, left)
$vworderdetail_grid->ListOptions->render("body", "left", $vworderdetail_grid->RowCnt);
?>
	<?php if ($vworderdetail->Code->Visible) { // Code ?>
		<td data-name="Code"<?php echo $vworderdetail->Code->cellAttributes() ?>>
<?php if ($vworderdetail->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $vworderdetail_grid->RowCnt ?>_vworderdetail_Code" class="form-group vworderdetail_Code">
<input type="text" data-table="vworderdetail" data-field="x_Code" name="x<?php echo $vworderdetail_grid->RowIndex ?>_Code" id="x<?php echo $vworderdetail_grid->RowIndex ?>_Code" size="15" maxlength="50" placeholder="<?php echo HtmlEncode($vworderdetail->Code->getPlaceHolder()) ?>" value="<?php echo $vworderdetail->Code->EditValue ?>"<?php echo $vworderdetail->Code->editAttributes() ?>>
</span>
<input type="hidden" data-table="vworderdetail" data-field="x_Code" name="o<?php echo $vworderdetail_grid->RowIndex ?>_Code" id="o<?php echo $vworderdetail_grid->RowIndex ?>_Code" value="<?php echo HtmlEncode($vworderdetail->Code->OldValue) ?>">
<?php } ?>
<?php if ($vworderdetail->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $vworderdetail_grid->RowCnt ?>_vworderdetail_Code" class="form-group vworderdetail_Code">
<input type="text" data-table="vworderdetail" data-field="x_Code" name="x<?php echo $vworderdetail_grid->RowIndex ?>_Code" id="x<?php echo $vworderdetail_grid->RowIndex ?>_Code" size="15" maxlength="50" placeholder="<?php echo HtmlEncode($vworderdetail->Code->getPlaceHolder()) ?>" value="<?php echo $vworderdetail->Code->EditValue ?>"<?php echo $vworderdetail->Code->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($vworderdetail->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $vworderdetail_grid->RowCnt ?>_vworderdetail_Code" class="vworderdetail_Code">
<span<?php echo $vworderdetail->Code->viewAttributes() ?>>
<?php echo $vworderdetail->Code->getViewValue() ?></span>
</span>
<?php if (!$vworderdetail->isConfirm()) { ?>
<input type="hidden" data-table="vworderdetail" data-field="x_Code" name="x<?php echo $vworderdetail_grid->RowIndex ?>_Code" id="x<?php echo $vworderdetail_grid->RowIndex ?>_Code" value="<?php echo HtmlEncode($vworderdetail->Code->FormValue) ?>">
<input type="hidden" data-table="vworderdetail" data-field="x_Code" name="o<?php echo $vworderdetail_grid->RowIndex ?>_Code" id="o<?php echo $vworderdetail_grid->RowIndex ?>_Code" value="<?php echo HtmlEncode($vworderdetail->Code->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="vworderdetail" data-field="x_Code" name="fvworderdetailgrid$x<?php echo $vworderdetail_grid->RowIndex ?>_Code" id="fvworderdetailgrid$x<?php echo $vworderdetail_grid->RowIndex ?>_Code" value="<?php echo HtmlEncode($vworderdetail->Code->FormValue) ?>">
<input type="hidden" data-table="vworderdetail" data-field="x_Code" name="fvworderdetailgrid$o<?php echo $vworderdetail_grid->RowIndex ?>_Code" id="fvworderdetailgrid$o<?php echo $vworderdetail_grid->RowIndex ?>_Code" value="<?php echo HtmlEncode($vworderdetail->Code->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
<?php if ($vworderdetail->RowType == ROWTYPE_ADD) { // Add record ?>
<input type="hidden" data-table="vworderdetail" data-field="x_ID_Detail" name="x<?php echo $vworderdetail_grid->RowIndex ?>_ID_Detail" id="x<?php echo $vworderdetail_grid->RowIndex ?>_ID_Detail" value="<?php echo HtmlEncode($vworderdetail->ID_Detail->CurrentValue) ?>">
<input type="hidden" data-table="vworderdetail" data-field="x_ID_Detail" name="o<?php echo $vworderdetail_grid->RowIndex ?>_ID_Detail" id="o<?php echo $vworderdetail_grid->RowIndex ?>_ID_Detail" value="<?php echo HtmlEncode($vworderdetail->ID_Detail->OldValue) ?>">
<?php } ?>
<?php if ($vworderdetail->RowType == ROWTYPE_EDIT || $vworderdetail->CurrentMode == "edit") { ?>
<input type="hidden" data-table="vworderdetail" data-field="x_ID_Detail" name="x<?php echo $vworderdetail_grid->RowIndex ?>_ID_Detail" id="x<?php echo $vworderdetail_grid->RowIndex ?>_ID_Detail" value="<?php echo HtmlEncode($vworderdetail->ID_Detail->CurrentValue) ?>">
<?php } ?>
	<?php if ($vworderdetail->PCS->Visible) { // PCS ?>
		<td data-name="PCS"<?php echo $vworderdetail->PCS->cellAttributes() ?>>
<?php if ($vworderdetail->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $vworderdetail_grid->RowCnt ?>_vworderdetail_PCS" class="form-group vworderdetail_PCS">
<input type="text" data-table="vworderdetail" data-field="x_PCS" name="x<?php echo $vworderdetail_grid->RowIndex ?>_PCS" id="x<?php echo $vworderdetail_grid->RowIndex ?>_PCS" size="5" placeholder="<?php echo HtmlEncode($vworderdetail->PCS->getPlaceHolder()) ?>" value="<?php echo $vworderdetail->PCS->EditValue ?>"<?php echo $vworderdetail->PCS->editAttributes() ?>>
</span>
<input type="hidden" data-table="vworderdetail" data-field="x_PCS" name="o<?php echo $vworderdetail_grid->RowIndex ?>_PCS" id="o<?php echo $vworderdetail_grid->RowIndex ?>_PCS" value="<?php echo HtmlEncode($vworderdetail->PCS->OldValue) ?>">
<?php } ?>
<?php if ($vworderdetail->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $vworderdetail_grid->RowCnt ?>_vworderdetail_PCS" class="form-group vworderdetail_PCS">
<input type="text" data-table="vworderdetail" data-field="x_PCS" name="x<?php echo $vworderdetail_grid->RowIndex ?>_PCS" id="x<?php echo $vworderdetail_grid->RowIndex ?>_PCS" size="5" placeholder="<?php echo HtmlEncode($vworderdetail->PCS->getPlaceHolder()) ?>" value="<?php echo $vworderdetail->PCS->EditValue ?>"<?php echo $vworderdetail->PCS->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($vworderdetail->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $vworderdetail_grid->RowCnt ?>_vworderdetail_PCS" class="vworderdetail_PCS">
<span<?php echo $vworderdetail->PCS->viewAttributes() ?>>
<?php echo $vworderdetail->PCS->getViewValue() ?></span>
</span>
<?php if (!$vworderdetail->isConfirm()) { ?>
<input type="hidden" data-table="vworderdetail" data-field="x_PCS" name="x<?php echo $vworderdetail_grid->RowIndex ?>_PCS" id="x<?php echo $vworderdetail_grid->RowIndex ?>_PCS" value="<?php echo HtmlEncode($vworderdetail->PCS->FormValue) ?>">
<input type="hidden" data-table="vworderdetail" data-field="x_PCS" name="o<?php echo $vworderdetail_grid->RowIndex ?>_PCS" id="o<?php echo $vworderdetail_grid->RowIndex ?>_PCS" value="<?php echo HtmlEncode($vworderdetail->PCS->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="vworderdetail" data-field="x_PCS" name="fvworderdetailgrid$x<?php echo $vworderdetail_grid->RowIndex ?>_PCS" id="fvworderdetailgrid$x<?php echo $vworderdetail_grid->RowIndex ?>_PCS" value="<?php echo HtmlEncode($vworderdetail->PCS->FormValue) ?>">
<input type="hidden" data-table="vworderdetail" data-field="x_PCS" name="fvworderdetailgrid$o<?php echo $vworderdetail_grid->RowIndex ?>_PCS" id="fvworderdetailgrid$o<?php echo $vworderdetail_grid->RowIndex ?>_PCS" value="<?php echo HtmlEncode($vworderdetail->PCS->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($vworderdetail->StatusPickUp->Visible) { // StatusPickUp ?>
		<td data-name="StatusPickUp"<?php echo $vworderdetail->StatusPickUp->cellAttributes() ?>>
<?php if ($vworderdetail->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $vworderdetail_grid->RowCnt ?>_vworderdetail_StatusPickUp" class="form-group vworderdetail_StatusPickUp">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="vworderdetail" data-field="x_StatusPickUp" data-value-separator="<?php echo $vworderdetail->StatusPickUp->displayValueSeparatorAttribute() ?>" id="x<?php echo $vworderdetail_grid->RowIndex ?>_StatusPickUp" name="x<?php echo $vworderdetail_grid->RowIndex ?>_StatusPickUp"<?php echo $vworderdetail->StatusPickUp->editAttributes() ?>>
		<?php echo $vworderdetail->StatusPickUp->selectOptionListHtml("x<?php echo $vworderdetail_grid->RowIndex ?>_StatusPickUp") ?>
	</select>
</div>
</span>
<input type="hidden" data-table="vworderdetail" data-field="x_StatusPickUp" name="o<?php echo $vworderdetail_grid->RowIndex ?>_StatusPickUp" id="o<?php echo $vworderdetail_grid->RowIndex ?>_StatusPickUp" value="<?php echo HtmlEncode($vworderdetail->StatusPickUp->OldValue) ?>">
<?php } ?>
<?php if ($vworderdetail->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $vworderdetail_grid->RowCnt ?>_vworderdetail_StatusPickUp" class="form-group vworderdetail_StatusPickUp">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="vworderdetail" data-field="x_StatusPickUp" data-value-separator="<?php echo $vworderdetail->StatusPickUp->displayValueSeparatorAttribute() ?>" id="x<?php echo $vworderdetail_grid->RowIndex ?>_StatusPickUp" name="x<?php echo $vworderdetail_grid->RowIndex ?>_StatusPickUp"<?php echo $vworderdetail->StatusPickUp->editAttributes() ?>>
		<?php echo $vworderdetail->StatusPickUp->selectOptionListHtml("x<?php echo $vworderdetail_grid->RowIndex ?>_StatusPickUp") ?>
	</select>
</div>
</span>
<?php } ?>
<?php if ($vworderdetail->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $vworderdetail_grid->RowCnt ?>_vworderdetail_StatusPickUp" class="vworderdetail_StatusPickUp">
<span<?php echo $vworderdetail->StatusPickUp->viewAttributes() ?>>
<?php echo $vworderdetail->StatusPickUp->getViewValue() ?></span>
</span>
<?php if (!$vworderdetail->isConfirm()) { ?>
<input type="hidden" data-table="vworderdetail" data-field="x_StatusPickUp" name="x<?php echo $vworderdetail_grid->RowIndex ?>_StatusPickUp" id="x<?php echo $vworderdetail_grid->RowIndex ?>_StatusPickUp" value="<?php echo HtmlEncode($vworderdetail->StatusPickUp->FormValue) ?>">
<input type="hidden" data-table="vworderdetail" data-field="x_StatusPickUp" name="o<?php echo $vworderdetail_grid->RowIndex ?>_StatusPickUp" id="o<?php echo $vworderdetail_grid->RowIndex ?>_StatusPickUp" value="<?php echo HtmlEncode($vworderdetail->StatusPickUp->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="vworderdetail" data-field="x_StatusPickUp" name="fvworderdetailgrid$x<?php echo $vworderdetail_grid->RowIndex ?>_StatusPickUp" id="fvworderdetailgrid$x<?php echo $vworderdetail_grid->RowIndex ?>_StatusPickUp" value="<?php echo HtmlEncode($vworderdetail->StatusPickUp->FormValue) ?>">
<input type="hidden" data-table="vworderdetail" data-field="x_StatusPickUp" name="fvworderdetailgrid$o<?php echo $vworderdetail_grid->RowIndex ?>_StatusPickUp" id="fvworderdetailgrid$o<?php echo $vworderdetail_grid->RowIndex ?>_StatusPickUp" value="<?php echo HtmlEncode($vworderdetail->StatusPickUp->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($vworderdetail->CreateUser->Visible) { // CreateUser ?>
		<td data-name="CreateUser"<?php echo $vworderdetail->CreateUser->cellAttributes() ?>>
<?php if ($vworderdetail->RowType == ROWTYPE_ADD) { // Add record ?>
<input type="hidden" data-table="vworderdetail" data-field="x_CreateUser" name="o<?php echo $vworderdetail_grid->RowIndex ?>_CreateUser" id="o<?php echo $vworderdetail_grid->RowIndex ?>_CreateUser" value="<?php echo HtmlEncode($vworderdetail->CreateUser->OldValue) ?>">
<?php } ?>
<?php if ($vworderdetail->RowType == ROWTYPE_EDIT) { // Edit record ?>
<?php } ?>
<?php if ($vworderdetail->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $vworderdetail_grid->RowCnt ?>_vworderdetail_CreateUser" class="vworderdetail_CreateUser">
<span<?php echo $vworderdetail->CreateUser->viewAttributes() ?>>
<?php echo $vworderdetail->CreateUser->getViewValue() ?></span>
</span>
<?php if (!$vworderdetail->isConfirm()) { ?>
<input type="hidden" data-table="vworderdetail" data-field="x_CreateUser" name="x<?php echo $vworderdetail_grid->RowIndex ?>_CreateUser" id="x<?php echo $vworderdetail_grid->RowIndex ?>_CreateUser" value="<?php echo HtmlEncode($vworderdetail->CreateUser->FormValue) ?>">
<input type="hidden" data-table="vworderdetail" data-field="x_CreateUser" name="o<?php echo $vworderdetail_grid->RowIndex ?>_CreateUser" id="o<?php echo $vworderdetail_grid->RowIndex ?>_CreateUser" value="<?php echo HtmlEncode($vworderdetail->CreateUser->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="vworderdetail" data-field="x_CreateUser" name="fvworderdetailgrid$x<?php echo $vworderdetail_grid->RowIndex ?>_CreateUser" id="fvworderdetailgrid$x<?php echo $vworderdetail_grid->RowIndex ?>_CreateUser" value="<?php echo HtmlEncode($vworderdetail->CreateUser->FormValue) ?>">
<input type="hidden" data-table="vworderdetail" data-field="x_CreateUser" name="fvworderdetailgrid$o<?php echo $vworderdetail_grid->RowIndex ?>_CreateUser" id="fvworderdetailgrid$o<?php echo $vworderdetail_grid->RowIndex ?>_CreateUser" value="<?php echo HtmlEncode($vworderdetail->CreateUser->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($vworderdetail->CreateDate->Visible) { // CreateDate ?>
		<td data-name="CreateDate"<?php echo $vworderdetail->CreateDate->cellAttributes() ?>>
<?php if ($vworderdetail->RowType == ROWTYPE_ADD) { // Add record ?>
<input type="hidden" data-table="vworderdetail" data-field="x_CreateDate" name="o<?php echo $vworderdetail_grid->RowIndex ?>_CreateDate" id="o<?php echo $vworderdetail_grid->RowIndex ?>_CreateDate" value="<?php echo HtmlEncode($vworderdetail->CreateDate->OldValue) ?>">
<?php } ?>
<?php if ($vworderdetail->RowType == ROWTYPE_EDIT) { // Edit record ?>
<?php } ?>
<?php if ($vworderdetail->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $vworderdetail_grid->RowCnt ?>_vworderdetail_CreateDate" class="vworderdetail_CreateDate">
<span<?php echo $vworderdetail->CreateDate->viewAttributes() ?>>
<?php echo $vworderdetail->CreateDate->getViewValue() ?></span>
</span>
<?php if (!$vworderdetail->isConfirm()) { ?>
<input type="hidden" data-table="vworderdetail" data-field="x_CreateDate" name="x<?php echo $vworderdetail_grid->RowIndex ?>_CreateDate" id="x<?php echo $vworderdetail_grid->RowIndex ?>_CreateDate" value="<?php echo HtmlEncode($vworderdetail->CreateDate->FormValue) ?>">
<input type="hidden" data-table="vworderdetail" data-field="x_CreateDate" name="o<?php echo $vworderdetail_grid->RowIndex ?>_CreateDate" id="o<?php echo $vworderdetail_grid->RowIndex ?>_CreateDate" value="<?php echo HtmlEncode($vworderdetail->CreateDate->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="vworderdetail" data-field="x_CreateDate" name="fvworderdetailgrid$x<?php echo $vworderdetail_grid->RowIndex ?>_CreateDate" id="fvworderdetailgrid$x<?php echo $vworderdetail_grid->RowIndex ?>_CreateDate" value="<?php echo HtmlEncode($vworderdetail->CreateDate->FormValue) ?>">
<input type="hidden" data-table="vworderdetail" data-field="x_CreateDate" name="fvworderdetailgrid$o<?php echo $vworderdetail_grid->RowIndex ?>_CreateDate" id="fvworderdetailgrid$o<?php echo $vworderdetail_grid->RowIndex ?>_CreateDate" value="<?php echo HtmlEncode($vworderdetail->CreateDate->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$vworderdetail_grid->ListOptions->render("body", "right", $vworderdetail_grid->RowCnt);
?>
	</tr>
<?php if ($vworderdetail->RowType == ROWTYPE_ADD || $vworderdetail->RowType == ROWTYPE_EDIT) { ?>
<script>
fvworderdetailgrid.updateLists(<?php echo $vworderdetail_grid->RowIndex ?>);
</script>
<?php } ?>
<?php
	}
	} // End delete row checking
	if (!$vworderdetail->isGridAdd() || $vworderdetail->CurrentMode == "copy")
		if (!$vworderdetail_grid->Recordset->EOF)
			$vworderdetail_grid->Recordset->moveNext();
}
?>
<?php
	if ($vworderdetail->CurrentMode == "add" || $vworderdetail->CurrentMode == "copy" || $vworderdetail->CurrentMode == "edit") {
		$vworderdetail_grid->RowIndex = '$rowindex$';
		$vworderdetail_grid->loadRowValues();

		// Set row properties
		$vworderdetail->resetAttributes();
		$vworderdetail->RowAttrs = array_merge($vworderdetail->RowAttrs, array('data-rowindex'=>$vworderdetail_grid->RowIndex, 'id'=>'r0_vworderdetail', 'data-rowtype'=>ROWTYPE_ADD));
		AppendClass($vworderdetail->RowAttrs["class"], "ew-template");
		$vworderdetail->RowType = ROWTYPE_ADD;

		// Render row
		$vworderdetail_grid->renderRow();

		// Render list options
		$vworderdetail_grid->renderListOptions();
		$vworderdetail_grid->StartRowCnt = 0;
?>
	<tr<?php echo $vworderdetail->rowAttributes() ?>>
<?php

// Render list options (body, left)
$vworderdetail_grid->ListOptions->render("body", "left", $vworderdetail_grid->RowIndex);
?>
	<?php if ($vworderdetail->Code->Visible) { // Code ?>
		<td data-name="Code">
<?php if (!$vworderdetail->isConfirm()) { ?>
<span id="el$rowindex$_vworderdetail_Code" class="form-group vworderdetail_Code">
<input type="text" data-table="vworderdetail" data-field="x_Code" name="x<?php echo $vworderdetail_grid->RowIndex ?>_Code" id="x<?php echo $vworderdetail_grid->RowIndex ?>_Code" size="15" maxlength="50" placeholder="<?php echo HtmlEncode($vworderdetail->Code->getPlaceHolder()) ?>" value="<?php echo $vworderdetail->Code->EditValue ?>"<?php echo $vworderdetail->Code->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_vworderdetail_Code" class="form-group vworderdetail_Code">
<span<?php echo $vworderdetail->Code->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?php echo RemoveHtml($vworderdetail->Code->ViewValue) ?>"></span>
</span>
<input type="hidden" data-table="vworderdetail" data-field="x_Code" name="x<?php echo $vworderdetail_grid->RowIndex ?>_Code" id="x<?php echo $vworderdetail_grid->RowIndex ?>_Code" value="<?php echo HtmlEncode($vworderdetail->Code->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="vworderdetail" data-field="x_Code" name="o<?php echo $vworderdetail_grid->RowIndex ?>_Code" id="o<?php echo $vworderdetail_grid->RowIndex ?>_Code" value="<?php echo HtmlEncode($vworderdetail->Code->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($vworderdetail->PCS->Visible) { // PCS ?>
		<td data-name="PCS">
<?php if (!$vworderdetail->isConfirm()) { ?>
<span id="el$rowindex$_vworderdetail_PCS" class="form-group vworderdetail_PCS">
<input type="text" data-table="vworderdetail" data-field="x_PCS" name="x<?php echo $vworderdetail_grid->RowIndex ?>_PCS" id="x<?php echo $vworderdetail_grid->RowIndex ?>_PCS" size="5" placeholder="<?php echo HtmlEncode($vworderdetail->PCS->getPlaceHolder()) ?>" value="<?php echo $vworderdetail->PCS->EditValue ?>"<?php echo $vworderdetail->PCS->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_vworderdetail_PCS" class="form-group vworderdetail_PCS">
<span<?php echo $vworderdetail->PCS->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?php echo RemoveHtml($vworderdetail->PCS->ViewValue) ?>"></span>
</span>
<input type="hidden" data-table="vworderdetail" data-field="x_PCS" name="x<?php echo $vworderdetail_grid->RowIndex ?>_PCS" id="x<?php echo $vworderdetail_grid->RowIndex ?>_PCS" value="<?php echo HtmlEncode($vworderdetail->PCS->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="vworderdetail" data-field="x_PCS" name="o<?php echo $vworderdetail_grid->RowIndex ?>_PCS" id="o<?php echo $vworderdetail_grid->RowIndex ?>_PCS" value="<?php echo HtmlEncode($vworderdetail->PCS->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($vworderdetail->StatusPickUp->Visible) { // StatusPickUp ?>
		<td data-name="StatusPickUp">
<?php if (!$vworderdetail->isConfirm()) { ?>
<span id="el$rowindex$_vworderdetail_StatusPickUp" class="form-group vworderdetail_StatusPickUp">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="vworderdetail" data-field="x_StatusPickUp" data-value-separator="<?php echo $vworderdetail->StatusPickUp->displayValueSeparatorAttribute() ?>" id="x<?php echo $vworderdetail_grid->RowIndex ?>_StatusPickUp" name="x<?php echo $vworderdetail_grid->RowIndex ?>_StatusPickUp"<?php echo $vworderdetail->StatusPickUp->editAttributes() ?>>
		<?php echo $vworderdetail->StatusPickUp->selectOptionListHtml("x<?php echo $vworderdetail_grid->RowIndex ?>_StatusPickUp") ?>
	</select>
</div>
</span>
<?php } else { ?>
<span id="el$rowindex$_vworderdetail_StatusPickUp" class="form-group vworderdetail_StatusPickUp">
<span<?php echo $vworderdetail->StatusPickUp->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?php echo RemoveHtml($vworderdetail->StatusPickUp->ViewValue) ?>"></span>
</span>
<input type="hidden" data-table="vworderdetail" data-field="x_StatusPickUp" name="x<?php echo $vworderdetail_grid->RowIndex ?>_StatusPickUp" id="x<?php echo $vworderdetail_grid->RowIndex ?>_StatusPickUp" value="<?php echo HtmlEncode($vworderdetail->StatusPickUp->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="vworderdetail" data-field="x_StatusPickUp" name="o<?php echo $vworderdetail_grid->RowIndex ?>_StatusPickUp" id="o<?php echo $vworderdetail_grid->RowIndex ?>_StatusPickUp" value="<?php echo HtmlEncode($vworderdetail->StatusPickUp->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($vworderdetail->CreateUser->Visible) { // CreateUser ?>
		<td data-name="CreateUser">
<?php if (!$vworderdetail->isConfirm()) { ?>
<?php } else { ?>
<span id="el$rowindex$_vworderdetail_CreateUser" class="form-group vworderdetail_CreateUser">
<span<?php echo $vworderdetail->CreateUser->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?php echo RemoveHtml($vworderdetail->CreateUser->ViewValue) ?>"></span>
</span>
<input type="hidden" data-table="vworderdetail" data-field="x_CreateUser" name="x<?php echo $vworderdetail_grid->RowIndex ?>_CreateUser" id="x<?php echo $vworderdetail_grid->RowIndex ?>_CreateUser" value="<?php echo HtmlEncode($vworderdetail->CreateUser->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="vworderdetail" data-field="x_CreateUser" name="o<?php echo $vworderdetail_grid->RowIndex ?>_CreateUser" id="o<?php echo $vworderdetail_grid->RowIndex ?>_CreateUser" value="<?php echo HtmlEncode($vworderdetail->CreateUser->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($vworderdetail->CreateDate->Visible) { // CreateDate ?>
		<td data-name="CreateDate">
<?php if (!$vworderdetail->isConfirm()) { ?>
<?php } else { ?>
<span id="el$rowindex$_vworderdetail_CreateDate" class="form-group vworderdetail_CreateDate">
<span<?php echo $vworderdetail->CreateDate->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?php echo RemoveHtml($vworderdetail->CreateDate->ViewValue) ?>"></span>
</span>
<input type="hidden" data-table="vworderdetail" data-field="x_CreateDate" name="x<?php echo $vworderdetail_grid->RowIndex ?>_CreateDate" id="x<?php echo $vworderdetail_grid->RowIndex ?>_CreateDate" value="<?php echo HtmlEncode($vworderdetail->CreateDate->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="vworderdetail" data-field="x_CreateDate" name="o<?php echo $vworderdetail_grid->RowIndex ?>_CreateDate" id="o<?php echo $vworderdetail_grid->RowIndex ?>_CreateDate" value="<?php echo HtmlEncode($vworderdetail->CreateDate->OldValue) ?>">
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$vworderdetail_grid->ListOptions->render("body", "right", $vworderdetail_grid->RowIndex);
?>
<script>
fvworderdetailgrid.updateLists(<?php echo $vworderdetail_grid->RowIndex ?>);
</script>
	</tr>
<?php
}
?>
</tbody>
</table><!-- /.ew-table -->
<?php if ($vworderdetail->CurrentMode == "add" || $vworderdetail->CurrentMode == "copy") { ?>
<input type="hidden" name="<?php echo $vworderdetail_grid->FormKeyCountName ?>" id="<?php echo $vworderdetail_grid->FormKeyCountName ?>" value="<?php echo $vworderdetail_grid->KeyCount ?>">
<?php echo $vworderdetail_grid->MultiSelectKey ?>
<?php } ?>
<?php if ($vworderdetail->CurrentMode == "edit") { ?>
<input type="hidden" name="<?php echo $vworderdetail_grid->FormKeyCountName ?>" id="<?php echo $vworderdetail_grid->FormKeyCountName ?>" value="<?php echo $vworderdetail_grid->KeyCount ?>">
<?php echo $vworderdetail_grid->MultiSelectKey ?>
<?php } ?>
<?php if ($vworderdetail->CurrentMode == "") { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
<input type="hidden" name="detailpage" value="fvworderdetailgrid">
</div><!-- /.ew-grid-middle-panel -->
<?php

// Close recordset
if ($vworderdetail_grid->Recordset)
	$vworderdetail_grid->Recordset->Close();
?>
</div>
<?php if ($vworderdetail_grid->ShowOtherOptions) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php $vworderdetail_grid->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($vworderdetail_grid->TotalRecs == 0 && !$vworderdetail->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $vworderdetail_grid->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$vworderdetail_grid->terminate();
?>