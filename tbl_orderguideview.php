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
$tbl_orderguide_view = new tbl_orderguide_view();

// Run the page
$tbl_orderguide_view->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$tbl_orderguide_view->Page_Render();
?>
<?php include_once "header.php" ?>
<?php if (!$tbl_orderguide->isExport()) { ?>
<script>

// Form object
currentPageID = ew.PAGE_ID = "view";
var ftbl_orderguideview = currentForm = new ew.Form("ftbl_orderguideview", "view");

// Form_CustomValidate event
ftbl_orderguideview.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

	// Your custom validation code here, return false if invalid.
	return true;
}

// Use JavaScript validation or not
ftbl_orderguideview.validateRequired = <?php echo json_encode(CLIENT_VALIDATE) ?>;

// Dynamic selection lists
// Form object for search

</script>
<script>

// Write your client script here, no need to add script tags.
</script>
<?php } ?>
<?php if (!$tbl_orderguide->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php $tbl_orderguide_view->ExportOptions->render("body") ?>
<?php $tbl_orderguide_view->OtherOptions->render("body") ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php $tbl_orderguide_view->showPageHeader(); ?>
<?php
$tbl_orderguide_view->showMessage();
?>
<form name="ftbl_orderguideview" id="ftbl_orderguideview" class="form-inline ew-form ew-view-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($tbl_orderguide_view->CheckToken) { ?>
<input type="hidden" name="<?php echo TOKEN_NAME ?>" value="<?php echo $tbl_orderguide_view->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="tbl_orderguide">
<input type="hidden" name="modal" value="<?php echo (int)$tbl_orderguide_view->IsModal ?>">
<table class="table table-striped table-sm ew-view-table">
<?php if ($tbl_orderguide->ID_Guide->Visible) { // ID_Guide ?>
	<tr id="r_ID_Guide">
		<td class="<?php echo $tbl_orderguide_view->TableLeftColumnClass ?>"><span id="elh_tbl_orderguide_ID_Guide"><?php echo $tbl_orderguide->ID_Guide->caption() ?></span></td>
		<td data-name="ID_Guide"<?php echo $tbl_orderguide->ID_Guide->cellAttributes() ?>>
<span id="el_tbl_orderguide_ID_Guide">
<span<?php echo $tbl_orderguide->ID_Guide->viewAttributes() ?>>
<?php echo $tbl_orderguide->ID_Guide->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($tbl_orderguide->OrderNo->Visible) { // OrderNo ?>
	<tr id="r_OrderNo">
		<td class="<?php echo $tbl_orderguide_view->TableLeftColumnClass ?>"><span id="elh_tbl_orderguide_OrderNo"><?php echo $tbl_orderguide->OrderNo->caption() ?></span></td>
		<td data-name="OrderNo"<?php echo $tbl_orderguide->OrderNo->cellAttributes() ?>>
<span id="el_tbl_orderguide_OrderNo">
<span<?php echo $tbl_orderguide->OrderNo->viewAttributes() ?>>
<?php echo $tbl_orderguide->OrderNo->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($tbl_orderguide->Code->Visible) { // Code ?>
	<tr id="r_Code">
		<td class="<?php echo $tbl_orderguide_view->TableLeftColumnClass ?>"><span id="elh_tbl_orderguide_Code"><?php echo $tbl_orderguide->Code->caption() ?></span></td>
		<td data-name="Code"<?php echo $tbl_orderguide->Code->cellAttributes() ?>>
<span id="el_tbl_orderguide_Code">
<span<?php echo $tbl_orderguide->Code->viewAttributes() ?>>
<?php echo $tbl_orderguide->Code->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($tbl_orderguide->PCS->Visible) { // PCS ?>
	<tr id="r_PCS">
		<td class="<?php echo $tbl_orderguide_view->TableLeftColumnClass ?>"><span id="elh_tbl_orderguide_PCS"><?php echo $tbl_orderguide->PCS->caption() ?></span></td>
		<td data-name="PCS"<?php echo $tbl_orderguide->PCS->cellAttributes() ?>>
<span id="el_tbl_orderguide_PCS">
<span<?php echo $tbl_orderguide->PCS->viewAttributes() ?>>
<?php echo $tbl_orderguide->PCS->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($tbl_orderguide->ID_Location->Visible) { // ID_Location ?>
	<tr id="r_ID_Location">
		<td class="<?php echo $tbl_orderguide_view->TableLeftColumnClass ?>"><span id="elh_tbl_orderguide_ID_Location"><?php echo $tbl_orderguide->ID_Location->caption() ?></span></td>
		<td data-name="ID_Location"<?php echo $tbl_orderguide->ID_Location->cellAttributes() ?>>
<span id="el_tbl_orderguide_ID_Location">
<span<?php echo $tbl_orderguide->ID_Location->viewAttributes() ?>>
<?php echo $tbl_orderguide->ID_Location->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($tbl_orderguide->Note_PickUp->Visible) { // Note_PickUp ?>
	<tr id="r_Note_PickUp">
		<td class="<?php echo $tbl_orderguide_view->TableLeftColumnClass ?>"><span id="elh_tbl_orderguide_Note_PickUp"><?php echo $tbl_orderguide->Note_PickUp->caption() ?></span></td>
		<td data-name="Note_PickUp"<?php echo $tbl_orderguide->Note_PickUp->cellAttributes() ?>>
<span id="el_tbl_orderguide_Note_PickUp">
<span<?php echo $tbl_orderguide->Note_PickUp->viewAttributes() ?>>
<?php echo $tbl_orderguide->Note_PickUp->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
</table>
</form>
<?php
$tbl_orderguide_view->showPageFooter();
if (DEBUG_ENABLED)
	echo GetDebugMessage();
?>
<?php if (!$tbl_orderguide->isExport()) { ?>
<script>

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php } ?>
<?php include_once "footer.php" ?>
<?php
$tbl_orderguide_view->terminate();
?>