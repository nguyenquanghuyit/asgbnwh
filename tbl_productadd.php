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
$tbl_product_add = new tbl_product_add();

// Run the page
$tbl_product_add->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$tbl_product_add->Page_Render();
?>
<?php include_once "header.php" ?>
<script>

// Form object
currentPageID = ew.PAGE_ID = "add";
var ftbl_productadd = currentForm = new ew.Form("ftbl_productadd", "add");

// Validate form
ftbl_productadd.validate = function() {
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
		<?php if ($tbl_product_add->IdType->Required) { ?>
			elm = this.getElements("x" + infix + "_IdType");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $tbl_product->IdType->caption(), $tbl_product->IdType->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($tbl_product_add->Code->Required) { ?>
			elm = this.getElements("x" + infix + "_Code");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $tbl_product->Code->caption(), $tbl_product->Code->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($tbl_product_add->Model->Required) { ?>
			elm = this.getElements("x" + infix + "_Model");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $tbl_product->Model->caption(), $tbl_product->Model->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($tbl_product_add->ProductName->Required) { ?>
			elm = this.getElements("x" + infix + "_ProductName");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $tbl_product->ProductName->caption(), $tbl_product->ProductName->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($tbl_product_add->VnName->Required) { ?>
			elm = this.getElements("x" + infix + "_VnName");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $tbl_product->VnName->caption(), $tbl_product->VnName->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($tbl_product_add->ID_Contact->Required) { ?>
			elm = this.getElements("x" + infix + "_ID_Contact");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $tbl_product->ID_Contact->caption(), $tbl_product->ID_Contact->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($tbl_product_add->Description->Required) { ?>
			elm = this.getElements("x" + infix + "_Description");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $tbl_product->Description->caption(), $tbl_product->Description->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($tbl_product_add->CreateDate->Required) { ?>
			elm = this.getElements("x" + infix + "_CreateDate");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $tbl_product->CreateDate->caption(), $tbl_product->CreateDate->RequiredErrorMessage)) ?>");
		<?php } ?>
			elm = this.getElements("x" + infix + "_CreateDate");
			if (elm && !ew.checkEuroDate(elm.value))
				return this.onError(elm, "<?php echo JsEncode($tbl_product->CreateDate->errorMessage()) ?>");
		<?php if ($tbl_product_add->CreateUser->Required) { ?>
			elm = this.getElements("x" + infix + "_CreateUser");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $tbl_product->CreateUser->caption(), $tbl_product->CreateUser->RequiredErrorMessage)) ?>");
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
ftbl_productadd.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

	// Your custom validation code here, return false if invalid.
	return true;
}

// Use JavaScript validation or not
ftbl_productadd.validateRequired = <?php echo json_encode(CLIENT_VALIDATE) ?>;

// Dynamic selection lists
ftbl_productadd.lists["x_IdType"] = <?php echo $tbl_product_add->IdType->Lookup->toClientList() ?>;
ftbl_productadd.lists["x_IdType"].options = <?php echo JsonEncode($tbl_product_add->IdType->lookupOptions()) ?>;
ftbl_productadd.lists["x_ID_Contact"] = <?php echo $tbl_product_add->ID_Contact->Lookup->toClientList() ?>;
ftbl_productadd.lists["x_ID_Contact"].options = <?php echo JsonEncode($tbl_product_add->ID_Contact->lookupOptions()) ?>;
ftbl_productadd.autoSuggests["x_ID_Contact"] = <?php echo json_encode(["data" => "ajax=autosuggest"]) ?>;

// Form object for search
</script>
<script>

// Write your client script here, no need to add script tags.
</script>
<?php $tbl_product_add->showPageHeader(); ?>
<?php
$tbl_product_add->showMessage();
?>
<form name="ftbl_productadd" id="ftbl_productadd" class="<?php echo $tbl_product_add->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($tbl_product_add->CheckToken) { ?>
<input type="hidden" name="<?php echo TOKEN_NAME ?>" value="<?php echo $tbl_product_add->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="tbl_product">
<input type="hidden" name="action" id="action" value="insert">
<input type="hidden" name="modal" value="<?php echo (int)$tbl_product_add->IsModal ?>">
<div class="ew-add-div"><!-- page* -->
<?php if ($tbl_product->IdType->Visible) { // IdType ?>
	<div id="r_IdType" class="form-group row">
		<label id="elh_tbl_product_IdType" for="x_IdType" class="<?php echo $tbl_product_add->LeftColumnClass ?>"><?php echo $tbl_product->IdType->caption() ?><?php echo ($tbl_product->IdType->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $tbl_product_add->RightColumnClass ?>"><div<?php echo $tbl_product->IdType->cellAttributes() ?>>
<span id="el_tbl_product_IdType">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="tbl_product" data-field="x_IdType" data-value-separator="<?php echo $tbl_product->IdType->displayValueSeparatorAttribute() ?>" id="x_IdType" name="x_IdType"<?php echo $tbl_product->IdType->editAttributes() ?>>
		<?php echo $tbl_product->IdType->selectOptionListHtml("x_IdType") ?>
	</select>
<?php if (AllowAdd(CurrentProjectID() . "tbl_producttype") && !$tbl_product->IdType->ReadOnly) { ?>
<div class="input-group-append"><button type="button" class="btn btn-default ew-add-opt-btn" id="aol_x_IdType" title="<?php echo HtmlTitle($Language->phrase("AddLink")) . "&nbsp;" . $tbl_product->IdType->caption() ?>" data-title="<?php echo $tbl_product->IdType->caption() ?>" onclick="ew.addOptionDialogShow({lnk:this,el:'x_IdType',url:'tbl_producttypeaddopt.php'});"><i class="fa fa-plus ew-icon"></i></button></div>
<?php } ?>
</div>
<?php echo $tbl_product->IdType->Lookup->getParamTag("p_x_IdType") ?>
</span>
<?php echo $tbl_product->IdType->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($tbl_product->Code->Visible) { // Code ?>
	<div id="r_Code" class="form-group row">
		<label id="elh_tbl_product_Code" for="x_Code" class="<?php echo $tbl_product_add->LeftColumnClass ?>"><?php echo $tbl_product->Code->caption() ?><?php echo ($tbl_product->Code->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $tbl_product_add->RightColumnClass ?>"><div<?php echo $tbl_product->Code->cellAttributes() ?>>
<span id="el_tbl_product_Code">
<input type="text" data-table="tbl_product" data-field="x_Code" name="x_Code" id="x_Code" size="15" maxlength="50" placeholder="<?php echo HtmlEncode($tbl_product->Code->getPlaceHolder()) ?>" value="<?php echo $tbl_product->Code->EditValue ?>"<?php echo $tbl_product->Code->editAttributes() ?>>
</span>
<?php echo $tbl_product->Code->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($tbl_product->Model->Visible) { // Model ?>
	<div id="r_Model" class="form-group row">
		<label id="elh_tbl_product_Model" for="x_Model" class="<?php echo $tbl_product_add->LeftColumnClass ?>"><?php echo $tbl_product->Model->caption() ?><?php echo ($tbl_product->Model->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $tbl_product_add->RightColumnClass ?>"><div<?php echo $tbl_product->Model->cellAttributes() ?>>
<span id="el_tbl_product_Model">
<input type="text" data-table="tbl_product" data-field="x_Model" name="x_Model" id="x_Model" size="15" maxlength="50" placeholder="<?php echo HtmlEncode($tbl_product->Model->getPlaceHolder()) ?>" value="<?php echo $tbl_product->Model->EditValue ?>"<?php echo $tbl_product->Model->editAttributes() ?>>
</span>
<?php echo $tbl_product->Model->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($tbl_product->ProductName->Visible) { // ProductName ?>
	<div id="r_ProductName" class="form-group row">
		<label id="elh_tbl_product_ProductName" for="x_ProductName" class="<?php echo $tbl_product_add->LeftColumnClass ?>"><?php echo $tbl_product->ProductName->caption() ?><?php echo ($tbl_product->ProductName->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $tbl_product_add->RightColumnClass ?>"><div<?php echo $tbl_product->ProductName->cellAttributes() ?>>
<span id="el_tbl_product_ProductName">
<input type="text" data-table="tbl_product" data-field="x_ProductName" name="x_ProductName" id="x_ProductName" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($tbl_product->ProductName->getPlaceHolder()) ?>" value="<?php echo $tbl_product->ProductName->EditValue ?>"<?php echo $tbl_product->ProductName->editAttributes() ?>>
</span>
<?php echo $tbl_product->ProductName->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($tbl_product->VnName->Visible) { // VnName ?>
	<div id="r_VnName" class="form-group row">
		<label id="elh_tbl_product_VnName" for="x_VnName" class="<?php echo $tbl_product_add->LeftColumnClass ?>"><?php echo $tbl_product->VnName->caption() ?><?php echo ($tbl_product->VnName->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $tbl_product_add->RightColumnClass ?>"><div<?php echo $tbl_product->VnName->cellAttributes() ?>>
<span id="el_tbl_product_VnName">
<input type="text" data-table="tbl_product" data-field="x_VnName" name="x_VnName" id="x_VnName" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($tbl_product->VnName->getPlaceHolder()) ?>" value="<?php echo $tbl_product->VnName->EditValue ?>"<?php echo $tbl_product->VnName->editAttributes() ?>>
</span>
<?php echo $tbl_product->VnName->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($tbl_product->ID_Contact->Visible) { // ID_Contact ?>
	<div id="r_ID_Contact" class="form-group row">
		<label id="elh_tbl_product_ID_Contact" class="<?php echo $tbl_product_add->LeftColumnClass ?>"><?php echo $tbl_product->ID_Contact->caption() ?><?php echo ($tbl_product->ID_Contact->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $tbl_product_add->RightColumnClass ?>"><div<?php echo $tbl_product->ID_Contact->cellAttributes() ?>>
<span id="el_tbl_product_ID_Contact">
<?php
$wrkonchange = "" . trim(@$tbl_product->ID_Contact->EditAttrs["onchange"]);
if (trim($wrkonchange) <> "") $wrkonchange = " onchange=\"" . JsEncode($wrkonchange) . "\"";
$tbl_product->ID_Contact->EditAttrs["onchange"] = "";
?>
<span id="as_x_ID_Contact" class="text-nowrap" style="z-index: 8940">
	<input type="text" class="form-control" name="sv_x_ID_Contact" id="sv_x_ID_Contact" value="<?php echo RemoveHtml($tbl_product->ID_Contact->EditValue) ?>" size="20" placeholder="<?php echo HtmlEncode($tbl_product->ID_Contact->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($tbl_product->ID_Contact->getPlaceHolder()) ?>"<?php echo $tbl_product->ID_Contact->editAttributes() ?>>
</span>
<input type="hidden" data-table="tbl_product" data-field="x_ID_Contact" data-value-separator="<?php echo $tbl_product->ID_Contact->displayValueSeparatorAttribute() ?>" name="x_ID_Contact" id="x_ID_Contact" value="<?php echo HtmlEncode($tbl_product->ID_Contact->CurrentValue) ?>"<?php echo $wrkonchange ?>>
<script>
ftbl_productadd.createAutoSuggest({"id":"x_ID_Contact","forceSelect":true});
</script>
<?php echo $tbl_product->ID_Contact->Lookup->getParamTag("p_x_ID_Contact") ?>
</span>
<?php echo $tbl_product->ID_Contact->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($tbl_product->Description->Visible) { // Description ?>
	<div id="r_Description" class="form-group row">
		<label id="elh_tbl_product_Description" for="x_Description" class="<?php echo $tbl_product_add->LeftColumnClass ?>"><?php echo $tbl_product->Description->caption() ?><?php echo ($tbl_product->Description->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $tbl_product_add->RightColumnClass ?>"><div<?php echo $tbl_product->Description->cellAttributes() ?>>
<span id="el_tbl_product_Description">
<input type="text" data-table="tbl_product" data-field="x_Description" name="x_Description" id="x_Description" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($tbl_product->Description->getPlaceHolder()) ?>" value="<?php echo $tbl_product->Description->EditValue ?>"<?php echo $tbl_product->Description->editAttributes() ?>>
</span>
<?php echo $tbl_product->Description->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($tbl_product->CreateDate->Visible) { // CreateDate ?>
	<div id="r_CreateDate" class="form-group row">
		<label id="elh_tbl_product_CreateDate" for="x_CreateDate" class="<?php echo $tbl_product_add->LeftColumnClass ?>"><?php echo $tbl_product->CreateDate->caption() ?><?php echo ($tbl_product->CreateDate->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $tbl_product_add->RightColumnClass ?>"><div<?php echo $tbl_product->CreateDate->cellAttributes() ?>>
<span id="el_tbl_product_CreateDate">
<input type="text" data-table="tbl_product" data-field="x_CreateDate" data-format="11" name="x_CreateDate" id="x_CreateDate" placeholder="<?php echo HtmlEncode($tbl_product->CreateDate->getPlaceHolder()) ?>" value="<?php echo $tbl_product->CreateDate->EditValue ?>"<?php echo $tbl_product->CreateDate->editAttributes() ?>>
<?php if (!$tbl_product->CreateDate->ReadOnly && !$tbl_product->CreateDate->Disabled && !isset($tbl_product->CreateDate->EditAttrs["readonly"]) && !isset($tbl_product->CreateDate->EditAttrs["disabled"])) { ?>
<script>
ew.createDateTimePicker("ftbl_productadd", "x_CreateDate", {"ignoreReadonly":true,"useCurrent":false,"format":11});
</script>
<?php } ?>
</span>
<?php echo $tbl_product->CreateDate->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($tbl_product->CreateUser->Visible) { // CreateUser ?>
	<div id="r_CreateUser" class="form-group row">
		<label id="elh_tbl_product_CreateUser" for="x_CreateUser" class="<?php echo $tbl_product_add->LeftColumnClass ?>"><?php echo $tbl_product->CreateUser->caption() ?><?php echo ($tbl_product->CreateUser->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $tbl_product_add->RightColumnClass ?>"><div<?php echo $tbl_product->CreateUser->cellAttributes() ?>>
<span id="el_tbl_product_CreateUser">
<input type="text" data-table="tbl_product" data-field="x_CreateUser" name="x_CreateUser" id="x_CreateUser" size="30" maxlength="50" placeholder="<?php echo HtmlEncode($tbl_product->CreateUser->getPlaceHolder()) ?>" value="<?php echo $tbl_product->CreateUser->EditValue ?>"<?php echo $tbl_product->CreateUser->editAttributes() ?>>
</span>
<?php echo $tbl_product->CreateUser->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php
	if (in_array("tbl_product_detail", explode(",", $tbl_product->getCurrentDetailTable())) && $tbl_product_detail->DetailAdd) {
?>
<?php if ($tbl_product->getCurrentDetailTable() <> "") { ?>
<h4 class="ew-detail-caption"><?php echo $Language->TablePhrase("tbl_product_detail", "TblCaption") ?></h4>
<?php } ?>
<?php include_once "tbl_product_detailgrid.php" ?>
<?php } ?>
<?php if (!$tbl_product_add->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $tbl_product_add->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("AddBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $tbl_product_add->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$tbl_product_add->showPageFooter();
if (DEBUG_ENABLED)
	echo GetDebugMessage();
?>
<script>

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php include_once "footer.php" ?>
<?php
$tbl_product_add->terminate();
?>