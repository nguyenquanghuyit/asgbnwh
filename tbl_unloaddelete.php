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
$tbl_unload_delete = new tbl_unload_delete();

// Run the page
$tbl_unload_delete->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$tbl_unload_delete->Page_Render();
?>
<?php include_once "header.php" ?>
<script>

// Form object
currentPageID = ew.PAGE_ID = "delete";
var ftbl_unloaddelete = currentForm = new ew.Form("ftbl_unloaddelete", "delete");

// Form_CustomValidate event
ftbl_unloaddelete.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

	// Your custom validation code here, return false if invalid.
	return true;
}

// Use JavaScript validation or not
ftbl_unloaddelete.validateRequired = <?php echo json_encode(CLIENT_VALIDATE) ?>;

// Dynamic selection lists
ftbl_unloaddelete.lists["x_Code"] = <?php echo $tbl_unload_delete->Code->Lookup->toClientList() ?>;
ftbl_unloaddelete.lists["x_Code"].options = <?php echo JsonEncode($tbl_unload_delete->Code->lookupOptions()) ?>;
ftbl_unloaddelete.autoSuggests["x_Code"] = <?php echo json_encode(["data" => "ajax=autosuggest"]) ?>;
ftbl_unloaddelete.lists["x_IdCode"] = <?php echo $tbl_unload_delete->IdCode->Lookup->toClientList() ?>;
ftbl_unloaddelete.lists["x_IdCode"].options = <?php echo JsonEncode($tbl_unload_delete->IdCode->lookupOptions()) ?>;
ftbl_unloaddelete.autoSuggests["x_IdCode"] = <?php echo json_encode(["data" => "ajax=autosuggest"]) ?>;

// Form object for search
</script>
<script>

// Write your client script here, no need to add script tags.
</script>
<?php $tbl_unload_delete->showPageHeader(); ?>
<?php
$tbl_unload_delete->showMessage();
?>
<form name="ftbl_unloaddelete" id="ftbl_unloaddelete" class="form-inline ew-form ew-delete-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($tbl_unload_delete->CheckToken) { ?>
<input type="hidden" name="<?php echo TOKEN_NAME ?>" value="<?php echo $tbl_unload_delete->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="tbl_unload">
<input type="hidden" name="action" id="action" value="delete">
<?php foreach ($tbl_unload_delete->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode($COMPOSITE_KEY_SEPARATOR, $key) : $key; ?>
<input type="hidden" name="key_m[]" value="<?php echo HtmlEncode($keyvalue) ?>">
<?php } ?>
<div class="card ew-card ew-grid">
<div class="<?php if (IsResponsiveLayout()) { ?>table-responsive <?php } ?>card-body ew-grid-middle-panel">
<table class="table ew-table">
	<thead>
	<tr class="ew-table-header">
<?php if ($tbl_unload->Code->Visible) { // Code ?>
		<th class="<?php echo $tbl_unload->Code->headerCellClass() ?>"><span id="elh_tbl_unload_Code" class="tbl_unload_Code"><?php echo $tbl_unload->Code->caption() ?></span></th>
<?php } ?>
<?php if ($tbl_unload->IdCode->Visible) { // IdCode ?>
		<th class="<?php echo $tbl_unload->IdCode->headerCellClass() ?>"><span id="elh_tbl_unload_IdCode" class="tbl_unload_IdCode"><?php echo $tbl_unload->IdCode->caption() ?></span></th>
<?php } ?>
<?php if ($tbl_unload->PCS->Visible) { // PCS ?>
		<th class="<?php echo $tbl_unload->PCS->headerCellClass() ?>"><span id="elh_tbl_unload_PCS" class="tbl_unload_PCS"><?php echo $tbl_unload->PCS->caption() ?></span></th>
<?php } ?>
<?php if ($tbl_unload->RealPCS->Visible) { // RealPCS ?>
		<th class="<?php echo $tbl_unload->RealPCS->headerCellClass() ?>"><span id="elh_tbl_unload_RealPCS" class="tbl_unload_RealPCS"><?php echo $tbl_unload->RealPCS->caption() ?></span></th>
<?php } ?>
<?php if ($tbl_unload->Description->Visible) { // Description ?>
		<th class="<?php echo $tbl_unload->Description->headerCellClass() ?>"><span id="elh_tbl_unload_Description" class="tbl_unload_Description"><?php echo $tbl_unload->Description->caption() ?></span></th>
<?php } ?>
<?php if ($tbl_unload->CreateUser->Visible) { // CreateUser ?>
		<th class="<?php echo $tbl_unload->CreateUser->headerCellClass() ?>"><span id="elh_tbl_unload_CreateUser" class="tbl_unload_CreateUser"><?php echo $tbl_unload->CreateUser->caption() ?></span></th>
<?php } ?>
<?php if ($tbl_unload->CreateDate->Visible) { // CreateDate ?>
		<th class="<?php echo $tbl_unload->CreateDate->headerCellClass() ?>"><span id="elh_tbl_unload_CreateDate" class="tbl_unload_CreateDate"><?php echo $tbl_unload->CreateDate->caption() ?></span></th>
<?php } ?>
<?php if ($tbl_unload->MFG->Visible) { // MFG ?>
		<th class="<?php echo $tbl_unload->MFG->headerCellClass() ?>"><span id="elh_tbl_unload_MFG" class="tbl_unload_MFG"><?php echo $tbl_unload->MFG->caption() ?></span></th>
<?php } ?>
	</tr>
	</thead>
	<tbody>
<?php
$tbl_unload_delete->RecCnt = 0;
$i = 0;
while (!$tbl_unload_delete->Recordset->EOF) {
	$tbl_unload_delete->RecCnt++;
	$tbl_unload_delete->RowCnt++;

	// Set row properties
	$tbl_unload->resetAttributes();
	$tbl_unload->RowType = ROWTYPE_VIEW; // View

	// Get the field contents
	$tbl_unload_delete->loadRowValues($tbl_unload_delete->Recordset);

	// Render row
	$tbl_unload_delete->renderRow();
?>
	<tr<?php echo $tbl_unload->rowAttributes() ?>>
<?php if ($tbl_unload->Code->Visible) { // Code ?>
		<td<?php echo $tbl_unload->Code->cellAttributes() ?>>
<span id="el<?php echo $tbl_unload_delete->RowCnt ?>_tbl_unload_Code" class="tbl_unload_Code">
<span<?php echo $tbl_unload->Code->viewAttributes() ?>>
<?php echo $tbl_unload->Code->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($tbl_unload->IdCode->Visible) { // IdCode ?>
		<td<?php echo $tbl_unload->IdCode->cellAttributes() ?>>
<span id="el<?php echo $tbl_unload_delete->RowCnt ?>_tbl_unload_IdCode" class="tbl_unload_IdCode">
<span<?php echo $tbl_unload->IdCode->viewAttributes() ?>>
<?php echo $tbl_unload->IdCode->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($tbl_unload->PCS->Visible) { // PCS ?>
		<td<?php echo $tbl_unload->PCS->cellAttributes() ?>>
<span id="el<?php echo $tbl_unload_delete->RowCnt ?>_tbl_unload_PCS" class="tbl_unload_PCS">
<span<?php echo $tbl_unload->PCS->viewAttributes() ?>>
<?php echo $tbl_unload->PCS->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($tbl_unload->RealPCS->Visible) { // RealPCS ?>
		<td<?php echo $tbl_unload->RealPCS->cellAttributes() ?>>
<span id="el<?php echo $tbl_unload_delete->RowCnt ?>_tbl_unload_RealPCS" class="tbl_unload_RealPCS">
<span<?php echo $tbl_unload->RealPCS->viewAttributes() ?>>
<?php echo $tbl_unload->RealPCS->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($tbl_unload->Description->Visible) { // Description ?>
		<td<?php echo $tbl_unload->Description->cellAttributes() ?>>
<span id="el<?php echo $tbl_unload_delete->RowCnt ?>_tbl_unload_Description" class="tbl_unload_Description">
<span<?php echo $tbl_unload->Description->viewAttributes() ?>>
<?php echo $tbl_unload->Description->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($tbl_unload->CreateUser->Visible) { // CreateUser ?>
		<td<?php echo $tbl_unload->CreateUser->cellAttributes() ?>>
<span id="el<?php echo $tbl_unload_delete->RowCnt ?>_tbl_unload_CreateUser" class="tbl_unload_CreateUser">
<span<?php echo $tbl_unload->CreateUser->viewAttributes() ?>>
<?php echo $tbl_unload->CreateUser->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($tbl_unload->CreateDate->Visible) { // CreateDate ?>
		<td<?php echo $tbl_unload->CreateDate->cellAttributes() ?>>
<span id="el<?php echo $tbl_unload_delete->RowCnt ?>_tbl_unload_CreateDate" class="tbl_unload_CreateDate">
<span<?php echo $tbl_unload->CreateDate->viewAttributes() ?>>
<?php echo $tbl_unload->CreateDate->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($tbl_unload->MFG->Visible) { // MFG ?>
		<td<?php echo $tbl_unload->MFG->cellAttributes() ?>>
<span id="el<?php echo $tbl_unload_delete->RowCnt ?>_tbl_unload_MFG" class="tbl_unload_MFG">
<span<?php echo $tbl_unload->MFG->viewAttributes() ?>>
<?php echo $tbl_unload->MFG->getViewValue() ?></span>
</span>
</td>
<?php } ?>
	</tr>
<?php
	$tbl_unload_delete->Recordset->moveNext();
}
$tbl_unload_delete->Recordset->close();
?>
</tbody>
</table>
</div>
</div>
<div>
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("DeleteBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $tbl_unload_delete->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
</div>
</form>
<?php
$tbl_unload_delete->showPageFooter();
if (DEBUG_ENABLED)
	echo GetDebugMessage();
?>
<script>

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php include_once "footer.php" ?>
<?php
$tbl_unload_delete->terminate();
?>