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
$vwrouteout_delete = new vwrouteout_delete();

// Run the page
$vwrouteout_delete->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$vwrouteout_delete->Page_Render();
?>
<?php include_once "header.php" ?>
<script>

// Form object
currentPageID = ew.PAGE_ID = "delete";
var fvwrouteoutdelete = currentForm = new ew.Form("fvwrouteoutdelete", "delete");

// Form_CustomValidate event
fvwrouteoutdelete.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

	// Your custom validation code here, return false if invalid.
	return true;
}

// Use JavaScript validation or not
fvwrouteoutdelete.validateRequired = <?php echo json_encode(CLIENT_VALIDATE) ?>;

// Dynamic selection lists
fvwrouteoutdelete.lists["x_RouteName"] = <?php echo $vwrouteout_delete->RouteName->Lookup->toClientList() ?>;
fvwrouteoutdelete.lists["x_RouteName"].options = <?php echo JsonEncode($vwrouteout_delete->RouteName->options(FALSE, TRUE)) ?>;

// Form object for search
</script>
<script>

// Write your client script here, no need to add script tags.
</script>
<?php $vwrouteout_delete->showPageHeader(); ?>
<?php
$vwrouteout_delete->showMessage();
?>
<form name="fvwrouteoutdelete" id="fvwrouteoutdelete" class="form-inline ew-form ew-delete-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($vwrouteout_delete->CheckToken) { ?>
<input type="hidden" name="<?php echo TOKEN_NAME ?>" value="<?php echo $vwrouteout_delete->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="vwrouteout">
<input type="hidden" name="action" id="action" value="delete">
<?php foreach ($vwrouteout_delete->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode($COMPOSITE_KEY_SEPARATOR, $key) : $key; ?>
<input type="hidden" name="key_m[]" value="<?php echo HtmlEncode($keyvalue) ?>">
<?php } ?>
<div class="card ew-card ew-grid">
<div class="<?php if (IsResponsiveLayout()) { ?>table-responsive <?php } ?>card-body ew-grid-middle-panel">
<table class="table ew-table">
	<thead>
	<tr class="ew-table-header">
<?php if ($vwrouteout->RouteName->Visible) { // RouteName ?>
		<th class="<?php echo $vwrouteout->RouteName->headerCellClass() ?>"><span id="elh_vwrouteout_RouteName" class="vwrouteout_RouteName"><?php echo $vwrouteout->RouteName->caption() ?></span></th>
<?php } ?>
<?php if ($vwrouteout->TruckNo->Visible) { // TruckNo ?>
		<th class="<?php echo $vwrouteout->TruckNo->headerCellClass() ?>"><span id="elh_vwrouteout_TruckNo" class="vwrouteout_TruckNo"><?php echo $vwrouteout->TruckNo->caption() ?></span></th>
<?php } ?>
<?php if ($vwrouteout->DriverName->Visible) { // DriverName ?>
		<th class="<?php echo $vwrouteout->DriverName->headerCellClass() ?>"><span id="elh_vwrouteout_DriverName" class="vwrouteout_DriverName"><?php echo $vwrouteout->DriverName->caption() ?></span></th>
<?php } ?>
<?php if ($vwrouteout->DriverMobile->Visible) { // DriverMobile ?>
		<th class="<?php echo $vwrouteout->DriverMobile->headerCellClass() ?>"><span id="elh_vwrouteout_DriverMobile" class="vwrouteout_DriverMobile"><?php echo $vwrouteout->DriverMobile->caption() ?></span></th>
<?php } ?>
<?php if ($vwrouteout->InvoiceNo->Visible) { // InvoiceNo ?>
		<th class="<?php echo $vwrouteout->InvoiceNo->headerCellClass() ?>"><span id="elh_vwrouteout_InvoiceNo" class="vwrouteout_InvoiceNo"><?php echo $vwrouteout->InvoiceNo->caption() ?></span></th>
<?php } ?>
<?php if ($vwrouteout->InvoiceDate->Visible) { // InvoiceDate ?>
		<th class="<?php echo $vwrouteout->InvoiceDate->headerCellClass() ?>"><span id="elh_vwrouteout_InvoiceDate" class="vwrouteout_InvoiceDate"><?php echo $vwrouteout->InvoiceDate->caption() ?></span></th>
<?php } ?>
<?php if ($vwrouteout->CreateUser->Visible) { // CreateUser ?>
		<th class="<?php echo $vwrouteout->CreateUser->headerCellClass() ?>"><span id="elh_vwrouteout_CreateUser" class="vwrouteout_CreateUser"><?php echo $vwrouteout->CreateUser->caption() ?></span></th>
<?php } ?>
<?php if ($vwrouteout->CreateDate->Visible) { // CreateDate ?>
		<th class="<?php echo $vwrouteout->CreateDate->headerCellClass() ?>"><span id="elh_vwrouteout_CreateDate" class="vwrouteout_CreateDate"><?php echo $vwrouteout->CreateDate->caption() ?></span></th>
<?php } ?>
<?php if ($vwrouteout->SealNo->Visible) { // SealNo ?>
		<th class="<?php echo $vwrouteout->SealNo->headerCellClass() ?>"><span id="elh_vwrouteout_SealNo" class="vwrouteout_SealNo"><?php echo $vwrouteout->SealNo->caption() ?></span></th>
<?php } ?>
	</tr>
	</thead>
	<tbody>
<?php
$vwrouteout_delete->RecCnt = 0;
$i = 0;
while (!$vwrouteout_delete->Recordset->EOF) {
	$vwrouteout_delete->RecCnt++;
	$vwrouteout_delete->RowCnt++;

	// Set row properties
	$vwrouteout->resetAttributes();
	$vwrouteout->RowType = ROWTYPE_VIEW; // View

	// Get the field contents
	$vwrouteout_delete->loadRowValues($vwrouteout_delete->Recordset);

	// Render row
	$vwrouteout_delete->renderRow();
?>
	<tr<?php echo $vwrouteout->rowAttributes() ?>>
<?php if ($vwrouteout->RouteName->Visible) { // RouteName ?>
		<td<?php echo $vwrouteout->RouteName->cellAttributes() ?>>
<span id="el<?php echo $vwrouteout_delete->RowCnt ?>_vwrouteout_RouteName" class="vwrouteout_RouteName">
<span<?php echo $vwrouteout->RouteName->viewAttributes() ?>>
<?php echo $vwrouteout->RouteName->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($vwrouteout->TruckNo->Visible) { // TruckNo ?>
		<td<?php echo $vwrouteout->TruckNo->cellAttributes() ?>>
<span id="el<?php echo $vwrouteout_delete->RowCnt ?>_vwrouteout_TruckNo" class="vwrouteout_TruckNo">
<span<?php echo $vwrouteout->TruckNo->viewAttributes() ?>>
<?php echo $vwrouteout->TruckNo->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($vwrouteout->DriverName->Visible) { // DriverName ?>
		<td<?php echo $vwrouteout->DriverName->cellAttributes() ?>>
<span id="el<?php echo $vwrouteout_delete->RowCnt ?>_vwrouteout_DriverName" class="vwrouteout_DriverName">
<span<?php echo $vwrouteout->DriverName->viewAttributes() ?>>
<?php echo $vwrouteout->DriverName->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($vwrouteout->DriverMobile->Visible) { // DriverMobile ?>
		<td<?php echo $vwrouteout->DriverMobile->cellAttributes() ?>>
<span id="el<?php echo $vwrouteout_delete->RowCnt ?>_vwrouteout_DriverMobile" class="vwrouteout_DriverMobile">
<span<?php echo $vwrouteout->DriverMobile->viewAttributes() ?>>
<?php echo $vwrouteout->DriverMobile->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($vwrouteout->InvoiceNo->Visible) { // InvoiceNo ?>
		<td<?php echo $vwrouteout->InvoiceNo->cellAttributes() ?>>
<span id="el<?php echo $vwrouteout_delete->RowCnt ?>_vwrouteout_InvoiceNo" class="vwrouteout_InvoiceNo">
<span<?php echo $vwrouteout->InvoiceNo->viewAttributes() ?>>
<?php echo $vwrouteout->InvoiceNo->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($vwrouteout->InvoiceDate->Visible) { // InvoiceDate ?>
		<td<?php echo $vwrouteout->InvoiceDate->cellAttributes() ?>>
<span id="el<?php echo $vwrouteout_delete->RowCnt ?>_vwrouteout_InvoiceDate" class="vwrouteout_InvoiceDate">
<span<?php echo $vwrouteout->InvoiceDate->viewAttributes() ?>>
<?php echo $vwrouteout->InvoiceDate->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($vwrouteout->CreateUser->Visible) { // CreateUser ?>
		<td<?php echo $vwrouteout->CreateUser->cellAttributes() ?>>
<span id="el<?php echo $vwrouteout_delete->RowCnt ?>_vwrouteout_CreateUser" class="vwrouteout_CreateUser">
<span<?php echo $vwrouteout->CreateUser->viewAttributes() ?>>
<?php echo $vwrouteout->CreateUser->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($vwrouteout->CreateDate->Visible) { // CreateDate ?>
		<td<?php echo $vwrouteout->CreateDate->cellAttributes() ?>>
<span id="el<?php echo $vwrouteout_delete->RowCnt ?>_vwrouteout_CreateDate" class="vwrouteout_CreateDate">
<span<?php echo $vwrouteout->CreateDate->viewAttributes() ?>>
<?php echo $vwrouteout->CreateDate->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($vwrouteout->SealNo->Visible) { // SealNo ?>
		<td<?php echo $vwrouteout->SealNo->cellAttributes() ?>>
<span id="el<?php echo $vwrouteout_delete->RowCnt ?>_vwrouteout_SealNo" class="vwrouteout_SealNo">
<span<?php echo $vwrouteout->SealNo->viewAttributes() ?>>
<?php echo $vwrouteout->SealNo->getViewValue() ?></span>
</span>
</td>
<?php } ?>
	</tr>
<?php
	$vwrouteout_delete->Recordset->moveNext();
}
$vwrouteout_delete->Recordset->close();
?>
</tbody>
</table>
</div>
</div>
<div>
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("DeleteBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $vwrouteout_delete->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
</div>
</form>
<?php
$vwrouteout_delete->showPageFooter();
if (DEBUG_ENABLED)
	echo GetDebugMessage();
?>
<script>

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php include_once "footer.php" ?>
<?php
$vwrouteout_delete->terminate();
?>