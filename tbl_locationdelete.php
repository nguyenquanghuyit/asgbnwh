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
$tbl_location_delete = new tbl_location_delete();

// Run the page
$tbl_location_delete->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$tbl_location_delete->Page_Render();
?>
<?php include_once "header.php" ?>
<script>

// Form object
currentPageID = ew.PAGE_ID = "delete";
var ftbl_locationdelete = currentForm = new ew.Form("ftbl_locationdelete", "delete");

// Form_CustomValidate event
ftbl_locationdelete.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

	// Your custom validation code here, return false if invalid.
	return true;
}

// Use JavaScript validation or not
ftbl_locationdelete.validateRequired = <?php echo json_encode(CLIENT_VALIDATE) ?>;

// Dynamic selection lists
// Form object for search

</script>
<script>

// Write your client script here, no need to add script tags.
</script>
<?php $tbl_location_delete->showPageHeader(); ?>
<?php
$tbl_location_delete->showMessage();
?>
<form name="ftbl_locationdelete" id="ftbl_locationdelete" class="form-inline ew-form ew-delete-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($tbl_location_delete->CheckToken) { ?>
<input type="hidden" name="<?php echo TOKEN_NAME ?>" value="<?php echo $tbl_location_delete->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="tbl_location">
<input type="hidden" name="action" id="action" value="delete">
<?php foreach ($tbl_location_delete->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode($COMPOSITE_KEY_SEPARATOR, $key) : $key; ?>
<input type="hidden" name="key_m[]" value="<?php echo HtmlEncode($keyvalue) ?>">
<?php } ?>
<div class="card ew-card ew-grid">
<div class="<?php if (IsResponsiveLayout()) { ?>table-responsive <?php } ?>card-body ew-grid-middle-panel">
<table class="table ew-table">
	<thead>
	<tr class="ew-table-header">
<?php if ($tbl_location->Location->Visible) { // Location ?>
		<th class="<?php echo $tbl_location->Location->headerCellClass() ?>"><span id="elh_tbl_location_Location" class="tbl_location_Location"><?php echo $tbl_location->Location->caption() ?></span></th>
<?php } ?>
<?php if ($tbl_location->Description->Visible) { // Description ?>
		<th class="<?php echo $tbl_location->Description->headerCellClass() ?>"><span id="elh_tbl_location_Description" class="tbl_location_Description"><?php echo $tbl_location->Description->caption() ?></span></th>
<?php } ?>
<?php if ($tbl_location->CreateUser->Visible) { // CreateUser ?>
		<th class="<?php echo $tbl_location->CreateUser->headerCellClass() ?>"><span id="elh_tbl_location_CreateUser" class="tbl_location_CreateUser"><?php echo $tbl_location->CreateUser->caption() ?></span></th>
<?php } ?>
<?php if ($tbl_location->CreateDate->Visible) { // CreateDate ?>
		<th class="<?php echo $tbl_location->CreateDate->headerCellClass() ?>"><span id="elh_tbl_location_CreateDate" class="tbl_location_CreateDate"><?php echo $tbl_location->CreateDate->caption() ?></span></th>
<?php } ?>
<?php if ($tbl_location->UpdateUser->Visible) { // UpdateUser ?>
		<th class="<?php echo $tbl_location->UpdateUser->headerCellClass() ?>"><span id="elh_tbl_location_UpdateUser" class="tbl_location_UpdateUser"><?php echo $tbl_location->UpdateUser->caption() ?></span></th>
<?php } ?>
<?php if ($tbl_location->UpdateDate->Visible) { // UpdateDate ?>
		<th class="<?php echo $tbl_location->UpdateDate->headerCellClass() ?>"><span id="elh_tbl_location_UpdateDate" class="tbl_location_UpdateDate"><?php echo $tbl_location->UpdateDate->caption() ?></span></th>
<?php } ?>
	</tr>
	</thead>
	<tbody>
<?php
$tbl_location_delete->RecCnt = 0;
$i = 0;
while (!$tbl_location_delete->Recordset->EOF) {
	$tbl_location_delete->RecCnt++;
	$tbl_location_delete->RowCnt++;

	// Set row properties
	$tbl_location->resetAttributes();
	$tbl_location->RowType = ROWTYPE_VIEW; // View

	// Get the field contents
	$tbl_location_delete->loadRowValues($tbl_location_delete->Recordset);

	// Render row
	$tbl_location_delete->renderRow();
?>
	<tr<?php echo $tbl_location->rowAttributes() ?>>
<?php if ($tbl_location->Location->Visible) { // Location ?>
		<td<?php echo $tbl_location->Location->cellAttributes() ?>>
<span id="el<?php echo $tbl_location_delete->RowCnt ?>_tbl_location_Location" class="tbl_location_Location">
<span<?php echo $tbl_location->Location->viewAttributes() ?>>
<?php echo $tbl_location->Location->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($tbl_location->Description->Visible) { // Description ?>
		<td<?php echo $tbl_location->Description->cellAttributes() ?>>
<span id="el<?php echo $tbl_location_delete->RowCnt ?>_tbl_location_Description" class="tbl_location_Description">
<span<?php echo $tbl_location->Description->viewAttributes() ?>>
<?php echo $tbl_location->Description->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($tbl_location->CreateUser->Visible) { // CreateUser ?>
		<td<?php echo $tbl_location->CreateUser->cellAttributes() ?>>
<span id="el<?php echo $tbl_location_delete->RowCnt ?>_tbl_location_CreateUser" class="tbl_location_CreateUser">
<span<?php echo $tbl_location->CreateUser->viewAttributes() ?>>
<?php echo $tbl_location->CreateUser->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($tbl_location->CreateDate->Visible) { // CreateDate ?>
		<td<?php echo $tbl_location->CreateDate->cellAttributes() ?>>
<span id="el<?php echo $tbl_location_delete->RowCnt ?>_tbl_location_CreateDate" class="tbl_location_CreateDate">
<span<?php echo $tbl_location->CreateDate->viewAttributes() ?>>
<?php echo $tbl_location->CreateDate->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($tbl_location->UpdateUser->Visible) { // UpdateUser ?>
		<td<?php echo $tbl_location->UpdateUser->cellAttributes() ?>>
<span id="el<?php echo $tbl_location_delete->RowCnt ?>_tbl_location_UpdateUser" class="tbl_location_UpdateUser">
<span<?php echo $tbl_location->UpdateUser->viewAttributes() ?>>
<?php echo $tbl_location->UpdateUser->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($tbl_location->UpdateDate->Visible) { // UpdateDate ?>
		<td<?php echo $tbl_location->UpdateDate->cellAttributes() ?>>
<span id="el<?php echo $tbl_location_delete->RowCnt ?>_tbl_location_UpdateDate" class="tbl_location_UpdateDate">
<span<?php echo $tbl_location->UpdateDate->viewAttributes() ?>>
<?php echo $tbl_location->UpdateDate->getViewValue() ?></span>
</span>
</td>
<?php } ?>
	</tr>
<?php
	$tbl_location_delete->Recordset->moveNext();
}
$tbl_location_delete->Recordset->close();
?>
</tbody>
</table>
</div>
</div>
<div>
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("DeleteBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $tbl_location_delete->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
</div>
</form>
<?php
$tbl_location_delete->showPageFooter();
if (DEBUG_ENABLED)
	echo GetDebugMessage();
?>
<script>

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php include_once "footer.php" ?>
<?php
$tbl_location_delete->terminate();
?>