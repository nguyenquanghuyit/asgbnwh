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
$tbl_history_view = new tbl_history_view();

// Run the page
$tbl_history_view->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$tbl_history_view->Page_Render();
?>
<?php include_once "header.php" ?>
<?php if (!$tbl_history->isExport()) { ?>
<script>

// Form object
currentPageID = ew.PAGE_ID = "view";
var ftbl_historyview = currentForm = new ew.Form("ftbl_historyview", "view");

// Form_CustomValidate event
ftbl_historyview.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

	// Your custom validation code here, return false if invalid.
	return true;
}

// Use JavaScript validation or not
ftbl_historyview.validateRequired = <?php echo json_encode(CLIENT_VALIDATE) ?>;

// Dynamic selection lists
// Form object for search

</script>
<script>

// Write your client script here, no need to add script tags.
</script>
<?php } ?>
<?php if (!$tbl_history->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php $tbl_history_view->ExportOptions->render("body") ?>
<?php $tbl_history_view->OtherOptions->render("body") ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php $tbl_history_view->showPageHeader(); ?>
<?php
$tbl_history_view->showMessage();
?>
<form name="ftbl_historyview" id="ftbl_historyview" class="form-inline ew-form ew-view-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($tbl_history_view->CheckToken) { ?>
<input type="hidden" name="<?php echo TOKEN_NAME ?>" value="<?php echo $tbl_history_view->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="tbl_history">
<input type="hidden" name="modal" value="<?php echo (int)$tbl_history_view->IsModal ?>">
<table class="table table-striped table-sm ew-view-table">
<?php if ($tbl_history->ID_His->Visible) { // ID_His ?>
	<tr id="r_ID_His">
		<td class="<?php echo $tbl_history_view->TableLeftColumnClass ?>"><span id="elh_tbl_history_ID_His"><?php echo $tbl_history->ID_His->caption() ?></span></td>
		<td data-name="ID_His"<?php echo $tbl_history->ID_His->cellAttributes() ?>>
<span id="el_tbl_history_ID_His">
<span<?php echo $tbl_history->ID_His->viewAttributes() ?>>
<?php echo $tbl_history->ID_His->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($tbl_history->PalletID->Visible) { // PalletID ?>
	<tr id="r_PalletID">
		<td class="<?php echo $tbl_history_view->TableLeftColumnClass ?>"><span id="elh_tbl_history_PalletID"><?php echo $tbl_history->PalletID->caption() ?></span></td>
		<td data-name="PalletID"<?php echo $tbl_history->PalletID->cellAttributes() ?>>
<span id="el_tbl_history_PalletID">
<span<?php echo $tbl_history->PalletID->viewAttributes() ?>>
<?php echo $tbl_history->PalletID->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($tbl_history->ID_Location->Visible) { // ID_Location ?>
	<tr id="r_ID_Location">
		<td class="<?php echo $tbl_history_view->TableLeftColumnClass ?>"><span id="elh_tbl_history_ID_Location"><?php echo $tbl_history->ID_Location->caption() ?></span></td>
		<td data-name="ID_Location"<?php echo $tbl_history->ID_Location->cellAttributes() ?>>
<span id="el_tbl_history_ID_Location">
<span<?php echo $tbl_history->ID_Location->viewAttributes() ?>>
<?php echo $tbl_history->ID_Location->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($tbl_history->PCS->Visible) { // PCS ?>
	<tr id="r_PCS">
		<td class="<?php echo $tbl_history_view->TableLeftColumnClass ?>"><span id="elh_tbl_history_PCS"><?php echo $tbl_history->PCS->caption() ?></span></td>
		<td data-name="PCS"<?php echo $tbl_history->PCS->cellAttributes() ?>>
<span id="el_tbl_history_PCS">
<span<?php echo $tbl_history->PCS->viewAttributes() ?>>
<?php echo $tbl_history->PCS->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
</table>
</form>
<?php
$tbl_history_view->showPageFooter();
if (DEBUG_ENABLED)
	echo GetDebugMessage();
?>
<?php if (!$tbl_history->isExport()) { ?>
<script>

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php } ?>
<?php include_once "footer.php" ?>
<?php
$tbl_history_view->terminate();
?>