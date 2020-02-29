<?php
namespace PHPMaker2019\asgbn_wh;

// Write header
WriteHeader(FALSE);

// Create page object
if (!isset($tbl_unload_grid))
	$tbl_unload_grid = new tbl_unload_grid();

// Run the page
$tbl_unload_grid->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$tbl_unload_grid->Page_Render();
?>
<?php if (!$tbl_unload->isExport()) { ?>
<script>

// Form object
var ftbl_unloadgrid = new ew.Form("ftbl_unloadgrid", "grid");
ftbl_unloadgrid.formKeyCountName = '<?php echo $tbl_unload_grid->FormKeyCountName ?>';

// Validate form
ftbl_unloadgrid.validate = function() {
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
		<?php if ($tbl_unload_grid->Code->Required) { ?>
			elm = this.getElements("x" + infix + "_Code");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $tbl_unload->Code->caption(), $tbl_unload->Code->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($tbl_unload_grid->IdCode->Required) { ?>
			elm = this.getElements("x" + infix + "_IdCode");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $tbl_unload->IdCode->caption(), $tbl_unload->IdCode->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($tbl_unload_grid->PCS->Required) { ?>
			elm = this.getElements("x" + infix + "_PCS");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $tbl_unload->PCS->caption(), $tbl_unload->PCS->RequiredErrorMessage)) ?>");
		<?php } ?>
			elm = this.getElements("x" + infix + "_PCS");
			if (elm && !ew.checkInteger(elm.value))
				return this.onError(elm, "<?php echo JsEncode($tbl_unload->PCS->errorMessage()) ?>");
		<?php if ($tbl_unload_grid->RealPCS->Required) { ?>
			elm = this.getElements("x" + infix + "_RealPCS");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $tbl_unload->RealPCS->caption(), $tbl_unload->RealPCS->RequiredErrorMessage)) ?>");
		<?php } ?>
			elm = this.getElements("x" + infix + "_RealPCS");
			if (elm && !ew.checkInteger(elm.value))
				return this.onError(elm, "<?php echo JsEncode($tbl_unload->RealPCS->errorMessage()) ?>");
		<?php if ($tbl_unload_grid->Description->Required) { ?>
			elm = this.getElements("x" + infix + "_Description");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $tbl_unload->Description->caption(), $tbl_unload->Description->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($tbl_unload_grid->CreateUser->Required) { ?>
			elm = this.getElements("x" + infix + "_CreateUser");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $tbl_unload->CreateUser->caption(), $tbl_unload->CreateUser->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($tbl_unload_grid->CreateDate->Required) { ?>
			elm = this.getElements("x" + infix + "_CreateDate");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $tbl_unload->CreateDate->caption(), $tbl_unload->CreateDate->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($tbl_unload_grid->MFG->Required) { ?>
			elm = this.getElements("x" + infix + "_MFG");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $tbl_unload->MFG->caption(), $tbl_unload->MFG->RequiredErrorMessage)) ?>");
		<?php } ?>
			elm = this.getElements("x" + infix + "_MFG");
			if (elm && !ew.checkEuroDate(elm.value))
				return this.onError(elm, "<?php echo JsEncode($tbl_unload->MFG->errorMessage()) ?>");

			// Fire Form_CustomValidate event
			if (!this.Form_CustomValidate(fobj))
				return false;
		} // End Grid Add checking
	}
	return true;
}

// Check empty row
ftbl_unloadgrid.emptyRow = function(infix) {
	var fobj = this._form;
	if (ew.valueChanged(fobj, infix, "Code", false)) return false;
	if (ew.valueChanged(fobj, infix, "IdCode", false)) return false;
	if (ew.valueChanged(fobj, infix, "PCS", false)) return false;
	if (ew.valueChanged(fobj, infix, "RealPCS", false)) return false;
	if (ew.valueChanged(fobj, infix, "Description", false)) return false;
	if (ew.valueChanged(fobj, infix, "MFG", false)) return false;
	return true;
}

// Form_CustomValidate event
ftbl_unloadgrid.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

	// Your custom validation code here, return false if invalid.
	return true;
}

// Use JavaScript validation or not
ftbl_unloadgrid.validateRequired = <?php echo json_encode(CLIENT_VALIDATE) ?>;

// Dynamic selection lists
ftbl_unloadgrid.lists["x_Code"] = <?php echo $tbl_unload_grid->Code->Lookup->toClientList() ?>;
ftbl_unloadgrid.lists["x_Code"].options = <?php echo JsonEncode($tbl_unload_grid->Code->lookupOptions()) ?>;
ftbl_unloadgrid.autoSuggests["x_Code"] = <?php echo json_encode(["data" => "ajax=autosuggest"]) ?>;
ftbl_unloadgrid.lists["x_IdCode"] = <?php echo $tbl_unload_grid->IdCode->Lookup->toClientList() ?>;
ftbl_unloadgrid.lists["x_IdCode"].options = <?php echo JsonEncode($tbl_unload_grid->IdCode->lookupOptions()) ?>;
ftbl_unloadgrid.autoSuggests["x_IdCode"] = <?php echo json_encode(["data" => "ajax=autosuggest"]) ?>;

// Form object for search
</script>
<?php } ?>
<?php
$tbl_unload_grid->renderOtherOptions();
?>
<?php $tbl_unload_grid->showPageHeader(); ?>
<?php
$tbl_unload_grid->showMessage();
?>
<?php if ($tbl_unload_grid->TotalRecs > 0 || $tbl_unload->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($tbl_unload_grid->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> tbl_unload">
<?php if ($tbl_unload_grid->ShowOtherOptions) { ?>
<div class="card-header ew-grid-upper-panel">
<?php $tbl_unload_grid->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<div id="ftbl_unloadgrid" class="ew-form ew-list-form form-inline">
<div id="gmp_tbl_unload" class="<?php if (IsResponsiveLayout()) { ?>table-responsive <?php } ?>card-body ew-grid-middle-panel">
<table id="tbl_tbl_unloadgrid" class="table ew-table"><!-- .ew-table ##-->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$tbl_unload_grid->RowType = ROWTYPE_HEADER;

// Render list options
$tbl_unload_grid->renderListOptions();

// Render list options (header, left)
$tbl_unload_grid->ListOptions->render("header", "left");
?>
<?php if ($tbl_unload->Code->Visible) { // Code ?>
	<?php if ($tbl_unload->sortUrl($tbl_unload->Code) == "") { ?>
		<th data-name="Code" class="<?php echo $tbl_unload->Code->headerCellClass() ?>" style="white-space: nowrap;"><div id="elh_tbl_unload_Code" class="tbl_unload_Code"><div class="ew-table-header-caption"><?php echo $tbl_unload->Code->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Code" class="<?php echo $tbl_unload->Code->headerCellClass() ?>" style="white-space: nowrap;"><div><div id="elh_tbl_unload_Code" class="tbl_unload_Code">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $tbl_unload->Code->caption() ?></span><span class="ew-table-header-sort"><?php if ($tbl_unload->Code->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($tbl_unload->Code->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($tbl_unload->IdCode->Visible) { // IdCode ?>
	<?php if ($tbl_unload->sortUrl($tbl_unload->IdCode) == "") { ?>
		<th data-name="IdCode" class="<?php echo $tbl_unload->IdCode->headerCellClass() ?>" style="white-space: nowrap;"><div id="elh_tbl_unload_IdCode" class="tbl_unload_IdCode"><div class="ew-table-header-caption"><?php echo $tbl_unload->IdCode->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="IdCode" class="<?php echo $tbl_unload->IdCode->headerCellClass() ?>" style="white-space: nowrap;"><div><div id="elh_tbl_unload_IdCode" class="tbl_unload_IdCode">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $tbl_unload->IdCode->caption() ?></span><span class="ew-table-header-sort"><?php if ($tbl_unload->IdCode->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($tbl_unload->IdCode->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($tbl_unload->PCS->Visible) { // PCS ?>
	<?php if ($tbl_unload->sortUrl($tbl_unload->PCS) == "") { ?>
		<th data-name="PCS" class="<?php echo $tbl_unload->PCS->headerCellClass() ?>" style="white-space: nowrap;"><div id="elh_tbl_unload_PCS" class="tbl_unload_PCS"><div class="ew-table-header-caption"><?php echo $tbl_unload->PCS->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="PCS" class="<?php echo $tbl_unload->PCS->headerCellClass() ?>" style="white-space: nowrap;"><div><div id="elh_tbl_unload_PCS" class="tbl_unload_PCS">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $tbl_unload->PCS->caption() ?></span><span class="ew-table-header-sort"><?php if ($tbl_unload->PCS->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($tbl_unload->PCS->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($tbl_unload->RealPCS->Visible) { // RealPCS ?>
	<?php if ($tbl_unload->sortUrl($tbl_unload->RealPCS) == "") { ?>
		<th data-name="RealPCS" class="<?php echo $tbl_unload->RealPCS->headerCellClass() ?>" style="white-space: nowrap;"><div id="elh_tbl_unload_RealPCS" class="tbl_unload_RealPCS"><div class="ew-table-header-caption"><?php echo $tbl_unload->RealPCS->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="RealPCS" class="<?php echo $tbl_unload->RealPCS->headerCellClass() ?>" style="white-space: nowrap;"><div><div id="elh_tbl_unload_RealPCS" class="tbl_unload_RealPCS">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $tbl_unload->RealPCS->caption() ?></span><span class="ew-table-header-sort"><?php if ($tbl_unload->RealPCS->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($tbl_unload->RealPCS->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($tbl_unload->Description->Visible) { // Description ?>
	<?php if ($tbl_unload->sortUrl($tbl_unload->Description) == "") { ?>
		<th data-name="Description" class="<?php echo $tbl_unload->Description->headerCellClass() ?>" style="white-space: nowrap;"><div id="elh_tbl_unload_Description" class="tbl_unload_Description"><div class="ew-table-header-caption"><?php echo $tbl_unload->Description->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Description" class="<?php echo $tbl_unload->Description->headerCellClass() ?>" style="white-space: nowrap;"><div><div id="elh_tbl_unload_Description" class="tbl_unload_Description">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $tbl_unload->Description->caption() ?></span><span class="ew-table-header-sort"><?php if ($tbl_unload->Description->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($tbl_unload->Description->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($tbl_unload->CreateUser->Visible) { // CreateUser ?>
	<?php if ($tbl_unload->sortUrl($tbl_unload->CreateUser) == "") { ?>
		<th data-name="CreateUser" class="<?php echo $tbl_unload->CreateUser->headerCellClass() ?>" style="white-space: nowrap;"><div id="elh_tbl_unload_CreateUser" class="tbl_unload_CreateUser"><div class="ew-table-header-caption"><?php echo $tbl_unload->CreateUser->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="CreateUser" class="<?php echo $tbl_unload->CreateUser->headerCellClass() ?>" style="white-space: nowrap;"><div><div id="elh_tbl_unload_CreateUser" class="tbl_unload_CreateUser">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $tbl_unload->CreateUser->caption() ?></span><span class="ew-table-header-sort"><?php if ($tbl_unload->CreateUser->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($tbl_unload->CreateUser->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($tbl_unload->CreateDate->Visible) { // CreateDate ?>
	<?php if ($tbl_unload->sortUrl($tbl_unload->CreateDate) == "") { ?>
		<th data-name="CreateDate" class="<?php echo $tbl_unload->CreateDate->headerCellClass() ?>" style="white-space: nowrap;"><div id="elh_tbl_unload_CreateDate" class="tbl_unload_CreateDate"><div class="ew-table-header-caption"><?php echo $tbl_unload->CreateDate->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="CreateDate" class="<?php echo $tbl_unload->CreateDate->headerCellClass() ?>" style="white-space: nowrap;"><div><div id="elh_tbl_unload_CreateDate" class="tbl_unload_CreateDate">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $tbl_unload->CreateDate->caption() ?></span><span class="ew-table-header-sort"><?php if ($tbl_unload->CreateDate->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($tbl_unload->CreateDate->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($tbl_unload->MFG->Visible) { // MFG ?>
	<?php if ($tbl_unload->sortUrl($tbl_unload->MFG) == "") { ?>
		<th data-name="MFG" class="<?php echo $tbl_unload->MFG->headerCellClass() ?>" style="white-space: nowrap;"><div id="elh_tbl_unload_MFG" class="tbl_unload_MFG"><div class="ew-table-header-caption"><?php echo $tbl_unload->MFG->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="MFG" class="<?php echo $tbl_unload->MFG->headerCellClass() ?>" style="white-space: nowrap;"><div><div id="elh_tbl_unload_MFG" class="tbl_unload_MFG">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $tbl_unload->MFG->caption() ?></span><span class="ew-table-header-sort"><?php if ($tbl_unload->MFG->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($tbl_unload->MFG->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$tbl_unload_grid->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
$tbl_unload_grid->StartRec = 1;
$tbl_unload_grid->StopRec = $tbl_unload_grid->TotalRecs; // Show all records

// Restore number of post back records
if ($CurrentForm && $tbl_unload_grid->EventCancelled) {
	$CurrentForm->Index = -1;
	if ($CurrentForm->hasValue($tbl_unload_grid->FormKeyCountName) && ($tbl_unload->isGridAdd() || $tbl_unload->isGridEdit() || $tbl_unload->isConfirm())) {
		$tbl_unload_grid->KeyCount = $CurrentForm->getValue($tbl_unload_grid->FormKeyCountName);
		$tbl_unload_grid->StopRec = $tbl_unload_grid->StartRec + $tbl_unload_grid->KeyCount - 1;
	}
}
$tbl_unload_grid->RecCnt = $tbl_unload_grid->StartRec - 1;
if ($tbl_unload_grid->Recordset && !$tbl_unload_grid->Recordset->EOF) {
	$tbl_unload_grid->Recordset->moveFirst();
	$selectLimit = $tbl_unload_grid->UseSelectLimit;
	if (!$selectLimit && $tbl_unload_grid->StartRec > 1)
		$tbl_unload_grid->Recordset->move($tbl_unload_grid->StartRec - 1);
} elseif (!$tbl_unload->AllowAddDeleteRow && $tbl_unload_grid->StopRec == 0) {
	$tbl_unload_grid->StopRec = $tbl_unload->GridAddRowCount;
}

// Initialize aggregate
$tbl_unload->RowType = ROWTYPE_AGGREGATEINIT;
$tbl_unload->resetAttributes();
$tbl_unload_grid->renderRow();
if ($tbl_unload->isGridAdd())
	$tbl_unload_grid->RowIndex = 0;
if ($tbl_unload->isGridEdit())
	$tbl_unload_grid->RowIndex = 0;
while ($tbl_unload_grid->RecCnt < $tbl_unload_grid->StopRec) {
	$tbl_unload_grid->RecCnt++;
	if ($tbl_unload_grid->RecCnt >= $tbl_unload_grid->StartRec) {
		$tbl_unload_grid->RowCnt++;
		if ($tbl_unload->isGridAdd() || $tbl_unload->isGridEdit() || $tbl_unload->isConfirm()) {
			$tbl_unload_grid->RowIndex++;
			$CurrentForm->Index = $tbl_unload_grid->RowIndex;
			if ($CurrentForm->hasValue($tbl_unload_grid->FormActionName) && $tbl_unload_grid->EventCancelled)
				$tbl_unload_grid->RowAction = strval($CurrentForm->getValue($tbl_unload_grid->FormActionName));
			elseif ($tbl_unload->isGridAdd())
				$tbl_unload_grid->RowAction = "insert";
			else
				$tbl_unload_grid->RowAction = "";
		}

		// Set up key count
		$tbl_unload_grid->KeyCount = $tbl_unload_grid->RowIndex;

		// Init row class and style
		$tbl_unload->resetAttributes();
		$tbl_unload->CssClass = "";
		if ($tbl_unload->isGridAdd()) {
			if ($tbl_unload->CurrentMode == "copy") {
				$tbl_unload_grid->loadRowValues($tbl_unload_grid->Recordset); // Load row values
				$tbl_unload_grid->setRecordKey($tbl_unload_grid->RowOldKey, $tbl_unload_grid->Recordset); // Set old record key
			} else {
				$tbl_unload_grid->loadRowValues(); // Load default values
				$tbl_unload_grid->RowOldKey = ""; // Clear old key value
			}
		} else {
			$tbl_unload_grid->loadRowValues($tbl_unload_grid->Recordset); // Load row values
		}
		$tbl_unload->RowType = ROWTYPE_VIEW; // Render view
		if ($tbl_unload->isGridAdd()) // Grid add
			$tbl_unload->RowType = ROWTYPE_ADD; // Render add
		if ($tbl_unload->isGridAdd() && $tbl_unload->EventCancelled && !$CurrentForm->hasValue("k_blankrow")) // Insert failed
			$tbl_unload_grid->restoreCurrentRowFormValues($tbl_unload_grid->RowIndex); // Restore form values
		if ($tbl_unload->isGridEdit()) { // Grid edit
			if ($tbl_unload->EventCancelled)
				$tbl_unload_grid->restoreCurrentRowFormValues($tbl_unload_grid->RowIndex); // Restore form values
			if ($tbl_unload_grid->RowAction == "insert")
				$tbl_unload->RowType = ROWTYPE_ADD; // Render add
			else
				$tbl_unload->RowType = ROWTYPE_EDIT; // Render edit
		}
		if ($tbl_unload->isGridEdit() && ($tbl_unload->RowType == ROWTYPE_EDIT || $tbl_unload->RowType == ROWTYPE_ADD) && $tbl_unload->EventCancelled) // Update failed
			$tbl_unload_grid->restoreCurrentRowFormValues($tbl_unload_grid->RowIndex); // Restore form values
		if ($tbl_unload->RowType == ROWTYPE_EDIT) // Edit row
			$tbl_unload_grid->EditRowCnt++;
		if ($tbl_unload->isConfirm()) // Confirm row
			$tbl_unload_grid->restoreCurrentRowFormValues($tbl_unload_grid->RowIndex); // Restore form values

		// Set up row id / data-rowindex
		$tbl_unload->RowAttrs = array_merge($tbl_unload->RowAttrs, array('data-rowindex'=>$tbl_unload_grid->RowCnt, 'id'=>'r' . $tbl_unload_grid->RowCnt . '_tbl_unload', 'data-rowtype'=>$tbl_unload->RowType));

		// Render row
		$tbl_unload_grid->renderRow();

		// Render list options
		$tbl_unload_grid->renderListOptions();

		// Skip delete row / empty row for confirm page
		if ($tbl_unload_grid->RowAction <> "delete" && $tbl_unload_grid->RowAction <> "insertdelete" && !($tbl_unload_grid->RowAction == "insert" && $tbl_unload->isConfirm() && $tbl_unload_grid->emptyRow())) {
?>
	<tr<?php echo $tbl_unload->rowAttributes() ?>>
<?php

// Render list options (body, left)
$tbl_unload_grid->ListOptions->render("body", "left", $tbl_unload_grid->RowCnt);
?>
	<?php if ($tbl_unload->Code->Visible) { // Code ?>
		<td data-name="Code"<?php echo $tbl_unload->Code->cellAttributes() ?>>
<?php if ($tbl_unload->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $tbl_unload_grid->RowCnt ?>_tbl_unload_Code" class="form-group tbl_unload_Code">
<?php
$wrkonchange = "" . trim(@$tbl_unload->Code->EditAttrs["onchange"]);
if (trim($wrkonchange) <> "") $wrkonchange = " onchange=\"" . JsEncode($wrkonchange) . "\"";
$tbl_unload->Code->EditAttrs["onchange"] = "";
?>
<span id="as_x<?php echo $tbl_unload_grid->RowIndex ?>_Code" class="text-nowrap" style="z-index: <?php echo (9000 - $tbl_unload_grid->RowCnt * 10) ?>">
	<input type="text" class="form-control" name="sv_x<?php echo $tbl_unload_grid->RowIndex ?>_Code" id="sv_x<?php echo $tbl_unload_grid->RowIndex ?>_Code" value="<?php echo RemoveHtml($tbl_unload->Code->EditValue) ?>" size="30" placeholder="<?php echo HtmlEncode($tbl_unload->Code->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($tbl_unload->Code->getPlaceHolder()) ?>"<?php echo $tbl_unload->Code->editAttributes() ?>>
</span>
<input type="hidden" data-table="tbl_unload" data-field="x_Code" data-value-separator="<?php echo $tbl_unload->Code->displayValueSeparatorAttribute() ?>" name="x<?php echo $tbl_unload_grid->RowIndex ?>_Code" id="x<?php echo $tbl_unload_grid->RowIndex ?>_Code" value="<?php echo HtmlEncode($tbl_unload->Code->CurrentValue) ?>"<?php echo $wrkonchange ?>>
<script>
ftbl_unloadgrid.createAutoSuggest({"id":"x<?php echo $tbl_unload_grid->RowIndex ?>_Code","forceSelect":true});
</script>
<?php echo $tbl_unload->Code->Lookup->getParamTag("p_x" . $tbl_unload_grid->RowIndex . "_Code") ?>
</span>
<input type="hidden" data-table="tbl_unload" data-field="x_Code" name="o<?php echo $tbl_unload_grid->RowIndex ?>_Code" id="o<?php echo $tbl_unload_grid->RowIndex ?>_Code" value="<?php echo HtmlEncode($tbl_unload->Code->OldValue) ?>">
<?php } ?>
<?php if ($tbl_unload->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $tbl_unload_grid->RowCnt ?>_tbl_unload_Code" class="form-group tbl_unload_Code">
<?php
$wrkonchange = "" . trim(@$tbl_unload->Code->EditAttrs["onchange"]);
if (trim($wrkonchange) <> "") $wrkonchange = " onchange=\"" . JsEncode($wrkonchange) . "\"";
$tbl_unload->Code->EditAttrs["onchange"] = "";
?>
<span id="as_x<?php echo $tbl_unload_grid->RowIndex ?>_Code" class="text-nowrap" style="z-index: <?php echo (9000 - $tbl_unload_grid->RowCnt * 10) ?>">
	<input type="text" class="form-control" name="sv_x<?php echo $tbl_unload_grid->RowIndex ?>_Code" id="sv_x<?php echo $tbl_unload_grid->RowIndex ?>_Code" value="<?php echo RemoveHtml($tbl_unload->Code->EditValue) ?>" size="30" placeholder="<?php echo HtmlEncode($tbl_unload->Code->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($tbl_unload->Code->getPlaceHolder()) ?>"<?php echo $tbl_unload->Code->editAttributes() ?>>
</span>
<input type="hidden" data-table="tbl_unload" data-field="x_Code" data-value-separator="<?php echo $tbl_unload->Code->displayValueSeparatorAttribute() ?>" name="x<?php echo $tbl_unload_grid->RowIndex ?>_Code" id="x<?php echo $tbl_unload_grid->RowIndex ?>_Code" value="<?php echo HtmlEncode($tbl_unload->Code->CurrentValue) ?>"<?php echo $wrkonchange ?>>
<script>
ftbl_unloadgrid.createAutoSuggest({"id":"x<?php echo $tbl_unload_grid->RowIndex ?>_Code","forceSelect":true});
</script>
<?php echo $tbl_unload->Code->Lookup->getParamTag("p_x" . $tbl_unload_grid->RowIndex . "_Code") ?>
</span>
<?php } ?>
<?php if ($tbl_unload->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $tbl_unload_grid->RowCnt ?>_tbl_unload_Code" class="tbl_unload_Code">
<span<?php echo $tbl_unload->Code->viewAttributes() ?>>
<?php echo $tbl_unload->Code->getViewValue() ?></span>
</span>
<?php if (!$tbl_unload->isConfirm()) { ?>
<input type="hidden" data-table="tbl_unload" data-field="x_Code" name="x<?php echo $tbl_unload_grid->RowIndex ?>_Code" id="x<?php echo $tbl_unload_grid->RowIndex ?>_Code" value="<?php echo HtmlEncode($tbl_unload->Code->FormValue) ?>">
<input type="hidden" data-table="tbl_unload" data-field="x_Code" name="o<?php echo $tbl_unload_grid->RowIndex ?>_Code" id="o<?php echo $tbl_unload_grid->RowIndex ?>_Code" value="<?php echo HtmlEncode($tbl_unload->Code->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="tbl_unload" data-field="x_Code" name="ftbl_unloadgrid$x<?php echo $tbl_unload_grid->RowIndex ?>_Code" id="ftbl_unloadgrid$x<?php echo $tbl_unload_grid->RowIndex ?>_Code" value="<?php echo HtmlEncode($tbl_unload->Code->FormValue) ?>">
<input type="hidden" data-table="tbl_unload" data-field="x_Code" name="ftbl_unloadgrid$o<?php echo $tbl_unload_grid->RowIndex ?>_Code" id="ftbl_unloadgrid$o<?php echo $tbl_unload_grid->RowIndex ?>_Code" value="<?php echo HtmlEncode($tbl_unload->Code->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
<?php if ($tbl_unload->RowType == ROWTYPE_ADD) { // Add record ?>
<input type="hidden" data-table="tbl_unload" data-field="x_ID_Unload" name="x<?php echo $tbl_unload_grid->RowIndex ?>_ID_Unload" id="x<?php echo $tbl_unload_grid->RowIndex ?>_ID_Unload" value="<?php echo HtmlEncode($tbl_unload->ID_Unload->CurrentValue) ?>">
<input type="hidden" data-table="tbl_unload" data-field="x_ID_Unload" name="o<?php echo $tbl_unload_grid->RowIndex ?>_ID_Unload" id="o<?php echo $tbl_unload_grid->RowIndex ?>_ID_Unload" value="<?php echo HtmlEncode($tbl_unload->ID_Unload->OldValue) ?>">
<?php } ?>
<?php if ($tbl_unload->RowType == ROWTYPE_EDIT || $tbl_unload->CurrentMode == "edit") { ?>
<input type="hidden" data-table="tbl_unload" data-field="x_ID_Unload" name="x<?php echo $tbl_unload_grid->RowIndex ?>_ID_Unload" id="x<?php echo $tbl_unload_grid->RowIndex ?>_ID_Unload" value="<?php echo HtmlEncode($tbl_unload->ID_Unload->CurrentValue) ?>">
<?php } ?>
	<?php if ($tbl_unload->IdCode->Visible) { // IdCode ?>
		<td data-name="IdCode"<?php echo $tbl_unload->IdCode->cellAttributes() ?>>
<?php if ($tbl_unload->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $tbl_unload_grid->RowCnt ?>_tbl_unload_IdCode" class="form-group tbl_unload_IdCode">
<?php
$wrkonchange = "" . trim(@$tbl_unload->IdCode->EditAttrs["onchange"]);
if (trim($wrkonchange) <> "") $wrkonchange = " onchange=\"" . JsEncode($wrkonchange) . "\"";
$tbl_unload->IdCode->EditAttrs["onchange"] = "";
?>
<span id="as_x<?php echo $tbl_unload_grid->RowIndex ?>_IdCode" class="text-nowrap" style="z-index: <?php echo (9000 - $tbl_unload_grid->RowCnt * 10) ?>">
	<input type="text" class="form-control" name="sv_x<?php echo $tbl_unload_grid->RowIndex ?>_IdCode" id="sv_x<?php echo $tbl_unload_grid->RowIndex ?>_IdCode" value="<?php echo RemoveHtml($tbl_unload->IdCode->EditValue) ?>" size="10" placeholder="<?php echo HtmlEncode($tbl_unload->IdCode->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($tbl_unload->IdCode->getPlaceHolder()) ?>"<?php echo $tbl_unload->IdCode->editAttributes() ?>>
</span>
<input type="hidden" data-table="tbl_unload" data-field="x_IdCode" data-value-separator="<?php echo $tbl_unload->IdCode->displayValueSeparatorAttribute() ?>" name="x<?php echo $tbl_unload_grid->RowIndex ?>_IdCode" id="x<?php echo $tbl_unload_grid->RowIndex ?>_IdCode" value="<?php echo HtmlEncode($tbl_unload->IdCode->CurrentValue) ?>"<?php echo $wrkonchange ?>>
<script>
ftbl_unloadgrid.createAutoSuggest({"id":"x<?php echo $tbl_unload_grid->RowIndex ?>_IdCode","forceSelect":true});
</script>
<?php echo $tbl_unload->IdCode->Lookup->getParamTag("p_x" . $tbl_unload_grid->RowIndex . "_IdCode") ?>
</span>
<input type="hidden" data-table="tbl_unload" data-field="x_IdCode" name="o<?php echo $tbl_unload_grid->RowIndex ?>_IdCode" id="o<?php echo $tbl_unload_grid->RowIndex ?>_IdCode" value="<?php echo HtmlEncode($tbl_unload->IdCode->OldValue) ?>">
<?php } ?>
<?php if ($tbl_unload->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $tbl_unload_grid->RowCnt ?>_tbl_unload_IdCode" class="form-group tbl_unload_IdCode">
<span<?php echo $tbl_unload->IdCode->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?php echo RemoveHtml($tbl_unload->IdCode->EditValue) ?>"></span>
</span>
<input type="hidden" data-table="tbl_unload" data-field="x_IdCode" name="x<?php echo $tbl_unload_grid->RowIndex ?>_IdCode" id="x<?php echo $tbl_unload_grid->RowIndex ?>_IdCode" value="<?php echo HtmlEncode($tbl_unload->IdCode->CurrentValue) ?>">
<?php } ?>
<?php if ($tbl_unload->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $tbl_unload_grid->RowCnt ?>_tbl_unload_IdCode" class="tbl_unload_IdCode">
<span<?php echo $tbl_unload->IdCode->viewAttributes() ?>>
<?php echo $tbl_unload->IdCode->getViewValue() ?></span>
</span>
<?php if (!$tbl_unload->isConfirm()) { ?>
<input type="hidden" data-table="tbl_unload" data-field="x_IdCode" name="x<?php echo $tbl_unload_grid->RowIndex ?>_IdCode" id="x<?php echo $tbl_unload_grid->RowIndex ?>_IdCode" value="<?php echo HtmlEncode($tbl_unload->IdCode->FormValue) ?>">
<input type="hidden" data-table="tbl_unload" data-field="x_IdCode" name="o<?php echo $tbl_unload_grid->RowIndex ?>_IdCode" id="o<?php echo $tbl_unload_grid->RowIndex ?>_IdCode" value="<?php echo HtmlEncode($tbl_unload->IdCode->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="tbl_unload" data-field="x_IdCode" name="ftbl_unloadgrid$x<?php echo $tbl_unload_grid->RowIndex ?>_IdCode" id="ftbl_unloadgrid$x<?php echo $tbl_unload_grid->RowIndex ?>_IdCode" value="<?php echo HtmlEncode($tbl_unload->IdCode->FormValue) ?>">
<input type="hidden" data-table="tbl_unload" data-field="x_IdCode" name="ftbl_unloadgrid$o<?php echo $tbl_unload_grid->RowIndex ?>_IdCode" id="ftbl_unloadgrid$o<?php echo $tbl_unload_grid->RowIndex ?>_IdCode" value="<?php echo HtmlEncode($tbl_unload->IdCode->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($tbl_unload->PCS->Visible) { // PCS ?>
		<td data-name="PCS"<?php echo $tbl_unload->PCS->cellAttributes() ?>>
<?php if ($tbl_unload->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $tbl_unload_grid->RowCnt ?>_tbl_unload_PCS" class="form-group tbl_unload_PCS">
<input type="text" data-table="tbl_unload" data-field="x_PCS" name="x<?php echo $tbl_unload_grid->RowIndex ?>_PCS" id="x<?php echo $tbl_unload_grid->RowIndex ?>_PCS" size="5" placeholder="<?php echo HtmlEncode($tbl_unload->PCS->getPlaceHolder()) ?>" value="<?php echo $tbl_unload->PCS->EditValue ?>"<?php echo $tbl_unload->PCS->editAttributes() ?>>
</span>
<input type="hidden" data-table="tbl_unload" data-field="x_PCS" name="o<?php echo $tbl_unload_grid->RowIndex ?>_PCS" id="o<?php echo $tbl_unload_grid->RowIndex ?>_PCS" value="<?php echo HtmlEncode($tbl_unload->PCS->OldValue) ?>">
<?php } ?>
<?php if ($tbl_unload->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $tbl_unload_grid->RowCnt ?>_tbl_unload_PCS" class="form-group tbl_unload_PCS">
<input type="text" data-table="tbl_unload" data-field="x_PCS" name="x<?php echo $tbl_unload_grid->RowIndex ?>_PCS" id="x<?php echo $tbl_unload_grid->RowIndex ?>_PCS" size="5" placeholder="<?php echo HtmlEncode($tbl_unload->PCS->getPlaceHolder()) ?>" value="<?php echo $tbl_unload->PCS->EditValue ?>"<?php echo $tbl_unload->PCS->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($tbl_unload->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $tbl_unload_grid->RowCnt ?>_tbl_unload_PCS" class="tbl_unload_PCS">
<span<?php echo $tbl_unload->PCS->viewAttributes() ?>>
<?php echo $tbl_unload->PCS->getViewValue() ?></span>
</span>
<?php if (!$tbl_unload->isConfirm()) { ?>
<input type="hidden" data-table="tbl_unload" data-field="x_PCS" name="x<?php echo $tbl_unload_grid->RowIndex ?>_PCS" id="x<?php echo $tbl_unload_grid->RowIndex ?>_PCS" value="<?php echo HtmlEncode($tbl_unload->PCS->FormValue) ?>">
<input type="hidden" data-table="tbl_unload" data-field="x_PCS" name="o<?php echo $tbl_unload_grid->RowIndex ?>_PCS" id="o<?php echo $tbl_unload_grid->RowIndex ?>_PCS" value="<?php echo HtmlEncode($tbl_unload->PCS->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="tbl_unload" data-field="x_PCS" name="ftbl_unloadgrid$x<?php echo $tbl_unload_grid->RowIndex ?>_PCS" id="ftbl_unloadgrid$x<?php echo $tbl_unload_grid->RowIndex ?>_PCS" value="<?php echo HtmlEncode($tbl_unload->PCS->FormValue) ?>">
<input type="hidden" data-table="tbl_unload" data-field="x_PCS" name="ftbl_unloadgrid$o<?php echo $tbl_unload_grid->RowIndex ?>_PCS" id="ftbl_unloadgrid$o<?php echo $tbl_unload_grid->RowIndex ?>_PCS" value="<?php echo HtmlEncode($tbl_unload->PCS->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($tbl_unload->RealPCS->Visible) { // RealPCS ?>
		<td data-name="RealPCS"<?php echo $tbl_unload->RealPCS->cellAttributes() ?>>
<?php if ($tbl_unload->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $tbl_unload_grid->RowCnt ?>_tbl_unload_RealPCS" class="form-group tbl_unload_RealPCS">
<input type="text" data-table="tbl_unload" data-field="x_RealPCS" name="x<?php echo $tbl_unload_grid->RowIndex ?>_RealPCS" id="x<?php echo $tbl_unload_grid->RowIndex ?>_RealPCS" size="5" placeholder="<?php echo HtmlEncode($tbl_unload->RealPCS->getPlaceHolder()) ?>" value="<?php echo $tbl_unload->RealPCS->EditValue ?>"<?php echo $tbl_unload->RealPCS->editAttributes() ?>>
</span>
<input type="hidden" data-table="tbl_unload" data-field="x_RealPCS" name="o<?php echo $tbl_unload_grid->RowIndex ?>_RealPCS" id="o<?php echo $tbl_unload_grid->RowIndex ?>_RealPCS" value="<?php echo HtmlEncode($tbl_unload->RealPCS->OldValue) ?>">
<?php } ?>
<?php if ($tbl_unload->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $tbl_unload_grid->RowCnt ?>_tbl_unload_RealPCS" class="form-group tbl_unload_RealPCS">
<input type="text" data-table="tbl_unload" data-field="x_RealPCS" name="x<?php echo $tbl_unload_grid->RowIndex ?>_RealPCS" id="x<?php echo $tbl_unload_grid->RowIndex ?>_RealPCS" size="5" placeholder="<?php echo HtmlEncode($tbl_unload->RealPCS->getPlaceHolder()) ?>" value="<?php echo $tbl_unload->RealPCS->EditValue ?>"<?php echo $tbl_unload->RealPCS->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($tbl_unload->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $tbl_unload_grid->RowCnt ?>_tbl_unload_RealPCS" class="tbl_unload_RealPCS">
<span<?php echo $tbl_unload->RealPCS->viewAttributes() ?>>
<?php echo $tbl_unload->RealPCS->getViewValue() ?></span>
</span>
<?php if (!$tbl_unload->isConfirm()) { ?>
<input type="hidden" data-table="tbl_unload" data-field="x_RealPCS" name="x<?php echo $tbl_unload_grid->RowIndex ?>_RealPCS" id="x<?php echo $tbl_unload_grid->RowIndex ?>_RealPCS" value="<?php echo HtmlEncode($tbl_unload->RealPCS->FormValue) ?>">
<input type="hidden" data-table="tbl_unload" data-field="x_RealPCS" name="o<?php echo $tbl_unload_grid->RowIndex ?>_RealPCS" id="o<?php echo $tbl_unload_grid->RowIndex ?>_RealPCS" value="<?php echo HtmlEncode($tbl_unload->RealPCS->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="tbl_unload" data-field="x_RealPCS" name="ftbl_unloadgrid$x<?php echo $tbl_unload_grid->RowIndex ?>_RealPCS" id="ftbl_unloadgrid$x<?php echo $tbl_unload_grid->RowIndex ?>_RealPCS" value="<?php echo HtmlEncode($tbl_unload->RealPCS->FormValue) ?>">
<input type="hidden" data-table="tbl_unload" data-field="x_RealPCS" name="ftbl_unloadgrid$o<?php echo $tbl_unload_grid->RowIndex ?>_RealPCS" id="ftbl_unloadgrid$o<?php echo $tbl_unload_grid->RowIndex ?>_RealPCS" value="<?php echo HtmlEncode($tbl_unload->RealPCS->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($tbl_unload->Description->Visible) { // Description ?>
		<td data-name="Description"<?php echo $tbl_unload->Description->cellAttributes() ?>>
<?php if ($tbl_unload->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $tbl_unload_grid->RowCnt ?>_tbl_unload_Description" class="form-group tbl_unload_Description">
<input type="text" data-table="tbl_unload" data-field="x_Description" name="x<?php echo $tbl_unload_grid->RowIndex ?>_Description" id="x<?php echo $tbl_unload_grid->RowIndex ?>_Description" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($tbl_unload->Description->getPlaceHolder()) ?>" value="<?php echo $tbl_unload->Description->EditValue ?>"<?php echo $tbl_unload->Description->editAttributes() ?>>
</span>
<input type="hidden" data-table="tbl_unload" data-field="x_Description" name="o<?php echo $tbl_unload_grid->RowIndex ?>_Description" id="o<?php echo $tbl_unload_grid->RowIndex ?>_Description" value="<?php echo HtmlEncode($tbl_unload->Description->OldValue) ?>">
<?php } ?>
<?php if ($tbl_unload->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $tbl_unload_grid->RowCnt ?>_tbl_unload_Description" class="form-group tbl_unload_Description">
<input type="text" data-table="tbl_unload" data-field="x_Description" name="x<?php echo $tbl_unload_grid->RowIndex ?>_Description" id="x<?php echo $tbl_unload_grid->RowIndex ?>_Description" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($tbl_unload->Description->getPlaceHolder()) ?>" value="<?php echo $tbl_unload->Description->EditValue ?>"<?php echo $tbl_unload->Description->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($tbl_unload->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $tbl_unload_grid->RowCnt ?>_tbl_unload_Description" class="tbl_unload_Description">
<span<?php echo $tbl_unload->Description->viewAttributes() ?>>
<?php echo $tbl_unload->Description->getViewValue() ?></span>
</span>
<?php if (!$tbl_unload->isConfirm()) { ?>
<input type="hidden" data-table="tbl_unload" data-field="x_Description" name="x<?php echo $tbl_unload_grid->RowIndex ?>_Description" id="x<?php echo $tbl_unload_grid->RowIndex ?>_Description" value="<?php echo HtmlEncode($tbl_unload->Description->FormValue) ?>">
<input type="hidden" data-table="tbl_unload" data-field="x_Description" name="o<?php echo $tbl_unload_grid->RowIndex ?>_Description" id="o<?php echo $tbl_unload_grid->RowIndex ?>_Description" value="<?php echo HtmlEncode($tbl_unload->Description->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="tbl_unload" data-field="x_Description" name="ftbl_unloadgrid$x<?php echo $tbl_unload_grid->RowIndex ?>_Description" id="ftbl_unloadgrid$x<?php echo $tbl_unload_grid->RowIndex ?>_Description" value="<?php echo HtmlEncode($tbl_unload->Description->FormValue) ?>">
<input type="hidden" data-table="tbl_unload" data-field="x_Description" name="ftbl_unloadgrid$o<?php echo $tbl_unload_grid->RowIndex ?>_Description" id="ftbl_unloadgrid$o<?php echo $tbl_unload_grid->RowIndex ?>_Description" value="<?php echo HtmlEncode($tbl_unload->Description->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($tbl_unload->CreateUser->Visible) { // CreateUser ?>
		<td data-name="CreateUser"<?php echo $tbl_unload->CreateUser->cellAttributes() ?>>
<?php if ($tbl_unload->RowType == ROWTYPE_ADD) { // Add record ?>
<input type="hidden" data-table="tbl_unload" data-field="x_CreateUser" name="o<?php echo $tbl_unload_grid->RowIndex ?>_CreateUser" id="o<?php echo $tbl_unload_grid->RowIndex ?>_CreateUser" value="<?php echo HtmlEncode($tbl_unload->CreateUser->OldValue) ?>">
<?php } ?>
<?php if ($tbl_unload->RowType == ROWTYPE_EDIT) { // Edit record ?>
<?php } ?>
<?php if ($tbl_unload->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $tbl_unload_grid->RowCnt ?>_tbl_unload_CreateUser" class="tbl_unload_CreateUser">
<span<?php echo $tbl_unload->CreateUser->viewAttributes() ?>>
<?php echo $tbl_unload->CreateUser->getViewValue() ?></span>
</span>
<?php if (!$tbl_unload->isConfirm()) { ?>
<input type="hidden" data-table="tbl_unload" data-field="x_CreateUser" name="x<?php echo $tbl_unload_grid->RowIndex ?>_CreateUser" id="x<?php echo $tbl_unload_grid->RowIndex ?>_CreateUser" value="<?php echo HtmlEncode($tbl_unload->CreateUser->FormValue) ?>">
<input type="hidden" data-table="tbl_unload" data-field="x_CreateUser" name="o<?php echo $tbl_unload_grid->RowIndex ?>_CreateUser" id="o<?php echo $tbl_unload_grid->RowIndex ?>_CreateUser" value="<?php echo HtmlEncode($tbl_unload->CreateUser->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="tbl_unload" data-field="x_CreateUser" name="ftbl_unloadgrid$x<?php echo $tbl_unload_grid->RowIndex ?>_CreateUser" id="ftbl_unloadgrid$x<?php echo $tbl_unload_grid->RowIndex ?>_CreateUser" value="<?php echo HtmlEncode($tbl_unload->CreateUser->FormValue) ?>">
<input type="hidden" data-table="tbl_unload" data-field="x_CreateUser" name="ftbl_unloadgrid$o<?php echo $tbl_unload_grid->RowIndex ?>_CreateUser" id="ftbl_unloadgrid$o<?php echo $tbl_unload_grid->RowIndex ?>_CreateUser" value="<?php echo HtmlEncode($tbl_unload->CreateUser->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($tbl_unload->CreateDate->Visible) { // CreateDate ?>
		<td data-name="CreateDate"<?php echo $tbl_unload->CreateDate->cellAttributes() ?>>
<?php if ($tbl_unload->RowType == ROWTYPE_ADD) { // Add record ?>
<input type="hidden" data-table="tbl_unload" data-field="x_CreateDate" name="o<?php echo $tbl_unload_grid->RowIndex ?>_CreateDate" id="o<?php echo $tbl_unload_grid->RowIndex ?>_CreateDate" value="<?php echo HtmlEncode($tbl_unload->CreateDate->OldValue) ?>">
<?php } ?>
<?php if ($tbl_unload->RowType == ROWTYPE_EDIT) { // Edit record ?>
<?php } ?>
<?php if ($tbl_unload->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $tbl_unload_grid->RowCnt ?>_tbl_unload_CreateDate" class="tbl_unload_CreateDate">
<span<?php echo $tbl_unload->CreateDate->viewAttributes() ?>>
<?php echo $tbl_unload->CreateDate->getViewValue() ?></span>
</span>
<?php if (!$tbl_unload->isConfirm()) { ?>
<input type="hidden" data-table="tbl_unload" data-field="x_CreateDate" name="x<?php echo $tbl_unload_grid->RowIndex ?>_CreateDate" id="x<?php echo $tbl_unload_grid->RowIndex ?>_CreateDate" value="<?php echo HtmlEncode($tbl_unload->CreateDate->FormValue) ?>">
<input type="hidden" data-table="tbl_unload" data-field="x_CreateDate" name="o<?php echo $tbl_unload_grid->RowIndex ?>_CreateDate" id="o<?php echo $tbl_unload_grid->RowIndex ?>_CreateDate" value="<?php echo HtmlEncode($tbl_unload->CreateDate->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="tbl_unload" data-field="x_CreateDate" name="ftbl_unloadgrid$x<?php echo $tbl_unload_grid->RowIndex ?>_CreateDate" id="ftbl_unloadgrid$x<?php echo $tbl_unload_grid->RowIndex ?>_CreateDate" value="<?php echo HtmlEncode($tbl_unload->CreateDate->FormValue) ?>">
<input type="hidden" data-table="tbl_unload" data-field="x_CreateDate" name="ftbl_unloadgrid$o<?php echo $tbl_unload_grid->RowIndex ?>_CreateDate" id="ftbl_unloadgrid$o<?php echo $tbl_unload_grid->RowIndex ?>_CreateDate" value="<?php echo HtmlEncode($tbl_unload->CreateDate->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($tbl_unload->MFG->Visible) { // MFG ?>
		<td data-name="MFG"<?php echo $tbl_unload->MFG->cellAttributes() ?>>
<?php if ($tbl_unload->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $tbl_unload_grid->RowCnt ?>_tbl_unload_MFG" class="form-group tbl_unload_MFG">
<input type="text" data-table="tbl_unload" data-field="x_MFG" data-format="7" name="x<?php echo $tbl_unload_grid->RowIndex ?>_MFG" id="x<?php echo $tbl_unload_grid->RowIndex ?>_MFG" placeholder="<?php echo HtmlEncode($tbl_unload->MFG->getPlaceHolder()) ?>" value="<?php echo $tbl_unload->MFG->EditValue ?>"<?php echo $tbl_unload->MFG->editAttributes() ?>>
<?php if (!$tbl_unload->MFG->ReadOnly && !$tbl_unload->MFG->Disabled && !isset($tbl_unload->MFG->EditAttrs["readonly"]) && !isset($tbl_unload->MFG->EditAttrs["disabled"])) { ?>
<script>
ew.createDateTimePicker("ftbl_unloadgrid", "x<?php echo $tbl_unload_grid->RowIndex ?>_MFG", {"ignoreReadonly":true,"useCurrent":false,"format":7});
</script>
<?php } ?>
</span>
<input type="hidden" data-table="tbl_unload" data-field="x_MFG" name="o<?php echo $tbl_unload_grid->RowIndex ?>_MFG" id="o<?php echo $tbl_unload_grid->RowIndex ?>_MFG" value="<?php echo HtmlEncode($tbl_unload->MFG->OldValue) ?>">
<?php } ?>
<?php if ($tbl_unload->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $tbl_unload_grid->RowCnt ?>_tbl_unload_MFG" class="form-group tbl_unload_MFG">
<input type="text" data-table="tbl_unload" data-field="x_MFG" data-format="7" name="x<?php echo $tbl_unload_grid->RowIndex ?>_MFG" id="x<?php echo $tbl_unload_grid->RowIndex ?>_MFG" placeholder="<?php echo HtmlEncode($tbl_unload->MFG->getPlaceHolder()) ?>" value="<?php echo $tbl_unload->MFG->EditValue ?>"<?php echo $tbl_unload->MFG->editAttributes() ?>>
<?php if (!$tbl_unload->MFG->ReadOnly && !$tbl_unload->MFG->Disabled && !isset($tbl_unload->MFG->EditAttrs["readonly"]) && !isset($tbl_unload->MFG->EditAttrs["disabled"])) { ?>
<script>
ew.createDateTimePicker("ftbl_unloadgrid", "x<?php echo $tbl_unload_grid->RowIndex ?>_MFG", {"ignoreReadonly":true,"useCurrent":false,"format":7});
</script>
<?php } ?>
</span>
<?php } ?>
<?php if ($tbl_unload->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $tbl_unload_grid->RowCnt ?>_tbl_unload_MFG" class="tbl_unload_MFG">
<span<?php echo $tbl_unload->MFG->viewAttributes() ?>>
<?php echo $tbl_unload->MFG->getViewValue() ?></span>
</span>
<?php if (!$tbl_unload->isConfirm()) { ?>
<input type="hidden" data-table="tbl_unload" data-field="x_MFG" name="x<?php echo $tbl_unload_grid->RowIndex ?>_MFG" id="x<?php echo $tbl_unload_grid->RowIndex ?>_MFG" value="<?php echo HtmlEncode($tbl_unload->MFG->FormValue) ?>">
<input type="hidden" data-table="tbl_unload" data-field="x_MFG" name="o<?php echo $tbl_unload_grid->RowIndex ?>_MFG" id="o<?php echo $tbl_unload_grid->RowIndex ?>_MFG" value="<?php echo HtmlEncode($tbl_unload->MFG->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="tbl_unload" data-field="x_MFG" name="ftbl_unloadgrid$x<?php echo $tbl_unload_grid->RowIndex ?>_MFG" id="ftbl_unloadgrid$x<?php echo $tbl_unload_grid->RowIndex ?>_MFG" value="<?php echo HtmlEncode($tbl_unload->MFG->FormValue) ?>">
<input type="hidden" data-table="tbl_unload" data-field="x_MFG" name="ftbl_unloadgrid$o<?php echo $tbl_unload_grid->RowIndex ?>_MFG" id="ftbl_unloadgrid$o<?php echo $tbl_unload_grid->RowIndex ?>_MFG" value="<?php echo HtmlEncode($tbl_unload->MFG->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$tbl_unload_grid->ListOptions->render("body", "right", $tbl_unload_grid->RowCnt);
?>
	</tr>
<?php if ($tbl_unload->RowType == ROWTYPE_ADD || $tbl_unload->RowType == ROWTYPE_EDIT) { ?>
<script>
ftbl_unloadgrid.updateLists(<?php echo $tbl_unload_grid->RowIndex ?>);
</script>
<?php } ?>
<?php
	}
	} // End delete row checking
	if (!$tbl_unload->isGridAdd() || $tbl_unload->CurrentMode == "copy")
		if (!$tbl_unload_grid->Recordset->EOF)
			$tbl_unload_grid->Recordset->moveNext();
}
?>
<?php
	if ($tbl_unload->CurrentMode == "add" || $tbl_unload->CurrentMode == "copy" || $tbl_unload->CurrentMode == "edit") {
		$tbl_unload_grid->RowIndex = '$rowindex$';
		$tbl_unload_grid->loadRowValues();

		// Set row properties
		$tbl_unload->resetAttributes();
		$tbl_unload->RowAttrs = array_merge($tbl_unload->RowAttrs, array('data-rowindex'=>$tbl_unload_grid->RowIndex, 'id'=>'r0_tbl_unload', 'data-rowtype'=>ROWTYPE_ADD));
		AppendClass($tbl_unload->RowAttrs["class"], "ew-template");
		$tbl_unload->RowType = ROWTYPE_ADD;

		// Render row
		$tbl_unload_grid->renderRow();

		// Render list options
		$tbl_unload_grid->renderListOptions();
		$tbl_unload_grid->StartRowCnt = 0;
?>
	<tr<?php echo $tbl_unload->rowAttributes() ?>>
<?php

// Render list options (body, left)
$tbl_unload_grid->ListOptions->render("body", "left", $tbl_unload_grid->RowIndex);
?>
	<?php if ($tbl_unload->Code->Visible) { // Code ?>
		<td data-name="Code">
<?php if (!$tbl_unload->isConfirm()) { ?>
<span id="el$rowindex$_tbl_unload_Code" class="form-group tbl_unload_Code">
<?php
$wrkonchange = "" . trim(@$tbl_unload->Code->EditAttrs["onchange"]);
if (trim($wrkonchange) <> "") $wrkonchange = " onchange=\"" . JsEncode($wrkonchange) . "\"";
$tbl_unload->Code->EditAttrs["onchange"] = "";
?>
<span id="as_x<?php echo $tbl_unload_grid->RowIndex ?>_Code" class="text-nowrap" style="z-index: <?php echo (9000 - $tbl_unload_grid->RowCnt * 10) ?>">
	<input type="text" class="form-control" name="sv_x<?php echo $tbl_unload_grid->RowIndex ?>_Code" id="sv_x<?php echo $tbl_unload_grid->RowIndex ?>_Code" value="<?php echo RemoveHtml($tbl_unload->Code->EditValue) ?>" size="30" placeholder="<?php echo HtmlEncode($tbl_unload->Code->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($tbl_unload->Code->getPlaceHolder()) ?>"<?php echo $tbl_unload->Code->editAttributes() ?>>
</span>
<input type="hidden" data-table="tbl_unload" data-field="x_Code" data-value-separator="<?php echo $tbl_unload->Code->displayValueSeparatorAttribute() ?>" name="x<?php echo $tbl_unload_grid->RowIndex ?>_Code" id="x<?php echo $tbl_unload_grid->RowIndex ?>_Code" value="<?php echo HtmlEncode($tbl_unload->Code->CurrentValue) ?>"<?php echo $wrkonchange ?>>
<script>
ftbl_unloadgrid.createAutoSuggest({"id":"x<?php echo $tbl_unload_grid->RowIndex ?>_Code","forceSelect":true});
</script>
<?php echo $tbl_unload->Code->Lookup->getParamTag("p_x" . $tbl_unload_grid->RowIndex . "_Code") ?>
</span>
<?php } else { ?>
<span id="el$rowindex$_tbl_unload_Code" class="form-group tbl_unload_Code">
<span<?php echo $tbl_unload->Code->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?php echo RemoveHtml($tbl_unload->Code->ViewValue) ?>"></span>
</span>
<input type="hidden" data-table="tbl_unload" data-field="x_Code" name="x<?php echo $tbl_unload_grid->RowIndex ?>_Code" id="x<?php echo $tbl_unload_grid->RowIndex ?>_Code" value="<?php echo HtmlEncode($tbl_unload->Code->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="tbl_unload" data-field="x_Code" name="o<?php echo $tbl_unload_grid->RowIndex ?>_Code" id="o<?php echo $tbl_unload_grid->RowIndex ?>_Code" value="<?php echo HtmlEncode($tbl_unload->Code->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($tbl_unload->IdCode->Visible) { // IdCode ?>
		<td data-name="IdCode">
<?php if (!$tbl_unload->isConfirm()) { ?>
<span id="el$rowindex$_tbl_unload_IdCode" class="form-group tbl_unload_IdCode">
<?php
$wrkonchange = "" . trim(@$tbl_unload->IdCode->EditAttrs["onchange"]);
if (trim($wrkonchange) <> "") $wrkonchange = " onchange=\"" . JsEncode($wrkonchange) . "\"";
$tbl_unload->IdCode->EditAttrs["onchange"] = "";
?>
<span id="as_x<?php echo $tbl_unload_grid->RowIndex ?>_IdCode" class="text-nowrap" style="z-index: <?php echo (9000 - $tbl_unload_grid->RowCnt * 10) ?>">
	<input type="text" class="form-control" name="sv_x<?php echo $tbl_unload_grid->RowIndex ?>_IdCode" id="sv_x<?php echo $tbl_unload_grid->RowIndex ?>_IdCode" value="<?php echo RemoveHtml($tbl_unload->IdCode->EditValue) ?>" size="10" placeholder="<?php echo HtmlEncode($tbl_unload->IdCode->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($tbl_unload->IdCode->getPlaceHolder()) ?>"<?php echo $tbl_unload->IdCode->editAttributes() ?>>
</span>
<input type="hidden" data-table="tbl_unload" data-field="x_IdCode" data-value-separator="<?php echo $tbl_unload->IdCode->displayValueSeparatorAttribute() ?>" name="x<?php echo $tbl_unload_grid->RowIndex ?>_IdCode" id="x<?php echo $tbl_unload_grid->RowIndex ?>_IdCode" value="<?php echo HtmlEncode($tbl_unload->IdCode->CurrentValue) ?>"<?php echo $wrkonchange ?>>
<script>
ftbl_unloadgrid.createAutoSuggest({"id":"x<?php echo $tbl_unload_grid->RowIndex ?>_IdCode","forceSelect":true});
</script>
<?php echo $tbl_unload->IdCode->Lookup->getParamTag("p_x" . $tbl_unload_grid->RowIndex . "_IdCode") ?>
</span>
<?php } else { ?>
<span id="el$rowindex$_tbl_unload_IdCode" class="form-group tbl_unload_IdCode">
<span<?php echo $tbl_unload->IdCode->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?php echo RemoveHtml($tbl_unload->IdCode->ViewValue) ?>"></span>
</span>
<input type="hidden" data-table="tbl_unload" data-field="x_IdCode" name="x<?php echo $tbl_unload_grid->RowIndex ?>_IdCode" id="x<?php echo $tbl_unload_grid->RowIndex ?>_IdCode" value="<?php echo HtmlEncode($tbl_unload->IdCode->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="tbl_unload" data-field="x_IdCode" name="o<?php echo $tbl_unload_grid->RowIndex ?>_IdCode" id="o<?php echo $tbl_unload_grid->RowIndex ?>_IdCode" value="<?php echo HtmlEncode($tbl_unload->IdCode->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($tbl_unload->PCS->Visible) { // PCS ?>
		<td data-name="PCS">
<?php if (!$tbl_unload->isConfirm()) { ?>
<span id="el$rowindex$_tbl_unload_PCS" class="form-group tbl_unload_PCS">
<input type="text" data-table="tbl_unload" data-field="x_PCS" name="x<?php echo $tbl_unload_grid->RowIndex ?>_PCS" id="x<?php echo $tbl_unload_grid->RowIndex ?>_PCS" size="5" placeholder="<?php echo HtmlEncode($tbl_unload->PCS->getPlaceHolder()) ?>" value="<?php echo $tbl_unload->PCS->EditValue ?>"<?php echo $tbl_unload->PCS->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_tbl_unload_PCS" class="form-group tbl_unload_PCS">
<span<?php echo $tbl_unload->PCS->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?php echo RemoveHtml($tbl_unload->PCS->ViewValue) ?>"></span>
</span>
<input type="hidden" data-table="tbl_unload" data-field="x_PCS" name="x<?php echo $tbl_unload_grid->RowIndex ?>_PCS" id="x<?php echo $tbl_unload_grid->RowIndex ?>_PCS" value="<?php echo HtmlEncode($tbl_unload->PCS->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="tbl_unload" data-field="x_PCS" name="o<?php echo $tbl_unload_grid->RowIndex ?>_PCS" id="o<?php echo $tbl_unload_grid->RowIndex ?>_PCS" value="<?php echo HtmlEncode($tbl_unload->PCS->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($tbl_unload->RealPCS->Visible) { // RealPCS ?>
		<td data-name="RealPCS">
<?php if (!$tbl_unload->isConfirm()) { ?>
<span id="el$rowindex$_tbl_unload_RealPCS" class="form-group tbl_unload_RealPCS">
<input type="text" data-table="tbl_unload" data-field="x_RealPCS" name="x<?php echo $tbl_unload_grid->RowIndex ?>_RealPCS" id="x<?php echo $tbl_unload_grid->RowIndex ?>_RealPCS" size="5" placeholder="<?php echo HtmlEncode($tbl_unload->RealPCS->getPlaceHolder()) ?>" value="<?php echo $tbl_unload->RealPCS->EditValue ?>"<?php echo $tbl_unload->RealPCS->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_tbl_unload_RealPCS" class="form-group tbl_unload_RealPCS">
<span<?php echo $tbl_unload->RealPCS->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?php echo RemoveHtml($tbl_unload->RealPCS->ViewValue) ?>"></span>
</span>
<input type="hidden" data-table="tbl_unload" data-field="x_RealPCS" name="x<?php echo $tbl_unload_grid->RowIndex ?>_RealPCS" id="x<?php echo $tbl_unload_grid->RowIndex ?>_RealPCS" value="<?php echo HtmlEncode($tbl_unload->RealPCS->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="tbl_unload" data-field="x_RealPCS" name="o<?php echo $tbl_unload_grid->RowIndex ?>_RealPCS" id="o<?php echo $tbl_unload_grid->RowIndex ?>_RealPCS" value="<?php echo HtmlEncode($tbl_unload->RealPCS->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($tbl_unload->Description->Visible) { // Description ?>
		<td data-name="Description">
<?php if (!$tbl_unload->isConfirm()) { ?>
<span id="el$rowindex$_tbl_unload_Description" class="form-group tbl_unload_Description">
<input type="text" data-table="tbl_unload" data-field="x_Description" name="x<?php echo $tbl_unload_grid->RowIndex ?>_Description" id="x<?php echo $tbl_unload_grid->RowIndex ?>_Description" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($tbl_unload->Description->getPlaceHolder()) ?>" value="<?php echo $tbl_unload->Description->EditValue ?>"<?php echo $tbl_unload->Description->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_tbl_unload_Description" class="form-group tbl_unload_Description">
<span<?php echo $tbl_unload->Description->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?php echo RemoveHtml($tbl_unload->Description->ViewValue) ?>"></span>
</span>
<input type="hidden" data-table="tbl_unload" data-field="x_Description" name="x<?php echo $tbl_unload_grid->RowIndex ?>_Description" id="x<?php echo $tbl_unload_grid->RowIndex ?>_Description" value="<?php echo HtmlEncode($tbl_unload->Description->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="tbl_unload" data-field="x_Description" name="o<?php echo $tbl_unload_grid->RowIndex ?>_Description" id="o<?php echo $tbl_unload_grid->RowIndex ?>_Description" value="<?php echo HtmlEncode($tbl_unload->Description->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($tbl_unload->CreateUser->Visible) { // CreateUser ?>
		<td data-name="CreateUser">
<?php if (!$tbl_unload->isConfirm()) { ?>
<?php } else { ?>
<span id="el$rowindex$_tbl_unload_CreateUser" class="form-group tbl_unload_CreateUser">
<span<?php echo $tbl_unload->CreateUser->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?php echo RemoveHtml($tbl_unload->CreateUser->ViewValue) ?>"></span>
</span>
<input type="hidden" data-table="tbl_unload" data-field="x_CreateUser" name="x<?php echo $tbl_unload_grid->RowIndex ?>_CreateUser" id="x<?php echo $tbl_unload_grid->RowIndex ?>_CreateUser" value="<?php echo HtmlEncode($tbl_unload->CreateUser->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="tbl_unload" data-field="x_CreateUser" name="o<?php echo $tbl_unload_grid->RowIndex ?>_CreateUser" id="o<?php echo $tbl_unload_grid->RowIndex ?>_CreateUser" value="<?php echo HtmlEncode($tbl_unload->CreateUser->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($tbl_unload->CreateDate->Visible) { // CreateDate ?>
		<td data-name="CreateDate">
<?php if (!$tbl_unload->isConfirm()) { ?>
<?php } else { ?>
<span id="el$rowindex$_tbl_unload_CreateDate" class="form-group tbl_unload_CreateDate">
<span<?php echo $tbl_unload->CreateDate->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?php echo RemoveHtml($tbl_unload->CreateDate->ViewValue) ?>"></span>
</span>
<input type="hidden" data-table="tbl_unload" data-field="x_CreateDate" name="x<?php echo $tbl_unload_grid->RowIndex ?>_CreateDate" id="x<?php echo $tbl_unload_grid->RowIndex ?>_CreateDate" value="<?php echo HtmlEncode($tbl_unload->CreateDate->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="tbl_unload" data-field="x_CreateDate" name="o<?php echo $tbl_unload_grid->RowIndex ?>_CreateDate" id="o<?php echo $tbl_unload_grid->RowIndex ?>_CreateDate" value="<?php echo HtmlEncode($tbl_unload->CreateDate->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($tbl_unload->MFG->Visible) { // MFG ?>
		<td data-name="MFG">
<?php if (!$tbl_unload->isConfirm()) { ?>
<span id="el$rowindex$_tbl_unload_MFG" class="form-group tbl_unload_MFG">
<input type="text" data-table="tbl_unload" data-field="x_MFG" data-format="7" name="x<?php echo $tbl_unload_grid->RowIndex ?>_MFG" id="x<?php echo $tbl_unload_grid->RowIndex ?>_MFG" placeholder="<?php echo HtmlEncode($tbl_unload->MFG->getPlaceHolder()) ?>" value="<?php echo $tbl_unload->MFG->EditValue ?>"<?php echo $tbl_unload->MFG->editAttributes() ?>>
<?php if (!$tbl_unload->MFG->ReadOnly && !$tbl_unload->MFG->Disabled && !isset($tbl_unload->MFG->EditAttrs["readonly"]) && !isset($tbl_unload->MFG->EditAttrs["disabled"])) { ?>
<script>
ew.createDateTimePicker("ftbl_unloadgrid", "x<?php echo $tbl_unload_grid->RowIndex ?>_MFG", {"ignoreReadonly":true,"useCurrent":false,"format":7});
</script>
<?php } ?>
</span>
<?php } else { ?>
<span id="el$rowindex$_tbl_unload_MFG" class="form-group tbl_unload_MFG">
<span<?php echo $tbl_unload->MFG->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?php echo RemoveHtml($tbl_unload->MFG->ViewValue) ?>"></span>
</span>
<input type="hidden" data-table="tbl_unload" data-field="x_MFG" name="x<?php echo $tbl_unload_grid->RowIndex ?>_MFG" id="x<?php echo $tbl_unload_grid->RowIndex ?>_MFG" value="<?php echo HtmlEncode($tbl_unload->MFG->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="tbl_unload" data-field="x_MFG" name="o<?php echo $tbl_unload_grid->RowIndex ?>_MFG" id="o<?php echo $tbl_unload_grid->RowIndex ?>_MFG" value="<?php echo HtmlEncode($tbl_unload->MFG->OldValue) ?>">
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$tbl_unload_grid->ListOptions->render("body", "right", $tbl_unload_grid->RowIndex);
?>
<script>
ftbl_unloadgrid.updateLists(<?php echo $tbl_unload_grid->RowIndex ?>);
</script>
	</tr>
<?php
}
?>
</tbody>
<?php

// Render aggregate row
$tbl_unload->RowType = ROWTYPE_AGGREGATE;
$tbl_unload->resetAttributes();
$tbl_unload_grid->renderRow();
?>
<?php if ($tbl_unload_grid->TotalRecs > 0 && $tbl_unload->CurrentMode == "view") { ?>
<tfoot><!-- Table footer -->
	<tr class="ew-table-footer">
<?php

// Render list options
$tbl_unload_grid->renderListOptions();

// Render list options (footer, left)
$tbl_unload_grid->ListOptions->render("footer", "left");
?>
	<?php if ($tbl_unload->Code->Visible) { // Code ?>
		<td data-name="Code" class="<?php echo $tbl_unload->Code->footerCellClass() ?>"><span id="elf_tbl_unload_Code" class="tbl_unload_Code">
		&nbsp;
		</span></td>
	<?php } ?>
	<?php if ($tbl_unload->IdCode->Visible) { // IdCode ?>
		<td data-name="IdCode" class="<?php echo $tbl_unload->IdCode->footerCellClass() ?>"><span id="elf_tbl_unload_IdCode" class="tbl_unload_IdCode">
		&nbsp;
		</span></td>
	<?php } ?>
	<?php if ($tbl_unload->PCS->Visible) { // PCS ?>
		<td data-name="PCS" class="<?php echo $tbl_unload->PCS->footerCellClass() ?>"><span id="elf_tbl_unload_PCS" class="tbl_unload_PCS">
		<span class="ew-aggregate"><?php echo $Language->phrase("TOTAL") ?></span><span class="ew-aggregate-value">
		<?php echo $tbl_unload->PCS->ViewValue ?></span>
		</span></td>
	<?php } ?>
	<?php if ($tbl_unload->RealPCS->Visible) { // RealPCS ?>
		<td data-name="RealPCS" class="<?php echo $tbl_unload->RealPCS->footerCellClass() ?>"><span id="elf_tbl_unload_RealPCS" class="tbl_unload_RealPCS">
		<span class="ew-aggregate"><?php echo $Language->phrase("TOTAL") ?></span><span class="ew-aggregate-value">
		<?php echo $tbl_unload->RealPCS->ViewValue ?></span>
		</span></td>
	<?php } ?>
	<?php if ($tbl_unload->Description->Visible) { // Description ?>
		<td data-name="Description" class="<?php echo $tbl_unload->Description->footerCellClass() ?>"><span id="elf_tbl_unload_Description" class="tbl_unload_Description">
		&nbsp;
		</span></td>
	<?php } ?>
	<?php if ($tbl_unload->CreateUser->Visible) { // CreateUser ?>
		<td data-name="CreateUser" class="<?php echo $tbl_unload->CreateUser->footerCellClass() ?>"><span id="elf_tbl_unload_CreateUser" class="tbl_unload_CreateUser">
		&nbsp;
		</span></td>
	<?php } ?>
	<?php if ($tbl_unload->CreateDate->Visible) { // CreateDate ?>
		<td data-name="CreateDate" class="<?php echo $tbl_unload->CreateDate->footerCellClass() ?>"><span id="elf_tbl_unload_CreateDate" class="tbl_unload_CreateDate">
		&nbsp;
		</span></td>
	<?php } ?>
	<?php if ($tbl_unload->MFG->Visible) { // MFG ?>
		<td data-name="MFG" class="<?php echo $tbl_unload->MFG->footerCellClass() ?>"><span id="elf_tbl_unload_MFG" class="tbl_unload_MFG">
		&nbsp;
		</span></td>
	<?php } ?>
<?php

// Render list options (footer, right)
$tbl_unload_grid->ListOptions->render("footer", "right");
?>
	</tr>
</tfoot>
<?php } ?>
</table><!-- /.ew-table -->
<?php if ($tbl_unload->CurrentMode == "add" || $tbl_unload->CurrentMode == "copy") { ?>
<input type="hidden" name="<?php echo $tbl_unload_grid->FormKeyCountName ?>" id="<?php echo $tbl_unload_grid->FormKeyCountName ?>" value="<?php echo $tbl_unload_grid->KeyCount ?>">
<?php echo $tbl_unload_grid->MultiSelectKey ?>
<?php } ?>
<?php if ($tbl_unload->CurrentMode == "edit") { ?>
<input type="hidden" name="<?php echo $tbl_unload_grid->FormKeyCountName ?>" id="<?php echo $tbl_unload_grid->FormKeyCountName ?>" value="<?php echo $tbl_unload_grid->KeyCount ?>">
<?php echo $tbl_unload_grid->MultiSelectKey ?>
<?php } ?>
<?php if ($tbl_unload->CurrentMode == "") { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
<input type="hidden" name="detailpage" value="ftbl_unloadgrid">
</div><!-- /.ew-grid-middle-panel -->
<?php

// Close recordset
if ($tbl_unload_grid->Recordset)
	$tbl_unload_grid->Recordset->Close();
?>
</div>
<?php if ($tbl_unload_grid->ShowOtherOptions) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php $tbl_unload_grid->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($tbl_unload_grid->TotalRecs == 0 && !$tbl_unload->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $tbl_unload_grid->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$tbl_unload_grid->terminate();
?>