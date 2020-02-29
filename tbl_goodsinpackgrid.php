<?php
namespace PHPMaker2019\asgbn_wh;

// Write header
WriteHeader(FALSE);

// Create page object
if (!isset($tbl_goodsinpack_grid))
	$tbl_goodsinpack_grid = new tbl_goodsinpack_grid();

// Run the page
$tbl_goodsinpack_grid->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$tbl_goodsinpack_grid->Page_Render();
?>
<?php if (!$tbl_goodsinpack->isExport()) { ?>
<script>

// Form object
var ftbl_goodsinpackgrid = new ew.Form("ftbl_goodsinpackgrid", "grid");
ftbl_goodsinpackgrid.formKeyCountName = '<?php echo $tbl_goodsinpack_grid->FormKeyCountName ?>';

// Validate form
ftbl_goodsinpackgrid.validate = function() {
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
		<?php if ($tbl_goodsinpack_grid->Code->Required) { ?>
			elm = this.getElements("x" + infix + "_Code");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $tbl_goodsinpack->Code->caption(), $tbl_goodsinpack->Code->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($tbl_goodsinpack_grid->PCS->Required) { ?>
			elm = this.getElements("x" + infix + "_PCS");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $tbl_goodsinpack->PCS->caption(), $tbl_goodsinpack->PCS->RequiredErrorMessage)) ?>");
		<?php } ?>
			elm = this.getElements("x" + infix + "_PCS");
			if (elm && !ew.checkInteger(elm.value))
				return this.onError(elm, "<?php echo JsEncode($tbl_goodsinpack->PCS->errorMessage()) ?>");
		<?php if ($tbl_goodsinpack_grid->CreateUser->Required) { ?>
			elm = this.getElements("x" + infix + "_CreateUser");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $tbl_goodsinpack->CreateUser->caption(), $tbl_goodsinpack->CreateUser->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($tbl_goodsinpack_grid->CreateDate->Required) { ?>
			elm = this.getElements("x" + infix + "_CreateDate");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $tbl_goodsinpack->CreateDate->caption(), $tbl_goodsinpack->CreateDate->RequiredErrorMessage)) ?>");
		<?php } ?>
			elm = this.getElements("x" + infix + "_CreateDate");
			if (elm && !ew.checkDateDef(elm.value))
				return this.onError(elm, "<?php echo JsEncode($tbl_goodsinpack->CreateDate->errorMessage()) ?>");
		<?php if ($tbl_goodsinpack_grid->UpdateUser->Required) { ?>
			elm = this.getElements("x" + infix + "_UpdateUser");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $tbl_goodsinpack->UpdateUser->caption(), $tbl_goodsinpack->UpdateUser->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($tbl_goodsinpack_grid->UpdateDatetime->Required) { ?>
			elm = this.getElements("x" + infix + "_UpdateDatetime");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $tbl_goodsinpack->UpdateDatetime->caption(), $tbl_goodsinpack->UpdateDatetime->RequiredErrorMessage)) ?>");
		<?php } ?>
			elm = this.getElements("x" + infix + "_UpdateDatetime");
			if (elm && !ew.checkDateDef(elm.value))
				return this.onError(elm, "<?php echo JsEncode($tbl_goodsinpack->UpdateDatetime->errorMessage()) ?>");

			// Fire Form_CustomValidate event
			if (!this.Form_CustomValidate(fobj))
				return false;
		} // End Grid Add checking
	}
	return true;
}

// Check empty row
ftbl_goodsinpackgrid.emptyRow = function(infix) {
	var fobj = this._form;
	if (ew.valueChanged(fobj, infix, "Code", false)) return false;
	if (ew.valueChanged(fobj, infix, "PCS", false)) return false;
	if (ew.valueChanged(fobj, infix, "CreateUser", false)) return false;
	if (ew.valueChanged(fobj, infix, "CreateDate", false)) return false;
	if (ew.valueChanged(fobj, infix, "UpdateUser", false)) return false;
	if (ew.valueChanged(fobj, infix, "UpdateDatetime", false)) return false;
	return true;
}

// Form_CustomValidate event
ftbl_goodsinpackgrid.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

	// Your custom validation code here, return false if invalid.
	return true;
}

// Use JavaScript validation or not
ftbl_goodsinpackgrid.validateRequired = <?php echo json_encode(CLIENT_VALIDATE) ?>;

// Dynamic selection lists
// Form object for search

</script>
<?php } ?>
<?php
$tbl_goodsinpack_grid->renderOtherOptions();
?>
<?php $tbl_goodsinpack_grid->showPageHeader(); ?>
<?php
$tbl_goodsinpack_grid->showMessage();
?>
<?php if ($tbl_goodsinpack_grid->TotalRecs > 0 || $tbl_goodsinpack->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($tbl_goodsinpack_grid->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> tbl_goodsinpack">
<?php if ($tbl_goodsinpack_grid->ShowOtherOptions) { ?>
<div class="card-header ew-grid-upper-panel">
<?php $tbl_goodsinpack_grid->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<div id="ftbl_goodsinpackgrid" class="ew-form ew-list-form form-inline">
<div id="gmp_tbl_goodsinpack" class="<?php if (IsResponsiveLayout()) { ?>table-responsive <?php } ?>card-body ew-grid-middle-panel">
<table id="tbl_tbl_goodsinpackgrid" class="table ew-table"><!-- .ew-table ##-->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$tbl_goodsinpack_grid->RowType = ROWTYPE_HEADER;

// Render list options
$tbl_goodsinpack_grid->renderListOptions();

// Render list options (header, left)
$tbl_goodsinpack_grid->ListOptions->render("header", "left");
?>
<?php if ($tbl_goodsinpack->Code->Visible) { // Code ?>
	<?php if ($tbl_goodsinpack->sortUrl($tbl_goodsinpack->Code) == "") { ?>
		<th data-name="Code" class="<?php echo $tbl_goodsinpack->Code->headerCellClass() ?>" style="white-space: nowrap;"><div id="elh_tbl_goodsinpack_Code" class="tbl_goodsinpack_Code"><div class="ew-table-header-caption"><?php echo $tbl_goodsinpack->Code->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Code" class="<?php echo $tbl_goodsinpack->Code->headerCellClass() ?>" style="white-space: nowrap;"><div><div id="elh_tbl_goodsinpack_Code" class="tbl_goodsinpack_Code">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $tbl_goodsinpack->Code->caption() ?></span><span class="ew-table-header-sort"><?php if ($tbl_goodsinpack->Code->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($tbl_goodsinpack->Code->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($tbl_goodsinpack->PCS->Visible) { // PCS ?>
	<?php if ($tbl_goodsinpack->sortUrl($tbl_goodsinpack->PCS) == "") { ?>
		<th data-name="PCS" class="<?php echo $tbl_goodsinpack->PCS->headerCellClass() ?>" style="white-space: nowrap;"><div id="elh_tbl_goodsinpack_PCS" class="tbl_goodsinpack_PCS"><div class="ew-table-header-caption"><?php echo $tbl_goodsinpack->PCS->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="PCS" class="<?php echo $tbl_goodsinpack->PCS->headerCellClass() ?>" style="white-space: nowrap;"><div><div id="elh_tbl_goodsinpack_PCS" class="tbl_goodsinpack_PCS">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $tbl_goodsinpack->PCS->caption() ?></span><span class="ew-table-header-sort"><?php if ($tbl_goodsinpack->PCS->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($tbl_goodsinpack->PCS->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($tbl_goodsinpack->CreateUser->Visible) { // CreateUser ?>
	<?php if ($tbl_goodsinpack->sortUrl($tbl_goodsinpack->CreateUser) == "") { ?>
		<th data-name="CreateUser" class="<?php echo $tbl_goodsinpack->CreateUser->headerCellClass() ?>" style="white-space: nowrap;"><div id="elh_tbl_goodsinpack_CreateUser" class="tbl_goodsinpack_CreateUser"><div class="ew-table-header-caption"><?php echo $tbl_goodsinpack->CreateUser->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="CreateUser" class="<?php echo $tbl_goodsinpack->CreateUser->headerCellClass() ?>" style="white-space: nowrap;"><div><div id="elh_tbl_goodsinpack_CreateUser" class="tbl_goodsinpack_CreateUser">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $tbl_goodsinpack->CreateUser->caption() ?></span><span class="ew-table-header-sort"><?php if ($tbl_goodsinpack->CreateUser->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($tbl_goodsinpack->CreateUser->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($tbl_goodsinpack->CreateDate->Visible) { // CreateDate ?>
	<?php if ($tbl_goodsinpack->sortUrl($tbl_goodsinpack->CreateDate) == "") { ?>
		<th data-name="CreateDate" class="<?php echo $tbl_goodsinpack->CreateDate->headerCellClass() ?>" style="white-space: nowrap;"><div id="elh_tbl_goodsinpack_CreateDate" class="tbl_goodsinpack_CreateDate"><div class="ew-table-header-caption"><?php echo $tbl_goodsinpack->CreateDate->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="CreateDate" class="<?php echo $tbl_goodsinpack->CreateDate->headerCellClass() ?>" style="white-space: nowrap;"><div><div id="elh_tbl_goodsinpack_CreateDate" class="tbl_goodsinpack_CreateDate">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $tbl_goodsinpack->CreateDate->caption() ?></span><span class="ew-table-header-sort"><?php if ($tbl_goodsinpack->CreateDate->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($tbl_goodsinpack->CreateDate->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($tbl_goodsinpack->UpdateUser->Visible) { // UpdateUser ?>
	<?php if ($tbl_goodsinpack->sortUrl($tbl_goodsinpack->UpdateUser) == "") { ?>
		<th data-name="UpdateUser" class="<?php echo $tbl_goodsinpack->UpdateUser->headerCellClass() ?>" style="white-space: nowrap;"><div id="elh_tbl_goodsinpack_UpdateUser" class="tbl_goodsinpack_UpdateUser"><div class="ew-table-header-caption"><?php echo $tbl_goodsinpack->UpdateUser->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="UpdateUser" class="<?php echo $tbl_goodsinpack->UpdateUser->headerCellClass() ?>" style="white-space: nowrap;"><div><div id="elh_tbl_goodsinpack_UpdateUser" class="tbl_goodsinpack_UpdateUser">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $tbl_goodsinpack->UpdateUser->caption() ?></span><span class="ew-table-header-sort"><?php if ($tbl_goodsinpack->UpdateUser->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($tbl_goodsinpack->UpdateUser->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($tbl_goodsinpack->UpdateDatetime->Visible) { // UpdateDatetime ?>
	<?php if ($tbl_goodsinpack->sortUrl($tbl_goodsinpack->UpdateDatetime) == "") { ?>
		<th data-name="UpdateDatetime" class="<?php echo $tbl_goodsinpack->UpdateDatetime->headerCellClass() ?>" style="white-space: nowrap;"><div id="elh_tbl_goodsinpack_UpdateDatetime" class="tbl_goodsinpack_UpdateDatetime"><div class="ew-table-header-caption"><?php echo $tbl_goodsinpack->UpdateDatetime->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="UpdateDatetime" class="<?php echo $tbl_goodsinpack->UpdateDatetime->headerCellClass() ?>" style="white-space: nowrap;"><div><div id="elh_tbl_goodsinpack_UpdateDatetime" class="tbl_goodsinpack_UpdateDatetime">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $tbl_goodsinpack->UpdateDatetime->caption() ?></span><span class="ew-table-header-sort"><?php if ($tbl_goodsinpack->UpdateDatetime->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($tbl_goodsinpack->UpdateDatetime->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$tbl_goodsinpack_grid->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
$tbl_goodsinpack_grid->StartRec = 1;
$tbl_goodsinpack_grid->StopRec = $tbl_goodsinpack_grid->TotalRecs; // Show all records

// Restore number of post back records
if ($CurrentForm && $tbl_goodsinpack_grid->EventCancelled) {
	$CurrentForm->Index = -1;
	if ($CurrentForm->hasValue($tbl_goodsinpack_grid->FormKeyCountName) && ($tbl_goodsinpack->isGridAdd() || $tbl_goodsinpack->isGridEdit() || $tbl_goodsinpack->isConfirm())) {
		$tbl_goodsinpack_grid->KeyCount = $CurrentForm->getValue($tbl_goodsinpack_grid->FormKeyCountName);
		$tbl_goodsinpack_grid->StopRec = $tbl_goodsinpack_grid->StartRec + $tbl_goodsinpack_grid->KeyCount - 1;
	}
}
$tbl_goodsinpack_grid->RecCnt = $tbl_goodsinpack_grid->StartRec - 1;
if ($tbl_goodsinpack_grid->Recordset && !$tbl_goodsinpack_grid->Recordset->EOF) {
	$tbl_goodsinpack_grid->Recordset->moveFirst();
	$selectLimit = $tbl_goodsinpack_grid->UseSelectLimit;
	if (!$selectLimit && $tbl_goodsinpack_grid->StartRec > 1)
		$tbl_goodsinpack_grid->Recordset->move($tbl_goodsinpack_grid->StartRec - 1);
} elseif (!$tbl_goodsinpack->AllowAddDeleteRow && $tbl_goodsinpack_grid->StopRec == 0) {
	$tbl_goodsinpack_grid->StopRec = $tbl_goodsinpack->GridAddRowCount;
}

// Initialize aggregate
$tbl_goodsinpack->RowType = ROWTYPE_AGGREGATEINIT;
$tbl_goodsinpack->resetAttributes();
$tbl_goodsinpack_grid->renderRow();
if ($tbl_goodsinpack->isGridAdd())
	$tbl_goodsinpack_grid->RowIndex = 0;
if ($tbl_goodsinpack->isGridEdit())
	$tbl_goodsinpack_grid->RowIndex = 0;
while ($tbl_goodsinpack_grid->RecCnt < $tbl_goodsinpack_grid->StopRec) {
	$tbl_goodsinpack_grid->RecCnt++;
	if ($tbl_goodsinpack_grid->RecCnt >= $tbl_goodsinpack_grid->StartRec) {
		$tbl_goodsinpack_grid->RowCnt++;
		if ($tbl_goodsinpack->isGridAdd() || $tbl_goodsinpack->isGridEdit() || $tbl_goodsinpack->isConfirm()) {
			$tbl_goodsinpack_grid->RowIndex++;
			$CurrentForm->Index = $tbl_goodsinpack_grid->RowIndex;
			if ($CurrentForm->hasValue($tbl_goodsinpack_grid->FormActionName) && $tbl_goodsinpack_grid->EventCancelled)
				$tbl_goodsinpack_grid->RowAction = strval($CurrentForm->getValue($tbl_goodsinpack_grid->FormActionName));
			elseif ($tbl_goodsinpack->isGridAdd())
				$tbl_goodsinpack_grid->RowAction = "insert";
			else
				$tbl_goodsinpack_grid->RowAction = "";
		}

		// Set up key count
		$tbl_goodsinpack_grid->KeyCount = $tbl_goodsinpack_grid->RowIndex;

		// Init row class and style
		$tbl_goodsinpack->resetAttributes();
		$tbl_goodsinpack->CssClass = "";
		if ($tbl_goodsinpack->isGridAdd()) {
			if ($tbl_goodsinpack->CurrentMode == "copy") {
				$tbl_goodsinpack_grid->loadRowValues($tbl_goodsinpack_grid->Recordset); // Load row values
				$tbl_goodsinpack_grid->setRecordKey($tbl_goodsinpack_grid->RowOldKey, $tbl_goodsinpack_grid->Recordset); // Set old record key
			} else {
				$tbl_goodsinpack_grid->loadRowValues(); // Load default values
				$tbl_goodsinpack_grid->RowOldKey = ""; // Clear old key value
			}
		} else {
			$tbl_goodsinpack_grid->loadRowValues($tbl_goodsinpack_grid->Recordset); // Load row values
		}
		$tbl_goodsinpack->RowType = ROWTYPE_VIEW; // Render view
		if ($tbl_goodsinpack->isGridAdd()) // Grid add
			$tbl_goodsinpack->RowType = ROWTYPE_ADD; // Render add
		if ($tbl_goodsinpack->isGridAdd() && $tbl_goodsinpack->EventCancelled && !$CurrentForm->hasValue("k_blankrow")) // Insert failed
			$tbl_goodsinpack_grid->restoreCurrentRowFormValues($tbl_goodsinpack_grid->RowIndex); // Restore form values
		if ($tbl_goodsinpack->isGridEdit()) { // Grid edit
			if ($tbl_goodsinpack->EventCancelled)
				$tbl_goodsinpack_grid->restoreCurrentRowFormValues($tbl_goodsinpack_grid->RowIndex); // Restore form values
			if ($tbl_goodsinpack_grid->RowAction == "insert")
				$tbl_goodsinpack->RowType = ROWTYPE_ADD; // Render add
			else
				$tbl_goodsinpack->RowType = ROWTYPE_EDIT; // Render edit
		}
		if ($tbl_goodsinpack->isGridEdit() && ($tbl_goodsinpack->RowType == ROWTYPE_EDIT || $tbl_goodsinpack->RowType == ROWTYPE_ADD) && $tbl_goodsinpack->EventCancelled) // Update failed
			$tbl_goodsinpack_grid->restoreCurrentRowFormValues($tbl_goodsinpack_grid->RowIndex); // Restore form values
		if ($tbl_goodsinpack->RowType == ROWTYPE_EDIT) // Edit row
			$tbl_goodsinpack_grid->EditRowCnt++;
		if ($tbl_goodsinpack->isConfirm()) // Confirm row
			$tbl_goodsinpack_grid->restoreCurrentRowFormValues($tbl_goodsinpack_grid->RowIndex); // Restore form values

		// Set up row id / data-rowindex
		$tbl_goodsinpack->RowAttrs = array_merge($tbl_goodsinpack->RowAttrs, array('data-rowindex'=>$tbl_goodsinpack_grid->RowCnt, 'id'=>'r' . $tbl_goodsinpack_grid->RowCnt . '_tbl_goodsinpack', 'data-rowtype'=>$tbl_goodsinpack->RowType));

		// Render row
		$tbl_goodsinpack_grid->renderRow();

		// Render list options
		$tbl_goodsinpack_grid->renderListOptions();

		// Skip delete row / empty row for confirm page
		if ($tbl_goodsinpack_grid->RowAction <> "delete" && $tbl_goodsinpack_grid->RowAction <> "insertdelete" && !($tbl_goodsinpack_grid->RowAction == "insert" && $tbl_goodsinpack->isConfirm() && $tbl_goodsinpack_grid->emptyRow())) {
?>
	<tr<?php echo $tbl_goodsinpack->rowAttributes() ?>>
<?php

// Render list options (body, left)
$tbl_goodsinpack_grid->ListOptions->render("body", "left", $tbl_goodsinpack_grid->RowCnt);
?>
	<?php if ($tbl_goodsinpack->Code->Visible) { // Code ?>
		<td data-name="Code"<?php echo $tbl_goodsinpack->Code->cellAttributes() ?>>
<?php if ($tbl_goodsinpack->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $tbl_goodsinpack_grid->RowCnt ?>_tbl_goodsinpack_Code" class="form-group tbl_goodsinpack_Code">
<input type="text" data-table="tbl_goodsinpack" data-field="x_Code" name="x<?php echo $tbl_goodsinpack_grid->RowIndex ?>_Code" id="x<?php echo $tbl_goodsinpack_grid->RowIndex ?>_Code" size="30" maxlength="55" placeholder="<?php echo HtmlEncode($tbl_goodsinpack->Code->getPlaceHolder()) ?>" value="<?php echo $tbl_goodsinpack->Code->EditValue ?>"<?php echo $tbl_goodsinpack->Code->editAttributes() ?>>
</span>
<input type="hidden" data-table="tbl_goodsinpack" data-field="x_Code" name="o<?php echo $tbl_goodsinpack_grid->RowIndex ?>_Code" id="o<?php echo $tbl_goodsinpack_grid->RowIndex ?>_Code" value="<?php echo HtmlEncode($tbl_goodsinpack->Code->OldValue) ?>">
<?php } ?>
<?php if ($tbl_goodsinpack->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $tbl_goodsinpack_grid->RowCnt ?>_tbl_goodsinpack_Code" class="form-group tbl_goodsinpack_Code">
<span<?php echo $tbl_goodsinpack->Code->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?php echo RemoveHtml($tbl_goodsinpack->Code->EditValue) ?>"></span>
</span>
<input type="hidden" data-table="tbl_goodsinpack" data-field="x_Code" name="x<?php echo $tbl_goodsinpack_grid->RowIndex ?>_Code" id="x<?php echo $tbl_goodsinpack_grid->RowIndex ?>_Code" value="<?php echo HtmlEncode($tbl_goodsinpack->Code->CurrentValue) ?>">
<?php } ?>
<?php if ($tbl_goodsinpack->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $tbl_goodsinpack_grid->RowCnt ?>_tbl_goodsinpack_Code" class="tbl_goodsinpack_Code">
<span<?php echo $tbl_goodsinpack->Code->viewAttributes() ?>>
<?php echo $tbl_goodsinpack->Code->getViewValue() ?></span>
</span>
<?php if (!$tbl_goodsinpack->isConfirm()) { ?>
<input type="hidden" data-table="tbl_goodsinpack" data-field="x_Code" name="x<?php echo $tbl_goodsinpack_grid->RowIndex ?>_Code" id="x<?php echo $tbl_goodsinpack_grid->RowIndex ?>_Code" value="<?php echo HtmlEncode($tbl_goodsinpack->Code->FormValue) ?>">
<input type="hidden" data-table="tbl_goodsinpack" data-field="x_Code" name="o<?php echo $tbl_goodsinpack_grid->RowIndex ?>_Code" id="o<?php echo $tbl_goodsinpack_grid->RowIndex ?>_Code" value="<?php echo HtmlEncode($tbl_goodsinpack->Code->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="tbl_goodsinpack" data-field="x_Code" name="ftbl_goodsinpackgrid$x<?php echo $tbl_goodsinpack_grid->RowIndex ?>_Code" id="ftbl_goodsinpackgrid$x<?php echo $tbl_goodsinpack_grid->RowIndex ?>_Code" value="<?php echo HtmlEncode($tbl_goodsinpack->Code->FormValue) ?>">
<input type="hidden" data-table="tbl_goodsinpack" data-field="x_Code" name="ftbl_goodsinpackgrid$o<?php echo $tbl_goodsinpack_grid->RowIndex ?>_Code" id="ftbl_goodsinpackgrid$o<?php echo $tbl_goodsinpack_grid->RowIndex ?>_Code" value="<?php echo HtmlEncode($tbl_goodsinpack->Code->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
<?php if ($tbl_goodsinpack->RowType == ROWTYPE_ADD) { // Add record ?>
<input type="hidden" data-table="tbl_goodsinpack" data-field="x_ID_packingDetail" name="x<?php echo $tbl_goodsinpack_grid->RowIndex ?>_ID_packingDetail" id="x<?php echo $tbl_goodsinpack_grid->RowIndex ?>_ID_packingDetail" value="<?php echo HtmlEncode($tbl_goodsinpack->ID_packingDetail->CurrentValue) ?>">
<input type="hidden" data-table="tbl_goodsinpack" data-field="x_ID_packingDetail" name="o<?php echo $tbl_goodsinpack_grid->RowIndex ?>_ID_packingDetail" id="o<?php echo $tbl_goodsinpack_grid->RowIndex ?>_ID_packingDetail" value="<?php echo HtmlEncode($tbl_goodsinpack->ID_packingDetail->OldValue) ?>">
<?php } ?>
<?php if ($tbl_goodsinpack->RowType == ROWTYPE_EDIT || $tbl_goodsinpack->CurrentMode == "edit") { ?>
<input type="hidden" data-table="tbl_goodsinpack" data-field="x_ID_packingDetail" name="x<?php echo $tbl_goodsinpack_grid->RowIndex ?>_ID_packingDetail" id="x<?php echo $tbl_goodsinpack_grid->RowIndex ?>_ID_packingDetail" value="<?php echo HtmlEncode($tbl_goodsinpack->ID_packingDetail->CurrentValue) ?>">
<?php } ?>
	<?php if ($tbl_goodsinpack->PCS->Visible) { // PCS ?>
		<td data-name="PCS"<?php echo $tbl_goodsinpack->PCS->cellAttributes() ?>>
<?php if ($tbl_goodsinpack->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $tbl_goodsinpack_grid->RowCnt ?>_tbl_goodsinpack_PCS" class="form-group tbl_goodsinpack_PCS">
<input type="text" data-table="tbl_goodsinpack" data-field="x_PCS" name="x<?php echo $tbl_goodsinpack_grid->RowIndex ?>_PCS" id="x<?php echo $tbl_goodsinpack_grid->RowIndex ?>_PCS" size="30" placeholder="<?php echo HtmlEncode($tbl_goodsinpack->PCS->getPlaceHolder()) ?>" value="<?php echo $tbl_goodsinpack->PCS->EditValue ?>"<?php echo $tbl_goodsinpack->PCS->editAttributes() ?>>
</span>
<input type="hidden" data-table="tbl_goodsinpack" data-field="x_PCS" name="o<?php echo $tbl_goodsinpack_grid->RowIndex ?>_PCS" id="o<?php echo $tbl_goodsinpack_grid->RowIndex ?>_PCS" value="<?php echo HtmlEncode($tbl_goodsinpack->PCS->OldValue) ?>">
<?php } ?>
<?php if ($tbl_goodsinpack->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $tbl_goodsinpack_grid->RowCnt ?>_tbl_goodsinpack_PCS" class="form-group tbl_goodsinpack_PCS">
<input type="text" data-table="tbl_goodsinpack" data-field="x_PCS" name="x<?php echo $tbl_goodsinpack_grid->RowIndex ?>_PCS" id="x<?php echo $tbl_goodsinpack_grid->RowIndex ?>_PCS" size="30" placeholder="<?php echo HtmlEncode($tbl_goodsinpack->PCS->getPlaceHolder()) ?>" value="<?php echo $tbl_goodsinpack->PCS->EditValue ?>"<?php echo $tbl_goodsinpack->PCS->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($tbl_goodsinpack->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $tbl_goodsinpack_grid->RowCnt ?>_tbl_goodsinpack_PCS" class="tbl_goodsinpack_PCS">
<span<?php echo $tbl_goodsinpack->PCS->viewAttributes() ?>>
<?php echo $tbl_goodsinpack->PCS->getViewValue() ?></span>
</span>
<?php if (!$tbl_goodsinpack->isConfirm()) { ?>
<input type="hidden" data-table="tbl_goodsinpack" data-field="x_PCS" name="x<?php echo $tbl_goodsinpack_grid->RowIndex ?>_PCS" id="x<?php echo $tbl_goodsinpack_grid->RowIndex ?>_PCS" value="<?php echo HtmlEncode($tbl_goodsinpack->PCS->FormValue) ?>">
<input type="hidden" data-table="tbl_goodsinpack" data-field="x_PCS" name="o<?php echo $tbl_goodsinpack_grid->RowIndex ?>_PCS" id="o<?php echo $tbl_goodsinpack_grid->RowIndex ?>_PCS" value="<?php echo HtmlEncode($tbl_goodsinpack->PCS->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="tbl_goodsinpack" data-field="x_PCS" name="ftbl_goodsinpackgrid$x<?php echo $tbl_goodsinpack_grid->RowIndex ?>_PCS" id="ftbl_goodsinpackgrid$x<?php echo $tbl_goodsinpack_grid->RowIndex ?>_PCS" value="<?php echo HtmlEncode($tbl_goodsinpack->PCS->FormValue) ?>">
<input type="hidden" data-table="tbl_goodsinpack" data-field="x_PCS" name="ftbl_goodsinpackgrid$o<?php echo $tbl_goodsinpack_grid->RowIndex ?>_PCS" id="ftbl_goodsinpackgrid$o<?php echo $tbl_goodsinpack_grid->RowIndex ?>_PCS" value="<?php echo HtmlEncode($tbl_goodsinpack->PCS->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($tbl_goodsinpack->CreateUser->Visible) { // CreateUser ?>
		<td data-name="CreateUser"<?php echo $tbl_goodsinpack->CreateUser->cellAttributes() ?>>
<?php if ($tbl_goodsinpack->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $tbl_goodsinpack_grid->RowCnt ?>_tbl_goodsinpack_CreateUser" class="form-group tbl_goodsinpack_CreateUser">
<input type="text" data-table="tbl_goodsinpack" data-field="x_CreateUser" name="x<?php echo $tbl_goodsinpack_grid->RowIndex ?>_CreateUser" id="x<?php echo $tbl_goodsinpack_grid->RowIndex ?>_CreateUser" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($tbl_goodsinpack->CreateUser->getPlaceHolder()) ?>" value="<?php echo $tbl_goodsinpack->CreateUser->EditValue ?>"<?php echo $tbl_goodsinpack->CreateUser->editAttributes() ?>>
</span>
<input type="hidden" data-table="tbl_goodsinpack" data-field="x_CreateUser" name="o<?php echo $tbl_goodsinpack_grid->RowIndex ?>_CreateUser" id="o<?php echo $tbl_goodsinpack_grid->RowIndex ?>_CreateUser" value="<?php echo HtmlEncode($tbl_goodsinpack->CreateUser->OldValue) ?>">
<?php } ?>
<?php if ($tbl_goodsinpack->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $tbl_goodsinpack_grid->RowCnt ?>_tbl_goodsinpack_CreateUser" class="form-group tbl_goodsinpack_CreateUser">
<input type="text" data-table="tbl_goodsinpack" data-field="x_CreateUser" name="x<?php echo $tbl_goodsinpack_grid->RowIndex ?>_CreateUser" id="x<?php echo $tbl_goodsinpack_grid->RowIndex ?>_CreateUser" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($tbl_goodsinpack->CreateUser->getPlaceHolder()) ?>" value="<?php echo $tbl_goodsinpack->CreateUser->EditValue ?>"<?php echo $tbl_goodsinpack->CreateUser->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($tbl_goodsinpack->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $tbl_goodsinpack_grid->RowCnt ?>_tbl_goodsinpack_CreateUser" class="tbl_goodsinpack_CreateUser">
<span<?php echo $tbl_goodsinpack->CreateUser->viewAttributes() ?>>
<?php echo $tbl_goodsinpack->CreateUser->getViewValue() ?></span>
</span>
<?php if (!$tbl_goodsinpack->isConfirm()) { ?>
<input type="hidden" data-table="tbl_goodsinpack" data-field="x_CreateUser" name="x<?php echo $tbl_goodsinpack_grid->RowIndex ?>_CreateUser" id="x<?php echo $tbl_goodsinpack_grid->RowIndex ?>_CreateUser" value="<?php echo HtmlEncode($tbl_goodsinpack->CreateUser->FormValue) ?>">
<input type="hidden" data-table="tbl_goodsinpack" data-field="x_CreateUser" name="o<?php echo $tbl_goodsinpack_grid->RowIndex ?>_CreateUser" id="o<?php echo $tbl_goodsinpack_grid->RowIndex ?>_CreateUser" value="<?php echo HtmlEncode($tbl_goodsinpack->CreateUser->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="tbl_goodsinpack" data-field="x_CreateUser" name="ftbl_goodsinpackgrid$x<?php echo $tbl_goodsinpack_grid->RowIndex ?>_CreateUser" id="ftbl_goodsinpackgrid$x<?php echo $tbl_goodsinpack_grid->RowIndex ?>_CreateUser" value="<?php echo HtmlEncode($tbl_goodsinpack->CreateUser->FormValue) ?>">
<input type="hidden" data-table="tbl_goodsinpack" data-field="x_CreateUser" name="ftbl_goodsinpackgrid$o<?php echo $tbl_goodsinpack_grid->RowIndex ?>_CreateUser" id="ftbl_goodsinpackgrid$o<?php echo $tbl_goodsinpack_grid->RowIndex ?>_CreateUser" value="<?php echo HtmlEncode($tbl_goodsinpack->CreateUser->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($tbl_goodsinpack->CreateDate->Visible) { // CreateDate ?>
		<td data-name="CreateDate"<?php echo $tbl_goodsinpack->CreateDate->cellAttributes() ?>>
<?php if ($tbl_goodsinpack->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $tbl_goodsinpack_grid->RowCnt ?>_tbl_goodsinpack_CreateDate" class="form-group tbl_goodsinpack_CreateDate">
<input type="text" data-table="tbl_goodsinpack" data-field="x_CreateDate" name="x<?php echo $tbl_goodsinpack_grid->RowIndex ?>_CreateDate" id="x<?php echo $tbl_goodsinpack_grid->RowIndex ?>_CreateDate" placeholder="<?php echo HtmlEncode($tbl_goodsinpack->CreateDate->getPlaceHolder()) ?>" value="<?php echo $tbl_goodsinpack->CreateDate->EditValue ?>"<?php echo $tbl_goodsinpack->CreateDate->editAttributes() ?>>
<?php if (!$tbl_goodsinpack->CreateDate->ReadOnly && !$tbl_goodsinpack->CreateDate->Disabled && !isset($tbl_goodsinpack->CreateDate->EditAttrs["readonly"]) && !isset($tbl_goodsinpack->CreateDate->EditAttrs["disabled"])) { ?>
<script>
ew.createDateTimePicker("ftbl_goodsinpackgrid", "x<?php echo $tbl_goodsinpack_grid->RowIndex ?>_CreateDate", {"ignoreReadonly":true,"useCurrent":false,"format":0});
</script>
<?php } ?>
</span>
<input type="hidden" data-table="tbl_goodsinpack" data-field="x_CreateDate" name="o<?php echo $tbl_goodsinpack_grid->RowIndex ?>_CreateDate" id="o<?php echo $tbl_goodsinpack_grid->RowIndex ?>_CreateDate" value="<?php echo HtmlEncode($tbl_goodsinpack->CreateDate->OldValue) ?>">
<?php } ?>
<?php if ($tbl_goodsinpack->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $tbl_goodsinpack_grid->RowCnt ?>_tbl_goodsinpack_CreateDate" class="form-group tbl_goodsinpack_CreateDate">
<input type="text" data-table="tbl_goodsinpack" data-field="x_CreateDate" name="x<?php echo $tbl_goodsinpack_grid->RowIndex ?>_CreateDate" id="x<?php echo $tbl_goodsinpack_grid->RowIndex ?>_CreateDate" placeholder="<?php echo HtmlEncode($tbl_goodsinpack->CreateDate->getPlaceHolder()) ?>" value="<?php echo $tbl_goodsinpack->CreateDate->EditValue ?>"<?php echo $tbl_goodsinpack->CreateDate->editAttributes() ?>>
<?php if (!$tbl_goodsinpack->CreateDate->ReadOnly && !$tbl_goodsinpack->CreateDate->Disabled && !isset($tbl_goodsinpack->CreateDate->EditAttrs["readonly"]) && !isset($tbl_goodsinpack->CreateDate->EditAttrs["disabled"])) { ?>
<script>
ew.createDateTimePicker("ftbl_goodsinpackgrid", "x<?php echo $tbl_goodsinpack_grid->RowIndex ?>_CreateDate", {"ignoreReadonly":true,"useCurrent":false,"format":0});
</script>
<?php } ?>
</span>
<?php } ?>
<?php if ($tbl_goodsinpack->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $tbl_goodsinpack_grid->RowCnt ?>_tbl_goodsinpack_CreateDate" class="tbl_goodsinpack_CreateDate">
<span<?php echo $tbl_goodsinpack->CreateDate->viewAttributes() ?>>
<?php echo $tbl_goodsinpack->CreateDate->getViewValue() ?></span>
</span>
<?php if (!$tbl_goodsinpack->isConfirm()) { ?>
<input type="hidden" data-table="tbl_goodsinpack" data-field="x_CreateDate" name="x<?php echo $tbl_goodsinpack_grid->RowIndex ?>_CreateDate" id="x<?php echo $tbl_goodsinpack_grid->RowIndex ?>_CreateDate" value="<?php echo HtmlEncode($tbl_goodsinpack->CreateDate->FormValue) ?>">
<input type="hidden" data-table="tbl_goodsinpack" data-field="x_CreateDate" name="o<?php echo $tbl_goodsinpack_grid->RowIndex ?>_CreateDate" id="o<?php echo $tbl_goodsinpack_grid->RowIndex ?>_CreateDate" value="<?php echo HtmlEncode($tbl_goodsinpack->CreateDate->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="tbl_goodsinpack" data-field="x_CreateDate" name="ftbl_goodsinpackgrid$x<?php echo $tbl_goodsinpack_grid->RowIndex ?>_CreateDate" id="ftbl_goodsinpackgrid$x<?php echo $tbl_goodsinpack_grid->RowIndex ?>_CreateDate" value="<?php echo HtmlEncode($tbl_goodsinpack->CreateDate->FormValue) ?>">
<input type="hidden" data-table="tbl_goodsinpack" data-field="x_CreateDate" name="ftbl_goodsinpackgrid$o<?php echo $tbl_goodsinpack_grid->RowIndex ?>_CreateDate" id="ftbl_goodsinpackgrid$o<?php echo $tbl_goodsinpack_grid->RowIndex ?>_CreateDate" value="<?php echo HtmlEncode($tbl_goodsinpack->CreateDate->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($tbl_goodsinpack->UpdateUser->Visible) { // UpdateUser ?>
		<td data-name="UpdateUser"<?php echo $tbl_goodsinpack->UpdateUser->cellAttributes() ?>>
<?php if ($tbl_goodsinpack->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $tbl_goodsinpack_grid->RowCnt ?>_tbl_goodsinpack_UpdateUser" class="form-group tbl_goodsinpack_UpdateUser">
<input type="text" data-table="tbl_goodsinpack" data-field="x_UpdateUser" name="x<?php echo $tbl_goodsinpack_grid->RowIndex ?>_UpdateUser" id="x<?php echo $tbl_goodsinpack_grid->RowIndex ?>_UpdateUser" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($tbl_goodsinpack->UpdateUser->getPlaceHolder()) ?>" value="<?php echo $tbl_goodsinpack->UpdateUser->EditValue ?>"<?php echo $tbl_goodsinpack->UpdateUser->editAttributes() ?>>
</span>
<input type="hidden" data-table="tbl_goodsinpack" data-field="x_UpdateUser" name="o<?php echo $tbl_goodsinpack_grid->RowIndex ?>_UpdateUser" id="o<?php echo $tbl_goodsinpack_grid->RowIndex ?>_UpdateUser" value="<?php echo HtmlEncode($tbl_goodsinpack->UpdateUser->OldValue) ?>">
<?php } ?>
<?php if ($tbl_goodsinpack->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $tbl_goodsinpack_grid->RowCnt ?>_tbl_goodsinpack_UpdateUser" class="form-group tbl_goodsinpack_UpdateUser">
<input type="text" data-table="tbl_goodsinpack" data-field="x_UpdateUser" name="x<?php echo $tbl_goodsinpack_grid->RowIndex ?>_UpdateUser" id="x<?php echo $tbl_goodsinpack_grid->RowIndex ?>_UpdateUser" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($tbl_goodsinpack->UpdateUser->getPlaceHolder()) ?>" value="<?php echo $tbl_goodsinpack->UpdateUser->EditValue ?>"<?php echo $tbl_goodsinpack->UpdateUser->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($tbl_goodsinpack->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $tbl_goodsinpack_grid->RowCnt ?>_tbl_goodsinpack_UpdateUser" class="tbl_goodsinpack_UpdateUser">
<span<?php echo $tbl_goodsinpack->UpdateUser->viewAttributes() ?>>
<?php echo $tbl_goodsinpack->UpdateUser->getViewValue() ?></span>
</span>
<?php if (!$tbl_goodsinpack->isConfirm()) { ?>
<input type="hidden" data-table="tbl_goodsinpack" data-field="x_UpdateUser" name="x<?php echo $tbl_goodsinpack_grid->RowIndex ?>_UpdateUser" id="x<?php echo $tbl_goodsinpack_grid->RowIndex ?>_UpdateUser" value="<?php echo HtmlEncode($tbl_goodsinpack->UpdateUser->FormValue) ?>">
<input type="hidden" data-table="tbl_goodsinpack" data-field="x_UpdateUser" name="o<?php echo $tbl_goodsinpack_grid->RowIndex ?>_UpdateUser" id="o<?php echo $tbl_goodsinpack_grid->RowIndex ?>_UpdateUser" value="<?php echo HtmlEncode($tbl_goodsinpack->UpdateUser->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="tbl_goodsinpack" data-field="x_UpdateUser" name="ftbl_goodsinpackgrid$x<?php echo $tbl_goodsinpack_grid->RowIndex ?>_UpdateUser" id="ftbl_goodsinpackgrid$x<?php echo $tbl_goodsinpack_grid->RowIndex ?>_UpdateUser" value="<?php echo HtmlEncode($tbl_goodsinpack->UpdateUser->FormValue) ?>">
<input type="hidden" data-table="tbl_goodsinpack" data-field="x_UpdateUser" name="ftbl_goodsinpackgrid$o<?php echo $tbl_goodsinpack_grid->RowIndex ?>_UpdateUser" id="ftbl_goodsinpackgrid$o<?php echo $tbl_goodsinpack_grid->RowIndex ?>_UpdateUser" value="<?php echo HtmlEncode($tbl_goodsinpack->UpdateUser->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($tbl_goodsinpack->UpdateDatetime->Visible) { // UpdateDatetime ?>
		<td data-name="UpdateDatetime"<?php echo $tbl_goodsinpack->UpdateDatetime->cellAttributes() ?>>
<?php if ($tbl_goodsinpack->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $tbl_goodsinpack_grid->RowCnt ?>_tbl_goodsinpack_UpdateDatetime" class="form-group tbl_goodsinpack_UpdateDatetime">
<input type="text" data-table="tbl_goodsinpack" data-field="x_UpdateDatetime" name="x<?php echo $tbl_goodsinpack_grid->RowIndex ?>_UpdateDatetime" id="x<?php echo $tbl_goodsinpack_grid->RowIndex ?>_UpdateDatetime" placeholder="<?php echo HtmlEncode($tbl_goodsinpack->UpdateDatetime->getPlaceHolder()) ?>" value="<?php echo $tbl_goodsinpack->UpdateDatetime->EditValue ?>"<?php echo $tbl_goodsinpack->UpdateDatetime->editAttributes() ?>>
<?php if (!$tbl_goodsinpack->UpdateDatetime->ReadOnly && !$tbl_goodsinpack->UpdateDatetime->Disabled && !isset($tbl_goodsinpack->UpdateDatetime->EditAttrs["readonly"]) && !isset($tbl_goodsinpack->UpdateDatetime->EditAttrs["disabled"])) { ?>
<script>
ew.createDateTimePicker("ftbl_goodsinpackgrid", "x<?php echo $tbl_goodsinpack_grid->RowIndex ?>_UpdateDatetime", {"ignoreReadonly":true,"useCurrent":false,"format":0});
</script>
<?php } ?>
</span>
<input type="hidden" data-table="tbl_goodsinpack" data-field="x_UpdateDatetime" name="o<?php echo $tbl_goodsinpack_grid->RowIndex ?>_UpdateDatetime" id="o<?php echo $tbl_goodsinpack_grid->RowIndex ?>_UpdateDatetime" value="<?php echo HtmlEncode($tbl_goodsinpack->UpdateDatetime->OldValue) ?>">
<?php } ?>
<?php if ($tbl_goodsinpack->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $tbl_goodsinpack_grid->RowCnt ?>_tbl_goodsinpack_UpdateDatetime" class="form-group tbl_goodsinpack_UpdateDatetime">
<input type="text" data-table="tbl_goodsinpack" data-field="x_UpdateDatetime" name="x<?php echo $tbl_goodsinpack_grid->RowIndex ?>_UpdateDatetime" id="x<?php echo $tbl_goodsinpack_grid->RowIndex ?>_UpdateDatetime" placeholder="<?php echo HtmlEncode($tbl_goodsinpack->UpdateDatetime->getPlaceHolder()) ?>" value="<?php echo $tbl_goodsinpack->UpdateDatetime->EditValue ?>"<?php echo $tbl_goodsinpack->UpdateDatetime->editAttributes() ?>>
<?php if (!$tbl_goodsinpack->UpdateDatetime->ReadOnly && !$tbl_goodsinpack->UpdateDatetime->Disabled && !isset($tbl_goodsinpack->UpdateDatetime->EditAttrs["readonly"]) && !isset($tbl_goodsinpack->UpdateDatetime->EditAttrs["disabled"])) { ?>
<script>
ew.createDateTimePicker("ftbl_goodsinpackgrid", "x<?php echo $tbl_goodsinpack_grid->RowIndex ?>_UpdateDatetime", {"ignoreReadonly":true,"useCurrent":false,"format":0});
</script>
<?php } ?>
</span>
<?php } ?>
<?php if ($tbl_goodsinpack->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $tbl_goodsinpack_grid->RowCnt ?>_tbl_goodsinpack_UpdateDatetime" class="tbl_goodsinpack_UpdateDatetime">
<span<?php echo $tbl_goodsinpack->UpdateDatetime->viewAttributes() ?>>
<?php echo $tbl_goodsinpack->UpdateDatetime->getViewValue() ?></span>
</span>
<?php if (!$tbl_goodsinpack->isConfirm()) { ?>
<input type="hidden" data-table="tbl_goodsinpack" data-field="x_UpdateDatetime" name="x<?php echo $tbl_goodsinpack_grid->RowIndex ?>_UpdateDatetime" id="x<?php echo $tbl_goodsinpack_grid->RowIndex ?>_UpdateDatetime" value="<?php echo HtmlEncode($tbl_goodsinpack->UpdateDatetime->FormValue) ?>">
<input type="hidden" data-table="tbl_goodsinpack" data-field="x_UpdateDatetime" name="o<?php echo $tbl_goodsinpack_grid->RowIndex ?>_UpdateDatetime" id="o<?php echo $tbl_goodsinpack_grid->RowIndex ?>_UpdateDatetime" value="<?php echo HtmlEncode($tbl_goodsinpack->UpdateDatetime->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="tbl_goodsinpack" data-field="x_UpdateDatetime" name="ftbl_goodsinpackgrid$x<?php echo $tbl_goodsinpack_grid->RowIndex ?>_UpdateDatetime" id="ftbl_goodsinpackgrid$x<?php echo $tbl_goodsinpack_grid->RowIndex ?>_UpdateDatetime" value="<?php echo HtmlEncode($tbl_goodsinpack->UpdateDatetime->FormValue) ?>">
<input type="hidden" data-table="tbl_goodsinpack" data-field="x_UpdateDatetime" name="ftbl_goodsinpackgrid$o<?php echo $tbl_goodsinpack_grid->RowIndex ?>_UpdateDatetime" id="ftbl_goodsinpackgrid$o<?php echo $tbl_goodsinpack_grid->RowIndex ?>_UpdateDatetime" value="<?php echo HtmlEncode($tbl_goodsinpack->UpdateDatetime->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$tbl_goodsinpack_grid->ListOptions->render("body", "right", $tbl_goodsinpack_grid->RowCnt);
?>
	</tr>
<?php if ($tbl_goodsinpack->RowType == ROWTYPE_ADD || $tbl_goodsinpack->RowType == ROWTYPE_EDIT) { ?>
<script>
ftbl_goodsinpackgrid.updateLists(<?php echo $tbl_goodsinpack_grid->RowIndex ?>);
</script>
<?php } ?>
<?php
	}
	} // End delete row checking
	if (!$tbl_goodsinpack->isGridAdd() || $tbl_goodsinpack->CurrentMode == "copy")
		if (!$tbl_goodsinpack_grid->Recordset->EOF)
			$tbl_goodsinpack_grid->Recordset->moveNext();
}
?>
<?php
	if ($tbl_goodsinpack->CurrentMode == "add" || $tbl_goodsinpack->CurrentMode == "copy" || $tbl_goodsinpack->CurrentMode == "edit") {
		$tbl_goodsinpack_grid->RowIndex = '$rowindex$';
		$tbl_goodsinpack_grid->loadRowValues();

		// Set row properties
		$tbl_goodsinpack->resetAttributes();
		$tbl_goodsinpack->RowAttrs = array_merge($tbl_goodsinpack->RowAttrs, array('data-rowindex'=>$tbl_goodsinpack_grid->RowIndex, 'id'=>'r0_tbl_goodsinpack', 'data-rowtype'=>ROWTYPE_ADD));
		AppendClass($tbl_goodsinpack->RowAttrs["class"], "ew-template");
		$tbl_goodsinpack->RowType = ROWTYPE_ADD;

		// Render row
		$tbl_goodsinpack_grid->renderRow();

		// Render list options
		$tbl_goodsinpack_grid->renderListOptions();
		$tbl_goodsinpack_grid->StartRowCnt = 0;
?>
	<tr<?php echo $tbl_goodsinpack->rowAttributes() ?>>
<?php

// Render list options (body, left)
$tbl_goodsinpack_grid->ListOptions->render("body", "left", $tbl_goodsinpack_grid->RowIndex);
?>
	<?php if ($tbl_goodsinpack->Code->Visible) { // Code ?>
		<td data-name="Code">
<?php if (!$tbl_goodsinpack->isConfirm()) { ?>
<span id="el$rowindex$_tbl_goodsinpack_Code" class="form-group tbl_goodsinpack_Code">
<input type="text" data-table="tbl_goodsinpack" data-field="x_Code" name="x<?php echo $tbl_goodsinpack_grid->RowIndex ?>_Code" id="x<?php echo $tbl_goodsinpack_grid->RowIndex ?>_Code" size="30" maxlength="55" placeholder="<?php echo HtmlEncode($tbl_goodsinpack->Code->getPlaceHolder()) ?>" value="<?php echo $tbl_goodsinpack->Code->EditValue ?>"<?php echo $tbl_goodsinpack->Code->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_tbl_goodsinpack_Code" class="form-group tbl_goodsinpack_Code">
<span<?php echo $tbl_goodsinpack->Code->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?php echo RemoveHtml($tbl_goodsinpack->Code->ViewValue) ?>"></span>
</span>
<input type="hidden" data-table="tbl_goodsinpack" data-field="x_Code" name="x<?php echo $tbl_goodsinpack_grid->RowIndex ?>_Code" id="x<?php echo $tbl_goodsinpack_grid->RowIndex ?>_Code" value="<?php echo HtmlEncode($tbl_goodsinpack->Code->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="tbl_goodsinpack" data-field="x_Code" name="o<?php echo $tbl_goodsinpack_grid->RowIndex ?>_Code" id="o<?php echo $tbl_goodsinpack_grid->RowIndex ?>_Code" value="<?php echo HtmlEncode($tbl_goodsinpack->Code->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($tbl_goodsinpack->PCS->Visible) { // PCS ?>
		<td data-name="PCS">
<?php if (!$tbl_goodsinpack->isConfirm()) { ?>
<span id="el$rowindex$_tbl_goodsinpack_PCS" class="form-group tbl_goodsinpack_PCS">
<input type="text" data-table="tbl_goodsinpack" data-field="x_PCS" name="x<?php echo $tbl_goodsinpack_grid->RowIndex ?>_PCS" id="x<?php echo $tbl_goodsinpack_grid->RowIndex ?>_PCS" size="30" placeholder="<?php echo HtmlEncode($tbl_goodsinpack->PCS->getPlaceHolder()) ?>" value="<?php echo $tbl_goodsinpack->PCS->EditValue ?>"<?php echo $tbl_goodsinpack->PCS->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_tbl_goodsinpack_PCS" class="form-group tbl_goodsinpack_PCS">
<span<?php echo $tbl_goodsinpack->PCS->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?php echo RemoveHtml($tbl_goodsinpack->PCS->ViewValue) ?>"></span>
</span>
<input type="hidden" data-table="tbl_goodsinpack" data-field="x_PCS" name="x<?php echo $tbl_goodsinpack_grid->RowIndex ?>_PCS" id="x<?php echo $tbl_goodsinpack_grid->RowIndex ?>_PCS" value="<?php echo HtmlEncode($tbl_goodsinpack->PCS->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="tbl_goodsinpack" data-field="x_PCS" name="o<?php echo $tbl_goodsinpack_grid->RowIndex ?>_PCS" id="o<?php echo $tbl_goodsinpack_grid->RowIndex ?>_PCS" value="<?php echo HtmlEncode($tbl_goodsinpack->PCS->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($tbl_goodsinpack->CreateUser->Visible) { // CreateUser ?>
		<td data-name="CreateUser">
<?php if (!$tbl_goodsinpack->isConfirm()) { ?>
<span id="el$rowindex$_tbl_goodsinpack_CreateUser" class="form-group tbl_goodsinpack_CreateUser">
<input type="text" data-table="tbl_goodsinpack" data-field="x_CreateUser" name="x<?php echo $tbl_goodsinpack_grid->RowIndex ?>_CreateUser" id="x<?php echo $tbl_goodsinpack_grid->RowIndex ?>_CreateUser" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($tbl_goodsinpack->CreateUser->getPlaceHolder()) ?>" value="<?php echo $tbl_goodsinpack->CreateUser->EditValue ?>"<?php echo $tbl_goodsinpack->CreateUser->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_tbl_goodsinpack_CreateUser" class="form-group tbl_goodsinpack_CreateUser">
<span<?php echo $tbl_goodsinpack->CreateUser->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?php echo RemoveHtml($tbl_goodsinpack->CreateUser->ViewValue) ?>"></span>
</span>
<input type="hidden" data-table="tbl_goodsinpack" data-field="x_CreateUser" name="x<?php echo $tbl_goodsinpack_grid->RowIndex ?>_CreateUser" id="x<?php echo $tbl_goodsinpack_grid->RowIndex ?>_CreateUser" value="<?php echo HtmlEncode($tbl_goodsinpack->CreateUser->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="tbl_goodsinpack" data-field="x_CreateUser" name="o<?php echo $tbl_goodsinpack_grid->RowIndex ?>_CreateUser" id="o<?php echo $tbl_goodsinpack_grid->RowIndex ?>_CreateUser" value="<?php echo HtmlEncode($tbl_goodsinpack->CreateUser->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($tbl_goodsinpack->CreateDate->Visible) { // CreateDate ?>
		<td data-name="CreateDate">
<?php if (!$tbl_goodsinpack->isConfirm()) { ?>
<span id="el$rowindex$_tbl_goodsinpack_CreateDate" class="form-group tbl_goodsinpack_CreateDate">
<input type="text" data-table="tbl_goodsinpack" data-field="x_CreateDate" name="x<?php echo $tbl_goodsinpack_grid->RowIndex ?>_CreateDate" id="x<?php echo $tbl_goodsinpack_grid->RowIndex ?>_CreateDate" placeholder="<?php echo HtmlEncode($tbl_goodsinpack->CreateDate->getPlaceHolder()) ?>" value="<?php echo $tbl_goodsinpack->CreateDate->EditValue ?>"<?php echo $tbl_goodsinpack->CreateDate->editAttributes() ?>>
<?php if (!$tbl_goodsinpack->CreateDate->ReadOnly && !$tbl_goodsinpack->CreateDate->Disabled && !isset($tbl_goodsinpack->CreateDate->EditAttrs["readonly"]) && !isset($tbl_goodsinpack->CreateDate->EditAttrs["disabled"])) { ?>
<script>
ew.createDateTimePicker("ftbl_goodsinpackgrid", "x<?php echo $tbl_goodsinpack_grid->RowIndex ?>_CreateDate", {"ignoreReadonly":true,"useCurrent":false,"format":0});
</script>
<?php } ?>
</span>
<?php } else { ?>
<span id="el$rowindex$_tbl_goodsinpack_CreateDate" class="form-group tbl_goodsinpack_CreateDate">
<span<?php echo $tbl_goodsinpack->CreateDate->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?php echo RemoveHtml($tbl_goodsinpack->CreateDate->ViewValue) ?>"></span>
</span>
<input type="hidden" data-table="tbl_goodsinpack" data-field="x_CreateDate" name="x<?php echo $tbl_goodsinpack_grid->RowIndex ?>_CreateDate" id="x<?php echo $tbl_goodsinpack_grid->RowIndex ?>_CreateDate" value="<?php echo HtmlEncode($tbl_goodsinpack->CreateDate->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="tbl_goodsinpack" data-field="x_CreateDate" name="o<?php echo $tbl_goodsinpack_grid->RowIndex ?>_CreateDate" id="o<?php echo $tbl_goodsinpack_grid->RowIndex ?>_CreateDate" value="<?php echo HtmlEncode($tbl_goodsinpack->CreateDate->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($tbl_goodsinpack->UpdateUser->Visible) { // UpdateUser ?>
		<td data-name="UpdateUser">
<?php if (!$tbl_goodsinpack->isConfirm()) { ?>
<span id="el$rowindex$_tbl_goodsinpack_UpdateUser" class="form-group tbl_goodsinpack_UpdateUser">
<input type="text" data-table="tbl_goodsinpack" data-field="x_UpdateUser" name="x<?php echo $tbl_goodsinpack_grid->RowIndex ?>_UpdateUser" id="x<?php echo $tbl_goodsinpack_grid->RowIndex ?>_UpdateUser" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($tbl_goodsinpack->UpdateUser->getPlaceHolder()) ?>" value="<?php echo $tbl_goodsinpack->UpdateUser->EditValue ?>"<?php echo $tbl_goodsinpack->UpdateUser->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_tbl_goodsinpack_UpdateUser" class="form-group tbl_goodsinpack_UpdateUser">
<span<?php echo $tbl_goodsinpack->UpdateUser->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?php echo RemoveHtml($tbl_goodsinpack->UpdateUser->ViewValue) ?>"></span>
</span>
<input type="hidden" data-table="tbl_goodsinpack" data-field="x_UpdateUser" name="x<?php echo $tbl_goodsinpack_grid->RowIndex ?>_UpdateUser" id="x<?php echo $tbl_goodsinpack_grid->RowIndex ?>_UpdateUser" value="<?php echo HtmlEncode($tbl_goodsinpack->UpdateUser->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="tbl_goodsinpack" data-field="x_UpdateUser" name="o<?php echo $tbl_goodsinpack_grid->RowIndex ?>_UpdateUser" id="o<?php echo $tbl_goodsinpack_grid->RowIndex ?>_UpdateUser" value="<?php echo HtmlEncode($tbl_goodsinpack->UpdateUser->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($tbl_goodsinpack->UpdateDatetime->Visible) { // UpdateDatetime ?>
		<td data-name="UpdateDatetime">
<?php if (!$tbl_goodsinpack->isConfirm()) { ?>
<span id="el$rowindex$_tbl_goodsinpack_UpdateDatetime" class="form-group tbl_goodsinpack_UpdateDatetime">
<input type="text" data-table="tbl_goodsinpack" data-field="x_UpdateDatetime" name="x<?php echo $tbl_goodsinpack_grid->RowIndex ?>_UpdateDatetime" id="x<?php echo $tbl_goodsinpack_grid->RowIndex ?>_UpdateDatetime" placeholder="<?php echo HtmlEncode($tbl_goodsinpack->UpdateDatetime->getPlaceHolder()) ?>" value="<?php echo $tbl_goodsinpack->UpdateDatetime->EditValue ?>"<?php echo $tbl_goodsinpack->UpdateDatetime->editAttributes() ?>>
<?php if (!$tbl_goodsinpack->UpdateDatetime->ReadOnly && !$tbl_goodsinpack->UpdateDatetime->Disabled && !isset($tbl_goodsinpack->UpdateDatetime->EditAttrs["readonly"]) && !isset($tbl_goodsinpack->UpdateDatetime->EditAttrs["disabled"])) { ?>
<script>
ew.createDateTimePicker("ftbl_goodsinpackgrid", "x<?php echo $tbl_goodsinpack_grid->RowIndex ?>_UpdateDatetime", {"ignoreReadonly":true,"useCurrent":false,"format":0});
</script>
<?php } ?>
</span>
<?php } else { ?>
<span id="el$rowindex$_tbl_goodsinpack_UpdateDatetime" class="form-group tbl_goodsinpack_UpdateDatetime">
<span<?php echo $tbl_goodsinpack->UpdateDatetime->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?php echo RemoveHtml($tbl_goodsinpack->UpdateDatetime->ViewValue) ?>"></span>
</span>
<input type="hidden" data-table="tbl_goodsinpack" data-field="x_UpdateDatetime" name="x<?php echo $tbl_goodsinpack_grid->RowIndex ?>_UpdateDatetime" id="x<?php echo $tbl_goodsinpack_grid->RowIndex ?>_UpdateDatetime" value="<?php echo HtmlEncode($tbl_goodsinpack->UpdateDatetime->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="tbl_goodsinpack" data-field="x_UpdateDatetime" name="o<?php echo $tbl_goodsinpack_grid->RowIndex ?>_UpdateDatetime" id="o<?php echo $tbl_goodsinpack_grid->RowIndex ?>_UpdateDatetime" value="<?php echo HtmlEncode($tbl_goodsinpack->UpdateDatetime->OldValue) ?>">
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$tbl_goodsinpack_grid->ListOptions->render("body", "right", $tbl_goodsinpack_grid->RowIndex);
?>
<script>
ftbl_goodsinpackgrid.updateLists(<?php echo $tbl_goodsinpack_grid->RowIndex ?>);
</script>
	</tr>
<?php
}
?>
</tbody>
<?php

// Render aggregate row
$tbl_goodsinpack->RowType = ROWTYPE_AGGREGATE;
$tbl_goodsinpack->resetAttributes();
$tbl_goodsinpack_grid->renderRow();
?>
<?php if ($tbl_goodsinpack_grid->TotalRecs > 0 && $tbl_goodsinpack->CurrentMode == "view") { ?>
<tfoot><!-- Table footer -->
	<tr class="ew-table-footer">
<?php

// Render list options
$tbl_goodsinpack_grid->renderListOptions();

// Render list options (footer, left)
$tbl_goodsinpack_grid->ListOptions->render("footer", "left");
?>
	<?php if ($tbl_goodsinpack->Code->Visible) { // Code ?>
		<td data-name="Code" class="<?php echo $tbl_goodsinpack->Code->footerCellClass() ?>"><span id="elf_tbl_goodsinpack_Code" class="tbl_goodsinpack_Code">
		&nbsp;
		</span></td>
	<?php } ?>
	<?php if ($tbl_goodsinpack->PCS->Visible) { // PCS ?>
		<td data-name="PCS" class="<?php echo $tbl_goodsinpack->PCS->footerCellClass() ?>"><span id="elf_tbl_goodsinpack_PCS" class="tbl_goodsinpack_PCS">
		<span class="ew-aggregate"><?php echo $Language->phrase("TOTAL") ?></span><span class="ew-aggregate-value">
		<?php echo $tbl_goodsinpack->PCS->ViewValue ?></span>
		</span></td>
	<?php } ?>
	<?php if ($tbl_goodsinpack->CreateUser->Visible) { // CreateUser ?>
		<td data-name="CreateUser" class="<?php echo $tbl_goodsinpack->CreateUser->footerCellClass() ?>"><span id="elf_tbl_goodsinpack_CreateUser" class="tbl_goodsinpack_CreateUser">
		&nbsp;
		</span></td>
	<?php } ?>
	<?php if ($tbl_goodsinpack->CreateDate->Visible) { // CreateDate ?>
		<td data-name="CreateDate" class="<?php echo $tbl_goodsinpack->CreateDate->footerCellClass() ?>"><span id="elf_tbl_goodsinpack_CreateDate" class="tbl_goodsinpack_CreateDate">
		&nbsp;
		</span></td>
	<?php } ?>
	<?php if ($tbl_goodsinpack->UpdateUser->Visible) { // UpdateUser ?>
		<td data-name="UpdateUser" class="<?php echo $tbl_goodsinpack->UpdateUser->footerCellClass() ?>"><span id="elf_tbl_goodsinpack_UpdateUser" class="tbl_goodsinpack_UpdateUser">
		&nbsp;
		</span></td>
	<?php } ?>
	<?php if ($tbl_goodsinpack->UpdateDatetime->Visible) { // UpdateDatetime ?>
		<td data-name="UpdateDatetime" class="<?php echo $tbl_goodsinpack->UpdateDatetime->footerCellClass() ?>"><span id="elf_tbl_goodsinpack_UpdateDatetime" class="tbl_goodsinpack_UpdateDatetime">
		&nbsp;
		</span></td>
	<?php } ?>
<?php

// Render list options (footer, right)
$tbl_goodsinpack_grid->ListOptions->render("footer", "right");
?>
	</tr>
</tfoot>
<?php } ?>
</table><!-- /.ew-table -->
<?php if ($tbl_goodsinpack->CurrentMode == "add" || $tbl_goodsinpack->CurrentMode == "copy") { ?>
<input type="hidden" name="<?php echo $tbl_goodsinpack_grid->FormKeyCountName ?>" id="<?php echo $tbl_goodsinpack_grid->FormKeyCountName ?>" value="<?php echo $tbl_goodsinpack_grid->KeyCount ?>">
<?php echo $tbl_goodsinpack_grid->MultiSelectKey ?>
<?php } ?>
<?php if ($tbl_goodsinpack->CurrentMode == "edit") { ?>
<input type="hidden" name="<?php echo $tbl_goodsinpack_grid->FormKeyCountName ?>" id="<?php echo $tbl_goodsinpack_grid->FormKeyCountName ?>" value="<?php echo $tbl_goodsinpack_grid->KeyCount ?>">
<?php echo $tbl_goodsinpack_grid->MultiSelectKey ?>
<?php } ?>
<?php if ($tbl_goodsinpack->CurrentMode == "") { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
<input type="hidden" name="detailpage" value="ftbl_goodsinpackgrid">
</div><!-- /.ew-grid-middle-panel -->
<?php

// Close recordset
if ($tbl_goodsinpack_grid->Recordset)
	$tbl_goodsinpack_grid->Recordset->Close();
?>
</div>
<?php if ($tbl_goodsinpack_grid->ShowOtherOptions) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php $tbl_goodsinpack_grid->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($tbl_goodsinpack_grid->TotalRecs == 0 && !$tbl_goodsinpack->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $tbl_goodsinpack_grid->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$tbl_goodsinpack_grid->terminate();
?>