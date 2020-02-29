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
$tbl_product_detail_edit = new tbl_product_detail_edit();

// Run the page
$tbl_product_detail_edit->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$tbl_product_detail_edit->Page_Render();
?>
<?php include_once "header.php" ?>
<script>

// Form object
currentPageID = ew.PAGE_ID = "edit";
var ftbl_product_detailedit = currentForm = new ew.Form("ftbl_product_detailedit", "edit");

// Validate form
ftbl_product_detailedit.validate = function() {
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
		<?php if ($tbl_product_detail_edit->CODE->Required) { ?>
			elm = this.getElements("x" + infix + "_CODE");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $tbl_product_detail->CODE->caption(), $tbl_product_detail->CODE->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($tbl_product_detail_edit->PackingQty->Required) { ?>
			elm = this.getElements("x" + infix + "_PackingQty");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $tbl_product_detail->PackingQty->caption(), $tbl_product_detail->PackingQty->RequiredErrorMessage)) ?>");
		<?php } ?>
			elm = this.getElements("x" + infix + "_PackingQty");
			if (elm && !ew.checkInteger(elm.value))
				return this.onError(elm, "<?php echo JsEncode($tbl_product_detail->PackingQty->errorMessage()) ?>");
		<?php if ($tbl_product_detail_edit->IdUnit->Required) { ?>
			elm = this.getElements("x" + infix + "_IdUnit");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $tbl_product_detail->IdUnit->caption(), $tbl_product_detail->IdUnit->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($tbl_product_detail_edit->DefaultCode->Required) { ?>
			elm = this.getElements("x" + infix + "_DefaultCode");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $tbl_product_detail->DefaultCode->caption(), $tbl_product_detail->DefaultCode->RequiredErrorMessage)) ?>");
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
ftbl_product_detailedit.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

	// Your custom validation code here, return false if invalid.
	return true;
}

// Use JavaScript validation or not
ftbl_product_detailedit.validateRequired = <?php echo json_encode(CLIENT_VALIDATE) ?>;

// Dynamic selection lists
ftbl_product_detailedit.lists["x_IdUnit"] = <?php echo $tbl_product_detail_edit->IdUnit->Lookup->toClientList() ?>;
ftbl_product_detailedit.lists["x_IdUnit"].options = <?php echo JsonEncode($tbl_product_detail_edit->IdUnit->lookupOptions()) ?>;
ftbl_product_detailedit.lists["x_DefaultCode"] = <?php echo $tbl_product_detail_edit->DefaultCode->Lookup->toClientList() ?>;
ftbl_product_detailedit.lists["x_DefaultCode"].options = <?php echo JsonEncode($tbl_product_detail_edit->DefaultCode->options(FALSE, TRUE)) ?>;

// Form object for search
</script>
<script>

// Write your client script here, no need to add script tags.
</script>
<?php $tbl_product_detail_edit->showPageHeader(); ?>
<?php
$tbl_product_detail_edit->showMessage();
?>
<form name="ftbl_product_detailedit" id="ftbl_product_detailedit" class="<?php echo $tbl_product_detail_edit->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($tbl_product_detail_edit->CheckToken) { ?>
<input type="hidden" name="<?php echo TOKEN_NAME ?>" value="<?php echo $tbl_product_detail_edit->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="tbl_product_detail">
<input type="hidden" name="action" id="action" value="update">
<input type="hidden" name="modal" value="<?php echo (int)$tbl_product_detail_edit->IsModal ?>">
<?php if ($tbl_product_detail->getCurrentMasterTable() == "tbl_product") { ?>
<input type="hidden" name="<?php echo TABLE_SHOW_MASTER ?>" value="tbl_product">
<input type="hidden" name="fk_Code" value="<?php echo $tbl_product_detail->CODE->getSessionValue() ?>">
<?php } ?>
<div class="ew-edit-div"><!-- page* -->
<?php if ($tbl_product_detail->CODE->Visible) { // CODE ?>
	<div id="r_CODE" class="form-group row">
		<label id="elh_tbl_product_detail_CODE" for="x_CODE" class="<?php echo $tbl_product_detail_edit->LeftColumnClass ?>"><?php echo $tbl_product_detail->CODE->caption() ?><?php echo ($tbl_product_detail->CODE->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $tbl_product_detail_edit->RightColumnClass ?>"><div<?php echo $tbl_product_detail->CODE->cellAttributes() ?>>
<?php if ($tbl_product_detail->CODE->getSessionValue() <> "") { ?>
<span id="el_tbl_product_detail_CODE">
<span<?php echo $tbl_product_detail->CODE->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?php echo RemoveHtml($tbl_product_detail->CODE->ViewValue) ?>"></span>
</span>
<input type="hidden" id="x_CODE" name="x_CODE" value="<?php echo HtmlEncode($tbl_product_detail->CODE->CurrentValue) ?>">
<?php } else { ?>
<span id="el_tbl_product_detail_CODE">
<input type="text" data-table="tbl_product_detail" data-field="x_CODE" name="x_CODE" id="x_CODE" size="30" maxlength="50" placeholder="<?php echo HtmlEncode($tbl_product_detail->CODE->getPlaceHolder()) ?>" value="<?php echo $tbl_product_detail->CODE->EditValue ?>"<?php echo $tbl_product_detail->CODE->editAttributes() ?>>
</span>
<?php } ?>
<?php echo $tbl_product_detail->CODE->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($tbl_product_detail->PackingQty->Visible) { // PackingQty ?>
	<div id="r_PackingQty" class="form-group row">
		<label id="elh_tbl_product_detail_PackingQty" for="x_PackingQty" class="<?php echo $tbl_product_detail_edit->LeftColumnClass ?>"><?php echo $tbl_product_detail->PackingQty->caption() ?><?php echo ($tbl_product_detail->PackingQty->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $tbl_product_detail_edit->RightColumnClass ?>"><div<?php echo $tbl_product_detail->PackingQty->cellAttributes() ?>>
<span id="el_tbl_product_detail_PackingQty">
<input type="text" data-table="tbl_product_detail" data-field="x_PackingQty" name="x_PackingQty" id="x_PackingQty" size="30" placeholder="<?php echo HtmlEncode($tbl_product_detail->PackingQty->getPlaceHolder()) ?>" value="<?php echo $tbl_product_detail->PackingQty->EditValue ?>"<?php echo $tbl_product_detail->PackingQty->editAttributes() ?>>
</span>
<?php echo $tbl_product_detail->PackingQty->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($tbl_product_detail->IdUnit->Visible) { // IdUnit ?>
	<div id="r_IdUnit" class="form-group row">
		<label id="elh_tbl_product_detail_IdUnit" for="x_IdUnit" class="<?php echo $tbl_product_detail_edit->LeftColumnClass ?>"><?php echo $tbl_product_detail->IdUnit->caption() ?><?php echo ($tbl_product_detail->IdUnit->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $tbl_product_detail_edit->RightColumnClass ?>"><div<?php echo $tbl_product_detail->IdUnit->cellAttributes() ?>>
<span id="el_tbl_product_detail_IdUnit">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="tbl_product_detail" data-field="x_IdUnit" data-value-separator="<?php echo $tbl_product_detail->IdUnit->displayValueSeparatorAttribute() ?>" id="x_IdUnit" name="x_IdUnit"<?php echo $tbl_product_detail->IdUnit->editAttributes() ?>>
		<?php echo $tbl_product_detail->IdUnit->selectOptionListHtml("x_IdUnit") ?>
	</select>
</div>
<?php echo $tbl_product_detail->IdUnit->Lookup->getParamTag("p_x_IdUnit") ?>
</span>
<?php echo $tbl_product_detail->IdUnit->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($tbl_product_detail->DefaultCode->Visible) { // DefaultCode ?>
	<div id="r_DefaultCode" class="form-group row">
		<label id="elh_tbl_product_detail_DefaultCode" class="<?php echo $tbl_product_detail_edit->LeftColumnClass ?>"><?php echo $tbl_product_detail->DefaultCode->caption() ?><?php echo ($tbl_product_detail->DefaultCode->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $tbl_product_detail_edit->RightColumnClass ?>"><div<?php echo $tbl_product_detail->DefaultCode->cellAttributes() ?>>
<span id="el_tbl_product_detail_DefaultCode">
<div id="tp_x_DefaultCode" class="ew-template"><input type="radio" class="form-check-input" data-table="tbl_product_detail" data-field="x_DefaultCode" data-value-separator="<?php echo $tbl_product_detail->DefaultCode->displayValueSeparatorAttribute() ?>" name="x_DefaultCode" id="x_DefaultCode" value="{value}"<?php echo $tbl_product_detail->DefaultCode->editAttributes() ?>></div>
<div id="dsl_x_DefaultCode" data-repeatcolumn="5" class="ew-item-list d-none"><div>
<?php echo $tbl_product_detail->DefaultCode->radioButtonListHtml(FALSE, "x_DefaultCode") ?>
</div></div>
</span>
<?php echo $tbl_product_detail->DefaultCode->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
	<input type="hidden" data-table="tbl_product_detail" data-field="x_IdCode" name="x_IdCode" id="x_IdCode" value="<?php echo HtmlEncode($tbl_product_detail->IdCode->CurrentValue) ?>">
<?php if (!$tbl_product_detail_edit->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $tbl_product_detail_edit->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("SaveBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $tbl_product_detail_edit->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$tbl_product_detail_edit->showPageFooter();
if (DEBUG_ENABLED)
	echo GetDebugMessage();
?>
<script>

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php include_once "footer.php" ?>
<?php
$tbl_product_detail_edit->terminate();
?>