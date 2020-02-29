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
$tbl_stock_delete = new tbl_stock_delete();

// Run the page
$tbl_stock_delete->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$tbl_stock_delete->Page_Render();
?>
<?php include_once "header.php" ?>
<script>

// Form object
currentPageID = ew.PAGE_ID = "delete";
var ftbl_stockdelete = currentForm = new ew.Form("ftbl_stockdelete", "delete");

// Form_CustomValidate event
ftbl_stockdelete.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

	// Your custom validation code here, return false if invalid.
	return true;
}

// Use JavaScript validation or not
ftbl_stockdelete.validateRequired = <?php echo json_encode(CLIENT_VALIDATE) ?>;

// Dynamic selection lists
ftbl_stockdelete.lists["x_IdType"] = <?php echo $tbl_stock_delete->IdType->Lookup->toClientList() ?>;
ftbl_stockdelete.lists["x_IdType"].options = <?php echo JsonEncode($tbl_stock_delete->IdType->lookupOptions()) ?>;
ftbl_stockdelete.lists["x_ID_Location"] = <?php echo $tbl_stock_delete->ID_Location->Lookup->toClientList() ?>;
ftbl_stockdelete.lists["x_ID_Location"].options = <?php echo JsonEncode($tbl_stock_delete->ID_Location->lookupOptions()) ?>;
ftbl_stockdelete.autoSuggests["x_ID_Location"] = <?php echo json_encode(["data" => "ajax=autosuggest"]) ?>;

// Form object for search
</script>
<script>

// Write your client script here, no need to add script tags.
</script>
<?php $tbl_stock_delete->showPageHeader(); ?>
<?php
$tbl_stock_delete->showMessage();
?>
<form name="ftbl_stockdelete" id="ftbl_stockdelete" class="form-inline ew-form ew-delete-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($tbl_stock_delete->CheckToken) { ?>
<input type="hidden" name="<?php echo TOKEN_NAME ?>" value="<?php echo $tbl_stock_delete->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="tbl_stock">
<input type="hidden" name="action" id="action" value="delete">
<?php foreach ($tbl_stock_delete->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode($COMPOSITE_KEY_SEPARATOR, $key) : $key; ?>
<input type="hidden" name="key_m[]" value="<?php echo HtmlEncode($keyvalue) ?>">
<?php } ?>
<div class="card ew-card ew-grid">
<div class="<?php if (IsResponsiveLayout()) { ?>table-responsive <?php } ?>card-body ew-grid-middle-panel">
<table class="table ew-table">
	<thead>
	<tr class="ew-table-header">
<?php if ($tbl_stock->PalletID->Visible) { // PalletID ?>
		<th class="<?php echo $tbl_stock->PalletID->headerCellClass() ?>"><span id="elh_tbl_stock_PalletID" class="tbl_stock_PalletID"><?php echo $tbl_stock->PalletID->caption() ?></span></th>
<?php } ?>
<?php if ($tbl_stock->Code->Visible) { // Code ?>
		<th class="<?php echo $tbl_stock->Code->headerCellClass() ?>"><span id="elh_tbl_stock_Code" class="tbl_stock_Code"><?php echo $tbl_stock->Code->caption() ?></span></th>
<?php } ?>
<?php if ($tbl_stock->IdType->Visible) { // IdType ?>
		<th class="<?php echo $tbl_stock->IdType->headerCellClass() ?>"><span id="elh_tbl_stock_IdType" class="tbl_stock_IdType"><?php echo $tbl_stock->IdType->caption() ?></span></th>
<?php } ?>
<?php if ($tbl_stock->ID_Location->Visible) { // ID_Location ?>
		<th class="<?php echo $tbl_stock->ID_Location->headerCellClass() ?>"><span id="elh_tbl_stock_ID_Location" class="tbl_stock_ID_Location"><?php echo $tbl_stock->ID_Location->caption() ?></span></th>
<?php } ?>
<?php if ($tbl_stock->Pcs_RemainPicking->Visible) { // Pcs_RemainPicking ?>
		<th class="<?php echo $tbl_stock->Pcs_RemainPicking->headerCellClass() ?>"><span id="elh_tbl_stock_Pcs_RemainPicking" class="tbl_stock_Pcs_RemainPicking"><?php echo $tbl_stock->Pcs_RemainPicking->caption() ?></span></th>
<?php } ?>
<?php if ($tbl_stock->MFG->Visible) { // MFG ?>
		<th class="<?php echo $tbl_stock->MFG->headerCellClass() ?>"><span id="elh_tbl_stock_MFG" class="tbl_stock_MFG"><?php echo $tbl_stock->MFG->caption() ?></span></th>
<?php } ?>
<?php if ($tbl_stock->Note_PalletId->Visible) { // Note_PalletId ?>
		<th class="<?php echo $tbl_stock->Note_PalletId->headerCellClass() ?>"><span id="elh_tbl_stock_Note_PalletId" class="tbl_stock_Note_PalletId"><?php echo $tbl_stock->Note_PalletId->caption() ?></span></th>
<?php } ?>
<?php if ($tbl_stock->CreateUser->Visible) { // CreateUser ?>
		<th class="<?php echo $tbl_stock->CreateUser->headerCellClass() ?>"><span id="elh_tbl_stock_CreateUser" class="tbl_stock_CreateUser"><?php echo $tbl_stock->CreateUser->caption() ?></span></th>
<?php } ?>
<?php if ($tbl_stock->CreateDate->Visible) { // CreateDate ?>
		<th class="<?php echo $tbl_stock->CreateDate->headerCellClass() ?>"><span id="elh_tbl_stock_CreateDate" class="tbl_stock_CreateDate"><?php echo $tbl_stock->CreateDate->caption() ?></span></th>
<?php } ?>
	</tr>
	</thead>
	<tbody>
<?php
$tbl_stock_delete->RecCnt = 0;
$i = 0;
while (!$tbl_stock_delete->Recordset->EOF) {
	$tbl_stock_delete->RecCnt++;
	$tbl_stock_delete->RowCnt++;

	// Set row properties
	$tbl_stock->resetAttributes();
	$tbl_stock->RowType = ROWTYPE_VIEW; // View

	// Get the field contents
	$tbl_stock_delete->loadRowValues($tbl_stock_delete->Recordset);

	// Render row
	$tbl_stock_delete->renderRow();
?>
	<tr<?php echo $tbl_stock->rowAttributes() ?>>
<?php if ($tbl_stock->PalletID->Visible) { // PalletID ?>
		<td<?php echo $tbl_stock->PalletID->cellAttributes() ?>>
<span id="el<?php echo $tbl_stock_delete->RowCnt ?>_tbl_stock_PalletID" class="tbl_stock_PalletID">
<span<?php echo $tbl_stock->PalletID->viewAttributes() ?>>
<?php echo $tbl_stock->PalletID->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($tbl_stock->Code->Visible) { // Code ?>
		<td<?php echo $tbl_stock->Code->cellAttributes() ?>>
<span id="el<?php echo $tbl_stock_delete->RowCnt ?>_tbl_stock_Code" class="tbl_stock_Code">
<span<?php echo $tbl_stock->Code->viewAttributes() ?>>
<?php echo $tbl_stock->Code->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($tbl_stock->IdType->Visible) { // IdType ?>
		<td<?php echo $tbl_stock->IdType->cellAttributes() ?>>
<span id="el<?php echo $tbl_stock_delete->RowCnt ?>_tbl_stock_IdType" class="tbl_stock_IdType">
<span<?php echo $tbl_stock->IdType->viewAttributes() ?>>
<?php echo $tbl_stock->IdType->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($tbl_stock->ID_Location->Visible) { // ID_Location ?>
		<td<?php echo $tbl_stock->ID_Location->cellAttributes() ?>>
<span id="el<?php echo $tbl_stock_delete->RowCnt ?>_tbl_stock_ID_Location" class="tbl_stock_ID_Location">
<span<?php echo $tbl_stock->ID_Location->viewAttributes() ?>>
<?php echo $tbl_stock->ID_Location->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($tbl_stock->Pcs_RemainPicking->Visible) { // Pcs_RemainPicking ?>
		<td<?php echo $tbl_stock->Pcs_RemainPicking->cellAttributes() ?>>
<span id="el<?php echo $tbl_stock_delete->RowCnt ?>_tbl_stock_Pcs_RemainPicking" class="tbl_stock_Pcs_RemainPicking">
<span<?php echo $tbl_stock->Pcs_RemainPicking->viewAttributes() ?>>
<?php echo $tbl_stock->Pcs_RemainPicking->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($tbl_stock->MFG->Visible) { // MFG ?>
		<td<?php echo $tbl_stock->MFG->cellAttributes() ?>>
<span id="el<?php echo $tbl_stock_delete->RowCnt ?>_tbl_stock_MFG" class="tbl_stock_MFG">
<span<?php echo $tbl_stock->MFG->viewAttributes() ?>>
<?php echo $tbl_stock->MFG->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($tbl_stock->Note_PalletId->Visible) { // Note_PalletId ?>
		<td<?php echo $tbl_stock->Note_PalletId->cellAttributes() ?>>
<span id="el<?php echo $tbl_stock_delete->RowCnt ?>_tbl_stock_Note_PalletId" class="tbl_stock_Note_PalletId">
<span<?php echo $tbl_stock->Note_PalletId->viewAttributes() ?>>
<?php echo $tbl_stock->Note_PalletId->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($tbl_stock->CreateUser->Visible) { // CreateUser ?>
		<td<?php echo $tbl_stock->CreateUser->cellAttributes() ?>>
<span id="el<?php echo $tbl_stock_delete->RowCnt ?>_tbl_stock_CreateUser" class="tbl_stock_CreateUser">
<span<?php echo $tbl_stock->CreateUser->viewAttributes() ?>>
<?php echo $tbl_stock->CreateUser->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($tbl_stock->CreateDate->Visible) { // CreateDate ?>
		<td<?php echo $tbl_stock->CreateDate->cellAttributes() ?>>
<span id="el<?php echo $tbl_stock_delete->RowCnt ?>_tbl_stock_CreateDate" class="tbl_stock_CreateDate">
<span<?php echo $tbl_stock->CreateDate->viewAttributes() ?>>
<?php echo $tbl_stock->CreateDate->getViewValue() ?></span>
</span>
</td>
<?php } ?>
	</tr>
<?php
	$tbl_stock_delete->Recordset->moveNext();
}
$tbl_stock_delete->Recordset->close();
?>
</tbody>
</table>
</div>
</div>
<div>
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("DeleteBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $tbl_stock_delete->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
</div>
</form>
<?php
$tbl_stock_delete->showPageFooter();
if (DEBUG_ENABLED)
	echo GetDebugMessage();
?>
<script>

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php include_once "footer.php" ?>
<?php
$tbl_stock_delete->terminate();
?>