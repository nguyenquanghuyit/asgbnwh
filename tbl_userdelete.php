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
$tbl_user_delete = new tbl_user_delete();

// Run the page
$tbl_user_delete->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$tbl_user_delete->Page_Render();
?>
<?php include_once "header.php" ?>
<script>

// Form object
currentPageID = ew.PAGE_ID = "delete";
var ftbl_userdelete = currentForm = new ew.Form("ftbl_userdelete", "delete");

// Form_CustomValidate event
ftbl_userdelete.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

	// Your custom validation code here, return false if invalid.
	return true;
}

// Use JavaScript validation or not
ftbl_userdelete.validateRequired = <?php echo json_encode(CLIENT_VALIDATE) ?>;

// Dynamic selection lists
ftbl_userdelete.lists["x_userLevel"] = <?php echo $tbl_user_delete->userLevel->Lookup->toClientList() ?>;
ftbl_userdelete.lists["x_userLevel"].options = <?php echo JsonEncode($tbl_user_delete->userLevel->lookupOptions()) ?>;

// Form object for search
</script>
<script>

// Write your client script here, no need to add script tags.
</script>
<?php $tbl_user_delete->showPageHeader(); ?>
<?php
$tbl_user_delete->showMessage();
?>
<form name="ftbl_userdelete" id="ftbl_userdelete" class="form-inline ew-form ew-delete-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($tbl_user_delete->CheckToken) { ?>
<input type="hidden" name="<?php echo TOKEN_NAME ?>" value="<?php echo $tbl_user_delete->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="tbl_user">
<input type="hidden" name="action" id="action" value="delete">
<?php foreach ($tbl_user_delete->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode($COMPOSITE_KEY_SEPARATOR, $key) : $key; ?>
<input type="hidden" name="key_m[]" value="<?php echo HtmlEncode($keyvalue) ?>">
<?php } ?>
<div class="card ew-card ew-grid">
<div class="<?php if (IsResponsiveLayout()) { ?>table-responsive <?php } ?>card-body ew-grid-middle-panel">
<table class="table ew-table">
	<thead>
	<tr class="ew-table-header">
<?php if ($tbl_user->ma_NV->Visible) { // ma_NV ?>
		<th class="<?php echo $tbl_user->ma_NV->headerCellClass() ?>"><span id="elh_tbl_user_ma_NV" class="tbl_user_ma_NV"><?php echo $tbl_user->ma_NV->caption() ?></span></th>
<?php } ?>
<?php if ($tbl_user->user_Name->Visible) { // user_Name ?>
		<th class="<?php echo $tbl_user->user_Name->headerCellClass() ?>"><span id="elh_tbl_user_user_Name" class="tbl_user_user_Name"><?php echo $tbl_user->user_Name->caption() ?></span></th>
<?php } ?>
<?php if ($tbl_user->pass->Visible) { // pass ?>
		<th class="<?php echo $tbl_user->pass->headerCellClass() ?>"><span id="elh_tbl_user_pass" class="tbl_user_pass"><?php echo $tbl_user->pass->caption() ?></span></th>
<?php } ?>
<?php if ($tbl_user->userLevel->Visible) { // userLevel ?>
		<th class="<?php echo $tbl_user->userLevel->headerCellClass() ?>"><span id="elh_tbl_user_userLevel" class="tbl_user_userLevel"><?php echo $tbl_user->userLevel->caption() ?></span></th>
<?php } ?>
<?php if ($tbl_user->PB_ID->Visible) { // PB_ID ?>
		<th class="<?php echo $tbl_user->PB_ID->headerCellClass() ?>"><span id="elh_tbl_user_PB_ID" class="tbl_user_PB_ID"><?php echo $tbl_user->PB_ID->caption() ?></span></th>
<?php } ?>
<?php if ($tbl_user->TD_ID->Visible) { // TD_ID ?>
		<th class="<?php echo $tbl_user->TD_ID->headerCellClass() ?>"><span id="elh_tbl_user_TD_ID" class="tbl_user_TD_ID"><?php echo $tbl_user->TD_ID->caption() ?></span></th>
<?php } ?>
<?php if ($tbl_user->CD_ID->Visible) { // CD_ID ?>
		<th class="<?php echo $tbl_user->CD_ID->headerCellClass() ?>"><span id="elh_tbl_user_CD_ID" class="tbl_user_CD_ID"><?php echo $tbl_user->CD_ID->caption() ?></span></th>
<?php } ?>
	</tr>
	</thead>
	<tbody>
<?php
$tbl_user_delete->RecCnt = 0;
$i = 0;
while (!$tbl_user_delete->Recordset->EOF) {
	$tbl_user_delete->RecCnt++;
	$tbl_user_delete->RowCnt++;

	// Set row properties
	$tbl_user->resetAttributes();
	$tbl_user->RowType = ROWTYPE_VIEW; // View

	// Get the field contents
	$tbl_user_delete->loadRowValues($tbl_user_delete->Recordset);

	// Render row
	$tbl_user_delete->renderRow();
?>
	<tr<?php echo $tbl_user->rowAttributes() ?>>
<?php if ($tbl_user->ma_NV->Visible) { // ma_NV ?>
		<td<?php echo $tbl_user->ma_NV->cellAttributes() ?>>
<span id="el<?php echo $tbl_user_delete->RowCnt ?>_tbl_user_ma_NV" class="tbl_user_ma_NV">
<span<?php echo $tbl_user->ma_NV->viewAttributes() ?>>
<?php echo $tbl_user->ma_NV->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($tbl_user->user_Name->Visible) { // user_Name ?>
		<td<?php echo $tbl_user->user_Name->cellAttributes() ?>>
<span id="el<?php echo $tbl_user_delete->RowCnt ?>_tbl_user_user_Name" class="tbl_user_user_Name">
<span<?php echo $tbl_user->user_Name->viewAttributes() ?>>
<?php echo $tbl_user->user_Name->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($tbl_user->pass->Visible) { // pass ?>
		<td<?php echo $tbl_user->pass->cellAttributes() ?>>
<span id="el<?php echo $tbl_user_delete->RowCnt ?>_tbl_user_pass" class="tbl_user_pass">
<span<?php echo $tbl_user->pass->viewAttributes() ?>>
<?php echo $tbl_user->pass->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($tbl_user->userLevel->Visible) { // userLevel ?>
		<td<?php echo $tbl_user->userLevel->cellAttributes() ?>>
<span id="el<?php echo $tbl_user_delete->RowCnt ?>_tbl_user_userLevel" class="tbl_user_userLevel">
<span<?php echo $tbl_user->userLevel->viewAttributes() ?>>
<?php echo $tbl_user->userLevel->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($tbl_user->PB_ID->Visible) { // PB_ID ?>
		<td<?php echo $tbl_user->PB_ID->cellAttributes() ?>>
<span id="el<?php echo $tbl_user_delete->RowCnt ?>_tbl_user_PB_ID" class="tbl_user_PB_ID">
<span<?php echo $tbl_user->PB_ID->viewAttributes() ?>>
<?php echo $tbl_user->PB_ID->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($tbl_user->TD_ID->Visible) { // TD_ID ?>
		<td<?php echo $tbl_user->TD_ID->cellAttributes() ?>>
<span id="el<?php echo $tbl_user_delete->RowCnt ?>_tbl_user_TD_ID" class="tbl_user_TD_ID">
<span<?php echo $tbl_user->TD_ID->viewAttributes() ?>>
<?php echo $tbl_user->TD_ID->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($tbl_user->CD_ID->Visible) { // CD_ID ?>
		<td<?php echo $tbl_user->CD_ID->cellAttributes() ?>>
<span id="el<?php echo $tbl_user_delete->RowCnt ?>_tbl_user_CD_ID" class="tbl_user_CD_ID">
<span<?php echo $tbl_user->CD_ID->viewAttributes() ?>>
<?php echo $tbl_user->CD_ID->getViewValue() ?></span>
</span>
</td>
<?php } ?>
	</tr>
<?php
	$tbl_user_delete->Recordset->moveNext();
}
$tbl_user_delete->Recordset->close();
?>
</tbody>
</table>
</div>
</div>
<div>
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("DeleteBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $tbl_user_delete->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
</div>
</form>
<?php
$tbl_user_delete->showPageFooter();
if (DEBUG_ENABLED)
	echo GetDebugMessage();
?>
<script>

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php include_once "footer.php" ?>
<?php
$tbl_user_delete->terminate();
?>