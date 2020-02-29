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
$tbl_guider_delete = new tbl_guider_delete();

// Run the page
$tbl_guider_delete->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$tbl_guider_delete->Page_Render();
?>
<?php include_once "header.php" ?>
<script>

// Form object
currentPageID = ew.PAGE_ID = "delete";
var ftbl_guiderdelete = currentForm = new ew.Form("ftbl_guiderdelete", "delete");

// Form_CustomValidate event
ftbl_guiderdelete.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

	// Your custom validation code here, return false if invalid.
	return true;
}

// Use JavaScript validation or not
ftbl_guiderdelete.validateRequired = <?php echo json_encode(CLIENT_VALIDATE) ?>;

// Dynamic selection lists
ftbl_guiderdelete.lists["x_ID_Location"] = <?php echo $tbl_guider_delete->ID_Location->Lookup->toClientList() ?>;
ftbl_guiderdelete.lists["x_ID_Location"].options = <?php echo JsonEncode($tbl_guider_delete->ID_Location->lookupOptions()) ?>;
ftbl_guiderdelete.autoSuggests["x_ID_Location"] = <?php echo json_encode(["data" => "ajax=autosuggest"]) ?>;

// Form object for search
</script>
<script>

// Write your client script here, no need to add script tags.
</script>
<?php $tbl_guider_delete->showPageHeader(); ?>
<?php
$tbl_guider_delete->showMessage();
?>
<form name="ftbl_guiderdelete" id="ftbl_guiderdelete" class="form-inline ew-form ew-delete-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($tbl_guider_delete->CheckToken) { ?>
<input type="hidden" name="<?php echo TOKEN_NAME ?>" value="<?php echo $tbl_guider_delete->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="tbl_guider">
<input type="hidden" name="action" id="action" value="delete">
<?php foreach ($tbl_guider_delete->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode($COMPOSITE_KEY_SEPARATOR, $key) : $key; ?>
<input type="hidden" name="key_m[]" value="<?php echo HtmlEncode($keyvalue) ?>">
<?php } ?>
<div class="card ew-card ew-grid">
<div class="<?php if (IsResponsiveLayout()) { ?>table-responsive <?php } ?>card-body ew-grid-middle-panel">
<table class="table ew-table">
	<thead>
	<tr class="ew-table-header">
<?php if ($tbl_guider->Code->Visible) { // Code ?>
		<th class="<?php echo $tbl_guider->Code->headerCellClass() ?>"><span id="elh_tbl_guider_Code" class="tbl_guider_Code"><?php echo $tbl_guider->Code->caption() ?></span></th>
<?php } ?>
<?php if ($tbl_guider->ProductName->Visible) { // ProductName ?>
		<th class="<?php echo $tbl_guider->ProductName->headerCellClass() ?>"><span id="elh_tbl_guider_ProductName" class="tbl_guider_ProductName"><?php echo $tbl_guider->ProductName->caption() ?></span></th>
<?php } ?>
<?php if ($tbl_guider->PCS_Request->Visible) { // PCS_Request ?>
		<th class="<?php echo $tbl_guider->PCS_Request->headerCellClass() ?>"><span id="elh_tbl_guider_PCS_Request" class="tbl_guider_PCS_Request"><?php echo $tbl_guider->PCS_Request->caption() ?></span></th>
<?php } ?>
<?php if ($tbl_guider->ID_Location->Visible) { // ID_Location ?>
		<th class="<?php echo $tbl_guider->ID_Location->headerCellClass() ?>"><span id="elh_tbl_guider_ID_Location" class="tbl_guider_ID_Location"><?php echo $tbl_guider->ID_Location->caption() ?></span></th>
<?php } ?>
<?php if ($tbl_guider->PCS_In->Visible) { // PCS_In ?>
		<th class="<?php echo $tbl_guider->PCS_In->headerCellClass() ?>"><span id="elh_tbl_guider_PCS_In" class="tbl_guider_PCS_In"><?php echo $tbl_guider->PCS_In->caption() ?></span></th>
<?php } ?>
<?php if ($tbl_guider->PCS->Visible) { // PCS ?>
		<th class="<?php echo $tbl_guider->PCS->headerCellClass() ?>"><span id="elh_tbl_guider_PCS" class="tbl_guider_PCS"><?php echo $tbl_guider->PCS->caption() ?></span></th>
<?php } ?>
<?php if ($tbl_guider->PalletID->Visible) { // PalletID ?>
		<th class="<?php echo $tbl_guider->PalletID->headerCellClass() ?>"><span id="elh_tbl_guider_PalletID" class="tbl_guider_PalletID"><?php echo $tbl_guider->PalletID->caption() ?></span></th>
<?php } ?>
<?php if ($tbl_guider->DateIn->Visible) { // DateIn ?>
		<th class="<?php echo $tbl_guider->DateIn->headerCellClass() ?>"><span id="elh_tbl_guider_DateIn" class="tbl_guider_DateIn"><?php echo $tbl_guider->DateIn->caption() ?></span></th>
<?php } ?>
	</tr>
	</thead>
	<tbody>
<?php
$tbl_guider_delete->RecCnt = 0;
$i = 0;
while (!$tbl_guider_delete->Recordset->EOF) {
	$tbl_guider_delete->RecCnt++;
	$tbl_guider_delete->RowCnt++;

	// Set row properties
	$tbl_guider->resetAttributes();
	$tbl_guider->RowType = ROWTYPE_VIEW; // View

	// Get the field contents
	$tbl_guider_delete->loadRowValues($tbl_guider_delete->Recordset);

	// Render row
	$tbl_guider_delete->renderRow();
?>
	<tr<?php echo $tbl_guider->rowAttributes() ?>>
<?php if ($tbl_guider->Code->Visible) { // Code ?>
		<td<?php echo $tbl_guider->Code->cellAttributes() ?>>
<span id="el<?php echo $tbl_guider_delete->RowCnt ?>_tbl_guider_Code" class="tbl_guider_Code">
<span<?php echo $tbl_guider->Code->viewAttributes() ?>>
<?php echo $tbl_guider->Code->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($tbl_guider->ProductName->Visible) { // ProductName ?>
		<td<?php echo $tbl_guider->ProductName->cellAttributes() ?>>
<span id="el<?php echo $tbl_guider_delete->RowCnt ?>_tbl_guider_ProductName" class="tbl_guider_ProductName">
<span<?php echo $tbl_guider->ProductName->viewAttributes() ?>>
<?php echo $tbl_guider->ProductName->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($tbl_guider->PCS_Request->Visible) { // PCS_Request ?>
		<td<?php echo $tbl_guider->PCS_Request->cellAttributes() ?>>
<span id="el<?php echo $tbl_guider_delete->RowCnt ?>_tbl_guider_PCS_Request" class="tbl_guider_PCS_Request">
<span<?php echo $tbl_guider->PCS_Request->viewAttributes() ?>>
<?php echo $tbl_guider->PCS_Request->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($tbl_guider->ID_Location->Visible) { // ID_Location ?>
		<td<?php echo $tbl_guider->ID_Location->cellAttributes() ?>>
<span id="el<?php echo $tbl_guider_delete->RowCnt ?>_tbl_guider_ID_Location" class="tbl_guider_ID_Location">
<span<?php echo $tbl_guider->ID_Location->viewAttributes() ?>>
<?php echo $tbl_guider->ID_Location->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($tbl_guider->PCS_In->Visible) { // PCS_In ?>
		<td<?php echo $tbl_guider->PCS_In->cellAttributes() ?>>
<span id="el<?php echo $tbl_guider_delete->RowCnt ?>_tbl_guider_PCS_In" class="tbl_guider_PCS_In">
<span<?php echo $tbl_guider->PCS_In->viewAttributes() ?>>
<?php echo $tbl_guider->PCS_In->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($tbl_guider->PCS->Visible) { // PCS ?>
		<td<?php echo $tbl_guider->PCS->cellAttributes() ?>>
<span id="el<?php echo $tbl_guider_delete->RowCnt ?>_tbl_guider_PCS" class="tbl_guider_PCS">
<span<?php echo $tbl_guider->PCS->viewAttributes() ?>>
<?php echo $tbl_guider->PCS->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($tbl_guider->PalletID->Visible) { // PalletID ?>
		<td<?php echo $tbl_guider->PalletID->cellAttributes() ?>>
<span id="el<?php echo $tbl_guider_delete->RowCnt ?>_tbl_guider_PalletID" class="tbl_guider_PalletID">
<span<?php echo $tbl_guider->PalletID->viewAttributes() ?>>
<?php echo $tbl_guider->PalletID->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($tbl_guider->DateIn->Visible) { // DateIn ?>
		<td<?php echo $tbl_guider->DateIn->cellAttributes() ?>>
<span id="el<?php echo $tbl_guider_delete->RowCnt ?>_tbl_guider_DateIn" class="tbl_guider_DateIn">
<span<?php echo $tbl_guider->DateIn->viewAttributes() ?>>
<?php echo $tbl_guider->DateIn->getViewValue() ?></span>
</span>
</td>
<?php } ?>
	</tr>
<?php
	$tbl_guider_delete->Recordset->moveNext();
}
$tbl_guider_delete->Recordset->close();
?>
</tbody>
</table>
</div>
</div>
<div>
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("DeleteBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $tbl_guider_delete->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
</div>
</form>
<?php
$tbl_guider_delete->showPageFooter();
if (DEBUG_ENABLED)
	echo GetDebugMessage();
?>
<script>

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php include_once "footer.php" ?>
<?php
$tbl_guider_delete->terminate();
?>