<?php
namespace PHPMaker2019\asgbn_wh;

// Write header
WriteHeader(FALSE);

// Create page object
if (!isset($vwRouteUnload_grid))
	$vwRouteUnload_grid = new vwRouteUnload_grid();

// Run the page
$vwRouteUnload_grid->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$vwRouteUnload_grid->Page_Render();
?>
<?php if (!$vwRouteUnload->isExport()) { ?>
<script>

// Form object
var fvwRouteUnloadgrid = new ew.Form("fvwRouteUnloadgrid", "grid");
fvwRouteUnloadgrid.formKeyCountName = '<?php echo $vwRouteUnload_grid->FormKeyCountName ?>';

// Validate form
fvwRouteUnloadgrid.validate = function() {
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
		<?php if ($vwRouteUnload_grid->PalletID->Required) { ?>
			elm = this.getElements("x" + infix + "_PalletID");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $vwRouteUnload->PalletID->caption(), $vwRouteUnload->PalletID->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($vwRouteUnload_grid->Code->Required) { ?>
			elm = this.getElements("x" + infix + "_Code");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $vwRouteUnload->Code->caption(), $vwRouteUnload->Code->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($vwRouteUnload_grid->PCS->Required) { ?>
			elm = this.getElements("x" + infix + "_PCS");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $vwRouteUnload->PCS->caption(), $vwRouteUnload->PCS->RequiredErrorMessage)) ?>");
		<?php } ?>
			elm = this.getElements("x" + infix + "_PCS");
			if (elm && !ew.checkInteger(elm.value))
				return this.onError(elm, "<?php echo JsEncode($vwRouteUnload->PCS->errorMessage()) ?>");
		<?php if ($vwRouteUnload_grid->PcsReal->Required) { ?>
			elm = this.getElements("x" + infix + "_PcsReal");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $vwRouteUnload->PcsReal->caption(), $vwRouteUnload->PcsReal->RequiredErrorMessage)) ?>");
		<?php } ?>
			elm = this.getElements("x" + infix + "_PcsReal");
			if (elm && !ew.checkInteger(elm.value))
				return this.onError(elm, "<?php echo JsEncode($vwRouteUnload->PcsReal->errorMessage()) ?>");
		<?php if ($vwRouteUnload_grid->CreateUser->Required) { ?>
			elm = this.getElements("x" + infix + "_CreateUser");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $vwRouteUnload->CreateUser->caption(), $vwRouteUnload->CreateUser->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($vwRouteUnload_grid->CreateDate->Required) { ?>
			elm = this.getElements("x" + infix + "_CreateDate");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $vwRouteUnload->CreateDate->caption(), $vwRouteUnload->CreateDate->RequiredErrorMessage)) ?>");
		<?php } ?>
			elm = this.getElements("x" + infix + "_CreateDate");
			if (elm && !ew.checkDateDef(elm.value))
				return this.onError(elm, "<?php echo JsEncode($vwRouteUnload->CreateDate->errorMessage()) ?>");
		<?php if ($vwRouteUnload_grid->MFG->Required) { ?>
			elm = this.getElements("x" + infix + "_MFG");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $vwRouteUnload->MFG->caption(), $vwRouteUnload->MFG->RequiredErrorMessage)) ?>");
		<?php } ?>
			elm = this.getElements("x" + infix + "_MFG");
			if (elm && !ew.checkDateDef(elm.value))
				return this.onError(elm, "<?php echo JsEncode($vwRouteUnload->MFG->errorMessage()) ?>");
		<?php if ($vwRouteUnload_grid->Description->Required) { ?>
			elm = this.getElements("x" + infix + "_Description");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $vwRouteUnload->Description->caption(), $vwRouteUnload->Description->RequiredErrorMessage)) ?>");
		<?php } ?>

			// Fire Form_CustomValidate event
			if (!this.Form_CustomValidate(fobj))
				return false;
		} // End Grid Add checking
	}
	return true;
}

// Check empty row
fvwRouteUnloadgrid.emptyRow = function(infix) {
	var fobj = this._form;
	if (ew.valueChanged(fobj, infix, "PalletID", false)) return false;
	if (ew.valueChanged(fobj, infix, "Code", false)) return false;
	if (ew.valueChanged(fobj, infix, "PCS", false)) return false;
	if (ew.valueChanged(fobj, infix, "PcsReal", false)) return false;
	if (ew.valueChanged(fobj, infix, "CreateUser", false)) return false;
	if (ew.valueChanged(fobj, infix, "CreateDate", false)) return false;
	if (ew.valueChanged(fobj, infix, "MFG", false)) return false;
	if (ew.valueChanged(fobj, infix, "Description", false)) return false;
	return true;
}

// Form_CustomValidate event
fvwRouteUnloadgrid.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

	// Your custom validation code here, return false if invalid.
	return true;
}

// Use JavaScript validation or not
fvwRouteUnloadgrid.validateRequired = <?php echo json_encode(CLIENT_VALIDATE) ?>;

// Dynamic selection lists
fvwRouteUnloadgrid.lists["x_Code"] = <?php echo $vwRouteUnload_grid->Code->Lookup->toClientList() ?>;
fvwRouteUnloadgrid.lists["x_Code"].options = <?php echo JsonEncode($vwRouteUnload_grid->Code->lookupOptions()) ?>;
fvwRouteUnloadgrid.autoSuggests["x_Code"] = <?php echo json_encode(["data" => "ajax=autosuggest"]) ?>;

// Form object for search
</script>
<?php } ?>
<?php
$vwRouteUnload_grid->renderOtherOptions();
?>
<?php $vwRouteUnload_grid->showPageHeader(); ?>
<?php
$vwRouteUnload_grid->showMessage();
?>
<?php if ($vwRouteUnload_grid->TotalRecs > 0 || $vwRouteUnload->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($vwRouteUnload_grid->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> vwRouteUnload">
<?php if ($vwRouteUnload_grid->ShowOtherOptions) { ?>
<div class="card-header ew-grid-upper-panel">
<?php $vwRouteUnload_grid->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<div id="fvwRouteUnloadgrid" class="ew-form ew-list-form form-inline">
<div id="gmp_vwRouteUnload" class="<?php if (IsResponsiveLayout()) { ?>table-responsive <?php } ?>card-body ew-grid-middle-panel">
<table id="tbl_vwRouteUnloadgrid" class="table ew-table"><!-- .ew-table ##-->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$vwRouteUnload_grid->RowType = ROWTYPE_HEADER;

// Render list options
$vwRouteUnload_grid->renderListOptions();

// Render list options (header, left)
$vwRouteUnload_grid->ListOptions->render("header", "left");
?>
<?php if ($vwRouteUnload->PalletID->Visible) { // PalletID ?>
	<?php if ($vwRouteUnload->sortUrl($vwRouteUnload->PalletID) == "") { ?>
		<th data-name="PalletID" class="<?php echo $vwRouteUnload->PalletID->headerCellClass() ?>"><div id="elh_vwRouteUnload_PalletID" class="vwRouteUnload_PalletID"><div class="ew-table-header-caption"><?php echo $vwRouteUnload->PalletID->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="PalletID" class="<?php echo $vwRouteUnload->PalletID->headerCellClass() ?>"><div><div id="elh_vwRouteUnload_PalletID" class="vwRouteUnload_PalletID">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $vwRouteUnload->PalletID->caption() ?></span><span class="ew-table-header-sort"><?php if ($vwRouteUnload->PalletID->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($vwRouteUnload->PalletID->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($vwRouteUnload->Code->Visible) { // Code ?>
	<?php if ($vwRouteUnload->sortUrl($vwRouteUnload->Code) == "") { ?>
		<th data-name="Code" class="<?php echo $vwRouteUnload->Code->headerCellClass() ?>"><div id="elh_vwRouteUnload_Code" class="vwRouteUnload_Code"><div class="ew-table-header-caption"><?php echo $vwRouteUnload->Code->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Code" class="<?php echo $vwRouteUnload->Code->headerCellClass() ?>"><div><div id="elh_vwRouteUnload_Code" class="vwRouteUnload_Code">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $vwRouteUnload->Code->caption() ?></span><span class="ew-table-header-sort"><?php if ($vwRouteUnload->Code->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($vwRouteUnload->Code->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($vwRouteUnload->PCS->Visible) { // PCS ?>
	<?php if ($vwRouteUnload->sortUrl($vwRouteUnload->PCS) == "") { ?>
		<th data-name="PCS" class="<?php echo $vwRouteUnload->PCS->headerCellClass() ?>"><div id="elh_vwRouteUnload_PCS" class="vwRouteUnload_PCS"><div class="ew-table-header-caption"><?php echo $vwRouteUnload->PCS->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="PCS" class="<?php echo $vwRouteUnload->PCS->headerCellClass() ?>"><div><div id="elh_vwRouteUnload_PCS" class="vwRouteUnload_PCS">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $vwRouteUnload->PCS->caption() ?></span><span class="ew-table-header-sort"><?php if ($vwRouteUnload->PCS->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($vwRouteUnload->PCS->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($vwRouteUnload->PcsReal->Visible) { // PcsReal ?>
	<?php if ($vwRouteUnload->sortUrl($vwRouteUnload->PcsReal) == "") { ?>
		<th data-name="PcsReal" class="<?php echo $vwRouteUnload->PcsReal->headerCellClass() ?>"><div id="elh_vwRouteUnload_PcsReal" class="vwRouteUnload_PcsReal"><div class="ew-table-header-caption"><?php echo $vwRouteUnload->PcsReal->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="PcsReal" class="<?php echo $vwRouteUnload->PcsReal->headerCellClass() ?>"><div><div id="elh_vwRouteUnload_PcsReal" class="vwRouteUnload_PcsReal">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $vwRouteUnload->PcsReal->caption() ?></span><span class="ew-table-header-sort"><?php if ($vwRouteUnload->PcsReal->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($vwRouteUnload->PcsReal->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($vwRouteUnload->CreateUser->Visible) { // CreateUser ?>
	<?php if ($vwRouteUnload->sortUrl($vwRouteUnload->CreateUser) == "") { ?>
		<th data-name="CreateUser" class="<?php echo $vwRouteUnload->CreateUser->headerCellClass() ?>"><div id="elh_vwRouteUnload_CreateUser" class="vwRouteUnload_CreateUser"><div class="ew-table-header-caption"><?php echo $vwRouteUnload->CreateUser->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="CreateUser" class="<?php echo $vwRouteUnload->CreateUser->headerCellClass() ?>"><div><div id="elh_vwRouteUnload_CreateUser" class="vwRouteUnload_CreateUser">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $vwRouteUnload->CreateUser->caption() ?></span><span class="ew-table-header-sort"><?php if ($vwRouteUnload->CreateUser->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($vwRouteUnload->CreateUser->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($vwRouteUnload->CreateDate->Visible) { // CreateDate ?>
	<?php if ($vwRouteUnload->sortUrl($vwRouteUnload->CreateDate) == "") { ?>
		<th data-name="CreateDate" class="<?php echo $vwRouteUnload->CreateDate->headerCellClass() ?>"><div id="elh_vwRouteUnload_CreateDate" class="vwRouteUnload_CreateDate"><div class="ew-table-header-caption"><?php echo $vwRouteUnload->CreateDate->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="CreateDate" class="<?php echo $vwRouteUnload->CreateDate->headerCellClass() ?>"><div><div id="elh_vwRouteUnload_CreateDate" class="vwRouteUnload_CreateDate">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $vwRouteUnload->CreateDate->caption() ?></span><span class="ew-table-header-sort"><?php if ($vwRouteUnload->CreateDate->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($vwRouteUnload->CreateDate->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($vwRouteUnload->MFG->Visible) { // MFG ?>
	<?php if ($vwRouteUnload->sortUrl($vwRouteUnload->MFG) == "") { ?>
		<th data-name="MFG" class="<?php echo $vwRouteUnload->MFG->headerCellClass() ?>"><div id="elh_vwRouteUnload_MFG" class="vwRouteUnload_MFG"><div class="ew-table-header-caption"><?php echo $vwRouteUnload->MFG->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="MFG" class="<?php echo $vwRouteUnload->MFG->headerCellClass() ?>"><div><div id="elh_vwRouteUnload_MFG" class="vwRouteUnload_MFG">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $vwRouteUnload->MFG->caption() ?></span><span class="ew-table-header-sort"><?php if ($vwRouteUnload->MFG->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($vwRouteUnload->MFG->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($vwRouteUnload->Description->Visible) { // Description ?>
	<?php if ($vwRouteUnload->sortUrl($vwRouteUnload->Description) == "") { ?>
		<th data-name="Description" class="<?php echo $vwRouteUnload->Description->headerCellClass() ?>"><div id="elh_vwRouteUnload_Description" class="vwRouteUnload_Description"><div class="ew-table-header-caption"><?php echo $vwRouteUnload->Description->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Description" class="<?php echo $vwRouteUnload->Description->headerCellClass() ?>"><div><div id="elh_vwRouteUnload_Description" class="vwRouteUnload_Description">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $vwRouteUnload->Description->caption() ?></span><span class="ew-table-header-sort"><?php if ($vwRouteUnload->Description->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($vwRouteUnload->Description->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$vwRouteUnload_grid->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
$vwRouteUnload_grid->StartRec = 1;
$vwRouteUnload_grid->StopRec = $vwRouteUnload_grid->TotalRecs; // Show all records

// Restore number of post back records
if ($CurrentForm && $vwRouteUnload_grid->EventCancelled) {
	$CurrentForm->Index = -1;
	if ($CurrentForm->hasValue($vwRouteUnload_grid->FormKeyCountName) && ($vwRouteUnload->isGridAdd() || $vwRouteUnload->isGridEdit() || $vwRouteUnload->isConfirm())) {
		$vwRouteUnload_grid->KeyCount = $CurrentForm->getValue($vwRouteUnload_grid->FormKeyCountName);
		$vwRouteUnload_grid->StopRec = $vwRouteUnload_grid->StartRec + $vwRouteUnload_grid->KeyCount - 1;
	}
}
$vwRouteUnload_grid->RecCnt = $vwRouteUnload_grid->StartRec - 1;
if ($vwRouteUnload_grid->Recordset && !$vwRouteUnload_grid->Recordset->EOF) {
	$vwRouteUnload_grid->Recordset->moveFirst();
	$selectLimit = $vwRouteUnload_grid->UseSelectLimit;
	if (!$selectLimit && $vwRouteUnload_grid->StartRec > 1)
		$vwRouteUnload_grid->Recordset->move($vwRouteUnload_grid->StartRec - 1);
} elseif (!$vwRouteUnload->AllowAddDeleteRow && $vwRouteUnload_grid->StopRec == 0) {
	$vwRouteUnload_grid->StopRec = $vwRouteUnload->GridAddRowCount;
}

// Initialize aggregate
$vwRouteUnload->RowType = ROWTYPE_AGGREGATEINIT;
$vwRouteUnload->resetAttributes();
$vwRouteUnload_grid->renderRow();
if ($vwRouteUnload->isGridAdd())
	$vwRouteUnload_grid->RowIndex = 0;
if ($vwRouteUnload->isGridEdit())
	$vwRouteUnload_grid->RowIndex = 0;
while ($vwRouteUnload_grid->RecCnt < $vwRouteUnload_grid->StopRec) {
	$vwRouteUnload_grid->RecCnt++;
	if ($vwRouteUnload_grid->RecCnt >= $vwRouteUnload_grid->StartRec) {
		$vwRouteUnload_grid->RowCnt++;
		if ($vwRouteUnload->isGridAdd() || $vwRouteUnload->isGridEdit() || $vwRouteUnload->isConfirm()) {
			$vwRouteUnload_grid->RowIndex++;
			$CurrentForm->Index = $vwRouteUnload_grid->RowIndex;
			if ($CurrentForm->hasValue($vwRouteUnload_grid->FormActionName) && $vwRouteUnload_grid->EventCancelled)
				$vwRouteUnload_grid->RowAction = strval($CurrentForm->getValue($vwRouteUnload_grid->FormActionName));
			elseif ($vwRouteUnload->isGridAdd())
				$vwRouteUnload_grid->RowAction = "insert";
			else
				$vwRouteUnload_grid->RowAction = "";
		}

		// Set up key count
		$vwRouteUnload_grid->KeyCount = $vwRouteUnload_grid->RowIndex;

		// Init row class and style
		$vwRouteUnload->resetAttributes();
		$vwRouteUnload->CssClass = "";
		if ($vwRouteUnload->isGridAdd()) {
			if ($vwRouteUnload->CurrentMode == "copy") {
				$vwRouteUnload_grid->loadRowValues($vwRouteUnload_grid->Recordset); // Load row values
				$vwRouteUnload_grid->setRecordKey($vwRouteUnload_grid->RowOldKey, $vwRouteUnload_grid->Recordset); // Set old record key
			} else {
				$vwRouteUnload_grid->loadRowValues(); // Load default values
				$vwRouteUnload_grid->RowOldKey = ""; // Clear old key value
			}
		} else {
			$vwRouteUnload_grid->loadRowValues($vwRouteUnload_grid->Recordset); // Load row values
		}
		$vwRouteUnload->RowType = ROWTYPE_VIEW; // Render view
		if ($vwRouteUnload->isGridAdd()) // Grid add
			$vwRouteUnload->RowType = ROWTYPE_ADD; // Render add
		if ($vwRouteUnload->isGridAdd() && $vwRouteUnload->EventCancelled && !$CurrentForm->hasValue("k_blankrow")) // Insert failed
			$vwRouteUnload_grid->restoreCurrentRowFormValues($vwRouteUnload_grid->RowIndex); // Restore form values
		if ($vwRouteUnload->isGridEdit()) { // Grid edit
			if ($vwRouteUnload->EventCancelled)
				$vwRouteUnload_grid->restoreCurrentRowFormValues($vwRouteUnload_grid->RowIndex); // Restore form values
			if ($vwRouteUnload_grid->RowAction == "insert")
				$vwRouteUnload->RowType = ROWTYPE_ADD; // Render add
			else
				$vwRouteUnload->RowType = ROWTYPE_EDIT; // Render edit
		}
		if ($vwRouteUnload->isGridEdit() && ($vwRouteUnload->RowType == ROWTYPE_EDIT || $vwRouteUnload->RowType == ROWTYPE_ADD) && $vwRouteUnload->EventCancelled) // Update failed
			$vwRouteUnload_grid->restoreCurrentRowFormValues($vwRouteUnload_grid->RowIndex); // Restore form values
		if ($vwRouteUnload->RowType == ROWTYPE_EDIT) // Edit row
			$vwRouteUnload_grid->EditRowCnt++;
		if ($vwRouteUnload->isConfirm()) // Confirm row
			$vwRouteUnload_grid->restoreCurrentRowFormValues($vwRouteUnload_grid->RowIndex); // Restore form values

		// Set up row id / data-rowindex
		$vwRouteUnload->RowAttrs = array_merge($vwRouteUnload->RowAttrs, array('data-rowindex'=>$vwRouteUnload_grid->RowCnt, 'id'=>'r' . $vwRouteUnload_grid->RowCnt . '_vwRouteUnload', 'data-rowtype'=>$vwRouteUnload->RowType));

		// Render row
		$vwRouteUnload_grid->renderRow();

		// Render list options
		$vwRouteUnload_grid->renderListOptions();

		// Skip delete row / empty row for confirm page
		if ($vwRouteUnload_grid->RowAction <> "delete" && $vwRouteUnload_grid->RowAction <> "insertdelete" && !($vwRouteUnload_grid->RowAction == "insert" && $vwRouteUnload->isConfirm() && $vwRouteUnload_grid->emptyRow())) {
?>
	<tr<?php echo $vwRouteUnload->rowAttributes() ?>>
<?php

// Render list options (body, left)
$vwRouteUnload_grid->ListOptions->render("body", "left", $vwRouteUnload_grid->RowCnt);
?>
	<?php if ($vwRouteUnload->PalletID->Visible) { // PalletID ?>
		<td data-name="PalletID"<?php echo $vwRouteUnload->PalletID->cellAttributes() ?>>
<?php if ($vwRouteUnload->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $vwRouteUnload_grid->RowCnt ?>_vwRouteUnload_PalletID" class="form-group vwRouteUnload_PalletID">
<input type="text" data-table="vwRouteUnload" data-field="x_PalletID" name="x<?php echo $vwRouteUnload_grid->RowIndex ?>_PalletID" id="x<?php echo $vwRouteUnload_grid->RowIndex ?>_PalletID" size="30" maxlength="50" placeholder="<?php echo HtmlEncode($vwRouteUnload->PalletID->getPlaceHolder()) ?>" value="<?php echo $vwRouteUnload->PalletID->EditValue ?>"<?php echo $vwRouteUnload->PalletID->editAttributes() ?>>
</span>
<input type="hidden" data-table="vwRouteUnload" data-field="x_PalletID" name="o<?php echo $vwRouteUnload_grid->RowIndex ?>_PalletID" id="o<?php echo $vwRouteUnload_grid->RowIndex ?>_PalletID" value="<?php echo HtmlEncode($vwRouteUnload->PalletID->OldValue) ?>">
<?php } ?>
<?php if ($vwRouteUnload->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $vwRouteUnload_grid->RowCnt ?>_vwRouteUnload_PalletID" class="form-group vwRouteUnload_PalletID">
<input type="text" data-table="vwRouteUnload" data-field="x_PalletID" name="x<?php echo $vwRouteUnload_grid->RowIndex ?>_PalletID" id="x<?php echo $vwRouteUnload_grid->RowIndex ?>_PalletID" size="30" maxlength="50" placeholder="<?php echo HtmlEncode($vwRouteUnload->PalletID->getPlaceHolder()) ?>" value="<?php echo $vwRouteUnload->PalletID->EditValue ?>"<?php echo $vwRouteUnload->PalletID->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($vwRouteUnload->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $vwRouteUnload_grid->RowCnt ?>_vwRouteUnload_PalletID" class="vwRouteUnload_PalletID">
<span<?php echo $vwRouteUnload->PalletID->viewAttributes() ?>>
<?php echo $vwRouteUnload->PalletID->getViewValue() ?></span>
</span>
<?php if (!$vwRouteUnload->isConfirm()) { ?>
<input type="hidden" data-table="vwRouteUnload" data-field="x_PalletID" name="x<?php echo $vwRouteUnload_grid->RowIndex ?>_PalletID" id="x<?php echo $vwRouteUnload_grid->RowIndex ?>_PalletID" value="<?php echo HtmlEncode($vwRouteUnload->PalletID->FormValue) ?>">
<input type="hidden" data-table="vwRouteUnload" data-field="x_PalletID" name="o<?php echo $vwRouteUnload_grid->RowIndex ?>_PalletID" id="o<?php echo $vwRouteUnload_grid->RowIndex ?>_PalletID" value="<?php echo HtmlEncode($vwRouteUnload->PalletID->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="vwRouteUnload" data-field="x_PalletID" name="fvwRouteUnloadgrid$x<?php echo $vwRouteUnload_grid->RowIndex ?>_PalletID" id="fvwRouteUnloadgrid$x<?php echo $vwRouteUnload_grid->RowIndex ?>_PalletID" value="<?php echo HtmlEncode($vwRouteUnload->PalletID->FormValue) ?>">
<input type="hidden" data-table="vwRouteUnload" data-field="x_PalletID" name="fvwRouteUnloadgrid$o<?php echo $vwRouteUnload_grid->RowIndex ?>_PalletID" id="fvwRouteUnloadgrid$o<?php echo $vwRouteUnload_grid->RowIndex ?>_PalletID" value="<?php echo HtmlEncode($vwRouteUnload->PalletID->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
<?php if ($vwRouteUnload->RowType == ROWTYPE_ADD) { // Add record ?>
<input type="hidden" data-table="vwRouteUnload" data-field="x_ID_Route" name="x<?php echo $vwRouteUnload_grid->RowIndex ?>_ID_Route" id="x<?php echo $vwRouteUnload_grid->RowIndex ?>_ID_Route" value="<?php echo HtmlEncode($vwRouteUnload->ID_Route->CurrentValue) ?>">
<input type="hidden" data-table="vwRouteUnload" data-field="x_ID_Route" name="o<?php echo $vwRouteUnload_grid->RowIndex ?>_ID_Route" id="o<?php echo $vwRouteUnload_grid->RowIndex ?>_ID_Route" value="<?php echo HtmlEncode($vwRouteUnload->ID_Route->OldValue) ?>">
<?php } ?>
<?php if ($vwRouteUnload->RowType == ROWTYPE_EDIT || $vwRouteUnload->CurrentMode == "edit") { ?>
<input type="hidden" data-table="vwRouteUnload" data-field="x_ID_Route" name="x<?php echo $vwRouteUnload_grid->RowIndex ?>_ID_Route" id="x<?php echo $vwRouteUnload_grid->RowIndex ?>_ID_Route" value="<?php echo HtmlEncode($vwRouteUnload->ID_Route->CurrentValue) ?>">
<?php } ?>
	<?php if ($vwRouteUnload->Code->Visible) { // Code ?>
		<td data-name="Code"<?php echo $vwRouteUnload->Code->cellAttributes() ?>>
<?php if ($vwRouteUnload->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $vwRouteUnload_grid->RowCnt ?>_vwRouteUnload_Code" class="form-group vwRouteUnload_Code">
<?php
$wrkonchange = "" . trim(@$vwRouteUnload->Code->EditAttrs["onchange"]);
if (trim($wrkonchange) <> "") $wrkonchange = " onchange=\"" . JsEncode($wrkonchange) . "\"";
$vwRouteUnload->Code->EditAttrs["onchange"] = "";
?>
<span id="as_x<?php echo $vwRouteUnload_grid->RowIndex ?>_Code" class="text-nowrap" style="z-index: <?php echo (9000 - $vwRouteUnload_grid->RowCnt * 10) ?>">
	<input type="text" class="form-control" name="sv_x<?php echo $vwRouteUnload_grid->RowIndex ?>_Code" id="sv_x<?php echo $vwRouteUnload_grid->RowIndex ?>_Code" value="<?php echo RemoveHtml($vwRouteUnload->Code->EditValue) ?>" size="30" maxlength="50" placeholder="<?php echo HtmlEncode($vwRouteUnload->Code->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($vwRouteUnload->Code->getPlaceHolder()) ?>"<?php echo $vwRouteUnload->Code->editAttributes() ?>>
</span>
<input type="hidden" data-table="vwRouteUnload" data-field="x_Code" data-value-separator="<?php echo $vwRouteUnload->Code->displayValueSeparatorAttribute() ?>" name="x<?php echo $vwRouteUnload_grid->RowIndex ?>_Code" id="x<?php echo $vwRouteUnload_grid->RowIndex ?>_Code" value="<?php echo HtmlEncode($vwRouteUnload->Code->CurrentValue) ?>"<?php echo $wrkonchange ?>>
<script>
fvwRouteUnloadgrid.createAutoSuggest({"id":"x<?php echo $vwRouteUnload_grid->RowIndex ?>_Code","forceSelect":false});
</script>
<?php echo $vwRouteUnload->Code->Lookup->getParamTag("p_x" . $vwRouteUnload_grid->RowIndex . "_Code") ?>
</span>
<input type="hidden" data-table="vwRouteUnload" data-field="x_Code" name="o<?php echo $vwRouteUnload_grid->RowIndex ?>_Code" id="o<?php echo $vwRouteUnload_grid->RowIndex ?>_Code" value="<?php echo HtmlEncode($vwRouteUnload->Code->OldValue) ?>">
<?php } ?>
<?php if ($vwRouteUnload->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $vwRouteUnload_grid->RowCnt ?>_vwRouteUnload_Code" class="form-group vwRouteUnload_Code">
<?php
$wrkonchange = "" . trim(@$vwRouteUnload->Code->EditAttrs["onchange"]);
if (trim($wrkonchange) <> "") $wrkonchange = " onchange=\"" . JsEncode($wrkonchange) . "\"";
$vwRouteUnload->Code->EditAttrs["onchange"] = "";
?>
<span id="as_x<?php echo $vwRouteUnload_grid->RowIndex ?>_Code" class="text-nowrap" style="z-index: <?php echo (9000 - $vwRouteUnload_grid->RowCnt * 10) ?>">
	<input type="text" class="form-control" name="sv_x<?php echo $vwRouteUnload_grid->RowIndex ?>_Code" id="sv_x<?php echo $vwRouteUnload_grid->RowIndex ?>_Code" value="<?php echo RemoveHtml($vwRouteUnload->Code->EditValue) ?>" size="30" maxlength="50" placeholder="<?php echo HtmlEncode($vwRouteUnload->Code->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($vwRouteUnload->Code->getPlaceHolder()) ?>"<?php echo $vwRouteUnload->Code->editAttributes() ?>>
</span>
<input type="hidden" data-table="vwRouteUnload" data-field="x_Code" data-value-separator="<?php echo $vwRouteUnload->Code->displayValueSeparatorAttribute() ?>" name="x<?php echo $vwRouteUnload_grid->RowIndex ?>_Code" id="x<?php echo $vwRouteUnload_grid->RowIndex ?>_Code" value="<?php echo HtmlEncode($vwRouteUnload->Code->CurrentValue) ?>"<?php echo $wrkonchange ?>>
<script>
fvwRouteUnloadgrid.createAutoSuggest({"id":"x<?php echo $vwRouteUnload_grid->RowIndex ?>_Code","forceSelect":false});
</script>
<?php echo $vwRouteUnload->Code->Lookup->getParamTag("p_x" . $vwRouteUnload_grid->RowIndex . "_Code") ?>
</span>
<?php } ?>
<?php if ($vwRouteUnload->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $vwRouteUnload_grid->RowCnt ?>_vwRouteUnload_Code" class="vwRouteUnload_Code">
<span<?php echo $vwRouteUnload->Code->viewAttributes() ?>>
<?php echo $vwRouteUnload->Code->getViewValue() ?></span>
</span>
<?php if (!$vwRouteUnload->isConfirm()) { ?>
<input type="hidden" data-table="vwRouteUnload" data-field="x_Code" name="x<?php echo $vwRouteUnload_grid->RowIndex ?>_Code" id="x<?php echo $vwRouteUnload_grid->RowIndex ?>_Code" value="<?php echo HtmlEncode($vwRouteUnload->Code->FormValue) ?>">
<input type="hidden" data-table="vwRouteUnload" data-field="x_Code" name="o<?php echo $vwRouteUnload_grid->RowIndex ?>_Code" id="o<?php echo $vwRouteUnload_grid->RowIndex ?>_Code" value="<?php echo HtmlEncode($vwRouteUnload->Code->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="vwRouteUnload" data-field="x_Code" name="fvwRouteUnloadgrid$x<?php echo $vwRouteUnload_grid->RowIndex ?>_Code" id="fvwRouteUnloadgrid$x<?php echo $vwRouteUnload_grid->RowIndex ?>_Code" value="<?php echo HtmlEncode($vwRouteUnload->Code->FormValue) ?>">
<input type="hidden" data-table="vwRouteUnload" data-field="x_Code" name="fvwRouteUnloadgrid$o<?php echo $vwRouteUnload_grid->RowIndex ?>_Code" id="fvwRouteUnloadgrid$o<?php echo $vwRouteUnload_grid->RowIndex ?>_Code" value="<?php echo HtmlEncode($vwRouteUnload->Code->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($vwRouteUnload->PCS->Visible) { // PCS ?>
		<td data-name="PCS"<?php echo $vwRouteUnload->PCS->cellAttributes() ?>>
<?php if ($vwRouteUnload->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $vwRouteUnload_grid->RowCnt ?>_vwRouteUnload_PCS" class="form-group vwRouteUnload_PCS">
<input type="text" data-table="vwRouteUnload" data-field="x_PCS" name="x<?php echo $vwRouteUnload_grid->RowIndex ?>_PCS" id="x<?php echo $vwRouteUnload_grid->RowIndex ?>_PCS" size="30" placeholder="<?php echo HtmlEncode($vwRouteUnload->PCS->getPlaceHolder()) ?>" value="<?php echo $vwRouteUnload->PCS->EditValue ?>"<?php echo $vwRouteUnload->PCS->editAttributes() ?>>
</span>
<input type="hidden" data-table="vwRouteUnload" data-field="x_PCS" name="o<?php echo $vwRouteUnload_grid->RowIndex ?>_PCS" id="o<?php echo $vwRouteUnload_grid->RowIndex ?>_PCS" value="<?php echo HtmlEncode($vwRouteUnload->PCS->OldValue) ?>">
<?php } ?>
<?php if ($vwRouteUnload->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $vwRouteUnload_grid->RowCnt ?>_vwRouteUnload_PCS" class="form-group vwRouteUnload_PCS">
<input type="text" data-table="vwRouteUnload" data-field="x_PCS" name="x<?php echo $vwRouteUnload_grid->RowIndex ?>_PCS" id="x<?php echo $vwRouteUnload_grid->RowIndex ?>_PCS" size="30" placeholder="<?php echo HtmlEncode($vwRouteUnload->PCS->getPlaceHolder()) ?>" value="<?php echo $vwRouteUnload->PCS->EditValue ?>"<?php echo $vwRouteUnload->PCS->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($vwRouteUnload->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $vwRouteUnload_grid->RowCnt ?>_vwRouteUnload_PCS" class="vwRouteUnload_PCS">
<span<?php echo $vwRouteUnload->PCS->viewAttributes() ?>>
<?php echo $vwRouteUnload->PCS->getViewValue() ?></span>
</span>
<?php if (!$vwRouteUnload->isConfirm()) { ?>
<input type="hidden" data-table="vwRouteUnload" data-field="x_PCS" name="x<?php echo $vwRouteUnload_grid->RowIndex ?>_PCS" id="x<?php echo $vwRouteUnload_grid->RowIndex ?>_PCS" value="<?php echo HtmlEncode($vwRouteUnload->PCS->FormValue) ?>">
<input type="hidden" data-table="vwRouteUnload" data-field="x_PCS" name="o<?php echo $vwRouteUnload_grid->RowIndex ?>_PCS" id="o<?php echo $vwRouteUnload_grid->RowIndex ?>_PCS" value="<?php echo HtmlEncode($vwRouteUnload->PCS->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="vwRouteUnload" data-field="x_PCS" name="fvwRouteUnloadgrid$x<?php echo $vwRouteUnload_grid->RowIndex ?>_PCS" id="fvwRouteUnloadgrid$x<?php echo $vwRouteUnload_grid->RowIndex ?>_PCS" value="<?php echo HtmlEncode($vwRouteUnload->PCS->FormValue) ?>">
<input type="hidden" data-table="vwRouteUnload" data-field="x_PCS" name="fvwRouteUnloadgrid$o<?php echo $vwRouteUnload_grid->RowIndex ?>_PCS" id="fvwRouteUnloadgrid$o<?php echo $vwRouteUnload_grid->RowIndex ?>_PCS" value="<?php echo HtmlEncode($vwRouteUnload->PCS->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($vwRouteUnload->PcsReal->Visible) { // PcsReal ?>
		<td data-name="PcsReal"<?php echo $vwRouteUnload->PcsReal->cellAttributes() ?>>
<?php if ($vwRouteUnload->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $vwRouteUnload_grid->RowCnt ?>_vwRouteUnload_PcsReal" class="form-group vwRouteUnload_PcsReal">
<input type="text" data-table="vwRouteUnload" data-field="x_PcsReal" name="x<?php echo $vwRouteUnload_grid->RowIndex ?>_PcsReal" id="x<?php echo $vwRouteUnload_grid->RowIndex ?>_PcsReal" size="30" placeholder="<?php echo HtmlEncode($vwRouteUnload->PcsReal->getPlaceHolder()) ?>" value="<?php echo $vwRouteUnload->PcsReal->EditValue ?>"<?php echo $vwRouteUnload->PcsReal->editAttributes() ?>>
</span>
<input type="hidden" data-table="vwRouteUnload" data-field="x_PcsReal" name="o<?php echo $vwRouteUnload_grid->RowIndex ?>_PcsReal" id="o<?php echo $vwRouteUnload_grid->RowIndex ?>_PcsReal" value="<?php echo HtmlEncode($vwRouteUnload->PcsReal->OldValue) ?>">
<?php } ?>
<?php if ($vwRouteUnload->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $vwRouteUnload_grid->RowCnt ?>_vwRouteUnload_PcsReal" class="form-group vwRouteUnload_PcsReal">
<input type="text" data-table="vwRouteUnload" data-field="x_PcsReal" name="x<?php echo $vwRouteUnload_grid->RowIndex ?>_PcsReal" id="x<?php echo $vwRouteUnload_grid->RowIndex ?>_PcsReal" size="30" placeholder="<?php echo HtmlEncode($vwRouteUnload->PcsReal->getPlaceHolder()) ?>" value="<?php echo $vwRouteUnload->PcsReal->EditValue ?>"<?php echo $vwRouteUnload->PcsReal->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($vwRouteUnload->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $vwRouteUnload_grid->RowCnt ?>_vwRouteUnload_PcsReal" class="vwRouteUnload_PcsReal">
<span<?php echo $vwRouteUnload->PcsReal->viewAttributes() ?>>
<?php echo $vwRouteUnload->PcsReal->getViewValue() ?></span>
</span>
<?php if (!$vwRouteUnload->isConfirm()) { ?>
<input type="hidden" data-table="vwRouteUnload" data-field="x_PcsReal" name="x<?php echo $vwRouteUnload_grid->RowIndex ?>_PcsReal" id="x<?php echo $vwRouteUnload_grid->RowIndex ?>_PcsReal" value="<?php echo HtmlEncode($vwRouteUnload->PcsReal->FormValue) ?>">
<input type="hidden" data-table="vwRouteUnload" data-field="x_PcsReal" name="o<?php echo $vwRouteUnload_grid->RowIndex ?>_PcsReal" id="o<?php echo $vwRouteUnload_grid->RowIndex ?>_PcsReal" value="<?php echo HtmlEncode($vwRouteUnload->PcsReal->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="vwRouteUnload" data-field="x_PcsReal" name="fvwRouteUnloadgrid$x<?php echo $vwRouteUnload_grid->RowIndex ?>_PcsReal" id="fvwRouteUnloadgrid$x<?php echo $vwRouteUnload_grid->RowIndex ?>_PcsReal" value="<?php echo HtmlEncode($vwRouteUnload->PcsReal->FormValue) ?>">
<input type="hidden" data-table="vwRouteUnload" data-field="x_PcsReal" name="fvwRouteUnloadgrid$o<?php echo $vwRouteUnload_grid->RowIndex ?>_PcsReal" id="fvwRouteUnloadgrid$o<?php echo $vwRouteUnload_grid->RowIndex ?>_PcsReal" value="<?php echo HtmlEncode($vwRouteUnload->PcsReal->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($vwRouteUnload->CreateUser->Visible) { // CreateUser ?>
		<td data-name="CreateUser"<?php echo $vwRouteUnload->CreateUser->cellAttributes() ?>>
<?php if ($vwRouteUnload->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $vwRouteUnload_grid->RowCnt ?>_vwRouteUnload_CreateUser" class="form-group vwRouteUnload_CreateUser">
<input type="text" data-table="vwRouteUnload" data-field="x_CreateUser" name="x<?php echo $vwRouteUnload_grid->RowIndex ?>_CreateUser" id="x<?php echo $vwRouteUnload_grid->RowIndex ?>_CreateUser" size="30" maxlength="50" placeholder="<?php echo HtmlEncode($vwRouteUnload->CreateUser->getPlaceHolder()) ?>" value="<?php echo $vwRouteUnload->CreateUser->EditValue ?>"<?php echo $vwRouteUnload->CreateUser->editAttributes() ?>>
</span>
<input type="hidden" data-table="vwRouteUnload" data-field="x_CreateUser" name="o<?php echo $vwRouteUnload_grid->RowIndex ?>_CreateUser" id="o<?php echo $vwRouteUnload_grid->RowIndex ?>_CreateUser" value="<?php echo HtmlEncode($vwRouteUnload->CreateUser->OldValue) ?>">
<?php } ?>
<?php if ($vwRouteUnload->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $vwRouteUnload_grid->RowCnt ?>_vwRouteUnload_CreateUser" class="form-group vwRouteUnload_CreateUser">
<input type="text" data-table="vwRouteUnload" data-field="x_CreateUser" name="x<?php echo $vwRouteUnload_grid->RowIndex ?>_CreateUser" id="x<?php echo $vwRouteUnload_grid->RowIndex ?>_CreateUser" size="30" maxlength="50" placeholder="<?php echo HtmlEncode($vwRouteUnload->CreateUser->getPlaceHolder()) ?>" value="<?php echo $vwRouteUnload->CreateUser->EditValue ?>"<?php echo $vwRouteUnload->CreateUser->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($vwRouteUnload->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $vwRouteUnload_grid->RowCnt ?>_vwRouteUnload_CreateUser" class="vwRouteUnload_CreateUser">
<span<?php echo $vwRouteUnload->CreateUser->viewAttributes() ?>>
<?php echo $vwRouteUnload->CreateUser->getViewValue() ?></span>
</span>
<?php if (!$vwRouteUnload->isConfirm()) { ?>
<input type="hidden" data-table="vwRouteUnload" data-field="x_CreateUser" name="x<?php echo $vwRouteUnload_grid->RowIndex ?>_CreateUser" id="x<?php echo $vwRouteUnload_grid->RowIndex ?>_CreateUser" value="<?php echo HtmlEncode($vwRouteUnload->CreateUser->FormValue) ?>">
<input type="hidden" data-table="vwRouteUnload" data-field="x_CreateUser" name="o<?php echo $vwRouteUnload_grid->RowIndex ?>_CreateUser" id="o<?php echo $vwRouteUnload_grid->RowIndex ?>_CreateUser" value="<?php echo HtmlEncode($vwRouteUnload->CreateUser->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="vwRouteUnload" data-field="x_CreateUser" name="fvwRouteUnloadgrid$x<?php echo $vwRouteUnload_grid->RowIndex ?>_CreateUser" id="fvwRouteUnloadgrid$x<?php echo $vwRouteUnload_grid->RowIndex ?>_CreateUser" value="<?php echo HtmlEncode($vwRouteUnload->CreateUser->FormValue) ?>">
<input type="hidden" data-table="vwRouteUnload" data-field="x_CreateUser" name="fvwRouteUnloadgrid$o<?php echo $vwRouteUnload_grid->RowIndex ?>_CreateUser" id="fvwRouteUnloadgrid$o<?php echo $vwRouteUnload_grid->RowIndex ?>_CreateUser" value="<?php echo HtmlEncode($vwRouteUnload->CreateUser->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($vwRouteUnload->CreateDate->Visible) { // CreateDate ?>
		<td data-name="CreateDate"<?php echo $vwRouteUnload->CreateDate->cellAttributes() ?>>
<?php if ($vwRouteUnload->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $vwRouteUnload_grid->RowCnt ?>_vwRouteUnload_CreateDate" class="form-group vwRouteUnload_CreateDate">
<input type="text" data-table="vwRouteUnload" data-field="x_CreateDate" name="x<?php echo $vwRouteUnload_grid->RowIndex ?>_CreateDate" id="x<?php echo $vwRouteUnload_grid->RowIndex ?>_CreateDate" placeholder="<?php echo HtmlEncode($vwRouteUnload->CreateDate->getPlaceHolder()) ?>" value="<?php echo $vwRouteUnload->CreateDate->EditValue ?>"<?php echo $vwRouteUnload->CreateDate->editAttributes() ?>>
<?php if (!$vwRouteUnload->CreateDate->ReadOnly && !$vwRouteUnload->CreateDate->Disabled && !isset($vwRouteUnload->CreateDate->EditAttrs["readonly"]) && !isset($vwRouteUnload->CreateDate->EditAttrs["disabled"])) { ?>
<script>
ew.createDateTimePicker("fvwRouteUnloadgrid", "x<?php echo $vwRouteUnload_grid->RowIndex ?>_CreateDate", {"ignoreReadonly":true,"useCurrent":false,"format":0});
</script>
<?php } ?>
</span>
<input type="hidden" data-table="vwRouteUnload" data-field="x_CreateDate" name="o<?php echo $vwRouteUnload_grid->RowIndex ?>_CreateDate" id="o<?php echo $vwRouteUnload_grid->RowIndex ?>_CreateDate" value="<?php echo HtmlEncode($vwRouteUnload->CreateDate->OldValue) ?>">
<?php } ?>
<?php if ($vwRouteUnload->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $vwRouteUnload_grid->RowCnt ?>_vwRouteUnload_CreateDate" class="form-group vwRouteUnload_CreateDate">
<input type="text" data-table="vwRouteUnload" data-field="x_CreateDate" name="x<?php echo $vwRouteUnload_grid->RowIndex ?>_CreateDate" id="x<?php echo $vwRouteUnload_grid->RowIndex ?>_CreateDate" placeholder="<?php echo HtmlEncode($vwRouteUnload->CreateDate->getPlaceHolder()) ?>" value="<?php echo $vwRouteUnload->CreateDate->EditValue ?>"<?php echo $vwRouteUnload->CreateDate->editAttributes() ?>>
<?php if (!$vwRouteUnload->CreateDate->ReadOnly && !$vwRouteUnload->CreateDate->Disabled && !isset($vwRouteUnload->CreateDate->EditAttrs["readonly"]) && !isset($vwRouteUnload->CreateDate->EditAttrs["disabled"])) { ?>
<script>
ew.createDateTimePicker("fvwRouteUnloadgrid", "x<?php echo $vwRouteUnload_grid->RowIndex ?>_CreateDate", {"ignoreReadonly":true,"useCurrent":false,"format":0});
</script>
<?php } ?>
</span>
<?php } ?>
<?php if ($vwRouteUnload->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $vwRouteUnload_grid->RowCnt ?>_vwRouteUnload_CreateDate" class="vwRouteUnload_CreateDate">
<span<?php echo $vwRouteUnload->CreateDate->viewAttributes() ?>>
<?php echo $vwRouteUnload->CreateDate->getViewValue() ?></span>
</span>
<?php if (!$vwRouteUnload->isConfirm()) { ?>
<input type="hidden" data-table="vwRouteUnload" data-field="x_CreateDate" name="x<?php echo $vwRouteUnload_grid->RowIndex ?>_CreateDate" id="x<?php echo $vwRouteUnload_grid->RowIndex ?>_CreateDate" value="<?php echo HtmlEncode($vwRouteUnload->CreateDate->FormValue) ?>">
<input type="hidden" data-table="vwRouteUnload" data-field="x_CreateDate" name="o<?php echo $vwRouteUnload_grid->RowIndex ?>_CreateDate" id="o<?php echo $vwRouteUnload_grid->RowIndex ?>_CreateDate" value="<?php echo HtmlEncode($vwRouteUnload->CreateDate->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="vwRouteUnload" data-field="x_CreateDate" name="fvwRouteUnloadgrid$x<?php echo $vwRouteUnload_grid->RowIndex ?>_CreateDate" id="fvwRouteUnloadgrid$x<?php echo $vwRouteUnload_grid->RowIndex ?>_CreateDate" value="<?php echo HtmlEncode($vwRouteUnload->CreateDate->FormValue) ?>">
<input type="hidden" data-table="vwRouteUnload" data-field="x_CreateDate" name="fvwRouteUnloadgrid$o<?php echo $vwRouteUnload_grid->RowIndex ?>_CreateDate" id="fvwRouteUnloadgrid$o<?php echo $vwRouteUnload_grid->RowIndex ?>_CreateDate" value="<?php echo HtmlEncode($vwRouteUnload->CreateDate->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($vwRouteUnload->MFG->Visible) { // MFG ?>
		<td data-name="MFG"<?php echo $vwRouteUnload->MFG->cellAttributes() ?>>
<?php if ($vwRouteUnload->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $vwRouteUnload_grid->RowCnt ?>_vwRouteUnload_MFG" class="form-group vwRouteUnload_MFG">
<input type="text" data-table="vwRouteUnload" data-field="x_MFG" name="x<?php echo $vwRouteUnload_grid->RowIndex ?>_MFG" id="x<?php echo $vwRouteUnload_grid->RowIndex ?>_MFG" placeholder="<?php echo HtmlEncode($vwRouteUnload->MFG->getPlaceHolder()) ?>" value="<?php echo $vwRouteUnload->MFG->EditValue ?>"<?php echo $vwRouteUnload->MFG->editAttributes() ?>>
<?php if (!$vwRouteUnload->MFG->ReadOnly && !$vwRouteUnload->MFG->Disabled && !isset($vwRouteUnload->MFG->EditAttrs["readonly"]) && !isset($vwRouteUnload->MFG->EditAttrs["disabled"])) { ?>
<script>
ew.createDateTimePicker("fvwRouteUnloadgrid", "x<?php echo $vwRouteUnload_grid->RowIndex ?>_MFG", {"ignoreReadonly":true,"useCurrent":false,"format":0});
</script>
<?php } ?>
</span>
<input type="hidden" data-table="vwRouteUnload" data-field="x_MFG" name="o<?php echo $vwRouteUnload_grid->RowIndex ?>_MFG" id="o<?php echo $vwRouteUnload_grid->RowIndex ?>_MFG" value="<?php echo HtmlEncode($vwRouteUnload->MFG->OldValue) ?>">
<?php } ?>
<?php if ($vwRouteUnload->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $vwRouteUnload_grid->RowCnt ?>_vwRouteUnload_MFG" class="form-group vwRouteUnload_MFG">
<input type="text" data-table="vwRouteUnload" data-field="x_MFG" name="x<?php echo $vwRouteUnload_grid->RowIndex ?>_MFG" id="x<?php echo $vwRouteUnload_grid->RowIndex ?>_MFG" placeholder="<?php echo HtmlEncode($vwRouteUnload->MFG->getPlaceHolder()) ?>" value="<?php echo $vwRouteUnload->MFG->EditValue ?>"<?php echo $vwRouteUnload->MFG->editAttributes() ?>>
<?php if (!$vwRouteUnload->MFG->ReadOnly && !$vwRouteUnload->MFG->Disabled && !isset($vwRouteUnload->MFG->EditAttrs["readonly"]) && !isset($vwRouteUnload->MFG->EditAttrs["disabled"])) { ?>
<script>
ew.createDateTimePicker("fvwRouteUnloadgrid", "x<?php echo $vwRouteUnload_grid->RowIndex ?>_MFG", {"ignoreReadonly":true,"useCurrent":false,"format":0});
</script>
<?php } ?>
</span>
<?php } ?>
<?php if ($vwRouteUnload->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $vwRouteUnload_grid->RowCnt ?>_vwRouteUnload_MFG" class="vwRouteUnload_MFG">
<span<?php echo $vwRouteUnload->MFG->viewAttributes() ?>>
<?php echo $vwRouteUnload->MFG->getViewValue() ?></span>
</span>
<?php if (!$vwRouteUnload->isConfirm()) { ?>
<input type="hidden" data-table="vwRouteUnload" data-field="x_MFG" name="x<?php echo $vwRouteUnload_grid->RowIndex ?>_MFG" id="x<?php echo $vwRouteUnload_grid->RowIndex ?>_MFG" value="<?php echo HtmlEncode($vwRouteUnload->MFG->FormValue) ?>">
<input type="hidden" data-table="vwRouteUnload" data-field="x_MFG" name="o<?php echo $vwRouteUnload_grid->RowIndex ?>_MFG" id="o<?php echo $vwRouteUnload_grid->RowIndex ?>_MFG" value="<?php echo HtmlEncode($vwRouteUnload->MFG->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="vwRouteUnload" data-field="x_MFG" name="fvwRouteUnloadgrid$x<?php echo $vwRouteUnload_grid->RowIndex ?>_MFG" id="fvwRouteUnloadgrid$x<?php echo $vwRouteUnload_grid->RowIndex ?>_MFG" value="<?php echo HtmlEncode($vwRouteUnload->MFG->FormValue) ?>">
<input type="hidden" data-table="vwRouteUnload" data-field="x_MFG" name="fvwRouteUnloadgrid$o<?php echo $vwRouteUnload_grid->RowIndex ?>_MFG" id="fvwRouteUnloadgrid$o<?php echo $vwRouteUnload_grid->RowIndex ?>_MFG" value="<?php echo HtmlEncode($vwRouteUnload->MFG->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($vwRouteUnload->Description->Visible) { // Description ?>
		<td data-name="Description"<?php echo $vwRouteUnload->Description->cellAttributes() ?>>
<?php if ($vwRouteUnload->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $vwRouteUnload_grid->RowCnt ?>_vwRouteUnload_Description" class="form-group vwRouteUnload_Description">
<input type="text" data-table="vwRouteUnload" data-field="x_Description" name="x<?php echo $vwRouteUnload_grid->RowIndex ?>_Description" id="x<?php echo $vwRouteUnload_grid->RowIndex ?>_Description" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($vwRouteUnload->Description->getPlaceHolder()) ?>" value="<?php echo $vwRouteUnload->Description->EditValue ?>"<?php echo $vwRouteUnload->Description->editAttributes() ?>>
</span>
<input type="hidden" data-table="vwRouteUnload" data-field="x_Description" name="o<?php echo $vwRouteUnload_grid->RowIndex ?>_Description" id="o<?php echo $vwRouteUnload_grid->RowIndex ?>_Description" value="<?php echo HtmlEncode($vwRouteUnload->Description->OldValue) ?>">
<?php } ?>
<?php if ($vwRouteUnload->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $vwRouteUnload_grid->RowCnt ?>_vwRouteUnload_Description" class="form-group vwRouteUnload_Description">
<input type="text" data-table="vwRouteUnload" data-field="x_Description" name="x<?php echo $vwRouteUnload_grid->RowIndex ?>_Description" id="x<?php echo $vwRouteUnload_grid->RowIndex ?>_Description" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($vwRouteUnload->Description->getPlaceHolder()) ?>" value="<?php echo $vwRouteUnload->Description->EditValue ?>"<?php echo $vwRouteUnload->Description->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($vwRouteUnload->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $vwRouteUnload_grid->RowCnt ?>_vwRouteUnload_Description" class="vwRouteUnload_Description">
<span<?php echo $vwRouteUnload->Description->viewAttributes() ?>>
<?php echo $vwRouteUnload->Description->getViewValue() ?></span>
</span>
<?php if (!$vwRouteUnload->isConfirm()) { ?>
<input type="hidden" data-table="vwRouteUnload" data-field="x_Description" name="x<?php echo $vwRouteUnload_grid->RowIndex ?>_Description" id="x<?php echo $vwRouteUnload_grid->RowIndex ?>_Description" value="<?php echo HtmlEncode($vwRouteUnload->Description->FormValue) ?>">
<input type="hidden" data-table="vwRouteUnload" data-field="x_Description" name="o<?php echo $vwRouteUnload_grid->RowIndex ?>_Description" id="o<?php echo $vwRouteUnload_grid->RowIndex ?>_Description" value="<?php echo HtmlEncode($vwRouteUnload->Description->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="vwRouteUnload" data-field="x_Description" name="fvwRouteUnloadgrid$x<?php echo $vwRouteUnload_grid->RowIndex ?>_Description" id="fvwRouteUnloadgrid$x<?php echo $vwRouteUnload_grid->RowIndex ?>_Description" value="<?php echo HtmlEncode($vwRouteUnload->Description->FormValue) ?>">
<input type="hidden" data-table="vwRouteUnload" data-field="x_Description" name="fvwRouteUnloadgrid$o<?php echo $vwRouteUnload_grid->RowIndex ?>_Description" id="fvwRouteUnloadgrid$o<?php echo $vwRouteUnload_grid->RowIndex ?>_Description" value="<?php echo HtmlEncode($vwRouteUnload->Description->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$vwRouteUnload_grid->ListOptions->render("body", "right", $vwRouteUnload_grid->RowCnt);
?>
	</tr>
<?php if ($vwRouteUnload->RowType == ROWTYPE_ADD || $vwRouteUnload->RowType == ROWTYPE_EDIT) { ?>
<script>
fvwRouteUnloadgrid.updateLists(<?php echo $vwRouteUnload_grid->RowIndex ?>);
</script>
<?php } ?>
<?php
	}
	} // End delete row checking
	if (!$vwRouteUnload->isGridAdd() || $vwRouteUnload->CurrentMode == "copy")
		if (!$vwRouteUnload_grid->Recordset->EOF)
			$vwRouteUnload_grid->Recordset->moveNext();
}
?>
<?php
	if ($vwRouteUnload->CurrentMode == "add" || $vwRouteUnload->CurrentMode == "copy" || $vwRouteUnload->CurrentMode == "edit") {
		$vwRouteUnload_grid->RowIndex = '$rowindex$';
		$vwRouteUnload_grid->loadRowValues();

		// Set row properties
		$vwRouteUnload->resetAttributes();
		$vwRouteUnload->RowAttrs = array_merge($vwRouteUnload->RowAttrs, array('data-rowindex'=>$vwRouteUnload_grid->RowIndex, 'id'=>'r0_vwRouteUnload', 'data-rowtype'=>ROWTYPE_ADD));
		AppendClass($vwRouteUnload->RowAttrs["class"], "ew-template");
		$vwRouteUnload->RowType = ROWTYPE_ADD;

		// Render row
		$vwRouteUnload_grid->renderRow();

		// Render list options
		$vwRouteUnload_grid->renderListOptions();
		$vwRouteUnload_grid->StartRowCnt = 0;
?>
	<tr<?php echo $vwRouteUnload->rowAttributes() ?>>
<?php

// Render list options (body, left)
$vwRouteUnload_grid->ListOptions->render("body", "left", $vwRouteUnload_grid->RowIndex);
?>
	<?php if ($vwRouteUnload->PalletID->Visible) { // PalletID ?>
		<td data-name="PalletID">
<?php if (!$vwRouteUnload->isConfirm()) { ?>
<span id="el$rowindex$_vwRouteUnload_PalletID" class="form-group vwRouteUnload_PalletID">
<input type="text" data-table="vwRouteUnload" data-field="x_PalletID" name="x<?php echo $vwRouteUnload_grid->RowIndex ?>_PalletID" id="x<?php echo $vwRouteUnload_grid->RowIndex ?>_PalletID" size="30" maxlength="50" placeholder="<?php echo HtmlEncode($vwRouteUnload->PalletID->getPlaceHolder()) ?>" value="<?php echo $vwRouteUnload->PalletID->EditValue ?>"<?php echo $vwRouteUnload->PalletID->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_vwRouteUnload_PalletID" class="form-group vwRouteUnload_PalletID">
<span<?php echo $vwRouteUnload->PalletID->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?php echo RemoveHtml($vwRouteUnload->PalletID->ViewValue) ?>"></span>
</span>
<input type="hidden" data-table="vwRouteUnload" data-field="x_PalletID" name="x<?php echo $vwRouteUnload_grid->RowIndex ?>_PalletID" id="x<?php echo $vwRouteUnload_grid->RowIndex ?>_PalletID" value="<?php echo HtmlEncode($vwRouteUnload->PalletID->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="vwRouteUnload" data-field="x_PalletID" name="o<?php echo $vwRouteUnload_grid->RowIndex ?>_PalletID" id="o<?php echo $vwRouteUnload_grid->RowIndex ?>_PalletID" value="<?php echo HtmlEncode($vwRouteUnload->PalletID->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($vwRouteUnload->Code->Visible) { // Code ?>
		<td data-name="Code">
<?php if (!$vwRouteUnload->isConfirm()) { ?>
<span id="el$rowindex$_vwRouteUnload_Code" class="form-group vwRouteUnload_Code">
<?php
$wrkonchange = "" . trim(@$vwRouteUnload->Code->EditAttrs["onchange"]);
if (trim($wrkonchange) <> "") $wrkonchange = " onchange=\"" . JsEncode($wrkonchange) . "\"";
$vwRouteUnload->Code->EditAttrs["onchange"] = "";
?>
<span id="as_x<?php echo $vwRouteUnload_grid->RowIndex ?>_Code" class="text-nowrap" style="z-index: <?php echo (9000 - $vwRouteUnload_grid->RowCnt * 10) ?>">
	<input type="text" class="form-control" name="sv_x<?php echo $vwRouteUnload_grid->RowIndex ?>_Code" id="sv_x<?php echo $vwRouteUnload_grid->RowIndex ?>_Code" value="<?php echo RemoveHtml($vwRouteUnload->Code->EditValue) ?>" size="30" maxlength="50" placeholder="<?php echo HtmlEncode($vwRouteUnload->Code->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($vwRouteUnload->Code->getPlaceHolder()) ?>"<?php echo $vwRouteUnload->Code->editAttributes() ?>>
</span>
<input type="hidden" data-table="vwRouteUnload" data-field="x_Code" data-value-separator="<?php echo $vwRouteUnload->Code->displayValueSeparatorAttribute() ?>" name="x<?php echo $vwRouteUnload_grid->RowIndex ?>_Code" id="x<?php echo $vwRouteUnload_grid->RowIndex ?>_Code" value="<?php echo HtmlEncode($vwRouteUnload->Code->CurrentValue) ?>"<?php echo $wrkonchange ?>>
<script>
fvwRouteUnloadgrid.createAutoSuggest({"id":"x<?php echo $vwRouteUnload_grid->RowIndex ?>_Code","forceSelect":false});
</script>
<?php echo $vwRouteUnload->Code->Lookup->getParamTag("p_x" . $vwRouteUnload_grid->RowIndex . "_Code") ?>
</span>
<?php } else { ?>
<span id="el$rowindex$_vwRouteUnload_Code" class="form-group vwRouteUnload_Code">
<span<?php echo $vwRouteUnload->Code->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?php echo RemoveHtml($vwRouteUnload->Code->ViewValue) ?>"></span>
</span>
<input type="hidden" data-table="vwRouteUnload" data-field="x_Code" name="x<?php echo $vwRouteUnload_grid->RowIndex ?>_Code" id="x<?php echo $vwRouteUnload_grid->RowIndex ?>_Code" value="<?php echo HtmlEncode($vwRouteUnload->Code->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="vwRouteUnload" data-field="x_Code" name="o<?php echo $vwRouteUnload_grid->RowIndex ?>_Code" id="o<?php echo $vwRouteUnload_grid->RowIndex ?>_Code" value="<?php echo HtmlEncode($vwRouteUnload->Code->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($vwRouteUnload->PCS->Visible) { // PCS ?>
		<td data-name="PCS">
<?php if (!$vwRouteUnload->isConfirm()) { ?>
<span id="el$rowindex$_vwRouteUnload_PCS" class="form-group vwRouteUnload_PCS">
<input type="text" data-table="vwRouteUnload" data-field="x_PCS" name="x<?php echo $vwRouteUnload_grid->RowIndex ?>_PCS" id="x<?php echo $vwRouteUnload_grid->RowIndex ?>_PCS" size="30" placeholder="<?php echo HtmlEncode($vwRouteUnload->PCS->getPlaceHolder()) ?>" value="<?php echo $vwRouteUnload->PCS->EditValue ?>"<?php echo $vwRouteUnload->PCS->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_vwRouteUnload_PCS" class="form-group vwRouteUnload_PCS">
<span<?php echo $vwRouteUnload->PCS->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?php echo RemoveHtml($vwRouteUnload->PCS->ViewValue) ?>"></span>
</span>
<input type="hidden" data-table="vwRouteUnload" data-field="x_PCS" name="x<?php echo $vwRouteUnload_grid->RowIndex ?>_PCS" id="x<?php echo $vwRouteUnload_grid->RowIndex ?>_PCS" value="<?php echo HtmlEncode($vwRouteUnload->PCS->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="vwRouteUnload" data-field="x_PCS" name="o<?php echo $vwRouteUnload_grid->RowIndex ?>_PCS" id="o<?php echo $vwRouteUnload_grid->RowIndex ?>_PCS" value="<?php echo HtmlEncode($vwRouteUnload->PCS->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($vwRouteUnload->PcsReal->Visible) { // PcsReal ?>
		<td data-name="PcsReal">
<?php if (!$vwRouteUnload->isConfirm()) { ?>
<span id="el$rowindex$_vwRouteUnload_PcsReal" class="form-group vwRouteUnload_PcsReal">
<input type="text" data-table="vwRouteUnload" data-field="x_PcsReal" name="x<?php echo $vwRouteUnload_grid->RowIndex ?>_PcsReal" id="x<?php echo $vwRouteUnload_grid->RowIndex ?>_PcsReal" size="30" placeholder="<?php echo HtmlEncode($vwRouteUnload->PcsReal->getPlaceHolder()) ?>" value="<?php echo $vwRouteUnload->PcsReal->EditValue ?>"<?php echo $vwRouteUnload->PcsReal->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_vwRouteUnload_PcsReal" class="form-group vwRouteUnload_PcsReal">
<span<?php echo $vwRouteUnload->PcsReal->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?php echo RemoveHtml($vwRouteUnload->PcsReal->ViewValue) ?>"></span>
</span>
<input type="hidden" data-table="vwRouteUnload" data-field="x_PcsReal" name="x<?php echo $vwRouteUnload_grid->RowIndex ?>_PcsReal" id="x<?php echo $vwRouteUnload_grid->RowIndex ?>_PcsReal" value="<?php echo HtmlEncode($vwRouteUnload->PcsReal->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="vwRouteUnload" data-field="x_PcsReal" name="o<?php echo $vwRouteUnload_grid->RowIndex ?>_PcsReal" id="o<?php echo $vwRouteUnload_grid->RowIndex ?>_PcsReal" value="<?php echo HtmlEncode($vwRouteUnload->PcsReal->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($vwRouteUnload->CreateUser->Visible) { // CreateUser ?>
		<td data-name="CreateUser">
<?php if (!$vwRouteUnload->isConfirm()) { ?>
<span id="el$rowindex$_vwRouteUnload_CreateUser" class="form-group vwRouteUnload_CreateUser">
<input type="text" data-table="vwRouteUnload" data-field="x_CreateUser" name="x<?php echo $vwRouteUnload_grid->RowIndex ?>_CreateUser" id="x<?php echo $vwRouteUnload_grid->RowIndex ?>_CreateUser" size="30" maxlength="50" placeholder="<?php echo HtmlEncode($vwRouteUnload->CreateUser->getPlaceHolder()) ?>" value="<?php echo $vwRouteUnload->CreateUser->EditValue ?>"<?php echo $vwRouteUnload->CreateUser->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_vwRouteUnload_CreateUser" class="form-group vwRouteUnload_CreateUser">
<span<?php echo $vwRouteUnload->CreateUser->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?php echo RemoveHtml($vwRouteUnload->CreateUser->ViewValue) ?>"></span>
</span>
<input type="hidden" data-table="vwRouteUnload" data-field="x_CreateUser" name="x<?php echo $vwRouteUnload_grid->RowIndex ?>_CreateUser" id="x<?php echo $vwRouteUnload_grid->RowIndex ?>_CreateUser" value="<?php echo HtmlEncode($vwRouteUnload->CreateUser->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="vwRouteUnload" data-field="x_CreateUser" name="o<?php echo $vwRouteUnload_grid->RowIndex ?>_CreateUser" id="o<?php echo $vwRouteUnload_grid->RowIndex ?>_CreateUser" value="<?php echo HtmlEncode($vwRouteUnload->CreateUser->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($vwRouteUnload->CreateDate->Visible) { // CreateDate ?>
		<td data-name="CreateDate">
<?php if (!$vwRouteUnload->isConfirm()) { ?>
<span id="el$rowindex$_vwRouteUnload_CreateDate" class="form-group vwRouteUnload_CreateDate">
<input type="text" data-table="vwRouteUnload" data-field="x_CreateDate" name="x<?php echo $vwRouteUnload_grid->RowIndex ?>_CreateDate" id="x<?php echo $vwRouteUnload_grid->RowIndex ?>_CreateDate" placeholder="<?php echo HtmlEncode($vwRouteUnload->CreateDate->getPlaceHolder()) ?>" value="<?php echo $vwRouteUnload->CreateDate->EditValue ?>"<?php echo $vwRouteUnload->CreateDate->editAttributes() ?>>
<?php if (!$vwRouteUnload->CreateDate->ReadOnly && !$vwRouteUnload->CreateDate->Disabled && !isset($vwRouteUnload->CreateDate->EditAttrs["readonly"]) && !isset($vwRouteUnload->CreateDate->EditAttrs["disabled"])) { ?>
<script>
ew.createDateTimePicker("fvwRouteUnloadgrid", "x<?php echo $vwRouteUnload_grid->RowIndex ?>_CreateDate", {"ignoreReadonly":true,"useCurrent":false,"format":0});
</script>
<?php } ?>
</span>
<?php } else { ?>
<span id="el$rowindex$_vwRouteUnload_CreateDate" class="form-group vwRouteUnload_CreateDate">
<span<?php echo $vwRouteUnload->CreateDate->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?php echo RemoveHtml($vwRouteUnload->CreateDate->ViewValue) ?>"></span>
</span>
<input type="hidden" data-table="vwRouteUnload" data-field="x_CreateDate" name="x<?php echo $vwRouteUnload_grid->RowIndex ?>_CreateDate" id="x<?php echo $vwRouteUnload_grid->RowIndex ?>_CreateDate" value="<?php echo HtmlEncode($vwRouteUnload->CreateDate->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="vwRouteUnload" data-field="x_CreateDate" name="o<?php echo $vwRouteUnload_grid->RowIndex ?>_CreateDate" id="o<?php echo $vwRouteUnload_grid->RowIndex ?>_CreateDate" value="<?php echo HtmlEncode($vwRouteUnload->CreateDate->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($vwRouteUnload->MFG->Visible) { // MFG ?>
		<td data-name="MFG">
<?php if (!$vwRouteUnload->isConfirm()) { ?>
<span id="el$rowindex$_vwRouteUnload_MFG" class="form-group vwRouteUnload_MFG">
<input type="text" data-table="vwRouteUnload" data-field="x_MFG" name="x<?php echo $vwRouteUnload_grid->RowIndex ?>_MFG" id="x<?php echo $vwRouteUnload_grid->RowIndex ?>_MFG" placeholder="<?php echo HtmlEncode($vwRouteUnload->MFG->getPlaceHolder()) ?>" value="<?php echo $vwRouteUnload->MFG->EditValue ?>"<?php echo $vwRouteUnload->MFG->editAttributes() ?>>
<?php if (!$vwRouteUnload->MFG->ReadOnly && !$vwRouteUnload->MFG->Disabled && !isset($vwRouteUnload->MFG->EditAttrs["readonly"]) && !isset($vwRouteUnload->MFG->EditAttrs["disabled"])) { ?>
<script>
ew.createDateTimePicker("fvwRouteUnloadgrid", "x<?php echo $vwRouteUnload_grid->RowIndex ?>_MFG", {"ignoreReadonly":true,"useCurrent":false,"format":0});
</script>
<?php } ?>
</span>
<?php } else { ?>
<span id="el$rowindex$_vwRouteUnload_MFG" class="form-group vwRouteUnload_MFG">
<span<?php echo $vwRouteUnload->MFG->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?php echo RemoveHtml($vwRouteUnload->MFG->ViewValue) ?>"></span>
</span>
<input type="hidden" data-table="vwRouteUnload" data-field="x_MFG" name="x<?php echo $vwRouteUnload_grid->RowIndex ?>_MFG" id="x<?php echo $vwRouteUnload_grid->RowIndex ?>_MFG" value="<?php echo HtmlEncode($vwRouteUnload->MFG->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="vwRouteUnload" data-field="x_MFG" name="o<?php echo $vwRouteUnload_grid->RowIndex ?>_MFG" id="o<?php echo $vwRouteUnload_grid->RowIndex ?>_MFG" value="<?php echo HtmlEncode($vwRouteUnload->MFG->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($vwRouteUnload->Description->Visible) { // Description ?>
		<td data-name="Description">
<?php if (!$vwRouteUnload->isConfirm()) { ?>
<span id="el$rowindex$_vwRouteUnload_Description" class="form-group vwRouteUnload_Description">
<input type="text" data-table="vwRouteUnload" data-field="x_Description" name="x<?php echo $vwRouteUnload_grid->RowIndex ?>_Description" id="x<?php echo $vwRouteUnload_grid->RowIndex ?>_Description" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($vwRouteUnload->Description->getPlaceHolder()) ?>" value="<?php echo $vwRouteUnload->Description->EditValue ?>"<?php echo $vwRouteUnload->Description->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_vwRouteUnload_Description" class="form-group vwRouteUnload_Description">
<span<?php echo $vwRouteUnload->Description->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?php echo RemoveHtml($vwRouteUnload->Description->ViewValue) ?>"></span>
</span>
<input type="hidden" data-table="vwRouteUnload" data-field="x_Description" name="x<?php echo $vwRouteUnload_grid->RowIndex ?>_Description" id="x<?php echo $vwRouteUnload_grid->RowIndex ?>_Description" value="<?php echo HtmlEncode($vwRouteUnload->Description->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="vwRouteUnload" data-field="x_Description" name="o<?php echo $vwRouteUnload_grid->RowIndex ?>_Description" id="o<?php echo $vwRouteUnload_grid->RowIndex ?>_Description" value="<?php echo HtmlEncode($vwRouteUnload->Description->OldValue) ?>">
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$vwRouteUnload_grid->ListOptions->render("body", "right", $vwRouteUnload_grid->RowIndex);
?>
<script>
fvwRouteUnloadgrid.updateLists(<?php echo $vwRouteUnload_grid->RowIndex ?>);
</script>
	</tr>
<?php
}
?>
</tbody>
<?php

// Render aggregate row
$vwRouteUnload->RowType = ROWTYPE_AGGREGATE;
$vwRouteUnload->resetAttributes();
$vwRouteUnload_grid->renderRow();
?>
<?php if ($vwRouteUnload_grid->TotalRecs > 0 && $vwRouteUnload->CurrentMode == "view") { ?>
<tfoot><!-- Table footer -->
	<tr class="ew-table-footer">
<?php

// Render list options
$vwRouteUnload_grid->renderListOptions();

// Render list options (footer, left)
$vwRouteUnload_grid->ListOptions->render("footer", "left");
?>
	<?php if ($vwRouteUnload->PalletID->Visible) { // PalletID ?>
		<td data-name="PalletID" class="<?php echo $vwRouteUnload->PalletID->footerCellClass() ?>"><span id="elf_vwRouteUnload_PalletID" class="vwRouteUnload_PalletID">
		&nbsp;
		</span></td>
	<?php } ?>
	<?php if ($vwRouteUnload->Code->Visible) { // Code ?>
		<td data-name="Code" class="<?php echo $vwRouteUnload->Code->footerCellClass() ?>"><span id="elf_vwRouteUnload_Code" class="vwRouteUnload_Code">
		&nbsp;
		</span></td>
	<?php } ?>
	<?php if ($vwRouteUnload->PCS->Visible) { // PCS ?>
		<td data-name="PCS" class="<?php echo $vwRouteUnload->PCS->footerCellClass() ?>"><span id="elf_vwRouteUnload_PCS" class="vwRouteUnload_PCS">
		<span class="ew-aggregate"><?php echo $Language->phrase("TOTAL") ?></span><span class="ew-aggregate-value">
		<?php echo $vwRouteUnload->PCS->ViewValue ?></span>
		</span></td>
	<?php } ?>
	<?php if ($vwRouteUnload->PcsReal->Visible) { // PcsReal ?>
		<td data-name="PcsReal" class="<?php echo $vwRouteUnload->PcsReal->footerCellClass() ?>"><span id="elf_vwRouteUnload_PcsReal" class="vwRouteUnload_PcsReal">
		<span class="ew-aggregate"><?php echo $Language->phrase("TOTAL") ?></span><span class="ew-aggregate-value">
		<?php echo $vwRouteUnload->PcsReal->ViewValue ?></span>
		</span></td>
	<?php } ?>
	<?php if ($vwRouteUnload->CreateUser->Visible) { // CreateUser ?>
		<td data-name="CreateUser" class="<?php echo $vwRouteUnload->CreateUser->footerCellClass() ?>"><span id="elf_vwRouteUnload_CreateUser" class="vwRouteUnload_CreateUser">
		&nbsp;
		</span></td>
	<?php } ?>
	<?php if ($vwRouteUnload->CreateDate->Visible) { // CreateDate ?>
		<td data-name="CreateDate" class="<?php echo $vwRouteUnload->CreateDate->footerCellClass() ?>"><span id="elf_vwRouteUnload_CreateDate" class="vwRouteUnload_CreateDate">
		&nbsp;
		</span></td>
	<?php } ?>
	<?php if ($vwRouteUnload->MFG->Visible) { // MFG ?>
		<td data-name="MFG" class="<?php echo $vwRouteUnload->MFG->footerCellClass() ?>"><span id="elf_vwRouteUnload_MFG" class="vwRouteUnload_MFG">
		&nbsp;
		</span></td>
	<?php } ?>
	<?php if ($vwRouteUnload->Description->Visible) { // Description ?>
		<td data-name="Description" class="<?php echo $vwRouteUnload->Description->footerCellClass() ?>"><span id="elf_vwRouteUnload_Description" class="vwRouteUnload_Description">
		&nbsp;
		</span></td>
	<?php } ?>
<?php

// Render list options (footer, right)
$vwRouteUnload_grid->ListOptions->render("footer", "right");
?>
	</tr>
</tfoot>
<?php } ?>
</table><!-- /.ew-table -->
<?php if ($vwRouteUnload->CurrentMode == "add" || $vwRouteUnload->CurrentMode == "copy") { ?>
<input type="hidden" name="<?php echo $vwRouteUnload_grid->FormKeyCountName ?>" id="<?php echo $vwRouteUnload_grid->FormKeyCountName ?>" value="<?php echo $vwRouteUnload_grid->KeyCount ?>">
<?php echo $vwRouteUnload_grid->MultiSelectKey ?>
<?php } ?>
<?php if ($vwRouteUnload->CurrentMode == "edit") { ?>
<input type="hidden" name="<?php echo $vwRouteUnload_grid->FormKeyCountName ?>" id="<?php echo $vwRouteUnload_grid->FormKeyCountName ?>" value="<?php echo $vwRouteUnload_grid->KeyCount ?>">
<?php echo $vwRouteUnload_grid->MultiSelectKey ?>
<?php } ?>
<?php if ($vwRouteUnload->CurrentMode == "") { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
<input type="hidden" name="detailpage" value="fvwRouteUnloadgrid">
</div><!-- /.ew-grid-middle-panel -->
<?php

// Close recordset
if ($vwRouteUnload_grid->Recordset)
	$vwRouteUnload_grid->Recordset->Close();
?>
</div>
<?php if ($vwRouteUnload_grid->ShowOtherOptions) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php $vwRouteUnload_grid->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($vwRouteUnload_grid->TotalRecs == 0 && !$vwRouteUnload->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $vwRouteUnload_grid->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$vwRouteUnload_grid->terminate();
?>