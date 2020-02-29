<?php
namespace PHPMaker2019\asgbn_wh;

// Write header
WriteHeader(FALSE);

// Create page object
if (!isset($tbl_loading_grid))
	$tbl_loading_grid = new tbl_loading_grid();

// Run the page
$tbl_loading_grid->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$tbl_loading_grid->Page_Render();
?>
<?php if (!$tbl_loading->isExport()) { ?>
<script>

// Form object
var ftbl_loadinggrid = new ew.Form("ftbl_loadinggrid", "grid");
ftbl_loadinggrid.formKeyCountName = '<?php echo $tbl_loading_grid->FormKeyCountName ?>';

// Validate form
ftbl_loadinggrid.validate = function() {
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
		<?php if ($tbl_loading_grid->ID_Order->Required) { ?>
			elm = this.getElements("x" + infix + "_ID_Order");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $tbl_loading->ID_Order->caption(), $tbl_loading->ID_Order->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($tbl_loading_grid->CusomterOrderNo->Required) { ?>
			elm = this.getElements("x" + infix + "_CusomterOrderNo");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $tbl_loading->CusomterOrderNo->caption(), $tbl_loading->CusomterOrderNo->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($tbl_loading_grid->CreateUser->Required) { ?>
			elm = this.getElements("x" + infix + "_CreateUser");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $tbl_loading->CreateUser->caption(), $tbl_loading->CreateUser->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($tbl_loading_grid->CreateDate->Required) { ?>
			elm = this.getElements("x" + infix + "_CreateDate");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $tbl_loading->CreateDate->caption(), $tbl_loading->CreateDate->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($tbl_loading_grid->UpdateUser->Required) { ?>
			elm = this.getElements("x" + infix + "_UpdateUser");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $tbl_loading->UpdateUser->caption(), $tbl_loading->UpdateUser->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($tbl_loading_grid->UpdateDate->Required) { ?>
			elm = this.getElements("x" + infix + "_UpdateDate");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $tbl_loading->UpdateDate->caption(), $tbl_loading->UpdateDate->RequiredErrorMessage)) ?>");
		<?php } ?>

			// Fire Form_CustomValidate event
			if (!this.Form_CustomValidate(fobj))
				return false;
		} // End Grid Add checking
	}
	return true;
}

// Check empty row
ftbl_loadinggrid.emptyRow = function(infix) {
	var fobj = this._form;
	if (ew.valueChanged(fobj, infix, "ID_Order", false)) return false;
	if (ew.valueChanged(fobj, infix, "CusomterOrderNo", false)) return false;
	return true;
}

// Form_CustomValidate event
ftbl_loadinggrid.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

	// Your custom validation code here, return false if invalid.
	return true;
}

// Use JavaScript validation or not
ftbl_loadinggrid.validateRequired = <?php echo json_encode(CLIENT_VALIDATE) ?>;

// Dynamic selection lists
ftbl_loadinggrid.lists["x_ID_Order"] = <?php echo $tbl_loading_grid->ID_Order->Lookup->toClientList() ?>;
ftbl_loadinggrid.lists["x_ID_Order"].options = <?php echo JsonEncode($tbl_loading_grid->ID_Order->lookupOptions()) ?>;

// Form object for search
</script>
<?php } ?>
<?php
$tbl_loading_grid->renderOtherOptions();
?>
<?php $tbl_loading_grid->showPageHeader(); ?>
<?php
$tbl_loading_grid->showMessage();
?>
<?php if ($tbl_loading_grid->TotalRecs > 0 || $tbl_loading->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($tbl_loading_grid->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> tbl_loading">
<?php if ($tbl_loading_grid->ShowOtherOptions) { ?>
<div class="card-header ew-grid-upper-panel">
<?php $tbl_loading_grid->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<div id="ftbl_loadinggrid" class="ew-form ew-list-form form-inline">
<div id="gmp_tbl_loading" class="<?php if (IsResponsiveLayout()) { ?>table-responsive <?php } ?>card-body ew-grid-middle-panel">
<table id="tbl_tbl_loadinggrid" class="table ew-table"><!-- .ew-table ##-->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$tbl_loading_grid->RowType = ROWTYPE_HEADER;

// Render list options
$tbl_loading_grid->renderListOptions();

// Render list options (header, left)
$tbl_loading_grid->ListOptions->render("header", "left");
?>
<?php if ($tbl_loading->ID_Order->Visible) { // ID_Order ?>
	<?php if ($tbl_loading->sortUrl($tbl_loading->ID_Order) == "") { ?>
		<th data-name="ID_Order" class="<?php echo $tbl_loading->ID_Order->headerCellClass() ?>" style="white-space: nowrap;"><div id="elh_tbl_loading_ID_Order" class="tbl_loading_ID_Order"><div class="ew-table-header-caption"><?php echo $tbl_loading->ID_Order->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="ID_Order" class="<?php echo $tbl_loading->ID_Order->headerCellClass() ?>" style="white-space: nowrap;"><div><div id="elh_tbl_loading_ID_Order" class="tbl_loading_ID_Order">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $tbl_loading->ID_Order->caption() ?></span><span class="ew-table-header-sort"><?php if ($tbl_loading->ID_Order->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($tbl_loading->ID_Order->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($tbl_loading->CusomterOrderNo->Visible) { // CusomterOrderNo ?>
	<?php if ($tbl_loading->sortUrl($tbl_loading->CusomterOrderNo) == "") { ?>
		<th data-name="CusomterOrderNo" class="<?php echo $tbl_loading->CusomterOrderNo->headerCellClass() ?>"><div id="elh_tbl_loading_CusomterOrderNo" class="tbl_loading_CusomterOrderNo"><div class="ew-table-header-caption"><?php echo $tbl_loading->CusomterOrderNo->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="CusomterOrderNo" class="<?php echo $tbl_loading->CusomterOrderNo->headerCellClass() ?>"><div><div id="elh_tbl_loading_CusomterOrderNo" class="tbl_loading_CusomterOrderNo">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $tbl_loading->CusomterOrderNo->caption() ?></span><span class="ew-table-header-sort"><?php if ($tbl_loading->CusomterOrderNo->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($tbl_loading->CusomterOrderNo->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($tbl_loading->CreateUser->Visible) { // CreateUser ?>
	<?php if ($tbl_loading->sortUrl($tbl_loading->CreateUser) == "") { ?>
		<th data-name="CreateUser" class="<?php echo $tbl_loading->CreateUser->headerCellClass() ?>" style="white-space: nowrap;"><div id="elh_tbl_loading_CreateUser" class="tbl_loading_CreateUser"><div class="ew-table-header-caption"><?php echo $tbl_loading->CreateUser->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="CreateUser" class="<?php echo $tbl_loading->CreateUser->headerCellClass() ?>" style="white-space: nowrap;"><div><div id="elh_tbl_loading_CreateUser" class="tbl_loading_CreateUser">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $tbl_loading->CreateUser->caption() ?></span><span class="ew-table-header-sort"><?php if ($tbl_loading->CreateUser->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($tbl_loading->CreateUser->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($tbl_loading->CreateDate->Visible) { // CreateDate ?>
	<?php if ($tbl_loading->sortUrl($tbl_loading->CreateDate) == "") { ?>
		<th data-name="CreateDate" class="<?php echo $tbl_loading->CreateDate->headerCellClass() ?>" style="white-space: nowrap;"><div id="elh_tbl_loading_CreateDate" class="tbl_loading_CreateDate"><div class="ew-table-header-caption"><?php echo $tbl_loading->CreateDate->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="CreateDate" class="<?php echo $tbl_loading->CreateDate->headerCellClass() ?>" style="white-space: nowrap;"><div><div id="elh_tbl_loading_CreateDate" class="tbl_loading_CreateDate">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $tbl_loading->CreateDate->caption() ?></span><span class="ew-table-header-sort"><?php if ($tbl_loading->CreateDate->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($tbl_loading->CreateDate->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($tbl_loading->UpdateUser->Visible) { // UpdateUser ?>
	<?php if ($tbl_loading->sortUrl($tbl_loading->UpdateUser) == "") { ?>
		<th data-name="UpdateUser" class="<?php echo $tbl_loading->UpdateUser->headerCellClass() ?>" style="white-space: nowrap;"><div id="elh_tbl_loading_UpdateUser" class="tbl_loading_UpdateUser"><div class="ew-table-header-caption"><?php echo $tbl_loading->UpdateUser->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="UpdateUser" class="<?php echo $tbl_loading->UpdateUser->headerCellClass() ?>" style="white-space: nowrap;"><div><div id="elh_tbl_loading_UpdateUser" class="tbl_loading_UpdateUser">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $tbl_loading->UpdateUser->caption() ?></span><span class="ew-table-header-sort"><?php if ($tbl_loading->UpdateUser->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($tbl_loading->UpdateUser->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($tbl_loading->UpdateDate->Visible) { // UpdateDate ?>
	<?php if ($tbl_loading->sortUrl($tbl_loading->UpdateDate) == "") { ?>
		<th data-name="UpdateDate" class="<?php echo $tbl_loading->UpdateDate->headerCellClass() ?>" style="white-space: nowrap;"><div id="elh_tbl_loading_UpdateDate" class="tbl_loading_UpdateDate"><div class="ew-table-header-caption"><?php echo $tbl_loading->UpdateDate->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="UpdateDate" class="<?php echo $tbl_loading->UpdateDate->headerCellClass() ?>" style="white-space: nowrap;"><div><div id="elh_tbl_loading_UpdateDate" class="tbl_loading_UpdateDate">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $tbl_loading->UpdateDate->caption() ?></span><span class="ew-table-header-sort"><?php if ($tbl_loading->UpdateDate->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($tbl_loading->UpdateDate->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$tbl_loading_grid->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
$tbl_loading_grid->StartRec = 1;
$tbl_loading_grid->StopRec = $tbl_loading_grid->TotalRecs; // Show all records

// Restore number of post back records
if ($CurrentForm && $tbl_loading_grid->EventCancelled) {
	$CurrentForm->Index = -1;
	if ($CurrentForm->hasValue($tbl_loading_grid->FormKeyCountName) && ($tbl_loading->isGridAdd() || $tbl_loading->isGridEdit() || $tbl_loading->isConfirm())) {
		$tbl_loading_grid->KeyCount = $CurrentForm->getValue($tbl_loading_grid->FormKeyCountName);
		$tbl_loading_grid->StopRec = $tbl_loading_grid->StartRec + $tbl_loading_grid->KeyCount - 1;
	}
}
$tbl_loading_grid->RecCnt = $tbl_loading_grid->StartRec - 1;
if ($tbl_loading_grid->Recordset && !$tbl_loading_grid->Recordset->EOF) {
	$tbl_loading_grid->Recordset->moveFirst();
	$selectLimit = $tbl_loading_grid->UseSelectLimit;
	if (!$selectLimit && $tbl_loading_grid->StartRec > 1)
		$tbl_loading_grid->Recordset->move($tbl_loading_grid->StartRec - 1);
} elseif (!$tbl_loading->AllowAddDeleteRow && $tbl_loading_grid->StopRec == 0) {
	$tbl_loading_grid->StopRec = $tbl_loading->GridAddRowCount;
}

// Initialize aggregate
$tbl_loading->RowType = ROWTYPE_AGGREGATEINIT;
$tbl_loading->resetAttributes();
$tbl_loading_grid->renderRow();
if ($tbl_loading->isGridAdd())
	$tbl_loading_grid->RowIndex = 0;
if ($tbl_loading->isGridEdit())
	$tbl_loading_grid->RowIndex = 0;
while ($tbl_loading_grid->RecCnt < $tbl_loading_grid->StopRec) {
	$tbl_loading_grid->RecCnt++;
	if ($tbl_loading_grid->RecCnt >= $tbl_loading_grid->StartRec) {
		$tbl_loading_grid->RowCnt++;
		if ($tbl_loading->isGridAdd() || $tbl_loading->isGridEdit() || $tbl_loading->isConfirm()) {
			$tbl_loading_grid->RowIndex++;
			$CurrentForm->Index = $tbl_loading_grid->RowIndex;
			if ($CurrentForm->hasValue($tbl_loading_grid->FormActionName) && $tbl_loading_grid->EventCancelled)
				$tbl_loading_grid->RowAction = strval($CurrentForm->getValue($tbl_loading_grid->FormActionName));
			elseif ($tbl_loading->isGridAdd())
				$tbl_loading_grid->RowAction = "insert";
			else
				$tbl_loading_grid->RowAction = "";
		}

		// Set up key count
		$tbl_loading_grid->KeyCount = $tbl_loading_grid->RowIndex;

		// Init row class and style
		$tbl_loading->resetAttributes();
		$tbl_loading->CssClass = "";
		if ($tbl_loading->isGridAdd()) {
			if ($tbl_loading->CurrentMode == "copy") {
				$tbl_loading_grid->loadRowValues($tbl_loading_grid->Recordset); // Load row values
				$tbl_loading_grid->setRecordKey($tbl_loading_grid->RowOldKey, $tbl_loading_grid->Recordset); // Set old record key
			} else {
				$tbl_loading_grid->loadRowValues(); // Load default values
				$tbl_loading_grid->RowOldKey = ""; // Clear old key value
			}
		} else {
			$tbl_loading_grid->loadRowValues($tbl_loading_grid->Recordset); // Load row values
		}
		$tbl_loading->RowType = ROWTYPE_VIEW; // Render view
		if ($tbl_loading->isGridAdd()) // Grid add
			$tbl_loading->RowType = ROWTYPE_ADD; // Render add
		if ($tbl_loading->isGridAdd() && $tbl_loading->EventCancelled && !$CurrentForm->hasValue("k_blankrow")) // Insert failed
			$tbl_loading_grid->restoreCurrentRowFormValues($tbl_loading_grid->RowIndex); // Restore form values
		if ($tbl_loading->isGridEdit()) { // Grid edit
			if ($tbl_loading->EventCancelled)
				$tbl_loading_grid->restoreCurrentRowFormValues($tbl_loading_grid->RowIndex); // Restore form values
			if ($tbl_loading_grid->RowAction == "insert")
				$tbl_loading->RowType = ROWTYPE_ADD; // Render add
			else
				$tbl_loading->RowType = ROWTYPE_EDIT; // Render edit
		}
		if ($tbl_loading->isGridEdit() && ($tbl_loading->RowType == ROWTYPE_EDIT || $tbl_loading->RowType == ROWTYPE_ADD) && $tbl_loading->EventCancelled) // Update failed
			$tbl_loading_grid->restoreCurrentRowFormValues($tbl_loading_grid->RowIndex); // Restore form values
		if ($tbl_loading->RowType == ROWTYPE_EDIT) // Edit row
			$tbl_loading_grid->EditRowCnt++;
		if ($tbl_loading->isConfirm()) // Confirm row
			$tbl_loading_grid->restoreCurrentRowFormValues($tbl_loading_grid->RowIndex); // Restore form values

		// Set up row id / data-rowindex
		$tbl_loading->RowAttrs = array_merge($tbl_loading->RowAttrs, array('data-rowindex'=>$tbl_loading_grid->RowCnt, 'id'=>'r' . $tbl_loading_grid->RowCnt . '_tbl_loading', 'data-rowtype'=>$tbl_loading->RowType));

		// Render row
		$tbl_loading_grid->renderRow();

		// Render list options
		$tbl_loading_grid->renderListOptions();

		// Skip delete row / empty row for confirm page
		if ($tbl_loading_grid->RowAction <> "delete" && $tbl_loading_grid->RowAction <> "insertdelete" && !($tbl_loading_grid->RowAction == "insert" && $tbl_loading->isConfirm() && $tbl_loading_grid->emptyRow())) {
?>
	<tr<?php echo $tbl_loading->rowAttributes() ?>>
<?php

// Render list options (body, left)
$tbl_loading_grid->ListOptions->render("body", "left", $tbl_loading_grid->RowCnt);
?>
	<?php if ($tbl_loading->ID_Order->Visible) { // ID_Order ?>
		<td data-name="ID_Order"<?php echo $tbl_loading->ID_Order->cellAttributes() ?>>
<?php if ($tbl_loading->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $tbl_loading_grid->RowCnt ?>_tbl_loading_ID_Order" class="form-group tbl_loading_ID_Order">
<?php $tbl_loading->ID_Order->EditAttrs["onchange"] = "ew.autoFill(this);" . @$tbl_loading->ID_Order->EditAttrs["onchange"]; ?>
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="tbl_loading" data-field="x_ID_Order" data-value-separator="<?php echo $tbl_loading->ID_Order->displayValueSeparatorAttribute() ?>" id="x<?php echo $tbl_loading_grid->RowIndex ?>_ID_Order" name="x<?php echo $tbl_loading_grid->RowIndex ?>_ID_Order"<?php echo $tbl_loading->ID_Order->editAttributes() ?>>
		<?php echo $tbl_loading->ID_Order->selectOptionListHtml("x<?php echo $tbl_loading_grid->RowIndex ?>_ID_Order") ?>
	</select>
</div>
<?php echo $tbl_loading->ID_Order->Lookup->getParamTag("p_x" . $tbl_loading_grid->RowIndex . "_ID_Order") ?>
</span>
<input type="hidden" data-table="tbl_loading" data-field="x_ID_Order" name="o<?php echo $tbl_loading_grid->RowIndex ?>_ID_Order" id="o<?php echo $tbl_loading_grid->RowIndex ?>_ID_Order" value="<?php echo HtmlEncode($tbl_loading->ID_Order->OldValue) ?>">
<?php } ?>
<?php if ($tbl_loading->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $tbl_loading_grid->RowCnt ?>_tbl_loading_ID_Order" class="form-group tbl_loading_ID_Order">
<?php $tbl_loading->ID_Order->EditAttrs["onchange"] = "ew.autoFill(this);" . @$tbl_loading->ID_Order->EditAttrs["onchange"]; ?>
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="tbl_loading" data-field="x_ID_Order" data-value-separator="<?php echo $tbl_loading->ID_Order->displayValueSeparatorAttribute() ?>" id="x<?php echo $tbl_loading_grid->RowIndex ?>_ID_Order" name="x<?php echo $tbl_loading_grid->RowIndex ?>_ID_Order"<?php echo $tbl_loading->ID_Order->editAttributes() ?>>
		<?php echo $tbl_loading->ID_Order->selectOptionListHtml("x<?php echo $tbl_loading_grid->RowIndex ?>_ID_Order") ?>
	</select>
</div>
<?php echo $tbl_loading->ID_Order->Lookup->getParamTag("p_x" . $tbl_loading_grid->RowIndex . "_ID_Order") ?>
</span>
<?php } ?>
<?php if ($tbl_loading->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $tbl_loading_grid->RowCnt ?>_tbl_loading_ID_Order" class="tbl_loading_ID_Order">
<span<?php echo $tbl_loading->ID_Order->viewAttributes() ?>>
<?php echo $tbl_loading->ID_Order->getViewValue() ?></span>
</span>
<?php if (!$tbl_loading->isConfirm()) { ?>
<input type="hidden" data-table="tbl_loading" data-field="x_ID_Order" name="x<?php echo $tbl_loading_grid->RowIndex ?>_ID_Order" id="x<?php echo $tbl_loading_grid->RowIndex ?>_ID_Order" value="<?php echo HtmlEncode($tbl_loading->ID_Order->FormValue) ?>">
<input type="hidden" data-table="tbl_loading" data-field="x_ID_Order" name="o<?php echo $tbl_loading_grid->RowIndex ?>_ID_Order" id="o<?php echo $tbl_loading_grid->RowIndex ?>_ID_Order" value="<?php echo HtmlEncode($tbl_loading->ID_Order->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="tbl_loading" data-field="x_ID_Order" name="ftbl_loadinggrid$x<?php echo $tbl_loading_grid->RowIndex ?>_ID_Order" id="ftbl_loadinggrid$x<?php echo $tbl_loading_grid->RowIndex ?>_ID_Order" value="<?php echo HtmlEncode($tbl_loading->ID_Order->FormValue) ?>">
<input type="hidden" data-table="tbl_loading" data-field="x_ID_Order" name="ftbl_loadinggrid$o<?php echo $tbl_loading_grid->RowIndex ?>_ID_Order" id="ftbl_loadinggrid$o<?php echo $tbl_loading_grid->RowIndex ?>_ID_Order" value="<?php echo HtmlEncode($tbl_loading->ID_Order->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
<?php if ($tbl_loading->RowType == ROWTYPE_ADD) { // Add record ?>
<input type="hidden" data-table="tbl_loading" data-field="x_ID_Loading" name="x<?php echo $tbl_loading_grid->RowIndex ?>_ID_Loading" id="x<?php echo $tbl_loading_grid->RowIndex ?>_ID_Loading" value="<?php echo HtmlEncode($tbl_loading->ID_Loading->CurrentValue) ?>">
<input type="hidden" data-table="tbl_loading" data-field="x_ID_Loading" name="o<?php echo $tbl_loading_grid->RowIndex ?>_ID_Loading" id="o<?php echo $tbl_loading_grid->RowIndex ?>_ID_Loading" value="<?php echo HtmlEncode($tbl_loading->ID_Loading->OldValue) ?>">
<?php } ?>
<?php if ($tbl_loading->RowType == ROWTYPE_EDIT || $tbl_loading->CurrentMode == "edit") { ?>
<input type="hidden" data-table="tbl_loading" data-field="x_ID_Loading" name="x<?php echo $tbl_loading_grid->RowIndex ?>_ID_Loading" id="x<?php echo $tbl_loading_grid->RowIndex ?>_ID_Loading" value="<?php echo HtmlEncode($tbl_loading->ID_Loading->CurrentValue) ?>">
<?php } ?>
	<?php if ($tbl_loading->CusomterOrderNo->Visible) { // CusomterOrderNo ?>
		<td data-name="CusomterOrderNo"<?php echo $tbl_loading->CusomterOrderNo->cellAttributes() ?>>
<?php if ($tbl_loading->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $tbl_loading_grid->RowCnt ?>_tbl_loading_CusomterOrderNo" class="form-group tbl_loading_CusomterOrderNo">
<input type="text" data-table="tbl_loading" data-field="x_CusomterOrderNo" name="x<?php echo $tbl_loading_grid->RowIndex ?>_CusomterOrderNo" id="x<?php echo $tbl_loading_grid->RowIndex ?>_CusomterOrderNo" size="20" maxlength="15" placeholder="<?php echo HtmlEncode($tbl_loading->CusomterOrderNo->getPlaceHolder()) ?>" value="<?php echo $tbl_loading->CusomterOrderNo->EditValue ?>"<?php echo $tbl_loading->CusomterOrderNo->editAttributes() ?>>
</span>
<input type="hidden" data-table="tbl_loading" data-field="x_CusomterOrderNo" name="o<?php echo $tbl_loading_grid->RowIndex ?>_CusomterOrderNo" id="o<?php echo $tbl_loading_grid->RowIndex ?>_CusomterOrderNo" value="<?php echo HtmlEncode($tbl_loading->CusomterOrderNo->OldValue) ?>">
<?php } ?>
<?php if ($tbl_loading->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $tbl_loading_grid->RowCnt ?>_tbl_loading_CusomterOrderNo" class="form-group tbl_loading_CusomterOrderNo">
<input type="text" data-table="tbl_loading" data-field="x_CusomterOrderNo" name="x<?php echo $tbl_loading_grid->RowIndex ?>_CusomterOrderNo" id="x<?php echo $tbl_loading_grid->RowIndex ?>_CusomterOrderNo" size="20" maxlength="15" placeholder="<?php echo HtmlEncode($tbl_loading->CusomterOrderNo->getPlaceHolder()) ?>" value="<?php echo $tbl_loading->CusomterOrderNo->EditValue ?>"<?php echo $tbl_loading->CusomterOrderNo->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($tbl_loading->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $tbl_loading_grid->RowCnt ?>_tbl_loading_CusomterOrderNo" class="tbl_loading_CusomterOrderNo">
<span<?php echo $tbl_loading->CusomterOrderNo->viewAttributes() ?>>
<?php echo $tbl_loading->CusomterOrderNo->getViewValue() ?></span>
</span>
<?php if (!$tbl_loading->isConfirm()) { ?>
<input type="hidden" data-table="tbl_loading" data-field="x_CusomterOrderNo" name="x<?php echo $tbl_loading_grid->RowIndex ?>_CusomterOrderNo" id="x<?php echo $tbl_loading_grid->RowIndex ?>_CusomterOrderNo" value="<?php echo HtmlEncode($tbl_loading->CusomterOrderNo->FormValue) ?>">
<input type="hidden" data-table="tbl_loading" data-field="x_CusomterOrderNo" name="o<?php echo $tbl_loading_grid->RowIndex ?>_CusomterOrderNo" id="o<?php echo $tbl_loading_grid->RowIndex ?>_CusomterOrderNo" value="<?php echo HtmlEncode($tbl_loading->CusomterOrderNo->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="tbl_loading" data-field="x_CusomterOrderNo" name="ftbl_loadinggrid$x<?php echo $tbl_loading_grid->RowIndex ?>_CusomterOrderNo" id="ftbl_loadinggrid$x<?php echo $tbl_loading_grid->RowIndex ?>_CusomterOrderNo" value="<?php echo HtmlEncode($tbl_loading->CusomterOrderNo->FormValue) ?>">
<input type="hidden" data-table="tbl_loading" data-field="x_CusomterOrderNo" name="ftbl_loadinggrid$o<?php echo $tbl_loading_grid->RowIndex ?>_CusomterOrderNo" id="ftbl_loadinggrid$o<?php echo $tbl_loading_grid->RowIndex ?>_CusomterOrderNo" value="<?php echo HtmlEncode($tbl_loading->CusomterOrderNo->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($tbl_loading->CreateUser->Visible) { // CreateUser ?>
		<td data-name="CreateUser"<?php echo $tbl_loading->CreateUser->cellAttributes() ?>>
<?php if ($tbl_loading->RowType == ROWTYPE_ADD) { // Add record ?>
<input type="hidden" data-table="tbl_loading" data-field="x_CreateUser" name="o<?php echo $tbl_loading_grid->RowIndex ?>_CreateUser" id="o<?php echo $tbl_loading_grid->RowIndex ?>_CreateUser" value="<?php echo HtmlEncode($tbl_loading->CreateUser->OldValue) ?>">
<?php } ?>
<?php if ($tbl_loading->RowType == ROWTYPE_EDIT) { // Edit record ?>
<?php } ?>
<?php if ($tbl_loading->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $tbl_loading_grid->RowCnt ?>_tbl_loading_CreateUser" class="tbl_loading_CreateUser">
<span<?php echo $tbl_loading->CreateUser->viewAttributes() ?>>
<?php echo $tbl_loading->CreateUser->getViewValue() ?></span>
</span>
<?php if (!$tbl_loading->isConfirm()) { ?>
<input type="hidden" data-table="tbl_loading" data-field="x_CreateUser" name="x<?php echo $tbl_loading_grid->RowIndex ?>_CreateUser" id="x<?php echo $tbl_loading_grid->RowIndex ?>_CreateUser" value="<?php echo HtmlEncode($tbl_loading->CreateUser->FormValue) ?>">
<input type="hidden" data-table="tbl_loading" data-field="x_CreateUser" name="o<?php echo $tbl_loading_grid->RowIndex ?>_CreateUser" id="o<?php echo $tbl_loading_grid->RowIndex ?>_CreateUser" value="<?php echo HtmlEncode($tbl_loading->CreateUser->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="tbl_loading" data-field="x_CreateUser" name="ftbl_loadinggrid$x<?php echo $tbl_loading_grid->RowIndex ?>_CreateUser" id="ftbl_loadinggrid$x<?php echo $tbl_loading_grid->RowIndex ?>_CreateUser" value="<?php echo HtmlEncode($tbl_loading->CreateUser->FormValue) ?>">
<input type="hidden" data-table="tbl_loading" data-field="x_CreateUser" name="ftbl_loadinggrid$o<?php echo $tbl_loading_grid->RowIndex ?>_CreateUser" id="ftbl_loadinggrid$o<?php echo $tbl_loading_grid->RowIndex ?>_CreateUser" value="<?php echo HtmlEncode($tbl_loading->CreateUser->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($tbl_loading->CreateDate->Visible) { // CreateDate ?>
		<td data-name="CreateDate"<?php echo $tbl_loading->CreateDate->cellAttributes() ?>>
<?php if ($tbl_loading->RowType == ROWTYPE_ADD) { // Add record ?>
<input type="hidden" data-table="tbl_loading" data-field="x_CreateDate" name="o<?php echo $tbl_loading_grid->RowIndex ?>_CreateDate" id="o<?php echo $tbl_loading_grid->RowIndex ?>_CreateDate" value="<?php echo HtmlEncode($tbl_loading->CreateDate->OldValue) ?>">
<?php } ?>
<?php if ($tbl_loading->RowType == ROWTYPE_EDIT) { // Edit record ?>
<?php } ?>
<?php if ($tbl_loading->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $tbl_loading_grid->RowCnt ?>_tbl_loading_CreateDate" class="tbl_loading_CreateDate">
<span<?php echo $tbl_loading->CreateDate->viewAttributes() ?>>
<?php echo $tbl_loading->CreateDate->getViewValue() ?></span>
</span>
<?php if (!$tbl_loading->isConfirm()) { ?>
<input type="hidden" data-table="tbl_loading" data-field="x_CreateDate" name="x<?php echo $tbl_loading_grid->RowIndex ?>_CreateDate" id="x<?php echo $tbl_loading_grid->RowIndex ?>_CreateDate" value="<?php echo HtmlEncode($tbl_loading->CreateDate->FormValue) ?>">
<input type="hidden" data-table="tbl_loading" data-field="x_CreateDate" name="o<?php echo $tbl_loading_grid->RowIndex ?>_CreateDate" id="o<?php echo $tbl_loading_grid->RowIndex ?>_CreateDate" value="<?php echo HtmlEncode($tbl_loading->CreateDate->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="tbl_loading" data-field="x_CreateDate" name="ftbl_loadinggrid$x<?php echo $tbl_loading_grid->RowIndex ?>_CreateDate" id="ftbl_loadinggrid$x<?php echo $tbl_loading_grid->RowIndex ?>_CreateDate" value="<?php echo HtmlEncode($tbl_loading->CreateDate->FormValue) ?>">
<input type="hidden" data-table="tbl_loading" data-field="x_CreateDate" name="ftbl_loadinggrid$o<?php echo $tbl_loading_grid->RowIndex ?>_CreateDate" id="ftbl_loadinggrid$o<?php echo $tbl_loading_grid->RowIndex ?>_CreateDate" value="<?php echo HtmlEncode($tbl_loading->CreateDate->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($tbl_loading->UpdateUser->Visible) { // UpdateUser ?>
		<td data-name="UpdateUser"<?php echo $tbl_loading->UpdateUser->cellAttributes() ?>>
<?php if ($tbl_loading->RowType == ROWTYPE_ADD) { // Add record ?>
<input type="hidden" data-table="tbl_loading" data-field="x_UpdateUser" name="o<?php echo $tbl_loading_grid->RowIndex ?>_UpdateUser" id="o<?php echo $tbl_loading_grid->RowIndex ?>_UpdateUser" value="<?php echo HtmlEncode($tbl_loading->UpdateUser->OldValue) ?>">
<?php } ?>
<?php if ($tbl_loading->RowType == ROWTYPE_EDIT) { // Edit record ?>
<?php } ?>
<?php if ($tbl_loading->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $tbl_loading_grid->RowCnt ?>_tbl_loading_UpdateUser" class="tbl_loading_UpdateUser">
<span<?php echo $tbl_loading->UpdateUser->viewAttributes() ?>>
<?php echo $tbl_loading->UpdateUser->getViewValue() ?></span>
</span>
<?php if (!$tbl_loading->isConfirm()) { ?>
<input type="hidden" data-table="tbl_loading" data-field="x_UpdateUser" name="x<?php echo $tbl_loading_grid->RowIndex ?>_UpdateUser" id="x<?php echo $tbl_loading_grid->RowIndex ?>_UpdateUser" value="<?php echo HtmlEncode($tbl_loading->UpdateUser->FormValue) ?>">
<input type="hidden" data-table="tbl_loading" data-field="x_UpdateUser" name="o<?php echo $tbl_loading_grid->RowIndex ?>_UpdateUser" id="o<?php echo $tbl_loading_grid->RowIndex ?>_UpdateUser" value="<?php echo HtmlEncode($tbl_loading->UpdateUser->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="tbl_loading" data-field="x_UpdateUser" name="ftbl_loadinggrid$x<?php echo $tbl_loading_grid->RowIndex ?>_UpdateUser" id="ftbl_loadinggrid$x<?php echo $tbl_loading_grid->RowIndex ?>_UpdateUser" value="<?php echo HtmlEncode($tbl_loading->UpdateUser->FormValue) ?>">
<input type="hidden" data-table="tbl_loading" data-field="x_UpdateUser" name="ftbl_loadinggrid$o<?php echo $tbl_loading_grid->RowIndex ?>_UpdateUser" id="ftbl_loadinggrid$o<?php echo $tbl_loading_grid->RowIndex ?>_UpdateUser" value="<?php echo HtmlEncode($tbl_loading->UpdateUser->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($tbl_loading->UpdateDate->Visible) { // UpdateDate ?>
		<td data-name="UpdateDate"<?php echo $tbl_loading->UpdateDate->cellAttributes() ?>>
<?php if ($tbl_loading->RowType == ROWTYPE_ADD) { // Add record ?>
<input type="hidden" data-table="tbl_loading" data-field="x_UpdateDate" name="o<?php echo $tbl_loading_grid->RowIndex ?>_UpdateDate" id="o<?php echo $tbl_loading_grid->RowIndex ?>_UpdateDate" value="<?php echo HtmlEncode($tbl_loading->UpdateDate->OldValue) ?>">
<?php } ?>
<?php if ($tbl_loading->RowType == ROWTYPE_EDIT) { // Edit record ?>
<?php } ?>
<?php if ($tbl_loading->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $tbl_loading_grid->RowCnt ?>_tbl_loading_UpdateDate" class="tbl_loading_UpdateDate">
<span<?php echo $tbl_loading->UpdateDate->viewAttributes() ?>>
<?php echo $tbl_loading->UpdateDate->getViewValue() ?></span>
</span>
<?php if (!$tbl_loading->isConfirm()) { ?>
<input type="hidden" data-table="tbl_loading" data-field="x_UpdateDate" name="x<?php echo $tbl_loading_grid->RowIndex ?>_UpdateDate" id="x<?php echo $tbl_loading_grid->RowIndex ?>_UpdateDate" value="<?php echo HtmlEncode($tbl_loading->UpdateDate->FormValue) ?>">
<input type="hidden" data-table="tbl_loading" data-field="x_UpdateDate" name="o<?php echo $tbl_loading_grid->RowIndex ?>_UpdateDate" id="o<?php echo $tbl_loading_grid->RowIndex ?>_UpdateDate" value="<?php echo HtmlEncode($tbl_loading->UpdateDate->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="tbl_loading" data-field="x_UpdateDate" name="ftbl_loadinggrid$x<?php echo $tbl_loading_grid->RowIndex ?>_UpdateDate" id="ftbl_loadinggrid$x<?php echo $tbl_loading_grid->RowIndex ?>_UpdateDate" value="<?php echo HtmlEncode($tbl_loading->UpdateDate->FormValue) ?>">
<input type="hidden" data-table="tbl_loading" data-field="x_UpdateDate" name="ftbl_loadinggrid$o<?php echo $tbl_loading_grid->RowIndex ?>_UpdateDate" id="ftbl_loadinggrid$o<?php echo $tbl_loading_grid->RowIndex ?>_UpdateDate" value="<?php echo HtmlEncode($tbl_loading->UpdateDate->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$tbl_loading_grid->ListOptions->render("body", "right", $tbl_loading_grid->RowCnt);
?>
	</tr>
<?php if ($tbl_loading->RowType == ROWTYPE_ADD || $tbl_loading->RowType == ROWTYPE_EDIT) { ?>
<script>
ftbl_loadinggrid.updateLists(<?php echo $tbl_loading_grid->RowIndex ?>);
</script>
<?php } ?>
<?php
	}
	} // End delete row checking
	if (!$tbl_loading->isGridAdd() || $tbl_loading->CurrentMode == "copy")
		if (!$tbl_loading_grid->Recordset->EOF)
			$tbl_loading_grid->Recordset->moveNext();
}
?>
<?php
	if ($tbl_loading->CurrentMode == "add" || $tbl_loading->CurrentMode == "copy" || $tbl_loading->CurrentMode == "edit") {
		$tbl_loading_grid->RowIndex = '$rowindex$';
		$tbl_loading_grid->loadRowValues();

		// Set row properties
		$tbl_loading->resetAttributes();
		$tbl_loading->RowAttrs = array_merge($tbl_loading->RowAttrs, array('data-rowindex'=>$tbl_loading_grid->RowIndex, 'id'=>'r0_tbl_loading', 'data-rowtype'=>ROWTYPE_ADD));
		AppendClass($tbl_loading->RowAttrs["class"], "ew-template");
		$tbl_loading->RowType = ROWTYPE_ADD;

		// Render row
		$tbl_loading_grid->renderRow();

		// Render list options
		$tbl_loading_grid->renderListOptions();
		$tbl_loading_grid->StartRowCnt = 0;
?>
	<tr<?php echo $tbl_loading->rowAttributes() ?>>
<?php

// Render list options (body, left)
$tbl_loading_grid->ListOptions->render("body", "left", $tbl_loading_grid->RowIndex);
?>
	<?php if ($tbl_loading->ID_Order->Visible) { // ID_Order ?>
		<td data-name="ID_Order">
<?php if (!$tbl_loading->isConfirm()) { ?>
<span id="el$rowindex$_tbl_loading_ID_Order" class="form-group tbl_loading_ID_Order">
<?php $tbl_loading->ID_Order->EditAttrs["onchange"] = "ew.autoFill(this);" . @$tbl_loading->ID_Order->EditAttrs["onchange"]; ?>
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="tbl_loading" data-field="x_ID_Order" data-value-separator="<?php echo $tbl_loading->ID_Order->displayValueSeparatorAttribute() ?>" id="x<?php echo $tbl_loading_grid->RowIndex ?>_ID_Order" name="x<?php echo $tbl_loading_grid->RowIndex ?>_ID_Order"<?php echo $tbl_loading->ID_Order->editAttributes() ?>>
		<?php echo $tbl_loading->ID_Order->selectOptionListHtml("x<?php echo $tbl_loading_grid->RowIndex ?>_ID_Order") ?>
	</select>
</div>
<?php echo $tbl_loading->ID_Order->Lookup->getParamTag("p_x" . $tbl_loading_grid->RowIndex . "_ID_Order") ?>
</span>
<?php } else { ?>
<span id="el$rowindex$_tbl_loading_ID_Order" class="form-group tbl_loading_ID_Order">
<span<?php echo $tbl_loading->ID_Order->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?php echo RemoveHtml($tbl_loading->ID_Order->ViewValue) ?>"></span>
</span>
<input type="hidden" data-table="tbl_loading" data-field="x_ID_Order" name="x<?php echo $tbl_loading_grid->RowIndex ?>_ID_Order" id="x<?php echo $tbl_loading_grid->RowIndex ?>_ID_Order" value="<?php echo HtmlEncode($tbl_loading->ID_Order->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="tbl_loading" data-field="x_ID_Order" name="o<?php echo $tbl_loading_grid->RowIndex ?>_ID_Order" id="o<?php echo $tbl_loading_grid->RowIndex ?>_ID_Order" value="<?php echo HtmlEncode($tbl_loading->ID_Order->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($tbl_loading->CusomterOrderNo->Visible) { // CusomterOrderNo ?>
		<td data-name="CusomterOrderNo">
<?php if (!$tbl_loading->isConfirm()) { ?>
<span id="el$rowindex$_tbl_loading_CusomterOrderNo" class="form-group tbl_loading_CusomterOrderNo">
<input type="text" data-table="tbl_loading" data-field="x_CusomterOrderNo" name="x<?php echo $tbl_loading_grid->RowIndex ?>_CusomterOrderNo" id="x<?php echo $tbl_loading_grid->RowIndex ?>_CusomterOrderNo" size="20" maxlength="15" placeholder="<?php echo HtmlEncode($tbl_loading->CusomterOrderNo->getPlaceHolder()) ?>" value="<?php echo $tbl_loading->CusomterOrderNo->EditValue ?>"<?php echo $tbl_loading->CusomterOrderNo->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_tbl_loading_CusomterOrderNo" class="form-group tbl_loading_CusomterOrderNo">
<span<?php echo $tbl_loading->CusomterOrderNo->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?php echo RemoveHtml($tbl_loading->CusomterOrderNo->ViewValue) ?>"></span>
</span>
<input type="hidden" data-table="tbl_loading" data-field="x_CusomterOrderNo" name="x<?php echo $tbl_loading_grid->RowIndex ?>_CusomterOrderNo" id="x<?php echo $tbl_loading_grid->RowIndex ?>_CusomterOrderNo" value="<?php echo HtmlEncode($tbl_loading->CusomterOrderNo->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="tbl_loading" data-field="x_CusomterOrderNo" name="o<?php echo $tbl_loading_grid->RowIndex ?>_CusomterOrderNo" id="o<?php echo $tbl_loading_grid->RowIndex ?>_CusomterOrderNo" value="<?php echo HtmlEncode($tbl_loading->CusomterOrderNo->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($tbl_loading->CreateUser->Visible) { // CreateUser ?>
		<td data-name="CreateUser">
<?php if (!$tbl_loading->isConfirm()) { ?>
<?php } else { ?>
<span id="el$rowindex$_tbl_loading_CreateUser" class="form-group tbl_loading_CreateUser">
<span<?php echo $tbl_loading->CreateUser->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?php echo RemoveHtml($tbl_loading->CreateUser->ViewValue) ?>"></span>
</span>
<input type="hidden" data-table="tbl_loading" data-field="x_CreateUser" name="x<?php echo $tbl_loading_grid->RowIndex ?>_CreateUser" id="x<?php echo $tbl_loading_grid->RowIndex ?>_CreateUser" value="<?php echo HtmlEncode($tbl_loading->CreateUser->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="tbl_loading" data-field="x_CreateUser" name="o<?php echo $tbl_loading_grid->RowIndex ?>_CreateUser" id="o<?php echo $tbl_loading_grid->RowIndex ?>_CreateUser" value="<?php echo HtmlEncode($tbl_loading->CreateUser->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($tbl_loading->CreateDate->Visible) { // CreateDate ?>
		<td data-name="CreateDate">
<?php if (!$tbl_loading->isConfirm()) { ?>
<?php } else { ?>
<span id="el$rowindex$_tbl_loading_CreateDate" class="form-group tbl_loading_CreateDate">
<span<?php echo $tbl_loading->CreateDate->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?php echo RemoveHtml($tbl_loading->CreateDate->ViewValue) ?>"></span>
</span>
<input type="hidden" data-table="tbl_loading" data-field="x_CreateDate" name="x<?php echo $tbl_loading_grid->RowIndex ?>_CreateDate" id="x<?php echo $tbl_loading_grid->RowIndex ?>_CreateDate" value="<?php echo HtmlEncode($tbl_loading->CreateDate->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="tbl_loading" data-field="x_CreateDate" name="o<?php echo $tbl_loading_grid->RowIndex ?>_CreateDate" id="o<?php echo $tbl_loading_grid->RowIndex ?>_CreateDate" value="<?php echo HtmlEncode($tbl_loading->CreateDate->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($tbl_loading->UpdateUser->Visible) { // UpdateUser ?>
		<td data-name="UpdateUser">
<?php if (!$tbl_loading->isConfirm()) { ?>
<?php } else { ?>
<span id="el$rowindex$_tbl_loading_UpdateUser" class="form-group tbl_loading_UpdateUser">
<span<?php echo $tbl_loading->UpdateUser->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?php echo RemoveHtml($tbl_loading->UpdateUser->ViewValue) ?>"></span>
</span>
<input type="hidden" data-table="tbl_loading" data-field="x_UpdateUser" name="x<?php echo $tbl_loading_grid->RowIndex ?>_UpdateUser" id="x<?php echo $tbl_loading_grid->RowIndex ?>_UpdateUser" value="<?php echo HtmlEncode($tbl_loading->UpdateUser->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="tbl_loading" data-field="x_UpdateUser" name="o<?php echo $tbl_loading_grid->RowIndex ?>_UpdateUser" id="o<?php echo $tbl_loading_grid->RowIndex ?>_UpdateUser" value="<?php echo HtmlEncode($tbl_loading->UpdateUser->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($tbl_loading->UpdateDate->Visible) { // UpdateDate ?>
		<td data-name="UpdateDate">
<?php if (!$tbl_loading->isConfirm()) { ?>
<?php } else { ?>
<span id="el$rowindex$_tbl_loading_UpdateDate" class="form-group tbl_loading_UpdateDate">
<span<?php echo $tbl_loading->UpdateDate->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?php echo RemoveHtml($tbl_loading->UpdateDate->ViewValue) ?>"></span>
</span>
<input type="hidden" data-table="tbl_loading" data-field="x_UpdateDate" name="x<?php echo $tbl_loading_grid->RowIndex ?>_UpdateDate" id="x<?php echo $tbl_loading_grid->RowIndex ?>_UpdateDate" value="<?php echo HtmlEncode($tbl_loading->UpdateDate->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="tbl_loading" data-field="x_UpdateDate" name="o<?php echo $tbl_loading_grid->RowIndex ?>_UpdateDate" id="o<?php echo $tbl_loading_grid->RowIndex ?>_UpdateDate" value="<?php echo HtmlEncode($tbl_loading->UpdateDate->OldValue) ?>">
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$tbl_loading_grid->ListOptions->render("body", "right", $tbl_loading_grid->RowIndex);
?>
<script>
ftbl_loadinggrid.updateLists(<?php echo $tbl_loading_grid->RowIndex ?>);
</script>
	</tr>
<?php
}
?>
</tbody>
</table><!-- /.ew-table -->
<?php if ($tbl_loading->CurrentMode == "add" || $tbl_loading->CurrentMode == "copy") { ?>
<input type="hidden" name="<?php echo $tbl_loading_grid->FormKeyCountName ?>" id="<?php echo $tbl_loading_grid->FormKeyCountName ?>" value="<?php echo $tbl_loading_grid->KeyCount ?>">
<?php echo $tbl_loading_grid->MultiSelectKey ?>
<?php } ?>
<?php if ($tbl_loading->CurrentMode == "edit") { ?>
<input type="hidden" name="<?php echo $tbl_loading_grid->FormKeyCountName ?>" id="<?php echo $tbl_loading_grid->FormKeyCountName ?>" value="<?php echo $tbl_loading_grid->KeyCount ?>">
<?php echo $tbl_loading_grid->MultiSelectKey ?>
<?php } ?>
<?php if ($tbl_loading->CurrentMode == "") { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
<input type="hidden" name="detailpage" value="ftbl_loadinggrid">
</div><!-- /.ew-grid-middle-panel -->
<?php

// Close recordset
if ($tbl_loading_grid->Recordset)
	$tbl_loading_grid->Recordset->Close();
?>
</div>
<?php if ($tbl_loading_grid->ShowOtherOptions) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php $tbl_loading_grid->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($tbl_loading_grid->TotalRecs == 0 && !$tbl_loading->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $tbl_loading_grid->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$tbl_loading_grid->terminate();
?>