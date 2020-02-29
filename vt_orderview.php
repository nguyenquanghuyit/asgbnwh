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
$vt_order_view = new vt_order_view();

// Run the page
$vt_order_view->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$vt_order_view->Page_Render();
?>
<?php include_once "header.php" ?>
<?php if (!$vt_order->isExport()) { ?>
<script>

// Form object
currentPageID = ew.PAGE_ID = "view";
var fvt_orderview = currentForm = new ew.Form("fvt_orderview", "view");

// Form_CustomValidate event
fvt_orderview.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

	// Your custom validation code here, return false if invalid.
	return true;
}

// Use JavaScript validation or not
fvt_orderview.validateRequired = <?php echo json_encode(CLIENT_VALIDATE) ?>;

// Dynamic selection lists
// Form object for search

</script>
<script>

// Write your client script here, no need to add script tags.
</script>
<?php } ?>
<?php if (!$vt_order->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php $vt_order_view->ExportOptions->render("body") ?>
<?php $vt_order_view->OtherOptions->render("body") ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php $vt_order_view->showPageHeader(); ?>
<?php
$vt_order_view->showMessage();
?>
<form name="fvt_orderview" id="fvt_orderview" class="form-inline ew-form ew-view-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($vt_order_view->CheckToken) { ?>
<input type="hidden" name="<?php echo TOKEN_NAME ?>" value="<?php echo $vt_order_view->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="vt_order">
<input type="hidden" name="modal" value="<?php echo (int)$vt_order_view->IsModal ?>">
<table class="table table-striped table-sm ew-view-table">
<?php if ($vt_order->ID_Order->Visible) { // ID_Order ?>
	<tr id="r_ID_Order">
		<td class="<?php echo $vt_order_view->TableLeftColumnClass ?>"><span id="elh_vt_order_ID_Order"><?php echo $vt_order->ID_Order->caption() ?></span></td>
		<td data-name="ID_Order"<?php echo $vt_order->ID_Order->cellAttributes() ?>>
<span id="el_vt_order_ID_Order">
<span<?php echo $vt_order->ID_Order->viewAttributes() ?>>
<?php echo $vt_order->ID_Order->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($vt_order->OrderDate->Visible) { // OrderDate ?>
	<tr id="r_OrderDate">
		<td class="<?php echo $vt_order_view->TableLeftColumnClass ?>"><span id="elh_vt_order_OrderDate"><?php echo $vt_order->OrderDate->caption() ?></span></td>
		<td data-name="OrderDate"<?php echo $vt_order->OrderDate->cellAttributes() ?>>
<span id="el_vt_order_OrderDate">
<span<?php echo $vt_order->OrderDate->viewAttributes() ?>>
<?php echo $vt_order->OrderDate->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($vt_order->Code->Visible) { // Code ?>
	<tr id="r_Code">
		<td class="<?php echo $vt_order_view->TableLeftColumnClass ?>"><span id="elh_vt_order_Code"><?php echo $vt_order->Code->caption() ?></span></td>
		<td data-name="Code"<?php echo $vt_order->Code->cellAttributes() ?>>
<span id="el_vt_order_Code">
<span<?php echo $vt_order->Code->viewAttributes() ?>>
<?php echo $vt_order->Code->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($vt_order->PCS->Visible) { // PCS ?>
	<tr id="r_PCS">
		<td class="<?php echo $vt_order_view->TableLeftColumnClass ?>"><span id="elh_vt_order_PCS"><?php echo $vt_order->PCS->caption() ?></span></td>
		<td data-name="PCS"<?php echo $vt_order->PCS->cellAttributes() ?>>
<span id="el_vt_order_PCS">
<span<?php echo $vt_order->PCS->viewAttributes() ?>>
<?php echo $vt_order->PCS->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($vt_order->ContactName->Visible) { // ContactName ?>
	<tr id="r_ContactName">
		<td class="<?php echo $vt_order_view->TableLeftColumnClass ?>"><span id="elh_vt_order_ContactName"><?php echo $vt_order->ContactName->caption() ?></span></td>
		<td data-name="ContactName"<?php echo $vt_order->ContactName->cellAttributes() ?>>
<span id="el_vt_order_ContactName">
<span<?php echo $vt_order->ContactName->viewAttributes() ?>>
<?php echo $vt_order->ContactName->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($vt_order->Address->Visible) { // Address ?>
	<tr id="r_Address">
		<td class="<?php echo $vt_order_view->TableLeftColumnClass ?>"><span id="elh_vt_order_Address"><?php echo $vt_order->Address->caption() ?></span></td>
		<td data-name="Address"<?php echo $vt_order->Address->cellAttributes() ?>>
<span id="el_vt_order_Address">
<span<?php echo $vt_order->Address->viewAttributes() ?>>
<?php echo $vt_order->Address->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($vt_order->CompanyName->Visible) { // CompanyName ?>
	<tr id="r_CompanyName">
		<td class="<?php echo $vt_order_view->TableLeftColumnClass ?>"><span id="elh_vt_order_CompanyName"><?php echo $vt_order->CompanyName->caption() ?></span></td>
		<td data-name="CompanyName"<?php echo $vt_order->CompanyName->cellAttributes() ?>>
<span id="el_vt_order_CompanyName">
<span<?php echo $vt_order->CompanyName->viewAttributes() ?>>
<?php echo $vt_order->CompanyName->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($vt_order->ContactEmail->Visible) { // ContactEmail ?>
	<tr id="r_ContactEmail">
		<td class="<?php echo $vt_order_view->TableLeftColumnClass ?>"><span id="elh_vt_order_ContactEmail"><?php echo $vt_order->ContactEmail->caption() ?></span></td>
		<td data-name="ContactEmail"<?php echo $vt_order->ContactEmail->cellAttributes() ?>>
<span id="el_vt_order_ContactEmail">
<span<?php echo $vt_order->ContactEmail->viewAttributes() ?>>
<?php echo $vt_order->ContactEmail->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($vt_order->ContactPhone->Visible) { // ContactPhone ?>
	<tr id="r_ContactPhone">
		<td class="<?php echo $vt_order_view->TableLeftColumnClass ?>"><span id="elh_vt_order_ContactPhone"><?php echo $vt_order->ContactPhone->caption() ?></span></td>
		<td data-name="ContactPhone"<?php echo $vt_order->ContactPhone->cellAttributes() ?>>
<span id="el_vt_order_ContactPhone">
<span<?php echo $vt_order->ContactPhone->viewAttributes() ?>>
<?php echo $vt_order->ContactPhone->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
</table>
<?php
	if (in_array("vt_orderguide", explode(",", $vt_order->getCurrentDetailTable())) && $vt_orderguide->DetailView) {
?>
<?php if ($vt_order->getCurrentDetailTable() <> "") { ?>
<h4 class="ew-detail-caption"><?php echo $Language->TablePhrase("vt_orderguide", "TblCaption") ?>&nbsp;<?php echo str_replace("%c", $vt_order_view->vt_orderguide_Count, $Language->phrase("DetailCount")) ?></h4>
<?php } ?>
<?php include_once "vt_orderguidegrid.php" ?>
<?php } ?>
</form>
<?php
$vt_order_view->showPageFooter();
if (DEBUG_ENABLED)
	echo GetDebugMessage();
?>
<?php if (!$vt_order->isExport()) { ?>
<script>

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php } ?>
<?php include_once "footer.php" ?>
<?php
$vt_order_view->terminate();
?>