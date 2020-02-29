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
$tbl_goodsinpack_view = new tbl_goodsinpack_view();

// Run the page
$tbl_goodsinpack_view->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$tbl_goodsinpack_view->Page_Render();
?>
<?php include_once "header.php" ?>
<?php if (!$tbl_goodsinpack->isExport()) { ?>
<script>

// Form object
currentPageID = ew.PAGE_ID = "view";
var ftbl_goodsinpackview = currentForm = new ew.Form("ftbl_goodsinpackview", "view");

// Form_CustomValidate event
ftbl_goodsinpackview.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

	// Your custom validation code here, return false if invalid.
	return true;
}

// Use JavaScript validation or not
ftbl_goodsinpackview.validateRequired = <?php echo json_encode(CLIENT_VALIDATE) ?>;

// Dynamic selection lists
// Form object for search

</script>
<script>

// Write your client script here, no need to add script tags.
</script>
<?php } ?>
<?php if (!$tbl_goodsinpack->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php $tbl_goodsinpack_view->ExportOptions->render("body") ?>
<?php $tbl_goodsinpack_view->OtherOptions->render("body") ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php $tbl_goodsinpack_view->showPageHeader(); ?>
<?php
$tbl_goodsinpack_view->showMessage();
?>
<form name="ftbl_goodsinpackview" id="ftbl_goodsinpackview" class="form-inline ew-form ew-view-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($tbl_goodsinpack_view->CheckToken) { ?>
<input type="hidden" name="<?php echo TOKEN_NAME ?>" value="<?php echo $tbl_goodsinpack_view->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="tbl_goodsinpack">
<input type="hidden" name="modal" value="<?php echo (int)$tbl_goodsinpack_view->IsModal ?>">
<table class="table table-striped table-sm ew-view-table">
<?php if ($tbl_goodsinpack->ID_GoodInPack->Visible) { // ID_GoodInPack ?>
	<tr id="r_ID_GoodInPack">
		<td class="<?php echo $tbl_goodsinpack_view->TableLeftColumnClass ?>"><span id="elh_tbl_goodsinpack_ID_GoodInPack"><?php echo $tbl_goodsinpack->ID_GoodInPack->caption() ?></span></td>
		<td data-name="ID_GoodInPack"<?php echo $tbl_goodsinpack->ID_GoodInPack->cellAttributes() ?>>
<span id="el_tbl_goodsinpack_ID_GoodInPack">
<span<?php echo $tbl_goodsinpack->ID_GoodInPack->viewAttributes() ?>>
<?php echo $tbl_goodsinpack->ID_GoodInPack->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($tbl_goodsinpack->ID_packingDetail->Visible) { // ID_packingDetail ?>
	<tr id="r_ID_packingDetail">
		<td class="<?php echo $tbl_goodsinpack_view->TableLeftColumnClass ?>"><span id="elh_tbl_goodsinpack_ID_packingDetail"><?php echo $tbl_goodsinpack->ID_packingDetail->caption() ?></span></td>
		<td data-name="ID_packingDetail"<?php echo $tbl_goodsinpack->ID_packingDetail->cellAttributes() ?>>
<span id="el_tbl_goodsinpack_ID_packingDetail">
<span<?php echo $tbl_goodsinpack->ID_packingDetail->viewAttributes() ?>>
<?php echo $tbl_goodsinpack->ID_packingDetail->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($tbl_goodsinpack->Code->Visible) { // Code ?>
	<tr id="r_Code">
		<td class="<?php echo $tbl_goodsinpack_view->TableLeftColumnClass ?>"><span id="elh_tbl_goodsinpack_Code"><?php echo $tbl_goodsinpack->Code->caption() ?></span></td>
		<td data-name="Code"<?php echo $tbl_goodsinpack->Code->cellAttributes() ?>>
<span id="el_tbl_goodsinpack_Code">
<span<?php echo $tbl_goodsinpack->Code->viewAttributes() ?>>
<?php echo $tbl_goodsinpack->Code->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($tbl_goodsinpack->PCS->Visible) { // PCS ?>
	<tr id="r_PCS">
		<td class="<?php echo $tbl_goodsinpack_view->TableLeftColumnClass ?>"><span id="elh_tbl_goodsinpack_PCS"><?php echo $tbl_goodsinpack->PCS->caption() ?></span></td>
		<td data-name="PCS"<?php echo $tbl_goodsinpack->PCS->cellAttributes() ?>>
<span id="el_tbl_goodsinpack_PCS">
<span<?php echo $tbl_goodsinpack->PCS->viewAttributes() ?>>
<?php echo $tbl_goodsinpack->PCS->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($tbl_goodsinpack->CreateUser->Visible) { // CreateUser ?>
	<tr id="r_CreateUser">
		<td class="<?php echo $tbl_goodsinpack_view->TableLeftColumnClass ?>"><span id="elh_tbl_goodsinpack_CreateUser"><?php echo $tbl_goodsinpack->CreateUser->caption() ?></span></td>
		<td data-name="CreateUser"<?php echo $tbl_goodsinpack->CreateUser->cellAttributes() ?>>
<span id="el_tbl_goodsinpack_CreateUser">
<span<?php echo $tbl_goodsinpack->CreateUser->viewAttributes() ?>>
<?php echo $tbl_goodsinpack->CreateUser->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($tbl_goodsinpack->CreateDate->Visible) { // CreateDate ?>
	<tr id="r_CreateDate">
		<td class="<?php echo $tbl_goodsinpack_view->TableLeftColumnClass ?>"><span id="elh_tbl_goodsinpack_CreateDate"><?php echo $tbl_goodsinpack->CreateDate->caption() ?></span></td>
		<td data-name="CreateDate"<?php echo $tbl_goodsinpack->CreateDate->cellAttributes() ?>>
<span id="el_tbl_goodsinpack_CreateDate">
<span<?php echo $tbl_goodsinpack->CreateDate->viewAttributes() ?>>
<?php echo $tbl_goodsinpack->CreateDate->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($tbl_goodsinpack->UpdateUser->Visible) { // UpdateUser ?>
	<tr id="r_UpdateUser">
		<td class="<?php echo $tbl_goodsinpack_view->TableLeftColumnClass ?>"><span id="elh_tbl_goodsinpack_UpdateUser"><?php echo $tbl_goodsinpack->UpdateUser->caption() ?></span></td>
		<td data-name="UpdateUser"<?php echo $tbl_goodsinpack->UpdateUser->cellAttributes() ?>>
<span id="el_tbl_goodsinpack_UpdateUser">
<span<?php echo $tbl_goodsinpack->UpdateUser->viewAttributes() ?>>
<?php echo $tbl_goodsinpack->UpdateUser->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($tbl_goodsinpack->UpdateDatetime->Visible) { // UpdateDatetime ?>
	<tr id="r_UpdateDatetime">
		<td class="<?php echo $tbl_goodsinpack_view->TableLeftColumnClass ?>"><span id="elh_tbl_goodsinpack_UpdateDatetime"><?php echo $tbl_goodsinpack->UpdateDatetime->caption() ?></span></td>
		<td data-name="UpdateDatetime"<?php echo $tbl_goodsinpack->UpdateDatetime->cellAttributes() ?>>
<span id="el_tbl_goodsinpack_UpdateDatetime">
<span<?php echo $tbl_goodsinpack->UpdateDatetime->viewAttributes() ?>>
<?php echo $tbl_goodsinpack->UpdateDatetime->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
</table>
</form>
<?php
$tbl_goodsinpack_view->showPageFooter();
if (DEBUG_ENABLED)
	echo GetDebugMessage();
?>
<?php if (!$tbl_goodsinpack->isExport()) { ?>
<script>

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php } ?>
<?php include_once "footer.php" ?>
<?php
$tbl_goodsinpack_view->terminate();
?>