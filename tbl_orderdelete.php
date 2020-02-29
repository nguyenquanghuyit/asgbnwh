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
$tbl_order_delete = new tbl_order_delete();

// Run the page
$tbl_order_delete->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$tbl_order_delete->Page_Render();
?>
<?php include_once "header.php" ?>
<script>

// Form object
currentPageID = ew.PAGE_ID = "delete";
var ftbl_orderdelete = currentForm = new ew.Form("ftbl_orderdelete", "delete");

// Form_CustomValidate event
ftbl_orderdelete.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

	// Your custom validation code here, return false if invalid.
	return true;
}

// Use JavaScript validation or not
ftbl_orderdelete.validateRequired = <?php echo json_encode(CLIENT_VALIDATE) ?>;

// Dynamic selection lists
ftbl_orderdelete.lists["x_IdType"] = <?php echo $tbl_order_delete->IdType->Lookup->toClientList() ?>;
ftbl_orderdelete.lists["x_IdType"].options = <?php echo JsonEncode($tbl_order_delete->IdType->lookupOptions()) ?>;
ftbl_orderdelete.lists["x_ID_Contact"] = <?php echo $tbl_order_delete->ID_Contact->Lookup->toClientList() ?>;
ftbl_orderdelete.lists["x_ID_Contact"].options = <?php echo JsonEncode($tbl_order_delete->ID_Contact->lookupOptions()) ?>;
ftbl_orderdelete.autoSuggests["x_ID_Contact"] = <?php echo json_encode(["data" => "ajax=autosuggest"]) ?>;
ftbl_orderdelete.lists["x_StatusLoad"] = <?php echo $tbl_order_delete->StatusLoad->Lookup->toClientList() ?>;
ftbl_orderdelete.lists["x_StatusLoad"].options = <?php echo JsonEncode($tbl_order_delete->StatusLoad->options(FALSE, TRUE)) ?>;
ftbl_orderdelete.lists["x_StatusFinishOrder"] = <?php echo $tbl_order_delete->StatusFinishOrder->Lookup->toClientList() ?>;
ftbl_orderdelete.lists["x_StatusFinishOrder"].options = <?php echo JsonEncode($tbl_order_delete->StatusFinishOrder->options(FALSE, TRUE)) ?>;

// Form object for search
</script>
<script>

// Write your client script here, no need to add script tags.
</script>
<?php $tbl_order_delete->showPageHeader(); ?>
<?php
$tbl_order_delete->showMessage();
?>
<form name="ftbl_orderdelete" id="ftbl_orderdelete" class="form-inline ew-form ew-delete-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($tbl_order_delete->CheckToken) { ?>
<input type="hidden" name="<?php echo TOKEN_NAME ?>" value="<?php echo $tbl_order_delete->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="tbl_order">
<input type="hidden" name="action" id="action" value="delete">
<?php foreach ($tbl_order_delete->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode($COMPOSITE_KEY_SEPARATOR, $key) : $key; ?>
<input type="hidden" name="key_m[]" value="<?php echo HtmlEncode($keyvalue) ?>">
<?php } ?>
<div class="card ew-card ew-grid">
<div class="<?php if (IsResponsiveLayout()) { ?>table-responsive <?php } ?>card-body ew-grid-middle-panel">
<table class="table ew-table">
	<thead>
	<tr class="ew-table-header">
<?php if ($tbl_order->ID_Order->Visible) { // ID_Order ?>
		<th class="<?php echo $tbl_order->ID_Order->headerCellClass() ?>"><span id="elh_tbl_order_ID_Order" class="tbl_order_ID_Order"><?php echo $tbl_order->ID_Order->caption() ?></span></th>
<?php } ?>
<?php if ($tbl_order->OrderDate->Visible) { // OrderDate ?>
		<th class="<?php echo $tbl_order->OrderDate->headerCellClass() ?>"><span id="elh_tbl_order_OrderDate" class="tbl_order_OrderDate"><?php echo $tbl_order->OrderDate->caption() ?></span></th>
<?php } ?>
<?php if ($tbl_order->InvoiceNo->Visible) { // InvoiceNo ?>
		<th class="<?php echo $tbl_order->InvoiceNo->headerCellClass() ?>"><span id="elh_tbl_order_InvoiceNo" class="tbl_order_InvoiceNo"><?php echo $tbl_order->InvoiceNo->caption() ?></span></th>
<?php } ?>
<?php if ($tbl_order->CusomterOrderNo->Visible) { // CusomterOrderNo ?>
		<th class="<?php echo $tbl_order->CusomterOrderNo->headerCellClass() ?>"><span id="elh_tbl_order_CusomterOrderNo" class="tbl_order_CusomterOrderNo"><?php echo $tbl_order->CusomterOrderNo->caption() ?></span></th>
<?php } ?>
<?php if ($tbl_order->IdType->Visible) { // IdType ?>
		<th class="<?php echo $tbl_order->IdType->headerCellClass() ?>"><span id="elh_tbl_order_IdType" class="tbl_order_IdType"><?php echo $tbl_order->IdType->caption() ?></span></th>
<?php } ?>
<?php if ($tbl_order->ID_Contact->Visible) { // ID_Contact ?>
		<th class="<?php echo $tbl_order->ID_Contact->headerCellClass() ?>"><span id="elh_tbl_order_ID_Contact" class="tbl_order_ID_Contact"><?php echo $tbl_order->ID_Contact->caption() ?></span></th>
<?php } ?>
<?php if ($tbl_order->CreateUser->Visible) { // CreateUser ?>
		<th class="<?php echo $tbl_order->CreateUser->headerCellClass() ?>"><span id="elh_tbl_order_CreateUser" class="tbl_order_CreateUser"><?php echo $tbl_order->CreateUser->caption() ?></span></th>
<?php } ?>
<?php if ($tbl_order->CreateDate->Visible) { // CreateDate ?>
		<th class="<?php echo $tbl_order->CreateDate->headerCellClass() ?>"><span id="elh_tbl_order_CreateDate" class="tbl_order_CreateDate"><?php echo $tbl_order->CreateDate->caption() ?></span></th>
<?php } ?>
<?php if ($tbl_order->StatusLoad->Visible) { // StatusLoad ?>
		<th class="<?php echo $tbl_order->StatusLoad->headerCellClass() ?>"><span id="elh_tbl_order_StatusLoad" class="tbl_order_StatusLoad"><?php echo $tbl_order->StatusLoad->caption() ?></span></th>
<?php } ?>
<?php if ($tbl_order->StatusFinishOrder->Visible) { // StatusFinishOrder ?>
		<th class="<?php echo $tbl_order->StatusFinishOrder->headerCellClass() ?>"><span id="elh_tbl_order_StatusFinishOrder" class="tbl_order_StatusFinishOrder"><?php echo $tbl_order->StatusFinishOrder->caption() ?></span></th>
<?php } ?>
	</tr>
	</thead>
	<tbody>
<?php
$tbl_order_delete->RecCnt = 0;
$i = 0;
while (!$tbl_order_delete->Recordset->EOF) {
	$tbl_order_delete->RecCnt++;
	$tbl_order_delete->RowCnt++;

	// Set row properties
	$tbl_order->resetAttributes();
	$tbl_order->RowType = ROWTYPE_VIEW; // View

	// Get the field contents
	$tbl_order_delete->loadRowValues($tbl_order_delete->Recordset);

	// Render row
	$tbl_order_delete->renderRow();
?>
	<tr<?php echo $tbl_order->rowAttributes() ?>>
<?php if ($tbl_order->ID_Order->Visible) { // ID_Order ?>
		<td<?php echo $tbl_order->ID_Order->cellAttributes() ?>>
<span id="el<?php echo $tbl_order_delete->RowCnt ?>_tbl_order_ID_Order" class="tbl_order_ID_Order">
<span<?php echo $tbl_order->ID_Order->viewAttributes() ?>>
<?php echo $tbl_order->ID_Order->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($tbl_order->OrderDate->Visible) { // OrderDate ?>
		<td<?php echo $tbl_order->OrderDate->cellAttributes() ?>>
<span id="el<?php echo $tbl_order_delete->RowCnt ?>_tbl_order_OrderDate" class="tbl_order_OrderDate">
<span<?php echo $tbl_order->OrderDate->viewAttributes() ?>>
<?php echo $tbl_order->OrderDate->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($tbl_order->InvoiceNo->Visible) { // InvoiceNo ?>
		<td<?php echo $tbl_order->InvoiceNo->cellAttributes() ?>>
<span id="el<?php echo $tbl_order_delete->RowCnt ?>_tbl_order_InvoiceNo" class="tbl_order_InvoiceNo">
<span<?php echo $tbl_order->InvoiceNo->viewAttributes() ?>>
<?php echo $tbl_order->InvoiceNo->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($tbl_order->CusomterOrderNo->Visible) { // CusomterOrderNo ?>
		<td<?php echo $tbl_order->CusomterOrderNo->cellAttributes() ?>>
<span id="el<?php echo $tbl_order_delete->RowCnt ?>_tbl_order_CusomterOrderNo" class="tbl_order_CusomterOrderNo">
<span<?php echo $tbl_order->CusomterOrderNo->viewAttributes() ?>>
<?php echo $tbl_order->CusomterOrderNo->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($tbl_order->IdType->Visible) { // IdType ?>
		<td<?php echo $tbl_order->IdType->cellAttributes() ?>>
<span id="el<?php echo $tbl_order_delete->RowCnt ?>_tbl_order_IdType" class="tbl_order_IdType">
<span<?php echo $tbl_order->IdType->viewAttributes() ?>>
<?php echo $tbl_order->IdType->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($tbl_order->ID_Contact->Visible) { // ID_Contact ?>
		<td<?php echo $tbl_order->ID_Contact->cellAttributes() ?>>
<span id="el<?php echo $tbl_order_delete->RowCnt ?>_tbl_order_ID_Contact" class="tbl_order_ID_Contact">
<span<?php echo $tbl_order->ID_Contact->viewAttributes() ?>>
<?php echo $tbl_order->ID_Contact->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($tbl_order->CreateUser->Visible) { // CreateUser ?>
		<td<?php echo $tbl_order->CreateUser->cellAttributes() ?>>
<span id="el<?php echo $tbl_order_delete->RowCnt ?>_tbl_order_CreateUser" class="tbl_order_CreateUser">
<span<?php echo $tbl_order->CreateUser->viewAttributes() ?>>
<?php echo $tbl_order->CreateUser->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($tbl_order->CreateDate->Visible) { // CreateDate ?>
		<td<?php echo $tbl_order->CreateDate->cellAttributes() ?>>
<span id="el<?php echo $tbl_order_delete->RowCnt ?>_tbl_order_CreateDate" class="tbl_order_CreateDate">
<span<?php echo $tbl_order->CreateDate->viewAttributes() ?>>
<?php echo $tbl_order->CreateDate->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($tbl_order->StatusLoad->Visible) { // StatusLoad ?>
		<td<?php echo $tbl_order->StatusLoad->cellAttributes() ?>>
<span id="el<?php echo $tbl_order_delete->RowCnt ?>_tbl_order_StatusLoad" class="tbl_order_StatusLoad">
<span<?php echo $tbl_order->StatusLoad->viewAttributes() ?>>
<?php echo $tbl_order->StatusLoad->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($tbl_order->StatusFinishOrder->Visible) { // StatusFinishOrder ?>
		<td<?php echo $tbl_order->StatusFinishOrder->cellAttributes() ?>>
<span id="el<?php echo $tbl_order_delete->RowCnt ?>_tbl_order_StatusFinishOrder" class="tbl_order_StatusFinishOrder">
<span<?php echo $tbl_order->StatusFinishOrder->viewAttributes() ?>>
<?php echo $tbl_order->StatusFinishOrder->getViewValue() ?></span>
</span>
</td>
<?php } ?>
	</tr>
<?php
	$tbl_order_delete->Recordset->moveNext();
}
$tbl_order_delete->Recordset->close();
?>
</tbody>
</table>
</div>
</div>
<div>
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("DeleteBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $tbl_order_delete->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
</div>
</form>
<?php
$tbl_order_delete->showPageFooter();
if (DEBUG_ENABLED)
	echo GetDebugMessage();
?>
<script>

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php include_once "footer.php" ?>
<?php
$tbl_order_delete->terminate();
?>