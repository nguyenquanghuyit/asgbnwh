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
$tbl_product_delete = new tbl_product_delete();

// Run the page
$tbl_product_delete->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$tbl_product_delete->Page_Render();
?>
<?php include_once "header.php" ?>
<script>

// Form object
currentPageID = ew.PAGE_ID = "delete";
var ftbl_productdelete = currentForm = new ew.Form("ftbl_productdelete", "delete");

// Form_CustomValidate event
ftbl_productdelete.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

	// Your custom validation code here, return false if invalid.
	return true;
}

// Use JavaScript validation or not
ftbl_productdelete.validateRequired = <?php echo json_encode(CLIENT_VALIDATE) ?>;

// Dynamic selection lists
ftbl_productdelete.lists["x_IdType"] = <?php echo $tbl_product_delete->IdType->Lookup->toClientList() ?>;
ftbl_productdelete.lists["x_IdType"].options = <?php echo JsonEncode($tbl_product_delete->IdType->lookupOptions()) ?>;
ftbl_productdelete.lists["x_ID_Contact"] = <?php echo $tbl_product_delete->ID_Contact->Lookup->toClientList() ?>;
ftbl_productdelete.lists["x_ID_Contact"].options = <?php echo JsonEncode($tbl_product_delete->ID_Contact->lookupOptions()) ?>;
ftbl_productdelete.autoSuggests["x_ID_Contact"] = <?php echo json_encode(["data" => "ajax=autosuggest"]) ?>;

// Form object for search
</script>
<script>

// Write your client script here, no need to add script tags.
</script>
<?php $tbl_product_delete->showPageHeader(); ?>
<?php
$tbl_product_delete->showMessage();
?>
<form name="ftbl_productdelete" id="ftbl_productdelete" class="form-inline ew-form ew-delete-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($tbl_product_delete->CheckToken) { ?>
<input type="hidden" name="<?php echo TOKEN_NAME ?>" value="<?php echo $tbl_product_delete->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="tbl_product">
<input type="hidden" name="action" id="action" value="delete">
<?php foreach ($tbl_product_delete->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode($COMPOSITE_KEY_SEPARATOR, $key) : $key; ?>
<input type="hidden" name="key_m[]" value="<?php echo HtmlEncode($keyvalue) ?>">
<?php } ?>
<div class="card ew-card ew-grid">
<div class="<?php if (IsResponsiveLayout()) { ?>table-responsive <?php } ?>card-body ew-grid-middle-panel">
<table class="table ew-table">
	<thead>
	<tr class="ew-table-header">
<?php if ($tbl_product->IdType->Visible) { // IdType ?>
		<th class="<?php echo $tbl_product->IdType->headerCellClass() ?>"><span id="elh_tbl_product_IdType" class="tbl_product_IdType"><?php echo $tbl_product->IdType->caption() ?></span></th>
<?php } ?>
<?php if ($tbl_product->Code->Visible) { // Code ?>
		<th class="<?php echo $tbl_product->Code->headerCellClass() ?>"><span id="elh_tbl_product_Code" class="tbl_product_Code"><?php echo $tbl_product->Code->caption() ?></span></th>
<?php } ?>
<?php if ($tbl_product->Model->Visible) { // Model ?>
		<th class="<?php echo $tbl_product->Model->headerCellClass() ?>"><span id="elh_tbl_product_Model" class="tbl_product_Model"><?php echo $tbl_product->Model->caption() ?></span></th>
<?php } ?>
<?php if ($tbl_product->ProductName->Visible) { // ProductName ?>
		<th class="<?php echo $tbl_product->ProductName->headerCellClass() ?>"><span id="elh_tbl_product_ProductName" class="tbl_product_ProductName"><?php echo $tbl_product->ProductName->caption() ?></span></th>
<?php } ?>
<?php if ($tbl_product->VnName->Visible) { // VnName ?>
		<th class="<?php echo $tbl_product->VnName->headerCellClass() ?>"><span id="elh_tbl_product_VnName" class="tbl_product_VnName"><?php echo $tbl_product->VnName->caption() ?></span></th>
<?php } ?>
<?php if ($tbl_product->ID_Contact->Visible) { // ID_Contact ?>
		<th class="<?php echo $tbl_product->ID_Contact->headerCellClass() ?>"><span id="elh_tbl_product_ID_Contact" class="tbl_product_ID_Contact"><?php echo $tbl_product->ID_Contact->caption() ?></span></th>
<?php } ?>
<?php if ($tbl_product->Description->Visible) { // Description ?>
		<th class="<?php echo $tbl_product->Description->headerCellClass() ?>"><span id="elh_tbl_product_Description" class="tbl_product_Description"><?php echo $tbl_product->Description->caption() ?></span></th>
<?php } ?>
<?php if ($tbl_product->CreateDate->Visible) { // CreateDate ?>
		<th class="<?php echo $tbl_product->CreateDate->headerCellClass() ?>"><span id="elh_tbl_product_CreateDate" class="tbl_product_CreateDate"><?php echo $tbl_product->CreateDate->caption() ?></span></th>
<?php } ?>
<?php if ($tbl_product->CreateUser->Visible) { // CreateUser ?>
		<th class="<?php echo $tbl_product->CreateUser->headerCellClass() ?>"><span id="elh_tbl_product_CreateUser" class="tbl_product_CreateUser"><?php echo $tbl_product->CreateUser->caption() ?></span></th>
<?php } ?>
	</tr>
	</thead>
	<tbody>
<?php
$tbl_product_delete->RecCnt = 0;
$i = 0;
while (!$tbl_product_delete->Recordset->EOF) {
	$tbl_product_delete->RecCnt++;
	$tbl_product_delete->RowCnt++;

	// Set row properties
	$tbl_product->resetAttributes();
	$tbl_product->RowType = ROWTYPE_VIEW; // View

	// Get the field contents
	$tbl_product_delete->loadRowValues($tbl_product_delete->Recordset);

	// Render row
	$tbl_product_delete->renderRow();
?>
	<tr<?php echo $tbl_product->rowAttributes() ?>>
<?php if ($tbl_product->IdType->Visible) { // IdType ?>
		<td<?php echo $tbl_product->IdType->cellAttributes() ?>>
<span id="el<?php echo $tbl_product_delete->RowCnt ?>_tbl_product_IdType" class="tbl_product_IdType">
<span<?php echo $tbl_product->IdType->viewAttributes() ?>>
<?php echo $tbl_product->IdType->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($tbl_product->Code->Visible) { // Code ?>
		<td<?php echo $tbl_product->Code->cellAttributes() ?>>
<span id="el<?php echo $tbl_product_delete->RowCnt ?>_tbl_product_Code" class="tbl_product_Code">
<span<?php echo $tbl_product->Code->viewAttributes() ?>>
<?php echo $tbl_product->Code->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($tbl_product->Model->Visible) { // Model ?>
		<td<?php echo $tbl_product->Model->cellAttributes() ?>>
<span id="el<?php echo $tbl_product_delete->RowCnt ?>_tbl_product_Model" class="tbl_product_Model">
<span<?php echo $tbl_product->Model->viewAttributes() ?>>
<?php echo $tbl_product->Model->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($tbl_product->ProductName->Visible) { // ProductName ?>
		<td<?php echo $tbl_product->ProductName->cellAttributes() ?>>
<span id="el<?php echo $tbl_product_delete->RowCnt ?>_tbl_product_ProductName" class="tbl_product_ProductName">
<span<?php echo $tbl_product->ProductName->viewAttributes() ?>>
<?php echo $tbl_product->ProductName->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($tbl_product->VnName->Visible) { // VnName ?>
		<td<?php echo $tbl_product->VnName->cellAttributes() ?>>
<span id="el<?php echo $tbl_product_delete->RowCnt ?>_tbl_product_VnName" class="tbl_product_VnName">
<span<?php echo $tbl_product->VnName->viewAttributes() ?>>
<?php echo $tbl_product->VnName->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($tbl_product->ID_Contact->Visible) { // ID_Contact ?>
		<td<?php echo $tbl_product->ID_Contact->cellAttributes() ?>>
<span id="el<?php echo $tbl_product_delete->RowCnt ?>_tbl_product_ID_Contact" class="tbl_product_ID_Contact">
<span<?php echo $tbl_product->ID_Contact->viewAttributes() ?>>
<?php echo $tbl_product->ID_Contact->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($tbl_product->Description->Visible) { // Description ?>
		<td<?php echo $tbl_product->Description->cellAttributes() ?>>
<span id="el<?php echo $tbl_product_delete->RowCnt ?>_tbl_product_Description" class="tbl_product_Description">
<span<?php echo $tbl_product->Description->viewAttributes() ?>>
<?php echo $tbl_product->Description->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($tbl_product->CreateDate->Visible) { // CreateDate ?>
		<td<?php echo $tbl_product->CreateDate->cellAttributes() ?>>
<span id="el<?php echo $tbl_product_delete->RowCnt ?>_tbl_product_CreateDate" class="tbl_product_CreateDate">
<span<?php echo $tbl_product->CreateDate->viewAttributes() ?>>
<?php echo $tbl_product->CreateDate->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($tbl_product->CreateUser->Visible) { // CreateUser ?>
		<td<?php echo $tbl_product->CreateUser->cellAttributes() ?>>
<span id="el<?php echo $tbl_product_delete->RowCnt ?>_tbl_product_CreateUser" class="tbl_product_CreateUser">
<span<?php echo $tbl_product->CreateUser->viewAttributes() ?>>
<?php echo $tbl_product->CreateUser->getViewValue() ?></span>
</span>
</td>
<?php } ?>
	</tr>
<?php
	$tbl_product_delete->Recordset->moveNext();
}
$tbl_product_delete->Recordset->close();
?>
</tbody>
</table>
</div>
</div>
<div>
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("DeleteBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $tbl_product_delete->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
</div>
</form>
<?php
$tbl_product_delete->showPageFooter();
if (DEBUG_ENABLED)
	echo GetDebugMessage();
?>
<script>

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php include_once "footer.php" ?>
<?php
$tbl_product_delete->terminate();
?>