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
$tbl_product_view = new tbl_product_view();

// Run the page
$tbl_product_view->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$tbl_product_view->Page_Render();
?>
<?php include_once "header.php" ?>
<?php if (!$tbl_product->isExport()) { ?>
<script>

// Form object
currentPageID = ew.PAGE_ID = "view";
var ftbl_productview = currentForm = new ew.Form("ftbl_productview", "view");

// Form_CustomValidate event
ftbl_productview.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

	// Your custom validation code here, return false if invalid.
	return true;
}

// Use JavaScript validation or not
ftbl_productview.validateRequired = <?php echo json_encode(CLIENT_VALIDATE) ?>;

// Dynamic selection lists
// Form object for search

</script>
<script>

// Write your client script here, no need to add script tags.
</script>
<?php } ?>
<?php if (!$tbl_product->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php $tbl_product_view->ExportOptions->render("body") ?>
<?php $tbl_product_view->OtherOptions->render("body") ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php $tbl_product_view->showPageHeader(); ?>
<?php
$tbl_product_view->showMessage();
?>
<form name="ftbl_productview" id="ftbl_productview" class="form-inline ew-form ew-view-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($tbl_product_view->CheckToken) { ?>
<input type="hidden" name="<?php echo TOKEN_NAME ?>" value="<?php echo $tbl_product_view->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="tbl_product">
<input type="hidden" name="modal" value="<?php echo (int)$tbl_product_view->IsModal ?>">
<table class="table table-striped table-sm ew-view-table">
<?php if ($tbl_product->Code->Visible) { // Code ?>
	<tr id="r_Code">
		<td class="<?php echo $tbl_product_view->TableLeftColumnClass ?>"><span id="elh_tbl_product_Code"><?php echo $tbl_product->Code->caption() ?></span></td>
		<td data-name="Code"<?php echo $tbl_product->Code->cellAttributes() ?>>
<span id="el_tbl_product_Code">
<span<?php echo $tbl_product->Code->viewAttributes() ?>>
<?php echo $tbl_product->Code->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($tbl_product->Model->Visible) { // Model ?>
	<tr id="r_Model">
		<td class="<?php echo $tbl_product_view->TableLeftColumnClass ?>"><span id="elh_tbl_product_Model"><?php echo $tbl_product->Model->caption() ?></span></td>
		<td data-name="Model"<?php echo $tbl_product->Model->cellAttributes() ?>>
<span id="el_tbl_product_Model">
<span<?php echo $tbl_product->Model->viewAttributes() ?>>
<?php echo $tbl_product->Model->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($tbl_product->ProductName->Visible) { // ProductName ?>
	<tr id="r_ProductName">
		<td class="<?php echo $tbl_product_view->TableLeftColumnClass ?>"><span id="elh_tbl_product_ProductName"><?php echo $tbl_product->ProductName->caption() ?></span></td>
		<td data-name="ProductName"<?php echo $tbl_product->ProductName->cellAttributes() ?>>
<span id="el_tbl_product_ProductName">
<span<?php echo $tbl_product->ProductName->viewAttributes() ?>>
<?php echo $tbl_product->ProductName->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($tbl_product->VnName->Visible) { // VnName ?>
	<tr id="r_VnName">
		<td class="<?php echo $tbl_product_view->TableLeftColumnClass ?>"><span id="elh_tbl_product_VnName"><?php echo $tbl_product->VnName->caption() ?></span></td>
		<td data-name="VnName"<?php echo $tbl_product->VnName->cellAttributes() ?>>
<span id="el_tbl_product_VnName">
<span<?php echo $tbl_product->VnName->viewAttributes() ?>>
<?php echo $tbl_product->VnName->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($tbl_product->Description->Visible) { // Description ?>
	<tr id="r_Description">
		<td class="<?php echo $tbl_product_view->TableLeftColumnClass ?>"><span id="elh_tbl_product_Description"><?php echo $tbl_product->Description->caption() ?></span></td>
		<td data-name="Description"<?php echo $tbl_product->Description->cellAttributes() ?>>
<span id="el_tbl_product_Description">
<span<?php echo $tbl_product->Description->viewAttributes() ?>>
<?php echo $tbl_product->Description->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
</table>
</form>
<?php
$tbl_product_view->showPageFooter();
if (DEBUG_ENABLED)
	echo GetDebugMessage();
?>
<?php if (!$tbl_product->isExport()) { ?>
<script>

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php } ?>
<?php include_once "footer.php" ?>
<?php
$tbl_product_view->terminate();
?>