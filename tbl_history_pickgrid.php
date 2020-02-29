<?php
namespace PHPMaker2019\asgbn_wh;

// Write header
WriteHeader(FALSE);

// Create page object
if (!isset($tbl_history_pick_grid))
	$tbl_history_pick_grid = new tbl_history_pick_grid();

// Run the page
$tbl_history_pick_grid->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$tbl_history_pick_grid->Page_Render();
?>
<?php if (!$tbl_history_pick->isExport()) { ?>
<script>

// Form object
var ftbl_history_pickgrid = new ew.Form("ftbl_history_pickgrid", "grid");
ftbl_history_pickgrid.formKeyCountName = '<?php echo $tbl_history_pick_grid->FormKeyCountName ?>';

// Validate form
ftbl_history_pickgrid.validate = function() {
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
		<?php if ($tbl_history_pick_grid->PalletID->Required) { ?>
			elm = this.getElements("x" + infix + "_PalletID");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $tbl_history_pick->PalletID->caption(), $tbl_history_pick->PalletID->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($tbl_history_pick_grid->Code->Required) { ?>
			elm = this.getElements("x" + infix + "_Code");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $tbl_history_pick->Code->caption(), $tbl_history_pick->Code->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($tbl_history_pick_grid->ID_Location->Required) { ?>
			elm = this.getElements("x" + infix + "_ID_Location");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $tbl_history_pick->ID_Location->caption(), $tbl_history_pick->ID_Location->RequiredErrorMessage)) ?>");
		<?php } ?>
			elm = this.getElements("x" + infix + "_ID_Location");
			if (elm && !ew.checkInteger(elm.value))
				return this.onError(elm, "<?php echo JsEncode($tbl_history_pick->ID_Location->errorMessage()) ?>");
		<?php if ($tbl_history_pick_grid->PCS->Required) { ?>
			elm = this.getElements("x" + infix + "_PCS");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $tbl_history_pick->PCS->caption(), $tbl_history_pick->PCS->RequiredErrorMessage)) ?>");
		<?php } ?>
			elm = this.getElements("x" + infix + "_PCS");
			if (elm && !ew.checkInteger(elm.value))
				return this.onError(elm, "<?php echo JsEncode($tbl_history_pick->PCS->errorMessage()) ?>");
		<?php if ($tbl_history_pick_grid->DateIn->Required) { ?>
			elm = this.getElements("x" + infix + "_DateIn");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $tbl_history_pick->DateIn->caption(), $tbl_history_pick->DateIn->RequiredErrorMessage)) ?>");
		<?php } ?>
			elm = this.getElements("x" + infix + "_DateIn");
			if (elm && !ew.checkEuroDate(elm.value))
				return this.onError(elm, "<?php echo JsEncode($tbl_history_pick->DateIn->errorMessage()) ?>");
		<?php if ($tbl_history_pick_grid->User_ID->Required) { ?>
			elm = this.getElements("x" + infix + "_User_ID");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $tbl_history_pick->User_ID->caption(), $tbl_history_pick->User_ID->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($tbl_history_pick_grid->PalletStatus->Required) { ?>
			elm = this.getElements("x" + infix + "_PalletStatus");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $tbl_history_pick->PalletStatus->caption(), $tbl_history_pick->PalletStatus->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($tbl_history_pick_grid->CreateUser->Required) { ?>
			elm = this.getElements("x" + infix + "_CreateUser");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $tbl_history_pick->CreateUser->caption(), $tbl_history_pick->CreateUser->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($tbl_history_pick_grid->CreateDate->Required) { ?>
			elm = this.getElements("x" + infix + "_CreateDate");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $tbl_history_pick->CreateDate->caption(), $tbl_history_pick->CreateDate->RequiredErrorMessage)) ?>");
		<?php } ?>
			elm = this.getElements("x" + infix + "_CreateDate");
			if (elm && !ew.checkDateDef(elm.value))
				return this.onError(elm, "<?php echo JsEncode($tbl_history_pick->CreateDate->errorMessage()) ?>");
		<?php if ($tbl_history_pick_grid->Box->Required) { ?>
			elm = this.getElements("x" + infix + "_Box");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $tbl_history_pick->Box->caption(), $tbl_history_pick->Box->RequiredErrorMessage)) ?>");
		<?php } ?>
			elm = this.getElements("x" + infix + "_Box");
			if (elm && !ew.checkInteger(elm.value))
				return this.onError(elm, "<?php echo JsEncode($tbl_history_pick->Box->errorMessage()) ?>");

			// Fire Form_CustomValidate event
			if (!this.Form_CustomValidate(fobj))
				return false;
		} // End Grid Add checking
	}
	return true;
}

// Check empty row
ftbl_history_pickgrid.emptyRow = function(infix) {
	var fobj = this._form;
	if (ew.valueChanged(fobj, infix, "PalletID", false)) return false;
	if (ew.valueChanged(fobj, infix, "Code", false)) return false;
	if (ew.valueChanged(fobj, infix, "ID_Location", false)) return false;
	if (ew.valueChanged(fobj, infix, "PCS", false)) return false;
	if (ew.valueChanged(fobj, infix, "DateIn", false)) return false;
	if (ew.valueChanged(fobj, infix, "User_ID", false)) return false;
	if (ew.valueChanged(fobj, infix, "PalletStatus", false)) return false;
	if (ew.valueChanged(fobj, infix, "CreateUser", false)) return false;
	if (ew.valueChanged(fobj, infix, "CreateDate", false)) return false;
	if (ew.valueChanged(fobj, infix, "Box", false)) return false;
	return true;
}

// Form_CustomValidate event
ftbl_history_pickgrid.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

	// Your custom validation code here, return false if invalid.
	return true;
}

// Use JavaScript validation or not
ftbl_history_pickgrid.validateRequired = <?php echo json_encode(CLIENT_VALIDATE) ?>;

// Dynamic selection lists
ftbl_history_pickgrid.lists["x_ID_Location"] = <?php echo $tbl_history_pick_grid->ID_Location->Lookup->toClientList() ?>;
ftbl_history_pickgrid.lists["x_ID_Location"].options = <?php echo JsonEncode($tbl_history_pick_grid->ID_Location->lookupOptions()) ?>;
ftbl_history_pickgrid.autoSuggests["x_ID_Location"] = <?php echo json_encode(["data" => "ajax=autosuggest"]) ?>;

// Form object for search
</script>
<?php } ?>
<?php
$tbl_history_pick_grid->renderOtherOptions();
?>
<?php $tbl_history_pick_grid->showPageHeader(); ?>
<?php
$tbl_history_pick_grid->showMessage();
?>
<?php if ($tbl_history_pick_grid->TotalRecs > 0 || $tbl_history_pick->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($tbl_history_pick_grid->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> tbl_history_pick">
<?php if ($tbl_history_pick_grid->ShowOtherOptions) { ?>
<div class="card-header ew-grid-upper-panel">
<?php $tbl_history_pick_grid->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<div id="ftbl_history_pickgrid" class="ew-form ew-list-form form-inline">
<div id="gmp_tbl_history_pick" class="<?php if (IsResponsiveLayout()) { ?>table-responsive <?php } ?>card-body ew-grid-middle-panel">
<table id="tbl_tbl_history_pickgrid" class="table ew-table"><!-- .ew-table ##-->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$tbl_history_pick_grid->RowType = ROWTYPE_HEADER;

// Render list options
$tbl_history_pick_grid->renderListOptions();

// Render list options (header, left)
$tbl_history_pick_grid->ListOptions->render("header", "left");
?>
<?php if ($tbl_history_pick->PalletID->Visible) { // PalletID ?>
	<?php if ($tbl_history_pick->sortUrl($tbl_history_pick->PalletID) == "") { ?>
		<th data-name="PalletID" class="<?php echo $tbl_history_pick->PalletID->headerCellClass() ?>" style="white-space: nowrap;"><div id="elh_tbl_history_pick_PalletID" class="tbl_history_pick_PalletID"><div class="ew-table-header-caption"><?php echo $tbl_history_pick->PalletID->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="PalletID" class="<?php echo $tbl_history_pick->PalletID->headerCellClass() ?>" style="white-space: nowrap;"><div><div id="elh_tbl_history_pick_PalletID" class="tbl_history_pick_PalletID">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $tbl_history_pick->PalletID->caption() ?></span><span class="ew-table-header-sort"><?php if ($tbl_history_pick->PalletID->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($tbl_history_pick->PalletID->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($tbl_history_pick->Code->Visible) { // Code ?>
	<?php if ($tbl_history_pick->sortUrl($tbl_history_pick->Code) == "") { ?>
		<th data-name="Code" class="<?php echo $tbl_history_pick->Code->headerCellClass() ?>" style="white-space: nowrap;"><div id="elh_tbl_history_pick_Code" class="tbl_history_pick_Code"><div class="ew-table-header-caption"><?php echo $tbl_history_pick->Code->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Code" class="<?php echo $tbl_history_pick->Code->headerCellClass() ?>" style="white-space: nowrap;"><div><div id="elh_tbl_history_pick_Code" class="tbl_history_pick_Code">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $tbl_history_pick->Code->caption() ?></span><span class="ew-table-header-sort"><?php if ($tbl_history_pick->Code->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($tbl_history_pick->Code->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($tbl_history_pick->ID_Location->Visible) { // ID_Location ?>
	<?php if ($tbl_history_pick->sortUrl($tbl_history_pick->ID_Location) == "") { ?>
		<th data-name="ID_Location" class="<?php echo $tbl_history_pick->ID_Location->headerCellClass() ?>" style="white-space: nowrap;"><div id="elh_tbl_history_pick_ID_Location" class="tbl_history_pick_ID_Location"><div class="ew-table-header-caption"><?php echo $tbl_history_pick->ID_Location->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="ID_Location" class="<?php echo $tbl_history_pick->ID_Location->headerCellClass() ?>" style="white-space: nowrap;"><div><div id="elh_tbl_history_pick_ID_Location" class="tbl_history_pick_ID_Location">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $tbl_history_pick->ID_Location->caption() ?></span><span class="ew-table-header-sort"><?php if ($tbl_history_pick->ID_Location->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($tbl_history_pick->ID_Location->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($tbl_history_pick->PCS->Visible) { // PCS ?>
	<?php if ($tbl_history_pick->sortUrl($tbl_history_pick->PCS) == "") { ?>
		<th data-name="PCS" class="<?php echo $tbl_history_pick->PCS->headerCellClass() ?>" style="white-space: nowrap;"><div id="elh_tbl_history_pick_PCS" class="tbl_history_pick_PCS"><div class="ew-table-header-caption"><?php echo $tbl_history_pick->PCS->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="PCS" class="<?php echo $tbl_history_pick->PCS->headerCellClass() ?>" style="white-space: nowrap;"><div><div id="elh_tbl_history_pick_PCS" class="tbl_history_pick_PCS">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $tbl_history_pick->PCS->caption() ?></span><span class="ew-table-header-sort"><?php if ($tbl_history_pick->PCS->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($tbl_history_pick->PCS->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($tbl_history_pick->DateIn->Visible) { // DateIn ?>
	<?php if ($tbl_history_pick->sortUrl($tbl_history_pick->DateIn) == "") { ?>
		<th data-name="DateIn" class="<?php echo $tbl_history_pick->DateIn->headerCellClass() ?>" style="white-space: nowrap;"><div id="elh_tbl_history_pick_DateIn" class="tbl_history_pick_DateIn"><div class="ew-table-header-caption"><?php echo $tbl_history_pick->DateIn->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="DateIn" class="<?php echo $tbl_history_pick->DateIn->headerCellClass() ?>" style="white-space: nowrap;"><div><div id="elh_tbl_history_pick_DateIn" class="tbl_history_pick_DateIn">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $tbl_history_pick->DateIn->caption() ?></span><span class="ew-table-header-sort"><?php if ($tbl_history_pick->DateIn->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($tbl_history_pick->DateIn->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($tbl_history_pick->User_ID->Visible) { // User_ID ?>
	<?php if ($tbl_history_pick->sortUrl($tbl_history_pick->User_ID) == "") { ?>
		<th data-name="User_ID" class="<?php echo $tbl_history_pick->User_ID->headerCellClass() ?>" style="white-space: nowrap;"><div id="elh_tbl_history_pick_User_ID" class="tbl_history_pick_User_ID"><div class="ew-table-header-caption"><?php echo $tbl_history_pick->User_ID->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="User_ID" class="<?php echo $tbl_history_pick->User_ID->headerCellClass() ?>" style="white-space: nowrap;"><div><div id="elh_tbl_history_pick_User_ID" class="tbl_history_pick_User_ID">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $tbl_history_pick->User_ID->caption() ?></span><span class="ew-table-header-sort"><?php if ($tbl_history_pick->User_ID->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($tbl_history_pick->User_ID->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($tbl_history_pick->PalletStatus->Visible) { // PalletStatus ?>
	<?php if ($tbl_history_pick->sortUrl($tbl_history_pick->PalletStatus) == "") { ?>
		<th data-name="PalletStatus" class="<?php echo $tbl_history_pick->PalletStatus->headerCellClass() ?>" style="white-space: nowrap;"><div id="elh_tbl_history_pick_PalletStatus" class="tbl_history_pick_PalletStatus"><div class="ew-table-header-caption"><?php echo $tbl_history_pick->PalletStatus->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="PalletStatus" class="<?php echo $tbl_history_pick->PalletStatus->headerCellClass() ?>" style="white-space: nowrap;"><div><div id="elh_tbl_history_pick_PalletStatus" class="tbl_history_pick_PalletStatus">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $tbl_history_pick->PalletStatus->caption() ?></span><span class="ew-table-header-sort"><?php if ($tbl_history_pick->PalletStatus->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($tbl_history_pick->PalletStatus->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($tbl_history_pick->CreateUser->Visible) { // CreateUser ?>
	<?php if ($tbl_history_pick->sortUrl($tbl_history_pick->CreateUser) == "") { ?>
		<th data-name="CreateUser" class="<?php echo $tbl_history_pick->CreateUser->headerCellClass() ?>" style="white-space: nowrap;"><div id="elh_tbl_history_pick_CreateUser" class="tbl_history_pick_CreateUser"><div class="ew-table-header-caption"><?php echo $tbl_history_pick->CreateUser->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="CreateUser" class="<?php echo $tbl_history_pick->CreateUser->headerCellClass() ?>" style="white-space: nowrap;"><div><div id="elh_tbl_history_pick_CreateUser" class="tbl_history_pick_CreateUser">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $tbl_history_pick->CreateUser->caption() ?></span><span class="ew-table-header-sort"><?php if ($tbl_history_pick->CreateUser->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($tbl_history_pick->CreateUser->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($tbl_history_pick->CreateDate->Visible) { // CreateDate ?>
	<?php if ($tbl_history_pick->sortUrl($tbl_history_pick->CreateDate) == "") { ?>
		<th data-name="CreateDate" class="<?php echo $tbl_history_pick->CreateDate->headerCellClass() ?>" style="white-space: nowrap;"><div id="elh_tbl_history_pick_CreateDate" class="tbl_history_pick_CreateDate"><div class="ew-table-header-caption"><?php echo $tbl_history_pick->CreateDate->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="CreateDate" class="<?php echo $tbl_history_pick->CreateDate->headerCellClass() ?>" style="white-space: nowrap;"><div><div id="elh_tbl_history_pick_CreateDate" class="tbl_history_pick_CreateDate">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $tbl_history_pick->CreateDate->caption() ?></span><span class="ew-table-header-sort"><?php if ($tbl_history_pick->CreateDate->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($tbl_history_pick->CreateDate->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($tbl_history_pick->Box->Visible) { // Box ?>
	<?php if ($tbl_history_pick->sortUrl($tbl_history_pick->Box) == "") { ?>
		<th data-name="Box" class="<?php echo $tbl_history_pick->Box->headerCellClass() ?>" style="white-space: nowrap;"><div id="elh_tbl_history_pick_Box" class="tbl_history_pick_Box"><div class="ew-table-header-caption"><?php echo $tbl_history_pick->Box->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Box" class="<?php echo $tbl_history_pick->Box->headerCellClass() ?>" style="white-space: nowrap;"><div><div id="elh_tbl_history_pick_Box" class="tbl_history_pick_Box">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $tbl_history_pick->Box->caption() ?></span><span class="ew-table-header-sort"><?php if ($tbl_history_pick->Box->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($tbl_history_pick->Box->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$tbl_history_pick_grid->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
$tbl_history_pick_grid->StartRec = 1;
$tbl_history_pick_grid->StopRec = $tbl_history_pick_grid->TotalRecs; // Show all records

// Restore number of post back records
if ($CurrentForm && $tbl_history_pick_grid->EventCancelled) {
	$CurrentForm->Index = -1;
	if ($CurrentForm->hasValue($tbl_history_pick_grid->FormKeyCountName) && ($tbl_history_pick->isGridAdd() || $tbl_history_pick->isGridEdit() || $tbl_history_pick->isConfirm())) {
		$tbl_history_pick_grid->KeyCount = $CurrentForm->getValue($tbl_history_pick_grid->FormKeyCountName);
		$tbl_history_pick_grid->StopRec = $tbl_history_pick_grid->StartRec + $tbl_history_pick_grid->KeyCount - 1;
	}
}
$tbl_history_pick_grid->RecCnt = $tbl_history_pick_grid->StartRec - 1;
if ($tbl_history_pick_grid->Recordset && !$tbl_history_pick_grid->Recordset->EOF) {
	$tbl_history_pick_grid->Recordset->moveFirst();
	$selectLimit = $tbl_history_pick_grid->UseSelectLimit;
	if (!$selectLimit && $tbl_history_pick_grid->StartRec > 1)
		$tbl_history_pick_grid->Recordset->move($tbl_history_pick_grid->StartRec - 1);
} elseif (!$tbl_history_pick->AllowAddDeleteRow && $tbl_history_pick_grid->StopRec == 0) {
	$tbl_history_pick_grid->StopRec = $tbl_history_pick->GridAddRowCount;
}

// Initialize aggregate
$tbl_history_pick->RowType = ROWTYPE_AGGREGATEINIT;
$tbl_history_pick->resetAttributes();
$tbl_history_pick_grid->renderRow();
if ($tbl_history_pick->isGridAdd())
	$tbl_history_pick_grid->RowIndex = 0;
if ($tbl_history_pick->isGridEdit())
	$tbl_history_pick_grid->RowIndex = 0;
while ($tbl_history_pick_grid->RecCnt < $tbl_history_pick_grid->StopRec) {
	$tbl_history_pick_grid->RecCnt++;
	if ($tbl_history_pick_grid->RecCnt >= $tbl_history_pick_grid->StartRec) {
		$tbl_history_pick_grid->RowCnt++;
		if ($tbl_history_pick->isGridAdd() || $tbl_history_pick->isGridEdit() || $tbl_history_pick->isConfirm()) {
			$tbl_history_pick_grid->RowIndex++;
			$CurrentForm->Index = $tbl_history_pick_grid->RowIndex;
			if ($CurrentForm->hasValue($tbl_history_pick_grid->FormActionName) && $tbl_history_pick_grid->EventCancelled)
				$tbl_history_pick_grid->RowAction = strval($CurrentForm->getValue($tbl_history_pick_grid->FormActionName));
			elseif ($tbl_history_pick->isGridAdd())
				$tbl_history_pick_grid->RowAction = "insert";
			else
				$tbl_history_pick_grid->RowAction = "";
		}

		// Set up key count
		$tbl_history_pick_grid->KeyCount = $tbl_history_pick_grid->RowIndex;

		// Init row class and style
		$tbl_history_pick->resetAttributes();
		$tbl_history_pick->CssClass = "";
		if ($tbl_history_pick->isGridAdd()) {
			if ($tbl_history_pick->CurrentMode == "copy") {
				$tbl_history_pick_grid->loadRowValues($tbl_history_pick_grid->Recordset); // Load row values
				$tbl_history_pick_grid->setRecordKey($tbl_history_pick_grid->RowOldKey, $tbl_history_pick_grid->Recordset); // Set old record key
			} else {
				$tbl_history_pick_grid->loadRowValues(); // Load default values
				$tbl_history_pick_grid->RowOldKey = ""; // Clear old key value
			}
		} else {
			$tbl_history_pick_grid->loadRowValues($tbl_history_pick_grid->Recordset); // Load row values
		}
		$tbl_history_pick->RowType = ROWTYPE_VIEW; // Render view
		if ($tbl_history_pick->isGridAdd()) // Grid add
			$tbl_history_pick->RowType = ROWTYPE_ADD; // Render add
		if ($tbl_history_pick->isGridAdd() && $tbl_history_pick->EventCancelled && !$CurrentForm->hasValue("k_blankrow")) // Insert failed
			$tbl_history_pick_grid->restoreCurrentRowFormValues($tbl_history_pick_grid->RowIndex); // Restore form values
		if ($tbl_history_pick->isGridEdit()) { // Grid edit
			if ($tbl_history_pick->EventCancelled)
				$tbl_history_pick_grid->restoreCurrentRowFormValues($tbl_history_pick_grid->RowIndex); // Restore form values
			if ($tbl_history_pick_grid->RowAction == "insert")
				$tbl_history_pick->RowType = ROWTYPE_ADD; // Render add
			else
				$tbl_history_pick->RowType = ROWTYPE_EDIT; // Render edit
		}
		if ($tbl_history_pick->isGridEdit() && ($tbl_history_pick->RowType == ROWTYPE_EDIT || $tbl_history_pick->RowType == ROWTYPE_ADD) && $tbl_history_pick->EventCancelled) // Update failed
			$tbl_history_pick_grid->restoreCurrentRowFormValues($tbl_history_pick_grid->RowIndex); // Restore form values
		if ($tbl_history_pick->RowType == ROWTYPE_EDIT) // Edit row
			$tbl_history_pick_grid->EditRowCnt++;
		if ($tbl_history_pick->isConfirm()) // Confirm row
			$tbl_history_pick_grid->restoreCurrentRowFormValues($tbl_history_pick_grid->RowIndex); // Restore form values

		// Set up row id / data-rowindex
		$tbl_history_pick->RowAttrs = array_merge($tbl_history_pick->RowAttrs, array('data-rowindex'=>$tbl_history_pick_grid->RowCnt, 'id'=>'r' . $tbl_history_pick_grid->RowCnt . '_tbl_history_pick', 'data-rowtype'=>$tbl_history_pick->RowType));

		// Render row
		$tbl_history_pick_grid->renderRow();

		// Render list options
		$tbl_history_pick_grid->renderListOptions();

		// Skip delete row / empty row for confirm page
		if ($tbl_history_pick_grid->RowAction <> "delete" && $tbl_history_pick_grid->RowAction <> "insertdelete" && !($tbl_history_pick_grid->RowAction == "insert" && $tbl_history_pick->isConfirm() && $tbl_history_pick_grid->emptyRow())) {
?>
	<tr<?php echo $tbl_history_pick->rowAttributes() ?>>
<?php

// Render list options (body, left)
$tbl_history_pick_grid->ListOptions->render("body", "left", $tbl_history_pick_grid->RowCnt);
?>
	<?php if ($tbl_history_pick->PalletID->Visible) { // PalletID ?>
		<td data-name="PalletID"<?php echo $tbl_history_pick->PalletID->cellAttributes() ?>>
<?php if ($tbl_history_pick->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $tbl_history_pick_grid->RowCnt ?>_tbl_history_pick_PalletID" class="form-group tbl_history_pick_PalletID">
<input type="text" data-table="tbl_history_pick" data-field="x_PalletID" name="x<?php echo $tbl_history_pick_grid->RowIndex ?>_PalletID" id="x<?php echo $tbl_history_pick_grid->RowIndex ?>_PalletID" size="30" maxlength="50" placeholder="<?php echo HtmlEncode($tbl_history_pick->PalletID->getPlaceHolder()) ?>" value="<?php echo $tbl_history_pick->PalletID->EditValue ?>"<?php echo $tbl_history_pick->PalletID->editAttributes() ?>>
</span>
<input type="hidden" data-table="tbl_history_pick" data-field="x_PalletID" name="o<?php echo $tbl_history_pick_grid->RowIndex ?>_PalletID" id="o<?php echo $tbl_history_pick_grid->RowIndex ?>_PalletID" value="<?php echo HtmlEncode($tbl_history_pick->PalletID->OldValue) ?>">
<?php } ?>
<?php if ($tbl_history_pick->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $tbl_history_pick_grid->RowCnt ?>_tbl_history_pick_PalletID" class="form-group tbl_history_pick_PalletID">
<input type="text" data-table="tbl_history_pick" data-field="x_PalletID" name="x<?php echo $tbl_history_pick_grid->RowIndex ?>_PalletID" id="x<?php echo $tbl_history_pick_grid->RowIndex ?>_PalletID" size="30" maxlength="50" placeholder="<?php echo HtmlEncode($tbl_history_pick->PalletID->getPlaceHolder()) ?>" value="<?php echo $tbl_history_pick->PalletID->EditValue ?>"<?php echo $tbl_history_pick->PalletID->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($tbl_history_pick->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $tbl_history_pick_grid->RowCnt ?>_tbl_history_pick_PalletID" class="tbl_history_pick_PalletID">
<span<?php echo $tbl_history_pick->PalletID->viewAttributes() ?>>
<?php echo $tbl_history_pick->PalletID->getViewValue() ?></span>
</span>
<?php if (!$tbl_history_pick->isConfirm()) { ?>
<input type="hidden" data-table="tbl_history_pick" data-field="x_PalletID" name="x<?php echo $tbl_history_pick_grid->RowIndex ?>_PalletID" id="x<?php echo $tbl_history_pick_grid->RowIndex ?>_PalletID" value="<?php echo HtmlEncode($tbl_history_pick->PalletID->FormValue) ?>">
<input type="hidden" data-table="tbl_history_pick" data-field="x_PalletID" name="o<?php echo $tbl_history_pick_grid->RowIndex ?>_PalletID" id="o<?php echo $tbl_history_pick_grid->RowIndex ?>_PalletID" value="<?php echo HtmlEncode($tbl_history_pick->PalletID->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="tbl_history_pick" data-field="x_PalletID" name="ftbl_history_pickgrid$x<?php echo $tbl_history_pick_grid->RowIndex ?>_PalletID" id="ftbl_history_pickgrid$x<?php echo $tbl_history_pick_grid->RowIndex ?>_PalletID" value="<?php echo HtmlEncode($tbl_history_pick->PalletID->FormValue) ?>">
<input type="hidden" data-table="tbl_history_pick" data-field="x_PalletID" name="ftbl_history_pickgrid$o<?php echo $tbl_history_pick_grid->RowIndex ?>_PalletID" id="ftbl_history_pickgrid$o<?php echo $tbl_history_pick_grid->RowIndex ?>_PalletID" value="<?php echo HtmlEncode($tbl_history_pick->PalletID->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
<?php if ($tbl_history_pick->RowType == ROWTYPE_ADD) { // Add record ?>
<input type="hidden" data-table="tbl_history_pick" data-field="x_ID_His" name="x<?php echo $tbl_history_pick_grid->RowIndex ?>_ID_His" id="x<?php echo $tbl_history_pick_grid->RowIndex ?>_ID_His" value="<?php echo HtmlEncode($tbl_history_pick->ID_His->CurrentValue) ?>">
<input type="hidden" data-table="tbl_history_pick" data-field="x_ID_His" name="o<?php echo $tbl_history_pick_grid->RowIndex ?>_ID_His" id="o<?php echo $tbl_history_pick_grid->RowIndex ?>_ID_His" value="<?php echo HtmlEncode($tbl_history_pick->ID_His->OldValue) ?>">
<?php } ?>
<?php if ($tbl_history_pick->RowType == ROWTYPE_EDIT || $tbl_history_pick->CurrentMode == "edit") { ?>
<input type="hidden" data-table="tbl_history_pick" data-field="x_ID_His" name="x<?php echo $tbl_history_pick_grid->RowIndex ?>_ID_His" id="x<?php echo $tbl_history_pick_grid->RowIndex ?>_ID_His" value="<?php echo HtmlEncode($tbl_history_pick->ID_His->CurrentValue) ?>">
<?php } ?>
	<?php if ($tbl_history_pick->Code->Visible) { // Code ?>
		<td data-name="Code"<?php echo $tbl_history_pick->Code->cellAttributes() ?>>
<?php if ($tbl_history_pick->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $tbl_history_pick_grid->RowCnt ?>_tbl_history_pick_Code" class="form-group tbl_history_pick_Code">
<input type="text" data-table="tbl_history_pick" data-field="x_Code" name="x<?php echo $tbl_history_pick_grid->RowIndex ?>_Code" id="x<?php echo $tbl_history_pick_grid->RowIndex ?>_Code" size="30" maxlength="50" placeholder="<?php echo HtmlEncode($tbl_history_pick->Code->getPlaceHolder()) ?>" value="<?php echo $tbl_history_pick->Code->EditValue ?>"<?php echo $tbl_history_pick->Code->editAttributes() ?>>
</span>
<input type="hidden" data-table="tbl_history_pick" data-field="x_Code" name="o<?php echo $tbl_history_pick_grid->RowIndex ?>_Code" id="o<?php echo $tbl_history_pick_grid->RowIndex ?>_Code" value="<?php echo HtmlEncode($tbl_history_pick->Code->OldValue) ?>">
<?php } ?>
<?php if ($tbl_history_pick->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $tbl_history_pick_grid->RowCnt ?>_tbl_history_pick_Code" class="form-group tbl_history_pick_Code">
<input type="text" data-table="tbl_history_pick" data-field="x_Code" name="x<?php echo $tbl_history_pick_grid->RowIndex ?>_Code" id="x<?php echo $tbl_history_pick_grid->RowIndex ?>_Code" size="30" maxlength="50" placeholder="<?php echo HtmlEncode($tbl_history_pick->Code->getPlaceHolder()) ?>" value="<?php echo $tbl_history_pick->Code->EditValue ?>"<?php echo $tbl_history_pick->Code->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($tbl_history_pick->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $tbl_history_pick_grid->RowCnt ?>_tbl_history_pick_Code" class="tbl_history_pick_Code">
<span<?php echo $tbl_history_pick->Code->viewAttributes() ?>>
<?php echo $tbl_history_pick->Code->getViewValue() ?></span>
</span>
<?php if (!$tbl_history_pick->isConfirm()) { ?>
<input type="hidden" data-table="tbl_history_pick" data-field="x_Code" name="x<?php echo $tbl_history_pick_grid->RowIndex ?>_Code" id="x<?php echo $tbl_history_pick_grid->RowIndex ?>_Code" value="<?php echo HtmlEncode($tbl_history_pick->Code->FormValue) ?>">
<input type="hidden" data-table="tbl_history_pick" data-field="x_Code" name="o<?php echo $tbl_history_pick_grid->RowIndex ?>_Code" id="o<?php echo $tbl_history_pick_grid->RowIndex ?>_Code" value="<?php echo HtmlEncode($tbl_history_pick->Code->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="tbl_history_pick" data-field="x_Code" name="ftbl_history_pickgrid$x<?php echo $tbl_history_pick_grid->RowIndex ?>_Code" id="ftbl_history_pickgrid$x<?php echo $tbl_history_pick_grid->RowIndex ?>_Code" value="<?php echo HtmlEncode($tbl_history_pick->Code->FormValue) ?>">
<input type="hidden" data-table="tbl_history_pick" data-field="x_Code" name="ftbl_history_pickgrid$o<?php echo $tbl_history_pick_grid->RowIndex ?>_Code" id="ftbl_history_pickgrid$o<?php echo $tbl_history_pick_grid->RowIndex ?>_Code" value="<?php echo HtmlEncode($tbl_history_pick->Code->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($tbl_history_pick->ID_Location->Visible) { // ID_Location ?>
		<td data-name="ID_Location"<?php echo $tbl_history_pick->ID_Location->cellAttributes() ?>>
<?php if ($tbl_history_pick->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $tbl_history_pick_grid->RowCnt ?>_tbl_history_pick_ID_Location" class="form-group tbl_history_pick_ID_Location">
<?php
$wrkonchange = "" . trim(@$tbl_history_pick->ID_Location->EditAttrs["onchange"]);
if (trim($wrkonchange) <> "") $wrkonchange = " onchange=\"" . JsEncode($wrkonchange) . "\"";
$tbl_history_pick->ID_Location->EditAttrs["onchange"] = "";
?>
<span id="as_x<?php echo $tbl_history_pick_grid->RowIndex ?>_ID_Location" class="text-nowrap" style="z-index: <?php echo (9000 - $tbl_history_pick_grid->RowCnt * 10) ?>">
	<input type="text" class="form-control" name="sv_x<?php echo $tbl_history_pick_grid->RowIndex ?>_ID_Location" id="sv_x<?php echo $tbl_history_pick_grid->RowIndex ?>_ID_Location" value="<?php echo RemoveHtml($tbl_history_pick->ID_Location->EditValue) ?>" size="30" placeholder="<?php echo HtmlEncode($tbl_history_pick->ID_Location->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($tbl_history_pick->ID_Location->getPlaceHolder()) ?>"<?php echo $tbl_history_pick->ID_Location->editAttributes() ?>>
</span>
<input type="hidden" data-table="tbl_history_pick" data-field="x_ID_Location" data-value-separator="<?php echo $tbl_history_pick->ID_Location->displayValueSeparatorAttribute() ?>" name="x<?php echo $tbl_history_pick_grid->RowIndex ?>_ID_Location" id="x<?php echo $tbl_history_pick_grid->RowIndex ?>_ID_Location" value="<?php echo HtmlEncode($tbl_history_pick->ID_Location->CurrentValue) ?>"<?php echo $wrkonchange ?>>
<script>
ftbl_history_pickgrid.createAutoSuggest({"id":"x<?php echo $tbl_history_pick_grid->RowIndex ?>_ID_Location","forceSelect":false});
</script>
<?php echo $tbl_history_pick->ID_Location->Lookup->getParamTag("p_x" . $tbl_history_pick_grid->RowIndex . "_ID_Location") ?>
</span>
<input type="hidden" data-table="tbl_history_pick" data-field="x_ID_Location" name="o<?php echo $tbl_history_pick_grid->RowIndex ?>_ID_Location" id="o<?php echo $tbl_history_pick_grid->RowIndex ?>_ID_Location" value="<?php echo HtmlEncode($tbl_history_pick->ID_Location->OldValue) ?>">
<?php } ?>
<?php if ($tbl_history_pick->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $tbl_history_pick_grid->RowCnt ?>_tbl_history_pick_ID_Location" class="form-group tbl_history_pick_ID_Location">
<?php
$wrkonchange = "" . trim(@$tbl_history_pick->ID_Location->EditAttrs["onchange"]);
if (trim($wrkonchange) <> "") $wrkonchange = " onchange=\"" . JsEncode($wrkonchange) . "\"";
$tbl_history_pick->ID_Location->EditAttrs["onchange"] = "";
?>
<span id="as_x<?php echo $tbl_history_pick_grid->RowIndex ?>_ID_Location" class="text-nowrap" style="z-index: <?php echo (9000 - $tbl_history_pick_grid->RowCnt * 10) ?>">
	<input type="text" class="form-control" name="sv_x<?php echo $tbl_history_pick_grid->RowIndex ?>_ID_Location" id="sv_x<?php echo $tbl_history_pick_grid->RowIndex ?>_ID_Location" value="<?php echo RemoveHtml($tbl_history_pick->ID_Location->EditValue) ?>" size="30" placeholder="<?php echo HtmlEncode($tbl_history_pick->ID_Location->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($tbl_history_pick->ID_Location->getPlaceHolder()) ?>"<?php echo $tbl_history_pick->ID_Location->editAttributes() ?>>
</span>
<input type="hidden" data-table="tbl_history_pick" data-field="x_ID_Location" data-value-separator="<?php echo $tbl_history_pick->ID_Location->displayValueSeparatorAttribute() ?>" name="x<?php echo $tbl_history_pick_grid->RowIndex ?>_ID_Location" id="x<?php echo $tbl_history_pick_grid->RowIndex ?>_ID_Location" value="<?php echo HtmlEncode($tbl_history_pick->ID_Location->CurrentValue) ?>"<?php echo $wrkonchange ?>>
<script>
ftbl_history_pickgrid.createAutoSuggest({"id":"x<?php echo $tbl_history_pick_grid->RowIndex ?>_ID_Location","forceSelect":false});
</script>
<?php echo $tbl_history_pick->ID_Location->Lookup->getParamTag("p_x" . $tbl_history_pick_grid->RowIndex . "_ID_Location") ?>
</span>
<?php } ?>
<?php if ($tbl_history_pick->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $tbl_history_pick_grid->RowCnt ?>_tbl_history_pick_ID_Location" class="tbl_history_pick_ID_Location">
<span<?php echo $tbl_history_pick->ID_Location->viewAttributes() ?>>
<?php echo $tbl_history_pick->ID_Location->getViewValue() ?></span>
</span>
<?php if (!$tbl_history_pick->isConfirm()) { ?>
<input type="hidden" data-table="tbl_history_pick" data-field="x_ID_Location" name="x<?php echo $tbl_history_pick_grid->RowIndex ?>_ID_Location" id="x<?php echo $tbl_history_pick_grid->RowIndex ?>_ID_Location" value="<?php echo HtmlEncode($tbl_history_pick->ID_Location->FormValue) ?>">
<input type="hidden" data-table="tbl_history_pick" data-field="x_ID_Location" name="o<?php echo $tbl_history_pick_grid->RowIndex ?>_ID_Location" id="o<?php echo $tbl_history_pick_grid->RowIndex ?>_ID_Location" value="<?php echo HtmlEncode($tbl_history_pick->ID_Location->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="tbl_history_pick" data-field="x_ID_Location" name="ftbl_history_pickgrid$x<?php echo $tbl_history_pick_grid->RowIndex ?>_ID_Location" id="ftbl_history_pickgrid$x<?php echo $tbl_history_pick_grid->RowIndex ?>_ID_Location" value="<?php echo HtmlEncode($tbl_history_pick->ID_Location->FormValue) ?>">
<input type="hidden" data-table="tbl_history_pick" data-field="x_ID_Location" name="ftbl_history_pickgrid$o<?php echo $tbl_history_pick_grid->RowIndex ?>_ID_Location" id="ftbl_history_pickgrid$o<?php echo $tbl_history_pick_grid->RowIndex ?>_ID_Location" value="<?php echo HtmlEncode($tbl_history_pick->ID_Location->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($tbl_history_pick->PCS->Visible) { // PCS ?>
		<td data-name="PCS"<?php echo $tbl_history_pick->PCS->cellAttributes() ?>>
<?php if ($tbl_history_pick->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $tbl_history_pick_grid->RowCnt ?>_tbl_history_pick_PCS" class="form-group tbl_history_pick_PCS">
<input type="text" data-table="tbl_history_pick" data-field="x_PCS" name="x<?php echo $tbl_history_pick_grid->RowIndex ?>_PCS" id="x<?php echo $tbl_history_pick_grid->RowIndex ?>_PCS" size="30" placeholder="<?php echo HtmlEncode($tbl_history_pick->PCS->getPlaceHolder()) ?>" value="<?php echo $tbl_history_pick->PCS->EditValue ?>"<?php echo $tbl_history_pick->PCS->editAttributes() ?>>
</span>
<input type="hidden" data-table="tbl_history_pick" data-field="x_PCS" name="o<?php echo $tbl_history_pick_grid->RowIndex ?>_PCS" id="o<?php echo $tbl_history_pick_grid->RowIndex ?>_PCS" value="<?php echo HtmlEncode($tbl_history_pick->PCS->OldValue) ?>">
<?php } ?>
<?php if ($tbl_history_pick->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $tbl_history_pick_grid->RowCnt ?>_tbl_history_pick_PCS" class="form-group tbl_history_pick_PCS">
<input type="text" data-table="tbl_history_pick" data-field="x_PCS" name="x<?php echo $tbl_history_pick_grid->RowIndex ?>_PCS" id="x<?php echo $tbl_history_pick_grid->RowIndex ?>_PCS" size="30" placeholder="<?php echo HtmlEncode($tbl_history_pick->PCS->getPlaceHolder()) ?>" value="<?php echo $tbl_history_pick->PCS->EditValue ?>"<?php echo $tbl_history_pick->PCS->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($tbl_history_pick->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $tbl_history_pick_grid->RowCnt ?>_tbl_history_pick_PCS" class="tbl_history_pick_PCS">
<span<?php echo $tbl_history_pick->PCS->viewAttributes() ?>>
<?php echo $tbl_history_pick->PCS->getViewValue() ?></span>
</span>
<?php if (!$tbl_history_pick->isConfirm()) { ?>
<input type="hidden" data-table="tbl_history_pick" data-field="x_PCS" name="x<?php echo $tbl_history_pick_grid->RowIndex ?>_PCS" id="x<?php echo $tbl_history_pick_grid->RowIndex ?>_PCS" value="<?php echo HtmlEncode($tbl_history_pick->PCS->FormValue) ?>">
<input type="hidden" data-table="tbl_history_pick" data-field="x_PCS" name="o<?php echo $tbl_history_pick_grid->RowIndex ?>_PCS" id="o<?php echo $tbl_history_pick_grid->RowIndex ?>_PCS" value="<?php echo HtmlEncode($tbl_history_pick->PCS->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="tbl_history_pick" data-field="x_PCS" name="ftbl_history_pickgrid$x<?php echo $tbl_history_pick_grid->RowIndex ?>_PCS" id="ftbl_history_pickgrid$x<?php echo $tbl_history_pick_grid->RowIndex ?>_PCS" value="<?php echo HtmlEncode($tbl_history_pick->PCS->FormValue) ?>">
<input type="hidden" data-table="tbl_history_pick" data-field="x_PCS" name="ftbl_history_pickgrid$o<?php echo $tbl_history_pick_grid->RowIndex ?>_PCS" id="ftbl_history_pickgrid$o<?php echo $tbl_history_pick_grid->RowIndex ?>_PCS" value="<?php echo HtmlEncode($tbl_history_pick->PCS->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($tbl_history_pick->DateIn->Visible) { // DateIn ?>
		<td data-name="DateIn"<?php echo $tbl_history_pick->DateIn->cellAttributes() ?>>
<?php if ($tbl_history_pick->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $tbl_history_pick_grid->RowCnt ?>_tbl_history_pick_DateIn" class="form-group tbl_history_pick_DateIn">
<input type="text" data-table="tbl_history_pick" data-field="x_DateIn" data-format="7" name="x<?php echo $tbl_history_pick_grid->RowIndex ?>_DateIn" id="x<?php echo $tbl_history_pick_grid->RowIndex ?>_DateIn" placeholder="<?php echo HtmlEncode($tbl_history_pick->DateIn->getPlaceHolder()) ?>" value="<?php echo $tbl_history_pick->DateIn->EditValue ?>"<?php echo $tbl_history_pick->DateIn->editAttributes() ?>>
<?php if (!$tbl_history_pick->DateIn->ReadOnly && !$tbl_history_pick->DateIn->Disabled && !isset($tbl_history_pick->DateIn->EditAttrs["readonly"]) && !isset($tbl_history_pick->DateIn->EditAttrs["disabled"])) { ?>
<script>
ew.createDateTimePicker("ftbl_history_pickgrid", "x<?php echo $tbl_history_pick_grid->RowIndex ?>_DateIn", {"ignoreReadonly":true,"useCurrent":false,"format":7});
</script>
<?php } ?>
</span>
<input type="hidden" data-table="tbl_history_pick" data-field="x_DateIn" name="o<?php echo $tbl_history_pick_grid->RowIndex ?>_DateIn" id="o<?php echo $tbl_history_pick_grid->RowIndex ?>_DateIn" value="<?php echo HtmlEncode($tbl_history_pick->DateIn->OldValue) ?>">
<?php } ?>
<?php if ($tbl_history_pick->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $tbl_history_pick_grid->RowCnt ?>_tbl_history_pick_DateIn" class="form-group tbl_history_pick_DateIn">
<input type="text" data-table="tbl_history_pick" data-field="x_DateIn" data-format="7" name="x<?php echo $tbl_history_pick_grid->RowIndex ?>_DateIn" id="x<?php echo $tbl_history_pick_grid->RowIndex ?>_DateIn" placeholder="<?php echo HtmlEncode($tbl_history_pick->DateIn->getPlaceHolder()) ?>" value="<?php echo $tbl_history_pick->DateIn->EditValue ?>"<?php echo $tbl_history_pick->DateIn->editAttributes() ?>>
<?php if (!$tbl_history_pick->DateIn->ReadOnly && !$tbl_history_pick->DateIn->Disabled && !isset($tbl_history_pick->DateIn->EditAttrs["readonly"]) && !isset($tbl_history_pick->DateIn->EditAttrs["disabled"])) { ?>
<script>
ew.createDateTimePicker("ftbl_history_pickgrid", "x<?php echo $tbl_history_pick_grid->RowIndex ?>_DateIn", {"ignoreReadonly":true,"useCurrent":false,"format":7});
</script>
<?php } ?>
</span>
<?php } ?>
<?php if ($tbl_history_pick->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $tbl_history_pick_grid->RowCnt ?>_tbl_history_pick_DateIn" class="tbl_history_pick_DateIn">
<span<?php echo $tbl_history_pick->DateIn->viewAttributes() ?>>
<?php echo $tbl_history_pick->DateIn->getViewValue() ?></span>
</span>
<?php if (!$tbl_history_pick->isConfirm()) { ?>
<input type="hidden" data-table="tbl_history_pick" data-field="x_DateIn" name="x<?php echo $tbl_history_pick_grid->RowIndex ?>_DateIn" id="x<?php echo $tbl_history_pick_grid->RowIndex ?>_DateIn" value="<?php echo HtmlEncode($tbl_history_pick->DateIn->FormValue) ?>">
<input type="hidden" data-table="tbl_history_pick" data-field="x_DateIn" name="o<?php echo $tbl_history_pick_grid->RowIndex ?>_DateIn" id="o<?php echo $tbl_history_pick_grid->RowIndex ?>_DateIn" value="<?php echo HtmlEncode($tbl_history_pick->DateIn->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="tbl_history_pick" data-field="x_DateIn" name="ftbl_history_pickgrid$x<?php echo $tbl_history_pick_grid->RowIndex ?>_DateIn" id="ftbl_history_pickgrid$x<?php echo $tbl_history_pick_grid->RowIndex ?>_DateIn" value="<?php echo HtmlEncode($tbl_history_pick->DateIn->FormValue) ?>">
<input type="hidden" data-table="tbl_history_pick" data-field="x_DateIn" name="ftbl_history_pickgrid$o<?php echo $tbl_history_pick_grid->RowIndex ?>_DateIn" id="ftbl_history_pickgrid$o<?php echo $tbl_history_pick_grid->RowIndex ?>_DateIn" value="<?php echo HtmlEncode($tbl_history_pick->DateIn->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($tbl_history_pick->User_ID->Visible) { // User_ID ?>
		<td data-name="User_ID"<?php echo $tbl_history_pick->User_ID->cellAttributes() ?>>
<?php if ($tbl_history_pick->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $tbl_history_pick_grid->RowCnt ?>_tbl_history_pick_User_ID" class="form-group tbl_history_pick_User_ID">
<input type="text" data-table="tbl_history_pick" data-field="x_User_ID" name="x<?php echo $tbl_history_pick_grid->RowIndex ?>_User_ID" id="x<?php echo $tbl_history_pick_grid->RowIndex ?>_User_ID" size="30" maxlength="25" placeholder="<?php echo HtmlEncode($tbl_history_pick->User_ID->getPlaceHolder()) ?>" value="<?php echo $tbl_history_pick->User_ID->EditValue ?>"<?php echo $tbl_history_pick->User_ID->editAttributes() ?>>
</span>
<input type="hidden" data-table="tbl_history_pick" data-field="x_User_ID" name="o<?php echo $tbl_history_pick_grid->RowIndex ?>_User_ID" id="o<?php echo $tbl_history_pick_grid->RowIndex ?>_User_ID" value="<?php echo HtmlEncode($tbl_history_pick->User_ID->OldValue) ?>">
<?php } ?>
<?php if ($tbl_history_pick->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $tbl_history_pick_grid->RowCnt ?>_tbl_history_pick_User_ID" class="form-group tbl_history_pick_User_ID">
<input type="text" data-table="tbl_history_pick" data-field="x_User_ID" name="x<?php echo $tbl_history_pick_grid->RowIndex ?>_User_ID" id="x<?php echo $tbl_history_pick_grid->RowIndex ?>_User_ID" size="30" maxlength="25" placeholder="<?php echo HtmlEncode($tbl_history_pick->User_ID->getPlaceHolder()) ?>" value="<?php echo $tbl_history_pick->User_ID->EditValue ?>"<?php echo $tbl_history_pick->User_ID->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($tbl_history_pick->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $tbl_history_pick_grid->RowCnt ?>_tbl_history_pick_User_ID" class="tbl_history_pick_User_ID">
<span<?php echo $tbl_history_pick->User_ID->viewAttributes() ?>>
<?php echo $tbl_history_pick->User_ID->getViewValue() ?></span>
</span>
<?php if (!$tbl_history_pick->isConfirm()) { ?>
<input type="hidden" data-table="tbl_history_pick" data-field="x_User_ID" name="x<?php echo $tbl_history_pick_grid->RowIndex ?>_User_ID" id="x<?php echo $tbl_history_pick_grid->RowIndex ?>_User_ID" value="<?php echo HtmlEncode($tbl_history_pick->User_ID->FormValue) ?>">
<input type="hidden" data-table="tbl_history_pick" data-field="x_User_ID" name="o<?php echo $tbl_history_pick_grid->RowIndex ?>_User_ID" id="o<?php echo $tbl_history_pick_grid->RowIndex ?>_User_ID" value="<?php echo HtmlEncode($tbl_history_pick->User_ID->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="tbl_history_pick" data-field="x_User_ID" name="ftbl_history_pickgrid$x<?php echo $tbl_history_pick_grid->RowIndex ?>_User_ID" id="ftbl_history_pickgrid$x<?php echo $tbl_history_pick_grid->RowIndex ?>_User_ID" value="<?php echo HtmlEncode($tbl_history_pick->User_ID->FormValue) ?>">
<input type="hidden" data-table="tbl_history_pick" data-field="x_User_ID" name="ftbl_history_pickgrid$o<?php echo $tbl_history_pick_grid->RowIndex ?>_User_ID" id="ftbl_history_pickgrid$o<?php echo $tbl_history_pick_grid->RowIndex ?>_User_ID" value="<?php echo HtmlEncode($tbl_history_pick->User_ID->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($tbl_history_pick->PalletStatus->Visible) { // PalletStatus ?>
		<td data-name="PalletStatus"<?php echo $tbl_history_pick->PalletStatus->cellAttributes() ?>>
<?php if ($tbl_history_pick->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $tbl_history_pick_grid->RowCnt ?>_tbl_history_pick_PalletStatus" class="form-group tbl_history_pick_PalletStatus">
<input type="text" data-table="tbl_history_pick" data-field="x_PalletStatus" name="x<?php echo $tbl_history_pick_grid->RowIndex ?>_PalletStatus" id="x<?php echo $tbl_history_pick_grid->RowIndex ?>_PalletStatus" size="30" maxlength="25" placeholder="<?php echo HtmlEncode($tbl_history_pick->PalletStatus->getPlaceHolder()) ?>" value="<?php echo $tbl_history_pick->PalletStatus->EditValue ?>"<?php echo $tbl_history_pick->PalletStatus->editAttributes() ?>>
</span>
<input type="hidden" data-table="tbl_history_pick" data-field="x_PalletStatus" name="o<?php echo $tbl_history_pick_grid->RowIndex ?>_PalletStatus" id="o<?php echo $tbl_history_pick_grid->RowIndex ?>_PalletStatus" value="<?php echo HtmlEncode($tbl_history_pick->PalletStatus->OldValue) ?>">
<?php } ?>
<?php if ($tbl_history_pick->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $tbl_history_pick_grid->RowCnt ?>_tbl_history_pick_PalletStatus" class="form-group tbl_history_pick_PalletStatus">
<input type="text" data-table="tbl_history_pick" data-field="x_PalletStatus" name="x<?php echo $tbl_history_pick_grid->RowIndex ?>_PalletStatus" id="x<?php echo $tbl_history_pick_grid->RowIndex ?>_PalletStatus" size="30" maxlength="25" placeholder="<?php echo HtmlEncode($tbl_history_pick->PalletStatus->getPlaceHolder()) ?>" value="<?php echo $tbl_history_pick->PalletStatus->EditValue ?>"<?php echo $tbl_history_pick->PalletStatus->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($tbl_history_pick->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $tbl_history_pick_grid->RowCnt ?>_tbl_history_pick_PalletStatus" class="tbl_history_pick_PalletStatus">
<span<?php echo $tbl_history_pick->PalletStatus->viewAttributes() ?>>
<?php echo $tbl_history_pick->PalletStatus->getViewValue() ?></span>
</span>
<?php if (!$tbl_history_pick->isConfirm()) { ?>
<input type="hidden" data-table="tbl_history_pick" data-field="x_PalletStatus" name="x<?php echo $tbl_history_pick_grid->RowIndex ?>_PalletStatus" id="x<?php echo $tbl_history_pick_grid->RowIndex ?>_PalletStatus" value="<?php echo HtmlEncode($tbl_history_pick->PalletStatus->FormValue) ?>">
<input type="hidden" data-table="tbl_history_pick" data-field="x_PalletStatus" name="o<?php echo $tbl_history_pick_grid->RowIndex ?>_PalletStatus" id="o<?php echo $tbl_history_pick_grid->RowIndex ?>_PalletStatus" value="<?php echo HtmlEncode($tbl_history_pick->PalletStatus->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="tbl_history_pick" data-field="x_PalletStatus" name="ftbl_history_pickgrid$x<?php echo $tbl_history_pick_grid->RowIndex ?>_PalletStatus" id="ftbl_history_pickgrid$x<?php echo $tbl_history_pick_grid->RowIndex ?>_PalletStatus" value="<?php echo HtmlEncode($tbl_history_pick->PalletStatus->FormValue) ?>">
<input type="hidden" data-table="tbl_history_pick" data-field="x_PalletStatus" name="ftbl_history_pickgrid$o<?php echo $tbl_history_pick_grid->RowIndex ?>_PalletStatus" id="ftbl_history_pickgrid$o<?php echo $tbl_history_pick_grid->RowIndex ?>_PalletStatus" value="<?php echo HtmlEncode($tbl_history_pick->PalletStatus->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($tbl_history_pick->CreateUser->Visible) { // CreateUser ?>
		<td data-name="CreateUser"<?php echo $tbl_history_pick->CreateUser->cellAttributes() ?>>
<?php if ($tbl_history_pick->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $tbl_history_pick_grid->RowCnt ?>_tbl_history_pick_CreateUser" class="form-group tbl_history_pick_CreateUser">
<input type="text" data-table="tbl_history_pick" data-field="x_CreateUser" name="x<?php echo $tbl_history_pick_grid->RowIndex ?>_CreateUser" id="x<?php echo $tbl_history_pick_grid->RowIndex ?>_CreateUser" size="30" maxlength="50" placeholder="<?php echo HtmlEncode($tbl_history_pick->CreateUser->getPlaceHolder()) ?>" value="<?php echo $tbl_history_pick->CreateUser->EditValue ?>"<?php echo $tbl_history_pick->CreateUser->editAttributes() ?>>
</span>
<input type="hidden" data-table="tbl_history_pick" data-field="x_CreateUser" name="o<?php echo $tbl_history_pick_grid->RowIndex ?>_CreateUser" id="o<?php echo $tbl_history_pick_grid->RowIndex ?>_CreateUser" value="<?php echo HtmlEncode($tbl_history_pick->CreateUser->OldValue) ?>">
<?php } ?>
<?php if ($tbl_history_pick->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $tbl_history_pick_grid->RowCnt ?>_tbl_history_pick_CreateUser" class="form-group tbl_history_pick_CreateUser">
<input type="text" data-table="tbl_history_pick" data-field="x_CreateUser" name="x<?php echo $tbl_history_pick_grid->RowIndex ?>_CreateUser" id="x<?php echo $tbl_history_pick_grid->RowIndex ?>_CreateUser" size="30" maxlength="50" placeholder="<?php echo HtmlEncode($tbl_history_pick->CreateUser->getPlaceHolder()) ?>" value="<?php echo $tbl_history_pick->CreateUser->EditValue ?>"<?php echo $tbl_history_pick->CreateUser->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($tbl_history_pick->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $tbl_history_pick_grid->RowCnt ?>_tbl_history_pick_CreateUser" class="tbl_history_pick_CreateUser">
<span<?php echo $tbl_history_pick->CreateUser->viewAttributes() ?>>
<?php echo $tbl_history_pick->CreateUser->getViewValue() ?></span>
</span>
<?php if (!$tbl_history_pick->isConfirm()) { ?>
<input type="hidden" data-table="tbl_history_pick" data-field="x_CreateUser" name="x<?php echo $tbl_history_pick_grid->RowIndex ?>_CreateUser" id="x<?php echo $tbl_history_pick_grid->RowIndex ?>_CreateUser" value="<?php echo HtmlEncode($tbl_history_pick->CreateUser->FormValue) ?>">
<input type="hidden" data-table="tbl_history_pick" data-field="x_CreateUser" name="o<?php echo $tbl_history_pick_grid->RowIndex ?>_CreateUser" id="o<?php echo $tbl_history_pick_grid->RowIndex ?>_CreateUser" value="<?php echo HtmlEncode($tbl_history_pick->CreateUser->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="tbl_history_pick" data-field="x_CreateUser" name="ftbl_history_pickgrid$x<?php echo $tbl_history_pick_grid->RowIndex ?>_CreateUser" id="ftbl_history_pickgrid$x<?php echo $tbl_history_pick_grid->RowIndex ?>_CreateUser" value="<?php echo HtmlEncode($tbl_history_pick->CreateUser->FormValue) ?>">
<input type="hidden" data-table="tbl_history_pick" data-field="x_CreateUser" name="ftbl_history_pickgrid$o<?php echo $tbl_history_pick_grid->RowIndex ?>_CreateUser" id="ftbl_history_pickgrid$o<?php echo $tbl_history_pick_grid->RowIndex ?>_CreateUser" value="<?php echo HtmlEncode($tbl_history_pick->CreateUser->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($tbl_history_pick->CreateDate->Visible) { // CreateDate ?>
		<td data-name="CreateDate"<?php echo $tbl_history_pick->CreateDate->cellAttributes() ?>>
<?php if ($tbl_history_pick->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $tbl_history_pick_grid->RowCnt ?>_tbl_history_pick_CreateDate" class="form-group tbl_history_pick_CreateDate">
<input type="text" data-table="tbl_history_pick" data-field="x_CreateDate" name="x<?php echo $tbl_history_pick_grid->RowIndex ?>_CreateDate" id="x<?php echo $tbl_history_pick_grid->RowIndex ?>_CreateDate" placeholder="<?php echo HtmlEncode($tbl_history_pick->CreateDate->getPlaceHolder()) ?>" value="<?php echo $tbl_history_pick->CreateDate->EditValue ?>"<?php echo $tbl_history_pick->CreateDate->editAttributes() ?>>
<?php if (!$tbl_history_pick->CreateDate->ReadOnly && !$tbl_history_pick->CreateDate->Disabled && !isset($tbl_history_pick->CreateDate->EditAttrs["readonly"]) && !isset($tbl_history_pick->CreateDate->EditAttrs["disabled"])) { ?>
<script>
ew.createDateTimePicker("ftbl_history_pickgrid", "x<?php echo $tbl_history_pick_grid->RowIndex ?>_CreateDate", {"ignoreReadonly":true,"useCurrent":false,"format":0});
</script>
<?php } ?>
</span>
<input type="hidden" data-table="tbl_history_pick" data-field="x_CreateDate" name="o<?php echo $tbl_history_pick_grid->RowIndex ?>_CreateDate" id="o<?php echo $tbl_history_pick_grid->RowIndex ?>_CreateDate" value="<?php echo HtmlEncode($tbl_history_pick->CreateDate->OldValue) ?>">
<?php } ?>
<?php if ($tbl_history_pick->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $tbl_history_pick_grid->RowCnt ?>_tbl_history_pick_CreateDate" class="form-group tbl_history_pick_CreateDate">
<input type="text" data-table="tbl_history_pick" data-field="x_CreateDate" name="x<?php echo $tbl_history_pick_grid->RowIndex ?>_CreateDate" id="x<?php echo $tbl_history_pick_grid->RowIndex ?>_CreateDate" placeholder="<?php echo HtmlEncode($tbl_history_pick->CreateDate->getPlaceHolder()) ?>" value="<?php echo $tbl_history_pick->CreateDate->EditValue ?>"<?php echo $tbl_history_pick->CreateDate->editAttributes() ?>>
<?php if (!$tbl_history_pick->CreateDate->ReadOnly && !$tbl_history_pick->CreateDate->Disabled && !isset($tbl_history_pick->CreateDate->EditAttrs["readonly"]) && !isset($tbl_history_pick->CreateDate->EditAttrs["disabled"])) { ?>
<script>
ew.createDateTimePicker("ftbl_history_pickgrid", "x<?php echo $tbl_history_pick_grid->RowIndex ?>_CreateDate", {"ignoreReadonly":true,"useCurrent":false,"format":0});
</script>
<?php } ?>
</span>
<?php } ?>
<?php if ($tbl_history_pick->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $tbl_history_pick_grid->RowCnt ?>_tbl_history_pick_CreateDate" class="tbl_history_pick_CreateDate">
<span<?php echo $tbl_history_pick->CreateDate->viewAttributes() ?>>
<?php echo $tbl_history_pick->CreateDate->getViewValue() ?></span>
</span>
<?php if (!$tbl_history_pick->isConfirm()) { ?>
<input type="hidden" data-table="tbl_history_pick" data-field="x_CreateDate" name="x<?php echo $tbl_history_pick_grid->RowIndex ?>_CreateDate" id="x<?php echo $tbl_history_pick_grid->RowIndex ?>_CreateDate" value="<?php echo HtmlEncode($tbl_history_pick->CreateDate->FormValue) ?>">
<input type="hidden" data-table="tbl_history_pick" data-field="x_CreateDate" name="o<?php echo $tbl_history_pick_grid->RowIndex ?>_CreateDate" id="o<?php echo $tbl_history_pick_grid->RowIndex ?>_CreateDate" value="<?php echo HtmlEncode($tbl_history_pick->CreateDate->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="tbl_history_pick" data-field="x_CreateDate" name="ftbl_history_pickgrid$x<?php echo $tbl_history_pick_grid->RowIndex ?>_CreateDate" id="ftbl_history_pickgrid$x<?php echo $tbl_history_pick_grid->RowIndex ?>_CreateDate" value="<?php echo HtmlEncode($tbl_history_pick->CreateDate->FormValue) ?>">
<input type="hidden" data-table="tbl_history_pick" data-field="x_CreateDate" name="ftbl_history_pickgrid$o<?php echo $tbl_history_pick_grid->RowIndex ?>_CreateDate" id="ftbl_history_pickgrid$o<?php echo $tbl_history_pick_grid->RowIndex ?>_CreateDate" value="<?php echo HtmlEncode($tbl_history_pick->CreateDate->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($tbl_history_pick->Box->Visible) { // Box ?>
		<td data-name="Box"<?php echo $tbl_history_pick->Box->cellAttributes() ?>>
<?php if ($tbl_history_pick->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $tbl_history_pick_grid->RowCnt ?>_tbl_history_pick_Box" class="form-group tbl_history_pick_Box">
<input type="text" data-table="tbl_history_pick" data-field="x_Box" name="x<?php echo $tbl_history_pick_grid->RowIndex ?>_Box" id="x<?php echo $tbl_history_pick_grid->RowIndex ?>_Box" size="30" placeholder="<?php echo HtmlEncode($tbl_history_pick->Box->getPlaceHolder()) ?>" value="<?php echo $tbl_history_pick->Box->EditValue ?>"<?php echo $tbl_history_pick->Box->editAttributes() ?>>
</span>
<input type="hidden" data-table="tbl_history_pick" data-field="x_Box" name="o<?php echo $tbl_history_pick_grid->RowIndex ?>_Box" id="o<?php echo $tbl_history_pick_grid->RowIndex ?>_Box" value="<?php echo HtmlEncode($tbl_history_pick->Box->OldValue) ?>">
<?php } ?>
<?php if ($tbl_history_pick->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $tbl_history_pick_grid->RowCnt ?>_tbl_history_pick_Box" class="form-group tbl_history_pick_Box">
<input type="text" data-table="tbl_history_pick" data-field="x_Box" name="x<?php echo $tbl_history_pick_grid->RowIndex ?>_Box" id="x<?php echo $tbl_history_pick_grid->RowIndex ?>_Box" size="30" placeholder="<?php echo HtmlEncode($tbl_history_pick->Box->getPlaceHolder()) ?>" value="<?php echo $tbl_history_pick->Box->EditValue ?>"<?php echo $tbl_history_pick->Box->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($tbl_history_pick->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $tbl_history_pick_grid->RowCnt ?>_tbl_history_pick_Box" class="tbl_history_pick_Box">
<span<?php echo $tbl_history_pick->Box->viewAttributes() ?>>
<?php echo $tbl_history_pick->Box->getViewValue() ?></span>
</span>
<?php if (!$tbl_history_pick->isConfirm()) { ?>
<input type="hidden" data-table="tbl_history_pick" data-field="x_Box" name="x<?php echo $tbl_history_pick_grid->RowIndex ?>_Box" id="x<?php echo $tbl_history_pick_grid->RowIndex ?>_Box" value="<?php echo HtmlEncode($tbl_history_pick->Box->FormValue) ?>">
<input type="hidden" data-table="tbl_history_pick" data-field="x_Box" name="o<?php echo $tbl_history_pick_grid->RowIndex ?>_Box" id="o<?php echo $tbl_history_pick_grid->RowIndex ?>_Box" value="<?php echo HtmlEncode($tbl_history_pick->Box->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="tbl_history_pick" data-field="x_Box" name="ftbl_history_pickgrid$x<?php echo $tbl_history_pick_grid->RowIndex ?>_Box" id="ftbl_history_pickgrid$x<?php echo $tbl_history_pick_grid->RowIndex ?>_Box" value="<?php echo HtmlEncode($tbl_history_pick->Box->FormValue) ?>">
<input type="hidden" data-table="tbl_history_pick" data-field="x_Box" name="ftbl_history_pickgrid$o<?php echo $tbl_history_pick_grid->RowIndex ?>_Box" id="ftbl_history_pickgrid$o<?php echo $tbl_history_pick_grid->RowIndex ?>_Box" value="<?php echo HtmlEncode($tbl_history_pick->Box->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$tbl_history_pick_grid->ListOptions->render("body", "right", $tbl_history_pick_grid->RowCnt);
?>
	</tr>
<?php if ($tbl_history_pick->RowType == ROWTYPE_ADD || $tbl_history_pick->RowType == ROWTYPE_EDIT) { ?>
<script>
ftbl_history_pickgrid.updateLists(<?php echo $tbl_history_pick_grid->RowIndex ?>);
</script>
<?php } ?>
<?php
	}
	} // End delete row checking
	if (!$tbl_history_pick->isGridAdd() || $tbl_history_pick->CurrentMode == "copy")
		if (!$tbl_history_pick_grid->Recordset->EOF)
			$tbl_history_pick_grid->Recordset->moveNext();
}
?>
<?php
	if ($tbl_history_pick->CurrentMode == "add" || $tbl_history_pick->CurrentMode == "copy" || $tbl_history_pick->CurrentMode == "edit") {
		$tbl_history_pick_grid->RowIndex = '$rowindex$';
		$tbl_history_pick_grid->loadRowValues();

		// Set row properties
		$tbl_history_pick->resetAttributes();
		$tbl_history_pick->RowAttrs = array_merge($tbl_history_pick->RowAttrs, array('data-rowindex'=>$tbl_history_pick_grid->RowIndex, 'id'=>'r0_tbl_history_pick', 'data-rowtype'=>ROWTYPE_ADD));
		AppendClass($tbl_history_pick->RowAttrs["class"], "ew-template");
		$tbl_history_pick->RowType = ROWTYPE_ADD;

		// Render row
		$tbl_history_pick_grid->renderRow();

		// Render list options
		$tbl_history_pick_grid->renderListOptions();
		$tbl_history_pick_grid->StartRowCnt = 0;
?>
	<tr<?php echo $tbl_history_pick->rowAttributes() ?>>
<?php

// Render list options (body, left)
$tbl_history_pick_grid->ListOptions->render("body", "left", $tbl_history_pick_grid->RowIndex);
?>
	<?php if ($tbl_history_pick->PalletID->Visible) { // PalletID ?>
		<td data-name="PalletID">
<?php if (!$tbl_history_pick->isConfirm()) { ?>
<span id="el$rowindex$_tbl_history_pick_PalletID" class="form-group tbl_history_pick_PalletID">
<input type="text" data-table="tbl_history_pick" data-field="x_PalletID" name="x<?php echo $tbl_history_pick_grid->RowIndex ?>_PalletID" id="x<?php echo $tbl_history_pick_grid->RowIndex ?>_PalletID" size="30" maxlength="50" placeholder="<?php echo HtmlEncode($tbl_history_pick->PalletID->getPlaceHolder()) ?>" value="<?php echo $tbl_history_pick->PalletID->EditValue ?>"<?php echo $tbl_history_pick->PalletID->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_tbl_history_pick_PalletID" class="form-group tbl_history_pick_PalletID">
<span<?php echo $tbl_history_pick->PalletID->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?php echo RemoveHtml($tbl_history_pick->PalletID->ViewValue) ?>"></span>
</span>
<input type="hidden" data-table="tbl_history_pick" data-field="x_PalletID" name="x<?php echo $tbl_history_pick_grid->RowIndex ?>_PalletID" id="x<?php echo $tbl_history_pick_grid->RowIndex ?>_PalletID" value="<?php echo HtmlEncode($tbl_history_pick->PalletID->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="tbl_history_pick" data-field="x_PalletID" name="o<?php echo $tbl_history_pick_grid->RowIndex ?>_PalletID" id="o<?php echo $tbl_history_pick_grid->RowIndex ?>_PalletID" value="<?php echo HtmlEncode($tbl_history_pick->PalletID->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($tbl_history_pick->Code->Visible) { // Code ?>
		<td data-name="Code">
<?php if (!$tbl_history_pick->isConfirm()) { ?>
<span id="el$rowindex$_tbl_history_pick_Code" class="form-group tbl_history_pick_Code">
<input type="text" data-table="tbl_history_pick" data-field="x_Code" name="x<?php echo $tbl_history_pick_grid->RowIndex ?>_Code" id="x<?php echo $tbl_history_pick_grid->RowIndex ?>_Code" size="30" maxlength="50" placeholder="<?php echo HtmlEncode($tbl_history_pick->Code->getPlaceHolder()) ?>" value="<?php echo $tbl_history_pick->Code->EditValue ?>"<?php echo $tbl_history_pick->Code->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_tbl_history_pick_Code" class="form-group tbl_history_pick_Code">
<span<?php echo $tbl_history_pick->Code->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?php echo RemoveHtml($tbl_history_pick->Code->ViewValue) ?>"></span>
</span>
<input type="hidden" data-table="tbl_history_pick" data-field="x_Code" name="x<?php echo $tbl_history_pick_grid->RowIndex ?>_Code" id="x<?php echo $tbl_history_pick_grid->RowIndex ?>_Code" value="<?php echo HtmlEncode($tbl_history_pick->Code->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="tbl_history_pick" data-field="x_Code" name="o<?php echo $tbl_history_pick_grid->RowIndex ?>_Code" id="o<?php echo $tbl_history_pick_grid->RowIndex ?>_Code" value="<?php echo HtmlEncode($tbl_history_pick->Code->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($tbl_history_pick->ID_Location->Visible) { // ID_Location ?>
		<td data-name="ID_Location">
<?php if (!$tbl_history_pick->isConfirm()) { ?>
<span id="el$rowindex$_tbl_history_pick_ID_Location" class="form-group tbl_history_pick_ID_Location">
<?php
$wrkonchange = "" . trim(@$tbl_history_pick->ID_Location->EditAttrs["onchange"]);
if (trim($wrkonchange) <> "") $wrkonchange = " onchange=\"" . JsEncode($wrkonchange) . "\"";
$tbl_history_pick->ID_Location->EditAttrs["onchange"] = "";
?>
<span id="as_x<?php echo $tbl_history_pick_grid->RowIndex ?>_ID_Location" class="text-nowrap" style="z-index: <?php echo (9000 - $tbl_history_pick_grid->RowCnt * 10) ?>">
	<input type="text" class="form-control" name="sv_x<?php echo $tbl_history_pick_grid->RowIndex ?>_ID_Location" id="sv_x<?php echo $tbl_history_pick_grid->RowIndex ?>_ID_Location" value="<?php echo RemoveHtml($tbl_history_pick->ID_Location->EditValue) ?>" size="30" placeholder="<?php echo HtmlEncode($tbl_history_pick->ID_Location->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($tbl_history_pick->ID_Location->getPlaceHolder()) ?>"<?php echo $tbl_history_pick->ID_Location->editAttributes() ?>>
</span>
<input type="hidden" data-table="tbl_history_pick" data-field="x_ID_Location" data-value-separator="<?php echo $tbl_history_pick->ID_Location->displayValueSeparatorAttribute() ?>" name="x<?php echo $tbl_history_pick_grid->RowIndex ?>_ID_Location" id="x<?php echo $tbl_history_pick_grid->RowIndex ?>_ID_Location" value="<?php echo HtmlEncode($tbl_history_pick->ID_Location->CurrentValue) ?>"<?php echo $wrkonchange ?>>
<script>
ftbl_history_pickgrid.createAutoSuggest({"id":"x<?php echo $tbl_history_pick_grid->RowIndex ?>_ID_Location","forceSelect":false});
</script>
<?php echo $tbl_history_pick->ID_Location->Lookup->getParamTag("p_x" . $tbl_history_pick_grid->RowIndex . "_ID_Location") ?>
</span>
<?php } else { ?>
<span id="el$rowindex$_tbl_history_pick_ID_Location" class="form-group tbl_history_pick_ID_Location">
<span<?php echo $tbl_history_pick->ID_Location->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?php echo RemoveHtml($tbl_history_pick->ID_Location->ViewValue) ?>"></span>
</span>
<input type="hidden" data-table="tbl_history_pick" data-field="x_ID_Location" name="x<?php echo $tbl_history_pick_grid->RowIndex ?>_ID_Location" id="x<?php echo $tbl_history_pick_grid->RowIndex ?>_ID_Location" value="<?php echo HtmlEncode($tbl_history_pick->ID_Location->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="tbl_history_pick" data-field="x_ID_Location" name="o<?php echo $tbl_history_pick_grid->RowIndex ?>_ID_Location" id="o<?php echo $tbl_history_pick_grid->RowIndex ?>_ID_Location" value="<?php echo HtmlEncode($tbl_history_pick->ID_Location->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($tbl_history_pick->PCS->Visible) { // PCS ?>
		<td data-name="PCS">
<?php if (!$tbl_history_pick->isConfirm()) { ?>
<span id="el$rowindex$_tbl_history_pick_PCS" class="form-group tbl_history_pick_PCS">
<input type="text" data-table="tbl_history_pick" data-field="x_PCS" name="x<?php echo $tbl_history_pick_grid->RowIndex ?>_PCS" id="x<?php echo $tbl_history_pick_grid->RowIndex ?>_PCS" size="30" placeholder="<?php echo HtmlEncode($tbl_history_pick->PCS->getPlaceHolder()) ?>" value="<?php echo $tbl_history_pick->PCS->EditValue ?>"<?php echo $tbl_history_pick->PCS->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_tbl_history_pick_PCS" class="form-group tbl_history_pick_PCS">
<span<?php echo $tbl_history_pick->PCS->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?php echo RemoveHtml($tbl_history_pick->PCS->ViewValue) ?>"></span>
</span>
<input type="hidden" data-table="tbl_history_pick" data-field="x_PCS" name="x<?php echo $tbl_history_pick_grid->RowIndex ?>_PCS" id="x<?php echo $tbl_history_pick_grid->RowIndex ?>_PCS" value="<?php echo HtmlEncode($tbl_history_pick->PCS->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="tbl_history_pick" data-field="x_PCS" name="o<?php echo $tbl_history_pick_grid->RowIndex ?>_PCS" id="o<?php echo $tbl_history_pick_grid->RowIndex ?>_PCS" value="<?php echo HtmlEncode($tbl_history_pick->PCS->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($tbl_history_pick->DateIn->Visible) { // DateIn ?>
		<td data-name="DateIn">
<?php if (!$tbl_history_pick->isConfirm()) { ?>
<span id="el$rowindex$_tbl_history_pick_DateIn" class="form-group tbl_history_pick_DateIn">
<input type="text" data-table="tbl_history_pick" data-field="x_DateIn" data-format="7" name="x<?php echo $tbl_history_pick_grid->RowIndex ?>_DateIn" id="x<?php echo $tbl_history_pick_grid->RowIndex ?>_DateIn" placeholder="<?php echo HtmlEncode($tbl_history_pick->DateIn->getPlaceHolder()) ?>" value="<?php echo $tbl_history_pick->DateIn->EditValue ?>"<?php echo $tbl_history_pick->DateIn->editAttributes() ?>>
<?php if (!$tbl_history_pick->DateIn->ReadOnly && !$tbl_history_pick->DateIn->Disabled && !isset($tbl_history_pick->DateIn->EditAttrs["readonly"]) && !isset($tbl_history_pick->DateIn->EditAttrs["disabled"])) { ?>
<script>
ew.createDateTimePicker("ftbl_history_pickgrid", "x<?php echo $tbl_history_pick_grid->RowIndex ?>_DateIn", {"ignoreReadonly":true,"useCurrent":false,"format":7});
</script>
<?php } ?>
</span>
<?php } else { ?>
<span id="el$rowindex$_tbl_history_pick_DateIn" class="form-group tbl_history_pick_DateIn">
<span<?php echo $tbl_history_pick->DateIn->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?php echo RemoveHtml($tbl_history_pick->DateIn->ViewValue) ?>"></span>
</span>
<input type="hidden" data-table="tbl_history_pick" data-field="x_DateIn" name="x<?php echo $tbl_history_pick_grid->RowIndex ?>_DateIn" id="x<?php echo $tbl_history_pick_grid->RowIndex ?>_DateIn" value="<?php echo HtmlEncode($tbl_history_pick->DateIn->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="tbl_history_pick" data-field="x_DateIn" name="o<?php echo $tbl_history_pick_grid->RowIndex ?>_DateIn" id="o<?php echo $tbl_history_pick_grid->RowIndex ?>_DateIn" value="<?php echo HtmlEncode($tbl_history_pick->DateIn->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($tbl_history_pick->User_ID->Visible) { // User_ID ?>
		<td data-name="User_ID">
<?php if (!$tbl_history_pick->isConfirm()) { ?>
<span id="el$rowindex$_tbl_history_pick_User_ID" class="form-group tbl_history_pick_User_ID">
<input type="text" data-table="tbl_history_pick" data-field="x_User_ID" name="x<?php echo $tbl_history_pick_grid->RowIndex ?>_User_ID" id="x<?php echo $tbl_history_pick_grid->RowIndex ?>_User_ID" size="30" maxlength="25" placeholder="<?php echo HtmlEncode($tbl_history_pick->User_ID->getPlaceHolder()) ?>" value="<?php echo $tbl_history_pick->User_ID->EditValue ?>"<?php echo $tbl_history_pick->User_ID->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_tbl_history_pick_User_ID" class="form-group tbl_history_pick_User_ID">
<span<?php echo $tbl_history_pick->User_ID->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?php echo RemoveHtml($tbl_history_pick->User_ID->ViewValue) ?>"></span>
</span>
<input type="hidden" data-table="tbl_history_pick" data-field="x_User_ID" name="x<?php echo $tbl_history_pick_grid->RowIndex ?>_User_ID" id="x<?php echo $tbl_history_pick_grid->RowIndex ?>_User_ID" value="<?php echo HtmlEncode($tbl_history_pick->User_ID->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="tbl_history_pick" data-field="x_User_ID" name="o<?php echo $tbl_history_pick_grid->RowIndex ?>_User_ID" id="o<?php echo $tbl_history_pick_grid->RowIndex ?>_User_ID" value="<?php echo HtmlEncode($tbl_history_pick->User_ID->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($tbl_history_pick->PalletStatus->Visible) { // PalletStatus ?>
		<td data-name="PalletStatus">
<?php if (!$tbl_history_pick->isConfirm()) { ?>
<span id="el$rowindex$_tbl_history_pick_PalletStatus" class="form-group tbl_history_pick_PalletStatus">
<input type="text" data-table="tbl_history_pick" data-field="x_PalletStatus" name="x<?php echo $tbl_history_pick_grid->RowIndex ?>_PalletStatus" id="x<?php echo $tbl_history_pick_grid->RowIndex ?>_PalletStatus" size="30" maxlength="25" placeholder="<?php echo HtmlEncode($tbl_history_pick->PalletStatus->getPlaceHolder()) ?>" value="<?php echo $tbl_history_pick->PalletStatus->EditValue ?>"<?php echo $tbl_history_pick->PalletStatus->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_tbl_history_pick_PalletStatus" class="form-group tbl_history_pick_PalletStatus">
<span<?php echo $tbl_history_pick->PalletStatus->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?php echo RemoveHtml($tbl_history_pick->PalletStatus->ViewValue) ?>"></span>
</span>
<input type="hidden" data-table="tbl_history_pick" data-field="x_PalletStatus" name="x<?php echo $tbl_history_pick_grid->RowIndex ?>_PalletStatus" id="x<?php echo $tbl_history_pick_grid->RowIndex ?>_PalletStatus" value="<?php echo HtmlEncode($tbl_history_pick->PalletStatus->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="tbl_history_pick" data-field="x_PalletStatus" name="o<?php echo $tbl_history_pick_grid->RowIndex ?>_PalletStatus" id="o<?php echo $tbl_history_pick_grid->RowIndex ?>_PalletStatus" value="<?php echo HtmlEncode($tbl_history_pick->PalletStatus->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($tbl_history_pick->CreateUser->Visible) { // CreateUser ?>
		<td data-name="CreateUser">
<?php if (!$tbl_history_pick->isConfirm()) { ?>
<span id="el$rowindex$_tbl_history_pick_CreateUser" class="form-group tbl_history_pick_CreateUser">
<input type="text" data-table="tbl_history_pick" data-field="x_CreateUser" name="x<?php echo $tbl_history_pick_grid->RowIndex ?>_CreateUser" id="x<?php echo $tbl_history_pick_grid->RowIndex ?>_CreateUser" size="30" maxlength="50" placeholder="<?php echo HtmlEncode($tbl_history_pick->CreateUser->getPlaceHolder()) ?>" value="<?php echo $tbl_history_pick->CreateUser->EditValue ?>"<?php echo $tbl_history_pick->CreateUser->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_tbl_history_pick_CreateUser" class="form-group tbl_history_pick_CreateUser">
<span<?php echo $tbl_history_pick->CreateUser->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?php echo RemoveHtml($tbl_history_pick->CreateUser->ViewValue) ?>"></span>
</span>
<input type="hidden" data-table="tbl_history_pick" data-field="x_CreateUser" name="x<?php echo $tbl_history_pick_grid->RowIndex ?>_CreateUser" id="x<?php echo $tbl_history_pick_grid->RowIndex ?>_CreateUser" value="<?php echo HtmlEncode($tbl_history_pick->CreateUser->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="tbl_history_pick" data-field="x_CreateUser" name="o<?php echo $tbl_history_pick_grid->RowIndex ?>_CreateUser" id="o<?php echo $tbl_history_pick_grid->RowIndex ?>_CreateUser" value="<?php echo HtmlEncode($tbl_history_pick->CreateUser->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($tbl_history_pick->CreateDate->Visible) { // CreateDate ?>
		<td data-name="CreateDate">
<?php if (!$tbl_history_pick->isConfirm()) { ?>
<span id="el$rowindex$_tbl_history_pick_CreateDate" class="form-group tbl_history_pick_CreateDate">
<input type="text" data-table="tbl_history_pick" data-field="x_CreateDate" name="x<?php echo $tbl_history_pick_grid->RowIndex ?>_CreateDate" id="x<?php echo $tbl_history_pick_grid->RowIndex ?>_CreateDate" placeholder="<?php echo HtmlEncode($tbl_history_pick->CreateDate->getPlaceHolder()) ?>" value="<?php echo $tbl_history_pick->CreateDate->EditValue ?>"<?php echo $tbl_history_pick->CreateDate->editAttributes() ?>>
<?php if (!$tbl_history_pick->CreateDate->ReadOnly && !$tbl_history_pick->CreateDate->Disabled && !isset($tbl_history_pick->CreateDate->EditAttrs["readonly"]) && !isset($tbl_history_pick->CreateDate->EditAttrs["disabled"])) { ?>
<script>
ew.createDateTimePicker("ftbl_history_pickgrid", "x<?php echo $tbl_history_pick_grid->RowIndex ?>_CreateDate", {"ignoreReadonly":true,"useCurrent":false,"format":0});
</script>
<?php } ?>
</span>
<?php } else { ?>
<span id="el$rowindex$_tbl_history_pick_CreateDate" class="form-group tbl_history_pick_CreateDate">
<span<?php echo $tbl_history_pick->CreateDate->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?php echo RemoveHtml($tbl_history_pick->CreateDate->ViewValue) ?>"></span>
</span>
<input type="hidden" data-table="tbl_history_pick" data-field="x_CreateDate" name="x<?php echo $tbl_history_pick_grid->RowIndex ?>_CreateDate" id="x<?php echo $tbl_history_pick_grid->RowIndex ?>_CreateDate" value="<?php echo HtmlEncode($tbl_history_pick->CreateDate->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="tbl_history_pick" data-field="x_CreateDate" name="o<?php echo $tbl_history_pick_grid->RowIndex ?>_CreateDate" id="o<?php echo $tbl_history_pick_grid->RowIndex ?>_CreateDate" value="<?php echo HtmlEncode($tbl_history_pick->CreateDate->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($tbl_history_pick->Box->Visible) { // Box ?>
		<td data-name="Box">
<?php if (!$tbl_history_pick->isConfirm()) { ?>
<span id="el$rowindex$_tbl_history_pick_Box" class="form-group tbl_history_pick_Box">
<input type="text" data-table="tbl_history_pick" data-field="x_Box" name="x<?php echo $tbl_history_pick_grid->RowIndex ?>_Box" id="x<?php echo $tbl_history_pick_grid->RowIndex ?>_Box" size="30" placeholder="<?php echo HtmlEncode($tbl_history_pick->Box->getPlaceHolder()) ?>" value="<?php echo $tbl_history_pick->Box->EditValue ?>"<?php echo $tbl_history_pick->Box->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_tbl_history_pick_Box" class="form-group tbl_history_pick_Box">
<span<?php echo $tbl_history_pick->Box->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?php echo RemoveHtml($tbl_history_pick->Box->ViewValue) ?>"></span>
</span>
<input type="hidden" data-table="tbl_history_pick" data-field="x_Box" name="x<?php echo $tbl_history_pick_grid->RowIndex ?>_Box" id="x<?php echo $tbl_history_pick_grid->RowIndex ?>_Box" value="<?php echo HtmlEncode($tbl_history_pick->Box->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="tbl_history_pick" data-field="x_Box" name="o<?php echo $tbl_history_pick_grid->RowIndex ?>_Box" id="o<?php echo $tbl_history_pick_grid->RowIndex ?>_Box" value="<?php echo HtmlEncode($tbl_history_pick->Box->OldValue) ?>">
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$tbl_history_pick_grid->ListOptions->render("body", "right", $tbl_history_pick_grid->RowIndex);
?>
<script>
ftbl_history_pickgrid.updateLists(<?php echo $tbl_history_pick_grid->RowIndex ?>);
</script>
	</tr>
<?php
}
?>
</tbody>
<?php

// Render aggregate row
$tbl_history_pick->RowType = ROWTYPE_AGGREGATE;
$tbl_history_pick->resetAttributes();
$tbl_history_pick_grid->renderRow();
?>
<?php if ($tbl_history_pick_grid->TotalRecs > 0 && $tbl_history_pick->CurrentMode == "view") { ?>
<tfoot><!-- Table footer -->
	<tr class="ew-table-footer">
<?php

// Render list options
$tbl_history_pick_grid->renderListOptions();

// Render list options (footer, left)
$tbl_history_pick_grid->ListOptions->render("footer", "left");
?>
	<?php if ($tbl_history_pick->PalletID->Visible) { // PalletID ?>
		<td data-name="PalletID" class="<?php echo $tbl_history_pick->PalletID->footerCellClass() ?>"><span id="elf_tbl_history_pick_PalletID" class="tbl_history_pick_PalletID">
		&nbsp;
		</span></td>
	<?php } ?>
	<?php if ($tbl_history_pick->Code->Visible) { // Code ?>
		<td data-name="Code" class="<?php echo $tbl_history_pick->Code->footerCellClass() ?>"><span id="elf_tbl_history_pick_Code" class="tbl_history_pick_Code">
		&nbsp;
		</span></td>
	<?php } ?>
	<?php if ($tbl_history_pick->ID_Location->Visible) { // ID_Location ?>
		<td data-name="ID_Location" class="<?php echo $tbl_history_pick->ID_Location->footerCellClass() ?>"><span id="elf_tbl_history_pick_ID_Location" class="tbl_history_pick_ID_Location">
		&nbsp;
		</span></td>
	<?php } ?>
	<?php if ($tbl_history_pick->PCS->Visible) { // PCS ?>
		<td data-name="PCS" class="<?php echo $tbl_history_pick->PCS->footerCellClass() ?>"><span id="elf_tbl_history_pick_PCS" class="tbl_history_pick_PCS">
		<span class="ew-aggregate"><?php echo $Language->phrase("TOTAL") ?></span><span class="ew-aggregate-value">
		<?php echo $tbl_history_pick->PCS->ViewValue ?></span>
		</span></td>
	<?php } ?>
	<?php if ($tbl_history_pick->DateIn->Visible) { // DateIn ?>
		<td data-name="DateIn" class="<?php echo $tbl_history_pick->DateIn->footerCellClass() ?>"><span id="elf_tbl_history_pick_DateIn" class="tbl_history_pick_DateIn">
		&nbsp;
		</span></td>
	<?php } ?>
	<?php if ($tbl_history_pick->User_ID->Visible) { // User_ID ?>
		<td data-name="User_ID" class="<?php echo $tbl_history_pick->User_ID->footerCellClass() ?>"><span id="elf_tbl_history_pick_User_ID" class="tbl_history_pick_User_ID">
		&nbsp;
		</span></td>
	<?php } ?>
	<?php if ($tbl_history_pick->PalletStatus->Visible) { // PalletStatus ?>
		<td data-name="PalletStatus" class="<?php echo $tbl_history_pick->PalletStatus->footerCellClass() ?>"><span id="elf_tbl_history_pick_PalletStatus" class="tbl_history_pick_PalletStatus">
		&nbsp;
		</span></td>
	<?php } ?>
	<?php if ($tbl_history_pick->CreateUser->Visible) { // CreateUser ?>
		<td data-name="CreateUser" class="<?php echo $tbl_history_pick->CreateUser->footerCellClass() ?>"><span id="elf_tbl_history_pick_CreateUser" class="tbl_history_pick_CreateUser">
		&nbsp;
		</span></td>
	<?php } ?>
	<?php if ($tbl_history_pick->CreateDate->Visible) { // CreateDate ?>
		<td data-name="CreateDate" class="<?php echo $tbl_history_pick->CreateDate->footerCellClass() ?>"><span id="elf_tbl_history_pick_CreateDate" class="tbl_history_pick_CreateDate">
		&nbsp;
		</span></td>
	<?php } ?>
	<?php if ($tbl_history_pick->Box->Visible) { // Box ?>
		<td data-name="Box" class="<?php echo $tbl_history_pick->Box->footerCellClass() ?>"><span id="elf_tbl_history_pick_Box" class="tbl_history_pick_Box">
		<span class="ew-aggregate"><?php echo $Language->phrase("TOTAL") ?></span><span class="ew-aggregate-value">
		<?php echo $tbl_history_pick->Box->ViewValue ?></span>
		</span></td>
	<?php } ?>
<?php

// Render list options (footer, right)
$tbl_history_pick_grid->ListOptions->render("footer", "right");
?>
	</tr>
</tfoot>
<?php } ?>
</table><!-- /.ew-table -->
<?php if ($tbl_history_pick->CurrentMode == "add" || $tbl_history_pick->CurrentMode == "copy") { ?>
<input type="hidden" name="<?php echo $tbl_history_pick_grid->FormKeyCountName ?>" id="<?php echo $tbl_history_pick_grid->FormKeyCountName ?>" value="<?php echo $tbl_history_pick_grid->KeyCount ?>">
<?php echo $tbl_history_pick_grid->MultiSelectKey ?>
<?php } ?>
<?php if ($tbl_history_pick->CurrentMode == "edit") { ?>
<input type="hidden" name="<?php echo $tbl_history_pick_grid->FormKeyCountName ?>" id="<?php echo $tbl_history_pick_grid->FormKeyCountName ?>" value="<?php echo $tbl_history_pick_grid->KeyCount ?>">
<?php echo $tbl_history_pick_grid->MultiSelectKey ?>
<?php } ?>
<?php if ($tbl_history_pick->CurrentMode == "") { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
<input type="hidden" name="detailpage" value="ftbl_history_pickgrid">
</div><!-- /.ew-grid-middle-panel -->
<?php

// Close recordset
if ($tbl_history_pick_grid->Recordset)
	$tbl_history_pick_grid->Recordset->Close();
?>
</div>
<?php if ($tbl_history_pick_grid->ShowOtherOptions) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php $tbl_history_pick_grid->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($tbl_history_pick_grid->TotalRecs == 0 && !$tbl_history_pick->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $tbl_history_pick_grid->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$tbl_history_pick_grid->terminate();
?>