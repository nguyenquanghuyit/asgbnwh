<?php
namespace PHPMaker2019\asgbn_wh;

// Write header
WriteHeader(FALSE);

// Create page object
if (!isset($vworderout_grid))
	$vworderout_grid = new vworderout_grid();

// Run the page
$vworderout_grid->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$vworderout_grid->Page_Render();
?>
<?php if (!$vworderout->isExport()) { ?>
<script>

// Form object
var fvworderoutgrid = new ew.Form("fvworderoutgrid", "grid");
fvworderoutgrid.formKeyCountName = '<?php echo $vworderout_grid->FormKeyCountName ?>';

// Validate form
fvworderoutgrid.validate = function() {
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
		<?php if ($vworderout_grid->ID_Order->Required) { ?>
			elm = this.getElements("x" + infix + "_ID_Order");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $vworderout->ID_Order->caption(), $vworderout->ID_Order->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($vworderout_grid->Code->Required) { ?>
			elm = this.getElements("x" + infix + "_Code");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $vworderout->Code->caption(), $vworderout->Code->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($vworderout_grid->PCS->Required) { ?>
			elm = this.getElements("x" + infix + "_PCS");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $vworderout->PCS->caption(), $vworderout->PCS->RequiredErrorMessage)) ?>");
		<?php } ?>
			elm = this.getElements("x" + infix + "_PCS");
			if (elm && !ew.checkInteger(elm.value))
				return this.onError(elm, "<?php echo JsEncode($vworderout->PCS->errorMessage()) ?>");
		<?php if ($vworderout_grid->OrderDate->Required) { ?>
			elm = this.getElements("x" + infix + "_OrderDate");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $vworderout->OrderDate->caption(), $vworderout->OrderDate->RequiredErrorMessage)) ?>");
		<?php } ?>
			elm = this.getElements("x" + infix + "_OrderDate");
			if (elm && !ew.checkEuroDate(elm.value))
				return this.onError(elm, "<?php echo JsEncode($vworderout->OrderDate->errorMessage()) ?>");
		<?php if ($vworderout_grid->ContactName->Required) { ?>
			elm = this.getElements("x" + infix + "_ContactName");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $vworderout->ContactName->caption(), $vworderout->ContactName->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($vworderout_grid->CompanyName->Required) { ?>
			elm = this.getElements("x" + infix + "_CompanyName");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $vworderout->CompanyName->caption(), $vworderout->CompanyName->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($vworderout_grid->ContactPhone->Required) { ?>
			elm = this.getElements("x" + infix + "_ContactPhone");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $vworderout->ContactPhone->caption(), $vworderout->ContactPhone->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($vworderout_grid->StatusFinishOrder->Required) { ?>
			elm = this.getElements("x" + infix + "_StatusFinishOrder");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $vworderout->StatusFinishOrder->caption(), $vworderout->StatusFinishOrder->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($vworderout_grid->DateTimefinishOrder->Required) { ?>
			elm = this.getElements("x" + infix + "_DateTimefinishOrder");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $vworderout->DateTimefinishOrder->caption(), $vworderout->DateTimefinishOrder->RequiredErrorMessage)) ?>");
		<?php } ?>
			elm = this.getElements("x" + infix + "_DateTimefinishOrder");
			if (elm && !ew.checkEuroDate(elm.value))
				return this.onError(elm, "<?php echo JsEncode($vworderout->DateTimefinishOrder->errorMessage()) ?>");
		<?php if ($vworderout_grid->UserFinishOrder->Required) { ?>
			elm = this.getElements("x" + infix + "_UserFinishOrder");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $vworderout->UserFinishOrder->caption(), $vworderout->UserFinishOrder->RequiredErrorMessage)) ?>");
		<?php } ?>

			// Fire Form_CustomValidate event
			if (!this.Form_CustomValidate(fobj))
				return false;
		} // End Grid Add checking
	}
	return true;
}

// Check empty row
fvworderoutgrid.emptyRow = function(infix) {
	var fobj = this._form;
	if (ew.valueChanged(fobj, infix, "Code", false)) return false;
	if (ew.valueChanged(fobj, infix, "PCS", false)) return false;
	if (ew.valueChanged(fobj, infix, "OrderDate", false)) return false;
	if (ew.valueChanged(fobj, infix, "ContactName", false)) return false;
	if (ew.valueChanged(fobj, infix, "CompanyName", false)) return false;
	if (ew.valueChanged(fobj, infix, "ContactPhone", false)) return false;
	if (ew.valueChanged(fobj, infix, "StatusFinishOrder", false)) return false;
	if (ew.valueChanged(fobj, infix, "DateTimefinishOrder", false)) return false;
	if (ew.valueChanged(fobj, infix, "UserFinishOrder", false)) return false;
	return true;
}

// Form_CustomValidate event
fvworderoutgrid.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

	// Your custom validation code here, return false if invalid.
	return true;
}

// Use JavaScript validation or not
fvworderoutgrid.validateRequired = <?php echo json_encode(CLIENT_VALIDATE) ?>;

// Dynamic selection lists
fvworderoutgrid.lists["x_StatusFinishOrder"] = <?php echo $vworderout_grid->StatusFinishOrder->Lookup->toClientList() ?>;
fvworderoutgrid.lists["x_StatusFinishOrder"].options = <?php echo JsonEncode($vworderout_grid->StatusFinishOrder->options(FALSE, TRUE)) ?>;

// Form object for search
</script>
<?php } ?>
<?php
$vworderout_grid->renderOtherOptions();
?>
<?php $vworderout_grid->showPageHeader(); ?>
<?php
$vworderout_grid->showMessage();
?>
<?php if ($vworderout_grid->TotalRecs > 0 || $vworderout->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($vworderout_grid->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> vworderout">
<?php if ($vworderout_grid->ShowOtherOptions) { ?>
<div class="card-header ew-grid-upper-panel">
<?php $vworderout_grid->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<div id="fvworderoutgrid" class="ew-form ew-list-form form-inline">
<div id="gmp_vworderout" class="<?php if (IsResponsiveLayout()) { ?>table-responsive <?php } ?>card-body ew-grid-middle-panel">
<table id="tbl_vworderoutgrid" class="table ew-table"><!-- .ew-table ##-->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$vworderout_grid->RowType = ROWTYPE_HEADER;

// Render list options
$vworderout_grid->renderListOptions();

// Render list options (header, left)
$vworderout_grid->ListOptions->render("header", "left");
?>
<?php if ($vworderout->ID_Order->Visible) { // ID_Order ?>
	<?php if ($vworderout->sortUrl($vworderout->ID_Order) == "") { ?>
		<th data-name="ID_Order" class="<?php echo $vworderout->ID_Order->headerCellClass() ?>" style="white-space: nowrap;"><div id="elh_vworderout_ID_Order" class="vworderout_ID_Order"><div class="ew-table-header-caption"><?php echo $vworderout->ID_Order->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="ID_Order" class="<?php echo $vworderout->ID_Order->headerCellClass() ?>" style="white-space: nowrap;"><div><div id="elh_vworderout_ID_Order" class="vworderout_ID_Order">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $vworderout->ID_Order->caption() ?></span><span class="ew-table-header-sort"><?php if ($vworderout->ID_Order->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($vworderout->ID_Order->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($vworderout->Code->Visible) { // Code ?>
	<?php if ($vworderout->sortUrl($vworderout->Code) == "") { ?>
		<th data-name="Code" class="<?php echo $vworderout->Code->headerCellClass() ?>" style="white-space: nowrap;"><div id="elh_vworderout_Code" class="vworderout_Code"><div class="ew-table-header-caption"><?php echo $vworderout->Code->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Code" class="<?php echo $vworderout->Code->headerCellClass() ?>" style="white-space: nowrap;"><div><div id="elh_vworderout_Code" class="vworderout_Code">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $vworderout->Code->caption() ?></span><span class="ew-table-header-sort"><?php if ($vworderout->Code->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($vworderout->Code->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($vworderout->PCS->Visible) { // PCS ?>
	<?php if ($vworderout->sortUrl($vworderout->PCS) == "") { ?>
		<th data-name="PCS" class="<?php echo $vworderout->PCS->headerCellClass() ?>" style="white-space: nowrap;"><div id="elh_vworderout_PCS" class="vworderout_PCS"><div class="ew-table-header-caption"><?php echo $vworderout->PCS->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="PCS" class="<?php echo $vworderout->PCS->headerCellClass() ?>" style="white-space: nowrap;"><div><div id="elh_vworderout_PCS" class="vworderout_PCS">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $vworderout->PCS->caption() ?></span><span class="ew-table-header-sort"><?php if ($vworderout->PCS->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($vworderout->PCS->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($vworderout->OrderDate->Visible) { // OrderDate ?>
	<?php if ($vworderout->sortUrl($vworderout->OrderDate) == "") { ?>
		<th data-name="OrderDate" class="<?php echo $vworderout->OrderDate->headerCellClass() ?>" style="white-space: nowrap;"><div id="elh_vworderout_OrderDate" class="vworderout_OrderDate"><div class="ew-table-header-caption"><?php echo $vworderout->OrderDate->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="OrderDate" class="<?php echo $vworderout->OrderDate->headerCellClass() ?>" style="white-space: nowrap;"><div><div id="elh_vworderout_OrderDate" class="vworderout_OrderDate">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $vworderout->OrderDate->caption() ?></span><span class="ew-table-header-sort"><?php if ($vworderout->OrderDate->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($vworderout->OrderDate->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($vworderout->ContactName->Visible) { // ContactName ?>
	<?php if ($vworderout->sortUrl($vworderout->ContactName) == "") { ?>
		<th data-name="ContactName" class="<?php echo $vworderout->ContactName->headerCellClass() ?>" style="white-space: nowrap;"><div id="elh_vworderout_ContactName" class="vworderout_ContactName"><div class="ew-table-header-caption"><?php echo $vworderout->ContactName->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="ContactName" class="<?php echo $vworderout->ContactName->headerCellClass() ?>" style="white-space: nowrap;"><div><div id="elh_vworderout_ContactName" class="vworderout_ContactName">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $vworderout->ContactName->caption() ?></span><span class="ew-table-header-sort"><?php if ($vworderout->ContactName->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($vworderout->ContactName->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($vworderout->CompanyName->Visible) { // CompanyName ?>
	<?php if ($vworderout->sortUrl($vworderout->CompanyName) == "") { ?>
		<th data-name="CompanyName" class="<?php echo $vworderout->CompanyName->headerCellClass() ?>" style="white-space: nowrap;"><div id="elh_vworderout_CompanyName" class="vworderout_CompanyName"><div class="ew-table-header-caption"><?php echo $vworderout->CompanyName->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="CompanyName" class="<?php echo $vworderout->CompanyName->headerCellClass() ?>" style="white-space: nowrap;"><div><div id="elh_vworderout_CompanyName" class="vworderout_CompanyName">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $vworderout->CompanyName->caption() ?></span><span class="ew-table-header-sort"><?php if ($vworderout->CompanyName->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($vworderout->CompanyName->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($vworderout->ContactPhone->Visible) { // ContactPhone ?>
	<?php if ($vworderout->sortUrl($vworderout->ContactPhone) == "") { ?>
		<th data-name="ContactPhone" class="<?php echo $vworderout->ContactPhone->headerCellClass() ?>" style="white-space: nowrap;"><div id="elh_vworderout_ContactPhone" class="vworderout_ContactPhone"><div class="ew-table-header-caption"><?php echo $vworderout->ContactPhone->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="ContactPhone" class="<?php echo $vworderout->ContactPhone->headerCellClass() ?>" style="white-space: nowrap;"><div><div id="elh_vworderout_ContactPhone" class="vworderout_ContactPhone">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $vworderout->ContactPhone->caption() ?></span><span class="ew-table-header-sort"><?php if ($vworderout->ContactPhone->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($vworderout->ContactPhone->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($vworderout->StatusFinishOrder->Visible) { // StatusFinishOrder ?>
	<?php if ($vworderout->sortUrl($vworderout->StatusFinishOrder) == "") { ?>
		<th data-name="StatusFinishOrder" class="<?php echo $vworderout->StatusFinishOrder->headerCellClass() ?>" style="white-space: nowrap;"><div id="elh_vworderout_StatusFinishOrder" class="vworderout_StatusFinishOrder"><div class="ew-table-header-caption"><?php echo $vworderout->StatusFinishOrder->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="StatusFinishOrder" class="<?php echo $vworderout->StatusFinishOrder->headerCellClass() ?>" style="white-space: nowrap;"><div><div id="elh_vworderout_StatusFinishOrder" class="vworderout_StatusFinishOrder">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $vworderout->StatusFinishOrder->caption() ?></span><span class="ew-table-header-sort"><?php if ($vworderout->StatusFinishOrder->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($vworderout->StatusFinishOrder->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($vworderout->DateTimefinishOrder->Visible) { // DateTimefinishOrder ?>
	<?php if ($vworderout->sortUrl($vworderout->DateTimefinishOrder) == "") { ?>
		<th data-name="DateTimefinishOrder" class="<?php echo $vworderout->DateTimefinishOrder->headerCellClass() ?>" style="white-space: nowrap;"><div id="elh_vworderout_DateTimefinishOrder" class="vworderout_DateTimefinishOrder"><div class="ew-table-header-caption"><?php echo $vworderout->DateTimefinishOrder->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="DateTimefinishOrder" class="<?php echo $vworderout->DateTimefinishOrder->headerCellClass() ?>" style="white-space: nowrap;"><div><div id="elh_vworderout_DateTimefinishOrder" class="vworderout_DateTimefinishOrder">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $vworderout->DateTimefinishOrder->caption() ?></span><span class="ew-table-header-sort"><?php if ($vworderout->DateTimefinishOrder->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($vworderout->DateTimefinishOrder->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($vworderout->UserFinishOrder->Visible) { // UserFinishOrder ?>
	<?php if ($vworderout->sortUrl($vworderout->UserFinishOrder) == "") { ?>
		<th data-name="UserFinishOrder" class="<?php echo $vworderout->UserFinishOrder->headerCellClass() ?>" style="white-space: nowrap;"><div id="elh_vworderout_UserFinishOrder" class="vworderout_UserFinishOrder"><div class="ew-table-header-caption"><?php echo $vworderout->UserFinishOrder->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="UserFinishOrder" class="<?php echo $vworderout->UserFinishOrder->headerCellClass() ?>" style="white-space: nowrap;"><div><div id="elh_vworderout_UserFinishOrder" class="vworderout_UserFinishOrder">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $vworderout->UserFinishOrder->caption() ?></span><span class="ew-table-header-sort"><?php if ($vworderout->UserFinishOrder->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($vworderout->UserFinishOrder->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$vworderout_grid->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
$vworderout_grid->StartRec = 1;
$vworderout_grid->StopRec = $vworderout_grid->TotalRecs; // Show all records

// Restore number of post back records
if ($CurrentForm && $vworderout_grid->EventCancelled) {
	$CurrentForm->Index = -1;
	if ($CurrentForm->hasValue($vworderout_grid->FormKeyCountName) && ($vworderout->isGridAdd() || $vworderout->isGridEdit() || $vworderout->isConfirm())) {
		$vworderout_grid->KeyCount = $CurrentForm->getValue($vworderout_grid->FormKeyCountName);
		$vworderout_grid->StopRec = $vworderout_grid->StartRec + $vworderout_grid->KeyCount - 1;
	}
}
$vworderout_grid->RecCnt = $vworderout_grid->StartRec - 1;
if ($vworderout_grid->Recordset && !$vworderout_grid->Recordset->EOF) {
	$vworderout_grid->Recordset->moveFirst();
	$selectLimit = $vworderout_grid->UseSelectLimit;
	if (!$selectLimit && $vworderout_grid->StartRec > 1)
		$vworderout_grid->Recordset->move($vworderout_grid->StartRec - 1);
} elseif (!$vworderout->AllowAddDeleteRow && $vworderout_grid->StopRec == 0) {
	$vworderout_grid->StopRec = $vworderout->GridAddRowCount;
}

// Initialize aggregate
$vworderout->RowType = ROWTYPE_AGGREGATEINIT;
$vworderout->resetAttributes();
$vworderout_grid->renderRow();
if ($vworderout->isGridAdd())
	$vworderout_grid->RowIndex = 0;
if ($vworderout->isGridEdit())
	$vworderout_grid->RowIndex = 0;
while ($vworderout_grid->RecCnt < $vworderout_grid->StopRec) {
	$vworderout_grid->RecCnt++;
	if ($vworderout_grid->RecCnt >= $vworderout_grid->StartRec) {
		$vworderout_grid->RowCnt++;
		if ($vworderout->isGridAdd() || $vworderout->isGridEdit() || $vworderout->isConfirm()) {
			$vworderout_grid->RowIndex++;
			$CurrentForm->Index = $vworderout_grid->RowIndex;
			if ($CurrentForm->hasValue($vworderout_grid->FormActionName) && $vworderout_grid->EventCancelled)
				$vworderout_grid->RowAction = strval($CurrentForm->getValue($vworderout_grid->FormActionName));
			elseif ($vworderout->isGridAdd())
				$vworderout_grid->RowAction = "insert";
			else
				$vworderout_grid->RowAction = "";
		}

		// Set up key count
		$vworderout_grid->KeyCount = $vworderout_grid->RowIndex;

		// Init row class and style
		$vworderout->resetAttributes();
		$vworderout->CssClass = "";
		if ($vworderout->isGridAdd()) {
			if ($vworderout->CurrentMode == "copy") {
				$vworderout_grid->loadRowValues($vworderout_grid->Recordset); // Load row values
				$vworderout_grid->setRecordKey($vworderout_grid->RowOldKey, $vworderout_grid->Recordset); // Set old record key
			} else {
				$vworderout_grid->loadRowValues(); // Load default values
				$vworderout_grid->RowOldKey = ""; // Clear old key value
			}
		} else {
			$vworderout_grid->loadRowValues($vworderout_grid->Recordset); // Load row values
		}
		$vworderout->RowType = ROWTYPE_VIEW; // Render view
		if ($vworderout->isGridAdd()) // Grid add
			$vworderout->RowType = ROWTYPE_ADD; // Render add
		if ($vworderout->isGridAdd() && $vworderout->EventCancelled && !$CurrentForm->hasValue("k_blankrow")) // Insert failed
			$vworderout_grid->restoreCurrentRowFormValues($vworderout_grid->RowIndex); // Restore form values
		if ($vworderout->isGridEdit()) { // Grid edit
			if ($vworderout->EventCancelled)
				$vworderout_grid->restoreCurrentRowFormValues($vworderout_grid->RowIndex); // Restore form values
			if ($vworderout_grid->RowAction == "insert")
				$vworderout->RowType = ROWTYPE_ADD; // Render add
			else
				$vworderout->RowType = ROWTYPE_EDIT; // Render edit
		}
		if ($vworderout->isGridEdit() && ($vworderout->RowType == ROWTYPE_EDIT || $vworderout->RowType == ROWTYPE_ADD) && $vworderout->EventCancelled) // Update failed
			$vworderout_grid->restoreCurrentRowFormValues($vworderout_grid->RowIndex); // Restore form values
		if ($vworderout->RowType == ROWTYPE_EDIT) // Edit row
			$vworderout_grid->EditRowCnt++;
		if ($vworderout->isConfirm()) // Confirm row
			$vworderout_grid->restoreCurrentRowFormValues($vworderout_grid->RowIndex); // Restore form values

		// Set up row id / data-rowindex
		$vworderout->RowAttrs = array_merge($vworderout->RowAttrs, array('data-rowindex'=>$vworderout_grid->RowCnt, 'id'=>'r' . $vworderout_grid->RowCnt . '_vworderout', 'data-rowtype'=>$vworderout->RowType));

		// Render row
		$vworderout_grid->renderRow();

		// Render list options
		$vworderout_grid->renderListOptions();

		// Skip delete row / empty row for confirm page
		if ($vworderout_grid->RowAction <> "delete" && $vworderout_grid->RowAction <> "insertdelete" && !($vworderout_grid->RowAction == "insert" && $vworderout->isConfirm() && $vworderout_grid->emptyRow())) {
?>
	<tr<?php echo $vworderout->rowAttributes() ?>>
<?php

// Render list options (body, left)
$vworderout_grid->ListOptions->render("body", "left", $vworderout_grid->RowCnt);
?>
	<?php if ($vworderout->ID_Order->Visible) { // ID_Order ?>
		<td data-name="ID_Order"<?php echo $vworderout->ID_Order->cellAttributes() ?>>
<?php if ($vworderout->RowType == ROWTYPE_ADD) { // Add record ?>
<input type="hidden" data-table="vworderout" data-field="x_ID_Order" name="o<?php echo $vworderout_grid->RowIndex ?>_ID_Order" id="o<?php echo $vworderout_grid->RowIndex ?>_ID_Order" value="<?php echo HtmlEncode($vworderout->ID_Order->OldValue) ?>">
<?php } ?>
<?php if ($vworderout->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $vworderout_grid->RowCnt ?>_vworderout_ID_Order" class="form-group vworderout_ID_Order">
<span<?php echo $vworderout->ID_Order->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?php echo RemoveHtml($vworderout->ID_Order->EditValue) ?>"></span>
</span>
<input type="hidden" data-table="vworderout" data-field="x_ID_Order" name="x<?php echo $vworderout_grid->RowIndex ?>_ID_Order" id="x<?php echo $vworderout_grid->RowIndex ?>_ID_Order" value="<?php echo HtmlEncode($vworderout->ID_Order->CurrentValue) ?>">
<?php } ?>
<?php if ($vworderout->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $vworderout_grid->RowCnt ?>_vworderout_ID_Order" class="vworderout_ID_Order">
<span<?php echo $vworderout->ID_Order->viewAttributes() ?>>
<?php echo $vworderout->ID_Order->getViewValue() ?></span>
</span>
<?php if (!$vworderout->isConfirm()) { ?>
<input type="hidden" data-table="vworderout" data-field="x_ID_Order" name="x<?php echo $vworderout_grid->RowIndex ?>_ID_Order" id="x<?php echo $vworderout_grid->RowIndex ?>_ID_Order" value="<?php echo HtmlEncode($vworderout->ID_Order->FormValue) ?>">
<input type="hidden" data-table="vworderout" data-field="x_ID_Order" name="o<?php echo $vworderout_grid->RowIndex ?>_ID_Order" id="o<?php echo $vworderout_grid->RowIndex ?>_ID_Order" value="<?php echo HtmlEncode($vworderout->ID_Order->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="vworderout" data-field="x_ID_Order" name="fvworderoutgrid$x<?php echo $vworderout_grid->RowIndex ?>_ID_Order" id="fvworderoutgrid$x<?php echo $vworderout_grid->RowIndex ?>_ID_Order" value="<?php echo HtmlEncode($vworderout->ID_Order->FormValue) ?>">
<input type="hidden" data-table="vworderout" data-field="x_ID_Order" name="fvworderoutgrid$o<?php echo $vworderout_grid->RowIndex ?>_ID_Order" id="fvworderoutgrid$o<?php echo $vworderout_grid->RowIndex ?>_ID_Order" value="<?php echo HtmlEncode($vworderout->ID_Order->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($vworderout->Code->Visible) { // Code ?>
		<td data-name="Code"<?php echo $vworderout->Code->cellAttributes() ?>>
<?php if ($vworderout->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $vworderout_grid->RowCnt ?>_vworderout_Code" class="form-group vworderout_Code">
<input type="text" data-table="vworderout" data-field="x_Code" name="x<?php echo $vworderout_grid->RowIndex ?>_Code" id="x<?php echo $vworderout_grid->RowIndex ?>_Code" size="30" maxlength="50" placeholder="<?php echo HtmlEncode($vworderout->Code->getPlaceHolder()) ?>" value="<?php echo $vworderout->Code->EditValue ?>"<?php echo $vworderout->Code->editAttributes() ?>>
</span>
<input type="hidden" data-table="vworderout" data-field="x_Code" name="o<?php echo $vworderout_grid->RowIndex ?>_Code" id="o<?php echo $vworderout_grid->RowIndex ?>_Code" value="<?php echo HtmlEncode($vworderout->Code->OldValue) ?>">
<?php } ?>
<?php if ($vworderout->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $vworderout_grid->RowCnt ?>_vworderout_Code" class="form-group vworderout_Code">
<input type="text" data-table="vworderout" data-field="x_Code" name="x<?php echo $vworderout_grid->RowIndex ?>_Code" id="x<?php echo $vworderout_grid->RowIndex ?>_Code" size="30" maxlength="50" placeholder="<?php echo HtmlEncode($vworderout->Code->getPlaceHolder()) ?>" value="<?php echo $vworderout->Code->EditValue ?>"<?php echo $vworderout->Code->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($vworderout->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $vworderout_grid->RowCnt ?>_vworderout_Code" class="vworderout_Code">
<span<?php echo $vworderout->Code->viewAttributes() ?>>
<?php echo $vworderout->Code->getViewValue() ?></span>
</span>
<?php if (!$vworderout->isConfirm()) { ?>
<input type="hidden" data-table="vworderout" data-field="x_Code" name="x<?php echo $vworderout_grid->RowIndex ?>_Code" id="x<?php echo $vworderout_grid->RowIndex ?>_Code" value="<?php echo HtmlEncode($vworderout->Code->FormValue) ?>">
<input type="hidden" data-table="vworderout" data-field="x_Code" name="o<?php echo $vworderout_grid->RowIndex ?>_Code" id="o<?php echo $vworderout_grid->RowIndex ?>_Code" value="<?php echo HtmlEncode($vworderout->Code->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="vworderout" data-field="x_Code" name="fvworderoutgrid$x<?php echo $vworderout_grid->RowIndex ?>_Code" id="fvworderoutgrid$x<?php echo $vworderout_grid->RowIndex ?>_Code" value="<?php echo HtmlEncode($vworderout->Code->FormValue) ?>">
<input type="hidden" data-table="vworderout" data-field="x_Code" name="fvworderoutgrid$o<?php echo $vworderout_grid->RowIndex ?>_Code" id="fvworderoutgrid$o<?php echo $vworderout_grid->RowIndex ?>_Code" value="<?php echo HtmlEncode($vworderout->Code->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($vworderout->PCS->Visible) { // PCS ?>
		<td data-name="PCS"<?php echo $vworderout->PCS->cellAttributes() ?>>
<?php if ($vworderout->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $vworderout_grid->RowCnt ?>_vworderout_PCS" class="form-group vworderout_PCS">
<input type="text" data-table="vworderout" data-field="x_PCS" name="x<?php echo $vworderout_grid->RowIndex ?>_PCS" id="x<?php echo $vworderout_grid->RowIndex ?>_PCS" size="30" placeholder="<?php echo HtmlEncode($vworderout->PCS->getPlaceHolder()) ?>" value="<?php echo $vworderout->PCS->EditValue ?>"<?php echo $vworderout->PCS->editAttributes() ?>>
</span>
<input type="hidden" data-table="vworderout" data-field="x_PCS" name="o<?php echo $vworderout_grid->RowIndex ?>_PCS" id="o<?php echo $vworderout_grid->RowIndex ?>_PCS" value="<?php echo HtmlEncode($vworderout->PCS->OldValue) ?>">
<?php } ?>
<?php if ($vworderout->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $vworderout_grid->RowCnt ?>_vworderout_PCS" class="form-group vworderout_PCS">
<input type="text" data-table="vworderout" data-field="x_PCS" name="x<?php echo $vworderout_grid->RowIndex ?>_PCS" id="x<?php echo $vworderout_grid->RowIndex ?>_PCS" size="30" placeholder="<?php echo HtmlEncode($vworderout->PCS->getPlaceHolder()) ?>" value="<?php echo $vworderout->PCS->EditValue ?>"<?php echo $vworderout->PCS->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($vworderout->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $vworderout_grid->RowCnt ?>_vworderout_PCS" class="vworderout_PCS">
<span<?php echo $vworderout->PCS->viewAttributes() ?>>
<?php echo $vworderout->PCS->getViewValue() ?></span>
</span>
<?php if (!$vworderout->isConfirm()) { ?>
<input type="hidden" data-table="vworderout" data-field="x_PCS" name="x<?php echo $vworderout_grid->RowIndex ?>_PCS" id="x<?php echo $vworderout_grid->RowIndex ?>_PCS" value="<?php echo HtmlEncode($vworderout->PCS->FormValue) ?>">
<input type="hidden" data-table="vworderout" data-field="x_PCS" name="o<?php echo $vworderout_grid->RowIndex ?>_PCS" id="o<?php echo $vworderout_grid->RowIndex ?>_PCS" value="<?php echo HtmlEncode($vworderout->PCS->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="vworderout" data-field="x_PCS" name="fvworderoutgrid$x<?php echo $vworderout_grid->RowIndex ?>_PCS" id="fvworderoutgrid$x<?php echo $vworderout_grid->RowIndex ?>_PCS" value="<?php echo HtmlEncode($vworderout->PCS->FormValue) ?>">
<input type="hidden" data-table="vworderout" data-field="x_PCS" name="fvworderoutgrid$o<?php echo $vworderout_grid->RowIndex ?>_PCS" id="fvworderoutgrid$o<?php echo $vworderout_grid->RowIndex ?>_PCS" value="<?php echo HtmlEncode($vworderout->PCS->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($vworderout->OrderDate->Visible) { // OrderDate ?>
		<td data-name="OrderDate"<?php echo $vworderout->OrderDate->cellAttributes() ?>>
<?php if ($vworderout->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $vworderout_grid->RowCnt ?>_vworderout_OrderDate" class="form-group vworderout_OrderDate">
<input type="text" data-table="vworderout" data-field="x_OrderDate" data-format="7" name="x<?php echo $vworderout_grid->RowIndex ?>_OrderDate" id="x<?php echo $vworderout_grid->RowIndex ?>_OrderDate" placeholder="<?php echo HtmlEncode($vworderout->OrderDate->getPlaceHolder()) ?>" value="<?php echo $vworderout->OrderDate->EditValue ?>"<?php echo $vworderout->OrderDate->editAttributes() ?>>
<?php if (!$vworderout->OrderDate->ReadOnly && !$vworderout->OrderDate->Disabled && !isset($vworderout->OrderDate->EditAttrs["readonly"]) && !isset($vworderout->OrderDate->EditAttrs["disabled"])) { ?>
<script>
ew.createDateTimePicker("fvworderoutgrid", "x<?php echo $vworderout_grid->RowIndex ?>_OrderDate", {"ignoreReadonly":true,"useCurrent":false,"format":7});
</script>
<?php } ?>
</span>
<input type="hidden" data-table="vworderout" data-field="x_OrderDate" name="o<?php echo $vworderout_grid->RowIndex ?>_OrderDate" id="o<?php echo $vworderout_grid->RowIndex ?>_OrderDate" value="<?php echo HtmlEncode($vworderout->OrderDate->OldValue) ?>">
<?php } ?>
<?php if ($vworderout->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $vworderout_grid->RowCnt ?>_vworderout_OrderDate" class="form-group vworderout_OrderDate">
<input type="text" data-table="vworderout" data-field="x_OrderDate" data-format="7" name="x<?php echo $vworderout_grid->RowIndex ?>_OrderDate" id="x<?php echo $vworderout_grid->RowIndex ?>_OrderDate" placeholder="<?php echo HtmlEncode($vworderout->OrderDate->getPlaceHolder()) ?>" value="<?php echo $vworderout->OrderDate->EditValue ?>"<?php echo $vworderout->OrderDate->editAttributes() ?>>
<?php if (!$vworderout->OrderDate->ReadOnly && !$vworderout->OrderDate->Disabled && !isset($vworderout->OrderDate->EditAttrs["readonly"]) && !isset($vworderout->OrderDate->EditAttrs["disabled"])) { ?>
<script>
ew.createDateTimePicker("fvworderoutgrid", "x<?php echo $vworderout_grid->RowIndex ?>_OrderDate", {"ignoreReadonly":true,"useCurrent":false,"format":7});
</script>
<?php } ?>
</span>
<?php } ?>
<?php if ($vworderout->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $vworderout_grid->RowCnt ?>_vworderout_OrderDate" class="vworderout_OrderDate">
<span<?php echo $vworderout->OrderDate->viewAttributes() ?>>
<?php echo $vworderout->OrderDate->getViewValue() ?></span>
</span>
<?php if (!$vworderout->isConfirm()) { ?>
<input type="hidden" data-table="vworderout" data-field="x_OrderDate" name="x<?php echo $vworderout_grid->RowIndex ?>_OrderDate" id="x<?php echo $vworderout_grid->RowIndex ?>_OrderDate" value="<?php echo HtmlEncode($vworderout->OrderDate->FormValue) ?>">
<input type="hidden" data-table="vworderout" data-field="x_OrderDate" name="o<?php echo $vworderout_grid->RowIndex ?>_OrderDate" id="o<?php echo $vworderout_grid->RowIndex ?>_OrderDate" value="<?php echo HtmlEncode($vworderout->OrderDate->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="vworderout" data-field="x_OrderDate" name="fvworderoutgrid$x<?php echo $vworderout_grid->RowIndex ?>_OrderDate" id="fvworderoutgrid$x<?php echo $vworderout_grid->RowIndex ?>_OrderDate" value="<?php echo HtmlEncode($vworderout->OrderDate->FormValue) ?>">
<input type="hidden" data-table="vworderout" data-field="x_OrderDate" name="fvworderoutgrid$o<?php echo $vworderout_grid->RowIndex ?>_OrderDate" id="fvworderoutgrid$o<?php echo $vworderout_grid->RowIndex ?>_OrderDate" value="<?php echo HtmlEncode($vworderout->OrderDate->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($vworderout->ContactName->Visible) { // ContactName ?>
		<td data-name="ContactName"<?php echo $vworderout->ContactName->cellAttributes() ?>>
<?php if ($vworderout->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $vworderout_grid->RowCnt ?>_vworderout_ContactName" class="form-group vworderout_ContactName">
<input type="text" data-table="vworderout" data-field="x_ContactName" name="x<?php echo $vworderout_grid->RowIndex ?>_ContactName" id="x<?php echo $vworderout_grid->RowIndex ?>_ContactName" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($vworderout->ContactName->getPlaceHolder()) ?>" value="<?php echo $vworderout->ContactName->EditValue ?>"<?php echo $vworderout->ContactName->editAttributes() ?>>
</span>
<input type="hidden" data-table="vworderout" data-field="x_ContactName" name="o<?php echo $vworderout_grid->RowIndex ?>_ContactName" id="o<?php echo $vworderout_grid->RowIndex ?>_ContactName" value="<?php echo HtmlEncode($vworderout->ContactName->OldValue) ?>">
<?php } ?>
<?php if ($vworderout->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $vworderout_grid->RowCnt ?>_vworderout_ContactName" class="form-group vworderout_ContactName">
<input type="text" data-table="vworderout" data-field="x_ContactName" name="x<?php echo $vworderout_grid->RowIndex ?>_ContactName" id="x<?php echo $vworderout_grid->RowIndex ?>_ContactName" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($vworderout->ContactName->getPlaceHolder()) ?>" value="<?php echo $vworderout->ContactName->EditValue ?>"<?php echo $vworderout->ContactName->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($vworderout->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $vworderout_grid->RowCnt ?>_vworderout_ContactName" class="vworderout_ContactName">
<span<?php echo $vworderout->ContactName->viewAttributes() ?>>
<?php echo $vworderout->ContactName->getViewValue() ?></span>
</span>
<?php if (!$vworderout->isConfirm()) { ?>
<input type="hidden" data-table="vworderout" data-field="x_ContactName" name="x<?php echo $vworderout_grid->RowIndex ?>_ContactName" id="x<?php echo $vworderout_grid->RowIndex ?>_ContactName" value="<?php echo HtmlEncode($vworderout->ContactName->FormValue) ?>">
<input type="hidden" data-table="vworderout" data-field="x_ContactName" name="o<?php echo $vworderout_grid->RowIndex ?>_ContactName" id="o<?php echo $vworderout_grid->RowIndex ?>_ContactName" value="<?php echo HtmlEncode($vworderout->ContactName->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="vworderout" data-field="x_ContactName" name="fvworderoutgrid$x<?php echo $vworderout_grid->RowIndex ?>_ContactName" id="fvworderoutgrid$x<?php echo $vworderout_grid->RowIndex ?>_ContactName" value="<?php echo HtmlEncode($vworderout->ContactName->FormValue) ?>">
<input type="hidden" data-table="vworderout" data-field="x_ContactName" name="fvworderoutgrid$o<?php echo $vworderout_grid->RowIndex ?>_ContactName" id="fvworderoutgrid$o<?php echo $vworderout_grid->RowIndex ?>_ContactName" value="<?php echo HtmlEncode($vworderout->ContactName->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($vworderout->CompanyName->Visible) { // CompanyName ?>
		<td data-name="CompanyName"<?php echo $vworderout->CompanyName->cellAttributes() ?>>
<?php if ($vworderout->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $vworderout_grid->RowCnt ?>_vworderout_CompanyName" class="form-group vworderout_CompanyName">
<input type="text" data-table="vworderout" data-field="x_CompanyName" name="x<?php echo $vworderout_grid->RowIndex ?>_CompanyName" id="x<?php echo $vworderout_grid->RowIndex ?>_CompanyName" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($vworderout->CompanyName->getPlaceHolder()) ?>" value="<?php echo $vworderout->CompanyName->EditValue ?>"<?php echo $vworderout->CompanyName->editAttributes() ?>>
</span>
<input type="hidden" data-table="vworderout" data-field="x_CompanyName" name="o<?php echo $vworderout_grid->RowIndex ?>_CompanyName" id="o<?php echo $vworderout_grid->RowIndex ?>_CompanyName" value="<?php echo HtmlEncode($vworderout->CompanyName->OldValue) ?>">
<?php } ?>
<?php if ($vworderout->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $vworderout_grid->RowCnt ?>_vworderout_CompanyName" class="form-group vworderout_CompanyName">
<input type="text" data-table="vworderout" data-field="x_CompanyName" name="x<?php echo $vworderout_grid->RowIndex ?>_CompanyName" id="x<?php echo $vworderout_grid->RowIndex ?>_CompanyName" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($vworderout->CompanyName->getPlaceHolder()) ?>" value="<?php echo $vworderout->CompanyName->EditValue ?>"<?php echo $vworderout->CompanyName->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($vworderout->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $vworderout_grid->RowCnt ?>_vworderout_CompanyName" class="vworderout_CompanyName">
<span<?php echo $vworderout->CompanyName->viewAttributes() ?>>
<?php echo $vworderout->CompanyName->getViewValue() ?></span>
</span>
<?php if (!$vworderout->isConfirm()) { ?>
<input type="hidden" data-table="vworderout" data-field="x_CompanyName" name="x<?php echo $vworderout_grid->RowIndex ?>_CompanyName" id="x<?php echo $vworderout_grid->RowIndex ?>_CompanyName" value="<?php echo HtmlEncode($vworderout->CompanyName->FormValue) ?>">
<input type="hidden" data-table="vworderout" data-field="x_CompanyName" name="o<?php echo $vworderout_grid->RowIndex ?>_CompanyName" id="o<?php echo $vworderout_grid->RowIndex ?>_CompanyName" value="<?php echo HtmlEncode($vworderout->CompanyName->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="vworderout" data-field="x_CompanyName" name="fvworderoutgrid$x<?php echo $vworderout_grid->RowIndex ?>_CompanyName" id="fvworderoutgrid$x<?php echo $vworderout_grid->RowIndex ?>_CompanyName" value="<?php echo HtmlEncode($vworderout->CompanyName->FormValue) ?>">
<input type="hidden" data-table="vworderout" data-field="x_CompanyName" name="fvworderoutgrid$o<?php echo $vworderout_grid->RowIndex ?>_CompanyName" id="fvworderoutgrid$o<?php echo $vworderout_grid->RowIndex ?>_CompanyName" value="<?php echo HtmlEncode($vworderout->CompanyName->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($vworderout->ContactPhone->Visible) { // ContactPhone ?>
		<td data-name="ContactPhone"<?php echo $vworderout->ContactPhone->cellAttributes() ?>>
<?php if ($vworderout->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $vworderout_grid->RowCnt ?>_vworderout_ContactPhone" class="form-group vworderout_ContactPhone">
<input type="text" data-table="vworderout" data-field="x_ContactPhone" name="x<?php echo $vworderout_grid->RowIndex ?>_ContactPhone" id="x<?php echo $vworderout_grid->RowIndex ?>_ContactPhone" size="30" maxlength="50" placeholder="<?php echo HtmlEncode($vworderout->ContactPhone->getPlaceHolder()) ?>" value="<?php echo $vworderout->ContactPhone->EditValue ?>"<?php echo $vworderout->ContactPhone->editAttributes() ?>>
</span>
<input type="hidden" data-table="vworderout" data-field="x_ContactPhone" name="o<?php echo $vworderout_grid->RowIndex ?>_ContactPhone" id="o<?php echo $vworderout_grid->RowIndex ?>_ContactPhone" value="<?php echo HtmlEncode($vworderout->ContactPhone->OldValue) ?>">
<?php } ?>
<?php if ($vworderout->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $vworderout_grid->RowCnt ?>_vworderout_ContactPhone" class="form-group vworderout_ContactPhone">
<input type="text" data-table="vworderout" data-field="x_ContactPhone" name="x<?php echo $vworderout_grid->RowIndex ?>_ContactPhone" id="x<?php echo $vworderout_grid->RowIndex ?>_ContactPhone" size="30" maxlength="50" placeholder="<?php echo HtmlEncode($vworderout->ContactPhone->getPlaceHolder()) ?>" value="<?php echo $vworderout->ContactPhone->EditValue ?>"<?php echo $vworderout->ContactPhone->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($vworderout->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $vworderout_grid->RowCnt ?>_vworderout_ContactPhone" class="vworderout_ContactPhone">
<span<?php echo $vworderout->ContactPhone->viewAttributes() ?>>
<?php echo $vworderout->ContactPhone->getViewValue() ?></span>
</span>
<?php if (!$vworderout->isConfirm()) { ?>
<input type="hidden" data-table="vworderout" data-field="x_ContactPhone" name="x<?php echo $vworderout_grid->RowIndex ?>_ContactPhone" id="x<?php echo $vworderout_grid->RowIndex ?>_ContactPhone" value="<?php echo HtmlEncode($vworderout->ContactPhone->FormValue) ?>">
<input type="hidden" data-table="vworderout" data-field="x_ContactPhone" name="o<?php echo $vworderout_grid->RowIndex ?>_ContactPhone" id="o<?php echo $vworderout_grid->RowIndex ?>_ContactPhone" value="<?php echo HtmlEncode($vworderout->ContactPhone->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="vworderout" data-field="x_ContactPhone" name="fvworderoutgrid$x<?php echo $vworderout_grid->RowIndex ?>_ContactPhone" id="fvworderoutgrid$x<?php echo $vworderout_grid->RowIndex ?>_ContactPhone" value="<?php echo HtmlEncode($vworderout->ContactPhone->FormValue) ?>">
<input type="hidden" data-table="vworderout" data-field="x_ContactPhone" name="fvworderoutgrid$o<?php echo $vworderout_grid->RowIndex ?>_ContactPhone" id="fvworderoutgrid$o<?php echo $vworderout_grid->RowIndex ?>_ContactPhone" value="<?php echo HtmlEncode($vworderout->ContactPhone->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($vworderout->StatusFinishOrder->Visible) { // StatusFinishOrder ?>
		<td data-name="StatusFinishOrder"<?php echo $vworderout->StatusFinishOrder->cellAttributes() ?>>
<?php if ($vworderout->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $vworderout_grid->RowCnt ?>_vworderout_StatusFinishOrder" class="form-group vworderout_StatusFinishOrder">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="vworderout" data-field="x_StatusFinishOrder" data-value-separator="<?php echo $vworderout->StatusFinishOrder->displayValueSeparatorAttribute() ?>" id="x<?php echo $vworderout_grid->RowIndex ?>_StatusFinishOrder" name="x<?php echo $vworderout_grid->RowIndex ?>_StatusFinishOrder"<?php echo $vworderout->StatusFinishOrder->editAttributes() ?>>
		<?php echo $vworderout->StatusFinishOrder->selectOptionListHtml("x<?php echo $vworderout_grid->RowIndex ?>_StatusFinishOrder") ?>
	</select>
</div>
</span>
<input type="hidden" data-table="vworderout" data-field="x_StatusFinishOrder" name="o<?php echo $vworderout_grid->RowIndex ?>_StatusFinishOrder" id="o<?php echo $vworderout_grid->RowIndex ?>_StatusFinishOrder" value="<?php echo HtmlEncode($vworderout->StatusFinishOrder->OldValue) ?>">
<?php } ?>
<?php if ($vworderout->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $vworderout_grid->RowCnt ?>_vworderout_StatusFinishOrder" class="form-group vworderout_StatusFinishOrder">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="vworderout" data-field="x_StatusFinishOrder" data-value-separator="<?php echo $vworderout->StatusFinishOrder->displayValueSeparatorAttribute() ?>" id="x<?php echo $vworderout_grid->RowIndex ?>_StatusFinishOrder" name="x<?php echo $vworderout_grid->RowIndex ?>_StatusFinishOrder"<?php echo $vworderout->StatusFinishOrder->editAttributes() ?>>
		<?php echo $vworderout->StatusFinishOrder->selectOptionListHtml("x<?php echo $vworderout_grid->RowIndex ?>_StatusFinishOrder") ?>
	</select>
</div>
</span>
<?php } ?>
<?php if ($vworderout->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $vworderout_grid->RowCnt ?>_vworderout_StatusFinishOrder" class="vworderout_StatusFinishOrder">
<span<?php echo $vworderout->StatusFinishOrder->viewAttributes() ?>>
<?php echo $vworderout->StatusFinishOrder->getViewValue() ?></span>
</span>
<?php if (!$vworderout->isConfirm()) { ?>
<input type="hidden" data-table="vworderout" data-field="x_StatusFinishOrder" name="x<?php echo $vworderout_grid->RowIndex ?>_StatusFinishOrder" id="x<?php echo $vworderout_grid->RowIndex ?>_StatusFinishOrder" value="<?php echo HtmlEncode($vworderout->StatusFinishOrder->FormValue) ?>">
<input type="hidden" data-table="vworderout" data-field="x_StatusFinishOrder" name="o<?php echo $vworderout_grid->RowIndex ?>_StatusFinishOrder" id="o<?php echo $vworderout_grid->RowIndex ?>_StatusFinishOrder" value="<?php echo HtmlEncode($vworderout->StatusFinishOrder->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="vworderout" data-field="x_StatusFinishOrder" name="fvworderoutgrid$x<?php echo $vworderout_grid->RowIndex ?>_StatusFinishOrder" id="fvworderoutgrid$x<?php echo $vworderout_grid->RowIndex ?>_StatusFinishOrder" value="<?php echo HtmlEncode($vworderout->StatusFinishOrder->FormValue) ?>">
<input type="hidden" data-table="vworderout" data-field="x_StatusFinishOrder" name="fvworderoutgrid$o<?php echo $vworderout_grid->RowIndex ?>_StatusFinishOrder" id="fvworderoutgrid$o<?php echo $vworderout_grid->RowIndex ?>_StatusFinishOrder" value="<?php echo HtmlEncode($vworderout->StatusFinishOrder->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($vworderout->DateTimefinishOrder->Visible) { // DateTimefinishOrder ?>
		<td data-name="DateTimefinishOrder"<?php echo $vworderout->DateTimefinishOrder->cellAttributes() ?>>
<?php if ($vworderout->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $vworderout_grid->RowCnt ?>_vworderout_DateTimefinishOrder" class="form-group vworderout_DateTimefinishOrder">
<input type="text" data-table="vworderout" data-field="x_DateTimefinishOrder" data-format="11" name="x<?php echo $vworderout_grid->RowIndex ?>_DateTimefinishOrder" id="x<?php echo $vworderout_grid->RowIndex ?>_DateTimefinishOrder" placeholder="<?php echo HtmlEncode($vworderout->DateTimefinishOrder->getPlaceHolder()) ?>" value="<?php echo $vworderout->DateTimefinishOrder->EditValue ?>"<?php echo $vworderout->DateTimefinishOrder->editAttributes() ?>>
<?php if (!$vworderout->DateTimefinishOrder->ReadOnly && !$vworderout->DateTimefinishOrder->Disabled && !isset($vworderout->DateTimefinishOrder->EditAttrs["readonly"]) && !isset($vworderout->DateTimefinishOrder->EditAttrs["disabled"])) { ?>
<script>
ew.createDateTimePicker("fvworderoutgrid", "x<?php echo $vworderout_grid->RowIndex ?>_DateTimefinishOrder", {"ignoreReadonly":true,"useCurrent":false,"format":11});
</script>
<?php } ?>
</span>
<input type="hidden" data-table="vworderout" data-field="x_DateTimefinishOrder" name="o<?php echo $vworderout_grid->RowIndex ?>_DateTimefinishOrder" id="o<?php echo $vworderout_grid->RowIndex ?>_DateTimefinishOrder" value="<?php echo HtmlEncode($vworderout->DateTimefinishOrder->OldValue) ?>">
<?php } ?>
<?php if ($vworderout->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $vworderout_grid->RowCnt ?>_vworderout_DateTimefinishOrder" class="form-group vworderout_DateTimefinishOrder">
<input type="text" data-table="vworderout" data-field="x_DateTimefinishOrder" data-format="11" name="x<?php echo $vworderout_grid->RowIndex ?>_DateTimefinishOrder" id="x<?php echo $vworderout_grid->RowIndex ?>_DateTimefinishOrder" placeholder="<?php echo HtmlEncode($vworderout->DateTimefinishOrder->getPlaceHolder()) ?>" value="<?php echo $vworderout->DateTimefinishOrder->EditValue ?>"<?php echo $vworderout->DateTimefinishOrder->editAttributes() ?>>
<?php if (!$vworderout->DateTimefinishOrder->ReadOnly && !$vworderout->DateTimefinishOrder->Disabled && !isset($vworderout->DateTimefinishOrder->EditAttrs["readonly"]) && !isset($vworderout->DateTimefinishOrder->EditAttrs["disabled"])) { ?>
<script>
ew.createDateTimePicker("fvworderoutgrid", "x<?php echo $vworderout_grid->RowIndex ?>_DateTimefinishOrder", {"ignoreReadonly":true,"useCurrent":false,"format":11});
</script>
<?php } ?>
</span>
<?php } ?>
<?php if ($vworderout->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $vworderout_grid->RowCnt ?>_vworderout_DateTimefinishOrder" class="vworderout_DateTimefinishOrder">
<span<?php echo $vworderout->DateTimefinishOrder->viewAttributes() ?>>
<?php echo $vworderout->DateTimefinishOrder->getViewValue() ?></span>
</span>
<?php if (!$vworderout->isConfirm()) { ?>
<input type="hidden" data-table="vworderout" data-field="x_DateTimefinishOrder" name="x<?php echo $vworderout_grid->RowIndex ?>_DateTimefinishOrder" id="x<?php echo $vworderout_grid->RowIndex ?>_DateTimefinishOrder" value="<?php echo HtmlEncode($vworderout->DateTimefinishOrder->FormValue) ?>">
<input type="hidden" data-table="vworderout" data-field="x_DateTimefinishOrder" name="o<?php echo $vworderout_grid->RowIndex ?>_DateTimefinishOrder" id="o<?php echo $vworderout_grid->RowIndex ?>_DateTimefinishOrder" value="<?php echo HtmlEncode($vworderout->DateTimefinishOrder->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="vworderout" data-field="x_DateTimefinishOrder" name="fvworderoutgrid$x<?php echo $vworderout_grid->RowIndex ?>_DateTimefinishOrder" id="fvworderoutgrid$x<?php echo $vworderout_grid->RowIndex ?>_DateTimefinishOrder" value="<?php echo HtmlEncode($vworderout->DateTimefinishOrder->FormValue) ?>">
<input type="hidden" data-table="vworderout" data-field="x_DateTimefinishOrder" name="fvworderoutgrid$o<?php echo $vworderout_grid->RowIndex ?>_DateTimefinishOrder" id="fvworderoutgrid$o<?php echo $vworderout_grid->RowIndex ?>_DateTimefinishOrder" value="<?php echo HtmlEncode($vworderout->DateTimefinishOrder->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($vworderout->UserFinishOrder->Visible) { // UserFinishOrder ?>
		<td data-name="UserFinishOrder"<?php echo $vworderout->UserFinishOrder->cellAttributes() ?>>
<?php if ($vworderout->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $vworderout_grid->RowCnt ?>_vworderout_UserFinishOrder" class="form-group vworderout_UserFinishOrder">
<input type="text" data-table="vworderout" data-field="x_UserFinishOrder" name="x<?php echo $vworderout_grid->RowIndex ?>_UserFinishOrder" id="x<?php echo $vworderout_grid->RowIndex ?>_UserFinishOrder" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($vworderout->UserFinishOrder->getPlaceHolder()) ?>" value="<?php echo $vworderout->UserFinishOrder->EditValue ?>"<?php echo $vworderout->UserFinishOrder->editAttributes() ?>>
</span>
<input type="hidden" data-table="vworderout" data-field="x_UserFinishOrder" name="o<?php echo $vworderout_grid->RowIndex ?>_UserFinishOrder" id="o<?php echo $vworderout_grid->RowIndex ?>_UserFinishOrder" value="<?php echo HtmlEncode($vworderout->UserFinishOrder->OldValue) ?>">
<?php } ?>
<?php if ($vworderout->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $vworderout_grid->RowCnt ?>_vworderout_UserFinishOrder" class="form-group vworderout_UserFinishOrder">
<input type="text" data-table="vworderout" data-field="x_UserFinishOrder" name="x<?php echo $vworderout_grid->RowIndex ?>_UserFinishOrder" id="x<?php echo $vworderout_grid->RowIndex ?>_UserFinishOrder" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($vworderout->UserFinishOrder->getPlaceHolder()) ?>" value="<?php echo $vworderout->UserFinishOrder->EditValue ?>"<?php echo $vworderout->UserFinishOrder->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($vworderout->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $vworderout_grid->RowCnt ?>_vworderout_UserFinishOrder" class="vworderout_UserFinishOrder">
<span<?php echo $vworderout->UserFinishOrder->viewAttributes() ?>>
<?php echo $vworderout->UserFinishOrder->getViewValue() ?></span>
</span>
<?php if (!$vworderout->isConfirm()) { ?>
<input type="hidden" data-table="vworderout" data-field="x_UserFinishOrder" name="x<?php echo $vworderout_grid->RowIndex ?>_UserFinishOrder" id="x<?php echo $vworderout_grid->RowIndex ?>_UserFinishOrder" value="<?php echo HtmlEncode($vworderout->UserFinishOrder->FormValue) ?>">
<input type="hidden" data-table="vworderout" data-field="x_UserFinishOrder" name="o<?php echo $vworderout_grid->RowIndex ?>_UserFinishOrder" id="o<?php echo $vworderout_grid->RowIndex ?>_UserFinishOrder" value="<?php echo HtmlEncode($vworderout->UserFinishOrder->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="vworderout" data-field="x_UserFinishOrder" name="fvworderoutgrid$x<?php echo $vworderout_grid->RowIndex ?>_UserFinishOrder" id="fvworderoutgrid$x<?php echo $vworderout_grid->RowIndex ?>_UserFinishOrder" value="<?php echo HtmlEncode($vworderout->UserFinishOrder->FormValue) ?>">
<input type="hidden" data-table="vworderout" data-field="x_UserFinishOrder" name="fvworderoutgrid$o<?php echo $vworderout_grid->RowIndex ?>_UserFinishOrder" id="fvworderoutgrid$o<?php echo $vworderout_grid->RowIndex ?>_UserFinishOrder" value="<?php echo HtmlEncode($vworderout->UserFinishOrder->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$vworderout_grid->ListOptions->render("body", "right", $vworderout_grid->RowCnt);
?>
	</tr>
<?php if ($vworderout->RowType == ROWTYPE_ADD || $vworderout->RowType == ROWTYPE_EDIT) { ?>
<script>
fvworderoutgrid.updateLists(<?php echo $vworderout_grid->RowIndex ?>);
</script>
<?php } ?>
<?php
	}
	} // End delete row checking
	if (!$vworderout->isGridAdd() || $vworderout->CurrentMode == "copy")
		if (!$vworderout_grid->Recordset->EOF)
			$vworderout_grid->Recordset->moveNext();
}
?>
<?php
	if ($vworderout->CurrentMode == "add" || $vworderout->CurrentMode == "copy" || $vworderout->CurrentMode == "edit") {
		$vworderout_grid->RowIndex = '$rowindex$';
		$vworderout_grid->loadRowValues();

		// Set row properties
		$vworderout->resetAttributes();
		$vworderout->RowAttrs = array_merge($vworderout->RowAttrs, array('data-rowindex'=>$vworderout_grid->RowIndex, 'id'=>'r0_vworderout', 'data-rowtype'=>ROWTYPE_ADD));
		AppendClass($vworderout->RowAttrs["class"], "ew-template");
		$vworderout->RowType = ROWTYPE_ADD;

		// Render row
		$vworderout_grid->renderRow();

		// Render list options
		$vworderout_grid->renderListOptions();
		$vworderout_grid->StartRowCnt = 0;
?>
	<tr<?php echo $vworderout->rowAttributes() ?>>
<?php

// Render list options (body, left)
$vworderout_grid->ListOptions->render("body", "left", $vworderout_grid->RowIndex);
?>
	<?php if ($vworderout->ID_Order->Visible) { // ID_Order ?>
		<td data-name="ID_Order">
<?php if (!$vworderout->isConfirm()) { ?>
<?php } else { ?>
<span id="el$rowindex$_vworderout_ID_Order" class="form-group vworderout_ID_Order">
<span<?php echo $vworderout->ID_Order->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?php echo RemoveHtml($vworderout->ID_Order->ViewValue) ?>"></span>
</span>
<input type="hidden" data-table="vworderout" data-field="x_ID_Order" name="x<?php echo $vworderout_grid->RowIndex ?>_ID_Order" id="x<?php echo $vworderout_grid->RowIndex ?>_ID_Order" value="<?php echo HtmlEncode($vworderout->ID_Order->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="vworderout" data-field="x_ID_Order" name="o<?php echo $vworderout_grid->RowIndex ?>_ID_Order" id="o<?php echo $vworderout_grid->RowIndex ?>_ID_Order" value="<?php echo HtmlEncode($vworderout->ID_Order->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($vworderout->Code->Visible) { // Code ?>
		<td data-name="Code">
<?php if (!$vworderout->isConfirm()) { ?>
<span id="el$rowindex$_vworderout_Code" class="form-group vworderout_Code">
<input type="text" data-table="vworderout" data-field="x_Code" name="x<?php echo $vworderout_grid->RowIndex ?>_Code" id="x<?php echo $vworderout_grid->RowIndex ?>_Code" size="30" maxlength="50" placeholder="<?php echo HtmlEncode($vworderout->Code->getPlaceHolder()) ?>" value="<?php echo $vworderout->Code->EditValue ?>"<?php echo $vworderout->Code->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_vworderout_Code" class="form-group vworderout_Code">
<span<?php echo $vworderout->Code->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?php echo RemoveHtml($vworderout->Code->ViewValue) ?>"></span>
</span>
<input type="hidden" data-table="vworderout" data-field="x_Code" name="x<?php echo $vworderout_grid->RowIndex ?>_Code" id="x<?php echo $vworderout_grid->RowIndex ?>_Code" value="<?php echo HtmlEncode($vworderout->Code->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="vworderout" data-field="x_Code" name="o<?php echo $vworderout_grid->RowIndex ?>_Code" id="o<?php echo $vworderout_grid->RowIndex ?>_Code" value="<?php echo HtmlEncode($vworderout->Code->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($vworderout->PCS->Visible) { // PCS ?>
		<td data-name="PCS">
<?php if (!$vworderout->isConfirm()) { ?>
<span id="el$rowindex$_vworderout_PCS" class="form-group vworderout_PCS">
<input type="text" data-table="vworderout" data-field="x_PCS" name="x<?php echo $vworderout_grid->RowIndex ?>_PCS" id="x<?php echo $vworderout_grid->RowIndex ?>_PCS" size="30" placeholder="<?php echo HtmlEncode($vworderout->PCS->getPlaceHolder()) ?>" value="<?php echo $vworderout->PCS->EditValue ?>"<?php echo $vworderout->PCS->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_vworderout_PCS" class="form-group vworderout_PCS">
<span<?php echo $vworderout->PCS->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?php echo RemoveHtml($vworderout->PCS->ViewValue) ?>"></span>
</span>
<input type="hidden" data-table="vworderout" data-field="x_PCS" name="x<?php echo $vworderout_grid->RowIndex ?>_PCS" id="x<?php echo $vworderout_grid->RowIndex ?>_PCS" value="<?php echo HtmlEncode($vworderout->PCS->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="vworderout" data-field="x_PCS" name="o<?php echo $vworderout_grid->RowIndex ?>_PCS" id="o<?php echo $vworderout_grid->RowIndex ?>_PCS" value="<?php echo HtmlEncode($vworderout->PCS->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($vworderout->OrderDate->Visible) { // OrderDate ?>
		<td data-name="OrderDate">
<?php if (!$vworderout->isConfirm()) { ?>
<span id="el$rowindex$_vworderout_OrderDate" class="form-group vworderout_OrderDate">
<input type="text" data-table="vworderout" data-field="x_OrderDate" data-format="7" name="x<?php echo $vworderout_grid->RowIndex ?>_OrderDate" id="x<?php echo $vworderout_grid->RowIndex ?>_OrderDate" placeholder="<?php echo HtmlEncode($vworderout->OrderDate->getPlaceHolder()) ?>" value="<?php echo $vworderout->OrderDate->EditValue ?>"<?php echo $vworderout->OrderDate->editAttributes() ?>>
<?php if (!$vworderout->OrderDate->ReadOnly && !$vworderout->OrderDate->Disabled && !isset($vworderout->OrderDate->EditAttrs["readonly"]) && !isset($vworderout->OrderDate->EditAttrs["disabled"])) { ?>
<script>
ew.createDateTimePicker("fvworderoutgrid", "x<?php echo $vworderout_grid->RowIndex ?>_OrderDate", {"ignoreReadonly":true,"useCurrent":false,"format":7});
</script>
<?php } ?>
</span>
<?php } else { ?>
<span id="el$rowindex$_vworderout_OrderDate" class="form-group vworderout_OrderDate">
<span<?php echo $vworderout->OrderDate->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?php echo RemoveHtml($vworderout->OrderDate->ViewValue) ?>"></span>
</span>
<input type="hidden" data-table="vworderout" data-field="x_OrderDate" name="x<?php echo $vworderout_grid->RowIndex ?>_OrderDate" id="x<?php echo $vworderout_grid->RowIndex ?>_OrderDate" value="<?php echo HtmlEncode($vworderout->OrderDate->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="vworderout" data-field="x_OrderDate" name="o<?php echo $vworderout_grid->RowIndex ?>_OrderDate" id="o<?php echo $vworderout_grid->RowIndex ?>_OrderDate" value="<?php echo HtmlEncode($vworderout->OrderDate->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($vworderout->ContactName->Visible) { // ContactName ?>
		<td data-name="ContactName">
<?php if (!$vworderout->isConfirm()) { ?>
<span id="el$rowindex$_vworderout_ContactName" class="form-group vworderout_ContactName">
<input type="text" data-table="vworderout" data-field="x_ContactName" name="x<?php echo $vworderout_grid->RowIndex ?>_ContactName" id="x<?php echo $vworderout_grid->RowIndex ?>_ContactName" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($vworderout->ContactName->getPlaceHolder()) ?>" value="<?php echo $vworderout->ContactName->EditValue ?>"<?php echo $vworderout->ContactName->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_vworderout_ContactName" class="form-group vworderout_ContactName">
<span<?php echo $vworderout->ContactName->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?php echo RemoveHtml($vworderout->ContactName->ViewValue) ?>"></span>
</span>
<input type="hidden" data-table="vworderout" data-field="x_ContactName" name="x<?php echo $vworderout_grid->RowIndex ?>_ContactName" id="x<?php echo $vworderout_grid->RowIndex ?>_ContactName" value="<?php echo HtmlEncode($vworderout->ContactName->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="vworderout" data-field="x_ContactName" name="o<?php echo $vworderout_grid->RowIndex ?>_ContactName" id="o<?php echo $vworderout_grid->RowIndex ?>_ContactName" value="<?php echo HtmlEncode($vworderout->ContactName->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($vworderout->CompanyName->Visible) { // CompanyName ?>
		<td data-name="CompanyName">
<?php if (!$vworderout->isConfirm()) { ?>
<span id="el$rowindex$_vworderout_CompanyName" class="form-group vworderout_CompanyName">
<input type="text" data-table="vworderout" data-field="x_CompanyName" name="x<?php echo $vworderout_grid->RowIndex ?>_CompanyName" id="x<?php echo $vworderout_grid->RowIndex ?>_CompanyName" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($vworderout->CompanyName->getPlaceHolder()) ?>" value="<?php echo $vworderout->CompanyName->EditValue ?>"<?php echo $vworderout->CompanyName->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_vworderout_CompanyName" class="form-group vworderout_CompanyName">
<span<?php echo $vworderout->CompanyName->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?php echo RemoveHtml($vworderout->CompanyName->ViewValue) ?>"></span>
</span>
<input type="hidden" data-table="vworderout" data-field="x_CompanyName" name="x<?php echo $vworderout_grid->RowIndex ?>_CompanyName" id="x<?php echo $vworderout_grid->RowIndex ?>_CompanyName" value="<?php echo HtmlEncode($vworderout->CompanyName->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="vworderout" data-field="x_CompanyName" name="o<?php echo $vworderout_grid->RowIndex ?>_CompanyName" id="o<?php echo $vworderout_grid->RowIndex ?>_CompanyName" value="<?php echo HtmlEncode($vworderout->CompanyName->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($vworderout->ContactPhone->Visible) { // ContactPhone ?>
		<td data-name="ContactPhone">
<?php if (!$vworderout->isConfirm()) { ?>
<span id="el$rowindex$_vworderout_ContactPhone" class="form-group vworderout_ContactPhone">
<input type="text" data-table="vworderout" data-field="x_ContactPhone" name="x<?php echo $vworderout_grid->RowIndex ?>_ContactPhone" id="x<?php echo $vworderout_grid->RowIndex ?>_ContactPhone" size="30" maxlength="50" placeholder="<?php echo HtmlEncode($vworderout->ContactPhone->getPlaceHolder()) ?>" value="<?php echo $vworderout->ContactPhone->EditValue ?>"<?php echo $vworderout->ContactPhone->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_vworderout_ContactPhone" class="form-group vworderout_ContactPhone">
<span<?php echo $vworderout->ContactPhone->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?php echo RemoveHtml($vworderout->ContactPhone->ViewValue) ?>"></span>
</span>
<input type="hidden" data-table="vworderout" data-field="x_ContactPhone" name="x<?php echo $vworderout_grid->RowIndex ?>_ContactPhone" id="x<?php echo $vworderout_grid->RowIndex ?>_ContactPhone" value="<?php echo HtmlEncode($vworderout->ContactPhone->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="vworderout" data-field="x_ContactPhone" name="o<?php echo $vworderout_grid->RowIndex ?>_ContactPhone" id="o<?php echo $vworderout_grid->RowIndex ?>_ContactPhone" value="<?php echo HtmlEncode($vworderout->ContactPhone->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($vworderout->StatusFinishOrder->Visible) { // StatusFinishOrder ?>
		<td data-name="StatusFinishOrder">
<?php if (!$vworderout->isConfirm()) { ?>
<span id="el$rowindex$_vworderout_StatusFinishOrder" class="form-group vworderout_StatusFinishOrder">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="vworderout" data-field="x_StatusFinishOrder" data-value-separator="<?php echo $vworderout->StatusFinishOrder->displayValueSeparatorAttribute() ?>" id="x<?php echo $vworderout_grid->RowIndex ?>_StatusFinishOrder" name="x<?php echo $vworderout_grid->RowIndex ?>_StatusFinishOrder"<?php echo $vworderout->StatusFinishOrder->editAttributes() ?>>
		<?php echo $vworderout->StatusFinishOrder->selectOptionListHtml("x<?php echo $vworderout_grid->RowIndex ?>_StatusFinishOrder") ?>
	</select>
</div>
</span>
<?php } else { ?>
<span id="el$rowindex$_vworderout_StatusFinishOrder" class="form-group vworderout_StatusFinishOrder">
<span<?php echo $vworderout->StatusFinishOrder->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?php echo RemoveHtml($vworderout->StatusFinishOrder->ViewValue) ?>"></span>
</span>
<input type="hidden" data-table="vworderout" data-field="x_StatusFinishOrder" name="x<?php echo $vworderout_grid->RowIndex ?>_StatusFinishOrder" id="x<?php echo $vworderout_grid->RowIndex ?>_StatusFinishOrder" value="<?php echo HtmlEncode($vworderout->StatusFinishOrder->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="vworderout" data-field="x_StatusFinishOrder" name="o<?php echo $vworderout_grid->RowIndex ?>_StatusFinishOrder" id="o<?php echo $vworderout_grid->RowIndex ?>_StatusFinishOrder" value="<?php echo HtmlEncode($vworderout->StatusFinishOrder->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($vworderout->DateTimefinishOrder->Visible) { // DateTimefinishOrder ?>
		<td data-name="DateTimefinishOrder">
<?php if (!$vworderout->isConfirm()) { ?>
<span id="el$rowindex$_vworderout_DateTimefinishOrder" class="form-group vworderout_DateTimefinishOrder">
<input type="text" data-table="vworderout" data-field="x_DateTimefinishOrder" data-format="11" name="x<?php echo $vworderout_grid->RowIndex ?>_DateTimefinishOrder" id="x<?php echo $vworderout_grid->RowIndex ?>_DateTimefinishOrder" placeholder="<?php echo HtmlEncode($vworderout->DateTimefinishOrder->getPlaceHolder()) ?>" value="<?php echo $vworderout->DateTimefinishOrder->EditValue ?>"<?php echo $vworderout->DateTimefinishOrder->editAttributes() ?>>
<?php if (!$vworderout->DateTimefinishOrder->ReadOnly && !$vworderout->DateTimefinishOrder->Disabled && !isset($vworderout->DateTimefinishOrder->EditAttrs["readonly"]) && !isset($vworderout->DateTimefinishOrder->EditAttrs["disabled"])) { ?>
<script>
ew.createDateTimePicker("fvworderoutgrid", "x<?php echo $vworderout_grid->RowIndex ?>_DateTimefinishOrder", {"ignoreReadonly":true,"useCurrent":false,"format":11});
</script>
<?php } ?>
</span>
<?php } else { ?>
<span id="el$rowindex$_vworderout_DateTimefinishOrder" class="form-group vworderout_DateTimefinishOrder">
<span<?php echo $vworderout->DateTimefinishOrder->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?php echo RemoveHtml($vworderout->DateTimefinishOrder->ViewValue) ?>"></span>
</span>
<input type="hidden" data-table="vworderout" data-field="x_DateTimefinishOrder" name="x<?php echo $vworderout_grid->RowIndex ?>_DateTimefinishOrder" id="x<?php echo $vworderout_grid->RowIndex ?>_DateTimefinishOrder" value="<?php echo HtmlEncode($vworderout->DateTimefinishOrder->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="vworderout" data-field="x_DateTimefinishOrder" name="o<?php echo $vworderout_grid->RowIndex ?>_DateTimefinishOrder" id="o<?php echo $vworderout_grid->RowIndex ?>_DateTimefinishOrder" value="<?php echo HtmlEncode($vworderout->DateTimefinishOrder->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($vworderout->UserFinishOrder->Visible) { // UserFinishOrder ?>
		<td data-name="UserFinishOrder">
<?php if (!$vworderout->isConfirm()) { ?>
<span id="el$rowindex$_vworderout_UserFinishOrder" class="form-group vworderout_UserFinishOrder">
<input type="text" data-table="vworderout" data-field="x_UserFinishOrder" name="x<?php echo $vworderout_grid->RowIndex ?>_UserFinishOrder" id="x<?php echo $vworderout_grid->RowIndex ?>_UserFinishOrder" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($vworderout->UserFinishOrder->getPlaceHolder()) ?>" value="<?php echo $vworderout->UserFinishOrder->EditValue ?>"<?php echo $vworderout->UserFinishOrder->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_vworderout_UserFinishOrder" class="form-group vworderout_UserFinishOrder">
<span<?php echo $vworderout->UserFinishOrder->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?php echo RemoveHtml($vworderout->UserFinishOrder->ViewValue) ?>"></span>
</span>
<input type="hidden" data-table="vworderout" data-field="x_UserFinishOrder" name="x<?php echo $vworderout_grid->RowIndex ?>_UserFinishOrder" id="x<?php echo $vworderout_grid->RowIndex ?>_UserFinishOrder" value="<?php echo HtmlEncode($vworderout->UserFinishOrder->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="vworderout" data-field="x_UserFinishOrder" name="o<?php echo $vworderout_grid->RowIndex ?>_UserFinishOrder" id="o<?php echo $vworderout_grid->RowIndex ?>_UserFinishOrder" value="<?php echo HtmlEncode($vworderout->UserFinishOrder->OldValue) ?>">
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$vworderout_grid->ListOptions->render("body", "right", $vworderout_grid->RowIndex);
?>
<script>
fvworderoutgrid.updateLists(<?php echo $vworderout_grid->RowIndex ?>);
</script>
	</tr>
<?php
}
?>
</tbody>
</table><!-- /.ew-table -->
<?php if ($vworderout->CurrentMode == "add" || $vworderout->CurrentMode == "copy") { ?>
<input type="hidden" name="<?php echo $vworderout_grid->FormKeyCountName ?>" id="<?php echo $vworderout_grid->FormKeyCountName ?>" value="<?php echo $vworderout_grid->KeyCount ?>">
<?php echo $vworderout_grid->MultiSelectKey ?>
<?php } ?>
<?php if ($vworderout->CurrentMode == "edit") { ?>
<input type="hidden" name="<?php echo $vworderout_grid->FormKeyCountName ?>" id="<?php echo $vworderout_grid->FormKeyCountName ?>" value="<?php echo $vworderout_grid->KeyCount ?>">
<?php echo $vworderout_grid->MultiSelectKey ?>
<?php } ?>
<?php if ($vworderout->CurrentMode == "") { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
<input type="hidden" name="detailpage" value="fvworderoutgrid">
</div><!-- /.ew-grid-middle-panel -->
<?php

// Close recordset
if ($vworderout_grid->Recordset)
	$vworderout_grid->Recordset->Close();
?>
</div>
<?php if ($vworderout_grid->ShowOtherOptions) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php $vworderout_grid->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($vworderout_grid->TotalRecs == 0 && !$vworderout->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $vworderout_grid->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$vworderout_grid->terminate();
?>