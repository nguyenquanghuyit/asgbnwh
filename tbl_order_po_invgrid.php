<?php
namespace PHPMaker2019\asgbn_wh;

// Write header
WriteHeader(FALSE);

// Create page object
if (!isset($tbl_order_po_inv_grid))
	$tbl_order_po_inv_grid = new tbl_order_po_inv_grid();

// Run the page
$tbl_order_po_inv_grid->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$tbl_order_po_inv_grid->Page_Render();
?>
<?php if (!$tbl_order_po_inv->isExport()) { ?>
<script>

// Form object
var ftbl_order_po_invgrid = new ew.Form("ftbl_order_po_invgrid", "grid");
ftbl_order_po_invgrid.formKeyCountName = '<?php echo $tbl_order_po_inv_grid->FormKeyCountName ?>';

// Validate form
ftbl_order_po_invgrid.validate = function() {
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
		<?php if ($tbl_order_po_inv_grid->Code->Required) { ?>
			elm = this.getElements("x" + infix + "_Code");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $tbl_order_po_inv->Code->caption(), $tbl_order_po_inv->Code->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($tbl_order_po_inv_grid->PalletNo->Required) { ?>
			elm = this.getElements("x" + infix + "_PalletNo");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $tbl_order_po_inv->PalletNo->caption(), $tbl_order_po_inv->PalletNo->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($tbl_order_po_inv_grid->DateIn->Required) { ?>
			elm = this.getElements("x" + infix + "_DateIn");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $tbl_order_po_inv->DateIn->caption(), $tbl_order_po_inv->DateIn->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($tbl_order_po_inv_grid->PCS_In->Required) { ?>
			elm = this.getElements("x" + infix + "_PCS_In");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $tbl_order_po_inv->PCS_In->caption(), $tbl_order_po_inv->PCS_In->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($tbl_order_po_inv_grid->PCS_Out->Required) { ?>
			elm = this.getElements("x" + infix + "_PCS_Out");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $tbl_order_po_inv->PCS_Out->caption(), $tbl_order_po_inv->PCS_Out->RequiredErrorMessage)) ?>");
		<?php } ?>
			elm = this.getElements("x" + infix + "_PCS_Out");
			if (elm && !ew.checkInteger(elm.value))
				return this.onError(elm, "<?php echo JsEncode($tbl_order_po_inv->PCS_Out->errorMessage()) ?>");
		<?php if ($tbl_order_po_inv_grid->PO_No->Required) { ?>
			elm = this.getElements("x" + infix + "_PO_No");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $tbl_order_po_inv->PO_No->caption(), $tbl_order_po_inv->PO_No->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($tbl_order_po_inv_grid->INV_No->Required) { ?>
			elm = this.getElements("x" + infix + "_INV_No");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $tbl_order_po_inv->INV_No->caption(), $tbl_order_po_inv->INV_No->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($tbl_order_po_inv_grid->PO_InputDate->Required) { ?>
			elm = this.getElements("x" + infix + "_PO_InputDate");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $tbl_order_po_inv->PO_InputDate->caption(), $tbl_order_po_inv->PO_InputDate->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($tbl_order_po_inv_grid->PO_InputUser->Required) { ?>
			elm = this.getElements("x" + infix + "_PO_InputUser");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $tbl_order_po_inv->PO_InputUser->caption(), $tbl_order_po_inv->PO_InputUser->RequiredErrorMessage)) ?>");
		<?php } ?>

			// Fire Form_CustomValidate event
			if (!this.Form_CustomValidate(fobj))
				return false;
		} // End Grid Add checking
	}
	return true;
}

// Check empty row
ftbl_order_po_invgrid.emptyRow = function(infix) {
	var fobj = this._form;
	if (ew.valueChanged(fobj, infix, "Code", false)) return false;
	if (ew.valueChanged(fobj, infix, "PalletNo", false)) return false;
	if (ew.valueChanged(fobj, infix, "DateIn", false)) return false;
	if (ew.valueChanged(fobj, infix, "PCS_In", false)) return false;
	if (ew.valueChanged(fobj, infix, "PCS_Out", false)) return false;
	if (ew.valueChanged(fobj, infix, "PO_No", false)) return false;
	if (ew.valueChanged(fobj, infix, "INV_No", false)) return false;
	return true;
}

// Form_CustomValidate event
ftbl_order_po_invgrid.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

	// Your custom validation code here, return false if invalid.
	return true;
}

// Use JavaScript validation or not
ftbl_order_po_invgrid.validateRequired = <?php echo json_encode(CLIENT_VALIDATE) ?>;

// Dynamic selection lists
// Form object for search

</script>
<?php } ?>
<?php
$tbl_order_po_inv_grid->renderOtherOptions();
?>
<?php $tbl_order_po_inv_grid->showPageHeader(); ?>
<?php
$tbl_order_po_inv_grid->showMessage();
?>
<?php if ($tbl_order_po_inv_grid->TotalRecs > 0 || $tbl_order_po_inv->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($tbl_order_po_inv_grid->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> tbl_order_po_inv">
<?php if ($tbl_order_po_inv_grid->ShowOtherOptions) { ?>
<div class="card-header ew-grid-upper-panel">
<?php $tbl_order_po_inv_grid->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<div id="ftbl_order_po_invgrid" class="ew-form ew-list-form form-inline">
<div id="gmp_tbl_order_po_inv" class="<?php if (IsResponsiveLayout()) { ?>table-responsive <?php } ?>card-body ew-grid-middle-panel">
<table id="tbl_tbl_order_po_invgrid" class="table ew-table"><!-- .ew-table ##-->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$tbl_order_po_inv_grid->RowType = ROWTYPE_HEADER;

// Render list options
$tbl_order_po_inv_grid->renderListOptions();

// Render list options (header, left)
$tbl_order_po_inv_grid->ListOptions->render("header", "left");
?>
<?php if ($tbl_order_po_inv->Code->Visible) { // Code ?>
	<?php if ($tbl_order_po_inv->sortUrl($tbl_order_po_inv->Code) == "") { ?>
		<th data-name="Code" class="<?php echo $tbl_order_po_inv->Code->headerCellClass() ?>" style="white-space: nowrap;"><div id="elh_tbl_order_po_inv_Code" class="tbl_order_po_inv_Code"><div class="ew-table-header-caption"><?php echo $tbl_order_po_inv->Code->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Code" class="<?php echo $tbl_order_po_inv->Code->headerCellClass() ?>" style="white-space: nowrap;"><div><div id="elh_tbl_order_po_inv_Code" class="tbl_order_po_inv_Code">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $tbl_order_po_inv->Code->caption() ?></span><span class="ew-table-header-sort"><?php if ($tbl_order_po_inv->Code->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($tbl_order_po_inv->Code->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($tbl_order_po_inv->PalletNo->Visible) { // PalletNo ?>
	<?php if ($tbl_order_po_inv->sortUrl($tbl_order_po_inv->PalletNo) == "") { ?>
		<th data-name="PalletNo" class="<?php echo $tbl_order_po_inv->PalletNo->headerCellClass() ?>" style="white-space: nowrap;"><div id="elh_tbl_order_po_inv_PalletNo" class="tbl_order_po_inv_PalletNo"><div class="ew-table-header-caption"><?php echo $tbl_order_po_inv->PalletNo->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="PalletNo" class="<?php echo $tbl_order_po_inv->PalletNo->headerCellClass() ?>" style="white-space: nowrap;"><div><div id="elh_tbl_order_po_inv_PalletNo" class="tbl_order_po_inv_PalletNo">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $tbl_order_po_inv->PalletNo->caption() ?></span><span class="ew-table-header-sort"><?php if ($tbl_order_po_inv->PalletNo->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($tbl_order_po_inv->PalletNo->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($tbl_order_po_inv->DateIn->Visible) { // DateIn ?>
	<?php if ($tbl_order_po_inv->sortUrl($tbl_order_po_inv->DateIn) == "") { ?>
		<th data-name="DateIn" class="<?php echo $tbl_order_po_inv->DateIn->headerCellClass() ?>" style="white-space: nowrap;"><div id="elh_tbl_order_po_inv_DateIn" class="tbl_order_po_inv_DateIn"><div class="ew-table-header-caption"><?php echo $tbl_order_po_inv->DateIn->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="DateIn" class="<?php echo $tbl_order_po_inv->DateIn->headerCellClass() ?>" style="white-space: nowrap;"><div><div id="elh_tbl_order_po_inv_DateIn" class="tbl_order_po_inv_DateIn">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $tbl_order_po_inv->DateIn->caption() ?></span><span class="ew-table-header-sort"><?php if ($tbl_order_po_inv->DateIn->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($tbl_order_po_inv->DateIn->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($tbl_order_po_inv->PCS_In->Visible) { // PCS_In ?>
	<?php if ($tbl_order_po_inv->sortUrl($tbl_order_po_inv->PCS_In) == "") { ?>
		<th data-name="PCS_In" class="<?php echo $tbl_order_po_inv->PCS_In->headerCellClass() ?>" style="white-space: nowrap;"><div id="elh_tbl_order_po_inv_PCS_In" class="tbl_order_po_inv_PCS_In"><div class="ew-table-header-caption"><?php echo $tbl_order_po_inv->PCS_In->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="PCS_In" class="<?php echo $tbl_order_po_inv->PCS_In->headerCellClass() ?>" style="white-space: nowrap;"><div><div id="elh_tbl_order_po_inv_PCS_In" class="tbl_order_po_inv_PCS_In">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $tbl_order_po_inv->PCS_In->caption() ?></span><span class="ew-table-header-sort"><?php if ($tbl_order_po_inv->PCS_In->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($tbl_order_po_inv->PCS_In->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($tbl_order_po_inv->PCS_Out->Visible) { // PCS_Out ?>
	<?php if ($tbl_order_po_inv->sortUrl($tbl_order_po_inv->PCS_Out) == "") { ?>
		<th data-name="PCS_Out" class="<?php echo $tbl_order_po_inv->PCS_Out->headerCellClass() ?>" style="white-space: nowrap;"><div id="elh_tbl_order_po_inv_PCS_Out" class="tbl_order_po_inv_PCS_Out"><div class="ew-table-header-caption"><?php echo $tbl_order_po_inv->PCS_Out->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="PCS_Out" class="<?php echo $tbl_order_po_inv->PCS_Out->headerCellClass() ?>" style="white-space: nowrap;"><div><div id="elh_tbl_order_po_inv_PCS_Out" class="tbl_order_po_inv_PCS_Out">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $tbl_order_po_inv->PCS_Out->caption() ?></span><span class="ew-table-header-sort"><?php if ($tbl_order_po_inv->PCS_Out->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($tbl_order_po_inv->PCS_Out->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($tbl_order_po_inv->PO_No->Visible) { // PO_No ?>
	<?php if ($tbl_order_po_inv->sortUrl($tbl_order_po_inv->PO_No) == "") { ?>
		<th data-name="PO_No" class="<?php echo $tbl_order_po_inv->PO_No->headerCellClass() ?>" style="white-space: nowrap;"><div id="elh_tbl_order_po_inv_PO_No" class="tbl_order_po_inv_PO_No"><div class="ew-table-header-caption"><?php echo $tbl_order_po_inv->PO_No->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="PO_No" class="<?php echo $tbl_order_po_inv->PO_No->headerCellClass() ?>" style="white-space: nowrap;"><div><div id="elh_tbl_order_po_inv_PO_No" class="tbl_order_po_inv_PO_No">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $tbl_order_po_inv->PO_No->caption() ?></span><span class="ew-table-header-sort"><?php if ($tbl_order_po_inv->PO_No->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($tbl_order_po_inv->PO_No->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($tbl_order_po_inv->INV_No->Visible) { // INV_No ?>
	<?php if ($tbl_order_po_inv->sortUrl($tbl_order_po_inv->INV_No) == "") { ?>
		<th data-name="INV_No" class="<?php echo $tbl_order_po_inv->INV_No->headerCellClass() ?>" style="white-space: nowrap;"><div id="elh_tbl_order_po_inv_INV_No" class="tbl_order_po_inv_INV_No"><div class="ew-table-header-caption"><?php echo $tbl_order_po_inv->INV_No->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="INV_No" class="<?php echo $tbl_order_po_inv->INV_No->headerCellClass() ?>" style="white-space: nowrap;"><div><div id="elh_tbl_order_po_inv_INV_No" class="tbl_order_po_inv_INV_No">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $tbl_order_po_inv->INV_No->caption() ?></span><span class="ew-table-header-sort"><?php if ($tbl_order_po_inv->INV_No->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($tbl_order_po_inv->INV_No->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($tbl_order_po_inv->PO_InputDate->Visible) { // PO_InputDate ?>
	<?php if ($tbl_order_po_inv->sortUrl($tbl_order_po_inv->PO_InputDate) == "") { ?>
		<th data-name="PO_InputDate" class="<?php echo $tbl_order_po_inv->PO_InputDate->headerCellClass() ?>" style="white-space: nowrap;"><div id="elh_tbl_order_po_inv_PO_InputDate" class="tbl_order_po_inv_PO_InputDate"><div class="ew-table-header-caption"><?php echo $tbl_order_po_inv->PO_InputDate->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="PO_InputDate" class="<?php echo $tbl_order_po_inv->PO_InputDate->headerCellClass() ?>" style="white-space: nowrap;"><div><div id="elh_tbl_order_po_inv_PO_InputDate" class="tbl_order_po_inv_PO_InputDate">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $tbl_order_po_inv->PO_InputDate->caption() ?></span><span class="ew-table-header-sort"><?php if ($tbl_order_po_inv->PO_InputDate->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($tbl_order_po_inv->PO_InputDate->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($tbl_order_po_inv->PO_InputUser->Visible) { // PO_InputUser ?>
	<?php if ($tbl_order_po_inv->sortUrl($tbl_order_po_inv->PO_InputUser) == "") { ?>
		<th data-name="PO_InputUser" class="<?php echo $tbl_order_po_inv->PO_InputUser->headerCellClass() ?>" style="white-space: nowrap;"><div id="elh_tbl_order_po_inv_PO_InputUser" class="tbl_order_po_inv_PO_InputUser"><div class="ew-table-header-caption"><?php echo $tbl_order_po_inv->PO_InputUser->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="PO_InputUser" class="<?php echo $tbl_order_po_inv->PO_InputUser->headerCellClass() ?>" style="white-space: nowrap;"><div><div id="elh_tbl_order_po_inv_PO_InputUser" class="tbl_order_po_inv_PO_InputUser">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $tbl_order_po_inv->PO_InputUser->caption() ?></span><span class="ew-table-header-sort"><?php if ($tbl_order_po_inv->PO_InputUser->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($tbl_order_po_inv->PO_InputUser->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$tbl_order_po_inv_grid->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
$tbl_order_po_inv_grid->StartRec = 1;
$tbl_order_po_inv_grid->StopRec = $tbl_order_po_inv_grid->TotalRecs; // Show all records

// Restore number of post back records
if ($CurrentForm && $tbl_order_po_inv_grid->EventCancelled) {
	$CurrentForm->Index = -1;
	if ($CurrentForm->hasValue($tbl_order_po_inv_grid->FormKeyCountName) && ($tbl_order_po_inv->isGridAdd() || $tbl_order_po_inv->isGridEdit() || $tbl_order_po_inv->isConfirm())) {
		$tbl_order_po_inv_grid->KeyCount = $CurrentForm->getValue($tbl_order_po_inv_grid->FormKeyCountName);
		$tbl_order_po_inv_grid->StopRec = $tbl_order_po_inv_grid->StartRec + $tbl_order_po_inv_grid->KeyCount - 1;
	}
}
$tbl_order_po_inv_grid->RecCnt = $tbl_order_po_inv_grid->StartRec - 1;
if ($tbl_order_po_inv_grid->Recordset && !$tbl_order_po_inv_grid->Recordset->EOF) {
	$tbl_order_po_inv_grid->Recordset->moveFirst();
	$selectLimit = $tbl_order_po_inv_grid->UseSelectLimit;
	if (!$selectLimit && $tbl_order_po_inv_grid->StartRec > 1)
		$tbl_order_po_inv_grid->Recordset->move($tbl_order_po_inv_grid->StartRec - 1);
} elseif (!$tbl_order_po_inv->AllowAddDeleteRow && $tbl_order_po_inv_grid->StopRec == 0) {
	$tbl_order_po_inv_grid->StopRec = $tbl_order_po_inv->GridAddRowCount;
}

// Initialize aggregate
$tbl_order_po_inv->RowType = ROWTYPE_AGGREGATEINIT;
$tbl_order_po_inv->resetAttributes();
$tbl_order_po_inv_grid->renderRow();
if ($tbl_order_po_inv->isGridAdd())
	$tbl_order_po_inv_grid->RowIndex = 0;
if ($tbl_order_po_inv->isGridEdit())
	$tbl_order_po_inv_grid->RowIndex = 0;
while ($tbl_order_po_inv_grid->RecCnt < $tbl_order_po_inv_grid->StopRec) {
	$tbl_order_po_inv_grid->RecCnt++;
	if ($tbl_order_po_inv_grid->RecCnt >= $tbl_order_po_inv_grid->StartRec) {
		$tbl_order_po_inv_grid->RowCnt++;
		if ($tbl_order_po_inv->isGridAdd() || $tbl_order_po_inv->isGridEdit() || $tbl_order_po_inv->isConfirm()) {
			$tbl_order_po_inv_grid->RowIndex++;
			$CurrentForm->Index = $tbl_order_po_inv_grid->RowIndex;
			if ($CurrentForm->hasValue($tbl_order_po_inv_grid->FormActionName) && $tbl_order_po_inv_grid->EventCancelled)
				$tbl_order_po_inv_grid->RowAction = strval($CurrentForm->getValue($tbl_order_po_inv_grid->FormActionName));
			elseif ($tbl_order_po_inv->isGridAdd())
				$tbl_order_po_inv_grid->RowAction = "insert";
			else
				$tbl_order_po_inv_grid->RowAction = "";
		}

		// Set up key count
		$tbl_order_po_inv_grid->KeyCount = $tbl_order_po_inv_grid->RowIndex;

		// Init row class and style
		$tbl_order_po_inv->resetAttributes();
		$tbl_order_po_inv->CssClass = "";
		if ($tbl_order_po_inv->isGridAdd()) {
			if ($tbl_order_po_inv->CurrentMode == "copy") {
				$tbl_order_po_inv_grid->loadRowValues($tbl_order_po_inv_grid->Recordset); // Load row values
				$tbl_order_po_inv_grid->setRecordKey($tbl_order_po_inv_grid->RowOldKey, $tbl_order_po_inv_grid->Recordset); // Set old record key
			} else {
				$tbl_order_po_inv_grid->loadRowValues(); // Load default values
				$tbl_order_po_inv_grid->RowOldKey = ""; // Clear old key value
			}
		} else {
			$tbl_order_po_inv_grid->loadRowValues($tbl_order_po_inv_grid->Recordset); // Load row values
		}
		$tbl_order_po_inv->RowType = ROWTYPE_VIEW; // Render view
		if ($tbl_order_po_inv->isGridAdd()) // Grid add
			$tbl_order_po_inv->RowType = ROWTYPE_ADD; // Render add
		if ($tbl_order_po_inv->isGridAdd() && $tbl_order_po_inv->EventCancelled && !$CurrentForm->hasValue("k_blankrow")) // Insert failed
			$tbl_order_po_inv_grid->restoreCurrentRowFormValues($tbl_order_po_inv_grid->RowIndex); // Restore form values
		if ($tbl_order_po_inv->isGridEdit()) { // Grid edit
			if ($tbl_order_po_inv->EventCancelled)
				$tbl_order_po_inv_grid->restoreCurrentRowFormValues($tbl_order_po_inv_grid->RowIndex); // Restore form values
			if ($tbl_order_po_inv_grid->RowAction == "insert")
				$tbl_order_po_inv->RowType = ROWTYPE_ADD; // Render add
			else
				$tbl_order_po_inv->RowType = ROWTYPE_EDIT; // Render edit
		}
		if ($tbl_order_po_inv->isGridEdit() && ($tbl_order_po_inv->RowType == ROWTYPE_EDIT || $tbl_order_po_inv->RowType == ROWTYPE_ADD) && $tbl_order_po_inv->EventCancelled) // Update failed
			$tbl_order_po_inv_grid->restoreCurrentRowFormValues($tbl_order_po_inv_grid->RowIndex); // Restore form values
		if ($tbl_order_po_inv->RowType == ROWTYPE_EDIT) // Edit row
			$tbl_order_po_inv_grid->EditRowCnt++;
		if ($tbl_order_po_inv->isConfirm()) // Confirm row
			$tbl_order_po_inv_grid->restoreCurrentRowFormValues($tbl_order_po_inv_grid->RowIndex); // Restore form values

		// Set up row id / data-rowindex
		$tbl_order_po_inv->RowAttrs = array_merge($tbl_order_po_inv->RowAttrs, array('data-rowindex'=>$tbl_order_po_inv_grid->RowCnt, 'id'=>'r' . $tbl_order_po_inv_grid->RowCnt . '_tbl_order_po_inv', 'data-rowtype'=>$tbl_order_po_inv->RowType));

		// Render row
		$tbl_order_po_inv_grid->renderRow();

		// Render list options
		$tbl_order_po_inv_grid->renderListOptions();

		// Skip delete row / empty row for confirm page
		if ($tbl_order_po_inv_grid->RowAction <> "delete" && $tbl_order_po_inv_grid->RowAction <> "insertdelete" && !($tbl_order_po_inv_grid->RowAction == "insert" && $tbl_order_po_inv->isConfirm() && $tbl_order_po_inv_grid->emptyRow())) {
?>
	<tr<?php echo $tbl_order_po_inv->rowAttributes() ?>>
<?php

// Render list options (body, left)
$tbl_order_po_inv_grid->ListOptions->render("body", "left", $tbl_order_po_inv_grid->RowCnt);
?>
	<?php if ($tbl_order_po_inv->Code->Visible) { // Code ?>
		<td data-name="Code"<?php echo $tbl_order_po_inv->Code->cellAttributes() ?>>
<?php if ($tbl_order_po_inv->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $tbl_order_po_inv_grid->RowCnt ?>_tbl_order_po_inv_Code" class="form-group tbl_order_po_inv_Code">
<input type="text" data-table="tbl_order_po_inv" data-field="x_Code" name="x<?php echo $tbl_order_po_inv_grid->RowIndex ?>_Code" id="x<?php echo $tbl_order_po_inv_grid->RowIndex ?>_Code" size="10" maxlength="50" placeholder="<?php echo HtmlEncode($tbl_order_po_inv->Code->getPlaceHolder()) ?>" value="<?php echo $tbl_order_po_inv->Code->EditValue ?>"<?php echo $tbl_order_po_inv->Code->editAttributes() ?>>
</span>
<input type="hidden" data-table="tbl_order_po_inv" data-field="x_Code" name="o<?php echo $tbl_order_po_inv_grid->RowIndex ?>_Code" id="o<?php echo $tbl_order_po_inv_grid->RowIndex ?>_Code" value="<?php echo HtmlEncode($tbl_order_po_inv->Code->OldValue) ?>">
<?php } ?>
<?php if ($tbl_order_po_inv->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $tbl_order_po_inv_grid->RowCnt ?>_tbl_order_po_inv_Code" class="form-group tbl_order_po_inv_Code">
<span<?php echo $tbl_order_po_inv->Code->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?php echo RemoveHtml($tbl_order_po_inv->Code->EditValue) ?>"></span>
</span>
<input type="hidden" data-table="tbl_order_po_inv" data-field="x_Code" name="x<?php echo $tbl_order_po_inv_grid->RowIndex ?>_Code" id="x<?php echo $tbl_order_po_inv_grid->RowIndex ?>_Code" value="<?php echo HtmlEncode($tbl_order_po_inv->Code->CurrentValue) ?>">
<?php } ?>
<?php if ($tbl_order_po_inv->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $tbl_order_po_inv_grid->RowCnt ?>_tbl_order_po_inv_Code" class="tbl_order_po_inv_Code">
<span<?php echo $tbl_order_po_inv->Code->viewAttributes() ?>>
<?php echo $tbl_order_po_inv->Code->getViewValue() ?></span>
</span>
<?php if (!$tbl_order_po_inv->isConfirm()) { ?>
<input type="hidden" data-table="tbl_order_po_inv" data-field="x_Code" name="x<?php echo $tbl_order_po_inv_grid->RowIndex ?>_Code" id="x<?php echo $tbl_order_po_inv_grid->RowIndex ?>_Code" value="<?php echo HtmlEncode($tbl_order_po_inv->Code->FormValue) ?>">
<input type="hidden" data-table="tbl_order_po_inv" data-field="x_Code" name="o<?php echo $tbl_order_po_inv_grid->RowIndex ?>_Code" id="o<?php echo $tbl_order_po_inv_grid->RowIndex ?>_Code" value="<?php echo HtmlEncode($tbl_order_po_inv->Code->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="tbl_order_po_inv" data-field="x_Code" name="ftbl_order_po_invgrid$x<?php echo $tbl_order_po_inv_grid->RowIndex ?>_Code" id="ftbl_order_po_invgrid$x<?php echo $tbl_order_po_inv_grid->RowIndex ?>_Code" value="<?php echo HtmlEncode($tbl_order_po_inv->Code->FormValue) ?>">
<input type="hidden" data-table="tbl_order_po_inv" data-field="x_Code" name="ftbl_order_po_invgrid$o<?php echo $tbl_order_po_inv_grid->RowIndex ?>_Code" id="ftbl_order_po_invgrid$o<?php echo $tbl_order_po_inv_grid->RowIndex ?>_Code" value="<?php echo HtmlEncode($tbl_order_po_inv->Code->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
<?php if ($tbl_order_po_inv->RowType == ROWTYPE_ADD) { // Add record ?>
<input type="hidden" data-table="tbl_order_po_inv" data-field="x_ID_PoInv" name="x<?php echo $tbl_order_po_inv_grid->RowIndex ?>_ID_PoInv" id="x<?php echo $tbl_order_po_inv_grid->RowIndex ?>_ID_PoInv" value="<?php echo HtmlEncode($tbl_order_po_inv->ID_PoInv->CurrentValue) ?>">
<input type="hidden" data-table="tbl_order_po_inv" data-field="x_ID_PoInv" name="o<?php echo $tbl_order_po_inv_grid->RowIndex ?>_ID_PoInv" id="o<?php echo $tbl_order_po_inv_grid->RowIndex ?>_ID_PoInv" value="<?php echo HtmlEncode($tbl_order_po_inv->ID_PoInv->OldValue) ?>">
<?php } ?>
<?php if ($tbl_order_po_inv->RowType == ROWTYPE_EDIT || $tbl_order_po_inv->CurrentMode == "edit") { ?>
<input type="hidden" data-table="tbl_order_po_inv" data-field="x_ID_PoInv" name="x<?php echo $tbl_order_po_inv_grid->RowIndex ?>_ID_PoInv" id="x<?php echo $tbl_order_po_inv_grid->RowIndex ?>_ID_PoInv" value="<?php echo HtmlEncode($tbl_order_po_inv->ID_PoInv->CurrentValue) ?>">
<?php } ?>
	<?php if ($tbl_order_po_inv->PalletNo->Visible) { // PalletNo ?>
		<td data-name="PalletNo"<?php echo $tbl_order_po_inv->PalletNo->cellAttributes() ?>>
<?php if ($tbl_order_po_inv->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $tbl_order_po_inv_grid->RowCnt ?>_tbl_order_po_inv_PalletNo" class="form-group tbl_order_po_inv_PalletNo">
<input type="text" data-table="tbl_order_po_inv" data-field="x_PalletNo" name="x<?php echo $tbl_order_po_inv_grid->RowIndex ?>_PalletNo" id="x<?php echo $tbl_order_po_inv_grid->RowIndex ?>_PalletNo" size="30" maxlength="50" placeholder="<?php echo HtmlEncode($tbl_order_po_inv->PalletNo->getPlaceHolder()) ?>" value="<?php echo $tbl_order_po_inv->PalletNo->EditValue ?>"<?php echo $tbl_order_po_inv->PalletNo->editAttributes() ?>>
</span>
<input type="hidden" data-table="tbl_order_po_inv" data-field="x_PalletNo" name="o<?php echo $tbl_order_po_inv_grid->RowIndex ?>_PalletNo" id="o<?php echo $tbl_order_po_inv_grid->RowIndex ?>_PalletNo" value="<?php echo HtmlEncode($tbl_order_po_inv->PalletNo->OldValue) ?>">
<?php } ?>
<?php if ($tbl_order_po_inv->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $tbl_order_po_inv_grid->RowCnt ?>_tbl_order_po_inv_PalletNo" class="form-group tbl_order_po_inv_PalletNo">
<span<?php echo $tbl_order_po_inv->PalletNo->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?php echo RemoveHtml($tbl_order_po_inv->PalletNo->EditValue) ?>"></span>
</span>
<input type="hidden" data-table="tbl_order_po_inv" data-field="x_PalletNo" name="x<?php echo $tbl_order_po_inv_grid->RowIndex ?>_PalletNo" id="x<?php echo $tbl_order_po_inv_grid->RowIndex ?>_PalletNo" value="<?php echo HtmlEncode($tbl_order_po_inv->PalletNo->CurrentValue) ?>">
<?php } ?>
<?php if ($tbl_order_po_inv->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $tbl_order_po_inv_grid->RowCnt ?>_tbl_order_po_inv_PalletNo" class="tbl_order_po_inv_PalletNo">
<span<?php echo $tbl_order_po_inv->PalletNo->viewAttributes() ?>>
<?php echo $tbl_order_po_inv->PalletNo->getViewValue() ?></span>
</span>
<?php if (!$tbl_order_po_inv->isConfirm()) { ?>
<input type="hidden" data-table="tbl_order_po_inv" data-field="x_PalletNo" name="x<?php echo $tbl_order_po_inv_grid->RowIndex ?>_PalletNo" id="x<?php echo $tbl_order_po_inv_grid->RowIndex ?>_PalletNo" value="<?php echo HtmlEncode($tbl_order_po_inv->PalletNo->FormValue) ?>">
<input type="hidden" data-table="tbl_order_po_inv" data-field="x_PalletNo" name="o<?php echo $tbl_order_po_inv_grid->RowIndex ?>_PalletNo" id="o<?php echo $tbl_order_po_inv_grid->RowIndex ?>_PalletNo" value="<?php echo HtmlEncode($tbl_order_po_inv->PalletNo->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="tbl_order_po_inv" data-field="x_PalletNo" name="ftbl_order_po_invgrid$x<?php echo $tbl_order_po_inv_grid->RowIndex ?>_PalletNo" id="ftbl_order_po_invgrid$x<?php echo $tbl_order_po_inv_grid->RowIndex ?>_PalletNo" value="<?php echo HtmlEncode($tbl_order_po_inv->PalletNo->FormValue) ?>">
<input type="hidden" data-table="tbl_order_po_inv" data-field="x_PalletNo" name="ftbl_order_po_invgrid$o<?php echo $tbl_order_po_inv_grid->RowIndex ?>_PalletNo" id="ftbl_order_po_invgrid$o<?php echo $tbl_order_po_inv_grid->RowIndex ?>_PalletNo" value="<?php echo HtmlEncode($tbl_order_po_inv->PalletNo->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($tbl_order_po_inv->DateIn->Visible) { // DateIn ?>
		<td data-name="DateIn"<?php echo $tbl_order_po_inv->DateIn->cellAttributes() ?>>
<?php if ($tbl_order_po_inv->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $tbl_order_po_inv_grid->RowCnt ?>_tbl_order_po_inv_DateIn" class="form-group tbl_order_po_inv_DateIn">
<input type="text" data-table="tbl_order_po_inv" data-field="x_DateIn" data-format="7" name="x<?php echo $tbl_order_po_inv_grid->RowIndex ?>_DateIn" id="x<?php echo $tbl_order_po_inv_grid->RowIndex ?>_DateIn" placeholder="<?php echo HtmlEncode($tbl_order_po_inv->DateIn->getPlaceHolder()) ?>" value="<?php echo $tbl_order_po_inv->DateIn->EditValue ?>"<?php echo $tbl_order_po_inv->DateIn->editAttributes() ?>>
<?php if (!$tbl_order_po_inv->DateIn->ReadOnly && !$tbl_order_po_inv->DateIn->Disabled && !isset($tbl_order_po_inv->DateIn->EditAttrs["readonly"]) && !isset($tbl_order_po_inv->DateIn->EditAttrs["disabled"])) { ?>
<script>
ew.createDateTimePicker("ftbl_order_po_invgrid", "x<?php echo $tbl_order_po_inv_grid->RowIndex ?>_DateIn", {"ignoreReadonly":true,"useCurrent":false,"format":7});
</script>
<?php } ?>
</span>
<input type="hidden" data-table="tbl_order_po_inv" data-field="x_DateIn" name="o<?php echo $tbl_order_po_inv_grid->RowIndex ?>_DateIn" id="o<?php echo $tbl_order_po_inv_grid->RowIndex ?>_DateIn" value="<?php echo HtmlEncode($tbl_order_po_inv->DateIn->OldValue) ?>">
<?php } ?>
<?php if ($tbl_order_po_inv->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $tbl_order_po_inv_grid->RowCnt ?>_tbl_order_po_inv_DateIn" class="form-group tbl_order_po_inv_DateIn">
<span<?php echo $tbl_order_po_inv->DateIn->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?php echo RemoveHtml($tbl_order_po_inv->DateIn->EditValue) ?>"></span>
</span>
<input type="hidden" data-table="tbl_order_po_inv" data-field="x_DateIn" name="x<?php echo $tbl_order_po_inv_grid->RowIndex ?>_DateIn" id="x<?php echo $tbl_order_po_inv_grid->RowIndex ?>_DateIn" value="<?php echo HtmlEncode($tbl_order_po_inv->DateIn->CurrentValue) ?>">
<?php } ?>
<?php if ($tbl_order_po_inv->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $tbl_order_po_inv_grid->RowCnt ?>_tbl_order_po_inv_DateIn" class="tbl_order_po_inv_DateIn">
<span<?php echo $tbl_order_po_inv->DateIn->viewAttributes() ?>>
<?php echo $tbl_order_po_inv->DateIn->getViewValue() ?></span>
</span>
<?php if (!$tbl_order_po_inv->isConfirm()) { ?>
<input type="hidden" data-table="tbl_order_po_inv" data-field="x_DateIn" name="x<?php echo $tbl_order_po_inv_grid->RowIndex ?>_DateIn" id="x<?php echo $tbl_order_po_inv_grid->RowIndex ?>_DateIn" value="<?php echo HtmlEncode($tbl_order_po_inv->DateIn->FormValue) ?>">
<input type="hidden" data-table="tbl_order_po_inv" data-field="x_DateIn" name="o<?php echo $tbl_order_po_inv_grid->RowIndex ?>_DateIn" id="o<?php echo $tbl_order_po_inv_grid->RowIndex ?>_DateIn" value="<?php echo HtmlEncode($tbl_order_po_inv->DateIn->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="tbl_order_po_inv" data-field="x_DateIn" name="ftbl_order_po_invgrid$x<?php echo $tbl_order_po_inv_grid->RowIndex ?>_DateIn" id="ftbl_order_po_invgrid$x<?php echo $tbl_order_po_inv_grid->RowIndex ?>_DateIn" value="<?php echo HtmlEncode($tbl_order_po_inv->DateIn->FormValue) ?>">
<input type="hidden" data-table="tbl_order_po_inv" data-field="x_DateIn" name="ftbl_order_po_invgrid$o<?php echo $tbl_order_po_inv_grid->RowIndex ?>_DateIn" id="ftbl_order_po_invgrid$o<?php echo $tbl_order_po_inv_grid->RowIndex ?>_DateIn" value="<?php echo HtmlEncode($tbl_order_po_inv->DateIn->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($tbl_order_po_inv->PCS_In->Visible) { // PCS_In ?>
		<td data-name="PCS_In"<?php echo $tbl_order_po_inv->PCS_In->cellAttributes() ?>>
<?php if ($tbl_order_po_inv->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $tbl_order_po_inv_grid->RowCnt ?>_tbl_order_po_inv_PCS_In" class="form-group tbl_order_po_inv_PCS_In">
<input type="text" data-table="tbl_order_po_inv" data-field="x_PCS_In" name="x<?php echo $tbl_order_po_inv_grid->RowIndex ?>_PCS_In" id="x<?php echo $tbl_order_po_inv_grid->RowIndex ?>_PCS_In" size="5" placeholder="<?php echo HtmlEncode($tbl_order_po_inv->PCS_In->getPlaceHolder()) ?>" value="<?php echo $tbl_order_po_inv->PCS_In->EditValue ?>"<?php echo $tbl_order_po_inv->PCS_In->editAttributes() ?>>
</span>
<input type="hidden" data-table="tbl_order_po_inv" data-field="x_PCS_In" name="o<?php echo $tbl_order_po_inv_grid->RowIndex ?>_PCS_In" id="o<?php echo $tbl_order_po_inv_grid->RowIndex ?>_PCS_In" value="<?php echo HtmlEncode($tbl_order_po_inv->PCS_In->OldValue) ?>">
<?php } ?>
<?php if ($tbl_order_po_inv->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $tbl_order_po_inv_grid->RowCnt ?>_tbl_order_po_inv_PCS_In" class="form-group tbl_order_po_inv_PCS_In">
<span<?php echo $tbl_order_po_inv->PCS_In->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?php echo RemoveHtml($tbl_order_po_inv->PCS_In->EditValue) ?>"></span>
</span>
<input type="hidden" data-table="tbl_order_po_inv" data-field="x_PCS_In" name="x<?php echo $tbl_order_po_inv_grid->RowIndex ?>_PCS_In" id="x<?php echo $tbl_order_po_inv_grid->RowIndex ?>_PCS_In" value="<?php echo HtmlEncode($tbl_order_po_inv->PCS_In->CurrentValue) ?>">
<?php } ?>
<?php if ($tbl_order_po_inv->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $tbl_order_po_inv_grid->RowCnt ?>_tbl_order_po_inv_PCS_In" class="tbl_order_po_inv_PCS_In">
<span<?php echo $tbl_order_po_inv->PCS_In->viewAttributes() ?>>
<?php echo $tbl_order_po_inv->PCS_In->getViewValue() ?></span>
</span>
<?php if (!$tbl_order_po_inv->isConfirm()) { ?>
<input type="hidden" data-table="tbl_order_po_inv" data-field="x_PCS_In" name="x<?php echo $tbl_order_po_inv_grid->RowIndex ?>_PCS_In" id="x<?php echo $tbl_order_po_inv_grid->RowIndex ?>_PCS_In" value="<?php echo HtmlEncode($tbl_order_po_inv->PCS_In->FormValue) ?>">
<input type="hidden" data-table="tbl_order_po_inv" data-field="x_PCS_In" name="o<?php echo $tbl_order_po_inv_grid->RowIndex ?>_PCS_In" id="o<?php echo $tbl_order_po_inv_grid->RowIndex ?>_PCS_In" value="<?php echo HtmlEncode($tbl_order_po_inv->PCS_In->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="tbl_order_po_inv" data-field="x_PCS_In" name="ftbl_order_po_invgrid$x<?php echo $tbl_order_po_inv_grid->RowIndex ?>_PCS_In" id="ftbl_order_po_invgrid$x<?php echo $tbl_order_po_inv_grid->RowIndex ?>_PCS_In" value="<?php echo HtmlEncode($tbl_order_po_inv->PCS_In->FormValue) ?>">
<input type="hidden" data-table="tbl_order_po_inv" data-field="x_PCS_In" name="ftbl_order_po_invgrid$o<?php echo $tbl_order_po_inv_grid->RowIndex ?>_PCS_In" id="ftbl_order_po_invgrid$o<?php echo $tbl_order_po_inv_grid->RowIndex ?>_PCS_In" value="<?php echo HtmlEncode($tbl_order_po_inv->PCS_In->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($tbl_order_po_inv->PCS_Out->Visible) { // PCS_Out ?>
		<td data-name="PCS_Out"<?php echo $tbl_order_po_inv->PCS_Out->cellAttributes() ?>>
<?php if ($tbl_order_po_inv->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $tbl_order_po_inv_grid->RowCnt ?>_tbl_order_po_inv_PCS_Out" class="form-group tbl_order_po_inv_PCS_Out">
<input type="text" data-table="tbl_order_po_inv" data-field="x_PCS_Out" name="x<?php echo $tbl_order_po_inv_grid->RowIndex ?>_PCS_Out" id="x<?php echo $tbl_order_po_inv_grid->RowIndex ?>_PCS_Out" size="5" placeholder="<?php echo HtmlEncode($tbl_order_po_inv->PCS_Out->getPlaceHolder()) ?>" value="<?php echo $tbl_order_po_inv->PCS_Out->EditValue ?>"<?php echo $tbl_order_po_inv->PCS_Out->editAttributes() ?>>
</span>
<input type="hidden" data-table="tbl_order_po_inv" data-field="x_PCS_Out" name="o<?php echo $tbl_order_po_inv_grid->RowIndex ?>_PCS_Out" id="o<?php echo $tbl_order_po_inv_grid->RowIndex ?>_PCS_Out" value="<?php echo HtmlEncode($tbl_order_po_inv->PCS_Out->OldValue) ?>">
<?php } ?>
<?php if ($tbl_order_po_inv->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $tbl_order_po_inv_grid->RowCnt ?>_tbl_order_po_inv_PCS_Out" class="form-group tbl_order_po_inv_PCS_Out">
<input type="text" data-table="tbl_order_po_inv" data-field="x_PCS_Out" name="x<?php echo $tbl_order_po_inv_grid->RowIndex ?>_PCS_Out" id="x<?php echo $tbl_order_po_inv_grid->RowIndex ?>_PCS_Out" size="5" placeholder="<?php echo HtmlEncode($tbl_order_po_inv->PCS_Out->getPlaceHolder()) ?>" value="<?php echo $tbl_order_po_inv->PCS_Out->EditValue ?>"<?php echo $tbl_order_po_inv->PCS_Out->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($tbl_order_po_inv->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $tbl_order_po_inv_grid->RowCnt ?>_tbl_order_po_inv_PCS_Out" class="tbl_order_po_inv_PCS_Out">
<span<?php echo $tbl_order_po_inv->PCS_Out->viewAttributes() ?>>
<?php echo $tbl_order_po_inv->PCS_Out->getViewValue() ?></span>
</span>
<?php if (!$tbl_order_po_inv->isConfirm()) { ?>
<input type="hidden" data-table="tbl_order_po_inv" data-field="x_PCS_Out" name="x<?php echo $tbl_order_po_inv_grid->RowIndex ?>_PCS_Out" id="x<?php echo $tbl_order_po_inv_grid->RowIndex ?>_PCS_Out" value="<?php echo HtmlEncode($tbl_order_po_inv->PCS_Out->FormValue) ?>">
<input type="hidden" data-table="tbl_order_po_inv" data-field="x_PCS_Out" name="o<?php echo $tbl_order_po_inv_grid->RowIndex ?>_PCS_Out" id="o<?php echo $tbl_order_po_inv_grid->RowIndex ?>_PCS_Out" value="<?php echo HtmlEncode($tbl_order_po_inv->PCS_Out->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="tbl_order_po_inv" data-field="x_PCS_Out" name="ftbl_order_po_invgrid$x<?php echo $tbl_order_po_inv_grid->RowIndex ?>_PCS_Out" id="ftbl_order_po_invgrid$x<?php echo $tbl_order_po_inv_grid->RowIndex ?>_PCS_Out" value="<?php echo HtmlEncode($tbl_order_po_inv->PCS_Out->FormValue) ?>">
<input type="hidden" data-table="tbl_order_po_inv" data-field="x_PCS_Out" name="ftbl_order_po_invgrid$o<?php echo $tbl_order_po_inv_grid->RowIndex ?>_PCS_Out" id="ftbl_order_po_invgrid$o<?php echo $tbl_order_po_inv_grid->RowIndex ?>_PCS_Out" value="<?php echo HtmlEncode($tbl_order_po_inv->PCS_Out->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($tbl_order_po_inv->PO_No->Visible) { // PO_No ?>
		<td data-name="PO_No"<?php echo $tbl_order_po_inv->PO_No->cellAttributes() ?>>
<?php if ($tbl_order_po_inv->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $tbl_order_po_inv_grid->RowCnt ?>_tbl_order_po_inv_PO_No" class="form-group tbl_order_po_inv_PO_No">
<input type="text" data-table="tbl_order_po_inv" data-field="x_PO_No" name="x<?php echo $tbl_order_po_inv_grid->RowIndex ?>_PO_No" id="x<?php echo $tbl_order_po_inv_grid->RowIndex ?>_PO_No" size="20" maxlength="50" placeholder="<?php echo HtmlEncode($tbl_order_po_inv->PO_No->getPlaceHolder()) ?>" value="<?php echo $tbl_order_po_inv->PO_No->EditValue ?>"<?php echo $tbl_order_po_inv->PO_No->editAttributes() ?>>
</span>
<input type="hidden" data-table="tbl_order_po_inv" data-field="x_PO_No" name="o<?php echo $tbl_order_po_inv_grid->RowIndex ?>_PO_No" id="o<?php echo $tbl_order_po_inv_grid->RowIndex ?>_PO_No" value="<?php echo HtmlEncode($tbl_order_po_inv->PO_No->OldValue) ?>">
<?php } ?>
<?php if ($tbl_order_po_inv->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $tbl_order_po_inv_grid->RowCnt ?>_tbl_order_po_inv_PO_No" class="form-group tbl_order_po_inv_PO_No">
<input type="text" data-table="tbl_order_po_inv" data-field="x_PO_No" name="x<?php echo $tbl_order_po_inv_grid->RowIndex ?>_PO_No" id="x<?php echo $tbl_order_po_inv_grid->RowIndex ?>_PO_No" size="20" maxlength="50" placeholder="<?php echo HtmlEncode($tbl_order_po_inv->PO_No->getPlaceHolder()) ?>" value="<?php echo $tbl_order_po_inv->PO_No->EditValue ?>"<?php echo $tbl_order_po_inv->PO_No->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($tbl_order_po_inv->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $tbl_order_po_inv_grid->RowCnt ?>_tbl_order_po_inv_PO_No" class="tbl_order_po_inv_PO_No">
<span<?php echo $tbl_order_po_inv->PO_No->viewAttributes() ?>>
<?php echo $tbl_order_po_inv->PO_No->getViewValue() ?></span>
</span>
<?php if (!$tbl_order_po_inv->isConfirm()) { ?>
<input type="hidden" data-table="tbl_order_po_inv" data-field="x_PO_No" name="x<?php echo $tbl_order_po_inv_grid->RowIndex ?>_PO_No" id="x<?php echo $tbl_order_po_inv_grid->RowIndex ?>_PO_No" value="<?php echo HtmlEncode($tbl_order_po_inv->PO_No->FormValue) ?>">
<input type="hidden" data-table="tbl_order_po_inv" data-field="x_PO_No" name="o<?php echo $tbl_order_po_inv_grid->RowIndex ?>_PO_No" id="o<?php echo $tbl_order_po_inv_grid->RowIndex ?>_PO_No" value="<?php echo HtmlEncode($tbl_order_po_inv->PO_No->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="tbl_order_po_inv" data-field="x_PO_No" name="ftbl_order_po_invgrid$x<?php echo $tbl_order_po_inv_grid->RowIndex ?>_PO_No" id="ftbl_order_po_invgrid$x<?php echo $tbl_order_po_inv_grid->RowIndex ?>_PO_No" value="<?php echo HtmlEncode($tbl_order_po_inv->PO_No->FormValue) ?>">
<input type="hidden" data-table="tbl_order_po_inv" data-field="x_PO_No" name="ftbl_order_po_invgrid$o<?php echo $tbl_order_po_inv_grid->RowIndex ?>_PO_No" id="ftbl_order_po_invgrid$o<?php echo $tbl_order_po_inv_grid->RowIndex ?>_PO_No" value="<?php echo HtmlEncode($tbl_order_po_inv->PO_No->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($tbl_order_po_inv->INV_No->Visible) { // INV_No ?>
		<td data-name="INV_No"<?php echo $tbl_order_po_inv->INV_No->cellAttributes() ?>>
<?php if ($tbl_order_po_inv->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $tbl_order_po_inv_grid->RowCnt ?>_tbl_order_po_inv_INV_No" class="form-group tbl_order_po_inv_INV_No">
<input type="text" data-table="tbl_order_po_inv" data-field="x_INV_No" name="x<?php echo $tbl_order_po_inv_grid->RowIndex ?>_INV_No" id="x<?php echo $tbl_order_po_inv_grid->RowIndex ?>_INV_No" size="20" maxlength="50" placeholder="<?php echo HtmlEncode($tbl_order_po_inv->INV_No->getPlaceHolder()) ?>" value="<?php echo $tbl_order_po_inv->INV_No->EditValue ?>"<?php echo $tbl_order_po_inv->INV_No->editAttributes() ?>>
</span>
<input type="hidden" data-table="tbl_order_po_inv" data-field="x_INV_No" name="o<?php echo $tbl_order_po_inv_grid->RowIndex ?>_INV_No" id="o<?php echo $tbl_order_po_inv_grid->RowIndex ?>_INV_No" value="<?php echo HtmlEncode($tbl_order_po_inv->INV_No->OldValue) ?>">
<?php } ?>
<?php if ($tbl_order_po_inv->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $tbl_order_po_inv_grid->RowCnt ?>_tbl_order_po_inv_INV_No" class="form-group tbl_order_po_inv_INV_No">
<input type="text" data-table="tbl_order_po_inv" data-field="x_INV_No" name="x<?php echo $tbl_order_po_inv_grid->RowIndex ?>_INV_No" id="x<?php echo $tbl_order_po_inv_grid->RowIndex ?>_INV_No" size="20" maxlength="50" placeholder="<?php echo HtmlEncode($tbl_order_po_inv->INV_No->getPlaceHolder()) ?>" value="<?php echo $tbl_order_po_inv->INV_No->EditValue ?>"<?php echo $tbl_order_po_inv->INV_No->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($tbl_order_po_inv->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $tbl_order_po_inv_grid->RowCnt ?>_tbl_order_po_inv_INV_No" class="tbl_order_po_inv_INV_No">
<span<?php echo $tbl_order_po_inv->INV_No->viewAttributes() ?>>
<?php echo $tbl_order_po_inv->INV_No->getViewValue() ?></span>
</span>
<?php if (!$tbl_order_po_inv->isConfirm()) { ?>
<input type="hidden" data-table="tbl_order_po_inv" data-field="x_INV_No" name="x<?php echo $tbl_order_po_inv_grid->RowIndex ?>_INV_No" id="x<?php echo $tbl_order_po_inv_grid->RowIndex ?>_INV_No" value="<?php echo HtmlEncode($tbl_order_po_inv->INV_No->FormValue) ?>">
<input type="hidden" data-table="tbl_order_po_inv" data-field="x_INV_No" name="o<?php echo $tbl_order_po_inv_grid->RowIndex ?>_INV_No" id="o<?php echo $tbl_order_po_inv_grid->RowIndex ?>_INV_No" value="<?php echo HtmlEncode($tbl_order_po_inv->INV_No->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="tbl_order_po_inv" data-field="x_INV_No" name="ftbl_order_po_invgrid$x<?php echo $tbl_order_po_inv_grid->RowIndex ?>_INV_No" id="ftbl_order_po_invgrid$x<?php echo $tbl_order_po_inv_grid->RowIndex ?>_INV_No" value="<?php echo HtmlEncode($tbl_order_po_inv->INV_No->FormValue) ?>">
<input type="hidden" data-table="tbl_order_po_inv" data-field="x_INV_No" name="ftbl_order_po_invgrid$o<?php echo $tbl_order_po_inv_grid->RowIndex ?>_INV_No" id="ftbl_order_po_invgrid$o<?php echo $tbl_order_po_inv_grid->RowIndex ?>_INV_No" value="<?php echo HtmlEncode($tbl_order_po_inv->INV_No->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($tbl_order_po_inv->PO_InputDate->Visible) { // PO_InputDate ?>
		<td data-name="PO_InputDate"<?php echo $tbl_order_po_inv->PO_InputDate->cellAttributes() ?>>
<?php if ($tbl_order_po_inv->RowType == ROWTYPE_ADD) { // Add record ?>
<input type="hidden" data-table="tbl_order_po_inv" data-field="x_PO_InputDate" name="o<?php echo $tbl_order_po_inv_grid->RowIndex ?>_PO_InputDate" id="o<?php echo $tbl_order_po_inv_grid->RowIndex ?>_PO_InputDate" value="<?php echo HtmlEncode($tbl_order_po_inv->PO_InputDate->OldValue) ?>">
<?php } ?>
<?php if ($tbl_order_po_inv->RowType == ROWTYPE_EDIT) { // Edit record ?>
<?php } ?>
<?php if ($tbl_order_po_inv->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $tbl_order_po_inv_grid->RowCnt ?>_tbl_order_po_inv_PO_InputDate" class="tbl_order_po_inv_PO_InputDate">
<span<?php echo $tbl_order_po_inv->PO_InputDate->viewAttributes() ?>>
<?php echo $tbl_order_po_inv->PO_InputDate->getViewValue() ?></span>
</span>
<?php if (!$tbl_order_po_inv->isConfirm()) { ?>
<input type="hidden" data-table="tbl_order_po_inv" data-field="x_PO_InputDate" name="x<?php echo $tbl_order_po_inv_grid->RowIndex ?>_PO_InputDate" id="x<?php echo $tbl_order_po_inv_grid->RowIndex ?>_PO_InputDate" value="<?php echo HtmlEncode($tbl_order_po_inv->PO_InputDate->FormValue) ?>">
<input type="hidden" data-table="tbl_order_po_inv" data-field="x_PO_InputDate" name="o<?php echo $tbl_order_po_inv_grid->RowIndex ?>_PO_InputDate" id="o<?php echo $tbl_order_po_inv_grid->RowIndex ?>_PO_InputDate" value="<?php echo HtmlEncode($tbl_order_po_inv->PO_InputDate->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="tbl_order_po_inv" data-field="x_PO_InputDate" name="ftbl_order_po_invgrid$x<?php echo $tbl_order_po_inv_grid->RowIndex ?>_PO_InputDate" id="ftbl_order_po_invgrid$x<?php echo $tbl_order_po_inv_grid->RowIndex ?>_PO_InputDate" value="<?php echo HtmlEncode($tbl_order_po_inv->PO_InputDate->FormValue) ?>">
<input type="hidden" data-table="tbl_order_po_inv" data-field="x_PO_InputDate" name="ftbl_order_po_invgrid$o<?php echo $tbl_order_po_inv_grid->RowIndex ?>_PO_InputDate" id="ftbl_order_po_invgrid$o<?php echo $tbl_order_po_inv_grid->RowIndex ?>_PO_InputDate" value="<?php echo HtmlEncode($tbl_order_po_inv->PO_InputDate->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($tbl_order_po_inv->PO_InputUser->Visible) { // PO_InputUser ?>
		<td data-name="PO_InputUser"<?php echo $tbl_order_po_inv->PO_InputUser->cellAttributes() ?>>
<?php if ($tbl_order_po_inv->RowType == ROWTYPE_ADD) { // Add record ?>
<input type="hidden" data-table="tbl_order_po_inv" data-field="x_PO_InputUser" name="o<?php echo $tbl_order_po_inv_grid->RowIndex ?>_PO_InputUser" id="o<?php echo $tbl_order_po_inv_grid->RowIndex ?>_PO_InputUser" value="<?php echo HtmlEncode($tbl_order_po_inv->PO_InputUser->OldValue) ?>">
<?php } ?>
<?php if ($tbl_order_po_inv->RowType == ROWTYPE_EDIT) { // Edit record ?>
<?php } ?>
<?php if ($tbl_order_po_inv->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $tbl_order_po_inv_grid->RowCnt ?>_tbl_order_po_inv_PO_InputUser" class="tbl_order_po_inv_PO_InputUser">
<span<?php echo $tbl_order_po_inv->PO_InputUser->viewAttributes() ?>>
<?php echo $tbl_order_po_inv->PO_InputUser->getViewValue() ?></span>
</span>
<?php if (!$tbl_order_po_inv->isConfirm()) { ?>
<input type="hidden" data-table="tbl_order_po_inv" data-field="x_PO_InputUser" name="x<?php echo $tbl_order_po_inv_grid->RowIndex ?>_PO_InputUser" id="x<?php echo $tbl_order_po_inv_grid->RowIndex ?>_PO_InputUser" value="<?php echo HtmlEncode($tbl_order_po_inv->PO_InputUser->FormValue) ?>">
<input type="hidden" data-table="tbl_order_po_inv" data-field="x_PO_InputUser" name="o<?php echo $tbl_order_po_inv_grid->RowIndex ?>_PO_InputUser" id="o<?php echo $tbl_order_po_inv_grid->RowIndex ?>_PO_InputUser" value="<?php echo HtmlEncode($tbl_order_po_inv->PO_InputUser->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="tbl_order_po_inv" data-field="x_PO_InputUser" name="ftbl_order_po_invgrid$x<?php echo $tbl_order_po_inv_grid->RowIndex ?>_PO_InputUser" id="ftbl_order_po_invgrid$x<?php echo $tbl_order_po_inv_grid->RowIndex ?>_PO_InputUser" value="<?php echo HtmlEncode($tbl_order_po_inv->PO_InputUser->FormValue) ?>">
<input type="hidden" data-table="tbl_order_po_inv" data-field="x_PO_InputUser" name="ftbl_order_po_invgrid$o<?php echo $tbl_order_po_inv_grid->RowIndex ?>_PO_InputUser" id="ftbl_order_po_invgrid$o<?php echo $tbl_order_po_inv_grid->RowIndex ?>_PO_InputUser" value="<?php echo HtmlEncode($tbl_order_po_inv->PO_InputUser->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$tbl_order_po_inv_grid->ListOptions->render("body", "right", $tbl_order_po_inv_grid->RowCnt);
?>
	</tr>
<?php if ($tbl_order_po_inv->RowType == ROWTYPE_ADD || $tbl_order_po_inv->RowType == ROWTYPE_EDIT) { ?>
<script>
ftbl_order_po_invgrid.updateLists(<?php echo $tbl_order_po_inv_grid->RowIndex ?>);
</script>
<?php } ?>
<?php
	}
	} // End delete row checking
	if (!$tbl_order_po_inv->isGridAdd() || $tbl_order_po_inv->CurrentMode == "copy")
		if (!$tbl_order_po_inv_grid->Recordset->EOF)
			$tbl_order_po_inv_grid->Recordset->moveNext();
}
?>
<?php
	if ($tbl_order_po_inv->CurrentMode == "add" || $tbl_order_po_inv->CurrentMode == "copy" || $tbl_order_po_inv->CurrentMode == "edit") {
		$tbl_order_po_inv_grid->RowIndex = '$rowindex$';
		$tbl_order_po_inv_grid->loadRowValues();

		// Set row properties
		$tbl_order_po_inv->resetAttributes();
		$tbl_order_po_inv->RowAttrs = array_merge($tbl_order_po_inv->RowAttrs, array('data-rowindex'=>$tbl_order_po_inv_grid->RowIndex, 'id'=>'r0_tbl_order_po_inv', 'data-rowtype'=>ROWTYPE_ADD));
		AppendClass($tbl_order_po_inv->RowAttrs["class"], "ew-template");
		$tbl_order_po_inv->RowType = ROWTYPE_ADD;

		// Render row
		$tbl_order_po_inv_grid->renderRow();

		// Render list options
		$tbl_order_po_inv_grid->renderListOptions();
		$tbl_order_po_inv_grid->StartRowCnt = 0;
?>
	<tr<?php echo $tbl_order_po_inv->rowAttributes() ?>>
<?php

// Render list options (body, left)
$tbl_order_po_inv_grid->ListOptions->render("body", "left", $tbl_order_po_inv_grid->RowIndex);
?>
	<?php if ($tbl_order_po_inv->Code->Visible) { // Code ?>
		<td data-name="Code">
<?php if (!$tbl_order_po_inv->isConfirm()) { ?>
<span id="el$rowindex$_tbl_order_po_inv_Code" class="form-group tbl_order_po_inv_Code">
<input type="text" data-table="tbl_order_po_inv" data-field="x_Code" name="x<?php echo $tbl_order_po_inv_grid->RowIndex ?>_Code" id="x<?php echo $tbl_order_po_inv_grid->RowIndex ?>_Code" size="10" maxlength="50" placeholder="<?php echo HtmlEncode($tbl_order_po_inv->Code->getPlaceHolder()) ?>" value="<?php echo $tbl_order_po_inv->Code->EditValue ?>"<?php echo $tbl_order_po_inv->Code->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_tbl_order_po_inv_Code" class="form-group tbl_order_po_inv_Code">
<span<?php echo $tbl_order_po_inv->Code->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?php echo RemoveHtml($tbl_order_po_inv->Code->ViewValue) ?>"></span>
</span>
<input type="hidden" data-table="tbl_order_po_inv" data-field="x_Code" name="x<?php echo $tbl_order_po_inv_grid->RowIndex ?>_Code" id="x<?php echo $tbl_order_po_inv_grid->RowIndex ?>_Code" value="<?php echo HtmlEncode($tbl_order_po_inv->Code->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="tbl_order_po_inv" data-field="x_Code" name="o<?php echo $tbl_order_po_inv_grid->RowIndex ?>_Code" id="o<?php echo $tbl_order_po_inv_grid->RowIndex ?>_Code" value="<?php echo HtmlEncode($tbl_order_po_inv->Code->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($tbl_order_po_inv->PalletNo->Visible) { // PalletNo ?>
		<td data-name="PalletNo">
<?php if (!$tbl_order_po_inv->isConfirm()) { ?>
<span id="el$rowindex$_tbl_order_po_inv_PalletNo" class="form-group tbl_order_po_inv_PalletNo">
<input type="text" data-table="tbl_order_po_inv" data-field="x_PalletNo" name="x<?php echo $tbl_order_po_inv_grid->RowIndex ?>_PalletNo" id="x<?php echo $tbl_order_po_inv_grid->RowIndex ?>_PalletNo" size="30" maxlength="50" placeholder="<?php echo HtmlEncode($tbl_order_po_inv->PalletNo->getPlaceHolder()) ?>" value="<?php echo $tbl_order_po_inv->PalletNo->EditValue ?>"<?php echo $tbl_order_po_inv->PalletNo->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_tbl_order_po_inv_PalletNo" class="form-group tbl_order_po_inv_PalletNo">
<span<?php echo $tbl_order_po_inv->PalletNo->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?php echo RemoveHtml($tbl_order_po_inv->PalletNo->ViewValue) ?>"></span>
</span>
<input type="hidden" data-table="tbl_order_po_inv" data-field="x_PalletNo" name="x<?php echo $tbl_order_po_inv_grid->RowIndex ?>_PalletNo" id="x<?php echo $tbl_order_po_inv_grid->RowIndex ?>_PalletNo" value="<?php echo HtmlEncode($tbl_order_po_inv->PalletNo->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="tbl_order_po_inv" data-field="x_PalletNo" name="o<?php echo $tbl_order_po_inv_grid->RowIndex ?>_PalletNo" id="o<?php echo $tbl_order_po_inv_grid->RowIndex ?>_PalletNo" value="<?php echo HtmlEncode($tbl_order_po_inv->PalletNo->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($tbl_order_po_inv->DateIn->Visible) { // DateIn ?>
		<td data-name="DateIn">
<?php if (!$tbl_order_po_inv->isConfirm()) { ?>
<span id="el$rowindex$_tbl_order_po_inv_DateIn" class="form-group tbl_order_po_inv_DateIn">
<input type="text" data-table="tbl_order_po_inv" data-field="x_DateIn" data-format="7" name="x<?php echo $tbl_order_po_inv_grid->RowIndex ?>_DateIn" id="x<?php echo $tbl_order_po_inv_grid->RowIndex ?>_DateIn" placeholder="<?php echo HtmlEncode($tbl_order_po_inv->DateIn->getPlaceHolder()) ?>" value="<?php echo $tbl_order_po_inv->DateIn->EditValue ?>"<?php echo $tbl_order_po_inv->DateIn->editAttributes() ?>>
<?php if (!$tbl_order_po_inv->DateIn->ReadOnly && !$tbl_order_po_inv->DateIn->Disabled && !isset($tbl_order_po_inv->DateIn->EditAttrs["readonly"]) && !isset($tbl_order_po_inv->DateIn->EditAttrs["disabled"])) { ?>
<script>
ew.createDateTimePicker("ftbl_order_po_invgrid", "x<?php echo $tbl_order_po_inv_grid->RowIndex ?>_DateIn", {"ignoreReadonly":true,"useCurrent":false,"format":7});
</script>
<?php } ?>
</span>
<?php } else { ?>
<span id="el$rowindex$_tbl_order_po_inv_DateIn" class="form-group tbl_order_po_inv_DateIn">
<span<?php echo $tbl_order_po_inv->DateIn->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?php echo RemoveHtml($tbl_order_po_inv->DateIn->ViewValue) ?>"></span>
</span>
<input type="hidden" data-table="tbl_order_po_inv" data-field="x_DateIn" name="x<?php echo $tbl_order_po_inv_grid->RowIndex ?>_DateIn" id="x<?php echo $tbl_order_po_inv_grid->RowIndex ?>_DateIn" value="<?php echo HtmlEncode($tbl_order_po_inv->DateIn->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="tbl_order_po_inv" data-field="x_DateIn" name="o<?php echo $tbl_order_po_inv_grid->RowIndex ?>_DateIn" id="o<?php echo $tbl_order_po_inv_grid->RowIndex ?>_DateIn" value="<?php echo HtmlEncode($tbl_order_po_inv->DateIn->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($tbl_order_po_inv->PCS_In->Visible) { // PCS_In ?>
		<td data-name="PCS_In">
<?php if (!$tbl_order_po_inv->isConfirm()) { ?>
<span id="el$rowindex$_tbl_order_po_inv_PCS_In" class="form-group tbl_order_po_inv_PCS_In">
<input type="text" data-table="tbl_order_po_inv" data-field="x_PCS_In" name="x<?php echo $tbl_order_po_inv_grid->RowIndex ?>_PCS_In" id="x<?php echo $tbl_order_po_inv_grid->RowIndex ?>_PCS_In" size="5" placeholder="<?php echo HtmlEncode($tbl_order_po_inv->PCS_In->getPlaceHolder()) ?>" value="<?php echo $tbl_order_po_inv->PCS_In->EditValue ?>"<?php echo $tbl_order_po_inv->PCS_In->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_tbl_order_po_inv_PCS_In" class="form-group tbl_order_po_inv_PCS_In">
<span<?php echo $tbl_order_po_inv->PCS_In->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?php echo RemoveHtml($tbl_order_po_inv->PCS_In->ViewValue) ?>"></span>
</span>
<input type="hidden" data-table="tbl_order_po_inv" data-field="x_PCS_In" name="x<?php echo $tbl_order_po_inv_grid->RowIndex ?>_PCS_In" id="x<?php echo $tbl_order_po_inv_grid->RowIndex ?>_PCS_In" value="<?php echo HtmlEncode($tbl_order_po_inv->PCS_In->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="tbl_order_po_inv" data-field="x_PCS_In" name="o<?php echo $tbl_order_po_inv_grid->RowIndex ?>_PCS_In" id="o<?php echo $tbl_order_po_inv_grid->RowIndex ?>_PCS_In" value="<?php echo HtmlEncode($tbl_order_po_inv->PCS_In->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($tbl_order_po_inv->PCS_Out->Visible) { // PCS_Out ?>
		<td data-name="PCS_Out">
<?php if (!$tbl_order_po_inv->isConfirm()) { ?>
<span id="el$rowindex$_tbl_order_po_inv_PCS_Out" class="form-group tbl_order_po_inv_PCS_Out">
<input type="text" data-table="tbl_order_po_inv" data-field="x_PCS_Out" name="x<?php echo $tbl_order_po_inv_grid->RowIndex ?>_PCS_Out" id="x<?php echo $tbl_order_po_inv_grid->RowIndex ?>_PCS_Out" size="5" placeholder="<?php echo HtmlEncode($tbl_order_po_inv->PCS_Out->getPlaceHolder()) ?>" value="<?php echo $tbl_order_po_inv->PCS_Out->EditValue ?>"<?php echo $tbl_order_po_inv->PCS_Out->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_tbl_order_po_inv_PCS_Out" class="form-group tbl_order_po_inv_PCS_Out">
<span<?php echo $tbl_order_po_inv->PCS_Out->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?php echo RemoveHtml($tbl_order_po_inv->PCS_Out->ViewValue) ?>"></span>
</span>
<input type="hidden" data-table="tbl_order_po_inv" data-field="x_PCS_Out" name="x<?php echo $tbl_order_po_inv_grid->RowIndex ?>_PCS_Out" id="x<?php echo $tbl_order_po_inv_grid->RowIndex ?>_PCS_Out" value="<?php echo HtmlEncode($tbl_order_po_inv->PCS_Out->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="tbl_order_po_inv" data-field="x_PCS_Out" name="o<?php echo $tbl_order_po_inv_grid->RowIndex ?>_PCS_Out" id="o<?php echo $tbl_order_po_inv_grid->RowIndex ?>_PCS_Out" value="<?php echo HtmlEncode($tbl_order_po_inv->PCS_Out->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($tbl_order_po_inv->PO_No->Visible) { // PO_No ?>
		<td data-name="PO_No">
<?php if (!$tbl_order_po_inv->isConfirm()) { ?>
<span id="el$rowindex$_tbl_order_po_inv_PO_No" class="form-group tbl_order_po_inv_PO_No">
<input type="text" data-table="tbl_order_po_inv" data-field="x_PO_No" name="x<?php echo $tbl_order_po_inv_grid->RowIndex ?>_PO_No" id="x<?php echo $tbl_order_po_inv_grid->RowIndex ?>_PO_No" size="20" maxlength="50" placeholder="<?php echo HtmlEncode($tbl_order_po_inv->PO_No->getPlaceHolder()) ?>" value="<?php echo $tbl_order_po_inv->PO_No->EditValue ?>"<?php echo $tbl_order_po_inv->PO_No->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_tbl_order_po_inv_PO_No" class="form-group tbl_order_po_inv_PO_No">
<span<?php echo $tbl_order_po_inv->PO_No->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?php echo RemoveHtml($tbl_order_po_inv->PO_No->ViewValue) ?>"></span>
</span>
<input type="hidden" data-table="tbl_order_po_inv" data-field="x_PO_No" name="x<?php echo $tbl_order_po_inv_grid->RowIndex ?>_PO_No" id="x<?php echo $tbl_order_po_inv_grid->RowIndex ?>_PO_No" value="<?php echo HtmlEncode($tbl_order_po_inv->PO_No->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="tbl_order_po_inv" data-field="x_PO_No" name="o<?php echo $tbl_order_po_inv_grid->RowIndex ?>_PO_No" id="o<?php echo $tbl_order_po_inv_grid->RowIndex ?>_PO_No" value="<?php echo HtmlEncode($tbl_order_po_inv->PO_No->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($tbl_order_po_inv->INV_No->Visible) { // INV_No ?>
		<td data-name="INV_No">
<?php if (!$tbl_order_po_inv->isConfirm()) { ?>
<span id="el$rowindex$_tbl_order_po_inv_INV_No" class="form-group tbl_order_po_inv_INV_No">
<input type="text" data-table="tbl_order_po_inv" data-field="x_INV_No" name="x<?php echo $tbl_order_po_inv_grid->RowIndex ?>_INV_No" id="x<?php echo $tbl_order_po_inv_grid->RowIndex ?>_INV_No" size="20" maxlength="50" placeholder="<?php echo HtmlEncode($tbl_order_po_inv->INV_No->getPlaceHolder()) ?>" value="<?php echo $tbl_order_po_inv->INV_No->EditValue ?>"<?php echo $tbl_order_po_inv->INV_No->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_tbl_order_po_inv_INV_No" class="form-group tbl_order_po_inv_INV_No">
<span<?php echo $tbl_order_po_inv->INV_No->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?php echo RemoveHtml($tbl_order_po_inv->INV_No->ViewValue) ?>"></span>
</span>
<input type="hidden" data-table="tbl_order_po_inv" data-field="x_INV_No" name="x<?php echo $tbl_order_po_inv_grid->RowIndex ?>_INV_No" id="x<?php echo $tbl_order_po_inv_grid->RowIndex ?>_INV_No" value="<?php echo HtmlEncode($tbl_order_po_inv->INV_No->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="tbl_order_po_inv" data-field="x_INV_No" name="o<?php echo $tbl_order_po_inv_grid->RowIndex ?>_INV_No" id="o<?php echo $tbl_order_po_inv_grid->RowIndex ?>_INV_No" value="<?php echo HtmlEncode($tbl_order_po_inv->INV_No->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($tbl_order_po_inv->PO_InputDate->Visible) { // PO_InputDate ?>
		<td data-name="PO_InputDate">
<?php if (!$tbl_order_po_inv->isConfirm()) { ?>
<?php } else { ?>
<span id="el$rowindex$_tbl_order_po_inv_PO_InputDate" class="form-group tbl_order_po_inv_PO_InputDate">
<span<?php echo $tbl_order_po_inv->PO_InputDate->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?php echo RemoveHtml($tbl_order_po_inv->PO_InputDate->ViewValue) ?>"></span>
</span>
<input type="hidden" data-table="tbl_order_po_inv" data-field="x_PO_InputDate" name="x<?php echo $tbl_order_po_inv_grid->RowIndex ?>_PO_InputDate" id="x<?php echo $tbl_order_po_inv_grid->RowIndex ?>_PO_InputDate" value="<?php echo HtmlEncode($tbl_order_po_inv->PO_InputDate->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="tbl_order_po_inv" data-field="x_PO_InputDate" name="o<?php echo $tbl_order_po_inv_grid->RowIndex ?>_PO_InputDate" id="o<?php echo $tbl_order_po_inv_grid->RowIndex ?>_PO_InputDate" value="<?php echo HtmlEncode($tbl_order_po_inv->PO_InputDate->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($tbl_order_po_inv->PO_InputUser->Visible) { // PO_InputUser ?>
		<td data-name="PO_InputUser">
<?php if (!$tbl_order_po_inv->isConfirm()) { ?>
<?php } else { ?>
<span id="el$rowindex$_tbl_order_po_inv_PO_InputUser" class="form-group tbl_order_po_inv_PO_InputUser">
<span<?php echo $tbl_order_po_inv->PO_InputUser->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?php echo RemoveHtml($tbl_order_po_inv->PO_InputUser->ViewValue) ?>"></span>
</span>
<input type="hidden" data-table="tbl_order_po_inv" data-field="x_PO_InputUser" name="x<?php echo $tbl_order_po_inv_grid->RowIndex ?>_PO_InputUser" id="x<?php echo $tbl_order_po_inv_grid->RowIndex ?>_PO_InputUser" value="<?php echo HtmlEncode($tbl_order_po_inv->PO_InputUser->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="tbl_order_po_inv" data-field="x_PO_InputUser" name="o<?php echo $tbl_order_po_inv_grid->RowIndex ?>_PO_InputUser" id="o<?php echo $tbl_order_po_inv_grid->RowIndex ?>_PO_InputUser" value="<?php echo HtmlEncode($tbl_order_po_inv->PO_InputUser->OldValue) ?>">
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$tbl_order_po_inv_grid->ListOptions->render("body", "right", $tbl_order_po_inv_grid->RowIndex);
?>
<script>
ftbl_order_po_invgrid.updateLists(<?php echo $tbl_order_po_inv_grid->RowIndex ?>);
</script>
	</tr>
<?php
}
?>
</tbody>
</table><!-- /.ew-table -->
<?php if ($tbl_order_po_inv->CurrentMode == "add" || $tbl_order_po_inv->CurrentMode == "copy") { ?>
<input type="hidden" name="<?php echo $tbl_order_po_inv_grid->FormKeyCountName ?>" id="<?php echo $tbl_order_po_inv_grid->FormKeyCountName ?>" value="<?php echo $tbl_order_po_inv_grid->KeyCount ?>">
<?php echo $tbl_order_po_inv_grid->MultiSelectKey ?>
<?php } ?>
<?php if ($tbl_order_po_inv->CurrentMode == "edit") { ?>
<input type="hidden" name="<?php echo $tbl_order_po_inv_grid->FormKeyCountName ?>" id="<?php echo $tbl_order_po_inv_grid->FormKeyCountName ?>" value="<?php echo $tbl_order_po_inv_grid->KeyCount ?>">
<?php echo $tbl_order_po_inv_grid->MultiSelectKey ?>
<?php } ?>
<?php if ($tbl_order_po_inv->CurrentMode == "") { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
<input type="hidden" name="detailpage" value="ftbl_order_po_invgrid">
</div><!-- /.ew-grid-middle-panel -->
<?php

// Close recordset
if ($tbl_order_po_inv_grid->Recordset)
	$tbl_order_po_inv_grid->Recordset->Close();
?>
</div>
<?php if ($tbl_order_po_inv_grid->ShowOtherOptions) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php $tbl_order_po_inv_grid->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($tbl_order_po_inv_grid->TotalRecs == 0 && !$tbl_order_po_inv->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $tbl_order_po_inv_grid->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$tbl_order_po_inv_grid->terminate();
?>