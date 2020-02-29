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
$tbl_order_view = new tbl_order_view();

// Run the page
$tbl_order_view->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$tbl_order_view->Page_Render();
?>
<?php include_once "header.php" ?>
<?php if (!$tbl_order->isExport()) { ?>
<script>

// Form object
currentPageID = ew.PAGE_ID = "view";
var ftbl_orderview = currentForm = new ew.Form("ftbl_orderview", "view");

// Form_CustomValidate event
ftbl_orderview.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

	// Your custom validation code here, return false if invalid.
	return true;
}

// Use JavaScript validation or not
ftbl_orderview.validateRequired = <?php echo json_encode(CLIENT_VALIDATE) ?>;

// Dynamic selection lists
ftbl_orderview.lists["x_IdType"] = <?php echo $tbl_order_view->IdType->Lookup->toClientList() ?>;
ftbl_orderview.lists["x_IdType"].options = <?php echo JsonEncode($tbl_order_view->IdType->lookupOptions()) ?>;
ftbl_orderview.lists["x_ID_Contact"] = <?php echo $tbl_order_view->ID_Contact->Lookup->toClientList() ?>;
ftbl_orderview.lists["x_ID_Contact"].options = <?php echo JsonEncode($tbl_order_view->ID_Contact->lookupOptions()) ?>;
ftbl_orderview.autoSuggests["x_ID_Contact"] = <?php echo json_encode(["data" => "ajax=autosuggest"]) ?>;
ftbl_orderview.lists["x_StatusLoad"] = <?php echo $tbl_order_view->StatusLoad->Lookup->toClientList() ?>;
ftbl_orderview.lists["x_StatusLoad"].options = <?php echo JsonEncode($tbl_order_view->StatusLoad->options(FALSE, TRUE)) ?>;

// Form object for search
</script>
<script>

// Write your client script here, no need to add script tags.
</script>
<?php } ?>
<?php if (!$tbl_order->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php $tbl_order_view->ExportOptions->render("body") ?>
<?php $tbl_order_view->OtherOptions->render("body") ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php $tbl_order_view->showPageHeader(); ?>
<?php
$tbl_order_view->showMessage();
?>
<form name="ftbl_orderview" id="ftbl_orderview" class="form-inline ew-form ew-view-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($tbl_order_view->CheckToken) { ?>
<input type="hidden" name="<?php echo TOKEN_NAME ?>" value="<?php echo $tbl_order_view->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="tbl_order">
<input type="hidden" name="modal" value="<?php echo (int)$tbl_order_view->IsModal ?>">
<table class="table table-striped table-sm ew-view-table">
<?php if ($tbl_order->ID_Order->Visible) { // ID_Order ?>
	<tr id="r_ID_Order">
		<td class="<?php echo $tbl_order_view->TableLeftColumnClass ?>"><span id="elh_tbl_order_ID_Order"><?php echo $tbl_order->ID_Order->caption() ?></span></td>
		<td data-name="ID_Order"<?php echo $tbl_order->ID_Order->cellAttributes() ?>>
<span id="el_tbl_order_ID_Order">
<span<?php echo $tbl_order->ID_Order->viewAttributes() ?>>
<?php echo $tbl_order->ID_Order->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($tbl_order->OrderDate->Visible) { // OrderDate ?>
	<tr id="r_OrderDate">
		<td class="<?php echo $tbl_order_view->TableLeftColumnClass ?>"><span id="elh_tbl_order_OrderDate"><?php echo $tbl_order->OrderDate->caption() ?></span></td>
		<td data-name="OrderDate"<?php echo $tbl_order->OrderDate->cellAttributes() ?>>
<span id="el_tbl_order_OrderDate">
<span<?php echo $tbl_order->OrderDate->viewAttributes() ?>>
<?php echo $tbl_order->OrderDate->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($tbl_order->InvoiceNo->Visible) { // InvoiceNo ?>
	<tr id="r_InvoiceNo">
		<td class="<?php echo $tbl_order_view->TableLeftColumnClass ?>"><span id="elh_tbl_order_InvoiceNo"><?php echo $tbl_order->InvoiceNo->caption() ?></span></td>
		<td data-name="InvoiceNo"<?php echo $tbl_order->InvoiceNo->cellAttributes() ?>>
<span id="el_tbl_order_InvoiceNo">
<span<?php echo $tbl_order->InvoiceNo->viewAttributes() ?>>
<?php echo $tbl_order->InvoiceNo->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($tbl_order->CusomterOrderNo->Visible) { // CusomterOrderNo ?>
	<tr id="r_CusomterOrderNo">
		<td class="<?php echo $tbl_order_view->TableLeftColumnClass ?>"><span id="elh_tbl_order_CusomterOrderNo"><?php echo $tbl_order->CusomterOrderNo->caption() ?></span></td>
		<td data-name="CusomterOrderNo"<?php echo $tbl_order->CusomterOrderNo->cellAttributes() ?>>
<span id="el_tbl_order_CusomterOrderNo">
<span<?php echo $tbl_order->CusomterOrderNo->viewAttributes() ?>>
<?php echo $tbl_order->CusomterOrderNo->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($tbl_order->IdType->Visible) { // IdType ?>
	<tr id="r_IdType">
		<td class="<?php echo $tbl_order_view->TableLeftColumnClass ?>"><span id="elh_tbl_order_IdType"><?php echo $tbl_order->IdType->caption() ?></span></td>
		<td data-name="IdType"<?php echo $tbl_order->IdType->cellAttributes() ?>>
<span id="el_tbl_order_IdType">
<span<?php echo $tbl_order->IdType->viewAttributes() ?>>
<?php echo $tbl_order->IdType->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($tbl_order->ID_Contact->Visible) { // ID_Contact ?>
	<tr id="r_ID_Contact">
		<td class="<?php echo $tbl_order_view->TableLeftColumnClass ?>"><span id="elh_tbl_order_ID_Contact"><?php echo $tbl_order->ID_Contact->caption() ?></span></td>
		<td data-name="ID_Contact"<?php echo $tbl_order->ID_Contact->cellAttributes() ?>>
<span id="el_tbl_order_ID_Contact">
<span<?php echo $tbl_order->ID_Contact->viewAttributes() ?>>
<?php echo $tbl_order->ID_Contact->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($tbl_order->CreateUser->Visible) { // CreateUser ?>
	<tr id="r_CreateUser">
		<td class="<?php echo $tbl_order_view->TableLeftColumnClass ?>"><span id="elh_tbl_order_CreateUser"><?php echo $tbl_order->CreateUser->caption() ?></span></td>
		<td data-name="CreateUser"<?php echo $tbl_order->CreateUser->cellAttributes() ?>>
<span id="el_tbl_order_CreateUser">
<span<?php echo $tbl_order->CreateUser->viewAttributes() ?>>
<?php echo $tbl_order->CreateUser->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($tbl_order->CreateDate->Visible) { // CreateDate ?>
	<tr id="r_CreateDate">
		<td class="<?php echo $tbl_order_view->TableLeftColumnClass ?>"><span id="elh_tbl_order_CreateDate"><?php echo $tbl_order->CreateDate->caption() ?></span></td>
		<td data-name="CreateDate"<?php echo $tbl_order->CreateDate->cellAttributes() ?>>
<span id="el_tbl_order_CreateDate">
<span<?php echo $tbl_order->CreateDate->viewAttributes() ?>>
<?php echo $tbl_order->CreateDate->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($tbl_order->StatusLoad->Visible) { // StatusLoad ?>
	<tr id="r_StatusLoad">
		<td class="<?php echo $tbl_order_view->TableLeftColumnClass ?>"><span id="elh_tbl_order_StatusLoad"><?php echo $tbl_order->StatusLoad->caption() ?></span></td>
		<td data-name="StatusLoad"<?php echo $tbl_order->StatusLoad->cellAttributes() ?>>
<span id="el_tbl_order_StatusLoad">
<span<?php echo $tbl_order->StatusLoad->viewAttributes() ?>>
<?php echo $tbl_order->StatusLoad->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
</table>
<?php if ($tbl_order->getCurrentDetailTable() <> "") { ?>
<?php
	$tbl_order_view->DetailPages->ValidKeys = explode(",", $tbl_order->getCurrentDetailTable());
	$firstActiveDetailTable = $tbl_order_view->DetailPages->activePageIndex();
?>
<div class="ew-detail-pages"><!-- detail-pages -->
<div class="ew-nav-tabs" id="tbl_order_view_details"><!-- tabs -->
	<ul class="<?php echo $tbl_order_view->DetailPages->navStyle() ?>"><!-- .nav -->
<?php
	if (in_array("tbl_orderguide", explode(",", $tbl_order->getCurrentDetailTable())) && $tbl_orderguide->DetailView) {
		if ($firstActiveDetailTable == "" || $firstActiveDetailTable == "tbl_orderguide") {
			$firstActiveDetailTable = "tbl_orderguide";
		}
?>
		<li class="nav-item"><a class="nav-link<?php echo $tbl_order_view->DetailPages->pageStyle("tbl_orderguide") ?>" href="#tab_tbl_orderguide" data-toggle="tab"><?php echo $Language->TablePhrase("tbl_orderguide", "TblCaption") ?>&nbsp;<?php echo str_replace("%c", $tbl_order_view->tbl_orderguide_Count, $Language->phrase("DetailCount")) ?></a></li>
<?php
	}
?>
<?php
	if (in_array("tbl_orderdetail", explode(",", $tbl_order->getCurrentDetailTable())) && $tbl_orderdetail->DetailView) {
		if ($firstActiveDetailTable == "" || $firstActiveDetailTable == "tbl_orderdetail") {
			$firstActiveDetailTable = "tbl_orderdetail";
		}
?>
		<li class="nav-item"><a class="nav-link<?php echo $tbl_order_view->DetailPages->pageStyle("tbl_orderdetail") ?>" href="#tab_tbl_orderdetail" data-toggle="tab"><?php echo $Language->TablePhrase("tbl_orderdetail", "TblCaption") ?>&nbsp;<?php echo str_replace("%c", $tbl_order_view->tbl_orderdetail_Count, $Language->phrase("DetailCount")) ?></a></li>
<?php
	}
?>
<?php
	if (in_array("vwhistoryPicking", explode(",", $tbl_order->getCurrentDetailTable())) && $vwhistoryPicking->DetailView) {
		if ($firstActiveDetailTable == "" || $firstActiveDetailTable == "vwhistoryPicking") {
			$firstActiveDetailTable = "vwhistoryPicking";
		}
?>
		<li class="nav-item"><a class="nav-link<?php echo $tbl_order_view->DetailPages->pageStyle("vwhistoryPicking") ?>" href="#tab_vwhistoryPicking" data-toggle="tab"><?php echo $Language->TablePhrase("vwhistoryPicking", "TblCaption") ?>&nbsp;<?php echo str_replace("%c", $tbl_order_view->vwhistoryPicking_Count, $Language->phrase("DetailCount")) ?></a></li>
<?php
	}
?>
<?php
	if (in_array("vwPackingdetail", explode(",", $tbl_order->getCurrentDetailTable())) && $vwPackingdetail->DetailView) {
		if ($firstActiveDetailTable == "" || $firstActiveDetailTable == "vwPackingdetail") {
			$firstActiveDetailTable = "vwPackingdetail";
		}
?>
		<li class="nav-item"><a class="nav-link<?php echo $tbl_order_view->DetailPages->pageStyle("vwPackingdetail") ?>" href="#tab_vwPackingdetail" data-toggle="tab"><?php echo $Language->TablePhrase("vwPackingdetail", "TblCaption") ?>&nbsp;<?php echo str_replace("%c", $tbl_order_view->vwPackingdetail_Count, $Language->phrase("DetailCount")) ?></a></li>
<?php
	}
?>
	</ul><!-- /.nav -->
	<div class="tab-content"><!-- .tab-content -->
<?php
	if (in_array("tbl_orderguide", explode(",", $tbl_order->getCurrentDetailTable())) && $tbl_orderguide->DetailView) {
		if ($firstActiveDetailTable == "" || $firstActiveDetailTable == "tbl_orderguide")
			$firstActiveDetailTable = "tbl_orderguide";
?>
		<div class="tab-pane<?php echo $tbl_order_view->DetailPages->pageStyle("tbl_orderguide") ?>" id="tab_tbl_orderguide"><!-- page* -->
<?php include_once "tbl_orderguidegrid.php" ?>
		</div><!-- /page* -->
<?php } ?>
<?php
	if (in_array("tbl_orderdetail", explode(",", $tbl_order->getCurrentDetailTable())) && $tbl_orderdetail->DetailView) {
		if ($firstActiveDetailTable == "" || $firstActiveDetailTable == "tbl_orderdetail")
			$firstActiveDetailTable = "tbl_orderdetail";
?>
		<div class="tab-pane<?php echo $tbl_order_view->DetailPages->pageStyle("tbl_orderdetail") ?>" id="tab_tbl_orderdetail"><!-- page* -->
<?php include_once "tbl_orderdetailgrid.php" ?>
		</div><!-- /page* -->
<?php } ?>
<?php
	if (in_array("vwhistoryPicking", explode(",", $tbl_order->getCurrentDetailTable())) && $vwhistoryPicking->DetailView) {
		if ($firstActiveDetailTable == "" || $firstActiveDetailTable == "vwhistoryPicking")
			$firstActiveDetailTable = "vwhistoryPicking";
?>
		<div class="tab-pane<?php echo $tbl_order_view->DetailPages->pageStyle("vwhistoryPicking") ?>" id="tab_vwhistoryPicking"><!-- page* -->
<?php include_once "vwhistoryPickinggrid.php" ?>
		</div><!-- /page* -->
<?php } ?>
<?php
	if (in_array("vwPackingdetail", explode(",", $tbl_order->getCurrentDetailTable())) && $vwPackingdetail->DetailView) {
		if ($firstActiveDetailTable == "" || $firstActiveDetailTable == "vwPackingdetail")
			$firstActiveDetailTable = "vwPackingdetail";
?>
		<div class="tab-pane<?php echo $tbl_order_view->DetailPages->pageStyle("vwPackingdetail") ?>" id="tab_vwPackingdetail"><!-- page* -->
<?php include_once "vwPackingdetailgrid.php" ?>
		</div><!-- /page* -->
<?php } ?>
	</div><!-- /.tab-content -->
</div><!-- /tabs -->
</div><!-- /detail-pages -->
<?php } ?>
</form>
<?php
$tbl_order_view->showPageFooter();
if (DEBUG_ENABLED)
	echo GetDebugMessage();
?>
<?php if (!$tbl_order->isExport()) { ?>
<script>

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php } ?>
<?php include_once "footer.php" ?>
<?php
$tbl_order_view->terminate();
?>