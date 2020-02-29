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
$tbl_dealer_delete = new tbl_dealer_delete();

// Run the page
$tbl_dealer_delete->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$tbl_dealer_delete->Page_Render();
?>
<?php include_once "header.php" ?>
<script>

// Form object
currentPageID = ew.PAGE_ID = "delete";
var ftbl_dealerdelete = currentForm = new ew.Form("ftbl_dealerdelete", "delete");

// Form_CustomValidate event
ftbl_dealerdelete.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

	// Your custom validation code here, return false if invalid.
	return true;
}

// Use JavaScript validation or not
ftbl_dealerdelete.validateRequired = <?php echo json_encode(CLIENT_VALIDATE) ?>;

// Dynamic selection lists
// Form object for search

</script>
<script>

// Write your client script here, no need to add script tags.
</script>
<?php $tbl_dealer_delete->showPageHeader(); ?>
<?php
$tbl_dealer_delete->showMessage();
?>
<form name="ftbl_dealerdelete" id="ftbl_dealerdelete" class="form-inline ew-form ew-delete-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($tbl_dealer_delete->CheckToken) { ?>
<input type="hidden" name="<?php echo TOKEN_NAME ?>" value="<?php echo $tbl_dealer_delete->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="tbl_dealer">
<input type="hidden" name="action" id="action" value="delete">
<?php foreach ($tbl_dealer_delete->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode($COMPOSITE_KEY_SEPARATOR, $key) : $key; ?>
<input type="hidden" name="key_m[]" value="<?php echo HtmlEncode($keyvalue) ?>">
<?php } ?>
<div class="card ew-card ew-grid">
<div class="<?php if (IsResponsiveLayout()) { ?>table-responsive <?php } ?>card-body ew-grid-middle-panel">
<table class="table ew-table">
	<thead>
	<tr class="ew-table-header">
<?php if ($tbl_dealer->DealerName->Visible) { // DealerName ?>
		<th class="<?php echo $tbl_dealer->DealerName->headerCellClass() ?>"><span id="elh_tbl_dealer_DealerName" class="tbl_dealer_DealerName"><?php echo $tbl_dealer->DealerName->caption() ?></span></th>
<?php } ?>
<?php if ($tbl_dealer->Address->Visible) { // Address ?>
		<th class="<?php echo $tbl_dealer->Address->headerCellClass() ?>"><span id="elh_tbl_dealer_Address" class="tbl_dealer_Address"><?php echo $tbl_dealer->Address->caption() ?></span></th>
<?php } ?>
	</tr>
	</thead>
	<tbody>
<?php
$tbl_dealer_delete->RecCnt = 0;
$i = 0;
while (!$tbl_dealer_delete->Recordset->EOF) {
	$tbl_dealer_delete->RecCnt++;
	$tbl_dealer_delete->RowCnt++;

	// Set row properties
	$tbl_dealer->resetAttributes();
	$tbl_dealer->RowType = ROWTYPE_VIEW; // View

	// Get the field contents
	$tbl_dealer_delete->loadRowValues($tbl_dealer_delete->Recordset);

	// Render row
	$tbl_dealer_delete->renderRow();
?>
	<tr<?php echo $tbl_dealer->rowAttributes() ?>>
<?php if ($tbl_dealer->DealerName->Visible) { // DealerName ?>
		<td<?php echo $tbl_dealer->DealerName->cellAttributes() ?>>
<span id="el<?php echo $tbl_dealer_delete->RowCnt ?>_tbl_dealer_DealerName" class="tbl_dealer_DealerName">
<span<?php echo $tbl_dealer->DealerName->viewAttributes() ?>>
<?php echo $tbl_dealer->DealerName->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($tbl_dealer->Address->Visible) { // Address ?>
		<td<?php echo $tbl_dealer->Address->cellAttributes() ?>>
<span id="el<?php echo $tbl_dealer_delete->RowCnt ?>_tbl_dealer_Address" class="tbl_dealer_Address">
<span<?php echo $tbl_dealer->Address->viewAttributes() ?>>
<?php echo $tbl_dealer->Address->getViewValue() ?></span>
</span>
</td>
<?php } ?>
	</tr>
<?php
	$tbl_dealer_delete->Recordset->moveNext();
}
$tbl_dealer_delete->Recordset->close();
?>
</tbody>
</table>
</div>
</div>
<div>
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("DeleteBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $tbl_dealer_delete->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
</div>
</form>
<?php
$tbl_dealer_delete->showPageFooter();
if (DEBUG_ENABLED)
	echo GetDebugMessage();
?>
<script>

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php include_once "footer.php" ?>
<?php
$tbl_dealer_delete->terminate();
?>