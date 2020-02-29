<?php
namespace PHPMaker2019\asgbn_wh;

// Write header
WriteHeader(FALSE);

// Create page object
if (!isset($tbl_guider_grid))
	$tbl_guider_grid = new tbl_guider_grid();

// Run the page
$tbl_guider_grid->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$tbl_guider_grid->Page_Render();
?>
<?php if (!$tbl_guider->isExport()) { ?>
<script>

// Form object
var ftbl_guidergrid = new ew.Form("ftbl_guidergrid", "grid");
ftbl_guidergrid.formKeyCountName = '<?php echo $tbl_guider_grid->FormKeyCountName ?>';

// Validate form
ftbl_guidergrid.validate = function() {
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
		<?php if ($tbl_guider_grid->Code->Required) { ?>
			elm = this.getElements("x" + infix + "_Code");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $tbl_guider->Code->caption(), $tbl_guider->Code->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($tbl_guider_grid->ProductName->Required) { ?>
			elm = this.getElements("x" + infix + "_ProductName");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $tbl_guider->ProductName->caption(), $tbl_guider->ProductName->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($tbl_guider_grid->PCS_Request->Required) { ?>
			elm = this.getElements("x" + infix + "_PCS_Request");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $tbl_guider->PCS_Request->caption(), $tbl_guider->PCS_Request->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($tbl_guider_grid->ID_Location->Required) { ?>
			elm = this.getElements("x" + infix + "_ID_Location");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $tbl_guider->ID_Location->caption(), $tbl_guider->ID_Location->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($tbl_guider_grid->PCS_In->Required) { ?>
			elm = this.getElements("x" + infix + "_PCS_In");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $tbl_guider->PCS_In->caption(), $tbl_guider->PCS_In->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($tbl_guider_grid->PCS->Required) { ?>
			elm = this.getElements("x" + infix + "_PCS");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $tbl_guider->PCS->caption(), $tbl_guider->PCS->RequiredErrorMessage)) ?>");
		<?php } ?>
			elm = this.getElements("x" + infix + "_PCS");
			if (elm && !ew.checkInteger(elm.value))
				return this.onError(elm, "<?php echo JsEncode($tbl_guider->PCS->errorMessage()) ?>");
		<?php if ($tbl_guider_grid->PalletID->Required) { ?>
			elm = this.getElements("x" + infix + "_PalletID");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $tbl_guider->PalletID->caption(), $tbl_guider->PalletID->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($tbl_guider_grid->DateIn->Required) { ?>
			elm = this.getElements("x" + infix + "_DateIn");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $tbl_guider->DateIn->caption(), $tbl_guider->DateIn->RequiredErrorMessage)) ?>");
		<?php } ?>

			// Fire Form_CustomValidate event
			if (!this.Form_CustomValidate(fobj))
				return false;
		} // End Grid Add checking
	}
	return true;
}

// Check empty row
ftbl_guidergrid.emptyRow = function(infix) {
	var fobj = this._form;
	if (ew.valueChanged(fobj, infix, "Code", false)) return false;
	if (ew.valueChanged(fobj, infix, "ProductName", false)) return false;
	if (ew.valueChanged(fobj, infix, "PCS_Request", false)) return false;
	if (ew.valueChanged(fobj, infix, "ID_Location", false)) return false;
	if (ew.valueChanged(fobj, infix, "PCS_In", false)) return false;
	if (ew.valueChanged(fobj, infix, "PCS", false)) return false;
	if (ew.valueChanged(fobj, infix, "PalletID", false)) return false;
	if (ew.valueChanged(fobj, infix, "DateIn", false)) return false;
	return true;
}

// Form_CustomValidate event
ftbl_guidergrid.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

	// Your custom validation code here, return false if invalid.
	return true;
}

// Use JavaScript validation or not
ftbl_guidergrid.validateRequired = <?php echo json_encode(CLIENT_VALIDATE) ?>;

// Dynamic selection lists
ftbl_guidergrid.lists["x_ID_Location"] = <?php echo $tbl_guider_grid->ID_Location->Lookup->toClientList() ?>;
ftbl_guidergrid.lists["x_ID_Location"].options = <?php echo JsonEncode($tbl_guider_grid->ID_Location->lookupOptions()) ?>;
ftbl_guidergrid.autoSuggests["x_ID_Location"] = <?php echo json_encode(["data" => "ajax=autosuggest"]) ?>;

// Form object for search
</script>
<?php } ?>
<?php
$tbl_guider_grid->renderOtherOptions();
?>
<?php $tbl_guider_grid->showPageHeader(); ?>
<?php
$tbl_guider_grid->showMessage();
?>
<?php if ($tbl_guider_grid->TotalRecs > 0 || $tbl_guider->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($tbl_guider_grid->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> tbl_guider">
<?php if ($tbl_guider_grid->ShowOtherOptions) { ?>
<div class="card-header ew-grid-upper-panel">
<?php $tbl_guider_grid->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<div id="ftbl_guidergrid" class="ew-form ew-list-form form-inline">
<div id="gmp_tbl_guider" class="<?php if (IsResponsiveLayout()) { ?>table-responsive <?php } ?>card-body ew-grid-middle-panel">
<table id="tbl_tbl_guidergrid" class="table ew-table"><!-- .ew-table ##-->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$tbl_guider_grid->RowType = ROWTYPE_HEADER;

// Render list options
$tbl_guider_grid->renderListOptions();

// Render list options (header, left)
$tbl_guider_grid->ListOptions->render("header", "left");
?>
<?php if ($tbl_guider->Code->Visible) { // Code ?>
	<?php if ($tbl_guider->sortUrl($tbl_guider->Code) == "") { ?>
		<th data-name="Code" class="<?php echo $tbl_guider->Code->headerCellClass() ?>" style="width: 100px; white-space: nowrap;"><div id="elh_tbl_guider_Code" class="tbl_guider_Code"><div class="ew-table-header-caption"><?php echo $tbl_guider->Code->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Code" class="<?php echo $tbl_guider->Code->headerCellClass() ?>" style="width: 100px; white-space: nowrap;"><div><div id="elh_tbl_guider_Code" class="tbl_guider_Code">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $tbl_guider->Code->caption() ?></span><span class="ew-table-header-sort"><?php if ($tbl_guider->Code->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($tbl_guider->Code->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($tbl_guider->ProductName->Visible) { // ProductName ?>
	<?php if ($tbl_guider->sortUrl($tbl_guider->ProductName) == "") { ?>
		<th data-name="ProductName" class="<?php echo $tbl_guider->ProductName->headerCellClass() ?>" style="width: 200px; white-space: nowrap;"><div id="elh_tbl_guider_ProductName" class="tbl_guider_ProductName"><div class="ew-table-header-caption"><?php echo $tbl_guider->ProductName->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="ProductName" class="<?php echo $tbl_guider->ProductName->headerCellClass() ?>" style="width: 200px; white-space: nowrap;"><div><div id="elh_tbl_guider_ProductName" class="tbl_guider_ProductName">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $tbl_guider->ProductName->caption() ?></span><span class="ew-table-header-sort"><?php if ($tbl_guider->ProductName->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($tbl_guider->ProductName->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($tbl_guider->PCS_Request->Visible) { // PCS_Request ?>
	<?php if ($tbl_guider->sortUrl($tbl_guider->PCS_Request) == "") { ?>
		<th data-name="PCS_Request" class="<?php echo $tbl_guider->PCS_Request->headerCellClass() ?>" style="width: 3px; white-space: nowrap;"><div id="elh_tbl_guider_PCS_Request" class="tbl_guider_PCS_Request"><div class="ew-table-header-caption"><?php echo $tbl_guider->PCS_Request->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="PCS_Request" class="<?php echo $tbl_guider->PCS_Request->headerCellClass() ?>" style="width: 3px; white-space: nowrap;"><div><div id="elh_tbl_guider_PCS_Request" class="tbl_guider_PCS_Request">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $tbl_guider->PCS_Request->caption() ?></span><span class="ew-table-header-sort"><?php if ($tbl_guider->PCS_Request->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($tbl_guider->PCS_Request->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($tbl_guider->ID_Location->Visible) { // ID_Location ?>
	<?php if ($tbl_guider->sortUrl($tbl_guider->ID_Location) == "") { ?>
		<th data-name="ID_Location" class="<?php echo $tbl_guider->ID_Location->headerCellClass() ?>" style="white-space: nowrap;"><div id="elh_tbl_guider_ID_Location" class="tbl_guider_ID_Location"><div class="ew-table-header-caption"><?php echo $tbl_guider->ID_Location->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="ID_Location" class="<?php echo $tbl_guider->ID_Location->headerCellClass() ?>" style="white-space: nowrap;"><div><div id="elh_tbl_guider_ID_Location" class="tbl_guider_ID_Location">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $tbl_guider->ID_Location->caption() ?></span><span class="ew-table-header-sort"><?php if ($tbl_guider->ID_Location->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($tbl_guider->ID_Location->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($tbl_guider->PCS_In->Visible) { // PCS_In ?>
	<?php if ($tbl_guider->sortUrl($tbl_guider->PCS_In) == "") { ?>
		<th data-name="PCS_In" class="<?php echo $tbl_guider->PCS_In->headerCellClass() ?>" style="width: 3px; white-space: nowrap;"><div id="elh_tbl_guider_PCS_In" class="tbl_guider_PCS_In"><div class="ew-table-header-caption"><?php echo $tbl_guider->PCS_In->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="PCS_In" class="<?php echo $tbl_guider->PCS_In->headerCellClass() ?>" style="width: 3px; white-space: nowrap;"><div><div id="elh_tbl_guider_PCS_In" class="tbl_guider_PCS_In">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $tbl_guider->PCS_In->caption() ?></span><span class="ew-table-header-sort"><?php if ($tbl_guider->PCS_In->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($tbl_guider->PCS_In->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($tbl_guider->PCS->Visible) { // PCS ?>
	<?php if ($tbl_guider->sortUrl($tbl_guider->PCS) == "") { ?>
		<th data-name="PCS" class="<?php echo $tbl_guider->PCS->headerCellClass() ?>" style="width: 3px; white-space: nowrap;"><div id="elh_tbl_guider_PCS" class="tbl_guider_PCS"><div class="ew-table-header-caption"><?php echo $tbl_guider->PCS->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="PCS" class="<?php echo $tbl_guider->PCS->headerCellClass() ?>" style="width: 3px; white-space: nowrap;"><div><div id="elh_tbl_guider_PCS" class="tbl_guider_PCS">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $tbl_guider->PCS->caption() ?></span><span class="ew-table-header-sort"><?php if ($tbl_guider->PCS->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($tbl_guider->PCS->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($tbl_guider->PalletID->Visible) { // PalletID ?>
	<?php if ($tbl_guider->sortUrl($tbl_guider->PalletID) == "") { ?>
		<th data-name="PalletID" class="<?php echo $tbl_guider->PalletID->headerCellClass() ?>" style="white-space: nowrap;"><div id="elh_tbl_guider_PalletID" class="tbl_guider_PalletID"><div class="ew-table-header-caption"><?php echo $tbl_guider->PalletID->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="PalletID" class="<?php echo $tbl_guider->PalletID->headerCellClass() ?>" style="white-space: nowrap;"><div><div id="elh_tbl_guider_PalletID" class="tbl_guider_PalletID">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $tbl_guider->PalletID->caption() ?></span><span class="ew-table-header-sort"><?php if ($tbl_guider->PalletID->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($tbl_guider->PalletID->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($tbl_guider->DateIn->Visible) { // DateIn ?>
	<?php if ($tbl_guider->sortUrl($tbl_guider->DateIn) == "") { ?>
		<th data-name="DateIn" class="<?php echo $tbl_guider->DateIn->headerCellClass() ?>" style="white-space: nowrap;"><div id="elh_tbl_guider_DateIn" class="tbl_guider_DateIn"><div class="ew-table-header-caption"><?php echo $tbl_guider->DateIn->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="DateIn" class="<?php echo $tbl_guider->DateIn->headerCellClass() ?>" style="white-space: nowrap;"><div><div id="elh_tbl_guider_DateIn" class="tbl_guider_DateIn">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $tbl_guider->DateIn->caption() ?></span><span class="ew-table-header-sort"><?php if ($tbl_guider->DateIn->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($tbl_guider->DateIn->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$tbl_guider_grid->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
$tbl_guider_grid->StartRec = 1;
$tbl_guider_grid->StopRec = $tbl_guider_grid->TotalRecs; // Show all records

// Restore number of post back records
if ($CurrentForm && $tbl_guider_grid->EventCancelled) {
	$CurrentForm->Index = -1;
	if ($CurrentForm->hasValue($tbl_guider_grid->FormKeyCountName) && ($tbl_guider->isGridAdd() || $tbl_guider->isGridEdit() || $tbl_guider->isConfirm())) {
		$tbl_guider_grid->KeyCount = $CurrentForm->getValue($tbl_guider_grid->FormKeyCountName);
		$tbl_guider_grid->StopRec = $tbl_guider_grid->StartRec + $tbl_guider_grid->KeyCount - 1;
	}
}
$tbl_guider_grid->RecCnt = $tbl_guider_grid->StartRec - 1;
if ($tbl_guider_grid->Recordset && !$tbl_guider_grid->Recordset->EOF) {
	$tbl_guider_grid->Recordset->moveFirst();
	$selectLimit = $tbl_guider_grid->UseSelectLimit;
	if (!$selectLimit && $tbl_guider_grid->StartRec > 1)
		$tbl_guider_grid->Recordset->move($tbl_guider_grid->StartRec - 1);
} elseif (!$tbl_guider->AllowAddDeleteRow && $tbl_guider_grid->StopRec == 0) {
	$tbl_guider_grid->StopRec = $tbl_guider->GridAddRowCount;
}

// Initialize aggregate
$tbl_guider->RowType = ROWTYPE_AGGREGATEINIT;
$tbl_guider->resetAttributes();
$tbl_guider_grid->renderRow();
if ($tbl_guider->isGridAdd())
	$tbl_guider_grid->RowIndex = 0;
if ($tbl_guider->isGridEdit())
	$tbl_guider_grid->RowIndex = 0;
while ($tbl_guider_grid->RecCnt < $tbl_guider_grid->StopRec) {
	$tbl_guider_grid->RecCnt++;
	if ($tbl_guider_grid->RecCnt >= $tbl_guider_grid->StartRec) {
		$tbl_guider_grid->RowCnt++;
		if ($tbl_guider->isGridAdd() || $tbl_guider->isGridEdit() || $tbl_guider->isConfirm()) {
			$tbl_guider_grid->RowIndex++;
			$CurrentForm->Index = $tbl_guider_grid->RowIndex;
			if ($CurrentForm->hasValue($tbl_guider_grid->FormActionName) && $tbl_guider_grid->EventCancelled)
				$tbl_guider_grid->RowAction = strval($CurrentForm->getValue($tbl_guider_grid->FormActionName));
			elseif ($tbl_guider->isGridAdd())
				$tbl_guider_grid->RowAction = "insert";
			else
				$tbl_guider_grid->RowAction = "";
		}

		// Set up key count
		$tbl_guider_grid->KeyCount = $tbl_guider_grid->RowIndex;

		// Init row class and style
		$tbl_guider->resetAttributes();
		$tbl_guider->CssClass = "";
		if ($tbl_guider->isGridAdd()) {
			if ($tbl_guider->CurrentMode == "copy") {
				$tbl_guider_grid->loadRowValues($tbl_guider_grid->Recordset); // Load row values
				$tbl_guider_grid->setRecordKey($tbl_guider_grid->RowOldKey, $tbl_guider_grid->Recordset); // Set old record key
			} else {
				$tbl_guider_grid->loadRowValues(); // Load default values
				$tbl_guider_grid->RowOldKey = ""; // Clear old key value
			}
		} else {
			$tbl_guider_grid->loadRowValues($tbl_guider_grid->Recordset); // Load row values
		}
		$tbl_guider->RowType = ROWTYPE_VIEW; // Render view
		if ($tbl_guider->isGridAdd()) // Grid add
			$tbl_guider->RowType = ROWTYPE_ADD; // Render add
		if ($tbl_guider->isGridAdd() && $tbl_guider->EventCancelled && !$CurrentForm->hasValue("k_blankrow")) // Insert failed
			$tbl_guider_grid->restoreCurrentRowFormValues($tbl_guider_grid->RowIndex); // Restore form values
		if ($tbl_guider->isGridEdit()) { // Grid edit
			if ($tbl_guider->EventCancelled)
				$tbl_guider_grid->restoreCurrentRowFormValues($tbl_guider_grid->RowIndex); // Restore form values
			if ($tbl_guider_grid->RowAction == "insert")
				$tbl_guider->RowType = ROWTYPE_ADD; // Render add
			else
				$tbl_guider->RowType = ROWTYPE_EDIT; // Render edit
		}
		if ($tbl_guider->isGridEdit() && ($tbl_guider->RowType == ROWTYPE_EDIT || $tbl_guider->RowType == ROWTYPE_ADD) && $tbl_guider->EventCancelled) // Update failed
			$tbl_guider_grid->restoreCurrentRowFormValues($tbl_guider_grid->RowIndex); // Restore form values
		if ($tbl_guider->RowType == ROWTYPE_EDIT) // Edit row
			$tbl_guider_grid->EditRowCnt++;
		if ($tbl_guider->isConfirm()) // Confirm row
			$tbl_guider_grid->restoreCurrentRowFormValues($tbl_guider_grid->RowIndex); // Restore form values

		// Set up row id / data-rowindex
		$tbl_guider->RowAttrs = array_merge($tbl_guider->RowAttrs, array('data-rowindex'=>$tbl_guider_grid->RowCnt, 'id'=>'r' . $tbl_guider_grid->RowCnt . '_tbl_guider', 'data-rowtype'=>$tbl_guider->RowType));

		// Render row
		$tbl_guider_grid->renderRow();

		// Render list options
		$tbl_guider_grid->renderListOptions();

		// Skip delete row / empty row for confirm page
		if ($tbl_guider_grid->RowAction <> "delete" && $tbl_guider_grid->RowAction <> "insertdelete" && !($tbl_guider_grid->RowAction == "insert" && $tbl_guider->isConfirm() && $tbl_guider_grid->emptyRow())) {
?>
	<tr<?php echo $tbl_guider->rowAttributes() ?>>
<?php

// Render list options (body, left)
$tbl_guider_grid->ListOptions->render("body", "left", $tbl_guider_grid->RowCnt);
?>
	<?php if ($tbl_guider->Code->Visible) { // Code ?>
		<td data-name="Code"<?php echo $tbl_guider->Code->cellAttributes() ?>>
<?php if ($tbl_guider->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $tbl_guider_grid->RowCnt ?>_tbl_guider_Code" class="form-group tbl_guider_Code">
<input type="text" data-table="tbl_guider" data-field="x_Code" name="x<?php echo $tbl_guider_grid->RowIndex ?>_Code" id="x<?php echo $tbl_guider_grid->RowIndex ?>_Code" size="30" maxlength="50" placeholder="<?php echo HtmlEncode($tbl_guider->Code->getPlaceHolder()) ?>" value="<?php echo $tbl_guider->Code->EditValue ?>"<?php echo $tbl_guider->Code->editAttributes() ?>>
</span>
<input type="hidden" data-table="tbl_guider" data-field="x_Code" name="o<?php echo $tbl_guider_grid->RowIndex ?>_Code" id="o<?php echo $tbl_guider_grid->RowIndex ?>_Code" value="<?php echo HtmlEncode($tbl_guider->Code->OldValue) ?>">
<?php } ?>
<?php if ($tbl_guider->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $tbl_guider_grid->RowCnt ?>_tbl_guider_Code" class="form-group tbl_guider_Code">
<span<?php echo $tbl_guider->Code->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?php echo RemoveHtml($tbl_guider->Code->EditValue) ?>"></span>
</span>
<input type="hidden" data-table="tbl_guider" data-field="x_Code" name="x<?php echo $tbl_guider_grid->RowIndex ?>_Code" id="x<?php echo $tbl_guider_grid->RowIndex ?>_Code" value="<?php echo HtmlEncode($tbl_guider->Code->CurrentValue) ?>">
<?php } ?>
<?php if ($tbl_guider->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $tbl_guider_grid->RowCnt ?>_tbl_guider_Code" class="tbl_guider_Code">
<span<?php echo $tbl_guider->Code->viewAttributes() ?>>
<?php echo $tbl_guider->Code->getViewValue() ?></span>
</span>
<?php if (!$tbl_guider->isConfirm()) { ?>
<input type="hidden" data-table="tbl_guider" data-field="x_Code" name="x<?php echo $tbl_guider_grid->RowIndex ?>_Code" id="x<?php echo $tbl_guider_grid->RowIndex ?>_Code" value="<?php echo HtmlEncode($tbl_guider->Code->FormValue) ?>">
<input type="hidden" data-table="tbl_guider" data-field="x_Code" name="o<?php echo $tbl_guider_grid->RowIndex ?>_Code" id="o<?php echo $tbl_guider_grid->RowIndex ?>_Code" value="<?php echo HtmlEncode($tbl_guider->Code->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="tbl_guider" data-field="x_Code" name="ftbl_guidergrid$x<?php echo $tbl_guider_grid->RowIndex ?>_Code" id="ftbl_guidergrid$x<?php echo $tbl_guider_grid->RowIndex ?>_Code" value="<?php echo HtmlEncode($tbl_guider->Code->FormValue) ?>">
<input type="hidden" data-table="tbl_guider" data-field="x_Code" name="ftbl_guidergrid$o<?php echo $tbl_guider_grid->RowIndex ?>_Code" id="ftbl_guidergrid$o<?php echo $tbl_guider_grid->RowIndex ?>_Code" value="<?php echo HtmlEncode($tbl_guider->Code->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
<?php if ($tbl_guider->RowType == ROWTYPE_ADD) { // Add record ?>
<input type="hidden" data-table="tbl_guider" data-field="x_ID" name="x<?php echo $tbl_guider_grid->RowIndex ?>_ID" id="x<?php echo $tbl_guider_grid->RowIndex ?>_ID" value="<?php echo HtmlEncode($tbl_guider->ID->CurrentValue) ?>">
<input type="hidden" data-table="tbl_guider" data-field="x_ID" name="o<?php echo $tbl_guider_grid->RowIndex ?>_ID" id="o<?php echo $tbl_guider_grid->RowIndex ?>_ID" value="<?php echo HtmlEncode($tbl_guider->ID->OldValue) ?>">
<?php } ?>
<?php if ($tbl_guider->RowType == ROWTYPE_EDIT || $tbl_guider->CurrentMode == "edit") { ?>
<input type="hidden" data-table="tbl_guider" data-field="x_ID" name="x<?php echo $tbl_guider_grid->RowIndex ?>_ID" id="x<?php echo $tbl_guider_grid->RowIndex ?>_ID" value="<?php echo HtmlEncode($tbl_guider->ID->CurrentValue) ?>">
<?php } ?>
	<?php if ($tbl_guider->ProductName->Visible) { // ProductName ?>
		<td data-name="ProductName"<?php echo $tbl_guider->ProductName->cellAttributes() ?>>
<?php if ($tbl_guider->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $tbl_guider_grid->RowCnt ?>_tbl_guider_ProductName" class="form-group tbl_guider_ProductName">
<input type="text" data-table="tbl_guider" data-field="x_ProductName" name="x<?php echo $tbl_guider_grid->RowIndex ?>_ProductName" id="x<?php echo $tbl_guider_grid->RowIndex ?>_ProductName" size="100" maxlength="255" placeholder="<?php echo HtmlEncode($tbl_guider->ProductName->getPlaceHolder()) ?>" value="<?php echo $tbl_guider->ProductName->EditValue ?>"<?php echo $tbl_guider->ProductName->editAttributes() ?>>
</span>
<input type="hidden" data-table="tbl_guider" data-field="x_ProductName" name="o<?php echo $tbl_guider_grid->RowIndex ?>_ProductName" id="o<?php echo $tbl_guider_grid->RowIndex ?>_ProductName" value="<?php echo HtmlEncode($tbl_guider->ProductName->OldValue) ?>">
<?php } ?>
<?php if ($tbl_guider->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $tbl_guider_grid->RowCnt ?>_tbl_guider_ProductName" class="form-group tbl_guider_ProductName">
<span<?php echo $tbl_guider->ProductName->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?php echo RemoveHtml($tbl_guider->ProductName->EditValue) ?>"></span>
</span>
<input type="hidden" data-table="tbl_guider" data-field="x_ProductName" name="x<?php echo $tbl_guider_grid->RowIndex ?>_ProductName" id="x<?php echo $tbl_guider_grid->RowIndex ?>_ProductName" value="<?php echo HtmlEncode($tbl_guider->ProductName->CurrentValue) ?>">
<?php } ?>
<?php if ($tbl_guider->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $tbl_guider_grid->RowCnt ?>_tbl_guider_ProductName" class="tbl_guider_ProductName">
<span<?php echo $tbl_guider->ProductName->viewAttributes() ?>>
<?php echo $tbl_guider->ProductName->getViewValue() ?></span>
</span>
<?php if (!$tbl_guider->isConfirm()) { ?>
<input type="hidden" data-table="tbl_guider" data-field="x_ProductName" name="x<?php echo $tbl_guider_grid->RowIndex ?>_ProductName" id="x<?php echo $tbl_guider_grid->RowIndex ?>_ProductName" value="<?php echo HtmlEncode($tbl_guider->ProductName->FormValue) ?>">
<input type="hidden" data-table="tbl_guider" data-field="x_ProductName" name="o<?php echo $tbl_guider_grid->RowIndex ?>_ProductName" id="o<?php echo $tbl_guider_grid->RowIndex ?>_ProductName" value="<?php echo HtmlEncode($tbl_guider->ProductName->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="tbl_guider" data-field="x_ProductName" name="ftbl_guidergrid$x<?php echo $tbl_guider_grid->RowIndex ?>_ProductName" id="ftbl_guidergrid$x<?php echo $tbl_guider_grid->RowIndex ?>_ProductName" value="<?php echo HtmlEncode($tbl_guider->ProductName->FormValue) ?>">
<input type="hidden" data-table="tbl_guider" data-field="x_ProductName" name="ftbl_guidergrid$o<?php echo $tbl_guider_grid->RowIndex ?>_ProductName" id="ftbl_guidergrid$o<?php echo $tbl_guider_grid->RowIndex ?>_ProductName" value="<?php echo HtmlEncode($tbl_guider->ProductName->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($tbl_guider->PCS_Request->Visible) { // PCS_Request ?>
		<td data-name="PCS_Request"<?php echo $tbl_guider->PCS_Request->cellAttributes() ?>>
<?php if ($tbl_guider->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $tbl_guider_grid->RowCnt ?>_tbl_guider_PCS_Request" class="form-group tbl_guider_PCS_Request">
<input type="text" data-table="tbl_guider" data-field="x_PCS_Request" name="x<?php echo $tbl_guider_grid->RowIndex ?>_PCS_Request" id="x<?php echo $tbl_guider_grid->RowIndex ?>_PCS_Request" size="3" placeholder="<?php echo HtmlEncode($tbl_guider->PCS_Request->getPlaceHolder()) ?>" value="<?php echo $tbl_guider->PCS_Request->EditValue ?>"<?php echo $tbl_guider->PCS_Request->editAttributes() ?>>
</span>
<input type="hidden" data-table="tbl_guider" data-field="x_PCS_Request" name="o<?php echo $tbl_guider_grid->RowIndex ?>_PCS_Request" id="o<?php echo $tbl_guider_grid->RowIndex ?>_PCS_Request" value="<?php echo HtmlEncode($tbl_guider->PCS_Request->OldValue) ?>">
<?php } ?>
<?php if ($tbl_guider->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $tbl_guider_grid->RowCnt ?>_tbl_guider_PCS_Request" class="form-group tbl_guider_PCS_Request">
<span<?php echo $tbl_guider->PCS_Request->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?php echo RemoveHtml($tbl_guider->PCS_Request->EditValue) ?>"></span>
</span>
<input type="hidden" data-table="tbl_guider" data-field="x_PCS_Request" name="x<?php echo $tbl_guider_grid->RowIndex ?>_PCS_Request" id="x<?php echo $tbl_guider_grid->RowIndex ?>_PCS_Request" value="<?php echo HtmlEncode($tbl_guider->PCS_Request->CurrentValue) ?>">
<?php } ?>
<?php if ($tbl_guider->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $tbl_guider_grid->RowCnt ?>_tbl_guider_PCS_Request" class="tbl_guider_PCS_Request">
<span<?php echo $tbl_guider->PCS_Request->viewAttributes() ?>>
<?php echo $tbl_guider->PCS_Request->getViewValue() ?></span>
</span>
<?php if (!$tbl_guider->isConfirm()) { ?>
<input type="hidden" data-table="tbl_guider" data-field="x_PCS_Request" name="x<?php echo $tbl_guider_grid->RowIndex ?>_PCS_Request" id="x<?php echo $tbl_guider_grid->RowIndex ?>_PCS_Request" value="<?php echo HtmlEncode($tbl_guider->PCS_Request->FormValue) ?>">
<input type="hidden" data-table="tbl_guider" data-field="x_PCS_Request" name="o<?php echo $tbl_guider_grid->RowIndex ?>_PCS_Request" id="o<?php echo $tbl_guider_grid->RowIndex ?>_PCS_Request" value="<?php echo HtmlEncode($tbl_guider->PCS_Request->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="tbl_guider" data-field="x_PCS_Request" name="ftbl_guidergrid$x<?php echo $tbl_guider_grid->RowIndex ?>_PCS_Request" id="ftbl_guidergrid$x<?php echo $tbl_guider_grid->RowIndex ?>_PCS_Request" value="<?php echo HtmlEncode($tbl_guider->PCS_Request->FormValue) ?>">
<input type="hidden" data-table="tbl_guider" data-field="x_PCS_Request" name="ftbl_guidergrid$o<?php echo $tbl_guider_grid->RowIndex ?>_PCS_Request" id="ftbl_guidergrid$o<?php echo $tbl_guider_grid->RowIndex ?>_PCS_Request" value="<?php echo HtmlEncode($tbl_guider->PCS_Request->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($tbl_guider->ID_Location->Visible) { // ID_Location ?>
		<td data-name="ID_Location"<?php echo $tbl_guider->ID_Location->cellAttributes() ?>>
<?php if ($tbl_guider->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $tbl_guider_grid->RowCnt ?>_tbl_guider_ID_Location" class="form-group tbl_guider_ID_Location">
<?php
$wrkonchange = "" . trim(@$tbl_guider->ID_Location->EditAttrs["onchange"]);
if (trim($wrkonchange) <> "") $wrkonchange = " onchange=\"" . JsEncode($wrkonchange) . "\"";
$tbl_guider->ID_Location->EditAttrs["onchange"] = "";
?>
<span id="as_x<?php echo $tbl_guider_grid->RowIndex ?>_ID_Location" class="text-nowrap" style="z-index: <?php echo (9000 - $tbl_guider_grid->RowCnt * 10) ?>">
	<input type="text" class="form-control" name="sv_x<?php echo $tbl_guider_grid->RowIndex ?>_ID_Location" id="sv_x<?php echo $tbl_guider_grid->RowIndex ?>_ID_Location" value="<?php echo RemoveHtml($tbl_guider->ID_Location->EditValue) ?>" size="15" placeholder="<?php echo HtmlEncode($tbl_guider->ID_Location->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($tbl_guider->ID_Location->getPlaceHolder()) ?>"<?php echo $tbl_guider->ID_Location->editAttributes() ?>>
</span>
<input type="hidden" data-table="tbl_guider" data-field="x_ID_Location" data-value-separator="<?php echo $tbl_guider->ID_Location->displayValueSeparatorAttribute() ?>" name="x<?php echo $tbl_guider_grid->RowIndex ?>_ID_Location" id="x<?php echo $tbl_guider_grid->RowIndex ?>_ID_Location" value="<?php echo HtmlEncode($tbl_guider->ID_Location->CurrentValue) ?>"<?php echo $wrkonchange ?>>
<script>
ftbl_guidergrid.createAutoSuggest({"id":"x<?php echo $tbl_guider_grid->RowIndex ?>_ID_Location","forceSelect":true});
</script>
<?php echo $tbl_guider->ID_Location->Lookup->getParamTag("p_x" . $tbl_guider_grid->RowIndex . "_ID_Location") ?>
</span>
<input type="hidden" data-table="tbl_guider" data-field="x_ID_Location" name="o<?php echo $tbl_guider_grid->RowIndex ?>_ID_Location" id="o<?php echo $tbl_guider_grid->RowIndex ?>_ID_Location" value="<?php echo HtmlEncode($tbl_guider->ID_Location->OldValue) ?>">
<?php } ?>
<?php if ($tbl_guider->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $tbl_guider_grid->RowCnt ?>_tbl_guider_ID_Location" class="form-group tbl_guider_ID_Location">
<span<?php echo $tbl_guider->ID_Location->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?php echo RemoveHtml($tbl_guider->ID_Location->EditValue) ?>"></span>
</span>
<input type="hidden" data-table="tbl_guider" data-field="x_ID_Location" name="x<?php echo $tbl_guider_grid->RowIndex ?>_ID_Location" id="x<?php echo $tbl_guider_grid->RowIndex ?>_ID_Location" value="<?php echo HtmlEncode($tbl_guider->ID_Location->CurrentValue) ?>">
<?php } ?>
<?php if ($tbl_guider->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $tbl_guider_grid->RowCnt ?>_tbl_guider_ID_Location" class="tbl_guider_ID_Location">
<span<?php echo $tbl_guider->ID_Location->viewAttributes() ?>>
<?php echo $tbl_guider->ID_Location->getViewValue() ?></span>
</span>
<?php if (!$tbl_guider->isConfirm()) { ?>
<input type="hidden" data-table="tbl_guider" data-field="x_ID_Location" name="x<?php echo $tbl_guider_grid->RowIndex ?>_ID_Location" id="x<?php echo $tbl_guider_grid->RowIndex ?>_ID_Location" value="<?php echo HtmlEncode($tbl_guider->ID_Location->FormValue) ?>">
<input type="hidden" data-table="tbl_guider" data-field="x_ID_Location" name="o<?php echo $tbl_guider_grid->RowIndex ?>_ID_Location" id="o<?php echo $tbl_guider_grid->RowIndex ?>_ID_Location" value="<?php echo HtmlEncode($tbl_guider->ID_Location->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="tbl_guider" data-field="x_ID_Location" name="ftbl_guidergrid$x<?php echo $tbl_guider_grid->RowIndex ?>_ID_Location" id="ftbl_guidergrid$x<?php echo $tbl_guider_grid->RowIndex ?>_ID_Location" value="<?php echo HtmlEncode($tbl_guider->ID_Location->FormValue) ?>">
<input type="hidden" data-table="tbl_guider" data-field="x_ID_Location" name="ftbl_guidergrid$o<?php echo $tbl_guider_grid->RowIndex ?>_ID_Location" id="ftbl_guidergrid$o<?php echo $tbl_guider_grid->RowIndex ?>_ID_Location" value="<?php echo HtmlEncode($tbl_guider->ID_Location->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($tbl_guider->PCS_In->Visible) { // PCS_In ?>
		<td data-name="PCS_In"<?php echo $tbl_guider->PCS_In->cellAttributes() ?>>
<?php if ($tbl_guider->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $tbl_guider_grid->RowCnt ?>_tbl_guider_PCS_In" class="form-group tbl_guider_PCS_In">
<input type="text" data-table="tbl_guider" data-field="x_PCS_In" name="x<?php echo $tbl_guider_grid->RowIndex ?>_PCS_In" id="x<?php echo $tbl_guider_grid->RowIndex ?>_PCS_In" size="3" placeholder="<?php echo HtmlEncode($tbl_guider->PCS_In->getPlaceHolder()) ?>" value="<?php echo $tbl_guider->PCS_In->EditValue ?>"<?php echo $tbl_guider->PCS_In->editAttributes() ?>>
</span>
<input type="hidden" data-table="tbl_guider" data-field="x_PCS_In" name="o<?php echo $tbl_guider_grid->RowIndex ?>_PCS_In" id="o<?php echo $tbl_guider_grid->RowIndex ?>_PCS_In" value="<?php echo HtmlEncode($tbl_guider->PCS_In->OldValue) ?>">
<?php } ?>
<?php if ($tbl_guider->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $tbl_guider_grid->RowCnt ?>_tbl_guider_PCS_In" class="form-group tbl_guider_PCS_In">
<span<?php echo $tbl_guider->PCS_In->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?php echo RemoveHtml($tbl_guider->PCS_In->EditValue) ?>"></span>
</span>
<input type="hidden" data-table="tbl_guider" data-field="x_PCS_In" name="x<?php echo $tbl_guider_grid->RowIndex ?>_PCS_In" id="x<?php echo $tbl_guider_grid->RowIndex ?>_PCS_In" value="<?php echo HtmlEncode($tbl_guider->PCS_In->CurrentValue) ?>">
<?php } ?>
<?php if ($tbl_guider->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $tbl_guider_grid->RowCnt ?>_tbl_guider_PCS_In" class="tbl_guider_PCS_In">
<span<?php echo $tbl_guider->PCS_In->viewAttributes() ?>>
<?php echo $tbl_guider->PCS_In->getViewValue() ?></span>
</span>
<?php if (!$tbl_guider->isConfirm()) { ?>
<input type="hidden" data-table="tbl_guider" data-field="x_PCS_In" name="x<?php echo $tbl_guider_grid->RowIndex ?>_PCS_In" id="x<?php echo $tbl_guider_grid->RowIndex ?>_PCS_In" value="<?php echo HtmlEncode($tbl_guider->PCS_In->FormValue) ?>">
<input type="hidden" data-table="tbl_guider" data-field="x_PCS_In" name="o<?php echo $tbl_guider_grid->RowIndex ?>_PCS_In" id="o<?php echo $tbl_guider_grid->RowIndex ?>_PCS_In" value="<?php echo HtmlEncode($tbl_guider->PCS_In->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="tbl_guider" data-field="x_PCS_In" name="ftbl_guidergrid$x<?php echo $tbl_guider_grid->RowIndex ?>_PCS_In" id="ftbl_guidergrid$x<?php echo $tbl_guider_grid->RowIndex ?>_PCS_In" value="<?php echo HtmlEncode($tbl_guider->PCS_In->FormValue) ?>">
<input type="hidden" data-table="tbl_guider" data-field="x_PCS_In" name="ftbl_guidergrid$o<?php echo $tbl_guider_grid->RowIndex ?>_PCS_In" id="ftbl_guidergrid$o<?php echo $tbl_guider_grid->RowIndex ?>_PCS_In" value="<?php echo HtmlEncode($tbl_guider->PCS_In->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($tbl_guider->PCS->Visible) { // PCS ?>
		<td data-name="PCS"<?php echo $tbl_guider->PCS->cellAttributes() ?>>
<?php if ($tbl_guider->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $tbl_guider_grid->RowCnt ?>_tbl_guider_PCS" class="form-group tbl_guider_PCS">
<input type="text" data-table="tbl_guider" data-field="x_PCS" name="x<?php echo $tbl_guider_grid->RowIndex ?>_PCS" id="x<?php echo $tbl_guider_grid->RowIndex ?>_PCS" size="3" placeholder="<?php echo HtmlEncode($tbl_guider->PCS->getPlaceHolder()) ?>" value="<?php echo $tbl_guider->PCS->EditValue ?>"<?php echo $tbl_guider->PCS->editAttributes() ?>>
</span>
<input type="hidden" data-table="tbl_guider" data-field="x_PCS" name="o<?php echo $tbl_guider_grid->RowIndex ?>_PCS" id="o<?php echo $tbl_guider_grid->RowIndex ?>_PCS" value="<?php echo HtmlEncode($tbl_guider->PCS->OldValue) ?>">
<?php } ?>
<?php if ($tbl_guider->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $tbl_guider_grid->RowCnt ?>_tbl_guider_PCS" class="form-group tbl_guider_PCS">
<input type="text" data-table="tbl_guider" data-field="x_PCS" name="x<?php echo $tbl_guider_grid->RowIndex ?>_PCS" id="x<?php echo $tbl_guider_grid->RowIndex ?>_PCS" size="3" placeholder="<?php echo HtmlEncode($tbl_guider->PCS->getPlaceHolder()) ?>" value="<?php echo $tbl_guider->PCS->EditValue ?>"<?php echo $tbl_guider->PCS->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($tbl_guider->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $tbl_guider_grid->RowCnt ?>_tbl_guider_PCS" class="tbl_guider_PCS">
<span<?php echo $tbl_guider->PCS->viewAttributes() ?>>
<?php echo $tbl_guider->PCS->getViewValue() ?></span>
</span>
<?php if (!$tbl_guider->isConfirm()) { ?>
<input type="hidden" data-table="tbl_guider" data-field="x_PCS" name="x<?php echo $tbl_guider_grid->RowIndex ?>_PCS" id="x<?php echo $tbl_guider_grid->RowIndex ?>_PCS" value="<?php echo HtmlEncode($tbl_guider->PCS->FormValue) ?>">
<input type="hidden" data-table="tbl_guider" data-field="x_PCS" name="o<?php echo $tbl_guider_grid->RowIndex ?>_PCS" id="o<?php echo $tbl_guider_grid->RowIndex ?>_PCS" value="<?php echo HtmlEncode($tbl_guider->PCS->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="tbl_guider" data-field="x_PCS" name="ftbl_guidergrid$x<?php echo $tbl_guider_grid->RowIndex ?>_PCS" id="ftbl_guidergrid$x<?php echo $tbl_guider_grid->RowIndex ?>_PCS" value="<?php echo HtmlEncode($tbl_guider->PCS->FormValue) ?>">
<input type="hidden" data-table="tbl_guider" data-field="x_PCS" name="ftbl_guidergrid$o<?php echo $tbl_guider_grid->RowIndex ?>_PCS" id="ftbl_guidergrid$o<?php echo $tbl_guider_grid->RowIndex ?>_PCS" value="<?php echo HtmlEncode($tbl_guider->PCS->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($tbl_guider->PalletID->Visible) { // PalletID ?>
		<td data-name="PalletID"<?php echo $tbl_guider->PalletID->cellAttributes() ?>>
<?php if ($tbl_guider->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $tbl_guider_grid->RowCnt ?>_tbl_guider_PalletID" class="form-group tbl_guider_PalletID">
<input type="text" data-table="tbl_guider" data-field="x_PalletID" name="x<?php echo $tbl_guider_grid->RowIndex ?>_PalletID" id="x<?php echo $tbl_guider_grid->RowIndex ?>_PalletID" size="15" placeholder="<?php echo HtmlEncode($tbl_guider->PalletID->getPlaceHolder()) ?>" value="<?php echo $tbl_guider->PalletID->EditValue ?>"<?php echo $tbl_guider->PalletID->editAttributes() ?>>
</span>
<input type="hidden" data-table="tbl_guider" data-field="x_PalletID" name="o<?php echo $tbl_guider_grid->RowIndex ?>_PalletID" id="o<?php echo $tbl_guider_grid->RowIndex ?>_PalletID" value="<?php echo HtmlEncode($tbl_guider->PalletID->OldValue) ?>">
<?php } ?>
<?php if ($tbl_guider->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $tbl_guider_grid->RowCnt ?>_tbl_guider_PalletID" class="form-group tbl_guider_PalletID">
<span<?php echo $tbl_guider->PalletID->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?php echo RemoveHtml($tbl_guider->PalletID->EditValue) ?>"></span>
</span>
<input type="hidden" data-table="tbl_guider" data-field="x_PalletID" name="x<?php echo $tbl_guider_grid->RowIndex ?>_PalletID" id="x<?php echo $tbl_guider_grid->RowIndex ?>_PalletID" value="<?php echo HtmlEncode($tbl_guider->PalletID->CurrentValue) ?>">
<?php } ?>
<?php if ($tbl_guider->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $tbl_guider_grid->RowCnt ?>_tbl_guider_PalletID" class="tbl_guider_PalletID">
<span<?php echo $tbl_guider->PalletID->viewAttributes() ?>>
<?php echo $tbl_guider->PalletID->getViewValue() ?></span>
</span>
<?php if (!$tbl_guider->isConfirm()) { ?>
<input type="hidden" data-table="tbl_guider" data-field="x_PalletID" name="x<?php echo $tbl_guider_grid->RowIndex ?>_PalletID" id="x<?php echo $tbl_guider_grid->RowIndex ?>_PalletID" value="<?php echo HtmlEncode($tbl_guider->PalletID->FormValue) ?>">
<input type="hidden" data-table="tbl_guider" data-field="x_PalletID" name="o<?php echo $tbl_guider_grid->RowIndex ?>_PalletID" id="o<?php echo $tbl_guider_grid->RowIndex ?>_PalletID" value="<?php echo HtmlEncode($tbl_guider->PalletID->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="tbl_guider" data-field="x_PalletID" name="ftbl_guidergrid$x<?php echo $tbl_guider_grid->RowIndex ?>_PalletID" id="ftbl_guidergrid$x<?php echo $tbl_guider_grid->RowIndex ?>_PalletID" value="<?php echo HtmlEncode($tbl_guider->PalletID->FormValue) ?>">
<input type="hidden" data-table="tbl_guider" data-field="x_PalletID" name="ftbl_guidergrid$o<?php echo $tbl_guider_grid->RowIndex ?>_PalletID" id="ftbl_guidergrid$o<?php echo $tbl_guider_grid->RowIndex ?>_PalletID" value="<?php echo HtmlEncode($tbl_guider->PalletID->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($tbl_guider->DateIn->Visible) { // DateIn ?>
		<td data-name="DateIn"<?php echo $tbl_guider->DateIn->cellAttributes() ?>>
<?php if ($tbl_guider->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $tbl_guider_grid->RowCnt ?>_tbl_guider_DateIn" class="form-group tbl_guider_DateIn">
<input type="text" data-table="tbl_guider" data-field="x_DateIn" data-format="11" name="x<?php echo $tbl_guider_grid->RowIndex ?>_DateIn" id="x<?php echo $tbl_guider_grid->RowIndex ?>_DateIn" placeholder="<?php echo HtmlEncode($tbl_guider->DateIn->getPlaceHolder()) ?>" value="<?php echo $tbl_guider->DateIn->EditValue ?>"<?php echo $tbl_guider->DateIn->editAttributes() ?>>
</span>
<input type="hidden" data-table="tbl_guider" data-field="x_DateIn" name="o<?php echo $tbl_guider_grid->RowIndex ?>_DateIn" id="o<?php echo $tbl_guider_grid->RowIndex ?>_DateIn" value="<?php echo HtmlEncode($tbl_guider->DateIn->OldValue) ?>">
<?php } ?>
<?php if ($tbl_guider->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $tbl_guider_grid->RowCnt ?>_tbl_guider_DateIn" class="form-group tbl_guider_DateIn">
<span<?php echo $tbl_guider->DateIn->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?php echo RemoveHtml($tbl_guider->DateIn->EditValue) ?>"></span>
</span>
<input type="hidden" data-table="tbl_guider" data-field="x_DateIn" name="x<?php echo $tbl_guider_grid->RowIndex ?>_DateIn" id="x<?php echo $tbl_guider_grid->RowIndex ?>_DateIn" value="<?php echo HtmlEncode($tbl_guider->DateIn->CurrentValue) ?>">
<?php } ?>
<?php if ($tbl_guider->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $tbl_guider_grid->RowCnt ?>_tbl_guider_DateIn" class="tbl_guider_DateIn">
<span<?php echo $tbl_guider->DateIn->viewAttributes() ?>>
<?php echo $tbl_guider->DateIn->getViewValue() ?></span>
</span>
<?php if (!$tbl_guider->isConfirm()) { ?>
<input type="hidden" data-table="tbl_guider" data-field="x_DateIn" name="x<?php echo $tbl_guider_grid->RowIndex ?>_DateIn" id="x<?php echo $tbl_guider_grid->RowIndex ?>_DateIn" value="<?php echo HtmlEncode($tbl_guider->DateIn->FormValue) ?>">
<input type="hidden" data-table="tbl_guider" data-field="x_DateIn" name="o<?php echo $tbl_guider_grid->RowIndex ?>_DateIn" id="o<?php echo $tbl_guider_grid->RowIndex ?>_DateIn" value="<?php echo HtmlEncode($tbl_guider->DateIn->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="tbl_guider" data-field="x_DateIn" name="ftbl_guidergrid$x<?php echo $tbl_guider_grid->RowIndex ?>_DateIn" id="ftbl_guidergrid$x<?php echo $tbl_guider_grid->RowIndex ?>_DateIn" value="<?php echo HtmlEncode($tbl_guider->DateIn->FormValue) ?>">
<input type="hidden" data-table="tbl_guider" data-field="x_DateIn" name="ftbl_guidergrid$o<?php echo $tbl_guider_grid->RowIndex ?>_DateIn" id="ftbl_guidergrid$o<?php echo $tbl_guider_grid->RowIndex ?>_DateIn" value="<?php echo HtmlEncode($tbl_guider->DateIn->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$tbl_guider_grid->ListOptions->render("body", "right", $tbl_guider_grid->RowCnt);
?>
	</tr>
<?php if ($tbl_guider->RowType == ROWTYPE_ADD || $tbl_guider->RowType == ROWTYPE_EDIT) { ?>
<script>
ftbl_guidergrid.updateLists(<?php echo $tbl_guider_grid->RowIndex ?>);
</script>
<?php } ?>
<?php
	}
	} // End delete row checking
	if (!$tbl_guider->isGridAdd() || $tbl_guider->CurrentMode == "copy")
		if (!$tbl_guider_grid->Recordset->EOF)
			$tbl_guider_grid->Recordset->moveNext();
}
?>
<?php
	if ($tbl_guider->CurrentMode == "add" || $tbl_guider->CurrentMode == "copy" || $tbl_guider->CurrentMode == "edit") {
		$tbl_guider_grid->RowIndex = '$rowindex$';
		$tbl_guider_grid->loadRowValues();

		// Set row properties
		$tbl_guider->resetAttributes();
		$tbl_guider->RowAttrs = array_merge($tbl_guider->RowAttrs, array('data-rowindex'=>$tbl_guider_grid->RowIndex, 'id'=>'r0_tbl_guider', 'data-rowtype'=>ROWTYPE_ADD));
		AppendClass($tbl_guider->RowAttrs["class"], "ew-template");
		$tbl_guider->RowType = ROWTYPE_ADD;

		// Render row
		$tbl_guider_grid->renderRow();

		// Render list options
		$tbl_guider_grid->renderListOptions();
		$tbl_guider_grid->StartRowCnt = 0;
?>
	<tr<?php echo $tbl_guider->rowAttributes() ?>>
<?php

// Render list options (body, left)
$tbl_guider_grid->ListOptions->render("body", "left", $tbl_guider_grid->RowIndex);
?>
	<?php if ($tbl_guider->Code->Visible) { // Code ?>
		<td data-name="Code">
<?php if (!$tbl_guider->isConfirm()) { ?>
<span id="el$rowindex$_tbl_guider_Code" class="form-group tbl_guider_Code">
<input type="text" data-table="tbl_guider" data-field="x_Code" name="x<?php echo $tbl_guider_grid->RowIndex ?>_Code" id="x<?php echo $tbl_guider_grid->RowIndex ?>_Code" size="30" maxlength="50" placeholder="<?php echo HtmlEncode($tbl_guider->Code->getPlaceHolder()) ?>" value="<?php echo $tbl_guider->Code->EditValue ?>"<?php echo $tbl_guider->Code->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_tbl_guider_Code" class="form-group tbl_guider_Code">
<span<?php echo $tbl_guider->Code->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?php echo RemoveHtml($tbl_guider->Code->ViewValue) ?>"></span>
</span>
<input type="hidden" data-table="tbl_guider" data-field="x_Code" name="x<?php echo $tbl_guider_grid->RowIndex ?>_Code" id="x<?php echo $tbl_guider_grid->RowIndex ?>_Code" value="<?php echo HtmlEncode($tbl_guider->Code->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="tbl_guider" data-field="x_Code" name="o<?php echo $tbl_guider_grid->RowIndex ?>_Code" id="o<?php echo $tbl_guider_grid->RowIndex ?>_Code" value="<?php echo HtmlEncode($tbl_guider->Code->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($tbl_guider->ProductName->Visible) { // ProductName ?>
		<td data-name="ProductName">
<?php if (!$tbl_guider->isConfirm()) { ?>
<span id="el$rowindex$_tbl_guider_ProductName" class="form-group tbl_guider_ProductName">
<input type="text" data-table="tbl_guider" data-field="x_ProductName" name="x<?php echo $tbl_guider_grid->RowIndex ?>_ProductName" id="x<?php echo $tbl_guider_grid->RowIndex ?>_ProductName" size="100" maxlength="255" placeholder="<?php echo HtmlEncode($tbl_guider->ProductName->getPlaceHolder()) ?>" value="<?php echo $tbl_guider->ProductName->EditValue ?>"<?php echo $tbl_guider->ProductName->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_tbl_guider_ProductName" class="form-group tbl_guider_ProductName">
<span<?php echo $tbl_guider->ProductName->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?php echo RemoveHtml($tbl_guider->ProductName->ViewValue) ?>"></span>
</span>
<input type="hidden" data-table="tbl_guider" data-field="x_ProductName" name="x<?php echo $tbl_guider_grid->RowIndex ?>_ProductName" id="x<?php echo $tbl_guider_grid->RowIndex ?>_ProductName" value="<?php echo HtmlEncode($tbl_guider->ProductName->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="tbl_guider" data-field="x_ProductName" name="o<?php echo $tbl_guider_grid->RowIndex ?>_ProductName" id="o<?php echo $tbl_guider_grid->RowIndex ?>_ProductName" value="<?php echo HtmlEncode($tbl_guider->ProductName->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($tbl_guider->PCS_Request->Visible) { // PCS_Request ?>
		<td data-name="PCS_Request">
<?php if (!$tbl_guider->isConfirm()) { ?>
<span id="el$rowindex$_tbl_guider_PCS_Request" class="form-group tbl_guider_PCS_Request">
<input type="text" data-table="tbl_guider" data-field="x_PCS_Request" name="x<?php echo $tbl_guider_grid->RowIndex ?>_PCS_Request" id="x<?php echo $tbl_guider_grid->RowIndex ?>_PCS_Request" size="3" placeholder="<?php echo HtmlEncode($tbl_guider->PCS_Request->getPlaceHolder()) ?>" value="<?php echo $tbl_guider->PCS_Request->EditValue ?>"<?php echo $tbl_guider->PCS_Request->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_tbl_guider_PCS_Request" class="form-group tbl_guider_PCS_Request">
<span<?php echo $tbl_guider->PCS_Request->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?php echo RemoveHtml($tbl_guider->PCS_Request->ViewValue) ?>"></span>
</span>
<input type="hidden" data-table="tbl_guider" data-field="x_PCS_Request" name="x<?php echo $tbl_guider_grid->RowIndex ?>_PCS_Request" id="x<?php echo $tbl_guider_grid->RowIndex ?>_PCS_Request" value="<?php echo HtmlEncode($tbl_guider->PCS_Request->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="tbl_guider" data-field="x_PCS_Request" name="o<?php echo $tbl_guider_grid->RowIndex ?>_PCS_Request" id="o<?php echo $tbl_guider_grid->RowIndex ?>_PCS_Request" value="<?php echo HtmlEncode($tbl_guider->PCS_Request->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($tbl_guider->ID_Location->Visible) { // ID_Location ?>
		<td data-name="ID_Location">
<?php if (!$tbl_guider->isConfirm()) { ?>
<span id="el$rowindex$_tbl_guider_ID_Location" class="form-group tbl_guider_ID_Location">
<?php
$wrkonchange = "" . trim(@$tbl_guider->ID_Location->EditAttrs["onchange"]);
if (trim($wrkonchange) <> "") $wrkonchange = " onchange=\"" . JsEncode($wrkonchange) . "\"";
$tbl_guider->ID_Location->EditAttrs["onchange"] = "";
?>
<span id="as_x<?php echo $tbl_guider_grid->RowIndex ?>_ID_Location" class="text-nowrap" style="z-index: <?php echo (9000 - $tbl_guider_grid->RowCnt * 10) ?>">
	<input type="text" class="form-control" name="sv_x<?php echo $tbl_guider_grid->RowIndex ?>_ID_Location" id="sv_x<?php echo $tbl_guider_grid->RowIndex ?>_ID_Location" value="<?php echo RemoveHtml($tbl_guider->ID_Location->EditValue) ?>" size="15" placeholder="<?php echo HtmlEncode($tbl_guider->ID_Location->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($tbl_guider->ID_Location->getPlaceHolder()) ?>"<?php echo $tbl_guider->ID_Location->editAttributes() ?>>
</span>
<input type="hidden" data-table="tbl_guider" data-field="x_ID_Location" data-value-separator="<?php echo $tbl_guider->ID_Location->displayValueSeparatorAttribute() ?>" name="x<?php echo $tbl_guider_grid->RowIndex ?>_ID_Location" id="x<?php echo $tbl_guider_grid->RowIndex ?>_ID_Location" value="<?php echo HtmlEncode($tbl_guider->ID_Location->CurrentValue) ?>"<?php echo $wrkonchange ?>>
<script>
ftbl_guidergrid.createAutoSuggest({"id":"x<?php echo $tbl_guider_grid->RowIndex ?>_ID_Location","forceSelect":true});
</script>
<?php echo $tbl_guider->ID_Location->Lookup->getParamTag("p_x" . $tbl_guider_grid->RowIndex . "_ID_Location") ?>
</span>
<?php } else { ?>
<span id="el$rowindex$_tbl_guider_ID_Location" class="form-group tbl_guider_ID_Location">
<span<?php echo $tbl_guider->ID_Location->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?php echo RemoveHtml($tbl_guider->ID_Location->ViewValue) ?>"></span>
</span>
<input type="hidden" data-table="tbl_guider" data-field="x_ID_Location" name="x<?php echo $tbl_guider_grid->RowIndex ?>_ID_Location" id="x<?php echo $tbl_guider_grid->RowIndex ?>_ID_Location" value="<?php echo HtmlEncode($tbl_guider->ID_Location->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="tbl_guider" data-field="x_ID_Location" name="o<?php echo $tbl_guider_grid->RowIndex ?>_ID_Location" id="o<?php echo $tbl_guider_grid->RowIndex ?>_ID_Location" value="<?php echo HtmlEncode($tbl_guider->ID_Location->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($tbl_guider->PCS_In->Visible) { // PCS_In ?>
		<td data-name="PCS_In">
<?php if (!$tbl_guider->isConfirm()) { ?>
<span id="el$rowindex$_tbl_guider_PCS_In" class="form-group tbl_guider_PCS_In">
<input type="text" data-table="tbl_guider" data-field="x_PCS_In" name="x<?php echo $tbl_guider_grid->RowIndex ?>_PCS_In" id="x<?php echo $tbl_guider_grid->RowIndex ?>_PCS_In" size="3" placeholder="<?php echo HtmlEncode($tbl_guider->PCS_In->getPlaceHolder()) ?>" value="<?php echo $tbl_guider->PCS_In->EditValue ?>"<?php echo $tbl_guider->PCS_In->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_tbl_guider_PCS_In" class="form-group tbl_guider_PCS_In">
<span<?php echo $tbl_guider->PCS_In->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?php echo RemoveHtml($tbl_guider->PCS_In->ViewValue) ?>"></span>
</span>
<input type="hidden" data-table="tbl_guider" data-field="x_PCS_In" name="x<?php echo $tbl_guider_grid->RowIndex ?>_PCS_In" id="x<?php echo $tbl_guider_grid->RowIndex ?>_PCS_In" value="<?php echo HtmlEncode($tbl_guider->PCS_In->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="tbl_guider" data-field="x_PCS_In" name="o<?php echo $tbl_guider_grid->RowIndex ?>_PCS_In" id="o<?php echo $tbl_guider_grid->RowIndex ?>_PCS_In" value="<?php echo HtmlEncode($tbl_guider->PCS_In->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($tbl_guider->PCS->Visible) { // PCS ?>
		<td data-name="PCS">
<?php if (!$tbl_guider->isConfirm()) { ?>
<span id="el$rowindex$_tbl_guider_PCS" class="form-group tbl_guider_PCS">
<input type="text" data-table="tbl_guider" data-field="x_PCS" name="x<?php echo $tbl_guider_grid->RowIndex ?>_PCS" id="x<?php echo $tbl_guider_grid->RowIndex ?>_PCS" size="3" placeholder="<?php echo HtmlEncode($tbl_guider->PCS->getPlaceHolder()) ?>" value="<?php echo $tbl_guider->PCS->EditValue ?>"<?php echo $tbl_guider->PCS->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_tbl_guider_PCS" class="form-group tbl_guider_PCS">
<span<?php echo $tbl_guider->PCS->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?php echo RemoveHtml($tbl_guider->PCS->ViewValue) ?>"></span>
</span>
<input type="hidden" data-table="tbl_guider" data-field="x_PCS" name="x<?php echo $tbl_guider_grid->RowIndex ?>_PCS" id="x<?php echo $tbl_guider_grid->RowIndex ?>_PCS" value="<?php echo HtmlEncode($tbl_guider->PCS->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="tbl_guider" data-field="x_PCS" name="o<?php echo $tbl_guider_grid->RowIndex ?>_PCS" id="o<?php echo $tbl_guider_grid->RowIndex ?>_PCS" value="<?php echo HtmlEncode($tbl_guider->PCS->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($tbl_guider->PalletID->Visible) { // PalletID ?>
		<td data-name="PalletID">
<?php if (!$tbl_guider->isConfirm()) { ?>
<span id="el$rowindex$_tbl_guider_PalletID" class="form-group tbl_guider_PalletID">
<input type="text" data-table="tbl_guider" data-field="x_PalletID" name="x<?php echo $tbl_guider_grid->RowIndex ?>_PalletID" id="x<?php echo $tbl_guider_grid->RowIndex ?>_PalletID" size="15" placeholder="<?php echo HtmlEncode($tbl_guider->PalletID->getPlaceHolder()) ?>" value="<?php echo $tbl_guider->PalletID->EditValue ?>"<?php echo $tbl_guider->PalletID->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_tbl_guider_PalletID" class="form-group tbl_guider_PalletID">
<span<?php echo $tbl_guider->PalletID->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?php echo RemoveHtml($tbl_guider->PalletID->ViewValue) ?>"></span>
</span>
<input type="hidden" data-table="tbl_guider" data-field="x_PalletID" name="x<?php echo $tbl_guider_grid->RowIndex ?>_PalletID" id="x<?php echo $tbl_guider_grid->RowIndex ?>_PalletID" value="<?php echo HtmlEncode($tbl_guider->PalletID->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="tbl_guider" data-field="x_PalletID" name="o<?php echo $tbl_guider_grid->RowIndex ?>_PalletID" id="o<?php echo $tbl_guider_grid->RowIndex ?>_PalletID" value="<?php echo HtmlEncode($tbl_guider->PalletID->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($tbl_guider->DateIn->Visible) { // DateIn ?>
		<td data-name="DateIn">
<?php if (!$tbl_guider->isConfirm()) { ?>
<span id="el$rowindex$_tbl_guider_DateIn" class="form-group tbl_guider_DateIn">
<input type="text" data-table="tbl_guider" data-field="x_DateIn" data-format="11" name="x<?php echo $tbl_guider_grid->RowIndex ?>_DateIn" id="x<?php echo $tbl_guider_grid->RowIndex ?>_DateIn" placeholder="<?php echo HtmlEncode($tbl_guider->DateIn->getPlaceHolder()) ?>" value="<?php echo $tbl_guider->DateIn->EditValue ?>"<?php echo $tbl_guider->DateIn->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_tbl_guider_DateIn" class="form-group tbl_guider_DateIn">
<span<?php echo $tbl_guider->DateIn->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?php echo RemoveHtml($tbl_guider->DateIn->ViewValue) ?>"></span>
</span>
<input type="hidden" data-table="tbl_guider" data-field="x_DateIn" name="x<?php echo $tbl_guider_grid->RowIndex ?>_DateIn" id="x<?php echo $tbl_guider_grid->RowIndex ?>_DateIn" value="<?php echo HtmlEncode($tbl_guider->DateIn->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="tbl_guider" data-field="x_DateIn" name="o<?php echo $tbl_guider_grid->RowIndex ?>_DateIn" id="o<?php echo $tbl_guider_grid->RowIndex ?>_DateIn" value="<?php echo HtmlEncode($tbl_guider->DateIn->OldValue) ?>">
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$tbl_guider_grid->ListOptions->render("body", "right", $tbl_guider_grid->RowIndex);
?>
<script>
ftbl_guidergrid.updateLists(<?php echo $tbl_guider_grid->RowIndex ?>);
</script>
	</tr>
<?php
}
?>
</tbody>
</table><!-- /.ew-table -->
<?php if ($tbl_guider->CurrentMode == "add" || $tbl_guider->CurrentMode == "copy") { ?>
<input type="hidden" name="<?php echo $tbl_guider_grid->FormKeyCountName ?>" id="<?php echo $tbl_guider_grid->FormKeyCountName ?>" value="<?php echo $tbl_guider_grid->KeyCount ?>">
<?php echo $tbl_guider_grid->MultiSelectKey ?>
<?php } ?>
<?php if ($tbl_guider->CurrentMode == "edit") { ?>
<input type="hidden" name="<?php echo $tbl_guider_grid->FormKeyCountName ?>" id="<?php echo $tbl_guider_grid->FormKeyCountName ?>" value="<?php echo $tbl_guider_grid->KeyCount ?>">
<?php echo $tbl_guider_grid->MultiSelectKey ?>
<?php } ?>
<?php if ($tbl_guider->CurrentMode == "") { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
<input type="hidden" name="detailpage" value="ftbl_guidergrid">
</div><!-- /.ew-grid-middle-panel -->
<?php

// Close recordset
if ($tbl_guider_grid->Recordset)
	$tbl_guider_grid->Recordset->Close();
?>
</div>
<?php if ($tbl_guider_grid->ShowOtherOptions) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php $tbl_guider_grid->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($tbl_guider_grid->TotalRecs == 0 && !$tbl_guider->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $tbl_guider_grid->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$tbl_guider_grid->terminate();
?>