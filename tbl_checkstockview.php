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
$tbl_checkstock_view = new tbl_checkstock_view();

// Run the page
$tbl_checkstock_view->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$tbl_checkstock_view->Page_Render();
?>
<?php include_once "header.php" ?>
<?php if (!$tbl_checkstock->isExport()) { ?>
<script>

// Form object
currentPageID = ew.PAGE_ID = "view";
var ftbl_checkstockview = currentForm = new ew.Form("ftbl_checkstockview", "view");

// Form_CustomValidate event
ftbl_checkstockview.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

	// Your custom validation code here, return false if invalid.
	return true;
}

// Use JavaScript validation or not
ftbl_checkstockview.validateRequired = <?php echo json_encode(CLIENT_VALIDATE) ?>;

// Dynamic selection lists
// Form object for search

</script>
<script>

// Write your client script here, no need to add script tags.
</script>
<?php } ?>
<?php if (!$tbl_checkstock->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php $tbl_checkstock_view->ExportOptions->render("body") ?>
<?php $tbl_checkstock_view->OtherOptions->render("body") ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php $tbl_checkstock_view->showPageHeader(); ?>
<?php
$tbl_checkstock_view->showMessage();
?>
<form name="ftbl_checkstockview" id="ftbl_checkstockview" class="form-inline ew-form ew-view-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($tbl_checkstock_view->CheckToken) { ?>
<input type="hidden" name="<?php echo TOKEN_NAME ?>" value="<?php echo $tbl_checkstock_view->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="tbl_checkstock">
<input type="hidden" name="modal" value="<?php echo (int)$tbl_checkstock_view->IsModal ?>">
<table class="table table-striped table-sm ew-view-table">
<?php if ($tbl_checkstock->tenDotKiemKho->Visible) { // tenDotKiemKho ?>
	<tr id="r_tenDotKiemKho">
		<td class="<?php echo $tbl_checkstock_view->TableLeftColumnClass ?>"><span id="elh_tbl_checkstock_tenDotKiemKho"><?php echo $tbl_checkstock->tenDotKiemKho->caption() ?></span></td>
		<td data-name="tenDotKiemKho"<?php echo $tbl_checkstock->tenDotKiemKho->cellAttributes() ?>>
<span id="el_tbl_checkstock_tenDotKiemKho">
<span<?php echo $tbl_checkstock->tenDotKiemKho->viewAttributes() ?>>
<?php echo $tbl_checkstock->tenDotKiemKho->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($tbl_checkstock->NoiDung->Visible) { // NoiDung ?>
	<tr id="r_NoiDung">
		<td class="<?php echo $tbl_checkstock_view->TableLeftColumnClass ?>"><span id="elh_tbl_checkstock_NoiDung"><?php echo $tbl_checkstock->NoiDung->caption() ?></span></td>
		<td data-name="NoiDung"<?php echo $tbl_checkstock->NoiDung->cellAttributes() ?>>
<span id="el_tbl_checkstock_NoiDung">
<span<?php echo $tbl_checkstock->NoiDung->viewAttributes() ?>>
<?php echo $tbl_checkstock->NoiDung->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($tbl_checkstock->UserCreate->Visible) { // UserCreate ?>
	<tr id="r_UserCreate">
		<td class="<?php echo $tbl_checkstock_view->TableLeftColumnClass ?>"><span id="elh_tbl_checkstock_UserCreate"><?php echo $tbl_checkstock->UserCreate->caption() ?></span></td>
		<td data-name="UserCreate"<?php echo $tbl_checkstock->UserCreate->cellAttributes() ?>>
<span id="el_tbl_checkstock_UserCreate">
<span<?php echo $tbl_checkstock->UserCreate->viewAttributes() ?>>
<?php echo $tbl_checkstock->UserCreate->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($tbl_checkstock->DatetimeCreate->Visible) { // DatetimeCreate ?>
	<tr id="r_DatetimeCreate">
		<td class="<?php echo $tbl_checkstock_view->TableLeftColumnClass ?>"><span id="elh_tbl_checkstock_DatetimeCreate"><?php echo $tbl_checkstock->DatetimeCreate->caption() ?></span></td>
		<td data-name="DatetimeCreate"<?php echo $tbl_checkstock->DatetimeCreate->cellAttributes() ?>>
<span id="el_tbl_checkstock_DatetimeCreate">
<span<?php echo $tbl_checkstock->DatetimeCreate->viewAttributes() ?>>
<?php echo $tbl_checkstock->DatetimeCreate->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($tbl_checkstock->UserUpdate->Visible) { // UserUpdate ?>
	<tr id="r_UserUpdate">
		<td class="<?php echo $tbl_checkstock_view->TableLeftColumnClass ?>"><span id="elh_tbl_checkstock_UserUpdate"><?php echo $tbl_checkstock->UserUpdate->caption() ?></span></td>
		<td data-name="UserUpdate"<?php echo $tbl_checkstock->UserUpdate->cellAttributes() ?>>
<span id="el_tbl_checkstock_UserUpdate">
<span<?php echo $tbl_checkstock->UserUpdate->viewAttributes() ?>>
<?php echo $tbl_checkstock->UserUpdate->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($tbl_checkstock->DatetimeUpdate->Visible) { // DatetimeUpdate ?>
	<tr id="r_DatetimeUpdate">
		<td class="<?php echo $tbl_checkstock_view->TableLeftColumnClass ?>"><span id="elh_tbl_checkstock_DatetimeUpdate"><?php echo $tbl_checkstock->DatetimeUpdate->caption() ?></span></td>
		<td data-name="DatetimeUpdate"<?php echo $tbl_checkstock->DatetimeUpdate->cellAttributes() ?>>
<span id="el_tbl_checkstock_DatetimeUpdate">
<span<?php echo $tbl_checkstock->DatetimeUpdate->viewAttributes() ?>>
<?php echo $tbl_checkstock->DatetimeUpdate->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
</table>
<?php
	if (in_array("tbl_checkstockdetail", explode(",", $tbl_checkstock->getCurrentDetailTable())) && $tbl_checkstockdetail->DetailView) {
?>
<?php if ($tbl_checkstock->getCurrentDetailTable() <> "") { ?>
<h4 class="ew-detail-caption"><?php echo $Language->TablePhrase("tbl_checkstockdetail", "TblCaption") ?>&nbsp;<?php echo str_replace("%c", $tbl_checkstock_view->tbl_checkstockdetail_Count, $Language->phrase("DetailCount")) ?></h4>
<?php } ?>
<?php include_once "tbl_checkstockdetailgrid.php" ?>
<?php } ?>
</form>
<?php
$tbl_checkstock_view->showPageFooter();
if (DEBUG_ENABLED)
	echo GetDebugMessage();
?>
<?php if (!$tbl_checkstock->isExport()) { ?>
<script>

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php } ?>
<?php include_once "footer.php" ?>
<?php
$tbl_checkstock_view->terminate();
?>