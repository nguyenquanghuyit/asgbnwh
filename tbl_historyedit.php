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
$tbl_history_edit = new tbl_history_edit();

// Run the page
$tbl_history_edit->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$tbl_history_edit->Page_Render();
?>
<?php include_once "header.php" ?>
<script>

// Form object
currentPageID = ew.PAGE_ID = "edit";
var ftbl_historyedit = currentForm = new ew.Form("ftbl_historyedit", "edit");

// Validate form
ftbl_historyedit.validate = function() {
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
		<?php if ($tbl_history_edit->ID_His->Required) { ?>
			elm = this.getElements("x" + infix + "_ID_His");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $tbl_history->ID_His->caption(), $tbl_history->ID_His->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($tbl_history_edit->PalletID->Required) { ?>
			elm = this.getElements("x" + infix + "_PalletID");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $tbl_history->PalletID->caption(), $tbl_history->PalletID->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($tbl_history_edit->ID_Location->Required) { ?>
			elm = this.getElements("x" + infix + "_ID_Location");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $tbl_history->ID_Location->caption(), $tbl_history->ID_Location->RequiredErrorMessage)) ?>");
		<?php } ?>
			elm = this.getElements("x" + infix + "_ID_Location");
			if (elm && !ew.checkInteger(elm.value))
				return this.onError(elm, "<?php echo JsEncode($tbl_history->ID_Location->errorMessage()) ?>");
		<?php if ($tbl_history_edit->PCS->Required) { ?>
			elm = this.getElements("x" + infix + "_PCS");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $tbl_history->PCS->caption(), $tbl_history->PCS->RequiredErrorMessage)) ?>");
		<?php } ?>
			elm = this.getElements("x" + infix + "_PCS");
			if (elm && !ew.checkInteger(elm.value))
				return this.onError(elm, "<?php echo JsEncode($tbl_history->PCS->errorMessage()) ?>");

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
ftbl_historyedit.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

	// Your custom validation code here, return false if invalid.
	return true;
}

// Use JavaScript validation or not
ftbl_historyedit.validateRequired = <?php echo json_encode(CLIENT_VALIDATE) ?>;

// Dynamic selection lists
// Form object for search

</script>
<script>

// Write your client script here, no need to add script tags.
</script>
<?php $tbl_history_edit->showPageHeader(); ?>
<?php
$tbl_history_edit->showMessage();
?>
<form name="ftbl_historyedit" id="ftbl_historyedit" class="<?php echo $tbl_history_edit->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($tbl_history_edit->CheckToken) { ?>
<input type="hidden" name="<?php echo TOKEN_NAME ?>" value="<?php echo $tbl_history_edit->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="tbl_history">
<input type="hidden" name="action" id="action" value="update">
<input type="hidden" name="modal" value="<?php echo (int)$tbl_history_edit->IsModal ?>">
<div class="ew-edit-div"><!-- page* -->
<?php if ($tbl_history->ID_His->Visible) { // ID_His ?>
	<div id="r_ID_His" class="form-group row">
		<label id="elh_tbl_history_ID_His" class="<?php echo $tbl_history_edit->LeftColumnClass ?>"><?php echo $tbl_history->ID_His->caption() ?><?php echo ($tbl_history->ID_His->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $tbl_history_edit->RightColumnClass ?>"><div<?php echo $tbl_history->ID_His->cellAttributes() ?>>
<span id="el_tbl_history_ID_His">
<span<?php echo $tbl_history->ID_His->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?php echo RemoveHtml($tbl_history->ID_His->EditValue) ?>"></span>
</span>
<input type="hidden" data-table="tbl_history" data-field="x_ID_His" name="x_ID_His" id="x_ID_His" value="<?php echo HtmlEncode($tbl_history->ID_His->CurrentValue) ?>">
<?php echo $tbl_history->ID_His->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($tbl_history->PalletID->Visible) { // PalletID ?>
	<div id="r_PalletID" class="form-group row">
		<label id="elh_tbl_history_PalletID" for="x_PalletID" class="<?php echo $tbl_history_edit->LeftColumnClass ?>"><?php echo $tbl_history->PalletID->caption() ?><?php echo ($tbl_history->PalletID->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $tbl_history_edit->RightColumnClass ?>"><div<?php echo $tbl_history->PalletID->cellAttributes() ?>>
<span id="el_tbl_history_PalletID">
<input type="text" data-table="tbl_history" data-field="x_PalletID" name="x_PalletID" id="x_PalletID" size="30" maxlength="50" placeholder="<?php echo HtmlEncode($tbl_history->PalletID->getPlaceHolder()) ?>" value="<?php echo $tbl_history->PalletID->EditValue ?>"<?php echo $tbl_history->PalletID->editAttributes() ?>>
</span>
<?php echo $tbl_history->PalletID->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($tbl_history->ID_Location->Visible) { // ID_Location ?>
	<div id="r_ID_Location" class="form-group row">
		<label id="elh_tbl_history_ID_Location" for="x_ID_Location" class="<?php echo $tbl_history_edit->LeftColumnClass ?>"><?php echo $tbl_history->ID_Location->caption() ?><?php echo ($tbl_history->ID_Location->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $tbl_history_edit->RightColumnClass ?>"><div<?php echo $tbl_history->ID_Location->cellAttributes() ?>>
<span id="el_tbl_history_ID_Location">
<input type="text" data-table="tbl_history" data-field="x_ID_Location" name="x_ID_Location" id="x_ID_Location" size="30" placeholder="<?php echo HtmlEncode($tbl_history->ID_Location->getPlaceHolder()) ?>" value="<?php echo $tbl_history->ID_Location->EditValue ?>"<?php echo $tbl_history->ID_Location->editAttributes() ?>>
</span>
<?php echo $tbl_history->ID_Location->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($tbl_history->PCS->Visible) { // PCS ?>
	<div id="r_PCS" class="form-group row">
		<label id="elh_tbl_history_PCS" for="x_PCS" class="<?php echo $tbl_history_edit->LeftColumnClass ?>"><?php echo $tbl_history->PCS->caption() ?><?php echo ($tbl_history->PCS->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $tbl_history_edit->RightColumnClass ?>"><div<?php echo $tbl_history->PCS->cellAttributes() ?>>
<span id="el_tbl_history_PCS">
<input type="text" data-table="tbl_history" data-field="x_PCS" name="x_PCS" id="x_PCS" size="30" placeholder="<?php echo HtmlEncode($tbl_history->PCS->getPlaceHolder()) ?>" value="<?php echo $tbl_history->PCS->EditValue ?>"<?php echo $tbl_history->PCS->editAttributes() ?>>
</span>
<?php echo $tbl_history->PCS->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$tbl_history_edit->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $tbl_history_edit->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("SaveBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $tbl_history_edit->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$tbl_history_edit->showPageFooter();
if (DEBUG_ENABLED)
	echo GetDebugMessage();
?>
<script>

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php include_once "footer.php" ?>
<?php
$tbl_history_edit->terminate();
?>