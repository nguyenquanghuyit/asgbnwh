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
$tbl_orderdetail_delete = new tbl_orderdetail_delete();

// Run the page
$tbl_orderdetail_delete->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$tbl_orderdetail_delete->Page_Render();
?>
<?php include_once "header.php" ?>
<script>

// Form object
currentPageID = ew.PAGE_ID = "delete";
var ftbl_orderdetaildelete = currentForm = new ew.Form("ftbl_orderdetaildelete", "delete");

// Form_CustomValidate event
ftbl_orderdetaildelete.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

	// Your custom validation code here, return false if invalid.
	return true;
}

// Use JavaScript validation or not
ftbl_orderdetaildelete.validateRequired = <?php echo json_encode(CLIENT_VALIDATE) ?>;

// Dynamic selection lists
ftbl_orderdetaildelete.lists["x_Code"] = <?php echo $tbl_orderdetail_delete->Code->Lookup->toClientList() ?>;
ftbl_orderdetaildelete.lists["x_Code"].options = <?php echo JsonEncode($tbl_orderdetail_delete->Code->lookupOptions()) ?>;
ftbl_orderdetaildelete.autoSuggests["x_Code"] = <?php echo json_encode(["data" => "ajax=autosuggest"]) ?>;

// Form object for search
</script>
<script>

// Write your client script here, no need to add script tags.
</script>
<?php $tbl_orderdetail_delete->showPageHeader(); ?>
<?php
$tbl_orderdetail_delete->showMessage();
?>
<form name="ftbl_orderdetaildelete" id="ftbl_orderdetaildelete" class="form-inline ew-form ew-delete-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($tbl_orderdetail_delete->CheckToken) { ?>
<input type="hidden" name="<?php echo TOKEN_NAME ?>" value="<?php echo $tbl_orderdetail_delete->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="tbl_orderdetail">
<input type="hidden" name="action" id="action" value="delete">
<?php foreach ($tbl_orderdetail_delete->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode($COMPOSITE_KEY_SEPARATOR, $key) : $key; ?>
<input type="hidden" name="key_m[]" value="<?php echo HtmlEncode($keyvalue) ?>">
<?php } ?>
<div class="card ew-card ew-grid">
<div class="<?php if (IsResponsiveLayout()) { ?>table-responsive <?php } ?>card-body ew-grid-middle-panel">
<table class="table ew-table">
	<thead>
	<tr class="ew-table-header">
<?php if ($tbl_orderdetail->Code->Visible) { // Code ?>
		<th class="<?php echo $tbl_orderdetail->Code->headerCellClass() ?>"><span id="elh_tbl_orderdetail_Code" class="tbl_orderdetail_Code"><?php echo $tbl_orderdetail->Code->caption() ?></span></th>
<?php } ?>
<?php if ($tbl_orderdetail->PCS->Visible) { // PCS ?>
		<th class="<?php echo $tbl_orderdetail->PCS->headerCellClass() ?>"><span id="elh_tbl_orderdetail_PCS" class="tbl_orderdetail_PCS"><?php echo $tbl_orderdetail->PCS->caption() ?></span></th>
<?php } ?>
	</tr>
	</thead>
	<tbody>
<?php
$tbl_orderdetail_delete->RecCnt = 0;
$i = 0;
while (!$tbl_orderdetail_delete->Recordset->EOF) {
	$tbl_orderdetail_delete->RecCnt++;
	$tbl_orderdetail_delete->RowCnt++;

	// Set row properties
	$tbl_orderdetail->resetAttributes();
	$tbl_orderdetail->RowType = ROWTYPE_VIEW; // View

	// Get the field contents
	$tbl_orderdetail_delete->loadRowValues($tbl_orderdetail_delete->Recordset);

	// Render row
	$tbl_orderdetail_delete->renderRow();
?>
	<tr<?php echo $tbl_orderdetail->rowAttributes() ?>>
<?php if ($tbl_orderdetail->Code->Visible) { // Code ?>
		<td<?php echo $tbl_orderdetail->Code->cellAttributes() ?>>
<span id="el<?php echo $tbl_orderdetail_delete->RowCnt ?>_tbl_orderdetail_Code" class="tbl_orderdetail_Code">
<span<?php echo $tbl_orderdetail->Code->viewAttributes() ?>>
<?php echo $tbl_orderdetail->Code->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($tbl_orderdetail->PCS->Visible) { // PCS ?>
		<td<?php echo $tbl_orderdetail->PCS->cellAttributes() ?>>
<span id="el<?php echo $tbl_orderdetail_delete->RowCnt ?>_tbl_orderdetail_PCS" class="tbl_orderdetail_PCS">
<span<?php echo $tbl_orderdetail->PCS->viewAttributes() ?>>
<?php echo $tbl_orderdetail->PCS->getViewValue() ?></span>
</span>
</td>
<?php } ?>
	</tr>
<?php
	$tbl_orderdetail_delete->Recordset->moveNext();
}
$tbl_orderdetail_delete->Recordset->close();
?>
</tbody>
</table>
</div>
</div>
<div>
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("DeleteBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $tbl_orderdetail_delete->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
</div>
</form>
<?php
$tbl_orderdetail_delete->showPageFooter();
if (DEBUG_ENABLED)
	echo GetDebugMessage();
?>
<script>

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php include_once "footer.php" ?>
<?php
$tbl_orderdetail_delete->terminate();
?>