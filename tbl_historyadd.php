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
$tbl_history_add = new tbl_history_add();

// Run the page
$tbl_history_add->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$tbl_history_add->Page_Render();
?>
<?php include_once "header.php" ?>
<script>

// Form object
currentPageID = ew.PAGE_ID = "add";
var ftbl_historyadd = currentForm = new ew.Form("ftbl_historyadd", "add");

// Validate form
ftbl_historyadd.validate = function() {
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
		<?php if ($tbl_history_add->PalletID->Required) { ?>
			elm = this.getElements("x" + infix + "_PalletID");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $tbl_history->PalletID->caption(), $tbl_history->PalletID->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($tbl_history_add->ID_Location->Required) { ?>
			elm = this.getElements("x" + infix + "_ID_Location");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $tbl_history->ID_Location->caption(), $tbl_history->ID_Location->RequiredErrorMessage)) ?>");
		<?php } ?>
			elm = this.getElements("x" + infix + "_ID_Location");
			if (elm && !ew.checkInteger(elm.value))
				return this.onError(elm, "<?php echo JsEncode($tbl_history->ID_Location->errorMessage()) ?>");
		<?php if ($tbl_history_add->PCS->Required) { ?>
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
ftbl_historyadd.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

	// Your custom validation code here, return false if invalid.
	return true;
}

// Use JavaScript validation or not
ftbl_historyadd.validateRequired = <?php echo json_encode(CLIENT_VALIDATE) ?>;

// Dynamic selection lists
// Form object for search

</script>
<script>

// Write your client script here, no need to add script tags.
</script>
<?php $tbl_history_add->showPageHeader(); ?>
<?php
$tbl_history_add->showMessage();
?>
<form name="ftbl_historyadd" id="ftbl_historyadd" class="<?php echo $tbl_history_add->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($tbl_history_add->CheckToken) { ?>
<input type="hidden" name="<?php echo TOKEN_NAME ?>" value="<?php echo $tbl_history_add->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="tbl_history">
<input type="hidden" name="action" id="action" value="insert">
<input type="hidden" name="modal" value="<?php echo (int)$tbl_history_add->IsModal ?>">
<div class="ew-add-div"><!-- page* -->
<?php if ($tbl_history->PalletID->Visible) { // PalletID ?>
	<div id="r_PalletID" class="form-group row">
		<label id="elh_tbl_history_PalletID" for="x_PalletID" class="<?php echo $tbl_history_add->LeftColumnClass ?>"><?php echo $tbl_history->PalletID->caption() ?><?php echo ($tbl_history->PalletID->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $tbl_history_add->RightColumnClass ?>"><div<?php echo $tbl_history->PalletID->cellAttributes() ?>>
<span id="el_tbl_history_PalletID">
<input type="text" data-table="tbl_history" data-field="x_PalletID" name="x_PalletID" id="x_PalletID" size="30" maxlength="50" placeholder="<?php echo HtmlEncode($tbl_history->PalletID->getPlaceHolder()) ?>" value="<?php echo $tbl_history->PalletID->EditValue ?>"<?php echo $tbl_history->PalletID->editAttributes() ?>>
</span>
<?php echo $tbl_history->PalletID->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($tbl_history->ID_Location->Visible) { // ID_Location ?>
	<div id="r_ID_Location" class="form-group row">
		<label id="elh_tbl_history_ID_Location" for="x_ID_Location" class="<?php echo $tbl_history_add->LeftColumnClass ?>"><?php echo $tbl_history->ID_Location->caption() ?><?php echo ($tbl_history->ID_Location->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $tbl_history_add->RightColumnClass ?>"><div<?php echo $tbl_history->ID_Location->cellAttributes() ?>>
<span id="el_tbl_history_ID_Location">
<input type="text" data-table="tbl_history" data-field="x_ID_Location" name="x_ID_Location" id="x_ID_Location" size="30" placeholder="<?php echo HtmlEncode($tbl_history->ID_Location->getPlaceHolder()) ?>" value="<?php echo $tbl_history->ID_Location->EditValue ?>"<?php echo $tbl_history->ID_Location->editAttributes() ?>>
</span>
<?php echo $tbl_history->ID_Location->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($tbl_history->PCS->Visible) { // PCS ?>
	<div id="r_PCS" class="form-group row">
		<label id="elh_tbl_history_PCS" for="x_PCS" class="<?php echo $tbl_history_add->LeftColumnClass ?>"><?php echo $tbl_history->PCS->caption() ?><?php echo ($tbl_history->PCS->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $tbl_history_add->RightColumnClass ?>"><div<?php echo $tbl_history->PCS->cellAttributes() ?>>
<span id="el_tbl_history_PCS">
<input type="text" data-table="tbl_history" data-field="x_PCS" name="x_PCS" id="x_PCS" size="30" placeholder="<?php echo HtmlEncode($tbl_history->PCS->getPlaceHolder()) ?>" value="<?php echo $tbl_history->PCS->EditValue ?>"<?php echo $tbl_history->PCS->editAttributes() ?>>
</span>
<?php echo $tbl_history->PCS->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$tbl_history_add->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $tbl_history_add->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("AddBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $tbl_history_add->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$tbl_history_add->showPageFooter();
if (DEBUG_ENABLED)
	echo GetDebugMessage();
?>
<script>

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php include_once "footer.php" ?>
<?php
$tbl_history_add->terminate();
?>