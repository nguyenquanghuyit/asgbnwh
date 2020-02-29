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
$tbl_staff_view = new tbl_staff_view();

// Run the page
$tbl_staff_view->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$tbl_staff_view->Page_Render();
?>
<?php include_once "header.php" ?>
<?php if (!$tbl_staff->isExport()) { ?>
<script>

// Form object
currentPageID = ew.PAGE_ID = "view";
var ftbl_staffview = currentForm = new ew.Form("ftbl_staffview", "view");

// Form_CustomValidate event
ftbl_staffview.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

	// Your custom validation code here, return false if invalid.
	return true;
}

// Use JavaScript validation or not
ftbl_staffview.validateRequired = <?php echo json_encode(CLIENT_VALIDATE) ?>;

// Dynamic selection lists
// Form object for search

</script>
<script>

// Write your client script here, no need to add script tags.
</script>
<?php } ?>
<?php if (!$tbl_staff->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php $tbl_staff_view->ExportOptions->render("body") ?>
<?php $tbl_staff_view->OtherOptions->render("body") ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php $tbl_staff_view->showPageHeader(); ?>
<?php
$tbl_staff_view->showMessage();
?>
<form name="ftbl_staffview" id="ftbl_staffview" class="form-inline ew-form ew-view-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($tbl_staff_view->CheckToken) { ?>
<input type="hidden" name="<?php echo TOKEN_NAME ?>" value="<?php echo $tbl_staff_view->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="tbl_staff">
<input type="hidden" name="modal" value="<?php echo (int)$tbl_staff_view->IsModal ?>">
<table class="table table-striped table-sm ew-view-table">
<?php if ($tbl_staff->Ma_NV->Visible) { // Ma_NV ?>
	<tr id="r_Ma_NV">
		<td class="<?php echo $tbl_staff_view->TableLeftColumnClass ?>"><span id="elh_tbl_staff_Ma_NV"><?php echo $tbl_staff->Ma_NV->caption() ?></span></td>
		<td data-name="Ma_NV"<?php echo $tbl_staff->Ma_NV->cellAttributes() ?>>
<span id="el_tbl_staff_Ma_NV">
<span<?php echo $tbl_staff->Ma_NV->viewAttributes() ?>>
<?php echo $tbl_staff->Ma_NV->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($tbl_staff->hoVaTen->Visible) { // hoVaTen ?>
	<tr id="r_hoVaTen">
		<td class="<?php echo $tbl_staff_view->TableLeftColumnClass ?>"><span id="elh_tbl_staff_hoVaTen"><?php echo $tbl_staff->hoVaTen->caption() ?></span></td>
		<td data-name="hoVaTen"<?php echo $tbl_staff->hoVaTen->cellAttributes() ?>>
<span id="el_tbl_staff_hoVaTen">
<span<?php echo $tbl_staff->hoVaTen->viewAttributes() ?>>
<?php echo $tbl_staff->hoVaTen->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($tbl_staff->gioiTinh->Visible) { // gioiTinh ?>
	<tr id="r_gioiTinh">
		<td class="<?php echo $tbl_staff_view->TableLeftColumnClass ?>"><span id="elh_tbl_staff_gioiTinh"><?php echo $tbl_staff->gioiTinh->caption() ?></span></td>
		<td data-name="gioiTinh"<?php echo $tbl_staff->gioiTinh->cellAttributes() ?>>
<span id="el_tbl_staff_gioiTinh">
<span<?php echo $tbl_staff->gioiTinh->viewAttributes() ?>>
<?php echo $tbl_staff->gioiTinh->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($tbl_staff->ngaySinh->Visible) { // ngaySinh ?>
	<tr id="r_ngaySinh">
		<td class="<?php echo $tbl_staff_view->TableLeftColumnClass ?>"><span id="elh_tbl_staff_ngaySinh"><?php echo $tbl_staff->ngaySinh->caption() ?></span></td>
		<td data-name="ngaySinh"<?php echo $tbl_staff->ngaySinh->cellAttributes() ?>>
<span id="el_tbl_staff_ngaySinh">
<span<?php echo $tbl_staff->ngaySinh->viewAttributes() ?>>
<?php echo $tbl_staff->ngaySinh->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($tbl_staff->emailCaNhan->Visible) { // emailCaNhan ?>
	<tr id="r_emailCaNhan">
		<td class="<?php echo $tbl_staff_view->TableLeftColumnClass ?>"><span id="elh_tbl_staff_emailCaNhan"><?php echo $tbl_staff->emailCaNhan->caption() ?></span></td>
		<td data-name="emailCaNhan"<?php echo $tbl_staff->emailCaNhan->cellAttributes() ?>>
<span id="el_tbl_staff_emailCaNhan">
<span<?php echo $tbl_staff->emailCaNhan->viewAttributes() ?>>
<?php echo $tbl_staff->emailCaNhan->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($tbl_staff->CD_ID->Visible) { // CD_ID ?>
	<tr id="r_CD_ID">
		<td class="<?php echo $tbl_staff_view->TableLeftColumnClass ?>"><span id="elh_tbl_staff_CD_ID"><?php echo $tbl_staff->CD_ID->caption() ?></span></td>
		<td data-name="CD_ID"<?php echo $tbl_staff->CD_ID->cellAttributes() ?>>
<span id="el_tbl_staff_CD_ID">
<span<?php echo $tbl_staff->CD_ID->viewAttributes() ?>>
<?php echo $tbl_staff->CD_ID->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($tbl_staff->TD_ID->Visible) { // TD_ID ?>
	<tr id="r_TD_ID">
		<td class="<?php echo $tbl_staff_view->TableLeftColumnClass ?>"><span id="elh_tbl_staff_TD_ID"><?php echo $tbl_staff->TD_ID->caption() ?></span></td>
		<td data-name="TD_ID"<?php echo $tbl_staff->TD_ID->cellAttributes() ?>>
<span id="el_tbl_staff_TD_ID">
<span<?php echo $tbl_staff->TD_ID->viewAttributes() ?>>
<?php echo $tbl_staff->TD_ID->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($tbl_staff->PB_ID->Visible) { // PB_ID ?>
	<tr id="r_PB_ID">
		<td class="<?php echo $tbl_staff_view->TableLeftColumnClass ?>"><span id="elh_tbl_staff_PB_ID"><?php echo $tbl_staff->PB_ID->caption() ?></span></td>
		<td data-name="PB_ID"<?php echo $tbl_staff->PB_ID->cellAttributes() ?>>
<span id="el_tbl_staff_PB_ID">
<span<?php echo $tbl_staff->PB_ID->viewAttributes() ?>>
<?php echo $tbl_staff->PB_ID->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
</table>
</form>
<?php
$tbl_staff_view->showPageFooter();
if (DEBUG_ENABLED)
	echo GetDebugMessage();
?>
<?php if (!$tbl_staff->isExport()) { ?>
<script>

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php } ?>
<?php include_once "footer.php" ?>
<?php
$tbl_staff_view->terminate();
?>