<?php
namespace PHPMaker2019\asgbn_wh;

// Write header
WriteHeader(FALSE);

// Create page object
if (!isset($vwhistoryPicking_grid))
	$vwhistoryPicking_grid = new vwhistoryPicking_grid();

// Run the page
$vwhistoryPicking_grid->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$vwhistoryPicking_grid->Page_Render();
?>
<?php if (!$vwhistoryPicking->isExport()) { ?>
<script>

// Form object
var fvwhistoryPickinggrid = new ew.Form("fvwhistoryPickinggrid", "grid");
fvwhistoryPickinggrid.formKeyCountName = '<?php echo $vwhistoryPicking_grid->FormKeyCountName ?>';

// Validate form
fvwhistoryPickinggrid.validate = function() {
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
		<?php if ($vwhistoryPicking_grid->ID_His->Required) { ?>
			elm = this.getElements("x" + infix + "_ID_His");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $vwhistoryPicking->ID_His->caption(), $vwhistoryPicking->ID_His->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($vwhistoryPicking_grid->PalletID->Required) { ?>
			elm = this.getElements("x" + infix + "_PalletID");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $vwhistoryPicking->PalletID->caption(), $vwhistoryPicking->PalletID->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($vwhistoryPicking_grid->Code->Required) { ?>
			elm = this.getElements("x" + infix + "_Code");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $vwhistoryPicking->Code->caption(), $vwhistoryPicking->Code->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($vwhistoryPicking_grid->PCS->Required) { ?>
			elm = this.getElements("x" + infix + "_PCS");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $vwhistoryPicking->PCS->caption(), $vwhistoryPicking->PCS->RequiredErrorMessage)) ?>");
		<?php } ?>
			elm = this.getElements("x" + infix + "_PCS");
			if (elm && !ew.checkInteger(elm.value))
				return this.onError(elm, "<?php echo JsEncode($vwhistoryPicking->PCS->errorMessage()) ?>");
		<?php if ($vwhistoryPicking_grid->Location->Required) { ?>
			elm = this.getElements("x" + infix + "_Location");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $vwhistoryPicking->Location->caption(), $vwhistoryPicking->Location->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($vwhistoryPicking_grid->Box->Required) { ?>
			elm = this.getElements("x" + infix + "_Box");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $vwhistoryPicking->Box->caption(), $vwhistoryPicking->Box->RequiredErrorMessage)) ?>");
		<?php } ?>
			elm = this.getElements("x" + infix + "_Box");
			if (elm && !ew.checkInteger(elm.value))
				return this.onError(elm, "<?php echo JsEncode($vwhistoryPicking->Box->errorMessage()) ?>");
		<?php if ($vwhistoryPicking_grid->CreateUser->Required) { ?>
			elm = this.getElements("x" + infix + "_CreateUser");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $vwhistoryPicking->CreateUser->caption(), $vwhistoryPicking->CreateUser->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($vwhistoryPicking_grid->CreateDate->Required) { ?>
			elm = this.getElements("x" + infix + "_CreateDate");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $vwhistoryPicking->CreateDate->caption(), $vwhistoryPicking->CreateDate->RequiredErrorMessage)) ?>");
		<?php } ?>
			elm = this.getElements("x" + infix + "_CreateDate");
			if (elm && !ew.checkDateDef(elm.value))
				return this.onError(elm, "<?php echo JsEncode($vwhistoryPicking->CreateDate->errorMessage()) ?>");
		<?php if ($vwhistoryPicking_grid->UpdateUser->Required) { ?>
			elm = this.getElements("x" + infix + "_UpdateUser");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $vwhistoryPicking->UpdateUser->caption(), $vwhistoryPicking->UpdateUser->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($vwhistoryPicking_grid->UpdateDate->Required) { ?>
			elm = this.getElements("x" + infix + "_UpdateDate");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $vwhistoryPicking->UpdateDate->caption(), $vwhistoryPicking->UpdateDate->RequiredErrorMessage)) ?>");
		<?php } ?>
			elm = this.getElements("x" + infix + "_UpdateDate");
			if (elm && !ew.checkDateDef(elm.value))
				return this.onError(elm, "<?php echo JsEncode($vwhistoryPicking->UpdateDate->errorMessage()) ?>");
		<?php if ($vwhistoryPicking_grid->ID_Order->Required) { ?>
			elm = this.getElements("x" + infix + "_ID_Order");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $vwhistoryPicking->ID_Order->caption(), $vwhistoryPicking->ID_Order->RequiredErrorMessage)) ?>");
		<?php } ?>
			elm = this.getElements("x" + infix + "_ID_Order");
			if (elm && !ew.checkInteger(elm.value))
				return this.onError(elm, "<?php echo JsEncode($vwhistoryPicking->ID_Order->errorMessage()) ?>");

			// Fire Form_CustomValidate event
			if (!this.Form_CustomValidate(fobj))
				return false;
		} // End Grid Add checking
	}
	return true;
}

// Check empty row
fvwhistoryPickinggrid.emptyRow = function(infix) {
	var fobj = this._form;
	if (ew.valueChanged(fobj, infix, "PalletID", false)) return false;
	if (ew.valueChanged(fobj, infix, "Code", false)) return false;
	if (ew.valueChanged(fobj, infix, "PCS", false)) return false;
	if (ew.valueChanged(fobj, infix, "Location", false)) return false;
	if (ew.valueChanged(fobj, infix, "Box", false)) return false;
	if (ew.valueChanged(fobj, infix, "CreateUser", false)) return false;
	if (ew.valueChanged(fobj, infix, "CreateDate", false)) return false;
	if (ew.valueChanged(fobj, infix, "UpdateUser", false)) return false;
	if (ew.valueChanged(fobj, infix, "UpdateDate", false)) return false;
	if (ew.valueChanged(fobj, infix, "ID_Order", false)) return false;
	return true;
}

// Form_CustomValidate event
fvwhistoryPickinggrid.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

	// Your custom validation code here, return false if invalid.
	return true;
}

// Use JavaScript validation or not
fvwhistoryPickinggrid.validateRequired = <?php echo json_encode(CLIENT_VALIDATE) ?>;

// Dynamic selection lists
// Form object for search

</script>
<?php } ?>
<?php
$vwhistoryPicking_grid->renderOtherOptions();
?>
<?php $vwhistoryPicking_grid->showPageHeader(); ?>
<?php
$vwhistoryPicking_grid->showMessage();
?>
<?php if ($vwhistoryPicking_grid->TotalRecs > 0 || $vwhistoryPicking->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($vwhistoryPicking_grid->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> vwhistoryPicking">
<?php if ($vwhistoryPicking_grid->ShowOtherOptions) { ?>
<div class="card-header ew-grid-upper-panel">
<?php $vwhistoryPicking_grid->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<div id="fvwhistoryPickinggrid" class="ew-form ew-list-form form-inline">
<div id="gmp_vwhistoryPicking" class="<?php if (IsResponsiveLayout()) { ?>table-responsive <?php } ?>card-body ew-grid-middle-panel">
<table id="tbl_vwhistoryPickinggrid" class="table ew-table"><!-- .ew-table ##-->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$vwhistoryPicking_grid->RowType = ROWTYPE_HEADER;

// Render list options
$vwhistoryPicking_grid->renderListOptions();

// Render list options (header, left)
$vwhistoryPicking_grid->ListOptions->render("header", "left");
?>
<?php if ($vwhistoryPicking->ID_His->Visible) { // ID_His ?>
	<?php if ($vwhistoryPicking->sortUrl($vwhistoryPicking->ID_His) == "") { ?>
		<th data-name="ID_His" class="<?php echo $vwhistoryPicking->ID_His->headerCellClass() ?>"><div id="elh_vwhistoryPicking_ID_His" class="vwhistoryPicking_ID_His"><div class="ew-table-header-caption"><?php echo $vwhistoryPicking->ID_His->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="ID_His" class="<?php echo $vwhistoryPicking->ID_His->headerCellClass() ?>"><div><div id="elh_vwhistoryPicking_ID_His" class="vwhistoryPicking_ID_His">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $vwhistoryPicking->ID_His->caption() ?></span><span class="ew-table-header-sort"><?php if ($vwhistoryPicking->ID_His->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($vwhistoryPicking->ID_His->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($vwhistoryPicking->PalletID->Visible) { // PalletID ?>
	<?php if ($vwhistoryPicking->sortUrl($vwhistoryPicking->PalletID) == "") { ?>
		<th data-name="PalletID" class="<?php echo $vwhistoryPicking->PalletID->headerCellClass() ?>"><div id="elh_vwhistoryPicking_PalletID" class="vwhistoryPicking_PalletID"><div class="ew-table-header-caption"><?php echo $vwhistoryPicking->PalletID->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="PalletID" class="<?php echo $vwhistoryPicking->PalletID->headerCellClass() ?>"><div><div id="elh_vwhistoryPicking_PalletID" class="vwhistoryPicking_PalletID">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $vwhistoryPicking->PalletID->caption() ?></span><span class="ew-table-header-sort"><?php if ($vwhistoryPicking->PalletID->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($vwhistoryPicking->PalletID->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($vwhistoryPicking->Code->Visible) { // Code ?>
	<?php if ($vwhistoryPicking->sortUrl($vwhistoryPicking->Code) == "") { ?>
		<th data-name="Code" class="<?php echo $vwhistoryPicking->Code->headerCellClass() ?>"><div id="elh_vwhistoryPicking_Code" class="vwhistoryPicking_Code"><div class="ew-table-header-caption"><?php echo $vwhistoryPicking->Code->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Code" class="<?php echo $vwhistoryPicking->Code->headerCellClass() ?>"><div><div id="elh_vwhistoryPicking_Code" class="vwhistoryPicking_Code">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $vwhistoryPicking->Code->caption() ?></span><span class="ew-table-header-sort"><?php if ($vwhistoryPicking->Code->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($vwhistoryPicking->Code->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($vwhistoryPicking->PCS->Visible) { // PCS ?>
	<?php if ($vwhistoryPicking->sortUrl($vwhistoryPicking->PCS) == "") { ?>
		<th data-name="PCS" class="<?php echo $vwhistoryPicking->PCS->headerCellClass() ?>"><div id="elh_vwhistoryPicking_PCS" class="vwhistoryPicking_PCS"><div class="ew-table-header-caption"><?php echo $vwhistoryPicking->PCS->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="PCS" class="<?php echo $vwhistoryPicking->PCS->headerCellClass() ?>"><div><div id="elh_vwhistoryPicking_PCS" class="vwhistoryPicking_PCS">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $vwhistoryPicking->PCS->caption() ?></span><span class="ew-table-header-sort"><?php if ($vwhistoryPicking->PCS->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($vwhistoryPicking->PCS->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($vwhistoryPicking->Location->Visible) { // Location ?>
	<?php if ($vwhistoryPicking->sortUrl($vwhistoryPicking->Location) == "") { ?>
		<th data-name="Location" class="<?php echo $vwhistoryPicking->Location->headerCellClass() ?>"><div id="elh_vwhistoryPicking_Location" class="vwhistoryPicking_Location"><div class="ew-table-header-caption"><?php echo $vwhistoryPicking->Location->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Location" class="<?php echo $vwhistoryPicking->Location->headerCellClass() ?>"><div><div id="elh_vwhistoryPicking_Location" class="vwhistoryPicking_Location">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $vwhistoryPicking->Location->caption() ?></span><span class="ew-table-header-sort"><?php if ($vwhistoryPicking->Location->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($vwhistoryPicking->Location->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($vwhistoryPicking->Box->Visible) { // Box ?>
	<?php if ($vwhistoryPicking->sortUrl($vwhistoryPicking->Box) == "") { ?>
		<th data-name="Box" class="<?php echo $vwhistoryPicking->Box->headerCellClass() ?>"><div id="elh_vwhistoryPicking_Box" class="vwhistoryPicking_Box"><div class="ew-table-header-caption"><?php echo $vwhistoryPicking->Box->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Box" class="<?php echo $vwhistoryPicking->Box->headerCellClass() ?>"><div><div id="elh_vwhistoryPicking_Box" class="vwhistoryPicking_Box">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $vwhistoryPicking->Box->caption() ?></span><span class="ew-table-header-sort"><?php if ($vwhistoryPicking->Box->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($vwhistoryPicking->Box->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($vwhistoryPicking->CreateUser->Visible) { // CreateUser ?>
	<?php if ($vwhistoryPicking->sortUrl($vwhistoryPicking->CreateUser) == "") { ?>
		<th data-name="CreateUser" class="<?php echo $vwhistoryPicking->CreateUser->headerCellClass() ?>"><div id="elh_vwhistoryPicking_CreateUser" class="vwhistoryPicking_CreateUser"><div class="ew-table-header-caption"><?php echo $vwhistoryPicking->CreateUser->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="CreateUser" class="<?php echo $vwhistoryPicking->CreateUser->headerCellClass() ?>"><div><div id="elh_vwhistoryPicking_CreateUser" class="vwhistoryPicking_CreateUser">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $vwhistoryPicking->CreateUser->caption() ?></span><span class="ew-table-header-sort"><?php if ($vwhistoryPicking->CreateUser->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($vwhistoryPicking->CreateUser->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($vwhistoryPicking->CreateDate->Visible) { // CreateDate ?>
	<?php if ($vwhistoryPicking->sortUrl($vwhistoryPicking->CreateDate) == "") { ?>
		<th data-name="CreateDate" class="<?php echo $vwhistoryPicking->CreateDate->headerCellClass() ?>"><div id="elh_vwhistoryPicking_CreateDate" class="vwhistoryPicking_CreateDate"><div class="ew-table-header-caption"><?php echo $vwhistoryPicking->CreateDate->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="CreateDate" class="<?php echo $vwhistoryPicking->CreateDate->headerCellClass() ?>"><div><div id="elh_vwhistoryPicking_CreateDate" class="vwhistoryPicking_CreateDate">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $vwhistoryPicking->CreateDate->caption() ?></span><span class="ew-table-header-sort"><?php if ($vwhistoryPicking->CreateDate->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($vwhistoryPicking->CreateDate->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($vwhistoryPicking->UpdateUser->Visible) { // UpdateUser ?>
	<?php if ($vwhistoryPicking->sortUrl($vwhistoryPicking->UpdateUser) == "") { ?>
		<th data-name="UpdateUser" class="<?php echo $vwhistoryPicking->UpdateUser->headerCellClass() ?>"><div id="elh_vwhistoryPicking_UpdateUser" class="vwhistoryPicking_UpdateUser"><div class="ew-table-header-caption"><?php echo $vwhistoryPicking->UpdateUser->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="UpdateUser" class="<?php echo $vwhistoryPicking->UpdateUser->headerCellClass() ?>"><div><div id="elh_vwhistoryPicking_UpdateUser" class="vwhistoryPicking_UpdateUser">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $vwhistoryPicking->UpdateUser->caption() ?></span><span class="ew-table-header-sort"><?php if ($vwhistoryPicking->UpdateUser->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($vwhistoryPicking->UpdateUser->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($vwhistoryPicking->UpdateDate->Visible) { // UpdateDate ?>
	<?php if ($vwhistoryPicking->sortUrl($vwhistoryPicking->UpdateDate) == "") { ?>
		<th data-name="UpdateDate" class="<?php echo $vwhistoryPicking->UpdateDate->headerCellClass() ?>"><div id="elh_vwhistoryPicking_UpdateDate" class="vwhistoryPicking_UpdateDate"><div class="ew-table-header-caption"><?php echo $vwhistoryPicking->UpdateDate->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="UpdateDate" class="<?php echo $vwhistoryPicking->UpdateDate->headerCellClass() ?>"><div><div id="elh_vwhistoryPicking_UpdateDate" class="vwhistoryPicking_UpdateDate">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $vwhistoryPicking->UpdateDate->caption() ?></span><span class="ew-table-header-sort"><?php if ($vwhistoryPicking->UpdateDate->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($vwhistoryPicking->UpdateDate->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($vwhistoryPicking->ID_Order->Visible) { // ID_Order ?>
	<?php if ($vwhistoryPicking->sortUrl($vwhistoryPicking->ID_Order) == "") { ?>
		<th data-name="ID_Order" class="<?php echo $vwhistoryPicking->ID_Order->headerCellClass() ?>"><div id="elh_vwhistoryPicking_ID_Order" class="vwhistoryPicking_ID_Order"><div class="ew-table-header-caption"><?php echo $vwhistoryPicking->ID_Order->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="ID_Order" class="<?php echo $vwhistoryPicking->ID_Order->headerCellClass() ?>"><div><div id="elh_vwhistoryPicking_ID_Order" class="vwhistoryPicking_ID_Order">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $vwhistoryPicking->ID_Order->caption() ?></span><span class="ew-table-header-sort"><?php if ($vwhistoryPicking->ID_Order->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($vwhistoryPicking->ID_Order->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$vwhistoryPicking_grid->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
$vwhistoryPicking_grid->StartRec = 1;
$vwhistoryPicking_grid->StopRec = $vwhistoryPicking_grid->TotalRecs; // Show all records

// Restore number of post back records
if ($CurrentForm && $vwhistoryPicking_grid->EventCancelled) {
	$CurrentForm->Index = -1;
	if ($CurrentForm->hasValue($vwhistoryPicking_grid->FormKeyCountName) && ($vwhistoryPicking->isGridAdd() || $vwhistoryPicking->isGridEdit() || $vwhistoryPicking->isConfirm())) {
		$vwhistoryPicking_grid->KeyCount = $CurrentForm->getValue($vwhistoryPicking_grid->FormKeyCountName);
		$vwhistoryPicking_grid->StopRec = $vwhistoryPicking_grid->StartRec + $vwhistoryPicking_grid->KeyCount - 1;
	}
}
$vwhistoryPicking_grid->RecCnt = $vwhistoryPicking_grid->StartRec - 1;
if ($vwhistoryPicking_grid->Recordset && !$vwhistoryPicking_grid->Recordset->EOF) {
	$vwhistoryPicking_grid->Recordset->moveFirst();
	$selectLimit = $vwhistoryPicking_grid->UseSelectLimit;
	if (!$selectLimit && $vwhistoryPicking_grid->StartRec > 1)
		$vwhistoryPicking_grid->Recordset->move($vwhistoryPicking_grid->StartRec - 1);
} elseif (!$vwhistoryPicking->AllowAddDeleteRow && $vwhistoryPicking_grid->StopRec == 0) {
	$vwhistoryPicking_grid->StopRec = $vwhistoryPicking->GridAddRowCount;
}

// Initialize aggregate
$vwhistoryPicking->RowType = ROWTYPE_AGGREGATEINIT;
$vwhistoryPicking->resetAttributes();
$vwhistoryPicking_grid->renderRow();
if ($vwhistoryPicking->isGridAdd())
	$vwhistoryPicking_grid->RowIndex = 0;
if ($vwhistoryPicking->isGridEdit())
	$vwhistoryPicking_grid->RowIndex = 0;
while ($vwhistoryPicking_grid->RecCnt < $vwhistoryPicking_grid->StopRec) {
	$vwhistoryPicking_grid->RecCnt++;
	if ($vwhistoryPicking_grid->RecCnt >= $vwhistoryPicking_grid->StartRec) {
		$vwhistoryPicking_grid->RowCnt++;
		if ($vwhistoryPicking->isGridAdd() || $vwhistoryPicking->isGridEdit() || $vwhistoryPicking->isConfirm()) {
			$vwhistoryPicking_grid->RowIndex++;
			$CurrentForm->Index = $vwhistoryPicking_grid->RowIndex;
			if ($CurrentForm->hasValue($vwhistoryPicking_grid->FormActionName) && $vwhistoryPicking_grid->EventCancelled)
				$vwhistoryPicking_grid->RowAction = strval($CurrentForm->getValue($vwhistoryPicking_grid->FormActionName));
			elseif ($vwhistoryPicking->isGridAdd())
				$vwhistoryPicking_grid->RowAction = "insert";
			else
				$vwhistoryPicking_grid->RowAction = "";
		}

		// Set up key count
		$vwhistoryPicking_grid->KeyCount = $vwhistoryPicking_grid->RowIndex;

		// Init row class and style
		$vwhistoryPicking->resetAttributes();
		$vwhistoryPicking->CssClass = "";
		if ($vwhistoryPicking->isGridAdd()) {
			if ($vwhistoryPicking->CurrentMode == "copy") {
				$vwhistoryPicking_grid->loadRowValues($vwhistoryPicking_grid->Recordset); // Load row values
				$vwhistoryPicking_grid->setRecordKey($vwhistoryPicking_grid->RowOldKey, $vwhistoryPicking_grid->Recordset); // Set old record key
			} else {
				$vwhistoryPicking_grid->loadRowValues(); // Load default values
				$vwhistoryPicking_grid->RowOldKey = ""; // Clear old key value
			}
		} else {
			$vwhistoryPicking_grid->loadRowValues($vwhistoryPicking_grid->Recordset); // Load row values
		}
		$vwhistoryPicking->RowType = ROWTYPE_VIEW; // Render view
		if ($vwhistoryPicking->isGridAdd()) // Grid add
			$vwhistoryPicking->RowType = ROWTYPE_ADD; // Render add
		if ($vwhistoryPicking->isGridAdd() && $vwhistoryPicking->EventCancelled && !$CurrentForm->hasValue("k_blankrow")) // Insert failed
			$vwhistoryPicking_grid->restoreCurrentRowFormValues($vwhistoryPicking_grid->RowIndex); // Restore form values
		if ($vwhistoryPicking->isGridEdit()) { // Grid edit
			if ($vwhistoryPicking->EventCancelled)
				$vwhistoryPicking_grid->restoreCurrentRowFormValues($vwhistoryPicking_grid->RowIndex); // Restore form values
			if ($vwhistoryPicking_grid->RowAction == "insert")
				$vwhistoryPicking->RowType = ROWTYPE_ADD; // Render add
			else
				$vwhistoryPicking->RowType = ROWTYPE_EDIT; // Render edit
		}
		if ($vwhistoryPicking->isGridEdit() && ($vwhistoryPicking->RowType == ROWTYPE_EDIT || $vwhistoryPicking->RowType == ROWTYPE_ADD) && $vwhistoryPicking->EventCancelled) // Update failed
			$vwhistoryPicking_grid->restoreCurrentRowFormValues($vwhistoryPicking_grid->RowIndex); // Restore form values
		if ($vwhistoryPicking->RowType == ROWTYPE_EDIT) // Edit row
			$vwhistoryPicking_grid->EditRowCnt++;
		if ($vwhistoryPicking->isConfirm()) // Confirm row
			$vwhistoryPicking_grid->restoreCurrentRowFormValues($vwhistoryPicking_grid->RowIndex); // Restore form values

		// Set up row id / data-rowindex
		$vwhistoryPicking->RowAttrs = array_merge($vwhistoryPicking->RowAttrs, array('data-rowindex'=>$vwhistoryPicking_grid->RowCnt, 'id'=>'r' . $vwhistoryPicking_grid->RowCnt . '_vwhistoryPicking', 'data-rowtype'=>$vwhistoryPicking->RowType));

		// Render row
		$vwhistoryPicking_grid->renderRow();

		// Render list options
		$vwhistoryPicking_grid->renderListOptions();

		// Skip delete row / empty row for confirm page
		if ($vwhistoryPicking_grid->RowAction <> "delete" && $vwhistoryPicking_grid->RowAction <> "insertdelete" && !($vwhistoryPicking_grid->RowAction == "insert" && $vwhistoryPicking->isConfirm() && $vwhistoryPicking_grid->emptyRow())) {
?>
	<tr<?php echo $vwhistoryPicking->rowAttributes() ?>>
<?php

// Render list options (body, left)
$vwhistoryPicking_grid->ListOptions->render("body", "left", $vwhistoryPicking_grid->RowCnt);
?>
	<?php if ($vwhistoryPicking->ID_His->Visible) { // ID_His ?>
		<td data-name="ID_His"<?php echo $vwhistoryPicking->ID_His->cellAttributes() ?>>
<?php if ($vwhistoryPicking->RowType == ROWTYPE_ADD) { // Add record ?>
<input type="hidden" data-table="vwhistoryPicking" data-field="x_ID_His" name="o<?php echo $vwhistoryPicking_grid->RowIndex ?>_ID_His" id="o<?php echo $vwhistoryPicking_grid->RowIndex ?>_ID_His" value="<?php echo HtmlEncode($vwhistoryPicking->ID_His->OldValue) ?>">
<?php } ?>
<?php if ($vwhistoryPicking->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $vwhistoryPicking_grid->RowCnt ?>_vwhistoryPicking_ID_His" class="form-group vwhistoryPicking_ID_His">
<span<?php echo $vwhistoryPicking->ID_His->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?php echo RemoveHtml($vwhistoryPicking->ID_His->EditValue) ?>"></span>
</span>
<input type="hidden" data-table="vwhistoryPicking" data-field="x_ID_His" name="x<?php echo $vwhistoryPicking_grid->RowIndex ?>_ID_His" id="x<?php echo $vwhistoryPicking_grid->RowIndex ?>_ID_His" value="<?php echo HtmlEncode($vwhistoryPicking->ID_His->CurrentValue) ?>">
<?php } ?>
<?php if ($vwhistoryPicking->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $vwhistoryPicking_grid->RowCnt ?>_vwhistoryPicking_ID_His" class="vwhistoryPicking_ID_His">
<span<?php echo $vwhistoryPicking->ID_His->viewAttributes() ?>>
<?php echo $vwhistoryPicking->ID_His->getViewValue() ?></span>
</span>
<?php if (!$vwhistoryPicking->isConfirm()) { ?>
<input type="hidden" data-table="vwhistoryPicking" data-field="x_ID_His" name="x<?php echo $vwhistoryPicking_grid->RowIndex ?>_ID_His" id="x<?php echo $vwhistoryPicking_grid->RowIndex ?>_ID_His" value="<?php echo HtmlEncode($vwhistoryPicking->ID_His->FormValue) ?>">
<input type="hidden" data-table="vwhistoryPicking" data-field="x_ID_His" name="o<?php echo $vwhistoryPicking_grid->RowIndex ?>_ID_His" id="o<?php echo $vwhistoryPicking_grid->RowIndex ?>_ID_His" value="<?php echo HtmlEncode($vwhistoryPicking->ID_His->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="vwhistoryPicking" data-field="x_ID_His" name="fvwhistoryPickinggrid$x<?php echo $vwhistoryPicking_grid->RowIndex ?>_ID_His" id="fvwhistoryPickinggrid$x<?php echo $vwhistoryPicking_grid->RowIndex ?>_ID_His" value="<?php echo HtmlEncode($vwhistoryPicking->ID_His->FormValue) ?>">
<input type="hidden" data-table="vwhistoryPicking" data-field="x_ID_His" name="fvwhistoryPickinggrid$o<?php echo $vwhistoryPicking_grid->RowIndex ?>_ID_His" id="fvwhistoryPickinggrid$o<?php echo $vwhistoryPicking_grid->RowIndex ?>_ID_His" value="<?php echo HtmlEncode($vwhistoryPicking->ID_His->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($vwhistoryPicking->PalletID->Visible) { // PalletID ?>
		<td data-name="PalletID"<?php echo $vwhistoryPicking->PalletID->cellAttributes() ?>>
<?php if ($vwhistoryPicking->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $vwhistoryPicking_grid->RowCnt ?>_vwhistoryPicking_PalletID" class="form-group vwhistoryPicking_PalletID">
<input type="text" data-table="vwhistoryPicking" data-field="x_PalletID" name="x<?php echo $vwhistoryPicking_grid->RowIndex ?>_PalletID" id="x<?php echo $vwhistoryPicking_grid->RowIndex ?>_PalletID" size="30" maxlength="50" placeholder="<?php echo HtmlEncode($vwhistoryPicking->PalletID->getPlaceHolder()) ?>" value="<?php echo $vwhistoryPicking->PalletID->EditValue ?>"<?php echo $vwhistoryPicking->PalletID->editAttributes() ?>>
</span>
<input type="hidden" data-table="vwhistoryPicking" data-field="x_PalletID" name="o<?php echo $vwhistoryPicking_grid->RowIndex ?>_PalletID" id="o<?php echo $vwhistoryPicking_grid->RowIndex ?>_PalletID" value="<?php echo HtmlEncode($vwhistoryPicking->PalletID->OldValue) ?>">
<?php } ?>
<?php if ($vwhistoryPicking->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $vwhistoryPicking_grid->RowCnt ?>_vwhistoryPicking_PalletID" class="form-group vwhistoryPicking_PalletID">
<input type="text" data-table="vwhistoryPicking" data-field="x_PalletID" name="x<?php echo $vwhistoryPicking_grid->RowIndex ?>_PalletID" id="x<?php echo $vwhistoryPicking_grid->RowIndex ?>_PalletID" size="30" maxlength="50" placeholder="<?php echo HtmlEncode($vwhistoryPicking->PalletID->getPlaceHolder()) ?>" value="<?php echo $vwhistoryPicking->PalletID->EditValue ?>"<?php echo $vwhistoryPicking->PalletID->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($vwhistoryPicking->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $vwhistoryPicking_grid->RowCnt ?>_vwhistoryPicking_PalletID" class="vwhistoryPicking_PalletID">
<span<?php echo $vwhistoryPicking->PalletID->viewAttributes() ?>>
<?php echo $vwhistoryPicking->PalletID->getViewValue() ?></span>
</span>
<?php if (!$vwhistoryPicking->isConfirm()) { ?>
<input type="hidden" data-table="vwhistoryPicking" data-field="x_PalletID" name="x<?php echo $vwhistoryPicking_grid->RowIndex ?>_PalletID" id="x<?php echo $vwhistoryPicking_grid->RowIndex ?>_PalletID" value="<?php echo HtmlEncode($vwhistoryPicking->PalletID->FormValue) ?>">
<input type="hidden" data-table="vwhistoryPicking" data-field="x_PalletID" name="o<?php echo $vwhistoryPicking_grid->RowIndex ?>_PalletID" id="o<?php echo $vwhistoryPicking_grid->RowIndex ?>_PalletID" value="<?php echo HtmlEncode($vwhistoryPicking->PalletID->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="vwhistoryPicking" data-field="x_PalletID" name="fvwhistoryPickinggrid$x<?php echo $vwhistoryPicking_grid->RowIndex ?>_PalletID" id="fvwhistoryPickinggrid$x<?php echo $vwhistoryPicking_grid->RowIndex ?>_PalletID" value="<?php echo HtmlEncode($vwhistoryPicking->PalletID->FormValue) ?>">
<input type="hidden" data-table="vwhistoryPicking" data-field="x_PalletID" name="fvwhistoryPickinggrid$o<?php echo $vwhistoryPicking_grid->RowIndex ?>_PalletID" id="fvwhistoryPickinggrid$o<?php echo $vwhistoryPicking_grid->RowIndex ?>_PalletID" value="<?php echo HtmlEncode($vwhistoryPicking->PalletID->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($vwhistoryPicking->Code->Visible) { // Code ?>
		<td data-name="Code"<?php echo $vwhistoryPicking->Code->cellAttributes() ?>>
<?php if ($vwhistoryPicking->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $vwhistoryPicking_grid->RowCnt ?>_vwhistoryPicking_Code" class="form-group vwhistoryPicking_Code">
<input type="text" data-table="vwhistoryPicking" data-field="x_Code" name="x<?php echo $vwhistoryPicking_grid->RowIndex ?>_Code" id="x<?php echo $vwhistoryPicking_grid->RowIndex ?>_Code" size="30" maxlength="50" placeholder="<?php echo HtmlEncode($vwhistoryPicking->Code->getPlaceHolder()) ?>" value="<?php echo $vwhistoryPicking->Code->EditValue ?>"<?php echo $vwhistoryPicking->Code->editAttributes() ?>>
</span>
<input type="hidden" data-table="vwhistoryPicking" data-field="x_Code" name="o<?php echo $vwhistoryPicking_grid->RowIndex ?>_Code" id="o<?php echo $vwhistoryPicking_grid->RowIndex ?>_Code" value="<?php echo HtmlEncode($vwhistoryPicking->Code->OldValue) ?>">
<?php } ?>
<?php if ($vwhistoryPicking->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $vwhistoryPicking_grid->RowCnt ?>_vwhistoryPicking_Code" class="form-group vwhistoryPicking_Code">
<input type="text" data-table="vwhistoryPicking" data-field="x_Code" name="x<?php echo $vwhistoryPicking_grid->RowIndex ?>_Code" id="x<?php echo $vwhistoryPicking_grid->RowIndex ?>_Code" size="30" maxlength="50" placeholder="<?php echo HtmlEncode($vwhistoryPicking->Code->getPlaceHolder()) ?>" value="<?php echo $vwhistoryPicking->Code->EditValue ?>"<?php echo $vwhistoryPicking->Code->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($vwhistoryPicking->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $vwhistoryPicking_grid->RowCnt ?>_vwhistoryPicking_Code" class="vwhistoryPicking_Code">
<span<?php echo $vwhistoryPicking->Code->viewAttributes() ?>>
<?php echo $vwhistoryPicking->Code->getViewValue() ?></span>
</span>
<?php if (!$vwhistoryPicking->isConfirm()) { ?>
<input type="hidden" data-table="vwhistoryPicking" data-field="x_Code" name="x<?php echo $vwhistoryPicking_grid->RowIndex ?>_Code" id="x<?php echo $vwhistoryPicking_grid->RowIndex ?>_Code" value="<?php echo HtmlEncode($vwhistoryPicking->Code->FormValue) ?>">
<input type="hidden" data-table="vwhistoryPicking" data-field="x_Code" name="o<?php echo $vwhistoryPicking_grid->RowIndex ?>_Code" id="o<?php echo $vwhistoryPicking_grid->RowIndex ?>_Code" value="<?php echo HtmlEncode($vwhistoryPicking->Code->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="vwhistoryPicking" data-field="x_Code" name="fvwhistoryPickinggrid$x<?php echo $vwhistoryPicking_grid->RowIndex ?>_Code" id="fvwhistoryPickinggrid$x<?php echo $vwhistoryPicking_grid->RowIndex ?>_Code" value="<?php echo HtmlEncode($vwhistoryPicking->Code->FormValue) ?>">
<input type="hidden" data-table="vwhistoryPicking" data-field="x_Code" name="fvwhistoryPickinggrid$o<?php echo $vwhistoryPicking_grid->RowIndex ?>_Code" id="fvwhistoryPickinggrid$o<?php echo $vwhistoryPicking_grid->RowIndex ?>_Code" value="<?php echo HtmlEncode($vwhistoryPicking->Code->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($vwhistoryPicking->PCS->Visible) { // PCS ?>
		<td data-name="PCS"<?php echo $vwhistoryPicking->PCS->cellAttributes() ?>>
<?php if ($vwhistoryPicking->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $vwhistoryPicking_grid->RowCnt ?>_vwhistoryPicking_PCS" class="form-group vwhistoryPicking_PCS">
<input type="text" data-table="vwhistoryPicking" data-field="x_PCS" name="x<?php echo $vwhistoryPicking_grid->RowIndex ?>_PCS" id="x<?php echo $vwhistoryPicking_grid->RowIndex ?>_PCS" size="30" placeholder="<?php echo HtmlEncode($vwhistoryPicking->PCS->getPlaceHolder()) ?>" value="<?php echo $vwhistoryPicking->PCS->EditValue ?>"<?php echo $vwhistoryPicking->PCS->editAttributes() ?>>
</span>
<input type="hidden" data-table="vwhistoryPicking" data-field="x_PCS" name="o<?php echo $vwhistoryPicking_grid->RowIndex ?>_PCS" id="o<?php echo $vwhistoryPicking_grid->RowIndex ?>_PCS" value="<?php echo HtmlEncode($vwhistoryPicking->PCS->OldValue) ?>">
<?php } ?>
<?php if ($vwhistoryPicking->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $vwhistoryPicking_grid->RowCnt ?>_vwhistoryPicking_PCS" class="form-group vwhistoryPicking_PCS">
<input type="text" data-table="vwhistoryPicking" data-field="x_PCS" name="x<?php echo $vwhistoryPicking_grid->RowIndex ?>_PCS" id="x<?php echo $vwhistoryPicking_grid->RowIndex ?>_PCS" size="30" placeholder="<?php echo HtmlEncode($vwhistoryPicking->PCS->getPlaceHolder()) ?>" value="<?php echo $vwhistoryPicking->PCS->EditValue ?>"<?php echo $vwhistoryPicking->PCS->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($vwhistoryPicking->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $vwhistoryPicking_grid->RowCnt ?>_vwhistoryPicking_PCS" class="vwhistoryPicking_PCS">
<span<?php echo $vwhistoryPicking->PCS->viewAttributes() ?>>
<?php echo $vwhistoryPicking->PCS->getViewValue() ?></span>
</span>
<?php if (!$vwhistoryPicking->isConfirm()) { ?>
<input type="hidden" data-table="vwhistoryPicking" data-field="x_PCS" name="x<?php echo $vwhistoryPicking_grid->RowIndex ?>_PCS" id="x<?php echo $vwhistoryPicking_grid->RowIndex ?>_PCS" value="<?php echo HtmlEncode($vwhistoryPicking->PCS->FormValue) ?>">
<input type="hidden" data-table="vwhistoryPicking" data-field="x_PCS" name="o<?php echo $vwhistoryPicking_grid->RowIndex ?>_PCS" id="o<?php echo $vwhistoryPicking_grid->RowIndex ?>_PCS" value="<?php echo HtmlEncode($vwhistoryPicking->PCS->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="vwhistoryPicking" data-field="x_PCS" name="fvwhistoryPickinggrid$x<?php echo $vwhistoryPicking_grid->RowIndex ?>_PCS" id="fvwhistoryPickinggrid$x<?php echo $vwhistoryPicking_grid->RowIndex ?>_PCS" value="<?php echo HtmlEncode($vwhistoryPicking->PCS->FormValue) ?>">
<input type="hidden" data-table="vwhistoryPicking" data-field="x_PCS" name="fvwhistoryPickinggrid$o<?php echo $vwhistoryPicking_grid->RowIndex ?>_PCS" id="fvwhistoryPickinggrid$o<?php echo $vwhistoryPicking_grid->RowIndex ?>_PCS" value="<?php echo HtmlEncode($vwhistoryPicking->PCS->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($vwhistoryPicking->Location->Visible) { // Location ?>
		<td data-name="Location"<?php echo $vwhistoryPicking->Location->cellAttributes() ?>>
<?php if ($vwhistoryPicking->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $vwhistoryPicking_grid->RowCnt ?>_vwhistoryPicking_Location" class="form-group vwhistoryPicking_Location">
<input type="text" data-table="vwhistoryPicking" data-field="x_Location" name="x<?php echo $vwhistoryPicking_grid->RowIndex ?>_Location" id="x<?php echo $vwhistoryPicking_grid->RowIndex ?>_Location" size="30" maxlength="55" placeholder="<?php echo HtmlEncode($vwhistoryPicking->Location->getPlaceHolder()) ?>" value="<?php echo $vwhistoryPicking->Location->EditValue ?>"<?php echo $vwhistoryPicking->Location->editAttributes() ?>>
</span>
<input type="hidden" data-table="vwhistoryPicking" data-field="x_Location" name="o<?php echo $vwhistoryPicking_grid->RowIndex ?>_Location" id="o<?php echo $vwhistoryPicking_grid->RowIndex ?>_Location" value="<?php echo HtmlEncode($vwhistoryPicking->Location->OldValue) ?>">
<?php } ?>
<?php if ($vwhistoryPicking->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $vwhistoryPicking_grid->RowCnt ?>_vwhistoryPicking_Location" class="form-group vwhistoryPicking_Location">
<input type="text" data-table="vwhistoryPicking" data-field="x_Location" name="x<?php echo $vwhistoryPicking_grid->RowIndex ?>_Location" id="x<?php echo $vwhistoryPicking_grid->RowIndex ?>_Location" size="30" maxlength="55" placeholder="<?php echo HtmlEncode($vwhistoryPicking->Location->getPlaceHolder()) ?>" value="<?php echo $vwhistoryPicking->Location->EditValue ?>"<?php echo $vwhistoryPicking->Location->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($vwhistoryPicking->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $vwhistoryPicking_grid->RowCnt ?>_vwhistoryPicking_Location" class="vwhistoryPicking_Location">
<span<?php echo $vwhistoryPicking->Location->viewAttributes() ?>>
<?php echo $vwhistoryPicking->Location->getViewValue() ?></span>
</span>
<?php if (!$vwhistoryPicking->isConfirm()) { ?>
<input type="hidden" data-table="vwhistoryPicking" data-field="x_Location" name="x<?php echo $vwhistoryPicking_grid->RowIndex ?>_Location" id="x<?php echo $vwhistoryPicking_grid->RowIndex ?>_Location" value="<?php echo HtmlEncode($vwhistoryPicking->Location->FormValue) ?>">
<input type="hidden" data-table="vwhistoryPicking" data-field="x_Location" name="o<?php echo $vwhistoryPicking_grid->RowIndex ?>_Location" id="o<?php echo $vwhistoryPicking_grid->RowIndex ?>_Location" value="<?php echo HtmlEncode($vwhistoryPicking->Location->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="vwhistoryPicking" data-field="x_Location" name="fvwhistoryPickinggrid$x<?php echo $vwhistoryPicking_grid->RowIndex ?>_Location" id="fvwhistoryPickinggrid$x<?php echo $vwhistoryPicking_grid->RowIndex ?>_Location" value="<?php echo HtmlEncode($vwhistoryPicking->Location->FormValue) ?>">
<input type="hidden" data-table="vwhistoryPicking" data-field="x_Location" name="fvwhistoryPickinggrid$o<?php echo $vwhistoryPicking_grid->RowIndex ?>_Location" id="fvwhistoryPickinggrid$o<?php echo $vwhistoryPicking_grid->RowIndex ?>_Location" value="<?php echo HtmlEncode($vwhistoryPicking->Location->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($vwhistoryPicking->Box->Visible) { // Box ?>
		<td data-name="Box"<?php echo $vwhistoryPicking->Box->cellAttributes() ?>>
<?php if ($vwhistoryPicking->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $vwhistoryPicking_grid->RowCnt ?>_vwhistoryPicking_Box" class="form-group vwhistoryPicking_Box">
<input type="text" data-table="vwhistoryPicking" data-field="x_Box" name="x<?php echo $vwhistoryPicking_grid->RowIndex ?>_Box" id="x<?php echo $vwhistoryPicking_grid->RowIndex ?>_Box" size="30" placeholder="<?php echo HtmlEncode($vwhistoryPicking->Box->getPlaceHolder()) ?>" value="<?php echo $vwhistoryPicking->Box->EditValue ?>"<?php echo $vwhistoryPicking->Box->editAttributes() ?>>
</span>
<input type="hidden" data-table="vwhistoryPicking" data-field="x_Box" name="o<?php echo $vwhistoryPicking_grid->RowIndex ?>_Box" id="o<?php echo $vwhistoryPicking_grid->RowIndex ?>_Box" value="<?php echo HtmlEncode($vwhistoryPicking->Box->OldValue) ?>">
<?php } ?>
<?php if ($vwhistoryPicking->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $vwhistoryPicking_grid->RowCnt ?>_vwhistoryPicking_Box" class="form-group vwhistoryPicking_Box">
<input type="text" data-table="vwhistoryPicking" data-field="x_Box" name="x<?php echo $vwhistoryPicking_grid->RowIndex ?>_Box" id="x<?php echo $vwhistoryPicking_grid->RowIndex ?>_Box" size="30" placeholder="<?php echo HtmlEncode($vwhistoryPicking->Box->getPlaceHolder()) ?>" value="<?php echo $vwhistoryPicking->Box->EditValue ?>"<?php echo $vwhistoryPicking->Box->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($vwhistoryPicking->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $vwhistoryPicking_grid->RowCnt ?>_vwhistoryPicking_Box" class="vwhistoryPicking_Box">
<span<?php echo $vwhistoryPicking->Box->viewAttributes() ?>>
<?php echo $vwhistoryPicking->Box->getViewValue() ?></span>
</span>
<?php if (!$vwhistoryPicking->isConfirm()) { ?>
<input type="hidden" data-table="vwhistoryPicking" data-field="x_Box" name="x<?php echo $vwhistoryPicking_grid->RowIndex ?>_Box" id="x<?php echo $vwhistoryPicking_grid->RowIndex ?>_Box" value="<?php echo HtmlEncode($vwhistoryPicking->Box->FormValue) ?>">
<input type="hidden" data-table="vwhistoryPicking" data-field="x_Box" name="o<?php echo $vwhistoryPicking_grid->RowIndex ?>_Box" id="o<?php echo $vwhistoryPicking_grid->RowIndex ?>_Box" value="<?php echo HtmlEncode($vwhistoryPicking->Box->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="vwhistoryPicking" data-field="x_Box" name="fvwhistoryPickinggrid$x<?php echo $vwhistoryPicking_grid->RowIndex ?>_Box" id="fvwhistoryPickinggrid$x<?php echo $vwhistoryPicking_grid->RowIndex ?>_Box" value="<?php echo HtmlEncode($vwhistoryPicking->Box->FormValue) ?>">
<input type="hidden" data-table="vwhistoryPicking" data-field="x_Box" name="fvwhistoryPickinggrid$o<?php echo $vwhistoryPicking_grid->RowIndex ?>_Box" id="fvwhistoryPickinggrid$o<?php echo $vwhistoryPicking_grid->RowIndex ?>_Box" value="<?php echo HtmlEncode($vwhistoryPicking->Box->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($vwhistoryPicking->CreateUser->Visible) { // CreateUser ?>
		<td data-name="CreateUser"<?php echo $vwhistoryPicking->CreateUser->cellAttributes() ?>>
<?php if ($vwhistoryPicking->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $vwhistoryPicking_grid->RowCnt ?>_vwhistoryPicking_CreateUser" class="form-group vwhistoryPicking_CreateUser">
<input type="text" data-table="vwhistoryPicking" data-field="x_CreateUser" name="x<?php echo $vwhistoryPicking_grid->RowIndex ?>_CreateUser" id="x<?php echo $vwhistoryPicking_grid->RowIndex ?>_CreateUser" size="30" maxlength="50" placeholder="<?php echo HtmlEncode($vwhistoryPicking->CreateUser->getPlaceHolder()) ?>" value="<?php echo $vwhistoryPicking->CreateUser->EditValue ?>"<?php echo $vwhistoryPicking->CreateUser->editAttributes() ?>>
</span>
<input type="hidden" data-table="vwhistoryPicking" data-field="x_CreateUser" name="o<?php echo $vwhistoryPicking_grid->RowIndex ?>_CreateUser" id="o<?php echo $vwhistoryPicking_grid->RowIndex ?>_CreateUser" value="<?php echo HtmlEncode($vwhistoryPicking->CreateUser->OldValue) ?>">
<?php } ?>
<?php if ($vwhistoryPicking->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $vwhistoryPicking_grid->RowCnt ?>_vwhistoryPicking_CreateUser" class="form-group vwhistoryPicking_CreateUser">
<input type="text" data-table="vwhistoryPicking" data-field="x_CreateUser" name="x<?php echo $vwhistoryPicking_grid->RowIndex ?>_CreateUser" id="x<?php echo $vwhistoryPicking_grid->RowIndex ?>_CreateUser" size="30" maxlength="50" placeholder="<?php echo HtmlEncode($vwhistoryPicking->CreateUser->getPlaceHolder()) ?>" value="<?php echo $vwhistoryPicking->CreateUser->EditValue ?>"<?php echo $vwhistoryPicking->CreateUser->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($vwhistoryPicking->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $vwhistoryPicking_grid->RowCnt ?>_vwhistoryPicking_CreateUser" class="vwhistoryPicking_CreateUser">
<span<?php echo $vwhistoryPicking->CreateUser->viewAttributes() ?>>
<?php echo $vwhistoryPicking->CreateUser->getViewValue() ?></span>
</span>
<?php if (!$vwhistoryPicking->isConfirm()) { ?>
<input type="hidden" data-table="vwhistoryPicking" data-field="x_CreateUser" name="x<?php echo $vwhistoryPicking_grid->RowIndex ?>_CreateUser" id="x<?php echo $vwhistoryPicking_grid->RowIndex ?>_CreateUser" value="<?php echo HtmlEncode($vwhistoryPicking->CreateUser->FormValue) ?>">
<input type="hidden" data-table="vwhistoryPicking" data-field="x_CreateUser" name="o<?php echo $vwhistoryPicking_grid->RowIndex ?>_CreateUser" id="o<?php echo $vwhistoryPicking_grid->RowIndex ?>_CreateUser" value="<?php echo HtmlEncode($vwhistoryPicking->CreateUser->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="vwhistoryPicking" data-field="x_CreateUser" name="fvwhistoryPickinggrid$x<?php echo $vwhistoryPicking_grid->RowIndex ?>_CreateUser" id="fvwhistoryPickinggrid$x<?php echo $vwhistoryPicking_grid->RowIndex ?>_CreateUser" value="<?php echo HtmlEncode($vwhistoryPicking->CreateUser->FormValue) ?>">
<input type="hidden" data-table="vwhistoryPicking" data-field="x_CreateUser" name="fvwhistoryPickinggrid$o<?php echo $vwhistoryPicking_grid->RowIndex ?>_CreateUser" id="fvwhistoryPickinggrid$o<?php echo $vwhistoryPicking_grid->RowIndex ?>_CreateUser" value="<?php echo HtmlEncode($vwhistoryPicking->CreateUser->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($vwhistoryPicking->CreateDate->Visible) { // CreateDate ?>
		<td data-name="CreateDate"<?php echo $vwhistoryPicking->CreateDate->cellAttributes() ?>>
<?php if ($vwhistoryPicking->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $vwhistoryPicking_grid->RowCnt ?>_vwhistoryPicking_CreateDate" class="form-group vwhistoryPicking_CreateDate">
<input type="text" data-table="vwhistoryPicking" data-field="x_CreateDate" name="x<?php echo $vwhistoryPicking_grid->RowIndex ?>_CreateDate" id="x<?php echo $vwhistoryPicking_grid->RowIndex ?>_CreateDate" placeholder="<?php echo HtmlEncode($vwhistoryPicking->CreateDate->getPlaceHolder()) ?>" value="<?php echo $vwhistoryPicking->CreateDate->EditValue ?>"<?php echo $vwhistoryPicking->CreateDate->editAttributes() ?>>
<?php if (!$vwhistoryPicking->CreateDate->ReadOnly && !$vwhistoryPicking->CreateDate->Disabled && !isset($vwhistoryPicking->CreateDate->EditAttrs["readonly"]) && !isset($vwhistoryPicking->CreateDate->EditAttrs["disabled"])) { ?>
<script>
ew.createDateTimePicker("fvwhistoryPickinggrid", "x<?php echo $vwhistoryPicking_grid->RowIndex ?>_CreateDate", {"ignoreReadonly":true,"useCurrent":false,"format":0});
</script>
<?php } ?>
</span>
<input type="hidden" data-table="vwhistoryPicking" data-field="x_CreateDate" name="o<?php echo $vwhistoryPicking_grid->RowIndex ?>_CreateDate" id="o<?php echo $vwhistoryPicking_grid->RowIndex ?>_CreateDate" value="<?php echo HtmlEncode($vwhistoryPicking->CreateDate->OldValue) ?>">
<?php } ?>
<?php if ($vwhistoryPicking->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $vwhistoryPicking_grid->RowCnt ?>_vwhistoryPicking_CreateDate" class="form-group vwhistoryPicking_CreateDate">
<input type="text" data-table="vwhistoryPicking" data-field="x_CreateDate" name="x<?php echo $vwhistoryPicking_grid->RowIndex ?>_CreateDate" id="x<?php echo $vwhistoryPicking_grid->RowIndex ?>_CreateDate" placeholder="<?php echo HtmlEncode($vwhistoryPicking->CreateDate->getPlaceHolder()) ?>" value="<?php echo $vwhistoryPicking->CreateDate->EditValue ?>"<?php echo $vwhistoryPicking->CreateDate->editAttributes() ?>>
<?php if (!$vwhistoryPicking->CreateDate->ReadOnly && !$vwhistoryPicking->CreateDate->Disabled && !isset($vwhistoryPicking->CreateDate->EditAttrs["readonly"]) && !isset($vwhistoryPicking->CreateDate->EditAttrs["disabled"])) { ?>
<script>
ew.createDateTimePicker("fvwhistoryPickinggrid", "x<?php echo $vwhistoryPicking_grid->RowIndex ?>_CreateDate", {"ignoreReadonly":true,"useCurrent":false,"format":0});
</script>
<?php } ?>
</span>
<?php } ?>
<?php if ($vwhistoryPicking->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $vwhistoryPicking_grid->RowCnt ?>_vwhistoryPicking_CreateDate" class="vwhistoryPicking_CreateDate">
<span<?php echo $vwhistoryPicking->CreateDate->viewAttributes() ?>>
<?php echo $vwhistoryPicking->CreateDate->getViewValue() ?></span>
</span>
<?php if (!$vwhistoryPicking->isConfirm()) { ?>
<input type="hidden" data-table="vwhistoryPicking" data-field="x_CreateDate" name="x<?php echo $vwhistoryPicking_grid->RowIndex ?>_CreateDate" id="x<?php echo $vwhistoryPicking_grid->RowIndex ?>_CreateDate" value="<?php echo HtmlEncode($vwhistoryPicking->CreateDate->FormValue) ?>">
<input type="hidden" data-table="vwhistoryPicking" data-field="x_CreateDate" name="o<?php echo $vwhistoryPicking_grid->RowIndex ?>_CreateDate" id="o<?php echo $vwhistoryPicking_grid->RowIndex ?>_CreateDate" value="<?php echo HtmlEncode($vwhistoryPicking->CreateDate->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="vwhistoryPicking" data-field="x_CreateDate" name="fvwhistoryPickinggrid$x<?php echo $vwhistoryPicking_grid->RowIndex ?>_CreateDate" id="fvwhistoryPickinggrid$x<?php echo $vwhistoryPicking_grid->RowIndex ?>_CreateDate" value="<?php echo HtmlEncode($vwhistoryPicking->CreateDate->FormValue) ?>">
<input type="hidden" data-table="vwhistoryPicking" data-field="x_CreateDate" name="fvwhistoryPickinggrid$o<?php echo $vwhistoryPicking_grid->RowIndex ?>_CreateDate" id="fvwhistoryPickinggrid$o<?php echo $vwhistoryPicking_grid->RowIndex ?>_CreateDate" value="<?php echo HtmlEncode($vwhistoryPicking->CreateDate->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($vwhistoryPicking->UpdateUser->Visible) { // UpdateUser ?>
		<td data-name="UpdateUser"<?php echo $vwhistoryPicking->UpdateUser->cellAttributes() ?>>
<?php if ($vwhistoryPicking->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $vwhistoryPicking_grid->RowCnt ?>_vwhistoryPicking_UpdateUser" class="form-group vwhistoryPicking_UpdateUser">
<input type="text" data-table="vwhistoryPicking" data-field="x_UpdateUser" name="x<?php echo $vwhistoryPicking_grid->RowIndex ?>_UpdateUser" id="x<?php echo $vwhistoryPicking_grid->RowIndex ?>_UpdateUser" size="30" maxlength="50" placeholder="<?php echo HtmlEncode($vwhistoryPicking->UpdateUser->getPlaceHolder()) ?>" value="<?php echo $vwhistoryPicking->UpdateUser->EditValue ?>"<?php echo $vwhistoryPicking->UpdateUser->editAttributes() ?>>
</span>
<input type="hidden" data-table="vwhistoryPicking" data-field="x_UpdateUser" name="o<?php echo $vwhistoryPicking_grid->RowIndex ?>_UpdateUser" id="o<?php echo $vwhistoryPicking_grid->RowIndex ?>_UpdateUser" value="<?php echo HtmlEncode($vwhistoryPicking->UpdateUser->OldValue) ?>">
<?php } ?>
<?php if ($vwhistoryPicking->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $vwhistoryPicking_grid->RowCnt ?>_vwhistoryPicking_UpdateUser" class="form-group vwhistoryPicking_UpdateUser">
<input type="text" data-table="vwhistoryPicking" data-field="x_UpdateUser" name="x<?php echo $vwhistoryPicking_grid->RowIndex ?>_UpdateUser" id="x<?php echo $vwhistoryPicking_grid->RowIndex ?>_UpdateUser" size="30" maxlength="50" placeholder="<?php echo HtmlEncode($vwhistoryPicking->UpdateUser->getPlaceHolder()) ?>" value="<?php echo $vwhistoryPicking->UpdateUser->EditValue ?>"<?php echo $vwhistoryPicking->UpdateUser->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($vwhistoryPicking->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $vwhistoryPicking_grid->RowCnt ?>_vwhistoryPicking_UpdateUser" class="vwhistoryPicking_UpdateUser">
<span<?php echo $vwhistoryPicking->UpdateUser->viewAttributes() ?>>
<?php echo $vwhistoryPicking->UpdateUser->getViewValue() ?></span>
</span>
<?php if (!$vwhistoryPicking->isConfirm()) { ?>
<input type="hidden" data-table="vwhistoryPicking" data-field="x_UpdateUser" name="x<?php echo $vwhistoryPicking_grid->RowIndex ?>_UpdateUser" id="x<?php echo $vwhistoryPicking_grid->RowIndex ?>_UpdateUser" value="<?php echo HtmlEncode($vwhistoryPicking->UpdateUser->FormValue) ?>">
<input type="hidden" data-table="vwhistoryPicking" data-field="x_UpdateUser" name="o<?php echo $vwhistoryPicking_grid->RowIndex ?>_UpdateUser" id="o<?php echo $vwhistoryPicking_grid->RowIndex ?>_UpdateUser" value="<?php echo HtmlEncode($vwhistoryPicking->UpdateUser->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="vwhistoryPicking" data-field="x_UpdateUser" name="fvwhistoryPickinggrid$x<?php echo $vwhistoryPicking_grid->RowIndex ?>_UpdateUser" id="fvwhistoryPickinggrid$x<?php echo $vwhistoryPicking_grid->RowIndex ?>_UpdateUser" value="<?php echo HtmlEncode($vwhistoryPicking->UpdateUser->FormValue) ?>">
<input type="hidden" data-table="vwhistoryPicking" data-field="x_UpdateUser" name="fvwhistoryPickinggrid$o<?php echo $vwhistoryPicking_grid->RowIndex ?>_UpdateUser" id="fvwhistoryPickinggrid$o<?php echo $vwhistoryPicking_grid->RowIndex ?>_UpdateUser" value="<?php echo HtmlEncode($vwhistoryPicking->UpdateUser->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($vwhistoryPicking->UpdateDate->Visible) { // UpdateDate ?>
		<td data-name="UpdateDate"<?php echo $vwhistoryPicking->UpdateDate->cellAttributes() ?>>
<?php if ($vwhistoryPicking->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $vwhistoryPicking_grid->RowCnt ?>_vwhistoryPicking_UpdateDate" class="form-group vwhistoryPicking_UpdateDate">
<input type="text" data-table="vwhistoryPicking" data-field="x_UpdateDate" name="x<?php echo $vwhistoryPicking_grid->RowIndex ?>_UpdateDate" id="x<?php echo $vwhistoryPicking_grid->RowIndex ?>_UpdateDate" placeholder="<?php echo HtmlEncode($vwhistoryPicking->UpdateDate->getPlaceHolder()) ?>" value="<?php echo $vwhistoryPicking->UpdateDate->EditValue ?>"<?php echo $vwhistoryPicking->UpdateDate->editAttributes() ?>>
<?php if (!$vwhistoryPicking->UpdateDate->ReadOnly && !$vwhistoryPicking->UpdateDate->Disabled && !isset($vwhistoryPicking->UpdateDate->EditAttrs["readonly"]) && !isset($vwhistoryPicking->UpdateDate->EditAttrs["disabled"])) { ?>
<script>
ew.createDateTimePicker("fvwhistoryPickinggrid", "x<?php echo $vwhistoryPicking_grid->RowIndex ?>_UpdateDate", {"ignoreReadonly":true,"useCurrent":false,"format":0});
</script>
<?php } ?>
</span>
<input type="hidden" data-table="vwhistoryPicking" data-field="x_UpdateDate" name="o<?php echo $vwhistoryPicking_grid->RowIndex ?>_UpdateDate" id="o<?php echo $vwhistoryPicking_grid->RowIndex ?>_UpdateDate" value="<?php echo HtmlEncode($vwhistoryPicking->UpdateDate->OldValue) ?>">
<?php } ?>
<?php if ($vwhistoryPicking->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $vwhistoryPicking_grid->RowCnt ?>_vwhistoryPicking_UpdateDate" class="form-group vwhistoryPicking_UpdateDate">
<input type="text" data-table="vwhistoryPicking" data-field="x_UpdateDate" name="x<?php echo $vwhistoryPicking_grid->RowIndex ?>_UpdateDate" id="x<?php echo $vwhistoryPicking_grid->RowIndex ?>_UpdateDate" placeholder="<?php echo HtmlEncode($vwhistoryPicking->UpdateDate->getPlaceHolder()) ?>" value="<?php echo $vwhistoryPicking->UpdateDate->EditValue ?>"<?php echo $vwhistoryPicking->UpdateDate->editAttributes() ?>>
<?php if (!$vwhistoryPicking->UpdateDate->ReadOnly && !$vwhistoryPicking->UpdateDate->Disabled && !isset($vwhistoryPicking->UpdateDate->EditAttrs["readonly"]) && !isset($vwhistoryPicking->UpdateDate->EditAttrs["disabled"])) { ?>
<script>
ew.createDateTimePicker("fvwhistoryPickinggrid", "x<?php echo $vwhistoryPicking_grid->RowIndex ?>_UpdateDate", {"ignoreReadonly":true,"useCurrent":false,"format":0});
</script>
<?php } ?>
</span>
<?php } ?>
<?php if ($vwhistoryPicking->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $vwhistoryPicking_grid->RowCnt ?>_vwhistoryPicking_UpdateDate" class="vwhistoryPicking_UpdateDate">
<span<?php echo $vwhistoryPicking->UpdateDate->viewAttributes() ?>>
<?php echo $vwhistoryPicking->UpdateDate->getViewValue() ?></span>
</span>
<?php if (!$vwhistoryPicking->isConfirm()) { ?>
<input type="hidden" data-table="vwhistoryPicking" data-field="x_UpdateDate" name="x<?php echo $vwhistoryPicking_grid->RowIndex ?>_UpdateDate" id="x<?php echo $vwhistoryPicking_grid->RowIndex ?>_UpdateDate" value="<?php echo HtmlEncode($vwhistoryPicking->UpdateDate->FormValue) ?>">
<input type="hidden" data-table="vwhistoryPicking" data-field="x_UpdateDate" name="o<?php echo $vwhistoryPicking_grid->RowIndex ?>_UpdateDate" id="o<?php echo $vwhistoryPicking_grid->RowIndex ?>_UpdateDate" value="<?php echo HtmlEncode($vwhistoryPicking->UpdateDate->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="vwhistoryPicking" data-field="x_UpdateDate" name="fvwhistoryPickinggrid$x<?php echo $vwhistoryPicking_grid->RowIndex ?>_UpdateDate" id="fvwhistoryPickinggrid$x<?php echo $vwhistoryPicking_grid->RowIndex ?>_UpdateDate" value="<?php echo HtmlEncode($vwhistoryPicking->UpdateDate->FormValue) ?>">
<input type="hidden" data-table="vwhistoryPicking" data-field="x_UpdateDate" name="fvwhistoryPickinggrid$o<?php echo $vwhistoryPicking_grid->RowIndex ?>_UpdateDate" id="fvwhistoryPickinggrid$o<?php echo $vwhistoryPicking_grid->RowIndex ?>_UpdateDate" value="<?php echo HtmlEncode($vwhistoryPicking->UpdateDate->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($vwhistoryPicking->ID_Order->Visible) { // ID_Order ?>
		<td data-name="ID_Order"<?php echo $vwhistoryPicking->ID_Order->cellAttributes() ?>>
<?php if ($vwhistoryPicking->RowType == ROWTYPE_ADD) { // Add record ?>
<?php if ($vwhistoryPicking->ID_Order->getSessionValue() <> "") { ?>
<span id="el<?php echo $vwhistoryPicking_grid->RowCnt ?>_vwhistoryPicking_ID_Order" class="form-group vwhistoryPicking_ID_Order">
<span<?php echo $vwhistoryPicking->ID_Order->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?php echo RemoveHtml($vwhistoryPicking->ID_Order->ViewValue) ?>"></span>
</span>
<input type="hidden" id="x<?php echo $vwhistoryPicking_grid->RowIndex ?>_ID_Order" name="x<?php echo $vwhistoryPicking_grid->RowIndex ?>_ID_Order" value="<?php echo HtmlEncode($vwhistoryPicking->ID_Order->CurrentValue) ?>">
<?php } else { ?>
<span id="el<?php echo $vwhistoryPicking_grid->RowCnt ?>_vwhistoryPicking_ID_Order" class="form-group vwhistoryPicking_ID_Order">
<input type="text" data-table="vwhistoryPicking" data-field="x_ID_Order" name="x<?php echo $vwhistoryPicking_grid->RowIndex ?>_ID_Order" id="x<?php echo $vwhistoryPicking_grid->RowIndex ?>_ID_Order" size="30" placeholder="<?php echo HtmlEncode($vwhistoryPicking->ID_Order->getPlaceHolder()) ?>" value="<?php echo $vwhistoryPicking->ID_Order->EditValue ?>"<?php echo $vwhistoryPicking->ID_Order->editAttributes() ?>>
</span>
<?php } ?>
<input type="hidden" data-table="vwhistoryPicking" data-field="x_ID_Order" name="o<?php echo $vwhistoryPicking_grid->RowIndex ?>_ID_Order" id="o<?php echo $vwhistoryPicking_grid->RowIndex ?>_ID_Order" value="<?php echo HtmlEncode($vwhistoryPicking->ID_Order->OldValue) ?>">
<?php } ?>
<?php if ($vwhistoryPicking->RowType == ROWTYPE_EDIT) { // Edit record ?>
<?php if ($vwhistoryPicking->ID_Order->getSessionValue() <> "") { ?>
<span id="el<?php echo $vwhistoryPicking_grid->RowCnt ?>_vwhistoryPicking_ID_Order" class="form-group vwhistoryPicking_ID_Order">
<span<?php echo $vwhistoryPicking->ID_Order->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?php echo RemoveHtml($vwhistoryPicking->ID_Order->ViewValue) ?>"></span>
</span>
<input type="hidden" id="x<?php echo $vwhistoryPicking_grid->RowIndex ?>_ID_Order" name="x<?php echo $vwhistoryPicking_grid->RowIndex ?>_ID_Order" value="<?php echo HtmlEncode($vwhistoryPicking->ID_Order->CurrentValue) ?>">
<?php } else { ?>
<span id="el<?php echo $vwhistoryPicking_grid->RowCnt ?>_vwhistoryPicking_ID_Order" class="form-group vwhistoryPicking_ID_Order">
<input type="text" data-table="vwhistoryPicking" data-field="x_ID_Order" name="x<?php echo $vwhistoryPicking_grid->RowIndex ?>_ID_Order" id="x<?php echo $vwhistoryPicking_grid->RowIndex ?>_ID_Order" size="30" placeholder="<?php echo HtmlEncode($vwhistoryPicking->ID_Order->getPlaceHolder()) ?>" value="<?php echo $vwhistoryPicking->ID_Order->EditValue ?>"<?php echo $vwhistoryPicking->ID_Order->editAttributes() ?>>
</span>
<?php } ?>
<?php } ?>
<?php if ($vwhistoryPicking->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $vwhistoryPicking_grid->RowCnt ?>_vwhistoryPicking_ID_Order" class="vwhistoryPicking_ID_Order">
<span<?php echo $vwhistoryPicking->ID_Order->viewAttributes() ?>>
<?php echo $vwhistoryPicking->ID_Order->getViewValue() ?></span>
</span>
<?php if (!$vwhistoryPicking->isConfirm()) { ?>
<input type="hidden" data-table="vwhistoryPicking" data-field="x_ID_Order" name="x<?php echo $vwhistoryPicking_grid->RowIndex ?>_ID_Order" id="x<?php echo $vwhistoryPicking_grid->RowIndex ?>_ID_Order" value="<?php echo HtmlEncode($vwhistoryPicking->ID_Order->FormValue) ?>">
<input type="hidden" data-table="vwhistoryPicking" data-field="x_ID_Order" name="o<?php echo $vwhistoryPicking_grid->RowIndex ?>_ID_Order" id="o<?php echo $vwhistoryPicking_grid->RowIndex ?>_ID_Order" value="<?php echo HtmlEncode($vwhistoryPicking->ID_Order->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="vwhistoryPicking" data-field="x_ID_Order" name="fvwhistoryPickinggrid$x<?php echo $vwhistoryPicking_grid->RowIndex ?>_ID_Order" id="fvwhistoryPickinggrid$x<?php echo $vwhistoryPicking_grid->RowIndex ?>_ID_Order" value="<?php echo HtmlEncode($vwhistoryPicking->ID_Order->FormValue) ?>">
<input type="hidden" data-table="vwhistoryPicking" data-field="x_ID_Order" name="fvwhistoryPickinggrid$o<?php echo $vwhistoryPicking_grid->RowIndex ?>_ID_Order" id="fvwhistoryPickinggrid$o<?php echo $vwhistoryPicking_grid->RowIndex ?>_ID_Order" value="<?php echo HtmlEncode($vwhistoryPicking->ID_Order->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$vwhistoryPicking_grid->ListOptions->render("body", "right", $vwhistoryPicking_grid->RowCnt);
?>
	</tr>
<?php if ($vwhistoryPicking->RowType == ROWTYPE_ADD || $vwhistoryPicking->RowType == ROWTYPE_EDIT) { ?>
<script>
fvwhistoryPickinggrid.updateLists(<?php echo $vwhistoryPicking_grid->RowIndex ?>);
</script>
<?php } ?>
<?php
	}
	} // End delete row checking
	if (!$vwhistoryPicking->isGridAdd() || $vwhistoryPicking->CurrentMode == "copy")
		if (!$vwhistoryPicking_grid->Recordset->EOF)
			$vwhistoryPicking_grid->Recordset->moveNext();
}
?>
<?php
	if ($vwhistoryPicking->CurrentMode == "add" || $vwhistoryPicking->CurrentMode == "copy" || $vwhistoryPicking->CurrentMode == "edit") {
		$vwhistoryPicking_grid->RowIndex = '$rowindex$';
		$vwhistoryPicking_grid->loadRowValues();

		// Set row properties
		$vwhistoryPicking->resetAttributes();
		$vwhistoryPicking->RowAttrs = array_merge($vwhistoryPicking->RowAttrs, array('data-rowindex'=>$vwhistoryPicking_grid->RowIndex, 'id'=>'r0_vwhistoryPicking', 'data-rowtype'=>ROWTYPE_ADD));
		AppendClass($vwhistoryPicking->RowAttrs["class"], "ew-template");
		$vwhistoryPicking->RowType = ROWTYPE_ADD;

		// Render row
		$vwhistoryPicking_grid->renderRow();

		// Render list options
		$vwhistoryPicking_grid->renderListOptions();
		$vwhistoryPicking_grid->StartRowCnt = 0;
?>
	<tr<?php echo $vwhistoryPicking->rowAttributes() ?>>
<?php

// Render list options (body, left)
$vwhistoryPicking_grid->ListOptions->render("body", "left", $vwhistoryPicking_grid->RowIndex);
?>
	<?php if ($vwhistoryPicking->ID_His->Visible) { // ID_His ?>
		<td data-name="ID_His">
<?php if (!$vwhistoryPicking->isConfirm()) { ?>
<?php } else { ?>
<span id="el$rowindex$_vwhistoryPicking_ID_His" class="form-group vwhistoryPicking_ID_His">
<span<?php echo $vwhistoryPicking->ID_His->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?php echo RemoveHtml($vwhistoryPicking->ID_His->ViewValue) ?>"></span>
</span>
<input type="hidden" data-table="vwhistoryPicking" data-field="x_ID_His" name="x<?php echo $vwhistoryPicking_grid->RowIndex ?>_ID_His" id="x<?php echo $vwhistoryPicking_grid->RowIndex ?>_ID_His" value="<?php echo HtmlEncode($vwhistoryPicking->ID_His->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="vwhistoryPicking" data-field="x_ID_His" name="o<?php echo $vwhistoryPicking_grid->RowIndex ?>_ID_His" id="o<?php echo $vwhistoryPicking_grid->RowIndex ?>_ID_His" value="<?php echo HtmlEncode($vwhistoryPicking->ID_His->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($vwhistoryPicking->PalletID->Visible) { // PalletID ?>
		<td data-name="PalletID">
<?php if (!$vwhistoryPicking->isConfirm()) { ?>
<span id="el$rowindex$_vwhistoryPicking_PalletID" class="form-group vwhistoryPicking_PalletID">
<input type="text" data-table="vwhistoryPicking" data-field="x_PalletID" name="x<?php echo $vwhistoryPicking_grid->RowIndex ?>_PalletID" id="x<?php echo $vwhistoryPicking_grid->RowIndex ?>_PalletID" size="30" maxlength="50" placeholder="<?php echo HtmlEncode($vwhistoryPicking->PalletID->getPlaceHolder()) ?>" value="<?php echo $vwhistoryPicking->PalletID->EditValue ?>"<?php echo $vwhistoryPicking->PalletID->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_vwhistoryPicking_PalletID" class="form-group vwhistoryPicking_PalletID">
<span<?php echo $vwhistoryPicking->PalletID->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?php echo RemoveHtml($vwhistoryPicking->PalletID->ViewValue) ?>"></span>
</span>
<input type="hidden" data-table="vwhistoryPicking" data-field="x_PalletID" name="x<?php echo $vwhistoryPicking_grid->RowIndex ?>_PalletID" id="x<?php echo $vwhistoryPicking_grid->RowIndex ?>_PalletID" value="<?php echo HtmlEncode($vwhistoryPicking->PalletID->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="vwhistoryPicking" data-field="x_PalletID" name="o<?php echo $vwhistoryPicking_grid->RowIndex ?>_PalletID" id="o<?php echo $vwhistoryPicking_grid->RowIndex ?>_PalletID" value="<?php echo HtmlEncode($vwhistoryPicking->PalletID->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($vwhistoryPicking->Code->Visible) { // Code ?>
		<td data-name="Code">
<?php if (!$vwhistoryPicking->isConfirm()) { ?>
<span id="el$rowindex$_vwhistoryPicking_Code" class="form-group vwhistoryPicking_Code">
<input type="text" data-table="vwhistoryPicking" data-field="x_Code" name="x<?php echo $vwhistoryPicking_grid->RowIndex ?>_Code" id="x<?php echo $vwhistoryPicking_grid->RowIndex ?>_Code" size="30" maxlength="50" placeholder="<?php echo HtmlEncode($vwhistoryPicking->Code->getPlaceHolder()) ?>" value="<?php echo $vwhistoryPicking->Code->EditValue ?>"<?php echo $vwhistoryPicking->Code->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_vwhistoryPicking_Code" class="form-group vwhistoryPicking_Code">
<span<?php echo $vwhistoryPicking->Code->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?php echo RemoveHtml($vwhistoryPicking->Code->ViewValue) ?>"></span>
</span>
<input type="hidden" data-table="vwhistoryPicking" data-field="x_Code" name="x<?php echo $vwhistoryPicking_grid->RowIndex ?>_Code" id="x<?php echo $vwhistoryPicking_grid->RowIndex ?>_Code" value="<?php echo HtmlEncode($vwhistoryPicking->Code->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="vwhistoryPicking" data-field="x_Code" name="o<?php echo $vwhistoryPicking_grid->RowIndex ?>_Code" id="o<?php echo $vwhistoryPicking_grid->RowIndex ?>_Code" value="<?php echo HtmlEncode($vwhistoryPicking->Code->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($vwhistoryPicking->PCS->Visible) { // PCS ?>
		<td data-name="PCS">
<?php if (!$vwhistoryPicking->isConfirm()) { ?>
<span id="el$rowindex$_vwhistoryPicking_PCS" class="form-group vwhistoryPicking_PCS">
<input type="text" data-table="vwhistoryPicking" data-field="x_PCS" name="x<?php echo $vwhistoryPicking_grid->RowIndex ?>_PCS" id="x<?php echo $vwhistoryPicking_grid->RowIndex ?>_PCS" size="30" placeholder="<?php echo HtmlEncode($vwhistoryPicking->PCS->getPlaceHolder()) ?>" value="<?php echo $vwhistoryPicking->PCS->EditValue ?>"<?php echo $vwhistoryPicking->PCS->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_vwhistoryPicking_PCS" class="form-group vwhistoryPicking_PCS">
<span<?php echo $vwhistoryPicking->PCS->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?php echo RemoveHtml($vwhistoryPicking->PCS->ViewValue) ?>"></span>
</span>
<input type="hidden" data-table="vwhistoryPicking" data-field="x_PCS" name="x<?php echo $vwhistoryPicking_grid->RowIndex ?>_PCS" id="x<?php echo $vwhistoryPicking_grid->RowIndex ?>_PCS" value="<?php echo HtmlEncode($vwhistoryPicking->PCS->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="vwhistoryPicking" data-field="x_PCS" name="o<?php echo $vwhistoryPicking_grid->RowIndex ?>_PCS" id="o<?php echo $vwhistoryPicking_grid->RowIndex ?>_PCS" value="<?php echo HtmlEncode($vwhistoryPicking->PCS->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($vwhistoryPicking->Location->Visible) { // Location ?>
		<td data-name="Location">
<?php if (!$vwhistoryPicking->isConfirm()) { ?>
<span id="el$rowindex$_vwhistoryPicking_Location" class="form-group vwhistoryPicking_Location">
<input type="text" data-table="vwhistoryPicking" data-field="x_Location" name="x<?php echo $vwhistoryPicking_grid->RowIndex ?>_Location" id="x<?php echo $vwhistoryPicking_grid->RowIndex ?>_Location" size="30" maxlength="55" placeholder="<?php echo HtmlEncode($vwhistoryPicking->Location->getPlaceHolder()) ?>" value="<?php echo $vwhistoryPicking->Location->EditValue ?>"<?php echo $vwhistoryPicking->Location->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_vwhistoryPicking_Location" class="form-group vwhistoryPicking_Location">
<span<?php echo $vwhistoryPicking->Location->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?php echo RemoveHtml($vwhistoryPicking->Location->ViewValue) ?>"></span>
</span>
<input type="hidden" data-table="vwhistoryPicking" data-field="x_Location" name="x<?php echo $vwhistoryPicking_grid->RowIndex ?>_Location" id="x<?php echo $vwhistoryPicking_grid->RowIndex ?>_Location" value="<?php echo HtmlEncode($vwhistoryPicking->Location->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="vwhistoryPicking" data-field="x_Location" name="o<?php echo $vwhistoryPicking_grid->RowIndex ?>_Location" id="o<?php echo $vwhistoryPicking_grid->RowIndex ?>_Location" value="<?php echo HtmlEncode($vwhistoryPicking->Location->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($vwhistoryPicking->Box->Visible) { // Box ?>
		<td data-name="Box">
<?php if (!$vwhistoryPicking->isConfirm()) { ?>
<span id="el$rowindex$_vwhistoryPicking_Box" class="form-group vwhistoryPicking_Box">
<input type="text" data-table="vwhistoryPicking" data-field="x_Box" name="x<?php echo $vwhistoryPicking_grid->RowIndex ?>_Box" id="x<?php echo $vwhistoryPicking_grid->RowIndex ?>_Box" size="30" placeholder="<?php echo HtmlEncode($vwhistoryPicking->Box->getPlaceHolder()) ?>" value="<?php echo $vwhistoryPicking->Box->EditValue ?>"<?php echo $vwhistoryPicking->Box->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_vwhistoryPicking_Box" class="form-group vwhistoryPicking_Box">
<span<?php echo $vwhistoryPicking->Box->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?php echo RemoveHtml($vwhistoryPicking->Box->ViewValue) ?>"></span>
</span>
<input type="hidden" data-table="vwhistoryPicking" data-field="x_Box" name="x<?php echo $vwhistoryPicking_grid->RowIndex ?>_Box" id="x<?php echo $vwhistoryPicking_grid->RowIndex ?>_Box" value="<?php echo HtmlEncode($vwhistoryPicking->Box->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="vwhistoryPicking" data-field="x_Box" name="o<?php echo $vwhistoryPicking_grid->RowIndex ?>_Box" id="o<?php echo $vwhistoryPicking_grid->RowIndex ?>_Box" value="<?php echo HtmlEncode($vwhistoryPicking->Box->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($vwhistoryPicking->CreateUser->Visible) { // CreateUser ?>
		<td data-name="CreateUser">
<?php if (!$vwhistoryPicking->isConfirm()) { ?>
<span id="el$rowindex$_vwhistoryPicking_CreateUser" class="form-group vwhistoryPicking_CreateUser">
<input type="text" data-table="vwhistoryPicking" data-field="x_CreateUser" name="x<?php echo $vwhistoryPicking_grid->RowIndex ?>_CreateUser" id="x<?php echo $vwhistoryPicking_grid->RowIndex ?>_CreateUser" size="30" maxlength="50" placeholder="<?php echo HtmlEncode($vwhistoryPicking->CreateUser->getPlaceHolder()) ?>" value="<?php echo $vwhistoryPicking->CreateUser->EditValue ?>"<?php echo $vwhistoryPicking->CreateUser->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_vwhistoryPicking_CreateUser" class="form-group vwhistoryPicking_CreateUser">
<span<?php echo $vwhistoryPicking->CreateUser->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?php echo RemoveHtml($vwhistoryPicking->CreateUser->ViewValue) ?>"></span>
</span>
<input type="hidden" data-table="vwhistoryPicking" data-field="x_CreateUser" name="x<?php echo $vwhistoryPicking_grid->RowIndex ?>_CreateUser" id="x<?php echo $vwhistoryPicking_grid->RowIndex ?>_CreateUser" value="<?php echo HtmlEncode($vwhistoryPicking->CreateUser->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="vwhistoryPicking" data-field="x_CreateUser" name="o<?php echo $vwhistoryPicking_grid->RowIndex ?>_CreateUser" id="o<?php echo $vwhistoryPicking_grid->RowIndex ?>_CreateUser" value="<?php echo HtmlEncode($vwhistoryPicking->CreateUser->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($vwhistoryPicking->CreateDate->Visible) { // CreateDate ?>
		<td data-name="CreateDate">
<?php if (!$vwhistoryPicking->isConfirm()) { ?>
<span id="el$rowindex$_vwhistoryPicking_CreateDate" class="form-group vwhistoryPicking_CreateDate">
<input type="text" data-table="vwhistoryPicking" data-field="x_CreateDate" name="x<?php echo $vwhistoryPicking_grid->RowIndex ?>_CreateDate" id="x<?php echo $vwhistoryPicking_grid->RowIndex ?>_CreateDate" placeholder="<?php echo HtmlEncode($vwhistoryPicking->CreateDate->getPlaceHolder()) ?>" value="<?php echo $vwhistoryPicking->CreateDate->EditValue ?>"<?php echo $vwhistoryPicking->CreateDate->editAttributes() ?>>
<?php if (!$vwhistoryPicking->CreateDate->ReadOnly && !$vwhistoryPicking->CreateDate->Disabled && !isset($vwhistoryPicking->CreateDate->EditAttrs["readonly"]) && !isset($vwhistoryPicking->CreateDate->EditAttrs["disabled"])) { ?>
<script>
ew.createDateTimePicker("fvwhistoryPickinggrid", "x<?php echo $vwhistoryPicking_grid->RowIndex ?>_CreateDate", {"ignoreReadonly":true,"useCurrent":false,"format":0});
</script>
<?php } ?>
</span>
<?php } else { ?>
<span id="el$rowindex$_vwhistoryPicking_CreateDate" class="form-group vwhistoryPicking_CreateDate">
<span<?php echo $vwhistoryPicking->CreateDate->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?php echo RemoveHtml($vwhistoryPicking->CreateDate->ViewValue) ?>"></span>
</span>
<input type="hidden" data-table="vwhistoryPicking" data-field="x_CreateDate" name="x<?php echo $vwhistoryPicking_grid->RowIndex ?>_CreateDate" id="x<?php echo $vwhistoryPicking_grid->RowIndex ?>_CreateDate" value="<?php echo HtmlEncode($vwhistoryPicking->CreateDate->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="vwhistoryPicking" data-field="x_CreateDate" name="o<?php echo $vwhistoryPicking_grid->RowIndex ?>_CreateDate" id="o<?php echo $vwhistoryPicking_grid->RowIndex ?>_CreateDate" value="<?php echo HtmlEncode($vwhistoryPicking->CreateDate->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($vwhistoryPicking->UpdateUser->Visible) { // UpdateUser ?>
		<td data-name="UpdateUser">
<?php if (!$vwhistoryPicking->isConfirm()) { ?>
<span id="el$rowindex$_vwhistoryPicking_UpdateUser" class="form-group vwhistoryPicking_UpdateUser">
<input type="text" data-table="vwhistoryPicking" data-field="x_UpdateUser" name="x<?php echo $vwhistoryPicking_grid->RowIndex ?>_UpdateUser" id="x<?php echo $vwhistoryPicking_grid->RowIndex ?>_UpdateUser" size="30" maxlength="50" placeholder="<?php echo HtmlEncode($vwhistoryPicking->UpdateUser->getPlaceHolder()) ?>" value="<?php echo $vwhistoryPicking->UpdateUser->EditValue ?>"<?php echo $vwhistoryPicking->UpdateUser->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_vwhistoryPicking_UpdateUser" class="form-group vwhistoryPicking_UpdateUser">
<span<?php echo $vwhistoryPicking->UpdateUser->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?php echo RemoveHtml($vwhistoryPicking->UpdateUser->ViewValue) ?>"></span>
</span>
<input type="hidden" data-table="vwhistoryPicking" data-field="x_UpdateUser" name="x<?php echo $vwhistoryPicking_grid->RowIndex ?>_UpdateUser" id="x<?php echo $vwhistoryPicking_grid->RowIndex ?>_UpdateUser" value="<?php echo HtmlEncode($vwhistoryPicking->UpdateUser->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="vwhistoryPicking" data-field="x_UpdateUser" name="o<?php echo $vwhistoryPicking_grid->RowIndex ?>_UpdateUser" id="o<?php echo $vwhistoryPicking_grid->RowIndex ?>_UpdateUser" value="<?php echo HtmlEncode($vwhistoryPicking->UpdateUser->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($vwhistoryPicking->UpdateDate->Visible) { // UpdateDate ?>
		<td data-name="UpdateDate">
<?php if (!$vwhistoryPicking->isConfirm()) { ?>
<span id="el$rowindex$_vwhistoryPicking_UpdateDate" class="form-group vwhistoryPicking_UpdateDate">
<input type="text" data-table="vwhistoryPicking" data-field="x_UpdateDate" name="x<?php echo $vwhistoryPicking_grid->RowIndex ?>_UpdateDate" id="x<?php echo $vwhistoryPicking_grid->RowIndex ?>_UpdateDate" placeholder="<?php echo HtmlEncode($vwhistoryPicking->UpdateDate->getPlaceHolder()) ?>" value="<?php echo $vwhistoryPicking->UpdateDate->EditValue ?>"<?php echo $vwhistoryPicking->UpdateDate->editAttributes() ?>>
<?php if (!$vwhistoryPicking->UpdateDate->ReadOnly && !$vwhistoryPicking->UpdateDate->Disabled && !isset($vwhistoryPicking->UpdateDate->EditAttrs["readonly"]) && !isset($vwhistoryPicking->UpdateDate->EditAttrs["disabled"])) { ?>
<script>
ew.createDateTimePicker("fvwhistoryPickinggrid", "x<?php echo $vwhistoryPicking_grid->RowIndex ?>_UpdateDate", {"ignoreReadonly":true,"useCurrent":false,"format":0});
</script>
<?php } ?>
</span>
<?php } else { ?>
<span id="el$rowindex$_vwhistoryPicking_UpdateDate" class="form-group vwhistoryPicking_UpdateDate">
<span<?php echo $vwhistoryPicking->UpdateDate->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?php echo RemoveHtml($vwhistoryPicking->UpdateDate->ViewValue) ?>"></span>
</span>
<input type="hidden" data-table="vwhistoryPicking" data-field="x_UpdateDate" name="x<?php echo $vwhistoryPicking_grid->RowIndex ?>_UpdateDate" id="x<?php echo $vwhistoryPicking_grid->RowIndex ?>_UpdateDate" value="<?php echo HtmlEncode($vwhistoryPicking->UpdateDate->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="vwhistoryPicking" data-field="x_UpdateDate" name="o<?php echo $vwhistoryPicking_grid->RowIndex ?>_UpdateDate" id="o<?php echo $vwhistoryPicking_grid->RowIndex ?>_UpdateDate" value="<?php echo HtmlEncode($vwhistoryPicking->UpdateDate->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($vwhistoryPicking->ID_Order->Visible) { // ID_Order ?>
		<td data-name="ID_Order">
<?php if (!$vwhistoryPicking->isConfirm()) { ?>
<?php if ($vwhistoryPicking->ID_Order->getSessionValue() <> "") { ?>
<span id="el$rowindex$_vwhistoryPicking_ID_Order" class="form-group vwhistoryPicking_ID_Order">
<span<?php echo $vwhistoryPicking->ID_Order->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?php echo RemoveHtml($vwhistoryPicking->ID_Order->ViewValue) ?>"></span>
</span>
<input type="hidden" id="x<?php echo $vwhistoryPicking_grid->RowIndex ?>_ID_Order" name="x<?php echo $vwhistoryPicking_grid->RowIndex ?>_ID_Order" value="<?php echo HtmlEncode($vwhistoryPicking->ID_Order->CurrentValue) ?>">
<?php } else { ?>
<span id="el$rowindex$_vwhistoryPicking_ID_Order" class="form-group vwhistoryPicking_ID_Order">
<input type="text" data-table="vwhistoryPicking" data-field="x_ID_Order" name="x<?php echo $vwhistoryPicking_grid->RowIndex ?>_ID_Order" id="x<?php echo $vwhistoryPicking_grid->RowIndex ?>_ID_Order" size="30" placeholder="<?php echo HtmlEncode($vwhistoryPicking->ID_Order->getPlaceHolder()) ?>" value="<?php echo $vwhistoryPicking->ID_Order->EditValue ?>"<?php echo $vwhistoryPicking->ID_Order->editAttributes() ?>>
</span>
<?php } ?>
<?php } else { ?>
<span id="el$rowindex$_vwhistoryPicking_ID_Order" class="form-group vwhistoryPicking_ID_Order">
<span<?php echo $vwhistoryPicking->ID_Order->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?php echo RemoveHtml($vwhistoryPicking->ID_Order->ViewValue) ?>"></span>
</span>
<input type="hidden" data-table="vwhistoryPicking" data-field="x_ID_Order" name="x<?php echo $vwhistoryPicking_grid->RowIndex ?>_ID_Order" id="x<?php echo $vwhistoryPicking_grid->RowIndex ?>_ID_Order" value="<?php echo HtmlEncode($vwhistoryPicking->ID_Order->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="vwhistoryPicking" data-field="x_ID_Order" name="o<?php echo $vwhistoryPicking_grid->RowIndex ?>_ID_Order" id="o<?php echo $vwhistoryPicking_grid->RowIndex ?>_ID_Order" value="<?php echo HtmlEncode($vwhistoryPicking->ID_Order->OldValue) ?>">
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$vwhistoryPicking_grid->ListOptions->render("body", "right", $vwhistoryPicking_grid->RowIndex);
?>
<script>
fvwhistoryPickinggrid.updateLists(<?php echo $vwhistoryPicking_grid->RowIndex ?>);
</script>
	</tr>
<?php
}
?>
</tbody>
</table><!-- /.ew-table -->
<?php if ($vwhistoryPicking->CurrentMode == "add" || $vwhistoryPicking->CurrentMode == "copy") { ?>
<input type="hidden" name="<?php echo $vwhistoryPicking_grid->FormKeyCountName ?>" id="<?php echo $vwhistoryPicking_grid->FormKeyCountName ?>" value="<?php echo $vwhistoryPicking_grid->KeyCount ?>">
<?php echo $vwhistoryPicking_grid->MultiSelectKey ?>
<?php } ?>
<?php if ($vwhistoryPicking->CurrentMode == "edit") { ?>
<input type="hidden" name="<?php echo $vwhistoryPicking_grid->FormKeyCountName ?>" id="<?php echo $vwhistoryPicking_grid->FormKeyCountName ?>" value="<?php echo $vwhistoryPicking_grid->KeyCount ?>">
<?php echo $vwhistoryPicking_grid->MultiSelectKey ?>
<?php } ?>
<?php if ($vwhistoryPicking->CurrentMode == "") { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
<input type="hidden" name="detailpage" value="fvwhistoryPickinggrid">
</div><!-- /.ew-grid-middle-panel -->
<?php

// Close recordset
if ($vwhistoryPicking_grid->Recordset)
	$vwhistoryPicking_grid->Recordset->Close();
?>
</div>
<?php if ($vwhistoryPicking_grid->ShowOtherOptions) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php $vwhistoryPicking_grid->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($vwhistoryPicking_grid->TotalRecs == 0 && !$vwhistoryPicking->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $vwhistoryPicking_grid->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$vwhistoryPicking_grid->terminate();
?>