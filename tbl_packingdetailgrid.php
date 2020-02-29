<?php
namespace PHPMaker2019\asgbn_wh;

// Write header
WriteHeader(FALSE);

// Create page object
if (!isset($tbl_packingdetail_grid))
	$tbl_packingdetail_grid = new tbl_packingdetail_grid();

// Run the page
$tbl_packingdetail_grid->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$tbl_packingdetail_grid->Page_Render();
?>
<?php if (!$tbl_packingdetail->isExport()) { ?>
<script>

// Form object
var ftbl_packingdetailgrid = new ew.Form("ftbl_packingdetailgrid", "grid");
ftbl_packingdetailgrid.formKeyCountName = '<?php echo $tbl_packingdetail_grid->FormKeyCountName ?>';

// Validate form
ftbl_packingdetailgrid.validate = function() {
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
		<?php if ($tbl_packingdetail_grid->ID_packingDetail->Required) { ?>
			elm = this.getElements("x" + infix + "_ID_packingDetail");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $tbl_packingdetail->ID_packingDetail->caption(), $tbl_packingdetail->ID_packingDetail->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($tbl_packingdetail_grid->PackingOrNoPacking->Required) { ?>
			elm = this.getElements("x" + infix + "_PackingOrNoPacking");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $tbl_packingdetail->PackingOrNoPacking->caption(), $tbl_packingdetail->PackingOrNoPacking->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($tbl_packingdetail_grid->PackingType->Required) { ?>
			elm = this.getElements("x" + infix + "_PackingType");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $tbl_packingdetail->PackingType->caption(), $tbl_packingdetail->PackingType->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($tbl_packingdetail_grid->Length->Required) { ?>
			elm = this.getElements("x" + infix + "_Length");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $tbl_packingdetail->Length->caption(), $tbl_packingdetail->Length->RequiredErrorMessage)) ?>");
		<?php } ?>
			elm = this.getElements("x" + infix + "_Length");
			if (elm && !ew.checkInteger(elm.value))
				return this.onError(elm, "<?php echo JsEncode($tbl_packingdetail->Length->errorMessage()) ?>");
		<?php if ($tbl_packingdetail_grid->Width->Required) { ?>
			elm = this.getElements("x" + infix + "_Width");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $tbl_packingdetail->Width->caption(), $tbl_packingdetail->Width->RequiredErrorMessage)) ?>");
		<?php } ?>
			elm = this.getElements("x" + infix + "_Width");
			if (elm && !ew.checkInteger(elm.value))
				return this.onError(elm, "<?php echo JsEncode($tbl_packingdetail->Width->errorMessage()) ?>");
		<?php if ($tbl_packingdetail_grid->Heigth->Required) { ?>
			elm = this.getElements("x" + infix + "_Heigth");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $tbl_packingdetail->Heigth->caption(), $tbl_packingdetail->Heigth->RequiredErrorMessage)) ?>");
		<?php } ?>
			elm = this.getElements("x" + infix + "_Heigth");
			if (elm && !ew.checkInteger(elm.value))
				return this.onError(elm, "<?php echo JsEncode($tbl_packingdetail->Heigth->errorMessage()) ?>");
		<?php if ($tbl_packingdetail_grid->PE_film_Cover->Required) { ?>
			elm = this.getElements("x" + infix + "_PE_film_Cover");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $tbl_packingdetail->PE_film_Cover->caption(), $tbl_packingdetail->PE_film_Cover->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($tbl_packingdetail_grid->finishpacking->Required) { ?>
			elm = this.getElements("x" + infix + "_finishpacking");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $tbl_packingdetail->finishpacking->caption(), $tbl_packingdetail->finishpacking->RequiredErrorMessage)) ?>");
		<?php } ?>

			// Fire Form_CustomValidate event
			if (!this.Form_CustomValidate(fobj))
				return false;
		} // End Grid Add checking
	}
	return true;
}

// Check empty row
ftbl_packingdetailgrid.emptyRow = function(infix) {
	var fobj = this._form;
	if (ew.valueChanged(fobj, infix, "PackingOrNoPacking", false)) return false;
	if (ew.valueChanged(fobj, infix, "PackingType", false)) return false;
	if (ew.valueChanged(fobj, infix, "Length", false)) return false;
	if (ew.valueChanged(fobj, infix, "Width", false)) return false;
	if (ew.valueChanged(fobj, infix, "Heigth", false)) return false;
	if (ew.valueChanged(fobj, infix, "PE_film_Cover", false)) return false;
	if (ew.valueChanged(fobj, infix, "finishpacking", false)) return false;
	return true;
}

// Form_CustomValidate event
ftbl_packingdetailgrid.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

	// Your custom validation code here, return false if invalid.
	return true;
}

// Use JavaScript validation or not
ftbl_packingdetailgrid.validateRequired = <?php echo json_encode(CLIENT_VALIDATE) ?>;

// Dynamic selection lists
ftbl_packingdetailgrid.lists["x_PackingOrNoPacking"] = <?php echo $tbl_packingdetail_grid->PackingOrNoPacking->Lookup->toClientList() ?>;
ftbl_packingdetailgrid.lists["x_PackingOrNoPacking"].options = <?php echo JsonEncode($tbl_packingdetail_grid->PackingOrNoPacking->options(FALSE, TRUE)) ?>;
ftbl_packingdetailgrid.lists["x_PE_film_Cover"] = <?php echo $tbl_packingdetail_grid->PE_film_Cover->Lookup->toClientList() ?>;
ftbl_packingdetailgrid.lists["x_PE_film_Cover"].options = <?php echo JsonEncode($tbl_packingdetail_grid->PE_film_Cover->options(FALSE, TRUE)) ?>;
ftbl_packingdetailgrid.lists["x_finishpacking"] = <?php echo $tbl_packingdetail_grid->finishpacking->Lookup->toClientList() ?>;
ftbl_packingdetailgrid.lists["x_finishpacking"].options = <?php echo JsonEncode($tbl_packingdetail_grid->finishpacking->options(FALSE, TRUE)) ?>;

// Form object for search
</script>
<?php } ?>
<?php
$tbl_packingdetail_grid->renderOtherOptions();
?>
<?php $tbl_packingdetail_grid->showPageHeader(); ?>
<?php
$tbl_packingdetail_grid->showMessage();
?>
<?php if ($tbl_packingdetail_grid->TotalRecs > 0 || $tbl_packingdetail->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($tbl_packingdetail_grid->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> tbl_packingdetail">
<?php if ($tbl_packingdetail_grid->ShowOtherOptions) { ?>
<div class="card-header ew-grid-upper-panel">
<?php $tbl_packingdetail_grid->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<div id="ftbl_packingdetailgrid" class="ew-form ew-list-form form-inline">
<div id="gmp_tbl_packingdetail" class="<?php if (IsResponsiveLayout()) { ?>table-responsive <?php } ?>card-body ew-grid-middle-panel">
<table id="tbl_tbl_packingdetailgrid" class="table ew-table"><!-- .ew-table ##-->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$tbl_packingdetail_grid->RowType = ROWTYPE_HEADER;

// Render list options
$tbl_packingdetail_grid->renderListOptions();

// Render list options (header, left)
$tbl_packingdetail_grid->ListOptions->render("header", "left");
?>
<?php if ($tbl_packingdetail->ID_packingDetail->Visible) { // ID_packingDetail ?>
	<?php if ($tbl_packingdetail->sortUrl($tbl_packingdetail->ID_packingDetail) == "") { ?>
		<th data-name="ID_packingDetail" class="<?php echo $tbl_packingdetail->ID_packingDetail->headerCellClass() ?>" style="white-space: nowrap;"><div id="elh_tbl_packingdetail_ID_packingDetail" class="tbl_packingdetail_ID_packingDetail"><div class="ew-table-header-caption"><?php echo $tbl_packingdetail->ID_packingDetail->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="ID_packingDetail" class="<?php echo $tbl_packingdetail->ID_packingDetail->headerCellClass() ?>" style="white-space: nowrap;"><div><div id="elh_tbl_packingdetail_ID_packingDetail" class="tbl_packingdetail_ID_packingDetail">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $tbl_packingdetail->ID_packingDetail->caption() ?></span><span class="ew-table-header-sort"><?php if ($tbl_packingdetail->ID_packingDetail->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($tbl_packingdetail->ID_packingDetail->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($tbl_packingdetail->PackingOrNoPacking->Visible) { // PackingOrNoPacking ?>
	<?php if ($tbl_packingdetail->sortUrl($tbl_packingdetail->PackingOrNoPacking) == "") { ?>
		<th data-name="PackingOrNoPacking" class="<?php echo $tbl_packingdetail->PackingOrNoPacking->headerCellClass() ?>" style="white-space: nowrap;"><div id="elh_tbl_packingdetail_PackingOrNoPacking" class="tbl_packingdetail_PackingOrNoPacking"><div class="ew-table-header-caption"><?php echo $tbl_packingdetail->PackingOrNoPacking->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="PackingOrNoPacking" class="<?php echo $tbl_packingdetail->PackingOrNoPacking->headerCellClass() ?>" style="white-space: nowrap;"><div><div id="elh_tbl_packingdetail_PackingOrNoPacking" class="tbl_packingdetail_PackingOrNoPacking">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $tbl_packingdetail->PackingOrNoPacking->caption() ?></span><span class="ew-table-header-sort"><?php if ($tbl_packingdetail->PackingOrNoPacking->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($tbl_packingdetail->PackingOrNoPacking->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($tbl_packingdetail->PackingType->Visible) { // PackingType ?>
	<?php if ($tbl_packingdetail->sortUrl($tbl_packingdetail->PackingType) == "") { ?>
		<th data-name="PackingType" class="<?php echo $tbl_packingdetail->PackingType->headerCellClass() ?>" style="white-space: nowrap;"><div id="elh_tbl_packingdetail_PackingType" class="tbl_packingdetail_PackingType"><div class="ew-table-header-caption"><?php echo $tbl_packingdetail->PackingType->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="PackingType" class="<?php echo $tbl_packingdetail->PackingType->headerCellClass() ?>" style="white-space: nowrap;"><div><div id="elh_tbl_packingdetail_PackingType" class="tbl_packingdetail_PackingType">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $tbl_packingdetail->PackingType->caption() ?></span><span class="ew-table-header-sort"><?php if ($tbl_packingdetail->PackingType->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($tbl_packingdetail->PackingType->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($tbl_packingdetail->Length->Visible) { // Length ?>
	<?php if ($tbl_packingdetail->sortUrl($tbl_packingdetail->Length) == "") { ?>
		<th data-name="Length" class="<?php echo $tbl_packingdetail->Length->headerCellClass() ?>" style="white-space: nowrap;"><div id="elh_tbl_packingdetail_Length" class="tbl_packingdetail_Length"><div class="ew-table-header-caption"><?php echo $tbl_packingdetail->Length->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Length" class="<?php echo $tbl_packingdetail->Length->headerCellClass() ?>" style="white-space: nowrap;"><div><div id="elh_tbl_packingdetail_Length" class="tbl_packingdetail_Length">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $tbl_packingdetail->Length->caption() ?></span><span class="ew-table-header-sort"><?php if ($tbl_packingdetail->Length->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($tbl_packingdetail->Length->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($tbl_packingdetail->Width->Visible) { // Width ?>
	<?php if ($tbl_packingdetail->sortUrl($tbl_packingdetail->Width) == "") { ?>
		<th data-name="Width" class="<?php echo $tbl_packingdetail->Width->headerCellClass() ?>" style="white-space: nowrap;"><div id="elh_tbl_packingdetail_Width" class="tbl_packingdetail_Width"><div class="ew-table-header-caption"><?php echo $tbl_packingdetail->Width->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Width" class="<?php echo $tbl_packingdetail->Width->headerCellClass() ?>" style="white-space: nowrap;"><div><div id="elh_tbl_packingdetail_Width" class="tbl_packingdetail_Width">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $tbl_packingdetail->Width->caption() ?></span><span class="ew-table-header-sort"><?php if ($tbl_packingdetail->Width->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($tbl_packingdetail->Width->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($tbl_packingdetail->Heigth->Visible) { // Heigth ?>
	<?php if ($tbl_packingdetail->sortUrl($tbl_packingdetail->Heigth) == "") { ?>
		<th data-name="Heigth" class="<?php echo $tbl_packingdetail->Heigth->headerCellClass() ?>" style="white-space: nowrap;"><div id="elh_tbl_packingdetail_Heigth" class="tbl_packingdetail_Heigth"><div class="ew-table-header-caption"><?php echo $tbl_packingdetail->Heigth->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Heigth" class="<?php echo $tbl_packingdetail->Heigth->headerCellClass() ?>" style="white-space: nowrap;"><div><div id="elh_tbl_packingdetail_Heigth" class="tbl_packingdetail_Heigth">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $tbl_packingdetail->Heigth->caption() ?></span><span class="ew-table-header-sort"><?php if ($tbl_packingdetail->Heigth->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($tbl_packingdetail->Heigth->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($tbl_packingdetail->PE_film_Cover->Visible) { // PE_film_Cover ?>
	<?php if ($tbl_packingdetail->sortUrl($tbl_packingdetail->PE_film_Cover) == "") { ?>
		<th data-name="PE_film_Cover" class="<?php echo $tbl_packingdetail->PE_film_Cover->headerCellClass() ?>" style="white-space: nowrap;"><div id="elh_tbl_packingdetail_PE_film_Cover" class="tbl_packingdetail_PE_film_Cover"><div class="ew-table-header-caption"><?php echo $tbl_packingdetail->PE_film_Cover->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="PE_film_Cover" class="<?php echo $tbl_packingdetail->PE_film_Cover->headerCellClass() ?>" style="white-space: nowrap;"><div><div id="elh_tbl_packingdetail_PE_film_Cover" class="tbl_packingdetail_PE_film_Cover">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $tbl_packingdetail->PE_film_Cover->caption() ?></span><span class="ew-table-header-sort"><?php if ($tbl_packingdetail->PE_film_Cover->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($tbl_packingdetail->PE_film_Cover->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($tbl_packingdetail->finishpacking->Visible) { // finishpacking ?>
	<?php if ($tbl_packingdetail->sortUrl($tbl_packingdetail->finishpacking) == "") { ?>
		<th data-name="finishpacking" class="<?php echo $tbl_packingdetail->finishpacking->headerCellClass() ?>" style="white-space: nowrap;"><div id="elh_tbl_packingdetail_finishpacking" class="tbl_packingdetail_finishpacking"><div class="ew-table-header-caption"><?php echo $tbl_packingdetail->finishpacking->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="finishpacking" class="<?php echo $tbl_packingdetail->finishpacking->headerCellClass() ?>" style="white-space: nowrap;"><div><div id="elh_tbl_packingdetail_finishpacking" class="tbl_packingdetail_finishpacking">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $tbl_packingdetail->finishpacking->caption() ?></span><span class="ew-table-header-sort"><?php if ($tbl_packingdetail->finishpacking->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($tbl_packingdetail->finishpacking->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$tbl_packingdetail_grid->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
$tbl_packingdetail_grid->StartRec = 1;
$tbl_packingdetail_grid->StopRec = $tbl_packingdetail_grid->TotalRecs; // Show all records

// Restore number of post back records
if ($CurrentForm && $tbl_packingdetail_grid->EventCancelled) {
	$CurrentForm->Index = -1;
	if ($CurrentForm->hasValue($tbl_packingdetail_grid->FormKeyCountName) && ($tbl_packingdetail->isGridAdd() || $tbl_packingdetail->isGridEdit() || $tbl_packingdetail->isConfirm())) {
		$tbl_packingdetail_grid->KeyCount = $CurrentForm->getValue($tbl_packingdetail_grid->FormKeyCountName);
		$tbl_packingdetail_grid->StopRec = $tbl_packingdetail_grid->StartRec + $tbl_packingdetail_grid->KeyCount - 1;
	}
}
$tbl_packingdetail_grid->RecCnt = $tbl_packingdetail_grid->StartRec - 1;
if ($tbl_packingdetail_grid->Recordset && !$tbl_packingdetail_grid->Recordset->EOF) {
	$tbl_packingdetail_grid->Recordset->moveFirst();
	$selectLimit = $tbl_packingdetail_grid->UseSelectLimit;
	if (!$selectLimit && $tbl_packingdetail_grid->StartRec > 1)
		$tbl_packingdetail_grid->Recordset->move($tbl_packingdetail_grid->StartRec - 1);
} elseif (!$tbl_packingdetail->AllowAddDeleteRow && $tbl_packingdetail_grid->StopRec == 0) {
	$tbl_packingdetail_grid->StopRec = $tbl_packingdetail->GridAddRowCount;
}

// Initialize aggregate
$tbl_packingdetail->RowType = ROWTYPE_AGGREGATEINIT;
$tbl_packingdetail->resetAttributes();
$tbl_packingdetail_grid->renderRow();
if ($tbl_packingdetail->isGridAdd())
	$tbl_packingdetail_grid->RowIndex = 0;
if ($tbl_packingdetail->isGridEdit())
	$tbl_packingdetail_grid->RowIndex = 0;
while ($tbl_packingdetail_grid->RecCnt < $tbl_packingdetail_grid->StopRec) {
	$tbl_packingdetail_grid->RecCnt++;
	if ($tbl_packingdetail_grid->RecCnt >= $tbl_packingdetail_grid->StartRec) {
		$tbl_packingdetail_grid->RowCnt++;
		if ($tbl_packingdetail->isGridAdd() || $tbl_packingdetail->isGridEdit() || $tbl_packingdetail->isConfirm()) {
			$tbl_packingdetail_grid->RowIndex++;
			$CurrentForm->Index = $tbl_packingdetail_grid->RowIndex;
			if ($CurrentForm->hasValue($tbl_packingdetail_grid->FormActionName) && $tbl_packingdetail_grid->EventCancelled)
				$tbl_packingdetail_grid->RowAction = strval($CurrentForm->getValue($tbl_packingdetail_grid->FormActionName));
			elseif ($tbl_packingdetail->isGridAdd())
				$tbl_packingdetail_grid->RowAction = "insert";
			else
				$tbl_packingdetail_grid->RowAction = "";
		}

		// Set up key count
		$tbl_packingdetail_grid->KeyCount = $tbl_packingdetail_grid->RowIndex;

		// Init row class and style
		$tbl_packingdetail->resetAttributes();
		$tbl_packingdetail->CssClass = "";
		if ($tbl_packingdetail->isGridAdd()) {
			if ($tbl_packingdetail->CurrentMode == "copy") {
				$tbl_packingdetail_grid->loadRowValues($tbl_packingdetail_grid->Recordset); // Load row values
				$tbl_packingdetail_grid->setRecordKey($tbl_packingdetail_grid->RowOldKey, $tbl_packingdetail_grid->Recordset); // Set old record key
			} else {
				$tbl_packingdetail_grid->loadRowValues(); // Load default values
				$tbl_packingdetail_grid->RowOldKey = ""; // Clear old key value
			}
		} else {
			$tbl_packingdetail_grid->loadRowValues($tbl_packingdetail_grid->Recordset); // Load row values
		}
		$tbl_packingdetail->RowType = ROWTYPE_VIEW; // Render view
		if ($tbl_packingdetail->isGridAdd()) // Grid add
			$tbl_packingdetail->RowType = ROWTYPE_ADD; // Render add
		if ($tbl_packingdetail->isGridAdd() && $tbl_packingdetail->EventCancelled && !$CurrentForm->hasValue("k_blankrow")) // Insert failed
			$tbl_packingdetail_grid->restoreCurrentRowFormValues($tbl_packingdetail_grid->RowIndex); // Restore form values
		if ($tbl_packingdetail->isGridEdit()) { // Grid edit
			if ($tbl_packingdetail->EventCancelled)
				$tbl_packingdetail_grid->restoreCurrentRowFormValues($tbl_packingdetail_grid->RowIndex); // Restore form values
			if ($tbl_packingdetail_grid->RowAction == "insert")
				$tbl_packingdetail->RowType = ROWTYPE_ADD; // Render add
			else
				$tbl_packingdetail->RowType = ROWTYPE_EDIT; // Render edit
		}
		if ($tbl_packingdetail->isGridEdit() && ($tbl_packingdetail->RowType == ROWTYPE_EDIT || $tbl_packingdetail->RowType == ROWTYPE_ADD) && $tbl_packingdetail->EventCancelled) // Update failed
			$tbl_packingdetail_grid->restoreCurrentRowFormValues($tbl_packingdetail_grid->RowIndex); // Restore form values
		if ($tbl_packingdetail->RowType == ROWTYPE_EDIT) // Edit row
			$tbl_packingdetail_grid->EditRowCnt++;
		if ($tbl_packingdetail->isConfirm()) // Confirm row
			$tbl_packingdetail_grid->restoreCurrentRowFormValues($tbl_packingdetail_grid->RowIndex); // Restore form values

		// Set up row id / data-rowindex
		$tbl_packingdetail->RowAttrs = array_merge($tbl_packingdetail->RowAttrs, array('data-rowindex'=>$tbl_packingdetail_grid->RowCnt, 'id'=>'r' . $tbl_packingdetail_grid->RowCnt . '_tbl_packingdetail', 'data-rowtype'=>$tbl_packingdetail->RowType));

		// Render row
		$tbl_packingdetail_grid->renderRow();

		// Render list options
		$tbl_packingdetail_grid->renderListOptions();

		// Skip delete row / empty row for confirm page
		if ($tbl_packingdetail_grid->RowAction <> "delete" && $tbl_packingdetail_grid->RowAction <> "insertdelete" && !($tbl_packingdetail_grid->RowAction == "insert" && $tbl_packingdetail->isConfirm() && $tbl_packingdetail_grid->emptyRow())) {
?>
	<tr<?php echo $tbl_packingdetail->rowAttributes() ?>>
<?php

// Render list options (body, left)
$tbl_packingdetail_grid->ListOptions->render("body", "left", $tbl_packingdetail_grid->RowCnt);
?>
	<?php if ($tbl_packingdetail->ID_packingDetail->Visible) { // ID_packingDetail ?>
		<td data-name="ID_packingDetail"<?php echo $tbl_packingdetail->ID_packingDetail->cellAttributes() ?>>
<?php if ($tbl_packingdetail->RowType == ROWTYPE_ADD) { // Add record ?>
<input type="hidden" data-table="tbl_packingdetail" data-field="x_ID_packingDetail" name="o<?php echo $tbl_packingdetail_grid->RowIndex ?>_ID_packingDetail" id="o<?php echo $tbl_packingdetail_grid->RowIndex ?>_ID_packingDetail" value="<?php echo HtmlEncode($tbl_packingdetail->ID_packingDetail->OldValue) ?>">
<?php } ?>
<?php if ($tbl_packingdetail->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $tbl_packingdetail_grid->RowCnt ?>_tbl_packingdetail_ID_packingDetail" class="form-group tbl_packingdetail_ID_packingDetail">
<span<?php echo $tbl_packingdetail->ID_packingDetail->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?php echo RemoveHtml($tbl_packingdetail->ID_packingDetail->EditValue) ?>"></span>
</span>
<input type="hidden" data-table="tbl_packingdetail" data-field="x_ID_packingDetail" name="x<?php echo $tbl_packingdetail_grid->RowIndex ?>_ID_packingDetail" id="x<?php echo $tbl_packingdetail_grid->RowIndex ?>_ID_packingDetail" value="<?php echo HtmlEncode($tbl_packingdetail->ID_packingDetail->CurrentValue) ?>">
<?php } ?>
<?php if ($tbl_packingdetail->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $tbl_packingdetail_grid->RowCnt ?>_tbl_packingdetail_ID_packingDetail" class="tbl_packingdetail_ID_packingDetail">
<span<?php echo $tbl_packingdetail->ID_packingDetail->viewAttributes() ?>>
<?php echo $tbl_packingdetail->ID_packingDetail->getViewValue() ?></span>
</span>
<?php if (!$tbl_packingdetail->isConfirm()) { ?>
<input type="hidden" data-table="tbl_packingdetail" data-field="x_ID_packingDetail" name="x<?php echo $tbl_packingdetail_grid->RowIndex ?>_ID_packingDetail" id="x<?php echo $tbl_packingdetail_grid->RowIndex ?>_ID_packingDetail" value="<?php echo HtmlEncode($tbl_packingdetail->ID_packingDetail->FormValue) ?>">
<input type="hidden" data-table="tbl_packingdetail" data-field="x_ID_packingDetail" name="o<?php echo $tbl_packingdetail_grid->RowIndex ?>_ID_packingDetail" id="o<?php echo $tbl_packingdetail_grid->RowIndex ?>_ID_packingDetail" value="<?php echo HtmlEncode($tbl_packingdetail->ID_packingDetail->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="tbl_packingdetail" data-field="x_ID_packingDetail" name="ftbl_packingdetailgrid$x<?php echo $tbl_packingdetail_grid->RowIndex ?>_ID_packingDetail" id="ftbl_packingdetailgrid$x<?php echo $tbl_packingdetail_grid->RowIndex ?>_ID_packingDetail" value="<?php echo HtmlEncode($tbl_packingdetail->ID_packingDetail->FormValue) ?>">
<input type="hidden" data-table="tbl_packingdetail" data-field="x_ID_packingDetail" name="ftbl_packingdetailgrid$o<?php echo $tbl_packingdetail_grid->RowIndex ?>_ID_packingDetail" id="ftbl_packingdetailgrid$o<?php echo $tbl_packingdetail_grid->RowIndex ?>_ID_packingDetail" value="<?php echo HtmlEncode($tbl_packingdetail->ID_packingDetail->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($tbl_packingdetail->PackingOrNoPacking->Visible) { // PackingOrNoPacking ?>
		<td data-name="PackingOrNoPacking"<?php echo $tbl_packingdetail->PackingOrNoPacking->cellAttributes() ?>>
<?php if ($tbl_packingdetail->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $tbl_packingdetail_grid->RowCnt ?>_tbl_packingdetail_PackingOrNoPacking" class="form-group tbl_packingdetail_PackingOrNoPacking">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="tbl_packingdetail" data-field="x_PackingOrNoPacking" data-value-separator="<?php echo $tbl_packingdetail->PackingOrNoPacking->displayValueSeparatorAttribute() ?>" id="x<?php echo $tbl_packingdetail_grid->RowIndex ?>_PackingOrNoPacking" name="x<?php echo $tbl_packingdetail_grid->RowIndex ?>_PackingOrNoPacking"<?php echo $tbl_packingdetail->PackingOrNoPacking->editAttributes() ?>>
		<?php echo $tbl_packingdetail->PackingOrNoPacking->selectOptionListHtml("x<?php echo $tbl_packingdetail_grid->RowIndex ?>_PackingOrNoPacking") ?>
	</select>
</div>
</span>
<input type="hidden" data-table="tbl_packingdetail" data-field="x_PackingOrNoPacking" name="o<?php echo $tbl_packingdetail_grid->RowIndex ?>_PackingOrNoPacking" id="o<?php echo $tbl_packingdetail_grid->RowIndex ?>_PackingOrNoPacking" value="<?php echo HtmlEncode($tbl_packingdetail->PackingOrNoPacking->OldValue) ?>">
<?php } ?>
<?php if ($tbl_packingdetail->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $tbl_packingdetail_grid->RowCnt ?>_tbl_packingdetail_PackingOrNoPacking" class="form-group tbl_packingdetail_PackingOrNoPacking">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="tbl_packingdetail" data-field="x_PackingOrNoPacking" data-value-separator="<?php echo $tbl_packingdetail->PackingOrNoPacking->displayValueSeparatorAttribute() ?>" id="x<?php echo $tbl_packingdetail_grid->RowIndex ?>_PackingOrNoPacking" name="x<?php echo $tbl_packingdetail_grid->RowIndex ?>_PackingOrNoPacking"<?php echo $tbl_packingdetail->PackingOrNoPacking->editAttributes() ?>>
		<?php echo $tbl_packingdetail->PackingOrNoPacking->selectOptionListHtml("x<?php echo $tbl_packingdetail_grid->RowIndex ?>_PackingOrNoPacking") ?>
	</select>
</div>
</span>
<?php } ?>
<?php if ($tbl_packingdetail->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $tbl_packingdetail_grid->RowCnt ?>_tbl_packingdetail_PackingOrNoPacking" class="tbl_packingdetail_PackingOrNoPacking">
<span<?php echo $tbl_packingdetail->PackingOrNoPacking->viewAttributes() ?>>
<?php echo $tbl_packingdetail->PackingOrNoPacking->getViewValue() ?></span>
</span>
<?php if (!$tbl_packingdetail->isConfirm()) { ?>
<input type="hidden" data-table="tbl_packingdetail" data-field="x_PackingOrNoPacking" name="x<?php echo $tbl_packingdetail_grid->RowIndex ?>_PackingOrNoPacking" id="x<?php echo $tbl_packingdetail_grid->RowIndex ?>_PackingOrNoPacking" value="<?php echo HtmlEncode($tbl_packingdetail->PackingOrNoPacking->FormValue) ?>">
<input type="hidden" data-table="tbl_packingdetail" data-field="x_PackingOrNoPacking" name="o<?php echo $tbl_packingdetail_grid->RowIndex ?>_PackingOrNoPacking" id="o<?php echo $tbl_packingdetail_grid->RowIndex ?>_PackingOrNoPacking" value="<?php echo HtmlEncode($tbl_packingdetail->PackingOrNoPacking->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="tbl_packingdetail" data-field="x_PackingOrNoPacking" name="ftbl_packingdetailgrid$x<?php echo $tbl_packingdetail_grid->RowIndex ?>_PackingOrNoPacking" id="ftbl_packingdetailgrid$x<?php echo $tbl_packingdetail_grid->RowIndex ?>_PackingOrNoPacking" value="<?php echo HtmlEncode($tbl_packingdetail->PackingOrNoPacking->FormValue) ?>">
<input type="hidden" data-table="tbl_packingdetail" data-field="x_PackingOrNoPacking" name="ftbl_packingdetailgrid$o<?php echo $tbl_packingdetail_grid->RowIndex ?>_PackingOrNoPacking" id="ftbl_packingdetailgrid$o<?php echo $tbl_packingdetail_grid->RowIndex ?>_PackingOrNoPacking" value="<?php echo HtmlEncode($tbl_packingdetail->PackingOrNoPacking->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($tbl_packingdetail->PackingType->Visible) { // PackingType ?>
		<td data-name="PackingType"<?php echo $tbl_packingdetail->PackingType->cellAttributes() ?>>
<?php if ($tbl_packingdetail->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $tbl_packingdetail_grid->RowCnt ?>_tbl_packingdetail_PackingType" class="form-group tbl_packingdetail_PackingType">
<input type="text" data-table="tbl_packingdetail" data-field="x_PackingType" name="x<?php echo $tbl_packingdetail_grid->RowIndex ?>_PackingType" id="x<?php echo $tbl_packingdetail_grid->RowIndex ?>_PackingType" size="30" maxlength="55" placeholder="<?php echo HtmlEncode($tbl_packingdetail->PackingType->getPlaceHolder()) ?>" value="<?php echo $tbl_packingdetail->PackingType->EditValue ?>"<?php echo $tbl_packingdetail->PackingType->editAttributes() ?>>
</span>
<input type="hidden" data-table="tbl_packingdetail" data-field="x_PackingType" name="o<?php echo $tbl_packingdetail_grid->RowIndex ?>_PackingType" id="o<?php echo $tbl_packingdetail_grid->RowIndex ?>_PackingType" value="<?php echo HtmlEncode($tbl_packingdetail->PackingType->OldValue) ?>">
<?php } ?>
<?php if ($tbl_packingdetail->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $tbl_packingdetail_grid->RowCnt ?>_tbl_packingdetail_PackingType" class="form-group tbl_packingdetail_PackingType">
<input type="text" data-table="tbl_packingdetail" data-field="x_PackingType" name="x<?php echo $tbl_packingdetail_grid->RowIndex ?>_PackingType" id="x<?php echo $tbl_packingdetail_grid->RowIndex ?>_PackingType" size="30" maxlength="55" placeholder="<?php echo HtmlEncode($tbl_packingdetail->PackingType->getPlaceHolder()) ?>" value="<?php echo $tbl_packingdetail->PackingType->EditValue ?>"<?php echo $tbl_packingdetail->PackingType->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($tbl_packingdetail->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $tbl_packingdetail_grid->RowCnt ?>_tbl_packingdetail_PackingType" class="tbl_packingdetail_PackingType">
<span<?php echo $tbl_packingdetail->PackingType->viewAttributes() ?>>
<?php echo $tbl_packingdetail->PackingType->getViewValue() ?></span>
</span>
<?php if (!$tbl_packingdetail->isConfirm()) { ?>
<input type="hidden" data-table="tbl_packingdetail" data-field="x_PackingType" name="x<?php echo $tbl_packingdetail_grid->RowIndex ?>_PackingType" id="x<?php echo $tbl_packingdetail_grid->RowIndex ?>_PackingType" value="<?php echo HtmlEncode($tbl_packingdetail->PackingType->FormValue) ?>">
<input type="hidden" data-table="tbl_packingdetail" data-field="x_PackingType" name="o<?php echo $tbl_packingdetail_grid->RowIndex ?>_PackingType" id="o<?php echo $tbl_packingdetail_grid->RowIndex ?>_PackingType" value="<?php echo HtmlEncode($tbl_packingdetail->PackingType->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="tbl_packingdetail" data-field="x_PackingType" name="ftbl_packingdetailgrid$x<?php echo $tbl_packingdetail_grid->RowIndex ?>_PackingType" id="ftbl_packingdetailgrid$x<?php echo $tbl_packingdetail_grid->RowIndex ?>_PackingType" value="<?php echo HtmlEncode($tbl_packingdetail->PackingType->FormValue) ?>">
<input type="hidden" data-table="tbl_packingdetail" data-field="x_PackingType" name="ftbl_packingdetailgrid$o<?php echo $tbl_packingdetail_grid->RowIndex ?>_PackingType" id="ftbl_packingdetailgrid$o<?php echo $tbl_packingdetail_grid->RowIndex ?>_PackingType" value="<?php echo HtmlEncode($tbl_packingdetail->PackingType->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($tbl_packingdetail->Length->Visible) { // Length ?>
		<td data-name="Length"<?php echo $tbl_packingdetail->Length->cellAttributes() ?>>
<?php if ($tbl_packingdetail->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $tbl_packingdetail_grid->RowCnt ?>_tbl_packingdetail_Length" class="form-group tbl_packingdetail_Length">
<input type="text" data-table="tbl_packingdetail" data-field="x_Length" name="x<?php echo $tbl_packingdetail_grid->RowIndex ?>_Length" id="x<?php echo $tbl_packingdetail_grid->RowIndex ?>_Length" size="30" placeholder="<?php echo HtmlEncode($tbl_packingdetail->Length->getPlaceHolder()) ?>" value="<?php echo $tbl_packingdetail->Length->EditValue ?>"<?php echo $tbl_packingdetail->Length->editAttributes() ?>>
</span>
<input type="hidden" data-table="tbl_packingdetail" data-field="x_Length" name="o<?php echo $tbl_packingdetail_grid->RowIndex ?>_Length" id="o<?php echo $tbl_packingdetail_grid->RowIndex ?>_Length" value="<?php echo HtmlEncode($tbl_packingdetail->Length->OldValue) ?>">
<?php } ?>
<?php if ($tbl_packingdetail->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $tbl_packingdetail_grid->RowCnt ?>_tbl_packingdetail_Length" class="form-group tbl_packingdetail_Length">
<input type="text" data-table="tbl_packingdetail" data-field="x_Length" name="x<?php echo $tbl_packingdetail_grid->RowIndex ?>_Length" id="x<?php echo $tbl_packingdetail_grid->RowIndex ?>_Length" size="30" placeholder="<?php echo HtmlEncode($tbl_packingdetail->Length->getPlaceHolder()) ?>" value="<?php echo $tbl_packingdetail->Length->EditValue ?>"<?php echo $tbl_packingdetail->Length->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($tbl_packingdetail->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $tbl_packingdetail_grid->RowCnt ?>_tbl_packingdetail_Length" class="tbl_packingdetail_Length">
<span<?php echo $tbl_packingdetail->Length->viewAttributes() ?>>
<?php echo $tbl_packingdetail->Length->getViewValue() ?></span>
</span>
<?php if (!$tbl_packingdetail->isConfirm()) { ?>
<input type="hidden" data-table="tbl_packingdetail" data-field="x_Length" name="x<?php echo $tbl_packingdetail_grid->RowIndex ?>_Length" id="x<?php echo $tbl_packingdetail_grid->RowIndex ?>_Length" value="<?php echo HtmlEncode($tbl_packingdetail->Length->FormValue) ?>">
<input type="hidden" data-table="tbl_packingdetail" data-field="x_Length" name="o<?php echo $tbl_packingdetail_grid->RowIndex ?>_Length" id="o<?php echo $tbl_packingdetail_grid->RowIndex ?>_Length" value="<?php echo HtmlEncode($tbl_packingdetail->Length->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="tbl_packingdetail" data-field="x_Length" name="ftbl_packingdetailgrid$x<?php echo $tbl_packingdetail_grid->RowIndex ?>_Length" id="ftbl_packingdetailgrid$x<?php echo $tbl_packingdetail_grid->RowIndex ?>_Length" value="<?php echo HtmlEncode($tbl_packingdetail->Length->FormValue) ?>">
<input type="hidden" data-table="tbl_packingdetail" data-field="x_Length" name="ftbl_packingdetailgrid$o<?php echo $tbl_packingdetail_grid->RowIndex ?>_Length" id="ftbl_packingdetailgrid$o<?php echo $tbl_packingdetail_grid->RowIndex ?>_Length" value="<?php echo HtmlEncode($tbl_packingdetail->Length->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($tbl_packingdetail->Width->Visible) { // Width ?>
		<td data-name="Width"<?php echo $tbl_packingdetail->Width->cellAttributes() ?>>
<?php if ($tbl_packingdetail->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $tbl_packingdetail_grid->RowCnt ?>_tbl_packingdetail_Width" class="form-group tbl_packingdetail_Width">
<input type="text" data-table="tbl_packingdetail" data-field="x_Width" name="x<?php echo $tbl_packingdetail_grid->RowIndex ?>_Width" id="x<?php echo $tbl_packingdetail_grid->RowIndex ?>_Width" size="30" placeholder="<?php echo HtmlEncode($tbl_packingdetail->Width->getPlaceHolder()) ?>" value="<?php echo $tbl_packingdetail->Width->EditValue ?>"<?php echo $tbl_packingdetail->Width->editAttributes() ?>>
</span>
<input type="hidden" data-table="tbl_packingdetail" data-field="x_Width" name="o<?php echo $tbl_packingdetail_grid->RowIndex ?>_Width" id="o<?php echo $tbl_packingdetail_grid->RowIndex ?>_Width" value="<?php echo HtmlEncode($tbl_packingdetail->Width->OldValue) ?>">
<?php } ?>
<?php if ($tbl_packingdetail->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $tbl_packingdetail_grid->RowCnt ?>_tbl_packingdetail_Width" class="form-group tbl_packingdetail_Width">
<input type="text" data-table="tbl_packingdetail" data-field="x_Width" name="x<?php echo $tbl_packingdetail_grid->RowIndex ?>_Width" id="x<?php echo $tbl_packingdetail_grid->RowIndex ?>_Width" size="30" placeholder="<?php echo HtmlEncode($tbl_packingdetail->Width->getPlaceHolder()) ?>" value="<?php echo $tbl_packingdetail->Width->EditValue ?>"<?php echo $tbl_packingdetail->Width->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($tbl_packingdetail->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $tbl_packingdetail_grid->RowCnt ?>_tbl_packingdetail_Width" class="tbl_packingdetail_Width">
<span<?php echo $tbl_packingdetail->Width->viewAttributes() ?>>
<?php echo $tbl_packingdetail->Width->getViewValue() ?></span>
</span>
<?php if (!$tbl_packingdetail->isConfirm()) { ?>
<input type="hidden" data-table="tbl_packingdetail" data-field="x_Width" name="x<?php echo $tbl_packingdetail_grid->RowIndex ?>_Width" id="x<?php echo $tbl_packingdetail_grid->RowIndex ?>_Width" value="<?php echo HtmlEncode($tbl_packingdetail->Width->FormValue) ?>">
<input type="hidden" data-table="tbl_packingdetail" data-field="x_Width" name="o<?php echo $tbl_packingdetail_grid->RowIndex ?>_Width" id="o<?php echo $tbl_packingdetail_grid->RowIndex ?>_Width" value="<?php echo HtmlEncode($tbl_packingdetail->Width->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="tbl_packingdetail" data-field="x_Width" name="ftbl_packingdetailgrid$x<?php echo $tbl_packingdetail_grid->RowIndex ?>_Width" id="ftbl_packingdetailgrid$x<?php echo $tbl_packingdetail_grid->RowIndex ?>_Width" value="<?php echo HtmlEncode($tbl_packingdetail->Width->FormValue) ?>">
<input type="hidden" data-table="tbl_packingdetail" data-field="x_Width" name="ftbl_packingdetailgrid$o<?php echo $tbl_packingdetail_grid->RowIndex ?>_Width" id="ftbl_packingdetailgrid$o<?php echo $tbl_packingdetail_grid->RowIndex ?>_Width" value="<?php echo HtmlEncode($tbl_packingdetail->Width->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($tbl_packingdetail->Heigth->Visible) { // Heigth ?>
		<td data-name="Heigth"<?php echo $tbl_packingdetail->Heigth->cellAttributes() ?>>
<?php if ($tbl_packingdetail->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $tbl_packingdetail_grid->RowCnt ?>_tbl_packingdetail_Heigth" class="form-group tbl_packingdetail_Heigth">
<input type="text" data-table="tbl_packingdetail" data-field="x_Heigth" name="x<?php echo $tbl_packingdetail_grid->RowIndex ?>_Heigth" id="x<?php echo $tbl_packingdetail_grid->RowIndex ?>_Heigth" size="30" placeholder="<?php echo HtmlEncode($tbl_packingdetail->Heigth->getPlaceHolder()) ?>" value="<?php echo $tbl_packingdetail->Heigth->EditValue ?>"<?php echo $tbl_packingdetail->Heigth->editAttributes() ?>>
</span>
<input type="hidden" data-table="tbl_packingdetail" data-field="x_Heigth" name="o<?php echo $tbl_packingdetail_grid->RowIndex ?>_Heigth" id="o<?php echo $tbl_packingdetail_grid->RowIndex ?>_Heigth" value="<?php echo HtmlEncode($tbl_packingdetail->Heigth->OldValue) ?>">
<?php } ?>
<?php if ($tbl_packingdetail->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $tbl_packingdetail_grid->RowCnt ?>_tbl_packingdetail_Heigth" class="form-group tbl_packingdetail_Heigth">
<input type="text" data-table="tbl_packingdetail" data-field="x_Heigth" name="x<?php echo $tbl_packingdetail_grid->RowIndex ?>_Heigth" id="x<?php echo $tbl_packingdetail_grid->RowIndex ?>_Heigth" size="30" placeholder="<?php echo HtmlEncode($tbl_packingdetail->Heigth->getPlaceHolder()) ?>" value="<?php echo $tbl_packingdetail->Heigth->EditValue ?>"<?php echo $tbl_packingdetail->Heigth->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($tbl_packingdetail->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $tbl_packingdetail_grid->RowCnt ?>_tbl_packingdetail_Heigth" class="tbl_packingdetail_Heigth">
<span<?php echo $tbl_packingdetail->Heigth->viewAttributes() ?>>
<?php echo $tbl_packingdetail->Heigth->getViewValue() ?></span>
</span>
<?php if (!$tbl_packingdetail->isConfirm()) { ?>
<input type="hidden" data-table="tbl_packingdetail" data-field="x_Heigth" name="x<?php echo $tbl_packingdetail_grid->RowIndex ?>_Heigth" id="x<?php echo $tbl_packingdetail_grid->RowIndex ?>_Heigth" value="<?php echo HtmlEncode($tbl_packingdetail->Heigth->FormValue) ?>">
<input type="hidden" data-table="tbl_packingdetail" data-field="x_Heigth" name="o<?php echo $tbl_packingdetail_grid->RowIndex ?>_Heigth" id="o<?php echo $tbl_packingdetail_grid->RowIndex ?>_Heigth" value="<?php echo HtmlEncode($tbl_packingdetail->Heigth->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="tbl_packingdetail" data-field="x_Heigth" name="ftbl_packingdetailgrid$x<?php echo $tbl_packingdetail_grid->RowIndex ?>_Heigth" id="ftbl_packingdetailgrid$x<?php echo $tbl_packingdetail_grid->RowIndex ?>_Heigth" value="<?php echo HtmlEncode($tbl_packingdetail->Heigth->FormValue) ?>">
<input type="hidden" data-table="tbl_packingdetail" data-field="x_Heigth" name="ftbl_packingdetailgrid$o<?php echo $tbl_packingdetail_grid->RowIndex ?>_Heigth" id="ftbl_packingdetailgrid$o<?php echo $tbl_packingdetail_grid->RowIndex ?>_Heigth" value="<?php echo HtmlEncode($tbl_packingdetail->Heigth->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($tbl_packingdetail->PE_film_Cover->Visible) { // PE_film_Cover ?>
		<td data-name="PE_film_Cover"<?php echo $tbl_packingdetail->PE_film_Cover->cellAttributes() ?>>
<?php if ($tbl_packingdetail->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $tbl_packingdetail_grid->RowCnt ?>_tbl_packingdetail_PE_film_Cover" class="form-group tbl_packingdetail_PE_film_Cover">
<div id="tp_x<?php echo $tbl_packingdetail_grid->RowIndex ?>_PE_film_Cover" class="ew-template"><input type="radio" class="form-check-input" data-table="tbl_packingdetail" data-field="x_PE_film_Cover" data-value-separator="<?php echo $tbl_packingdetail->PE_film_Cover->displayValueSeparatorAttribute() ?>" name="x<?php echo $tbl_packingdetail_grid->RowIndex ?>_PE_film_Cover" id="x<?php echo $tbl_packingdetail_grid->RowIndex ?>_PE_film_Cover" value="{value}"<?php echo $tbl_packingdetail->PE_film_Cover->editAttributes() ?>></div>
<div id="dsl_x<?php echo $tbl_packingdetail_grid->RowIndex ?>_PE_film_Cover" data-repeatcolumn="5" class="ew-item-list d-none"><div>
<?php echo $tbl_packingdetail->PE_film_Cover->radioButtonListHtml(FALSE, "x{$tbl_packingdetail_grid->RowIndex}_PE_film_Cover") ?>
</div></div>
</span>
<input type="hidden" data-table="tbl_packingdetail" data-field="x_PE_film_Cover" name="o<?php echo $tbl_packingdetail_grid->RowIndex ?>_PE_film_Cover" id="o<?php echo $tbl_packingdetail_grid->RowIndex ?>_PE_film_Cover" value="<?php echo HtmlEncode($tbl_packingdetail->PE_film_Cover->OldValue) ?>">
<?php } ?>
<?php if ($tbl_packingdetail->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $tbl_packingdetail_grid->RowCnt ?>_tbl_packingdetail_PE_film_Cover" class="form-group tbl_packingdetail_PE_film_Cover">
<div id="tp_x<?php echo $tbl_packingdetail_grid->RowIndex ?>_PE_film_Cover" class="ew-template"><input type="radio" class="form-check-input" data-table="tbl_packingdetail" data-field="x_PE_film_Cover" data-value-separator="<?php echo $tbl_packingdetail->PE_film_Cover->displayValueSeparatorAttribute() ?>" name="x<?php echo $tbl_packingdetail_grid->RowIndex ?>_PE_film_Cover" id="x<?php echo $tbl_packingdetail_grid->RowIndex ?>_PE_film_Cover" value="{value}"<?php echo $tbl_packingdetail->PE_film_Cover->editAttributes() ?>></div>
<div id="dsl_x<?php echo $tbl_packingdetail_grid->RowIndex ?>_PE_film_Cover" data-repeatcolumn="5" class="ew-item-list d-none"><div>
<?php echo $tbl_packingdetail->PE_film_Cover->radioButtonListHtml(FALSE, "x{$tbl_packingdetail_grid->RowIndex}_PE_film_Cover") ?>
</div></div>
</span>
<?php } ?>
<?php if ($tbl_packingdetail->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $tbl_packingdetail_grid->RowCnt ?>_tbl_packingdetail_PE_film_Cover" class="tbl_packingdetail_PE_film_Cover">
<span<?php echo $tbl_packingdetail->PE_film_Cover->viewAttributes() ?>>
<?php echo $tbl_packingdetail->PE_film_Cover->getViewValue() ?></span>
</span>
<?php if (!$tbl_packingdetail->isConfirm()) { ?>
<input type="hidden" data-table="tbl_packingdetail" data-field="x_PE_film_Cover" name="x<?php echo $tbl_packingdetail_grid->RowIndex ?>_PE_film_Cover" id="x<?php echo $tbl_packingdetail_grid->RowIndex ?>_PE_film_Cover" value="<?php echo HtmlEncode($tbl_packingdetail->PE_film_Cover->FormValue) ?>">
<input type="hidden" data-table="tbl_packingdetail" data-field="x_PE_film_Cover" name="o<?php echo $tbl_packingdetail_grid->RowIndex ?>_PE_film_Cover" id="o<?php echo $tbl_packingdetail_grid->RowIndex ?>_PE_film_Cover" value="<?php echo HtmlEncode($tbl_packingdetail->PE_film_Cover->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="tbl_packingdetail" data-field="x_PE_film_Cover" name="ftbl_packingdetailgrid$x<?php echo $tbl_packingdetail_grid->RowIndex ?>_PE_film_Cover" id="ftbl_packingdetailgrid$x<?php echo $tbl_packingdetail_grid->RowIndex ?>_PE_film_Cover" value="<?php echo HtmlEncode($tbl_packingdetail->PE_film_Cover->FormValue) ?>">
<input type="hidden" data-table="tbl_packingdetail" data-field="x_PE_film_Cover" name="ftbl_packingdetailgrid$o<?php echo $tbl_packingdetail_grid->RowIndex ?>_PE_film_Cover" id="ftbl_packingdetailgrid$o<?php echo $tbl_packingdetail_grid->RowIndex ?>_PE_film_Cover" value="<?php echo HtmlEncode($tbl_packingdetail->PE_film_Cover->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($tbl_packingdetail->finishpacking->Visible) { // finishpacking ?>
		<td data-name="finishpacking"<?php echo $tbl_packingdetail->finishpacking->cellAttributes() ?>>
<?php if ($tbl_packingdetail->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $tbl_packingdetail_grid->RowCnt ?>_tbl_packingdetail_finishpacking" class="form-group tbl_packingdetail_finishpacking">
<div id="tp_x<?php echo $tbl_packingdetail_grid->RowIndex ?>_finishpacking" class="ew-template"><input type="radio" class="form-check-input" data-table="tbl_packingdetail" data-field="x_finishpacking" data-value-separator="<?php echo $tbl_packingdetail->finishpacking->displayValueSeparatorAttribute() ?>" name="x<?php echo $tbl_packingdetail_grid->RowIndex ?>_finishpacking" id="x<?php echo $tbl_packingdetail_grid->RowIndex ?>_finishpacking" value="{value}"<?php echo $tbl_packingdetail->finishpacking->editAttributes() ?>></div>
<div id="dsl_x<?php echo $tbl_packingdetail_grid->RowIndex ?>_finishpacking" data-repeatcolumn="5" class="ew-item-list d-none"><div>
<?php echo $tbl_packingdetail->finishpacking->radioButtonListHtml(FALSE, "x{$tbl_packingdetail_grid->RowIndex}_finishpacking") ?>
</div></div>
</span>
<input type="hidden" data-table="tbl_packingdetail" data-field="x_finishpacking" name="o<?php echo $tbl_packingdetail_grid->RowIndex ?>_finishpacking" id="o<?php echo $tbl_packingdetail_grid->RowIndex ?>_finishpacking" value="<?php echo HtmlEncode($tbl_packingdetail->finishpacking->OldValue) ?>">
<?php } ?>
<?php if ($tbl_packingdetail->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $tbl_packingdetail_grid->RowCnt ?>_tbl_packingdetail_finishpacking" class="form-group tbl_packingdetail_finishpacking">
<div id="tp_x<?php echo $tbl_packingdetail_grid->RowIndex ?>_finishpacking" class="ew-template"><input type="radio" class="form-check-input" data-table="tbl_packingdetail" data-field="x_finishpacking" data-value-separator="<?php echo $tbl_packingdetail->finishpacking->displayValueSeparatorAttribute() ?>" name="x<?php echo $tbl_packingdetail_grid->RowIndex ?>_finishpacking" id="x<?php echo $tbl_packingdetail_grid->RowIndex ?>_finishpacking" value="{value}"<?php echo $tbl_packingdetail->finishpacking->editAttributes() ?>></div>
<div id="dsl_x<?php echo $tbl_packingdetail_grid->RowIndex ?>_finishpacking" data-repeatcolumn="5" class="ew-item-list d-none"><div>
<?php echo $tbl_packingdetail->finishpacking->radioButtonListHtml(FALSE, "x{$tbl_packingdetail_grid->RowIndex}_finishpacking") ?>
</div></div>
</span>
<?php } ?>
<?php if ($tbl_packingdetail->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $tbl_packingdetail_grid->RowCnt ?>_tbl_packingdetail_finishpacking" class="tbl_packingdetail_finishpacking">
<span<?php echo $tbl_packingdetail->finishpacking->viewAttributes() ?>>
<?php echo $tbl_packingdetail->finishpacking->getViewValue() ?></span>
</span>
<?php if (!$tbl_packingdetail->isConfirm()) { ?>
<input type="hidden" data-table="tbl_packingdetail" data-field="x_finishpacking" name="x<?php echo $tbl_packingdetail_grid->RowIndex ?>_finishpacking" id="x<?php echo $tbl_packingdetail_grid->RowIndex ?>_finishpacking" value="<?php echo HtmlEncode($tbl_packingdetail->finishpacking->FormValue) ?>">
<input type="hidden" data-table="tbl_packingdetail" data-field="x_finishpacking" name="o<?php echo $tbl_packingdetail_grid->RowIndex ?>_finishpacking" id="o<?php echo $tbl_packingdetail_grid->RowIndex ?>_finishpacking" value="<?php echo HtmlEncode($tbl_packingdetail->finishpacking->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="tbl_packingdetail" data-field="x_finishpacking" name="ftbl_packingdetailgrid$x<?php echo $tbl_packingdetail_grid->RowIndex ?>_finishpacking" id="ftbl_packingdetailgrid$x<?php echo $tbl_packingdetail_grid->RowIndex ?>_finishpacking" value="<?php echo HtmlEncode($tbl_packingdetail->finishpacking->FormValue) ?>">
<input type="hidden" data-table="tbl_packingdetail" data-field="x_finishpacking" name="ftbl_packingdetailgrid$o<?php echo $tbl_packingdetail_grid->RowIndex ?>_finishpacking" id="ftbl_packingdetailgrid$o<?php echo $tbl_packingdetail_grid->RowIndex ?>_finishpacking" value="<?php echo HtmlEncode($tbl_packingdetail->finishpacking->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$tbl_packingdetail_grid->ListOptions->render("body", "right", $tbl_packingdetail_grid->RowCnt);
?>
	</tr>
<?php if ($tbl_packingdetail->RowType == ROWTYPE_ADD || $tbl_packingdetail->RowType == ROWTYPE_EDIT) { ?>
<script>
ftbl_packingdetailgrid.updateLists(<?php echo $tbl_packingdetail_grid->RowIndex ?>);
</script>
<?php } ?>
<?php
	}
	} // End delete row checking
	if (!$tbl_packingdetail->isGridAdd() || $tbl_packingdetail->CurrentMode == "copy")
		if (!$tbl_packingdetail_grid->Recordset->EOF)
			$tbl_packingdetail_grid->Recordset->moveNext();
}
?>
<?php
	if ($tbl_packingdetail->CurrentMode == "add" || $tbl_packingdetail->CurrentMode == "copy" || $tbl_packingdetail->CurrentMode == "edit") {
		$tbl_packingdetail_grid->RowIndex = '$rowindex$';
		$tbl_packingdetail_grid->loadRowValues();

		// Set row properties
		$tbl_packingdetail->resetAttributes();
		$tbl_packingdetail->RowAttrs = array_merge($tbl_packingdetail->RowAttrs, array('data-rowindex'=>$tbl_packingdetail_grid->RowIndex, 'id'=>'r0_tbl_packingdetail', 'data-rowtype'=>ROWTYPE_ADD));
		AppendClass($tbl_packingdetail->RowAttrs["class"], "ew-template");
		$tbl_packingdetail->RowType = ROWTYPE_ADD;

		// Render row
		$tbl_packingdetail_grid->renderRow();

		// Render list options
		$tbl_packingdetail_grid->renderListOptions();
		$tbl_packingdetail_grid->StartRowCnt = 0;
?>
	<tr<?php echo $tbl_packingdetail->rowAttributes() ?>>
<?php

// Render list options (body, left)
$tbl_packingdetail_grid->ListOptions->render("body", "left", $tbl_packingdetail_grid->RowIndex);
?>
	<?php if ($tbl_packingdetail->ID_packingDetail->Visible) { // ID_packingDetail ?>
		<td data-name="ID_packingDetail">
<?php if (!$tbl_packingdetail->isConfirm()) { ?>
<?php } else { ?>
<span id="el$rowindex$_tbl_packingdetail_ID_packingDetail" class="form-group tbl_packingdetail_ID_packingDetail">
<span<?php echo $tbl_packingdetail->ID_packingDetail->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?php echo RemoveHtml($tbl_packingdetail->ID_packingDetail->ViewValue) ?>"></span>
</span>
<input type="hidden" data-table="tbl_packingdetail" data-field="x_ID_packingDetail" name="x<?php echo $tbl_packingdetail_grid->RowIndex ?>_ID_packingDetail" id="x<?php echo $tbl_packingdetail_grid->RowIndex ?>_ID_packingDetail" value="<?php echo HtmlEncode($tbl_packingdetail->ID_packingDetail->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="tbl_packingdetail" data-field="x_ID_packingDetail" name="o<?php echo $tbl_packingdetail_grid->RowIndex ?>_ID_packingDetail" id="o<?php echo $tbl_packingdetail_grid->RowIndex ?>_ID_packingDetail" value="<?php echo HtmlEncode($tbl_packingdetail->ID_packingDetail->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($tbl_packingdetail->PackingOrNoPacking->Visible) { // PackingOrNoPacking ?>
		<td data-name="PackingOrNoPacking">
<?php if (!$tbl_packingdetail->isConfirm()) { ?>
<span id="el$rowindex$_tbl_packingdetail_PackingOrNoPacking" class="form-group tbl_packingdetail_PackingOrNoPacking">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="tbl_packingdetail" data-field="x_PackingOrNoPacking" data-value-separator="<?php echo $tbl_packingdetail->PackingOrNoPacking->displayValueSeparatorAttribute() ?>" id="x<?php echo $tbl_packingdetail_grid->RowIndex ?>_PackingOrNoPacking" name="x<?php echo $tbl_packingdetail_grid->RowIndex ?>_PackingOrNoPacking"<?php echo $tbl_packingdetail->PackingOrNoPacking->editAttributes() ?>>
		<?php echo $tbl_packingdetail->PackingOrNoPacking->selectOptionListHtml("x<?php echo $tbl_packingdetail_grid->RowIndex ?>_PackingOrNoPacking") ?>
	</select>
</div>
</span>
<?php } else { ?>
<span id="el$rowindex$_tbl_packingdetail_PackingOrNoPacking" class="form-group tbl_packingdetail_PackingOrNoPacking">
<span<?php echo $tbl_packingdetail->PackingOrNoPacking->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?php echo RemoveHtml($tbl_packingdetail->PackingOrNoPacking->ViewValue) ?>"></span>
</span>
<input type="hidden" data-table="tbl_packingdetail" data-field="x_PackingOrNoPacking" name="x<?php echo $tbl_packingdetail_grid->RowIndex ?>_PackingOrNoPacking" id="x<?php echo $tbl_packingdetail_grid->RowIndex ?>_PackingOrNoPacking" value="<?php echo HtmlEncode($tbl_packingdetail->PackingOrNoPacking->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="tbl_packingdetail" data-field="x_PackingOrNoPacking" name="o<?php echo $tbl_packingdetail_grid->RowIndex ?>_PackingOrNoPacking" id="o<?php echo $tbl_packingdetail_grid->RowIndex ?>_PackingOrNoPacking" value="<?php echo HtmlEncode($tbl_packingdetail->PackingOrNoPacking->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($tbl_packingdetail->PackingType->Visible) { // PackingType ?>
		<td data-name="PackingType">
<?php if (!$tbl_packingdetail->isConfirm()) { ?>
<span id="el$rowindex$_tbl_packingdetail_PackingType" class="form-group tbl_packingdetail_PackingType">
<input type="text" data-table="tbl_packingdetail" data-field="x_PackingType" name="x<?php echo $tbl_packingdetail_grid->RowIndex ?>_PackingType" id="x<?php echo $tbl_packingdetail_grid->RowIndex ?>_PackingType" size="30" maxlength="55" placeholder="<?php echo HtmlEncode($tbl_packingdetail->PackingType->getPlaceHolder()) ?>" value="<?php echo $tbl_packingdetail->PackingType->EditValue ?>"<?php echo $tbl_packingdetail->PackingType->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_tbl_packingdetail_PackingType" class="form-group tbl_packingdetail_PackingType">
<span<?php echo $tbl_packingdetail->PackingType->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?php echo RemoveHtml($tbl_packingdetail->PackingType->ViewValue) ?>"></span>
</span>
<input type="hidden" data-table="tbl_packingdetail" data-field="x_PackingType" name="x<?php echo $tbl_packingdetail_grid->RowIndex ?>_PackingType" id="x<?php echo $tbl_packingdetail_grid->RowIndex ?>_PackingType" value="<?php echo HtmlEncode($tbl_packingdetail->PackingType->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="tbl_packingdetail" data-field="x_PackingType" name="o<?php echo $tbl_packingdetail_grid->RowIndex ?>_PackingType" id="o<?php echo $tbl_packingdetail_grid->RowIndex ?>_PackingType" value="<?php echo HtmlEncode($tbl_packingdetail->PackingType->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($tbl_packingdetail->Length->Visible) { // Length ?>
		<td data-name="Length">
<?php if (!$tbl_packingdetail->isConfirm()) { ?>
<span id="el$rowindex$_tbl_packingdetail_Length" class="form-group tbl_packingdetail_Length">
<input type="text" data-table="tbl_packingdetail" data-field="x_Length" name="x<?php echo $tbl_packingdetail_grid->RowIndex ?>_Length" id="x<?php echo $tbl_packingdetail_grid->RowIndex ?>_Length" size="30" placeholder="<?php echo HtmlEncode($tbl_packingdetail->Length->getPlaceHolder()) ?>" value="<?php echo $tbl_packingdetail->Length->EditValue ?>"<?php echo $tbl_packingdetail->Length->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_tbl_packingdetail_Length" class="form-group tbl_packingdetail_Length">
<span<?php echo $tbl_packingdetail->Length->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?php echo RemoveHtml($tbl_packingdetail->Length->ViewValue) ?>"></span>
</span>
<input type="hidden" data-table="tbl_packingdetail" data-field="x_Length" name="x<?php echo $tbl_packingdetail_grid->RowIndex ?>_Length" id="x<?php echo $tbl_packingdetail_grid->RowIndex ?>_Length" value="<?php echo HtmlEncode($tbl_packingdetail->Length->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="tbl_packingdetail" data-field="x_Length" name="o<?php echo $tbl_packingdetail_grid->RowIndex ?>_Length" id="o<?php echo $tbl_packingdetail_grid->RowIndex ?>_Length" value="<?php echo HtmlEncode($tbl_packingdetail->Length->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($tbl_packingdetail->Width->Visible) { // Width ?>
		<td data-name="Width">
<?php if (!$tbl_packingdetail->isConfirm()) { ?>
<span id="el$rowindex$_tbl_packingdetail_Width" class="form-group tbl_packingdetail_Width">
<input type="text" data-table="tbl_packingdetail" data-field="x_Width" name="x<?php echo $tbl_packingdetail_grid->RowIndex ?>_Width" id="x<?php echo $tbl_packingdetail_grid->RowIndex ?>_Width" size="30" placeholder="<?php echo HtmlEncode($tbl_packingdetail->Width->getPlaceHolder()) ?>" value="<?php echo $tbl_packingdetail->Width->EditValue ?>"<?php echo $tbl_packingdetail->Width->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_tbl_packingdetail_Width" class="form-group tbl_packingdetail_Width">
<span<?php echo $tbl_packingdetail->Width->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?php echo RemoveHtml($tbl_packingdetail->Width->ViewValue) ?>"></span>
</span>
<input type="hidden" data-table="tbl_packingdetail" data-field="x_Width" name="x<?php echo $tbl_packingdetail_grid->RowIndex ?>_Width" id="x<?php echo $tbl_packingdetail_grid->RowIndex ?>_Width" value="<?php echo HtmlEncode($tbl_packingdetail->Width->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="tbl_packingdetail" data-field="x_Width" name="o<?php echo $tbl_packingdetail_grid->RowIndex ?>_Width" id="o<?php echo $tbl_packingdetail_grid->RowIndex ?>_Width" value="<?php echo HtmlEncode($tbl_packingdetail->Width->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($tbl_packingdetail->Heigth->Visible) { // Heigth ?>
		<td data-name="Heigth">
<?php if (!$tbl_packingdetail->isConfirm()) { ?>
<span id="el$rowindex$_tbl_packingdetail_Heigth" class="form-group tbl_packingdetail_Heigth">
<input type="text" data-table="tbl_packingdetail" data-field="x_Heigth" name="x<?php echo $tbl_packingdetail_grid->RowIndex ?>_Heigth" id="x<?php echo $tbl_packingdetail_grid->RowIndex ?>_Heigth" size="30" placeholder="<?php echo HtmlEncode($tbl_packingdetail->Heigth->getPlaceHolder()) ?>" value="<?php echo $tbl_packingdetail->Heigth->EditValue ?>"<?php echo $tbl_packingdetail->Heigth->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_tbl_packingdetail_Heigth" class="form-group tbl_packingdetail_Heigth">
<span<?php echo $tbl_packingdetail->Heigth->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?php echo RemoveHtml($tbl_packingdetail->Heigth->ViewValue) ?>"></span>
</span>
<input type="hidden" data-table="tbl_packingdetail" data-field="x_Heigth" name="x<?php echo $tbl_packingdetail_grid->RowIndex ?>_Heigth" id="x<?php echo $tbl_packingdetail_grid->RowIndex ?>_Heigth" value="<?php echo HtmlEncode($tbl_packingdetail->Heigth->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="tbl_packingdetail" data-field="x_Heigth" name="o<?php echo $tbl_packingdetail_grid->RowIndex ?>_Heigth" id="o<?php echo $tbl_packingdetail_grid->RowIndex ?>_Heigth" value="<?php echo HtmlEncode($tbl_packingdetail->Heigth->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($tbl_packingdetail->PE_film_Cover->Visible) { // PE_film_Cover ?>
		<td data-name="PE_film_Cover">
<?php if (!$tbl_packingdetail->isConfirm()) { ?>
<span id="el$rowindex$_tbl_packingdetail_PE_film_Cover" class="form-group tbl_packingdetail_PE_film_Cover">
<div id="tp_x<?php echo $tbl_packingdetail_grid->RowIndex ?>_PE_film_Cover" class="ew-template"><input type="radio" class="form-check-input" data-table="tbl_packingdetail" data-field="x_PE_film_Cover" data-value-separator="<?php echo $tbl_packingdetail->PE_film_Cover->displayValueSeparatorAttribute() ?>" name="x<?php echo $tbl_packingdetail_grid->RowIndex ?>_PE_film_Cover" id="x<?php echo $tbl_packingdetail_grid->RowIndex ?>_PE_film_Cover" value="{value}"<?php echo $tbl_packingdetail->PE_film_Cover->editAttributes() ?>></div>
<div id="dsl_x<?php echo $tbl_packingdetail_grid->RowIndex ?>_PE_film_Cover" data-repeatcolumn="5" class="ew-item-list d-none"><div>
<?php echo $tbl_packingdetail->PE_film_Cover->radioButtonListHtml(FALSE, "x{$tbl_packingdetail_grid->RowIndex}_PE_film_Cover") ?>
</div></div>
</span>
<?php } else { ?>
<span id="el$rowindex$_tbl_packingdetail_PE_film_Cover" class="form-group tbl_packingdetail_PE_film_Cover">
<span<?php echo $tbl_packingdetail->PE_film_Cover->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?php echo RemoveHtml($tbl_packingdetail->PE_film_Cover->ViewValue) ?>"></span>
</span>
<input type="hidden" data-table="tbl_packingdetail" data-field="x_PE_film_Cover" name="x<?php echo $tbl_packingdetail_grid->RowIndex ?>_PE_film_Cover" id="x<?php echo $tbl_packingdetail_grid->RowIndex ?>_PE_film_Cover" value="<?php echo HtmlEncode($tbl_packingdetail->PE_film_Cover->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="tbl_packingdetail" data-field="x_PE_film_Cover" name="o<?php echo $tbl_packingdetail_grid->RowIndex ?>_PE_film_Cover" id="o<?php echo $tbl_packingdetail_grid->RowIndex ?>_PE_film_Cover" value="<?php echo HtmlEncode($tbl_packingdetail->PE_film_Cover->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($tbl_packingdetail->finishpacking->Visible) { // finishpacking ?>
		<td data-name="finishpacking">
<?php if (!$tbl_packingdetail->isConfirm()) { ?>
<span id="el$rowindex$_tbl_packingdetail_finishpacking" class="form-group tbl_packingdetail_finishpacking">
<div id="tp_x<?php echo $tbl_packingdetail_grid->RowIndex ?>_finishpacking" class="ew-template"><input type="radio" class="form-check-input" data-table="tbl_packingdetail" data-field="x_finishpacking" data-value-separator="<?php echo $tbl_packingdetail->finishpacking->displayValueSeparatorAttribute() ?>" name="x<?php echo $tbl_packingdetail_grid->RowIndex ?>_finishpacking" id="x<?php echo $tbl_packingdetail_grid->RowIndex ?>_finishpacking" value="{value}"<?php echo $tbl_packingdetail->finishpacking->editAttributes() ?>></div>
<div id="dsl_x<?php echo $tbl_packingdetail_grid->RowIndex ?>_finishpacking" data-repeatcolumn="5" class="ew-item-list d-none"><div>
<?php echo $tbl_packingdetail->finishpacking->radioButtonListHtml(FALSE, "x{$tbl_packingdetail_grid->RowIndex}_finishpacking") ?>
</div></div>
</span>
<?php } else { ?>
<span id="el$rowindex$_tbl_packingdetail_finishpacking" class="form-group tbl_packingdetail_finishpacking">
<span<?php echo $tbl_packingdetail->finishpacking->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?php echo RemoveHtml($tbl_packingdetail->finishpacking->ViewValue) ?>"></span>
</span>
<input type="hidden" data-table="tbl_packingdetail" data-field="x_finishpacking" name="x<?php echo $tbl_packingdetail_grid->RowIndex ?>_finishpacking" id="x<?php echo $tbl_packingdetail_grid->RowIndex ?>_finishpacking" value="<?php echo HtmlEncode($tbl_packingdetail->finishpacking->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="tbl_packingdetail" data-field="x_finishpacking" name="o<?php echo $tbl_packingdetail_grid->RowIndex ?>_finishpacking" id="o<?php echo $tbl_packingdetail_grid->RowIndex ?>_finishpacking" value="<?php echo HtmlEncode($tbl_packingdetail->finishpacking->OldValue) ?>">
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$tbl_packingdetail_grid->ListOptions->render("body", "right", $tbl_packingdetail_grid->RowIndex);
?>
<script>
ftbl_packingdetailgrid.updateLists(<?php echo $tbl_packingdetail_grid->RowIndex ?>);
</script>
	</tr>
<?php
}
?>
</tbody>
</table><!-- /.ew-table -->
<?php if ($tbl_packingdetail->CurrentMode == "add" || $tbl_packingdetail->CurrentMode == "copy") { ?>
<input type="hidden" name="<?php echo $tbl_packingdetail_grid->FormKeyCountName ?>" id="<?php echo $tbl_packingdetail_grid->FormKeyCountName ?>" value="<?php echo $tbl_packingdetail_grid->KeyCount ?>">
<?php echo $tbl_packingdetail_grid->MultiSelectKey ?>
<?php } ?>
<?php if ($tbl_packingdetail->CurrentMode == "edit") { ?>
<input type="hidden" name="<?php echo $tbl_packingdetail_grid->FormKeyCountName ?>" id="<?php echo $tbl_packingdetail_grid->FormKeyCountName ?>" value="<?php echo $tbl_packingdetail_grid->KeyCount ?>">
<?php echo $tbl_packingdetail_grid->MultiSelectKey ?>
<?php } ?>
<?php if ($tbl_packingdetail->CurrentMode == "") { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
<input type="hidden" name="detailpage" value="ftbl_packingdetailgrid">
</div><!-- /.ew-grid-middle-panel -->
<?php

// Close recordset
if ($tbl_packingdetail_grid->Recordset)
	$tbl_packingdetail_grid->Recordset->Close();
?>
</div>
<?php if ($tbl_packingdetail_grid->ShowOtherOptions) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php $tbl_packingdetail_grid->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($tbl_packingdetail_grid->TotalRecs == 0 && !$tbl_packingdetail->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $tbl_packingdetail_grid->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$tbl_packingdetail_grid->terminate();
?>