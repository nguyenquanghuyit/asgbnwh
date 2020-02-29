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
$vt_orderguide_view = new vt_orderguide_view();

// Run the page
$vt_orderguide_view->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$vt_orderguide_view->Page_Render();
?>
<?php include_once "header.php" ?>
<?php if (!$vt_orderguide->isExport()) { ?>
<script>

// Form object
currentPageID = ew.PAGE_ID = "view";
var fvt_orderguideview = currentForm = new ew.Form("fvt_orderguideview", "view");

// Form_CustomValidate event
fvt_orderguideview.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

	// Your custom validation code here, return false if invalid.
	return true;
}

// Use JavaScript validation or not
fvt_orderguideview.validateRequired = <?php echo json_encode(CLIENT_VALIDATE) ?>;

// Dynamic selection lists
// Form object for search

</script>
<script>

// Write your client script here, no need to add script tags.
</script>
<?php } ?>
<?php if (!$vt_orderguide->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php $vt_orderguide_view->ExportOptions->render("body") ?>
<?php $vt_orderguide_view->OtherOptions->render("body") ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php $vt_orderguide_view->showPageHeader(); ?>
<?php
$vt_orderguide_view->showMessage();
?>
<form name="fvt_orderguideview" id="fvt_orderguideview" class="form-inline ew-form ew-view-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($vt_orderguide_view->CheckToken) { ?>
<input type="hidden" name="<?php echo TOKEN_NAME ?>" value="<?php echo $vt_orderguide_view->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="vt_orderguide">
<input type="hidden" name="modal" value="<?php echo (int)$vt_orderguide_view->IsModal ?>">
<table class="table table-striped table-sm ew-view-table">
<?php if ($vt_orderguide->ID_Order->Visible) { // ID_Order ?>
	<tr id="r_ID_Order">
		<td class="<?php echo $vt_orderguide_view->TableLeftColumnClass ?>"><span id="elh_vt_orderguide_ID_Order"><?php echo $vt_orderguide->ID_Order->caption() ?></span></td>
		<td data-name="ID_Order"<?php echo $vt_orderguide->ID_Order->cellAttributes() ?>>
<span id="el_vt_orderguide_ID_Order">
<span<?php echo $vt_orderguide->ID_Order->viewAttributes() ?>>
<?php echo $vt_orderguide->ID_Order->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($vt_orderguide->Code->Visible) { // Code ?>
	<tr id="r_Code">
		<td class="<?php echo $vt_orderguide_view->TableLeftColumnClass ?>"><span id="elh_vt_orderguide_Code"><?php echo $vt_orderguide->Code->caption() ?></span></td>
		<td data-name="Code"<?php echo $vt_orderguide->Code->cellAttributes() ?>>
<span id="el_vt_orderguide_Code">
<span<?php echo $vt_orderguide->Code->viewAttributes() ?>>
<?php echo $vt_orderguide->Code->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($vt_orderguide->ProductName->Visible) { // ProductName ?>
	<tr id="r_ProductName">
		<td class="<?php echo $vt_orderguide_view->TableLeftColumnClass ?>"><span id="elh_vt_orderguide_ProductName"><?php echo $vt_orderguide->ProductName->caption() ?></span></td>
		<td data-name="ProductName"<?php echo $vt_orderguide->ProductName->cellAttributes() ?>>
<span id="el_vt_orderguide_ProductName">
<span<?php echo $vt_orderguide->ProductName->viewAttributes() ?>>
<?php echo $vt_orderguide->ProductName->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($vt_orderguide->PCS->Visible) { // PCS ?>
	<tr id="r_PCS">
		<td class="<?php echo $vt_orderguide_view->TableLeftColumnClass ?>"><span id="elh_vt_orderguide_PCS"><?php echo $vt_orderguide->PCS->caption() ?></span></td>
		<td data-name="PCS"<?php echo $vt_orderguide->PCS->cellAttributes() ?>>
<span id="el_vt_orderguide_PCS">
<span<?php echo $vt_orderguide->PCS->viewAttributes() ?>>
<?php echo $vt_orderguide->PCS->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($vt_orderguide->Location->Visible) { // Location ?>
	<tr id="r_Location">
		<td class="<?php echo $vt_orderguide_view->TableLeftColumnClass ?>"><span id="elh_vt_orderguide_Location"><?php echo $vt_orderguide->Location->caption() ?></span></td>
		<td data-name="Location"<?php echo $vt_orderguide->Location->cellAttributes() ?>>
<span id="el_vt_orderguide_Location">
<span<?php echo $vt_orderguide->Location->viewAttributes() ?>>
<?php echo $vt_orderguide->Location->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($vt_orderguide->OrderDate->Visible) { // OrderDate ?>
	<tr id="r_OrderDate">
		<td class="<?php echo $vt_orderguide_view->TableLeftColumnClass ?>"><span id="elh_vt_orderguide_OrderDate"><?php echo $vt_orderguide->OrderDate->caption() ?></span></td>
		<td data-name="OrderDate"<?php echo $vt_orderguide->OrderDate->cellAttributes() ?>>
<span id="el_vt_orderguide_OrderDate">
<span<?php echo $vt_orderguide->OrderDate->viewAttributes() ?>>
<?php echo $vt_orderguide->OrderDate->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($vt_orderguide->Pcs_Guide->Visible) { // Pcs_Guide ?>
	<tr id="r_Pcs_Guide">
		<td class="<?php echo $vt_orderguide_view->TableLeftColumnClass ?>"><span id="elh_vt_orderguide_Pcs_Guide"><?php echo $vt_orderguide->Pcs_Guide->caption() ?></span></td>
		<td data-name="Pcs_Guide"<?php echo $vt_orderguide->Pcs_Guide->cellAttributes() ?>>
<span id="el_vt_orderguide_Pcs_Guide">
<span<?php echo $vt_orderguide->Pcs_Guide->viewAttributes() ?>>
<?php echo $vt_orderguide->Pcs_Guide->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($vt_orderguide->ContactName->Visible) { // ContactName ?>
	<tr id="r_ContactName">
		<td class="<?php echo $vt_orderguide_view->TableLeftColumnClass ?>"><span id="elh_vt_orderguide_ContactName"><?php echo $vt_orderguide->ContactName->caption() ?></span></td>
		<td data-name="ContactName"<?php echo $vt_orderguide->ContactName->cellAttributes() ?>>
<span id="el_vt_orderguide_ContactName">
<span<?php echo $vt_orderguide->ContactName->viewAttributes() ?>>
<?php echo $vt_orderguide->ContactName->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($vt_orderguide->Address->Visible) { // Address ?>
	<tr id="r_Address">
		<td class="<?php echo $vt_orderguide_view->TableLeftColumnClass ?>"><span id="elh_vt_orderguide_Address"><?php echo $vt_orderguide->Address->caption() ?></span></td>
		<td data-name="Address"<?php echo $vt_orderguide->Address->cellAttributes() ?>>
<span id="el_vt_orderguide_Address">
<span<?php echo $vt_orderguide->Address->viewAttributes() ?>>
<?php echo $vt_orderguide->Address->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($vt_orderguide->ID_Location->Visible) { // ID_Location ?>
	<tr id="r_ID_Location">
		<td class="<?php echo $vt_orderguide_view->TableLeftColumnClass ?>"><span id="elh_vt_orderguide_ID_Location"><?php echo $vt_orderguide->ID_Location->caption() ?></span></td>
		<td data-name="ID_Location"<?php echo $vt_orderguide->ID_Location->cellAttributes() ?>>
<span id="el_vt_orderguide_ID_Location">
<span<?php echo $vt_orderguide->ID_Location->viewAttributes() ?>>
<?php echo $vt_orderguide->ID_Location->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
</table>
</form>
<?php
$vt_orderguide_view->showPageFooter();
if (DEBUG_ENABLED)
	echo GetDebugMessage();
?>
<?php if (!$vt_orderguide->isExport()) { ?>
<script>

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php } ?>
<?php include_once "footer.php" ?>
<?php
$vt_orderguide_view->terminate();
?>