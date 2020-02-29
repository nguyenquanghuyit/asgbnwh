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
$tbl_inventory_add = new tbl_inventory_add();

// Run the page
$tbl_inventory_add->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$tbl_inventory_add->Page_Render();
?>
<?php include_once "header.php" ?>
<script>

// Form object
currentPageID = ew.PAGE_ID = "add";
var ftbl_inventoryadd = currentForm = new ew.Form("ftbl_inventoryadd", "add");

// Validate form
ftbl_inventoryadd.validate = function() {
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
		<?php if ($tbl_inventory_add->In_Year->Required) { ?>
			elm = this.getElements("x" + infix + "_In_Year");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $tbl_inventory->In_Year->caption(), $tbl_inventory->In_Year->RequiredErrorMessage)) ?>");
		<?php } ?>
			elm = this.getElements("x" + infix + "_In_Year");
			if (elm && !ew.checkInteger(elm.value))
				return this.onError(elm, "<?php echo JsEncode($tbl_inventory->In_Year->errorMessage()) ?>");
		<?php if ($tbl_inventory_add->In_Month->Required) { ?>
			elm = this.getElements("x" + infix + "_In_Month");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $tbl_inventory->In_Month->caption(), $tbl_inventory->In_Month->RequiredErrorMessage)) ?>");
		<?php } ?>
			elm = this.getElements("x" + infix + "_In_Month");
			if (elm && !ew.checkInteger(elm.value))
				return this.onError(elm, "<?php echo JsEncode($tbl_inventory->In_Month->errorMessage()) ?>");
		<?php if ($tbl_inventory_add->Code->Required) { ?>
			elm = this.getElements("x" + infix + "_Code");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $tbl_inventory->Code->caption(), $tbl_inventory->Code->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($tbl_inventory_add->ProductName->Required) { ?>
			elm = this.getElements("x" + infix + "_ProductName");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $tbl_inventory->ProductName->caption(), $tbl_inventory->ProductName->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($tbl_inventory_add->OpeningStock->Required) { ?>
			elm = this.getElements("x" + infix + "_OpeningStock");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $tbl_inventory->OpeningStock->caption(), $tbl_inventory->OpeningStock->RequiredErrorMessage)) ?>");
		<?php } ?>
			elm = this.getElements("x" + infix + "_OpeningStock");
			if (elm && !ew.checkInteger(elm.value))
				return this.onError(elm, "<?php echo JsEncode($tbl_inventory->OpeningStock->errorMessage()) ?>");
		<?php if ($tbl_inventory_add->PCS_IN->Required) { ?>
			elm = this.getElements("x" + infix + "_PCS_IN");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $tbl_inventory->PCS_IN->caption(), $tbl_inventory->PCS_IN->RequiredErrorMessage)) ?>");
		<?php } ?>
			elm = this.getElements("x" + infix + "_PCS_IN");
			if (elm && !ew.checkInteger(elm.value))
				return this.onError(elm, "<?php echo JsEncode($tbl_inventory->PCS_IN->errorMessage()) ?>");
		<?php if ($tbl_inventory_add->PCS_OUT->Required) { ?>
			elm = this.getElements("x" + infix + "_PCS_OUT");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $tbl_inventory->PCS_OUT->caption(), $tbl_inventory->PCS_OUT->RequiredErrorMessage)) ?>");
		<?php } ?>
			elm = this.getElements("x" + infix + "_PCS_OUT");
			if (elm && !ew.checkInteger(elm.value))
				return this.onError(elm, "<?php echo JsEncode($tbl_inventory->PCS_OUT->errorMessage()) ?>");
		<?php if ($tbl_inventory_add->ClosingStock->Required) { ?>
			elm = this.getElements("x" + infix + "_ClosingStock");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $tbl_inventory->ClosingStock->caption(), $tbl_inventory->ClosingStock->RequiredErrorMessage)) ?>");
		<?php } ?>
			elm = this.getElements("x" + infix + "_ClosingStock");
			if (elm && !ew.checkInteger(elm.value))
				return this.onError(elm, "<?php echo JsEncode($tbl_inventory->ClosingStock->errorMessage()) ?>");
		<?php if ($tbl_inventory_add->LockStock->Required) { ?>
			elm = this.getElements("x" + infix + "_LockStock");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $tbl_inventory->LockStock->caption(), $tbl_inventory->LockStock->RequiredErrorMessage)) ?>");
		<?php } ?>
			elm = this.getElements("x" + infix + "_LockStock");
			if (elm && !ew.checkInteger(elm.value))
				return this.onError(elm, "<?php echo JsEncode($tbl_inventory->LockStock->errorMessage()) ?>");

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
ftbl_inventoryadd.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

	// Your custom validation code here, return false if invalid.
	return true;
}

// Use JavaScript validation or not
ftbl_inventoryadd.validateRequired = <?php echo json_encode(CLIENT_VALIDATE) ?>;

// Dynamic selection lists
// Form object for search

</script>
<script>

// Write your client script here, no need to add script tags.
</script>
<?php $tbl_inventory_add->showPageHeader(); ?>
<?php
$tbl_inventory_add->showMessage();
?>
<form name="ftbl_inventoryadd" id="ftbl_inventoryadd" class="<?php echo $tbl_inventory_add->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($tbl_inventory_add->CheckToken) { ?>
<input type="hidden" name="<?php echo TOKEN_NAME ?>" value="<?php echo $tbl_inventory_add->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="tbl_inventory">
<input type="hidden" name="action" id="action" value="insert">
<input type="hidden" name="modal" value="<?php echo (int)$tbl_inventory_add->IsModal ?>">
<div class="ew-add-div"><!-- page* -->
<?php if ($tbl_inventory->In_Year->Visible) { // In_Year ?>
	<div id="r_In_Year" class="form-group row">
		<label id="elh_tbl_inventory_In_Year" for="x_In_Year" class="<?php echo $tbl_inventory_add->LeftColumnClass ?>"><?php echo $tbl_inventory->In_Year->caption() ?><?php echo ($tbl_inventory->In_Year->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $tbl_inventory_add->RightColumnClass ?>"><div<?php echo $tbl_inventory->In_Year->cellAttributes() ?>>
<span id="el_tbl_inventory_In_Year">
<input type="text" data-table="tbl_inventory" data-field="x_In_Year" name="x_In_Year" id="x_In_Year" size="30" placeholder="<?php echo HtmlEncode($tbl_inventory->In_Year->getPlaceHolder()) ?>" value="<?php echo $tbl_inventory->In_Year->EditValue ?>"<?php echo $tbl_inventory->In_Year->editAttributes() ?>>
</span>
<?php echo $tbl_inventory->In_Year->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($tbl_inventory->In_Month->Visible) { // In_Month ?>
	<div id="r_In_Month" class="form-group row">
		<label id="elh_tbl_inventory_In_Month" for="x_In_Month" class="<?php echo $tbl_inventory_add->LeftColumnClass ?>"><?php echo $tbl_inventory->In_Month->caption() ?><?php echo ($tbl_inventory->In_Month->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $tbl_inventory_add->RightColumnClass ?>"><div<?php echo $tbl_inventory->In_Month->cellAttributes() ?>>
<span id="el_tbl_inventory_In_Month">
<input type="text" data-table="tbl_inventory" data-field="x_In_Month" name="x_In_Month" id="x_In_Month" size="30" placeholder="<?php echo HtmlEncode($tbl_inventory->In_Month->getPlaceHolder()) ?>" value="<?php echo $tbl_inventory->In_Month->EditValue ?>"<?php echo $tbl_inventory->In_Month->editAttributes() ?>>
</span>
<?php echo $tbl_inventory->In_Month->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($tbl_inventory->Code->Visible) { // Code ?>
	<div id="r_Code" class="form-group row">
		<label id="elh_tbl_inventory_Code" for="x_Code" class="<?php echo $tbl_inventory_add->LeftColumnClass ?>"><?php echo $tbl_inventory->Code->caption() ?><?php echo ($tbl_inventory->Code->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $tbl_inventory_add->RightColumnClass ?>"><div<?php echo $tbl_inventory->Code->cellAttributes() ?>>
<span id="el_tbl_inventory_Code">
<input type="text" data-table="tbl_inventory" data-field="x_Code" name="x_Code" id="x_Code" size="30" maxlength="50" placeholder="<?php echo HtmlEncode($tbl_inventory->Code->getPlaceHolder()) ?>" value="<?php echo $tbl_inventory->Code->EditValue ?>"<?php echo $tbl_inventory->Code->editAttributes() ?>>
</span>
<?php echo $tbl_inventory->Code->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($tbl_inventory->ProductName->Visible) { // ProductName ?>
	<div id="r_ProductName" class="form-group row">
		<label id="elh_tbl_inventory_ProductName" for="x_ProductName" class="<?php echo $tbl_inventory_add->LeftColumnClass ?>"><?php echo $tbl_inventory->ProductName->caption() ?><?php echo ($tbl_inventory->ProductName->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $tbl_inventory_add->RightColumnClass ?>"><div<?php echo $tbl_inventory->ProductName->cellAttributes() ?>>
<span id="el_tbl_inventory_ProductName">
<input type="text" data-table="tbl_inventory" data-field="x_ProductName" name="x_ProductName" id="x_ProductName" size="30" maxlength="250" placeholder="<?php echo HtmlEncode($tbl_inventory->ProductName->getPlaceHolder()) ?>" value="<?php echo $tbl_inventory->ProductName->EditValue ?>"<?php echo $tbl_inventory->ProductName->editAttributes() ?>>
</span>
<?php echo $tbl_inventory->ProductName->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($tbl_inventory->OpeningStock->Visible) { // OpeningStock ?>
	<div id="r_OpeningStock" class="form-group row">
		<label id="elh_tbl_inventory_OpeningStock" for="x_OpeningStock" class="<?php echo $tbl_inventory_add->LeftColumnClass ?>"><?php echo $tbl_inventory->OpeningStock->caption() ?><?php echo ($tbl_inventory->OpeningStock->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $tbl_inventory_add->RightColumnClass ?>"><div<?php echo $tbl_inventory->OpeningStock->cellAttributes() ?>>
<span id="el_tbl_inventory_OpeningStock">
<input type="text" data-table="tbl_inventory" data-field="x_OpeningStock" name="x_OpeningStock" id="x_OpeningStock" size="30" placeholder="<?php echo HtmlEncode($tbl_inventory->OpeningStock->getPlaceHolder()) ?>" value="<?php echo $tbl_inventory->OpeningStock->EditValue ?>"<?php echo $tbl_inventory->OpeningStock->editAttributes() ?>>
</span>
<?php echo $tbl_inventory->OpeningStock->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($tbl_inventory->PCS_IN->Visible) { // PCS_IN ?>
	<div id="r_PCS_IN" class="form-group row">
		<label id="elh_tbl_inventory_PCS_IN" for="x_PCS_IN" class="<?php echo $tbl_inventory_add->LeftColumnClass ?>"><?php echo $tbl_inventory->PCS_IN->caption() ?><?php echo ($tbl_inventory->PCS_IN->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $tbl_inventory_add->RightColumnClass ?>"><div<?php echo $tbl_inventory->PCS_IN->cellAttributes() ?>>
<span id="el_tbl_inventory_PCS_IN">
<input type="text" data-table="tbl_inventory" data-field="x_PCS_IN" name="x_PCS_IN" id="x_PCS_IN" size="30" placeholder="<?php echo HtmlEncode($tbl_inventory->PCS_IN->getPlaceHolder()) ?>" value="<?php echo $tbl_inventory->PCS_IN->EditValue ?>"<?php echo $tbl_inventory->PCS_IN->editAttributes() ?>>
</span>
<?php echo $tbl_inventory->PCS_IN->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($tbl_inventory->PCS_OUT->Visible) { // PCS_OUT ?>
	<div id="r_PCS_OUT" class="form-group row">
		<label id="elh_tbl_inventory_PCS_OUT" for="x_PCS_OUT" class="<?php echo $tbl_inventory_add->LeftColumnClass ?>"><?php echo $tbl_inventory->PCS_OUT->caption() ?><?php echo ($tbl_inventory->PCS_OUT->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $tbl_inventory_add->RightColumnClass ?>"><div<?php echo $tbl_inventory->PCS_OUT->cellAttributes() ?>>
<span id="el_tbl_inventory_PCS_OUT">
<input type="text" data-table="tbl_inventory" data-field="x_PCS_OUT" name="x_PCS_OUT" id="x_PCS_OUT" size="30" placeholder="<?php echo HtmlEncode($tbl_inventory->PCS_OUT->getPlaceHolder()) ?>" value="<?php echo $tbl_inventory->PCS_OUT->EditValue ?>"<?php echo $tbl_inventory->PCS_OUT->editAttributes() ?>>
</span>
<?php echo $tbl_inventory->PCS_OUT->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($tbl_inventory->ClosingStock->Visible) { // ClosingStock ?>
	<div id="r_ClosingStock" class="form-group row">
		<label id="elh_tbl_inventory_ClosingStock" for="x_ClosingStock" class="<?php echo $tbl_inventory_add->LeftColumnClass ?>"><?php echo $tbl_inventory->ClosingStock->caption() ?><?php echo ($tbl_inventory->ClosingStock->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $tbl_inventory_add->RightColumnClass ?>"><div<?php echo $tbl_inventory->ClosingStock->cellAttributes() ?>>
<span id="el_tbl_inventory_ClosingStock">
<input type="text" data-table="tbl_inventory" data-field="x_ClosingStock" name="x_ClosingStock" id="x_ClosingStock" size="30" placeholder="<?php echo HtmlEncode($tbl_inventory->ClosingStock->getPlaceHolder()) ?>" value="<?php echo $tbl_inventory->ClosingStock->EditValue ?>"<?php echo $tbl_inventory->ClosingStock->editAttributes() ?>>
</span>
<?php echo $tbl_inventory->ClosingStock->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($tbl_inventory->LockStock->Visible) { // LockStock ?>
	<div id="r_LockStock" class="form-group row">
		<label id="elh_tbl_inventory_LockStock" for="x_LockStock" class="<?php echo $tbl_inventory_add->LeftColumnClass ?>"><?php echo $tbl_inventory->LockStock->caption() ?><?php echo ($tbl_inventory->LockStock->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $tbl_inventory_add->RightColumnClass ?>"><div<?php echo $tbl_inventory->LockStock->cellAttributes() ?>>
<span id="el_tbl_inventory_LockStock">
<input type="text" data-table="tbl_inventory" data-field="x_LockStock" name="x_LockStock" id="x_LockStock" size="30" placeholder="<?php echo HtmlEncode($tbl_inventory->LockStock->getPlaceHolder()) ?>" value="<?php echo $tbl_inventory->LockStock->EditValue ?>"<?php echo $tbl_inventory->LockStock->editAttributes() ?>>
</span>
<?php echo $tbl_inventory->LockStock->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$tbl_inventory_add->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $tbl_inventory_add->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("AddBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $tbl_inventory_add->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$tbl_inventory_add->showPageFooter();
if (DEBUG_ENABLED)
	echo GetDebugMessage();
?>
<script>

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php include_once "footer.php" ?>
<?php
$tbl_inventory_add->terminate();
?>