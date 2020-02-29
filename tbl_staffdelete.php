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
$tbl_staff_delete = new tbl_staff_delete();

// Run the page
$tbl_staff_delete->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$tbl_staff_delete->Page_Render();
?>
<?php include_once "header.php" ?>
<script>

// Form object
currentPageID = ew.PAGE_ID = "delete";
var ftbl_staffdelete = currentForm = new ew.Form("ftbl_staffdelete", "delete");

// Form_CustomValidate event
ftbl_staffdelete.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

	// Your custom validation code here, return false if invalid.
	return true;
}

// Use JavaScript validation or not
ftbl_staffdelete.validateRequired = <?php echo json_encode(CLIENT_VALIDATE) ?>;

// Dynamic selection lists
// Form object for search

</script>
<script>

// Write your client script here, no need to add script tags.
</script>
<?php $tbl_staff_delete->showPageHeader(); ?>
<?php
$tbl_staff_delete->showMessage();
?>
<form name="ftbl_staffdelete" id="ftbl_staffdelete" class="form-inline ew-form ew-delete-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($tbl_staff_delete->CheckToken) { ?>
<input type="hidden" name="<?php echo TOKEN_NAME ?>" value="<?php echo $tbl_staff_delete->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="tbl_staff">
<input type="hidden" name="action" id="action" value="delete">
<?php foreach ($tbl_staff_delete->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode($COMPOSITE_KEY_SEPARATOR, $key) : $key; ?>
<input type="hidden" name="key_m[]" value="<?php echo HtmlEncode($keyvalue) ?>">
<?php } ?>
<div class="card ew-card ew-grid">
<div class="<?php if (IsResponsiveLayout()) { ?>table-responsive <?php } ?>card-body ew-grid-middle-panel">
<table class="table ew-table">
	<thead>
	<tr class="ew-table-header">
<?php if ($tbl_staff->Ma_NV->Visible) { // Ma_NV ?>
		<th class="<?php echo $tbl_staff->Ma_NV->headerCellClass() ?>"><span id="elh_tbl_staff_Ma_NV" class="tbl_staff_Ma_NV"><?php echo $tbl_staff->Ma_NV->caption() ?></span></th>
<?php } ?>
<?php if ($tbl_staff->hoVaTen->Visible) { // hoVaTen ?>
		<th class="<?php echo $tbl_staff->hoVaTen->headerCellClass() ?>"><span id="elh_tbl_staff_hoVaTen" class="tbl_staff_hoVaTen"><?php echo $tbl_staff->hoVaTen->caption() ?></span></th>
<?php } ?>
<?php if ($tbl_staff->gioiTinh->Visible) { // gioiTinh ?>
		<th class="<?php echo $tbl_staff->gioiTinh->headerCellClass() ?>"><span id="elh_tbl_staff_gioiTinh" class="tbl_staff_gioiTinh"><?php echo $tbl_staff->gioiTinh->caption() ?></span></th>
<?php } ?>
<?php if ($tbl_staff->ngaySinh->Visible) { // ngaySinh ?>
		<th class="<?php echo $tbl_staff->ngaySinh->headerCellClass() ?>"><span id="elh_tbl_staff_ngaySinh" class="tbl_staff_ngaySinh"><?php echo $tbl_staff->ngaySinh->caption() ?></span></th>
<?php } ?>
<?php if ($tbl_staff->emailCaNhan->Visible) { // emailCaNhan ?>
		<th class="<?php echo $tbl_staff->emailCaNhan->headerCellClass() ?>"><span id="elh_tbl_staff_emailCaNhan" class="tbl_staff_emailCaNhan"><?php echo $tbl_staff->emailCaNhan->caption() ?></span></th>
<?php } ?>
<?php if ($tbl_staff->CD_ID->Visible) { // CD_ID ?>
		<th class="<?php echo $tbl_staff->CD_ID->headerCellClass() ?>"><span id="elh_tbl_staff_CD_ID" class="tbl_staff_CD_ID"><?php echo $tbl_staff->CD_ID->caption() ?></span></th>
<?php } ?>
<?php if ($tbl_staff->TD_ID->Visible) { // TD_ID ?>
		<th class="<?php echo $tbl_staff->TD_ID->headerCellClass() ?>"><span id="elh_tbl_staff_TD_ID" class="tbl_staff_TD_ID"><?php echo $tbl_staff->TD_ID->caption() ?></span></th>
<?php } ?>
<?php if ($tbl_staff->PB_ID->Visible) { // PB_ID ?>
		<th class="<?php echo $tbl_staff->PB_ID->headerCellClass() ?>"><span id="elh_tbl_staff_PB_ID" class="tbl_staff_PB_ID"><?php echo $tbl_staff->PB_ID->caption() ?></span></th>
<?php } ?>
	</tr>
	</thead>
	<tbody>
<?php
$tbl_staff_delete->RecCnt = 0;
$i = 0;
while (!$tbl_staff_delete->Recordset->EOF) {
	$tbl_staff_delete->RecCnt++;
	$tbl_staff_delete->RowCnt++;

	// Set row properties
	$tbl_staff->resetAttributes();
	$tbl_staff->RowType = ROWTYPE_VIEW; // View

	// Get the field contents
	$tbl_staff_delete->loadRowValues($tbl_staff_delete->Recordset);

	// Render row
	$tbl_staff_delete->renderRow();
?>
	<tr<?php echo $tbl_staff->rowAttributes() ?>>
<?php if ($tbl_staff->Ma_NV->Visible) { // Ma_NV ?>
		<td<?php echo $tbl_staff->Ma_NV->cellAttributes() ?>>
<span id="el<?php echo $tbl_staff_delete->RowCnt ?>_tbl_staff_Ma_NV" class="tbl_staff_Ma_NV">
<span<?php echo $tbl_staff->Ma_NV->viewAttributes() ?>>
<?php echo $tbl_staff->Ma_NV->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($tbl_staff->hoVaTen->Visible) { // hoVaTen ?>
		<td<?php echo $tbl_staff->hoVaTen->cellAttributes() ?>>
<span id="el<?php echo $tbl_staff_delete->RowCnt ?>_tbl_staff_hoVaTen" class="tbl_staff_hoVaTen">
<span<?php echo $tbl_staff->hoVaTen->viewAttributes() ?>>
<?php echo $tbl_staff->hoVaTen->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($tbl_staff->gioiTinh->Visible) { // gioiTinh ?>
		<td<?php echo $tbl_staff->gioiTinh->cellAttributes() ?>>
<span id="el<?php echo $tbl_staff_delete->RowCnt ?>_tbl_staff_gioiTinh" class="tbl_staff_gioiTinh">
<span<?php echo $tbl_staff->gioiTinh->viewAttributes() ?>>
<?php echo $tbl_staff->gioiTinh->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($tbl_staff->ngaySinh->Visible) { // ngaySinh ?>
		<td<?php echo $tbl_staff->ngaySinh->cellAttributes() ?>>
<span id="el<?php echo $tbl_staff_delete->RowCnt ?>_tbl_staff_ngaySinh" class="tbl_staff_ngaySinh">
<span<?php echo $tbl_staff->ngaySinh->viewAttributes() ?>>
<?php echo $tbl_staff->ngaySinh->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($tbl_staff->emailCaNhan->Visible) { // emailCaNhan ?>
		<td<?php echo $tbl_staff->emailCaNhan->cellAttributes() ?>>
<span id="el<?php echo $tbl_staff_delete->RowCnt ?>_tbl_staff_emailCaNhan" class="tbl_staff_emailCaNhan">
<span<?php echo $tbl_staff->emailCaNhan->viewAttributes() ?>>
<?php echo $tbl_staff->emailCaNhan->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($tbl_staff->CD_ID->Visible) { // CD_ID ?>
		<td<?php echo $tbl_staff->CD_ID->cellAttributes() ?>>
<span id="el<?php echo $tbl_staff_delete->RowCnt ?>_tbl_staff_CD_ID" class="tbl_staff_CD_ID">
<span<?php echo $tbl_staff->CD_ID->viewAttributes() ?>>
<?php echo $tbl_staff->CD_ID->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($tbl_staff->TD_ID->Visible) { // TD_ID ?>
		<td<?php echo $tbl_staff->TD_ID->cellAttributes() ?>>
<span id="el<?php echo $tbl_staff_delete->RowCnt ?>_tbl_staff_TD_ID" class="tbl_staff_TD_ID">
<span<?php echo $tbl_staff->TD_ID->viewAttributes() ?>>
<?php echo $tbl_staff->TD_ID->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($tbl_staff->PB_ID->Visible) { // PB_ID ?>
		<td<?php echo $tbl_staff->PB_ID->cellAttributes() ?>>
<span id="el<?php echo $tbl_staff_delete->RowCnt ?>_tbl_staff_PB_ID" class="tbl_staff_PB_ID">
<span<?php echo $tbl_staff->PB_ID->viewAttributes() ?>>
<?php echo $tbl_staff->PB_ID->getViewValue() ?></span>
</span>
</td>
<?php } ?>
	</tr>
<?php
	$tbl_staff_delete->Recordset->moveNext();
}
$tbl_staff_delete->Recordset->close();
?>
</tbody>
</table>
</div>
</div>
<div>
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("DeleteBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $tbl_staff_delete->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
</div>
</form>
<?php
$tbl_staff_delete->showPageFooter();
if (DEBUG_ENABLED)
	echo GetDebugMessage();
?>
<script>

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php include_once "footer.php" ?>
<?php
$tbl_staff_delete->terminate();
?>