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
$tbl_history_delete = new tbl_history_delete();

// Run the page
$tbl_history_delete->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$tbl_history_delete->Page_Render();
?>
<?php include_once "header.php" ?>
<script>

// Form object
currentPageID = ew.PAGE_ID = "delete";
var ftbl_historydelete = currentForm = new ew.Form("ftbl_historydelete", "delete");

// Form_CustomValidate event
ftbl_historydelete.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

	// Your custom validation code here, return false if invalid.
	return true;
}

// Use JavaScript validation or not
ftbl_historydelete.validateRequired = <?php echo json_encode(CLIENT_VALIDATE) ?>;

// Dynamic selection lists
// Form object for search

</script>
<script>

// Write your client script here, no need to add script tags.
</script>
<?php $tbl_history_delete->showPageHeader(); ?>
<?php
$tbl_history_delete->showMessage();
?>
<form name="ftbl_historydelete" id="ftbl_historydelete" class="form-inline ew-form ew-delete-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($tbl_history_delete->CheckToken) { ?>
<input type="hidden" name="<?php echo TOKEN_NAME ?>" value="<?php echo $tbl_history_delete->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="tbl_history">
<input type="hidden" name="action" id="action" value="delete">
<?php foreach ($tbl_history_delete->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode($COMPOSITE_KEY_SEPARATOR, $key) : $key; ?>
<input type="hidden" name="key_m[]" value="<?php echo HtmlEncode($keyvalue) ?>">
<?php } ?>
<div class="card ew-card ew-grid">
<div class="<?php if (IsResponsiveLayout()) { ?>table-responsive <?php } ?>card-body ew-grid-middle-panel">
<table class="table ew-table">
	<thead>
	<tr class="ew-table-header">
<?php if ($tbl_history->ID_His->Visible) { // ID_His ?>
		<th class="<?php echo $tbl_history->ID_His->headerCellClass() ?>"><span id="elh_tbl_history_ID_His" class="tbl_history_ID_His"><?php echo $tbl_history->ID_His->caption() ?></span></th>
<?php } ?>
<?php if ($tbl_history->PalletID->Visible) { // PalletID ?>
		<th class="<?php echo $tbl_history->PalletID->headerCellClass() ?>"><span id="elh_tbl_history_PalletID" class="tbl_history_PalletID"><?php echo $tbl_history->PalletID->caption() ?></span></th>
<?php } ?>
<?php if ($tbl_history->ID_Location->Visible) { // ID_Location ?>
		<th class="<?php echo $tbl_history->ID_Location->headerCellClass() ?>"><span id="elh_tbl_history_ID_Location" class="tbl_history_ID_Location"><?php echo $tbl_history->ID_Location->caption() ?></span></th>
<?php } ?>
<?php if ($tbl_history->PCS->Visible) { // PCS ?>
		<th class="<?php echo $tbl_history->PCS->headerCellClass() ?>"><span id="elh_tbl_history_PCS" class="tbl_history_PCS"><?php echo $tbl_history->PCS->caption() ?></span></th>
<?php } ?>
	</tr>
	</thead>
	<tbody>
<?php
$tbl_history_delete->RecCnt = 0;
$i = 0;
while (!$tbl_history_delete->Recordset->EOF) {
	$tbl_history_delete->RecCnt++;
	$tbl_history_delete->RowCnt++;

	// Set row properties
	$tbl_history->resetAttributes();
	$tbl_history->RowType = ROWTYPE_VIEW; // View

	// Get the field contents
	$tbl_history_delete->loadRowValues($tbl_history_delete->Recordset);

	// Render row
	$tbl_history_delete->renderRow();
?>
	<tr<?php echo $tbl_history->rowAttributes() ?>>
<?php if ($tbl_history->ID_His->Visible) { // ID_His ?>
		<td<?php echo $tbl_history->ID_His->cellAttributes() ?>>
<span id="el<?php echo $tbl_history_delete->RowCnt ?>_tbl_history_ID_His" class="tbl_history_ID_His">
<span<?php echo $tbl_history->ID_His->viewAttributes() ?>>
<?php echo $tbl_history->ID_His->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($tbl_history->PalletID->Visible) { // PalletID ?>
		<td<?php echo $tbl_history->PalletID->cellAttributes() ?>>
<span id="el<?php echo $tbl_history_delete->RowCnt ?>_tbl_history_PalletID" class="tbl_history_PalletID">
<span<?php echo $tbl_history->PalletID->viewAttributes() ?>>
<?php echo $tbl_history->PalletID->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($tbl_history->ID_Location->Visible) { // ID_Location ?>
		<td<?php echo $tbl_history->ID_Location->cellAttributes() ?>>
<span id="el<?php echo $tbl_history_delete->RowCnt ?>_tbl_history_ID_Location" class="tbl_history_ID_Location">
<span<?php echo $tbl_history->ID_Location->viewAttributes() ?>>
<?php echo $tbl_history->ID_Location->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($tbl_history->PCS->Visible) { // PCS ?>
		<td<?php echo $tbl_history->PCS->cellAttributes() ?>>
<span id="el<?php echo $tbl_history_delete->RowCnt ?>_tbl_history_PCS" class="tbl_history_PCS">
<span<?php echo $tbl_history->PCS->viewAttributes() ?>>
<?php echo $tbl_history->PCS->getViewValue() ?></span>
</span>
</td>
<?php } ?>
	</tr>
<?php
	$tbl_history_delete->Recordset->moveNext();
}
$tbl_history_delete->Recordset->close();
?>
</tbody>
</table>
</div>
</div>
<div>
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("DeleteBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $tbl_history_delete->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
</div>
</form>
<?php
$tbl_history_delete->showPageFooter();
if (DEBUG_ENABLED)
	echo GetDebugMessage();
?>
<script>

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php include_once "footer.php" ?>
<?php
$tbl_history_delete->terminate();
?>