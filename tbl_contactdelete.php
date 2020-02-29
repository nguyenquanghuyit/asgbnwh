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
$tbl_contact_delete = new tbl_contact_delete();

// Run the page
$tbl_contact_delete->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$tbl_contact_delete->Page_Render();
?>
<?php include_once "header.php" ?>
<script>

// Form object
currentPageID = ew.PAGE_ID = "delete";
var ftbl_contactdelete = currentForm = new ew.Form("ftbl_contactdelete", "delete");

// Form_CustomValidate event
ftbl_contactdelete.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

	// Your custom validation code here, return false if invalid.
	return true;
}

// Use JavaScript validation or not
ftbl_contactdelete.validateRequired = <?php echo json_encode(CLIENT_VALIDATE) ?>;

// Dynamic selection lists
ftbl_contactdelete.lists["x_ContactType"] = <?php echo $tbl_contact_delete->ContactType->Lookup->toClientList() ?>;
ftbl_contactdelete.lists["x_ContactType"].options = <?php echo JsonEncode($tbl_contact_delete->ContactType->options(FALSE, TRUE)) ?>;

// Form object for search
</script>
<script>

// Write your client script here, no need to add script tags.
</script>
<?php $tbl_contact_delete->showPageHeader(); ?>
<?php
$tbl_contact_delete->showMessage();
?>
<form name="ftbl_contactdelete" id="ftbl_contactdelete" class="form-inline ew-form ew-delete-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($tbl_contact_delete->CheckToken) { ?>
<input type="hidden" name="<?php echo TOKEN_NAME ?>" value="<?php echo $tbl_contact_delete->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="tbl_contact">
<input type="hidden" name="action" id="action" value="delete">
<?php foreach ($tbl_contact_delete->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode($COMPOSITE_KEY_SEPARATOR, $key) : $key; ?>
<input type="hidden" name="key_m[]" value="<?php echo HtmlEncode($keyvalue) ?>">
<?php } ?>
<div class="card ew-card ew-grid">
<div class="<?php if (IsResponsiveLayout()) { ?>table-responsive <?php } ?>card-body ew-grid-middle-panel">
<table class="table ew-table">
	<thead>
	<tr class="ew-table-header">
<?php if ($tbl_contact->CodeContact->Visible) { // CodeContact ?>
		<th class="<?php echo $tbl_contact->CodeContact->headerCellClass() ?>"><span id="elh_tbl_contact_CodeContact" class="tbl_contact_CodeContact"><?php echo $tbl_contact->CodeContact->caption() ?></span></th>
<?php } ?>
<?php if ($tbl_contact->ContactType->Visible) { // ContactType ?>
		<th class="<?php echo $tbl_contact->ContactType->headerCellClass() ?>"><span id="elh_tbl_contact_ContactType" class="tbl_contact_ContactType"><?php echo $tbl_contact->ContactType->caption() ?></span></th>
<?php } ?>
<?php if ($tbl_contact->ContactName->Visible) { // ContactName ?>
		<th class="<?php echo $tbl_contact->ContactName->headerCellClass() ?>"><span id="elh_tbl_contact_ContactName" class="tbl_contact_ContactName"><?php echo $tbl_contact->ContactName->caption() ?></span></th>
<?php } ?>
<?php if ($tbl_contact->CompanyName->Visible) { // CompanyName ?>
		<th class="<?php echo $tbl_contact->CompanyName->headerCellClass() ?>"><span id="elh_tbl_contact_CompanyName" class="tbl_contact_CompanyName"><?php echo $tbl_contact->CompanyName->caption() ?></span></th>
<?php } ?>
<?php if ($tbl_contact->Address->Visible) { // Address ?>
		<th class="<?php echo $tbl_contact->Address->headerCellClass() ?>"><span id="elh_tbl_contact_Address" class="tbl_contact_Address"><?php echo $tbl_contact->Address->caption() ?></span></th>
<?php } ?>
<?php if ($tbl_contact->ContactPhone->Visible) { // ContactPhone ?>
		<th class="<?php echo $tbl_contact->ContactPhone->headerCellClass() ?>"><span id="elh_tbl_contact_ContactPhone" class="tbl_contact_ContactPhone"><?php echo $tbl_contact->ContactPhone->caption() ?></span></th>
<?php } ?>
<?php if ($tbl_contact->ContactEmail->Visible) { // ContactEmail ?>
		<th class="<?php echo $tbl_contact->ContactEmail->headerCellClass() ?>"><span id="elh_tbl_contact_ContactEmail" class="tbl_contact_ContactEmail"><?php echo $tbl_contact->ContactEmail->caption() ?></span></th>
<?php } ?>
<?php if ($tbl_contact->ReceiveName->Visible) { // ReceiveName ?>
		<th class="<?php echo $tbl_contact->ReceiveName->headerCellClass() ?>"><span id="elh_tbl_contact_ReceiveName" class="tbl_contact_ReceiveName"><?php echo $tbl_contact->ReceiveName->caption() ?></span></th>
<?php } ?>
<?php if ($tbl_contact->ReceiveTime->Visible) { // ReceiveTime ?>
		<th class="<?php echo $tbl_contact->ReceiveTime->headerCellClass() ?>"><span id="elh_tbl_contact_ReceiveTime" class="tbl_contact_ReceiveTime"><?php echo $tbl_contact->ReceiveTime->caption() ?></span></th>
<?php } ?>
<?php if ($tbl_contact->Note->Visible) { // Note ?>
		<th class="<?php echo $tbl_contact->Note->headerCellClass() ?>"><span id="elh_tbl_contact_Note" class="tbl_contact_Note"><?php echo $tbl_contact->Note->caption() ?></span></th>
<?php } ?>
<?php if ($tbl_contact->CreateUser->Visible) { // CreateUser ?>
		<th class="<?php echo $tbl_contact->CreateUser->headerCellClass() ?>"><span id="elh_tbl_contact_CreateUser" class="tbl_contact_CreateUser"><?php echo $tbl_contact->CreateUser->caption() ?></span></th>
<?php } ?>
<?php if ($tbl_contact->CreateDate->Visible) { // CreateDate ?>
		<th class="<?php echo $tbl_contact->CreateDate->headerCellClass() ?>"><span id="elh_tbl_contact_CreateDate" class="tbl_contact_CreateDate"><?php echo $tbl_contact->CreateDate->caption() ?></span></th>
<?php } ?>
	</tr>
	</thead>
	<tbody>
<?php
$tbl_contact_delete->RecCnt = 0;
$i = 0;
while (!$tbl_contact_delete->Recordset->EOF) {
	$tbl_contact_delete->RecCnt++;
	$tbl_contact_delete->RowCnt++;

	// Set row properties
	$tbl_contact->resetAttributes();
	$tbl_contact->RowType = ROWTYPE_VIEW; // View

	// Get the field contents
	$tbl_contact_delete->loadRowValues($tbl_contact_delete->Recordset);

	// Render row
	$tbl_contact_delete->renderRow();
?>
	<tr<?php echo $tbl_contact->rowAttributes() ?>>
<?php if ($tbl_contact->CodeContact->Visible) { // CodeContact ?>
		<td<?php echo $tbl_contact->CodeContact->cellAttributes() ?>>
<span id="el<?php echo $tbl_contact_delete->RowCnt ?>_tbl_contact_CodeContact" class="tbl_contact_CodeContact">
<span<?php echo $tbl_contact->CodeContact->viewAttributes() ?>>
<?php echo $tbl_contact->CodeContact->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($tbl_contact->ContactType->Visible) { // ContactType ?>
		<td<?php echo $tbl_contact->ContactType->cellAttributes() ?>>
<span id="el<?php echo $tbl_contact_delete->RowCnt ?>_tbl_contact_ContactType" class="tbl_contact_ContactType">
<span<?php echo $tbl_contact->ContactType->viewAttributes() ?>>
<?php echo $tbl_contact->ContactType->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($tbl_contact->ContactName->Visible) { // ContactName ?>
		<td<?php echo $tbl_contact->ContactName->cellAttributes() ?>>
<span id="el<?php echo $tbl_contact_delete->RowCnt ?>_tbl_contact_ContactName" class="tbl_contact_ContactName">
<span<?php echo $tbl_contact->ContactName->viewAttributes() ?>>
<?php echo $tbl_contact->ContactName->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($tbl_contact->CompanyName->Visible) { // CompanyName ?>
		<td<?php echo $tbl_contact->CompanyName->cellAttributes() ?>>
<span id="el<?php echo $tbl_contact_delete->RowCnt ?>_tbl_contact_CompanyName" class="tbl_contact_CompanyName">
<span<?php echo $tbl_contact->CompanyName->viewAttributes() ?>>
<?php echo $tbl_contact->CompanyName->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($tbl_contact->Address->Visible) { // Address ?>
		<td<?php echo $tbl_contact->Address->cellAttributes() ?>>
<span id="el<?php echo $tbl_contact_delete->RowCnt ?>_tbl_contact_Address" class="tbl_contact_Address">
<span<?php echo $tbl_contact->Address->viewAttributes() ?>>
<?php echo $tbl_contact->Address->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($tbl_contact->ContactPhone->Visible) { // ContactPhone ?>
		<td<?php echo $tbl_contact->ContactPhone->cellAttributes() ?>>
<span id="el<?php echo $tbl_contact_delete->RowCnt ?>_tbl_contact_ContactPhone" class="tbl_contact_ContactPhone">
<span<?php echo $tbl_contact->ContactPhone->viewAttributes() ?>>
<?php echo $tbl_contact->ContactPhone->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($tbl_contact->ContactEmail->Visible) { // ContactEmail ?>
		<td<?php echo $tbl_contact->ContactEmail->cellAttributes() ?>>
<span id="el<?php echo $tbl_contact_delete->RowCnt ?>_tbl_contact_ContactEmail" class="tbl_contact_ContactEmail">
<span<?php echo $tbl_contact->ContactEmail->viewAttributes() ?>>
<?php echo $tbl_contact->ContactEmail->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($tbl_contact->ReceiveName->Visible) { // ReceiveName ?>
		<td<?php echo $tbl_contact->ReceiveName->cellAttributes() ?>>
<span id="el<?php echo $tbl_contact_delete->RowCnt ?>_tbl_contact_ReceiveName" class="tbl_contact_ReceiveName">
<span<?php echo $tbl_contact->ReceiveName->viewAttributes() ?>>
<?php echo $tbl_contact->ReceiveName->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($tbl_contact->ReceiveTime->Visible) { // ReceiveTime ?>
		<td<?php echo $tbl_contact->ReceiveTime->cellAttributes() ?>>
<span id="el<?php echo $tbl_contact_delete->RowCnt ?>_tbl_contact_ReceiveTime" class="tbl_contact_ReceiveTime">
<span<?php echo $tbl_contact->ReceiveTime->viewAttributes() ?>>
<?php echo $tbl_contact->ReceiveTime->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($tbl_contact->Note->Visible) { // Note ?>
		<td<?php echo $tbl_contact->Note->cellAttributes() ?>>
<span id="el<?php echo $tbl_contact_delete->RowCnt ?>_tbl_contact_Note" class="tbl_contact_Note">
<span<?php echo $tbl_contact->Note->viewAttributes() ?>>
<?php echo $tbl_contact->Note->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($tbl_contact->CreateUser->Visible) { // CreateUser ?>
		<td<?php echo $tbl_contact->CreateUser->cellAttributes() ?>>
<span id="el<?php echo $tbl_contact_delete->RowCnt ?>_tbl_contact_CreateUser" class="tbl_contact_CreateUser">
<span<?php echo $tbl_contact->CreateUser->viewAttributes() ?>>
<?php echo $tbl_contact->CreateUser->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($tbl_contact->CreateDate->Visible) { // CreateDate ?>
		<td<?php echo $tbl_contact->CreateDate->cellAttributes() ?>>
<span id="el<?php echo $tbl_contact_delete->RowCnt ?>_tbl_contact_CreateDate" class="tbl_contact_CreateDate">
<span<?php echo $tbl_contact->CreateDate->viewAttributes() ?>>
<?php echo $tbl_contact->CreateDate->getViewValue() ?></span>
</span>
</td>
<?php } ?>
	</tr>
<?php
	$tbl_contact_delete->Recordset->moveNext();
}
$tbl_contact_delete->Recordset->close();
?>
</tbody>
</table>
</div>
</div>
<div>
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("DeleteBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $tbl_contact_delete->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
</div>
</form>
<?php
$tbl_contact_delete->showPageFooter();
if (DEBUG_ENABLED)
	echo GetDebugMessage();
?>
<script>

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php include_once "footer.php" ?>
<?php
$tbl_contact_delete->terminate();
?>