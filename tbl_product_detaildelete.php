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
$tbl_product_detail_delete = new tbl_product_detail_delete();

// Run the page
$tbl_product_detail_delete->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$tbl_product_detail_delete->Page_Render();
?>
<?php include_once "header.php" ?>
<script>

// Form object
currentPageID = ew.PAGE_ID = "delete";
var ftbl_product_detaildelete = currentForm = new ew.Form("ftbl_product_detaildelete", "delete");

// Form_CustomValidate event
ftbl_product_detaildelete.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

	// Your custom validation code here, return false if invalid.
	return true;
}

// Use JavaScript validation or not
ftbl_product_detaildelete.validateRequired = <?php echo json_encode(CLIENT_VALIDATE) ?>;

// Dynamic selection lists
ftbl_product_detaildelete.lists["x_IdUnit"] = <?php echo $tbl_product_detail_delete->IdUnit->Lookup->toClientList() ?>;
ftbl_product_detaildelete.lists["x_IdUnit"].options = <?php echo JsonEncode($tbl_product_detail_delete->IdUnit->lookupOptions()) ?>;
ftbl_product_detaildelete.lists["x_DefaultCode"] = <?php echo $tbl_product_detail_delete->DefaultCode->Lookup->toClientList() ?>;
ftbl_product_detaildelete.lists["x_DefaultCode"].options = <?php echo JsonEncode($tbl_product_detail_delete->DefaultCode->options(FALSE, TRUE)) ?>;

// Form object for search
</script>
<script>

// Write your client script here, no need to add script tags.
</script>
<?php $tbl_product_detail_delete->showPageHeader(); ?>
<?php
$tbl_product_detail_delete->showMessage();
?>
<form name="ftbl_product_detaildelete" id="ftbl_product_detaildelete" class="form-inline ew-form ew-delete-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($tbl_product_detail_delete->CheckToken) { ?>
<input type="hidden" name="<?php echo TOKEN_NAME ?>" value="<?php echo $tbl_product_detail_delete->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="tbl_product_detail">
<input type="hidden" name="action" id="action" value="delete">
<?php foreach ($tbl_product_detail_delete->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode($COMPOSITE_KEY_SEPARATOR, $key) : $key; ?>
<input type="hidden" name="key_m[]" value="<?php echo HtmlEncode($keyvalue) ?>">
<?php } ?>
<div class="card ew-card ew-grid">
<div class="<?php if (IsResponsiveLayout()) { ?>table-responsive <?php } ?>card-body ew-grid-middle-panel">
<table class="table ew-table">
	<thead>
	<tr class="ew-table-header">
<?php if ($tbl_product_detail->PackingQty->Visible) { // PackingQty ?>
		<th class="<?php echo $tbl_product_detail->PackingQty->headerCellClass() ?>"><span id="elh_tbl_product_detail_PackingQty" class="tbl_product_detail_PackingQty"><?php echo $tbl_product_detail->PackingQty->caption() ?></span></th>
<?php } ?>
<?php if ($tbl_product_detail->IdUnit->Visible) { // IdUnit ?>
		<th class="<?php echo $tbl_product_detail->IdUnit->headerCellClass() ?>"><span id="elh_tbl_product_detail_IdUnit" class="tbl_product_detail_IdUnit"><?php echo $tbl_product_detail->IdUnit->caption() ?></span></th>
<?php } ?>
<?php if ($tbl_product_detail->DefaultCode->Visible) { // DefaultCode ?>
		<th class="<?php echo $tbl_product_detail->DefaultCode->headerCellClass() ?>"><span id="elh_tbl_product_detail_DefaultCode" class="tbl_product_detail_DefaultCode"><?php echo $tbl_product_detail->DefaultCode->caption() ?></span></th>
<?php } ?>
	</tr>
	</thead>
	<tbody>
<?php
$tbl_product_detail_delete->RecCnt = 0;
$i = 0;
while (!$tbl_product_detail_delete->Recordset->EOF) {
	$tbl_product_detail_delete->RecCnt++;
	$tbl_product_detail_delete->RowCnt++;

	// Set row properties
	$tbl_product_detail->resetAttributes();
	$tbl_product_detail->RowType = ROWTYPE_VIEW; // View

	// Get the field contents
	$tbl_product_detail_delete->loadRowValues($tbl_product_detail_delete->Recordset);

	// Render row
	$tbl_product_detail_delete->renderRow();
?>
	<tr<?php echo $tbl_product_detail->rowAttributes() ?>>
<?php if ($tbl_product_detail->PackingQty->Visible) { // PackingQty ?>
		<td<?php echo $tbl_product_detail->PackingQty->cellAttributes() ?>>
<span id="el<?php echo $tbl_product_detail_delete->RowCnt ?>_tbl_product_detail_PackingQty" class="tbl_product_detail_PackingQty">
<span<?php echo $tbl_product_detail->PackingQty->viewAttributes() ?>>
<?php echo $tbl_product_detail->PackingQty->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($tbl_product_detail->IdUnit->Visible) { // IdUnit ?>
		<td<?php echo $tbl_product_detail->IdUnit->cellAttributes() ?>>
<span id="el<?php echo $tbl_product_detail_delete->RowCnt ?>_tbl_product_detail_IdUnit" class="tbl_product_detail_IdUnit">
<span<?php echo $tbl_product_detail->IdUnit->viewAttributes() ?>>
<?php echo $tbl_product_detail->IdUnit->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($tbl_product_detail->DefaultCode->Visible) { // DefaultCode ?>
		<td<?php echo $tbl_product_detail->DefaultCode->cellAttributes() ?>>
<span id="el<?php echo $tbl_product_detail_delete->RowCnt ?>_tbl_product_detail_DefaultCode" class="tbl_product_detail_DefaultCode">
<span<?php echo $tbl_product_detail->DefaultCode->viewAttributes() ?>>
<?php echo $tbl_product_detail->DefaultCode->getViewValue() ?></span>
</span>
</td>
<?php } ?>
	</tr>
<?php
	$tbl_product_detail_delete->Recordset->moveNext();
}
$tbl_product_detail_delete->Recordset->close();
?>
</tbody>
</table>
</div>
</div>
<div>
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("DeleteBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $tbl_product_detail_delete->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
</div>
</form>
<?php
$tbl_product_detail_delete->showPageFooter();
if (DEBUG_ENABLED)
	echo GetDebugMessage();
?>
<script>

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php include_once "footer.php" ?>
<?php
$tbl_product_detail_delete->terminate();
?>