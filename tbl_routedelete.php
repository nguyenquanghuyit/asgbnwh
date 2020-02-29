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
$tbl_route_delete = new tbl_route_delete();

// Run the page
$tbl_route_delete->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$tbl_route_delete->Page_Render();
?>
<?php include_once "header.php" ?>
<script>

// Form object
currentPageID = ew.PAGE_ID = "delete";
var ftbl_routedelete = currentForm = new ew.Form("ftbl_routedelete", "delete");

// Form_CustomValidate event
ftbl_routedelete.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

	// Your custom validation code here, return false if invalid.
	return true;
}

// Use JavaScript validation or not
ftbl_routedelete.validateRequired = <?php echo json_encode(CLIENT_VALIDATE) ?>;

// Dynamic selection lists
ftbl_routedelete.lists["x_RouteName"] = <?php echo $tbl_route_delete->RouteName->Lookup->toClientList() ?>;
ftbl_routedelete.lists["x_RouteName"].options = <?php echo JsonEncode($tbl_route_delete->RouteName->options(FALSE, TRUE)) ?>;
ftbl_routedelete.lists["x_FinishUnload"] = <?php echo $tbl_route_delete->FinishUnload->Lookup->toClientList() ?>;
ftbl_routedelete.lists["x_FinishUnload"].options = <?php echo JsonEncode($tbl_route_delete->FinishUnload->options(FALSE, TRUE)) ?>;

// Form object for search
</script>
<script>

// Write your client script here, no need to add script tags.
</script>
<?php $tbl_route_delete->showPageHeader(); ?>
<?php
$tbl_route_delete->showMessage();
?>
<form name="ftbl_routedelete" id="ftbl_routedelete" class="form-inline ew-form ew-delete-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($tbl_route_delete->CheckToken) { ?>
<input type="hidden" name="<?php echo TOKEN_NAME ?>" value="<?php echo $tbl_route_delete->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="tbl_route">
<input type="hidden" name="action" id="action" value="delete">
<?php foreach ($tbl_route_delete->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode($COMPOSITE_KEY_SEPARATOR, $key) : $key; ?>
<input type="hidden" name="key_m[]" value="<?php echo HtmlEncode($keyvalue) ?>">
<?php } ?>
<div class="card ew-card ew-grid">
<div class="<?php if (IsResponsiveLayout()) { ?>table-responsive <?php } ?>card-body ew-grid-middle-panel">
<table class="table ew-table">
	<thead>
	<tr class="ew-table-header">
<?php if ($tbl_route->RouteName->Visible) { // RouteName ?>
		<th class="<?php echo $tbl_route->RouteName->headerCellClass() ?>"><span id="elh_tbl_route_RouteName" class="tbl_route_RouteName"><?php echo $tbl_route->RouteName->caption() ?></span></th>
<?php } ?>
<?php if ($tbl_route->TruckNo->Visible) { // TruckNo ?>
		<th class="<?php echo $tbl_route->TruckNo->headerCellClass() ?>"><span id="elh_tbl_route_TruckNo" class="tbl_route_TruckNo"><?php echo $tbl_route->TruckNo->caption() ?></span></th>
<?php } ?>
<?php if ($tbl_route->DriverName->Visible) { // DriverName ?>
		<th class="<?php echo $tbl_route->DriverName->headerCellClass() ?>"><span id="elh_tbl_route_DriverName" class="tbl_route_DriverName"><?php echo $tbl_route->DriverName->caption() ?></span></th>
<?php } ?>
<?php if ($tbl_route->DriverMobile->Visible) { // DriverMobile ?>
		<th class="<?php echo $tbl_route->DriverMobile->headerCellClass() ?>"><span id="elh_tbl_route_DriverMobile" class="tbl_route_DriverMobile"><?php echo $tbl_route->DriverMobile->caption() ?></span></th>
<?php } ?>
<?php if ($tbl_route->InvoiceNo->Visible) { // InvoiceNo ?>
		<th class="<?php echo $tbl_route->InvoiceNo->headerCellClass() ?>"><span id="elh_tbl_route_InvoiceNo" class="tbl_route_InvoiceNo"><?php echo $tbl_route->InvoiceNo->caption() ?></span></th>
<?php } ?>
<?php if ($tbl_route->InvoiceDate->Visible) { // InvoiceDate ?>
		<th class="<?php echo $tbl_route->InvoiceDate->headerCellClass() ?>"><span id="elh_tbl_route_InvoiceDate" class="tbl_route_InvoiceDate"><?php echo $tbl_route->InvoiceDate->caption() ?></span></th>
<?php } ?>
<?php if ($tbl_route->CreateUser->Visible) { // CreateUser ?>
		<th class="<?php echo $tbl_route->CreateUser->headerCellClass() ?>"><span id="elh_tbl_route_CreateUser" class="tbl_route_CreateUser"><?php echo $tbl_route->CreateUser->caption() ?></span></th>
<?php } ?>
<?php if ($tbl_route->CreateDate->Visible) { // CreateDate ?>
		<th class="<?php echo $tbl_route->CreateDate->headerCellClass() ?>"><span id="elh_tbl_route_CreateDate" class="tbl_route_CreateDate"><?php echo $tbl_route->CreateDate->caption() ?></span></th>
<?php } ?>
<?php if ($tbl_route->FinishUnload->Visible) { // FinishUnload ?>
		<th class="<?php echo $tbl_route->FinishUnload->headerCellClass() ?>"><span id="elh_tbl_route_FinishUnload" class="tbl_route_FinishUnload"><?php echo $tbl_route->FinishUnload->caption() ?></span></th>
<?php } ?>
<?php if ($tbl_route->SealNo->Visible) { // SealNo ?>
		<th class="<?php echo $tbl_route->SealNo->headerCellClass() ?>"><span id="elh_tbl_route_SealNo" class="tbl_route_SealNo"><?php echo $tbl_route->SealNo->caption() ?></span></th>
<?php } ?>
<?php if ($tbl_route->AttachFile->Visible) { // AttachFile ?>
		<th class="<?php echo $tbl_route->AttachFile->headerCellClass() ?>"><span id="elh_tbl_route_AttachFile" class="tbl_route_AttachFile"><?php echo $tbl_route->AttachFile->caption() ?></span></th>
<?php } ?>
<?php if ($tbl_route->LoadingID->Visible) { // LoadingID ?>
		<th class="<?php echo $tbl_route->LoadingID->headerCellClass() ?>"><span id="elh_tbl_route_LoadingID" class="tbl_route_LoadingID"><?php echo $tbl_route->LoadingID->caption() ?></span></th>
<?php } ?>
<?php if ($tbl_route->Id_Type->Visible) { // Id_Type ?>
		<th class="<?php echo $tbl_route->Id_Type->headerCellClass() ?>"><span id="elh_tbl_route_Id_Type" class="tbl_route_Id_Type"><?php echo $tbl_route->Id_Type->caption() ?></span></th>
<?php } ?>
	</tr>
	</thead>
	<tbody>
<?php
$tbl_route_delete->RecCnt = 0;
$i = 0;
while (!$tbl_route_delete->Recordset->EOF) {
	$tbl_route_delete->RecCnt++;
	$tbl_route_delete->RowCnt++;

	// Set row properties
	$tbl_route->resetAttributes();
	$tbl_route->RowType = ROWTYPE_VIEW; // View

	// Get the field contents
	$tbl_route_delete->loadRowValues($tbl_route_delete->Recordset);

	// Render row
	$tbl_route_delete->renderRow();
?>
	<tr<?php echo $tbl_route->rowAttributes() ?>>
<?php if ($tbl_route->RouteName->Visible) { // RouteName ?>
		<td<?php echo $tbl_route->RouteName->cellAttributes() ?>>
<span id="el<?php echo $tbl_route_delete->RowCnt ?>_tbl_route_RouteName" class="tbl_route_RouteName">
<span<?php echo $tbl_route->RouteName->viewAttributes() ?>>
<?php echo $tbl_route->RouteName->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($tbl_route->TruckNo->Visible) { // TruckNo ?>
		<td<?php echo $tbl_route->TruckNo->cellAttributes() ?>>
<span id="el<?php echo $tbl_route_delete->RowCnt ?>_tbl_route_TruckNo" class="tbl_route_TruckNo">
<span<?php echo $tbl_route->TruckNo->viewAttributes() ?>>
<?php echo $tbl_route->TruckNo->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($tbl_route->DriverName->Visible) { // DriverName ?>
		<td<?php echo $tbl_route->DriverName->cellAttributes() ?>>
<span id="el<?php echo $tbl_route_delete->RowCnt ?>_tbl_route_DriverName" class="tbl_route_DriverName">
<span<?php echo $tbl_route->DriverName->viewAttributes() ?>>
<?php echo $tbl_route->DriverName->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($tbl_route->DriverMobile->Visible) { // DriverMobile ?>
		<td<?php echo $tbl_route->DriverMobile->cellAttributes() ?>>
<span id="el<?php echo $tbl_route_delete->RowCnt ?>_tbl_route_DriverMobile" class="tbl_route_DriverMobile">
<span<?php echo $tbl_route->DriverMobile->viewAttributes() ?>>
<?php echo $tbl_route->DriverMobile->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($tbl_route->InvoiceNo->Visible) { // InvoiceNo ?>
		<td<?php echo $tbl_route->InvoiceNo->cellAttributes() ?>>
<span id="el<?php echo $tbl_route_delete->RowCnt ?>_tbl_route_InvoiceNo" class="tbl_route_InvoiceNo">
<span<?php echo $tbl_route->InvoiceNo->viewAttributes() ?>>
<?php echo $tbl_route->InvoiceNo->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($tbl_route->InvoiceDate->Visible) { // InvoiceDate ?>
		<td<?php echo $tbl_route->InvoiceDate->cellAttributes() ?>>
<span id="el<?php echo $tbl_route_delete->RowCnt ?>_tbl_route_InvoiceDate" class="tbl_route_InvoiceDate">
<span<?php echo $tbl_route->InvoiceDate->viewAttributes() ?>>
<?php echo $tbl_route->InvoiceDate->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($tbl_route->CreateUser->Visible) { // CreateUser ?>
		<td<?php echo $tbl_route->CreateUser->cellAttributes() ?>>
<span id="el<?php echo $tbl_route_delete->RowCnt ?>_tbl_route_CreateUser" class="tbl_route_CreateUser">
<span<?php echo $tbl_route->CreateUser->viewAttributes() ?>>
<?php echo $tbl_route->CreateUser->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($tbl_route->CreateDate->Visible) { // CreateDate ?>
		<td<?php echo $tbl_route->CreateDate->cellAttributes() ?>>
<span id="el<?php echo $tbl_route_delete->RowCnt ?>_tbl_route_CreateDate" class="tbl_route_CreateDate">
<span<?php echo $tbl_route->CreateDate->viewAttributes() ?>>
<?php echo $tbl_route->CreateDate->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($tbl_route->FinishUnload->Visible) { // FinishUnload ?>
		<td<?php echo $tbl_route->FinishUnload->cellAttributes() ?>>
<span id="el<?php echo $tbl_route_delete->RowCnt ?>_tbl_route_FinishUnload" class="tbl_route_FinishUnload">
<span<?php echo $tbl_route->FinishUnload->viewAttributes() ?>>
<?php echo $tbl_route->FinishUnload->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($tbl_route->SealNo->Visible) { // SealNo ?>
		<td<?php echo $tbl_route->SealNo->cellAttributes() ?>>
<span id="el<?php echo $tbl_route_delete->RowCnt ?>_tbl_route_SealNo" class="tbl_route_SealNo">
<span<?php echo $tbl_route->SealNo->viewAttributes() ?>>
<?php echo $tbl_route->SealNo->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($tbl_route->AttachFile->Visible) { // AttachFile ?>
		<td<?php echo $tbl_route->AttachFile->cellAttributes() ?>>
<span id="el<?php echo $tbl_route_delete->RowCnt ?>_tbl_route_AttachFile" class="tbl_route_AttachFile">
<span<?php echo $tbl_route->AttachFile->viewAttributes() ?>>
<?php echo GetFileViewTag($tbl_route->AttachFile, $tbl_route->AttachFile->getViewValue()) ?>
</span>
</span>
</td>
<?php } ?>
<?php if ($tbl_route->LoadingID->Visible) { // LoadingID ?>
		<td<?php echo $tbl_route->LoadingID->cellAttributes() ?>>
<span id="el<?php echo $tbl_route_delete->RowCnt ?>_tbl_route_LoadingID" class="tbl_route_LoadingID">
<span<?php echo $tbl_route->LoadingID->viewAttributes() ?>>
<?php echo $tbl_route->LoadingID->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($tbl_route->Id_Type->Visible) { // Id_Type ?>
		<td<?php echo $tbl_route->Id_Type->cellAttributes() ?>>
<span id="el<?php echo $tbl_route_delete->RowCnt ?>_tbl_route_Id_Type" class="tbl_route_Id_Type">
<span<?php echo $tbl_route->Id_Type->viewAttributes() ?>>
<?php echo $tbl_route->Id_Type->getViewValue() ?></span>
</span>
</td>
<?php } ?>
	</tr>
<?php
	$tbl_route_delete->Recordset->moveNext();
}
$tbl_route_delete->Recordset->close();
?>
</tbody>
</table>
</div>
</div>
<div>
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("DeleteBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $tbl_route_delete->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
</div>
</form>
<?php
$tbl_route_delete->showPageFooter();
if (DEBUG_ENABLED)
	echo GetDebugMessage();
?>
<script>

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php include_once "footer.php" ?>
<?php
$tbl_route_delete->terminate();
?>