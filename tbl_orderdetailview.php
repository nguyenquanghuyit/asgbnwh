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
$tbl_orderdetail_view = new tbl_orderdetail_view();

// Run the page
$tbl_orderdetail_view->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$tbl_orderdetail_view->Page_Render();
?>
<?php include_once "header.php" ?>
<?php if (!$tbl_orderdetail->isExport()) { ?>
<script>

// Form object
currentPageID = ew.PAGE_ID = "view";
var ftbl_orderdetailview = currentForm = new ew.Form("ftbl_orderdetailview", "view");

// Form_CustomValidate event
ftbl_orderdetailview.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

	// Your custom validation code here, return false if invalid.
	return true;
}

// Use JavaScript validation or not
ftbl_orderdetailview.validateRequired = <?php echo json_encode(CLIENT_VALIDATE) ?>;

// Dynamic selection lists
// Form object for search

</script>
<script>

// Write your client script here, no need to add script tags.
</script>
<?php } ?>
<?php if (!$tbl_orderdetail->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php $tbl_orderdetail_view->ExportOptions->render("body") ?>
<?php $tbl_orderdetail_view->OtherOptions->render("body") ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php $tbl_orderdetail_view->showPageHeader(); ?>
<?php
$tbl_orderdetail_view->showMessage();
?>
<form name="ftbl_orderdetailview" id="ftbl_orderdetailview" class="form-inline ew-form ew-view-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($tbl_orderdetail_view->CheckToken) { ?>
<input type="hidden" name="<?php echo TOKEN_NAME ?>" value="<?php echo $tbl_orderdetail_view->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="tbl_orderdetail">
<input type="hidden" name="modal" value="<?php echo (int)$tbl_orderdetail_view->IsModal ?>">
<table class="table table-striped table-sm ew-view-table">
<?php if ($tbl_orderdetail->ID_Detail->Visible) { // ID_Detail ?>
	<tr id="r_ID_Detail">
		<td class="<?php echo $tbl_orderdetail_view->TableLeftColumnClass ?>"><span id="elh_tbl_orderdetail_ID_Detail"><?php echo $tbl_orderdetail->ID_Detail->caption() ?></span></td>
		<td data-name="ID_Detail"<?php echo $tbl_orderdetail->ID_Detail->cellAttributes() ?>>
<span id="el_tbl_orderdetail_ID_Detail">
<span<?php echo $tbl_orderdetail->ID_Detail->viewAttributes() ?>>
<?php echo $tbl_orderdetail->ID_Detail->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($tbl_orderdetail->OrderNo->Visible) { // OrderNo ?>
	<tr id="r_OrderNo">
		<td class="<?php echo $tbl_orderdetail_view->TableLeftColumnClass ?>"><span id="elh_tbl_orderdetail_OrderNo"><?php echo $tbl_orderdetail->OrderNo->caption() ?></span></td>
		<td data-name="OrderNo"<?php echo $tbl_orderdetail->OrderNo->cellAttributes() ?>>
<span id="el_tbl_orderdetail_OrderNo">
<span<?php echo $tbl_orderdetail->OrderNo->viewAttributes() ?>>
<?php echo $tbl_orderdetail->OrderNo->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($tbl_orderdetail->Code->Visible) { // Code ?>
	<tr id="r_Code">
		<td class="<?php echo $tbl_orderdetail_view->TableLeftColumnClass ?>"><span id="elh_tbl_orderdetail_Code"><?php echo $tbl_orderdetail->Code->caption() ?></span></td>
		<td data-name="Code"<?php echo $tbl_orderdetail->Code->cellAttributes() ?>>
<span id="el_tbl_orderdetail_Code">
<span<?php echo $tbl_orderdetail->Code->viewAttributes() ?>>
<?php echo $tbl_orderdetail->Code->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($tbl_orderdetail->PCS->Visible) { // PCS ?>
	<tr id="r_PCS">
		<td class="<?php echo $tbl_orderdetail_view->TableLeftColumnClass ?>"><span id="elh_tbl_orderdetail_PCS"><?php echo $tbl_orderdetail->PCS->caption() ?></span></td>
		<td data-name="PCS"<?php echo $tbl_orderdetail->PCS->cellAttributes() ?>>
<span id="el_tbl_orderdetail_PCS">
<span<?php echo $tbl_orderdetail->PCS->viewAttributes() ?>>
<?php echo $tbl_orderdetail->PCS->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
</table>
</form>
<?php
$tbl_orderdetail_view->showPageFooter();
if (DEBUG_ENABLED)
	echo GetDebugMessage();
?>
<?php if (!$tbl_orderdetail->isExport()) { ?>
<script>

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php } ?>
<?php include_once "footer.php" ?>
<?php
$tbl_orderdetail_view->terminate();
?>