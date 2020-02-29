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
$tbl_pallet_delete = new tbl_pallet_delete();

// Run the page
$tbl_pallet_delete->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$tbl_pallet_delete->Page_Render();
?>
<?php include_once "header.php" ?>
<script>

// Form object
currentPageID = ew.PAGE_ID = "delete";
var ftbl_palletdelete = currentForm = new ew.Form("ftbl_palletdelete", "delete");

// Form_CustomValidate event
ftbl_palletdelete.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

	// Your custom validation code here, return false if invalid.
	return true;
}

// Use JavaScript validation or not
ftbl_palletdelete.validateRequired = <?php echo json_encode(CLIENT_VALIDATE) ?>;

// Dynamic selection lists
ftbl_palletdelete.lists["x_Id_Type"] = <?php echo $tbl_pallet_delete->Id_Type->Lookup->toClientList() ?>;
ftbl_palletdelete.lists["x_Id_Type"].options = <?php echo JsonEncode($tbl_pallet_delete->Id_Type->lookupOptions()) ?>;
ftbl_palletdelete.lists["x_ExistStatus"] = <?php echo $tbl_pallet_delete->ExistStatus->Lookup->toClientList() ?>;
ftbl_palletdelete.lists["x_ExistStatus"].options = <?php echo JsonEncode($tbl_pallet_delete->ExistStatus->options(FALSE, TRUE)) ?>;
ftbl_palletdelete.lists["x_PenddingStatus"] = <?php echo $tbl_pallet_delete->PenddingStatus->Lookup->toClientList() ?>;
ftbl_palletdelete.lists["x_PenddingStatus"].options = <?php echo JsonEncode($tbl_pallet_delete->PenddingStatus->options(FALSE, TRUE)) ?>;

// Form object for search
</script>
<script>

// Write your client script here, no need to add script tags.
</script>
<?php $tbl_pallet_delete->showPageHeader(); ?>
<?php
$tbl_pallet_delete->showMessage();
?>
<form name="ftbl_palletdelete" id="ftbl_palletdelete" class="form-inline ew-form ew-delete-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($tbl_pallet_delete->CheckToken) { ?>
<input type="hidden" name="<?php echo TOKEN_NAME ?>" value="<?php echo $tbl_pallet_delete->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="tbl_pallet">
<input type="hidden" name="action" id="action" value="delete">
<?php foreach ($tbl_pallet_delete->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode($COMPOSITE_KEY_SEPARATOR, $key) : $key; ?>
<input type="hidden" name="key_m[]" value="<?php echo HtmlEncode($keyvalue) ?>">
<?php } ?>
<div class="card ew-card ew-grid">
<div class="<?php if (IsResponsiveLayout()) { ?>table-responsive <?php } ?>card-body ew-grid-middle-panel">
<table class="table ew-table">
	<thead>
	<tr class="ew-table-header">
<?php if ($tbl_pallet->PalletID->Visible) { // PalletID ?>
		<th class="<?php echo $tbl_pallet->PalletID->headerCellClass() ?>"><span id="elh_tbl_pallet_PalletID" class="tbl_pallet_PalletID"><?php echo $tbl_pallet->PalletID->caption() ?></span></th>
<?php } ?>
<?php if ($tbl_pallet->Code->Visible) { // Code ?>
		<th class="<?php echo $tbl_pallet->Code->headerCellClass() ?>"><span id="elh_tbl_pallet_Code" class="tbl_pallet_Code"><?php echo $tbl_pallet->Code->caption() ?></span></th>
<?php } ?>
<?php if ($tbl_pallet->Id_Type->Visible) { // Id_Type ?>
		<th class="<?php echo $tbl_pallet->Id_Type->headerCellClass() ?>"><span id="elh_tbl_pallet_Id_Type" class="tbl_pallet_Id_Type"><?php echo $tbl_pallet->Id_Type->caption() ?></span></th>
<?php } ?>
<?php if ($tbl_pallet->PCS->Visible) { // PCS ?>
		<th class="<?php echo $tbl_pallet->PCS->headerCellClass() ?>"><span id="elh_tbl_pallet_PCS" class="tbl_pallet_PCS"><?php echo $tbl_pallet->PCS->caption() ?></span></th>
<?php } ?>
<?php if ($tbl_pallet->ExistStatus->Visible) { // ExistStatus ?>
		<th class="<?php echo $tbl_pallet->ExistStatus->headerCellClass() ?>"><span id="elh_tbl_pallet_ExistStatus" class="tbl_pallet_ExistStatus"><?php echo $tbl_pallet->ExistStatus->caption() ?></span></th>
<?php } ?>
<?php if ($tbl_pallet->CreateUser->Visible) { // CreateUser ?>
		<th class="<?php echo $tbl_pallet->CreateUser->headerCellClass() ?>"><span id="elh_tbl_pallet_CreateUser" class="tbl_pallet_CreateUser"><?php echo $tbl_pallet->CreateUser->caption() ?></span></th>
<?php } ?>
<?php if ($tbl_pallet->CreateDate->Visible) { // CreateDate ?>
		<th class="<?php echo $tbl_pallet->CreateDate->headerCellClass() ?>"><span id="elh_tbl_pallet_CreateDate" class="tbl_pallet_CreateDate"><?php echo $tbl_pallet->CreateDate->caption() ?></span></th>
<?php } ?>
<?php if ($tbl_pallet->PenddingStatus->Visible) { // PenddingStatus ?>
		<th class="<?php echo $tbl_pallet->PenddingStatus->headerCellClass() ?>"><span id="elh_tbl_pallet_PenddingStatus" class="tbl_pallet_PenddingStatus"><?php echo $tbl_pallet->PenddingStatus->caption() ?></span></th>
<?php } ?>
<?php if ($tbl_pallet->UserFinishPendding->Visible) { // UserFinishPendding ?>
		<th class="<?php echo $tbl_pallet->UserFinishPendding->headerCellClass() ?>"><span id="elh_tbl_pallet_UserFinishPendding" class="tbl_pallet_UserFinishPendding"><?php echo $tbl_pallet->UserFinishPendding->caption() ?></span></th>
<?php } ?>
<?php if ($tbl_pallet->DateTimeFinishPedding->Visible) { // DateTimeFinishPedding ?>
		<th class="<?php echo $tbl_pallet->DateTimeFinishPedding->headerCellClass() ?>"><span id="elh_tbl_pallet_DateTimeFinishPedding" class="tbl_pallet_DateTimeFinishPedding"><?php echo $tbl_pallet->DateTimeFinishPedding->caption() ?></span></th>
<?php } ?>
	</tr>
	</thead>
	<tbody>
<?php
$tbl_pallet_delete->RecCnt = 0;
$i = 0;
while (!$tbl_pallet_delete->Recordset->EOF) {
	$tbl_pallet_delete->RecCnt++;
	$tbl_pallet_delete->RowCnt++;

	// Set row properties
	$tbl_pallet->resetAttributes();
	$tbl_pallet->RowType = ROWTYPE_VIEW; // View

	// Get the field contents
	$tbl_pallet_delete->loadRowValues($tbl_pallet_delete->Recordset);

	// Render row
	$tbl_pallet_delete->renderRow();
?>
	<tr<?php echo $tbl_pallet->rowAttributes() ?>>
<?php if ($tbl_pallet->PalletID->Visible) { // PalletID ?>
		<td<?php echo $tbl_pallet->PalletID->cellAttributes() ?>>
<span id="el<?php echo $tbl_pallet_delete->RowCnt ?>_tbl_pallet_PalletID" class="tbl_pallet_PalletID">
<span<?php echo $tbl_pallet->PalletID->viewAttributes() ?>>
<?php echo $tbl_pallet->PalletID->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($tbl_pallet->Code->Visible) { // Code ?>
		<td<?php echo $tbl_pallet->Code->cellAttributes() ?>>
<span id="el<?php echo $tbl_pallet_delete->RowCnt ?>_tbl_pallet_Code" class="tbl_pallet_Code">
<span<?php echo $tbl_pallet->Code->viewAttributes() ?>>
<?php echo $tbl_pallet->Code->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($tbl_pallet->Id_Type->Visible) { // Id_Type ?>
		<td<?php echo $tbl_pallet->Id_Type->cellAttributes() ?>>
<span id="el<?php echo $tbl_pallet_delete->RowCnt ?>_tbl_pallet_Id_Type" class="tbl_pallet_Id_Type">
<span<?php echo $tbl_pallet->Id_Type->viewAttributes() ?>>
<?php echo $tbl_pallet->Id_Type->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($tbl_pallet->PCS->Visible) { // PCS ?>
		<td<?php echo $tbl_pallet->PCS->cellAttributes() ?>>
<span id="el<?php echo $tbl_pallet_delete->RowCnt ?>_tbl_pallet_PCS" class="tbl_pallet_PCS">
<span<?php echo $tbl_pallet->PCS->viewAttributes() ?>>
<?php echo $tbl_pallet->PCS->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($tbl_pallet->ExistStatus->Visible) { // ExistStatus ?>
		<td<?php echo $tbl_pallet->ExistStatus->cellAttributes() ?>>
<span id="el<?php echo $tbl_pallet_delete->RowCnt ?>_tbl_pallet_ExistStatus" class="tbl_pallet_ExistStatus">
<span<?php echo $tbl_pallet->ExistStatus->viewAttributes() ?>>
<?php echo $tbl_pallet->ExistStatus->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($tbl_pallet->CreateUser->Visible) { // CreateUser ?>
		<td<?php echo $tbl_pallet->CreateUser->cellAttributes() ?>>
<span id="el<?php echo $tbl_pallet_delete->RowCnt ?>_tbl_pallet_CreateUser" class="tbl_pallet_CreateUser">
<span<?php echo $tbl_pallet->CreateUser->viewAttributes() ?>>
<?php echo $tbl_pallet->CreateUser->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($tbl_pallet->CreateDate->Visible) { // CreateDate ?>
		<td<?php echo $tbl_pallet->CreateDate->cellAttributes() ?>>
<span id="el<?php echo $tbl_pallet_delete->RowCnt ?>_tbl_pallet_CreateDate" class="tbl_pallet_CreateDate">
<span<?php echo $tbl_pallet->CreateDate->viewAttributes() ?>>
<?php echo $tbl_pallet->CreateDate->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($tbl_pallet->PenddingStatus->Visible) { // PenddingStatus ?>
		<td<?php echo $tbl_pallet->PenddingStatus->cellAttributes() ?>>
<span id="el<?php echo $tbl_pallet_delete->RowCnt ?>_tbl_pallet_PenddingStatus" class="tbl_pallet_PenddingStatus">
<span<?php echo $tbl_pallet->PenddingStatus->viewAttributes() ?>>
<?php echo $tbl_pallet->PenddingStatus->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($tbl_pallet->UserFinishPendding->Visible) { // UserFinishPendding ?>
		<td<?php echo $tbl_pallet->UserFinishPendding->cellAttributes() ?>>
<span id="el<?php echo $tbl_pallet_delete->RowCnt ?>_tbl_pallet_UserFinishPendding" class="tbl_pallet_UserFinishPendding">
<span<?php echo $tbl_pallet->UserFinishPendding->viewAttributes() ?>>
<?php echo $tbl_pallet->UserFinishPendding->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($tbl_pallet->DateTimeFinishPedding->Visible) { // DateTimeFinishPedding ?>
		<td<?php echo $tbl_pallet->DateTimeFinishPedding->cellAttributes() ?>>
<span id="el<?php echo $tbl_pallet_delete->RowCnt ?>_tbl_pallet_DateTimeFinishPedding" class="tbl_pallet_DateTimeFinishPedding">
<span<?php echo $tbl_pallet->DateTimeFinishPedding->viewAttributes() ?>>
<?php echo $tbl_pallet->DateTimeFinishPedding->getViewValue() ?></span>
</span>
</td>
<?php } ?>
	</tr>
<?php
	$tbl_pallet_delete->Recordset->moveNext();
}
$tbl_pallet_delete->Recordset->close();
?>
</tbody>
</table>
</div>
</div>
<div>
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("DeleteBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $tbl_pallet_delete->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
</div>
</form>
<?php
$tbl_pallet_delete->showPageFooter();
if (DEBUG_ENABLED)
	echo GetDebugMessage();
?>
<script>

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php include_once "footer.php" ?>
<?php
$tbl_pallet_delete->terminate();
?>