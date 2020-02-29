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
$tbl_order_po_inv_view = new tbl_order_po_inv_view();

// Run the page
$tbl_order_po_inv_view->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$tbl_order_po_inv_view->Page_Render();
?>
<?php include_once "header.php" ?>
<?php if (!$tbl_order_po_inv->isExport()) { ?>
<script>

// Form object
currentPageID = ew.PAGE_ID = "view";
var ftbl_order_po_invview = currentForm = new ew.Form("ftbl_order_po_invview", "view");

// Form_CustomValidate event
ftbl_order_po_invview.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

	// Your custom validation code here, return false if invalid.
	return true;
}

// Use JavaScript validation or not
ftbl_order_po_invview.validateRequired = <?php echo json_encode(CLIENT_VALIDATE) ?>;

// Dynamic selection lists
// Form object for search

</script>
<script>

// Write your client script here, no need to add script tags.
</script>
<?php } ?>
<?php if (!$tbl_order_po_inv->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php $tbl_order_po_inv_view->ExportOptions->render("body") ?>
<?php $tbl_order_po_inv_view->OtherOptions->render("body") ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php $tbl_order_po_inv_view->showPageHeader(); ?>
<?php
$tbl_order_po_inv_view->showMessage();
?>
<form name="ftbl_order_po_invview" id="ftbl_order_po_invview" class="form-inline ew-form ew-view-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($tbl_order_po_inv_view->CheckToken) { ?>
<input type="hidden" name="<?php echo TOKEN_NAME ?>" value="<?php echo $tbl_order_po_inv_view->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="tbl_order_po_inv">
<input type="hidden" name="modal" value="<?php echo (int)$tbl_order_po_inv_view->IsModal ?>">
<table class="table table-striped table-sm ew-view-table">
<?php if ($tbl_order_po_inv->OrderNo->Visible) { // OrderNo ?>
	<tr id="r_OrderNo">
		<td class="<?php echo $tbl_order_po_inv_view->TableLeftColumnClass ?>"><span id="elh_tbl_order_po_inv_OrderNo"><?php echo $tbl_order_po_inv->OrderNo->caption() ?></span></td>
		<td data-name="OrderNo"<?php echo $tbl_order_po_inv->OrderNo->cellAttributes() ?>>
<span id="el_tbl_order_po_inv_OrderNo">
<span<?php echo $tbl_order_po_inv->OrderNo->viewAttributes() ?>>
<?php echo $tbl_order_po_inv->OrderNo->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($tbl_order_po_inv->Code->Visible) { // Code ?>
	<tr id="r_Code">
		<td class="<?php echo $tbl_order_po_inv_view->TableLeftColumnClass ?>"><span id="elh_tbl_order_po_inv_Code"><?php echo $tbl_order_po_inv->Code->caption() ?></span></td>
		<td data-name="Code"<?php echo $tbl_order_po_inv->Code->cellAttributes() ?>>
<span id="el_tbl_order_po_inv_Code">
<span<?php echo $tbl_order_po_inv->Code->viewAttributes() ?>>
<?php echo $tbl_order_po_inv->Code->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($tbl_order_po_inv->PalletNo->Visible) { // PalletNo ?>
	<tr id="r_PalletNo">
		<td class="<?php echo $tbl_order_po_inv_view->TableLeftColumnClass ?>"><span id="elh_tbl_order_po_inv_PalletNo"><?php echo $tbl_order_po_inv->PalletNo->caption() ?></span></td>
		<td data-name="PalletNo"<?php echo $tbl_order_po_inv->PalletNo->cellAttributes() ?>>
<span id="el_tbl_order_po_inv_PalletNo">
<span<?php echo $tbl_order_po_inv->PalletNo->viewAttributes() ?>>
<?php echo $tbl_order_po_inv->PalletNo->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($tbl_order_po_inv->DateIn->Visible) { // DateIn ?>
	<tr id="r_DateIn">
		<td class="<?php echo $tbl_order_po_inv_view->TableLeftColumnClass ?>"><span id="elh_tbl_order_po_inv_DateIn"><?php echo $tbl_order_po_inv->DateIn->caption() ?></span></td>
		<td data-name="DateIn"<?php echo $tbl_order_po_inv->DateIn->cellAttributes() ?>>
<span id="el_tbl_order_po_inv_DateIn">
<span<?php echo $tbl_order_po_inv->DateIn->viewAttributes() ?>>
<?php echo $tbl_order_po_inv->DateIn->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($tbl_order_po_inv->PCS_In->Visible) { // PCS_In ?>
	<tr id="r_PCS_In">
		<td class="<?php echo $tbl_order_po_inv_view->TableLeftColumnClass ?>"><span id="elh_tbl_order_po_inv_PCS_In"><?php echo $tbl_order_po_inv->PCS_In->caption() ?></span></td>
		<td data-name="PCS_In"<?php echo $tbl_order_po_inv->PCS_In->cellAttributes() ?>>
<span id="el_tbl_order_po_inv_PCS_In">
<span<?php echo $tbl_order_po_inv->PCS_In->viewAttributes() ?>>
<?php echo $tbl_order_po_inv->PCS_In->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($tbl_order_po_inv->PCS_Out->Visible) { // PCS_Out ?>
	<tr id="r_PCS_Out">
		<td class="<?php echo $tbl_order_po_inv_view->TableLeftColumnClass ?>"><span id="elh_tbl_order_po_inv_PCS_Out"><?php echo $tbl_order_po_inv->PCS_Out->caption() ?></span></td>
		<td data-name="PCS_Out"<?php echo $tbl_order_po_inv->PCS_Out->cellAttributes() ?>>
<span id="el_tbl_order_po_inv_PCS_Out">
<span<?php echo $tbl_order_po_inv->PCS_Out->viewAttributes() ?>>
<?php echo $tbl_order_po_inv->PCS_Out->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($tbl_order_po_inv->PO_No->Visible) { // PO_No ?>
	<tr id="r_PO_No">
		<td class="<?php echo $tbl_order_po_inv_view->TableLeftColumnClass ?>"><span id="elh_tbl_order_po_inv_PO_No"><?php echo $tbl_order_po_inv->PO_No->caption() ?></span></td>
		<td data-name="PO_No"<?php echo $tbl_order_po_inv->PO_No->cellAttributes() ?>>
<span id="el_tbl_order_po_inv_PO_No">
<span<?php echo $tbl_order_po_inv->PO_No->viewAttributes() ?>>
<?php echo $tbl_order_po_inv->PO_No->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($tbl_order_po_inv->INV_No->Visible) { // INV_No ?>
	<tr id="r_INV_No">
		<td class="<?php echo $tbl_order_po_inv_view->TableLeftColumnClass ?>"><span id="elh_tbl_order_po_inv_INV_No"><?php echo $tbl_order_po_inv->INV_No->caption() ?></span></td>
		<td data-name="INV_No"<?php echo $tbl_order_po_inv->INV_No->cellAttributes() ?>>
<span id="el_tbl_order_po_inv_INV_No">
<span<?php echo $tbl_order_po_inv->INV_No->viewAttributes() ?>>
<?php echo $tbl_order_po_inv->INV_No->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
</table>
</form>
<?php
$tbl_order_po_inv_view->showPageFooter();
if (DEBUG_ENABLED)
	echo GetDebugMessage();
?>
<?php if (!$tbl_order_po_inv->isExport()) { ?>
<script>

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php } ?>
<?php include_once "footer.php" ?>
<?php
$tbl_order_po_inv_view->terminate();
?>