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
$tbl_order_po_inv_edit = new tbl_order_po_inv_edit();

// Run the page
$tbl_order_po_inv_edit->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$tbl_order_po_inv_edit->Page_Render();
?>
<?php include_once "header.php" ?>
<script>

// Form object
currentPageID = ew.PAGE_ID = "edit";
var ftbl_order_po_invedit = currentForm = new ew.Form("ftbl_order_po_invedit", "edit");

// Validate form
ftbl_order_po_invedit.validate = function() {
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
		<?php if ($tbl_order_po_inv_edit->OrderNo->Required) { ?>
			elm = this.getElements("x" + infix + "_OrderNo");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $tbl_order_po_inv->OrderNo->caption(), $tbl_order_po_inv->OrderNo->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($tbl_order_po_inv_edit->Code->Required) { ?>
			elm = this.getElements("x" + infix + "_Code");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $tbl_order_po_inv->Code->caption(), $tbl_order_po_inv->Code->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($tbl_order_po_inv_edit->PalletNo->Required) { ?>
			elm = this.getElements("x" + infix + "_PalletNo");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $tbl_order_po_inv->PalletNo->caption(), $tbl_order_po_inv->PalletNo->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($tbl_order_po_inv_edit->DateIn->Required) { ?>
			elm = this.getElements("x" + infix + "_DateIn");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $tbl_order_po_inv->DateIn->caption(), $tbl_order_po_inv->DateIn->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($tbl_order_po_inv_edit->PCS_In->Required) { ?>
			elm = this.getElements("x" + infix + "_PCS_In");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $tbl_order_po_inv->PCS_In->caption(), $tbl_order_po_inv->PCS_In->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($tbl_order_po_inv_edit->PCS_Out->Required) { ?>
			elm = this.getElements("x" + infix + "_PCS_Out");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $tbl_order_po_inv->PCS_Out->caption(), $tbl_order_po_inv->PCS_Out->RequiredErrorMessage)) ?>");
		<?php } ?>
			elm = this.getElements("x" + infix + "_PCS_Out");
			if (elm && !ew.checkInteger(elm.value))
				return this.onError(elm, "<?php echo JsEncode($tbl_order_po_inv->PCS_Out->errorMessage()) ?>");
		<?php if ($tbl_order_po_inv_edit->PO_No->Required) { ?>
			elm = this.getElements("x" + infix + "_PO_No");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $tbl_order_po_inv->PO_No->caption(), $tbl_order_po_inv->PO_No->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($tbl_order_po_inv_edit->INV_No->Required) { ?>
			elm = this.getElements("x" + infix + "_INV_No");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $tbl_order_po_inv->INV_No->caption(), $tbl_order_po_inv->INV_No->RequiredErrorMessage)) ?>");
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
ftbl_order_po_invedit.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

	// Your custom validation code here, return false if invalid.
	return true;
}

// Use JavaScript validation or not
ftbl_order_po_invedit.validateRequired = <?php echo json_encode(CLIENT_VALIDATE) ?>;

// Dynamic selection lists
// Form object for search

</script>
<script>

// Write your client script here, no need to add script tags.
</script>
<?php $tbl_order_po_inv_edit->showPageHeader(); ?>
<?php
$tbl_order_po_inv_edit->showMessage();
?>
<form name="ftbl_order_po_invedit" id="ftbl_order_po_invedit" class="<?php echo $tbl_order_po_inv_edit->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($tbl_order_po_inv_edit->CheckToken) { ?>
<input type="hidden" name="<?php echo TOKEN_NAME ?>" value="<?php echo $tbl_order_po_inv_edit->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="tbl_order_po_inv">
<input type="hidden" name="action" id="action" value="update">
<input type="hidden" name="modal" value="<?php echo (int)$tbl_order_po_inv_edit->IsModal ?>">
<div class="ew-edit-div"><!-- page* -->
<?php if ($tbl_order_po_inv->OrderNo->Visible) { // OrderNo ?>
	<div id="r_OrderNo" class="form-group row">
		<label id="elh_tbl_order_po_inv_OrderNo" for="x_OrderNo" class="<?php echo $tbl_order_po_inv_edit->LeftColumnClass ?>"><?php echo $tbl_order_po_inv->OrderNo->caption() ?><?php echo ($tbl_order_po_inv->OrderNo->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $tbl_order_po_inv_edit->RightColumnClass ?>"><div<?php echo $tbl_order_po_inv->OrderNo->cellAttributes() ?>>
<span id="el_tbl_order_po_inv_OrderNo">
<span<?php echo $tbl_order_po_inv->OrderNo->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?php echo RemoveHtml($tbl_order_po_inv->OrderNo->EditValue) ?>"></span>
</span>
<input type="hidden" data-table="tbl_order_po_inv" data-field="x_OrderNo" name="x_OrderNo" id="x_OrderNo" value="<?php echo HtmlEncode($tbl_order_po_inv->OrderNo->CurrentValue) ?>">
<?php echo $tbl_order_po_inv->OrderNo->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($tbl_order_po_inv->Code->Visible) { // Code ?>
	<div id="r_Code" class="form-group row">
		<label id="elh_tbl_order_po_inv_Code" for="x_Code" class="<?php echo $tbl_order_po_inv_edit->LeftColumnClass ?>"><?php echo $tbl_order_po_inv->Code->caption() ?><?php echo ($tbl_order_po_inv->Code->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $tbl_order_po_inv_edit->RightColumnClass ?>"><div<?php echo $tbl_order_po_inv->Code->cellAttributes() ?>>
<span id="el_tbl_order_po_inv_Code">
<span<?php echo $tbl_order_po_inv->Code->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?php echo RemoveHtml($tbl_order_po_inv->Code->EditValue) ?>"></span>
</span>
<input type="hidden" data-table="tbl_order_po_inv" data-field="x_Code" name="x_Code" id="x_Code" value="<?php echo HtmlEncode($tbl_order_po_inv->Code->CurrentValue) ?>">
<?php echo $tbl_order_po_inv->Code->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($tbl_order_po_inv->PalletNo->Visible) { // PalletNo ?>
	<div id="r_PalletNo" class="form-group row">
		<label id="elh_tbl_order_po_inv_PalletNo" for="x_PalletNo" class="<?php echo $tbl_order_po_inv_edit->LeftColumnClass ?>"><?php echo $tbl_order_po_inv->PalletNo->caption() ?><?php echo ($tbl_order_po_inv->PalletNo->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $tbl_order_po_inv_edit->RightColumnClass ?>"><div<?php echo $tbl_order_po_inv->PalletNo->cellAttributes() ?>>
<span id="el_tbl_order_po_inv_PalletNo">
<span<?php echo $tbl_order_po_inv->PalletNo->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?php echo RemoveHtml($tbl_order_po_inv->PalletNo->EditValue) ?>"></span>
</span>
<input type="hidden" data-table="tbl_order_po_inv" data-field="x_PalletNo" name="x_PalletNo" id="x_PalletNo" value="<?php echo HtmlEncode($tbl_order_po_inv->PalletNo->CurrentValue) ?>">
<?php echo $tbl_order_po_inv->PalletNo->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($tbl_order_po_inv->DateIn->Visible) { // DateIn ?>
	<div id="r_DateIn" class="form-group row">
		<label id="elh_tbl_order_po_inv_DateIn" for="x_DateIn" class="<?php echo $tbl_order_po_inv_edit->LeftColumnClass ?>"><?php echo $tbl_order_po_inv->DateIn->caption() ?><?php echo ($tbl_order_po_inv->DateIn->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $tbl_order_po_inv_edit->RightColumnClass ?>"><div<?php echo $tbl_order_po_inv->DateIn->cellAttributes() ?>>
<span id="el_tbl_order_po_inv_DateIn">
<span<?php echo $tbl_order_po_inv->DateIn->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?php echo RemoveHtml($tbl_order_po_inv->DateIn->EditValue) ?>"></span>
</span>
<input type="hidden" data-table="tbl_order_po_inv" data-field="x_DateIn" name="x_DateIn" id="x_DateIn" value="<?php echo HtmlEncode($tbl_order_po_inv->DateIn->CurrentValue) ?>">
<?php echo $tbl_order_po_inv->DateIn->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($tbl_order_po_inv->PCS_In->Visible) { // PCS_In ?>
	<div id="r_PCS_In" class="form-group row">
		<label id="elh_tbl_order_po_inv_PCS_In" for="x_PCS_In" class="<?php echo $tbl_order_po_inv_edit->LeftColumnClass ?>"><?php echo $tbl_order_po_inv->PCS_In->caption() ?><?php echo ($tbl_order_po_inv->PCS_In->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $tbl_order_po_inv_edit->RightColumnClass ?>"><div<?php echo $tbl_order_po_inv->PCS_In->cellAttributes() ?>>
<span id="el_tbl_order_po_inv_PCS_In">
<span<?php echo $tbl_order_po_inv->PCS_In->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?php echo RemoveHtml($tbl_order_po_inv->PCS_In->EditValue) ?>"></span>
</span>
<input type="hidden" data-table="tbl_order_po_inv" data-field="x_PCS_In" name="x_PCS_In" id="x_PCS_In" value="<?php echo HtmlEncode($tbl_order_po_inv->PCS_In->CurrentValue) ?>">
<?php echo $tbl_order_po_inv->PCS_In->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($tbl_order_po_inv->PCS_Out->Visible) { // PCS_Out ?>
	<div id="r_PCS_Out" class="form-group row">
		<label id="elh_tbl_order_po_inv_PCS_Out" for="x_PCS_Out" class="<?php echo $tbl_order_po_inv_edit->LeftColumnClass ?>"><?php echo $tbl_order_po_inv->PCS_Out->caption() ?><?php echo ($tbl_order_po_inv->PCS_Out->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $tbl_order_po_inv_edit->RightColumnClass ?>"><div<?php echo $tbl_order_po_inv->PCS_Out->cellAttributes() ?>>
<span id="el_tbl_order_po_inv_PCS_Out">
<input type="text" data-table="tbl_order_po_inv" data-field="x_PCS_Out" name="x_PCS_Out" id="x_PCS_Out" size="5" placeholder="<?php echo HtmlEncode($tbl_order_po_inv->PCS_Out->getPlaceHolder()) ?>" value="<?php echo $tbl_order_po_inv->PCS_Out->EditValue ?>"<?php echo $tbl_order_po_inv->PCS_Out->editAttributes() ?>>
</span>
<?php echo $tbl_order_po_inv->PCS_Out->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($tbl_order_po_inv->PO_No->Visible) { // PO_No ?>
	<div id="r_PO_No" class="form-group row">
		<label id="elh_tbl_order_po_inv_PO_No" for="x_PO_No" class="<?php echo $tbl_order_po_inv_edit->LeftColumnClass ?>"><?php echo $tbl_order_po_inv->PO_No->caption() ?><?php echo ($tbl_order_po_inv->PO_No->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $tbl_order_po_inv_edit->RightColumnClass ?>"><div<?php echo $tbl_order_po_inv->PO_No->cellAttributes() ?>>
<span id="el_tbl_order_po_inv_PO_No">
<input type="text" data-table="tbl_order_po_inv" data-field="x_PO_No" name="x_PO_No" id="x_PO_No" size="20" maxlength="50" placeholder="<?php echo HtmlEncode($tbl_order_po_inv->PO_No->getPlaceHolder()) ?>" value="<?php echo $tbl_order_po_inv->PO_No->EditValue ?>"<?php echo $tbl_order_po_inv->PO_No->editAttributes() ?>>
</span>
<?php echo $tbl_order_po_inv->PO_No->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($tbl_order_po_inv->INV_No->Visible) { // INV_No ?>
	<div id="r_INV_No" class="form-group row">
		<label id="elh_tbl_order_po_inv_INV_No" for="x_INV_No" class="<?php echo $tbl_order_po_inv_edit->LeftColumnClass ?>"><?php echo $tbl_order_po_inv->INV_No->caption() ?><?php echo ($tbl_order_po_inv->INV_No->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $tbl_order_po_inv_edit->RightColumnClass ?>"><div<?php echo $tbl_order_po_inv->INV_No->cellAttributes() ?>>
<span id="el_tbl_order_po_inv_INV_No">
<input type="text" data-table="tbl_order_po_inv" data-field="x_INV_No" name="x_INV_No" id="x_INV_No" size="20" maxlength="50" placeholder="<?php echo HtmlEncode($tbl_order_po_inv->INV_No->getPlaceHolder()) ?>" value="<?php echo $tbl_order_po_inv->INV_No->EditValue ?>"<?php echo $tbl_order_po_inv->INV_No->editAttributes() ?>>
</span>
<?php echo $tbl_order_po_inv->INV_No->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
	<input type="hidden" data-table="tbl_order_po_inv" data-field="x_ID_PoInv" name="x_ID_PoInv" id="x_ID_PoInv" value="<?php echo HtmlEncode($tbl_order_po_inv->ID_PoInv->CurrentValue) ?>">
<?php if (!$tbl_order_po_inv_edit->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $tbl_order_po_inv_edit->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("SaveBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $tbl_order_po_inv_edit->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$tbl_order_po_inv_edit->showPageFooter();
if (DEBUG_ENABLED)
	echo GetDebugMessage();
?>
<script>

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php include_once "footer.php" ?>
<?php
$tbl_order_po_inv_edit->terminate();
?>