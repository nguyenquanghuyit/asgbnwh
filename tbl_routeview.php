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
$tbl_route_view = new tbl_route_view();

// Run the page
$tbl_route_view->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$tbl_route_view->Page_Render();
?>
<?php include_once "header.php" ?>
<?php if (!$tbl_route->isExport()) { ?>
<script>

// Form object
currentPageID = ew.PAGE_ID = "view";
var ftbl_routeview = currentForm = new ew.Form("ftbl_routeview", "view");

// Form_CustomValidate event
ftbl_routeview.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

	// Your custom validation code here, return false if invalid.
	return true;
}

// Use JavaScript validation or not
ftbl_routeview.validateRequired = <?php echo json_encode(CLIENT_VALIDATE) ?>;

// Dynamic selection lists
// Form object for search

</script>
<script>

// Write your client script here, no need to add script tags.
</script>
<?php } ?>
<?php if (!$tbl_route->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php $tbl_route_view->ExportOptions->render("body") ?>
<?php $tbl_route_view->OtherOptions->render("body") ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php $tbl_route_view->showPageHeader(); ?>
<?php
$tbl_route_view->showMessage();
?>
<form name="ftbl_routeview" id="ftbl_routeview" class="form-inline ew-form ew-view-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($tbl_route_view->CheckToken) { ?>
<input type="hidden" name="<?php echo TOKEN_NAME ?>" value="<?php echo $tbl_route_view->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="tbl_route">
<input type="hidden" name="modal" value="<?php echo (int)$tbl_route_view->IsModal ?>">
<table class="table table-striped table-sm ew-view-table">
<?php if ($tbl_route->ID_Route->Visible) { // ID_Route ?>
	<tr id="r_ID_Route">
		<td class="<?php echo $tbl_route_view->TableLeftColumnClass ?>"><span id="elh_tbl_route_ID_Route"><?php echo $tbl_route->ID_Route->caption() ?></span></td>
		<td data-name="ID_Route"<?php echo $tbl_route->ID_Route->cellAttributes() ?>>
<span id="el_tbl_route_ID_Route">
<span<?php echo $tbl_route->ID_Route->viewAttributes() ?>>
<?php echo $tbl_route->ID_Route->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($tbl_route->RouteName->Visible) { // RouteName ?>
	<tr id="r_RouteName">
		<td class="<?php echo $tbl_route_view->TableLeftColumnClass ?>"><span id="elh_tbl_route_RouteName"><?php echo $tbl_route->RouteName->caption() ?></span></td>
		<td data-name="RouteName"<?php echo $tbl_route->RouteName->cellAttributes() ?>>
<span id="el_tbl_route_RouteName">
<span<?php echo $tbl_route->RouteName->viewAttributes() ?>>
<?php echo $tbl_route->RouteName->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($tbl_route->DateTimeUnload->Visible) { // DateTimeUnload ?>
	<tr id="r_DateTimeUnload">
		<td class="<?php echo $tbl_route_view->TableLeftColumnClass ?>"><span id="elh_tbl_route_DateTimeUnload"><?php echo $tbl_route->DateTimeUnload->caption() ?></span></td>
		<td data-name="DateTimeUnload"<?php echo $tbl_route->DateTimeUnload->cellAttributes() ?>>
<span id="el_tbl_route_DateTimeUnload">
<span<?php echo $tbl_route->DateTimeUnload->viewAttributes() ?>>
<?php echo $tbl_route->DateTimeUnload->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($tbl_route->TruckNo->Visible) { // TruckNo ?>
	<tr id="r_TruckNo">
		<td class="<?php echo $tbl_route_view->TableLeftColumnClass ?>"><span id="elh_tbl_route_TruckNo"><?php echo $tbl_route->TruckNo->caption() ?></span></td>
		<td data-name="TruckNo"<?php echo $tbl_route->TruckNo->cellAttributes() ?>>
<span id="el_tbl_route_TruckNo">
<span<?php echo $tbl_route->TruckNo->viewAttributes() ?>>
<?php echo $tbl_route->TruckNo->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
</table>
</form>
<?php
$tbl_route_view->showPageFooter();
if (DEBUG_ENABLED)
	echo GetDebugMessage();
?>
<?php if (!$tbl_route->isExport()) { ?>
<script>

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php } ?>
<?php include_once "footer.php" ?>
<?php
$tbl_route_view->terminate();
?>