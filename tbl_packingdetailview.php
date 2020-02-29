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
$tbl_packingdetail_view = new tbl_packingdetail_view();

// Run the page
$tbl_packingdetail_view->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$tbl_packingdetail_view->Page_Render();
?>
<?php include_once "header.php" ?>
<?php if (!$tbl_packingdetail->isExport()) { ?>
<script>

// Form object
currentPageID = ew.PAGE_ID = "view";
var ftbl_packingdetailview = currentForm = new ew.Form("ftbl_packingdetailview", "view");

// Form_CustomValidate event
ftbl_packingdetailview.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

	// Your custom validation code here, return false if invalid.
	return true;
}

// Use JavaScript validation or not
ftbl_packingdetailview.validateRequired = <?php echo json_encode(CLIENT_VALIDATE) ?>;

// Dynamic selection lists
// Form object for search

</script>
<script>

// Write your client script here, no need to add script tags.
</script>
<?php } ?>
<?php if (!$tbl_packingdetail->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php $tbl_packingdetail_view->ExportOptions->render("body") ?>
<?php $tbl_packingdetail_view->OtherOptions->render("body") ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php $tbl_packingdetail_view->showPageHeader(); ?>
<?php
$tbl_packingdetail_view->showMessage();
?>
<form name="ftbl_packingdetailview" id="ftbl_packingdetailview" class="form-inline ew-form ew-view-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($tbl_packingdetail_view->CheckToken) { ?>
<input type="hidden" name="<?php echo TOKEN_NAME ?>" value="<?php echo $tbl_packingdetail_view->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="tbl_packingdetail">
<input type="hidden" name="modal" value="<?php echo (int)$tbl_packingdetail_view->IsModal ?>">
<table class="table table-striped table-sm ew-view-table">
<?php if ($tbl_packingdetail->ID_packingDetail->Visible) { // ID_packingDetail ?>
	<tr id="r_ID_packingDetail">
		<td class="<?php echo $tbl_packingdetail_view->TableLeftColumnClass ?>"><span id="elh_tbl_packingdetail_ID_packingDetail"><?php echo $tbl_packingdetail->ID_packingDetail->caption() ?></span></td>
		<td data-name="ID_packingDetail"<?php echo $tbl_packingdetail->ID_packingDetail->cellAttributes() ?>>
<span id="el_tbl_packingdetail_ID_packingDetail">
<span<?php echo $tbl_packingdetail->ID_packingDetail->viewAttributes() ?>>
<?php echo $tbl_packingdetail->ID_packingDetail->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($tbl_packingdetail->ID_packing->Visible) { // ID_packing ?>
	<tr id="r_ID_packing">
		<td class="<?php echo $tbl_packingdetail_view->TableLeftColumnClass ?>"><span id="elh_tbl_packingdetail_ID_packing"><?php echo $tbl_packingdetail->ID_packing->caption() ?></span></td>
		<td data-name="ID_packing"<?php echo $tbl_packingdetail->ID_packing->cellAttributes() ?>>
<span id="el_tbl_packingdetail_ID_packing">
<span<?php echo $tbl_packingdetail->ID_packing->viewAttributes() ?>>
<?php echo $tbl_packingdetail->ID_packing->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($tbl_packingdetail->PackingType->Visible) { // PackingType ?>
	<tr id="r_PackingType">
		<td class="<?php echo $tbl_packingdetail_view->TableLeftColumnClass ?>"><span id="elh_tbl_packingdetail_PackingType"><?php echo $tbl_packingdetail->PackingType->caption() ?></span></td>
		<td data-name="PackingType"<?php echo $tbl_packingdetail->PackingType->cellAttributes() ?>>
<span id="el_tbl_packingdetail_PackingType">
<span<?php echo $tbl_packingdetail->PackingType->viewAttributes() ?>>
<?php echo $tbl_packingdetail->PackingType->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($tbl_packingdetail->Length->Visible) { // Length ?>
	<tr id="r_Length">
		<td class="<?php echo $tbl_packingdetail_view->TableLeftColumnClass ?>"><span id="elh_tbl_packingdetail_Length"><?php echo $tbl_packingdetail->Length->caption() ?></span></td>
		<td data-name="Length"<?php echo $tbl_packingdetail->Length->cellAttributes() ?>>
<span id="el_tbl_packingdetail_Length">
<span<?php echo $tbl_packingdetail->Length->viewAttributes() ?>>
<?php echo $tbl_packingdetail->Length->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($tbl_packingdetail->Width->Visible) { // Width ?>
	<tr id="r_Width">
		<td class="<?php echo $tbl_packingdetail_view->TableLeftColumnClass ?>"><span id="elh_tbl_packingdetail_Width"><?php echo $tbl_packingdetail->Width->caption() ?></span></td>
		<td data-name="Width"<?php echo $tbl_packingdetail->Width->cellAttributes() ?>>
<span id="el_tbl_packingdetail_Width">
<span<?php echo $tbl_packingdetail->Width->viewAttributes() ?>>
<?php echo $tbl_packingdetail->Width->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($tbl_packingdetail->Heigth->Visible) { // Heigth ?>
	<tr id="r_Heigth">
		<td class="<?php echo $tbl_packingdetail_view->TableLeftColumnClass ?>"><span id="elh_tbl_packingdetail_Heigth"><?php echo $tbl_packingdetail->Heigth->caption() ?></span></td>
		<td data-name="Heigth"<?php echo $tbl_packingdetail->Heigth->cellAttributes() ?>>
<span id="el_tbl_packingdetail_Heigth">
<span<?php echo $tbl_packingdetail->Heigth->viewAttributes() ?>>
<?php echo $tbl_packingdetail->Heigth->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
</table>
<?php
	if (in_array("tbl_goodsinpack", explode(",", $tbl_packingdetail->getCurrentDetailTable())) && $tbl_goodsinpack->DetailView) {
?>
<?php if ($tbl_packingdetail->getCurrentDetailTable() <> "") { ?>
<h4 class="ew-detail-caption"><?php echo $Language->TablePhrase("tbl_goodsinpack", "TblCaption") ?></h4>
<?php } ?>
<?php include_once "tbl_goodsinpackgrid.php" ?>
<?php } ?>
</form>
<?php
$tbl_packingdetail_view->showPageFooter();
if (DEBUG_ENABLED)
	echo GetDebugMessage();
?>
<?php if (!$tbl_packingdetail->isExport()) { ?>
<script>

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php } ?>
<?php include_once "footer.php" ?>
<?php
$tbl_packingdetail_view->terminate();
?>