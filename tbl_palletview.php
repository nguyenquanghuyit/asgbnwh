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
$tbl_pallet_view = new tbl_pallet_view();

// Run the page
$tbl_pallet_view->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$tbl_pallet_view->Page_Render();
?>
<?php include_once "header.php" ?>
<?php if (!$tbl_pallet->isExport()) { ?>
<script>

// Form object
currentPageID = ew.PAGE_ID = "view";
var ftbl_palletview = currentForm = new ew.Form("ftbl_palletview", "view");

// Form_CustomValidate event
ftbl_palletview.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

	// Your custom validation code here, return false if invalid.
	return true;
}

// Use JavaScript validation or not
ftbl_palletview.validateRequired = <?php echo json_encode(CLIENT_VALIDATE) ?>;

// Dynamic selection lists
// Form object for search

</script>
<script>

// Write your client script here, no need to add script tags.
</script>
<?php } ?>
<?php if (!$tbl_pallet->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php $tbl_pallet_view->ExportOptions->render("body") ?>
<?php $tbl_pallet_view->OtherOptions->render("body") ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php $tbl_pallet_view->showPageHeader(); ?>
<?php
$tbl_pallet_view->showMessage();
?>
<form name="ftbl_palletview" id="ftbl_palletview" class="form-inline ew-form ew-view-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($tbl_pallet_view->CheckToken) { ?>
<input type="hidden" name="<?php echo TOKEN_NAME ?>" value="<?php echo $tbl_pallet_view->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="tbl_pallet">
<input type="hidden" name="modal" value="<?php echo (int)$tbl_pallet_view->IsModal ?>">
<table class="table table-striped table-sm ew-view-table">
<?php if ($tbl_pallet->PalletID->Visible) { // PalletID ?>
	<tr id="r_PalletID">
		<td class="<?php echo $tbl_pallet_view->TableLeftColumnClass ?>"><span id="elh_tbl_pallet_PalletID"><?php echo $tbl_pallet->PalletID->caption() ?></span></td>
		<td data-name="PalletID"<?php echo $tbl_pallet->PalletID->cellAttributes() ?>>
<span id="el_tbl_pallet_PalletID">
<span<?php echo $tbl_pallet->PalletID->viewAttributes() ?>>
<?php echo $tbl_pallet->PalletID->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($tbl_pallet->Code->Visible) { // Code ?>
	<tr id="r_Code">
		<td class="<?php echo $tbl_pallet_view->TableLeftColumnClass ?>"><span id="elh_tbl_pallet_Code"><?php echo $tbl_pallet->Code->caption() ?></span></td>
		<td data-name="Code"<?php echo $tbl_pallet->Code->cellAttributes() ?>>
<span id="el_tbl_pallet_Code">
<span<?php echo $tbl_pallet->Code->viewAttributes() ?>>
<?php echo $tbl_pallet->Code->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($tbl_pallet->PCS->Visible) { // PCS ?>
	<tr id="r_PCS">
		<td class="<?php echo $tbl_pallet_view->TableLeftColumnClass ?>"><span id="elh_tbl_pallet_PCS"><?php echo $tbl_pallet->PCS->caption() ?></span></td>
		<td data-name="PCS"<?php echo $tbl_pallet->PCS->cellAttributes() ?>>
<span id="el_tbl_pallet_PCS">
<span<?php echo $tbl_pallet->PCS->viewAttributes() ?>>
<?php echo $tbl_pallet->PCS->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($tbl_pallet->ExistStatus->Visible) { // ExistStatus ?>
	<tr id="r_ExistStatus">
		<td class="<?php echo $tbl_pallet_view->TableLeftColumnClass ?>"><span id="elh_tbl_pallet_ExistStatus"><?php echo $tbl_pallet->ExistStatus->caption() ?></span></td>
		<td data-name="ExistStatus"<?php echo $tbl_pallet->ExistStatus->cellAttributes() ?>>
<span id="el_tbl_pallet_ExistStatus">
<span<?php echo $tbl_pallet->ExistStatus->viewAttributes() ?>>
<?php echo $tbl_pallet->ExistStatus->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($tbl_pallet->UserCreate->Visible) { // UserCreate ?>
	<tr id="r_UserCreate">
		<td class="<?php echo $tbl_pallet_view->TableLeftColumnClass ?>"><span id="elh_tbl_pallet_UserCreate"><?php echo $tbl_pallet->UserCreate->caption() ?></span></td>
		<td data-name="UserCreate"<?php echo $tbl_pallet->UserCreate->cellAttributes() ?>>
<span id="el_tbl_pallet_UserCreate">
<span<?php echo $tbl_pallet->UserCreate->viewAttributes() ?>>
<?php echo $tbl_pallet->UserCreate->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($tbl_pallet->DateTimeCreate->Visible) { // DateTimeCreate ?>
	<tr id="r_DateTimeCreate">
		<td class="<?php echo $tbl_pallet_view->TableLeftColumnClass ?>"><span id="elh_tbl_pallet_DateTimeCreate"><?php echo $tbl_pallet->DateTimeCreate->caption() ?></span></td>
		<td data-name="DateTimeCreate"<?php echo $tbl_pallet->DateTimeCreate->cellAttributes() ?>>
<span id="el_tbl_pallet_DateTimeCreate">
<span<?php echo $tbl_pallet->DateTimeCreate->viewAttributes() ?>>
<?php echo $tbl_pallet->DateTimeCreate->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
</table>
</form>
<?php
$tbl_pallet_view->showPageFooter();
if (DEBUG_ENABLED)
	echo GetDebugMessage();
?>
<?php if (!$tbl_pallet->isExport()) { ?>
<script>

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php } ?>
<?php include_once "footer.php" ?>
<?php
$tbl_pallet_view->terminate();
?>