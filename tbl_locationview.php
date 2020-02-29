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
$tbl_location_view = new tbl_location_view();

// Run the page
$tbl_location_view->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$tbl_location_view->Page_Render();
?>
<?php include_once "header.php" ?>
<?php if (!$tbl_location->isExport()) { ?>
<script>

// Form object
currentPageID = ew.PAGE_ID = "view";
var ftbl_locationview = currentForm = new ew.Form("ftbl_locationview", "view");

// Form_CustomValidate event
ftbl_locationview.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

	// Your custom validation code here, return false if invalid.
	return true;
}

// Use JavaScript validation or not
ftbl_locationview.validateRequired = <?php echo json_encode(CLIENT_VALIDATE) ?>;

// Dynamic selection lists
// Form object for search

</script>
<script>

// Write your client script here, no need to add script tags.
</script>
<?php } ?>
<?php if (!$tbl_location->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php $tbl_location_view->ExportOptions->render("body") ?>
<?php $tbl_location_view->OtherOptions->render("body") ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php $tbl_location_view->showPageHeader(); ?>
<?php
$tbl_location_view->showMessage();
?>
<form name="ftbl_locationview" id="ftbl_locationview" class="form-inline ew-form ew-view-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($tbl_location_view->CheckToken) { ?>
<input type="hidden" name="<?php echo TOKEN_NAME ?>" value="<?php echo $tbl_location_view->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="tbl_location">
<input type="hidden" name="modal" value="<?php echo (int)$tbl_location_view->IsModal ?>">
<table class="table table-striped table-sm ew-view-table">
<?php if ($tbl_location->ID_Location->Visible) { // ID_Location ?>
	<tr id="r_ID_Location">
		<td class="<?php echo $tbl_location_view->TableLeftColumnClass ?>"><span id="elh_tbl_location_ID_Location"><?php echo $tbl_location->ID_Location->caption() ?></span></td>
		<td data-name="ID_Location"<?php echo $tbl_location->ID_Location->cellAttributes() ?>>
<span id="el_tbl_location_ID_Location">
<span<?php echo $tbl_location->ID_Location->viewAttributes() ?>>
<?php echo $tbl_location->ID_Location->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($tbl_location->Location->Visible) { // Location ?>
	<tr id="r_Location">
		<td class="<?php echo $tbl_location_view->TableLeftColumnClass ?>"><span id="elh_tbl_location_Location"><?php echo $tbl_location->Location->caption() ?></span></td>
		<td data-name="Location"<?php echo $tbl_location->Location->cellAttributes() ?>>
<span id="el_tbl_location_Location">
<span<?php echo $tbl_location->Location->viewAttributes() ?>>
<?php echo $tbl_location->Location->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($tbl_location->Description->Visible) { // Description ?>
	<tr id="r_Description">
		<td class="<?php echo $tbl_location_view->TableLeftColumnClass ?>"><span id="elh_tbl_location_Description"><?php echo $tbl_location->Description->caption() ?></span></td>
		<td data-name="Description"<?php echo $tbl_location->Description->cellAttributes() ?>>
<span id="el_tbl_location_Description">
<span<?php echo $tbl_location->Description->viewAttributes() ?>>
<?php echo $tbl_location->Description->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
</table>
</form>
<?php
$tbl_location_view->showPageFooter();
if (DEBUG_ENABLED)
	echo GetDebugMessage();
?>
<?php if (!$tbl_location->isExport()) { ?>
<script>

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php } ?>
<?php include_once "footer.php" ?>
<?php
$tbl_location_view->terminate();
?>