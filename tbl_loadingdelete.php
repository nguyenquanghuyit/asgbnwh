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
$tbl_loading_delete = new tbl_loading_delete();

// Run the page
$tbl_loading_delete->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$tbl_loading_delete->Page_Render();
?>
<?php include_once "header.php" ?>
<script>

// Form object
currentPageID = ew.PAGE_ID = "delete";
var ftbl_loadingdelete = currentForm = new ew.Form("ftbl_loadingdelete", "delete");

// Form_CustomValidate event
ftbl_loadingdelete.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

	// Your custom validation code here, return false if invalid.
	return true;
}

// Use JavaScript validation or not
ftbl_loadingdelete.validateRequired = <?php echo json_encode(CLIENT_VALIDATE) ?>;

// Dynamic selection lists
ftbl_loadingdelete.lists["x_ID_Order"] = <?php echo $tbl_loading_delete->ID_Order->Lookup->toClientList() ?>;
ftbl_loadingdelete.lists["x_ID_Order"].options = <?php echo JsonEncode($tbl_loading_delete->ID_Order->lookupOptions()) ?>;

// Form object for search
</script>
<script>

// Write your client script here, no need to add script tags.
</script>
<?php $tbl_loading_delete->showPageHeader(); ?>
<?php
$tbl_loading_delete->showMessage();
?>
<form name="ftbl_loadingdelete" id="ftbl_loadingdelete" class="form-inline ew-form ew-delete-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($tbl_loading_delete->CheckToken) { ?>
<input type="hidden" name="<?php echo TOKEN_NAME ?>" value="<?php echo $tbl_loading_delete->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="tbl_loading">
<input type="hidden" name="action" id="action" value="delete">
<?php foreach ($tbl_loading_delete->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode($COMPOSITE_KEY_SEPARATOR, $key) : $key; ?>
<input type="hidden" name="key_m[]" value="<?php echo HtmlEncode($keyvalue) ?>">
<?php } ?>
<div class="card ew-card ew-grid">
<div class="<?php if (IsResponsiveLayout()) { ?>table-responsive <?php } ?>card-body ew-grid-middle-panel">
<table class="table ew-table">
	<thead>
	<tr class="ew-table-header">
<?php if ($tbl_loading->ID_Order->Visible) { // ID_Order ?>
		<th class="<?php echo $tbl_loading->ID_Order->headerCellClass() ?>"><span id="elh_tbl_loading_ID_Order" class="tbl_loading_ID_Order"><?php echo $tbl_loading->ID_Order->caption() ?></span></th>
<?php } ?>
<?php if ($tbl_loading->CusomterOrderNo->Visible) { // CusomterOrderNo ?>
		<th class="<?php echo $tbl_loading->CusomterOrderNo->headerCellClass() ?>"><span id="elh_tbl_loading_CusomterOrderNo" class="tbl_loading_CusomterOrderNo"><?php echo $tbl_loading->CusomterOrderNo->caption() ?></span></th>
<?php } ?>
<?php if ($tbl_loading->CreateUser->Visible) { // CreateUser ?>
		<th class="<?php echo $tbl_loading->CreateUser->headerCellClass() ?>"><span id="elh_tbl_loading_CreateUser" class="tbl_loading_CreateUser"><?php echo $tbl_loading->CreateUser->caption() ?></span></th>
<?php } ?>
<?php if ($tbl_loading->CreateDate->Visible) { // CreateDate ?>
		<th class="<?php echo $tbl_loading->CreateDate->headerCellClass() ?>"><span id="elh_tbl_loading_CreateDate" class="tbl_loading_CreateDate"><?php echo $tbl_loading->CreateDate->caption() ?></span></th>
<?php } ?>
<?php if ($tbl_loading->UpdateUser->Visible) { // UpdateUser ?>
		<th class="<?php echo $tbl_loading->UpdateUser->headerCellClass() ?>"><span id="elh_tbl_loading_UpdateUser" class="tbl_loading_UpdateUser"><?php echo $tbl_loading->UpdateUser->caption() ?></span></th>
<?php } ?>
<?php if ($tbl_loading->UpdateDate->Visible) { // UpdateDate ?>
		<th class="<?php echo $tbl_loading->UpdateDate->headerCellClass() ?>"><span id="elh_tbl_loading_UpdateDate" class="tbl_loading_UpdateDate"><?php echo $tbl_loading->UpdateDate->caption() ?></span></th>
<?php } ?>
	</tr>
	</thead>
	<tbody>
<?php
$tbl_loading_delete->RecCnt = 0;
$i = 0;
while (!$tbl_loading_delete->Recordset->EOF) {
	$tbl_loading_delete->RecCnt++;
	$tbl_loading_delete->RowCnt++;

	// Set row properties
	$tbl_loading->resetAttributes();
	$tbl_loading->RowType = ROWTYPE_VIEW; // View

	// Get the field contents
	$tbl_loading_delete->loadRowValues($tbl_loading_delete->Recordset);

	// Render row
	$tbl_loading_delete->renderRow();
?>
	<tr<?php echo $tbl_loading->rowAttributes() ?>>
<?php if ($tbl_loading->ID_Order->Visible) { // ID_Order ?>
		<td<?php echo $tbl_loading->ID_Order->cellAttributes() ?>>
<span id="el<?php echo $tbl_loading_delete->RowCnt ?>_tbl_loading_ID_Order" class="tbl_loading_ID_Order">
<span<?php echo $tbl_loading->ID_Order->viewAttributes() ?>>
<?php echo $tbl_loading->ID_Order->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($tbl_loading->CusomterOrderNo->Visible) { // CusomterOrderNo ?>
		<td<?php echo $tbl_loading->CusomterOrderNo->cellAttributes() ?>>
<span id="el<?php echo $tbl_loading_delete->RowCnt ?>_tbl_loading_CusomterOrderNo" class="tbl_loading_CusomterOrderNo">
<span<?php echo $tbl_loading->CusomterOrderNo->viewAttributes() ?>>
<?php echo $tbl_loading->CusomterOrderNo->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($tbl_loading->CreateUser->Visible) { // CreateUser ?>
		<td<?php echo $tbl_loading->CreateUser->cellAttributes() ?>>
<span id="el<?php echo $tbl_loading_delete->RowCnt ?>_tbl_loading_CreateUser" class="tbl_loading_CreateUser">
<span<?php echo $tbl_loading->CreateUser->viewAttributes() ?>>
<?php echo $tbl_loading->CreateUser->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($tbl_loading->CreateDate->Visible) { // CreateDate ?>
		<td<?php echo $tbl_loading->CreateDate->cellAttributes() ?>>
<span id="el<?php echo $tbl_loading_delete->RowCnt ?>_tbl_loading_CreateDate" class="tbl_loading_CreateDate">
<span<?php echo $tbl_loading->CreateDate->viewAttributes() ?>>
<?php echo $tbl_loading->CreateDate->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($tbl_loading->UpdateUser->Visible) { // UpdateUser ?>
		<td<?php echo $tbl_loading->UpdateUser->cellAttributes() ?>>
<span id="el<?php echo $tbl_loading_delete->RowCnt ?>_tbl_loading_UpdateUser" class="tbl_loading_UpdateUser">
<span<?php echo $tbl_loading->UpdateUser->viewAttributes() ?>>
<?php echo $tbl_loading->UpdateUser->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($tbl_loading->UpdateDate->Visible) { // UpdateDate ?>
		<td<?php echo $tbl_loading->UpdateDate->cellAttributes() ?>>
<span id="el<?php echo $tbl_loading_delete->RowCnt ?>_tbl_loading_UpdateDate" class="tbl_loading_UpdateDate">
<span<?php echo $tbl_loading->UpdateDate->viewAttributes() ?>>
<?php echo $tbl_loading->UpdateDate->getViewValue() ?></span>
</span>
</td>
<?php } ?>
	</tr>
<?php
	$tbl_loading_delete->Recordset->moveNext();
}
$tbl_loading_delete->Recordset->close();
?>
</tbody>
</table>
</div>
</div>
<div>
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("DeleteBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $tbl_loading_delete->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
</div>
</form>
<?php
$tbl_loading_delete->showPageFooter();
if (DEBUG_ENABLED)
	echo GetDebugMessage();
?>
<script>

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php include_once "footer.php" ?>
<?php
$tbl_loading_delete->terminate();
?>