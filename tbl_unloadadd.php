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
$tbl_unload_add = new tbl_unload_add();

// Run the page
$tbl_unload_add->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$tbl_unload_add->Page_Render();
?>
<?php include_once "header.php" ?>
<script>

// Form object
currentPageID = ew.PAGE_ID = "add";
var ftbl_unloadadd = currentForm = new ew.Form("ftbl_unloadadd", "add");

// Validate form
ftbl_unloadadd.validate = function() {
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
		<?php if ($tbl_unload_add->Code->Required) { ?>
			elm = this.getElements("x" + infix + "_Code");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $tbl_unload->Code->caption(), $tbl_unload->Code->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($tbl_unload_add->PCS->Required) { ?>
			elm = this.getElements("x" + infix + "_PCS");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $tbl_unload->PCS->caption(), $tbl_unload->PCS->RequiredErrorMessage)) ?>");
		<?php } ?>
			elm = this.getElements("x" + infix + "_PCS");
			if (elm && !ew.checkInteger(elm.value))
				return this.onError(elm, "<?php echo JsEncode($tbl_unload->PCS->errorMessage()) ?>");
		<?php if ($tbl_unload_add->RealPCS->Required) { ?>
			elm = this.getElements("x" + infix + "_RealPCS");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $tbl_unload->RealPCS->caption(), $tbl_unload->RealPCS->RequiredErrorMessage)) ?>");
		<?php } ?>
			elm = this.getElements("x" + infix + "_RealPCS");
			if (elm && !ew.checkInteger(elm.value))
				return this.onError(elm, "<?php echo JsEncode($tbl_unload->RealPCS->errorMessage()) ?>");
		<?php if ($tbl_unload_add->Description->Required) { ?>
			elm = this.getElements("x" + infix + "_Description");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $tbl_unload->Description->caption(), $tbl_unload->Description->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($tbl_unload_add->CreateUser->Required) { ?>
			elm = this.getElements("x" + infix + "_CreateUser");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $tbl_unload->CreateUser->caption(), $tbl_unload->CreateUser->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($tbl_unload_add->CreateDate->Required) { ?>
			elm = this.getElements("x" + infix + "_CreateDate");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $tbl_unload->CreateDate->caption(), $tbl_unload->CreateDate->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($tbl_unload_add->MFG->Required) { ?>
			elm = this.getElements("x" + infix + "_MFG");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $tbl_unload->MFG->caption(), $tbl_unload->MFG->RequiredErrorMessage)) ?>");
		<?php } ?>
			elm = this.getElements("x" + infix + "_MFG");
			if (elm && !ew.checkEuroDate(elm.value))
				return this.onError(elm, "<?php echo JsEncode($tbl_unload->MFG->errorMessage()) ?>");

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
ftbl_unloadadd.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

	// Your custom validation code here, return false if invalid.
	return true;
}

// Use JavaScript validation or not
ftbl_unloadadd.validateRequired = <?php echo json_encode(CLIENT_VALIDATE) ?>;

// Dynamic selection lists
ftbl_unloadadd.lists["x_Code"] = <?php echo $tbl_unload_add->Code->Lookup->toClientList() ?>;
ftbl_unloadadd.lists["x_Code"].options = <?php echo JsonEncode($tbl_unload_add->Code->lookupOptions()) ?>;
ftbl_unloadadd.autoSuggests["x_Code"] = <?php echo json_encode(["data" => "ajax=autosuggest"]) ?>;

// Form object for search
</script>
<script>

// Write your client script here, no need to add script tags.
</script>
<?php $tbl_unload_add->showPageHeader(); ?>
<?php
$tbl_unload_add->showMessage();
?>
<form name="ftbl_unloadadd" id="ftbl_unloadadd" class="<?php echo $tbl_unload_add->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($tbl_unload_add->CheckToken) { ?>
<input type="hidden" name="<?php echo TOKEN_NAME ?>" value="<?php echo $tbl_unload_add->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="tbl_unload">
<input type="hidden" name="action" id="action" value="insert">
<input type="hidden" name="modal" value="<?php echo (int)$tbl_unload_add->IsModal ?>">
<?php if ($tbl_unload->getCurrentMasterTable() == "tbl_route") { ?>
<input type="hidden" name="<?php echo TABLE_SHOW_MASTER ?>" value="tbl_route">
<input type="hidden" name="fk_ID_Route" value="<?php echo $tbl_unload->ID_Route->getSessionValue() ?>">
<?php } ?>
<div class="ew-add-div"><!-- page* -->
<?php if ($tbl_unload->Code->Visible) { // Code ?>
	<div id="r_Code" class="form-group row">
		<label id="elh_tbl_unload_Code" class="<?php echo $tbl_unload_add->LeftColumnClass ?>"><?php echo $tbl_unload->Code->caption() ?><?php echo ($tbl_unload->Code->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $tbl_unload_add->RightColumnClass ?>"><div<?php echo $tbl_unload->Code->cellAttributes() ?>>
<span id="el_tbl_unload_Code">
<?php
$wrkonchange = "" . trim(@$tbl_unload->Code->EditAttrs["onchange"]);
if (trim($wrkonchange) <> "") $wrkonchange = " onchange=\"" . JsEncode($wrkonchange) . "\"";
$tbl_unload->Code->EditAttrs["onchange"] = "";
?>
<span id="as_x_Code" class="text-nowrap" style="z-index: 8970">
	<input type="text" class="form-control" name="sv_x_Code" id="sv_x_Code" value="<?php echo RemoveHtml($tbl_unload->Code->EditValue) ?>" size="30" placeholder="<?php echo HtmlEncode($tbl_unload->Code->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($tbl_unload->Code->getPlaceHolder()) ?>"<?php echo $tbl_unload->Code->editAttributes() ?>>
</span>
<input type="hidden" data-table="tbl_unload" data-field="x_Code" data-value-separator="<?php echo $tbl_unload->Code->displayValueSeparatorAttribute() ?>" name="x_Code" id="x_Code" value="<?php echo HtmlEncode($tbl_unload->Code->CurrentValue) ?>"<?php echo $wrkonchange ?>>
<script>
ftbl_unloadadd.createAutoSuggest({"id":"x_Code","forceSelect":true});
</script>
<?php echo $tbl_unload->Code->Lookup->getParamTag("p_x_Code") ?>
</span>
<?php echo $tbl_unload->Code->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($tbl_unload->PCS->Visible) { // PCS ?>
	<div id="r_PCS" class="form-group row">
		<label id="elh_tbl_unload_PCS" for="x_PCS" class="<?php echo $tbl_unload_add->LeftColumnClass ?>"><?php echo $tbl_unload->PCS->caption() ?><?php echo ($tbl_unload->PCS->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $tbl_unload_add->RightColumnClass ?>"><div<?php echo $tbl_unload->PCS->cellAttributes() ?>>
<span id="el_tbl_unload_PCS">
<input type="text" data-table="tbl_unload" data-field="x_PCS" name="x_PCS" id="x_PCS" size="5" placeholder="<?php echo HtmlEncode($tbl_unload->PCS->getPlaceHolder()) ?>" value="<?php echo $tbl_unload->PCS->EditValue ?>"<?php echo $tbl_unload->PCS->editAttributes() ?>>
</span>
<?php echo $tbl_unload->PCS->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($tbl_unload->RealPCS->Visible) { // RealPCS ?>
	<div id="r_RealPCS" class="form-group row">
		<label id="elh_tbl_unload_RealPCS" for="x_RealPCS" class="<?php echo $tbl_unload_add->LeftColumnClass ?>"><?php echo $tbl_unload->RealPCS->caption() ?><?php echo ($tbl_unload->RealPCS->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $tbl_unload_add->RightColumnClass ?>"><div<?php echo $tbl_unload->RealPCS->cellAttributes() ?>>
<span id="el_tbl_unload_RealPCS">
<input type="text" data-table="tbl_unload" data-field="x_RealPCS" name="x_RealPCS" id="x_RealPCS" size="5" placeholder="<?php echo HtmlEncode($tbl_unload->RealPCS->getPlaceHolder()) ?>" value="<?php echo $tbl_unload->RealPCS->EditValue ?>"<?php echo $tbl_unload->RealPCS->editAttributes() ?>>
</span>
<?php echo $tbl_unload->RealPCS->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($tbl_unload->Description->Visible) { // Description ?>
	<div id="r_Description" class="form-group row">
		<label id="elh_tbl_unload_Description" for="x_Description" class="<?php echo $tbl_unload_add->LeftColumnClass ?>"><?php echo $tbl_unload->Description->caption() ?><?php echo ($tbl_unload->Description->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $tbl_unload_add->RightColumnClass ?>"><div<?php echo $tbl_unload->Description->cellAttributes() ?>>
<span id="el_tbl_unload_Description">
<input type="text" data-table="tbl_unload" data-field="x_Description" name="x_Description" id="x_Description" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($tbl_unload->Description->getPlaceHolder()) ?>" value="<?php echo $tbl_unload->Description->EditValue ?>"<?php echo $tbl_unload->Description->editAttributes() ?>>
</span>
<?php echo $tbl_unload->Description->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($tbl_unload->MFG->Visible) { // MFG ?>
	<div id="r_MFG" class="form-group row">
		<label id="elh_tbl_unload_MFG" for="x_MFG" class="<?php echo $tbl_unload_add->LeftColumnClass ?>"><?php echo $tbl_unload->MFG->caption() ?><?php echo ($tbl_unload->MFG->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $tbl_unload_add->RightColumnClass ?>"><div<?php echo $tbl_unload->MFG->cellAttributes() ?>>
<span id="el_tbl_unload_MFG">
<input type="text" data-table="tbl_unload" data-field="x_MFG" data-format="7" name="x_MFG" id="x_MFG" placeholder="<?php echo HtmlEncode($tbl_unload->MFG->getPlaceHolder()) ?>" value="<?php echo $tbl_unload->MFG->EditValue ?>"<?php echo $tbl_unload->MFG->editAttributes() ?>>
<?php if (!$tbl_unload->MFG->ReadOnly && !$tbl_unload->MFG->Disabled && !isset($tbl_unload->MFG->EditAttrs["readonly"]) && !isset($tbl_unload->MFG->EditAttrs["disabled"])) { ?>
<script>
ew.createDateTimePicker("ftbl_unloadadd", "x_MFG", {"ignoreReadonly":true,"useCurrent":false,"format":7});
</script>
<?php } ?>
</span>
<?php echo $tbl_unload->MFG->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
	<?php if (strval($tbl_unload->ID_Route->getSessionValue()) <> "") { ?>
	<input type="hidden" name="x_ID_Route" id="x_ID_Route" value="<?php echo HtmlEncode(strval($tbl_unload->ID_Route->getSessionValue())) ?>">
	<?php } ?>
<?php if (!$tbl_unload_add->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $tbl_unload_add->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("AddBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $tbl_unload_add->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$tbl_unload_add->showPageFooter();
if (DEBUG_ENABLED)
	echo GetDebugMessage();
?>
<script>

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php include_once "footer.php" ?>
<?php
$tbl_unload_add->terminate();
?>