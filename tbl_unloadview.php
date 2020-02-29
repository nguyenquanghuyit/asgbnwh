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
$tbl_unload_view = new tbl_unload_view();

// Run the page
$tbl_unload_view->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$tbl_unload_view->Page_Render();
?>
<?php include_once "header.php" ?>
<?php if (!$tbl_unload->isExport()) { ?>
<script>

// Form object
currentPageID = ew.PAGE_ID = "view";
var ftbl_unloadview = currentForm = new ew.Form("ftbl_unloadview", "view");

// Form_CustomValidate event
ftbl_unloadview.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

	// Your custom validation code here, return false if invalid.
	return true;
}

// Use JavaScript validation or not
ftbl_unloadview.validateRequired = <?php echo json_encode(CLIENT_VALIDATE) ?>;

// Dynamic selection lists
ftbl_unloadview.lists["x_Code"] = <?php echo $tbl_unload_view->Code->Lookup->toClientList() ?>;
ftbl_unloadview.lists["x_Code"].options = <?php echo JsonEncode($tbl_unload_view->Code->lookupOptions()) ?>;
ftbl_unloadview.autoSuggests["x_Code"] = <?php echo json_encode(["data" => "ajax=autosuggest"]) ?>;
ftbl_unloadview.lists["x_UserUnload"] = <?php echo $tbl_unload_view->UserUnload->Lookup->toClientList() ?>;
ftbl_unloadview.lists["x_UserUnload"].options = <?php echo JsonEncode($tbl_unload_view->UserUnload->lookupOptions()) ?>;
ftbl_unloadview.autoSuggests["x_UserUnload"] = <?php echo json_encode(["data" => "ajax=autosuggest"]) ?>;

// Form object for search
</script>
<script>

// Write your client script here, no need to add script tags.
</script>
<?php } ?>
<?php if (!$tbl_unload->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php $tbl_unload_view->ExportOptions->render("body") ?>
<?php $tbl_unload_view->OtherOptions->render("body") ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php $tbl_unload_view->showPageHeader(); ?>
<?php
$tbl_unload_view->showMessage();
?>
<form name="ftbl_unloadview" id="ftbl_unloadview" class="form-inline ew-form ew-view-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($tbl_unload_view->CheckToken) { ?>
<input type="hidden" name="<?php echo TOKEN_NAME ?>" value="<?php echo $tbl_unload_view->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="tbl_unload">
<input type="hidden" name="modal" value="<?php echo (int)$tbl_unload_view->IsModal ?>">
<table class="table table-striped table-sm ew-view-table">
<?php if ($tbl_unload->Code->Visible) { // Code ?>
	<tr id="r_Code">
		<td class="<?php echo $tbl_unload_view->TableLeftColumnClass ?>"><span id="elh_tbl_unload_Code"><?php echo $tbl_unload->Code->caption() ?></span></td>
		<td data-name="Code"<?php echo $tbl_unload->Code->cellAttributes() ?>>
<span id="el_tbl_unload_Code">
<span<?php echo $tbl_unload->Code->viewAttributes() ?>>
<?php echo $tbl_unload->Code->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($tbl_unload->PCS->Visible) { // PCS ?>
	<tr id="r_PCS">
		<td class="<?php echo $tbl_unload_view->TableLeftColumnClass ?>"><span id="elh_tbl_unload_PCS"><?php echo $tbl_unload->PCS->caption() ?></span></td>
		<td data-name="PCS"<?php echo $tbl_unload->PCS->cellAttributes() ?>>
<span id="el_tbl_unload_PCS">
<span<?php echo $tbl_unload->PCS->viewAttributes() ?>>
<?php echo $tbl_unload->PCS->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($tbl_unload->Description->Visible) { // Description ?>
	<tr id="r_Description">
		<td class="<?php echo $tbl_unload_view->TableLeftColumnClass ?>"><span id="elh_tbl_unload_Description"><?php echo $tbl_unload->Description->caption() ?></span></td>
		<td data-name="Description"<?php echo $tbl_unload->Description->cellAttributes() ?>>
<span id="el_tbl_unload_Description">
<span<?php echo $tbl_unload->Description->viewAttributes() ?>>
<?php echo $tbl_unload->Description->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($tbl_unload->UserUnload->Visible) { // UserUnload ?>
	<tr id="r_UserUnload">
		<td class="<?php echo $tbl_unload_view->TableLeftColumnClass ?>"><span id="elh_tbl_unload_UserUnload"><?php echo $tbl_unload->UserUnload->caption() ?></span></td>
		<td data-name="UserUnload"<?php echo $tbl_unload->UserUnload->cellAttributes() ?>>
<span id="el_tbl_unload_UserUnload">
<span<?php echo $tbl_unload->UserUnload->viewAttributes() ?>>
<?php echo $tbl_unload->UserUnload->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($tbl_unload->DateTime_Insert->Visible) { // DateTime_Insert ?>
	<tr id="r_DateTime_Insert">
		<td class="<?php echo $tbl_unload_view->TableLeftColumnClass ?>"><span id="elh_tbl_unload_DateTime_Insert"><?php echo $tbl_unload->DateTime_Insert->caption() ?></span></td>
		<td data-name="DateTime_Insert"<?php echo $tbl_unload->DateTime_Insert->cellAttributes() ?>>
<span id="el_tbl_unload_DateTime_Insert">
<span<?php echo $tbl_unload->DateTime_Insert->viewAttributes() ?>>
<?php echo $tbl_unload->DateTime_Insert->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
</table>
</form>
<?php
$tbl_unload_view->showPageFooter();
if (DEBUG_ENABLED)
	echo GetDebugMessage();
?>
<?php if (!$tbl_unload->isExport()) { ?>
<script>

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php } ?>
<?php include_once "footer.php" ?>
<?php
$tbl_unload_view->terminate();
?>