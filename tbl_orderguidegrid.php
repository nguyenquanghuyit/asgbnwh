<?php
namespace PHPMaker2019\asgbn_wh;

// Write header
WriteHeader(FALSE);

// Create page object
if (!isset($tbl_orderguide_grid))
	$tbl_orderguide_grid = new tbl_orderguide_grid();

// Run the page
$tbl_orderguide_grid->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$tbl_orderguide_grid->Page_Render();
?>
<?php if (!$tbl_orderguide->isExport()) { ?>
<script>

// Form object
var ftbl_orderguidegrid = new ew.Form("ftbl_orderguidegrid", "grid");
ftbl_orderguidegrid.formKeyCountName = '<?php echo $tbl_orderguide_grid->FormKeyCountName ?>';

// Validate form
ftbl_orderguidegrid.validate = function() {
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
		<?php if ($tbl_orderguide_grid->Code->Required) { ?>
			elm = this.getElements("x" + infix + "_Code");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $tbl_orderguide->Code->caption(), $tbl_orderguide->Code->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($tbl_orderguide_grid->ProductName->Required) { ?>
			elm = this.getElements("x" + infix + "_ProductName");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $tbl_orderguide->ProductName->caption(), $tbl_orderguide->ProductName->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($tbl_orderguide_grid->PCS_In->Required) { ?>
			elm = this.getElements("x" + infix + "_PCS_In");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $tbl_orderguide->PCS_In->caption(), $tbl_orderguide->PCS_In->RequiredErrorMessage)) ?>");
		<?php } ?>
			elm = this.getElements("x" + infix + "_PCS_In");
			if (elm && !ew.checkInteger(elm.value))
				return this.onError(elm, "<?php echo JsEncode($tbl_orderguide->PCS_In->errorMessage()) ?>");
		<?php if ($tbl_orderguide_grid->PCS->Required) { ?>
			elm = this.getElements("x" + infix + "_PCS");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $tbl_orderguide->PCS->caption(), $tbl_orderguide->PCS->RequiredErrorMessage)) ?>");
		<?php } ?>
			elm = this.getElements("x" + infix + "_PCS");
			if (elm && !ew.checkInteger(elm.value))
				return this.onError(elm, "<?php echo JsEncode($tbl_orderguide->PCS->errorMessage()) ?>");
		<?php if ($tbl_orderguide_grid->Qty->Required) { ?>
			elm = this.getElements("x" + infix + "_Qty");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $tbl_orderguide->Qty->caption(), $tbl_orderguide->Qty->RequiredErrorMessage)) ?>");
		<?php } ?>
			elm = this.getElements("x" + infix + "_Qty");
			if (elm && !ew.checkInteger(elm.value))
				return this.onError(elm, "<?php echo JsEncode($tbl_orderguide->Qty->errorMessage()) ?>");
		<?php if ($tbl_orderguide_grid->Box->Required) { ?>
			elm = this.getElements("x" + infix + "_Box");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $tbl_orderguide->Box->caption(), $tbl_orderguide->Box->RequiredErrorMessage)) ?>");
		<?php } ?>
			elm = this.getElements("x" + infix + "_Box");
			if (elm && !ew.checkInteger(elm.value))
				return this.onError(elm, "<?php echo JsEncode($tbl_orderguide->Box->errorMessage()) ?>");
		<?php if ($tbl_orderguide_grid->ID_Location->Required) { ?>
			elm = this.getElements("x" + infix + "_ID_Location");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $tbl_orderguide->ID_Location->caption(), $tbl_orderguide->ID_Location->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($tbl_orderguide_grid->PalletID->Required) { ?>
			elm = this.getElements("x" + infix + "_PalletID");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $tbl_orderguide->PalletID->caption(), $tbl_orderguide->PalletID->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($tbl_orderguide_grid->MFG->Required) { ?>
			elm = this.getElements("x" + infix + "_MFG");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $tbl_orderguide->MFG->caption(), $tbl_orderguide->MFG->RequiredErrorMessage)) ?>");
		<?php } ?>
			elm = this.getElements("x" + infix + "_MFG");
			if (elm && !ew.checkEuroDate(elm.value))
				return this.onError(elm, "<?php echo JsEncode($tbl_orderguide->MFG->errorMessage()) ?>");
		<?php if ($tbl_orderguide_grid->DateIn->Required) { ?>
			elm = this.getElements("x" + infix + "_DateIn");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $tbl_orderguide->DateIn->caption(), $tbl_orderguide->DateIn->RequiredErrorMessage)) ?>");
		<?php } ?>
			elm = this.getElements("x" + infix + "_DateIn");
			if (elm && !ew.checkEuroDate(elm.value))
				return this.onError(elm, "<?php echo JsEncode($tbl_orderguide->DateIn->errorMessage()) ?>");
		<?php if ($tbl_orderguide_grid->CreateDate->Required) { ?>
			elm = this.getElements("x" + infix + "_CreateDate");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $tbl_orderguide->CreateDate->caption(), $tbl_orderguide->CreateDate->RequiredErrorMessage)) ?>");
		<?php } ?>

			// Fire Form_CustomValidate event
			if (!this.Form_CustomValidate(fobj))
				return false;
		} // End Grid Add checking
	}
	return true;
}

// Check empty row
ftbl_orderguidegrid.emptyRow = function(infix) {
	var fobj = this._form;
	if (ew.valueChanged(fobj, infix, "Code", false)) return false;
	if (ew.valueChanged(fobj, infix, "ProductName", false)) return false;
	if (ew.valueChanged(fobj, infix, "PCS_In", false)) return false;
	if (ew.valueChanged(fobj, infix, "PCS", false)) return false;
	if (ew.valueChanged(fobj, infix, "Qty", false)) return false;
	if (ew.valueChanged(fobj, infix, "Box", false)) return false;
	if (ew.valueChanged(fobj, infix, "ID_Location", false)) return false;
	if (ew.valueChanged(fobj, infix, "PalletID", false)) return false;
	if (ew.valueChanged(fobj, infix, "MFG", false)) return false;
	if (ew.valueChanged(fobj, infix, "DateIn", false)) return false;
	return true;
}

// Form_CustomValidate event
ftbl_orderguidegrid.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

	// Your custom validation code here, return false if invalid.
	return true;
}

// Use JavaScript validation or not
ftbl_orderguidegrid.validateRequired = <?php echo json_encode(CLIENT_VALIDATE) ?>;

// Dynamic selection lists
ftbl_orderguidegrid.lists["x_ID_Location"] = <?php echo $tbl_orderguide_grid->ID_Location->Lookup->toClientList() ?>;
ftbl_orderguidegrid.lists["x_ID_Location"].options = <?php echo JsonEncode($tbl_orderguide_grid->ID_Location->lookupOptions()) ?>;
ftbl_orderguidegrid.autoSuggests["x_ID_Location"] = <?php echo json_encode(["data" => "ajax=autosuggest"]) ?>;

// Form object for search
</script>
<?php } ?>
<?php
$tbl_orderguide_grid->renderOtherOptions();
?>
<?php $tbl_orderguide_grid->showPageHeader(); ?>
<?php
$tbl_orderguide_grid->showMessage();
?>
<?php if ($tbl_orderguide_grid->TotalRecs > 0 || $tbl_orderguide->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($tbl_orderguide_grid->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> tbl_orderguide">
<?php if ($tbl_orderguide_grid->ShowOtherOptions) { ?>
<div class="card-header ew-grid-upper-panel">
<?php $tbl_orderguide_grid->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<div id="ftbl_orderguidegrid" class="ew-form ew-list-form form-inline">
<div id="gmp_tbl_orderguide" class="<?php if (IsResponsiveLayout()) { ?>table-responsive <?php } ?>card-body ew-grid-middle-panel">
<table id="tbl_tbl_orderguidegrid" class="table ew-table"><!-- .ew-table ##-->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$tbl_orderguide_grid->RowType = ROWTYPE_HEADER;

// Render list options
$tbl_orderguide_grid->renderListOptions();

// Render list options (header, left)
$tbl_orderguide_grid->ListOptions->render("header", "left");
?>
<?php if ($tbl_orderguide->Code->Visible) { // Code ?>
	<?php if ($tbl_orderguide->sortUrl($tbl_orderguide->Code) == "") { ?>
		<th data-name="Code" class="<?php echo $tbl_orderguide->Code->headerCellClass() ?>" style="width: 50px; white-space: nowrap;"><div id="elh_tbl_orderguide_Code" class="tbl_orderguide_Code"><div class="ew-table-header-caption"><?php echo $tbl_orderguide->Code->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Code" class="<?php echo $tbl_orderguide->Code->headerCellClass() ?>" style="width: 50px; white-space: nowrap;"><div><div id="elh_tbl_orderguide_Code" class="tbl_orderguide_Code">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $tbl_orderguide->Code->caption() ?></span><span class="ew-table-header-sort"><?php if ($tbl_orderguide->Code->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($tbl_orderguide->Code->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($tbl_orderguide->ProductName->Visible) { // ProductName ?>
	<?php if ($tbl_orderguide->sortUrl($tbl_orderguide->ProductName) == "") { ?>
		<th data-name="ProductName" class="<?php echo $tbl_orderguide->ProductName->headerCellClass() ?>" style="width: 150px; white-space: nowrap;"><div id="elh_tbl_orderguide_ProductName" class="tbl_orderguide_ProductName"><div class="ew-table-header-caption"><?php echo $tbl_orderguide->ProductName->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="ProductName" class="<?php echo $tbl_orderguide->ProductName->headerCellClass() ?>" style="width: 150px; white-space: nowrap;"><div><div id="elh_tbl_orderguide_ProductName" class="tbl_orderguide_ProductName">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $tbl_orderguide->ProductName->caption() ?></span><span class="ew-table-header-sort"><?php if ($tbl_orderguide->ProductName->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($tbl_orderguide->ProductName->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($tbl_orderguide->PCS_In->Visible) { // PCS_In ?>
	<?php if ($tbl_orderguide->sortUrl($tbl_orderguide->PCS_In) == "") { ?>
		<th data-name="PCS_In" class="<?php echo $tbl_orderguide->PCS_In->headerCellClass() ?>" style="width: 5px; white-space: nowrap;"><div id="elh_tbl_orderguide_PCS_In" class="tbl_orderguide_PCS_In"><div class="ew-table-header-caption"><?php echo $tbl_orderguide->PCS_In->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="PCS_In" class="<?php echo $tbl_orderguide->PCS_In->headerCellClass() ?>" style="width: 5px; white-space: nowrap;"><div><div id="elh_tbl_orderguide_PCS_In" class="tbl_orderguide_PCS_In">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $tbl_orderguide->PCS_In->caption() ?></span><span class="ew-table-header-sort"><?php if ($tbl_orderguide->PCS_In->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($tbl_orderguide->PCS_In->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($tbl_orderguide->PCS->Visible) { // PCS ?>
	<?php if ($tbl_orderguide->sortUrl($tbl_orderguide->PCS) == "") { ?>
		<th data-name="PCS" class="<?php echo $tbl_orderguide->PCS->headerCellClass() ?>" style="width: 5px; white-space: nowrap;"><div id="elh_tbl_orderguide_PCS" class="tbl_orderguide_PCS"><div class="ew-table-header-caption"><?php echo $tbl_orderguide->PCS->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="PCS" class="<?php echo $tbl_orderguide->PCS->headerCellClass() ?>" style="width: 5px; white-space: nowrap;"><div><div id="elh_tbl_orderguide_PCS" class="tbl_orderguide_PCS">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $tbl_orderguide->PCS->caption() ?></span><span class="ew-table-header-sort"><?php if ($tbl_orderguide->PCS->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($tbl_orderguide->PCS->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($tbl_orderguide->Qty->Visible) { // Qty ?>
	<?php if ($tbl_orderguide->sortUrl($tbl_orderguide->Qty) == "") { ?>
		<th data-name="Qty" class="<?php echo $tbl_orderguide->Qty->headerCellClass() ?>" style="white-space: nowrap;"><div id="elh_tbl_orderguide_Qty" class="tbl_orderguide_Qty"><div class="ew-table-header-caption"><?php echo $tbl_orderguide->Qty->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Qty" class="<?php echo $tbl_orderguide->Qty->headerCellClass() ?>" style="white-space: nowrap;"><div><div id="elh_tbl_orderguide_Qty" class="tbl_orderguide_Qty">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $tbl_orderguide->Qty->caption() ?></span><span class="ew-table-header-sort"><?php if ($tbl_orderguide->Qty->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($tbl_orderguide->Qty->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($tbl_orderguide->Box->Visible) { // Box ?>
	<?php if ($tbl_orderguide->sortUrl($tbl_orderguide->Box) == "") { ?>
		<th data-name="Box" class="<?php echo $tbl_orderguide->Box->headerCellClass() ?>" style="white-space: nowrap;"><div id="elh_tbl_orderguide_Box" class="tbl_orderguide_Box"><div class="ew-table-header-caption"><?php echo $tbl_orderguide->Box->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Box" class="<?php echo $tbl_orderguide->Box->headerCellClass() ?>" style="white-space: nowrap;"><div><div id="elh_tbl_orderguide_Box" class="tbl_orderguide_Box">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $tbl_orderguide->Box->caption() ?></span><span class="ew-table-header-sort"><?php if ($tbl_orderguide->Box->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($tbl_orderguide->Box->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($tbl_orderguide->ID_Location->Visible) { // ID_Location ?>
	<?php if ($tbl_orderguide->sortUrl($tbl_orderguide->ID_Location) == "") { ?>
		<th data-name="ID_Location" class="<?php echo $tbl_orderguide->ID_Location->headerCellClass() ?>" style="white-space: nowrap;"><div id="elh_tbl_orderguide_ID_Location" class="tbl_orderguide_ID_Location"><div class="ew-table-header-caption"><?php echo $tbl_orderguide->ID_Location->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="ID_Location" class="<?php echo $tbl_orderguide->ID_Location->headerCellClass() ?>" style="white-space: nowrap;"><div><div id="elh_tbl_orderguide_ID_Location" class="tbl_orderguide_ID_Location">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $tbl_orderguide->ID_Location->caption() ?></span><span class="ew-table-header-sort"><?php if ($tbl_orderguide->ID_Location->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($tbl_orderguide->ID_Location->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($tbl_orderguide->PalletID->Visible) { // PalletID ?>
	<?php if ($tbl_orderguide->sortUrl($tbl_orderguide->PalletID) == "") { ?>
		<th data-name="PalletID" class="<?php echo $tbl_orderguide->PalletID->headerCellClass() ?>" style="width: 50px; white-space: nowrap;"><div id="elh_tbl_orderguide_PalletID" class="tbl_orderguide_PalletID"><div class="ew-table-header-caption"><?php echo $tbl_orderguide->PalletID->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="PalletID" class="<?php echo $tbl_orderguide->PalletID->headerCellClass() ?>" style="width: 50px; white-space: nowrap;"><div><div id="elh_tbl_orderguide_PalletID" class="tbl_orderguide_PalletID">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $tbl_orderguide->PalletID->caption() ?></span><span class="ew-table-header-sort"><?php if ($tbl_orderguide->PalletID->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($tbl_orderguide->PalletID->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($tbl_orderguide->MFG->Visible) { // MFG ?>
	<?php if ($tbl_orderguide->sortUrl($tbl_orderguide->MFG) == "") { ?>
		<th data-name="MFG" class="<?php echo $tbl_orderguide->MFG->headerCellClass() ?>" style="white-space: nowrap;"><div id="elh_tbl_orderguide_MFG" class="tbl_orderguide_MFG"><div class="ew-table-header-caption"><?php echo $tbl_orderguide->MFG->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="MFG" class="<?php echo $tbl_orderguide->MFG->headerCellClass() ?>" style="white-space: nowrap;"><div><div id="elh_tbl_orderguide_MFG" class="tbl_orderguide_MFG">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $tbl_orderguide->MFG->caption() ?></span><span class="ew-table-header-sort"><?php if ($tbl_orderguide->MFG->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($tbl_orderguide->MFG->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($tbl_orderguide->DateIn->Visible) { // DateIn ?>
	<?php if ($tbl_orderguide->sortUrl($tbl_orderguide->DateIn) == "") { ?>
		<th data-name="DateIn" class="<?php echo $tbl_orderguide->DateIn->headerCellClass() ?>" style="white-space: nowrap;"><div id="elh_tbl_orderguide_DateIn" class="tbl_orderguide_DateIn"><div class="ew-table-header-caption"><?php echo $tbl_orderguide->DateIn->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="DateIn" class="<?php echo $tbl_orderguide->DateIn->headerCellClass() ?>" style="white-space: nowrap;"><div><div id="elh_tbl_orderguide_DateIn" class="tbl_orderguide_DateIn">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $tbl_orderguide->DateIn->caption() ?></span><span class="ew-table-header-sort"><?php if ($tbl_orderguide->DateIn->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($tbl_orderguide->DateIn->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($tbl_orderguide->CreateDate->Visible) { // CreateDate ?>
	<?php if ($tbl_orderguide->sortUrl($tbl_orderguide->CreateDate) == "") { ?>
		<th data-name="CreateDate" class="<?php echo $tbl_orderguide->CreateDate->headerCellClass() ?>" style="white-space: nowrap;"><div id="elh_tbl_orderguide_CreateDate" class="tbl_orderguide_CreateDate"><div class="ew-table-header-caption"><?php echo $tbl_orderguide->CreateDate->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="CreateDate" class="<?php echo $tbl_orderguide->CreateDate->headerCellClass() ?>" style="white-space: nowrap;"><div><div id="elh_tbl_orderguide_CreateDate" class="tbl_orderguide_CreateDate">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $tbl_orderguide->CreateDate->caption() ?></span><span class="ew-table-header-sort"><?php if ($tbl_orderguide->CreateDate->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($tbl_orderguide->CreateDate->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$tbl_orderguide_grid->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
$tbl_orderguide_grid->StartRec = 1;
$tbl_orderguide_grid->StopRec = $tbl_orderguide_grid->TotalRecs; // Show all records

// Restore number of post back records
if ($CurrentForm && $tbl_orderguide_grid->EventCancelled) {
	$CurrentForm->Index = -1;
	if ($CurrentForm->hasValue($tbl_orderguide_grid->FormKeyCountName) && ($tbl_orderguide->isGridAdd() || $tbl_orderguide->isGridEdit() || $tbl_orderguide->isConfirm())) {
		$tbl_orderguide_grid->KeyCount = $CurrentForm->getValue($tbl_orderguide_grid->FormKeyCountName);
		$tbl_orderguide_grid->StopRec = $tbl_orderguide_grid->StartRec + $tbl_orderguide_grid->KeyCount - 1;
	}
}
$tbl_orderguide_grid->RecCnt = $tbl_orderguide_grid->StartRec - 1;
if ($tbl_orderguide_grid->Recordset && !$tbl_orderguide_grid->Recordset->EOF) {
	$tbl_orderguide_grid->Recordset->moveFirst();
	$selectLimit = $tbl_orderguide_grid->UseSelectLimit;
	if (!$selectLimit && $tbl_orderguide_grid->StartRec > 1)
		$tbl_orderguide_grid->Recordset->move($tbl_orderguide_grid->StartRec - 1);
} elseif (!$tbl_orderguide->AllowAddDeleteRow && $tbl_orderguide_grid->StopRec == 0) {
	$tbl_orderguide_grid->StopRec = $tbl_orderguide->GridAddRowCount;
}

// Initialize aggregate
$tbl_orderguide->RowType = ROWTYPE_AGGREGATEINIT;
$tbl_orderguide->resetAttributes();
$tbl_orderguide_grid->renderRow();
if ($tbl_orderguide->isGridAdd())
	$tbl_orderguide_grid->RowIndex = 0;
if ($tbl_orderguide->isGridEdit())
	$tbl_orderguide_grid->RowIndex = 0;
while ($tbl_orderguide_grid->RecCnt < $tbl_orderguide_grid->StopRec) {
	$tbl_orderguide_grid->RecCnt++;
	if ($tbl_orderguide_grid->RecCnt >= $tbl_orderguide_grid->StartRec) {
		$tbl_orderguide_grid->RowCnt++;
		if ($tbl_orderguide->isGridAdd() || $tbl_orderguide->isGridEdit() || $tbl_orderguide->isConfirm()) {
			$tbl_orderguide_grid->RowIndex++;
			$CurrentForm->Index = $tbl_orderguide_grid->RowIndex;
			if ($CurrentForm->hasValue($tbl_orderguide_grid->FormActionName) && $tbl_orderguide_grid->EventCancelled)
				$tbl_orderguide_grid->RowAction = strval($CurrentForm->getValue($tbl_orderguide_grid->FormActionName));
			elseif ($tbl_orderguide->isGridAdd())
				$tbl_orderguide_grid->RowAction = "insert";
			else
				$tbl_orderguide_grid->RowAction = "";
		}

		// Set up key count
		$tbl_orderguide_grid->KeyCount = $tbl_orderguide_grid->RowIndex;

		// Init row class and style
		$tbl_orderguide->resetAttributes();
		$tbl_orderguide->CssClass = "";
		if ($tbl_orderguide->isGridAdd()) {
			if ($tbl_orderguide->CurrentMode == "copy") {
				$tbl_orderguide_grid->loadRowValues($tbl_orderguide_grid->Recordset); // Load row values
				$tbl_orderguide_grid->setRecordKey($tbl_orderguide_grid->RowOldKey, $tbl_orderguide_grid->Recordset); // Set old record key
			} else {
				$tbl_orderguide_grid->loadRowValues(); // Load default values
				$tbl_orderguide_grid->RowOldKey = ""; // Clear old key value
			}
		} else {
			$tbl_orderguide_grid->loadRowValues($tbl_orderguide_grid->Recordset); // Load row values
		}
		$tbl_orderguide->RowType = ROWTYPE_VIEW; // Render view
		if ($tbl_orderguide->isGridAdd()) // Grid add
			$tbl_orderguide->RowType = ROWTYPE_ADD; // Render add
		if ($tbl_orderguide->isGridAdd() && $tbl_orderguide->EventCancelled && !$CurrentForm->hasValue("k_blankrow")) // Insert failed
			$tbl_orderguide_grid->restoreCurrentRowFormValues($tbl_orderguide_grid->RowIndex); // Restore form values
		if ($tbl_orderguide->isGridEdit()) { // Grid edit
			if ($tbl_orderguide->EventCancelled)
				$tbl_orderguide_grid->restoreCurrentRowFormValues($tbl_orderguide_grid->RowIndex); // Restore form values
			if ($tbl_orderguide_grid->RowAction == "insert")
				$tbl_orderguide->RowType = ROWTYPE_ADD; // Render add
			else
				$tbl_orderguide->RowType = ROWTYPE_EDIT; // Render edit
		}
		if ($tbl_orderguide->isGridEdit() && ($tbl_orderguide->RowType == ROWTYPE_EDIT || $tbl_orderguide->RowType == ROWTYPE_ADD) && $tbl_orderguide->EventCancelled) // Update failed
			$tbl_orderguide_grid->restoreCurrentRowFormValues($tbl_orderguide_grid->RowIndex); // Restore form values
		if ($tbl_orderguide->RowType == ROWTYPE_EDIT) // Edit row
			$tbl_orderguide_grid->EditRowCnt++;
		if ($tbl_orderguide->isConfirm()) // Confirm row
			$tbl_orderguide_grid->restoreCurrentRowFormValues($tbl_orderguide_grid->RowIndex); // Restore form values

		// Set up row id / data-rowindex
		$tbl_orderguide->RowAttrs = array_merge($tbl_orderguide->RowAttrs, array('data-rowindex'=>$tbl_orderguide_grid->RowCnt, 'id'=>'r' . $tbl_orderguide_grid->RowCnt . '_tbl_orderguide', 'data-rowtype'=>$tbl_orderguide->RowType));

		// Render row
		$tbl_orderguide_grid->renderRow();

		// Render list options
		$tbl_orderguide_grid->renderListOptions();

		// Skip delete row / empty row for confirm page
		if ($tbl_orderguide_grid->RowAction <> "delete" && $tbl_orderguide_grid->RowAction <> "insertdelete" && !($tbl_orderguide_grid->RowAction == "insert" && $tbl_orderguide->isConfirm() && $tbl_orderguide_grid->emptyRow())) {
?>
	<tr<?php echo $tbl_orderguide->rowAttributes() ?>>
<?php

// Render list options (body, left)
$tbl_orderguide_grid->ListOptions->render("body", "left", $tbl_orderguide_grid->RowCnt);
?>
	<?php if ($tbl_orderguide->Code->Visible) { // Code ?>
		<td data-name="Code"<?php echo $tbl_orderguide->Code->cellAttributes() ?>>
<?php if ($tbl_orderguide->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $tbl_orderguide_grid->RowCnt ?>_tbl_orderguide_Code" class="form-group tbl_orderguide_Code">
<input type="text" data-table="tbl_orderguide" data-field="x_Code" name="x<?php echo $tbl_orderguide_grid->RowIndex ?>_Code" id="x<?php echo $tbl_orderguide_grid->RowIndex ?>_Code" size="30" maxlength="50" placeholder="<?php echo HtmlEncode($tbl_orderguide->Code->getPlaceHolder()) ?>" value="<?php echo $tbl_orderguide->Code->EditValue ?>"<?php echo $tbl_orderguide->Code->editAttributes() ?>>
</span>
<input type="hidden" data-table="tbl_orderguide" data-field="x_Code" name="o<?php echo $tbl_orderguide_grid->RowIndex ?>_Code" id="o<?php echo $tbl_orderguide_grid->RowIndex ?>_Code" value="<?php echo HtmlEncode($tbl_orderguide->Code->OldValue) ?>">
<?php } ?>
<?php if ($tbl_orderguide->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $tbl_orderguide_grid->RowCnt ?>_tbl_orderguide_Code" class="form-group tbl_orderguide_Code">
<input type="text" data-table="tbl_orderguide" data-field="x_Code" name="x<?php echo $tbl_orderguide_grid->RowIndex ?>_Code" id="x<?php echo $tbl_orderguide_grid->RowIndex ?>_Code" size="30" maxlength="50" placeholder="<?php echo HtmlEncode($tbl_orderguide->Code->getPlaceHolder()) ?>" value="<?php echo $tbl_orderguide->Code->EditValue ?>"<?php echo $tbl_orderguide->Code->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($tbl_orderguide->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $tbl_orderguide_grid->RowCnt ?>_tbl_orderguide_Code" class="tbl_orderguide_Code">
<span<?php echo $tbl_orderguide->Code->viewAttributes() ?>>
<?php echo $tbl_orderguide->Code->getViewValue() ?></span>
</span>
<?php if (!$tbl_orderguide->isConfirm()) { ?>
<input type="hidden" data-table="tbl_orderguide" data-field="x_Code" name="x<?php echo $tbl_orderguide_grid->RowIndex ?>_Code" id="x<?php echo $tbl_orderguide_grid->RowIndex ?>_Code" value="<?php echo HtmlEncode($tbl_orderguide->Code->FormValue) ?>">
<input type="hidden" data-table="tbl_orderguide" data-field="x_Code" name="o<?php echo $tbl_orderguide_grid->RowIndex ?>_Code" id="o<?php echo $tbl_orderguide_grid->RowIndex ?>_Code" value="<?php echo HtmlEncode($tbl_orderguide->Code->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="tbl_orderguide" data-field="x_Code" name="ftbl_orderguidegrid$x<?php echo $tbl_orderguide_grid->RowIndex ?>_Code" id="ftbl_orderguidegrid$x<?php echo $tbl_orderguide_grid->RowIndex ?>_Code" value="<?php echo HtmlEncode($tbl_orderguide->Code->FormValue) ?>">
<input type="hidden" data-table="tbl_orderguide" data-field="x_Code" name="ftbl_orderguidegrid$o<?php echo $tbl_orderguide_grid->RowIndex ?>_Code" id="ftbl_orderguidegrid$o<?php echo $tbl_orderguide_grid->RowIndex ?>_Code" value="<?php echo HtmlEncode($tbl_orderguide->Code->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
<?php if ($tbl_orderguide->RowType == ROWTYPE_ADD) { // Add record ?>
<input type="hidden" data-table="tbl_orderguide" data-field="x_ID_Guide" name="x<?php echo $tbl_orderguide_grid->RowIndex ?>_ID_Guide" id="x<?php echo $tbl_orderguide_grid->RowIndex ?>_ID_Guide" value="<?php echo HtmlEncode($tbl_orderguide->ID_Guide->CurrentValue) ?>">
<input type="hidden" data-table="tbl_orderguide" data-field="x_ID_Guide" name="o<?php echo $tbl_orderguide_grid->RowIndex ?>_ID_Guide" id="o<?php echo $tbl_orderguide_grid->RowIndex ?>_ID_Guide" value="<?php echo HtmlEncode($tbl_orderguide->ID_Guide->OldValue) ?>">
<?php } ?>
<?php if ($tbl_orderguide->RowType == ROWTYPE_EDIT || $tbl_orderguide->CurrentMode == "edit") { ?>
<input type="hidden" data-table="tbl_orderguide" data-field="x_ID_Guide" name="x<?php echo $tbl_orderguide_grid->RowIndex ?>_ID_Guide" id="x<?php echo $tbl_orderguide_grid->RowIndex ?>_ID_Guide" value="<?php echo HtmlEncode($tbl_orderguide->ID_Guide->CurrentValue) ?>">
<?php } ?>
	<?php if ($tbl_orderguide->ProductName->Visible) { // ProductName ?>
		<td data-name="ProductName"<?php echo $tbl_orderguide->ProductName->cellAttributes() ?>>
<?php if ($tbl_orderguide->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $tbl_orderguide_grid->RowCnt ?>_tbl_orderguide_ProductName" class="form-group tbl_orderguide_ProductName">
<input type="text" data-table="tbl_orderguide" data-field="x_ProductName" name="x<?php echo $tbl_orderguide_grid->RowIndex ?>_ProductName" id="x<?php echo $tbl_orderguide_grid->RowIndex ?>_ProductName" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($tbl_orderguide->ProductName->getPlaceHolder()) ?>" value="<?php echo $tbl_orderguide->ProductName->EditValue ?>"<?php echo $tbl_orderguide->ProductName->editAttributes() ?>>
</span>
<input type="hidden" data-table="tbl_orderguide" data-field="x_ProductName" name="o<?php echo $tbl_orderguide_grid->RowIndex ?>_ProductName" id="o<?php echo $tbl_orderguide_grid->RowIndex ?>_ProductName" value="<?php echo HtmlEncode($tbl_orderguide->ProductName->OldValue) ?>">
<?php } ?>
<?php if ($tbl_orderguide->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $tbl_orderguide_grid->RowCnt ?>_tbl_orderguide_ProductName" class="form-group tbl_orderguide_ProductName">
<input type="text" data-table="tbl_orderguide" data-field="x_ProductName" name="x<?php echo $tbl_orderguide_grid->RowIndex ?>_ProductName" id="x<?php echo $tbl_orderguide_grid->RowIndex ?>_ProductName" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($tbl_orderguide->ProductName->getPlaceHolder()) ?>" value="<?php echo $tbl_orderguide->ProductName->EditValue ?>"<?php echo $tbl_orderguide->ProductName->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($tbl_orderguide->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $tbl_orderguide_grid->RowCnt ?>_tbl_orderguide_ProductName" class="tbl_orderguide_ProductName">
<span<?php echo $tbl_orderguide->ProductName->viewAttributes() ?>>
<?php echo $tbl_orderguide->ProductName->getViewValue() ?></span>
</span>
<?php if (!$tbl_orderguide->isConfirm()) { ?>
<input type="hidden" data-table="tbl_orderguide" data-field="x_ProductName" name="x<?php echo $tbl_orderguide_grid->RowIndex ?>_ProductName" id="x<?php echo $tbl_orderguide_grid->RowIndex ?>_ProductName" value="<?php echo HtmlEncode($tbl_orderguide->ProductName->FormValue) ?>">
<input type="hidden" data-table="tbl_orderguide" data-field="x_ProductName" name="o<?php echo $tbl_orderguide_grid->RowIndex ?>_ProductName" id="o<?php echo $tbl_orderguide_grid->RowIndex ?>_ProductName" value="<?php echo HtmlEncode($tbl_orderguide->ProductName->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="tbl_orderguide" data-field="x_ProductName" name="ftbl_orderguidegrid$x<?php echo $tbl_orderguide_grid->RowIndex ?>_ProductName" id="ftbl_orderguidegrid$x<?php echo $tbl_orderguide_grid->RowIndex ?>_ProductName" value="<?php echo HtmlEncode($tbl_orderguide->ProductName->FormValue) ?>">
<input type="hidden" data-table="tbl_orderguide" data-field="x_ProductName" name="ftbl_orderguidegrid$o<?php echo $tbl_orderguide_grid->RowIndex ?>_ProductName" id="ftbl_orderguidegrid$o<?php echo $tbl_orderguide_grid->RowIndex ?>_ProductName" value="<?php echo HtmlEncode($tbl_orderguide->ProductName->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($tbl_orderguide->PCS_In->Visible) { // PCS_In ?>
		<td data-name="PCS_In"<?php echo $tbl_orderguide->PCS_In->cellAttributes() ?>>
<?php if ($tbl_orderguide->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $tbl_orderguide_grid->RowCnt ?>_tbl_orderguide_PCS_In" class="form-group tbl_orderguide_PCS_In">
<input type="text" data-table="tbl_orderguide" data-field="x_PCS_In" name="x<?php echo $tbl_orderguide_grid->RowIndex ?>_PCS_In" id="x<?php echo $tbl_orderguide_grid->RowIndex ?>_PCS_In" size="5" placeholder="<?php echo HtmlEncode($tbl_orderguide->PCS_In->getPlaceHolder()) ?>" value="<?php echo $tbl_orderguide->PCS_In->EditValue ?>"<?php echo $tbl_orderguide->PCS_In->editAttributes() ?>>
</span>
<input type="hidden" data-table="tbl_orderguide" data-field="x_PCS_In" name="o<?php echo $tbl_orderguide_grid->RowIndex ?>_PCS_In" id="o<?php echo $tbl_orderguide_grid->RowIndex ?>_PCS_In" value="<?php echo HtmlEncode($tbl_orderguide->PCS_In->OldValue) ?>">
<?php } ?>
<?php if ($tbl_orderguide->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $tbl_orderguide_grid->RowCnt ?>_tbl_orderguide_PCS_In" class="form-group tbl_orderguide_PCS_In">
<input type="text" data-table="tbl_orderguide" data-field="x_PCS_In" name="x<?php echo $tbl_orderguide_grid->RowIndex ?>_PCS_In" id="x<?php echo $tbl_orderguide_grid->RowIndex ?>_PCS_In" size="5" placeholder="<?php echo HtmlEncode($tbl_orderguide->PCS_In->getPlaceHolder()) ?>" value="<?php echo $tbl_orderguide->PCS_In->EditValue ?>"<?php echo $tbl_orderguide->PCS_In->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($tbl_orderguide->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $tbl_orderguide_grid->RowCnt ?>_tbl_orderguide_PCS_In" class="tbl_orderguide_PCS_In">
<span<?php echo $tbl_orderguide->PCS_In->viewAttributes() ?>>
<?php echo $tbl_orderguide->PCS_In->getViewValue() ?></span>
</span>
<?php if (!$tbl_orderguide->isConfirm()) { ?>
<input type="hidden" data-table="tbl_orderguide" data-field="x_PCS_In" name="x<?php echo $tbl_orderguide_grid->RowIndex ?>_PCS_In" id="x<?php echo $tbl_orderguide_grid->RowIndex ?>_PCS_In" value="<?php echo HtmlEncode($tbl_orderguide->PCS_In->FormValue) ?>">
<input type="hidden" data-table="tbl_orderguide" data-field="x_PCS_In" name="o<?php echo $tbl_orderguide_grid->RowIndex ?>_PCS_In" id="o<?php echo $tbl_orderguide_grid->RowIndex ?>_PCS_In" value="<?php echo HtmlEncode($tbl_orderguide->PCS_In->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="tbl_orderguide" data-field="x_PCS_In" name="ftbl_orderguidegrid$x<?php echo $tbl_orderguide_grid->RowIndex ?>_PCS_In" id="ftbl_orderguidegrid$x<?php echo $tbl_orderguide_grid->RowIndex ?>_PCS_In" value="<?php echo HtmlEncode($tbl_orderguide->PCS_In->FormValue) ?>">
<input type="hidden" data-table="tbl_orderguide" data-field="x_PCS_In" name="ftbl_orderguidegrid$o<?php echo $tbl_orderguide_grid->RowIndex ?>_PCS_In" id="ftbl_orderguidegrid$o<?php echo $tbl_orderguide_grid->RowIndex ?>_PCS_In" value="<?php echo HtmlEncode($tbl_orderguide->PCS_In->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($tbl_orderguide->PCS->Visible) { // PCS ?>
		<td data-name="PCS"<?php echo $tbl_orderguide->PCS->cellAttributes() ?>>
<?php if ($tbl_orderguide->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $tbl_orderguide_grid->RowCnt ?>_tbl_orderguide_PCS" class="form-group tbl_orderguide_PCS">
<input type="text" data-table="tbl_orderguide" data-field="x_PCS" name="x<?php echo $tbl_orderguide_grid->RowIndex ?>_PCS" id="x<?php echo $tbl_orderguide_grid->RowIndex ?>_PCS" size="5" placeholder="<?php echo HtmlEncode($tbl_orderguide->PCS->getPlaceHolder()) ?>" value="<?php echo $tbl_orderguide->PCS->EditValue ?>"<?php echo $tbl_orderguide->PCS->editAttributes() ?>>
</span>
<input type="hidden" data-table="tbl_orderguide" data-field="x_PCS" name="o<?php echo $tbl_orderguide_grid->RowIndex ?>_PCS" id="o<?php echo $tbl_orderguide_grid->RowIndex ?>_PCS" value="<?php echo HtmlEncode($tbl_orderguide->PCS->OldValue) ?>">
<?php } ?>
<?php if ($tbl_orderguide->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $tbl_orderguide_grid->RowCnt ?>_tbl_orderguide_PCS" class="form-group tbl_orderguide_PCS">
<input type="text" data-table="tbl_orderguide" data-field="x_PCS" name="x<?php echo $tbl_orderguide_grid->RowIndex ?>_PCS" id="x<?php echo $tbl_orderguide_grid->RowIndex ?>_PCS" size="5" placeholder="<?php echo HtmlEncode($tbl_orderguide->PCS->getPlaceHolder()) ?>" value="<?php echo $tbl_orderguide->PCS->EditValue ?>"<?php echo $tbl_orderguide->PCS->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($tbl_orderguide->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $tbl_orderguide_grid->RowCnt ?>_tbl_orderguide_PCS" class="tbl_orderguide_PCS">
<span<?php echo $tbl_orderguide->PCS->viewAttributes() ?>>
<?php echo $tbl_orderguide->PCS->getViewValue() ?></span>
</span>
<?php if (!$tbl_orderguide->isConfirm()) { ?>
<input type="hidden" data-table="tbl_orderguide" data-field="x_PCS" name="x<?php echo $tbl_orderguide_grid->RowIndex ?>_PCS" id="x<?php echo $tbl_orderguide_grid->RowIndex ?>_PCS" value="<?php echo HtmlEncode($tbl_orderguide->PCS->FormValue) ?>">
<input type="hidden" data-table="tbl_orderguide" data-field="x_PCS" name="o<?php echo $tbl_orderguide_grid->RowIndex ?>_PCS" id="o<?php echo $tbl_orderguide_grid->RowIndex ?>_PCS" value="<?php echo HtmlEncode($tbl_orderguide->PCS->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="tbl_orderguide" data-field="x_PCS" name="ftbl_orderguidegrid$x<?php echo $tbl_orderguide_grid->RowIndex ?>_PCS" id="ftbl_orderguidegrid$x<?php echo $tbl_orderguide_grid->RowIndex ?>_PCS" value="<?php echo HtmlEncode($tbl_orderguide->PCS->FormValue) ?>">
<input type="hidden" data-table="tbl_orderguide" data-field="x_PCS" name="ftbl_orderguidegrid$o<?php echo $tbl_orderguide_grid->RowIndex ?>_PCS" id="ftbl_orderguidegrid$o<?php echo $tbl_orderguide_grid->RowIndex ?>_PCS" value="<?php echo HtmlEncode($tbl_orderguide->PCS->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($tbl_orderguide->Qty->Visible) { // Qty ?>
		<td data-name="Qty"<?php echo $tbl_orderguide->Qty->cellAttributes() ?>>
<?php if ($tbl_orderguide->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $tbl_orderguide_grid->RowCnt ?>_tbl_orderguide_Qty" class="form-group tbl_orderguide_Qty">
<input type="text" data-table="tbl_orderguide" data-field="x_Qty" name="x<?php echo $tbl_orderguide_grid->RowIndex ?>_Qty" id="x<?php echo $tbl_orderguide_grid->RowIndex ?>_Qty" size="5" placeholder="<?php echo HtmlEncode($tbl_orderguide->Qty->getPlaceHolder()) ?>" value="<?php echo $tbl_orderguide->Qty->EditValue ?>"<?php echo $tbl_orderguide->Qty->editAttributes() ?>>
</span>
<input type="hidden" data-table="tbl_orderguide" data-field="x_Qty" name="o<?php echo $tbl_orderguide_grid->RowIndex ?>_Qty" id="o<?php echo $tbl_orderguide_grid->RowIndex ?>_Qty" value="<?php echo HtmlEncode($tbl_orderguide->Qty->OldValue) ?>">
<?php } ?>
<?php if ($tbl_orderguide->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $tbl_orderguide_grid->RowCnt ?>_tbl_orderguide_Qty" class="form-group tbl_orderguide_Qty">
<input type="text" data-table="tbl_orderguide" data-field="x_Qty" name="x<?php echo $tbl_orderguide_grid->RowIndex ?>_Qty" id="x<?php echo $tbl_orderguide_grid->RowIndex ?>_Qty" size="5" placeholder="<?php echo HtmlEncode($tbl_orderguide->Qty->getPlaceHolder()) ?>" value="<?php echo $tbl_orderguide->Qty->EditValue ?>"<?php echo $tbl_orderguide->Qty->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($tbl_orderguide->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $tbl_orderguide_grid->RowCnt ?>_tbl_orderguide_Qty" class="tbl_orderguide_Qty">
<span<?php echo $tbl_orderguide->Qty->viewAttributes() ?>>
<?php echo $tbl_orderguide->Qty->getViewValue() ?></span>
</span>
<?php if (!$tbl_orderguide->isConfirm()) { ?>
<input type="hidden" data-table="tbl_orderguide" data-field="x_Qty" name="x<?php echo $tbl_orderguide_grid->RowIndex ?>_Qty" id="x<?php echo $tbl_orderguide_grid->RowIndex ?>_Qty" value="<?php echo HtmlEncode($tbl_orderguide->Qty->FormValue) ?>">
<input type="hidden" data-table="tbl_orderguide" data-field="x_Qty" name="o<?php echo $tbl_orderguide_grid->RowIndex ?>_Qty" id="o<?php echo $tbl_orderguide_grid->RowIndex ?>_Qty" value="<?php echo HtmlEncode($tbl_orderguide->Qty->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="tbl_orderguide" data-field="x_Qty" name="ftbl_orderguidegrid$x<?php echo $tbl_orderguide_grid->RowIndex ?>_Qty" id="ftbl_orderguidegrid$x<?php echo $tbl_orderguide_grid->RowIndex ?>_Qty" value="<?php echo HtmlEncode($tbl_orderguide->Qty->FormValue) ?>">
<input type="hidden" data-table="tbl_orderguide" data-field="x_Qty" name="ftbl_orderguidegrid$o<?php echo $tbl_orderguide_grid->RowIndex ?>_Qty" id="ftbl_orderguidegrid$o<?php echo $tbl_orderguide_grid->RowIndex ?>_Qty" value="<?php echo HtmlEncode($tbl_orderguide->Qty->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($tbl_orderguide->Box->Visible) { // Box ?>
		<td data-name="Box"<?php echo $tbl_orderguide->Box->cellAttributes() ?>>
<?php if ($tbl_orderguide->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $tbl_orderguide_grid->RowCnt ?>_tbl_orderguide_Box" class="form-group tbl_orderguide_Box">
<input type="text" data-table="tbl_orderguide" data-field="x_Box" name="x<?php echo $tbl_orderguide_grid->RowIndex ?>_Box" id="x<?php echo $tbl_orderguide_grid->RowIndex ?>_Box" size="5" placeholder="<?php echo HtmlEncode($tbl_orderguide->Box->getPlaceHolder()) ?>" value="<?php echo $tbl_orderguide->Box->EditValue ?>"<?php echo $tbl_orderguide->Box->editAttributes() ?>>
</span>
<input type="hidden" data-table="tbl_orderguide" data-field="x_Box" name="o<?php echo $tbl_orderguide_grid->RowIndex ?>_Box" id="o<?php echo $tbl_orderguide_grid->RowIndex ?>_Box" value="<?php echo HtmlEncode($tbl_orderguide->Box->OldValue) ?>">
<?php } ?>
<?php if ($tbl_orderguide->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $tbl_orderguide_grid->RowCnt ?>_tbl_orderguide_Box" class="form-group tbl_orderguide_Box">
<input type="text" data-table="tbl_orderguide" data-field="x_Box" name="x<?php echo $tbl_orderguide_grid->RowIndex ?>_Box" id="x<?php echo $tbl_orderguide_grid->RowIndex ?>_Box" size="5" placeholder="<?php echo HtmlEncode($tbl_orderguide->Box->getPlaceHolder()) ?>" value="<?php echo $tbl_orderguide->Box->EditValue ?>"<?php echo $tbl_orderguide->Box->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($tbl_orderguide->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $tbl_orderguide_grid->RowCnt ?>_tbl_orderguide_Box" class="tbl_orderguide_Box">
<span<?php echo $tbl_orderguide->Box->viewAttributes() ?>>
<?php echo $tbl_orderguide->Box->getViewValue() ?></span>
</span>
<?php if (!$tbl_orderguide->isConfirm()) { ?>
<input type="hidden" data-table="tbl_orderguide" data-field="x_Box" name="x<?php echo $tbl_orderguide_grid->RowIndex ?>_Box" id="x<?php echo $tbl_orderguide_grid->RowIndex ?>_Box" value="<?php echo HtmlEncode($tbl_orderguide->Box->FormValue) ?>">
<input type="hidden" data-table="tbl_orderguide" data-field="x_Box" name="o<?php echo $tbl_orderguide_grid->RowIndex ?>_Box" id="o<?php echo $tbl_orderguide_grid->RowIndex ?>_Box" value="<?php echo HtmlEncode($tbl_orderguide->Box->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="tbl_orderguide" data-field="x_Box" name="ftbl_orderguidegrid$x<?php echo $tbl_orderguide_grid->RowIndex ?>_Box" id="ftbl_orderguidegrid$x<?php echo $tbl_orderguide_grid->RowIndex ?>_Box" value="<?php echo HtmlEncode($tbl_orderguide->Box->FormValue) ?>">
<input type="hidden" data-table="tbl_orderguide" data-field="x_Box" name="ftbl_orderguidegrid$o<?php echo $tbl_orderguide_grid->RowIndex ?>_Box" id="ftbl_orderguidegrid$o<?php echo $tbl_orderguide_grid->RowIndex ?>_Box" value="<?php echo HtmlEncode($tbl_orderguide->Box->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($tbl_orderguide->ID_Location->Visible) { // ID_Location ?>
		<td data-name="ID_Location"<?php echo $tbl_orderguide->ID_Location->cellAttributes() ?>>
<?php if ($tbl_orderguide->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $tbl_orderguide_grid->RowCnt ?>_tbl_orderguide_ID_Location" class="form-group tbl_orderguide_ID_Location">
<?php
$wrkonchange = "" . trim(@$tbl_orderguide->ID_Location->EditAttrs["onchange"]);
if (trim($wrkonchange) <> "") $wrkonchange = " onchange=\"" . JsEncode($wrkonchange) . "\"";
$tbl_orderguide->ID_Location->EditAttrs["onchange"] = "";
?>
<span id="as_x<?php echo $tbl_orderguide_grid->RowIndex ?>_ID_Location" class="text-nowrap" style="z-index: <?php echo (9000 - $tbl_orderguide_grid->RowCnt * 10) ?>">
	<input type="text" class="form-control" name="sv_x<?php echo $tbl_orderguide_grid->RowIndex ?>_ID_Location" id="sv_x<?php echo $tbl_orderguide_grid->RowIndex ?>_ID_Location" value="<?php echo RemoveHtml($tbl_orderguide->ID_Location->EditValue) ?>" size="30" placeholder="<?php echo HtmlEncode($tbl_orderguide->ID_Location->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($tbl_orderguide->ID_Location->getPlaceHolder()) ?>"<?php echo $tbl_orderguide->ID_Location->editAttributes() ?>>
</span>
<input type="hidden" data-table="tbl_orderguide" data-field="x_ID_Location" data-value-separator="<?php echo $tbl_orderguide->ID_Location->displayValueSeparatorAttribute() ?>" name="x<?php echo $tbl_orderguide_grid->RowIndex ?>_ID_Location" id="x<?php echo $tbl_orderguide_grid->RowIndex ?>_ID_Location" value="<?php echo HtmlEncode($tbl_orderguide->ID_Location->CurrentValue) ?>"<?php echo $wrkonchange ?>>
<script>
ftbl_orderguidegrid.createAutoSuggest({"id":"x<?php echo $tbl_orderguide_grid->RowIndex ?>_ID_Location","forceSelect":true});
</script>
<?php echo $tbl_orderguide->ID_Location->Lookup->getParamTag("p_x" . $tbl_orderguide_grid->RowIndex . "_ID_Location") ?>
</span>
<input type="hidden" data-table="tbl_orderguide" data-field="x_ID_Location" name="o<?php echo $tbl_orderguide_grid->RowIndex ?>_ID_Location" id="o<?php echo $tbl_orderguide_grid->RowIndex ?>_ID_Location" value="<?php echo HtmlEncode($tbl_orderguide->ID_Location->OldValue) ?>">
<?php } ?>
<?php if ($tbl_orderguide->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $tbl_orderguide_grid->RowCnt ?>_tbl_orderguide_ID_Location" class="form-group tbl_orderguide_ID_Location">
<?php
$wrkonchange = "" . trim(@$tbl_orderguide->ID_Location->EditAttrs["onchange"]);
if (trim($wrkonchange) <> "") $wrkonchange = " onchange=\"" . JsEncode($wrkonchange) . "\"";
$tbl_orderguide->ID_Location->EditAttrs["onchange"] = "";
?>
<span id="as_x<?php echo $tbl_orderguide_grid->RowIndex ?>_ID_Location" class="text-nowrap" style="z-index: <?php echo (9000 - $tbl_orderguide_grid->RowCnt * 10) ?>">
	<input type="text" class="form-control" name="sv_x<?php echo $tbl_orderguide_grid->RowIndex ?>_ID_Location" id="sv_x<?php echo $tbl_orderguide_grid->RowIndex ?>_ID_Location" value="<?php echo RemoveHtml($tbl_orderguide->ID_Location->EditValue) ?>" size="30" placeholder="<?php echo HtmlEncode($tbl_orderguide->ID_Location->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($tbl_orderguide->ID_Location->getPlaceHolder()) ?>"<?php echo $tbl_orderguide->ID_Location->editAttributes() ?>>
</span>
<input type="hidden" data-table="tbl_orderguide" data-field="x_ID_Location" data-value-separator="<?php echo $tbl_orderguide->ID_Location->displayValueSeparatorAttribute() ?>" name="x<?php echo $tbl_orderguide_grid->RowIndex ?>_ID_Location" id="x<?php echo $tbl_orderguide_grid->RowIndex ?>_ID_Location" value="<?php echo HtmlEncode($tbl_orderguide->ID_Location->CurrentValue) ?>"<?php echo $wrkonchange ?>>
<script>
ftbl_orderguidegrid.createAutoSuggest({"id":"x<?php echo $tbl_orderguide_grid->RowIndex ?>_ID_Location","forceSelect":true});
</script>
<?php echo $tbl_orderguide->ID_Location->Lookup->getParamTag("p_x" . $tbl_orderguide_grid->RowIndex . "_ID_Location") ?>
</span>
<?php } ?>
<?php if ($tbl_orderguide->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $tbl_orderguide_grid->RowCnt ?>_tbl_orderguide_ID_Location" class="tbl_orderguide_ID_Location">
<span<?php echo $tbl_orderguide->ID_Location->viewAttributes() ?>>
<?php echo $tbl_orderguide->ID_Location->getViewValue() ?></span>
</span>
<?php if (!$tbl_orderguide->isConfirm()) { ?>
<input type="hidden" data-table="tbl_orderguide" data-field="x_ID_Location" name="x<?php echo $tbl_orderguide_grid->RowIndex ?>_ID_Location" id="x<?php echo $tbl_orderguide_grid->RowIndex ?>_ID_Location" value="<?php echo HtmlEncode($tbl_orderguide->ID_Location->FormValue) ?>">
<input type="hidden" data-table="tbl_orderguide" data-field="x_ID_Location" name="o<?php echo $tbl_orderguide_grid->RowIndex ?>_ID_Location" id="o<?php echo $tbl_orderguide_grid->RowIndex ?>_ID_Location" value="<?php echo HtmlEncode($tbl_orderguide->ID_Location->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="tbl_orderguide" data-field="x_ID_Location" name="ftbl_orderguidegrid$x<?php echo $tbl_orderguide_grid->RowIndex ?>_ID_Location" id="ftbl_orderguidegrid$x<?php echo $tbl_orderguide_grid->RowIndex ?>_ID_Location" value="<?php echo HtmlEncode($tbl_orderguide->ID_Location->FormValue) ?>">
<input type="hidden" data-table="tbl_orderguide" data-field="x_ID_Location" name="ftbl_orderguidegrid$o<?php echo $tbl_orderguide_grid->RowIndex ?>_ID_Location" id="ftbl_orderguidegrid$o<?php echo $tbl_orderguide_grid->RowIndex ?>_ID_Location" value="<?php echo HtmlEncode($tbl_orderguide->ID_Location->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($tbl_orderguide->PalletID->Visible) { // PalletID ?>
		<td data-name="PalletID"<?php echo $tbl_orderguide->PalletID->cellAttributes() ?>>
<?php if ($tbl_orderguide->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $tbl_orderguide_grid->RowCnt ?>_tbl_orderguide_PalletID" class="form-group tbl_orderguide_PalletID">
<input type="text" data-table="tbl_orderguide" data-field="x_PalletID" name="x<?php echo $tbl_orderguide_grid->RowIndex ?>_PalletID" id="x<?php echo $tbl_orderguide_grid->RowIndex ?>_PalletID" size="20" placeholder="<?php echo HtmlEncode($tbl_orderguide->PalletID->getPlaceHolder()) ?>" value="<?php echo $tbl_orderguide->PalletID->EditValue ?>"<?php echo $tbl_orderguide->PalletID->editAttributes() ?>>
</span>
<input type="hidden" data-table="tbl_orderguide" data-field="x_PalletID" name="o<?php echo $tbl_orderguide_grid->RowIndex ?>_PalletID" id="o<?php echo $tbl_orderguide_grid->RowIndex ?>_PalletID" value="<?php echo HtmlEncode($tbl_orderguide->PalletID->OldValue) ?>">
<?php } ?>
<?php if ($tbl_orderguide->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $tbl_orderguide_grid->RowCnt ?>_tbl_orderguide_PalletID" class="form-group tbl_orderguide_PalletID">
<input type="text" data-table="tbl_orderguide" data-field="x_PalletID" name="x<?php echo $tbl_orderguide_grid->RowIndex ?>_PalletID" id="x<?php echo $tbl_orderguide_grid->RowIndex ?>_PalletID" size="20" placeholder="<?php echo HtmlEncode($tbl_orderguide->PalletID->getPlaceHolder()) ?>" value="<?php echo $tbl_orderguide->PalletID->EditValue ?>"<?php echo $tbl_orderguide->PalletID->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($tbl_orderguide->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $tbl_orderguide_grid->RowCnt ?>_tbl_orderguide_PalletID" class="tbl_orderguide_PalletID">
<span<?php echo $tbl_orderguide->PalletID->viewAttributes() ?>>
<?php echo $tbl_orderguide->PalletID->getViewValue() ?></span>
</span>
<?php if (!$tbl_orderguide->isConfirm()) { ?>
<input type="hidden" data-table="tbl_orderguide" data-field="x_PalletID" name="x<?php echo $tbl_orderguide_grid->RowIndex ?>_PalletID" id="x<?php echo $tbl_orderguide_grid->RowIndex ?>_PalletID" value="<?php echo HtmlEncode($tbl_orderguide->PalletID->FormValue) ?>">
<input type="hidden" data-table="tbl_orderguide" data-field="x_PalletID" name="o<?php echo $tbl_orderguide_grid->RowIndex ?>_PalletID" id="o<?php echo $tbl_orderguide_grid->RowIndex ?>_PalletID" value="<?php echo HtmlEncode($tbl_orderguide->PalletID->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="tbl_orderguide" data-field="x_PalletID" name="ftbl_orderguidegrid$x<?php echo $tbl_orderguide_grid->RowIndex ?>_PalletID" id="ftbl_orderguidegrid$x<?php echo $tbl_orderguide_grid->RowIndex ?>_PalletID" value="<?php echo HtmlEncode($tbl_orderguide->PalletID->FormValue) ?>">
<input type="hidden" data-table="tbl_orderguide" data-field="x_PalletID" name="ftbl_orderguidegrid$o<?php echo $tbl_orderguide_grid->RowIndex ?>_PalletID" id="ftbl_orderguidegrid$o<?php echo $tbl_orderguide_grid->RowIndex ?>_PalletID" value="<?php echo HtmlEncode($tbl_orderguide->PalletID->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($tbl_orderguide->MFG->Visible) { // MFG ?>
		<td data-name="MFG"<?php echo $tbl_orderguide->MFG->cellAttributes() ?>>
<?php if ($tbl_orderguide->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $tbl_orderguide_grid->RowCnt ?>_tbl_orderguide_MFG" class="form-group tbl_orderguide_MFG">
<input type="text" data-table="tbl_orderguide" data-field="x_MFG" data-format="7" name="x<?php echo $tbl_orderguide_grid->RowIndex ?>_MFG" id="x<?php echo $tbl_orderguide_grid->RowIndex ?>_MFG" placeholder="<?php echo HtmlEncode($tbl_orderguide->MFG->getPlaceHolder()) ?>" value="<?php echo $tbl_orderguide->MFG->EditValue ?>"<?php echo $tbl_orderguide->MFG->editAttributes() ?>>
<?php if (!$tbl_orderguide->MFG->ReadOnly && !$tbl_orderguide->MFG->Disabled && !isset($tbl_orderguide->MFG->EditAttrs["readonly"]) && !isset($tbl_orderguide->MFG->EditAttrs["disabled"])) { ?>
<script>
ew.createDateTimePicker("ftbl_orderguidegrid", "x<?php echo $tbl_orderguide_grid->RowIndex ?>_MFG", {"ignoreReadonly":true,"useCurrent":false,"format":7});
</script>
<?php } ?>
</span>
<input type="hidden" data-table="tbl_orderguide" data-field="x_MFG" name="o<?php echo $tbl_orderguide_grid->RowIndex ?>_MFG" id="o<?php echo $tbl_orderguide_grid->RowIndex ?>_MFG" value="<?php echo HtmlEncode($tbl_orderguide->MFG->OldValue) ?>">
<?php } ?>
<?php if ($tbl_orderguide->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $tbl_orderguide_grid->RowCnt ?>_tbl_orderguide_MFG" class="form-group tbl_orderguide_MFG">
<input type="text" data-table="tbl_orderguide" data-field="x_MFG" data-format="7" name="x<?php echo $tbl_orderguide_grid->RowIndex ?>_MFG" id="x<?php echo $tbl_orderguide_grid->RowIndex ?>_MFG" placeholder="<?php echo HtmlEncode($tbl_orderguide->MFG->getPlaceHolder()) ?>" value="<?php echo $tbl_orderguide->MFG->EditValue ?>"<?php echo $tbl_orderguide->MFG->editAttributes() ?>>
<?php if (!$tbl_orderguide->MFG->ReadOnly && !$tbl_orderguide->MFG->Disabled && !isset($tbl_orderguide->MFG->EditAttrs["readonly"]) && !isset($tbl_orderguide->MFG->EditAttrs["disabled"])) { ?>
<script>
ew.createDateTimePicker("ftbl_orderguidegrid", "x<?php echo $tbl_orderguide_grid->RowIndex ?>_MFG", {"ignoreReadonly":true,"useCurrent":false,"format":7});
</script>
<?php } ?>
</span>
<?php } ?>
<?php if ($tbl_orderguide->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $tbl_orderguide_grid->RowCnt ?>_tbl_orderguide_MFG" class="tbl_orderguide_MFG">
<span<?php echo $tbl_orderguide->MFG->viewAttributes() ?>>
<?php echo $tbl_orderguide->MFG->getViewValue() ?></span>
</span>
<?php if (!$tbl_orderguide->isConfirm()) { ?>
<input type="hidden" data-table="tbl_orderguide" data-field="x_MFG" name="x<?php echo $tbl_orderguide_grid->RowIndex ?>_MFG" id="x<?php echo $tbl_orderguide_grid->RowIndex ?>_MFG" value="<?php echo HtmlEncode($tbl_orderguide->MFG->FormValue) ?>">
<input type="hidden" data-table="tbl_orderguide" data-field="x_MFG" name="o<?php echo $tbl_orderguide_grid->RowIndex ?>_MFG" id="o<?php echo $tbl_orderguide_grid->RowIndex ?>_MFG" value="<?php echo HtmlEncode($tbl_orderguide->MFG->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="tbl_orderguide" data-field="x_MFG" name="ftbl_orderguidegrid$x<?php echo $tbl_orderguide_grid->RowIndex ?>_MFG" id="ftbl_orderguidegrid$x<?php echo $tbl_orderguide_grid->RowIndex ?>_MFG" value="<?php echo HtmlEncode($tbl_orderguide->MFG->FormValue) ?>">
<input type="hidden" data-table="tbl_orderguide" data-field="x_MFG" name="ftbl_orderguidegrid$o<?php echo $tbl_orderguide_grid->RowIndex ?>_MFG" id="ftbl_orderguidegrid$o<?php echo $tbl_orderguide_grid->RowIndex ?>_MFG" value="<?php echo HtmlEncode($tbl_orderguide->MFG->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($tbl_orderguide->DateIn->Visible) { // DateIn ?>
		<td data-name="DateIn"<?php echo $tbl_orderguide->DateIn->cellAttributes() ?>>
<?php if ($tbl_orderguide->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $tbl_orderguide_grid->RowCnt ?>_tbl_orderguide_DateIn" class="form-group tbl_orderguide_DateIn">
<input type="text" data-table="tbl_orderguide" data-field="x_DateIn" data-format="11" name="x<?php echo $tbl_orderguide_grid->RowIndex ?>_DateIn" id="x<?php echo $tbl_orderguide_grid->RowIndex ?>_DateIn" placeholder="<?php echo HtmlEncode($tbl_orderguide->DateIn->getPlaceHolder()) ?>" value="<?php echo $tbl_orderguide->DateIn->EditValue ?>"<?php echo $tbl_orderguide->DateIn->editAttributes() ?>>
<?php if (!$tbl_orderguide->DateIn->ReadOnly && !$tbl_orderguide->DateIn->Disabled && !isset($tbl_orderguide->DateIn->EditAttrs["readonly"]) && !isset($tbl_orderguide->DateIn->EditAttrs["disabled"])) { ?>
<script>
ew.createDateTimePicker("ftbl_orderguidegrid", "x<?php echo $tbl_orderguide_grid->RowIndex ?>_DateIn", {"ignoreReadonly":true,"useCurrent":false,"format":11});
</script>
<?php } ?>
</span>
<input type="hidden" data-table="tbl_orderguide" data-field="x_DateIn" name="o<?php echo $tbl_orderguide_grid->RowIndex ?>_DateIn" id="o<?php echo $tbl_orderguide_grid->RowIndex ?>_DateIn" value="<?php echo HtmlEncode($tbl_orderguide->DateIn->OldValue) ?>">
<?php } ?>
<?php if ($tbl_orderguide->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $tbl_orderguide_grid->RowCnt ?>_tbl_orderguide_DateIn" class="form-group tbl_orderguide_DateIn">
<input type="text" data-table="tbl_orderguide" data-field="x_DateIn" data-format="11" name="x<?php echo $tbl_orderguide_grid->RowIndex ?>_DateIn" id="x<?php echo $tbl_orderguide_grid->RowIndex ?>_DateIn" placeholder="<?php echo HtmlEncode($tbl_orderguide->DateIn->getPlaceHolder()) ?>" value="<?php echo $tbl_orderguide->DateIn->EditValue ?>"<?php echo $tbl_orderguide->DateIn->editAttributes() ?>>
<?php if (!$tbl_orderguide->DateIn->ReadOnly && !$tbl_orderguide->DateIn->Disabled && !isset($tbl_orderguide->DateIn->EditAttrs["readonly"]) && !isset($tbl_orderguide->DateIn->EditAttrs["disabled"])) { ?>
<script>
ew.createDateTimePicker("ftbl_orderguidegrid", "x<?php echo $tbl_orderguide_grid->RowIndex ?>_DateIn", {"ignoreReadonly":true,"useCurrent":false,"format":11});
</script>
<?php } ?>
</span>
<?php } ?>
<?php if ($tbl_orderguide->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $tbl_orderguide_grid->RowCnt ?>_tbl_orderguide_DateIn" class="tbl_orderguide_DateIn">
<span<?php echo $tbl_orderguide->DateIn->viewAttributes() ?>>
<?php echo $tbl_orderguide->DateIn->getViewValue() ?></span>
</span>
<?php if (!$tbl_orderguide->isConfirm()) { ?>
<input type="hidden" data-table="tbl_orderguide" data-field="x_DateIn" name="x<?php echo $tbl_orderguide_grid->RowIndex ?>_DateIn" id="x<?php echo $tbl_orderguide_grid->RowIndex ?>_DateIn" value="<?php echo HtmlEncode($tbl_orderguide->DateIn->FormValue) ?>">
<input type="hidden" data-table="tbl_orderguide" data-field="x_DateIn" name="o<?php echo $tbl_orderguide_grid->RowIndex ?>_DateIn" id="o<?php echo $tbl_orderguide_grid->RowIndex ?>_DateIn" value="<?php echo HtmlEncode($tbl_orderguide->DateIn->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="tbl_orderguide" data-field="x_DateIn" name="ftbl_orderguidegrid$x<?php echo $tbl_orderguide_grid->RowIndex ?>_DateIn" id="ftbl_orderguidegrid$x<?php echo $tbl_orderguide_grid->RowIndex ?>_DateIn" value="<?php echo HtmlEncode($tbl_orderguide->DateIn->FormValue) ?>">
<input type="hidden" data-table="tbl_orderguide" data-field="x_DateIn" name="ftbl_orderguidegrid$o<?php echo $tbl_orderguide_grid->RowIndex ?>_DateIn" id="ftbl_orderguidegrid$o<?php echo $tbl_orderguide_grid->RowIndex ?>_DateIn" value="<?php echo HtmlEncode($tbl_orderguide->DateIn->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($tbl_orderguide->CreateDate->Visible) { // CreateDate ?>
		<td data-name="CreateDate"<?php echo $tbl_orderguide->CreateDate->cellAttributes() ?>>
<?php if ($tbl_orderguide->RowType == ROWTYPE_ADD) { // Add record ?>
<input type="hidden" data-table="tbl_orderguide" data-field="x_CreateDate" name="o<?php echo $tbl_orderguide_grid->RowIndex ?>_CreateDate" id="o<?php echo $tbl_orderguide_grid->RowIndex ?>_CreateDate" value="<?php echo HtmlEncode($tbl_orderguide->CreateDate->OldValue) ?>">
<?php } ?>
<?php if ($tbl_orderguide->RowType == ROWTYPE_EDIT) { // Edit record ?>
<?php } ?>
<?php if ($tbl_orderguide->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $tbl_orderguide_grid->RowCnt ?>_tbl_orderguide_CreateDate" class="tbl_orderguide_CreateDate">
<span<?php echo $tbl_orderguide->CreateDate->viewAttributes() ?>>
<?php echo $tbl_orderguide->CreateDate->getViewValue() ?></span>
</span>
<?php if (!$tbl_orderguide->isConfirm()) { ?>
<input type="hidden" data-table="tbl_orderguide" data-field="x_CreateDate" name="x<?php echo $tbl_orderguide_grid->RowIndex ?>_CreateDate" id="x<?php echo $tbl_orderguide_grid->RowIndex ?>_CreateDate" value="<?php echo HtmlEncode($tbl_orderguide->CreateDate->FormValue) ?>">
<input type="hidden" data-table="tbl_orderguide" data-field="x_CreateDate" name="o<?php echo $tbl_orderguide_grid->RowIndex ?>_CreateDate" id="o<?php echo $tbl_orderguide_grid->RowIndex ?>_CreateDate" value="<?php echo HtmlEncode($tbl_orderguide->CreateDate->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="tbl_orderguide" data-field="x_CreateDate" name="ftbl_orderguidegrid$x<?php echo $tbl_orderguide_grid->RowIndex ?>_CreateDate" id="ftbl_orderguidegrid$x<?php echo $tbl_orderguide_grid->RowIndex ?>_CreateDate" value="<?php echo HtmlEncode($tbl_orderguide->CreateDate->FormValue) ?>">
<input type="hidden" data-table="tbl_orderguide" data-field="x_CreateDate" name="ftbl_orderguidegrid$o<?php echo $tbl_orderguide_grid->RowIndex ?>_CreateDate" id="ftbl_orderguidegrid$o<?php echo $tbl_orderguide_grid->RowIndex ?>_CreateDate" value="<?php echo HtmlEncode($tbl_orderguide->CreateDate->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$tbl_orderguide_grid->ListOptions->render("body", "right", $tbl_orderguide_grid->RowCnt);
?>
	</tr>
<?php if ($tbl_orderguide->RowType == ROWTYPE_ADD || $tbl_orderguide->RowType == ROWTYPE_EDIT) { ?>
<script>
ftbl_orderguidegrid.updateLists(<?php echo $tbl_orderguide_grid->RowIndex ?>);
</script>
<?php } ?>
<?php
	}
	} // End delete row checking
	if (!$tbl_orderguide->isGridAdd() || $tbl_orderguide->CurrentMode == "copy")
		if (!$tbl_orderguide_grid->Recordset->EOF)
			$tbl_orderguide_grid->Recordset->moveNext();
}
?>
<?php
	if ($tbl_orderguide->CurrentMode == "add" || $tbl_orderguide->CurrentMode == "copy" || $tbl_orderguide->CurrentMode == "edit") {
		$tbl_orderguide_grid->RowIndex = '$rowindex$';
		$tbl_orderguide_grid->loadRowValues();

		// Set row properties
		$tbl_orderguide->resetAttributes();
		$tbl_orderguide->RowAttrs = array_merge($tbl_orderguide->RowAttrs, array('data-rowindex'=>$tbl_orderguide_grid->RowIndex, 'id'=>'r0_tbl_orderguide', 'data-rowtype'=>ROWTYPE_ADD));
		AppendClass($tbl_orderguide->RowAttrs["class"], "ew-template");
		$tbl_orderguide->RowType = ROWTYPE_ADD;

		// Render row
		$tbl_orderguide_grid->renderRow();

		// Render list options
		$tbl_orderguide_grid->renderListOptions();
		$tbl_orderguide_grid->StartRowCnt = 0;
?>
	<tr<?php echo $tbl_orderguide->rowAttributes() ?>>
<?php

// Render list options (body, left)
$tbl_orderguide_grid->ListOptions->render("body", "left", $tbl_orderguide_grid->RowIndex);
?>
	<?php if ($tbl_orderguide->Code->Visible) { // Code ?>
		<td data-name="Code">
<?php if (!$tbl_orderguide->isConfirm()) { ?>
<span id="el$rowindex$_tbl_orderguide_Code" class="form-group tbl_orderguide_Code">
<input type="text" data-table="tbl_orderguide" data-field="x_Code" name="x<?php echo $tbl_orderguide_grid->RowIndex ?>_Code" id="x<?php echo $tbl_orderguide_grid->RowIndex ?>_Code" size="30" maxlength="50" placeholder="<?php echo HtmlEncode($tbl_orderguide->Code->getPlaceHolder()) ?>" value="<?php echo $tbl_orderguide->Code->EditValue ?>"<?php echo $tbl_orderguide->Code->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_tbl_orderguide_Code" class="form-group tbl_orderguide_Code">
<span<?php echo $tbl_orderguide->Code->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?php echo RemoveHtml($tbl_orderguide->Code->ViewValue) ?>"></span>
</span>
<input type="hidden" data-table="tbl_orderguide" data-field="x_Code" name="x<?php echo $tbl_orderguide_grid->RowIndex ?>_Code" id="x<?php echo $tbl_orderguide_grid->RowIndex ?>_Code" value="<?php echo HtmlEncode($tbl_orderguide->Code->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="tbl_orderguide" data-field="x_Code" name="o<?php echo $tbl_orderguide_grid->RowIndex ?>_Code" id="o<?php echo $tbl_orderguide_grid->RowIndex ?>_Code" value="<?php echo HtmlEncode($tbl_orderguide->Code->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($tbl_orderguide->ProductName->Visible) { // ProductName ?>
		<td data-name="ProductName">
<?php if (!$tbl_orderguide->isConfirm()) { ?>
<span id="el$rowindex$_tbl_orderguide_ProductName" class="form-group tbl_orderguide_ProductName">
<input type="text" data-table="tbl_orderguide" data-field="x_ProductName" name="x<?php echo $tbl_orderguide_grid->RowIndex ?>_ProductName" id="x<?php echo $tbl_orderguide_grid->RowIndex ?>_ProductName" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($tbl_orderguide->ProductName->getPlaceHolder()) ?>" value="<?php echo $tbl_orderguide->ProductName->EditValue ?>"<?php echo $tbl_orderguide->ProductName->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_tbl_orderguide_ProductName" class="form-group tbl_orderguide_ProductName">
<span<?php echo $tbl_orderguide->ProductName->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?php echo RemoveHtml($tbl_orderguide->ProductName->ViewValue) ?>"></span>
</span>
<input type="hidden" data-table="tbl_orderguide" data-field="x_ProductName" name="x<?php echo $tbl_orderguide_grid->RowIndex ?>_ProductName" id="x<?php echo $tbl_orderguide_grid->RowIndex ?>_ProductName" value="<?php echo HtmlEncode($tbl_orderguide->ProductName->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="tbl_orderguide" data-field="x_ProductName" name="o<?php echo $tbl_orderguide_grid->RowIndex ?>_ProductName" id="o<?php echo $tbl_orderguide_grid->RowIndex ?>_ProductName" value="<?php echo HtmlEncode($tbl_orderguide->ProductName->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($tbl_orderguide->PCS_In->Visible) { // PCS_In ?>
		<td data-name="PCS_In">
<?php if (!$tbl_orderguide->isConfirm()) { ?>
<span id="el$rowindex$_tbl_orderguide_PCS_In" class="form-group tbl_orderguide_PCS_In">
<input type="text" data-table="tbl_orderguide" data-field="x_PCS_In" name="x<?php echo $tbl_orderguide_grid->RowIndex ?>_PCS_In" id="x<?php echo $tbl_orderguide_grid->RowIndex ?>_PCS_In" size="5" placeholder="<?php echo HtmlEncode($tbl_orderguide->PCS_In->getPlaceHolder()) ?>" value="<?php echo $tbl_orderguide->PCS_In->EditValue ?>"<?php echo $tbl_orderguide->PCS_In->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_tbl_orderguide_PCS_In" class="form-group tbl_orderguide_PCS_In">
<span<?php echo $tbl_orderguide->PCS_In->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?php echo RemoveHtml($tbl_orderguide->PCS_In->ViewValue) ?>"></span>
</span>
<input type="hidden" data-table="tbl_orderguide" data-field="x_PCS_In" name="x<?php echo $tbl_orderguide_grid->RowIndex ?>_PCS_In" id="x<?php echo $tbl_orderguide_grid->RowIndex ?>_PCS_In" value="<?php echo HtmlEncode($tbl_orderguide->PCS_In->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="tbl_orderguide" data-field="x_PCS_In" name="o<?php echo $tbl_orderguide_grid->RowIndex ?>_PCS_In" id="o<?php echo $tbl_orderguide_grid->RowIndex ?>_PCS_In" value="<?php echo HtmlEncode($tbl_orderguide->PCS_In->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($tbl_orderguide->PCS->Visible) { // PCS ?>
		<td data-name="PCS">
<?php if (!$tbl_orderguide->isConfirm()) { ?>
<span id="el$rowindex$_tbl_orderguide_PCS" class="form-group tbl_orderguide_PCS">
<input type="text" data-table="tbl_orderguide" data-field="x_PCS" name="x<?php echo $tbl_orderguide_grid->RowIndex ?>_PCS" id="x<?php echo $tbl_orderguide_grid->RowIndex ?>_PCS" size="5" placeholder="<?php echo HtmlEncode($tbl_orderguide->PCS->getPlaceHolder()) ?>" value="<?php echo $tbl_orderguide->PCS->EditValue ?>"<?php echo $tbl_orderguide->PCS->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_tbl_orderguide_PCS" class="form-group tbl_orderguide_PCS">
<span<?php echo $tbl_orderguide->PCS->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?php echo RemoveHtml($tbl_orderguide->PCS->ViewValue) ?>"></span>
</span>
<input type="hidden" data-table="tbl_orderguide" data-field="x_PCS" name="x<?php echo $tbl_orderguide_grid->RowIndex ?>_PCS" id="x<?php echo $tbl_orderguide_grid->RowIndex ?>_PCS" value="<?php echo HtmlEncode($tbl_orderguide->PCS->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="tbl_orderguide" data-field="x_PCS" name="o<?php echo $tbl_orderguide_grid->RowIndex ?>_PCS" id="o<?php echo $tbl_orderguide_grid->RowIndex ?>_PCS" value="<?php echo HtmlEncode($tbl_orderguide->PCS->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($tbl_orderguide->Qty->Visible) { // Qty ?>
		<td data-name="Qty">
<?php if (!$tbl_orderguide->isConfirm()) { ?>
<span id="el$rowindex$_tbl_orderguide_Qty" class="form-group tbl_orderguide_Qty">
<input type="text" data-table="tbl_orderguide" data-field="x_Qty" name="x<?php echo $tbl_orderguide_grid->RowIndex ?>_Qty" id="x<?php echo $tbl_orderguide_grid->RowIndex ?>_Qty" size="5" placeholder="<?php echo HtmlEncode($tbl_orderguide->Qty->getPlaceHolder()) ?>" value="<?php echo $tbl_orderguide->Qty->EditValue ?>"<?php echo $tbl_orderguide->Qty->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_tbl_orderguide_Qty" class="form-group tbl_orderguide_Qty">
<span<?php echo $tbl_orderguide->Qty->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?php echo RemoveHtml($tbl_orderguide->Qty->ViewValue) ?>"></span>
</span>
<input type="hidden" data-table="tbl_orderguide" data-field="x_Qty" name="x<?php echo $tbl_orderguide_grid->RowIndex ?>_Qty" id="x<?php echo $tbl_orderguide_grid->RowIndex ?>_Qty" value="<?php echo HtmlEncode($tbl_orderguide->Qty->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="tbl_orderguide" data-field="x_Qty" name="o<?php echo $tbl_orderguide_grid->RowIndex ?>_Qty" id="o<?php echo $tbl_orderguide_grid->RowIndex ?>_Qty" value="<?php echo HtmlEncode($tbl_orderguide->Qty->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($tbl_orderguide->Box->Visible) { // Box ?>
		<td data-name="Box">
<?php if (!$tbl_orderguide->isConfirm()) { ?>
<span id="el$rowindex$_tbl_orderguide_Box" class="form-group tbl_orderguide_Box">
<input type="text" data-table="tbl_orderguide" data-field="x_Box" name="x<?php echo $tbl_orderguide_grid->RowIndex ?>_Box" id="x<?php echo $tbl_orderguide_grid->RowIndex ?>_Box" size="5" placeholder="<?php echo HtmlEncode($tbl_orderguide->Box->getPlaceHolder()) ?>" value="<?php echo $tbl_orderguide->Box->EditValue ?>"<?php echo $tbl_orderguide->Box->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_tbl_orderguide_Box" class="form-group tbl_orderguide_Box">
<span<?php echo $tbl_orderguide->Box->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?php echo RemoveHtml($tbl_orderguide->Box->ViewValue) ?>"></span>
</span>
<input type="hidden" data-table="tbl_orderguide" data-field="x_Box" name="x<?php echo $tbl_orderguide_grid->RowIndex ?>_Box" id="x<?php echo $tbl_orderguide_grid->RowIndex ?>_Box" value="<?php echo HtmlEncode($tbl_orderguide->Box->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="tbl_orderguide" data-field="x_Box" name="o<?php echo $tbl_orderguide_grid->RowIndex ?>_Box" id="o<?php echo $tbl_orderguide_grid->RowIndex ?>_Box" value="<?php echo HtmlEncode($tbl_orderguide->Box->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($tbl_orderguide->ID_Location->Visible) { // ID_Location ?>
		<td data-name="ID_Location">
<?php if (!$tbl_orderguide->isConfirm()) { ?>
<span id="el$rowindex$_tbl_orderguide_ID_Location" class="form-group tbl_orderguide_ID_Location">
<?php
$wrkonchange = "" . trim(@$tbl_orderguide->ID_Location->EditAttrs["onchange"]);
if (trim($wrkonchange) <> "") $wrkonchange = " onchange=\"" . JsEncode($wrkonchange) . "\"";
$tbl_orderguide->ID_Location->EditAttrs["onchange"] = "";
?>
<span id="as_x<?php echo $tbl_orderguide_grid->RowIndex ?>_ID_Location" class="text-nowrap" style="z-index: <?php echo (9000 - $tbl_orderguide_grid->RowCnt * 10) ?>">
	<input type="text" class="form-control" name="sv_x<?php echo $tbl_orderguide_grid->RowIndex ?>_ID_Location" id="sv_x<?php echo $tbl_orderguide_grid->RowIndex ?>_ID_Location" value="<?php echo RemoveHtml($tbl_orderguide->ID_Location->EditValue) ?>" size="30" placeholder="<?php echo HtmlEncode($tbl_orderguide->ID_Location->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($tbl_orderguide->ID_Location->getPlaceHolder()) ?>"<?php echo $tbl_orderguide->ID_Location->editAttributes() ?>>
</span>
<input type="hidden" data-table="tbl_orderguide" data-field="x_ID_Location" data-value-separator="<?php echo $tbl_orderguide->ID_Location->displayValueSeparatorAttribute() ?>" name="x<?php echo $tbl_orderguide_grid->RowIndex ?>_ID_Location" id="x<?php echo $tbl_orderguide_grid->RowIndex ?>_ID_Location" value="<?php echo HtmlEncode($tbl_orderguide->ID_Location->CurrentValue) ?>"<?php echo $wrkonchange ?>>
<script>
ftbl_orderguidegrid.createAutoSuggest({"id":"x<?php echo $tbl_orderguide_grid->RowIndex ?>_ID_Location","forceSelect":true});
</script>
<?php echo $tbl_orderguide->ID_Location->Lookup->getParamTag("p_x" . $tbl_orderguide_grid->RowIndex . "_ID_Location") ?>
</span>
<?php } else { ?>
<span id="el$rowindex$_tbl_orderguide_ID_Location" class="form-group tbl_orderguide_ID_Location">
<span<?php echo $tbl_orderguide->ID_Location->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?php echo RemoveHtml($tbl_orderguide->ID_Location->ViewValue) ?>"></span>
</span>
<input type="hidden" data-table="tbl_orderguide" data-field="x_ID_Location" name="x<?php echo $tbl_orderguide_grid->RowIndex ?>_ID_Location" id="x<?php echo $tbl_orderguide_grid->RowIndex ?>_ID_Location" value="<?php echo HtmlEncode($tbl_orderguide->ID_Location->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="tbl_orderguide" data-field="x_ID_Location" name="o<?php echo $tbl_orderguide_grid->RowIndex ?>_ID_Location" id="o<?php echo $tbl_orderguide_grid->RowIndex ?>_ID_Location" value="<?php echo HtmlEncode($tbl_orderguide->ID_Location->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($tbl_orderguide->PalletID->Visible) { // PalletID ?>
		<td data-name="PalletID">
<?php if (!$tbl_orderguide->isConfirm()) { ?>
<span id="el$rowindex$_tbl_orderguide_PalletID" class="form-group tbl_orderguide_PalletID">
<input type="text" data-table="tbl_orderguide" data-field="x_PalletID" name="x<?php echo $tbl_orderguide_grid->RowIndex ?>_PalletID" id="x<?php echo $tbl_orderguide_grid->RowIndex ?>_PalletID" size="20" placeholder="<?php echo HtmlEncode($tbl_orderguide->PalletID->getPlaceHolder()) ?>" value="<?php echo $tbl_orderguide->PalletID->EditValue ?>"<?php echo $tbl_orderguide->PalletID->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_tbl_orderguide_PalletID" class="form-group tbl_orderguide_PalletID">
<span<?php echo $tbl_orderguide->PalletID->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?php echo RemoveHtml($tbl_orderguide->PalletID->ViewValue) ?>"></span>
</span>
<input type="hidden" data-table="tbl_orderguide" data-field="x_PalletID" name="x<?php echo $tbl_orderguide_grid->RowIndex ?>_PalletID" id="x<?php echo $tbl_orderguide_grid->RowIndex ?>_PalletID" value="<?php echo HtmlEncode($tbl_orderguide->PalletID->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="tbl_orderguide" data-field="x_PalletID" name="o<?php echo $tbl_orderguide_grid->RowIndex ?>_PalletID" id="o<?php echo $tbl_orderguide_grid->RowIndex ?>_PalletID" value="<?php echo HtmlEncode($tbl_orderguide->PalletID->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($tbl_orderguide->MFG->Visible) { // MFG ?>
		<td data-name="MFG">
<?php if (!$tbl_orderguide->isConfirm()) { ?>
<span id="el$rowindex$_tbl_orderguide_MFG" class="form-group tbl_orderguide_MFG">
<input type="text" data-table="tbl_orderguide" data-field="x_MFG" data-format="7" name="x<?php echo $tbl_orderguide_grid->RowIndex ?>_MFG" id="x<?php echo $tbl_orderguide_grid->RowIndex ?>_MFG" placeholder="<?php echo HtmlEncode($tbl_orderguide->MFG->getPlaceHolder()) ?>" value="<?php echo $tbl_orderguide->MFG->EditValue ?>"<?php echo $tbl_orderguide->MFG->editAttributes() ?>>
<?php if (!$tbl_orderguide->MFG->ReadOnly && !$tbl_orderguide->MFG->Disabled && !isset($tbl_orderguide->MFG->EditAttrs["readonly"]) && !isset($tbl_orderguide->MFG->EditAttrs["disabled"])) { ?>
<script>
ew.createDateTimePicker("ftbl_orderguidegrid", "x<?php echo $tbl_orderguide_grid->RowIndex ?>_MFG", {"ignoreReadonly":true,"useCurrent":false,"format":7});
</script>
<?php } ?>
</span>
<?php } else { ?>
<span id="el$rowindex$_tbl_orderguide_MFG" class="form-group tbl_orderguide_MFG">
<span<?php echo $tbl_orderguide->MFG->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?php echo RemoveHtml($tbl_orderguide->MFG->ViewValue) ?>"></span>
</span>
<input type="hidden" data-table="tbl_orderguide" data-field="x_MFG" name="x<?php echo $tbl_orderguide_grid->RowIndex ?>_MFG" id="x<?php echo $tbl_orderguide_grid->RowIndex ?>_MFG" value="<?php echo HtmlEncode($tbl_orderguide->MFG->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="tbl_orderguide" data-field="x_MFG" name="o<?php echo $tbl_orderguide_grid->RowIndex ?>_MFG" id="o<?php echo $tbl_orderguide_grid->RowIndex ?>_MFG" value="<?php echo HtmlEncode($tbl_orderguide->MFG->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($tbl_orderguide->DateIn->Visible) { // DateIn ?>
		<td data-name="DateIn">
<?php if (!$tbl_orderguide->isConfirm()) { ?>
<span id="el$rowindex$_tbl_orderguide_DateIn" class="form-group tbl_orderguide_DateIn">
<input type="text" data-table="tbl_orderguide" data-field="x_DateIn" data-format="11" name="x<?php echo $tbl_orderguide_grid->RowIndex ?>_DateIn" id="x<?php echo $tbl_orderguide_grid->RowIndex ?>_DateIn" placeholder="<?php echo HtmlEncode($tbl_orderguide->DateIn->getPlaceHolder()) ?>" value="<?php echo $tbl_orderguide->DateIn->EditValue ?>"<?php echo $tbl_orderguide->DateIn->editAttributes() ?>>
<?php if (!$tbl_orderguide->DateIn->ReadOnly && !$tbl_orderguide->DateIn->Disabled && !isset($tbl_orderguide->DateIn->EditAttrs["readonly"]) && !isset($tbl_orderguide->DateIn->EditAttrs["disabled"])) { ?>
<script>
ew.createDateTimePicker("ftbl_orderguidegrid", "x<?php echo $tbl_orderguide_grid->RowIndex ?>_DateIn", {"ignoreReadonly":true,"useCurrent":false,"format":11});
</script>
<?php } ?>
</span>
<?php } else { ?>
<span id="el$rowindex$_tbl_orderguide_DateIn" class="form-group tbl_orderguide_DateIn">
<span<?php echo $tbl_orderguide->DateIn->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?php echo RemoveHtml($tbl_orderguide->DateIn->ViewValue) ?>"></span>
</span>
<input type="hidden" data-table="tbl_orderguide" data-field="x_DateIn" name="x<?php echo $tbl_orderguide_grid->RowIndex ?>_DateIn" id="x<?php echo $tbl_orderguide_grid->RowIndex ?>_DateIn" value="<?php echo HtmlEncode($tbl_orderguide->DateIn->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="tbl_orderguide" data-field="x_DateIn" name="o<?php echo $tbl_orderguide_grid->RowIndex ?>_DateIn" id="o<?php echo $tbl_orderguide_grid->RowIndex ?>_DateIn" value="<?php echo HtmlEncode($tbl_orderguide->DateIn->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($tbl_orderguide->CreateDate->Visible) { // CreateDate ?>
		<td data-name="CreateDate">
<?php if (!$tbl_orderguide->isConfirm()) { ?>
<?php } else { ?>
<span id="el$rowindex$_tbl_orderguide_CreateDate" class="form-group tbl_orderguide_CreateDate">
<span<?php echo $tbl_orderguide->CreateDate->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?php echo RemoveHtml($tbl_orderguide->CreateDate->ViewValue) ?>"></span>
</span>
<input type="hidden" data-table="tbl_orderguide" data-field="x_CreateDate" name="x<?php echo $tbl_orderguide_grid->RowIndex ?>_CreateDate" id="x<?php echo $tbl_orderguide_grid->RowIndex ?>_CreateDate" value="<?php echo HtmlEncode($tbl_orderguide->CreateDate->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="tbl_orderguide" data-field="x_CreateDate" name="o<?php echo $tbl_orderguide_grid->RowIndex ?>_CreateDate" id="o<?php echo $tbl_orderguide_grid->RowIndex ?>_CreateDate" value="<?php echo HtmlEncode($tbl_orderguide->CreateDate->OldValue) ?>">
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$tbl_orderguide_grid->ListOptions->render("body", "right", $tbl_orderguide_grid->RowIndex);
?>
<script>
ftbl_orderguidegrid.updateLists(<?php echo $tbl_orderguide_grid->RowIndex ?>);
</script>
	</tr>
<?php
}
?>
</tbody>
</table><!-- /.ew-table -->
<?php if ($tbl_orderguide->CurrentMode == "add" || $tbl_orderguide->CurrentMode == "copy") { ?>
<input type="hidden" name="<?php echo $tbl_orderguide_grid->FormKeyCountName ?>" id="<?php echo $tbl_orderguide_grid->FormKeyCountName ?>" value="<?php echo $tbl_orderguide_grid->KeyCount ?>">
<?php echo $tbl_orderguide_grid->MultiSelectKey ?>
<?php } ?>
<?php if ($tbl_orderguide->CurrentMode == "edit") { ?>
<input type="hidden" name="<?php echo $tbl_orderguide_grid->FormKeyCountName ?>" id="<?php echo $tbl_orderguide_grid->FormKeyCountName ?>" value="<?php echo $tbl_orderguide_grid->KeyCount ?>">
<?php echo $tbl_orderguide_grid->MultiSelectKey ?>
<?php } ?>
<?php if ($tbl_orderguide->CurrentMode == "") { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
<input type="hidden" name="detailpage" value="ftbl_orderguidegrid">
</div><!-- /.ew-grid-middle-panel -->
<?php

// Close recordset
if ($tbl_orderguide_grid->Recordset)
	$tbl_orderguide_grid->Recordset->Close();
?>
</div>
<?php if ($tbl_orderguide_grid->ShowOtherOptions) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php $tbl_orderguide_grid->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($tbl_orderguide_grid->TotalRecs == 0 && !$tbl_orderguide->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $tbl_orderguide_grid->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$tbl_orderguide_grid->terminate();
?>