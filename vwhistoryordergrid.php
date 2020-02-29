<?php
namespace PHPMaker2019\asgbn_wh;

// Write header
WriteHeader(FALSE);

// Create page object
if (!isset($vwhistoryorder_grid))
	$vwhistoryorder_grid = new vwhistoryorder_grid();

// Run the page
$vwhistoryorder_grid->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$vwhistoryorder_grid->Page_Render();
?>
<?php if (!$vwhistoryorder->isExport()) { ?>
<script>

// Form object
var fvwhistoryordergrid = new ew.Form("fvwhistoryordergrid", "grid");
fvwhistoryordergrid.formKeyCountName = '<?php echo $vwhistoryorder_grid->FormKeyCountName ?>';

// Validate form
fvwhistoryordergrid.validate = function() {
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
		<?php if ($vwhistoryorder_grid->PalletID->Required) { ?>
			elm = this.getElements("x" + infix + "_PalletID");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $vwhistoryorder->PalletID->caption(), $vwhistoryorder->PalletID->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($vwhistoryorder_grid->Code->Required) { ?>
			elm = this.getElements("x" + infix + "_Code");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $vwhistoryorder->Code->caption(), $vwhistoryorder->Code->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($vwhistoryorder_grid->ProductName->Required) { ?>
			elm = this.getElements("x" + infix + "_ProductName");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $vwhistoryorder->ProductName->caption(), $vwhistoryorder->ProductName->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($vwhistoryorder_grid->PCS_Out->Required) { ?>
			elm = this.getElements("x" + infix + "_PCS_Out");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $vwhistoryorder->PCS_Out->caption(), $vwhistoryorder->PCS_Out->RequiredErrorMessage)) ?>");
		<?php } ?>
			elm = this.getElements("x" + infix + "_PCS_Out");
			if (elm && !ew.checkInteger(elm.value))
				return this.onError(elm, "<?php echo JsEncode($vwhistoryorder->PCS_Out->errorMessage()) ?>");
		<?php if ($vwhistoryorder_grid->DateIn->Required) { ?>
			elm = this.getElements("x" + infix + "_DateIn");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $vwhistoryorder->DateIn->caption(), $vwhistoryorder->DateIn->RequiredErrorMessage)) ?>");
		<?php } ?>
			elm = this.getElements("x" + infix + "_DateIn");
			if (elm && !ew.checkEuroDate(elm.value))
				return this.onError(elm, "<?php echo JsEncode($vwhistoryorder->DateIn->errorMessage()) ?>");
		<?php if ($vwhistoryorder_grid->DateOut->Required) { ?>
			elm = this.getElements("x" + infix + "_DateOut");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $vwhistoryorder->DateOut->caption(), $vwhistoryorder->DateOut->RequiredErrorMessage)) ?>");
		<?php } ?>
			elm = this.getElements("x" + infix + "_DateOut");
			if (elm && !ew.checkEuroDate(elm.value))
				return this.onError(elm, "<?php echo JsEncode($vwhistoryorder->DateOut->errorMessage()) ?>");
		<?php if ($vwhistoryorder_grid->PalletStatus->Required) { ?>
			elm = this.getElements("x" + infix + "_PalletStatus");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $vwhistoryorder->PalletStatus->caption(), $vwhistoryorder->PalletStatus->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($vwhistoryorder_grid->CreateUser->Required) { ?>
			elm = this.getElements("x" + infix + "_CreateUser");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $vwhistoryorder->CreateUser->caption(), $vwhistoryorder->CreateUser->RequiredErrorMessage)) ?>");
		<?php } ?>

			// Fire Form_CustomValidate event
			if (!this.Form_CustomValidate(fobj))
				return false;
		} // End Grid Add checking
	}
	return true;
}

// Check empty row
fvwhistoryordergrid.emptyRow = function(infix) {
	var fobj = this._form;
	if (ew.valueChanged(fobj, infix, "PalletID", false)) return false;
	if (ew.valueChanged(fobj, infix, "Code", false)) return false;
	if (ew.valueChanged(fobj, infix, "ProductName", false)) return false;
	if (ew.valueChanged(fobj, infix, "PCS_Out", false)) return false;
	if (ew.valueChanged(fobj, infix, "DateIn", false)) return false;
	if (ew.valueChanged(fobj, infix, "DateOut", false)) return false;
	if (ew.valueChanged(fobj, infix, "PalletStatus", false)) return false;
	if (ew.valueChanged(fobj, infix, "CreateUser", false)) return false;
	return true;
}

// Form_CustomValidate event
fvwhistoryordergrid.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

	// Your custom validation code here, return false if invalid.
	return true;
}

// Use JavaScript validation or not
fvwhistoryordergrid.validateRequired = <?php echo json_encode(CLIENT_VALIDATE) ?>;

// Dynamic selection lists
// Form object for search

</script>
<?php } ?>
<?php
$vwhistoryorder_grid->renderOtherOptions();
?>
<?php $vwhistoryorder_grid->showPageHeader(); ?>
<?php
$vwhistoryorder_grid->showMessage();
?>
<?php if ($vwhistoryorder_grid->TotalRecs > 0 || $vwhistoryorder->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($vwhistoryorder_grid->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> vwhistoryorder">
<?php if ($vwhistoryorder_grid->ShowOtherOptions) { ?>
<div class="card-header ew-grid-upper-panel">
<?php $vwhistoryorder_grid->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<div id="fvwhistoryordergrid" class="ew-form ew-list-form form-inline">
<div id="gmp_vwhistoryorder" class="<?php if (IsResponsiveLayout()) { ?>table-responsive <?php } ?>card-body ew-grid-middle-panel">
<table id="tbl_vwhistoryordergrid" class="table ew-table"><!-- .ew-table ##-->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$vwhistoryorder_grid->RowType = ROWTYPE_HEADER;

// Render list options
$vwhistoryorder_grid->renderListOptions();

// Render list options (header, left)
$vwhistoryorder_grid->ListOptions->render("header", "left");
?>
<?php if ($vwhistoryorder->PalletID->Visible) { // PalletID ?>
	<?php if ($vwhistoryorder->sortUrl($vwhistoryorder->PalletID) == "") { ?>
		<th data-name="PalletID" class="<?php echo $vwhistoryorder->PalletID->headerCellClass() ?>" style="white-space: nowrap;"><div id="elh_vwhistoryorder_PalletID" class="vwhistoryorder_PalletID"><div class="ew-table-header-caption"><?php echo $vwhistoryorder->PalletID->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="PalletID" class="<?php echo $vwhistoryorder->PalletID->headerCellClass() ?>" style="white-space: nowrap;"><div><div id="elh_vwhistoryorder_PalletID" class="vwhistoryorder_PalletID">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $vwhistoryorder->PalletID->caption() ?></span><span class="ew-table-header-sort"><?php if ($vwhistoryorder->PalletID->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($vwhistoryorder->PalletID->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($vwhistoryorder->Code->Visible) { // Code ?>
	<?php if ($vwhistoryorder->sortUrl($vwhistoryorder->Code) == "") { ?>
		<th data-name="Code" class="<?php echo $vwhistoryorder->Code->headerCellClass() ?>" style="white-space: nowrap;"><div id="elh_vwhistoryorder_Code" class="vwhistoryorder_Code"><div class="ew-table-header-caption"><?php echo $vwhistoryorder->Code->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Code" class="<?php echo $vwhistoryorder->Code->headerCellClass() ?>" style="white-space: nowrap;"><div><div id="elh_vwhistoryorder_Code" class="vwhistoryorder_Code">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $vwhistoryorder->Code->caption() ?></span><span class="ew-table-header-sort"><?php if ($vwhistoryorder->Code->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($vwhistoryorder->Code->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($vwhistoryorder->ProductName->Visible) { // ProductName ?>
	<?php if ($vwhistoryorder->sortUrl($vwhistoryorder->ProductName) == "") { ?>
		<th data-name="ProductName" class="<?php echo $vwhistoryorder->ProductName->headerCellClass() ?>" style="white-space: nowrap;"><div id="elh_vwhistoryorder_ProductName" class="vwhistoryorder_ProductName"><div class="ew-table-header-caption"><?php echo $vwhistoryorder->ProductName->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="ProductName" class="<?php echo $vwhistoryorder->ProductName->headerCellClass() ?>" style="white-space: nowrap;"><div><div id="elh_vwhistoryorder_ProductName" class="vwhistoryorder_ProductName">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $vwhistoryorder->ProductName->caption() ?></span><span class="ew-table-header-sort"><?php if ($vwhistoryorder->ProductName->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($vwhistoryorder->ProductName->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($vwhistoryorder->PCS_Out->Visible) { // PCS_Out ?>
	<?php if ($vwhistoryorder->sortUrl($vwhistoryorder->PCS_Out) == "") { ?>
		<th data-name="PCS_Out" class="<?php echo $vwhistoryorder->PCS_Out->headerCellClass() ?>" style="white-space: nowrap;"><div id="elh_vwhistoryorder_PCS_Out" class="vwhistoryorder_PCS_Out"><div class="ew-table-header-caption"><?php echo $vwhistoryorder->PCS_Out->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="PCS_Out" class="<?php echo $vwhistoryorder->PCS_Out->headerCellClass() ?>" style="white-space: nowrap;"><div><div id="elh_vwhistoryorder_PCS_Out" class="vwhistoryorder_PCS_Out">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $vwhistoryorder->PCS_Out->caption() ?></span><span class="ew-table-header-sort"><?php if ($vwhistoryorder->PCS_Out->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($vwhistoryorder->PCS_Out->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($vwhistoryorder->DateIn->Visible) { // DateIn ?>
	<?php if ($vwhistoryorder->sortUrl($vwhistoryorder->DateIn) == "") { ?>
		<th data-name="DateIn" class="<?php echo $vwhistoryorder->DateIn->headerCellClass() ?>" style="white-space: nowrap;"><div id="elh_vwhistoryorder_DateIn" class="vwhistoryorder_DateIn"><div class="ew-table-header-caption"><?php echo $vwhistoryorder->DateIn->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="DateIn" class="<?php echo $vwhistoryorder->DateIn->headerCellClass() ?>" style="white-space: nowrap;"><div><div id="elh_vwhistoryorder_DateIn" class="vwhistoryorder_DateIn">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $vwhistoryorder->DateIn->caption() ?></span><span class="ew-table-header-sort"><?php if ($vwhistoryorder->DateIn->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($vwhistoryorder->DateIn->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($vwhistoryorder->DateOut->Visible) { // DateOut ?>
	<?php if ($vwhistoryorder->sortUrl($vwhistoryorder->DateOut) == "") { ?>
		<th data-name="DateOut" class="<?php echo $vwhistoryorder->DateOut->headerCellClass() ?>" style="white-space: nowrap;"><div id="elh_vwhistoryorder_DateOut" class="vwhistoryorder_DateOut"><div class="ew-table-header-caption"><?php echo $vwhistoryorder->DateOut->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="DateOut" class="<?php echo $vwhistoryorder->DateOut->headerCellClass() ?>" style="white-space: nowrap;"><div><div id="elh_vwhistoryorder_DateOut" class="vwhistoryorder_DateOut">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $vwhistoryorder->DateOut->caption() ?></span><span class="ew-table-header-sort"><?php if ($vwhistoryorder->DateOut->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($vwhistoryorder->DateOut->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($vwhistoryorder->PalletStatus->Visible) { // PalletStatus ?>
	<?php if ($vwhistoryorder->sortUrl($vwhistoryorder->PalletStatus) == "") { ?>
		<th data-name="PalletStatus" class="<?php echo $vwhistoryorder->PalletStatus->headerCellClass() ?>" style="white-space: nowrap;"><div id="elh_vwhistoryorder_PalletStatus" class="vwhistoryorder_PalletStatus"><div class="ew-table-header-caption"><?php echo $vwhistoryorder->PalletStatus->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="PalletStatus" class="<?php echo $vwhistoryorder->PalletStatus->headerCellClass() ?>" style="white-space: nowrap;"><div><div id="elh_vwhistoryorder_PalletStatus" class="vwhistoryorder_PalletStatus">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $vwhistoryorder->PalletStatus->caption() ?></span><span class="ew-table-header-sort"><?php if ($vwhistoryorder->PalletStatus->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($vwhistoryorder->PalletStatus->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($vwhistoryorder->CreateUser->Visible) { // CreateUser ?>
	<?php if ($vwhistoryorder->sortUrl($vwhistoryorder->CreateUser) == "") { ?>
		<th data-name="CreateUser" class="<?php echo $vwhistoryorder->CreateUser->headerCellClass() ?>" style="white-space: nowrap;"><div id="elh_vwhistoryorder_CreateUser" class="vwhistoryorder_CreateUser"><div class="ew-table-header-caption"><?php echo $vwhistoryorder->CreateUser->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="CreateUser" class="<?php echo $vwhistoryorder->CreateUser->headerCellClass() ?>" style="white-space: nowrap;"><div><div id="elh_vwhistoryorder_CreateUser" class="vwhistoryorder_CreateUser">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $vwhistoryorder->CreateUser->caption() ?></span><span class="ew-table-header-sort"><?php if ($vwhistoryorder->CreateUser->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($vwhistoryorder->CreateUser->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$vwhistoryorder_grid->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
$vwhistoryorder_grid->StartRec = 1;
$vwhistoryorder_grid->StopRec = $vwhistoryorder_grid->TotalRecs; // Show all records

// Restore number of post back records
if ($CurrentForm && $vwhistoryorder_grid->EventCancelled) {
	$CurrentForm->Index = -1;
	if ($CurrentForm->hasValue($vwhistoryorder_grid->FormKeyCountName) && ($vwhistoryorder->isGridAdd() || $vwhistoryorder->isGridEdit() || $vwhistoryorder->isConfirm())) {
		$vwhistoryorder_grid->KeyCount = $CurrentForm->getValue($vwhistoryorder_grid->FormKeyCountName);
		$vwhistoryorder_grid->StopRec = $vwhistoryorder_grid->StartRec + $vwhistoryorder_grid->KeyCount - 1;
	}
}
$vwhistoryorder_grid->RecCnt = $vwhistoryorder_grid->StartRec - 1;
if ($vwhistoryorder_grid->Recordset && !$vwhistoryorder_grid->Recordset->EOF) {
	$vwhistoryorder_grid->Recordset->moveFirst();
	$selectLimit = $vwhistoryorder_grid->UseSelectLimit;
	if (!$selectLimit && $vwhistoryorder_grid->StartRec > 1)
		$vwhistoryorder_grid->Recordset->move($vwhistoryorder_grid->StartRec - 1);
} elseif (!$vwhistoryorder->AllowAddDeleteRow && $vwhistoryorder_grid->StopRec == 0) {
	$vwhistoryorder_grid->StopRec = $vwhistoryorder->GridAddRowCount;
}

// Initialize aggregate
$vwhistoryorder->RowType = ROWTYPE_AGGREGATEINIT;
$vwhistoryorder->resetAttributes();
$vwhistoryorder_grid->renderRow();
if ($vwhistoryorder->isGridAdd())
	$vwhistoryorder_grid->RowIndex = 0;
if ($vwhistoryorder->isGridEdit())
	$vwhistoryorder_grid->RowIndex = 0;
while ($vwhistoryorder_grid->RecCnt < $vwhistoryorder_grid->StopRec) {
	$vwhistoryorder_grid->RecCnt++;
	if ($vwhistoryorder_grid->RecCnt >= $vwhistoryorder_grid->StartRec) {
		$vwhistoryorder_grid->RowCnt++;
		if ($vwhistoryorder->isGridAdd() || $vwhistoryorder->isGridEdit() || $vwhistoryorder->isConfirm()) {
			$vwhistoryorder_grid->RowIndex++;
			$CurrentForm->Index = $vwhistoryorder_grid->RowIndex;
			if ($CurrentForm->hasValue($vwhistoryorder_grid->FormActionName) && $vwhistoryorder_grid->EventCancelled)
				$vwhistoryorder_grid->RowAction = strval($CurrentForm->getValue($vwhistoryorder_grid->FormActionName));
			elseif ($vwhistoryorder->isGridAdd())
				$vwhistoryorder_grid->RowAction = "insert";
			else
				$vwhistoryorder_grid->RowAction = "";
		}

		// Set up key count
		$vwhistoryorder_grid->KeyCount = $vwhistoryorder_grid->RowIndex;

		// Init row class and style
		$vwhistoryorder->resetAttributes();
		$vwhistoryorder->CssClass = "";
		if ($vwhistoryorder->isGridAdd()) {
			if ($vwhistoryorder->CurrentMode == "copy") {
				$vwhistoryorder_grid->loadRowValues($vwhistoryorder_grid->Recordset); // Load row values
				$vwhistoryorder_grid->setRecordKey($vwhistoryorder_grid->RowOldKey, $vwhistoryorder_grid->Recordset); // Set old record key
			} else {
				$vwhistoryorder_grid->loadRowValues(); // Load default values
				$vwhistoryorder_grid->RowOldKey = ""; // Clear old key value
			}
		} else {
			$vwhistoryorder_grid->loadRowValues($vwhistoryorder_grid->Recordset); // Load row values
		}
		$vwhistoryorder->RowType = ROWTYPE_VIEW; // Render view
		if ($vwhistoryorder->isGridAdd()) // Grid add
			$vwhistoryorder->RowType = ROWTYPE_ADD; // Render add
		if ($vwhistoryorder->isGridAdd() && $vwhistoryorder->EventCancelled && !$CurrentForm->hasValue("k_blankrow")) // Insert failed
			$vwhistoryorder_grid->restoreCurrentRowFormValues($vwhistoryorder_grid->RowIndex); // Restore form values
		if ($vwhistoryorder->isGridEdit()) { // Grid edit
			if ($vwhistoryorder->EventCancelled)
				$vwhistoryorder_grid->restoreCurrentRowFormValues($vwhistoryorder_grid->RowIndex); // Restore form values
			if ($vwhistoryorder_grid->RowAction == "insert")
				$vwhistoryorder->RowType = ROWTYPE_ADD; // Render add
			else
				$vwhistoryorder->RowType = ROWTYPE_EDIT; // Render edit
		}
		if ($vwhistoryorder->isGridEdit() && ($vwhistoryorder->RowType == ROWTYPE_EDIT || $vwhistoryorder->RowType == ROWTYPE_ADD) && $vwhistoryorder->EventCancelled) // Update failed
			$vwhistoryorder_grid->restoreCurrentRowFormValues($vwhistoryorder_grid->RowIndex); // Restore form values
		if ($vwhistoryorder->RowType == ROWTYPE_EDIT) // Edit row
			$vwhistoryorder_grid->EditRowCnt++;
		if ($vwhistoryorder->isConfirm()) // Confirm row
			$vwhistoryorder_grid->restoreCurrentRowFormValues($vwhistoryorder_grid->RowIndex); // Restore form values

		// Set up row id / data-rowindex
		$vwhistoryorder->RowAttrs = array_merge($vwhistoryorder->RowAttrs, array('data-rowindex'=>$vwhistoryorder_grid->RowCnt, 'id'=>'r' . $vwhistoryorder_grid->RowCnt . '_vwhistoryorder', 'data-rowtype'=>$vwhistoryorder->RowType));

		// Render row
		$vwhistoryorder_grid->renderRow();

		// Render list options
		$vwhistoryorder_grid->renderListOptions();

		// Skip delete row / empty row for confirm page
		if ($vwhistoryorder_grid->RowAction <> "delete" && $vwhistoryorder_grid->RowAction <> "insertdelete" && !($vwhistoryorder_grid->RowAction == "insert" && $vwhistoryorder->isConfirm() && $vwhistoryorder_grid->emptyRow())) {
?>
	<tr<?php echo $vwhistoryorder->rowAttributes() ?>>
<?php

// Render list options (body, left)
$vwhistoryorder_grid->ListOptions->render("body", "left", $vwhistoryorder_grid->RowCnt);
?>
	<?php if ($vwhistoryorder->PalletID->Visible) { // PalletID ?>
		<td data-name="PalletID"<?php echo $vwhistoryorder->PalletID->cellAttributes() ?>>
<?php if ($vwhistoryorder->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $vwhistoryorder_grid->RowCnt ?>_vwhistoryorder_PalletID" class="form-group vwhistoryorder_PalletID">
<input type="text" data-table="vwhistoryorder" data-field="x_PalletID" name="x<?php echo $vwhistoryorder_grid->RowIndex ?>_PalletID" id="x<?php echo $vwhistoryorder_grid->RowIndex ?>_PalletID" size="30" maxlength="50" placeholder="<?php echo HtmlEncode($vwhistoryorder->PalletID->getPlaceHolder()) ?>" value="<?php echo $vwhistoryorder->PalletID->EditValue ?>"<?php echo $vwhistoryorder->PalletID->editAttributes() ?>>
</span>
<input type="hidden" data-table="vwhistoryorder" data-field="x_PalletID" name="o<?php echo $vwhistoryorder_grid->RowIndex ?>_PalletID" id="o<?php echo $vwhistoryorder_grid->RowIndex ?>_PalletID" value="<?php echo HtmlEncode($vwhistoryorder->PalletID->OldValue) ?>">
<?php } ?>
<?php if ($vwhistoryorder->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $vwhistoryorder_grid->RowCnt ?>_vwhistoryorder_PalletID" class="form-group vwhistoryorder_PalletID">
<input type="text" data-table="vwhistoryorder" data-field="x_PalletID" name="x<?php echo $vwhistoryorder_grid->RowIndex ?>_PalletID" id="x<?php echo $vwhistoryorder_grid->RowIndex ?>_PalletID" size="30" maxlength="50" placeholder="<?php echo HtmlEncode($vwhistoryorder->PalletID->getPlaceHolder()) ?>" value="<?php echo $vwhistoryorder->PalletID->EditValue ?>"<?php echo $vwhistoryorder->PalletID->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($vwhistoryorder->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $vwhistoryorder_grid->RowCnt ?>_vwhistoryorder_PalletID" class="vwhistoryorder_PalletID">
<span<?php echo $vwhistoryorder->PalletID->viewAttributes() ?>>
<?php echo $vwhistoryorder->PalletID->getViewValue() ?></span>
</span>
<?php if (!$vwhistoryorder->isConfirm()) { ?>
<input type="hidden" data-table="vwhistoryorder" data-field="x_PalletID" name="x<?php echo $vwhistoryorder_grid->RowIndex ?>_PalletID" id="x<?php echo $vwhistoryorder_grid->RowIndex ?>_PalletID" value="<?php echo HtmlEncode($vwhistoryorder->PalletID->FormValue) ?>">
<input type="hidden" data-table="vwhistoryorder" data-field="x_PalletID" name="o<?php echo $vwhistoryorder_grid->RowIndex ?>_PalletID" id="o<?php echo $vwhistoryorder_grid->RowIndex ?>_PalletID" value="<?php echo HtmlEncode($vwhistoryorder->PalletID->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="vwhistoryorder" data-field="x_PalletID" name="fvwhistoryordergrid$x<?php echo $vwhistoryorder_grid->RowIndex ?>_PalletID" id="fvwhistoryordergrid$x<?php echo $vwhistoryorder_grid->RowIndex ?>_PalletID" value="<?php echo HtmlEncode($vwhistoryorder->PalletID->FormValue) ?>">
<input type="hidden" data-table="vwhistoryorder" data-field="x_PalletID" name="fvwhistoryordergrid$o<?php echo $vwhistoryorder_grid->RowIndex ?>_PalletID" id="fvwhistoryordergrid$o<?php echo $vwhistoryorder_grid->RowIndex ?>_PalletID" value="<?php echo HtmlEncode($vwhistoryorder->PalletID->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
<?php if ($vwhistoryorder->RowType == ROWTYPE_ADD) { // Add record ?>
<input type="hidden" data-table="vwhistoryorder" data-field="x_ID_His" name="x<?php echo $vwhistoryorder_grid->RowIndex ?>_ID_His" id="x<?php echo $vwhistoryorder_grid->RowIndex ?>_ID_His" value="<?php echo HtmlEncode($vwhistoryorder->ID_His->CurrentValue) ?>">
<input type="hidden" data-table="vwhistoryorder" data-field="x_ID_His" name="o<?php echo $vwhistoryorder_grid->RowIndex ?>_ID_His" id="o<?php echo $vwhistoryorder_grid->RowIndex ?>_ID_His" value="<?php echo HtmlEncode($vwhistoryorder->ID_His->OldValue) ?>">
<?php } ?>
<?php if ($vwhistoryorder->RowType == ROWTYPE_EDIT || $vwhistoryorder->CurrentMode == "edit") { ?>
<input type="hidden" data-table="vwhistoryorder" data-field="x_ID_His" name="x<?php echo $vwhistoryorder_grid->RowIndex ?>_ID_His" id="x<?php echo $vwhistoryorder_grid->RowIndex ?>_ID_His" value="<?php echo HtmlEncode($vwhistoryorder->ID_His->CurrentValue) ?>">
<?php } ?>
	<?php if ($vwhistoryorder->Code->Visible) { // Code ?>
		<td data-name="Code"<?php echo $vwhistoryorder->Code->cellAttributes() ?>>
<?php if ($vwhistoryorder->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $vwhistoryorder_grid->RowCnt ?>_vwhistoryorder_Code" class="form-group vwhistoryorder_Code">
<input type="text" data-table="vwhistoryorder" data-field="x_Code" name="x<?php echo $vwhistoryorder_grid->RowIndex ?>_Code" id="x<?php echo $vwhistoryorder_grid->RowIndex ?>_Code" size="30" maxlength="50" placeholder="<?php echo HtmlEncode($vwhistoryorder->Code->getPlaceHolder()) ?>" value="<?php echo $vwhistoryorder->Code->EditValue ?>"<?php echo $vwhistoryorder->Code->editAttributes() ?>>
</span>
<input type="hidden" data-table="vwhistoryorder" data-field="x_Code" name="o<?php echo $vwhistoryorder_grid->RowIndex ?>_Code" id="o<?php echo $vwhistoryorder_grid->RowIndex ?>_Code" value="<?php echo HtmlEncode($vwhistoryorder->Code->OldValue) ?>">
<?php } ?>
<?php if ($vwhistoryorder->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $vwhistoryorder_grid->RowCnt ?>_vwhistoryorder_Code" class="form-group vwhistoryorder_Code">
<input type="text" data-table="vwhistoryorder" data-field="x_Code" name="x<?php echo $vwhistoryorder_grid->RowIndex ?>_Code" id="x<?php echo $vwhistoryorder_grid->RowIndex ?>_Code" size="30" maxlength="50" placeholder="<?php echo HtmlEncode($vwhistoryorder->Code->getPlaceHolder()) ?>" value="<?php echo $vwhistoryorder->Code->EditValue ?>"<?php echo $vwhistoryorder->Code->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($vwhistoryorder->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $vwhistoryorder_grid->RowCnt ?>_vwhistoryorder_Code" class="vwhistoryorder_Code">
<span<?php echo $vwhistoryorder->Code->viewAttributes() ?>>
<?php echo $vwhistoryorder->Code->getViewValue() ?></span>
</span>
<?php if (!$vwhistoryorder->isConfirm()) { ?>
<input type="hidden" data-table="vwhistoryorder" data-field="x_Code" name="x<?php echo $vwhistoryorder_grid->RowIndex ?>_Code" id="x<?php echo $vwhistoryorder_grid->RowIndex ?>_Code" value="<?php echo HtmlEncode($vwhistoryorder->Code->FormValue) ?>">
<input type="hidden" data-table="vwhistoryorder" data-field="x_Code" name="o<?php echo $vwhistoryorder_grid->RowIndex ?>_Code" id="o<?php echo $vwhistoryorder_grid->RowIndex ?>_Code" value="<?php echo HtmlEncode($vwhistoryorder->Code->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="vwhistoryorder" data-field="x_Code" name="fvwhistoryordergrid$x<?php echo $vwhistoryorder_grid->RowIndex ?>_Code" id="fvwhistoryordergrid$x<?php echo $vwhistoryorder_grid->RowIndex ?>_Code" value="<?php echo HtmlEncode($vwhistoryorder->Code->FormValue) ?>">
<input type="hidden" data-table="vwhistoryorder" data-field="x_Code" name="fvwhistoryordergrid$o<?php echo $vwhistoryorder_grid->RowIndex ?>_Code" id="fvwhistoryordergrid$o<?php echo $vwhistoryorder_grid->RowIndex ?>_Code" value="<?php echo HtmlEncode($vwhistoryorder->Code->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($vwhistoryorder->ProductName->Visible) { // ProductName ?>
		<td data-name="ProductName"<?php echo $vwhistoryorder->ProductName->cellAttributes() ?>>
<?php if ($vwhistoryorder->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $vwhistoryorder_grid->RowCnt ?>_vwhistoryorder_ProductName" class="form-group vwhistoryorder_ProductName">
<input type="text" data-table="vwhistoryorder" data-field="x_ProductName" name="x<?php echo $vwhistoryorder_grid->RowIndex ?>_ProductName" id="x<?php echo $vwhistoryorder_grid->RowIndex ?>_ProductName" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($vwhistoryorder->ProductName->getPlaceHolder()) ?>" value="<?php echo $vwhistoryorder->ProductName->EditValue ?>"<?php echo $vwhistoryorder->ProductName->editAttributes() ?>>
</span>
<input type="hidden" data-table="vwhistoryorder" data-field="x_ProductName" name="o<?php echo $vwhistoryorder_grid->RowIndex ?>_ProductName" id="o<?php echo $vwhistoryorder_grid->RowIndex ?>_ProductName" value="<?php echo HtmlEncode($vwhistoryorder->ProductName->OldValue) ?>">
<?php } ?>
<?php if ($vwhistoryorder->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $vwhistoryorder_grid->RowCnt ?>_vwhistoryorder_ProductName" class="form-group vwhistoryorder_ProductName">
<input type="text" data-table="vwhistoryorder" data-field="x_ProductName" name="x<?php echo $vwhistoryorder_grid->RowIndex ?>_ProductName" id="x<?php echo $vwhistoryorder_grid->RowIndex ?>_ProductName" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($vwhistoryorder->ProductName->getPlaceHolder()) ?>" value="<?php echo $vwhistoryorder->ProductName->EditValue ?>"<?php echo $vwhistoryorder->ProductName->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($vwhistoryorder->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $vwhistoryorder_grid->RowCnt ?>_vwhistoryorder_ProductName" class="vwhistoryorder_ProductName">
<span<?php echo $vwhistoryorder->ProductName->viewAttributes() ?>>
<?php echo $vwhistoryorder->ProductName->getViewValue() ?></span>
</span>
<?php if (!$vwhistoryorder->isConfirm()) { ?>
<input type="hidden" data-table="vwhistoryorder" data-field="x_ProductName" name="x<?php echo $vwhistoryorder_grid->RowIndex ?>_ProductName" id="x<?php echo $vwhistoryorder_grid->RowIndex ?>_ProductName" value="<?php echo HtmlEncode($vwhistoryorder->ProductName->FormValue) ?>">
<input type="hidden" data-table="vwhistoryorder" data-field="x_ProductName" name="o<?php echo $vwhistoryorder_grid->RowIndex ?>_ProductName" id="o<?php echo $vwhistoryorder_grid->RowIndex ?>_ProductName" value="<?php echo HtmlEncode($vwhistoryorder->ProductName->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="vwhistoryorder" data-field="x_ProductName" name="fvwhistoryordergrid$x<?php echo $vwhistoryorder_grid->RowIndex ?>_ProductName" id="fvwhistoryordergrid$x<?php echo $vwhistoryorder_grid->RowIndex ?>_ProductName" value="<?php echo HtmlEncode($vwhistoryorder->ProductName->FormValue) ?>">
<input type="hidden" data-table="vwhistoryorder" data-field="x_ProductName" name="fvwhistoryordergrid$o<?php echo $vwhistoryorder_grid->RowIndex ?>_ProductName" id="fvwhistoryordergrid$o<?php echo $vwhistoryorder_grid->RowIndex ?>_ProductName" value="<?php echo HtmlEncode($vwhistoryorder->ProductName->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($vwhistoryorder->PCS_Out->Visible) { // PCS_Out ?>
		<td data-name="PCS_Out"<?php echo $vwhistoryorder->PCS_Out->cellAttributes() ?>>
<?php if ($vwhistoryorder->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $vwhistoryorder_grid->RowCnt ?>_vwhistoryorder_PCS_Out" class="form-group vwhistoryorder_PCS_Out">
<input type="text" data-table="vwhistoryorder" data-field="x_PCS_Out" name="x<?php echo $vwhistoryorder_grid->RowIndex ?>_PCS_Out" id="x<?php echo $vwhistoryorder_grid->RowIndex ?>_PCS_Out" size="5" placeholder="<?php echo HtmlEncode($vwhistoryorder->PCS_Out->getPlaceHolder()) ?>" value="<?php echo $vwhistoryorder->PCS_Out->EditValue ?>"<?php echo $vwhistoryorder->PCS_Out->editAttributes() ?>>
</span>
<input type="hidden" data-table="vwhistoryorder" data-field="x_PCS_Out" name="o<?php echo $vwhistoryorder_grid->RowIndex ?>_PCS_Out" id="o<?php echo $vwhistoryorder_grid->RowIndex ?>_PCS_Out" value="<?php echo HtmlEncode($vwhistoryorder->PCS_Out->OldValue) ?>">
<?php } ?>
<?php if ($vwhistoryorder->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $vwhistoryorder_grid->RowCnt ?>_vwhistoryorder_PCS_Out" class="form-group vwhistoryorder_PCS_Out">
<input type="text" data-table="vwhistoryorder" data-field="x_PCS_Out" name="x<?php echo $vwhistoryorder_grid->RowIndex ?>_PCS_Out" id="x<?php echo $vwhistoryorder_grid->RowIndex ?>_PCS_Out" size="5" placeholder="<?php echo HtmlEncode($vwhistoryorder->PCS_Out->getPlaceHolder()) ?>" value="<?php echo $vwhistoryorder->PCS_Out->EditValue ?>"<?php echo $vwhistoryorder->PCS_Out->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($vwhistoryorder->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $vwhistoryorder_grid->RowCnt ?>_vwhistoryorder_PCS_Out" class="vwhistoryorder_PCS_Out">
<span<?php echo $vwhistoryorder->PCS_Out->viewAttributes() ?>>
<?php echo $vwhistoryorder->PCS_Out->getViewValue() ?></span>
</span>
<?php if (!$vwhistoryorder->isConfirm()) { ?>
<input type="hidden" data-table="vwhistoryorder" data-field="x_PCS_Out" name="x<?php echo $vwhistoryorder_grid->RowIndex ?>_PCS_Out" id="x<?php echo $vwhistoryorder_grid->RowIndex ?>_PCS_Out" value="<?php echo HtmlEncode($vwhistoryorder->PCS_Out->FormValue) ?>">
<input type="hidden" data-table="vwhistoryorder" data-field="x_PCS_Out" name="o<?php echo $vwhistoryorder_grid->RowIndex ?>_PCS_Out" id="o<?php echo $vwhistoryorder_grid->RowIndex ?>_PCS_Out" value="<?php echo HtmlEncode($vwhistoryorder->PCS_Out->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="vwhistoryorder" data-field="x_PCS_Out" name="fvwhistoryordergrid$x<?php echo $vwhistoryorder_grid->RowIndex ?>_PCS_Out" id="fvwhistoryordergrid$x<?php echo $vwhistoryorder_grid->RowIndex ?>_PCS_Out" value="<?php echo HtmlEncode($vwhistoryorder->PCS_Out->FormValue) ?>">
<input type="hidden" data-table="vwhistoryorder" data-field="x_PCS_Out" name="fvwhistoryordergrid$o<?php echo $vwhistoryorder_grid->RowIndex ?>_PCS_Out" id="fvwhistoryordergrid$o<?php echo $vwhistoryorder_grid->RowIndex ?>_PCS_Out" value="<?php echo HtmlEncode($vwhistoryorder->PCS_Out->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($vwhistoryorder->DateIn->Visible) { // DateIn ?>
		<td data-name="DateIn"<?php echo $vwhistoryorder->DateIn->cellAttributes() ?>>
<?php if ($vwhistoryorder->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $vwhistoryorder_grid->RowCnt ?>_vwhistoryorder_DateIn" class="form-group vwhistoryorder_DateIn">
<input type="text" data-table="vwhistoryorder" data-field="x_DateIn" data-format="11" name="x<?php echo $vwhistoryorder_grid->RowIndex ?>_DateIn" id="x<?php echo $vwhistoryorder_grid->RowIndex ?>_DateIn" placeholder="<?php echo HtmlEncode($vwhistoryorder->DateIn->getPlaceHolder()) ?>" value="<?php echo $vwhistoryorder->DateIn->EditValue ?>"<?php echo $vwhistoryorder->DateIn->editAttributes() ?>>
<?php if (!$vwhistoryorder->DateIn->ReadOnly && !$vwhistoryorder->DateIn->Disabled && !isset($vwhistoryorder->DateIn->EditAttrs["readonly"]) && !isset($vwhistoryorder->DateIn->EditAttrs["disabled"])) { ?>
<script>
ew.createDateTimePicker("fvwhistoryordergrid", "x<?php echo $vwhistoryorder_grid->RowIndex ?>_DateIn", {"ignoreReadonly":true,"useCurrent":false,"format":11});
</script>
<?php } ?>
</span>
<input type="hidden" data-table="vwhistoryorder" data-field="x_DateIn" name="o<?php echo $vwhistoryorder_grid->RowIndex ?>_DateIn" id="o<?php echo $vwhistoryorder_grid->RowIndex ?>_DateIn" value="<?php echo HtmlEncode($vwhistoryorder->DateIn->OldValue) ?>">
<?php } ?>
<?php if ($vwhistoryorder->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $vwhistoryorder_grid->RowCnt ?>_vwhistoryorder_DateIn" class="form-group vwhistoryorder_DateIn">
<input type="text" data-table="vwhistoryorder" data-field="x_DateIn" data-format="11" name="x<?php echo $vwhistoryorder_grid->RowIndex ?>_DateIn" id="x<?php echo $vwhistoryorder_grid->RowIndex ?>_DateIn" placeholder="<?php echo HtmlEncode($vwhistoryorder->DateIn->getPlaceHolder()) ?>" value="<?php echo $vwhistoryorder->DateIn->EditValue ?>"<?php echo $vwhistoryorder->DateIn->editAttributes() ?>>
<?php if (!$vwhistoryorder->DateIn->ReadOnly && !$vwhistoryorder->DateIn->Disabled && !isset($vwhistoryorder->DateIn->EditAttrs["readonly"]) && !isset($vwhistoryorder->DateIn->EditAttrs["disabled"])) { ?>
<script>
ew.createDateTimePicker("fvwhistoryordergrid", "x<?php echo $vwhistoryorder_grid->RowIndex ?>_DateIn", {"ignoreReadonly":true,"useCurrent":false,"format":11});
</script>
<?php } ?>
</span>
<?php } ?>
<?php if ($vwhistoryorder->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $vwhistoryorder_grid->RowCnt ?>_vwhistoryorder_DateIn" class="vwhistoryorder_DateIn">
<span<?php echo $vwhistoryorder->DateIn->viewAttributes() ?>>
<?php echo $vwhistoryorder->DateIn->getViewValue() ?></span>
</span>
<?php if (!$vwhistoryorder->isConfirm()) { ?>
<input type="hidden" data-table="vwhistoryorder" data-field="x_DateIn" name="x<?php echo $vwhistoryorder_grid->RowIndex ?>_DateIn" id="x<?php echo $vwhistoryorder_grid->RowIndex ?>_DateIn" value="<?php echo HtmlEncode($vwhistoryorder->DateIn->FormValue) ?>">
<input type="hidden" data-table="vwhistoryorder" data-field="x_DateIn" name="o<?php echo $vwhistoryorder_grid->RowIndex ?>_DateIn" id="o<?php echo $vwhistoryorder_grid->RowIndex ?>_DateIn" value="<?php echo HtmlEncode($vwhistoryorder->DateIn->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="vwhistoryorder" data-field="x_DateIn" name="fvwhistoryordergrid$x<?php echo $vwhistoryorder_grid->RowIndex ?>_DateIn" id="fvwhistoryordergrid$x<?php echo $vwhistoryorder_grid->RowIndex ?>_DateIn" value="<?php echo HtmlEncode($vwhistoryorder->DateIn->FormValue) ?>">
<input type="hidden" data-table="vwhistoryorder" data-field="x_DateIn" name="fvwhistoryordergrid$o<?php echo $vwhistoryorder_grid->RowIndex ?>_DateIn" id="fvwhistoryordergrid$o<?php echo $vwhistoryorder_grid->RowIndex ?>_DateIn" value="<?php echo HtmlEncode($vwhistoryorder->DateIn->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($vwhistoryorder->DateOut->Visible) { // DateOut ?>
		<td data-name="DateOut"<?php echo $vwhistoryorder->DateOut->cellAttributes() ?>>
<?php if ($vwhistoryorder->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $vwhistoryorder_grid->RowCnt ?>_vwhistoryorder_DateOut" class="form-group vwhistoryorder_DateOut">
<input type="text" data-table="vwhistoryorder" data-field="x_DateOut" data-format="11" name="x<?php echo $vwhistoryorder_grid->RowIndex ?>_DateOut" id="x<?php echo $vwhistoryorder_grid->RowIndex ?>_DateOut" placeholder="<?php echo HtmlEncode($vwhistoryorder->DateOut->getPlaceHolder()) ?>" value="<?php echo $vwhistoryorder->DateOut->EditValue ?>"<?php echo $vwhistoryorder->DateOut->editAttributes() ?>>
<?php if (!$vwhistoryorder->DateOut->ReadOnly && !$vwhistoryorder->DateOut->Disabled && !isset($vwhistoryorder->DateOut->EditAttrs["readonly"]) && !isset($vwhistoryorder->DateOut->EditAttrs["disabled"])) { ?>
<script>
ew.createDateTimePicker("fvwhistoryordergrid", "x<?php echo $vwhistoryorder_grid->RowIndex ?>_DateOut", {"ignoreReadonly":true,"useCurrent":false,"format":11});
</script>
<?php } ?>
</span>
<input type="hidden" data-table="vwhistoryorder" data-field="x_DateOut" name="o<?php echo $vwhistoryorder_grid->RowIndex ?>_DateOut" id="o<?php echo $vwhistoryorder_grid->RowIndex ?>_DateOut" value="<?php echo HtmlEncode($vwhistoryorder->DateOut->OldValue) ?>">
<?php } ?>
<?php if ($vwhistoryorder->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $vwhistoryorder_grid->RowCnt ?>_vwhistoryorder_DateOut" class="form-group vwhistoryorder_DateOut">
<input type="text" data-table="vwhistoryorder" data-field="x_DateOut" data-format="11" name="x<?php echo $vwhistoryorder_grid->RowIndex ?>_DateOut" id="x<?php echo $vwhistoryorder_grid->RowIndex ?>_DateOut" placeholder="<?php echo HtmlEncode($vwhistoryorder->DateOut->getPlaceHolder()) ?>" value="<?php echo $vwhistoryorder->DateOut->EditValue ?>"<?php echo $vwhistoryorder->DateOut->editAttributes() ?>>
<?php if (!$vwhistoryorder->DateOut->ReadOnly && !$vwhistoryorder->DateOut->Disabled && !isset($vwhistoryorder->DateOut->EditAttrs["readonly"]) && !isset($vwhistoryorder->DateOut->EditAttrs["disabled"])) { ?>
<script>
ew.createDateTimePicker("fvwhistoryordergrid", "x<?php echo $vwhistoryorder_grid->RowIndex ?>_DateOut", {"ignoreReadonly":true,"useCurrent":false,"format":11});
</script>
<?php } ?>
</span>
<?php } ?>
<?php if ($vwhistoryorder->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $vwhistoryorder_grid->RowCnt ?>_vwhistoryorder_DateOut" class="vwhistoryorder_DateOut">
<span<?php echo $vwhistoryorder->DateOut->viewAttributes() ?>>
<?php echo $vwhistoryorder->DateOut->getViewValue() ?></span>
</span>
<?php if (!$vwhistoryorder->isConfirm()) { ?>
<input type="hidden" data-table="vwhistoryorder" data-field="x_DateOut" name="x<?php echo $vwhistoryorder_grid->RowIndex ?>_DateOut" id="x<?php echo $vwhistoryorder_grid->RowIndex ?>_DateOut" value="<?php echo HtmlEncode($vwhistoryorder->DateOut->FormValue) ?>">
<input type="hidden" data-table="vwhistoryorder" data-field="x_DateOut" name="o<?php echo $vwhistoryorder_grid->RowIndex ?>_DateOut" id="o<?php echo $vwhistoryorder_grid->RowIndex ?>_DateOut" value="<?php echo HtmlEncode($vwhistoryorder->DateOut->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="vwhistoryorder" data-field="x_DateOut" name="fvwhistoryordergrid$x<?php echo $vwhistoryorder_grid->RowIndex ?>_DateOut" id="fvwhistoryordergrid$x<?php echo $vwhistoryorder_grid->RowIndex ?>_DateOut" value="<?php echo HtmlEncode($vwhistoryorder->DateOut->FormValue) ?>">
<input type="hidden" data-table="vwhistoryorder" data-field="x_DateOut" name="fvwhistoryordergrid$o<?php echo $vwhistoryorder_grid->RowIndex ?>_DateOut" id="fvwhistoryordergrid$o<?php echo $vwhistoryorder_grid->RowIndex ?>_DateOut" value="<?php echo HtmlEncode($vwhistoryorder->DateOut->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($vwhistoryorder->PalletStatus->Visible) { // PalletStatus ?>
		<td data-name="PalletStatus"<?php echo $vwhistoryorder->PalletStatus->cellAttributes() ?>>
<?php if ($vwhistoryorder->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $vwhistoryorder_grid->RowCnt ?>_vwhistoryorder_PalletStatus" class="form-group vwhistoryorder_PalletStatus">
<input type="text" data-table="vwhistoryorder" data-field="x_PalletStatus" name="x<?php echo $vwhistoryorder_grid->RowIndex ?>_PalletStatus" id="x<?php echo $vwhistoryorder_grid->RowIndex ?>_PalletStatus" size="30" maxlength="25" placeholder="<?php echo HtmlEncode($vwhistoryorder->PalletStatus->getPlaceHolder()) ?>" value="<?php echo $vwhistoryorder->PalletStatus->EditValue ?>"<?php echo $vwhistoryorder->PalletStatus->editAttributes() ?>>
</span>
<input type="hidden" data-table="vwhistoryorder" data-field="x_PalletStatus" name="o<?php echo $vwhistoryorder_grid->RowIndex ?>_PalletStatus" id="o<?php echo $vwhistoryorder_grid->RowIndex ?>_PalletStatus" value="<?php echo HtmlEncode($vwhistoryorder->PalletStatus->OldValue) ?>">
<?php } ?>
<?php if ($vwhistoryorder->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $vwhistoryorder_grid->RowCnt ?>_vwhistoryorder_PalletStatus" class="form-group vwhistoryorder_PalletStatus">
<input type="text" data-table="vwhistoryorder" data-field="x_PalletStatus" name="x<?php echo $vwhistoryorder_grid->RowIndex ?>_PalletStatus" id="x<?php echo $vwhistoryorder_grid->RowIndex ?>_PalletStatus" size="30" maxlength="25" placeholder="<?php echo HtmlEncode($vwhistoryorder->PalletStatus->getPlaceHolder()) ?>" value="<?php echo $vwhistoryorder->PalletStatus->EditValue ?>"<?php echo $vwhistoryorder->PalletStatus->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($vwhistoryorder->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $vwhistoryorder_grid->RowCnt ?>_vwhistoryorder_PalletStatus" class="vwhistoryorder_PalletStatus">
<span<?php echo $vwhistoryorder->PalletStatus->viewAttributes() ?>>
<?php echo $vwhistoryorder->PalletStatus->getViewValue() ?></span>
</span>
<?php if (!$vwhistoryorder->isConfirm()) { ?>
<input type="hidden" data-table="vwhistoryorder" data-field="x_PalletStatus" name="x<?php echo $vwhistoryorder_grid->RowIndex ?>_PalletStatus" id="x<?php echo $vwhistoryorder_grid->RowIndex ?>_PalletStatus" value="<?php echo HtmlEncode($vwhistoryorder->PalletStatus->FormValue) ?>">
<input type="hidden" data-table="vwhistoryorder" data-field="x_PalletStatus" name="o<?php echo $vwhistoryorder_grid->RowIndex ?>_PalletStatus" id="o<?php echo $vwhistoryorder_grid->RowIndex ?>_PalletStatus" value="<?php echo HtmlEncode($vwhistoryorder->PalletStatus->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="vwhistoryorder" data-field="x_PalletStatus" name="fvwhistoryordergrid$x<?php echo $vwhistoryorder_grid->RowIndex ?>_PalletStatus" id="fvwhistoryordergrid$x<?php echo $vwhistoryorder_grid->RowIndex ?>_PalletStatus" value="<?php echo HtmlEncode($vwhistoryorder->PalletStatus->FormValue) ?>">
<input type="hidden" data-table="vwhistoryorder" data-field="x_PalletStatus" name="fvwhistoryordergrid$o<?php echo $vwhistoryorder_grid->RowIndex ?>_PalletStatus" id="fvwhistoryordergrid$o<?php echo $vwhistoryorder_grid->RowIndex ?>_PalletStatus" value="<?php echo HtmlEncode($vwhistoryorder->PalletStatus->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($vwhistoryorder->CreateUser->Visible) { // CreateUser ?>
		<td data-name="CreateUser"<?php echo $vwhistoryorder->CreateUser->cellAttributes() ?>>
<?php if ($vwhistoryorder->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $vwhistoryorder_grid->RowCnt ?>_vwhistoryorder_CreateUser" class="form-group vwhistoryorder_CreateUser">
<input type="text" data-table="vwhistoryorder" data-field="x_CreateUser" name="x<?php echo $vwhistoryorder_grid->RowIndex ?>_CreateUser" id="x<?php echo $vwhistoryorder_grid->RowIndex ?>_CreateUser" size="30" maxlength="50" placeholder="<?php echo HtmlEncode($vwhistoryorder->CreateUser->getPlaceHolder()) ?>" value="<?php echo $vwhistoryorder->CreateUser->EditValue ?>"<?php echo $vwhistoryorder->CreateUser->editAttributes() ?>>
</span>
<input type="hidden" data-table="vwhistoryorder" data-field="x_CreateUser" name="o<?php echo $vwhistoryorder_grid->RowIndex ?>_CreateUser" id="o<?php echo $vwhistoryorder_grid->RowIndex ?>_CreateUser" value="<?php echo HtmlEncode($vwhistoryorder->CreateUser->OldValue) ?>">
<?php } ?>
<?php if ($vwhistoryorder->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $vwhistoryorder_grid->RowCnt ?>_vwhistoryorder_CreateUser" class="form-group vwhistoryorder_CreateUser">
<input type="text" data-table="vwhistoryorder" data-field="x_CreateUser" name="x<?php echo $vwhistoryorder_grid->RowIndex ?>_CreateUser" id="x<?php echo $vwhistoryorder_grid->RowIndex ?>_CreateUser" size="30" maxlength="50" placeholder="<?php echo HtmlEncode($vwhistoryorder->CreateUser->getPlaceHolder()) ?>" value="<?php echo $vwhistoryorder->CreateUser->EditValue ?>"<?php echo $vwhistoryorder->CreateUser->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($vwhistoryorder->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $vwhistoryorder_grid->RowCnt ?>_vwhistoryorder_CreateUser" class="vwhistoryorder_CreateUser">
<span<?php echo $vwhistoryorder->CreateUser->viewAttributes() ?>>
<?php echo $vwhistoryorder->CreateUser->getViewValue() ?></span>
</span>
<?php if (!$vwhistoryorder->isConfirm()) { ?>
<input type="hidden" data-table="vwhistoryorder" data-field="x_CreateUser" name="x<?php echo $vwhistoryorder_grid->RowIndex ?>_CreateUser" id="x<?php echo $vwhistoryorder_grid->RowIndex ?>_CreateUser" value="<?php echo HtmlEncode($vwhistoryorder->CreateUser->FormValue) ?>">
<input type="hidden" data-table="vwhistoryorder" data-field="x_CreateUser" name="o<?php echo $vwhistoryorder_grid->RowIndex ?>_CreateUser" id="o<?php echo $vwhistoryorder_grid->RowIndex ?>_CreateUser" value="<?php echo HtmlEncode($vwhistoryorder->CreateUser->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="vwhistoryorder" data-field="x_CreateUser" name="fvwhistoryordergrid$x<?php echo $vwhistoryorder_grid->RowIndex ?>_CreateUser" id="fvwhistoryordergrid$x<?php echo $vwhistoryorder_grid->RowIndex ?>_CreateUser" value="<?php echo HtmlEncode($vwhistoryorder->CreateUser->FormValue) ?>">
<input type="hidden" data-table="vwhistoryorder" data-field="x_CreateUser" name="fvwhistoryordergrid$o<?php echo $vwhistoryorder_grid->RowIndex ?>_CreateUser" id="fvwhistoryordergrid$o<?php echo $vwhistoryorder_grid->RowIndex ?>_CreateUser" value="<?php echo HtmlEncode($vwhistoryorder->CreateUser->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$vwhistoryorder_grid->ListOptions->render("body", "right", $vwhistoryorder_grid->RowCnt);
?>
	</tr>
<?php if ($vwhistoryorder->RowType == ROWTYPE_ADD || $vwhistoryorder->RowType == ROWTYPE_EDIT) { ?>
<script>
fvwhistoryordergrid.updateLists(<?php echo $vwhistoryorder_grid->RowIndex ?>);
</script>
<?php } ?>
<?php
	}
	} // End delete row checking
	if (!$vwhistoryorder->isGridAdd() || $vwhistoryorder->CurrentMode == "copy")
		if (!$vwhistoryorder_grid->Recordset->EOF)
			$vwhistoryorder_grid->Recordset->moveNext();
}
?>
<?php
	if ($vwhistoryorder->CurrentMode == "add" || $vwhistoryorder->CurrentMode == "copy" || $vwhistoryorder->CurrentMode == "edit") {
		$vwhistoryorder_grid->RowIndex = '$rowindex$';
		$vwhistoryorder_grid->loadRowValues();

		// Set row properties
		$vwhistoryorder->resetAttributes();
		$vwhistoryorder->RowAttrs = array_merge($vwhistoryorder->RowAttrs, array('data-rowindex'=>$vwhistoryorder_grid->RowIndex, 'id'=>'r0_vwhistoryorder', 'data-rowtype'=>ROWTYPE_ADD));
		AppendClass($vwhistoryorder->RowAttrs["class"], "ew-template");
		$vwhistoryorder->RowType = ROWTYPE_ADD;

		// Render row
		$vwhistoryorder_grid->renderRow();

		// Render list options
		$vwhistoryorder_grid->renderListOptions();
		$vwhistoryorder_grid->StartRowCnt = 0;
?>
	<tr<?php echo $vwhistoryorder->rowAttributes() ?>>
<?php

// Render list options (body, left)
$vwhistoryorder_grid->ListOptions->render("body", "left", $vwhistoryorder_grid->RowIndex);
?>
	<?php if ($vwhistoryorder->PalletID->Visible) { // PalletID ?>
		<td data-name="PalletID">
<?php if (!$vwhistoryorder->isConfirm()) { ?>
<span id="el$rowindex$_vwhistoryorder_PalletID" class="form-group vwhistoryorder_PalletID">
<input type="text" data-table="vwhistoryorder" data-field="x_PalletID" name="x<?php echo $vwhistoryorder_grid->RowIndex ?>_PalletID" id="x<?php echo $vwhistoryorder_grid->RowIndex ?>_PalletID" size="30" maxlength="50" placeholder="<?php echo HtmlEncode($vwhistoryorder->PalletID->getPlaceHolder()) ?>" value="<?php echo $vwhistoryorder->PalletID->EditValue ?>"<?php echo $vwhistoryorder->PalletID->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_vwhistoryorder_PalletID" class="form-group vwhistoryorder_PalletID">
<span<?php echo $vwhistoryorder->PalletID->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?php echo RemoveHtml($vwhistoryorder->PalletID->ViewValue) ?>"></span>
</span>
<input type="hidden" data-table="vwhistoryorder" data-field="x_PalletID" name="x<?php echo $vwhistoryorder_grid->RowIndex ?>_PalletID" id="x<?php echo $vwhistoryorder_grid->RowIndex ?>_PalletID" value="<?php echo HtmlEncode($vwhistoryorder->PalletID->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="vwhistoryorder" data-field="x_PalletID" name="o<?php echo $vwhistoryorder_grid->RowIndex ?>_PalletID" id="o<?php echo $vwhistoryorder_grid->RowIndex ?>_PalletID" value="<?php echo HtmlEncode($vwhistoryorder->PalletID->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($vwhistoryorder->Code->Visible) { // Code ?>
		<td data-name="Code">
<?php if (!$vwhistoryorder->isConfirm()) { ?>
<span id="el$rowindex$_vwhistoryorder_Code" class="form-group vwhistoryorder_Code">
<input type="text" data-table="vwhistoryorder" data-field="x_Code" name="x<?php echo $vwhistoryorder_grid->RowIndex ?>_Code" id="x<?php echo $vwhistoryorder_grid->RowIndex ?>_Code" size="30" maxlength="50" placeholder="<?php echo HtmlEncode($vwhistoryorder->Code->getPlaceHolder()) ?>" value="<?php echo $vwhistoryorder->Code->EditValue ?>"<?php echo $vwhistoryorder->Code->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_vwhistoryorder_Code" class="form-group vwhistoryorder_Code">
<span<?php echo $vwhistoryorder->Code->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?php echo RemoveHtml($vwhistoryorder->Code->ViewValue) ?>"></span>
</span>
<input type="hidden" data-table="vwhistoryorder" data-field="x_Code" name="x<?php echo $vwhistoryorder_grid->RowIndex ?>_Code" id="x<?php echo $vwhistoryorder_grid->RowIndex ?>_Code" value="<?php echo HtmlEncode($vwhistoryorder->Code->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="vwhistoryorder" data-field="x_Code" name="o<?php echo $vwhistoryorder_grid->RowIndex ?>_Code" id="o<?php echo $vwhistoryorder_grid->RowIndex ?>_Code" value="<?php echo HtmlEncode($vwhistoryorder->Code->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($vwhistoryorder->ProductName->Visible) { // ProductName ?>
		<td data-name="ProductName">
<?php if (!$vwhistoryorder->isConfirm()) { ?>
<span id="el$rowindex$_vwhistoryorder_ProductName" class="form-group vwhistoryorder_ProductName">
<input type="text" data-table="vwhistoryorder" data-field="x_ProductName" name="x<?php echo $vwhistoryorder_grid->RowIndex ?>_ProductName" id="x<?php echo $vwhistoryorder_grid->RowIndex ?>_ProductName" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($vwhistoryorder->ProductName->getPlaceHolder()) ?>" value="<?php echo $vwhistoryorder->ProductName->EditValue ?>"<?php echo $vwhistoryorder->ProductName->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_vwhistoryorder_ProductName" class="form-group vwhistoryorder_ProductName">
<span<?php echo $vwhistoryorder->ProductName->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?php echo RemoveHtml($vwhistoryorder->ProductName->ViewValue) ?>"></span>
</span>
<input type="hidden" data-table="vwhistoryorder" data-field="x_ProductName" name="x<?php echo $vwhistoryorder_grid->RowIndex ?>_ProductName" id="x<?php echo $vwhistoryorder_grid->RowIndex ?>_ProductName" value="<?php echo HtmlEncode($vwhistoryorder->ProductName->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="vwhistoryorder" data-field="x_ProductName" name="o<?php echo $vwhistoryorder_grid->RowIndex ?>_ProductName" id="o<?php echo $vwhistoryorder_grid->RowIndex ?>_ProductName" value="<?php echo HtmlEncode($vwhistoryorder->ProductName->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($vwhistoryorder->PCS_Out->Visible) { // PCS_Out ?>
		<td data-name="PCS_Out">
<?php if (!$vwhistoryorder->isConfirm()) { ?>
<span id="el$rowindex$_vwhistoryorder_PCS_Out" class="form-group vwhistoryorder_PCS_Out">
<input type="text" data-table="vwhistoryorder" data-field="x_PCS_Out" name="x<?php echo $vwhistoryorder_grid->RowIndex ?>_PCS_Out" id="x<?php echo $vwhistoryorder_grid->RowIndex ?>_PCS_Out" size="5" placeholder="<?php echo HtmlEncode($vwhistoryorder->PCS_Out->getPlaceHolder()) ?>" value="<?php echo $vwhistoryorder->PCS_Out->EditValue ?>"<?php echo $vwhistoryorder->PCS_Out->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_vwhistoryorder_PCS_Out" class="form-group vwhistoryorder_PCS_Out">
<span<?php echo $vwhistoryorder->PCS_Out->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?php echo RemoveHtml($vwhistoryorder->PCS_Out->ViewValue) ?>"></span>
</span>
<input type="hidden" data-table="vwhistoryorder" data-field="x_PCS_Out" name="x<?php echo $vwhistoryorder_grid->RowIndex ?>_PCS_Out" id="x<?php echo $vwhistoryorder_grid->RowIndex ?>_PCS_Out" value="<?php echo HtmlEncode($vwhistoryorder->PCS_Out->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="vwhistoryorder" data-field="x_PCS_Out" name="o<?php echo $vwhistoryorder_grid->RowIndex ?>_PCS_Out" id="o<?php echo $vwhistoryorder_grid->RowIndex ?>_PCS_Out" value="<?php echo HtmlEncode($vwhistoryorder->PCS_Out->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($vwhistoryorder->DateIn->Visible) { // DateIn ?>
		<td data-name="DateIn">
<?php if (!$vwhistoryorder->isConfirm()) { ?>
<span id="el$rowindex$_vwhistoryorder_DateIn" class="form-group vwhistoryorder_DateIn">
<input type="text" data-table="vwhistoryorder" data-field="x_DateIn" data-format="11" name="x<?php echo $vwhistoryorder_grid->RowIndex ?>_DateIn" id="x<?php echo $vwhistoryorder_grid->RowIndex ?>_DateIn" placeholder="<?php echo HtmlEncode($vwhistoryorder->DateIn->getPlaceHolder()) ?>" value="<?php echo $vwhistoryorder->DateIn->EditValue ?>"<?php echo $vwhistoryorder->DateIn->editAttributes() ?>>
<?php if (!$vwhistoryorder->DateIn->ReadOnly && !$vwhistoryorder->DateIn->Disabled && !isset($vwhistoryorder->DateIn->EditAttrs["readonly"]) && !isset($vwhistoryorder->DateIn->EditAttrs["disabled"])) { ?>
<script>
ew.createDateTimePicker("fvwhistoryordergrid", "x<?php echo $vwhistoryorder_grid->RowIndex ?>_DateIn", {"ignoreReadonly":true,"useCurrent":false,"format":11});
</script>
<?php } ?>
</span>
<?php } else { ?>
<span id="el$rowindex$_vwhistoryorder_DateIn" class="form-group vwhistoryorder_DateIn">
<span<?php echo $vwhistoryorder->DateIn->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?php echo RemoveHtml($vwhistoryorder->DateIn->ViewValue) ?>"></span>
</span>
<input type="hidden" data-table="vwhistoryorder" data-field="x_DateIn" name="x<?php echo $vwhistoryorder_grid->RowIndex ?>_DateIn" id="x<?php echo $vwhistoryorder_grid->RowIndex ?>_DateIn" value="<?php echo HtmlEncode($vwhistoryorder->DateIn->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="vwhistoryorder" data-field="x_DateIn" name="o<?php echo $vwhistoryorder_grid->RowIndex ?>_DateIn" id="o<?php echo $vwhistoryorder_grid->RowIndex ?>_DateIn" value="<?php echo HtmlEncode($vwhistoryorder->DateIn->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($vwhistoryorder->DateOut->Visible) { // DateOut ?>
		<td data-name="DateOut">
<?php if (!$vwhistoryorder->isConfirm()) { ?>
<span id="el$rowindex$_vwhistoryorder_DateOut" class="form-group vwhistoryorder_DateOut">
<input type="text" data-table="vwhistoryorder" data-field="x_DateOut" data-format="11" name="x<?php echo $vwhistoryorder_grid->RowIndex ?>_DateOut" id="x<?php echo $vwhistoryorder_grid->RowIndex ?>_DateOut" placeholder="<?php echo HtmlEncode($vwhistoryorder->DateOut->getPlaceHolder()) ?>" value="<?php echo $vwhistoryorder->DateOut->EditValue ?>"<?php echo $vwhistoryorder->DateOut->editAttributes() ?>>
<?php if (!$vwhistoryorder->DateOut->ReadOnly && !$vwhistoryorder->DateOut->Disabled && !isset($vwhistoryorder->DateOut->EditAttrs["readonly"]) && !isset($vwhistoryorder->DateOut->EditAttrs["disabled"])) { ?>
<script>
ew.createDateTimePicker("fvwhistoryordergrid", "x<?php echo $vwhistoryorder_grid->RowIndex ?>_DateOut", {"ignoreReadonly":true,"useCurrent":false,"format":11});
</script>
<?php } ?>
</span>
<?php } else { ?>
<span id="el$rowindex$_vwhistoryorder_DateOut" class="form-group vwhistoryorder_DateOut">
<span<?php echo $vwhistoryorder->DateOut->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?php echo RemoveHtml($vwhistoryorder->DateOut->ViewValue) ?>"></span>
</span>
<input type="hidden" data-table="vwhistoryorder" data-field="x_DateOut" name="x<?php echo $vwhistoryorder_grid->RowIndex ?>_DateOut" id="x<?php echo $vwhistoryorder_grid->RowIndex ?>_DateOut" value="<?php echo HtmlEncode($vwhistoryorder->DateOut->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="vwhistoryorder" data-field="x_DateOut" name="o<?php echo $vwhistoryorder_grid->RowIndex ?>_DateOut" id="o<?php echo $vwhistoryorder_grid->RowIndex ?>_DateOut" value="<?php echo HtmlEncode($vwhistoryorder->DateOut->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($vwhistoryorder->PalletStatus->Visible) { // PalletStatus ?>
		<td data-name="PalletStatus">
<?php if (!$vwhistoryorder->isConfirm()) { ?>
<span id="el$rowindex$_vwhistoryorder_PalletStatus" class="form-group vwhistoryorder_PalletStatus">
<input type="text" data-table="vwhistoryorder" data-field="x_PalletStatus" name="x<?php echo $vwhistoryorder_grid->RowIndex ?>_PalletStatus" id="x<?php echo $vwhistoryorder_grid->RowIndex ?>_PalletStatus" size="30" maxlength="25" placeholder="<?php echo HtmlEncode($vwhistoryorder->PalletStatus->getPlaceHolder()) ?>" value="<?php echo $vwhistoryorder->PalletStatus->EditValue ?>"<?php echo $vwhistoryorder->PalletStatus->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_vwhistoryorder_PalletStatus" class="form-group vwhistoryorder_PalletStatus">
<span<?php echo $vwhistoryorder->PalletStatus->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?php echo RemoveHtml($vwhistoryorder->PalletStatus->ViewValue) ?>"></span>
</span>
<input type="hidden" data-table="vwhistoryorder" data-field="x_PalletStatus" name="x<?php echo $vwhistoryorder_grid->RowIndex ?>_PalletStatus" id="x<?php echo $vwhistoryorder_grid->RowIndex ?>_PalletStatus" value="<?php echo HtmlEncode($vwhistoryorder->PalletStatus->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="vwhistoryorder" data-field="x_PalletStatus" name="o<?php echo $vwhistoryorder_grid->RowIndex ?>_PalletStatus" id="o<?php echo $vwhistoryorder_grid->RowIndex ?>_PalletStatus" value="<?php echo HtmlEncode($vwhistoryorder->PalletStatus->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($vwhistoryorder->CreateUser->Visible) { // CreateUser ?>
		<td data-name="CreateUser">
<?php if (!$vwhistoryorder->isConfirm()) { ?>
<span id="el$rowindex$_vwhistoryorder_CreateUser" class="form-group vwhistoryorder_CreateUser">
<input type="text" data-table="vwhistoryorder" data-field="x_CreateUser" name="x<?php echo $vwhistoryorder_grid->RowIndex ?>_CreateUser" id="x<?php echo $vwhistoryorder_grid->RowIndex ?>_CreateUser" size="30" maxlength="50" placeholder="<?php echo HtmlEncode($vwhistoryorder->CreateUser->getPlaceHolder()) ?>" value="<?php echo $vwhistoryorder->CreateUser->EditValue ?>"<?php echo $vwhistoryorder->CreateUser->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_vwhistoryorder_CreateUser" class="form-group vwhistoryorder_CreateUser">
<span<?php echo $vwhistoryorder->CreateUser->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?php echo RemoveHtml($vwhistoryorder->CreateUser->ViewValue) ?>"></span>
</span>
<input type="hidden" data-table="vwhistoryorder" data-field="x_CreateUser" name="x<?php echo $vwhistoryorder_grid->RowIndex ?>_CreateUser" id="x<?php echo $vwhistoryorder_grid->RowIndex ?>_CreateUser" value="<?php echo HtmlEncode($vwhistoryorder->CreateUser->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="vwhistoryorder" data-field="x_CreateUser" name="o<?php echo $vwhistoryorder_grid->RowIndex ?>_CreateUser" id="o<?php echo $vwhistoryorder_grid->RowIndex ?>_CreateUser" value="<?php echo HtmlEncode($vwhistoryorder->CreateUser->OldValue) ?>">
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$vwhistoryorder_grid->ListOptions->render("body", "right", $vwhistoryorder_grid->RowIndex);
?>
<script>
fvwhistoryordergrid.updateLists(<?php echo $vwhistoryorder_grid->RowIndex ?>);
</script>
	</tr>
<?php
}
?>
</tbody>
<?php

// Render aggregate row
$vwhistoryorder->RowType = ROWTYPE_AGGREGATE;
$vwhistoryorder->resetAttributes();
$vwhistoryorder_grid->renderRow();
?>
<?php if ($vwhistoryorder_grid->TotalRecs > 0 && $vwhistoryorder->CurrentMode == "view") { ?>
<tfoot><!-- Table footer -->
	<tr class="ew-table-footer">
<?php

// Render list options
$vwhistoryorder_grid->renderListOptions();

// Render list options (footer, left)
$vwhistoryorder_grid->ListOptions->render("footer", "left");
?>
	<?php if ($vwhistoryorder->PalletID->Visible) { // PalletID ?>
		<td data-name="PalletID" class="<?php echo $vwhistoryorder->PalletID->footerCellClass() ?>"><span id="elf_vwhistoryorder_PalletID" class="vwhistoryorder_PalletID">
		&nbsp;
		</span></td>
	<?php } ?>
	<?php if ($vwhistoryorder->Code->Visible) { // Code ?>
		<td data-name="Code" class="<?php echo $vwhistoryorder->Code->footerCellClass() ?>"><span id="elf_vwhistoryorder_Code" class="vwhistoryorder_Code">
		&nbsp;
		</span></td>
	<?php } ?>
	<?php if ($vwhistoryorder->ProductName->Visible) { // ProductName ?>
		<td data-name="ProductName" class="<?php echo $vwhistoryorder->ProductName->footerCellClass() ?>"><span id="elf_vwhistoryorder_ProductName" class="vwhistoryorder_ProductName">
		&nbsp;
		</span></td>
	<?php } ?>
	<?php if ($vwhistoryorder->PCS_Out->Visible) { // PCS_Out ?>
		<td data-name="PCS_Out" class="<?php echo $vwhistoryorder->PCS_Out->footerCellClass() ?>"><span id="elf_vwhistoryorder_PCS_Out" class="vwhistoryorder_PCS_Out">
		<span class="ew-aggregate"><?php echo $Language->phrase("TOTAL") ?></span><span class="ew-aggregate-value">
		<?php echo $vwhistoryorder->PCS_Out->ViewValue ?></span>
		</span></td>
	<?php } ?>
	<?php if ($vwhistoryorder->DateIn->Visible) { // DateIn ?>
		<td data-name="DateIn" class="<?php echo $vwhistoryorder->DateIn->footerCellClass() ?>"><span id="elf_vwhistoryorder_DateIn" class="vwhistoryorder_DateIn">
		&nbsp;
		</span></td>
	<?php } ?>
	<?php if ($vwhistoryorder->DateOut->Visible) { // DateOut ?>
		<td data-name="DateOut" class="<?php echo $vwhistoryorder->DateOut->footerCellClass() ?>"><span id="elf_vwhistoryorder_DateOut" class="vwhistoryorder_DateOut">
		&nbsp;
		</span></td>
	<?php } ?>
	<?php if ($vwhistoryorder->PalletStatus->Visible) { // PalletStatus ?>
		<td data-name="PalletStatus" class="<?php echo $vwhistoryorder->PalletStatus->footerCellClass() ?>"><span id="elf_vwhistoryorder_PalletStatus" class="vwhistoryorder_PalletStatus">
		&nbsp;
		</span></td>
	<?php } ?>
	<?php if ($vwhistoryorder->CreateUser->Visible) { // CreateUser ?>
		<td data-name="CreateUser" class="<?php echo $vwhistoryorder->CreateUser->footerCellClass() ?>"><span id="elf_vwhistoryorder_CreateUser" class="vwhistoryorder_CreateUser">
		&nbsp;
		</span></td>
	<?php } ?>
<?php

// Render list options (footer, right)
$vwhistoryorder_grid->ListOptions->render("footer", "right");
?>
	</tr>
</tfoot>
<?php } ?>
</table><!-- /.ew-table -->
<?php if ($vwhistoryorder->CurrentMode == "add" || $vwhistoryorder->CurrentMode == "copy") { ?>
<input type="hidden" name="<?php echo $vwhistoryorder_grid->FormKeyCountName ?>" id="<?php echo $vwhistoryorder_grid->FormKeyCountName ?>" value="<?php echo $vwhistoryorder_grid->KeyCount ?>">
<?php echo $vwhistoryorder_grid->MultiSelectKey ?>
<?php } ?>
<?php if ($vwhistoryorder->CurrentMode == "edit") { ?>
<input type="hidden" name="<?php echo $vwhistoryorder_grid->FormKeyCountName ?>" id="<?php echo $vwhistoryorder_grid->FormKeyCountName ?>" value="<?php echo $vwhistoryorder_grid->KeyCount ?>">
<?php echo $vwhistoryorder_grid->MultiSelectKey ?>
<?php } ?>
<?php if ($vwhistoryorder->CurrentMode == "") { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
<input type="hidden" name="detailpage" value="fvwhistoryordergrid">
</div><!-- /.ew-grid-middle-panel -->
<?php

// Close recordset
if ($vwhistoryorder_grid->Recordset)
	$vwhistoryorder_grid->Recordset->Close();
?>
</div>
<?php if ($vwhistoryorder_grid->ShowOtherOptions) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php $vwhistoryorder_grid->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($vwhistoryorder_grid->TotalRecs == 0 && !$vwhistoryorder->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $vwhistoryorder_grid->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$vwhistoryorder_grid->terminate();
?>