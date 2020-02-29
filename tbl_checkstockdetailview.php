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
$tbl_checkstockdetail_view = new tbl_checkstockdetail_view();

// Run the page
$tbl_checkstockdetail_view->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$tbl_checkstockdetail_view->Page_Render();
?>
<?php include_once "header.php" ?>
<?php if (!$tbl_checkstockdetail->isExport()) { ?>
<script>

// Form object
currentPageID = ew.PAGE_ID = "view";
var ftbl_checkstockdetailview = currentForm = new ew.Form("ftbl_checkstockdetailview", "view");

// Form_CustomValidate event
ftbl_checkstockdetailview.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

	// Your custom validation code here, return false if invalid.
	return true;
}

// Use JavaScript validation or not
ftbl_checkstockdetailview.validateRequired = <?php echo json_encode(CLIENT_VALIDATE) ?>;

// Dynamic selection lists
// Form object for search

</script>
<script>

// Write your client script here, no need to add script tags.
</script>
<?php } ?>
<?php if (!$tbl_checkstockdetail->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php $tbl_checkstockdetail_view->ExportOptions->render("body") ?>
<?php $tbl_checkstockdetail_view->OtherOptions->render("body") ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php $tbl_checkstockdetail_view->showPageHeader(); ?>
<?php
$tbl_checkstockdetail_view->showMessage();
?>
<form name="ftbl_checkstockdetailview" id="ftbl_checkstockdetailview" class="form-inline ew-form ew-view-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($tbl_checkstockdetail_view->CheckToken) { ?>
<input type="hidden" name="<?php echo TOKEN_NAME ?>" value="<?php echo $tbl_checkstockdetail_view->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="tbl_checkstockdetail">
<input type="hidden" name="modal" value="<?php echo (int)$tbl_checkstockdetail_view->IsModal ?>">
<table class="table table-striped table-sm ew-view-table">
<?php if ($tbl_checkstockdetail->Location->Visible) { // Location ?>
	<tr id="r_Location">
		<td class="<?php echo $tbl_checkstockdetail_view->TableLeftColumnClass ?>"><span id="elh_tbl_checkstockdetail_Location"><?php echo $tbl_checkstockdetail->Location->caption() ?></span></td>
		<td data-name="Location"<?php echo $tbl_checkstockdetail->Location->cellAttributes() ?>>
<span id="el_tbl_checkstockdetail_Location">
<span<?php echo $tbl_checkstockdetail->Location->viewAttributes() ?>>
<?php echo $tbl_checkstockdetail->Location->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($tbl_checkstockdetail->PalletID->Visible) { // PalletID ?>
	<tr id="r_PalletID">
		<td class="<?php echo $tbl_checkstockdetail_view->TableLeftColumnClass ?>"><span id="elh_tbl_checkstockdetail_PalletID"><?php echo $tbl_checkstockdetail->PalletID->caption() ?></span></td>
		<td data-name="PalletID"<?php echo $tbl_checkstockdetail->PalletID->cellAttributes() ?>>
<span id="el_tbl_checkstockdetail_PalletID">
<span<?php echo $tbl_checkstockdetail->PalletID->viewAttributes() ?>>
<?php echo $tbl_checkstockdetail->PalletID->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($tbl_checkstockdetail->Code->Visible) { // Code ?>
	<tr id="r_Code">
		<td class="<?php echo $tbl_checkstockdetail_view->TableLeftColumnClass ?>"><span id="elh_tbl_checkstockdetail_Code"><?php echo $tbl_checkstockdetail->Code->caption() ?></span></td>
		<td data-name="Code"<?php echo $tbl_checkstockdetail->Code->cellAttributes() ?>>
<span id="el_tbl_checkstockdetail_Code">
<span<?php echo $tbl_checkstockdetail->Code->viewAttributes() ?>>
<?php echo $tbl_checkstockdetail->Code->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($tbl_checkstockdetail->PCS->Visible) { // PCS ?>
	<tr id="r_PCS">
		<td class="<?php echo $tbl_checkstockdetail_view->TableLeftColumnClass ?>"><span id="elh_tbl_checkstockdetail_PCS"><?php echo $tbl_checkstockdetail->PCS->caption() ?></span></td>
		<td data-name="PCS"<?php echo $tbl_checkstockdetail->PCS->cellAttributes() ?>>
<span id="el_tbl_checkstockdetail_PCS">
<span<?php echo $tbl_checkstockdetail->PCS->viewAttributes() ?>>
<?php echo $tbl_checkstockdetail->PCS->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($tbl_checkstockdetail->DateTimeCheck->Visible) { // DateTimeCheck ?>
	<tr id="r_DateTimeCheck">
		<td class="<?php echo $tbl_checkstockdetail_view->TableLeftColumnClass ?>"><span id="elh_tbl_checkstockdetail_DateTimeCheck"><?php echo $tbl_checkstockdetail->DateTimeCheck->caption() ?></span></td>
		<td data-name="DateTimeCheck"<?php echo $tbl_checkstockdetail->DateTimeCheck->cellAttributes() ?>>
<span id="el_tbl_checkstockdetail_DateTimeCheck">
<span<?php echo $tbl_checkstockdetail->DateTimeCheck->viewAttributes() ?>>
<?php echo $tbl_checkstockdetail->DateTimeCheck->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($tbl_checkstockdetail->UserCheck->Visible) { // UserCheck ?>
	<tr id="r_UserCheck">
		<td class="<?php echo $tbl_checkstockdetail_view->TableLeftColumnClass ?>"><span id="elh_tbl_checkstockdetail_UserCheck"><?php echo $tbl_checkstockdetail->UserCheck->caption() ?></span></td>
		<td data-name="UserCheck"<?php echo $tbl_checkstockdetail->UserCheck->cellAttributes() ?>>
<span id="el_tbl_checkstockdetail_UserCheck">
<span<?php echo $tbl_checkstockdetail->UserCheck->viewAttributes() ?>>
<?php echo $tbl_checkstockdetail->UserCheck->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($tbl_checkstockdetail->Usercreate->Visible) { // Usercreate ?>
	<tr id="r_Usercreate">
		<td class="<?php echo $tbl_checkstockdetail_view->TableLeftColumnClass ?>"><span id="elh_tbl_checkstockdetail_Usercreate"><?php echo $tbl_checkstockdetail->Usercreate->caption() ?></span></td>
		<td data-name="Usercreate"<?php echo $tbl_checkstockdetail->Usercreate->cellAttributes() ?>>
<span id="el_tbl_checkstockdetail_Usercreate">
<span<?php echo $tbl_checkstockdetail->Usercreate->viewAttributes() ?>>
<?php echo $tbl_checkstockdetail->Usercreate->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($tbl_checkstockdetail->DatetimeCreate->Visible) { // DatetimeCreate ?>
	<tr id="r_DatetimeCreate">
		<td class="<?php echo $tbl_checkstockdetail_view->TableLeftColumnClass ?>"><span id="elh_tbl_checkstockdetail_DatetimeCreate"><?php echo $tbl_checkstockdetail->DatetimeCreate->caption() ?></span></td>
		<td data-name="DatetimeCreate"<?php echo $tbl_checkstockdetail->DatetimeCreate->cellAttributes() ?>>
<span id="el_tbl_checkstockdetail_DatetimeCreate">
<span<?php echo $tbl_checkstockdetail->DatetimeCreate->viewAttributes() ?>>
<?php echo $tbl_checkstockdetail->DatetimeCreate->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
</table>
</form>
<?php
$tbl_checkstockdetail_view->showPageFooter();
if (DEBUG_ENABLED)
	echo GetDebugMessage();
?>
<?php if (!$tbl_checkstockdetail->isExport()) { ?>
<script>

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php } ?>
<?php include_once "footer.php" ?>
<?php
$tbl_checkstockdetail_view->terminate();
?>