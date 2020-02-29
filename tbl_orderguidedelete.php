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
$tbl_orderguide_delete = new tbl_orderguide_delete();

// Run the page
$tbl_orderguide_delete->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$tbl_orderguide_delete->Page_Render();
?>
<?php include_once "header.php" ?>
<script>

// Form object
currentPageID = ew.PAGE_ID = "delete";
var ftbl_orderguidedelete = currentForm = new ew.Form("ftbl_orderguidedelete", "delete");

// Form_CustomValidate event
ftbl_orderguidedelete.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

	// Your custom validation code here, return false if invalid.
	return true;
}

// Use JavaScript validation or not
ftbl_orderguidedelete.validateRequired = <?php echo json_encode(CLIENT_VALIDATE) ?>;

// Dynamic selection lists
ftbl_orderguidedelete.lists["x_ID_Location"] = <?php echo $tbl_orderguide_delete->ID_Location->Lookup->toClientList() ?>;
ftbl_orderguidedelete.lists["x_ID_Location"].options = <?php echo JsonEncode($tbl_orderguide_delete->ID_Location->lookupOptions()) ?>;
ftbl_orderguidedelete.autoSuggests["x_ID_Location"] = <?php echo json_encode(["data" => "ajax=autosuggest"]) ?>;

// Form object for search
</script>
<script>

// Write your client script here, no need to add script tags.
</script>
<?php $tbl_orderguide_delete->showPageHeader(); ?>
<?php
$tbl_orderguide_delete->showMessage();
?>
<form name="ftbl_orderguidedelete" id="ftbl_orderguidedelete" class="form-inline ew-form ew-delete-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($tbl_orderguide_delete->CheckToken) { ?>
<input type="hidden" name="<?php echo TOKEN_NAME ?>" value="<?php echo $tbl_orderguide_delete->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="tbl_orderguide">
<input type="hidden" name="action" id="action" value="delete">
<?php foreach ($tbl_orderguide_delete->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode($COMPOSITE_KEY_SEPARATOR, $key) : $key; ?>
<input type="hidden" name="key_m[]" value="<?php echo HtmlEncode($keyvalue) ?>">
<?php } ?>
<div class="card ew-card ew-grid">
<div class="<?php if (IsResponsiveLayout()) { ?>table-responsive <?php } ?>card-body ew-grid-middle-panel">
<table class="table ew-table">
	<thead>
	<tr class="ew-table-header">
<?php if ($tbl_orderguide->Code->Visible) { // Code ?>
		<th class="<?php echo $tbl_orderguide->Code->headerCellClass() ?>"><span id="elh_tbl_orderguide_Code" class="tbl_orderguide_Code"><?php echo $tbl_orderguide->Code->caption() ?></span></th>
<?php } ?>
<?php if ($tbl_orderguide->ProductName->Visible) { // ProductName ?>
		<th class="<?php echo $tbl_orderguide->ProductName->headerCellClass() ?>"><span id="elh_tbl_orderguide_ProductName" class="tbl_orderguide_ProductName"><?php echo $tbl_orderguide->ProductName->caption() ?></span></th>
<?php } ?>
<?php if ($tbl_orderguide->PCS_In->Visible) { // PCS_In ?>
		<th class="<?php echo $tbl_orderguide->PCS_In->headerCellClass() ?>"><span id="elh_tbl_orderguide_PCS_In" class="tbl_orderguide_PCS_In"><?php echo $tbl_orderguide->PCS_In->caption() ?></span></th>
<?php } ?>
<?php if ($tbl_orderguide->PCS->Visible) { // PCS ?>
		<th class="<?php echo $tbl_orderguide->PCS->headerCellClass() ?>"><span id="elh_tbl_orderguide_PCS" class="tbl_orderguide_PCS"><?php echo $tbl_orderguide->PCS->caption() ?></span></th>
<?php } ?>
<?php if ($tbl_orderguide->Qty->Visible) { // Qty ?>
		<th class="<?php echo $tbl_orderguide->Qty->headerCellClass() ?>"><span id="elh_tbl_orderguide_Qty" class="tbl_orderguide_Qty"><?php echo $tbl_orderguide->Qty->caption() ?></span></th>
<?php } ?>
<?php if ($tbl_orderguide->Box->Visible) { // Box ?>
		<th class="<?php echo $tbl_orderguide->Box->headerCellClass() ?>"><span id="elh_tbl_orderguide_Box" class="tbl_orderguide_Box"><?php echo $tbl_orderguide->Box->caption() ?></span></th>
<?php } ?>
<?php if ($tbl_orderguide->ID_Location->Visible) { // ID_Location ?>
		<th class="<?php echo $tbl_orderguide->ID_Location->headerCellClass() ?>"><span id="elh_tbl_orderguide_ID_Location" class="tbl_orderguide_ID_Location"><?php echo $tbl_orderguide->ID_Location->caption() ?></span></th>
<?php } ?>
<?php if ($tbl_orderguide->PalletID->Visible) { // PalletID ?>
		<th class="<?php echo $tbl_orderguide->PalletID->headerCellClass() ?>"><span id="elh_tbl_orderguide_PalletID" class="tbl_orderguide_PalletID"><?php echo $tbl_orderguide->PalletID->caption() ?></span></th>
<?php } ?>
<?php if ($tbl_orderguide->MFG->Visible) { // MFG ?>
		<th class="<?php echo $tbl_orderguide->MFG->headerCellClass() ?>"><span id="elh_tbl_orderguide_MFG" class="tbl_orderguide_MFG"><?php echo $tbl_orderguide->MFG->caption() ?></span></th>
<?php } ?>
<?php if ($tbl_orderguide->DateIn->Visible) { // DateIn ?>
		<th class="<?php echo $tbl_orderguide->DateIn->headerCellClass() ?>"><span id="elh_tbl_orderguide_DateIn" class="tbl_orderguide_DateIn"><?php echo $tbl_orderguide->DateIn->caption() ?></span></th>
<?php } ?>
<?php if ($tbl_orderguide->CreateDate->Visible) { // CreateDate ?>
		<th class="<?php echo $tbl_orderguide->CreateDate->headerCellClass() ?>"><span id="elh_tbl_orderguide_CreateDate" class="tbl_orderguide_CreateDate"><?php echo $tbl_orderguide->CreateDate->caption() ?></span></th>
<?php } ?>
	</tr>
	</thead>
	<tbody>
<?php
$tbl_orderguide_delete->RecCnt = 0;
$i = 0;
while (!$tbl_orderguide_delete->Recordset->EOF) {
	$tbl_orderguide_delete->RecCnt++;
	$tbl_orderguide_delete->RowCnt++;

	// Set row properties
	$tbl_orderguide->resetAttributes();
	$tbl_orderguide->RowType = ROWTYPE_VIEW; // View

	// Get the field contents
	$tbl_orderguide_delete->loadRowValues($tbl_orderguide_delete->Recordset);

	// Render row
	$tbl_orderguide_delete->renderRow();
?>
	<tr<?php echo $tbl_orderguide->rowAttributes() ?>>
<?php if ($tbl_orderguide->Code->Visible) { // Code ?>
		<td<?php echo $tbl_orderguide->Code->cellAttributes() ?>>
<span id="el<?php echo $tbl_orderguide_delete->RowCnt ?>_tbl_orderguide_Code" class="tbl_orderguide_Code">
<span<?php echo $tbl_orderguide->Code->viewAttributes() ?>>
<?php echo $tbl_orderguide->Code->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($tbl_orderguide->ProductName->Visible) { // ProductName ?>
		<td<?php echo $tbl_orderguide->ProductName->cellAttributes() ?>>
<span id="el<?php echo $tbl_orderguide_delete->RowCnt ?>_tbl_orderguide_ProductName" class="tbl_orderguide_ProductName">
<span<?php echo $tbl_orderguide->ProductName->viewAttributes() ?>>
<?php echo $tbl_orderguide->ProductName->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($tbl_orderguide->PCS_In->Visible) { // PCS_In ?>
		<td<?php echo $tbl_orderguide->PCS_In->cellAttributes() ?>>
<span id="el<?php echo $tbl_orderguide_delete->RowCnt ?>_tbl_orderguide_PCS_In" class="tbl_orderguide_PCS_In">
<span<?php echo $tbl_orderguide->PCS_In->viewAttributes() ?>>
<?php echo $tbl_orderguide->PCS_In->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($tbl_orderguide->PCS->Visible) { // PCS ?>
		<td<?php echo $tbl_orderguide->PCS->cellAttributes() ?>>
<span id="el<?php echo $tbl_orderguide_delete->RowCnt ?>_tbl_orderguide_PCS" class="tbl_orderguide_PCS">
<span<?php echo $tbl_orderguide->PCS->viewAttributes() ?>>
<?php echo $tbl_orderguide->PCS->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($tbl_orderguide->Qty->Visible) { // Qty ?>
		<td<?php echo $tbl_orderguide->Qty->cellAttributes() ?>>
<span id="el<?php echo $tbl_orderguide_delete->RowCnt ?>_tbl_orderguide_Qty" class="tbl_orderguide_Qty">
<span<?php echo $tbl_orderguide->Qty->viewAttributes() ?>>
<?php echo $tbl_orderguide->Qty->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($tbl_orderguide->Box->Visible) { // Box ?>
		<td<?php echo $tbl_orderguide->Box->cellAttributes() ?>>
<span id="el<?php echo $tbl_orderguide_delete->RowCnt ?>_tbl_orderguide_Box" class="tbl_orderguide_Box">
<span<?php echo $tbl_orderguide->Box->viewAttributes() ?>>
<?php echo $tbl_orderguide->Box->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($tbl_orderguide->ID_Location->Visible) { // ID_Location ?>
		<td<?php echo $tbl_orderguide->ID_Location->cellAttributes() ?>>
<span id="el<?php echo $tbl_orderguide_delete->RowCnt ?>_tbl_orderguide_ID_Location" class="tbl_orderguide_ID_Location">
<span<?php echo $tbl_orderguide->ID_Location->viewAttributes() ?>>
<?php echo $tbl_orderguide->ID_Location->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($tbl_orderguide->PalletID->Visible) { // PalletID ?>
		<td<?php echo $tbl_orderguide->PalletID->cellAttributes() ?>>
<span id="el<?php echo $tbl_orderguide_delete->RowCnt ?>_tbl_orderguide_PalletID" class="tbl_orderguide_PalletID">
<span<?php echo $tbl_orderguide->PalletID->viewAttributes() ?>>
<?php echo $tbl_orderguide->PalletID->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($tbl_orderguide->MFG->Visible) { // MFG ?>
		<td<?php echo $tbl_orderguide->MFG->cellAttributes() ?>>
<span id="el<?php echo $tbl_orderguide_delete->RowCnt ?>_tbl_orderguide_MFG" class="tbl_orderguide_MFG">
<span<?php echo $tbl_orderguide->MFG->viewAttributes() ?>>
<?php echo $tbl_orderguide->MFG->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($tbl_orderguide->DateIn->Visible) { // DateIn ?>
		<td<?php echo $tbl_orderguide->DateIn->cellAttributes() ?>>
<span id="el<?php echo $tbl_orderguide_delete->RowCnt ?>_tbl_orderguide_DateIn" class="tbl_orderguide_DateIn">
<span<?php echo $tbl_orderguide->DateIn->viewAttributes() ?>>
<?php echo $tbl_orderguide->DateIn->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($tbl_orderguide->CreateDate->Visible) { // CreateDate ?>
		<td<?php echo $tbl_orderguide->CreateDate->cellAttributes() ?>>
<span id="el<?php echo $tbl_orderguide_delete->RowCnt ?>_tbl_orderguide_CreateDate" class="tbl_orderguide_CreateDate">
<span<?php echo $tbl_orderguide->CreateDate->viewAttributes() ?>>
<?php echo $tbl_orderguide->CreateDate->getViewValue() ?></span>
</span>
</td>
<?php } ?>
	</tr>
<?php
	$tbl_orderguide_delete->Recordset->moveNext();
}
$tbl_orderguide_delete->Recordset->close();
?>
</tbody>
</table>
</div>
</div>
<div>
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("DeleteBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $tbl_orderguide_delete->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
</div>
</form>
<?php
$tbl_orderguide_delete->showPageFooter();
if (DEBUG_ENABLED)
	echo GetDebugMessage();
?>
<script>

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php include_once "footer.php" ?>
<?php
$tbl_orderguide_delete->terminate();
?>