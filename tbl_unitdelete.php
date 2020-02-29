<?php
namespace PHPMaker2019\asgbn_wh;

// Session
if (session_status() !== PHP_SESSION_ACTIVE)
	session_start(); // Init session data

// Output buffering
ob_start(); 

// Autoload
include_once "autoload.php";
?>
<?php

// Write header
WriteHeader(FALSE);

// Create page object
$tbl_unit_delete = new tbl_unit_delete();

// Run the page
$tbl_unit_delete->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$tbl_unit_delete->Page_Render();
?>
<?php include_once "header.php" ?>
<script>

// Form object
currentPageID = ew.PAGE_ID = "delete";
var ftbl_unitdelete = currentForm = new ew.Form("ftbl_unitdelete", "delete");

// Form_CustomValidate event
ftbl_unitdelete.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

	// Your custom validation code here, return false if invalid.
	return true;
}

// Use JavaScript validation or not
ftbl_unitdelete.validateRequired = <?php echo json_encode(CLIENT_VALIDATE) ?>;

// Dynamic selection lists
// Form object for search

</script>
<script>

// Write your client script here, no need to add script tags.
</script>
<?php $tbl_unit_delete->showPageHeader(); ?>
<?php
$tbl_unit_delete->showMessage();
?>
<form name="ftbl_unitdelete" id="ftbl_unitdelete" class="form-inline ew-form ew-delete-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($tbl_unit_delete->CheckToken) { ?>
<input type="hidden" name="<?php echo TOKEN_NAME ?>" value="<?php echo $tbl_unit_delete->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="tbl_unit">
<input type="hidden" name="action" id="action" value="delete">
<?php foreach ($tbl_unit_delete->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode($COMPOSITE_KEY_SEPARATOR, $key) : $key; ?>
<input type="hidden" name="key_m[]" value="<?php echo HtmlEncode($keyvalue) ?>">
<?php } ?>
<div class="card ew-card ew-grid">
<div class="<?php if (IsResponsiveLayout()) { ?>table-responsive <?php } ?>card-body ew-grid-middle-panel">
<table class="table ew-table">
	<thead>
	<tr class="ew-table-header">
<?php if ($tbl_unit->idUnit->Visible) { // idUnit ?>
		<th class="<?php echo $tbl_unit->idUnit->headerCellClass() ?>"><span id="elh_tbl_unit_idUnit" class="tbl_unit_idUnit"><?php echo $tbl_unit->idUnit->caption() ?></span></th>
<?php } ?>
<?php if ($tbl_unit->UnitName->Visible) { // UnitName ?>
		<th class="<?php echo $tbl_unit->UnitName->headerCellClass() ?>"><span id="elh_tbl_unit_UnitName" class="tbl_unit_UnitName"><?php echo $tbl_unit->UnitName->caption() ?></span></th>
<?php } ?>
	</tr>
	</thead>
	<tbody>
<?php
$tbl_unit_delete->RecCnt = 0;
$i = 0;
while (!$tbl_unit_delete->Recordset->EOF) {
	$tbl_unit_delete->RecCnt++;
	$tbl_unit_delete->RowCnt++;

	// Set row properties
	$tbl_unit->resetAttributes();
	$tbl_unit->RowType = ROWTYPE_VIEW; // View

	// Get the field contents
	$tbl_unit_delete->loadRowValues($tbl_unit_delete->Recordset);

	// Render row
	$tbl_unit_delete->renderRow();
?>
	<tr<?php echo $tbl_unit->rowAttributes() ?>>
<?php if ($tbl_unit->idUnit->Visible) { // idUnit ?>
		<td<?php echo $tbl_unit->idUnit->cellAttributes() ?>>
<span id="el<?php echo $tbl_unit_delete->RowCnt ?>_tbl_unit_idUnit" class="tbl_unit_idUnit">
<span<?php echo $tbl_unit->idUnit->viewAttributes() ?>>
<?php echo $tbl_unit->idUnit->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($tbl_unit->UnitName->Visible) { // UnitName ?>
		<td<?php echo $tbl_unit->UnitName->cellAttributes() ?>>
<span id="el<?php echo $tbl_unit_delete->RowCnt ?>_tbl_unit_UnitName" class="tbl_unit_UnitName">
<span<?php echo $tbl_unit->UnitName->viewAttributes() ?>>
<?php echo $tbl_unit->UnitName->getViewValue() ?></span>
</span>
</td>
<?php } ?>
	</tr>
<?php
	$tbl_unit_delete->Recordset->moveNext();
}
$tbl_unit_delete->Recordset->close();
?>
</tbody>
</table>
</div>
</div>
<div>
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("DeleteBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $tbl_unit_delete->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
</div>
</form>
<?php
$tbl_unit_delete->showPageFooter();
if (DEBUG_ENABLED)
	echo GetDebugMessage();
?>
<script>

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php include_once "footer.php" ?>
<?php
$tbl_unit_delete->terminate();
?>