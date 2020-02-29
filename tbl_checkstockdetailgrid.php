<?php
namespace PHPMaker2019\asgbn_wh;

// Write header
WriteHeader(FALSE);

// Create page object
if (!isset($tbl_checkstockdetail_grid))
	$tbl_checkstockdetail_grid = new tbl_checkstockdetail_grid();

// Run the page
$tbl_checkstockdetail_grid->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$tbl_checkstockdetail_grid->Page_Render();
?>
<?php if (!$tbl_checkstockdetail->isExport()) { ?>
<script>

// Form object
var ftbl_checkstockdetailgrid = new ew.Form("ftbl_checkstockdetailgrid", "grid");
ftbl_checkstockdetailgrid.formKeyCountName = '<?php echo $tbl_checkstockdetail_grid->FormKeyCountName ?>';

// Validate form
ftbl_checkstockdetailgrid.validate = function() {
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
		<?php if ($tbl_checkstockdetail_grid->Location->Required) { ?>
			elm = this.getElements("x" + infix + "_Location");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $tbl_checkstockdetail->Location->caption(), $tbl_checkstockdetail->Location->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($tbl_checkstockdetail_grid->PalletID->Required) { ?>
			elm = this.getElements("x" + infix + "_PalletID");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $tbl_checkstockdetail->PalletID->caption(), $tbl_checkstockdetail->PalletID->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($tbl_checkstockdetail_grid->Code->Required) { ?>
			elm = this.getElements("x" + infix + "_Code");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $tbl_checkstockdetail->Code->caption(), $tbl_checkstockdetail->Code->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($tbl_checkstockdetail_grid->PCS->Required) { ?>
			elm = this.getElements("x" + infix + "_PCS");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $tbl_checkstockdetail->PCS->caption(), $tbl_checkstockdetail->PCS->RequiredErrorMessage)) ?>");
		<?php } ?>
			elm = this.getElements("x" + infix + "_PCS");
			if (elm && !ew.checkInteger(elm.value))
				return this.onError(elm, "<?php echo JsEncode($tbl_checkstockdetail->PCS->errorMessage()) ?>");
		<?php if ($tbl_checkstockdetail_grid->DateTimeCheck->Required) { ?>
			elm = this.getElements("x" + infix + "_DateTimeCheck");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $tbl_checkstockdetail->DateTimeCheck->caption(), $tbl_checkstockdetail->DateTimeCheck->RequiredErrorMessage)) ?>");
		<?php } ?>
			elm = this.getElements("x" + infix + "_DateTimeCheck");
			if (elm && !ew.checkDateDef(elm.value))
				return this.onError(elm, "<?php echo JsEncode($tbl_checkstockdetail->DateTimeCheck->errorMessage()) ?>");
		<?php if ($tbl_checkstockdetail_grid->UserCheck->Required) { ?>
			elm = this.getElements("x" + infix + "_UserCheck");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $tbl_checkstockdetail->UserCheck->caption(), $tbl_checkstockdetail->UserCheck->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($tbl_checkstockdetail_grid->Usercreate->Required) { ?>
			elm = this.getElements("x" + infix + "_Usercreate");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $tbl_checkstockdetail->Usercreate->caption(), $tbl_checkstockdetail->Usercreate->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($tbl_checkstockdetail_grid->DatetimeCreate->Required) { ?>
			elm = this.getElements("x" + infix + "_DatetimeCreate");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $tbl_checkstockdetail->DatetimeCreate->caption(), $tbl_checkstockdetail->DatetimeCreate->RequiredErrorMessage)) ?>");
		<?php } ?>
			elm = this.getElements("x" + infix + "_DatetimeCreate");
			if (elm && !ew.checkDateDef(elm.value))
				return this.onError(elm, "<?php echo JsEncode($tbl_checkstockdetail->DatetimeCreate->errorMessage()) ?>");

			// Fire Form_CustomValidate event
			if (!this.Form_CustomValidate(fobj))
				return false;
		} // End Grid Add checking
	}
	return true;
}

// Check empty row
ftbl_checkstockdetailgrid.emptyRow = function(infix) {
	var fobj = this._form;
	if (ew.valueChanged(fobj, infix, "Location", false)) return false;
	if (ew.valueChanged(fobj, infix, "PalletID", false)) return false;
	if (ew.valueChanged(fobj, infix, "Code", false)) return false;
	if (ew.valueChanged(fobj, infix, "PCS", false)) return false;
	if (ew.valueChanged(fobj, infix, "DateTimeCheck", false)) return false;
	if (ew.valueChanged(fobj, infix, "UserCheck", false)) return false;
	if (ew.valueChanged(fobj, infix, "Usercreate", false)) return false;
	if (ew.valueChanged(fobj, infix, "DatetimeCreate", false)) return false;
	return true;
}

// Form_CustomValidate event
ftbl_checkstockdetailgrid.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

	// Your custom validation code here, return false if invalid.
	return true;
}

// Use JavaScript validation or not
ftbl_checkstockdetailgrid.validateRequired = <?php echo json_encode(CLIENT_VALIDATE) ?>;

// Dynamic selection lists
// Form object for search

</script>
<?php } ?>
<?php
$tbl_checkstockdetail_grid->renderOtherOptions();
?>
<?php $tbl_checkstockdetail_grid->showPageHeader(); ?>
<?php
$tbl_checkstockdetail_grid->showMessage();
?>
<?php if ($tbl_checkstockdetail_grid->TotalRecs > 0 || $tbl_checkstockdetail->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($tbl_checkstockdetail_grid->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> tbl_checkstockdetail">
<?php if ($tbl_checkstockdetail_grid->ShowOtherOptions) { ?>
<div class="card-header ew-grid-upper-panel">
<?php $tbl_checkstockdetail_grid->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<div id="ftbl_checkstockdetailgrid" class="ew-form ew-list-form form-inline">
<div id="gmp_tbl_checkstockdetail" class="<?php if (IsResponsiveLayout()) { ?>table-responsive <?php } ?>card-body ew-grid-middle-panel">
<table id="tbl_tbl_checkstockdetailgrid" class="table ew-table"><!-- .ew-table ##-->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$tbl_checkstockdetail_grid->RowType = ROWTYPE_HEADER;

// Render list options
$tbl_checkstockdetail_grid->renderListOptions();

// Render list options (header, left)
$tbl_checkstockdetail_grid->ListOptions->render("header", "left");
?>
<?php if ($tbl_checkstockdetail->Location->Visible) { // Location ?>
	<?php if ($tbl_checkstockdetail->sortUrl($tbl_checkstockdetail->Location) == "") { ?>
		<th data-name="Location" class="<?php echo $tbl_checkstockdetail->Location->headerCellClass() ?>" style="white-space: nowrap;"><div id="elh_tbl_checkstockdetail_Location" class="tbl_checkstockdetail_Location"><div class="ew-table-header-caption"><?php echo $tbl_checkstockdetail->Location->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Location" class="<?php echo $tbl_checkstockdetail->Location->headerCellClass() ?>" style="white-space: nowrap;"><div><div id="elh_tbl_checkstockdetail_Location" class="tbl_checkstockdetail_Location">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $tbl_checkstockdetail->Location->caption() ?></span><span class="ew-table-header-sort"><?php if ($tbl_checkstockdetail->Location->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($tbl_checkstockdetail->Location->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($tbl_checkstockdetail->PalletID->Visible) { // PalletID ?>
	<?php if ($tbl_checkstockdetail->sortUrl($tbl_checkstockdetail->PalletID) == "") { ?>
		<th data-name="PalletID" class="<?php echo $tbl_checkstockdetail->PalletID->headerCellClass() ?>" style="white-space: nowrap;"><div id="elh_tbl_checkstockdetail_PalletID" class="tbl_checkstockdetail_PalletID"><div class="ew-table-header-caption"><?php echo $tbl_checkstockdetail->PalletID->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="PalletID" class="<?php echo $tbl_checkstockdetail->PalletID->headerCellClass() ?>" style="white-space: nowrap;"><div><div id="elh_tbl_checkstockdetail_PalletID" class="tbl_checkstockdetail_PalletID">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $tbl_checkstockdetail->PalletID->caption() ?></span><span class="ew-table-header-sort"><?php if ($tbl_checkstockdetail->PalletID->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($tbl_checkstockdetail->PalletID->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($tbl_checkstockdetail->Code->Visible) { // Code ?>
	<?php if ($tbl_checkstockdetail->sortUrl($tbl_checkstockdetail->Code) == "") { ?>
		<th data-name="Code" class="<?php echo $tbl_checkstockdetail->Code->headerCellClass() ?>" style="white-space: nowrap;"><div id="elh_tbl_checkstockdetail_Code" class="tbl_checkstockdetail_Code"><div class="ew-table-header-caption"><?php echo $tbl_checkstockdetail->Code->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Code" class="<?php echo $tbl_checkstockdetail->Code->headerCellClass() ?>" style="white-space: nowrap;"><div><div id="elh_tbl_checkstockdetail_Code" class="tbl_checkstockdetail_Code">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $tbl_checkstockdetail->Code->caption() ?></span><span class="ew-table-header-sort"><?php if ($tbl_checkstockdetail->Code->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($tbl_checkstockdetail->Code->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($tbl_checkstockdetail->PCS->Visible) { // PCS ?>
	<?php if ($tbl_checkstockdetail->sortUrl($tbl_checkstockdetail->PCS) == "") { ?>
		<th data-name="PCS" class="<?php echo $tbl_checkstockdetail->PCS->headerCellClass() ?>" style="white-space: nowrap;"><div id="elh_tbl_checkstockdetail_PCS" class="tbl_checkstockdetail_PCS"><div class="ew-table-header-caption"><?php echo $tbl_checkstockdetail->PCS->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="PCS" class="<?php echo $tbl_checkstockdetail->PCS->headerCellClass() ?>" style="white-space: nowrap;"><div><div id="elh_tbl_checkstockdetail_PCS" class="tbl_checkstockdetail_PCS">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $tbl_checkstockdetail->PCS->caption() ?></span><span class="ew-table-header-sort"><?php if ($tbl_checkstockdetail->PCS->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($tbl_checkstockdetail->PCS->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($tbl_checkstockdetail->DateTimeCheck->Visible) { // DateTimeCheck ?>
	<?php if ($tbl_checkstockdetail->sortUrl($tbl_checkstockdetail->DateTimeCheck) == "") { ?>
		<th data-name="DateTimeCheck" class="<?php echo $tbl_checkstockdetail->DateTimeCheck->headerCellClass() ?>" style="white-space: nowrap;"><div id="elh_tbl_checkstockdetail_DateTimeCheck" class="tbl_checkstockdetail_DateTimeCheck"><div class="ew-table-header-caption"><?php echo $tbl_checkstockdetail->DateTimeCheck->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="DateTimeCheck" class="<?php echo $tbl_checkstockdetail->DateTimeCheck->headerCellClass() ?>" style="white-space: nowrap;"><div><div id="elh_tbl_checkstockdetail_DateTimeCheck" class="tbl_checkstockdetail_DateTimeCheck">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $tbl_checkstockdetail->DateTimeCheck->caption() ?></span><span class="ew-table-header-sort"><?php if ($tbl_checkstockdetail->DateTimeCheck->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($tbl_checkstockdetail->DateTimeCheck->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($tbl_checkstockdetail->UserCheck->Visible) { // UserCheck ?>
	<?php if ($tbl_checkstockdetail->sortUrl($tbl_checkstockdetail->UserCheck) == "") { ?>
		<th data-name="UserCheck" class="<?php echo $tbl_checkstockdetail->UserCheck->headerCellClass() ?>" style="white-space: nowrap;"><div id="elh_tbl_checkstockdetail_UserCheck" class="tbl_checkstockdetail_UserCheck"><div class="ew-table-header-caption"><?php echo $tbl_checkstockdetail->UserCheck->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="UserCheck" class="<?php echo $tbl_checkstockdetail->UserCheck->headerCellClass() ?>" style="white-space: nowrap;"><div><div id="elh_tbl_checkstockdetail_UserCheck" class="tbl_checkstockdetail_UserCheck">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $tbl_checkstockdetail->UserCheck->caption() ?></span><span class="ew-table-header-sort"><?php if ($tbl_checkstockdetail->UserCheck->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($tbl_checkstockdetail->UserCheck->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($tbl_checkstockdetail->Usercreate->Visible) { // Usercreate ?>
	<?php if ($tbl_checkstockdetail->sortUrl($tbl_checkstockdetail->Usercreate) == "") { ?>
		<th data-name="Usercreate" class="<?php echo $tbl_checkstockdetail->Usercreate->headerCellClass() ?>" style="white-space: nowrap;"><div id="elh_tbl_checkstockdetail_Usercreate" class="tbl_checkstockdetail_Usercreate"><div class="ew-table-header-caption"><?php echo $tbl_checkstockdetail->Usercreate->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Usercreate" class="<?php echo $tbl_checkstockdetail->Usercreate->headerCellClass() ?>" style="white-space: nowrap;"><div><div id="elh_tbl_checkstockdetail_Usercreate" class="tbl_checkstockdetail_Usercreate">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $tbl_checkstockdetail->Usercreate->caption() ?></span><span class="ew-table-header-sort"><?php if ($tbl_checkstockdetail->Usercreate->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($tbl_checkstockdetail->Usercreate->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($tbl_checkstockdetail->DatetimeCreate->Visible) { // DatetimeCreate ?>
	<?php if ($tbl_checkstockdetail->sortUrl($tbl_checkstockdetail->DatetimeCreate) == "") { ?>
		<th data-name="DatetimeCreate" class="<?php echo $tbl_checkstockdetail->DatetimeCreate->headerCellClass() ?>" style="white-space: nowrap;"><div id="elh_tbl_checkstockdetail_DatetimeCreate" class="tbl_checkstockdetail_DatetimeCreate"><div class="ew-table-header-caption"><?php echo $tbl_checkstockdetail->DatetimeCreate->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="DatetimeCreate" class="<?php echo $tbl_checkstockdetail->DatetimeCreate->headerCellClass() ?>" style="white-space: nowrap;"><div><div id="elh_tbl_checkstockdetail_DatetimeCreate" class="tbl_checkstockdetail_DatetimeCreate">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $tbl_checkstockdetail->DatetimeCreate->caption() ?></span><span class="ew-table-header-sort"><?php if ($tbl_checkstockdetail->DatetimeCreate->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($tbl_checkstockdetail->DatetimeCreate->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$tbl_checkstockdetail_grid->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
$tbl_checkstockdetail_grid->StartRec = 1;
$tbl_checkstockdetail_grid->StopRec = $tbl_checkstockdetail_grid->TotalRecs; // Show all records

// Restore number of post back records
if ($CurrentForm && $tbl_checkstockdetail_grid->EventCancelled) {
	$CurrentForm->Index = -1;
	if ($CurrentForm->hasValue($tbl_checkstockdetail_grid->FormKeyCountName) && ($tbl_checkstockdetail->isGridAdd() || $tbl_checkstockdetail->isGridEdit() || $tbl_checkstockdetail->isConfirm())) {
		$tbl_checkstockdetail_grid->KeyCount = $CurrentForm->getValue($tbl_checkstockdetail_grid->FormKeyCountName);
		$tbl_checkstockdetail_grid->StopRec = $tbl_checkstockdetail_grid->StartRec + $tbl_checkstockdetail_grid->KeyCount - 1;
	}
}
$tbl_checkstockdetail_grid->RecCnt = $tbl_checkstockdetail_grid->StartRec - 1;
if ($tbl_checkstockdetail_grid->Recordset && !$tbl_checkstockdetail_grid->Recordset->EOF) {
	$tbl_checkstockdetail_grid->Recordset->moveFirst();
	$selectLimit = $tbl_checkstockdetail_grid->UseSelectLimit;
	if (!$selectLimit && $tbl_checkstockdetail_grid->StartRec > 1)
		$tbl_checkstockdetail_grid->Recordset->move($tbl_checkstockdetail_grid->StartRec - 1);
} elseif (!$tbl_checkstockdetail->AllowAddDeleteRow && $tbl_checkstockdetail_grid->StopRec == 0) {
	$tbl_checkstockdetail_grid->StopRec = $tbl_checkstockdetail->GridAddRowCount;
}

// Initialize aggregate
$tbl_checkstockdetail->RowType = ROWTYPE_AGGREGATEINIT;
$tbl_checkstockdetail->resetAttributes();
$tbl_checkstockdetail_grid->renderRow();
if ($tbl_checkstockdetail->isGridAdd())
	$tbl_checkstockdetail_grid->RowIndex = 0;
if ($tbl_checkstockdetail->isGridEdit())
	$tbl_checkstockdetail_grid->RowIndex = 0;
while ($tbl_checkstockdetail_grid->RecCnt < $tbl_checkstockdetail_grid->StopRec) {
	$tbl_checkstockdetail_grid->RecCnt++;
	if ($tbl_checkstockdetail_grid->RecCnt >= $tbl_checkstockdetail_grid->StartRec) {
		$tbl_checkstockdetail_grid->RowCnt++;
		if ($tbl_checkstockdetail->isGridAdd() || $tbl_checkstockdetail->isGridEdit() || $tbl_checkstockdetail->isConfirm()) {
			$tbl_checkstockdetail_grid->RowIndex++;
			$CurrentForm->Index = $tbl_checkstockdetail_grid->RowIndex;
			if ($CurrentForm->hasValue($tbl_checkstockdetail_grid->FormActionName) && $tbl_checkstockdetail_grid->EventCancelled)
				$tbl_checkstockdetail_grid->RowAction = strval($CurrentForm->getValue($tbl_checkstockdetail_grid->FormActionName));
			elseif ($tbl_checkstockdetail->isGridAdd())
				$tbl_checkstockdetail_grid->RowAction = "insert";
			else
				$tbl_checkstockdetail_grid->RowAction = "";
		}

		// Set up key count
		$tbl_checkstockdetail_grid->KeyCount = $tbl_checkstockdetail_grid->RowIndex;

		// Init row class and style
		$tbl_checkstockdetail->resetAttributes();
		$tbl_checkstockdetail->CssClass = "";
		if ($tbl_checkstockdetail->isGridAdd()) {
			if ($tbl_checkstockdetail->CurrentMode == "copy") {
				$tbl_checkstockdetail_grid->loadRowValues($tbl_checkstockdetail_grid->Recordset); // Load row values
				$tbl_checkstockdetail_grid->setRecordKey($tbl_checkstockdetail_grid->RowOldKey, $tbl_checkstockdetail_grid->Recordset); // Set old record key
			} else {
				$tbl_checkstockdetail_grid->loadRowValues(); // Load default values
				$tbl_checkstockdetail_grid->RowOldKey = ""; // Clear old key value
			}
		} else {
			$tbl_checkstockdetail_grid->loadRowValues($tbl_checkstockdetail_grid->Recordset); // Load row values
		}
		$tbl_checkstockdetail->RowType = ROWTYPE_VIEW; // Render view
		if ($tbl_checkstockdetail->isGridAdd()) // Grid add
			$tbl_checkstockdetail->RowType = ROWTYPE_ADD; // Render add
		if ($tbl_checkstockdetail->isGridAdd() && $tbl_checkstockdetail->EventCancelled && !$CurrentForm->hasValue("k_blankrow")) // Insert failed
			$tbl_checkstockdetail_grid->restoreCurrentRowFormValues($tbl_checkstockdetail_grid->RowIndex); // Restore form values
		if ($tbl_checkstockdetail->isGridEdit()) { // Grid edit
			if ($tbl_checkstockdetail->EventCancelled)
				$tbl_checkstockdetail_grid->restoreCurrentRowFormValues($tbl_checkstockdetail_grid->RowIndex); // Restore form values
			if ($tbl_checkstockdetail_grid->RowAction == "insert")
				$tbl_checkstockdetail->RowType = ROWTYPE_ADD; // Render add
			else
				$tbl_checkstockdetail->RowType = ROWTYPE_EDIT; // Render edit
		}
		if ($tbl_checkstockdetail->isGridEdit() && ($tbl_checkstockdetail->RowType == ROWTYPE_EDIT || $tbl_checkstockdetail->RowType == ROWTYPE_ADD) && $tbl_checkstockdetail->EventCancelled) // Update failed
			$tbl_checkstockdetail_grid->restoreCurrentRowFormValues($tbl_checkstockdetail_grid->RowIndex); // Restore form values
		if ($tbl_checkstockdetail->RowType == ROWTYPE_EDIT) // Edit row
			$tbl_checkstockdetail_grid->EditRowCnt++;
		if ($tbl_checkstockdetail->isConfirm()) // Confirm row
			$tbl_checkstockdetail_grid->restoreCurrentRowFormValues($tbl_checkstockdetail_grid->RowIndex); // Restore form values

		// Set up row id / data-rowindex
		$tbl_checkstockdetail->RowAttrs = array_merge($tbl_checkstockdetail->RowAttrs, array('data-rowindex'=>$tbl_checkstockdetail_grid->RowCnt, 'id'=>'r' . $tbl_checkstockdetail_grid->RowCnt . '_tbl_checkstockdetail', 'data-rowtype'=>$tbl_checkstockdetail->RowType));

		// Render row
		$tbl_checkstockdetail_grid->renderRow();

		// Render list options
		$tbl_checkstockdetail_grid->renderListOptions();

		// Skip delete row / empty row for confirm page
		if ($tbl_checkstockdetail_grid->RowAction <> "delete" && $tbl_checkstockdetail_grid->RowAction <> "insertdelete" && !($tbl_checkstockdetail_grid->RowAction == "insert" && $tbl_checkstockdetail->isConfirm() && $tbl_checkstockdetail_grid->emptyRow())) {
?>
	<tr<?php echo $tbl_checkstockdetail->rowAttributes() ?>>
<?php

// Render list options (body, left)
$tbl_checkstockdetail_grid->ListOptions->render("body", "left", $tbl_checkstockdetail_grid->RowCnt);
?>
	<?php if ($tbl_checkstockdetail->Location->Visible) { // Location ?>
		<td data-name="Location"<?php echo $tbl_checkstockdetail->Location->cellAttributes() ?>>
<?php if ($tbl_checkstockdetail->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $tbl_checkstockdetail_grid->RowCnt ?>_tbl_checkstockdetail_Location" class="form-group tbl_checkstockdetail_Location">
<input type="text" data-table="tbl_checkstockdetail" data-field="x_Location" name="x<?php echo $tbl_checkstockdetail_grid->RowIndex ?>_Location" id="x<?php echo $tbl_checkstockdetail_grid->RowIndex ?>_Location" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($tbl_checkstockdetail->Location->getPlaceHolder()) ?>" value="<?php echo $tbl_checkstockdetail->Location->EditValue ?>"<?php echo $tbl_checkstockdetail->Location->editAttributes() ?>>
</span>
<input type="hidden" data-table="tbl_checkstockdetail" data-field="x_Location" name="o<?php echo $tbl_checkstockdetail_grid->RowIndex ?>_Location" id="o<?php echo $tbl_checkstockdetail_grid->RowIndex ?>_Location" value="<?php echo HtmlEncode($tbl_checkstockdetail->Location->OldValue) ?>">
<?php } ?>
<?php if ($tbl_checkstockdetail->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $tbl_checkstockdetail_grid->RowCnt ?>_tbl_checkstockdetail_Location" class="form-group tbl_checkstockdetail_Location">
<input type="text" data-table="tbl_checkstockdetail" data-field="x_Location" name="x<?php echo $tbl_checkstockdetail_grid->RowIndex ?>_Location" id="x<?php echo $tbl_checkstockdetail_grid->RowIndex ?>_Location" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($tbl_checkstockdetail->Location->getPlaceHolder()) ?>" value="<?php echo $tbl_checkstockdetail->Location->EditValue ?>"<?php echo $tbl_checkstockdetail->Location->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($tbl_checkstockdetail->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $tbl_checkstockdetail_grid->RowCnt ?>_tbl_checkstockdetail_Location" class="tbl_checkstockdetail_Location">
<span<?php echo $tbl_checkstockdetail->Location->viewAttributes() ?>>
<?php echo $tbl_checkstockdetail->Location->getViewValue() ?></span>
</span>
<?php if (!$tbl_checkstockdetail->isConfirm()) { ?>
<input type="hidden" data-table="tbl_checkstockdetail" data-field="x_Location" name="x<?php echo $tbl_checkstockdetail_grid->RowIndex ?>_Location" id="x<?php echo $tbl_checkstockdetail_grid->RowIndex ?>_Location" value="<?php echo HtmlEncode($tbl_checkstockdetail->Location->FormValue) ?>">
<input type="hidden" data-table="tbl_checkstockdetail" data-field="x_Location" name="o<?php echo $tbl_checkstockdetail_grid->RowIndex ?>_Location" id="o<?php echo $tbl_checkstockdetail_grid->RowIndex ?>_Location" value="<?php echo HtmlEncode($tbl_checkstockdetail->Location->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="tbl_checkstockdetail" data-field="x_Location" name="ftbl_checkstockdetailgrid$x<?php echo $tbl_checkstockdetail_grid->RowIndex ?>_Location" id="ftbl_checkstockdetailgrid$x<?php echo $tbl_checkstockdetail_grid->RowIndex ?>_Location" value="<?php echo HtmlEncode($tbl_checkstockdetail->Location->FormValue) ?>">
<input type="hidden" data-table="tbl_checkstockdetail" data-field="x_Location" name="ftbl_checkstockdetailgrid$o<?php echo $tbl_checkstockdetail_grid->RowIndex ?>_Location" id="ftbl_checkstockdetailgrid$o<?php echo $tbl_checkstockdetail_grid->RowIndex ?>_Location" value="<?php echo HtmlEncode($tbl_checkstockdetail->Location->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
<?php if ($tbl_checkstockdetail->RowType == ROWTYPE_ADD) { // Add record ?>
<input type="hidden" data-table="tbl_checkstockdetail" data-field="x_ID" name="x<?php echo $tbl_checkstockdetail_grid->RowIndex ?>_ID" id="x<?php echo $tbl_checkstockdetail_grid->RowIndex ?>_ID" value="<?php echo HtmlEncode($tbl_checkstockdetail->ID->CurrentValue) ?>">
<input type="hidden" data-table="tbl_checkstockdetail" data-field="x_ID" name="o<?php echo $tbl_checkstockdetail_grid->RowIndex ?>_ID" id="o<?php echo $tbl_checkstockdetail_grid->RowIndex ?>_ID" value="<?php echo HtmlEncode($tbl_checkstockdetail->ID->OldValue) ?>">
<?php } ?>
<?php if ($tbl_checkstockdetail->RowType == ROWTYPE_EDIT || $tbl_checkstockdetail->CurrentMode == "edit") { ?>
<input type="hidden" data-table="tbl_checkstockdetail" data-field="x_ID" name="x<?php echo $tbl_checkstockdetail_grid->RowIndex ?>_ID" id="x<?php echo $tbl_checkstockdetail_grid->RowIndex ?>_ID" value="<?php echo HtmlEncode($tbl_checkstockdetail->ID->CurrentValue) ?>">
<?php } ?>
	<?php if ($tbl_checkstockdetail->PalletID->Visible) { // PalletID ?>
		<td data-name="PalletID"<?php echo $tbl_checkstockdetail->PalletID->cellAttributes() ?>>
<?php if ($tbl_checkstockdetail->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $tbl_checkstockdetail_grid->RowCnt ?>_tbl_checkstockdetail_PalletID" class="form-group tbl_checkstockdetail_PalletID">
<input type="text" data-table="tbl_checkstockdetail" data-field="x_PalletID" name="x<?php echo $tbl_checkstockdetail_grid->RowIndex ?>_PalletID" id="x<?php echo $tbl_checkstockdetail_grid->RowIndex ?>_PalletID" size="30" maxlength="50" placeholder="<?php echo HtmlEncode($tbl_checkstockdetail->PalletID->getPlaceHolder()) ?>" value="<?php echo $tbl_checkstockdetail->PalletID->EditValue ?>"<?php echo $tbl_checkstockdetail->PalletID->editAttributes() ?>>
</span>
<input type="hidden" data-table="tbl_checkstockdetail" data-field="x_PalletID" name="o<?php echo $tbl_checkstockdetail_grid->RowIndex ?>_PalletID" id="o<?php echo $tbl_checkstockdetail_grid->RowIndex ?>_PalletID" value="<?php echo HtmlEncode($tbl_checkstockdetail->PalletID->OldValue) ?>">
<?php } ?>
<?php if ($tbl_checkstockdetail->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $tbl_checkstockdetail_grid->RowCnt ?>_tbl_checkstockdetail_PalletID" class="form-group tbl_checkstockdetail_PalletID">
<input type="text" data-table="tbl_checkstockdetail" data-field="x_PalletID" name="x<?php echo $tbl_checkstockdetail_grid->RowIndex ?>_PalletID" id="x<?php echo $tbl_checkstockdetail_grid->RowIndex ?>_PalletID" size="30" maxlength="50" placeholder="<?php echo HtmlEncode($tbl_checkstockdetail->PalletID->getPlaceHolder()) ?>" value="<?php echo $tbl_checkstockdetail->PalletID->EditValue ?>"<?php echo $tbl_checkstockdetail->PalletID->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($tbl_checkstockdetail->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $tbl_checkstockdetail_grid->RowCnt ?>_tbl_checkstockdetail_PalletID" class="tbl_checkstockdetail_PalletID">
<span<?php echo $tbl_checkstockdetail->PalletID->viewAttributes() ?>>
<?php echo $tbl_checkstockdetail->PalletID->getViewValue() ?></span>
</span>
<?php if (!$tbl_checkstockdetail->isConfirm()) { ?>
<input type="hidden" data-table="tbl_checkstockdetail" data-field="x_PalletID" name="x<?php echo $tbl_checkstockdetail_grid->RowIndex ?>_PalletID" id="x<?php echo $tbl_checkstockdetail_grid->RowIndex ?>_PalletID" value="<?php echo HtmlEncode($tbl_checkstockdetail->PalletID->FormValue) ?>">
<input type="hidden" data-table="tbl_checkstockdetail" data-field="x_PalletID" name="o<?php echo $tbl_checkstockdetail_grid->RowIndex ?>_PalletID" id="o<?php echo $tbl_checkstockdetail_grid->RowIndex ?>_PalletID" value="<?php echo HtmlEncode($tbl_checkstockdetail->PalletID->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="tbl_checkstockdetail" data-field="x_PalletID" name="ftbl_checkstockdetailgrid$x<?php echo $tbl_checkstockdetail_grid->RowIndex ?>_PalletID" id="ftbl_checkstockdetailgrid$x<?php echo $tbl_checkstockdetail_grid->RowIndex ?>_PalletID" value="<?php echo HtmlEncode($tbl_checkstockdetail->PalletID->FormValue) ?>">
<input type="hidden" data-table="tbl_checkstockdetail" data-field="x_PalletID" name="ftbl_checkstockdetailgrid$o<?php echo $tbl_checkstockdetail_grid->RowIndex ?>_PalletID" id="ftbl_checkstockdetailgrid$o<?php echo $tbl_checkstockdetail_grid->RowIndex ?>_PalletID" value="<?php echo HtmlEncode($tbl_checkstockdetail->PalletID->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($tbl_checkstockdetail->Code->Visible) { // Code ?>
		<td data-name="Code"<?php echo $tbl_checkstockdetail->Code->cellAttributes() ?>>
<?php if ($tbl_checkstockdetail->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $tbl_checkstockdetail_grid->RowCnt ?>_tbl_checkstockdetail_Code" class="form-group tbl_checkstockdetail_Code">
<input type="text" data-table="tbl_checkstockdetail" data-field="x_Code" name="x<?php echo $tbl_checkstockdetail_grid->RowIndex ?>_Code" id="x<?php echo $tbl_checkstockdetail_grid->RowIndex ?>_Code" size="30" maxlength="50" placeholder="<?php echo HtmlEncode($tbl_checkstockdetail->Code->getPlaceHolder()) ?>" value="<?php echo $tbl_checkstockdetail->Code->EditValue ?>"<?php echo $tbl_checkstockdetail->Code->editAttributes() ?>>
</span>
<input type="hidden" data-table="tbl_checkstockdetail" data-field="x_Code" name="o<?php echo $tbl_checkstockdetail_grid->RowIndex ?>_Code" id="o<?php echo $tbl_checkstockdetail_grid->RowIndex ?>_Code" value="<?php echo HtmlEncode($tbl_checkstockdetail->Code->OldValue) ?>">
<?php } ?>
<?php if ($tbl_checkstockdetail->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $tbl_checkstockdetail_grid->RowCnt ?>_tbl_checkstockdetail_Code" class="form-group tbl_checkstockdetail_Code">
<input type="text" data-table="tbl_checkstockdetail" data-field="x_Code" name="x<?php echo $tbl_checkstockdetail_grid->RowIndex ?>_Code" id="x<?php echo $tbl_checkstockdetail_grid->RowIndex ?>_Code" size="30" maxlength="50" placeholder="<?php echo HtmlEncode($tbl_checkstockdetail->Code->getPlaceHolder()) ?>" value="<?php echo $tbl_checkstockdetail->Code->EditValue ?>"<?php echo $tbl_checkstockdetail->Code->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($tbl_checkstockdetail->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $tbl_checkstockdetail_grid->RowCnt ?>_tbl_checkstockdetail_Code" class="tbl_checkstockdetail_Code">
<span<?php echo $tbl_checkstockdetail->Code->viewAttributes() ?>>
<?php echo $tbl_checkstockdetail->Code->getViewValue() ?></span>
</span>
<?php if (!$tbl_checkstockdetail->isConfirm()) { ?>
<input type="hidden" data-table="tbl_checkstockdetail" data-field="x_Code" name="x<?php echo $tbl_checkstockdetail_grid->RowIndex ?>_Code" id="x<?php echo $tbl_checkstockdetail_grid->RowIndex ?>_Code" value="<?php echo HtmlEncode($tbl_checkstockdetail->Code->FormValue) ?>">
<input type="hidden" data-table="tbl_checkstockdetail" data-field="x_Code" name="o<?php echo $tbl_checkstockdetail_grid->RowIndex ?>_Code" id="o<?php echo $tbl_checkstockdetail_grid->RowIndex ?>_Code" value="<?php echo HtmlEncode($tbl_checkstockdetail->Code->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="tbl_checkstockdetail" data-field="x_Code" name="ftbl_checkstockdetailgrid$x<?php echo $tbl_checkstockdetail_grid->RowIndex ?>_Code" id="ftbl_checkstockdetailgrid$x<?php echo $tbl_checkstockdetail_grid->RowIndex ?>_Code" value="<?php echo HtmlEncode($tbl_checkstockdetail->Code->FormValue) ?>">
<input type="hidden" data-table="tbl_checkstockdetail" data-field="x_Code" name="ftbl_checkstockdetailgrid$o<?php echo $tbl_checkstockdetail_grid->RowIndex ?>_Code" id="ftbl_checkstockdetailgrid$o<?php echo $tbl_checkstockdetail_grid->RowIndex ?>_Code" value="<?php echo HtmlEncode($tbl_checkstockdetail->Code->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($tbl_checkstockdetail->PCS->Visible) { // PCS ?>
		<td data-name="PCS"<?php echo $tbl_checkstockdetail->PCS->cellAttributes() ?>>
<?php if ($tbl_checkstockdetail->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $tbl_checkstockdetail_grid->RowCnt ?>_tbl_checkstockdetail_PCS" class="form-group tbl_checkstockdetail_PCS">
<input type="text" data-table="tbl_checkstockdetail" data-field="x_PCS" name="x<?php echo $tbl_checkstockdetail_grid->RowIndex ?>_PCS" id="x<?php echo $tbl_checkstockdetail_grid->RowIndex ?>_PCS" size="30" placeholder="<?php echo HtmlEncode($tbl_checkstockdetail->PCS->getPlaceHolder()) ?>" value="<?php echo $tbl_checkstockdetail->PCS->EditValue ?>"<?php echo $tbl_checkstockdetail->PCS->editAttributes() ?>>
</span>
<input type="hidden" data-table="tbl_checkstockdetail" data-field="x_PCS" name="o<?php echo $tbl_checkstockdetail_grid->RowIndex ?>_PCS" id="o<?php echo $tbl_checkstockdetail_grid->RowIndex ?>_PCS" value="<?php echo HtmlEncode($tbl_checkstockdetail->PCS->OldValue) ?>">
<?php } ?>
<?php if ($tbl_checkstockdetail->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $tbl_checkstockdetail_grid->RowCnt ?>_tbl_checkstockdetail_PCS" class="form-group tbl_checkstockdetail_PCS">
<input type="text" data-table="tbl_checkstockdetail" data-field="x_PCS" name="x<?php echo $tbl_checkstockdetail_grid->RowIndex ?>_PCS" id="x<?php echo $tbl_checkstockdetail_grid->RowIndex ?>_PCS" size="30" placeholder="<?php echo HtmlEncode($tbl_checkstockdetail->PCS->getPlaceHolder()) ?>" value="<?php echo $tbl_checkstockdetail->PCS->EditValue ?>"<?php echo $tbl_checkstockdetail->PCS->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($tbl_checkstockdetail->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $tbl_checkstockdetail_grid->RowCnt ?>_tbl_checkstockdetail_PCS" class="tbl_checkstockdetail_PCS">
<span<?php echo $tbl_checkstockdetail->PCS->viewAttributes() ?>>
<?php echo $tbl_checkstockdetail->PCS->getViewValue() ?></span>
</span>
<?php if (!$tbl_checkstockdetail->isConfirm()) { ?>
<input type="hidden" data-table="tbl_checkstockdetail" data-field="x_PCS" name="x<?php echo $tbl_checkstockdetail_grid->RowIndex ?>_PCS" id="x<?php echo $tbl_checkstockdetail_grid->RowIndex ?>_PCS" value="<?php echo HtmlEncode($tbl_checkstockdetail->PCS->FormValue) ?>">
<input type="hidden" data-table="tbl_checkstockdetail" data-field="x_PCS" name="o<?php echo $tbl_checkstockdetail_grid->RowIndex ?>_PCS" id="o<?php echo $tbl_checkstockdetail_grid->RowIndex ?>_PCS" value="<?php echo HtmlEncode($tbl_checkstockdetail->PCS->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="tbl_checkstockdetail" data-field="x_PCS" name="ftbl_checkstockdetailgrid$x<?php echo $tbl_checkstockdetail_grid->RowIndex ?>_PCS" id="ftbl_checkstockdetailgrid$x<?php echo $tbl_checkstockdetail_grid->RowIndex ?>_PCS" value="<?php echo HtmlEncode($tbl_checkstockdetail->PCS->FormValue) ?>">
<input type="hidden" data-table="tbl_checkstockdetail" data-field="x_PCS" name="ftbl_checkstockdetailgrid$o<?php echo $tbl_checkstockdetail_grid->RowIndex ?>_PCS" id="ftbl_checkstockdetailgrid$o<?php echo $tbl_checkstockdetail_grid->RowIndex ?>_PCS" value="<?php echo HtmlEncode($tbl_checkstockdetail->PCS->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($tbl_checkstockdetail->DateTimeCheck->Visible) { // DateTimeCheck ?>
		<td data-name="DateTimeCheck"<?php echo $tbl_checkstockdetail->DateTimeCheck->cellAttributes() ?>>
<?php if ($tbl_checkstockdetail->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $tbl_checkstockdetail_grid->RowCnt ?>_tbl_checkstockdetail_DateTimeCheck" class="form-group tbl_checkstockdetail_DateTimeCheck">
<input type="text" data-table="tbl_checkstockdetail" data-field="x_DateTimeCheck" name="x<?php echo $tbl_checkstockdetail_grid->RowIndex ?>_DateTimeCheck" id="x<?php echo $tbl_checkstockdetail_grid->RowIndex ?>_DateTimeCheck" placeholder="<?php echo HtmlEncode($tbl_checkstockdetail->DateTimeCheck->getPlaceHolder()) ?>" value="<?php echo $tbl_checkstockdetail->DateTimeCheck->EditValue ?>"<?php echo $tbl_checkstockdetail->DateTimeCheck->editAttributes() ?>>
<?php if (!$tbl_checkstockdetail->DateTimeCheck->ReadOnly && !$tbl_checkstockdetail->DateTimeCheck->Disabled && !isset($tbl_checkstockdetail->DateTimeCheck->EditAttrs["readonly"]) && !isset($tbl_checkstockdetail->DateTimeCheck->EditAttrs["disabled"])) { ?>
<script>
ew.createDateTimePicker("ftbl_checkstockdetailgrid", "x<?php echo $tbl_checkstockdetail_grid->RowIndex ?>_DateTimeCheck", {"ignoreReadonly":true,"useCurrent":false,"format":0});
</script>
<?php } ?>
</span>
<input type="hidden" data-table="tbl_checkstockdetail" data-field="x_DateTimeCheck" name="o<?php echo $tbl_checkstockdetail_grid->RowIndex ?>_DateTimeCheck" id="o<?php echo $tbl_checkstockdetail_grid->RowIndex ?>_DateTimeCheck" value="<?php echo HtmlEncode($tbl_checkstockdetail->DateTimeCheck->OldValue) ?>">
<?php } ?>
<?php if ($tbl_checkstockdetail->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $tbl_checkstockdetail_grid->RowCnt ?>_tbl_checkstockdetail_DateTimeCheck" class="form-group tbl_checkstockdetail_DateTimeCheck">
<input type="text" data-table="tbl_checkstockdetail" data-field="x_DateTimeCheck" name="x<?php echo $tbl_checkstockdetail_grid->RowIndex ?>_DateTimeCheck" id="x<?php echo $tbl_checkstockdetail_grid->RowIndex ?>_DateTimeCheck" placeholder="<?php echo HtmlEncode($tbl_checkstockdetail->DateTimeCheck->getPlaceHolder()) ?>" value="<?php echo $tbl_checkstockdetail->DateTimeCheck->EditValue ?>"<?php echo $tbl_checkstockdetail->DateTimeCheck->editAttributes() ?>>
<?php if (!$tbl_checkstockdetail->DateTimeCheck->ReadOnly && !$tbl_checkstockdetail->DateTimeCheck->Disabled && !isset($tbl_checkstockdetail->DateTimeCheck->EditAttrs["readonly"]) && !isset($tbl_checkstockdetail->DateTimeCheck->EditAttrs["disabled"])) { ?>
<script>
ew.createDateTimePicker("ftbl_checkstockdetailgrid", "x<?php echo $tbl_checkstockdetail_grid->RowIndex ?>_DateTimeCheck", {"ignoreReadonly":true,"useCurrent":false,"format":0});
</script>
<?php } ?>
</span>
<?php } ?>
<?php if ($tbl_checkstockdetail->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $tbl_checkstockdetail_grid->RowCnt ?>_tbl_checkstockdetail_DateTimeCheck" class="tbl_checkstockdetail_DateTimeCheck">
<span<?php echo $tbl_checkstockdetail->DateTimeCheck->viewAttributes() ?>>
<?php echo $tbl_checkstockdetail->DateTimeCheck->getViewValue() ?></span>
</span>
<?php if (!$tbl_checkstockdetail->isConfirm()) { ?>
<input type="hidden" data-table="tbl_checkstockdetail" data-field="x_DateTimeCheck" name="x<?php echo $tbl_checkstockdetail_grid->RowIndex ?>_DateTimeCheck" id="x<?php echo $tbl_checkstockdetail_grid->RowIndex ?>_DateTimeCheck" value="<?php echo HtmlEncode($tbl_checkstockdetail->DateTimeCheck->FormValue) ?>">
<input type="hidden" data-table="tbl_checkstockdetail" data-field="x_DateTimeCheck" name="o<?php echo $tbl_checkstockdetail_grid->RowIndex ?>_DateTimeCheck" id="o<?php echo $tbl_checkstockdetail_grid->RowIndex ?>_DateTimeCheck" value="<?php echo HtmlEncode($tbl_checkstockdetail->DateTimeCheck->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="tbl_checkstockdetail" data-field="x_DateTimeCheck" name="ftbl_checkstockdetailgrid$x<?php echo $tbl_checkstockdetail_grid->RowIndex ?>_DateTimeCheck" id="ftbl_checkstockdetailgrid$x<?php echo $tbl_checkstockdetail_grid->RowIndex ?>_DateTimeCheck" value="<?php echo HtmlEncode($tbl_checkstockdetail->DateTimeCheck->FormValue) ?>">
<input type="hidden" data-table="tbl_checkstockdetail" data-field="x_DateTimeCheck" name="ftbl_checkstockdetailgrid$o<?php echo $tbl_checkstockdetail_grid->RowIndex ?>_DateTimeCheck" id="ftbl_checkstockdetailgrid$o<?php echo $tbl_checkstockdetail_grid->RowIndex ?>_DateTimeCheck" value="<?php echo HtmlEncode($tbl_checkstockdetail->DateTimeCheck->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($tbl_checkstockdetail->UserCheck->Visible) { // UserCheck ?>
		<td data-name="UserCheck"<?php echo $tbl_checkstockdetail->UserCheck->cellAttributes() ?>>
<?php if ($tbl_checkstockdetail->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $tbl_checkstockdetail_grid->RowCnt ?>_tbl_checkstockdetail_UserCheck" class="form-group tbl_checkstockdetail_UserCheck">
<input type="text" data-table="tbl_checkstockdetail" data-field="x_UserCheck" name="x<?php echo $tbl_checkstockdetail_grid->RowIndex ?>_UserCheck" id="x<?php echo $tbl_checkstockdetail_grid->RowIndex ?>_UserCheck" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($tbl_checkstockdetail->UserCheck->getPlaceHolder()) ?>" value="<?php echo $tbl_checkstockdetail->UserCheck->EditValue ?>"<?php echo $tbl_checkstockdetail->UserCheck->editAttributes() ?>>
</span>
<input type="hidden" data-table="tbl_checkstockdetail" data-field="x_UserCheck" name="o<?php echo $tbl_checkstockdetail_grid->RowIndex ?>_UserCheck" id="o<?php echo $tbl_checkstockdetail_grid->RowIndex ?>_UserCheck" value="<?php echo HtmlEncode($tbl_checkstockdetail->UserCheck->OldValue) ?>">
<?php } ?>
<?php if ($tbl_checkstockdetail->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $tbl_checkstockdetail_grid->RowCnt ?>_tbl_checkstockdetail_UserCheck" class="form-group tbl_checkstockdetail_UserCheck">
<input type="text" data-table="tbl_checkstockdetail" data-field="x_UserCheck" name="x<?php echo $tbl_checkstockdetail_grid->RowIndex ?>_UserCheck" id="x<?php echo $tbl_checkstockdetail_grid->RowIndex ?>_UserCheck" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($tbl_checkstockdetail->UserCheck->getPlaceHolder()) ?>" value="<?php echo $tbl_checkstockdetail->UserCheck->EditValue ?>"<?php echo $tbl_checkstockdetail->UserCheck->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($tbl_checkstockdetail->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $tbl_checkstockdetail_grid->RowCnt ?>_tbl_checkstockdetail_UserCheck" class="tbl_checkstockdetail_UserCheck">
<span<?php echo $tbl_checkstockdetail->UserCheck->viewAttributes() ?>>
<?php echo $tbl_checkstockdetail->UserCheck->getViewValue() ?></span>
</span>
<?php if (!$tbl_checkstockdetail->isConfirm()) { ?>
<input type="hidden" data-table="tbl_checkstockdetail" data-field="x_UserCheck" name="x<?php echo $tbl_checkstockdetail_grid->RowIndex ?>_UserCheck" id="x<?php echo $tbl_checkstockdetail_grid->RowIndex ?>_UserCheck" value="<?php echo HtmlEncode($tbl_checkstockdetail->UserCheck->FormValue) ?>">
<input type="hidden" data-table="tbl_checkstockdetail" data-field="x_UserCheck" name="o<?php echo $tbl_checkstockdetail_grid->RowIndex ?>_UserCheck" id="o<?php echo $tbl_checkstockdetail_grid->RowIndex ?>_UserCheck" value="<?php echo HtmlEncode($tbl_checkstockdetail->UserCheck->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="tbl_checkstockdetail" data-field="x_UserCheck" name="ftbl_checkstockdetailgrid$x<?php echo $tbl_checkstockdetail_grid->RowIndex ?>_UserCheck" id="ftbl_checkstockdetailgrid$x<?php echo $tbl_checkstockdetail_grid->RowIndex ?>_UserCheck" value="<?php echo HtmlEncode($tbl_checkstockdetail->UserCheck->FormValue) ?>">
<input type="hidden" data-table="tbl_checkstockdetail" data-field="x_UserCheck" name="ftbl_checkstockdetailgrid$o<?php echo $tbl_checkstockdetail_grid->RowIndex ?>_UserCheck" id="ftbl_checkstockdetailgrid$o<?php echo $tbl_checkstockdetail_grid->RowIndex ?>_UserCheck" value="<?php echo HtmlEncode($tbl_checkstockdetail->UserCheck->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($tbl_checkstockdetail->Usercreate->Visible) { // Usercreate ?>
		<td data-name="Usercreate"<?php echo $tbl_checkstockdetail->Usercreate->cellAttributes() ?>>
<?php if ($tbl_checkstockdetail->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $tbl_checkstockdetail_grid->RowCnt ?>_tbl_checkstockdetail_Usercreate" class="form-group tbl_checkstockdetail_Usercreate">
<input type="text" data-table="tbl_checkstockdetail" data-field="x_Usercreate" name="x<?php echo $tbl_checkstockdetail_grid->RowIndex ?>_Usercreate" id="x<?php echo $tbl_checkstockdetail_grid->RowIndex ?>_Usercreate" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($tbl_checkstockdetail->Usercreate->getPlaceHolder()) ?>" value="<?php echo $tbl_checkstockdetail->Usercreate->EditValue ?>"<?php echo $tbl_checkstockdetail->Usercreate->editAttributes() ?>>
</span>
<input type="hidden" data-table="tbl_checkstockdetail" data-field="x_Usercreate" name="o<?php echo $tbl_checkstockdetail_grid->RowIndex ?>_Usercreate" id="o<?php echo $tbl_checkstockdetail_grid->RowIndex ?>_Usercreate" value="<?php echo HtmlEncode($tbl_checkstockdetail->Usercreate->OldValue) ?>">
<?php } ?>
<?php if ($tbl_checkstockdetail->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $tbl_checkstockdetail_grid->RowCnt ?>_tbl_checkstockdetail_Usercreate" class="form-group tbl_checkstockdetail_Usercreate">
<input type="text" data-table="tbl_checkstockdetail" data-field="x_Usercreate" name="x<?php echo $tbl_checkstockdetail_grid->RowIndex ?>_Usercreate" id="x<?php echo $tbl_checkstockdetail_grid->RowIndex ?>_Usercreate" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($tbl_checkstockdetail->Usercreate->getPlaceHolder()) ?>" value="<?php echo $tbl_checkstockdetail->Usercreate->EditValue ?>"<?php echo $tbl_checkstockdetail->Usercreate->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($tbl_checkstockdetail->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $tbl_checkstockdetail_grid->RowCnt ?>_tbl_checkstockdetail_Usercreate" class="tbl_checkstockdetail_Usercreate">
<span<?php echo $tbl_checkstockdetail->Usercreate->viewAttributes() ?>>
<?php echo $tbl_checkstockdetail->Usercreate->getViewValue() ?></span>
</span>
<?php if (!$tbl_checkstockdetail->isConfirm()) { ?>
<input type="hidden" data-table="tbl_checkstockdetail" data-field="x_Usercreate" name="x<?php echo $tbl_checkstockdetail_grid->RowIndex ?>_Usercreate" id="x<?php echo $tbl_checkstockdetail_grid->RowIndex ?>_Usercreate" value="<?php echo HtmlEncode($tbl_checkstockdetail->Usercreate->FormValue) ?>">
<input type="hidden" data-table="tbl_checkstockdetail" data-field="x_Usercreate" name="o<?php echo $tbl_checkstockdetail_grid->RowIndex ?>_Usercreate" id="o<?php echo $tbl_checkstockdetail_grid->RowIndex ?>_Usercreate" value="<?php echo HtmlEncode($tbl_checkstockdetail->Usercreate->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="tbl_checkstockdetail" data-field="x_Usercreate" name="ftbl_checkstockdetailgrid$x<?php echo $tbl_checkstockdetail_grid->RowIndex ?>_Usercreate" id="ftbl_checkstockdetailgrid$x<?php echo $tbl_checkstockdetail_grid->RowIndex ?>_Usercreate" value="<?php echo HtmlEncode($tbl_checkstockdetail->Usercreate->FormValue) ?>">
<input type="hidden" data-table="tbl_checkstockdetail" data-field="x_Usercreate" name="ftbl_checkstockdetailgrid$o<?php echo $tbl_checkstockdetail_grid->RowIndex ?>_Usercreate" id="ftbl_checkstockdetailgrid$o<?php echo $tbl_checkstockdetail_grid->RowIndex ?>_Usercreate" value="<?php echo HtmlEncode($tbl_checkstockdetail->Usercreate->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($tbl_checkstockdetail->DatetimeCreate->Visible) { // DatetimeCreate ?>
		<td data-name="DatetimeCreate"<?php echo $tbl_checkstockdetail->DatetimeCreate->cellAttributes() ?>>
<?php if ($tbl_checkstockdetail->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $tbl_checkstockdetail_grid->RowCnt ?>_tbl_checkstockdetail_DatetimeCreate" class="form-group tbl_checkstockdetail_DatetimeCreate">
<input type="text" data-table="tbl_checkstockdetail" data-field="x_DatetimeCreate" name="x<?php echo $tbl_checkstockdetail_grid->RowIndex ?>_DatetimeCreate" id="x<?php echo $tbl_checkstockdetail_grid->RowIndex ?>_DatetimeCreate" placeholder="<?php echo HtmlEncode($tbl_checkstockdetail->DatetimeCreate->getPlaceHolder()) ?>" value="<?php echo $tbl_checkstockdetail->DatetimeCreate->EditValue ?>"<?php echo $tbl_checkstockdetail->DatetimeCreate->editAttributes() ?>>
<?php if (!$tbl_checkstockdetail->DatetimeCreate->ReadOnly && !$tbl_checkstockdetail->DatetimeCreate->Disabled && !isset($tbl_checkstockdetail->DatetimeCreate->EditAttrs["readonly"]) && !isset($tbl_checkstockdetail->DatetimeCreate->EditAttrs["disabled"])) { ?>
<script>
ew.createDateTimePicker("ftbl_checkstockdetailgrid", "x<?php echo $tbl_checkstockdetail_grid->RowIndex ?>_DatetimeCreate", {"ignoreReadonly":true,"useCurrent":false,"format":0});
</script>
<?php } ?>
</span>
<input type="hidden" data-table="tbl_checkstockdetail" data-field="x_DatetimeCreate" name="o<?php echo $tbl_checkstockdetail_grid->RowIndex ?>_DatetimeCreate" id="o<?php echo $tbl_checkstockdetail_grid->RowIndex ?>_DatetimeCreate" value="<?php echo HtmlEncode($tbl_checkstockdetail->DatetimeCreate->OldValue) ?>">
<?php } ?>
<?php if ($tbl_checkstockdetail->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $tbl_checkstockdetail_grid->RowCnt ?>_tbl_checkstockdetail_DatetimeCreate" class="form-group tbl_checkstockdetail_DatetimeCreate">
<input type="text" data-table="tbl_checkstockdetail" data-field="x_DatetimeCreate" name="x<?php echo $tbl_checkstockdetail_grid->RowIndex ?>_DatetimeCreate" id="x<?php echo $tbl_checkstockdetail_grid->RowIndex ?>_DatetimeCreate" placeholder="<?php echo HtmlEncode($tbl_checkstockdetail->DatetimeCreate->getPlaceHolder()) ?>" value="<?php echo $tbl_checkstockdetail->DatetimeCreate->EditValue ?>"<?php echo $tbl_checkstockdetail->DatetimeCreate->editAttributes() ?>>
<?php if (!$tbl_checkstockdetail->DatetimeCreate->ReadOnly && !$tbl_checkstockdetail->DatetimeCreate->Disabled && !isset($tbl_checkstockdetail->DatetimeCreate->EditAttrs["readonly"]) && !isset($tbl_checkstockdetail->DatetimeCreate->EditAttrs["disabled"])) { ?>
<script>
ew.createDateTimePicker("ftbl_checkstockdetailgrid", "x<?php echo $tbl_checkstockdetail_grid->RowIndex ?>_DatetimeCreate", {"ignoreReadonly":true,"useCurrent":false,"format":0});
</script>
<?php } ?>
</span>
<?php } ?>
<?php if ($tbl_checkstockdetail->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $tbl_checkstockdetail_grid->RowCnt ?>_tbl_checkstockdetail_DatetimeCreate" class="tbl_checkstockdetail_DatetimeCreate">
<span<?php echo $tbl_checkstockdetail->DatetimeCreate->viewAttributes() ?>>
<?php echo $tbl_checkstockdetail->DatetimeCreate->getViewValue() ?></span>
</span>
<?php if (!$tbl_checkstockdetail->isConfirm()) { ?>
<input type="hidden" data-table="tbl_checkstockdetail" data-field="x_DatetimeCreate" name="x<?php echo $tbl_checkstockdetail_grid->RowIndex ?>_DatetimeCreate" id="x<?php echo $tbl_checkstockdetail_grid->RowIndex ?>_DatetimeCreate" value="<?php echo HtmlEncode($tbl_checkstockdetail->DatetimeCreate->FormValue) ?>">
<input type="hidden" data-table="tbl_checkstockdetail" data-field="x_DatetimeCreate" name="o<?php echo $tbl_checkstockdetail_grid->RowIndex ?>_DatetimeCreate" id="o<?php echo $tbl_checkstockdetail_grid->RowIndex ?>_DatetimeCreate" value="<?php echo HtmlEncode($tbl_checkstockdetail->DatetimeCreate->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="tbl_checkstockdetail" data-field="x_DatetimeCreate" name="ftbl_checkstockdetailgrid$x<?php echo $tbl_checkstockdetail_grid->RowIndex ?>_DatetimeCreate" id="ftbl_checkstockdetailgrid$x<?php echo $tbl_checkstockdetail_grid->RowIndex ?>_DatetimeCreate" value="<?php echo HtmlEncode($tbl_checkstockdetail->DatetimeCreate->FormValue) ?>">
<input type="hidden" data-table="tbl_checkstockdetail" data-field="x_DatetimeCreate" name="ftbl_checkstockdetailgrid$o<?php echo $tbl_checkstockdetail_grid->RowIndex ?>_DatetimeCreate" id="ftbl_checkstockdetailgrid$o<?php echo $tbl_checkstockdetail_grid->RowIndex ?>_DatetimeCreate" value="<?php echo HtmlEncode($tbl_checkstockdetail->DatetimeCreate->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$tbl_checkstockdetail_grid->ListOptions->render("body", "right", $tbl_checkstockdetail_grid->RowCnt);
?>
	</tr>
<?php if ($tbl_checkstockdetail->RowType == ROWTYPE_ADD || $tbl_checkstockdetail->RowType == ROWTYPE_EDIT) { ?>
<script>
ftbl_checkstockdetailgrid.updateLists(<?php echo $tbl_checkstockdetail_grid->RowIndex ?>);
</script>
<?php } ?>
<?php
	}
	} // End delete row checking
	if (!$tbl_checkstockdetail->isGridAdd() || $tbl_checkstockdetail->CurrentMode == "copy")
		if (!$tbl_checkstockdetail_grid->Recordset->EOF)
			$tbl_checkstockdetail_grid->Recordset->moveNext();
}
?>
<?php
	if ($tbl_checkstockdetail->CurrentMode == "add" || $tbl_checkstockdetail->CurrentMode == "copy" || $tbl_checkstockdetail->CurrentMode == "edit") {
		$tbl_checkstockdetail_grid->RowIndex = '$rowindex$';
		$tbl_checkstockdetail_grid->loadRowValues();

		// Set row properties
		$tbl_checkstockdetail->resetAttributes();
		$tbl_checkstockdetail->RowAttrs = array_merge($tbl_checkstockdetail->RowAttrs, array('data-rowindex'=>$tbl_checkstockdetail_grid->RowIndex, 'id'=>'r0_tbl_checkstockdetail', 'data-rowtype'=>ROWTYPE_ADD));
		AppendClass($tbl_checkstockdetail->RowAttrs["class"], "ew-template");
		$tbl_checkstockdetail->RowType = ROWTYPE_ADD;

		// Render row
		$tbl_checkstockdetail_grid->renderRow();

		// Render list options
		$tbl_checkstockdetail_grid->renderListOptions();
		$tbl_checkstockdetail_grid->StartRowCnt = 0;
?>
	<tr<?php echo $tbl_checkstockdetail->rowAttributes() ?>>
<?php

// Render list options (body, left)
$tbl_checkstockdetail_grid->ListOptions->render("body", "left", $tbl_checkstockdetail_grid->RowIndex);
?>
	<?php if ($tbl_checkstockdetail->Location->Visible) { // Location ?>
		<td data-name="Location">
<?php if (!$tbl_checkstockdetail->isConfirm()) { ?>
<span id="el$rowindex$_tbl_checkstockdetail_Location" class="form-group tbl_checkstockdetail_Location">
<input type="text" data-table="tbl_checkstockdetail" data-field="x_Location" name="x<?php echo $tbl_checkstockdetail_grid->RowIndex ?>_Location" id="x<?php echo $tbl_checkstockdetail_grid->RowIndex ?>_Location" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($tbl_checkstockdetail->Location->getPlaceHolder()) ?>" value="<?php echo $tbl_checkstockdetail->Location->EditValue ?>"<?php echo $tbl_checkstockdetail->Location->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_tbl_checkstockdetail_Location" class="form-group tbl_checkstockdetail_Location">
<span<?php echo $tbl_checkstockdetail->Location->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?php echo RemoveHtml($tbl_checkstockdetail->Location->ViewValue) ?>"></span>
</span>
<input type="hidden" data-table="tbl_checkstockdetail" data-field="x_Location" name="x<?php echo $tbl_checkstockdetail_grid->RowIndex ?>_Location" id="x<?php echo $tbl_checkstockdetail_grid->RowIndex ?>_Location" value="<?php echo HtmlEncode($tbl_checkstockdetail->Location->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="tbl_checkstockdetail" data-field="x_Location" name="o<?php echo $tbl_checkstockdetail_grid->RowIndex ?>_Location" id="o<?php echo $tbl_checkstockdetail_grid->RowIndex ?>_Location" value="<?php echo HtmlEncode($tbl_checkstockdetail->Location->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($tbl_checkstockdetail->PalletID->Visible) { // PalletID ?>
		<td data-name="PalletID">
<?php if (!$tbl_checkstockdetail->isConfirm()) { ?>
<span id="el$rowindex$_tbl_checkstockdetail_PalletID" class="form-group tbl_checkstockdetail_PalletID">
<input type="text" data-table="tbl_checkstockdetail" data-field="x_PalletID" name="x<?php echo $tbl_checkstockdetail_grid->RowIndex ?>_PalletID" id="x<?php echo $tbl_checkstockdetail_grid->RowIndex ?>_PalletID" size="30" maxlength="50" placeholder="<?php echo HtmlEncode($tbl_checkstockdetail->PalletID->getPlaceHolder()) ?>" value="<?php echo $tbl_checkstockdetail->PalletID->EditValue ?>"<?php echo $tbl_checkstockdetail->PalletID->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_tbl_checkstockdetail_PalletID" class="form-group tbl_checkstockdetail_PalletID">
<span<?php echo $tbl_checkstockdetail->PalletID->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?php echo RemoveHtml($tbl_checkstockdetail->PalletID->ViewValue) ?>"></span>
</span>
<input type="hidden" data-table="tbl_checkstockdetail" data-field="x_PalletID" name="x<?php echo $tbl_checkstockdetail_grid->RowIndex ?>_PalletID" id="x<?php echo $tbl_checkstockdetail_grid->RowIndex ?>_PalletID" value="<?php echo HtmlEncode($tbl_checkstockdetail->PalletID->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="tbl_checkstockdetail" data-field="x_PalletID" name="o<?php echo $tbl_checkstockdetail_grid->RowIndex ?>_PalletID" id="o<?php echo $tbl_checkstockdetail_grid->RowIndex ?>_PalletID" value="<?php echo HtmlEncode($tbl_checkstockdetail->PalletID->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($tbl_checkstockdetail->Code->Visible) { // Code ?>
		<td data-name="Code">
<?php if (!$tbl_checkstockdetail->isConfirm()) { ?>
<span id="el$rowindex$_tbl_checkstockdetail_Code" class="form-group tbl_checkstockdetail_Code">
<input type="text" data-table="tbl_checkstockdetail" data-field="x_Code" name="x<?php echo $tbl_checkstockdetail_grid->RowIndex ?>_Code" id="x<?php echo $tbl_checkstockdetail_grid->RowIndex ?>_Code" size="30" maxlength="50" placeholder="<?php echo HtmlEncode($tbl_checkstockdetail->Code->getPlaceHolder()) ?>" value="<?php echo $tbl_checkstockdetail->Code->EditValue ?>"<?php echo $tbl_checkstockdetail->Code->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_tbl_checkstockdetail_Code" class="form-group tbl_checkstockdetail_Code">
<span<?php echo $tbl_checkstockdetail->Code->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?php echo RemoveHtml($tbl_checkstockdetail->Code->ViewValue) ?>"></span>
</span>
<input type="hidden" data-table="tbl_checkstockdetail" data-field="x_Code" name="x<?php echo $tbl_checkstockdetail_grid->RowIndex ?>_Code" id="x<?php echo $tbl_checkstockdetail_grid->RowIndex ?>_Code" value="<?php echo HtmlEncode($tbl_checkstockdetail->Code->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="tbl_checkstockdetail" data-field="x_Code" name="o<?php echo $tbl_checkstockdetail_grid->RowIndex ?>_Code" id="o<?php echo $tbl_checkstockdetail_grid->RowIndex ?>_Code" value="<?php echo HtmlEncode($tbl_checkstockdetail->Code->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($tbl_checkstockdetail->PCS->Visible) { // PCS ?>
		<td data-name="PCS">
<?php if (!$tbl_checkstockdetail->isConfirm()) { ?>
<span id="el$rowindex$_tbl_checkstockdetail_PCS" class="form-group tbl_checkstockdetail_PCS">
<input type="text" data-table="tbl_checkstockdetail" data-field="x_PCS" name="x<?php echo $tbl_checkstockdetail_grid->RowIndex ?>_PCS" id="x<?php echo $tbl_checkstockdetail_grid->RowIndex ?>_PCS" size="30" placeholder="<?php echo HtmlEncode($tbl_checkstockdetail->PCS->getPlaceHolder()) ?>" value="<?php echo $tbl_checkstockdetail->PCS->EditValue ?>"<?php echo $tbl_checkstockdetail->PCS->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_tbl_checkstockdetail_PCS" class="form-group tbl_checkstockdetail_PCS">
<span<?php echo $tbl_checkstockdetail->PCS->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?php echo RemoveHtml($tbl_checkstockdetail->PCS->ViewValue) ?>"></span>
</span>
<input type="hidden" data-table="tbl_checkstockdetail" data-field="x_PCS" name="x<?php echo $tbl_checkstockdetail_grid->RowIndex ?>_PCS" id="x<?php echo $tbl_checkstockdetail_grid->RowIndex ?>_PCS" value="<?php echo HtmlEncode($tbl_checkstockdetail->PCS->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="tbl_checkstockdetail" data-field="x_PCS" name="o<?php echo $tbl_checkstockdetail_grid->RowIndex ?>_PCS" id="o<?php echo $tbl_checkstockdetail_grid->RowIndex ?>_PCS" value="<?php echo HtmlEncode($tbl_checkstockdetail->PCS->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($tbl_checkstockdetail->DateTimeCheck->Visible) { // DateTimeCheck ?>
		<td data-name="DateTimeCheck">
<?php if (!$tbl_checkstockdetail->isConfirm()) { ?>
<span id="el$rowindex$_tbl_checkstockdetail_DateTimeCheck" class="form-group tbl_checkstockdetail_DateTimeCheck">
<input type="text" data-table="tbl_checkstockdetail" data-field="x_DateTimeCheck" name="x<?php echo $tbl_checkstockdetail_grid->RowIndex ?>_DateTimeCheck" id="x<?php echo $tbl_checkstockdetail_grid->RowIndex ?>_DateTimeCheck" placeholder="<?php echo HtmlEncode($tbl_checkstockdetail->DateTimeCheck->getPlaceHolder()) ?>" value="<?php echo $tbl_checkstockdetail->DateTimeCheck->EditValue ?>"<?php echo $tbl_checkstockdetail->DateTimeCheck->editAttributes() ?>>
<?php if (!$tbl_checkstockdetail->DateTimeCheck->ReadOnly && !$tbl_checkstockdetail->DateTimeCheck->Disabled && !isset($tbl_checkstockdetail->DateTimeCheck->EditAttrs["readonly"]) && !isset($tbl_checkstockdetail->DateTimeCheck->EditAttrs["disabled"])) { ?>
<script>
ew.createDateTimePicker("ftbl_checkstockdetailgrid", "x<?php echo $tbl_checkstockdetail_grid->RowIndex ?>_DateTimeCheck", {"ignoreReadonly":true,"useCurrent":false,"format":0});
</script>
<?php } ?>
</span>
<?php } else { ?>
<span id="el$rowindex$_tbl_checkstockdetail_DateTimeCheck" class="form-group tbl_checkstockdetail_DateTimeCheck">
<span<?php echo $tbl_checkstockdetail->DateTimeCheck->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?php echo RemoveHtml($tbl_checkstockdetail->DateTimeCheck->ViewValue) ?>"></span>
</span>
<input type="hidden" data-table="tbl_checkstockdetail" data-field="x_DateTimeCheck" name="x<?php echo $tbl_checkstockdetail_grid->RowIndex ?>_DateTimeCheck" id="x<?php echo $tbl_checkstockdetail_grid->RowIndex ?>_DateTimeCheck" value="<?php echo HtmlEncode($tbl_checkstockdetail->DateTimeCheck->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="tbl_checkstockdetail" data-field="x_DateTimeCheck" name="o<?php echo $tbl_checkstockdetail_grid->RowIndex ?>_DateTimeCheck" id="o<?php echo $tbl_checkstockdetail_grid->RowIndex ?>_DateTimeCheck" value="<?php echo HtmlEncode($tbl_checkstockdetail->DateTimeCheck->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($tbl_checkstockdetail->UserCheck->Visible) { // UserCheck ?>
		<td data-name="UserCheck">
<?php if (!$tbl_checkstockdetail->isConfirm()) { ?>
<span id="el$rowindex$_tbl_checkstockdetail_UserCheck" class="form-group tbl_checkstockdetail_UserCheck">
<input type="text" data-table="tbl_checkstockdetail" data-field="x_UserCheck" name="x<?php echo $tbl_checkstockdetail_grid->RowIndex ?>_UserCheck" id="x<?php echo $tbl_checkstockdetail_grid->RowIndex ?>_UserCheck" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($tbl_checkstockdetail->UserCheck->getPlaceHolder()) ?>" value="<?php echo $tbl_checkstockdetail->UserCheck->EditValue ?>"<?php echo $tbl_checkstockdetail->UserCheck->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_tbl_checkstockdetail_UserCheck" class="form-group tbl_checkstockdetail_UserCheck">
<span<?php echo $tbl_checkstockdetail->UserCheck->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?php echo RemoveHtml($tbl_checkstockdetail->UserCheck->ViewValue) ?>"></span>
</span>
<input type="hidden" data-table="tbl_checkstockdetail" data-field="x_UserCheck" name="x<?php echo $tbl_checkstockdetail_grid->RowIndex ?>_UserCheck" id="x<?php echo $tbl_checkstockdetail_grid->RowIndex ?>_UserCheck" value="<?php echo HtmlEncode($tbl_checkstockdetail->UserCheck->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="tbl_checkstockdetail" data-field="x_UserCheck" name="o<?php echo $tbl_checkstockdetail_grid->RowIndex ?>_UserCheck" id="o<?php echo $tbl_checkstockdetail_grid->RowIndex ?>_UserCheck" value="<?php echo HtmlEncode($tbl_checkstockdetail->UserCheck->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($tbl_checkstockdetail->Usercreate->Visible) { // Usercreate ?>
		<td data-name="Usercreate">
<?php if (!$tbl_checkstockdetail->isConfirm()) { ?>
<span id="el$rowindex$_tbl_checkstockdetail_Usercreate" class="form-group tbl_checkstockdetail_Usercreate">
<input type="text" data-table="tbl_checkstockdetail" data-field="x_Usercreate" name="x<?php echo $tbl_checkstockdetail_grid->RowIndex ?>_Usercreate" id="x<?php echo $tbl_checkstockdetail_grid->RowIndex ?>_Usercreate" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($tbl_checkstockdetail->Usercreate->getPlaceHolder()) ?>" value="<?php echo $tbl_checkstockdetail->Usercreate->EditValue ?>"<?php echo $tbl_checkstockdetail->Usercreate->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_tbl_checkstockdetail_Usercreate" class="form-group tbl_checkstockdetail_Usercreate">
<span<?php echo $tbl_checkstockdetail->Usercreate->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?php echo RemoveHtml($tbl_checkstockdetail->Usercreate->ViewValue) ?>"></span>
</span>
<input type="hidden" data-table="tbl_checkstockdetail" data-field="x_Usercreate" name="x<?php echo $tbl_checkstockdetail_grid->RowIndex ?>_Usercreate" id="x<?php echo $tbl_checkstockdetail_grid->RowIndex ?>_Usercreate" value="<?php echo HtmlEncode($tbl_checkstockdetail->Usercreate->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="tbl_checkstockdetail" data-field="x_Usercreate" name="o<?php echo $tbl_checkstockdetail_grid->RowIndex ?>_Usercreate" id="o<?php echo $tbl_checkstockdetail_grid->RowIndex ?>_Usercreate" value="<?php echo HtmlEncode($tbl_checkstockdetail->Usercreate->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($tbl_checkstockdetail->DatetimeCreate->Visible) { // DatetimeCreate ?>
		<td data-name="DatetimeCreate">
<?php if (!$tbl_checkstockdetail->isConfirm()) { ?>
<span id="el$rowindex$_tbl_checkstockdetail_DatetimeCreate" class="form-group tbl_checkstockdetail_DatetimeCreate">
<input type="text" data-table="tbl_checkstockdetail" data-field="x_DatetimeCreate" name="x<?php echo $tbl_checkstockdetail_grid->RowIndex ?>_DatetimeCreate" id="x<?php echo $tbl_checkstockdetail_grid->RowIndex ?>_DatetimeCreate" placeholder="<?php echo HtmlEncode($tbl_checkstockdetail->DatetimeCreate->getPlaceHolder()) ?>" value="<?php echo $tbl_checkstockdetail->DatetimeCreate->EditValue ?>"<?php echo $tbl_checkstockdetail->DatetimeCreate->editAttributes() ?>>
<?php if (!$tbl_checkstockdetail->DatetimeCreate->ReadOnly && !$tbl_checkstockdetail->DatetimeCreate->Disabled && !isset($tbl_checkstockdetail->DatetimeCreate->EditAttrs["readonly"]) && !isset($tbl_checkstockdetail->DatetimeCreate->EditAttrs["disabled"])) { ?>
<script>
ew.createDateTimePicker("ftbl_checkstockdetailgrid", "x<?php echo $tbl_checkstockdetail_grid->RowIndex ?>_DatetimeCreate", {"ignoreReadonly":true,"useCurrent":false,"format":0});
</script>
<?php } ?>
</span>
<?php } else { ?>
<span id="el$rowindex$_tbl_checkstockdetail_DatetimeCreate" class="form-group tbl_checkstockdetail_DatetimeCreate">
<span<?php echo $tbl_checkstockdetail->DatetimeCreate->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?php echo RemoveHtml($tbl_checkstockdetail->DatetimeCreate->ViewValue) ?>"></span>
</span>
<input type="hidden" data-table="tbl_checkstockdetail" data-field="x_DatetimeCreate" name="x<?php echo $tbl_checkstockdetail_grid->RowIndex ?>_DatetimeCreate" id="x<?php echo $tbl_checkstockdetail_grid->RowIndex ?>_DatetimeCreate" value="<?php echo HtmlEncode($tbl_checkstockdetail->DatetimeCreate->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="tbl_checkstockdetail" data-field="x_DatetimeCreate" name="o<?php echo $tbl_checkstockdetail_grid->RowIndex ?>_DatetimeCreate" id="o<?php echo $tbl_checkstockdetail_grid->RowIndex ?>_DatetimeCreate" value="<?php echo HtmlEncode($tbl_checkstockdetail->DatetimeCreate->OldValue) ?>">
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$tbl_checkstockdetail_grid->ListOptions->render("body", "right", $tbl_checkstockdetail_grid->RowIndex);
?>
<script>
ftbl_checkstockdetailgrid.updateLists(<?php echo $tbl_checkstockdetail_grid->RowIndex ?>);
</script>
	</tr>
<?php
}
?>
</tbody>
<?php

// Render aggregate row
$tbl_checkstockdetail->RowType = ROWTYPE_AGGREGATE;
$tbl_checkstockdetail->resetAttributes();
$tbl_checkstockdetail_grid->renderRow();
?>
<?php if ($tbl_checkstockdetail_grid->TotalRecs > 0 && $tbl_checkstockdetail->CurrentMode == "view") { ?>
<tfoot><!-- Table footer -->
	<tr class="ew-table-footer">
<?php

// Render list options
$tbl_checkstockdetail_grid->renderListOptions();

// Render list options (footer, left)
$tbl_checkstockdetail_grid->ListOptions->render("footer", "left");
?>
	<?php if ($tbl_checkstockdetail->Location->Visible) { // Location ?>
		<td data-name="Location" class="<?php echo $tbl_checkstockdetail->Location->footerCellClass() ?>"><span id="elf_tbl_checkstockdetail_Location" class="tbl_checkstockdetail_Location">
		&nbsp;
		</span></td>
	<?php } ?>
	<?php if ($tbl_checkstockdetail->PalletID->Visible) { // PalletID ?>
		<td data-name="PalletID" class="<?php echo $tbl_checkstockdetail->PalletID->footerCellClass() ?>"><span id="elf_tbl_checkstockdetail_PalletID" class="tbl_checkstockdetail_PalletID">
		&nbsp;
		</span></td>
	<?php } ?>
	<?php if ($tbl_checkstockdetail->Code->Visible) { // Code ?>
		<td data-name="Code" class="<?php echo $tbl_checkstockdetail->Code->footerCellClass() ?>"><span id="elf_tbl_checkstockdetail_Code" class="tbl_checkstockdetail_Code">
		&nbsp;
		</span></td>
	<?php } ?>
	<?php if ($tbl_checkstockdetail->PCS->Visible) { // PCS ?>
		<td data-name="PCS" class="<?php echo $tbl_checkstockdetail->PCS->footerCellClass() ?>"><span id="elf_tbl_checkstockdetail_PCS" class="tbl_checkstockdetail_PCS">
		<span class="ew-aggregate"><?php echo $Language->phrase("TOTAL") ?></span><span class="ew-aggregate-value">
		<?php echo $tbl_checkstockdetail->PCS->ViewValue ?></span>
		</span></td>
	<?php } ?>
	<?php if ($tbl_checkstockdetail->DateTimeCheck->Visible) { // DateTimeCheck ?>
		<td data-name="DateTimeCheck" class="<?php echo $tbl_checkstockdetail->DateTimeCheck->footerCellClass() ?>"><span id="elf_tbl_checkstockdetail_DateTimeCheck" class="tbl_checkstockdetail_DateTimeCheck">
		&nbsp;
		</span></td>
	<?php } ?>
	<?php if ($tbl_checkstockdetail->UserCheck->Visible) { // UserCheck ?>
		<td data-name="UserCheck" class="<?php echo $tbl_checkstockdetail->UserCheck->footerCellClass() ?>"><span id="elf_tbl_checkstockdetail_UserCheck" class="tbl_checkstockdetail_UserCheck">
		&nbsp;
		</span></td>
	<?php } ?>
	<?php if ($tbl_checkstockdetail->Usercreate->Visible) { // Usercreate ?>
		<td data-name="Usercreate" class="<?php echo $tbl_checkstockdetail->Usercreate->footerCellClass() ?>"><span id="elf_tbl_checkstockdetail_Usercreate" class="tbl_checkstockdetail_Usercreate">
		&nbsp;
		</span></td>
	<?php } ?>
	<?php if ($tbl_checkstockdetail->DatetimeCreate->Visible) { // DatetimeCreate ?>
		<td data-name="DatetimeCreate" class="<?php echo $tbl_checkstockdetail->DatetimeCreate->footerCellClass() ?>"><span id="elf_tbl_checkstockdetail_DatetimeCreate" class="tbl_checkstockdetail_DatetimeCreate">
		&nbsp;
		</span></td>
	<?php } ?>
<?php

// Render list options (footer, right)
$tbl_checkstockdetail_grid->ListOptions->render("footer", "right");
?>
	</tr>
</tfoot>
<?php } ?>
</table><!-- /.ew-table -->
<?php if ($tbl_checkstockdetail->CurrentMode == "add" || $tbl_checkstockdetail->CurrentMode == "copy") { ?>
<input type="hidden" name="<?php echo $tbl_checkstockdetail_grid->FormKeyCountName ?>" id="<?php echo $tbl_checkstockdetail_grid->FormKeyCountName ?>" value="<?php echo $tbl_checkstockdetail_grid->KeyCount ?>">
<?php echo $tbl_checkstockdetail_grid->MultiSelectKey ?>
<?php } ?>
<?php if ($tbl_checkstockdetail->CurrentMode == "edit") { ?>
<input type="hidden" name="<?php echo $tbl_checkstockdetail_grid->FormKeyCountName ?>" id="<?php echo $tbl_checkstockdetail_grid->FormKeyCountName ?>" value="<?php echo $tbl_checkstockdetail_grid->KeyCount ?>">
<?php echo $tbl_checkstockdetail_grid->MultiSelectKey ?>
<?php } ?>
<?php if ($tbl_checkstockdetail->CurrentMode == "") { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
<input type="hidden" name="detailpage" value="ftbl_checkstockdetailgrid">
</div><!-- /.ew-grid-middle-panel -->
<?php

// Close recordset
if ($tbl_checkstockdetail_grid->Recordset)
	$tbl_checkstockdetail_grid->Recordset->Close();
?>
</div>
<?php if ($tbl_checkstockdetail_grid->ShowOtherOptions) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php $tbl_checkstockdetail_grid->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($tbl_checkstockdetail_grid->TotalRecs == 0 && !$tbl_checkstockdetail->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $tbl_checkstockdetail_grid->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$tbl_checkstockdetail_grid->terminate();
?>