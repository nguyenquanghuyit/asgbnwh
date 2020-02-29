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
$tbl_dealer_view = new tbl_dealer_view();

// Run the page
$tbl_dealer_view->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$tbl_dealer_view->Page_Render();
?>
<?php include_once "header.php" ?>
<?php if (!$tbl_dealer->isExport()) { ?>
<script>

// Form object
currentPageID = ew.PAGE_ID = "view";
var ftbl_dealerview = currentForm = new ew.Form("ftbl_dealerview", "view");

// Form_CustomValidate event
ftbl_dealerview.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

	// Your custom validation code here, return false if invalid.
	return true;
}

// Use JavaScript validation or not
ftbl_dealerview.validateRequired = <?php echo json_encode(CLIENT_VALIDATE) ?>;

// Dynamic selection lists
// Form object for search

</script>
<script>

// Write your client script here, no need to add script tags.
</script>
<?php } ?>
<?php if (!$tbl_dealer->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php $tbl_dealer_view->ExportOptions->render("body") ?>
<?php $tbl_dealer_view->OtherOptions->render("body") ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php $tbl_dealer_view->showPageHeader(); ?>
<?php
$tbl_dealer_view->showMessage();
?>
<form name="ftbl_dealerview" id="ftbl_dealerview" class="form-inline ew-form ew-view-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($tbl_dealer_view->CheckToken) { ?>
<input type="hidden" name="<?php echo TOKEN_NAME ?>" value="<?php echo $tbl_dealer_view->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="tbl_dealer">
<input type="hidden" name="modal" value="<?php echo (int)$tbl_dealer_view->IsModal ?>">
<table class="table table-striped table-sm ew-view-table">
<?php if ($tbl_dealer->ID_Dealer->Visible) { // ID_Dealer ?>
	<tr id="r_ID_Dealer">
		<td class="<?php echo $tbl_dealer_view->TableLeftColumnClass ?>"><span id="elh_tbl_dealer_ID_Dealer"><?php echo $tbl_dealer->ID_Dealer->caption() ?></span></td>
		<td data-name="ID_Dealer"<?php echo $tbl_dealer->ID_Dealer->cellAttributes() ?>>
<span id="el_tbl_dealer_ID_Dealer">
<span<?php echo $tbl_dealer->ID_Dealer->viewAttributes() ?>>
<?php echo $tbl_dealer->ID_Dealer->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($tbl_dealer->DealerName->Visible) { // DealerName ?>
	<tr id="r_DealerName">
		<td class="<?php echo $tbl_dealer_view->TableLeftColumnClass ?>"><span id="elh_tbl_dealer_DealerName"><?php echo $tbl_dealer->DealerName->caption() ?></span></td>
		<td data-name="DealerName"<?php echo $tbl_dealer->DealerName->cellAttributes() ?>>
<span id="el_tbl_dealer_DealerName">
<span<?php echo $tbl_dealer->DealerName->viewAttributes() ?>>
<?php echo $tbl_dealer->DealerName->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($tbl_dealer->Address->Visible) { // Address ?>
	<tr id="r_Address">
		<td class="<?php echo $tbl_dealer_view->TableLeftColumnClass ?>"><span id="elh_tbl_dealer_Address"><?php echo $tbl_dealer->Address->caption() ?></span></td>
		<td data-name="Address"<?php echo $tbl_dealer->Address->cellAttributes() ?>>
<span id="el_tbl_dealer_Address">
<span<?php echo $tbl_dealer->Address->viewAttributes() ?>>
<?php echo $tbl_dealer->Address->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
</table>
</form>
<?php
$tbl_dealer_view->showPageFooter();
if (DEBUG_ENABLED)
	echo GetDebugMessage();
?>
<?php if (!$tbl_dealer->isExport()) { ?>
<script>

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php } ?>
<?php include_once "footer.php" ?>
<?php
$tbl_dealer_view->terminate();
?>