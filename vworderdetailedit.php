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
$vworderdetail_edit = new vworderdetail_edit();

// Run the page
$vworderdetail_edit->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$vworderdetail_edit->Page_Render();
?>
<?php include_once "header.php" ?>
<script>

// Form object
currentPageID = ew.PAGE_ID = "edit";
var fvworderdetailedit = currentForm = new ew.Form("fvworderdetailedit", "edit");

// Validate form
fvworderdetailedit.validate = function() {
	if (!this.validateRequired)
		return true; // Ignore validation
	var $ = jQuery, fobj = this.getForm(), $fobj = $(fobj);
	if ($fobj.find("#confirm").val() == "F")
		return true;
	var elm, felm, uelm, addcnt = 0;
	var $k = $fobj.find("#" + this.formKeyCountName); // Get key_count
	var rowcnt = ($k[0]) ? parseInt($k.val(), 10) : 1;
	var startcnt = (rowcnt == 0) ? 0 : 1; // Check rowcnt == 0 => Inline-Add
	var gridinsert = ["insert", "gridinsert"].includes($fobj.find("#action").val()) && $k[0];
	for (var i = startcnt; i <= rowcnt; i++) {
		var infix = ($k[0]) ? String(i) : "";
		$fobj.data("rowindex", infix);
		<?php if ($vworderdetail_edit->ID_Detail->Required) { ?>
			elm = this.getElements("x" + infix + "_ID_Detail");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $vworderdetail->ID_Detail->caption(), $vworderdetail->ID_Detail->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($vworderdetail_edit->ID_Order->Required) { ?>
			elm = this.getElements("x" + infix + "_ID_Order");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $vworderdetail->ID_Order->caption(), $vworderdetail->ID_Order->RequiredErrorMessage)) ?>");
		<?php } ?>
			elm = this.getElements("x" + infix + "_ID_Order");
			if (elm && !ew.checkInteger(elm.value))
				return this.onError(elm, "<?php echo JsEncode($vworderdetail->ID_Order->errorMessage()) ?>");
		<?php if ($vworderdetail_edit->Code->Required) { ?>
			elm = this.getElements("x" + infix + "_Code");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $vworderdetail->Code->caption(), $vworderdetail->Code->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($vworderdetail_edit->ProductName->Required) { ?>
			elm = this.getElements("x" + infix + "_ProductName");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $vworderdetail->ProductName->caption(), $vworderdetail->ProductName->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($vworderdetail_edit->PCS->Required) { ?>
			elm = this.getElements("x" + infix + "_PCS");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $vworderdetail->PCS->caption(), $vworderdetail->PCS->RequiredErrorMessage)) ?>");
		<?php } ?>
			elm = this.getElements("x" + infix + "_PCS");
			if (elm && !ew.checkInteger(elm.value))
				return this.onError(elm, "<?php echo JsEncode($vworderdetail->PCS->errorMessage()) ?>");
		<?php if ($vworderdetail_edit->StatusPickUp->Required) { ?>
			elm = this.getElements("x" + infix + "_StatusPickUp");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $vworderdetail->StatusPickUp->caption(), $vworderdetail->StatusPickUp->RequiredErrorMessage)) ?>");
		<?php } ?>
			elm = this.getElements("x" + infix + "_StatusPickUp");
			if (elm && !ew.checkInteger(elm.value))
				return this.onError(elm, "<?php echo JsEncode($vworderdetail->StatusPickUp->errorMessage()) ?>");
		<?php if ($vworderdetail_edit->CreateUser->Required) { ?>
			elm = this.getElements("x" + infix + "_CreateUser");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $vworderdetail->CreateUser->caption(), $vworderdetail->CreateUser->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($vworderdetail_edit->CreateDate->Required) { ?>
			elm = this.getElements("x" + infix + "_CreateDate");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $vworderdetail->CreateDate->caption(), $vworderdetail->CreateDate->RequiredErrorMessage)) ?>");
		<?php } ?>
			elm = this.getElements("x" + infix + "_CreateDate");
			if (elm && !ew.checkEuroDate(elm.value))
				return this.onError(elm, "<?php echo JsEncode($vworderdetail->CreateDate->errorMessage()) ?>");
		<?php if ($vworderdetail_edit->UpdateUser->Required) { ?>
			elm = this.getElements("x" + infix + "_UpdateUser");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $vworderdetail->UpdateUser->caption(), $vworderdetail->UpdateUser->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($vworderdetail_edit->UpdateDate->Required) { ?>
			elm = this.getElements("x" + infix + "_UpdateDate");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $vworderdetail->UpdateDate->caption(), $vworderdetail->UpdateDate->RequiredErrorMessage)) ?>");
		<?php } ?>
			elm = this.getElements("x" + infix + "_UpdateDate");
			if (elm && !ew.checkDateDef(elm.value))
				return this.onError(elm, "<?php echo JsEncode($vworderdetail->UpdateDate->errorMessage()) ?>");

			// Fire Form_CustomValidate event
			if (!this.Form_CustomValidate(fobj))
				return false;
	}

	// Process detail forms
	var dfs = $fobj.find("input[name='detailpage']").get();
	for (var i = 0; i < dfs.length; i++) {
		var df = dfs[i], val = df.value;
		if (val && ew.forms[val])
			if (!ew.forms[val].validate())
				return false;
	}
	return true;
}

// Form_CustomValidate event
fvworderdetailedit.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

	// Your custom validation code here, return false if invalid.
	return true;
}

// Use JavaScript validation or not
fvworderdetailedit.validateRequired = <?php echo json_encode(CLIENT_VALIDATE) ?>;

// Dynamic selection lists
// Form object for search

</script>
<script>

// Write your client script here, no need to add script tags.
</script>
<?php $vworderdetail_edit->showPageHeader(); ?>
<?php
$vworderdetail_edit->showMessage();
?>
<form name="fvworderdetailedit" id="fvworderdetailedit" class="<?php echo $vworderdetail_edit->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($vworderdetail_edit->CheckToken) { ?>
<input type="hidden" name="<?php echo TOKEN_NAME ?>" value="<?php echo $vworderdetail_edit->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="vworderdetail">
<input type="hidden" name="action" id="action" value="update">
<input type="hidden" name="modal" value="<?php echo (int)$vworderdetail_edit->IsModal ?>">
<?php if ($vworderdetail->getCurrentMasterTable() == "vwpickingbyorder") { ?>
<input type="hidden" name="<?php echo TABLE_SHOW_MASTER ?>" value="vwpickingbyorder">
<input type="hidden" name="fk_ID_Order" value="<?php echo $vworderdetail->ID_Order->getSessionValue() ?>">
<?php } ?>
<div class="ew-edit-div"><!-- page* -->
<?php if ($vworderdetail->ID_Detail->Visible) { // ID_Detail ?>
	<div id="r_ID_Detail" class="form-group row">
		<label id="elh_vworderdetail_ID_Detail" class="<?php echo $vworderdetail_edit->LeftColumnClass ?>"><?php echo $vworderdetail->ID_Detail->caption() ?><?php echo ($vworderdetail->ID_Detail->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $vworderdetail_edit->RightColumnClass ?>"><div<?php echo $vworderdetail->ID_Detail->cellAttributes() ?>>
<span id="el_vworderdetail_ID_Detail">
<span<?php echo $vworderdetail->ID_Detail->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?php echo RemoveHtml($vworderdetail->ID_Detail->EditValue) ?>"></span>
</span>
<input type="hidden" data-table="vworderdetail" data-field="x_ID_Detail" name="x_ID_Detail" id="x_ID_Detail" value="<?php echo HtmlEncode($vworderdetail->ID_Detail->CurrentValue) ?>">
<?php echo $vworderdetail->ID_Detail->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($vworderdetail->ID_Order->Visible) { // ID_Order ?>
	<div id="r_ID_Order" class="form-group row">
		<label id="elh_vworderdetail_ID_Order" for="x_ID_Order" class="<?php echo $vworderdetail_edit->LeftColumnClass ?>"><?php echo $vworderdetail->ID_Order->caption() ?><?php echo ($vworderdetail->ID_Order->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $vworderdetail_edit->RightColumnClass ?>"><div<?php echo $vworderdetail->ID_Order->cellAttributes() ?>>
<?php if ($vworderdetail->ID_Order->getSessionValue() <> "") { ?>
<span id="el_vworderdetail_ID_Order">
<span<?php echo $vworderdetail->ID_Order->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?php echo RemoveHtml($vworderdetail->ID_Order->ViewValue) ?>"></span>
</span>
<input type="hidden" id="x_ID_Order" name="x_ID_Order" value="<?php echo HtmlEncode($vworderdetail->ID_Order->CurrentValue) ?>">
<?php } else { ?>
<span id="el_vworderdetail_ID_Order">
<input type="text" data-table="vworderdetail" data-field="x_ID_Order" name="x_ID_Order" id="x_ID_Order" size="30" placeholder="<?php echo HtmlEncode($vworderdetail->ID_Order->getPlaceHolder()) ?>" value="<?php echo $vworderdetail->ID_Order->EditValue ?>"<?php echo $vworderdetail->ID_Order->editAttributes() ?>>
</span>
<?php } ?>
<?php echo $vworderdetail->ID_Order->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($vworderdetail->Code->Visible) { // Code ?>
	<div id="r_Code" class="form-group row">
		<label id="elh_vworderdetail_Code" for="x_Code" class="<?php echo $vworderdetail_edit->LeftColumnClass ?>"><?php echo $vworderdetail->Code->caption() ?><?php echo ($vworderdetail->Code->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $vworderdetail_edit->RightColumnClass ?>"><div<?php echo $vworderdetail->Code->cellAttributes() ?>>
<span id="el_vworderdetail_Code">
<input type="text" data-table="vworderdetail" data-field="x_Code" name="x_Code" id="x_Code" size="30" maxlength="50" placeholder="<?php echo HtmlEncode($vworderdetail->Code->getPlaceHolder()) ?>" value="<?php echo $vworderdetail->Code->EditValue ?>"<?php echo $vworderdetail->Code->editAttributes() ?>>
</span>
<?php echo $vworderdetail->Code->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($vworderdetail->ProductName->Visible) { // ProductName ?>
	<div id="r_ProductName" class="form-group row">
		<label id="elh_vworderdetail_ProductName" for="x_ProductName" class="<?php echo $vworderdetail_edit->LeftColumnClass ?>"><?php echo $vworderdetail->ProductName->caption() ?><?php echo ($vworderdetail->ProductName->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $vworderdetail_edit->RightColumnClass ?>"><div<?php echo $vworderdetail->ProductName->cellAttributes() ?>>
<span id="el_vworderdetail_ProductName">
<input type="text" data-table="vworderdetail" data-field="x_ProductName" name="x_ProductName" id="x_ProductName" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($vworderdetail->ProductName->getPlaceHolder()) ?>" value="<?php echo $vworderdetail->ProductName->EditValue ?>"<?php echo $vworderdetail->ProductName->editAttributes() ?>>
</span>
<?php echo $vworderdetail->ProductName->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($vworderdetail->PCS->Visible) { // PCS ?>
	<div id="r_PCS" class="form-group row">
		<label id="elh_vworderdetail_PCS" for="x_PCS" class="<?php echo $vworderdetail_edit->LeftColumnClass ?>"><?php echo $vworderdetail->PCS->caption() ?><?php echo ($vworderdetail->PCS->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $vworderdetail_edit->RightColumnClass ?>"><div<?php echo $vworderdetail->PCS->cellAttributes() ?>>
<span id="el_vworderdetail_PCS">
<input type="text" data-table="vworderdetail" data-field="x_PCS" name="x_PCS" id="x_PCS" size="30" placeholder="<?php echo HtmlEncode($vworderdetail->PCS->getPlaceHolder()) ?>" value="<?php echo $vworderdetail->PCS->EditValue ?>"<?php echo $vworderdetail->PCS->editAttributes() ?>>
</span>
<?php echo $vworderdetail->PCS->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($vworderdetail->StatusPickUp->Visible) { // StatusPickUp ?>
	<div id="r_StatusPickUp" class="form-group row">
		<label id="elh_vworderdetail_StatusPickUp" for="x_StatusPickUp" class="<?php echo $vworderdetail_edit->LeftColumnClass ?>"><?php echo $vworderdetail->StatusPickUp->caption() ?><?php echo ($vworderdetail->StatusPickUp->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $vworderdetail_edit->RightColumnClass ?>"><div<?php echo $vworderdetail->StatusPickUp->cellAttributes() ?>>
<span id="el_vworderdetail_StatusPickUp">
<input type="text" data-table="vworderdetail" data-field="x_StatusPickUp" name="x_StatusPickUp" id="x_StatusPickUp" size="15" placeholder="<?php echo HtmlEncode($vworderdetail->StatusPickUp->getPlaceHolder()) ?>" value="<?php echo $vworderdetail->StatusPickUp->EditValue ?>"<?php echo $vworderdetail->StatusPickUp->editAttributes() ?>>
</span>
<?php echo $vworderdetail->StatusPickUp->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($vworderdetail->CreateUser->Visible) { // CreateUser ?>
	<div id="r_CreateUser" class="form-group row">
		<label id="elh_vworderdetail_CreateUser" for="x_CreateUser" class="<?php echo $vworderdetail_edit->LeftColumnClass ?>"><?php echo $vworderdetail->CreateUser->caption() ?><?php echo ($vworderdetail->CreateUser->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $vworderdetail_edit->RightColumnClass ?>"><div<?php echo $vworderdetail->CreateUser->cellAttributes() ?>>
<span id="el_vworderdetail_CreateUser">
<input type="text" data-table="vworderdetail" data-field="x_CreateUser" name="x_CreateUser" id="x_CreateUser" size="30" maxlength="50" placeholder="<?php echo HtmlEncode($vworderdetail->CreateUser->getPlaceHolder()) ?>" value="<?php echo $vworderdetail->CreateUser->EditValue ?>"<?php echo $vworderdetail->CreateUser->editAttributes() ?>>
</span>
<?php echo $vworderdetail->CreateUser->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($vworderdetail->CreateDate->Visible) { // CreateDate ?>
	<div id="r_CreateDate" class="form-group row">
		<label id="elh_vworderdetail_CreateDate" for="x_CreateDate" class="<?php echo $vworderdetail_edit->LeftColumnClass ?>"><?php echo $vworderdetail->CreateDate->caption() ?><?php echo ($vworderdetail->CreateDate->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $vworderdetail_edit->RightColumnClass ?>"><div<?php echo $vworderdetail->CreateDate->cellAttributes() ?>>
<span id="el_vworderdetail_CreateDate">
<input type="text" data-table="vworderdetail" data-field="x_CreateDate" data-format="11" name="x_CreateDate" id="x_CreateDate" placeholder="<?php echo HtmlEncode($vworderdetail->CreateDate->getPlaceHolder()) ?>" value="<?php echo $vworderdetail->CreateDate->EditValue ?>"<?php echo $vworderdetail->CreateDate->editAttributes() ?>>
<?php if (!$vworderdetail->CreateDate->ReadOnly && !$vworderdetail->CreateDate->Disabled && !isset($vworderdetail->CreateDate->EditAttrs["readonly"]) && !isset($vworderdetail->CreateDate->EditAttrs["disabled"])) { ?>
<script>
ew.createDateTimePicker("fvworderdetailedit", "x_CreateDate", {"ignoreReadonly":true,"useCurrent":false,"format":11});
</script>
<?php } ?>
</span>
<?php echo $vworderdetail->CreateDate->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($vworderdetail->UpdateUser->Visible) { // UpdateUser ?>
	<div id="r_UpdateUser" class="form-group row">
		<label id="elh_vworderdetail_UpdateUser" for="x_UpdateUser" class="<?php echo $vworderdetail_edit->LeftColumnClass ?>"><?php echo $vworderdetail->UpdateUser->caption() ?><?php echo ($vworderdetail->UpdateUser->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $vworderdetail_edit->RightColumnClass ?>"><div<?php echo $vworderdetail->UpdateUser->cellAttributes() ?>>
<span id="el_vworderdetail_UpdateUser">
<input type="text" data-table="vworderdetail" data-field="x_UpdateUser" name="x_UpdateUser" id="x_UpdateUser" size="30" maxlength="50" placeholder="<?php echo HtmlEncode($vworderdetail->UpdateUser->getPlaceHolder()) ?>" value="<?php echo $vworderdetail->UpdateUser->EditValue ?>"<?php echo $vworderdetail->UpdateUser->editAttributes() ?>>
</span>
<?php echo $vworderdetail->UpdateUser->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($vworderdetail->UpdateDate->Visible) { // UpdateDate ?>
	<div id="r_UpdateDate" class="form-group row">
		<label id="elh_vworderdetail_UpdateDate" for="x_UpdateDate" class="<?php echo $vworderdetail_edit->LeftColumnClass ?>"><?php echo $vworderdetail->UpdateDate->caption() ?><?php echo ($vworderdetail->UpdateDate->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $vworderdetail_edit->RightColumnClass ?>"><div<?php echo $vworderdetail->UpdateDate->cellAttributes() ?>>
<span id="el_vworderdetail_UpdateDate">
<input type="text" data-table="vworderdetail" data-field="x_UpdateDate" name="x_UpdateDate" id="x_UpdateDate" placeholder="<?php echo HtmlEncode($vworderdetail->UpdateDate->getPlaceHolder()) ?>" value="<?php echo $vworderdetail->UpdateDate->EditValue ?>"<?php echo $vworderdetail->UpdateDate->editAttributes() ?>>
<?php if (!$vworderdetail->UpdateDate->ReadOnly && !$vworderdetail->UpdateDate->Disabled && !isset($vworderdetail->UpdateDate->EditAttrs["readonly"]) && !isset($vworderdetail->UpdateDate->EditAttrs["disabled"])) { ?>
<script>
ew.createDateTimePicker("fvworderdetailedit", "x_UpdateDate", {"ignoreReadonly":true,"useCurrent":false,"format":0});
</script>
<?php } ?>
</span>
<?php echo $vworderdetail->UpdateDate->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$vworderdetail_edit->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $vworderdetail_edit->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("SaveBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $vworderdetail_edit->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$vworderdetail_edit->showPageFooter();
if (DEBUG_ENABLED)
	echo GetDebugMessage();
?>
<script>

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php include_once "footer.php" ?>
<?php
$vworderdetail_edit->terminate();
?>