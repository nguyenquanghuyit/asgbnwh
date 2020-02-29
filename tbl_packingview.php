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
$tbl_packing_view = new tbl_packing_view();

// Run the page
$tbl_packing_view->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$tbl_packing_view->Page_Render();
?>
<?php include_once "header.php" ?>
<?php if (!$tbl_packing->isExport()) { ?>
<script>

// Form object
currentPageID = ew.PAGE_ID = "view";
var ftbl_packingview = currentForm = new ew.Form("ftbl_packingview", "view");

// Form_CustomValidate event
ftbl_packingview.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

	// Your custom validation code here, return false if invalid.
	return true;
}

// Use JavaScript validation or not
ftbl_packingview.validateRequired = <?php echo json_encode(CLIENT_VALIDATE) ?>;

// Dynamic selection lists
ftbl_packingview.lists["x_Id_order"] = <?php echo $tbl_packing_view->Id_order->Lookup->toClientList() ?>;
ftbl_packingview.lists["x_Id_order"].options = <?php echo JsonEncode($tbl_packing_view->Id_order->lookupOptions()) ?>;
ftbl_packingview.autoSuggests["x_Id_order"] = <?php echo json_encode(["data" => "ajax=autosuggest"]) ?>;

// Form object for search
</script>
<script>

// Write your client script here, no need to add script tags.
</script>
<?php } ?>
<?php if (!$tbl_packing->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php $tbl_packing_view->ExportOptions->render("body") ?>
<?php $tbl_packing_view->OtherOptions->render("body") ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php $tbl_packing_view->showPageHeader(); ?>
<?php
$tbl_packing_view->showMessage();
?>
<form name="ftbl_packingview" id="ftbl_packingview" class="form-inline ew-form ew-view-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($tbl_packing_view->CheckToken) { ?>
<input type="hidden" name="<?php echo TOKEN_NAME ?>" value="<?php echo $tbl_packing_view->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="tbl_packing">
<input type="hidden" name="modal" value="<?php echo (int)$tbl_packing_view->IsModal ?>">
<table class="table table-striped table-sm ew-view-table">
<?php if ($tbl_packing->Id_order->Visible) { // Id_order ?>
	<tr id="r_Id_order">
		<td class="<?php echo $tbl_packing_view->TableLeftColumnClass ?>"><span id="elh_tbl_packing_Id_order"><?php echo $tbl_packing->Id_order->caption() ?></span></td>
		<td data-name="Id_order"<?php echo $tbl_packing->Id_order->cellAttributes() ?>>
<span id="el_tbl_packing_Id_order">
<span<?php echo $tbl_packing->Id_order->viewAttributes() ?>>
<?php echo $tbl_packing->Id_order->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($tbl_packing->CreateUser->Visible) { // CreateUser ?>
	<tr id="r_CreateUser">
		<td class="<?php echo $tbl_packing_view->TableLeftColumnClass ?>"><span id="elh_tbl_packing_CreateUser"><?php echo $tbl_packing->CreateUser->caption() ?></span></td>
		<td data-name="CreateUser"<?php echo $tbl_packing->CreateUser->cellAttributes() ?>>
<span id="el_tbl_packing_CreateUser">
<span<?php echo $tbl_packing->CreateUser->viewAttributes() ?>>
<?php echo $tbl_packing->CreateUser->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($tbl_packing->CreateDate->Visible) { // CreateDate ?>
	<tr id="r_CreateDate">
		<td class="<?php echo $tbl_packing_view->TableLeftColumnClass ?>"><span id="elh_tbl_packing_CreateDate"><?php echo $tbl_packing->CreateDate->caption() ?></span></td>
		<td data-name="CreateDate"<?php echo $tbl_packing->CreateDate->cellAttributes() ?>>
<span id="el_tbl_packing_CreateDate">
<span<?php echo $tbl_packing->CreateDate->viewAttributes() ?>>
<?php echo $tbl_packing->CreateDate->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($tbl_packing->UpdateUser->Visible) { // UpdateUser ?>
	<tr id="r_UpdateUser">
		<td class="<?php echo $tbl_packing_view->TableLeftColumnClass ?>"><span id="elh_tbl_packing_UpdateUser"><?php echo $tbl_packing->UpdateUser->caption() ?></span></td>
		<td data-name="UpdateUser"<?php echo $tbl_packing->UpdateUser->cellAttributes() ?>>
<span id="el_tbl_packing_UpdateUser">
<span<?php echo $tbl_packing->UpdateUser->viewAttributes() ?>>
<?php echo $tbl_packing->UpdateUser->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($tbl_packing->UpdateDate->Visible) { // UpdateDate ?>
	<tr id="r_UpdateDate">
		<td class="<?php echo $tbl_packing_view->TableLeftColumnClass ?>"><span id="elh_tbl_packing_UpdateDate"><?php echo $tbl_packing->UpdateDate->caption() ?></span></td>
		<td data-name="UpdateDate"<?php echo $tbl_packing->UpdateDate->cellAttributes() ?>>
<span id="el_tbl_packing_UpdateDate">
<span<?php echo $tbl_packing->UpdateDate->viewAttributes() ?>>
<?php echo $tbl_packing->UpdateDate->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
</table>
<?php
	if (in_array("tbl_packingdetail", explode(",", $tbl_packing->getCurrentDetailTable())) && $tbl_packingdetail->DetailView) {
?>
<?php if ($tbl_packing->getCurrentDetailTable() <> "") { ?>
<h4 class="ew-detail-caption"><?php echo $Language->TablePhrase("tbl_packingdetail", "TblCaption") ?>&nbsp;<?php echo str_replace("%c", $tbl_packing_view->tbl_packingdetail_Count, $Language->phrase("DetailCount")) ?></h4>
<?php } ?>
<?php include_once "tbl_packingdetailgrid.php" ?>
<?php } ?>
</form>
<?php
$tbl_packing_view->showPageFooter();
if (DEBUG_ENABLED)
	echo GetDebugMessage();
?>
<?php if (!$tbl_packing->isExport()) { ?>
<script>

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php } ?>
<?php include_once "footer.php" ?>
<?php
$tbl_packing_view->terminate();
?>