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
$tbl_stock_view = new tbl_stock_view();

// Run the page
$tbl_stock_view->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$tbl_stock_view->Page_Render();
?>
<?php include_once "header.php" ?>
<?php if (!$tbl_stock->isExport()) { ?>
<script>

// Form object
currentPageID = ew.PAGE_ID = "view";
var ftbl_stockview = currentForm = new ew.Form("ftbl_stockview", "view");

// Form_CustomValidate event
ftbl_stockview.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

	// Your custom validation code here, return false if invalid.
	return true;
}

// Use JavaScript validation or not
ftbl_stockview.validateRequired = <?php echo json_encode(CLIENT_VALIDATE) ?>;

// Dynamic selection lists
// Form object for search

</script>
<script>

// Write your client script here, no need to add script tags.
</script>
<?php } ?>
<?php if (!$tbl_stock->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php $tbl_stock_view->ExportOptions->render("body") ?>
<?php $tbl_stock_view->OtherOptions->render("body") ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php $tbl_stock_view->showPageHeader(); ?>
<?php
$tbl_stock_view->showMessage();
?>
<form name="ftbl_stockview" id="ftbl_stockview" class="form-inline ew-form ew-view-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($tbl_stock_view->CheckToken) { ?>
<input type="hidden" name="<?php echo TOKEN_NAME ?>" value="<?php echo $tbl_stock_view->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="tbl_stock">
<input type="hidden" name="modal" value="<?php echo (int)$tbl_stock_view->IsModal ?>">
<table class="table table-striped table-sm ew-view-table">
<?php if ($tbl_stock->ID_Stock->Visible) { // ID_Stock ?>
	<tr id="r_ID_Stock">
		<td class="<?php echo $tbl_stock_view->TableLeftColumnClass ?>"><span id="elh_tbl_stock_ID_Stock"><?php echo $tbl_stock->ID_Stock->caption() ?></span></td>
		<td data-name="ID_Stock"<?php echo $tbl_stock->ID_Stock->cellAttributes() ?>>
<span id="el_tbl_stock_ID_Stock">
<span<?php echo $tbl_stock->ID_Stock->viewAttributes() ?>>
<?php echo $tbl_stock->ID_Stock->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($tbl_stock->PalletID->Visible) { // PalletID ?>
	<tr id="r_PalletID">
		<td class="<?php echo $tbl_stock_view->TableLeftColumnClass ?>"><span id="elh_tbl_stock_PalletID"><?php echo $tbl_stock->PalletID->caption() ?></span></td>
		<td data-name="PalletID"<?php echo $tbl_stock->PalletID->cellAttributes() ?>>
<span id="el_tbl_stock_PalletID">
<span<?php echo $tbl_stock->PalletID->viewAttributes() ?>>
<?php echo $tbl_stock->PalletID->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($tbl_stock->ID_Location->Visible) { // ID_Location ?>
	<tr id="r_ID_Location">
		<td class="<?php echo $tbl_stock_view->TableLeftColumnClass ?>"><span id="elh_tbl_stock_ID_Location"><?php echo $tbl_stock->ID_Location->caption() ?></span></td>
		<td data-name="ID_Location"<?php echo $tbl_stock->ID_Location->cellAttributes() ?>>
<span id="el_tbl_stock_ID_Location">
<span<?php echo $tbl_stock->ID_Location->viewAttributes() ?>>
<?php echo $tbl_stock->ID_Location->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($tbl_stock->PCS->Visible) { // PCS ?>
	<tr id="r_PCS">
		<td class="<?php echo $tbl_stock_view->TableLeftColumnClass ?>"><span id="elh_tbl_stock_PCS"><?php echo $tbl_stock->PCS->caption() ?></span></td>
		<td data-name="PCS"<?php echo $tbl_stock->PCS->cellAttributes() ?>>
<span id="el_tbl_stock_PCS">
<span<?php echo $tbl_stock->PCS->viewAttributes() ?>>
<?php echo $tbl_stock->PCS->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($tbl_stock->DateIn->Visible) { // DateIn ?>
	<tr id="r_DateIn">
		<td class="<?php echo $tbl_stock_view->TableLeftColumnClass ?>"><span id="elh_tbl_stock_DateIn"><?php echo $tbl_stock->DateIn->caption() ?></span></td>
		<td data-name="DateIn"<?php echo $tbl_stock->DateIn->cellAttributes() ?>>
<span id="el_tbl_stock_DateIn">
<span<?php echo $tbl_stock->DateIn->viewAttributes() ?>>
<?php echo $tbl_stock->DateIn->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
</table>
</form>
<?php
$tbl_stock_view->showPageFooter();
if (DEBUG_ENABLED)
	echo GetDebugMessage();
?>
<?php if (!$tbl_stock->isExport()) { ?>
<script>

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php } ?>
<?php include_once "footer.php" ?>
<?php
$tbl_stock_view->terminate();
?>