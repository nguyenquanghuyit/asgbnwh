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
$vwmasterguide_view = new vwmasterguide_view();

// Run the page
$vwmasterguide_view->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$vwmasterguide_view->Page_Render();
?>
<?php include_once "header.php" ?>
<?php if (!$vwmasterguide->isExport()) { ?>
<script>

// Form object
currentPageID = ew.PAGE_ID = "view";
var fvwmasterguideview = currentForm = new ew.Form("fvwmasterguideview", "view");

// Form_CustomValidate event
fvwmasterguideview.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

	// Your custom validation code here, return false if invalid.
	return true;
}

// Use JavaScript validation or not
fvwmasterguideview.validateRequired = <?php echo json_encode(CLIENT_VALIDATE) ?>;

// Dynamic selection lists
// Form object for search

</script>
<script>

// Write your client script here, no need to add script tags.
</script>
<?php } ?>
<?php if (!$vwmasterguide->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php $vwmasterguide_view->ExportOptions->render("body") ?>
<?php $vwmasterguide_view->OtherOptions->render("body") ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php $vwmasterguide_view->showPageHeader(); ?>
<?php
$vwmasterguide_view->showMessage();
?>
<form name="fvwmasterguideview" id="fvwmasterguideview" class="form-inline ew-form ew-view-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($vwmasterguide_view->CheckToken) { ?>
<input type="hidden" name="<?php echo TOKEN_NAME ?>" value="<?php echo $vwmasterguide_view->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="vwmasterguide">
<input type="hidden" name="modal" value="<?php echo (int)$vwmasterguide_view->IsModal ?>">
<table class="table table-striped table-sm ew-view-table">
<?php if ($vwmasterguide->ID_Order->Visible) { // ID_Order ?>
	<tr id="r_ID_Order">
		<td class="<?php echo $vwmasterguide_view->TableLeftColumnClass ?>"><span id="elh_vwmasterguide_ID_Order"><?php echo $vwmasterguide->ID_Order->caption() ?></span></td>
		<td data-name="ID_Order"<?php echo $vwmasterguide->ID_Order->cellAttributes() ?>>
<span id="el_vwmasterguide_ID_Order">
<span<?php echo $vwmasterguide->ID_Order->viewAttributes() ?>>
<?php echo $vwmasterguide->ID_Order->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
</table>
<?php
	if (in_array("tbl_guider", explode(",", $vwmasterguide->getCurrentDetailTable())) && $tbl_guider->DetailView) {
?>
<?php if ($vwmasterguide->getCurrentDetailTable() <> "") { ?>
<h4 class="ew-detail-caption"><?php echo $Language->TablePhrase("tbl_guider", "TblCaption") ?></h4>
<?php } ?>
<?php include_once "tbl_guidergrid.php" ?>
<?php } ?>
</form>
<?php
$vwmasterguide_view->showPageFooter();
if (DEBUG_ENABLED)
	echo GetDebugMessage();
?>
<?php if (!$vwmasterguide->isExport()) { ?>
<script>

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php } ?>
<?php include_once "footer.php" ?>
<?php
$vwmasterguide_view->terminate();
?>