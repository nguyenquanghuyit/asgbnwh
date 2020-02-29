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
$tbl_inventory_view = new tbl_inventory_view();

// Run the page
$tbl_inventory_view->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$tbl_inventory_view->Page_Render();
?>
<?php include_once "header.php" ?>
<?php if (!$tbl_inventory->isExport()) { ?>
<script>

// Form object
currentPageID = ew.PAGE_ID = "view";
var ftbl_inventoryview = currentForm = new ew.Form("ftbl_inventoryview", "view");

// Form_CustomValidate event
ftbl_inventoryview.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

	// Your custom validation code here, return false if invalid.
	return true;
}

// Use JavaScript validation or not
ftbl_inventoryview.validateRequired = <?php echo json_encode(CLIENT_VALIDATE) ?>;

// Dynamic selection lists
// Form object for search

</script>
<script>

// Write your client script here, no need to add script tags.
</script>
<?php } ?>
<?php if (!$tbl_inventory->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php $tbl_inventory_view->ExportOptions->render("body") ?>
<?php $tbl_inventory_view->OtherOptions->render("body") ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php $tbl_inventory_view->showPageHeader(); ?>
<?php
$tbl_inventory_view->showMessage();
?>
<form name="ftbl_inventoryview" id="ftbl_inventoryview" class="form-inline ew-form ew-view-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($tbl_inventory_view->CheckToken) { ?>
<input type="hidden" name="<?php echo TOKEN_NAME ?>" value="<?php echo $tbl_inventory_view->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="tbl_inventory">
<input type="hidden" name="modal" value="<?php echo (int)$tbl_inventory_view->IsModal ?>">
<table class="table table-striped table-sm ew-view-table">
<?php if ($tbl_inventory->ID_Delivery->Visible) { // ID_Delivery ?>
	<tr id="r_ID_Delivery">
		<td class="<?php echo $tbl_inventory_view->TableLeftColumnClass ?>"><span id="elh_tbl_inventory_ID_Delivery"><?php echo $tbl_inventory->ID_Delivery->caption() ?></span></td>
		<td data-name="ID_Delivery"<?php echo $tbl_inventory->ID_Delivery->cellAttributes() ?>>
<span id="el_tbl_inventory_ID_Delivery">
<span<?php echo $tbl_inventory->ID_Delivery->viewAttributes() ?>>
<?php echo $tbl_inventory->ID_Delivery->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($tbl_inventory->In_Year->Visible) { // In_Year ?>
	<tr id="r_In_Year">
		<td class="<?php echo $tbl_inventory_view->TableLeftColumnClass ?>"><span id="elh_tbl_inventory_In_Year"><?php echo $tbl_inventory->In_Year->caption() ?></span></td>
		<td data-name="In_Year"<?php echo $tbl_inventory->In_Year->cellAttributes() ?>>
<span id="el_tbl_inventory_In_Year">
<span<?php echo $tbl_inventory->In_Year->viewAttributes() ?>>
<?php echo $tbl_inventory->In_Year->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($tbl_inventory->In_Month->Visible) { // In_Month ?>
	<tr id="r_In_Month">
		<td class="<?php echo $tbl_inventory_view->TableLeftColumnClass ?>"><span id="elh_tbl_inventory_In_Month"><?php echo $tbl_inventory->In_Month->caption() ?></span></td>
		<td data-name="In_Month"<?php echo $tbl_inventory->In_Month->cellAttributes() ?>>
<span id="el_tbl_inventory_In_Month">
<span<?php echo $tbl_inventory->In_Month->viewAttributes() ?>>
<?php echo $tbl_inventory->In_Month->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($tbl_inventory->Code->Visible) { // Code ?>
	<tr id="r_Code">
		<td class="<?php echo $tbl_inventory_view->TableLeftColumnClass ?>"><span id="elh_tbl_inventory_Code"><?php echo $tbl_inventory->Code->caption() ?></span></td>
		<td data-name="Code"<?php echo $tbl_inventory->Code->cellAttributes() ?>>
<span id="el_tbl_inventory_Code">
<span<?php echo $tbl_inventory->Code->viewAttributes() ?>>
<?php echo $tbl_inventory->Code->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($tbl_inventory->ProductName->Visible) { // ProductName ?>
	<tr id="r_ProductName">
		<td class="<?php echo $tbl_inventory_view->TableLeftColumnClass ?>"><span id="elh_tbl_inventory_ProductName"><?php echo $tbl_inventory->ProductName->caption() ?></span></td>
		<td data-name="ProductName"<?php echo $tbl_inventory->ProductName->cellAttributes() ?>>
<span id="el_tbl_inventory_ProductName">
<span<?php echo $tbl_inventory->ProductName->viewAttributes() ?>>
<?php echo $tbl_inventory->ProductName->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($tbl_inventory->OpeningStock->Visible) { // OpeningStock ?>
	<tr id="r_OpeningStock">
		<td class="<?php echo $tbl_inventory_view->TableLeftColumnClass ?>"><span id="elh_tbl_inventory_OpeningStock"><?php echo $tbl_inventory->OpeningStock->caption() ?></span></td>
		<td data-name="OpeningStock"<?php echo $tbl_inventory->OpeningStock->cellAttributes() ?>>
<span id="el_tbl_inventory_OpeningStock">
<span<?php echo $tbl_inventory->OpeningStock->viewAttributes() ?>>
<?php echo $tbl_inventory->OpeningStock->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($tbl_inventory->PCS_IN->Visible) { // PCS_IN ?>
	<tr id="r_PCS_IN">
		<td class="<?php echo $tbl_inventory_view->TableLeftColumnClass ?>"><span id="elh_tbl_inventory_PCS_IN"><?php echo $tbl_inventory->PCS_IN->caption() ?></span></td>
		<td data-name="PCS_IN"<?php echo $tbl_inventory->PCS_IN->cellAttributes() ?>>
<span id="el_tbl_inventory_PCS_IN">
<span<?php echo $tbl_inventory->PCS_IN->viewAttributes() ?>>
<?php echo $tbl_inventory->PCS_IN->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($tbl_inventory->PCS_OUT->Visible) { // PCS_OUT ?>
	<tr id="r_PCS_OUT">
		<td class="<?php echo $tbl_inventory_view->TableLeftColumnClass ?>"><span id="elh_tbl_inventory_PCS_OUT"><?php echo $tbl_inventory->PCS_OUT->caption() ?></span></td>
		<td data-name="PCS_OUT"<?php echo $tbl_inventory->PCS_OUT->cellAttributes() ?>>
<span id="el_tbl_inventory_PCS_OUT">
<span<?php echo $tbl_inventory->PCS_OUT->viewAttributes() ?>>
<?php echo $tbl_inventory->PCS_OUT->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($tbl_inventory->ClosingStock->Visible) { // ClosingStock ?>
	<tr id="r_ClosingStock">
		<td class="<?php echo $tbl_inventory_view->TableLeftColumnClass ?>"><span id="elh_tbl_inventory_ClosingStock"><?php echo $tbl_inventory->ClosingStock->caption() ?></span></td>
		<td data-name="ClosingStock"<?php echo $tbl_inventory->ClosingStock->cellAttributes() ?>>
<span id="el_tbl_inventory_ClosingStock">
<span<?php echo $tbl_inventory->ClosingStock->viewAttributes() ?>>
<?php echo $tbl_inventory->ClosingStock->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($tbl_inventory->LockStock->Visible) { // LockStock ?>
	<tr id="r_LockStock">
		<td class="<?php echo $tbl_inventory_view->TableLeftColumnClass ?>"><span id="elh_tbl_inventory_LockStock"><?php echo $tbl_inventory->LockStock->caption() ?></span></td>
		<td data-name="LockStock"<?php echo $tbl_inventory->LockStock->cellAttributes() ?>>
<span id="el_tbl_inventory_LockStock">
<span<?php echo $tbl_inventory->LockStock->viewAttributes() ?>>
<?php echo $tbl_inventory->LockStock->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
</table>
</form>
<?php
$tbl_inventory_view->showPageFooter();
if (DEBUG_ENABLED)
	echo GetDebugMessage();
?>
<?php if (!$tbl_inventory->isExport()) { ?>
<script>

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php } ?>
<?php include_once "footer.php" ?>
<?php
$tbl_inventory_view->terminate();
?>