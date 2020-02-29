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
$packing_view = new packing_view();

// Run the page
$packing_view->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$packing_view->Page_Render();
?>
<?php include_once "header.php" ?>
<?php if (!$packing->isExport()) { ?>
<script>

// Form object
currentPageID = ew.PAGE_ID = "view";
var fpackingview = currentForm = new ew.Form("fpackingview", "view");

// Form_CustomValidate event
fpackingview.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

	// Your custom validation code here, return false if invalid.
	return true;
}

// Use JavaScript validation or not
fpackingview.validateRequired = <?php echo json_encode(CLIENT_VALIDATE) ?>;

// Dynamic selection lists
fpackingview.lists["x_TypeName"] = <?php echo $packing_view->TypeName->Lookup->toClientList() ?>;
fpackingview.lists["x_TypeName"].options = <?php echo JsonEncode($packing_view->TypeName->lookupOptions()) ?>;

// Form object for search
</script>
<script>

// Write your client script here, no need to add script tags.
</script>
<?php } ?>
<?php if (!$packing->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php $packing_view->ExportOptions->render("body") ?>
<?php $packing_view->OtherOptions->render("body") ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php $packing_view->showPageHeader(); ?>
<?php
$packing_view->showMessage();
?>
<form name="fpackingview" id="fpackingview" class="form-inline ew-form ew-view-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($packing_view->CheckToken) { ?>
<input type="hidden" name="<?php echo TOKEN_NAME ?>" value="<?php echo $packing_view->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="packing">
<input type="hidden" name="modal" value="<?php echo (int)$packing_view->IsModal ?>">
<table class="table table-striped table-sm ew-view-table">
<?php if ($packing->Id_packing->Visible) { // Id_packing ?>
	<tr id="r_Id_packing">
		<td class="<?php echo $packing_view->TableLeftColumnClass ?>"><span id="elh_packing_Id_packing"><?php echo $packing->Id_packing->caption() ?></span></td>
		<td data-name="Id_packing"<?php echo $packing->Id_packing->cellAttributes() ?>>
<span id="el_packing_Id_packing">
<span<?php echo $packing->Id_packing->viewAttributes() ?>>
<?php echo $packing->Id_packing->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($packing->ID_Order->Visible) { // ID_Order ?>
	<tr id="r_ID_Order">
		<td class="<?php echo $packing_view->TableLeftColumnClass ?>"><span id="elh_packing_ID_Order"><?php echo $packing->ID_Order->caption() ?></span></td>
		<td data-name="ID_Order"<?php echo $packing->ID_Order->cellAttributes() ?>>
<span id="el_packing_ID_Order">
<span<?php echo $packing->ID_Order->viewAttributes() ?>>
<?php echo $packing->ID_Order->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($packing->CusomterOrderNo->Visible) { // CusomterOrderNo ?>
	<tr id="r_CusomterOrderNo">
		<td class="<?php echo $packing_view->TableLeftColumnClass ?>"><span id="elh_packing_CusomterOrderNo"><?php echo $packing->CusomterOrderNo->caption() ?></span></td>
		<td data-name="CusomterOrderNo"<?php echo $packing->CusomterOrderNo->cellAttributes() ?>>
<span id="el_packing_CusomterOrderNo">
<span<?php echo $packing->CusomterOrderNo->viewAttributes() ?>>
<?php echo $packing->CusomterOrderNo->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($packing->TypeName->Visible) { // TypeName ?>
	<tr id="r_TypeName">
		<td class="<?php echo $packing_view->TableLeftColumnClass ?>"><span id="elh_packing_TypeName"><?php echo $packing->TypeName->caption() ?></span></td>
		<td data-name="TypeName"<?php echo $packing->TypeName->cellAttributes() ?>>
<span id="el_packing_TypeName">
<span<?php echo $packing->TypeName->viewAttributes() ?>>
<?php echo $packing->TypeName->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($packing->CreateUser->Visible) { // CreateUser ?>
	<tr id="r_CreateUser">
		<td class="<?php echo $packing_view->TableLeftColumnClass ?>"><span id="elh_packing_CreateUser"><?php echo $packing->CreateUser->caption() ?></span></td>
		<td data-name="CreateUser"<?php echo $packing->CreateUser->cellAttributes() ?>>
<span id="el_packing_CreateUser">
<span<?php echo $packing->CreateUser->viewAttributes() ?>>
<?php echo $packing->CreateUser->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($packing->CreateDate->Visible) { // CreateDate ?>
	<tr id="r_CreateDate">
		<td class="<?php echo $packing_view->TableLeftColumnClass ?>"><span id="elh_packing_CreateDate"><?php echo $packing->CreateDate->caption() ?></span></td>
		<td data-name="CreateDate"<?php echo $packing->CreateDate->cellAttributes() ?>>
<span id="el_packing_CreateDate">
<span<?php echo $packing->CreateDate->viewAttributes() ?>>
<?php echo $packing->CreateDate->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
</table>
<?php
	if (in_array("tbl_packingdetail", explode(",", $packing->getCurrentDetailTable())) && $tbl_packingdetail->DetailView) {
?>
<?php if ($packing->getCurrentDetailTable() <> "") { ?>
<h4 class="ew-detail-caption"><?php echo $Language->TablePhrase("tbl_packingdetail", "TblCaption") ?>&nbsp;<?php echo str_replace("%c", $packing_view->tbl_packingdetail_Count, $Language->phrase("DetailCount")) ?></h4>
<?php } ?>
<?php include_once "tbl_packingdetailgrid.php" ?>
<?php } ?>
</form>
<?php
$packing_view->showPageFooter();
if (DEBUG_ENABLED)
	echo GetDebugMessage();
?>
<?php if (!$packing->isExport()) { ?>
<script>

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php } ?>
<?php include_once "footer.php" ?>
<?php
$packing_view->terminate();
?>