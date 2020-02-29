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
$tbl_inventory_delete = new tbl_inventory_delete();

// Run the page
$tbl_inventory_delete->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$tbl_inventory_delete->Page_Render();
?>
<?php include_once "header.php" ?>
<script>

// Form object
currentPageID = ew.PAGE_ID = "delete";
var ftbl_inventorydelete = currentForm = new ew.Form("ftbl_inventorydelete", "delete");

// Form_CustomValidate event
ftbl_inventorydelete.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

	// Your custom validation code here, return false if invalid.
	return true;
}

// Use JavaScript validation or not
ftbl_inventorydelete.validateRequired = <?php echo json_encode(CLIENT_VALIDATE) ?>;

// Dynamic selection lists
// Form object for search

</script>
<script>

// Write your client script here, no need to add script tags.
</script>
<?php $tbl_inventory_delete->showPageHeader(); ?>
<?php
$tbl_inventory_delete->showMessage();
?>
<form name="ftbl_inventorydelete" id="ftbl_inventorydelete" class="form-inline ew-form ew-delete-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($tbl_inventory_delete->CheckToken) { ?>
<input type="hidden" name="<?php echo TOKEN_NAME ?>" value="<?php echo $tbl_inventory_delete->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="tbl_inventory">
<input type="hidden" name="action" id="action" value="delete">
<?php foreach ($tbl_inventory_delete->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode($COMPOSITE_KEY_SEPARATOR, $key) : $key; ?>
<input type="hidden" name="key_m[]" value="<?php echo HtmlEncode($keyvalue) ?>">
<?php } ?>
<div class="card ew-card ew-grid">
<div class="<?php if (IsResponsiveLayout()) { ?>table-responsive <?php } ?>card-body ew-grid-middle-panel">
<table class="table ew-table">
	<thead>
	<tr class="ew-table-header">
<?php if ($tbl_inventory->ID_Delivery->Visible) { // ID_Delivery ?>
		<th class="<?php echo $tbl_inventory->ID_Delivery->headerCellClass() ?>"><span id="elh_tbl_inventory_ID_Delivery" class="tbl_inventory_ID_Delivery"><?php echo $tbl_inventory->ID_Delivery->caption() ?></span></th>
<?php } ?>
<?php if ($tbl_inventory->In_Year->Visible) { // In_Year ?>
		<th class="<?php echo $tbl_inventory->In_Year->headerCellClass() ?>"><span id="elh_tbl_inventory_In_Year" class="tbl_inventory_In_Year"><?php echo $tbl_inventory->In_Year->caption() ?></span></th>
<?php } ?>
<?php if ($tbl_inventory->In_Month->Visible) { // In_Month ?>
		<th class="<?php echo $tbl_inventory->In_Month->headerCellClass() ?>"><span id="elh_tbl_inventory_In_Month" class="tbl_inventory_In_Month"><?php echo $tbl_inventory->In_Month->caption() ?></span></th>
<?php } ?>
<?php if ($tbl_inventory->Code->Visible) { // Code ?>
		<th class="<?php echo $tbl_inventory->Code->headerCellClass() ?>"><span id="elh_tbl_inventory_Code" class="tbl_inventory_Code"><?php echo $tbl_inventory->Code->caption() ?></span></th>
<?php } ?>
<?php if ($tbl_inventory->ProductName->Visible) { // ProductName ?>
		<th class="<?php echo $tbl_inventory->ProductName->headerCellClass() ?>"><span id="elh_tbl_inventory_ProductName" class="tbl_inventory_ProductName"><?php echo $tbl_inventory->ProductName->caption() ?></span></th>
<?php } ?>
<?php if ($tbl_inventory->OpeningStock->Visible) { // OpeningStock ?>
		<th class="<?php echo $tbl_inventory->OpeningStock->headerCellClass() ?>"><span id="elh_tbl_inventory_OpeningStock" class="tbl_inventory_OpeningStock"><?php echo $tbl_inventory->OpeningStock->caption() ?></span></th>
<?php } ?>
<?php if ($tbl_inventory->PCS_IN->Visible) { // PCS_IN ?>
		<th class="<?php echo $tbl_inventory->PCS_IN->headerCellClass() ?>"><span id="elh_tbl_inventory_PCS_IN" class="tbl_inventory_PCS_IN"><?php echo $tbl_inventory->PCS_IN->caption() ?></span></th>
<?php } ?>
<?php if ($tbl_inventory->PCS_OUT->Visible) { // PCS_OUT ?>
		<th class="<?php echo $tbl_inventory->PCS_OUT->headerCellClass() ?>"><span id="elh_tbl_inventory_PCS_OUT" class="tbl_inventory_PCS_OUT"><?php echo $tbl_inventory->PCS_OUT->caption() ?></span></th>
<?php } ?>
<?php if ($tbl_inventory->ClosingStock->Visible) { // ClosingStock ?>
		<th class="<?php echo $tbl_inventory->ClosingStock->headerCellClass() ?>"><span id="elh_tbl_inventory_ClosingStock" class="tbl_inventory_ClosingStock"><?php echo $tbl_inventory->ClosingStock->caption() ?></span></th>
<?php } ?>
<?php if ($tbl_inventory->LockStock->Visible) { // LockStock ?>
		<th class="<?php echo $tbl_inventory->LockStock->headerCellClass() ?>"><span id="elh_tbl_inventory_LockStock" class="tbl_inventory_LockStock"><?php echo $tbl_inventory->LockStock->caption() ?></span></th>
<?php } ?>
	</tr>
	</thead>
	<tbody>
<?php
$tbl_inventory_delete->RecCnt = 0;
$i = 0;
while (!$tbl_inventory_delete->Recordset->EOF) {
	$tbl_inventory_delete->RecCnt++;
	$tbl_inventory_delete->RowCnt++;

	// Set row properties
	$tbl_inventory->resetAttributes();
	$tbl_inventory->RowType = ROWTYPE_VIEW; // View

	// Get the field contents
	$tbl_inventory_delete->loadRowValues($tbl_inventory_delete->Recordset);

	// Render row
	$tbl_inventory_delete->renderRow();
?>
	<tr<?php echo $tbl_inventory->rowAttributes() ?>>
<?php if ($tbl_inventory->ID_Delivery->Visible) { // ID_Delivery ?>
		<td<?php echo $tbl_inventory->ID_Delivery->cellAttributes() ?>>
<span id="el<?php echo $tbl_inventory_delete->RowCnt ?>_tbl_inventory_ID_Delivery" class="tbl_inventory_ID_Delivery">
<span<?php echo $tbl_inventory->ID_Delivery->viewAttributes() ?>>
<?php echo $tbl_inventory->ID_Delivery->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($tbl_inventory->In_Year->Visible) { // In_Year ?>
		<td<?php echo $tbl_inventory->In_Year->cellAttributes() ?>>
<span id="el<?php echo $tbl_inventory_delete->RowCnt ?>_tbl_inventory_In_Year" class="tbl_inventory_In_Year">
<span<?php echo $tbl_inventory->In_Year->viewAttributes() ?>>
<?php echo $tbl_inventory->In_Year->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($tbl_inventory->In_Month->Visible) { // In_Month ?>
		<td<?php echo $tbl_inventory->In_Month->cellAttributes() ?>>
<span id="el<?php echo $tbl_inventory_delete->RowCnt ?>_tbl_inventory_In_Month" class="tbl_inventory_In_Month">
<span<?php echo $tbl_inventory->In_Month->viewAttributes() ?>>
<?php echo $tbl_inventory->In_Month->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($tbl_inventory->Code->Visible) { // Code ?>
		<td<?php echo $tbl_inventory->Code->cellAttributes() ?>>
<span id="el<?php echo $tbl_inventory_delete->RowCnt ?>_tbl_inventory_Code" class="tbl_inventory_Code">
<span<?php echo $tbl_inventory->Code->viewAttributes() ?>>
<?php echo $tbl_inventory->Code->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($tbl_inventory->ProductName->Visible) { // ProductName ?>
		<td<?php echo $tbl_inventory->ProductName->cellAttributes() ?>>
<span id="el<?php echo $tbl_inventory_delete->RowCnt ?>_tbl_inventory_ProductName" class="tbl_inventory_ProductName">
<span<?php echo $tbl_inventory->ProductName->viewAttributes() ?>>
<?php echo $tbl_inventory->ProductName->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($tbl_inventory->OpeningStock->Visible) { // OpeningStock ?>
		<td<?php echo $tbl_inventory->OpeningStock->cellAttributes() ?>>
<span id="el<?php echo $tbl_inventory_delete->RowCnt ?>_tbl_inventory_OpeningStock" class="tbl_inventory_OpeningStock">
<span<?php echo $tbl_inventory->OpeningStock->viewAttributes() ?>>
<?php echo $tbl_inventory->OpeningStock->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($tbl_inventory->PCS_IN->Visible) { // PCS_IN ?>
		<td<?php echo $tbl_inventory->PCS_IN->cellAttributes() ?>>
<span id="el<?php echo $tbl_inventory_delete->RowCnt ?>_tbl_inventory_PCS_IN" class="tbl_inventory_PCS_IN">
<span<?php echo $tbl_inventory->PCS_IN->viewAttributes() ?>>
<?php echo $tbl_inventory->PCS_IN->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($tbl_inventory->PCS_OUT->Visible) { // PCS_OUT ?>
		<td<?php echo $tbl_inventory->PCS_OUT->cellAttributes() ?>>
<span id="el<?php echo $tbl_inventory_delete->RowCnt ?>_tbl_inventory_PCS_OUT" class="tbl_inventory_PCS_OUT">
<span<?php echo $tbl_inventory->PCS_OUT->viewAttributes() ?>>
<?php echo $tbl_inventory->PCS_OUT->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($tbl_inventory->ClosingStock->Visible) { // ClosingStock ?>
		<td<?php echo $tbl_inventory->ClosingStock->cellAttributes() ?>>
<span id="el<?php echo $tbl_inventory_delete->RowCnt ?>_tbl_inventory_ClosingStock" class="tbl_inventory_ClosingStock">
<span<?php echo $tbl_inventory->ClosingStock->viewAttributes() ?>>
<?php echo $tbl_inventory->ClosingStock->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($tbl_inventory->LockStock->Visible) { // LockStock ?>
		<td<?php echo $tbl_inventory->LockStock->cellAttributes() ?>>
<span id="el<?php echo $tbl_inventory_delete->RowCnt ?>_tbl_inventory_LockStock" class="tbl_inventory_LockStock">
<span<?php echo $tbl_inventory->LockStock->viewAttributes() ?>>
<?php echo $tbl_inventory->LockStock->getViewValue() ?></span>
</span>
</td>
<?php } ?>
	</tr>
<?php
	$tbl_inventory_delete->Recordset->moveNext();
}
$tbl_inventory_delete->Recordset->close();
?>
</tbody>
</table>
</div>
</div>
<div>
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("DeleteBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $tbl_inventory_delete->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
</div>
</form>
<?php
$tbl_inventory_delete->showPageFooter();
if (DEBUG_ENABLED)
	echo GetDebugMessage();
?>
<script>

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php include_once "footer.php" ?>
<?php
$tbl_inventory_delete->terminate();
?>