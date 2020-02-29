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
$tbl_product_edit = new tbl_product_edit();

// Run the page
$tbl_product_edit->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$tbl_product_edit->Page_Render();
?>
<?php include_once "header.php" ?>
<script>

// Form object
currentPageID = ew.PAGE_ID = "edit";
var ftbl_productedit = currentForm = new ew.Form("ftbl_productedit", "edit");

// Validate form
ftbl_productedit.validate = function() {
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
		<?php if ($tbl_product_edit->Code->Required) { ?>
			elm = this.getElements("x" + infix + "_Code");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $tbl_product->Code->caption(), $tbl_product->Code->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($tbl_product_edit->Model->Required) { ?>
			elm = this.getElements("x" + infix + "_Model");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $tbl_product->Model->caption(), $tbl_product->Model->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($tbl_product_edit->ProductName->Required) { ?>
			elm = this.getElements("x" + infix + "_ProductName");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $tbl_product->ProductName->caption(), $tbl_product->ProductName->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($tbl_product_edit->VnName->Required) { ?>
			elm = this.getElements("x" + infix + "_VnName");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $tbl_product->VnName->caption(), $tbl_product->VnName->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($tbl_product_edit->Description->Required) { ?>
			elm = this.getElements("x" + infix + "_Description");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $tbl_product->Description->caption(), $tbl_product->Description->RequiredErrorMessage)) ?>");
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
ftbl_productedit.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

	// Your custom validation code here, return false if invalid.
	return true;
}

// Use JavaScript validation or not
ftbl_productedit.validateRequired = <?php echo json_encode(CLIENT_VALIDATE) ?>;

// Dynamic selection lists
// Form object for search

</script>
<script>

// Write your client script here, no need to add script tags.
</script>
<?php $tbl_product_edit->showPageHeader(); ?>
<?php
$tbl_product_edit->showMessage();
?>
<form name="ftbl_productedit" id="ftbl_productedit" class="<?php echo $tbl_product_edit->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($tbl_product_edit->CheckToken) { ?>
<input type="hidden" name="<?php echo TOKEN_NAME ?>" value="<?php echo $tbl_product_edit->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="tbl_product">
<input type="hidden" name="action" id="action" value="update">
<input type="hidden" name="modal" value="<?php echo (int)$tbl_product_edit->IsModal ?>">
<div class="ew-edit-div"><!-- page* -->
<?php if ($tbl_product->Code->Visible) { // Code ?>
	<div id="r_Code" class="form-group row">
		<label id="elh_tbl_product_Code" for="x_Code" class="<?php echo $tbl_product_edit->LeftColumnClass ?>"><?php echo $tbl_product->Code->caption() ?><?php echo ($tbl_product->Code->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $tbl_product_edit->RightColumnClass ?>"><div<?php echo $tbl_product->Code->cellAttributes() ?>>
<span id="el_tbl_product_Code">
<span<?php echo $tbl_product->Code->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?php echo RemoveHtml($tbl_product->Code->EditValue) ?>"></span>
</span>
<input type="hidden" data-table="tbl_product" data-field="x_Code" name="x_Code" id="x_Code" value="<?php echo HtmlEncode($tbl_product->Code->CurrentValue) ?>">
<?php echo $tbl_product->Code->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($tbl_product->Model->Visible) { // Model ?>
	<div id="r_Model" class="form-group row">
		<label id="elh_tbl_product_Model" for="x_Model" class="<?php echo $tbl_product_edit->LeftColumnClass ?>"><?php echo $tbl_product->Model->caption() ?><?php echo ($tbl_product->Model->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $tbl_product_edit->RightColumnClass ?>"><div<?php echo $tbl_product->Model->cellAttributes() ?>>
<span id="el_tbl_product_Model">
<input type="text" data-table="tbl_product" data-field="x_Model" name="x_Model" id="x_Model" size="30" maxlength="50" placeholder="<?php echo HtmlEncode($tbl_product->Model->getPlaceHolder()) ?>" value="<?php echo $tbl_product->Model->EditValue ?>"<?php echo $tbl_product->Model->editAttributes() ?>>
</span>
<?php echo $tbl_product->Model->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($tbl_product->ProductName->Visible) { // ProductName ?>
	<div id="r_ProductName" class="form-group row">
		<label id="elh_tbl_product_ProductName" for="x_ProductName" class="<?php echo $tbl_product_edit->LeftColumnClass ?>"><?php echo $tbl_product->ProductName->caption() ?><?php echo ($tbl_product->ProductName->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $tbl_product_edit->RightColumnClass ?>"><div<?php echo $tbl_product->ProductName->cellAttributes() ?>>
<span id="el_tbl_product_ProductName">
<input type="text" data-table="tbl_product" data-field="x_ProductName" name="x_ProductName" id="x_ProductName" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($tbl_product->ProductName->getPlaceHolder()) ?>" value="<?php echo $tbl_product->ProductName->EditValue ?>"<?php echo $tbl_product->ProductName->editAttributes() ?>>
</span>
<?php echo $tbl_product->ProductName->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($tbl_product->VnName->Visible) { // VnName ?>
	<div id="r_VnName" class="form-group row">
		<label id="elh_tbl_product_VnName" for="x_VnName" class="<?php echo $tbl_product_edit->LeftColumnClass ?>"><?php echo $tbl_product->VnName->caption() ?><?php echo ($tbl_product->VnName->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $tbl_product_edit->RightColumnClass ?>"><div<?php echo $tbl_product->VnName->cellAttributes() ?>>
<span id="el_tbl_product_VnName">
<input type="text" data-table="tbl_product" data-field="x_VnName" name="x_VnName" id="x_VnName" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($tbl_product->VnName->getPlaceHolder()) ?>" value="<?php echo $tbl_product->VnName->EditValue ?>"<?php echo $tbl_product->VnName->editAttributes() ?>>
</span>
<?php echo $tbl_product->VnName->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($tbl_product->Description->Visible) { // Description ?>
	<div id="r_Description" class="form-group row">
		<label id="elh_tbl_product_Description" for="x_Description" class="<?php echo $tbl_product_edit->LeftColumnClass ?>"><?php echo $tbl_product->Description->caption() ?><?php echo ($tbl_product->Description->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $tbl_product_edit->RightColumnClass ?>"><div<?php echo $tbl_product->Description->cellAttributes() ?>>
<span id="el_tbl_product_Description">
<input type="text" data-table="tbl_product" data-field="x_Description" name="x_Description" id="x_Description" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($tbl_product->Description->getPlaceHolder()) ?>" value="<?php echo $tbl_product->Description->EditValue ?>"<?php echo $tbl_product->Description->editAttributes() ?>>
</span>
<?php echo $tbl_product->Description->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$tbl_product_edit->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $tbl_product_edit->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("SaveBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $tbl_product_edit->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$tbl_product_edit->showPageFooter();
if (DEBUG_ENABLED)
	echo GetDebugMessage();
?>
<script>

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php include_once "footer.php" ?>
<?php
$tbl_product_edit->terminate();
?>