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
$tbl_producttype_delete = new tbl_producttype_delete();

// Run the page
$tbl_producttype_delete->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$tbl_producttype_delete->Page_Render();
?>
<?php include_once "header.php" ?>
<script>

// Form object
currentPageID = ew.PAGE_ID = "delete";
var ftbl_producttypedelete = currentForm = new ew.Form("ftbl_producttypedelete", "delete");

// Form_CustomValidate event
ftbl_producttypedelete.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

	// Your custom validation code here, return false if invalid.
	return true;
}

// Use JavaScript validation or not
ftbl_producttypedelete.validateRequired = <?php echo json_encode(CLIENT_VALIDATE) ?>;

// Dynamic selection lists
// Form object for search

</script>
<script>

// Write your client script here, no need to add script tags.
</script>
<?php $tbl_producttype_delete->showPageHeader(); ?>
<?php
$tbl_producttype_delete->showMessage();
?>
<form name="ftbl_producttypedelete" id="ftbl_producttypedelete" class="form-inline ew-form ew-delete-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($tbl_producttype_delete->CheckToken) { ?>
<input type="hidden" name="<?php echo TOKEN_NAME ?>" value="<?php echo $tbl_producttype_delete->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="tbl_producttype">
<input type="hidden" name="action" id="action" value="delete">
<?php foreach ($tbl_producttype_delete->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode($COMPOSITE_KEY_SEPARATOR, $key) : $key; ?>
<input type="hidden" name="key_m[]" value="<?php echo HtmlEncode($keyvalue) ?>">
<?php } ?>
<div class="card ew-card ew-grid">
<div class="<?php if (IsResponsiveLayout()) { ?>table-responsive <?php } ?>card-body ew-grid-middle-panel">
<table class="table ew-table">
	<thead>
	<tr class="ew-table-header">
<?php if ($tbl_producttype->IdType->Visible) { // IdType ?>
		<th class="<?php echo $tbl_producttype->IdType->headerCellClass() ?>"><span id="elh_tbl_producttype_IdType" class="tbl_producttype_IdType"><?php echo $tbl_producttype->IdType->caption() ?></span></th>
<?php } ?>
<?php if ($tbl_producttype->TypeName->Visible) { // TypeName ?>
		<th class="<?php echo $tbl_producttype->TypeName->headerCellClass() ?>"><span id="elh_tbl_producttype_TypeName" class="tbl_producttype_TypeName"><?php echo $tbl_producttype->TypeName->caption() ?></span></th>
<?php } ?>
	</tr>
	</thead>
	<tbody>
<?php
$tbl_producttype_delete->RecCnt = 0;
$i = 0;
while (!$tbl_producttype_delete->Recordset->EOF) {
	$tbl_producttype_delete->RecCnt++;
	$tbl_producttype_delete->RowCnt++;

	// Set row properties
	$tbl_producttype->resetAttributes();
	$tbl_producttype->RowType = ROWTYPE_VIEW; // View

	// Get the field contents
	$tbl_producttype_delete->loadRowValues($tbl_producttype_delete->Recordset);

	// Render row
	$tbl_producttype_delete->renderRow();
?>
	<tr<?php echo $tbl_producttype->rowAttributes() ?>>
<?php if ($tbl_producttype->IdType->Visible) { // IdType ?>
		<td<?php echo $tbl_producttype->IdType->cellAttributes() ?>>
<span id="el<?php echo $tbl_producttype_delete->RowCnt ?>_tbl_producttype_IdType" class="tbl_producttype_IdType">
<span<?php echo $tbl_producttype->IdType->viewAttributes() ?>>
<?php echo $tbl_producttype->IdType->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($tbl_producttype->TypeName->Visible) { // TypeName ?>
		<td<?php echo $tbl_producttype->TypeName->cellAttributes() ?>>
<span id="el<?php echo $tbl_producttype_delete->RowCnt ?>_tbl_producttype_TypeName" class="tbl_producttype_TypeName">
<span<?php echo $tbl_producttype->TypeName->viewAttributes() ?>>
<?php echo $tbl_producttype->TypeName->getViewValue() ?></span>
</span>
</td>
<?php } ?>
	</tr>
<?php
	$tbl_producttype_delete->Recordset->moveNext();
}
$tbl_producttype_delete->Recordset->close();
?>
</tbody>
</table>
</div>
</div>
<div>
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("DeleteBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $tbl_producttype_delete->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
</div>
</form>
<?php
$tbl_producttype_delete->showPageFooter();
if (DEBUG_ENABLED)
	echo GetDebugMessage();
?>
<script>

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php include_once "footer.php" ?>
<?php
$tbl_producttype_delete->terminate();
?>