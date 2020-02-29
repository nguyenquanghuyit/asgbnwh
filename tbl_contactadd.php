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
$tbl_contact_add = new tbl_contact_add();

// Run the page
$tbl_contact_add->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$tbl_contact_add->Page_Render();
?>
<?php include_once "header.php" ?>
<script>

// Form object
currentPageID = ew.PAGE_ID = "add";
var ftbl_contactadd = currentForm = new ew.Form("ftbl_contactadd", "add");

// Validate form
ftbl_contactadd.validate = function() {
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
		<?php if ($tbl_contact_add->CodeContact->Required) { ?>
			elm = this.getElements("x" + infix + "_CodeContact");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $tbl_contact->CodeContact->caption(), $tbl_contact->CodeContact->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($tbl_contact_add->ContactType->Required) { ?>
			elm = this.getElements("x" + infix + "_ContactType");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $tbl_contact->ContactType->caption(), $tbl_contact->ContactType->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($tbl_contact_add->ContactName->Required) { ?>
			elm = this.getElements("x" + infix + "_ContactName");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $tbl_contact->ContactName->caption(), $tbl_contact->ContactName->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($tbl_contact_add->CompanyName->Required) { ?>
			elm = this.getElements("x" + infix + "_CompanyName");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $tbl_contact->CompanyName->caption(), $tbl_contact->CompanyName->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($tbl_contact_add->Address->Required) { ?>
			elm = this.getElements("x" + infix + "_Address");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $tbl_contact->Address->caption(), $tbl_contact->Address->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($tbl_contact_add->ContactPhone->Required) { ?>
			elm = this.getElements("x" + infix + "_ContactPhone");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $tbl_contact->ContactPhone->caption(), $tbl_contact->ContactPhone->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($tbl_contact_add->ContactEmail->Required) { ?>
			elm = this.getElements("x" + infix + "_ContactEmail");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $tbl_contact->ContactEmail->caption(), $tbl_contact->ContactEmail->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($tbl_contact_add->ReceiveName->Required) { ?>
			elm = this.getElements("x" + infix + "_ReceiveName");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $tbl_contact->ReceiveName->caption(), $tbl_contact->ReceiveName->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($tbl_contact_add->ReceiveTime->Required) { ?>
			elm = this.getElements("x" + infix + "_ReceiveTime");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $tbl_contact->ReceiveTime->caption(), $tbl_contact->ReceiveTime->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($tbl_contact_add->Note->Required) { ?>
			elm = this.getElements("x" + infix + "_Note");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $tbl_contact->Note->caption(), $tbl_contact->Note->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($tbl_contact_add->CreateUser->Required) { ?>
			elm = this.getElements("x" + infix + "_CreateUser");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $tbl_contact->CreateUser->caption(), $tbl_contact->CreateUser->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($tbl_contact_add->CreateDate->Required) { ?>
			elm = this.getElements("x" + infix + "_CreateDate");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $tbl_contact->CreateDate->caption(), $tbl_contact->CreateDate->RequiredErrorMessage)) ?>");
		<?php } ?>
			elm = this.getElements("x" + infix + "_CreateDate");
			if (elm && !ew.checkEuroDate(elm.value))
				return this.onError(elm, "<?php echo JsEncode($tbl_contact->CreateDate->errorMessage()) ?>");

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
ftbl_contactadd.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

	// Your custom validation code here, return false if invalid.
	return true;
}

// Use JavaScript validation or not
ftbl_contactadd.validateRequired = <?php echo json_encode(CLIENT_VALIDATE) ?>;

// Dynamic selection lists
ftbl_contactadd.lists["x_ContactType"] = <?php echo $tbl_contact_add->ContactType->Lookup->toClientList() ?>;
ftbl_contactadd.lists["x_ContactType"].options = <?php echo JsonEncode($tbl_contact_add->ContactType->options(FALSE, TRUE)) ?>;

// Form object for search
</script>
<script>

// Write your client script here, no need to add script tags.
</script>
<?php $tbl_contact_add->showPageHeader(); ?>
<?php
$tbl_contact_add->showMessage();
?>
<form name="ftbl_contactadd" id="ftbl_contactadd" class="<?php echo $tbl_contact_add->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($tbl_contact_add->CheckToken) { ?>
<input type="hidden" name="<?php echo TOKEN_NAME ?>" value="<?php echo $tbl_contact_add->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="tbl_contact">
<input type="hidden" name="action" id="action" value="insert">
<input type="hidden" name="modal" value="<?php echo (int)$tbl_contact_add->IsModal ?>">
<div class="ew-add-div"><!-- page* -->
<?php if ($tbl_contact->CodeContact->Visible) { // CodeContact ?>
	<div id="r_CodeContact" class="form-group row">
		<label id="elh_tbl_contact_CodeContact" for="x_CodeContact" class="<?php echo $tbl_contact_add->LeftColumnClass ?>"><?php echo $tbl_contact->CodeContact->caption() ?><?php echo ($tbl_contact->CodeContact->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $tbl_contact_add->RightColumnClass ?>"><div<?php echo $tbl_contact->CodeContact->cellAttributes() ?>>
<span id="el_tbl_contact_CodeContact">
<input type="text" data-table="tbl_contact" data-field="x_CodeContact" name="x_CodeContact" id="x_CodeContact" size="30" maxlength="15" placeholder="<?php echo HtmlEncode($tbl_contact->CodeContact->getPlaceHolder()) ?>" value="<?php echo $tbl_contact->CodeContact->EditValue ?>"<?php echo $tbl_contact->CodeContact->editAttributes() ?>>
</span>
<?php echo $tbl_contact->CodeContact->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($tbl_contact->ContactType->Visible) { // ContactType ?>
	<div id="r_ContactType" class="form-group row">
		<label id="elh_tbl_contact_ContactType" for="x_ContactType" class="<?php echo $tbl_contact_add->LeftColumnClass ?>"><?php echo $tbl_contact->ContactType->caption() ?><?php echo ($tbl_contact->ContactType->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $tbl_contact_add->RightColumnClass ?>"><div<?php echo $tbl_contact->ContactType->cellAttributes() ?>>
<span id="el_tbl_contact_ContactType">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="tbl_contact" data-field="x_ContactType" data-value-separator="<?php echo $tbl_contact->ContactType->displayValueSeparatorAttribute() ?>" id="x_ContactType" name="x_ContactType"<?php echo $tbl_contact->ContactType->editAttributes() ?>>
		<?php echo $tbl_contact->ContactType->selectOptionListHtml("x_ContactType") ?>
	</select>
</div>
</span>
<?php echo $tbl_contact->ContactType->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($tbl_contact->ContactName->Visible) { // ContactName ?>
	<div id="r_ContactName" class="form-group row">
		<label id="elh_tbl_contact_ContactName" for="x_ContactName" class="<?php echo $tbl_contact_add->LeftColumnClass ?>"><?php echo $tbl_contact->ContactName->caption() ?><?php echo ($tbl_contact->ContactName->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $tbl_contact_add->RightColumnClass ?>"><div<?php echo $tbl_contact->ContactName->cellAttributes() ?>>
<span id="el_tbl_contact_ContactName">
<input type="text" data-table="tbl_contact" data-field="x_ContactName" name="x_ContactName" id="x_ContactName" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($tbl_contact->ContactName->getPlaceHolder()) ?>" value="<?php echo $tbl_contact->ContactName->EditValue ?>"<?php echo $tbl_contact->ContactName->editAttributes() ?>>
</span>
<?php echo $tbl_contact->ContactName->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($tbl_contact->CompanyName->Visible) { // CompanyName ?>
	<div id="r_CompanyName" class="form-group row">
		<label id="elh_tbl_contact_CompanyName" for="x_CompanyName" class="<?php echo $tbl_contact_add->LeftColumnClass ?>"><?php echo $tbl_contact->CompanyName->caption() ?><?php echo ($tbl_contact->CompanyName->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $tbl_contact_add->RightColumnClass ?>"><div<?php echo $tbl_contact->CompanyName->cellAttributes() ?>>
<span id="el_tbl_contact_CompanyName">
<input type="text" data-table="tbl_contact" data-field="x_CompanyName" name="x_CompanyName" id="x_CompanyName" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($tbl_contact->CompanyName->getPlaceHolder()) ?>" value="<?php echo $tbl_contact->CompanyName->EditValue ?>"<?php echo $tbl_contact->CompanyName->editAttributes() ?>>
</span>
<?php echo $tbl_contact->CompanyName->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($tbl_contact->Address->Visible) { // Address ?>
	<div id="r_Address" class="form-group row">
		<label id="elh_tbl_contact_Address" for="x_Address" class="<?php echo $tbl_contact_add->LeftColumnClass ?>"><?php echo $tbl_contact->Address->caption() ?><?php echo ($tbl_contact->Address->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $tbl_contact_add->RightColumnClass ?>"><div<?php echo $tbl_contact->Address->cellAttributes() ?>>
<span id="el_tbl_contact_Address">
<input type="text" data-table="tbl_contact" data-field="x_Address" name="x_Address" id="x_Address" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($tbl_contact->Address->getPlaceHolder()) ?>" value="<?php echo $tbl_contact->Address->EditValue ?>"<?php echo $tbl_contact->Address->editAttributes() ?>>
</span>
<?php echo $tbl_contact->Address->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($tbl_contact->ContactPhone->Visible) { // ContactPhone ?>
	<div id="r_ContactPhone" class="form-group row">
		<label id="elh_tbl_contact_ContactPhone" for="x_ContactPhone" class="<?php echo $tbl_contact_add->LeftColumnClass ?>"><?php echo $tbl_contact->ContactPhone->caption() ?><?php echo ($tbl_contact->ContactPhone->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $tbl_contact_add->RightColumnClass ?>"><div<?php echo $tbl_contact->ContactPhone->cellAttributes() ?>>
<span id="el_tbl_contact_ContactPhone">
<input type="text" data-table="tbl_contact" data-field="x_ContactPhone" name="x_ContactPhone" id="x_ContactPhone" size="30" maxlength="50" placeholder="<?php echo HtmlEncode($tbl_contact->ContactPhone->getPlaceHolder()) ?>" value="<?php echo $tbl_contact->ContactPhone->EditValue ?>"<?php echo $tbl_contact->ContactPhone->editAttributes() ?>>
</span>
<?php echo $tbl_contact->ContactPhone->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($tbl_contact->ContactEmail->Visible) { // ContactEmail ?>
	<div id="r_ContactEmail" class="form-group row">
		<label id="elh_tbl_contact_ContactEmail" for="x_ContactEmail" class="<?php echo $tbl_contact_add->LeftColumnClass ?>"><?php echo $tbl_contact->ContactEmail->caption() ?><?php echo ($tbl_contact->ContactEmail->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $tbl_contact_add->RightColumnClass ?>"><div<?php echo $tbl_contact->ContactEmail->cellAttributes() ?>>
<span id="el_tbl_contact_ContactEmail">
<input type="text" data-table="tbl_contact" data-field="x_ContactEmail" name="x_ContactEmail" id="x_ContactEmail" size="30" maxlength="50" placeholder="<?php echo HtmlEncode($tbl_contact->ContactEmail->getPlaceHolder()) ?>" value="<?php echo $tbl_contact->ContactEmail->EditValue ?>"<?php echo $tbl_contact->ContactEmail->editAttributes() ?>>
</span>
<?php echo $tbl_contact->ContactEmail->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($tbl_contact->ReceiveName->Visible) { // ReceiveName ?>
	<div id="r_ReceiveName" class="form-group row">
		<label id="elh_tbl_contact_ReceiveName" for="x_ReceiveName" class="<?php echo $tbl_contact_add->LeftColumnClass ?>"><?php echo $tbl_contact->ReceiveName->caption() ?><?php echo ($tbl_contact->ReceiveName->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $tbl_contact_add->RightColumnClass ?>"><div<?php echo $tbl_contact->ReceiveName->cellAttributes() ?>>
<span id="el_tbl_contact_ReceiveName">
<input type="text" data-table="tbl_contact" data-field="x_ReceiveName" name="x_ReceiveName" id="x_ReceiveName" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($tbl_contact->ReceiveName->getPlaceHolder()) ?>" value="<?php echo $tbl_contact->ReceiveName->EditValue ?>"<?php echo $tbl_contact->ReceiveName->editAttributes() ?>>
</span>
<?php echo $tbl_contact->ReceiveName->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($tbl_contact->ReceiveTime->Visible) { // ReceiveTime ?>
	<div id="r_ReceiveTime" class="form-group row">
		<label id="elh_tbl_contact_ReceiveTime" for="x_ReceiveTime" class="<?php echo $tbl_contact_add->LeftColumnClass ?>"><?php echo $tbl_contact->ReceiveTime->caption() ?><?php echo ($tbl_contact->ReceiveTime->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $tbl_contact_add->RightColumnClass ?>"><div<?php echo $tbl_contact->ReceiveTime->cellAttributes() ?>>
<span id="el_tbl_contact_ReceiveTime">
<input type="text" data-table="tbl_contact" data-field="x_ReceiveTime" name="x_ReceiveTime" id="x_ReceiveTime" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($tbl_contact->ReceiveTime->getPlaceHolder()) ?>" value="<?php echo $tbl_contact->ReceiveTime->EditValue ?>"<?php echo $tbl_contact->ReceiveTime->editAttributes() ?>>
</span>
<?php echo $tbl_contact->ReceiveTime->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($tbl_contact->Note->Visible) { // Note ?>
	<div id="r_Note" class="form-group row">
		<label id="elh_tbl_contact_Note" for="x_Note" class="<?php echo $tbl_contact_add->LeftColumnClass ?>"><?php echo $tbl_contact->Note->caption() ?><?php echo ($tbl_contact->Note->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $tbl_contact_add->RightColumnClass ?>"><div<?php echo $tbl_contact->Note->cellAttributes() ?>>
<span id="el_tbl_contact_Note">
<input type="text" data-table="tbl_contact" data-field="x_Note" name="x_Note" id="x_Note" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($tbl_contact->Note->getPlaceHolder()) ?>" value="<?php echo $tbl_contact->Note->EditValue ?>"<?php echo $tbl_contact->Note->editAttributes() ?>>
</span>
<?php echo $tbl_contact->Note->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($tbl_contact->CreateUser->Visible) { // CreateUser ?>
	<div id="r_CreateUser" class="form-group row">
		<label id="elh_tbl_contact_CreateUser" for="x_CreateUser" class="<?php echo $tbl_contact_add->LeftColumnClass ?>"><?php echo $tbl_contact->CreateUser->caption() ?><?php echo ($tbl_contact->CreateUser->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $tbl_contact_add->RightColumnClass ?>"><div<?php echo $tbl_contact->CreateUser->cellAttributes() ?>>
<span id="el_tbl_contact_CreateUser">
<input type="text" data-table="tbl_contact" data-field="x_CreateUser" name="x_CreateUser" id="x_CreateUser" size="30" maxlength="50" placeholder="<?php echo HtmlEncode($tbl_contact->CreateUser->getPlaceHolder()) ?>" value="<?php echo $tbl_contact->CreateUser->EditValue ?>"<?php echo $tbl_contact->CreateUser->editAttributes() ?>>
</span>
<?php echo $tbl_contact->CreateUser->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($tbl_contact->CreateDate->Visible) { // CreateDate ?>
	<div id="r_CreateDate" class="form-group row">
		<label id="elh_tbl_contact_CreateDate" for="x_CreateDate" class="<?php echo $tbl_contact_add->LeftColumnClass ?>"><?php echo $tbl_contact->CreateDate->caption() ?><?php echo ($tbl_contact->CreateDate->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $tbl_contact_add->RightColumnClass ?>"><div<?php echo $tbl_contact->CreateDate->cellAttributes() ?>>
<span id="el_tbl_contact_CreateDate">
<input type="text" data-table="tbl_contact" data-field="x_CreateDate" data-format="11" name="x_CreateDate" id="x_CreateDate" placeholder="<?php echo HtmlEncode($tbl_contact->CreateDate->getPlaceHolder()) ?>" value="<?php echo $tbl_contact->CreateDate->EditValue ?>"<?php echo $tbl_contact->CreateDate->editAttributes() ?>>
<?php if (!$tbl_contact->CreateDate->ReadOnly && !$tbl_contact->CreateDate->Disabled && !isset($tbl_contact->CreateDate->EditAttrs["readonly"]) && !isset($tbl_contact->CreateDate->EditAttrs["disabled"])) { ?>
<script>
ew.createDateTimePicker("ftbl_contactadd", "x_CreateDate", {"ignoreReadonly":true,"useCurrent":false,"format":11});
</script>
<?php } ?>
</span>
<?php echo $tbl_contact->CreateDate->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$tbl_contact_add->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $tbl_contact_add->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("AddBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $tbl_contact_add->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$tbl_contact_add->showPageFooter();
if (DEBUG_ENABLED)
	echo GetDebugMessage();
?>
<script>

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php include_once "footer.php" ?>
<?php
$tbl_contact_add->terminate();
?>