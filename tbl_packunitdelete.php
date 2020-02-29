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
$tbl_packunit_delete = new tbl_packunit_delete();

// Run the page
$tbl_packunit_delete->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$tbl_packunit_delete->Page_Render();
?>
<?php include_once "header.php" ?>
<script>

// Form object
currentPageID = ew.PAGE_ID = "delete";
var ftbl_packunitdelete = currentForm = new ew.Form("ftbl_packunitdelete", "delete");

// Form_CustomValidate event
ftbl_packunitdelete.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

	// Your custom validation code here, return false if invalid.
	return true;
}

// Use JavaScript validation or not
ftbl_packunitdelete.validateRequired = <?php echo json_encode(CLIENT_VALIDATE) ?>;

// Dynamic selection lists
ftbl_packunitdelete.lists["x_idUnit"] = <?php echo $tbl_packunit_delete->idUnit->Lookup->toClientList() ?>;
ftbl_packunitdelete.lists["x_idUnit"].options = <?php echo JsonEncode($tbl_packunit_delete->idUnit->lookupOptions()) ?>;

// Form object for search
</script>
<script>

// Write your client script here, no need to add script tags.
</script>
<?php $tbl_packunit_delete->showPageHeader(); ?>
<?php
$tbl_packunit_delete->showMessage();
?>
<form name="ftbl_packunitdelete" id="ftbl_packunitdelete" class="form-inline ew-form ew-delete-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($tbl_packunit_delete->CheckToken) { ?>
<input type="hidden" name="<?php echo TOKEN_NAME ?>" value="<?php echo $tbl_packunit_delete->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="tbl_packunit">
<input type="hidden" name="action" id="action" value="delete">
<?php foreach ($tbl_packunit_delete->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode($COMPOSITE_KEY_SEPARATOR, $key) : $key; ?>
<input type="hidden" name="key_m[]" value="<?php echo HtmlEncode($keyvalue) ?>">
<?php } ?>
<div class="card ew-card ew-grid">
<div class="<?php if (IsResponsiveLayout()) { ?>table-responsive <?php } ?>card-body ew-grid-middle-panel">
<table class="table ew-table">
	<thead>
	<tr class="ew-table-header">
<?php if ($tbl_packunit->packNo->Visible) { // packNo ?>
		<th class="<?php echo $tbl_packunit->packNo->headerCellClass() ?>"><span id="elh_tbl_packunit_packNo" class="tbl_packunit_packNo"><?php echo $tbl_packunit->packNo->caption() ?></span></th>
<?php } ?>
<?php if ($tbl_packunit->idUnit->Visible) { // idUnit ?>
		<th class="<?php echo $tbl_packunit->idUnit->headerCellClass() ?>"><span id="elh_tbl_packunit_idUnit" class="tbl_packunit_idUnit"><?php echo $tbl_packunit->idUnit->caption() ?></span></th>
<?php } ?>
	</tr>
	</thead>
	<tbody>
<?php
$tbl_packunit_delete->RecCnt = 0;
$i = 0;
while (!$tbl_packunit_delete->Recordset->EOF) {
	$tbl_packunit_delete->RecCnt++;
	$tbl_packunit_delete->RowCnt++;

	// Set row properties
	$tbl_packunit->resetAttributes();
	$tbl_packunit->RowType = ROWTYPE_VIEW; // View

	// Get the field contents
	$tbl_packunit_delete->loadRowValues($tbl_packunit_delete->Recordset);

	// Render row
	$tbl_packunit_delete->renderRow();
?>
	<tr<?php echo $tbl_packunit->rowAttributes() ?>>
<?php if ($tbl_packunit->packNo->Visible) { // packNo ?>
		<td<?php echo $tbl_packunit->packNo->cellAttributes() ?>>
<span id="el<?php echo $tbl_packunit_delete->RowCnt ?>_tbl_packunit_packNo" class="tbl_packunit_packNo">
<span<?php echo $tbl_packunit->packNo->viewAttributes() ?>>
<?php echo $tbl_packunit->packNo->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($tbl_packunit->idUnit->Visible) { // idUnit ?>
		<td<?php echo $tbl_packunit->idUnit->cellAttributes() ?>>
<span id="el<?php echo $tbl_packunit_delete->RowCnt ?>_tbl_packunit_idUnit" class="tbl_packunit_idUnit">
<span<?php echo $tbl_packunit->idUnit->viewAttributes() ?>>
<?php echo $tbl_packunit->idUnit->getViewValue() ?></span>
</span>
</td>
<?php } ?>
	</tr>
<?php
	$tbl_packunit_delete->Recordset->moveNext();
}
$tbl_packunit_delete->Recordset->close();
?>
</tbody>
</table>
</div>
</div>
<div>
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("DeleteBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $tbl_packunit_delete->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
</div>
</form>
<?php
$tbl_packunit_delete->showPageFooter();
if (DEBUG_ENABLED)
	echo GetDebugMessage();
?>
<script>

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php include_once "footer.php" ?>
<?php
$tbl_packunit_delete->terminate();
?>