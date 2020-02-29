<?php
namespace PHPMaker2019\asgbn_wh;

// Write header
WriteHeader(FALSE);

// Create page object
if (!isset($vwPackingdetail_grid))
	$vwPackingdetail_grid = new vwPackingdetail_grid();

// Run the page
$vwPackingdetail_grid->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$vwPackingdetail_grid->Page_Render();
?>
<?php if (!$vwPackingdetail->isExport()) { ?>
<script>

// Form object
var fvwPackingdetailgrid = new ew.Form("fvwPackingdetailgrid", "grid");
fvwPackingdetailgrid.formKeyCountName = '<?php echo $vwPackingdetail_grid->FormKeyCountName ?>';

// Validate form
fvwPackingdetailgrid.validate = function() {
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
		<?php if ($vwPackingdetail_grid->Id_packing->Required) { ?>
			elm = this.getElements("x" + infix + "_Id_packing");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $vwPackingdetail->Id_packing->caption(), $vwPackingdetail->Id_packing->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($vwPackingdetail_grid->Code->Required) { ?>
			elm = this.getElements("x" + infix + "_Code");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $vwPackingdetail->Code->caption(), $vwPackingdetail->Code->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($vwPackingdetail_grid->PCS->Required) { ?>
			elm = this.getElements("x" + infix + "_PCS");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $vwPackingdetail->PCS->caption(), $vwPackingdetail->PCS->RequiredErrorMessage)) ?>");
		<?php } ?>
			elm = this.getElements("x" + infix + "_PCS");
			if (elm && !ew.checkInteger(elm.value))
				return this.onError(elm, "<?php echo JsEncode($vwPackingdetail->PCS->errorMessage()) ?>");
		<?php if ($vwPackingdetail_grid->PackingType->Required) { ?>
			elm = this.getElements("x" + infix + "_PackingType");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $vwPackingdetail->PackingType->caption(), $vwPackingdetail->PackingType->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($vwPackingdetail_grid->Length->Required) { ?>
			elm = this.getElements("x" + infix + "_Length");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $vwPackingdetail->Length->caption(), $vwPackingdetail->Length->RequiredErrorMessage)) ?>");
		<?php } ?>
			elm = this.getElements("x" + infix + "_Length");
			if (elm && !ew.checkInteger(elm.value))
				return this.onError(elm, "<?php echo JsEncode($vwPackingdetail->Length->errorMessage()) ?>");
		<?php if ($vwPackingdetail_grid->Width->Required) { ?>
			elm = this.getElements("x" + infix + "_Width");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $vwPackingdetail->Width->caption(), $vwPackingdetail->Width->RequiredErrorMessage)) ?>");
		<?php } ?>
			elm = this.getElements("x" + infix + "_Width");
			if (elm && !ew.checkInteger(elm.value))
				return this.onError(elm, "<?php echo JsEncode($vwPackingdetail->Width->errorMessage()) ?>");
		<?php if ($vwPackingdetail_grid->Heigth->Required) { ?>
			elm = this.getElements("x" + infix + "_Heigth");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $vwPackingdetail->Heigth->caption(), $vwPackingdetail->Heigth->RequiredErrorMessage)) ?>");
		<?php } ?>
			elm = this.getElements("x" + infix + "_Heigth");
			if (elm && !ew.checkInteger(elm.value))
				return this.onError(elm, "<?php echo JsEncode($vwPackingdetail->Heigth->errorMessage()) ?>");
		<?php if ($vwPackingdetail_grid->finishpacking->Required) { ?>
			elm = this.getElements("x" + infix + "_finishpacking");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $vwPackingdetail->finishpacking->caption(), $vwPackingdetail->finishpacking->RequiredErrorMessage)) ?>");
		<?php } ?>
			elm = this.getElements("x" + infix + "_finishpacking");
			if (elm && !ew.checkInteger(elm.value))
				return this.onError(elm, "<?php echo JsEncode($vwPackingdetail->finishpacking->errorMessage()) ?>");
		<?php if ($vwPackingdetail_grid->PE_film_Cover->Required) { ?>
			elm = this.getElements("x" + infix + "_PE_film_Cover");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $vwPackingdetail->PE_film_Cover->caption(), $vwPackingdetail->PE_film_Cover->RequiredErrorMessage)) ?>");
		<?php } ?>
			elm = this.getElements("x" + infix + "_PE_film_Cover");
			if (elm && !ew.checkInteger(elm.value))
				return this.onError(elm, "<?php echo JsEncode($vwPackingdetail->PE_film_Cover->errorMessage()) ?>");
		<?php if ($vwPackingdetail_grid->CreateUser->Required) { ?>
			elm = this.getElements("x" + infix + "_CreateUser");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $vwPackingdetail->CreateUser->caption(), $vwPackingdetail->CreateUser->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($vwPackingdetail_grid->CreateDate->Required) { ?>
			elm = this.getElements("x" + infix + "_CreateDate");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $vwPackingdetail->CreateDate->caption(), $vwPackingdetail->CreateDate->RequiredErrorMessage)) ?>");
		<?php } ?>
			elm = this.getElements("x" + infix + "_CreateDate");
			if (elm && !ew.checkDateDef(elm.value))
				return this.onError(elm, "<?php echo JsEncode($vwPackingdetail->CreateDate->errorMessage()) ?>");
		<?php if ($vwPackingdetail_grid->Box->Required) { ?>
			elm = this.getElements("x" + infix + "_Box");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $vwPackingdetail->Box->caption(), $vwPackingdetail->Box->RequiredErrorMessage)) ?>");
		<?php } ?>
			elm = this.getElements("x" + infix + "_Box");
			if (elm && !ew.checkInteger(elm.value))
				return this.onError(elm, "<?php echo JsEncode($vwPackingdetail->Box->errorMessage()) ?>");

			// Fire Form_CustomValidate event
			if (!this.Form_CustomValidate(fobj))
				return false;
		} // End Grid Add checking
	}
	return true;
}

// Check empty row
fvwPackingdetailgrid.emptyRow = function(infix) {
	var fobj = this._form;
	if (ew.valueChanged(fobj, infix, "Code", false)) return false;
	if (ew.valueChanged(fobj, infix, "PCS", false)) return false;
	if (ew.valueChanged(fobj, infix, "PackingType", false)) return false;
	if (ew.valueChanged(fobj, infix, "Length", false)) return false;
	if (ew.valueChanged(fobj, infix, "Width", false)) return false;
	if (ew.valueChanged(fobj, infix, "Heigth", false)) return false;
	if (ew.valueChanged(fobj, infix, "finishpacking", false)) return false;
	if (ew.valueChanged(fobj, infix, "PE_film_Cover", false)) return false;
	if (ew.valueChanged(fobj, infix, "CreateUser", false)) return false;
	if (ew.valueChanged(fobj, infix, "CreateDate", false)) return false;
	if (ew.valueChanged(fobj, infix, "Box", false)) return false;
	return true;
}

// Form_CustomValidate event
fvwPackingdetailgrid.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

	// Your custom validation code here, return false if invalid.
	return true;
}

// Use JavaScript validation or not
fvwPackingdetailgrid.validateRequired = <?php echo json_encode(CLIENT_VALIDATE) ?>;

// Dynamic selection lists
// Form object for search

</script>
<?php } ?>
<?php
$vwPackingdetail_grid->renderOtherOptions();
?>
<?php $vwPackingdetail_grid->showPageHeader(); ?>
<?php
$vwPackingdetail_grid->showMessage();
?>
<?php if ($vwPackingdetail_grid->TotalRecs > 0 || $vwPackingdetail->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($vwPackingdetail_grid->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> vwPackingdetail">
<?php if ($vwPackingdetail_grid->ShowOtherOptions) { ?>
<div class="card-header ew-grid-upper-panel">
<?php $vwPackingdetail_grid->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<div id="fvwPackingdetailgrid" class="ew-form ew-list-form form-inline">
<div id="gmp_vwPackingdetail" class="<?php if (IsResponsiveLayout()) { ?>table-responsive <?php } ?>card-body ew-grid-middle-panel">
<table id="tbl_vwPackingdetailgrid" class="table ew-table"><!-- .ew-table ##-->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$vwPackingdetail_grid->RowType = ROWTYPE_HEADER;

// Render list options
$vwPackingdetail_grid->renderListOptions();

// Render list options (header, left)
$vwPackingdetail_grid->ListOptions->render("header", "left");
?>
<?php if ($vwPackingdetail->Id_packing->Visible) { // Id_packing ?>
	<?php if ($vwPackingdetail->sortUrl($vwPackingdetail->Id_packing) == "") { ?>
		<th data-name="Id_packing" class="<?php echo $vwPackingdetail->Id_packing->headerCellClass() ?>"><div id="elh_vwPackingdetail_Id_packing" class="vwPackingdetail_Id_packing"><div class="ew-table-header-caption"><?php echo $vwPackingdetail->Id_packing->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Id_packing" class="<?php echo $vwPackingdetail->Id_packing->headerCellClass() ?>"><div><div id="elh_vwPackingdetail_Id_packing" class="vwPackingdetail_Id_packing">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $vwPackingdetail->Id_packing->caption() ?></span><span class="ew-table-header-sort"><?php if ($vwPackingdetail->Id_packing->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($vwPackingdetail->Id_packing->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($vwPackingdetail->Code->Visible) { // Code ?>
	<?php if ($vwPackingdetail->sortUrl($vwPackingdetail->Code) == "") { ?>
		<th data-name="Code" class="<?php echo $vwPackingdetail->Code->headerCellClass() ?>"><div id="elh_vwPackingdetail_Code" class="vwPackingdetail_Code"><div class="ew-table-header-caption"><?php echo $vwPackingdetail->Code->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Code" class="<?php echo $vwPackingdetail->Code->headerCellClass() ?>"><div><div id="elh_vwPackingdetail_Code" class="vwPackingdetail_Code">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $vwPackingdetail->Code->caption() ?></span><span class="ew-table-header-sort"><?php if ($vwPackingdetail->Code->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($vwPackingdetail->Code->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($vwPackingdetail->PCS->Visible) { // PCS ?>
	<?php if ($vwPackingdetail->sortUrl($vwPackingdetail->PCS) == "") { ?>
		<th data-name="PCS" class="<?php echo $vwPackingdetail->PCS->headerCellClass() ?>"><div id="elh_vwPackingdetail_PCS" class="vwPackingdetail_PCS"><div class="ew-table-header-caption"><?php echo $vwPackingdetail->PCS->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="PCS" class="<?php echo $vwPackingdetail->PCS->headerCellClass() ?>"><div><div id="elh_vwPackingdetail_PCS" class="vwPackingdetail_PCS">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $vwPackingdetail->PCS->caption() ?></span><span class="ew-table-header-sort"><?php if ($vwPackingdetail->PCS->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($vwPackingdetail->PCS->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($vwPackingdetail->PackingType->Visible) { // PackingType ?>
	<?php if ($vwPackingdetail->sortUrl($vwPackingdetail->PackingType) == "") { ?>
		<th data-name="PackingType" class="<?php echo $vwPackingdetail->PackingType->headerCellClass() ?>"><div id="elh_vwPackingdetail_PackingType" class="vwPackingdetail_PackingType"><div class="ew-table-header-caption"><?php echo $vwPackingdetail->PackingType->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="PackingType" class="<?php echo $vwPackingdetail->PackingType->headerCellClass() ?>"><div><div id="elh_vwPackingdetail_PackingType" class="vwPackingdetail_PackingType">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $vwPackingdetail->PackingType->caption() ?></span><span class="ew-table-header-sort"><?php if ($vwPackingdetail->PackingType->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($vwPackingdetail->PackingType->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($vwPackingdetail->Length->Visible) { // Length ?>
	<?php if ($vwPackingdetail->sortUrl($vwPackingdetail->Length) == "") { ?>
		<th data-name="Length" class="<?php echo $vwPackingdetail->Length->headerCellClass() ?>"><div id="elh_vwPackingdetail_Length" class="vwPackingdetail_Length"><div class="ew-table-header-caption"><?php echo $vwPackingdetail->Length->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Length" class="<?php echo $vwPackingdetail->Length->headerCellClass() ?>"><div><div id="elh_vwPackingdetail_Length" class="vwPackingdetail_Length">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $vwPackingdetail->Length->caption() ?></span><span class="ew-table-header-sort"><?php if ($vwPackingdetail->Length->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($vwPackingdetail->Length->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($vwPackingdetail->Width->Visible) { // Width ?>
	<?php if ($vwPackingdetail->sortUrl($vwPackingdetail->Width) == "") { ?>
		<th data-name="Width" class="<?php echo $vwPackingdetail->Width->headerCellClass() ?>"><div id="elh_vwPackingdetail_Width" class="vwPackingdetail_Width"><div class="ew-table-header-caption"><?php echo $vwPackingdetail->Width->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Width" class="<?php echo $vwPackingdetail->Width->headerCellClass() ?>"><div><div id="elh_vwPackingdetail_Width" class="vwPackingdetail_Width">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $vwPackingdetail->Width->caption() ?></span><span class="ew-table-header-sort"><?php if ($vwPackingdetail->Width->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($vwPackingdetail->Width->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($vwPackingdetail->Heigth->Visible) { // Heigth ?>
	<?php if ($vwPackingdetail->sortUrl($vwPackingdetail->Heigth) == "") { ?>
		<th data-name="Heigth" class="<?php echo $vwPackingdetail->Heigth->headerCellClass() ?>"><div id="elh_vwPackingdetail_Heigth" class="vwPackingdetail_Heigth"><div class="ew-table-header-caption"><?php echo $vwPackingdetail->Heigth->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Heigth" class="<?php echo $vwPackingdetail->Heigth->headerCellClass() ?>"><div><div id="elh_vwPackingdetail_Heigth" class="vwPackingdetail_Heigth">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $vwPackingdetail->Heigth->caption() ?></span><span class="ew-table-header-sort"><?php if ($vwPackingdetail->Heigth->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($vwPackingdetail->Heigth->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($vwPackingdetail->finishpacking->Visible) { // finishpacking ?>
	<?php if ($vwPackingdetail->sortUrl($vwPackingdetail->finishpacking) == "") { ?>
		<th data-name="finishpacking" class="<?php echo $vwPackingdetail->finishpacking->headerCellClass() ?>"><div id="elh_vwPackingdetail_finishpacking" class="vwPackingdetail_finishpacking"><div class="ew-table-header-caption"><?php echo $vwPackingdetail->finishpacking->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="finishpacking" class="<?php echo $vwPackingdetail->finishpacking->headerCellClass() ?>"><div><div id="elh_vwPackingdetail_finishpacking" class="vwPackingdetail_finishpacking">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $vwPackingdetail->finishpacking->caption() ?></span><span class="ew-table-header-sort"><?php if ($vwPackingdetail->finishpacking->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($vwPackingdetail->finishpacking->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($vwPackingdetail->PE_film_Cover->Visible) { // PE_film_Cover ?>
	<?php if ($vwPackingdetail->sortUrl($vwPackingdetail->PE_film_Cover) == "") { ?>
		<th data-name="PE_film_Cover" class="<?php echo $vwPackingdetail->PE_film_Cover->headerCellClass() ?>"><div id="elh_vwPackingdetail_PE_film_Cover" class="vwPackingdetail_PE_film_Cover"><div class="ew-table-header-caption"><?php echo $vwPackingdetail->PE_film_Cover->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="PE_film_Cover" class="<?php echo $vwPackingdetail->PE_film_Cover->headerCellClass() ?>"><div><div id="elh_vwPackingdetail_PE_film_Cover" class="vwPackingdetail_PE_film_Cover">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $vwPackingdetail->PE_film_Cover->caption() ?></span><span class="ew-table-header-sort"><?php if ($vwPackingdetail->PE_film_Cover->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($vwPackingdetail->PE_film_Cover->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($vwPackingdetail->CreateUser->Visible) { // CreateUser ?>
	<?php if ($vwPackingdetail->sortUrl($vwPackingdetail->CreateUser) == "") { ?>
		<th data-name="CreateUser" class="<?php echo $vwPackingdetail->CreateUser->headerCellClass() ?>"><div id="elh_vwPackingdetail_CreateUser" class="vwPackingdetail_CreateUser"><div class="ew-table-header-caption"><?php echo $vwPackingdetail->CreateUser->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="CreateUser" class="<?php echo $vwPackingdetail->CreateUser->headerCellClass() ?>"><div><div id="elh_vwPackingdetail_CreateUser" class="vwPackingdetail_CreateUser">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $vwPackingdetail->CreateUser->caption() ?></span><span class="ew-table-header-sort"><?php if ($vwPackingdetail->CreateUser->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($vwPackingdetail->CreateUser->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($vwPackingdetail->CreateDate->Visible) { // CreateDate ?>
	<?php if ($vwPackingdetail->sortUrl($vwPackingdetail->CreateDate) == "") { ?>
		<th data-name="CreateDate" class="<?php echo $vwPackingdetail->CreateDate->headerCellClass() ?>"><div id="elh_vwPackingdetail_CreateDate" class="vwPackingdetail_CreateDate"><div class="ew-table-header-caption"><?php echo $vwPackingdetail->CreateDate->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="CreateDate" class="<?php echo $vwPackingdetail->CreateDate->headerCellClass() ?>"><div><div id="elh_vwPackingdetail_CreateDate" class="vwPackingdetail_CreateDate">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $vwPackingdetail->CreateDate->caption() ?></span><span class="ew-table-header-sort"><?php if ($vwPackingdetail->CreateDate->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($vwPackingdetail->CreateDate->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($vwPackingdetail->Box->Visible) { // Box ?>
	<?php if ($vwPackingdetail->sortUrl($vwPackingdetail->Box) == "") { ?>
		<th data-name="Box" class="<?php echo $vwPackingdetail->Box->headerCellClass() ?>"><div id="elh_vwPackingdetail_Box" class="vwPackingdetail_Box"><div class="ew-table-header-caption"><?php echo $vwPackingdetail->Box->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Box" class="<?php echo $vwPackingdetail->Box->headerCellClass() ?>"><div><div id="elh_vwPackingdetail_Box" class="vwPackingdetail_Box">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $vwPackingdetail->Box->caption() ?></span><span class="ew-table-header-sort"><?php if ($vwPackingdetail->Box->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($vwPackingdetail->Box->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$vwPackingdetail_grid->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
$vwPackingdetail_grid->StartRec = 1;
$vwPackingdetail_grid->StopRec = $vwPackingdetail_grid->TotalRecs; // Show all records

// Restore number of post back records
if ($CurrentForm && $vwPackingdetail_grid->EventCancelled) {
	$CurrentForm->Index = -1;
	if ($CurrentForm->hasValue($vwPackingdetail_grid->FormKeyCountName) && ($vwPackingdetail->isGridAdd() || $vwPackingdetail->isGridEdit() || $vwPackingdetail->isConfirm())) {
		$vwPackingdetail_grid->KeyCount = $CurrentForm->getValue($vwPackingdetail_grid->FormKeyCountName);
		$vwPackingdetail_grid->StopRec = $vwPackingdetail_grid->StartRec + $vwPackingdetail_grid->KeyCount - 1;
	}
}
$vwPackingdetail_grid->RecCnt = $vwPackingdetail_grid->StartRec - 1;
if ($vwPackingdetail_grid->Recordset && !$vwPackingdetail_grid->Recordset->EOF) {
	$vwPackingdetail_grid->Recordset->moveFirst();
	$selectLimit = $vwPackingdetail_grid->UseSelectLimit;
	if (!$selectLimit && $vwPackingdetail_grid->StartRec > 1)
		$vwPackingdetail_grid->Recordset->move($vwPackingdetail_grid->StartRec - 1);
} elseif (!$vwPackingdetail->AllowAddDeleteRow && $vwPackingdetail_grid->StopRec == 0) {
	$vwPackingdetail_grid->StopRec = $vwPackingdetail->GridAddRowCount;
}

// Initialize aggregate
$vwPackingdetail->RowType = ROWTYPE_AGGREGATEINIT;
$vwPackingdetail->resetAttributes();
$vwPackingdetail_grid->renderRow();
if ($vwPackingdetail->isGridAdd())
	$vwPackingdetail_grid->RowIndex = 0;
if ($vwPackingdetail->isGridEdit())
	$vwPackingdetail_grid->RowIndex = 0;
while ($vwPackingdetail_grid->RecCnt < $vwPackingdetail_grid->StopRec) {
	$vwPackingdetail_grid->RecCnt++;
	if ($vwPackingdetail_grid->RecCnt >= $vwPackingdetail_grid->StartRec) {
		$vwPackingdetail_grid->RowCnt++;
		if ($vwPackingdetail->isGridAdd() || $vwPackingdetail->isGridEdit() || $vwPackingdetail->isConfirm()) {
			$vwPackingdetail_grid->RowIndex++;
			$CurrentForm->Index = $vwPackingdetail_grid->RowIndex;
			if ($CurrentForm->hasValue($vwPackingdetail_grid->FormActionName) && $vwPackingdetail_grid->EventCancelled)
				$vwPackingdetail_grid->RowAction = strval($CurrentForm->getValue($vwPackingdetail_grid->FormActionName));
			elseif ($vwPackingdetail->isGridAdd())
				$vwPackingdetail_grid->RowAction = "insert";
			else
				$vwPackingdetail_grid->RowAction = "";
		}

		// Set up key count
		$vwPackingdetail_grid->KeyCount = $vwPackingdetail_grid->RowIndex;

		// Init row class and style
		$vwPackingdetail->resetAttributes();
		$vwPackingdetail->CssClass = "";
		if ($vwPackingdetail->isGridAdd()) {
			if ($vwPackingdetail->CurrentMode == "copy") {
				$vwPackingdetail_grid->loadRowValues($vwPackingdetail_grid->Recordset); // Load row values
				$vwPackingdetail_grid->setRecordKey($vwPackingdetail_grid->RowOldKey, $vwPackingdetail_grid->Recordset); // Set old record key
			} else {
				$vwPackingdetail_grid->loadRowValues(); // Load default values
				$vwPackingdetail_grid->RowOldKey = ""; // Clear old key value
			}
		} else {
			$vwPackingdetail_grid->loadRowValues($vwPackingdetail_grid->Recordset); // Load row values
		}
		$vwPackingdetail->RowType = ROWTYPE_VIEW; // Render view
		if ($vwPackingdetail->isGridAdd()) // Grid add
			$vwPackingdetail->RowType = ROWTYPE_ADD; // Render add
		if ($vwPackingdetail->isGridAdd() && $vwPackingdetail->EventCancelled && !$CurrentForm->hasValue("k_blankrow")) // Insert failed
			$vwPackingdetail_grid->restoreCurrentRowFormValues($vwPackingdetail_grid->RowIndex); // Restore form values
		if ($vwPackingdetail->isGridEdit()) { // Grid edit
			if ($vwPackingdetail->EventCancelled)
				$vwPackingdetail_grid->restoreCurrentRowFormValues($vwPackingdetail_grid->RowIndex); // Restore form values
			if ($vwPackingdetail_grid->RowAction == "insert")
				$vwPackingdetail->RowType = ROWTYPE_ADD; // Render add
			else
				$vwPackingdetail->RowType = ROWTYPE_EDIT; // Render edit
		}
		if ($vwPackingdetail->isGridEdit() && ($vwPackingdetail->RowType == ROWTYPE_EDIT || $vwPackingdetail->RowType == ROWTYPE_ADD) && $vwPackingdetail->EventCancelled) // Update failed
			$vwPackingdetail_grid->restoreCurrentRowFormValues($vwPackingdetail_grid->RowIndex); // Restore form values
		if ($vwPackingdetail->RowType == ROWTYPE_EDIT) // Edit row
			$vwPackingdetail_grid->EditRowCnt++;
		if ($vwPackingdetail->isConfirm()) // Confirm row
			$vwPackingdetail_grid->restoreCurrentRowFormValues($vwPackingdetail_grid->RowIndex); // Restore form values

		// Set up row id / data-rowindex
		$vwPackingdetail->RowAttrs = array_merge($vwPackingdetail->RowAttrs, array('data-rowindex'=>$vwPackingdetail_grid->RowCnt, 'id'=>'r' . $vwPackingdetail_grid->RowCnt . '_vwPackingdetail', 'data-rowtype'=>$vwPackingdetail->RowType));

		// Render row
		$vwPackingdetail_grid->renderRow();

		// Render list options
		$vwPackingdetail_grid->renderListOptions();

		// Skip delete row / empty row for confirm page
		if ($vwPackingdetail_grid->RowAction <> "delete" && $vwPackingdetail_grid->RowAction <> "insertdelete" && !($vwPackingdetail_grid->RowAction == "insert" && $vwPackingdetail->isConfirm() && $vwPackingdetail_grid->emptyRow())) {
?>
	<tr<?php echo $vwPackingdetail->rowAttributes() ?>>
<?php

// Render list options (body, left)
$vwPackingdetail_grid->ListOptions->render("body", "left", $vwPackingdetail_grid->RowCnt);
?>
	<?php if ($vwPackingdetail->Id_packing->Visible) { // Id_packing ?>
		<td data-name="Id_packing"<?php echo $vwPackingdetail->Id_packing->cellAttributes() ?>>
<?php if ($vwPackingdetail->RowType == ROWTYPE_ADD) { // Add record ?>
<input type="hidden" data-table="vwPackingdetail" data-field="x_Id_packing" name="o<?php echo $vwPackingdetail_grid->RowIndex ?>_Id_packing" id="o<?php echo $vwPackingdetail_grid->RowIndex ?>_Id_packing" value="<?php echo HtmlEncode($vwPackingdetail->Id_packing->OldValue) ?>">
<?php } ?>
<?php if ($vwPackingdetail->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $vwPackingdetail_grid->RowCnt ?>_vwPackingdetail_Id_packing" class="form-group vwPackingdetail_Id_packing">
<span<?php echo $vwPackingdetail->Id_packing->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?php echo RemoveHtml($vwPackingdetail->Id_packing->EditValue) ?>"></span>
</span>
<input type="hidden" data-table="vwPackingdetail" data-field="x_Id_packing" name="x<?php echo $vwPackingdetail_grid->RowIndex ?>_Id_packing" id="x<?php echo $vwPackingdetail_grid->RowIndex ?>_Id_packing" value="<?php echo HtmlEncode($vwPackingdetail->Id_packing->CurrentValue) ?>">
<?php } ?>
<?php if ($vwPackingdetail->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $vwPackingdetail_grid->RowCnt ?>_vwPackingdetail_Id_packing" class="vwPackingdetail_Id_packing">
<span<?php echo $vwPackingdetail->Id_packing->viewAttributes() ?>>
<?php echo $vwPackingdetail->Id_packing->getViewValue() ?></span>
</span>
<?php if (!$vwPackingdetail->isConfirm()) { ?>
<input type="hidden" data-table="vwPackingdetail" data-field="x_Id_packing" name="x<?php echo $vwPackingdetail_grid->RowIndex ?>_Id_packing" id="x<?php echo $vwPackingdetail_grid->RowIndex ?>_Id_packing" value="<?php echo HtmlEncode($vwPackingdetail->Id_packing->FormValue) ?>">
<input type="hidden" data-table="vwPackingdetail" data-field="x_Id_packing" name="o<?php echo $vwPackingdetail_grid->RowIndex ?>_Id_packing" id="o<?php echo $vwPackingdetail_grid->RowIndex ?>_Id_packing" value="<?php echo HtmlEncode($vwPackingdetail->Id_packing->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="vwPackingdetail" data-field="x_Id_packing" name="fvwPackingdetailgrid$x<?php echo $vwPackingdetail_grid->RowIndex ?>_Id_packing" id="fvwPackingdetailgrid$x<?php echo $vwPackingdetail_grid->RowIndex ?>_Id_packing" value="<?php echo HtmlEncode($vwPackingdetail->Id_packing->FormValue) ?>">
<input type="hidden" data-table="vwPackingdetail" data-field="x_Id_packing" name="fvwPackingdetailgrid$o<?php echo $vwPackingdetail_grid->RowIndex ?>_Id_packing" id="fvwPackingdetailgrid$o<?php echo $vwPackingdetail_grid->RowIndex ?>_Id_packing" value="<?php echo HtmlEncode($vwPackingdetail->Id_packing->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($vwPackingdetail->Code->Visible) { // Code ?>
		<td data-name="Code"<?php echo $vwPackingdetail->Code->cellAttributes() ?>>
<?php if ($vwPackingdetail->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $vwPackingdetail_grid->RowCnt ?>_vwPackingdetail_Code" class="form-group vwPackingdetail_Code">
<input type="text" data-table="vwPackingdetail" data-field="x_Code" name="x<?php echo $vwPackingdetail_grid->RowIndex ?>_Code" id="x<?php echo $vwPackingdetail_grid->RowIndex ?>_Code" size="30" maxlength="55" placeholder="<?php echo HtmlEncode($vwPackingdetail->Code->getPlaceHolder()) ?>" value="<?php echo $vwPackingdetail->Code->EditValue ?>"<?php echo $vwPackingdetail->Code->editAttributes() ?>>
</span>
<input type="hidden" data-table="vwPackingdetail" data-field="x_Code" name="o<?php echo $vwPackingdetail_grid->RowIndex ?>_Code" id="o<?php echo $vwPackingdetail_grid->RowIndex ?>_Code" value="<?php echo HtmlEncode($vwPackingdetail->Code->OldValue) ?>">
<?php } ?>
<?php if ($vwPackingdetail->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $vwPackingdetail_grid->RowCnt ?>_vwPackingdetail_Code" class="form-group vwPackingdetail_Code">
<input type="text" data-table="vwPackingdetail" data-field="x_Code" name="x<?php echo $vwPackingdetail_grid->RowIndex ?>_Code" id="x<?php echo $vwPackingdetail_grid->RowIndex ?>_Code" size="30" maxlength="55" placeholder="<?php echo HtmlEncode($vwPackingdetail->Code->getPlaceHolder()) ?>" value="<?php echo $vwPackingdetail->Code->EditValue ?>"<?php echo $vwPackingdetail->Code->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($vwPackingdetail->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $vwPackingdetail_grid->RowCnt ?>_vwPackingdetail_Code" class="vwPackingdetail_Code">
<span<?php echo $vwPackingdetail->Code->viewAttributes() ?>>
<?php echo $vwPackingdetail->Code->getViewValue() ?></span>
</span>
<?php if (!$vwPackingdetail->isConfirm()) { ?>
<input type="hidden" data-table="vwPackingdetail" data-field="x_Code" name="x<?php echo $vwPackingdetail_grid->RowIndex ?>_Code" id="x<?php echo $vwPackingdetail_grid->RowIndex ?>_Code" value="<?php echo HtmlEncode($vwPackingdetail->Code->FormValue) ?>">
<input type="hidden" data-table="vwPackingdetail" data-field="x_Code" name="o<?php echo $vwPackingdetail_grid->RowIndex ?>_Code" id="o<?php echo $vwPackingdetail_grid->RowIndex ?>_Code" value="<?php echo HtmlEncode($vwPackingdetail->Code->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="vwPackingdetail" data-field="x_Code" name="fvwPackingdetailgrid$x<?php echo $vwPackingdetail_grid->RowIndex ?>_Code" id="fvwPackingdetailgrid$x<?php echo $vwPackingdetail_grid->RowIndex ?>_Code" value="<?php echo HtmlEncode($vwPackingdetail->Code->FormValue) ?>">
<input type="hidden" data-table="vwPackingdetail" data-field="x_Code" name="fvwPackingdetailgrid$o<?php echo $vwPackingdetail_grid->RowIndex ?>_Code" id="fvwPackingdetailgrid$o<?php echo $vwPackingdetail_grid->RowIndex ?>_Code" value="<?php echo HtmlEncode($vwPackingdetail->Code->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($vwPackingdetail->PCS->Visible) { // PCS ?>
		<td data-name="PCS"<?php echo $vwPackingdetail->PCS->cellAttributes() ?>>
<?php if ($vwPackingdetail->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $vwPackingdetail_grid->RowCnt ?>_vwPackingdetail_PCS" class="form-group vwPackingdetail_PCS">
<input type="text" data-table="vwPackingdetail" data-field="x_PCS" name="x<?php echo $vwPackingdetail_grid->RowIndex ?>_PCS" id="x<?php echo $vwPackingdetail_grid->RowIndex ?>_PCS" size="30" placeholder="<?php echo HtmlEncode($vwPackingdetail->PCS->getPlaceHolder()) ?>" value="<?php echo $vwPackingdetail->PCS->EditValue ?>"<?php echo $vwPackingdetail->PCS->editAttributes() ?>>
</span>
<input type="hidden" data-table="vwPackingdetail" data-field="x_PCS" name="o<?php echo $vwPackingdetail_grid->RowIndex ?>_PCS" id="o<?php echo $vwPackingdetail_grid->RowIndex ?>_PCS" value="<?php echo HtmlEncode($vwPackingdetail->PCS->OldValue) ?>">
<?php } ?>
<?php if ($vwPackingdetail->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $vwPackingdetail_grid->RowCnt ?>_vwPackingdetail_PCS" class="form-group vwPackingdetail_PCS">
<input type="text" data-table="vwPackingdetail" data-field="x_PCS" name="x<?php echo $vwPackingdetail_grid->RowIndex ?>_PCS" id="x<?php echo $vwPackingdetail_grid->RowIndex ?>_PCS" size="30" placeholder="<?php echo HtmlEncode($vwPackingdetail->PCS->getPlaceHolder()) ?>" value="<?php echo $vwPackingdetail->PCS->EditValue ?>"<?php echo $vwPackingdetail->PCS->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($vwPackingdetail->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $vwPackingdetail_grid->RowCnt ?>_vwPackingdetail_PCS" class="vwPackingdetail_PCS">
<span<?php echo $vwPackingdetail->PCS->viewAttributes() ?>>
<?php echo $vwPackingdetail->PCS->getViewValue() ?></span>
</span>
<?php if (!$vwPackingdetail->isConfirm()) { ?>
<input type="hidden" data-table="vwPackingdetail" data-field="x_PCS" name="x<?php echo $vwPackingdetail_grid->RowIndex ?>_PCS" id="x<?php echo $vwPackingdetail_grid->RowIndex ?>_PCS" value="<?php echo HtmlEncode($vwPackingdetail->PCS->FormValue) ?>">
<input type="hidden" data-table="vwPackingdetail" data-field="x_PCS" name="o<?php echo $vwPackingdetail_grid->RowIndex ?>_PCS" id="o<?php echo $vwPackingdetail_grid->RowIndex ?>_PCS" value="<?php echo HtmlEncode($vwPackingdetail->PCS->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="vwPackingdetail" data-field="x_PCS" name="fvwPackingdetailgrid$x<?php echo $vwPackingdetail_grid->RowIndex ?>_PCS" id="fvwPackingdetailgrid$x<?php echo $vwPackingdetail_grid->RowIndex ?>_PCS" value="<?php echo HtmlEncode($vwPackingdetail->PCS->FormValue) ?>">
<input type="hidden" data-table="vwPackingdetail" data-field="x_PCS" name="fvwPackingdetailgrid$o<?php echo $vwPackingdetail_grid->RowIndex ?>_PCS" id="fvwPackingdetailgrid$o<?php echo $vwPackingdetail_grid->RowIndex ?>_PCS" value="<?php echo HtmlEncode($vwPackingdetail->PCS->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($vwPackingdetail->PackingType->Visible) { // PackingType ?>
		<td data-name="PackingType"<?php echo $vwPackingdetail->PackingType->cellAttributes() ?>>
<?php if ($vwPackingdetail->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $vwPackingdetail_grid->RowCnt ?>_vwPackingdetail_PackingType" class="form-group vwPackingdetail_PackingType">
<input type="text" data-table="vwPackingdetail" data-field="x_PackingType" name="x<?php echo $vwPackingdetail_grid->RowIndex ?>_PackingType" id="x<?php echo $vwPackingdetail_grid->RowIndex ?>_PackingType" size="30" maxlength="55" placeholder="<?php echo HtmlEncode($vwPackingdetail->PackingType->getPlaceHolder()) ?>" value="<?php echo $vwPackingdetail->PackingType->EditValue ?>"<?php echo $vwPackingdetail->PackingType->editAttributes() ?>>
</span>
<input type="hidden" data-table="vwPackingdetail" data-field="x_PackingType" name="o<?php echo $vwPackingdetail_grid->RowIndex ?>_PackingType" id="o<?php echo $vwPackingdetail_grid->RowIndex ?>_PackingType" value="<?php echo HtmlEncode($vwPackingdetail->PackingType->OldValue) ?>">
<?php } ?>
<?php if ($vwPackingdetail->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $vwPackingdetail_grid->RowCnt ?>_vwPackingdetail_PackingType" class="form-group vwPackingdetail_PackingType">
<input type="text" data-table="vwPackingdetail" data-field="x_PackingType" name="x<?php echo $vwPackingdetail_grid->RowIndex ?>_PackingType" id="x<?php echo $vwPackingdetail_grid->RowIndex ?>_PackingType" size="30" maxlength="55" placeholder="<?php echo HtmlEncode($vwPackingdetail->PackingType->getPlaceHolder()) ?>" value="<?php echo $vwPackingdetail->PackingType->EditValue ?>"<?php echo $vwPackingdetail->PackingType->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($vwPackingdetail->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $vwPackingdetail_grid->RowCnt ?>_vwPackingdetail_PackingType" class="vwPackingdetail_PackingType">
<span<?php echo $vwPackingdetail->PackingType->viewAttributes() ?>>
<?php echo $vwPackingdetail->PackingType->getViewValue() ?></span>
</span>
<?php if (!$vwPackingdetail->isConfirm()) { ?>
<input type="hidden" data-table="vwPackingdetail" data-field="x_PackingType" name="x<?php echo $vwPackingdetail_grid->RowIndex ?>_PackingType" id="x<?php echo $vwPackingdetail_grid->RowIndex ?>_PackingType" value="<?php echo HtmlEncode($vwPackingdetail->PackingType->FormValue) ?>">
<input type="hidden" data-table="vwPackingdetail" data-field="x_PackingType" name="o<?php echo $vwPackingdetail_grid->RowIndex ?>_PackingType" id="o<?php echo $vwPackingdetail_grid->RowIndex ?>_PackingType" value="<?php echo HtmlEncode($vwPackingdetail->PackingType->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="vwPackingdetail" data-field="x_PackingType" name="fvwPackingdetailgrid$x<?php echo $vwPackingdetail_grid->RowIndex ?>_PackingType" id="fvwPackingdetailgrid$x<?php echo $vwPackingdetail_grid->RowIndex ?>_PackingType" value="<?php echo HtmlEncode($vwPackingdetail->PackingType->FormValue) ?>">
<input type="hidden" data-table="vwPackingdetail" data-field="x_PackingType" name="fvwPackingdetailgrid$o<?php echo $vwPackingdetail_grid->RowIndex ?>_PackingType" id="fvwPackingdetailgrid$o<?php echo $vwPackingdetail_grid->RowIndex ?>_PackingType" value="<?php echo HtmlEncode($vwPackingdetail->PackingType->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($vwPackingdetail->Length->Visible) { // Length ?>
		<td data-name="Length"<?php echo $vwPackingdetail->Length->cellAttributes() ?>>
<?php if ($vwPackingdetail->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $vwPackingdetail_grid->RowCnt ?>_vwPackingdetail_Length" class="form-group vwPackingdetail_Length">
<input type="text" data-table="vwPackingdetail" data-field="x_Length" name="x<?php echo $vwPackingdetail_grid->RowIndex ?>_Length" id="x<?php echo $vwPackingdetail_grid->RowIndex ?>_Length" size="30" placeholder="<?php echo HtmlEncode($vwPackingdetail->Length->getPlaceHolder()) ?>" value="<?php echo $vwPackingdetail->Length->EditValue ?>"<?php echo $vwPackingdetail->Length->editAttributes() ?>>
</span>
<input type="hidden" data-table="vwPackingdetail" data-field="x_Length" name="o<?php echo $vwPackingdetail_grid->RowIndex ?>_Length" id="o<?php echo $vwPackingdetail_grid->RowIndex ?>_Length" value="<?php echo HtmlEncode($vwPackingdetail->Length->OldValue) ?>">
<?php } ?>
<?php if ($vwPackingdetail->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $vwPackingdetail_grid->RowCnt ?>_vwPackingdetail_Length" class="form-group vwPackingdetail_Length">
<input type="text" data-table="vwPackingdetail" data-field="x_Length" name="x<?php echo $vwPackingdetail_grid->RowIndex ?>_Length" id="x<?php echo $vwPackingdetail_grid->RowIndex ?>_Length" size="30" placeholder="<?php echo HtmlEncode($vwPackingdetail->Length->getPlaceHolder()) ?>" value="<?php echo $vwPackingdetail->Length->EditValue ?>"<?php echo $vwPackingdetail->Length->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($vwPackingdetail->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $vwPackingdetail_grid->RowCnt ?>_vwPackingdetail_Length" class="vwPackingdetail_Length">
<span<?php echo $vwPackingdetail->Length->viewAttributes() ?>>
<?php echo $vwPackingdetail->Length->getViewValue() ?></span>
</span>
<?php if (!$vwPackingdetail->isConfirm()) { ?>
<input type="hidden" data-table="vwPackingdetail" data-field="x_Length" name="x<?php echo $vwPackingdetail_grid->RowIndex ?>_Length" id="x<?php echo $vwPackingdetail_grid->RowIndex ?>_Length" value="<?php echo HtmlEncode($vwPackingdetail->Length->FormValue) ?>">
<input type="hidden" data-table="vwPackingdetail" data-field="x_Length" name="o<?php echo $vwPackingdetail_grid->RowIndex ?>_Length" id="o<?php echo $vwPackingdetail_grid->RowIndex ?>_Length" value="<?php echo HtmlEncode($vwPackingdetail->Length->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="vwPackingdetail" data-field="x_Length" name="fvwPackingdetailgrid$x<?php echo $vwPackingdetail_grid->RowIndex ?>_Length" id="fvwPackingdetailgrid$x<?php echo $vwPackingdetail_grid->RowIndex ?>_Length" value="<?php echo HtmlEncode($vwPackingdetail->Length->FormValue) ?>">
<input type="hidden" data-table="vwPackingdetail" data-field="x_Length" name="fvwPackingdetailgrid$o<?php echo $vwPackingdetail_grid->RowIndex ?>_Length" id="fvwPackingdetailgrid$o<?php echo $vwPackingdetail_grid->RowIndex ?>_Length" value="<?php echo HtmlEncode($vwPackingdetail->Length->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($vwPackingdetail->Width->Visible) { // Width ?>
		<td data-name="Width"<?php echo $vwPackingdetail->Width->cellAttributes() ?>>
<?php if ($vwPackingdetail->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $vwPackingdetail_grid->RowCnt ?>_vwPackingdetail_Width" class="form-group vwPackingdetail_Width">
<input type="text" data-table="vwPackingdetail" data-field="x_Width" name="x<?php echo $vwPackingdetail_grid->RowIndex ?>_Width" id="x<?php echo $vwPackingdetail_grid->RowIndex ?>_Width" size="30" placeholder="<?php echo HtmlEncode($vwPackingdetail->Width->getPlaceHolder()) ?>" value="<?php echo $vwPackingdetail->Width->EditValue ?>"<?php echo $vwPackingdetail->Width->editAttributes() ?>>
</span>
<input type="hidden" data-table="vwPackingdetail" data-field="x_Width" name="o<?php echo $vwPackingdetail_grid->RowIndex ?>_Width" id="o<?php echo $vwPackingdetail_grid->RowIndex ?>_Width" value="<?php echo HtmlEncode($vwPackingdetail->Width->OldValue) ?>">
<?php } ?>
<?php if ($vwPackingdetail->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $vwPackingdetail_grid->RowCnt ?>_vwPackingdetail_Width" class="form-group vwPackingdetail_Width">
<input type="text" data-table="vwPackingdetail" data-field="x_Width" name="x<?php echo $vwPackingdetail_grid->RowIndex ?>_Width" id="x<?php echo $vwPackingdetail_grid->RowIndex ?>_Width" size="30" placeholder="<?php echo HtmlEncode($vwPackingdetail->Width->getPlaceHolder()) ?>" value="<?php echo $vwPackingdetail->Width->EditValue ?>"<?php echo $vwPackingdetail->Width->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($vwPackingdetail->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $vwPackingdetail_grid->RowCnt ?>_vwPackingdetail_Width" class="vwPackingdetail_Width">
<span<?php echo $vwPackingdetail->Width->viewAttributes() ?>>
<?php echo $vwPackingdetail->Width->getViewValue() ?></span>
</span>
<?php if (!$vwPackingdetail->isConfirm()) { ?>
<input type="hidden" data-table="vwPackingdetail" data-field="x_Width" name="x<?php echo $vwPackingdetail_grid->RowIndex ?>_Width" id="x<?php echo $vwPackingdetail_grid->RowIndex ?>_Width" value="<?php echo HtmlEncode($vwPackingdetail->Width->FormValue) ?>">
<input type="hidden" data-table="vwPackingdetail" data-field="x_Width" name="o<?php echo $vwPackingdetail_grid->RowIndex ?>_Width" id="o<?php echo $vwPackingdetail_grid->RowIndex ?>_Width" value="<?php echo HtmlEncode($vwPackingdetail->Width->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="vwPackingdetail" data-field="x_Width" name="fvwPackingdetailgrid$x<?php echo $vwPackingdetail_grid->RowIndex ?>_Width" id="fvwPackingdetailgrid$x<?php echo $vwPackingdetail_grid->RowIndex ?>_Width" value="<?php echo HtmlEncode($vwPackingdetail->Width->FormValue) ?>">
<input type="hidden" data-table="vwPackingdetail" data-field="x_Width" name="fvwPackingdetailgrid$o<?php echo $vwPackingdetail_grid->RowIndex ?>_Width" id="fvwPackingdetailgrid$o<?php echo $vwPackingdetail_grid->RowIndex ?>_Width" value="<?php echo HtmlEncode($vwPackingdetail->Width->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($vwPackingdetail->Heigth->Visible) { // Heigth ?>
		<td data-name="Heigth"<?php echo $vwPackingdetail->Heigth->cellAttributes() ?>>
<?php if ($vwPackingdetail->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $vwPackingdetail_grid->RowCnt ?>_vwPackingdetail_Heigth" class="form-group vwPackingdetail_Heigth">
<input type="text" data-table="vwPackingdetail" data-field="x_Heigth" name="x<?php echo $vwPackingdetail_grid->RowIndex ?>_Heigth" id="x<?php echo $vwPackingdetail_grid->RowIndex ?>_Heigth" size="30" placeholder="<?php echo HtmlEncode($vwPackingdetail->Heigth->getPlaceHolder()) ?>" value="<?php echo $vwPackingdetail->Heigth->EditValue ?>"<?php echo $vwPackingdetail->Heigth->editAttributes() ?>>
</span>
<input type="hidden" data-table="vwPackingdetail" data-field="x_Heigth" name="o<?php echo $vwPackingdetail_grid->RowIndex ?>_Heigth" id="o<?php echo $vwPackingdetail_grid->RowIndex ?>_Heigth" value="<?php echo HtmlEncode($vwPackingdetail->Heigth->OldValue) ?>">
<?php } ?>
<?php if ($vwPackingdetail->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $vwPackingdetail_grid->RowCnt ?>_vwPackingdetail_Heigth" class="form-group vwPackingdetail_Heigth">
<input type="text" data-table="vwPackingdetail" data-field="x_Heigth" name="x<?php echo $vwPackingdetail_grid->RowIndex ?>_Heigth" id="x<?php echo $vwPackingdetail_grid->RowIndex ?>_Heigth" size="30" placeholder="<?php echo HtmlEncode($vwPackingdetail->Heigth->getPlaceHolder()) ?>" value="<?php echo $vwPackingdetail->Heigth->EditValue ?>"<?php echo $vwPackingdetail->Heigth->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($vwPackingdetail->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $vwPackingdetail_grid->RowCnt ?>_vwPackingdetail_Heigth" class="vwPackingdetail_Heigth">
<span<?php echo $vwPackingdetail->Heigth->viewAttributes() ?>>
<?php echo $vwPackingdetail->Heigth->getViewValue() ?></span>
</span>
<?php if (!$vwPackingdetail->isConfirm()) { ?>
<input type="hidden" data-table="vwPackingdetail" data-field="x_Heigth" name="x<?php echo $vwPackingdetail_grid->RowIndex ?>_Heigth" id="x<?php echo $vwPackingdetail_grid->RowIndex ?>_Heigth" value="<?php echo HtmlEncode($vwPackingdetail->Heigth->FormValue) ?>">
<input type="hidden" data-table="vwPackingdetail" data-field="x_Heigth" name="o<?php echo $vwPackingdetail_grid->RowIndex ?>_Heigth" id="o<?php echo $vwPackingdetail_grid->RowIndex ?>_Heigth" value="<?php echo HtmlEncode($vwPackingdetail->Heigth->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="vwPackingdetail" data-field="x_Heigth" name="fvwPackingdetailgrid$x<?php echo $vwPackingdetail_grid->RowIndex ?>_Heigth" id="fvwPackingdetailgrid$x<?php echo $vwPackingdetail_grid->RowIndex ?>_Heigth" value="<?php echo HtmlEncode($vwPackingdetail->Heigth->FormValue) ?>">
<input type="hidden" data-table="vwPackingdetail" data-field="x_Heigth" name="fvwPackingdetailgrid$o<?php echo $vwPackingdetail_grid->RowIndex ?>_Heigth" id="fvwPackingdetailgrid$o<?php echo $vwPackingdetail_grid->RowIndex ?>_Heigth" value="<?php echo HtmlEncode($vwPackingdetail->Heigth->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($vwPackingdetail->finishpacking->Visible) { // finishpacking ?>
		<td data-name="finishpacking"<?php echo $vwPackingdetail->finishpacking->cellAttributes() ?>>
<?php if ($vwPackingdetail->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $vwPackingdetail_grid->RowCnt ?>_vwPackingdetail_finishpacking" class="form-group vwPackingdetail_finishpacking">
<input type="text" data-table="vwPackingdetail" data-field="x_finishpacking" name="x<?php echo $vwPackingdetail_grid->RowIndex ?>_finishpacking" id="x<?php echo $vwPackingdetail_grid->RowIndex ?>_finishpacking" size="30" placeholder="<?php echo HtmlEncode($vwPackingdetail->finishpacking->getPlaceHolder()) ?>" value="<?php echo $vwPackingdetail->finishpacking->EditValue ?>"<?php echo $vwPackingdetail->finishpacking->editAttributes() ?>>
</span>
<input type="hidden" data-table="vwPackingdetail" data-field="x_finishpacking" name="o<?php echo $vwPackingdetail_grid->RowIndex ?>_finishpacking" id="o<?php echo $vwPackingdetail_grid->RowIndex ?>_finishpacking" value="<?php echo HtmlEncode($vwPackingdetail->finishpacking->OldValue) ?>">
<?php } ?>
<?php if ($vwPackingdetail->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $vwPackingdetail_grid->RowCnt ?>_vwPackingdetail_finishpacking" class="form-group vwPackingdetail_finishpacking">
<input type="text" data-table="vwPackingdetail" data-field="x_finishpacking" name="x<?php echo $vwPackingdetail_grid->RowIndex ?>_finishpacking" id="x<?php echo $vwPackingdetail_grid->RowIndex ?>_finishpacking" size="30" placeholder="<?php echo HtmlEncode($vwPackingdetail->finishpacking->getPlaceHolder()) ?>" value="<?php echo $vwPackingdetail->finishpacking->EditValue ?>"<?php echo $vwPackingdetail->finishpacking->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($vwPackingdetail->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $vwPackingdetail_grid->RowCnt ?>_vwPackingdetail_finishpacking" class="vwPackingdetail_finishpacking">
<span<?php echo $vwPackingdetail->finishpacking->viewAttributes() ?>>
<?php echo $vwPackingdetail->finishpacking->getViewValue() ?></span>
</span>
<?php if (!$vwPackingdetail->isConfirm()) { ?>
<input type="hidden" data-table="vwPackingdetail" data-field="x_finishpacking" name="x<?php echo $vwPackingdetail_grid->RowIndex ?>_finishpacking" id="x<?php echo $vwPackingdetail_grid->RowIndex ?>_finishpacking" value="<?php echo HtmlEncode($vwPackingdetail->finishpacking->FormValue) ?>">
<input type="hidden" data-table="vwPackingdetail" data-field="x_finishpacking" name="o<?php echo $vwPackingdetail_grid->RowIndex ?>_finishpacking" id="o<?php echo $vwPackingdetail_grid->RowIndex ?>_finishpacking" value="<?php echo HtmlEncode($vwPackingdetail->finishpacking->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="vwPackingdetail" data-field="x_finishpacking" name="fvwPackingdetailgrid$x<?php echo $vwPackingdetail_grid->RowIndex ?>_finishpacking" id="fvwPackingdetailgrid$x<?php echo $vwPackingdetail_grid->RowIndex ?>_finishpacking" value="<?php echo HtmlEncode($vwPackingdetail->finishpacking->FormValue) ?>">
<input type="hidden" data-table="vwPackingdetail" data-field="x_finishpacking" name="fvwPackingdetailgrid$o<?php echo $vwPackingdetail_grid->RowIndex ?>_finishpacking" id="fvwPackingdetailgrid$o<?php echo $vwPackingdetail_grid->RowIndex ?>_finishpacking" value="<?php echo HtmlEncode($vwPackingdetail->finishpacking->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($vwPackingdetail->PE_film_Cover->Visible) { // PE_film_Cover ?>
		<td data-name="PE_film_Cover"<?php echo $vwPackingdetail->PE_film_Cover->cellAttributes() ?>>
<?php if ($vwPackingdetail->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $vwPackingdetail_grid->RowCnt ?>_vwPackingdetail_PE_film_Cover" class="form-group vwPackingdetail_PE_film_Cover">
<input type="text" data-table="vwPackingdetail" data-field="x_PE_film_Cover" name="x<?php echo $vwPackingdetail_grid->RowIndex ?>_PE_film_Cover" id="x<?php echo $vwPackingdetail_grid->RowIndex ?>_PE_film_Cover" size="30" placeholder="<?php echo HtmlEncode($vwPackingdetail->PE_film_Cover->getPlaceHolder()) ?>" value="<?php echo $vwPackingdetail->PE_film_Cover->EditValue ?>"<?php echo $vwPackingdetail->PE_film_Cover->editAttributes() ?>>
</span>
<input type="hidden" data-table="vwPackingdetail" data-field="x_PE_film_Cover" name="o<?php echo $vwPackingdetail_grid->RowIndex ?>_PE_film_Cover" id="o<?php echo $vwPackingdetail_grid->RowIndex ?>_PE_film_Cover" value="<?php echo HtmlEncode($vwPackingdetail->PE_film_Cover->OldValue) ?>">
<?php } ?>
<?php if ($vwPackingdetail->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $vwPackingdetail_grid->RowCnt ?>_vwPackingdetail_PE_film_Cover" class="form-group vwPackingdetail_PE_film_Cover">
<input type="text" data-table="vwPackingdetail" data-field="x_PE_film_Cover" name="x<?php echo $vwPackingdetail_grid->RowIndex ?>_PE_film_Cover" id="x<?php echo $vwPackingdetail_grid->RowIndex ?>_PE_film_Cover" size="30" placeholder="<?php echo HtmlEncode($vwPackingdetail->PE_film_Cover->getPlaceHolder()) ?>" value="<?php echo $vwPackingdetail->PE_film_Cover->EditValue ?>"<?php echo $vwPackingdetail->PE_film_Cover->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($vwPackingdetail->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $vwPackingdetail_grid->RowCnt ?>_vwPackingdetail_PE_film_Cover" class="vwPackingdetail_PE_film_Cover">
<span<?php echo $vwPackingdetail->PE_film_Cover->viewAttributes() ?>>
<?php echo $vwPackingdetail->PE_film_Cover->getViewValue() ?></span>
</span>
<?php if (!$vwPackingdetail->isConfirm()) { ?>
<input type="hidden" data-table="vwPackingdetail" data-field="x_PE_film_Cover" name="x<?php echo $vwPackingdetail_grid->RowIndex ?>_PE_film_Cover" id="x<?php echo $vwPackingdetail_grid->RowIndex ?>_PE_film_Cover" value="<?php echo HtmlEncode($vwPackingdetail->PE_film_Cover->FormValue) ?>">
<input type="hidden" data-table="vwPackingdetail" data-field="x_PE_film_Cover" name="o<?php echo $vwPackingdetail_grid->RowIndex ?>_PE_film_Cover" id="o<?php echo $vwPackingdetail_grid->RowIndex ?>_PE_film_Cover" value="<?php echo HtmlEncode($vwPackingdetail->PE_film_Cover->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="vwPackingdetail" data-field="x_PE_film_Cover" name="fvwPackingdetailgrid$x<?php echo $vwPackingdetail_grid->RowIndex ?>_PE_film_Cover" id="fvwPackingdetailgrid$x<?php echo $vwPackingdetail_grid->RowIndex ?>_PE_film_Cover" value="<?php echo HtmlEncode($vwPackingdetail->PE_film_Cover->FormValue) ?>">
<input type="hidden" data-table="vwPackingdetail" data-field="x_PE_film_Cover" name="fvwPackingdetailgrid$o<?php echo $vwPackingdetail_grid->RowIndex ?>_PE_film_Cover" id="fvwPackingdetailgrid$o<?php echo $vwPackingdetail_grid->RowIndex ?>_PE_film_Cover" value="<?php echo HtmlEncode($vwPackingdetail->PE_film_Cover->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($vwPackingdetail->CreateUser->Visible) { // CreateUser ?>
		<td data-name="CreateUser"<?php echo $vwPackingdetail->CreateUser->cellAttributes() ?>>
<?php if ($vwPackingdetail->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $vwPackingdetail_grid->RowCnt ?>_vwPackingdetail_CreateUser" class="form-group vwPackingdetail_CreateUser">
<input type="text" data-table="vwPackingdetail" data-field="x_CreateUser" name="x<?php echo $vwPackingdetail_grid->RowIndex ?>_CreateUser" id="x<?php echo $vwPackingdetail_grid->RowIndex ?>_CreateUser" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($vwPackingdetail->CreateUser->getPlaceHolder()) ?>" value="<?php echo $vwPackingdetail->CreateUser->EditValue ?>"<?php echo $vwPackingdetail->CreateUser->editAttributes() ?>>
</span>
<input type="hidden" data-table="vwPackingdetail" data-field="x_CreateUser" name="o<?php echo $vwPackingdetail_grid->RowIndex ?>_CreateUser" id="o<?php echo $vwPackingdetail_grid->RowIndex ?>_CreateUser" value="<?php echo HtmlEncode($vwPackingdetail->CreateUser->OldValue) ?>">
<?php } ?>
<?php if ($vwPackingdetail->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $vwPackingdetail_grid->RowCnt ?>_vwPackingdetail_CreateUser" class="form-group vwPackingdetail_CreateUser">
<input type="text" data-table="vwPackingdetail" data-field="x_CreateUser" name="x<?php echo $vwPackingdetail_grid->RowIndex ?>_CreateUser" id="x<?php echo $vwPackingdetail_grid->RowIndex ?>_CreateUser" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($vwPackingdetail->CreateUser->getPlaceHolder()) ?>" value="<?php echo $vwPackingdetail->CreateUser->EditValue ?>"<?php echo $vwPackingdetail->CreateUser->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($vwPackingdetail->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $vwPackingdetail_grid->RowCnt ?>_vwPackingdetail_CreateUser" class="vwPackingdetail_CreateUser">
<span<?php echo $vwPackingdetail->CreateUser->viewAttributes() ?>>
<?php echo $vwPackingdetail->CreateUser->getViewValue() ?></span>
</span>
<?php if (!$vwPackingdetail->isConfirm()) { ?>
<input type="hidden" data-table="vwPackingdetail" data-field="x_CreateUser" name="x<?php echo $vwPackingdetail_grid->RowIndex ?>_CreateUser" id="x<?php echo $vwPackingdetail_grid->RowIndex ?>_CreateUser" value="<?php echo HtmlEncode($vwPackingdetail->CreateUser->FormValue) ?>">
<input type="hidden" data-table="vwPackingdetail" data-field="x_CreateUser" name="o<?php echo $vwPackingdetail_grid->RowIndex ?>_CreateUser" id="o<?php echo $vwPackingdetail_grid->RowIndex ?>_CreateUser" value="<?php echo HtmlEncode($vwPackingdetail->CreateUser->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="vwPackingdetail" data-field="x_CreateUser" name="fvwPackingdetailgrid$x<?php echo $vwPackingdetail_grid->RowIndex ?>_CreateUser" id="fvwPackingdetailgrid$x<?php echo $vwPackingdetail_grid->RowIndex ?>_CreateUser" value="<?php echo HtmlEncode($vwPackingdetail->CreateUser->FormValue) ?>">
<input type="hidden" data-table="vwPackingdetail" data-field="x_CreateUser" name="fvwPackingdetailgrid$o<?php echo $vwPackingdetail_grid->RowIndex ?>_CreateUser" id="fvwPackingdetailgrid$o<?php echo $vwPackingdetail_grid->RowIndex ?>_CreateUser" value="<?php echo HtmlEncode($vwPackingdetail->CreateUser->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($vwPackingdetail->CreateDate->Visible) { // CreateDate ?>
		<td data-name="CreateDate"<?php echo $vwPackingdetail->CreateDate->cellAttributes() ?>>
<?php if ($vwPackingdetail->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $vwPackingdetail_grid->RowCnt ?>_vwPackingdetail_CreateDate" class="form-group vwPackingdetail_CreateDate">
<input type="text" data-table="vwPackingdetail" data-field="x_CreateDate" name="x<?php echo $vwPackingdetail_grid->RowIndex ?>_CreateDate" id="x<?php echo $vwPackingdetail_grid->RowIndex ?>_CreateDate" placeholder="<?php echo HtmlEncode($vwPackingdetail->CreateDate->getPlaceHolder()) ?>" value="<?php echo $vwPackingdetail->CreateDate->EditValue ?>"<?php echo $vwPackingdetail->CreateDate->editAttributes() ?>>
<?php if (!$vwPackingdetail->CreateDate->ReadOnly && !$vwPackingdetail->CreateDate->Disabled && !isset($vwPackingdetail->CreateDate->EditAttrs["readonly"]) && !isset($vwPackingdetail->CreateDate->EditAttrs["disabled"])) { ?>
<script>
ew.createDateTimePicker("fvwPackingdetailgrid", "x<?php echo $vwPackingdetail_grid->RowIndex ?>_CreateDate", {"ignoreReadonly":true,"useCurrent":false,"format":0});
</script>
<?php } ?>
</span>
<input type="hidden" data-table="vwPackingdetail" data-field="x_CreateDate" name="o<?php echo $vwPackingdetail_grid->RowIndex ?>_CreateDate" id="o<?php echo $vwPackingdetail_grid->RowIndex ?>_CreateDate" value="<?php echo HtmlEncode($vwPackingdetail->CreateDate->OldValue) ?>">
<?php } ?>
<?php if ($vwPackingdetail->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $vwPackingdetail_grid->RowCnt ?>_vwPackingdetail_CreateDate" class="form-group vwPackingdetail_CreateDate">
<input type="text" data-table="vwPackingdetail" data-field="x_CreateDate" name="x<?php echo $vwPackingdetail_grid->RowIndex ?>_CreateDate" id="x<?php echo $vwPackingdetail_grid->RowIndex ?>_CreateDate" placeholder="<?php echo HtmlEncode($vwPackingdetail->CreateDate->getPlaceHolder()) ?>" value="<?php echo $vwPackingdetail->CreateDate->EditValue ?>"<?php echo $vwPackingdetail->CreateDate->editAttributes() ?>>
<?php if (!$vwPackingdetail->CreateDate->ReadOnly && !$vwPackingdetail->CreateDate->Disabled && !isset($vwPackingdetail->CreateDate->EditAttrs["readonly"]) && !isset($vwPackingdetail->CreateDate->EditAttrs["disabled"])) { ?>
<script>
ew.createDateTimePicker("fvwPackingdetailgrid", "x<?php echo $vwPackingdetail_grid->RowIndex ?>_CreateDate", {"ignoreReadonly":true,"useCurrent":false,"format":0});
</script>
<?php } ?>
</span>
<?php } ?>
<?php if ($vwPackingdetail->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $vwPackingdetail_grid->RowCnt ?>_vwPackingdetail_CreateDate" class="vwPackingdetail_CreateDate">
<span<?php echo $vwPackingdetail->CreateDate->viewAttributes() ?>>
<?php echo $vwPackingdetail->CreateDate->getViewValue() ?></span>
</span>
<?php if (!$vwPackingdetail->isConfirm()) { ?>
<input type="hidden" data-table="vwPackingdetail" data-field="x_CreateDate" name="x<?php echo $vwPackingdetail_grid->RowIndex ?>_CreateDate" id="x<?php echo $vwPackingdetail_grid->RowIndex ?>_CreateDate" value="<?php echo HtmlEncode($vwPackingdetail->CreateDate->FormValue) ?>">
<input type="hidden" data-table="vwPackingdetail" data-field="x_CreateDate" name="o<?php echo $vwPackingdetail_grid->RowIndex ?>_CreateDate" id="o<?php echo $vwPackingdetail_grid->RowIndex ?>_CreateDate" value="<?php echo HtmlEncode($vwPackingdetail->CreateDate->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="vwPackingdetail" data-field="x_CreateDate" name="fvwPackingdetailgrid$x<?php echo $vwPackingdetail_grid->RowIndex ?>_CreateDate" id="fvwPackingdetailgrid$x<?php echo $vwPackingdetail_grid->RowIndex ?>_CreateDate" value="<?php echo HtmlEncode($vwPackingdetail->CreateDate->FormValue) ?>">
<input type="hidden" data-table="vwPackingdetail" data-field="x_CreateDate" name="fvwPackingdetailgrid$o<?php echo $vwPackingdetail_grid->RowIndex ?>_CreateDate" id="fvwPackingdetailgrid$o<?php echo $vwPackingdetail_grid->RowIndex ?>_CreateDate" value="<?php echo HtmlEncode($vwPackingdetail->CreateDate->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($vwPackingdetail->Box->Visible) { // Box ?>
		<td data-name="Box"<?php echo $vwPackingdetail->Box->cellAttributes() ?>>
<?php if ($vwPackingdetail->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $vwPackingdetail_grid->RowCnt ?>_vwPackingdetail_Box" class="form-group vwPackingdetail_Box">
<input type="text" data-table="vwPackingdetail" data-field="x_Box" name="x<?php echo $vwPackingdetail_grid->RowIndex ?>_Box" id="x<?php echo $vwPackingdetail_grid->RowIndex ?>_Box" size="30" placeholder="<?php echo HtmlEncode($vwPackingdetail->Box->getPlaceHolder()) ?>" value="<?php echo $vwPackingdetail->Box->EditValue ?>"<?php echo $vwPackingdetail->Box->editAttributes() ?>>
</span>
<input type="hidden" data-table="vwPackingdetail" data-field="x_Box" name="o<?php echo $vwPackingdetail_grid->RowIndex ?>_Box" id="o<?php echo $vwPackingdetail_grid->RowIndex ?>_Box" value="<?php echo HtmlEncode($vwPackingdetail->Box->OldValue) ?>">
<?php } ?>
<?php if ($vwPackingdetail->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $vwPackingdetail_grid->RowCnt ?>_vwPackingdetail_Box" class="form-group vwPackingdetail_Box">
<input type="text" data-table="vwPackingdetail" data-field="x_Box" name="x<?php echo $vwPackingdetail_grid->RowIndex ?>_Box" id="x<?php echo $vwPackingdetail_grid->RowIndex ?>_Box" size="30" placeholder="<?php echo HtmlEncode($vwPackingdetail->Box->getPlaceHolder()) ?>" value="<?php echo $vwPackingdetail->Box->EditValue ?>"<?php echo $vwPackingdetail->Box->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($vwPackingdetail->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $vwPackingdetail_grid->RowCnt ?>_vwPackingdetail_Box" class="vwPackingdetail_Box">
<span<?php echo $vwPackingdetail->Box->viewAttributes() ?>>
<?php echo $vwPackingdetail->Box->getViewValue() ?></span>
</span>
<?php if (!$vwPackingdetail->isConfirm()) { ?>
<input type="hidden" data-table="vwPackingdetail" data-field="x_Box" name="x<?php echo $vwPackingdetail_grid->RowIndex ?>_Box" id="x<?php echo $vwPackingdetail_grid->RowIndex ?>_Box" value="<?php echo HtmlEncode($vwPackingdetail->Box->FormValue) ?>">
<input type="hidden" data-table="vwPackingdetail" data-field="x_Box" name="o<?php echo $vwPackingdetail_grid->RowIndex ?>_Box" id="o<?php echo $vwPackingdetail_grid->RowIndex ?>_Box" value="<?php echo HtmlEncode($vwPackingdetail->Box->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="vwPackingdetail" data-field="x_Box" name="fvwPackingdetailgrid$x<?php echo $vwPackingdetail_grid->RowIndex ?>_Box" id="fvwPackingdetailgrid$x<?php echo $vwPackingdetail_grid->RowIndex ?>_Box" value="<?php echo HtmlEncode($vwPackingdetail->Box->FormValue) ?>">
<input type="hidden" data-table="vwPackingdetail" data-field="x_Box" name="fvwPackingdetailgrid$o<?php echo $vwPackingdetail_grid->RowIndex ?>_Box" id="fvwPackingdetailgrid$o<?php echo $vwPackingdetail_grid->RowIndex ?>_Box" value="<?php echo HtmlEncode($vwPackingdetail->Box->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$vwPackingdetail_grid->ListOptions->render("body", "right", $vwPackingdetail_grid->RowCnt);
?>
	</tr>
<?php if ($vwPackingdetail->RowType == ROWTYPE_ADD || $vwPackingdetail->RowType == ROWTYPE_EDIT) { ?>
<script>
fvwPackingdetailgrid.updateLists(<?php echo $vwPackingdetail_grid->RowIndex ?>);
</script>
<?php } ?>
<?php
	}
	} // End delete row checking
	if (!$vwPackingdetail->isGridAdd() || $vwPackingdetail->CurrentMode == "copy")
		if (!$vwPackingdetail_grid->Recordset->EOF)
			$vwPackingdetail_grid->Recordset->moveNext();
}
?>
<?php
	if ($vwPackingdetail->CurrentMode == "add" || $vwPackingdetail->CurrentMode == "copy" || $vwPackingdetail->CurrentMode == "edit") {
		$vwPackingdetail_grid->RowIndex = '$rowindex$';
		$vwPackingdetail_grid->loadRowValues();

		// Set row properties
		$vwPackingdetail->resetAttributes();
		$vwPackingdetail->RowAttrs = array_merge($vwPackingdetail->RowAttrs, array('data-rowindex'=>$vwPackingdetail_grid->RowIndex, 'id'=>'r0_vwPackingdetail', 'data-rowtype'=>ROWTYPE_ADD));
		AppendClass($vwPackingdetail->RowAttrs["class"], "ew-template");
		$vwPackingdetail->RowType = ROWTYPE_ADD;

		// Render row
		$vwPackingdetail_grid->renderRow();

		// Render list options
		$vwPackingdetail_grid->renderListOptions();
		$vwPackingdetail_grid->StartRowCnt = 0;
?>
	<tr<?php echo $vwPackingdetail->rowAttributes() ?>>
<?php

// Render list options (body, left)
$vwPackingdetail_grid->ListOptions->render("body", "left", $vwPackingdetail_grid->RowIndex);
?>
	<?php if ($vwPackingdetail->Id_packing->Visible) { // Id_packing ?>
		<td data-name="Id_packing">
<?php if (!$vwPackingdetail->isConfirm()) { ?>
<?php } else { ?>
<span id="el$rowindex$_vwPackingdetail_Id_packing" class="form-group vwPackingdetail_Id_packing">
<span<?php echo $vwPackingdetail->Id_packing->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?php echo RemoveHtml($vwPackingdetail->Id_packing->ViewValue) ?>"></span>
</span>
<input type="hidden" data-table="vwPackingdetail" data-field="x_Id_packing" name="x<?php echo $vwPackingdetail_grid->RowIndex ?>_Id_packing" id="x<?php echo $vwPackingdetail_grid->RowIndex ?>_Id_packing" value="<?php echo HtmlEncode($vwPackingdetail->Id_packing->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="vwPackingdetail" data-field="x_Id_packing" name="o<?php echo $vwPackingdetail_grid->RowIndex ?>_Id_packing" id="o<?php echo $vwPackingdetail_grid->RowIndex ?>_Id_packing" value="<?php echo HtmlEncode($vwPackingdetail->Id_packing->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($vwPackingdetail->Code->Visible) { // Code ?>
		<td data-name="Code">
<?php if (!$vwPackingdetail->isConfirm()) { ?>
<span id="el$rowindex$_vwPackingdetail_Code" class="form-group vwPackingdetail_Code">
<input type="text" data-table="vwPackingdetail" data-field="x_Code" name="x<?php echo $vwPackingdetail_grid->RowIndex ?>_Code" id="x<?php echo $vwPackingdetail_grid->RowIndex ?>_Code" size="30" maxlength="55" placeholder="<?php echo HtmlEncode($vwPackingdetail->Code->getPlaceHolder()) ?>" value="<?php echo $vwPackingdetail->Code->EditValue ?>"<?php echo $vwPackingdetail->Code->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_vwPackingdetail_Code" class="form-group vwPackingdetail_Code">
<span<?php echo $vwPackingdetail->Code->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?php echo RemoveHtml($vwPackingdetail->Code->ViewValue) ?>"></span>
</span>
<input type="hidden" data-table="vwPackingdetail" data-field="x_Code" name="x<?php echo $vwPackingdetail_grid->RowIndex ?>_Code" id="x<?php echo $vwPackingdetail_grid->RowIndex ?>_Code" value="<?php echo HtmlEncode($vwPackingdetail->Code->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="vwPackingdetail" data-field="x_Code" name="o<?php echo $vwPackingdetail_grid->RowIndex ?>_Code" id="o<?php echo $vwPackingdetail_grid->RowIndex ?>_Code" value="<?php echo HtmlEncode($vwPackingdetail->Code->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($vwPackingdetail->PCS->Visible) { // PCS ?>
		<td data-name="PCS">
<?php if (!$vwPackingdetail->isConfirm()) { ?>
<span id="el$rowindex$_vwPackingdetail_PCS" class="form-group vwPackingdetail_PCS">
<input type="text" data-table="vwPackingdetail" data-field="x_PCS" name="x<?php echo $vwPackingdetail_grid->RowIndex ?>_PCS" id="x<?php echo $vwPackingdetail_grid->RowIndex ?>_PCS" size="30" placeholder="<?php echo HtmlEncode($vwPackingdetail->PCS->getPlaceHolder()) ?>" value="<?php echo $vwPackingdetail->PCS->EditValue ?>"<?php echo $vwPackingdetail->PCS->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_vwPackingdetail_PCS" class="form-group vwPackingdetail_PCS">
<span<?php echo $vwPackingdetail->PCS->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?php echo RemoveHtml($vwPackingdetail->PCS->ViewValue) ?>"></span>
</span>
<input type="hidden" data-table="vwPackingdetail" data-field="x_PCS" name="x<?php echo $vwPackingdetail_grid->RowIndex ?>_PCS" id="x<?php echo $vwPackingdetail_grid->RowIndex ?>_PCS" value="<?php echo HtmlEncode($vwPackingdetail->PCS->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="vwPackingdetail" data-field="x_PCS" name="o<?php echo $vwPackingdetail_grid->RowIndex ?>_PCS" id="o<?php echo $vwPackingdetail_grid->RowIndex ?>_PCS" value="<?php echo HtmlEncode($vwPackingdetail->PCS->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($vwPackingdetail->PackingType->Visible) { // PackingType ?>
		<td data-name="PackingType">
<?php if (!$vwPackingdetail->isConfirm()) { ?>
<span id="el$rowindex$_vwPackingdetail_PackingType" class="form-group vwPackingdetail_PackingType">
<input type="text" data-table="vwPackingdetail" data-field="x_PackingType" name="x<?php echo $vwPackingdetail_grid->RowIndex ?>_PackingType" id="x<?php echo $vwPackingdetail_grid->RowIndex ?>_PackingType" size="30" maxlength="55" placeholder="<?php echo HtmlEncode($vwPackingdetail->PackingType->getPlaceHolder()) ?>" value="<?php echo $vwPackingdetail->PackingType->EditValue ?>"<?php echo $vwPackingdetail->PackingType->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_vwPackingdetail_PackingType" class="form-group vwPackingdetail_PackingType">
<span<?php echo $vwPackingdetail->PackingType->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?php echo RemoveHtml($vwPackingdetail->PackingType->ViewValue) ?>"></span>
</span>
<input type="hidden" data-table="vwPackingdetail" data-field="x_PackingType" name="x<?php echo $vwPackingdetail_grid->RowIndex ?>_PackingType" id="x<?php echo $vwPackingdetail_grid->RowIndex ?>_PackingType" value="<?php echo HtmlEncode($vwPackingdetail->PackingType->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="vwPackingdetail" data-field="x_PackingType" name="o<?php echo $vwPackingdetail_grid->RowIndex ?>_PackingType" id="o<?php echo $vwPackingdetail_grid->RowIndex ?>_PackingType" value="<?php echo HtmlEncode($vwPackingdetail->PackingType->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($vwPackingdetail->Length->Visible) { // Length ?>
		<td data-name="Length">
<?php if (!$vwPackingdetail->isConfirm()) { ?>
<span id="el$rowindex$_vwPackingdetail_Length" class="form-group vwPackingdetail_Length">
<input type="text" data-table="vwPackingdetail" data-field="x_Length" name="x<?php echo $vwPackingdetail_grid->RowIndex ?>_Length" id="x<?php echo $vwPackingdetail_grid->RowIndex ?>_Length" size="30" placeholder="<?php echo HtmlEncode($vwPackingdetail->Length->getPlaceHolder()) ?>" value="<?php echo $vwPackingdetail->Length->EditValue ?>"<?php echo $vwPackingdetail->Length->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_vwPackingdetail_Length" class="form-group vwPackingdetail_Length">
<span<?php echo $vwPackingdetail->Length->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?php echo RemoveHtml($vwPackingdetail->Length->ViewValue) ?>"></span>
</span>
<input type="hidden" data-table="vwPackingdetail" data-field="x_Length" name="x<?php echo $vwPackingdetail_grid->RowIndex ?>_Length" id="x<?php echo $vwPackingdetail_grid->RowIndex ?>_Length" value="<?php echo HtmlEncode($vwPackingdetail->Length->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="vwPackingdetail" data-field="x_Length" name="o<?php echo $vwPackingdetail_grid->RowIndex ?>_Length" id="o<?php echo $vwPackingdetail_grid->RowIndex ?>_Length" value="<?php echo HtmlEncode($vwPackingdetail->Length->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($vwPackingdetail->Width->Visible) { // Width ?>
		<td data-name="Width">
<?php if (!$vwPackingdetail->isConfirm()) { ?>
<span id="el$rowindex$_vwPackingdetail_Width" class="form-group vwPackingdetail_Width">
<input type="text" data-table="vwPackingdetail" data-field="x_Width" name="x<?php echo $vwPackingdetail_grid->RowIndex ?>_Width" id="x<?php echo $vwPackingdetail_grid->RowIndex ?>_Width" size="30" placeholder="<?php echo HtmlEncode($vwPackingdetail->Width->getPlaceHolder()) ?>" value="<?php echo $vwPackingdetail->Width->EditValue ?>"<?php echo $vwPackingdetail->Width->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_vwPackingdetail_Width" class="form-group vwPackingdetail_Width">
<span<?php echo $vwPackingdetail->Width->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?php echo RemoveHtml($vwPackingdetail->Width->ViewValue) ?>"></span>
</span>
<input type="hidden" data-table="vwPackingdetail" data-field="x_Width" name="x<?php echo $vwPackingdetail_grid->RowIndex ?>_Width" id="x<?php echo $vwPackingdetail_grid->RowIndex ?>_Width" value="<?php echo HtmlEncode($vwPackingdetail->Width->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="vwPackingdetail" data-field="x_Width" name="o<?php echo $vwPackingdetail_grid->RowIndex ?>_Width" id="o<?php echo $vwPackingdetail_grid->RowIndex ?>_Width" value="<?php echo HtmlEncode($vwPackingdetail->Width->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($vwPackingdetail->Heigth->Visible) { // Heigth ?>
		<td data-name="Heigth">
<?php if (!$vwPackingdetail->isConfirm()) { ?>
<span id="el$rowindex$_vwPackingdetail_Heigth" class="form-group vwPackingdetail_Heigth">
<input type="text" data-table="vwPackingdetail" data-field="x_Heigth" name="x<?php echo $vwPackingdetail_grid->RowIndex ?>_Heigth" id="x<?php echo $vwPackingdetail_grid->RowIndex ?>_Heigth" size="30" placeholder="<?php echo HtmlEncode($vwPackingdetail->Heigth->getPlaceHolder()) ?>" value="<?php echo $vwPackingdetail->Heigth->EditValue ?>"<?php echo $vwPackingdetail->Heigth->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_vwPackingdetail_Heigth" class="form-group vwPackingdetail_Heigth">
<span<?php echo $vwPackingdetail->Heigth->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?php echo RemoveHtml($vwPackingdetail->Heigth->ViewValue) ?>"></span>
</span>
<input type="hidden" data-table="vwPackingdetail" data-field="x_Heigth" name="x<?php echo $vwPackingdetail_grid->RowIndex ?>_Heigth" id="x<?php echo $vwPackingdetail_grid->RowIndex ?>_Heigth" value="<?php echo HtmlEncode($vwPackingdetail->Heigth->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="vwPackingdetail" data-field="x_Heigth" name="o<?php echo $vwPackingdetail_grid->RowIndex ?>_Heigth" id="o<?php echo $vwPackingdetail_grid->RowIndex ?>_Heigth" value="<?php echo HtmlEncode($vwPackingdetail->Heigth->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($vwPackingdetail->finishpacking->Visible) { // finishpacking ?>
		<td data-name="finishpacking">
<?php if (!$vwPackingdetail->isConfirm()) { ?>
<span id="el$rowindex$_vwPackingdetail_finishpacking" class="form-group vwPackingdetail_finishpacking">
<input type="text" data-table="vwPackingdetail" data-field="x_finishpacking" name="x<?php echo $vwPackingdetail_grid->RowIndex ?>_finishpacking" id="x<?php echo $vwPackingdetail_grid->RowIndex ?>_finishpacking" size="30" placeholder="<?php echo HtmlEncode($vwPackingdetail->finishpacking->getPlaceHolder()) ?>" value="<?php echo $vwPackingdetail->finishpacking->EditValue ?>"<?php echo $vwPackingdetail->finishpacking->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_vwPackingdetail_finishpacking" class="form-group vwPackingdetail_finishpacking">
<span<?php echo $vwPackingdetail->finishpacking->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?php echo RemoveHtml($vwPackingdetail->finishpacking->ViewValue) ?>"></span>
</span>
<input type="hidden" data-table="vwPackingdetail" data-field="x_finishpacking" name="x<?php echo $vwPackingdetail_grid->RowIndex ?>_finishpacking" id="x<?php echo $vwPackingdetail_grid->RowIndex ?>_finishpacking" value="<?php echo HtmlEncode($vwPackingdetail->finishpacking->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="vwPackingdetail" data-field="x_finishpacking" name="o<?php echo $vwPackingdetail_grid->RowIndex ?>_finishpacking" id="o<?php echo $vwPackingdetail_grid->RowIndex ?>_finishpacking" value="<?php echo HtmlEncode($vwPackingdetail->finishpacking->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($vwPackingdetail->PE_film_Cover->Visible) { // PE_film_Cover ?>
		<td data-name="PE_film_Cover">
<?php if (!$vwPackingdetail->isConfirm()) { ?>
<span id="el$rowindex$_vwPackingdetail_PE_film_Cover" class="form-group vwPackingdetail_PE_film_Cover">
<input type="text" data-table="vwPackingdetail" data-field="x_PE_film_Cover" name="x<?php echo $vwPackingdetail_grid->RowIndex ?>_PE_film_Cover" id="x<?php echo $vwPackingdetail_grid->RowIndex ?>_PE_film_Cover" size="30" placeholder="<?php echo HtmlEncode($vwPackingdetail->PE_film_Cover->getPlaceHolder()) ?>" value="<?php echo $vwPackingdetail->PE_film_Cover->EditValue ?>"<?php echo $vwPackingdetail->PE_film_Cover->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_vwPackingdetail_PE_film_Cover" class="form-group vwPackingdetail_PE_film_Cover">
<span<?php echo $vwPackingdetail->PE_film_Cover->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?php echo RemoveHtml($vwPackingdetail->PE_film_Cover->ViewValue) ?>"></span>
</span>
<input type="hidden" data-table="vwPackingdetail" data-field="x_PE_film_Cover" name="x<?php echo $vwPackingdetail_grid->RowIndex ?>_PE_film_Cover" id="x<?php echo $vwPackingdetail_grid->RowIndex ?>_PE_film_Cover" value="<?php echo HtmlEncode($vwPackingdetail->PE_film_Cover->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="vwPackingdetail" data-field="x_PE_film_Cover" name="o<?php echo $vwPackingdetail_grid->RowIndex ?>_PE_film_Cover" id="o<?php echo $vwPackingdetail_grid->RowIndex ?>_PE_film_Cover" value="<?php echo HtmlEncode($vwPackingdetail->PE_film_Cover->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($vwPackingdetail->CreateUser->Visible) { // CreateUser ?>
		<td data-name="CreateUser">
<?php if (!$vwPackingdetail->isConfirm()) { ?>
<span id="el$rowindex$_vwPackingdetail_CreateUser" class="form-group vwPackingdetail_CreateUser">
<input type="text" data-table="vwPackingdetail" data-field="x_CreateUser" name="x<?php echo $vwPackingdetail_grid->RowIndex ?>_CreateUser" id="x<?php echo $vwPackingdetail_grid->RowIndex ?>_CreateUser" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($vwPackingdetail->CreateUser->getPlaceHolder()) ?>" value="<?php echo $vwPackingdetail->CreateUser->EditValue ?>"<?php echo $vwPackingdetail->CreateUser->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_vwPackingdetail_CreateUser" class="form-group vwPackingdetail_CreateUser">
<span<?php echo $vwPackingdetail->CreateUser->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?php echo RemoveHtml($vwPackingdetail->CreateUser->ViewValue) ?>"></span>
</span>
<input type="hidden" data-table="vwPackingdetail" data-field="x_CreateUser" name="x<?php echo $vwPackingdetail_grid->RowIndex ?>_CreateUser" id="x<?php echo $vwPackingdetail_grid->RowIndex ?>_CreateUser" value="<?php echo HtmlEncode($vwPackingdetail->CreateUser->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="vwPackingdetail" data-field="x_CreateUser" name="o<?php echo $vwPackingdetail_grid->RowIndex ?>_CreateUser" id="o<?php echo $vwPackingdetail_grid->RowIndex ?>_CreateUser" value="<?php echo HtmlEncode($vwPackingdetail->CreateUser->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($vwPackingdetail->CreateDate->Visible) { // CreateDate ?>
		<td data-name="CreateDate">
<?php if (!$vwPackingdetail->isConfirm()) { ?>
<span id="el$rowindex$_vwPackingdetail_CreateDate" class="form-group vwPackingdetail_CreateDate">
<input type="text" data-table="vwPackingdetail" data-field="x_CreateDate" name="x<?php echo $vwPackingdetail_grid->RowIndex ?>_CreateDate" id="x<?php echo $vwPackingdetail_grid->RowIndex ?>_CreateDate" placeholder="<?php echo HtmlEncode($vwPackingdetail->CreateDate->getPlaceHolder()) ?>" value="<?php echo $vwPackingdetail->CreateDate->EditValue ?>"<?php echo $vwPackingdetail->CreateDate->editAttributes() ?>>
<?php if (!$vwPackingdetail->CreateDate->ReadOnly && !$vwPackingdetail->CreateDate->Disabled && !isset($vwPackingdetail->CreateDate->EditAttrs["readonly"]) && !isset($vwPackingdetail->CreateDate->EditAttrs["disabled"])) { ?>
<script>
ew.createDateTimePicker("fvwPackingdetailgrid", "x<?php echo $vwPackingdetail_grid->RowIndex ?>_CreateDate", {"ignoreReadonly":true,"useCurrent":false,"format":0});
</script>
<?php } ?>
</span>
<?php } else { ?>
<span id="el$rowindex$_vwPackingdetail_CreateDate" class="form-group vwPackingdetail_CreateDate">
<span<?php echo $vwPackingdetail->CreateDate->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?php echo RemoveHtml($vwPackingdetail->CreateDate->ViewValue) ?>"></span>
</span>
<input type="hidden" data-table="vwPackingdetail" data-field="x_CreateDate" name="x<?php echo $vwPackingdetail_grid->RowIndex ?>_CreateDate" id="x<?php echo $vwPackingdetail_grid->RowIndex ?>_CreateDate" value="<?php echo HtmlEncode($vwPackingdetail->CreateDate->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="vwPackingdetail" data-field="x_CreateDate" name="o<?php echo $vwPackingdetail_grid->RowIndex ?>_CreateDate" id="o<?php echo $vwPackingdetail_grid->RowIndex ?>_CreateDate" value="<?php echo HtmlEncode($vwPackingdetail->CreateDate->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($vwPackingdetail->Box->Visible) { // Box ?>
		<td data-name="Box">
<?php if (!$vwPackingdetail->isConfirm()) { ?>
<span id="el$rowindex$_vwPackingdetail_Box" class="form-group vwPackingdetail_Box">
<input type="text" data-table="vwPackingdetail" data-field="x_Box" name="x<?php echo $vwPackingdetail_grid->RowIndex ?>_Box" id="x<?php echo $vwPackingdetail_grid->RowIndex ?>_Box" size="30" placeholder="<?php echo HtmlEncode($vwPackingdetail->Box->getPlaceHolder()) ?>" value="<?php echo $vwPackingdetail->Box->EditValue ?>"<?php echo $vwPackingdetail->Box->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_vwPackingdetail_Box" class="form-group vwPackingdetail_Box">
<span<?php echo $vwPackingdetail->Box->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?php echo RemoveHtml($vwPackingdetail->Box->ViewValue) ?>"></span>
</span>
<input type="hidden" data-table="vwPackingdetail" data-field="x_Box" name="x<?php echo $vwPackingdetail_grid->RowIndex ?>_Box" id="x<?php echo $vwPackingdetail_grid->RowIndex ?>_Box" value="<?php echo HtmlEncode($vwPackingdetail->Box->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="vwPackingdetail" data-field="x_Box" name="o<?php echo $vwPackingdetail_grid->RowIndex ?>_Box" id="o<?php echo $vwPackingdetail_grid->RowIndex ?>_Box" value="<?php echo HtmlEncode($vwPackingdetail->Box->OldValue) ?>">
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$vwPackingdetail_grid->ListOptions->render("body", "right", $vwPackingdetail_grid->RowIndex);
?>
<script>
fvwPackingdetailgrid.updateLists(<?php echo $vwPackingdetail_grid->RowIndex ?>);
</script>
	</tr>
<?php
}
?>
</tbody>
</table><!-- /.ew-table -->
<?php if ($vwPackingdetail->CurrentMode == "add" || $vwPackingdetail->CurrentMode == "copy") { ?>
<input type="hidden" name="<?php echo $vwPackingdetail_grid->FormKeyCountName ?>" id="<?php echo $vwPackingdetail_grid->FormKeyCountName ?>" value="<?php echo $vwPackingdetail_grid->KeyCount ?>">
<?php echo $vwPackingdetail_grid->MultiSelectKey ?>
<?php } ?>
<?php if ($vwPackingdetail->CurrentMode == "edit") { ?>
<input type="hidden" name="<?php echo $vwPackingdetail_grid->FormKeyCountName ?>" id="<?php echo $vwPackingdetail_grid->FormKeyCountName ?>" value="<?php echo $vwPackingdetail_grid->KeyCount ?>">
<?php echo $vwPackingdetail_grid->MultiSelectKey ?>
<?php } ?>
<?php if ($vwPackingdetail->CurrentMode == "") { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
<input type="hidden" name="detailpage" value="fvwPackingdetailgrid">
</div><!-- /.ew-grid-middle-panel -->
<?php

// Close recordset
if ($vwPackingdetail_grid->Recordset)
	$vwPackingdetail_grid->Recordset->Close();
?>
</div>
<?php if ($vwPackingdetail_grid->ShowOtherOptions) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php $vwPackingdetail_grid->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($vwPackingdetail_grid->TotalRecs == 0 && !$vwPackingdetail->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $vwPackingdetail_grid->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$vwPackingdetail_grid->terminate();
?>