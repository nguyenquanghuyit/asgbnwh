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
$tbl_stock_add = new tbl_stock_add();

// Run the page
$tbl_stock_add->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$tbl_stock_add->Page_Render();
?>
<?php include_once "header.php" ?>
<script>

// Form object
currentPageID = ew.PAGE_ID = "add";
var ftbl_stockadd = currentForm = new ew.Form("ftbl_stockadd", "add");

// Validate form
ftbl_stockadd.validate = function() {
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
		<?php if ($tbl_stock_add->PalletID->Required) { ?>
			elm = this.getElements("x" + infix + "_PalletID");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $tbl_stock->PalletID->caption(), $tbl_stock->PalletID->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($tbl_stock_add->Code->Required) { ?>
			elm = this.getElements("x" + infix + "_Code");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $tbl_stock->Code->caption(), $tbl_stock->Code->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($tbl_stock_add->IdType->Required) { ?>
			elm = this.getElements("x" + infix + "_IdType");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $tbl_stock->IdType->caption(), $tbl_stock->IdType->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($tbl_stock_add->ID_Location->Required) { ?>
			elm = this.getElements("x" + infix + "_ID_Location");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $tbl_stock->ID_Location->caption(), $tbl_stock->ID_Location->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($tbl_stock_add->Pcs_RemainPicking->Required) { ?>
			elm = this.getElements("x" + infix + "_Pcs_RemainPicking");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $tbl_stock->Pcs_RemainPicking->caption(), $tbl_stock->Pcs_RemainPicking->RequiredErrorMessage)) ?>");
		<?php } ?>
			elm = this.getElements("x" + infix + "_Pcs_RemainPicking");
			if (elm && !ew.checkInteger(elm.value))
				return this.onError(elm, "<?php echo JsEncode($tbl_stock->Pcs_RemainPicking->errorMessage()) ?>");
		<?php if ($tbl_stock_add->MFG->Required) { ?>
			elm = this.getElements("x" + infix + "_MFG");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $tbl_stock->MFG->caption(), $tbl_stock->MFG->RequiredErrorMessage)) ?>");
		<?php } ?>
			elm = this.getElements("x" + infix + "_MFG");
			if (elm && !ew.checkEuroDate(elm.value))
				return this.onError(elm, "<?php echo JsEncode($tbl_stock->MFG->errorMessage()) ?>");
		<?php if ($tbl_stock_add->Note_PalletId->Required) { ?>
			elm = this.getElements("x" + infix + "_Note_PalletId");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $tbl_stock->Note_PalletId->caption(), $tbl_stock->Note_PalletId->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($tbl_stock_add->CreateUser->Required) { ?>
			elm = this.getElements("x" + infix + "_CreateUser");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $tbl_stock->CreateUser->caption(), $tbl_stock->CreateUser->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($tbl_stock_add->CreateDate->Required) { ?>
			elm = this.getElements("x" + infix + "_CreateDate");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $tbl_stock->CreateDate->caption(), $tbl_stock->CreateDate->RequiredErrorMessage)) ?>");
		<?php } ?>
			elm = this.getElements("x" + infix + "_CreateDate");
			if (elm && !ew.checkEuroDate(elm.value))
				return this.onError(elm, "<?php echo JsEncode($tbl_stock->CreateDate->errorMessage()) ?>");

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
ftbl_stockadd.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

	// Your custom validation code here, return false if invalid.
	return true;
}

// Use JavaScript validation or not
ftbl_stockadd.validateRequired = <?php echo json_encode(CLIENT_VALIDATE) ?>;

// Dynamic selection lists
ftbl_stockadd.lists["x_IdType"] = <?php echo $tbl_stock_add->IdType->Lookup->toClientList() ?>;
ftbl_stockadd.lists["x_IdType"].options = <?php echo JsonEncode($tbl_stock_add->IdType->lookupOptions()) ?>;
ftbl_stockadd.lists["x_ID_Location"] = <?php echo $tbl_stock_add->ID_Location->Lookup->toClientList() ?>;
ftbl_stockadd.lists["x_ID_Location"].options = <?php echo JsonEncode($tbl_stock_add->ID_Location->lookupOptions()) ?>;
ftbl_stockadd.autoSuggests["x_ID_Location"] = <?php echo json_encode(["data" => "ajax=autosuggest"]) ?>;

// Form object for search
</script>
<script>

// Write your client script here, no need to add script tags.
</script>
<?php $tbl_stock_add->showPageHeader(); ?>
<?php
$tbl_stock_add->showMessage();
?>
<form name="ftbl_stockadd" id="ftbl_stockadd" class="<?php echo $tbl_stock_add->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($tbl_stock_add->CheckToken) { ?>
<input type="hidden" name="<?php echo TOKEN_NAME ?>" value="<?php echo $tbl_stock_add->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="tbl_stock">
<input type="hidden" name="action" id="action" value="insert">
<input type="hidden" name="modal" value="<?php echo (int)$tbl_stock_add->IsModal ?>">
<div class="ew-add-div"><!-- page* -->
<?php if ($tbl_stock->PalletID->Visible) { // PalletID ?>
	<div id="r_PalletID" class="form-group row">
		<label id="elh_tbl_stock_PalletID" for="x_PalletID" class="<?php echo $tbl_stock_add->LeftColumnClass ?>"><?php echo $tbl_stock->PalletID->caption() ?><?php echo ($tbl_stock->PalletID->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $tbl_stock_add->RightColumnClass ?>"><div<?php echo $tbl_stock->PalletID->cellAttributes() ?>>
<span id="el_tbl_stock_PalletID">
<input type="text" data-table="tbl_stock" data-field="x_PalletID" name="x_PalletID" id="x_PalletID" size="30" maxlength="50" placeholder="<?php echo HtmlEncode($tbl_stock->PalletID->getPlaceHolder()) ?>" value="<?php echo $tbl_stock->PalletID->EditValue ?>"<?php echo $tbl_stock->PalletID->editAttributes() ?>>
</span>
<?php echo $tbl_stock->PalletID->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($tbl_stock->Code->Visible) { // Code ?>
	<div id="r_Code" class="form-group row">
		<label id="elh_tbl_stock_Code" for="x_Code" class="<?php echo $tbl_stock_add->LeftColumnClass ?>"><?php echo $tbl_stock->Code->caption() ?><?php echo ($tbl_stock->Code->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $tbl_stock_add->RightColumnClass ?>"><div<?php echo $tbl_stock->Code->cellAttributes() ?>>
<span id="el_tbl_stock_Code">
<input type="text" data-table="tbl_stock" data-field="x_Code" name="x_Code" id="x_Code" size="30" maxlength="50" placeholder="<?php echo HtmlEncode($tbl_stock->Code->getPlaceHolder()) ?>" value="<?php echo $tbl_stock->Code->EditValue ?>"<?php echo $tbl_stock->Code->editAttributes() ?>>
</span>
<?php echo $tbl_stock->Code->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($tbl_stock->IdType->Visible) { // IdType ?>
	<div id="r_IdType" class="form-group row">
		<label id="elh_tbl_stock_IdType" for="x_IdType" class="<?php echo $tbl_stock_add->LeftColumnClass ?>"><?php echo $tbl_stock->IdType->caption() ?><?php echo ($tbl_stock->IdType->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $tbl_stock_add->RightColumnClass ?>"><div<?php echo $tbl_stock->IdType->cellAttributes() ?>>
<span id="el_tbl_stock_IdType">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="tbl_stock" data-field="x_IdType" data-value-separator="<?php echo $tbl_stock->IdType->displayValueSeparatorAttribute() ?>" id="x_IdType" name="x_IdType"<?php echo $tbl_stock->IdType->editAttributes() ?>>
		<?php echo $tbl_stock->IdType->selectOptionListHtml("x_IdType") ?>
	</select>
</div>
<?php echo $tbl_stock->IdType->Lookup->getParamTag("p_x_IdType") ?>
</span>
<?php echo $tbl_stock->IdType->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($tbl_stock->ID_Location->Visible) { // ID_Location ?>
	<div id="r_ID_Location" class="form-group row">
		<label id="elh_tbl_stock_ID_Location" class="<?php echo $tbl_stock_add->LeftColumnClass ?>"><?php echo $tbl_stock->ID_Location->caption() ?><?php echo ($tbl_stock->ID_Location->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $tbl_stock_add->RightColumnClass ?>"><div<?php echo $tbl_stock->ID_Location->cellAttributes() ?>>
<span id="el_tbl_stock_ID_Location">
<?php
$wrkonchange = "" . trim(@$tbl_stock->ID_Location->EditAttrs["onchange"]);
if (trim($wrkonchange) <> "") $wrkonchange = " onchange=\"" . JsEncode($wrkonchange) . "\"";
$tbl_stock->ID_Location->EditAttrs["onchange"] = "";
?>
<span id="as_x_ID_Location" class="text-nowrap" style="z-index: 8950">
	<input type="text" class="form-control" name="sv_x_ID_Location" id="sv_x_ID_Location" value="<?php echo RemoveHtml($tbl_stock->ID_Location->EditValue) ?>" size="30" placeholder="<?php echo HtmlEncode($tbl_stock->ID_Location->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($tbl_stock->ID_Location->getPlaceHolder()) ?>"<?php echo $tbl_stock->ID_Location->editAttributes() ?>>
</span>
<input type="hidden" data-table="tbl_stock" data-field="x_ID_Location" data-value-separator="<?php echo $tbl_stock->ID_Location->displayValueSeparatorAttribute() ?>" name="x_ID_Location" id="x_ID_Location" value="<?php echo HtmlEncode($tbl_stock->ID_Location->CurrentValue) ?>"<?php echo $wrkonchange ?>>
<script>
ftbl_stockadd.createAutoSuggest({"id":"x_ID_Location","forceSelect":true});
</script>
<?php echo $tbl_stock->ID_Location->Lookup->getParamTag("p_x_ID_Location") ?>
</span>
<?php echo $tbl_stock->ID_Location->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($tbl_stock->Pcs_RemainPicking->Visible) { // Pcs_RemainPicking ?>
	<div id="r_Pcs_RemainPicking" class="form-group row">
		<label id="elh_tbl_stock_Pcs_RemainPicking" for="x_Pcs_RemainPicking" class="<?php echo $tbl_stock_add->LeftColumnClass ?>"><?php echo $tbl_stock->Pcs_RemainPicking->caption() ?><?php echo ($tbl_stock->Pcs_RemainPicking->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $tbl_stock_add->RightColumnClass ?>"><div<?php echo $tbl_stock->Pcs_RemainPicking->cellAttributes() ?>>
<span id="el_tbl_stock_Pcs_RemainPicking">
<input type="text" data-table="tbl_stock" data-field="x_Pcs_RemainPicking" name="x_Pcs_RemainPicking" id="x_Pcs_RemainPicking" size="3" placeholder="<?php echo HtmlEncode($tbl_stock->Pcs_RemainPicking->getPlaceHolder()) ?>" value="<?php echo $tbl_stock->Pcs_RemainPicking->EditValue ?>"<?php echo $tbl_stock->Pcs_RemainPicking->editAttributes() ?>>
</span>
<?php echo $tbl_stock->Pcs_RemainPicking->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($tbl_stock->MFG->Visible) { // MFG ?>
	<div id="r_MFG" class="form-group row">
		<label id="elh_tbl_stock_MFG" for="x_MFG" class="<?php echo $tbl_stock_add->LeftColumnClass ?>"><?php echo $tbl_stock->MFG->caption() ?><?php echo ($tbl_stock->MFG->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $tbl_stock_add->RightColumnClass ?>"><div<?php echo $tbl_stock->MFG->cellAttributes() ?>>
<span id="el_tbl_stock_MFG">
<input type="text" data-table="tbl_stock" data-field="x_MFG" data-format="7" name="x_MFG" id="x_MFG" placeholder="<?php echo HtmlEncode($tbl_stock->MFG->getPlaceHolder()) ?>" value="<?php echo $tbl_stock->MFG->EditValue ?>"<?php echo $tbl_stock->MFG->editAttributes() ?>>
<?php if (!$tbl_stock->MFG->ReadOnly && !$tbl_stock->MFG->Disabled && !isset($tbl_stock->MFG->EditAttrs["readonly"]) && !isset($tbl_stock->MFG->EditAttrs["disabled"])) { ?>
<script>
ew.createDateTimePicker("ftbl_stockadd", "x_MFG", {"ignoreReadonly":true,"useCurrent":false,"format":7});
</script>
<?php } ?>
</span>
<?php echo $tbl_stock->MFG->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($tbl_stock->Note_PalletId->Visible) { // Note_PalletId ?>
	<div id="r_Note_PalletId" class="form-group row">
		<label id="elh_tbl_stock_Note_PalletId" for="x_Note_PalletId" class="<?php echo $tbl_stock_add->LeftColumnClass ?>"><?php echo $tbl_stock->Note_PalletId->caption() ?><?php echo ($tbl_stock->Note_PalletId->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $tbl_stock_add->RightColumnClass ?>"><div<?php echo $tbl_stock->Note_PalletId->cellAttributes() ?>>
<span id="el_tbl_stock_Note_PalletId">
<input type="text" data-table="tbl_stock" data-field="x_Note_PalletId" name="x_Note_PalletId" id="x_Note_PalletId" size="30" maxlength="55" placeholder="<?php echo HtmlEncode($tbl_stock->Note_PalletId->getPlaceHolder()) ?>" value="<?php echo $tbl_stock->Note_PalletId->EditValue ?>"<?php echo $tbl_stock->Note_PalletId->editAttributes() ?>>
</span>
<?php echo $tbl_stock->Note_PalletId->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($tbl_stock->CreateUser->Visible) { // CreateUser ?>
	<div id="r_CreateUser" class="form-group row">
		<label id="elh_tbl_stock_CreateUser" for="x_CreateUser" class="<?php echo $tbl_stock_add->LeftColumnClass ?>"><?php echo $tbl_stock->CreateUser->caption() ?><?php echo ($tbl_stock->CreateUser->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $tbl_stock_add->RightColumnClass ?>"><div<?php echo $tbl_stock->CreateUser->cellAttributes() ?>>
<span id="el_tbl_stock_CreateUser">
<input type="text" data-table="tbl_stock" data-field="x_CreateUser" name="x_CreateUser" id="x_CreateUser" size="30" maxlength="50" placeholder="<?php echo HtmlEncode($tbl_stock->CreateUser->getPlaceHolder()) ?>" value="<?php echo $tbl_stock->CreateUser->EditValue ?>"<?php echo $tbl_stock->CreateUser->editAttributes() ?>>
</span>
<?php echo $tbl_stock->CreateUser->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($tbl_stock->CreateDate->Visible) { // CreateDate ?>
	<div id="r_CreateDate" class="form-group row">
		<label id="elh_tbl_stock_CreateDate" for="x_CreateDate" class="<?php echo $tbl_stock_add->LeftColumnClass ?>"><?php echo $tbl_stock->CreateDate->caption() ?><?php echo ($tbl_stock->CreateDate->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $tbl_stock_add->RightColumnClass ?>"><div<?php echo $tbl_stock->CreateDate->cellAttributes() ?>>
<span id="el_tbl_stock_CreateDate">
<input type="text" data-table="tbl_stock" data-field="x_CreateDate" data-format="11" name="x_CreateDate" id="x_CreateDate" placeholder="<?php echo HtmlEncode($tbl_stock->CreateDate->getPlaceHolder()) ?>" value="<?php echo $tbl_stock->CreateDate->EditValue ?>"<?php echo $tbl_stock->CreateDate->editAttributes() ?>>
<?php if (!$tbl_stock->CreateDate->ReadOnly && !$tbl_stock->CreateDate->Disabled && !isset($tbl_stock->CreateDate->EditAttrs["readonly"]) && !isset($tbl_stock->CreateDate->EditAttrs["disabled"])) { ?>
<script>
ew.createDateTimePicker("ftbl_stockadd", "x_CreateDate", {"ignoreReadonly":true,"useCurrent":false,"format":11});
</script>
<?php } ?>
</span>
<?php echo $tbl_stock->CreateDate->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$tbl_stock_add->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $tbl_stock_add->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("AddBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $tbl_stock_add->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$tbl_stock_add->showPageFooter();
if (DEBUG_ENABLED)
	echo GetDebugMessage();
?>
<script>

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php include_once "footer.php" ?>
<?php
$tbl_stock_add->terminate();
?>