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
$vwrouteout_add = new vwrouteout_add();

// Run the page
$vwrouteout_add->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$vwrouteout_add->Page_Render();
?>
<?php include_once "header.php" ?>
<script>

// Form object
currentPageID = ew.PAGE_ID = "add";
var fvwrouteoutadd = currentForm = new ew.Form("fvwrouteoutadd", "add");

// Validate form
fvwrouteoutadd.validate = function() {
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
		<?php if ($vwrouteout_add->RouteName->Required) { ?>
			elm = this.getElements("x" + infix + "_RouteName");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $vwrouteout->RouteName->caption(), $vwrouteout->RouteName->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($vwrouteout_add->TruckNo->Required) { ?>
			elm = this.getElements("x" + infix + "_TruckNo");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $vwrouteout->TruckNo->caption(), $vwrouteout->TruckNo->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($vwrouteout_add->DriverName->Required) { ?>
			elm = this.getElements("x" + infix + "_DriverName");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $vwrouteout->DriverName->caption(), $vwrouteout->DriverName->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($vwrouteout_add->DriverMobile->Required) { ?>
			elm = this.getElements("x" + infix + "_DriverMobile");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $vwrouteout->DriverMobile->caption(), $vwrouteout->DriverMobile->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($vwrouteout_add->InvoiceNo->Required) { ?>
			elm = this.getElements("x" + infix + "_InvoiceNo");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $vwrouteout->InvoiceNo->caption(), $vwrouteout->InvoiceNo->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($vwrouteout_add->InvoiceDate->Required) { ?>
			elm = this.getElements("x" + infix + "_InvoiceDate");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $vwrouteout->InvoiceDate->caption(), $vwrouteout->InvoiceDate->RequiredErrorMessage)) ?>");
		<?php } ?>
			elm = this.getElements("x" + infix + "_InvoiceDate");
			if (elm && !ew.checkEuroDate(elm.value))
				return this.onError(elm, "<?php echo JsEncode($vwrouteout->InvoiceDate->errorMessage()) ?>");
		<?php if ($vwrouteout_add->CreateUser->Required) { ?>
			elm = this.getElements("x" + infix + "_CreateUser");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $vwrouteout->CreateUser->caption(), $vwrouteout->CreateUser->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($vwrouteout_add->CreateDate->Required) { ?>
			elm = this.getElements("x" + infix + "_CreateDate");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $vwrouteout->CreateDate->caption(), $vwrouteout->CreateDate->RequiredErrorMessage)) ?>");
		<?php } ?>
			elm = this.getElements("x" + infix + "_CreateDate");
			if (elm && !ew.checkEuroDate(elm.value))
				return this.onError(elm, "<?php echo JsEncode($vwrouteout->CreateDate->errorMessage()) ?>");
		<?php if ($vwrouteout_add->InOrOut->Required) { ?>
			elm = this.getElements("x" + infix + "_InOrOut");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $vwrouteout->InOrOut->caption(), $vwrouteout->InOrOut->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($vwrouteout_add->SealNo->Required) { ?>
			elm = this.getElements("x" + infix + "_SealNo");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $vwrouteout->SealNo->caption(), $vwrouteout->SealNo->RequiredErrorMessage)) ?>");
		<?php } ?>

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
fvwrouteoutadd.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

	// Your custom validation code here, return false if invalid.
	return true;
}

// Use JavaScript validation or not
fvwrouteoutadd.validateRequired = <?php echo json_encode(CLIENT_VALIDATE) ?>;

// Dynamic selection lists
fvwrouteoutadd.lists["x_RouteName"] = <?php echo $vwrouteout_add->RouteName->Lookup->toClientList() ?>;
fvwrouteoutadd.lists["x_RouteName"].options = <?php echo JsonEncode($vwrouteout_add->RouteName->options(FALSE, TRUE)) ?>;

// Form object for search
</script>
<script>

// Write your client script here, no need to add script tags.
</script>
<?php $vwrouteout_add->showPageHeader(); ?>
<?php
$vwrouteout_add->showMessage();
?>
<form name="fvwrouteoutadd" id="fvwrouteoutadd" class="<?php echo $vwrouteout_add->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($vwrouteout_add->CheckToken) { ?>
<input type="hidden" name="<?php echo TOKEN_NAME ?>" value="<?php echo $vwrouteout_add->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="vwrouteout">
<input type="hidden" name="action" id="action" value="insert">
<input type="hidden" name="modal" value="<?php echo (int)$vwrouteout_add->IsModal ?>">
<div class="ew-add-div"><!-- page* -->
<?php if ($vwrouteout->RouteName->Visible) { // RouteName ?>
	<div id="r_RouteName" class="form-group row">
		<label id="elh_vwrouteout_RouteName" for="x_RouteName" class="<?php echo $vwrouteout_add->LeftColumnClass ?>"><?php echo $vwrouteout->RouteName->caption() ?><?php echo ($vwrouteout->RouteName->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $vwrouteout_add->RightColumnClass ?>"><div<?php echo $vwrouteout->RouteName->cellAttributes() ?>>
<span id="el_vwrouteout_RouteName">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="vwrouteout" data-field="x_RouteName" data-value-separator="<?php echo $vwrouteout->RouteName->displayValueSeparatorAttribute() ?>" id="x_RouteName" name="x_RouteName"<?php echo $vwrouteout->RouteName->editAttributes() ?>>
		<?php echo $vwrouteout->RouteName->selectOptionListHtml("x_RouteName") ?>
	</select>
</div>
</span>
<?php echo $vwrouteout->RouteName->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($vwrouteout->TruckNo->Visible) { // TruckNo ?>
	<div id="r_TruckNo" class="form-group row">
		<label id="elh_vwrouteout_TruckNo" for="x_TruckNo" class="<?php echo $vwrouteout_add->LeftColumnClass ?>"><?php echo $vwrouteout->TruckNo->caption() ?><?php echo ($vwrouteout->TruckNo->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $vwrouteout_add->RightColumnClass ?>"><div<?php echo $vwrouteout->TruckNo->cellAttributes() ?>>
<span id="el_vwrouteout_TruckNo">
<input type="text" data-table="vwrouteout" data-field="x_TruckNo" name="x_TruckNo" id="x_TruckNo" size="30" maxlength="25" placeholder="<?php echo HtmlEncode($vwrouteout->TruckNo->getPlaceHolder()) ?>" value="<?php echo $vwrouteout->TruckNo->EditValue ?>"<?php echo $vwrouteout->TruckNo->editAttributes() ?>>
</span>
<?php echo $vwrouteout->TruckNo->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($vwrouteout->DriverName->Visible) { // DriverName ?>
	<div id="r_DriverName" class="form-group row">
		<label id="elh_vwrouteout_DriverName" for="x_DriverName" class="<?php echo $vwrouteout_add->LeftColumnClass ?>"><?php echo $vwrouteout->DriverName->caption() ?><?php echo ($vwrouteout->DriverName->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $vwrouteout_add->RightColumnClass ?>"><div<?php echo $vwrouteout->DriverName->cellAttributes() ?>>
<span id="el_vwrouteout_DriverName">
<input type="text" data-table="vwrouteout" data-field="x_DriverName" name="x_DriverName" id="x_DriverName" size="30" maxlength="45" placeholder="<?php echo HtmlEncode($vwrouteout->DriverName->getPlaceHolder()) ?>" value="<?php echo $vwrouteout->DriverName->EditValue ?>"<?php echo $vwrouteout->DriverName->editAttributes() ?>>
</span>
<?php echo $vwrouteout->DriverName->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($vwrouteout->DriverMobile->Visible) { // DriverMobile ?>
	<div id="r_DriverMobile" class="form-group row">
		<label id="elh_vwrouteout_DriverMobile" for="x_DriverMobile" class="<?php echo $vwrouteout_add->LeftColumnClass ?>"><?php echo $vwrouteout->DriverMobile->caption() ?><?php echo ($vwrouteout->DriverMobile->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $vwrouteout_add->RightColumnClass ?>"><div<?php echo $vwrouteout->DriverMobile->cellAttributes() ?>>
<span id="el_vwrouteout_DriverMobile">
<input type="text" data-table="vwrouteout" data-field="x_DriverMobile" name="x_DriverMobile" id="x_DriverMobile" size="30" maxlength="20" placeholder="<?php echo HtmlEncode($vwrouteout->DriverMobile->getPlaceHolder()) ?>" value="<?php echo $vwrouteout->DriverMobile->EditValue ?>"<?php echo $vwrouteout->DriverMobile->editAttributes() ?>>
</span>
<?php echo $vwrouteout->DriverMobile->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($vwrouteout->InvoiceNo->Visible) { // InvoiceNo ?>
	<div id="r_InvoiceNo" class="form-group row">
		<label id="elh_vwrouteout_InvoiceNo" for="x_InvoiceNo" class="<?php echo $vwrouteout_add->LeftColumnClass ?>"><?php echo $vwrouteout->InvoiceNo->caption() ?><?php echo ($vwrouteout->InvoiceNo->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $vwrouteout_add->RightColumnClass ?>"><div<?php echo $vwrouteout->InvoiceNo->cellAttributes() ?>>
<span id="el_vwrouteout_InvoiceNo">
<input type="text" data-table="vwrouteout" data-field="x_InvoiceNo" name="x_InvoiceNo" id="x_InvoiceNo" size="30" maxlength="50" placeholder="<?php echo HtmlEncode($vwrouteout->InvoiceNo->getPlaceHolder()) ?>" value="<?php echo $vwrouteout->InvoiceNo->EditValue ?>"<?php echo $vwrouteout->InvoiceNo->editAttributes() ?>>
</span>
<?php echo $vwrouteout->InvoiceNo->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($vwrouteout->InvoiceDate->Visible) { // InvoiceDate ?>
	<div id="r_InvoiceDate" class="form-group row">
		<label id="elh_vwrouteout_InvoiceDate" for="x_InvoiceDate" class="<?php echo $vwrouteout_add->LeftColumnClass ?>"><?php echo $vwrouteout->InvoiceDate->caption() ?><?php echo ($vwrouteout->InvoiceDate->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $vwrouteout_add->RightColumnClass ?>"><div<?php echo $vwrouteout->InvoiceDate->cellAttributes() ?>>
<span id="el_vwrouteout_InvoiceDate">
<input type="text" data-table="vwrouteout" data-field="x_InvoiceDate" data-format="7" name="x_InvoiceDate" id="x_InvoiceDate" placeholder="<?php echo HtmlEncode($vwrouteout->InvoiceDate->getPlaceHolder()) ?>" value="<?php echo $vwrouteout->InvoiceDate->EditValue ?>"<?php echo $vwrouteout->InvoiceDate->editAttributes() ?>>
<?php if (!$vwrouteout->InvoiceDate->ReadOnly && !$vwrouteout->InvoiceDate->Disabled && !isset($vwrouteout->InvoiceDate->EditAttrs["readonly"]) && !isset($vwrouteout->InvoiceDate->EditAttrs["disabled"])) { ?>
<script>
ew.createDateTimePicker("fvwrouteoutadd", "x_InvoiceDate", {"ignoreReadonly":true,"useCurrent":false,"format":7});
</script>
<?php } ?>
</span>
<?php echo $vwrouteout->InvoiceDate->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($vwrouteout->CreateUser->Visible) { // CreateUser ?>
	<div id="r_CreateUser" class="form-group row">
		<label id="elh_vwrouteout_CreateUser" for="x_CreateUser" class="<?php echo $vwrouteout_add->LeftColumnClass ?>"><?php echo $vwrouteout->CreateUser->caption() ?><?php echo ($vwrouteout->CreateUser->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $vwrouteout_add->RightColumnClass ?>"><div<?php echo $vwrouteout->CreateUser->cellAttributes() ?>>
<span id="el_vwrouteout_CreateUser">
<input type="text" data-table="vwrouteout" data-field="x_CreateUser" name="x_CreateUser" id="x_CreateUser" size="30" maxlength="50" placeholder="<?php echo HtmlEncode($vwrouteout->CreateUser->getPlaceHolder()) ?>" value="<?php echo $vwrouteout->CreateUser->EditValue ?>"<?php echo $vwrouteout->CreateUser->editAttributes() ?>>
</span>
<?php echo $vwrouteout->CreateUser->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($vwrouteout->CreateDate->Visible) { // CreateDate ?>
	<div id="r_CreateDate" class="form-group row">
		<label id="elh_vwrouteout_CreateDate" for="x_CreateDate" class="<?php echo $vwrouteout_add->LeftColumnClass ?>"><?php echo $vwrouteout->CreateDate->caption() ?><?php echo ($vwrouteout->CreateDate->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $vwrouteout_add->RightColumnClass ?>"><div<?php echo $vwrouteout->CreateDate->cellAttributes() ?>>
<span id="el_vwrouteout_CreateDate">
<input type="text" data-table="vwrouteout" data-field="x_CreateDate" data-format="11" name="x_CreateDate" id="x_CreateDate" placeholder="<?php echo HtmlEncode($vwrouteout->CreateDate->getPlaceHolder()) ?>" value="<?php echo $vwrouteout->CreateDate->EditValue ?>"<?php echo $vwrouteout->CreateDate->editAttributes() ?>>
<?php if (!$vwrouteout->CreateDate->ReadOnly && !$vwrouteout->CreateDate->Disabled && !isset($vwrouteout->CreateDate->EditAttrs["readonly"]) && !isset($vwrouteout->CreateDate->EditAttrs["disabled"])) { ?>
<script>
ew.createDateTimePicker("fvwrouteoutadd", "x_CreateDate", {"ignoreReadonly":true,"useCurrent":false,"format":11});
</script>
<?php } ?>
</span>
<?php echo $vwrouteout->CreateDate->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($vwrouteout->InOrOut->Visible) { // InOrOut ?>
	<div id="r_InOrOut" class="form-group row">
		<label id="elh_vwrouteout_InOrOut" for="x_InOrOut" class="<?php echo $vwrouteout_add->LeftColumnClass ?>"><?php echo $vwrouteout->InOrOut->caption() ?><?php echo ($vwrouteout->InOrOut->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $vwrouteout_add->RightColumnClass ?>"><div<?php echo $vwrouteout->InOrOut->cellAttributes() ?>>
<span id="el_vwrouteout_InOrOut">
<input type="text" data-table="vwrouteout" data-field="x_InOrOut" name="x_InOrOut" id="x_InOrOut" size="30" maxlength="10" placeholder="<?php echo HtmlEncode($vwrouteout->InOrOut->getPlaceHolder()) ?>" value="<?php echo $vwrouteout->InOrOut->EditValue ?>"<?php echo $vwrouteout->InOrOut->editAttributes() ?>>
</span>
<?php echo $vwrouteout->InOrOut->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($vwrouteout->SealNo->Visible) { // SealNo ?>
	<div id="r_SealNo" class="form-group row">
		<label id="elh_vwrouteout_SealNo" for="x_SealNo" class="<?php echo $vwrouteout_add->LeftColumnClass ?>"><?php echo $vwrouteout->SealNo->caption() ?><?php echo ($vwrouteout->SealNo->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $vwrouteout_add->RightColumnClass ?>"><div<?php echo $vwrouteout->SealNo->cellAttributes() ?>>
<span id="el_vwrouteout_SealNo">
<input type="text" data-table="vwrouteout" data-field="x_SealNo" name="x_SealNo" id="x_SealNo" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($vwrouteout->SealNo->getPlaceHolder()) ?>" value="<?php echo $vwrouteout->SealNo->EditValue ?>"<?php echo $vwrouteout->SealNo->editAttributes() ?>>
</span>
<?php echo $vwrouteout->SealNo->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php
	if (in_array("tbl_loading", explode(",", $vwrouteout->getCurrentDetailTable())) && $tbl_loading->DetailAdd) {
?>
<?php if ($vwrouteout->getCurrentDetailTable() <> "") { ?>
<h4 class="ew-detail-caption"><?php echo $Language->TablePhrase("tbl_loading", "TblCaption") ?></h4>
<?php } ?>
<?php include_once "tbl_loadinggrid.php" ?>
<?php } ?>
<?php if (!$vwrouteout_add->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $vwrouteout_add->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("AddBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $vwrouteout_add->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$vwrouteout_add->showPageFooter();
if (DEBUG_ENABLED)
	echo GetDebugMessage();
?>
<script>

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php include_once "footer.php" ?>
<?php
$vwrouteout_add->terminate();
?>